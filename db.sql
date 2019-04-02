-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 02-Abr-2019 às 21:03
-- Versão do servidor: 5.7.21
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cakeladelivery`
--
CREATE DATABASE IF NOT EXISTS `cakeladelivery` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `cakeladelivery`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `alteracao_senhas`
--

DROP TABLE IF EXISTS `alteracao_senhas`;
CREATE TABLE IF NOT EXISTS `alteracao_senhas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `token` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `validade` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `usado` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `alteracao_senhas`
--

INSERT INTO `alteracao_senhas` (`id`, `user_id`, `token`, `validade`, `usado`) VALUES
(1, 8, 'LA201903130420170426812001552504817DEV54851054', '2019-03-13 19:20:18', 0),
(2, 8, 'LA201903130428520913905001552505332DEV87135530', '2019-03-16 16:28:53', 0),
(3, 8, 'LA201903130431390881918001552505499DEV98718359', '2019-03-16 16:31:40', 0),
(4, 16, 'LA201903130432270193464001552505547DEV83064079', '2019-03-16 16:32:27', 0),
(5, 8, 'LA201903130433120701996001552505592DEV81203759', '2019-03-16 16:33:12', 0),
(6, 8, 'LA201903130523410625990001552508621DEV12508884', '2019-03-16 17:23:42', 0),
(7, 8, 'LA201903130524040380986001552508644DEV77282234', '2019-03-16 17:24:04', 0),
(8, 8, 'LA201903130525190666554001552508719DEV14147486', '2019-03-16 17:25:19', 0),
(9, 8, 'LA201903130526290968416001552508789DEV76921375', '2019-03-16 17:26:30', 0),
(10, 8, 'LA201903130527440376391001552508864DEV73528013', '2019-03-16 17:27:44', 0),
(11, 8, 'LA201903130529370800914001552508977DEV26731828', '2019-03-16 17:29:38', 0),
(12, 8, 'LA201903130531130748392001552509073DEV64116838', '2019-03-16 17:31:13', 0),
(13, 8, 'LA201903130532030913003001552509123DEV43152506', '2019-03-16 17:32:03', 0),
(14, 8, 'LA201903130533240041654001552509204DEV31955176', '2019-03-16 17:33:24', 0),
(15, 8, 'LA201903130533570579593001552509237DEV80232391', '2019-03-16 17:33:57', 0),
(16, 8, 'LA201903130539200244099001552509560DEV82635612', '2019-03-16 17:39:20', 0),
(17, 8, 'LA201903130608320663834001552511312DEV63116775', '2019-03-16 18:08:32', 0),
(18, 8, 'LA201903130609430531140001552511383DEV94312641', '2019-03-16 18:09:43', 0),
(19, 16, 'LA201903150717550233957001552688275DEV52052338', '2019-03-18 19:17:55', 0),
(20, 8, 'LA201903150718100136836001552688290DEV77973543', '2019-03-18 16:39:10', 0),
(21, 8, 'LA201903281039050539801001553823545DEV42160703', '2019-03-31 22:39:05', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `banners`
--

DROP TABLE IF EXISTS `banners`;
CREATE TABLE IF NOT EXISTS `banners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `midia_id` int(11) DEFAULT NULL,
  `ativo` tinyint(1) NOT NULL,
  `nome_banner` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `midia_id` (`midia_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `banners`
--

INSERT INTO `banners` (`id`, `midia_id`, `ativo`, `nome_banner`) VALUES
(1, 34, 0, 'Promo natal');

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias_produtos`
--

DROP TABLE IF EXISTS `categorias_produtos`;
CREATE TABLE IF NOT EXISTS `categorias_produtos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `empresa_id` int(11) NOT NULL,
  `midia_id` int(11) DEFAULT NULL,
  `nome_categoria` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `descricao_categoria` text COLLATE utf8_unicode_ci,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `midia_id` (`midia_id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `categorias_produtos`
--

INSERT INTO `categorias_produtos` (`id`, `empresa_id`, `midia_id`, `nome_categoria`, `descricao_categoria`, `created`, `modified`) VALUES
(20, 2, NULL, 'Bebidas', 'Bebidas Geladinhas', '2019-03-08 17:20:14', '2019-04-02 17:27:28'),
(22, 2, NULL, 'Pizzas', 'Pizzas do Bonna', '2019-03-08 17:20:52', '2019-04-02 17:27:34'),
(23, 2, NULL, 'Doces', 'Doces', '2019-03-08 17:21:05', '2019-04-02 17:30:54'),
(24, 2, NULL, 'Hambúrgueres', 'Hambúrgueres', '2019-03-08 17:28:11', '2019-04-02 17:27:45');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cupom_site`
--

DROP TABLE IF EXISTS `cupom_site`;
CREATE TABLE IF NOT EXISTS `cupom_site` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `empresa_id` int(11) NOT NULL,
  `nome_cupom` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `vezes_usado` int(11) DEFAULT NULL,
  `maximo_vezes_usar` int(11) NOT NULL,
  `valor_desconto` int(11) NOT NULL,
  `porcentagem` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `dias_fechados`
--

DROP TABLE IF EXISTS `dias_fechados`;
CREATE TABLE IF NOT EXISTS `dias_fechados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `empresa_id` int(11) NOT NULL,
  `dia_fechado` date NOT NULL,
  `motivo_fechado` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `dias_fechados`
--

INSERT INTO `dias_fechados` (`id`, `empresa_id`, `dia_fechado`, `motivo_fechado`) VALUES
(1, 2, '2019-03-30', 'caguei quero dormir');

-- --------------------------------------------------------

--
-- Estrutura da tabela `empresas`
--

DROP TABLE IF EXISTS `empresas`;
CREATE TABLE IF NOT EXISTS `empresas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome_fantasia` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `cnpj` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ie` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ativa` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_empresa_cnpj` (`cnpj`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `empresas`
--

INSERT INTO `empresas` (`id`, `nome_fantasia`, `cnpj`, `ie`, `ativa`) VALUES
(1, 'Baiucas Lanches', '05.700.549/0001-02', '795.636.423', 1),
(2, 'LaDelivery', '1234546789', '123456709', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `enderecos`
--

DROP TABLE IF EXISTS `enderecos`;
CREATE TABLE IF NOT EXISTS `enderecos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `rua` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `numero` int(11) DEFAULT NULL,
  `bairro` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `cidade` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `estado` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cep` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `complemento` varchar(600) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `enderecos`
--

INSERT INTO `enderecos` (`id`, `user_id`, `rua`, `numero`, `bairro`, `cidade`, `estado`, `cep`, `complemento`) VALUES
(15, 20, 'Luiz rigo', 143, 'Ponto chic', 'Ibirama', 'SC', '89140-000', 'Casa com muro de pedra bruta na frente'),
(16, 16, 'Luiz rigo', 143, 'Ponto chic', 'Ibirama', 'SC', '89140-000', 'Casa com muro de pedra bruta na frente'),
(17, 8, 'Luiz rigo', 143, 'Ponto Chic', 'Ibirama', 'SC', '89140-000', 'Casa com muro de pedra bruta na frente'),
(18, 8, '13 de Maio', 896, 'Centro', 'Jose Boiteux', 'SC', '89145000', 'Casa '),
(21, 16, 'Dr. Getulio Vargas', 2875, 'Bela Vista', 'Ibirama', 'SC', '89140000', 'Em frente a UDESC'),
(22, 16, 'Dr. Getulio Vargas', 112, 'aassdsd', 'Ibiramaas', 'SC', '89140000', 'sdsad');

-- --------------------------------------------------------

--
-- Estrutura da tabela `enderecos_empresas`
--

DROP TABLE IF EXISTS `enderecos_empresas`;
CREATE TABLE IF NOT EXISTS `enderecos_empresas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `empresa_id` int(11) NOT NULL,
  `rua` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `numero` int(11) NOT NULL,
  `bairro` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `cidade` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `estado` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cep` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_empresa_id_endereco` (`empresa_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `enderecos_empresas`
--

INSERT INTO `enderecos_empresas` (`id`, `empresa_id`, `rua`, `numero`, `bairro`, `cidade`, `estado`, `cep`) VALUES
(1, 2, 'Luiz Rigo', 143, 'Ponto chic', 'Ibirama', 'SC', '89140000'),
(2, 1, 'Dr. Getulio Vargas', 2875, 'Bela Vista', 'Ibirama', 'SC', '89140000');

-- --------------------------------------------------------

--
-- Estrutura da tabela `formas_pagamentos`
--

DROP TABLE IF EXISTS `formas_pagamentos`;
CREATE TABLE IF NOT EXISTS `formas_pagamentos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `empresa_id` int(11) NOT NULL,
  `nome` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `necesista_maquina_cartao` tinyint(1) NOT NULL,
  `necessita_troco` tinyint(1) NOT NULL,
  `aumenta_valor` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_nome_forma_pagamento` (`nome`),
  KEY `empresa_id` (`empresa_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `formas_pagamentos`
--

INSERT INTO `formas_pagamentos` (`id`, `empresa_id`, `nome`, `necesista_maquina_cartao`, `necessita_troco`, `aumenta_valor`) VALUES
(1, 1, 'Dinheiro', 0, 1, '0.00'),
(2, 1, 'Cartão Crédito', 1, 0, '5.00'),
(4, 1, 'Cartão Débito', 1, 0, '2.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `google_maps_api_key`
--

DROP TABLE IF EXISTS `google_maps_api_key`;
CREATE TABLE IF NOT EXISTS `google_maps_api_key` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `empresa_id` int(11) NOT NULL,
  `api_key` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `ativa` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `google_maps_api_key`
--

INSERT INTO `google_maps_api_key` (`id`, `empresa_id`, `api_key`, `ativa`) VALUES
(1, 1, 'AIzaSyBOfZCfy02ny8dk3LMcXOWtFuiDpqX1Qdw', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `horarios_atendimentos`
--

DROP TABLE IF EXISTS `horarios_atendimentos`;
CREATE TABLE IF NOT EXISTS `horarios_atendimentos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `empresa_id` int(11) NOT NULL,
  `dia_semana` int(11) NOT NULL,
  `turno` int(11) NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fim` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `horarios_atendimentos`
--

INSERT INTO `horarios_atendimentos` (`id`, `empresa_id`, `dia_semana`, `turno`, `hora_inicio`, `hora_fim`) VALUES
(5, 1, 0, 1, '01:00:00', '23:59:00'),
(6, 1, 1, 1, '00:00:00', '23:59:00'),
(7, 1, 2, 1, '00:00:00', '23:59:00'),
(8, 1, 3, 1, '00:00:00', '23:59:00'),
(9, 1, 4, 1, '00:00:00', '23:59:00'),
(10, 1, 5, 1, '00:00:00', '23:59:00'),
(11, 1, 6, 1, '00:00:00', '23:59:00'),
(12, 2, 0, 1, '09:42:00', '09:42:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `itens_carrinhos`
--

DROP TABLE IF EXISTS `itens_carrinhos`;
CREATE TABLE IF NOT EXISTS `itens_carrinhos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `quantidades` int(11) NOT NULL,
  `valor_total_cobrado` decimal(10,2) NOT NULL,
  `observacao` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `opicionais` json DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `itens_carrinhos`
--

INSERT INTO `itens_carrinhos` (`id`, `user_id`, `produto_id`, `quantidades`, `valor_total_cobrado`, `observacao`, `opicionais`) VALUES
(16, 8, 62, 1, '55.00', '', '\"[]\"');

-- --------------------------------------------------------

--
-- Estrutura da tabela `listas`
--

DROP TABLE IF EXISTS `listas`;
CREATE TABLE IF NOT EXISTS `listas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `empresa_id` int(11) NOT NULL,
  `nome_lista` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `descricao_lista` text COLLATE utf8_unicode_ci NOT NULL,
  `titulo_lista` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `max_opcoes_selecionadas_lista` int(11) DEFAULT NULL,
  `min_opcoes_selecionadas_lista` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=117 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `listas`
--

INSERT INTO `listas` (`id`, `empresa_id`, `nome_lista`, `descricao_lista`, `titulo_lista`, `max_opcoes_selecionadas_lista`, `min_opcoes_selecionadas_lista`) VALUES
(115, 1, 'Adicionais De Lanches', 'Adicionais Usados Nos Lanches Hamburgueres', 'Adicionais', 0, 0),
(116, 1, 'Sabores pizzas', 'Sabores para pizzas', 'Sabores', 3, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `listas_opcoes_extras`
--

DROP TABLE IF EXISTS `listas_opcoes_extras`;
CREATE TABLE IF NOT EXISTS `listas_opcoes_extras` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lista_id` int(11) NOT NULL,
  `opcoes_extra_id` int(11) NOT NULL,
  `ativa` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_lista_id_opcoes` (`lista_id`,`opcoes_extra_id`) USING BTREE,
  KEY `opcoes_extra_id` (`opcoes_extra_id`),
  KEY `fk_lista_id_opcao_extra` (`lista_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `listas_opcoes_extras`
--

INSERT INTO `listas_opcoes_extras` (`id`, `lista_id`, `opcoes_extra_id`, `ativa`) VALUES
(43, 115, 12, 1),
(44, 115, 13, 1),
(45, 115, 14, 1),
(46, 116, 13, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `listas_produtos`
--

DROP TABLE IF EXISTS `listas_produtos`;
CREATE TABLE IF NOT EXISTS `listas_produtos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `produto_id` int(11) NOT NULL,
  `lista_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_lista_produto` (`lista_id`,`produto_id`),
  UNIQUE KEY `unique_produto_lista` (`produto_id`,`lista_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `midias`
--

DROP TABLE IF EXISTS `midias`;
CREATE TABLE IF NOT EXISTS `midias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `empresa_id` int(11) NOT NULL,
  `tipo_midia` int(11) NOT NULL,
  `path_midia` varchar(600) COLLATE utf8_unicode_ci NOT NULL,
  `nome_midia` varchar(600) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_path_midia` (`path_midia`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `midias`
--

INSERT INTO `midias` (`id`, `empresa_id`, `tipo_midia`, `path_midia`, `nome_midia`) VALUES
(31, 2, 1, 'produtos/teste_assados.jpg', 'teste'),
(33, 2, 3, 'banners/upload_02_04_19_18_04_25_assados.jpg_assados.jpg', 'upload_02_04_19_18_04_25_assados.jpg'),
(34, 2, 3, 'banners/upload_02_04_19_18_04_34_bebidas.jpg_bebidas.jpg', 'upload_02_04_19_18_04_34_bebidas.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `opcoes_extras`
--

DROP TABLE IF EXISTS `opcoes_extras`;
CREATE TABLE IF NOT EXISTS `opcoes_extras` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `empresa_id` int(11) NOT NULL,
  `nome_adicional` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `descricao_adicional` text COLLATE utf8_unicode_ci NOT NULL,
  `valor_adicional` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `opcoes_extras`
--

INSERT INTO `opcoes_extras` (`id`, `empresa_id`, `nome_adicional`, `descricao_adicional`, `valor_adicional`) VALUES
(12, 1, 'Calabresa', '300gr Calabresa', '6.00'),
(13, 1, 'Bacon', '250gr Bacon', '6.50'),
(14, 1, 'Frango', '400gr Frango na chapa', '8.20');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
CREATE TABLE IF NOT EXISTS `pedidos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `empresa_id` int(11) NOT NULL,
  `valor_total_cobrado` decimal(10,2) NOT NULL,
  `formas_pagamento_id` int(11) DEFAULT NULL,
  `valor_acrescimo` decimal(10,2) NOT NULL DEFAULT '0.00',
  `tempo_producao_aproximado_minutos` int(11) DEFAULT NULL,
  `troco_para` decimal(10,2) NOT NULL DEFAULT '0.00',
  `tipo_pedido` int(11) NOT NULL DEFAULT '1',
  `status_pedido` int(11) NOT NULL,
  `data_pedido` datetime NOT NULL,
  `cupom_usado` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `valor_desconto` decimal(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `pedidos`
--

INSERT INTO `pedidos` (`id`, `user_id`, `empresa_id`, `valor_total_cobrado`, `formas_pagamento_id`, `valor_acrescimo`, `tempo_producao_aproximado_minutos`, `troco_para`, `tipo_pedido`, `status_pedido`, `data_pedido`, `cupom_usado`, `valor_desconto`) VALUES
(1, 16, 1, '6.50', NULL, '0.00', 45, '0.00', 2, 11, '2019-03-09 11:14:17', NULL, '0.00'),
(2, 8, 2, '6.50', 1, '0.00', 45, '0.00', 2, 12, '2019-03-09 11:23:50', NULL, '0.00'),
(3, 8, 2, '6.50', 1, '0.00', 45, '0.00', 1, 4, '2019-03-11 00:15:31', NULL, '0.00'),
(4, 8, 1, '6.50', 1, '0.00', 45, '0.00', 1, 4, '2019-03-11 00:23:57', NULL, '0.00'),
(5, 8, 2, '19.00', 2, '0.00', 45, '0.00', 1, 3, '2019-03-11 00:25:08', NULL, '0.00'),
(6, 8, 1, '25.00', 1, '0.00', 45, '0.00', 1, 4, '2019-03-11 00:28:46', NULL, '0.00'),
(7, 8, 1, '6.50', 1, '0.00', 45, '0.00', 1, 4, '2019-03-11 00:32:39', NULL, '0.00'),
(8, 8, 1, '6.50', 1, '0.00', 45, '0.00', 1, 4, '2019-03-11 00:36:03', NULL, '0.00'),
(9, 16, 1, '39.70', NULL, '0.00', 45, '0.00', 1, 11, '2019-03-11 00:41:21', NULL, '0.00'),
(10, 16, 2, '6.50', NULL, '0.00', 45, '0.00', 1, 11, '2019-03-11 00:44:31', NULL, '0.00'),
(11, 16, 1, '19.00', NULL, '0.00', 45, '0.00', 1, 11, '2019-03-11 00:54:00', NULL, '0.00'),
(12, 16, 1, '0.00', NULL, '0.00', 45, '0.00', 1, 11, '2019-03-11 00:54:04', NULL, '0.00'),
(13, 16, 1, '6.50', 1, '0.00', 45, '0.00', 1, 4, '2019-03-11 00:55:31', NULL, '0.00'),
(14, 16, 1, '19.00', 1, '0.00', 45, '0.00', 1, 4, '2019-03-11 01:11:41', 'DESCONTODE10', '2.85'),
(15, 16, 2, '19.00', 2, '0.95', 45, '0.00', 1, 4, '2019-03-11 02:32:51', 'DESCONTODE10', '2.85'),
(16, 8, 2, '58.20', 1, '0.00', 45, '15.60', 1, 4, '2019-03-11 13:53:59', 'DESCONTODE10', '8.73'),
(17, 8, 1, '33.20', 1, '0.00', 45, '50.00', 1, 4, '2019-03-11 15:04:06', 'DESCONTODE10', '4.98'),
(18, 8, 2, '59.20', NULL, '0.00', 45, '0.00', 1, 11, '2019-03-11 15:08:38', NULL, '0.00'),
(19, 8, 1, '6.50', NULL, '0.00', 45, '0.00', 1, 11, '2019-03-17 19:01:14', NULL, '0.00'),
(20, 16, 1, '6.50', NULL, '0.00', 45, '0.00', 1, 11, '2019-03-19 18:23:44', NULL, '0.00'),
(21, 16, 1, '6.50', 2, '0.33', 45, '0.00', 1, 4, '2019-03-19 18:31:14', NULL, '0.00'),
(22, 16, 1, '6.50', 1, '0.00', 45, '10.20', 1, 11, '2019-03-19 22:58:04', NULL, '0.00'),
(23, 16, 1, '6.50', NULL, '0.00', 45, '0.00', 1, 11, '2019-03-19 23:04:15', NULL, '0.00'),
(24, 16, 1, '33.20', NULL, '0.00', 45, '0.00', 1, 11, '2019-03-19 23:19:20', NULL, '0.00'),
(25, 16, 1, '6.50', 1, '0.00', 45, '10.00', 1, 11, '2019-03-21 16:44:17', NULL, '0.00'),
(26, 16, 1, '39.70', 1, '0.00', 45, '50.00', 1, 11, '2019-03-21 18:02:32', NULL, '0.00'),
(27, 16, 1, '6.50', 1, '0.00', 45, '100.00', 1, 4, '2019-03-22 19:23:44', 'DESCONTODE10', '0.98'),
(28, 16, 1, '6.50', 1, '0.00', 45, '150.00', 1, 5, '2019-03-22 19:28:39', 'DESCONTODE10', '0.98'),
(29, 16, 1, '6.50', NULL, '0.00', 45, '0.00', 1, 11, '2019-03-26 18:20:06', NULL, '0.00'),
(33, 8, 1, '19.50', NULL, '0.00', 45, '0.00', 1, 11, '2019-03-26 21:19:11', NULL, '0.00'),
(34, 8, 1, '6.50', 1, '0.00', 45, '15.20', 1, 2, '2019-03-27 16:11:44', NULL, '0.00'),
(36, 8, 1, '6.50', NULL, '0.00', 45, '0.00', 1, 11, '2019-03-27 16:25:26', NULL, '0.00'),
(37, 8, 1, '18.50', NULL, '0.00', 45, '0.00', 1, 11, '2019-03-27 16:26:09', NULL, '0.00'),
(38, 8, 1, '18.50', 2, '0.93', 45, '0.00', 1, 4, '2019-03-27 16:34:16', NULL, '0.00'),
(39, 8, 1, '183.40', 1, '0.00', 45, '200.00', 1, 4, '2019-03-27 16:44:49', NULL, '0.00'),
(40, 8, 1, '19.50', NULL, '0.00', 45, '0.00', 1, 11, '2019-03-27 17:09:34', 'LADEV', '15.00'),
(41, 8, 1, '6.50', NULL, '0.00', 45, '0.00', 1, 11, '2019-03-27 17:34:32', NULL, '0.00'),
(42, 8, 1, '6.50', NULL, '0.00', 45, '0.00', 1, 11, '2019-03-28 23:57:13', NULL, '0.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos_entregas`
--

DROP TABLE IF EXISTS `pedidos_entregas`;
CREATE TABLE IF NOT EXISTS `pedidos_entregas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pedido_id` int(11) NOT NULL,
  `valor_entrega` decimal(10,2) NOT NULL,
  `cotacao_maps` text COLLATE utf8_unicode_ci,
  `endereco_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_pedido_entrega` (`pedido_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `pedidos_entregas`
--

INSERT INTO `pedidos_entregas` (`id`, `pedido_id`, `valor_entrega`, `cotacao_maps`, `endereco_id`) VALUES
(1, 1, '8.00', '{\"distance\":{\"text\":\"4,2 km\",\"value\":4241},\"duration\":{\"text\":\"8 minutos\",\"value\":490},\"status\":\"OK\"}', 16),
(2, 11, '8.00', '{\"distance\":{\"text\":\"4,2 km\",\"value\":4241},\"duration\":{\"text\":\"8 minutos\",\"value\":490},\"status\":\"OK\"}', 16),
(3, 12, '8.00', '{\"distance\":{\"text\":\"4,2 km\",\"value\":4241},\"duration\":{\"text\":\"8 minutos\",\"value\":490},\"status\":\"OK\"}', 16),
(4, 14, '8.00', '{\"distance\":{\"text\":\"4,2 km\",\"value\":4241},\"duration\":{\"text\":\"8 minutos\",\"value\":490},\"status\":\"OK\"}', 16),
(6, 15, '8.00', '{\"distance\":{\"text\":\"4,2 km\",\"value\":4241},\"duration\":{\"text\":\"8 minutos\",\"value\":490},\"status\":\"OK\"}', 16),
(7, 18, '41.00', '{\"distance\":{\"text\":\"21,2 km\",\"value\":21162},\"duration\":{\"text\":\"29 minutos\",\"value\":1764},\"status\":\"OK\"}', 18),
(8, 23, '8.00', '{\"distance\":{\"text\":\"4,2 km\",\"value\":4241},\"duration\":{\"text\":\"8 minutos\",\"value\":490},\"status\":\"OK\"}', 16),
(9, 26, '8.00', '{\"distance\":{\"text\":\"4,2 km\",\"value\":4241},\"duration\":{\"text\":\"8 minutos\",\"value\":489},\"status\":\"OK\"}', 16),
(10, 28, '8.00', '{\"distance\":{\"text\":\"4,2 km\",\"value\":4241},\"duration\":{\"text\":\"8 minutos\",\"value\":489},\"status\":\"OK\"}', 16),
(11, 33, '10.00', '{\"status\":\"ZERO_RESULTS\"}', 17),
(12, 34, '6.00', '{\"distance\":{\"text\":\"3,5 km\",\"value\":3547},\"duration\":{\"text\":\"7 minutos\",\"value\":416},\"status\":\"OK\"}', 17),
(13, 36, '10.00', NULL, 17),
(14, 37, '6.00', '{\"distance\":{\"text\":\"3,5 km\",\"value\":3547},\"duration\":{\"text\":\"7 minutos\",\"value\":416},\"status\":\"OK\"}', 17),
(15, 38, '6.00', '{\"distance\":{\"text\":\"3,5 km\",\"value\":3547},\"duration\":{\"text\":\"7 minutos\",\"value\":416},\"status\":\"OK\"}', 17);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos_produtos`
--

DROP TABLE IF EXISTS `pedidos_produtos`;
CREATE TABLE IF NOT EXISTS `pedidos_produtos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pedido_id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `valor_total_cobrado` decimal(10,2) NOT NULL,
  `observacao` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `opcionais` json DEFAULT NULL,
  `ambiente_producao_responsavel` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `pedidos_produtos`
--

INSERT INTO `pedidos_produtos` (`id`, `pedido_id`, `produto_id`, `quantidade`, `valor_total_cobrado`, `observacao`, `opcionais`, `ambiente_producao_responsavel`, `status`) VALUES
(2, 2, 45, 1, '6.50', '', '\"[]\"', 2, 3),
(3, 3, 45, 1, '6.50', '', '\"[]\"', 2, 3),
(4, 4, 45, 1, '6.50', '', '\"[]\"', 2, 3),
(5, 5, 45, 1, '6.50', '', '\"[]\"', 2, 3),
(6, 5, 46, 1, '12.50', '', '\"[]\"', 2, 3),
(7, 6, 46, 1, '12.50', '', '\"[]\"', 2, 3),
(8, 6, 47, 1, '12.50', '', '\"[]\"', 2, 3),
(9, 7, 45, 1, '6.50', '', '\"[]\"', 2, 3),
(10, 8, 45, 1, '6.50', '', '\"[]\"', 2, 3),
(11, 9, 45, 1, '6.50', '', '\"[]\"', 1, 1),
(12, 9, 46, 1, '33.20', '', '\"{\\\"115\\\":[\\\"12\\\",\\\"13\\\",\\\"14\\\"]}\"', 1, 1),
(13, 10, 45, 1, '6.50', '', '\"[]\"', 1, 1),
(14, 11, 45, 1, '6.50', '', '\"[]\"', 1, 1),
(15, 11, 46, 1, '12.50', '', '\"[]\"', 1, 1),
(16, 13, 45, 1, '6.50', '', '\"[]\"', 2, 3),
(17, 14, 45, 1, '6.50', '', '\"[]\"', 1, 3),
(18, 14, 46, 1, '12.50', '', '\"[]\"', 1, 3),
(19, 15, 45, 1, '6.50', '', '\"[]\"', 1, 3),
(20, 15, 46, 1, '12.50', '', '\"[]\"', 1, 3),
(21, 16, 45, 1, '6.50', '', '\"[]\"', 1, 1),
(22, 16, 46, 1, '18.50', '', '\"{\\\"115\\\":[\\\"12\\\"]}\"', 1, 1),
(23, 16, 47, 1, '33.20', '', '\"{\\\"115\\\":[\\\"12\\\",\\\"13\\\",\\\"14\\\"]}\"', 1, 1),
(24, 17, 46, 1, '33.20', '', '\"{\\\"115\\\":[\\\"12\\\",\\\"13\\\",\\\"14\\\"]}\"', 2, 3),
(25, 18, 45, 4, '26.00', 'gelada', '\"[]\"', 1, 1),
(26, 18, 46, 1, '33.20', 'Tira pepino', '\"{\\\"115\\\":[\\\"12\\\",\\\"13\\\",\\\"14\\\"]}\"', 1, 1),
(27, 19, 45, 1, '6.50', '', '\"[]\"', 1, 1),
(28, 20, 45, 1, '6.50', '', '\"[]\"', 1, 1),
(29, 21, 45, 1, '6.50', '', '\"[]\"', 1, 3),
(30, 22, 45, 1, '6.50', '', '\"[]\"', 1, 1),
(31, 23, 45, 1, '6.50', '', '\"[]\"', 1, 1),
(32, 24, 46, 1, '33.20', 'Tira o pentelho dessa vez', '\"{\\\"115\\\":[\\\"12\\\",\\\"13\\\",\\\"14\\\"]}\"', 1, 1),
(33, 25, 45, 1, '6.50', '', '\"[]\"', 1, 1),
(34, 26, 45, 1, '6.50', '', '\"[]\"', 1, 1),
(35, 26, 46, 1, '33.20', '', '\"{\\\"115\\\":[\\\"12\\\",\\\"13\\\",\\\"14\\\"]}\"', 1, 1),
(36, 27, 45, 1, '6.50', '', '\"[]\"', 1, 3),
(37, 28, 45, 1, '6.50', '', '\"[]\"', 1, 3),
(38, 29, 45, 1, '6.50', '', '\"[]\"', 1, 1),
(48, 33, 45, 1, '6.50', '', '\"[]\"', 1, 1),
(49, 33, 45, 1, '6.50', '', '\"[]\"', 1, 1),
(50, 33, 45, 1, '6.50', '', '\"[]\"', 1, 1),
(51, 34, 45, 1, '6.50', '', '\"[]\"', 1, 1),
(53, 36, 45, 1, '6.50', '', '\"[]\"', 1, 1),
(54, 37, 46, 1, '18.50', '', '\"{\\\"115\\\":[\\\"12\\\"]}\"', 1, 1),
(55, 38, 46, 1, '18.50', '', '\"{\\\"115\\\":[\\\"12\\\"]}\"', 2, 3),
(56, 39, 46, 1, '33.20', '', '\"{\\\"115\\\":[\\\"12\\\",\\\"13\\\",\\\"14\\\"]}\"', 1, 3),
(57, 39, 54, 1, '150.20', '', '\"{\\\"115\\\":[\\\"12\\\",\\\"13\\\",\\\"14\\\"],\\\"116\\\":[\\\"13\\\"]}\"', 1, 3),
(58, 40, 45, 3, '19.50', '', '\"[]\"', 1, 1),
(59, 41, 45, 1, '6.50', '', '\"[]\"', 1, 1),
(60, 42, 45, 1, '6.50', '', '\"[]\"', 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

DROP TABLE IF EXISTS `produtos`;
CREATE TABLE IF NOT EXISTS `produtos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `empresa_id` int(11) NOT NULL,
  `midia_id` int(11) DEFAULT NULL,
  `nome_produto` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `categorias_produto_id` int(11) NOT NULL,
  `descricao_produto` text COLLATE utf8_unicode_ci,
  `preco_produto` decimal(10,2) DEFAULT NULL,
  `ativo_produto` tinyint(1) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `categorias_produto_id` (`categorias_produto_id`),
  KEY `midia_id` (`midia_id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`id`, `empresa_id`, `midia_id`, `nome_produto`, `categorias_produto_id`, `descricao_produto`, `preco_produto`, `ativo_produto`, `created`, `modified`) VALUES
(62, 2, NULL, 'Grande', 22, 'Pizza grande ate 3 sabores', '55.00', 1, '2019-04-02 16:47:08', '2019-04-02 17:08:26'),
(63, 2, NULL, 'Media', 22, 'Pizza media ate 2 sabores', '45.00', 1, '2019-04-02 17:07:54', '2019-04-02 17:09:36');

-- --------------------------------------------------------

--
-- Estrutura da tabela `taxas_entregas_cotacao`
--

DROP TABLE IF EXISTS `taxas_entregas_cotacao`;
CREATE TABLE IF NOT EXISTS `taxas_entregas_cotacao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `empresa_id` int(11) NOT NULL,
  `valor_km` decimal(10,2) NOT NULL,
  `arredondamento_tipo` int(11) DEFAULT NULL,
  `ativo` tinyint(1) NOT NULL,
  `valor_base_erro` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `taxas_entregas_cotacao`
--

INSERT INTO `taxas_entregas_cotacao` (`id`, `empresa_id`, `valor_km`, `arredondamento_tipo`, `ativo`, `valor_base_erro`) VALUES
(6, 1, '1.95', 2, 1, '10.00'),
(7, 2, '154.00', 1, 1, '10.00'),
(8, 2, '55.00', 3, 1, '10.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tempos_medios`
--

DROP TABLE IF EXISTS `tempos_medios`;
CREATE TABLE IF NOT EXISTS `tempos_medios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `empresa_id` int(11) NOT NULL,
  `nome` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `tempo_medio_producao_minutos` int(11) NOT NULL,
  `ativo` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `empresa_id` (`empresa_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `tempos_medios`
--

INSERT INTO `tempos_medios` (`id`, `empresa_id`, `nome`, `tempo_medio_producao_minutos`, `ativo`) VALUES
(3, 1, 'Tempo Produção dias da semana', 45, 1),
(5, 2, 'André Cristen', 123, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome_completo` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `tipo` smallint(6) NOT NULL DEFAULT '1',
  `empresa_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  `apelido` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `login` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `dia_nascimento` int(11) NOT NULL,
  `mes_nascimento` int(11) NOT NULL,
  `ano_nascimento` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `nome_completo`, `tipo`, `empresa_id`, `created`, `modified`, `apelido`, `login`, `password`, `dia_nascimento`, `mes_nascimento`, `ano_nascimento`) VALUES
(8, 'André Cristen', 2, 2, '2019-01-28 23:59:32', '2019-03-18 16:39:25', 'Dezinh', 'andrecristenibirama@gmail.com', '$2y$10$rPg6wXHcnEDbEY5IIkQ4t./Qpb/qrDmK7UJw4x8yZzMWJ3fzs2V/y', 3, 9, 2000),
(16, 'André Cristen Cliente', 1, 2, '2019-02-05 22:14:18', '2019-02-15 21:39:25', 'TESTE LADEV CLIENTE', 'andre.cristen@ladev.com', '$2y$10$NNNttUN6hZNz9NBWPXB2AOe4nacaYwnR0QkiZEy/LznND2TxGkMem', 3, 9, 2000),
(20, 'Baiucas Lanches', 2, 1, '2019-02-14 21:40:09', '2019-03-27 16:14:25', 'Baiucas Lanches e Delivery', 'baiucas.admin@gmail.com', '$2y$10$xL/DkDmDdVeZsX6ccQPnmOa7i0YyQxsgMLr41A96WdTHQ4ws4jZaG', 3, 9, 2000),
(21, 'LaDev - Software', 2, 2, '2019-02-28 16:30:38', '2019-03-27 16:14:19', 'Ladelivery', 'ladev.sistemas@gmail.com', '$2y$10$RcrpWZi7np6wn1qV..Nn.OqoGbCTvY9IfbC.wVaQKmL61eRfp34VO', 3, 9, 2000),
(22, 'André Cristen', 2, 1, '2019-03-19 17:04:53', '2019-03-19 17:04:53', '123', 'andrecristenibirama@gmail.com1', '$2y$10$nepDfgLtK4hWc9Ndib/Tr.h5/0iEmflnv7C3BPl7tmGo8kwJizCr6', 1, 1, 1),
(23, 'André Cristen', 1, 2, '2019-03-19 17:05:20', '2019-03-19 17:05:20', 'Dezinh do funk', 'de@de.com', '$2y$10$kL2mVxabAH2RoqorZJmOdehZ4/NN0BvstQpHr3Zbxhq3MXj9GT.A6', 132, 12, 12);

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `banners`
--
ALTER TABLE `banners`
  ADD CONSTRAINT `banners_ibfk_1` FOREIGN KEY (`midia_id`) REFERENCES `midias` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Limitadores para a tabela `categorias_produtos`
--
ALTER TABLE `categorias_produtos`
  ADD CONSTRAINT `categorias_produtos_ibfk_1` FOREIGN KEY (`midia_id`) REFERENCES `midias` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Limitadores para a tabela `enderecos`
--
ALTER TABLE `enderecos`
  ADD CONSTRAINT `enderecos_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Limitadores para a tabela `formas_pagamentos`
--
ALTER TABLE `formas_pagamentos`
  ADD CONSTRAINT `formas_pagamentos_ibfk_1` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`);

--
-- Limitadores para a tabela `listas_opcoes_extras`
--
ALTER TABLE `listas_opcoes_extras`
  ADD CONSTRAINT `lista_id` FOREIGN KEY (`lista_id`) REFERENCES `listas` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `opcoes_extras_id2` FOREIGN KEY (`opcoes_extra_id`) REFERENCES `opcoes_extras` (`id`) ON UPDATE CASCADE;

--
-- Limitadores para a tabela `listas_produtos`
--
ALTER TABLE `listas_produtos`
  ADD CONSTRAINT `listas_produtos_ibfk_1` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `listas_produtos_ibfk_2` FOREIGN KEY (`lista_id`) REFERENCES `listas` (`id`) ON UPDATE CASCADE;

--
-- Limitadores para a tabela `produtos`
--
ALTER TABLE `produtos`
  ADD CONSTRAINT `produtos_ibfk_1` FOREIGN KEY (`categorias_produto_id`) REFERENCES `categorias_produtos` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `produtos_ibfk_2` FOREIGN KEY (`midia_id`) REFERENCES `midias` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Limitadores para a tabela `tempos_medios`
--
ALTER TABLE `tempos_medios`
  ADD CONSTRAINT `tempos_medios_ibfk_1` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
