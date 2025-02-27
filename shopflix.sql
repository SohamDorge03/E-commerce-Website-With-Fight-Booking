-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 06, 2024 at 04:34 PM
-- Server version: 8.0.18
-- PHP Version: 7.4.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shopflix`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `verify_code` varchar(6) NOT NULL,
  `confirmed_email` tinyint(4) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `username`, `email`, `password`, `verify_code`, `confirmed_email`) VALUES
(3, 'soham', 'soh@gmail.com', '12345678', '', 0),
(9, 'bhargav', 'bhargav123@gmail.com', '12345678', '', 0),
(10, 'yagnesh', 'okyagnesh@gmail.com', '12345678', '', 0),
(13, 'vishal', 'sawvishal2004@gmail.com', '12345678', '195820', 1);

-- --------------------------------------------------------

--
-- Table structure for table `airlines`
--

DROP TABLE IF EXISTS `airlines`;
CREATE TABLE IF NOT EXISTS `airlines` (
  `airline_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(40) NOT NULL,
  `pass` varchar(40) NOT NULL,
  `airline_name` varchar(40) DEFAULT NULL,
  `logo` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`airline_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `airlines`
--

INSERT INTO `airlines` (`airline_id`, `email`, `pass`, `airline_name`, `logo`) VALUES
(1, 'AirAsia333@gmail.com', '123456', 'airasia', './upload/Air Asia.png'),
(3, 'indigo898@gimail.com', '123456', 'indigo', './upload/IndiGo-Logo.png'),
(4, 'qatar@gmail.com', '123456', 'Qatar', './upload/Qatar.png'),
(5, 'visatara@gmail.com', '123456', 'Visatara', './upload/vistara.png'),
(6, 'emirates@gmail.com', '123456', 'Emirates', './upload/Emirates.png'),
(8, 'Airindia23@gmail.com', '123456', 'Airindia', './upload/air india.png'),
(9, 'akasa@gmail.com', '123456', 'akasa', './upload/akasa air.png'),
(10, 'gofirst@gmail.com', '123456', 'go first', './upload/go first.png');

-- --------------------------------------------------------

--
-- Table structure for table `airline_requests`
--

DROP TABLE IF EXISTS `airline_requests`;
CREATE TABLE IF NOT EXISTS `airline_requests` (
  `request_id` int(11) NOT NULL AUTO_INCREMENT,
  `airline_name` varchar(100) NOT NULL,
  `contact_email` varchar(100) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `document` blob,
  `status` enum('Pending','Approved','Rejected') DEFAULT 'Pending',
  `date_requested` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `last_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `confirmed` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`request_id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `airline_requests`
--

INSERT INTO `airline_requests` (`request_id`, `airline_name`, `contact_email`, `logo`, `document`, `status`, `date_requested`, `confirmed`) VALUES
(8, 'Indigo', 'sawvishal2004@gmail.com', 'IndiGo-Logo.png', 0x646235332e6a7067, 'Approved', '2024-03-29 10:51:22', 0),
(5, 'Airindia', 'sohamdorge45@gmail.com', 'air india.png', 0x766973746172612e706e67, 'Approved', '2024-03-29 04:08:22', 0),
(9, 'airasia', 'okyagnesh@gmail.com', 'Air Asia.png', 0x62312e6a7067, 'Approved', '2024-03-29 10:54:10', 0),
(10, 'Visatara', 'vishalsaw952@gmail.com', 'vistara.png', 0x76312e6a7067, 'Approved', '2024-03-29 10:55:58', 0),
(11, 'Emirates', 'okyagnesh@gmail.com', 'Emirates.png', 0x79312e6a7067, 'Pending', '2024-03-29 10:59:09', 0),
(13, 'Spicejet', 'sohamdorge45@gmail.com', 'spicejet.png', 0x74322e6a7067, 'Pending', '2024-03-29 11:01:07', 0),
(14, 'Qatar', 'sawvishal2004@gmail.com', 'Qatar.png', 0x412e706e67, 'Pending', '2024-03-29 11:02:40', 0),
(16, 'Go first', 'sohamdorge45@gmail.com', 'go first.png', 0x676f2066697273742e706e67, 'Pending', '2024-03-29 11:06:21', 0);

-- --------------------------------------------------------

--
-- Table structure for table `airports`
--

DROP TABLE IF EXISTS `airports`;
CREATE TABLE IF NOT EXISTS `airports` (
  `airport_id` int(11) NOT NULL AUTO_INCREMENT,
  `airport_name` varchar(255) NOT NULL,
  `airport_code` char(3) NOT NULL,
  `state` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  PRIMARY KEY (`airport_id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `airports`
--

INSERT INTO `airports` (`airport_id`, `airport_name`, `airport_code`, `state`, `city`, `location`) VALUES
(13, 'Maharana Pratap Airport', 'UDR', 'Rajasthan', 'Udaipur', 'Udaipur'),
(14, 'Chhatrapti shivaji maharaj airport', 'BOM', ' Maharashtra ', 'Mumbai', 'mumbai'),
(15, 'pune airport', 'PUN', 'Maharashtra ', 'pune', 'pune'),
(16, 'Delhi airport', 'DLE', 'Delhi', 'Delhi', 'Delhi'),
(20, 'Rajkot airport', 'RAJ', 'Gujarat', 'Rajkot', 'Rajkot'),
(18, 'Kempegowda International Airport Bengaluru', 'BLA', 'Karnataka ', 'Bengaluru', 'Bengaluru'),
(21, 'Ranchi airport', 'RNC', 'Jharkhand', 'Ranchi', 'Ranchi'),
(22, 'Valmiki AIRPORT', 'VMK', 'Uttar pradesh', 'Yaudheya', 'Uttar pradesh'),
(23, 'Bangalore airport', 'BNG', 'karnataka', 'Bangalore', 'Bangalore'),
(24, 'Chennai airport', 'CHN', 'tamilnadu', 'Chennai', 'tamilnadu'),
(25, 'Sardar Vallabhbhai Patel International Airport', 'AMD', 'Gujrat', 'Ahmedabad', 'Ahmedabad'),
(26, 'Hisar Airport', 'HSS', 'Haryana', 'Hisar', 'Haryana'),
(27, 'Beas Airport', 'ATQ', 'Punjab', 'Amritsar', 'Amritsar'),
(28, 'Goa International Airport', 'GOI', 'Goa', 'Panaji ', 'Panaji');

-- --------------------------------------------------------

--
-- Table structure for table `booked_flights`
--

DROP TABLE IF EXISTS `booked_flights`;
CREATE TABLE IF NOT EXISTS `booked_flights` (
  `booking_id` int(11) NOT NULL AUTO_INCREMENT,
  `flight_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `take_seats` int(11) NOT NULL,
  `flight_class` varchar(40) DEFAULT NULL,
  `airline_id` int(11) DEFAULT NULL,
  `TransactionID` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `total_amount` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `confirmation_status` tinyint(1) DEFAULT NULL,
  `payment_status` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT '0',
  `booked_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`booking_id`),
  KEY `flight_id` (`flight_id`),
  KEY `user_id` (`user_id`),
  KEY `fk_airline_id` (`airline_id`)
) ENGINE=MyISAM AUTO_INCREMENT=66 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `booked_flights`
--

INSERT INTO `booked_flights` (`booking_id`, `flight_id`, `user_id`, `take_seats`, `flight_class`, `airline_id`, `TransactionID`, `total_amount`, `confirmation_status`, `payment_status`, `booked_date`) VALUES
(50, 9, 16, 1, NULL, NULL, NULL, '12000', NULL, '0', '2024-03-28 17:10:12'),
(49, 9, 16, 1, NULL, NULL, NULL, '12000', NULL, '0', '2024-03-28 17:08:54'),
(48, 9, 16, 1, NULL, 1, 'ch_3OzBw8DwlRClWlNg11BXyX9N', '12000', NULL, 'success', '2024-03-28 11:25:00'),
(47, 9, 16, 1, NULL, NULL, NULL, '12000', NULL, '0', '2024-03-28 11:22:17'),
(46, 9, 16, 1, NULL, NULL, 'ch_3OyyvFDwlRClWlNg22a7HfYH', '12000', NULL, 'success', '2024-03-27 21:30:36'),
(45, 9, 16, 1, NULL, NULL, NULL, '12000', NULL, '0', '2024-03-27 21:29:40'),
(44, 9, 16, 1, NULL, NULL, 'ch_3Oyw6WDwlRClWlNg1qCNDMlu', '12000', NULL, 'success', '2024-03-27 18:30:51'),
(37, 7, 21, 1, NULL, NULL, 'ch_3Ox2DMDwlRClWlNg0vyK20DE', '1200', NULL, 'success', '2024-03-22 12:38:11'),
(38, 9, 16, 1, NULL, NULL, NULL, '12000', NULL, '0', '2024-03-24 10:21:11'),
(39, 9, 16, 1, NULL, NULL, 'ch_3Oxj2GDwlRClWlNg1EhaTRHY', '12000', NULL, 'success', '2024-03-24 10:21:28'),
(40, 9, 16, 1, NULL, NULL, 'ch_3Oxj4ODwlRClWlNg21giR9lz', '12000', NULL, 'success', '2024-03-24 10:23:48'),
(41, 9, 16, 1, NULL, NULL, 'ch_3OxjFdDwlRClWlNg0mz03AET', '12000', NULL, 'success', '2024-03-24 10:35:24'),
(42, 9, 16, 1, NULL, NULL, 'ch_3OxjHzDwlRClWlNg1dyo48Ky', '12000', NULL, 'success', '2024-03-24 10:37:46'),
(43, 9, 16, 1, NULL, NULL, 'ch_3OySD9DwlRClWlNg1TnbUnAv', '12000', NULL, 'success', '2024-03-26 10:35:38'),
(51, 9, 16, 1, NULL, 1, 'ch_3OzHKMDwlRClWlNg2uRluSrp', '12000', NULL, 'success', '2024-03-28 17:10:38'),
(52, 11, 16, 1, NULL, 1, 'ch_3OzaIGDwlRClWlNg2wNShgzi', '9000', NULL, 'success', '2024-03-29 13:25:46'),
(53, 65, 17, 1, NULL, 9, 'ch_3OzdaaDwlRClWlNg1JNyofMU', '7867', NULL, 'success', '2024-03-29 16:56:48'),
(54, 7, 22, 1, NULL, 8, 'ch_3OzwcUDwlRClWlNg01Tr3IF8', '1200', NULL, 'success', '2024-03-30 13:16:05'),
(55, 64, 19, 2, NULL, 9, 'ch_3OzwilDwlRClWlNg1mk5dE7b', '17200', NULL, 'success', '2024-03-30 13:21:52'),
(56, 11, 23, 2, NULL, 1, 'ch_3OzwpLDwlRClWlNg2cEwkXrc', '18000', NULL, 'success', '2024-03-30 13:29:23'),
(59, 19, 16, 3, NULL, 3, 'ch_3OzxDuDwlRClWlNg02ZfXiRS', '36000', NULL, 'success', '2024-03-30 13:54:45'),
(58, 17, 21, 6, NULL, 3, 'ch_3Ozx48DwlRClWlNg14G7bexH', '60000', NULL, 'success', '2024-03-30 13:44:15'),
(60, 20, 22, 3, NULL, 3, 'ch_3OzxLrDwlRClWlNg085HVVil', '24000', NULL, 'success', '2024-03-30 14:02:53'),
(61, 18, 22, 1, NULL, 3, 'ch_3OzxPBDwlRClWlNg0SJ295bX', '11000', NULL, 'success', '2024-03-30 14:06:17'),
(62, 107, 16, 1, NULL, 3, 'ch_3OzznMDwlRClWlNg2DVeOOaU', '5200', NULL, 'success', '2024-03-30 16:39:26'),
(63, 5, 16, 1, NULL, 3, 'ch_3OzzyXDwlRClWlNg2JqtD3YW', '4000', NULL, 'success', '2024-03-30 16:50:58'),
(64, 18, 16, 1, NULL, NULL, NULL, '11000', NULL, '0', '2024-03-30 17:18:44'),
(65, 111, 21, 4, NULL, 3, 'ch_3P0IYaDwlRClWlNg0cBJELbt', '19600', NULL, 'success', '2024-03-31 12:41:20');

-- --------------------------------------------------------

--
-- Table structure for table `book_demo`
--

DROP TABLE IF EXISTS `book_demo`;
CREATE TABLE IF NOT EXISTS `book_demo` (
  `demo_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `demo_date` datetime NOT NULL,
  `Application_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY (`demo_id`),
  KEY `user_id` (`user_id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `book_demo`
--

INSERT INTO `book_demo` (`demo_id`, `user_id`, `product_id`, `demo_date`, `Application_date`, `status`) VALUES
(21, 22, 126, '2024-04-12 00:00:00', '2024-03-30 12:21:12', 'Pending'),
(26, 16, 36, '2024-04-04 00:00:00', '2024-04-03 10:47:46', 'Pending'),
(25, 16, 36, '2024-04-04 00:00:00', '2024-04-03 10:46:46', 'Pending'),
(23, 16, 127, '2024-04-04 00:00:00', '2024-04-03 10:28:24', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `cart_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`cart_id`),
  KEY `user_id` (`user_id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=121 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `user_id`, `product_id`, `quantity`) VALUES
(43, 10, 23, 2);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `name`) VALUES
(1, 'GYM'),
(2, 'Furniture '),
(3, 'Electronics'),
(7, 'home appliances ');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

DROP TABLE IF EXISTS `contact_us`;
CREATE TABLE IF NOT EXISTS `contact_us` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `name`, `email`, `description`, `created_at`) VALUES
(1, 'jayesh', 'sohamdorge45@gmail.com', 'jjhj', '2024-04-03 16:17:41');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
CREATE TABLE IF NOT EXISTS `feedback` (
  `feedback_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`feedback_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedback_id`, `email`, `description`) VALUES
(1, 'jay@gmail.com', 'thank you'),
(2, 'chirag@gmail.com', 'Thank you so much for your continued support....'),
(3, 'sohamdorge45@gmail.com', 'your website services are beneficial...! '),
(4, 'sawvishal2004@gmail.com', '\"Your website\'s design is visually appealing, but slow loading times and broken links detract from the user experience. Improving these aspects could enhance overall satisfaction.\"'),
(5, 'patilprasad2824@gmail.com', '\"Your website\'s design is captivating and user-friendly, offering an enjoyable browsing experience\".\r\n'),
(6, 'bhargavtiwari6813@gmail.com', 'Unfortunately,\" navigating your website has been frustrating due to slow loading times\".'),
(7, 'okyagnesh@gmail.com', '\r\n\"Your flight booking section offers a unique blend of convenience and affordability, seamlessly guiding users through the booking process while ensuring access to budget-friendly options. It\'s a refreshing experience to find such a combination, making travel planning both efficient and cost-effective.'),
(8, 'mahesh452@gmail.com', '\r\n\"Your product exceeded my expectations! From its sleek design to its impressive functionality, it\'s clear that a lot of thought went into its development. However, I did encounter a minor issue with [specific feature or aspect], which could be improved for an even better user experience. Overall, though, I\'m highly satisfied with my purchase and would highly recommend it to others.\"'),
(9, 'soh@gmail.com', 'THANKS FOR GOOD EXPERIENCE........');

-- --------------------------------------------------------

--
-- Table structure for table `flights`
--

DROP TABLE IF EXISTS `flights`;
CREATE TABLE IF NOT EXISTS `flights` (
  `flight_id` int(11) NOT NULL AUTO_INCREMENT,
  `flight_code` varchar(40) NOT NULL,
  `source_date` date DEFAULT NULL,
  `source_time` time DEFAULT NULL,
  `dest_date` date DEFAULT NULL,
  `dest_time` time DEFAULT NULL,
  `dep_airport_id` int(11) DEFAULT NULL,
  `arr_airport_id` int(11) DEFAULT NULL,
  `seats` int(11) DEFAULT NULL,
  `flight_class` varchar(255) NOT NULL,
  `price` decimal(12,2) DEFAULT NULL,
  `airline_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`flight_id`),
  KEY `dep_airport_id` (`dep_airport_id`),
  KEY `arr_airport_id` (`arr_airport_id`),
  KEY `fk_airline_id` (`airline_id`)
) ENGINE=MyISAM AUTO_INCREMENT=112 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `flights`
--

INSERT INTO `flights` (`flight_id`, `flight_code`, `source_date`, `source_time`, `dest_date`, `dest_time`, `dep_airport_id`, `arr_airport_id`, `seats`, `flight_class`, `price`, `airline_id`) VALUES
(14, '21444', '2024-04-10', '02:43:00', '2024-04-11', '09:43:00', 15, 14, 99, 'Economy', '7000.00', 1),
(7, '12322', '2024-04-09', '15:17:00', '2024-04-09', '16:17:00', 14, 18, 12, 'Economy', '1200.00', 8),
(5, '56436', '2024-04-12', '18:00:00', '2024-04-12', '21:00:00', 13, 14, 70, 'Economy', '4000.00', 3),
(10, '19044', '2024-04-06', '18:32:00', '2024-04-07', '01:33:00', 22, 26, 100, 'Economy', '7000.00', 1),
(11, '10255', '2024-04-07', '21:37:00', '2024-04-08', '05:37:00', 25, 18, 100, 'Business', '9000.00', 1),
(12, '12533', '2024-04-08', '21:39:00', '2024-04-09', '04:39:00', 27, 16, 99, 'First Class', '10000.00', 1),
(13, '12765', '2024-04-09', '01:40:00', '2024-04-10', '04:40:00', 24, 20, 99, 'Economy', '5000.00', 1),
(15, '19877', '2024-04-12', '15:45:00', '2024-04-13', '20:45:00', 24, 22, 99, 'First Class', '50000.00', 1),
(16, '12988', '2024-04-08', '21:47:00', '2024-04-09', '01:47:00', 20, 16, 100, 'Economy', '11000.00', 3),
(17, '19888', '2024-04-07', '20:50:00', '2024-04-08', '22:50:00', 26, 25, 100, 'Business', '10000.00', 3),
(18, '2970', '2024-04-08', '01:51:00', '2024-04-09', '06:49:00', 20, 22, 100, 'First Class', '11000.00', 3),
(19, '20011', '2024-04-11', '00:53:00', '2024-04-12', '23:53:00', 16, 25, 100, 'First Class', '12000.00', 3),
(20, '19900', '2024-04-08', '22:54:00', '2024-04-09', '20:54:00', 14, 24, 100, 'Economy', '8000.00', 3),
(21, '12090', '2024-04-11', '22:57:00', '2024-04-12', '01:57:00', 20, 24, 100, 'First Class', '2000.00', 4),
(22, '22980', '2024-04-07', '21:58:00', '2024-04-08', '00:58:00', 24, 20, 100, 'First Class', '3000.00', 4),
(23, '20097', '2024-04-12', '21:00:00', '2024-04-13', '00:00:00', 23, 26, 100, 'First Class', '13000.00', 4),
(24, '12090', '2024-04-08', '03:01:00', '2024-04-09', '05:02:00', 23, 14, 100, 'Business', '15000.00', 4),
(25, '13290', '2024-04-09', '22:02:00', '2024-04-10', '05:03:00', 21, 25, 100, 'Business', '19000.00', 4),
(26, '231890', '2024-04-09', '10:04:00', '2024-04-10', '16:04:00', 15, 24, 100, 'First Class', '12000.00', 4),
(27, '12980', '2024-04-11', '00:05:00', '2024-04-12', '11:05:00', 15, 23, 100, 'Economy', '12000.00', 4),
(28, '12433', '2024-04-12', '22:06:00', '2024-04-13', '23:07:00', 22, 16, 100, 'Economy', '3000.00', 4),
(29, '12980', '2024-04-11', '01:08:00', '2024-04-12', '11:08:00', 20, 14, 122, 'Business', '13000.00', 4),
(30, '123101', '2024-04-08', '01:13:00', '2024-04-09', '03:13:00', 24, 16, 100, 'Economy', '20000.00', 8),
(31, '145222', '2024-04-08', '01:14:00', '2024-04-09', '11:14:00', 22, 14, 100, 'Business', '12000.00', 8),
(32, '1233222', '2024-04-09', '10:15:00', '2024-04-10', '04:15:00', 20, 20, 100, 'First Class', '15000.00', 8),
(33, '144111', '2024-04-08', '03:19:00', '2024-04-09', '01:19:00', 23, 16, 100, 'First Class', '12000.00', 8),
(34, '125222', '2024-04-10', '01:20:00', '2024-04-11', '06:25:00', 24, 22, 100, 'Economy', '12000.00', 8),
(35, '123311', '2024-04-09', '00:26:00', '2024-04-10', '22:26:00', 22, 26, 100, 'Business', '4520.00', 8),
(36, '123111', '2024-04-10', '22:27:00', '2024-04-11', '06:27:00', 25, 12, 100, 'First Class', '20000.00', 8),
(37, '123267', '2024-04-11', '00:28:00', '2024-04-12', '09:28:00', 24, 18, 100, 'First Class', '1232.00', 8),
(38, '21311', '2024-04-08', '21:29:00', '2024-04-09', '12:29:00', 21, 12, 100, 'First Class', '12320.00', 8),
(39, '231762', '2024-04-07', '01:30:00', '2024-04-08', '08:30:00', 24, 20, 100, 'Economy', '14000.00', 8),
(40, '123222', '2024-04-08', '20:22:00', '2024-04-09', '00:24:00', 24, 16, 100, 'Economy', '50000.00', 10),
(41, '123111', '2024-04-08', '15:24:00', '2024-04-09', '20:30:00', 16, 24, 100, 'Business', '12320.00', 10),
(42, '123111', '2024-04-08', '01:26:00', '2024-04-09', '11:26:00', 24, 16, 100, 'First Class', '12000.00', 10),
(43, '13244', '2024-04-09', '20:28:00', '2024-04-10', '21:29:00', 22, 16, 100, 'Economy', '15220.00', 10),
(44, '34222', '2024-04-08', '00:31:00', '2024-04-09', '05:31:00', 12, 15, 100, 'Business', '12320.00', 10),
(45, '123222', '2024-04-08', '15:33:00', '2024-04-09', '14:33:00', 21, 12, 100, 'First Class', '8540.00', 10),
(46, '12377', '2024-04-08', '16:34:00', '2024-04-08', '18:34:00', 12, 15, 100, 'Economy', '5002.00', 10),
(47, '43122', '2024-04-08', '01:40:00', '2024-04-08', '14:38:00', 16, 12, 100, 'Economy', '9820.00', 10),
(48, '123876', '2024-04-08', '21:39:00', '2024-04-08', '22:39:00', 13, 25, 100, 'Business', '13200.00', 10),
(49, '13897', '2024-04-09', '07:40:00', '2024-04-10', '12:41:00', 21, 16, 100, 'First Class', '6590.00', 10),
(51, '123222', '2024-04-08', '17:48:00', '2024-04-08', '21:48:00', 25, 20, 100, 'Business', '7620.00', 9),
(52, '254876', '2024-04-08', '01:50:00', '2024-04-09', '14:49:00', 14, 12, 100, 'Business', '7650.00', 9),
(53, '23455', '2024-04-09', '21:50:00', '2024-04-09', '00:54:00', 12, 18, 100, 'Business', '5220.00', 9),
(54, '43987', '2024-04-09', '18:51:00', '2024-04-09', '21:51:00', 27, 12, 100, 'Business', '7654.00', 9),
(55, '2347654', '2024-04-08', '04:52:00', '2024-04-08', '11:53:00', 26, 15, 99, 'Economy', '8655.00', 9),
(56, '652453', '2024-04-08', '03:53:00', '2024-04-08', '21:54:00', 13, 12, 100, 'Economy', '8298.00', 9),
(57, '14309', '2024-04-08', '13:56:00', '2024-04-08', '20:56:00', 23, 12, 100, 'Economy', '6520.00', 9),
(58, '964333', '2024-04-08', '18:00:00', '2024-04-08', '23:57:00', 22, 15, 100, 'Economy', '7800.00', 9),
(59, '87500', '2024-04-08', '04:58:00', '2024-04-08', '13:59:00', 12, 23, 100, 'Economy', '6800.00', 9),
(60, '853990', '2024-04-08', '15:00:00', '2024-04-09', '20:00:00', 12, 23, 100, 'Business', '7655.00', 9),
(61, '90654', '2024-04-08', '01:01:00', '2024-04-09', '12:02:00', 26, 16, 100, 'Business', '7850.00', 9),
(62, '87455', '2024-04-08', '21:03:00', '2024-04-08', '23:04:00', 24, 20, 100, 'Business', '9000.00', 9),
(63, '98567', '2024-04-08', '06:05:00', '2024-04-09', '17:06:00', 20, 12, 100, 'First Class', '7650.00', 9),
(64, '45098', '2024-04-09', '15:07:00', '2024-04-09', '20:07:00', 12, 25, 100, 'First Class', '8600.00', 9),
(65, '287456', '2024-04-08', '05:09:00', '2024-04-08', '10:09:00', 12, 25, 100, 'First Class', '7867.00', 9),
(66, '7584435', '2024-04-08', '18:11:00', '2024-04-08', '22:11:00', 23, 12, 100, 'First Class', '6550.00', 9),
(67, '76958', '2024-04-08', '01:12:00', '2024-04-09', '10:12:00', 18, 23, 100, 'First Class', '6500.00', 9),
(68, '57664', '2024-04-08', '15:21:00', '2024-04-09', '20:21:00', 20, 23, 100, 'Economy', '7640.00', 5),
(69, '87600', '2024-04-08', '20:22:00', '2024-04-08', '23:22:00', 24, 16, 100, 'Economy', '8700.00', 5),
(70, '6578865', '2024-04-08', '15:23:00', '2024-04-09', '20:23:00', 15, 14, 100, 'Economy', '6755.00', 5),
(71, '75866', '2024-04-08', '10:24:00', '2024-04-08', '15:24:00', 24, 12, 100, 'Economy', '9800.00', 5),
(72, '78666', '2024-04-08', '20:27:00', '2024-04-08', '23:27:00', 21, 12, 100, 'Economy', '7860.00', 5),
(73, '87500', '2024-04-08', '14:28:00', '2024-04-09', '20:28:00', 26, 12, 99, 'Business', '7540.00', 5),
(74, '87688', '2024-04-08', '10:28:00', '2024-04-09', '19:29:00', 23, 12, 97, 'Business', '9800.00', 5),
(75, '57888', '2024-04-08', '20:31:00', '2024-04-09', '15:32:00', 18, 12, 99, 'Business', '7850.00', 5),
(76, '764999', '2024-04-08', '16:32:00', '2024-04-09', '20:33:00', 12, 25, 99, 'Business', '9000.00', 5),
(77, '758654', '2024-04-08', '15:33:00', '2024-04-08', '16:35:00', 12, 18, 100, 'Business', '8760.00', 5),
(78, '765999', '2024-04-08', '14:39:00', '2024-04-08', '23:39:00', 23, 12, 100, 'First Class', '9800.00', 5),
(79, '74699', '2024-04-08', '20:40:00', '2024-04-09', '23:40:00', 12, 16, 100, 'First Class', '7460.00', 5),
(80, '435299', '2024-04-08', '07:41:00', '2024-04-08', '01:41:00', 14, 25, 100, 'First Class', '5400.00', 5),
(81, '7453811', '2024-04-10', '10:42:00', '2024-04-10', '17:42:00', 12, 25, 98, 'First Class', '8700.00', 5),
(82, '8568899', '2024-04-08', '16:43:00', '2024-04-08', '20:43:00', 12, 12, 100, 'First Class', '6500.00', 5),
(83, '746788', '2024-04-08', '16:49:00', '2024-04-08', '18:49:00', 12, 14, 100, 'Economy', '6740.00', 6),
(84, '74578', '2024-04-08', '12:49:00', '2024-04-08', '19:50:00', 12, 14, 100, 'Economy', '7650.00', 6),
(85, '8643672', '2024-04-08', '09:50:00', '2024-04-08', '16:50:00', 12, 14, 100, 'Business', '7500.00', 6),
(86, '8266783', '2024-04-08', '01:51:00', '2024-04-08', '08:52:00', 12, 14, 100, 'First Class', '5421.00', 6),
(87, '52457831', '2024-04-08', '21:52:00', '2024-04-08', '23:52:00', 14, 12, 100, 'Economy', '8640.00', 6),
(88, '8753673', '2024-04-08', '19:53:00', '2024-04-08', '21:53:00', 12, 25, 100, 'Economy', '7640.00', 6),
(89, '8367800', '2024-04-08', '06:54:00', '2024-04-09', '18:54:00', 12, 25, 100, 'Business', '6730.00', 6),
(90, '84679309', '2024-04-08', '01:56:00', '2024-04-09', '03:56:00', 12, 14, 100, 'Business', '5403.00', 6),
(91, '876287', '2024-04-08', '01:57:00', '2024-04-08', '02:57:00', 12, 16, 100, 'Business', '8702.00', 6),
(92, '8764898', '2024-04-08', '01:00:00', '2024-04-08', '10:58:00', 12, 25, 100, 'Business', '7367.00', 6),
(93, '547883', '2024-04-08', '20:59:00', '2024-04-08', '23:59:00', 12, 25, 100, 'First Class', '9022.00', 6),
(94, '67494', '2024-04-08', '03:01:00', '2024-04-08', '23:02:00', 25, 12, 99, 'First Class', '8730.00', 6),
(95, '846789', '2024-04-08', '09:03:00', '2024-04-08', '22:03:00', 12, 14, 100, 'First Class', '5090.00', 6),
(96, '230956', '2024-04-08', '07:03:00', '2024-04-08', '18:04:00', 21, 12, 100, 'First Class', '6702.00', 6),
(97, '756885', '2024-04-08', '12:06:00', '2024-04-08', '20:06:00', 12, 18, 100, 'First Class', '7659.00', 6),
(98, '45782', '2024-04-09', '11:00:00', '2024-04-09', '16:00:00', 14, 21, 100, 'Economy', '5000.00', 3),
(99, '78950', '2024-04-10', '12:00:00', '2024-04-10', '16:30:00', 25, 23, 100, 'Economy', '7500.00', 3),
(100, '89988', '2024-04-12', '07:00:00', '2024-04-12', '15:00:00', 13, 24, 80, 'Economy', '8999.00', 3),
(101, '53421', '2024-05-04', '19:00:00', '2024-05-05', '01:00:00', 27, 24, 100, 'Economy', '4500.00', 3),
(102, '06321', '2024-04-09', '10:00:00', '2024-04-09', '15:00:00', 15, 22, 100, 'Business', '7999.00', 3),
(103, '72421', '2024-04-20', '23:00:00', '2024-04-21', '04:00:00', 12, 18, 100, 'Business', '8999.00', 3),
(104, '98211', '2024-04-12', '21:00:00', '2024-04-13', '10:00:00', 12, 15, 100, 'Business', '5000.00', 3),
(105, '36985', '2024-04-09', '12:00:00', '2024-04-09', '17:00:00', 13, 25, 100, 'Business', '5000.00', 3),
(106, '12980', '2024-04-12', '19:00:00', '2024-04-12', '23:00:00', 12, 20, 100, 'First Class', '9500.00', 3),
(107, '43111', '2024-04-09', '12:00:00', '2024-04-09', '15:00:00', 12, 13, 1000, 'First Class', '5200.00', 3),
(108, '55279', '2024-04-08', '12:00:00', '2024-04-08', '17:00:00', 20, 22, 100, 'First Class', '7599.00', 1),
(109, '21444', '2024-04-08', '13:49:00', '2024-04-08', '14:48:00', 14, 12, 100, 'Economy', '4300.00', 3),
(110, '20011', '2024-04-08', '14:49:00', '2024-04-08', '16:49:00', 22, 25, 100, 'Business', '6500.00', 3),
(111, '54542', '2024-04-08', '15:37:00', '2024-04-08', '18:37:00', 12, 20, 100, 'First Class', '4900.00', 3);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `order_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'Pending',
  `payment_method` varchar(50) NOT NULL,
  `payment_status` varchar(20) NOT NULL,
  `transaction_id` varchar(100) DEFAULT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  PRIMARY KEY (`order_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `order_date`, `status`, `payment_method`, `payment_status`, `transaction_id`, `total_amount`) VALUES
(1, 5, '2024-03-08 10:57:23', 'Shipped', 'gpay', '1', '12333', '5000.00'),
(2, 6, '2024-03-08 15:49:36', 'Pending', 'gpay', '1', '553535', '5000.00'),
(3, 5, '2024-03-12 04:28:51', 'Shipped', 'gpay', '1', '458888', '5000.00'),
(4, 9, '2024-03-16 05:10:17', 'Shipped', 'Stripe', 'Paid', 'testid123', '605000.00'),
(5, 9, '2024-03-16 05:26:18', 'Pending', 'Stripe', 'Paid', 'testid123', '207000.00'),
(6, 9, '2024-03-16 05:42:48', 'Shipped', 'Stripe', 'Paid', 'testid123', '37000.00'),
(7, 9, '2024-03-17 09:00:51', 'Shipped', 'Stripe', 'Paid', 'testid123', '19000.00'),
(8, 5, '2024-03-19 16:02:50', 'Confirmed', 'Stripe', 'Paid', 'tok_1Ow57jDwlRClWlNg3V157088', '90000.00'),
(9, 9, '2024-03-19 20:47:18', 'Pending', 'Stripe', 'Paid', 'tok_1Ow9Z0DwlRClWlNg2Kj888rQ', '70198.00'),
(10, 10, '2024-03-19 20:49:36', 'Pending', 'Stripe', 'Paid', 'tok_1Ow9bDDwlRClWlNgBqq4WPLp', '27000.00'),
(11, 9, '2024-03-21 02:55:24', 'Confirmed', 'Stripe', 'Paid', 'tok_1OwbmmDwlRClWlNg5ivsf9YU', '19999.00'),
(12, 18, '2024-03-21 03:00:26', 'Confirmed', 'Stripe', 'Paid', 'tok_1OwbreDwlRClWlNgSmmqCzHD', '90000.00'),
(13, 19, '2024-03-21 04:43:42', 'Shipped', 'Stripe', 'Paid', 'tok_1OwdTZDwlRClWlNgWAcHgVG9', '69999.00'),
(14, 16, '2024-03-23 04:58:13', 'Shipped', 'Stripe', 'Paid', 'tok_1OxMekDwlRClWlNga2MV3gPW', '17000.00'),
(15, 22, '2024-03-23 11:55:10', 'Shipped', 'Stripe', 'Paid', 'tok_1OxTAGDwlRClWlNgYYy1aRJW', '27000.00'),
(16, 23, '2024-03-23 12:27:57', 'Pending', 'Stripe', '1', 'ch_3OxTg3DwlRClWlNg0WvmCsY6', '1700.00'),
(17, 21, '2024-03-23 12:29:18', 'Pending', 'Stripe', 'Paid', 'tok_1OxThIDwlRClWlNgiH0y4210', '7000.00'),
(18, 19, '2024-03-23 12:40:19', 'Pending', 'Stripe', 'Paid', 'tok_1OxTrxDwlRClWlNgfmtBHC3n', '1700.00'),
(19, 16, '2024-03-23 12:58:12', 'Shipped', 'Stripe', 'Paid', 'tok_1OxU9FDwlRClWlNgNP7yR6Ic', '14000.00'),
(20, 16, '2024-03-23 13:11:03', 'Pending', 'Stripe', 'Paid', 'tok_1OxULhDwlRClWlNgoNh2ttGB', '550.00'),
(21, 22, '2024-03-30 06:50:02', 'Pending', 'Stripe', 'Paid', 'tok_1OzvjqDwlRClWlNglCBxuJcx', '22999.00');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
CREATE TABLE IF NOT EXISTS `order_items` (
  `order_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`order_item_id`),
  KEY `order_id` (`order_id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`order_item_id`, `order_id`, `product_id`, `quantity`) VALUES
(1, 3, 26, 2),
(2, 4, 22, 9),
(3, 4, 22, 9),
(4, 4, 23, 7),
(5, 5, 12, 20),
(6, 5, 17, 1),
(7, 6, 12, 1),
(8, 6, 22, 1),
(9, 7, 37, 1),
(10, 8, 36, 1),
(11, 9, 55, 1),
(12, 9, 107, 1),
(13, 9, 56, 1),
(14, 9, 110, 1),
(15, 9, 116, 1),
(16, 10, 12, 1),
(17, 10, 23, 1),
(18, 11, 127, 1),
(19, 12, 36, 1),
(20, 13, 127, 1),
(21, 13, 38, 1),
(22, 13, 39, 3),
(23, 14, 23, 1),
(24, 15, 22, 1),
(25, 16, 55, 1),
(26, 17, 57, 1),
(27, 18, 55, 1),
(28, 19, 57, 2),
(29, 20, 66, 1),
(30, 21, 126, 1);

-- --------------------------------------------------------

--
-- Table structure for table `passenger`
--

DROP TABLE IF EXISTS `passenger`;
CREATE TABLE IF NOT EXISTS `passenger` (
  `passenger_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `age` int(11) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(10) NOT NULL,
  `seatno` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `gateno` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `pnr_no` int(11) DEFAULT NULL,
  `booking_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`passenger_id`),
  KEY `booking_id` (`booking_id`)
) ENGINE=MyISAM AUTO_INCREMENT=101 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `passenger`
--

INSERT INTO `passenger` (`passenger_id`, `name`, `age`, `dob`, `gender`, `seatno`, `gateno`, `pnr_no`, `booking_id`) VALUES
(59, 'vishal saw', 22, '2002-03-12', 'Male', NULL, NULL, NULL, 43),
(58, 'shruti', 23, '2001-02-02', 'Male', NULL, NULL, NULL, 42),
(57, 'vishal saw', 1, '2023-03-04', 'Male', NULL, NULL, NULL, 41),
(56, 'shruti', 21, '2002-11-12', 'Male', NULL, NULL, NULL, 40),
(55, 'vishal saw', 20, '2003-11-12', 'Male', NULL, NULL, NULL, 39),
(54, 'vishal saw', 2021, '0002-11-12', 'Male', NULL, NULL, NULL, 38),
(45, 'vishal saw', 20, '2003-11-12', 'Male', NULL, NULL, NULL, 27),
(46, 'vishal saw', 20, '2003-11-12', 'Male', NULL, NULL, NULL, 28),
(47, 'vishal saw', 20, '2003-11-12', 'Male', NULL, NULL, NULL, 29),
(48, 'vishal saw', 20, '2003-11-12', 'Male', NULL, NULL, NULL, 30),
(49, 'vishal saw', 20, '2003-11-12', 'Male', NULL, NULL, NULL, 31),
(50, 'vishal saw', 20, '2003-11-12', 'Male', NULL, NULL, NULL, 32),
(51, 'vishal saw', 20, '2003-11-12', 'Male', NULL, NULL, NULL, 33),
(52, 'vishal saw', 22, '2001-11-12', 'Male', NULL, NULL, NULL, 34),
(53, 'shruti', 2021, '0003-03-14', 'Male', NULL, NULL, NULL, 37),
(60, 'vishal saw', 21, '2002-03-28', 'Male', '17', '9', 1296867908, 44),
(61, 'c b patel', 21, '2002-11-12', 'Male', '29', '5', 2147483647, 45),
(62, 'shruti javiya', 22, '2001-10-02', 'Male', '15', '2', 2147483647, 46),
(63, 'shruti javiya', 21, '2002-11-12', 'Male', '38', '5', 2147483647, 47),
(64, 'shruti javiya', 21, '2002-12-12', 'Male', '5', '6', 2147483647, 48),
(65, 'raj patil', 20, '2003-11-12', 'Male', '40', '1', 2147483647, 49),
(66, 'raj patil', 21, '2002-12-12', 'Male', '10', '6', 1747879265, 50),
(67, 'vishal saw', 18, '2005-11-12', 'Male', '50', '1', 2147483647, 51),
(68, 'prachi sen', 18, '2005-11-12', 'Male', '7', '6', 2147483647, 52),
(69, 'prachi sen', 24, '1999-04-28', 'Male', '47', '6', 2147483647, 53),
(70, 'prachi sen', 23, '2001-01-01', 'Male', '4', '7', 2147483647, 54),
(71, 'gautam nath', 15, '2009-02-12', 'Male', '57', '1', 2147483647, 55),
(72, 'bhupendra patel', 34, '1990-01-12', 'Male', '73', '1', 2147483647, 55),
(73, 'Bhargav tiwari', 20, '2004-01-01', 'Male', '77', '7', 2147483647, 56),
(74, 'Sweta tiwari', 20, '2004-01-01', 'Female', '63', '7', 2147483647, 56),
(75, 'vishal saw', 23, '2001-01-01', 'Male', '94', '5', 2147483647, 57),
(76, 'soham dorge', 20, '2003-11-12', 'Male', '56', '5', 2147483647, 57),
(77, 'bhargav tiwari', 19, '2004-07-07', 'Male', '21', '5', 2147483647, 57),
(78, 'yagnesh prajapati', 20, '2004-01-01', 'Male', '90', '5', 2147483647, 57),
(79, 'prasad patil', 26, '1998-02-02', 'Male', '4', '5', 2147483647, 57),
(80, 'Lalita sharma', 24, '1999-08-18', 'Male', '86', '5', 2147483647, 57),
(81, 'vishal saw', 23, '2001-01-01', 'Male', '96', '9', 2147483647, 58),
(82, 'soham dorge', 20, '2003-11-12', 'Male', '97', '9', 2147483647, 58),
(83, 'bhargav tiwari', 19, '2004-07-07', 'Male', '32', '9', 2147483647, 58),
(84, 'yagnesh prajapati', 20, '2004-01-01', 'Male', '32', '9', 2147483647, 58),
(85, 'prasad patil', 26, '1998-02-02', 'Male', '53', '9', 2147483647, 58),
(86, 'Lalit sharma', 24, '1999-08-18', 'Male', '22', '9', 2147483647, 58),
(87, 'raghav kale', 15, '2009-01-01', 'Male', '18', '8', 2147483647, 59),
(88, 'gopal chunawala', 26, '1998-01-14', 'Male', '76', '8', 2147483647, 59),
(89, 'mohit jariwala', 23, '2000-06-07', 'Male', '48', '8', 2147483647, 59),
(90, 'deepak patil', 28, '1996-02-10', 'Male', '72', '5', 2147483647, 60),
(91, 'chirag jain', 19, '2004-09-12', 'Male', '62', '5', 2147483647, 60),
(92, 'kiran sen', 18, '2005-10-25', 'Female', '3', '5', 2147483647, 60),
(93, 'raj patil', 24, '1999-04-12', 'Male', '91', '6', 2147483647, 61),
(94, 'soham dorge', 19, '2004-11-12', 'Male', '79', '8', 2147483647, 62),
(95, 'vishal saw', 23, '2001-02-12', 'Male', '10', '10', 1830908677, 63),
(96, 'raj patil', 22, '2001-11-12', 'Male', '43', '5', 2147483647, 64),
(97, 'gopal shetty', 15, '2009-02-12', 'Male', '1', '10', 1729026638, 65),
(98, 'mayank kumar', 23, '2001-02-13', 'Male', '54', '10', 1729026638, 65),
(99, 'akruti panda', 25, '1998-11-23', 'Female', '49', '10', 1729026638, 65),
(100, 'mohini devi', 27, '1997-01-12', 'Female', '20', '10', 1729026638, 65);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `vendor_id` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `img1` varchar(255) NOT NULL,
  `img2` varchar(255) NOT NULL,
  `img3` varchar(255) DEFAULT NULL,
  `img4` varchar(255) DEFAULT NULL,
  `description` text,
  `price` decimal(10,2) NOT NULL,
  `stock_quantity` int(11) NOT NULL DEFAULT '0',
  `discount_price` decimal(10,2) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `subcategory_id` int(11) DEFAULT NULL,
  `warranty` int(11) NOT NULL,
  PRIMARY KEY (`product_id`),
  KEY `vendor_id` (`vendor_id`),
  KEY `category_id` (`category_id`),
  KEY `subcategory_id` (`subcategory_id`)
) ENGINE=MyISAM AUTO_INCREMENT=140 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `vendor_id`, `name`, `img1`, `img2`, `img3`, `img4`, `description`, `price`, `stock_quantity`, `discount_price`, `category_id`, `subcategory_id`, `warranty`) VALUES
(4, 3, 'Seventh Heaven 3 Seater Sofa Berlin Sofa, Adjusatble Headrest', 'products/s4.jpg', 'products/s41.jpg', 'products/s42.jpg', '', 'Brand	Seventh Heaven\r\nAssembly Required	Yes\r\nSeat Depth	55.9 Centimeters\r\nSeat Height	16 Inches\r\nProduct Dimensions	0.97D x 2.01W x 0.8H Meters\r\nItem Weight	60 Kilograms', '20000.00', 20, '18999.00', 2, 5, 1),
(23, 4, 'CASASTYLE - Minacs 4 Seater Fabric RHS L Shape Sofa Set (Grey)', 'products/s11.jpg', 'products/s2.jpg', '', '', 'Brand	CASASTYLE\r\nAssembly Required	No\r\nWeight Limit	50 Kilograms\r\nProduct Dimensions	1.52D x 2.57W x 0.84H Meters\r\nItem Weight	30000 Grams\r\nLeg Length	3 Inches', '17000.00', 17, '16000.00', 2, 5, 3),
(22, 3, 'FurnitureModern Classic 4 Seater Fabric & Valvet Tufted 3+1+1Footrest Chesterfield Sofa Living Room ', 'products/s12.jpg', 'products/s13.jpg', NULL, '', '\r\nColour	teal green\r\nBrand	A to Z Furniture\r\nSize	Large\r\nItem Dimensions LxWxH	198.1 x 73.7 x 68.6 Centimeters\r\nMaterial	Wood', '27000.00', 300, '2599.00', 2, 5, 2),
(12, 2, 'Wooden Chair', 'products/c21.jpg', 'products/c2.jpg', 'products/c22.jpg', NULL, 'Brand	Ikea,\r\nColour	Black,\r\nMaterial	Wood,\r\nProduct Dimensions	47D x 39W x 77H Centimeters,\r\nSize	Standard,\r\nBack Style	Arrow Back,\r\nSpecial Feature	Arrow Back,\r\nProduct Care Instructions	Wipe Clean,\r\nNet Quantity	1.0 count,\r\nSeat Material Type	Wood', '10000.00', 50, '9000.00', 2, 6, 1),
(13, 2, 'Ikea Italian Chair (Wood , Black)', 'products/c11.jpg', 'products/c12.jpg', 'products/c13.jpg', '', 'Brand	Ikea\r\nColour	Black\r\nMaterial	Wood\r\nProduct Dimensions	47D x 39W x 77H Centimeters\r\nSize	Standard\r\nBack Style	Arrow Back\r\nSpecial Feature	Arrow Back\r\nProduct Care Instructions	Wipe Clean\r\nNet Quantity	1.0 count\r\nSeat Material Type	Wood', '1200.00', 30, '1010.00', 2, 6, 1),
(14, 4, ' Zero Gravity Relax Chair', 'products/c3.jpg', 'products/c31.jpg', NULL, '', 'STAR WORK Zero Gravity Relax Chair for Lounge,Easy Chair for Lawn | Portable and Foldable Recliner Chair for Resting | Adjustable Pillow | Full Body Support, Alloy Steel, Black.', '3000.00', 40, '2899.00', 2, 6, 1),
(15, 1, 'Gautam Furniture Sheesham Wood Wing Chair -Light Pink', 'products/c4.1.jpg', 'products/c4.2.jpg', 'products/4.3.jpg', '', '\r\nBrand	Generic\r\nColour	Rose\r\nMaterial	Teak\r\nProduct Dimensions	98D x 128W x 88H Centimeters\r\nSize	70 x 140 cm\r\nBack Style	Wing Back', '13000.00', 100, '10000.00', 2, 6, 2),
(16, 1, ' Velvet Accent Chair', 'products/c5.jpg', 'products/c51.jpg', 'products/c52.jpg', '', '\r\nBrand	CREATIVE FURNITURE ART\r\nColour	Teal\r\nMaterial	Wood\r\nProduct Dimensions	71D x 99W x 74H Centimeters\r\nSize	Large\r\nProduct Care Instructions	Dry Clean\r\nNet Quantity	1.00 count\r\nPattern	Solid\r\nFinish Type	Stain Less Steel\r\nRoom Type	Office, Bedroom, Living Room, Patio Garden\r\n', '15000.00', 60, '14999.00', 2, 6, 0),
(18, 3, 'Brown Leatherette Executive Office Chair', 'products/c9.jpg', 'products/c91.jpg', 'products/c92.jpg', '', 'Brand	ROAR-WOOD\r\nColour	Brown\r\nMaterial	Leather\r\nProduct Dimensions	40D x 42W x 42H Centimeters\r\nSize	High Back Chair\r\nBack Style	Solid Back', '7788.00', 40, '7000.00', 2, 6, 1),
(19, 2, 'Cane Chair with Cushion ', 'products/c102.jpg', 'products/c101.jpg', '', '', '\r\nBrand	HM SERVICES\r\nColour	Brown\r\nMaterial	Bamboo\r\nProduct Dimensions	56D x 71W x 44H Centimeters\r\nSize	Standard\r\nBack Style	Solid Back', '2000.00', 20, '1899.00', 2, 6, 0),
(20, 3, 'STYLESEAT Marbel Grey Plastic Mid Back with Arm Chair', 'products/c111.jpg', 'products/c112.jpg', 'products/c10.jpg', '', 'Brand	STYLESEAT\r\nColour	Beige\r\nMaterial	Polypropylene\r\nProduct Dimensions	56D x 60W x 79H Centimeters\r\nSize	Standard\r\nBack Style	Solid Back', '1000.00', 30, '799.00', 2, 6, 0),
(21, 2, 'Dr Luxur Gaming Chair for Gaming, Home Office and Study- for Work from Home wi', 'products/cg.jpg', 'products/cg2.jpg', 'products/cg3.jpg', '', 'Brand	Dr Luxur\r\nColour	Grey\r\nMaterial	Softweave Cotton\r\nProduct Dimensions	52D x 54W x 132H Centimeters\r\nSize	Medium\r\nBack Style	Open Back\r\nSpecial Feature	Adjustable Headrest\r\nProduct Care Instructions	Wipe Clean\r\nNet Quantity	1.00 count\r\nSeat Material Type	Alloy Steel\r\n', '17000.00', 400, '1599.00', 2, 6, 0),
(25, 4, 'Sofa Set with Ottoman & 2 Puffy ', 'products/s3.jpg', 'products/s31.jpg', '', '', '\r\nBrand	CASASTYLE\r\nAssembly Required	No\r\nProduct Dimensions	1.37D x 2.57W x 0.84H Meters\r\nType	Sectional\r\nColour	Blue\r\nSpecial Feature	Recliner', '26000.00', 40, '56000.00', 2, 5, 0),
(27, 4, 'Seventh Heaven Milan Sofa', 'products/s5.jpg', 'products/s51.jpg', 'products/s52.jpg', 'products/s53.jpg', 'Brand	Seventh Heaven\r\nAssembly Required	Yes\r\nSeat Depth	55.9 Centimeters\r\nSeat Height	16 Inches\r\nProduct Dimensions	80D x 80W x 80H Centimeters\r\nItem Weight	40 Kilograms', '10000.00', 78, '9000.00', 2, 5, 0),
(28, 1, 'Sofa Set in Gold Paint ', 'products/s21.jpg', 'products/s22.jpg', 'products/s23.jpg', '', 'Brand	Aarsun\r\nAssembly Required	No\r\nSeat Height	16 Inches\r\nColour	Gold\r\nSpecial Feature	Button Tufted\r\nRoom Type	Living Room\r\nPattern	Floral', '20000.00', 10, '18999.00', 2, 5, 0),
(29, 1, 'SDR Furniture Wooden 5 Seater Sofa Set', 'products/s6.jpg', 'products/s61.jpg', 'products/s62.jpg', '', '\r\nColour	Walnut\r\nBrand	SDR Furniture\r\nSize	5 Seater With Coffee Table\r\nItem Dimensions LxWxH	74.9 x 74.9 x 86.4 Centimeters', '7000.00', 60, '6900.00', 2, 5, 1),
(30, 3, 'CASASTYLE Alberoy 4 Seater Fabric LHS L Shape Sofa Set (Dark Grey-Light Grey)', 'products/s7.jpg', 'products/s71.jpg', '', '', '\r\nBrand	CASASTYLE\r\nAssembly Required	No\r\nProduct Dimensions	201D x 137.2W x 83.8H Centimeters\r\nItem Weight	40000 Grams\r\nType	Sectional\r\nColour	Dark Grey-Light Grey', '17000.00', 50, '16000.00', 2, 5, 0),
(31, 3, 'Blisscraft Luna 5 Seater Fabric LHS L Shape Sofa Set (Brown)', 'products/s8.jpg', 'products/s81.jpg', 'products/s82.jpg', '', '\r\nBrand	Blisscraft\r\nAssembly Required	No\r\nProduct Dimensions	0.76D x 2.57W x 0.84H Meters\r\nItem Weight	100 Kilograms\r\nType	Sectional\r\nColour	Brown\r\nSpecial Feature	Recliner\r\nUpholstery Fabric Type	Polycot\r\nRoom Type	Living Room\r\nArm Style	Padded\r\n', '22000.00', 50, '20500.00', 2, 5, 0),
(35, 1, 'ABOUT SPACE Wooden Coffee Table - End & Sofa Side Tea Table,Centre Table with Solid Finish Space Sav', 'products/t22.jpg', 'products/t21.jpg', '', '', '\r\nProduct Dimensions	100D x 40W x 39H Centimeters\r\nColour	Brown\r\nBrand	ABOUT SPACE\r\nTable design	Coffee Table\r\nStyle	Contemporary\r\nSeating Capacity	2', '15000.00', 50, '14000.00', 2, 7, 0),
(33, 1, 'JIN OFFICE Wrought And Cast Iron Height Adjustable Desk Electric|Dual Motor 3-Stage|Electric Sit Sta', 'products/t1.jpg', 'products/t11.jpg', 'products/t12.jpg', '', 'Brand	JIN OFFICE\r\nProduct Dimensions	75D x 120W x 70H Centimeters\r\nColour	Black\r\nStyle	Modern\r\nBase Material	Engineered Wood\r\nTop Material Type	Engineered Wood', '20000.00', 15, '18999.00', 2, 7, 0),
(36, 1, 'Apple iPhone 15 (256 GB) - black', 'products/p1.jpg', 'products/p11.jpg', 'products/p12.jpg', '', '\nBrand	Apple\nModel Name	iPhone 15\nNetwork Service Provider	Unlocked for All Carriers\nOperating System	iOS\nCellular Technology', '90000.00', 40, '75000.00', 3, 9, 0),
(37, 4, 'Oppo A79 5G (Mystery Black, 8GB RAM, 128GB Storage) | 5000 mAh Battery with 33W SUPERVOOC Charger | ', 'products/p32.jpg', 'products/p31.jpg', 'products/p3.jpg', '', '\r\nBrand	Oppo\r\nModel Name	A79 5G\r\nNetwork Service Provider	Unlocked for All Carriers\r\nOperating System	Android 13.0\r\nCellular Technology	5G', '19000.00', 50, '17999.00', 3, 9, 0),
(38, 2, 'Samsung Galaxy A35 5G (Awesome Lilac, 8GB RAM, 256GB Storage) | Premium Glass Back | 50 MP Main Came', 'products/p4.jpg', 'products/p41.jpg', 'products/p42.jpg', 'products/p43.jpg', '\r\nBrand	Redmi\r\nModel Name	Redmi 12\r\nNetwork Service Provider	Unlocked for All Carriers\r\nOperating System	Android 13, MIUI 14\r\nCellular Technology', '11000.00', 50, '98500.00', 3, 9, 0),
(39, 4, 'realme narzo 60X 5G（Stellar Green,6GB,128GB Storage ） Up to 2TB External Memory | 50 MP AI Primary C', 'products/p5.jpg', 'products/p51.jpg', 'products/p52.jpg', 'products/p53.jpg', '\r\nBrand	realme\r\nModel Name	realme narzo 60x\r\nNetwork Service Provider	Unlocked for All Carriers\r\nOperating System	Android 13.0\r\nCellular Technology	5G', '13000.00', 50, '12500.00', 3, 9, 1),
(40, 1, 'Redmi Note 13 5G (Prism Gold, 12GB RAM, 256GB Storage) | Bezel-Less 120Hz AMOLED | 7.6mm Slimmest No', 'products/p6.jpg', 'products/p7.jpg', 'products/p61.jpg', '', '\r\nBrand	Redmi\r\nModel Name	Redmi Note 13 5G\r\nNetwork Service Provider	Unlocked for All Carriers\r\nOperating System	Android 13, MIUI 14\r\nCellular Technology	5G', '22000.00', 50, '20000.00', 3, 9, 0),
(134, 4, 'The Cube Club PowerBells Set of 2 Adjustable Iron Dumbbells (2.5-24 Kg) | 15-IN-1 Dumbbell Weights w', 'products/db21.png', 'products/db22.jpg', 'products/db23.jpg', '', '\r\nBrand	The Cube Club\r\nColour	48kg\r\nItem Weight	48 Kilograms\r\nMaterial	Iron\r\nSpecial Feature	1-SECOND WEIGHTS CHANGE, 15-IN-1 DUMBBELLS, MAXIMIZE SPACE SAVING', '14500.00', 50, '13500.00', 1, 1, 0),
(42, 4, 'Realme 12 Pro+ 5G Submarine Blue, 12GB RAM, 256GB Storage', 'products/p8.jpg', 'products/p81.jpg', 'products/p82.jpg', '', 'Brand	realme\r\nModel Name	realme 12 Pro+ 5G (Submarine Blue, 12GB RAM, 256GB Storage) | | 12 GB+12 GB Dynamic RAM| 64 MP Periscope Portrait Camera | 50 MP Sony IMX890 OIS Camera | Snapdragon 7s Gen 2 Chipset |Luxury Watch Designrealme 12 Pro+ 5G (Submarine Blue, 12GB RAM, 256GB Storage) | | 12 GB+12 GB Dynamic RAM| 64 MP Periscope Portrait Camera | 50 MP Sony IMX… See more\r\nNetwork Service Provider	Unlocked for All Carriers\r\nOperating System	realme UI 5.0 || Based on Android 14\r\nCellular Technology	5G\r\n', '32000.00', 100, '30000.00', 3, 9, 0),
(43, 1, 'Panasonic 27L Convection Microwave Oven(NN-CT645BFDG,,Black Mirror, 360° Heat Wrap, Magic Grill)', 'products/o1.jpg', 'products/o11.jpg', '', '', '\r\nBrand	Panasonic\r\nProduct Dimensions	47.1D x 51.3W x 30.6H Centimeters\r\nColour	Black Mirror\r\nCapacity	27 litres\r\nSpecial Feature	Auto Cook', '12000.00', 70, '11100.00', 3, 8, 1),
(44, 3, 'Philips HD6975/00 Digital Oven Toaster Grill, 25 Litre OTG, 1500 Watt with Opti Temp Technology, Cha', 'products/o4.jpg', 'products/o41.jpg', 'products/o42.jpg', '', '\r\nBrand	PHILIPS\r\nColour	Grey\r\nProduct Dimensions	40.2D x 52W x 35.6H Centimeters\r\nSpecial Feature	Adjustable Rack\r\nControl Type	Touch Control', '8000.00', 70, '7500.00', 3, 8, 0),
(45, 2, 'Panasonic 20L Solo Microwave Oven (NN-SM25JBFDG,Black)', 'products/o5.jpg', 'products/o51.jpg', 'products/o52.jpg', '', '\r\nBrand	Panasonic\r\nProduct Dimensions	34D x 44W x 26H Centimeters\r\nColour	Black\r\nCapacity	20 litres\r\nSpecial Feature	Auto_cook', '6000.00', 70, '5000.00', 3, 8, 0),
(46, 3, 'LG 28 L Scan to Cook Wi-Fi Enabled Charcoal Convection Healthy Microwave Oven (MJEN286VIW, Black, He', 'products/o6.jpg', 'products/o61.jpg', 'products/o62.jpg', 'products/o63.jpg', 'Brand	LG\r\nProduct Dimensions	48.8D x 51.2W x 31.1H Centimeters\r\nColour	Black\r\nCapacity	28 litres\r\nSpecial Feature	Auto Cook, Wi-Fi, Timer, Child Safety Lock, Grill Function', '20000.00', 50, '18999.00', 3, 8, 3),
(47, 2, 'Panasonic 23L Convection Microwave Oven(NN-CT353BFDG,Black Mirror, 360° Heat Wrap, Magic Grill)', 'products/o7.jpg', 'products/o71.jpg', 'products/o72.jpg', '', '\r\nBrand	Panasonic\r\nProduct Dimensions	29.2D x 48.3W x 34.3H Centimeters\r\nColour	Black Mirror\r\nCapacity	23 litres\r\nSpecial Feature	Auto_cook', '11000.00', 70, '9999.00', 3, 8, 0),
(48, 2, 'Philips HD6976/00 36 Litre Digital Oven Toaster Grill, 2000W, with Opti Temp Technology, Temperature', 'products/o8.jpg', 'products/o81.jpg', 'products/o82.jpg', '', '\r\nBrand	PHILIPS\r\nColour	BLACK\r\nProduct Dimensions	57.8D x 47.8W x 37.2H Centimeters\r\nSpecial Feature	Temperature Control, Timer\r\nControl Type	Button Control\r\n', '13000.00', 50, '12500.00', 3, 8, 0),
(126, 1, 'Haier 8 Kg 5 Star In-built Heater Fully Automatic Top Load Washing Machine (HWM80-H826S6, Oceanus Wa', 'products/lg41.jpg', 'products/lg42.jpg', 'products/lg43.jpg', '', 'Fully-automatic top load washing machine : Affordable with great wash quality, Easy to use; Has both washing and drying functions\r\nCapacity 8 kg: Suitable for large families\r\nEnergy Star rating: 5 Star: Best in class efficiency\r\nManufacturer Warranty: 5 years on product and 12 years on motor\r\n780 RPM: Higher spin speeds helps in faster wash and drying;\r\nWash Programs: 15 Programs\r\nDrum type: 5D Pulsator', '22999.00', 39, '21999.00', 3, 11, 0),
(1, 2, 'Apple iPhone 15 (128 GB) - Green', 'products/x1.jpg', 'products/x11.jpg', 'products/x12.jpg', '', '\r\nBrand	Apple\r\nModel Name	iPhone 15\r\nNetwork Service Provider	Unlocked for All Carriers\r\nOperating System	iOS\r\nCellular Technology	5G', '70000.00', 100, '65999.00', 3, 9, 0),
(2, 4, 'iQOO Neo 7 Pro 5G (Dark Storm, 12Gb Ram, 256Gb Storage) | Snapdragon 8+ Gen 1 | Independent Gaming C', 'products/x2.jpg', 'products/x21.jpg', 'products/x22.jpg', '', '\r\nBrand	iQOO\r\nModel Name	iQOO Neo 7 Pro 5G\r\nNetwork Service Provider	Unlocked for All Carriers\r\nOperating System	Funtouch OS 13 Based On Android 13\r\nCellular Technology	5G', '35000.00', 50, '33999.00', 3, 9, 0),
(124, 1, 'LG 8 Kg 5 Star Inverter Direct Drive Fully Automatic Front Load Washing Machine (FHM1408BDW, Steam W', 'products/LG21.jpg', 'products/LG22.jpg', 'products/LG24.jpg', 'products/LG23.jpg', '\r\nCapacity	8 Kilograms\r\nColour	White\r\nBrand	LG\r\nProduct Dimensions	55D x 60W x 85H Centimeters\r\nSpecial Feature	Inverter, Child Lock, Auto Restart, Hygiene Steam, High Efficiency, Inbuilt Heater', '35000.00', 50, '33999.00', 3, 11, 0),
(122, 1, 'LG 6.5 Kg 5 Star Inverter Turbodrum Fully Automatic Top Loading Washing Machine (T65SKSF4Z, 3 Smart ', 'products/lg.jpg', 'products/lg1.jpg', 'products/lg2.jpg', 'products/lg3.jpg', '\r\nProduct Dimensions	56D x 54W x 87H Centimeters\r\nBrand	LG\r\nCapacity	6.5 Kilograms\r\nSpecial Feature	Inverter, Child Lock, High Efficiency, Time Remaining Display, Turbodrum\r\nAccess Location	Top Load', '16900.00', 100, '15999.00', 3, 11, 3),
(123, 1, 'LG 7 Kg 5 Star Inverter Touch panel Fully-Automatic Front Load Washing Machine with In-Built Heater ', 'products/lg11.jpg', 'products/lg12.jpg', 'products/lg13.jpg', 'products/lg14.jpg', '\r\nProduct Dimensions	60D x 44W x 85H Centimeters\r\nBrand	LG\r\nCapacity	7 Kilograms\r\nSpecial Feature	Inverter, Child Lock, Hygiene Steam, Inbuilt Heater\r\nAccess Location	Front Load\r\n', '28000.00', 100, '27000.00', 3, 11, 0),
(55, 2, 'Amazon Brand - Symactive Rubber Coated 10 Kg Hex Dumbbells Set for Full Body Workout (Set of 2, 5 Kg', 'products/d22.jpg', 'products/d21.jpg', '', '', '\r\nBrand	Amazon Brand - Symactive\r\nColour	Multicolor\r\nItem Weight	5000 Grams\r\nSpecial Feature	Easy To Clean\r\nUse for	Hands, Back', '1700.00', 48, '1599.00', 1, 1, 3),
(57, 3, 'IRIS Fitness 24 kgs Adjustable Dumbbell with Fast Adjustable Weight Plates for Body Workout Home Gym', 'products/d43.jpg', 'products/d42.jpg', 'products/d42.jpg', '', '\r\nBrand	IRIS\r\nColour	Black, Red\r\nItem Weight	24 Kilograms\r\nMaterial	Metal, Rubber\r\nSpecial Feature	Adjustable Weight', '7000.00', 48, '5999.00', 1, 1, 0),
(127, 1, 'Godrej 7.5 Kg 5 Star Zero Pressure Technology Fully-Automatic Top Load Washing Machine Appliance (WT', 'products/lg51.jpg', 'products/lg52.jpg', 'products/lg53.jpg', '', 'Product Dimensions	56.5D x 56.5W x 97H Centimeters\r\nBrand	Godrej\r\nCapacity	7.5 Kilograms\r\nSpecial Feature	Curved end to end tinted Toughened glass, Water Protected Rear control Panel, Soft Shut, Flip Lid Detergent Drawer, Upto 26 Customiseable wash programs, Hygiene Rinse, Super dry, Zero Pressure Technology,Metallic Cabinet, Tub Clean, 5 Star Energy RatingCurved end to end tinted Toughened glass, Water Protected Rear control Panel, Soft Shut, Flip Lid Detergent Drawer, Upto 26 Customiseable wash programs, Hygiene Rinse, Super dry', '19999.00', 100, '18999.00', 3, 11, 1),
(59, 2, 'Durafit Panther Multifunction | 5.5 HP Peak DC Motorized Foldable Treadmill | Auto Incline | Home us', 'products/q1.jpg', 'products/q11.jpg', 'products/q12.jpg', '', '\r\nBrand	Durafit - Sturdy, Stable and Strong\r\nColour	Black\r\nProduct Dimensions	172D x 77W x 125H Centimeters\r\nItem Weight	81 Kilograms\r\nMaterial	Alloy Steel', '45000.00', 50, '43999.00', 1, 2, 0),
(60, 2, 'Durafit Spark Treadmill Series 2.0 HP Peak DC Motorized Max Speed 10 Km/Hr Max User Weight 100 Home ', 'products/q2.jpg', 'products/q21.jpg', '', '', '\r\nBrand	Durafit - Sturdy, Stable and Strong\r\nColour	black\r\nProduct Dimensions	121D x 95W x 53H Centimeters\r\nMaterial	Alloy Steel\r\nSpecial Feature	Compact Design', '14999.00', 50, '13999.00', 1, 2, 0),
(61, 4, 'PowerMax Fitness TDM-98 (4.0HP Peak) Motorized Treadmill With USB Connection, Home Use & Heart Rate ', 'products/q3.jpg', 'products/q31.jpg', 'products/q32.jpg', '', '\r\nBrand	PowerMax Fitness\r\nColour	Grey\r\nProduct Grade	Replacement Parts\r\nProduct Dimensions	143D x 63.5W x 106.5H Centimeters\r\nItem Weight	30 Kilograms', '19000.00', 60, '17999.00', 1, 2, 0),
(62, 4, 'PowerMax Fitness MFT-410 Non-electric Manual Treadmill Foldable, Multifunction (Jogger, Stepper, Twi', 'products/q4.jpg', 'products/q41.jpg', 'products/q42.jpg', '', '\r\nBrand	PowerMax Fitness\r\nItem Weight	40000 Grams\r\nColour	White\r\nMaterial	Alloy Steel\r\nProduct Dimensions	121D x 62W x 140H Centimeters', '25000.00', 40, '23999.00', 1, 2, 0),
(63, 2, 'PowerMax Fitness TDM-100M (4HP Peak) Multi-Function Treadmill For Home Use With Massager |treadmill ', 'products/q51.jpg', 'products/q5.jpg', 'products/q52.jpg', '', 'Brand	PowerMax Fitness\r\nItem Weight	56 Kilograms\r\nColour	Black\r\nMaterial	Stainless Steel\r\nProduct Dimensions	162D x 70W x 120H Centimeters', '18000.00', 50, '16999.00', 1, 2, 0),
(64, 1, 'Boldfit Skipping Rope For Men & Women Adjustable Jumping Rope For Men Gym Rope/Exercise Rope For Men', 'products/r1.jpg', 'products/r2.jpg', '', '', 'Brand	Boldfit\r\nTarget Audience	All\r\nSpecial Feature	Adjustable Length\r\nRecommended Uses For Product	Exercise and Fitness\r\nMaterial	Polyvinyl Chlorine (PVC)', '499.00', 100, '399.00', 1, 3, 0),
(66, 3, 'Boldfit Aluminium Skipping Rope for Men and Women Jumping Rope With Adjustable Height Speed Skipping', 'products/r3.jpg', 'products/r31.jpg', 'products/r32.jpg', '', 'Brand	Boldfit\r\nTarget Audience	Men\r\nSpecial Feature	Lightweight, Adjustable Length\r\nMaterial	Aluminium\r\nHandle Material	Aluminium', '550.00', 199, '499.00', 1, 3, 0),
(67, 3, 'Boldfit Plastic Skipping Rope For Men And Women Jumping Rope With Adjustable Height Speed Skipping R', 'products/r4.jpg', 'products/r42.jpg', 'products/r41.jpg', '', '\r\nBrand	Boldfit\r\nTarget Audience	Kid, Adult\r\nSpecial Feature	Lightweight, Adjustable Length\r\nMaterial	Plastic\r\nHandle Material	Plastic', '299.00', 100, '199.00', 1, 3, 0),
(68, 2, 'HaloHop Skipping Rope with Calorie Counter, Cordless Weighted Skipping Jump Rope with Counter for Ex', 'products/r5.jpg', 'products/r51.jpg', '', '', '\r\nBrand	Halohop\r\nTarget Audience	Adult\r\nSpecial Feature	Cordless, Slip Res, Adjustable Length\r\nMaterial	Polyvinyl Chlorine (PVC)\r\nHandle Material	ABS + TPE\r\n ', '999.00', 799, '899.00', 1, 3, 0),
(70, 2, 'Xfopz Smart Jump Rope, Digital Weighted Handle Workout Jumping Rope with Counter, Cordless Weighted ', 'products/r62.jpg', 'products/r61.jpg', '', '', 'Brand	Xfopz\r\nTarget Audience	Adult\r\nSpecial Feature	Ergonomic, Cordless, Adjustable Length\r\nMaterial	Acrylonitrile Butadiene Styrene (ABS)\r\nHandle Material	Silicone', '799.00', 150, '599.00', 1, 3, 0),
(71, 1, 'NXTGEN MISURAA Imported Venice Ergonomic Office & Home Chair with Extandable Legrest, Dynamic Lumbar', 'products/c1.jpg', 'products/c11.jpg', 'products/c12.jpg', 'products/c13.jpg', '\r\nBrand	NXTGEN MISURAA\r\nColour	White/Grey\r\nMaterial	Aluminium\r\nProduct Dimensions	66D x 68W x 129H Centimeters\r\nSize	Single\r\nBack Style	Solid Back', '35000.00', 50, '33999.00', 2, 6, 0),
(72, 1, 'Urbancart ® Relax Bamboo Wooden Rocking Chair for Home Living Room and Outdoor Lounge, Brown (Design', 'products/c2.jpg', 'products/c21.jpg', 'products/c22.jpg', '', '\r\nBrand	Urbancart\r\nColour	Brown\r\nMaterial	Bamboo\r\nProduct Dimensions	94D x 61W x 106H Centimeters\r\nSize	Design-1\r\nBack Style	low back', '9000.00', 69, '7999.00', 2, 6, 1),
(73, 1, 'CANE CRAFTS Premium Bamboo Chair | Kursi | Chairs for Home, Dining Room, Bedroom, Kitchen, Living Ro', 'products/c3.jpg', 'products/c4.jpg', 'products/c31.jpg', '', 'Brand	CANE CRAFTS\r\nColour	Brown\r\nMaterial	Bamboo\r\nSize	Standard\r\nBack Style	Solid Back\r\nSpecial Feature	These Chairs Are Preferred For Both Indoor And Outdoor Activities.\r\nProduct Care Instructions	Wipe Clean\r\nNet Quantity	1.00 count\r\nSeat Material Type	Wood\r\n', '5999.00', 100, '3999.00', 2, 6, 0),
(74, 1, 'CANE CRAFTS Designer Premium Bamboo Modren Chair | Seating Treasures: Appreciating The Artisanal Her', 'products/c41.jpg', 'products/c42.jpg', 'products/c43.jpg', '', 'Brand	CANE CRAFTS\r\nColour	Brown\r\nMaterial	Bamboo\r\nSize	Standard\r\nBack Style	Solid Back\r\nSpecial Feature	These Chairs Are Preferred For Both Indoor And Outdoor Activities.Product Care Instructions	Wipe Clean\r\nNet Quantity	1.00 count\r\nSeat Material Type	Wood\r\n\r\n', '2999.00', 98, '1999.00', 2, 6, 1),
(75, 1, 'Avika Bhatiacane Bamboo Cane Chairs For Living Room With Cushion Study Chair With Arm Rest|Use In Ho', 'products/c5.jpg', 'products/c51.jpg', 'products/c52.jpg', '', '\r\nBrand	Avika\r\nColour	Brown\r\nMaterial	Rattan\r\nProduct Dimensions	70D x 66W x 70H Centimeters\r\nSize	single seater\r\nBack Style	Solid Back', '4000.00', 100, '3050.00', 2, 6, 0),
(76, 1, 'Cane Crafts Medium Size Designer Bamboo Chair for Lawn Chair, Arm Chair, Room Chair, Indoor and Outd', 'products/c61.jpg', 'products/c62.jpg', '', '', '\r\nBrand	Generic\r\nColour	Brown\r\nMaterial	Bamboo\r\nProduct Dimensions	10D x 10W x 10H Centimeters\r\nSize	Medium\r\nBack Style	Solid Back', '4500.00', 90, '50.00', 2, 6, 0),
(77, 1, 'Vinay Enterprises Plastic tub Chair Rosewood Color Pack of 2', 'products/c7.jpg', 'products/c71.jpg', '', '', '\r\nBrand	Generic\r\nColour	Rosewood\r\nMaterial	Plastic\r\nProduct Dimensions	11D x 15W x 11H Centimeters\r\nSize	Standard\r\nSpecial Feature	Portable, Lightweight', '2500.00', 100, '1999.00', 2, 6, 0),
(78, 1, 'supreme ornate lacquered finish plastic standard chair s with cushion (red/black, set of 2)', 'products/c8.jpg', 'products/c81.jpg', 'products/c82.jpg', '', '\r\nBrand	SUPREME\r\nColour	Black, Red\r\nProduct Dimensions	55.9D x 55.9W x 81.3H Centimeters\r\nSize	Standard\r\nSpecial Feature	Foldable\r\nProduct Care Instructions	Wipe Clean', '8000.00', 500, '7500.00', 2, 6, 0),
(79, 1, 'Crysta Web Designer Plastic Chair (Set of 4 pc, Brown) Comfortable Outdoor and Indoor Chairs', 'products/c9.jpg', 'products/c91.jpg', '', '', 'Brand	Crysta\r\nColour	Brown\r\nMaterial	Polypropylene\r\nProduct Dimensions	30D x 30W x 40H Centimeters\r\nSize	Standard\r\nBack Style	Solid Back', '7500.00', 50, '5999.00', 2, 6, 0),
(80, 1, 'Oaknest Unboxing Furniture OAKNEST Crystal Oversized Designer Indoor/Outdoor Plastic Chair for Home ', 'products/c10.jpg', 'products/c111.jpg', 'products/c112.jpg', '', '\r\nBrand	Oaknest Unboxing Furniture\r\nColour	Iron Black\r\nMaterial	Polypropylene\r\nProduct Dimensions	62D x 60.8W x 80.5H Centimeters\r\nSize	2\r\nSpecial Feature	Convertible', '2500.00', 50, '1999.00', 2, 6, 2),
(81, 3, 'iQOO Neo9 Pro 5G (Fiery Red, 8GB RAM, 256GB Storage) | Snapdragon 8 Gen 2 Processor | Supercomputing', 'products/m1.jpg', 'products/m11.jpg', 'products/m12.jpg', '', '\r\nBrand	iQOO\r\nModel Name	iQOO Neo9 Pro\r\nNetwork Service Provider	Unlocked for All Carriers\r\nOperating System	Funtouch OS 14 Based On Android 14\r\nCellular Technology', '38000.00', 100, '36000.00', 3, 9, 0),
(82, 3, 'Samsung Galaxy A34 5G (Awesome Violet, 8GB, 128GB Storage) | 48 MP No Shake Cam (OIS) | IP67 | Goril', 'products/m2.jpg', 'products/m22.jpg', 'products/m21.jpg', '', '\r\nBrand	Samsung\r\nModel Name	Samsung Galaxy A34 5G\r\nNetwork Service Provider	Unlocked for All Carriers\r\nOperating System	Android 13.0\r\nCellular Technology', '25000.00', 100, '23999.00', 3, 9, 1),
(83, 3, 'Motorola G34 5G (Ice Blue, 8GB RAM, 128GB Storage)', 'products/m3.jpg', 'products/m31.jpg', 'products/m32.jpg', '', '\r\nBrand	Motorola\r\nModel Name	Motorola G34 5G\r\nNetwork Service Provider	Unlocked for All Carriers\r\nOperating System	Android 13.0\r\nCellular Technology	5G\r\n', '25000.00', 50, '23999.00', 3, 9, 0),
(84, 3, 'Lava Storm 5G (Thunder Black, 8GB RAM, 128GB ROM), Premium Glass Back Design, MediaTek Dimensity 608', 'products/m4.jpg', 'products/m41.jpg', 'products/m42.jpg', '', '\r\nBrand	Lava\r\nModel Name	Lava Storm 5G\r\nNetwork Service Provider	Unlocked for All Carriers\r\nOperating System	Android 13.0\r\nCellular Technology	5G', '12000.00', 100, '10999.00', 3, 9, 0),
(90, 4, 'HEEBA GALLERY Wooden Stool-Natural Wood Antique Look Side Table with Drawer for Living Room (Brown, ', 'products/t3.jpg', 'products/t31.jpg', 'products/t32.jpg', '', 'Product Dimensions	30D x 30W x 38H Centimeters\r\nColour	Brown\r\nBrand	HEEBA GALLERY\r\nTable design	Coffee Table\r\nStyle	Antique\r\nBase Type	Leg', '2999.00', 100, '2699.00', 2, 7, 1),
(87, 4, 'CraftsX2Z Handmade Wooden Outdoor Adirondack 13 Inch Natural Brown Square Foldable Coffee Table, Pat', 'products/t1.jpg', 'products/t11.jpg', 'products/t12.jpg', '', 'CraftsX2Z Handmade Wooden Outdoor Adirondack 13 Inch Natural Brown Square Foldable Coffee Table, Patio End Table for Poolside Garden, Living Room, Bedroom, Small Spaces\r\n', '1500.00', 100, '1299.00', 2, 7, 0),
(89, 4, 'ZYNTIX Wooden Table Round Vase with 3-Leg Folding Stool 9-inch Centre Table for Living Room Wooden F', 'products/t21.jpg', 'products/t22.jpg', 'products/t23.jpg', '', '\r\nProduct Dimensions	23D x 23W x 24.5H Centimeters\r\nColour	Brown\r\nBrand	ZYNTIX\r\nTable design	End Table\r\nStyle	Modern\r\nBase Type	Legs\r\nTheme	Floral\r\nRecommended Uses For Product	Indoor\r\nFrame Material	Wood\r\nModel Name	ZYNTIX® Handmade Wooden Table Round Vase with 3-Leg Carving Brass Folding Stool 9 inch\r\n', '1500.00', 100, '1300.00', 2, 7, 1),
(91, 4, 'Unique Wood Store Antique Wooden Side Table/End Table/Stool/Cup Stool with Brass Work & Storage for ', 'products/t4.jpg', 'products/t41.jpg', 'products/t42.jpg', '', '\r\nProduct Dimensions	30.5D x 30.5W x 30.5H Centimeters\r\nBrand	Unique Wood Store\r\nTable design	End Table\r\nAge Range (Description)	Adult\r\nItem Weight	2999 Grams\r\nBase Material	Wood\r\nMaterial	Wood\r\nSpecific Uses For Product	living room', '1599.00', 100, '1499.00', 2, 7, 0),
(92, 4, 'KRAFTWORLD Wooden & Wrought Iron Stool/Side Table/Coffe Table for Living Room | Garden | Office | Re', 'products/t5.jpg', 'products/t51.jpg', '', '', '\r\nProduct Dimensions	28D x 28W x 38H Centimeters\r\nColour	Brown\r\nBrand	KRAFTWORLD\r\nTable design	Coffee Table\r\nStyle	Modern\r\nBase Type	Leg', '1599.00', 100, '1499.00', 2, 7, 0),
(93, 4, 'Aayat Enterprises Bedside Table/Coffee Table/End Table/Sofa Table and Shelf for Home & Office Living', 'products/t6.jpg', 'products/t61.jpg', '', '', '\r\nProduct Dimensions	30D x 30W x 30H Centimeters\r\nColour	Brown\r\nBrand	Aayat Enterprises\r\nTable design	Nightstand\r\nStyle	Antique\r\nSeating Capacity	1.00', '1499.00', 100, '1299.00', 2, 7, 0),
(94, 4, 'Wooden Mystique Folding Adjustable End Table Coffee Table Lamp Stand Plant Stand Outdoor Garden Stoo', 'products/t7.jpg', 'products/t71.jpg', 'products/t72.jpg', '', '\r\nProduct Dimensions	10D x 10W x 10H Centimeters\r\nColour	Brown\r\nBrand	Wooden Mystique\r\nTable design	Coffee Table\r\nStyle	Modern\r\nSeating Capacity	1.00\r\nFinish Type	Polished\r\nBase Type	Cross\r\nFrame Material	Wood, Pine Wood\r\nAge Range (Description)	Adult\r\n', '599.00', 100, '499.00', 2, 7, 1),
(95, 4, 'Green Soul® Allure Engineered Wood Coffee Table (Gold Cherry) | Center Table for Living Room in Sued', 'products/t8.jpg', 'products/t81.jpg', 'products/t82.jpg', '', '\r\nProduct Dimensions	50D x 90W x 35H Centimeters\r\nColour	Allure (GoldCherry)\r\nBrand	Green Soul\r\nTable design	Coffee Table\r\nStyle	Modern\r\nBase Type	Legs', '4999.00', 100, '3499.00', 2, 7, 3),
(96, 4, 'Anikaa Tuffy Engineered Wood Coffee Table/Centre Table/Tea Table for Living Room (Walnut White, Matt', 'products/t9.jpg', 'products/t91.jpg', 'products/t92.jpg', '', '\r\nProduct Dimensions	50D x 100W x 45H Centimeters\r\nColour	Wenge\r\nBrand	Anikaa\r\nTable design	Coffee Table\r\nStyle	Modern\r\nSeating Capacity	6.00', '1599.00', 100, '1499.00', 2, 7, 0),
(97, 4, 'Burlyworth Anayar Modern Centre Table with Storage, Tea & Coffee Table for Living Room, Engineered W', 'products/t10.jpg', 'products/t101.jpg', 'products/t102.jpg', '', 'Product Dimensions	44D x 99.5W x 45H Centimeters\r\nColour	Wenge & White\r\nBrand	Burlyworth\r\nTable design	Coffee Table\r\nStyle	Modern\r\nSeating Capacity	4.00', '1599.00', 100, '1499.00', 2, 7, 3),
(98, 4, 'RJKART MDF Wood Glass Top Center Coffee Table with Bottom Shelf Storage for Bedroom Living Room Home', 'products/tt.jpg', 'products/tt1.jpg', 'products/tt2.jpg', '', 'Colour	Black Finish\r\nBrand	RJKART\r\nTable design	Coffee Table\r\nStyle	Antique\r\nBase Type	Pedestal\r\nRecommended Uses For Product	dining', '10000.00', 50, '8999.00', 2, 7, 0),
(99, 4, 'Hariom Handicraft Furniture Sheesham Wood Coffee Table for Living Room | Center Table, with 4 Stools', 'products/tt3.jpg', 'products/tt4.jpg', 'products/tt5.jpg', '', '\r\nProduct Dimensions	86.4D x 86.4W x 45.7H Centimeters\r\nColour	Walnut Finish With Cream Cushions\r\nBrand	Hariom Handicraft\r\nTable design	Coffee Table\r\nStyle	Modern\r\nSeating Capacity	4.00', '11000.00', 40, '9999.00', 2, 7, 2),
(100, 4, 'Powermax Fitness TDM-96 (4 HP) for Home Use with LCD, BT App, Foldable Motorized Manual Treadmill', 'products/d1.jpg', 'products/d2.jpg', '', '', 'Motorized\r\nColor: Black\r\nFor Treadmill Push\r\nInclination Level 3\r\nMaximum Weight Support 100 kg\r\nDisplay Type: LCD\r\nFoldable\r\nSpeed: 12 km/h', '16000.00', 100, '14999.00', 1, 2, 0),
(101, 4, 'Fitkit by Cult.Sport FT801 4 in 1 Manual Multifunction Treadmill with (Jogger, Stepper, Twister, Pus', 'products/d11.jpg', 'products/d12.jpg', 'products/d13.jpg', '', '\r\nBrand	Fitkit\r\nColour	Black\r\nProduct Dimensions	70.9D x 24.8W x 55.1H Centimeters\r\nItem Weight	37 Kilograms\r\nMaterial	Stainless Steel', '12999.00', 45, '11999.00', 1, 2, 0),
(102, 4, 'Lifeline LFMANTRD4-1 Treadmill (Black)', 'products/d3.jpg', 'products/d31.jpg', 'products/d32.jpg', '', '\r\nBrand	Life Line\r\nColour	Black\r\nProduct Grade	Home\r\nItem Weight	50 Kilograms\r\nSpecial Feature	Foldable', '19999.00', 50, '18999.00', 1, 2, 1),
(103, 4, 'WalkingPad C2 Folding Treadmill Foldable Walking Pad Ultra Slim Smart Fold Free Installation Gym Run', 'products/d4.jpg', 'products/d41.jpg', '', '', '\r\nBrand	WALKINGPAD\r\nColour	Black\r\nProduct Grade	Home\r\nProduct Dimensions	145D x 52W x 12H Centimeters\r\nItem Weight	25 Kilograms', '36000.00', 50, '34999.00', 1, 2, 0),
(104, 4, 'Flexnest 2-in-1 Smart Foldable Treadmill - 2 Displays, Bluetooth Speaker, Installation Free, App + R', 'products/d5.jpg', 'products/d51.jpg', 'products/d52.jpg', 'products/d53.jpg', 'Brand	Flexnest\r\nColour	Black\r\nProduct Grade	Fitness\r\nProduct Dimensions	1.28D x 6.75W x 1.15H Meters\r\nItem Weight	40.8 Kilograms', '29999.00', 40, '28999.00', 1, 2, 1),
(105, 4, 'HACER HT02 Treadmill Walking Pad 2HP Electric Foldable Walking & Running Home Gym Workout Incline Ma', 'products/d6.jpg', 'products/d61.jpg', 'products/d62.jpg', 'products/d63.jpg', '\r\nBrand	HACER\r\nColour	Black\r\nProduct Grade	Home\r\nProduct Dimensions	120D x 54W x 105H Centimeters\r\nItem Weight	22 Kilograms', '35999.00', 25, '29999.00', 1, 2, 0),
(106, 4, 'Cockatoo C100AS-01 (100% Assembled) 1.5 HP Motorised Multi-Function Treadmill with G-Fit App Pairing', 'products/d7.jpg', 'products/d71.jpg', 'products/d72.jpg', '', '\r\nBrand	Cockatoo\r\nProduct Grade	Home\r\nItem Weight	50000 Grams\r\nSpecial Feature	Portable\r\nTarget Audience	All', '17999.00', 50, '16999.00', 1, 2, 1),
(107, 4, 'Kamachi 222 (2.75 HP PEAK) with Big LCD Displays Motorized Treadmill for Cardio Workout', 'products/d8.jpg', 'products/d81.jpg', 'products/d82.jpg', '', '\r\nBrand	KAMACHI\r\nColour	Black\r\nProduct Grade	Home\r\nItem Weight	80 Kilograms\r\nSpecial Feature	Folding', '25999.00', 150, '19999.00', 1, 2, 1),
(108, 4, 'Aerofit AF 417 2 Hp Dc Motorized Treadmill,Max User Weight: 110 Kgs,Elevation: 0% to 15%, Automatic,', 'products/d9.jpg', 'products/d91.jpg', 'products/d92.jpg', '', '\r\nBrand	Aerofit\r\nColour	Multicolor\r\nProduct Grade	Home\r\nProduct Dimensions	125D x 61W x 51H Centimeters\r\nMaterial	Alloy Steel', '18999.00', 50, '17999.00', 1, 2, 0),
(109, 4, 'Fitkit FT100 Series (3.25HP Peak) DC-Motorized Treadmill (Inclination: Manual, Max Weight: 110 Kg) w', 'products/d10.jpg', 'products/d111.jpg', 'products/d112.jpg', 'products/d113.jpg', 'Brand	Fitkit\r\nColour	Black\r\nProduct Grade	Home\r\nProduct Dimensions	161.5D x 68W x 127H Centimeters\r\nItem Weight	57 Kilograms', '24500.00', 40, '23999.00', 1, 2, 1),
(110, 4, 'Dr. Smith L Shape Sofa | 3 Seater + 3 Seater | Sofa Cum Bed/Mattress with 5 Printed Cushion Jute Fab', 'products/s1.jpg', 'products/s2.jpg', 'products/s11.jpg', '', 'Brand	Dr. Smith Orthopedic Mattress\r\nAssembly Required	No\r\nProduct Dimensions	182D x 152W x 20H Centimeters\r\nItem Weight	20 Kilograms\r\nType	Sleeper\r\nColour	Grey', '13999.00', 50, '12999.00', 2, 5, 0),
(111, 4, 'Modern Style 5 Seater-Sofa Cum Bed with Comfort Cushion (Right-Side)', 'products/s21.jpg', 'products/s22.jpg', 'products/s23.jpg', '', '\r\nBrand	Wooden Twist\r\nAssembly Required	No\r\nSeat Depth	57.2 Centimeters\r\nSeat Height	18 Inches\r\nWeight Limit	400 Kilograms\r\nProduct Dimensions	230D x 162W x 94H Centimeters', '50000.00', 20, '48999.00', 2, 5, 1),
(112, 4, 'FRESH UP 4 Seater Sofa Cum Bed Velvet Fabric 78x36x14 Inches Washable Cover with 4 Cushions (Maroon,', 'products/s3.jpg', 'products/s31.jpg', 'products/s32.jpg', '', '\r\nBrand	FRESH UP\r\nAssembly Required	No\r\nSeat Depth	55.9 Centimeters\r\nSeat Height	14 Inches\r\nProduct Dimensions	73.6D x 198W x 71H Centimeters\r\nItem Weight	17 Kilograms', '9999.00', 100, '8999.00', 2, 5, 1),
(114, 2, 'Apple iPhone 13 (128GB) - MidnightApple iPhone 13 (128GB) - Midnight', 'products/p1.jpg', 'products/p11.jpg', 'products/p12.jpg', '', '\r\nBrand	Apple\r\nModel Name	iPhone\r\nNetwork Service Provider	Unlocked for All Carriers\r\nOperating System	iOS 14', '49999.00', 100, '47999.00', 3, 9, 3),
(115, 2, 'Apple iPhone 14 (128 GB) - Blue', 'products/p2.jpg', 'products/p21.jpg', 'products/p22.jpg', '', '\r\nBrand	Apple\r\nModel Name	iPhone\r\nNetwork Service Provider	Unlocked for All Carriers\r\nOperating System	iOS\r\nCellular Technology	5G', '58999.00', 100, '55999.00', 3, 9, 2),
(116, 2, 'Oppo F25 Pro 5G (Lava Red, 8GB RAM, 256GB Storage) with No Cost EMI/Additional Exchange Offers', 'products/p3.jpg', 'products/p31.jpg', 'products/p32.jpg', '', '\r\nBrand	Oppo\r\nModel Name	F25 Pro 5G\r\nNetwork Service Provider	Unlocked for All Carriers\r\nOperating System	Android 14.0\r\nCellular Technology	5G', '26000.00', 100, '24999.00', 3, 9, 0),
(117, 2, 'Samsung Galaxy A35 5G (Awesome Lilac, 8GB RAM, 256GB Storage) | Premium Glass Back | 50 MP Main Came', 'products/p4.jpg', 'products/p41.jpg', 'products/p42.jpg', 'products/p43.jpg', '\r\nBrand	Samsung\r\nModel Name	Samsung Galaxy A35 5G\r\nNetwork Service Provider	Unlocked for All Carriers\r\nOperating System	Android 14.0\r\nCellular Technology	5G', '35999.00', 100, '33999.00', 3, 9, 0),
(3, 2, 'OnePlus Nord CE 3 5G (Aqua Surge, 8GB RAM, 128GB Storage)', 'products/x3.jpg', 'products/x31.jpg', 'products/x32.jpg', '', '\r\nBrand	OnePlus\r\nModel Name	Nord CE 3 Lite 5G\r\nNetwork Service Provider	Unlocked for All Carriers\r\nOperating System	OxygenOS\r\nCellular Technology	5G, 4G LTE', '25999.00', 50, '24999.00', 3, 9, 1),
(121, 2, 'Samsung Galaxy M52 5G (ICY Blue, 8GB RAM, 128GB Storage) Latest Snapdragon 778G 5G | sAMOLED 120Hz D', 'products/x4.jpg', 'products/x41.jpg', 'products/x42.jpg', '', '\r\nBrand	Samsung\r\nModel Name	Samsung Galaxy M52 5G\r\nNetwork Service Provider	Unlocked for All Carriers\r\nOperating System	Android 11.0\r\nCellular Technology	5G, 4G LTE', '25999.00', 100, '24999.00', 3, 9, 1),
(128, 1, 'Samsung 8 Kg, 5 Star, Eco Bubble Technology With Super Speed, Digital Inverter, Motor, Soft Closing ', 'products/lg61.jpg', 'products/lg62.jpg', 'products/lg63.jpg', 'products/lg64.jpg', '\r\nBrand	Samsung\r\nCapacity	8 Kilograms\r\nSpecial Feature	Inverter, Water Level 10.00\r\nAccess Location	Top Load\r\nFinish Type	Glass,Stainless Steel', '24999.00', 50, '23999.00', 3, 11, 0),
(129, 1, 'Panasonic 8 Kg Wifi Built-In Heater Fully-Automatic Top Load Smart Washing Machine (NA-F80AH1CRB,Cha', 'products/lg71.jpg', 'products/lg72.jpg', 'products/lg73.jpg', 'products/lg74.jpg', '\r\nProduct Dimensions	52.5D x 60.4W x 103.5H Centimeters\r\nBrand	Panasonic\r\nCapacity	8 Kilograms\r\nSpecial Feature	Built-In Heater, Big Lint Filter, 15 Wash Programs, Smart Washing Machine. Wifi and MirAie App Enabled, Voice Control, Compatible with Alexa, Effortless Washing with Stain GeniusBuilt-In Heater, Big Lint Filter, 15 Wash Programs, Smart Washing Machine. Wifi and MirAie App Enabled, Voice Control, Compatible with Alexa, Effortless Washing with Stain Genius\r\nAccess Location	Top Load', '25999.00', 100, '23999.00', 3, 11, 2),
(130, 1, 'LG 9 Kg 5 Star Wi-Fi Inverter AI Direct Drive Fully-Automatic Front Load Washing Machine with In-Bui', 'products/lg81.jpg', 'products/lg82.jpg', 'products/lg83.jpg', 'products/lg84.jpg', '\r\nCapacity	9 Kilograms\r\nColour	Middle Black\r\nBrand	LG\r\nProduct Dimensions	46D x 60W x 85H Centimeters\r\nSpecial Feature	Inverter, Child Lock, Auto Restart, Hygiene Steam, High Efficiency, Smart Connectivity, Delay Start, AI DD - intelligent & convenient fabric care, Inbuilt HeaterInverter, Child Lock, Auto Restart, Hygiene Steam, High Efficiency, Smart Connectivity, Delay Start, AI DD - intelligent & convenient fabric care, Inbuilt Heater\r\nCycle Options	Active Steam, Delicates, Baby Wear, Cotton, Allergen\r\nVoltage	230 Volts\r\nControls Type	Touch\r\nMaximum Rotational Speed	1200 RPM\r\nAccess Location	Front Load\r\n', '29999.00', 100, '27999.00', 3, 11, 0),
(131, 1, '   IFB 6 Kg 5 Star AI Powered Fully Automatic Front Load Washing Machine 2X Power Steam (DIVA AQUA G', 'products/lg91.jpg', 'products/lg92.jpg', 'products/lg93.jpg', 'products/lg94.jpg', 'Product Dimensions	51.3D x 59.8W x 87.5H Centimeters\r\nBrand	IFB\r\nCapacity	6 Kilograms\r\nSpecial Feature	Protective Rat Mesh, Aqua Energie, Child Lock, 2D Wash System, Memory Backup, Powered by AI, Inbuilt Heater, Laundry AddProtective Rat Mesh, Aqua Energie, Child Lock, 2D Wash System, Memory Backup, Powered by AI, Inbuilt Heater, Laundry Add\r\nAccess Location	Front Load', '28999.00', 100, '27999.00', 3, 11, 0),
(132, 1, 'KAKSS Alloy Steel Adjustable Dumbbell Set 10kg-50kg(Weight Plate + Dumbbell Rod) (10kg Steel Dumbbel', 'products/db1.jpg', '', '', '', '\r\nBrand	Kakss\r\nColour	Silver\r\nItem Weight	14 Kilograms\r\nMaterial	Alloy Steel\r\nSpecial Feature	Adjustable', '2599.00', 100, '2499.00', 1, 1, 1),
(133, 3, 'Leeway Rubber Coated Bouncer Dumbbell, (5kg Pair)| Professional Round Dumbbells, Dumbbell Set, Dumbb', 'products/db11.jpg', 'products/db12.jpg', 'products/db13.jpg', '', '\r\nBrand	LEEWAY\r\nColour	Black\r\nItem Weight	10000 Grams\r\nMaterial	Rubber\r\nSpecial Feature	Compact', '4999.00', 100, '3999.00', 1, 1, 0),
(135, 4, 'Sportneer Dumbbells Set For Home Gym 0.9/1.8/1.4/2.3 Kg Adjustable Iron Dumbbell Set Of 2 Hand Weigh', 'products/db31.jpg', 'products/db32.jpg', 'products/db33.jpg', 'products/db34.jpg', '\r\nBrand	Sportneer\r\nColour	Carbon Black\r\nItem Weight	4.54 Kilograms\r\nMaterial	Iron\r\nSpecial Feature	Adjustable', '7500.00', 50, '6999.00', 1, 1, 0),
(136, 4, 'XRT65 Adjustable Dumbbells Set of 2 | 2.5Kgs - 24Kgs | Gym Equipment Set for Home Workout | Designed', 'products/db42.jpg', 'products/db44.jpg', 'products/db41.jpg', '', '\r\nBrand	XRT65\r\nColour	Blue & Black\r\nItem Weight	48 Kilograms\r\nMaterial	Iron + Polypropylene + Nylon\r\nSpecial Feature	Adjustable,Compact', '10999.00', 100, '9999.00', 1, 1, 1),
(137, 4, 'The Cube Club Iron Dumbbells Set For Home Workout Gym Equipment With Anti-Slip Rod | 20Kg Cast Iron ', 'products/db51.jpg', 'products/db52.jpg', 'products/db53.jpg', 'products/db54.jpg', 'Brand	The Cube Club\r\nColour	Cast Iron 20 Kg\r\nItem Weight	20 Kilograms\r\nMaterial	Cast Iron\r\nSpecial Feature	With Plastic Case, Power Coat Finish', '10000.00', 50, '8999.00', 1, 1, 1),
(138, 1, 'Apple iPhone 14 Plus (512 GB) - (Product) REDApple iPhone 14 Plus (512 GB) - (Product) RED', 'products/mb1.jpg', 'products/mb2.jpg', '', '', 'Brand	Apple\r\nModel Name	iPhone\r\nNetwork Service Provider	Unlocked for All Carriers\r\nOperating System	iOS', '10000.00', 40, '9000.00', 3, 9, 2),
(139, 4, 'realme narzo 60 5G (Mars Orange,8GB+128GB) 90Hz Super AMOLED Display | Ultra Premium Vegan Leather D', 'products/8195A49fZbL._SX679_.jpg', 'products/91i6C64GLSL._SX679_.jpg', 'products/81R6aEDK5VL._SX679_.jpg', '', '\r\nBrand	realme\r\nModel Name	realme narzo 60 5G\r\nNetwork Service Provider	Unlocked for All Carriers\r\nOperating System	Android 13.0\r\nCellular Technology	5G', '15000.00', 100, NULL, 3, 9, 0);

-- --------------------------------------------------------

--
-- Table structure for table `report_issue`
--

DROP TABLE IF EXISTS `report_issue`;
CREATE TABLE IF NOT EXISTS `report_issue` (
  `issue_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`issue_id`),
  KEY `user_id` (`user_id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `report_issue`
--

INSERT INTO `report_issue` (`issue_id`, `user_id`, `product_id`, `description`, `timestamp`) VALUES
(1, 1, 10, 'bjkkjkjgl g', '2024-03-14 07:21:12');

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

DROP TABLE IF EXISTS `subcategories`;
CREATE TABLE IF NOT EXISTS `subcategories` (
  `subcategory_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`subcategory_id`),
  KEY `category_id` (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`subcategory_id`, `name`, `category_id`) VALUES
(1, 'DUMBBLE', 1),
(2, 'Treadmill ', 1),
(3, 'skipping rope', 1),
(5, 'sofa', 2),
(6, 'chair', 2),
(7, 'Table', 2),
(8, 'Microwave', 3),
(9, 'Mobile', 3),
(11, 'Washing Machine', 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `confirmed_email` tinyint(1) NOT NULL DEFAULT '0',
  `address` varchar(255) DEFAULT NULL,
  `verify_code` varchar(6) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `username`, `email`, `password`, `phone_number`, `gender`, `confirmed_email`, `address`, `verify_code`) VALUES
(23, 'Bhargav ', 'tiwari', 'bhargav123', 'bhargavtiwari6813@gmail.com', 'bhargav2004', '7623979323', 'Male', 1, 'pandesra', '160929'),
(21, 'vishal', 'saw', 'vishal', 'sawvishal2004@gmail.com', 'vishal2003', '987654321', 'Male', 1, 'Bamaroli', '829818'),
(19, 'yagnesh', 'prajapati', 'yagnesh', 'okyagnesh@gmail.com', 'yagnesh2003', '7778889990', 'Male', 1, 'Dindoli', '766126'),
(16, 'soham', 'dorge', 'soham', 'sohamdorge45@gmail.com', 'soham2003', '6351109347', 'Male', 1, 'Udhna', '932200'),
(22, 'Prasad', 'Patil', 'prasad123', 'patilprasad2824@gmail.com', 'prasad2003', '7896541230', 'Male', 1, 'Godadara', '819615'),
(18, 'chirag', 'Sharma', 'chirag', 'chiragsharma@gmail.com', 'chirag2004', '9979054870', 'Male', 1, 'Navagam', '234891');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

DROP TABLE IF EXISTS `vendors`;
CREATE TABLE IF NOT EXISTS `vendors` (
  `vendor_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `confirmed_email` tinyint(1) NOT NULL DEFAULT '0',
  `confirmed_vendor` tinyint(1) NOT NULL DEFAULT '0',
  `company_name` varchar(100) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `verify_code` int(11) NOT NULL,
  PRIMARY KEY (`vendor_id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`vendor_id`, `username`, `email`, `password`, `confirmed_email`, `confirmed_vendor`, `company_name`, `phone_number`, `address`, `verify_code`) VALUES
(1, 'Bharagav', 'bg@gmail.com', '12345678', 1, 1, 'bings', '9997778880', 'surat', 0),
(2, 'Yagnesh', 'okyagnesh@gmail.com', '12345678', 0, 1, 'dexon', '9997778880', 'dindoli', 0),
(3, 'Vishal saw', 'vishal@gmail.com', '12345678', 0, 1, 'vision care', '7778889990', 'Surat ', 0),
(4, 'prasad', 'soh@gmail.com', '12345678', 0, 1, 'zexon', '7778889990', 'Surat ', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
