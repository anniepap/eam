-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Φιλοξενητής: 127.0.0.1
-- Χρόνος δημιουργίας: 13 Ιαν 2017 στις 20:32:12
-- Έκδοση διακομιστή: 10.1.19-MariaDB
-- Έκδοση PHP: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Βάση δεδομένων: `euromeddb`
--

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `authors`
--

CREATE TABLE `authors` (
  `Name` varchar(45) NOT NULL,
  `Email` varchar(45) NOT NULL,
  `Affiliation` varchar(45) NOT NULL,
  `papers.PaperID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `daily`
--

CREATE TABLE `daily` (
  `PurchaseID` int(11) NOT NULL,
  `PurchaseDate` date NOT NULL,
  `PaymentWay` varchar(45) NOT NULL,
  `Days` varchar(45) NOT NULL,
  `Addons` varchar(45) NOT NULL,
  `Students` int(11) DEFAULT NULL,
  `NonStudents` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `entire`
--

CREATE TABLE `entire` (
  `PurchaseID` int(11) NOT NULL,
  `PurchaseDate` date NOT NULL,
  `PaymentWay` varchar(45) NOT NULL,
  `Addons` varchar(45) NOT NULL,
  `Students` int(11) DEFAULT NULL,
  `NonStudents` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `exhibitors`
--

CREATE TABLE `exhibitors` (
  `Users.Username` varchar(45) NOT NULL,
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
-- Δομή πίνακα για τον πίνακα `papers`
--

CREATE TABLE `papers` (
  `PaperID` int(11) NOT NULL,
  `users.Username` varchar(45) NOT NULL,
  `Topic` varchar(45) NOT NULL,
  `Type` varchar(45) NOT NULL,
  `Abstract` varchar(500) NOT NULL,
  `Keywords` varchar(100) NOT NULL,
  `File` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `participants`
--

CREATE TABLE `participants` (
  `Users.Username` varchar(45) NOT NULL,
  `Total` int(11) NOT NULL,
  `Daily.PurchaseID` int(11) NOT NULL,
  `Entire.PurchaseID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `users`
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
-- Άδειασμα δεδομένων του πίνακα `users`
--

INSERT INTO `users` (`Username`, `Password`, `Email`, `DateOfBirth`, `FirstName`, `LastName`, `Affiliation`, `Country`, `Photo`) VALUES
('a', 'a', 'a', '2000-08-09', 'a', 'a', 'a', 'a', NULL),
('annie', '123', 'email', '1999-10-01', 'anna', 'an', 'perfection', 'malibu', NULL),
('JaneDoe', 'a', 'jd@mail.com', '1995-09-15', 'Jane', 'Doe', 'example', 'Gr', NULL),
('JohnDoe', 'password', 'johndoe@example.com', '1990-01-01', 'John', 'Doe', 'example', 'USA', NULL);

--
-- Ευρετήρια για άχρηστους πίνακες
--

--
-- Ευρετήρια για πίνακα `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`Email`);

--
-- Ευρετήρια για πίνακα `daily`
--
ALTER TABLE `daily`
  ADD PRIMARY KEY (`PurchaseID`);

--
-- Ευρετήρια για πίνακα `entire`
--
ALTER TABLE `entire`
  ADD PRIMARY KEY (`PurchaseID`);

--
-- Ευρετήρια για πίνακα `exhibitors`
--
ALTER TABLE `exhibitors`
  ADD PRIMARY KEY (`Users.Username`);

--
-- Ευρετήρια για πίνακα `papers`
--
ALTER TABLE `papers`
  ADD PRIMARY KEY (`PaperID`);

--
-- Ευρετήρια για πίνακα `participants`
--
ALTER TABLE `participants`
  ADD PRIMARY KEY (`Users.Username`);

--
-- Ευρετήρια για πίνακα `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Username`);

--
-- Περιορισμοί για άχρηστους πίνακες
--

--
-- Περιορισμοί για πίνακα `exhibitors`
--
ALTER TABLE `exhibitors`
  ADD CONSTRAINT `exhibitors_ibfk_1` FOREIGN KEY (`Users.Username`) REFERENCES `users` (`Username`);

--
-- Περιορισμοί για πίνακα `participants`
--
ALTER TABLE `participants`
  ADD CONSTRAINT `participants_ibfk_1` FOREIGN KEY (`Users.Username`) REFERENCES `users` (`Username`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
