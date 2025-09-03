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
<h2>Dados da PROPOSTA</h2>
<p>Preencha os dados complementares da OPERAÇÃO para enviá-la à DIGITAÇÃO!</p>

<form method="POST" action="<?php echo URL; ?>view-proposal-customer/index/">

    <label>Gênero:</label>
    <select name="gender">
        <option selected>Selecione</option>
        <option name="masculine">Masculino</option>
        <option name="feminine">Feminino</option>
    </select><br><br>

    <label>Nome da MÃE:</label>
    <input type="text" name="name_mother" placeholder="Nome COMPLETO da MÃE"><br><br>

    <label>Nome do PAI:</label>
    <input type="text" name="name_mother" placeholder="Nome COMPLETO do PAI">
    <label>Não consta no DOCUMENTO</label>
    <input type="checkbox" id="no_father"><br><br>

    <label>Telefone:</label>
    <input type="text" id="telephone" name="telephone" placeholder="(XX) 9 XXXX-XXXX"><br><br>

    <label>E-mail:</label>
    <input type="text" id="email" name="email" placeholder="exemplo@dominio.com"><br><br>

    <label>CEP:</label>
    <input type="text" name="cep" placeholder="CEP de sua CIDADE"><br><br>

    <label>Logradouro:</label>
    <textarea name="address" placeholder="Sua RUA, BAIRRO ou AVENIDA e Nº da CASA"></textarea><br><br>

    <label>Banco para RECEBIMENTO:</label>
    <input type="text" name="bank" placeholder="Ex.: Caixa Econômica"><br><br>

    <label>Agência:</label>
    <input type="text" name="agency" placeholder="Ex: 3880"><br><br>

    <label>Número da CONTA:</label>
    <input type="text" name="account" placeholder="Ex.: 1234-5"><br><br>

    <input type="submit" name="SendDataPp" value="Enviar PROPOSTA"> <a href="<?php echo URL; ?>view-proposal-customer/index/">Voltar</a>

</form>