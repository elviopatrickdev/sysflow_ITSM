-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 11-Mar-2026 às 18:02
-- Versão do servidor: 8.0.17
-- versão do PHP: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `ti_system`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `requests`
--

CREATE TABLE `requests` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `status` varchar(50) DEFAULT 'Pendente',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `requests`
--

INSERT INTO `requests` (`id`, `user_id`, `type`, `description`, `status`, `created_at`) VALUES
(1, 1, 'Hardware', 'Funcionário solicita monitor adicional para produtividade.', 'Aprovado', '2026-03-11 16:35:20'),
(2, 1, 'Software', 'Instalação do Photoshop', 'Pendente', '2026-03-11 16:35:39'),
(3, 1, 'Acesso', 'Acesso ao sistema financeiro', 'Aprovado', '2026-03-11 16:35:50'),
(4, 1, 'Hardware', 'Teclado novo', 'Pendente', '2026-03-11 16:36:25'),
(5, 1, 'Acesso', 'Acesso à pasta de marketing', 'Aprovado', '2026-03-11 16:36:43'),
(6, 1, 'Software', 'Instalar Power BI', 'Aprovado', '2026-03-11 16:37:00'),
(7, 1, 'Hardware', 'Notebook para novo colaborador', 'Pendente', '2026-03-11 16:37:26'),
(8, 1, 'Software', 'Instalação do AutoCAD', 'Rejeitado', '2026-03-11 16:37:35'),
(9, 1, 'Acesso', 'Conta VPN', 'Aprovado', '2026-03-11 16:37:51'),
(10, 1, 'Hardware', 'Dock station', 'Pendente', '2026-03-11 16:38:01'),
(11, 1, 'Software', 'Licença Microsoft Project', 'Rejeitado', '2026-03-11 16:38:08'),
(12, 1, 'Acesso', 'Acesso ao SharePoint', 'Aprovado', '2026-03-11 16:38:16'),
(13, 1, 'Hardware', 'Mouse ergonômico', 'Pendente', '2026-03-11 16:38:35'),
(14, 1, 'Software', 'Instalação do VS Code', 'Aprovado', '2026-03-11 16:38:44'),
(15, 1, 'Acesso', 'Criar conta de email', 'Aprovado', '2026-03-11 16:38:55');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `priority` varchar(50) NOT NULL,
  `status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'aberto',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `tickets`
--

INSERT INTO `tickets` (`id`, `title`, `description`, `priority`, `status`, `created_at`) VALUES
(1, 'Outlook não envia emails', 'Outlook apresenta erro ao tentar enviar emails externos.', 'Alta', 'Em progresso', '2026-03-11 16:32:02'),
(2, 'Impressora do RH offline', 'Impressora da sala de RH não está respondendo na rede.', 'Média', 'Resolvido', '2026-03-11 16:32:24'),
(3, 'Computador muito lento', 'Estação do departamento financeiro demora para abrir aplicações.', 'Média', 'aberto', '2026-03-11 16:32:39'),
(4, 'VPN não conecta', 'Funcionário remoto não consegue conectar à VPN da empresa.', 'Alta', 'Resolvido', '2026-03-11 16:32:53'),
(5, 'Tela azul no Windows', 'Computador reiniciando com erro de tela azul.', 'Alta', 'Em progresso', '2026-03-11 16:33:03'),
(6, 'Wi-Fi instável', 'Conexão Wi-Fi no 2º andar cai constantemente.', 'Média', 'aberto', '2026-03-11 16:33:18'),
(7, 'Não consigo acessar ERP', 'Usuário não consegue acessar o sistema ERP da empresa.', 'Alta', 'Em progresso', '2026-03-11 16:33:30'),
(8, 'Monitor não liga', 'Monitor da estação de trabalho não liga após ligar o PC.', 'Baixa', 'aberto', '2026-03-11 16:33:42'),
(9, 'Problema no scanner', 'Scanner do departamento administrativo não digitaliza documentos.', 'Baixa', 'Em progresso', '2026-03-11 16:33:58'),
(10, 'Acesso negado à pasta de rede', 'Usuário perdeu acesso à pasta compartilhada do setor.', 'Média', 'aberto', '2026-03-11 16:34:13');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `role` varchar(50) DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
