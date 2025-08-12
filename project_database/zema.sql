-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 12/08/2025 às 03:28
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
  `name` varchar(220) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `sts_access_levels`
--

INSERT INTO `sts_access_levels` (`id`, `name`, `created`, `modified`) VALUES
(1, 'Super Administrador', '2025-08-13 00:02:19', NULL),
(2, 'Administrador', '2025-08-12 03:02:52', NULL),
(3, 'Vendedor', '2025-08-12 03:02:52', NULL),
(4, 'Cliente', '2025-08-12 03:03:07', NULL);

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
  `email` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(220) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `recover_password` varchar(220) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(220) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `access_level_id` int NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `access_level_id` (`access_level_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `sts_users`
--

INSERT INTO `sts_users` (`id`, `name`, `cpf`, `date_birth`, `telephone`, `email`, `password`, `recover_password`, `gender`, `image`, `access_level_id`, `created`, `modified`) VALUES
(1, 'Lucas', '12428432990', '2006-02-06', '4399859499', 'lucas@gmail.com', '$2y$10$pz42Qm3xFSf95qZOGx7giOGtpjPRQs7lS9Mr0F2Roqg.7eMgviSrq', NULL, 'masculine', NULL, 1, '2025-08-12 00:14:09', NULL);

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `sts_users`
--
ALTER TABLE `sts_users`
  ADD CONSTRAINT `sts_users_ibfk_1` FOREIGN KEY (`access_level_id`) REFERENCES `sts_access_levels` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
