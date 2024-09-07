<?php

namespace Admin\Services;

use Admin\DB\AdminGateWay;
use Psr\Container\ContainerInterface;

class AdminAuthorizationServiceFactory
{
    public function __invoke(ContainerInterface $container): AdminAuthorizationService
    {
        return new AdminAuthorizationService(
            $container->get(AdminGateWay::class)
        );
    }
}