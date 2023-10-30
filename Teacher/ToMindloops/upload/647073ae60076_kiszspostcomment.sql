-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2023 at 08:06 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_mindloop`
--

-- --------------------------------------------------------

--
-- Table structure for table `kiszspostcomment`
--

CREATE TABLE `kiszspostcomment` (
  `comment_id` int(11) NOT NULL,
  `kidzpost_id` int(11) DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `attachment` varchar(255) NOT NULL,
  `created_by` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `approved` tinyint(1) DEFAULT 0,
  `likes` int(11) DEFAULT NULL,
  `dislikes` int(11) DEFAULT NULL,
  `liked_by` text NOT NULL,
  `disliked_by` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kiszspostcomment`
--
ALTER TABLE `kiszspostcomment`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `kidzpost_id` (`kidzpost_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kiszspostcomment`
--
ALTER TABLE `kiszspostcomment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kiszspostcomment`
--
ALTER TABLE `kiszspostcomment`
  ADD CONSTRAINT `kiszspostcomment_ibfk_1` FOREIGN KEY (`kidzpost_id`) REFERENCES `kidzpost` (`kidzpost_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
