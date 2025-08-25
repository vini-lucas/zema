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
class StsListEmails
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

    public function emailsDatabase()
    {
        $emails = new \Sts\Models\helper\StsRead();
        $emails->fullRead("SELECT id, title, name, email, host, username, password, smtpsecure, port, created, modified
                          FROM sts_confs_emails  
                          LIMIT :limit", "limit=40");
        if ($emails->getResultDb()) {
            $this->result = true;
            $this->resultDb = $emails->getResultDb();
        } else {
            $this->result = false;
        }
    }
}
