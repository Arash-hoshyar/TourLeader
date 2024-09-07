<?php

namespace TourLeader\DB;

use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\Adapter\Driver\ResultInterface;
use Laminas\Db\ResultSet\ResultSet;
use Laminas\Db\TableGateway\TableGateway;

class TourLeaderGateWay extends TableGateway
{
    public function __construct(AdapterInterface $adapter)
    {
        parent::__construct('tbl_tourLeader_infomation', $adapter);
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