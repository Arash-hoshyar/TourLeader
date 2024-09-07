<?php

declare(strict_types=1);

namespace Admin\Handler\registerHandler;

use Admin\Form\AdminChangePasswordForm;
use Admin\Services\AdminAuthorizationService;
use Fig\Http\Message\RequestMethodInterface;
use Fig\Http\Message\StatusCodeInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\JsonResponse;
use Laminas\Form\FormInterface;
use Laminas\Mail\Message;
use Laminas\Mail\Transport\Sendmail;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class AdminChangePasswordPageHandler implements RequestHandlerInterface
{
    public function __construct(
        private ?TemplateRendererInterface $template,
        private AdminAuthorizationService  $adminAuthorizationService,
        private Message                    $message,
        private Sendmail                   $sendmail
    )
    {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {

        if ($request->getMethod() === RequestMethodInterface::METHOD_POST) {
            $postedData = $request->getParsedBody();
            $adminSignupForm = new AdminChangePasswordForm();
            $adminSignupForm->setData($postedData);

            if ($adminSignupForm->isValid()) {
                $signupData = $adminSignupForm->getData(FormInterface::VALUES_AS_ARRAY);
                $output = $this->adminAuthorizationService->adminDoResetPassword($signupData['email']);

                if ($output !== null) {
                    $message = new Message();
                    $message->addTo($signupData['email']);
                    $message->addFrom('arashhoshyar.2020@gmail.com');
                    $message->setSubject('Greetings and Salutations!');
                    $message->setBody("Sorry, I'm going to be late today!");

                    $transport = new Sendmail();
                    $transport->send($message);
                }

            }
            return new JsonResponse($adminSignupForm->getMessages(), StatusCodeInterface::STATUS_BAD_REQUEST);
        }
        return new HtmlResponse($this->template->render(
            'register::changePassword'
        )
        );
    }
}
