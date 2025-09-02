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
        $searchProposals->fullRead("SELECT id, cpf, name FROM sts_proposal_fgts WHERE cpf=:cpf AND possession=:possession", "cpf={$cpf}&possession=0");
        if ($searchProposals->getResultDb() != null){
            $this->resultDb = $searchProposals->getResultDb();
            $this->result = true;
        } else {
            $this->result = false;
        }
    }

    public function searchProposalsSeller(string $name)
    {
        $searchProposals = new \Sts\Models\helper\StsRead();
        $searchProposals->fullRead("SELECT id, cpf, name FROM sts_proposal_fgts WHERE seller=:seller AND possession=:possession", "seller={$name}&possession=0");
        if ($searchProposals->getResultDb() != null){
            $this->resultDb = $searchProposals->getResultDb();
            $this->result = true;
        } else {
            $this->result = false;
        }
    }

    public function searchProposalsTable()
    {
        $searchProposalsAll = new \Sts\Models\helper\StsRead();
        $searchProposalsAll->fullRead("SELECT id, cpf, name FROM sts_proposal_fgts WHERE possession=:possession", "possession=1");
        if ($searchProposalsAll->getResultDb() != null){
            $this->resultDb = $searchProposalsAll->getResultDb();
            $this->result = true;
        } else {
            $this->result = false;
        }
    }

    public function searchProposalsAll()
    {
        $searchProposalsAll = new \Sts\Models\helper\StsRead();
        $searchProposalsAll->fullRead("SELECT id, cpf, name FROM sts_proposal_fgts");
        if ($searchProposalsAll->getResultDb() != null){
            $this->resultDb = $searchProposalsAll->getResultDb();
            $this->result = true;
        } else {
            $this->result = false;
        }
    }
}
