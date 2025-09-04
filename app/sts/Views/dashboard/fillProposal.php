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

<form method="POST" action="">

    <label>Gênero:</label>
    <select name="gender">
        <option selected>Selecione</option>
        <option value="masculine">Masculino</option>
        <option value="feminine">Feminino</option>
    </select><br><br>

    <?php
    $value_mother = "";
    if (isset($this->data['form']['name_mother'])) {
        $value_mother = $this->data['form']['name_mother'];
    }
    ?>
    <label>Nome da MÃE:</label>
    <input type="text" name="name_mother" value="<?php echo $value_mother; ?>" placeholder="Nome COMPLETO da MÃE"><br><br>

    <?php
    $value_father = "";
    if (isset($this->data['form']['name_father'])) {
        $value_father = $this->data['form']['name_father'];
    }
    ?>
    <label>Nome do PAI:</label>
    <input type="text" name="name_father" value="<?php echo $value_father; ?>" placeholder="Nome COMPLETO do PAI">

    <label>Não consta no DOCUMENTO</label>
    <input type="checkbox" id="no_father"><br><br>

    <?php
    $value_telephone = "";
    if (isset($this->data['form']['telephone'])) {
        $value_telephone = $this->data['form']['telephone'];
    }
    ?>
    <label>Telefone:</label>
    <input type="text" id="telephone" name="telephone" value="<?php echo $value_telephone; ?>" placeholder="(XX) 9 XXXX-XXXX"><br><br>

    <?php
    $value_email = "";
    if (isset($this->data['form']['email'])) {
        $value_email = $this->data['form']['email'];
    }
    ?>
    <label>E-mail:</label>
    <input type="text" id="email" name="email" value="<?php echo $value_email; ?>" placeholder="exemplo@dominio.com"><br><br>

    <?php
    $value_cep = "";
    if (isset($this->data['form']['cep'])) {
        $value_cep = $this->data['form']['cep'];
    }
    ?>
    <label>CEP:</label>
    <input type="text" name="cep" value="<?php echo $value_cep; ?>" placeholder="CEP de sua CIDADE"><br><br>

    <?php
    $value_address = "";
    if (isset($this->data['form']['address'])) {
        $value_address = $this->data['form']['address'];
    }
    ?>
    <label>Logradouro:</label>
    <textarea name="address" placeholder="Sua RUA, BAIRRO ou AVENIDA e Nº da CASA"><?php echo $value_address; ?></textarea><br><br>

    <?php
    $value_bank = "";
    if (isset($this->data['form']['bank'])) {
        $value_bank = $this->data['form']['bank'];
    }
    ?>
    <label>Banco para RECEBIMENTO:</label>
    <input type="text" name="bank" value="<?php echo $value_bank; ?>" placeholder="Ex.: Caixa Econômica"><br><br>

    <?php
    $value_agency = "";
    if (isset($this->data['form']['agency'])) {
        $value_agency = $this->data['form']['agency'];
    }
    ?>
    <label>Agência:</label>
    <input type="text" name="agency" value="<?php echo $value_agency; ?>" placeholder="Ex: 3880"><br><br>

    <?php
    $value_account = "";
    if (isset($this->data['form']['account'])) {
        $value_account = $this->data['form']['account'];
    }
    ?>
    <label>Número da CONTA:</label>
    <input type="text" name="account" value="<?php echo $value_account; ?>" placeholder="Ex.: 1234-5"><br><br>

    <input type="submit" name="SendDataPp" value="Enviar PROPOSTA"> - <a href="<?php echo URL; ?>view-proposal-customer/index/<?php echo $this->data['id']; ?>">Voltar</a>

</form>