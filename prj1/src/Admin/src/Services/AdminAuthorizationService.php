<?php

namespace Admin\Services;

use Admin\DB\AdminGateWay;

class AdminAuthorizationService
{
    private const ADMIN_EMAIL = 'admin_email';

    public function __construct(private AdminGateWay $adminGateWay)
    {
    }

    public function isAdminDoLogin(): bool
    {
        return isset($_SESSION[self::ADMIN_EMAIL]);
    }

    public function adminDoLogin(string $email, string $password): array|null
    {
        $response = $this->adminGateWay->adminLogin($email, $password);


        $adminEmail = $response['email'];
        $_SESSION['admin_email'] = $adminEmail;
        return [
            'Email' => $adminEmail
        ];
    }
    public function adminDoResetPassword(string $email): array|null
    {
        $response = $this->adminGateWay->adminResetPassword($email);

        $adminEmail = $response['email'];
        return [
            'Email' => $adminEmail
        ];
    }
    public function adminDoSignup(string $email, string $password): int
    {
        return $this->adminGateWay->adminSignup($email, $password);
    }

}