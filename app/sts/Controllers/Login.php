<?php

namespace Sts\Controllers;

/**
 * Caso o usuário tente acessar a página sem ser pelo arquivo index, acessa este if.
 */
if (!defined('L4bar3tTA!')) {
    header("Location: /");
}

class Login
{
    private array|null $data; // -> Recebe os dados que serão enviados para a view.
    private array|null $dataForm; // -> Recebe os dados que o usuário informou no formulário.

    public function index()
    {
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->dataForm['SendLogin'])) {
            unset($this->dataForm['SendLogin']); // -> Destrói a posição do botão.
            $clearString = new \Sts\Models\helper\StsClearString();
            $this->dataForm['cpf'] = $clearString->exeClear($this->dataForm['cpf']); // -> Remove os pontos e traços do CPF.
            $valInput = new \Sts\Models\helper\StsValInputField();
            $valInput->valInputField($this->dataForm); // -> Valida se todos os campos do formulário foram preenchidos.
            if ($valInput->getResult()) { // -> Se foram, então:
                $verifyLogin = new \Sts\Models\StsLogin();
                $verifyLogin->login($this->dataForm); // -> Verifica se o usuário existe no banco de dados.
                if ($verifyLogin->getResult()) {
                    header("Location: " . URL . "dashboard/index"); // -> Se existir, direciona para o dashboard.
                } else {
                    $this->data['form'] = $this->dataForm; // -> Se não existir, mantém, os dados no formulário e carrega a VIEW.
                    $this->loadView();
                }
            } else { // -> Se não forem preenchidos, então:
                $this->data['form'] = $this->dataForm; // -> Se não existir, mantém, os dados no formulário e carrega a VIEW.
                $this->loadView();
            }
        } else { // -> Se o usuário não apertar no botão, então:
            $this->data = []; 
            $this->loadView(); // -> Carrega a VIEW.
        }
    }

    public function loadView()
    {
        $loadView = new \Core\ConfigView();
        $loadView->loadView("app/sts/Views/login/login", $this->data);
    }
}
