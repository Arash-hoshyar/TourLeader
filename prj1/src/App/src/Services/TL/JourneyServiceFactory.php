<?php

namespace Admin\Services\Product;

use Admin\DB\product\BrandGateWay;
use Psr\Container\ContainerInterface;

class BrandServiceFactory
{
    public function __invoke(ContainerInterface $container): BrandService
    {
        return new BrandService(
            $container->get(BrandGateWay::class)
        );
    }
}