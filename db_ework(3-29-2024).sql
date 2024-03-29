-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 29, 2024 at 09:16 AM
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
-- Dumping data for table `tbl_account_request`
--

INSERT INTO `tbl_account_request` (`firstname`, `lastname`, `job_description`, `email`, `contact_number`, `user_password`, `request_time`, `username`) VALUES
('Mia', 'Garcia', 'Manager', 'mia.garcia@example.com', '888-999-0000', 'miapass', '2024-01-16 11:33:12', 'miamgr'),
('Ethan', 'Wilson', 'Manager', 'ethan.wilson@example.com', '666-777-8888', 'ethanpass', '2024-01-16 11:33:12', 'ethanmgr'),
('John', 'Doe', 'Software Engineer', 'johndoe@example.com', '123-456-7890', 'abc123', '2024-02-08 10:15:00', 'johndoe'),
('Jane', 'Smith', 'Marketing Manager', 'janesmith@example.com', '987-654-3210', 'marketing123', '2024-02-08 11:30:00', 'janesmith'),
('Michael', 'Johnson', 'Financial Analyst', 'michaeljohnson@example.com', '555-123-4567', 'finance456', '2024-02-08 12:45:00', 'michaeljohnson'),
('Emily', 'Brown', 'Graphic Designer', 'emilybrown@example.com', '777-555-1234', 'design789', '2024-02-08 14:00:00', 'emilybrown'),
('David', 'Lee', 'Sales Representative', 'davidlee@example.com', '321-654-9870', 'sales567', '2024-02-08 15:15:00', 'davidlee'),
('Sarah', 'Adams', 'HR Specialist', 'sarahadams@example.com', '444-333-2222', 'hr999', '2024-02-08 16:30:00', 'sarahadams'),
('Kevin', 'Garcia', 'Project Manager', 'kevingarcia@example.com', '666-777-8888', 'project321', '2024-02-08 17:45:00', 'kevingarcia'),
('Jessica', 'Martinez', 'Customer Support Specialist', 'jessicamartinez@example.com', '999-888-7777', 'support123', '2024-02-08 19:00:00', 'jessicamartinez'),
('Ryan', 'Taylor', 'Operations Manager', 'ryantaylor@example.com', '222-333-4444', 'operations789', '2024-02-08 20:15:00', 'ryantaylor'),
('Kimberly', 'Rodriguez', 'Data Analyst', 'kimberlyrodriguez@example.com', '111-222-3333', 'data456', '2024-02-08 21:30:00', 'kimberlyrodriguez'),
('Alex', 'Wilson', 'Software Developer', 'alexwilson@example.com', '555-444-3333', 'dev123', '2024-02-08 09:00:00', 'alexwilson'),
('Rachel', 'Thompson', 'UX/UI Designer', 'rachelthompson@example.com', '333-444-5555', 'designer456', '2024-02-08 10:00:00', 'rachelthompson'),
('Tyler', 'Evans', 'Marketing Coordinator', 'tylerevans@example.com', '777-888-9999', 'marketing678', '2024-02-08 11:00:00', 'tylerevans'),
('Amanda', 'Gonzalez', 'Financial Advisor', 'amandagonzalez@example.com', '111-222-3333', 'finance987', '2024-02-08 12:00:00', 'amandagonzalez'),
('Brandon', 'White', 'Sales Manager', 'brandonwhite@example.com', '444-555-6666', 'salesmanager123', '2024-02-08 13:00:00', 'brandonwhite'),
('Michelle', 'Clark', 'HR Coordinator', 'michelleclark@example.com', '222-333-4444', 'hrcoordinator456', '2024-02-08 14:00:00', 'michelleclark'),
('Daniel', 'Martinez', 'Project Coordinator', 'danielmartinez@example.com', '666-777-8888', 'projectcoordinator789', '2024-02-08 15:00:00', 'danielmartinez'),
('Olivia', 'Hernandez', 'Customer Service Representative', 'oliviahernandez@example.com', '555-666-7777', 'customerservice123', '2024-02-08 16:00:00', 'oliviahernandez'),
('Ethan', 'Lopez', 'Operations Coordinator', 'ethanlopez@example.com', '333-444-5555', 'operationscoordinator456', '2024-02-08 17:00:00', 'ethanlopez'),
('Sophia', 'Adams', 'Data Scientist', 'sophiaadams@example.com', '888-999-0000', 'data789', '2024-02-08 18:00:00', 'sophiaadams'),
('Christopher', 'Carter', 'Software Engineer', 'christophercarter@example.com', '777-888-9999', 'softwareengineer123', '2024-02-08 19:00:00', 'christophercarter'),
('Emma', 'Nelson', 'UX/UI Designer', 'emmanelson@example.com', '555-666-7777', 'uxdesigner456', '2024-02-08 20:00:00', 'emmanelson'),
('William', 'King', 'Marketing Analyst', 'williamking@example.com', '222-333-4444', 'marketinganalyst789', '2024-02-08 21:00:00', 'williamking'),
('Isabella', 'Wright', 'Financial Analyst', 'isabellawright@example.com', '999-000-1111', 'financialanalyst123', '2024-02-08 22:00:00', 'isabellawright'),
('Andrew', 'Perez', 'Sales Representative', 'andrewperez@example.com', '666-777-8888', 'salesrep456', '2024-02-08 23:00:00', 'andrewperez'),
('Mia', 'Garcia', 'HR Generalist', 'miagarcia@example.com', '333-444-5555', 'hrgeneralist789', '2024-02-09 00:00:00', 'miagarcia'),
('James', 'Sanchez', 'Project Manager', 'jamessanchez@example.com', '111-222-3333', 'projectmanager123', '2024-02-09 01:00:00', 'jamessanchez'),
('Ava', 'Rivera', 'Customer Support Specialist', 'avarivera@example.com', '777-888-9999', 'supportspecialist456', '2024-02-09 02:00:00', 'avarivera'),
('Logan', 'Ramirez', 'Operations Manager', 'loganramirez@example.com', '555-666-7777', 'operationsmanager789', '2024-02-09 03:00:00', 'loganramirez'),
('Charlotte', 'Torres', 'Data Analyst', 'charlottetorres@example.com', '222-333-4444', 'dataanalyst123', '2024-02-09 04:00:00', 'charlottetorres'),
('Benjamin', 'Long', 'Software Developer', 'benjaminlong@example.com', '999-000-1111', 'softwaredev456', '2024-02-09 05:00:00', 'benjaminlong'),
('Amelia', 'Cruz', 'UX/UI Designer', 'ameliacruz@example.com', '666-777-8888', 'uxdesigner789', '2024-02-09 06:00:00', 'ameliacruz'),
('Jacob', 'Gomez', 'Marketing Coordinator', 'jacobgomez@example.com', '333-444-5555', 'marketingcoordinator123', '2024-02-09 07:00:00', 'jacobgomez'),
('Sofia', 'Howard', 'Financial Advisor', 'sofiahoward@example.com', '111-222-3333', 'financialadvisor456', '2024-02-09 08:00:00', 'sofiahoward'),
('Avery', 'Foster', 'HR Coordinator', 'averyfoster@example.com', '555-666-7777', 'hrcoordinator123', '2024-02-09 10:00:00', 'averyfoster'),
('Grace', 'Sullivan', 'Project Coordinator', 'gracesullivan@example.com', '222-333-4444', 'projectcoordinator456', '2024-02-09 11:00:00', 'gracesullivan'),
('Lucas', 'Barnes', 'Customer Service Representative', 'lucasbarnes@example.com', '999-000-1111', 'customerservice789', '2024-02-09 12:00:00', 'lucasbarnes'),
('Lily', 'Coleman', 'Operations Coordinator', 'lilycoleman@example.com', '666-777-8888', 'operationscoordinator123', '2024-02-09 13:00:00', 'lilycoleman');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_actionlogs`
--

CREATE TABLE `tbl_actionlogs` (
  `action` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_artist_status`
--

CREATE TABLE `tbl_artist_status` (
  `artist_name` varchar(50) NOT NULL,
  `artist_status` varchar(50) NOT NULL,
  `completion_percentage` int(11) DEFAULT NULL,
  `artist_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_artist_status`
--

INSERT INTO `tbl_artist_status` (`artist_name`, `artist_status`, `completion_percentage`, `artist_id`) VALUES
('Alice Johnson', 'Active', 95, 3),
('artist', 'busy', 0, 2),
('artist_Stan', 'open', NULL, NULL),
('Bob Williams', 'Inactive', 75, 4),
('Eva Davis', 'Active', 70, 5),
('jacksonmitchell', 'open', NULL, NULL),
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
  `job_id` int(11) NOT NULL,
  `creator_name` varchar(50) NOT NULL,
  `time_created` datetime NOT NULL,
  `job_status` varchar(50) DEFAULT NULL,
  `assigned_artist` varchar(50) DEFAULT NULL,
  `job_subject` text NOT NULL,
  `job_brief` longtext NOT NULL,
  `estimated_completion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_jobs`
--

INSERT INTO `tbl_jobs` (`job_id`, `creator_name`, `time_created`, `job_status`, `assigned_artist`, `job_subject`, `job_brief`, `estimated_completion`) VALUES
(1, 'John Doe', '2024-03-26 09:00:00', 'ongoing', 'artist', 'Graphic Design', 'Design a logo for company XYZ', '0000-00-00'),
(2, 'Jane Smith', '2024-03-26 09:15:00', 'ongoing', 'artist', 'Content Writing', 'Write blog post about technology trends', '0000-00-00'),
(3, 'Emily Brown', '2024-03-26 09:30:00', 'open', 'Charlie', 'Video Editing', 'Edit promotional video for product launch', '0000-00-00'),
(4, 'Michael Johnson', '2024-03-26 09:45:00', 'ongoing', 'artist', 'Web Development', 'Develop landing page for new website', '0000-00-00'),
(5, 'Sarah Wilson', '2024-03-26 10:00:00', 'open', 'Emma', 'Social Media Management', 'Create social media content calendar', '0000-00-00'),
(6, 'James Lee', '2024-03-26 10:15:00', 'open', 'Fiona', 'Photography', 'Photoshoot for product catalog', '0000-00-00'),
(7, 'Olivia Garcia', '2024-03-26 10:30:00', 'open', 'George', 'Marketing Strategy', 'Develop marketing plan for upcoming campaign', '0000-00-00'),
(8, 'William Martinez', '2024-03-26 10:45:00', 'open', 'Hannah', 'SEO Optimization', 'Optimize website for better search engine ranking', '0000-00-00'),
(9, 'Ethan Anderson', '2024-03-26 11:00:00', 'open', 'Isabella', 'UI/UX Design', 'Design user interface for mobile app', '0000-00-00'),
(10, 'Ava Thomas', '2024-03-26 11:15:00', 'open', 'Jack', 'Content Editing', 'Edit manuscript for grammar and coherence', '0000-00-00'),
(74, 'agent', '2024-03-28 18:15:12', 'open', NULL, '3322', '2223', '0000-00-00'),
(77, 'agent', '2024-03-28 19:23:02', 'open', NULL, 'ASDF', '232323', '0000-00-00'),
(78, 'agent', '2024-03-28 19:23:37', 'open', NULL, '123', '123', '0000-00-00'),
(79, 'agent', '2024-03-28 19:24:32', 'open', NULL, 'asd123', 'asd1233', '0000-00-00');

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

--
-- Dumping data for table `tbl_recyclebin`
--

INSERT INTO `tbl_recyclebin` (`job_id`, `creator_name`, `time_created`, `job_status`, `assigned_artist`, `job_subject`, `job_brief`, `estimated_completion`) VALUES
(1, 'John Doe', '2024-01-15 08:00:00', 'Pending', 'Alice Johnson', 'Website Redesign', 'Redesign our company website with a modern look.', 20240215),
(2, 'Jane Smith', '2024-02-10 14:30:00', 'In Progress', 'Bob Williams', 'Marketing Campaign', 'Create a marketing campaign for our new product launch.', 20240310),
(4, 'William Wilson', '2024-02-14 11:45:00', 'Pending', 'Sophia Anderson', 'Social Media Promotion', 'Create a social media promotion plan for upcoming events.', 20240305);

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
('Liam', 'Martinez', 'Agent', 'liam.martinez@example.com', '333-444-5555', 'liampass', '2024-01-16 12:10:06', 'liamart');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reference_images`
--

CREATE TABLE `tbl_reference_images` (
  `job_id` int(11) NOT NULL,
  `image_id` int(11) NOT NULL,
  `filepath_reference_image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(17, 'test2', 3, '../upload/template_img/660509b849d40.png');

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
(17, 30, 'asdf', 2345, 'setNow');

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
  `user_lastname` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(57, 'bobart', 'Manager', 'artistic456', 'bob.johnson@example.com', '555-123-4567', 'Bob', 'Johnson'),
(58, 'ava007', 'Agent', 'avapass', 'ava.lee@example.com', '222-333-4444', 'Ava', 'Lee'),
(59, 'jacksonmitchell', 'Artist', 'datascientist456', 'jacksonmitchell@example.com', '333-444-5555', 'Jackson', 'Mitchell'),
(60, 'michaelward', 'Agent', 'salesmanager789', 'michaelward@example.com', '777-888-9999', 'Michael', 'Ward');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_profileimage`
--

CREATE TABLE `tbl_user_profileimage` (
  `user_id` int(11) NOT NULL,
  `filepath_profileimage` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_user_profileimage`
--

INSERT INTO `tbl_user_profileimage` (`user_id`, `filepath_profileimage`) VALUES
(1, NULL),
(2, NULL),
(51, NULL),
(3, NULL),
(58, NULL),
(57, NULL),
(50, NULL),
(4, 'C:/xampp/htdocs/ework_collab/upload/profile_images/profile_65bf9e3cd11c37.80908924.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_status`
--

CREATE TABLE `tbl_user_status` (
  `username` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `status_starttime` datetime NOT NULL,
  `status_endtime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Indexes for table `tbl_reference_images`
--
ALTER TABLE `tbl_reference_images`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `tbl_reference_images_ibfk_1` (`job_id`);

--
-- Indexes for table `tbl_templatelist`
--
ALTER TABLE `tbl_templatelist`
  ADD PRIMARY KEY (`template_id`);

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
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `tbl_user_profileimage`
--
ALTER TABLE `tbl_user_profileimage`
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
-- AUTO_INCREMENT for table `tbl_jobs`
--
ALTER TABLE `tbl_jobs`
  MODIFY `job_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `tbl_jobs_progress`
--
ALTER TABLE `tbl_jobs_progress`
  MODIFY `progress_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_recyclebin`
--
ALTER TABLE `tbl_recyclebin`
  MODIFY `job_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `tbl_reference_images`
--
ALTER TABLE `tbl_reference_images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `tbl_templatelist`
--
ALTER TABLE `tbl_templatelist`
  MODIFY `template_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbl_template_processes`
--
ALTER TABLE `tbl_template_processes`
  MODIFY `process_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tbl_userlist`
--
ALTER TABLE `tbl_userlist`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

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
  ADD CONSTRAINT `tbl_user_profileimage_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_userlist` (`user_id`);

--
-- Constraints for table `tbl_user_status`
--
ALTER TABLE `tbl_user_status`
  ADD CONSTRAINT `tbl_user_status_ibfk_1` FOREIGN KEY (`username`) REFERENCES `tbl_userlist` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
