-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
SHOW WARNINGS;
-- -----------------------------------------------------
-- Schema nal
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `nal` ;

-- -----------------------------------------------------
-- Schema nal
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `nal` DEFAULT CHARACTER SET utf8 ;
SHOW WARNINGS;
USE `nal` ;

-- -----------------------------------------------------
-- Table `nal`.`organization`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `nal`.`organization` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `nal`.`organization` (
  `organization_id` INT(11) NOT NULL,
  `organization_name` VARCHAR(45) NULL DEFAULT NULL,
  `whether_host` TINYINT(1) NULL,
  `whether_sponsor` TINYINT(1) NULL,
  PRIMARY KEY (`organization_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `nal`.`attendee`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `nal`.`attendee` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `nal`.`attendee` (
  `Attendee_id` INT(11) NOT NULL,
  `first_name` VARCHAR(45) NULL DEFAULT NULL,
  `last_name` VARCHAR(45) NULL DEFAULT NULL,
  `title` VARCHAR(45) NULL DEFAULT NULL,
  `city` VARCHAR(45) NULL DEFAULT NULL,
  `state` VARCHAR(45) NULL DEFAULT NULL,
  `zip_code` INT(11) NULL DEFAULT NULL,
  `phone` BIGINT(12) NULL DEFAULT NULL,
  `email` VARCHAR(45) NULL DEFAULT NULL,
  `IACUC_member_status` TINYINT(1) NULL DEFAULT NULL,
  `principal_investigator` TINYINT(1) NULL DEFAULT NULL,
  `experienced_db_searcher` TINYINT(1) NULL DEFAULT NULL,
  `attendee_orgID` INT(11) NULL,
  PRIMARY KEY (`Attendee_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `nal`.`awic_trainer`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `nal`.`awic_trainer` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `nal`.`awic_trainer` (
  `trainer_id` INT(11) NOT NULL,
  `trainer_name` VARCHAR(45) NULL DEFAULT NULL,
  `org2_id` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`trainer_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `nal`.`payment_info`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `nal`.`payment_info` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `nal`.`payment_info` (
  `reciept number` INT(11) NOT NULL,
  `org_id` INT(11) NULL DEFAULT NULL,
  `amount_paid` INT(11) NULL DEFAULT NULL,
  `payment_date` TIMESTAMP(6) NULL DEFAULT NULL,
  `payment_success` TINYINT(1) NULL DEFAULT NULL,
  PRIMARY KEY (`reciept number`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `nal`.`workshop`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `nal`.`workshop` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `nal`.`workshop` (
  `workshop_id` INT(11) NOT NULL,
  `topic` VARCHAR(120) NULL DEFAULT NULL,
  `start_date` DATETIME NULL DEFAULT NULL,
  `end_date` DATETIME NULL DEFAULT NULL,
  `location_address` VARCHAR(45) NULL DEFAULT NULL,
  `zip_code` INT(11) NULL DEFAULT NULL,
  `workshop_type` VARCHAR(45) NULL DEFAULT NULL,
  `organization_id` INT(11) NULL DEFAULT NULL,
  `overall_rating` INT(11) NULL DEFAULT NULL,
  `presentation_quality` INT(11) NULL DEFAULT NULL,
  `duration` VARCHAR(20) NULL,
  PRIMARY KEY (`workshop_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `nal`.`workshop_has_attendee`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `nal`.`workshop_has_attendee` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `nal`.`workshop_has_attendee` (
  `Workshop_workshop_id` INT(11) NOT NULL,
  `Attendee_Attendee_id` INT(11) NOT NULL,
  `Reg_Time` TIMESTAMP(6) NOT NULL,
  PRIMARY KEY (`Workshop_workshop_id`, `Attendee_Attendee_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

SHOW WARNINGS;
CREATE INDEX `fk_Workshop_has_Attendee_Workshop1_idx` ON `nal`.`workshop_has_attendee` (`Workshop_workshop_id` ASC);

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `nal`.`workshop_trainer`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `nal`.`workshop_trainer` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `nal`.`workshop_trainer` (
  `workshopID` INT(11) NOT NULL,
  `trainerID` INT(11) NOT NULL,
  PRIMARY KEY (`workshopID`, `trainerID`))
ENGINE = InnoDB;

SHOW WARNINGS;
CREATE INDEX `fk_workshopID_idx` ON `nal`.`workshop_trainer` (`workshopID` ASC);

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `nal`.`workshop_trainer`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `nal`.`workshop_trainer` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `nal`.`workshop_trainer` (
  `workshopID` INT(11) NOT NULL,
  `trainerID` INT(11) NOT NULL,
  PRIMARY KEY (`workshopID`, `trainerID`))
ENGINE = InnoDB;

SHOW WARNINGS;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- ----------------------------------------------------------
-- DATA INSERTION QUERIES
-- -----------------------------------------------------------
USE nal;

SELECT * FROM nal.attendee; 
SELECT * FROM nal.workshop;
SELECT * FROM nal.workshop_has_attendee;
SELECT * FROM nal.awic_trainer;
SELECT * FROM nal.organization;
SELECT * FROM nal.payment_info;
SELECT * FROM nal.workshop_trainer;

-- Inserting data in Attendees Table

INSERT INTO `nal`.`attendee` (`Attendee_id`, `first_name`, `last_name`, `title`, `city`, `state`, `zip_code`, `phone`, `email`, `IACUC_member_status`, `principal_investigator`, `experienced_db_searcher`, `attendee_orgID`) VALUES ('1', 'Kara', 'Barnside', 'Veterinarian', 'Laurel', 'MD', '20708', '3019976685', 'KB@example.com', '1', '1', '0', '100');
INSERT INTO `nal`.`attendee` (`Attendee_id`, `first_name`, `last_name`, `title`, `city`, `state`, `zip_code`, `phone`, `email`, `IACUC_member_status`, `principal_investigator`, `experienced_db_searcher`, `attendee_orgID`) VALUES ('2', 'Pam', 'Darling', 'IACUC Coordinator', 'Laurel', 'MD', '20708', '3014905678', 'PD@example.com', '1', '0', '1', '100');
INSERT INTO `nal`.`attendee` (`Attendee_id`, `first_name`, `last_name`, `title`, `city`, `state`, `zip_code`, `phone`, `email`, `IACUC_member_status`, `principal_investigator`, `experienced_db_searcher`, `attendee_orgID`) VALUES ('3', 'Lori', 'Clark', 'Librarian', 'Dickerson', 'MD', '20842', '4439790083', 'LC@example.com', '0', '0', '1', '100');
INSERT INTO `nal`.`attendee` (`Attendee_id`, `first_name`, `last_name`, `title`, `city`, `state`, `zip_code`, `phone`, `email`, `IACUC_member_status`, `principal_investigator`, `experienced_db_searcher`, `attendee_orgID`) VALUES ('4', 'Erica', 'Gotteman', 'Research Scientist', 'Staten Island', 'NY', '10306', '5667873214', 'EG@example.com', '1', '1', '1', '100');
INSERT INTO `nal`.`attendee` (`Attendee_id`, `first_name`, `last_name`, `title`, `city`, `state`, `zip_code`, `phone`, `email`, `IACUC_member_status`, `principal_investigator`, `experienced_db_searcher`, `attendee_orgID`) VALUES ('5', 'Nancy', 'Drew', 'Veterinarian', 'Oxford', 'OH', '45056', '6548823422', 'nd@example.com', '1', '0', '0', '101');
INSERT INTO `nal`.`attendee` (`Attendee_id`, `first_name`, `last_name`, `title`, `city`, `state`, `zip_code`, `phone`, `email`, `IACUC_member_status`, `principal_investigator`, `experienced_db_searcher`, `attendee_orgID`) VALUES ('6', 'Tom ', 'Price', 'Veterinarian', 'San Francisco', 'CA', '94158', '9957548333', 'TP@example.com', '1', '0', '0', '101');
INSERT INTO `nal`.`attendee` (`Attendee_id`, `first_name`, `last_name`, `title`, `city`, `state`, `zip_code`, `phone`, `email`, `IACUC_member_status`, `principal_investigator`, `experienced_db_searcher`, `attendee_orgID`) VALUES ('7', 'Paula ', 'Grainger', 'Veterinary Medical Officer', 'Willimantic', 'CT', '6226', '8823314545', 'PG@example.com', '1', '0', '0', '102');
INSERT INTO `nal`.`attendee` (`Attendee_id`, `first_name`, `last_name`, `title`, `city`, `state`, `zip_code`, `phone`, `email`, `IACUC_member_status`, `principal_investigator`, `experienced_db_searcher`, `attendee_orgID`) VALUES ('8', 'Nina', 'Precipe', 'IACUC Member (nonaffiliated)', 'Silver Spring', 'MD', '20993', '4105547621', 'NP@example.com', '1', '0', '0', '102');
INSERT INTO `nal`.`attendee` (`Attendee_id`, `first_name`, `last_name`, `title`, `city`, `state`, `zip_code`, `phone`, `email`, `IACUC_member_status`, `principal_investigator`, `experienced_db_searcher`, `attendee_orgID`) VALUES ('9', 'Michael ', 'Reese', 'Librarian', 'Bethesda', 'MD', '20892', '4434549000', 'MR1@example.com', '1', '0', '0', '101');
INSERT INTO `nal`.`attendee` (`Attendee_id`, `first_name`, `last_name`, `title`, `city`, `state`, `zip_code`, `phone`, `email`, `IACUC_member_status`, `principal_investigator`, `experienced_db_searcher`, `attendee_orgID`) VALUES ('10', 'Roger', 'Moore', 'Animal Facility Member', 'Louisville', 'KY', '40041', '9942320188', 'RM@example.com', '1', '0', '0', '101');
INSERT INTO `nal`.`attendee` (`Attendee_id`, `first_name`, `last_name`, `title`, `city`, `state`, `zip_code`, `phone`, `email`, `IACUC_member_status`, `principal_investigator`, `experienced_db_searcher`, `attendee_orgID`) VALUES ('11', 'Bob', 'Sagat', 'Biosafety Officer', 'Washington', 'DC', '20307', '8823339997', 'BS34@example.com', '1', '0', '0', '103');
INSERT INTO `nal`.`attendee` (`Attendee_id`, `first_name`, `last_name`, `title`, `city`, `state`, `zip_code`, `phone`, `email`, `IACUC_member_status`, `principal_investigator`, `experienced_db_searcher`, `attendee_orgID`) VALUES ('12', 'Phyllis', 'Diller', 'Research Scientist', 'Radnor ', 'PA', '19087', '2237757790', 'PH2@example.com', '1', '1', '1', '103');
INSERT INTO `nal`.`attendee` (`Attendee_id`, `first_name`, `last_name`, `title`, `city`, `state`, `zip_code`, `phone`, `email`, `IACUC_member_status`, `principal_investigator`, `experienced_db_searcher`, `attendee_orgID`) VALUES ('13', 'Liana', 'Phillipe-Sarte', 'Research Scientist', 'Fort Collins', 'CO', '80524', '9703327211', 'LPS@example.com', '1', '1', '1', '103');
INSERT INTO `nal`.`attendee` (`Attendee_id`, `first_name`, `last_name`, `title`, `city`, `state`, `zip_code`, `phone`, `email`, `IACUC_member_status`, `principal_investigator`, `experienced_db_searcher`, `attendee_orgID`) VALUES ('14', 'Barbara', 'Paco', 'Librarian', 'Bethesda', 'MD', '20892', '3016657832', 'BP4@example.com', '0', '0', '1', '110');
INSERT INTO `nal`.`attendee` (`Attendee_id`, `first_name`, `last_name`, `title`, `city`, `state`, `zip_code`, `phone`, `email`, `IACUC_member_status`, `principal_investigator`, `experienced_db_searcher`, `attendee_orgID`) VALUES ('15', 'Carrie', 'Underbranch', 'Veterinarian', 'Lincoln', 'NE', '68588', '6327774111', 'CU3@example.com', '1', '0', '0', '105');
INSERT INTO `nal`.`attendee` (`Attendee_id`, `first_name`, `last_name`, `title`, `city`, `state`, `zip_code`, `phone`, `email`, `IACUC_member_status`, `principal_investigator`, `experienced_db_searcher`, `attendee_orgID`) VALUES ('16', 'Harvey', 'Brookmeister', 'IACUC Chair', 'Washington ', 'DC', '20307', '3015557000', 'HB1@example.com', '1', '0', '1', '104');
INSERT INTO `nal`.`attendee` (`Attendee_id`, `first_name`, `last_name`, `title`, `city`, `state`, `zip_code`, `phone`, `email`, `IACUC_member_status`, `principal_investigator`, `experienced_db_searcher`, `attendee_orgID`) VALUES ('17', 'Audrey', 'Vontrappe', 'Facility Manager', 'Cambridge', 'MA', '2142', '8832215567', 'AVT3@example.com', '0', '0', '0', '105');
INSERT INTO `nal`.`attendee` (`Attendee_id`, `first_name`, `last_name`, `title`, `city`, `state`, `zip_code`, `phone`, `email`, `IACUC_member_status`, `principal_investigator`, `experienced_db_searcher`, `attendee_orgID`) VALUES ('18', 'Jared', 'Fortunado', 'Statistician', 'Athens ', 'GA', '30605', '7736641000', 'JF34@example.com', '0', '1', '0', '104');
INSERT INTO `nal`.`attendee` (`Attendee_id`, `first_name`, `last_name`, `title`, `city`, `state`, `zip_code`, `phone`, `email`, `IACUC_member_status`, `principal_investigator`, `experienced_db_searcher`, `attendee_orgID`) VALUES ('19', 'Paula ', 'Sebring', 'Lbrarian', 'Bethesda', 'MD', '20892', '4436607322', 'NMN@example.com', '1', '0', '1', '106');
INSERT INTO `nal`.`attendee` (`Attendee_id`, `first_name`, `last_name`, `title`, `city`, `state`, `zip_code`, `phone`, `email`, `IACUC_member_status`, `principal_investigator`, `experienced_db_searcher`, `attendee_orgID`) VALUES ('20', 'Diane', 'Wane', 'IACUC Member ', 'Ellicott City', 'MD', '21043', '4107742200', 'DW92@example.com', '1', '1', '0', '107');

ALTER TABLE nal.workshop
MODIFY nal.workshop.topic VARCHAR(120);

ALTER TABLE nal.workshop
MODIFY nal.workshop.location_address VARCHAR(120);

ALTER TABLE nal.workshop
MODIFY nal.workshop.start_date DATE;

ALTER TABLE nal.workshop
MODIFY nal.workshop.end_date DATE;

-- Inserting data in Workshop table
INSERT INTO nal.workshop (workshop_id, topic,start_date,end_date, location_address, zip_code, workshop_type, organization_id, overall_rating,presentation_quality,duration) 
VALUES (200, 'Considering Alternatives in Wildlife Research', '2015-10-06', '2015-10-07', ' USDA Forest Service', '20783', 'Webinar', '121', '8', '8', '2 hours');

INSERT INTO `nal`.`workshop` (`workshop_id`, `topic`, `start_date`, `end_date`, `location_address`, `zip_code`, `workshop_type`, `organization_id`, `overall_rating`, `presentation_quality`, `duration`) VALUES ('201', 'Meeting the Information Requirements of the Animal Welfare Act', '2015-10-28', '2015-10-29', 'National Agricultural Library, Beltsville, MD', '20742', 'Workshop', '104', '7', '9', '1.5 days');
INSERT INTO `nal`.`workshop` (`workshop_id`, `topic`, `start_date`, `end_date`, `location_address`, `zip_code`, `workshop_type`, `organization_id`, `overall_rating`, `presentation_quality`, `duration`) VALUES ('202', 'Meeting the Information Requirements of the Animal Welfare Act', '2015-11-03', '2015-11-03', 'Kansas Medical Center', '20895', 'Webinar', '122', '8', '8', '3 hours');
INSERT INTO `nal`.`workshop` (`workshop_id`, `topic`, `start_date`, `end_date`, `location_address`, `zip_code`, `workshop_type`, `organization_id`, `overall_rating`, `presentation_quality`, `duration`) VALUES ('203', 'Meeting the Information Requirements of the Animal Welfare Act', '2015-11-12', '2015-11-12', 'University of Oklahoma, Health Science Center, Oklahoma City, OK', '60985', 'Workshop', '123', '8', '8', '1 day');
INSERT INTO `nal`.`workshop` (`workshop_id`, `topic`, `start_date`, `end_date`, `location_address`, `zip_code`, `workshop_type`, `organization_id`, `overall_rating`, `presentation_quality`, `duration`) VALUES ('204', 'Considering Alternatives in Wildlife Research', '2015-11-18', '2015-11-19', 'USDA Forest Service', '20783', 'Webinar', '121', '9', '9', '2 hours');
INSERT INTO `nal`.`workshop` (`workshop_id`, `topic`, `start_date`, `end_date`, `location_address`, `zip_code`, `workshop_type`, `organization_id`, `overall_rating`, `presentation_quality`, `duration`) VALUES ('205', 'Federal Oversight of Animals in Research', '2016-03-10', '2016-03-10', 'Laboratory Animal Management, UMD. College Park, MD', '20740', 'Presentation', '124', '6', '6', '1 hour');
INSERT INTO `nal`.`workshop` (`workshop_id`, `topic`, `start_date`, `end_date`, `location_address`, `zip_code`, `workshop_type`, `organization_id`, `overall_rating`, `presentation_quality`, `duration`) VALUES ('206', 'Meeting the Information Requirements of the Animal Welfare Act', '2016-03-25', '2016-03-25', 'North Carolina Association for Biomedical Research (NCABR)', '20543', 'Webinar', '125', '8', '7', '3 hours');
INSERT INTO `nal`.`workshop` (`workshop_id`, `topic`, `start_date`, `end_date`, `location_address`, `zip_code`, `workshop_type`, `organization_id`, `overall_rating`, `presentation_quality`, `duration`) VALUES ('207', 'Harm-Benefit Analysis on Studies Involving Unalleviated Pain and Distress', '2016-04-01', '2016-04-01', 'PRIM&R Seattle, WA', '23645', 'Presentation', '126', '10', '8', '2 hours');
INSERT INTO `nal`.`workshop` (`workshop_id`, `topic`, `start_date`, `end_date`, `location_address`, `zip_code`, `workshop_type`, `organization_id`, `overall_rating`, `presentation_quality`, `duration`) VALUES ('208', 'Development of 3Rs Information Resources at the Animal Welfare Information Center', '2016-04-12', '2016-04-14', 'Pan American Conference on Alternatives. Baltimore, MD', '34562', 'Poster Presentation', '127', '9', '9', '2 days');
INSERT INTO `nal`.`workshop` (`workshop_id`, `topic`, `start_date`, `end_date`, `location_address`, `zip_code`, `workshop_type`, `organization_id`, `overall_rating`, `presentation_quality`, `duration`) VALUES ('209', 'Working in Animal Welfare', '2016-04-18', '2016-04-18', 'UMD Animal Sciences. College Park, MD', '20740', 'Presentation', '128', '5', '9', '1 hour');
INSERT INTO `nal`.`workshop` (`workshop_id`, `topic`, `start_date`, `end_date`, `location_address`, `zip_code`, `workshop_type`, `organization_id`, `overall_rating`, `presentation_quality`, `duration`) VALUES ('210', 'Harm-benefit and humane endpoints', '2016-05-26', '2016-05-26', 'AFFRI. Bethesda, MD', '20742', 'Presentation', '129', '8', '8', '1 hour');
INSERT INTO `nal`.`workshop` (`workshop_id`, `topic`, `start_date`, `end_date`, `location_address`, `zip_code`, `workshop_type`, `organization_id`, `overall_rating`, `presentation_quality`, `duration`) VALUES ('211', 'Searching for 3Rs Alternatives When Using Live Animals in Research', '2016-09-13', '2016-09-15', 'USDA ARS', '20742', 'Webinar', '118', '7', '8', '15 hours');
INSERT INTO `nal`.`workshop` (`workshop_id`, `topic`, `start_date`, `end_date`, `location_address`, `zip_code`, `workshop_type`, `organization_id`, `overall_rating`, `presentation_quality`, `duration`) VALUES ('212', 'Meeting the Information Requirements of the Animal Welfare Act', '2016-09-21', '2016-09-21', 'FDA Center for Veterinary Medicine\nSilver Spring, MD\n', '20742', 'Workshop', '130', '7', '9', '12 hours');
INSERT INTO `nal`.`workshop` (`workshop_id`, `topic`, `start_date`, `end_date`, `location_address`, `zip_code`, `workshop_type`, `organization_id`, `overall_rating`, `presentation_quality`, `duration`) VALUES ('213', 'Meeting the Information Requirements of the Animal Welfare Act', '2016-12-21', '2016-12-24', 'FDA Center for Veterinary Medicine\nSilver Spring, MD\n', '20742', 'Workshop', '130', '7', '7', '3 days');
INSERT INTO `nal`.`workshop` (`workshop_id`, `topic`, `start_date`, `end_date`, `location_address`, `zip_code`, `workshop_type`, `organization_id`, `overall_rating`, `presentation_quality`, `duration`) VALUES ('214', 'Alternatives Considerations in Nonhuman Primate Research', '2016-08-25', '2016-08-25', 'AFFRI. Bethesda, MD', '20742', 'Presentation', '129', '6', '9', '4 hours');
INSERT INTO `nal`.`workshop` (`workshop_id`, `topic`, `start_date`, `end_date`, `location_address`, `zip_code`, `workshop_type`, `organization_id`, `overall_rating`, `presentation_quality`, `duration`) VALUES ('215', 'Considering Alternatives in Wildlife Research', '2016-01-28', '2016-01-30', 'USDA Forest Service', '20783', 'Webinar', '121', '7', '7', '8 hours');
INSERT INTO `nal`.`workshop` (`workshop_id`, `topic`, `start_date`, `end_date`, `location_address`, `zip_code`, `workshop_type`, `organization_id`, `overall_rating`, `presentation_quality`, `duration`) VALUES ('216', 'Harm-benefit and humane endpoints', '2015-11-04', '2015-11-04', 'Kansas Medical Center', '20895', 'Webinar', '122', '7', '7', '6 hours');
INSERT INTO `nal`.`workshop` (`workshop_id`, `topic`, `start_date`, `end_date`, `location_address`, `zip_code`, `workshop_type`, `organization_id`, `overall_rating`, `presentation_quality`, `duration`) VALUES ('217', 'Searching for 3Rs Alternatives When Using Live Animals in Research', '2015-08-25', '2015-08-27', 'USDA ARS', '20742', 'Webinar', '118', '7', '7', '9 hours');
INSERT INTO `nal`.`workshop` (`workshop_id`, `topic`, `start_date`, `end_date`, `location_address`, `zip_code`, `workshop_type`, `organization_id`, `overall_rating`, `presentation_quality`, `duration`) VALUES ('218', 'Alternatives Considerations in Nonhuman Primate Research', '2016-05-28', '2016-05-28', 'North Carolina Association for Biomedical Research (NCABR)', '20543', 'Presentation', '125', '8', '8', '4 hours');
INSERT INTO `nal`.`workshop` (`workshop_id`, `topic`, `start_date`, `end_date`, `location_address`, `zip_code`, `workshop_type`, `organization_id`, `overall_rating`, `presentation_quality`, `duration`) VALUES ('219', 'Searching for 3Rs Alternatives When Using Live Animals in Research', '2016-01-14', '2016-01-14', 'USDA ARS', '20742', 'Workshop', '118', '7', '7', '3 hours');
INSERT INTO `nal`.`workshop` (`workshop_id`, `topic`, `start_date`, `end_date`, `location_address`, `zip_code`, `workshop_type`, `organization_id`, `overall_rating`, `presentation_quality`, `duration`) VALUES ('220', 'Harm-Benefit Analysis on Studies Involving Unalleviated Pain and Distress', '2016-04-10', '2016-04-12', 'PRIM&R Seattle, WA', '23645', 'Workshop', '126', '8', '8', '9 hours');


ALTER TABLE nal.organization
MODIFY nal.organization.organization_name VARCHAR(120);

-- Inserting into organization table
INSERT INTO `nal`.`organization` (`organization_id`, `organization_name`, `whether_host`, `whether_sponsor`) VALUES ('100', 'Plyonetics Corporation', '0', '0');
INSERT INTO `nal`.`organization` (`organization_id`, `organization_name`, `whether_host`, `whether_sponsor`) VALUES ('101', 'NIH, NIAID', '1', '1');
INSERT INTO `nal`.`organization` (`organization_id`, `organization_name`, `whether_host`, `whether_sponsor`) VALUES ('102', 'University of Richmond', '0', '1');
INSERT INTO `nal`.`organization` (`organization_id`, `organization_name`, `whether_host`, `whether_sponsor`) VALUES ('103', 'Harris Laboratory', '0', '0');
INSERT INTO `nal`.`organization` (`organization_id`, `organization_name`, `whether_host`, `whether_sponsor`) VALUES ('104', 'NAL, USDA', '1', '0');
INSERT INTO `nal`.`organization` (`organization_id`, `organization_name`, `whether_host`, `whether_sponsor`) VALUES ('105', 'FDA, CFSAN', '1', '0');
INSERT INTO `nal`.`organization` (`organization_id`, `organization_name`, `whether_host`, `whether_sponsor`) VALUES ('106', 'USDA, APHIS', '1', '0');
INSERT INTO `nal`.`organization` (`organization_id`, `organization_name`, `whether_host`, `whether_sponsor`) VALUES ('107', 'Deity Therapeutics, Inc.', '0', '0');
INSERT INTO `nal`.`organization` (`organization_id`, `organization_name`, `whether_host`, `whether_sponsor`) VALUES ('108', 'FDA, CVM', '0', '0');
INSERT INTO `nal`.`organization` (`organization_id`, `organization_name`, `whether_host`, `whether_sponsor`) VALUES ('109', 'NIH-Library', '0', '1');
INSERT INTO `nal`.`organization` (`organization_id`, `organization_name`, `whether_host`, `whether_sponsor`) VALUES ('110', 'Louisville University', '1', '0');
INSERT INTO `nal`.`organization` (`organization_id`, `organization_name`, `whether_host`, `whether_sponsor`) VALUES ('111', 'Walter Reed Army Medical Center', '0', '0');
INSERT INTO `nal`.`organization` (`organization_id`, `organization_name`, `whether_host`, `whether_sponsor`) VALUES ('112', 'Centaur Pharmaceuticals, Inc.', '0', '0');
INSERT INTO `nal`.`organization` (`organization_id`, `organization_name`, `whether_host`, `whether_sponsor`) VALUES ('113', 'Colorado State University', '1', '0');
INSERT INTO `nal`.`organization` (`organization_id`, `organization_name`, `whether_host`, `whether_sponsor`) VALUES ('114', 'NIH Library', '0', '1');
INSERT INTO `nal`.`organization` (`organization_id`, `organization_name`, `whether_host`, `whether_sponsor`) VALUES ('115', 'University of Nebraska', '1', '0');
INSERT INTO `nal`.`organization` (`organization_id`, `organization_name`, `whether_host`, `whether_sponsor`) VALUES ('116', 'Walter Reed Army Institute of Research', '0', '0');
INSERT INTO `nal`.`organization` (`organization_id`, `organization_name`, `whether_host`, `whether_sponsor`) VALUES ('117', 'Biogenetics Limited', '0', '0');
INSERT INTO `nal`.`organization` (`organization_id`, `organization_name`, `whether_host`, `whether_sponsor`) VALUES ('118', 'USDA, ARS', '0', '1');
INSERT INTO `nal`.`organization` (`organization_id`, `organization_name`, `whether_host`, `whether_sponsor`) VALUES ('119', 'Roger Carter Pharmaceuticals', '0', '1');
INSERT INTO `nal`.`organization` (`organization_id`, `organization_name`, `whether_host`, `whether_sponsor`) VALUES ('120', 'USAMRIID', '0', '1');
INSERT INTO `nal`.`organization` (`organization_id`, `organization_name`, `whether_host`, `whether_sponsor`) VALUES ('121', ' USDA Forest Service', '1', '0');
INSERT INTO `nal`.`organization` (`organization_id`, `organization_name`, `whether_host`, `whether_sponsor`) VALUES ('122', 'Kansas Medical Center', '1', '0');
INSERT INTO `nal`.`organization` (`organization_id`, `organization_name`, `whether_host`, `whether_sponsor`) VALUES ('123', 'University of Oklahoma', '1', '0');
INSERT INTO `nal`.`organization` (`organization_id`, `organization_name`, `whether_host`, `whether_sponsor`) VALUES ('124', 'University of Maryland', '1', '0');
INSERT INTO `nal`.`organization` (`organization_id`, `organization_name`, `whether_host`, `whether_sponsor`) VALUES ('125', 'North Carolina Association for Biomedical Research (NCABR)', '1', '0');
INSERT INTO `nal`.`organization` (`organization_id`, `organization_name`, `whether_host`, `whether_sponsor`) VALUES ('126', 'PRIM&R Seattle, WA', '1', '0');
INSERT INTO `nal`.`organization` (`organization_id`, `organization_name`, `whether_host`, `whether_sponsor`) VALUES ('127', 'Pan American Conference on Alternatives', '1', '0');
INSERT INTO `nal`.`organization` (`organization_id`, `organization_name`, `whether_host`, `whether_sponsor`) VALUES ('128', 'UMD Animal Sciences, College Park, MD', '1', '0');
INSERT INTO `nal`.`organization` (`organization_id`, `organization_name`, `whether_host`, `whether_sponsor`) VALUES ('129', 'AFFRI', '1', '0');
INSERT INTO `nal`.`organization` (`organization_id`, `organization_name`, `whether_host`, `whether_sponsor`) VALUES ('130', 'FDA Center for Veterinary Medicine', '1', '0');


-- Inserting into workshop_has_attendee table
INSERT INTO nal.workshop_has_attendee (Workshop_workshop_id, Attendee_Attendee_id, Reg_Time) 
VALUES ('200', '1', '2015-05-10 10:14');


INSERT INTO `nal`.`workshop_has_attendee` (`Workshop_workshop_id`, `Attendee_Attendee_id`, `Reg_Time`) VALUES ('200', '2', '2015-10-02 03:14');
INSERT INTO `nal`.`workshop_has_attendee` (`Workshop_workshop_id`, `Attendee_Attendee_id`, `Reg_Time`) VALUES ('200', '3', '2015-10-01 03:14');
INSERT INTO `nal`.`workshop_has_attendee` (`Workshop_workshop_id`, `Attendee_Attendee_id`, `Reg_Time`) VALUES ('200', '4', '2015-10-03 03:14');
INSERT INTO `nal`.`workshop_has_attendee` (`Workshop_workshop_id`, `Attendee_Attendee_id`, `Reg_Time`) VALUES ('200', '5', '2015-10-01 09:14');
INSERT INTO `nal`.`workshop_has_attendee` (`Workshop_workshop_id`, `Attendee_Attendee_id`, `Reg_Time`) VALUES ('202', '6', '2015-11-02 09:14');
INSERT INTO `nal`.`workshop_has_attendee` (`Workshop_workshop_id`, `Attendee_Attendee_id`, `Reg_Time`) VALUES ('202', '7', '2015-11-01 09:14');
INSERT INTO `nal`.`workshop_has_attendee` (`Workshop_workshop_id`, `Attendee_Attendee_id`, `Reg_Time`) VALUES ('202', '8', '2015-10-31 09:14');
INSERT INTO `nal`.`workshop_has_attendee` (`Workshop_workshop_id`, `Attendee_Attendee_id`, `Reg_Time`) VALUES ('202', '9', '2015-10-30 09:14');
INSERT INTO `nal`.`workshop_has_attendee` (`Workshop_workshop_id`, `Attendee_Attendee_id`, `Reg_Time`) VALUES ('202', '10', '2015-10-28 09:14');
INSERT INTO `nal`.`workshop_has_attendee` (`Workshop_workshop_id`, `Attendee_Attendee_id`, `Reg_Time`) VALUES ('205', '11', '2016-03-03 09:14');
INSERT INTO `nal`.`workshop_has_attendee` (`Workshop_workshop_id`, `Attendee_Attendee_id`, `Reg_Time`) VALUES ('205', '12', '2016-03-09 09:14');
INSERT INTO `nal`.`workshop_has_attendee` (`Workshop_workshop_id`, `Attendee_Attendee_id`, `Reg_Time`) VALUES ('205', '13', '2016-03-07 09:14');
INSERT INTO `nal`.`workshop_has_attendee` (`Workshop_workshop_id`, `Attendee_Attendee_id`, `Reg_Time`) VALUES ('205', '14', '2016-03-09 09:14');
INSERT INTO `nal`.`workshop_has_attendee` (`Workshop_workshop_id`, `Attendee_Attendee_id`, `Reg_Time`) VALUES ('205', '15', '2016-03-01 09:14');
INSERT INTO `nal`.`workshop_has_attendee` (`Workshop_workshop_id`, `Attendee_Attendee_id`, `Reg_Time`) VALUES ('206', '16', '2016-03-02 09:14');
INSERT INTO `nal`.`workshop_has_attendee` (`Workshop_workshop_id`, `Attendee_Attendee_id`, `Reg_Time`) VALUES ('206', '17', '2016-03-03 09:14');
INSERT INTO `nal`.`workshop_has_attendee` (`Workshop_workshop_id`, `Attendee_Attendee_id`, `Reg_Time`) VALUES ('206', '18', '2016-03-04 09:14');
INSERT INTO `nal`.`workshop_has_attendee` (`Workshop_workshop_id`, `Attendee_Attendee_id`, `Reg_Time`) VALUES ('206', '19', '2016-03-05 09:14');
INSERT INTO `nal`.`workshop_has_attendee` (`Workshop_workshop_id`, `Attendee_Attendee_id`, `Reg_Time`) VALUES ('206', '20', '2016-03-06 09:14');
UPDATE `nal`.`workshop_has_attendee` SET `Reg_Time`='2015-10-05 10:14:00.000000' WHERE `Workshop_workshop_id`='200' and`Attendee_Attendee_id`='1';
INSERT INTO `nal`.`workshop_has_attendee` (`Workshop_workshop_id`, `Attendee_Attendee_id`, `Reg_Time`) VALUES ('200', '20', '2015-10-02 04:14:00.000000');
INSERT INTO `nal`.`workshop_has_attendee` (`Workshop_workshop_id`, `Attendee_Attendee_id`, `Reg_Time`) VALUES ('200', '19', '2015-10-01 10:14:00.000000');
INSERT INTO `nal`.`workshop_has_attendee` (`Workshop_workshop_id`, `Attendee_Attendee_id`, `Reg_Time`) VALUES ('200', '18', '2015-10-04 05:14:00.000000');
INSERT INTO `nal`.`workshop_has_attendee` (`Workshop_workshop_id`, `Attendee_Attendee_id`, `Reg_Time`) VALUES ('200', '17', '2015-09-08 09:14:00.000000');
INSERT INTO `nal`.`workshop_has_attendee` (`Workshop_workshop_id`, `Attendee_Attendee_id`, `Reg_Time`) VALUES ('200', '16', '2015-09-09 09:14:00.000000');
INSERT INTO `nal`.`workshop_has_attendee` (`Workshop_workshop_id`, `Attendee_Attendee_id`, `Reg_Time`) VALUES ('200', '15', '2015-10-03 11:14:00.000000');
INSERT INTO `nal`.`workshop_has_attendee` (`Workshop_workshop_id`, `Attendee_Attendee_id`, `Reg_Time`) VALUES ('200', '14', '2015-09-11 11:14:00.000000');


-- Iinserting into awic_trainer table
INSERT INTO `nal`.`awic_trainer` (`trainer_id`, `trainer_name`, `org2_id`) VALUES ('300', 'K. Adams', '104');
INSERT INTO `nal`.`awic_trainer` (`trainer_id`, `trainer_name`, `org2_id`) VALUES ('301', 'D. Jensen', '118');
INSERT INTO `nal`.`awic_trainer` (`trainer_id`, `trainer_name`, `org2_id`) VALUES ('302', 'T. Allen', '126');
INSERT INTO `nal`.`awic_trainer` (`trainer_id`, `trainer_name`, `org2_id`) VALUES ('303', 'K. Gucer ', '124');
INSERT INTO `nal`.`awic_trainer` (`trainer_id`, `trainer_name`, `org2_id`) VALUES ('304', 'S. Ball', '125');
INSERT INTO `nal`.`awic_trainer` (`trainer_id`, `trainer_name`, `org2_id`) VALUES ('305', 'T. Tanner', '127');
INSERT INTO `nal`.`awic_trainer` (`trainer_id`, `trainer_name`, `org2_id`) VALUES ('306', 'W. Thompson', '128');
INSERT INTO `nal`.`awic_trainer` (`trainer_id`, `trainer_name`, `org2_id`) VALUES ('307', 'K. Wiggins', '128');
INSERT INTO `nal`.`awic_trainer` (`trainer_id`, `trainer_name`, `org2_id`) VALUES ('308', 'D. Thompson', '127');
INSERT INTO `nal`.`awic_trainer` (`trainer_id`, `trainer_name`, `org2_id`) VALUES ('309', 'J. Mathias', '127');
INSERT INTO `nal`.`awic_trainer` (`trainer_id`, `trainer_name`, `org2_id`) VALUES ('310', 'M. Delacruz', '124');
INSERT INTO `nal`.`awic_trainer` (`trainer_id`, `trainer_name`, `org2_id`) VALUES ('311', 'S. Richards', '118');
INSERT INTO `nal`.`awic_trainer` (`trainer_id`, `trainer_name`, `org2_id`) VALUES ('312', 'G. Clooney', '126');
INSERT INTO `nal`.`awic_trainer` (`trainer_id`, `trainer_name`, `org2_id`) VALUES ('313', 'H. Brenton', '104');
INSERT INTO `nal`.`awic_trainer` (`trainer_id`, `trainer_name`, `org2_id`) VALUES ('314', 'K. Kaefer', '125');
INSERT INTO `nal`.`awic_trainer` (`trainer_id`, `trainer_name`, `org2_id`) VALUES ('315', 'H. Tausczik', '118');
INSERT INTO `nal`.`awic_trainer` (`trainer_id`, `trainer_name`, `org2_id`) VALUES ('316', 'M. Largess', '118');
INSERT INTO `nal`.`awic_trainer` (`trainer_id`, `trainer_name`, `org2_id`) VALUES ('317', 'J. Makuch', '127');
INSERT INTO `nal`.`awic_trainer` (`trainer_id`, `trainer_name`, `org2_id`) VALUES ('318', 'M. Geirge', '124');
INSERT INTO `nal`.`awic_trainer` (`trainer_id`, `trainer_name`, `org2_id`) VALUES ('319', 'T. Swift', '123');
INSERT INTO `nal`.`awic_trainer` (`trainer_id`, `trainer_name`, `org2_id`) VALUES ('320', 'M. Clooney', '123');

-- Inserting into payment_info table
INSERT INTO `nal`.`payment_info` (`reciept number`, `org_id`, `amount_paid`, `payment_date`, `payment_success`) VALUES ('400', '107', '50', '2015-10-05 10:14', '1');
INSERT INTO `nal`.`payment_info` (`reciept number`, `org_id`, `amount_paid`, `payment_date`, `payment_success`) VALUES ('401', '107', '50', '2015-10-05 10:14', '1');
INSERT INTO `nal`.`payment_info` (`reciept number`, `org_id`, `amount_paid`, `payment_date`, `payment_success`) VALUES ('402', '107', '50', '2015-10-04 10:14', '1');
INSERT INTO `nal`.`payment_info` (`reciept number`, `org_id`, `amount_paid`, `payment_date`, `payment_success`) VALUES ('403', '107', '50', '2015-10-06 09:14', '0');
INSERT INTO `nal`.`payment_info` (`reciept number`, `org_id`, `amount_paid`, `payment_date`, `payment_success`) VALUES ('404', '107', '50', '2015-10-06 11:14', '0');
INSERT INTO `nal`.`payment_info` (`reciept number`, `org_id`, `amount_paid`, `payment_date`, `payment_success`) VALUES ('405', '100', '50', '2015-10-06 10:14', '0');
INSERT INTO `nal`.`payment_info` (`reciept number`, `org_id`, `amount_paid`, `payment_date`, `payment_success`) VALUES ('406', '100', '30', '2015-10-26 10:14', '1');
INSERT INTO `nal`.`payment_info` (`reciept number`, `org_id`, `amount_paid`, `payment_date`, `payment_success`) VALUES ('407', '100', '30', '2015-10-27 10:14', '1');
INSERT INTO `nal`.`payment_info` (`reciept number`, `org_id`, `amount_paid`, `payment_date`, `payment_success`) VALUES ('408', '100', '30', '2015-10-28 10:14', '0');
INSERT INTO `nal`.`payment_info` (`reciept number`, `org_id`, `amount_paid`, `payment_date`, `payment_success`) VALUES ('409', '100', '30', '2015-10-28 11:14', '0');
INSERT INTO `nal`.`payment_info` (`reciept number`, `org_id`, `amount_paid`, `payment_date`, `payment_success`) VALUES ('410', '103', '40', '2015-11-02 11:14', '1');
INSERT INTO `nal`.`payment_info` (`reciept number`, `org_id`, `amount_paid`, `payment_date`, `payment_success`) VALUES ('411', '103', '40', '2015-11-02 13:14', '1');
INSERT INTO `nal`.`payment_info` (`reciept number`, `org_id`, `amount_paid`, `payment_date`, `payment_success`) VALUES ('412', '103', '40', '2015-11-01 11:14', '1');
INSERT INTO `nal`.`payment_info` (`reciept number`, `org_id`, `amount_paid`, `payment_date`, `payment_success`) VALUES ('413', '103', '40', '2015-10-29 11:14', '0');
INSERT INTO `nal`.`payment_info` (`reciept number`, `org_id`, `amount_paid`, `payment_date`, `payment_success`) VALUES ('414', '103', '40', '2015-11-06 11:14', '0');
INSERT INTO `nal`.`payment_info` (`reciept number`, `org_id`, `amount_paid`, `payment_date`, `payment_success`) VALUES ('415', '108', '35', '2015-11-07 11:14', '1');
INSERT INTO `nal`.`payment_info` (`reciept number`, `org_id`, `amount_paid`, `payment_date`, `payment_success`) VALUES ('416', '108', '35', '2015-08-11 11:14', '1');
INSERT INTO `nal`.`payment_info` (`reciept number`, `org_id`, `amount_paid`, `payment_date`, `payment_success`) VALUES ('417', '108', '35', '2015-11-09 11:14', '1');
INSERT INTO `nal`.`payment_info` (`reciept number`, `org_id`, `amount_paid`, `payment_date`, `payment_success`) VALUES ('418', '108', '35', '2015-11-10 11:14', '1');
INSERT INTO `nal`.`payment_info` (`reciept number`, `org_id`, `amount_paid`, `payment_date`, `payment_success`) VALUES ('419', '108', '35', '2015-11-11 11:14', '1');
INSERT INTO `nal`.`payment_info` (`reciept number`, `org_id`, `amount_paid`, `payment_date`, `payment_success`) VALUES ('420', '108', '35', '2015-11-12 11:14', '1');

-- Inserting into workshop_trainer table
INSERT INTO `nal`.`workshop_trainer` (`workshopID`, `trainerID`) VALUES ('200', '300');
INSERT INTO `nal`.`workshop_trainer` (`workshopID`, `trainerID`) VALUES ('201', '301');
INSERT INTO `nal`.`workshop_trainer` (`workshopID`, `trainerID`) VALUES ('202', '302');
INSERT INTO `nal`.`workshop_trainer` (`workshopID`, `trainerID`) VALUES ('203', '303');
INSERT INTO `nal`.`workshop_trainer` (`workshopID`, `trainerID`) VALUES ('203', '304');
INSERT INTO `nal`.`workshop_trainer` (`workshopID`, `trainerID`) VALUES ('203', '305');
INSERT INTO `nal`.`workshop_trainer` (`workshopID`, `trainerID`) VALUES ('202', '303');
INSERT INTO `nal`.`workshop_trainer` (`workshopID`, `trainerID`) VALUES ('204', '306');
INSERT INTO `nal`.`workshop_trainer` (`workshopID`, `trainerID`) VALUES ('204', '307');
INSERT INTO `nal`.`workshop_trainer` (`workshopID`, `trainerID`) VALUES ('204', '308');
INSERT INTO `nal`.`workshop_trainer` (`workshopID`, `trainerID`) VALUES ('204', '309');
INSERT INTO `nal`.`workshop_trainer` (`workshopID`, `trainerID`) VALUES ('205', '310');
INSERT INTO `nal`.`workshop_trainer` (`workshopID`, `trainerID`) VALUES ('205', '311');
INSERT INTO `nal`.`workshop_trainer` (`workshopID`, `trainerID`) VALUES ('205', '312');
INSERT INTO `nal`.`workshop_trainer` (`workshopID`, `trainerID`) VALUES ('206', '313');
INSERT INTO `nal`.`workshop_trainer` (`workshopID`, `trainerID`) VALUES ('207', '314');
INSERT INTO `nal`.`workshop_trainer` (`workshopID`, `trainerID`) VALUES ('207', '315');
INSERT INTO `nal`.`workshop_trainer` (`workshopID`, `trainerID`) VALUES ('207', '316');
INSERT INTO `nal`.`workshop_trainer` (`workshopID`, `trainerID`) VALUES ('208', '317');
INSERT INTO `nal`.`workshop_trainer` (`workshopID`, `trainerID`) VALUES ('208', '319');

 -- Creating a procedure to handle the attendees which has more than 10 attendees enrolled
 -- for a workshop so that it can be added in the waitlist. 
 -- It returns a list of all the people on the waitlist for a given workshop (filtering done based on timestamp)
 delimiter $$
create procedure get_waitlist (in workshopID int)
begin
select workshop_has_attendee.Reg_Time, workshop_has_attendee.Attendee_Attendee_id , workshop.topic, workshop.start_date, concat(attendee.first_name, attendee.last_name, ' ') as attendee_name_Waitlist
from (workshop
inner join workshop_has_attendee on workshop.workshop_id = workshop_has_attendee.Workshop_workshop_id)
inner join attendee on attendee.Attendee_id = workshop_has_attendee.Attendee_Attendee_id
where workshop_has_attendee.Workshop_workshop_id = workshopID
order by workshop_has_attendee.Reg_Time limit 11, 18446744073709551615;        #This is the maximum number of rows a MySQL database can hold
end;
$$

-- Calling the procedure
call get_waitlist(200);

-- Creating a trigger 
delimiter $$
	CREATE 
		TRIGGER `not_paid` BEFORE INSERT
		ON `payment_info`
		FOR each row
			BEGIN
				IF NEW.amount_paid <=0 THEN
				SIGNAL SQLSTATE '45000' 
				SET MESSAGE_TEXT = "Amount entered cannot be 0 or negative";
				END IF;
		END;
	$$
