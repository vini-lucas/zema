<?php

namespace Sts\Controllers;

/**
 * Caso o usuário tente acessar a página sem ser pelo arquivo index, acessa este if.
 */
if (!defined('L4bar3tTA!')) {
    header("Location: /");
}

class PagesPublicAndPriv
{
    private array|null $data; // -> Recebe os dados que serão enviados para a view.
    private array|null $dataForm; // -> Recebe os dados que o usuário informou no formulário.

    public function index()
    {
        $searchPages = new \Sts\Models\StsPagesPublicAndPriv();
        $searchPages->searchPage();
        if ($searchPages->getResult()) {
            $this->data['form'] = $searchPages->getResultDb();
            $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            if (!empty($this->dataForm['SendPages'])) {
                unset($this->dataForm['SendPages']);
                $valInput = new \Sts\Models\helper\StsValInputField();
                $valInput->valInputField($this->dataForm);
                if ($valInput->getResult()) {
                    $this->dataForm['modified'] = date("Y-m-d H:i:s");
                    $searchPages->upPage($this->dataForm, $this->dataForm['id']);
                    if ($searchPages->getResult()) {
                        header("Location: " . URL . "config-site/index");
                        exit;
                    } else {
                        header("Location: " . URL . "config-site/index");
                        exit;
                    }
                } else {
                    $this->data['form'] = $searchPages->getResultDb();
                }
            } else {
                $this->data['form'] = $searchPages->getResultDb();
            }
        } else {
            $this->data = [];
        }
        $this->loadView();
    }

    public function loadView()
    {
        $loadView = new \Core\ConfigView();
        $loadView->loadView("app/sts/Views/config_site/pagesPublicAndPriv", $this->data);
    }
}
