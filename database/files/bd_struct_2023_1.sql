-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 17/07/2023 às 18:19
-- Versão do servidor: 8.0.21
-- Versão do PHP: 8.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT = @@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS = @@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION = @@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bd_project`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations`
(
    `id`        int UNSIGNED                            NOT NULL AUTO_INCREMENT,
    `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `batch`     int                                     NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_avaliacao`
--

DROP TABLE IF EXISTS `tb_avaliacao`;
CREATE TABLE IF NOT EXISTS `tb_avaliacao`
(
    `id`           bigint UNSIGNED NOT NULL AUTO_INCREMENT,
    `fk_user`      bigint UNSIGNED NOT NULL,
    `fk_turma`     bigint UNSIGNED DEFAULT NULL,
    `nota`         bigint          NOT NULL,
    `descricao`    varchar(255)    NOT NULL,
    `fk_professor` bigint UNSIGNED DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_denuncia`
--

DROP TABLE IF EXISTS `tb_denuncia`;
CREATE TABLE IF NOT EXISTS `tb_denuncia`
(
    `id`           bigint UNSIGNED NOT NULL AUTO_INCREMENT,
    `descricao`    varchar(255)    NOT NULL,
    `fk_avaliacao` bigint UNSIGNED NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_departamento`
--

DROP TABLE IF EXISTS `tb_departamento`;
CREATE TABLE IF NOT EXISTS `tb_departamento`
(
    `id`   bigint UNSIGNED NOT NULL AUTO_INCREMENT,
    `nome` varchar(255)    NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_disciplina`
--

DROP TABLE IF EXISTS `tb_disciplina`;
CREATE TABLE IF NOT EXISTS `tb_disciplina`
(
    `id`              varchar(7) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci   NOT NULL,
    `nome`            varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
    `fk_departamento` bigint UNSIGNED                                               NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_professor`
--

DROP TABLE IF EXISTS `tb_professor`;
CREATE TABLE IF NOT EXISTS `tb_professor`
(
    `id`              bigint UNSIGNED NOT NULL AUTO_INCREMENT,
    `nome`            varchar(255)    NOT NULL,
    `fk_departamento` bigint UNSIGNED NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_turma`
--

DROP TABLE IF EXISTS `tb_turma`;
CREATE TABLE IF NOT EXISTS `tb_turma`
(
    `id`              bigint UNSIGNED NOT NULL AUTO_INCREMENT,
    `turma`           varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
    `periodo`         varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
    `professor`       varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
    `horario`         varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
    `vagas_ocupadas`  int                                                           DEFAULT '0',
    `total_vagas`     int                                                           DEFAULT '0',
    `local`           varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
    `fk_disciplina`   varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
    `fk_departamento` bigint UNSIGNED                                               DEFAULT '0',
    PRIMARY KEY (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_user`
--

DROP TABLE IF EXISTS `tb_user`;
CREATE TABLE IF NOT EXISTS `tb_user`
(
    `id`        bigint UNSIGNED NOT NULL AUTO_INCREMENT,
    `nome`      varchar(255)    NOT NULL,
    `email`     varchar(255)    NOT NULL,
    `matricula` varchar(10)     NOT NULL,
    `curso`     varchar(255)    NOT NULL,
    `senha`     varchar(255)    NOT NULL,
    `avatar`    blob,
    `admin`     tinyint(1)      NOT NULL DEFAULT '0',
    PRIMARY KEY (`id`),
    UNIQUE KEY `matricula` (`matricula`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura stand-in para view `vw_avaliacao`
-- (Veja abaixo para a visão atual)
--
DROP VIEW IF EXISTS `vw_avaliacao`;
CREATE TABLE IF NOT EXISTS `vw_avaliacao`
(
    `curso`        varchar(255),
    `departamento` varchar(255),
    `descricao`    varchar(255),
    `disciplina`   varchar(255),
    `id`           bigint unsigned,
    `id_turma`     bigint unsigned,
    `id_user`      bigint unsigned,
    `nome`         varchar(255),
    `nota`         bigint,
    `professor`    varchar(255)
);

-- --------------------------------------------------------

--
-- Estrutura stand-in para view `vw_denuncias`
-- (Veja abaixo para a visão atual)
--
DROP VIEW IF EXISTS `vw_denuncias`;
CREATE TABLE IF NOT EXISTS `vw_denuncias`
(
    `curso`        varchar(255),
    `denuncia`     varchar(255),
    `departamento` varchar(255),
    `descricao`    varchar(255),
    `disciplina`   varchar(255),
    `id`           bigint unsigned,
    `id_turma`     bigint unsigned,
    `id_user`      bigint unsigned,
    `nome`         varchar(255),
    `nota`         bigint,
    `professor`    varchar(255)
);

-- --------------------------------------------------------

--
-- Estrutura stand-in para view `vw_turma`
-- (Veja abaixo para a visão atual)
--
DROP VIEW IF EXISTS `vw_turma`;
CREATE TABLE IF NOT EXISTS `vw_turma`
(
    `departamento` varchar(255),
    `disciplina`   varchar(255),
    `horario`      varchar(255),
    `id`           bigint unsigned,
    `local`        varchar(255),
    `periodo`      varchar(255),
    `professor`    varchar(255),
    `turma`        varchar(100),
    `vagas`        varchar(23)
);

ALTER TABLE
    `tb_denuncia`
    ADD CONSTRAINT `tb_denuncia_fk_avaliacao_foreign` FOREIGN KEY (fk_avaliacao) REFERENCES `tb_avaliacao` (`id`);
ALTER TABLE
    `tb_avaliacao`
    ADD CONSTRAINT `tb_avaliacao_fk_user_foreign` FOREIGN KEY (`fk_user`) REFERENCES `tb_user` (`id`);
ALTER TABLE
    `tb_turma`
    ADD CONSTRAINT `tb_turma_fk_disciplina_foreign` FOREIGN KEY (`fk_disciplina`) REFERENCES `tb_disciplina` (`id`);
ALTER TABLE
    `tb_disciplina`
    ADD CONSTRAINT `tb_disciplina_fk_departamento_foreign` FOREIGN KEY (`fk_departamento`) REFERENCES `tb_departamento` (`id`);
ALTER TABLE
    `tb_avaliacao`
    ADD CONSTRAINT `tb_avaliacao_fk_turma_foreign` FOREIGN KEY (`fk_turma`) REFERENCES `tb_turma` (`id`);
ALTER TABLE
    `tb_avaliacao`
    ADD CONSTRAINT `tb_avaliacao_fk_professor_foreign` FOREIGN KEY (`fk_professor`) REFERENCES `tb_professor` (`id`);
ALTER TABLE
    `tb_turma`
    ADD CONSTRAINT `tb_turma_fk_departamento_foreign` FOREIGN KEY (`fk_departamento`) REFERENCES `tb_departamento` (`id`);
ALTER TABLE
    `tb_professor`
    ADD CONSTRAINT `tb_professor_fk_departamento_foreign` FOREIGN KEY (`fk_departamento`) REFERENCES `tb_departamento` (`id`);


-- --------------------------------------------------------

--
-- Estrutura para view `vw_avaliacao`
--
DROP TABLE IF EXISTS `vw_avaliacao`;

DROP VIEW IF EXISTS `vw_avaliacao`;
CREATE ALGORITHM = UNDEFINED DEFINER =`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_avaliacao` AS
SELECT `ta`.`id`           AS `id`,
       `tu`.`id`           AS `id_user`,
       `vt`.`id`           AS `id_turma`,
       `tu`.`nome`         AS `nome`,
       `tu`.`curso`        AS `curso`,
       `vt`.`professor`    AS `professor`,
       `vt`.`disciplina`   AS `disciplina`,
       `vt`.`departamento` AS `departamento`,
       `ta`.`nota`         AS `nota`,
       `ta`.`descricao`    AS `descricao`
FROM ((`tb_avaliacao` `ta` join `tb_user` `tu` on ((`ta`.`fk_user` = `tu`.`id`))) join `vw_turma` `vt`
      on ((`ta`.`fk_turma` = `vt`.`id`)));

-- --------------------------------------------------------

--
-- Estrutura para view `vw_denuncias`
--
DROP TABLE IF EXISTS `vw_denuncias`;

DROP VIEW IF EXISTS `vw_denuncias`;
CREATE ALGORITHM = UNDEFINED DEFINER =`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_denuncias` AS
SELECT `td`.`descricao`    AS `denuncia`,
       `va`.`id`           AS `id`,
       `va`.`id_user`      AS `id_user`,
       `va`.`id_turma`     AS `id_turma`,
       `va`.`nome`         AS `nome`,
       `va`.`curso`        AS `curso`,
       `va`.`professor`    AS `professor`,
       `va`.`disciplina`   AS `disciplina`,
       `va`.`departamento` AS `departamento`,
       `va`.`nota`         AS `nota`,
       `va`.`descricao`    AS `descricao`
FROM (`tb_denuncia` `td` join `vw_avaliacao` `va` on ((`td`.`fk_avaliacao` = `va`.`id`)));

-- --------------------------------------------------------

--
-- Estrutura para view `vw_turma`
--
DROP TABLE IF EXISTS `vw_turma`;

DROP VIEW IF EXISTS `vw_turma`;
CREATE ALGORITHM = UNDEFINED DEFINER =`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_turma` AS
SELECT `tt`.`id`                                              AS `id`,
       `tt`.`turma`                                           AS `turma`,
       `tt`.`periodo`                                         AS `periodo`,
       `tt`.`professor`                                       AS `professor`,
       `tt`.`horario`                                         AS `horario`,
       concat(`tt`.`vagas_ocupadas`, '/', `tt`.`total_vagas`) AS `vagas`,
       `tt`.`local`                                           AS `local`,
       `td`.`nome`                                            AS `disciplina`,
       `td2`.`nome`                                           AS `departamento`
FROM ((`tb_turma` `tt` join `tb_disciplina` `td` on ((`tt`.`fk_disciplina` = `td`.`id`))) join `tb_departamento` `td2`
      on ((`td`.`fk_departamento` = `td2`.`id`)))
ORDER BY `tt`.`periodo` DESC;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT = @OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS = @OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION = @OLD_COLLATION_CONNECTION */;
