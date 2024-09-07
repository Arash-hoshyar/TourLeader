<?php

namespace Admin\Services\Product;

use Admin\DB\product\MaterialGateWay;
use Psr\Container\ContainerInterface;

class MaterialServiceFactory
{
    public function __invoke(ContainerInterface $container): MaterialService
    {
        return new MaterialService(
            $container->get(MaterialGateWay::class)
        );
    }
}