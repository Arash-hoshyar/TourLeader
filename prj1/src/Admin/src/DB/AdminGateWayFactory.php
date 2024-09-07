<?php

namespace Admin\DB;

use Laminas\Db\Adapter\AdapterInterface;
use Psr\Container\ContainerInterface;

class AdminGateWayFactory
{
    public function __invoke(ContainerInterface $container): AdminGateWay
    {
        $dbAdapter = $container->get(AdapterInterface::class);
        return new AdminGateWay($dbAdapter);
    }
}