<?php

declare(strict_types=1);

namespace App\Services\UserService;

use App\DB\gateWay\userGateWay\userBillInfo\UserAddressGateWay;
use App\DB\gateWay\userGateWay\userBillInfo\UserProductCartGateWay;
use App\DB\gateWay\userGateWay\userBillInfo\UserPurchaseInfoGateWay;
use Psr\Container\ContainerInterface;

class UserPurchaseInfoServiceFactory
{

    public function __invoke(ContainerInterface $container): UserPurchaseInfoService
    {
        return new UserPurchaseInfoService(
            $container->get(UserPurchaseInfoGateWay::class)
        );
    }
}