<?php

declare(strict_types=1);

namespace TourLeader\Handler\TLRegisters;

use App\Form\SignupForm;
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
use TourLeader\Form\TLSignupForm;
use TourLeader\Service\TLAuthorizationService;

class TLSignupPageHandler implements RequestHandlerInterface
{
    public function __construct(
        private ?TemplateRendererInterface $template,
        private TLAuthorizationService       $authorizationService,
    )
    {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {

        if ($request->getMethod() === RequestMethodInterface::METHOD_POST) {
            $postedData = $request->getParsedBody();
            $signupForm = new TLSignupForm();
            $signupForm->setData($postedData);

            if ($signupForm->isValid()) {
                $cookie = $_COOKIE['PHPSESSID'];
                $signupData = $signupForm->getData(FormInterface::VALUES_AS_ARRAY);
                $this->authorizationService->doSignup($signupData['email'], $signupData['password']);
                $output = $this->authorizationService->doLogin($signupData['email'], $signupData['password']);
                $session = $_SESSION['user_email'];
                return new JsonResponse($output);
            }
            return new JsonResponse($signupForm->getMessages());

        }
        $data = [
            'email' => $_SESSION['tl_email'] ?? '',
        ];
        return new HtmlResponse($this->template->render('register::signup', $data));
    }
}
