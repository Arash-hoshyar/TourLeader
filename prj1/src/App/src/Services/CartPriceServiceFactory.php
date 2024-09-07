<?php

declare(strict_types=1);

namespace App\Services;

use App\DB\gateWay\cartRelatedGateWay\CartGateWay;
use App\DB\gateWay\cartRelatedGateWay\CartPriceGateWay;
use Psr\Container\ContainerInterface;

class CartPriceServiceFactory
{

    public function __invoke(ContainerInterface $container): CartPriceService
    {
        return new CartPriceService(
            $container->get(CartPriceGateWay::class)
        );
    }
}