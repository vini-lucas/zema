<?php

/**
 * Caso o usuário tente acessar a página sem ser pelo arquivo index, acessa este if.
 */
if (!defined('L4bar3tTA!')) {
    header("Location: /");
}
if ((isset($_SESSION['msg-helper']))) {
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

<h2>Editar Usuário</h2>
<span id='msg'></span>

<a href="<?php echo URL; ?>list-users/index">Usuários</a><br><br>

<form method="POST" action="" id='form-edit-user' autocomplete="off">
    <input type="hidden" name="id" value="<?php echo $this->data['form'][0]['id']; ?>">
    <input type="hidden" name="modified" value="<?php echo $this->data['form'][0]['modified']; ?>">

    <?php
    $value_name = "";
    if ($this->data['form'][0]['name']) {
        $value_name = $this->data['form'][0]['name'];
    }
    ?>
    <label>Nome:</label>
    <input type="text" name="name" id="name" value="<?php echo $value_name; ?>" placeholder="Ex.: Lucas Vinicius" autocomplete="off"><br><br>

    <label>Gênero:</label>
    <select name="gender" id="gender">
        <option>Selecione:</option>
        <?php
        if ($this->data['form'][0]['gender'] == 'masculine') {
            echo '<option selected value="masculine">Masculino</option>';
            echo '<option value="feminine">Feminino</option>';
            echo '<option value="no_info">Não Informar</option>';
        } else if ($this->data['form'][0]['gender'] == 'feminine') {
            echo '<option selected value="feminine">Feminino</option>';
            echo '<option value="no_info">Não Informar</option>';
            echo '<option value="masculine">Masculino</option>';
        } else if ($this->data['form'][0]['gender'] == 'no_info') {
            echo '<option selected value="no_info">Não Informar</option>';
            echo '<option value="masculine">Masculino</option>';
            echo '<option value="feminine">Feminino</option>';
        } else {
            echo '<option value="masculine">Masculino</option>';
            echo '<option value="feminine">Feminino</option>';
            echo '<option value="no_info">Não Informar</option>';
        }
        ?>
    </select><br><br>

    <?php
    $value_birth = "";
    if ($this->data['form'][0]['date_birth']) {
        $value_birth = $this->data['form'][0]['date_birth'];
    }
    ?>
    <label>Nascimento:</label>
    <input type="date" name="date_birth" id="date_birth" value="<?php echo $value_birth; ?>" autocomplete="off"><br><br>

    <?php
    $value_tel = "";
    if ($this->data['form'][0]['telephone']) {
        $value_tel = $this->data['form'][0]['telephone'];
    }
    ?>
    <label>Telefone:</label>
    <input type="text" name="telephone" id="telephone" value="<?php echo $value_tel; ?>" placeholder="(XX) 9 XXXX-XXXX" maxlength="16" autocomplete="off"><br><br>

    <?php
    $value_email = "";
    if ($this->data['form'][0]['email']) {
        $value_email = $this->data['form'][0]['email'];
    }
    ?>
    <label>E-mail:</label>
    <input type="text" name="email" id="email" value="<?php echo $value_email; ?>" placeholder="seu_nome@dominio.com" autocomplete="off">
    <span id="msg-email"></span>
    <br><br>

    <input type="submit" name="SendEditUser" value="Editar"> <a href="<?php echo URL . "edit-password/index/{$this->data['form'][0]['id']}"; ?>">Editar Senha</a>
</form>