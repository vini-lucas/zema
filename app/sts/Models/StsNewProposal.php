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
class StsNewProposal
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

    public function sendProposalCustomer(array $dataForm)
    {
        $sendProposal = new \Sts\Models\helper\StsCreate();
        $sendProposal->exeCreate("sts_proposal_fgts", $dataForm);
        if ($sendProposal->getResult()){
            $_SESSION['msg'] = MSG_SEND_PP_CUST_SUCCESS;
            $this->result = true;
        } else {
            $_SESSION['msg'] = MSG_SEND_PP_CUST_ERR;
            $this->result = false;
        }
    }

    public function sendProposalSeller(array $dataForm)
    {
        $sendProposal = new \Sts\Models\helper\StsCreate();
        $sendProposal->exeCreate("sts_proposal_fgts", $dataForm);
        if ($sendProposal->getResult()){
            $_SESSION['msg'] = MSG_SEND_PP_SELLER_SUCCESS;
            $this->result = true;
        } else {
            $_SESSION['msg'] = MSG_SEND_PP_SELLER_ERR;
            $this->result = false;
        }
    }
}
