<?php

namespace App\DB\gateWay\userGateWay;

use Laminas\Db\Adapter\AdapterInterface;
use Psr\Container\ContainerInterface;

class UserGateWayFactory
{
    public function __invoke(ContainerInterface $container): UserGateWay
    {
        $dbAdapter = $container->get(AdapterInterface::class);
        return new UserGateWay($dbAdapter);
    }
}