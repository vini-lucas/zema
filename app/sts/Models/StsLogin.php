<?php

namespace Sts\Models;

use Sts\Models\helper\Conn;

class StsLogin extends Conn
{
    private bool $result; // Retorna o resultado do "getResult()".
    private array $resultDb; // Retorna o resultado do "getResultDb()".

    public function getResult(): bool
    {
        return $this->result;
    }

    public function getResultDb(): array
    {
        return $this->resultDb;
    }

    public function teste()
    {
        $teste = "SELECT * FROM users";
        $query = $this->connect->prepare($teste);
        
        if ($query->execute()){
            $this->resultDb = $query;
            $this->result = true;
        } else {
            $this->result = false;
        }
    }
}
