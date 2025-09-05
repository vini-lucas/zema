<?php

namespace Sts\Controllers;

/**
 * Caso o usuário tente acessar a página sem ser pelo arquivo index, acessa este if.
 */
if (!defined('L4bar3tTA!')) {
    header("Location: /");
}

class ViewProposalCustomer
{
    private array|null $data; // -> Recebe os dados que serão enviados para a view.
    private array|null $dataForm; // -> Recebe os dados que o usuário informou no formulário.
    private int|null $id; // -> Recebe o ID da proposta.

    public function index(int|null $id)
    {
        $this->id = $id; // -> Recebe o ID da proposta.
        $viewPp = new \Sts\Models\StsViewProposalCustomer();
        $viewPp->searchDataPp($this->id); // -> Busca no BD os dados da proposta com este ID.
        if ($viewPp->getResult()) { // -> E os encaminha para a VIEW.
            $this->data['form'] = $viewPp->getResultDb();
            $this->data['portions'] = json_decode($viewPp->getResultDb()[0]['portions'], true);

            // ESTÁGIO 2 -------------------------------------------------------------------------------------
            if ($viewPp->getResultDb()[0]['internship_proposal'] === 2) { // -> Se o estágio da proposta for igual a 2, então:
                if (!empty($_SESSION['data-form'])) { // -> Se existir a sessão "data-form", então:
                    $upDataPp = $_SESSION['data-form'];
                    $upDataPp['modified'] = date("Y-m-d H:i:s");
                    $upDataPp['possession'] = 1;
                    $upDataPp['value_released'] = $this->data['form'][0]['value_released'];
                    $upDataPp['portions'] = $this->data['form'][0]['portions'];
                    $upDataPp['observation'] = "Simulação ACEITA pelo USUÁRIO!";
                    $upDataPp['internship_proposal'] = 3;
                    $upPp = new \Sts\Models\helper\StsUpdade();
                    $upPp->exeUpdate("sts_proposal_fgts", $upDataPp, "WHERE id=:id", "id={$this->id}");
                    if ($upPp->getResult()) {
                        unset($_SESSION['data-form']);
                        $_SESSION['msg'] = MSG_ALT_PERF_SUCCESS;
                        header("Location: " . URL . "fgts/index");
                        exit;
                    } else {
                        unset($_SESSION['data-form']);
                        $_SESSION['msg'] = MSG_ALT_NOT_PERF_SUCCESS;
                        header("Location: " . URL . "fgts/index");
                        exit;
                    }
                } else {
                    $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
                    if (!empty($this->dataForm['accept_value'])) { // -> Se o usuário clicar no botão "ACEITAR VALOR LIBERADO", então:
                        header("Location: " . URL . "fill-proposal/index?id={$this->id}"); // -> Redireciona para a página para preencher o restante dos dados.
                        exit;
                    } else if (!empty($this->dataForm['new_portions'])) { // -> Se clicar no botão "Devolver solicitando NOVO PRAZO", então:
                        unset($this->dataForm['new_portions']); // -> Destrói a posição do botão no ARRAY.
                        foreach ($this->dataForm as $value => $index) { // -> Lê todas as parcelas.
                            if ((isset($value)) and ($index == 'on')) { // -> Se alguma for selecionada, então:
                                $this->dataForm['observation'] = "Solicito, por obséquio, uma simulação em $value parcelas";
                                $msg = true;
                                break; // -> Pause a leitura e $msg recebe true.
                            } else { // -> Se nenhuma for selecionada, então:
                                $msg = false; // -> $msg recebe falso.
                            }
                        }
                        if ((isset($msg)) and ($msg)) { // -> Se $msg for verdadeiro, então:
                            foreach ($this->dataForm as $valor => $indice) {
                                if (($valor != 'observation')) {
                                    unset($this->dataForm[$valor]);
                                }
                            }
                            $this->dataForm['modified'] = date("Y-m-d H:i:s");
                            $this->dataForm['possession'] = 1;
                            $this->dataForm['internship_proposal'] = 3;
                            $upPp = new \Sts\Models\helper\StsUpdade();
                            $upPp->exeUpdate("sts_proposal_fgts", $this->dataForm, "WHERE id=:id", "id={$this->id}");
                            if ($upPp->getResult()) {
                                $_SESSION['msg'] = MSG_ALT_PERF_SUCCESS;
                                header("Location: " . URL . "fgts/index");
                                exit;
                            } else {
                                $_SESSION['msg'] = MSG_ALT_NOT_PERF_SUCCESS;
                                header("Location: " . URL . "fgts/index");
                                exit;
                            }
                        } else { // -> Se for falso, então apresenta essa MSG e salva os dados no formulário.
                            $_SESSION['msg'] = "<p style='color: red;'>Informe o PRAZO ESCOLHIDO para NOVA SIMULAÇÃO!</p>";
                            $this->data['form'] = $viewPp->getResultDb();
                            $this->loadViewTwo(); // -> Carrega a VIEW específica para este estágio.
                        }
                    } else if (!empty($this->dataForm['del_pp'])) {
                        unset($this->dataForm['del_pp']);
                        if ($this->dataForm['obs'] == '') {
                            $_SESSION['msg'] = "<p style='color: red;'>Informe o MOTIVO do CANCELAMENTO na OBSERVAÇÃO!</p>";
                            $this->data['form'] = $viewPp->getResultDb();
                            $this->loadViewTwo(); // -> Carrega a VIEW específica para este estágio.
                        }
                    } else if (!empty($this->dataForm['only_obs'])) {
                        unset($this->dataForm['only_obs']);
                        if ($this->dataForm['observation'] == '') {
                            $_SESSION['msg'] = "<p style='color: red;'>Informe a OBSERVAÇÃO antes de realizar a devolução da OPERAÇÃO!</p>";
                            $this->data['form'] = $viewPp->getResultDb();
                            $this->loadViewTwo(); // -> Carrega a VIEW específica para este estágio.
                        } else {
                            $this->dataForm['modified'] = date("Y-m-d H:i:s");
                            $this->dataForm['possession'] = 1;
                            $this->dataForm['internship_proposal'] = 2;
                            $upPp = new \Sts\Models\helper\StsUpdade();
                            $upPp->exeUpdate("sts_proposal_fgts", $this->dataForm, "WHERE id=:id", "id={$this->id}");
                            if ($upPp->getResult()) {
                                $_SESSION['msg'] = MSG_ALT_PERF_SUCCESS;
                                header("Location: " . URL . "fgts/index");
                                exit;
                            } else {
                                $_SESSION['msg'] = MSG_ALT_NOT_PERF_SUCCESS;
                                header("Location: " . URL . "fgts/index");
                                exit;
                            }
                        }
                    } else {
                        $this->loadViewTwo(); // -> Carrega a VIEW específica para este estágio.
                        //var_dump($fillPp->resultController());
                    }
                }
                // ESTÁGIO 4 ------------------------------------------------------------------------------------
            } else if (($viewPp->getResultDb()[0]['internship_proposal'] === 4) or ($viewPp->getResultDb()[0]['internship_proposal'] === 5)) {
                $this->data['form'] = $viewPp->getResultDb()[0];
                $this->loadViewThree();
            }
        } else {
            $_SESSION['msg'] = MSG_REGISTER_NOT_FOUND;
            header("Location: " . URL . "fgts/index");
            exit;
        }
    }

    public function loadViewTwo()
    {
        $loadView = new \Core\ConfigView();
        $loadView->loadView("app/sts/Views/dashboard/proposalCustomerTwo", $this->data);
    }

    public function loadViewThree()
    {
        $loadView = new \Core\ConfigView();
        $loadView->loadView("app/sts/Views/dashboard/proposalCustomerThree", $this->data);
    }
}
