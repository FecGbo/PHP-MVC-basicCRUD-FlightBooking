-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2025 at 06:05 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `flight`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrators`
--

CREATE TABLE `administrators` (
  `admin_id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `administrators`
--

INSERT INTO `administrators` (`admin_id`, `full_name`, `email`, `password`) VALUES
(1, 'admin', 'admin@gmail.com', '1234'),
(2, 'Kyaw Kyaw', 'gg@gmail.com', '$2y$10$Qvx5c3pflHtoXx0rAt4tuuIBoDC36fwXS4iyPOHswZlLqVHJ8RKaC'),
(3, 'MMA', 'mma@gmail.com', '$2y$10$gY1kc9JmwH2IGewZqmnchOkHBgT64dWkdHM9ew4w.r/p.UBcBiL22');

-- --------------------------------------------------------

--
-- Table structure for table `airlines`
--

CREATE TABLE `airlines` (
  `airline_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `code` varchar(10) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `logo_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `airlines`
--

INSERT INTO `airlines` (`airline_id`, `name`, `code`, `country`, `logo_url`) VALUES
(1, 'myanmarairline', 'QR', 'Qatar', 'images/air1.jpg'),
(3, 'Kyaw', 'kw', 'myamar', 'images/cat.jpg'),
(10, 'GG', 'EZ', 'Myanmar', 'images/background.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` int(11) NOT NULL,
  `traveler_id` int(11) NOT NULL,
  `flight_id` int(11) NOT NULL,
  `passenger_name` varchar(100) NOT NULL,
  `date_of_birth` date NOT NULL,
  `passport_number` varchar(20) DEFAULT NULL,
  `booking_date` datetime DEFAULT current_timestamp(),
  `confirmation_number` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT 'pending',
  `notification` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `traveler_id`, `flight_id`, `passenger_name`, `date_of_birth`, `passport_number`, `booking_date`, `confirmation_number`, `status`, `notification`) VALUES
(31, 14, 4, 'gfdsg', '2025-05-29', 'asdfsadf', '2025-05-20 13:09:00', 'A8A981AD', 'approved', NULL),
(32, 14, 4, 'gfdsg', '2025-05-29', 'asdfsadf', '2025-05-20 13:15:56', '48079591', 'approved', NULL),
(33, 14, 2, 'adfadfdsaf', '2025-05-20', 'asdf', '2025-05-20 13:20:06', '0209D033', 'approved', NULL),
(34, 14, 2, 'aaaa', '2025-05-20', 'aerwer123qerqweqwe', '2025-05-20 13:41:01', '0CA74267', 'approved', NULL),
(35, 14, 2, 'aaaa', '2025-05-20', 'aerwer123qerqweqwe', '2025-05-20 13:41:48', 'B69F4ECA', 'approved', NULL),
(36, 14, 2, 'aaaa', '2025-05-20', 'aerwer123qerqweqwe', '2025-05-20 13:46:01', '8B847709', 'approved', NULL),
(37, 14, 2, 'kjlk', '2025-05-21', 'hbvhmb', '2025-05-21 05:04:58', '873DAC43', 'approved', NULL),
(38, 14, 2, 'MMA', '2025-05-21', 'sdxvcvxcvxcv', '2025-05-21 05:17:38', '3F9A5F11', 'approved', NULL),
(39, 14, 2, 'QQ', '2025-05-21', 'dvxcvxcv', '2025-05-21 05:19:57', '1D42CD89', 'approved', NULL),
(40, 15, 4, 'asdfsadf', '2025-05-21', 'aerwer123', '2025-05-21 05:29:50', '2DF13882', 'approved', NULL),
(41, 15, 2, 'MgMG', '2025-05-06', 'asdfdsf', '2025-05-21 05:41:57', '2D874B2E', 'approved', 'Your booking has been approved.'),
(42, 15, 4, 'moemyint', '2025-05-21', 'asdfsadfwwer2', '2025-05-21 05:57:31', 'D798A2BA', 'approved', NULL),
(45, 15, 2, 'asdfsadf', '2025-05-21', 'asdfsdf', '2025-05-21 06:47:31', 'F5FD778D', 'approved', NULL),
(46, 14, 2, 'sdfasdfsdaf', '2025-05-22', 'asdfsadfsd', '2025-05-25 10:43:33', '3CA2BA73', 'approved', NULL),
(47, 14, 2, 'TestSeats', '2025-05-31', '122', '2025-05-25 11:00:22', '36E4E49C', 'approved', NULL),
(48, 14, 2, 'SEAT-1', '2025-05-31', 'SEAT-1', '2025-05-25 11:05:56', '51B9F1E4', 'approved', NULL),
(49, 14, 2, 'Test-noti', '2025-05-25', 'noti', '2025-05-25 16:05:02', '76626DD7', 'approved', 'Your booking has been approved.'),
(50, 14, 2, 'TestNOTI', '2025-05-25', 'asdfsdaf', '2025-05-25 16:13:56', '6061B8CC', 'approved', 'Your booking has been approved.'),
(51, 14, 2, 'TEst NOTI 3', '2025-05-25', 'asdf', '2025-05-25 16:36:44', '97D33DC8', 'approved', 'Your booking has been approved.'),
(52, 14, 2, 'NOTI 4', '2025-05-30', 'wqqewe', '2025-05-25 16:43:14', '96F5C41C', 'approved', 'Your booking has been approved.'),
(53, 14, 2, 'NOTI 99', '2025-05-31', 'asdfsaf', '2025-05-25 17:18:15', '9B7D2458', 'approved', 'Your booking has been approved.'),
(54, 14, 2, 'aaaa', '2025-05-27', 'asdfsdaf', '2025-05-25 17:30:14', 'B267E8DC', 'approved', 'Your booking has been approved.'),
(55, 17, 2, 'saber', '2025-05-25', 'asdfa', '2025-05-25 17:39:06', 'C8D5A31D', 'approved', NULL),
(58, 24, 6, 'adfadfdsaf', '2025-05-31', 'aerwer123', '2025-05-31 11:31:58', '95555086', 'approved', NULL),
(59, 24, 2, 'aasdf', '2025-05-31', 'asdfsdfs', '2025-05-31 18:15:18', 'C646438F', 'approved', NULL),
(60, 24, 2, 'Akar', '2025-06-01', 'akar123', '2025-06-01 06:12:47', 'BC57682E', 'approved', NULL),
(62, 24, 2, 'asdfsdaf', '2025-06-02', 'asdfsdf', '2025-06-02 03:49:28', '805D2696', 'approved', NULL),
(63, 24, 2, 'adsfasdf', '2025-06-02', 'asdfsadfwwer2', '2025-06-02 03:53:27', '4E12D1E9', 'approved', NULL),
(64, 24, 4, 'Akar', '2025-06-02', 'akar123', '2025-06-02 03:54:49', '5EED147B', 'approved', NULL),
(65, 24, 6, 'TestNoti', '2025-06-02', 'asdfa', '2025-06-02 04:11:33', 'A4FC1FC7', 'approved', NULL),
(66, 24, 2, 'asdf', '2025-06-02', 'asdfasdf', '2025-06-02 04:12:44', 'F5C2789B', 'approved', NULL),
(67, 24, 2, 'asdfsaf', '2025-06-02', 'asdfsa', '2025-06-02 04:16:36', '119EDABD', 'approved', NULL),
(68, 24, 2, 'adf', '2025-07-04', 'awerwerwe', '2025-06-02 04:21:14', '7E0F3D04', 'approved', NULL),
(69, 24, 3, 'MMA', '2025-06-18', 'asdf', '2025-06-02 04:22:13', '63471CC9', 'approved', NULL),
(70, 24, 2, 'MMA@', '2025-06-02', 'asdfsadf', '2025-06-02 04:24:55', '89846817', 'approved', NULL),
(71, 24, 2, 'asfd', '2025-06-02', 'asdf', '2025-06-02 04:34:11', 'B0BAB582', 'approved', NULL),
(72, 24, 2, 'asdf', '2025-06-08', 'asdfsaf', '2025-06-08 09:02:14', '016E4ECD', 'pending', NULL),
(74, 24, 3, 'asdfsa', '2025-06-08', 'asdfsadf', '2025-06-08 09:15:09', '71285E72', 'approved', NULL),
(75, 24, 6, 'asdfasf', '2025-06-08', 'adfssa', '2025-06-08 09:24:41', '1880E165', 'approved', NULL),
(76, 24, 4, 'Test-Bell', '2025-06-08', 'testBell-01', '2025-06-08 10:17:50', '2086B897', 'approved', NULL),
(77, 24, 14, 'asdfsadf', '2025-06-08', 'asdfsaf', '2025-06-08 15:01:52', '3AAF1331', 'approved', NULL),
(78, 24, 4, 'asdf', '2025-06-08', 'asdf', '2025-06-08 15:30:13', '339A101A', 'pending', NULL),
(79, 24, 4, 'asdfas', '2025-06-08', 'asdf', '2025-06-08 15:33:15', '26AB27B1', 'approved', NULL),
(80, 24, 4, 'asdfas', '2025-06-08', 'asdf', '2025-06-08 15:43:52', 'DE4EBE6C', 'pending', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `booking_approvals`
--

CREATE TABLE `booking_approvals` (
  `approval_id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `approval_status` enum('Approved','Rejected') NOT NULL,
  `approval_date` datetime DEFAULT current_timestamp(),
  `comments` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `confirmation_emails`
--

CREATE TABLE `confirmation_emails` (
  `email_id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `traveler_id` int(11) NOT NULL,
  `email_sent_date` datetime DEFAULT current_timestamp(),
  `email_status` enum('Sent','Failed') DEFAULT 'Sent'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `flights`
--

CREATE TABLE `flights` (
  `flight_id` int(11) NOT NULL,
  `airline` varchar(100) NOT NULL,
  `departure_city` varchar(100) NOT NULL,
  `destination_city` varchar(100) NOT NULL,
  `departure_time` varchar(100) NOT NULL,
  `arrival_time` varchar(100) NOT NULL,
  `Days` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `available_seats` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `flights`
--

INSERT INTO `flights` (`flight_id`, `airline`, `departure_city`, `destination_city`, `departure_time`, `arrival_time`, `Days`, `price`, `available_seats`) VALUES
(2, 'MyanmarAirLine', 'Yangon', 'Mandalay', '12:00 AM', '02:00 AM', 'Monday', 150000.00, 4),
(3, 'MyanmarAirLine', 'Yangon', 'TaungGyi', '10:00 AM', '01:00 AM', 'Tuesday', 250000.00, 9),
(4, 'JapanAirLine', 'Osaka', 'Tokyo', '9:00 AM', '11:00 AM', 'SUNDAY', 40000.00, 8),
(6, 'JapanAirLine', 'Yangon', 'Gonyan', '19:13', '20:13', 'Thusday', 12321321.00, 19),
(7, 'MyanamrAirLine', 'Yangon', 'GG', '21:05', '03:05', 'Thusday', 123.00, 22),
(10, 'YangonAirline', 'Yangon', 'GG', '12:32', '16:27', 'Thusday', 111.00, 11),
(11, 'GGAirline', 'Yangon', 'AA', '16:37', '18:36', 'Sunday', 11.00, 11),
(14, 'GG', 'GG', 'EZ', '20:50', '10:50', 'Wednesday', 100.00, 0),
(17, 'GG', 'Akar', 'Aung', '2025-06-08T19:43', '2025-06-09T19:43', 'Sunday', 100.00, 10),
(18, 'MyanmarAirline', 'Taung Gyi', 'Yangon', '2025-06-01T19:54', '2025-06-02T19:54', 'Thusday', 11.00, 11),
(19, 'MyanmarAirline', 'Yangon', 'Laydaman', '2025-06-11T19:55', '2025-06-11T20:55', 'Wednesday', 2000.00, 30);

-- --------------------------------------------------------

--
-- Table structure for table `flight_details`
--

CREATE TABLE `flight_details` (
  `detail_id` int(11) NOT NULL,
  `flight_id` int(11) DEFAULT NULL,
  `aircraft_type` varchar(50) DEFAULT NULL,
  `gate_number` varchar(10) DEFAULT NULL,
  `duration` varchar(20) DEFAULT NULL,
  `meal` varchar(50) DEFAULT NULL,
  `in_flight_entertainment` varchar(100) DEFAULT NULL,
  `wifi_available` varchar(100) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `flight_details`
--

INSERT INTO `flight_details` (`detail_id`, `flight_id`, `aircraft_type`, `gate_number`, `duration`, `meal`, `in_flight_entertainment`, `wifi_available`, `notes`, `image_url`) VALUES
(1, 2, 'BOBO', '2A', '365Day', 'no meal', '0', '1', 'enjoy', 'images/air1.jpg'),
(2, 4, 'KOKO', '2K', '2 hours', 'no meal', 'not available', 'not available', 'Welcome.', 'images/air2.jpg'),
(3, 3, 'BOBO', '1A', '2 hours', 'no meal', 'not available', 'not available', '🫂🫂🫂🫂🫂🫂🫂🫂🫂🫂🫂🫂🫂🫂', 'images/air2.jpg'),
(4, 6, 'MIC', '2Z', '5 hours', 'no meal', 'not available', 'not available', '🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼', 'images/air2.jpg'),
(5, 7, 'BOBO', '2K', '2 hours', 'no meal', 'not available', 'not available', '🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼🫰🏼', 'images/air1.jpg'),
(6, 2, 'aa', 'asdfsaa', 'asdfsadfa', 'sd', 'dfsa', 'asdfasdf', 'asdfasf', 'asdfas'),
(7, 19, 'GG', 'GG', 'GG', 'GG', 'GG', 'GG', 'GGGGGG', 'asdfas');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_method` enum('Credit Card','Debit Card','PayPal','Other') NOT NULL,
  `payment_status` enum('Pending','Completed','Failed') DEFAULT 'Pending',
  `payment_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `booking_id`, `amount`, `payment_method`, `payment_status`, `payment_date`) VALUES
(1, 31, 0.00, 'Debit Card', 'Completed', '2025-05-20 17:40:43'),
(3, 32, 40000.00, 'Credit Card', 'Completed', '2025-05-20 17:46:05'),
(4, 33, 150000.00, 'Credit Card', 'Completed', '2025-05-20 17:50:13'),
(5, 35, 150000.00, 'PayPal', 'Completed', '2025-05-20 18:12:45'),
(7, 36, 150000.00, 'Credit Card', 'Completed', '2025-05-20 18:16:08'),
(8, 37, 150000.00, 'PayPal', 'Completed', '2025-05-21 09:35:10'),
(9, 39, 150000.00, 'Credit Card', 'Completed', '2025-05-21 09:50:10'),
(10, 40, 40000.00, 'PayPal', 'Failed', '2025-05-21 10:00:53'),
(11, 41, 150000.00, 'Credit Card', 'Failed', '2025-05-21 10:12:02'),
(12, 42, 40000.00, 'Credit Card', 'Failed', '2025-05-21 10:27:35'),
(16, 46, 150000.00, 'Credit Card', 'Completed', '2025-05-25 15:13:40'),
(17, 47, 150000.00, 'Credit Card', 'Completed', '2025-05-25 15:30:29'),
(18, 48, 150000.00, 'Credit Card', 'Completed', '2025-05-25 15:36:14'),
(19, 49, 150000.00, 'Credit Card', 'Completed', '2025-05-25 20:35:07'),
(20, 50, 150000.00, 'Credit Card', 'Completed', '2025-05-25 20:44:01'),
(21, 51, 150000.00, 'Credit Card', 'Completed', '2025-05-25 21:06:48'),
(22, 52, 150000.00, 'Credit Card', 'Completed', '2025-05-25 21:13:18'),
(23, 53, 150000.00, 'Credit Card', 'Completed', '2025-05-25 21:48:19'),
(24, 54, 150000.00, 'Credit Card', 'Completed', '2025-05-25 22:00:18'),
(25, 55, 150000.00, 'Credit Card', 'Completed', '2025-05-25 22:09:13'),
(28, 58, 12321321.00, 'Credit Card', 'Completed', '2025-05-31 16:02:05'),
(29, 60, 150000.00, 'Debit Card', 'Completed', '2025-06-01 10:43:02'),
(31, 62, 150000.00, 'Credit Card', 'Completed', '2025-06-02 08:19:59'),
(32, 63, 150000.00, 'Credit Card', 'Completed', '2025-06-02 08:23:31'),
(33, 64, 40000.00, 'Credit Card', 'Completed', '2025-06-02 08:25:00'),
(34, 65, 12321321.00, 'Credit Card', 'Completed', '2025-06-02 08:41:37'),
(35, 66, 150000.00, 'Credit Card', 'Completed', '2025-06-02 08:42:49'),
(36, 67, 150000.00, 'Credit Card', 'Completed', '2025-06-02 08:46:40'),
(37, 68, 150000.00, 'Credit Card', 'Completed', '2025-06-02 08:51:18'),
(38, 69, 250000.00, 'Credit Card', 'Completed', '2025-06-02 08:52:16'),
(39, 70, 150000.00, 'Other', 'Completed', '2025-06-02 08:55:01'),
(40, 71, 150000.00, 'Credit Card', 'Completed', '2025-06-02 09:04:15'),
(42, 74, 250000.00, 'Credit Card', 'Completed', '2025-06-08 13:45:13'),
(43, 75, 12321321.00, 'Credit Card', 'Completed', '2025-06-08 13:54:44'),
(44, 76, 40000.00, 'Credit Card', 'Completed', '2025-06-08 14:47:55'),
(45, 77, 100.00, 'Credit Card', 'Completed', '2025-06-08 19:31:56'),
(46, 78, 40000.00, 'Credit Card', 'Completed', '2025-06-08 20:00:17'),
(48, 79, 40000.00, 'Credit Card', 'Completed', '2025-06-08 20:03:19'),
(62, 80, 40000.00, 'Credit Card', 'Completed', '2025-06-08 20:13:55');

-- --------------------------------------------------------

--
-- Table structure for table `travelers`
--

CREATE TABLE `travelers` (
  `traveler_id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `contact_number` varchar(15) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `travelers`
--

INSERT INTO `travelers` (`traveler_id`, `full_name`, `email`, `password`, `contact_number`, `created_at`) VALUES
(1, 'Moe Myint Aung', 'mma@gmail.com', '1234', '123456789', '2025-05-15 20:13:22'),
(4, 'Kyaw Kyaw', 'aaaa@gmail.com', '23423423', '12321312312', '2025-05-15 16:42:39'),
(5, 'werewr', 'wer@gmail.com', '123123', '123213', '2025-05-15 16:49:11'),
(6, 'Mg Mg', 'mgmg@gmail.com', '$2y$10$XF0WYBsSdOG/b6/m8Ouzd.viU28rgC/MY.2CdFJuuY/zk2FeKeQEu', '12321312312', '2025-05-16 03:55:53'),
(7, 'werewr', 'koo@gmail.com', '$2y$10$l33.nxLhZTTzOlXhng1Dhe4uPqZLYJ2yNoRDd8IdcV8P6tOxNDNoW', '12321312312', '2025-05-18 12:34:28'),
(9, 'werewr', 'aa@gmail.com', '$2y$10$DFLVh8kwjVJ8XQdvzllLsuF0Y/GS8fjVS5fsymH5DQ2II5AvglR1e', '12321312312', '2025-05-18 12:37:06'),
(10, 'adfasdf', 'hlahla@gmail.com', '$2y$10$haEOclLjTFq7n4vr5706n.QpHLMgHQqBHeLSX75AUsu1pjp3KZnL.', '123123123123', '2025-05-18 12:39:28'),
(12, 'adfasdf', 'hlaha@gmail.com', '$2y$10$Y.CR0rVsDpRugUnOgo8FbOWahJkqgSuXQJcCdFgNQDAeVtQVx/Day', '123123123123', '2025-05-18 12:44:25'),
(13, 'adfasdf', 'ha@gmail.com', '$2y$10$8pFy8NJJ20rhXLLez7b0Su4tSbsiY/GV8SdFgGJzU/cRiyMp2ks5O', '123123123123', '2025-05-18 12:45:32'),
(14, 'werewr', 'gg@gmail.com', '$2y$10$.OiSZsB/dhl0AcYrRomSG.3geL8wJm0xm.jBaKevZjN6CD9j9dNn2', '1234', '2025-05-19 04:41:56'),
(15, 'Mg Mg', 'email@email.com', '$2y$10$U4JZcF8S7IerW1FTVqiJweaw/X.irj/6HgCDiMLygCPScoJsIjX72', 'asdfsdf', '2025-05-21 05:25:48'),
(17, 'aaaa', 'saber@gmail.com', '$2y$10$HLij5IUeBuaBP8ym/u1GouUzjFFkmd54IbRkYAalvyB7Egpia./Y2', '1111', '2025-05-25 17:38:44'),
(18, 'john', '', '$2y$10$9VzY1aEzKlV.jkICcuw3TeXAC5hIV506l.QIo.PwXYRM1PYFkEWSO', '', '2025-05-30 03:30:54'),
(22, 'MMA', 'aka@gmail.com', '$2y$10$Ht2wc93k.FBOX6uv9VUICeQ3t97iV1FhBas8xGsjVt6qA89/gtgj2', '11111111', '2025-05-31 13:32:00'),
(24, 'MMA', 'akar@gmail.com', '$2y$10$RlUsJ4jTkIwtXaPAzKtljO5Ajgoo6ibV35h.5hHmhWjb./25oCDXG', '11111111', '2025-05-31 13:32:00'),
(25, 'afd', 'moemyintaung@gmail.com', '$2y$10$U8joWRZVieRPzDhAqTqbsuHfMQWWvo92MaXjQtZpY3MEzLfmyU3LG', '111111111111', '2025-05-31 13:55:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrators`
--
ALTER TABLE `administrators`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `airlines`
--
ALTER TABLE `airlines`
  ADD PRIMARY KEY (`airline_id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`),
  ADD UNIQUE KEY `confirmation_number` (`confirmation_number`),
  ADD KEY `traveler_id` (`traveler_id`),
  ADD KEY `flight_id` (`flight_id`);

--
-- Indexes for table `booking_approvals`
--
ALTER TABLE `booking_approvals`
  ADD PRIMARY KEY (`approval_id`),
  ADD KEY `booking_id` (`booking_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `confirmation_emails`
--
ALTER TABLE `confirmation_emails`
  ADD PRIMARY KEY (`email_id`),
  ADD KEY `booking_id` (`booking_id`),
  ADD KEY `traveler_id` (`traveler_id`);

--
-- Indexes for table `flights`
--
ALTER TABLE `flights`
  ADD PRIMARY KEY (`flight_id`);

--
-- Indexes for table `flight_details`
--
ALTER TABLE `flight_details`
  ADD PRIMARY KEY (`detail_id`),
  ADD KEY `flight_id` (`flight_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD UNIQUE KEY `booking_id` (`booking_id`);

--
-- Indexes for table `travelers`
--
ALTER TABLE `travelers`
  ADD PRIMARY KEY (`traveler_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrators`
--
ALTER TABLE `administrators`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `airlines`
--
ALTER TABLE `airlines`
  MODIFY `airline_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `booking_approvals`
--
ALTER TABLE `booking_approvals`
  MODIFY `approval_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `confirmation_emails`
--
ALTER TABLE `confirmation_emails`
  MODIFY `email_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `flights`
--
ALTER TABLE `flights`
  MODIFY `flight_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `flight_details`
--
ALTER TABLE `flight_details`
  MODIFY `detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `travelers`
--
ALTER TABLE `travelers`
  MODIFY `traveler_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`traveler_id`) REFERENCES `travelers` (`traveler_id`),
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`flight_id`) REFERENCES `flights` (`flight_id`);

--
-- Constraints for table `booking_approvals`
--
ALTER TABLE `booking_approvals`
  ADD CONSTRAINT `booking_approvals_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`booking_id`),
  ADD CONSTRAINT `booking_approvals_ibfk_2` FOREIGN KEY (`admin_id`) REFERENCES `administrators` (`admin_id`);

--
-- Constraints for table `confirmation_emails`
--
ALTER TABLE `confirmation_emails`
  ADD CONSTRAINT `confirmation_emails_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`booking_id`),
  ADD CONSTRAINT `confirmation_emails_ibfk_2` FOREIGN KEY (`traveler_id`) REFERENCES `travelers` (`traveler_id`);

--
-- Constraints for table `flight_details`
--
ALTER TABLE `flight_details`
  ADD CONSTRAINT `flight_details_ibfk_1` FOREIGN KEY (`flight_id`) REFERENCES `flights` (`flight_id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`booking_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
