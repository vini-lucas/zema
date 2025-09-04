<?php

namespace Sts\Controllers;

/**
 * Caso o usuário tente acessar a página sem ser pelo arquivo index, acessa este if.
 */
if (!defined('L4bar3tTA!')) {
    header("Location: /");
}

/**
 * Somente Administrador ou Super Administrador podem acessar esta classe.
 */
class ViewProposal
{
    private array|null $data; // -> Recebe os dados que serão enviados para a view.
    private array|null $dataForm; // -> Recebe os dados que o usuário informou no formulário.
    private int|null $id; // -> Recebe o ID da proposta.

    public function index(int|null $id)
    {
        $this->id = $id; // -> Recebe o ID da proposta.
        if (($_SESSION['user_access_level'] == 'Cliente') or ($_SESSION['user_access_level'] == 'Vendedor')) { // -> Se o usuário for cliente ou vendedor então:
            header("Location: " . URL . "page-err/index"); // -> É redirecionado para a página de erro.
            exit;
        } else { // -> Se o usuário for Administrador ou Super Administrador, então:
            $searchDataPp = new \Sts\Models\StsViewProposal();
            $searchDataPp->searchDataPp($this->id); // -> Instancia o método que traz todas as informações daquela proposta.
            if ($searchDataPp->getResult()) { // -> Se aquela proposta de fato existir então:
                $this->data['portion'] = [$searchDataPp->getResultDb()[0]['cpf'], $searchDataPp->getResultDb()[0]['name'], $searchDataPp->getResultDb()[0]['date_birth']]; // -> A posição 'portion' é para preencher somente o CPF, nome e DN.
                $this->data['database'] = $searchDataPp->getResultDb();
                $this->data['portions'] = json_decode($searchDataPp->getResultDb()[0]['portions'], true);

                // ESTÁGIO 1 ou 2 ----------------------------------------------------------------------
                if (($searchDataPp->getResultDb()[0]['internship_proposal'] == 1) || ($searchDataPp->getResultDb()[0]['internship_proposal'] == 2)) { // -> Se a proposta estiver no estágio 1, então:
                    $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT); // Recebe os dados do formulário.
                    if (!empty($this->dataForm['SendProposal'])) { // -> Se o usuário clicar no botão para enviar a simulação, então:
                        unset($this->dataForm['SendProposal']); // -> Destrói a posição do botão.
                        if ((($this->dataForm['portions_one'] ?? '') === '' && ($this->dataForm['date_portions_one'] ?? '') !== '') || (($this->dataForm['date_portions_one'] ?? '') === '' && ($this->dataForm['portions_one'] ?? '') !== '') || (($this->dataForm['portions_one'] ?? '') === '' && ($this->dataForm['date_portions_one'] ?? '') === '')
                        ) { // -> Se o usuário não preencher nada na tabela, então:
                            $this->data['form'] = $this->dataForm;
                            $_SESSION['msg'] = MSG_PRIME_MSG; // -> Apresenta esta MSG e mantém os dados no formulário.
                            $this->loadViewOne(); // -> Carrega a VIEW de estágio um.
                        } else { // -> Se preencher, então:
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
                            ]; // -> Cria um ARRAY com estas posições.
                            $mismatch = false; // -> Incompatibilidade recebe falso.
                            for ($i = 2; $i <= 10; $i++) { // Sempre que o for executa $i recebe 2, 3 ou diante.
                                $suf = $suffixes[$i];
                                $valor = $this->dataForm["portions_{$suf}"] ?? '';
                                $data  = $this->dataForm["date_portions_{$suf}"] ?? '';
                                if (($valor === '' && $data !== '') || ($valor !== '' && $data === '')) {
                                    $mismatch = true; // -> Se encontrar alguma inconsistência de não preenchimento de parcelas, $mismatch recebe verdadeiro.
                                    break;
                                }
                            }
                            if ($mismatch) { // -> Se $mismatch for verdadeiro, mostra essa MSG e mantém os dados no formulário.
                                $this->data['form'] = $this->dataForm;
                                $_SESSION['msg'] = MSG_DATE_PORTION_REMAINING;
                                $this->loadViewOne(); // -> Carrega a VIEW de estágio um.
                            } else { // -> Se retornar falso, valida a observação:
                                if (($this->dataForm['observation'] ?? '') === '') {
                                    $this->data['form'] = $this->dataForm; // -> Se não preencheu nada na OBS mantém os dados no formulário e mostra essa MSG.
                                    $_SESSION['msg'] = "<p style='color: red;'>Informe a OBSERVAÇÃO antes de enviar a SIMULAÇÃO!</p>";
                                    $this->loadViewOne(); // -> Carrega a VIEW de estágio um.
                                } else { // -> Se preencheu a OBS, então:
                                    if ($this->dataForm['value_released'] == '') {
                                        $this->data['form'] = $this->dataForm; // -> Se não preencheu nada no VALOR LIBERADO, mantém os dados no formulário e mostra essa MSG.
                                        $_SESSION['msg'] = "<p style='color: red;'>Informe o VALOR LIBERADO antes de enviar a SIMULAÇÃO!</p>";
                                        $this->loadViewOne(); // -> Carrega a VIEW de estágio um.
                                    } else {
                                        $parcelas = [];
                                        for ($i = 1; $i <= 10; $i++) {
                                            $suf = $suffixes[$i];
                                            $valor = $this->dataForm["portions_{$suf}"] ?? '';
                                            $data  = $this->dataForm["date_portions_{$suf}"] ?? ''; // -> Aqui e acima percorre todas as parcelas para verificar se o valor e data foram preenchidos.
                                            if ($valor !== '' && $data !== '') { // -> As que foram preenchidas viram esse json.
                                                $parcelas["{$i}_portion"] = [
                                                    "value" => $valor,
                                                    "date"  => $data
                                                ];
                                            }
                                            unset($this->dataForm["portions_{$suf}"], $this->dataForm["date_portions_{$suf}"]); // -> As que não foram são deletadas.
                                        }
                                        $jsonParcelas = json_encode($parcelas, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT); // Depois, as transorma num json para encaminhar ao banco de dados.
                                        $this->dataForm['modified'] = date("Y-m-d H:i:s");
                                        $this->dataForm['possession'] = 0;
                                        $this->dataForm['internship_proposal'] = 2;
                                        $this->dataForm['portions'] = $jsonParcelas;
                                        $upPp = new \Sts\Models\StsViewProposal();
                                        $upPp->editProposal($this->id, $this->dataForm); // -> Depois sobe toda as alterações.
                                        if ($upPp->getResult()) { // -> E redireciona, independentemente se deu certo ou não.
                                            header("Location: " . URL . "fgts/index");
                                            exit;
                                        } else {
                                            header("Location: " . URL . "fgts/index");
                                            exit;
                                        }
                                    }
                                }
                            }
                        }
                    } else { // -> Se o usuário não clicar no botão para enviar a simulação, então:
                        $this->loadViewOne(); // -> Carrega a VIEW de estágio um.
                    }
                    // -----------------------------------------------------------------------------------
                    // ESTÁGIO 2 -------------------------------------------------------------------------
                } else {

                }
                

            } else { // -> Se o usuário for cliente ou vendedor, então:
                header("Location: " . URL . "page-err/index");
                exit;
            }
        }
    }

    public function loadView()
    {
        $loadView = new \Core\ConfigView();
        $loadView->loadView("app/sts/Views/dashboard/viewProposal", $this->data);
    }

    public function loadViewOne()
    {
        $loadView = new \Core\ConfigView();
        $loadView->loadView("app/sts/Views/dashboard/proposalAdmOne", $this->data);
    }
}
