<?php

namespace Admin\Services\Product;

use Admin\DB\product\BrandGateWay;
use Laminas\Db\Adapter\Driver\ResultInterface;

class BrandService
{

    public function __construct(private BrandGateWay $adminBrandGateWay)
    {
    }

    public function getAllBrands(): array
    {
        return $this->adminBrandGateWay->getALLBrands();
    }

    public function count(): array
    {
        return $this->adminBrandGateWay->count();
    }

    public function deleteBrand(string $id): string
    {
        return $this->adminBrandGateWay->deleteBrand($id);
    }

    public function getALlBrandWithOffset(int $offset): array
    {
        return $this->adminBrandGateWay->getALlBrandWithOffset($offset);
    }

    public function getBrand(int $id): array
    {
        return $this->adminBrandGateWay->getBrand($id);
    }

    public function updateBrandById(int $id, string $name, string $url, string|null $logo = null): ResultInterface
    {
        return $this->adminBrandGateWay->updateBrandById($id, $name, $url, $logo);
    }


    public function adminAddBrand(string $name, string $logo, string $url): int
    {
        return $this->adminBrandGateWay->addBrand($name, $logo, $url);
    }

}