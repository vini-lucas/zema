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
            <td><?php //echo $this->data['portion'][0]; 
                ?></td>
            <td><?php //echo $this->data['portion'][1]; 
                ?></td>
            <td><?php //echo $this->data['portion'][2]; 
                ?></td>
        </tr>
    </tbody>
</table>
<hr>
<h2>Valores LIBERADOS:</h2>
<table>
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
            $one_portion = $this->data['portions']['1_portion'] ? $this->data['portions']['1_portion']['value'] : "";
            $one_portion_date = $this->data['portions']['1_portion'] ? $this->data['portions']['1_portion']['date'] : "";
            ?>
            <td><?php echo $one_portion; ?></td>
            <td><?php echo $one_portion_date; ?></td>
        </tr>
        <tr>
            <td>2ª</td>
            <?php
            $two_portion = $this->data['portions']['2_portion'] ? $this->data['portions']['2_portion']['value'] : "";
            $two_portion_date = $this->data['portions']['2_portion'] ? $this->data['portions']['2_portion']['date'] : "";
            ?>
            <td><?php echo $two_portion; ?></td>
            <td><?php echo $two_portion_date; ?></td>
        </tr>
        <tr>
            <td>3ª</td>
            <?php
            $three_portion = $this->data['portions']['3_portion'] ? $this->data['portions']['3_portion']['value'] : "";
            $three_portion_date = $this->data['portions']['3_portion'] ? $this->data['portions']['3_portion']['date'] : "";
            ?>
            <td><?php echo $three_portion; ?></td>
            <td><?php echo $three_portion_date; ?></td>
        </tr>
        <tr>
            <td>4ª</td>
            <?php
            $four_portion = $this->data['portions']['4_portion'] ? $this->data['portions']['4_portion']['value'] : "";
            $four_portion_date = $this->data['portions']['4_portion'] ? $this->data['portions']['4_portion']['date'] : "";
            ?>
            <td><?php echo $four_portion; ?></td>
            <td><?php echo $four_portion_date; ?></td>
        </tr>
        <tr>
            <td>5ª</td>
            <?php
            $five_portion = $this->data['portions']['5_portion'] ? $this->data['portions']['5_portion']['value'] : "";
            $five_portion_date = $this->data['portions']['5_portion'] ? $this->data['portions']['5_portion']['date'] : "";
            ?>
            <td><?php echo $five_portion; ?></td>
            <td><?php echo $five_portion_date; ?></td>
        </tr>
        <tr>
            <td>6ª</td>
            <?php
            $six_portion = $this->data['portions']['6_portion'] ? $this->data['portions']['6_portion']['value'] : "";
            $six_portion_date = $this->data['portions']['6_portion'] ? $this->data['portions']['6_portion']['date'] : "";
            ?>
            <td><?php echo $six_portion; ?></td>
            <td><?php echo $six_portion_date; ?></td>
        </tr>
        <tr>
            <td>7ª</td>
            <?php
            $seven_portion = $this->data['portions']['7_portion'] ? $this->data['portions']['7_portion']['value'] : "";
            $seven_portion_date = $this->data['portions']['7_portion'] ? $this->data['portions']['7_portion']['date'] : "";
            ?>
            <td><?php echo $seven_portion; ?></td>
            <td><?php echo $seven_portion_date; ?></td>
        </tr>
        <tr>
            <td>8ª</td>
            <?php
            $eight_portion = $this->data['portions']['8_portion'] ? $this->data['portions']['8_portion']['value'] : "";
            $eight_portion_date = $this->data['portions']['8_portion'] ? $this->data['portions']['8_portion']['date'] : "";
            ?>
            <td><?php echo $eight_portion; ?></td>
            <td><?php echo $eight_portion_date; ?></td>
        </tr>
        <tr>
            <td>9ª</td>
            <?php
            $nine_portion = $this->data['portions']['9_portion'] ? $this->data['portions']['9_portion']['value'] : "";
            $nine_portion_date = $this->data['portions']['9_portion'] ? $this->data['portions']['9_portion']['date'] : "";
            ?>
            <td><?php echo $nine_portion; ?></td>
            <td><?php echo $nine_portion_date; ?></td>
        </tr>
        <tr>
            <td>10ª</td>
            <?php
            $ten_portion = $this->data['portions']['10_portion'] ? $this->data['portions']['10_portion']['value'] : "";
            $ten_portion_date = $this->data['portions']['10_portion'] ? $this->data['portions']['10_portion']['date'] : "";
            ?>
            <td><?php echo $ten_portion; ?></td>
            <td><?php echo $ten_portion_date; ?></td>
        </tr>
    </tbody>
</table>
<hr>
<h2>Ações</h2>
<button name="accept_value">Aceitar VALOR LIBERADO.</button> - <button name="new_portions">Devolver solicitando NOVO PRAZO.</button> - <button name="only_obs">Devolver somente informando a OBSERVAÇÃO</button> - <button name="del_pp">Cancelar OPERAÇÃO.</button>
<?php
var_dump($this->data);
echo "<hr>";
if ($this->data['form'][0]['internship_proposal'] === 1) {
    echo "Estágio 1: Mesa recebe a OPERAÇÃO com o CPF, NOME e DN preenchidos pelo USUÁRIO!";
} else if ($this->data['form'][0]['internship_proposal'] === 2) {
    echo "Estágio 2: Beneficiário recebe a OPERAÇÃO com o valor LIBERADO, pendência REGISTRADA ou CANCELAMENTO!";
} else if ($this->data['form'][0]['internship_proposal'] === 3) {
    echo "Estágio 3: Mesa recebe a OPERAÇÃO com o valor ESCOLHIDO ou pendência CORRIGIDA!";
} else if ($this->data['form'][0]['internship_proposal'] === 4) {
    echo "Estágio 4: Benenfiário recebe a OPERAÇÃO com a proposta DIGITADA e o link de FORMALIZAÇÃO disponível na OBSERVAÇÃO (cliente não atua mais na proposta)!";
} else if ($this->data['form'][0]['internship_proposal'] === 5) {
    echo "Estágio 5: Mesa atualiza a operação para PAGA ou CANCELADA.";
}
echo "<hr>";
if ($this->data['form'][0]['possession'] === 0) {
    echo "Operação com o CLIENTE!";
} else if ($this->data['form'][0]['possession'] === 1) {
    echo "Operação com a MESA!";
} else if ($this->data['form'][0]['possession'] === 2) {
    echo "Operação CANCELADA ou PAGA.";
}
