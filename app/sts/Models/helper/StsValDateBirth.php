<?php

namespace Sts\Models\helper;

use DateTime;

/**
 * Caso o usuário tente acessar a página sem ser pelo arquivo index, acessa este if.
 */
if (!defined('L4bar3tTA!')) {
    header("Location: /");
}

/**
 * Helper responsável em verificar se o usuário possui ou não mais de 18 anos.
 */
class StsValDateBirth
{
    private bool $result; // -> Recebe o resultado da QUERY.
    private string $data = ""; // -> Recebe os inputs que serão validados por este helper.

    /**
     * Recebe true se preencheu com sucesso ou false se não preencheu.
     * @return boolean
     */
    public function getResult(): bool
    {
        return $this->result;
    }

    public function valDateBirth(string $data)
    {
        $this->data = $data;
        $now = new DateTime();
        $date_birth = new DateTime($this->data);
        $years = $now->diff($date_birth)->y;
        if ($years >= 18) {
            $this->result = true;
        } else {
            $_SESSION['msg'] = MSG_18_YEARS;
            $this->result = false;
        }
    }
}
