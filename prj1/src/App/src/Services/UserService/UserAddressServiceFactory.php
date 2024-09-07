<?php

declare(strict_types=1);

namespace App\Services\UserService;

use App\DB\gateWay\userGateWay\userBillInfo\UserAddressGateWay;
use Psr\Container\ContainerInterface;

class UserAddressServiceFactory
{

    public function __invoke(ContainerInterface $container): UserAddressService
    {
        return new UserAddressService(
            $container->get(UserAddressGateWay::class)
        );
    }
}