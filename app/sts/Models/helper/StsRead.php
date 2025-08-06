<?php

namespace Sts\Models\helper;

/**
 * Caso o usuário tente acessar a página sem ser pelo arquivo index, acessa este if.
 */
if (!defined('L4bar3tTA!')) {
    header("Location: /");
}


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


}
