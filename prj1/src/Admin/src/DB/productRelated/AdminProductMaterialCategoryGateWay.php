<?php

namespace Admin\DB\productRelated;

use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\Adapter\Driver\ResultInterface;
use Laminas\Db\ResultSet\ResultSet;
use Laminas\Db\TableGateway\TableGateway;

class AdminProductMaterialCategoryGateWay extends TableGateway
{
    public function __construct(AdapterInterface $adapter)
    {
        parent::__construct('tbl_product_material_category', $adapter);
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

    public function deleteMaterial(int $id): ResultInterface
    {
        $driver = $this->adapter->getDriver();
        $statement = $driver->createStatement('DELETE FROM `tbl_product_material_category` WHERE product_id =  ?');
        $statement->prepare();

        return $statement->execute([$id]);
    }
public function deleteMaterialByMaterialId(int $id): ResultInterface
    {
        $driver = $this->adapter->getDriver();
        $statement = $driver->createStatement('DELETE FROM `tbl_product_material_category` WHERE material_id =  ?');
        $statement->prepare();

        return $statement->execute([$id]);
    }

    public function getProductMaterialByproductId(int $id): array
    {
        $sqlQuery = "SELECT * FROM `tbl_product_material_category` WHERE product_id = ?";

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

    public function updateProductMaterialCategoryById(int $materialId): ResultInterface
    {
        $driver = $this->adapter->getDriver();
        $statement = $driver->createStatement(
            'UPDATE `tbl_product_material_category` SET `material_id`=? WHERE `material_id`=?'
        );
        $statement->prepare();

        return $statement->execute([ $materialId, $materialId]);
    }

    public function insertProductMaterialCategoryById(int $id, string $categoryId, string $materialId): ResultInterface
    {
        $driver = $this->adapter->getDriver();
        $statement = $driver->createStatement(
            'INSERT INTO `tbl_product_material_category`( `product_id`, `category_id`, `material_id`) VALUES (?,?,?)'
        );
        $statement->prepare();

        return $statement->execute([$id, $categoryId, $materialId]);
    }

    public function selectByMaterialAndCategory(string $materialIds, string $categoryIds): array
    {
        $sqlQuery = "SELECT * FROM `tbl_product_material_category` WHERE material_id IN ($materialIds) AND category_id IN($categoryIds);";

        $driver = $this->adapter->getDriver();
        $statement = $driver->createStatement($sqlQuery);
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

    public function addProductMaterial(string $productId, string $category_id, string $materialId): int
    {
        $this->insert([
            'product_id' => $productId,
            'category_id' => $category_id,
            'material_id' => $materialId,
        ]);
        return $this->getLastInsertValue();
    }
}