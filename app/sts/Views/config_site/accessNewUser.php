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
<h2>Usuário Novo</h2>
<form method="POST">

<label>Nível de Acesso:</label>
<select name="access_level_id">
    <option selected>Selecione:</option>
    <?php
    foreach ($this->data['select'] AS $select) {
        extract($select);
        echo "<option value='$name'>$name</option>";
    }
    ?>
</select><br><br>
<input type="submit" name="SendLevelAccess" value="Editar"> - <a href="<?php echo URL; ?>config-site/index">Voltar</a>
</form>
