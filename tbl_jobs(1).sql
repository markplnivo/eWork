-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2024 at 08:02 PM
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
(363, 'agent', '2024-04-10 02:10:10', 'completed', 'artist', '', '', 'Open to All', 'Manually', NULL, 'Artist', NULL, NULL, NULL, '2024-04-11 17:43:46', '2024-04-11 17:44:01'),
(364, 'agent', '2024-04-10 02:10:13', 'pending', 'artist', '', '', 'Open to All', 'Manually', NULL, 'Artist', NULL, NULL, NULL, '2024-04-11 17:44:41', NULL),
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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_jobs`
--
ALTER TABLE `tbl_jobs`
  ADD PRIMARY KEY (`job_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_jobs`
--
ALTER TABLE `tbl_jobs`
  MODIFY `job_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=379;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
