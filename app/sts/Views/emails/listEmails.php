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
            <th>Título</th>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Host</th>
            <th>Usuário</th>
            <th>Senha</th>
            <th>SMTP Secure</th>
            <th>Porta</th>
            <th>Data Criação</th>
            <th>Última Modificação</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($this->data['form'] as $email) {
            extract($email);
        ?>
            <tr>
                <td><?php echo $id; ?></td>
                <td><?php echo $title; ?></td>
                <td><?php echo $name; ?></td>
                <td><?php echo $email; ?></td>
                <td><?php echo $host; ?></td>
                <td><?php echo $username; ?></td>
                <td><?php echo $password; ?></td>
                <td><?php echo $smtpsecure; ?></td>
                <td><?php echo $port; ?></td>
                <td><?php echo $created; ?></td>
                <td><?php echo $modified; ?></td>
                <td><a href="<?php echo URL; ?>edit-email/index/<?php echo $id; ?>">Editar</a> - <a href="<?php echo URL; ?>delete-email/index?id=<?php echo $id; ?>" onclick=" return confirm('Deseja realmente apagar este E-mail?')">Apagar</a></td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>