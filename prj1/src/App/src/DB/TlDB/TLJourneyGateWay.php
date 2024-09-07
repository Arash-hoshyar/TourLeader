<?php

namespace Admin\DB\product;

use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\Adapter\Driver\ResultInterface;
use Laminas\Db\ResultSet\ResultSet;
use Laminas\Db\TableGateway\TableGateway;

class BrandGateWay extends TableGateway
{
    public function __construct(AdapterInterface $adapter)
    {
        parent::__construct('tbl_brand', $adapter);
    }

    public function getALLBrands(): array
    {
        $result = $this->select();
        $output = [];

        foreach ($result as $row) {
            $output[] = [
                'id' => $row->id,
                'name' => $row->name,
                'logo' => $row->logo,
                'url' => $row->url,
            ];
        }
        return $output;
    }

    public function getBrand(int $id): array
    {
        $result = $this->select([
            'id' => $id,
        ]);
        return $result->current()?->getArrayCopy();
    }

    public function updateBrandById(int $id, string $name, string $url, string|null $logo = null): ResultInterface
    {
        $sqlQuery = 'UPDATE `tbl_brand` SET `name`= ?,`logo`= ?,`url`= ? WHERE id = ?';
        $dataSet = [$name, $logo, $url, $id];

        if ($logo === null) {
            $sqlQuery = 'UPDATE `tbl_brand` SET `name`= ?,`url`= ? WHERE id = ?';
            $dataSet = [$name, $url, $id];
        }
        $driver = $this->adapter->getDriver();
        $statement = $driver->createStatement();
        $statement->prepare($sqlQuery);

        return $statement->execute($dataSet);


    }

    public function getALlBrandWithOffset(int $offset): array
    {
        $driver = $this->adapter->getDriver();
        $statement = $driver->createStatement(
            "
            SELECT * FROM `tbl_brand` ORDER BY tbl_brand.id asc limit 6 offset $offset;
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
                    select count(*) as count from tbl_brand
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
    public function deleteBrand(string $id): string
    {
        return $this->delete(['id' => $id]);
    }

    public function addBrand(string $name, string $logo, string $url): int
    {
        $this->insert([
            'name' => $name,
            'logo' => $logo,
            'url' => $url,
        ]);
        return $this->getLastInsertValue();
    }
}