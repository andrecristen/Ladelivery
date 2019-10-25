-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 25-Out-2019 às 02:20
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

-- --------------------------------------------------------

--
-- Estrutura da tabela `actions`
--

DROP TABLE IF EXISTS `actions`;
CREATE TABLE IF NOT EXISTS `actions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `controller_id` int(11) NOT NULL,
  `nome_action` text COLLATE utf8_unicode_ci NOT NULL,
  `descricao_action` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=190 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
(170, 6, 'quantidadeProduzida', 'Alterar a quantidade produzida de um item do pedido'),
(171, 34, 'index', 'Listar Taxas Entregas Cotação Faixas'),
(172, 34, 'add', 'Adicionar Taxas Entrega Cotação Faixa'),
(173, 34, 'edit', 'Alterar Taxas Entrega Cotação Faixa'),
(174, 34, 'delete', 'Excluir Taxas Entrega Cotação Faixa'),
(175, 34, 'view', 'Visualizar Taxas Entrega Cotação Faixa'),
(176, 35, 'index', 'Listar Logs'),
(177, 35, 'view', 'Visualizar Log'),
(178, 5, 'gerenciarItens', 'Gerenciar Itens Pedidos/Comandas'),
(179, 36, 'add', 'Adicionar Desativamento Automático de Produto'),
(180, 36, 'index', 'Listar Desativamentos Automáticos de Produtos'),
(181, 36, 'view', 'Visualizar Desativamento Automático de Produto'),
(182, 36, 'edit', 'Alterar Desativamento Automático de Produto'),
(183, 36, 'delete', 'Excluir Desativamento Automático de Produto'),
(184, 35, 'index/true', 'Listar Notificações'),
(185, 37, 'index', 'Listar Situação Pedido x Notificação'),
(186, 37, 'add', 'Adicionar Situação Pedido x Notificação'),
(187, 37, 'edit', 'Alterar Situação Pedido x Notificação'),
(188, 37, 'view', 'Visualizar Situação Pedido x Notificação'),
(189, 37, 'delete', 'Excluir Situação Pedido x Notificação');

-- --------------------------------------------------------

--
-- Estrutura da tabela `alteracao_senhas`
--

DROP TABLE IF EXISTS `alteracao_senhas`;
CREATE TABLE IF NOT EXISTS `alteracao_senhas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `token` text COLLATE utf8_unicode_ci NOT NULL,
  `validade` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `usado` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `banners`
--

INSERT INTO `banners` (`id`, `midia_id`, `ativo`, `nome_banner`) VALUES
(5, 53, 1, 'Carne'),
(6, 54, 1, 'Cereal');

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
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `categorias_produtos`
--

INSERT INTO `categorias_produtos` (`id`, `empresa_id`, `midia_id`, `nome_categoria`, `descricao_categoria`, `created`, `modified`) VALUES
(22, 1, NULL, 'Pizzas', '', '2019-03-08 17:20:52', '2019-09-12 16:41:12'),
(23, 1, NULL, 'Bebidas', '', '2019-06-24 16:42:03', '2019-08-27 15:36:52'),
(24, 1, NULL, 'Lanches', '', '2019-07-19 21:50:20', '2019-08-27 15:36:43'),
(25, 1, NULL, 'Dogs', '', '2019-08-27 15:43:21', '2019-08-27 15:43:21'),
(26, 1, NULL, 'Porções', '', '2019-08-27 15:44:16', '2019-08-27 15:44:16');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `controllers`
--

DROP TABLE IF EXISTS `controllers`;
CREATE TABLE IF NOT EXISTS `controllers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome_controlador` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_nome_controlador` (`nome_controlador`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
(35, 'Logs'),
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
(36, 'ProgramarDesativarProdutos'),
(37, 'SituacaoPedidoNotificacao'),
(16, 'TaxasEntregasCotacao'),
(34, 'TaxasEntregasCotacaoFaixas'),
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
(1, 1, 'DESCONTO', 19, 30, 15, 0);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `empresas`
--

DROP TABLE IF EXISTS `empresas`;
CREATE TABLE IF NOT EXISTS `empresas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome_fantasia` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `cnpj` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `ie` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tipo_empresa` int(11) NOT NULL,
  `tipo_frete` int(11) NOT NULL DEFAULT '1',
  `ativa` tinyint(1) NOT NULL,
  `contatos` text COLLATE utf8_unicode_ci,
  `valor_base_erro_frete` double NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_empresa_cnpj` (`cnpj`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `empresas`
--

INSERT INTO `empresas` (`id`, `nome_fantasia`, `cnpj`, `user_id`, `ie`, `tipo_empresa`, `tipo_frete`, `ativa`, `contatos`, `valor_base_erro_frete`) VALUES
(1, 'Empresa Configuração ', '10.342.509/9000-00', 32, '000.000.000', 2, 2, 1, '[{\"tipo_contato\":\"1\",\"valor_contato\":\"facebook.com\\/andre.cristen\"},{\"tipo_contato\":\"4\",\"valor_contato\":\"andre.cristen@ladevsistemas.com.br\"},{\"tipo_contato\":\"2\",\"valor_contato\":\"(47)9780-2814\"},{\"tipo_contato\":\"3\",\"valor_contato\":\"(47) 3357-2825\"}]', 10),
(2, 'LaDev Sistemas', '', 33, '', 1, 3, 1, '[{\"tipo_contato\":\"4\",\"valor_contato\":\"suporte@ladevsistemas.com.br\"},{\"tipo_contato\":\"2\",\"valor_contato\":\"(47)9780-2814\"}]', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `enderecos`
--

DROP TABLE IF EXISTS `enderecos`;
CREATE TABLE IF NOT EXISTS `enderecos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `rua` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `numero` int(11) DEFAULT NULL,
  `bairro` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `cidade` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `estado` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cep` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `complemento` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `enderecos`
--

INSERT INTO `enderecos` (`id`, `user_id`, `rua`, `numero`, `bairro`, `cidade`, `estado`, `cep`, `complemento`) VALUES
(16, 16, 'Luiz rigo', 143, 'Ponto chic', 'Ibirama', 'SC', '89140-000', 'Casa com muro de pedra bruta na frente'),
(17, 8, 'Luiz rigo', 143, 'Ponto Chic', 'Ibirama', 'SC', '89140-000', 'Casa com muro de pedra bruta na frente'),
(21, 16, 'Dr. Getulio Vargas', 2875, 'Bela Vista', 'Ibirama', 'SC', '89140-000', 'Em frente a UDESC'),
(23, 16, 'Marques do Herval', 100, 'Centro', 'Ibirama', 'SC', '89140-000', 'Casa dois andares'),
(24, 16, '13 de Maio', 2757, 'Centro', 'José Boiteux', 'SC', '89145-000', 'Casa'),
(25, 16, 'Luiz Rigo', 143, 'Ponto Chic', 'Ibirama', 'SC', '89140-000', 'Casa dois andares'),
(26, 20, 'Luiz Rigo', 143, 'Ponto Chic', 'Ibirama', 'SC', '89140-000', 'Casa dois andares'),
(27, 20, 'Luiz Rigo', 143, 'Ponto Chic', 'Ibirama', 'SC', '89140-000', 'Casa dois andares'),
(28, 32, 'Luiz Rigo', 143, 'Ponto Chic', 'Ibirama', 'SC', '89140-000', 'Casa dois andares'),
(29, 31, '25 de Julho', 111, 'Centro', 'Ibirama', 'SC', '89140-000', 'Predio panorama');

-- --------------------------------------------------------

--
-- Estrutura da tabela `enderecos_empresas`
--

DROP TABLE IF EXISTS `enderecos_empresas`;
CREATE TABLE IF NOT EXISTS `enderecos_empresas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `empresa_id` int(11) NOT NULL,
  `rua` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
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
(2, 1, 'Dr. Getulio Vargas', 2875, 'Bela Vista', 'Ibirama', 'SC', '89140-000');

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
  `api_key` text COLLATE utf8_unicode_ci NOT NULL,
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
  `observacao` text COLLATE utf8_unicode_ci,
  `opicionais` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=137 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `listas`
--

INSERT INTO `listas` (`id`, `empresa_id`, `nome_lista`, `descricao_lista`, `titulo_lista`, `max_opcoes_selecionadas_lista`, `min_opcoes_selecionadas_lista`) VALUES
(133, 1, 'Adicionais', 'Adicionais X Burgueres', 'Adicionais', 0, 0),
(134, 1, 'Sabores pizzas', 'Sabores das pizzas', 'Sabores', 3, 1),
(135, 1, 'Opcionais Açaí', 'Opcionais para os acais', 'Adicional', 3, 1),
(136, 1, 'Tudo mesmo', 'Tudo e mais um pouco', 'Tudo mesmo', 15, 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=144 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `listas_opcoes_extras`
--

INSERT INTO `listas_opcoes_extras` (`id`, `lista_id`, `opcoes_extra_id`, `ativa`) VALUES
(117, 134, 15, 1),
(118, 134, 16, 1),
(119, 134, 17, 1),
(120, 134, 18, 1),
(121, 134, 19, 1),
(130, 135, 18, 1),
(131, 135, 20, 1),
(132, 135, 21, 1),
(133, 135, 19, 1),
(139, 133, 15, 1),
(140, 133, 16, 1),
(141, 133, 17, 1),
(142, 133, 18, 1),
(143, 133, 19, 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=141 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `listas_produtos`
--

INSERT INTO `listas_produtos` (`id`, `produto_id`, `lista_id`) VALUES
(139, 98, 133),
(100, 99, 133),
(140, 98, 134),
(101, 99, 134),
(138, 101, 135);

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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `logs`
--

INSERT INTO `logs` (`id`, `tipo`, `user_id`, `descricao`, `data_hora`, `situacao`) VALUES
(2, 1, 31, 'Seu pedido #1, teve uma alteração de situação. A nova situação é: Aguardando Confirmação.', '2019-10-24 22:42:41', 1),
(8, 1, 31, 'Seu pedido #1, teve uma alteração de situação. A nova situação é: Aguardando Coleta Cliente.', '2019-10-24 22:52:51', 1),
(9, 1, 31, 'Seu pedido #1, teve uma alteração de situação. A nova situação é: Saiu para entrega.', '2019-10-24 22:55:42', 1),
(10, 1, 31, 'Seu pedido #1, teve uma alteração de situação. A nova situação é: Aguardando Coleta Cliente.', '2019-10-24 22:56:40', 1),
(11, 1, 31, 'Seu pedido #1, teve uma alteração de situação. A nova situação é: Saiu para entrega.', '2019-10-24 22:59:38', 1),
(12, 1, 31, 'Seu pedido #1, teve uma alteração de situação. A nova situação é: Aguardando Coleta Cliente.', '2019-10-24 23:01:05', 1),
(13, 1, 31, 'Seu pedido #2, teve uma alteração de situação. A nova situação é: Aguardando Confirmação.', '2019-10-24 23:13:43', 1),
(14, 1, 31, 'Seu pedido #2, teve uma alteração de situação. A nova situação é: Em Produção.', '2019-10-24 23:14:11', 2),
(15, 1, 31, 'Seu pedido #2, teve uma alteração de situação. A nova situação é: Aguardando Entregador.', '2019-10-24 23:14:22', 2),
(16, 1, 31, 'Seu pedido #2, teve uma alteração de situação. A nova situação é: Saiu para entrega.', '2019-10-24 23:14:36', 2),
(17, 1, 31, 'Seu pedido #2, teve uma alteração de situação. A nova situação é: Entregue.', '2019-10-24 23:15:23', 2),
(18, 1, 31, 'Seu pedido #3, teve uma alteração de situação. A nova situação é: Aguardando Confirmação.', '2019-10-24 23:16:53', 2),
(19, 1, 31, 'Seu pedido #3, teve uma alteração de situação. A nova situação é: Em Produção.', '2019-10-24 23:17:04', 2),
(20, 1, 31, 'Seu pedido #3, teve uma alteração de situação. A nova situação é: Aguardando Coleta Cliente.', '2019-10-24 23:17:15', 2);

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
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `menus`
--

INSERT INTO `menus` (`id`, `modulo_id`, `action_id`, `nome_menu`, `ativo_menu`, `ordem_menu`, `icon_menu`) VALUES
(1, 1, 126, 'Painel', 1, 1, ''),
(2, 1, 160, 'Métricas de Vendas', 1, 2, ''),
(3, 1, 147, 'Contas', 1, 3, ''),
(4, 1, 145, 'Entregas', 1, 4, ''),
(5, 2, 129, 'Pedidos Painel', 1, 1, ''),
(6, 2, 127, 'Entregas', 1, 3, ''),
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
(33, 9, 110, 'Perfils', 1, 7, ''),
(34, 9, 100, 'Controllers', 1, 1, ''),
(35, 6, 184, 'Notificações', 1, 2, ''),
(36, 2, 24, 'Pedidos Lista', 1, 2, ''),
(37, 6, 185, 'Notificação Pedido', 1, 3, '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `midias`
--

DROP TABLE IF EXISTS `midias`;
CREATE TABLE IF NOT EXISTS `midias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `empresa_id` int(11) NOT NULL,
  `tipo_midia` int(11) NOT NULL,
  `path_midia` text COLLATE utf8_unicode_ci NOT NULL,
  `nome_midia` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `midias`
--

INSERT INTO `midias` (`id`, `empresa_id`, `tipo_midia`, `path_midia`, `nome_midia`) VALUES
(53, 1, 3, 'banners/upload_23_10_19_00_10_47_carne.jpg_carne.jpg', 'upload_23_10_19_00_10_47_carne.jpg'),
(54, 1, 3, 'banners/upload_23_10_19_00_10_13_cereal.jpg_cereal.jpg', 'upload_23_10_19_00_10_13_cereal.jpg');

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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `opcoes_extras`
--

INSERT INTO `opcoes_extras` (`id`, `empresa_id`, `nome_adicional`, `descricao_adicional`, `valor_adicional`) VALUES
(15, 1, 'Calabresa', 'Adicionar 3000 gramas de calabresa', '15.00'),
(16, 1, 'Frango', '300 gr', '12.00'),
(17, 1, 'Queijo', '250 gr', '8.00'),
(18, 1, 'Bacon', '300 gr', '11.00'),
(19, 1, 'Fritas', '500 gr', '13.00'),
(20, 1, 'Kiwi', '300GR DE KIWI', '3.50'),
(21, 1, 'Kit Kat', 'Um tablet de kit kat', '5.50');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
CREATE TABLE IF NOT EXISTS `pedidos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `cliente` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
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
  `motivo_rejeicao` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `observacao` text COLLATE utf8_unicode_ci,
  `opcionais` text COLLATE utf8_unicode_ci,
  `ambiente_producao_responsavel` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `perfils`
--

DROP TABLE IF EXISTS `perfils`;
CREATE TABLE IF NOT EXISTS `perfils` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome_perfil` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=204 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
(58, 55, 5),
(60, 57, 5),
(62, 60, 5),
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
(129, 126, 2),
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
(173, 25, 2),
(174, 167, 2),
(175, 168, 2),
(176, 169, 2),
(177, 170, 2),
(178, 65, 5),
(179, 68, 5),
(180, 3, 2),
(181, 171, 5),
(182, 172, 5),
(183, 173, 5),
(184, 174, 5),
(185, 175, 5),
(186, 105, 5),
(187, 107, 5),
(188, 108, 5),
(190, 177, 5),
(191, 178, 2),
(192, 179, 4),
(193, 180, 4),
(194, 181, 4),
(195, 182, 4),
(196, 183, 4),
(197, 184, 5),
(198, 176, 5),
(199, 185, 3),
(200, 186, 3),
(201, 187, 3),
(202, 188, 3),
(203, 189, 3);

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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
(11, 2, 30),
(12, 2, 32),
(13, 2, 33),
(14, 2, 34),
(15, 3, 34);

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
  `ambiente_venda` int(11) NOT NULL DEFAULT '1',
  `categorias_produto_id` int(11) NOT NULL,
  `descricao_produto` text COLLATE utf8_unicode_ci,
  `preco_produto` decimal(10,2) DEFAULT NULL,
  `ativo_produto` tinyint(1) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `categorias_produto_id` (`categorias_produto_id`),
  KEY `midia_id` (`midia_id`)
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`id`, `empresa_id`, `midia_id`, `nome_produto`, `ambiente_producao_responsavel`, `ambiente_venda`, `categorias_produto_id`, `descricao_produto`, `preco_produto`, `ativo_produto`, `created`, `modified`) VALUES
(98, 1, NULL, 'Pizza Grande', 1, 1, 22, 'Pizza Grande', '65.99', 1, '2019-04-20 22:12:14', '2019-10-22 23:27:06'),
(99, 1, NULL, 'Pizza Media', 1, 1, 22, 'Media', '50.00', 1, '2019-04-20 22:20:35', '2019-07-18 15:58:45'),
(100, 1, NULL, 'Coca Cola 600ml', 2, 1, 23, 'Coca cola 600 ml', '5.00', 1, '2019-04-29 21:55:00', '2019-07-18 15:58:50'),
(101, 1, NULL, 'Combo KIDS', 1, 1, 24, 'bana nutella doce bala e tals', '19.00', 1, '2019-07-19 21:51:46', '2019-08-06 16:55:48');

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
  `comentario` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `programar_desativar_produtos`
--

DROP TABLE IF EXISTS `programar_desativar_produtos`;
CREATE TABLE IF NOT EXISTS `programar_desativar_produtos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `produto_id` int(11) NOT NULL,
  `dia_semana` int(11) NOT NULL,
  `programacao_ativa` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_produto_dia_semana` (`produto_id`,`dia_semana`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `programar_desativar_produtos`
--

INSERT INTO `programar_desativar_produtos` (`id`, `produto_id`, `dia_semana`, `programacao_ativa`) VALUES
(8, 98, 2, 1),
(7, 98, 1, 1),
(9, 99, 1, 1),
(10, 99, 2, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `situacao_pedido_notificacao`
--

DROP TABLE IF EXISTS `situacao_pedido_notificacao`;
CREATE TABLE IF NOT EXISTS `situacao_pedido_notificacao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `situacao_pedido` int(11) NOT NULL,
  `template_titulo` text COLLATE utf8_unicode_ci NOT NULL,
  `template_mensagem` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_situacao_pedido` (`situacao_pedido`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `situacao_pedido_notificacao`
--

INSERT INTO `situacao_pedido_notificacao` (`id`, `situacao_pedido`, `template_titulo`, `template_mensagem`) VALUES
(1, 7, '{{nomeSistema}} - Alteração pedido #{{pedido}}', '<table style=\"width:100%;border-spacing:0;border-collapse:collapse;vertical-align:top;text-align:inherit;margin:0 auto;padding:0\">\r\n    <tbody>\r\n    <tr>\r\n        <td style=\"padding:20px;color:#555;line-height:25px;font-size:16px\">\r\n            <p>\r\n                <center>\r\n                Olá <b>{{cliente}}</b>,\r\n                <br>\r\n                <br>\r\n                <span>Seu pedido #{{pedido}}, acabou de sair para entrega, e logo estará no endereço solicitado, fique ligado.</span>\r\n                <br>\r\n                <br>\r\n                </center>\r\n            </p>\r\n            <center>\r\n                <a href=\"{{linkSite}}/pedidos/ver-status/{{pedido}}\" style=\"padding:10px;display:block;border-radius:6px;background:#1e9ed0;color:#fff;text-decoration:none;font-size:24px; width: 285px;\" target=\"_blank\">VER <span class=\"m_9139932422997049828il\">PEDIDO</span></a>\r\n            </center>\r\n            <br>\r\n            <br>\r\n            <br>\r\n            <br>\r\n            <br>\r\n            <br>\r\n        </td>\r\n    </tr>\r\n    </tbody>\r\n</table>\r\n<center>\r\n    <h2>Atenciosamente equipe {{nomeLoja}}</h2>\r\n    <span style=\"padding:20px;color:#555;line-height:25px;font-size:16px\">Não responda este e-mail</span>\r\n</center>'),
(2, 8, '{{nomeSistema}} - Alteração pedido #{{pedido}}', '<table style=\"width:100%;border-spacing:0;border-collapse:collapse;vertical-align:top;text-align:inherit;margin:0 auto;padding:0\">\r\n    <tbody>\r\n    <tr>\r\n        <td style=\"padding:20px;color:#555;line-height:25px;font-size:16px\">\r\n            <p>\r\n                <center>\r\n                Olá <b>{{cliente}}</b>,\r\n                <br>\r\n                <br>\r\n                <span>Seu pedido #{{pedido}}, está prontinho, pedimos que você retire-o em nosso estabelecimento como definido no momento da compra.</span>\r\n                <br>\r\n                <br>\r\n                </center>\r\n            </p>\r\n            <center>\r\n                <a href=\"{{linkSite}}/pedidos/ver-status/{{pedido}}\" style=\"padding:10px;display:block;border-radius:6px;background:#1e9ed0;color:#fff;text-decoration:none;font-size:24px; width: 285px;\" target=\"_blank\">VER <span class=\"m_9139932422997049828il\">PEDIDO</span></a>\r\n            </center>\r\n            <br>\r\n            <br>\r\n            <br>\r\n            <br>\r\n            <br>\r\n            <br>\r\n        </td>\r\n    </tr>\r\n    </tbody>\r\n</table>\r\n<center>\r\n    <h2>Atenciosamente equipe {{nomeLoja}}</h2>\r\n    <span style=\"padding:20px;color:#555;line-height:25px;font-size:16px\">Não responda este e-mail</span>\r\n</center>');

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `taxas_entregas_cotacao`
--

INSERT INTO `taxas_entregas_cotacao` (`id`, `empresa_id`, `valor_km`, `arredondamento_tipo`, `ativo`) VALUES
(6, 1, '2.00', 2, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `taxas_entregas_cotacao_faixas`
--

DROP TABLE IF EXISTS `taxas_entregas_cotacao_faixas`;
CREATE TABLE IF NOT EXISTS `taxas_entregas_cotacao_faixas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `empresa_id` int(11) NOT NULL,
  `kilometro_inicio` int(11) NOT NULL,
  `kilometro_fim` int(11) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `ativo` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `taxas_entregas_cotacao_faixas`
--

INSERT INTO `taxas_entregas_cotacao_faixas` (`id`, `empresa_id`, `kilometro_inicio`, `kilometro_fim`, `valor`, `ativo`) VALUES
(1, 1, 0, 3, '3.00', 1),
(2, 1, 3, 6, '5.00', 1),
(3, 1, 6, 10, '8.00', 1),
(4, 1, 10, 15, '12.00', 1),
(5, 1, 15, 25, '18.00', 1),
(6, 1, 25, 32, '26.00', 1),
(7, 1, 32, 90, '45.00', 1);

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
  `nome_completo` text COLLATE utf8_unicode_ci NOT NULL,
  `tipo` smallint(6) NOT NULL DEFAULT '1',
  `empresa_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  `apelido` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `login` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `password` text COLLATE utf8_unicode_ci NOT NULL,
  `dia_nascimento` int(11) NOT NULL,
  `mes_nascimento` int(11) NOT NULL,
  `ano_nascimento` int(11) NOT NULL,
  `token` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `nome_completo`, `tipo`, `empresa_id`, `created`, `modified`, `apelido`, `login`, `password`, `dia_nascimento`, `mes_nascimento`, `ano_nascimento`, `token`) VALUES
(8, 'LaDev Sistemas', 3, 2, '2019-01-28 23:59:32', '2019-06-24 16:52:11', 'LaDev', 'master@ladev.com', '$2y$10$wWXWh1YjSOH5t4.zPo7/TOIkL7pxVsxgIl84MyqxH6x2aOg5d9WBe', 3, 9, 2000, NULL),
(16, 'Cliente Ladevzinho', 1, 2, '2019-02-05 22:14:18', '2019-07-30 18:13:38', 'Cliente Fiel', 'cliente@ladev.com', '$2y$10$T/zE2x/mnm1pImpmdITE9.XIgx/JxS8l3lMi.1UpcBtnQJ08BhbYi', 3, 9, 2000, NULL),
(20, 'Empresa Demonstração', 2, 1, '2019-02-14 21:40:09', '2019-10-21 19:43:46', 'Demonstração Lanches e Delivery', 'empresa@ladev.com', '$2y$10$xL/DkDmDdVeZsX6ccQPnmOa7i0YyQxsgMLr41A96WdTHQ4ws4jZaG', 10, 10, 2018, '1983c62f9bec745995464528c3c9bbc7'),
(27, 'Entregador', 4, 1, '2019-04-27 14:07:43', '2019-10-21 19:45:23', 'Entregador', 'entregador@ladev.com', '$2y$10$hjD5nvw5NHwUsDO.DVYBMOEjAAOiy3CZscdhofnFxrilG30wa0u0W', 12, 11, 1987, 'c47ae61b3c9598fd66f8a3afce1fee37'),
(30, 'Operador', 2, 1, '2019-07-17 20:51:30', '2019-10-21 19:45:29', '', 'operador@ladev.com', '$2y$10$b7.JSKDwkwfCO8RH8A/qqOAVjgoLBF3CvU2qIKJVIiaOPz7AiNWum', 3, 9, 2000, '7ae7d8a3f5ae1af2929693a0b88c4e9a'),
(31, 'André Cristen', 1, 2, '2019-07-22 16:18:14', '2019-10-20 05:14:20', 'Dedé Cliente', 'andrecristenibirama@gmail.com', '$2y$10$1x0mIWxz2IHKl4MAEHNrvO7rP4.iIGR.ecfvC38G3/vQuxYxOfqPS', 3, 9, 2000, NULL),
(32, 'Empresa Configuração', 5, 1, '2019-09-23 18:09:06', '2019-09-26 23:10:26', '', 'comercial@empresaconfiguracao.com.br', '$2y$10$oh7DZiUWBnso67Sdl2lSuOjfULdPjTG4VrUGKTSM42aXbPnICcz6e', 3, 9, 2000, NULL),
(33, 'LaDev Sistemas', 5, 1, '2019-09-26 21:21:20', '2019-09-26 21:21:20', '', 'suporte@ladevsistemas.com.br', '$2y$10$6MTKxb0TqE3nCMEiHsmhJuttvrj/6eEM5iotQ2yBQgnwlRv23dr4O', 3, 9, 2000, NULL),
(34, 'Técnico', 2, 1, '2019-10-24 17:28:30', '2019-10-24 17:28:30', '', 'tecnico@ladev.com', '$2y$10$HkxhoeeG6nfUjnFBYpuzYOy256VfEvh6nGB04awzxKyJ94Sjr5th6', 3, 9, 2000, '27292e0171b615654cf76bb07e45af9f');

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
(1, 16, 1, '97144728'),
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
