<?php

declare(strict_types=1);

namespace App\Services;

use App\DB\gateWay\cartRelatedGateWay\CartGateWay;
use Psr\Container\ContainerInterface;

class CartServiceFactory
{

    public function __invoke(ContainerInterface $container): CartService
    {
        return new CartService(
            $container->get(CartGateWay::class)
        );
    }
}