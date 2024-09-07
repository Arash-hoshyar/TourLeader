<?php

namespace App\DB\gateWay\userGateWay\userBillInfo;

use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\ResultSet\ResultSet;
use Laminas\Db\TableGateway\TableGateway;

class UserProductCartGateWay extends TableGateway
{
    public function __construct(AdapterInterface $adapter)
    {
        parent::__construct('tbl_product_user_cart', $adapter);
    }

    public function addProduct(
        string $name,
        string $label,
        string $brand,
        string $description,
        int $price,
        int $height,
        int $width,
        string $category,
        string $package,
        string $materials,
        int $total,
        string $session
    ): int {
        $this->insert(
            [
                'name' => $name,
                'label' => $label,
                'brand' => $brand,
                'description' => $description,
                'price' => $price,
                'height' => $height,
                'width' => $width,
                'category' => $category,
                'package' => $package,
                'materials' => $materials,
                'whole_price' => $total,
                'session' => $session,
            ]
        );
        return $this->lastInsertValue;
    }

    public function getALLUserProductByIds(string $Session): array
    {
        $result = $this->select([
            'session' => $Session,
        ]);
        $output = [];

        foreach ($result as $row) {
            $output[] = [
                'id' => $row->id,
                'name' => $row->name,
                'label' => $row->label,
                'brand' => $row->brand,
                'description' => $row->description,
                'price' => $row->price,
                'height' => $row->height,
                'width' => $row->width,
                'category' => $row->category,
                'package' => $row->package,
                'materials' => $row->materials,
                'whole_price' => $row->whole_price,
                'session' => $row->session,
            ];
        }
        return $output;
    }

}