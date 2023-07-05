-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 05, 2023 at 09:22 AM
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
-- Database: `web`
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
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cows`
--

INSERT INTO `cows` (`id`, `name`, `breed`, `gender`, `age`, `dairy`, `weight`, `height`, `color`, `image`) VALUES
(3, 'qwerty', 'asdfg', 'female', 12, 'no', 122, 12, 'dnkmd', 'asset-2-1685325821-1686985819.svg'),
(4, 'Bella', 'Holstein', 'Female', 4, 'Yes', 600, 150, 'Black and White', 'bella.jpg'),
(2, 'DEF', 'Hereford', 'male', 10, 'no', 150, 12, 'black', 'millk-bottle-1687123048.svg'),
(5, 'Max', 'Jersey', 'Male', 2, 'No', 500, 140, 'Brown', 'max.jpg'),
(6, 'Luna', 'Holstein', 'Female', 3, 'Yes', 550, 145, 'Black and White', 'luna.jpg'),
(7, 'Charlie', 'Angus', 'Male', 5, 'No', 700, 160, 'Black', 'charlie.jpg'),
(8, 'Daisy', 'Holstein', 'Female', 4, 'Yes', 600, 150, 'Black and White', 'daisy.jpg'),
(9, 'Rocky', 'Hereford', 'Male', 3, 'No', 600, 155, 'Red and White', 'rocky.jpg'),
(10, 'Molly', 'Holstein', 'Female', 2, 'Yes', 550, 145, 'Black and White', 'molly.jpg'),
(11, 'Cooper', 'Simmental', 'Male', 4, 'No', 650, 158, 'Red and White', 'cooper.jpg'),
(13, 'Oscar', 'Jersey', 'Male', 2, 'No', 500, 140, 'Brown', 'oscar.jpg'),
(14, 'abdvsavh', 'Heifer', 'female', 2, 'yes', 211, 12, 'brown', 'asset-2-1688492581.svg');

-- --------------------------------------------------------

--
-- Table structure for table `feed`
--

DROP TABLE IF EXISTS `feed`;
CREATE TABLE IF NOT EXISTS `feed` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `price` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `feed`
--

INSERT INTO `feed` (`id`, `name`, `quantity`, `price`) VALUES
(1, 'hjahjnbm', 2, '150'),
(2, 'dbkajhj', 21, '2'),
(3, 'hwdhjj', 21, '3'),
(4, 'ejkhkjdn', 21, '3'),
(5, 'dbhm', 56, '2'),
(8, 'bcsjah', 12, '100');

-- --------------------------------------------------------

--
-- Table structure for table `milk`
--

DROP TABLE IF EXISTS `milk`;
CREATE TABLE IF NOT EXISTS `milk` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cow` int DEFAULT NULL,
  `date` date DEFAULT NULL,
  `milk` int DEFAULT NULL,
  `ph` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `milk`
--

INSERT INTO `milk` (`id`, `cow`, `date`, `milk`, `ph`) VALUES
(1, 2, '2023-06-14', 12, 6),
(2, 3, '2023-06-07', 10, 5),
(3, 3, '2023-06-13', 13, 7),
(4, 2, '2023-06-12', 10, 5),
(5, 14, '2023-07-04', 12, 5),
(6, 14, '2023-07-01', 10, 6),
(7, 14, '2023-07-03', 9, 5);

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
  `adminRIghts` varchar(3) DEFAULT NULL,
  `job` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `adminRIghts`, `job`, `image`) VALUES
(4, 'Asad', 'asad@admin.com', 'e10adc3949ba59abbe56e057f20f883e', 'no', 'Admin', 'cool_image-1688118277.jfif'),
(3, 'Burger', 'a@a.com', '25d55ad283aa400af464c76d713c07ad', 'yes', 'Doctor', 'cool_image-1687370780.jfif'),
(5, 'Asad', 'b@b.com', 'e10adc3949ba59abbe56e057f20f883e', 'yes', 'Admin', 'cool_image-1688202081.jfif'),
(7, 'abcde', 'abcde@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'no', 'abc', 'charts-icon-1688502153.svg'),
(8, 'defg', 'dfg@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'no', 'defg', 'charts-icon-1688502153.svg');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
