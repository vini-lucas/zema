<?php

namespace Sts\Controllers;

/**
 * Caso o usuário tente acessar a página sem ser pelo arquivo index, acessa este if.
 */
if (!defined('L4bar3tTA!')) {
    header("Location: /");
}

class AddMsg
{
    private array|null $data; // -> Recebe os dados que serão enviados para a view.
    private array|null $dataForm; // -> Recebe os dados que o usuário informou no formulário.

    public function index()
    {
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->dataForm['SendAddMsg'])) {
            unset($this->dataForm['SendAddMsg']);
            $valInput = new \Sts\Models\helper\StsValInputField();
            $valInput->valInputField($this->dataForm);
            if ($valInput->getResult()) {
                $this->dataForm['created'] = date('Y-m-d H:i:s');
                $addMsg = new \Sts\Models\StsAddMsg();
                $addMsg->createMsg($this->dataForm);
                if ($addMsg->getResult()) {
                    header("Location: " . URL . "default-msg/index");
                    exit;
                } else {
                    header("Location: " . URL . "default-msg/index");
                    exit;
                }
            } else {
                $this->data['form'] = $this->dataForm;
            }
        } else {
            $this->data['form'] = $this->dataForm;
        }
        $this->loadView();
    }

    public function loadView()
    {
        $loadView = new \Core\ConfigView();
        $loadView->loadView("app/sts/Views/config_site/addMsg", $this->data);
    }
}
