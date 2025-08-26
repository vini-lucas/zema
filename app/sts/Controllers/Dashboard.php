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
        if (isset($_SESSION['user_cpf']) and (isset($_SESSION['user_name']))) {
            $this->loadView();
        } else {
            $_SESSION['msg'] = MSG_PERFOM_LOGIN;
            header("Location: " . URL . "login/index");
        }
    }

    public function loadView()
    {
        $this->data = [];
        $loadView = new \Core\ConfigView();
        $loadView->loadView("app/sts/Views/dashboard/dashboard", $this->data);
    }
}
