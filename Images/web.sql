-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 29, 2023 at 05:59 AM
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
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cows`
--

INSERT INTO `cows` (`id`, `name`, `breed`, `gender`, `age`, `dairy`, `weight`, `height`, `color`, `image`) VALUES
(1, 'xabxjkhk', 'bcshsi', 'female', 21, 'yes', 315, 46, 'giujk', 'asset-2-1685326480.svg'),
(2, 'djkl', 'bdhij', 'female', 12, 'yes', 134, 253, 'vjhkh', 'millk-bottle-1685326630.svg'),
(3, 'Coww', 'Heilstein', 'female', 12, 'yes', 122, 5, 'brown', 'asset-2-1685326709.svg'),
(4, 'dbjkbdakj', 'fdhkhsk', 'female', 23, 'no', 123, 1, 'dbjkbsk', 'millk-bottle-1685326795.svg'),
(5, 'svdhk', 'bidhi', 'female', 12, 'yes', 132, 21, 'sbjkkj', 'asset-2-1685326965.svg'),
(6, 'xsbuhdkn', 'dhiwij', 'female', 13, 'no', 133, 32, 'nksj', 'asset-2-1685327119.svg'),
(7, 'CSBJKDSKJ', 'GSDJD', 'female', 23, 'no', 365, 45467, 'HDSJL', 'millk-bottle-1685327175.svg'),
(8, 'vjkhik`', 'hoihjo', 'female', 12, 'yes', 124, 12, 'hdj', 'asset-2-1685339453.svg'),
(9, 'chjhjk', 'jkhkjhkj', 'female', 12, 'no', 1324, 12, 'vjkhjn', 'millk-bottle-1685339705.svg'),
(10, 'vjknk', 'bjknjk', 'female', 12, 'no', 1223, 12, 'dbskn', 'millk-bottle-1685339843.svg'),
(11, 'vjnkn', 'bkibnik', 'female', 12, 'yes', 1234354, 23, 'ksjml', 'asset-2-1685339882.svg');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
