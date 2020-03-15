-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 15, 2020 at 01:41 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `car_rental`
--
CREATE DATABASE IF NOT EXISTS `car_rental` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `car_rental`;

-- --------------------------------------------------------

--
-- Table structure for table `car`
--

DROP TABLE IF EXISTS `car`;
CREATE TABLE IF NOT EXISTS `car` (
  `carRegNo` int(10) NOT NULL AUTO_INCREMENT,
  `carName` varchar(100) NOT NULL,
  `vendorID` int(10) NOT NULL,
  `carEngNo` int(20) NOT NULL,
  `carPrice` int(5) NOT NULL,
  `carFile` varchar(20) NOT NULL,
  PRIMARY KEY (`carRegNo`),
  KEY `vendorConst` (`vendorID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `car`
--

INSERT INTO `car` (`carRegNo`, `carName`, `vendorID`, `carEngNo`, `carPrice`, `carFile`) VALUES
(1, 'Lamborghini Aventador SVJ', 26, 67875427, 60000, 'lam.jpg'),
(2, 'Ferrari 488 Spider', 55, 4732736, 89000, 'fer.jpg'),
(3, 'McLaren 720S', 55, 47327234, 88000, 'mc.jpg'),
(4, 'Aston Martin Superlegra', 55, 7656445, 890700, 'am.jpg'),
(5, 'Rolls Royce Phantom VIII', 55, 6565654, 789656, 'rr.jpg'),
(6, 'Mazda CX-5', 26, 7636273, 87000, 'mz.jpg'),
(7, 'Ford Mustang', 26, 565564, 87600, 'mg.jpg'),
(8, 'Audi S5', 26, 554628, 80000, 'audi.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `car_rent`
--

DROP TABLE IF EXISTS `car_rent`;
CREATE TABLE IF NOT EXISTS `car_rent` (
  `orderNo` int(10) NOT NULL AUTO_INCREMENT,
  `orderDate` datetime NOT NULL DEFAULT current_timestamp(),
  `orderName` int(100) NOT NULL,
  `carRegNo` int(10) NOT NULL,
  `userID` int(10) NOT NULL,
  PRIMARY KEY (`orderNo`),
  KEY `userConst` (`userID`),
  KEY `carRegConst` (`carRegNo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `userName` varchar(30) NOT NULL,
  `userID` int(10) NOT NULL AUTO_INCREMENT,
  `password` varchar(30) NOT NULL,
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userName`, `userID`, `password`) VALUES
('manav', 1, 'manav');

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

DROP TABLE IF EXISTS `vendor`;
CREATE TABLE IF NOT EXISTS `vendor` (
  `vendorID` int(10) NOT NULL,
  `vendorName` varchar(20) NOT NULL,
  `vendorAddress` varchar(100) NOT NULL,
  PRIMARY KEY (`vendorID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`vendorID`, `vendorName`, `vendorAddress`) VALUES
(26, 'DharaniDharan', 'Flat 42/f,Ramapuram'),
(55, 'Manav', 'Plot no 42, Manapakkam');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `car`
--
ALTER TABLE `car`
  ADD CONSTRAINT `vendorConst` FOREIGN KEY (`vendorID`) REFERENCES `vendor` (`vendorID`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `car_rent`
--
ALTER TABLE `car_rent`
  ADD CONSTRAINT `carRegConst` FOREIGN KEY (`carRegNo`) REFERENCES `car` (`carRegNo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `userConst` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
