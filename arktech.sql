-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 15, 2025 at 10:12 AM
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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_architects`
--

INSERT INTO `tbl_architects` (`architect_id`, `arch_name`, `profiles`, `email`, `phone`, `username`, `passwords`, `certificate_of_licensce`, `location_id`, `status`) VALUES
(2, 'Ashish', 'testimonials-4.jpg', 'amen12@gmail.com', 9447820276, 'architect', '1', 'branding-3.jpg', 0, 'Accepted'),
(3, 'Amen', 'testimonials-5.jpg', 'amen12@gmail.com', 9447820276, 'amen12', '123', 'app-2.jpg', 7, 'Rejected'),
(4, 'Rejo Joseph', 'testimonials-4.jpg', 'rejojosephv@gmail.com', 9947948925, 'rejo', 'rejo', 'books-2.jpg', 7, 'Accepted'),
(5, 'Ashok', 'mj___photograph_y-20240118-0004.jpg', 'ashokkj@gmail.com', 9447820275, 'Ashok', '1', 'portfolio_pic1.jpg', 3, 'Accepted');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_booking`
--

DROP TABLE IF EXISTS `tbl_booking`;
CREATE TABLE IF NOT EXISTS `tbl_booking` (
  `work_id` int NOT NULL AUTO_INCREMENT,
  `customer_id` int NOT NULL,
  `architect_id` int NOT NULL,
  `description` mediumtext NOT NULL,
  `created` date NOT NULL,
  PRIMARY KEY (`work_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

DROP TABLE IF EXISTS `tbl_category`;
CREATE TABLE IF NOT EXISTS `tbl_category` (
  `category_id` int NOT NULL AUTO_INCREMENT,
  `category_name` varchar(50) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`category_id`, `category_name`) VALUES
(1, 'Architecture'),
(2, 'Landscape Design'),
(3, 'House Planning'),
(4, 'Interior design'),
(5, 'Renovation'),
(6, 'Construction');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

DROP TABLE IF EXISTS `tbl_customer`;
CREATE TABLE IF NOT EXISTS `tbl_customer` (
  `customer_id` int NOT NULL AUTO_INCREMENT,
  `cname` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `addres` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `username` varchar(50) NOT NULL,
  `passwords` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `locations` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `cprofile` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`customer_id`, `cname`, `addres`, `email`, `phone`, `username`, `passwords`, `locations`, `cprofile`) VALUES
(1, '', '', 'ashin@gmail.com', '0', 'ashin', 'ashin', '0', ''),
(2, '', '', 'alenjohn@gmail.com', '0', 'alen', 'alen', '0', ''),
(3, 'Ashok', 'Thuruthipillil', 'ashokkj@gmail.com', '9447820275', 'ashok', 'ashok', 'Muvattupuzha', 'IMG_20250827_162409691_HDR_PORTRAIT.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_district`
--

DROP TABLE IF EXISTS `tbl_district`;
CREATE TABLE IF NOT EXISTS `tbl_district` (
  `district_id` int NOT NULL AUTO_INCREMENT,
  `district_name` varchar(30) NOT NULL,
  UNIQUE KEY `district_id` (`district_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_district`
--

INSERT INTO `tbl_district` (`district_id`, `district_name`) VALUES
(1, 'Thiruvananthapuram'),
(2, 'Kollam'),
(3, 'Pathanamthitta'),
(4, 'Alappuzha'),
(5, 'Kottayam'),
(6, 'Idukki'),
(7, 'Ernakulam'),
(8, 'Thrissur'),
(9, 'Palakkad'),
(10, 'Malappuram'),
(11, 'Kozhikode'),
(12, 'Wayanad'),
(13, 'Kannur'),
(14, 'Kasaragod');

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
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_location`
--

INSERT INTO `tbl_location` (`location_id`, `location_name`, `district_id`) VALUES
(1, 'Padmanabhaswamy Temple', 1),
(2, 'Kovalam Beach', 1),
(3, 'Shanghumukham Beach', 1),
(4, 'Napier Museum', 1),
(5, 'Kuthiramalika Palace', 1),
(6, 'Kanakakunnu Palace', 1),
(7, 'Poovar Island', 1),
(8, 'Veli Tourist Village', 1),
(9, 'Neyyar Dam & Wildlife Sanctuary', 1),
(10, 'Agasthyakoodam', 1),
(11, 'Ashtamudi Lake', 2),
(12, 'Kollam Beach', 2),
(13, 'Thangassery Lighthouse', 2),
(14, 'Palaruvi Waterfalls', 2),
(15, 'Jatayu Earth’s Center', 2),
(16, 'Thenmala Eco-Tourism', 2),
(17, 'Munroe Island', 2),
(18, 'Kottarakkara Ganapathy Temple', 2),
(19, 'Rameshwara Temple', 2),
(20, 'Sasthamkotta Lake', 2),
(21, 'Sabarimala Temple', 3),
(22, 'Perunthenaruvi Waterfalls', 3),
(23, 'Konni Elephant Training Center', 3),
(24, 'Gavi', 3),
(25, 'Ranni', 0),
(26, 'Pandalam', 3),
(27, 'Konni', 3),
(28, 'Thiruvalla', 3),
(29, 'Chengannur', 3),
(30, 'Kozhencherry', 3),
(31, 'Elanthoor', 3),
(32, 'Ambalappuzha', 4),
(33, 'Chengannur', 4),
(34, 'Cherthala', 4),
(35, 'Haripad', 4),
(36, 'Kayamkulam', 4),
(37, 'Mavelikkara', 4),
(38, 'Karthikappally', 4),
(39, 'Muvattupuzha', 7);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_previous_works`
--

DROP TABLE IF EXISTS `tbl_previous_works`;
CREATE TABLE IF NOT EXISTS `tbl_previous_works` (
  `prev_work_id` int NOT NULL AUTO_INCREMENT,
  `architect_id` int NOT NULL,
  `title` varchar(1000) NOT NULL,
  `descriptions` varchar(10000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `category_id` int NOT NULL,
  `project_location` varchar(500) NOT NULL,
  `image1` varchar(500) NOT NULL,
  `image2` varchar(500) NOT NULL,
  `image3` varchar(500) NOT NULL,
  `created_at` date NOT NULL,
  PRIMARY KEY (`prev_work_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_previous_works`
--

INSERT INTO `tbl_previous_works` (`prev_work_id`, `architect_id`, `title`, `descriptions`, `category_id`, `project_location`, `image1`, `image2`, `image3`, `created_at`) VALUES
(5, 5, 'Office Renovation', 'Office renovation is the process of upgrading, redesigning, or restructuring an existing workplace to improve its functionality, aesthetics, and efficiency. It may involve changes such as modernizing interiors, optimizing layouts, upgrading furniture and fixtures, improving lighting and ventilation, or incorporating new technology. The goal of office renovation is to create a comfortable, productive, and inspiring environment that reflects the company’s culture, supports employee well-being, and leaves a positive impression on clients and visitors.', 1, 'Muvattupuzha', 'mj___photograph_y-20240118-0002.jpg', '1757585441_mj___photograph_y-20240118-0009.jpg', 'mj___photograph_y-20240118-0007.jpg', '2025-09-10'),
(7, 2, 'Construction', 'Best House planning', 2, 'Kattapana', 'app-1.jpg', 'app-2.jpg', 'app-3.jpg', '2025-09-14'),
(8, 2, 'Plantation', 'Best Garden designs', 3, 'Kothamangalam', 'books-3.jpg', 'branding-1.jpg', '1757930194_app-2.jpg', '2025-09-14'),
(11, 5, 'Office Renovation', 'Makes it work friendly environment', 4, 'Muttom', 'app-1.jpg', '1757924238_branding-2.jpg', '1757914468_branding-3.jpg', '2025-09-14'),
(10, 5, 'Modification', 'Best Modifications', 5, 'Madakkathanam', '1757872431_branding-3.jpg', '1757930245_branding-2.jpg', 'books-3.jpg', '2025-09-14');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subscription`
--

DROP TABLE IF EXISTS `tbl_subscription`;
CREATE TABLE IF NOT EXISTS `tbl_subscription` (
  `subscription_id` int NOT NULL AUTO_INCREMENT,
  `plan` int NOT NULL,
  PRIMARY KEY (`subscription_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
