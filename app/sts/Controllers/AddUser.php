<?php

namespace Sts\Controllers;

/**
 * Caso o usuário tente acessar a página sem ser pelo arquivo index, acessa este if.
 */
if (!defined('L4bar3tTA!')) {
    header("Location: /");
}

class AddUser
{
    private array|null $data; // -> Recebe os dados que serão enviados para a view.
    private array|null $dataForm; // -> Recebe os dados que o usuário informou no formulário.

    public function index()
    {
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (isset($this->dataForm['SendAddUser'])) {
            unset($this->dataForm['SendAddUser']); // -> Destrói a posição do botão do array.
            $this->dataForm['cpf'] = str_replace(['-', '.'], '', $this->dataForm['cpf']);
            $valInput = new \Sts\Models\helper\StsValInputField();
            $dataFormInput = [$this->dataForm['name'], $this->dataForm['cpf'], $this->dataForm['gender'], $this->dataForm['date_birth'], $this->dataForm['telephone'], $this->dataForm['email'], $this->dataForm['password'], $this->dataForm['conf-pass']];
            $valInput->valInputField($dataFormInput);
            if ($valInput->getResult()) {
                $valBirth = new \Sts\Models\helper\StsValDateBirth();
                $valBirth->valDateBirth($this->dataForm['date_birth']);
                if ($valBirth->getResult()) {
                    if ($this->dataForm['gender'] != 'Selecione:') { // -> Se o usuário selecionou o gênero, então:
                        $this->dataForm['telephone'] = str_replace([' ', '(', ')', '-'], '', $this->dataForm['telephone']);
                        $this->dataForm['password'] = password_hash($this->dataForm['password'], PASSWORD_DEFAULT); // -> Criptografa a senha antes de enviá-la ao Banco de Dados.
                        $this->dataForm['created'] = date('Y-m-d H:i:s');
                        $this->dataForm['access_level_id'] = 4;
                        unset($this->dataForm['conf-pass']);
                        $valCpf = new \Sts\Models\StsAddUser();
                        $valCpf->validadeCpf($this->dataForm); // -> Instancia a classe para validar se já possui registro e, se não possuir, criá-lo no Banco de Dados.
                        if ($valCpf->getResult()) {
                            header("Location: " . URL . "list-users/index");
                            exit;
                        } else {
                            header("Location: " . URL . "list-users/index");
                            exit;
                        }
                    } else {
                        $_SESSION['msg'] = "<p style='color: red;'>Selecione o gênero!</p>"; // -> Envia esta mensagem.
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
        $loadView->loadView("app/sts/Views/users/addUser", $this->data);
    }
}
