<?php

/**
 * Constante que define que o usuário está acessando o projeto pelo arquivo index.
 */
define('L4bar3tTA!', true);
require './vendor/autoload.php';

$url = new Core\ConfigController();
$url->loadPage();
