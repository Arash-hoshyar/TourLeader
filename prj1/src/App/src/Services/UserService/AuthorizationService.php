<?php

declare(strict_types=1);

namespace App\Services\UserService;

use App\DB\gateWay\userGateWay\UserGateWay;

class AuthorizationService
{

    private const ADMIN_EMAIL = 'user_email';

    public function __construct(private UserGateWay $userGateWay)
    {
    }

    public function isUserDoLogin(): bool
    {
        return isset($_SESSION[self::ADMIN_EMAIL]);
    }

    public function doLogin(string $email, string $password): array|null
    {
        $response = $this->userGateWay->login($email, $password);
        if ($response === null) {
            return null;
        }

        $userEmail = $response['email'];
        $_SESSION['user_email'] = $userEmail;
        return [
            'Email' => $userEmail
        ];
    }


    public function doSignup(string $email, string $password): int
    {
        return $this->userGateWay->signup($email, $password);
    }

    public function allGuids(): array|null
    {
        return $this->userGateWay->allGuids();
    }
}