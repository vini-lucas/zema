<?php

namespace Sts\Controllers;

/**
 * Caso o usuário tente acessar a página sem ser pelo arquivo index, acessa este if.
 */
if (!defined('L4bar3tTA!')) {
    header("Location: /");
}

class Dashboard
{
    private array|null $data; // -> Recebe os dados que serão enviados para a view.

    public function index()
    {
        $this->loadView();
    }

    public function loadView()
    {
        $this->data = [];
        $loadView = new \Core\ConfigView();
        $loadView->loadView("app/sts/Views/dashboard/dashboard", $this->data);
    }
}