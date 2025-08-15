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
<h2>Cadastre-se!</h2>
<span id="msg"></span>
<form method="POST" action="" autocomplete="off" id="form-register">
    <label>Nome:</label>
    <input type="text" name="name" value="" id="name-register" placeholder="Ex.: Lucas Vinicius" autocomplete="off" ><br><br>

    <label>CPF:</label>
    <input type="text" name="cpf" value="" id='cpf-register' placeholder="XXX.XXX.XXX-XX" autocomplete="off" ><br><br>

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
    <input type="date" name="date_birth" id="date_birth-register" value="" autocomplete="off" ><br><br>

    <label>Telefone:</label>
    <input type="text" name="telephone" value="" id='telephone-register' placeholder="(XX) 9 XXXX-XXXX" autocomplete="off" ><br><br>

    <label>E-mail:</label>
    <input type="email" name="email" value="" id='email-register' placeholder="seu_nome@dominio.com" autocomplete="off" ><br><br>

    <label>Senha:</label>
    <input type="password" name="password" id="pass" value="" placeholder="********" autocomplete="off" ><br><br>

    <label>Confirme:</label>
    <input type="password" value="" id="conf-pass" placeholder="********" autocomplete="off" ><br><br>

    <input type="submit" name="SendRegister" value="Cadastrar"> - <a href="<?php echo URL;?>login/index">Possui ACESSO?</a>
</form>