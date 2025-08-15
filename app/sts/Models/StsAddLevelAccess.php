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
class StsAddLevelAccess
{
    private array|null $dataForm; // -> Recebe os dados que que a controller enviou.
    private bool $result; // -> Recebe o resultado da QUERY solicitada em 'login()'. 

    public function getResult(): bool
    {
        return $this->result;
    }

    public function validadeLevelAccess(array $dataForm)
    {
        $this->dataForm = $dataForm;
        $valLevelAccess = new \Sts\Models\helper\StsRead();
        $valLevelAccess->fullRead("SELECT name FROM sts_access_levels WHERE name=:name", "name={$this->dataForm['name']}");
        if ($valLevelAccess->getResultDb() == null){
            $this->createLevelAccess();
        } else {
            $_SESSION['msg'] = "<p style='color: red;'>Nível de Acesso já cadastrado no sistema!</p>";
            $this->result = false;
        }
    }

    private function createLevelAccess()
    {
        $createUser = new \Sts\Models\helper\StsCreate();
        $createUser->exeCreate("sts_access_levels", $this->dataForm);
        if ($createUser->getResult()){
            $_SESSION['msg'] = "<p style='color: green;'>Nível de Acesso cadastrado com sucesso!</p>";
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p style='color: red;'>Nível de Acesso não cadastrado com sucesso!</p>";
            $this->result = false;
        }
    }
}
