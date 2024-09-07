<?php

namespace Admin\Services\Product;

use Admin\DB\product\ProductGateWay;
use Admin\DB\productRelated\AdminProductMaterialCategoryGateWay;
use Laminas\Db\Adapter\Driver\ResultInterface;

class ProductService
{
    public function __construct(
        private ProductGateWay $adminAddProductGateWay,
        private AdminProductMaterialCategoryGateWay $adminProductMaterialGateWay,
    ) {
    }

    public function getAllProduct(): array
    {
        return $this->adminAddProductGateWay->getALLProduct();
    }

    public function adminAddProduct(
        string $name,
        string $label,
        string $brand_id,
        string $description,
        int $price,
        string $height,
        string $width,
        array $material,
        string $category_id,
        string $package
    ): int {
        $productId = $this->adminAddProductGateWay->addProduct(
            $name,
            $label,
            $brand_id,
            $description,
            $price,
            $height,
            $width,
            $category_id,
            $package
        );
        foreach ($material as $item) {
            $this->adminProductMaterialGateWay->addProductMaterial($productId, $category_id, $item);
        }
        return $productId;
    }

    public function updateProductById(
        int $id,
        string $name,
        string $label,
        string $brand_id,
        string $description,
        int $price,
        string $height,
        string $width,
        string $category_id,
        string $package
    ): ResultInterface {
        return $this->adminAddProductGateWay->updateProductById(
            $id,
            $name,
            $label,
            $brand_id,
            $description,
            $price,
            $height,
            $width,
            $category_id,
            $package
        );
    }

    public function getALLProductById(int|string $id): array
    {
        return $this->adminAddProductGateWay->getALLProductById($id);
    }

    public function getALLProductByIds(int|string $id): array
    {
        return $this->adminAddProductGateWay->getALLProductByIds($id);
    }

    public function getALLProductByCategoryId(int $id): array
    {
        return $this->adminAddProductGateWay->getALLProductByCategoryId($id);
    }

    public function deleteProduct(string $id): string
    {
        return $this->adminAddProductGateWay->deleteProduct($id);
    }

    public function deleteProductWithCategory_id(string $id): string
    {
        return $this->adminAddProductGateWay->deleteProductWithCategory_id($id);
    }

    public function deleteProductWithMaterial(string $id): string
    {
        return $this->adminAddProductGateWay->deleteProductWithMaterial($id);
    }

    public function deleteProductWithBrand_id(string $id): string
    {
        return $this->adminAddProductGateWay->deleteProductWithBrand_id($id);
    }

    public function getProduct(int $id): array
    {
        return $this->adminAddProductGateWay->getProduct($id);
    }

    public function count(): array
    {
        return $this->adminAddProductGateWay->count();
    }

    public function getALlProductWithOffset(int $offset): array
    {
        return $this->adminAddProductGateWay->getALlProductWithOffset($offset);
    }

}