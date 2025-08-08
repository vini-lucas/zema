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
class StsRegister
{
    private array|null $dataForm; // -> Recebe os dados que que a controller enviou.
    private array|bool $result; // -> Recebe o resultado da QUERY solicitada em 'login()'. 

    public function getResult(): array|bool
    {
        return $this->result;
    }

    public function validadeCpf(array $dataForm)
    {
        $this->dataForm = $dataForm;
        $valCpf = new \Sts\Models\helper\StsRead();
        $valCpf->fullRead("SELECT cpf FROM sts_users WHERE cpf=:cpf", "cpf={$this->dataForm['cpf']}");
        if ($valCpf->getResultDb() == null){
            $this->createUser();
        } else {
            $_SESSION['msg'] = "<p style='color: red;'>Este CPF já possui cadastro!</p>";
        }
    }

    private function createUser()
    {
        $createUser = new \Sts\Models\helper\StsCreate();
        $createUser->exeCreate("sts_users", $this->dataForm);
        if ($createUser->getResult()){
            $_SESSION['msg'] = "<p style='color: green;'>Usuário cadastrado com sucesso!</p>";
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p style='color: red;'>Usuário não cadastrado com sucesso!</p>";
            $this->result = false;
        }
    }
}
