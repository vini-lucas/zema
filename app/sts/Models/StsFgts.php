<?php

namespace Sts\Models;

/**
 * Caso o usuário tente acessar a página sem ser pelo arquivo index, acessa este if.
 */
if (!defined('L4bar3tTA!')) {
    header("Location: /");
}

/**
 * Models da controller Fgts.
 */
class StsFgts
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

    public function searchProposalsCustomer(string $cpf)
    {
        $searchProposals = new \Sts\Models\helper\StsRead();
        $searchProposals->fullRead("SELECT cpf, name FROM sts_proposal_fgts WHERE cpf=:cpf AND possession=:possession", "cpf={$cpf}&possession=0");
        if ($searchProposals->getResultDb() != null){
            $this->resultDb = $searchProposals->getResultDb();
            $this->result = true;
        } else {
            $this->result = false;
        }
    }

    public function searchProposalsAll()
    {
        $searchProposalsAll = new \Sts\Models\helper\StsRead();
        $searchProposalsAll->fullRead("SELECT cpf, name FROM sts_proposal_fgts");
        if ($searchProposalsAll->getResultDb() != null){
            $this->resultDb = $searchProposalsAll->getResultDb();
            $this->result = true;
        } else {
            $this->result = false;
        }
    }

    public function upLevelAccess(array $dataForm)
    {
        $upLevel = new \Sts\Models\helper\StsUpdade();
        $upLevel->exeUpdate("sts_access_new_user", $dataForm);
        if ($upLevel->getResult()) {
            $_SESSION['msg'] = MSG_ALT_PERF_SUCCESS;
            $this->result = true;
        } else {
            $_SESSION['msg'] = MSG_ALT_NOT_PERF_SUCCESS;
            $this->result = false;
        }
    }
}
