-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2019 at 01:16 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `socialnetwork`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `authorId` int(11) NOT NULL,
  `state` enum('public','private','self','') CHARACTER SET utf8 NOT NULL,
  `caption` varchar(30) CHARACTER SET utf8 NOT NULL,
  `image` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `time` timestamp(4) NOT NULL DEFAULT CURRENT_TIMESTAMP(4)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `authorId`, `state`, `caption`, `image`, `time`) VALUES
(2, 36, 'public', 'lmao', '', '2019-05-20 21:16:20.6670'),
(4, 36, 'public', 'sdsdsds', '', '2019-05-20 21:17:06.3471'),
(6, 36, 'self', 'private', '', '2019-05-20 21:18:38.3534'),
(7, 36, 'private', 'xd', '', '2019-05-20 21:18:56.1783'),
(8, 36, 'self', 'test', '', '2019-05-20 22:50:03.2986'),
(10, 12, 'private', 'Friends\r\n', '', '2019-05-20 23:01:16.2348'),
(11, 12, 'self', 'Only me', '', '2019-05-20 23:01:24.2820');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `authorId` (`authorId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`authorId`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
