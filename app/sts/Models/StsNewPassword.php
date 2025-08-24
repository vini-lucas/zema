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
class StsNewPassword
{
    private string|null $dataForm; // -> Recebe os dados que que a controller enviou.
    private bool $result; // -> Recebe o resultado da QUERY solicitada em 'login()'. 

    public function getResult(): bool
    {
        return $this->result;
    }

    public function readUser(string $dataForm)
    {
        $this->dataForm = $dataForm;
        $readUser = new \Sts\Models\helper\StsRead();
        $readUser->fullRead("SELECT recover_password FROM sts_users WHERE recover_password=:recover_password", "recover_password={$this->dataForm}");
        if ($readUser->getResultDb() != null) {
            $this->result = true;
        } else {
            $this->result = false;
        }
    }
}
