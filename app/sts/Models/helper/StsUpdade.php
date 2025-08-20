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
    private array $data; // -> Recebe um array com os valores que serão editados.
    private string|null $terms; // -> Recebe um array com os termos da QUERY.
    private string|null $parseString; // -> Recebe um array com a parse string da QUERY.
    private array $values = []; // -> Recebe um array com a parse string informada.
    private bool $result; // -> Retorna TRUE se executou com sucesso a QUERY e false se não executou.
    private string $query; // -> Recebe a QUERY.
    private object $update; // -> Recebe a QUERY preparada.

    public function getResult(): bool
    {
        return $this->result;
    }

    public function exeUpdate(string $table, array $data, string|null $terms = null, string|null $parseString = null)
    {
        $this->table = $table;
        $this->data = $data;
        $this->terms = $terms;
        parse_str($parseString, $this->values);
        $this->exeReplaceValues();
    }

    private function exeReplaceValues()
    {
        foreach ($this->data as $link => $value) {
            $values[] = $link . "=:" . $link;
        }
        $values = implode(', ', $values);
        $this->query = "UPDATE {$this->table} SET $values {$this->terms}";
        $this->exeInstruction();
    }

    private function exeInstruction()
    {
        try {
            $this->update = $this->conection()->prepare($this->query);
            $this->update->execute(array_merge($this->data, $this->values));
            $this->result = true;
        } catch (PDOException $err) {
            if (strpos($err->getMessage(), 'Integrity constraint violation: 1062')) {
                $_SESSION['msg-helper'] = "<p style='color: red;'>Um ou mais registros inseridos já estão sendo utilizados por outro usuário!</p>";
                $this->result = false;
            }
            $this->result = false;
        }
    }
}
