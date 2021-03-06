-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Máquina: 127.0.0.1
-- Data de Criação: 07-Set-2013 às 05:12
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
  `IDAMIGO` int(11) NOT NULL AUTO_INCREMENT,
  `IDPESSOA` int(11) NOT NULL,
  `IDPESSOA_AMIGO` int(11) NOT NULL,
  PRIMARY KEY (`IDAMIGO`),
  KEY `FK_AMIGO_IDPESSOA` (`IDPESSOA`),
  KEY `FK_AMIGO_IDPESSOA_AMIGO` (`IDPESSOA_AMIGO`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `mensagem`
--

CREATE TABLE IF NOT EXISTS `mensagem` (
  `IDMENSAGEM` int(11) NOT NULL AUTO_INCREMENT,
  `IDPESSOA_ENVIO` int(11) NOT NULL,
  `IDPESSOA_RECEB` int(11) NOT NULL,
  `DATA_HORA` datetime NOT NULL,
  `MENSAGEM` varchar(200) NOT NULL,
  PRIMARY KEY (`IDMENSAGEM`),
  KEY `FK_MESAGEM_IDPESSOA_ENVIO_idx` (`IDPESSOA_ENVIO`),
  KEY `FK_MENSAGEM_IDPESSOA_RECEB_idx` (`IDPESSOA_RECEB`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoa`
--

CREATE TABLE IF NOT EXISTS `pessoa` (
  `IDPESSOA` int(11) NOT NULL AUTO_INCREMENT,
  `NOME` varchar(45) NOT NULL,
  `SOBRENOME` varchar(60) NOT NULL,
  `DATA_NASCIMENTO` date NOT NULL,
  `LOGIN` varchar(15) NOT NULL,
  `SENHA` varchar(100) NOT NULL,
  `EMAIL` varchar(100) NOT NULL,
  `AUTO_DEFINICAO` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`IDPESSOA`),
  UNIQUE KEY `LOGIN` (`LOGIN`),
  KEY `NOME` (`NOME`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `publicacao`
--

CREATE TABLE IF NOT EXISTS `publicacao` (
  `IDPUBLICACAO` int(11) NOT NULL AUTO_INCREMENT,
  `IDPESSOA` int(11) DEFAULT NULL,
  `DATA_HORA` datetime DEFAULT NULL,
  `PUBLICACAO` longtext,
  PRIMARY KEY (`IDPUBLICACAO`),
  KEY `FK_PUBLICAO_IDPESSOA_idx` (`IDPESSOA`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `amigo`
--
ALTER TABLE `amigo`
  ADD CONSTRAINT `FK_AMIGO_IDPESSOA` FOREIGN KEY (`IDPESSOA`) REFERENCES `pessoa` (`IDPESSOA`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_AMIGO_IDPESSOA_AMIGO` FOREIGN KEY (`IDPESSOA_AMIGO`) REFERENCES `pessoa` (`IDPESSOA`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Limitadores para a tabela `mensagem`
--
ALTER TABLE `mensagem`
  ADD CONSTRAINT `FK_MENSAGEM_IDPESSOA_RECEB` FOREIGN KEY (`IDPESSOA_RECEB`) REFERENCES `pessoa` (`IDPESSOA`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_MESAGEM_IDPESSOA_ENVIO` FOREIGN KEY (`IDPESSOA_ENVIO`) REFERENCES `pessoa` (`IDPESSOA`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Limitadores para a tabela `publicacao`
--
ALTER TABLE `publicacao`
  ADD CONSTRAINT `FK_PUBLICAO_IDPESSOA` FOREIGN KEY (`IDPESSOA`) REFERENCES `pessoa` (`IDPESSOA`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
