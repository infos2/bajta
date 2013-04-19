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
  `ln` CHAR(2) NOT NULL ,
  `naslov` VARCHAR(90) NOT NULL ,
  `sadrzaj` VARCHAR(3000) NULL ,
  `url` VARCHAR(90) NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_bajta13_stranice_bajta13_jezici1_idx` (`ln` ASC) ,
  UNIQUE INDEX `url_UNIQUE` (`url` ASC) )
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

--
-- Dumping data for table `bajta13_korisnici`
--

INSERT INTO `racbajhr_db`.`bajta13_korisnici` (`id`, `tip`, `ime`, `prezime`, `lozinka`, `email`, `aktivan`) VALUES
(1, 1, 'Vanja', 'Retkovac', '52fc7ac1e1bc7997f6b6599be6a10fbf91671992', 'vanja.retkovac@gmail.com', 1),
(2, 1, 'Luka', 'Bracanović', '52fc7ac1e1bc7997f6b6599be6a10fbf91671992', 'luka.bracanovic@web-com.hr', 1),
(3, 1, 'Igor', 'Ćapara', '52fc7ac1e1bc7997f6b6599be6a10fbf91671992', 'icapara@gmail.com', 0);
