<?php

declare(strict_types=1);

namespace Admin\Handler\registerHandler;

use Admin\Form\AdminLoginForm;
use Admin\Services\AdminAuthorizationService;
use Fig\Http\Message\RequestMethodInterface;
use Fig\Http\Message\StatusCodeInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\JsonResponse;
use Laminas\Form\FormInterface;
use Mezzio\Helper\UrlHelper;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;


class AdminLoginPageHandler implements RequestHandlerInterface
{
    public function __construct(
        private ?TemplateRendererInterface $template,
        private AdminAuthorizationService $adminAuthorizationService,
        private UrlHelper $urlHelper
    ) {
    }


    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        if ($request->getMethod() === RequestMethodInterface::METHOD_POST) {
            $adminPostedData = $request->getParsedBody();
            $adminLoginForm = new AdminLoginForm();
            $adminLoginForm->setData($adminPostedData);

            if ($adminLoginForm->isValid()) {
                $adminLoginData = $adminLoginForm->getData(FormInterface::VALUES_AS_ARRAY);
                $output = $this->adminAuthorizationService->adminDoLogin(
                    $adminLoginData['email'],
                    $adminLoginData['password']
                );
                if ($output !== null) {
                    return new JsonResponse(['url' => $this->urlHelper->generate('admin')]);
                }
                return new JsonResponse($adminLoginForm->getMessages(), StatusCodeInterface::STATUS_BAD_REQUEST);
            }
        }
        $data = [
            'email' => $_SESSION['admin_email'] ?? ''
        ];

        return new HtmlResponse(
            $this->template->render(
                'register::adminLogin',
                $data
            )
        );
    }
}
