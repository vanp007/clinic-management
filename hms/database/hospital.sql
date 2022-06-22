-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 22, 2022 at 05:17 AM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hospital`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

DROP TABLE IF EXISTS `tbladmin`;
CREATE TABLE IF NOT EXISTS `tbladmin` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `profile` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`id`, `username`, `password`, `profile`) VALUES
(1, 'grammie', 'grammie', 'gn.jpg'),
(2, 'juma', 'juma@12344', 'gn.jpg'),
(3, 'emmanuel', 'emmanuel', 'gn.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbldoctor`
--

DROP TABLE IF EXISTS `tbldoctor`;
CREATE TABLE IF NOT EXISTS `tbldoctor` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(100) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `country` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL,
  `data_reg` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `profile` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbldoctor`
--

INSERT INTO `tbldoctor` (`id`, `firstname`, `surname`, `username`, `email`, `gender`, `phone`, `country`, `password`, `role`, `data_reg`, `status`, `profile`) VALUES
(1, 'rose', 'damiani', 'rose', 'rose@gmail.com', 'female', '0987654321', 'Tanzania', '827ccb0eea8a706c4c34a16891f84e7b', '1', '2022-06-17 18:31:45', 'Approved', 'doctor.jpg'),
(2, 'aziza', 'software', 'aziza', 'aziza@gmail.com', 'female', '0987654321', 'Tanzania', '827ccb0eea8a706c4c34a16891f84e7b', '2', '2022-06-17 18:57:44', 'Approved', 'receptionist.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tblmed`
--

DROP TABLE IF EXISTS `tblmed`;
CREATE TABLE IF NOT EXISTS `tblmed` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `pid` varchar(255) NOT NULL,
  `lab_results` text NOT NULL,
  `medicines` text NOT NULL,
  `date_reg` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblmed`
--

INSERT INTO `tblmed` (`id`, `pid`, `lab_results`, `medicines`, `date_reg`) VALUES
(1, 'MVD-2', 'malaria, typhod', 'malafini, panadol, ampicloxa', '2022-06-17 20:00:58');

-- --------------------------------------------------------

--
-- Table structure for table `tblpatient`
--

DROP TABLE IF EXISTS `tblpatient`;
CREATE TABLE IF NOT EXISTS `tblpatient` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `pid` varchar(255) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `age` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `date_reg` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblpatient`
--

INSERT INTO `tblpatient` (`id`, `pid`, `firstname`, `surname`, `age`, `email`, `gender`, `phone`, `country`, `date_reg`, `address`) VALUES
(1, 'MVD-1', 'anna', 'massawe', '13', 'anna@gmail.com', 'female', '0987654321', 'Tanzania', '2022-06-17 19:58:34', 'dodoma'),
(2, 'MVD-2', 'raphael', 'mwaisemba', '24', 'raphael@gmail.com', 'male', '0987654321', 'Tanzania', '2022-06-17 19:59:47', 'mbezi');

-- --------------------------------------------------------

--
-- Table structure for table `tblreport`
--

DROP TABLE IF EXISTS `tblreport`;
CREATE TABLE IF NOT EXISTS `tblreport` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `message` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `date_send` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
