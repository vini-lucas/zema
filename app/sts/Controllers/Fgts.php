<?php

namespace Sts\Controllers;

/**
 * Caso o usuário tente acessar a página sem ser pelo arquivo index, acessa este if.
 */
if (!defined('L4bar3tTA!')) {
    header("Location: /");
}

class Fgts
{
    private array|null $data; // -> Recebe os dados que serão enviados para a view.
    private array|null $dataForm; // -> Recebe os dados que o usuário informou no formulário.

    public function index()
    {
        if ($_SESSION['user_access_level'] == 'Cliente') {
            $modelFgts = new \Sts\Models\StsFgts();
            $modelFgts->searchProposalsCustomer($_SESSION['user_cpf']);
            if ($modelFgts->getResult()) {
                $this->data['form'] = $modelFgts->getResultDb();
            } else {
                $this->data['form'] = [];
            }
        } else {
            $modelFgts = new \Sts\Models\StsFgts();
            $modelFgts->searchProposalsAll();
            if ($modelFgts->getResult()) {
                $this->data['form'] = $modelFgts->getResultDb();
            } else {
                $this->data['form'] = [];
            }
        }
        $this->loadView();
    }

    public function loadView()
    {
        $loadView = new \Core\ConfigView();
        $loadView->loadView("app/sts/Views/dashboard/fgts", $this->data);
    }
}
