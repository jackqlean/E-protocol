-- --------------------------------------------------------
-- Servidor:                     localhost
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

-- Copiando estrutura para tabela prot.devolucao
CREATE TABLE IF NOT EXISTS `devolucao` (
  `cod` int(11) NOT NULL AUTO_INCREMENT,
  `cod_prdev` int(11) DEFAULT NULL,
  `cod_stdev` int(11) DEFAULT NULL,
  `cod_storg` int(11) DEFAULT NULL,
  `cod_rqdev` int(11) DEFAULT NULL,
  `user_env` int(11) DEFAULT NULL,
  `user_rec` int(11) DEFAULT NULL,
  `data_env` date DEFAULT NULL,
  `horas_env` time DEFAULT NULL,
  `data_rec` date DEFAULT NULL,
  `horas_rec` time DEFAULT NULL,
  `obs` text,
  `status` char(1) DEFAULT NULL,
  PRIMARY KEY (`cod`),
  KEY `cod_proc` (`cod_prdev`),
  KEY `cod_setor` (`cod_storg`),
  KEY `cod_rqenc` (`cod_rqdev`),
  KEY `cod_stdev` (`cod_stdev`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela prot.devolucao: ~8 rows (aproximadamente)
/*!40000 ALTER TABLE `devolucao` DISABLE KEYS */;
INSERT INTO `devolucao` (`cod`, `cod_prdev`, `cod_stdev`, `cod_storg`, `cod_rqdev`, `user_env`, `user_rec`, `data_env`, `horas_env`, `data_rec`, `horas_rec`, `obs`, `status`) VALUES
	(2, 70, 9, 4, 23, 3, 2, '2017-06-05', '14:08:43', '2017-06-05', '15:16:12', 'Processo resolvido. Devolvendo para o setor de origem.', '1');
INSERT INTO `devolucao` (`cod`, `cod_prdev`, `cod_stdev`, `cod_storg`, `cod_rqdev`, `user_env`, `user_rec`, `data_env`, `horas_env`, `data_rec`, `horas_rec`, `obs`, `status`) VALUES
	(3, 72, 9, 4, 19, 3, 2, '2017-06-05', '16:17:11', '2017-06-05', '16:19:11', 'Processo já foi analisado e está sendo devolvido ao setor de origem.', '1');
INSERT INTO `devolucao` (`cod`, `cod_prdev`, `cod_stdev`, `cod_storg`, `cod_rqdev`, `user_env`, `user_rec`, `data_env`, `horas_env`, `data_rec`, `horas_rec`, `obs`, `status`) VALUES
	(4, 73, 7, 4, 31, 3, 1, '2017-06-05', '16:20:51', '2017-06-05', '16:21:25', 'Processo já foi analisado e aprovado. Sendo devolvido ao setor de origem.', '1');
INSERT INTO `devolucao` (`cod`, `cod_prdev`, `cod_stdev`, `cod_storg`, `cod_rqdev`, `user_env`, `user_rec`, `data_env`, `horas_env`, `data_rec`, `horas_rec`, `obs`, `status`) VALUES
	(5, 74, 1, 2, 30, 4, 5, '2017-06-05', '16:25:51', '2017-06-05', '16:26:19', 'Processo já foi analisado e está sendo devolvido ao setor de origem.', '1');
INSERT INTO `devolucao` (`cod`, `cod_prdev`, `cod_stdev`, `cod_storg`, `cod_rqdev`, `user_env`, `user_rec`, `data_env`, `horas_env`, `data_rec`, `horas_rec`, `obs`, `status`) VALUES
	(6, 75, 7, 4, 38, 3, 1, '2017-06-08', '11:23:45', '2017-06-09', '13:58:08', 'Processo resolvido com sucesso. Devolvendo ao setor de origem.', '1');
INSERT INTO `devolucao` (`cod`, `cod_prdev`, `cod_stdev`, `cod_storg`, `cod_rqdev`, `user_env`, `user_rec`, `data_env`, `horas_env`, `data_rec`, `horas_rec`, `obs`, `status`) VALUES
	(8, 78, 7, 2, 19, 4, 1, '2017-06-09', '13:55:44', '2017-06-09', '13:56:44', 'Processo resolvido. Devolvendo ao setor de origem.', '1');
INSERT INTO `devolucao` (`cod`, `cod_prdev`, `cod_stdev`, `cod_storg`, `cod_rqdev`, `user_env`, `user_rec`, `data_env`, `horas_env`, `data_rec`, `horas_rec`, `obs`, `status`) VALUES
	(9, 76, 7, 4, 26, 3, 1, '2017-06-09', '14:09:39', '2017-06-09', '14:10:10', 'Processo já foi resolvido e está sendo devolvido ao setor de origem.', '1');
INSERT INTO `devolucao` (`cod`, `cod_prdev`, `cod_stdev`, `cod_storg`, `cod_rqdev`, `user_env`, `user_rec`, `data_env`, `horas_env`, `data_rec`, `horas_rec`, `obs`, `status`) VALUES
	(10, 79, 7, 4, 19, 3, 1, '2017-06-14', '16:24:51', '2017-06-14', '16:25:40', 'Devolvendo ao setor de origem. Processo já resolvido.', '1');
INSERT INTO `devolucao` (`cod`, `cod_prdev`, `cod_stdev`, `cod_storg`, `cod_rqdev`, `user_env`, `user_rec`, `data_env`, `horas_env`, `data_rec`, `horas_rec`, `obs`, `status`) VALUES
	(11, 81, 7, 4, 31, 3, 1, '2017-06-21', '22:50:33', '2017-06-21', '22:51:19', 'Processo resolvido e sendo devolvido ao setor de origem.', '1');
/*!40000 ALTER TABLE `devolucao` ENABLE KEYS */;

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
  `statusd` char(1) DEFAULT NULL,
  PRIMARY KEY (`cod`),
  KEY `cod_proc` (`cod_prenc`),
  KEY `cod_setor` (`cod_stdst`),
  KEY `cod_rqenc` (`cod_rqenc`),
  KEY `cod_stenv` (`cod_stenv`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela prot.encaminhamento: ~8 rows (aproximadamente)
/*!40000 ALTER TABLE `encaminhamento` DISABLE KEYS */;
INSERT INTO `encaminhamento` (`cod`, `cod_prenc`, `cod_stenv`, `cod_stdst`, `cod_rqenc`, `user_env`, `user_rec`, `data_env`, `horas_env`, `data_rec`, `horas_rec`, `obs`, `status`, `statusd`) VALUES
	(45, 70, 9, 4, 23, 2, 3, '2017-06-02', '15:34:29', '2017-06-05', '15:12:33', 'verificar tempo de contribuição.', '1', '1');
INSERT INTO `encaminhamento` (`cod`, `cod_prenc`, `cod_stenv`, `cod_stdst`, `cod_rqenc`, `user_env`, `user_rec`, `data_env`, `horas_env`, `data_rec`, `horas_rec`, `obs`, `status`, `statusd`) VALUES
	(47, 72, 9, 4, 19, 2, 3, '2017-06-05', '09:13:04', '2017-06-05', '16:15:24', 'enviando para o setor responsável.', '1', '1');
INSERT INTO `encaminhamento` (`cod`, `cod_prenc`, `cod_stenv`, `cod_stdst`, `cod_rqenc`, `user_env`, `user_rec`, `data_env`, `horas_env`, `data_rec`, `horas_rec`, `obs`, `status`, `statusd`) VALUES
	(48, 73, 7, 4, 31, 1, 3, '2017-06-05', '09:39:25', '2017-06-05', '16:15:31', 'para envio ao setor competente.', '1', '1');
INSERT INTO `encaminhamento` (`cod`, `cod_prenc`, `cod_stenv`, `cod_stdst`, `cod_rqenc`, `user_env`, `user_rec`, `data_env`, `horas_env`, `data_rec`, `horas_rec`, `obs`, `status`, `statusd`) VALUES
	(49, 74, 1, 2, 30, 5, 4, '2017-06-05', '10:33:15', '2017-06-05', '16:24:34', 'encaminhado ao setor competente.', '1', '1');
INSERT INTO `encaminhamento` (`cod`, `cod_prenc`, `cod_stenv`, `cod_stdst`, `cod_rqenc`, `user_env`, `user_rec`, `data_env`, `horas_env`, `data_rec`, `horas_rec`, `obs`, `status`, `statusd`) VALUES
	(50, 75, 7, 4, 38, 1, 3, '2017-06-08', '09:20:01', '2017-06-08', '10:40:04', 'Enviando para o setor competente.', '1', '1');
INSERT INTO `encaminhamento` (`cod`, `cod_prenc`, `cod_stenv`, `cod_stdst`, `cod_rqenc`, `user_env`, `user_rec`, `data_env`, `horas_env`, `data_rec`, `horas_rec`, `obs`, `status`, `statusd`) VALUES
	(51, 76, 7, 4, 26, 1, 3, '2017-06-08', '10:04:37', '2017-06-08', '10:45:45', 'Encaminhado para o setor competente.', '1', '1');
INSERT INTO `encaminhamento` (`cod`, `cod_prenc`, `cod_stenv`, `cod_stdst`, `cod_rqenc`, `user_env`, `user_rec`, `data_env`, `horas_env`, `data_rec`, `horas_rec`, `obs`, `status`, `statusd`) VALUES
	(52, 78, 7, 2, 19, 1, 4, '2017-06-08', '16:31:26', '2017-06-08', '16:32:06', 'verificar o processo para dar prosseguimento a aposentadoria.', '1', '1');
INSERT INTO `encaminhamento` (`cod`, `cod_prenc`, `cod_stenv`, `cod_stdst`, `cod_rqenc`, `user_env`, `user_rec`, `data_env`, `horas_env`, `data_rec`, `horas_rec`, `obs`, `status`, `statusd`) VALUES
	(53, 79, 7, 4, 19, 1, 3, '2017-06-14', '16:22:41', '2017-06-14', '16:23:11', 'por tempo de serviço.', '1', '1');
INSERT INTO `encaminhamento` (`cod`, `cod_prenc`, `cod_stenv`, `cod_stdst`, `cod_rqenc`, `user_env`, `user_rec`, `data_env`, `horas_env`, `data_rec`, `horas_rec`, `obs`, `status`, `statusd`) VALUES
	(54, 81, 7, 4, 31, 1, 3, '2017-06-21', '22:40:42', '2017-06-21', '22:49:50', 'Sendo enviado para o setor competente.', '1', '1');
/*!40000 ALTER TABLE `encaminhamento` ENABLE KEYS */;

-- Copiando estrutura para tabela prot.itens_arq
CREATE TABLE IF NOT EXISTS `itens_arq` (
  `cod` int(11) NOT NULL AUTO_INCREMENT,
  `cod_proc` int(11) DEFAULT NULL,
  `arquivo` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`cod`),
  KEY `cod_proc` (`cod_proc`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela prot.itens_arq: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `itens_arq` DISABLE KEYS */;
INSERT INTO `itens_arq` (`cod`, `cod_proc`, `arquivo`) VALUES
	(25, 66, 'Publicacao do dia 06 Janeiro 2017.pdf');
INSERT INTO `itens_arq` (`cod`, `cod_proc`, `arquivo`) VALUES
	(26, 67, 'Publicacao do dia 06 Janeiro 2017.pdf');
INSERT INTO `itens_arq` (`cod`, `cod_proc`, `arquivo`) VALUES
	(27, 71, 'convite_leticia.pdf');
INSERT INTO `itens_arq` (`cod`, `cod_proc`, `arquivo`) VALUES
	(28, 77, 'convite_aniversario_leticia_Eduardo - Copia.pdf');
INSERT INTO `itens_arq` (`cod`, `cod_proc`, `arquivo`) VALUES
	(29, 77, 'convite_leticia.pdf');
INSERT INTO `itens_arq` (`cod`, `cod_proc`, `arquivo`) VALUES
	(30, 77, 'trabalho_geografia_leticia.docx');
INSERT INTO `itens_arq` (`cod`, `cod_proc`, `arquivo`) VALUES
	(31, 79, 'TERMO DE RESPONSABILIDADE.docx');
/*!40000 ALTER TABLE `itens_arq` ENABLE KEYS */;

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
  KEY `cod_req` (`cod_req`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela prot.proc: ~10 rows (aproximadamente)
/*!40000 ALTER TABLE `proc` DISABLE KEYS */;
INSERT INTO `proc` (`cod`, `cod_req`, `user_id`, `tipo`, `assunto`, `descricao`, `setor`, `data`, `horas`) VALUES
	(70, 23, 2, 'PI', 'Aposentadoria', 'para encaminhamento ao orgão competente.', 9, '2017-06-02', '15:33:51');
INSERT INTO `proc` (`cod`, `cod_req`, `user_id`, `tipo`, `assunto`, `descricao`, `setor`, `data`, `horas`) VALUES
	(72, 19, 2, 'PI', 'Aposentadoria de Marie', 'para o fim do ano.', 9, '2017-06-05', '09:12:01');
INSERT INTO `proc` (`cod`, `cod_req`, `user_id`, `tipo`, `assunto`, `descricao`, `setor`, `data`, `horas`) VALUES
	(73, 31, 1, 'PI', 'Aposentadoria', 'para o fim do ano.', 7, '2017-06-05', '09:38:24');
INSERT INTO `proc` (`cod`, `cod_req`, `user_id`, `tipo`, `assunto`, `descricao`, `setor`, `data`, `horas`) VALUES
	(74, 30, 5, 'PI', 'Aposentadoria', 'para o ano que vem.', 1, '2017-06-05', '10:32:36');
INSERT INTO `proc` (`cod`, `cod_req`, `user_id`, `tipo`, `assunto`, `descricao`, `setor`, `data`, `horas`) VALUES
	(75, 38, 1, 'PI', 'Aposentadoria', 'Para o próximo mês.', 7, '2017-06-08', '09:19:25');
INSERT INTO `proc` (`cod`, `cod_req`, `user_id`, `tipo`, `assunto`, `descricao`, `setor`, `data`, `horas`) VALUES
	(76, 26, 1, 'PI', 'Aposentadoria de Scooby ', 'Para o final do mês.', 7, '2017-06-08', '10:03:50');
INSERT INTO `proc` (`cod`, `cod_req`, `user_id`, `tipo`, `assunto`, `descricao`, `setor`, `data`, `horas`) VALUES
	(77, 33, 1, 'PI', 'Aposentadoria', 'para o fim do mês.', 7, '2017-06-08', '13:58:14');
INSERT INTO `proc` (`cod`, `cod_req`, `user_id`, `tipo`, `assunto`, `descricao`, `setor`, `data`, `horas`) VALUES
	(78, 19, 1, 'PI', 'Aposentadoria de Marie', 'para o fim do ano.', 7, '2017-06-08', '16:30:28');
INSERT INTO `proc` (`cod`, `cod_req`, `user_id`, `tipo`, `assunto`, `descricao`, `setor`, `data`, `horas`) VALUES
	(79, 19, 1, 'PI', 'Aposentadoria de Marie', 'para o fim deste ano.', 7, '2017-06-14', '16:20:57');
INSERT INTO `proc` (`cod`, `cod_req`, `user_id`, `tipo`, `assunto`, `descricao`, `setor`, `data`, `horas`) VALUES
	(81, 31, 1, 'PI', 'Aposentadoria', 'para o fim do mês.', 7, '2017-06-21', '22:39:53');
/*!40000 ALTER TABLE `proc` ENABLE KEYS */;

-- Copiando estrutura para tabela prot.req
CREATE TABLE IF NOT EXISTS `req` (
  `cod` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `tipo` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `cpf` varchar(18) COLLATE utf8_unicode_ci NOT NULL,
  `sexo` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `tel` varchar(14) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cel` varchar(14) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rec` varchar(14) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`cod`),
  UNIQUE KEY `cpf` (`cpf`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Copiando dados para a tabela prot.req: ~19 rows (aproximadamente)
/*!40000 ALTER TABLE `req` DISABLE KEYS */;
INSERT INTO `req` (`cod`, `nome`, `tipo`, `cpf`, `sexo`, `tel`, `cel`, `rec`, `email`) VALUES
	(19, 'Letícia de Oliveira Ferreira Leandro', 'F', '099.982.990-47', 'M', '(13)3821-6117', '(13)99612-9793', '(13)98180-5041', 'leleolive@hotmail.com');
INSERT INTO `req` (`cod`, `nome`, `tipo`, `cpf`, `sexo`, `tel`, `cel`, `rec`, `email`) VALUES
	(23, 'Jaquison Quintão Leandro', 'S', '189.903.888-48', 'M', '(13)3821-0101', '(13)98224-0101', '(13)98180-5042', 'jackqlean@gmail.com');
INSERT INTO `req` (`cod`, `nome`, `tipo`, `cpf`, `sexo`, `tel`, `cel`, `rec`, `email`) VALUES
	(24, 'Melissa', 'F', '522.532.920-95', 'F', '(13)3821-0102', '(13)98224-0201', '(13)98180-5142', 'melissa@gmail.com');
INSERT INTO `req` (`cod`, `nome`, `tipo`, `cpf`, `sexo`, `tel`, `cel`, `rec`, `email`) VALUES
	(26, 'Joana S/A', 'J', '010.800.890-80', 'M', '(13)3821-0103', '(13)98224-0103', '(13)98180-5043', 'joana@msn.com');
INSERT INTO `req` (`cod`, `nome`, `tipo`, `cpf`, `sexo`, `tel`, `cel`, `rec`, `email`) VALUES
	(29, 'Miguel Santos Rosa', 'F', '727.851.130-55', 'F', '(13)3821-0104', '(13)99612-0104', '(13)98180-5044', 'miguel.santos@gmail.com');
INSERT INTO `req` (`cod`, `nome`, `tipo`, `cpf`, `sexo`, `tel`, `cel`, `rec`, `email`) VALUES
	(30, 'Aurea Aparecida Alves Pinze', 'F', '465.685.370-47', 'F', '(13)3821-0105', '(13)97913-0105', '(13)98180-5244', 'pinze7@hotmail.com');
INSERT INTO `req` (`cod`, `nome`, `tipo`, `cpf`, `sexo`, `tel`, `cel`, `rec`, `email`) VALUES
	(31, 'Emerson José Quintão Leandro', 'S', '279.714.820-78', 'M', '(13)3821-0106', '(13)99792-8501', '(13)98112-5045', 'emersonjql@gmail.com');
INSERT INTO `req` (`cod`, `nome`, `tipo`, `cpf`, `sexo`, `tel`, `cel`, `rec`, `email`) VALUES
	(32, 'Maria Joaquina', 'F', '688.581.350-83', 'F', '(13)3821-0107', '(13)99997-8504', '(13)98112-5046', 'mariajoaquina@gmail.com');
INSERT INTO `req` (`cod`, `nome`, `tipo`, `cpf`, `sexo`, `tel`, `cel`, `rec`, `email`) VALUES
	(33, 'João de Oliveira', 'F', '146.204.370-42', 'M', '(13)3821-0108', '(13)99991-8503', '(13)98112-5047', 'joaoliveira@gmail.com');
INSERT INTO `req` (`cod`, `nome`, `tipo`, `cpf`, `sexo`, `tel`, `cel`, `rec`, `email`) VALUES
	(34, 'Olavo de Almeida', 'F', '206.585.630-09', 'M', '(13)3821-0109', '(13)97913-3903', '(13)98112-5048', 'olavo@gmail.com');
INSERT INTO `req` (`cod`, `nome`, `tipo`, `cpf`, `sexo`, `tel`, `cel`, `rec`, `email`) VALUES
	(35, 'Cristiane de Oliveira', 'F', '837.083.970-37', 'F', '(13)3821-0110', '(13)97913-3904', '(13)98112-5049', 'cristianeoliveira@hotmail.com');
INSERT INTO `req` (`cod`, `nome`, `tipo`, `cpf`, `sexo`, `tel`, `cel`, `rec`, `email`) VALUES
	(36, 'Magda Ramos', 'F', '674.984.550-99', 'F', '(13)3821-0111', '(13)99636-4202', '(13)99636-4250', 'city_angels@hotmail.com');
INSERT INTO `req` (`cod`, `nome`, `tipo`, `cpf`, `sexo`, `tel`, `cel`, `rec`, `email`) VALUES
	(37, 'José de Alencar', 'F', '046.465.720-28', 'M', '(13)3821-0112', '(13)98224-9401', '(13)98112-5051', 'jose.alencar@gmail.com');
INSERT INTO `req` (`cod`, `nome`, `tipo`, `cpf`, `sexo`, `tel`, `cel`, `rec`, `email`) VALUES
	(38, 'Flávia de Oliveira', 'F', '872.944.570-18', 'F', '(13)3821-0113', '(13)97913-3901', '(13)99636-4252', 'flaviaoliveira@gmail.com');
INSERT INTO `req` (`cod`, `nome`, `tipo`, `cpf`, `sexo`, `tel`, `cel`, `rec`, `email`) VALUES
	(39, 'Eloy Souza', 'F', '221.910.790-67', 'M', '(13)3821-0114', '(13)97913-3902', '(13)98112-5053', 'eloysouza@gmail.com');
INSERT INTO `req` (`cod`, `nome`, `tipo`, `cpf`, `sexo`, `tel`, `cel`, `rec`, `email`) VALUES
	(40, 'Alessandra de Lima', 'S', '717.599.960-76', 'F', '(13)3821-0115', '(13)99636-4201', '(13)98112-5054', 'alessandralima@gmail.com');
INSERT INTO `req` (`cod`, `nome`, `tipo`, `cpf`, `sexo`, `tel`, `cel`, `rec`, `email`) VALUES
	(41, 'Antônio Luiz Pereira', 'F', '250.763.720-00', 'M', '(13)3821-0116', '(13)98224-9402', '(13)98112-5055', 'antonioluizpereira@gmail.com');
INSERT INTO `req` (`cod`, `nome`, `tipo`, `cpf`, `sexo`, `tel`, `cel`, `rec`, `email`) VALUES
	(47, 'Luiz Otávio de Mendonça', 'S', '780.640.790-12', 'M', '(13)3821-5412', '(13)99112-5045', '(13)99236-5174', 'luizotaviomendonca@gmail.com');
INSERT INTO `req` (`cod`, `nome`, `tipo`, `cpf`, `sexo`, `tel`, `cel`, `rec`, `email`) VALUES
	(48, 'William Marcondes Leandro', 'F', '536.669.390-07', 'M', '(13)3821-6020', '(13)99122-7020', '(13)99120-7123', 'willian@gmail.com');
INSERT INTO `req` (`cod`, `nome`, `tipo`, `cpf`, `sexo`, `tel`, `cel`, `rec`, `email`) VALUES
	(51, 'Prefeitura Municipal de Registro', 'J', '45.685.872/0001-79', 'M', '(13)3828-1000', '', '', 'pmr@registro.sp.gov.br');
/*!40000 ALTER TABLE `req` ENABLE KEYS */;

-- Copiando estrutura para tabela prot.setor
CREATE TABLE IF NOT EXISTS `setor` (
  `cod_setor` int(11) NOT NULL AUTO_INCREMENT,
  `setor` varchar(50) NOT NULL DEFAULT '0',
  `responsavel` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`cod_setor`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela prot.setor: ~8 rows (aproximadamente)
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
INSERT INTO `setor` (`cod_setor`, `setor`, `responsavel`) VALUES
	(7, 'TI', 'Jaquison');
INSERT INTO `setor` (`cod_setor`, `setor`, `responsavel`) VALUES
	(9, 'Teste', 'Usuario Interno');
/*!40000 ALTER TABLE `setor` ENABLE KEYS */;

-- Copiando estrutura para tabela prot.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cod_setor` int(10) unsigned NOT NULL DEFAULT '0',
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cod_setor` (`cod_setor`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Copiando dados para a tabela prot.users: ~6 rows (aproximadamente)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `cod_setor`, `name`, `email`, `password`) VALUES
	(1, 7, 'Jack', 'jackqlean@gmail.com', '60f64f5a83e0dbd972bd6a50a70a6d5c7f4856dd');
INSERT INTO `users` (`id`, `cod_setor`, `name`, `email`, `password`) VALUES
	(2, 9, 'Usuario', 'usuario@usuario', '2d29b962490320f821db80cddf6ed4b6e4ac7498');
INSERT INTO `users` (`id`, `cod_setor`, `name`, `email`, `password`) VALUES
	(3, 4, 'Juliana', 'previdencia@omss.sp.gov.br', '2d29b962490320f821db80cddf6ed4b6e4ac7498');
INSERT INTO `users` (`id`, `cod_setor`, `name`, `email`, `password`) VALUES
	(4, 2, 'Aurealice', 'tesouraria@omss.sp.gov.br', '2d29b962490320f821db80cddf6ed4b6e4ac7498');
INSERT INTO `users` (`id`, `cod_setor`, `name`, `email`, `password`) VALUES
	(5, 1, 'Toninho', 'toninho@omss.sp.gov.br', '2d29b962490320f821db80cddf6ed4b6e4ac7498');
INSERT INTO `users` (`id`, `cod_setor`, `name`, `email`, `password`) VALUES
	(7, 3, 'Fernando', 'juridico@omss.sp.gov.br', '2d29b962490320f821db80cddf6ed4b6e4ac7498');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
