-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 21/02/2024 às 12:02
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bd_proj_gon`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `cep` varchar(9) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `genero` varchar(50) NOT NULL,
  `data_nascimento` date NOT NULL,
  `cpf` varchar(15) NOT NULL,
  `foto` int(50) NOT NULL,
  `status` int(1) NOT NULL,
  `logradouro` char(100) NOT NULL,
  `numero` int(255) NOT NULL,
  `complemento` char(100) NOT NULL,
  `bairro` text NOT NULL,
  `cidade` varchar(100) NOT NULL,
  `uf` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `nome`, `cep`, `telefone`, `genero`, `data_nascimento`, `cpf`, `foto`, `status`, `logradouro`, `numero`, `complemento`, `bairro`, `cidade`, `uf`) VALUES
(1, 'MARCOS VINICIUS BARBOSA 02', '12071-839', '(12)98196-6901', 'M', '1996-12-23', '44682975811', 0, 1, 'Rua João Gonçalves dos Santos', 14, 'casa', 'Conjunto Habitacional Humberto Passarelli', 'Taubaté', 'SP'),
(4, 'MARCOS VINICIUS BARBOSA 01', '12071-839', '(12)98196-6901', 'M', '1996-12-23', '44682975812', 0, 1, 'Rua João Gonçalves dos Santos', 14, 'casa', 'Conjunto Habitacional Humberto Passarelli', 'Taubaté', 'SP'),
(5, 'MARCOS VINICIUS BARBOSA 02', '12071839', '1121651681', 'M', '0000-00-00', '51516515621', 0, 0, 'Rua João Gonçalves dos Santos', 14, 'casa', 'Conjunto Habitacional Humberto Passarelli', 'Taubaté', 'SP'),
(6, 'MARCOS VINICIUS BARBOSA 07', '', '1111111111', 'M', '0000-00-00', '15165165165', 0, 1, '', 0, '', '', '', ''),
(7, 'MARCOS VINICIUS BARBOSA 06', '', '1651651891', 'M', '0000-00-00', '15616161651', 0, 1, '', 0, '', '', '', ''),
(8, 'MARCOS VINICIUS BARBOSA 05', '', '1651651891', 'M', '0000-00-00', '15616161651', 0, 0, '', 0, '', '', '', '');

-- --------------------------------------------------------

--
-- Estrutura para tabela `colaboradores`
--

CREATE TABLE `colaboradores` (
  `id_colaborador` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `cpf_cnpj` varchar(18) NOT NULL,
  `tipo` int(1) NOT NULL,
  `telefone` varchar(15) NOT NULL,
  `cep` varchar(9) NOT NULL,
  `logradouro` varchar(100) NOT NULL,
  `numero` int(255) NOT NULL,
  `bairro` varchar(50) NOT NULL,
  `cidade` varchar(50) NOT NULL,
  `complemento` text NOT NULL,
  `data_cadastro` varchar(10) NOT NULL,
  `foto` varchar(50) NOT NULL,
  `uf` varchar(2) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `colaboradores`
--

INSERT INTO `colaboradores` (`id_colaborador`, `nome`, `cpf_cnpj`, `tipo`, `telefone`, `cep`, `logradouro`, `numero`, `bairro`, `cidade`, `complemento`, `data_cadastro`, `foto`, `uf`, `status`) VALUES
(1, 'marcos vinicius barbosa  01', '44682975811', 0, '1298941614', '12071839', 'Rua João Gonçalves dos Santos', 14, 'Conjunto Habitacional Humberto Passarelli', 'Taubaté', 'casa', '2024-01-30', '', 'SP', 0),
(2, 'marcos', '15616516516', 0, '1216516516', '', '', 0, '', '', '', '2024-01-30', '', '', 1),
(3, 'marcos vinicius barbosa 02', '15616516516', 0, '1216516516', '', '', 0, '', '', '', '2024-01-30', '', '', 1),
(4, 'marcos vinicius barbosa 03', '15616516516', 0, '1216516516', '', '', 0, '', '', '', '2024-01-30', '', '', 1),
(5, 'marcos vinicius barbosa 03', '15616516516', 0, '1216516516', '', '', 0, '', '', '', '2024-01-30', '', '', 1),
(6, 'marcos vinicius barbosa 04', '23315315631', 0, '1265165165', '', '', 0, '', '', '', '2024-01-30', '', '', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `local_atividade`
--

CREATE TABLE `local_atividade` (
  `id_local` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `cnpj` varchar(18) NOT NULL,
  `tipo` int(1) NOT NULL,
  `cep` varchar(9) NOT NULL,
  `logradouro` varchar(100) NOT NULL,
  `numero` int(255) NOT NULL,
  `bairro` varchar(50) NOT NULL,
  `cidade` varchar(50) NOT NULL,
  `complemento` text NOT NULL,
  `data_cadastro` date NOT NULL,
  `uf` varchar(2) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `local_atividade`
--

INSERT INTO `local_atividade` (`id_local`, `nome`, `cnpj`, `tipo`, `cep`, `logradouro`, `numero`, `bairro`, `cidade`, `complemento`, `data_cadastro`, `uf`, `status`) VALUES
(1, 'local1', '11111111111111', 0, '11111111', 'rua1', 1, 'bairro1', 'cidade1', 'complemento1', '2001-01-01', 'sp', 1),
(2, 'local2', '22222222222222', 0, '22222222', 'rua2', 1, 'bairro2', 'cidade2', 'complemento2', '2002-02-02', 'sp', 0),
(3, 'local3', '33333333333333', 0, '33333333', 'rua3', 1, 'bairro3', 'cidade3', 'complemento3', '2003-03-03', 'sp', 0),
(4, 'local4', '44444444444444', 0, '12071839', 'Rua João Gonçalves dos Santos', 14, 'Conjunto Habitacional Humberto Passarelli', 'Taubaté', 'casa', '2024-02-17', 'SP', 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `rl_colaborador_servico`
--

CREATE TABLE `rl_colaborador_servico` (
  `id_relacao` int(11) NOT NULL,
  `id_colaborador` int(11) NOT NULL,
  `id_servico` int(11) NOT NULL,
  `status` int(2) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `rl_colaborador_servico`
--

INSERT INTO `rl_colaborador_servico` (`id_relacao`, `id_colaborador`, `id_servico`, `status`) VALUES
(1, 1, 1, 1),
(11, 2, 1, 0),
(12, 3, 1, 0),
(13, 4, 9, 0),
(14, 4, 10, 0),
(15, 4, 1, 0),
(16, 5, 1, 0),
(17, 6, 1, 0),
(18, 6, 11, 0),
(19, 5, 11, 0),
(20, 6, 9, 1),
(21, 6, 8, 1),
(22, 1, 9, 1),
(23, 1, 10, 1),
(24, 1, 8, 1),
(25, 1, 11, 1),
(26, 4, 11, 1),
(27, 4, 8, 1),
(28, 4, 3, 1),
(29, 4, 2, 1),
(30, 3, 10, 1),
(31, 3, 8, 1),
(32, 3, 9, 1),
(33, 3, 11, 1),
(34, 3, 2, 1),
(35, 3, 3, 1),
(36, 5, 10, 1),
(37, 5, 8, 1),
(38, 5, 9, 1),
(39, 2, 10, 1),
(40, 6, 4, 1),
(41, 6, 2, 1),
(42, 6, 3, 1),
(43, 6, 10, 1),
(47, 2, 5, 1),
(48, 2, 8, 1),
(50, 2, 11, 1),
(52, 2, 9, 1),
(53, 2, 2, 1),
(54, 2, 3, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `rl_local_colaborador`
--

CREATE TABLE `rl_local_colaborador` (
  `id_relacao` int(11) NOT NULL,
  `id_colaborador` int(11) NOT NULL,
  `id_local` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `rl_local_colaborador`
--

INSERT INTO `rl_local_colaborador` (`id_relacao`, `id_colaborador`, `id_local`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 3, 2),
(4, 4, 2);

-- --------------------------------------------------------

--
-- Estrutura para tabela `servicos`
--

CREATE TABLE `servicos` (
  `id_servico` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `descricao` text NOT NULL,
  `tempo` int(2) NOT NULL,
  `valor` decimal(7,2) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `servicos`
--

INSERT INTO `servicos` (`id_servico`, `nome`, `descricao`, `tempo`, `valor`, `status`) VALUES
(1, 'Undercut', 'O undercut é aquele corte com volume no topo da cabeça e completamente raspado na nuca e laterais.', 10, 190.00, 1),
(2, 'Americano', 'A tendência do momento é o corte americano, que nada mais é do que a variação de um corte baixo masculino clássico, o militar. A diferença está nas possibilidades: alto, médio, baixo ou disfarçado, as opções são as mais diversas para quem quer estar hype sem perder a versatilidade.', 30, 25.00, 0),
(3, 'fade', 'o corte degradê, que também é conhecido como fade, ganhou a atenção dos homens que buscam um visual moderno. Para chegar nesse estilo de cabelo curto masculino, as laterais devem ser raspadas ou mais baixas que o topo da cabeça, formando justamente o efeito de degradê.', 30, 30.00, 0),
(4, 'Jaca', 'Cabelo na régua e sombreado perfeito são as melhores características para descrever o corte do jaca. Democrático, ele combina com todos os tipos de cabelo e ainda pode receber estilizações, como riscos, desenhos e reflexos alinhados.', 30, 25.00, 0),
(5, 'Repicado', 'Para quem quer deixar os fios curtos, mas nem tanto, sugerimos que faça um dos cortes de cabelo masculino curto repicado na tesoura. Isso vai ajudar a deixar os visual leve e com movimento.', 30, 30.00, 0),
(6, 'Militar', 'ambém conhecido como ‘crew cut’, o corte militar é outra opção de cortes de cabelo curto masculino certeira para quem busca um curtinho prático para o dia a dia. O estilo recebe esse nome porque foi popularizado pelos soldados americanos nos anos 30. Não há como negar que é um charme!', 25, 20.00, 0),
(7, 'Caesar', 'O corte caesar é perfeito para quem quer começar a disfarçar os sinais da calvície. Ele é marcado por uma lateral geométrica e uma franjinha reta e curtinha.', 20, 15.00, 0),
(8, 'Nudred', 'Embora seja uma texturização, esse estilo de cabelo pode ser perfeito para quem tem fios curtos crespos ou afro. Será necessária uma esponja específica com furos para criar os “falsos dreads“', 30, 25.00, 1),
(9, 'Social', 'Esse cabelo curto masculino é o corte tradicional e clássico que muitos homens adoram. A maior vantagem é a praticidade na hora de cuidar dos fios, porém será preciso ir mais vezes à barbearia para fazer a manutenção.', 30, 25.00, 1),
(10, 'Moicano', 'Ousado na medida: esse é o famoso moicano disfarçado! O corte combina com os cabelos lisos, sendo as laterais mais baixas ou, então, raspadas, mantendo o topo levantado. Para isso, é essencial investir em um bom finalizador.', 30, 25.00, 1),
(11, 'Buzzcut', 'Para quem busca praticidade do dia a dia e não tem paciência para dedicar tempo para estilizar os fios, o buzz cut – ou corte raspado – é ótima opção de corte de cabelo curto masculino! Só não se esqueça de usar o protetor solar para evitar danos ao couro cabeludo que fica exposto', 30, 25.00, 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Índices de tabela `colaboradores`
--
ALTER TABLE `colaboradores`
  ADD PRIMARY KEY (`id_colaborador`);

--
-- Índices de tabela `local_atividade`
--
ALTER TABLE `local_atividade`
  ADD PRIMARY KEY (`id_local`);

--
-- Índices de tabela `rl_colaborador_servico`
--
ALTER TABLE `rl_colaborador_servico`
  ADD PRIMARY KEY (`id_relacao`);

--
-- Índices de tabela `rl_local_colaborador`
--
ALTER TABLE `rl_local_colaborador`
  ADD PRIMARY KEY (`id_relacao`);

--
-- Índices de tabela `servicos`
--
ALTER TABLE `servicos`
  ADD PRIMARY KEY (`id_servico`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `colaboradores`
--
ALTER TABLE `colaboradores`
  MODIFY `id_colaborador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `local_atividade`
--
ALTER TABLE `local_atividade`
  MODIFY `id_local` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `rl_colaborador_servico`
--
ALTER TABLE `rl_colaborador_servico`
  MODIFY `id_relacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT de tabela `rl_local_colaborador`
--
ALTER TABLE `rl_local_colaborador`
  MODIFY `id_relacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `servicos`
--
ALTER TABLE `servicos`
  MODIFY `id_servico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
