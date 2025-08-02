<?php

/**
 * Utilizar o "namespace" para o Composer conseguir carregar esta clase.
 */

namespace Core;

class ConfigController
{
    private string $url; // -> Recebe a URL informada pelo usuário.
    private string $urlController; // -> Recebe a URL da controller informada.
    private string $urlMethod; // -> Recebe a URL do método informado.
    private array $urlArray; // -> Recebe o array da URL.

    public function __construct()
    {
        if (!empty(filter_input(INPUT_GET, 'url', FILTER_DEFAULT))) {
            $this->url = filter_input(INPUT_GET, 'url', FILTER_DEFAULT);

            /**
             * Transforma as strings separadas pela "/" em um array.
             */
            $this->urlArray = explode("/", $this->url);
            if (isset($this->urlArray[0]) and (isset($this->urlArray[1]))) {
                $this->urlController = $this->urlArray[0];
                $this->urlMethod = $this->urlArray[1];
            } else {
                $this->urlController = "erro";
                $this->urlMethod = "index";
            }
        } else {
            $this->urlController = "home";
            $this->urlMethod = "index";
        }
        echo "Controller: {$this->urlController}<br>";
        echo "Método: {$this->urlMethod}<br>";
    }
}
