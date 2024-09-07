<?php

declare(strict_types=1);

namespace App\Handler\TlHandler\TLRegisters;

use App\Form\TLLoginForm;
use App\Services\TL\TLAuthorizationService;
use Fig\Http\Message\RequestMethodInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\JsonResponse;
use Laminas\Form\FormInterface;
use Mezzio\Helper\UrlHelper;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;


class TLLoginPageHandler implements RequestHandlerInterface
{
    public function __construct(
        private ?TemplateRendererInterface $template,
        private TLAuthorizationService $authorizationService,
        private UrlHelper              $urlHelper,
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

                return new JsonResponse(['url' => $this->urlHelper->generate('index')]);
            }
            return new JsonResponse($loginForm->getMessages());
        }

        $data = [
            'email' => $_SESSION['tl_email'] ?? '',
        ];

        return new HtmlResponse(
            $this->template->render(
                'tourRegister::login',
                $data
            )
        );
    }
}
