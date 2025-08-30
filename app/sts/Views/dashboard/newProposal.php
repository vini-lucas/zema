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
<h2>Nova Proposta de FGTS</h2>
<form method="POST">

    <label>CPF:</label>
    <input type="text" name="cpf" value="" placeholder="XXX.XXX.XXX-XX" id="cpf"><br><br>

    <label>Nome:</label>
    <input type="text" name="name" value="" placeholder="Ex.: Lucas Vinicius" id="name"><br><br>

    <label>Nascimento:</label>
    <input type="date" name="date_birth" value=""><br><br>

    <input type="submit" name="SendProposal" value="Enviar Proposta"><br><br>

</form>
<a href="<?php echo URL; ?>fgts/index">Voltar</a>
