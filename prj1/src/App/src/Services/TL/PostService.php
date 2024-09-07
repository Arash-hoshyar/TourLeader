<?php

namespace App\Services\TL;

use Admin\DB\product\BrandGateWay;
use App\DB\TlDB\TLJourneyGateWay;
use Laminas\Db\Adapter\Driver\ResultInterface;

class JourneyService
{

    public function __construct(private TLJourneyGateWay $tLJourneyGateWay)
    {
    }

    public function getALLJourney(): array
    {
        return $this->tLJourneyGateWay->getALLJourney();
    }

    public function count(): array
    {
        return $this->tLJourneyGateWay->count();
    }

    public function deleteJourney(string $id): string
    {
        return $this->tLJourneyGateWay->deleteJourney($id);
    }

    public function getALlJourneyWithOffset(int $offset): array
    {
        return $this->tLJourneyGateWay->getALlJourneyWithOffset($offset);
    }

    public function getJourney(int $id): array
    {
        return $this->tLJourneyGateWay->getJourney($id);
    }

    public function updateJourneyById(int $id, string $name, string $url, string|null $logo = null): ResultInterface
    {
        return $this->tLJourneyGateWay->updateJourneyById($id, $name, $url, $logo);
    }


    public function addJourney(string $name, string $logo, string $url): int
    {
        return $this->tLJourneyGateWay->addJourney($name, $logo, $url);
    }

}