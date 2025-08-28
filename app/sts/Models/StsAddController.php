<?php

namespace Sts\Models;

/**
 * Caso o usuário tente acessar a página sem ser pelo arquivo index, acessa este if.
 */
if (!defined('L4bar3tTA!')) {
    header("Location: /");
}

/**
 * Models da controller AddController.
 */
class StsAddController
{
    private array|null $dataForm; // -> Recebe os dados que que a controller enviou.
    private bool $result; // -> Recebe o resultado da QUERY solicitada em 'login()'. 

    public function getResult(): bool
    {
        return $this->result;
    }

    public function createController(array $dataForm)
    {
        $createController = new \Sts\Models\helper\StsCreate();
        $createController->exeCreate("sts_pages", $dataForm);
        if ($createController->getResult()){
            $_SESSION['msg'] = MSG_ALT_PERF_SUCCESS;
            $this->result = true;
        } else {
            $_SESSION['msg'] = MSG_ALT_NOT_PERF_SUCCESS;
            $this->result = false;
        }
    }
}
