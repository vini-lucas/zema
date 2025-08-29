<?php

namespace Sts\Controllers;

/**
 * Caso o usuário tente acessar a página sem ser pelo arquivo index, acessa este if.
 */
if (!defined('L4bar3tTA!')) {
    header("Location: /");
}

class EmailMsg
{
    private array|null $data; // -> Recebe os dados que serão enviados para a view.
    private array|null $dataForm; // -> Recebe os dados que o usuário informou no formulário.

    public function index()
    {
        $emailMsg = new \Sts\Models\StsEmailMsg();
        $emailMsg->searchEmail();
        if ($emailMsg->getResult()) {
            $this->data['form'] = $emailMsg->getResultDb();
            $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            if (!empty($this->dataForm['SendEmailMsg'])) {
                unset($this->dataForm['SendEmailMsg']);
                $valInput = new \Sts\Models\helper\StsValInputField();
                $valInput->valInputField($this->dataForm);
                if ($valInput->getResult()) {
                    $valEmail = new \Sts\Models\helper\StsValEmail();
                    $valEmail->valEmail($this->dataForm['email']);
                    if ($valEmail->getResult()) {
                        $emailMsg->upEmail($this->dataForm);
                        if ($emailMsg->getResult()) {
                            header("Location: " . URL . "config-site/index");
                            exit;
                        } else {
                            header("Location: " . URL . "config-site/index");
                            exit;
                        }
                    } else {
                        $this->data['form'] = $this->dataForm;
                    }
                } else {
                    $this->data['form'] = $this->dataForm;
                }
            }
        } else {
            $this->data['form'] = $this->dataForm;
        }
        $this->loadView();
    }

    public function loadView()
    {
        $loadView = new \Core\ConfigView();
        $loadView->loadView("app/sts/Views/config_site/emailMsg", $this->data);
    }
}
