-- DB létrehozása
CREATE SCHEMA `cms` DEFAULT CHARACTER SET utf8 COLLATE utf8_hungarian_ci ;

-- kiválasztja az adatbázist
use `cms`;

-- user_role tábla létrehozás
CREATE TABLE `cms`.`user_role` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `status` TINYINT(1) NULL DEFAULT 1,
  `deleted` TINYINT(1) NULL DEFAULT 0,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  `deleted_at` TIMESTAMP NULL,
  `created_by` INT NULL,
  `updated_by` INT NULL,
  `deleted_by` INT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC));

-- user_role-ba néhány beszúrás
INSERT INTO `cms`.`user_role` (`name`) VALUES ('superadmin');
INSERT INTO `cms`.`user_role` (`name`) VALUES ('admin');
INSERT INTO `cms`.`user_role` (`name`) VALUES ('ügyintéző');

-- user tábla létrehozása
CREATE TABLE `cms`.`user` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `first_name` VARCHAR(45) NOT NULL,
  `last_name` VARCHAR(45) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `password` VARCHAR(255) NULL,
  `role_id` INT NULL,
  `status` TINYINT(1) NULL DEFAULT 1,
  `deleted` TINYINT(1) NULL DEFAULT 0,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  `deleted_at` TIMESTAMP NULL,
  `created_by` INT NULL,
  `updated_by` INT NULL,
  `deleted_by` INT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC),
  INDEX `role_FK_idx` (`role_id` ASC),
  CONSTRAINT `role_FK`
    FOREIGN KEY (`role_id`)
    REFERENCES `cms`.`user_role` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);
    
-- user táblába néhány beszúrás
INSERT INTO `cms`.`user` (`first_name`, `last_name`, `email`, `password`, `role_id`) VALUES ('Elek', 'Teszt', 'tesztelek@teszt.hu', '123', '1');
INSERT INTO `cms`.`user` (`first_name`, `last_name`, `email`, `password`, `role_id`) VALUES ('Jakab', 'Gipsz', 'gipszjakab@teszt.hu', '456', '2');
INSERT INTO `cms`.`user` (`first_name`, `last_name`, `email`, `password`, `role_id`) VALUES ('Pali', 'Nap', 'nappali@teszt.hu', '789', '3');

-- page_content tábla létrehozása
CREATE TABLE `cms`.`page_content` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `code` VARCHAR(45) NOT NULL,
  `description` VARCHAR(255) NULL,
  `title` VARCHAR(100) NOT NULL,
  `content` MEDIUMTEXT NULL,
  `status` TINYINT(1) NULL DEFAULT 1,
  `deleted` TINYINT(1) NULL DEFAULT 0,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  `deleted_at` TIMESTAMP NULL,
  `created_by` INT NULL,
  `updated_by` INT NULL,
  `deleted_by` INT NULL,
  PRIMARY KEY (`id`));
  
-- company_data tábla létrehozása
CREATE TABLE `cms`.`company_data` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `address` VARCHAR(255) NULL,
  `address_postal_number` VARCHAR(45) NULL,
  `address_city` VARCHAR(100) NULL,
  `phone_number1` VARCHAR(45) NULL,
  `phone_number2` VARCHAR(45) NULL,
  `email` VARCHAR(255) NULL,
  `status` TINYINT(1) NULL DEFAULT 1,
  `deleted` TINYINT(1) NULL DEFAULT 0,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  `deleted_at` TIMESTAMP NULL,
  `created_by` INT NULL,
  `updated_by` INT NULL,
  `deleted_by` INT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC));

-- adatbeszeszúrás a company_data tábla
INSERT INTO `cms`.`company_data` (`name`, `address`, `address_postal_number`, `address_city`, `phone_number1`, `email`) VALUES ('TesztCeg', 'Teszt u. 1', '1111', 'Budapest', '+361-55555', 'tesztceg@teszt.hu');

-- slider tábla létrehozás
CREATE TABLE `cms`.`slider` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `picture_link` VARCHAR(255) NULL,
  `code` VARCHAR(45) NOT NULL,
  `description` VARCHAR(255) NULL,
  `title` VARCHAR(45) NOT NULL,
  `status` TINYINT(1) NULL DEFAULT 1,
  `deleted` TINYINT(1) NULL DEFAULT 0,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  `deleted_at` TIMESTAMP NULL,
  `created_by` INT NULL,
  `updated_by` INT NULL,
  `deleted_by` INT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC) );

-- banner tábla létrehozás
CREATE TABLE `cms`.`banner` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `picture_link` VARCHAR(255) NULL,
  `code` VARCHAR(45) NOT NULL,
  `description` VARCHAR(255) NULL,
  `title` VARCHAR(45) NOT NULL,
  `status` TINYINT(1) NULL DEFAULT 1,
  `deleted` TINYINT(1) NULL DEFAULT 0,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  `deleted_at` TIMESTAMP NULL,
  `created_by` INT NULL,
  `updated_by` INT NULL,
  `deleted_by` INT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC) );


