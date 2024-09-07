<?php

declare(strict_types=1);

namespace App\Services\UserService;

use App\DB\gateWay\userGateWay\userBillInfo\PresentAddressGateWay;

class PresentAddressService
{


    public function __construct(private PresentAddressGateWay $presentAddressGateWay)
    {
    }


    public function addPresentAddress(string $name, string $email, string $address, string $city, string $country, int $zipCode, int $telephone): int
    {
        return $this->presentAddressGateWay->addPresentAddress($name, $email, $address, $city, $country, $zipCode, $telephone);
    }

}