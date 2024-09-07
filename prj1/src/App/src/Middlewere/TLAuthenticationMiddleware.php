<?php
declare(strict_types=1);

namespace App\Middlewere;

use App\Services\TL\TLAuthorizationService;
use Laminas\Diactoros\Response\RedirectResponse;
use Mezzio\Helper\UrlHelper;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class TLAuthenticationMiddleware implements MiddlewareInterface
{
    public function __construct(
        private TLAuthorizationService  $authorizationService,
        private UrlHelper            $urlHelperr
    )
    {
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        if (!$this->authorizationService->isTLDoLogin()) {
            return new RedirectResponse($this->urlHelperr->generate('tllogin'));
        }
        return $handler->handle($request);
    }
}