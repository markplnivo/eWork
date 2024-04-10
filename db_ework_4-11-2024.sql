-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 10, 2024 at 09:53 PM
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
-- Database: `db_ework`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_account_request`
--

CREATE TABLE `tbl_account_request` (
  `tbl_accreq_id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact_number` varchar(50) NOT NULL,
  `user_password` text NOT NULL,
  `request_time` datetime NOT NULL,
  `username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_account_request`
--

INSERT INTO `tbl_account_request` (`tbl_accreq_id`, `firstname`, `lastname`, `email`, `contact_number`, `user_password`, `request_time`, `username`) VALUES
(36, 'Jayson', 'Pen', 'mp.phone.email@gmail.com', '9171924809', '$2y$10$Y6uKGV5rIDJVnzhHh5l/t.ZBSWmnQzLh/LIsR2cgH/OMMeRYQUwnS', '0000-00-00 00:00:00', 'artist1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_actionlogs`
--

CREATE TABLE `tbl_actionlogs` (
  `action` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `time` datetime NOT NULL,
  `subject_id` varchar(50) DEFAULT NULL,
  `subject_type` varchar(50) NOT NULL,
  `details` varchar(50) NOT NULL,
  `ip_address` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_actionlogs`
--

INSERT INTO `tbl_actionlogs` (`action`, `user_id`, `username`, `time`, `subject_id`, `subject_type`, `details`, `ip_address`) VALUES
('Job Order Created', 2, 'agent', '2024-04-09 20:14:44', '', 'Job', 'Job created successfully.', '127.0.0.1'),
('Job Order Created', 2, 'agent', '2024-04-09 20:32:20', NULL, 'Job', 'Job created successfully.', '127.0.0.1'),
('Job Order Created', 2, 'agent', '2024-04-09 20:32:44', NULL, 'Job', 'Job created successfully.', '127.0.0.1'),
('Job Order Created', 2, 'agent', '2024-04-09 20:36:28', NULL, 'Job', 'Job created successfully.', '127.0.0.1'),
('Job Order Created', 2, 'agent', '2024-04-09 20:45:16', '378', 'Job', 'Job created successfully.', '127.0.0.1'),
('Started on a job order', 5, 'artist', '2024-04-09 20:50:15', NULL, 'Job Order', 'Artist started working on job order', '127.0.0.1'),
('Started on a job order', 5, 'artist', '2024-04-09 20:52:41', NULL, 'Job Order', 'Artist started working on job order', '127.0.0.1'),
('Started on a job order', 5, 'artist', '2024-04-09 20:54:45', '337', 'Job Order', 'Artist started working on job order', '127.0.0.1'),
('Started on a job order', 5, 'artist', '2024-04-09 20:55:23', '338', 'Job Order', 'Artist started working on job order', '127.0.0.1'),
('Started on a job order', 5, 'artist', '2024-04-09 20:55:33', '339', 'Job Order', 'Artist started working on job order', '127.0.0.1'),
('Started on a job order', 5, 'artist', '2024-04-09 21:16:19', '352', 'Job', 'Job ID: 352 assigned to artist', '127.0.0.1'),
('Started on a job order', 5, 'artist', '2024-04-09 21:22:39', '351', 'Job', 'Job ID: 351 assigned to artist', '127.0.0.1'),
('Job Order Ended', 5, 'artist', '2024-04-09 21:24:27', '351', 'Job', 'Job order successfully.', '127.0.0.1'),
('Started on a job order', 5, 'artist', '2024-04-09 21:25:13', '353', 'Job', 'Job ID: 353 assigned to artist', '127.0.0.1'),
('Job Order Ended', 5, 'artist', '2024-04-09 21:25:24', '353', 'Job', 'Job order ended.', '127.0.0.1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_artist_status`
--

CREATE TABLE `tbl_artist_status` (
  `artist_name` varchar(50) NOT NULL,
  `artist_status` varchar(50) NOT NULL,
  `completion_percentage` int(11) DEFAULT NULL,
  `artist_id` int(11) DEFAULT NULL,
  `current_jobID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_artist_status`
--

INSERT INTO `tbl_artist_status` (`artist_name`, `artist_status`, `completion_percentage`, `artist_id`, `current_jobID`) VALUES
('artist', 'online', 0, 5, NULL),
('artistTest', '', NULL, 127, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_invitations`
--

CREATE TABLE `tbl_invitations` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `used` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_invitations`
--

INSERT INTO `tbl_invitations` (`id`, `email`, `token`, `used`, `created_at`) VALUES
(1, 'mp.phone.email@gmail.com', '96ea7819dc5f00a752f30f0f6a0d6557', 1, '2024-04-11 03:21:09');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jobs`
--

CREATE TABLE `tbl_jobs` (
  `job_id` int(11) NOT NULL,
  `creator_name` varchar(50) NOT NULL,
  `time_created` datetime NOT NULL,
  `job_status` varchar(50) DEFAULT NULL,
  `assigned_artist` varchar(50) DEFAULT NULL,
  `job_subject` text NOT NULL,
  `job_brief` longtext NOT NULL,
  `assigning_method` varchar(50) NOT NULL,
  `template_method` varchar(50) NOT NULL,
  `template_id` int(11) DEFAULT NULL COMMENT 'used to retrieve template name',
  `job_tracking_method` varchar(50) NOT NULL,
  `manual_deadline_date` date DEFAULT NULL,
  `manual_deadline_time` time DEFAULT NULL,
  `deadline_futureDateTime` datetime DEFAULT NULL,
  `jobstart_datetime` datetime DEFAULT NULL,
  `jobend_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_jobs`
--

INSERT INTO `tbl_jobs` (`job_id`, `creator_name`, `time_created`, `job_status`, `assigned_artist`, `job_subject`, `job_brief`, `assigning_method`, `template_method`, `template_id`, `job_tracking_method`, `manual_deadline_date`, `manual_deadline_time`, `deadline_futureDateTime`, `jobstart_datetime`, `jobend_datetime`) VALUES
(1, 'agent', '2024-04-05 08:02:09', 'completed', 'artist', 'Subject 1', 'Brief description of the job 1', 'Open to All', 'Template', 17, 'Artist', NULL, NULL, NULL, '2024-04-07 15:00:02', NULL),
(3, 'agent', '2024-04-07 11:30:48', 'completed', 'artist', 'Subject 3', 'Brief description of the job 3', 'Open to All', 'Template', 18, 'Artist', NULL, NULL, NULL, '2024-04-07 14:56:10', NULL),
(5, 'agent', '2024-04-09 14:55:17', 'completed', 'artist', 'Subject 5', 'Brief description of the job 5', 'Open to All', 'Template', 16, 'Artist', NULL, NULL, NULL, '2024-04-07 15:28:33', NULL),
(9, 'agent', '2024-04-13 19:35:13', 'completed', 'artist', 'Subject 9', 'Brief description of the job 9', 'Open to All', 'Template', 18, 'Artist', NULL, NULL, NULL, '2024-04-07 15:28:18', NULL),
(20, 'agent', '2024-04-06 09:00:00', 'completed', 'artist', 'Job subject 1', 'Job brief description 1', 'Open to All', 'Template', 17, 'Artist', NULL, NULL, NULL, '2024-04-06 08:00:00', '2024-04-06 17:00:00'),
(21, 'agent', '2024-04-07 09:00:00', 'completed', 'artist', 'Job subject 2', 'Job brief description 2', 'Assign an Artist', 'Manually', 16, 'Deadline', NULL, NULL, NULL, '2024-04-07 08:00:00', '2024-04-07 17:00:00'),
(22, 'agent', '2024-04-08 09:00:00', 'completed', 'artist', 'Job subject 3', 'Job brief description 3', 'Open to All', 'Template', 18, 'Artist', NULL, NULL, NULL, '2024-04-08 08:00:00', '2024-04-08 17:00:00'),
(23, 'agent', '2024-04-09 09:00:00', 'completed', 'artist', 'Job subject 4', 'Job brief description 4', 'Assign an Artist', 'Manually', 17, 'Deadline', NULL, NULL, NULL, '2024-04-09 08:00:00', '2024-04-09 17:00:00'),
(24, 'agent', '2024-04-10 09:00:00', 'completed', 'artist', 'Job subject 5', 'Job brief description 5', 'Open to All', 'Template', 16, 'Artist', NULL, NULL, NULL, '2024-04-10 08:00:00', '2024-04-10 17:00:00'),
(25, 'agent', '2024-04-11 09:00:00', 'completed', 'artist', 'Job subject 6', 'Job brief description 6', 'Assign an Artist', 'Manually', 18, 'Deadline', NULL, NULL, NULL, '2024-04-11 08:00:00', '2024-04-11 17:00:00'),
(26, 'agent', '2024-04-12 09:00:00', 'completed', 'artist', 'Job subject 7', 'Job brief description 7', 'Open to All', 'Template', 17, 'Artist', NULL, NULL, NULL, '2024-04-12 08:00:00', '2024-04-12 17:00:00'),
(27, 'agent', '2024-04-13 09:00:00', 'completed', 'artist', 'Job subject 8', 'Job brief description 8', 'Assign an Artist', 'Manually', 16, 'Deadline', NULL, NULL, NULL, '2024-04-13 08:00:00', '2024-04-13 17:00:00'),
(28, 'agent', '2024-04-14 09:00:00', 'completed', 'artist', 'Job subject 9', 'Job brief description 9', 'Open to All', 'Template', 18, 'Artist', NULL, NULL, NULL, '2024-04-14 08:00:00', '2024-04-14 17:00:00'),
(29, 'agent', '2024-04-15 09:00:00', 'completed', 'artist', 'Job subject 10', 'Job brief description 10', 'Assign an Artist', 'Manually', 17, 'Deadline', NULL, NULL, NULL, '2024-04-15 08:00:00', '2024-04-15 17:00:00'),
(30, 'agent', '2024-04-16 09:00:00', 'completed', 'artist', 'Job subject 11', 'Job brief description 11', 'Open to All', 'Template', 16, 'Artist', NULL, NULL, NULL, '2024-04-16 08:00:00', '2024-04-16 17:00:00'),
(31, 'agent', '2024-04-17 09:00:00', 'completed', 'artist', 'Job subject 12', 'Job brief description 12', 'Assign an Artist', 'Manually', 18, 'Deadline', NULL, NULL, NULL, '2024-04-17 08:00:00', '2024-04-17 17:00:00'),
(32, 'agent', '2024-04-18 09:00:00', 'completed', 'artist', 'Job subject 13', 'Job brief description 13', 'Open to All', 'Template', 17, 'Artist', NULL, NULL, NULL, '2024-04-18 08:00:00', '2024-04-18 17:00:00'),
(33, 'agent', '2024-04-19 09:00:00', 'completed', 'artist', 'Job subject 14', 'Job brief description 14', 'Assign an Artist', 'Manually', 16, 'Deadline', NULL, NULL, NULL, '2024-04-19 08:00:00', '2024-04-19 17:00:00'),
(34, 'agent', '2024-04-20 09:00:00', 'completed', 'artist', 'Job subject 15', 'Job brief description 15', 'Open to All', 'Template', 18, 'Artist', NULL, NULL, NULL, '2024-04-20 08:00:00', '2024-04-20 17:00:00'),
(291, 'agent', '2024-04-05 15:24:55', 'open', 'johndoe123', 'Job Order Likert', '', 'Assign an Artist', 'Template', 18, 'Artist', NULL, NULL, '2024-04-05 15:09:52', NULL, NULL),
(295, 'agent', '2024-04-07 15:30:51', 'completed', 'artist', 'Hello ', '', 'Open to All', 'Manually', NULL, 'Artist', NULL, NULL, NULL, '2024-04-07 15:31:30', NULL),
(296, 'agent', '2024-04-07 15:30:54', 'completed', 'artist', '123', '', 'Open to All', 'Manually', NULL, 'Artist', NULL, NULL, NULL, '2024-04-07 15:31:44', NULL),
(297, 'agent', '2024-04-07 15:30:57', 'completed', 'artist', 'asdf', '', 'Open to All', 'Manually', NULL, 'Artist', NULL, NULL, NULL, '2024-04-07 15:36:00', NULL),
(298, 'agent', '2024-04-07 15:31:01', 'completed', 'artist', '2323', '', 'Open to All', 'Manually', NULL, 'Artist', NULL, NULL, NULL, '2024-04-07 15:36:14', NULL),
(299, 'agent', '2024-04-07 15:31:05', 'completed', 'artist', '1234', '', 'Open to All', 'Manually', NULL, 'Artist', NULL, NULL, NULL, '2024-04-07 15:44:36', NULL),
(300, 'agent', '2024-04-07 15:31:10', 'completed', 'artist', '', '', 'Open to All', 'Manually', NULL, 'Artist', NULL, NULL, NULL, '2024-04-07 15:50:57', NULL),
(301, 'agent', '2024-04-07 15:31:12', 'completed', 'artist', '', '', 'Open to All', 'Manually', NULL, 'Artist', NULL, NULL, NULL, '2024-04-07 16:03:04', NULL),
(302, 'agent', '2024-04-07 16:03:55', 'completed', 'artist', '1', '', 'Open to All', 'Manually', NULL, 'Artist', NULL, NULL, NULL, '2024-04-07 16:04:31', NULL),
(303, 'agent', '2024-04-07 16:03:58', 'completed', 'artist', '2', '', 'Open to All', 'Manually', NULL, 'Artist', NULL, NULL, NULL, '2024-04-07 16:05:52', NULL),
(304, 'agent', '2024-04-07 16:04:02', 'completed', 'artist', '3', '', 'Open to All', 'Manually', NULL, 'Artist', NULL, NULL, NULL, '2024-04-07 16:06:35', NULL),
(305, 'agent', '2024-04-07 16:04:08', 'completed', 'artist', '4', '', 'Open to All', 'Manually', NULL, 'Artist', NULL, NULL, NULL, '2024-04-07 16:06:54', NULL),
(310, 'agent', '2024-04-08 03:06:39', 'completed', 'artist', '123', '', 'Open to All', 'Manually', NULL, 'Artist', NULL, NULL, NULL, '2024-04-08 03:07:54', NULL),
(311, 'agent', '2024-04-08 03:06:40', 'completed', 'artist', '', '', 'Open to All', 'Manually', NULL, 'Artist', NULL, NULL, NULL, '2024-04-08 03:08:17', NULL),
(312, 'agent', '2024-04-08 03:06:41', 'completed', 'artist', '', '', 'Open to All', 'Manually', NULL, 'Artist', NULL, NULL, NULL, '2024-04-08 03:08:31', NULL),
(313, 'agent', '2024-04-08 03:06:41', 'completed', 'artist', '', '', 'Open to All', 'Manually', NULL, 'Artist', NULL, NULL, NULL, '2024-04-08 03:09:31', NULL),
(314, 'agent', '2024-04-08 03:06:42', 'completed', 'artist', '', '', 'Open to All', 'Manually', NULL, 'Artist', NULL, NULL, NULL, '2024-04-08 03:13:06', NULL),
(315, 'agent', '2024-04-08 03:37:58', 'completed', 'artist', '', '', 'Open to All', 'Manually', NULL, 'Artist', NULL, NULL, NULL, '2024-04-08 03:38:07', NULL),
(316, 'agent', '2024-04-08 03:37:59', 'completed', 'artist', '', '', 'Open to All', 'Manually', NULL, 'Artist', NULL, NULL, NULL, '2024-04-08 03:38:31', NULL),
(317, 'agent', '2024-04-08 03:38:00', 'completed', 'artist', '', '', 'Open to All', 'Manually', NULL, 'Artist', NULL, NULL, NULL, '2024-04-08 03:38:59', NULL),
(318, 'agent', '2024-04-08 03:47:42', 'completed', 'artist', '', '', 'Open to All', 'Manually', NULL, 'Artist', NULL, NULL, NULL, '2024-04-08 03:47:53', '2024-04-08 03:48:09'),
(319, 'agent', '2024-04-08 03:47:43', 'completed', 'artist', '', '', 'Open to All', 'Manually', NULL, 'Artist', NULL, NULL, NULL, '2024-04-08 03:48:12', '2024-04-08 03:48:52'),
(320, 'agent', '2024-04-08 03:47:44', 'completed', 'artist', '', '', 'Open to All', 'Manually', NULL, 'Artist', NULL, NULL, NULL, '2024-04-08 03:48:55', '2024-04-08 03:49:05'),
(321, 'agent', '2024-04-08 03:47:45', 'completed', 'artist', '', '', 'Open to All', 'Manually', NULL, 'Artist', NULL, NULL, NULL, '2024-04-08 03:49:08', '2024-04-08 03:49:18'),
(322, 'agent', '2024-04-08 03:47:46', 'completed', 'artist', '', '', 'Open to All', 'Manually', NULL, 'Artist', NULL, NULL, NULL, '2024-04-08 03:49:20', '2024-04-08 03:49:29'),
(323, 'agent', '2024-04-08 03:47:47', 'completed', 'artist', '', '', 'Open to All', 'Manually', NULL, 'Artist', NULL, NULL, NULL, '2024-04-08 03:49:31', '2024-04-08 03:49:42'),
(324, 'agent', '2024-04-08 03:50:26', 'completed', 'artist', '', '', 'Open to All', 'Manually', NULL, 'Artist', NULL, NULL, NULL, '2024-04-08 03:51:23', '2024-04-08 03:51:51'),
(325, 'agent', '2024-04-08 03:50:27', 'completed', 'artist', '', '', 'Open to All', 'Manually', NULL, 'Artist', NULL, NULL, NULL, '2024-04-08 03:52:12', '2024-04-08 03:53:30'),
(327, 'agent', '2024-04-08 03:50:28', 'completed', 'artist', '', '', 'Open to All', 'Manually', NULL, 'Artist', NULL, NULL, NULL, '2024-04-09 01:11:09', '2024-04-09 01:11:32'),
(330, 'agent', '2024-04-08 20:12:07', 'completed', 'artist', '', '', 'Assign an Artist', 'Manually', NULL, 'Artist', NULL, NULL, NULL, '2024-04-09 00:41:36', '2024-04-09 01:11:02'),
(332, 'agent', '2024-04-08 23:07:11', 'completed', 'artist', 'Template with timeline, and finished before deadline', '', 'Open to All', 'Template', 18, 'Artist', NULL, NULL, '2024-04-09 04:52:00', '2024-04-08 23:07:18', '2024-04-08 23:07:32'),
(333, 'agent', '2024-04-09 01:12:38', 'completed', 'artist', 'Template with deadline but set to Artist', 'Deadline is 2024-04-09 6:57:23', 'Open to All', 'Template', 18, 'Artist', NULL, NULL, '2024-04-09 06:57:23', '2024-04-09 01:12:49', '2024-04-09 01:13:13'),
(334, 'agent', '2024-04-10 00:41:56', 'completed', 'artist', '', '', 'Open to All', 'Manually', NULL, 'Artist', NULL, NULL, NULL, '2024-04-10 00:42:05', '2024-04-10 00:45:07'),
(335, 'agent', '2024-04-10 00:41:57', 'completed', 'artist', '', '', 'Open to All', 'Manually', NULL, 'Artist', NULL, NULL, NULL, '2024-04-10 00:45:25', '2024-04-10 00:53:14'),
(336, 'agent', '2024-04-10 00:55:08', 'completed', 'artist', '123', '', 'Open to All', 'Manually', NULL, 'Artist', NULL, NULL, NULL, '2024-04-10 00:55:24', '2024-04-10 02:31:13'),
(337, 'agent', '2024-04-10 00:55:08', 'pending', 'artist', '', '', 'Open to All', 'Manually', NULL, 'Artist', NULL, NULL, NULL, '2024-04-10 02:54:45', NULL),
(338, 'agent', '2024-04-10 00:55:09', 'pending', 'artist', '', '', 'Open to All', 'Manually', NULL, 'Artist', NULL, NULL, NULL, '2024-04-10 02:55:23', NULL),
(339, 'agent', '2024-04-10 00:55:10', 'pending', 'artist', '', '', 'Open to All', 'Manually', NULL, 'Artist', NULL, NULL, NULL, '2024-04-10 02:55:33', NULL),
(340, 'agent', '2024-04-10 01:34:18', 'pending', 'artist', '', '', 'Open to All', 'Manually', NULL, 'Artist', NULL, NULL, NULL, '2024-04-10 02:55:49', NULL),
(341, 'agent', '2024-04-10 01:35:32', 'pending', 'artist', '', '', 'Open to All', 'Manually', NULL, 'Artist', NULL, NULL, NULL, '2024-04-10 02:56:44', NULL),
(342, 'agent', '2024-04-10 01:38:08', 'pending', 'artist', '', '', 'Open to All', 'Manually', NULL, 'Artist', NULL, NULL, NULL, '2024-04-10 02:57:29', NULL),
(343, 'agent', '2024-04-10 01:41:04', 'pending', 'artist', '', '', 'Open to All', 'Manually', NULL, 'Artist', NULL, NULL, NULL, '2024-04-10 02:59:19', NULL),
(344, 'agent', '2024-04-10 01:41:05', 'pending', 'artist', '', '', 'Open to All', 'Manually', NULL, 'Artist', NULL, NULL, NULL, '2024-04-10 03:00:53', NULL),
(345, 'agent', '2024-04-10 01:45:22', 'pending', 'artist', '', '', 'Open to All', 'Manually', NULL, 'Artist', NULL, NULL, NULL, '2024-04-10 03:01:08', NULL),
(346, 'agent', '2024-04-10 01:45:23', 'pending', 'artist', '', '', 'Open to All', 'Manually', NULL, 'Artist', NULL, NULL, NULL, '2024-04-10 03:01:24', NULL),
(347, 'agent', '2024-04-10 01:47:09', 'pending', 'artist', '', '', 'Open to All', 'Manually', NULL, 'Artist', NULL, NULL, NULL, '2024-04-10 03:03:13', NULL),
(348, 'agent', '2024-04-10 01:47:10', 'completed', 'artist', '', '', 'Open to All', 'Manually', NULL, 'Artist', NULL, NULL, NULL, '2024-04-10 03:10:52', '2024-04-10 03:12:31'),
(349, 'agent', '2024-04-10 01:49:08', 'completed', 'artist', '', '', 'Open to All', 'Manually', NULL, 'Artist', NULL, NULL, NULL, '2024-04-10 03:12:33', '2024-04-10 03:12:54'),
(350, 'agent', '2024-04-10 01:49:09', 'completed', 'artist', '', '', 'Open to All', 'Manually', NULL, 'Artist', NULL, NULL, NULL, '2024-04-10 03:15:23', '2024-04-10 03:16:13'),
(351, 'agent', '2024-04-10 01:52:34', 'completed', 'artist', '', '', 'Open to All', 'Manually', NULL, 'Artist', NULL, NULL, NULL, '2024-04-10 03:22:39', '2024-04-10 03:24:27'),
(352, 'agent', '2024-04-10 01:54:20', 'completed', 'artist', '', '', 'Open to All', 'Manually', NULL, 'Artist', NULL, NULL, NULL, '2024-04-10 03:16:19', '2024-04-10 03:16:45'),
(353, 'agent', '2024-04-10 01:54:20', 'completed', 'artist', '', '', 'Open to All', 'Manually', NULL, 'Artist', NULL, NULL, NULL, '2024-04-10 03:25:13', '2024-04-10 03:25:24'),
(363, 'agent', '2024-04-10 02:10:10', 'open', '', '', '', 'Open to All', 'Manually', NULL, 'Artist', NULL, NULL, NULL, NULL, NULL),
(364, 'agent', '2024-04-10 02:10:13', 'open', '', '', '', 'Open to All', 'Manually', NULL, 'Artist', NULL, NULL, NULL, NULL, NULL),
(365, 'agent', '2024-04-10 02:10:52', 'open', '', '', '', 'Open to All', 'Manually', NULL, 'Artist', NULL, NULL, NULL, NULL, NULL),
(366, 'agent', '2024-04-10 02:11:04', 'open', '', '', '', 'Open to All', 'Manually', NULL, 'Artist', NULL, NULL, NULL, NULL, NULL),
(367, 'agent', '2024-04-10 02:11:17', 'open', '', '', '', 'Open to All', 'Manually', NULL, 'Artist', NULL, NULL, NULL, NULL, NULL),
(368, 'agent', '2024-04-10 02:12:51', 'open', '', '', '', 'Open to All', 'Manually', NULL, 'Artist', NULL, NULL, NULL, NULL, NULL),
(369, 'agent', '2024-04-10 02:13:06', 'open', '', '', '', 'Open to All', 'Manually', NULL, 'Artist', NULL, NULL, NULL, NULL, NULL),
(370, 'agent', '2024-04-10 02:13:24', 'open', '', '', '', 'Open to All', 'Manually', NULL, 'Artist', NULL, NULL, NULL, NULL, NULL),
(371, 'agent', '2024-04-10 02:14:44', 'open', '', '', '', 'Open to All', 'Manually', NULL, 'Artist', NULL, NULL, NULL, NULL, NULL),
(372, 'agent', '2024-04-10 02:32:20', 'open', '', '', '', 'Open to All', 'Manually', NULL, 'Artist', NULL, NULL, NULL, NULL, NULL),
(373, 'agent', '2024-04-10 02:32:42', 'open', '', '', '', 'Open to All', 'Manually', NULL, 'Artist', NULL, NULL, NULL, NULL, NULL),
(374, 'agent', '2024-04-10 02:33:36', 'open', '', '', '', 'Open to All', 'Manually', NULL, 'Artist', NULL, NULL, NULL, NULL, NULL),
(375, 'agent', '2024-04-10 02:33:39', 'open', '', '', '', 'Open to All', 'Manually', NULL, 'Artist', NULL, NULL, NULL, NULL, NULL),
(376, 'agent', '2024-04-10 02:34:01', 'open', '', '', '', 'Open to All', 'Manually', NULL, 'Artist', NULL, NULL, NULL, NULL, NULL),
(377, 'agent', '2024-04-10 02:36:28', 'open', '', '', '', 'Open to All', 'Manually', NULL, 'Artist', NULL, NULL, NULL, NULL, NULL),
(378, 'agent', '2024-04-10 02:45:16', 'open', '', '', '', 'Open to All', 'Manually', NULL, 'Artist', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jobs_processes`
--

CREATE TABLE `tbl_jobs_processes` (
  `job_process_id` int(11) NOT NULL,
  `job_id` int(11) DEFAULT NULL,
  `process_id` int(11) DEFAULT NULL,
  `template_id` int(11) DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `assigned_person` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_jobs_processes`
--

INSERT INTO `tbl_jobs_processes` (`job_process_id`, `job_id`, `process_id`, `template_id`, `duration`, `assigned_person`) VALUES
(98, 279, 21, 16, 23, 'Artist'),
(99, 279, 22, 16, 23, 'Artist'),
(100, 279, 23, 16, 23, 'Artist'),
(101, 279, 24, 16, 23, 'Artist'),
(102, 279, 25, 16, 23, 'Artist'),
(103, 279, 26, 16, 23, 'Artist'),
(104, 279, 27, 16, 23, 'Production'),
(105, 281, 28, 17, 0, 'Artist'),
(106, 281, 29, 17, 2345, 'Artist'),
(107, 281, 30, 17, 2345, 'Artist'),
(108, 282, 28, 17, 0, 'Artist'),
(109, 282, 29, 17, 2345, 'Artist'),
(110, 282, 30, 17, 2345, 'Artist'),
(111, 283, 28, 17, 321, 'Artist'),
(112, 283, 29, 17, 2345, 'Production'),
(113, 283, 30, 17, 2345, 'Production'),
(114, 284, 31, 18, 345, 'Artist'),
(115, 285, 28, 17, 321, 'Artist'),
(116, 285, 29, 17, 2345, 'Production'),
(117, 285, 30, 17, 2345, 'Production'),
(118, 286, 28, 17, 60, 'Artist'),
(119, 286, 29, 17, 2345, 'Production'),
(120, 286, 30, 17, 2345, 'Production'),
(121, 287, 21, 16, 23, 'Artist'),
(122, 287, 22, 16, 23, 'Artist'),
(123, 287, 23, 16, 23, 'Artist'),
(124, 287, 24, 16, 23, 'Artist'),
(125, 287, 25, 16, 23, 'Artist'),
(126, 287, 26, 16, 23, 'Artist'),
(127, 287, 27, 16, 23, 'Artist'),
(128, 289, 28, 17, 60, 'Artist'),
(129, 289, 29, 17, 2345, 'Production'),
(130, 289, 30, 17, 2345, 'Production'),
(131, 290, 28, 17, 23, 'Artist'),
(132, 290, 29, 17, 2345, 'Artist'),
(133, 290, 30, 17, 2345, 'Artist'),
(134, 291, 31, 18, 345, 'Artist'),
(135, 292, 31, 18, 345, 'Artist'),
(136, 293, 31, 18, 345, 'Artist'),
(137, 294, 28, 17, 321, 'Artist'),
(138, 294, 29, 17, 2345, 'Production'),
(139, 294, 30, 17, 2345, 'Production'),
(140, 307, 21, 16, 23, 'Artist'),
(141, 307, 22, 16, 23, 'Artist'),
(142, 307, 23, 16, 23, 'Artist'),
(143, 307, 24, 16, 23, 'Artist'),
(144, 307, 25, 16, 23, 'Artist'),
(145, 307, 26, 16, 23, 'Artist'),
(146, 307, 27, 16, 23, 'Artist'),
(147, 308, 31, 18, 345, 'Artist'),
(148, 309, 31, 18, 345, 'Artist'),
(149, 331, 31, 18, 345, 'Artist'),
(150, 332, 31, 18, 345, 'Artist'),
(151, 333, 31, 18, 345, 'Artist');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jobs_progress`
--

CREATE TABLE `tbl_jobs_progress` (
  `progress_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `progress_measurement` int(11) NOT NULL,
  `job_starttime` datetime NOT NULL,
  `job_endttime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_production`
--

CREATE TABLE `tbl_production` (
  `Task` varchar(50) NOT NULL,
  `ProdTime` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_progress_images`
--

CREATE TABLE `tbl_progress_images` (
  `job_id` int(11) NOT NULL,
  `image_id` int(11) NOT NULL,
  `filepath_progress_image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_progress_images`
--

INSERT INTO `tbl_progress_images` (`job_id`, `image_id`, `filepath_progress_image`) VALUES
(248, 126, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_660a59be29f886.37184355.jpg'),
(248, 127, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_660a59e4863e17.09783511.jpg'),
(248, 128, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_660a59e488df59.74072804.jpg'),
(248, 129, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_660a59e48d5bf2.49314936.jpg'),
(248, 130, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_660a5a35994044.46854969.jpg'),
(248, 131, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_660a5a359bc721.56774330.jpg'),
(248, 132, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_660a5a359c8a40.44542357.jpg'),
(248, 133, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_660a5a35a0a971.04889528.jpg'),
(251, 134, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_660c714b0e23f8.27157885.jpg'),
(251, 135, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_660c714b0eea43.78324860.jpg'),
(251, 136, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_660c714b11d069.09046233.jpg'),
(251, 137, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_660c714b126527.68727056.png'),
(251, 138, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_660c7239b56973.28166355.jpg'),
(251, 139, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_660c733731ce77.41412643.jpg'),
(251, 140, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_660c7574041ed2.82637491.jpg'),
(251, 141, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_660c7598510db7.37676775.jpg'),
(251, 142, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_660c76069c5263.78741054.png'),
(251, 143, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_660c761da63f82.44179744.png'),
(251, 144, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_660c7689d045b3.46354269.png'),
(251, 145, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_660c774b721fe0.96103364.png'),
(263, 146, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_660cd914ec83d6.82757463.jpg'),
(263, 147, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_660cd914edb1f6.30703845.png'),
(263, 148, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_660cd914ee59d1.04066447.jpg'),
(263, 149, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_660cd914eef3c7.15213840.jpg'),
(290, 150, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_660fa801491286.31661966.png'),
(293, 151, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612412abd2a17.79668250.jpg'),
(293, 152, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612412abdd3a2.14647352.jpg'),
(293, 153, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612412ac1a7d0.97758268.jpg'),
(294, 154, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612423e3a80c3.86214766.jpg'),
(294, 155, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612423e3b5d73.48407551.jpg'),
(294, 156, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612423e3c2061.25354905.jpg'),
(294, 157, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612423e429967.78726859.jpg'),
(3, 158, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612446fc653d6.41302559.jpg'),
(3, 159, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612446fc732a4.73972582.jpg'),
(3, 160, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612446fc8a246.72186489.jpg'),
(3, 161, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612446fca54f3.73213514.jpg'),
(1, 162, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_66124587d75266.08677640.jpg'),
(1, 163, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_66124587db4c38.22277746.jpg'),
(1, 164, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_66124587dc1053.39923914.jpg'),
(1, 165, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_66124587dcffe9.25058570.jpg'),
(7, 166, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_661249d39de7c6.03284664.png'),
(7, 167, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_661249d39eb450.43892059.jpg'),
(7, 168, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_661249d39f66c1.22716227.jpg'),
(7, 169, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_661249d3a02955.64391134.png'),
(9, 170, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_66124b1ea010e7.48685422.jpg'),
(9, 171, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_66124b1ea40196.90518043.jpg'),
(9, 172, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_66124b1ea4abc5.19345854.jpg'),
(5, 173, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_66124b2fa43084.89903739.png'),
(5, 174, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_66124b2fa4ef40.16587153.jpg'),
(5, 175, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_66124b2fa5c554.89961872.jpg'),
(5, 176, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_66124b634b00f9.38484542.jpg'),
(5, 177, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_66124b634d22b1.65287426.jpg'),
(5, 178, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_66124b634df323.05164492.jpg'),
(295, 179, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_66124bdd4b6359.24852821.jpg'),
(296, 180, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_66124bea86f9e8.39385137.jpg'),
(296, 181, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_66124bea87b842.29431497.jpg'),
(296, 182, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_66124cde054923.33594563.jpg'),
(297, 183, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_66124ceb25b455.46273493.jpg'),
(297, 184, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_66124ceb27cb48.73025503.jpg'),
(298, 185, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_66124cfc75a2a6.29399760.jpg'),
(298, 186, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_66124d4c5cf957.06239597.jpg'),
(298, 187, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_66124d4c5dda09.11994586.jpg'),
(298, 188, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_66124d4c60f687.95400989.jpg'),
(298, 189, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_66124d4c61b0d2.36072044.jpg'),
(298, 190, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_66124d99b02c75.84105377.jpg'),
(298, 191, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_66124d99b24bf4.09269497.jpg'),
(298, 192, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_66124d99b63967.90577301.jpg'),
(298, 193, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_66124e843be402.22017141.jpg'),
(298, 194, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_66124e843cd574.32996336.jpg'),
(298, 195, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_66124e843fbc33.63186501.jpg'),
(298, 196, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_66124edb038bc4.53225865.jpg'),
(298, 197, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_66124edb073cf7.03827836.jpg'),
(298, 198, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_66124edb07f455.64026519.jpg'),
(299, 199, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_66124ef22beb00.15284236.jpg'),
(299, 200, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_66124ef22d26a5.97590636.png'),
(299, 201, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_66124ef2301229.20153978.jpg'),
(299, 202, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_66124ef234a348.73608516.jpg'),
(299, 203, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_66124ef2354414.93462509.jpg'),
(299, 204, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_66124ef2383781.40839271.jpg'),
(299, 205, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_66124f558ea086.47767727.jpg'),
(299, 206, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_66124f558f90e3.84501685.jpg'),
(299, 207, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_66124f55953561.84703009.jpg'),
(299, 208, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_66124f55976306.28941950.jpg'),
(299, 209, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_66124f559b51e5.84488170.jpg'),
(299, 210, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_66124fc6bad0c9.64596415.jpg'),
(299, 211, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_66124fc6be56e0.33192975.jpg'),
(299, 212, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_66125018227054.56193563.jpg'),
(299, 213, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_66125018235248.55970734.jpg'),
(299, 214, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_66125018272249.89651744.jpg'),
(300, 215, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_66125071313f29.70378007.jpg'),
(300, 216, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_66125071347821.18442031.jpg'),
(300, 217, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_66125071394836.33901698.jpg'),
(300, 218, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_661250950371c5.37428435.jpg'),
(300, 219, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_661250950a96b1.81467303.jpg'),
(300, 220, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_661250950b7590.80583385.jpg'),
(300, 221, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_661250950c1457.18061828.jpg'),
(300, 222, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_661250c9a74ff6.84608462.jpg'),
(300, 223, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_661250c9a98687.30536409.jpg'),
(300, 224, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_661250c9ad3072.50194058.jpg'),
(300, 225, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_66125306dc3df9.67791612.jpg'),
(300, 226, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_66125306dd5a04.66357794.jpg'),
(300, 227, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_66125306df91f6.06694475.jpg'),
(300, 228, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_66125306e0dd17.14916340.jpg'),
(301, 229, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_661253565c5107.04105261.jpg'),
(301, 230, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_661253565d3797.60413252.jpg'),
(301, 231, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_661253565ded63.47535864.jpg'),
(301, 232, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_66125356605bd1.71101405.jpg'),
(302, 233, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612539d762fb0.86168483.jpg'),
(302, 234, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612539d7749d4.95570644.jpg'),
(303, 235, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_661253ee2a3789.65241971.jpg'),
(303, 236, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_661253ee2b0ca5.94658568.jpg'),
(303, 237, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_661253ee334c34.91342309.jpg'),
(303, 238, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_661253ee3b4e39.05879810.jpg'),
(304, 239, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612541b0b0d27.60759049.jpg'),
(304, 240, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612541b0d7642.60845611.jpg'),
(304, 241, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612541b115939.05665807.jpg'),
(304, 242, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612541b1547f5.42876613.jpg'),
(305, 243, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612542bd35da0.66006079.jpg'),
(305, 244, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612542bd715c1.77520296.jpg'),
(305, 245, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612542bd84f64.08878420.jpg'),
(305, 246, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612542bd99c02.85149394.jpg'),
(305, 247, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612542bdab446.93503502.jpg'),
(305, 248, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612542bdb9807.04448580.jpg'),
(305, 249, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612542be28e71.72034623.jpg'),
(305, 250, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612542be36c26.50746248.jpg'),
(305, 251, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_661254558cba46.42499421.jpg'),
(305, 252, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_661254558db946.11232999.jpg'),
(305, 253, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_661254558e87e2.37268756.jpg'),
(305, 254, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_661254558f59f8.98145155.jpg'),
(305, 255, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_66125455909006.18086951.jpg'),
(305, 256, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_66125455913476.17714303.jpg'),
(309, 257, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612eef79fa375.62987406.jpg'),
(309, 258, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612eef7a09284.50282361.jpg'),
(309, 259, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612eef7a159f5.42869108.jpg'),
(310, 260, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612ef160ead15.90642317.jpg'),
(310, 261, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612ef1614c788.65402426.jpg'),
(310, 262, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612ef16166dd2.74554387.jpg'),
(310, 263, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612ef16188267.24020603.jpg'),
(310, 264, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612ef16197f02.84420661.jpg'),
(310, 265, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612ef161a8690.44661525.jpg'),
(311, 266, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612ef2c298ff4.55878494.jpg'),
(311, 267, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612ef2c2db240.78675059.jpg'),
(311, 268, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612ef2c2eb5d2.21908815.jpg'),
(311, 269, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612ef2c2fbfc1.14058568.jpg'),
(311, 270, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612ef2c3528c0.52502791.jpg'),
(311, 271, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612ef2c35ff93.05748137.jpg'),
(312, 272, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612ef40593124.73799518.jpg'),
(312, 273, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612ef405cb836.50237511.jpg'),
(312, 274, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612ef405e5b30.32800402.jpg'),
(312, 275, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612ef405fba71.71280543.jpg'),
(312, 276, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612ef40612a25.19091004.jpg'),
(312, 277, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612ef406fa0d0.89793917.jpg'),
(312, 278, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612ef40732987.03683005.jpg'),
(312, 279, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612ef602f1886.29221346.jpg'),
(312, 280, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612ef60332fd1.71035891.jpg'),
(312, 281, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612ef6033f456.23830141.jpg'),
(312, 282, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612ef6034c934.15397922.jpg'),
(313, 283, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612ef7c03b688.12896168.jpg'),
(313, 284, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612ef7c04da65.43432670.jpg'),
(313, 285, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612ef7c05ca51.77886624.jpg'),
(313, 286, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612ef7c068f77.30977676.jpg'),
(313, 287, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612ef7c0755c0.09712568.jpg'),
(313, 288, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612ef7c0a1631.36515201.jpg'),
(313, 289, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612ef7c0b3394.26772974.jpg'),
(314, 290, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612f24da6caf6.39492672.jpg'),
(314, 291, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612f24eab1f75.18676815.jpg'),
(314, 292, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612f24faeade8.48686727.jpg'),
(314, 293, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612f250b308b2.45594249.jpg'),
(314, 294, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612f251b4dd91.03986949.jpg'),
(314, 295, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612f264e9d5c0.81395604.jpg'),
(314, 296, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612f264edc2f9.06031841.jpg'),
(314, 297, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612f264f20c86.06230575.jpg'),
(314, 298, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612f264f2cc03.93682066.jpg'),
(314, 299, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612f264f38b58.26473192.jpg'),
(315, 300, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612f635137af8.54872006.jpg'),
(315, 301, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612f6351a10a4.69251159.jpg'),
(316, 302, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612f649a95b89.59083370.jpg'),
(316, 303, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612f649acfd52.63463419.jpg'),
(316, 304, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612f649adc464.78337205.jpg'),
(316, 305, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612f649aea618.89608039.jpg'),
(317, 306, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612f67552c840.04399665.jpg'),
(317, 307, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612f675569503.44195631.jpg'),
(317, 308, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612f675576605.40213422.jpg'),
(318, 309, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612f87961cc71.59806874.jpg'),
(318, 310, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612f87963f7a3.62863666.jpg'),
(318, 311, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612f87964c571.76334736.jpg'),
(318, 312, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612f87967f1b9.60273911.jpg'),
(319, 313, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612f8a40f6270.18141026.jpg'),
(319, 314, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612f8a410d2a2.88309605.jpg'),
(319, 315, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612f8a412fe99.69831908.jpg'),
(319, 316, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612f8a416a9f4.34570598.jpg'),
(320, 317, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612f8b10b6519.10268068.jpg'),
(320, 318, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612f8b10d34a1.12813693.jpg'),
(320, 319, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612f8b10e1cf6.35422104.jpg'),
(321, 320, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612f8be0662d7.82491627.jpg'),
(321, 321, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612f8be0df8d3.12419353.jpg'),
(322, 322, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612f8c95164b2.05824981.jpg'),
(322, 323, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612f8c953ac08.69368220.jpg'),
(323, 324, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612f8d6526346.31441297.jpg'),
(323, 325, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612f8d65356b0.22642891.jpg'),
(325, 326, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612f9ba0670b4.47268443.jpg'),
(325, 327, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612f9ba091219.20515947.jpg'),
(325, 328, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6612f9ba0a1bf0.23554455.jpg'),
(331, 329, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_66140386a483b3.72730477.jpg'),
(332, 330, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6614083469b858.22152976.jpg'),
(332, 331, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_661408346c2174.36214173.jpg'),
(332, 332, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_661408346ce428.27440490.jpg'),
(330, 333, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_661425265cfcb7.58991762.jpg'),
(330, 334, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_661425265f1911.64995819.jpg'),
(327, 335, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_66142544648053.03312419.jpg'),
(327, 336, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_66142544672ed6.36097296.jpg'),
(327, 337, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_661425446820b2.18261685.jpg'),
(333, 338, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_661425a901e376.85673672.jpg'),
(333, 339, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_661425a9034342.64030613.jpg'),
(333, 340, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_661425a90686c4.60746124.jpg'),
(333, 341, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_661425a90e4781.42115737.jpg'),
(334, 342, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_66157092eea727.32362755.jpg'),
(335, 343, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6615727a79ea28.55565326.jpg'),
(335, 344, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6615727a7ad0a1.88746273.jpg'),
(336, 345, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_66158971712231.03842805.jpg'),
(336, 346, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_66158971724504.20942812.jpg'),
(348, 347, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6615931ee89b46.68389928.jpg'),
(348, 348, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6615931eecb6f0.91822363.jpg'),
(348, 349, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6615931eedc382.43811801.jpg'),
(348, 350, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6615931eeecd65.30951209.jpg'),
(349, 351, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_66159335e4c1a6.45182506.jpg'),
(350, 352, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_661593fda92a37.67949482.jpg'),
(350, 353, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_661593fdaa0bc2.89701187.jpg'),
(352, 354, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6615941cef6d54.47085722.jpg'),
(352, 355, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_6615941cf30e68.48603451.jpg'),
(351, 356, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_66159590a95757.63307779.jpg'),
(351, 357, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_66159590abe6e3.32464359.jpg'),
(351, 358, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_661595eb239341.73686333.jpg'),
(353, 359, 'C:/xampp/htdocs/eWork_collab/upload/progress_img/progress_661596243c2728.69282602.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_recyclebin`
--

CREATE TABLE `tbl_recyclebin` (
  `job_id` int(11) NOT NULL,
  `creator_name` varchar(50) NOT NULL,
  `time_created` datetime NOT NULL,
  `job_status` varchar(50) DEFAULT NULL,
  `assigned_artist` varchar(50) DEFAULT NULL,
  `job_subject` text NOT NULL,
  `job_brief` longtext NOT NULL,
  `estimated_completion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_recyclebin_account_request`
--

CREATE TABLE `tbl_recyclebin_account_request` (
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `job_description` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact_number` varchar(50) NOT NULL,
  `user_password` text NOT NULL,
  `request_time` datetime NOT NULL,
  `username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_recyclebin_account_request`
--

INSERT INTO `tbl_recyclebin_account_request` (`firstname`, `lastname`, `job_description`, `email`, `contact_number`, `user_password`, `request_time`, `username`) VALUES
('Liam', 'Martinez', 'Agent', 'liam.martinez@example.com', '333-444-5555', 'liampass', '2024-01-16 12:10:06', 'liamart'),
('Grace', 'Sullivan', 'Project Coordinator', 'gracesullivan@example.com', '222-333-4444', 'projectcoordinator456', '2024-02-09 11:00:00', 'gracesullivan'),
('Lucas', 'Barnes', 'Customer Service Representative', 'lucasbarnes@example.com', '999-000-1111', 'customerservice789', '2024-02-09 12:00:00', 'lucasbarnes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reference_images`
--

CREATE TABLE `tbl_reference_images` (
  `job_id` int(11) NOT NULL,
  `image_id` int(11) NOT NULL,
  `filepath_reference_image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_reference_images`
--

INSERT INTO `tbl_reference_images` (`job_id`, `image_id`, `filepath_reference_image`) VALUES
(310, 197, 'C:/xampp/htdocs/eWork_collab/upload/reference_img/reference_6612eebf6451b4.27026037.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_templatelist`
--

CREATE TABLE `tbl_templatelist` (
  `template_id` int(11) NOT NULL,
  `template_name` varchar(50) NOT NULL,
  `template_processes` int(11) DEFAULT NULL,
  `filepath_templateimage` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_templatelist`
--

INSERT INTO `tbl_templatelist` (`template_id`, `template_name`, `template_processes`, `filepath_templateimage`) VALUES
(16, 'testTemplate', 7, NULL),
(17, 'test2', 3, '../upload/template_img/660509b849d40.png'),
(18, 'AnotherTemplate', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_template_processes`
--

CREATE TABLE `tbl_template_processes` (
  `template_id` int(11) NOT NULL,
  `process_id` int(11) NOT NULL,
  `process_name` varchar(50) NOT NULL,
  `duration` int(11) DEFAULT NULL,
  `duration_option` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_template_processes`
--

INSERT INTO `tbl_template_processes` (`template_id`, `process_id`, `process_name`, `duration`, `duration_option`) VALUES
(11, 5, 'Design', 123, 'setNow'),
(11, 6, 'TheWha', NULL, 'salesagent'),
(11, 7, '123', 123, 'setNow'),
(12, 8, '123', NULL, 'salesagent'),
(12, 9, '1233', NULL, 'salesagent'),
(12, 10, '12333', NULL, 'salesagent'),
(13, 11, '123', NULL, 'salesagent'),
(13, 12, '1233', NULL, 'salesagent'),
(13, 13, '12333', NULL, 'salesagent'),
(14, 14, '123', NULL, 'salesagent'),
(14, 15, '123', NULL, 'salesagent'),
(15, 16, 'Designing', 25, 'setNow'),
(15, 17, 'Printing', NULL, 'salesagent'),
(15, 18, 'Sublimation', NULL, 'salesagent'),
(15, 19, 'Cutting', NULL, 'salesagent'),
(15, 20, 'Quality control', NULL, 'salesagent'),
(16, 21, 'Design', 23, 'setNow'),
(16, 22, 'Check Design', 23, 'setNow'),
(16, 23, 'Approve/Deny Design', 23, 'setNow'),
(16, 24, 'Cut', 23, 'setNow'),
(16, 25, 'Sublimation', 23, 'setNow'),
(16, 26, 'Quality Control', 23, 'setNow'),
(16, 27, 'Packing', 23, 'setNow'),
(17, 28, 'asdf', NULL, 'salesagent'),
(17, 29, 'asdf', 2345, 'setNow'),
(17, 30, 'asdf', 2345, 'setNow'),
(18, 31, 'Design', 345, 'setNow');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_userlist`
--

CREATE TABLE `tbl_userlist` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `job_position` varchar(50) NOT NULL,
  `user_password` text NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_contactnumber` varchar(50) NOT NULL,
  `user_firstname` varchar(50) NOT NULL,
  `user_lastname` varchar(50) NOT NULL,
  `account_activation` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1 - activated, 0 - deactivated',
  `reset_token` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_userlist`
--

INSERT INTO `tbl_userlist` (`user_id`, `username`, `job_position`, `user_password`, `user_email`, `user_contactnumber`, `user_firstname`, `user_lastname`, `account_activation`, `reset_token`) VALUES
(1, 'admin', 'Superadmin', '123', 'adminemail', '', '', '', 1, NULL),
(2, 'agent', 'Agent', '123', 'agentemail', '', '', '', 1, NULL),
(4, 'manager', 'Manager', '123', 'manageremail', '', '', '', 1, NULL),
(5, 'artist', 'Artist', '123', 'asdf', '09171924809', 'jay', 'penaojas', 1, NULL),
(127, 'artistTest', 'Artist', '123', '', '', '', '', 1, NULL);

--
-- Triggers `tbl_userlist`
--
DELIMITER $$
CREATE TRIGGER `after_userlist_insert` AFTER INSERT ON `tbl_userlist` FOR EACH ROW BEGIN
  IF NEW.job_position = 'Artist' THEN
    INSERT INTO tbl_artist_status (artist_name, artist_id)
    VALUES (NEW.username, NEW.user_id); 
  END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `copy_user_to_status` AFTER INSERT ON `tbl_userlist` FOR EACH ROW BEGIN
    INSERT INTO tbl_user_status (user_id, username, job_position)
    VALUES (NEW.user_id, NEW.username, NEW.job_position);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_profileimage`
--

CREATE TABLE `tbl_user_profileimage` (
  `user_id` int(11) NOT NULL,
  `filepath_profileimage` text DEFAULT NULL,
  `index_profileimage` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_user_profileimage`
--

INSERT INTO `tbl_user_profileimage` (`user_id`, `filepath_profileimage`, `index_profileimage`) VALUES
(1, NULL, 1),
(2, 'C:/xampp/htdocs/ework_collab/upload/profile_images/profile_660cd9b2631634.83568068.png', 2),
(4, 'C:/xampp/htdocs/ework_collab/upload/profile_images/profile_65bf9e3cd11c37.80908924.jpg', 8);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_status`
--

CREATE TABLE `tbl_user_status` (
  `username` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  `status_starttime` datetime DEFAULT NULL,
  `status_endtime` datetime DEFAULT NULL,
  `job_position` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_user_status`
--

INSERT INTO `tbl_user_status` (`username`, `user_id`, `status`, `status_starttime`, `status_endtime`, `job_position`) VALUES
('admin', 1, 'online', '2024-04-11 02:49:01', NULL, 'Superadmin'),
('agent', 2, 'offline', '2024-04-10 02:50:12', NULL, 'Agent'),
('artist', 5, 'offline', '2024-04-10 21:25:11', NULL, 'Artist'),
('artistTest', 127, 'offline', NULL, NULL, 'Artist'),
('manager', 4, 'offline', '2024-04-10 21:25:49', NULL, 'Manager');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_account_request`
--
ALTER TABLE `tbl_account_request`
  ADD PRIMARY KEY (`tbl_accreq_id`);

--
-- Indexes for table `tbl_artist_status`
--
ALTER TABLE `tbl_artist_status`
  ADD UNIQUE KEY `artist_name` (`artist_name`),
  ADD KEY `tbl_artist_status_ibfk_1` (`current_jobID`);

--
-- Indexes for table `tbl_invitations`
--
ALTER TABLE `tbl_invitations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_jobs`
--
ALTER TABLE `tbl_jobs`
  ADD PRIMARY KEY (`job_id`);

--
-- Indexes for table `tbl_jobs_processes`
--
ALTER TABLE `tbl_jobs_processes`
  ADD PRIMARY KEY (`job_process_id`);

--
-- Indexes for table `tbl_jobs_progress`
--
ALTER TABLE `tbl_jobs_progress`
  ADD PRIMARY KEY (`progress_id`),
  ADD KEY `job_id` (`job_id`);

--
-- Indexes for table `tbl_progress_images`
--
ALTER TABLE `tbl_progress_images`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `tbl_reference_images_ibfk_1` (`job_id`);

--
-- Indexes for table `tbl_recyclebin`
--
ALTER TABLE `tbl_recyclebin`
  ADD PRIMARY KEY (`job_id`);

--
-- Indexes for table `tbl_reference_images`
--
ALTER TABLE `tbl_reference_images`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `tbl_reference_images_ibfk_1` (`job_id`);

--
-- Indexes for table `tbl_templatelist`
--
ALTER TABLE `tbl_templatelist`
  ADD PRIMARY KEY (`template_id`),
  ADD UNIQUE KEY `template_name` (`template_name`);

--
-- Indexes for table `tbl_template_processes`
--
ALTER TABLE `tbl_template_processes`
  ADD PRIMARY KEY (`process_id`),
  ADD KEY `template_id` (`template_id`);

--
-- Indexes for table `tbl_userlist`
--
ALTER TABLE `tbl_userlist`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `reset_token` (`reset_token`);

--
-- Indexes for table `tbl_user_profileimage`
--
ALTER TABLE `tbl_user_profileimage`
  ADD PRIMARY KEY (`index_profileimage`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tbl_user_status`
--
ALTER TABLE `tbl_user_status`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_account_request`
--
ALTER TABLE `tbl_account_request`
  MODIFY `tbl_accreq_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `tbl_invitations`
--
ALTER TABLE `tbl_invitations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_jobs`
--
ALTER TABLE `tbl_jobs`
  MODIFY `job_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=379;

--
-- AUTO_INCREMENT for table `tbl_jobs_processes`
--
ALTER TABLE `tbl_jobs_processes`
  MODIFY `job_process_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;

--
-- AUTO_INCREMENT for table `tbl_jobs_progress`
--
ALTER TABLE `tbl_jobs_progress`
  MODIFY `progress_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_progress_images`
--
ALTER TABLE `tbl_progress_images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=360;

--
-- AUTO_INCREMENT for table `tbl_recyclebin`
--
ALTER TABLE `tbl_recyclebin`
  MODIFY `job_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `tbl_reference_images`
--
ALTER TABLE `tbl_reference_images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=198;

--
-- AUTO_INCREMENT for table `tbl_templatelist`
--
ALTER TABLE `tbl_templatelist`
  MODIFY `template_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_template_processes`
--
ALTER TABLE `tbl_template_processes`
  MODIFY `process_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `tbl_userlist`
--
ALTER TABLE `tbl_userlist`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT for table `tbl_user_profileimage`
--
ALTER TABLE `tbl_user_profileimage`
  MODIFY `index_profileimage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_jobs_progress`
--
ALTER TABLE `tbl_jobs_progress`
  ADD CONSTRAINT `tbl_jobs_progress_ibfk_1` FOREIGN KEY (`job_id`) REFERENCES `tbl_jobs` (`job_id`);

--
-- Constraints for table `tbl_reference_images`
--
ALTER TABLE `tbl_reference_images`
  ADD CONSTRAINT `tbl_reference_images_ibfk_1` FOREIGN KEY (`job_id`) REFERENCES `tbl_jobs` (`job_id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_user_profileimage`
--
ALTER TABLE `tbl_user_profileimage`
  ADD CONSTRAINT `tbl_user_profileimage_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_userlist` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_user_status`
--
ALTER TABLE `tbl_user_status`
  ADD CONSTRAINT `tbl_user_status_ibfk_1` FOREIGN KEY (`username`) REFERENCES `tbl_userlist` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
