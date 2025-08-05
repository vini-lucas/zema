<?php

namespace Sts\Models\helper;

class StsRead extends StsConn
{
    private string $prime_query; // -> Recebe a QUERY bruta informada.
    private string $full_query; // -> Recebe a QUERY preparada.
    private array|null $resultDb; // -> Recebe a QUERY com o resultado da busca do usuário.
    private array $values; // Recebe os links da parse string em forma de array.
    private string|null $terms; // -> Recebe o "WHERE" da QUERY.

    /**
     * @return array|null Retorna o $this->resuldDb.
     */
    function getResultDb(): array|null
    {
        return $this->resultDb;
    }

    public function exeRead(string $query, string|null $terms = null, string|null $parseString = null)
    {
        //"SELECT id, name FROM users", "WHERE name=:name AND id=:id", "name=lucas&id=1"
        $this->prime_query = $query;
        $this->terms = $terms;
        parse_str($parseString, $this->values);
        $this->exeParameter();
    }

    private function exeParameter()
    {
        if((!empty($this->terms)) AND (!empty($this->values))){
            foreach($this->values AS $link => $value){
                $this->prime_query->bindParam($)
                $this->full_query = $this->prime_query . " " . $this->terms;
            }
        }
    }
}
