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
class StsEditColor
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

    public function searchColor(int $id)
    {
        $searchUser = new \Sts\Models\helper\StsRead();
        $searchUser->fullRead("SELECT id, name, color, created, modified FROM sts_colors WHERE id=:id", "id={$id}");
        if ($searchUser->getResultDb()) {
            $this->result = true;
            $this->resultDb = $searchUser->getResultDb();
        } else {
            $this->result = false;
        }
    }

    public function exeUpdateColor(int $id, array $dataForm)
    {
        $this->dataForm = $dataForm;
        $emailEdit = new \Sts\Models\helper\StsUpdade(); // -> Instancia o helper para editar registros no Banco de Dados.
        $emailEdit->exeUpdate("sts_colors", $this->dataForm, "WHERE id=:id", "id={$id}"); // -> Passa os parâmetros que irão construir a QUERY.
        if ($emailEdit->getResult()) {
            $_SESSION['msg'] = MSG_ALT_PERF_SUCCESS;
            $this->result = true;
        } else {
            if (isset($_SESSION['msg-helper'])) {
                $this->result = false;
            } else {
                $_SESSION['msg'] = MSG_ALT_NOT_PERF_SUCCESS;
                $this->result = false;
            }
        }
    }
}
