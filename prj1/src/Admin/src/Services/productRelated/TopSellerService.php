<?php

namespace Admin\Services\productRelated;

use Admin\DB\product\CategoryGateWay;
use Admin\DB\productRelated\TopSellerGateWay;
use Laminas\Db\Adapter\Driver\ResultInterface;

class TopSellerService
{

    public function __construct(private TopSellerGateWay $topSellerGateWay)
    {
    }

    public function getALLTopSeller(): array
    {
        return $this->topSellerGateWay->getALLTopSeller();
    }

    public function count(): array
    {
        return $this->topSellerGateWay->count();
    }

    public function getALLProductById(string $id): array
    {
        return $this->topSellerGateWay->getALLProductById($id);
    }

    public function deleteTopSeller(string $id): string
    {
        return $this->topSellerGateWay->deleteTopSeller($id);
    }

    public function updateTopSellerById(int $id, string $productIds): ResultInterface
    {
        return $this->topSellerGateWay->updateTopSellerById($id, $productIds);
    }

    public function getTopSeller(int $id): array
    {
        return $this->topSellerGateWay->getTopSeller($id);
    }

    public function getTopSellerByName(string $productIds): array|null
    {
        return $this->topSellerGateWay->getTopSellerByName($productIds);
    }

    public function getALlTopSellerWithOffset(int $offset): array
    {
        return $this->topSellerGateWay->getALlTopSellerWithOffset($offset);
    }

    public function addTopSeller(int $productIds): int
    {
        return $this->topSellerGateWay->addTopSeller($productIds);
    }

}