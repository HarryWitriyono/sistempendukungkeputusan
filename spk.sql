-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 03, 2021 at 11:35 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spk`
--

-- --------------------------------------------------------

--
-- Table structure for table `atribut`
--

CREATE TABLE `atribut` (
  `idatribute` int(3) NOT NULL,
  `namaatribut` varchar(35) NOT NULL,
  `nilaipreferensi` double(7,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `atribut`
--

INSERT INTO `atribut` (`idatribute`, `namaatribut`, `nilaipreferensi`) VALUES
(1, 'Atribut 1', NULL),
(2, 'Atribut 2', NULL),
(3, 'Atribut 3', NULL),
(4, 'Atribut 4', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `idkriteria` int(3) NOT NULL,
  `namakriteria` varchar(35) NOT NULL,
  `bobotpreferensi` double(7,2) DEFAULT NULL,
  `nilaiNormalisasi` double(7,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`idkriteria`, `namakriteria`, `bobotpreferensi`, `nilaiNormalisasi`) VALUES
(1, 'Kriteria 1', NULL, NULL),
(2, 'Kriteria 2', NULL, NULL),
(3, 'Kriteria 3', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `idpengguna` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`idpengguna`, `password`) VALUES
('Admin', '*68AB655AF1DDBDB3179671D16EB5B'),
('Harry', '*6F94AC199DE31631A30144A513BEB');

-- --------------------------------------------------------

--
-- Table structure for table `ratingkecocokan`
--

CREATE TABLE `ratingkecocokan` (
  `idrating` int(5) NOT NULL,
  `idkriteria` int(3) NOT NULL,
  `idatribute` int(3) NOT NULL,
  `nilairating` double(7,2) DEFAULT NULL,
  `nilainormalisasi` double(7,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ratingkecocokan`
--

INSERT INTO `ratingkecocokan` (`idrating`, `idkriteria`, `idatribute`, `nilairating`, `nilainormalisasi`) VALUES
(8, 2, 3, 2.50, NULL),
(9, 2, 1, 3.00, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `atribut`
--
ALTER TABLE `atribut`
  ADD PRIMARY KEY (`idatribute`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`idkriteria`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`idpengguna`);

--
-- Indexes for table `ratingkecocokan`
--
ALTER TABLE `ratingkecocokan`
  ADD PRIMARY KEY (`idrating`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `atribut`
--
ALTER TABLE `atribut`
  MODIFY `idatribute` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `idkriteria` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ratingkecocokan`
--
ALTER TABLE `ratingkecocokan`
  MODIFY `idrating` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
