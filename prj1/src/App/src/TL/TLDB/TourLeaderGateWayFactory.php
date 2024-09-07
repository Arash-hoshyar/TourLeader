<?php

namespace App\DB\gateWay\cartRelatedGateWay;

use Laminas\Db\Adapter\AdapterInterface;
use Psr\Container\ContainerInterface;

class CartGateWayFactory
{
    public function __invoke(ContainerInterface $container): CartGateWay
    {
        $dbAdapter = $container->get(AdapterInterface::class);
        return new CartGateWay($dbAdapter);
    }
}