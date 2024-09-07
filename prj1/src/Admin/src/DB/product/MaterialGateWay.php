<?php

namespace Admin\DB\product;

use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\Adapter\Driver\ResultInterface;
use Laminas\Db\ResultSet\ResultSet;
use Laminas\Db\TableGateway\TableGateway;

class MaterialGateWay extends TableGateway
{
    public function __construct(AdapterInterface $adapter)
    {
        parent::__construct('tbl_material', $adapter);
    }

    public function getALLMaterial(): array
    {
        $result = $this->select();
        $output = [];

        foreach ($result as $row) {
            $output[] = [
                'id' => $row->id,
                'name' => $row->name,
            ];
        }
        return $output;
    }

    public function count(): array
    {
        $driver = $this->adapter->getDriver();
        $statement = $driver->createStatement(
            "
                    select count(*) as count from tbl_material
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

    public function getALlMaterialWithOffset(int $offset): array
    {
        $driver = $this->adapter->getDriver();
        $statement = $driver->createStatement(
            "
                        SELECT * FROM `tbl_material` ORDER BY tbl_material.id asc limit 6 offset $offset;
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

    public function findMaterialById(int $category_id): array|null
    {
        $result = $this->select([
            'id' => $category_id,
        ]);

        return $result->current()?->getArrayCopy();
    }

    public function deleteMaterial(string $id): string
    {
        return $this->delete(['id' => $id]);
    }

    public function getMaterial(int $id): array
    {
        $result = $this->select([
            'id' => $id,
        ]);
        return $result->current()?->getArrayCopy();
    }

    public function updateMaterialById(int $id, string $name): ResultInterface
    {
        $driver = $this->adapter->getDriver();
        $statement = $driver->createStatement('UPDATE `tbl_material` SET `name`= ? WHERE id = ?');
        $statement->prepare();

        return $statement->execute([$name, $id]);
    }

    public function addMaterial(string $name): int
    {
        $this->insert([
            'name' => $name,
        ]);
        return $this->getLastInsertValue();
    }
}