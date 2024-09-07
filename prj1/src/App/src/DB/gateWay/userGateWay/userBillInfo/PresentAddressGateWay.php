<?php

namespace App\DB\gateWay\userGateWay\userBillInfo;

use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\TableGateway\TableGateway;

class PresentAddressGateWay extends TableGateway
{
    public function __construct(AdapterInterface $adapter)
    {
        parent::__construct('tbl_presentAddress', $adapter);
    }

    public function addPresentAddress(
        string $name,
        string $email,
        string $address,
        string $city,
        string $country,
        int $zipCode,
        int $telephone
    ): int {
        $sqlQuery = "INSERT INTO `tbl_presentAddress`(`name`, `email`, `address`, `city`, `country`, `zipCode`, `telephone`) 
        VALUES (?,?,?,?,?,?,?)";
        $dataSet = [$name, $email, $address, $city, $country, $zipCode, $telephone];

        $driver = $this->adapter->getDriver();
        $statement = $driver->createStatement();
        $statement->prepare($sqlQuery);
        $statement->execute($dataSet);
        return $driver->getConnection()->getLastGeneratedValue();
    }
       

}