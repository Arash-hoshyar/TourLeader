<?php

declare(strict_types=1);

namespace Admin\Handler\registerHandler;

use Admin\Form\AdminSignupForm;
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

class AdminSignupPageHandler implements RequestHandlerInterface
{
    public function __construct(
        private ?TemplateRendererInterface $template,
        private AdminAuthorizationService  $adminAuthorizationService,
        private UrlHelper                  $urlHelper
    )
    {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {

        if ($request->getMethod() === RequestMethodInterface::METHOD_POST) {
            $postedData = $request->getParsedBody();
            $adminSignupForm = new AdminSignupForm();
            $adminSignupForm->setData($postedData);

            if ($adminSignupForm->isValid()) {
                $signupData = $adminSignupForm->getData(FormInterface::VALUES_AS_ARRAY);
                $this->adminAuthorizationService->adminDoSignup($signupData['email'], $signupData['password']);
                $output = $this->adminAuthorizationService->adminDoLogin($signupData['email'], $signupData['password']);

                if ($output !== null) {
                    return new JsonResponse(['url' => $this->urlHelper->generate('admin')]);
                }
            }
            return new JsonResponse($adminSignupForm->getMessages(), StatusCodeInterface::STATUS_BAD_REQUEST);
        }
        $data = [
            'email' => $_SESSION['admin_email'] ?? ''
        ];
        return new HtmlResponse($this->template->render(
            'register::addAdmin',
            $data
        )
        );
    }
}
