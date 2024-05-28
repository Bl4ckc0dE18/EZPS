-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2024 at 11:35 AM
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
  `position` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `num_ot` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `employee_id`, `date`, `time_in`, `status`, `time_out`, `num_hr`, `num_ot`) VALUES
(84, 30, '2024-02-22', '01:31:34', 1, '01:31:36', 0, 0),
(85, 30, '2024-02-22', '01:31:38', 2, '01:31:48', 0, 0),
(86, 30, '2024-02-22', '01:31:49', 2, '01:31:51', 0, 0),
(87, 30, '2024-02-22', '01:31:52', 2, '01:31:54', 0, 0),
(88, 30, '2024-02-22', '01:31:56', 2, '01:31:57', 0, 0),
(89, 30, '2024-02-22', '01:31:59', 2, '01:32:02', 0, 0),
(90, 30, '2024-02-22', '01:32:03', 2, '01:32:05', 0, 0),
(91, 30, '2024-02-22', '01:32:06', 2, '00:00:00', 0, 0),
(93, 25, '2024-03-12', '17:24:27', 0, '00:00:00', 0, 0),
(94, 25, '2023-12-01', '08:00:00', 3, '17:00:00', 9, 0),
(95, 25, '2023-12-02', '08:00:00', 3, '17:00:00', 9, 0),
(96, 25, '2023-12-03', '08:00:00', 3, '17:00:00', 9, 0),
(97, 25, '2023-12-04', '08:00:00', 3, '17:00:00', 9, 0),
(98, 25, '2023-12-05', '08:00:00', 3, '17:00:00', 9, 0),
(99, 25, '2023-12-06', '08:00:00', 3, '17:00:00', 9, 0),
(100, 25, '2023-12-07', '08:00:00', 3, '17:00:00', 9, 0),
(101, 25, '2023-12-08', '08:00:00', 3, '17:00:00', 9, 0),
(102, 25, '2023-12-09', '08:00:00', 3, '17:00:00', 9, 0),
(103, 25, '2023-12-10', '08:00:00', 3, '17:00:00', 9, 0),
(104, 25, '2023-12-11', '08:00:00', 3, '17:00:00', 9, 0),
(105, 25, '2023-12-12', '08:00:00', 3, '17:00:00', 9, 0),
(106, 25, '2023-12-13', '08:00:00', 3, '17:00:00', 9, 0),
(107, 25, '2023-12-14', '08:00:00', 3, '17:00:00', 9, 0),
(108, 25, '2023-12-15', '08:00:00', 3, '17:00:00', 9, 0),
(109, 25, '2023-12-16', '08:00:00', 3, '17:00:00', 9, 0),
(110, 25, '2023-12-17', '08:00:00', 3, '17:00:00', 9, 0),
(111, 25, '2023-12-18', '08:00:00', 3, '17:00:00', 9, 0),
(112, 25, '2023-12-19', '08:00:00', 3, '17:00:00', 9, 0),
(113, 25, '2023-12-20', '08:00:00', 3, '17:00:00', 9, 0),
(114, 25, '2023-12-21', '08:00:00', 3, '17:00:00', 9, 0),
(115, 25, '2023-12-22', '08:00:00', 3, '17:00:00', 9, 0),
(116, 25, '2023-12-23', '08:00:00', 3, '17:00:00', 9, 0),
(117, 25, '2023-12-24', '08:00:00', 3, '17:00:00', 9, 0),
(118, 25, '2023-12-25', '08:00:00', 3, '17:00:00', 9, 0),
(119, 25, '2023-12-26', '08:00:00', 3, '17:00:00', 9, 0),
(120, 25, '2023-12-27', '08:00:00', 3, '17:00:00', 9, 0),
(121, 25, '2023-12-28', '08:00:00', 3, '17:00:00', 9, 0),
(122, 25, '2023-12-29', '08:00:00', 3, '17:00:00', 9, 0),
(123, 25, '2023-12-30', '08:00:00', 3, '17:00:00', 9, 0),
(124, 25, '2023-12-31', '08:00:00', 3, '17:00:00', 9, 0),
(125, 25, '2024-01-01', '08:00:00', 3, '17:00:00', 9, 0),
(126, 25, '2024-01-02', '08:00:00', 3, '17:00:00', 9, 0),
(127, 25, '2024-01-03', '08:00:00', 3, '17:00:00', 9, 0),
(128, 25, '2024-01-04', '08:00:00', 3, '17:00:00', 9, 0),
(129, 25, '2024-01-05', '08:00:00', 3, '17:00:00', 9, 0),
(130, 25, '2024-01-06', '08:00:00', 3, '17:00:00', 9, 0),
(131, 25, '2024-01-07', '08:00:00', 3, '17:00:00', 9, 0),
(132, 25, '2024-01-08', '08:00:00', 3, '17:00:00', 9, 0),
(133, 25, '2024-01-09', '08:00:00', 3, '17:00:00', 9, 0),
(134, 25, '2024-01-10', '08:00:00', 3, '17:00:00', 9, 0),
(135, 25, '2024-01-11', '08:00:00', 3, '17:00:00', 9, 0),
(136, 25, '2024-01-12', '08:00:00', 3, '17:00:00', 9, 0),
(137, 25, '2024-01-13', '08:00:00', 3, '17:00:00', 9, 0),
(138, 25, '2024-01-14', '08:00:00', 3, '17:00:00', 9, 0),
(139, 25, '2024-01-15', '08:00:00', 3, '17:00:00', 9, 0),
(140, 25, '2024-01-16', '08:00:00', 3, '17:00:00', 9, 0),
(141, 25, '2024-01-17', '08:00:00', 3, '17:00:00', 9, 0),
(142, 25, '2024-01-18', '08:00:00', 3, '17:00:00', 9, 0),
(143, 25, '2024-01-19', '08:00:00', 3, '17:00:00', 9, 0),
(144, 25, '2024-01-20', '08:00:00', 3, '17:00:00', 9, 0),
(145, 25, '2024-01-21', '08:00:00', 3, '17:00:00', 9, 0),
(146, 25, '2024-01-22', '08:00:00', 3, '17:00:00', 9, 0),
(147, 25, '2024-01-23', '08:00:00', 3, '17:00:00', 9, 0),
(148, 25, '2024-01-24', '08:00:00', 3, '17:00:00', 9, 0),
(149, 25, '2024-01-25', '08:00:00', 3, '17:00:00', 9, 0),
(150, 25, '2024-01-26', '08:00:00', 3, '17:00:00', 9, 0),
(151, 25, '2024-01-27', '08:00:00', 3, '17:00:00', 9, 0),
(152, 25, '2024-01-28', '08:00:00', 3, '17:00:00', 9, 0),
(153, 25, '2024-01-29', '08:00:00', 3, '17:00:00', 9, 0),
(154, 25, '2024-01-30', '08:00:00', 3, '17:00:00', 9, 0),
(155, 25, '2024-01-31', '08:00:00', 3, '17:00:00', 9, 0),
(156, 25, '2024-02-01', '08:00:00', 3, '17:00:00', 9, 0),
(157, 25, '2024-02-02', '08:00:00', 3, '17:00:00', 9, 0),
(158, 25, '2024-02-03', '08:00:00', 3, '17:00:00', 9, 0),
(159, 25, '2024-02-04', '08:00:00', 3, '17:00:00', 9, 0),
(160, 25, '2024-02-05', '08:00:00', 3, '17:00:00', 9, 0),
(161, 25, '2024-02-06', '08:00:00', 3, '17:00:00', 9, 0),
(162, 25, '2024-02-07', '08:00:00', 3, '17:00:00', 9, 0),
(163, 25, '2024-02-08', '08:00:00', 3, '17:00:00', 9, 0),
(164, 25, '2024-02-09', '08:00:00', 3, '17:00:00', 9, 0),
(165, 25, '2024-02-10', '08:00:00', 3, '17:00:00', 9, 0),
(166, 25, '2024-02-11', '08:00:00', 3, '17:00:00', 9, 0),
(167, 25, '2024-02-12', '08:00:00', 3, '17:00:00', 9, 0),
(168, 25, '2024-02-13', '08:00:00', 3, '17:00:00', 9, 0),
(169, 25, '2024-02-14', '08:00:00', 3, '17:00:00', 9, 0),
(170, 25, '2024-02-15', '08:00:00', 3, '17:00:00', 9, 0),
(171, 25, '2024-02-16', '08:00:00', 3, '17:00:00', 9, 0),
(172, 25, '2024-02-17', '08:00:00', 3, '17:00:00', 9, 0),
(173, 25, '2024-02-18', '08:00:00', 3, '17:00:00', 9, 0),
(174, 25, '2024-02-19', '08:00:00', 3, '17:00:00', 9, 0),
(175, 25, '2024-02-20', '08:00:00', 3, '17:00:00', 9, 0),
(176, 25, '2024-02-21', '08:00:00', 3, '17:00:00', 9, 0),
(177, 25, '2024-02-22', '08:00:00', 3, '17:00:00', 9, 0),
(178, 25, '2024-02-23', '08:00:00', 3, '17:00:00', 9, 0),
(179, 25, '2024-02-24', '08:00:00', 3, '17:00:00', 9, 0),
(180, 25, '2024-02-25', '08:00:00', 3, '17:00:00', 9, 0),
(181, 25, '2024-02-26', '08:00:00', 3, '17:00:00', 9, 0),
(182, 25, '2024-02-27', '08:00:00', 3, '17:00:00', 9, 0),
(183, 25, '2024-02-28', '08:00:00', 3, '17:00:00', 9, 0),
(184, 25, '2024-02-29', '08:00:00', 3, '17:00:00', 9, 0),
(185, 25, '2024-03-01', '08:00:00', 3, '17:00:00', 9, 0),
(186, 25, '2024-03-02', '08:00:00', 3, '17:00:00', 9, 0),
(187, 25, '2024-03-03', '08:00:00', 3, '17:00:00', 9, 0),
(188, 25, '2024-03-04', '08:00:00', 3, '17:00:00', 9, 0),
(189, 25, '2024-03-05', '08:00:00', 3, '17:00:00', 9, 0),
(190, 25, '2024-03-06', '08:00:00', 3, '17:00:00', 9, 0),
(191, 25, '2024-03-07', '08:00:00', 3, '17:00:00', 9, 0),
(192, 25, '2024-03-08', '08:00:00', 3, '17:00:00', 9, 0),
(193, 25, '2024-03-09', '08:00:00', 3, '17:00:00', 9, 0),
(194, 25, '2024-03-10', '08:00:00', 3, '17:00:00', 9, 0),
(195, 25, '2024-03-11', '08:00:00', 3, '17:00:00', 9, 0),
(196, 25, '2024-03-12', '08:00:00', 3, '17:00:00', 9, 0),
(197, 25, '2024-03-13', '08:00:00', 3, '17:00:00', 9, 0),
(198, 25, '2024-03-14', '08:00:00', 3, '17:00:00', 9, 0),
(199, 25, '2024-03-15', '08:00:00', 3, '17:00:00', 9, 0),
(200, 25, '2024-03-16', '08:00:00', 3, '17:00:00', 9, 0),
(201, 25, '2024-03-17', '08:00:00', 3, '17:00:00', 9, 0),
(202, 25, '2024-03-18', '08:00:00', 3, '17:00:00', 9, 0),
(203, 25, '2024-03-19', '08:00:00', 3, '17:00:00', 9, 0),
(204, 25, '2024-03-20', '08:00:00', 3, '17:00:00', 9, 0),
(205, 25, '2024-03-21', '08:00:00', 3, '17:00:00', 9, 0),
(206, 25, '2024-03-22', '08:00:00', 3, '17:00:00', 9, 0),
(207, 25, '2024-03-23', '08:00:00', 3, '17:00:00', 9, 0),
(208, 25, '2024-03-24', '08:00:00', 3, '17:00:00', 9, 0),
(209, 25, '2024-03-25', '08:00:00', 3, '17:00:00', 9, 0),
(210, 25, '2024-03-26', '08:00:00', 3, '17:00:00', 9, 0),
(211, 25, '2024-03-27', '08:00:00', 3, '17:00:00', 9, 0),
(212, 25, '2024-03-28', '08:00:00', 3, '17:00:00', 9, 0),
(213, 25, '2024-03-29', '08:00:00', 3, '17:00:00', 9, 0),
(214, 25, '2024-03-30', '08:00:00', 3, '17:00:00', 9, 0),
(215, 25, '2024-03-31', '08:00:00', 3, '17:00:00', 9, 0),
(216, 25, '2024-04-01', '08:00:00', 3, '17:00:00', 9, 0),
(217, 25, '2024-04-02', '08:00:00', 3, '17:00:00', 9, 0),
(218, 25, '2024-04-03', '08:00:00', 3, '17:00:00', 9, 0),
(219, 25, '2024-04-04', '08:00:00', 3, '17:00:00', 9, 0),
(220, 25, '2024-04-05', '08:00:00', 3, '17:00:00', 9, 0),
(221, 25, '2024-04-06', '08:00:00', 3, '17:00:00', 9, 0),
(222, 25, '2024-04-07', '08:00:00', 3, '17:00:00', 9, 0),
(223, 25, '2024-04-08', '08:00:00', 3, '17:00:00', 9, 0),
(224, 25, '2024-04-09', '08:00:00', 3, '17:00:00', 9, 0),
(225, 25, '2024-04-10', '08:00:00', 3, '17:00:00', 9, 0),
(226, 25, '2024-04-11', '08:00:00', 3, '17:00:00', 9, 0),
(227, 25, '2024-04-12', '08:00:00', 3, '17:00:00', 9, 0),
(228, 25, '2024-04-13', '08:00:00', 3, '17:00:00', 9, 0),
(229, 25, '2024-04-14', '08:00:00', 3, '17:00:00', 9, 0),
(230, 25, '2024-04-15', '08:00:00', 3, '17:00:00', 9, 0),
(231, 25, '2024-04-16', '08:00:00', 3, '17:00:00', 9, 0),
(232, 25, '2024-04-17', '08:00:00', 3, '17:00:00', 9, 0),
(233, 25, '2024-04-18', '08:00:00', 3, '17:00:00', 9, 0),
(234, 25, '2024-04-19', '08:00:00', 3, '17:00:00', 9, 0),
(235, 25, '2024-04-20', '08:00:00', 3, '17:00:00', 9, 0),
(236, 25, '2024-04-21', '08:00:00', 3, '17:00:00', 9, 0),
(237, 25, '2024-04-22', '08:00:00', 3, '17:00:00', 9, 0),
(238, 25, '2024-04-23', '08:00:00', 3, '17:00:00', 9, 0),
(239, 25, '2024-04-24', '08:00:00', 3, '17:00:00', 9, 0),
(240, 25, '2024-04-25', '08:00:00', 3, '17:00:00', 9, 0),
(241, 25, '2024-04-26', '08:00:00', 3, '17:00:00', 9, 0),
(242, 25, '2024-04-27', '08:00:00', 3, '17:00:00', 9, 0),
(243, 25, '2024-04-28', '08:00:00', 3, '17:00:00', 9, 0),
(244, 25, '2024-04-29', '08:00:00', 3, '17:00:00', 9, 0),
(245, 25, '2024-04-30', '08:00:00', 3, '17:00:00', 9, 0),
(246, 25, '2024-05-01', '08:00:00', 3, '17:00:00', 9, 0),
(247, 25, '2024-05-02', '08:00:00', 3, '17:00:00', 9, 0),
(248, 25, '2024-05-03', '08:00:00', 3, '17:00:00', 9, 0),
(249, 25, '2024-05-04', '08:00:00', 3, '17:00:00', 9, 0),
(250, 25, '2024-05-05', '08:00:00', 3, '17:00:00', 9, 0),
(251, 25, '2024-05-06', '08:00:00', 3, '17:00:00', 9, 0),
(252, 25, '2024-05-07', '08:00:00', 3, '17:00:00', 9, 0),
(253, 25, '2024-05-08', '08:00:00', 3, '17:00:00', 9, 0),
(254, 25, '2024-05-09', '08:00:00', 3, '17:00:00', 9, 0),
(255, 25, '2024-05-10', '08:00:00', 3, '17:00:00', 9, 0),
(256, 25, '2024-05-11', '08:00:00', 3, '17:00:00', 9, 0),
(257, 25, '2024-05-12', '08:00:00', 3, '17:00:00', 9, 0),
(258, 25, '2024-05-13', '08:00:00', 3, '17:00:00', 9, 0),
(259, 25, '2024-05-14', '08:00:00', 3, '17:00:00', 9, 0),
(260, 25, '2024-05-15', '08:00:00', 3, '17:00:00', 9, 0),
(261, 25, '2024-05-16', '08:00:00', 3, '17:00:00', 9, 0),
(262, 25, '2024-05-17', '08:00:00', 3, '17:00:00', 9, 0),
(263, 25, '2024-05-18', '08:00:00', 3, '17:00:00', 9, 0),
(264, 25, '2024-05-19', '08:00:00', 3, '17:00:00', 9, 0),
(265, 25, '2024-05-20', '08:00:00', 3, '17:00:00', 9, 0),
(266, 25, '2024-05-21', '08:00:00', 3, '17:00:00', 9, 0),
(267, 25, '2024-05-22', '08:00:00', 3, '17:00:00', 9, 0),
(268, 25, '2024-05-23', '08:00:00', 3, '17:00:00', 9, 0),
(269, 25, '2024-05-24', '08:00:00', 3, '17:00:00', 9, 0),
(270, 25, '2024-05-25', '08:00:00', 3, '17:00:00', 9, 0),
(271, 25, '2024-05-26', '08:00:00', 3, '17:00:00', 9, 0),
(272, 25, '2024-05-27', '08:00:00', 3, '17:00:00', 9, 0),
(273, 25, '2024-05-28', '08:00:00', 3, '17:00:00', 9, 0),
(274, 25, '2024-05-29', '08:00:00', 3, '17:00:00', 9, 0),
(275, 25, '2024-05-30', '08:00:00', 3, '17:00:00', 9, 0),
(276, 25, '2024-05-31', '08:00:00', 3, '17:00:00', 9, 0),
(277, 25, '2024-06-01', '08:00:00', 3, '17:00:00', 9, 0),
(278, 25, '2024-06-02', '08:00:00', 3, '17:00:00', 9, 0),
(279, 25, '2024-06-03', '08:00:00', 3, '17:00:00', 9, 0),
(280, 25, '2024-06-04', '08:00:00', 3, '17:00:00', 9, 0),
(281, 25, '2024-06-05', '08:00:00', 3, '17:00:00', 9, 0),
(282, 25, '2024-06-06', '08:00:00', 3, '17:00:00', 9, 0),
(283, 25, '2024-06-07', '08:00:00', 3, '17:00:00', 9, 0),
(284, 25, '2024-06-08', '08:00:00', 3, '17:00:00', 9, 0),
(285, 25, '2024-06-09', '08:00:00', 3, '17:00:00', 9, 0),
(286, 25, '2024-06-10', '08:00:00', 3, '17:00:00', 9, 0),
(287, 25, '2024-06-11', '08:00:00', 3, '17:00:00', 9, 0),
(288, 25, '2024-06-12', '08:00:00', 3, '17:00:00', 9, 0),
(289, 25, '2024-06-13', '08:00:00', 3, '17:00:00', 9, 0),
(290, 25, '2024-06-14', '08:00:00', 3, '17:00:00', 9, 0),
(291, 25, '2024-06-15', '08:00:00', 3, '17:00:00', 9, 0),
(292, 25, '2024-06-16', '08:00:00', 3, '17:00:00', 9, 0),
(293, 25, '2024-06-17', '08:00:00', 3, '17:00:00', 9, 0),
(294, 25, '2024-06-18', '08:00:00', 3, '17:00:00', 9, 0),
(295, 25, '2024-06-19', '08:00:00', 3, '17:00:00', 9, 0),
(296, 25, '2024-06-20', '08:00:00', 3, '17:00:00', 9, 0),
(297, 25, '2024-06-21', '08:00:00', 3, '17:00:00', 9, 0),
(298, 25, '2024-06-22', '08:00:00', 3, '17:00:00', 9, 0),
(299, 25, '2024-06-23', '08:00:00', 3, '17:00:00', 9, 0),
(300, 25, '2024-06-24', '08:00:00', 3, '17:00:00', 9, 0),
(301, 25, '2024-06-25', '08:00:00', 3, '17:00:00', 9, 0),
(302, 25, '2024-06-26', '08:00:00', 3, '17:00:00', 9, 0),
(303, 25, '2024-06-27', '08:00:00', 3, '17:00:00', 9, 0),
(304, 25, '2024-06-28', '08:00:00', 3, '17:00:00', 9, 0),
(305, 25, '2024-06-29', '08:00:00', 3, '17:00:00', 9, 0),
(306, 25, '2024-04-03', '14:11:14', 3, '00:00:00', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `audit_trail_record`
--

CREATE TABLE `audit_trail_record` (
  `id` int(11) NOT NULL,
  `audit_date` date NOT NULL,
  `audit_time` time NOT NULL,
  `user` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `description` text CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `audit_trail_record`
--

INSERT INTO `audit_trail_record` (`id`, `audit_date`, `audit_time`, `user`, `description`) VALUES
(217, '2024-02-11', '02:40:38', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-01'),
(218, '2024-02-11', '02:40:38', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-02'),
(219, '2024-02-11', '02:40:38', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-03'),
(220, '2024-02-11', '02:40:38', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-04'),
(221, '2024-02-11', '02:40:38', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-05'),
(222, '2024-02-11', '02:40:38', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-06'),
(223, '2024-02-11', '02:40:38', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-07'),
(224, '2024-02-11', '02:40:38', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-08'),
(225, '2024-02-11', '02:40:38', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-09'),
(226, '2024-02-11', '02:40:38', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-10'),
(227, '2024-02-11', '02:40:38', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-11'),
(228, '2024-02-11', '02:40:38', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-12'),
(229, '2024-02-11', '02:40:38', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-13'),
(230, '2024-02-11', '02:40:38', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-14'),
(231, '2024-02-11', '02:40:39', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-15'),
(232, '2024-02-11', '02:40:39', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-16'),
(233, '2024-02-11', '02:40:39', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-17'),
(234, '2024-02-11', '02:40:39', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-18'),
(235, '2024-02-11', '02:40:39', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-19'),
(236, '2024-02-11', '02:40:39', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-20'),
(237, '2024-02-11', '02:40:39', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-21'),
(238, '2024-02-11', '02:40:39', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-22'),
(239, '2024-02-11', '02:40:39', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-23'),
(240, '2024-02-11', '02:40:39', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-24'),
(241, '2024-02-11', '02:40:39', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-25'),
(242, '2024-02-11', '02:40:39', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-26'),
(243, '2024-02-11', '02:40:39', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-27'),
(244, '2024-02-11', '02:40:39', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-28'),
(245, '2024-02-11', '02:40:39', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-29'),
(246, '2024-02-20', '23:21:36', 'Angelo Cruz', 'User password updated   date 2024-02-20'),
(247, '2024-02-21', '02:26:46', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-01'),
(248, '2024-02-21', '02:26:46', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-02'),
(249, '2024-02-21', '02:26:46', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-03'),
(250, '2024-02-21', '02:26:46', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-04'),
(251, '2024-02-21', '02:26:46', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-05'),
(252, '2024-02-21', '02:26:46', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-06'),
(253, '2024-02-21', '02:26:46', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-07'),
(254, '2024-02-21', '02:26:46', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-08'),
(255, '2024-02-21', '02:26:46', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-09'),
(256, '2024-02-21', '02:26:46', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-10'),
(257, '2024-02-21', '02:26:46', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-11'),
(258, '2024-02-21', '02:26:46', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-12'),
(259, '2024-02-21', '02:26:46', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-13'),
(260, '2024-02-21', '02:26:46', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-14'),
(261, '2024-02-21', '02:26:46', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-15'),
(262, '2024-02-21', '02:26:46', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-16'),
(263, '2024-02-21', '02:26:46', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-17'),
(264, '2024-02-21', '02:26:47', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-18'),
(265, '2024-02-21', '02:26:47', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-19'),
(266, '2024-02-21', '02:26:47', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-20'),
(267, '2024-02-21', '02:26:47', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-22'),
(268, '2024-02-21', '02:26:47', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-23'),
(269, '2024-02-21', '02:26:47', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-24'),
(270, '2024-02-21', '02:26:47', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-25'),
(271, '2024-02-21', '02:26:47', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-26'),
(272, '2024-02-21', '02:26:47', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-27'),
(273, '2024-02-21', '02:26:47', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-28'),
(274, '2024-02-21', '02:26:47', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-29'),
(275, '2024-02-21', '02:27:31', 'Angelo Cruz', 'Employee updated 202325 date 2024-02-21'),
(276, '2024-02-21', '02:27:51', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-02-01'),
(277, '2024-02-21', '02:27:51', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-02-02'),
(278, '2024-02-21', '02:27:51', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-02-03'),
(279, '2024-02-21', '02:27:51', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-02-04'),
(280, '2024-02-21', '02:27:51', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-02-05'),
(281, '2024-02-21', '02:27:51', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-02-06'),
(282, '2024-02-21', '02:27:51', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-02-07'),
(283, '2024-02-21', '02:27:51', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-02-08'),
(284, '2024-02-21', '02:27:51', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-02-09'),
(285, '2024-02-21', '02:27:51', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-02-10'),
(286, '2024-02-21', '02:27:51', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-02-11'),
(287, '2024-02-21', '02:27:51', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-02-12'),
(288, '2024-02-21', '02:27:51', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-02-13'),
(289, '2024-02-21', '02:27:52', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-02-14'),
(290, '2024-02-21', '02:27:52', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-02-15'),
(291, '2024-02-21', '02:27:52', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-02-16'),
(292, '2024-02-21', '02:27:52', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-02-17'),
(293, '2024-02-21', '02:27:52', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-02-18'),
(294, '2024-02-21', '02:27:52', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-02-19'),
(295, '2024-02-21', '02:27:52', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-02-20'),
(296, '2024-02-21', '02:27:52', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-02-21'),
(297, '2024-02-21', '02:27:52', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-02-22'),
(298, '2024-02-21', '02:27:52', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-02-23'),
(299, '2024-02-21', '02:27:52', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-02-24'),
(300, '2024-02-21', '02:27:52', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-02-25'),
(301, '2024-02-21', '02:27:52', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-02-26'),
(302, '2024-02-21', '02:27:52', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-02-27'),
(303, '2024-02-21', '02:27:52', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-02-28'),
(304, '2024-02-21', '02:27:52', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-02-29'),
(305, '2024-02-21', '02:27:52', 'Angelo Cruz', 'Rejected leave for employee id number 202325 date 2024-02-29'),
(306, '2024-02-21', '02:27:55', 'Angelo Cruz', 'Rejected leave for employee id number 202325 date 2024-02-29'),
(307, '2024-02-21', '02:28:39', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-01'),
(308, '2024-02-21', '02:28:39', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-02'),
(309, '2024-02-21', '02:28:39', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-03'),
(310, '2024-02-21', '02:28:39', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-04'),
(311, '2024-02-21', '02:28:39', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-05'),
(312, '2024-02-21', '02:28:39', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-06'),
(313, '2024-02-21', '02:30:21', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-01'),
(314, '2024-02-21', '02:30:21', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-02'),
(315, '2024-02-21', '02:30:21', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-03'),
(316, '2024-02-21', '02:30:21', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-04'),
(317, '2024-02-21', '02:30:21', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-05'),
(318, '2024-02-21', '02:30:21', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-06'),
(319, '2024-02-21', '02:30:21', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-07'),
(320, '2024-02-21', '02:30:21', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-08'),
(321, '2024-02-21', '02:33:07', 'Angelo Cruz', 'Employee updated 202325 date 2024-02-21'),
(322, '2024-02-21', '02:34:20', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-01'),
(323, '2024-02-21', '02:34:20', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-02'),
(324, '2024-02-21', '02:34:20', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-03'),
(325, '2024-02-21', '02:34:20', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-04'),
(326, '2024-02-21', '02:34:20', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-05'),
(327, '2024-02-21', '02:34:20', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-06'),
(328, '2024-02-21', '02:34:20', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-07'),
(329, '2024-02-21', '02:34:20', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-08'),
(330, '2024-02-21', '02:34:20', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-09'),
(331, '2024-02-21', '02:34:20', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-10'),
(332, '2024-02-21', '02:34:20', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-11'),
(333, '2024-02-21', '02:34:20', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-12'),
(334, '2024-02-21', '02:34:20', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-13'),
(335, '2024-02-21', '02:34:20', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-14'),
(336, '2024-02-21', '02:34:20', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-15'),
(337, '2024-02-21', '02:34:20', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-16'),
(338, '2024-02-21', '02:34:20', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-17'),
(339, '2024-02-21', '02:34:20', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-18'),
(340, '2024-02-21', '02:34:20', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-19'),
(341, '2024-02-21', '02:34:20', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-20'),
(342, '2024-02-21', '02:34:20', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-21'),
(343, '2024-02-21', '02:34:20', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-22'),
(344, '2024-02-21', '02:34:20', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-23'),
(345, '2024-02-21', '02:34:21', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-24'),
(346, '2024-02-21', '02:34:21', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-25'),
(347, '2024-02-21', '02:34:21', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-26'),
(348, '2024-02-21', '02:34:21', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-27'),
(349, '2024-02-21', '02:34:21', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-28'),
(350, '2024-02-21', '02:34:21', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-29'),
(351, '2024-02-21', '02:36:27', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-02-01'),
(352, '2024-02-21', '02:36:27', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-02-02'),
(353, '2024-02-21', '02:36:27', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-02-03'),
(354, '2024-02-21', '02:36:27', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-02-04'),
(355, '2024-02-21', '02:36:28', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-02-05'),
(356, '2024-02-21', '02:36:28', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-02-06'),
(357, '2024-02-21', '02:36:28', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-02-07'),
(358, '2024-02-21', '02:36:28', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-02-08'),
(359, '2024-02-21', '02:36:28', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-02-09'),
(360, '2024-02-21', '02:36:28', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-02-10'),
(361, '2024-02-21', '02:36:28', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-02-11'),
(362, '2024-02-21', '02:36:28', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-02-12'),
(363, '2024-02-21', '02:36:28', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-02-13'),
(364, '2024-02-21', '02:36:28', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-02-14'),
(365, '2024-02-21', '02:36:28', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-02-15'),
(366, '2024-02-21', '02:36:28', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-02-16'),
(367, '2024-02-21', '02:36:28', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-02-17'),
(368, '2024-02-21', '02:36:28', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-02-18'),
(369, '2024-02-21', '02:36:28', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-02-19'),
(370, '2024-02-21', '02:36:28', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-02-20'),
(371, '2024-02-21', '02:36:28', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-02-21'),
(372, '2024-02-21', '02:36:28', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-02-22'),
(373, '2024-02-21', '02:36:28', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-02-23'),
(374, '2024-02-21', '02:36:28', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-02-24'),
(375, '2024-02-21', '02:36:28', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-02-25'),
(376, '2024-02-21', '02:36:28', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-02-26'),
(377, '2024-02-21', '02:36:28', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-02-27'),
(378, '2024-02-21', '02:36:28', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-02-28'),
(379, '2024-02-21', '02:36:28', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-02-29'),
(380, '2024-02-21', '02:36:28', 'Angelo Cruz', 'Rejected leave for employee id number 202325 date 2024-02-29'),
(381, '2024-02-21', '02:36:28', 'Angelo Cruz', 'Rejected leave for employee id number 202325 date 2024-02-29'),
(382, '2024-02-21', '02:37:10', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-01'),
(383, '2024-02-21', '02:37:10', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-02'),
(384, '2024-02-21', '02:37:10', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-03'),
(385, '2024-02-21', '02:37:10', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-04'),
(386, '2024-02-21', '02:39:27', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-02-01'),
(387, '2024-02-21', '02:39:27', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-02-02'),
(388, '2024-02-21', '02:39:27', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-02-03'),
(389, '2024-02-21', '02:39:27', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-02-04'),
(390, '2024-02-21', '02:39:27', 'Angelo Cruz', 'Rejected leave for employee id number 202325 date 2024-02-04'),
(391, '2024-02-21', '02:39:46', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-01'),
(392, '2024-02-21', '02:39:46', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-02'),
(393, '2024-02-21', '02:39:46', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-03'),
(394, '2024-02-21', '02:40:01', 'Angelo Cruz', 'Employee updated 202325 date 2024-02-21'),
(395, '2024-02-21', '02:40:23', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-02-01'),
(396, '2024-02-21', '02:40:23', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-02-02'),
(397, '2024-02-21', '02:40:23', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-02-03'),
(398, '2024-02-21', '02:40:23', 'Angelo Cruz', 'Rejected leave for employee id number 202325 date 2024-02-03'),
(399, '2024-02-21', '02:40:37', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-01'),
(400, '2024-02-21', '02:40:37', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-02'),
(401, '2024-02-21', '02:40:37', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-03'),
(402, '2024-02-21', '02:49:47', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-02-01'),
(403, '2024-02-21', '02:49:47', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-02-02'),
(404, '2024-02-21', '02:49:47', 'Angelo Cruz', 'Delete leave for employee id number 202325 date 2024-02-03'),
(405, '2024-02-21', '02:49:47', 'Angelo Cruz', 'Rejected leave for employee id number 202325 date 2024-02-03'),
(406, '2024-03-11', '04:00:44', 'Angelo Cruz', 'Attendance downloaded attendance-from-Jan 01 2024-to-Mar 31 2024.csv date 2024-03-11'),
(407, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2023-12-01'),
(408, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2023-12-02'),
(409, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2023-12-03'),
(410, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2023-12-04'),
(411, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2023-12-05'),
(412, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2023-12-06'),
(413, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2023-12-07'),
(414, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2023-12-08'),
(415, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2023-12-09'),
(416, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2023-12-10'),
(417, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2023-12-11'),
(418, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2023-12-12'),
(419, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2023-12-13'),
(420, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2023-12-14'),
(421, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2023-12-15'),
(422, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2023-12-16'),
(423, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2023-12-17'),
(424, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2023-12-18'),
(425, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2023-12-19'),
(426, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2023-12-20'),
(427, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2023-12-21'),
(428, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2023-12-22'),
(429, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2023-12-23'),
(430, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2023-12-24'),
(431, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2023-12-25'),
(432, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2023-12-26'),
(433, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2023-12-27'),
(434, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2023-12-28'),
(435, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2023-12-29'),
(436, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2023-12-30'),
(437, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2023-12-31'),
(438, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-01-01'),
(439, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-01-02'),
(440, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-01-03'),
(441, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-01-04'),
(442, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-01-05'),
(443, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-01-06'),
(444, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-01-07'),
(445, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-01-08'),
(446, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-01-09'),
(447, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-01-10'),
(448, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-01-11'),
(449, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-01-12'),
(450, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-01-13'),
(451, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-01-14'),
(452, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-01-15'),
(453, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-01-16'),
(454, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-01-17'),
(455, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-01-18'),
(456, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-01-19'),
(457, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-01-20'),
(458, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-01-21'),
(459, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-01-22'),
(460, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-01-23'),
(461, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-01-24'),
(462, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-01-25'),
(463, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-01-26'),
(464, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-01-27'),
(465, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-01-28'),
(466, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-01-29'),
(467, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-01-30'),
(468, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-01-31'),
(469, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-01'),
(470, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-02'),
(471, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-03'),
(472, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-04'),
(473, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-05'),
(474, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-06'),
(475, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-07'),
(476, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-08'),
(477, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-09'),
(478, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-10'),
(479, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-11'),
(480, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-12'),
(481, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-13'),
(482, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-14'),
(483, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-15'),
(484, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-16'),
(485, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-17'),
(486, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-18'),
(487, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-19'),
(488, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-20'),
(489, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-21'),
(490, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-22'),
(491, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-23'),
(492, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-24'),
(493, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-25'),
(494, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-26'),
(495, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-27'),
(496, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-28'),
(497, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-02-29'),
(498, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-03-01'),
(499, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-03-02'),
(500, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-03-03'),
(501, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-03-04'),
(502, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-03-05'),
(503, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-03-06'),
(504, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-03-07'),
(505, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-03-08'),
(506, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-03-09'),
(507, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-03-10'),
(508, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-03-11'),
(509, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-03-12'),
(510, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-03-13'),
(511, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-03-14'),
(512, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-03-15'),
(513, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-03-16'),
(514, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-03-17'),
(515, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-03-18'),
(516, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-03-19'),
(517, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-03-20'),
(518, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-03-21'),
(519, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-03-22'),
(520, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-03-23'),
(521, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-03-24'),
(522, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-03-25'),
(523, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-03-26'),
(524, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-03-27'),
(525, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-03-28'),
(526, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-03-29'),
(527, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-03-30'),
(528, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-03-31'),
(529, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-04-01'),
(530, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-04-02'),
(531, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-04-03'),
(532, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-04-04'),
(533, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-04-05'),
(534, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-04-06'),
(535, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-04-07'),
(536, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-04-08'),
(537, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-04-09'),
(538, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-04-10'),
(539, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-04-11'),
(540, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-04-12'),
(541, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-04-13'),
(542, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-04-14'),
(543, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-04-15'),
(544, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-04-16'),
(545, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-04-17'),
(546, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-04-18'),
(547, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-04-19'),
(548, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-04-20'),
(549, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-04-21'),
(550, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-04-22'),
(551, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-04-23'),
(552, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-04-24'),
(553, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-04-25'),
(554, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-04-26'),
(555, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-04-27'),
(556, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-04-28'),
(557, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-04-29'),
(558, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-04-30'),
(559, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-05-01'),
(560, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-05-02'),
(561, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-05-03'),
(562, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-05-04'),
(563, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-05-05'),
(564, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-05-06'),
(565, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-05-07'),
(566, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-05-08'),
(567, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-05-09'),
(568, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-05-10'),
(569, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-05-11'),
(570, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-05-12'),
(571, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-05-13'),
(572, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-05-14'),
(573, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-05-15'),
(574, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-05-16'),
(575, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-05-17'),
(576, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-05-18'),
(577, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-05-19'),
(578, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-05-20'),
(579, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-05-21'),
(580, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-05-22'),
(581, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-05-23'),
(582, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-05-24'),
(583, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-05-25'),
(584, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-05-26'),
(585, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-05-27'),
(586, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-05-28'),
(587, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-05-29'),
(588, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-05-30'),
(589, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-05-31'),
(590, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-06-01'),
(591, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-06-02'),
(592, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-06-03'),
(593, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-06-04'),
(594, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-06-05'),
(595, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-06-06'),
(596, '2024-03-18', '13:26:19', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-06-07'),
(597, '2024-03-18', '13:26:20', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-06-08'),
(598, '2024-03-18', '13:26:20', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-06-09'),
(599, '2024-03-18', '13:26:20', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-06-10'),
(600, '2024-03-18', '13:26:20', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-06-11'),
(601, '2024-03-18', '13:26:20', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-06-12'),
(602, '2024-03-18', '13:26:20', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-06-13'),
(603, '2024-03-18', '13:26:20', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-06-14'),
(604, '2024-03-18', '13:26:20', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-06-15'),
(605, '2024-03-18', '13:26:20', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-06-16'),
(606, '2024-03-18', '13:26:20', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-06-17'),
(607, '2024-03-18', '13:26:20', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-06-18'),
(608, '2024-03-18', '13:26:20', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-06-19'),
(609, '2024-03-18', '13:26:20', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-06-20'),
(610, '2024-03-18', '13:26:20', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-06-21'),
(611, '2024-03-18', '13:26:20', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-06-22'),
(612, '2024-03-18', '13:26:20', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-06-23'),
(613, '2024-03-18', '13:26:20', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-06-24'),
(614, '2024-03-18', '13:26:20', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-06-25'),
(615, '2024-03-18', '13:26:20', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-06-26'),
(616, '2024-03-18', '13:26:20', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-06-27'),
(617, '2024-03-18', '13:26:20', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-06-28'),
(618, '2024-03-18', '13:26:20', 'Angelo Cruz', 'Added new leave for employee id number 202325 date 2024-06-29'),
(619, '2024-04-24', '11:37:00', 'Angelo Cruz', 'Attendance downloaded attendance-from-Apr 01 2024-to-Apr 20 2024.csv date 2024-04-24');

-- --------------------------------------------------------

--
-- Table structure for table `cashadvance`
--

CREATE TABLE `cashadvance` (
  `id` int(11) NOT NULL,
  `date_advance` date NOT NULL,
  `employee_id` varchar(15) NOT NULL,
  `amount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `deductions`
--

CREATE TABLE `deductions` (
  `id` int(11) NOT NULL,
  `description` varchar(100) NOT NULL,
  `amount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
  `address` text NOT NULL,
  `birthdate` date NOT NULL,
  `contact_info` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `position_id` int(11) NOT NULL,
  `schedule_id` int(11) NOT NULL,
  `day_off` varchar(255) NOT NULL,
  `e_leave` double NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `created_on` date NOT NULL,
  `end_contract` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `employee_id`, `employee_rfid`, `firstname`, `lastname`, `address`, `birthdate`, `contact_info`, `gender`, `email`, `password`, `position_id`, `schedule_id`, `day_off`, `e_leave`, `created_by`, `photo`, `created_on`, `end_contract`) VALUES
(25, '202325', '0413180931', 'Angelo', 'Cruz', 'Quezon City', '2001-04-18', '099999999999', 'Male', 'angelo.cruz@tup.edu.ph', '$2y$10$4dQWPmgJ6/Im8YdA0rgm1.3wbrVSlmT8f2ltm/Y3yzumbkeSBmqIu', 1, 2, 'WED', 23, 'admin', 'twbbsis-15e80f31-bc4d-4eda-b812-508a96643c92.jpg', '2023-07-13', '2024-11-01'),
(26, '202326', '0411714435', 'Andrei Niko', 'Perez', 'Manila City', '2002-01-01', '099999999999', 'Male', '', '$2y$10$bGCLzHujg0Xh1EGv.nfkX.s/SrVFp7UOQZ7cvCIjhtcH9LsOZb0G.', 1, 2, 'SAT', 12, 'admin', 'Perez.png', '2023-07-13', '2024-07-13'),
(27, '202327', '0411306643', 'Cyrille Jaye', 'Hilario', 'Caloocan CityCaloocan CityCaloocan CityCaloocan City', '2002-01-01', '099999999999', 'Male', '', '$2y$10$zsmdlhQOIVNTGnKbgJA/8OKcWGqef.8jgNn6nKTrcvVG0EdBPURsm', 5, 2, 'SUN', 12, 'admin', 'Hilario.png', '2023-07-13', '2024-07-13'),
(28, '202328', '0411698371', 'Jared Ivan', 'Bruno', 'Navotas City', '2002-01-01', '099999999999', 'Male', '', '$2y$10$3xRO3QbfW6LHv1ZA2gopdeDzoIqNp/4lJeAfbtKouqqeAxhaa38.e', 1, 2, 'THU', 12, 'admin', 'Bruno.png', '2023-07-13', '2024-07-13'),
(30, '202330', '3988882163', 'Admin', 'Admin', '111', '2023-07-01', '099999999999', 'Male', '', '$2y$10$Wxx.dhbG1Z/6t1R4G11.4eguAmrLaQFxnliBrwq2XbXOq9jF/QyGm', 1, 2, 'FRI', 12, 'admin', 'HARMONY AND UNITY.jpg', '2023-07-14', '2024-07-14'),
(31, '202331', '0412382675', 'Jerard', 'Baria', '319 E-Ugbo Street Velasquez Tondo, Manila', '2002-01-01', '099999999999', 'Female', 'jerard.baria@tup.edu.ph', '$2y$10$Wxx.dhbG1Z/6t1R4G11.4eguAmrLaQFxnliBrwq2XbXOq9jF/QyGm', 6, 2, 'SAT', 12, 'admin', 'Baria.png', '2023-07-14', '2024-07-14'),
(38, '202438', '3988882163', '21', '21', '21', '2024-01-30', '12dasd', 'Male', '2121', '$2y$10$EVi1AOXvQgEcZTBQV60Wbuu7Oggd1PQ0N7vY5UUdAklllpGC.IOqS', 5, 2, 'WED', 12121, 'Angelo Cruz', '', '2024-01-30', '2024-01-22');

-- --------------------------------------------------------

--
-- Table structure for table `employee_bonus`
--

CREATE TABLE `employee_bonus` (
  `id` int(11) NOT NULL,
  `applied_on` date NOT NULL,
  `invoice_id` double NOT NULL,
  `employee_id` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `employee_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `description` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `amount` double NOT NULL,
  `bonus_status` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee_bonus`
--

INSERT INTO `employee_bonus` (`id`, `applied_on`, `invoice_id`, `employee_id`, `employee_name`, `description`, `amount`, `bonus_status`) VALUES
(1, '2023-10-11', 20234931627580, '0413180931', 'Angelo Cruz', 'Bonus', 1500, 'Pending'),
(2, '2023-10-11', 20235894327160, '0413180931', 'Angelo Cruz', 'Bonus', 15000, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `leave_record`
--

CREATE TABLE `leave_record` (
  `id` int(11) NOT NULL,
  `employee_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `employee_id` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `department` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `reason` longtext CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `datefrom` date NOT NULL,
  `dateto` date NOT NULL,
  `leave_status` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `leave_comment` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `applied_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leave_record`
--

INSERT INTO `leave_record` (`id`, `employee_name`, `employee_id`, `department`, `reason`, `datefrom`, `dateto`, `leave_status`, `leave_comment`, `applied_on`) VALUES
(21, 'Angelo Cruz', '202325', 'Programmer', 'sick', '2023-12-01', '2024-06-30', 'Approved', 'Approved by : Angelo Cruz Check Date : 2024-03-18', '2024-03-18');

-- --------------------------------------------------------

--
-- Table structure for table `loan`
--

CREATE TABLE `loan` (
  `id` int(11) NOT NULL,
  `employee_id` double NOT NULL,
  `employee_name` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `description` text NOT NULL,
  `loanamount` double NOT NULL,
  `monthstopay` double NOT NULL,
  `permonths` double NOT NULL,
  `semiloan` double NOT NULL,
  `semimonths` double NOT NULL,
  `loanpay` double NOT NULL,
  `loanbalance` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loan`
--

INSERT INTO `loan` (`id`, `employee_id`, `employee_name`, `description`, `loanamount`, `monthstopay`, `permonths`, `semiloan`, `semimonths`, `loanpay`, `loanbalance`) VALUES
(10, 202325, 'Angelo Cruz', 'Car Loan', 15000, 6, 2500, 3, 1250, 11250, 3750),
(11, 202325, 'Angelo Cruz', 'Bonus', 500, 1, 500, -1, 250, 750, -250),
(12, 202325, 'Angelo Cruz', 'cars', 10000, 5, 2000, 8, 1000, 2000, 8000);

-- --------------------------------------------------------

--
-- Table structure for table `main_inventory`
--

CREATE TABLE `main_inventory` (
  `id` int(255) NOT NULL,
  `product_number` int(255) NOT NULL,
  `photo` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `product_name` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `price` double NOT NULL,
  `qty` int(255) NOT NULL,
  `soldstock` int(255) NOT NULL,
  `balance` int(255) NOT NULL,
  `dateofstock` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `main_inventory`
--

INSERT INTO `main_inventory` (`id`, `product_number`, `photo`, `product_name`, `price`, `qty`, `soldstock`, `balance`, `dateofstock`) VALUES
(14, 2147483647, '', 'Café Gusto 3-in-1 Premium Taste Coffee Mix (Clasico) BOX', 1800, 500, 0, 500, '2024-03-07'),
(15, 2147483647, '', 'Café Gusto 3-in-1 Premium Taste Coffee Mix (Clasico) BOX', 1800, 10, 0, 10, '2024-03-07');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `employee_name` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `employee_id` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
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
  `loan_description` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `loan_amount` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `totalbenifitsdeduction` double NOT NULL,
  `totaleeer` double NOT NULL,
  `deduction_status` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `dpaidby` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `cashadvance` double NOT NULL,
  `totaldeduction` double NOT NULL,
  `gross` double NOT NULL,
  `netpay` double NOT NULL,
  `paystatus` varchar(11) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ppaidby` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `generateby` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `datefrom` date NOT NULL,
  `dateto` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(107, 20242317068549, 'Angelo Cruz', '202325', 100, 261, 120, 6.9833333333333, 380, 202.5, 630, 808.14, 808.14, 1616.28, 606.105, 606.105, 1212.21, ' ||Car Loan', ' ||1250', 1616.745, 3458.49, 'Pending', '', 0, 2866.745, 26938, 24071.255, 'Pending', '', 'Angelo Cruz', '2024-02-01', '2024-02-29'),
(108, 20245310478629, 'Angelo Cruz', '202325', 100, 135, 120, 0, 380, 202.5, 630, 405, 405, 810, 303.75, 303.75, 607.5, ' <br>Car Loan <br>cars', ' <br>1250 <br>1000', 911.25, 2047.5, 'Pending', '', 0, 1911.25, 13500, 11588.75, 'Pending', '', 'Angelo Cruz', '2024-03-01', '2024-03-15'),
(109, 20248346590172, 'Angelo Cruz', '202325', 100, 144, 120, 0, 380, 202.5, 630, 432, 432, 864, 324, 324, 648, ' <br>Car Loan <br>cars', ' <br>1250 <br>1000', 958.5, 2142, 'Pending', '', 0, 1958.5, 14400, 12441.5, 'Pending', '', 'Angelo Cruz', '2024-03-16', '2024-03-31');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sss`
--

INSERT INTO `sss` (`id`, `f`, `t`, `er`, `ee`, `total`) VALUES
(2, 4250, 4749.99, 427.5, 202.5, 630),
(3, 4750, 5249.99, 475, 225, 700),
(5, 1000, 4250, 380, 180, 560),
(8, 10000, 1000000000, 380, 202.5, 630);

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
-- Indexes for table `main_inventory`
--
ALTER TABLE `main_inventory`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=307;

--
-- AUTO_INCREMENT for table `audit_trail_record`
--
ALTER TABLE `audit_trail_record`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=620;

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
-- AUTO_INCREMENT for table `leave_record`
--
ALTER TABLE `leave_record`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `loan`
--
ALTER TABLE `loan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `main_inventory`
--
ALTER TABLE `main_inventory`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
