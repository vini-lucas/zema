    <h1>Conecte-se!</h1>
    <form>
        <label>CPF:</label>
        <input type="text" name="cpf" placeholder="XXX.XXX.XXX-XX" required>

        <label>Senha:</label>
        <input type="password" name="password" placeholder="**************" required>

        <input type="submit" name="SendLogin">
    </form>
<?php
var_dump($this->data);