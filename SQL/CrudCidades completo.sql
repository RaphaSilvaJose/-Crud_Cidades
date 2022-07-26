-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema crudsimples
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema crudsimples
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `crudsimples` DEFAULT CHARACTER SET utf8 ;
USE `crudsimples` ;

-- -----------------------------------------------------
-- Table `crudsimples`.`estados`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `crudsimples`.`estados` (
  `id` INT(10) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(50) NOT NULL,
  `uf` CHAR(2) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `crudsimples`.`grupos_cidades`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `crudsimples`.`grupos_cidades` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `cidade1` VARCHAR(45) NOT NULL,
  `cidade2` VARCHAR(45) NOT NULL,
  `cidade3` VARCHAR(45) NOT NULL,
  `cidade4` VARCHAR(45) NOT NULL,
  `cidade5` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 11
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `crudsimples`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `crudsimples`.`usuario` (
  `usuario_id` INT(11) NOT NULL AUTO_INCREMENT,
  `usuario` VARCHAR(200) NOT NULL,
  `senha` VARCHAR(32) NOT NULL,
  PRIMARY KEY (`usuario_id`))
ENGINE = MyISAM
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8;

insert into usuario (usuario,senha) values ('raphael', md5('raphaeldb'));
insert into usuario (usuario,senha) values ('joao', md5('1234'));
insert into usuario (usuario,senha) values ('maria', md5('5678'));

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
