<?php

namespace Sts\Controllers;

/**
 * Caso o usuário tente acessar a página sem ser pelo arquivo index, acessa este if.
 */
if (!defined('L4bar3tTA!')) {
    header("Location: /");
}

/**
 * Classe para excluir usuário do Banco de Dados.
 */
class DeleteEmail
{
    private int $id; // -> Recebe o ID do usuário que seré deletado.

    public function index(int $id)
    {
        $del_user = new \Sts\Models\helper\StsDelete();
        if ($id == $_SESSION['user_id']) {
            unset(
                $_SESSION['user_id'],
                $_SESSION['user_cpf'],
                $_SESSION['user_name'],
                $_SESSION['user_image']
            );
            $del_user->exeDelete("sts_users", "id=:id", "id={$id}");
        } else {
            $del_user->exeDelete("sts_users", "id=:id", "id={$id}");
        }

        if ($del_user->getResult()) {
            if ((!empty($_SESSION['user_id'])) and ($_SESSION['user_cpf'])) {
                $_SESSION['msg'] = "<p style='color: green;'>Usuário excluído com sucesso!</p>";
                header("Location: " . URL . "list-users/index");
            } else {
                $_SESSION['msg'] = "<p style='color: green;'>Usuário logado excluído com sucesso!</p>";
                header("Location: " . URL . "login/index");
            }
        } else {
            $_SESSION['msg'] = "<p style='color: red;'>Usuário não excluído com sucesso!</p>";
            header("Location: " . URL . "list-users/index");
        }
    }
}
