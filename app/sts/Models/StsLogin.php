<?php

namespace Sts\Models;

/**
 * Caso o usuário tente acessar a página sem ser pelo arquivo index, acessa este if.
 */
if (!defined('L4bar3tTA!')) {
    header("Location: /");
}


class StsLogin
{
    private bool $result; // Retorna o resultado do "getResult()".
    private array|null $resultDb; // Retorna o resultado do "getResultDb()".
    public string|array|null $data; // -> Recebe os dados que serão enviados para a controller.

    public function getResult(): bool
    {
        return $this->result;
    }

    public function getResultDb(): array
    {
        return $this->resultDb;
    }
}
