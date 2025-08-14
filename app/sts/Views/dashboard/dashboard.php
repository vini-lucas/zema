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
<h2>Página Dashboard</h2>
<?php
if (is_array($_SESSION['user_name'])) {
    $_SESSION['user_name'][0] = ucwords($_SESSION['user_name'][0]);
    echo "Olá, {$_SESSION['user_name'][0]}!<br>";
} else {
    if ((strpos($_SESSION['user_name'], ' ') == true)) {
        $_SESSION['user_name'] = explode(' ', $_SESSION['user_name']);
        $_SESSION['user_name'][0] = ucwords($_SESSION['user_name'][0]);
        echo "Olá, {$_SESSION['user_name'][0]}!<br>";
    } else {
        $_SESSION['user_name'] = ucwords($_SESSION['user_name']);
        echo "Olá, {$_SESSION['user_name']}!<br>";
    }
}
echo "<a href='" . URL . "list-users/index'>Usuários</a><br><br>";
echo "<a href='" . URL . "logout/index'>Sair</a>";
