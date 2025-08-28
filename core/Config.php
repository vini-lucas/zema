<?php

namespace Core;

/**
 * Caso o usuário tente acessar a página sem ser pelo arquivo index, acessa este if.
 */
if (!defined('L4bar3tTA!')) {
        header("Location: /");
}


/**
 * Classes abstratas não podem ser instanciadas, somente herdadas.
 */
abstract class Config
{
        protected function config()
        {
                //Páginas Públicas:
                define('PAGES_PUBLICS', ["Login", "Register", "ConfEmail", "RecPassword", "NewPassword", "NewEmail", "PageErr"]);
                //Páginas Privadas: 
                define('PAGES_PRIVATES', ["Dashboard", "Logout", "ListUsers", "DeleteUser", "EditUser", "EditPassword", "AddUser", "ListLevelsAccess", "EditLevelAccess", "DeleteAccessLevel", "AddLevelAccess", "ListEmails", "EditEmail", "AddEmail", "ListColors", "AddColor", "DeleteColor", "EditColor", "ConfigSite", "DefaultMsg", "AddMsg", "DeleteMsg", "PagesPublicAndPriv", "DeleteController", "AddController"]);
                // Informações do BD: 
                define('DB_NAME', "zema");
                define('DB_PASS', "L4bar3tTA!"); // -> Usuário para executar apenas comandos do CRUD.
                define('DB_USER', "zema"); // -> Usuário para executar apenas comandos do CRUD.
                define('DB_PORT', 3306);
                //--------------------------------------------------------------------------------------------
                define('ACCESS_NEW_USER', 4); // -> Nível de acesso que um novo usuário começa.
                define('CONTROLLER_NOT_CONTROLLER', 'PageErr'); // -> O que a Controller recebe se não haver controller informada na URL.
                define('METHOD_NOT_CONTROLLER', 'index'); // -> O que o Método recebe se não haver controller informada na URL.
                define('PARAMETER_NOT_CONTROLLER', ''); // -> O que o Parâmetro recebe se não haver controller informada na URL.
                define('URL', 'http://localhost/zema/');
                define('EMAILADM', 'lucasvini269@gmail.com');

                // Buscar mensagens padrão no banco de dados:
                $readMsg = new \Sts\Models\helper\StsRead();
                $readMsg->fullRead("SELECT shortcut, msg FROM sts_default_msg");
                foreach ($readMsg->getResultDb() as $define) {
                        extract($define);
                        define($shortcut, $msg);
                }
        }
}
