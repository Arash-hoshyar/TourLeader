<?php

namespace App\DB\TlDB;

use Laminas\Db\Adapter\AdapterInterface;
use Psr\Container\ContainerInterface;

class MassageGateWayFactory
{
    public function __invoke(ContainerInterface $container): MassageGateWay
    {
        $dbAdapter = $container->get(AdapterInterface::class);
        return new MassageGateWay($dbAdapter);
    }
}