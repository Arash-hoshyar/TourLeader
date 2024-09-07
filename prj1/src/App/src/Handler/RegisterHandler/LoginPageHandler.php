<?php

declare(strict_types=1);

namespace App\Handler\RegisterHandler;

use App\Form\LoginForm;
use App\Services\CartService;
use App\Services\UserService\AuthorizationService;
use Fig\Http\Message\RequestMethodInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\JsonResponse;
use Laminas\Form\FormInterface;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;


class LoginPageHandler implements RequestHandlerInterface
{
    public function __construct(
        private ?TemplateRendererInterface $template,
        private AuthorizationService       $authorizationService,
        private CartService                $cartService,
    )
    {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {

        if ($request->getMethod() === RequestMethodInterface::METHOD_POST) {
            $postedData = $request->getParsedBody();
            $loginForm = new LoginForm();
            $loginForm->setData($postedData);

            if ($loginForm->isValid()) {
                $cookie = $_COOKIE['PHPSESSID'];
                $loginData = $loginForm->getData(FormInterface::VALUES_AS_ARRAY);
                $output = $this->authorizationService->doLogin($loginData['email'], $loginData['password']);
                $session = $_SESSION['user_email'];
                $this->cartService->updateCartBySession($session, $cookie);
                return new JsonResponse($output);
            }
            return new JsonResponse($loginForm->getMessages());
        }
        $session = $_COOKIE['PHPSESSID'];

        if (isset($_SESSION['user_email'])) {
            $session = $_SESSION['user_email'];
        }

        $productIds = $this->cartService->selectCart($session);
        $productIdsCollection = [];

        foreach ($productIds as $item) {
            $productIdsCollection [] = (int)$item['product_id'];
        }
        $finalProductIdsCollection = (implode(',', $productIdsCollection));
        $addedProductOutput = $this->cartService->getALLCartByproductIds($finalProductIdsCollection);

        $total = 0;
        foreach ($addedProductOutput as $item) {
            $total += (int)$item['price'];
        }

        $data = [
            'email' => $_SESSION['user_email'] ?? '',
            'cartProduct' => $addedProductOutput,
            'totalPrice' => $total,
        ];

        return new HtmlResponse($this->template->render(
            'register::login',
            $data
        ));
    }
}
