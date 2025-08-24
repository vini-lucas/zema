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

<h2>E-mails</h2>

<a href="<?php echo URL . "dashboard/index"; ?>">Dashboard</a> - <a href="<?php echo URL; ?>add-level-access/index">Novo E-mail</a><br><br>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Data Criação</th>
            <th>Última Modificação</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php
        /*foreach ($this->data['form'] as $level_access) {
            extract($level_access);*/
        ?>
            <tr>
                <td><a href="<?php echo URL; ?>edit-level-access/index">Editar</a> - <a href="<?php echo URL; ?>delete-access-level/index" onclick=" return confirm('Deseja realmente apagar este Nível de Acesso?')">Apagar</a></td>
            </tr>
        <?php
        //}
        ?>
    </tbody>
</table>