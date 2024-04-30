DROP TABLE IF EXISTS `worker_admin`;
CREATE TABLE IF NOT EXISTS `worker_admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `worker_booking`
--

DROP TABLE IF EXISTS `worker_booking`;
CREATE TABLE IF NOT EXISTS `worker_booking` (
  `id` int NOT NULL,
  `workerid` int NOT NULL,
  `userid` int NOT NULL,
  `bookingdate` date NOT NULL,
  `servicedate` date NOT NULL,
  `remarks` text NOT NULL,
  `paymentstatus` int NOT NULL,
  `bookingstatus` int NOT NULL,
  `review` varchar(126) NOT NULL,
  `rating` int NOT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `worker_service`
--

DROP TABLE IF EXISTS `worker_service`;
CREATE TABLE IF NOT EXISTS `worker_service` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(56) NOT NULL,
  `photo` varchar(56) NOT NULL,
  `area` varchar(56) NOT NULL,
  `charge` int NOT NULL,
  `duration` varchar(56) NOT NULL,
  PRIMARY KEY (`id`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `worker_user`
--

DROP TABLE IF EXISTS `worker_user`;
CREATE TABLE IF NOT EXISTS `worker_user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(56) NOT NULL,
  `email` varchar(56) NOT NULL,
  `password` varchar(256) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `city` varchar(56) NOT NULL,
  `area` varchar(56) NOT NULL,
  `flat` varchar(56) NOT NULL,
  `pincode` varchar(8) NOT NULL,
  PRIMARY KEY (`id`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `worker_worker`
--

DROP TABLE IF EXISTS `worker_worker`;
CREATE TABLE IF NOT EXISTS `worker_worker` (
  `id` int NOT NULL AUTO_INCREMENT,
  `city` varchar(56) NOT NULL,
  `email` varchar(56) NOT NULL,
  `password` varchar(56) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `name` varchar(56) NOT NULL,
  `photo` varchar(56) NOT NULL,
  `dob` date NOT NULL,
  `gender` int NOT NULL,
  `rate` int NOT NULL,
  `bio` varchar(256) NOT NULL,
  `maritalstatus` int NOT NULL,
  `height` varchar(25) NOT NULL,
  `weight` varchar(25) NOT NULL,
  `habits` varchar(256) NOT NULL,
  `education` varchar(256) NOT NULL,
  `religion` varchar(256) NOT NULL,
  `language` varchar(256) NOT NULL,
  `bankname` varchar(256) NOT NULL,
  `accountholdername` varchar(56) NOT NULL,
  `accountno` varchar(256) NOT NULL,
  `ifsccode` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `worker_worker_service`
--

DROP TABLE IF EXISTS `worker_worker_service`;
CREATE TABLE IF NOT EXISTS `worker_worker_service` (
  `id` int NOT NULL AUTO_INCREMENT,
  `workerid` int NOT NULL,
  `serviceid` int NOT NULL,
  `area` varchar(56) NOT NULL,
  `charge` varchar(56) NOT NULL,
  `duration` varchar(56) NOT NULL,
  `details` text NOT NULL,
  PRIMARY KEY (`id`)
) ;