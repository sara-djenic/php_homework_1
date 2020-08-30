-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 10, 2020 at 06:59 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `raf_cloud`
--

-- --------------------------------------------------------

--
-- Table structure for table `machines`
--

CREATE TABLE `machines` (
  `id` int(11) NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` enum('STOPPED','RUNNING') NOT NULL,
  `createdAt` date NOT NULL DEFAULT current_timestamp(),
  `active` tinyint(1) NOT NULL,
  `ram` int(255) NOT NULL,
  `max_fee` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `machines`
--

INSERT INTO `machines` (`id`, `uuid`, `name`, `status`, `createdAt`, `active`, `ram`, `max_fee`) VALUES
(10, '5bd537fc3789b5482e4936968f0fde95', 'sara', 'STOPPED', '2020-04-09', 1, 33, 0),
(15, 'b201272a7344411b1dd09d7b8a3f25b3', 'misa', 'RUNNING', '2020-04-10', 1, 55, 0),
(21, '47bce5c74f589f4867dbd57e9ca9f808', 'aaa', 'STOPPED', '2020-04-10', 1, 33, 0),
(26, '7e4ef92d1472fa1a2d41b2d3c1d2b77a', 'tralala', 'STOPPED', '2020-04-10', 1, 40, 0),
(29, '2badfdbed5f2d2b6acae7475def96459', 'masina1', 'STOPPED', '2020-04-10', 1, 60, 0),
(31, 'aaf35c7be8a16d1dea99d491debd6424', 'masina2', 'STOPPED', '2020-04-10', 1, 40, 0),
(35, '312be9afd7aa04508a66db7415f242f1', 'masina3', 'STOPPED', '2020-04-10', 1, 32, 0),
(37, '1a9c91f6e0310d4f55b7ee7f22c2c9df', 'nova', 'RUNNING', '2020-04-10', 1, 16, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` bigint(20) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstName` varchar(100) DEFAULT NULL,
  `lastName` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `firstName`, `lastName`) VALUES
(1, 'pajapatak@gmail.com', '773f02020a180d50469425958e621e99', NULL, NULL),
(8, 'mikimaus@gmail.com', '08b70cac46663feb2ce1251b9ff25518', NULL, NULL),
(10, 'sara@gmail.com', '5bd537fc3789b5482e4936968f0fde95', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `machines`
--
ALTER TABLE `machines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `machines`
--
ALTER TABLE `machines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
