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
<h2>Nova Cor</h2>
<span id="msg"></span>
<form method="POST" action="" autocomplete="off" id="form-register">

    <?php
    $name_value = "";
    if (!empty($name)) {
        $name_value = $name;
    }
    ?>
    <label>Nome:</label>
    <input type="text" name="name" id="name" value="<?php echo $name_value; ?>" placeholder="Ex.: Primária do Footer" autocomplete="off"><br><br>

    <input type="hidden" name="created">

    <?php
    $color_value = "";
    if (!empty($color)) {
        $color_value = $color;
    }
    ?>
    <label>Cor:</label>
    <input type="text" name="color" id="color" value="<?php echo $color_value; ?>" placeholder="#f000" autocomplete="off"><br><br>

    <input type="submit" name="SendAddColor" value="Cadastrar"> - <a href="<?php echo URL; ?>list-colors/index">Voltar</a>
</form>