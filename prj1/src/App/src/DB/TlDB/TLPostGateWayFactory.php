<?php

namespace App\DB\TlDB;

use Admin\DB\product\BrandGateWay;
use Laminas\Db\Adapter\AdapterInterface;
use Psr\Container\ContainerInterface;

class TLPostGateWayFactory
{
    public function __invoke(ContainerInterface $container): TLPostGateWay
    {
        $dbAdapter = $container->get(AdapterInterface::class);
        return new TLPostGateWay($dbAdapter);
    }
}