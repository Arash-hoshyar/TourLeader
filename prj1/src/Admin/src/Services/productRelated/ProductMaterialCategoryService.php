<?php

namespace Admin\Services\productRelated;

use Admin\DB\productRelated\AdminProductMaterialCategoryGateWay;
use Laminas\Db\Adapter\Driver\ResultInterface;

class ProductMaterialCategoryService
{

    public function __construct(private AdminProductMaterialCategoryGateWay $adminProductMaterialCategoryGateWay)
    {
    }

    public function getProductMaterialByproductId(int $id): array
    {
        return $this->adminProductMaterialCategoryGateWay->getProductMaterialByproductId($id);
    }

    public function deleteMaterial(int $id): ResultInterface
    {
        return $this->adminProductMaterialCategoryGateWay->deleteMaterial($id);
    }

    public function deleteMaterialByMaterialId(int $id): ResultInterface
    {
        return $this->adminProductMaterialCategoryGateWay->deleteMaterialByMaterialId($id);
    }

    public function updateProductMaterialCategoryById(int $materialId): ResultInterface
    {
        return $this->adminProductMaterialCategoryGateWay->updateProductMaterialCategoryById(
            $materialId,
        );
    }

    public function insertProductMaterialCategoryById(int $id, string $categoryId, string $materialId): ResultInterface
    {
        return $this->adminProductMaterialCategoryGateWay->insertProductMaterialCategoryById(
            $id,
            $categoryId,
            $materialId
        );
    }

    public function selectByMaterialAndCategory(string $materialIds, string $categoryIds): array
    {
        return $this->adminProductMaterialCategoryGateWay->selectByMaterialAndCategory($materialIds, $categoryIds);
    }

    public function addProductMaterial(string $productId, string $category_id, string $materialId): int
    {
        return $this->adminProductMaterialCategoryGateWay->addProductMaterial($productId, $category_id, $materialId);
    }

}