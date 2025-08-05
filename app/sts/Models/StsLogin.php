<?php

namespace Sts\Models;
use Sts\Models\helper\Read;

class StsLogin
{
    private bool $result; // Retorna o resultado do "getResult()".
    private array|null $resultDb; // Retorna o resultado do "getResultDb()".

    public function getResult(): bool
    {
        return $this->result;
    }

    public function getResultDb(): array
    {
        return $this->resultDb;
    }
}
