<?php

declare(strict_types=1);

namespace App\Services;

use App\DB\gateWay\WishListGateWay;
use Psr\Container\ContainerInterface;

class WishListServiceFactory
{

    public function __invoke(ContainerInterface $container): WishListService
    {
        return new WishListService(
            $container->get(WishListGateWay::class)
        );
    }
}