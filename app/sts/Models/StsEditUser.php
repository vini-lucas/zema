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
class StsEditUser
{
    private array|null $dataForm; // -> Recebe os dados que a controller enviou.
    private bool $result; // -> Recebe o resultado da QUERY solicitada em 'login()'. 
    private array $resultDb;

    public function getResult(): bool
    {
        return $this->result;
    }

    public function getResultDb(): array
    {
        return $this->resultDb;
    }

    public function searchUser(int $id)
    {
        $searchUser = new \Sts\Models\helper\StsRead();
        $searchUser->fullRead("SELECT id, name, cpf, gender, date_birth, telephone, email FROM sts_users WHERE id=:id", "id={$id}");
        if ($searchUser->getResultDb()) {
            $this->result = true;
            $this->resultDb = $searchUser->getResultDb();
        } else {
            $this->result = false;
        }
    }
}
