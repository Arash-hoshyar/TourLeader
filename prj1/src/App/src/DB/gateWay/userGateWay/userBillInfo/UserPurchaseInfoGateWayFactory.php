<?php

namespace App\DB\gateWay\userGateWay\userBillInfo;

use Laminas\Db\Adapter\AdapterInterface;
use Psr\Container\ContainerInterface;

class UserPurchaseInfoGateWayFactory
{
    public function __invoke(ContainerInterface $container): UserPurchaseInfoGateWay
    {
        $dbAdapter = $container->get(AdapterInterface::class);
        return new UserPurchaseInfoGateWay($dbAdapter);
    }
}