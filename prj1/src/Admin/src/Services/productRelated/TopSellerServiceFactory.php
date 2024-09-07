<?php

namespace Admin\Services\productRelated;

use Admin\DB\product\CategoryGateWay;
use Admin\DB\productRelated\TopSellerGateWay;
use Admin\Services\Product\CategoryService;
use Psr\Container\ContainerInterface;

class TopSellerServiceFactory
{
    public function __invoke(ContainerInterface $container): TopSellerService
    {
        return new TopSellerService(
            $container->get(TopSellerGateWay::class)
        );
    }
}