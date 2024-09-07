<?php

namespace TourLeader\DB;

use Laminas\Db\Adapter\AdapterInterface;
use Psr\Container\ContainerInterface;

class TourLeaderGateWayFactory
{
    public function __invoke(ContainerInterface $container): TourLeaderGateWay
    {
        $dbAdapter = $container->get(AdapterInterface::class);
        return new TourLeaderGateWay($dbAdapter);
    }
}