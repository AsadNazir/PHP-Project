-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 10, 2023 at 07:19 PM
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
-- Table structure for table `alert`
--

DROP TABLE IF EXISTS `alert`;
CREATE TABLE IF NOT EXISTS `alert` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cowId` int NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `action` varchar(45) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cowId_idx` (`cowId`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `alert`
--

INSERT INTO `alert` (`id`, `cowId`, `type`, `action`, `description`, `date`) VALUES
(1, 1, 'Milk', 'new', 'Milk quantity is less than 5Liters for cow with id 1', '2023-07-09'),
(2, 1, 'Low Milk Production', 'new', 'Your cow Daisy is not producing milk as expected', '2023-07-09'),
(7, 3, 'Low Milk Production', 'new', 'Your cow Buddy is not producing milk as expected', '2023-07-09'),
(8, 4, 'Low Milk Production', 'new', 'Your cow Luna is not producing milk as expected', '2023-07-09'),
(9, 6, 'Low Milk Production', 'new', 'Your cow Molly is not producing milk as expected', '2023-07-09'),
(10, 1, 'Low Milk Production', 'new', 'Your cow Daisy is not producing milk as expected', '2023-07-10'),
(11, 1, 'Milk', 'new', 'Milk quantity is less than 5Liters for cow with id 1', '2023-07-10'),
(12, 8, 'Milk', 'new', 'Milk quantity is less than 5Liters for cow with id 8', '2023-07-05'),
(13, 3, 'Health', 'new', 'Cow with Id 3 is pregnant', '2023-07-07');

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
  `insemination` varchar(3) DEFAULT NULL,
  `weight` int DEFAULT NULL,
  `height` int DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `price` varchar(45) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cows`
--

INSERT INTO `cows` (`id`, `name`, `breed`, `gender`, `age`, `dairy`, `insemination`, `weight`, `height`, `color`, `price`, `image`) VALUES
(1, 'Daisy', 'Holstein', 'female', 2, 'yes', 'no', 200, 6, 'brown', '100000', 'asset 2.svg'),
(2, 'Daisy', 'Holstein', 'female', 3, 'yes', 'no', 800, 150, 'Black and White', '100000', 'cool_image.jfif'),
(3, 'Buddy', 'Jersey', 'male', 2, 'no', 'no', 600, 140, 'Brown', '100000', 'cool_image.jfif'),
(4, 'Luna', 'Guernsey', 'female', 4, 'yes', 'yes', 700, 145, 'Red and White', '100000', 'cool_image.jfif'),
(5, 'Max', 'Hereford', 'male', 5, 'no', 'no', 900, 160, 'Red', '100000', 'cool_image.jfif'),
(6, 'Molly', 'Angus', 'female', 2, 'yes', 'no', 750, 155, 'Black', '100000', 'cool_image.jfif'),
(7, 'Rocky', 'Limousin', 'male', 4, 'no', 'no', 850, 165, 'Brown', '100000', 'cool_image.jfif'),
(8, 'Lucy', 'Simmental', 'female', 3, 'yes', 'yes', 780, 152, 'Yellow and White', '100000', 'cool_image.jfif'),
(9, 'Charlie', 'Charolais', 'male', 2, 'no', 'no', 620, 145, 'White', '100000', 'cool_image.jfif'),
(11, 'Oscar', 'Galloway', 'male', 3, 'no', 'no', 820, 155, 'Black', '100000', 'cool_image.jfif'),
(12, 'seekh', 'asa', 'female', 18, 'yes', 'no', 120, 12, 'Black', '100000', 'milk-icon-1688942272.svg'),
(13, 'abcd', 'Holstein', 'female', 2, 'yes', 'no', 122, 21, 'white', '200000', 'charts-icon-1689004270.svg');

-- --------------------------------------------------------

--
-- Table structure for table `cow_diet`
--

DROP TABLE IF EXISTS `cow_diet`;
CREATE TABLE IF NOT EXISTS `cow_diet` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cowId` int DEFAULT NULL,
  `dietId` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cow_id_idx` (`cowId`),
  KEY `diet_id_idx` (`dietId`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cow_diet`
--

INSERT INTO `cow_diet` (`id`, `cowId`, `dietId`) VALUES
(5, 4, 3),
(6, 5, 8),
(7, 3, 8),
(8, 1, 8),
(9, 2, 6),
(10, 7, 2),
(11, 8, 8),
(12, 6, 2),
(13, 9, 8),
(14, 11, 8);

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `diet`
--

INSERT INTO `diet` (`id`, `name`, `description`) VALUES
(2, 'Plan B', 'This is very special plan never will reveal its secret'),
(3, 'Plan C', 'This is very special plan never will reveal its secret'),
(4, 'Plan D', 'This is very special plan never will reveal its secret'),
(6, 'Plan F', 'This is very special plan never will reveal its secret'),
(8, 'Plan H', '12'),
(9, 'Plan I', '121212121'),
(10, 'Plan J', 'lorem'),
(11, 'Plan K', 'lorem'),
(12, 'Plan L', 'lorem');

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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `diet_feed`
--

INSERT INTO `diet_feed` (`id`, `dietId`, `feedId`, `quantity`) VALUES
(2, 2, 1, 1),
(4, 3, 1, 1),
(6, 4, 1, 1),
(10, 6, 1, 12),
(12, 8, 3, 12),
(13, 9, 1, 1),
(14, 9, 3, 1),
(15, 11, 1, 100),
(16, 12, 1, 69),
(17, 12, 3, 69);

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `feed`
--

INSERT INTO `feed` (`id`, `name`, `quantity`, `price`) VALUES
(1, 'feed190', 10, 100),
(3, '121', 10, 1212);

-- --------------------------------------------------------

--
-- Table structure for table `medical`
--

DROP TABLE IF EXISTS `medical`;
CREATE TABLE IF NOT EXISTS `medical` (
  `id` int NOT NULL AUTO_INCREMENT,
  `description` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `cow_id` int DEFAULT NULL,
  `condition` varchar(45) DEFAULT NULL,
  `temperature` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cow_id_idx` (`cow_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `medical`
--

INSERT INTO `medical` (`id`, `description`, `date`, `cow_id`, `condition`, `temperature`) VALUES
(1, 'djsoksol', '2023-07-07', 4, 'healthy', 21),
(2, 'jsdalajdlsamldmldhfiaih', '2023-07-07', 3, 'pregnant', 12);

-- --------------------------------------------------------

--
-- Table structure for table `milk`
--

DROP TABLE IF EXISTS `milk`;
CREATE TABLE IF NOT EXISTS `milk` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cowId` int DEFAULT NULL,
  `date` date DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `ph` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cowId_idx` (`cowId`)
) ENGINE=InnoDB AUTO_INCREMENT=524 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `milk`
--

INSERT INTO `milk` (`id`, `cowId`, `date`, `quantity`, `ph`) VALUES
(1, 1, '2023-06-08', 12, 5),
(2, 9, '2023-07-07', 2, 9),
(3, 8, '2023-07-07', 21, 5),
(4, 7, '2023-07-07', 71, 2),
(5, 6, '2023-07-07', 65, 8),
(6, 5, '2023-07-07', 90, 2),
(7, 4, '2023-07-07', 21, 5),
(8, 3, '2023-07-07', 78, 5),
(9, 2, '2023-07-07', 92, 3),
(10, 1, '2023-07-07', 37, 2),
(12, 9, '2023-07-06', 56, 7),
(13, 8, '2023-07-06', 59, 10),
(14, 7, '2023-07-06', 15, 8),
(15, 6, '2023-07-06', 39, 7),
(16, 5, '2023-07-06', 7, 4),
(17, 4, '2023-07-06', 77, 7),
(18, 3, '2023-07-06', 4, 2),
(19, 2, '2023-07-06', 82, 6),
(20, 1, '2023-07-06', 22, 5),
(22, 9, '2023-07-05', 37, 6),
(23, 8, '2023-07-05', 71, 9),
(24, 7, '2023-07-05', 3, 7),
(25, 6, '2023-07-05', 17, 9),
(26, 5, '2023-07-05', 86, 7),
(27, 4, '2023-07-05', 74, 8),
(28, 3, '2023-07-05', 38, 8),
(29, 2, '2023-07-05', 44, 1),
(30, 1, '2023-07-05', 97, 7),
(32, 9, '2023-07-04', 88, 4),
(33, 8, '2023-07-04', 96, 9),
(34, 7, '2023-07-04', 28, 10),
(35, 6, '2023-07-04', 68, 7),
(36, 5, '2023-07-04', 30, 5),
(37, 4, '2023-07-04', 55, 3),
(38, 3, '2023-07-04', 65, 5),
(39, 2, '2023-07-04', 45, 8),
(40, 1, '2023-07-04', 53, 4),
(42, 9, '2023-07-03', 2, 8),
(43, 8, '2023-07-03', 50, 4),
(44, 7, '2023-07-03', 22, 1),
(45, 6, '2023-07-03', 69, 3),
(46, 5, '2023-07-03', 10, 8),
(47, 4, '2023-07-03', 56, 5),
(48, 3, '2023-07-03', 77, 4),
(49, 2, '2023-07-03', 47, 3),
(50, 1, '2023-07-03', 5, 4),
(52, 9, '2023-07-02', 96, 6),
(53, 8, '2023-07-02', 73, 1),
(54, 7, '2023-07-02', 26, 1),
(55, 6, '2023-07-02', 27, 3),
(56, 5, '2023-07-02', 68, 6),
(57, 4, '2023-07-02', 51, 10),
(58, 3, '2023-07-02', 48, 4),
(59, 2, '2023-07-02', 45, 2),
(60, 1, '2023-07-02', 25, 9),
(62, 9, '2023-07-01', 33, 7),
(63, 8, '2023-07-01', 19, 1),
(64, 7, '2023-07-01', 56, 8),
(65, 6, '2023-07-01', 97, 7),
(66, 5, '2023-07-01', 37, 9),
(67, 4, '2023-07-01', 21, 5),
(68, 3, '2023-07-01', 55, 5),
(69, 2, '2023-07-01', 47, 1),
(70, 1, '2023-07-01', 93, 5),
(72, 9, '2023-06-30', 72, 9),
(73, 8, '2023-06-30', 31, 9),
(74, 7, '2023-06-30', 32, 1),
(75, 6, '2023-06-30', 28, 3),
(76, 5, '2023-06-30', 47, 6),
(77, 4, '2023-06-30', 29, 9),
(78, 3, '2023-06-30', 29, 10),
(79, 2, '2023-06-30', 79, 2),
(80, 1, '2023-06-30', 31, 2),
(82, 9, '2023-06-29', 65, 8),
(83, 8, '2023-06-29', 2, 8),
(84, 7, '2023-06-29', 48, 3),
(85, 6, '2023-06-29', 85, 5),
(86, 5, '2023-06-29', 83, 7),
(87, 4, '2023-06-29', 1, 10),
(88, 3, '2023-06-29', 74, 9),
(89, 2, '2023-06-29', 86, 9),
(90, 1, '2023-06-29', 59, 5),
(92, 9, '2023-06-28', 55, 1),
(93, 8, '2023-06-28', 67, 2),
(94, 7, '2023-06-28', 77, 4),
(95, 6, '2023-06-28', 55, 7),
(96, 5, '2023-06-28', 50, 6),
(97, 4, '2023-06-28', 49, 7),
(98, 3, '2023-06-28', 81, 1),
(99, 2, '2023-06-28', 85, 1),
(100, 1, '2023-06-28', 90, 3),
(102, 9, '2023-06-27', 2, 4),
(103, 8, '2023-06-27', 88, 3),
(104, 7, '2023-06-27', 53, 10),
(105, 6, '2023-06-27', 5, 5),
(106, 5, '2023-06-27', 19, 6),
(107, 4, '2023-06-27', 3, 6),
(108, 3, '2023-06-27', 91, 8),
(109, 2, '2023-06-27', 90, 4),
(110, 1, '2023-06-27', 98, 9),
(112, 9, '2023-06-26', 75, 3),
(113, 8, '2023-06-26', 4, 5),
(114, 7, '2023-06-26', 100, 7),
(115, 6, '2023-06-26', 51, 5),
(116, 5, '2023-06-26', 64, 9),
(117, 4, '2023-06-26', 51, 9),
(118, 3, '2023-06-26', 97, 2),
(119, 2, '2023-06-26', 70, 2),
(120, 1, '2023-06-26', 50, 2),
(122, 9, '2023-06-25', 90, 4),
(123, 8, '2023-06-25', 89, 5),
(124, 7, '2023-06-25', 75, 4),
(125, 6, '2023-06-25', 28, 5),
(126, 5, '2023-06-25', 50, 1),
(127, 4, '2023-06-25', 100, 7),
(128, 3, '2023-06-25', 45, 2),
(129, 2, '2023-06-25', 40, 6),
(130, 1, '2023-06-25', 55, 1),
(132, 9, '2023-06-24', 17, 10),
(133, 8, '2023-06-24', 46, 4),
(134, 7, '2023-06-24', 21, 1),
(135, 6, '2023-06-24', 88, 1),
(136, 5, '2023-06-24', 69, 3),
(137, 4, '2023-06-24', 10, 8),
(138, 3, '2023-06-24', 63, 8),
(139, 2, '2023-06-24', 5, 9),
(140, 1, '2023-06-24', 22, 5),
(142, 9, '2023-06-23', 17, 10),
(143, 8, '2023-06-23', 41, 2),
(144, 7, '2023-06-23', 29, 2),
(145, 6, '2023-06-23', 75, 4),
(146, 5, '2023-06-23', 57, 8),
(147, 4, '2023-06-23', 4, 10),
(148, 3, '2023-06-23', 59, 1),
(149, 2, '2023-06-23', 74, 4),
(150, 1, '2023-06-23', 74, 6),
(152, 9, '2023-06-22', 7, 7),
(153, 8, '2023-06-22', 9, 5),
(154, 7, '2023-06-22', 10, 1),
(155, 6, '2023-06-22', 96, 7),
(156, 5, '2023-06-22', 36, 9),
(157, 4, '2023-06-22', 8, 10),
(158, 3, '2023-06-22', 29, 8),
(159, 2, '2023-06-22', 74, 6),
(160, 1, '2023-06-22', 43, 6),
(162, 9, '2023-06-21', 36, 3),
(163, 8, '2023-06-21', 94, 1),
(164, 7, '2023-06-21', 49, 3),
(165, 6, '2023-06-21', 86, 5),
(166, 5, '2023-06-21', 87, 9),
(167, 4, '2023-06-21', 67, 8),
(168, 3, '2023-06-21', 88, 1),
(169, 2, '2023-06-21', 57, 8),
(170, 1, '2023-06-21', 93, 5),
(172, 9, '2023-06-20', 58, 6),
(173, 8, '2023-06-20', 22, 4),
(174, 7, '2023-06-20', 95, 8),
(175, 6, '2023-06-20', 92, 4),
(176, 5, '2023-06-20', 92, 6),
(177, 4, '2023-06-20', 21, 3),
(178, 3, '2023-06-20', 62, 4),
(179, 2, '2023-06-20', 88, 4),
(180, 1, '2023-06-20', 4, 2),
(182, 9, '2023-06-19', 76, 5),
(183, 8, '2023-06-19', 21, 6),
(184, 7, '2023-06-19', 16, 1),
(185, 6, '2023-06-19', 3, 9),
(186, 5, '2023-06-19', 17, 3),
(187, 4, '2023-06-19', 96, 10),
(188, 3, '2023-06-19', 70, 8),
(189, 2, '2023-06-19', 53, 5),
(190, 1, '2023-06-19', 70, 2),
(192, 9, '2023-06-18', 54, 4),
(193, 8, '2023-06-18', 99, 10),
(194, 7, '2023-06-18', 1, 1),
(195, 6, '2023-06-18', 17, 8),
(196, 5, '2023-06-18', 14, 5),
(197, 4, '2023-06-18', 8, 9),
(198, 3, '2023-06-18', 20, 4),
(199, 2, '2023-06-18', 4, 3),
(200, 1, '2023-06-18', 93, 1),
(202, 9, '2023-06-17', 100, 2),
(203, 8, '2023-06-17', 93, 1),
(204, 7, '2023-06-17', 52, 5),
(205, 6, '2023-06-17', 47, 2),
(206, 5, '2023-06-17', 24, 8),
(207, 4, '2023-06-17', 21, 7),
(208, 3, '2023-06-17', 73, 7),
(209, 2, '2023-06-17', 97, 10),
(210, 1, '2023-06-17', 85, 4),
(212, 9, '2023-06-16', 99, 8),
(213, 8, '2023-06-16', 2, 7),
(214, 7, '2023-06-16', 41, 10),
(215, 6, '2023-06-16', 56, 10),
(216, 5, '2023-06-16', 100, 2),
(217, 4, '2023-06-16', 94, 2),
(218, 3, '2023-06-16', 82, 8),
(219, 2, '2023-06-16', 15, 6),
(220, 1, '2023-06-16', 31, 9),
(222, 9, '2023-06-15', 72, 8),
(223, 8, '2023-06-15', 57, 6),
(224, 7, '2023-06-15', 24, 5),
(225, 6, '2023-06-15', 43, 9),
(226, 5, '2023-06-15', 94, 2),
(227, 4, '2023-06-15', 91, 1),
(228, 3, '2023-06-15', 75, 5),
(229, 2, '2023-06-15', 9, 1),
(230, 1, '2023-06-15', 89, 4),
(232, 9, '2023-06-14', 7, 3),
(233, 8, '2023-06-14', 22, 3),
(234, 7, '2023-06-14', 54, 10),
(235, 6, '2023-06-14', 24, 3),
(236, 5, '2023-06-14', 65, 5),
(237, 4, '2023-06-14', 14, 5),
(238, 3, '2023-06-14', 83, 8),
(239, 2, '2023-06-14', 40, 7),
(240, 1, '2023-06-14', 10, 5),
(242, 9, '2023-06-13', 6, 7),
(243, 8, '2023-06-13', 12, 7),
(244, 7, '2023-06-13', 82, 2),
(245, 6, '2023-06-13', 48, 9),
(246, 5, '2023-06-13', 61, 6),
(247, 4, '2023-06-13', 19, 2),
(248, 3, '2023-06-13', 9, 1),
(249, 2, '2023-06-13', 4, 10),
(250, 1, '2023-06-13', 85, 3),
(252, 9, '2023-06-12', 40, 9),
(253, 8, '2023-06-12', 28, 8),
(254, 7, '2023-06-12', 77, 7),
(255, 6, '2023-06-12', 96, 9),
(256, 5, '2023-06-12', 25, 8),
(257, 4, '2023-06-12', 13, 4),
(258, 3, '2023-06-12', 14, 8),
(259, 2, '2023-06-12', 43, 9),
(260, 1, '2023-06-12', 90, 10),
(262, 9, '2023-06-11', 42, 5),
(263, 8, '2023-06-11', 77, 7),
(264, 7, '2023-06-11', 83, 3),
(265, 6, '2023-06-11', 86, 5),
(266, 5, '2023-06-11', 72, 3),
(267, 4, '2023-06-11', 92, 10),
(268, 3, '2023-06-11', 94, 9),
(269, 2, '2023-06-11', 63, 5),
(270, 1, '2023-06-11', 46, 9),
(272, 9, '2023-06-10', 74, 7),
(273, 8, '2023-06-10', 8, 4),
(274, 7, '2023-06-10', 75, 6),
(275, 6, '2023-06-10', 51, 9),
(276, 5, '2023-06-10', 88, 8),
(277, 4, '2023-06-10', 7, 2),
(278, 3, '2023-06-10', 43, 8),
(279, 2, '2023-06-10', 43, 10),
(280, 1, '2023-06-10', 29, 7),
(282, 9, '2023-06-09', 3, 10),
(283, 8, '2023-06-09', 46, 6),
(284, 7, '2023-06-09', 46, 6),
(285, 6, '2023-06-09', 58, 2),
(286, 5, '2023-06-09', 85, 9),
(287, 4, '2023-06-09', 80, 4),
(288, 3, '2023-06-09', 57, 7),
(289, 2, '2023-06-09', 51, 7),
(290, 1, '2023-06-09', 52, 8),
(292, 9, '2023-06-08', 48, 2),
(293, 8, '2023-06-08', 55, 2),
(294, 7, '2023-06-08', 5, 9),
(295, 6, '2023-06-08', 100, 6),
(296, 5, '2023-06-08', 53, 2),
(297, 4, '2023-06-08', 8, 10),
(298, 3, '2023-06-08', 65, 4),
(299, 2, '2023-06-08', 67, 4),
(300, 1, '2023-06-08', 74, 7),
(512, 1, '2023-07-10', 2, 10),
(513, 1, '2023-07-10', 2, 10),
(514, 1, '2023-07-09', 1, 5),
(515, 1, '2023-07-09', 1, 5),
(516, 1, '2023-07-09', 1, 10),
(517, 1, '2023-07-08', 7, 10),
(518, 6, '2023-07-08', 9, 10),
(519, 3, '2023-07-08', 7, 10),
(520, 4, '2023-07-08', 8, 10),
(521, 6, '2023-07-08', 10, 9),
(522, 1, '2023-07-10', 2, 5),
(523, 8, '2023-07-05', 2, 2);

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `adminRights`, `job`, `image`) VALUES
(1, 'Asad', 'b@b.com', 'e10adc3949ba59abbe56e057f20f883e', 'yes', 'Admin', 'cool_image-1688942112.jfif'),
(2, 'Asad', 'c@c.com', 'e10adc3949ba59abbe56e057f20f883e', 'no', 'Doctor', 'cool_image-1688817118.jfif'),
(9, 'abcd', 'abcd@gmail.com', '79cfeb94595de33b3326c06ab1c7dbda', 'no', 'uhx', 'asset-2-1688941334.svg'),
(10, 'dfg', 'dfg@gmail.com', '38d7355701b6f3760ee49852904319c1', 'no', 'dwf', 'health-icon-1688941371.svg');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alert`
--
ALTER TABLE `alert`
  ADD CONSTRAINT `alert_cowId` FOREIGN KEY (`cowId`) REFERENCES `cows` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cow_diet`
--
ALTER TABLE `cow_diet`
  ADD CONSTRAINT `cow_id` FOREIGN KEY (`cowId`) REFERENCES `cows` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `diet_id` FOREIGN KEY (`dietId`) REFERENCES `diet` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `diet_feed`
--
ALTER TABLE `diet_feed`
  ADD CONSTRAINT `dietId` FOREIGN KEY (`dietId`) REFERENCES `diet` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `feedId` FOREIGN KEY (`feedId`) REFERENCES `feed` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `medical`
--
ALTER TABLE `medical`
  ADD CONSTRAINT `cow` FOREIGN KEY (`cow_id`) REFERENCES `cows` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `milk`
--
ALTER TABLE `milk`
  ADD CONSTRAINT `cowId` FOREIGN KEY (`cowId`) REFERENCES `cows` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
