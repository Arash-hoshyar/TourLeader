<?php

declare(strict_types=1);

namespace App\Services\UserService;

use App\DB\gateWay\userGateWay\userBillInfo\UserAddressGateWay;
use Laminas\Db\Adapter\Driver\ResultInterface;

class UserAddressService
{


    public function __construct(private UserAddressGateWay $userAddressGateWay)
    {
    }


    public function addBillingAddress
    (
        string $name,
        string $email,
        string $address,
        string $city,
        string $country,
        int $zipCode,
        int $telephone,
        string $product_ids,
        string $session,
        int|null $presentAddressId = null
    ): int {
        return $this->userAddressGateWay->addBillingAddress
        (
            $name,
            $email,
            $address,
            $city,
            $country,
            $zipCode,
            $telephone,
            $product_ids,
            $session,
            $presentAddressId
        );
    }
}