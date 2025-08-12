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
class StsListUsers
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

    public function usersDatabase()
    {
        $users = new \Sts\Models\helper\StsRead();
        $users->fullRead("SELECT id, name, cpf, date_birth, telephone, email, gender, image, access_level_id FROM sts_users LIMIT :limit", "limit=40");
        if ($users->getResultDb()) {
            $this->result = true;
            $this->resultDb = $users->getResultDb();
        } else {
            $this->result = false;
        }
    }
}
