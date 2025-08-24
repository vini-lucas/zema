<?php

namespace Sts\Controllers;

/**
 * Caso o usuário tente acessar a página sem ser pelo arquivo index, acessa este if.
 */
if (!defined('L4bar3tTA!')) {
    header("Location: /");
}

class NewEmail
{
    private array|null $data; // -> Recebe os dados que serão enviados para a view.
    private array|null $dataForm; // -> Recebe os dados que o usuário informou no formulário.

    public function index()
    {
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (isset($this->dataForm['SendConfEmail'])) { // -> Se apertou no botão, então:
            unset($this->dataForm['SendConfEmail']);
            $valInput = new \Sts\Models\helper\StsValInputField();
            $valInput->valInputField($this->dataForm); // -> Se preencheu todos os campos então:
            if ($valInput->getResult()) {
                $clearString = new \Sts\Models\helper\StsClearString();
                $this->dataForm['cpf'] = $clearString->exeClear($this->dataForm['cpf']); // -> Remove os caracteres especiais do CPF.
                $newEmail = new \Sts\Models\StsNewEmail();
                $newEmail->alterEmail($this->dataForm['cpf']);
                if ($newEmail->getResult()) {
                    $_SESSION['msg'] = "<p style='color: green'>Uma mensagem com instruções para recuperação de senha foi enviada à caixa de e-mail pertencente à este CPF!</p>";
                    header("Location: " . URL . "login/index");
                    exit;
                } else {
                    $_SESSION['msg'] = "<p style='color: red;'>Mensagem com instruções para recuperação de senha não foi enviada com sucesso.<br>Entre em contato com o suporte (" . EMAILADM . ") para maiores informações!</p>";
                    header("Location: " . URL . "login/index");
                    exit;
                }
            } else {
                $this->data['form'] = $this->dataForm;
            }
        } else {
            $this->data = [];
        }
        $this->loadView();
    }

    public function loadView()
    {
        $this->data = [];
        $loadView = new \Core\ConfigView();
        $loadView->loadView("app/sts/Views/login/newEmail", $this->data);
    }
}
