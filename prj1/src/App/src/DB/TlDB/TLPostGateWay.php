<?php

namespace App\DB\TlDB;

use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\Adapter\Driver\ResultInterface;
use Laminas\Db\ResultSet\ResultSet;
use Laminas\Db\TableGateway\TableGateway;

class TLPostGateWay extends TableGateway
{
    public function __construct(AdapterInterface $adapter)
    {
        parent::__construct('tbl_post', $adapter);
    }

    public function getALLPost(): array
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

    public function getPost(int $id): array
    {
        $result = $this->select([
            'id' => $id,
        ]);
        return $result->current()?->getArrayCopy();
    }

    public function updatePostById(int $id, string $name, string $url, string|null $logo = null): ResultInterface
    {
        $sqlQuery = 'UPDATE `tbl_post` SET `lable`= ?,`img`= ?,`about`= ? WHERE id = ?';
        $dataSet = [$name, $logo, $url, $id];

        if ($logo === null) {
            $sqlQuery = 'UPDATE `tbl_post` SET `lable`= ?,`about`= ? WHERE id = ?';
            $dataSet = [$name, $url, $id];
        }
        $driver = $this->adapter->getDriver();
        $statement = $driver->createStatement();
        $statement->prepare($sqlQuery);

        return $statement->execute($dataSet);


    }

    public function getALlPostWithOffset(int $offset): array
    {
        $driver = $this->adapter->getDriver();
        $statement = $driver->createStatement(
            "
            SELECT * FROM `tbl_post` ORDER BY tbl_post.id asc limit 6 offset $offset;
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
                    select count(*) as count from tbl_post
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
    public function deletePost(string $id): string
    {
        return $this->delete(['id' => $id]);
    }

    public function addPost(string $name, string $logo, string $url): int
    {
        $this->insert([
            'lable' => $name,
            'img' => $logo,
            'about' => $url,
        ]);
        return $this->getLastInsertValue();
    }
}