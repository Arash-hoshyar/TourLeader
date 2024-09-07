<?php

namespace App\Services\TL;

use Admin\DB\product\BrandGateWay;
use Admin\Services\Product\BrandService;
use App\DB\TlDB\TLJourneyGateWay;
use App\DB\TlDB\TLPostGateWay;
use Psr\Container\ContainerInterface;

class PostServiceFactory
{
    public function __invoke(ContainerInterface $container): PostService
    {
        return new PostService(
            $container->get(TLPostGateWay::class)
        );
    }
}