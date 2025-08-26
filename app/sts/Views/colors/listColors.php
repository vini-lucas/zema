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

<h2>Cores</h2>

<a href="<?php echo URL . "dashboard/index"; ?>">Dashboard</a> - <a href="<?php echo URL; ?>add-color/index">Nova cor</a><br><br>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Cor</th>
            <th>Data Criação</th>
            <th>Última Modificação</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($this->data['form'] as $colors) {
            extract($colors);
        ?>
            <tr>
                <td style='background-color: <?php echo $color; ?>'><?php echo $id; ?></td>
                <td style='background-color: <?php echo $color; ?>'><?php echo $name; ?></td>
                <td style='background-color: <?php echo $color; ?>'><?php echo $color; ?></td>
                <td style='background-color: <?php echo $color; ?>'><?php echo $created; ?></td>
                <td style='background-color: <?php echo $color; ?>'><?php echo $modified; ?></td>
                <td><a href="<?php echo URL; ?>edit-color/index/<?php echo $id; ?>">Editar</a> - <a href="<?php echo URL; ?>delete-color/index/<?php echo $id; ?>" onclick=" return confirm('Deseja realmente apagar esta cor?')">Apagar</a></td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>