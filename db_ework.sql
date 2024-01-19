-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 19, 2024 at 03:44 PM
-- Server version: 8.0.32
-- PHP Version: 8.1.10

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
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `job_description` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact_number` varchar(50) NOT NULL,
  `user_password` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `request_time` datetime NOT NULL,
  `username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_account_request`
--

INSERT INTO `tbl_account_request` (`firstname`, `lastname`, `job_description`, `email`, `contact_number`, `user_password`, `request_time`, `username`) VALUES
('Ava', 'Lee', 'Agent', 'ava.lee@example.com', '222-333-4444', 'avapass', '2024-01-16 11:33:12', 'ava007'),
('Mia', 'Garcia', 'Manager', 'mia.garcia@example.com', '888-999-0000', 'miapass', '2024-01-16 11:33:12', 'miamgr'),
('Ethan', 'Wilson', 'Manager', 'ethan.wilson@example.com', '666-777-8888', 'ethanpass', '2024-01-16 11:33:12', 'ethanmgr');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_actionlogs`
--

CREATE TABLE `tbl_actionlogs` (
  `action` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_artist_status`
--

CREATE TABLE `tbl_artist_status` (
  `artist_name` varchar(50) NOT NULL,
  `artist_status` varchar(50) NOT NULL,
  `completion_percentage` int DEFAULT NULL,
  `artist_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_artist_status`
--

INSERT INTO `tbl_artist_status` (`artist_name`, `artist_status`, `completion_percentage`, `artist_id`) VALUES
('Alice Johnson', 'Active', 95, 3),
('artist', 'busy', 0, 2),
('artist_Stan', 'open', NULL, NULL),
('Bob Williams', 'Inactive', 75, 4),
('Eva Davis', 'Active', 70, 5),
('Jane Smith', 'Inactive', 60, 2),
('John Doe', 'Active', 85, 1),
('johndoe123', 'open', NULL, NULL),
('Liam Jackson', 'Active', 78, 10),
('Michael Brown', 'Active', 88, 6),
('Olivia Miller', 'Inactive', 45, 7),
('Sophia Anderson', 'Inactive', 55, 9),
('William Wilson', 'Active', 92, 8);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jobs`
--

CREATE TABLE `tbl_jobs` (
  `job_id` int NOT NULL,
  `creator_name` varchar(50) NOT NULL,
  `time_created` datetime NOT NULL,
  `job_status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `assigned_artist` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `job_subject` text NOT NULL,
  `job_brief` longtext NOT NULL,
  `estimated_completion` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_jobs`
--

INSERT INTO `tbl_jobs` (`job_id`, `creator_name`, `time_created`, `job_status`, `assigned_artist`, `job_subject`, `job_brief`, `estimated_completion`) VALUES
(1, 'John Doe', '2024-01-15 08:00:00', 'Pending', 'Alice Johnson', 'Website Redesign', 'Redesign our company website with a modern look.', 20240215),
(2, 'Jane Smith', '2024-02-10 14:30:00', 'In Progress', 'Bob Williams', 'Marketing Campaign', 'Create a marketing campaign for our new product launch.', 20240310),
(3, 'Eva Davis', '2024-03-20 10:15:00', 'Completed', 'Michael Brown', 'Product Packaging Design', 'Design packaging for our new product line.', 20240420),
(4, 'William Wilson', '2024-02-14 11:45:00', 'Pending', 'Sophia Anderson', 'Social Media Promotion', 'Create a social media promotion plan for upcoming events.', 20240305),
(5, 'Liam Jackson', '2024-03-05 09:20:00', 'In Progress', 'Olivia Miller', 'Content Writing', 'Write content for our blog and website.', 20240325),
(6, 'Oliver Harris', '2024-03-25 16:40:00', 'Completed', 'Emma White', 'Logo Redesign', 'Redesign our company logo for a fresh look.', 20240410),
(7, 'Ava Taylor', '2024-02-07 17:55:00', 'Pending', 'Daniel Lee', 'Video Production', 'Produce promotional videos for our new product.', 20240315),
(8, 'Mia Martinez', '2024-03-10 12:30:00', 'In Progress', 'James Clark', 'Event Planning', 'Plan and coordinate our annual company event.', 20240501),
(9, 'Sophie Turner', '2024-04-05 07:20:00', 'Completed', 'Ethan Brown', 'Market Research', 'Conduct market research for a new product launch.', 20240430),
(10, 'Noah Davis', '2024-02-28 19:10:00', 'Pending', 'Aria Johnson', 'Graphic Design', 'Design graphics for our marketing materials.', 20240308);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jobs_progress`
--

CREATE TABLE `tbl_jobs_progress` (
  `progress_id` int NOT NULL,
  `job_id` int NOT NULL,
  `progress_measurement` int NOT NULL,
  `job_starttime` datetime NOT NULL,
  `job_endttime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_production`
--

CREATE TABLE `tbl_production` (
  `Task` varchar(50) NOT NULL,
  `ProdTime` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_recyclebin`
--

CREATE TABLE `tbl_recyclebin` (
  `job_id` int NOT NULL,
  `creator_name` varchar(50) NOT NULL,
  `time_created` datetime NOT NULL,
  `job_status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `assigned_artist` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `job_subject` text NOT NULL,
  `job_brief` longtext NOT NULL,
  `estimated_completion` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  `user_password` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `request_time` datetime NOT NULL,
  `username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_recyclebin_account_request`
--

INSERT INTO `tbl_recyclebin_account_request` (`firstname`, `lastname`, `job_description`, `email`, `contact_number`, `user_password`, `request_time`, `username`) VALUES
('Liam', 'Martinez', 'Agent', 'liam.martinez@example.com', '333-444-5555', 'liampass', '2024-01-16 12:10:06', 'liamart');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_userlist`
--

CREATE TABLE `tbl_userlist` (
  `user_id` int NOT NULL,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `job_position` varchar(50) NOT NULL,
  `user_password` text NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_contactnumber` varchar(50) NOT NULL,
  `user_firstname` varchar(50) NOT NULL,
  `user_lastname` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_userlist`
--

INSERT INTO `tbl_userlist` (`user_id`, `username`, `job_position`, `user_password`, `user_email`, `user_contactnumber`, `user_firstname`, `user_lastname`) VALUES
(1, 'admin', 'Superadmin', '123', 'adminemail', '', '', ''),
(2, 'agent', 'Agent', '123', 'agentemail', '', '', ''),
(3, 'artist', 'Artist', '123', 'artistemail', '', '', ''),
(4, 'manager', 'Manager', '123', 'manageremail', '', '', ''),
(50, 'johndoe123', 'Artist', 'password123', 'john.doe@example.com', '123-456-7890', 'John', 'Doe'),
(51, 'alicesmith007', 'Manager', 'secret123', 'alice.smith@example.com', '987-654-3210', 'Alice', 'Smith'),
(57, 'bobart', 'Manager', 'artistic456', 'bob.johnson@example.com', '555-123-4567', 'Bob', 'Johnson');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_status`
--

CREATE TABLE `tbl_user_status` (
  `statusID` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `status_starttime` datetime NOT NULL,
  `status_endtime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_artist_status`
--
ALTER TABLE `tbl_artist_status`
  ADD UNIQUE KEY `artist_name` (`artist_name`);

--
-- Indexes for table `tbl_jobs`
--
ALTER TABLE `tbl_jobs`
  ADD PRIMARY KEY (`job_id`);

--
-- Indexes for table `tbl_jobs_progress`
--
ALTER TABLE `tbl_jobs_progress`
  ADD PRIMARY KEY (`progress_id`),
  ADD KEY `job_id` (`job_id`);

--
-- Indexes for table `tbl_recyclebin`
--
ALTER TABLE `tbl_recyclebin`
  ADD PRIMARY KEY (`job_id`);

--
-- Indexes for table `tbl_userlist`
--
ALTER TABLE `tbl_userlist`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `tbl_user_status`
--
ALTER TABLE `tbl_user_status`
  ADD PRIMARY KEY (`statusID`),
  ADD KEY `tbl_user_status_ibfk_1` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_jobs`
--
ALTER TABLE `tbl_jobs`
  MODIFY `job_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `tbl_jobs_progress`
--
ALTER TABLE `tbl_jobs_progress`
  MODIFY `progress_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_recyclebin`
--
ALTER TABLE `tbl_recyclebin`
  MODIFY `job_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_jobs_progress`
--
ALTER TABLE `tbl_jobs_progress`
  ADD CONSTRAINT `tbl_jobs_progress_ibfk_1` FOREIGN KEY (`job_id`) REFERENCES `tbl_jobs` (`job_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `tbl_user_status`
--
ALTER TABLE `tbl_user_status`
  ADD CONSTRAINT `tbl_user_status_ibfk_1` FOREIGN KEY (`username`) REFERENCES `tbl_userlist` (`username`) ON DELETE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
