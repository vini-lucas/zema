<?php

namespace Sts\Models\helper;

/**
 * Caso o usuário tente acessar a página sem ser pelo arquivo index, acessa este if.
 */
if (!defined('L4bar3tTA!')) {
    header("Location: /");
}

/**
 * Helper responsável em verificar se o campo e-mail foi preenchido corretamente.
 */
class StsValEmail
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

    public function valEmail(string $data)
    {
        $this->data = $data;
        if (filter_var($this->data, FILTER_VALIDATE_EMAIL)) {
            $this->result = true;
        } else {
            $_SESSION['msg'] = MSG_EMAIL_INVALID;
            $this->result = false;
        }
    }
}
