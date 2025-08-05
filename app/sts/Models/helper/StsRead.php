<?php

namespace Sts\Models\helper;

class StsRead extends StsConn
{
    private string $prime_query; // -> Recebe a QUERY bruta informada.
    private string $full_query; // -> Recebe a QUERY preparada.
    private array|null $resultDb; // -> Recebe a QUERY com o resultado da busca do usuário.
    private array|null $valuesParseStr; // Recebe os links da parse string em forma de array.
    private string|null $terms; // -> Recebe os valores do "WHERE" da QUERY.

    /**
     * @return array|null Retorna o $this->resuldDb.
     * Recebe o resultado da QUERY que o usuário informou para executar a função "exeRead()".
     */
    function getResultDb(): array|null
    {
        return $this->resultDb;
    }

    public function exeRead(string $query, string|null $terms = null, string|null $parseString = null)
    {
        $this->prime_query = $query; // -> Recebe a QUERY bruta que o usuário informou.
        $this->terms = $terms; // -> Recebe os termos (WHERE) que o usuário informou.
        parse_str($parseString, $this->valuesParseStr); // -> Recebe a parse string que o usuário enviou e passa seus valores para "$this->valuesParseStr".
        $this->clearQuery();
    }

    private function clearQuery()
    {
        $this->conection();
        if (!empty($this->valuesParseStr)) {
            foreach ($this->valuesParseStr as $linkParse => $valueParse) {
                extract($this->valuesParseStr);
                echo "Valores da Parse String: $linkParse => $valueParse<br>";
            }
            $termTemp = str_replace(['WHERE', 'AND', 'OR'], '', $this->terms);
            $termTemp = explode(" ", $termTemp);
            unset($termTemp[0], $termTemp[2]);
            var_dump($termTemp);
            var_dump($this->prime_query);
            var_dump($this->terms);
        }
    }
}
