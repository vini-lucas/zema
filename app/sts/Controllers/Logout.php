<?php

namespace Sts\Controllers;

/**
 * Caso o usuário tente acessar a página sem ser pelo arquivo index, acessa este if.
 */
if (!defined('L4bar3tTA!')) {
    header("Location: /");
}


class Logout
{
    public function index()
    {
        unset(
            $_SESSION['user_id'],
            $_SESSION['user_cpf'],
            $_SESSION['user_name'],
            $_SESSION['user_image'],
            $_SESSION['access_level'],
            $_SESSION['user_access_level']
        );
        header("Location: " . URL . "login/index");
    }
}
