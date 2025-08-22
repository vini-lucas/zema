<?php

namespace Sts\Controllers;

/**
 * Caso o usuário tente acessar a página sem ser pelo arquivo index, acessa este if.
 */
if (!defined('L4bar3tTA!')) {
    header("Location: /");
}

class RecPassword
{
    private array|null $data; // -> Recebe os dados que serão enviados para a view.
    private array|null $dataForm; // -> Recebe os dados que o usuário informou no formulário.

    public function index()
    {
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (isset($this->dataForm['SendRecover'])) { // -> Se apertou no botão, então:
            unset($this->dataForm['SendRecover']);
            $valInput = new \Sts\Models\helper\StsValInputField();
            $valInput->valInputField($this->dataForm); // -> Se preencheu todos os campos então:
            if ($valInput->getResult()) {
                $clearString = new \Sts\Models\helper\StsClearString();
                $this->dataForm['cpf'] = $clearString->exeClear($this->dataForm['cpf']); // -> Remove os caracteres especiais do CPF.
                $recPass = new \Sts\Models\StsRecPassword();
                $recPass->validateCpf($this->dataForm);
                if ($recPass->getResult()) {
                    header("Location: " . URL . "login/index");
                    exit;
                } else {
                    header("Location: " . URL . "login/index");
                    exit;
                }
            } else {
                $this->data['form'] = $this->dataForm;
            }
        } else {
            $this->data = [];
        }
        $this->loadView();
    }

    public function loadView()
    {
        $this->data = [];
        $loadView = new \Core\ConfigView();
        $loadView->loadView("app/sts/Views/login/recPassword", $this->data);
    }
}
