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
<h2>Mensagens Padrão</h2>
<a href="<?php echo URL; ?>add-msg/index">Adicionar Mensagem</a> - <a href="<?php echo URL; ?>config-site/index">Voltar</a>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Atalho</th>
            <th>Input da Mensagem</th>
            <th>Criado em</th>
            <th>Última modificação</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($this->data['form'] as $msg) {
        ?>
            <form method="POST">
            <?php
            extract($msg);
            echo "<tr>";
            echo "<td><input style='width: 20px'; type='int' name='id' value='$id' readonly></td>";
            echo "<td><input type='text' name='shortcut' placeholder='$shortcut'></td>";
            echo "<td><textarea style='width: 1200px;' type='text' name='msg' placeholder='$msg'></textarea></td>";
            echo "<td><input type='text' name='created' placeholder='$created' disabled></td>";
            echo "<td><input type='text' name='modified' placeholder='$modified' disabled></td>";
            echo "<td><input type='submit' name='SendDefaultMsg' value='Editar'>";
            echo "<td><a href='" . URL . "delete-msg/index/$id' onclick='return confirm(\"Deseja realmente apagar esta mensagem?\")'>Excluir</a></td>";
            echo "</tr>";
            echo "</form>";
        }
            ?>
    </tbody>
</table>

