<?php

namespace Sts\Models;

/**
 * Caso o usuário tente acessar a página sem ser pelo arquivo index, acessa este if.
 */
if (!defined('L4bar3tTA!')) {
    header("Location: /");
}

/**
 * Models da controller register.
 */
class StsPagesPublicAndPriv
{
    private array|null $dataForm; // -> Recebe os dados que que a controller enviou.
    private bool $result; // -> Recebe o resultado da QUERY solicitada em 'login()'.
    private array|null $resultDb;

    public function getResult(): bool
    {
        return $this->result;
    }

    public function getResultDb(): array|null
    {
        return $this->resultDb;
    }

    public function searchPage()
    {
        $searchPage = new \Sts\Models\helper\StsRead();
        $searchPage->fullRead("SELECT id, controller, public, created, modified FROM sts_pages");
        if ($searchPage->getResultDb() != null){
            $this->resultDb = $searchPage->getResultDb();
            $this->result = true;
        } else {
            $_SESSION['msg'] = MSG_REGISTER_NOT_FOUND;
            $this->result = false;
        }
    }

    public function upPage(array $dataForm, string $id)
    {
        $upPage = new \Sts\Models\helper\StsUpdade();
        $upPage->exeUpdate("sts_pages", $dataForm, "WHERE id=:id", "id=$id");
        if ($upPage->getResult()) {
            $_SESSION['msg'] = MSG_ALT_PERF_SUCCESS;
            $this->result = true;
        } else {
           $_SESSION['msg'] = MSG_ALT_NOT_PERF_SUCCESS;
            $this->result = false; 
        }
    }
}
