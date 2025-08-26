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
class StsEditLevelAccess
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

    public function searchLevelAccess(int $id)
    {
        $searchLevelAccess = new \Sts\Models\helper\StsRead();
        $searchLevelAccess->fullRead("SELECT id, name, created, modified FROM sts_access_levels WHERE id=:id", "id={$id}");
        if ($searchLevelAccess->getResultDb()) {
            $this->result = true;
            $this->resultDb = $searchLevelAccess->getResultDb();
        } else {
            $this->result = false;
        }
    }

    public function exeUpdateLevelAccess(int $id, array $dataForm)
    {
        $this->dataForm = $dataForm;
        $leveEdit = new \Sts\Models\helper\StsUpdade(); // -> Instancia o helper para editar registros no Banco de Dados.
        $leveEdit->exeUpdate("sts_access_levels", $this->dataForm, "WHERE id=:id", "id={$id}"); // -> Passa os parâmetros que irão construir a QUERY.
        if ($leveEdit->getResult()) {
            $_SESSION['msg'] = MSG_ALT_PERF_SUCCESS;
            $this->result = true;
        } else {
            if (isset($_SESSION['msg-helper'])) {
                $this->result = false;
            } else {
                $_SESSION['msg'] = MSG_ALT_NOT_PERF_SUCCESS;
                $this->result = false;
            }
            $this->result = false;
        }
    }
}
