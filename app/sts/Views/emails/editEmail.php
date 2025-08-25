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

<h2>Editar E-mail</h2>
<span id='msg'></span>

<a href="<?php echo URL; ?>list-emails/index">E-mails</a><br><br>

<form method="POST" action="" id='form-edit-user' autocomplete="off">
    <input type="hidden" name="id" value="<?php echo $this->data['form'][0]['id']; ?>">
    <input type="hidden" name="modified" value="<?php echo $this->data['form'][0]['modified']; ?>">

    <?php
    $value_title = "";
    if ($this->data['form'][0]['title']) {
        $value_title = $this->data['form'][0]['title'];
    }
    ?>
    <label>Título:</label>
    <input type="text" name="title" id="title" value="<?php echo $value_title; ?>" placeholder="Ex.: Atendimento" autocomplete="off"><br><br>
    
    <?php
    $value_name = "";
    if ($this->data['form'][0]['name']) {
        $value_name = $this->data['form'][0]['name'];
    }
    ?>
    <label>Nome:</label>
    <input type="text" name="name" id="name" value="<?php echo $value_name; ?>" placeholder="Ex.: Atendimento Zema" autocomplete="off"><br><br>

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

    <?php
    $value_host = "";
    if ($this->data['form'][0]['host']) {
        $value_host = $this->data['form'][0]['host'];
    }
    ?>
    <label>Host:</label>
    <input type="text" name="host" id="host" value="<?php echo $value_host; ?>" placeholder="Host do Servidor" autocomplete="off"><br><br>

    <?php
    $value_username = "";
    if ($this->data['form'][0]['username']) {
        $value_username = $this->data['form'][0]['username'];
    }
    ?>
    <label>Usuário:</label>
    <input type="text" name="username" id="username" value="<?php echo $value_username; ?>" placeholder="Usuário do Servidor" autocomplete="off"><br><br>

    <?php
    $value_password = "";
    if ($this->data['form'][0]['password']) {
        $value_password = $this->data['form'][0]['password'];
    }
    ?>
    <label>Senha:</label>
    <input type="text" name="password" id="password" value="<?php echo $value_password; ?>" placeholder="********" autocomplete="off"><br><br>

    <?php
    $value_smtpsecure = "";
    if ($this->data['form'][0]['smtpsecure']) {
        $value_smtpsecure = $this->data['form'][0]['smtpsecure'];
    }
    ?>
    <label>SMTP Secure:</label>
    <input type="text" name="smtpsecure" id="smtpsecure" value="<?php echo $value_smtpsecure; ?>" placeholder="HPMailer::ENCRYPTION" autocomplete="off"><br><br>

    <?php
    $value_port = "";
    if ($this->data['form'][0]['port']) {
        $value_port = $this->data['form'][0]['port'];
    }
    ?>
    <label>Porta:</label>
    <input type="int" name="port" id="port" value="<?php echo $value_port; ?>" placeholder="1919" autocomplete="off"><br><br>

    <input type="submit" name="SendEditEmail" value="Editar">
</form>