<?php

namespace Sts\Models;

/**
 * Caso o usuário tente acessar a página sem ser pelo arquivo index, acessa este if.
 */
if (!defined('L4bar3tTA!')) {
    header("Location: /");
}

/**
 * Models da controller login.
 */
class StsListColors
{
    private bool $result;
    private array $resultDb;

    public function getResult(): bool
    {
        return $this->result;
    }

    public function getResultDb(): array
    {
        return $this->resultDb;
    }

    public function colorsDatabase()
    {
        $colors = new \Sts\Models\helper\StsRead();
        $colors->fullRead("SELECT id, name, color, created, modified
                          FROM sts_colors  
                          LIMIT :limit", "limit=40");
        if ($colors->getResultDb()) {
            $this->result = true;
            $this->resultDb = $colors->getResultDb();
        } else {
            $this->result = false;
        }
    }
}
