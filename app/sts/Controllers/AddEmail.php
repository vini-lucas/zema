<?php

namespace Sts\Controllers;

/**
 * Caso o usuário tente acessar a página sem ser pelo arquivo index, acessa este if.
 */
if (!defined('L4bar3tTA!')) {
    header("Location: /");
}

class AddEmail
{
    private array|null $data; // -> Recebe os dados que serão enviados para a view.
    private array|null $dataForm; // -> Recebe os dados que o usuário informou no formulário.

    public function index()
    {
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (isset($this->dataForm['SendAddEmail'])) {
            unset($this->dataForm['SendAddEmail']); // -> Destrói a posição do botão do array.
            $valInput = new \Sts\Models\helper\StsValInputField();
            $dataFormInput = [$this->dataForm['title'], $this->dataForm['name'], $this->dataForm['email'], $this->dataForm['host'], $this->dataForm['username'], $this->dataForm['email'], $this->dataForm['password'], $this->dataForm['smtpsecure'], $this->dataForm['port']];
            $valInput->valInputField($dataFormInput);
            if ($valInput->getResult()) {
                    $valEmail = new \Sts\Models\helper\StsValEmail();
                    $valEmail->valEmail($this->dataForm['email']);
                    if ($valEmail->getResult()) {
                                if ($this->dataForm['password'] == $this->dataForm['conf-pass']) { // -> Verifica se a senha e o confirmar senha são iguais, se for então:
                                    $this->dataForm['created'] = date('Y-m-d H:i:s');
                                    unset($this->dataForm['conf-pass']);
                                    $valEmail = new \Sts\Models\StsAddEmail();
                                    $valEmail->validadeEmaill($this->dataForm); // -> Instancia a classe para validar se já possui registro e, se não possuir, criá-lo no Banco de Dados.
                                    if ($valEmail->getResult()) {
                                        header("Location: " . URL . "list-emails/index");
                                        exit;
                                    } else {
                                        header("Location: " . URL . "list-emails/index");
                                        exit;
                                    }
                                } else {
                                    $_SESSION['msg'] = "<p style='color: red;'>A senha deve combinar!</p>"; // -> Envia esta mensagem.
                                    $this->data['form'] = $this->dataForm; // -> Mantém os dados no formulário.
                                    $this->loadView(); // -> Carrega a VIEW.
                                }
                    } else {
                        $this->data['form'] = $this->dataForm; // -> Mantém os dados no formulário.
                        $this->loadView(); // -> Carrega a VIEW.
                    }
            } else {
                $this->data['form'] = $this->dataForm;
                $this->loadView();
                //var_dump($this->dataForm);
            }
        } else {
            $this->data = [];
            $this->loadView();
        }
    }

    public function loadView()
    {
        $loadView = new \Core\ConfigView();
        $loadView->loadView("app/sts/Views/emails/addEmail", $this->data);
    }
}
