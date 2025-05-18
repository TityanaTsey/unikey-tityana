-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2025 at 10:15 PM
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
-- Database: `unikey`
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
(1, 'Admin', 'admin', 'admin@unikey.com', '25f9e794323b453885f5181f1b624d0b');

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
(1, 6, 'Announcement2222', '2025-05-05', 'Content Content Content Content Content Content Content ', 'Desc Desc Desc Desc Desc Desc Desc ', 'Announcements_Images/1746472016_farmer.jpg', 'Expired', 1),
(2, 6, 'important ann 11111', '2025-05-14', 'Content Content Content Content Content Content Content', 'desc desc desc desc desc desc', 'Announcements_Images/1747234236_driving.jpg', 'Available', 0);

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
(5, 6, 'New Event 12222', 'here', 'sup', 'desc desc desc desc desc desc', 'Events_Images/1747235644_download.png', '2025-05-14T18:13', 5, 'Expired', '2025-05-14 15:14:04');

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `lost_founds`
--

INSERT INTO `lost_founds` (`id`, `category_id`, `place_id`, `student_id`, `name`, `image`, `type`, `status`, `last_seen_in`, `created_at`) VALUES
(2, 4, 2, 2, 'Test 1', 'Losts_Images/images.jpeg', NULL, 3, NULL, '2025-05-14 17:26:15');

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
(3, 3, 2, 2, 'market', 'desc desc desc desc', 'MarketPlaces_Images/images.jpeg', 'Expired', 1, '2025-05-14 18:47:49');

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
(1, 3, 2);

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
  `active` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `department_id`, `major_id`, `fname`, `lname`, `email`, `password`, `image`, `otp_code`, `active`, `created_at`) VALUES
(2, 2, 2, 'Moh11', 'Maj', 'mmajali45@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Students_Images/1747242223_images.jpeg', '9571', 1, '2025-05-13 19:02:18');

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
(3, 2, 5);

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
-- Indexes for table `places`
--
ALTER TABLE `places`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `lost_founds`
--
ALTER TABLE `lost_founds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `majors`
--
ALTER TABLE `majors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `marketplaces`
--
ALTER TABLE `marketplaces`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `marketplace_interestes`
--
ALTER TABLE `marketplace_interestes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `places`
--
ALTER TABLE `places`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `student_events`
--
ALTER TABLE `student_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
