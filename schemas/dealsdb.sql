SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `deals` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `deals` ;

-- -----------------------------------------------------
-- Table `deals`.`Source`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `deals`.`Source` (
  `id` INT NOT NULL ,
  `name` VARCHAR(45) NULL ,
  `url` VARCHAR(45) NULL ,
  `total_deals` INT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `deals`.`Category`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `deals`.`Category` (
  `id` INT NOT NULL ,
  `name` VARCHAR(45) NULL ,
  `parent_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_Category_Category1_idx` (`parent_id` ASC) ,
  CONSTRAINT `fk_Category_Category1`
    FOREIGN KEY (`parent_id` )
    REFERENCES `deals`.`Category` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `deals`.`Location`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `deals`.`Location` (
  `id` INT NOT NULL ,
  `city` VARCHAR(45) NULL ,
  `long` DECIMAL(3,3) NULL ,
  `lat` DECIMAL(3,3) NULL ,
  `zipcode` VARCHAR(10) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `deals`.`Crawl_Source`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `deals`.`Crawl_Source` (
  `id` INT NOT NULL ,
  `source` VARCHAR(250) NULL ,
  `url` VARCHAR(250) NULL ,
  `deals_count` INT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `deals`.`Deal`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `deals`.`Deal` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `title` VARCHAR(45) NULL ,
  `source` VARCHAR(45) NULL ,
  `descrption` BLOB NULL ,
  `date_added` DATETIME NULL ,
  `date_expires` DATETIME NULL ,
  `price` DECIMAL(5,2) NULL ,
  `saving_percent` VARCHAR(45) NULL ,
  `active` VARBINARY(1) NULL DEFAULT "Y" ,
  `deal_url` VARCHAR(200) NULL ,
  `image_url` VARCHAR(150) NULL ,
  `Source_id` INT NULL ,
  `Category_id` INT NULL ,
  `Location_id` INT NULL ,
  `Crawl_Source_id` INT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_Deal_Source1_idx` (`Source_id` ASC) ,
  INDEX `fk_Deal_Category1_idx` (`Category_id` ASC) ,
  INDEX `fk_Deal_Location1_idx` (`Location_id` ASC) ,
  INDEX `index_active_col` (`active` ASC) ,
  INDEX `fk_Deal_Crawl_Source1_idx` (`Crawl_Source_id` ASC) ,
  CONSTRAINT `fk_Deal_Source1`
    FOREIGN KEY (`Source_id` )
    REFERENCES `deals`.`Source` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Deal_Category1`
    FOREIGN KEY (`Category_id` )
    REFERENCES `deals`.`Category` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Deal_Location1`
    FOREIGN KEY (`Location_id` )
    REFERENCES `deals`.`Location` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Deal_Crawl_Source1`
    FOREIGN KEY (`Crawl_Source_id` )
    REFERENCES `deals`.`Crawl_Source` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

USE `deals` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
