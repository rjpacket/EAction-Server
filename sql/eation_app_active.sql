-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 12, 2018 at 03:10 PM
-- Server version: 5.6.34-log
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eaction`
--

-- --------------------------------------------------------

--
-- Table structure for table `eation_app_active`
--

CREATE TABLE `eation_app_active` (
  `id` int(10) UNSIGNED NOT NULL,
  `version` int(8) UNSIGNED NOT NULL DEFAULT '0',
  `app_type` varchar(20) NOT NULL DEFAULT '',
  `version_code` varchar(20) NOT NULL DEFAULT '',
  `device_id` varchar(100) NOT NULL DEFAULT '',
  `create_time` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `update_time` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `model` varchar(20) NOT NULL DEFAULT '',
  `imei` varchar(50) NOT NULL DEFAULT '',
  `application_id` varchar(50) NOT NULL DEFAULT '',
  `mac_address` varchar(50) NOT NULL DEFAULT '',
  `channel` varchar(50) NOT NULL DEFAULT '',
  `brand` varchar(30) NOT NULL DEFAULT '',
  `time_stamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `osversion` varchar(50) NOT NULL DEFAULT '',
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `eation_app_active`
--

INSERT INTO `eation_app_active` (`id`, `version`, `app_type`, `version_code`, `device_id`, `create_time`, `update_time`, `model`, `imei`, `application_id`, `mac_address`, `channel`, `brand`, `time_stamp`, `osversion`, `user_id`) VALUES
(1, 1, 'android', '1.0.2', '123', 1528388214, 1528388214, 'HUAWEI-P20', '', '', '', '', '', 0, '', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `eation_app_active`
--
ALTER TABLE `eation_app_active`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `eation_app_active`
--
ALTER TABLE `eation_app_active`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
