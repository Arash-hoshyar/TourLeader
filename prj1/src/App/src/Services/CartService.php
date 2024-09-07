<?php

declare(strict_types=1);

namespace App\Services;

use App\DB\gateWay\cartRelatedGateWay\CartGateWay;
use Laminas\Db\Adapter\Driver\ResultInterface;

class CartService
{


    public function __construct(private CartGateWay $cartGateWay)
    {
    }


    public function selectCart(string $session): array
    {
        return $this->cartGateWay->selectCart($session);
    }

    public function getALLCartCount(int $id): array
    {
        return $this->cartGateWay->getALLCartCount($id);
    }

    public function addCart(int $productId, string $session): ResultInterface
    {
        return $this->cartGateWay->addCart($productId, $session);
    }

    /** @param string $ids comma separated Ids */
    public function getALLCartByproductIds(string $ids): array
    {
        return $this->cartGateWay->getALLCartByproductIds($ids);
    }

    /** @param string $ids comma separated Ids */
    public function deleteCart(string $ids, string $session): ResultInterface
    {
        return $this->cartGateWay->deleteCart($ids, $session);
    }

    public function updateCartBySession(string $session, string $cookie): ResultInterface
    {
        return $this->cartGateWay->updateCartBySession($session, $cookie);
    }
}