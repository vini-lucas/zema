<?php

namespace Sts\Controllers;

/**
 * Caso o usuário tente acessar a página sem ser pelo arquivo index, acessa este if.
 */
if (!defined('L4bar3tTA!')) {
    header("Location: /");
}

class NewPassword
{
    private array|null $data; // -> Recebe os dados que serão enviados para a view.
    private array|null $dataForm; // -> Recebe os dados que o usuário informou no formulário da view.

    public function index()
    {
        $key = filter_input(INPUT_GET, 'key', FILTER_DEFAULT);
        if (!empty($key)) {
            $readUser = new \Sts\Models\StsNewPassword();
            $readUser->readUser($key);
            if ($readUser->getResult()) {
                $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
                if (!empty($this->dataForm['SendRecover'])) {
                    unset($this->dataForm['SendRecover']);
                    $valInput = new \Sts\Models\helper\StsValInputField();
                    $valInput->valInputField($this->dataForm);
                    if ($valInput->getResult()) {
                        $valPass = new \Sts\Models\helper\StsStrengthPassword();
                        $valPass->valStrengthPassword($this->dataForm['password']);
                        if ($valPass->getResult()) {
                            if ($this->dataForm['password'] === $this->dataForm['conf-password']) {
                                unset($this->dataForm['conf-password']);
                                $this->dataForm['password'] = password_hash($this->dataForm['password'], PASSWORD_DEFAULT);
                                $upPass = new \Sts\Models\helper\StsUpdade();
                                $upPass->exeUpdate("sts_users", $this->dataForm, "WHERE recover_password=:recover_password", "recover_password=$key");
                                if ($upPass->getResult()) {
                                    $_SESSION['msg'] = "<p style='color: green'>Senha editada com sucesso!</p>";
                                    header("Location: " . URL . "login/index");
                                } else {
                                    $_SESSION['msg'] = "<p style='color: red'>Senha não editada com sucesso!</p>";
                                    header("Location: " . URL . "login/index");
                                }
                            } else {
                                $_SESSION['msg'] = "<p>Devem combinar!</p>";
                                $this->loadView();
                            }
                        } else {
                            $this->loadView();
                        }
                    } else {
                        $this->loadView();
                    }
                } else {
                    $this->data = [];
                    $this->loadView();
                }
            } else {
                $_SESSION['msg'] = "<p style='color: red'>Página não encontrada!</p>";
                header("Location: " . URL . "login/index");
                exit;
            }
        } else {
            $_SESSION['msg'] = "<p style='color: red'>Página não encontrada!</p>";
            header("Location: " . URL . "login/index");
            exit;
        }

        //$this->loadView();
    }

    public function loadView()
    {
        $this->data = [];
        $loadView = new \Core\ConfigView();
        $loadView->loadView("app/sts/Views/login/newPassword", $this->data);
    }
}
