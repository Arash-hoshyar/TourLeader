<?php

declare(strict_types=1);

namespace App\Services\TL;

use App\DB\TlDB\MassageGateWay;
use App\DB\TlDB\TourLeaderGateWay;
use Laminas\Db\Adapter\Driver\ResultInterface;

class MassageService
{

    private const ADMIN_EMAIL = 'tl_email';

    public function __construct(private MassageGateWay $massageGateWay)
    {
    }



    public function allGuids(): array|null
    {
        return $this->massageGateWay->allGuids();
    }

    public function doLogin(string $email, string $password): array|null
    {
        $response = $this->massageGateWay->login($email, $password);
        if ($response === null) {
            return null;
        }

        $userEmail = $response['email'];
        $_SESSION['tl_email'] = $userEmail;
        return [
            'Email' => $userEmail
        ];
    }


    public function addMassage(int $id, string $name, string $lable, string $massage): int
    {
        return $this->massageGateWay->addMassage($id, $name, $lable,$massage);
    }

    public function allMassageById(int $id): array
    {
        return $this->massageGateWay->allMassageById($id);
    }

}