<?php

namespace Admin\Services\Product;

use Admin\DB\product\CategoryGateWay;
use Laminas\Db\Adapter\Driver\ResultInterface;

class CategoryService
{

    public function __construct(private CategoryGateWay $adminCategoryGateWay)
    {
    }

    public function getAllCategory(): array
    {
        return $this->adminCategoryGateWay->getALLCategory();
    }

    public function count(): array
    {
        return $this->adminCategoryGateWay->count();
    }

    public function deleteCategory(string $id): string
    {
        return $this->adminCategoryGateWay->deleteCategory($id);
    }

    public function getALlCategoryWithOffset(int $offset): array
    {
        return $this->adminCategoryGateWay->getALlCategoryWithOffset($offset);
    }

    public function updateCategoryById(int $id, string $name): ResultInterface
    {
        return $this->adminCategoryGateWay->updateCategoryById($id, $name);
    }

    public function getCategory(int $id): array
    {
        return $this->adminCategoryGateWay->getCategory($id);
    }

    public function getCategoryByName(string $name): array|null
    {
        return $this->adminCategoryGateWay->getCategoryByName($name);
    }

    public function adminAddCategory(string $name): int
    {
        return $this->adminCategoryGateWay->addCategory($name);
    }

}