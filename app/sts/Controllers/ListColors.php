<?php

namespace Sts\Controllers;

/**
 * Caso o usuário tente acessar a página sem ser pelo arquivo index, acessa este if.
 */
if (!defined('L4bar3tTA!')) {
    header("Location: /");
}

class ListColors
{
    private array|null $data; // -> Recebe os dados que serão enviados para a view.
    private array|null $dataForm; // -> Recebe os dados que o usuário informou no formulário.

    public function index()
    {
        $listColors = new \Sts\Models\StsListColors();
        $listColors->colorsDatabase();
        if ($listColors->getResult()) {
            $this->data['form'] = $listColors->getResultDb();
        } else {
            $_SESSION['msg'] = MSG_REGISTER_NOT_FOUND;
            $this->data['form'] = $this->dataForm;
        }
        $this->loadView();
    }

    public function loadView()
    {
        $loadView = new \Core\ConfigView();
        $loadView->loadView("app/sts/Views/colors/listColors", $this->data);
    }
}
