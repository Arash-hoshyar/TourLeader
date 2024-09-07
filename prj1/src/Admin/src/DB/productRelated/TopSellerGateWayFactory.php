<?php

namespace Admin\DB\productRelated;

use Laminas\Db\Adapter\AdapterInterface;
use Psr\Container\ContainerInterface;

class TopSellerGateWayFactory
{
    public function __invoke(ContainerInterface $container): TopSellerGateWay
    {
        $dbAdapter = $container->get(AdapterInterface::class);
        return new TopSellerGateWay($dbAdapter);
    }
}