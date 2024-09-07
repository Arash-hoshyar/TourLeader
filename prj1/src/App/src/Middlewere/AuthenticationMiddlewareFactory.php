<?php
declare(strict_types=1);

namespace App\Middlewere;

use App\Services\UserService\AuthorizationService;
use Mezzio\Helper\UrlHelper;
use Psr\Container\ContainerInterface;


class AuthenticationMiddlewareFactory
{
    public function __invoke(ContainerInterface $container): AuthenticationMiddleware
    {
        return new AuthenticationMiddleware(
            $container->get(AuthorizationService::class),
            $container->get(UrlHelper::class),
        );
    }

}