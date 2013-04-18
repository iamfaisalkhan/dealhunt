SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`Vendor`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`Vendor` (
  `vendor_id` INT NOT NULL ,
  `name` VARCHAR(45) NULL ,
  `location` VARCHAR(45) NULL ,
  PRIMARY KEY (`vendor_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Product`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`Product` (
  `product_id` INT NOT NULL ,
  `name` VARCHAR(255) NULL ,
  `color` VARCHAR(45) NULL ,
  `width` DECIMAL(5,2) NULL ,
  `height` DECIMAL(5,2) NULL ,
  `price` DECIMAL(7,2) NULL ,
  `upc` VARCHAR(45) NULL ,
  `date_added` DATETIME NULL ,
  `date_modified` DATETIME NULL ,
  `vendor_id` INT NOT NULL ,
  `description` BLOB NULL ,
  `model` VARCHAR(45) NULL ,
  `weight` DECIMAL(5,2) NULL ,
  `info_url` VARCHAR(45) NULL ,
  PRIMARY KEY (`product_id`) ,
  CONSTRAINT `fk_products_Vendor`
    FOREIGN KEY (`vendor_id` )
    REFERENCES `mydb`.`Vendor` (`vendor_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Category`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`Category` (
  `category_id` INT NOT NULL ,
  `category` VARCHAR(45) NULL ,
  `parent_category` INT NULL ,
  PRIMARY KEY (`category_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Feature`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`Feature` (
  `feature_id` INT NOT NULL ,
  `key` VARCHAR(250) NULL ,
  `value` VARCHAR(250) NULL ,
  PRIMARY KEY (`feature_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Product_has_Feature`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`Product_has_Feature` (
  `Product_product_id` VARCHAR(45) NOT NULL ,
  `Feature_feature_id` INT NOT NULL ,
  PRIMARY KEY (`Product_product_id`, `Feature_feature_id`) ,
  INDEX `fk_Product_has_Feature_Feature1_idx` (`Feature_feature_id` ASC) ,
  INDEX `fk_Product_has_Feature_Product1_idx` (`Product_product_id` ASC) ,
  CONSTRAINT `fk_Product_has_Feature_Product1`
    FOREIGN KEY (`Product_product_id` )
    REFERENCES `mydb`.`Product` (`product_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Product_has_Feature_Feature1`
    FOREIGN KEY (`Feature_feature_id` )
    REFERENCES `mydb`.`Feature` (`feature_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`URL`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`URL` (
  `url_id` INT NOT NULL ,
  `url` VARCHAR(255) NULL ,
  `url_type` VARCHAR(45) NULL ,
  PRIMARY KEY (`url_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Product_has_URL`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`Product_has_URL` (
  `Product_product_id` INT NOT NULL ,
  `URL_url_id` INT NOT NULL ,
  PRIMARY KEY (`Product_product_id`, `URL_url_id`) ,
  INDEX `fk_Product_has_URL_URL1_idx` (`URL_url_id` ASC) ,
  INDEX `fk_Product_has_URL_Product1_idx` (`Product_product_id` ASC) ,
  CONSTRAINT `fk_Product_has_URL_Product1`
    FOREIGN KEY (`Product_product_id` )
    REFERENCES `mydb`.`Product` (`product_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Product_has_URL_URL1`
    FOREIGN KEY (`URL_url_id` )
    REFERENCES `mydb`.`URL` (`url_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Product_has_Category`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`Product_has_Category` (
  `Product_product_id` INT NOT NULL ,
  `Category_category_id` INT NOT NULL ,
  PRIMARY KEY (`Product_product_id`, `Category_category_id`) ,
  INDEX `fk_Product_has_Category_Category1_idx` (`Category_category_id` ASC) ,
  INDEX `fk_Product_has_Category_Product1_idx` (`Product_product_id` ASC) ,
  CONSTRAINT `fk_Product_has_Category_Product1`
    FOREIGN KEY (`Product_product_id` )
    REFERENCES `mydb`.`Product` (`product_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Product_has_Category_Category1`
    FOREIGN KEY (`Category_category_id` )
    REFERENCES `mydb`.`Category` (`category_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Vendor_has_Category`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`Vendor_has_Category` (
  `Vendor_vendor_id` INT NOT NULL ,
  `Category_category_id` INT NOT NULL ,
  PRIMARY KEY (`Vendor_vendor_id`, `Category_category_id`) ,
  INDEX `fk_Vendor_has_Category_Category1_idx` (`Category_category_id` ASC) ,
  INDEX `fk_Vendor_has_Category_Vendor1_idx` (`Vendor_vendor_id` ASC) ,
  CONSTRAINT `fk_Vendor_has_Category_Vendor1`
    FOREIGN KEY (`Vendor_vendor_id` )
    REFERENCES `mydb`.`Vendor` (`vendor_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Vendor_has_Category_Category1`
    FOREIGN KEY (`Category_category_id` )
    REFERENCES `mydb`.`Category` (`category_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Seller`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`Seller` (
  `seller_id` INT NOT NULL ,
  `name` VARCHAR(250) NULL ,
  `location` VARCHAR(250) NULL ,
  `price` DECIMAL(5,2) NULL ,
  `Sellercol` VARCHAR(45) NULL ,
  PRIMARY KEY (`seller_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Product_has_Seller`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`Product_has_Seller` (
  `Product_product_id` INT NOT NULL ,
  `Seller_seller_id` INT NOT NULL ,
  PRIMARY KEY (`Product_product_id`, `Seller_seller_id`) ,
  INDEX `fk_Product_has_Seller_Seller1_idx` (`Seller_seller_id` ASC) ,
  INDEX `fk_Product_has_Seller_Product1_idx` (`Product_product_id` ASC) ,
  CONSTRAINT `fk_Product_has_Seller_Product1`
    FOREIGN KEY (`Product_product_id` )
    REFERENCES `mydb`.`Product` (`product_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Product_has_Seller_Seller1`
    FOREIGN KEY (`Seller_seller_id` )
    REFERENCES `mydb`.`Seller` (`seller_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

USE `mydb` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
