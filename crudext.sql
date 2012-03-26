SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

DROP SCHEMA IF EXISTS `crudext` ;
CREATE SCHEMA IF NOT EXISTS `crudext` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `crudext` ;

-- -----------------------------------------------------
-- Table `crudext`.`usuarios`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `crudext`.`usuarios` ;

CREATE  TABLE IF NOT EXISTS `crudext`.`usuarios` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `nome` VARCHAR(60) NOT NULL ,
  `email` VARCHAR(100) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
