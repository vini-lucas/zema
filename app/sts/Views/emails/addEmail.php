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
<h2>Novo E-mail</h2>
<span id="msg"></span>
<form method="POST" action="" autocomplete="off" id="form-register">

    <?php
    $title_value = "";
    if (!empty($title)) {
        $title_value = $title;
    }
    ?>
    <label>Título:</label>
    <input type="text" name="title" id="title" value="<?php echo $title_value; ?>" placeholder="Ex.: Atendimento" autocomplete="off"><br><br>

    <?php
    $name_value = "";
    if (!empty($name)) {
        $name_value = $name;
    }
    ?>
    <label>Nome:</label>
    <input type="text" name="name" id="name" value="<?php echo $name_value; ?>" placeholder="Ex.: Zema Financeira" autocomplete="off"><br><br>

    <input type="hidden" name="created">

    <?php
    $email_value = "";
    if (!empty($email)) {
        $email_value = $email;
    }
    ?>
    <label>E-mail:</label>
    <input type="text" name="email" id="email" value="<?php echo $email_value; ?>" placeholder="seu_nome@dominio.com" autocomplete="off"><br>
    <span id="msg-email"></span><br>

    <?php
    $host_value = "";
    if (!empty($host)) {
        $host_value = $host;
    }
    ?>
    <label>Host:</label>
    <input type="text" name="host" id="host" value="<?php echo $host_value; ?>" placeholder="Host do Servidor" autocomplete="off"><br><br>

    <?php
    $smtpsecure_value = "";
    if (!empty($smtpsecure)) {
        $smtpsecure_value = $smtpsecure;
    }
    ?>
    <label>SMTP Secure:</label>
    <input type="text" name="smtpsecure" id="smtpsecure" value="<?php echo $smtpsecure_value; ?>" placeholder="SMTP Secure do Servidor" autocomplete="off"><br><br>

    <?php
    $port_value = "";
    if (!empty($port)) {
        $port_value = $port;
    }
    ?>
    <label>Porta:</label>
    <input type="int" name="port" id="port" value="<?php echo $port_value; ?>" placeholder="Porta do Servidor" autocomplete="off"><br><br>

    <?php
    $username_value = "";
    if (!empty($username)) {
        $username_value = $username;
    }
    ?>
    <label>Usuário:</label>
    <input type="text" name="username" id="username" value="<?php echo $username_value; ?>" placeholder="Usuário do Servidor" autocomplete="off">
    <br><br>

    <label>Senha:</label>
    <input type="password" name="password" id="password" value="" placeholder="********" autocomplete="off"><i class="fa-solid fa-eye" id="icon-password"></i><br>
    <span id="msg-pass"></span><br>

    <label>Confirme:</label>
    <input type="password" value="" name="conf-pass" id="val-password" placeholder="********" autocomplete="off"><i class="fa-solid fa-eye" id="icon-val-password"></i><br><br>

    <input type="submit" name="SendAddEmail" value="Cadastrar"> - <a href="<?php echo URL; ?>list-emails/index">Voltar</a>
</form>