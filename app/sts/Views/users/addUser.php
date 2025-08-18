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

if ((isset($_SESSION['msg'])) and (isset($_SESSION['msg-helper']))) {
    echo $_SESSION['msg-helper'];
    unset($_SESSION['msg-helper']);
} else if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}
?>
<h2>Novo Usuário</h2>
<span id="msg"></span>
<form method="POST" action="" autocomplete="off" id="form-register">

    <?php
    $name_value = "";
    if (!empty($name)) {
        $name_value = $name;
    }
    ?>
    <label>Nome:</label>
    <input type="text" name="name" id="name-register" value="<?php echo $name_value; ?>" placeholder="Ex.: Lucas Vinicius" autocomplete="off"><br><br>

    <?php
    $cpf_value = "";
    if (!empty($cpf)) {
        $cpf_value = $cpf;
    }
    ?>
    <label>CPF:</label>
    <input type="text" name="cpf" id="cpf-register" value="<?php echo $cpf_value; ?>" placeholder="XXX.XXX.XXX-XX" autocomplete="off"><br><br>

    <label>Gênero:</label>
    <select name="gender" id="gender-register">
        <?php
        if ($gender == 'masculine') {
            echo "<option>Selecione:</option>";
            echo "<option selected value='masculine'>Masculino</option>";
            echo "<option value='feminine'>Feminino</option>";
            echo "<option value='no_info'>Não Informar</option>";
        } else if ($gender == 'feminine') {
            echo "<option>Selecione:</option>";
            echo "<option value='masculine'>Masculino</option>";
            echo "<option selected value='feminine'>Feminino</option>";
            echo "<option value='no_info'>Não Informar</option>";
        } else if ($gender == 'no_info') {
            echo "<option>Selecione:</option>";
            echo "<option value='masculine'>Masculino</option>";
            echo "<option value='feminine'>Feminino</option>";
            echo "<option selected value='no_info'>Não Informar</option>";
        } else {
        ?>
            <option>Selecione:</option>
            <option value="masculine">Masculino</option>
            <option value="feminine">Feminino</option>
            <option value="no_info">Não Informar</option>
        <?php
        };
        ?>
    </select><br><br>

    <input type="hidden" name="created">
    <input type="hidden" name="access_level_id">

    <?php
    $date_birth_value = "";
    if (!empty($date_birth)) {
        $date_birth_value = $date_birth;
    }
    ?>
    <label>Nascimento:</label>
    <input type="date" name="date_birth" id="date_birth-register" value="<?php echo $date_birth_value; ?>" autocomplete="off"><br><br>

    <?php
    $telephone_value = "";
    if (!empty($telephone)) {
        $telephone_value = $telephone;
    }
    ?>
    <label>Telefone:</label>
    <input type="text" name="telephone" id="telephone-register" value="<?php echo $telephone_value; ?>" placeholder="(XX) 9 XXXX-XXXX" autocomplete="off"><br><br>

    <?php
    $email_value = "";
    if (!empty($email)) {
        $email_value = $email;
    }
    ?>
    <label>E-mail:</label>
    <input type="email" name="email" id="email-register" value="<?php echo $email_value; ?>" placeholder="seu_nome@dominio.com" autocomplete="off"><br><br>

    <label>Senha:</label>
    <input type="password" name="password" id="pass" value="" placeholder="********" autocomplete="off"><br>
    <span id="msg-pass"></span><br>

    <label>Confirme:</label>
    <input type="password" value="" name="conf-pass" id="conf-pass" placeholder="********" autocomplete="off"><br><br>

    <input type="submit" name="SendAddUser" value="Cadastrar"> - <a href="<?php echo URL; ?>list-users/index">Voltar</a>
</form>