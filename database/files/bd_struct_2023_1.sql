CREATE TABLE `tb_professor`
(
    `id`              BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nome`            VARCHAR(255)    NOT NULL,
    `fk_departamento` BIGINT          NOT NULL
);

CREATE TABLE `tb_user`
(
    `id`           BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nome`         VARCHAR(255)    NOT NULL,
    `email`        VARCHAR(255)    NOT NULL,
    `matricula`    INT             NOT NULL,
    `curso`        VARCHAR(255)    NOT NULL,
    `senha`        VARCHAR(255)    NOT NULL,
    `avatar`       BINARY(16)      NOT NULL,
    `tipo_usuario` BIGINT          NOT NULL
);

CREATE TABLE `tb_disciplina`
(
    `id`              VARCHAR(7)   NOT NULL,
    `nome`            VARCHAR(255) NOT NULL,
    `fk_departamento` BIGINT       NOT NULL
);

ALTER TABLE
    `tb_disciplina`
    ADD PRIMARY KEY (`id`);
CREATE TABLE `tb_departamento`
(
    `id`   BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nome` VARCHAR(255)    NOT NULL
);

CREATE TABLE `tb_denuncia`
(
    `id`           BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `descricao`    VARCHAR(255)    NOT NULL,
    `fk_avaliacao` BIGINT          NOT NULL
);

CREATE TABLE `tb_turma`
(
    `id`             BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `periodo`        VARCHAR(255)    NOT NULL,
    `fk_professor`   BIGINT          NOT NULL,
    `horario`        VARCHAR(255)    NOT NULL,
    `vagas_ocupadas` INT             NOT NULL,
    `total_vagas`    INT             NOT NULL,
    `local`          VARCHAR(255)    NOT NULL,
    `fk_disciplina`  VARCHAR(255)    NOT NULL,
    `carga_horaria`  INT             NOT NULL
);

CREATE TABLE `tb_avaliacao`
(
    `id`           BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `fk_user`      BIGINT          NOT NULL,
    `fk_turma`     BIGINT          NULL,
    `nota`         BIGINT          NOT NULL,
    `descricao`    VARCHAR(255)    NOT NULL,
    `fk_professor` BIGINT          NULL
);

ALTER TABLE
    `tb_avaliacao`
    ADD CONSTRAINT `tb_avaliacao_id_foreign` FOREIGN KEY (`id`) REFERENCES `tb_denuncia` (`id`);
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
    ADD CONSTRAINT `tb_turma_fk_professor_foreign` FOREIGN KEY (`fk_professor`) REFERENCES `tb_professor` (`id`);
ALTER TABLE
    `tb_professor`
    ADD CONSTRAINT `tb_professor_fk_departamento_foreign` FOREIGN KEY (`fk_departamento`) REFERENCES `tb_departamento` (`id`);
