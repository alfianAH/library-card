-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 30, 2020 at 02:58 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library_card`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku-perpustakaan`
--

CREATE TABLE `buku-perpustakaan` (
  `ISBN` varchar(30) NOT NULL,
  `Nama Buku` varchar(100) NOT NULL,
  `Penulis` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `buku-pinjaman`
--

CREATE TABLE `buku-pinjaman` (
  `id` int(11) NOT NULL,
  `NIM` varchar(12) NOT NULL,
  `ISBN` varchar(30) NOT NULL,
  `Waktu Peminjaman` datetime NOT NULL,
  `Waktu Pengembalian` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `NIM` varchar(12) NOT NULL,
  `Nama` varchar(30) NOT NULL,
  `Prodi` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku-perpustakaan`
--
ALTER TABLE `buku-perpustakaan`
  ADD PRIMARY KEY (`ISBN`);

--
-- Indexes for table `buku-pinjaman`
--
ALTER TABLE `buku-pinjaman`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `NIM` (`NIM`),
  ADD UNIQUE KEY `ISBN` (`ISBN`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`NIM`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buku-pinjaman`
--
ALTER TABLE `buku-pinjaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buku-pinjaman`
--
ALTER TABLE `buku-pinjaman`
  ADD CONSTRAINT `ISBN` FOREIGN KEY (`ISBN`) REFERENCES `buku-perpustakaan` (`ISBN`),
  ADD CONSTRAINT `NIM` FOREIGN KEY (`NIM`) REFERENCES `mahasiswa` (`NIM`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
