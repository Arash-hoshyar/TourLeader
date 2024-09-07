<?php

namespace App\DB\TlDB;

use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\Adapter\Driver\ResultInterface;
use Laminas\Db\ResultSet\ResultSet;
use Laminas\Db\TableGateway\TableGateway;

class MassageGateWay extends TableGateway
{
    public function __construct(AdapterInterface $adapter)
    {
        parent::__construct('tbl_massage', $adapter);
    }
    public function allMassageById(int $id): array|null
    {
        $sqlQuery = "SELECT * FROM tbl_massage WHERE postId = ?";

        $driver = $this->adapter->getDriver();
        $statement = $driver->createStatement($sqlQuery);
        $statement->prepare();
        $result = $statement->execute([$id]);

        $resultSet = new ResultSet();
        $resultSet->initialize($result);

        $output = [];
        foreach ($resultSet as $row) {
            $output[] = $row->getArrayCopy();
        }
        return $output;
    }

    public function addMassage(int $id, string $name, string $lable, string $massage): int
    {
        $this->insert([
            'postId' => $id,
            'name' => $name,
            'lable' => $lable,
            'massage' => $massage,

        ]);
        return $this->getLastInsertValue();
    }


}