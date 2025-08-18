<?php

namespace Sts\Controllers;

use DateTime;

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
            $this->dataForm['cpf'] = str_replace(['-', '.'], '', $this->dataForm['cpf']);
            $valInput = new \Sts\Models\helper\StsValInputField();
            $dataFormInput = [$this->dataForm['name'], $this->dataForm['cpf'], $this->dataForm['gender'], $this->dataForm['date_birth'], $this->dataForm['telephone'], $this->dataForm['email'], $this->dataForm['password'], $this->dataForm['conf-pass']]; // -> Valida se os campos foram preenchidos.
            $valInput->valInputField($dataFormInput);

            if ($valInput->getResult()) { // -> Se foram preenchidos, então:
                $valPass = new \Sts\Models\helper\StsStrengthPassword();
                $valPass->valStrengthPassword($this->dataForm['password']);
                if ($valPass->getResult()) {
                    if ($this->dataForm['gender'] != 'Selecione:') { // -> Se o usuário selecionou o gênero, então:
                        if ($this->dataForm['password'] == $this->dataForm['conf-pass']) { // -> Verifica se a senha e o confirmar senha são iguais, se for então:
                            $now = new DateTime();
                            $date_birth = new DateTime($this->dataForm['date_birth']);
                            $years = $now->diff($date_birth)->y;
                            if ($years >= 18) {
                                $this->dataForm['password'] = password_hash($this->dataForm['password'], PASSWORD_DEFAULT); // -> Criptografa a senha antes de enviá-la ao Banco de Dados.
                                $this->dataForm['created'] = date('Y-m-d H:i:s'); // -> Posição 'created' recebe a hora na qual o usuário foi criado.
                                $this->dataForm['access_level_id'] = 4; // -> Nível de Acesso recebe id 4 que é cliente.
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
                                $_SESSION['msg'] = "<p style='color: red;'>Idade mínima para registrar-se é de 18 anos!</p>"; // -> Envia esta mensagem.
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
                } else {
                    $this->data['form'] = $this->dataForm;
                    $this->loadView();
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
