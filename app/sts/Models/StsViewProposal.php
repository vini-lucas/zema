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
class StsViewProposal
{
    private array|null $dataForm; // -> Recebe os dados que que a controller enviou.
    private bool $result; // -> Recebe o resultado da QUERY solicitada em 'login()'. 
    private array|null $resultDb;

    public function getResult(): bool
    {
        return $this->result;
    }

    public function getResultDb(): array
    {
        return $this->resultDb;
    }

    public function searchDataPp(int $id)
    {
        $searchDataPp = new \Sts\Models\helper\StsRead();
        $searchDataPp->fullRead("SELECT cpf, name, date_birth FROM sts_proposal_fgts WHERE id=:id", "id={$id}");
        if ($searchDataPp->getResultDb() != null){
            $this->resultDb = $searchDataPp->getResultDb();
            $this->result = true;
        } else {
            $_SESSION['msg'] = MSG_REGISTER_NOT_FOUND;
            $this->result = false;
        }
    }

    public function editProposal(int $id, array $dataForm)
    {
        $upLevel = new \Sts\Models\helper\StsUpdade();
        $upLevel->exeUpdate("sts_proposal_fgts", $dataForm, "WHERE id=:id", "id={$id}");
        if ($upLevel->getResult()) {
            $_SESSION['msg'] = MSG_ALT_PERF_SUCCESS;
            $this->result = true;
        } else {
            $_SESSION['msg'] = MSG_ALT_NOT_PERF_SUCCESS;
            $this->result = false;
        }
    }
}
