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

if ((isset($_SESSION['msg-helper']))) {
    echo $_SESSION['msg-helper'];
    unset($_SESSION['msg-helper']);
} else if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}
?>
<h2>Dados do Cliente:</h2>
<table>
    <thead>
        <tr>
            <th>CPF:</th>
            <th>Nome:</th>
            <th>Nascimento:</th>
        </tr>
        <tbody>
            <tr>
                <td><?php echo $cpf; ?></td>
                <td><?php echo $name; ?></td>
                <td><?php echo $date_birth; ?></td>
            </tr>
        </tbody>
    </thead>
</table>

<h2>Valor liberado ao Cliente:</h2>
<form method="POST">

    <label>Valor Liberado:</label>
    <input type="text" name="value_released" value="" placeholder="Ex.: R$250,00"><br><br>

    <table>
        <thead>
            <tr>
                <th>Nº da Parcela</th>
                <th>Valor da Parcela</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1ª</td>
                <td><input type="text" name="prime_portion" placeholder="Ex.: R$ XXX,XX"></td>
            </tr>
            <tr>
                <td>2ª</td>
                <td><input type="text" name="second_portion" placeholder="Ex.: R$ XXX,XX"></td>
            </tr>
            <tr>
                <td>3ª</td>
                <td><input type="text" name="third_portion" placeholder="Ex.: R$ XXX,XX"></td>
            </tr>
            <tr>
                <td>4ª</td>
                <td><input type="text" name="fourth_portion" placeholder="Ex.: R$ XXX,XX"></td>
            </tr>
            <tr>
                <td>5ª</td>
                <td><input type="text" name="fifth_portion" placeholder="Ex.: R$ XXX,XX"></td>
            </tr>
            <tr>
                <td>6ª</td>
                <td><input type="text" name="sixth_portion" placeholder="Ex.: R$ XXX,XX"></td>
            </tr>
            <tr>
                <td>7ª</td>
                <td><input type="text" name="seventh_portion" placeholder="Ex.: R$ XXX,XX"></td>
            </tr>
            <tr>
                <td>8ª</td>
                <td><input type="text" name="eightth_portion" placeholder="Ex.: R$ XXX,XX"></td>
            </tr>
            <tr>
                <td>9ª</td>
                <td><input type="text" name="nineth_portion" placeholder="Ex.: R$ XXX,XX"></td>
            </tr>
            <tr>
                <td>10ª</td>
                <td><input type="text" name="tenth_portion" placeholder="Ex.: R$ XXX,XX"></td>
            </tr>
        </tbody>
    </table><br>
    <label>Observação:</label>
    <textarea name="observation" placeholder="Mensagem para deixar"></textarea><br><br>

    <input type="submit" name="SendProposal" value="Enviar Proposta"> - <input type="submit" name="DeleteProposal" value="Cancelar Proposta"> - <a href="<?php echo URL; ?>fgts/index">Voltar</a><br>
</form>

