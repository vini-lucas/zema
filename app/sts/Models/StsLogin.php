<?php

namespace Sts\Models;

use Sts\Models\helper\StsConn;

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
    private array|null $data; // -> Recebe os dados que que a controller enviou.
    private array|bool $result; // -> Recebe o resultado da QUERY solicitada em 'login()'. 

    public function getResult(): array|bool
    {
        return $this->result;
    }

    public function login(array|null $data = null)
    {
        $this->data = $data;
        $valLogin = new \Sts\Models\helper\StsRead();
        $valLogin->fullRead("SELECT id, name, email, password, image FROM sts_users WHERE cpf=:cpf", "cpf={$this->data['cpf']}");
        if ($valLogin->getResult()){
            $this->valPassword($valLogin->getResult());
        } else {
            $_SESSION['msg'] = "<p style='color: red;'>Usuário e/ou senha inválido(a)!</p>";
            $this->result = false;
        }
    }

    private function valPassword($pass)
    {
        if (password_verify($this->data['password'], $pass[0]['password'])) {

        }
    }
}
