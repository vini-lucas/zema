<?php

/**
 * Caso o usuário tente acessar a página sem ser pelo arquivo index, acessa este if.
 */
if (!defined('L4bar3tTA!')) {
    header("Location: /");
}

if (isset($this->data)) {
    extract($this->data);
}

if ((isset($_SESSION['msg-helper']))) {
    echo $_SESSION['msg-helper'];
    unset($_SESSION['msg-helper']);
} else if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}
?>
<h2>Vizualizar Proposta - Cliente/Vendedor</h2>
<hr>
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
            <td>
                <?php
                echo $this->data['form'][0]['cpf'];
                ?>
            </td>
            <td>
                <?php
                echo $this->data['form'][0]['name'];
                ?>
            </td>
            <td>
                <?php
                echo $this->data['form'][0]['date_birth'];
                ?>
            </td>
        </tr>
    </tbody>
</table>
<hr>
<h2>Valores LIBERADOS:</h2>
<p>Valor LIBERADO: <?php echo $this->data['form'][0]['value_released']; ?>.</p>
<table>
    <form method="POST" action="">
        <thead>
            <tr>
                <th>Nº da PARCELA</th>
                <th>Valor da PARCELA</th>
                <th>Data da PARCELA</th>
                <th>Quantidade de PARCELA(S) ESCOLHIDA(S) ou SOLICITADA(S)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1ª</td>
                <?php
                $one_portion = "";
                $one_portion_date = "";
                if ((isset($this->data['portions']['1_portion']['value'])) and (isset($this->data['portions']['1_portion']['date']))) {
                    $one_portion = $this->data['portions']['1_portion']['value'];
                    $one_portion_date = $this->data['portions']['1_portion']['date'];
                }
                ?>
                <td><?php echo $one_portion; ?></td>
                <td><?php echo $one_portion_date; ?></td>
                <td><input type="radio" name="one"></td>
            </tr>
            <tr>
                <td>2ª</td>
                <?php
                $two_portion = "";
                $two_portion_date = "";
                if ((isset($this->data['portions']['2_portion']['value'])) and (isset($this->data['portions']['2_portion']['date']))) {
                    $two_portion = $this->data['portions']['2_portion']['value'];
                    $two_portion_date = $this->data['portions']['2_portion']['date'];
                }
                ?>
                <td><?php echo $two_portion; ?></td>
                <td><?php echo $two_portion_date; ?></td>
                <td><input type="radio" name="two"></td>
            </tr>
            <tr>
                <td>3ª</td>
                <?php
                $three_portion = "";
                $three_portion_date = "";
                if ((isset($this->data['portions']['3_portion']['value'])) and (isset($this->data['portions']['3_portion']['date']))) {
                    $three_portion = $this->data['portions']['3_portion']['value'];
                    $three_portion_date = $this->data['portions']['3_portion']['date'];
                }
                ?>
                <td><?php echo $three_portion; ?></td>
                <td><?php echo $three_portion_date; ?></td>
                <td><input type="radio" name="three"></td>
            </tr>
            <tr>
                <td>4ª</td>
                <?php
                $four_portion = "";
                $four_portion_date = "";
                if ((isset($this->data['portions']['4_portion']['value'])) and (isset($this->data['portions']['4_portion']['date']))) {
                    $four_portion = $this->data['portions']['4_portion']['value'];
                    $four_portion_date = $this->data['portions']['4_portion']['date'];
                }
                ?>
                <td><?php echo $four_portion; ?></td>
                <td><?php echo $four_portion_date; ?></td>
                <td><input type="radio" name="four"></td>
            </tr>
            <tr>
                <td>5ª</td>
                <?php
                $five_portion = "";
                $five_portion_date = "";
                if ((isset($this->data['portions']['5_portion']['value'])) and (isset($this->data['portions']['5_portion']['date']))) {
                    $five_portion = $this->data['portions']['5_portion']['value'];
                    $five_portion_date = $this->data['portions']['5_portion']['date'];
                }
                ?>
                <td><?php echo $five_portion; ?></td>
                <td><?php echo $five_portion_date; ?></td>
                <td><input type="radio" name="five"></td>
            </tr>
            <tr>
                <td>6ª</td>
                <?php
                $six_portion = "";
                $six_portion_date = "";
                if ((isset($this->data['portions']['6_portion']['value'])) and (isset($this->data['portions']['6_portion']['date']))) {
                    $six_portion = $this->data['portions']['6_portion']['value'];
                    $six_portion_date = $this->data['portions']['6_portion']['date'];
                }
                ?>
                <td><?php echo $six_portion; ?></td>
                <td><?php echo $six_portion_date; ?></td>
                <td><input type="radio" name="six"></td>
            </tr>
            <tr>
                <td>7ª</td>
                <?php
                $seven_portion = "";
                $seven_portion_date = "";
                if ((isset($this->data['portions']['7_portion']['value'])) and (isset($this->data['portions']['7_portion']['date']))) {
                    $seven_portion = $this->data['portions']['7_portion']['value'];
                    $seven_portion_date = $this->data['portions']['7_portion']['date'];
                }
                ?>
                <td><?php echo $seven_portion; ?></td>
                <td><?php echo $seven_portion_date; ?></td>
                <td><input type="radio" name="seven"></td>
            </tr>
            <tr>
                <td>8ª</td>
                <?php
                $eight_portion = "";
                $eight_portion_date = "";
                if ((isset($this->data['portions']['8_portion']['value'])) and (isset($this->data['portions']['8_portion']['date']))) {
                    $eight_portion = $this->data['portions']['8_portion']['value'];
                    $eight_portion_date = $this->data['portions']['8_portion']['date'];
                }
                ?>
                <td><?php echo $eight_portion; ?></td>
                <td><?php echo $eight_portion_date; ?></td>
                <td><input type="radio" name="eight"></td>
            </tr>
            <tr>
                <td>9ª</td>
                <?php
                $nine_portion = "";
                $nine_portion_date = "";
                if ((isset($this->data['portions']['9_portion']['value'])) and (isset($this->data['portions']['9_portion']['date']))) {
                    $nine_portion = $this->data['portions']['9_portion']['value'];
                    $nine_portion_date = $this->data['portions']['9_portion']['date'];
                }
                ?>
                <td><?php echo $nine_portion; ?></td>
                <td><?php echo $nine_portion_date; ?></td>
                <td><input type="radio" name="nine"></td>
            </tr>
            <tr>
                <td>10ª</td>
                <?php
                $ten_portion = "";
                $ten_portion_date = "";
                if ((isset($this->data['portions']['10_portion']['value'])) and (isset($this->data['portions']['10_portion']['date']))) {
                    $ten_portion = $this->data['portions']['10_portion']['value'];
                    $ten_portion_date = $this->data['portions']['10_portion']['date'];
                }
                ?>
                <td><?php echo $ten_portion; ?></td>
                <td><?php echo $ten_portion_date; ?></td>
                <td><input type="radio" name="ten"></td>
            </tr>
        </tbody>
</table>

<hr>

<h2>Ações</h2>

<input type="submit" name="new_portions" value="Devolver solicitando NOVO PRAZO."><br><br>
</form>

<form method="POST" action="">
    <input type="submit" name="accept_value" value="Aceitar VALOR LIBERADO."><br><br>
</form>

<hr>

<form method="POST" action="">
    <?php
    if (!empty($this->data['form'][0]['observation'])) {
        $value_observation = $this->data['form'][0]['observation'];
    }
    ?>
    <textarea name="observation" placeholder="Envie uma MENSAGEM para a MESA."><?php echo $value_observation; ?></textarea><br><br>
    <input type="submit" name="del_pp" value="Cancelar OPERAÇÃO.">
    <input type="submit" name="only_obs" value="Devolver somente informando a OBSERVAÇÃO."><br><br>
</form>
<a href="<?php echo URL; ?>fgts/index">Voltar</a>