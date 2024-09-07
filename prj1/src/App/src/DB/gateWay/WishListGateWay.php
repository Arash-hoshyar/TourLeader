<?php

namespace App\DB\gateWay;

use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\Adapter\Driver\ResultInterface;
use Laminas\Db\ResultSet\ResultSet;
use Laminas\Db\TableGateway\TableGateway;
use PHP_CodeSniffer\Standards\Squiz\Tests\CSS\OpacityUnitTest;

class WishListGateWay extends TableGateway
{
    public function __construct(AdapterInterface $adapter)
    {
        parent::__construct('tbl_wishlist', $adapter);
    }

    public function selectWishlist(string $Session): array
    {
        $result = $this->select([
            'sessionUser' => $Session,
        ]);
        $output = [];

        foreach ($result as $row) {
            $output[] = [
                'id' => $row->id,
                'product_id' => $row->product_id,
                'sessionUser' => $row->sessionUser,
            ];
        }
        return $output;
    }

    public function addWishlist(int $productId, string $session): ResultInterface
    {
        $sqlQuery = "INSERT INTO `tbl_wishlist`(`product_id`, `sessionUser`) VALUES (?,?)";
        $dataSet = [$productId, $session];

        $driver = $this->adapter->getDriver();
        $statement = $driver->createStatement();
        $statement->prepare($sqlQuery);

        return $statement->execute($dataSet);
    }

    public function getALLWishlistByproductIds(string $ids): array
    {
        if (empty($ids)) {
            return [];
        }

        $sqlQuery = "
    SELECT tbl_product.id, tbl_product.name, tbl_product.label, tbl_product.description , tbl_product.price as price,
           tbl_product.height, tbl_product.width, tbl_product.package, tbl_brand.name AS brand_name,
           tbl_category.name AS category_name,
           GROUP_CONCAT(tbl_material.name) AS material_name FROM tbl_product
            left JOIN tbl_brand on tbl_brand.id = tbl_product.brand_id 
            LEFT JOIN tbl_category ON tbl_category.id = tbl_product.category_id 
            left join tbl_product_material_category on tbl_product_material_category.product_id = tbl_product.id 
            LEFT JOIN tbl_material ON tbl_material. id = tbl_product_material_category.material_id
            WHERE tbl_product.id in ($ids)
            GROUP by product_id;
            ";

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

    public function updateWishlistBySession(string $session, string $cookie): ResultInterface
    {
        $driver = $this->adapter->getDriver();
        $statement = $driver->createStatement('UPDATE `tbl_wishlist` SET `sessionUser`= ? WHERE sessionUser = ?');
        $statement->prepare();

        return $statement->execute([$session, $cookie]);
    }

    public function deleteWishlist(string $ids, string $session): ResultInterface
    {
        $driver = $this->adapter->getDriver();
        $statement = $driver->createStatement(
            "DELETE FROM `tbl_wishlist` WHERE product_id IN ($ids) and sessionUser in ('$session')"
        );
        $statement->prepare();
        return $statement->execute();
    }


}