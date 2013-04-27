SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `racbajhr_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `racbajhr_db` ;

-- -----------------------------------------------------
-- Table `racbajhr_db`.`bajta13_tip_k`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `racbajhr_db`.`bajta13_tip_k` ;

CREATE  TABLE IF NOT EXISTS `racbajhr_db`.`bajta13_tip_k` (
  `id` TINYINT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `tip` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table `racbajhr_db`.`bajta13_korisnici`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `racbajhr_db`.`bajta13_korisnici` ;

CREATE  TABLE IF NOT EXISTS `racbajhr_db`.`bajta13_korisnici` (
  `id` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `tip` TINYINT UNSIGNED NOT NULL ,
  `ime` VARCHAR(45) NULL ,
  `prezime` VARCHAR(45) NULL ,
  `lozinka` CHAR(40) NULL ,
  `email` VARCHAR(90) NOT NULL ,
  `aktivan` TINYINT NOT NULL DEFAULT 0 ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_bajta13_korisnici_bajta13_tipKorisnika_idx` (`tip` ASC) )
ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table `racbajhr_db`.`bajta13_jezici`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `racbajhr_db`.`bajta13_jezici` ;

CREATE  TABLE IF NOT EXISTS `racbajhr_db`.`bajta13_jezici` (
  `ln` CHAR(2) NOT NULL ,
  `jezik` VARCHAR(20) NOT NULL ,
  PRIMARY KEY (`ln`) )
ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table `racbajhr_db`.`bajta13_stranice`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `racbajhr_db`.`bajta13_stranice` ;

CREATE  TABLE IF NOT EXISTS `racbajhr_db`.`bajta13_stranice` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  PRIMARY KEY (`id`) )
ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table `racbajhr_db`.`bajta13_sadrzaj`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `racbajhr_db`.`bajta13_sadrzaj` ;

CREATE  TABLE IF NOT EXISTS `racbajhr_db`.`bajta13_sadrzaj` (
  `id_stranice` INT UNSIGNED NOT NULL ,
  `ln` CHAR(2) NOT NULL ,
  `naslov` VARCHAR(90) NOT NULL ,
  `sadrzaj` VARCHAR(3000) NULL ,
  `url` VARCHAR(90) NOT NULL ,
  INDEX `fk_bajta13_sadrzaj_bajta13_stranice1_idx` (`id_stranice` ASC) ,
  INDEX `fk_bajta13_sadrzaj_bajta13_jezici1_idx` (`ln` ASC) ,
  PRIMARY KEY (`ln`, `url`) )
ENGINE = MyISAM;

USE `racbajhr_db` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `racbajhr_db`.`bajta13_tip_k`
-- -----------------------------------------------------
START TRANSACTION;
USE `racbajhr_db`;
INSERT INTO `racbajhr_db`.`bajta13_tip_k` (`id`, `tip`) VALUES (1, 'admin');
INSERT INTO `racbajhr_db`.`bajta13_tip_k` (`id`, `tip`) VALUES (2, 'reg');
INSERT INTO `racbajhr_db`.`bajta13_tip_k` (`id`, `tip`) VALUES (3, 'gost');

COMMIT;

-- -----------------------------------------------------
-- Data for table `racbajhr_db`.`bajta13_jezici`
-- -----------------------------------------------------
START TRANSACTION;
USE `racbajhr_db`;
INSERT INTO `racbajhr_db`.`bajta13_jezici` (`ln`, `jezik`) VALUES ('hr', 'Hrvatski');
INSERT INTO `racbajhr_db`.`bajta13_jezici` (`ln`, `jezik`) VALUES ('en', 'English');
INSERT INTO `racbajhr_db`.`bajta13_jezici` (`ln`, `jezik`) VALUES ('ru', 'Pусский');

COMMIT;

-- -----------------------------------------------------
-- Data for table `racbajhr_db`.`bajta13_korisnici`
-- -----------------------------------------------------

INSERT INTO `bajta13_korisnici` (`id`, `tip`, `ime`, `prezime`, `lozinka`, `email`, `aktivan`) VALUES(1, 1, 'Vanja', 'Retkovac', '52fc7ac1e1bc7997f6b6599be6a10fbf91671992', 'vanja.retkovac@gmail.com', 1);
INSERT INTO `bajta13_korisnici` (`id`, `tip`, `ime`, `prezime`, `lozinka`, `email`, `aktivan`) VALUES(2, 1, 'Luka', 'Bracanović', '52fc7ac1e1bc7997f6b6599be6a10fbf91671992', 'luka.bracanovic@web-com.hr', 1);
INSERT INTO `bajta13_korisnici` (`id`, `tip`, `ime`, `prezime`, `lozinka`, `email`, `aktivan`) VALUES(3, 1, 'Igor', 'Ćapara', '52fc7ac1e1bc7997f6b6599be6a10fbf91671992', 'icapara@gmail.com', 0);
