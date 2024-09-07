<?php

namespace App\DB\gateWay\userGateWay\userBillInfo;

use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\ResultSet\ResultSet;
use Laminas\Db\TableGateway\TableGateway;

class UserPurchaseInfoGateWay extends TableGateway
{
    public function __construct(AdapterInterface $adapter)
    {
        parent::__construct('tbl_purchase_infomation', $adapter);
    }

    public function addPurchaseInfo(
        int $productIds,
        int $billingInfo,
        string $session
    ): int {
        $this->insert(
            [
                'tbl_product_user_ids' => $productIds,
                'user_billing_info_id' => $billingInfo,
                'session' => $session,
            ]
        );
        return $this->lastInsertValue;
    }

    public function getALLProductByIds(string $ids): array
    {
        if (empty($ids)) {
            return [];
        }

        $sqlQuery = "SELECT tbl_product_user_cart.id,tbl_product_user_cart.name,tbl_product_user_cart.label,tbl_product_user_cart.category,tbl_product_user_cart.brand,tbl_product_user_cart.materials,tbl_product_user_cart.description,tbl_product_user_cart.whole_price,tbl_product_user_cart.price,tbl_product_user_cart.width,tbl_product_user_cart.height,tbl_product_user_cart.package , tbl_user_billing_address.id AS userBillingId,
tbl_user_billing_address.name AS userBillinName,tbl_user_billing_address.address AS userBillinAddress,tbl_user_billing_address.email AS userBillinEmail,tbl_user_billing_address.city AS userBillinCity,tbl_user_billing_address.country AS userBillinCountry,tbl_user_billing_address.zipCode AS userBillinZipCode,tbl_user_billing_address.telephone AS userBillinTelephone
FROM `tbl_purchase_infomation` 
LEFT JOIN tbl_user_billing_address on tbl_user_billing_address.id = tbl_purchase_infomation.user_billing_info_id
LEFT JOIN tbl_product_user_cart ON tbl_product_user_cart.id = tbl_purchase_infomation.tbl_product_user_ids
WHERE tbl_purchase_infomation.id = ?;
            ";

        $driver = $this->adapter->getDriver();
        $statement = $driver->createStatement($sqlQuery);
        $statement->prepare();
        $result = $statement->execute([$ids]);

        $resultSet = new ResultSet();
        $resultSet->initialize($result);

        $output = [];
        foreach ($resultSet as $row) {
            $output[] = $row->getArrayCopy();
        }
        return $output;
    }

    public function getALLProduct(): array
    {
        $sqlQuery = "SELECT tbl_product_user_cart.id,tbl_product_user_cart.name,tbl_product_user_cart.label,tbl_product_user_cart.category,tbl_product_user_cart.brand,tbl_product_user_cart.materials,tbl_product_user_cart.description,tbl_product_user_cart.whole_price,tbl_product_user_cart.price,tbl_product_user_cart.width,tbl_product_user_cart.height,tbl_product_user_cart.package , tbl_user_billing_address.id AS userBillingId,
tbl_user_billing_address.name AS userBillinName,tbl_user_billing_address.address AS userBillinAddress,tbl_user_billing_address.email AS userBillinEmail,tbl_user_billing_address.city AS userBillinCity,tbl_user_billing_address.country AS userBillinCountry,tbl_user_billing_address.zipCode AS userBillinZipCode,tbl_user_billing_address.telephone AS userBillinTelephone
FROM `tbl_purchase_infomation` 
LEFT JOIN tbl_user_billing_address on tbl_user_billing_address.id = tbl_purchase_infomation.user_billing_info_id
LEFT JOIN tbl_product_user_cart ON tbl_product_user_cart.id = tbl_purchase_infomation.tbl_product_user_ids
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

}