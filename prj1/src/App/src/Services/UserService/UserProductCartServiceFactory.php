<?php

declare(strict_types=1);

namespace App\Services\UserService;

use App\DB\gateWay\userGateWay\userBillInfo\UserAddressGateWay;
use App\DB\gateWay\userGateWay\userBillInfo\UserProductCartGateWay;
use Psr\Container\ContainerInterface;

class UserProductCartServiceFactory
{

    public function __invoke(ContainerInterface $container): UserProductCartService
    {
        return new UserProductCartService(
            $container->get(UserProductCartGateWay::class)
        );
    }
}