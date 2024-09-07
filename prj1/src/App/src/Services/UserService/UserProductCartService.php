<?php

declare(strict_types=1);

namespace App\Services\UserService;

use App\DB\gateWay\userGateWay\userBillInfo\UserAddressGateWay;
use App\DB\gateWay\userGateWay\userBillInfo\UserProductCartGateWay;
use Laminas\Db\Adapter\Driver\ResultInterface;

class UserProductCartService
{


    public function __construct(private UserProductCartGateWay $userProductCartGateWay)
    {
    }


    public function addProduct
    (
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
        return $this->userProductCartGateWay->addProduct
        (
            $name,
            $label,
            $brand,
            $description,
            $price,
            $height,
            $width,
            $category,
            $package,
            $materials,
            $total,
            $session
        );
    }

    public function getALLUserProductByIds
    (
        string $Session
    ): array {
        return $this->userProductCartGateWay->getALLUserProductByIds($Session);
    }
}