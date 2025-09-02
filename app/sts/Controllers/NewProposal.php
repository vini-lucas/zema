<?php

namespace Sts\Controllers;

use DateTime;

/**
 * Caso o usuário tente acessar a página sem ser pelo arquivo index, acessa este if.
 */
if (!defined('L4bar3tTA!')) {
    header("Location: /");
}

class NewProposal
{
    private array|null $data; // -> Recebe os dados que serão enviados para a view.
    private array|null $dataForm; // -> Recebe os dados que o usuário informou no formulário.

    public function index()
    {
        if ($_SESSION['user_access_level'] != "Cliente") {
            $this->data = [];
            $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            if (!empty($this->dataForm['SendProposal'])) {
                unset($this->dataForm['SendProposal']);
                $valInput = new \Sts\Models\helper\StsValInputField();
                $valInput->valInputField($this->dataForm);
                if ($valInput->getResult()) {
                    $valBirth = new \Sts\Models\helper\StsValDateBirth();
                    $valBirth->valDateBirth($this->dataForm['date_birth']);
                    if ($valBirth->getResult()) {
                        $this->dataForm['possession'] = 1;
                        $this->dataForm['internship_proposal'] = 1;
                        $this->dataForm['seller_cpf'] = $_SESSION['user_cpf'];
                        $newPpSeller = new \Sts\Models\StsNewProposal();
                        $newPpSeller->sendProposalSeller($this->dataForm);
                        if ($newPpSeller->getResult()) {
                            header("Location: " . URL . "fgts/index");
                            exit;
                        } else {
                            header("Location: " . URL . "fgts/index");
                            exit;
                        }
                    } else {
                        $this->data['form'] = $this->dataForm;
                    }
                } else {
                    $this->data['form'] = $this->dataForm;
                }
            } else {
                $this->data = [];
            }
        } else {
            $dataForm[] = [
                'cpf' => $_SESSION['user_cpf'],
                'date_birth' => $_SESSION['user_date_birth'],
                'name' => implode(' ', $_SESSION['user_name']),
                'created' => date("Y-m-d H:i:s"),
                'possession' => 1,
                'internship_proposal' => 1,
                'seller_cpf' => 'VENDA PRÓPRIA'
            ];
            $newPpCustomer = new \Sts\Models\StsNewProposal();
            $newPpCustomer->sendProposalCustomer($dataForm[0]);
            if ($newPpCustomer->getResult()) {
                header("Location: " . URL . "fgts/index");
                exit;
            } else {
                header("Location: " . URL . "fgts/index");
                exit;
            }
        }
        $this->data = [];
        $this->loadView();
    }

    public function loadView()
    {
        $loadView = new \Core\ConfigView();
        $loadView->loadView("app/sts/Views/dashboard/newProposal", $this->data);
    }
}
