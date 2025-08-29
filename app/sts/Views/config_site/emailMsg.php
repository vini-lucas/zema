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

if ((isset($_SESSION['msg-helper']))) {
    echo $_SESSION['msg-helper'];
    unset($_SESSION['msg-helper']);
} else if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}
?>
<h2>E-mail do ADM</h2>
<form method="POST">

    <?php
    $value_email = "";
    if (isset($email)) {
        $value_email = $email;
    }
    ?>
    <label>E-mail:</label>
    <input type="text" name="email" value="<?php echo $value_email; ?>" placeholder="seu_nome@dominio.com"><br><br>

    <input type="submit" name="SendEmailMsg" value="Editar"> - <a href="<?php echo URL; ?>config-site/index">Voltar</a>

</form>