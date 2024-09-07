<?php

namespace Admin\Services\productRelated;

use Admin\DB\productRelated\AdminProductMaterialCategoryGateWay;
use Psr\Container\ContainerInterface;

class ProductMaterialCategoryServiceFactory
{
    public function __invoke(ContainerInterface $container): ProductMaterialCategoryService
    {
        return new ProductMaterialCategoryService(
            $container->get(AdminProductMaterialCategoryGateWay::class)
        );
    }
}