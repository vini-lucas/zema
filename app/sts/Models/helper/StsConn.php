<?php

namespace Sts\Models\helper;

use PDO;
use PDOException;

/**
 * Caso o usuário tente acessar a página sem ser pelo arquivo index, acessa este if.
 */
if (!defined('L4bar3tTA!')) {
    header("Location: /");
}


abstract class StsConn
{
    public object $connect; // -> Recebe o objeto da conexão com o banco de dados.

    protected function conection(): object
    {
        try {
            $this->connect = new PDO("mysql:port=" . DB_PORT . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
        } catch (PDOException $err) {
            die(MSG_ERR_PAGE_NOT_FOUND_333 . '"' . EMAILADM . '"' . '.');
        }
        return $this->connect;
    }
}
