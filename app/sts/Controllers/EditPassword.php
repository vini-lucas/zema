<?php

namespace Sts\Controllers;

/**
 * Caso o usuário tente acessar a página sem ser pelo arquivo index, acessa este if.
 */
if (!defined('L4bar3tTA!')) {
    header("Location: /");
}

class EditPassword
{
    private array|null $data; // -> Recebe os dados que serão enviados para a view.
    private array|null $dataForm; // -> Recebe os dados que o usuário informou no formulário.
    private int $id; // -> Recebe o ID do usuário que será editado.

    public function index(int $id)
    {
        $this->id = $id; // -> Recebe o ID do usuário.
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->dataForm['SendEditPass'])) {
            unset($this->dataForm['SendEditPass']);
            $valInput = new \Sts\Models\helper\ValInputField();
            $valInput->valInputField($this->dataForm);
            if ($valInput->getResult()) {
                if ($this->dataForm['password'] == $this->dataForm['conf-password']) {
                    $this->dataForm['password'] = password_hash($this->dataForm['password'], PASSWORD_DEFAULT);
                    $editPass = new \Sts\Models\StsEditPassword();
                    $editPass->editPass($this->id, $this->dataForm);
                    if ($editPass->getResult()) {
                        header("Location: " . URL . "edit-user/index/{$this->id}");
                        exit;
                    } else {
                        header("Location: " . URL . "edit-user/index/{$this->id}");
                        exit;
                    }
                } else {
                    $_SESSION['msg'] = "<p style='color: red'>Senha deve combinar!</p>";
                    $this->data['form'] = $this->dataForm;
                    $this->data['form']['id'] = $this->id;
                    $this->loadView();
                }
            } else {
                $this->data['form'] = $this->dataForm;
                $this->data['form']['id'] = $this->id;
                $this->loadView();
            }
        } else {
            $this->data['form']['id'] = $this->id;
            $this->loadView();
        }
    }

    public function loadView()
    {
        $loadView = new \Core\ConfigView();
        $loadView->loadView("app/sts/Views/users/editPassword", $this->data);
    }
}
