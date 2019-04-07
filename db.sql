-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 07-Abr-2019 às 23:39
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
-- Estrutura da tabela `actions`
--

DROP TABLE IF EXISTS `actions`;
CREATE TABLE IF NOT EXISTS `actions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `controller_id` int(11) NOT NULL,
  `nome_action` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `descricao_action` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=125 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `actions`
--

INSERT INTO `actions` (`id`, `controller_id`, `nome_action`, `descricao_action`) VALUES
(2, 1, 'index', 'Listar Usuarios'),
(3, 1, 'view', 'Visualizar Usuarios'),
(4, 1, 'add', 'Adicionar Usuario'),
(5, 1, 'edit', 'Editar Usuario'),
(6, 1, 'delete', 'Excluir Usuario'),
(7, 2, 'add', 'Adicionar Endereco'),
(8, 2, 'index', 'Listar Enderecos'),
(9, 2, 'view', 'Visualizar Endereco'),
(10, 2, 'edit', 'Editar Endereco'),
(11, 14, 'delete', 'Excluir Endereco'),
(12, 3, 'index', 'Listar Itens Carrinhos'),
(13, 3, 'view', 'Visualizar Item Carrinho'),
(14, 4, 'add', 'Adicionar Cupom '),
(15, 4, 'index', 'Listar Cupons'),
(16, 4, 'edit', 'Editar Cupom'),
(17, 4, 'delete', 'Excluir Cupom'),
(18, 4, 'view', 'Visualizar Cupom'),
(19, 25, 'add', 'Adicionar Action'),
(20, 25, 'index', 'Listar Actions'),
(21, 25, 'view', 'Visualizar Action'),
(22, 25, 'edit', 'Editar Action'),
(23, 25, 'delete', 'Excluir Action'),
(24, 5, 'index', 'Listar Pedidos'),
(25, 5, 'comandas', 'Listar Comandas'),
(26, 5, 'alterarSituacao', 'Alterar Situação das Comandas E Pedidos'),
(27, 5, 'imprimir', 'Imprimir Pedido'),
(28, 5, 'confirmar', 'Confirmar Pedidos'),
(29, 25, 'rejeitar', 'Rejeitar Pedidos'),
(30, 5, 'view', 'Visualizar Pedido/Comanda'),
(31, 6, 'bar', 'Listar Produtos Destinados ao Bar'),
(32, 6, 'cozinha', 'Listar Produtos Destinados a Cozinha'),
(33, 6, 'alterarSituacao', 'Alterar Situação Pedido Item'),
(34, 6, 'view', 'Visualizar Pedido Item'),
(35, 7, 'index', 'Listar Categorias'),
(36, 7, 'add', 'Adicionar Categoria'),
(37, 7, 'view', 'Visualizar Categoria'),
(38, 7, 'edit', 'Editar Categoria'),
(39, 25, 'delete', 'Excluir Categoria'),
(40, 8, 'index', 'Listar Produtos'),
(41, 8, 'add', 'Adicionar Produto'),
(42, 8, 'view', 'Visualizar Produto'),
(43, 8, 'edit', 'Editar Produto'),
(44, 8, 'delete', 'Excluir Produto'),
(45, 9, 'index', 'Listar Listas'),
(46, 9, 'add', 'Adicionar Lista'),
(47, 9, 'view', 'Visualizar Lista'),
(48, 9, 'edit', 'Editar Lista'),
(49, 9, 'delete', 'Excluir Lista'),
(50, 10, 'index', 'Listar Adicionais Produtos'),
(51, 10, 'add', 'Adicionar Adicional Produto'),
(52, 10, 'view', 'Visualizar Adicional Produto'),
(53, 10, 'edit', 'Editar Adicional Produto'),
(54, 10, 'delete', 'Excluir Adicional Produto'),
(55, 13, 'index', 'Listar Midias'),
(56, 13, 'add', 'Adicionar Midia'),
(57, 13, 'view', 'Visualizar Midia'),
(58, 13, 'edit', 'Editar Midia'),
(59, 13, 'delete', 'Excluir Midia'),
(60, 14, 'index', 'Listar Banners'),
(61, 14, 'add', 'Adicionar Banner'),
(62, 14, 'view', 'Visualizar Banner'),
(63, 14, 'edit', 'Editar Banner'),
(64, 14, 'delete', 'Excluir Banner'),
(65, 15, 'index', 'Listar Empresas'),
(66, 15, 'add', 'Adicionar Empresa'),
(67, 15, 'view', 'Visualizar Empresa'),
(68, 15, 'edit', 'Editar Empresa\r\n'),
(69, 15, 'delete', 'Excluir Empresa'),
(70, 16, 'index', 'Listar Taxas Entregas'),
(71, 16, 'add', 'Adicionar  Taxa Entrega'),
(72, 16, 'view', 'Visualizar Taxa Entrega'),
(73, 16, 'edit', 'Editar Taxa Entrega'),
(74, 16, 'delete', 'Excluir Taxa Entrega'),
(75, 17, 'index', 'Listar Tempos Produção'),
(76, 17, 'add', 'Adicionar Tempo Produção'),
(77, 17, 'view', 'Visualizar Tempo Produção'),
(78, 17, 'edit', 'Editar Tempo Produção'),
(79, 17, 'delete', 'Excluir Tempo Produção'),
(80, 18, 'index', 'Listar Formas Pagamento'),
(81, 18, 'add', 'Adicionar Forma Pagamento'),
(82, 18, 'view', 'Visualizar Forma Pagamento'),
(83, 18, 'edit', 'Editar Forma Pagamento'),
(84, 18, 'delete', 'Excluir Forma Pagamento'),
(85, 19, 'index', 'Listar Horarios Atendimento'),
(86, 19, 'add', 'Adicionar  Horario Atendimento'),
(87, 19, 'view', 'Visualizar  Horario Atendimento'),
(88, 19, 'edit', 'Editar  Horario Atendimento'),
(89, 19, 'delete', 'Excluir  Horario Atendimento'),
(90, 20, 'index', 'Listar Dias Fechados'),
(91, 20, 'add', 'Adicionar Dia Fechado'),
(92, 20, 'view', 'Visualizar Dia Fechado'),
(93, 20, 'edit', 'Editar Dia Fechado'),
(94, 20, 'delete', 'Excluir Dia Fechado'),
(95, 21, 'index', 'Listar API Keys Google Maps'),
(96, 21, 'add', 'Adicionar API Key Google Maps'),
(97, 21, 'view', 'Visualizar API Key Google Maps'),
(98, 21, 'edit', 'Editar API Key Google Maps'),
(99, 21, 'delete', 'Excluir API Key Google Maps'),
(100, 24, 'index', 'Listar Controllers'),
(101, 24, 'add', 'Adicionar Controller'),
(102, 24, 'view', 'Visualizar Controller'),
(103, 24, 'edit', 'Editar Controller'),
(104, 24, 'delete', 'Excluir Controller'),
(105, 22, 'index', 'Listar Endereços Empresas'),
(106, 22, 'add', 'Adicionar Endereço Empresa'),
(107, 22, 'view', 'Visualizar Endereço Empresa'),
(108, 22, 'edit', 'Editar Endereço Empresa'),
(109, 22, 'delete', 'Excluir Endereço Empresa'),
(110, 26, 'index', 'Listar Perfils'),
(111, 26, 'add', 'Adicionar Perfil'),
(112, 26, 'view', 'Visualizar Perfil'),
(113, 26, 'edit', 'Editar Perfil'),
(114, 26, 'delete', 'Excluir Perfil'),
(115, 27, 'index', 'Listar Ações Perfil'),
(116, 27, 'add', 'Adicionar Ação ao Perfil'),
(117, 27, 'view', 'Visualizar Ação do Perfil'),
(118, 27, 'edit', 'Editar Ação do Perfil'),
(119, 27, 'delete', 'Excluir Ação do Perfil'),
(120, 28, 'index', 'Listar Relação Perfil Usuário'),
(121, 28, 'add', 'Adicionar Relação Perfil Usuário'),
(122, 28, 'view', 'Visualizar Relação Perfil Usuário'),
(123, 28, 'edit', 'Editar Relação Perfil Usuário'),
(124, 28, 'delete', 'Excluir Relação Perfil Usuário');

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
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
(21, 8, 'LA201903281039050539801001553823545DEV42160703', '2019-03-31 22:39:05', 0),
(22, 8, 'LA201904030524540996518001554323094DEV46417968', '2019-04-06 17:24:54', 0),
(23, 8, 'LA201904030526180951035001554323178DEV65163220', '2019-04-06 17:26:18', 0),
(24, 8, 'LA201904030529000157634001554323340DEV28747113', '2019-04-06 17:29:00', 0),
(25, 8, 'LA201904030530130560684001554323413DEV70660840', '2019-04-06 17:30:13', 0),
(26, 8, 'LA201904030531260226738001554323486DEV89948166', '2019-04-06 17:31:26', 0),
(27, 24, 'LA201904030532430304900001554323563DEV93765771', '2019-04-06 17:32:43', 0),
(28, 8, 'LA201904030947120805122001554338832DEV62970912', '2019-04-06 21:47:12', 0),
(29, 8, 'LA201904030949490211130001554338989DEV23201538', '2019-04-06 21:49:49', 0),
(30, 8, 'LA201904030950540737123001554339054DEV85074321', '2019-04-06 21:50:54', 0),
(31, 8, 'LA201904030953040387632001554339184DEV49509950', '2019-04-06 21:53:04', 0),
(32, 8, 'LA201904030954100696337001554339250DEV79548209', '2019-04-06 21:54:10', 0),
(33, 8, 'b380fb1d2aa373e2e09e431b959e7f39', '2019-04-06 21:58:18', 1),
(34, 8, '5bae0c531e8b0e727de3694ab783493d', '2019-04-06 22:01:03', 0),
(35, 8, 'f1bb797b1141c4318ecf9d5b81ec04fb', '2019-04-06 22:02:56', 0),
(36, 8, 'bb160aa7fb3f0e66dcbc5266658fde39', '2019-04-06 22:03:33', 0),
(37, 8, '7e9e3ababcc606d0fe31d9053e7f9e75', '2019-04-06 22:04:42', 0),
(38, 8, '1a1f67d767e5385e267e130515c96e31', '2019-04-06 22:05:53', 0),
(39, 8, '5d2570591770fd834cf152f1fee4fb14', '2019-04-06 22:07:19', 0),
(40, 8, 'f467fab502eb835cc4e51f0bf556db21', '2019-04-06 22:08:30', 0),
(41, 8, '2c7fea9a1dda8f1ea39dd8f3d4036719', '2019-04-06 22:10:38', 0),
(42, 8, '32e54455e10c861bd81c606d3c7469e8', '2019-04-06 22:11:08', 0),
(43, 8, '3d183a7fb40643fbc0230cc7d15fdbe1', '2019-04-06 22:13:51', 0),
(44, 8, '471be29a9d34e6f9485bd1ef15f8a304', '2019-04-06 22:14:25', 0),
(45, 24, '08a2b7afbeb6c1b6fabfd03aad9921b8', '2019-04-06 22:14:59', 0),
(46, 8, 'fc24c0e52c10c607a8c8b21c19e75a2e', '2019-04-07 17:33:29', 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `banners`
--

INSERT INTO `banners` (`id`, `midia_id`, `ativo`, `nome_banner`) VALUES
(2, 49, 1, 'carne'),
(3, 45, 1, 'Kelloggs'),
(4, 43, 1, 'Cecilia');

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
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `categorias_produtos`
--

INSERT INTO `categorias_produtos` (`id`, `empresa_id`, `midia_id`, `nome_categoria`, `descricao_categoria`, `created`, `modified`) VALUES
(22, 2, NULL, 'Pizzas', 'Pizzas do Bonna', '2019-03-08 17:20:52', '2019-04-02 17:27:34');

-- --------------------------------------------------------

--
-- Estrutura da tabela `controllers`
--

DROP TABLE IF EXISTS `controllers`;
CREATE TABLE IF NOT EXISTS `controllers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome_controlador` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_nome_controlador` (`nome_controlador`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `controllers`
--

INSERT INTO `controllers` (`id`, `nome_controlador`) VALUES
(25, 'Actions'),
(14, 'Banners'),
(7, 'CategoriasProdutos'),
(24, 'Controllers'),
(4, 'CupomSite'),
(20, 'DiasFechados'),
(15, 'Empresas'),
(2, 'Enderecos'),
(22, 'EnderecosEmpresas'),
(18, 'FormasPagamentos'),
(21, 'GoogleMapsApiKey'),
(19, 'HorariosAtendimentos'),
(3, 'ItensCarrinhos'),
(9, 'Listas'),
(11, 'ListasOpcoesExtras'),
(12, 'ListasProdutos'),
(13, 'Midias'),
(10, 'OpcoesExtras'),
(5, 'Pedidos'),
(23, 'PedidosEntregas'),
(6, 'PedidosProdutos'),
(26, 'Perfils'),
(27, 'PerfilsActions'),
(28, 'PerfilsUsers'),
(8, 'Produtos'),
(16, 'TaxasEntregasCotacao'),
(17, 'TemposMedios'),
(1, 'Users');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `tipo_empresa` int(11) NOT NULL,
  `ativa` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_empresa_cnpj` (`cnpj`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `empresas`
--

INSERT INTO `empresas` (`id`, `nome_fantasia`, `cnpj`, `ie`, `tipo_empresa`, `ativa`) VALUES
(1, 'Baiucas Lanches', '05.700.549/0001-02', '795.636.423', 2, 1),
(2, 'LaDelivery', '', '', 1, 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `midias`
--

INSERT INTO `midias` (`id`, `empresa_id`, `tipo_midia`, `path_midia`, `nome_midia`) VALUES
(35, 2, 3, 'banners/upload_02_04_19_22_04_10_assados.jpg_assados.jpg', 'upload_02_04_19_22_04_10_assados.jpg'),
(36, 2, 3, 'banners/upload_02_04_19_22_04_01_coca.jpg_coca.jpg', 'upload_02_04_19_22_04_01_coca.jpg'),
(37, 2, 3, 'banners/upload_02_04_19_22_04_52_bebidas.jpg_bebidas.jpg', 'upload_02_04_19_22_04_52_bebidas.jpg'),
(39, 2, 3, 'banners/upload_02_04_19_22_04_01_banner_Home.jpg_banner_Home.jpg', 'upload_02_04_19_22_04_01_banner_Home.jpg'),
(40, 2, 3, 'banners/upload_02_04_19_22_04_47_Cecilia-Pizzaria-Banner-Inicial-Superior.jpg_Cecilia-Pizzaria-Banner-Inicial-Superior.jpg', 'upload_02_04_19_22_04_47_Cecilia-Pizzaria-Banner-Inicial-Superior.jpg'),
(41, 2, 3, 'banners/upload_02_04_19_23_04_17_chicago.jpg_chicago.jpg', 'upload_02_04_19_23_04_17_chicago.jpg'),
(42, 2, 3, 'banners/upload_02_04_19_23_04_52_banner_Home.jpg_banner_Home.jpg', 'upload_02_04_19_23_04_52_banner_Home.jpg'),
(43, 2, 3, 'banners/upload_02_04_19_23_04_14_Cecilia-Pizzaria-Banner-Inicial-Superior.jpg_Cecilia-Pizzaria-Banner-Inicial-Superior.jpg', 'upload_02_04_19_23_04_14_Cecilia-Pizzaria-Banner-Inicial-Superior.jpg'),
(44, 2, 3, 'banners/upload_02_04_19_23_04_44_download.jpg_download.jpg', 'upload_02_04_19_23_04_44_download.jpg'),
(45, 2, 3, 'banners/upload_02_04_19_23_04_13_kelloggs-header-banner-1280-1200x420.jpg_kelloggs-header-banner-1280-1200x420.jpg', 'upload_02_04_19_23_04_13_kelloggs-header-banner-1280-1200x420.jpg'),
(46, 2, 3, 'banners/upload_02_04_19_23_04_56_Cecilia-Pizzaria-Banner-Inicial-Superior.jpg_Cecilia-Pizzaria-Banner-Inicial-Superior.jpg', 'upload_02_04_19_23_04_56_Cecilia-Pizzaria-Banner-Inicial-Superior.jpg'),
(47, 2, 3, 'banners/upload_02_04_19_23_04_42_banner_Home.jpg_banner_Home.jpg', 'upload_02_04_19_23_04_42_banner_Home.jpg'),
(48, 2, 3, 'banners/upload_02_04_19_23_04_22_kelloggs-header-banner-1280-1200x420.jpg_kelloggs-header-banner-1280-1200x420.jpg', 'upload_02_04_19_23_04_22_kelloggs-header-banner-1280-1200x420.jpg'),
(49, 2, 3, 'banners/upload_02_04_19_23_04_42_south-shore-meats-header-banner-1280-1200x420.jpg_south-shore-meats-header-banner-1280-1200x420.jpg', 'upload_02_04_19_23_04_42_south-shore-meats-header-banner-1280-1200x420.jpg');

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
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `pedidos`
--

INSERT INTO `pedidos` (`id`, `user_id`, `empresa_id`, `valor_total_cobrado`, `formas_pagamento_id`, `valor_acrescimo`, `tempo_producao_aproximado_minutos`, `troco_para`, `tipo_pedido`, `status_pedido`, `data_pedido`, `cupom_usado`, `valor_desconto`) VALUES
(43, 16, 2, '55.00', 1, '0.00', 45, '60.00', 1, 2, '2019-04-06 12:23:40', NULL, '0.00'),
(44, 16, 2, '55.00', 1, '0.00', 45, '90.00', 1, 2, '2019-04-07 20:03:45', NULL, '0.00');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `pedidos_produtos`
--

INSERT INTO `pedidos_produtos` (`id`, `pedido_id`, `produto_id`, `quantidade`, `valor_total_cobrado`, `observacao`, `opcionais`, `ambiente_producao_responsavel`, `status`) VALUES
(61, 43, 62, 1, '55.00', '', '\"[]\"', 1, 3),
(62, 44, 62, 1, '55.00', '', '\"[]\"', 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `perfils`
--

DROP TABLE IF EXISTS `perfils`;
CREATE TABLE IF NOT EXISTS `perfils` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome_perfil` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `padrao_novos_users` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `perfils`
--

INSERT INTO `perfils` (`id`, `nome_perfil`, `padrao_novos_users`) VALUES
(2, 'Operador', 1),
(3, 'Técnico Software', 0),
(4, 'Cadastros', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `perfils_actions`
--

DROP TABLE IF EXISTS `perfils_actions`;
CREATE TABLE IF NOT EXISTS `perfils_actions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `action_id` int(11) NOT NULL,
  `perfil_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=127 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `perfils_actions`
--

INSERT INTO `perfils_actions` (`id`, `action_id`, `perfil_id`) VALUES
(1, 2, 2),
(2, 3, 2),
(3, 4, 2),
(4, 5, 2),
(5, 6, 2),
(6, 7, 2),
(7, 8, 2),
(8, 9, 2),
(9, 10, 2),
(11, 11, 2),
(12, 12, 2),
(13, 13, 2),
(14, 14, 2),
(15, 16, 2),
(16, 17, 2),
(17, 18, 2),
(18, 15, 2),
(19, 19, 3),
(20, 22, 3),
(21, 20, 3),
(22, 21, 3),
(23, 23, 3),
(24, 24, 2),
(25, 26, 2),
(26, 27, 2),
(27, 28, 2),
(28, 29, 2),
(29, 30, 2),
(32, 25, 2),
(33, 31, 2),
(34, 32, 2),
(35, 33, 2),
(36, 34, 2),
(37, 35, 2),
(38, 36, 2),
(39, 37, 2),
(40, 38, 2),
(41, 39, 2),
(42, 40, 2),
(43, 43, 2),
(45, 43, 2),
(46, 42, 2),
(47, 45, 2),
(48, 46, 2),
(49, 48, 2),
(50, 47, 2),
(51, 49, 2),
(52, 50, 2),
(53, 51, 2),
(54, 52, 2),
(55, 53, 2),
(56, 54, 2),
(62, 60, 2),
(58, 55, 2),
(59, 56, 2),
(60, 57, 2),
(61, 58, 2),
(63, 61, 2),
(64, 62, 2),
(65, 63, 2),
(66, 64, 2),
(67, 70, 2),
(68, 71, 2),
(69, 72, 2),
(70, 73, 2),
(71, 74, 2),
(72, 75, 2),
(73, 76, 2),
(74, 77, 2),
(75, 78, 2),
(76, 79, 2),
(77, 80, 2),
(78, 81, 2),
(79, 82, 2),
(80, 83, 2),
(81, 84, 2),
(82, 85, 2),
(83, 86, 2),
(84, 87, 2),
(85, 88, 2),
(86, 89, 2),
(87, 90, 2),
(88, 91, 2),
(89, 92, 2),
(90, 93, 2),
(91, 94, 2),
(92, 100, 3),
(93, 101, 3),
(94, 102, 3),
(95, 103, 3),
(96, 104, 3),
(97, 95, 3),
(98, 96, 3),
(99, 97, 3),
(100, 98, 3),
(101, 99, 3),
(102, 65, 3),
(103, 66, 3),
(104, 67, 3),
(105, 68, 3),
(106, 69, 3),
(107, 105, 3),
(108, 106, 3),
(109, 107, 3),
(110, 108, 3),
(111, 109, 3),
(112, 110, 3),
(113, 111, 3),
(114, 112, 3),
(115, 113, 3),
(116, 114, 3),
(117, 115, 3),
(118, 116, 3),
(119, 117, 2),
(120, 118, 3),
(121, 119, 3),
(122, 120, 3),
(123, 121, 3),
(124, 122, 3),
(125, 123, 3),
(126, 124, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `perfils_users`
--

DROP TABLE IF EXISTS `perfils_users`;
CREATE TABLE IF NOT EXISTS `perfils_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `perfil_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `perfils_users`
--

INSERT INTO `perfils_users` (`id`, `perfil_id`, `user_id`) VALUES
(1, 2, 8),
(2, 3, 8);

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `tempos_medios`
--

INSERT INTO `tempos_medios` (`id`, `empresa_id`, `nome`, `tempo_medio_producao_minutos`, `ativo`) VALUES
(3, 1, 'Tempo Produção dias da semana', 45, 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `nome_completo`, `tipo`, `empresa_id`, `created`, `modified`, `apelido`, `login`, `password`, `dia_nascimento`, `mes_nascimento`, `ano_nascimento`) VALUES
(8, 'André Cristen LADEV', 2, 2, '2019-01-28 23:59:32', '2019-04-05 18:23:29', 'Dezinh', 'andrecristenibirama@gmail.com', '$2y$10$wWXWh1YjSOH5t4.zPo7/TOIkL7pxVsxgIl84MyqxH6x2aOg5d9WBe', 3, 9, 2000),
(16, 'André Cristen Cliente', 1, 2, '2019-02-05 22:14:18', '2019-02-15 21:39:25', 'TESTE LADEV CLIENTE', 'andre.cristen@ladev.com', '$2y$10$NNNttUN6hZNz9NBWPXB2AOe4nacaYwnR0QkiZEy/LznND2TxGkMem', 3, 9, 2000),
(20, 'Baiucas Lanches', 2, 1, '2019-02-14 21:40:09', '2019-03-27 16:14:25', 'Baiucas Lanches e Delivery', 'baiucas.admin@gmail.com', '$2y$10$xL/DkDmDdVeZsX6ccQPnmOa7i0YyQxsgMLr41A96WdTHQ4ws4jZaG', 3, 9, 2000),
(21, 'LaDev - Software', 2, 2, '2019-02-28 16:30:38', '2019-03-27 16:14:19', 'Ladelivery', 'ladev.sistemas@gmail.com', '$2y$10$RcrpWZi7np6wn1qV..Nn.OqoGbCTvY9IfbC.wVaQKmL61eRfp34VO', 3, 9, 2000),
(22, 'André Cristen', 2, 1, '2019-03-19 17:04:53', '2019-03-19 17:04:53', '123', 'andrecristenibirama@gmail.com1', '$2y$10$nepDfgLtK4hWc9Ndib/Tr.h5/0iEmflnv7C3BPl7tmGo8kwJizCr6', 1, 1, 1),
(23, 'André Cristen', 1, 2, '2019-03-19 17:05:20', '2019-03-19 17:05:20', 'Dezinh do funk', 'de@de.com', '$2y$10$kL2mVxabAH2RoqorZJmOdehZ4/NN0BvstQpHr3Zbxhq3MXj9GT.A6', 132, 12, 12),
(24, 'Fernando Cristen', 1, 2, '2019-04-03 17:32:34', '2019-04-03 17:32:34', 'Fefe', 'cristenfernando@gmail.com', '$2y$10$jeceWEZJWr1dhYxkZ0Dz1ukZyX2Nn4546d/jbrSy0kRnp8G2f5L/m', 6, 11, 2001);

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
