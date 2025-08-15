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
class DeleteAccessLevel
{
    public function index()
    {
        $level_access = filter_input(INPUT_GET, 'access-level', FILTER_DEFAULT);
        $id = filter_input(INPUT_GET, 'id', FILTER_DEFAULT);
        $cookie_level_access = 
        $del_level_access = new \Sts\Models\helper\StsDelete();
        if ($level_access == $_SESSION['access_level']) {
            $_SESSION['msg'] = "<p style='color: red;'>Seu usuário utiliza este Nível de Acesso!</p>";
            header("Location: " . URL . "list-levels-access/index");
            exit;
        } else {
            $del_level_access->exeDelete("sts_access_levels", "id=:id", "id=$id");
            if ($del_level_access->getResult()) {
                $_SESSION['msg'] = "<p style='color: green;'>Nível de Acesso excluído com sucesso!</p>";
                header("Location: " . URL . "list-levels-access/index");
                exit;
            } else {
                $_SESSION['msg'] = "<p style='color: red;'>Nível de Acesso não excluído com sucesso!</p>";
                header("Location: " . URL . "list-levels-access/index");
                exit;
            }
        }
    }
}
