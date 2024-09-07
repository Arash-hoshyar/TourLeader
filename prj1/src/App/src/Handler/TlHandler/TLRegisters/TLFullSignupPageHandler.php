<?php

declare(strict_types=1);

namespace App\Handler\TlHandler\TLRegisters;

use App\Form\TLSignupForm;
use App\Services\TLAuthorizationService;
use Fig\Http\Message\RequestMethodInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\JsonResponse;
use Laminas\Form\FormInterface;
use Mezzio\Helper\UrlHelper;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class TLSignupPageHandler implements RequestHandlerInterface
{
    public function __construct(
        private ?TemplateRendererInterface $template,
        private TLAuthorizationService $authorizationService,
        private UrlHelper $urlHelper,
    ) {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        if ($request->getMethod() === RequestMethodInterface::METHOD_POST) {
            $postedData = $request->getParsedBody();
            $signupForm = new TLSignupForm();
            $signupForm->setData($postedData);

            if ($signupForm->isValid()) {

                $signupData = $signupForm->getData(FormInterface::VALUES_AS_ARRAY);
                $this->authorizationService->doSignup($signupData['email'], $signupData['password']);
                $output = $this->authorizationService->doLogin($signupData['email'], $signupData['password']);

                return new JsonResponse(['url' => $this->urlHelper->generate('index')]);
            }
            return new JsonResponse($signupForm->getMessages());
        }
        $data = [
            'email' => $_SESSION['tl_email'] ?? '',
        ];
        return new HtmlResponse($this->template->render('tourRegister::signup', $data));
    }
}
