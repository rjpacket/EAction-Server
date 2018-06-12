-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 12, 2018 at 01:04 AM
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
-- Table structure for table `eation_version`
--

CREATE TABLE `eation_version` (
  `id` int(10) UNSIGNED NOT NULL,
  `app_type` varchar(20) NOT NULL DEFAULT '',
  `version` int(8) UNSIGNED NOT NULL DEFAULT '0',
  `version_code` varchar(20) NOT NULL DEFAULT '',
  `is_force` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `apk_url` varchar(255) NOT NULL DEFAULT '',
  `upgrade_point` varchar(500) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `create_time` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `update_time` int(10) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `eation_version`
--

INSERT INTO `eation_version` (`id`, `app_type`, `version`, `version_code`, `is_force`, `apk_url`, `upgrade_point`, `status`, `create_time`, `update_time`) VALUES
(1, 'android', 2, '1.0.2', 0, 'http://www.baidu.com', '1.更新了很多bug', 1, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `eation_version`
--
ALTER TABLE `eation_version`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `eation_version`
--
ALTER TABLE `eation_version`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
