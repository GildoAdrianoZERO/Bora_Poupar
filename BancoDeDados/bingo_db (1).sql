-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 03/02/2026 às 20:45
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bingo_db`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `meta_alvo` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `bingo_data` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `meta_alvo`, `created_at`, `bingo_data`) VALUES
(2, 'Gildo Adriano', 'gildoandriano165@gmail.com', '$2y$10$Fg1dg.uApSw/QYMEJS230uCpysO2xTuQkvG6Ih8trapxPAyA.0YNy', 10000, '2026-02-03 13:41:47', '[{\"valor\":200,\"pago\":true},{\"valor\":50,\"pago\":true},{\"valor\":50,\"pago\":true},{\"valor\":200,\"pago\":false},{\"valor\":5,\"pago\":true},{\"valor\":10,\"pago\":true},{\"valor\":50,\"pago\":true},{\"valor\":5,\"pago\":true},{\"valor\":200,\"pago\":true},{\"valor\":200,\"pago\":true},{\"valor\":20,\"pago\":true},{\"valor\":5,\"pago\":false},{\"valor\":10,\"pago\":true},{\"valor\":200,\"pago\":true},{\"valor\":20,\"pago\":true},{\"valor\":5,\"pago\":true},{\"valor\":200,\"pago\":true},{\"valor\":20,\"pago\":false},{\"valor\":50,\"pago\":false},{\"valor\":20,\"pago\":false},{\"valor\":50,\"pago\":false},{\"valor\":100,\"pago\":false},{\"valor\":20,\"pago\":true},{\"valor\":5,\"pago\":true},{\"valor\":200,\"pago\":true},{\"valor\":5,\"pago\":true},{\"valor\":100,\"pago\":false},{\"valor\":50,\"pago\":false},{\"valor\":20,\"pago\":false},{\"valor\":5,\"pago\":true},{\"valor\":20,\"pago\":true},{\"valor\":20,\"pago\":true},{\"valor\":200,\"pago\":true},{\"valor\":100,\"pago\":true},{\"valor\":5,\"pago\":true},{\"valor\":20,\"pago\":false},{\"valor\":50,\"pago\":true},{\"valor\":10,\"pago\":true},{\"valor\":20,\"pago\":true},{\"valor\":100,\"pago\":true},{\"valor\":200,\"pago\":false},{\"valor\":50,\"pago\":false},{\"valor\":200,\"pago\":false},{\"valor\":10,\"pago\":false},{\"valor\":100,\"pago\":false},{\"valor\":5,\"pago\":false},{\"valor\":200,\"pago\":false},{\"valor\":200,\"pago\":false},{\"valor\":200,\"pago\":false},{\"valor\":20,\"pago\":false},{\"valor\":20,\"pago\":true},{\"valor\":50,\"pago\":false},{\"valor\":20,\"pago\":false},{\"valor\":20,\"pago\":false},{\"valor\":50,\"pago\":false},{\"valor\":10,\"pago\":false},{\"valor\":5,\"pago\":false},{\"valor\":100,\"pago\":false},{\"valor\":5,\"pago\":false},{\"valor\":100,\"pago\":false},{\"valor\":5,\"pago\":false},{\"valor\":5,\"pago\":false},{\"valor\":200,\"pago\":false},{\"valor\":100,\"pago\":false},{\"valor\":5,\"pago\":false},{\"valor\":100,\"pago\":false},{\"valor\":10,\"pago\":false},{\"valor\":10,\"pago\":false},{\"valor\":5,\"pago\":false},{\"valor\":10,\"pago\":false},{\"valor\":20,\"pago\":false},{\"valor\":20,\"pago\":false},{\"valor\":20,\"pago\":false},{\"valor\":5,\"pago\":false},{\"valor\":20,\"pago\":false},{\"valor\":200,\"pago\":false},{\"valor\":50,\"pago\":false},{\"valor\":20,\"pago\":false},{\"valor\":200,\"pago\":false},{\"valor\":20,\"pago\":false},{\"valor\":10,\"pago\":false},{\"valor\":20,\"pago\":false},{\"valor\":20,\"pago\":false},{\"valor\":100,\"pago\":false},{\"valor\":5,\"pago\":false},{\"valor\":20,\"pago\":false},{\"valor\":10,\"pago\":false},{\"valor\":200,\"pago\":false},{\"valor\":200,\"pago\":false},{\"valor\":50,\"pago\":false},{\"valor\":100,\"pago\":false},{\"valor\":20,\"pago\":false},{\"valor\":5,\"pago\":false},{\"valor\":200,\"pago\":false},{\"valor\":20,\"pago\":false},{\"valor\":10,\"pago\":false},{\"valor\":200,\"pago\":false},{\"valor\":10,\"pago\":false},{\"valor\":5,\"pago\":false},{\"valor\":10,\"pago\":false},{\"valor\":100,\"pago\":false},{\"valor\":5,\"pago\":false},{\"valor\":20,\"pago\":false},{\"valor\":5,\"pago\":false},{\"valor\":50,\"pago\":false},{\"valor\":10,\"pago\":false},{\"valor\":10,\"pago\":false},{\"valor\":20,\"pago\":false},{\"valor\":200,\"pago\":false},{\"valor\":200,\"pago\":false},{\"valor\":100,\"pago\":false},{\"valor\":10,\"pago\":false},{\"valor\":10,\"pago\":false},{\"valor\":100,\"pago\":false},{\"valor\":5,\"pago\":false},{\"valor\":200,\"pago\":false},{\"valor\":20,\"pago\":false},{\"valor\":10,\"pago\":false},{\"valor\":50,\"pago\":false},{\"valor\":50,\"pago\":false},{\"valor\":20,\"pago\":false},{\"valor\":10,\"pago\":false},{\"valor\":5,\"pago\":false},{\"valor\":200,\"pago\":false},{\"valor\":10,\"pago\":false},{\"valor\":10,\"pago\":false},{\"valor\":5,\"pago\":false},{\"valor\":50,\"pago\":false},{\"valor\":100,\"pago\":false},{\"valor\":5,\"pago\":false},{\"valor\":20,\"pago\":false},{\"valor\":200,\"pago\":false},{\"valor\":100,\"pago\":false},{\"valor\":5,\"pago\":false},{\"valor\":20,\"pago\":false},{\"valor\":100,\"pago\":false},{\"valor\":10,\"pago\":false},{\"valor\":50,\"pago\":false},{\"valor\":10,\"pago\":false},{\"valor\":100,\"pago\":false},{\"valor\":100,\"pago\":false},{\"valor\":5,\"pago\":false},{\"valor\":100,\"pago\":false},{\"valor\":5,\"pago\":false},{\"valor\":5,\"pago\":false},{\"valor\":10,\"pago\":false},{\"valor\":50,\"pago\":false},{\"valor\":50,\"pago\":false},{\"valor\":200,\"pago\":false},{\"valor\":10,\"pago\":false},{\"valor\":100,\"pago\":false},{\"valor\":10,\"pago\":false},{\"valor\":50,\"pago\":false},{\"valor\":5,\"pago\":false},{\"valor\":20,\"pago\":false},{\"valor\":20,\"pago\":false},{\"valor\":5,\"pago\":false},{\"valor\":5,\"pago\":false},{\"valor\":10,\"pago\":false},{\"valor\":50,\"pago\":false},{\"valor\":200,\"pago\":false},{\"valor\":100,\"pago\":false},{\"valor\":5,\"pago\":false},{\"valor\":5,\"pago\":false},{\"valor\":50,\"pago\":false},{\"valor\":200,\"pago\":false}]');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
