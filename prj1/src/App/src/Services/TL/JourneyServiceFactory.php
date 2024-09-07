<?php

namespace App\Services\TL;

use Admin\DB\product\BrandGateWay;
use Admin\Services\Product\BrandService;
use App\DB\TlDB\TLJourneyGateWay;
use Psr\Container\ContainerInterface;

class JourneyServiceFactory
{
    public function __invoke(ContainerInterface $container): JourneyService
    {
        return new JourneyService(
            $container->get(TLJourneyGateWay::class)
        );
    }
}