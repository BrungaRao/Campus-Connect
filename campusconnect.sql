-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2026 at 06:00 PM
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
-- Database: `campusconnect`
--

-- --------------------------------------------------------

--
-- Table structure for table `academics`
--

CREATE TABLE `academics` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `activity` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`id`, `user_id`, `activity`, `created_at`) VALUES
(1, 1, 'Logged in', '2026-03-03 16:22:09'),
(2, 1, 'Logged in', '2026-03-03 16:23:06'),
(3, 1, 'Logged out', '2026-03-03 19:10:40'),
(4, 1, 'Logged in', '2026-03-03 19:10:43'),
(5, 1, 'Logged out', '2026-03-03 19:11:01'),
(6, 1, 'Logged in', '2026-03-03 19:11:14'),
(7, 1, 'Logged out', '2026-03-03 19:11:18'),
(8, 1, 'Logged in', '2026-03-03 19:12:58'),
(9, 1, 'Logged in', '2026-03-04 19:24:25'),
(10, 1, 'Logged out', '2026-03-04 19:25:49'),
(11, 1, 'Logged in', '2026-03-04 19:26:54'),
(12, 1, 'Logged in', '2026-03-05 18:41:07'),
(13, 1, 'Logged out', '2026-03-05 18:42:46'),
(14, 1, 'Logged in', '2026-03-05 18:44:14'),
(15, 1, 'Registered for event ID: 2', '2026-03-05 19:34:37'),
(16, 1, 'Registered for event ID: 1', '2026-03-05 19:45:15'),
(17, 1, 'Registered for event ID: 5', '2026-03-05 19:45:40'),
(18, 1, 'Logged out', '2026-03-05 19:56:32'),
(19, 1, 'Logged in', '2026-03-05 19:58:56'),
(20, 1, 'Logged in', '2026-03-06 20:40:38'),
(21, 1, 'Logged out', '2026-03-06 21:02:42'),
(22, 1, 'Logged in', '2026-03-07 11:55:30'),
(23, 1, 'Registered for event ID: 4', '2026-03-07 11:57:33'),
(24, 1, 'Logged out', '2026-03-07 12:16:52'),
(25, 3, 'Logged in', '2026-03-07 12:20:09'),
(26, 3, 'Logged out', '2026-03-07 12:22:16'),
(27, 1, 'Logged in', '2026-03-07 12:23:17'),
(28, 1, 'Logged in', '2026-03-07 15:52:53'),
(29, 1, 'Logged in', '2026-03-07 16:21:39'),
(30, 1, 'Logged out', '2026-03-07 18:55:01'),
(31, 1, 'Logged in', '2026-03-07 18:55:16'),
(32, 1, 'Logged out', '2026-03-07 19:00:17'),
(33, 1, 'Logged in', '2026-03-07 19:00:59'),
(34, 1, 'Logged out', '2026-03-07 22:02:34'),
(35, 1, 'Logged in', '2026-03-07 22:03:22'),
(36, 1, 'Logged out', '2026-03-07 22:05:00'),
(37, 1, 'Logged in', '2026-03-07 22:05:35'),
(38, 1, 'Logged out', '2026-03-07 22:11:03'),
(39, 1, 'Logged out', '2026-03-07 23:08:49'),
(40, 1, 'Logged out', '2026-03-08 13:43:42'),
(41, 1, 'Logged out', '2026-03-08 13:44:16'),
(42, 3, 'Logged out', '2026-03-08 13:44:46'),
(43, 1, 'Logged out', '2026-03-08 14:09:53'),
(44, 3, 'Logged out', '2026-03-08 14:10:26'),
(45, 1, 'Logged out', '2026-03-08 20:48:40'),
(46, 1, 'Logged out', '2026-03-08 22:16:42'),
(47, 3, 'Logged out', '2026-03-09 12:57:13'),
(48, 3, 'Logged out', '2026-03-09 13:06:26'),
(49, 3, 'Logged out', '2026-03-09 13:09:44'),
(50, 2, 'Logged out', '2026-03-09 13:20:45'),
(51, 2, 'Logged out', '2026-03-09 13:36:53'),
(52, 3, 'Logged out', '2026-03-09 14:29:07'),
(53, 3, 'Logged out', '2026-03-09 14:32:12'),
(54, 1, 'Logged out', '2026-03-11 22:01:58'),
(55, 1, 'Logged out', '2026-03-15 12:57:39'),
(56, 3, 'Logged out', '2026-03-15 13:08:03'),
(57, 3, 'Logged out', '2026-03-15 13:08:40'),
(58, 3, 'Logged out', '2026-03-15 13:43:41'),
(59, 3, 'Logged out', '2026-03-15 14:43:43'),
(60, 3, 'Logged out', '2026-03-15 14:49:55'),
(61, 3, 'Logged out', '2026-03-15 15:05:17'),
(62, 1, 'Logged out', '2026-03-15 15:10:43'),
(63, 1, 'Logged out', '2026-03-15 15:14:29'),
(64, 1, 'Logged out', '2026-03-15 16:19:11'),
(65, 3, 'Logged out', '2026-03-15 17:37:54'),
(66, 1, 'Logged out', '2026-03-15 17:39:11'),
(67, 3, 'Logged out', '2026-03-15 17:57:42'),
(68, 3, 'Logged out', '2026-03-15 18:09:16'),
(69, 3, 'Logged out', '2026-03-15 18:29:17'),
(70, 1, 'Logged out', '2026-03-15 19:26:23'),
(71, 1, 'Logged out', '2026-03-15 19:37:26'),
(72, 3, 'Logged out', '2026-03-15 19:38:53'),
(73, 1, 'Logged out', '2026-04-30 15:45:14'),
(74, 5, 'Logged out', '2026-04-30 15:46:08'),
(75, 1, 'Logged out', '2026-04-30 15:46:50'),
(76, 5, 'Logged out', '2026-04-30 15:47:10'),
(77, 1, 'Logged out', '2026-04-30 15:49:01'),
(78, 1, 'Logged out', '2026-04-30 16:48:03'),
(79, 1, 'Logged out', '2026-04-30 17:03:28'),
(80, 1, 'Logged out', '2026-04-30 17:04:00'),
(81, 2, 'Logged out', '2026-05-08 16:13:34'),
(82, 6, 'Logged out', '2026-05-08 16:17:42'),
(83, 7, 'Logged out', '2026-05-08 16:21:54'),
(84, 1, 'Logged out', '2026-05-08 16:24:05'),
(85, 8, 'Logged out', '2026-05-08 16:26:01'),
(86, 1, 'Logged out', '2026-05-08 16:29:43'),
(87, 9, 'Logged out', '2026-05-08 16:34:15');

-- --------------------------------------------------------

--
-- Table structure for table `admin_notifications`
--

CREATE TABLE `admin_notifications` (
  `id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL,
  `action` varchar(50) NOT NULL,
  `reference_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_notifications`
--

INSERT INTO `admin_notifications` (`id`, `created_at`, `user_id`, `action`, `reference_id`) VALUES
(1, '2026-03-08 08:13:28', 1, 'joined_club', 1),
(2, '2026-03-08 08:14:34', 3, 'joined_club', 1),
(3, '2026-03-08 08:40:14', 3, 'joined_club', 2),
(4, '2026-03-08 16:57:27', 3, 'registered_event', 1),
(5, '2026-03-08 17:10:37', 3, 'registered_event', 2),
(6, '2026-03-10 10:22:45', 1, 'registered_event', 3),
(7, '2026-03-15 08:48:25', 3, 'registered_event', 4),
(8, '2026-03-15 09:18:12', 3, 'registered_event', 3),
(9, '2026-03-15 14:08:07', 3, 'joined_club', 3),
(10, '2026-03-15 14:08:09', 3, 'registered_event', 5),
(11, '2026-04-30 10:07:55', 1, 'joined_club', 2),
(12, '2026-04-30 10:17:06', 5, 'joined_club', 1),
(13, '2026-04-30 10:17:06', 5, 'joined_club', 2),
(14, '2026-05-04 11:24:06', 1, 'joined_club', 5),
(15, '2026-05-08 10:42:29', 2, 'joined_club', 2),
(16, '2026-05-08 10:42:32', 2, 'joined_club', 1),
(17, '2026-05-08 10:42:47', 2, 'joined_club', 4);

-- --------------------------------------------------------

--
-- Table structure for table `assignments`
--

CREATE TABLE `assignments` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `course_name` varchar(100) DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assignments`
--

INSERT INTO `assignments` (`id`, `title`, `course_name`, `due_date`, `created_at`) VALUES
(1, 'Operating Systems', 'Operating Systems', '2026-03-05', '2026-03-15 17:36:43'),
(2, 'Java', 'Java', '2026-03-10', '2026-03-15 17:36:43'),
(3, 'Data Structures', 'Data Structures', '2026-03-18', '2026-03-15 17:36:43'),
(4, 'Machine Learning', 'Machine Learning', '2026-03-23', '2026-03-15 17:36:43'),
(5, 'Artificial Intelligence', 'Artificial Intelligence', '2026-03-19', '2026-03-15 17:36:43');

-- --------------------------------------------------------

--
-- Table structure for table `assignment_submissions`
--

CREATE TABLE `assignment_submissions` (
  `id` int(11) NOT NULL,
  `assignment_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `submitted_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `clubs`
--

CREATE TABLE `clubs` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clubs`
--

INSERT INTO `clubs` (`id`, `name`, `description`, `image`) VALUES
(1, 'Science Club', 'Explore science projects, experiments, and workshops.', NULL),
(2, 'Art Club', 'A place for students to paint, draw, and express creativity.', NULL),
(3, 'Drama Club', 'Perform plays, skits, and improve acting skills.', NULL),
(4, 'Robotics Club', 'Build and program robots for competitions and learning.', NULL),
(5, 'Music Club', 'Learn instruments, singing, and organize musical events.', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `club_members`
--

CREATE TABLE `club_members` (
  `id` int(11) NOT NULL,
  `club_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `joined_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `club_members`
--

INSERT INTO `club_members` (`id`, `club_id`, `user_id`, `joined_at`) VALUES
(1, 1, 1, '2026-03-08 13:43:28'),
(2, 1, 3, '2026-03-08 13:44:34'),
(3, 2, 3, '2026-03-08 14:10:14'),
(4, 3, 3, '2026-03-15 19:38:07'),
(5, 2, 1, '2026-04-30 15:37:55'),
(6, 1, 5, '2026-04-30 15:47:06'),
(7, 2, 5, '2026-04-30 15:47:06'),
(8, 5, 1, '2026-05-04 16:54:06'),
(9, 2, 2, '2026-05-08 16:12:29'),
(10, 1, 2, '2026-05-08 16:12:32'),
(11, 4, 2, '2026-05-08 16:12:47');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `course_name` varchar(100) DEFAULT NULL,
  `instructor` varchar(100) DEFAULT NULL,
  `credits` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course_name`, `instructor`, `credits`) VALUES
(1, 'Data Structures', 'Dr. John Smith', 3),
(2, 'Operating Systems', 'Dr. Jane Doe', 3),
(3, 'Java', 'Dr. Albert', 3),
(4, 'Python', 'Ms. Mary Lee', 3),
(5, 'Artificial Intelligence', 'Mr. Alan Turing', 3),
(6, 'Machine Learning', 'Dr. Alice Green', 3),
(7, 'Web Programming', 'Mr. Paul White', 3),
(8, 'Internet Technologies', 'Ms. Mary Lee', 3),
(9, 'Sports', 'Coach Mike', 2),
(10, 'Library', 'Ms. Clara Brown', 2);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  `event_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `location` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `description`, `event_date`, `created_at`, `location`) VALUES
(1, 'Science Fair 2026', 'Annual science exhibition with student projects.', '2026-03-15', '2026-03-02 17:51:54', 'Auditorium'),
(2, 'Art Exhibition', 'Display artworks created by students.', '2026-03-20', '2026-03-02 17:51:54', 'Art Hall'),
(3, 'Drama Night', 'Evening of theatrical performances by Drama Club.', '2026-03-25', '2026-03-02 17:51:54', 'Auditorium'),
(4, 'Robotics Competition', 'Inter-school robotics challenge.', '2026-03-30', '2026-03-02 17:51:54', 'Lab 101'),
(5, 'Music Fest', 'Live musical performances by Music Club.', '2026-04-05', '2026-03-02 17:51:54', 'Open Grounds');

-- --------------------------------------------------------

--
-- Table structure for table `event_registrations`
--

CREATE TABLE `event_registrations` (
  `id` int(11) NOT NULL,
  `event_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `registered_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event_registrations`
--

INSERT INTO `event_registrations` (`id`, `event_id`, `student_id`, `registered_at`) VALUES
(1, 2, 1, '2026-03-05 19:34:37'),
(2, 1, 1, '2026-03-05 19:45:15'),
(3, 5, 1, '2026-03-05 19:45:40'),
(4, 4, 1, '2026-03-07 11:57:33'),
(7, 3, 1, '2026-03-10 15:52:45');

-- --------------------------------------------------------

--
-- Table structure for table `forum_comments`
--

CREATE TABLE `forum_comments` (
  `id` int(11) NOT NULL,
  `topic_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `forum_topics`
--

CREATE TABLE `forum_topics` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `resources`
--

CREATE TABLE `resources` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `resources`
--

INSERT INTO `resources` (`id`, `title`, `file`, `uploaded_at`) VALUES
(7, 'Machine Learning - TB', 'studymaterials/1772971747_ML - Machine learning.pdf', '2026-03-08 12:09:07'),
(8, 'Operating Systems - TB', 'studymaterials/1772972883_OS - TEXTBOOK _compressed.pdf', '2026-03-08 12:28:03'),
(9, 'Python - TB', 'studymaterials/1772972907_Python programming textbook _compressed.pdf', '2026-03-08 12:28:27'),
(10, 'Data Structures - TB', 'studymaterials/1772972933_Data Structures TB Skyward_compressed.pdf', '2026-03-08 12:28:53'),
(11, 'Artificial Intelligence - TB', 'studymaterials/1772973434_AI TEXTBOOK.pdf', '2026-03-08 12:37:14'),
(12, 'Web Programming - TB', 'studymaterials/1772973457_Web Programming Skyward_compressed.pdf', '2026-03-08 12:37:37'),
(13, 'Internet Technologies - TB', 'studymaterials/1772973497_Internet Technology Skyward_compressed.pdf', '2026-03-08 12:38:17'),
(14, 'Java - TB', 'studymaterials/1772973739_Java Skyward_compressed.pdf', '2026-03-08 12:42:19');

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `course_name` varchar(100) DEFAULT NULL,
  `exam_date` date DEFAULT NULL,
  `marks` int(11) DEFAULT NULL,
  `grade` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `timetable`
--

CREATE TABLE `timetable` (
  `id` int(11) NOT NULL,
  `day` enum('Monday','Tuesday','Wednesday','Thursday','Friday') NOT NULL,
  `period` int(11) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `instructor` varchar(100) DEFAULT NULL,
  `room` varchar(50) DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `timetable`
--

INSERT INTO `timetable` (`id`, `day`, `period`, `subject`, `instructor`, `room`, `start_time`, `end_time`) VALUES
(1, 'Monday', 1, 'Data Structures', 'Dr. John Smith', '101', '09:00:00', '10:00:00'),
(2, 'Monday', 2, 'Operating Systems', 'Dr. Jane Doe', '102', '10:00:00', '11:00:00'),
(3, 'Monday', 3, 'Java', 'Dr. Albert', '103', '11:15:00', '12:15:00'),
(4, 'Monday', 4, 'Python', 'Ms. Mary Lee', '104', '01:00:00', '02:00:00'),
(5, 'Monday', 5, 'Artificial Intelligence', 'Mr. Alan Turing', '105', '02:00:00', '03:00:00'),
(6, 'Monday', 6, 'Sports', 'Coach Mike', 'Gym', '03:00:00', '04:00:00'),
(7, 'Tuesday', 1, 'Machine Learning', 'Dr. Alice Green', '101', '09:00:00', '10:00:00'),
(8, 'Tuesday', 2, 'Data Structures', 'Dr. John Smith', '102', '10:00:00', '11:00:00'),
(9, 'Tuesday', 3, 'Web Programming', 'Mr. Paul White', '103', '11:15:00', '12:15:00'),
(10, 'Tuesday', 4, 'Java', 'Dr. Albert', '104', '01:00:00', '02:00:00'),
(11, 'Tuesday', 5, 'Python', 'Mr. Alan Turing', '105', '02:00:00', '03:00:00'),
(12, 'Tuesday', 6, 'Library', 'Ms. Clara Brown', 'Library', '03:00:00', '04:00:00'),
(13, 'Wednesday', 1, 'Operating Systems', 'Dr. Jane Doe', '101', '09:00:00', '10:00:00'),
(14, 'Wednesday', 2, 'Data Structures', 'Dr. John Smith', '102', '10:00:00', '11:00:00'),
(15, 'Wednesday', 3, 'Internet Technologies', 'Ms. Mary Lee', '103', '11:15:00', '12:15:00'),
(16, 'Wednesday', 4, 'Machine Learning', 'Dr. Alice Green', '104', '01:00:00', '02:00:00'),
(17, 'Wednesday', 5, 'Web Programming', 'Mr. Paul White', '105', '02:00:00', '03:00:00'),
(18, 'Wednesday', 6, 'Sports', 'Coach Mike', 'Gym', '03:00:00', '04:00:00'),
(19, 'Thursday', 1, 'Java', 'Dr. Albert', '101', '09:00:00', '10:00:00'),
(20, 'Thursday', 2, 'Data Structures', 'Dr. John Smith', '102', '10:00:00', '11:00:00'),
(21, 'Thursday', 3, 'Artificial Intelligence', 'Mr. Alan Turing', '103', '11:15:00', '12:15:00'),
(22, 'Thursday', 4, 'Internet Technologies', 'Ms. Mary Lee', '104', '01:00:00', '02:00:00'),
(23, 'Thursday', 5, 'Library', 'Ms. Clara Brown', 'Library', '02:00:00', '03:00:00'),
(24, 'Thursday', 6, 'Operating Systems', 'Dr. Jane Doe', '106', '03:00:00', '04:00:00'),
(25, 'Friday', 1, 'Web Programming', 'Mr. Paul White', '101', '09:00:00', '10:00:00'),
(26, 'Friday', 2, 'Python', 'Mr. Alan Turing', '102', '10:00:00', '11:00:00'),
(27, 'Friday', 3, 'Machine Learning', 'Dr. Alice Green', '103', '11:15:00', '12:15:00'),
(28, 'Friday', 4, 'Artificial Intelligence', 'Dr. John Smith', '104', '01:00:00', '02:00:00'),
(29, 'Friday', 5, 'Internet Technologies', 'Ms. Mary Lee', '105', '02:00:00', '03:00:00'),
(30, 'Friday', 6, 'Sports', 'Coach Mike', 'Gym', '03:00:00', '04:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role` varchar(20) NOT NULL DEFAULT 'student',
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `department` varchar(100) DEFAULT NULL,
  `year` varchar(50) DEFAULT NULL,
  `profile_pic` longblob DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `phone` varchar(20) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `class_year` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `fullname`, `email`, `password`, `department`, `year`, `profile_pic`, `created_at`, `phone`, `dob`, `class_year`) VALUES
(1, 'admin', 'Brunga S Rao', 'brungarao2004@gmail.com', '$2y$10$bpQrDJ9LxLt2JifVFZmqNO77w.EE/iivRg17P2om/Bx9mRwAMvU0C', 'BCA', '3rd Year', 0x75706c6f6164732f70726f66696c655f706963732f757365725f312e6a706567, '2026-03-02 16:04:06', '9483083934', '2004-12-14', '3'),
(2, 'student', 'Pavan Kalyan.N', 'pavann206kalyann@gmail.com', '$2y$10$ZBObJQvlOE60L5aM0TPZBulQ4xf2SvqowZ5u..gcwo2VBojSv9yFm', 'BCA', '1st Year', 0x75706c6f6164732f70726f66696c655f706963732f757365725f322e6a7067, '2026-03-07 06:49:41', '8310066760', '2005-09-06', '1'),
(3, 'student', 'Madhan N', 'madhan@gmail.com', '$2y$10$sHk9Q0iypZXdh2G2jCJ1gOdFcMWxdSpp13tNkANoG9T0jVClOLOHC', 'BCOM', '1st Year', 0x75706c6f6164732f70726f66696c655f706963732f757365725f362e706e67, '2026-05-08 10:44:49', '9901040623', '2007-01-07', '1'),
(4, 'student', 'JeevaJith', 'jeevajith@gmail.com', '$2y$10$Nwk5GLJSjAV5mniLkSmFGOieLn813AfG9r5LjXlLkWNm76vqE3uHK', 'BCA', '1st Year', 0x75706c6f6164732f70726f66696c655f706963732f757365725f372e706e67, '2026-05-08 10:50:27', '6362109630', '2007-07-02', '1'),
(5, 'student', 'Abhishek', 'abhishek@gmail.com', '$2y$10$Oh.uKagMZ7M9azLpVM8C0uSy4XW7tK215jm/4b0FJzE75/alMVwji', 'BCA', '1st Year', 0x75706c6f6164732f70726f66696c655f706963732f757365725f382e706e67, '2026-05-08 10:55:06', '9972234447', '2007-06-28', '1'),
(6, 'student', 'Pooja B M', 'poojabm@gmail.com', '$2y$10$Zox7eH.oenT4qbj1j6xewupoTcYaP1V6Kar1CpHWv4cwzog3D7lRO', 'BCA', '3rd Year', 0x75706c6f6164732f70726f66696c655f706963732f757365725f392e706e67, '2026-05-08 11:00:12', '9535053849', '2005-07-14', '3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academics`
--
ALTER TABLE `academics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_user_activity` (`user_id`);

--
-- Indexes for table `admin_notifications`
--
ALTER TABLE `admin_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assignments`
--
ALTER TABLE `assignments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assignment_submissions`
--
ALTER TABLE `assignment_submissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_submission` (`assignment_id`,`student_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `clubs`
--
ALTER TABLE `clubs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `club_members`
--
ALTER TABLE `club_members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_registrations`
--
ALTER TABLE `event_registrations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_event` (`event_id`),
  ADD KEY `idx_event_student` (`student_id`);

--
-- Indexes for table `forum_comments`
--
ALTER TABLE `forum_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_comment_topic` (`topic_id`),
  ADD KEY `fk_comment_user` (`user_id`);

--
-- Indexes for table `forum_topics`
--
ALTER TABLE `forum_topics`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_topic_user` (`user_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `resources`
--
ALTER TABLE `resources`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_result_student` (`student_id`);

--
-- Indexes for table `timetable`
--
ALTER TABLE `timetable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academics`
--
ALTER TABLE `academics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `admin_notifications`
--
ALTER TABLE `admin_notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `assignments`
--
ALTER TABLE `assignments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `assignment_submissions`
--
ALTER TABLE `assignment_submissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `clubs`
--
ALTER TABLE `clubs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `club_members`
--
ALTER TABLE `club_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `event_registrations`
--
ALTER TABLE `event_registrations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `forum_comments`
--
ALTER TABLE `forum_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `forum_topics`
--
ALTER TABLE `forum_topics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `resources`
--
ALTER TABLE `resources`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `timetable`
--
ALTER TABLE `timetable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assignment_submissions`
--
ALTER TABLE `assignment_submissions`
  ADD CONSTRAINT `assignment_submissions_ibfk_1` FOREIGN KEY (`assignment_id`) REFERENCES `assignments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `assignment_submissions_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `event_registrations`
--
ALTER TABLE `event_registrations`
  ADD CONSTRAINT `fk_event` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_student` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `forum_comments`
--
ALTER TABLE `forum_comments`
  ADD CONSTRAINT `fk_comment_topic` FOREIGN KEY (`topic_id`) REFERENCES `forum_topics` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_comment_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `forum_topics`
--
ALTER TABLE `forum_topics`
  ADD CONSTRAINT `fk_topic_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `results`
--
ALTER TABLE `results`
  ADD CONSTRAINT `fk_result_student` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
