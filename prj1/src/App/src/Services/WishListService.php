<?php

declare(strict_types=1);

namespace App\Services;

use App\DB\gateWay\WishListGateWay;
use Laminas\Db\Adapter\Driver\ResultInterface;

class WishListService
{


    public function __construct(private WishListGateWay $wishListGateWay)
    {
    }


    public function selectWishlist(string $session): array
    {
        return $this->wishListGateWay->selectWishlist($session);
    }

    public function addWishlist(int $productId, string $session): ResultInterface
    {
        return $this->wishListGateWay->addWishlist($productId, $session);
    }

    /** @param string $ids comma separated Ids */
    public function getALLWishlistByproductIds(string $ids): array
    {
        return $this->wishListGateWay->getALLWishlistByproductIds($ids);
    }
    /** @param string $ids comma separated Ids */
    public function deleteWishlist(string $ids ,string $session): ResultInterface
    {
        return $this->wishListGateWay->deleteWishlist($ids,$session);
    }

    public function updateWishlistBySession(string $session, string $cookie): ResultInterface
    {
        return $this->wishListGateWay->updateWishlistBySession($session, $cookie);
    }
}