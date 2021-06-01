-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2021 at 09:29 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `fajl`
--

CREATE TABLE `fajl` (
  `id` int(11) NOT NULL,
  `naziv` varchar(255) NOT NULL,
  `lokacija` varchar(255) NOT NULL,
  `tip_fajla` varchar(50) NOT NULL,
  `sifra_kursa` char(6) NOT NULL,
  `id_sekcije` int(11) NOT NULL,
  `redni_broj` int(11) NOT NULL,
  `vidljivost` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fajl`
--

INSERT INTO `fajl` (`id`, `naziv`, `lokacija`, `tip_fajla`, `sifra_kursa`, `id_sekcije`, `redni_broj`, `vidljivost`) VALUES
(32, 'mn-1.txt', 'fajlovi/60b685f1581705.43042938.txt', 'txt', 'primer', 0, 0, 0),
(33, 'mn2-1.txt', 'fajlovi/60b6861db404b1.06473321.txt', 'txt', 'primer', 1, 0, 0),
(34, 'mn2-2.txt', 'fajlovi/60b6861dccec06.97360461.txt', 'txt', 'primer', 1, 1, 0),
(39, 'mn9-1.txt', 'fajlovi/60b687ce3f7fd0.95245803.txt', 'txt', 'primer', 8, 0, 0),
(40, 'mn10-1.txt', 'fajlovi/60b687ce58a5b7.50437130.txt', 'txt', 'primer', 9, 0, 0),
(41, 'mn10-2.txt', 'fajlovi/60b687ce8b2ff1.80547642.txt', 'txt', 'primer', 9, 1, 0),
(42, 'mn10-3.txt', 'fajlovi/60b687ce9bca33.40341027.txt', 'txt', 'primer', 9, 2, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fajl`
--
ALTER TABLE `fajl`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fajl`
--
ALTER TABLE `fajl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
