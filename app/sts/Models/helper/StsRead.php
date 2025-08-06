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
class StsRead extends StsConn
{
    private array|null $result = []; // -> Recebe o resultado da busca da QUERY.
    private string $select; // -> Recebe a QUERY select com a tabela informada pelo uusário.
    private object $conn; // -> Recebe o objeto que possui a conexão com o banco de dados.
    private object $query; // -> Recebe a QUERY preparada.

    /**
     * Retorna o valor do atributo result.
     * @return array|null
     */
    public function getResult(): array|null
    {
        return $this->result;
    }

    public function exeRead(string $table, string|null $terms = null, string|null $parseString = null)
    {
        $this->select = "SELECT * FROM {$table}";
        $this->exeInstruction();
    }

    private function exeInstruction()
    {
        $this->connection();
        try {
            $this->query->execute();
            $this->result = $this->query->fetchAll();
        } catch (PDOException $err) {
            $this->result = null;
        }
    }

    /**
     * Função que recebe a conexão com o banco de dados, prepara e lê a QUERY.
     * @return void
     */
    private function connection(): void
    {
        $this->conn = $this->conection();
        $this->query = $this->conn->prepare($this->select);

        /* "setFetchMode(PDO::FETCH_ASSOC)" retorna um array associativo. */
        $this->query->setFetchMode(PDO::FETCH_ASSOC);
    }
}
