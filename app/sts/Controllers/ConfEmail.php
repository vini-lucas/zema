<?php

namespace Sts\Controllers;

/**
 * Caso o usuário tente acessar a página sem ser pelo arquivo index, acessa este if.
 */
if (!defined('L4bar3tTA!')) {
    header("Location: /");
}

/**
 * Classe responsável em ativar o usuário que cadastrou-se recentemente.
 */
class ConfEmail
{

    public function index()
    {
        $email = filter_input(INPUT_GET, 'key', FILTER_DEFAULT);
        var_dump($email);
    }
}
