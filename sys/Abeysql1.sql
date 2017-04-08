-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 03, 2015 at 08:28 PM
-- Server version: 5.5.44-0+deb7u1
-- PHP Version: 5.6.11-1~dotdeb+7.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Abeysql1`
--

-- --------------------------------------------------------

--
-- Table structure for table `Categories`
--

CREATE TABLE IF NOT EXISTS `Categories` (
  `id` bigint(20) NOT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Categories`
--

INSERT INTO `Categories` (`id`, `name`) VALUES
(1, 'Autos'),
(2, 'Busse'),
(3, 'Trecker'),
(4, 'Software'),
(5, 'Schüler'),
(6, 'Websites'),
(7, 'Zeugs'),
(8, 'Kabels'),
(9, 'Ideen');

-- --------------------------------------------------------

--
-- Table structure for table `Products`
--

CREATE TABLE IF NOT EXISTS `Products` (
  `id` bigint(20) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `cat_id` bigint(20) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `description` text,
  `price` float DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Products`
--

INSERT INTO `Products` (`id`, `name`, `cat_id`, `user_id`, `description`, `price`) VALUES
(1, 'Super tolle Website !!!!TOLL', 6, 1, 'Eine super tolle Website, mit allem.\r\nKann auch Bilder anzeigen und einen Namen.', 10),
(2, 'Ein geiles Elektro Auto', 1, 8, 'Diees Auto wird mit Strom betrieben, und kann fahren', 3900),
(3, 'Ein Traktor', 3, 10, 'Dies is ein ganz geiler Trecker', 600),
(4, 'Windofs', 4, 7, 'Das beste Windofs aller Zeiten, jetzt mit nocht mehr Bluescreens.', 175),
(5, 'Adminrechte', 7, 4, 'Kaufen sie jetzt Adminrechte für localhost.', 50),
(6, 'W-Lan Kabel', 8, 2, 'Wolle kaufen W-Lan Kabel ?', 20),
(7, 'Gelände Wagen', 1, 1, 'Ein Gelände Wagen denn sie immer und überall wieder finden.', 3700),
(8, 'Max Mustermann', 5, 3, 'Ein sehr guter Schüler.', 6),
(9, 'Homepage Bauer', 6, 6, 'Der beste Website Baukasten den man je gesehen hat.', 260),
(10, 'Kekse', 7, 11, '10 Kekse in angebrochener Verpackung', 50),
(11, 'Schlechte Ideen', 9, 12, 'Die schlechtesten Ideen die jemals jemand hatte.', 8.5),
(13, 'Gute Idee', 9, 12, 'Eine super Idee die noch nie jemand hatte.', 800),
(14, 'Luxus-Bus', 2, 9, 'Dieser Bus kann fahren, und es sind auch noch viel zu wenige Plätze da.', 999999),
(15, 'Brandneuer Bus', 2, 9, 'Dieser nagelneue Bus wird ihnen sofort in Einzelteilen geliefert.', 13000),
(16, 'Bus', 2, 9, 'Ein Bus', 1600),
(17, 'Kabel aller Art', 8, 2, 'Alle Kabel die sie brauchen.', 20),
(18, 'Maximillian Mustermann', 5, 3, 'Ein Schüler der immer da ist', 10);

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE IF NOT EXISTS `Users` (
  `id` bigint(20) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `pass` varchar(32) NOT NULL,
  `mail` varchar(32) NOT NULL,
  `isAdmin` int(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`id`, `name`, `pass`, `mail`, `isAdmin`) VALUES
(1, 'User', '81dc9bdb52d04dc20036dbd8313ed055', 'spam@joethei.de', 0),
(2, 'Admin', '81dc9bdb52d04dc20036dbd8313ed055', 'spam@alexander-regier.de', 1),

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Categories`
--
ALTER TABLE `Categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Products`
--
ALTER TABLE `Products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Categories`
--
ALTER TABLE `Categories`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `Products`
--
ALTER TABLE `Products`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
