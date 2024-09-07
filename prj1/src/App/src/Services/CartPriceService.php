<?php

declare(strict_types=1);

namespace App\Services;

use App\DB\gateWay\cartRelatedGateWay\CartGateWay;
use App\DB\gateWay\cartRelatedGateWay\CartPriceGateWay;
use Laminas\Db\Adapter\Driver\ResultInterface;

class CartPriceService
{


    public function __construct(private CartPriceGateWay $cartPriceGateWay)
    {
    }


    public function selectCart(string $session): array
    {
        return $this->cartPriceGateWay->selectCart($session);
    }

    public function getALLCartCount(int $id): array
    {
        return $this->cartPriceGateWay->getALLCartCount($id);
    }

    public function addCart(int $productId, int $price, string $session, int $count): ResultInterface
    {
        return $this->cartPriceGateWay->addCart($productId, $price, $session, $count);
    }

    /** @param string $ids comma separated Ids */
    public function getALLCartByproductIds(int $ids): array
    {
        return $this->cartPriceGateWay->getALLCartByproductIds($ids);
    }

    /** @param string $ids comma separated Ids */
    public function deleteCart(string $ids, string $session): ResultInterface
    {
        return $this->cartPriceGateWay->deleteCart($ids, $session);
    }

    public function updateCartBySession(string $session, string $cookie): ResultInterface
    {
        return $this->cartPriceGateWay->updateCartBySession($session, $cookie);
    }
}