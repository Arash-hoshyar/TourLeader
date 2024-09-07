<?php

declare(strict_types=1);

namespace App\Services\UserService;

use App\DB\gateWay\userGateWay\UserGateWay;
use Psr\Container\ContainerInterface;

class AuthorizationServiceFactory
{

    public function __invoke(ContainerInterface $container): AuthorizationService
    {
        return new AuthorizationService(
            $container->get(UserGateWay::class)
        );
    }
}