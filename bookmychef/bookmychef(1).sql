-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 21, 2024 at 04:19 AM
-- Server version: 8.0.27
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookmychef`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(26) NOT NULL,
  `password` varchar(256) NOT NULL,
  `email` varchar(126) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `email`) VALUES
(1, 'param patel', '987987', 'param@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `chef`
--

DROP TABLE IF EXISTS `chef`;
CREATE TABLE IF NOT EXISTS `chef` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cityid` int NOT NULL,
  `email` varchar(126) NOT NULL,
  `password` varchar(256) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `name` varchar(26) NOT NULL,
  `photo` varchar(126) NOT NULL,
  `dob` date NOT NULL,
  `gender` int NOT NULL,
  `cookingtype` int NOT NULL COMMENT '1=vegitable, 2= non vegitable, 3 = both\r\n',
  `rate` int NOT NULL COMMENT 'rate per 4 hour, max 4 person\r\n',
  `bio` varchar(126) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `chef`
--

INSERT INTO `chef` (`id`, `cityid`, `email`, `password`, `mobile`, `name`, `photo`, `dob`, `gender`, `cookingtype`, `rate`, `bio`) VALUES
(3, 1, 'chef@example.com', '123456', '1234567890', 'ChefJohn', 'chef.jpg', '1990-01-01', 0, 1, 50, 'Experienced'),
(2, 1, 'chef@example.com', '123456', '1234567890', 'ChefJohn', 'chef.jpg', '1990-01-01', 0, 1, 50, 'Experienced');

-- --------------------------------------------------------

--
-- Table structure for table `chef_cousine`
--

DROP TABLE IF EXISTS `chef_cousine`;
CREATE TABLE IF NOT EXISTS `chef_cousine` (
  `id` int NOT NULL AUTO_INCREMENT,
  `chefid` int NOT NULL,
  `courseid` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `chef_cousine`
--

INSERT INTO `chef_cousine` (`id`, `chefid`, `courseid`) VALUES
(2, 1, 2),
(3, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

DROP TABLE IF EXISTS `city`;
CREATE TABLE IF NOT EXISTS `city` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`id`, `title`) VALUES
(2, 'New York');

-- --------------------------------------------------------

--
-- Table structure for table `cousine`
--

DROP TABLE IF EXISTS `cousine`;
CREATE TABLE IF NOT EXISTS `cousine` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(126) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cousine`
--

INSERT INTO `cousine` (`id`, `title`) VALUES
(2, 'Italian');

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

DROP TABLE IF EXISTS `service`;
CREATE TABLE IF NOT EXISTS `service` (
  `id` int NOT NULL AUTO_INCREMENT,
  `chefid` int NOT NULL,
  `userid` int NOT NULL,
  `person` varchar(26) NOT NULL,
  `timings` varchar(26) NOT NULL,
  `cookingdate` date NOT NULL,
  `amount` int NOT NULL,
  `paymentstatus` int NOT NULL,
  `orderstatus` int NOT NULL COMMENT '0 = pending , 1 = completed ',
  `remarks` varchar(256) NOT NULL,
  `address1` text NOT NULL,
  `address2` text NOT NULL,
  `cityid` int NOT NULL,
  `review` text NOT NULL,
  `rating` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`id`, `chefid`, `userid`, `person`, `timings`, `cookingdate`, `amount`, `paymentstatus`, `orderstatus`, `remarks`, `address1`, `address2`, `cityid`, `review`, `rating`) VALUES
(2, 1, 1, 'John', '10:00-12:00', '2024-03-09', 100, 1, 1, 'Good', 'Street1', 'Street2', 1, 'Excellent', 5),
(3, 1, 1, 'John', '10:00-12:00', '2024-03-09', 100, 1, 1, 'Good', 'Street1', 'Street2', 1, 'Excellent', 5);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(56) NOT NULL,
  `username` varchar(56) NOT NULL,
  `password` varchar(256) NOT NULL,
  `email` varchar(126) NOT NULL,
  `mobileno` varchar(10) NOT NULL,
  `city` int NOT NULL,
  `address` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `username`, `password`, `email`, `mobileno`, `city`, `address`) VALUES
(1, 'John', 'john123', 'test', 'john@test.com', '1234567890', 2, 'Street1'),
(2, 'John', 'johndoe', '123456', 'johndoe@example.com', '1234567890', 2, '123'),
(3, 'John', 'johndoe', '123456', 'johndoe@example.com', '1234567890', 0, '123'),
(4, 'John', 'johndoe', '123456', 'johndoe@example.com', '1234567890', 3, '123'),
(5, 'John', 'johndoe', '123456', 'johndoe@example.com', '1234567890', 3, '123');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
