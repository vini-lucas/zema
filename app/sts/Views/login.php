<?php
if (isset($this->data)) {
    extract($this->data);
}
?>
<h2>Conecte-se!</h2>
<form>
    <label>CPF:</label>
    <input type="text" name="cpf" placeholder="XXX.XXX.XXX-XX" required>

    <label>Senha:</label>
    <input type="password" name="password" placeholder="**************" required>

    <input type="submit" name="SendLogin">
</form>

<h2>Cadastre-se!</h2>
<form>
    <label>CPF:</label>
    <input type="text" name="cpf" placeholder="XXX.XXX.XXX-XX" required>

    <label>Nome Completo:</label>
    <input type="password" name="name" placeholder="Nome Completo" required>

    <label>Data de Nascimento:</label>
    <input type="date" name="date_birth" required>

    <label>Gênero</label>
    <input type="text" name="gender">

    <label>E-mail</label>
    <input type="text" name="email" placeholder="exemplo@dominio.com" required>

    <label>Telefone</label>
    <input type="text" name="telephone" placeholder="(XX) 9 XXXX-XXXX" required>

    <label>Senha:</label>
    <input type="password" name="password" placeholder="**************" required>

    <label>Confirme a Senha:</label>
    <input type="password" placeholder="**************" required>

    <input type="submit" name="SendLogin">
</form>