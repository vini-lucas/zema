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
        $viewPp->searchDataPp($this->id);
        if ($viewPp->getResult()) {
            $this->data['form'] = $viewPp->getResultDb();
            $this->data['portions'] = json_decode($viewPp->getResultDb()[0]['portions'], true);
        }
        $this->loadView();
    }

    public function loadView()
    {
        $loadView = new \Core\ConfigView();
        $loadView->loadView("app/sts/Views/dashboard/viewProposalCustomer", $this->data);
    }
}
