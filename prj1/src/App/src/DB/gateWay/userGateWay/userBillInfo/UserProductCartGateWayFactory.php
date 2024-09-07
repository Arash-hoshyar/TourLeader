<?php

namespace App\DB\gateWay\userGateWay\userBillInfo;

use Laminas\Db\Adapter\AdapterInterface;
use Psr\Container\ContainerInterface;

class UserProductCartGateWayFactory
{
    public function __invoke(ContainerInterface $container): UserProductCartGateWay
    {
        $dbAdapter = $container->get(AdapterInterface::class);
        return new UserProductCartGateWay($dbAdapter);
    }
}