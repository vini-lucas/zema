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
<h2>Vizualizar Proposta - Mesa</h2>
<table>
    <thead>
        <tr>
            <th>CPF</th>
            <th>Nome Completo</th>
            <th>Data de Nascimento</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1234</td>
            <td>Lucas Vinicius</td>
            <td>06/02/2006</td>
        </tr>
    </tbody>
</table>

<hr>

<h2>Tabela de Parcelas</h2>
<form method="POST">
    <table>
        <thead>
            <tr>
                <th>Nº da PARCELA</th>
                <th>Valor da PARCELA</th>
                <th>Data da PARCELA</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1ª</td>
                <td><input type="text" name="portions_one" placeholder="R$ XXX,XX"></td>
                <td><input type="date" name="date_portions_one"></td>
            </tr>
            <tr>
                <td>2ª</td>
                <td><input type="text" name="portions_two" placeholder="R$ XXX,XX"></td>
                <td><input type="date" name="date_portions_two"></td>
            </tr>
            <tr>
                <td>3ª</td>
                <td><input type="text" name="portions_three" placeholder="R$ XXX,XX"></td>
                <td><input type="date" name="date_portions_three"></td>
            </tr>
            <tr>
                <td>4ª</td>
                <td><input type="text" name="portions_four" placeholder="R$ XXX,XX"></td>
                <td><input type="date" name="date_portions_four"></td>
            </tr>
            <tr>
                <td>5ª</td>
                <td><input type="text" name="portions_five" placeholder="R$ XXX,XX"></td>
                <td><input type="date" name="date_portions_five"></td>
            </tr>
            <tr>
                <td>6ª</td>
                <td><input type="text" name="portions_six" placeholder="R$ XXX,XX"></td>
                <td><input type="date" name="date_portions_six"></td>
            </tr>
            <tr>
                <td>7ª</td>
                <td><input type="text" name="portions_seven" placeholder="R$ XXX,XX"></td>
                <td><input type="date" name="date_portions_seven"></td>
            </tr>
            <tr>
                <td>8ª</td>
                <td><input type="text" name="portions_eight" placeholder="R$ XXX,XX"></td>
                <td><input type="date" name="date_portions_eight"></td>
            </tr>
            <tr>
                <td>9ª</td>
                <td><input type="text" name="portions_nine" placeholder="R$ XXX,XX"></td>
                <td><input type="date" name="date_portions_nine"></td>
            </tr>
            <tr>
                <td>10ª</td>
                <td><input type="text" name="portions_ten" placeholder="R$ XXX,XX"></td>
                <td><input type="date" name="date_portions_ten"></td>
            </tr>
        </tbody>
    </table>
    <label>Observação</label>
    <textarea name="observation" placeholder="Envie uma MSG para o CLIENTE."></textarea>
    <hr>

    <h2>Ações</h2>
    <input type="submit" name="SendProposal" value="Enviar SIMULAÇÃO"> -
    <button>Devolver somente com OBSERVAÇÃO</button> -
    <button name="DelProposal">Cancelar PROPOSTA</button>

    <br><br>

    <button name="PendingAllowBanks">PENDÊNCIA - Autorizar BANCOS</button> -
    <button name="PendingAllowBirh">PENDÊNCIA - Aderir SAQUE-ANIVERSÁRIO</button><br><br>

    <a href="<?php echo URL; ?>fgts/index">Voltar</a>
</form>