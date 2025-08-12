<?php

/**
 * Caso o usuário tente acessar a página sem ser pelo arquivo index, acessa este if.
 */
if (!defined('L4bar3tTA!')) {
    header("Location: /");
}

if (isset($this->data['form'][0])) {
    extract($this->data['form'][0]);
}

if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}
?>

<h2>Editar Usuário</h2>

<form method="POST" action="">
    <?php
    $value_name = "";
    if ($this->data['form'][0]) {
        $value_name = $this->data['form'][0]['name'];
    }
    ?>
    <label>Nome:</label>
    <input type="text" name="name" value="<?php echo $value_name; ?>" placeholder="Ex.: Lucas Vinicius" autocomplete="off" required><br><br>

    <?php
    $value_cpf = "";
    if ($this->data['form'][0]['cpf']) {
        $value_cpf = $this->data['form'][0]['cpf'];
    }
    ?>
    <label>CPF:</label>
    <input type="text" name="cpf" value="<?php echo $value_cpf; ?>" placeholder="XXX.XXX.XXX-XX" autocomplete="off" required><br><br>

    <label>Gênero:</label>
    <select name="gender">
        <option selected>Selecione:</option>
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
            }
        ?>        
    </select><br><br>

    <input type="hidden" name="modified">
    <input type="hidden" name="access_level_id">

    <?php
    $value_birth = "";
    if ($this->data['form'][0]['date_birth']) {
        $value_birth = $this->data['form'][0]['date_birth'];
    }
    ?>
    <label>Nascimento:</label>
    <input type="date" name="date_birth" value="<?php echo $value_birth; ?>" autocomplete="off" required><br><br>

    <?php
    $value_tel = "";
    if ($this->data['form'][0]['telephone']) {
        $value_tel = $this->data['form'][0]['telephone'];
    }
    ?>
    <label>Telefone:</label>
    <input type="text" name="telephone" value="<?php echo $value_tel; ?>" placeholder="(XX) 9 XXXX-XXXX" autocomplete="off" required><br><br>

    <?php
    $value_email = "";
    if ($this->data['form'][0]['email']) {
        $value_email = $this->data['form'][0]['email'];
    }
    ?>
    <label>E-mail:</label>
    <input type="email" name="email" value="<?php echo $value_email; ?>" placeholder="seu_nome@dominio.com" autocomplete="off" required><br><br>

    <input type="submit" name="SendEditUser" value="Editar"> <a href="#">Editar Senha</a> - <a href="<?php echo URL; ?>list-users/index">Usuários</a>
</form>

