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

/**
 * Helper responsável em buscar registros no banco de dados.
 */
class StsUpdade extends StsConn
{
    private string $table; // -> Recebe a tabela do registro que será editado.
    private array $primeValues; // -> Recebe um array com os valores que serão editados.
    private array $fullValues; // -> Recebe um array com os valores que substituirão os antigos.
    private string|null $terms; // -> Recebe um array com os termos da QUERY.
    private string|null $parseString; // -> Recebe um array com a parse string da QUERY.

    public function exeUpdate(string $table, array $primeValues, array $fullValues, string|null $terms = null, string|null $parseString = null)
    {
        $this->table = $table;
        $this->exeInstruction();
    }

    private function exeInstruction() {}
}
