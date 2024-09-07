<?php

namespace Admin\DB;

use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\TableGateway\TableGateway;

class AdminGateWay extends TableGateway
{
    public function __construct(AdapterInterface $adapter)
    {
        parent::__construct('tbl_admin_information', $adapter);
    }
    public function adminLogin(string $email, string $password): array|null
    {
        $result = $this->select([
            'email' => $email,
            'password' => hash('sha512', $password . 'LBF')
        ]);
        return $result->current()?->getArrayCopy();
    }
    public function adminResetPassword(string $email): array|null
    {
        $result = $this->select([
            'email' => $email,
        ]);
        return $result->current()?->getArrayCopy();
    }

    public function adminSignup(string $email, string $password): int
    {
        $this->insert([
            'email' => $email,
            'password' => hash('sha512', $password . 'LBF'),

        ]);
        return $this->getLastInsertValue();
    }
}