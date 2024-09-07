<?php

namespace Admin\DB\product;

use Laminas\Db\Adapter\AdapterInterface;
use Psr\Container\ContainerInterface;

class BrandGateWayFactory
{
    public function __invoke(ContainerInterface $container): BrandGateWay
    {
        $dbAdapter = $container->get(AdapterInterface::class);
        return new BrandGateWay($dbAdapter);
    }
}