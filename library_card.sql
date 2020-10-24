-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 24, 2020 at 03:13 PM
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
-- Table structure for table `buku_tbl`
--

CREATE TABLE `buku_tbl` (
  `isbn` bigint(20) NOT NULL,
  `nama_buku` varchar(100) NOT NULL,
  `nama_penulis` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `buku_tbl`
--

INSERT INTO `buku_tbl` (`isbn`, `nama_buku`, `nama_penulis`) VALUES
(9780122007514, 'Principles and Practices of Interconnection Networks', 'William James Dally, Brian Patrick Towles'),
(9780122698514, 'The artificial neural network book', 'Keinosuke Fukunaga'),
(9780201615869, 'The practice of programming', 'Brian W. Kernighan, Rob Pike'),
(9780262024051, 'Algorithmic number theory: Efficient algorithms', 'Eric Bach, Jeffrey Shallit'),
(9780262532037, 'A History of Modern Computing', 'Paul E. Ceruzzi'),
(9780321154958, 'Software architecture in practice', 'Len Bass, Paul Clements, Rick Kazman'),
(9780471668879, 'Speech Coding Algorithms: Foundation and Evolution of Standardized Coders', 'Wai C. Chu'),
(9781420031119, 'Strategic Software Engineering: An Interdisciplinary Approach', 'Fadi P. Deek, James A. M. McHugh, Osama M. Eljabiri'),
(9781518800276, 'Learn C# in One Day and Learn It Well: C# for Beginners with Hands-on Project', 'Jamie Chan'),
(9783540211518, 'Software Engineering 3: Domains, Requirements, and Software Design', 'Dines Bjørner');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa_tbl`
--

CREATE TABLE `mahasiswa_tbl` (
  `nim` varchar(12) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `prodi` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mahasiswa_tbl`
--

INSERT INTO `mahasiswa_tbl` (`nim`, `nama_lengkap`, `prodi`, `password`, `token`) VALUES
('admin', 'admin123', 'Teknik Informatika', '21232f297a57a5a743894a0e4a801fc3', '3e86c90b6b4501005e26c4fc1e0100a0'),
('alfian', 'alfian aldy hamdani', 'Teknik Informatika', '21232f297a57a5a743894a0e4a801fc3', '2542e69f69ec93fbf240184941ec1658');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman_tbl`
--

CREATE TABLE `peminjaman_tbl` (
  `rent_id` int(11) NOT NULL,
  `nim` varchar(12) NOT NULL,
  `isbn` bigint(20) NOT NULL,
  `waktu_peminjaman` date NOT NULL,
  `waktu_pengembalian` date NOT NULL,
  `denda` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `peminjaman_tbl`
--

INSERT INTO `peminjaman_tbl` (`rent_id`, `nim`, `isbn`, `waktu_peminjaman`, `waktu_pengembalian`, `denda`) VALUES
(5, 'admin', 9780122698514, '2020-10-24', '2020-10-31', 0),
(6, 'alfian', 9780262024051, '2020-10-24', '2020-10-31', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku_tbl`
--
ALTER TABLE `buku_tbl`
  ADD PRIMARY KEY (`isbn`);

--
-- Indexes for table `mahasiswa_tbl`
--
ALTER TABLE `mahasiswa_tbl`
  ADD PRIMARY KEY (`nim`);

--
-- Indexes for table `peminjaman_tbl`
--
ALTER TABLE `peminjaman_tbl`
  ADD PRIMARY KEY (`rent_id`),
  ADD KEY `FK_MAHASISWA_TBL_NIM` (`nim`),
  ADD KEY `FK_BUKU_TBL_ISBN` (`isbn`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `peminjaman_tbl`
--
ALTER TABLE `peminjaman_tbl`
  MODIFY `rent_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `peminjaman_tbl`
--
ALTER TABLE `peminjaman_tbl`
  ADD CONSTRAINT `FK_BUKU_TBL_ISBN` FOREIGN KEY (`isbn`) REFERENCES `buku_tbl` (`isbn`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_MAHASISWA_TBL_NIM` FOREIGN KEY (`nim`) REFERENCES `mahasiswa_tbl` (`nim`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
