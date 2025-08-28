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
<h2>Páginas Públicas e Privadas</h2>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Controller</th>
            <th>Página</th>
            <th>Criado em</th>
            <th>Última modificação</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($this->data['form'] as $pages) {
        ?>
            <form method="POST">
            <?php
            extract($pages);
            echo "<tr>";
            echo "<td><input type='int' name='id' value='$id' readonly></td>";
            echo "<td><input type='text' name='controller' placeholder='$controller'><button>Utilizá-lo</button></td>";
            if ($public == 1) {
                echo "<td><input type='radio' name='public' value='1' checked>";
                echo "<label>Pública</label>";
                echo "<input type='radio' name='public' value='0'>";
                echo "<label>Privada</label></td>";
            } else {
                echo "<td><input type='radio' name='public' value='1'>";
                echo "<label>Pública</label>";
                echo "<input type='radio' name='public' value='0' checked>";
                echo "<label>Privada</label></td>";
            }
            echo "<td><input type='text' name='created' placeholder='$created' disabled></td>";
            echo "<td><input type='text' name='modified' placeholder='$modified' disabled></td>";
            echo "<td><input type='submit' name='SendPages' value='Editar'>";
            echo "<td><a href='" . URL . "delete-controller/index/$id' onclick='return confirm(\"Deseja realmente apagar esta controller?\")'>Excluir</a></td>";
            echo "</tr>";
            echo "</form>";
        }
            ?>
    </tbody>
</table>
<a href="<?php echo URL; ?>add-controller/index">Adicionar Controller</a> - <a href="<?php echo URL; ?>config-site/index">Voltar</a>
