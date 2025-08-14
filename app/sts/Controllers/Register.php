<?php

namespace Sts\Controllers;

/**
 * Caso o usuário tente acessar a página sem ser pelo arquivo index, acessa este if.
 */
if (!defined('L4bar3tTA!')) {
    header("Location: /");
}

class Register
{
    private array|null $data; // -> Recebe os dados que serão enviados para a view.
    private array|null $dataForm; // -> Recebe os dados que o usuário informou no formulário.

    public function index()
    {
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (isset($this->dataForm['SendRegister'])) {
            unset($this->dataForm['SendRegister']); // -> Destrói a posição do botão do array.
            $this->dataForm['password'] = password_hash($this->dataForm['password'], PASSWORD_DEFAULT); // -> Criptografa a senha antes de enviá-la ao Banco de Dados.
            $this->dataForm['created'] = date('Y-m-d H:i:s');
            $this->dataForm['access_level_id'] = 4;
            $valCpf = new \Sts\Models\StsRegister();
            $valCpf->validadeCpf($this->dataForm); // -> Instancia a classe para validar se já possui registro e, se não possuir, criá-lo no Banco de Dados.
            if ($valCpf->getResult()) {
                header("Location: " . URL . "login/index");
                exit;
            } else {
                header("Location: " . URL . "login/index");
                exit;
            }
        } else {
            $this->data = [];
            $this->loadView();
        }
    }

    public function loadView()
    {
        $loadView = new \Core\ConfigView();
        $loadView->loadView("app/sts/Views/login/register", $this->data);
    }
}
