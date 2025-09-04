<?php
/**
 * Iniciando a sessão para utilizar as variáveis globais em qualquer local do projeto.
 */
session_start();
ob_start();


/**
 * Constante que define que o usuário está acessando o projeto pelo arquivo index.
 */
define('L4bar3tTA!', true);
require './vendor/autoload.php';

$url = new Core\ConfigController();
$url->loadPage();

ob_end_flush();

