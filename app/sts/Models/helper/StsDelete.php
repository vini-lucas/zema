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
 * Helper responsável em deletar registros no banco de dados.
 */
class StsDelete extends StsConn
{
    private string $table; // -> A tabela do usuário que será deletado.
    private array $terms = []; // -> Recebe a condição da QUERY que será executada.
    private string $parseString; // -> Recebe a parse string que será executada na QUERY.
    private int $id; // -> Recebe o ID do usuário que será excluído, para zerar o auto incremento.
    private bool $result; // -> Recebe o resultado da QUERY;
    private object $query; // -> Recebe a QUERY preparada.
    private array $values = []; // -> Recebe os valores da parse string;

    public function getResult(): bool
    {
        return $this->result;
    }

    public function exeDelete(string $table, string $terms, string $parseString)
    {
        $this->table = $table;
        parse_str($terms, $this->terms);
        parse_str($parseString, $this->values);
        $this->exeInstruction();
    }

    private function exeInstruction()
    {
        foreach ($this->terms as $link => $value) {
            foreach ($this->values as $link2 => $value2) {
            }
        }
        $value = $value2;
        $this->id = $value;
        $query = "DELETE FROM {$this->table} WHERE {$link}=:link";
        try {
            $this->query = $this->conection()->prepare($query);
            $this->query->bindParam(':link', $this->id);
            $this->query->execute();
            $this->resetAutoIncrement();
            $this->result = true;
        } catch (PDOException $err) {
            if (strpos($err->getMessage(), 'Integrity constraint violation: 1217')) {
                $_SESSION['msg-helper'] = "<p style='color: red;'>Registro sendo utilizado por outro usuário!</p>";
                $this->result = false;
            }
            $this->result = false;
        }
    }

    private function resetAutoIncrement()
    {
        $query = $this->conection()->prepare("SELECT MAX(id) AS last_id FROM {$this->table}");
        $query->execute();
        $query = $query->fetch(PDO::FETCH_ASSOC);
        $last_id = $query['last_id'] - 1;
        $aI = $this->conection()->prepare("ALTER TABLE {$this->table} AUTO_INCREMENT = $last_id");
        $aI->execute();
    }
}
