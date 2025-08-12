<?php

/**
 * Caso o usuário tente acessar a página sem ser pelo arquivo index, acessa este if.
 */
if (!defined('L4bar3tTA!')) {
    header("Location: /");
}

if (isset($this->data['form'][0])) {
    extract($this->data['form'][0]);
}

if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}
?>

<h2>Usuários</h2>

<table>
    <tr>
        <?php
        foreach ($this->data['form'][0] as $user) {
            echo "<th>";
            echo "ID: $id.<br>";
            echo "Nome: $name.<br>";
            echo "CPF: $cpf.<br>";
            echo "Nascimento: $date_birth.<br>";
            echo "Telefone: $telephone.<br>";
            echo "E-mail: $email.<br>";
            echo "Gênero: $gender.<br>";
            echo "Perfil: $image.<br>";
            echo "Acesso: $access_level_id .<br>";
            echo "</th>";
        }
        ?>
    </tr>
</table>