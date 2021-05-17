-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 17, 2021 at 04:15 PM
-- Server version: 5.7.29-log
-- PHP Version: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `magebit_task`
--

-- --------------------------------------------------------

--
-- Table structure for table `email_domains`
--

CREATE TABLE `email_domains` (
  `id` int(11) NOT NULL,
  `domain_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `email_domains`
--

INSERT INTO `email_domains` (`id`, `domain_name`) VALUES
(2, 'gmail.com'),
(5, 'inbox.lv'),
(6, 'hotmail.com'),
(7, 'yahoo.com'),
(8, 'bigpond.com'),
(9, 'mail.ru');

-- --------------------------------------------------------

--
-- Table structure for table `email_list`
--

CREATE TABLE `email_list` (
  `id` int(11) NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `pubdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `domain_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `email_list`
--

INSERT INTO `email_list` (`id`, `email`, `pubdate`, `domain_id`) VALUES
(2, 'markskalijevs@gmail.com', '2021-05-14 14:41:17', 2),
(8, 'roberts_berzinsh@inbox.lv', '2021-05-14 15:54:30', 5),
(9, 'ded@gmail.com', '2021-05-16 21:09:06', 2),
(10, 'aleks.lodzinsh@hotmail.com', '2021-05-17 07:14:44', 6),
(11, 'jonathan.smith@yahoo.com', '2021-05-17 07:24:54', 7),
(27, 'john.smith@yahoo.com', '2021-05-17 11:02:42', 7),
(28, 'evan.mceran@bigpond.com', '2021-05-17 11:04:25', 8),
(29, 'andrew.bold@mail.ru', '2021-05-17 11:04:44', 9),
(30, 'andrejs-vicutevs@inbox.lv', '2021-05-17 11:19:58', 5),
(31, 'paul-mccartney@bigpond.com', '2021-05-17 11:21:24', 8),
(32, 'ericgoldenpan@hotmail.com', '2021-05-17 11:21:55', 6),
(33, 'ivan_zaborkin@mail.ru', '2021-05-17 11:22:09', 9);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `email_domains`
--
ALTER TABLE `email_domains`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_list`
--
ALTER TABLE `email_list`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `email_domains`
--
ALTER TABLE `email_domains`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `email_list`
--
ALTER TABLE `email_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
