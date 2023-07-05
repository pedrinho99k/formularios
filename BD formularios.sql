-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 07-Nov-2022 às 19:13
-- Versão do servidor: 10.4.17-MariaDB
-- versão do PHP: 7.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `formularios`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `fm_formularios`
--

CREATE TABLE `fm_formularios` (
  `form_codigo` int(11) NOT NULL,
  `form_nome` varchar(90) DEFAULT 'NULL',
  `form_sigla` varchar(90) DEFAULT NULL,
  `form_ativo` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `fm_formulario_perfil`
--

CREATE TABLE `fm_formulario_perfil` (
  `fp_codigo` int(11) NOT NULL,
  `fp_codigo_formulario` int(11) DEFAULT NULL,
  `fp_codigo_perfil` int(11) DEFAULT NULL,
  `fp_ativo` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `fm_perfil`
--

CREATE TABLE `fm_perfil` (
  `per_codigo` int(11) NOT NULL,
  `per_descricao` varchar(90) DEFAULT 'NULL',
  `per_ativo` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `fm_perfil`
--

INSERT INTO `fm_perfil` (`per_codigo`, `per_descricao`, `per_ativo`) VALUES
(1, 'Administrador', 'SIM'),
(2, 'Usuario', 'SIM'),
(3, 'Colab. Qualidade', 'SIM'),
(4, 'Colab. Enfermagem', 'SIM'),
(5, 'Colab. SADT', 'SIM'),
(6, 'Colab. Centro Cirúrgico', 'SIM'),
(7, 'Colab. SCIH', 'SIM'),
(8, 'Sup. Enfermagem', 'SIM'),
(9, 'Sup. Centro Cirúrgico', 'SIM'),
(10, 'Sup. SADT', 'SIM'),
(11, 'Sup. Qualidade', 'SIM'),
(12, 'Sup. T.I', 'SIM');

-- --------------------------------------------------------

--
-- Estrutura da tabela `fm_questoes`
--

CREATE TABLE `fm_questoes` (
  `ques_codigo` int(11) NOT NULL,
  `ques_descricao` text DEFAULT NULL,
  `ques_sigla` text DEFAULT NULL,
  `ques_html` text DEFAULT NULL,
  `ques_codigo_formulario` int(11) NOT NULL,
  `ques_ativo` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `fm_registros`
--

CREATE TABLE `fm_registros` (
  `reg_codigo` int(11) NOT NULL,
  `reg_codigo_formulario` int(11) DEFAULT NULL,
  `reg_codigo_usuario` int(11) DEFAULT NULL,
  `reg_codigo_registro` int(11) DEFAULT NULL,
  `reg_tipo` varchar(20) NOT NULL,
  `reg_sql` text NOT NULL,
  `reg_data_hora` datetime DEFAULT NULL,
  `reg_ativo` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `fm_usuarios`
--

CREATE TABLE `fm_usuarios` (
  `usu_codigo` int(11) NOT NULL,
  `usu_login` varchar(90) DEFAULT 'NULL',
  `usu_senha` varchar(90) DEFAULT 'NULL',
  `usu_nome` varchar(90) DEFAULT 'NULL',
  `usu_email` varchar(90) DEFAULT 'NULL',
  `usu_ativo` varchar(3) NOT NULL DEFAULT 'SIM',
  `usu_codigo_perfil` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `fm_usuarios`
--

INSERT INTO `fm_usuarios` (`usu_codigo`, `usu_login`, `usu_senha`, `usu_nome`, `usu_email`, `usu_ativo`, `usu_codigo_perfil`) VALUES
(1, 'guilherme.santos', 'NULL', 'Guilherme Marins Dos Santos', 'programador@hospitalhr.com.br', 'SIM', 1),
(2, 'dauan.silva', 'NULL', 'Dauan Ribeiro Silva', '', 'SIM', 2),
(3, 'Diego.inacio', 'NULL', 'Diego Wander Martins Inacio', '', 'SIM', 2),
(4, 'lilian.costa', 'NULL', 'Lilian Helena Ferreira Gomes da Costa', 'lilian.costa@hospitalhr.com.br', 'SIM', 2),
(5, 'jorge.netto', 'NULL', 'Jorge Alves De Oliveira Netto', 'jorge.netto@hospitalhr.com.br', 'SIM', 12),
(6, 'isabella.carvalho', 'NULL', 'Isabella Teles de Carvalho', '', 'SIM', 3),
(7, 'ricardo.souza', 'NULL', 'Ricardo Euripedes de Souza', 'ricardo.souza@hospitalhr.com.br', 'SIM', 2);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `fm_formularios`
--
ALTER TABLE `fm_formularios`
  ADD PRIMARY KEY (`form_codigo`);

--
-- Índices para tabela `fm_formulario_perfil`
--
ALTER TABLE `fm_formulario_perfil`
  ADD PRIMARY KEY (`fp_codigo`),
  ADD KEY `fp_codigo_formulario` (`fp_codigo_formulario`),
  ADD KEY `fp_codigo_perfil` (`fp_codigo_perfil`);

--
-- Índices para tabela `fm_perfil`
--
ALTER TABLE `fm_perfil`
  ADD PRIMARY KEY (`per_codigo`) USING BTREE;

--
-- Índices para tabela `fm_questoes`
--
ALTER TABLE `fm_questoes`
  ADD PRIMARY KEY (`ques_codigo`),
  ADD KEY `fk_ques_codigo_formulario` (`ques_codigo_formulario`);

--
-- Índices para tabela `fm_registros`
--
ALTER TABLE `fm_registros`
  ADD PRIMARY KEY (`reg_codigo`),
  ADD KEY `reg_codigo_formulario` (`reg_codigo_formulario`),
  ADD KEY `reg_codigo_usuario` (`reg_codigo_usuario`);

--
-- Índices para tabela `fm_usuarios`
--
ALTER TABLE `fm_usuarios`
  ADD PRIMARY KEY (`usu_codigo`),
  ADD KEY `usu_codigo_perfil` (`usu_codigo_perfil`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `fm_formularios`
--
ALTER TABLE `fm_formularios`
  MODIFY `form_codigo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `fm_formulario_perfil`
--
ALTER TABLE `fm_formulario_perfil`
  MODIFY `fp_codigo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `fm_perfil`
--
ALTER TABLE `fm_perfil`
  MODIFY `per_codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `fm_questoes`
--
ALTER TABLE `fm_questoes`
  MODIFY `ques_codigo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `fm_registros`
--
ALTER TABLE `fm_registros`
  MODIFY `reg_codigo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `fm_usuarios`
--
ALTER TABLE `fm_usuarios`
  MODIFY `usu_codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `fm_formulario_perfil`
--
ALTER TABLE `fm_formulario_perfil`
  ADD CONSTRAINT `fm_formulario_perfil_ibfk_1` FOREIGN KEY (`fp_codigo_formulario`) REFERENCES `fm_formularios` (`form_codigo`),
  ADD CONSTRAINT `fm_formulario_perfil_ibfk_2` FOREIGN KEY (`fp_codigo_perfil`) REFERENCES `fm_perfil` (`per_codigo`);

--
-- Limitadores para a tabela `fm_questoes`
--
ALTER TABLE `fm_questoes`
  ADD CONSTRAINT `fk_ques_codigo_formulario` FOREIGN KEY (`ques_codigo_formulario`) REFERENCES `fm_formularios` (`form_codigo`);

--
-- Limitadores para a tabela `fm_registros`
--
ALTER TABLE `fm_registros`
  ADD CONSTRAINT `fm_registros_ibfk_1` FOREIGN KEY (`reg_codigo_formulario`) REFERENCES `fm_formularios` (`form_codigo`),
  ADD CONSTRAINT `fm_registros_ibfk_2` FOREIGN KEY (`reg_codigo_usuario`) REFERENCES `fm_usuarios` (`usu_codigo`);

--
-- Limitadores para a tabela `fm_usuarios`
--
ALTER TABLE `fm_usuarios`
  ADD CONSTRAINT `usu_codigo_perfil` FOREIGN KEY (`usu_codigo_perfil`) REFERENCES `fm_perfil` (`per_codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
