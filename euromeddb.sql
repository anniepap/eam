-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 15, 2017 at 03:29 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `euromeddb`
--

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `Name` varchar(45) NOT NULL,
  `Email` varchar(45) NOT NULL,
  `Affiliation` varchar(45) NOT NULL,
  `PaperID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `buy`
--

CREATE TABLE `buy` (
  `BuyID` int(11) NOT NULL,
  `Username` varchar(45) COLLATE utf8_bin NOT NULL,
  `PurchaseDate` date NOT NULL,
  `EntireAddons` varchar(45) COLLATE utf8_bin NOT NULL,
  `EntireParticipants` varchar(45) COLLATE utf8_bin NOT NULL,
  `DailyDays` varchar(45) COLLATE utf8_bin NOT NULL,
  `DailyAddons` varchar(45) COLLATE utf8_bin NOT NULL,
  `DailyParticipants` varchar(45) COLLATE utf8_bin NOT NULL,
  `Total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `buy`
--

INSERT INTO `buy` (`BuyID`, `Username`, `PurchaseDate`, `EntireAddons`, `EntireParticipants`, `DailyDays`, `DailyAddons`, `DailyParticipants`, `Total`) VALUES
(1, 'a', '2017-01-15', '0-0', '3-0', '11001000000', '7-6-0', '7-0', 7300),
(2, 'a', '2017-01-15', '0-3', '4-0', '11110000000', '0-0-0', '3-0', 5145);

-- --------------------------------------------------------

--
-- Table structure for table `exhibitors`
--

CREATE TABLE `exhibitors` (
  `Username` varchar(45) NOT NULL,
  `RepFirstName` varchar(45) NOT NULL,
  `RepLastName` varchar(45) NOT NULL,
  `Phone` int(11) NOT NULL,
  `Email` varchar(45) NOT NULL,
  `TRN` int(11) NOT NULL,
  `Booth` varchar(45) NOT NULL,
  `DateFrom` date NOT NULL,
  `DateTo` date NOT NULL,
  `PaymentWay` varchar(45) NOT NULL,
  `PurchaseDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `papers`
--

CREATE TABLE `papers` (
  `PaperID` int(11) NOT NULL,
  `Username` varchar(45) NOT NULL,
  `Topic` varchar(45) NOT NULL,
  `Type` varchar(45) NOT NULL,
  `Abstract` varchar(500) NOT NULL,
  `Keywords` varchar(100) NOT NULL,
  `File` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Username` varchar(45) NOT NULL,
  `Password` varchar(45) NOT NULL,
  `Email` varchar(45) NOT NULL,
  `DateOfBirth` date NOT NULL,
  `FirstName` varchar(45) NOT NULL,
  `LastName` varchar(45) NOT NULL,
  `Affiliation` varchar(45) NOT NULL,
  `Country` varchar(45) NOT NULL,
  `Photo` longblob
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Username`, `Password`, `Email`, `DateOfBirth`, `FirstName`, `LastName`, `Affiliation`, `Country`, `Photo`) VALUES
('a', 'a', 'a', '2000-08-09', 'a', 'a', 'a', 'a', NULL),
('annie', '123', 'email', '1999-10-01', 'anna', 'an', 'perfection', 'malibu', NULL),
('JaneDoe', 'a', 'jd@mail.com', '1995-09-15', 'Jane', 'Doe', 'example', 'Gr', NULL),
('JohnDoe', 'password', 'johndoe@example.com', '1990-01-01', 'John', 'Doe', 'example', 'USA', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`Email`);

--
-- Indexes for table `buy`
--
ALTER TABLE `buy`
  ADD PRIMARY KEY (`BuyID`);

--
-- Indexes for table `exhibitors`
--
ALTER TABLE `exhibitors`
  ADD PRIMARY KEY (`Username`);

--
-- Indexes for table `papers`
--
ALTER TABLE `papers`
  ADD PRIMARY KEY (`PaperID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Username`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `exhibitors`
--
ALTER TABLE `exhibitors`
  ADD CONSTRAINT `exhibitors_ibfk_1` FOREIGN KEY (`Username`) REFERENCES `users` (`Username`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
