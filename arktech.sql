-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 19, 2025 at 05:46 AM
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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_adminlogin`
--

INSERT INTO `tbl_adminlogin` (`login_id`, `username`, `password`) VALUES
(1, 'admin', 'admin'),
(2, 'ash', 'admin');

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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_architects`
--

INSERT INTO `tbl_architects` (`cust_id`, `architect_id`, `arch_name`, `about`, `profiles`, `email`, `phone`, `username`, `passwords`, `certificate_of_licensce`, `arch_locations`, `status`, `plan_id`, `renewaldate`) VALUES
(1, 1, 'Ashin Aji', 'I am a house designer and planner.', 'testimonial-2.jpg', 'michaelshadow02@gmail.com', 9447820276, 'ashinaji', '123', 'my image.jpg', 'Vazhakulam', 'Accepted', 1, '2026-10-10'),
(2, 2, 'Michael Shanto', 'Passionate and detail-oriented architect dedicated to designing functional, aesthetic, and sustainable spaces. Skilled in turning creative ideas into practical designs that meet client needs and enhance everyday living.', 'team-3.jpg', 'michaelshadow02@gmail.com', 9447820276, 'michael', 'michael12', 'Screenshot 2025-10-15 165451.png', 'Vannappuram', 'Accepted', 2, '2025-11-16'),
(3, 3, 'Amal Binoy', 'I am a renowned architect', 'Screenshot 2025-08-20 210618.png', 'amal@santhigiricollege.com', 9847870035, 'amal', '123', 'Screenshot 2025-10-05 162603.png', 'Aarakuzha', 'Accepted', 1, '2026-10-16');

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
(1, 'Ashin Aji', 'Kanjiramkunnel', 'michaelshadow02@gmail.com', '9447820276', 'ashin', 'Ashin@123', 'Vazhakulam', 'testimonial-2.jpg'),
(2, 'Michael Shanto', 'Vamattathil', 'michaelshadow02@gmail.com', '9447820276', 'michael', 'michael123', 'Vannappuram', 'team-3.jpg'),
(3, 'Amal Binoy', 'Vamattathil', 'amal@santhigiricollege.com', '09847870035', 'amal', 'amal123', 'Aarakuzha', 'IMG_0194.JPG');

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
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_messages`
--

INSERT INTO `tbl_messages` (`msg_id`, `user_id`, `architect_id`, `sender`, `message`, `free_time`, `created_at`) VALUES
(1, 1, 1, 'customer', 'I am interested in your work... Can you provide me your contact details?', '', '2025-10-03 17:11:39'),
(2, 1, 1, 'architect', 'Hello,\nYou can contact me at:\n📞 9447820276\n📧 michaelshadow02@gmail.com', '', '2025-10-03 17:14:05'),
(3, 1, 1, 'customer', 'Thanks....I will contact you soon', '', '2025-10-03 17:14:52'),
(4, 1, 1, 'customer', 'I am interested in your work... Can you provide me your contact details?', '', '2025-10-06 10:37:23'),
(5, 1, 1, 'architect', 'Hello,\nYou can contact me at:\n📞 9447820276\n📧 michaelshadow02@gmail.com', '', '2025-10-06 10:37:54'),
(6, 3, 1, 'customer', 'I am interested in your work... Can you provide me your contact details?', '', '2025-10-16 09:50:08'),
(7, 3, 1, 'architect', 'Hello,\nYou can contact me at:\n📞 9447820276\n📧 michaelshadow02@gmail.com', '', '2025-10-16 09:50:51'),
(8, 3, 1, 'architect', 'I will contact you soon', '', '2025-10-16 09:51:06'),
(9, 3, 1, 'customer', 'Okei', '', '2025-10-16 09:51:31'),
(10, 1, 1, 'customer', 'hi', '', '2025-11-13 16:00:33');

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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_previous_works`
--

INSERT INTO `tbl_previous_works` (`prev_work_id`, `architect_id`, `title`, `descriptions`, `category_id`, `project_location`, `image1`, `image2`, `image3`, `created_at`) VALUES
(1, 2, 'Chinnas Auditorium', 'This project features a contemporary auditorium layout with advanced acoustic treatment, efficient seating arrangements, and natural ventilation. The design incorporates modern architectural elements and eco-friendly materials to create a versatile space suitable for large gatherings and stage performances. The auditorium’s spatial planning ensures excellent visibility and comfort for every audience member, while the façade design reflects a blend of modern aesthetics and structural balance. Thoughtful lighting integration and material selection contribute to an inviting atmosphere that enhances both performance quality and audience experience. Overall, Chinna’s Auditorium stands as a functional, sustainable, and visually appealing landmark that embodies creativity and practicality in architectural design.', 4, 'Koothattukulam', 'chinnas auditorium 3.jpg', 'chinnas auditorium 2.jpg', 'chinnas auditorium 1.jpg', '2025-10-16'),
(2, 1, 'Home Design and Plans', 'This project focuses on creating innovative and functional residential designs that blend modern aesthetics with practical living solutions. Each plan is thoughtfully developed to maximize space utilization, natural lighting, and ventilation while maintaining visual harmony throughout the layout.\r\n\r\nThe design process emphasizes comfort, sustainability, and adaptability to different family needs and plot dimensions. By integrating open-plan living areas, modular kitchen concepts, and multi-purpose spaces, the project aims to enhance both lifestyle and convenience.', 1, 'Attukal', 'Architecture 1.jpg', 'Architecture 2.jpg', 'Architecture 3.jpg', '2025-10-16'),
(3, 3, 'Auditorium Interior works', 'A well planned interior with 3000 people at a times', 1, 'Muvattupuzha', 'chinnas auditorium 1.jpg', 'chinnas auditorium 2.jpg', 'chinnas auditorium 1.jpg', '2025-10-16');

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
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_subscriptionplan`
--

INSERT INTO `tbl_subscriptionplan` (`payid`, `plan_id`, `architect_id`, `status`, `amount`, `renewaldate`, `regdate`) VALUES
(14, 1, 1, 'Paid', 600, '2025-10-14', '2025-10-10'),
(16, 2, 2, 'Paid', 100, '2025-11-16', '2025-10-16'),
(17, 1, 3, 'Paid', 600, '2026-10-16', '2025-10-16');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
