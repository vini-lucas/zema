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
<hr>

<form method="POST">
    <label>Observação:</label><br>
    <textarea name="observation" placeholder="Deixe uma MSG para a MESA!"></textarea><br>
    <input type="submit" name="ppDel" value="Operação REPROVADA!"> - <input type="submit" name="ppSuccess" value="Operação PAGA!"><br>
    <a href="<?php echo URL; ?>fgts/index">Voltar</a>
</form>