<?php

namespace App\DB;

use Laminas\Db\Adapter\Adapter;
use Psr\Container\ContainerInterface;

class AdaptorFactory
{
    public function __invoke(ContainerInterface $container): Adapter
    {
        $dbConfig = $container->get('config');
        return new Adapter($dbConfig['db']);
    }
}