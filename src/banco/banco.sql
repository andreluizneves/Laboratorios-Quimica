-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema laboratorio_quimica
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema laboratorio_quimica
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `laboratorio_quimica` DEFAULT CHARACTER SET utf8 ;
USE `laboratorio_quimica` ;

-- -----------------------------------------------------
-- Table `laboratorio_quimica`.`local`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `laboratorio_quimica`.`local` (
  `id_lab` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_lab`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `laboratorio_quimica`.`vidrarias`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `laboratorio_quimica`.`vidrarias` (
  `id_vidrarias` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `quantidade` INT NOT NULL,
  `descricao` VARCHAR(255) NOT NULL,
  `id_lab` INT NOT NULL,
  PRIMARY KEY (`id_vidrarias`),
  INDEX `fk_vidrarias_laboratorio1_idx` (`id_lab` ASC),
  CONSTRAINT `fk_vidrarias_laboratorio1`
    FOREIGN KEY (`id_lab`)
    REFERENCES `laboratorio_quimica`.`local` (`id_lab`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `laboratorio_quimica`.`equipamentos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `laboratorio_quimica`.`equipamentos` (
  `id_equipamentos` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `numero_patrimonio` INT NOT NULL,
  `descricao` VARCHAR(255) NOT NULL,
  `id_lab` INT NOT NULL,
  PRIMARY KEY (`id_equipamentos`),
  INDEX `fk_equipamentos_laboratorio1_idx` (`id_lab` ASC),
  CONSTRAINT `fk_equipamentos_laboratorio1`
    FOREIGN KEY (`id_lab`)
    REFERENCES `laboratorio_quimica`.`local` (`id_lab`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `laboratorio_quimica`.`professores`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `laboratorio_quimica`.`professores` (
  `id_professor` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `ra` VARCHAR(5) NOT NULL,
  `senha` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_professor`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `laboratorio_quimica`.`relatorios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `laboratorio_quimica`.`relatorios` (
  `id_relatorios` INT NOT NULL AUTO_INCREMENT,
  `data_hora` DATETIME NOT NULL,
  `descricao` VARCHAR(255) NOT NULL,
  `id_professor` INT NOT NULL,
  PRIMARY KEY (`id_relatorios`),
  INDEX `fk_relatorios_professores_idx` (`id_professor` ASC),
  CONSTRAINT `fk_relatorios_professores`
    FOREIGN KEY (`id_professor`)
    REFERENCES `laboratorio_quimica`.`professores` (`id_professor`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `laboratorio_quimica`.`reagentes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `laboratorio_quimica`.`reagentes` (
  `id_reagentes` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `quantidade` INT NOT NULL,
  `id_lab` INT NOT NULL,
  PRIMARY KEY (`id_reagentes`),
  INDEX `fk_reagentes_laboratorio1_idx` (`id_lab` ASC),
  CONSTRAINT `fk_reagentes_laboratorio1`
    FOREIGN KEY (`id_lab`)
    REFERENCES `laboratorio_quimica`.`local` (`id_lab`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `laboratorio_quimica`.`vidrarias_quebradas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `laboratorio_quimica`.`vidrarias_quebradas` (
  `id_vidrariasquebradas` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `quantidade` INT NOT NULL,
  `id_relatorios` INT NOT NULL,
  PRIMARY KEY (`id_vidrariasquebradas`),
  INDEX `fk_vidrarias_quebradas_relatorios1_idx` (`id_relatorios` ASC),
  CONSTRAINT `fk_vidrarias_quebradas_relatorios1`
    FOREIGN KEY (`id_relatorios`)
    REFERENCES `laboratorio_quimica`.`relatorios` (`id_relatorios`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `laboratorio_quimica`.`relatorios_reagentes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `laboratorio_quimica`.`relatorios_reagentes` (
  `id_relatorioreagentes` INT NOT NULL AUTO_INCREMENT,
  `id_relatorios` INT NOT NULL,
  `id_relatorio` INT NOT NULL,
  `quantidade` INT NOT NULL,
  INDEX `fk_relatorios_has_reagentes_reagentes1_idx` (`id_relatorio` ASC),
  INDEX `fk_relatorios_has_reagentes_relatorios1_idx` (`id_relatorios` ASC),
  PRIMARY KEY (`id_relatorioreagentes`),
  CONSTRAINT `fk_relatorios_has_reagentes_relatorios1`
    FOREIGN KEY (`id_relatorios`)
    REFERENCES `laboratorio_quimica`.`relatorios` (`id_relatorios`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_relatorios_has_reagentes_reagentes1`
    FOREIGN KEY (`id_relatorio`)
    REFERENCES `laboratorio_quimica`.`reagentes` (`id_reagentes`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `laboratorio_quimica`.`relatorios_equipamentos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `laboratorio_quimica`.`relatorios_equipamentos` (
  `id_relatoriosequipamentos` INT NOT NULL AUTO_INCREMENT,
  `id_relatorios` INT NOT NULL,
  `id_equipamentos` INT NOT NULL,
  INDEX `fk_relatorios_has_equipamentos_equipamentos1_idx` (`id_equipamentos` ASC),
  INDEX `fk_relatorios_has_equipamentos_relatorios1_idx` (`id_relatorios` ASC),
  PRIMARY KEY (`id_relatoriosequipamentos`),
  CONSTRAINT `fk_relatorios_has_equipamentos_relatorios1`
    FOREIGN KEY (`id_relatorios`)
    REFERENCES `laboratorio_quimica`.`relatorios` (`id_relatorios`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_relatorios_has_equipamentos_equipamentos1`
    FOREIGN KEY (`id_equipamentos`)
    REFERENCES `laboratorio_quimica`.`equipamentos` (`id_equipamentos`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `laboratorio_quimica`.`relatorios_vidrarias`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `laboratorio_quimica`.`relatorios_vidrarias` (
  `id_relatoriosvidrarias` VARCHAR(45) NOT NULL,
  `id_relatorios` INT NOT NULL,
  `id_vidrarias` INT NOT NULL,
  INDEX `fk_relatorios_has_vidrarias_vidrarias1_idx` (`id_vidrarias` ASC),
  INDEX `fk_relatorios_has_vidrarias_relatorios1_idx` (`id_relatorios` ASC),
  PRIMARY KEY (`id_relatoriosvidrarias`),
  CONSTRAINT `fk_relatorios_has_vidrarias_relatorios1`
    FOREIGN KEY (`id_relatorios`)
    REFERENCES `laboratorio_quimica`.`relatorios` (`id_relatorios`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_relatorios_has_vidrarias_vidrarias1`
    FOREIGN KEY (`id_vidrarias`)
    REFERENCES `laboratorio_quimica`.`vidrarias` (`id_vidrarias`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `laboratorio_quimica`.`alunos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `laboratorio_quimica`.`alunos` (
  `id_aluno` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `rm` VARCHAR(5) NOT NULL,
  `senha` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_aluno`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
