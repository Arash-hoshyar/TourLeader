<?php

namespace App\DB\gateWay;

use Laminas\Db\Adapter\AdapterInterface;
use Psr\Container\ContainerInterface;

class WishListGateWayFactory
{
    public function __invoke(ContainerInterface $container): WishListGateWay
    {
        $dbAdapter = $container->get(AdapterInterface::class);
        return new WishListGateWay($dbAdapter);
    }
}