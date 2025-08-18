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
if (isset($this->data['form'][0])) {
    extract($this->data['form'][0]);
}
?>

<h2>Editar Nível de Acesso</h2>
<span id='msg'></span>

<a href="<?php echo URL; ?>list-levels-access/index">Níveis de Acesso</a><br><br>

<form method="POST" action="" autocomplete="off" id="form-edit-level-access">
    <input type="hidden" name="id" value="<?php echo $this->data['form'][0]['id']; ?>">
    <input type="hidden" name="modified" value="<?php echo $this->data['form'][0]['modified']; ?>">

    <?php
    $value_name = "";
    if ($this->data['form'][0]['name']) {
        $value_name = $this->data['form'][0]['name'];
    }
    ?>
    <label>Nome:</label>
    <input type="text" name="name" value="<?php echo $value_name; ?>" id="name" placeholder="Ex.: Super Administrador" autocomplete="off"><br><br>

    <input type="submit" name="SendEditLevelAccess" value="Editar">
</form>