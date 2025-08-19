<?php

/**
 * Caso o usuário tente acessar a página sem ser pelo arquivo index, acessa este if.
 */
if (!defined('L4bar3tTA!')) {
    header("Location: /");
}
if ((isset($_SESSION['msg'])) and (isset($_SESSION['msg-helper']))) {
    echo $_SESSION['msg-helper'];
    unset($_SESSION['msg-helper']);
} else if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}
if (isset($this->data['form'])) {
    extract($this->data['form']);
}
?>

<h2>Editar Senha</h2>
<span id="msg"></span>

<form method="POST" action="" autocomplete="off" id="form-edit-pass">

    <label>Informe a nova SENHA:</label>
    <input type="password" name="password" id="password" placeholder="********"><i class="fa-solid fa-eye" id="icon-password"></i><br><br>

    <label>Confirme-a</label>
    <input type="password" name="conf-password" id="val-password" placeholder="********"><br><br>

    <input type="submit" name="SendEditPass" value="Editar"> - <a href="<?php echo URL . "edit-user/index/" . $id?>">Voltar</a>
</form>