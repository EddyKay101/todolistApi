-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 24, 2019 at 02:11 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `todoApi`
--
CREATE DATABASE IF NOT EXISTS `todoApi` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `todoApi`;

-- --------------------------------------------------------

--
-- Table structure for table `todoItem`
--

CREATE TABLE `todoItem` (
  `id` int(11) NOT NULL,
  `description` text NOT NULL,
  `dueDate` datetime NOT NULL,
  `isCompleted` varchar(11) DEFAULT NULL,
  `listId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `todoList`
--

CREATE TABLE `todoList` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `todoItem`
--
ALTER TABLE `todoItem`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_list` (`listId`);

--
-- Indexes for table `todoList`
--
ALTER TABLE `todoList`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `todoItem`
--
ALTER TABLE `todoItem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `todoList`
--
ALTER TABLE `todoList`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `todoItem`
--
ALTER TABLE `todoItem`
  ADD CONSTRAINT `id_list` FOREIGN KEY (`listId`) REFERENCES `todoList` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
