<?php

namespace App\DB\gateWay\cartRelatedGateWay;

use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\Adapter\Driver\ResultInterface;
use Laminas\Db\ResultSet\ResultSet;
use Laminas\Db\TableGateway\TableGateway;

class CartPriceGateWay extends TableGateway
{
    public function __construct(AdapterInterface $adapter)
    {
        parent::__construct('tbl_cart_price', $adapter);
    }

    public function selectCart(string $Session): array
    {
        $result = $this->select([
            'sessionUser' => $Session,
        ]);
        $output = [];

        foreach ($result as $row) {
            $output[] = [
                'id' => $row->id,
                'product_id_cart' => $row->product_id_cart,
                'sessionUser' => $row->sessionUser,
            ];
        }
        return $output;
    }

    public function addCart(int $productId, int $price, string $session, int $count): ResultInterface
    {
        $sqlQuery = "INSERT INTO `tbl_cart_price`(`product_id_cart`, `price`, `session`, `count`) VALUES (?,?,?,?)";
        $dataSet = [$productId, $price, $session, $count];

        $driver = $this->adapter->getDriver();
        $statement = $driver->createStatement();
        $statement->prepare($sqlQuery);

        return $statement->execute($dataSet);
    }

    public function getALLCartByproductIds(int $ids): array
    {
        if (empty($ids)) {
            return [];
        }

        $sqlQuery = "SELECT tbl_product.id, tbl_product.name, tbl_product.label, tbl_product.description , tbl_product.price as price,
           tbl_product.height, tbl_product.width, tbl_product.package ,SUM(tbl_cart_price.price) AS claim_value FROM tbl_product
            LEFT JOIN tbl_cart_price ON tbl_cart_price.product_id_cart = tbl_product.id         
            WHERE tbl_product.id = ($ids);
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

    public function getALLCartCount(int $id): array
    {
        $sqlQuery = "select count(*) as count from tbl_cart_price WHERE product_id_cart = ? ;";

        $driver = $this->adapter->getDriver();
        $statement = $driver->createStatement($sqlQuery);
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

    public function updateCartBySession(string $session, string $cookie): ResultInterface
    {
        $driver = $this->adapter->getDriver();
        $statement = $driver->createStatement('UPDATE `tbl_cart_price` SET `sessionUser`= ? WHERE sessionUser = ?');
        $statement->prepare();

        return $statement->execute([$session, $cookie]);
    }

    public function deleteCart(string $ids, string $session): ResultInterface
    {
        $driver = $this->adapter->getDriver();
        $statement = $driver->createStatement(
            "DELETE FROM `tbl_cart_price` WHERE product_id_cart IN ($ids) and session in ('$session')"
        );
        $statement->prepare();
        return $statement->execute();
    }


}