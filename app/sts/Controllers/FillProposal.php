<?php

namespace Sts\Controllers;

/**
 * Caso o usuário tente acessar a página sem ser pelo arquivo index, acessa este if.
 */
if (!defined('L4bar3tTA!')) {
    header("Location: /");
}

class FillProposal
{
    private array|null $data; // -> Recebe os dados que serão enviados para a view.
    private array|null $dataForm; // -> Recebe os dados que o usuário informou no formulário.
    public array|null $resultController = null; // -> Recebe os dados que serão enviados para "ViewProposalCustomer".

    public function index()
    {
        $this->data['id'] = filter_input(INPUT_GET, 'id', FILTER_DEFAULT);
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->dataForm['SendDataPp'])) {
            unset($this->dataForm['SendDataPp']);
            if ($this->dataForm['gender'] == 'Selecione') {
                $_SESSION['msg'] = MSG_SEL_GENDER;
                $this->data['form'] = $this->dataForm;
            } else {
                $valEmail = new \Sts\Models\helper\StsValEmail();
                $valEmail->valEmail($this->dataForm['email']);
                if ($valEmail->getResult()) {
                    $valInput = new \Sts\Models\helper\StsValInputField();
                    $valInput->valInputField($this->dataForm);
                    if ($valInput->getResult()) {
                        $_SESSION['data-form'] = $this->dataForm;
                        header("Location: " . URL . "view-proposal-customer/index/{$this->data['id']}");
                        exit;
                    } else {
                        $this->data['form'] = $this->dataForm;
                    }
                } else {
                    $this->data['form'] = $this->dataForm;
                }
            }
        } else {
            $this->data['form'] = [];
        }
        $this->loadView();
    }

    public function loadView()
    {
        $loadView = new \Core\ConfigView();
        $loadView->loadView("app/sts/Views/dashboard/fillProposal", $this->data);
    }
}
