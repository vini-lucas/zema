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
<h2>Novo Nível de Acesso</h2>
<span id="msg"></span>
<form method="POST" action="" autocomplete="off" id="form-add-level-access">
    <label>Nome:</label>
    <input type="text" name="name" value="" id='name-add-level-access' placeholder="Ex.: Super Administrador" autocomplete="off" required><br><br>

    <input type="submit" name="SendAddLevelAccess" value="Cadastrar"> - <a href="<?php echo URL;?>list-levels-access/index">Voltar</a>
</form>