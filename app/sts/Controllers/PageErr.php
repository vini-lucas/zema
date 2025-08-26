<?php

namespace Sts\Controllers;

/**
 * Caso o usuário tente acessar a página sem ser pelo arquivo index, acessa este if.
 */
if (!defined('L4bar3tTA!')) {
    header("Location: /");
}

class PageErr
{
    private array|null $data; // -> Recebe os dados que serão enviados para a view.

    public function index()
    {
        unset(
            $_SESSION['user_id'],
            $_SESSION['user_cpf'],
            $_SESSION['user_name'],
            $_SESSION['user_image']
        );
        $this->data = [];
        $this->loadView();
    }

    public function loadView()
    {
        $loadView = new \Core\ConfigView();
        $loadView->loadView("app/sts/Views/err/pageErr", $this->data);
    }
}
