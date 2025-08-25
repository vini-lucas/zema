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
class StsAddEmail
{
    private array|null $dataForm; // -> Recebe os dados que que a controller enviou.
    private bool $result; // -> Recebe o resultado da QUERY solicitada em 'login()'. 

    public function getResult(): bool
    {
        return $this->result;
    }

    public function validadeEmaill(array $dataForm)
    {
        $this->dataForm = $dataForm;
        $valEmail = new \Sts\Models\helper\StsRead();
        $valEmail->fullRead("SELECT email FROM sts_confs_emails WHERE email=:email", "cpf={$this->dataForm['email']}");
        if ($valEmail->getResultDb() == null){
            $this->createEmail();
        } else {
            $_SESSION['msg'] = "<p style='color: red;'>O e-mail informado já possui cadastro!</p>";
            $this->result = false;
        }
    }

    private function createEmail()
    {
        $createEmail = new \Sts\Models\helper\StsCreate();
        $createEmail->exeCreate("sts_confs_emails", $this->dataForm);
        if ($createEmail->getResult()){
            $_SESSION['msg'] = "<p style='color: green;'>E-mail cadastrado com sucesso!</p>";
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p style='color: red;'>E-mail não cadastrado com sucesso!</p>";
            $this->result = false;
        }
    }
}
