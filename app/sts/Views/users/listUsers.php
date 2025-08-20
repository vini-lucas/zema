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

<h2>Usuários</h2>

<a href="<?php echo URL . "dashboard/index"; ?>">Dashboard</a> - <a href="<?php echo URL; ?>add-user/index">Novo Usuário</a><br><br>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>CPF</th>
            <th>Nascimento</th>
            <th>Telefone</th>
            <th>E-mail</th>
            <th>Gênero</th>
            <th>Perfil</th>
            <th>Acesso</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($this->data['form'] as $user) {
            extract($user);
        ?>
            <tr>
                <td><?php echo $id; ?></td>
                <td><?php echo $name_user; ?></td>
                <td><?php echo $cpf; ?></td>
                <?php
                $date_birth = date("d/m/Y", strtotime($date_birth));
                ?>
                <td><?php echo $date_birth; ?></td>
                <td><?php echo $telephone; ?></td>
                <td><?php echo $email; ?></td>
                <?php
                if ($gender == "masculine") {
                    $gender = "Masculino";
                } else if ($gender == "feminine") {
                    $gender = "Feminino";
                } else {
                    $gender = "Não Informado";
                }
                ?>
                <td><?php echo $gender; ?></td>
                <?php
                $value_image = "Sem Foto";
                if (!empty($image)) {
                    $value_image = $image;
                }
                ?>
                <td><?php echo $value_image; ?></td>
                <td><?php echo $name_access; ?></td>
                <td><a href="<?php echo URL; ?>edit-user/index/<?php echo $id; ?>">Editar</a> - <a href="<?php echo URL; ?>delete-user/index<?php echo "/$id"; ?>" onclick="return confirm('Deseja realmente apagar este usuário?')" name='drop-user'>Apagar</a></td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>