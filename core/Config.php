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
                // Informações do BD: ------------------------------------------------------------------------
                define('DB_NAME', "zema");
                define('DB_PASS', "");
                define('DB_USER', "root");
                define('DB_PORT', 3306);
                //--------------------------------------------------------------------------------------------
                // URL do projeto:
                define('URL', 'http://localhost/zema/');
                //--------------------------------------------------------------------------------------------
                // Nível de acesso que um usuário que se auto cadastrou recebe: ------------------------------
                $readLevel = new \Sts\Models\helper\StsRead();
                $readLevel->fullRead("SELECT access_level_id FROM sts_access_new_user");
                define('ACCESS_NEW_USER', $readLevel->getResultDb()[0]['access_level_id']);
                //--------------------------------------------------------------------------------------------
                // O que a controller, método e parâmetro recebe se nada for informado na URL: ---------------
                $loadController = new \Sts\Models\helper\StsRead();
                $loadController->fullRead("SELECT controller FROM sts_load_controller");
                define('CONTROLLER_NOT_CONTROLLER', $loadController->getResultDb()[0]['controller']);
                define('METHOD_NOT_CONTROLLER', 'index');
                define('PARAMETER_NOT_CONTROLLER', '');
                //--------------------------------------------------------------------------------------------
                //E-mail do ADM: -----------------------------------------------------------------------------
                $readEmail = new \Sts\Models\helper\StsRead();
                $readEmail->fullRead("SELECT email FROM sts_email_msg");
                define('EMAILADM', $readEmail->getResultDb()[0]['email']);
                //--------------------------------------------------------------------------------------------
                // Buscar mensagens padrão no banco de dados: ------------------------------------------------
                $readMsg = new \Sts\Models\helper\StsRead();
                $readMsg->fullRead("SELECT shortcut, msg FROM sts_default_msg");
                foreach ($readMsg->getResultDb() as $define) {
                        extract($define);
                        define($shortcut, $msg);
                }
                //--------------------------------------------------------------------------------------------
                // Buscar as páginas públicas e privadas no banco de dados: ----------------------------------
                define('PAGES_PUBLICS', $this->pagesPublic());
                define('PAGES_PRIVATES', $this->pagesPrivate());
                // -------------------------------------------------------------------------------------------
        }

        public function pagesPublic()
        {
                $readControllersPublic = new \Sts\Models\helper\StsRead();
                $readControllersPublic->fullRead("SELECT controller, public FROM sts_pages WHERE public=:public", "public=1");
                foreach ($readControllersPublic->getResultDb() as $pagesPublic) {
                        extract($pagesPublic);
                        $array[] = $controller;
                }
                return $array;
        }

        public function pagesPrivate()
        {
                $readControllersPrivate = new \Sts\Models\helper\StsRead();
                $readControllersPrivate->fullRead("SELECT controller, public FROM sts_pages WHERE public=:public", "public=0");
                foreach ($readControllersPrivate->getResultDb() as $pagesPrivate) {
                        extract($pagesPrivate);
                        $array[] = $controller;
                }
                return $array;
        }
}
