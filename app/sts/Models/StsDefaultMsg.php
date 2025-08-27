<?php

namespace Sts\Models;

/**
 * Caso o usuário tente acessar a página sem ser pelo arquivo index, acessa este if.
 */
if (!defined('L4bar3tTA!')) {
    header("Location: /");
}

/**
 * Models da controller DefaultMsg.
 */
class StsDefaultMsg
{
    private array|null $dataForm; // -> Recebe os dados que que a controller enviou.
    private array|null $resultDb = null; // -> Recebe o resultado da QUERY solicitada em 'login()'. 
    private bool $result;

    public function getResult(): bool
    {
        return $this->result;
    }

    public function getResultDb(): array|null
    {
        return $this->resultDb;
    }

    public function searchMsg()
    {
        $readMsg = new \Sts\Models\helper\StsRead();
        $readMsg->fullRead("SELECT id, shortcut, msg, created, modified FROM sts_default_msg LIMIT :limit", "limit=40");
        if ($readMsg->getResultDb()) {
            $this->resultDb = $readMsg->getResultDb();
        } else {
            $_SESSION['msg'] = MSG_REGISTER_NOT_FOUND;
            $this->resultDb = null;
        }
    }

    public function editMsg(int $id, array $dataForm)
    {
        $upMsg = new \Sts\Models\helper\StsUpdade();
        $upMsg->exeUpdate("sts_default_msg", $dataForm, "WHERE id=:id", "id=$id");
        if ($upMsg->getResult()) {
            $_SESSION['msg'] = MSG_ALT_PERF_SUCCESS;
            $this->result = true;
        } else {
            $_SESSION['msg'] = MSG_ALT_NOT_PERF_SUCCESS;
            $this->result = false;
        }
    }
}
