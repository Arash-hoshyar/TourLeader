<?php

namespace Admin\DB\product;

use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\Adapter\Driver\ResultInterface;
use Laminas\Db\ResultSet\ResultSet;
use Laminas\Db\Sql\Where;
use Laminas\Db\TableGateway\TableGateway;

class CategoryGateWay extends TableGateway
{
    public function __construct(AdapterInterface $adapter)
    {
        parent::__construct('tbl_category', $adapter);
    }

    public function getALLCategory(): array
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

    public function deleteCategory(string $id): string
    {
        return $this->delete(['id' => $id]);
    }

    public function getALlCategoryWithOffset(int $offset): array
    {
        $driver = $this->adapter->getDriver();
        $statement = $driver->createStatement(
            "
            SELECT * FROM `tbl_category` ORDER BY tbl_category.id asc limit 6 offset $offset;
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
                    select count(*) as count from tbl_category
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

    public function getCategory(int $id): array
    {
        $result = $this->select([
            'id' => $id,
        ]);
        return $result->current()?->getArrayCopy();
    }

    public function getCategoryByName(string $name): array|null
    {
        $where = new Where();
        $where->like('name', '%' . $name . '%');
            $result = $this->select($where);
        return $result->current()?->getArrayCopy();
    }

    public function updateCategoryById(int $id, string $name): ResultInterface
    {
        $driver = $this->adapter->getDriver();
        $statement = $driver->createStatement('UPDATE `tbl_category` SET `name`= ? WHERE id = ?');
        $statement->prepare();

        return $statement->execute([$name, $id]);
    }

    public function addCategory(string $name): int
    {
        $this->insert([
            'name' => $name,
        ]);
        return $this->getLastInsertValue();
    }
}