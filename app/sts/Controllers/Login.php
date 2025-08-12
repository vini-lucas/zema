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
            unset($this->dataForm['SendLogin']);
            $verifyLogin = new \Sts\Models\StsLogin();
            $verifyLogin->login($this->dataForm);
            if ($verifyLogin->getResult()) {
                header("Location: " . URL . "dashboard/index");
            } else {
                $this->data['form'] = $this->dataForm;
                $this->loadView();
            }
        } else {
            $this->data = [];
            $this->loadView();
        }
    }

    public function loadView()
    {
        $loadView = new \Core\ConfigView();
        $loadView->loadView("app/sts/Views/login/login", $this->data);
    }
}
