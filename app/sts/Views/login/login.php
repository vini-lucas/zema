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

if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}
?>
<h2>Conecte-se!</h2>
<form method="POST" action="" autocomplete="off">
    <?php
    $cpf = "";
    if (isset($this->data['form']['cpf'])) {
        $cpf = $this->data['form']['cpf'];
    }
    ?>
    <label>CPF:</label>
    <input type="text" name="cpf" placeholder="XXX.XXX.XXX-XX" value="<?php echo $cpf; ?>" autocomplete="off" required>

    <label>Senha:</label>
    <input type="password" name="password" placeholder="**************" value="" autocomplete="off" required><br><br>

    <input type="submit" name="SendLogin"> - <a href="<?php echo URL; ?>register/index">Não possui ACESSO?</a>
</form>
<!--<h2>Cadastre-se!</h2>
<form>
    <label>CPF:</label>
    <input type="text" name="cpf" placeholder="XXX.XXX.XXX-XX" required>

    <label>Nome Completo:</label>
    <input type="password" name="name" placeholder="Nome Completo" required>

    <label>Data de Nascimento:</label>
    <input type="date" name="date_birth" required>

    <label>Gênero</label>
    <input type="text" name="gender">

    <label>E-mail</label>
    <input type="text" name="email" placeholder="exemplo@dominio.com" required>

    <label>Telefone</label>
    <input type="text" name="telephone" placeholder="(XX) 9 XXXX-XXXX" required>

    <label>Senha:</label>
    <input type="password" name="password" placeholder="**************" required>

    <label>Confirme a Senha:</label>
    <input type="password" placeholder="**************" required>

    <input type="submit" name="SendLogin">
</form>-->