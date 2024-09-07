<?php

namespace App\DB\TlDB;

use Admin\DB\product\BrandGateWay;
use Laminas\Db\Adapter\AdapterInterface;
use Psr\Container\ContainerInterface;

class TLToursGateWayFactory
{
    public function __invoke(ContainerInterface $container): TLToursGateWay
    {
        $dbAdapter = $container->get(AdapterInterface::class);
        return new TLToursGateWay($dbAdapter);
    }
}