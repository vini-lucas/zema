<?php

namespace Sts\Controllers;

/**
 * Caso o usuário tente acessar a página sem ser pelo arquivo index, acessa este if.
 */
if (!defined('L4bar3tTA!')) {
    header("Location: /");
}

class DefaultMsg
{
    private array|null $data; // -> Recebe os dados que serão enviados para a view.
    private array|null $dataForm; // -> Recebe os dados que o usuário informou no formulário.

    public function index()
    {
        $searchMsg = new \Sts\Models\StsDefaultMsg;
        $searchMsg->searchMsg();
        if ($searchMsg->getResultDb() != null) {
            $this->data['form'] = $searchMsg->getResultDb();
        } else {
            header("Location: " . URL . "config-site/index");
        }
        /*$this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->dataForm['SendDefaultMsg'])) {

        } else {

        }
        $this->data = [];*/
        $this->loadView();
    }

    public function loadView()
    {
        $loadView = new \Core\ConfigView();
        $loadView->loadView("app/sts/Views/config_site/defaultMsg", $this->data);
    }
}
