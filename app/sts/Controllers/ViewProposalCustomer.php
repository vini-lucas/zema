<?php

namespace Sts\Controllers;

/**
 * Caso o usuário tente acessar a página sem ser pelo arquivo index, acessa este if.
 */
if (!defined('L4bar3tTA!')) {
    header("Location: /");
}

class ViewProposalCustomer
{
    private array|null $data; // -> Recebe os dados que serão enviados para a view.
    private array|null $dataForm; // -> Recebe os dados que o usuário informou no formulário.
    private int|null $id; // -> Recebe o ID da proposta.

    public function index(int|null $id)
    {
        $this->id = $id; // -> Recebe o ID da proposta.
        $viewPp = new \Sts\Models\StsViewProposalCustomer();
        $viewPp->searchDataPp($this->id); // -> Busca no BD os dados da proposta com este ID.
        if ($viewPp->getResult()) { // -> E os encaminha para a VIEW.
            $this->data['form'] = $viewPp->getResultDb();
            $this->data['portions'] = json_decode($viewPp->getResultDb()[0]['portions'], true);
            $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            if (!empty($this->dataForm['accept_value'])) {
                var_dump($this->dataForm);
            }
        }
        $this->loadView();
    }

    public function loadView()
    {
        $loadView = new \Core\ConfigView();
        $loadView->loadView("app/sts/Views/dashboard/viewProposalCustomer", $this->data);
    }
}
