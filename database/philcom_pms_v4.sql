-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 09, 2015 at 05:05 PM
-- Server version: 5.6.14
-- PHP Version: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `philcom_pms`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE IF NOT EXISTS `account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `acct_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `acct_name`) VALUES
(1, 'SM Prime'),
(2, 'SMDC'),
(3, 'SMIC'),
(4, 'WalterMart'),
(5, 'SM LEI');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE IF NOT EXISTS `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `logs_employee_name` varchar(45) DEFAULT NULL,
  `milestone` varchar(45) DEFAULT NULL,
  `milestone_date` varchar(25) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_logs_project1_idx` (`project_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `logs_employee_name`, `milestone`, `milestone_date`, `project_id`) VALUES
(1, 'Admin2 Fname Admin1 Lname', 'Project Created', '2015-09-08', 1),
(2, 'Admin2 Fname Admin1 Lname', 'Project Created', '2015-09-08', 2),
(3, 'Admin2 Fname Admin1 Lname', 'Project Created', '2015-09-08', 3),
(4, 'Admin2 Fname Admin1 Lname', 'Project Created', '2015-09-08', 4),
(5, 'Admin2 Fname Admin1 Lname', 'status | FOR DESIGNING UPDATED', '2015-09-08 08:34:39am', 4),
(6, 'Admin2 Fname Admin1 Lname', 'status | FOR MOBILAZATION UPDATED', '2015-09-08 08:35:14am', 4),
(7, 'Admin2 Fname Admin1 Lname', '% of Completion | 80 UPDATED', '2015-09-08 08:36:11am', 4),
(8, 'Admin2 Fname Admin1 Lname', 'status | PHYSICALLY COMPLETED UPDATED', '2015-09-08 08:36:34am', 4),
(9, 'Admin2 Fname Admin1 Lname', 'status | ACCEPTED UPDATED', '2015-09-08 08:36:50am', 4),
(10, 'employee2 Fname employee2 Lname', '% of Completion | 80 UPDATED', '2015-09-08 08:41:41am', 3),
(11, 'Admin2 Fname Admin1 Lname', 'Project Created', '2015-09-08', 5),
(12, 'Admin2 Fname Admin1 Lname', 'status | FOR REVIEW UPDATED', '2015-09-08 08:58:12am', 5),
(13, 'Admin2 Fname Admin1 Lname', 'status | PHYSICALLY COMPLETED UPDATED', '2015-09-08 09:01:09am', 5),
(14, 'Admin2 Fname Admin1 Lname', 'Remarks | waiting for plotting\r\n UPDATED', '2015-09-08 09:02:30am', 5),
(15, 'Admin2 Fname Admin1 Lname', 'Project Created', '2015-09-09', 6);

-- --------------------------------------------------------

--
-- Table structure for table `pic`
--

CREATE TABLE IF NOT EXISTS `pic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pic_fullName` varchar(45) NOT NULL,
  `pic_email` varchar(45) DEFAULT NULL,
  `pic_contact` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `pic`
--

INSERT INTO `pic` (`id`, `pic_fullName`, `pic_email`, `pic_contact`) VALUES
(4, 'GERALD CRUZ', 'sample@gmail.com', '09335504839'),
(5, 'RAYNIEL OMAGA', 'sample2@gmal.com', '09155654271'),
(6, 'ALDREN AUSTRIA', 'sample3@gmail.com', '09123456789'),
(7, 'ARVIN SACLOLO', 'sample4@gmail.com', '09317637282'),
(8, 'ROSSAN GUANZON', 'sample5@gmail.com', '09275672892'),
(9, 'ROSALYN CONCEPCION', NULL, NULL),
(10, 'VENJI VIVAS', NULL, NULL),
(11, 'TOM GRAFILO', NULL, NULL),
(12, 'HOPE MERCADO', NULL, NULL),
(13, 'GLYZEL ADORIO', NULL, NULL),
(14, 'HAIFA DAMASCO', NULL, NULL),
(15, 'JULIE VILLANERA', NULL, NULL),
(16, 'ANGELIE SAMBAYAN', NULL, NULL),
(17, 'FLEXIE PORTELO', NULL, NULL),
(18, 'NORIEL PORTALES', NULL, NULL),
(19, 'JOYCE PEREZ', NULL, NULL),
(20, 'JAMILLE CARINGAL', NULL, NULL),
(21, 'ALLAN DE VERA', NULL, NULL),
(22, 'RON ROBEA', NULL, NULL),
(23, 'ARJAY SOLIS', NULL, NULL),
(24, 'DEAN CAYAGO', NULL, NULL),
(25, 'BRYAN FAVILA', NULL, NULL),
(26, 'CHRISTINE JOY FERRER', 'caferrer@gmail.com', '09239525951'),
(27, 'Maria Montemayor', 'mariam@gmail.com', '09526372820');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE IF NOT EXISTS `project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `projectcode` varchar(45) NOT NULL,
  `account_id` int(11) DEFAULT NULL,
  `sitename_id` int(11) DEFAULT NULL,
  `projectname` varchar(45) NOT NULL,
  `pic_id` int(11) DEFAULT NULL,
  `status` varchar(45) NOT NULL,
  `contractor` varchar(45) NOT NULL,
  `date_of_flob` date NOT NULL,
  `date_of_completion` date NOT NULL,
  `percentage_of_completion` int(11) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_project_sitename1_idx` (`sitename_id`),
  KEY `fk_project_pic1_idx` (`pic_id`),
  KEY `fk_project_user1_idx` (`user_id`),
  KEY `fk_project_account1_idx` (`account_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id`, `projectcode`, `account_id`, `sitename_id`, `projectname`, `pic_id`, `status`, `contractor`, `date_of_flob`, `date_of_completion`, `percentage_of_completion`, `remarks`, `user_id`) VALUES
(1, 'SMBL-2015/09/08-0001', 2, 58, 'Sample Project 1', 7, '', '', '0000-00-00', '0000-00-00', NULL, NULL, 14),
(2, 'SMCC-2015/09/08-0002', 1, 70, 'Sample Project 2', 8, '', '', '0000-00-00', '0000-00-00', NULL, NULL, 14),
(3, 'SMLC-2015/09/08-0003', 3, 82, 'Sample Project 3', 20, 'ON-GOING', '', '0000-00-00', '0000-00-00', 80, NULL, 14),
(4, 'SMAU-2015/09/08-0004', 1, 59, 'additional CCTV', 8, 'ACCEPTED', '', '0000-00-00', '0000-00-00', 100, NULL, 14),
(5, 'SMSR-2015/09/08-0005', 1, 105, 'digital poster box', 15, 'PHYSICALLY COMPLETED', '', '0000-00-00', '0000-00-00', 90, 'waiting for plotting\r\n', 14),
(6, 'SMBD -15/09-0006', 4, 60, 'Sample Project 6', 24, '', '', '0000-00-00', '0000-00-00', NULL, NULL, 14);

--
-- Triggers `project`
--
DROP TRIGGER IF EXISTS `tg_prj_insert`;
DELIMITER //
CREATE TRIGGER `tg_prj_insert` BEFORE INSERT ON `project`
 FOR EACH ROW BEGIN

  declare PRJ varchar(20); 
	

  INSERT INTO table_seq VALUES (NULL, CURDATE());  


 

SET PRJ = CONCAT(
      (SELECT sitecode from sitename where id = NEW.sitename_id),"-",DATE_FORMAT(NOW(), "%y/%m-"),
      LPAD(LAST_INSERT_ID(), 4, '0'));

  
  SET NEW.projectcode = PRJ;
  
END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `tg_prj_insert_after`;
DELIMITER //
CREATE TRIGGER `tg_prj_insert_after` AFTER INSERT ON `project`
 FOR EACH ROW BEGIN

  declare PRJEMP varchar(50);
  declare PRJSTATUS varchar(45);
  declare PRJ varchar(45);
	
    SET PRJEMP =CONCAT(
      (SELECT firstname from user where id = NEW.user_id)," ",(SELECT lastname from user where id = NEW.user_id));
    SET PRJSTATUS = "Project Created";
    SET PRJ =(SELECT id from project where id = NEW.id);

  INSERT INTO logs VALUES (NULL, PRJEMP,PRJSTATUS ,CURDATE(),PRJ); 
  
  
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `sitename`
--

CREATE TABLE IF NOT EXISTS `sitename` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sitecode` varchar(45) NOT NULL,
  `sitename` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=116 ;

--
-- Dumping data for table `sitename`
--

INSERT INTO `sitename` (`id`, `sitecode`, `sitename`) VALUES
(57, 'SMCD', 'SM City Davao'),
(58, 'SMBL', 'SM Baliwag'),
(59, 'SMAU', 'Aura'),
(60, 'SMBD ', 'Bacolod'),
(61, 'SMCB', 'Bacoor'),
(62, 'SMBG', 'Baguio'),
(63, 'SMBL', 'Baliwag'),
(64, 'SMBA', 'Batangas'),
(65, 'SMBT', 'Bicutan'),
(66, 'SMC', 'Cabanatuan'),
(67, 'SMCO', 'Cagayan De Oro'),
(68, 'SMCL', 'Calamba'),
(69, 'SMCA', 'Cauyan'),
(70, 'SMCC', 'Cebu'),
(71, 'SMCT', 'Center Cabanatuan'),
(72, 'SMCK', 'Clark'),
(73, 'SMCS', 'Consolacion'),
(74, 'SMDM', 'Dasmarinas'),
(75, 'SMCD', 'Davao'),
(76, 'SMCF', 'Fairview'),
(77, 'SMGS', 'General Santos'),
(78, 'SHLL', 'Hypermarket Lapu-Lapu'),
(79, 'SMCI', 'Ilo-ilo'),
(80, 'SMLA', 'Lanang'),
(81, 'SMLP', 'Lipa'),
(82, 'SMLC', 'Lucena'),
(83, 'SMOA', 'Mall of Asia'),
(84, 'SMCM', 'Manila'),
(85, 'SMMR', 'Marilao'),
(86, 'SMMK', 'Marikina'),
(87, 'SMMS', 'Masinag'),
(88, 'SMMG', 'Megamall'),
(89, 'SMML', 'Molino'),
(90, 'SMMT', 'Muntinlupa'),
(91, 'SMNG', 'Naga'),
(92, 'SMNT', 'Nagtahan'),
(93, 'SMNE', 'North Edsa'),
(94, 'SMNV', 'Novaliches'),
(95, 'SMOL', 'Olongapo'),
(96, 'SMPP', 'Pampanga'),
(97, 'SMKL', 'Podium'),
(98, 'SMRS', 'Rosales'),
(99, 'SMRO', 'Rosario'),
(100, 'SMSF', 'San Fernando'),
(101, 'SMSL', 'San Lazaro'),
(102, 'SMMA', 'San Mateo'),
(103, 'SMST', 'Sta. Mesa'),
(104, 'SMPB', 'San Pablo'),
(105, 'SMSR', 'Sta. Rosa'),
(106, 'SVTA', 'Savemore Market Tacloban'),
(107, 'SMSM', 'Southmall'),
(108, 'SMSC', 'Sucat'),
(109, 'SMTL', 'Tarlac'),
(110, 'SMTT', 'Taytay'),
(111, 'SMVL', 'Valenzuela'),
(113, 'SMSEABU', 'SM Seaside Cebu'),
(114, 'GREEN', 'SMDC GREEN'),
(115, 'SM SEA', 'SM Seaside Cebu haha');

-- --------------------------------------------------------

--
-- Table structure for table `table_seq`
--

CREATE TABLE IF NOT EXISTS `table_seq` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `time_stamp` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `table_seq`
--

INSERT INTO `table_seq` (`id`, `time_stamp`) VALUES
(1, '2015-09-08'),
(2, '2015-09-08'),
(3, '2015-09-08'),
(4, '2015-09-08'),
(5, '2015-09-08'),
(6, '2015-09-09');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(45) NOT NULL,
  `firstname` varchar(45) NOT NULL,
  `roles` int(11) NOT NULL,
  `password_hash` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) DEFAULT NULL,
  `auth_key` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `lastname`, `firstname`, `roles`, `password_hash`, `password_reset_token`, `auth_key`, `status`, `created_at`, `updated_at`) VALUES
(8, 'admin2', 'Admin2 Lname', 'Admin2 Fname', 10, '$2y$13$CLwyNd9kle4Bmnv13kYfy.IOsOUllxbiX/aQGqzvQsQkyExBZCLei', NULL, '1patD8t-0zf5Kmx6_WnHtfkRXPyaw5fH', 10, 1436072911, 1436072911),
(10, 'admin4', 'Admin4 Lname', 'Admin4 Fname', 10, '$2y$13$70Yq9l2rn0Ea8.y3eXfYeOBzxei1iFyTVN06hog2.n1USmgEP7mFq', NULL, 'RHWW1QdeJPz6vfzv8kW_vJ0jUPOeBmwG', 10, 1436072949, 1436072949),
(11, 'admin5', 'Admin5 Lname', 'Admin5 Fname', 10, '$2y$13$956UtPFXAAwWtU7sJwbqoerkJfRFzC3uCd/z4ZMLgRcK32qweSMBy', NULL, '6QDOe0S6fGl3y5wL26D7tr_JhXLFJkuK', 10, 1436072966, 1436072966),
(12, 'smclient', 'SM', 'Client', 30, '$2y$13$f65RO2TCs7zzn0eUMxNT9eM6ORid58a1G9kkZlN8ED6.VlFoAS9YW', NULL, 'E29opcV3h2m-k3QmhZP_29NE6B1qkihm', 10, 1436073109, 1436073109),
(14, 'admin1', 'Admin1 Lname', 'Admin2 Fname', 10, '$2y$13$.fLaFxiRwuDdVzUIgRBy4OtXexobeUGqp9vXZlm7EGwEtNifkonce', NULL, 'NWKoZM1k4mu4bLovCeIOG9wc4_xadzmu', 10, 1438853119, 1438853119),
(15, 'employee2', 'employee2 Lname', 'employee2 Fname', 20, '$2y$13$svAK8Q1FCceG0V1kn66cvOwTEeJQBMSiLmkp3AhPdccMCHnOtWb9C', NULL, 'h3gzTRfAgwL7pFeDTDmLHvQixlPGAqm_', 10, 1441252839, 1441252839),
(22, 'admin3', 'Admin3 Lname', 'Admin3 Fname', 10, '$2y$13$4RyY0INhhsDBetSnCkrnDOTkVtsk5XzZq0u38ZBrQL499vVos0Zhy', NULL, 'mXsnJni4sZdZYLGASW5jMyDX-NIAO380', 10, 1441542862, 1441542862);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `fk_logs_project1` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION;

--
-- Constraints for table `project`
--
ALTER TABLE `project`
  ADD CONSTRAINT `fk_project_account1` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_project_pic1` FOREIGN KEY (`pic_id`) REFERENCES `pic` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_project_sitename1` FOREIGN KEY (`sitename_id`) REFERENCES `sitename` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_project_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
