-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 15, 2025 at 04:43 AM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `arktech`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_adminlogin`
--

DROP TABLE IF EXISTS `tbl_adminlogin`;
CREATE TABLE IF NOT EXISTS `tbl_adminlogin` (
  `login_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`login_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_adminlogin`
--

INSERT INTO `tbl_adminlogin` (`login_id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_architects`
--

DROP TABLE IF EXISTS `tbl_architects`;
CREATE TABLE IF NOT EXISTS `tbl_architects` (
  `architect_id` int NOT NULL AUTO_INCREMENT,
  `arch_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `profiles` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` bigint NOT NULL,
  `username` varchar(20) NOT NULL,
  `passwords` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `certificate_of_licensce` varchar(200) NOT NULL,
  `location_id` int NOT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY (`architect_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_architects`
--

INSERT INTO `tbl_architects` (`architect_id`, `arch_name`, `profiles`, `email`, `phone`, `username`, `passwords`, `certificate_of_licensce`, `location_id`, `status`) VALUES
(2, 'Ashish', 'testimonials-4.jpg', 'alenjohn@gmail.com', 9447820276, 'architect', '1', 'branding-3.jpg', 0, 'Accepted');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

DROP TABLE IF EXISTS `tbl_category`;
CREATE TABLE IF NOT EXISTS `tbl_category` (
  `category_id` int NOT NULL AUTO_INCREMENT,
  `category_name` varchar(50) NOT NULL,
  `photo` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`category_id`, `category_name`, `photo`) VALUES
(13, 'Architecture', 'carousel-1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

DROP TABLE IF EXISTS `tbl_customer`;
CREATE TABLE IF NOT EXISTS `tbl_customer` (
  `customer_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `address` varchar(500) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `passwords` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `location_id` int NOT NULL,
  `profile` varchar(1000) NOT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`customer_id`, `name`, `address`, `email`, `username`, `passwords`, `location_id`, `profile`) VALUES
(1, '', '', 'ashin@gmail.com', 'ashin', 'ashin', 0, ''),
(2, '', '', 'alenjohn@gmail.com', 'alen', 'alen', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_district`
--

DROP TABLE IF EXISTS `tbl_district`;
CREATE TABLE IF NOT EXISTS `tbl_district` (
  `district_id` int NOT NULL AUTO_INCREMENT,
  `district_name` varchar(30) NOT NULL,
  UNIQUE KEY `district_id` (`district_id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_district`
--

INSERT INTO `tbl_district` (`district_id`, `district_name`) VALUES
(17, 'Idukki'),
(4, 'Kasargod'),
(9, 'Ernakulam'),
(15, 'Malappuram');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_location`
--

DROP TABLE IF EXISTS `tbl_location`;
CREATE TABLE IF NOT EXISTS `tbl_location` (
  `location_id` int NOT NULL AUTO_INCREMENT,
  `location_name` varchar(50) NOT NULL,
  `district_id` int NOT NULL,
  PRIMARY KEY (`location_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_location`
--

INSERT INTO `tbl_location` (`location_id`, `location_name`, `district_id`) VALUES
(1, 'Muvattupuzha', 9),
(6, 'Madakkathanam', 9),
(7, 'Thodupuzha', 17);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_previous_works`
--

DROP TABLE IF EXISTS `tbl_previous_works`;
CREATE TABLE IF NOT EXISTS `tbl_previous_works` (
  `prev_work_id` int NOT NULL AUTO_INCREMENT,
  `architect_id` int NOT NULL,
  `title` varchar(1000) NOT NULL,
  `description` varchar(10000) NOT NULL,
  `category_id` int NOT NULL,
  `location_id` int NOT NULL,
  `image1` varchar(500) NOT NULL,
  `image2` varchar(500) NOT NULL,
  `image3` varchar(500) NOT NULL,
  `created_at` date NOT NULL,
  PRIMARY KEY (`prev_work_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
