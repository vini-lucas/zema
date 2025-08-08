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
    private array|null $resultDb = []; // -> Recebe o resultado da busca da QUERY.
    private array|null $values = null; // -> Recebe a parse string em formato de array.
    private string $select; // -> Recebe a QUERY select com a tabela informada pelo uusário.
    private object $conn; // -> Recebe o objeto que possui a conexão com o banco de dados.
    private object $query; // -> Recebe a QUERY preparada.

    /**
     * Retorna o valor do atributo resultDb.
     * @return array|null
     */
    public function getResultDb(): array|null
    {
        return $this->resultDb;
    }

    /**
     * Retorna todos as colunas da tabela informada pelo usuário.
     * @param string $table
     * @param string|null|null $terms
     * @param string|null|null $parseString
     * @return void
     */
    public function exeRead(string $table, string|null $terms = null, string|null $parseString = null): void
    {
        if (!empty($parseString)) {

            /* Exemplo do que "parse_str()" faz:
             * 'id=1&name=lucas' fica '['id' => 1, 'name' => lucas]'. */
            parse_str($parseString, $this->values);
        }
        $this->select = "SELECT * FROM {$table}";
        $this->exeInstruction();
    }

    /**
     * Retorna somente as colunas informadas pelo usuário.
     * @param string $query
     * @param string|null|null $parseString
     * @return void
     */
    public function fullRead(string $query, string|null $parseString = null): void
    {
        $this->select = $query;
        if (!empty($parseString)) {

            /* Exemplo do que "parse_str()" faz:
             * 'id=1&name=lucas' fica '['id' => 1, 'name' => lucas]'. */
            parse_str($parseString, $this->values);
        }
        $this->exeInstruction();
    }

    private function exeInstruction()
    {
        $this->connection();
        try {
            $this->query->execute();
            $this->resultDb = $this->query->fetchAll();
        } catch (PDOException $err) {
            $this->resultDb = null;
            echo $err -> getMessage();
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
        $this->exeParameter();

        /* "setFetchMode(PDO::FETCH_ASSOC)" retorna um array associativo. */
        $this->query->setFetchMode(PDO::FETCH_ASSOC);
    }

    private function exeParameter()
    {
        if ($this->values) {
            foreach ($this->values as $link => $value) {
                if (($link == 'limit') || ($link == 'offset') || ($link == 'id')) {
                    $value = (int)$value;
                }
                $this->query->bindParam(":{$link}", $value, (is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR));
            }
        }
    }
}
