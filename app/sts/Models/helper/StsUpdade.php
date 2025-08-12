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

    public function exeUpdate(string $table, array $primeValues, array $fullValues)
    {
        $this->table = $table;
        $this->primeValues = $primeValues;
        $this->fullValues = $fullValues;
        var_dump($this->table);
        var_dump($this->primeValues);
        var_dump($this->fullValues);
        $this->exeInstruction();
    }

    private function exeInstruction()
    {
        
    }
}
