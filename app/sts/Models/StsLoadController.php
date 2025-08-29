<?php

namespace Sts\Models;

/**
 * Caso o usuário tente acessar a página sem ser pelo arquivo index, acessa este if.
 */
if (!defined('L4bar3tTA!')) {
    header("Location: /");
}

/**
 * Models da controller register.
 */
class StsLoadController
{
    private array|null $dataForm; // -> Recebe os dados que que a controller enviou.
    private bool $result; // -> Recebe o resultado da QUERY solicitada em 'login()'. 
    private array|null $resultDb;

    public function getResult(): bool
    {
        return $this->result;
    }

    public function getResultDb(): array
    {
        return $this->resultDb;
    }

    public function searchControllers()
    {
        $searchControllers = new \Sts\Models\helper\StsRead();
        $searchControllers->fullRead("SELECT controller FROM sts_pages");
        if ($searchControllers->getResultDb() != null) {
            $this->resultDb = $searchControllers->getResultDb();
            $this->result = true;
        } else {
            $_SESSION['msg'] = MSG_REGISTER_NOT_FOUND;
            $this->result = false;
        }
    }

    public function readControllerActive()
    {
        $loadController = new \Sts\Models\helper\StsRead();
        $loadController->fullRead("SELECT controller FROM sts_load_controller");
        if ($loadController->getResultDb() != null) {
            return $loadController->getResultDb();
        }
    }

    public function upController(array $dataForm)
    {
        $upController = new \Sts\Models\helper\StsUpdade();
        $upController->exeUpdate("sts_load_controller", $dataForm);
        if ($upController->getResult()) {
            $_SESSION['msg'] = MSG_ALT_PERF_SUCCESS;
            $this->result = true;
        } else {
            $_SESSION['msg'] = MSG_ALT_NOT_PERF_SUCCESS;
            $this->result = false;
        }
    }
}
