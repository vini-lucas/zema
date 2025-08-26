<?php

namespace Sts\Controllers;

/**
 * Caso o usuário tente acessar a página sem ser pelo arquivo index, acessa este if.
 */
if (!defined('L4bar3tTA!')) {
    header("Location: /");
}

class AddColor
{
    private array|null $data; // -> Recebe os dados que serão enviados para a view.
    private array|null $dataForm; // -> Recebe os dados que o usuário informou no formulário.

    public function index()
    {
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (isset($this->dataForm['SendAddColor'])) {
            unset($this->dataForm['SendAddColor']); // -> Destrói a posição do botão do array.
            $valInput = new \Sts\Models\helper\StsValInputField();
            $dataFormInput = [$this->dataForm['color'], $this->dataForm['name']];
            $valInput->valInputField($dataFormInput);
            if ($valInput->getResult()) {
                                    $this->dataForm['created'] = date('Y-m-d H:i:s');
                                    $valEmail = new \Sts\Models\StsAddColor();
                                    $valEmail->validadeColor($this->dataForm); // -> Instancia a classe para validar se já possui registro e, se não possuir, criá-lo no Banco de Dados.
                                    if ($valEmail->getResult()) {
                                        header("Location: " . URL . "list-colors/index");
                                        exit;
                                    } else {
                                        header("Location: " . URL . "list-colors/index");
                                        exit;
                                    }
            } else {
                $this->data['form'] = $this->dataForm;
                $this->loadView();
            }
        } else {
            $this->data = [];
            $this->loadView();
        }
    }

    public function loadView()
    {
        $loadView = new \Core\ConfigView();
        $loadView->loadView("app/sts/Views/colors/addColor", $this->data);
    }
}
