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
    public function index(int $id)
    {
        $delEmail = new \Sts\Models\helper\StsDelete();
        $delEmail->exeDelete("sts_confs_emails", "id=:id", "id=$id");
        if ($delEmail->getResult()) {
            $_SESSION['msg'] = "<p style='color: green'>E-mail excluído com sucesso!</p>";
            header("Location: " . URL . "list-emails/index");
        } else {
            $_SESSION['msg'] = "<p style='color: red'>E-mail não excluído com sucesso!</p>";
            header("Location: " . URL . "list-emails/index");
        }
    }
}
