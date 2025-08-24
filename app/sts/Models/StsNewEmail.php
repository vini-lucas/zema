<?php

namespace Sts\Models;

/**
 * Caso o usuário tente acessar a página sem ser pelo arquivo index, acessa este if.
 */
if (!defined('L4bar3tTA!')) {
    header("Location: /");
}

/**
 * Models da controller register.
 */
class StsNewEmail
{
    private string|null $dataForm; // -> Recebe os dados que que a controller enviou.
    private bool $result; // -> Recebe o resultado da QUERY solicitada em 'login()'. 

    public function getResult(): bool
    {
        return $this->result;
    }

    public function alterEmail(string $dataForm)
    {
        $this->dataForm = $dataForm;
        $data['conf_email'] = password_hash("1234", PASSWORD_DEFAULT);
        $alterEmail = new \Sts\Models\helper\StsUpdade();
        $alterEmail->exeUpdate("sts_users", $data, "WHERE cpf=:cpf", "cpf={$this->dataForm}");
        if ($alterEmail->getResult()) {
            $this->result = true;
        } else {
            $this->result = false;
        }
    }
}
