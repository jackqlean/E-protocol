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
  `cod_proc` int(11) DEFAULT NULL,
  `cod_setor` int(11) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `horas` time DEFAULT NULL,
  `obs` text,
  PRIMARY KEY (`cod`),
  KEY `cod_proc` (`cod_proc`),
  KEY `cod_setor` (`cod_setor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela prot.encaminhamento: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `encaminhamento` DISABLE KEYS */;
/*!40000 ALTER TABLE `encaminhamento` ENABLE KEYS */;

-- Copiando estrutura para tabela prot.itens_arq
CREATE TABLE IF NOT EXISTS `itens_arq` (
  `cod` int(11) NOT NULL AUTO_INCREMENT,
  `cod_proc` int(11) DEFAULT NULL,
  `arquivo` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`cod`),
  KEY `cod_proc` (`cod_proc`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela prot.itens_arq: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `itens_arq` DISABLE KEYS */;
INSERT INTO `itens_arq` (`cod`, `cod_proc`, `arquivo`) VALUES
	(19, 48, 'Jack.jpg');
/*!40000 ALTER TABLE `itens_arq` ENABLE KEYS */;

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

-- Copiando estrutura para tabela prot.ob
CREATE TABLE IF NOT EXISTS `ob` (
  `cod` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` char(1) DEFAULT NULL,
  `titulo` varchar(50) NOT NULL,
  PRIMARY KEY (`cod`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela prot.ob: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `ob` DISABLE KEYS */;
INSERT INTO `ob` (`cod`, `tipo`, `titulo`) VALUES
	(7, 'G', 'Processo');
INSERT INTO `ob` (`cod`, `tipo`, `titulo`) VALUES
	(8, 'D', 'Acompanhamento 3');
INSERT INTO `ob` (`cod`, `tipo`, `titulo`) VALUES
	(9, 'G', 'Processo 002');
INSERT INTO `ob` (`cod`, `tipo`, `titulo`) VALUES
	(10, 'D', 'Acompanhamento 1');
INSERT INTO `ob` (`cod`, `tipo`, `titulo`) VALUES
	(11, 'G', 'Entrega de documento');
/*!40000 ALTER TABLE `ob` ENABLE KEYS */;

-- Copiando estrutura para tabela prot.proc
CREATE TABLE IF NOT EXISTS `proc` (
  `cod` int(11) NOT NULL AUTO_INCREMENT,
  `cod_req` int(11) NOT NULL,
  `tipo` varchar(2) DEFAULT NULL,
  `assunto` text,
  `descricao` varchar(50) DEFAULT NULL,
  `setor` int(11) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `horas` time DEFAULT NULL,
  PRIMARY KEY (`cod`),
  KEY `cod_req` (`cod_req`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela prot.proc: ~11 rows (aproximadamente)
/*!40000 ALTER TABLE `proc` DISABLE KEYS */;
INSERT INTO `proc` (`cod`, `cod_req`, `tipo`, `assunto`, `descricao`, `setor`, `data`, `horas`) VALUES
	(9, 29, 'PE', 'processo 001', 'teste de processo 001.', 3, '2017-04-07', '16:38:31');
INSERT INTO `proc` (`cod`, `cod_req`, `tipo`, `assunto`, `descricao`, `setor`, `data`, `horas`) VALUES
	(10, 23, 'PE', 'teste 001', 'Entrega de documentos.', 1, '2017-04-10', '13:39:12');
INSERT INTO `proc` (`cod`, `cod_req`, `tipo`, `assunto`, `descricao`, `setor`, `data`, `horas`) VALUES
	(11, 30, 'OT', 'Teste 00002', 'Testando processo 00002.', 2, '2017-04-12', '16:40:41');
INSERT INTO `proc` (`cod`, `cod_req`, `tipo`, `assunto`, `descricao`, `setor`, `data`, `horas`) VALUES
	(12, 19, 'PE', 'alguma coisa', 'testando...', 1, '2017-04-12', '17:22:45');
INSERT INTO `proc` (`cod`, `cod_req`, `tipo`, `assunto`, `descricao`, `setor`, `data`, `horas`) VALUES
	(13, 24, 'PI', 'entregar processo 00001', 'teste...', 1, '2017-04-12', '21:58:37');
INSERT INTO `proc` (`cod`, `cod_req`, `tipo`, `assunto`, `descricao`, `setor`, `data`, `horas`) VALUES
	(14, 31, 'PI', 'entregar processo 00002', 'Entregando processo de aposentadoria especial.', 1, '2017-04-13', '10:27:31');
INSERT INTO `proc` (`cod`, `cod_req`, `tipo`, `assunto`, `descricao`, `setor`, `data`, `horas`) VALUES
	(23, 31, 'PI', 'entregar processo 00003', 'teste..', 3, '2017-04-13', '11:35:33');
INSERT INTO `proc` (`cod`, `cod_req`, `tipo`, `assunto`, `descricao`, `setor`, `data`, `horas`) VALUES
	(25, 29, 'PE', 'aposentadoria', 'aposentadoria de scooby chato.', 1, '2017-04-21', '12:44:21');
INSERT INTO `proc` (`cod`, `cod_req`, `tipo`, `assunto`, `descricao`, `setor`, `data`, `horas`) VALUES
	(26, 31, 'PI', 'Auxílio Saúde', 'Acidente de trabalho.', 1, '2017-04-22', '10:48:18');
INSERT INTO `proc` (`cod`, `cod_req`, `tipo`, `assunto`, `descricao`, `setor`, `data`, `horas`) VALUES
	(29, 30, 'PI', 'Aposentadoria de Tom', 'Por anos de serviço duros prestados.', 2, '2017-04-23', '13:16:42');
INSERT INTO `proc` (`cod`, `cod_req`, `tipo`, `assunto`, `descricao`, `setor`, `data`, `horas`) VALUES
	(48, 23, 'PI', 'Aposentadoria', 'Só daqui vinte anos .. sniff snifff...', 1, '2017-05-12', '10:41:18');
/*!40000 ALTER TABLE `proc` ENABLE KEYS */;

-- Copiando estrutura para tabela prot.recebimento
CREATE TABLE IF NOT EXISTS `recebimento` (
  `cod` int(11) NOT NULL AUTO_INCREMENT,
  `cod_proc` int(11) DEFAULT NULL,
  `cod_req` int(11) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `horas` time DEFAULT NULL,
  `responsavel` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`cod`),
  KEY `cod_proc` (`cod_proc`),
  KEY `cod_req` (`cod_req`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela prot.recebimento: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `recebimento` DISABLE KEYS */;
/*!40000 ALTER TABLE `recebimento` ENABLE KEYS */;

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
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Copiando dados para a tabela prot.req: 11 rows
/*!40000 ALTER TABLE `req` DISABLE KEYS */;
INSERT INTO `req` (`cod`, `nome`, `tipo`, `cpf`, `sexo`, `tel`, `cel`, `rec`, `email`) VALUES
	(23, 'Jaquison Quintão Leandro', 'S', '189.903.888-48', 'M', '1338218542', '(13)98224-9408', '(13)98180-5044', 'jackqlean@gmail.com');
INSERT INTO `req` (`cod`, `nome`, `tipo`, `cpf`, `sexo`, `tel`, `cel`, `rec`, `email`) VALUES
	(19, 'Letícia de Oliveira Ferreira Leandro', 'F', '189.903.888-48', 'M', '(13)3821-6117', '(13)99612-9793', '(13)98180-5044', 'leleolive@hotmail.com');
INSERT INTO `req` (`cod`, `nome`, `tipo`, `cpf`, `sexo`, `tel`, `cel`, `rec`, `email`) VALUES
	(24, 'Melissa', 'F', '189.903.888-48', 'F', '(13)3821-8542', '', '', 'melissa@gmail.com');
INSERT INTO `req` (`cod`, `nome`, `tipo`, `cpf`, `sexo`, `tel`, `cel`, `rec`, `email`) VALUES
	(26, 'Joana S/A', 'J', '189.903.888-48', 'M', '(13)3821-8542', '(13)98224-9408', '(13)98180-5044', 'joana@msn.com');
INSERT INTO `req` (`cod`, `nome`, `tipo`, `cpf`, `sexo`, `tel`, `cel`, `rec`, `email`) VALUES
	(29, 'Miguel Santos Rosa', 'F', '189.903.888-48', 'F', '(13)3821-8542', '(13)99612-9793', '(13)98180-5044', 'miguel.santos@gmail.com');
INSERT INTO `req` (`cod`, `nome`, `tipo`, `cpf`, `sexo`, `tel`, `cel`, `rec`, `email`) VALUES
	(30, 'Aurea Aparecida Alves Pinze', 'F', '189.903.888-48', 'F', '(13)3821-8542', '(13)97913-3996', '', 'pinze7@hotmail.com');
INSERT INTO `req` (`cod`, `nome`, `tipo`, `cpf`, `sexo`, `tel`, `cel`, `rec`, `email`) VALUES
	(31, 'Emerson José Quintão Leandro', 'S', '189.903.888-48', 'M', '(13)38218542', '(13)38218542', '(13)98112-5045', 'emersonjql@gmail.com');
INSERT INTO `req` (`cod`, `nome`, `tipo`, `cpf`, `sexo`, `tel`, `cel`, `rec`, `email`) VALUES
	(32, 'Maria Joaquina', 'F', '189.903.888-48', 'F', '+551338218542', '1338218542', '(13)98112-5045', 'mariajoaquina@gmail.com');
INSERT INTO `req` (`cod`, `nome`, `tipo`, `cpf`, `sexo`, `tel`, `cel`, `rec`, `email`) VALUES
	(33, 'João de Oliveira', 'F', '189.903.888-48', 'M', '(13)3821-6655', '1338218542', '(13)98112-5045', 'joaoliveira@gmail.com');
INSERT INTO `req` (`cod`, `nome`, `tipo`, `cpf`, `sexo`, `tel`, `cel`, `rec`, `email`) VALUES
	(34, 'Olavo de Almeida', 'F', '189.903.888-48', 'M', '(13)3821-8542', '(13)97913-3996', '(13)98112-5045', 'olavo@gmail.com');
INSERT INTO `req` (`cod`, `nome`, `tipo`, `cpf`, `sexo`, `tel`, `cel`, `rec`, `email`) VALUES
	(35, 'Cristiane de Oliveira', 'F', '189.903.888-48', 'F', '(13)3821-8542', '(13)97913-3996', '(13)98112-5045', 'cristianeoliveira@hotmail.com');
/*!40000 ALTER TABLE `req` ENABLE KEYS */;

-- Copiando estrutura para tabela prot.setor
CREATE TABLE IF NOT EXISTS `setor` (
  `cod_setor` int(11) NOT NULL AUTO_INCREMENT,
  `setor` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cod_setor`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela prot.setor: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `setor` DISABLE KEYS */;
INSERT INTO `setor` (`cod_setor`, `setor`) VALUES
	(1, 'Administração');
INSERT INTO `setor` (`cod_setor`, `setor`) VALUES
	(2, 'Tesouraria');
INSERT INTO `setor` (`cod_setor`, `setor`) VALUES
	(3, 'Jurídico');
INSERT INTO `setor` (`cod_setor`, `setor`) VALUES
	(4, 'Previdenciário');
INSERT INTO `setor` (`cod_setor`, `setor`) VALUES
	(6, 'Contabilidade');
/*!40000 ALTER TABLE `setor` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
