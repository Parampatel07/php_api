-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 30, 2024 at 05:55 AM
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
-- Database: `event_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(126) NOT NULL,
  `email` varchar(126) NOT NULL,
  `password` varchar(126) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`) VALUES
(1, 'param', 'param@gmail.com', '987987');

-- --------------------------------------------------------

--
-- Table structure for table `catering_service`
--

DROP TABLE IF EXISTS `catering_service`;
CREATE TABLE IF NOT EXISTS `catering_service` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(56) NOT NULL,
  `description` text NOT NULL,
  `price` int NOT NULL,
  `photo` varchar(126) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `catering_service`
--

INSERT INTO `catering_service` (`id`, `name`, `description`, `price`, `photo`) VALUES
(1, 'Name', 'Description', 0, 'photo12.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(126) NOT NULL,
  `email` varchar(126) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `password` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `name`, `email`, `mobile`, `password`) VALUES
(1, 'Name', 'Email@gmail.com', '9874563210', '123123');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

DROP TABLE IF EXISTS `event`;
CREATE TABLE IF NOT EXISTS `event` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(56) NOT NULL,
  `type` varchar(56) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `venue` varchar(56) NOT NULL,
  `budget` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id`, `name`, `type`, `start_date`, `end_date`, `venue`, `budget`) VALUES
(1, 'Name', 'Type', '2000-10-20', '2002-04-20', 'Venue', 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `eventid` int NOT NULL,
  `themeid` int NOT NULL,
  `customerid` int NOT NULL,
  `orderstatus` int NOT NULL COMMENT '0 = pending , 1 = confirmed',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `eventid`, `themeid`, `customerid`, `orderstatus`) VALUES
(1, 1, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `rating_review`
--

DROP TABLE IF EXISTS `rating_review`;
CREATE TABLE IF NOT EXISTS `rating_review` (
  `id` int NOT NULL AUTO_INCREMENT,
  `eventid` int NOT NULL,
  `rating` int NOT NULL,
  `reviews` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `rating_review`
--

INSERT INTO `rating_review` (`id`, `eventid`, `rating`, `reviews`) VALUES
(1, 1, 1, 'Reviews');

-- --------------------------------------------------------

--
-- Table structure for table `theme`
--

DROP TABLE IF EXISTS `theme`;
CREATE TABLE IF NOT EXISTS `theme` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(56) NOT NULL,
  `description` text NOT NULL,
  `minbudget` int NOT NULL,
  `maxbudget` int NOT NULL,
  `photo` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `theme`
--

INSERT INTO `theme` (`id`, `name`, `description`, `minbudget`, `maxbudget`, `photo`) VALUES
(1, 'Name', 'Description', 111, 111, 'photo1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `theme_album`
--

DROP TABLE IF EXISTS `theme_album`;
CREATE TABLE IF NOT EXISTS `theme_album` (
  `id` int NOT NULL AUTO_INCREMENT,
  `themeid` int NOT NULL,
  `photo` varchar(256) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `theme_album`
--

INSERT INTO `theme_album` (`id`, `themeid`, `photo`, `description`) VALUES
(1, 1, 'photo1.jpg', 'Description');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
