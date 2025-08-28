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

if ((isset($_SESSION['msg-helper']))) {
    echo $_SESSION['msg-helper'];
    unset($_SESSION['msg-helper']);
} else if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}
?>
<h2>Configurações do Site</h2>
<a href="<?php echo URL; ?>pages-public-and-priv/index">Informações de Páginas Públicas/Privadas</a> - <a href="<?php echo URL; ?>default-msg/index">Informações de Mensagens Padrão</a> - <a href="<?php echo URL; ?>access-new-user/index">Acesso de Novo Usuário</a><br><br>
<a href="<?php echo URL; ?>dashboard/index">Voltar</a>
