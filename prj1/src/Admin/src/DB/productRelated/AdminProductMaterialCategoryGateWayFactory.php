<?php

namespace Admin\DB\productRelated;

use Laminas\Db\Adapter\AdapterInterface;
use Psr\Container\ContainerInterface;

class AdminProductMaterialCategoryGateWayFactory
{
    public function __invoke(ContainerInterface $container): AdminProductMaterialCategoryGateWay
    {
        $dbAdapter = $container->get(AdapterInterface::class);
        return new AdminProductMaterialCategoryGateWay($dbAdapter);
    }
}