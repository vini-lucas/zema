<?php

namespace Sts\Controllers;

/**
 * Caso o usuário tente acessar a página sem ser pelo arquivo index, acessa este if.
 */
if (!defined('L4bar3tTA!')) {
    header("Location: /");
}

/**
 * Classe para excluir controller do Banco de Dados.
 */
class DeleteController
{
    public function index(int $id)
    {
        $delPage = new \Sts\Models\helper\StsDelete();
        $delPage->exeDelete("sts_pages", "id=:id", "id=$id");
        if ($delPage->getResult()) {
            $_SESSION['msg'] = MSG_ALT_PERF_SUCCESS;
            header("Location: " . URL . "pages-public-and-priv/index");
        } else {
            $_SESSION['msg'] = MSG_ALT_NOT_PERF_SUCCESS;
            header("Location: " . URL . "pages-public-and-priv/index");
        }
    }
}
