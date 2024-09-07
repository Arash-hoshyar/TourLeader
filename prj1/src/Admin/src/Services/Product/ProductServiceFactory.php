<?php

namespace Admin\Services\Product;

use Admin\DB\product\ProductGateWay;
use Admin\DB\productRelated\AdminProductMaterialCategoryGateWay;
use Psr\Container\ContainerInterface;

class ProductServiceFactory
{
    public function __invoke(ContainerInterface $container): ProductService
    {
        return new ProductService(
            $container->get(ProductGateWay::class),
            $container->get(AdminProductMaterialCategoryGateWay::class),
        );
    }
}