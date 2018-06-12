-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 12, 2018 at 01:03 AM
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
-- Table structure for table `eation_user`
--

CREATE TABLE `eation_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(20) NOT NULL DEFAULT '',
  `password` char(32) NOT NULL DEFAULT '',
  `phone` varchar(11) NOT NULL DEFAULT '',
  `token` varchar(100) NOT NULL DEFAULT '',
  `time_out` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `image` varchar(200) NOT NULL DEFAULT '',
  `sex` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `signature` varchar(200) NOT NULL DEFAULT '',
  `create_time` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `update_time` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `eation_user`
--

INSERT INTO `eation_user` (`id`, `username`, `password`, `phone`, `token`, `time_out`, `image`, `sex`, `signature`, `create_time`, `update_time`, `status`) VALUES
(1, 'eaction13552280894', '', '13552280894', 'b23dde01304e57f3d1cffdf396d14f87b791fec9', 1529247024, 'http://p3i8l7u14.bkt.clouddn.com/2018/02/80143201802040046427686.png', 0, '', 1528634164, 1528645980, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `eation_user`
--
ALTER TABLE `eation_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `phone` (`phone`),
  ADD KEY `token` (`token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `eation_user`
--
ALTER TABLE `eation_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
