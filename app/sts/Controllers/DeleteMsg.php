<?php

namespace Sts\Controllers;

/**
 * Caso o usuário tente acessar a página sem ser pelo arquivo index, acessa este if.
 */
if (!defined('L4bar3tTA!')) {
    header("Location: /");
}

/**
 * Classe para excluir mensagem padrão do Banco de Dados.
 */
class DeleteMsg
{
    public function index(int $id)
    {
        $delEmail = new \Sts\Models\helper\StsDelete();
        $delEmail->exeDelete("sts_default_msg", "id=:id", "id=$id");
        if ($delEmail->getResult()) {
            $_SESSION['msg'] = MSG_ALT_PERF_SUCCESS;
            header("Location: " . URL . "default-msg/index");
        } else {
            $_SESSION['msg'] = MSG_ALT_NOT_PERF_SUCCESS;
            header("Location: " . URL . "default-msg/index");
        }
    }
}
