<?php

namespace Admin\DB\productRelated;

use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\Adapter\Driver\ResultInterface;
use Laminas\Db\ResultSet\ResultSet;
use Laminas\Db\TableGateway\TableGateway;

class TopSellerGateWay extends TableGateway
{
    public function __construct(AdapterInterface $adapter)
    {
        parent::__construct('tbl_top_selling', $adapter);
    }



    public function getALLProductById(string $id): array
    {
        $driver = $this->adapter->getDriver();
        $statement = $driver->createStatement(
            "
    SELECT tbl_product.id, tbl_product.name, tbl_product.label, tbl_product.description , tbl_product.price as price,
           tbl_product.height, tbl_product.width, tbl_product.package, tbl_brand.name AS brand_name,
           tbl_category.name AS category_name,
           GROUP_CONCAT(tbl_material.name) AS material_name FROM tbl_product
            left JOIN tbl_brand on tbl_brand.id = tbl_product.brand_id 
            LEFT JOIN tbl_category ON tbl_category.id = tbl_product.category_id 
            left join tbl_product_material_category on tbl_product_material_category.product_id = tbl_product.id 
            LEFT JOIN tbl_material ON tbl_material. id = tbl_product_material_category.material_id
            WHERE tbl_product.id in ($id)
            GROUP by product_id;
        "
        );
        $statement->prepare();
        $result = $statement->execute();

        $resultSet = new ResultSet();
        $resultSet->initialize($result);
        $output = [];
        foreach ($resultSet as $row) {
            $output[] = $row->getArrayCopy();
        }
        return $output;
    }

    public function getALLTopSeller(): array
    {
        $result = $this->select();
        $output = [];

        foreach ($result as $row) {
            $output[] = [
                'id' => $row->id,
                'product_id' => $row->product_id,
            ];
        }
        return $output;
    }

    public function deleteTopSeller(string $id): string
    {
        return $this->delete(['product_id' => $id]);
    }

    public function getTopSeller(int $id): array
    {
        $result = $this->select([
            'id' => $id,
        ]);
        return $result->current()?->getArrayCopy();
    }

    public function getTopSellerByName(string $productIds): array|null
    {
        $result = $this->select([
            'product_id' => $productIds,
        ]);
        return $result->current()?->getArrayCopy();
    }

    public function updateTopSellerById(int $id, string $productIds): ResultInterface
    {
        $driver = $this->adapter->getDriver();
        $statement = $driver->createStatement('UPDATE `tbl_category` SET `product_id`= ? WHERE id = ?');
        $statement->prepare();

        return $statement->execute([$productIds, $id]);
    }
    public function getALlTopSellerWithOffset(int $offset): array
    {
        $driver = $this->adapter->getDriver();
        $statement = $driver->createStatement(
            "
            SELECT * FROM `tbl_top_selling` ORDER BY tbl_top_selling.id asc limit 6 offset $offset;
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
                    select count(*) as count from tbl_top_selling
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

    public function addTopSeller(int $productIds): int
    {
        $this->insert([
            'product_id' => $productIds,
        ]);
        return $this->getLastInsertValue();
    }
}