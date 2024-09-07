<?php

declare(strict_types=1);

namespace App\Services\TL;

use App\DB\TlDB\TourLeaderGateWay;
use Laminas\Db\Adapter\Driver\ResultInterface;

class TLAuthorizationService
{

    private const ADMIN_EMAIL = 'tl_email';

    public function __construct(private TourLeaderGateWay $tourLeaderGateWay)
    {
    }


    public function isTLDoLogin(): bool
    {
        return isset($_SESSION[self::ADMIN_EMAIL]);
    }

    public function allGuids(): array|null
    {
        return $this->tourLeaderGateWay->allGuids();
    }

    public function doLogin(string $email, string $password): array|null
    {
        $response = $this->tourLeaderGateWay->login($email, $password);
        if ($response === null) {
            return null;
        }

        $userEmail = $response['email'];
        $_SESSION['tl_email'] = $userEmail;
        return [
            'Email' => $userEmail
        ];
    }


    public function doSignup(string $email, string $password): int
    {
        return $this->tourLeaderGateWay->signup($email, $password, $password);
    }

    public function loginWithEmail(string $email): array
    {
        return $this->tourLeaderGateWay->loginWithEmail($email);
    }

    public function findTL(int $id): array
    {
        return $this->tourLeaderGateWay->findTL($id);
    }

    public function TLInfo(string $email): array
    {
        return $this->tourLeaderGateWay->TLInfo($email);
    }

    public function findId(string $email, string $password): array
    {
        return $this->tourLeaderGateWay->findId($email, $password);
    }

    public function fullSignup(
        string $name,
        string $email,
        string $password,
        string $age,
        string $country,
        string $city,
        string $number,
        string $Language,
        int $id
    ): ResultInterface {
        return $this->tourLeaderGateWay->fullSignup(
            $name,
            $email,
            $password,
            $age,
            $country,
            $city,
            $number,
            $Language,
            $id,
        );
    }
}