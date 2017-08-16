-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 16, 2017 at 08:30 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nal`
--
CREATE DATABASE IF NOT EXISTS `nal` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `nal`;

DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `get_waitlist`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_waitlist` (IN `workshopID` INT)  begin
select workshop_has_attendee.Reg_Time, workshop_has_attendee.Attendee_Attendee_id , workshop.topic, workshop.start_date, concat(attendee.first_name, attendee.last_name, ' ') as attendee_name_Waitlist
from (workshop
inner join workshop_has_attendee on workshop.workshop_id = workshop_has_attendee.Workshop_workshop_id)
inner join attendee on attendee.Attendee_id = workshop_has_attendee.Attendee_Attendee_id
where workshop_has_attendee.Workshop_workshop_id = workshopID
order by workshop_has_attendee.Reg_Time limit 11, 18446744073709551615;        end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `attendee`
--
-- Creation: Aug 10, 2017 at 02:59 AM
--

DROP TABLE IF EXISTS `attendee`;
CREATE TABLE IF NOT EXISTS `attendee` (
  `Attendee_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `title` varchar(45) DEFAULT NULL,
  `city` varchar(45) DEFAULT NULL,
  `state` varchar(45) DEFAULT NULL,
  `zip_code` int(11) DEFAULT NULL,
  `phone` bigint(12) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `IACUC_member_status` tinyint(1) DEFAULT NULL,
  `principal_investigator` tinyint(1) DEFAULT NULL,
  `experienced_db_searcher` tinyint(1) DEFAULT NULL,
  `attendee_orgID` int(11) DEFAULT NULL,
  PRIMARY KEY (`Attendee_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `attendee`
--

INSERT INTO `attendee` (`Attendee_id`, `first_name`, `last_name`, `title`, `city`, `state`, `zip_code`, `phone`, `email`, `IACUC_member_status`, `principal_investigator`, `experienced_db_searcher`, `attendee_orgID`) VALUES
(1, 'Kara', 'Barnside', 'Veterinarian', 'Laurel', 'MD', 20708, 3019976685, 'KB@example.com', 1, 1, 0, 100),
(2, 'Pam', 'Darling', 'IACUC Coordinator', 'Laurel', 'MD', 20708, 3014905678, 'PD@example.com', 1, 0, 1, 100),
(3, 'Lori', 'Clark', 'Librarian', 'Dickerson', 'MD', 20842, 4439790083, 'LC@example.com', 0, 0, 1, 100),
(4, 'Erica', 'Gotteman', 'Research Scientist', 'Staten Island', 'NY', 10306, 5667873214, 'EG@example.com', 1, 1, 1, 100),
(8, 'Nina', 'Precipe', 'IACUC Member (nonaffiliated)', 'Silver Spring', 'MD', 20993, 4105547621, 'NP@example.com', 1, 0, 0, 102),
(9, 'Michael ', 'Reese', 'Librarian', 'Bethesda', 'MD', 20892, 4434549000, 'MR1@example.com', 1, 0, 0, 101),
(10, 'Roger', 'Moore', 'Animal Facility Member', 'Louisville', 'KY', 40041, 9942320188, 'RM@example.com', 1, 0, 0, 101),
(11, 'Bob', 'Sagat', 'Biosafety Officer', 'Washington', 'DC', 20307, 8823339997, 'BS34@example.com', 1, 0, 0, 103),
(12, 'Phyllis', 'Diller', 'Research Scientist', 'Radnor ', 'PA', 19087, 2237757790, 'PH2@example.com', 1, 1, 1, 103),
(13, 'Liana', 'Phillipe-Sarte', 'Research Scientist', 'Fort Collins', 'CO', 80524, 9703327211, 'LPS@example.com', 1, 1, 1, 103),
(14, 'Barbara', 'Paco', 'Librarian', 'Bethesda', 'MD', 20892, 3016657832, 'BP4@example.com', 0, 0, 1, 110),
(15, 'Carrie', 'Underbranch', 'Veterinarian', 'Lincoln', 'NE', 68588, 6327774111, 'CU3@example.com', 1, 0, 0, 105),
(16, 'Harvey', 'Brookmeister', 'IACUC Chair', 'Washington ', 'DC', 20307, 3015557000, 'HB1@example.com', 1, 0, 1, 104),
(17, 'Audrey', 'Vontrappe', 'Facility Manager', 'Cambridge', 'MA', 2142, 8832215567, 'AVT3@example.com', 0, 0, 0, 105),
(18, 'Jared', 'Fortunado', 'Statistician', 'Athens ', 'GA', 30605, 7736641000, 'JF34@example.com', 0, 1, 0, 104),
(19, 'Paula ', 'Sebring', 'Lbrarian', 'Bethesda', 'MD', 20892, 4436607322, 'NMN@example.com', 1, 0, 1, 106),
(20, 'Diane', 'Wane', 'IACUC Member ', 'Ellicott City', 'MD', 21043, 4107742200, 'DW92@example.com', 1, 1, 0, 107),
(25, 'Someone', 'Else', 'Scientist', 'College Park', 'MD', 20783, 9999999999, 'rahuljungbahadur@gmail.com', 0, 0, 1, 118);

-- --------------------------------------------------------

--
-- Table structure for table `awic_trainer`
--
-- Creation: Aug 10, 2017 at 02:59 AM
--

DROP TABLE IF EXISTS `awic_trainer`;
CREATE TABLE IF NOT EXISTS `awic_trainer` (
  `trainer_id` int(11) NOT NULL,
  `trainer_name` varchar(45) DEFAULT NULL,
  `org2_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`trainer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `awic_trainer`
--

INSERT INTO `awic_trainer` (`trainer_id`, `trainer_name`, `org2_id`) VALUES
(300, 'K. Adams', 104),
(301, 'D. Jensen', 118),
(302, 'T. Allen', 126),
(303, 'K. Gucer ', 124),
(304, 'S. Ball', 125),
(305, 'T. Tanner', 127),
(306, 'W. Thompson', 128),
(307, 'K. Wiggins', 128),
(308, 'D. Thompson', 127),
(309, 'J. Mathias', 127),
(310, 'M. Delacruz', 124),
(311, 'S. Richards', 118),
(312, 'G. Clooney', 126),
(313, 'H. Brenton', 104),
(314, 'K. Kaefer', 125),
(315, 'H. Tausczik', 118),
(316, 'M. Largess', 118),
(317, 'J. Makuch', 127),
(318, 'M. Geirge', 124),
(319, 'T. Swift', 123),
(320, 'M. Clooney', 123);

-- --------------------------------------------------------

--
-- Table structure for table `organization`
--
-- Creation: Aug 10, 2017 at 02:59 AM
--

DROP TABLE IF EXISTS `organization`;
CREATE TABLE IF NOT EXISTS `organization` (
  `organization_id` int(11) NOT NULL,
  `organization_name` varchar(120) DEFAULT NULL,
  `whether_host` tinyint(1) DEFAULT NULL,
  `whether_sponsor` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`organization_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `organization`
--

INSERT INTO `organization` (`organization_id`, `organization_name`, `whether_host`, `whether_sponsor`) VALUES
(100, 'Plyonetics Corporation', 0, 0),
(101, 'NIH, NIAID', 1, 1),
(102, 'University of Richmond', 0, 1),
(103, 'Harris Laboratory', 0, 0),
(104, 'NAL, USDA', 1, 0),
(105, 'FDA, CFSAN', 1, 0),
(106, 'USDA, APHIS', 1, 0),
(107, 'Deity Therapeutics, Inc.', 0, 0),
(108, 'FDA, CVM', 0, 0),
(109, 'NIH-Library', 0, 1),
(110, 'Louisville University', 1, 0),
(111, 'Walter Reed Army Medical Center', 0, 0),
(112, 'Centaur Pharmaceuticals, Inc.', 0, 0),
(113, 'Colorado State University', 1, 0),
(114, 'NIH Library', 0, 1),
(115, 'University of Nebraska', 1, 0),
(116, 'Walter Reed Army Institute of Research', 0, 0),
(117, 'Biogenetics Limited', 0, 0),
(118, 'USDA, ARS', 0, 1),
(119, 'Roger Carter Pharmaceuticals', 0, 1),
(120, 'USAMRIID', 0, 1),
(121, ' USDA Forest Service', 1, 0),
(122, 'Kansas Medical Center', 1, 0),
(123, 'University of Oklahoma', 1, 0),
(124, 'University of Maryland', 1, 0),
(125, 'North Carolina Association for Biomedical Research (NCABR)', 1, 0),
(126, 'PRIM&R Seattle, WA', 1, 0),
(127, 'Pan American Conference on Alternatives', 1, 0),
(128, 'UMD Animal Sciences, College Park, MD', 1, 0),
(129, 'AFFRI', 1, 0),
(130, 'FDA Center for Veterinary Medicine', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `payment_info`
--
-- Creation: Aug 10, 2017 at 02:59 AM
--

DROP TABLE IF EXISTS `payment_info`;
CREATE TABLE IF NOT EXISTS `payment_info` (
  `reciept number` int(11) NOT NULL,
  `org_id` int(11) DEFAULT NULL,
  `amount_paid` int(11) DEFAULT NULL,
  `payment_date` timestamp(6) NULL DEFAULT NULL,
  `payment_success` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`reciept number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payment_info`
--

INSERT INTO `payment_info` (`reciept number`, `org_id`, `amount_paid`, `payment_date`, `payment_success`) VALUES
(400, 107, 50, '2015-10-05 14:14:00.000000', 1),
(401, 107, 50, '2015-10-05 14:14:00.000000', 1),
(402, 107, 50, '2015-10-04 14:14:00.000000', 1),
(403, 107, 50, '2015-10-06 13:14:00.000000', 0),
(404, 107, 50, '2015-10-06 15:14:00.000000', 0),
(405, 100, 50, '2015-10-06 14:14:00.000000', 0),
(406, 100, 30, '2015-10-26 14:14:00.000000', 1),
(407, 100, 30, '2015-10-27 14:14:00.000000', 1),
(408, 100, 30, '2015-10-28 14:14:00.000000', 0),
(409, 100, 30, '2015-10-28 15:14:00.000000', 0),
(410, 103, 40, '2015-11-02 16:14:00.000000', 1),
(411, 103, 40, '2015-11-02 18:14:00.000000', 1),
(412, 103, 40, '2015-11-01 16:14:00.000000', 1),
(413, 103, 40, '2015-10-29 15:14:00.000000', 0),
(414, 103, 40, '2015-11-06 16:14:00.000000', 0),
(415, 108, 35, '2015-11-07 16:14:00.000000', 1),
(416, 108, 35, '2015-08-11 15:14:00.000000', 1),
(417, 108, 35, '2015-11-09 16:14:00.000000', 1),
(418, 108, 35, '2015-11-10 16:14:00.000000', 1),
(419, 108, 35, '2015-11-11 16:14:00.000000', 1),
(420, 108, 35, '2015-11-12 16:14:00.000000', 1);

--
-- Triggers `payment_info`
--
DROP TRIGGER IF EXISTS `not_paid`;
DELIMITER $$
CREATE TRIGGER `not_paid` BEFORE INSERT ON `payment_info` FOR EACH ROW BEGIN
				IF NEW.amount_paid <=0 THEN
				SIGNAL SQLSTATE '45000' 
				SET MESSAGE_TEXT = "Amount entered cannot be 0 or negative";
				END IF;
		END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `workshop`
--
-- Creation: Aug 10, 2017 at 02:59 AM
--

DROP TABLE IF EXISTS `workshop`;
CREATE TABLE IF NOT EXISTS `workshop` (
  `workshop_id` int(11) NOT NULL AUTO_INCREMENT,
  `topic` varchar(120) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `location_address` varchar(120) DEFAULT NULL,
  `zip_code` int(11) DEFAULT NULL,
  `workshop_type` varchar(45) DEFAULT NULL,
  `organization_id` int(11) DEFAULT NULL,
  `overall_rating` int(11) DEFAULT NULL,
  `presentation_quality` int(11) DEFAULT NULL,
  `duration` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`workshop_id`)
) ENGINE=InnoDB AUTO_INCREMENT=221 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `workshop`
--

INSERT INTO `workshop` (`workshop_id`, `topic`, `start_date`, `end_date`, `location_address`, `zip_code`, `workshop_type`, `organization_id`, `overall_rating`, `presentation_quality`, `duration`) VALUES
(200, 'Considering Alternatives in Wildlife Research', '2015-10-06', '2015-10-07', ' USDA Forest Service', 20783, 'Webinar', 121, 8, 8, '2 hours'),
(201, 'Meeting the Information Requirements of the Animal Welfare Act', '2015-10-28', '2015-10-29', 'National Agricultural Library, Beltsville, MD', 20742, 'Presentation', 104, 7, 9, '1.5 days'),
(202, 'Meeting the Information Requirements of the Animal Welfare Act', '2015-11-03', '2015-11-03', 'Kansas Medical Center', 20895, 'Webinar', 122, 8, 8, '3 hours'),
(203, 'Meeting the Information Requirements of the Animal Welfare Act', '2015-11-12', '2015-11-12', 'University of Oklahoma, Health Science Center, Oklahoma City, OK', 60985, 'Workshop', 123, 8, 8, '1 day'),
(204, 'Considering Alternatives in Wildlife Research', '2015-11-18', '2015-11-19', 'USDA Forest Service', 20783, 'Webinar', 121, 9, 9, '2 hours'),
(205, 'Federal Oversight of Animals in Research', '2016-03-10', '2016-03-10', 'Laboratory Animal Management, UMD. College Park, MD', 20740, 'Presentation', 124, 6, 6, '1 hour'),
(206, 'Meeting the Information Requirements of the Animal Welfare Act', '2016-03-25', '2016-03-25', 'North Carolina Association for Biomedical Research (NCABR)', 20543, 'Webinar', 125, 8, 7, '3 hours'),
(207, 'Harm-Benefit Analysis on Studies Involving Unalleviated Pain and Distress', '2016-04-01', '2016-04-01', 'PRIM&R Seattle, WA', 23645, 'Presentation', 126, 10, 8, '2 hours'),
(208, 'Development of 3Rs Information Resources at the Animal Welfare Information Center', '2016-04-06', '2016-04-14', 'Pan American Conference on Alternatives. Baltimore, MD', 34562, 'Poster Presentation', 127, 9, 9, '2 days'),
(210, 'Harm-benefit and humane endpoints', '2016-05-26', '2016-05-26', 'AFFRI. Bethesda, MD', 20742, 'Presentation', 129, 8, 8, '1 hour'),
(211, 'Searching for 3Rs Alternatives When Using Live Animals in Research', '2016-09-13', '2016-09-15', 'USDA ARS', 20742, 'Webinar', 118, 7, 8, '15 hours'),
(212, 'Meeting the Information Requirements of the Animal Welfare Act', '2016-09-21', '2016-09-21', 'FDA Center for Veterinary Medicine\nSilver Spring, MD\n', 20742, 'Workshop', 130, 7, 9, '12 hours'),
(213, 'Meeting the Information Requirements of the Animal Welfare Act', '2016-12-21', '2016-12-24', 'FDA Center for Veterinary Medicine\nSilver Spring, MD\n', 20742, 'Workshop', 130, 7, 7, '3 days'),
(214, 'Alternatives Considerations in Nonhuman Primate Research', '2016-08-25', '2016-08-25', 'AFFRI. Bethesda, MD', 20742, 'Presentation', 129, 6, 9, '4 hours'),
(215, 'Considering Alternatives in Wildlife Research', '2016-01-28', '2016-01-30', 'USDA Forest Service', 20783, 'Webinar', 121, 7, 7, '8 hours'),
(216, 'Harm-benefit and humane endpoints', '2015-11-04', '2015-11-04', 'Kansas Medical Center', 20895, 'Webinar', 122, 7, 7, '6 hours'),
(217, 'Searching for 3Rs Alternatives When Using Live Animals in Research', '2015-08-25', '2015-08-27', 'USDA ARS', 20742, 'Webinar', 118, 7, 7, '9 hours'),
(218, 'Alternatives Considerations in Nonhuman Primate Research', '2016-05-28', '2016-05-28', 'North Carolina Association for Biomedical Research (NCABR)', 20543, 'Presentation', 125, 8, 8, '4 hours'),
(219, 'Searching for 3Rs Alternatives When Using Live Animals in Research', '2016-01-14', '2016-01-14', 'USDA ARS', 20742, 'Workshop', 118, 7, 6, '3 hours'),
(220, 'Harm-Benefit Analysis on Studies Involving Unalleviated Pain and Distress', '2016-04-10', '2016-04-12', 'PRIM&R Seattle, WA', 23645, 'Workshop', 104, 8, 7, '9 hours');

-- --------------------------------------------------------

--
-- Table structure for table `workshop_has_attendee`
--
-- Creation: Aug 10, 2017 at 02:59 AM
--

DROP TABLE IF EXISTS `workshop_has_attendee`;
CREATE TABLE IF NOT EXISTS `workshop_has_attendee` (
  `Workshop_workshop_id` int(11) NOT NULL,
  `Attendee_Attendee_id` int(11) NOT NULL,
  `Reg_Time` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
  PRIMARY KEY (`Workshop_workshop_id`,`Attendee_Attendee_id`),
  KEY `fk_Workshop_has_Attendee_Workshop1_idx` (`Workshop_workshop_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `workshop_has_attendee`
--

INSERT INTO `workshop_has_attendee` (`Workshop_workshop_id`, `Attendee_Attendee_id`, `Reg_Time`) VALUES
(200, 1, '2015-10-05 14:14:00.000000'),
(200, 2, '2015-10-02 07:14:00.000000'),
(200, 3, '2015-10-01 07:14:00.000000'),
(200, 4, '2015-10-03 07:14:00.000000'),
(200, 8, '2017-08-16 05:20:53.887486'),
(200, 14, '2015-09-11 15:14:00.000000'),
(200, 15, '2015-10-03 15:14:00.000000'),
(200, 16, '2015-09-09 13:14:00.000000'),
(200, 17, '2015-09-08 13:14:00.000000'),
(200, 18, '2015-10-04 09:14:00.000000'),
(200, 19, '2015-10-01 14:14:00.000000'),
(202, 6, '2015-11-02 14:14:00.000000'),
(202, 7, '2015-11-01 14:14:00.000000'),
(202, 8, '2015-10-31 13:14:00.000000'),
(202, 9, '2015-10-30 13:14:00.000000'),
(202, 10, '2015-10-28 13:14:00.000000'),
(205, 1, '2017-08-16 02:13:12.671862'),
(205, 2, '2017-08-16 03:02:00.855575'),
(205, 3, '2017-08-16 03:02:00.963056'),
(205, 12, '2016-03-09 14:14:00.000000'),
(205, 14, '2016-03-09 14:14:00.000000'),
(205, 15, '2016-03-01 14:14:00.000000'),
(205, 19, '2017-08-16 02:55:42.531909'),
(206, 16, '2016-03-02 14:14:00.000000'),
(206, 17, '2016-03-03 14:14:00.000000'),
(206, 18, '2016-03-04 14:14:00.000000'),
(206, 19, '2016-03-05 14:14:00.000000'),
(207, 1, '2017-08-16 03:04:50.675664'),
(207, 2, '2017-08-16 03:04:50.774750'),
(207, 3, '2017-08-16 03:04:50.844517'),
(207, 4, '2017-08-16 03:06:05.738980'),
(207, 6, '2017-08-16 03:06:35.169427'),
(207, 8, '2017-08-16 03:06:35.255894'),
(208, 1, '2017-08-16 03:14:13.288214'),
(208, 2, '2017-08-16 03:14:13.382571'),
(208, 3, '2017-08-16 03:14:33.229930'),
(208, 4, '2017-08-16 03:13:24.035388'),
(208, 6, '2017-08-16 03:15:38.419801'),
(208, 9, '2017-08-16 03:32:28.574968'),
(208, 10, '2017-08-16 03:17:29.457010'),
(208, 11, '2017-08-16 03:20:19.702915'),
(208, 14, '2017-08-16 03:16:48.946381'),
(213, 2, '2017-08-16 04:58:43.226849'),
(215, 1, '2017-08-16 05:01:57.076636'),
(215, 3, '2017-08-16 05:01:57.163197'),
(215, 8, '2017-08-16 05:01:57.220739'),
(215, 10, '2017-08-16 05:02:07.018231'),
(215, 17, '2017-08-16 05:02:07.087292');

-- --------------------------------------------------------

--
-- Table structure for table `workshop_trainer`
--
-- Creation: Aug 10, 2017 at 02:59 AM
--

DROP TABLE IF EXISTS `workshop_trainer`;
CREATE TABLE IF NOT EXISTS `workshop_trainer` (
  `workshopID` int(11) NOT NULL,
  `trainerID` int(11) NOT NULL,
  PRIMARY KEY (`workshopID`,`trainerID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `workshop_trainer`
--

INSERT INTO `workshop_trainer` (`workshopID`, `trainerID`) VALUES
(200, 300),
(201, 301),
(202, 302),
(202, 303),
(203, 303),
(203, 304),
(203, 305),
(204, 306),
(204, 307),
(204, 308),
(204, 309),
(205, 310),
(205, 311),
(205, 312),
(206, 313),
(207, 314),
(207, 315),
(207, 316),
(208, 317),
(208, 319);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
