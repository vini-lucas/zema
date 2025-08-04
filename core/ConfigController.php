<?php

/**
 * Utilizar o "namespace" para o Composer conseguir carregar esta clase.
 */
namespace Core;

class ConfigController extends Config
{
    private string $url; // -> Recebe a URL informada pelo usuário.
    private string $urlController; // -> Recebe a URL da controller informada.
    private string $urlMethod; // -> Recebe a URL do método informado.
    private array $urlArray; // -> Recebe o array da URL.
    private string $urlSlugController;
    private array $format;

    public function __construct()
    {
        $this->config();
        if (!empty(filter_input(INPUT_GET, 'url', FILTER_DEFAULT))) { // -> Se existir algo na URL, então:
            $this->url = filter_input(INPUT_GET, 'url', FILTER_DEFAULT); // -> Atribui-a para o atribulo "url".
            $this->clearUrl();

            /**
             * Transforma as strings separadas pela "/" em um array.
             */
            $this->urlArray = explode("/", $this->url);
            if (isset($this->urlArray[0]) and (isset($this->urlArray[1]))) { // -> Se houver a controller e o método informado na URL, então:
                $this->urlController = $this->slugController($this->urlArray[0]); // -> O atributo "urlController" recebe a controller já limpa pelo método "slugController()".
                $this->urlMethod = $this->urlArray[1]; // -> O atributo "urlMethod" recebe o método.
            } else { // -> Se não houver a controller e/ou o método informado, então:
                $this->urlController = "Home"; // -> A controller recebe a página Home.
                $this->urlMethod = "index"; // -> O método recebe o index.
            }
        } else { // -> Se não existir nada na URL, então:
            $this->urlController = "Home"; // -> A controller recebe a página Home.
            $this->urlMethod = "index"; // -> O método recebe o index.
        }
    }

    private function clearUrl()
    {
        /**
         * Remover as TAGS(<>).
         */
        $this->url = strip_tags($this->url);

        /**
         * Remover os espaços em branco.
         */
        $this->url = trim($this->url);

        /**
         * Remove tudo que há do primeiro parâmetro da função no primeiro parâmetro.
         */
        $this->url = rtrim($this->url, "/");

        /**
         * Remover todos os caracteres especiais.
         * Substitui todos os caracteres do "format['a']" da URL pelo do "format['b']".
         */
        $this->format['a'] = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]?;:.,\\\'<>°ºª ';
        $this->format['b'] = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr-------------------------------------------------------------------------------------------------';
        $this->url = strtr(
            mb_convert_encoding($this->url, 'ISO-8859-1'),
            mb_convert_encoding($this->format['a'], 'ISO-8859-1', 'UTF-8'),
            mb_convert_encoding($this->format['b'], 'ISO-8859-1', 'UTF-8')
        );
    }

    private function slugController($slugController)
    {
        /**
         * Converte a string inteira para minúsculo.
         */
        $this->urlSlugController = strtolower($slugController);

        /**
         * Retira tudo que há do primeiro argumento e substitui pelo segundo argumento no atributo.
         */
        $this->urlSlugController = str_replace("-", " ", $this->urlSlugController);

        /**
         * Converte a primeira letra da string para maiúscula.
         */
        $this->urlSlugController = ucwords($this->urlSlugController);

        /**
         * Retira tudo que há do primeiro argumento e substitui pelo segundo argumento no atributo.
         */
        $this->urlSlugController = str_replace(" ", "", $this->urlSlugController);

        return $this->urlSlugController;
    }

    public function loadPage()
    {
        /**
         * "ucwords() altera a primeira letra da variável para maiúscula".
         */
        $urlController = ucwords($this->urlController);
        $classLoad = "\\Sts\Controllers\\" . $urlController; // -> "$classLoad" recebe o endereço completo da controller que o usuário digitou.
        $classPage = new $classLoad(); // -> Depois, instancia a classe dessa controller.
        $classPage->index(); // -> Depois, chama o método index desta classe/controller.
    }
}
