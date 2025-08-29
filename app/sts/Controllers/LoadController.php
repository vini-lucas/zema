<?php

namespace Sts\Controllers;

/**
 * Caso o usuário tente acessar a página sem ser pelo arquivo index, acessa este if.
 */
if (!defined('L4bar3tTA!')) {
    header("Location: /");
}

class LoadController
{
    private array|null $data; // -> Recebe os dados que serão enviados para a view.
    private array|null $dataForm; // -> Recebe os dados que o usuário informou no formulário.

    public function index()
    {
        $loadController = new \Sts\Models\StsLoadController();
        $loadController->searchControllers();
        if ($loadController->getResult()) {
            $this->data['select'] = $loadController->getResultDb();
            $this->data['form'] = $loadController->readControllerActive();
            $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            if (!empty($this->dataForm['SendController'])) {
                unset($this->dataForm['SendController']);
                $upController = new \Sts\Models\StsLoadController();
                $upController->upController($this->dataForm);
                if ($upController->getResult()) {
                    header("Location: " . URL . "config-site/index");
                    exit;
                } else {
                    header("Location: " . URL . "config-site/index");
                    exit;
                }
            } else {
                $this->data['select'] = $loadController->getResultDb();
            }
        } else {
            $this->data = [];
        }
        $this->loadView();
    }

    public function loadView()
    {
        $loadView = new \Core\ConfigView();
        $loadView->loadView("app/sts/Views/config_site/loadController", $this->data);
    }
}
