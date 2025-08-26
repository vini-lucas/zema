<?php

namespace Sts\Models\helper;

/**
 * Caso o usuário tente acessar a página sem ser pelo arquivo index, acessa este if.
 */
if (!defined('L4bar3tTA!')) {
    header("Location: /");
}

/**
 * Helper responsável em verificar se os campos foram preenchidos.
 */
class StsStrengthPassword
{
    private bool $result; // -> Recebe o resultado da QUERY.
    private string $data = ""; // -> Recebe os inputs que serão validados por este helper.

    /**
     * Recebe true se a senha é boa ou false se não for boa.
     * @return boolean
     */
    public function getResult(): bool
    {
        return $this->result;
    }

    public function valStrengthPassword(string $data)
    {
        $this->data = $data;
        if (strpos($this->data, " ")) {
            $_SESSION['msg'] = MSG_SPACE_WHITE;
            $this->result = false;
        } else if (strpos($this->data, "'")) {
            $_SESSION['msg'] = MSG_QUOT_SIMPLE;
            $this->result = false;
        } else if ((strpos($this->data, '"'))) {
            $_SESSION['msg'] = MSG_QUOT_SIMPLE;
            $this->result = false;
        } else if (strlen($this->data) < 8) {
            $_SESSION['msg'] = MSG_MORE_8_CARACTERER;
            $this->result = false;
        } else {
            $this->result = true;
        }
    }
}
