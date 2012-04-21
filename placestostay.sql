-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 21, 2012 at 09:41 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `placestostay`
--

-- --------------------------------------------------------

--
-- Table structure for table `accommodation`
--

CREATE TABLE IF NOT EXISTS `accommodation` (
  `ID` int(7) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `availability` int(5) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `accommodation`
--

INSERT INTO `accommodation` (`ID`, `name`, `type`, `location`, `latitude`, `longitude`, `availability`) VALUES
(1, 'The Hotel', 'Hotel', 'Southampton', 50.913532, -1.424789, 35),
(2, 'Premium Hotels', 'Hotel', 'Southampton', 50.923056, -1.384106, 20),
(3, 'The B''n''B', 'BandB', 'West End', 50.897295, -1.397324, 4),
(4, 'The BandB', 'BandB', 'Southampton', 50.897836, -1.3908, 5),
(5, 'Denver Hotel', 'Hotel', 'Denver', 39.762631, -105.03479, 45),
(6, 'Denver Hostel', 'Hostel', 'Denver', 39.743098, -104.94175, 13),
(7, 'City Park Hotel', 'Hotel', 'Denver', 39.691073, -104.979858, 56),
(10, 'Premier Inn', 'Hotel', 'Southampton', 50.902654, -1.395006, 100),
(11, 'Grand Harbour Hotel', 'Hotel', 'Southampton', 50.899893, -1.407709, 35),
(12, 'Jurys Inn', 'Hotel', 'Southampton', 50.910664, -1.401358, 120),
(15, 'The Red Lion', 'Inn', 'Southampton', 50.912558, -1.394319, 20),
(16, 'Green Inn', 'Inn', 'Southampton', 50.905739, -1.40419, 8),
(18, 'Cottage House', 'BandB', 'Southampton', 50.911977, -1.394641, 3);

-- --------------------------------------------------------

--
-- Table structure for table `acc_reviews`
--

CREATE TABLE IF NOT EXISTS `acc_reviews` (
  `ID` int(7) NOT NULL AUTO_INCREMENT,
  `accid` int(7) NOT NULL,
  `review` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `acc_reviews`
--

INSERT INTO `acc_reviews` (`ID`, `accid`, `review`) VALUES
(2, 1, 'very nice, quality service'),
(3, 2, 'pricey but excellent experience'),
(4, 2, 'great service'),
(19, 3, 'Lovely BnB, polite hosts and great service.');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE IF NOT EXISTS `bookings` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `accid` int(5) NOT NULL,
  `startdate` date NOT NULL,
  `enddate` date NOT NULL,
  `room` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `accid`, `startdate`, `enddate`, `room`) VALUES
(2, 1, '2012-02-01', '2012-02-14', '12'),
(4, 2, '2012-02-08', '2012-02-23', '45'),
(13, 1, '2012-04-08', '2012-04-20', '2'),
(29, 1, '2012-04-02', '2012-04-10', '2');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
