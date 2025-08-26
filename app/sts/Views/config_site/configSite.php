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
<a href="<?php echo URL; ?>info-database/index">Informações do Banco de Dados</a> - <a href="#">Informações de Páginas Públicas/Privadas</a> - <a href="#">Informações de Mensagens Padrão</a> - <a href="#">Demais Informações</a><br><br>
<a href="<?php echo URL; ?>dashboard/index">Voltar</a>
