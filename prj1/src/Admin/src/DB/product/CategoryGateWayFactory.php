<?php

namespace Admin\DB\product;

use Laminas\Db\Adapter\AdapterInterface;
use Psr\Container\ContainerInterface;

class CategoryGateWayFactory
{
    public function __invoke(ContainerInterface $container): CategoryGateWay
    {
        $dbAdapter = $container->get(AdapterInterface::class);
        return new CategoryGateWay($dbAdapter);
    }
}