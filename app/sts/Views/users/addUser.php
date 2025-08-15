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
<h2>Novo Usuário</h2>
<span id="msg"></span>
<form method="POST" action="" autocomplete="off" id="form-register">
    <label>Nome:</label>
    <input type="text" name="name" value="" placeholder="Ex.: Lucas Vinicius" autocomplete="off" required><br><br>

    <label>CPF:</label>
    <input type="text" name="cpf" value="" placeholder="XXX.XXX.XXX-XX" autocomplete="off" required><br><br>

    <label>Gênero:</label>
    <select name="gender" required>
        <option selected>Selecione:</option>
        <option value="masculine">Masculino</option>
        <option value="feminine">Feminino</option>
        <option value="no_info">Não Informar</option>
    </select><br><br>

    <input type="hidden" name="created">
    <input type="hidden" name="access_level_id">

    <label>Nascimento:</label>
    <input type="date" name="date_birth" value="" autocomplete="off" required><br><br>

    <label>Telefone:</label>
    <input type="text" name="telephone" value="" placeholder="(XX) 9 XXXX-XXXX" autocomplete="off" required><br><br>

    <label>E-mail:</label>
    <input type="email" name="email" value="" placeholder="seu_nome@dominio.com" autocomplete="off" required><br><br>

    <label>Senha:</label>
    <input type="password" name="password" id="pass" value="" placeholder="********" autocomplete="off" required><br><br>

    <label>Confirme:</label>
    <input type="password" value="" id="conf-pass" placeholder="********" autocomplete="off" required><br><br>

    <input type="submit" name="SendAddUser" value="Cadastrar"> - <a href="<?php echo URL;?>list-users/index">Voltar</a>
</form>