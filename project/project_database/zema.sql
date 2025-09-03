-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 03/09/2025 às 14:18
-- Versão do servidor: 8.3.0
-- Versão do PHP: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `zema`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `sts_access_levels`
--

DROP TABLE IF EXISTS `sts_access_levels`;
CREATE TABLE IF NOT EXISTS `sts_access_levels` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(220) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `sts_access_levels`
--

INSERT INTO `sts_access_levels` (`id`, `name`, `created`, `modified`) VALUES
(1, 'Super Administrador', '2025-08-13 00:02:19', NULL),
(2, 'Administrador', '2025-08-12 03:02:52', NULL),
(3, 'Vendedor', '2025-08-12 03:02:52', '2025-08-15 20:16:45'),
(4, 'Cliente', '2025-08-15 17:08:45', '2025-08-15 17:11:13');

-- --------------------------------------------------------

--
-- Estrutura para tabela `sts_access_new_user`
--

DROP TABLE IF EXISTS `sts_access_new_user`;
CREATE TABLE IF NOT EXISTS `sts_access_new_user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `shortcut` varchar(220) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_level_id` int NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `access_level_id` (`access_level_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Nível de acesso que um usuário que se auto cadastrou recebe.';

--
-- Despejando dados para a tabela `sts_access_new_user`
--

INSERT INTO `sts_access_new_user` (`id`, `shortcut`, `access_level_id`, `created`, `modified`) VALUES
(1, 'ACCESS_NEW_USER', 4, '2025-08-11 17:09:21', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `sts_branch`
--

DROP TABLE IF EXISTS `sts_branch`;
CREATE TABLE IF NOT EXISTS `sts_branch` (
  `id` int NOT NULL AUTO_INCREMENT,
  `city` varchar(220) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cnpj` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `enterprise_id` int NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cnpj` (`cnpj`),
  KEY `enterprise_id` (`enterprise_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `sts_branch`
--

INSERT INTO `sts_branch` (`id`, `city`, `cnpj`, `enterprise_id`, `created`, `modified`) VALUES
(1, 'São Paulo', '1234679810', 1, '2025-08-13 17:25:28', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `sts_colors`
--

DROP TABLE IF EXISTS `sts_colors`;
CREATE TABLE IF NOT EXISTS `sts_colors` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(220) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(220) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `color` (`color`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `sts_colors`
--

INSERT INTO `sts_colors` (`id`, `name`, `color`, `created`, `modified`) VALUES
(1, 'Primária', '#4682B4', '2025-08-13 16:26:40', NULL),
(2, 'Secundária', '#FFD700', '2025-08-12 16:26:40', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `sts_confs_emails`
--

DROP TABLE IF EXISTS `sts_confs_emails`;
CREATE TABLE IF NOT EXISTS `sts_confs_emails` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(220) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(220) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(220) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `host` varchar(220) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(220) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(220) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `smtpsecure` varchar(220) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `port` int NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `sts_confs_emails`
--

INSERT INTO `sts_confs_emails` (`id`, `title`, `name`, `email`, `host`, `username`, `password`, `smtpsecure`, `port`, `created`, `modified`) VALUES
(1, 'Suporte', 'Suporte Zema Financeira', 'atendimento@zema.com', 'sandbox.smtp.mailtrap.io', '945d8cbd5835e7', 'dba4f56b622fa0', 'HPMailer::ENCRYPTION_STARTTLS', 2525, '2025-08-18 21:33:21', '2025-08-25 19:01:06');

-- --------------------------------------------------------

--
-- Estrutura para tabela `sts_default_msg`
--

DROP TABLE IF EXISTS `sts_default_msg`;
CREATE TABLE IF NOT EXISTS `sts_default_msg` (
  `id` int NOT NULL AUTO_INCREMENT,
  `shortcut` varchar(220) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `msg` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `shortcut` (`shortcut`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `sts_default_msg`
--

INSERT INTO `sts_default_msg` (`id`, `shortcut`, `msg`, `created`, `modified`) VALUES
(1, 'MSG_MATCH_PASS', '<p style=\"color: red;\">A senha deve combinar!</p>', '2025-08-26 17:53:03', '2025-08-28 14:04:33'),
(2, 'MSG_SEL_GENDER', '<p style=\"color: red;\">Selecione o gênero!</p>', '2025-08-26 17:53:03', NULL),
(3, 'MSG_USER_ACTIVE', '<p style=\"color: green;\">Usuário ativado com sucesso, realize o login com seu CPF e senha!</p>', '2025-08-26 17:53:03', NULL),
(4, 'MSG_LINK_EMAIL_INV', '<p style=\"color: red;\">Link inválido, solicite um novo para seguimento!</p>', '2025-08-26 17:53:03', NULL),
(5, 'MSG_USE_ACCESS_LEVEL', '<p style=\"color: red;\">Seu usuário utiliza este Nível de Acesso!</p>', '2025-08-26 17:53:03', NULL),
(6, 'MSG_USER_DELETE_CON', '<p style=\"color: green;\">Usuário logado excluído com sucesso!</p>', '2025-08-26 17:53:03', NULL),
(7, 'MSG_REGISTER_NOT_FOUND', '<p style=\"color: red;\">Nenhum registro encontrado!</p>', '2025-08-26 17:53:03', NULL),
(8, 'MSG_MSG_SEND_REC_PASS', '<p style=\"color: green\">Uma mensagem com instruções para recuperação de senha foi enviada à caixa de e-mail pertencente à este CPF!</p>', '2025-08-26 17:53:03', NULL),
(9, 'MSG_MSG_NOT_SEND_REC_PASS', '<p style=\"color: red;\">Mensagem com instruções para recuperação de senha não foi enviada com sucesso.<br>Entre em contato com o suporte (EMAILADM) para maiores informações!</p>', '2025-08-26 17:53:03', NULL),
(10, 'MSG_ALT_PERF_SUCCESS', '<p style=\"color: green\">Alteração(ôes) realizada(s) com sucesso!</p>', '2025-08-26 17:53:03', NULL),
(11, 'MSG_ALT_NOT_PERF_SUCCESS', '<p style=\"color: red\">Alteração(ôes) não realizada(s) com sucesso!</p>', '2025-08-26 17:53:03', NULL),
(12, 'MSG_ERR_PAGE_NOT_FOUND_404', 'Err 404!', '2025-08-26 17:53:03', NULL),
(13, 'MSG_ERR_PAGE_NOT_FOUND_333', 'Err 333!', '2025-08-26 17:53:03', NULL),
(14, 'MSG_ERR_PAGE_NOT_FOUND_639', 'Err 639!', '2025-08-26 17:53:03', NULL),
(15, 'MSG_ERR_PAGE_NOT_FOUND_527', 'Err 527!', '2025-08-26 17:53:03', NULL),
(16, 'MSG_VIOLATION_1062', '<p style=\"color: red;\">Um ou mais registros inseridos já estão sendo utilizados por outro usuário!</p>', '2025-08-26 17:53:03', NULL),
(17, 'MSG_VIOLATION_1217', '<p style=\"color: red;\">Registro sendo utilizado por outro usuário!</p>', '2025-08-26 17:53:03', NULL),
(18, 'MSG_SPACE_WHITE', '<p style=\"color: red\">Proibido utilizar espaço(s) em branco na senha!</p>', '2025-08-26 17:53:03', '2025-08-27 18:33:32'),
(19, 'MSG_QUOT_SIMPLE', '<p style=\"color: red\">Proibido utilizar aspa(s) simples ou dupla(s) na senha!</p>', '2025-08-26 17:53:03', NULL),
(20, 'MSG_MORE_8_CARACTERER', '<p style=\"color: red;\">Proibido utilizar menos que 8 caracteres na senha!</p>', '2025-08-26 17:53:03', NULL),
(21, 'MSG_EMAIL_INVALID', '<p style=\"color: red;\">E-mail inválido!</p>', '2025-08-26 17:53:03', NULL),
(22, 'MSG_INPUT_FIELD', '<p style=\"color: red;\">Preencha todos os campos!</p>', '2025-08-26 17:53:03', NULL),
(23, 'MSG_18_YEARS', '<p style=\"color: red;\">Idade mínima para cadastro é de 18 anos!</p>', '2025-08-26 17:53:03', NULL),
(24, 'MSG_CPF_TRUE_CAD', '<p style=\"color: red;\">Este CPF já possui cadastro, realize o login!</p>', '2025-08-26 17:53:03', NULL),
(25, 'MSG_USER_PASS_INV', '<p style=\"color: red;\">Usuário e/ou senha inválido(a)(s)!</p>', '2025-08-26 17:53:03', NULL),
(26, 'MSG_USER_WAIT_CONF', '<p style=\"color: red;\">Usuário aguardando confirmação, <a href=\"URL/new-email/index\">CLIQUE AQUI</a> para solicitar sua ativação!</p>', '2025-08-26 17:53:03', NULL),
(27, 'MSG_USER_INACTIVE', '<p style=\"color: red;\">Usuário inativo!</p>', '2025-08-26 17:53:03', NULL),
(28, 'MSG_ERR_REC_PASS', '<p style=\"color: red;\">Houve um erro ao seguir com a recuperação de senha.<br>Entre em contato com o suporte (EMAILADM) para maiores informações!</p>', '2025-08-26 17:53:03', NULL),
(29, 'MSG_USER_NOT_ACCOUNT', '<p style=\"color: red;\">Este CPF não possui conta em nossa plataforma, cadastre-se!</p>', '2025-08-26 17:53:03', NULL),
(30, 'MSG_MSG_SEND_INST_REC_PASS', '<p style=\"color: green;\">Uma mensagem com instruções para recuperação de senha foi enviada à caixa de e-mail pertencente à este CPF!</p>', '2025-08-26 17:53:03', NULL),
(31, 'MSG_MSG_NOT_SEND_INST_REC_PASS', '<p style=\"color: red;\">Mensagem com instruções para recuperação de senha não foi enviada com sucesso.<br>Entre em contato com o suporte (EMAILADM) para maiores informações!</p>', '2025-08-26 17:53:03', NULL),
(32, 'MSG_USER_CREATED_SUCCESS', '<p style=\"color: green;\">Usuário cadastrado com sucesso.<br>Acesse sua caixa de e-mail para confirmar seu registro!</p>', '2025-08-26 17:53:03', NULL),
(33, 'MSG_USER_CREATED_SUCCESS_NOT_EMAIL', '<p style=\"color: red;\">Usuário cadastrado com sucesso.<br>Não foi possível enviar o e-mail de confirmação de cadastro, entre em contato com o suporte (EMAILADM) para maiores informações!</p>', '2025-08-26 17:53:03', NULL),
(34, 'MSG_SEND_PP_CUST_SUCCESS', '<p style=\"color: green\">Simulação encaminhada com sucesso utilizando como parâmetro as suas informações do perfil!</p>', '2025-08-30 16:59:45', '2025-08-30 17:00:55'),
(35, 'MSG_SEND_PP_CUST_ERR', '<p style=\"color: red\">Simulação não encaminhada com sucesso utilizando como parâmetro as suas informações do perfil!</p>', '2025-08-30 17:02:56', NULL),
(36, 'MSG_SEND_PP_SELLER_SUCCESS', '<p style=\"color: green\">Operação cadastrada com sucesso!</p>', '2025-08-30 17:43:27', NULL),
(37, 'MSG_SEND_PP_SELLER_ERR', '<p style=\"color: red\">Operação não cadastrada com sucesso!</p>', '2025-08-30 17:44:15', NULL),
(38, 'MSG_PRIME_MSG', '<p style=\"color: red;\">Informe o valor e data da(s) parcela(s)!</p>', '2025-09-02 01:22:42', NULL),
(39, 'MSG_DATE_PORTION_REMAINING', '<p style=\"color: red;\">Informe o valor ou a data não preenchida!</p>', '2025-09-02 01:24:47', '2025-09-02 01:42:31');

-- --------------------------------------------------------

--
-- Estrutura para tabela `sts_email_msg`
--

DROP TABLE IF EXISTS `sts_email_msg`;
CREATE TABLE IF NOT EXISTS `sts_email_msg` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(220) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='E-mail do ADM que aparece nas MSG que orientam a contatar.';

--
-- Despejando dados para a tabela `sts_email_msg`
--

INSERT INTO `sts_email_msg` (`id`, `email`, `created`, `modified`) VALUES
(1, 'lucasvini269@gmail.com', '2025-08-11 09:49:55', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `sts_enterprises`
--

DROP TABLE IF EXISTS `sts_enterprises`;
CREATE TABLE IF NOT EXISTS `sts_enterprises` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(220) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cnpj` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `cnpj` (`cnpj`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `sts_enterprises`
--

INSERT INTO `sts_enterprises` (`id`, `name`, `cnpj`, `created`, `modified`) VALUES
(1, 'Móveis Gazin', '77941490000155', '2025-08-05 17:20:31', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `sts_load_controller`
--

DROP TABLE IF EXISTS `sts_load_controller`;
CREATE TABLE IF NOT EXISTS `sts_load_controller` (
  `id` int NOT NULL AUTO_INCREMENT,
  `controller` varchar(220) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `controller` (`controller`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Página que é carregada caso não seja informada nada na URL.';

--
-- Despejando dados para a tabela `sts_load_controller`
--

INSERT INTO `sts_load_controller` (`id`, `controller`, `created`, `modified`) VALUES
(1, 'PageErr', '2025-08-12 21:07:40', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `sts_pages`
--

DROP TABLE IF EXISTS `sts_pages`;
CREATE TABLE IF NOT EXISTS `sts_pages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `controller` varchar(220) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `public` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `controller` (`controller`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Páginas Públicas e Privadas';

--
-- Despejando dados para a tabela `sts_pages`
--

INSERT INTO `sts_pages` (`id`, `controller`, `public`, `created`, `modified`) VALUES
(1, 'Login', 1, '2025-08-27 20:51:09', '2025-08-28 14:07:47'),
(2, 'Register', 1, '2025-08-27 20:51:09', '2025-08-28 19:57:56'),
(3, 'ConfEmail', 1, '2025-08-27 20:51:09', NULL),
(4, 'RecPassword', 1, '2025-08-27 20:51:09', NULL),
(5, 'NewPassword', 1, '2025-08-27 20:51:09', NULL),
(6, 'NewEmail', 1, '2025-08-27 20:51:09', NULL),
(7, 'PageErr', 1, '2025-08-27 20:51:09', NULL),
(8, 'Dashboard', 0, '2025-08-27 20:51:09', '2025-08-28 20:00:08'),
(9, 'Logout', 0, '2025-08-27 20:51:09', NULL),
(10, 'ListUsers', 0, '2025-08-27 20:51:09', NULL),
(11, 'DeleteUser', 0, '2025-08-27 20:51:09', NULL),
(12, 'EditUser', 0, '2025-08-27 20:51:09', NULL),
(13, 'EditPassword', 0, '2025-08-27 20:51:09', NULL),
(14, 'AddUser', 0, '2025-08-27 20:51:09', NULL),
(15, 'ListLevelsAccess', 0, '2025-08-27 20:51:09', NULL),
(16, 'EditLevelAccess', 0, '2025-08-27 20:51:09', NULL),
(17, 'DeleteAccessLevel', 0, '2025-08-27 20:51:09', NULL),
(18, 'AddLevelAccess', 0, '2025-08-27 20:51:09', NULL),
(19, 'ListEmails', 0, '2025-08-27 20:51:09', NULL),
(20, 'EditEmail', 0, '2025-08-27 20:51:09', NULL),
(21, 'AddEmail', 0, '2025-08-27 20:51:09', NULL),
(22, 'ListColors', 0, '2025-08-27 20:51:09', NULL),
(23, 'AddColor', 0, '2025-08-27 20:51:09', NULL),
(24, 'DeleteColor', 0, '2025-08-27 20:51:09', NULL),
(25, 'EditColor', 0, '2025-08-27 20:51:09', NULL),
(26, 'ConfigSite', 0, '2025-08-27 20:51:09', NULL),
(27, 'DefaultMsg', 0, '2025-08-27 20:51:09', NULL),
(28, 'AddMsg', 0, '2025-08-27 20:51:09', NULL),
(29, 'DeleteMsg', 0, '2025-08-27 20:51:09', NULL),
(30, 'PagesPublicAndPriv', 0, '2025-08-27 20:51:09', NULL),
(31, 'AddController', 0, '2025-08-28 20:23:43', NULL),
(32, 'AccessNewUser', 0, '2025-08-28 20:41:32', '2025-08-28 23:04:21'),
(33, 'LoadController', 0, '2025-08-28 23:51:43', NULL),
(34, 'EmailMsg', 0, '2025-08-29 12:45:00', '2025-08-29 12:45:20'),
(35, 'Fgts', 0, '2025-08-29 16:42:06', NULL),
(36, 'NewProposal', 0, '2025-08-30 16:42:15', NULL),
(37, 'ViewProposal', 0, '2025-09-01 16:25:15', NULL),
(38, 'ViewProposalCustomer', 0, '2025-09-01 16:25:25', NULL),
(39, 'FillProposal', 0, '2025-09-03 13:05:27', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `sts_proposal_fgts`
--

DROP TABLE IF EXISTS `sts_proposal_fgts`;
CREATE TABLE IF NOT EXISTS `sts_proposal_fgts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cpf` int NOT NULL,
  `enterprise` varchar(220) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch` int DEFAULT NULL,
  `seller_cpf` varchar(220) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(110) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_birth` date NOT NULL,
  `gender` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_mother` varchar(110) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_father` varchar(110) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telephone` int DEFAULT NULL,
  `email` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cep` int DEFAULT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `bank` int DEFAULT NULL,
  `agency` int DEFAULT NULL,
  `account` int DEFAULT NULL,
  `possession` tinyint(1) NOT NULL COMMENT '0 -> Operação com o CLIENTE.\r\n1 -> Operação com a MESA.\r\n2 ->Operação CANCELADA ou PAGA.',
  `value_released` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `portions` json NOT NULL,
  `date_portions` date DEFAULT NULL,
  `observation` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `internship_proposal` int NOT NULL COMMENT '0 -> Vendedor (ou superior) está cadastrando o nome, CPF e data/nascimento para encaminhar operação;\r\n1 -> Mesa recebe a operação com estes dados preenchidos;\r\n2 -> Beneficiário recebe a operação com o valor liberado, pendência registrada ou cancelamento;\r\n3 -> Mesa recebe a operação com o valor escolhido ou pendência corrigida;\r\n4 -> Cliente recebe operação com a operação digitada e o link de formalização disponível (cliente não atua mais na proposta);\r\n5 -> Mesa atualiza a operação para paga ou cancelada.',
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `sts_proposal_fgts`
--

INSERT INTO `sts_proposal_fgts` (`id`, `cpf`, `enterprise`, `branch`, `seller_cpf`, `name`, `date_birth`, `gender`, `name_mother`, `name_father`, `telephone`, `email`, `cep`, `address`, `bank`, `agency`, `account`, `possession`, `value_released`, `portions`, `date_portions`, `observation`, `internship_proposal`, `created`, `modified`) VALUES
(1, 1234, NULL, NULL, 'VENDA PRÓPRIA', 'Elias Miguel', '2020-08-13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'R$1.000,00', '{\"1_portion\": {\"date\": \"2001-01-01\", \"value\": \"R$100,00\"}, \"2_portion\": {\"date\": \"2002-01-01\", \"value\": \"R$200,00\"}}', NULL, 'FACTA.', 2, '2025-09-02 18:07:49', '2025-09-03 02:29:06');

-- --------------------------------------------------------

--
-- Estrutura para tabela `sts_sit_users`
--

DROP TABLE IF EXISTS `sts_sit_users`;
CREATE TABLE IF NOT EXISTS `sts_sit_users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(220) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `sts_sit_users`
--

INSERT INTO `sts_sit_users` (`id`, `name`, `created`, `modified`) VALUES
(1, 'Ativo', '2025-08-13 00:13:00', NULL),
(2, 'Inativo', '2025-08-22 03:13:19', NULL),
(3, 'Aguardando Confirmação', '2025-08-22 03:13:19', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `sts_users`
--

DROP TABLE IF EXISTS `sts_users`;
CREATE TABLE IF NOT EXISTS `sts_users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(220) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cpf` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_birth` date NOT NULL,
  `telephone` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(220) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `recover_password` varchar(220) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `conf_email` varchar(220) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(220) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `access_level_id` int NOT NULL,
  `sit_user_id` int NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cpf` (`cpf`),
  UNIQUE KEY `telephone` (`telephone`),
  UNIQUE KEY `email` (`email`),
  KEY `access_level_id` (`access_level_id`),
  KEY `sit_user_id` (`sit_user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `sts_users`
--

INSERT INTO `sts_users` (`id`, `name`, `cpf`, `date_birth`, `telephone`, `email`, `password`, `recover_password`, `conf_email`, `gender`, `image`, `access_level_id`, `sit_user_id`, `created`, `modified`) VALUES
(1, 'Lucas Vinicius', '12428432990', '2006-02-06', '43999859499', 'lucasvini269@gmail.com', '$2y$10$0Rsl7izmNxVUsDwG65SgbuaMrv02YyZKAfec.DVlejwsfPc8q2n2m', '$2y$10$v0hzKc43WMjFsgyei5l4leZZAXcvyMq2JkN/zunrzokzxUHkT9GaC', NULL, 'masculine', NULL, 1, 1, '2025-08-14 18:01:19', '2025-08-22 03:25:31'),
(2, 'Elias Miguel', '1234', '2020-08-13', '1234', 'elias@gmail.com', '$2y$10$Izui18mIDD11EgCDhy8nZ.cjwa60RS7pf6Pvd0w6FAek0.zNfdq12', '$2y$10$BQzZe2TYv.D9JRyPeVF3julDHXw.tYvMMnjUMhNRiqxEIhZdRjABO', NULL, 'masculine', NULL, 4, 1, '2025-08-15 17:15:33', '2025-08-16 11:49:56');

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `sts_access_new_user`
--
ALTER TABLE `sts_access_new_user`
  ADD CONSTRAINT `sts_access_new_user_ibfk_1` FOREIGN KEY (`access_level_id`) REFERENCES `sts_access_levels` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Restrições para tabelas `sts_branch`
--
ALTER TABLE `sts_branch`
  ADD CONSTRAINT `sts_branch_ibfk_1` FOREIGN KEY (`enterprise_id`) REFERENCES `sts_enterprises` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Restrições para tabelas `sts_users`
--
ALTER TABLE `sts_users`
  ADD CONSTRAINT `sts_users_ibfk_1` FOREIGN KEY (`access_level_id`) REFERENCES `sts_access_levels` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `sts_users_ibfk_2` FOREIGN KEY (`sit_user_id`) REFERENCES `sts_sit_users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
