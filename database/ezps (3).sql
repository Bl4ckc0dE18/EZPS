-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 02, 2024 at 09:55 PM
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
  `email` text NOT NULL,
  `photo` varchar(200) NOT NULL,
  `position` varchar(255) NOT NULL,
  `created_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `firstname`, `lastname`, `email`, `photo`, `position`, `created_on`) VALUES
(1, 'admin', '$2y$10$Wxx.dhbG1Z/6t1R4G11.4eguAmrLaQFxnliBrwq2XbXOq9jF/QyGm', 'Angelo', 'Cruz', 'angelo18420@gmail.com', 'twbbsis-15e80f31-bc4d-4eda-b812-508a96643c92.jpg', 'Admin', '2023-07-01'),
(3, 'accountant', '$2y$10$cZSsN4cK6YQuqiyTRmJK9uvkOL2JcOTCgHk9v/lb189vOowKckgdq', 'CPA Angelo', 'Cruz', 'sadas', 'twbbsis-15e80f31-bc4d-4eda-b812-508a96643c92.jpg', 'Accountant', '2023-11-03'),
(4, 'hr', '$2y$10$VrVT/jb5.GWTfci0K6gZiufm7AsbZ5sz5Jubo3QL7oGLH9BpWjAJa', 'HR Angelo', 'Cruz', '', 'twbbsis-15e80f31-bc4d-4eda-b812-508a96643c92.jpg', 'Human Resources', '2023-11-03'),
(5, '1234', '$2y$10$6uDhydYVDiejdtty.TodlexS4kaLjzb8f96nUkoLjFuF4J.Vs6KnG', 'Admin', 'Admin', 'asdas', '', 'Admin', '2023-11-06');

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
-- Table structure for table `allowance`
--

CREATE TABLE `allowance` (
  `id` int(255) NOT NULL,
  `description` text CHARACTER SET latin1 NOT NULL,
  `amount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `allowance`
--

INSERT INTO `allowance` (`id`, `description`, `amount`) VALUES
(1, 'PERA', 2000);

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
  `num_wl` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `employee_id`, `date`, `time_in`, `status`, `time_out`, `num_hr`, `num_ot`, `num_wl`) VALUES
(1328, 25, '2024-06-01', '18:45:00', 0, '19:00:00', 7, 0, '0'),
(1329, 25, '2024-06-02', '17:45:00', 1, '08:45:00', 8, 3, '0'),
(1330, 25, '2024-06-03', '18:45:00', 0, '19:00:00', 7, 0, '0'),
(1331, 25, '2024-06-04', '17:45:00', 0, '08:45:00', 8, 0, '0'),
(1332, 25, '2024-06-06', '18:45:00', 0, '19:00:00', 8, 0, '0'),
(1333, 25, '2024-06-07', '17:45:00', 0, '08:45:00', 7, 3, '0'),
(1334, 25, '2024-06-08', '18:45:00', 0, '19:00:00', 8, 0, '0'),
(1335, 25, '2024-06-09', '17:45:00', 1, '08:45:00', 0, 0, '0'),
(1336, 25, '2024-06-10', '18:45:00', 0, '19:00:00', 8, 0, '0'),
(1337, 25, '2024-06-13', '17:45:00', 1, '08:45:00', 8, 0, '0'),
(1338, 25, '2024-06-14', '18:45:00', 0, '19:00:00', 8, 0, '0'),
(1339, 25, '2024-06-15', '17:45:00', 1, '08:45:00', 8, 0, '0'),
(1340, 25, '2024-06-16', '18:45:00', 0, '19:00:00', 8, 0, '0'),
(1341, 25, '2024-06-17', '17:45:00', 1, '08:45:00', 7, 0, '0'),
(1342, 25, '2024-06-20', '18:45:00', 0, '19:00:00', 8, 0, '0'),
(1343, 25, '2024-06-21', '17:45:00', 1, '08:45:00', 8, 0, '0'),
(1344, 25, '2024-06-22', '18:45:00', 0, '19:00:00', 8, 3, '0'),
(1345, 25, '2024-06-23', '17:45:00', 1, '08:45:00', 8, 0, '0'),
(1346, 25, '2024-06-24', '18:45:00', 0, '19:00:00', 8, 0, '0'),
(1347, 25, '2024-06-27', '17:45:00', 0, '08:45:00', 8, 0, '0'),
(1348, 25, '2024-06-28', '18:45:00', 0, '19:00:00', 8, 0, '0'),
(1349, 25, '2024-06-29', '17:45:00', 0, '08:45:00', 8, 3, '0'),
(1350, 25, '2024-06-30', '18:45:00', 0, '19:00:00', 8, 0, '0'),
(1351, 26, '2024-06-01', '18:45:00', 0, '19:00:00', 7, 0, '0'),
(1352, 26, '2024-06-02', '17:45:00', 1, '08:45:00', 8, 3, '0'),
(1353, 26, '2024-06-03', '18:45:00', 0, '19:00:00', 7, 0, '0'),
(1354, 26, '2024-06-04', '17:45:00', 0, '08:45:00', 8, 0, '0'),
(1355, 26, '2024-06-06', '18:45:00', 0, '19:00:00', 8, 0, '0'),
(1356, 26, '2024-06-07', '17:45:00', 0, '08:45:00', 7, 3, '0'),
(1357, 26, '2024-06-08', '18:45:00', 0, '19:00:00', 8, 0, '0'),
(1358, 26, '2024-06-09', '17:45:00', 1, '08:45:00', 0, 0, '0'),
(1359, 26, '2024-06-10', '18:45:00', 0, '19:00:00', 8, 0, '0'),
(1360, 26, '2024-06-13', '17:45:00', 1, '08:45:00', 8, 0, '0'),
(1361, 26, '2024-06-14', '18:45:00', 0, '19:00:00', 8, 0, '0'),
(1362, 26, '2024-06-15', '17:45:00', 1, '08:45:00', 8, 0, '0'),
(1363, 26, '2024-06-16', '18:45:00', 0, '19:00:00', 8, 0, '0'),
(1364, 26, '2024-06-17', '17:45:00', 1, '08:45:00', 7, 0, '0'),
(1365, 26, '2024-06-20', '18:45:00', 0, '19:00:00', 8, 0, '0'),
(1366, 26, '2024-06-21', '17:45:00', 1, '08:45:00', 8, 0, '0'),
(1367, 26, '2024-06-22', '18:45:00', 0, '19:00:00', 8, 3, '0'),
(1368, 26, '2024-06-23', '17:45:00', 1, '08:45:00', 8, 0, '0'),
(1369, 26, '2024-06-24', '18:45:00', 0, '19:00:00', 8, 0, '0'),
(1370, 26, '2024-06-27', '17:45:00', 0, '08:45:00', 8, 0, '0'),
(1371, 26, '2024-06-28', '18:45:00', 0, '19:00:00', 8, 0, '0'),
(1372, 26, '2024-06-29', '17:45:00', 0, '08:45:00', 8, 3, '0'),
(1373, 26, '2024-06-30', '18:45:00', 0, '19:00:00', 8, 0, '0'),
(1374, 27, '2024-06-01', '18:45:00', 0, '19:00:00', 7, 0, '0'),
(1375, 27, '2024-06-02', '17:45:00', 1, '08:45:00', 8, 3, '0'),
(1376, 27, '2024-06-03', '18:45:00', 0, '19:00:00', 7, 0, '0'),
(1377, 27, '2024-06-04', '17:45:00', 0, '08:45:00', 8, 0, '0'),
(1378, 27, '2024-06-06', '18:45:00', 0, '19:00:00', 8, 0, '0'),
(1379, 27, '2024-06-07', '17:45:00', 0, '08:45:00', 7, 3, '0'),
(1380, 27, '2024-06-08', '18:45:00', 0, '19:00:00', 8, 0, '0'),
(1381, 27, '2024-06-09', '17:45:00', 1, '08:45:00', 0, 0, '0'),
(1382, 27, '2024-06-10', '18:45:00', 0, '19:00:00', 8, 0, '0'),
(1383, 27, '2024-06-13', '17:45:00', 1, '08:45:00', 8, 0, '0'),
(1384, 27, '2024-06-14', '18:45:00', 0, '19:00:00', 8, 0, '0'),
(1385, 27, '2024-06-15', '17:45:00', 1, '08:45:00', 8, 0, '0'),
(1386, 27, '2024-06-16', '18:45:00', 0, '19:00:00', 8, 0, '0'),
(1387, 27, '2024-06-17', '17:45:00', 1, '08:45:00', 7, 0, '0'),
(1388, 27, '2024-06-20', '18:45:00', 0, '19:00:00', 8, 0, '0'),
(1389, 27, '2024-06-21', '17:45:00', 1, '08:45:00', 8, 0, '0'),
(1390, 27, '2024-06-22', '18:45:00', 0, '19:00:00', 8, 3, '0'),
(1391, 27, '2024-06-23', '17:45:00', 1, '08:45:00', 8, 0, '0'),
(1392, 27, '2024-06-24', '18:45:00', 0, '19:00:00', 8, 0, '0'),
(1393, 27, '2024-06-27', '17:45:00', 0, '08:45:00', 8, 0, '0'),
(1394, 27, '2024-06-28', '18:45:00', 0, '19:00:00', 8, 0, '0'),
(1395, 27, '2024-06-29', '17:45:00', 0, '08:45:00', 8, 3, '0'),
(1396, 27, '2024-06-30', '18:45:00', 0, '19:00:00', 8, 0, '0'),
(1397, 28, '2024-06-01', '18:45:00', 0, '19:00:00', 7, 0, '0'),
(1398, 28, '2024-06-02', '17:45:00', 1, '08:45:00', 8, 3, '0'),
(1399, 28, '2024-06-03', '18:45:00', 0, '19:00:00', 7, 0, '0'),
(1400, 28, '2024-06-04', '17:45:00', 0, '08:45:00', 8, 0, '0'),
(1401, 28, '2024-06-06', '18:45:00', 0, '19:00:00', 8, 0, '0'),
(1402, 28, '2024-06-07', '17:45:00', 0, '08:45:00', 7, 3, '0'),
(1403, 28, '2024-06-08', '18:45:00', 0, '19:00:00', 8, 0, '0'),
(1404, 28, '2024-06-09', '17:45:00', 1, '08:45:00', 0, 0, '0'),
(1405, 28, '2024-06-10', '18:45:00', 0, '19:00:00', 8, 0, '0'),
(1406, 28, '2024-06-13', '17:45:00', 1, '08:45:00', 8, 0, '0'),
(1407, 28, '2024-06-14', '18:45:00', 0, '19:00:00', 8, 0, '0'),
(1408, 28, '2024-06-15', '17:45:00', 1, '08:45:00', 8, 0, '0'),
(1409, 28, '2024-06-16', '18:45:00', 0, '19:00:00', 8, 0, '0'),
(1410, 28, '2024-06-17', '17:45:00', 1, '08:45:00', 7, 0, '0'),
(1411, 28, '2024-06-20', '18:45:00', 0, '19:00:00', 8, 0, '0'),
(1412, 28, '2024-06-21', '17:45:00', 1, '08:45:00', 8, 0, '0'),
(1413, 28, '2024-06-22', '18:45:00', 0, '19:00:00', 8, 3, '0'),
(1414, 28, '2024-06-23', '17:45:00', 1, '08:45:00', 8, 0, '0'),
(1415, 28, '2024-06-24', '18:45:00', 0, '19:00:00', 8, 0, '0'),
(1416, 28, '2024-06-27', '17:45:00', 0, '08:45:00', 8, 0, '0'),
(1417, 28, '2024-06-28', '18:45:00', 0, '19:00:00', 8, 0, '0'),
(1418, 28, '2024-06-29', '17:45:00', 0, '08:45:00', 8, 3, '0'),
(1419, 28, '2024-06-30', '18:45:00', 0, '19:00:00', 8, 0, '0'),
(1420, 31, '2024-06-01', '18:45:00', 0, '19:00:00', 7, 0, '0'),
(1421, 31, '2024-06-02', '17:45:00', 1, '08:45:00', 8, 3, '0'),
(1422, 31, '2024-06-03', '18:45:00', 0, '19:00:00', 7, 0, '0'),
(1423, 31, '2024-06-04', '17:45:00', 0, '08:45:00', 8, 0, '0'),
(1424, 31, '2024-06-06', '18:45:00', 0, '19:00:00', 8, 0, '0'),
(1425, 31, '2024-06-07', '17:45:00', 0, '08:45:00', 7, 3, '0'),
(1426, 31, '2024-06-08', '18:45:00', 0, '19:00:00', 8, 0, '0'),
(1427, 31, '2024-06-09', '17:45:00', 1, '08:45:00', 0, 0, '0'),
(1428, 31, '2024-06-10', '18:45:00', 0, '19:00:00', 8, 0, '0'),
(1429, 31, '2024-06-13', '17:45:00', 1, '08:45:00', 8, 0, '0'),
(1430, 31, '2024-06-14', '18:45:00', 0, '19:00:00', 8, 0, '0'),
(1431, 31, '2024-06-15', '17:45:00', 1, '08:45:00', 8, 0, '0'),
(1432, 31, '2024-06-16', '18:45:00', 0, '19:00:00', 8, 0, '0'),
(1433, 31, '2024-06-17', '17:45:00', 1, '08:45:00', 7, 0, '0'),
(1434, 31, '2024-06-20', '18:45:00', 0, '19:00:00', 8, 0, '0'),
(1435, 31, '2024-06-21', '17:45:00', 1, '08:45:00', 8, 0, '0'),
(1436, 31, '2024-06-22', '18:45:00', 0, '19:00:00', 8, 3, '0'),
(1437, 31, '2024-06-23', '17:45:00', 1, '08:45:00', 8, 0, '0'),
(1438, 31, '2024-06-24', '18:45:00', 0, '19:00:00', 8, 0, '0'),
(1439, 31, '2024-06-27', '17:45:00', 0, '08:45:00', 8, 0, '0'),
(1440, 31, '2024-06-28', '18:45:00', 0, '19:00:00', 8, 0, '0'),
(1441, 31, '2024-06-29', '17:45:00', 0, '08:45:00', 8, 3, '0'),
(1442, 31, '2024-06-30', '18:45:00', 0, '19:00:00', 8, 0, '0');

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
(515, '2024-05-16', '01:11:16', 'Angelo Cruz', 'Schedule deleted 26 date 2024-05-16'),
(516, '2024-05-17', '01:24:24', 'Angelo Cruz', 'Schedule added 01:00:00 and 08:00:00 date 2024-05-17'),
(517, '2024-05-17', '02:25:44', 'Angelo Cruz', 'Schedule updated 03:00:00 and 08:00:00 date 2024-05-17'),
(518, '2024-05-17', '02:54:08', 'Angelo Cruz', 'Schedule deleted 202325 date 2024-05-17'),
(519, '2024-05-17', '02:54:32', 'Angelo Cruz', 'Schedule added 01:00:00 and 02:00:00 date 2024-05-17'),
(520, '2024-05-17', '03:08:59', 'Angelo Cruz', 'Schedule updated 01:00:00 and 14:00:00 date 2024-05-17'),
(521, '2024-05-17', '03:24:15', 'Angelo Cruz', 'Schedule deleted 202325 date 2024-05-17'),
(522, '2024-05-17', '03:24:37', 'Angelo Cruz', 'Schedule added 02:00:00 and 03:00:00 date 2024-05-17'),
(523, '2024-05-17', '03:25:07', 'Angelo Cruz', 'Schedule added 06:00:00 and 08:00:00 date 2024-05-17'),
(524, '2024-05-17', '03:25:34', 'Angelo Cruz', 'Schedule updated 06:00:00 and 08:00:00 date 2024-05-17'),
(525, '2024-05-17', '03:28:03', 'Angelo Cruz', 'Schedule added 09:00:00 and 11:00:00 date 2024-05-17'),
(526, '2024-05-17', '23:11:58', 'Angelo Cruz', 'Schedule added 23:00:00 and 23:45:00 date 2024-05-17'),
(527, '2024-05-17', '17:55:49', 'Angelo Cruz', 'Schedule deleted 32 date 2024-05-17'),
(528, '2024-05-17', '17:55:51', 'Angelo Cruz', 'Schedule deleted 31 date 2024-05-17'),
(529, '2024-05-17', '17:55:54', 'Angelo Cruz', 'Schedule deleted 30 date 2024-05-17'),
(530, '2024-05-17', '17:56:27', 'Angelo Cruz', 'Schedule added 18:45:00 and 19:45:00 date 2024-05-17'),
(531, '2024-05-17', '17:57:42', 'Angelo Cruz', 'Schedule added 05:00:00 and 11:00:00 date 2024-05-17'),
(532, '2024-05-17', '17:59:24', 'Angelo Cruz', 'Schedule added 20:45:00 and 21:45:00 date 2024-05-17'),
(533, '2024-05-18', '05:06:54', 'Angelo Cruz', 'Schedule updated 02:00:00 and 03:00:00 date 2024-05-18'),
(534, '2024-05-18', '05:07:14', 'Angelo Cruz', 'Schedule updated 05:00:00 and 11:00:00 date 2024-05-18'),
(535, '2024-05-18', '05:07:27', 'Angelo Cruz', 'Schedule updated 05:00:00 and 11:00:00 date 2024-05-18'),
(536, '2024-05-18', '05:07:34', 'Angelo Cruz', 'Schedule updated 05:00:00 and 11:00:00 date 2024-05-18'),
(537, '2024-05-18', '05:08:48', 'Angelo Cruz', 'Schedule updated 05:00:00 and 11:00:00 date 2024-05-18'),
(538, '2024-05-18', '05:09:39', 'Angelo Cruz', 'Schedule added 08:00:00 and 11:00:00 date 2024-05-18'),
(539, '2024-05-18', '11:45:51', 'Angelo Cruz', 'Schedule added 14:30:00 and 23:30:00 date 2024-05-18'),
(540, '2024-05-18', '23:27:36', 'Angelo Cruz', 'Schedule updated 14:30:00 and 22:30:00 date 2024-05-18'),
(541, '2024-05-18', '23:32:11', 'Angelo Cruz', 'Schedule added  and  date 2024-05-18'),
(542, '2024-05-18', '23:51:29', 'Angelo Cruz', 'Schedule updated 14:30:00 and 17:30:00 date 2024-05-18'),
(543, '2024-05-20', '03:09:45', 'Angelo Cruz', 'Employee loan deleted Angelo Cruz date 2024-05-20'),
(544, '2024-05-20', '03:09:48', 'Angelo Cruz', 'Employee loan deleted Angelo Cruz date 2024-05-20'),
(545, '2024-05-20', '03:33:35', 'Angelo Cruz', 'Employee loan deleted Angelo Cruz date 2024-05-20'),
(546, '2024-05-20', '03:33:37', 'Angelo Cruz', 'Employee loan deleted Angelo Cruz date 2024-05-20'),
(547, '2024-05-20', '03:33:40', 'Angelo Cruz', 'Employee loan deleted Andrei Niko Perez date 2024-05-20'),
(548, '2024-05-22', '01:23:28', 'Angelo Cruz', 'Schedule added 01:15:00 and 13:15:00 date 2024-05-22'),
(549, '2024-05-22', '23:32:25', 'Angelo Cruz', 'Position updated HR Department | Rate per Hour P60 | Rate per Overtime P80 date 2024-05-22'),
(550, '2024-05-22', '23:32:33', 'Angelo Cruz', 'Position updated Accounting and Finance Department | Rate per Hour P80 | Rate per Overtime P100 date 2024-05-22'),
(551, '2024-05-22', '23:35:24', 'Angelo Cruz', 'Position updated HR Department | Rate per Hour P60 | Rate per Overtime P80 date 2024-05-22'),
(552, '2024-05-22', '23:35:38', 'Angelo Cruz', 'Position updated Accounting and Finance Department | Rate per Hour P80 | Rate per Overtime P100 date 2024-05-22'),
(553, '2024-05-22', '23:44:23', 'Angelo Cruz', 'Employee updated 202325 date 2024-05-22'),
(554, '2024-05-22', '23:47:06', 'Angelo Cruz', 'Employee updated 202325 date 2024-05-22'),
(555, '2024-05-22', '23:59:28', 'Angelo Cruz', 'Employee updated 202325 date 2024-05-22'),
(556, '2024-05-23', '00:04:50', 'Angelo Cruz', 'Position updated Accounting and Finance Department_sg7_s3 | Rate per Hour P80 | Rate per Overtime P100 date 2024-05-23'),
(557, '2024-05-23', '00:04:56', 'Angelo Cruz', 'Position updated Accounting and Finance Department_sg7_s3_sg7_s7 | Rate per Hour P80 | Rate per Overtime P100 date 2024-05-23'),
(558, '2024-05-23', '00:18:24', 'Angelo Cruz', 'Employee updated 202325 date 2024-05-23'),
(559, '2024-05-23', '00:18:34', 'Angelo Cruz', 'Employee updated 202325 date 2024-05-23'),
(560, '2024-05-23', '00:18:39', 'Angelo Cruz', 'Employee updated 202325 date 2024-05-23'),
(561, '2024-05-23', '00:22:14', 'Angelo Cruz', 'Employee updated 202325 date 2024-05-23'),
(562, '2024-05-23', '00:22:27', 'Angelo Cruz', 'Employee updated 202325 date 2024-05-23'),
(563, '2024-05-23', '00:22:35', 'Angelo Cruz', 'Employee updated 202325 date 2024-05-23'),
(564, '2024-05-23', '00:23:00', 'Angelo Cruz', 'Employee updated 202328 date 2024-05-23'),
(565, '2024-05-23', '00:24:46', 'Angelo Cruz', 'Employee updated 202331 date 2024-05-23'),
(566, '2024-05-23', '00:24:56', 'Angelo Cruz', 'Employee updated 202325 date 2024-05-23'),
(567, '2024-05-23', '00:25:05', 'Angelo Cruz', 'Employee updated 202325 date 2024-05-23'),
(568, '2024-05-23', '00:26:06', 'Angelo Cruz', 'Position updated Accounting and Finance Department_sg7_s7 | Rate per Hour P80 | Rate per Overtime P100 date 2024-05-23'),
(569, '2024-05-23', '00:26:29', 'Angelo Cruz', 'Position updated Accounting and Finance Departmen | Rate per Hour P80 | Rate per Overtime P100 date 2024-05-23'),
(570, '2024-05-23', '00:29:00', 'Angelo Cruz', 'Position updated Accounting and Finance Department | Rate per Hour P80 | Rate per Overtime P100 date 2024-05-23'),
(571, '2024-05-24', '00:22:47', 'Angelo Cruz', 'Pending leave for employee id number 202325 date '),
(572, '2024-05-25', '20:25:51', 'Angelo Cruz', 'Employee updated 202325 date 2024-05-25'),
(573, '2024-05-25', '20:44:52', 'Angelo Cruz', 'Schedule added  and  date 2024-05-25'),
(574, '2024-05-25', '20:44:58', 'Angelo Cruz', 'Schedule added  and  date 2024-05-25'),
(575, '2024-05-25', '20:48:17', 'Angelo Cruz', 'Schedule added  and  date 2024-05-25'),
(576, '2024-05-25', '20:48:24', 'Angelo Cruz', 'Schedule deleted 6 date 2024-05-25'),
(577, '2024-05-25', '21:10:14', 'Angelo Cruz', 'Schedule added 09:00:00 and 21:00:00 date 2024-05-25'),
(578, '2024-05-25', '21:20:56', 'Angelo Cruz', 'Schedule deleted 29 date 2024-05-25'),
(579, '2024-05-25', '21:25:13', 'Angelo Cruz', 'Schedule deleted 202325 date 2024-05-25'),
(580, '2024-05-25', '21:26:27', 'Angelo Cruz', 'Schedule added 05:00:00 and 08:00:00 date 2024-05-25'),
(581, '2024-05-25', '21:27:11', 'Angelo Cruz', 'Schedule added 01:00:00 and 04:00:00 date 2024-05-25'),
(582, '2024-05-25', '21:27:43', 'Angelo Cruz', 'Schedule added 10:00:00 and 17:00:00 date 2024-05-25'),
(583, '2024-05-25', '21:38:46', 'Angelo Cruz', 'Employee updated 202325 date 2024-05-25'),
(584, '2024-05-25', '21:42:40', 'Angelo Cruz', 'Employee updated 202325 date 2024-05-25'),
(585, '2024-05-25', '21:44:28', 'Angelo Cruz', 'Employee updated 202325 date 2024-05-25'),
(586, '2024-05-25', '21:45:14', 'Angelo Cruz', 'Employee updated 202325 date 2024-05-25'),
(587, '2024-05-25', '21:45:30', 'Angelo Cruz', 'Employee updated 202325 date 2024-05-25'),
(588, '2024-05-25', '21:52:04', 'Angelo Cruz', 'Employee updated 202331 date 2024-05-25'),
(589, '2024-05-25', '21:52:22', 'Angelo Cruz', 'Employee updated 202331 date 2024-05-25'),
(590, '2024-05-26', '14:03:28', 'Angelo Cruz', 'Added new attendance employee  date 2024-05-26'),
(591, '2024-05-26', '14:34:16', 'Angelo Cruz', 'Added new attendance employee  date 2024-05-26'),
(592, '2024-05-26', '14:35:41', 'Angelo Cruz', 'Added new attendance employee  date 2024-05-26'),
(593, '2024-05-26', '14:38:38', 'Angelo Cruz', 'Added new attendance employee  date 2024-05-26'),
(594, '2024-05-26', '14:40:20', 'Angelo Cruz', 'Added new attendance employee  date 2024-05-26'),
(595, '2024-05-26', '14:41:48', 'Angelo Cruz', 'Added new attendance employee  date 2024-05-26'),
(596, '2024-05-26', '14:50:49', '21 21', 'Added new attendance employee  date 2024-05-26'),
(597, '2024-05-26', '15:21:46', '21 21', 'Added new attendance employee  date 2024-05-26'),
(598, '2024-05-26', '22:38:50', 'Angelo Cruz', 'Schedule added 18:00:00 and 23:30:00 date 2024-05-26'),
(599, '2024-05-26', '22:56:23', 'Angelo Cruz', 'Added new attendance employee  date 2024-05-26'),
(600, '2024-05-26', '23:00:19', 'Angelo Cruz', 'Schedule added 17:00:00 and 23:00:00 date 2024-05-26'),
(601, '2024-05-26', '23:06:20', 'Angelo Cruz', 'Schedule updated 17:00:00 and 19:00:00 date 2024-05-26'),
(602, '2024-05-26', '23:06:57', 'Angelo Cruz', 'Schedule added  and  date 2024-05-26'),
(603, '2024-05-26', '23:07:13', 'Angelo Cruz', 'Schedule updated 01:00:00 and 01:00:00 date 2024-05-26'),
(604, '2024-05-26', '23:07:24', 'Angelo Cruz', 'Schedule deleted 202325 date 2024-05-26'),
(605, '2024-05-26', '23:08:37', 'Angelo Cruz', 'Schedule added 17:00:00 and 20:00:00 date 2024-05-26'),
(606, '2024-05-26', '23:09:08', 'Angelo Cruz', 'Schedule added  and  date 2024-05-26'),
(607, '2024-05-26', '23:55:53', 'Angelo Cruz', 'Schedule deleted 202325 date 2024-05-26'),
(608, '2024-05-26', '23:56:29', 'Angelo Cruz', 'Schedule added 17:45:00 and 23:45:00 date 2024-05-26'),
(609, '2024-05-26', '23:56:37', 'Angelo Cruz', 'Schedule updated 17:45:00 and 23:45:00 date 2024-05-26'),
(610, '2024-05-27', '00:21:00', 'Angelo Cruz', 'Schedule added  and  date 2024-05-27'),
(611, '2024-05-27', '00:22:57', 'Angelo Cruz', 'Schedule updated 17:45:00 and 18:45:00 date 2024-05-27'),
(612, '2024-05-27', '00:24:59', 'Angelo Cruz', 'Schedule updated 17:45:00 and 20:45:00 date 2024-05-27'),
(613, '2024-05-27', '00:25:09', 'Angelo Cruz', 'Schedule updated 17:45:00 and 20:00:00 date 2024-05-27'),
(614, '2024-05-27', '00:26:13', 'Angelo Cruz', 'Schedule updated 17:45:00 and 20:00:00 date 2024-05-27'),
(615, '2024-05-27', '00:27:26', 'Angelo Cruz', 'Schedule updated 17:45:00 and 20:00:00 date 2024-05-27'),
(616, '2024-05-28', '12:57:36', 'Angelo Cruz', 'Added new attendance employee  date 2024-05-28'),
(617, '2024-05-28', '12:59:12', 'Angelo Cruz', 'Added new attendance employee  date 2024-05-28'),
(618, '2024-05-28', '13:06:45', 'Angelo Cruz', 'Added new attendance employee  date 2024-05-28'),
(619, '2024-05-28', '13:11:16', 'Angelo Cruz', 'Added new attendance employee  date 2024-05-28'),
(620, '2024-05-28', '13:16:54', 'Angelo Cruz', 'Schedule updated  and  date 2024-05-28'),
(621, '2024-05-28', '13:17:15', 'Angelo Cruz', 'Schedule updated  and  date 2024-05-28'),
(622, '2024-05-28', '13:17:32', 'Angelo Cruz', 'Schedule deleted 12 date 2024-05-28'),
(623, '2024-05-28', '13:17:38', 'Angelo Cruz', 'Schedule added  and  date 2024-05-28'),
(624, '2024-05-28', '13:17:41', 'Angelo Cruz', 'Schedule deleted 202325 date 2024-05-28'),
(625, '2024-05-28', '13:19:04', 'Angelo Cruz', 'Schedule deleted 202325 date 2024-05-28'),
(626, '2024-05-28', '13:19:28', 'Angelo Cruz', 'Schedule added 01:15:00 and 13:15:00 date 2024-05-28'),
(627, '2024-05-28', '13:19:35', 'Angelo Cruz', 'Schedule added  and  date 2024-05-28'),
(628, '2024-05-28', '13:19:41', 'Angelo Cruz', 'Schedule added  and  date 2024-05-28'),
(629, '2024-05-28', '13:20:01', 'Angelo Cruz', 'Schedule added  and  date 2024-05-28'),
(630, '2024-05-28', '13:20:03', 'Angelo Cruz', 'Schedule deleted 202325 date 2024-05-28'),
(631, '2024-05-30', '01:49:34', 'Angelo Cruz', 'User updated admin date 2024-05-30'),
(632, '2024-05-30', '01:49:44', 'Angelo Cruz', 'Added new User sdas date 2024-05-30'),
(633, '2024-05-30', '01:49:49', 'Angelo Cruz', 'User deleted sdas date 2024-05-30'),
(634, '2024-05-30', '01:50:02', 'Angelo Cruz', 'User updated admin date 2024-05-30'),
(635, '2024-05-30', '01:50:34', 'Angelo Cruz', 'User updated admin date 2024-05-30'),
(636, '2024-05-30', '01:50:38', 'Angelo Cruz', 'User updated admin date 2024-05-30'),
(637, '2024-05-30', '01:51:58', 'Angelo Cruz', 'User updated 1234 date 2024-05-30'),
(638, '2024-05-30', '01:52:10', 'Angelo Cruz', 'User updated admin date 2024-05-30'),
(639, '2024-05-30', '01:52:22', 'Angelo Cruz', 'User updated 1234 date 2024-05-30'),
(640, '2024-05-30', '01:52:26', 'Angelo Cruz', 'User updated admin date 2024-05-30'),
(641, '2024-05-30', '01:52:28', 'Angelo Cruz', 'User updated admin date 2024-05-30'),
(642, '2024-05-30', '01:52:49', 'Angelo Cruz', 'User updated admin date 2024-05-30'),
(643, '2024-05-30', '01:53:16', 'Angelo Cruz', 'User updated admin date 2024-05-30'),
(644, '2024-05-30', '01:53:21', 'Angelo Cruz', 'User updated admin date 2024-05-30'),
(645, '2024-05-30', '01:53:24', 'Angelo Cruz', 'User updated admin date 2024-05-30'),
(646, '2024-05-30', '01:54:19', 'Angelo Cruz', 'User updated admin date 2024-05-30'),
(647, '2024-05-30', '01:57:37', 'Angelo Cruz', 'User updated accountant date 2024-05-30'),
(648, '2024-05-30', '02:02:37', 'Angelo Cruz', 'User updated 1234 date 2024-05-30'),
(649, '2024-05-30', '02:02:41', 'Angelo Cruz', 'User updated 1234 date 2024-05-30'),
(650, '2024-05-30', '14:16:01', 'Angelo Cruz', 'Employee updated 202328 date 2024-05-30'),
(651, '2024-05-31', '13:58:11', 'Angelo Cruz', 'Employee deleted 202438 date 2024-05-31'),
(652, '2024-05-31', '14:00:34', 'Angelo Cruz', 'Position updated Programmer | Rate per Hour P123.40 | Rate per Overtime P120 date 2024-05-31'),
(653, '2024-05-31', '14:00:45', 'Angelo Cruz', 'Position updated Programmer | Rate per Hour P123.4 | Rate per Overtime P185.10 date 2024-05-31'),
(654, '2024-05-31', '14:05:14', 'Angelo Cruz', 'Position updated HR Department | Rate per Hour P168.75 | Rate per Overtime P253.13 date 2024-05-31'),
(655, '2024-05-31', '14:05:48', 'Angelo Cruz', 'Position updated Accounting and Finance Department | Rate per Hour P168.75 | Rate per Overtime P253.13 date 2024-05-31'),
(656, '2024-05-31', '14:57:22', 'Angelo Cruz', 'Position updated Programmer | Rate per Hour P123.4 | Rate per Overtime P185.1 date 2024-05-31'),
(657, '2024-05-31', '16:14:26', 'Angelo Cruz', 'Position updated Programmer | Rate per Hour P123.4 | Rate per Overtime P185.1 date 2024-05-31'),
(658, '2024-05-31', '16:15:32', 'Angelo Cruz', 'Employee loan deleted Angelo Cruz date 2024-05-31'),
(659, '2024-05-31', '16:15:35', 'Angelo Cruz', 'Employee loan deleted Angelo Cruz date 2024-05-31'),
(660, '2024-05-31', '16:15:36', 'Angelo Cruz', 'Employee loan deleted Angelo Cruz date 2024-05-31'),
(661, '2024-05-31', '16:15:39', 'Angelo Cruz', 'Employee loan deleted Andrei Niko Perez date 2024-05-31'),
(662, '2024-05-31', '16:15:41', 'Angelo Cruz', 'Employee loan deleted Jared Ivan Bruno date 2024-05-31'),
(663, '2024-05-31', '16:22:23', 'Angelo Cruz', 'Position updated Programmer | Rate per Hour P123.4 | Rate per Overtime P185.1 date 2024-05-31'),
(664, '2024-05-31', '10:35:44', 'Angelo Cruz', 'Attendance downloaded attendance-from-May 01 2024-to-May 31 2024.csv date 2024-05-31'),
(665, '2024-05-31', '17:02:11', 'Angelo Cruz', 'Employee loan deleted Angelo Cruz date 2024-05-31'),
(666, '2024-05-31', '17:04:43', 'Angelo Cruz', 'Employee loan deleted Angelo Cruz date 2024-05-31'),
(667, '2024-05-31', '17:06:12', 'Angelo Cruz', 'Employee loan deleted Angelo Cruz date 2024-05-31'),
(668, '2024-06-01', '15:45:28', 'Angelo Cruz', 'Schedule added 15:30:00 and 15:30:00 date 2024-06-01'),
(669, '2024-06-01', '15:48:52', 'Angelo Cruz', 'Schedule added  and  date 2024-06-01'),
(670, '2024-06-01', '15:52:16', 'Angelo Cruz', 'Schedule added  and  date 2024-06-01'),
(671, '2024-06-01', '16:22:15', 'Angelo Cruz', 'Schedule updated 15:30:00 and 15:30:00 date 2024-06-01'),
(672, '2024-06-01', '16:22:20', 'Angelo Cruz', 'Schedule updated 15:30:00 and 15:30:00 date 2024-06-01'),
(673, '2024-06-01', '16:27:30', 'Angelo Cruz', 'Employee loan deleted Angelo Cruz date 2024-06-01'),
(674, '2024-06-01', '16:52:21', 'Angelo Cruz', 'Schedule updated 15:30:00 and 15:30:00 date 2024-06-01'),
(675, '2024-06-01', '16:52:25', 'Angelo Cruz', 'Schedule updated 15:30:00 and 15:30:00 date 2024-06-01'),
(676, '2024-06-01', '17:00:02', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-05-15'),
(677, '2024-06-01', '17:00:02', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-05-16'),
(678, '2024-06-01', '17:00:13', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-05-15'),
(679, '2024-06-01', '17:00:13', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-05-16'),
(680, '2024-06-01', '17:00:13', 'Angelo Cruz', 'Rejected leave for employee id number 202325 date 2024-05-16'),
(681, '2024-06-01', '17:00:29', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-05-15'),
(682, '2024-06-01', '17:00:29', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-05-16'),
(683, '2024-06-01', '17:01:24', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-05-15'),
(684, '2024-06-01', '17:01:24', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-05-16'),
(685, '2024-06-01', '17:01:24', 'Angelo Cruz', 'Rejected leave for employee id number 202325 date 2024-05-16'),
(686, '2024-06-01', '17:01:54', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-05-15'),
(687, '2024-06-01', '17:01:54', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-05-16'),
(688, '2024-06-01', '17:02:59', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-05-15'),
(689, '2024-06-01', '17:02:59', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-05-16'),
(690, '2024-06-01', '17:02:59', 'Angelo Cruz', 'Rejected leave for employee id number 202325 date 2024-05-16'),
(691, '2024-06-01', '17:04:32', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-05-15'),
(692, '2024-06-01', '17:04:32', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-05-16'),
(693, '2024-06-01', '17:06:59', 'Angelo Cruz', 'Rejected leave for employee id number 202325 date '),
(694, '2024-06-01', '17:07:18', 'Angelo Cruz', 'Rejected leave for employee id number 202325 date '),
(695, '2024-06-01', '17:09:10', 'Angelo Cruz', 'Rejected leave for employee id number 202325 date '),
(696, '2024-06-01', '17:09:26', 'Angelo Cruz', 'Rejected leave for employee id number 202325 date '),
(697, '2024-06-01', '17:11:51', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-05-15'),
(698, '2024-06-01', '17:11:51', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-05-16'),
(699, '2024-06-01', '17:11:51', 'Angelo Cruz', 'Rejected leave for employee id number 202325 date 2024-05-16'),
(700, '2024-06-01', '17:11:54', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-05-15'),
(701, '2024-06-01', '17:11:54', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-05-16'),
(702, '2024-06-01', '17:12:17', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-05-15'),
(703, '2024-06-01', '17:12:17', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-05-16'),
(704, '2024-06-01', '17:12:17', 'Angelo Cruz', 'Rejected leave for employee id number 202325 date 2024-05-16'),
(705, '2024-06-01', '17:12:21', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-05-15'),
(706, '2024-06-01', '17:12:21', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-05-16'),
(707, '2024-06-01', '17:13:19', 'Angelo Cruz', 'Employee updated 202325 date 2024-06-01'),
(708, '2024-06-01', '17:13:27', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-05-15'),
(709, '2024-06-01', '17:13:27', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-05-16'),
(710, '2024-06-01', '17:13:27', 'Angelo Cruz', 'Rejected leave for employee id number 202325 date 2024-05-16'),
(711, '2024-06-01', '17:13:36', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-05-15'),
(712, '2024-06-01', '17:13:36', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-05-16'),
(713, '2024-06-01', '17:15:01', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-06-01'),
(714, '2024-06-01', '17:15:01', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-06-01'),
(715, '2024-06-01', '17:15:01', 'Angelo Cruz', 'Pending leave for employee id number 202325 date 2024-05-16'),
(716, '2024-06-01', '17:15:04', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-05-15'),
(717, '2024-06-01', '17:15:04', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-05-16'),
(718, '2024-06-01', '17:16:20', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-05-15'),
(719, '2024-06-01', '17:16:20', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-05-16'),
(720, '2024-06-01', '17:16:20', 'Angelo Cruz', 'Rejected leave for employee id number 202325 date 2024-05-16'),
(721, '2024-06-01', '17:16:26', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-05-15'),
(722, '2024-06-01', '17:16:26', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-05-16'),
(723, '2024-06-01', '17:24:50', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-06-01'),
(724, '2024-06-01', '17:24:50', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-06-01'),
(725, '2024-06-01', '17:24:50', 'Angelo Cruz', 'Pending leave for employee id number 202325 date 2024-05-16'),
(726, '2024-06-01', '17:25:00', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-05-15'),
(727, '2024-06-01', '17:25:00', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-05-16'),
(728, '2024-06-01', '17:26:04', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-06-01'),
(729, '2024-06-01', '17:26:04', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-06-01'),
(730, '2024-06-01', '17:26:04', 'Angelo Cruz', 'Pending leave for employee id number 202325 date 2024-05-16'),
(731, '2024-06-01', '17:50:00', 'Angelo Cruz', 'Schedule updated  and  date 2024-06-01'),
(732, '2024-06-01', '19:28:08', 'Angelo Cruz', 'Schedule updated 15:30:00 and 15:30:00 date 2024-06-01'),
(733, '2024-06-01', '19:28:23', 'Angelo Cruz', 'Schedule updated 15:30:00 and 20:30:00 date 2024-06-01'),
(734, '2024-06-01', '16:59:35', 'Angelo Cruz', 'Attendance downloaded attendance-from-Jun 01 2024-to-Jun 30 2024.csv date 2024-06-01'),
(735, '2024-06-01', '17:02:28', 'Angelo Cruz', 'Attendance downloaded attendance-from-Jun 01 2024-to-Jun 30 2024.csv date 2024-06-01'),
(736, '2024-06-01', '17:24:49', 'Angelo Cruz', 'Attendance downloaded attendance-from-Jun 01 2024-to-Jun 30 2024.csv date 2024-06-01'),
(737, '2024-06-01', '17:26:01', 'Angelo Cruz', 'Attendance downloaded attendance-from-Jun 01 2024-to-Jun 30 2024.csv date 2024-06-01'),
(738, '2024-06-01', '17:26:19', 'Angelo Cruz', 'Attendance downloaded attendance-from-Jun 01 2024-to-Jun 30 2024.csv date 2024-06-01'),
(739, '2024-06-01', '17:26:33', 'Angelo Cruz', 'Attendance downloaded attendance-from-Jun 01 2024-to-Jun 30 2024.csv date 2024-06-01'),
(740, '2024-06-01', '17:27:17', 'Angelo Cruz', 'Attendance downloaded attendance-from-Jun 01 2024-to-Jun 30 2024.csv date 2024-06-01'),
(741, '2024-06-01', '17:28:19', 'Angelo Cruz', 'Attendance downloaded attendance-from-Jun 01 2024-to-Jun 30 2024.csv date 2024-06-01'),
(742, '2024-06-01', '17:28:55', 'Angelo Cruz', 'Attendance downloaded attendance-from-Jun 01 2024-to-Jun 30 2024.csv date 2024-06-01'),
(743, '2024-06-01', '17:29:10', 'Angelo Cruz', 'Attendance downloaded attendance-from-Jun 01 2024-to-Jun 30 2024.csv date 2024-06-01'),
(744, '2024-06-01', '17:32:41', 'Angelo Cruz', 'Attendance downloaded attendance-from-Jun 01 2024-to-Jun 30 2024.csv date 2024-06-01'),
(745, '2024-06-02', '00:06:12', 'Angelo Cruz', 'Schedule added 00:00:00 and 08:00:00 date 2024-06-02'),
(746, '2024-06-02', '00:08:19', 'Angelo Cruz', 'Employee updated 202325 date 2024-06-02'),
(747, '2024-06-02', '01:09:27', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-07-01'),
(748, '2024-06-02', '01:09:27', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-07-02'),
(749, '2024-06-02', '01:09:27', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-07-03'),
(750, '2024-06-02', '01:09:27', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-07-04'),
(751, '2024-06-02', '01:09:27', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-07-05'),
(752, '2024-06-02', '01:09:27', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-07-06'),
(753, '2024-06-02', '01:10:24', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-07-01'),
(754, '2024-06-02', '01:10:24', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-07-02'),
(755, '2024-06-02', '01:10:24', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-07-03'),
(756, '2024-06-02', '01:10:24', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-07-04'),
(757, '2024-06-02', '01:10:24', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-07-05'),
(758, '2024-06-02', '01:10:25', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-07-06'),
(759, '2024-06-02', '01:10:25', 'Angelo Cruz', 'Rejected leave for employee id number 202325 date 2024-07-06'),
(760, '2024-06-02', '01:17:18', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-07-01'),
(761, '2024-06-02', '01:17:18', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-07-02'),
(762, '2024-06-02', '01:17:18', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-07-03'),
(763, '2024-06-02', '01:17:18', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-07-04'),
(764, '2024-06-02', '01:17:18', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-07-05'),
(765, '2024-06-02', '01:17:18', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-07-06'),
(766, '2024-06-02', '01:18:45', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-07-01'),
(767, '2024-06-02', '01:18:45', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-07-02'),
(768, '2024-06-02', '01:18:45', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-07-03'),
(769, '2024-06-02', '01:18:45', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-07-04'),
(770, '2024-06-02', '01:18:45', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-07-05'),
(771, '2024-06-02', '01:18:45', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-07-06'),
(772, '2024-06-02', '01:18:45', 'Angelo Cruz', 'Rejected leave for employee id number 202325 date 2024-07-06'),
(773, '2024-06-02', '01:18:57', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-07-01'),
(774, '2024-06-02', '01:18:57', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-07-02'),
(775, '2024-06-02', '01:18:57', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-07-03'),
(776, '2024-06-02', '01:18:57', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-07-04'),
(777, '2024-06-02', '01:18:57', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-07-05'),
(778, '2024-06-02', '01:18:57', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-07-06'),
(779, '2024-06-02', '01:19:02', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-07-01'),
(780, '2024-06-02', '01:19:02', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-07-02'),
(781, '2024-06-02', '01:19:02', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-07-03'),
(782, '2024-06-02', '01:19:02', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-07-04'),
(783, '2024-06-02', '01:19:02', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-07-05'),
(784, '2024-06-02', '01:19:02', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-07-06'),
(785, '2024-06-02', '01:19:02', 'Angelo Cruz', 'Rejected leave for employee id number 202325 date 2024-07-06'),
(786, '2024-06-02', '01:20:19', 'Angelo Cruz', 'Rejected leave for employee id number 202325 date 2024-07-06'),
(787, '2024-06-02', '01:20:36', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-07-01'),
(788, '2024-06-02', '01:20:36', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-07-02'),
(789, '2024-06-02', '01:20:36', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-07-03'),
(790, '2024-06-02', '01:20:36', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-07-04'),
(791, '2024-06-02', '01:20:36', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-07-05'),
(792, '2024-06-02', '01:20:36', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-07-06'),
(793, '2024-06-02', '01:21:02', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-07-01'),
(794, '2024-06-02', '01:21:02', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-07-02'),
(795, '2024-06-02', '01:21:02', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-07-03'),
(796, '2024-06-02', '01:21:02', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-07-04'),
(797, '2024-06-02', '01:21:02', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-07-05'),
(798, '2024-06-02', '01:21:02', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-07-06'),
(799, '2024-06-02', '01:21:02', 'Angelo Cruz', 'Rejected leave for employee id number 202325 date 2024-07-06'),
(800, '2024-06-02', '01:25:49', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-05-15'),
(801, '2024-06-02', '01:25:49', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-05-16'),
(802, '2024-06-02', '02:28:37', 'HR Angelo Cruz', 'Position updated Accounting and Finance Department | Rate per Hour P168.75 | Rate per Overtime P253.13 date 2024-06-02'),
(803, '2024-06-02', '02:29:08', 'HR Angelo Cruz', 'Position updated Accounting and Finance Department | Rate per Hour P168.75 | Rate per Overtime P253.13 date 2024-06-02');

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
  `regular` text NOT NULL,
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

INSERT INTO `employees` (`id`, `employee_id`, `employee_rfid`, `firstname`, `lastname`, `required_hour`, `address`, `birthdate`, `contact_info`, `gender`, `email`, `password`, `position_id`, `regular`, `day_off`, `e_leave`, `created_by`, `photo`, `created_on`, `end_contract`) VALUES
(25, '202325', '0413180931', 'Angelo', 'Cruz', '25', 'Quezon City', '2001-04-18', '099999999999', 'Male', 'angelo.cruz@tup.edu.ph', '$2y$10$4dQWPmgJ6/Im8YdA0rgm1.3wbrVSlmT8f2ltm/Y3yzumbkeSBmqIu', 1, 'YES', 'MON', 4, 'admin', 'twbbsis-15e80f31-bc4d-4eda-b812-508a96643c92.jpg', '2023-07-13', '0000-00-00'),
(26, '202326', '0411714435', 'Andrei Niko', 'Perez', '26', 'Manila City', '2002-01-01', '099999999999', 'Male', '', '$2y$10$bGCLzHujg0Xh1EGv.nfkX.s/SrVFp7UOQZ7cvCIjhtcH9LsOZb0G.', 1, 'YES', 'SAT', 12, 'admin', 'Perez.png', '2023-07-13', '2024-07-13'),
(27, '202327', '0411306643', 'Cyrille Jaye', 'Hilario', '27', 'Caloocan CityCaloocan CityCaloocan CityCaloocan City', '2002-01-01', '099999999999', 'Male', '', '$2y$10$zsmdlhQOIVNTGnKbgJA/8OKcWGqef.8jgNn6nKTrcvVG0EdBPURsm', 5, 'YES', 'SUN', 12, 'admin', 'Hilario.png', '2023-07-13', '2024-07-13'),
(28, '202328', '0411698371', 'Jared Ivan', 'Bruno', '28', 'Navotas City', '2002-01-01', '099999999999', 'Male', 'jared_bruno@yahoo.com', '$2y$10$aDKcRtXY2XWjzbra8ZdDyOceMww2oVfXGjWjj4M5/U.jmm.KCx35C', 5, 'YES', 'SUN', 12, 'admin', 'Bruno.png', '2023-07-13', '2024-07-13'),
(31, '202331', '0412382675', 'Jerard', 'Baria', '31', '319 E-Ugbo Street Velasquez Tondo, Manila', '2002-01-01', '099999999999', 'Female', 'jerard.baria@tup.edu.ph', '$2y$10$Wxx.dhbG1Z/6t1R4G11.4eguAmrLaQFxnliBrwq2XbXOq9jF/QyGm', 1, 'YES', 'SAT', 12, 'admin', 'Baria.png', '2023-07-14', '0000-11-30');

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
  `time_out` time NOT NULL,
  `type` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_schedule`
--

INSERT INTO `employee_schedule` (`id`, `employee_id`, `name`, `schedule_day`, `time_in`, `time_out`, `type`) VALUES
(48, '202325', 'Angelo Cruz', 'WED', '01:15:00', '13:15:00', 'FTE'),
(49, '202325', 'Angelo Cruz', 'SAT', '15:30:00', '20:30:00', 'WL'),
(50, '202325', 'Angelo Cruz', 'SUN', '00:00:00', '08:00:00', 'FTE');

-- --------------------------------------------------------

--
-- Table structure for table `gsis`
--

CREATE TABLE `gsis` (
  `id` int(255) NOT NULL,
  `percent` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gsis`
--

INSERT INTO `gsis` (`id`, `percent`) VALUES
(1, 9);

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
(21, 'Angelo Cruz', '202325', 'Programmer', 'Sick', '2024-04-08', '2024-02-09', 'Rejected', 'Rejected by : Angelo Cruz Check Date : 2024-06-01', '2024-04-08'),
(22, ' sdas Cruz', '202325', 'Programmer', 'Sick', '2024-05-15', '2024-05-16', 'Approved', 'Approved by : Angelo Cruz Check Date : 2024-06-01', '2024-05-15'),
(23, 'Angelo Cruz', '202325', 'Programmer', 'Sick', '2024-07-01', '2024-07-06', 'Rejected', 'Rejected by : Angelo Cruz Check Date : 2024-06-01', '2024-06-01');

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
(26, 202325, 'Angelo Cruz', 'Disallowance', 5000, 12, 416.66666666667, 0, 208.33333333333, 5000.0000000003, -0.00000000030996716304799),
(28, 202325, 'Angelo Cruz', 'Ref-Ocom', 500, 50, 10, 90, 5, 50, 450),
(29, 202326, 'Andrei Niko Perez', 'Ref-Ocom', 500, 12, 41.666666666667, 16, 20.833333333333, 166.66666666667, 333.33333333332),
(30, 202328, 'Jared Ivan Bruno', 'Ref-Ocom', 500, 50, 10, 92, 5, 40, 460);

-- --------------------------------------------------------

--
-- Table structure for table `loan_transaction`
--

CREATE TABLE `loan_transaction` (
  `id` int(11) NOT NULL,
  `loan_id` text CHARACTER SET latin1 NOT NULL,
  `description` text CHARACTER SET latin1 NOT NULL,
  `loan_amount` text CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `loan_transaction`
--

INSERT INTO `loan_transaction` (`id`, `loan_id`, `description`, `loan_amount`) VALUES
(2, '20248910257346', 'Disallowance', '416.66666666667'),
(3, '20248910257346', 'Ref-Sal', '625'),
(4, '20241593682470', 'Ref-Sal', '250'),
(5, '20240291857643', 'Car Loan', '1,250.00'),
(6, '20240291857643', 'Disallowance', '416.67'),
(7, '20240291857643', 'Ref-Sal', '625.00'),
(8, '20244085936712', 'Ref-Sal', '250.00'),
(9, '20242570684319', 'Disallowance', '416.67'),
(10, '20242570684319', 'Ref-Sal', '625.00'),
(11, '20247054961283', 'Ref-Sal', '250.00'),
(12, '20244962380751', 'Disallowance', '250.00'),
(13, '20244962380751', 'Ref-Sal', '250.00'),
(14, '20241093825764', 'Ref-Sal', '250.00'),
(15, '20248213970645', 'Disallowance', '250.00'),
(16, '20248213970645', 'Ref-Sal', '250.00'),
(17, '20249087416325', 'Ref-Sal', '250.00'),
(18, '20245801274369', 'Ref-Sal', '250.00'),
(19, '20246297831045', 'Disallowance', '250.00'),
(20, '20246297831045', 'Ref-Sal', '250.00'),
(21, '20248276459031', 'Disallowance', '250.00'),
(22, '20240872961543', 'Ref-Sal', '250.00'),
(23, '20249758304621', 'Disallowance', '250.00'),
(24, '20249758304621', 'Ref-Sal', '250.00'),
(25, '20248163029754', 'Disallowance', '250.00'),
(26, '20242753148069', 'GSIS SOS', '1,250.00'),
(27, '20245276839140', 'GSIS SOS', '1,250.00'),
(28, '20248512063794', 'GSIS SOS', '1,250.00'),
(29, '20249108627453', 'GSIS SOS', '1,250.00'),
(30, '20243872564190', 'GSIS SOS', '1,250.00'),
(31, '20242896507134', 'GSIS SOS', '1,250.00'),
(32, '20249830147625', 'GSIS SOS', '1,250.00'),
(33, '20240879234651', 'GSIS SOS', '1,250.00'),
(34, '20243218604957', 'GSIS SOS', '1,250.00'),
(35, '20242079146385', 'GSIS SOS', '1,250.00'),
(36, '20241328695740', 'GSIS SOS', '1,250.00'),
(37, '20244592371608', 'GSIS SOS', '1,250.00'),
(38, '20244316809275', 'Disallowance', '833.33'),
(39, '20242487105936', 'Disallowance', '833.33'),
(40, '20241528063794', 'Disallowance', '833.33'),
(41, '20248432196705', 'Disallowance', '833.33'),
(42, '20247356219408', 'Disallowance', '833.33'),
(43, '20246502478139', 'Disallowance', '833.33'),
(44, '20245427810369', 'Disallowance', '833.33'),
(45, '20246504817932', 'Disallowance', '833.33'),
(46, '20243491528670', 'Disallowance', '833.33'),
(47, '20240769532481', 'Disallowance', '833.33'),
(48, '20248152603794', 'Disallowance', '833.33'),
(49, '20246157293840', 'Disallowance', '833.33'),
(50, '20243742901586', 'Disallowance', '833.33'),
(51, '20242510764938', 'Disallowance', '833.33'),
(52, '20241756480329', 'Disallowance', '833.33'),
(53, '20247864251309', 'Disallowance', '833.33'),
(54, '20240142578639', 'Disallowance', '833.33'),
(55, '20241325697480', 'Disallowance', '833.33'),
(56, '20242584690317', 'Disallowance', '833.33'),
(57, '20249064872315', 'Disallowance', '833.33'),
(58, '20244028573691', 'Disallowance', '833.33'),
(59, '20240431896527', 'Disallowance', '833.33'),
(60, '20244382509716', 'Disallowance', '833.33'),
(61, '20247953104862', 'Disallowance', '833.33'),
(62, '20245701392864', 'Disallowance', '833.33'),
(63, '20242573918460', 'Disallowance', '500.00'),
(64, '20240627813594', 'Disallowance', '833.33'),
(65, '20240361587492', 'Disallowance', '833.33'),
(66, '20244793108526', 'Disallowance', '833.33'),
(67, '20249764802135', 'Disallowance', '833.33'),
(68, '20246129834750', 'Disallowance', '833.33'),
(69, '20249037462581', 'Disallowance', '833.33'),
(70, '20244863597012', 'Disallowance', '833.33'),
(71, '20244597201836', 'Disallowance', '833.33'),
(72, '20246790314258', 'Disallowance', '833.33'),
(73, '20242106573948', 'Disallowance', '416.67'),
(74, '20242106573948', 'Ref-Sal', '833.33'),
(75, '20244065231987', 'Disallowance', '416.67'),
(76, '20244065231987', 'Ref-Sal', '833.33'),
(77, '20245136702849', 'Disallowance', '416.67'),
(78, '20245136702849', 'Ref-Sal', '833.33'),
(79, '20246973140582', 'Disallowance', '416.67'),
(80, '20246973140582', 'Ref-Sal', '833.33'),
(81, '20245360814279', 'Disallowance', '416.67'),
(82, '20245360814279', 'Ref-Sal', '833.33'),
(83, '20244913725068', 'Disallowance', '416.67'),
(84, '20244913725068', 'Ref-Sal', '833.33'),
(85, '20248192546703', 'Disallowance', '416.67'),
(86, '20248192546703', 'Ref-Sal', '833.33'),
(87, '20242596748130', 'Disallowance', '416.67'),
(88, '20241539870264', 'Disallowance', '416.67'),
(89, '20249157238064', 'Disallowance', '416.67'),
(90, '20240746189523', 'Disallowance', '416.67'),
(91, '20243145872069', 'Disallowance', '416.67'),
(92, '20244387905126', 'Ref-Ocom', '10.00'),
(93, '20243729806514', 'Ref-Ocom', '10.00'),
(94, '20240895143627', 'Ref-Ocom', '10.00'),
(95, '20244706539821', 'Ref-Ocom', '41.67'),
(96, '20241502437689', 'Ref-Ocom', '10.00'),
(97, '20247689214350', 'Ref-Ocom', '10.00'),
(98, '20241537280496', 'Ref-Ocom', '41.67'),
(99, '20244137980562', 'Ref-Ocom', '10.00'),
(100, '20240652789431', 'Ref-Ocom', '10.00'),
(101, '20247845163092', 'Ref-Ocom', '41.67'),
(102, '20247528341609', 'Ref-Ocom', '10.00'),
(103, '20240485231769', 'Ref-Ocom', '10.00'),
(104, '20248461395720', 'Ref-Ocom', '41.67');

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
  `gsis_total` double NOT NULL,
  `w_tax_total` double NOT NULL,
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
  `allowance` double NOT NULL,
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

INSERT INTO `payslip` (`id`, `invoice_id`, `employee_name`, `employee_id`, `rate`, `totalhours`, `otrate`, `othrtotal`, `gsis_total`, `w_tax_total`, `ers`, `ees`, `totals`, `erp`, `eep`, `totalp`, `erph`, `eeph`, `totalph`, `loan_description`, `loan_amount`, `totalbenifitsdeduction`, `totaleeer`, `deduction_status`, `dpaidby`, `cashadvance`, `totaldeduction`, `gross`, `allowance`, `netpay`, `paystatus`, `ppaidby`, `generateby`, `datefrom`, `dateto`) VALUES
(301, 20247095462831, 'Jerard Baria', '202331', 123.4, 172, 185.1, 12, 1910.232, 3125, 0, 0, 0, 636.744, 636.744, 1273.488, 477.558, 477.558, 1145.07, '', '', 6149.534, 2418.558, 'Pending', '', 0, 6149.534, 25446, 2000, 19296.466, 'Pending', '', 'Angelo Cruz', '2024-06-01', '2024-06-30'),
(302, 20247528341609, 'Jared Ivan Bruno', '202328', 168.75, 172, 253.13, 12, 2612.25, 3125, 0, 0, 0, 870.75, 870.75, 1741.5, 653.0625, 653.0625, 1532.8152, ' <br>Ref-Ocom', ' <br>10.00', 7261.0625, 3274.3152, 'Pending', '', 0, 7271.0625, 34062.56, 2000, 26791.4975, 'Pending', '', 'Angelo Cruz', '2024-06-01', '2024-06-30'),
(303, 20240485231769, 'Angelo Cruz', '202325', 123.4, 172, 185.1, 12, 1910.232, 3125, 0, 0, 0, 636.744, 636.744, 1273.488, 477.558, 477.558, 1145.07, ' <br>Ref-Ocom', ' <br>10.00', 6149.534, 2418.558, 'Pending', '', 0, 6159.534, 25446, 2000, 19286.466, 'Pending', '', 'Angelo Cruz', '2024-06-01', '2024-06-30'),
(304, 20249875263140, 'Cyrille Jaye Hilario', '202327', 168.75, 172, 253.13, 12, 2612.25, 3125, 0, 0, 0, 870.75, 870.75, 1741.5, 653.0625, 653.0625, 1532.8152, '', '', 7261.0625, 3274.3152, 'Pending', '', 0, 7261.0625, 34062.56, 2000, 26801.4975, 'Pending', '', 'Angelo Cruz', '2024-06-01', '2024-06-30'),
(305, 20248461395720, 'Andrei Niko Perez', '202326', 123.4, 172, 185.1, 12, 1910.232, 3125, 0, 0, 0, 636.744, 636.744, 1273.488, 477.558, 477.558, 1145.07, ' <br>Ref-Ocom', ' <br>41.67', 6149.534, 2418.558, 'Pending', '', 0, 6191.204, 25446, 2000, 19254.796, 'Pending', '', 'Angelo Cruz', '2024-06-01', '2024-06-30');

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
  `ot` double NOT NULL,
  `sg` text NOT NULL,
  `step` text NOT NULL,
  `monthly_salary` double NOT NULL,
  `position_code` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`id`, `description`, `rate`, `ot`, `sg`, `step`, `monthly_salary`, `position_code`) VALUES
(1, 'Programmer', 123.4, 185.1, '1', '8', 30000, 'Programmer_sg1_s8'),
(5, 'HR Department', 168.75, 253.13, '3', '3', 27000, 'HR Department_sg3_s3'),
(6, 'Accounting and Finance Department', 168.75, 253.13, '1', '1', 27000, 'Accounting and Finance Department_sg1_s1');

-- --------------------------------------------------------

--
-- Table structure for table `pre_attendance`
--

CREATE TABLE `pre_attendance` (
  `id` int(255) NOT NULL,
  `employee_id` text CHARACTER SET latin1 NOT NULL,
  `date` date NOT NULL,
  `time_in` time NOT NULL,
  `time_out` time NOT NULL,
  `status` text CHARACTER SET latin1 NOT NULL,
  `comment` text CHARACTER SET latin1 NOT NULL,
  `evidence` text CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
-- Table structure for table `verification_code`
--

CREATE TABLE `verification_code` (
  `id` int(11) NOT NULL,
  `employee_id` text CHARACTER SET latin1 NOT NULL,
  `email` text CHARACTER SET latin1 NOT NULL,
  `code` text CHARACTER SET latin1 NOT NULL,
  `time_code` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `work_overtime`
--

CREATE TABLE `work_overtime` (
  `id` int(255) NOT NULL,
  `employee_id` text CHARACTER SET latin1 NOT NULL,
  `name` text CHARACTER SET latin1 NOT NULL,
  `schedule_load` text CHARACTER SET latin1 NOT NULL,
  `time_load` text CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `work_overtime`
--

INSERT INTO `work_overtime` (`id`, `employee_id`, `name`, `schedule_load`, `time_load`) VALUES
(17, '202325', 'Angelo Cruz', 'SUN', '6'),
(18, '202325', 'Angelo Cruz', 'MON', '3');

-- --------------------------------------------------------

--
-- Table structure for table `w_tax`
--

CREATE TABLE `w_tax` (
  `id` int(255) NOT NULL,
  `f` double NOT NULL,
  `t` double NOT NULL,
  `a` double NOT NULL,
  `b` double NOT NULL,
  `c` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `w_tax`
--

INSERT INTO `w_tax` (`id`, `f`, `t`, `a`, `b`, `c`) VALUES
(1, 0, 250000, 0, 0, 0),
(3, 250000, 400000, 0, 15, 250000),
(4, 400000, 800000, 22500, 20, 400000),
(5, 800000, 2000000, 102500, 25, 800000),
(6, 2000000, 8000000, 402500, 30, 2000000),
(7, 8000000, 1e17, 2020500, 35, 8000000);

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
-- Indexes for table `allowance`
--
ALTER TABLE `allowance`
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
-- Indexes for table `gsis`
--
ALTER TABLE `gsis`
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
-- Indexes for table `loan_transaction`
--
ALTER TABLE `loan_transaction`
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
-- Indexes for table `pre_attendance`
--
ALTER TABLE `pre_attendance`
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
-- Indexes for table `verification_code`
--
ALTER TABLE `verification_code`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `work_overtime`
--
ALTER TABLE `work_overtime`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `w_tax`
--
ALTER TABLE `w_tax`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `admin_position`
--
ALTER TABLE `admin_position`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `allowance`
--
ALTER TABLE `allowance`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1443;

--
-- AUTO_INCREMENT for table `audit_trail_record`
--
ALTER TABLE `audit_trail_record`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=804;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `gsis`
--
ALTER TABLE `gsis`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `leave_record`
--
ALTER TABLE `leave_record`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `loan`
--
ALTER TABLE `loan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `loan_transaction`
--
ALTER TABLE `loan_transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=306;

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
-- AUTO_INCREMENT for table `pre_attendance`
--
ALTER TABLE `pre_attendance`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
-- AUTO_INCREMENT for table `verification_code`
--
ALTER TABLE `verification_code`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `work_overtime`
--
ALTER TABLE `work_overtime`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `w_tax`
--
ALTER TABLE `w_tax`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
