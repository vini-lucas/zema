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
            <td><?php echo $this->data['portion'][0]['cpf']; ?></td>
            <td><?php echo $this->data['portion'][0]['name']; ?></td>
            <td><?php echo $this->data['portion'][0]['date_birth']; ?></td>
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
                <?php
                $value_one = "";
                if (!empty($portions_one)) {
                    $value_one = $portions_one;
                }
                $value_date_one = "";
                if (!empty($date_portions_one)) {
                    $value_date_one = $date_portions_one;
                }
                ?>
                <td><input type="text" name="portions_one" value="<?php echo $value_one; ?>" placeholder="R$ XXX,XX"></td>
                <td><input type="date" name="date_portions_one" value="<?php echo $value_date_one; ?>"></td>
            </tr>
            <tr>
                <td>2ª</td>
                <?php
                $value_two = "";
                if (!empty($portions_two)) {
                    $value_two = $portions_two;
                }
                $value_date_two = "";
                if (!empty($date_portions_two)) {
                    $value_date_two = $date_portions_two;
                }
                ?>
                <td><input type="text" name="portions_two" value="<?php echo $value_two; ?>" placeholder="R$ XXX,XX"></td>
                <td><input type="date" name="date_portions_two" value="<?php echo $value_date_two; ?>" ></td>
            </tr>
            <tr>
                <td>3ª</td>
                <?php
                $value_three = "";
                if (!empty($portions_three)) {
                    $value_three = $portions_three;
                }
                $value_date_three = "";
                if (!empty($date_portions_three)) {
                    $value_date_three = $date_portions_three;
                }
                ?>
                <td><input type="text" name="portions_three" value="<?php echo $value_three; ?>" placeholder="R$ XXX,XX"></td>
                <td><input type="date" name="date_portions_three" value="<?php echo $value_date_three; ?>" ></td>
            </tr>
            <tr>
                <td>4ª</td>
                <?php
                $value_four = "";
                if (!empty($portions_four)) {
                    $value_four = $portions_four;
                }
                $value_date_four = "";
                if (!empty($date_portions_four)) {
                    $value_date_four = $date_portions_four;
                }
                ?>
                <td><input type="text" name="portions_four" placeholder="R$ XXX,XX" value="<?php echo $value_four; ?>" ></td>
                <td><input type="date" name="date_portions_four" value="<?php echo $value_date_four; ?>" ></td>
            </tr>
            <tr>
                <td>5ª</td>
                <?php
                $value_five = "";
                if (!empty($portions_five)) {
                    $value_five = $portions_five;
                }
                $value_date_five = "";
                if (!empty($date_portions_five)) {
                    $value_date_five = $date_portions_five;
                }
                ?>
                <td><input type="text" name="portions_five" placeholder="R$ XXX,XX" value="<?php echo $value_five; ?>" ></td>
                <td><input type="date" name="date_portions_five" value="<?php echo $value_date_five; ?>" ></td>
            </tr>
            <tr>
                <td>6ª</td>
                <?php
                $value_six = "";
                if (!empty($portions_six)) {
                    $value_six = $portions_six;
                }
                $value_date_six = "";
                if (!empty($date_portions_six)) {
                    $value_date_six = $date_portions_six;
                }
                ?>
                <td><input type="text" name="portions_six" placeholder="R$ XXX,XX" value="<?php echo $value_six; ?>" ></td>
                <td><input type="date" name="date_portions_six" value="<?php echo $value_date_six; ?>" ></td>
            </tr>
            <tr>
                <td>7ª</td>
                <?php
                $value_seven = "";
                if (!empty($portions_seven)) {
                    $value_seven = $portions_seven;
                }
                $value_date_seven = "";
                if (!empty($date_portions_seven)) {
                    $value_date_seven = $date_portions_seven;
                }
                ?>
                <td><input type="text" name="portions_seven" placeholder="R$ XXX,XX" value="<?php echo $value_seven; ?>" ></td>
                <td><input type="date" name="date_portions_seven" value="<?php echo $value_date_seven; ?>" ></td>
            </tr>
            <tr>
                <td>8ª</td>
                <?php
                $value_eight = "";
                if (!empty($portions_eight)) {
                    $value_eight = $portions_eight;
                }
                $value_date_eight = "";
                if (!empty($date_portions_eight)) {
                    $value_date_eight = $date_portions_eight;
                }
                ?>
                <td><input type="text" name="portions_eight" placeholder="R$ XXX,XX" value="<?php echo $value_eight; ?>" ></td>
                <td><input type="date" name="date_portions_eight" value="<?php echo $value_date_eight; ?>" ></td>
            </tr>
            <tr>
                <td>9ª</td>
                <?php
                $value_nine = "";
                if (!empty($portions_nine)) {
                    $value_nine = $portions_nine;
                }
                $value_date_nine = "";
                if (!empty($date_portions_nine)) {
                    $value_date_nine = $date_portions_nine;
                }
                ?>
                <td><input type="text" name="portions_nine" placeholder="R$ XXX,XX" value="<?php echo $value_nine; ?>" ></td>
                <td><input type="date" name="date_portions_nine" value="<?php echo $value_date_nine; ?>" ></td>
            </tr>
            <tr>
                <td>10ª</td>
                <?php
                $value_ten = "";
                if (!empty($portions_ten)) {
                    $value_ten = $portions_ten;
                }
                $value_date_ten = "";
                if (!empty($date_portions_ten)) {
                    $value_date_ten = $date_portions_ten;
                }
                ?>
                <td><input type="text" name="portions_ten" placeholder="R$ XXX,XX" value="<?php echo $value_ten; ?>" ></td>
                <td><input type="date" name="date_portions_ten" value="<?php echo $value_date_ten; ?>" ></td>
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