<?php

declare(strict_types=1);

namespace App\Services\UserService;

use App\DB\gateWay\userGateWay\userBillInfo\UserAddressGateWay;
use App\DB\gateWay\userGateWay\userBillInfo\UserProductCartGateWay;
use App\DB\gateWay\userGateWay\userBillInfo\UserPurchaseInfoGateWay;
use Laminas\Db\Adapter\Driver\ResultInterface;

class UserPurchaseInfoService
{


    public function __construct(private UserPurchaseInfoGateWay $userPurchaseInfoGateWay)
    {
    }


    public function addPurchaseInfo
    (
        int $productIds,
        int $billingInfo,
        string $session
    ): int {
        return $this->userPurchaseInfoGateWay->addPurchaseInfo
        (
            $productIds,
            $billingInfo,
            $session
        );
    }

    public function getALLProductByIds
    (
        string $ids,
    ): array {
        return $this->userPurchaseInfoGateWay->getALLProductByIds($ids);
    }

    public function getALLProduct
    (): array
    {
        return $this->userPurchaseInfoGateWay->getALLProduct();
    }
}