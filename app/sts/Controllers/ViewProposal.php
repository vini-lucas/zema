<?php

namespace Sts\Controllers;

/**
 * Caso o usuário tente acessar a página sem ser pelo arquivo index, acessa este if.
 */
if (!defined('L4bar3tTA!')) {
    header("Location: /");
}

class ViewProposal
{
    private array|null $data; // -> Recebe os dados que serão enviados para a view.
    private array|null $dataForm; // -> Recebe os dados que o usuário informou no formulário.

    public function index(int $id)
    {
        if ($_SESSION['user_access_level'] != 'Cliente') {
            $searchDataPp = new \Sts\Models\StsViewProposal();
            $searchDataPp->searchDataPp($id);
            if ($searchDataPp->getResultDb()) {
                $this->data['form'] = $searchDataPp->getResultDb();
                $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
                if (!empty($this->dataForm['SendProposal'])) {
                    unset($this->dataForm['SendProposal']);
                    if ((($this->dataForm['portions_one'] == '') and ($this->dataForm['date_portions_one'] != '')) or (($this->dataForm['date_portions_one'] == '') and ($this->dataForm['portions_one'] != '')) or ($this->dataForm['portions_one'] == '') and ($this->dataForm['date_portions_one'] == '')) {
                        $this->data['form'] = $this->dataForm;
                        $_SESSION['msg'] = MSG_PRIME_MSG;
                    } else {
                        $pairs = [
                            $this->dataForm['portions_two'] => $this->dataForm['date_portions_two'],
                            $this->dataForm['portions_three'] => $this->dataForm['date_portions_three'],
                            $this->dataForm['portions_four'] => $this->dataForm['date_portions_four'],
                            $this->dataForm['portions_five'] => $this->dataForm['date_portions_five'],
                            $this->dataForm['portions_six'] => $this->dataForm['date_portions_six'],
                            $this->dataForm['portions_seven'] => $this->dataForm['date_portions_seven'],
                            $this->dataForm['portions_eight'] => $this->dataForm['date_portions_eight'],
                            $this->dataForm['portions_nine'] => $this->dataForm['date_portions_nine'],
                            $this->dataForm['portions_ten'] => $this->dataForm['date_portions_ten']
                        ];
                        foreach ($pairs as $value => $index) {
                            if ((($value == '') and ($index != '')) or (($index == '') and ($value != ''))) {
                                $this->data['form'] = $this->dataForm;
                                $_SESSION['msg'] = MSG_DATE_PORTION_REMAINING;
                                break;
                            } else {
                                if ($this->dataForm['observation'] == '') {
                                    $this->data['form'] = $this->dataForm;
                                    $_SESSION['msg'] = "<p style='color: red;'>Informe a OBSERVAÇÃO antes de enviar a SIMULAÇÃO!</p>";
                                } else {
                                    foreach ($this->dataForm as $key => $val) {
                                        if ($val === '') {
                                            unset($this->dataForm[$key]);
                                        }
                                    }
                                }
                            }
                        }
                    }
                } else {
                    $this->data = [];
                }
            } else {
                header("Location: " . URL . "page-err/index");
                exit;
            }
            $this->loadView();
        } else {
            header("Location: " . URL . "page-err/index");
            exit;
        }
    }

    public function loadView()
    {
        $loadView = new \Core\ConfigView();
        $loadView->loadView("app/sts/Views/dashboard/viewProposal", $this->data);
    }
}
