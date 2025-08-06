<?php

namespace Core;

/**
 * Caso o usuário tente acessar a página sem ser pelo arquivo index, acessa este if.
 */
if (!defined('L4bar3tTA!')) {
    header("Location: /");
}


class ConfigView
{
    private string $nameView; // -> Recebe o caminho da view;
    private array|null $data; // -> Recebe os dados que serão enviados para a view.

    public function loadView(string $nameView, array|null $data)
    {
        $this->nameView = $nameView;
        $this->data = $data;

        /**
         * Se o arquivo onde que consta a view existe, então, carrega-o.
         */
        if (file_exists($this->nameView . '.php')) {
            require 'app/sts/Views/include/head.php';
            require $this->nameView . '.php';
            require 'app/sts/Views/include/footer.php';
        } else {
            die('Erro 404: Página não encontrada! Caso o erro persista, acione o suporte pelo e-mail: ' . '"' . EMAILADM . '"' . '.');
        }
    }
}
