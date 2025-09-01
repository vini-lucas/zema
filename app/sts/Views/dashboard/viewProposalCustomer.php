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
<h2>Vizualizar Proposta:</h2>
<form method="POST">
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

    <h2>Valor Liberado</h2>
    <p>Valor Liberado: <?php echo 'R$ ' . $value_released; ?></p>

    <table>
        <thead>
            <tr>
                <th>Nº da Parcela</th>
                <th>Valor da Parcela</th>
                <th>Quantidade de Parcela para nova Simulação</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1ª</td>

                <?php
                $value_prime_portion = "";
                if ($prime_portion) {
                    $value_prime_portion = $prime_portion;
                }
                ?>
                <td>
                    <p>R$ <?php echo $value_prime_portion; ?></p>
                </td>
                <td><input type='radio' name='select-portion' value='one'></td>

            </tr>
            <tr>
                <td>2ª</td>

                <?php
                $value_second_portion = "";
                if ($second_portion) {
                    $value_second_portion = $second_portion;
                }
                ?>
                <td>
                    <p>R$ <?php echo $second_portion; ?></p>
                </td>
                <td><input type='radio' name='select-portion' value='two'></td>

            </tr>
            <tr>
                <td>3ª</td>

                <?php
                $value_third_portion = "";
                if ($third_portion) {
                    $value_third_portion = $third_portion;
                }
                ?>
                <td>
                    <p>R$ <?php echo $value_third_portion; ?></p>
                </td>
                <td><input type='radio' name='select-portion' value='three'></td>

            </tr>
            <tr>
                <td>4ª</td>

                <?php
                $value_fourth_portion = "";
                if ($fourth_portion) {
                    $value_fourth_portion = $fourth_portion;
                }
                ?>
                <td>
                    <p>R$ <?php echo $value_fourth_portion; ?></p>
                </td>
                <td><input type='radio' name='select-portion' value='four'></td>

            </tr>
            <tr>
                <td>5ª</td>

                <?php
                $value_fifth_portion = "";
                if ($fifth_portion) {
                    $value_fifth_portion = $fifth_portion;
                }
                ?>
                <td>
                    <p>R$ <?php echo $value_fifth_portion; ?></p>
                </td>
                <td><input type='radio' name='select-portion' value='five'></td>

            </tr>
            <tr>
                <td>6ª</td>
                <?php
                $value_sixth_portion = "";
                if ($sixth_portion) {
                    $value_sixth_portion = $sixth_portion;
                }
                ?>
                <td>
                    <p>R$ <?php echo $value_sixth_portion; ?></p>
                </td>
                <td><input type='radio' name='select-portion' value='six'></td>

            </tr>
            <tr>
                <td>7ª</td>
                <?php
                $value_seventh_portion = "";
                if ($seventh_portion) {
                    $value_seventh_portion = $seventh_portion;
                }
                ?>
                <td>
                    <p>R$ <?php echo $value_seventh_portion; ?></p>
                </td>
                <td><input type='radio' name='select-portion' value='seven'></td>

            </tr>
            <tr>
                <td>8ª</td>
                <?php
                $value_eightth_portion = "";
                if ($eightth_portion) {
                    $value_eightth_portion = $eightth_portion;
                }
                ?>
                <td>
                    <p>R$ <?php echo $value_eightth_portion; ?></p>
                </td>
                <td><input type='radio' name='select-portion' value='eight'></td>

            </tr>
            <tr>
                <td>9ª</td>
                <?php
                $value_nineth_portion = "";
                if ($nineth_portion) {
                    $value_nineth_portion = $nineth_portion;
                }
                ?>
                <td>
                    <p>R$ <?php echo $value_nineth_portion; ?></p>
                </td>
                <td><input type='radio' name='select-portion' value='nine'></td>

            </tr>
            <tr>
                <td>10ª</td>
                <?php
                $value_tenth_portion = "";
                if ($tenth_portion) {
                    $value_tenth_portion = $tenth_portion;
                }
                ?>
                <td>
                    <p>R$ <?php echo $value_tenth_portion; ?></p>
                </td>
                <td><input type='radio' name='select-portion' value='ten'></td>
            </tr>
            <tr>
                <td>Sem nova Simulação</td>
                <td></td>
                <td><input type='radio' name='select-portion' value='no-portion' checked></td>
            </tr>
            <tr>
                <td>Aceitar Valor Liberado</td>
                <td></td>
                <td><input type='radio' name='select-portion' value='value-accept' onclick="return viewInputs();"></td>
            </tr>
        </tbody>
    </table><br>
    <label>Observação:</label>
    <textarea name="observation" placeholder="Mensagem para deixar"></textarea><br><br>

    <div id="view-inputs">
    <label>Gênero:</label><br>
    <label>Masculino</label><input type="radio" name="gender" value="masculine">
    <label>Feminino</label><input type="radio" name="gender" value="feminine"><br><br>

    <label>Nome da Mãe:</label><br>
    <input type="text" name="name_mother" placeholder="Ex.: Márcia Denise" class="mandatory_filling"><br><br>

    <label>Nome do Pai:</label><br>
    <input type="text" name="name_father" placeholder="Ex.: Vinicius Domingues" class="mandatory_filling"><br><br>

    <label>Telefone:</label><br>
    <input type="text" name="telephone" id="telephone" placeholder="(XX) 9 XXXX-XXXX" class="mandatory_filling"><br><br>

    <label>E-mail:</label><br>
    <input type="text" name="eemail" placeholder="seu_nome@dominio.com" class="mandatory_filling"><br><br>

    <label>CEP:</label><br>
    <input type="text" name="cep" placeholder="Ex.: 84.900-000" class="mandatory_filling"><br><br>

    <label>Banco para Recebimento:</label><br>
    <input type="text" name="bank" placeholder="Ex.: 104" class="mandatory_filling"><br><br>

    <label>Nº da Agência:</label><br>
    <input type="text" name="agency" placeholder="Ex.: 1010" class="mandatory_filling"><br><br>

    <label>Nº da Conta:</label><br>
    <input type="text" name="account" placeholder="Ex.: 101010-0" class="mandatory_filling"><br><br>
    </div>

    <input type="submit" name="SendProposal" value="Enviar Proposta"> - <input type="submit" name="DeleteProposal" value="Cancelar Proposta"> - <a href="<?php echo URL; ?>fgts/index">Voltar</a><br>
</form>