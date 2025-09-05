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
<?php
$value_pp = "";
if ($this->data['form']['possession'] == 2) {
    $value_pp = "CANCELADA";
} else if ($this->data['form']['possession'] == 3) {
    $value_pp = "PAGA";
} else if ($this->data['form']['possession'] == 4) {
    $value_pp = "Aguardando FORMALIZAÇÃO DIGITAL";
}
?>
<p>Status da OPERAÇÃO: <?php echo $value_pp; ?></p><br>

<label>Última OBSERVAÇÃO: </label><br>
<textarea><?php echo $this->data['form']['observation']; ?></textarea><br>

<a href="<?php echo URL; ?>fgts/index">Voltar</a>