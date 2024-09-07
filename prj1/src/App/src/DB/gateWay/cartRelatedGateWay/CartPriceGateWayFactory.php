<?php

namespace App\DB\gateWay\cartRelatedGateWay;

use Laminas\Db\Adapter\AdapterInterface;
use Psr\Container\ContainerInterface;

class CartPriceGateWayFactory
{
    public function __invoke(ContainerInterface $container): CartPriceGateWay
    {
        $dbAdapter = $container->get(AdapterInterface::class);
        return new CartPriceGateWay($dbAdapter);
    }
}