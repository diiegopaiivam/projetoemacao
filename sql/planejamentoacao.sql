-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 19-Nov-2019 às 11:02
-- Versão do servidor: 10.1.37-MariaDB
-- versão do PHP: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `planejamentoacao`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `ameaca`
--

CREATE TABLE `ameaca` (
  `idameaca` int(11) NOT NULL,
  `ameaca` varchar(100) NOT NULL,
  `idsumario` int(11) NOT NULL,
  `idanalise` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `ameaca`
--

INSERT INTO `ameaca` (`idameaca`, `ameaca`, `idsumario`, `idanalise`) VALUES
(1, 'vish', 76, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `analise`
--

CREATE TABLE `analise` (
  `idanalise` int(11) NOT NULL,
  `idsumario` int(11) NOT NULL,
  `emissao` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `analise`
--

INSERT INTO `analise` (`idanalise`, `idsumario`, `emissao`) VALUES
(3, 76, '2019-11-18 21:33:35');

-- --------------------------------------------------------

--
-- Estrutura da tabela `controle`
--

CREATE TABLE `controle` (
  `idcontrole` int(11) NOT NULL,
  `idsumario` int(11) NOT NULL,
  `idobjetivo` int(11) NOT NULL,
  `perspectiva` varchar(100) DEFAULT NULL,
  `indicadores` varchar(100) DEFAULT NULL,
  `meta` varchar(200) DEFAULT NULL,
  `acoes` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `estrategia`
--

CREATE TABLE `estrategia` (
  `idestrategia` int(11) NOT NULL,
  `idsumario` int(11) NOT NULL,
  `idobjetivo` int(11) NOT NULL,
  `local` varchar(100) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `responsavel` varchar(100) DEFAULT NULL,
  `valor` float DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `forca`
--

CREATE TABLE `forca` (
  `idforca` int(11) NOT NULL,
  `forca` varchar(100) NOT NULL,
  `idsumario` int(11) NOT NULL,
  `idanalise` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `forca`
--

INSERT INTO `forca` (`idforca`, `forca`, `idsumario`, `idanalise`) VALUES
(1, 'falta', 76, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `fraqueza`
--

CREATE TABLE `fraqueza` (
  `idfraqueza` int(11) NOT NULL,
  `fraqueza` varchar(100) NOT NULL,
  `idsumario` int(11) NOT NULL,
  `idanalise` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `fraqueza`
--

INSERT INTO `fraqueza` (`idfraqueza`, `fraqueza`, `idsumario`, `idanalise`) VALUES
(1, 'tem', 76, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `objetivo`
--

CREATE TABLE `objetivo` (
  `idobjetivo` int(11) NOT NULL,
  `objetivo` varchar(100) NOT NULL,
  `idsumario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `objetivo`
--

INSERT INTO `objetivo` (`idobjetivo`, `objetivo`, `idsumario`) VALUES
(2, 'teste 1', 76),
(3, 'testando pela terceira vez', 76);

-- --------------------------------------------------------

--
-- Estrutura da tabela `oportunidade`
--

CREATE TABLE `oportunidade` (
  `idoportunidade` int(11) NOT NULL,
  `oportunidade` varchar(100) NOT NULL,
  `idsumario` int(11) NOT NULL,
  `idanalise` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `oportunidade`
--

INSERT INTO `oportunidade` (`idoportunidade`, `oportunidade`, `idsumario`, `idanalise`) VALUES
(1, 'muita', 76, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `sumarioexecutivo`
--

CREATE TABLE `sumarioexecutivo` (
  `idsum` int(11) NOT NULL,
  `emissao` datetime NOT NULL,
  `nomeplanejamento` varchar(45) NOT NULL,
  `cnpj` varchar(30) NOT NULL,
  `razaosocial` varchar(100) NOT NULL,
  `nomefantasia` varchar(100) NOT NULL,
  `segmento` varchar(45) NOT NULL,
  `capitaosocial` float DEFAULT NULL,
  `endereco` varchar(100) DEFAULT NULL,
  `missao` varchar(260) DEFAULT NULL,
  `visao` varchar(260) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `sumarioexecutivo`
--

INSERT INTO `sumarioexecutivo` (`idsum`, `emissao`, `nomeplanejamento`, `cnpj`, `razaosocial`, `nomefantasia`, `segmento`, `capitaosocial`, `endereco`, `missao`, `visao`) VALUES
(76, '2019-11-18 21:33:35', 'Terceiro planejamento', '1111111222222', 'Raquel Barra', 'LaBarra', 'Informática', 909092000000, 'Avenida Presidente Costa e Silva', '', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `valor`
--

CREATE TABLE `valor` (
  `idvalor` int(11) NOT NULL,
  `valor` varchar(100) NOT NULL,
  `idsumario` int(11) NOT NULL,
  `emissao` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ameaca`
--
ALTER TABLE `ameaca`
  ADD PRIMARY KEY (`idameaca`);

--
-- Indexes for table `analise`
--
ALTER TABLE `analise`
  ADD PRIMARY KEY (`idanalise`);

--
-- Indexes for table `controle`
--
ALTER TABLE `controle`
  ADD PRIMARY KEY (`idcontrole`);

--
-- Indexes for table `estrategia`
--
ALTER TABLE `estrategia`
  ADD PRIMARY KEY (`idestrategia`);

--
-- Indexes for table `forca`
--
ALTER TABLE `forca`
  ADD PRIMARY KEY (`idforca`);

--
-- Indexes for table `fraqueza`
--
ALTER TABLE `fraqueza`
  ADD PRIMARY KEY (`idfraqueza`);

--
-- Indexes for table `objetivo`
--
ALTER TABLE `objetivo`
  ADD PRIMARY KEY (`idobjetivo`);

--
-- Indexes for table `oportunidade`
--
ALTER TABLE `oportunidade`
  ADD PRIMARY KEY (`idoportunidade`);

--
-- Indexes for table `sumarioexecutivo`
--
ALTER TABLE `sumarioexecutivo`
  ADD PRIMARY KEY (`idsum`);

--
-- Indexes for table `valor`
--
ALTER TABLE `valor`
  ADD PRIMARY KEY (`idvalor`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ameaca`
--
ALTER TABLE `ameaca`
  MODIFY `idameaca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `analise`
--
ALTER TABLE `analise`
  MODIFY `idanalise` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `controle`
--
ALTER TABLE `controle`
  MODIFY `idcontrole` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `estrategia`
--
ALTER TABLE `estrategia`
  MODIFY `idestrategia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `forca`
--
ALTER TABLE `forca`
  MODIFY `idforca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `fraqueza`
--
ALTER TABLE `fraqueza`
  MODIFY `idfraqueza` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `objetivo`
--
ALTER TABLE `objetivo`
  MODIFY `idobjetivo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `oportunidade`
--
ALTER TABLE `oportunidade`
  MODIFY `idoportunidade` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sumarioexecutivo`
--
ALTER TABLE `sumarioexecutivo`
  MODIFY `idsum` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `valor`
--
ALTER TABLE `valor`
  MODIFY `idvalor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
