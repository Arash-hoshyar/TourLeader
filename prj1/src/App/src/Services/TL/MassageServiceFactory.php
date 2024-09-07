<?php

declare(strict_types=1);

namespace App\Services\TL;

use App\DB\TlDB\MassageGateWay;
use App\DB\TlDB\TourLeaderGateWay;
use Psr\Container\ContainerInterface;

class MassageServiceFactory
{

    public function __invoke(ContainerInterface $container): MassageService
    {
        return new MassageService(
            $container->get(MassageGateWay::class)
        );
    }
}