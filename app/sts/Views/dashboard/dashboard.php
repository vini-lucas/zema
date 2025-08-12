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
    unset ($_SESSION['msg']);
}
?>
<h2>Página Dashboard</h2>
<?php
echo "Olá, {$_SESSION['user_name']}!<br>";
echo "<a href='" . URL . "list-users/index'>Usuários</a> - <a href='". URL ."logout/index'>Sair</a>";


