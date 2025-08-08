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
class StsLogin
{
    private array|null $dataForm; // -> Recebe os dados que que a controller enviou.
    private array|bool $result; // -> Recebe o resultado da QUERY solicitada em 'login()'. 
    private $valPass;

    public function getResult(): array|bool
    {
        return $this->result;
    }

    public function login(array|null $dataForm = null)
    {
        $this->dataForm = $dataForm;
        $valLogin = new \Sts\Models\helper\StsRead();
        $valLogin->fullRead("SELECT id, cpf, name, email, password, image FROM sts_users WHERE cpf=:cpf", "cpf={$this->dataForm['cpf']}");
        if ($valLogin->getResultDb()) {
            $this->valPassword();
        } else {
            $_SESSION['msg'] = "<p style='color: red;'>Usuário e/ou senha inválido(a)!</p>";
            $this->result = false;
        }
    }

    private function valPassword()
    {
        if (password_verify($this->dataForm['password'], $this->valPass[0]['password'])) {

        } else {
        }
    }
}
