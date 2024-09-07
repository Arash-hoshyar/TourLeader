<?php

namespace App\DB\TlDB;

use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\Adapter\Driver\ResultInterface;
use Laminas\Db\ResultSet\ResultSet;
use Laminas\Db\TableGateway\TableGateway;

class TLJourneyGateWay extends TableGateway
{
    public function __construct(AdapterInterface $adapter)
    {
        parent::__construct('tbl_journey', $adapter);
    }

    public function getALLJourney(): array
    {
        $result = $this->select();
        $output = [];

        foreach ($result as $row) {
            $output[] = [
                'id' => $row->id,
                'lable' => $row->lable,
                'img' => $row->img,
                'about' => $row->about,
            ];
        }
        return $output;
    }

    public function getJourney(int $id): array
    {
        $result = $this->select([
            'id' => $id,
        ]);
        return $result->current()?->getArrayCopy();
    }

    public function updateJourneyById(int $id, string $name, string $url, string|null $logo = null): ResultInterface
    {
        $sqlQuery = 'UPDATE `tbl_journey` SET `lable`= ?,`img`= ?,`about`= ? WHERE id = ?';
        $dataSet = [$name, $logo, $url, $id];

        if ($logo === null) {
            $sqlQuery = 'UPDATE `tbl_journey` SET `lable`= ?,`about`= ? WHERE id = ?';
            $dataSet = [$name, $url, $id];
        }
        $driver = $this->adapter->getDriver();
        $statement = $driver->createStatement();
        $statement->prepare($sqlQuery);

        return $statement->execute($dataSet);


    }

    public function getALlJourneyWithOffset(int $offset): array
    {
        $driver = $this->adapter->getDriver();
        $statement = $driver->createStatement(
            "
            SELECT * FROM `tbl_journey` ORDER BY tbl_journey.id asc limit 6 offset $offset;
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
                    select count(*) as count from tbl_journey
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
    public function deleteJourney(string $id): string
    {
        return $this->delete(['id' => $id]);
    }

    public function addJourney(string $name, string $logo, string $url): int
    {
        $this->insert([
            'lable' => $name,
            'img' => $logo,
            'about' => $url,
        ]);
        return $this->getLastInsertValue();
    }
}