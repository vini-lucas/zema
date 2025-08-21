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
            $clearString = new \Sts\Models\helper\StsClearString();
            $this->dataForm['cpf'] = $clearString->exeClear($this->dataForm['cpf']); // -> Remove os caracteres especiais do CPF.
            $this->dataForm['telephone'] = $clearString->exeClear($this->dataForm['telephone']); // -> Remove os caracteres especiais do telefone.
            $valInput = new \Sts\Models\helper\StsValInputField();
            $dataFormInput = [$this->dataForm['name'], $this->dataForm['cpf'], $this->dataForm['gender'], $this->dataForm['date_birth'], $this->dataForm['telephone'], $this->dataForm['email'], $this->dataForm['password'], $this->dataForm['conf-pass']];
            $valInput->valInputField($dataFormInput);
            if ($valInput->getResult()) {
                $valBirth = new \Sts\Models\helper\StsValDateBirth();
                $valBirth->valDateBirth($this->dataForm['date_birth']);
                if ($valBirth->getResult()) {
                    $valEmail = new \Sts\Models\helper\StsValEmail();
                    $valEmail->valEmail($this->dataForm['email']);
                    if ($valEmail->getResult()) {
                        if ($this->dataForm['gender'] != 'Selecione:') { // -> Se o usuário selecionou o gênero, então:
                            $valPass = new \Sts\Models\helper\StsStrengthPassword();
                            $valPass->valStrengthPassword($this->dataForm['password']); // -> Valida a força da senha.
                            if ($valPass->getResult()) { // -> Se a senha inserida for uma senha forte, então: 
                                if ($this->dataForm['password'] == $this->dataForm['conf-pass']) { // -> Verifica se a senha e o confirmar senha são iguais, se for então:
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
                                    $_SESSION['msg'] = "<p style='color: red;'>A senha deve combinar!</p>"; // -> Envia esta mensagem.
                                    $this->data['form'] = $this->dataForm; // -> Mantém os dados no formulário.
                                    $this->loadView(); // -> Carrega a VIEW.
                                }
                            } else {
                                $this->data['form'] = $this->dataForm; // -> Mantém os dados no formulário.
                                $this->loadView(); // -> Carrega a VIEW
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
