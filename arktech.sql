-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 06, 2025 at 08:37 AM
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
  `cust_id` int NOT NULL,
  `architect_id` int NOT NULL AUTO_INCREMENT,
  `arch_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `about` mediumtext NOT NULL,
  `profiles` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` bigint NOT NULL,
  `username` varchar(20) NOT NULL,
  `passwords` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `certificate_of_licensce` varchar(200) NOT NULL,
  `arch_locations` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `status` varchar(20) NOT NULL,
  `plan_id` int NOT NULL,
  `renewaldate` date NOT NULL,
  PRIMARY KEY (`architect_id`),
  UNIQUE KEY `unique_cust_id` (`cust_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_architects`
--

INSERT INTO `tbl_architects` (`cust_id`, `architect_id`, `arch_name`, `about`, `profiles`, `email`, `phone`, `username`, `passwords`, `certificate_of_licensce`, `arch_locations`, `status`, `plan_id`, `renewaldate`) VALUES
(1, 1, 'Ashin Aji', 'I am a house designer and planner.', 'testimonial-2.jpg', 'michaelshadow02@gmail.com', 9447820276, 'ashinaji', '123', 'my image.jpg', 'Vazhakulam', 'Accepted', 1, '2026-10-03');

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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`customer_id`, `cname`, `addres`, `email`, `phone`, `username`, `passwords`, `locations`, `cprofile`) VALUES
(1, 'Ashin Aji', 'Kanjiramkunnel', 'michaelshadow02@gmail.com', '9447820276', 'ashin', 'Ashin@123', 'Vazhakulam', 'testimonial-2.jpg');

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
-- Table structure for table `tbl_messages`
--

DROP TABLE IF EXISTS `tbl_messages`;
CREATE TABLE IF NOT EXISTS `tbl_messages` (
  `msg_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `architect_id` int NOT NULL,
  `sender` enum('customer','architect') NOT NULL,
  `message` text NOT NULL,
  `free_time` varchar(500) NOT NULL,
  `created_at` timestamp NOT NULL,
  PRIMARY KEY (`msg_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_messages`
--

INSERT INTO `tbl_messages` (`msg_id`, `user_id`, `architect_id`, `sender`, `message`, `free_time`, `created_at`) VALUES
(1, 1, 1, 'customer', 'I am interested in your work... Can you provide me your contact details?', '', '2025-10-03 17:11:39'),
(2, 1, 1, 'architect', 'Hello,\nYou can contact me at:\n📞 9447820276\n📧 michaelshadow02@gmail.com', '', '2025-10-03 17:14:05'),
(3, 1, 1, 'customer', 'Thanks....I will contact you soon', '', '2025-10-03 17:14:52');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_plan`
--

DROP TABLE IF EXISTS `tbl_plan`;
CREATE TABLE IF NOT EXISTS `tbl_plan` (
  `plan_id` int NOT NULL AUTO_INCREMENT,
  `plan_name` varchar(100) NOT NULL,
  `amount` int NOT NULL,
  `duration` int NOT NULL,
  PRIMARY KEY (`plan_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_plan`
--

INSERT INTO `tbl_plan` (`plan_id`, `plan_name`, `amount`, `duration`) VALUES
(1, 'yearly', 600, 365),
(2, 'monthly', 100, 31),
(3, 'quarterly', 250, 1);

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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_previous_works`
--

INSERT INTO `tbl_previous_works` (`prev_work_id`, `architect_id`, `title`, `descriptions`, `category_id`, `project_location`, `image1`, `image2`, `image3`, `created_at`) VALUES
(1, 1, 'Auditorium Hall ', 'Recently builded an auditorium which can hold upto 3000 people at a time.', 1, 'Muvattupuzha', 'carousel-1.jpg', 'carousel-3.jpg', 'carousel-2.jpg', '2025-10-03'),
(2, 1, 'adas', 'dadasd', 1, 'Muvattupuzha', 'about-1.jpg', 'house.jpg', 'carousel-2.jpg', '2025-10-05');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subscriptionplan`
--

DROP TABLE IF EXISTS `tbl_subscriptionplan`;
CREATE TABLE IF NOT EXISTS `tbl_subscriptionplan` (
  `payid` int NOT NULL AUTO_INCREMENT,
  `plan_id` int NOT NULL,
  `architect_id` int NOT NULL,
  `status` varchar(30) NOT NULL,
  `amount` int NOT NULL,
  `renewaldate` date NOT NULL,
  `regdate` date NOT NULL,
  PRIMARY KEY (`payid`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_subscriptionplan`
--

INSERT INTO `tbl_subscriptionplan` (`payid`, `plan_id`, `architect_id`, `status`, `amount`, `renewaldate`, `regdate`) VALUES
(11, 1, 1, 'Paid', 600, '2026-10-03', '2025-10-03');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
