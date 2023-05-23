-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 23-Maio-2023 às 21:28
-- Versão do servidor: 8.0.31
-- versão do PHP: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `usuarios`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `protocolo`
--

DROP TABLE IF EXISTS `protocolo`;
CREATE TABLE IF NOT EXISTS `protocolo` (
  `NOME_DEMANDANTE` varchar(220) COLLATE utf8mb4_general_ci NOT NULL,
  `NUMERO` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `DESCRICAO` varchar(999) COLLATE utf8mb4_general_ci NOT NULL,
  `DATA` date NOT NULL,
  `PRAZO` date NOT NULL,
  `NUMERO_PROTOCOLO` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`NUMERO_PROTOCOLO`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `protocolo`
--

INSERT INTO `protocolo` (`NOME_DEMANDANTE`, `NUMERO`, `DESCRICAO`, `DATA`, `PRAZO`, `NUMERO_PROTOCOLO`) VALUES
('Kahuan Vitelli', '', 'VAMOS VER SE ESTA FUNCIONANDO ISSO', '2022-07-22', '2022-07-23', 1),
('Siany Cristina da Silva', '981350703', 'VAMOS VER SE ESTA FUNCIONANDO ISSO', '2022-07-22', '2022-07-23', 8),
('Siany Cristina da Silva', '981350703', 'osdfyhugnsdmfhbsdfgmhkdefsghdfghdfgh', '2022-07-22', '2022-07-23', 9),
('Kahuan Vitelli', '981350703', 'osdfyhugnsdmfhbsdfgmhkdefsghdfghdfgh', '2022-07-22', '2022-07-23', 10),
('Kahuan Vitelli', '981350703', 'osdfyhugnsdmfhbsdfgmhkdefsghdfghdfgh', '2022-07-22', '2022-07-23', 11),
('Kahuan Vitelli', '981350703', 'osdfyhugnsdmfhbsdfgmhkdefsghdfghdfgh', '2022-07-22', '2022-07-23', 12),
('Joana Gomes da Silva', '5198190429', 'ADSFOHGYNADSFGK\'', '2022-07-22', '2022-07-23', 13),
('Kahuan Vitelli', '981350703', 'osdfyhugnsdmfhbsdfgmhkdefsghdfghdfgh', '2022-07-22', '2022-07-23', 14),
('Kahuan Vitelli', '981350703', 'VAMO VER ESSE TESTE AI', '1970-01-01', '0000-00-00', 15),
('Kahuan Vitelli', '981350703', 'VAMOS VER SE ESTA FUNCIONANDO ISSO', '2022-07-22', '0000-00-00', 16),
('Kahuan Vitelli', '81', 'VAMO VER ESSE TESTE AI', '2022-07-22', '1985-07-22', 17),
('Kahuan Vitelli', '981350703', 'osdfyhugnsdmfhbsdfgmhkdefsghdfghdfgh', '2022-07-22', '2022-07-23', 18),
('Kahuan Vitelli', '12313', 'VAMOS VER SE ESTA FUNCIONANDO ISSO', '2022-07-22', '2023-09-22', 19);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `NOME` varchar(220) COLLATE utf8mb4_general_ci NOT NULL,
  `DATA_NASCIMENTO` date NOT NULL,
  `CPF` varchar(14) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `SEXO` varchar(1) COLLATE utf8mb4_general_ci NOT NULL,
  `CIDADE` varchar(220) COLLATE utf8mb4_general_ci NOT NULL,
  `BAIRRO` varchar(220) COLLATE utf8mb4_general_ci NOT NULL,
  `RUA` varchar(220) COLLATE utf8mb4_general_ci NOT NULL,
  `NUMERO` int NOT NULL,
  `COMPLEMENTO` varchar(220) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(220) COLLATE utf8mb4_general_ci NOT NULL,
  `senha` varchar(220) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`ID`,`CPF`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `senha` (`senha`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`ID`, `NOME`, `DATA_NASCIMENTO`, `CPF`, `SEXO`, `CIDADE`, `BAIRRO`, `RUA`, `NUMERO`, `COMPLEMENTO`, `email`, `senha`) VALUES
(21, 'Kahuan Vitelli', '2004-07-22', '030.305.822-64', 'M', 'São Leopoldo', 'campina', 'formosa', 81, 'casa', 'kahuanvitelli@gmail.com', '81505274kurt'),
(22, 'Kahuan Vitelli', '2004-07-22', '030.305.822-61', 'M', 'São Leopoldo', 'campina', 'formosa', 81, 'casa', 'kahuanedicoes@gmail.com', '81505274kurt!'),
(23, 'Kahuan Vitelli', '0000-00-00', '030.305.822-65', 'M', 'São Leopoldo', 'campina', 'formosa', 81, 'casa', 'kahuanvitelli@gmail.com.br', '81505274kurt!11'),
(24, 'Siany Cristina da Silva', '0000-00-00', '030.305.822-71', 'F', 'São Leopoldo', 'campina', 'formosa', 81, 'casa', 'jojana@gameplays.com', '81505274kurr'),
(26, 'Siany Cristina da Silva', '0000-00-00', '030.305.822-31', 'F', 'São Leopoldo', 'campina', 'formosa', 81, 'casa', 'fasdfasdfasd@gmail.com', '123412341234'),
(27, 'Joana Gomes da Silva', '2005-05-14', '85425222068', 'F', 'São Leopoldo', 'Santo André', 'Avenida Tharcilo Nunes', 262, 'Casa', 'joanagomes1405@gmail.com', '12345');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
