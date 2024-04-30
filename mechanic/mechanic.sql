-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 21, 2024 at 02:31 AM
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
-- Database: `mechanic`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

DROP TABLE IF EXISTS `administrator`;
CREATE TABLE IF NOT EXISTS `administrator` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(32) DEFAULT NULL,
  `password` varchar(256) DEFAULT NULL,
  `email` varchar(126) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`id`, `username`, `password`, `email`) VALUES
(1, 'admin@example.com', 'admin985', 'admin@example.com');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `id` int NOT NULL AUTO_INCREMENT,
  `userid` int DEFAULT NULL,
  `serviceid` int DEFAULT NULL,
  `cityid` int DEFAULT NULL,
  `price` int DEFAULT NULL,
  `orderid` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `userid`, `serviceid`, `cityid`, `price`, `orderid`) VALUES
(2, 1, 1, 1, 100, 1),
(3, 1, 1, 1, 1010, 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(32) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `photo`) VALUES
(1, 'Category 1 ', 'photo.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

DROP TABLE IF EXISTS `city`;
CREATE TABLE IF NOT EXISTS `city` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(32) DEFAULT NULL,
  `pincode` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`id`, `name`, `pincode`) VALUES
(1, 'Sydney', '20020');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

DROP TABLE IF EXISTS `company`;
CREATE TABLE IF NOT EXISTS `company` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `title`, `logo`) VALUES
(1, 'jhone doe', 'photo.jpg'),
(2, 'jhon doe', 'photo.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `corder`
--

DROP TABLE IF EXISTS `corder`;
CREATE TABLE IF NOT EXISTS `corder` (
  `id` int NOT NULL AUTO_INCREMENT,
  `datetime` datetime DEFAULT CURRENT_TIMESTAMP,
  `address` varchar(255) DEFAULT NULL,
  `paymentstatus` varchar(255) DEFAULT NULL,
  `transactioncode` varchar(255) DEFAULT NULL,
  `utrno` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `corder`
--

INSERT INTO `corder` (`id`, `datetime`, `address`, `paymentstatus`, `transactioncode`, `utrno`) VALUES
(1, '2024-03-12 20:38:04', '123 Main St', 'Paid', 'ABC123a', 'XYZ456');

-- --------------------------------------------------------

--
-- Table structure for table `coupon`
--

DROP TABLE IF EXISTS `coupon`;
CREATE TABLE IF NOT EXISTS `coupon` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(56) DEFAULT NULL,
  `code` varchar(56) DEFAULT NULL,
  `percentage` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `coupon`
--

INSERT INTO `coupon` (`id`, `title`, `code`, `percentage`) VALUES
(1, 'SUMMER202', 'SUM20', 20);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(126) DEFAULT NULL,
  `mobile` varchar(126) DEFAULT NULL,
  `password` varchar(126) DEFAULT NULL,
  `fullname` varchar(126) DEFAULT NULL,
  `gender` tinyint(1) DEFAULT NULL COMMENT '0 = female , 1 - male ',
  `orderid` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `email`, `mobile`, `password`, `fullname`, `gender`, `orderid`) VALUES
(1, 'johndoe@example.com', '1234567890', 'user456', 'John Doe', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `model`
--

DROP TABLE IF EXISTS `model`;
CREATE TABLE IF NOT EXISTS `model` (
  `id` int NOT NULL AUTO_INCREMENT,
  `companyid` int DEFAULT NULL,
  `title` varchar(56) DEFAULT NULL,
  `enginetype` varchar(56) DEFAULT NULL,
  `islive` tinyint(1) DEFAULT '0' COMMENT '0 = islive , 1 = not live ',
  `isdeleted` tinyint(1) DEFAULT '0' COMMENT '0 - not deleted  , 1 = deleted ',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `model`
--

INSERT INTO `model` (`id`, `companyid`, `title`, `enginetype`, `islive`, `isdeleted`) VALUES
(1, 1, 'Model SA', 'Electric', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

DROP TABLE IF EXISTS `service`;
CREATE TABLE IF NOT EXISTS `service` (
  `id` int NOT NULL AUTO_INCREMENT,
  `categoryid` int DEFAULT NULL,
  `title` varchar(32) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `price` int DEFAULT NULL,
  `actualprice` int DEFAULT NULL,
  `serviceduraion` varchar(56) DEFAULT NULL,
  `point1` varchar(56) DEFAULT NULL,
  `point2` varchar(56) DEFAULT NULL,
  `point3` varchar(56) DEFAULT NULL,
  `point4` varchar(56) DEFAULT NULL,
  `point5` varchar(56) DEFAULT NULL,
  `point6` varchar(56) DEFAULT NULL,
  `islive` tinyint(1) DEFAULT '0',
  `isdeleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`id`, `categoryid`, `title`, `photo`, `price`, `actualprice`, `serviceduraion`, `point1`, `point2`, `point3`, `point4`, `point5`, `point6`, `islive`, `isdeleted`) VALUES
(1, 1, 'iPhone Repair', 'iphone_repair.jpg', 100, 1000, '30 minutes', 'Point 1', 'Point 2', 'Point 3', 'Point 4', 'Point 5', 'Point 6', 0, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
