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
    private array|null $data;     // -> Recebe os dados que serão enviados para a view.
    private array|null $dataForm; // -> Recebe os dados que o usuário informou no formulário.
    private int|null $id;

    public function index(int|null $id)
    {
        $this->id = $id;
        if (($_SESSION['user_access_level'] == 'Cliente') or ($_SESSION['user_access_level'] == 'Vendedor')) {
            header("Location: " . URL . "page-err/index");
            exit;
        } else {
            $searchDataPp = new \Sts\Models\StsViewProposal();
            $searchDataPp->searchDataPp($this->id);

            if ($searchDataPp->getResult()) {

                if ($searchDataPp->getResultDb()[0]['internship_proposal'] == 1) {
                    $this->data['internship'] = 1;
                }
                $this->data['portion'] = $searchDataPp->getResultDb();
                $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

                if (!empty($this->dataForm['SendProposal'])) {
                    unset($this->dataForm['SendProposal']);

                    if (
                        (($this->dataForm['portions_one'] ?? '') === '' && ($this->dataForm['date_portions_one'] ?? '') !== '') ||
                        (($this->dataForm['date_portions_one'] ?? '') === '' && ($this->dataForm['portions_one'] ?? '') !== '') ||
                        (($this->dataForm['portions_one'] ?? '') === '' && ($this->dataForm['date_portions_one'] ?? '') === '')
                    ) {
                        $this->data['form'] = $this->dataForm;
                        $_SESSION['msg'] = MSG_PRIME_MSG;
                    } else {

                        $suffixes = [
                            1 => 'one',
                            2 => 'two',
                            3 => 'three',
                            4 => 'four',
                            5 => 'five',
                            6 => 'six',
                            7 => 'seven',
                            8 => 'eight',
                            9 => 'nine',
                            10 => 'ten'
                        ];

                        $mismatch = false;
                        for ($i = 2; $i <= 10; $i++) {
                            $suf = $suffixes[$i];
                            $valor = $this->dataForm["portions_{$suf}"] ?? '';
                            $data  = $this->dataForm["date_portions_{$suf}"] ?? '';
                            if (($valor === '' && $data !== '') || ($valor !== '' && $data === '')) {
                                $mismatch = true;
                                break;
                            }
                        }

                        if ($mismatch) {
                            $this->data['form'] = $this->dataForm;
                            $_SESSION['msg'] = MSG_DATE_PORTION_REMAINING;
                        } else {
                            if (($this->dataForm['observation'] ?? '') === '') {
                                $this->data['form'] = $this->dataForm;
                                $_SESSION['msg'] = "<p style='color: red;'>Informe a OBSERVAÇÃO antes de enviar a SIMULAÇÃO!</p>";
                            } else {
                                $parcelas = [];
                                for ($i = 1; $i <= 10; $i++) {
                                    $suf = $suffixes[$i];
                                    $valor = $this->dataForm["portions_{$suf}"] ?? '';
                                    $data  = $this->dataForm["date_portions_{$suf}"] ?? '';

                                    if ($valor !== '' && $data !== '') {
                                        $parcelas["{$i}_portion"] = [
                                            "value" => $valor,
                                            "date"  => $data
                                        ];
                                    }
                                    unset($this->dataForm["portions_{$suf}"], $this->dataForm["date_portions_{$suf}"]);
                                }

                                $jsonParcelas = json_encode($parcelas, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
                                $this->dataForm['modified'] = date("Y-m-d H:i:s");
                                $this->dataForm['possession'] = 0;
                                $this->dataForm['internship_proposal'] = 2;
                                $this->dataForm['portions'] = $jsonParcelas;

                                $upPp = new \Sts\Models\StsViewProposal();
                                $upPp->editProposal($this->id, $this->dataForm);
                                if ($upPp->getResult()) {
                                    header("Location: " . URL . "fgts/index");
                                    exit;
                                } else {
                                    header("Location: " . URL . "fgts/index");
                                    exit;
                                }
                            }
                        }
                    }
                } else {
                    $this->data['form'] = $searchDataPp->getResultDb();
                }
            } else {
                header("Location: " . URL . "page-err/index");
                exit;
            }
        }
        $this->loadView();
    }

    public function loadView()
    {
        $loadView = new \Core\ConfigView();
        $loadView->loadView("app/sts/Views/dashboard/viewProposal", $this->data);
    }
}
