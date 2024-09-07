<?php

namespace App\Services\TL;

use Admin\DB\product\BrandGateWay;
use App\DB\TlDB\TLJourneyGateWay;
use App\DB\TlDB\TLPostGateWay;
use Laminas\Db\Adapter\Driver\ResultInterface;

class PostService
{

    public function __construct(private TLPostGateWay $postGateWay)
    {
    }

    public function getALLPost(): array
    {
        return $this->postGateWay->getALLPost();
    }

    public function count(): array
    {
        return $this->postGateWay->count();
    }

    public function deletePost(string $id): string
    {
        return $this->postGateWay->deletePost($id);
    }

    public function getALlPostWithOffset(int $offset): array
    {
        return $this->postGateWay->getALlPostWithOffset($offset);
    }

    public function getPost(int $id): array
    {
        return $this->postGateWay->getPost($id);
    }

    public function updatePostById(int $id, string $name, string $url, string|null $logo = null): ResultInterface
    {
        return $this->postGateWay->updatePostById($id, $name, $url, $logo);
    }


    public function addPost(string $name, string $logo, string $url): int
    {
        return $this->postGateWay->addPost($name, $logo, $url);
    }

}