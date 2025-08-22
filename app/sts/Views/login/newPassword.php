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
<h2>Reconecte-se!</h2>
<span id="msg"></span>
<form method="POST" action="" id="form-new-password" autocomplete="off">

    <label>Informe a nova SENHA:</label>
    <input type="password" name="password" id="password" placeholder="********"><i class="fa-solid fa-eye" id="icon-password"></i><br><br>

    <label>Confirme-a</label>
    <input type="password" name="conf-password" id="val-password" placeholder="********"><i class="fa-solid fa-eye" id="icon-val-password"></i><br><br>

    <input type="submit" name="SendRecover" value="Enviar"> - <a href="<?php echo URL; ?>login/index">Lembrou?</a>
</form>