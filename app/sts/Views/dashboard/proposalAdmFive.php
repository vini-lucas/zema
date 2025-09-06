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
<h2>Vizualizar Proposta - Mesa</h2>

<ul>
    <?php
    $status = "";
    if ($this->data['typing']['possession'] == 3) {
        $status = "PAGA";
    } else if ($this->data['typing']['possession'] == 2) {
        $status = "CANCELADA";
    } else if ($this->data['typing']['possession'] == 4) {
        $status = "Aguardando FORMALIZAÇÃO DIGITAL";
    }
    ?>
    <li>
        <h2>Status da OPERAÇÃO: <?php echo $status; ?></h2>
    </li>

    <?php
    $obs = "";
    if (!empty($this->data['typing']['observation'])) {
        $obs = $this->data['typing']['observation'];
    }
    ?>
    <li>Última OBSERVAÇÃO: <textarea><?php echo $obs; ?></textarea></li>

    <li>CPF: <?php echo $this->data['typing']['cpf']; ?></li>
    <li>Nome COMPLETO: <?php echo $this->data['typing']['name']; ?></li>
    <li>Data de NASCIMENTO: <?php echo $this->data['typing']['date_birth']; ?></li>
    <li>Gênero: <?php echo $this->data['typing']['gender']; ?></li>
    <li>Nome da MÃE: <?php echo $this->data['typing']['name_mother']; ?></li>
    <li>Nome do PAI: <?php echo $this->data['typing']['name_father']; ?></li>
    <li>Telefone: <?php echo $this->data['typing']['telephone']; ?></li>
    <li>E-mail: <?php echo $this->data['typing']['email']; ?></li>
    <li>CEP: <?php echo $this->data['typing']['cep']; ?></li>
    <li>Logradouro: <?php echo $this->data['typing']['address']; ?></li>
    <li>Banco: <?php echo $this->data['typing']['bank']; ?></li>
    <li>Agência: <?php echo $this->data['typing']['agency']; ?></li>
    <li>Conta: <?php echo $this->data['typing']['account']; ?></li>
    <li>Valor ACEITO: <?php echo $this->data['typing']['value_released']; ?></li>
    <li>Parcelas do CONTRATO:</li>
    <?php
    $parcelas = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
    foreach ($parcelas as $parcela) {
        if ($parcela != 11) {
            if ((isset($this->data['portions']["{$parcela}_portion"]['value'])) and (isset($this->data['portions']["{$parcela}_portion"]['date']))) {
                echo "<li style='list-style-type: none'> - Valor: " . $this->data['portions']["{$parcela}_portion"]['value'] . " --- Data: " . $this->data['portions']["{$parcela}_portion"]['date'] . "</li>";
            }
        } else {
            break;
        }
    }
    ?>
</ul>
<form method="POST">
    <label>Alterar STATUS da OPERAÇÃO</label>
    <select name="internship_proposal">
        <option value="Selecione:" selected>Selecione:</option>
        <option value="1">Operação com a MESA para ENVIAR o valor da SIMULAÇÃO.</option>
        <option value="2">Operação com o BENEFICIÁRIO com o valor da SIMULAÇÃO RECEBIDO.</option>
        <option value="3">Operação com a MESA com o valor da SIMULAÇÃO ESCOLHIDO.</option>
        <option value="4">Operação com a MESA e CLIENTE com o LINK de FORMALIZAÇÃO DISPONÍVEL.</option>
    </select>
    <input type="submit" name="sendPp" value="Alterar"> - <a href="<?php echo URL; ?>fgts/index">Voltar</a>
</form>