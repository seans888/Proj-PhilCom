-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 15, 2015 at 03:02 PM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `acct_name`) VALUES
(1, 'SM Prime');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=154 ;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `logs_employee_name`, `milestone`, `milestone_date`, `project_id`) VALUES
(131, 'admin1', 'Project 1 updated1', '2015-08-10', 28),
(137, 'admin2', 'Project Created', '2015-08-13', 29),
(152, 'admin1', 'status | FOR COSTING UPDATED', '2015-08-14', 29),
(153, 'admin1', 'projectname | Test 8 qqqq UPDATED', '2015-08-14', 29);

-- --------------------------------------------------------

--
-- Table structure for table `pic`
--

CREATE TABLE IF NOT EXISTS `pic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pic_fullName` varchar(45) NOT NULL,
  `pic_email` varchar(45) NOT NULL,
  `pic_contact` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `pic`
--

INSERT INTO `pic` (`id`, `pic_fullName`, `pic_email`, `pic_contact`) VALUES
(1, 'Mark Anthony Andes', '', ''),
(2, 'Christine Joy Ferrer', '', ''),
(3, 'sasasas', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE IF NOT EXISTS `project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `projectcode` varchar(45) NOT NULL,
  `account_id` int(11) NOT NULL,
  `sitename_id` int(11) NOT NULL,
  `projectname` varchar(45) NOT NULL,
  `pic_id` int(11) NOT NULL,
  `status` varchar(45) NOT NULL,
  `contractor` varchar(45) NOT NULL,
  `date_of_flob` date NOT NULL,
  `date_of_completion` date NOT NULL,
  `percentage_of_completion` int(11) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_project_sitename1_idx` (`sitename_id`),
  KEY `fk_project_pic1_idx` (`pic_id`),
  KEY `fk_project_user1_idx` (`user_id`),
  KEY `fk_project_account1_idx` (`account_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id`, `projectcode`, `account_id`, `sitename_id`, `projectname`, `pic_id`, `status`, `contractor`, `date_of_flob`, `date_of_completion`, `percentage_of_completion`, `remarks`, `user_id`) VALUES
(28, 'SMBL-2015/08/10-0028', 1, 2, 'Project 1 updated6', 1, 'FOR REVISION', '', '0000-00-00', '0000-00-00', 28, NULL, 7),
(29, 'SMBL-2015/08/13-0029', 1, 2, 'Test 8 qqqq', 1, 'FOR COSTING', '', '0000-00-00', '0000-00-00', NULL, NULL, 8);

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
      (SELECT sitecode from sitename where id = NEW.sitename_id),"-",DATE_FORMAT(NOW(), "%Y/%m/%d-"),
      LPAD(LAST_INSERT_ID(), 4, '0'));

  
  SET NEW.projectcode = PRJ;
  
END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `tg_prj_insert_after`;
DELIMITER //
CREATE TRIGGER `tg_prj_insert_after` AFTER INSERT ON `project`
 FOR EACH ROW BEGIN

  declare PRJEMP varchar(20);
  declare PRJSTATUS varchar(45);
  declare PRJ varchar(45);
	
	SET PRJEMP =(SELECT username from user where id = NEW.user_id);
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `sitename`
--

INSERT INTO `sitename` (`id`, `sitecode`, `sitename`) VALUES
(1, 'SMCD', 'SM City Davao'),
(2, 'SMBL', 'SM Baliwag');

-- --------------------------------------------------------

--
-- Table structure for table `table_seq`
--

CREATE TABLE IF NOT EXISTS `table_seq` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `time_stamp` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `table_seq`
--

INSERT INTO `table_seq` (`id`, `time_stamp`) VALUES
(24, '2015-08-10'),
(25, '2015-08-10'),
(26, '2015-08-10'),
(27, '2015-08-10'),
(28, '2015-08-10'),
(29, '2015-08-13');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `lastname`, `firstname`, `roles`, `password_hash`, `password_reset_token`, `auth_key`, `status`, `created_at`, `updated_at`) VALUES
(7, 'admin1', 'Admin1 Lname', 'Admin1 Fname', 10, '$2y$13$PfAlqONnu84Ct09cMCL8peQe7sfGFadNtZgg/BhPjPEn9gJ8ynYeK', NULL, '0JpC_NRLmkVQamPt0kwsT_ittdGcAZ6y', 10, 1436072878, 1436072878),
(8, 'admin2', 'Admin2 Lname', 'Admin2 Fname', 10, '$2y$13$CLwyNd9kle4Bmnv13kYfy.IOsOUllxbiX/aQGqzvQsQkyExBZCLei', NULL, '1patD8t-0zf5Kmx6_WnHtfkRXPyaw5fH', 10, 1436072911, 1436072911),
(9, 'admin3', 'Admin3 Lname', 'Admin3 Fname', 10, '$2y$13$b4WybL1fLbiR8ZVhdNiul.JZ/3k7Iji8W000TF39/MXP7UfxM/hr6', NULL, 'z61WwwAnXLEisRiLndmk9VCFyPVb-h0I', 10, 1436072928, 1436072928),
(10, 'admin4', 'Admin4 Lname', 'Admin4 Fname', 10, '$2y$13$70Yq9l2rn0Ea8.y3eXfYeOBzxei1iFyTVN06hog2.n1USmgEP7mFq', NULL, 'RHWW1QdeJPz6vfzv8kW_vJ0jUPOeBmwG', 10, 1436072949, 1436072949),
(11, 'admin5', 'Admin5 Lname', 'Admin5 Fname', 10, '$2y$13$956UtPFXAAwWtU7sJwbqoerkJfRFzC3uCd/z4ZMLgRcK32qweSMBy', NULL, '6QDOe0S6fGl3y5wL26D7tr_JhXLFJkuK', 10, 1436072966, 1436072966),
(12, 'smclient', 'SM', 'Client', 30, '$2y$13$f65RO2TCs7zzn0eUMxNT9eM6ORid58a1G9kkZlN8ED6.VlFoAS9YW', NULL, 'E29opcV3h2m-k3QmhZP_29NE6B1qkihm', 10, 1436073109, 1436073109),
(14, 'employee1', 'employee Lname', 'employee Fname', 20, '$2y$13$Z8ZSr2GswUqgGDhcFounV.9YbC4Fl9y9zoUmFUx7DVVui2xksudiG', NULL, 'NWKoZM1k4mu4bLovCeIOG9wc4_xadzmu', 10, 1438853119, 1438853119);

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
  ADD CONSTRAINT `fk_project_account1` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_project_pic1` FOREIGN KEY (`pic_id`) REFERENCES `pic` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_project_sitename1` FOREIGN KEY (`sitename_id`) REFERENCES `sitename` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_project_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
