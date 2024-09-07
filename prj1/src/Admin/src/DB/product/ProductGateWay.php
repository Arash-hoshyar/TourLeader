<?php

namespace Admin\DB\product;

use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\Adapter\Driver\ResultInterface;
use Laminas\Db\ResultSet\ResultSet;
use Laminas\Db\Sql\Select;
use Laminas\Db\TableGateway\TableGateway;

class ProductGateWay extends TableGateway
{
    public function __construct(AdapterInterface $adapter)
    {
        parent::__construct('tbl_product', $adapter);
    }

    public function getALLProduct(): array
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
            GROUP by product_id;
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

    public function getALLProductById(int|string $id): array
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
            $output = $row->getArrayCopy();
        }
        return $output;
    }
public function getALLProductByIds(int|string $id): array
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

    public function getALLProductByCategoryId(int $id): array
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
            WHERE tbl_product.category_id = ?
            GROUP by product_id;
        "
        );
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

    public function updateProductById(
        int $id,
        string $name,
        string $label,
        string $brand_id,
        string $description,
        int $price,
        string $height,
        string $width,
        string $category_id,
        string $package
    ): ResultInterface {
        $driver = $this->adapter->getDriver();
        $statement = $driver->createStatement(
            '
                    UPDATE `tbl_product` SET `name` = ? ,
                         `label` = ?,`brand_id` = ?,
                         `description` = ?,`price` = ?,
                         `height` = ?,`width` = ?,
                         `category_id` = ?,`package` = ? WHERE id = ?
        '
        );
        $statement->prepare();

        return $statement->execute(
            [$name, $label, $brand_id, $description, $price, $height, $width, $category_id, $package, $id]
        );
    }

    public function getProduct(int $id): array
    {
        $driver = $this->adapter->getDriver();
        $statement = $driver->createStatement(
            "SELECT tbl_product.id, tbl_product.name, tbl_product.label, tbl_product.description 
         , tbl_product.price as price, tbl_product.height, tbl_product.width, tbl_product.package, tbl_product.category_id
         , tbl_product.brand_id, GROUP_CONCAT(tbl_material.id) AS material_id FROM tbl_product left JOIN tbl_brand on tbl_brand.id = tbl_product.brand_id 
         LEFT JOIN tbl_category ON tbl_category.id = tbl_product.category_id 
         left join tbl_product_material_category on tbl_product_material_category.product_id = tbl_product.id 
         LEFT JOIN tbl_material ON tbl_material. id = tbl_product_material_category.material_id WHERE tbl_product.id = ? GROUP by product_id;
        "
        );
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

    public function deleteProduct(string $id): string
    {
        return $this->delete(['id' => $id]);
    }

    public function deleteProductWithCategory_id(string $id): string
    {
        return $this->delete(['category_id' => $id]);
    }

    public function deleteProductWithMaterial(string $id): string
    {
        return $this->delete(['material' => $id]);
    }

    public function deleteProductWithBrand_id(string $id): string
    {
        return $this->delete(['brand_id' => $id]);
    }


    public function addProduct(
        string $name,
        string $label,
        string $brand_id,
        string $description,
        int $price,
        string $height,
        string $width,
        string $category_id,
        string $package
    ): int {
        $this->insert([
            'name' => $name,
            'label' => $label,
            'brand_id' => $brand_id,
            'description' => $description,
            'price' => $price,
            'height' => $height,
            'width' => $width,
            'category_id' => $category_id,
            'package' => $package,
        ]);
        return $this->getLastInsertValue();
    }

    public function count(): array
    {
        $driver = $this->adapter->getDriver();
        $statement = $driver->createStatement(
            "
                    select count(*) as count from tbl_product
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

    public function getALlProductWithOffset(int $offset): array
    {
        $driver = $this->adapter->getDriver();
        $statement = $driver->createStatement(
            "SELECT tbl_product.id, tbl_product.name, tbl_product.label, tbl_product.description , 
        tbl_product.price as price,
           tbl_product.height, tbl_product.width, tbl_product.package, tbl_brand.name AS 
           brand_name,
           tbl_category.name AS category_name,
           GROUP_CONCAT(tbl_material.name) AS material_name FROM tbl_product
            left JOIN tbl_brand on tbl_brand.id = tbl_product.brand_id 
            LEFT JOIN tbl_category ON tbl_category.id = tbl_product.category_id 
            left join tbl_product_material_category on 
            tbl_product_material_category.product_id = tbl_product.id 
            LEFT JOIN tbl_material ON tbl_material. id = 
            tbl_product_material_category.material_id
                        GROUP by product_id
                        
            ORDER BY tbl_product.id desc limit 6 offset $offset;
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


}