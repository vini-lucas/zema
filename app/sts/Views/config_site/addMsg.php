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
<h2>Nova Mensagem</h2>
<span id="msg"></span>
<form method="POST" action="" autocomplete="off">

    <?php
    $shortcut_value = "";
    if (!empty($shortcut)) {
        $shortcut_value = $shortcut;
    }
    ?>
    <label>Atalho:</label>
    <input type="text" name="shortcut" id="shortcut" value="<?php echo $shortcut_value; ?>" placeholder="Ex.: MSG_ERR" autocomplete="off"><br><br>

    <?php
    $msg_value = "";
    if (!empty($msg)) {
        $msg_value = $msg;
    }
    ?>
    <label>Mensagem:</label>
    <input type="text" name="msg" id="msg" value="<?php echo $msg_value; ?>" placeholder="Ex.: <p>Erro!</p>" autocomplete="off"><br><br>

    <input type="submit" name="SendAddMsg" value="Cadastrar"> - <a href="<?php echo URL; ?>default-msg/index">Voltar</a>
</form>