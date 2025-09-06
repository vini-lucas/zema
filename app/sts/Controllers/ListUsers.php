<?php

namespace Sts\Controllers;

/**
 * Caso o usuário tente acessar a página sem ser pelo arquivo index, acessa este if.
 */
if (!defined('L4bar3tTA!')) {
    header("Location: /");
}

class ListUsers
{
    private array|null $data; // -> Recebe os dados que serão enviados para a view.
    private array|null $dataForm; // -> Recebe os dados que o usuário informou no formulário.

    public function index()
    {
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->dataForm['sendSearch'])) {
            unset($this->dataForm['sendSearch']);
            $listUsers = new \Sts\Models\StsListUsers();
            if ((empty($this->dataForm['searchUserName'])) and (empty($this->dataForm['searchUserEmail']))) {
                $_SESSION['msg'] = "<p style='color: red;'>Informe o NOME ou E-MAIL!</p>";
            } else if ((!empty($this->dataForm['searchUserName'])) and (empty($this->dataForm['searchUserEmail']))) {
                $listUsers->usersNameDatabase($this->dataForm['searchUserName']);
            } else if ((empty($this->dataForm['searchUserName'])) and (!empty($this->dataForm['searchUserEmail']))) {
                $listUsers->usersEmailDatabase($this->dataForm['searchUserEmail']);
            } else {
                $listUsers->usersDatabase($this->dataForm['searchUserName'], $this->dataForm['searchUserEmail']);
            }

            if ($listUsers->getResult()) {
                $this->data['form'] = $listUsers->getResultDb();
            } else {
                $_SESSION['msg'] = MSG_REGISTER_NOT_FOUND;
                $this->data['form'] = [];
            }
        } else {
            $this->data['form'] = [];
        }
        $this->loadView();
    }

    public function loadView()
    {
        $loadView = new \Core\ConfigView();
        $loadView->loadView("app/sts/Views/users/listUsers", $this->data);
    }
}
