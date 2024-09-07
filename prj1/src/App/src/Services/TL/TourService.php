<?php

namespace App\Services\TL;

use Admin\DB\product\BrandGateWay;
use App\DB\TlDB\TLJourneyGateWay;
use App\DB\TlDB\TLToursGateWay;
use Laminas\Db\Adapter\Driver\ResultInterface;

class TourService
{

    public function __construct(private TLToursGateWay $toursGateWay)
    {
    }

    public function getALLTour(): array
    {
        return $this->toursGateWay->getALLTour();
    }

    public function count(): array
    {
        return $this->toursGateWay->count();
    }

    public function deleteTour(string $id): string
    {
        return $this->toursGateWay->deleteTour($id);
    }

    public function getALlTourWithOffset(int $offset): array
    {
        return $this->toursGateWay->getALlTourWithOffset($offset);
    }

    public function getTour(int $id): array
    {
        return $this->toursGateWay->getTour($id);
    }

    public function updateTourById(
        int $id,
        string $name,
        int $price,
        int $days,
        string $place,
        string $description,
        string|null $logo = null
    ): ResultInterface {
        return $this->toursGateWay->updateTourById($id, $name, $price, $days, $place, $description, $logo);
    }


    public function addTour(
        string $name,
        string $logo,
        int $price,
        int $days,
        string $place,
        string $description,
        string $tourGuide,
    ): int {
        return $this->toursGateWay->addTour($name,$logo, $price, $days, $place, $description, $tourGuide);
    }

}