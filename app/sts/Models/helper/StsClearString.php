<?php

namespace Sts\Models\helper;

/**
 * Caso o usuário tente acessar a página sem ser pelo arquivo index, acessa este if.
 */
if (!defined('L4bar3tTA!')) {
    header("Location: /");
}

/**
 * Helper responsável em limpar as string que forem enviadas à ele.
 */
class StsClearString
{
    private string $data = ""; // -> Recebe os inputs que serão validados por este helper.

    public function exeClear(array|string $data): string
    {
        $this->data = $data;
        $this->data = preg_replace('/[^[:alnum:]\p{L}]/u', '', $this->data); // -> Regex para PHP, remove tudo que não é letra ou número.
        return $this->data;
    }
}
