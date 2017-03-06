-- phpMyAdmin SQL Dump
-- version 4.6.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 06, 2017 at 10:07 AM
-- Server version: 5.6.33-0ubuntu0.14.04.1
-- PHP Version: 5.6.30-5+deb.sury.org~xenial+2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `related_search`
--

-- --------------------------------------------------------

--
-- Table structure for table `related_search`
--

CREATE TABLE `related_search` (
  `id` int(10) UNSIGNED NOT NULL,
  `searched_keyword` varchar(128) NOT NULL,
  `related1` varchar(128) NOT NULL,
  `related2` varchar(128) NOT NULL,
  `related3` varchar(128) NOT NULL,
  `related4` varchar(128) NOT NULL,
  `related5` varchar(128) NOT NULL,
  `related6` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `related_search`
--
ALTER TABLE `related_search`
  ADD UNIQUE KEY `searched_keyword` (`searched_keyword`),
  ADD UNIQUE KEY `id` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
