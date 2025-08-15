<?php

namespace Sts\Models\helper;

/**
 * Caso o usuário tente acessar a página sem ser pelo arquivo index, acessa este if.
 */
if (!defined('L4bar3tTA!')) {
    header("Location: /");
}

/**
 * Helper responsável em verificar se os campos foram preenchidos.
 */
class ValInputField
{
    private bool $result; // -> Recebe o resultado da QUERY.
    private array|string $data = []; // -> Recebe os inputs que serão validados por este helper.

    /**
     * Recebe true se preencheu com sucesso ou false se não preencheu.
     * @return boolean
     */
    public function getResult(): bool
    {
        return $this->result;
    }

    public function valInputField(array|string $data)
    {
        $this->data = $data;
        $this->data = array_map('strip_tags', $this->data);
        $this->data = array_map('trim', $this->data);

        if (in_array('', $this->data)) {
            $_SESSION['msg'] = "<p style='color: red;'>Preencha todos os campos!</p>";
            $this->result = false;
        } else {
            $this->result = true;
        }
    }
}
