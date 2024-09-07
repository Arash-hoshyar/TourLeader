<?php

namespace App\DB\TlDB;

use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\Adapter\Driver\ResultInterface;
use Laminas\Db\ResultSet\ResultSet;
use Laminas\Db\TableGateway\TableGateway;

class TLToursGateWay extends TableGateway
{
    public function __construct(AdapterInterface $adapter)
    {
        parent::__construct('tbl_tours', $adapter);
    }

    public function getALLTour(): array
    {
        $result = $this->select();
        $output = [];

        foreach ($result as $row) {
            $output[] = [
                'id' => $row->id,
                'lable' => $row->lable,
                'img' => $row->img,
                'price' => $row->price,
                'days' => $row->days,
                'place' => $row->place,
                'description' => $row->description,
                'tourGuide' => $row->tourGuide,
            ];
        }
        return $output;
    }

    public function getTour(int $id): array
    {
        $result = $this->select([
            'id' => $id,
        ]);
        return $result->current()?->getArrayCopy();
    }

    public function updateTourById(
        int $id,
        string $name,
        int $price,
        int $days,
        string $place,
        string $description,
        string|null $logo = null
    ): ResultInterface {
        $sqlQuery = 'UPDATE `tbl_tours` SET `lable`= ?,`img`= ?,`price`= ?,`days`= ?,`place`= ?,`description`= ? WHERE id = ?';
        $dataSet = [$name, $logo, $price, $days, $place, $description, $id];

        if ($logo === null) {
            $sqlQuery = 'UPDATE `tbl_tours` SET `lable`= ?,`price`= ?,`days`= ?,`place`= ?,`description`= ? WHERE id = ?';
            $dataSet = [$name, $price, $days, $place, $description, $id];
        }
        $driver = $this->adapter->getDriver();
        $statement = $driver->createStatement();
        $statement->prepare($sqlQuery);

        return $statement->execute($dataSet);
    }

    public function getALlTourWithOffset(int $offset): array
    {
        $driver = $this->adapter->getDriver();
        $statement = $driver->createStatement(
            "
            SELECT * FROM `tbl_tours` ORDER BY tbl_tours.id asc limit 6 offset $offset;
        "
        );
        $statement->prepare();
        $result = $statement->execute();

        $resultSet = new ResultSet();
        $resultSet->initialize($result);
        $output = [];
        foreach ($resultSet as $row) {
            $output [] = $row->getArrayCopy();
        }
        return $output;
    }

    public function count(): array
    {
        $driver = $this->adapter->getDriver();
        $statement = $driver->createStatement(
            "
                    select count(*) as count from tbl_tours
       "
        );
        $statement->prepare();
        $result = $statement->execute();
        $resultSet = new ResultSet();
        $resultSet->initialize($result);
        $output = [];
        foreach ($resultSet as $row) {
            $output = $row->getArrayCopy();
        }
        return $output;
    }

    public function deleteTour(string $id): string
    {
        return $this->delete(['id' => $id]);
    }

    public function addTour(
        string $name,
        string $logo,
        int $price,
        int $days,
        string $place,
        string $description,
        string $tourGuide,
    ): int {
        $this->insert([
            'lable' => $name,
            'img' => $logo,
            'price' => $price,
            'days' => $days,
            'place' => $place,
            'description' => $description,
            'tourGuide' => $tourGuide,

        ]);
        return $this->getLastInsertValue();
    }
}