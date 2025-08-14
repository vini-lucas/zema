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
class StsEditPassword
{
    private array|string $dataForm; // -> Recebe os dados que a controller enviou.
    private bool $result; // -> Recebe o resultado da QUERY solicitada em 'login()'. 

    public function getResult(): bool
    {
        return $this->result;
    }

    public function editPass(int $id, array $dataForm)
    {
        $this->dataForm = $dataForm;
        $upPass = new \Sts\Models\helper\StsUpdade();
        $upPass->exeUpdate("sts_users", $this->dataForm, "WHERE id=:id", "id=$id");
        if ($upPass->getResult()) {
            $_SESSION['msg'] = "<p style='color: green;'>Senha editada com sucesso!</p>";
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p style='color: red;'>Senha editada com sucesso!</p>";
            $this->result = false;
        }
    }
}
