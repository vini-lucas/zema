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

<ul>
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

<hr>
<br>

<form method="POST">
    <textarea name="observation" placeholder="Envie alguma MSG para o CLIENTE/VENDEDOR."></textarea><br><br>
    <input type="submit" name="sendLink" value="Devolver com LINK de FORMALIZAÇÃO"> - 
    <input type="submit" name="sendPending" value="Devolver com PENDÊNCIA(S)"> - 
    <input type="submit" name="delPp" value="Cancelar OPERAÇÃO"> - 
    <a href="<?php echo URL; ?>fgts/index">Voltar</a>
</form>
