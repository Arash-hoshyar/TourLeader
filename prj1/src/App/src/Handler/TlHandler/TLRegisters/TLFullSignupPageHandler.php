<?php

declare(strict_types=1);

namespace App\Handler\TlHandler\TLRegisters;

use App\Services\TL\TLAuthorizationService;
use Fig\Http\Message\RequestMethodInterface;
use Fig\Http\Message\StatusCodeInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\JsonResponse;
use Mezzio\Helper\UrlHelper;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class TLFullSignupPageHandler implements RequestHandlerInterface
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

            $this->authorizationService->fullSignup(
                $postedData['name'],
                $postedData['email'],
                $postedData['password'],
                $postedData['age'],
                $postedData['country'],
                $postedData['city'],
                $postedData['number'],
                $postedData['Language'],
                (int)$postedData['id'],

            );
            $output = $this->authorizationService->doLogin($postedData['email'], $postedData['password']);

            return new JsonResponse(['url' => $this->urlHelper->generate('index')]);
        }

        $productId = (int)$request->getqueryParams()['id'] ?? 0;

        if ($productId === 0) {
            return new JsonResponse(StatusCodeInterface::STATUS_NOT_FOUND);
        }
        $tl = $this->authorizationService->findTL($productId);
        $data = [
            'email' => $_SESSION['tl_email'] ?? '',
            'tl' => $tl,
        ];
        return new HtmlResponse($this->template->render('tourRegister::fullSignup', $data));
    }
}
