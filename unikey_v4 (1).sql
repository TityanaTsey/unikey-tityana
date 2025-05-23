-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2025 at 08:03 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `unikey.v4`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

CREATE TABLE `administrator` (
  `id` int(11) NOT NULL,
  `fname` varchar(250) NOT NULL,
  `lname` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`id`, `fname`, `lname`, `email`, `password`) VALUES
(1, 'Admin', 'admin', 'admin@unikey.com', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `date` varchar(250) NOT NULL,
  `content` text NOT NULL,
  `description` text NOT NULL,
  `image` varchar(250) NOT NULL,
  `status` varchar(250) NOT NULL DEFAULT 'Available',
  `is_important` tinyint(1) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `category_id`, `title`, `date`, `content`, `description`, `image`, `status`, `is_important`, `created_at`) VALUES
(36, 6, 'Test', '2025-05-30', 'Tester', 'testing', 'Announcements_Images/1748008751_Screenshot_2025-03-18_151452.png', 'Available', 1, '2025-05-23 16:59:11');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `type` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `type`) VALUES
(1, 'Electronics', 'losts'),
(2, 'Clothes', 'losts'),
(3, 'Wallet', 'losts'),
(4, 'keys', 'losts'),
(5, 'Notebooks', 'losts'),
(6, 'General', 'events'),
(7, 'Events', 'events'),
(8, 'Admissions', 'events'),
(9, 'Graduate', 'events'),
(10, 'Media', 'events'),
(11, 'Accessories', 'losts'),
(14, 'personal Cards', 'losts'),
(16, 'Public Lectures ', 'events'),
(17, 'Workshops', 'events'),
(18, 'Seminars', 'events'),
(19, 'Training programs ', 'events'),
(20, 'Others', 'losts');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`) VALUES
(1, 'Faculty of Medicine'),
(2, 'Faculty of Dentistry'),
(3, 'Faculty of Pharmacy\r\n\r\n'),
(4, 'Faculty of Nursing\r\n\r\n'),
(5, 'Faculty of Engineering\r\n\r\n'),
(6, 'Faculty of Science\r\n\r\n'),
(7, 'King Abdullah II School for Information Technology'),
(8, 'Faculty of Agriculture\r\n\r\n'),
(9, 'Faculty of Rehabilitation Sciences\r\n\r\n'),
(10, 'Faculty of Arts\r\n\r\n\r\n'),
(11, 'Faculty of Foreign Languages\r\n\r\n'),
(12, 'Faculty of Sharia (Islamic Studies)\r\n\r\n'),
(13, 'Faculty of Educational Sciences\r\n\r\n'),
(14, 'Faculty of Law\r\n\r\n'),
(15, 'Faculty of Business\r\n\r\n'),
(16, 'Faculty of Archaeology and Tourism\r\n\r\n'),
(17, 'Faculty of Physical Education\r\n\r\n'),
(18, 'Faculty of Arts and Design\r\n\r\n'),
(19, 'School of Graduate Studies\r\n\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `location` varchar(250) NOT NULL,
  `supervisor` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(250) DEFAULT NULL,
  `date` varchar(250) NOT NULL,
  `count` int(11) NOT NULL,
  `status` varchar(191) NOT NULL DEFAULT 'Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `category_id`, `name`, `location`, `supervisor`, `description`, `image`, `date`, `count`, `status`, `created_at`) VALUES
(2, 8, 'Event 1', 'loc', 'supervisor', 'lorem lorem lorem lorem lorem lorem', NULL, '2025-05-04T22:44', 22, 'Deleted', '2025-05-04 19:44:22'),
(3, 1, 'sss', 'sss', 'ssss', 'ddd', 'Events_Images/1746388014_farmer.jpg', '2025-05-04T22:44', 2, 'Expired', '2025-05-04 19:46:54'),
(4, 7, 'Event 1222', 'loc', 'supervisor', 'description descriptiondescriptiondescription', 'Events_Images/1746388111_farmer.jpg', '2025-05-04T22:48', 22, 'Deleted', '2025-05-04 19:48:31'),
(5, 6, 'New Event 12222', 'here', 'sup', 'desc desc desc desc desc desc', 'Events_Images/1747235644_download.png', '2025-05-14T18:13', 5, 'Expired', '2025-05-14 15:14:04'),
(6, 7, 'test', 'it', 'rgjri', 'isfnei', 'Events_Images/1747338921_Screenshot_2025-02-23_231537.png', '2025-05-16T22:55', 2, 'Deleted', '2025-05-15 19:55:21'),
(7, 8, 'tjknf', 'skldfmskl', 'sdksmkl', 'sdklsmnlk', 'Events_Images/1747592746_web-app-manifest-512x512.png', '2025-05-22T21:25', 12, 'Active', '2025-05-18 18:25:46'),
(8, 6, 'test', 'sdfasd', 'sdffsdfsd', '12eq', 'Events_Images/1747755482_Screenshot_2025-02-23_223804.png', '2025-05-21T20:37', 2, 'Deleted', '2025-05-20 15:38:02'),
(9, 6, 'test', 'test', 'fsdf', '123', 'Events_Images/1747905522_Screenshot_2025-02-23_223804.png', '2025-05-23T12:18', 1, 'Active', '2025-05-22 09:18:42'),
(10, 6, 'tes', 'dgs', 'sadfsdf', '123', 'Events_Images/1747905698_Screenshot_2025-02-17_170436.png', '2025-05-22T12:22', 1, 'Active', '2025-05-22 09:21:38'),
(11, 6, 'test', 'kjkjkj', 'kjkjk', 'kjkjk', 'Events_Images/1748001810_Screenshot_2025-02-17_170436.png', '2025-05-23T15:05', 40, 'Active', '2025-05-23 12:03:30'),
(12, 9, 'new event', 'test', 'test', 'new event', 'Events_Images/1748001934_Screenshot_2025-02-17_170436.png', '2025-05-24T15:05', 2, 'Active', '2025-05-23 12:05:34');

-- --------------------------------------------------------

--
-- Table structure for table `lost_founds`
--

CREATE TABLE `lost_founds` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `place_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `image` varchar(250) NOT NULL,
  `type` varchar(250) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `last_seen_in` varchar(250) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `Description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `lost_founds`
--

INSERT INTO `lost_founds` (`id`, `category_id`, `place_id`, `student_id`, `name`, `image`, `type`, `status`, `last_seen_in`, `created_at`, `Description`) VALUES
(2, 4, 2, 2, 'Test 1', 'Losts_Images/images.jpeg', NULL, 3, NULL, '2025-05-14 17:26:15', ''),
(3, 2, 2, 2, 'tsst', 'Losts_Images/Screenshot 2025-02-23 223804.png', NULL, 3, NULL, '2025-05-15 19:48:41', ''),
(4, 2, 1, 1, 'test', 'Losts_Images/Screenshot 2025-02-17 195536.png', NULL, 3, NULL, '2025-05-15 20:03:03', ''),
(5, 2, 1, 1, 'tsey', 'Losts_Images/Screenshot 2025-03-04 013448.png', NULL, 3, NULL, '2025-05-15 20:11:39', ''),
(6, 2, 1, 1, 'rfr', 'Losts_Images/Screenshot 2025-04-13 225106.png', NULL, 3, NULL, '2025-05-17 06:29:05', ''),
(7, 2, 2, 1, 'fdgsd', 'Losts_Images/Screenshot 2025-02-23 231537.png', NULL, 3, NULL, '2025-05-17 06:36:51', ''),
(8, 2, 1, 1, 'test', 'Losts_Images/Screenshot 2025-02-17 195536.png', NULL, 3, NULL, '2025-05-17 09:02:37', ''),
(9, 1, 1, 1, 'asdsad', 'Losts_Images/Screenshot 2025-03-04 004418.png', NULL, 1, NULL, '2025-05-17 09:20:33', ''),
(10, 1, 1, 7, 'tester', 'Losts_Images/Screenshot 2025-03-18 151452.png', NULL, 3, NULL, '2025-05-17 17:07:09', ''),
(11, 1, 1, 1, 'fdjgkhkjfh', 'Losts_Images/Screenshot 2025-02-23 223206.png', NULL, 1, NULL, '2025-05-18 09:05:11', ''),
(12, 2, 1, 8, 'fysu', 'Losts_Images/Screenshot 2025-03-08 140539.png', NULL, 1, NULL, '2025-05-18 10:10:47', ''),
(13, 1, 1, 7, 'test', 'Losts_Images/favicon.ico', NULL, 3, NULL, '2025-05-18 13:15:16', ''),
(14, 1, 1, 7, '12', 'Losts_Images/favicon.ico', NULL, 3, NULL, '2025-05-18 13:37:08', ''),
(15, 2, 1, 7, 'tala', 'Losts_Images/favicon.ico', NULL, 3, NULL, '2025-05-18 13:44:49', ''),
(16, 2, 1, 7, 'tala', 'Losts_Images/Unikey(large).jpg', NULL, 3, NULL, '2025-05-18 13:59:12', 'hammami'),
(17, 1, 1, 7, 'iphone', 'Losts_Images/favicon.ico', NULL, 1, NULL, '2025-05-18 14:04:22', 'red'),
(18, 1, 1, 7, 'iphone', 'Losts_Images/favicon.ico', NULL, 3, NULL, '2025-05-18 14:08:10', 'red'),
(19, 1, 1, 7, 'iphone', 'Losts_Images/favicon.ico', NULL, 3, NULL, '2025-05-18 14:11:18', 'pink'),
(20, 2, 1, 11, 'dfsd', 'Losts_Images/Screenshot 2025-03-10 215345.png', NULL, 1, NULL, '2025-05-20 10:14:45', ''),
(21, 2, 1, 11, 'tityana', 'Losts_Images/Screenshot 2025-03-04 013448.png', NULL, 1, NULL, '2025-05-20 10:15:02', ''),
(22, 2, 1, 11, 'weam', 'Losts_Images/Screenshot 2025-03-18 151746.png', NULL, 3, NULL, '2025-05-20 10:40:01', ''),
(23, 1, 1, 11, 'fcvgbyvb', 'Losts_Images/Screenshot 2025-03-18 151452.png', NULL, 3, NULL, '2025-05-20 12:25:02', ''),
(24, 1, 3, 11, 'cdfvtgby6h', 'Losts_Images/Screenshot 2025-04-09 172726.png', NULL, 3, NULL, '2025-05-20 12:25:36', ''),
(25, 2, 3, 7, 'asdsad', 'Losts_Images/Screenshot 2025-03-04 004418.png', NULL, 1, NULL, '2025-05-20 20:33:05', ''),
(26, 1, 3, 7, 'yanal', 'Losts_Images/Screenshot 2025-03-08 160348.png', NULL, 1, NULL, '2025-05-20 20:36:05', 'yanal'),
(27, 1, 1, 7, 'i phone', 'Losts_Images/Screenshot 2025-03-04 004418.png', NULL, 1, NULL, '2025-05-22 04:04:37', 'pink'),
(28, 1, 2, 7, 'test', 'Losts_Images/Screenshot 2025-02-23 223804.png', NULL, 1, NULL, '2025-05-22 09:14:31', 'yfyfu'),
(29, 2, 2, 11, 'weam', 'Losts_Images/Screenshot 2025-02-23 231806.png', NULL, 1, NULL, '2025-05-22 09:30:33', 'fdsfs'),
(30, 1, 1, 7, 'yanal', 'Losts_Images/Screenshot 2025-03-18 233744.png', NULL, 1, NULL, '2025-05-23 12:20:36', 'yanallll');

-- --------------------------------------------------------

--
-- Table structure for table `majors`
--

CREATE TABLE `majors` (
  `id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `majors`
--

INSERT INTO `majors` (`id`, `department_id`, `name`) VALUES
(1, 1, ''),
(2, 7, 'computer science'),
(3, 7, 'computer information system'),
(4, 7, 'AI'),
(5, 7, 'business information technology'),
(6, 6, 'Physics'),
(7, 6, 'Chemistry'),
(8, 6, 'Mathematics'),
(9, 6, 'Biological Sciences\r\n\r\n'),
(10, 8, 'Animal Production\r\n\r\n'),
(11, 8, 'Horticulture and Crop Science\r\n\r\n'),
(12, 8, 'Plant Protection\r\n\r\n'),
(13, 8, 'Agricultural Economics and Agribusiness\r\n\r\n'),
(14, 8, 'Nutrition and Dietetics\r\n\r\n'),
(15, 8, 'Food Science and Technology\r\n\r\n'),
(16, 5, 'Civil Engineering\r\n\r\n'),
(17, 5, 'Electrical Engineering\r\n\r\n'),
(18, 5, 'Mechanical Engineering\r\n\r\n'),
(19, 5, 'Computer Engineering\r\n\r\n'),
(20, 5, 'Mechatronics Engineering\r\n\r\n'),
(21, 5, 'Industrial Engineering\r\n\r\n'),
(22, 10, 'Arabic Language and Literature\r\n\r\n'),
(23, 10, 'English Language and Literature\r\n\r\n'),
(24, 10, 'History'),
(25, 10, 'Geography'),
(26, 10, 'Philosophy'),
(27, 10, 'Psychology'),
(28, 15, 'Business Administration\r\n\r\n'),
(29, 15, 'Economics'),
(30, 15, 'Accounting'),
(31, 15, 'Marketing\r\n'),
(32, 15, 'Management Information Systems\r\n\r\n'),
(33, 15, 'Finance'),
(34, 15, 'Public Administration\r\n\r\n'),
(35, 12, 'Fundamentals of Religion\r\n\r\n'),
(36, 12, 'Jurisprudence and Its Foundations\r\n\r\n'),
(37, 12, 'Islamic Banking\r\n\r\n'),
(38, 13, 'Classroom Teacher\r\n\r\n'),
(39, 13, 'Child Education\r\n\r\n'),
(40, 13, 'Special Education\r\n\r\n'),
(41, 13, 'Library and Information Science\r\n\r\n'),
(42, 11, 'English Language\r\n\r\n\r\n'),
(43, 11, 'French Language\r\n\r\n'),
(44, 11, 'German Language\r\n\r\n'),
(45, 11, 'Spanish Language\r\n\r\n'),
(46, 11, 'Italian Language\r\n\r\n'),
(47, 11, 'Russian Language\r\n\r\n'),
(48, 11, 'Chinese Language\r\n\r\n'),
(49, 11, 'Turkish Language\r\n\r\n'),
(50, 18, 'Visual Arts\r\n\r\n'),
(51, 18, 'Music'),
(52, 18, 'Drama\r\n\r\n'),
(53, 16, 'Archaeology\r\n\r\n'),
(54, 16, 'Tourism Management\r\n\r\n'),
(55, 9, 'Physical Therapy\r\n\r\n'),
(56, 9, 'Occupational Therapy\r\n\r\n'),
(57, 9, 'Speech and Hearing Sciences\r\n\r\n'),
(58, 9, 'Orthotics and Prosthetics\r\n\r\n'),
(59, 7, 'data science'),
(60, 7, 'cyber security');

-- --------------------------------------------------------

--
-- Table structure for table `maps`
--

CREATE TABLE `maps` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `longitude` double NOT NULL,
  `latitude` double NOT NULL,
  `name` varchar(250) NOT NULL,
  `type` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `maps`
--

INSERT INTO `maps` (`id`, `student_id`, `longitude`, `latitude`, `name`, `type`) VALUES
(7, 7, 35.870959228691035, 32.02000703478084, 'Faculty of Educational Sciences Prayer Room', 'mosque');

-- --------------------------------------------------------

--
-- Table structure for table `marketplaces`
--

CREATE TABLE `marketplaces` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(250) NOT NULL,
  `status` varchar(191) NOT NULL DEFAULT 'Available',
  `intresets_counts` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `major` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `marketplaces`
--

INSERT INTO `marketplaces` (`id`, `student_id`, `department_id`, `name`, `description`, `image`, `status`, `intresets_counts`, `created_at`, `major`) VALUES
(25, 7, 1, 'test', 'tester', 'MarketPlaces_Images/Screenshot 2025-03-04 013448.png', 'Available', 0, '2025-05-23 12:56:30', NULL),
(26, 7, 7, 'yanal Kasit', 'kasit description', 'MarketPlaces_Images/Screenshot 2025-03-18 003843.png', 'Available', 0, '2025-05-23 12:57:10', 2);

-- --------------------------------------------------------

--
-- Table structure for table `marketplace_interestes`
--

CREATE TABLE `marketplace_interestes` (
  `id` int(11) NOT NULL,
  `marketplace_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `room_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `body` text NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `room_id`, `student_id`, `body`, `created`) VALUES
(36, 10, 1, 'test', '2025-05-17 16:29:18'),
(37, 10, 7, 'test', '2025-05-17 16:29:25'),
(38, 12, 7, 'test', '2025-05-17 17:04:23'),
(39, 13, 1, 'test', '2025-05-17 17:05:27'),
(40, 13, 1, 'nice', '2025-05-17 17:05:55'),
(41, 13, 7, 'okay', '2025-05-17 17:06:03'),
(42, 14, 1, 'lost items', '2025-05-17 17:07:38'),
(43, 10, 7, 'hello', '2025-05-17 17:16:16'),
(44, 10, 1, 'hi', '2025-05-17 17:16:38'),
(45, 11, 2, 'hi', '2025-05-18 09:04:05'),
(46, 10, 1, 'azayek', '2025-05-18 09:04:23'),
(47, 15, 2, 'hi', '2025-05-18 09:06:20'),
(48, 16, 2, '123', '2025-05-18 09:06:57'),
(49, 16, 1, 'hi', '2025-05-18 09:07:22'),
(50, 16, 2, 'تالا', '2025-05-18 09:08:12'),
(51, 16, 1, 'وئام', '2025-05-18 09:10:03'),
(52, 17, 8, 'hello', '2025-05-18 10:09:07'),
(53, 17, 1, 'hi', '2025-05-18 10:09:22'),
(54, 11, 7, 'hi', '2025-05-18 18:43:30'),
(55, 18, 11, 'hi', '2025-05-20 15:06:42'),
(56, 23, 6, 'hi', '2025-05-22 04:19:26'),
(57, 23, 7, 'hello', '2025-05-22 04:19:43'),
(58, 24, 7, 'test', '2025-05-22 05:55:30'),
(59, 28, 7, 'hi', '2025-05-22 09:30:48'),
(60, 28, 11, 'hi', '2025-05-22 09:31:12'),
(61, 28, 7, 'tester', '2025-05-23 11:46:42'),
(62, 10, 7, 'chaat', '2025-05-23 14:55:26'),
(63, 10, 7, 'ice cream', '2025-05-23 14:56:00'),
(64, 10, 7, 'ice cream :)', '2025-05-23 15:03:40'),
(65, 28, 7, 'test', '2025-05-23 16:58:20'),
(66, 28, 7, 'hi', '2025-05-23 17:09:56'),
(67, 28, 7, 'nice', '2025-05-23 17:10:11'),
(68, 14, 7, 'test', '2025-05-23 17:11:31'),
(69, 14, 7, 'nice', '2025-05-23 17:11:51'),
(70, 28, 7, 'test', '2025-05-23 17:12:56'),
(71, 28, 7, 'test', '2025-05-23 17:15:53'),
(72, 28, 7, 'hi', '2025-05-23 17:15:56'),
(73, 28, 7, 'nice', '2025-05-23 17:16:19'),
(74, 22, 6, 'test', '2025-05-23 17:17:05'),
(75, 22, 6, 'hi', '2025-05-23 17:17:26'),
(76, 22, 7, 'nice', '2025-05-23 17:17:36'),
(77, 22, 7, 'its working', '2025-05-23 17:17:46');

-- --------------------------------------------------------

--
-- Table structure for table `places`
--

CREATE TABLE `places` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `places`
--

INSERT INTO `places` (`id`, `name`) VALUES
(1, 'It'),
(2, 'Engineering'),
(3, 'Medicine'),
(4, ' Dentistry'),
(5, 'Business'),
(6, 'Arts'),
(7, 'Shari\'a'),
(8, 'Sciences'),
(9, 'Law');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `description` text DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `item_id` int(11) DEFAULT NULL,
  `market_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `title`, `description`, `created_by`, `created_at`, `item_id`, `market_id`) VALUES
(10, 'Chat regarding asdsad from tityana tsai ', 'Chat regarding asdsad From User #7', 7, '2025-05-17 16:28:58', 9, NULL),
(11, 'Chat regarding tester from tityana tsai ', 'Chat regarding tester From User #7', 7, '2025-05-17 16:56:36', NULL, NULL),
(12, 'Chat regarding cal from tityana tsai ', 'Chat regarding cal From User #7', 7, '2025-05-17 17:04:05', NULL, NULL),
(13, 'Chat regarding iphone from talaaaaaaq weamaaa ', 'Chat regarding iphone From User #1', 1, '2025-05-17 17:05:18', NULL, NULL),
(14, 'Chat regarding tester from talaaaaaaq weamaaa ', 'Chat regarding tester From User #1', 1, '2025-05-17 17:07:28', 10, NULL),
(15, 'Chat regarding iphone from Moh11 Maj ', 'Chat regarding iphone From User #2', 2, '2025-05-18 09:06:14', NULL, 26),
(16, 'Chat regarding cal from Moh11 Maj ', 'Chat regarding cal From User #2', 2, '2025-05-18 09:06:52', NULL, NULL),
(17, 'Chat regarding cal from abood almubaideen ', 'Chat regarding cal From User #8', 8, '2025-05-18 10:08:58', NULL, NULL),
(18, 'Chat regarding cal from Weam Atallah ', 'Chat regarding cal From User #11', 11, '2025-05-20 15:06:12', NULL, NULL),
(19, 'Chat regarding tester from Weam Atallah ', 'Chat regarding tester From User #11', 11, '2025-05-20 15:12:31', NULL, NULL),
(20, 'Chat regarding tester from tala hammami ', 'Chat regarding tester From User #6', 6, '2025-05-20 17:51:14', NULL, NULL),
(21, 'Chat regarding yutfguty from tityana tseyyy ', 'Chat regarding yutfguty From User #7', 7, '2025-05-22 04:02:28', NULL, NULL),
(22, 'Chat regarding iphone from tityana tseyyy ', 'Chat regarding iphone From User #7', 7, '2025-05-22 04:05:57', NULL, NULL),
(23, 'Chat regarding Test from tala hammami ', 'Chat regarding Test From User #6', 6, '2025-05-22 04:19:24', NULL, NULL),
(24, 'Chat regarding tityana from tityana tseyyy ', 'Chat regarding tityana From User #7', 7, '2025-05-22 05:55:27', 21, NULL),
(25, 'Chat regarding dfsd from tityana tseyyy ', 'Chat regarding dfsd From User #7', 7, '2025-05-22 05:55:41', 20, NULL),
(26, 'Chat regarding fdjgkhkjfh from tityana tseyyy ', 'Chat regarding fdjgkhkjfh From User #7', 7, '2025-05-22 05:55:49', 11, NULL),
(27, 'Chat regarding test from Weam Atallah ', 'Chat regarding test From User #11', 11, '2025-05-22 09:29:32', 28, NULL),
(28, 'Chat regarding weam from tityana tseyyy ', 'Chat regarding weam From User #7', 7, '2025-05-22 09:30:46', 29, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `room_members`
--

CREATE TABLE `room_members` (
  `room_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `joined_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `room_members`
--

INSERT INTO `room_members` (`room_id`, `student_id`, `joined_at`) VALUES
(10, 1, '2025-05-17 16:28:58'),
(10, 7, '2025-05-17 16:28:58'),
(11, 2, '2025-05-17 16:56:36'),
(11, 7, '2025-05-17 16:56:36'),
(12, 1, '2025-05-17 17:04:05'),
(12, 7, '2025-05-17 17:04:05'),
(13, 1, '2025-05-17 17:05:18'),
(13, 7, '2025-05-17 17:05:18'),
(14, 1, '2025-05-17 17:07:28'),
(14, 7, '2025-05-17 17:07:28'),
(15, 2, '2025-05-18 09:06:14'),
(15, 7, '2025-05-18 09:06:14'),
(16, 1, '2025-05-18 09:06:52'),
(16, 2, '2025-05-18 09:06:52'),
(17, 1, '2025-05-18 10:08:58'),
(17, 8, '2025-05-18 10:08:58'),
(18, 1, '2025-05-20 15:06:12'),
(18, 11, '2025-05-20 15:06:12'),
(19, 2, '2025-05-20 15:12:31'),
(19, 11, '2025-05-20 15:12:31'),
(20, 2, '2025-05-20 17:51:14'),
(20, 6, '2025-05-20 17:51:14'),
(21, 6, '2025-05-22 04:02:28'),
(21, 7, '2025-05-22 04:02:28'),
(22, 6, '2025-05-22 04:05:57'),
(22, 7, '2025-05-22 04:05:57'),
(23, 6, '2025-05-22 04:19:24'),
(23, 7, '2025-05-22 04:19:24'),
(24, 7, '2025-05-22 05:55:27'),
(24, 11, '2025-05-22 05:55:27'),
(25, 7, '2025-05-22 05:55:41'),
(25, 11, '2025-05-22 05:55:41'),
(26, 1, '2025-05-22 05:55:49'),
(26, 7, '2025-05-22 05:55:49'),
(27, 7, '2025-05-22 09:29:33'),
(27, 11, '2025-05-22 09:29:33'),
(28, 7, '2025-05-22 09:30:46'),
(28, 11, '2025-05-22 09:30:46');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `major_id` int(11) NOT NULL,
  `fname` varchar(250) NOT NULL,
  `lname` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `image` varchar(250) NOT NULL DEFAULT 'https://www.computerhope.com/jargon/g/guest-user.png',
  `otp_code` varchar(191) NOT NULL,
  `active` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `department_id`, `major_id`, `fname`, `lname`, `email`, `password`, `image`, `otp_code`, `active`, `created_at`) VALUES
(1, 1, 1, 'talaaaaaaq', 'weamaaa', 'test@gmail.com', '123', 'Students_Images/1747340243_avataaars_logo.png', '', 1, '2025-05-15 19:57:49'),
(2, 2, 2, 'Moh11', 'Maj', 'test@test.com', 'test.2020', 'Students_Images/1747242223_images.jpeg', '9571', 1, '2025-05-13 19:02:18'),
(6, 2, 2, 'tala', 'hammami', 'tal0217145@ju.edu.jo', '202cb962ac59075b964b07152d234b70', 'https://www.computerhope.com/jargon/g/guest-user.png', '3556', 1, '2025-05-17 10:27:40'),
(7, 1, 1, 'tityana', 'tseyyy', 'tyt0212873@ju.edu.jo', '202cb962ac59075b964b07152d234b70', 'https://www.computerhope.com/jargon/g/guest-user.png', '2686', 1, '2025-05-17 10:41:52'),
(8, 2, 2, 'abood', 'almubaideen', 'ABD0219440@ju.edu.jo', '81dc9bdb52d04dc20036dbd8313ed055', 'https://www.computerhope.com/jargon/g/guest-user.png', '9392', 0, '2025-05-18 10:06:35'),
(9, 2, 2, 'ibrahem', 'test', 'abr0211412@ju.edu.jo', '827ccb0eea8a706c4c34a16891f84e7b', 'https://www.computerhope.com/jargon/g/guest-user.png', '8817', 1, '2025-05-18 12:39:11'),
(10, 1, 1, 'mohannad ', 'shoushi', 'mhn0212666@ju.edu.jo', '81dc9bdb52d04dc20036dbd8313ed055', 'https://www.computerhope.com/jargon/g/guest-user.png', '', 1, '2025-05-19 06:52:50'),
(11, 2, 2, 'Weam', 'Atallah', 'waa0214045@ju.edu.jo', '81dc9bdb52d04dc20036dbd8313ed055', 'https://www.computerhope.com/jargon/g/guest-user.png', '9368', 1, '2025-05-20 09:42:47');

-- --------------------------------------------------------

--
-- Table structure for table `student_events`
--

CREATE TABLE `student_events` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `student_events`
--

INSERT INTO `student_events` (`id`, `student_id`, `event_id`) VALUES
(4, 2, 6),
(9, 2, 5),
(31, 7, 7),
(32, 7, 5),
(33, 7, 9),
(34, 11, 9),
(35, 11, 5),
(36, 7, 12);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrator`
--
ALTER TABLE `administrator`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_category_id_FK` (`category_id`);

--
-- Indexes for table `lost_founds`
--
ALTER TABLE `lost_founds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_lost_found_id_FK` (`student_id`),
  ADD KEY `category_lost_found_id_FK` (`category_id`),
  ADD KEY `place_lost_found_id_FK` (`place_id`);

--
-- Indexes for table `majors`
--
ALTER TABLE `majors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `major_dep_id_FK` (`department_id`);

--
-- Indexes for table `maps`
--
ALTER TABLE `maps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `marketplaces`
--
ALTER TABLE `marketplaces`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id_marketplace_FK` (`student_id`),
  ADD KEY `department_id_marketplace_FK` (`department_id`),
  ADD KEY `major_marketplace_FK` (`major`);

--
-- Indexes for table `marketplace_interestes`
--
ALTER TABLE `marketplace_interestes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `marketplace_id_FK` (`marketplace_id`),
  ADD KEY `student_id_FK_inter` (`student_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_msg_room` (`room_id`),
  ADD KEY `fk_msg_student` (`student_id`);

--
-- Indexes for table `places`
--
ALTER TABLE `places`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_rooms_creator` (`created_by`),
  ADD KEY `fk_rooms_item` (`item_id`),
  ADD KEY `fk_rooms_market` (`market_id`);

--
-- Indexes for table `room_members`
--
ALTER TABLE `room_members`
  ADD PRIMARY KEY (`room_id`,`student_id`),
  ADD KEY `fk_rm_student` (`student_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_departmen_id_FK` (`department_id`),
  ADD KEY `student_major_id_FK` (`major_id`);

--
-- Indexes for table `student_events`
--
ALTER TABLE `student_events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_event_id_FK` (`student_id`),
  ADD KEY `event_id_FK` (`event_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrator`
--
ALTER TABLE `administrator`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `lost_founds`
--
ALTER TABLE `lost_founds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `majors`
--
ALTER TABLE `majors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `maps`
--
ALTER TABLE `maps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `marketplaces`
--
ALTER TABLE `marketplaces`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `marketplace_interestes`
--
ALTER TABLE `marketplace_interestes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `places`
--
ALTER TABLE `places`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `student_events`
--
ALTER TABLE `student_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `event_category_id_FK` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `lost_founds`
--
ALTER TABLE `lost_founds`
  ADD CONSTRAINT `category_lost_found_id_FK` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `place_lost_found_id_FK` FOREIGN KEY (`place_id`) REFERENCES `places` (`id`),
  ADD CONSTRAINT `student_lost_found_id_FK` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`);

--
-- Constraints for table `majors`
--
ALTER TABLE `majors`
  ADD CONSTRAINT `major_dep_id_FK` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`);

--
-- Constraints for table `marketplaces`
--
ALTER TABLE `marketplaces`
  ADD CONSTRAINT `department_id_marketplace_FK` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`),
  ADD CONSTRAINT `major_marketplace_FK` FOREIGN KEY (`major`) REFERENCES `majors` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `student_id_marketplace_FK` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`);

--
-- Constraints for table `marketplace_interestes`
--
ALTER TABLE `marketplace_interestes`
  ADD CONSTRAINT `marketplace_id_FK` FOREIGN KEY (`marketplace_id`) REFERENCES `marketplaces` (`id`),
  ADD CONSTRAINT `student_id_FK_inter` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`);

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `fk_msg_room` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_msg_student` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `fk_rooms_creator` FOREIGN KEY (`created_by`) REFERENCES `students` (`id`),
  ADD CONSTRAINT `fk_rooms_item` FOREIGN KEY (`item_id`) REFERENCES `lost_founds` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_rooms_market` FOREIGN KEY (`market_id`) REFERENCES `marketplaces` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `room_members`
--
ALTER TABLE `room_members`
  ADD CONSTRAINT `fk_rm_room` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_rm_student` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `student_departmen_id_FK` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`),
  ADD CONSTRAINT `student_major_id_FK` FOREIGN KEY (`major_id`) REFERENCES `majors` (`id`);

--
-- Constraints for table `student_events`
--
ALTER TABLE `student_events`
  ADD CONSTRAINT `event_id_FK` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`),
  ADD CONSTRAINT `student_event_id_FK` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
