<?php
declare(strict_types=1);

namespace Admin\Middlewere;

use Admin\Services\AdminAuthorizationService;
use Laminas\Diactoros\Response\RedirectResponse;
use Mezzio\Helper\UrlHelper;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class AdminAuthenticationMiddleware implements MiddlewareInterface
{
    public function __construct(
        private AdminAuthorizationService $adminAuthorizationService,
        private UrlHelper            $urlHelperr
    )
    {
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        if (!$this->adminAuthorizationService->isAdminDoLogin()) {
            return new RedirectResponse($this->urlHelperr->generate('adminlogin'));
        }
        return $handler->handle($request);
    }
}