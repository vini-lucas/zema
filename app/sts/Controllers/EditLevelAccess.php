<?php

namespace Sts\Controllers;

/**
 * Caso o usuário tente acessar a página sem ser pelo arquivo index, acessa este if.
 */
if (!defined('L4bar3tTA!')) {
    header("Location: /");
}

class EditLevelAccess
{
    private array|null $data; // -> Recebe os dados que serão enviados para a view.
    private array|null $dataForm; // -> Recebe os dados que o usuário informou no formulário.
    private int $id; // -> Recebe o ID do usuário que será editado.

    public function index(int $id)
    {
        $this->id = $id; // -> Recebe o ID do usuário.
        $editLevelAccess = new \Sts\Models\StsEditLevelAccess(); // -> Instancia a classe para recuperar todos os dados do usuário que serão editados.
        $editLevelAccess->searchLevelAccess($this->id); // -> Instancia e função passando o ID como parâmetro.
        if ($editLevelAccess->getResult()) { // -> Se encontrar algum usuário com o ID do parâmetro então:
            $this->data['form'] = $editLevelAccess->getResultDb();
            $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT); // -> "$this->dataForm" recebe os dados que o usuário informou no formulário.
            if (!empty($this->dataForm['SendEditLevelAccess'])) { // -> Se o usuário clicar no botão "Editar" então:
                unset($this->dataForm['SendEditLevelAccess']); // -> Destrua a posição do botão.
                $inputForm = [$this->dataForm['name']];
                $valInputs = new \Sts\Models\helper\StsValInputField();
                $valInputs->valInputField($inputForm);
                if ($valInputs->getResult()) {
                    $this->dataForm['modified'] = date("Y-m-d H:i:s");
                    $editLevelAccess->exeUpdateLevelAccess($this->data['form'][0]['id'], $this->dataForm);
                    if ($editLevelAccess->getResult()) {
                        header("Location: " . URL . "list-levels-access/index");
                        exit;
                    } else {
                        $this->data['form'][0] = $this->dataForm;
                    }
                }
            }
        } else { // -> Se não encontrar algum usuário com o ID do parâmetro informado então:
            $_SESSION['msg'] = "<p style='color: red;'>Nível de Acesso não encontrado!</p>"; // -> Aparece esta mensagem.
            header("Location: " . URL . "list-levels-access/index"); // -> Direciona para a página de listar usuários.
        }
        $this->loadView();
    }

    public function loadView()
    {
        $loadView = new \Core\ConfigView();
        $loadView->loadView("app/sts/Views/level_access/editLevelAccess", $this->data);
    }
}
