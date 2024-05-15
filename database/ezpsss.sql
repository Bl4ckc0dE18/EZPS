-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2024 at 07:29 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ezps`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(60) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `position` varchar(255) NOT NULL,
  `created_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `firstname`, `lastname`, `photo`, `position`, `created_on`) VALUES
(1, 'admin', '$2y$10$Wxx.dhbG1Z/6t1R4G11.4eguAmrLaQFxnliBrwq2XbXOq9jF/QyGm', 'Angelo', 'Cruz', 'twbbsis-15e80f31-bc4d-4eda-b812-508a96643c92.jpg', 'Admin', '2023-07-01'),
(3, 'accountant', '$2y$10$cZSsN4cK6YQuqiyTRmJK9uvkOL2JcOTCgHk9v/lb189vOowKckgdq', 'CPA Angelo', 'Cruz', 'twbbsis-15e80f31-bc4d-4eda-b812-508a96643c92.jpg', 'Accountant', '2023-11-03'),
(4, 'hr', '$2y$10$VrVT/jb5.GWTfci0K6gZiufm7AsbZ5sz5Jubo3QL7oGLH9BpWjAJa', 'HR Angelo', 'Cruz', 'twbbsis-15e80f31-bc4d-4eda-b812-508a96643c92.jpg', 'Human Resources', '2023-11-03'),
(5, '1234', '$2y$10$6uDhydYVDiejdtty.TodlexS4kaLjzb8f96nUkoLjFuF4J.Vs6KnG', 'Admin', 'Admin', '', 'Admin', '2023-11-06');

-- --------------------------------------------------------

--
-- Table structure for table `admin_position`
--

CREATE TABLE `admin_position` (
  `id` int(11) NOT NULL,
  `position` varchar(255) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_position`
--

INSERT INTO `admin_position` (`id`, `position`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time_in` time NOT NULL,
  `status` int(11) NOT NULL,
  `time_out` time NOT NULL,
  `num_hr` double NOT NULL,
  `num_ot` double NOT NULL,
  `num_wl` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `audit_trail_record`
--

CREATE TABLE `audit_trail_record` (
  `id` int(11) NOT NULL,
  `audit_date` date NOT NULL,
  `audit_time` time NOT NULL,
  `user` varchar(255) CHARACTER SET latin1 NOT NULL,
  `description` text CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `audit_trail_record`
--

INSERT INTO `audit_trail_record` (`id`, `audit_date`, `audit_time`, `user`, `description`) VALUES
(407, '2024-03-10', '15:53:59', 'Angelo Cruz', 'Attendance downloaded attendance-from-Feb 01 2024-to-Feb 29 2024.csv date 2024-03-10'),
(408, '2024-03-10', '16:34:35', 'Angelo Cruz', 'Attendance downloaded attendance-from-Feb 01 2024-to-Mar 02 2024.csv date 2024-03-10'),
(409, '2024-03-10', '16:35:38', 'Angelo Cruz', 'Attendance downloaded attendance-from-Feb 01 2024-to-Mar 31 2024.csv date 2024-03-10'),
(410, '2024-03-10', '16:36:57', 'Angelo Cruz', 'Attendance downloaded attendance-from-Feb 01 2024-to-Apr 18 2024.csv date 2024-03-10'),
(411, '2024-03-10', '16:37:54', 'Angelo Cruz', 'Attendance downloaded attendance-from-Feb 01 2024-to-Apr 18 2024.csv date 2024-03-10'),
(412, '2024-03-10', '16:39:33', 'Angelo Cruz', 'Attendance downloaded attendance-from-Feb 01 2024-to-Mar 31 2024.csv date 2024-03-10'),
(413, '2024-03-30', '08:36:52', 'Angelo Cruz', 'Attendance downloaded attendance-from-Feb 01 2024-to-Mar 30 2024.csv date 2024-03-30'),
(414, '2024-05-04', '11:07:50', 'Angelo Cruz', 'Attendance downloaded attendance-from-Feb 01 2024-to-Feb 29 2024.csv date 2024-05-04'),
(415, '2024-05-04', '23:27:29', 'Angelo Cruz', 'Schedule added 08:00:00 and 12:00:00 date 2024-05-04'),
(416, '2024-05-04', '23:28:06', 'Angelo Cruz', 'Schedule added 09:00:00 and 01:00:00 date 2024-05-04'),
(417, '2024-05-04', '23:28:42', 'Angelo Cruz', 'Schedule added 08:00:00 and 23:15:00 date 2024-05-04'),
(418, '2024-05-04', '23:30:38', 'Angelo Cruz', 'Schedule added 23:30:00 and 23:30:00 date 2024-05-04'),
(419, '2024-05-04', '23:30:53', 'Angelo Cruz', 'Schedule added 11:30:00 and 23:30:00 date 2024-05-04'),
(420, '2024-05-04', '23:35:30', 'Angelo Cruz', 'Schedule added 08:00:00 and 12:00:00 date 2024-05-04'),
(421, '2024-05-04', '23:37:03', 'Angelo Cruz', 'Schedule added 09:00:00 and 13:00:00 date 2024-05-04'),
(422, '2024-05-04', '23:37:52', 'Angelo Cruz', 'Schedule added 10:00:00 and 14:00:00 date 2024-05-04'),
(423, '2024-05-04', '23:38:46', 'Angelo Cruz', 'Schedule added 08:00:00 and 00:00:00 date 2024-05-04'),
(424, '2024-05-04', '23:39:27', 'Angelo Cruz', 'Schedule added 09:00:00 and 00:00:00 date 2024-05-04'),
(425, '2024-05-04', '23:39:48', 'Angelo Cruz', 'Schedule added 10:00:00 and 13:00:00 date 2024-05-04'),
(426, '2024-05-04', '23:40:46', 'Angelo Cruz', 'Schedule added 09:00:00 and 00:00:00 date 2024-05-04'),
(427, '2024-05-04', '23:41:46', 'Angelo Cruz', 'Schedule added 10:00:00 and 00:00:00 date 2024-05-04'),
(428, '2024-05-05', '00:13:22', 'Angelo Cruz', 'Schedule added 08:00:00 and 15:00:00 date 2024-05-05'),
(429, '2024-05-05', '01:40:12', 'Angelo Cruz', 'Schedule added 14:00:00 and 20:00:00 date 2024-05-05'),
(430, '2024-05-06', '01:41:55', 'Angelo Cruz', 'Employee schedule updated  date 2024-05-06'),
(431, '2024-05-06', '01:45:25', 'Angelo Cruz', 'Schedule updated 20:00:00 and 00:00:00 date 2024-05-06'),
(432, '2024-05-06', '01:45:35', 'Angelo Cruz', 'Schedule updated 20:00:00 and 12:00:00 date 2024-05-06'),
(433, '2024-05-06', '01:45:43', 'Angelo Cruz', 'Schedule updated 08:00:00 and 12:00:00 date 2024-05-06'),
(434, '2024-05-06', '01:45:48', 'Angelo Cruz', 'Schedule updated 09:00:00 and 12:00:00 date 2024-05-06'),
(435, '2024-05-06', '01:45:52', 'Angelo Cruz', 'Schedule updated 10:00:00 and 12:00:00 date 2024-05-06'),
(436, '2024-05-06', '01:46:07', 'Angelo Cruz', 'Schedule deleted  and  date 2024-05-06'),
(437, '2024-05-06', '01:48:34', 'Angelo Cruz', 'Schedule deleted  and  date 2024-05-06'),
(438, '2024-05-06', '01:49:31', 'Angelo Cruz', 'Schedule deleted  and  date 2024-05-06'),
(439, '2024-05-06', '01:50:44', 'Angelo Cruz', 'Schedule deleted  and  date 2024-05-06'),
(440, '2024-05-06', '01:50:51', 'Angelo Cruz', 'Schedule deleted  and  date 2024-05-06'),
(441, '2024-05-06', '01:51:15', 'Angelo Cruz', 'Schedule deleted  and  date 2024-05-06'),
(442, '2024-05-06', '01:52:13', 'Angelo Cruz', 'Schedule deleted  and  date 2024-05-06'),
(443, '2024-05-06', '01:52:47', 'Angelo Cruz', 'Schedule deleted  date 2024-05-06'),
(444, '2024-05-06', '01:53:40', 'Angelo Cruz', 'Schedule deleted  date 2024-05-06'),
(445, '2024-05-06', '01:54:43', 'Angelo Cruz', 'Schedule deleted  date 2024-05-06'),
(446, '2024-05-06', '01:55:29', 'Angelo Cruz', 'Schedule deleted 202326 date 2024-05-06'),
(447, '2024-05-06', '01:55:50', 'Angelo Cruz', 'Schedule added 08:00:00 and 14:00:00 date 2024-05-06'),
(448, '2024-05-06', '01:56:02', 'Angelo Cruz', 'Schedule deleted 202327 date 2024-05-06'),
(449, '2024-05-06', '01:56:52', 'Angelo Cruz', 'Schedule updated 20:00:00 and 12:00:00 date 2024-05-06'),
(450, '2024-05-06', '01:58:28', 'Angelo Cruz', 'Schedule deleted 8 date 2024-05-06'),
(451, '2024-05-06', '01:59:51', 'Angelo Cruz', 'Schedule deleted 7 date 2024-05-06'),
(452, '2024-05-06', '02:00:30', 'Angelo Cruz', 'Schedule added 07:00:00 and 20:00:00 date 2024-05-06'),
(453, '2024-05-14', '01:22:11', 'Angelo Cruz', 'Schedule added  and  date 2024-05-14'),
(454, '2024-05-14', '01:23:37', 'Angelo Cruz', 'Schedule added  and  date 2024-05-14'),
(455, '2024-05-14', '01:23:51', 'Angelo Cruz', 'Schedule added  and  date 2024-05-14'),
(456, '2024-05-14', '01:23:57', 'Angelo Cruz', 'Schedule added  and  date 2024-05-14'),
(457, '2024-05-14', '01:24:17', 'Angelo Cruz', 'Schedule added  and  date 2024-05-14'),
(458, '2024-05-14', '03:40:05', 'Angelo Cruz', 'Schedule deleted 1 date 2024-05-14'),
(459, '2024-05-14', '03:40:07', 'Angelo Cruz', 'Schedule deleted 2 date 2024-05-14'),
(460, '2024-05-14', '03:40:10', 'Angelo Cruz', 'Schedule deleted 3 date 2024-05-14'),
(461, '2024-05-14', '04:02:59', 'Angelo Cruz', 'Employee deleted 202330 date 2024-05-14'),
(462, '2024-05-15', '15:44:53', 'Angelo Cruz', 'Employee updated 202325 date 2024-05-15'),
(463, '2024-05-15', '15:47:04', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-05-15'),
(464, '2024-05-15', '15:47:04', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-05-16'),
(465, '2024-05-15', '15:47:25', 'Angelo Cruz', 'Employee updated 202325 date 2024-05-15'),
(466, '2024-05-15', '16:08:54', 'Angelo Cruz', 'Employee updated 202325 date 2024-05-15'),
(467, '2024-05-15', '16:09:07', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-05-15'),
(468, '2024-05-15', '16:09:07', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-05-15'),
(469, '2024-05-15', '16:09:07', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-05-15'),
(470, '2024-05-15', '16:09:07', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-05-16'),
(471, '2024-05-15', '16:09:07', 'Angelo Cruz', 'Rejected leave for employee id number 202325 date 2024-05-16'),
(472, '2024-05-15', '22:33:24', 'Angelo Cruz', 'Schedule added 09:30:00 and 17:00:00 date 2024-05-15'),
(473, '2024-05-15', '22:45:57', 'Angelo Cruz', 'Schedule added 22:45:00 and 23:45:00 date 2024-05-15'),
(474, '2024-05-15', '22:47:39', 'Angelo Cruz', 'Schedule added 23:00:00 and 23:45:00 date 2024-05-15'),
(475, '2024-05-15', '22:48:48', 'Angelo Cruz', 'Schedule added 08:00:00 and 22:00:00 date 2024-05-15'),
(476, '2024-05-15', '22:48:54', 'Angelo Cruz', 'Schedule deleted 202325 date 2024-05-15'),
(477, '2024-05-15', '22:49:23', 'Angelo Cruz', 'Employee updated 202325 date 2024-05-15'),
(478, '2024-05-15', '22:49:50', 'Angelo Cruz', 'Schedule added 08:45:00 and 23:45:00 date 2024-05-15'),
(479, '2024-05-15', '23:02:33', 'Angelo Cruz', 'Schedule updated 23:03:00 and 11:04:00 date 2024-05-15'),
(480, '2024-05-15', '23:02:54', 'Angelo Cruz', 'Schedule added 23:05:00 and 11:08:00 date 2024-05-15'),
(481, '2024-05-15', '23:03:12', 'Angelo Cruz', 'Schedule updated 23:05:00 and 11:04:00 date 2024-05-15'),
(482, '2024-05-15', '23:03:31', 'Angelo Cruz', 'Schedule updated 23:06:00 and 11:08:00 date 2024-05-15'),
(483, '2024-05-15', '23:03:47', 'Angelo Cruz', 'Schedule updated 23:04:00 and 11:04:00 date 2024-05-15'),
(484, '2024-05-15', '23:04:16', 'Angelo Cruz', 'Schedule updated 23:04:00 and 23:04:00 date 2024-05-15'),
(485, '2024-05-15', '23:04:35', 'Angelo Cruz', 'Schedule updated 23:04:00 and 23:05:00 date 2024-05-15'),
(486, '2024-05-15', '23:04:53', 'Angelo Cruz', 'Schedule updated 23:06:00 and 11:08:00 date 2024-05-15'),
(487, '2024-05-15', '23:04:58', 'Angelo Cruz', 'Schedule updated 23:04:00 and 23:05:00 date 2024-05-15'),
(488, '2024-05-15', '23:05:08', 'Angelo Cruz', 'Schedule updated 23:06:00 and 23:08:00 date 2024-05-15'),
(489, '2024-05-15', '23:05:13', 'Angelo Cruz', 'Schedule deleted 17 date 2024-05-15'),
(490, '2024-05-15', '23:05:19', 'Angelo Cruz', 'Schedule updated 23:06:00 and 23:08:00 date 2024-05-15'),
(491, '2024-05-15', '23:06:05', 'Angelo Cruz', 'Schedule added 23:09:00 and 23:10:00 date 2024-05-15'),
(492, '2024-05-15', '23:28:22', 'Angelo Cruz', 'Schedule added 23:00:00 and 23:45:00 date 2024-05-15'),
(493, '2024-05-15', '23:35:44', 'Angelo Cruz', 'Schedule updated 23:40:00 and 00:45:00 date 2024-05-15'),
(494, '2024-05-15', '23:35:54', 'Angelo Cruz', 'Schedule updated 23:40:00 and 23:45:00 date 2024-05-15'),
(495, '2024-05-15', '23:36:57', 'Angelo Cruz', 'Schedule updated 23:40:00 and 23:45:00 date 2024-05-15'),
(496, '2024-05-15', '23:37:40', 'Angelo Cruz', 'Schedule deleted 18 date 2024-05-15'),
(497, '2024-05-15', '23:37:42', 'Angelo Cruz', 'Schedule deleted 19 date 2024-05-15'),
(498, '2024-05-15', '23:52:05', 'Angelo Cruz', 'Schedule deleted 202325 date 2024-05-15'),
(499, '2024-05-15', '23:53:20', 'Angelo Cruz', 'Schedule added 08:00:00 and 23:00:00 date 2024-05-15'),
(500, '2024-05-15', '23:56:13', 'Angelo Cruz', 'Schedule added 23:45:00 and 11:50:00 date 2024-05-15'),
(501, '2024-05-16', '00:27:30', 'Angelo Cruz', 'Employee updated 202438 date 2024-05-16'),
(502, '2024-05-16', '00:28:48', 'Angelo Cruz', 'Schedule added 00:15:00 and 12:15:00 date 2024-05-16'),
(503, '2024-05-16', '00:36:13', 'Angelo Cruz', 'Employee updated 202328 date 2024-05-16'),
(504, '2024-05-16', '00:42:17', 'Angelo Cruz', 'Schedule added 00:30:00 and 12:30:00 date 2024-05-16'),
(505, '2024-05-16', '01:04:07', 'Angelo Cruz', 'Schedule added 01:00:00 and 17:45:00 date 2024-05-16'),
(506, '2024-05-16', '01:06:20', 'Angelo Cruz', 'Schedule deleted 24 date 2024-05-16'),
(507, '2024-05-16', '01:07:02', 'Angelo Cruz', 'Schedule added 14:00:00 and 21:00:00 date 2024-05-16'),
(508, '2024-05-16', '01:07:10', 'Angelo Cruz', 'Schedule updated 14:00:00 and 21:00:00 date 2024-05-16'),
(509, '2024-05-16', '01:07:26', 'Angelo Cruz', 'Schedule updated 14:00:00 and 21:00:00 date 2024-05-16'),
(510, '2024-05-16', '01:07:37', 'Angelo Cruz', 'Schedule updated 14:00:00 and 21:00:00 date 2024-05-16'),
(511, '2024-05-16', '01:07:51', 'Angelo Cruz', 'Schedule updated 00:00:00 and 21:00:00 date 2024-05-16'),
(512, '2024-05-16', '01:07:57', 'Angelo Cruz', 'Schedule updated 12:00:00 and 21:00:00 date 2024-05-16'),
(513, '2024-05-16', '01:10:45', 'Angelo Cruz', 'Schedule updated 12:00:00 and 21:00:00 date 2024-05-16'),
(514, '2024-05-16', '01:10:51', 'Angelo Cruz', 'Schedule updated 12:00:00 and 21:00:00 date 2024-05-16'),
(515, '2024-05-16', '01:11:16', 'Angelo Cruz', 'Schedule deleted 26 date 2024-05-16');

-- --------------------------------------------------------

--
-- Table structure for table `cashadvance`
--

CREATE TABLE `cashadvance` (
  `id` int(11) NOT NULL,
  `date_advance` date NOT NULL,
  `employee_id` varchar(15) NOT NULL,
  `amount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `deductions`
--

CREATE TABLE `deductions` (
  `id` int(11) NOT NULL,
  `description` varchar(100) NOT NULL,
  `amount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `deductions`
--

INSERT INTO `deductions` (`id`, `description`, `amount`) VALUES
(1, '', 0),
(2, 'Pagibig', 150),
(3, 'PhilHealth', 150);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(15) NOT NULL,
  `employee_rfid` varchar(255) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `required_hour` text NOT NULL,
  `address` text NOT NULL,
  `birthdate` date NOT NULL,
  `contact_info` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `position_id` int(11) NOT NULL,
  `basic_salary` int(11) NOT NULL,
  `day_off` varchar(255) NOT NULL,
  `e_leave` double NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `created_on` date NOT NULL,
  `end_contract` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `employee_id`, `employee_rfid`, `firstname`, `lastname`, `required_hour`, `address`, `birthdate`, `contact_info`, `gender`, `email`, `password`, `position_id`, `basic_salary`, `day_off`, `e_leave`, `created_by`, `photo`, `created_on`, `end_contract`) VALUES
(25, '202325', '0413180931', 'Angelo', 'Cruz', '25', 'Quezon City', '2001-04-18', '099999999999', 'Male', 'angelo.cruz@tup.edu.ph', '$2y$10$4dQWPmgJ6/Im8YdA0rgm1.3wbrVSlmT8f2ltm/Y3yzumbkeSBmqIu', 1, 0, 'SUN', 23, 'admin', 'twbbsis-15e80f31-bc4d-4eda-b812-508a96643c92.jpg', '2023-07-13', '2024-11-01'),
(26, '202326', '0411714435', 'Andrei Niko', 'Perez', '26', 'Manila City', '2002-01-01', '099999999999', 'Male', '', '$2y$10$bGCLzHujg0Xh1EGv.nfkX.s/SrVFp7UOQZ7cvCIjhtcH9LsOZb0G.', 1, 2, 'SAT', 12, 'admin', 'Perez.png', '2023-07-13', '2024-07-13'),
(27, '202327', '0411306643', 'Cyrille Jaye', 'Hilario', '27', 'Caloocan CityCaloocan CityCaloocan CityCaloocan City', '2002-01-01', '099999999999', 'Male', '', '$2y$10$zsmdlhQOIVNTGnKbgJA/8OKcWGqef.8jgNn6nKTrcvVG0EdBPURsm', 5, 2, 'SUN', 12, 'admin', 'Hilario.png', '2023-07-13', '2024-07-13'),
(28, '202328', '0411698371', 'Jared Ivan', 'Bruno', '28', 'Navotas City', '2002-01-01', '099999999999', 'Male', '', '$2y$10$3xRO3QbfW6LHv1ZA2gopdeDzoIqNp/4lJeAfbtKouqqeAxhaa38.e', 1, 0, 'SUN', 12, 'admin', 'Bruno.png', '2023-07-13', '2024-07-13'),
(31, '202331', '0412382675', 'Jerard', 'Baria', '31', '319 E-Ugbo Street Velasquez Tondo, Manila', '2002-01-01', '099999999999', 'Female', 'jerard.baria@tup.edu.ph', '$2y$10$Wxx.dhbG1Z/6t1R4G11.4eguAmrLaQFxnliBrwq2XbXOq9jF/QyGm', 6, 2, 'SAT', 12, 'admin', 'Baria.png', '2023-07-14', '2024-07-14'),
(38, '202438', '3988882163', '21', '21', '', '21', '2024-01-30', '12dasd', 'Male', '2121', '$2y$10$EVi1AOXvQgEcZTBQV60Wbuu7Oggd1PQ0N7vY5UUdAklllpGC.IOqS', 5, 0, 'WED', 12121, 'Angelo Cruz', '', '2024-01-30', '2026-06-30');

-- --------------------------------------------------------

--
-- Table structure for table `employee_bonus`
--

CREATE TABLE `employee_bonus` (
  `id` int(11) NOT NULL,
  `applied_on` date NOT NULL,
  `invoice_id` double NOT NULL,
  `employee_id` varchar(255) CHARACTER SET latin1 NOT NULL,
  `employee_name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `description` text CHARACTER SET latin1 NOT NULL,
  `amount` double NOT NULL,
  `bonus_status` varchar(255) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee_bonus`
--

INSERT INTO `employee_bonus` (`id`, `applied_on`, `invoice_id`, `employee_id`, `employee_name`, `description`, `amount`, `bonus_status`) VALUES
(1, '2023-10-11', 20234931627580, '0413180931', 'Angelo Cruz', 'Bonus', 1500, 'Pending'),
(2, '2023-10-11', 20235894327160, '0413180931', 'Angelo Cruz', 'Bonus', 15000, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `employee_schedule`
--

CREATE TABLE `employee_schedule` (
  `id` int(11) NOT NULL,
  `employee_id` text NOT NULL,
  `name` text NOT NULL,
  `schedule_day` text NOT NULL,
  `time_in` time NOT NULL,
  `time_out` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_schedule`
--

INSERT INTO `employee_schedule` (`id`, `employee_id`, `name`, `schedule_day`, `time_in`, `time_out`) VALUES
(25, '202325', 'Angelo Cruz', 'THU', '01:00:00', '17:45:00');

-- --------------------------------------------------------

--
-- Table structure for table `leave_record`
--

CREATE TABLE `leave_record` (
  `id` int(11) NOT NULL,
  `employee_name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `employee_id` varchar(255) CHARACTER SET latin1 NOT NULL,
  `department` varchar(255) CHARACTER SET latin1 NOT NULL,
  `reason` longtext CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `datefrom` date NOT NULL,
  `dateto` date NOT NULL,
  `leave_status` varchar(255) CHARACTER SET latin1 NOT NULL,
  `leave_comment` text CHARACTER SET latin1 NOT NULL,
  `applied_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `leave_record`
--

INSERT INTO `leave_record` (`id`, `employee_name`, `employee_id`, `department`, `reason`, `datefrom`, `dateto`, `leave_status`, `leave_comment`, `applied_on`) VALUES
(21, 'Angelo Cruz', '202325', 'Programmer', 'Sick', '2024-04-08', '2024-02-09', 'Pending', 'For Review', '2024-04-08'),
(22, ' sdas Cruz', '202325', 'Programmer', 'Sick', '2024-05-15', '2024-05-16', 'Rejected', 'Rejected by : Angelo Cruz Check Date : 2024-05-15', '2024-05-15');

-- --------------------------------------------------------

--
-- Table structure for table `loan`
--

CREATE TABLE `loan` (
  `id` int(11) NOT NULL,
  `employee_id` double NOT NULL,
  `employee_name` text CHARACTER SET latin1 NOT NULL,
  `description` text NOT NULL,
  `loanamount` double NOT NULL,
  `monthstopay` double NOT NULL,
  `permonths` double NOT NULL,
  `semiloan` double NOT NULL,
  `semimonths` double NOT NULL,
  `loanpay` double NOT NULL,
  `loanbalance` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `loan`
--

INSERT INTO `loan` (`id`, `employee_id`, `employee_name`, `description`, `loanamount`, `monthstopay`, `permonths`, `semiloan`, `semimonths`, `loanpay`, `loanbalance`) VALUES
(10, 202325, 'Angelo Cruz', 'Car Loan', 15000, 6, 2500, 5, 1250, 8750, 6250),
(11, 202325, 'Angelo Cruz', 'Bonus', 500, 1, 500, -1, 250, 750, -250),
(12, 202325, 'Angelo Cruz', 'Disallowance', 5000, 6, 833.33333333333, 12, 416.66666666667, 0, 5000);

-- --------------------------------------------------------

--
-- Table structure for table `overtime`
--

CREATE TABLE `overtime` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(15) NOT NULL,
  `hours` double NOT NULL,
  `rate` double NOT NULL,
  `date_overtime` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pagibig`
--

CREATE TABLE `pagibig` (
  `id` int(11) NOT NULL,
  `f` double NOT NULL,
  `t` double NOT NULL,
  `er` double NOT NULL,
  `ee` double NOT NULL,
  `total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pagibig`
--

INSERT INTO `pagibig` (`id`, `f`, `t`, `er`, `ee`, `total`) VALUES
(2, 1500, 4999, 2, 2, 4),
(3, 5000, 1000000000, 3, 3, 6),
(4, 1000, 1500, 2, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `payslip`
--

CREATE TABLE `payslip` (
  `id` int(11) NOT NULL,
  `invoice_id` double NOT NULL,
  `employee_name` varchar(100) CHARACTER SET latin1 NOT NULL,
  `employee_id` varchar(255) CHARACTER SET latin1 NOT NULL,
  `rate` double NOT NULL,
  `totalhours` double NOT NULL,
  `otrate` double NOT NULL,
  `othrtotal` double NOT NULL,
  `ers` double NOT NULL,
  `ees` double NOT NULL,
  `totals` double NOT NULL,
  `erp` double NOT NULL,
  `eep` double NOT NULL,
  `totalp` double NOT NULL,
  `erph` double NOT NULL,
  `eeph` double NOT NULL,
  `totalph` double NOT NULL,
  `loan_description` text CHARACTER SET latin1 NOT NULL,
  `loan_amount` text CHARACTER SET latin1 NOT NULL,
  `totalbenifitsdeduction` double NOT NULL,
  `totaleeer` double NOT NULL,
  `deduction_status` varchar(255) CHARACTER SET latin1 NOT NULL,
  `dpaidby` varchar(255) CHARACTER SET latin1 NOT NULL,
  `cashadvance` double NOT NULL,
  `totaldeduction` double NOT NULL,
  `gross` double NOT NULL,
  `netpay` double NOT NULL,
  `paystatus` varchar(11) CHARACTER SET latin1 NOT NULL,
  `ppaidby` varchar(255) CHARACTER SET latin1 NOT NULL,
  `generateby` varchar(255) CHARACTER SET latin1 NOT NULL,
  `datefrom` date NOT NULL,
  `dateto` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payslip`
--

INSERT INTO `payslip` (`id`, `invoice_id`, `employee_name`, `employee_id`, `rate`, `totalhours`, `otrate`, `othrtotal`, `ers`, `ees`, `totals`, `erp`, `eep`, `totalp`, `erph`, `eeph`, `totalph`, `loan_description`, `loan_amount`, `totalbenifitsdeduction`, `totaleeer`, `deduction_status`, `dpaidby`, `cashadvance`, `totaldeduction`, `gross`, `netpay`, `paystatus`, `ppaidby`, `generateby`, `datefrom`, `dateto`) VALUES
(52, 20234281573906, 'Angelo Cruz', 'Angelo508643179', 100, 10.7, 120, 18, 380, 180, 560, 64.6, 64.6, 129.2, 72.675, 72.675, 145.35, '', '', 317.275, 834.55, 'Pending', '', 0, 317.275, 3230, 2912.725, 'Pending', '', '', '2023-09-10', '2023-10-10'),
(66, 20234956813720, 'Admin Admin', '3988882163', 100, 8.9833333333334, 120, 5.48333333333337, 380, 180, 560, 31.126666666667, 31.126666666667, 62.253333333334, 35.0175, 35.0175, 70.035, '', '', 246.14416666667, 692.28833333333, 'Pending', '', 0, 246.14416666667, 1556.3333333333, 1310.1891666667, 'Pending', '', '', '2023-10-03', '2023-11-02'),
(67, 20233789524601, 'Admin Admin', '3988882163', 100, 15.95000000000003, 120, 11.30000000000007, 380, 180, 560, 59.02, 59.02, 118.04, 66.3975, 66.3975, 132.795, '', '', 305.4175, 810.835, 'Pending', '', 0, 305.4175, 2951, 2645.5825, 'Pending', '', '', '2023-10-04', '2023-11-03'),
(68, 20233608247591, 'Admin Admin', '3988882163', 100, 8.9833333333334, 120, 5.48333333333337, 380, 180, 560, 31.126666666667, 31.126666666667, 62.253333333334, 35.0175, 35.0175, 70.035, '', '', 246.14416666667, 692.28833333333, 'Paid', 'Angelo Cruz', 0, 246.14416666667, 1556.3333333333, 1310.1891666667, 'Paid', 'Angelo Cruz', '', '2023-10-13', '2023-11-02'),
(70, 20234819567302, 'Angelo Cruz', '202325', 100, 45, 120, 0, 427.5, 202.5, 630, 90, 90, 180, 101.25, 101.25, 202.5, '', '', 393.75, 1012.5, 'Pending', '', 0, 393.75, 4500, 4106.25, 'Pending', '', 'Angelo Cruz', '2023-12-01', '2023-12-31'),
(102, 20249537618204, 'Angelo Cruz', '202325', 100, 120, 120, 0, 380, 202.5, 630, 360, 360, 720, 270, 270, 540, ' ||Car Loan', ' ||1250', 832.5, 1890, 'Pending', '', 0, 2082.5, 12000, 9917.5, 'Paid', 'Angelo Cruz', 'Admin Admin', '2024-01-01', '2024-01-31'),
(103, 20245302164789, 'Angelo Cruz', '202325', 100, 120, 120, 0, 380, 202.5, 630, 360, 360, 720, 270, 270, 540, ' ||Car Loan', ' ||1250', 832.5, 1890, 'Pending', '', 0, 2082.5, 12000, 9917.5, 'Paid', 'Angelo Cruz', 'Angelo Cruz', '2024-01-01', '2024-01-31'),
(104, 20240186749253, 'Angelo Cruz', '202325', 100, 120, 120, 0, 380, 202.5, 630, 360, 360, 720, 270, 270, 540, ' ||Car Loan ||Bonus', ' ||1250 ||250', 832.5, 1890, 'Pending', '', 0, 1082.5, 12000, 10917.5, 'Pending', '', 'Angelo Cruz', '2024-01-01', '2024-02-29'),
(105, 20241745980263, 'Angelo Cruz', '202325', 100, 261, 120, 6.9833333333333, 380, 202.5, 630, 808.14, 808.14, 1616.28, 606.105, 606.105, 1212.21, ' ||Car Loan ||Bonus', ' ||1250 ||250', 1616.745, 3458.49, 'Pending', '', 0, 1866.745, 26938, 25071.255, 'Paid', 'Angelo Cruz', 'Angelo Cruz', '2024-02-01', '2024-02-29'),
(106, 20241965834270, 'Angelo Cruz', '202325', 100, 261, 120, 6.9833333333333, 380, 202.5, 630, 808.14, 808.14, 1616.28, 606.105, 606.105, 1212.21, ' ||Car Loan ||Bonus', ' ||1250 ||250', 1616.745, 3458.49, 'Pending', '', 0, 1866.745, 26938, 25071.255, 'Pending', '', 'Angelo Cruz', '2024-02-01', '2024-02-29'),
(107, 20242317068549, 'Angelo Cruz', '202325', 100, 261, 120, 6.9833333333333, 380, 202.5, 630, 808.14, 808.14, 1616.28, 606.105, 606.105, 1212.21, ' ||Car Loan', ' ||1250', 1616.745, 3458.49, 'Pending', '', 0, 2866.745, 26938, 24071.255, 'Pending', '', 'Angelo Cruz', '2024-02-01', '2024-02-29');

-- --------------------------------------------------------

--
-- Table structure for table `philhealth`
--

CREATE TABLE `philhealth` (
  `id` int(11) NOT NULL,
  `f` double NOT NULL,
  `t` double NOT NULL,
  `er` double NOT NULL,
  `ee` double NOT NULL,
  `total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `philhealth`
--

INSERT INTO `philhealth` (`id`, `f`, `t`, `er`, `ee`, `total`) VALUES
(1, 0, 1000000000, 2.25, 2.25, 4.5);

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE `position` (
  `id` int(11) NOT NULL,
  `description` varchar(150) NOT NULL,
  `rate` double NOT NULL,
  `ot` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`id`, `description`, `rate`, `ot`) VALUES
(1, 'Programmer', 100, 120),
(5, 'HR Department', 60, 80),
(6, 'Accounting and Finance Department', 80, 100);

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` int(11) NOT NULL,
  `time_in` time NOT NULL,
  `time_out` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`id`, `time_in`, `time_out`) VALUES
(2, '08:00:00', '17:00:00'),
(5, '10:00:00', '20:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `sss`
--

CREATE TABLE `sss` (
  `id` int(11) NOT NULL,
  `f` double NOT NULL,
  `t` double NOT NULL,
  `er` double NOT NULL,
  `ee` double NOT NULL,
  `total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sss`
--

INSERT INTO `sss` (`id`, `f`, `t`, `er`, `ee`, `total`) VALUES
(2, 4250, 4749.99, 427.5, 202.5, 630),
(3, 4750, 5249.99, 475, 225, 700),
(5, 1000, 4250, 380, 180, 560),
(8, 10000, 1000000000, 380, 202.5, 630);

-- --------------------------------------------------------

--
-- Table structure for table `work_load`
--

CREATE TABLE `work_load` (
  `id` int(255) NOT NULL,
  `employee_id` text CHARACTER SET latin1 NOT NULL,
  `name` text CHARACTER SET latin1 NOT NULL,
  `schedule_load` text CHARACTER SET latin1 NOT NULL,
  `time_load` text CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `work_load`
--

INSERT INTO `work_load` (`id`, `employee_id`, `name`, `schedule_load`, `time_load`) VALUES
(1, '202325', 'Angelo Cruz', 'SUN', '3'),
(2, '202325', 'Angelo Cruz', 'WED', '3'),
(3, '202327', 'Cyrille Jaye Hilario', 'THU', '3'),
(4, '202328', 'Jared Ivan Bruno', 'SUN', '3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_position`
--
ALTER TABLE `admin_position`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `audit_trail_record`
--
ALTER TABLE `audit_trail_record`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cashadvance`
--
ALTER TABLE `cashadvance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deductions`
--
ALTER TABLE `deductions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_bonus`
--
ALTER TABLE `employee_bonus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_schedule`
--
ALTER TABLE `employee_schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leave_record`
--
ALTER TABLE `leave_record`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan`
--
ALTER TABLE `loan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `overtime`
--
ALTER TABLE `overtime`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pagibig`
--
ALTER TABLE `pagibig`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payslip`
--
ALTER TABLE `payslip`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `philhealth`
--
ALTER TABLE `philhealth`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sss`
--
ALTER TABLE `sss`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `work_load`
--
ALTER TABLE `work_load`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `admin_position`
--
ALTER TABLE `admin_position`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=245;

--
-- AUTO_INCREMENT for table `audit_trail_record`
--
ALTER TABLE `audit_trail_record`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=516;

--
-- AUTO_INCREMENT for table `cashadvance`
--
ALTER TABLE `cashadvance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `deductions`
--
ALTER TABLE `deductions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `employee_bonus`
--
ALTER TABLE `employee_bonus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employee_schedule`
--
ALTER TABLE `employee_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `leave_record`
--
ALTER TABLE `leave_record`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `loan`
--
ALTER TABLE `loan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `overtime`
--
ALTER TABLE `overtime`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pagibig`
--
ALTER TABLE `pagibig`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payslip`
--
ALTER TABLE `payslip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `philhealth`
--
ALTER TABLE `philhealth`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `position`
--
ALTER TABLE `position`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sss`
--
ALTER TABLE `sss`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `work_load`
--
ALTER TABLE `work_load`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
