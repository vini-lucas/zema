<?php

namespace Sts\Controllers;

use Core\ConfigView;
use Sts\Models\StsLogin;

class Login
{
    private array|null $data; // -> Recebe os dados que serão enviados para a view.

    public function index()
    {
        $teste = new StsLogin();
        $teste->teste();
        if ($teste->getResultDb()) {
            $this->data['teste'] = $teste->getResultDb();
        } else {
            $this->data = [];
            echo "Nenhum resultado encontrado!<br>";
        }
    }

    public function loadView()
    {
        $loadView = new ConfigView();
        $loadView->loadView("app/sts/Views/login", $this->data);
    }
}
