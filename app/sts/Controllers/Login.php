<?php

namespace Sts\Controllers;

class Login
{
    private array|null $data; // -> Recebe os dados que serão enviados para a view.
    private array|null $dataForm; // -> Recebe os dados que o usuário informou no formulário.

    public function index()
    {
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->dataForm['SendLogin'])) {
        } else {
            $this->loadView();
        }
    }

    public function loadView()
    {
        $teste = new \Sts\Models\helper\StsRead();
        $this->data = $teste->exeRead("SELECT id, name FROM users", "WHERE id=:id AND name=:name", "id=1&name=lucas");
        $loadView = new \Core\ConfigView();
        $loadView->loadView("app/sts/Views/login/login", $this->data);
    }
}
