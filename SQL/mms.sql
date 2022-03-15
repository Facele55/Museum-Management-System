-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 13, 2020 at 01:07 PM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `a_name` varchar(250) NOT NULL,
  `a_pass` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `a_name`, `a_pass`) VALUES
(3, 'admin', '$2y$10$Ck8Vcho8eDVR8EB0qm53Se4Ut8tQZg679Ij/1Wf/U6uKYgCF8ikMC');

-- --------------------------------------------------------

--
-- Table structure for table `district`
--

CREATE TABLE `district` (
  `D_ID` int(11) NOT NULL,
  `D_Name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `district`
--

INSERT INTO `district` (`D_ID`, `D_Name`) VALUES
(2, 'Mokotów'),
(4, 'Praga Poludnie'),
(3, 'Praga Północ'),
(1, 'Śródmieście');

-- --------------------------------------------------------

--
-- Table structure for table `museum`
--

CREATE TABLE `museum` (
  `id` int(11) NOT NULL,
  `M_Name` varchar(250) NOT NULL,
  `City` varchar(250) NOT NULL,
  `Address` varchar(250) NOT NULL,
  `Type` varchar(100) NOT NULL,
  `District` varchar(100) NOT NULL,
  `Site` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `museum`
--

INSERT INTO `museum` (`id`, `M_Name`, `City`, `Address`, `Type`, `District`, `Site`) VALUES
(2, 'The Polish Vodka Museums', 'Warszawa (Warsaw)', 'Plac Konesera 1, 03-736', 'Historical', 'Mokotów', 'https://muzeumpolskiejwodki.pl/en/'),
(16, 'Royal Łazienki Museum', 'Warsaw', 'ul. Agrykola 1', 'Open-Air', 'Śródmieście', 'www.lazienki-krolewskie.pl'),
(27, 'National Museum in Warsaw', 'Warsaw', 'Al. Jerozolimskie 3', 'National', 'Praga Poludnie', 'www.mnw.art.pl'),
(30, 'Name of museum', 'Warszawa (Warsaw)', 'kjhg6f', 'Historical', 'Mokotów', 'http://sd.com');

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `T_ID` int(11) NOT NULL,
  `T_Name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`T_ID`, `T_Name`) VALUES
(4, 'Archaeology'),
(5, 'Art'),
(6, 'Historic house'),
(1, 'Historical'),
(7, 'Living history'),
(8, 'Military and war'),
(3, 'National'),
(9, 'Natural history'),
(2, 'Open-Air'),
(10, 'Science');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `district`
--
ALTER TABLE `district`
  ADD PRIMARY KEY (`D_Name`);

--
-- Indexes for table `museum`
--
ALTER TABLE `museum`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Type` (`Type`),
  ADD KEY `District` (`District`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`T_Name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `museum`
--
ALTER TABLE `museum`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `museum`
--
ALTER TABLE `museum`
  ADD CONSTRAINT `museum_ibfk_1` FOREIGN KEY (`Type`) REFERENCES `type` (`T_Name`),
  ADD CONSTRAINT `museum_ibfk_2` FOREIGN KEY (`District`) REFERENCES `district` (`D_Name`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
