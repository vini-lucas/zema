<?php

namespace Sts\Controllers;

/**
 * Caso o usuário tente acessar a página sem ser pelo arquivo index, acessa este if.
 */
if (!defined('L4bar3tTA!')) {
    header("Location: /");
}

class Home
{
    public function index()
    {
        echo "<h2> Página Home </h2>";
    }
}