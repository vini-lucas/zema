<?php

namespace Sts\Controllers;

use Core\ConfigView;
use Sts\Models\helper\StsRead;
use Sts\Models\StsLogin;

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
        $teste = new StsRead();
        $this->data = $teste->exeRead("SELECT id, name FROM users", "WHERE id=:id AND name=:name", "id=1&name=lucas");
        $loadView = new ConfigView();
        $loadView->loadView("app/sts/Views/login", $this->data);
    }
}
