<?php

namespace Admin\DB\product;

use Laminas\Db\Adapter\AdapterInterface;
use Psr\Container\ContainerInterface;

class MaterialGateWayFactory
{
    public function __invoke(ContainerInterface $container): materialGateWay
    {
        $dbAdapter = $container->get(AdapterInterface::class);
        return new materialGateWay($dbAdapter);
    }
}