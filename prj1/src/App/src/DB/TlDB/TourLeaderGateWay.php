<?php

namespace App\DB\TlDB;

use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\Adapter\Driver\ResultInterface;
use Laminas\Db\ResultSet\ResultSet;
use Laminas\Db\TableGateway\TableGateway;

class TourLeaderGateWay extends TableGateway
{
    public function __construct(AdapterInterface $adapter)
    {
        parent::__construct('tbl_tourLeader_infomation', $adapter);
    }
    public function allGuids(): array|null
    {
        $result = $this->select();
        $output = [];

        foreach ($result as $row) {
            $output[] = [
                'Name' => $row->Name,
                'city' => $row->city,
            ];
        }
        return $output;
    }
    public function login(string $email, string $password): array|null
    {
        $result = $this->select([
            'email' => $email,
            'password' => hash('sha512', $password . 'LBF')
        ]);
        return $result->current()?->getArrayCopy();
    }
    public function loginWithEmail(string $email): array|null
    {
        $result = $this->select([
            'email' => $email,
        ]);
        return $result->current()?->getArrayCopy();
    }

    public function findId(string $email, string $password): array|null
    {
        $result = $this->select([
            'email' => $email,
            'password' => hash('sha512', $password . 'LBF')
        ]);
        return $result->current()?->getArrayCopy();
    }

    public function findTL(int $id): array|null
    {
        $sqlQuery = "SELECT `id`,`email`, `realPassword` FROM tbl_tourLeader_infomation WHERE id = ?";

        $driver = $this->adapter->getDriver();
        $statement = $driver->createStatement($sqlQuery);
        $statement->prepare();
        $result = $statement->execute([$id]);

        $resultSet = new ResultSet();
        $resultSet->initialize($result);

        $output = [];
        foreach ($resultSet as $row) {
            $output = $row->getArrayCopy();
        }
        return $output;
    }
    public function TLInfo(string $email): array|null
    {
        $sqlQuery = "SELECT * FROM tbl_tourLeader_infomation WHERE email = ?";

        $driver = $this->adapter->getDriver();
        $statement = $driver->createStatement($sqlQuery);
        $statement->prepare();
        $result = $statement->execute([$email]);

        $resultSet = new ResultSet();
        $resultSet->initialize($result);

        $output = [];
        foreach ($resultSet as $row) {
            $output = $row->getArrayCopy();
        }
        return $output;
    }

    public function signup(string $email, string $password): int
    {
        $this->insert([
            'email' => $email,
            'password' => hash('sha512', $password . 'LBF'),
            'realPassword' => $password,

        ]);
        return $this->getLastInsertValue();
    }



    public function fullSignup(
        string $name,
        string $email,
        string $password,
        string $age,
        string $country,
        string $city,
        string $number,
        string $Language,
        int $id
    ): ResultInterface {
        $driver = $this->adapter->getDriver();
        $statement = $driver->createStatement(
            '
UPDATE `tbl_tourLeader_infomation` SET `Name`= ? ,`email`= ? ,`password`= ? ,`realPassword`= ? ,
                                       `age`= ? ,`country`= ?,`city`= ?,`number`= ? ,`Language`= ? WHERE id = ?'
        );
        $statement->prepare();

        return $statement->execute(
            [$name, $email, hash('sha512', $password . 'LBF'), $password, $age, $country, $city, $number, $Language,$id]
        );
    }


}