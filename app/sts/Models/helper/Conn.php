<?php

namespace Sts\Models\helper;

use PDO;
use PDOException;

abstract class Conn
{
    public object $connect; // -> Recebe o objeto da conexão com o banco de dados.

    protected function conection(): object
    {
        try {
            $this->connect = new PDO("mysql:port=" . DB_PORT . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
            echo "Conexão bem-estabelecida!";
        } catch (PDOException $err) {
            echo "Erro: ==> " . $err->getMessage();
        }
        return $this->connect;
    }
}
