<?php

namespace App\DB\gateWay\userGateWay\userBillInfo;

use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\Adapter\Driver\ResultInterface;
use Laminas\Db\TableGateway\TableGateway;

class UserAddressGateWay extends TableGateway
{
    public function __construct(AdapterInterface $adapter)
    {
        parent::__construct('tbl_user_billing_address', $adapter);
    }

    public function addBillingAddress(
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
        $data = [
            'name' => $name,
            'email' => $email,
            'address' => $address,
            'city' => $city,
            'country' => $country,
            'zipCode' => $zipCode,
            'telephone' => $telephone,
            'product_ids' => $product_ids,
            'session' => $session,
            'presentAddress_id' => $presentAddressId
        ];

        if ($presentAddressId === null) {
            $data = [
                'name' => $name,
                'email' => $email,
                'address' => $address,
                'city' => $city,
                'country' => $country,
                'zipCode' => $zipCode,
                'telephone' => $telephone,
                'product_ids' => $product_ids,
                'session' => $session,
            ];
        }

        $this->insert($data);
        return $this->lastInsertValue;
    }

}