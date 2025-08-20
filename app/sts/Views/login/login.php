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
<h2>Conecte-se!</h2>
<span id="msg"></span>
<form method="POST" action="" id="form-login" autocomplete="off">
    <?php
    $cpf = "";
    if (isset($this->data['form']['cpf'])) {
        $cpf = $this->data['form']['cpf'];
    }
    ?>
    <label>CPF:</label>
    <input type="text" name="cpf" placeholder="XXX.XXX.XXX-XX" id='cpf' value="<?php echo $cpf; ?>" maxlength="14" autocomplete="off">

    <label>Senha:</label>
    <input type="password" name="password" placeholder="**************" id='password' value="" autocomplete="off"><i class="fa-solid fa-eye" id="icon-password"></i><br><br>

    <input type="submit" name="SendLogin"> - <a href="<?php echo URL; ?>register/index">Não possui ACESSO?</a>
</form>