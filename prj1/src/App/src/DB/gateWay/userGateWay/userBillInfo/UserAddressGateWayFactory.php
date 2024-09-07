<?php

namespace App\DB\gateWay\userGateWay\userBillInfo;

use Laminas\Db\Adapter\AdapterInterface;
use Psr\Container\ContainerInterface;

class UserAddressGateWayFactory
{
    public function __invoke(ContainerInterface $container): UserAddressGateWay
    {
        $dbAdapter = $container->get(AdapterInterface::class);
        return new UserAddressGateWay($dbAdapter);
    }
}