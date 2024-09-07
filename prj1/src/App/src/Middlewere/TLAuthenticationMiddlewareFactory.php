<?php
declare(strict_types=1);

namespace App\Middlewere;

use App\Services\TL\TLAuthorizationService;
use Mezzio\Helper\UrlHelper;
use Psr\Container\ContainerInterface;


class TLAuthenticationMiddlewareFactory
{
    public function __invoke(ContainerInterface $container): TLAuthenticationMiddleware
    {
        return new TLAuthenticationMiddleware(
            $container->get(TLAuthorizationService::class),
            $container->get(UrlHelper::class),
        );
    }

}