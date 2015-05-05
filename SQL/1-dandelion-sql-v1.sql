-- phpMyAdmin SQL Dump
-- version 4.2.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 14, 2015 at 10:23 AM
-- Server version: 5.6.19
-- PHP Version: 5.5.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dandelion`
--

-- --------------------------------------------------------

--
-- Table structure for table `invitation`
--

CREATE TABLE IF NOT EXISTS `invitation` (
`id` int(10) unsigned NOT NULL,
  `availabilityDetails` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `question` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=45 ;

-- --------------------------------------------------------

--
-- Table structure for table `msl`
--

CREATE TABLE IF NOT EXISTS `msl` (
`id` int(10) unsigned NOT NULL,
  `topic_id` int(10) unsigned DEFAULT NULL,
  `firstName` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `lastName` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `mslTerritory` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `therapeuticArea` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `msl`
--

INSERT INTO `msl` (`id`, `topic_id`, `firstName`, `lastName`, `gender`, `email`, `role`, `mslTerritory`, `therapeuticArea`) VALUES
(1, 1, 'Todd', 'McDougall', 'M', 'Todd.mcdougall@ucb.com', 'MSL', 'NSW, QLD', 'Immunology'),
(2, 1, 'Alfie', 'Lanzafame', 'M', 'Alfred.lanzafame@ucb.com', 'MSL', 'VIC, SA, WA, Tasmania', 'Immunology'),
(3, 2, 'Jeremy', 'Welton', 'M', 'Jeremy.Welton@ucb.com', 'MSL', 'VIC, SA, WA, Tasmania', 'CNS'),
(4, 2, 'Martijn', 'Kwaijtaal', 'M', 'Martijn.kwaijtaal@ucb.com', 'MSL', 'NSW, QLD', 'CNS');

-- --------------------------------------------------------

--
-- Table structure for table `topic`
--

CREATE TABLE IF NOT EXISTS `topic` (
`id` int(10) unsigned NOT NULL,
  `name` varchar(32) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `topic`
--

INSERT INTO `topic` (`id`, `name`) VALUES
(1, 'Immunology'),
(2, 'CNS');

-- --------------------------------------------------------

--
-- Table structure for table `topics_invitations`
--

CREATE TABLE IF NOT EXISTS `topics_invitations` (
  `topic_id` int(10) unsigned NOT NULL,
  `invitation_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `invitation`
--
ALTER TABLE `invitation`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `msl`
--
ALTER TABLE `msl`
 ADD PRIMARY KEY (`id`), ADD KEY `IDX_FF5886271F55203D` (`topic_id`);

--
-- Indexes for table `topic`
--
ALTER TABLE `topic`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `topics_invitations`
--
ALTER TABLE `topics_invitations`
 ADD PRIMARY KEY (`invitation_id`,`topic_id`), ADD KEY `IDX_A5BD7CA1F55203D` (`topic_id`), ADD KEY `IDX_A5BD7CAA35D7AF0` (`invitation_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `invitation`
--
ALTER TABLE `invitation`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT for table `msl`
--
ALTER TABLE `msl`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `topic`
--
ALTER TABLE `topic`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `msl`
--
ALTER TABLE `msl`
ADD CONSTRAINT `FK_FF5886271F55203D` FOREIGN KEY (`topic_id`) REFERENCES `topic` (`id`);

--
-- Constraints for table `topics_invitations`
--
ALTER TABLE `topics_invitations`
ADD CONSTRAINT `FK_A5BD7CA1F55203D` FOREIGN KEY (`topic_id`) REFERENCES `topic` (`id`) ON DELETE CASCADE,
ADD CONSTRAINT `FK_A5BD7CAA35D7AF0` FOREIGN KEY (`invitation_id`) REFERENCES `invitation` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
