-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 21, 2024 at 04:20 AM
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
-- Database: `saloon_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

DROP TABLE IF EXISTS `appointment`;
CREATE TABLE IF NOT EXISTS `appointment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `userid` int NOT NULL,
  `appointment_date` date NOT NULL,
  `appointment_time` time NOT NULL,
  `status` int NOT NULL,
  `serviceid` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`id`, `userid`, `appointment_date`, `appointment_time`, `status`, `serviceid`) VALUES
(1, 1, '2004-10-02', '10:30:00', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(56) NOT NULL,
  `photo` varchar(126) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `photo`) VALUES
(1, 'category1', 'category.png');

-- --------------------------------------------------------

--
-- Table structure for table `chat_message`
--

DROP TABLE IF EXISTS `chat_message`;
CREATE TABLE IF NOT EXISTS `chat_message` (
  `id` int NOT NULL AUTO_INCREMENT,
  `userid` int NOT NULL,
  `content` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `chat_message`
--

INSERT INTO `chat_message` (`id`, `userid`, `content`, `timestamp`) VALUES
(1, 1, 'Hello World2', '2024-03-08 03:56:49');

-- --------------------------------------------------------

--
-- Table structure for table `customer_support_ticket`
--

DROP TABLE IF EXISTS `customer_support_ticket`;
CREATE TABLE IF NOT EXISTS `customer_support_ticket` (
  `id` int NOT NULL AUTO_INCREMENT,
  `userid` int NOT NULL,
  `issue_desc` text NOT NULL,
  `date_submitted` date NOT NULL,
  `status` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customer_support_ticket`
--

INSERT INTO `customer_support_ticket` (`id`, `userid`, `issue_desc`, `date_submitted`, `status`) VALUES
(1, 1, 'Test issue', '2023-02-17', 1);

-- --------------------------------------------------------

--
-- Table structure for table `loyalty_bonus`
--

DROP TABLE IF EXISTS `loyalty_bonus`;
CREATE TABLE IF NOT EXISTS `loyalty_bonus` (
  `id` int NOT NULL AUTO_INCREMENT,
  `userid` int NOT NULL,
  `bonus_point` int NOT NULL,
  `last_redeemed_date` date NOT NULL,
  `status` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `loyalty_bonus`
--

INSERT INTO `loyalty_bonus` (`id`, `userid`, `bonus_point`, `last_redeemed_date`, `status`) VALUES
(1, 1, 100, '2023-02-17', 1),
(3, 1, 100, '2023-02-17', 1);

-- --------------------------------------------------------

--
-- Table structure for table `package`
--

DROP TABLE IF EXISTS `package`;
CREATE TABLE IF NOT EXISTS `package` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(56) NOT NULL,
  `service_included` varchar(256) NOT NULL,
  `price` int NOT NULL,
  `description` text NOT NULL,
  `photo` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `package`
--

INSERT INTO `package` (`id`, `name`, `service_included`, `price`, `description`, `photo`) VALUES
(1, 'package1', 'package service 1 ', 1000, 'this is desc', 'cateogory.png');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(26) NOT NULL,
  `categoryid` int NOT NULL,
  `price` int NOT NULL,
  `description` text NOT NULL,
  `photo` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

DROP TABLE IF EXISTS `service`;
CREATE TABLE IF NOT EXISTS `service` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(56) NOT NULL,
  `photo` varchar(126) NOT NULL,
  `price` int NOT NULL,
  `duration` varchar(56) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tutoiral`
--

DROP TABLE IF EXISTS `tutoiral`;
CREATE TABLE IF NOT EXISTS `tutoiral` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(126) NOT NULL,
  `description` text NOT NULL,
  `video_url` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(56) NOT NULL,
  `password` varchar(256) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `name` varchar(26) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `mobile`, `name`) VALUES
(1, 'user@example.com', 'password', '1234567890', 'User');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
