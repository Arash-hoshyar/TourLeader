<?php
declare(strict_types=1);

namespace Admin\Middlewere;

use Admin\Services\AdminAuthorizationService;
use App\Middlewere\AuthenticationMiddleware;
use Mezzio\Helper\UrlHelper;
use Psr\Container\ContainerInterface;


class AdminAuthenticationMiddlewareFactory
{
    public function __invoke(ContainerInterface $container): AdminAuthenticationMiddleware
    {
        return new AdminAuthenticationMiddleware(
            $container->get(AdminAuthorizationService::class),
            $container->get(UrlHelper::class),
        );
    }

}