<?php

/**
 * Caso o usuário tente acessar a página sem ser pelo arquivo index, acessa este if.
 */
if (!defined('L4bar3tTA!')) {
    header("Location: /");
}

if ((isset($_SESSION['msg-helper']))) {
    echo $_SESSION['msg-helper'];
    unset($_SESSION['msg-helper']);
} else if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}
?>
<h2>Vizualizar Proposta - Mesa</h2>
<table>
    <thead>
        <tr>
            <th>CPF</th>
            <th>Nome Completo</th>
            <th>Data de Nascimento</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><?php echo $this->data['portion'][0]; ?></td>
            <td><?php echo $this->data['portion'][1]; ?></td>
            <td><?php echo $this->data['portion'][2]; ?></td>
        </tr>
    </tbody>
</table>

<hr>

<h2>Tabela de Parcelas</h2>
<form method="POST">
    <table>
        <thead>
            <tr>
                <th>Nº da PARCELA</th>
                <th>Valor da PARCELA</th>
                <th>Data da PARCELA</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1ª</td>
                <?php
                $value_one = "";
                if (!empty($this->data['form']['portions_one'])) {
                    $value_one = $this->data['form']['portions_one'];
                } else if (!empty($this->data['portions']['1_portion']['value'])) {
                    $value_one = $this->data['portions']['1_portion']['value'];
                }
                $value_date_one = "";
                if (!empty($this->data['form']['date_portions_one'])) {
                    $value_date_one = $this->data['form']['date_portions_one'];
                } else if (!empty($this->data['portions']['1_portion']['date'])) {
                    $value_date_one = $this->data['portions']['1_portion']['date'];
                }
                ?>
                <td><input type="text" name="portions_one" value="<?php echo $value_one; ?>" placeholder="R$ XXX,XX"></td>
                <td><input type="date" name="date_portions_one" value="<?php echo $value_date_one; ?>"></td>
            </tr>
            <tr>
                <td>2ª</td>
                <?php
                $value_two = "";
                if (!empty($this->data['form']['portions_two'])) {
                    $value_two = $this->data['form']['portions_two'];
                } else if (!empty($this->data['portions']['2_portion']['value'])) {
                    $value_two = $this->data['portions']['2_portion']['value'];
                }
                $value_date_two = "";
                if (!empty($this->data['form']['date_portions_two'])) {
                    $value_date_two = $this->data['form']['date_portions_two'];
                } else if (!empty($this->data['portions']['2_portion']['date'])) {
                    $value_date_two = $this->data['portions']['2_portion']['date'];
                }
                ?>
                <td><input type="text" name="portions_two" value="<?php echo $value_two; ?>" placeholder="R$ XXX,XX"></td>
                <td><input type="date" name="date_portions_two" value="<?php echo $value_date_two; ?>"></td>
            </tr>
            <tr>
                <td>3ª</td>
                <?php
                $value_three = "";
                if (!empty($this->data['form']['portions_three'])) {
                    $value_three = $this->data['form']['portions_three'];
                } else if (!empty($this->data['portions']['3_portion']['value'])) {
                    $value_three = $this->data['portions']['3_portion']['value'];
                }
                $value_date_three = "";
                if (!empty($this->data['form']['date_portions_three'])) {
                    $value_date_three = $this->data['form']['date_portions_three'];
                } else if (!empty($this->data['portions']['3_portion']['date'])) {
                    $value_date_three = $this->data['portions']['3_portion']['date'];
                }
                ?>
                <td><input type="text" name="portions_three" value="<?php echo $value_three; ?>" placeholder="R$ XXX,XX"></td>
                <td><input type="date" name="date_portions_three" value="<?php echo $value_date_three; ?>"></td>
            </tr>
            <tr>
                <td>4ª</td>
                <?php
                $value_four = "";
                if (!empty($this->data['form']['portions_four'])) {
                    $value_four = $this->data['form']['portions_four'];
                } else if (!empty($this->data['portions']['4_portion']['value'])) {
                    $value_four = $this->data['portions']['4_portion']['value'];
                }
                $value_date_four = "";
                if (!empty($this->data['form']['date_portions_four'])) {
                    $value_date_four = $this->data['form']['date_portions_four'];
                } else if (!empty($this->data['portions']['4_portion']['date'])) {
                    $value_date_four = $this->data['portions']['4_portion']['date'];
                }
                ?>
                <td><input type="text" name="portions_four" placeholder="R$ XXX,XX" value="<?php echo $value_four; ?>"></td>
                <td><input type="date" name="date_portions_four" value="<?php echo $value_date_four; ?>"></td>
            </tr>
            <tr>
                <td>5ª</td>
                <?php
                $value_five = "";
                if (!empty($this->data['form']['portions_five'])) {
                    $value_five = $this->data['form']['portions_five'];
                } else if (!empty($this->data['portions']['5_portion']['value'])) {
                    $value_five = $this->data['portions']['5_portion']['value'];
                }
                $value_date_five = "";
                if (!empty($this->data['form']['date_portions_five'])) {
                    $value_date_five = $this->data['form']['date_portions_five'];
                } else if (!empty($this->data['portions']['5_portion']['date'])) {
                    $value_date_five = $this->data['portions']['5_portion']['date'];
                }
                ?>
                <td><input type="text" name="portions_five" placeholder="R$ XXX,XX" value="<?php echo $value_five; ?>"></td>
                <td><input type="date" name="date_portions_five" value="<?php echo $value_date_five; ?>"></td>
            </tr>
            <tr>
                <td>6ª</td>
                <?php
                $value_six = "";
                if (!empty($this->data['form']['portions_six'])) {
                    $value_six = $this->data['form']['portions_six'];
                } else if (!empty($this->data['portions']['6_portion']['value'])) {
                    $value_six = $this->data['portions']['6_portion']['value'];
                }
                $value_date_six = "";
                if (!empty($this->data['form']['date_portions_six'])) {
                    $value_date_six = $this->data['form']['date_portions_six'];
                } else if (!empty($this->data['portions']['6_portion']['date'])) {
                    $value_date_six = $this->data['portions']['6_portion']['date'];
                }
                ?>
                <td><input type="text" name="portions_six" placeholder="R$ XXX,XX" value="<?php echo $value_six; ?>"></td>
                <td><input type="date" name="date_portions_six" value="<?php echo $value_date_six; ?>"></td>
            </tr>
            <tr>
                <td>7ª</td>
                <?php
                $value_seven = "";
                if (!empty($this->data['form']['portions_seven'])) {
                    $value_seven = $this->data['form']['portions_seven'];
                } else if (!empty($this->data['portions']['7_portion']['value'])) {
                    $value_seven = $this->data['portions']['7_portion']['value'];
                }
                $value_date_seven = "";
                if (!empty($this->data['form']['date_portions_seven'])) {
                    $value_date_seven = $this->data['form']['date_portions_seven'];
                } else if (!empty($this->data['portions']['7_portion']['date'])) {
                    $value_date_seven = $this->data['portions']['7_portion']['date'];
                }
                ?>
                <td><input type="text" name="portions_seven" placeholder="R$ XXX,XX" value="<?php echo $value_seven; ?>"></td>
                <td><input type="date" name="date_portions_seven" value="<?php echo $value_date_seven; ?>"></td>
            </tr>
            <tr>
                <td>8ª</td>
                <?php
                $value_eight = "";
                if (!empty($this->data['form']['portions_eight'])) {
                    $value_eight = $this->data['form']['portions_eight'];
                } else if (!empty($this->data['portions']['8_portion']['value'])) {
                    $value_eight = $this->data['portions']['8_portion']['value'];
                }
                $value_date_eight = "";
                if (!empty($this->data['form']['date_portions_eight'])) {
                    $value_date_eight = $this->data['form']['date_portions_eight'];
                } else if (!empty($this->data['portions']['8_portion']['date'])) {
                    $value_date_eight = $this->data['portions']['8_portion']['date'];
                }
                ?>
                <td><input type="text" name="portions_eight" placeholder="R$ XXX,XX" value="<?php echo $value_eight; ?>"></td>
                <td><input type="date" name="date_portions_eight" value="<?php echo $value_date_eight; ?>"></td>
            </tr>
            <tr>
                <td>9ª</td>
                <?php
                $value_nine = "";
                if (!empty($this->data['form']['portions_nine'])) {
                    $value_nine = $this->data['form']['portions_nine'];
                } else if (!empty($this->data['portions']['9_portion']['value'])) {
                    $value_nine = $this->data['portions']['9_portion']['value'];
                }
                $value_date_nine = "";
                if (!empty($this->data['form']['date_portions_nine'])) {
                    $value_date_nine = $this->data['form']['date_portions_nine'];
                } else if (!empty($this->data['portions']['9_portion']['date'])) {
                    $value_date_nine = $this->data['portions']['9_portion']['date'];
                }
                ?>
                <td><input type="text" name="portions_nine" placeholder="R$ XXX,XX" value="<?php echo $value_nine; ?>"></td>
                <td><input type="date" name="date_portions_nine" value="<?php echo $value_date_nine; ?>"></td>
            </tr>
            <tr>
                <td>10ª</td>
                <?php
                $value_ten = "";
                if (!empty($this->data['form']['portions_ten'])) {
                    $value_ten = $this->data['form']['portions_ten'];
                } else if (!empty($this->data['portions']['10_portion']['value'])) {
                    $value_ten = $this->data['portions']['10_portion']['value'];
                }
                $value_date_ten = "";
                if (!empty($this->data['form']['date_portions_ten'])) {
                    $value_date_ten = $this->data['form']['date_portions_ten'];
                } else if (!empty($this->data['portions']['10_portion']['date'])) {
                    $value_date_ten = $this->data['portions']['10_portion']['date'];
                }
                ?>
                <td><input type="text" name="portions_ten" placeholder="R$ XXX,XX" value="<?php echo $value_ten; ?>"></td>
                <td><input type="date" name="date_portions_ten" value="<?php echo $value_date_ten; ?>"></td>
            </tr>
            <tr>
                <td>Informe o VALOR LIBERADO.</td>
                <?php
                $value_released = "";
                if (!empty($this->data['form']['value_released'])) {
                    $value_released = $this->data['form']['value_released'];
                } else if (!empty($this->data['database'][0]['value_released'])) {
                    $value_released = $this->data['database'][0]['value_released'];
                }
                ?>
                <td><input type="text" name="value_released" value="<?php echo $value_released; ?>" placeholder="Ex.: R$ XXX,XX"></td>
            </tr>
        </tbody>
    </table>
    <?php
    $value_obs = "";
    if (!empty($this->data['form']['observation'])) {
        $value_obs = $this->data['form']['observation'];
    } else if ($this->data['database'][0]['observation']) {
        $value_obs = $this->data['database'][0]['observation'];
    }
    ?>
    <label>Observação</label>
    <textarea name="observation" placeholder="Envie uma MSG para o CLIENTE."><?php echo $value_obs; ?></textarea>
    <hr>

    <h2>Ações</h2>
    <input type="submit" name="SendProposal" value="Enviar SIMULAÇÃO"> -
    <input type="submit" name="OnlyObs" value="Devolver somente com OBSERVAÇÃO"> -
    <input type="submit" name="DelProposal" value="Cancelar PROPOSTA">

    <br><br>

    <button name="PendingAllowBanks">PENDÊNCIA - Autorizar BANCOS</button> -
    <button name="PendingAllowBirh">PENDÊNCIA - Aderir SAQUE-ANIVERSÁRIO</button><br><br>

    <a href="<?php echo URL; ?>fgts/index">Voltar</a>
</form>