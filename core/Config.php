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
                // Buscar mensagens padrão no banco de dados:
                $readMsg = new \Sts\Models\helper\StsRead();
                $readMsg->fullRead("SELECT shortcut, msg FROM sts_default_msg");
                foreach ($readMsg->getResultDb() as $define) {
                        extract($define);
                        define($shortcut, $msg);
                }

                //Páginas Públicas:
                define('PAGES_PUBLICS', ["Login", "Register", "ConfEmail", "RecPassword", "NewPassword", "NewEmail", "PageErr"]);
                //Páginas Privadas: 
                define('PAGES_PRIVATES', ["Dashboard", "Logout", "ListUsers", "DeleteUser", "EditUser", "EditPassword", "AddUser", "ListLevelsAccess", "EditLevelAccess", "DeleteAccessLevel", "AddLevelAccess", "ListEmails", "EditEmail", "AddEmail", "ListColors", "AddColor", "DeleteColor", "EditColor", "ConfigSite", "DefaultMsg", "AddMsg", "DeleteMsg"]);
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
                // Mensagens:------------------------------------------------------------------------------------
                /*define('MSG_MATCH_PASS', "<p style='color: red;'>A senha deve combinar!</p>");
                define('MSG_SEL_GENDER', "<p style='color: red;'>Selecione o gênero!</p>");
                define('MSG_USER_ACTIVE', "<p style='color: green;'>Usuário ativado com sucesso, realize o login com seu CPF e senha!</p>");
                define('MSG_LINK_EMAIL_INV', "<p style='color: red;'>Link inválido, solicite um novo para seguimento!</p>");
                define('MSG_USE_ACCESS_LEVEL', "<p style='color: red;'>Seu usuário utiliza este Nível de Acesso!</p>");
                define('MSG_USER_DELETE_CON', "<p style='color: green;'>Usuário logado excluído com sucesso!</p>");

                define('MSG_REGISTER_NOT_FOUND', "<p style='color: red;'>Nenhum registro encontrado!</p>");

                define('MSG_MSG_SEND_REC_PASS', "<p style='color: green'>Uma mensagem com instruções para recuperação de senha foi enviada à caixa de e-mail pertencente à este CPF!</p>");
                define('MSG_MSG_NOT_SEND_REC_PASS', "<p style='color: red;'>Mensagem com instruções para recuperação de senha não foi enviada com sucesso.<br>Entre em contato com o suporte (" . EMAILADM . ") para maiores informações!</p>");

                define('MSG_ALT_PERF_SUCCESS', "<p style='color: green'>Alteração(ôes) realizada(s) com sucesso!</p>");
                define('MSG_ALT_NOT_PERF_SUCCESS', "<p style='color: red'>Alteração(ôes) não realizada(s) com sucesso!</p>");

                define('MSG_ERR_PAGE_NOT_FOUND_404', 'Err 404!');
                define('MSG_ERR_PAGE_NOT_FOUND_333', 'Err 333!');
                define('MSG_ERR_PAGE_NOT_FOUND_639', 'Err 639!');
                define('MSG_ERR_PAGE_NOT_FOUND_527', 'Err 527!');
                define('MSG_VIOLATION_1062', "<p style='color: red;'>Um ou mais registros inseridos já estão sendo utilizados por outro usuário!</p>");
                define('MSG_VIOLATION_1217', "<p style='color: red;'>Registro sendo utilizado por outro usuário!</p>");
                define('MSG_SPACE_WHITE', "<p style='color: red'>Proibido utilizar espaço(s) em branco na senha!</p>");
                define('MSG_QUOT_SIMPLE', "<p style='color: red'>Proibido utilizar aspa(s) simples ou dupla(s) ('', " . '""' . ") na senha!</p>");
                define('MSG_MORE_8_CARACTERER', "<p style='color: red;'>Proibido utilizar menos que 8 caracteres na senha!</p>");
                define('MSG_EMAIL_INVALID', "<p style='color: red;'>E-mail inválido!</p>");
                define('MSG_INPUT_FIELD', "<p style='color: red;'>Preencha todos os campos!</p>");
                define('MSG_18_YEARS', "<p style='color: red;'>Idade mínima para cadastro é de 18 anos!</p>");

                define('MSG_CPF_TRUE_CAD', "<p style='color: red;'>Este CPF já possui cadastro, realize o login!</p>");
                define('MSG_USER_PASS_INV', "<p style='color: red;'>Usuário e/ou senha inválido(a)(s)!</p>");
                define('MSG_USER_WAIT_CONF', "<p style='color: red;'>Usuário aguardando confirmação, <a href='" . URL . "new-email/index'>CLIQUE AQUI</a> para solicitar sua ativação!</p>");
                define('MSG_USER_INACTIVE', "<p style='color: red;'>Usuário inativo!</p>");

                define('MSG_ERR_REC_PASS', "<p style='color: red;'>Houve um erro ao seguir com a recuperação de senha.<br>Entre em contato com o suporte (" . EMAILADM . ") para maiores informações!</p>");
                define('MSG_USER_NOT_ACCOUNT', "<p style='color: red;'>Este CPF não possui conta em nossa plataforma, cadastre-se!</p>");
                define('MSG_MSG_SEND_INST_REC_PASS', "<p style='color: green;'>Uma mensagem com instruções para recuperação de senha foi enviada à caixa de e-mail pertencente à este CPF!</p>");
                define('MSG_MSG_NOT_SEND_INST_REC_PASS', "<p style='color: red;'>Mensagem com instruções para recuperação de senha não foi enviada com sucesso.<br>Entre em contato com o suporte (" . EMAILADM . ") para maiores informações!</p>");
                define('MSG_USER_CREATED_SUCCESS', "<p style='color: green;'>Usuário cadastrado com sucesso.<br>Acesse sua caixa de e-mail para confirmar seu registro!</p>");
                define('MSG_USER_CREATED_SUCCESS_NOT_EMAIL', "<p style='color: red;'>Usuário cadastrado com sucesso.<br>Não foi possível enviar o e-mail de confirmação de cadastro, entre em contato com o suporte (" . EMAILADM . ") para maiores informações!</p>");*/
                // -------------------------------------------------------------------------------------------
        }
}
