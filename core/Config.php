<?php

namespace Core;

/**
 * Caso o usuário tente acessar a página sem ser pelo arquivo index, acessa este if.
 */
if (!defined('L4bar3tTA!')) {
    header("Location: /");
}


/**
 * Classes abstratas não podem ser instanciadas, somente herdadas.
 */
abstract class Config 
{
    protected function config()
    {
        define('URL', 'http://localhost/zema/');
        define('URLADM', 'http://localhost/zema/adm');

        define('EMAILADM', 'lucasvini269@gmail.com');

        define('DB_NAME', 'zema');
        define('DB_PASS', 'L4bar3tTA!'); // -> Usuário para executar apenas comandos do CRUD.
        define('DB_USER', 'zema'); // -> Usuário para executar apenas comandos do CRUD.
        define('DB_PORT', 3306);

        define('ACCESS_NEW_USER', 4); // -> Nível de acesso que um novo usuário começa.
    }
}
