<?php

namespace Sts\Controllers;

use Core\ConfigView;

class Login
{
    private array|null $data; // -> Recebe os dados que serão enviados para a view.

    public function index()
    {
        $this->data = [];
        $loadView = new ConfigView();
        $loadView->loadView("app/sts/Views/login", $this->data);
    }
}