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
    public $valPass; // -> Recebe o resultado da busca da QUERY.

    public function getResult(): array|bool
    {
        return $this->result;
    }

    public function login(array|null $dataForm = null)
    {
        $this->dataForm = $dataForm;
        $valLogin = new \Sts\Models\helper\StsRead();
        $valLogin->fullRead("SELECT users.id, users.cpf, users.name AS user_name, users.email, users.password, users.image, users.access_level_id, level_access.name AS level_access_name, users.sit_user_id
                            FROM sts_users AS users
                            INNER JOIN sts_access_levels AS level_access ON level_access.id=users.access_level_id
                            WHERE users.cpf=:cpf", "cpf={$this->dataForm['cpf']}");
        if ($valLogin->getResultDb()) {
            $this->valPass = $valLogin->getResultDb();
            $this->valPassword();
        } else {
            $_SESSION['msg'] = "<p style='color: red;'>Usuário e/ou senha inválido(a)!</p>";
            $this->result = false;
        }
    }

    private function valPassword()
    {
        if (password_verify($this->dataForm['password'], $this->valPass[0]['password'])) {
            if ($this->valPass[0]['sit_user_id'] == 3) {
                $_SESSION['msg'] = "<p style='color: red;'>Usuário aguardando confirmação, <a>CLIQUE AQUI</a> para solicitar sua ativação!</p>";
                $this->result = false;
            } else if ($this->valPass[0]['sit_user_id'] == 2) {
                $_SESSION['msg'] = "<p style='color: red;'>Usuário inativo!</p>";
                $this->result = false;
            } else {
                $_SESSION['user_id'] = $this->valPass[0]['id'];
                $_SESSION['user_cpf'] = $this->valPass[0]['cpf'];
                $_SESSION['user_name'] = $this->valPass[0]['user_name'];
                $_SESSION['user_image'] = $this->valPass[0]['image'];
                $_SESSION['user_access_level'] = $this->valPass[0]['level_access_name'];
                $this->result = true;
            }
        } else {
            $_SESSION['msg'] = "<p style='color: red;'>Usuário e/ou senha inválido(a)!</p>";
            $this->result = false;
        }
    }
}
