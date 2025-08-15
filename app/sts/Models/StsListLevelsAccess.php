<?php

namespace Sts\Models;

/**
 * Caso o usuário tente acessar a página sem ser pelo arquivo index, acessa este if.
 */
if (!defined('L4bar3tTA!')) {
    header("Location: /");
}

/**
 * Models da controller login.
 */
class StsListLevelsAccess
{
    private bool $result;
    private array $resultDb;

    public function getResult(): bool
    {
        return $this->result;
    }

    public function getResultDb(): array
    {
        return $this->resultDb;
    }

    public function accessLevelsDatabase()
    {
        $users = new \Sts\Models\helper\StsRead();
        $users->fullRead("SELECT id, name, created, modified
                          FROM sts_access_levels  
                          LIMIT :limit", "limit=40");
        if ($users->getResultDb()) {
            $this->result = true;
            $this->resultDb = $users->getResultDb();
        } else {
            $this->result = false;
        }
    }
}
