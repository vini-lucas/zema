<?php

/**
 * Utilizar o "namespace" para o Composer conseguir carregar esta clase.
 */

namespace Core;

/**
 * Caso o usuário tente acessar a página sem ser pelo arquivo index, acessa este if.
 */
if (!defined('L4bar3tTA!')) {
    header("Location: /");
}


class ConfigController extends Config
{
    private string $url; // -> Recebe a URL informada pelo usuário.
    private string $urlController; // -> Recebe a URL da CONTROLLER informada.
    private string $urlMethod; // -> Recebe a URL do método informado.
    private string $urlParameter; // -> Recebe a URL do parâmetro do método.
    private array $urlArray; // -> Recebe o array da URL.
    private string $urlSlugController; // -> Recebe a URL da CONTROLLER limpa.
    private array $format;
    private array $listPgPublic; // -> Recebe um array com todas as páginas públicas do projeto.
    private array $listPgPrivate; // -> Recebe um array com todas as páginas privadas do projeto.

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
                if (isset($this->urlArray[2])) { // Se o parâmetro existir, então:
                    $this->urlParameter = $this->urlArray[2]; // -> O atributo "urlParameter" recebe o parâmetro.
                } else { // -> Se não existir, então:
                    $this->urlParameter = ""; // -> O parâmetro não recebe nada.
                }
            } else { // -> Se não houver a controller e/ou o método informado, então:
                $this->urlController = "Login"; // -> A controller recebe a página Home.
                $this->urlMethod = "index"; // -> O método recebe o index.
                $this->urlParameter = ""; // -> O parâmetro não recebe nada.
            }
        } else { // -> Se não existir nada na URL, então:
            $this->urlController = "Login"; // -> A controller recebe a página Home.
            $this->urlMethod = "index"; // -> O método recebe o index.
            $this->urlParameter = ""; // -> O parâmetro não recebe nada.
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
        $this->urlController = ucwords($this->urlController);
        $classLoad = "\\Sts\Controllers\\" . $this->urlController; // -> "$classLoad" recebe o endereço completo da controller que o usuário digitou.
        $this->pagePublic();
        if (class_exists($classLoad)) { // -> Se a classe existir então:
            if (method_exists($classLoad, $this->urlMethod)) { // -> Verifica se o método existe.
                $classPage = new $classLoad(); // -> Depois, instancia a classe dessa controller.
                $classPage->{$this->urlMethod}($this->urlParameter); // -> Depois, chama o método desta classe/controller junto do parâmetro.
            } else { // -> Se não existar, retorna este die:
                die('Erro 639: Página não encontrada! Caso o erro persista, acione o suporte pelo e-mail: ' . '"' . EMAILADM . '"' . '.');
            }
        } else { // -> Se não existar, retorna este die:
            die('Erro 527: Página não encontrada! Caso o erro persista, acione o suporte pelo e-mail: ' . '"' . EMAILADM . '"' . '.');
        }
    }

    /**
     * Método para verificar se a página é ou não pública.
     */
    private function pagePublic()
    {
        $this->listPgPublic = ["Login", "Register"];

        /**
         * Se no array do primeiro argumento existir a string do segundo argumento então acessa o if.
         */
        if (in_array($this->urlController, $this->listPgPublic)) {
            $classLoad = "\\Sts\Controllers\\" . $this->urlController;
        } else {
            $this->pagePrivate();
        }
    }

    private function pagePrivate()
    {
        $this->listPgPrivate = ["Dashboard", "Logout", "ListUsers", "DeleteUser", "EditUser", "EditPassword", "AddUser", "ListLevelsAccess"];

        if (in_array($this->urlController, $this->listPgPrivate)) {
            $this->verifyLogin();
        } else {
            $_SESSION['msg'] = "<p style='color: red;'>Página não encontrada!<br></p>";
            header("Location: " . URL . "login/index");
        }
    }

    private function verifyLogin()
    {
        if ((isset($_SESSION['user_cpf'])) and ($_SESSION['user_id'])) {
            $classLoad = "\\Sts\Controllers\\" . $this->urlController;
        } else {
            $_SESSION['msg'] = "<p style='color: red;'>Realize o login para obter acesso à página!</p>";
            header("Location: " . URL . "login/index");
        }
    }
}
