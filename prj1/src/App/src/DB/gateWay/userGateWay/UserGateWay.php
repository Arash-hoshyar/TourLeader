<?php

namespace App\DB\gateWay\userGateWay;

use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\TableGateway\TableGateway;

class UserGateWay extends TableGateway
{
    public function __construct(AdapterInterface $adapter)
    {
        parent::__construct('tbl_user_information', $adapter);
    }

    public function login(string $email, string $password): array|null
    {
        $result = $this->select([
            'email' => $email,
            'password' => hash('sha512', $password . 'LBF')
        ]);
        return $result->current()?->getArrayCopy();
    }

    public function signup(string $email, string $password): int
    {
        $this->insert([
            'email' => $email,
            'password' => hash('sha512', $password . 'LBF'),

        ]);
        return $this->getLastInsertValue();
    }

}