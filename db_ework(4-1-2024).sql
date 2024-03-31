-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 31, 2024 at 08:39 PM
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
  `artist_id` int(11) DEFAULT NULL,
  `current_jobID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_artist_status`
--

INSERT INTO `tbl_artist_status` (`artist_name`, `artist_status`, `completion_percentage`, `artist_id`, `current_jobID`) VALUES
('Alice Johnson', 'Active', 95, 3, NULL),
('artist', 'busy', 0, 2, 248),
('artist_Stan', 'open', NULL, NULL, NULL),
('Bob Williams', 'Inactive', 75, 4, NULL),
('Eva Davis', 'Active', 70, 5, NULL),
('jacksonmitchell', 'open', NULL, NULL, NULL),
('Jane Smith', 'Inactive', 60, 2, NULL),
('John Doe', 'Active', 85, 1, NULL),
('johndoe123', 'open', NULL, NULL, NULL),
('Liam Jackson', 'Active', 78, 10, NULL),
('Michael Brown', 'Active', 88, 6, NULL),
('Olivia Miller', 'Inactive', 45, 7, NULL),
('Sophia Anderson', 'Inactive', 55, 9, NULL),
('William Wilson', 'Active', 92, 8, NULL);

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
  `deadline_futureDateTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_jobs`
--

INSERT INTO `tbl_jobs` (`job_id`, `creator_name`, `time_created`, `job_status`, `assigned_artist`, `job_subject`, `job_brief`, `assigning_method`, `template_method`, `template_id`, `job_tracking_method`, `manual_deadline_date`, `manual_deadline_time`, `deadline_futureDateTime`) VALUES
(212, 'agent', '2024-03-30 15:49:59', 'open', NULL, 'Hello', 'Testing this hello', '', '', 0, '', NULL, NULL, NULL),
(213, 'agent', '2024-03-30 15:50:45', 'open', NULL, 'Job with 3 reference images', 'Create this but in black and white', '', '', 0, '', NULL, NULL, NULL),
(214, 'agent', '2024-03-30 15:52:29', 'open', NULL, '23', '23', '', '', 0, '', NULL, NULL, NULL),
(215, 'agent', '2024-03-30 15:57:28', 'open', NULL, 'Another Job', 'Testing Job', '', '', 0, '', NULL, NULL, NULL),
(216, 'agent', '2024-03-30 16:14:18', NULL, '', 'Updated Job Order', 'Testing', '', '', 17, '', '0000-00-00', '00:00:00', NULL),
(217, 'agent', '2024-03-30 16:18:47', NULL, 'artist', '123', '123', '', '', 18, '', '0000-00-00', '00:00:00', NULL),
(219, 'agent', '2024-03-30 18:10:25', 'pending', 'artist', 'Use this to test Artist Page', 'Hello Test', 'Open to All', 'Template', 18, 'Deadline', '0000-00-00', '00:00:00', '2024-03-30 16:55:12'),
(220, 'agent', '2024-03-30 18:11:15', 'open', 'jacksonmitchell', 'Assign only to one artist', 'This is assigned to only one artist', 'Assign an Artist', 'Manually', NULL, 'Deadline', '0000-00-00', '22:00:00', '0000-00-00 00:00:00'),
(221, 'agent', '2024-03-30 18:20:07', 'open', 'johndoe123', 'date for deadline', 'asdf', 'Assign an Artist', 'Manually', 0, 'Deadline', '2024-03-30', '22:00:00', '0000-00-00 00:00:00'),
(222, 'agent', '2024-03-30 18:21:34', 'pending', 'artist', 'This has a template time', '123', 'Open to All', 'Template', 17, 'Artist', '0000-00-00', '00:00:00', '2024-04-02 17:55:19'),
(223, 'agent', '2024-03-30 18:35:47', 'pending', 'artist', 'This is a job order for artist.', 'Tracking = Artist, and Deadline', 'Assign an Artist', 'Template', 18, 'Artist', '0000-00-00', '00:00:00', '2024-03-30 17:20:11'),
(226, 'agent', '2024-03-30 18:53:32', 'open', 'artist', 'asd', 'asd', 'Assign an Artist', 'Manually', NULL, 'Deadline', '2024-03-30', '11:11:00', NULL),
(227, 'agent', '2024-03-30 18:55:42', 'pending', 'artist', '123', '123', 'Assign an Artist', 'Manually', NULL, 'Deadline', '2024-03-30', '11:11:00', NULL),
(228, 'agent', '2024-03-30 18:56:26', 'pending', 'artist', '123', 'asdf', 'Assign an Artist', 'Manually', NULL, 'Artist', NULL, NULL, NULL),
(229, 'agent', '2024-03-30 19:16:13', 'pending', 'artist', 'Design', 'Deadline = Determined by Artist', 'Open to All', 'Manually', NULL, 'Artist', NULL, NULL, NULL),
(230, 'agent', '2024-03-30 19:17:10', 'pending', 'artist', 'Design', 'Deadline = 7:16PM', 'Open to All', 'Manually', NULL, 'Deadline', '2024-03-30', '19:16:00', NULL),
(231, 'agent', '2024-03-30 19:18:29', 'pending', 'artist', 'Design', 'Job Tracking as Artist Deadline = 18:03:03', 'Open to All', 'Template', 18, 'Artist', NULL, NULL, '2024-03-30 18:03:03'),
(232, 'agent', '2024-03-30 19:29:05', 'open', 'jacksonmitchell', 'This should not be viewable by artist', 'not view', 'Assign an Artist', 'Template', 18, 'Artist', NULL, NULL, '2024-03-30 18:14:02'),
(234, 'agent', '2024-03-31 00:17:22', 'open', '', 'asdf', 'asdf', 'Open to All', 'Template', 18, 'Artist', NULL, NULL, '2024-03-30 23:02:20'),
(235, 'agent', '2024-03-31 18:34:15', 'pending', 'artist', 'Test Job Order', 'A test Job', 'Assign an Artist', 'Template', 16, 'Deadline', NULL, NULL, '2024-03-31 15:14:58'),
(244, 'agent', '2024-03-31 19:50:10', 'open', 'johndoe123', 'Presentation Job Order', 'Hello', 'Assign an Artist', 'Manually', NULL, 'Deadline', '2024-04-03', '07:00:00', '2024-03-31 16:29:12'),
(245, 'agent', '2024-04-01 00:41:49', 'pending', 'artist', 'This is a test job order', 'I want this and this and that', 'Assign an Artist', 'Template', 18, 'Deadline', NULL, NULL, '2024-04-01 00:26:36'),
(246, 'agent', '2024-04-01 02:18:52', 'pending', 'artist', 'This has many reference images', 'New Job', 'Assign an Artist', 'Manually', NULL, 'Deadline', '2024-04-11', '02:18:00', NULL),
(247, 'agent', '2024-04-01 02:19:12', 'open', '', 'Another job but no images', 'checking for page reload', 'Open to All', 'Manually', NULL, 'Artist', NULL, NULL, NULL),
(248, 'agent', '2024-04-01 02:20:53', 'pending', 'artist', 'Checking for page reload', '', 'Open to All', 'Manually', NULL, 'Artist', NULL, NULL, NULL),
(249, 'agent', '2024-04-01 02:21:15', 'open', '', 'check page reload', '', 'Open to All', 'Manually', NULL, 'Artist', NULL, NULL, NULL),
(250, 'agent', '2024-04-01 02:25:31', 'open', '', 'checking for page reload', '', 'Open to All', 'Manually', NULL, 'Artist', NULL, NULL, NULL),
(251, 'agent', '2024-04-01 02:27:10', 'open', '', 'checking for page reload', '', 'Open to All', 'Manually', NULL, 'Artist', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jobs_processes`
--

CREATE TABLE `tbl_jobs_processes` (
  `job_id` int(11) DEFAULT NULL,
  `process_id` int(11) DEFAULT NULL,
  `template_id` int(11) DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `assigned_person` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_jobs_processes`
--

INSERT INTO `tbl_jobs_processes` (`job_id`, `process_id`, `template_id`, `duration`, `assigned_person`) VALUES
(1, 2, 0, 3, 'hello'),
(208, 21, NULL, 23, 'Artist'),
(208, 22, NULL, 23, 'Artist'),
(208, 23, NULL, 23, 'Artist'),
(208, 24, NULL, 23, 'Artist'),
(208, 25, NULL, 23, 'Artist'),
(208, 26, NULL, 23, 'Artist'),
(208, 27, NULL, 23, 'Artist'),
(209, 28, NULL, 123, 'Production'),
(209, 29, NULL, 2345, 'Artist'),
(209, 30, NULL, 2345, 'Artist'),
(210, 21, NULL, 23, 'Artist'),
(210, 22, NULL, 23, 'Artist'),
(210, 23, NULL, 23, 'Artist'),
(210, 24, NULL, 23, 'Artist'),
(210, 25, NULL, 23, 'Artist'),
(210, 26, NULL, 23, 'Artist'),
(210, 27, NULL, 23, 'Artist'),
(211, 21, NULL, 23, 'Artist'),
(211, 22, NULL, 23, 'Artist'),
(211, 23, NULL, 23, 'Artist'),
(211, 24, NULL, 23, 'Artist'),
(211, 25, NULL, 23, 'Artist'),
(211, 26, NULL, 23, 'Artist'),
(211, 27, NULL, 23, 'Artist'),
(212, 21, NULL, 23, 'Artist'),
(212, 22, NULL, 23, 'Production'),
(212, 23, NULL, 23, 'Production'),
(212, 24, NULL, 23, 'Production'),
(212, 25, NULL, 23, 'Production'),
(212, 26, NULL, 23, 'Production'),
(212, 27, NULL, 23, 'Production'),
(213, 21, NULL, 23, 'Artist'),
(213, 22, NULL, 23, 'Artist'),
(213, 23, NULL, 23, 'Artist'),
(213, 24, NULL, 23, 'Artist'),
(213, 25, NULL, 23, 'Artist'),
(213, 26, NULL, 23, 'Artist'),
(213, 27, NULL, 23, 'Artist'),
(214, 21, NULL, 23, 'Artist'),
(214, 22, NULL, 23, 'Artist'),
(214, 23, NULL, 23, 'Artist'),
(214, 24, NULL, 23, 'Artist'),
(214, 25, NULL, 23, 'Artist'),
(214, 26, NULL, 23, 'Artist'),
(214, 27, NULL, 23, 'Artist'),
(215, 21, NULL, 0, 'Artist'),
(215, 22, NULL, 0, 'Artist'),
(215, 23, NULL, 0, 'Artist'),
(215, 24, NULL, 0, 'Artist'),
(215, 25, NULL, 0, 'Artist'),
(215, 26, NULL, 0, 'Artist'),
(215, 27, NULL, 0, 'Artist'),
(216, 28, NULL, 321, 'Artist'),
(216, 29, NULL, 2345, 'Artist'),
(216, 30, NULL, 2345, 'Artist'),
(217, 31, NULL, 345, 'Artist'),
(219, 31, NULL, 345, 'Artist'),
(222, 28, NULL, 24, 'Artist'),
(222, 29, NULL, 2345, 'Production'),
(222, 30, NULL, 2345, 'Production'),
(223, 31, NULL, 345, 'Artist'),
(231, 31, NULL, 345, 'Artist'),
(232, 31, NULL, 345, 'Artist'),
(233, 31, NULL, 345, 'Artist'),
(234, 31, NULL, 345, 'Artist'),
(235, 21, NULL, 23, 'Artist'),
(235, 22, NULL, 23, 'Production'),
(235, 23, NULL, 23, 'Production'),
(235, 24, NULL, 23, 'Production'),
(235, 25, NULL, 23, 'Production'),
(235, 26, NULL, 23, 'Production'),
(235, 27, NULL, 23, 'Production'),
(236, 31, NULL, 345, 'Artist'),
(244, 21, NULL, 0, 'Artist'),
(244, 22, NULL, 0, 'Production'),
(244, 23, NULL, 0, 'Production'),
(244, 24, NULL, 0, 'Production'),
(244, 25, NULL, 0, 'Production'),
(244, 26, NULL, 0, 'Production'),
(244, 27, NULL, 0, 'Production'),
(245, 31, NULL, 345, 'Artist');

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

--
-- Dumping data for table `tbl_reference_images`
--

INSERT INTO `tbl_reference_images` (`job_id`, `image_id`, `filepath_reference_image`) VALUES
(212, 88, 'C:/xampp/htdocs/eWork_collab/upload/reference_img/reference_6607c427cce7d6.07399731.png'),
(213, 89, 'C:/xampp/htdocs/eWork_collab/upload/reference_img/reference_6607c4550c2662.50417452.png'),
(213, 90, 'C:/xampp/htdocs/eWork_collab/upload/reference_img/reference_6607c455122230.73370353.png'),
(216, 91, 'C:/xampp/htdocs/eWork_collab/upload/reference_img/reference_6607c9da86b669.26704751.png'),
(219, 93, 'C:/xampp/htdocs/eWork_collab/upload/reference_img/reference_6607e511df8731.03384199.png'),
(219, 94, 'C:/xampp/htdocs/eWork_collab/upload/reference_img/reference_6607e511e06132.01550227.png'),
(235, 101, 'C:/xampp/htdocs/eWork_collab/upload/reference_img/reference_66093c27704f85.58720495.png'),
(235, 102, 'C:/xampp/htdocs/eWork_collab/upload/reference_img/reference_66093c27710bd6.43451079.jpg'),
(235, 103, 'C:/xampp/htdocs/eWork_collab/upload/reference_img/reference_66093c2775cbe0.54855544.png'),
(244, 104, 'C:/xampp/htdocs/eWork_collab/upload/reference_img/reference_66094df280a6c5.39078813.jpg'),
(244, 105, 'C:/xampp/htdocs/eWork_collab/upload/reference_img/reference_66094df281f950.03477000.jpg'),
(244, 106, 'C:/xampp/htdocs/eWork_collab/upload/reference_img/reference_66094df2831ef6.75452235.jpg'),
(244, 107, 'C:/xampp/htdocs/eWork_collab/upload/reference_img/reference_66094df2848f57.07968099.jpg'),
(245, 108, 'C:/xampp/htdocs/eWork_collab/upload/reference_img/reference_6609924dd49c20.41561683.png'),
(245, 109, 'C:/xampp/htdocs/eWork_collab/upload/reference_img/reference_6609924dd8e772.02008312.png'),
(245, 110, 'C:/xampp/htdocs/eWork_collab/upload/reference_img/reference_6609924dd9a570.15612909.jpg'),
(246, 111, 'C:/xampp/htdocs/eWork_collab/upload/reference_img/reference_6609a90cad7704.97220672.jpg'),
(246, 112, 'C:/xampp/htdocs/eWork_collab/upload/reference_img/reference_6609a90caf4092.03764740.jpg'),
(246, 113, 'C:/xampp/htdocs/eWork_collab/upload/reference_img/reference_6609a90cb01695.61023831.jpg'),
(246, 114, 'C:/xampp/htdocs/eWork_collab/upload/reference_img/reference_6609a90cb32069.76652546.jpg'),
(246, 115, 'C:/xampp/htdocs/eWork_collab/upload/reference_img/reference_6609a90cb717d4.49380631.jpg');

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
  ADD UNIQUE KEY `artist_name` (`artist_name`),
  ADD KEY `tbl_artist_status_ibfk_1` (`current_jobID`);

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
  MODIFY `job_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=252;

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
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

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
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_artist_status`
--
ALTER TABLE `tbl_artist_status`
  ADD CONSTRAINT `tbl_artist_status_ibfk_1` FOREIGN KEY (`current_jobID`) REFERENCES `tbl_jobs` (`job_id`) ON DELETE CASCADE;

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
