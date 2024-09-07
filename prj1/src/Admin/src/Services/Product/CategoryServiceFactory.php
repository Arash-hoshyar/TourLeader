<?php

namespace Admin\Services\Product;

use Admin\DB\product\CategoryGateWay;
use Psr\Container\ContainerInterface;

class CategoryServiceFactory
{
    public function __invoke(ContainerInterface $container): CategoryService
    {
        return new CategoryService(
            $container->get(CategoryGateWay::class)
        );
    }
}