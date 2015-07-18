-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 17, 2015 at 04:54 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sales`
--


-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE IF NOT EXISTS `appointment` (
  `appid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `custid` int(10) unsigned NOT NULL DEFAULT '0',
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `date` decimal(21,0) NOT NULL DEFAULT '0',
  `partner` int(10) unsigned DEFAULT NULL,
  `remarks` varchar(500) NOT NULL DEFAULT '',
  PRIMARY KEY (`appid`),
  KEY `FK_appointment_1` (`custid`),
  KEY `FK_appointment_2` (`uid`),
  KEY `FK_appointment_3` (`partner`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `callback`
--

CREATE TABLE IF NOT EXISTS `callback` (
  `cbid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `custid` int(10) unsigned NOT NULL DEFAULT '0',
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `date` decimal(21,0) NOT NULL DEFAULT '0',
  `remarks` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`cbid`),
  KEY `FK_callback_1` (`custid`),
  KEY `FK_callback_2` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `calls`
--

CREATE TABLE IF NOT EXISTS `calls` (
  `callid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `custid` int(10) unsigned NOT NULL DEFAULT '0',
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `date` decimal(21,0) NOT NULL DEFAULT '0',
  `feedback` varchar(500) NOT NULL DEFAULT '',
  `remarks` varchar(500) NOT NULL DEFAULT '',
  PRIMARY KEY (`callid`),
  KEY `FK_calls_1` (`custid`),
  KEY `FK_calls_2` (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `calls`
--

INSERT INTO `calls` (`callid`, `custid`, `uid`, `date`, `feedback`, `remarks`) VALUES
(10, 1, 3, '1437090532', 'ok', 'ok'),
(11, 2, 2, '1437090706', 'jhj', 'kjhk hjkl'),
(12, 2, 1, '1437090734', 'ok', 'kjjk');

-- --------------------------------------------------------

--
-- Stand-in structure for view `callsview`
--
CREATE TABLE IF NOT EXISTS `callsview` (
`company` varchar(100)
,`name` varchar(45)
,`date` decimal(21,0)
,`feedback` varchar(500)
,`remarks` varchar(500)
,`uid` int(10) unsigned
);
-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `custid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  `company` varchar(100) NOT NULL DEFAULT '',
  `address` varchar(200) DEFAULT NULL,
  `tel` varchar(40) NOT NULL DEFAULT '',
  `email` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`custid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`custid`, `name`, `company`, `address`, `tel`, `email`) VALUES
(1, 'Charith', 'United Pharma', 'Galle', '0912289265', 'upgalle@gmail.com'),
(2, 'shamika', 'Lakmini group', 'Matara', '0412228002', 'lakmini@gmail.com'),
(3, 'Ranaweera', 'Ranaweera Concrete', 'Akuressa', '0412378383', 'ranaweera@gmail.com'),
(4, 'Dr dayal', 'Weda mashura', 'Matara', '0412378321', 'wed@gmail.com'),
(5, 'madhura', 'Madhura studio', 'Makandura', '0413578209', 'madhura@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

CREATE TABLE IF NOT EXISTS `person` (
  `UID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL DEFAULT '',
  `tel` varchar(45) NOT NULL DEFAULT '',
  `hash` varchar(300) NOT NULL DEFAULT '',
  `type` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`UID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`UID`, `name`, `tel`, `hash`, `type`) VALUES
(1, 'lahiru', '0784547749', '03cbc0b0066ebe0e98ac9772fd409c208cba12cd543315bc950e597af472434e', 0),
(2, 'viraj', '0771728909', 'f94d171641c69a40191257716f8e49a665d0627dddcb6622e50929c984b35f19', 0),
(3, 'akila', '077290021', 'b7d4f755da6e89e11b5a1304b28ae4a21bb8ca8daad0db28338f0c2cd78893d0', 2);

-- --------------------------------------------------------

--
-- Table structure for table `works`
--

CREATE TABLE IF NOT EXISTS `works` (
  `wid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `custid` int(10) unsigned NOT NULL DEFAULT '0',
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `description` varchar(500) NOT NULL DEFAULT '',
  `sdate` decimal(21,0) NOT NULL DEFAULT '0',
  `timeline` decimal(21,0) DEFAULT NULL,
  `technical` int(10) unsigned NOT NULL DEFAULT '0',
  `progress` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`wid`),
  KEY `FK_works_1` (`custid`),
  KEY `FK_works_3` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure for view `callsview`
--
DROP TABLE IF EXISTS `callsview`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `callsview` AS select distinct `customer`.`company` AS `company`,`person`.`name` AS `name`,`calls`.`date` AS `date`,`calls`.`feedback` AS `feedback`,`calls`.`remarks` AS `remarks`,`person`.`UID` AS `uid` from ((`calls` join `customer` on((`calls`.`custid` = `customer`.`custid`))) join `person` on((`calls`.`uid` = `person`.`UID`)));

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `FK_appointment_1` FOREIGN KEY (`custid`) REFERENCES `customer` (`custid`),
  ADD CONSTRAINT `FK_appointment_2` FOREIGN KEY (`uid`) REFERENCES `person` (`UID`),
  ADD CONSTRAINT `FK_appointment_3` FOREIGN KEY (`partner`) REFERENCES `person` (`UID`);

--
-- Constraints for table `callback`
--
ALTER TABLE `callback`
  ADD CONSTRAINT `FK_callback_1` FOREIGN KEY (`custid`) REFERENCES `customer` (`custid`),
  ADD CONSTRAINT `FK_callback_2` FOREIGN KEY (`uid`) REFERENCES `person` (`UID`);

--
-- Constraints for table `calls`
--
ALTER TABLE `calls`
  ADD CONSTRAINT `FK_calls_1` FOREIGN KEY (`custid`) REFERENCES `customer` (`custid`),
  ADD CONSTRAINT `FK_calls_2` FOREIGN KEY (`uid`) REFERENCES `person` (`UID`);

--
-- Constraints for table `works`
--
ALTER TABLE `works`
  ADD CONSTRAINT `FK_works_1` FOREIGN KEY (`custid`) REFERENCES `customer` (`custid`),
  ADD CONSTRAINT `FK_works_2` FOREIGN KEY (`uid`) REFERENCES `person` (`UID`),
  ADD CONSTRAINT `FK_works_3` FOREIGN KEY (`uid`) REFERENCES `person` (`UID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
