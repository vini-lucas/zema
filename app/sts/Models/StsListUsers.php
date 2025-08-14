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
        $users->fullRead("SELECT users.id, users.name AS name_user, users.cpf, users.date_birth, users.telephone, users.email, users.gender, users.image, users.access_level_id, nivel_acesso.name AS name_access
                          FROM sts_users AS users
                          INNER JOIN sts_access_levels AS nivel_acesso ON nivel_acesso.id=users.access_level_id  
                          LIMIT :limit", "limit=40");
        if ($users->getResultDb()) {
            $this->result = true;
            $this->resultDb = $users->getResultDb();
        } else {
            $this->result = false;
        }
    }
}
