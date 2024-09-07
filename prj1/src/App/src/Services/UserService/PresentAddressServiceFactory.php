<?php

declare(strict_types=1);

namespace App\Services\UserService;

use App\DB\gateWay\userGateWay\userBillInfo\PresentAddressGateWay;
use Psr\Container\ContainerInterface;

class PresentAddressServiceFactory
{

    public function __invoke(ContainerInterface $container): PresentAddressService
    {
        return new PresentAddressService(
            $container->get(PresentAddressGateWay::class)
        );
    }
}