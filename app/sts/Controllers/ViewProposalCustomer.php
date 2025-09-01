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

    public function index(int $id)
    {
            $viewPp = new \Sts\Models\StsViewProposalCustomer();
            $viewPp->searchDataPp($id);
            if ($viewPp->getResult()) {
                $this->data['form'] = $viewPp->getResultDb();
                $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
                if (!empty($this->dataForm['DeleteProposal'])) {
                    unset($this->dataForm['DeleteProposal']);
                    if ($this->dataForm['observation'] == '') {
                        $_SESSION['msg'] = "<p style='color: red;'>Informe o motivo do cancelamento na observação!</p>";
                    } else {
                        unset($this->dataForm['SendProposal']);
                        $this->dataForm['possession'] = 3;
                        $delPp = new \Sts\Models\StsViewProposal();
                        $delPp->editProposal($id, $this->dataForm);
                        if ($delPp->getResult()) {
                            header("Location: " . URL . "fgts/index");
                            exit;
                        } else {
                            header("Location: " . URL . "fgts/index");
                            exit;
                        }
                    }
                } else if (!empty($this->dataForm['SendProposal'])) {
                    unset($this->dataForm['SendProposal']);
                    var_dump($this->dataForm);
                } else {
                    $this->data['form'] = $viewPp->getResultDb();
                }
            } else {
                $this->data = [];
            }
            $this->loadView();
    }

    public function loadView()
    {
        $loadView = new \Core\ConfigView();
        $loadView->loadView("app/sts/Views/dashboard/viewProposalCustomer", $this->data);
    }
}
