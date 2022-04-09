-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2022 at 05:50 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel-portfolio-website`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2022_03_26_055017_visitor_table', 1),
(2, '2022_03_26_101817_service_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_des` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`id`, `service_name`, `service_des`, `service_img`) VALUES
(29, 'Mk', 'Soikot', 'bhuiyan'),
(37, 'Mk111', 'Soikot', 'bhuiyan'),
(41, 'Mk', 'Soikot', 'bhuiyan');

-- --------------------------------------------------------

--
-- Table structure for table `visitor`
--

CREATE TABLE `visitor` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ip_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `visit_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `visitor`
--

INSERT INTO `visitor` (`id`, `ip_address`, `visit_name`) VALUES
(1, '127.0.0.1', '2022-03-26 02:57:23pm'),
(2, '127.0.0.1', '2022-03-26 02:58:15pm'),
(3, '127.0.0.1', '2022-03-26 02:58:17pm'),
(4, '127.0.0.1', '2022-03-26 03:43:31pm'),
(5, '127.0.0.1', '2022-03-26 03:43:33pm'),
(6, '127.0.0.1', '2022-03-26 03:50:08pm'),
(7, '127.0.0.1', '2022-03-26 03:50:10pm'),
(8, '127.0.0.1', '2022-03-26 03:50:12pm'),
(9, '127.0.0.1', '2022-03-26 03:50:13pm'),
(10, '127.0.0.1', '2022-03-26 03:50:14pm'),
(11, '127.0.0.1', '2022-03-26 03:50:16pm'),
(12, '127.0.0.1', '2022-03-26 03:50:17pm'),
(13, '127.0.0.1', '2022-03-26 03:50:19pm'),
(14, '127.0.0.1', '2022-03-26 03:50:20pm'),
(15, '127.0.0.1', '2022-03-26 03:50:22pm'),
(16, '127.0.0.1', '2022-03-26 04:00:25pm'),
(17, '127.0.0.1', '2022-03-26 04:00:56pm'),
(18, '127.0.0.1', '2022-03-26 04:01:29pm'),
(19, '127.0.0.1', '2022-03-26 04:05:47pm'),
(20, '127.0.0.1', '2022-03-26 04:08:01pm'),
(21, '127.0.0.1', '2022-03-26 04:09:25pm'),
(22, '127.0.0.1', '2022-03-26 04:10:21pm'),
(23, '127.0.0.1', '2022-03-26 04:39:23pm'),
(24, '127.0.0.1', '2022-03-26 04:44:29pm'),
(25, '127.0.0.1', '2022-03-26 04:46:05pm'),
(26, '127.0.0.1', '2022-03-26 04:46:36pm'),
(27, '127.0.0.1', '2022-03-26 04:46:49pm'),
(28, '127.0.0.1', '2022-03-26 04:47:31pm'),
(29, '127.0.0.1', '2022-03-26 04:49:07pm'),
(30, '127.0.0.1', '2022-03-26 04:51:02pm'),
(31, '127.0.0.1', '2022-03-26 04:51:19pm'),
(32, '127.0.0.1', '2022-03-26 04:56:44pm'),
(33, '127.0.0.1', '2022-03-26 04:56:50pm'),
(34, '127.0.0.1', '2022-03-27 12:11:25pm'),
(35, '127.0.0.1', '2022-03-27 12:11:25pm'),
(36, '127.0.0.1', '2022-04-02 10:33:49am'),
(37, '127.0.0.1', '2022-04-02 04:15:00pm'),
(38, '127.0.0.1', '2022-04-03 09:36:55am'),
(39, '127.0.0.1', '2022-04-03 09:37:21am'),
(40, '127.0.0.1', '2022-04-03 09:37:27am'),
(41, '127.0.0.1', '2022-04-03 12:02:25pm'),
(42, '127.0.0.1', '2022-04-04 09:35:12am'),
(43, '127.0.0.1', '2022-04-05 09:55:50am'),
(44, '127.0.0.1', '2022-04-05 09:55:53am'),
(45, '127.0.0.1', '2022-04-06 09:22:09am'),
(46, '127.0.0.1', '2022-04-06 09:22:09am');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visitor`
--
ALTER TABLE `visitor`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `visitor`
--
ALTER TABLE `visitor`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
