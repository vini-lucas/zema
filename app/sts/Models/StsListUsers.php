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
    private bool|null $result = null;
    private array|null $resultDb = null;

    public function getResult(): bool|null
    {
        return $this->result;
    }

    public function getResultDb(): array|null
    {
        return $this->resultDb;
    }

    public function usersDatabase(string $name_user, string $email_user)
    {
        $full_name_user = "%" . $name_user . "%";
        $full_email_user = "%" . $email_user . "%";

        $users = new \Sts\Models\helper\StsRead();
        $users->fullRead(
            "SELECT users.id, users.name AS name_user, users.cpf, users.date_birth, users.telephone, 
                users.email, users.gender, users.image, users.access_level_id, 
                nivel_acesso.name AS name_access
        FROM sts_users AS users
        INNER JOIN sts_access_levels AS nivel_acesso ON nivel_acesso.id=users.access_level_id
        WHERE users.name LIKE :name_user AND users.email LIKE :email_user
        LIMIT :limit",
            "name_user={$full_name_user}&email_user={$full_email_user}&limit=40"
        );

        if ($users->getResultDb()) {
            $this->result = true;
            $this->resultDb = $users->getResultDb();
        } else {
            $this->result = false;
        }
    }

    public function usersNameDatabase(string $name_user)
    {
        $full_name_user = "%" . $name_user . "%";

        $users = new \Sts\Models\helper\StsRead();
        $users->fullRead(
            "SELECT users.id, users.name AS name_user, users.cpf, users.date_birth, users.telephone, 
                users.email, users.gender, users.image, users.access_level_id, 
                nivel_acesso.name AS name_access
        FROM sts_users AS users
        INNER JOIN sts_access_levels AS nivel_acesso ON nivel_acesso.id=users.access_level_id
        WHERE users.name LIKE :name_user
        LIMIT :limit",
            "name_user={$full_name_user}&limit=40"
        );

        if ($users->getResultDb()) {
            $this->result = true;
            $this->resultDb = $users->getResultDb();
        } else {
            $this->result = false;
        }
    }

    public function usersEmailDatabase(string $email_user)
    {
        $full_email_user = "%" . $email_user . "%";

        $users = new \Sts\Models\helper\StsRead();
        $users->fullRead(
            "SELECT users.id, users.name AS name_user, users.cpf, users.date_birth, users.telephone, 
                users.email, users.gender, users.image, users.access_level_id, 
                nivel_acesso.name AS name_access
        FROM sts_users AS users
        INNER JOIN sts_access_levels AS nivel_acesso ON nivel_acesso.id=users.access_level_id
        WHERE users.email LIKE :email_user
        LIMIT :limit",
            "email_user={$full_email_user}&limit=40"
        );

        if ($users->getResultDb()) {
            $this->result = true;
            $this->resultDb = $users->getResultDb();
        } else {
            $this->result = false;
        }
    }
}
