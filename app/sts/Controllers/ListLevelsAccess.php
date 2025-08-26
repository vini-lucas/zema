<?php

namespace Sts\Controllers;

/**
 * Caso o usuário tente acessar a página sem ser pelo arquivo index, acessa este if.
 */
if (!defined('L4bar3tTA!')) {
    header("Location: /");
}

class ListLevelsAccess
{
    private array|null $data; // -> Recebe os dados que serão enviados para a view.
    private array|null $dataForm; // -> Recebe os dados que o usuário informou no formulário.

    public function index()
    {
        $listLevelAccess = new \Sts\Models\StsListLevelsAccess();
        $listLevelAccess->accessLevelsDatabase();
        if ($listLevelAccess->getResult()) {
            $this->data['form'] = $listLevelAccess->getResultDb();
        } else {
            $_SESSION['msg'] = MSG_REGISTER_NOT_FOUND;
            $this->data['form'] = $this->dataForm;
        }
        $this->loadView();
    }

    public function loadView()
    {
        $loadView = new \Core\ConfigView();
        $loadView->loadView("app/sts/Views/level_access/listLevelsAccess", $this->data);
    }
}
