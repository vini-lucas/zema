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
<h2>Página FGTS</h2>
<?php
foreach ($this->data['form'] as $pp) {
    extract($pp);
?>
    <table>
        <thead>
            <tr>
                <th>CPF</th>
                <th>Nome</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <?php
                $value_cpf = "";
                if (!empty($cpf)) {
                    $value_cpf = $cpf;
                }
                ?>
                <td><?php echo $value_cpf; ?></td>

                <?php
                $value_name = "";
                if (!empty($name)) {
                    $value_name = $name;
                }
                ?>
                <td><?php echo $value_name; ?></td>
                <?php
                    if (($_SESSION['user_access_level'] == 'Cliente') or ($_SESSION['user_access_level'] == 'Vendedor')) {
                        $address = "view-proposal-customer/index/"; 
                    } else {
                        $address = "view-proposal/index/";
                    }
                ?>
                <td><a href="<?php echo URL . $address . $id; ?>">Atuar</a>
            </tr>
        </tbody>
    <?php
}
    ?>
    </table><br>
    <a href="<?php echo URL; ?>dashboard/index">Dashboard</a> - <a href="<?php echo URL; ?>new-proposal/index">Nova Proposta</a>