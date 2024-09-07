<?php

declare(strict_types=1);

namespace TourLeader\Handler\TLRegisters;

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
use TourLeader\Form\TLLoginForm;
use TourLeader\Service\TLAuthorizationService;


class TLLoginPageHandler implements RequestHandlerInterface
{
    public function __construct(
        private ?TemplateRendererInterface $template,
        private TLAuthorizationService $authorizationService,
    ) {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        if ($request->getMethod() === RequestMethodInterface::METHOD_POST) {
            $postedData = $request->getParsedBody();
            $loginForm = new TLLoginForm();
            $loginForm->setData($postedData);

            if ($loginForm->isValid()) {
                $loginData = $loginForm->getData(FormInterface::VALUES_AS_ARRAY);
                $output = $this->authorizationService->doLogin($loginData['email'], $loginData['password']);
                return new JsonResponse($output);
            }
            return new JsonResponse($loginForm->getMessages());
        }

        $data = [
            'email' => $_SESSION['tl_email'] ?? '',
        ];

        return new HtmlResponse(
            $this->template->render(
                'register::login',
                $data
            )
        );
    }
}
