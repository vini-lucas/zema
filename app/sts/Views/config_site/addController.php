<?php

/**
 * Caso o usuário tente acessar a página sem ser pelo arquivo index, acessa este if.
 */
if (!defined('L4bar3tTA!')) {
    header("Location: /");
}

if (isset($this->data['form'])) {
    extract($this->data['form']);
}

if ((isset($_SESSION['msg-helper']))) {
    echo $_SESSION['msg-helper'];
    unset($_SESSION['msg-helper']);
} else if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}
?>
<h2>Nova Controller</h2>
<span id="msg"></span>
<form method="POST" action="" autocomplete="off">

    <?php
    $controller_value = "";
    if (!empty($controller)) {
        $controller_value = $controller;
    }
    ?>
    <label>Nome:</label>
    <input type="text" name="controller" value="<?php echo $controller_value; ?>" placeholder="Ex.: Dashboard" autocomplete="off"><br><br>

    <?php
    $msg_value = "";
    if (!empty($msg)) {
        $msg_value = $msg;
    }
    ?>
    <label>Privacidade da Página:</label>

    <input type='radio' name='public' value='1'>
    <label>Pública</label>
    <input type='radio' name='public' value='0'>
    <label>Privada</label>
    <br><br>

    <input type="submit" name="SendAddMsg" value="Cadastrar"> - <a href="<?php echo URL; ?>default-msg/index">Voltar</a>
</form>