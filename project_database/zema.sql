-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 22/08/2025 às 11:02
-- Versão do servidor: 9.1.0
-- Versão do PHP: 8.3.14

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
-- Estrutura para tabela `sts_confs_emails`
--

DROP TABLE IF EXISTS `sts_confs_emails`;
CREATE TABLE IF NOT EXISTS `sts_confs_emails` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(220) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(220) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(220) COLLATE utf8mb4_unicode_ci NOT NULL,
  `host` varchar(220) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(220) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(220) COLLATE utf8mb4_unicode_ci NOT NULL,
  `smtpsecure` varchar(220) COLLATE utf8mb4_unicode_ci NOT NULL,
  `port` int NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `sts_confs_emails`
--

INSERT INTO `sts_confs_emails` (`id`, `title`, `name`, `email`, `host`, `username`, `password`, `smtpsecure`, `port`, `created`, `modified`) VALUES
(1, 'Suporte', 'Suporte Zema Financeira', 'atendimento@zema.com', 'sandbox.smtp.mailtrap.io', '8ac29ca061a315', 'd54fb9280f94c8', 'HPMailer::ENCRYPTION_STARTTLS', 2525, '2025-08-18 21:33:21', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `sts_sit_users`
--

DROP TABLE IF EXISTS `sts_sit_users`;
CREATE TABLE IF NOT EXISTS `sts_sit_users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(220) COLLATE utf8mb4_unicode_ci NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `sts_users`
--

INSERT INTO `sts_users` (`id`, `name`, `cpf`, `date_birth`, `telephone`, `email`, `password`, `conf_email`, `gender`, `image`, `access_level_id`, `sit_user_id`, `created`, `modified`) VALUES
(1, 'Lucas Vinicius', '12428432990', '2006-02-06', '43999859499', 'lucasvini269@gmail.com', '$2y$10$0Rsl7izmNxVUsDwG65SgbuaMrv02YyZKAfec.DVlejwsfPc8q2n2m', NULL, 'masculine', NULL, 1, 1, '2025-08-14 18:01:19', '2025-08-22 03:25:31'),
(2, 'Elias Miguel', '1234', '2020-08-13', '1234', 'elias@gmail.com', '$2y$10$Blga39Mgyr9gpKjyoEuLcOnA/nMXBjq98/mm7BYMxQTLu6TQ2ppq.', NULL, 'masculine', NULL, 4, 1, '2025-08-15 17:15:33', '2025-08-16 11:49:56'),
(3, 'teste', '11111111111', '1111-11-11', '11111111111', 'teste@teste.teste', '$2y$10$L5qP90jTlYYZkcFVx5eUGuSZoP7YgIcpRBK5z7GymG8bFy.W.STQy', '$2y$10$7w4w3Sykcv4.aYzRoYLB9.F4xX2O0L8HUE3cyY.vXfxyfMeWH6.oK', 'masculine', NULL, 4, 3, '2025-08-22 03:53:49', NULL);

--
-- Restrições para tabelas despejadas
--

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
