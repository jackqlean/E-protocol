-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.1.21-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win32
-- HeidiSQL Versão:              9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Copiando estrutura do banco de dados para prot
CREATE DATABASE IF NOT EXISTS `prot` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `prot`;

-- Copiando estrutura para tabela prot.encaminhamento
CREATE TABLE IF NOT EXISTS `encaminhamento` (
  `cod` int(11) NOT NULL AUTO_INCREMENT,
  `cod_prenc` int(11) DEFAULT NULL,
  `cod_stenv` int(11) DEFAULT NULL,
  `cod_stdst` int(11) DEFAULT NULL,
  `cod_rqenc` int(11) DEFAULT NULL,
  `user_env` int(11) DEFAULT NULL,
  `user_rec` int(11) DEFAULT NULL,
  `data_env` date DEFAULT NULL,
  `horas_env` time DEFAULT NULL,
  `data_rec` date DEFAULT NULL,
  `horas_rec` time DEFAULT NULL,
  `obs` text,
  `status` char(1) DEFAULT NULL,
  PRIMARY KEY (`cod`),
  KEY `cod_proc` (`cod_prenc`),
  KEY `cod_setor` (`cod_stdst`),
  KEY `cod_rqenc` (`cod_rqenc`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela prot.encaminhamento: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `encaminhamento` DISABLE KEYS */;
INSERT INTO `encaminhamento` (`cod`, `cod_prenc`, `cod_stenv`, `cod_stdst`, `cod_rqenc`, `user_env`, `user_rec`, `data_env`, `horas_env`, `data_rec`, `horas_rec`, `obs`, `status`) VALUES
	(5, 48, NULL, 1, 23, NULL, NULL, '2017-05-17', '11:33:22', '2017-05-19', '16:40:49', 'Qualquer coisa ...', '1');
INSERT INTO `encaminhamento` (`cod`, `cod_prenc`, `cod_stenv`, `cod_stdst`, `cod_rqenc`, `user_env`, `user_rec`, `data_env`, `horas_env`, `data_rec`, `horas_rec`, `obs`, `status`) VALUES
	(6, 49, NULL, 4, 19, NULL, NULL, '2017-05-17', '11:59:26', '2017-05-20', '19:33:47', 'qualquer coisa ....', '1');
INSERT INTO `encaminhamento` (`cod`, `cod_prenc`, `cod_stenv`, `cod_stdst`, `cod_rqenc`, `user_env`, `user_rec`, `data_env`, `horas_env`, `data_rec`, `horas_rec`, `obs`, `status`) VALUES
	(7, 51, NULL, 4, 29, NULL, NULL, '2017-05-18', '21:45:17', NULL, NULL, 'exemplo teste ...', '0');
INSERT INTO `encaminhamento` (`cod`, `cod_prenc`, `cod_stenv`, `cod_stdst`, `cod_rqenc`, `user_env`, `user_rec`, `data_env`, `horas_env`, `data_rec`, `horas_rec`, `obs`, `status`) VALUES
	(8, 52, NULL, 4, 35, NULL, NULL, '2017-05-19', '14:48:04', NULL, NULL, 'para encaminhamento a perícia médica.', '0');
INSERT INTO `encaminhamento` (`cod`, `cod_prenc`, `cod_stenv`, `cod_stdst`, `cod_rqenc`, `user_env`, `user_rec`, `data_env`, `horas_env`, `data_rec`, `horas_rec`, `obs`, `status`) VALUES
	(11, 53, 1, 2, 30, 2, 1, '2017-05-23', '17:18:09', NULL, NULL, 'qualquer coisa...', '0');
/*!40000 ALTER TABLE `encaminhamento` ENABLE KEYS */;

-- Copiando estrutura para tabela prot.itens_arq
CREATE TABLE IF NOT EXISTS `itens_arq` (
  `cod` int(11) NOT NULL AUTO_INCREMENT,
  `cod_proc` int(11) DEFAULT NULL,
  `arquivo` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`cod`),
  KEY `cod_proc` (`cod_proc`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela prot.itens_arq: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `itens_arq` DISABLE KEYS */;
INSERT INTO `itens_arq` (`cod`, `cod_proc`, `arquivo`) VALUES
	(19, 48, 'Jack.jpg');
INSERT INTO `itens_arq` (`cod`, `cod_proc`, `arquivo`) VALUES
	(20, 49, 'Leticia.jpg');
INSERT INTO `itens_arq` (`cod`, `cod_proc`, `arquivo`) VALUES
	(21, 53, 'Publicacao.pdf');
/*!40000 ALTER TABLE `itens_arq` ENABLE KEYS */;

-- Copiando estrutura para tabela prot.itens_enc
CREATE TABLE IF NOT EXISTS `itens_enc` (
  `cod` int(11) NOT NULL AUTO_INCREMENT,
  `cod_enc` int(11) NOT NULL,
  `cod_user_id` int(11) NOT NULL,
  PRIMARY KEY (`cod`),
  KEY `cod_enc` (`cod_enc`),
  KEY `cod_user_id` (`cod_user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela prot.itens_enc: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `itens_enc` DISABLE KEYS */;
INSERT INTO `itens_enc` (`cod`, `cod_enc`, `cod_user_id`) VALUES
	(1, 11, 1);
INSERT INTO `itens_enc` (`cod`, `cod_enc`, `cod_user_id`) VALUES
	(2, 11, 2);
/*!40000 ALTER TABLE `itens_enc` ENABLE KEYS */;

-- Copiando estrutura para tabela prot.itens_proc
CREATE TABLE IF NOT EXISTS `itens_proc` (
  `cod` int(11) NOT NULL AUTO_INCREMENT,
  `cod_proc` int(11) NOT NULL,
  `cod_ob` int(11) NOT NULL,
  PRIMARY KEY (`cod`),
  KEY `cod_proc` (`cod_proc`),
  KEY `cod_ob` (`cod_ob`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela prot.itens_proc: ~15 rows (aproximadamente)
/*!40000 ALTER TABLE `itens_proc` DISABLE KEYS */;
INSERT INTO `itens_proc` (`cod`, `cod_proc`, `cod_ob`) VALUES
	(1, 9, 7);
INSERT INTO `itens_proc` (`cod`, `cod_proc`, `cod_ob`) VALUES
	(2, 9, 8);
INSERT INTO `itens_proc` (`cod`, `cod_proc`, `cod_ob`) VALUES
	(3, 11, 8);
INSERT INTO `itens_proc` (`cod`, `cod_proc`, `cod_ob`) VALUES
	(4, 10, 9);
INSERT INTO `itens_proc` (`cod`, `cod_proc`, `cod_ob`) VALUES
	(5, 12, 8);
INSERT INTO `itens_proc` (`cod`, `cod_proc`, `cod_ob`) VALUES
	(6, 12, 7);
INSERT INTO `itens_proc` (`cod`, `cod_proc`, `cod_ob`) VALUES
	(7, 12, 9);
INSERT INTO `itens_proc` (`cod`, `cod_proc`, `cod_ob`) VALUES
	(8, 13, 7);
INSERT INTO `itens_proc` (`cod`, `cod_proc`, `cod_ob`) VALUES
	(9, 13, 8);
INSERT INTO `itens_proc` (`cod`, `cod_proc`, `cod_ob`) VALUES
	(10, 14, 8);
INSERT INTO `itens_proc` (`cod`, `cod_proc`, `cod_ob`) VALUES
	(12, 23, 8);
INSERT INTO `itens_proc` (`cod`, `cod_proc`, `cod_ob`) VALUES
	(14, 25, 9);
INSERT INTO `itens_proc` (`cod`, `cod_proc`, `cod_ob`) VALUES
	(15, 25, 8);
INSERT INTO `itens_proc` (`cod`, `cod_proc`, `cod_ob`) VALUES
	(16, 26, 8);
INSERT INTO `itens_proc` (`cod`, `cod_proc`, `cod_ob`) VALUES
	(18, 29, 10);
/*!40000 ALTER TABLE `itens_proc` ENABLE KEYS */;

-- Copiando estrutura para tabela prot.itens_setor
CREATE TABLE IF NOT EXISTS `itens_setor` (
  `cod` int(11) NOT NULL AUTO_INCREMENT,
  `cod_enc` int(11) NOT NULL,
  `cod_setor` int(11) NOT NULL,
  PRIMARY KEY (`cod`),
  KEY `cod_enc` (`cod_enc`),
  KEY `cod_setor` (`cod_setor`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela prot.itens_setor: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `itens_setor` DISABLE KEYS */;
INSERT INTO `itens_setor` (`cod`, `cod_enc`, `cod_setor`) VALUES
	(1, 11, 1);
INSERT INTO `itens_setor` (`cod`, `cod_enc`, `cod_setor`) VALUES
	(2, 11, 2);
/*!40000 ALTER TABLE `itens_setor` ENABLE KEYS */;

-- Copiando estrutura para tabela prot.ob
CREATE TABLE IF NOT EXISTS `ob` (
  `cod` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` char(1) DEFAULT NULL,
  `titulo` varchar(50) NOT NULL,
  PRIMARY KEY (`cod`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela prot.ob: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `ob` DISABLE KEYS */;
INSERT INTO `ob` (`cod`, `tipo`, `titulo`) VALUES
	(7, 'G', 'Processo');
INSERT INTO `ob` (`cod`, `tipo`, `titulo`) VALUES
	(8, 'D', 'Acompanhamento 3');
/*!40000 ALTER TABLE `ob` ENABLE KEYS */;

-- Copiando estrutura para tabela prot.proc
CREATE TABLE IF NOT EXISTS `proc` (
  `cod` int(11) NOT NULL AUTO_INCREMENT,
  `cod_req` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tipo` varchar(2) DEFAULT NULL,
  `assunto` text,
  `descricao` varchar(50) DEFAULT NULL,
  `setor` int(11) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `horas` time DEFAULT NULL,
  PRIMARY KEY (`cod`),
  KEY `cod_req` (`cod_req`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela prot.proc: ~16 rows (aproximadamente)
/*!40000 ALTER TABLE `proc` DISABLE KEYS */;
INSERT INTO `proc` (`cod`, `cod_req`, `user_id`, `tipo`, `assunto`, `descricao`, `setor`, `data`, `horas`) VALUES
	(9, 29, 2, 'PI', 'processo 001', 'teste de processo 001.', 6, '2017-04-07', '16:38:31');
INSERT INTO `proc` (`cod`, `cod_req`, `user_id`, `tipo`, `assunto`, `descricao`, `setor`, `data`, `horas`) VALUES
	(10, 23, 2, 'PI', 'teste 001', 'Entrega de documentos.', 3, '2017-04-10', '13:39:12');
INSERT INTO `proc` (`cod`, `cod_req`, `user_id`, `tipo`, `assunto`, `descricao`, `setor`, `data`, `horas`) VALUES
	(11, 30, 2, 'OT', 'Teste 00002', 'Testando processo 00002.', 2, '2017-04-12', '16:40:41');
INSERT INTO `proc` (`cod`, `cod_req`, `user_id`, `tipo`, `assunto`, `descricao`, `setor`, `data`, `horas`) VALUES
	(12, 19, 2, 'PE', 'alguma coisa', 'testando...', 1, '2017-04-12', '17:22:45');
INSERT INTO `proc` (`cod`, `cod_req`, `user_id`, `tipo`, `assunto`, `descricao`, `setor`, `data`, `horas`) VALUES
	(13, 24, 2, 'PI', 'entregar processo 00001', 'teste...', 1, '2017-04-12', '21:58:37');
INSERT INTO `proc` (`cod`, `cod_req`, `user_id`, `tipo`, `assunto`, `descricao`, `setor`, `data`, `horas`) VALUES
	(14, 31, 2, 'PI', 'entregar processo 00002', 'Entregando processo de aposentadoria especial.', 1, '2017-04-13', '10:27:31');
INSERT INTO `proc` (`cod`, `cod_req`, `user_id`, `tipo`, `assunto`, `descricao`, `setor`, `data`, `horas`) VALUES
	(23, 31, 2, 'PI', 'entregar processo 00003', 'teste..', 3, '2017-04-13', '11:35:33');
INSERT INTO `proc` (`cod`, `cod_req`, `user_id`, `tipo`, `assunto`, `descricao`, `setor`, `data`, `horas`) VALUES
	(25, 29, 2, 'PE', 'aposentadoria', 'aposentadoria de scooby chato.', 1, '2017-04-21', '12:44:21');
INSERT INTO `proc` (`cod`, `cod_req`, `user_id`, `tipo`, `assunto`, `descricao`, `setor`, `data`, `horas`) VALUES
	(26, 31, 2, 'PI', 'Auxílio Saúde', 'Acidente de trabalho.', 1, '2017-04-22', '10:48:18');
INSERT INTO `proc` (`cod`, `cod_req`, `user_id`, `tipo`, `assunto`, `descricao`, `setor`, `data`, `horas`) VALUES
	(29, 30, 2, 'PI', 'Aposentadoria de Tom', 'Por anos de serviço duros prestados.', 2, '2017-04-23', '13:16:42');
INSERT INTO `proc` (`cod`, `cod_req`, `user_id`, `tipo`, `assunto`, `descricao`, `setor`, `data`, `horas`) VALUES
	(48, 23, 2, 'PI', 'Aposentadoria', 'Só daqui vinte anos .. sniff snifff...', 1, '2017-05-12', '10:41:18');
INSERT INTO `proc` (`cod`, `cod_req`, `user_id`, `tipo`, `assunto`, `descricao`, `setor`, `data`, `horas`) VALUES
	(49, 19, 2, 'PI', 'teste 00004', 'aposentadoria ', 1, '2017-05-17', '11:54:36');
INSERT INTO `proc` (`cod`, `cod_req`, `user_id`, `tipo`, `assunto`, `descricao`, `setor`, `data`, `horas`) VALUES
	(50, 23, 2, 'PI', 'Minha aposentadoria', 'Aposentadoria', 1, '2017-05-17', '16:33:35');
INSERT INTO `proc` (`cod`, `cod_req`, `user_id`, `tipo`, `assunto`, `descricao`, `setor`, `data`, `horas`) VALUES
	(51, 29, 2, 'PI', 'Licença saúde', 'para tratamento médico.', 1, '2017-05-18', '21:44:47');
INSERT INTO `proc` (`cod`, `cod_req`, `user_id`, `tipo`, `assunto`, `descricao`, `setor`, `data`, `horas`) VALUES
	(52, 35, 2, 'PI', 'Licença saúde', 'tratamento médico referente acidente de trabalho', 1, '2017-05-19', '14:47:24');
INSERT INTO `proc` (`cod`, `cod_req`, `user_id`, `tipo`, `assunto`, `descricao`, `setor`, `data`, `horas`) VALUES
	(53, 30, 2, 'PI', 'Aposentadoria de alguém', 'Vou me aposentar.\r\n', 1, '2017-05-22', '08:58:43');
/*!40000 ALTER TABLE `proc` ENABLE KEYS */;

-- Copiando estrutura para tabela prot.req
CREATE TABLE IF NOT EXISTS `req` (
  `cod` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `tipo` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `cpf` varchar(14) COLLATE utf8_unicode_ci NOT NULL,
  `sexo` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `tel` varchar(14) COLLATE utf8_unicode_ci NOT NULL,
  `cel` varchar(14) COLLATE utf8_unicode_ci NOT NULL,
  `rec` varchar(14) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`cod`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Copiando dados para a tabela prot.req: ~11 rows (aproximadamente)
/*!40000 ALTER TABLE `req` DISABLE KEYS */;
INSERT INTO `req` (`cod`, `nome`, `tipo`, `cpf`, `sexo`, `tel`, `cel`, `rec`, `email`) VALUES
	(19, 'Letícia de Oliveira Ferreira Leandro', 'F', '189.903.888-48', 'M', '(13)3821-6117', '(13)99612-9793', '(13)98180-5044', 'leleolive@hotmail.com');
INSERT INTO `req` (`cod`, `nome`, `tipo`, `cpf`, `sexo`, `tel`, `cel`, `rec`, `email`) VALUES
	(23, 'Jaquison Quintão Leandro', 'S', '189.903.888-48', 'M', '(13)3821-8542', '(13)98224-9408', '(13)98180-5044', 'jackqlean@gmail.com');
INSERT INTO `req` (`cod`, `nome`, `tipo`, `cpf`, `sexo`, `tel`, `cel`, `rec`, `email`) VALUES
	(24, 'Melissa', 'F', '189.903.888-48', 'F', '(13)3821-8542', '', '', 'melissa@gmail.com');
INSERT INTO `req` (`cod`, `nome`, `tipo`, `cpf`, `sexo`, `tel`, `cel`, `rec`, `email`) VALUES
	(26, 'Joana S/A', 'J', '189.903.888-48', 'M', '(13)3821-8542', '(13)98224-9408', '(13)98180-5044', 'joana@msn.com');
INSERT INTO `req` (`cod`, `nome`, `tipo`, `cpf`, `sexo`, `tel`, `cel`, `rec`, `email`) VALUES
	(29, 'Miguel Santos Rosa', 'F', '189.903.888-48', 'F', '(13)3821-8542', '(13)99612-9793', '(13)98180-5044', 'miguel.santos@gmail.com');
INSERT INTO `req` (`cod`, `nome`, `tipo`, `cpf`, `sexo`, `tel`, `cel`, `rec`, `email`) VALUES
	(30, 'Aurea Aparecida Alves Pinze', 'F', '189.903.888-48', 'F', '(13)3821-8542', '(13)97913-3996', '', 'pinze7@hotmail.com');
INSERT INTO `req` (`cod`, `nome`, `tipo`, `cpf`, `sexo`, `tel`, `cel`, `rec`, `email`) VALUES
	(31, 'Emerson José Quintão Leandro', 'S', '189.903.888-48', 'M', '(13)3821-8542', '(13)3821-8542', '(13)98112-5045', 'emersonjql@gmail.com');
INSERT INTO `req` (`cod`, `nome`, `tipo`, `cpf`, `sexo`, `tel`, `cel`, `rec`, `email`) VALUES
	(32, 'Maria Joaquina', 'F', '189.903.888-48', 'F', '(13)3821-8542', '(13)3821-8542', '(13)98112-5045', 'mariajoaquina@gmail.com');
INSERT INTO `req` (`cod`, `nome`, `tipo`, `cpf`, `sexo`, `tel`, `cel`, `rec`, `email`) VALUES
	(33, 'João de Oliveira', 'F', '189.903.888-48', 'M', '(13)3821-6655', '(13)3821-8542', '(13)98112-5045', 'joaoliveira@gmail.com');
INSERT INTO `req` (`cod`, `nome`, `tipo`, `cpf`, `sexo`, `tel`, `cel`, `rec`, `email`) VALUES
	(34, 'Olavo de Almeida', 'F', '189.903.888-48', 'M', '(13)3821-8542', '(13)97913-3996', '(13)98112-5045', 'olavo@gmail.com');
INSERT INTO `req` (`cod`, `nome`, `tipo`, `cpf`, `sexo`, `tel`, `cel`, `rec`, `email`) VALUES
	(35, 'Cristiane de Oliveira', 'F', '189.903.888-48', 'F', '(13)3821-8542', '(13)97913-3996', '(13)98112-5045', 'cristianeoliveira@hotmail.com');
/*!40000 ALTER TABLE `req` ENABLE KEYS */;

-- Copiando estrutura para tabela prot.setor
CREATE TABLE IF NOT EXISTS `setor` (
  `cod_setor` int(11) NOT NULL AUTO_INCREMENT,
  `setor` varchar(50) NOT NULL DEFAULT '0',
  `responsavel` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`cod_setor`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela prot.setor: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `setor` DISABLE KEYS */;
INSERT INTO `setor` (`cod_setor`, `setor`, `responsavel`) VALUES
	(1, 'Administração', 'Toninho Cabral');
INSERT INTO `setor` (`cod_setor`, `setor`, `responsavel`) VALUES
	(2, 'Tesouraria', 'Aurealice Firmino');
INSERT INTO `setor` (`cod_setor`, `setor`, `responsavel`) VALUES
	(3, 'Jurídico', 'Dr. Fernando');
INSERT INTO `setor` (`cod_setor`, `setor`, `responsavel`) VALUES
	(4, 'Previdenciário', 'Juliana Borges');
INSERT INTO `setor` (`cod_setor`, `setor`, `responsavel`) VALUES
	(6, 'Contabilidade', 'Aurealice Firmino');
/*!40000 ALTER TABLE `setor` ENABLE KEYS */;

-- Copiando estrutura para tabela prot.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Copiando dados para a tabela prot.users: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
	(1, 'Jaquison ', 'jackqlean@gmail.com', '2d29b962490320f821db80cddf6ed4b6e4ac7498');
INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
	(2, 'Usuario', 'usuario@usuario', '2d29b962490320f821db80cddf6ed4b6e4ac7498');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
