<?php

namespace Admin\Services\Product;

use Admin\DB\product\MaterialGateWay;
use Laminas\Db\Adapter\Driver\ResultInterface;

class MaterialService
{

    public function __construct(private MaterialGateWay $materialGateWay)
    {
    }

    public function getALLMaterial(): array
    {
        return $this->materialGateWay->getALLMaterial();
    }

    public function count(): array
    {
        return $this->materialGateWay->count();
    }

    public function deleteMaterial(string $id): string
    {
        return $this->materialGateWay->deleteMaterial($id);
    }

    public function getALlMaterialWithOffset(int $offset): array
    {
        return $this->materialGateWay->getALlMaterialWithOffset($offset);
    }

    public function updateMaterialById(int $id, string $name): ResultInterface
    {
        return $this->materialGateWay->updateMaterialById($id, $name);
    }

    public function getMaterial(int $id): array
    {
        return $this->materialGateWay->getMaterial($id);
    }

    public function addMaterial(string $name): int
    {
        return $this->materialGateWay->addMaterial($name);
    }

}