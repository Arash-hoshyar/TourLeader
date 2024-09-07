<?php

namespace App\Services\TL;

use App\DB\TlDB\TLJourneyGateWay;
use App\DB\TlDB\TLToursGateWay;
use Psr\Container\ContainerInterface;

class TourServiceFactory
{
    public function __invoke(ContainerInterface $container): TourService
    {
        return new TourService(
            $container->get(TLToursGateWay::class)
        );
    }
}