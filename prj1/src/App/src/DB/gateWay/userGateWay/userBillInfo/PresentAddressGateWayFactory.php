<?php

namespace App\DB\gateWay\userGateWay\userBillInfo;

use Laminas\Db\Adapter\AdapterInterface;
use Psr\Container\ContainerInterface;

class PresentAddressGateWayFactory
{
    public function __invoke(ContainerInterface $container): PresentAddressGateWay
    {
        $dbAdapter = $container->get(AdapterInterface::class);
        return new PresentAddressGateWay($dbAdapter);
    }
}