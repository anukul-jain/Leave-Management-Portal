-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2021 at 03:32 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phpdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `Dept` varchar(50) NOT NULL,
  `SetSickLeave` int(11) NOT NULL DEFAULT 15,
  `SetCasualLeave` int(11) NOT NULL DEFAULT 10,
  `SetEarnLeave` int(11) NOT NULL DEFAULT 30
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `Dept`, `SetSickLeave`, `SetCasualLeave`, `SetEarnLeave`) VALUES
(1, 'ce_admin', 'civil', 'CE', 15, 25, 10),
(2, 'cse_admin', 'cse', 'CSE', 15, 11, 11),
(3, 'me_admin', 'mech', 'ME', 15, 10, 30),
(4, 'ee_admin', 'elec', 'EE', 15, 10, 30),
(5, 'cc', 'dean', 'Cross-Cutting', 15, 10, 30);

-- --------------------------------------------------------

--
-- Table structure for table `dean`
--

CREATE TABLE `dean` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `prevDept` varchar(50) NOT NULL,
  `SetSickLeave` int(11) NOT NULL DEFAULT 15,
  `SetCasualLeave` int(11) NOT NULL DEFAULT 10,
  `SetEarnLeave` int(11) NOT NULL DEFAULT 30
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dean`
--

INSERT INTO `dean` (`id`, `username`, `password`, `prevDept`, `SetSickLeave`, `SetCasualLeave`, `SetEarnLeave`) VALUES
(5, 'cse2', 'cse2', 'CSE', 13, 11, 11);

-- --------------------------------------------------------

--
-- Table structure for table `deanemp_leaves`
--

CREATE TABLE `deanemp_leaves` (
  `id` int(11) NOT NULL,
  `EmpName` varchar(50) NOT NULL,
  `LeaveType` varchar(60) NOT NULL,
  `RequestDate` datetime NOT NULL DEFAULT current_timestamp(),
  `LeaveDays` int(11) NOT NULL,
  `Status` varchar(20) NOT NULL DEFAULT 'Requested',
  `StartDate` date NOT NULL,
  `EndDate` date NOT NULL,
  `Dept` varchar(10) NOT NULL,
  `Dean_Remarks` varchar(300) DEFAULT NULL,
  `Retro` tinyint(1) DEFAULT NULL,
  `dean_name` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `deanemp_leaves`
--

INSERT INTO `deanemp_leaves` (`id`, `EmpName`, `LeaveType`, `RequestDate`, `LeaveDays`, `Status`, `StartDate`, `EndDate`, `Dept`, `Dean_Remarks`, `Retro`, `dean_name`) VALUES
(1, 'civil3', 'Sick Leave', '2021-04-19 17:20:27', 2, 'Granted', '2021-07-01', '2021-07-03', 'CE', 'le', NULL, 'cse2'),
(2, 'me2', 'Sick Leave', '2021-04-19 17:24:22', 3, 'Granted', '2021-02-01', '2021-02-04', 'ME', '2', 1, NULL),
(3, 'me2', 'Sick Leave', '2021-04-19 17:29:13', 12, 'Granted', '2021-01-04', '2021-01-24', 'ME', 'done', 1, NULL),
(4, 'me2', 'Sick Leave', '2021-04-19 18:49:23', 2, 'Granted', '2021-07-01', '2021-07-03', 'ME', 'dean done', NULL, 'cse2'),
(5, 'me2', 'Sick Leave', '2021-04-19 18:50:44', 5, 'Granted', '2021-03-07', '2021-03-12', 'ME', 'dean retro done', 1, NULL),
(6, 'me2', 'Sick Leave', '2021-04-19 18:56:37', 3, 'Granted', '2021-03-15', '2021-03-18', 'ME', 'dean done done', 1, 'cse2');

-- --------------------------------------------------------

--
-- Table structure for table `director`
--

CREATE TABLE `director` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `Dept` varchar(50) NOT NULL,
  `SetSickLeave` int(11) NOT NULL DEFAULT 15,
  `SetCasualLeave` int(11) NOT NULL DEFAULT 10,
  `SetEarnLeave` int(11) NOT NULL DEFAULT 30
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `director`
--

INSERT INTO `director` (`id`, `username`, `password`, `Dept`, `SetSickLeave`, `SetCasualLeave`, `SetEarnLeave`) VALUES
(1, 'civil1', 'civil1', 'CE', 0, 25, 10);

-- --------------------------------------------------------

--
-- Table structure for table `dirview_leaves`
--

CREATE TABLE `dirview_leaves` (
  `id` int(11) NOT NULL,
  `EmpName` varchar(50) NOT NULL,
  `LeaveType` varchar(60) NOT NULL,
  `RequestDate` datetime NOT NULL DEFAULT current_timestamp(),
  `LeaveDays` int(11) NOT NULL,
  `Status` varchar(20) NOT NULL DEFAULT 'Requested',
  `StartDate` date NOT NULL,
  `EndDate` date NOT NULL,
  `Dept` varchar(10) NOT NULL,
  `Remarks` varchar(300) NOT NULL,
  `Director_Remarks` varchar(300) DEFAULT NULL,
  `Retro` tinyint(1) DEFAULT NULL,
  `dir_name` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dirview_leaves`
--

INSERT INTO `dirview_leaves` (`id`, `EmpName`, `LeaveType`, `RequestDate`, `LeaveDays`, `Status`, `StartDate`, `EndDate`, `Dept`, `Remarks`, `Director_Remarks`, `Retro`, `dir_name`) VALUES
(1, 'me2', 'Sick Leave', '2021-04-19 17:24:54', 3, 'Granted', '2021-02-01', '2021-02-04', 'ME', '', 'theek', 1, 'civil2'),
(2, 'me2', 'Sick Leave', '2021-04-19 17:30:09', 12, 'Granted', '2021-01-04', '2021-01-24', 'ME', '', 'le', 1, 'civil2'),
(3, 'civil1', 'Sick Leave', '2021-04-19 17:38:46', 15, 'Rejected', '2021-01-01', '2021-01-21', 'CE', 'kjkjnk', 'The application was automatically rejected by the system as the application was not approved/rejected by the proposed start date', NULL, NULL),
(4, 'civil1', 'Sick Leave', '2021-04-19 17:45:14', 15, 'Rejected', '2021-01-14', '2021-02-03', 'CE', 'adad', 'The application was automatically rejected by the system as the application was not approved/rejected by the proposed start date', NULL, NULL),
(5, 'civil1', 'Sick Leave', '2021-04-19 17:49:32', 15, 'Rejected', '2021-01-11', '2021-01-31', 'CE', 'daf', 'The application was automatically rejected by the system as the application was not approved/rejected by the proposed start date', NULL, NULL),
(6, 'civil1', 'Sick Leave', '2021-04-19 17:50:22', 15, 'Rejected', '2021-01-08', '2021-01-28', 'CE', 'dad', 'The application was automatically rejected by the system as the application was not approved/rejected by the proposed start date', NULL, NULL),
(7, 'civil1', 'Sick Leave', '2021-04-19 17:52:14', 20, 'Rejected', '2021-02-01', '2021-02-21', 'CE', 'adasd', '', 1, 'civil2'),
(8, 'civil1', 'Sick Leave', '2021-04-19 17:55:29', 15, 'Granted', '2021-03-04', '2021-03-24', 'CE', 'asd', 'theek', 1, 'civil2'),
(9, 'cse2', 'Sick Leave', '2021-04-19 17:59:31', 2, 'Granted', '2021-01-01', '2021-01-03', 'CSE', 'dede', '2', 1, 'civil2'),
(10, 'cse2', 'Sick Leave', '2021-04-19 18:43:21', 13, 'Rejected', '2021-02-05', '2021-02-25', 'CSE', 'xcvcx', 're', 1, 'civil2'),
(11, 'me2', 'Sick Leave', '2021-04-19 18:51:12', 5, 'Granted', '2021-03-07', '2021-03-12', 'ME', '', 'director done retro', 1, 'civil1'),
(12, 'me2', 'Sick Leave', '2021-04-19 18:57:07', 3, 'Requested', '2021-03-15', '2021-03-18', 'ME', '', NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `UserName` varchar(50) NOT NULL,
  `EmpPass` varchar(200) NOT NULL,
  `EmpName` varchar(50) NOT NULL,
  `EmpEmail` varchar(40) NOT NULL,
  `Dept` varchar(30) NOT NULL,
  `EarnLeave` int(5) UNSIGNED NOT NULL,
  `SickLeave` int(5) UNSIGNED NOT NULL,
  `CasualLeave` int(5) UNSIGNED NOT NULL,
  `DateOfJoin` date NOT NULL,
  `Random` int(15) NOT NULL,
  `Designation` varchar(40) NOT NULL,
  `EmpFee` varchar(40) NOT NULL,
  `EmpType` varchar(40) NOT NULL,
  `UpdateStatus` int(5) NOT NULL,
  `DateOfBirth` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `UserName`, `EmpPass`, `EmpName`, `EmpEmail`, `Dept`, `EarnLeave`, `SickLeave`, `CasualLeave`, `DateOfJoin`, `Random`, `Designation`, `EmpFee`, `EmpType`, `UpdateStatus`, `DateOfBirth`) VALUES
(1, 'civil1', 'civil1', 'civil1', 'civ@gmail.com', 'CE', 10, 0, 25, '1985-01-01', 0, '', '', '', 2021, '1901-01-01'),
(2, 'civil2', 'civil2', 'civil2', 'civ2@gmail.com', 'CE', 10, 15, 25, '1985-01-01', 0, '', '', '', 2021, '1901-01-01'),
(3, 'civil3', 'civil3', 'civil3', 'civil3@gmail.com', 'CE', 10, 13, 25, '1985-01-01', 0, '', '', '', 2021, '1901-01-01'),
(4, 'cse1', 'cse1', 'cse1', 'cse1@gmail.com', 'CSE', 11, 15, 11, '1985-01-01', 0, '', '', '', 1985, '1901-01-01'),
(5, 'cse2', 'cse2', 'cse2', 'cse2@gmail.com', 'CSE', 11, 13, 11, '1985-01-01', 0, '', '', '', 2021, '1901-01-01'),
(6, 'cse3', 'cse3', 'cse3', 'cse3@gmail.com', 'CSE', 11, 15, 11, '1985-01-01', 0, '', '', '', 1985, '1901-01-01'),
(7, 'me1', 'me1', 'me1', 'me1@gmail.com', 'ME', 30, 15, 10, '1985-01-01', 0, '', '', '', 2021, '1901-01-01'),
(8, 'me2', 'me2', 'me2', 'me2@gmail.com', 'ME', 30, 8, 10, '1985-01-01', 0, '', '', '', 2021, '1901-01-01'),
(9, 'ee1', 'ee1', 'ee1', 'ee1@gmail.com', 'EE', 30, 15, 10, '1985-01-01', 0, '', '', '', 2021, '1901-01-01'),
(10, 'ee2', 'ee2', 'ee2', 'ee2@gmail.com', 'EE', 30, 15, 10, '1985-01-01', 0, '', '', '', 2021, '1901-01-01');

-- --------------------------------------------------------

--
-- Table structure for table `emp_leaves`
--

CREATE TABLE `emp_leaves` (
  `id` int(11) NOT NULL,
  `EmpName` varchar(50) NOT NULL,
  `LeaveType` varchar(60) NOT NULL,
  `RequestDate` datetime NOT NULL DEFAULT current_timestamp(),
  `LeaveDays` int(11) NOT NULL,
  `Status` varchar(20) NOT NULL DEFAULT 'Requested',
  `StartDate` date NOT NULL,
  `EndDate` date NOT NULL,
  `Dept` varchar(10) NOT NULL,
  `Remarks` varchar(300) DEFAULT NULL,
  `HOD_Remarks` varchar(300) DEFAULT NULL,
  `Retro` tinyint(1) DEFAULT NULL,
  `hod_name` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `emp_leaves`
--

INSERT INTO `emp_leaves` (`id`, `EmpName`, `LeaveType`, `RequestDate`, `LeaveDays`, `Status`, `StartDate`, `EndDate`, `Dept`, `Remarks`, `HOD_Remarks`, `Retro`, `hod_name`) VALUES
(1, 'civil3', 'Sick Leave', '2021-04-19 17:19:54', 2, 'Granted', '2021-07-01', '2021-07-03', 'CE', 'dede bhai', 'done', NULL, 'civil1'),
(2, 'ee2', 'Sick Leave', '2021-04-19 17:22:26', 4, 'Rejected', '2021-07-01', '2021-07-05', 'EE', 'daf', 'le', NULL, 'ee1'),
(3, 'me2', 'Sick Leave', '2021-04-19 17:24:01', 3, 'Granted', '2021-02-01', '2021-02-04', 'ME', 'dede', '1', 1, 'me1'),
(5, 'me2', 'Sick Leave', '2021-04-19 17:27:48', 12, 'Rejected', '2021-01-01', '2021-01-21', 'ME', 'dede bhai', '1', 1, 'me1'),
(6, 'me2', 'Sick Leave', '2021-04-19 17:28:56', 12, 'Granted', '2021-01-04', '2021-01-24', 'ME', 'retro', '1', 1, 'me1'),
(7, 'me2', 'Sick Leave', '2021-04-19 18:48:59', 2, 'Granted', '2021-07-01', '2021-07-03', 'ME', 'ihiu', 'hod done', NULL, 'me1'),
(8, 'me2', 'Sick Leave', '2021-04-19 18:50:25', 5, 'Granted', '2021-03-07', '2021-03-12', 'ME', 'dfsfds', 'hod retro done', 1, 'me1'),
(9, 'me2', 'Sick Leave', '2021-04-19 18:56:12', 3, 'Granted', '2021-03-15', '2021-03-18', 'ME', 'dede bhai', 'hod done', 1, 'me1');

-- --------------------------------------------------------

--
-- Table structure for table `hods`
--

CREATE TABLE `hods` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `Dept` varchar(50) NOT NULL,
  `SetSickLeave` int(11) NOT NULL DEFAULT 15,
  `SetCasualLeave` int(11) NOT NULL DEFAULT 10,
  `SetEarnLeave` int(11) NOT NULL DEFAULT 30
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hods`
--
CREATE TABLE `Projects` (
  `id` int(11) NOT NULL,
  `PI` varchar(50) NOT NULL,
  `Dept` varchar(50) NOT NULL,
  `CoPI1` varchar(50),
  `CoPI2` varchar(50) ,
  `CoPI3` varchar(50),
  `CoPI4` varchar(50) ,
  `Totalbudgetleft` int(11) NOT NULL,
  `Description` varchar(1000);
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
ALTER TABLE `Projects`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `Projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
INSERT INTO `projects` ( `PI`, `Dept`,`Totalbudgetleft`,`Description`) VALUES
('civil1', 'civil', 100000, 'first project');


CREATE TABLE `deanviewprojects` (
  `id` int(11) NOT NULL,
  `PI` varchar(50) NOT NULL,
  `Dept` varchar(50) NOT NULL,
  `Totalbudgetleft` int(11) NOT NULL,
  `Description` varchar(1000),
  `ManPowerType` varchar(4),
  `ManPmonths` int(2)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
ALTER TABLE `deanviewprojects`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `deanviewprojects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

INSERT INTO `hods` (`id`, `username`, `password`, `Dept`, `SetSickLeave`, `SetCasualLeave`, `SetEarnLeave`) VALUES
(3, 'civil3', 'civil3', 'CE', 13, 25, 10),
(4, 'cse1', 'cse1', 'CSE', 15, 11, 11),
(7, 'me1', 'me1', 'ME', 15, 10, 30),
(9, 'ee1', 'ee1', 'EE', 15, 10, 30);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dean`
--
ALTER TABLE `dean`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deanemp_leaves`
--
ALTER TABLE `deanemp_leaves`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `director`
--
ALTER TABLE `director`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dirview_leaves`
--
ALTER TABLE `dirview_leaves`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emp_leaves`
--
ALTER TABLE `emp_leaves`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hods`
--
ALTER TABLE `hods`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `deanemp_leaves`
--
ALTER TABLE `deanemp_leaves`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `dirview_leaves`
--
ALTER TABLE `dirview_leaves`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `emp_leaves`
--
ALTER TABLE `emp_leaves`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
