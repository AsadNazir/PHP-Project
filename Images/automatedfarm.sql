-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 07, 2023 at 07:22 PM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `automatedfarm`
--

-- --------------------------------------------------------

--
-- Table structure for table `cows`
--

DROP TABLE IF EXISTS `cows`;
CREATE TABLE IF NOT EXISTS `cows` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `breed` varchar(255) DEFAULT NULL,
  `gender` varchar(6) DEFAULT NULL,
  `age` int DEFAULT NULL,
  `dairy` varchar(3) DEFAULT NULL,
  `weight` int DEFAULT NULL,
  `height` int DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cows`
--

INSERT INTO `cows` (`id`, `name`, `breed`, `gender`, `age`, `dairy`, `weight`, `height`, `color`, `image`) VALUES
(1, 'Daisy', 'Holstein', 'Female', 2, 'yes', 200, 6, 'brown', 'asset 2.svg');

-- --------------------------------------------------------

--
-- Table structure for table `diet`
--

DROP TABLE IF EXISTS `diet`;
CREATE TABLE IF NOT EXISTS `diet` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(1024) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `diet_feed`
--

DROP TABLE IF EXISTS `diet_feed`;
CREATE TABLE IF NOT EXISTS `diet_feed` (
  `id` int NOT NULL AUTO_INCREMENT,
  `dietId` int DEFAULT NULL,
  `feedId` int DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `dietId_idx` (`dietId`),
  KEY `feedId_idx` (`feedId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feed`
--

DROP TABLE IF EXISTS `feed`;
CREATE TABLE IF NOT EXISTS `feed` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `price` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `feed`
--

INSERT INTO `feed` (`id`, `name`, `quantity`, `price`) VALUES
(1, 'feed1', 2, 100);

-- --------------------------------------------------------

--
-- Table structure for table `milk`
--

DROP TABLE IF EXISTS `milk`;
CREATE TABLE IF NOT EXISTS `milk` (
  `id` int NOT NULL,
  `cowId` int DEFAULT NULL,
  `date` date DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `ph` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cowId_idx` (`cowId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `milk`
--

INSERT INTO `milk` (`id`, `cowId`, `date`, `quantity`, `ph`) VALUES
(0, 1, '2023-06-08', 12, 5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `adminRights` varchar(3) DEFAULT NULL,
  `job` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `adminRights`, `job`, `image`) VALUES
(1, 'Asad', 'b@b.com', 'e10adc3949ba59abbe56e057f20f883e', 'yes', 'Admin', 'cool_image.jfif');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `diet_feed`
--
ALTER TABLE `diet_feed`
  ADD CONSTRAINT `dietId` FOREIGN KEY (`dietId`) REFERENCES `diet` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `feedId` FOREIGN KEY (`feedId`) REFERENCES `feed` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `milk`
--
ALTER TABLE `milk`
  ADD CONSTRAINT `cowId` FOREIGN KEY (`cowId`) REFERENCES `cows` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
