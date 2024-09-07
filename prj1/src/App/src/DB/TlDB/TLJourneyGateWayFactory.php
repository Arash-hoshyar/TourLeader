<?php

namespace App\DB\TlDB;

use Admin\DB\product\BrandGateWay;
use Laminas\Db\Adapter\AdapterInterface;
use Psr\Container\ContainerInterface;

class TLJourneyGateWayFactory
{
    public function __invoke(ContainerInterface $container): TLJourneyGateWay
    {
        $dbAdapter = $container->get(AdapterInterface::class);
        return new TLJourneyGateWay($dbAdapter);
    }
}