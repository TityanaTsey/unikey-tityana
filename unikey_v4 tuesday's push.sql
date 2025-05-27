-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2025 at 03:45 PM
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
(36, 6, 'Test', '2025-05-30', 'Tester', 'testing', 'Announcements_Images/1748008751_Screenshot_2025-03-18_151452.png', 'Deleted', 1, '2025-05-23 16:59:11'),
(37, 18, 'fsdfsdf', '2025-05-25', 'fdsfsdf', 'fsdfsdf', 'Announcements_Images/1748197933_Screenshot_2025-02-17_170436.png', 'Deleted', 1, '2025-05-25 21:32:13'),
(38, 17, 'skdsajdjsak', '2025-05-25', 'ksadksajdk', 'kdsjdksajd', 'Announcements_Images/1748198083_Screenshot_2025-02-17_170436.png', 'Deleted', 1, '2025-05-25 21:34:43'),
(39, 6, 'dsaasd', '2025-05-25', 'dasddasd', 'dasdas', 'Announcements_Images/1748198501_Screenshot_2025-02-17_170436.png', 'Deleted', 1, '2025-05-25 21:41:41'),
(40, 6, 'asdsadas', '2025-05-25', 'asdasdsa', 'asdasdas', 'Announcements_Images/1748199516_Screenshot_2025-02-17_170436.png', 'Deleted', 1, '2025-05-25 21:58:36'),
(41, 6, 'asdsadsa', '2025-05-25', 'asdsadsad', 'dsadasd', 'Announcements_Images/1748199563_Screenshot_2025-02-17_170436.png', 'Deleted', 1, '2025-05-25 21:59:23'),
(42, 17, 'asdsadsa', '2025-05-25', 'dasdasdsa', 'dasdasd', 'Announcements_Images/1748199828_Screenshot_2025-02-17_170436.png', 'Deleted', 1, '2025-05-25 22:03:48'),
(43, 9, 'Graduation', '2025-05-26', 'celebrate graduation', '2025', 'Announcements_Images/1748200494_download.jpg', 'Available', 1, '2025-05-25 22:14:54'),
(44, 19, 'web development ', '2025-05-26', 'web development by dr ', 'kasit team', 'Announcements_Images/1748200632_7d3b77fe962d82e1197990112db44c2f.jpg', 'Available', 1, '2025-05-25 22:17:12'),
(45, 10, 'test', '2025-05-26', '12', '11', 'Announcements_Images/1748207218_8ee791a077bc1ae19ca3c9b29ff46d8f.jpg', 'Deleted', 0, '2025-05-26 00:06:58'),
(46, 7, 'test', '2025-05-27', 'testing', 'test', 'Announcements_Images/1748255504_iphone13.....jpg', 'Available', 1, '2025-05-26 13:31:44');

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
(3, 1, 'sss', 'sss', 'ssss', 'ddd', 'Events_Images/1746388014_farmer.jpg', '2025-05-04T22:44', 2, 'Deleted', '2025-05-04 19:46:54'),
(4, 7, 'Event 1222', 'loc', 'supervisor', 'description descriptiondescriptiondescription', 'Events_Images/1746388111_farmer.jpg', '2025-05-04T22:48', 22, 'Deleted', '2025-05-04 19:48:31'),
(5, 6, 'New Event 12222', 'here', 'sup', 'desc desc desc desc desc desc', 'Events_Images/1747235644_download.png', '2025-05-14T18:13', 5, 'Deleted', '2025-05-14 15:14:04'),
(6, 7, 'test', 'it', 'rgjri', 'isfnei', 'Events_Images/1747338921_Screenshot_2025-02-23_231537.png', '2025-05-16T22:55', 2, 'Deleted', '2025-05-15 19:55:21'),
(7, 8, 'tjknf', 'skldfmskl', 'sdksmkl', 'sdklsmnlk', 'Events_Images/1747592746_web-app-manifest-512x512.png', '2025-05-22T21:25', 12, 'Deleted', '2025-05-18 18:25:46'),
(8, 6, 'test', 'sdfasd', 'sdffsdfsd', '12eq', 'Events_Images/1747755482_Screenshot_2025-02-23_223804.png', '2025-05-21T20:37', 2, 'Deleted', '2025-05-20 15:38:02'),
(9, 6, 'test', 'test', 'fsdf', '123', 'Events_Images/1747905522_Screenshot_2025-02-23_223804.png', '2025-05-23T12:18', 1, 'Deleted', '2025-05-22 09:18:42'),
(10, 6, 'tes', 'dgs', 'sadfsdf', '123', 'Events_Images/1747905698_Screenshot_2025-02-17_170436.png', '2025-05-22T12:22', 1, 'Deleted', '2025-05-22 09:21:38'),
(11, 6, 'test', 'kjkjkj', 'kjkjk', 'kjkjk', 'Events_Images/1748001810_Screenshot_2025-02-17_170436.png', '2025-05-23T15:05', 40, 'Deleted', '2025-05-23 12:03:30'),
(12, 9, 'new event', 'test', 'test', 'new event', 'Events_Images/1748001934_Screenshot_2025-02-17_170436.png', '2025-05-24T15:05', 2, 'Deleted', '2025-05-23 12:05:34'),
(13, 7, 'The International Conference of the School of Pharmacy', 'School of Pharmacy', 'the university of jordan', 'Shaping the Future of Pharmacy: Empowering Education, Training, and Innovation through Artificial Intelligence', 'Events_Images/1748200924_8ee791a077bc1ae19ca3c9b29ff46d8f.jpg', '2025-07-30T10:20', 30, 'Deleted', '2025-05-25 19:22:04'),
(14, 6, 'The Annual Graduate Studies Conference', 'Deanship of Student Affairs', 'the School of Graduate Studies', 'aims to enhance scientific research and develop academic and professional skills among postgraduate students. The conference provides a platform for showcasing innovative scientific research and works that play an effective role in community development and contribute to sustainable development.', 'Events_Images/1748201133_c85793cc309c0b82e20138f47625b803.jpg', '2025-05-27T22:24', 100, 'Active', '2025-05-25 19:25:33');

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
(32, 1, 1, 7, 'iphone', 'Losts_Images/iphone13.....jpg', NULL, 1, NULL, '2025-05-25 14:57:57', 'black'),
(33, 4, 5, 6, 'key', 'Losts_Images/CAR.jpg', NULL, 1, NULL, '2025-05-25 15:01:50', 'MERCEDES'),
(34, 1, 1, 7, 'iphone', 'Losts_Images/Screenshot 2025-02-17 170436.png', NULL, 3, NULL, '2025-05-27 08:27:32', 'purple');

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
(9, 7, 35.87301555222812, 32.0141240739917, 'King Abdullah II School of Information Technology', 'faculty'),
(10, 6, 35.866838881642224, 32.0177982280539, 'University Mosque', 'mosque');

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
(25, 7, 1, 'test', 'tester', 'MarketPlaces_Images/Screenshot 2025-03-04 013448.png', 'Expired', 0, '2025-05-23 12:56:30', NULL),
(26, 7, 7, 'yanal Kasit', 'kasit description', 'MarketPlaces_Images/Screenshot 2025-03-18 003843.png', 'Expired', 0, '2025-05-23 12:57:10', 2),
(27, 7, 7, 'web', 'it', 'MarketPlaces_Images/book6.png', 'Available', 0, '2025-05-25 13:42:29', 3),
(28, 6, 1, 'chemistry', 'first year ,second year in all medical Fields', 'MarketPlaces_Images/WhatsApp Image 2025-05-25 at 6.18.24 PM.jpeg', 'Available', 0, '2025-05-25 15:20:52', NULL),
(29, 7, 1, 'test', 'fdfgd', 'MarketPlaces_Images/', 'Expired', 0, '2025-05-25 21:07:52', NULL);

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
(108, 32, 7, 'hi', '2025-05-26 09:07:33'),
(109, 32, 6, 'hi', '2025-05-26 09:07:54'),
(110, 32, 6, 'hello', '2025-05-26 10:28:34'),
(111, 32, 7, 'هل لقيت موبايلي؟', '2025-05-27 08:28:24'),
(112, 32, 7, 'Hu', '2025-05-27 08:46:41');

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
(32, 'Chat regarding key from tityana tsey ', 'Chat regarding key From User #7', 7, '2025-05-26 09:07:29', 33, NULL),
(33, 'Chat regarding chemistry from tityana tsey ', 'Chat regarding chemistry From User #7', 7, '2025-05-27 09:35:12', NULL, 28);

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
(32, 6, '2025-05-26 09:07:29'),
(32, 7, '2025-05-26 09:07:29'),
(33, 6, '2025-05-27 09:35:12'),
(33, 7, '2025-05-27 09:35:12');

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_login_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `department_id`, `major_id`, `fname`, `lname`, `email`, `password`, `image`, `otp_code`, `active`, `created_at`, `last_login_time`) VALUES
(1, 1, 1, 'talaaaaaaq', 'weamaaa', 'test@gmail.com', '123', 'Students_Images/1747340243_avataaars_logo.png', '', 1, '2025-05-15 19:57:49', NULL),
(2, 2, 2, 'Moh11', 'Maj', 'test@test.com', 'test.2020', 'Students_Images/1747242223_images.jpeg', '9571', 1, '2025-05-13 19:02:18', NULL),
(6, 1, 1, 'tala', 'hammami', 'tal0217145@ju.edu.jo', '202cb962ac59075b964b07152d234b70', 'https://www.computerhope.com/jargon/g/guest-user.png', '3556', 1, '2025-05-17 10:27:40', '2025-05-27 13:35:14'),
(7, 7, 3, 'tityana', 'tsey', 'tyt0212873@ju.edu.jo', '202cb962ac59075b964b07152d234b70', 'Students_Images/1748273657_46794a090f4a6fa7c3585cd6d715219e.jpg', '1724', 1, '2025-05-17 10:41:52', '2025-05-27 16:30:03'),
(8, 2, 2, 'abood', 'almubaideen', 'ABD0219440@ju.edu.jo', '81dc9bdb52d04dc20036dbd8313ed055', 'https://www.computerhope.com/jargon/g/guest-user.png', '9392', 0, '2025-05-18 10:06:35', NULL),
(9, 2, 2, 'ibrahem', 'test', 'abr0211412@ju.edu.jo', '827ccb0eea8a706c4c34a16891f84e7b', 'https://www.computerhope.com/jargon/g/guest-user.png', '8817', 1, '2025-05-18 12:39:11', NULL),
(10, 1, 1, 'mohannad ', 'shoushi', 'mhn0212666@ju.edu.jo', '81dc9bdb52d04dc20036dbd8313ed055', 'https://www.computerhope.com/jargon/g/guest-user.png', '', 1, '2025-05-19 06:52:50', NULL),
(11, 2, 2, 'Weam', 'Atallah', 'waa0214045@ju.edu.jo', '81dc9bdb52d04dc20036dbd8313ed055', 'https://www.computerhope.com/jargon/g/guest-user.png', '9368', 1, '2025-05-20 09:42:47', NULL);

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
(33, 7, 9),
(34, 11, 9),
(35, 11, 5),
(37, 6, 14),
(39, 7, 14);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `lost_founds`
--
ALTER TABLE `lost_founds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `majors`
--
ALTER TABLE `majors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `maps`
--
ALTER TABLE `maps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `marketplaces`
--
ALTER TABLE `marketplaces`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `marketplace_interestes`
--
ALTER TABLE `marketplace_interestes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `places`
--
ALTER TABLE `places`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `student_events`
--
ALTER TABLE `student_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

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
