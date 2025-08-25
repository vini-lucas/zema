<?php

namespace Sts\Controllers;

/**
 * Caso o usuário tente acessar a página sem ser pelo arquivo index, acessa este if.
 */
if (!defined('L4bar3tTA!')) {
    header("Location: /");
}

class EditEmail
{
    private array|null $data; // -> Recebe os dados que serão enviados para a view.
    private array|null $dataForm; // -> Recebe os dados que o usuário informou no formulário.
    private int $id; // -> Recebe o ID do usuário que será editado.

    public function index(int $id)
    {
        $this->id = $id; // -> Recebe o ID do usuário.
        $editUser = new \Sts\Models\StsEditEmail(); // -> Instancia a classe para recuperar todos os dados do usuário que serão editados.
        $editUser->searchEmail($this->id); // -> Instancia e função passando o ID como parâmetro.
        if ($editUser->getResult()) { // -> Se encontrar algum usuário com o ID do parâmetro então:
            $this->data['form'] = $editUser->getResultDb();
            $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT); // -> "$this->dataForm" recebe os dados que o usuário informou no formulário.
            if (!empty($this->dataForm['SendEditEmail'])) { // -> Se o usuário clicar no botão "Editar" então:
                unset($this->dataForm['SendEditEmail']); // -> Destrua a posição do botão.
                $valInput = new \Sts\Models\helper\StsValInputField();
                $dataFormInput = [$this->dataForm['title'], $this->dataForm['name'], $this->dataForm['host'], $this->dataForm['email'], $this->dataForm['username'], $this->dataForm['password'], $this->dataForm['smtpsecure'], $this->dataForm['port']]; // -> Valida se os campos foram preenchidos.
                $valInput->valInputField($dataFormInput);
                if ($valInput->getResult()) {
                        $valEmail = new \Sts\Models\helper\StsValEmail();
                        $valEmail->valEmail($this->dataForm['email']);
                        if ($valEmail->getResult()) {
                            $this->dataForm['modified'] = date("Y-m-d H:i:s");
                            $editUser->exeUpdateEmail($this->data['form'][0]['id'], $this->dataForm);
                            if ($editUser->getResult()) {
                                header("Location: " . URL . "list-emails/index");
                                exit;
                            } else {
                                header("Location: " . URL . "list-emails/index");
                                exit;
                            }
                        } else {
                            $this->data['form'][0] = $this->dataForm;
                        }               
                } else {
                    $this->data['form'][0] = $this->dataForm;
                }
            }
        } else { // -> Se não encontrar algum usuário com o ID do parâmetro informado então:
            $_SESSION['msg'] = "<p style='color: red;'>E-mail não encontrado!</p>"; // -> Aparece esta mensagem.
            header("Location: " . URL . "list-users/index"); // -> Direciona para a página de listar usuários.
        }
        $this->loadView();
    }

    public function loadView()
    {
        $loadView = new \Core\ConfigView();
        $loadView->loadView("app/sts/Views/emails/editEmail", $this->data);
    }
}
