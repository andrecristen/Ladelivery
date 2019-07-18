-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 18-Jul-2019 às 00:21
-- Versão do servidor: 5.7.26
-- versão do PHP: 7.2.18

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
) ENGINE=InnoDB AUTO_INCREMENT=171 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
(39, 7, 'delete', 'Excluir Categoria'),
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
(124, 28, 'delete', 'Excluir Relação Perfil Usuário'),
(125, 5, 'add', 'Abrir Pedido ou Comanda'),
(126, 29, 'painel', 'Dashboard Financeiro '),
(127, 23, 'index', 'Listar Entregas Dos Pedidos'),
(128, 23, 'edit', 'Editar Pedido Entrega'),
(129, 5, 'listAll', 'Listar Pedidos Separados por Situação'),
(130, 5, 'novos', 'Lista apenas os novos pedidos delivery'),
(131, 5, 'producao', 'Lista apenas pedidos em produção delivery'),
(132, 5, 'coleta', 'Lista apenas os pedidos delivery aguardando coleta do cliente'),
(133, 5, 'entrega', 'Lista apenas os pedidos delivery aguardando entrega'),
(134, 5, 'emRota', 'Lista apenas os pedidos delivery que estão em rota de entrega'),
(135, 5, 'entregues', 'Lista apenas os pedidos delivery entregues'),
(136, 5, 'concluirPedido', 'Concluir pedido'),
(137, 5, 'setColetado', 'Definir como coletado pelo cliente'),
(138, 5, 'setSaiuParaEntrega', 'Definir status do pedido como sendo entregue'),
(139, 5, 'setEntregue', 'Definir pedido como entregue'),
(140, 1, 'logout', 'Sair do Sistema'),
(141, 23, 'setEntregador', 'Definir entregador para a entrega do pedido'),
(142, 5, 'rejeitar', 'Rejeitar Pedido'),
(143, 1, 'clientes', 'Listar Clientes do Sistema'),
(144, 30, 'email', 'Envio de email ao clientes'),
(145, 29, 'entregas', 'Visualizar Métricas de entregas'),
(146, 29, 'comissaoEntregador', 'Gerar comissão do entregador com base nas entregas'),
(147, 31, 'index', 'Listar Contas'),
(148, 31, 'add', 'Adicionar Conta'),
(149, 31, 'view', 'Visualizar Conta'),
(150, 31, 'edit', 'Alterar Conta'),
(151, 31, 'delete', 'Excluir Conta'),
(152, 31, 'definirPago', 'Definir Conta Como Paga'),
(153, 5, 'defineEntrega', 'Definir entrega do pedido em abertura'),
(154, 5, 'addItem', 'Adicionar item ao pedido/comanda'),
(155, 32, 'index', 'Listar Módulos'),
(156, 32, 'add', 'Adicionar Módulo'),
(157, 32, 'edit', 'Alterar Módulo'),
(158, 32, 'view', 'Visualizar Módulo'),
(159, 32, 'delete', 'Excluir Módulo'),
(160, 29, 'produtos', 'Listagem de Produtos, Categorias, Zonas de Venda'),
(161, 29, 'entregasGeral', 'Listagem de todas entregas dos entregadores por mês e ano'),
(162, 33, 'index', 'Listar Menus'),
(163, 33, 'add', 'Adicionar Menu'),
(164, 33, 'edit', 'Editar Menu'),
(165, 33, 'delete', 'Excluir Menu'),
(166, 33, 'view', 'Visualizar Menu'),
(167, 5, 'confirmarAbertura', 'Confirmar abertura de pedido ou comanda'),
(168, 6, 'cozinhaKanban', 'Visualização Pedidos Produtos da Cozinha em Kanban'),
(169, 6, 'barKanban', 'Visualização Pedidos Produtos do Bar em Kanban'),
(170, 6, 'quantidadeProduzida', 'Alterar a quantidade produzida de um item do pedido');

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
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
(46, 8, 'fc24c0e52c10c607a8c8b21c19e75a2e', '2019-04-07 17:33:29', 1),
(47, 8, 'abfe359c1a171edd1c05a2df4171a5a6', '2019-04-27 18:11:03', 0),
(48, 8, 'a12208edb7de554ec493c55da1d474c2', '2019-04-27 18:11:39', 0),
(49, 8, 'ef96a89317ee04474657cd79cd3df2f1', '2019-04-27 18:12:35', 0),
(50, 8, '1673dfd2f6dc7e8561708c65a5fd0a36', '2019-04-27 18:13:47', 0),
(51, 27, '9d300016d87afce97f6eb5f8dd0dcccf', '2019-06-27 16:57:40', 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `banners`
--

INSERT INTO `banners` (`id`, `midia_id`, `ativo`, `nome_banner`) VALUES
(2, 49, 1, 'carne'),
(3, 45, 1, 'Kelloggs'),
(4, 43, 1, 'Cecilia'),
(5, 51, 1, 'Promo natal');

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
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `categorias_produtos`
--

INSERT INTO `categorias_produtos` (`id`, `empresa_id`, `midia_id`, `nome_categoria`, `descricao_categoria`, `created`, `modified`) VALUES
(22, 1, NULL, 'Pizzas', 'Pizzas do Bonna', '2019-03-08 17:20:52', '2019-07-11 18:23:02'),
(23, 1, NULL, 'Bebidas', 'Bebidas Geladas', '2019-06-24 16:42:03', '2019-06-24 17:27:52');

-- --------------------------------------------------------

--
-- Estrutura da tabela `contas`
--

DROP TABLE IF EXISTS `contas`;
CREATE TABLE IF NOT EXISTS `contas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `pessoa` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `valor_total` decimal(10,2) NOT NULL,
  `descricao` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `data_pagamento` date DEFAULT NULL,
  `data_vencimento` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `controllers`
--

INSERT INTO `controllers` (`id`, `nome_controlador`) VALUES
(25, 'Actions'),
(14, 'Banners'),
(7, 'CategoriasProdutos'),
(31, 'Contas'),
(24, 'Controllers'),
(4, 'CupomSite'),
(20, 'DiasFechados'),
(15, 'Empresas'),
(2, 'Enderecos'),
(22, 'EnderecosEmpresas'),
(29, 'Financeiro'),
(18, 'FormasPagamentos'),
(21, 'GoogleMapsApiKey'),
(19, 'HorariosAtendimentos'),
(3, 'ItensCarrinhos'),
(9, 'Listas'),
(11, 'ListasOpcoesExtras'),
(12, 'ListasProdutos'),
(30, 'Marketing'),
(33, 'Menus'),
(13, 'Midias'),
(32, 'Modulos'),
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
  `vezes_usado` int(11) DEFAULT '0',
  `maximo_vezes_usar` int(11) NOT NULL,
  `valor_desconto` int(11) NOT NULL,
  `porcentagem` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `cupom_site`
--

INSERT INTO `cupom_site` (`id`, `empresa_id`, `nome_cupom`, `vezes_usado`, `maximo_vezes_usar`, `valor_desconto`, `porcentagem`) VALUES
(1, 1, 'DESCONTO', 14, 14, 15, 1);

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
(1, 2, '2019-03-30', 'caguei quero dormir'),
(3, 1, '2019-07-12', 'Quero Dormir');

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
  `tipo_frete` int(11) NOT NULL DEFAULT '1',
  `ativa` tinyint(1) NOT NULL,
  `contatos` json DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_empresa_cnpj` (`cnpj`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `empresas`
--

INSERT INTO `empresas` (`id`, `nome_fantasia`, `cnpj`, `ie`, `tipo_empresa`, `tipo_frete`, `ativa`, `contatos`) VALUES
(1, 'Empresa Demonstração', '00.000.000/0000-00', '000.000.000', 2, 1, 1, '[{\"tipo_contato\": \"1\", \"valor_contato\": \"www.facebook.com/BaiucasIbirama/\"}, {\"tipo_contato\": \"3\", \"valor_contato\": \"(47) 3357-2825\"}, {\"tipo_contato\": \"2\", \"valor_contato\": \"(47) 9780-2814\"}, {\"tipo_contato\": \"4\", \"valor_contato\": \"ladev.sistemas@gmail.com\"}]'),
(2, 'LaDelivery', '', '', 1, 4, 1, '[{\"tipo_contato\": \"? undefined:undefined ?\", \"valor_contato\": \"\"}]');

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
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `enderecos`
--

INSERT INTO `enderecos` (`id`, `user_id`, `rua`, `numero`, `bairro`, `cidade`, `estado`, `cep`, `complemento`) VALUES
(16, 16, 'Luiz rigo', 143, 'Ponto chic', 'Ibirama', 'SC', '89140-000', 'Casa com muro de pedra bruta na frente'),
(17, 8, 'Luiz rigo', 143, 'Ponto Chic', 'Ibirama', 'SC', '89140-000', 'Casa com muro de pedra bruta na frente'),
(21, 16, 'Dr. Getulio Vargas', 2875, 'Bela Vista', 'Ibirama', 'SC', '89140000', 'Em frente a UDESC'),
(22, 16, 'Dr. Getulio Vargas', 112, 'aassdsd', 'Ibiramaas', 'SC', '89140000', 'sdsad'),
(23, 16, 'Marques do Herval', 100, 'Centro', 'Ibirama', 'SC', '89140-000', 'Casa dois andares'),
(24, 16, '13 de Maio', 2757, 'Centro', 'José Boiteux', 'SC', '89145-000', 'Casa');

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
(4, 1, 'Cartão Débito', 1, 0, '2.00'),
(5, 2, 'Bitcoin', 0, 0, '10.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `google_maps_api_key`
--

DROP TABLE IF EXISTS `google_maps_api_key`;
CREATE TABLE IF NOT EXISTS `google_maps_api_key` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `empresa_id` int(11) NOT NULL,
  `api_key` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `src_iframe_maps` text COLLATE utf8_unicode_ci,
  `ativa` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `google_maps_api_key`
--

INSERT INTO `google_maps_api_key` (`id`, `empresa_id`, `api_key`, `src_iframe_maps`, `ativa`) VALUES
(1, 1, 'AIzaSyBOfZCfy02ny8dk3LMcXOWtFuiDpqX1Qdw', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3553.3721273212773!2d-49.5381886!3d-27.049999399999997!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94dfb21277f3cc9f%3A0xa7727af401878a23!2sBaiuca&#39;s+Lanches!5e0!3m2!1spt-BR!2sbr!4v1562012731434!5m2!1spt-BR!2sbr', 1);

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
(5, 1, 0, 1, '00:00:00', '23:59:00'),
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=135 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `listas`
--

INSERT INTO `listas` (`id`, `empresa_id`, `nome_lista`, `descricao_lista`, `titulo_lista`, `max_opcoes_selecionadas_lista`, `min_opcoes_selecionadas_lista`) VALUES
(133, 1, 'Adicionais', 'Adicionais X Burgueres', 'Adicionais', 15, 2),
(134, 1, 'Sabores pizzas', 'Sabores das pizzas', 'Sabores', 3, 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=127 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `listas_opcoes_extras`
--

INSERT INTO `listas_opcoes_extras` (`id`, `lista_id`, `opcoes_extra_id`, `ativa`) VALUES
(117, 134, 15, 1),
(118, 134, 16, 1),
(119, 134, 17, 1),
(120, 134, 18, 1),
(121, 134, 19, 1),
(122, 133, 15, 1),
(123, 133, 16, 1),
(124, 133, 17, 1),
(125, 133, 18, 1),
(126, 133, 19, 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `listas_produtos`
--

INSERT INTO `listas_produtos` (`id`, `produto_id`, `lista_id`) VALUES
(72, 98, 133),
(70, 99, 133),
(73, 98, 134),
(71, 99, 134);

-- --------------------------------------------------------

--
-- Estrutura da tabela `logs`
--

DROP TABLE IF EXISTS `logs`;
CREATE TABLE IF NOT EXISTS `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `descricao` text COLLATE utf8_unicode_ci,
  `data_hora` datetime NOT NULL,
  `situacao` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `logs`
--

INSERT INTO `logs` (`id`, `tipo`, `user_id`, `descricao`, `data_hora`, `situacao`) VALUES
(1, 1, 16, 'Seu pedido teve uma alteração de situação. A nova situação é: Aguardando Coleta Cliente', '2019-07-17 16:26:01', 1),
(2, 1, 16, 'Seu pedido teve uma alteração de situação. A nova situação é: Em Produção.', '2019-07-17 16:49:02', 1),
(3, 1, 16, 'Seu pedido teve uma alteração de situação. A nova situação é: Aguardando Coleta Cliente.', '2019-07-17 17:01:07', 1),
(4, 1, 16, 'Seu pedido #12, teve uma alteração de situação. A nova situação é: Entregue.', '2019-07-17 17:02:01', 1),
(5, 1, 16, 'Seu pedido #10, teve uma alteração de situação. A nova situação é: Entregue.', '2019-07-17 17:02:03', 1),
(6, 1, 16, 'Seu pedido #11, teve uma alteração de situação. A nova situação é: Entregue.', '2019-07-17 17:02:04', 1),
(7, 1, 16, 'Seu pedido #13, teve uma alteração de situação. A nova situação é: Aguardando Confirmação.', '2019-07-17 20:06:08', 1),
(8, 1, 16, 'Seu pedido #14, teve uma alteração de situação. A nova situação é: Aguardando Confirmação.', '2019-07-17 20:08:18', 1),
(9, 1, 16, 'Seu pedido #15, teve uma alteração de situação. A nova situação é: Aguardando Confirmação.', '2019-07-17 20:19:00', 1),
(10, 1, 16, 'Seu pedido #13, teve uma alteração de situação. A nova situação é: Em Produção.', '2019-07-17 20:23:09', 1),
(11, 1, 16, 'Seu pedido #14, teve uma alteração de situação. A nova situação é: Em Produção.', '2019-07-17 20:23:12', 1),
(12, 1, 16, 'Seu pedido #15, teve uma alteração de situação. A nova situação é: Em Produção.', '2019-07-17 20:23:14', 1),
(13, 1, 16, 'Seu pedido #15, teve uma alteração de situação. A nova situação é: Aguardando Entregador.', '2019-07-17 20:54:15', 2),
(14, 1, 16, 'Seu pedido #14, teve uma alteração de situação. A nova situação é: Aguardando Entregador.', '2019-07-17 20:54:17', 2),
(15, 1, 16, 'Seu pedido #13, teve uma alteração de situação. A nova situação é: Aguardando Coleta Cliente.', '2019-07-17 20:54:17', 2),
(16, 1, 16, 'Seu pedido #15, teve uma alteração de situação. A nova situação é: Saiu para entrega.', '2019-07-17 20:54:27', 2),
(17, 1, 16, 'Seu pedido #14, teve uma alteração de situação. A nova situação é: Saiu para entrega.', '2019-07-17 20:54:30', 2),
(18, 1, 16, 'Seu pedido #15, teve uma alteração de situação. A nova situação é: Entregue.', '2019-07-17 20:54:35', 2),
(19, 1, 16, 'Seu pedido #14, teve uma alteração de situação. A nova situação é: Entregue.', '2019-07-17 20:54:38', 2),
(20, 1, 16, 'Seu pedido #13, teve uma alteração de situação. A nova situação é: Entregue.', '2019-07-17 20:54:44', 2),
(21, 1, 30, 'Seu pedido #16, teve uma alteração de situação. A nova situação é: .', '2019-07-17 20:55:15', 2),
(22, 1, 30, 'Seu pedido #16, teve uma alteração de situação. A nova situação é: .', '2019-07-17 20:55:38', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `menus`
--

DROP TABLE IF EXISTS `menus`;
CREATE TABLE IF NOT EXISTS `menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `modulo_id` int(11) NOT NULL,
  `action_id` int(11) NOT NULL,
  `nome_menu` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ativo_menu` tinyint(1) NOT NULL,
  `ordem_menu` int(11) NOT NULL,
  `icon_menu` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `menus`
--

INSERT INTO `menus` (`id`, `modulo_id`, `action_id`, `nome_menu`, `ativo_menu`, `ordem_menu`, `icon_menu`) VALUES
(1, 1, 126, 'Painel', 1, 1, ''),
(2, 1, 160, 'Métricas de Vendas', 1, 2, ''),
(3, 1, 147, 'Contas', 1, 3, ''),
(4, 1, 145, 'Entregas', 1, 4, ''),
(5, 2, 129, 'Pedidos', 1, 1, ''),
(6, 2, 127, 'Entregas', 1, 2, ''),
(7, 3, 25, 'Comandas', 1, 1, ''),
(8, 3, 31, 'Bar', 1, 2, ''),
(9, 3, 32, 'Cozinha', 1, 3, ''),
(10, 4, 35, 'Categorias', 1, 1, ''),
(11, 4, 40, 'Produtos', 1, 2, ''),
(12, 4, 45, 'Listas', 1, 3, ''),
(13, 4, 50, 'Adicionais', 1, 4, ''),
(14, 5, 55, 'Midias', 1, 1, ''),
(15, 5, 60, 'Banners', 1, 2, ''),
(16, 6, 144, 'Propaganda Email', 1, 1, ''),
(17, 7, 2, 'Usuários', 1, 1, ''),
(18, 7, 143, 'Clientes', 1, 2, ''),
(19, 7, 8, 'Endereços', 1, 3, ''),
(20, 7, 12, 'Carrinhos Itens', 1, 4, ''),
(21, 7, 15, 'Cupom', 1, 5, ''),
(22, 8, 70, 'Taxas Entregas', 1, 1, ''),
(23, 8, 75, 'Tempo Produção', 1, 2, ''),
(24, 8, 80, 'Formas Pagamento', 1, 3, ''),
(25, 8, 85, 'Horários Atendimento', 1, 4, ''),
(26, 8, 90, 'Dias Fechado', 1, 5, ''),
(27, 8, 65, 'Empresas', 1, 6, ''),
(28, 9, 95, 'Google Maps Api Keys', 1, 2, ''),
(29, 9, 155, 'Módulos', 1, 3, ''),
(30, 9, 162, 'Menus', 1, 4, ''),
(31, 9, 100, 'Controllers', 0, 5, ''),
(32, 9, 20, 'Actions', 1, 6, ''),
(33, 9, 110, 'Perfils', 1, 7, '');

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
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
(49, 2, 3, 'banners/upload_02_04_19_23_04_42_south-shore-meats-header-banner-1280-1200x420.jpg_south-shore-meats-header-banner-1280-1200x420.jpg', 'upload_02_04_19_23_04_42_south-shore-meats-header-banner-1280-1200x420.jpg'),
(50, 2, 1, 'produtos/upload_18_04_19_19_04_25_pizza.png_pizza.png', 'upload_18_04_19_19_04_25_pizza.png'),
(51, 1, 3, 'banners/upload_29_04_19_17_04_16_1200x400-handcrafted-banner.jpg_1200x400-handcrafted-banner.jpg', 'upload_29_04_19_17_04_16_1200x400-handcrafted-banner.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `modulos`
--

DROP TABLE IF EXISTS `modulos`;
CREATE TABLE IF NOT EXISTS `modulos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `icon_class` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `ordem` int(11) NOT NULL,
  `ativo` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `modulos`
--

INSERT INTO `modulos` (`id`, `nome`, `icon_class`, `ordem`, `ativo`) VALUES
(1, 'Financeiro', 'fas fa-chart-area', 1, 1),
(2, 'Delivery', 'fas fa-motorcycle', 2, 1),
(3, 'Interno', 'fas fa-home', 3, 1),
(4, 'Produto', 'fas fa-box', 4, 1),
(5, 'Mídias', 'fas fa-images', 5, 1),
(6, 'Marketing', 'fas fa-mail-bulk', 6, 1),
(7, 'Único', 'fas fa-cogs', 7, 1),
(8, 'Administrador', 'fab fa-windows', 8, 1),
(9, 'Engine', 'fas fa-sitemap', 9, 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `opcoes_extras`
--

INSERT INTO `opcoes_extras` (`id`, `empresa_id`, `nome_adicional`, `descricao_adicional`, `valor_adicional`) VALUES
(15, 1, 'Calabresa', 'Adicionar 3000 gramas de calabresa', '15.00'),
(16, 1, 'Frango', '300 gr', '12.00'),
(17, 1, 'Queijo', '250 gr', '8.00'),
(18, 1, 'Bacon', '300 gr', '11.00'),
(19, 1, 'Fritas', '500 gr', '13.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
CREATE TABLE IF NOT EXISTS `pedidos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `cliente` varchar(450) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tipo_pedido` int(11) NOT NULL DEFAULT '1',
  `origem` int(11) DEFAULT NULL,
  `empresa_id` int(11) NOT NULL,
  `status_pedido` int(11) NOT NULL,
  `data_pedido` datetime NOT NULL,
  `cupom_usado` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `formas_pagamento_id` int(11) DEFAULT NULL,
  `troco_para` decimal(10,2) NOT NULL DEFAULT '0.00',
  `tempo_producao_aproximado_minutos` int(11) DEFAULT NULL,
  `valor_produtos` decimal(10,2) NOT NULL DEFAULT '0.00',
  `valor_acrescimo` decimal(10,2) NOT NULL DEFAULT '0.00',
  `valor_desconto` decimal(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `pedidos`
--

INSERT INTO `pedidos` (`id`, `user_id`, `cliente`, `tipo_pedido`, `origem`, `empresa_id`, `status_pedido`, `data_pedido`, `cupom_usado`, `formas_pagamento_id`, `troco_para`, `tempo_producao_aproximado_minutos`, `valor_produtos`, `valor_acrescimo`, `valor_desconto`) VALUES
(8, 16, NULL, 1, NULL, 1, 9, '2019-07-16 17:27:00', NULL, 1, '150.00', 45, '103.00', '0.00', '0.00'),
(9, 16, NULL, 1, NULL, 1, 9, '2019-07-16 17:39:00', NULL, 4, '0.00', 45, '159.00', '3.18', '0.00'),
(10, 16, NULL, 1, 3, 1, 9, '2019-07-17 15:49:00', NULL, 1, '119.00', 35, '119.00', '0.00', '0.00'),
(11, 16, NULL, 1, 2, 1, 9, '2019-07-17 15:49:37', NULL, 1, '0.00', NULL, '109.00', '0.00', '0.00'),
(12, 16, NULL, 1, 2, 1, 9, '2019-07-17 16:39:22', NULL, 1, '0.00', 35, '109.00', '0.00', '0.00'),
(13, 16, NULL, 1, 3, 1, 9, '2019-07-17 20:04:00', NULL, 1, '0.00', 35, '240.00', '0.00', '0.00'),
(14, 16, NULL, 1, 3, 1, 9, '2019-07-17 20:07:00', NULL, 2, '0.00', 45, '5.00', '0.25', '0.00'),
(15, 16, NULL, 1, 3, 1, 9, '2019-07-17 20:09:00', NULL, 1, '15.00', 45, '5.00', '0.00', '0.00'),
(16, 30, 'Dolsan', 2, 2, 1, 14, '2019-07-17 20:55:10', NULL, NULL, '0.00', NULL, '10.00', '0.00', '0.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos_entregas`
--

DROP TABLE IF EXISTS `pedidos_entregas`;
CREATE TABLE IF NOT EXISTS `pedidos_entregas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pedido_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `valor_entrega` decimal(10,2) NOT NULL,
  `cotacao_maps` text COLLATE utf8_unicode_ci,
  `endereco_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_pedido_entrega` (`pedido_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `pedidos_entregas`
--

INSERT INTO `pedidos_entregas` (`id`, `pedido_id`, `user_id`, `valor_entrega`, `cotacao_maps`, `endereco_id`) VALUES
(3, 8, 27, '9.00', '{\"distance\":{\"text\":\"4,2 km\",\"value\":4249},\"duration\":{\"text\":\"8 minutos\",\"value\":484},\"status\":\"OK\"}', 16),
(4, 9, 27, '4.00', '{\"distance\":{\"text\":\"1,6 km\",\"value\":1627},\"duration\":{\"text\":\"3 minutos\",\"value\":196},\"status\":\"OK\"}', 23),
(5, 14, 27, '9.00', '{\"distance\":{\"text\":\"4,2 km\",\"value\":4249},\"duration\":{\"text\":\"8 minutos\",\"value\":484},\"status\":\"OK\"}', 16),
(6, 15, 27, '9.00', '{\"distance\":{\"text\":\"4,2 km\",\"value\":4249},\"duration\":{\"text\":\"8 minutos\",\"value\":484},\"status\":\"OK\"}', 16);

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
  `quantidade_produzida` int(11) NOT NULL DEFAULT '0',
  `valor_total_cobrado` decimal(10,2) NOT NULL,
  `observacao` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `opcionais` json DEFAULT NULL,
  `ambiente_producao_responsavel` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `pedidos_produtos`
--

INSERT INTO `pedidos_produtos` (`id`, `pedido_id`, `produto_id`, `quantidade`, `quantidade_produzida`, `valor_total_cobrado`, `observacao`, `opcionais`, `ambiente_producao_responsavel`, `status`) VALUES
(13, 8, 100, 2, 0, '10.00', '', '\"[]\"', 2, 5),
(14, 8, 98, 1, 0, '93.00', '', '\"{\\\"133\\\":[\\\"15\\\",\\\"16\\\"],\\\"134\\\":[\\\"18\\\"]}\"', 1, 5),
(15, 9, 98, 1, 1, '149.00', '', '\"{\\\"133\\\":[\\\"15\\\",\\\"16\\\",\\\"17\\\",\\\"18\\\",\\\"19\\\"],\\\"134\\\":[\\\"15\\\",\\\"16\\\",\\\"17\\\"]}\"', 1, 5),
(16, 9, 100, 2, 2, '10.00', '', '\"[]\"', 2, 5),
(17, 10, 100, 1, 0, '5.00', '', '\"[]\"', 2, 3),
(18, 10, 98, 1, 0, '109.00', 'Sem tomate', '\"{\\\"133\\\":[\\\"15\\\",\\\"16\\\"],\\\"134\\\":[\\\"15\\\",\\\"16\\\"]}\"', 1, 3),
(19, 10, 100, 1, 0, '5.00', '', '\"[]\"', 2, 3),
(20, 11, 98, 1, 0, '109.00', '', '\"{\\\"133\\\":[\\\"15\\\",\\\"16\\\"],\\\"134\\\":[\\\"15\\\",\\\"16\\\"]}\"', 1, 3),
(21, 12, 98, 1, 0, '109.00', '', '\"{\\\"133\\\":[\\\"15\\\",\\\"16\\\"],\\\"134\\\":[\\\"15\\\",\\\"16\\\"]}\"', 1, 3),
(22, 13, 98, 1, 0, '125.00', '', '\"{\\\"133\\\":[\\\"15\\\",\\\"16\\\",\\\"17\\\"],\\\"134\\\":[\\\"15\\\",\\\"16\\\",\\\"17\\\"]}\"', 1, 3),
(23, 13, 99, 1, 0, '115.00', '', '\"{\\\"133\\\":[\\\"15\\\",\\\"16\\\"],\\\"134\\\":[\\\"15\\\",\\\"16\\\",\\\"18\\\"]}\"', 1, 3),
(24, 14, 100, 1, 0, '5.00', '', '\"[]\"', 2, 3),
(25, 15, 100, 1, 0, '5.00', '', '\"[]\"', 2, 3),
(26, 16, 100, 1, 0, '5.00', '', '\"[]\"', 2, 3),
(27, 16, 100, 1, 0, '5.00', '', '\"[]\"', 2, 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `perfils`
--

INSERT INTO `perfils` (`id`, `nome_perfil`, `padrao_novos_users`) VALUES
(2, 'Operador', 1),
(3, 'Técnico Software', 0),
(4, 'Cadastros', 0),
(5, 'Administrador', 0);

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
) ENGINE=MyISAM AUTO_INCREMENT=181 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `perfils_actions`
--

INSERT INTO `perfils_actions` (`id`, `action_id`, `perfil_id`) VALUES
(1, 2, 5),
(2, 3, 5),
(3, 4, 5),
(4, 5, 5),
(5, 6, 5),
(6, 7, 5),
(7, 8, 5),
(8, 9, 5),
(9, 10, 5),
(11, 11, 5),
(12, 12, 5),
(13, 13, 5),
(14, 14, 5),
(15, 16, 5),
(16, 17, 5),
(17, 18, 5),
(18, 15, 5),
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
(173, 25, 2),
(33, 31, 2),
(34, 32, 2),
(35, 33, 2),
(36, 34, 2),
(37, 35, 4),
(38, 36, 4),
(39, 37, 4),
(40, 38, 4),
(41, 39, 4),
(42, 40, 4),
(43, 43, 4),
(129, 126, 2),
(46, 42, 4),
(47, 45, 4),
(48, 46, 4),
(49, 48, 4),
(50, 47, 4),
(51, 49, 4),
(52, 50, 4),
(53, 51, 4),
(54, 52, 4),
(55, 53, 4),
(56, 54, 4),
(62, 60, 5),
(58, 55, 5),
(174, 167, 2),
(60, 57, 5),
(175, 168, 2),
(63, 61, 5),
(64, 62, 5),
(65, 63, 5),
(66, 64, 5),
(67, 70, 5),
(68, 71, 5),
(69, 72, 5),
(70, 73, 5),
(71, 74, 5),
(72, 75, 5),
(73, 76, 5),
(74, 77, 5),
(75, 78, 5),
(76, 79, 5),
(77, 80, 5),
(78, 81, 5),
(79, 82, 5),
(80, 83, 5),
(81, 84, 5),
(82, 85, 5),
(83, 86, 5),
(84, 87, 5),
(85, 88, 5),
(86, 89, 5),
(87, 90, 5),
(88, 91, 5),
(89, 92, 5),
(90, 93, 5),
(91, 94, 5),
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
(119, 117, 3),
(120, 118, 3),
(121, 119, 3),
(122, 120, 3),
(123, 121, 3),
(124, 122, 3),
(125, 123, 3),
(126, 124, 3),
(127, 41, 4),
(128, 125, 2),
(131, 127, 2),
(132, 128, 2),
(133, 129, 2),
(134, 130, 2),
(135, 131, 2),
(136, 132, 2),
(137, 134, 2),
(138, 133, 2),
(139, 135, 2),
(140, 136, 2),
(141, 137, 2),
(142, 138, 2),
(143, 139, 2),
(144, 67, 2),
(145, 140, 2),
(146, 141, 2),
(147, 142, 2),
(148, 143, 2),
(149, 144, 5),
(150, 145, 5),
(151, 146, 5),
(152, 147, 5),
(153, 148, 5),
(154, 149, 5),
(155, 150, 5),
(156, 151, 5),
(157, 152, 5),
(158, 153, 2),
(159, 154, 2),
(160, 155, 3),
(161, 156, 3),
(176, 169, 2),
(163, 158, 3),
(164, 159, 3),
(165, 157, 3),
(166, 160, 5),
(167, 161, 5),
(168, 162, 3),
(169, 163, 3),
(170, 164, 3),
(171, 165, 3),
(172, 166, 3),
(177, 170, 2),
(178, 65, 5),
(179, 68, 5),
(180, 3, 2);

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
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `perfils_users`
--

INSERT INTO `perfils_users` (`id`, `perfil_id`, `user_id`) VALUES
(1, 2, 8),
(2, 3, 8),
(3, 4, 8),
(4, 5, 8),
(5, 2, 20),
(6, 5, 20),
(7, 4, 20),
(11, 2, 30);

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
  `ambiente_producao_responsavel` int(11) NOT NULL,
  `categorias_produto_id` int(11) NOT NULL,
  `descricao_produto` text COLLATE utf8_unicode_ci,
  `preco_produto` decimal(10,2) DEFAULT NULL,
  `ativo_produto` tinyint(1) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `categorias_produto_id` (`categorias_produto_id`),
  KEY `midia_id` (`midia_id`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`id`, `empresa_id`, `midia_id`, `nome_produto`, `ambiente_producao_responsavel`, `categorias_produto_id`, `descricao_produto`, `preco_produto`, `ativo_produto`, `created`, `modified`) VALUES
(98, 1, NULL, 'Pizza Grande', 1, 22, 'Pizza Grande', '55.00', 1, '2019-04-20 22:12:14', '2019-07-11 18:23:06'),
(99, 1, NULL, 'Pizza Media', 1, 22, 'Media', '50.00', 1, '2019-04-20 22:20:35', '2019-07-04 16:41:08'),
(100, 1, NULL, 'Coca Cola 600ml', 2, 23, 'Coca cola 600 ml', '5.00', 1, '2019-04-29 21:55:00', '2019-06-24 17:28:24');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos_avaliacoes`
--

DROP TABLE IF EXISTS `produtos_avaliacoes`;
CREATE TABLE IF NOT EXISTS `produtos_avaliacoes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `produto_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nota` int(11) NOT NULL,
  `comentario` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `produtos_avaliacoes`
--

INSERT INTO `produtos_avaliacoes` (`id`, `produto_id`, `user_id`, `nota`, `comentario`) VALUES
(1, 98, 16, 3, '123'),
(2, 99, 16, 4, '123'),
(3, 98, 16, 1, 'Teste 2 de avaliacaop'),
(4, 98, 16, 5, 'BOM DEMAIS'),
(5, 98, 16, 3, 'Ate que eh bomzinhop'),
(6, 99, 16, 1, '123'),
(7, 99, 16, 5, 'Gostoso demaisss'),
(8, 99, 16, 3, 'wedewew'),
(9, 99, 16, 5, '11111'),
(10, 99, 16, 2, 'teste'),
(11, 99, 16, 1, '11111'),
(12, 99, 16, 0, '222222222'),
(13, 98, 16, 5, '111111111111'),
(14, 98, 16, 5, '11111111111111111122222222'),
(15, 98, 16, 5, '23232'),
(16, 98, 16, 5, '5'),
(17, 98, 16, 5, '5'),
(18, 98, 16, 5, '5'),
(19, 98, 16, 5, '5'),
(20, 98, 16, 5, '5'),
(21, 98, 16, 5, '5'),
(22, 98, 16, 5, '5'),
(23, 100, 16, 5, 'Delicioso'),
(24, 100, 16, 3, '123'),
(25, 100, 16, 2, '1234'),
(26, 100, 16, 5, 'Topissimo'),
(27, 100, 16, 0, '1223'),
(28, 100, 16, 5, 'qwsqsqs'),
(29, 100, 16, 5, 'Massa boa'),
(30, 100, 16, 2, 'Podia ser melhor'),
(31, 100, 16, 4, 'aaaaaaaaaaaaaaaaa'),
(32, 100, 16, 4, 'pau no cu\r\n'),
(33, 98, 16, 0, 'Muito ruim cai a nota vai'),
(34, 99, 16, 5, 'zikaa\r\n'),
(35, 99, 16, 5, 'Zika'),
(36, 100, 16, 5, 'Massa adorei'),
(37, 100, 16, 5, 'pika parceiro');

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `taxas_entregas_cotacao`
--

INSERT INTO `taxas_entregas_cotacao` (`id`, `empresa_id`, `valor_km`, `arredondamento_tipo`, `ativo`, `valor_base_erro`) VALUES
(6, 1, '2.00', 2, 1, '10.00'),
(7, 2, '154.00', 1, 0, '10.00'),
(8, 2, '55.00', 3, 0, '10.00'),
(9, 1, '14.00', 1, 0, '123.00'),
(10, 1, '12.00', 3, 0, '100.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tempos_medios`
--

DROP TABLE IF EXISTS `tempos_medios`;
CREATE TABLE IF NOT EXISTS `tempos_medios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `empresa_id` int(11) NOT NULL,
  `tipo` int(11) NOT NULL,
  `nome` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `tempo_medio_producao_minutos` int(11) NOT NULL,
  `ativo` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `empresa_id` (`empresa_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `tempos_medios`
--

INSERT INTO `tempos_medios` (`id`, `empresa_id`, `tipo`, `nome`, `tempo_medio_producao_minutos`, `ativo`) VALUES
(3, 1, 1, 'Tempo Produção dias da semana', 45, 1),
(4, 1, 2, 'Dia da Semana coleta', 35, 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `nome_completo`, `tipo`, `empresa_id`, `created`, `modified`, `apelido`, `login`, `password`, `dia_nascimento`, `mes_nascimento`, `ano_nascimento`) VALUES
(8, 'LaDev Sistemas', 3, 2, '2019-01-28 23:59:32', '2019-06-24 16:52:11', 'LaDev', 'master@ladev.com', '$2y$10$wWXWh1YjSOH5t4.zPo7/TOIkL7pxVsxgIl84MyqxH6x2aOg5d9WBe', 3, 9, 2000),
(16, 'Cliente Ladev', 1, 2, '2019-02-05 22:14:18', '2019-06-24 17:33:10', 'Cliente Fiel', 'cliente@ladev.com', '$2y$10$/0aptDhXOOqgE36oL1SBqe3t7KhyVYbJMzyQLbOyxNIHoS46F.zWO', 3, 9, 2000),
(20, 'Empresa', 2, 1, '2019-02-14 21:40:09', '2019-07-08 19:48:21', 'Demonstração Lanches e Delivery', 'empresa@ladev.com', '$2y$10$xL/DkDmDdVeZsX6ccQPnmOa7i0YyQxsgMLr41A96WdTHQ4ws4jZaG', 10, 10, 2018),
(27, 'Entregador', 4, 1, '2019-04-27 14:07:43', '2019-06-24 17:01:15', 'Entregador Teste', 'entregador@ladev.com', '$2y$10$hjD5nvw5NHwUsDO.DVYBMOEjAAOiy3CZscdhofnFxrilG30wa0u0W', 12, 11, 1987),
(30, 'Operador', 2, 1, '2019-07-17 20:51:30', '2019-07-17 20:51:30', 'Operador', 'operador@ladev.com', '$2y$10$b7.JSKDwkwfCO8RH8A/qqOAVjgoLBF3CvU2qIKJVIiaOPz7AiNWum', 3, 9, 2000);

-- --------------------------------------------------------

--
-- Estrutura da tabela `users_contatos`
--

DROP TABLE IF EXISTS `users_contatos`;
CREATE TABLE IF NOT EXISTS `users_contatos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `tipo` int(11) NOT NULL,
  `contato` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `users_contatos`
--

INSERT INTO `users_contatos` (`id`, `user_id`, `tipo`, `contato`) VALUES
(1, 16, 1, '92771434'),
(2, 16, 2, '33572825');

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
