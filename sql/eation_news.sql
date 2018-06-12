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
-- Table structure for table `eation_news`
--

CREATE TABLE `eation_news` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL DEFAULT '',
  `small_title` varchar(20) NOT NULL DEFAULT '',
  `catid` int(8) UNSIGNED NOT NULL DEFAULT '0',
  `image` varchar(255) NOT NULL DEFAULT '',
  `content` text NOT NULL,
  `description` varchar(200) NOT NULL,
  `is_position` tinyint(1) NOT NULL DEFAULT '0',
  `is_head_figure` tinyint(1) NOT NULL DEFAULT '0',
  `is_allowcomments` tinyint(1) NOT NULL DEFAULT '0',
  `listorder` int(8) NOT NULL,
  `source_type` int(1) NOT NULL DEFAULT '0',
  `create_time` int(10) NOT NULL DEFAULT '0',
  `update_time` int(10) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `read_count` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `upvote_count` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `comment_count` int(10) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `eation_news`
--
ALTER TABLE `eation_news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `title` (`title`),
  ADD KEY `create_time` (`create_time`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `eation_news`
--
ALTER TABLE `eation_news`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
