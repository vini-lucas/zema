<?php

namespace Sts\Controllers;

/**
 * Caso o usuário tente acessar a página sem ser pelo arquivo index, acessa este if.
 */
if (!defined('L4bar3tTA!')) {
    header("Location: /");
}

class EditUser
{
    private array|null $data; // -> Recebe os dados que serão enviados para a view.
    private array|null $dataForm; // -> Recebe os dados que o usuário informou no formulário.
    private int $id; // -> Recebe o ID do usuário que será editado.

    public function index(int $id)
    {
        $this->id = $id;
        $editUser = new \Sts\Models\StsEditUser();
        $editUser->searchUser($this->id);
        if ($editUser->getResult()) {
            $this->data['form'] = $editUser->getResultDb();
            unset($this->data['form'][0]['id']);
            $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            if (!empty($this->dataForm['SendEditUser'])) {
                unset($this->dataForm['SendEditUser'], $this->dataForm['created'], $this->dataForm['created']);
                $userEdit = new \Sts\Models\helper\StsUpdade();
                $userEdit->exeUpdate("sts_users", $this->data['form'], $this->dataForm);
                //var_dump($this->dataForm);
            }
        } else {
            $this->data['form'] = $this->dataForm;
            $_SESSION['msg'] = "<p style='color: red;'>Usuário não encontrado!</p>";
            header("Location: " . URL . "list-users/index");
        }
        $this->loadView();
    }

    public function loadView()
    {
        $loadView = new \Core\ConfigView();
        $loadView->loadView("app/sts/Views/users/editUser", $this->data);
    }
}
