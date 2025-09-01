<?php

namespace Sts\Controllers;

/**
 * Caso o usuário tente acessar a página sem ser pelo arquivo index, acessa este if.
 */
if (!defined('L4bar3tTA!')) {
    header("Location: /");
}

class ViewProposal
{
    private array|null $data; // -> Recebe os dados que serão enviados para a view.
    private array|null $dataForm; // -> Recebe os dados que o usuário informou no formulário.

    public function index(int $id)
    {
        if ($_SESSION['user_access_level'] != 'Cliente') {
            $searchDataPp = new \Sts\Models\StsViewProposal();
            $searchDataPp->searchDataPp($id);
            if ($searchDataPp->getResultDb()) {
                $this->data['form'] = $searchDataPp->getResultDb();
                $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
                if (!empty($this->dataForm['SendProposal'])) {
                    unset($this->dataForm['SendProposal']);
                    if (
                        (($this->dataForm['portions_one'] == '' AND ($this->dataForm['date_portions_one'] == '')))
                    OR (($this->dataForm['portions_two'] == '' AND ($this->dataForm['date_portions_two'] == ''))) 
                    OR (($this->dataForm['portions_three'] == '' AND ($this->dataForm['date_portions_three'] == ''))) 
                    OR (($this->dataForm['portions_four'] == '' AND ($this->dataForm['date_portions_four'] == ''))) 
                    OR (($this->dataForm['portions_five'] == '' AND ($this->dataForm['date_portions_five'] == ''))) 
                    OR (($this->dataForm['portions_six'] == '' AND ($this->dataForm['date_portions_six'] == ''))) 
                    OR (($this->dataForm['portions_seven'] == '' AND ($this->dataForm['portions_seven'] == ''))) 
                    OR (($this->dataForm['portions_eight'] == '' AND ($this->dataForm['date_portions_eight'] == ''))) 
                    OR (($this->dataForm['portions_nine'] == '' AND ($this->dataForm['date_portions_nine'] == ''))) 
                    OR (($this->dataForm['portions_ten'] == '' AND ($this->dataForm['date_portions_ten'] == '')))) {
                        $this->data['form'] = $this->dataForm;
                        $_SESSION['msg'] = "<p style='color: red;'>Informe o valor e data da(s) parcela(s) antes de enviar a SIMULAÇÃO!</p>";
                    } else {
                        var_dump($this->dataForm);
                    }
                }
            } else {
                $this->data = [];
            }
        } else {
            header("Location: " . URL . "page-err/index");
            exit;
        }
        $this->loadView();
    }

    public function loadView()
    {
        $loadView = new \Core\ConfigView();
        $loadView->loadView("app/sts/Views/dashboard/viewProposal", $this->data);
    }
}
