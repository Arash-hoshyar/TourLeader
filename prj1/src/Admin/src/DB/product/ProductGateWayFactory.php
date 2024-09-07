<?php

namespace Admin\DB\product;

use Laminas\Db\Adapter\AdapterInterface;
use Psr\Container\ContainerInterface;

class ProductGateWayFactory
{
    public function __invoke(ContainerInterface $container): ProductGateWay
    {
        $dbAdapter = $container->get(AdapterInterface::class);
        return new ProductGateWay($dbAdapter);
    }
}