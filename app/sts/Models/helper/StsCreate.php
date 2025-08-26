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
 * Helper responsável em criar registros no banco de dados.
 */
class StsCreate extends StsConn
{
    private string $table; // -> Tabela onde o registro será inserido.
    private array $data; // -> Os dados do registro que será criado na tabela do Banco de Dados.
    private string $query; // -> Recebe a QUERY.
    private object $fullQuery; // -> Recebe a QUERY preparada.
    private bool $result; // -> Recebe o resultado da QUERY.
    private object $conn; // -> Recebe a conexão com o Banco de Dados.

    /**
     * Recebe true se criou com sucesso ou false se não criou.
     * @return boolean
     */
    public function getResult(): bool
    {
        return $this->result;
    }

    /**
     * Recebe os parâmetros para executar a QUERY.
     * @return void
     */
    public function exeCreate(string $table, array $data)
    {
        $this->table = $table;
        $this->data = $data;
        $this->clearQuery();
    }

    private function clearQuery()
    {
        /* A função 'array_keys()' lê somente as chaves das posições do array e não seus valores. */
        $coluns = implode(', ', array_keys($this->data));
        $values = ':' . implode(', :', array_keys($this->data));
        $this->query = "INSERT INTO {$this->table} ($coluns) VALUES ($values)";
        $this->exeInstruction();
    }

    private function exeInstruction()
    {
        $this->conn = $this->conection();
        try {
            $this->fullQuery = $this->conn->prepare($this->query);
            $this->fullQuery->execute($this->data);
            $this->result = true;
        } catch (PDOException $err) {
            if (strpos($err->getMessage(), 'Integrity constraint violation: 1062')) {
                $_SESSION['msg-helper'] = MSG_VIOLATION_1062;
                $this->result = false;
            }
            $this->result = false;
        }
    }
}
