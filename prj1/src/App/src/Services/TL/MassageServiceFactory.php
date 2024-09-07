<?php

declare(strict_types=1);

namespace App\Services\TL;

use App\DB\TlDB\TourLeaderGateWay;
use Psr\Container\ContainerInterface;

class TLAuthorizationServiceFactory
{

    public function __invoke(ContainerInterface $container): TLAuthorizationService
    {
        return new TLAuthorizationService(
            $container->get(TourLeaderGateWay::class)
        );
    }
}