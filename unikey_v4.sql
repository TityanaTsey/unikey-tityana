-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2025 at 07:56 PM
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
  `is_important` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `category_id`, `title`, `date`, `content`, `description`, `image`, `status`, `is_important`) VALUES
(1, 6, 'Announcement2222', '2025-05-05', 'Content Content Content Content Content Content Content ', 'Desc Desc Desc Desc Desc Desc Desc ', 'Announcements_Images/1746472016_farmer.jpg', 'Deleted', 0),
(2, 6, 'important ann 11111', '2025-05-14', 'Content Content Content Content Content Content Content', 'desc desc desc desc desc desc', 'Announcements_Images/1747234236_driving.jpg', 'Available', 1),
(3, 6, 'ghvgh', '2025-05-16', 'bhbhjbhj', 'jnjnkj', 'Announcements_Images/1747339553_Screenshot_2025-02-17_171206.png', 'Deleted', 0),
(4, 6, 'test', '2025-05-20', 'fhwebfh', '11234', 'Announcements_Images/1747574488_favicon.ico', 'Deleted', 0),
(5, 7, 'test', '2025-05-19', 'tityana', '1234', 'Announcements_Images/1747574614_favicon.ico', 'Available', 1),
(6, 7, 'tala', '2025-05-22', 'sdfjnjk', 'dfhue', 'Announcements_Images/1747574775_favicon.ico', 'Available', 0);

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
(4, 'jacket', 'losts'),
(5, 'other', 'losts'),
(6, 'General', 'events'),
(7, 'Events', 'events'),
(8, 'Admissions', 'events'),
(9, 'Graduate', 'events'),
(10, 'Media', 'events');

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
(1, 'Dep 1'),
(2, 'Dep 2');

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
(6, 7, 'test', 'it', 'rgjri', 'isfnei', 'Events_Images/1747338921_Screenshot_2025-02-23_231537.png', '2025-05-16T22:55', 2, 'Deleted', '2025-05-15 19:55:21');

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
(19, 1, 1, 7, 'iphone', 'Losts_Images/favicon.ico', NULL, 3, NULL, '2025-05-18 14:11:18', 'pink');

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
(1, 1, 'Maj 1'),
(2, 2, 'Maj 2');

-- --------------------------------------------------------

--
-- Table structure for table `marketplaces`
--

CREATE TABLE `marketplaces` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(250) NOT NULL,
  `status` varchar(191) NOT NULL DEFAULT 'Available',
  `intresets_counts` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `marketplaces`
--

INSERT INTO `marketplaces` (`id`, `category_id`, `student_id`, `department_id`, `name`, `description`, `image`, `status`, `intresets_counts`, `created_at`) VALUES
(3, 3, 2, 2, 'market', 'desc desc desc desc', 'MarketPlaces_Images/images.jpeg', 'Expired', 1, '2025-05-14 18:47:49'),
(4, 2, 1, 2, 'tsey', 'jkndsjk', 'MarketPlaces_Images/Screenshot 2025-03-04 004418.png', 'Expired', 0, '2025-05-15 20:12:04'),
(5, 1, 1, 1, 'fushdu', 'sadkjadhj', 'MarketPlaces_Images/Screenshot 2025-02-23 231537.png', 'Expired', 1, '2025-05-15 20:42:58'),
(6, 2, 1, 2, 'tge4', 'ertret', 'MarketPlaces_Images/Screenshot 2025-03-08 140539.png', 'Expired', 0, '2025-05-17 06:30:53'),
(7, 2, 1, 2, 'efe', 'efe', 'MarketPlaces_Images/', 'Expired', 1, '2025-05-17 06:49:03'),
(8, 5, 1, 1, 'calculas', 'math', 'MarketPlaces_Images/Screenshot 2025-04-13 225106.png', 'Expired', 1, '2025-05-17 07:39:39'),
(9, 1, 1, 1, 'cal', 'math', 'MarketPlaces_Images/', 'Available', 0, '2025-05-17 07:46:16'),
(10, 1, 2, 1, 'arabic', '99', 'MarketPlaces_Images/', 'Expired', 0, '2025-05-17 07:46:50'),
(11, 1, 2, 1, 'tester', 'tester', 'MarketPlaces_Images/', 'Available', 0, '2025-05-17 09:16:04'),
(12, 1, 7, 1, 'iphone', 'iphone', 'MarketPlaces_Images/Screenshot 2025-03-18 145922.png', 'Expired', 0, '2025-05-17 17:05:09'),
(13, 2, 7, 1, 'iphone', 'hammami', 'MarketPlaces_Images/', 'Available', 0, '2025-05-18 14:43:24'),
(14, 1, 7, 1, '', '', 'MarketPlaces_Images/', 'Available', 0, '2025-05-18 14:45:32');

-- --------------------------------------------------------

--
-- Table structure for table `marketplace_interestes`
--

CREATE TABLE `marketplace_interestes` (
  `id` int(11) NOT NULL,
  `marketplace_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `marketplace_interestes`
--

INSERT INTO `marketplace_interestes` (`id`, `marketplace_id`, `student_id`) VALUES
(1, 3, 2),
(2, 5, 2),
(3, 7, 2),
(4, 8, 2);

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
(53, 17, 1, 'hi', '2025-05-18 10:09:22');

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
(1, 'place 1'),
(2, 'place 2');

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
(11, 'Chat regarding tester from tityana tsai ', 'Chat regarding tester From User #7', 7, '2025-05-17 16:56:36', NULL, 11),
(12, 'Chat regarding cal from tityana tsai ', 'Chat regarding cal From User #7', 7, '2025-05-17 17:04:05', NULL, 9),
(13, 'Chat regarding iphone from talaaaaaaq weamaaa ', 'Chat regarding iphone From User #1', 1, '2025-05-17 17:05:18', NULL, 12),
(14, 'Chat regarding tester from talaaaaaaq weamaaa ', 'Chat regarding tester From User #1', 1, '2025-05-17 17:07:28', 10, NULL),
(15, 'Chat regarding iphone from Moh11 Maj ', 'Chat regarding iphone From User #2', 2, '2025-05-18 09:06:14', NULL, 12),
(16, 'Chat regarding cal from Moh11 Maj ', 'Chat regarding cal From User #2', 2, '2025-05-18 09:06:52', NULL, 9),
(17, 'Chat regarding cal from abood almubaideen ', 'Chat regarding cal From User #8', 8, '2025-05-18 10:08:58', NULL, 9);

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
(17, 8, '2025-05-18 10:08:58');

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
(6, 2, 2, 'tala', 'hammami', 'tal0217145@ju.edu.jo', '202cb962ac59075b964b07152d234b70', 'https://www.computerhope.com/jargon/g/guest-user.png', '8946', 1, '2025-05-17 10:27:40'),
(7, 1, 1, 'tityana', 'tsey', 'tyt0212873@ju.edu.jo', '202cb962ac59075b964b07152d234b70', 'https://www.computerhope.com/jargon/g/guest-user.png', '4266', 1, '2025-05-17 10:41:52'),
(8, 2, 2, 'abood', 'almubaideen', 'ABD0219440@ju.edu.jo', '81dc9bdb52d04dc20036dbd8313ed055', 'https://www.computerhope.com/jargon/g/guest-user.png', '9392', 0, '2025-05-18 10:06:35'),
(9, 2, 2, 'ibrahem', 'test', 'abr0211412@ju.edu.jo', '827ccb0eea8a706c4c34a16891f84e7b', 'https://www.computerhope.com/jargon/g/guest-user.png', '8817', 1, '2025-05-18 12:39:11');

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
(9, 2, 5);

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
-- Indexes for table `marketplaces`
--
ALTER TABLE `marketplaces`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id_marketplace_FK` (`category_id`),
  ADD KEY `student_id_marketplace_FK` (`student_id`),
  ADD KEY `department_id_marketplace_FK` (`department_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `lost_founds`
--
ALTER TABLE `lost_founds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `majors`
--
ALTER TABLE `majors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `marketplaces`
--
ALTER TABLE `marketplaces`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `marketplace_interestes`
--
ALTER TABLE `marketplace_interestes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `places`
--
ALTER TABLE `places`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `student_events`
--
ALTER TABLE `student_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
  ADD CONSTRAINT `category_id_marketplace_FK` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `department_id_marketplace_FK` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`),
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
