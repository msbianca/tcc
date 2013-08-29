-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Máquina: 127.0.0.1
-- Data de Criação: 29-Ago-2013 às 20:07
-- Versão do servidor: 5.6.11
-- versão do PHP: 5.5.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de Dados: `social_network`
--
CREATE DATABASE IF NOT EXISTS `social_network` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `social_network`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `amigo`
--

CREATE TABLE IF NOT EXISTS `amigo` (
  `IDAMIGO` int(11) NOT NULL,
  `IDPESSOA` int(11) NOT NULL,
  `IDPESSOA_AMIGO` int(11) NOT NULL,
  `STATUS` enum('Amigos','Aguardando Aprovação') NOT NULL,
  PRIMARY KEY (`IDAMIGO`),
  KEY `FK_AMIGO_IDPESSOA_idx` (`IDPESSOA`),
  KEY `FK_AMIGO_IDPESSOA_AMIGO_idx` (`IDPESSOA_AMIGO`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `mensagem`
--

CREATE TABLE IF NOT EXISTS `mensagem` (
  `IDMENSAGEM` int(11) NOT NULL,
  `IDPESSOA_ENVIO` int(11) NOT NULL,
  `IDPESSOA_RECEB` int(11) NOT NULL,
  `DATA_HORA` datetime NOT NULL,
  `MENSAGEM` varchar(200) NOT NULL,
  PRIMARY KEY (`IDMENSAGEM`),
  KEY `FK_MESAGEM_IDPESSOA_ENVIO_idx` (`IDPESSOA_ENVIO`),
  KEY `FK_MENSAGEM_IDPESSOA_RECEB_idx` (`IDPESSOA_RECEB`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoa`
--

CREATE TABLE IF NOT EXISTS `pessoa` (
  `IDPESSOA` int(11) NOT NULL,
  `NOME` varchar(45) NOT NULL,
  `SOBRENOME` varchar(60) NOT NULL,
  `ATIVO` tinyint(1) NOT NULL,
  `FOTO` blob,
  `DATA_NASCIMENTO` date NOT NULL,
  `LOGIN` varchar(15) NOT NULL,
  `SENHA` varchar(100) NOT NULL,
  `EMAIL` varchar(100) NOT NULL,
  `AUTO_DEFINICAO` varchar(200) DEFAULT NULL,
  `GENERO` enum('Masculino','Feminino') NOT NULL,
  `STATUS_RELAC` enum('Solteiro(a)','Namorando(a)','Noivo(a)','Casado(a)','Viúvo(a)','Separado(a)','Divorciado(a)') NOT NULL,
  `INTERESSADO_EM_H` tinyint(1) NOT NULL,
  `INTERESSAO_EM_F` tinyint(1) NOT NULL,
  `TOTAL_AMIGOS` int(11) NOT NULL,
  PRIMARY KEY (`IDPESSOA`),
  UNIQUE KEY `LOGIN` (`LOGIN`),
  KEY `NOME` (`NOME`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `pessoa`
--

INSERT INTO `pessoa` (`IDPESSOA`, `NOME`, `SOBRENOME`, `ATIVO`, `FOTO`, `DATA_NASCIMENTO`, `LOGIN`, `SENHA`, `EMAIL`, `AUTO_DEFINICAO`, `GENERO`, `STATUS_RELAC`, `INTERESSADO_EM_H`, `INTERESSAO_EM_F`, `TOTAL_AMIGOS`) VALUES
(1, 'Alex', 'Malmann Becker', 0, NULL, '0000-00-00', 'alex_porthal', '123', 'alex@porthal.com.br', NULL, 'Masculino', 'Solteiro(a)', 0, 1, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `publicacao`
--

CREATE TABLE IF NOT EXISTS `publicacao` (
  `IDPUBLICACAO` int(11) NOT NULL,
  `IDPESSOA` int(11) DEFAULT NULL,
  `DATA_HORA` datetime DEFAULT NULL,
  `PUBLICACAO` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`IDPUBLICACAO`),
  KEY `FK_PUBLICAO_IDPESSOA_idx` (`IDPESSOA`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `amigo`
--
ALTER TABLE `amigo`
  ADD CONSTRAINT `FK_AMIGO_IDPESSOA` FOREIGN KEY (`IDPESSOA`) REFERENCES `mydb`.`pessoa` (`IDPESSOA`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_AMIGO_IDPESSOA_AMIGO` FOREIGN KEY (`IDPESSOA_AMIGO`) REFERENCES `mydb`.`pessoa` (`IDPESSOA`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `mensagem`
--
ALTER TABLE `mensagem`
  ADD CONSTRAINT `FK_MENSAGEM_IDPESSOA_RECEB` FOREIGN KEY (`IDPESSOA_RECEB`) REFERENCES `mydb`.`pessoa` (`IDPESSOA`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_MESAGEM_IDPESSOA_ENVIO` FOREIGN KEY (`IDPESSOA_ENVIO`) REFERENCES `mydb`.`pessoa` (`IDPESSOA`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Limitadores para a tabela `publicacao`
--
ALTER TABLE `publicacao`
  ADD CONSTRAINT `FK_PUBLICAO_IDPESSOA` FOREIGN KEY (`IDPESSOA`) REFERENCES `mydb`.`pessoa` (`IDPESSOA`) ON DELETE NO ACTION ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
