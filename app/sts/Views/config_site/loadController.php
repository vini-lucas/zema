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
<h2>Carregar Controller</h2>
<form method="POST">
    <label>Controller:</label>
    <select name="controller">
        <?php
        foreach ($this->data['select'] as $select) {
            extract($select);
            echo "<option value='$controller'>$controller</option>";
        }
        ?>
    </select>
    <p>Controller Ativa: <?php echo $this->data['form'][0]['controller']; ?></p>

    <input type="submit" name="SendController" value="Editar"> - <a href="<?php echo URL; ?>config-site/index">Voltar</a>
</form>