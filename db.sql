-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 01-Maio-2019 às 14:40
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
) ENGINE=InnoDB AUTO_INCREMENT=143 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
(142, 5, 'rejeitar', 'Rejeitar Pedido');

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
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
(29, 'Financeiro'),
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
  `vezes_usado` int(11) DEFAULT '0',
  `maximo_vezes_usar` int(11) NOT NULL,
  `valor_desconto` int(11) NOT NULL,
  `porcentagem` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
CREATE TABLE IF NOT EXISTS `pedidos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `cliente` varchar(450) COLLATE utf8_unicode_ci DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `valor_total_cobrado` decimal(10,2) NOT NULL,
  `observacao` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `opcionais` json DEFAULT NULL,
  `ambiente_producao_responsavel` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=106 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=MyISAM AUTO_INCREMENT=148 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
(32, 25, 2),
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
(59, 56, 5),
(60, 57, 5),
(61, 58, 5),
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
(147, 142, 2);

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
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
(7, 4, 20);

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
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `tipo` int(11) NOT NULL,
  `nome` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `tempo_medio_producao_minutos` int(11) NOT NULL,
  `ativo` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `empresa_id` (`empresa_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `nome_completo`, `tipo`, `empresa_id`, `created`, `modified`, `apelido`, `login`, `password`, `dia_nascimento`, `mes_nascimento`, `ano_nascimento`) VALUES
(8, 'André Cristen LADEV', 3, 2, '2019-01-28 23:59:32', '2019-04-22 16:14:21', 'Dezinh', 'andrecristenibirama@gmail.com', '$2y$10$wWXWh1YjSOH5t4.zPo7/TOIkL7pxVsxgIl84MyqxH6x2aOg5d9WBe', 3, 9, 2000),
(16, 'André Cristen Cliente', 1, 2, '2019-02-05 22:14:18', '2019-02-15 21:39:25', 'TESTE LADEV CLIENTE', 'andre.cristen@ladev.com', '$2y$10$NNNttUN6hZNz9NBWPXB2AOe4nacaYwnR0QkiZEy/LznND2TxGkMem', 3, 9, 2000),
(20, 'Baiucas Lanches', 2, 1, '2019-02-14 21:40:09', '2019-04-25 21:42:35', 'Baiucas Lanches e Delivery', 'baiucas.admin@gmail.com', '$2y$10$xL/DkDmDdVeZsX6ccQPnmOa7i0YyQxsgMLr41A96WdTHQ4ws4jZaG', 3, 9, 2000),
(21, 'LaDev - Software', 2, 2, '2019-02-28 16:30:38', '2019-03-27 16:14:19', 'Ladelivery', 'ladev.sistemas@gmail.com', '$2y$10$RcrpWZi7np6wn1qV..Nn.OqoGbCTvY9IfbC.wVaQKmL61eRfp34VO', 3, 9, 2000),
(22, 'André Cristen', 2, 1, '2019-03-19 17:04:53', '2019-04-27 14:49:13', '123', 'andrecristenibirama@gmail.com1', '$2y$10$nepDfgLtK4hWc9Ndib/Tr.h5/0iEmflnv7C3BPl7tmGo8kwJizCr6', 1, 1, 1),
(23, 'André Cristen', 1, 2, '2019-03-19 17:05:20', '2019-03-19 17:05:20', 'Dezinh do funk', 'de@de.com', '$2y$10$kL2mVxabAH2RoqorZJmOdehZ4/NN0BvstQpHr3Zbxhq3MXj9GT.A6', 132, 12, 12),
(24, 'Fernando Cristen', 1, 2, '2019-04-03 17:32:34', '2019-04-03 17:32:34', 'Fefe', 'cristenfernando@gmail.com', '$2y$10$jeceWEZJWr1dhYxkZ0Dz1ukZyX2Nn4546d/jbrSy0kRnp8G2f5L/m', 6, 11, 2001),
(27, 'Ze do Grau', 4, 1, '2019-04-27 14:07:43', '2019-04-27 14:07:43', 'Grau e mais', 'zedograu@grau.com', '$2y$10$B0hHAi1D0OMEprUOdONEs.C2k9hz/NeIBFLnhYhsL3cvlWvnZDWW6', 12, 13, 1213);

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
