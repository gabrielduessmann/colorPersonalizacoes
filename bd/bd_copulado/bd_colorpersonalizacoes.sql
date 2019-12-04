-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 02-Dez-2019 às 03:51
-- Versão do servidor: 10.1.38-MariaDB
-- versão do PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bd_colorpersonalizacoes`
--


CREATE SCHEMA IF NOT EXISTS `bd_colorpersonalizacoes` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin ;
USE `bd_colorpersonalizacoes` ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

CREATE TABLE `categorias` (
  `codigo` tinyint(3) UNSIGNED ZEROFILL NOT NULL COMMENT 'Campo responsável por armazenar o código das categorias.',
  `nome` varchar(50) COLLATE utf8_bin NOT NULL COMMENT 'Campo responsável por armazenar o nome das categorias.',
  `descricao` text COLLATE utf8_bin COMMENT 'Campo responsável por armazenar a descrição de cada categoria.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tabela responsável pelas categorias dos produtos disponíveis na empresa.\n';

--
-- Extraindo dados da tabela `categorias`
--

INSERT INTO `categorias` (`codigo`, `nome`, `descricao`) VALUES
(001, 'Caneca', NULL),
(002, 'Camisa', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE `clientes` (
  `id` bigint(20) UNSIGNED ZEROFILL NOT NULL COMMENT 'Campo responsável por armazenar o id dos clientes.',
  `nome` varchar(70) COLLATE utf8_bin NOT NULL COMMENT 'Campo responsável por armazenar o nome dos clientes.',
  `cpf` bigint(11) UNSIGNED ZEROFILL DEFAULT NULL COMMENT 'Campo responsável por armazenar o CPF dos clientes.',
  `cnpj` bigint(14) UNSIGNED ZEROFILL DEFAULT NULL COMMENT 'Campo responsável por armazenar o CNPJ da empresa a que será prestado serviço.',
  `fone1` bigint(11) UNSIGNED NOT NULL COMMENT 'Campo responsável por armazenar o telefone principal dos clientes.',
  `fone2` bigint(11) UNSIGNED DEFAULT NULL COMMENT 'Campo responsável por armazenar o telefone secundário dos clientes, caso ele possua outro.',
  `inscricaoestadual` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'Campo responsável por armazenar a inscrição estadual  das empresas.',
  `estado` char(2) COLLATE utf8_bin NOT NULL COMMENT 'Campo responsável por armazenar o estado dos clientes.',
  `cidade` varchar(60) COLLATE utf8_bin NOT NULL COMMENT 'Campo responsável por armazenar a cidade dos clientes.',
  `cep` int(8) UNSIGNED ZEROFILL NOT NULL COMMENT 'Campo responsável por armazenar o CEP dos clientes.',
  `email` varchar(100) COLLATE utf8_bin NOT NULL COMMENT 'Campo responsável por armazenar o email dos clientes.',
  `numero` smallint(5) UNSIGNED NOT NULL COMMENT 'Campo responsável por armazenar o número da residência dos clientes.',
  `bairro` varchar(60) COLLATE utf8_bin NOT NULL COMMENT 'Campo responsável por armazenar o bairro da residência dos clientes.',
  `rua` varchar(100) COLLATE utf8_bin NOT NULL COMMENT 'Campo responsável por armazenar a rua da residência dos clientes.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tabela responsável pelos dados cadastrais dos clientes das empresas.';

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`id`, `nome`, `cpf`, `cnpj`, `fone1`, `fone2`, `inscricaoestadual`, `estado`, `cidade`, `cep`, `email`, `numero`, `bairro`, `rua`) VALUES
(00000000000000000001, 'Joao Vitor', 54785834943, NULL, 3429583497, 0, NULL, 'SC', 'SÃ£o Paulo', 54959496, 'joaovitor@gmail.com', 321, 'Santo Agostinho', 'Bandeirante Amilton'),
(00000000000000000002, 'Gisele Freitas', 37487837584, NULL, 3982948032, 0, NULL, 'PR', 'Curitiba', 85956506, 'gisele.f@gmail.com', 412, 'Flores', 'SÃ£o Marcos');

-- --------------------------------------------------------

--
-- Estrutura da tabela `orcamentos`
--

CREATE TABLE `orcamentos` (
  `codigo` int(10) UNSIGNED NOT NULL COMMENT 'Campo responsável por armazenar os códigos dos orçamentos.',
  `dataemissao` date NOT NULL COMMENT 'Campo responsável por armazenar as datas de emissão dos orçamentos.',
  `parcelas` tinyint(2) UNSIGNED DEFAULT NULL COMMENT 'Campo responsável por armazenar as parcelas dos orçamentos.',
  `desconto` tinyint(3) UNSIGNED DEFAULT NULL COMMENT 'Campo responsável por armazenar o descontos dos orçamentos.',
  `cidade` varchar(60) COLLATE utf8_bin DEFAULT NULL COMMENT 'Campo responsável por armazenar a cidade onde serão entregue os produtos dos orçamentos.',
  `cep` int(8) UNSIGNED ZEROFILL DEFAULT NULL COMMENT 'Campo responsável por armazenar o CEP de onde serão entregues os produtos dos orçamentos.',
  `estado` char(2) COLLATE utf8_bin DEFAULT NULL COMMENT 'Campo responsável por armazenar o estado onde serão entregues os produtos dos orçamentos.',
  `rua` varchar(100) COLLATE utf8_bin DEFAULT NULL COMMENT 'Campo responsável por armazenar a rua onde serão entregues os produtos dos orçamentos.',
  `numero` smallint(5) UNSIGNED DEFAULT NULL COMMENT 'Campo responsável por armazenar o número de onde serão entregues os produtos dos orçamentos.',
  `bairro` varchar(60) COLLATE utf8_bin DEFAULT NULL COMMENT 'Campo responsável por armazenar o bairro onde serão entregues os produtos dos orçamentos.',
  `usuarios_id` smallint(5) UNSIGNED ZEROFILL NOT NULL COMMENT 'Campo responsável informar qual usuário foi responsável pelo orçamento.',
  `clientes_id` bigint(20) UNSIGNED ZEROFILL NOT NULL COMMENT 'Campo responsável por informar de qual cliente é o orçamento.',
  `status` tinyint(2) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tabela responsável por armazenar os orçamentos do sistema.';

--
-- Extraindo dados da tabela `orcamentos`
--

INSERT INTO `orcamentos` (`codigo`, `dataemissao`, `parcelas`, `desconto`, `cidade`, `cep`, `estado`, `rua`, `numero`, `bairro`, `usuarios_id`, `clientes_id`, `status`) VALUES
(1, '2019-12-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 00001, 00000000000000000001, 1),
(2, '2019-12-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 00001, 00000000000000000002, 1),
(3, '2019-12-02', 3, 50, NULL, NULL, NULL, NULL, NULL, NULL, 00001, 00000000000000000001, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `orcamentos_has_produtos`
--

CREATE TABLE `orcamentos_has_produtos` (
  `orcamentos_codigo` int(10) UNSIGNED ZEROFILL NOT NULL COMMENT 'Campo responsável pelo código determinante do orçamento que possui os determinados produtos.',
  `produtos_codigo` int(10) UNSIGNED ZEROFILL NOT NULL COMMENT 'Campo responsável pelo código determinante do produto que está contido no orçamento.',
  `quantidade` tinyint(3) UNSIGNED NOT NULL COMMENT 'Campo responsável pela quantidade de produtos no orçamento.',
  `precoatual` decimal(6,2) UNSIGNED NOT NULL COMMENT 'Campo responsável pelo preço atual (unitário) do produto do orçamento.',
  `descricaoestampa` text COLLATE utf8_bin COMMENT 'Campo responsável pela descrição sobre como deve ser a estampa no produto.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tabela responsável por guardar e ligar o produto ao orçamento que o gerou.';

--
-- Extraindo dados da tabela `orcamentos_has_produtos`
--

INSERT INTO `orcamentos_has_produtos` (`orcamentos_codigo`, `produtos_codigo`, `quantidade`, `precoatual`, `descricaoestampa`) VALUES
(0000000001, 0000000001, 2, '5.00', ''),
(0000000002, 0000000002, 1, '20.00', ''),
(0000000002, 0000000003, 1, '25.00', ''),
(0000000003, 0000000002, 3, '20.00', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ordensservicos`
--

CREATE TABLE `ordensservicos` (
  `codigo` int(10) UNSIGNED NOT NULL COMMENT 'Campo responsável por armazenar o códigos das ordens de serviço.',
  `status` tinyint(2) UNSIGNED NOT NULL COMMENT 'Campo responsável por armazenar o status das ordens de serviço.',
  `dataemissao` date NOT NULL COMMENT 'Campo responsável por armazenar a data de emissão das ordens de serviço.',
  `dataentrega` date NOT NULL COMMENT 'Campo responsável por armazenar a data de entrega das ordens de serviço.',
  `orcamentos_codigo` int(10) UNSIGNED ZEROFILL NOT NULL COMMENT 'Campo responsável por informar qual orçamento deu origem à ordem de serviço.',
  `usuarios_id` smallint(5) UNSIGNED ZEROFILL NOT NULL COMMENT 'Campo responsável por informar qual usuário confirmou a ordem de serviço.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tabela responsável por armazenar as ordens de serviço do sistema.';

--
-- Extraindo dados da tabela `ordensservicos`
--

INSERT INTO `ordensservicos` (`codigo`, `status`, `dataemissao`, `dataentrega`, `orcamentos_codigo`, `usuarios_id`) VALUES
(1, 1, '2019-12-02', '2019-12-04', 0000000003, 00001);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `codigo` int(10) UNSIGNED ZEROFILL NOT NULL COMMENT 'Campo responsável por armazenar o código dos produtos.',
  `nomeProduto` varchar(100) COLLATE utf8_bin NOT NULL COMMENT 'Campo responsável por armazenar o nome do produto.',
  `categorias_codigo` tinyint(3) UNSIGNED ZEROFILL NOT NULL COMMENT 'Campo responsável por armazenar o código da categoria dos produtos.',
  `preco_unitario` decimal(6,2) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tabela responsável pelos dados armazenados sobre os produtos desenvolvidos na empresa.';

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`codigo`, `nomeProduto`, `categorias_codigo`, `preco_unitario`) VALUES
(0000000001, 'Netflix', 001, '5.00'),
(0000000002, 'Batman', 002, '20.00'),
(0000000003, 'Homem aranha', 002, '25.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` smallint(5) UNSIGNED ZEROFILL NOT NULL COMMENT 'Campo responsável pelo código determinante do perfil do usuário.',
  `usuario` varchar(50) COLLATE utf8_bin NOT NULL COMMENT 'Campo responsável pelo nome de usuário do funcionário.',
  `senha` char(32) COLLATE utf8_bin NOT NULL COMMENT 'Campo responsável pela senha do usuário do funcionário.',
  `cpf` bigint(11) UNSIGNED ZEROFILL NOT NULL COMMENT 'Campo responsável pelo CPF do funcionário.',
  `nome` varchar(70) COLLATE utf8_bin NOT NULL COMMENT 'Campo responsável pelo nome completo do funcionário.',
  `graupermissao` tinyint(3) UNSIGNED ZEROFILL NOT NULL COMMENT 'Campo responsável pelo grau de permissão do usuário do funcionário na empresa (Customizador, atendente e diretor).',
  `fone1` bigint(11) UNSIGNED NOT NULL COMMENT 'Campo responsável pelo telefone principal do funcionário.',
  `fone2` bigint(11) UNSIGNED DEFAULT NULL COMMENT 'Campo responsável pelo telefone secundário do funcionário, caso ele possua outro.',
  `email` varchar(100) COLLATE utf8_bin NOT NULL COMMENT 'Campo responsável pelo email do funcionário cadastrado no usuário.',
  `cep` int(8) UNSIGNED ZEROFILL NOT NULL COMMENT 'Campo responsável pelo CEP da residência do funcionário.',
  `rua` varchar(100) COLLATE utf8_bin NOT NULL COMMENT 'Campo responsável pela rua que o funcionário habita.',
  `numero` smallint(5) UNSIGNED NOT NULL COMMENT 'Campo responsável pelo número da casa/apartamento que o funcionário habita.\n',
  `cidade` varchar(60) COLLATE utf8_bin NOT NULL COMMENT 'Campo responsável pela cidade que o funcionário habita.',
  `bairro` varchar(60) COLLATE utf8_bin NOT NULL COMMENT 'Campo responsável pelo bairro que o funcionário habita.',
  `estado` char(2) COLLATE utf8_bin NOT NULL COMMENT 'Campo responsável pelo estado que o funcionário habita.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tabela responsável por conter os usuários do site, sendo estes os funcionários.';

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `senha`, `cpf`, `nome`, `graupermissao`, `fone1`, `fone2`, `email`, `cep`, `rua`, `numero`, `cidade`, `bairro`, `estado`) VALUES
(00001, 'adm', '25d55ad283aa400af464c76d713c07ad', 87309176583, 'Simone S.', 001, 73920175483, NULL, 'simones@gmail.com', 47390087, 'Rua XV de Novembro', 249, 'Joinville', 'Bom Retiro', 'SC'),
(00002, 'janderson', '25d55ad283aa400af464c76d713c07ad', 43243824932, 'Janderson Pablo', 003, 43950394565, NULL, 'jande.pablo@gmail.com', 59046950, 'EspedicionÃ¡rio', 241, 'Laguna', 'Florida', 'SC'),
(00003, 'bruna', '25d55ad283aa400af464c76d713c07ad', 93903059903, 'Bruna Faria', 002, 48483949303, NULL, 'bruna.faria@gmai.com', 48935940, 'Benjamin Constant', 38, 'Inbituba', 'Serrinha', 'SC');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`codigo`);

--
-- Indexes for table `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cpf_UNIQUE` (`cpf`),
  ADD UNIQUE KEY `cnpj_UNIQUE` (`cnpj`),
  ADD UNIQUE KEY `inscricaoestadual_UNIQUE` (`inscricaoestadual`);

--
-- Indexes for table `orcamentos`
--
ALTER TABLE `orcamentos`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `fk_orcamentos_usuarios_idx` (`usuarios_id`),
  ADD KEY `fk_orcamentos_clientes1_idx` (`clientes_id`);

--
-- Indexes for table `orcamentos_has_produtos`
--
ALTER TABLE `orcamentos_has_produtos`
  ADD PRIMARY KEY (`orcamentos_codigo`,`produtos_codigo`),
  ADD KEY `fk_orcamentos_has_produtos_produtos1_idx` (`produtos_codigo`),
  ADD KEY `fk_orcamentos_has_produtos_orcamentos1_idx` (`orcamentos_codigo`);

--
-- Indexes for table `ordensservicos`
--
ALTER TABLE `ordensservicos`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `fk_ordensservicos_orcamentos1_idx` (`orcamentos_codigo`),
  ADD KEY `fk_ordensservicos_usuarios1_idx` (`usuarios_id`);

--
-- Indexes for table `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `fk_produtos_categorias1_idx` (`categorias_codigo`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cpf_UNIQUE` (`cpf`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categorias`
--
ALTER TABLE `categorias`
  MODIFY `codigo` tinyint(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Campo responsável por armazenar o código das categorias.', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` bigint(20) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Campo responsável por armazenar o id dos clientes.', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orcamentos`
--
ALTER TABLE `orcamentos`
  MODIFY `codigo` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Campo responsável por armazenar os códigos dos orçamentos.', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ordensservicos`
--
ALTER TABLE `ordensservicos`
  MODIFY `codigo` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Campo responsável por armazenar o códigos das ordens de serviço.', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `produtos`
--
ALTER TABLE `produtos`
  MODIFY `codigo` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Campo responsável por armazenar o código dos produtos.', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` smallint(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Campo responsável pelo código determinante do perfil do usuário.', AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `orcamentos`
--
ALTER TABLE `orcamentos`
  ADD CONSTRAINT `fk_orcamentos_clientes1` FOREIGN KEY (`clientes_id`) REFERENCES `clientes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_orcamentos_usuarios` FOREIGN KEY (`usuarios_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `orcamentos_has_produtos`
--
ALTER TABLE `orcamentos_has_produtos`
  ADD CONSTRAINT `fk_orcamentos_has_produtos_orcamentos1` FOREIGN KEY (`orcamentos_codigo`) REFERENCES `orcamentos` (`codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_orcamentos_has_produtos_produtos1` FOREIGN KEY (`produtos_codigo`) REFERENCES `produtos` (`codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `ordensservicos`
--
ALTER TABLE `ordensservicos`
  ADD CONSTRAINT `fk_ordensservicos_orcamentos1` FOREIGN KEY (`orcamentos_codigo`) REFERENCES `orcamentos` (`codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ordensservicos_usuarios1` FOREIGN KEY (`usuarios_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `produtos`
--
ALTER TABLE `produtos`
  ADD CONSTRAINT `fk_produtos_categorias1` FOREIGN KEY (`categorias_codigo`) REFERENCES `categorias` (`codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
