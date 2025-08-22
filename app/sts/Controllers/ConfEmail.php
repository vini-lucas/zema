<?php

namespace Sts\Controllers;

/**
 * Caso o usuário tente acessar a página sem ser pelo arquivo index, acessa este if.
 */
if (!defined('L4bar3tTA!')) {
    header("Location: /");
}

/**
 * Classe responsável em ativar o usuário que cadastrou-se recentemente.
 */
class ConfEmail
{

    public function index()
    {
        $email = filter_input(INPUT_GET, 'key', FILTER_DEFAULT);
        $readKey = new \Sts\Models\helper\StsRead();
        $readKey->fullRead("SELECT conf_email FROM sts_users WHERE conf_email=:conf_email", "conf_email=$email");
        if ($readKey->getResultDb()) {
            $data['sit_user_id'] = 1;
            $upKey = new \Sts\Models\helper\StsUpdade();
            $upKey->exeUpdate("sts_users", $data, "WHERE conf_email=:conf_email", "conf_email=$email");
            if ($upKey->getResult()) {
                $_SESSION['msg'] = "<p style='color: green;'>Usuário ativado com sucesso, realize o login com seu CPF e senha!</p>";
                header("Location: " . URL . "login/index");
            } else {
                $_SESSION['msg'] = "<p style='color: red;'>Link inválido, solicite um novo para seguimento! nao editou com sucesso</p>";
                header("Location: " . URL . "login/index");
            }
        } else {
            $_SESSION['msg'] = "<p style='color: red;'>Link inválido, solicite um novo para seguimento! nao encontrou o user</p>";
            //header("Location: " . URL . "login/index");
            var_dump($readKey->getResultDb());
            echo "<p style='color: red;'>Link inválido, solicite um novo para seguimento! nao encontrou o user</p>";;
        }
    }
}
