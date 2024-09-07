<?php
declare(strict_types=1);

namespace App\Middlewere;

use App\Services\UserService\AuthorizationService;
use Laminas\Diactoros\Response\RedirectResponse;
use Mezzio\Helper\UrlHelper;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class AuthenticationMiddleware implements MiddlewareInterface
{
    public function __construct(
        private AuthorizationService  $authorizationService,
        private UrlHelper            $urlHelperr
    )
    {
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        if (!$this->authorizationService->isUserDoLogin()) {
            return new RedirectResponse($this->urlHelperr->generate('login'));
        }
        return $handler->handle($request);
    }
}