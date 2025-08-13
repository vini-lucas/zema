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
class StsEditUser
{
    private array|null $dataForm; // -> Recebe os dados que a controller enviou.
    private bool $result; // -> Recebe o resultado da QUERY solicitada em 'login()'. 
    private array $resultDb;

    public function getResult(): bool
    {
        return $this->result;
    }

    public function getResultDb(): array
    {
        return $this->resultDb;
    }

    public function searchUser(int $id)
    {
        $searchUser = new \Sts\Models\helper\StsRead();
        $searchUser->fullRead("SELECT id, name, gender, date_birth, telephone, email, modified FROM sts_users WHERE id=:id", "id={$id}");
        if ($searchUser->getResultDb()) {
            $this->result = true;
            $this->resultDb = $searchUser->getResultDb();
        } else {
            $this->result = false;
        }
    }

    public function exeUpdateUser(int $id, array $dataForm)
    {
        $this->dataForm = $dataForm;
        $userEdit = new \Sts\Models\helper\StsUpdade(); // -> Instancia o helper para editar registros no Banco de Dados.
        $userEdit->exeUpdate("sts_users", $this->dataForm, "WHERE id=:id", "id={$id}"); // -> Passa os parâmetros que irão construir a QUERY.
        if ($userEdit->getResult()) {
            $_SESSION['msg'] = "<p style='color: green;'>Usuário editado com sucesso!</p>";
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p style='color: red;'>Usuário não editado com sucesso!</p>";
            $this->result = false;
        }
    }
}
