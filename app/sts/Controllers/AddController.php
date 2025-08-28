<?php

namespace Sts\Controllers;

/**
 * Caso o usuário tente acessar a página sem ser pelo arquivo index, acessa este if.
 */
if (!defined('L4bar3tTA!')) {
    header("Location: /");
}

class AddController
{
    private array|null $data; // -> Recebe os dados que serão enviados para a view.
    private array|null $dataForm; // -> Recebe os dados que o usuário informou no formulário.

    public function index()
    {
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->dataForm['SendAddController'])) {
            unset($this->dataForm['SendAddController']);
            $valInput = new \Sts\Models\helper\StsValInputField();
            $valInput->valInputField($this->dataForm);
            if ($valInput->getResult()) {
                if (($this->dataForm['public'] != 1) AND (($this->dataForm['public'] != 0))) {
                    $_SESSION['msg'] = "<p style='color: red;'>Informe a privacidade da Página!</p>";
                    $this->data['form'] = $this->dataForm;
                } else {
                    $this->dataForm['created'] = date('Y-m-d H:i:s');
                    $addController = new \Sts\Models\StsAddController();
                    $addController->createController($this->dataForm);
                    if ($addController->getResult()) {
                        header("Location: " . URL . "pages-public-and-priv/index");
                        exit;
                    } else {
                        header("Location: " . URL . "pages-public-and-priv/index");
                        exit;
                    }
                }
            } else {
                $this->data['form'] = $this->dataForm;
            }
        } else {
            $this->data = [];
        }
        $this->loadView();
    }

    public function loadView()
    {
        $loadView = new \Core\ConfigView();
        $loadView->loadView("app/sts/Views/config_site/addController", $this->data);
    }
}
