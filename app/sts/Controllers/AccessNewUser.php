<?php

namespace Sts\Controllers;

/**
 * Caso o usuário tente acessar a página sem ser pelo arquivo index, acessa este if.
 */
if (!defined('L4bar3tTA!')) {
    header("Location: /");
}

class AccessNewUser
{
    private array|null $data; // -> Recebe os dados que serão enviados para a view.
    private array|null $dataForm; // -> Recebe os dados que o usuário informou no formulário.

    public function index()
    {
        $searchLevel = new \Sts\Models\StsAccessNewUser();
        $searchLevel->searchLevelsAccess();
        if ($searchLevel->getResult()) {
            $this->data['select'] = $searchLevel->getResultDb();
            $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            if (!empty($this->dataForm['SendLevelAccess'])) {
                unset($this->dataForm['SendLevelAccess']);
                if ($this->dataForm['access_level_id'] != 'Selecione:') {
                    if ($this->dataForm['access_level_id'] == 'Administrador') {
                        $this->dataForm['access_level_id'] = 2;
                    } else if ($this->dataForm['access_level_id'] == 'Cliente') {
                        $this->dataForm['access_level_id'] = 4;
                    } else if ($this->dataForm['access_level_id'] == 'Super Administrador') {
                        $this->dataForm['access_level_id'] = 1;
                    } else {
                        $this->dataForm['access_level_id'] = 3;
                    }
                    $upLevel = new \Sts\Models\StsAccessNewUser();
                    $upLevel->upLevelAccess($this->dataForm);
                    if ($upLevel->getResult()) {
                        header("Location: " . URL . "config-site/index");
                        exit;
                    } else {
                        header("Location: " . URL . "config-site/index");
                        exit;
                    }
                } else {
                    $_SESSION['msg'] = "<p style='color: red;'>Informe o Nível de Acesso!</p>";
                    $this->data['form'] = $this->dataForm;
                }
            }
        } else {
            $this->dataForm['form'] = $this->dataForm;
        }
        $this->loadView();
    }

    public function loadView()
    {
        $loadView = new \Core\ConfigView();
        $loadView->loadView("app/sts/Views/config_site/accessNewUser", $this->data);
    }
}
