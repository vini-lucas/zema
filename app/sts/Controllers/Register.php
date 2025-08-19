<?php

namespace Sts\Controllers;

/**
 * Caso o usuário tente acessar a página sem ser pelo arquivo index, acessa este if.
 */
if (!defined('L4bar3tTA!')) {
    header("Location: /");
}

class Register
{
    private array|null $data; // -> Recebe os dados que serão enviados para a view.
    private array|null $dataForm; // -> Recebe os dados que o usuário informou no formulário.

    public function index()
    {
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT); // -> Recebe os dados do formulário.
        if (!empty($this->dataForm['SendRegister'])) { // -> Se o usuário clicar no botão para enviar então:
            unset($this->dataForm['SendRegister']); // -> Destrói a posição do botão do array.
            $valInput = new \Sts\Models\helper\StsValInputField();
            $dataFormInput = [$this->dataForm['name'], $this->dataForm['cpf'], $this->dataForm['gender'], $this->dataForm['date_birth'], $this->dataForm['telephone'], $this->dataForm['email'], $this->dataForm['password'], $this->dataForm['conf-pass']]; // -> Valida se os campos foram preenchidos.
            $valInput->valInputField($dataFormInput);
            if ($valInput->getResult()) { // -> Se foram preenchidos, então:
                $clearString = new \Sts\Models\helper\StsClearString();
                $this->dataForm['cpf'] = $clearString->exeClear($this->dataForm['cpf']); // -> Remove os caracteres especiais do CPF.
                $valPass = new \Sts\Models\helper\StsStrengthPassword();
                $valPass->valStrengthPassword($this->dataForm['password']); // -> Valida a força da senha.
                if ($valPass->getResult()) { // -> Se a senha inserida for uma senha forte, então: 
                    if ($this->dataForm['gender'] != 'Selecione:') { // -> Verifica se o usuário selecionou o gênero, então:
                        if ($this->dataForm['password'] == $this->dataForm['conf-pass']) { // -> Verifica se a senha e o confirmar senha são iguais, se for então:
                            $valBirth = new \Sts\Models\helper\StsValDateBirth();
                            $valBirth->valDateBirth($this->dataForm['date_birth']);
                            if ($valBirth->getResult()) { // -> Valida se o usuário tem mais de 18 anos, se tiver então:
                                $this->dataForm['telephone'] = $clearString->exeClear($this->dataForm['telephone']); // -> Remove os caracteres especiais do telefone.
                                $this->dataForm['password'] = password_hash($this->dataForm['password'], PASSWORD_DEFAULT); // -> Criptografa a senha antes de enviá-la ao Banco de Dados.
                                $this->dataForm['created'] = date('Y-m-d H:i:s'); // -> Posição 'created' recebe a hora na qual o usuário foi criado.
                                $this->dataForm['access_level_id'] = ACCESS_NEW_USER; // -> Nível de Acesso recebe id 4 que é cliente.
                                unset($this->dataForm['conf-pass']); // -> Destrói a posição de confirmar senha.
                                $valCpf = new \Sts\Models\StsRegister();
                                $valCpf->validadeCpf($this->dataForm); // -> Instancia a classe para validar se já possui registro e, se não possuir, criá-lo no Banco de Dados.
                                if ($valCpf->getResult()) {
                                    header("Location: " . URL . "login/index");
                                    exit;
                                } else {
                                    header("Location: " . URL . "login/index");
                                    exit;
                                }
                            } else {
                                $this->data['form'] = $this->dataForm; // -> Mantém os dados no formulário.
                                $this->loadView(); // -> Carrega a VIEW.  
                            }
                        } else { // -> Se a senha e o confirmar senha não forem iguais, então:
                            $_SESSION['msg'] = "<p style='color: red;'>A senha deve combinar!</p>"; // -> Envia esta mensagem.
                            $this->data['form'] = $this->dataForm; // -> Mantém os dados no formulário.
                            $this->loadView(); // -> Carrega a VIEW.
                        }
                    } else { // -> Se não selecionou, então:
                        $_SESSION['msg'] = "<p style='color: red;'>Selecione o gênero!</p>"; // -> Envia esta mensagem.
                        $this->data['form'] = $this->dataForm; // -> Mantém os dados no formulário.
                        $this->loadView(); // -> Carrega a VIEW.
                    }
                } else { // -> Se a senha inserida for fraca, então:
                    $this->data['form'] = $this->dataForm; // -> Mantém os dados no formulário.
                    $this->loadView(); // -> Carrega a VIEW.
                }
            } else { // -> Se os dados não forem preenchidos totalmente, então:
                $this->data['form'] = $this->dataForm; // -> Mantém os dados no formulário.
                $this->loadView(); // -> Carrega a VIEW.
            }
        } else { // -> Se o usuário não clicar no botão, então:
            $this->data = [];
            $this->loadView(); // -> Carrega a VIEW.
        }
    }

    public function loadView()
    {
        $loadView = new \Core\ConfigView();
        $loadView->loadView("app/sts/Views/login/register", $this->data);
    }
}
