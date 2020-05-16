-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2020 at 02:59 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `node1bc`
--

-- --------------------------------------------------------

--
-- Table structure for table `blockchain`
--

CREATE TABLE `blockchain` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `uraian` varchar(252) NOT NULL,
  `tipe` varchar(10) NOT NULL,
  `nominal` int(11) NOT NULL,
  `saldo` int(11) NOT NULL,
  `prevhash` varchar(252) NOT NULL,
  `currhash` varchar(252) NOT NULL,
  `nonce` varchar(252) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blockchain`
--

INSERT INTO `blockchain` (`id`, `tanggal`, `uraian`, `tipe`, `nominal`, `saldo`, `prevhash`, `currhash`, `nonce`) VALUES
(0, '2020-05-11', 'genesis', 'NULL', 0, 0, 'NULL', 'NULL', 'NULL'),
(9, '2020-05-08', 'makan', 'D', 22222, 22222, 'NULL', '9999ba3fc81d48b5f462868ced6412a0', '53004'),
(10, '2020-05-08', 'makan', 'D', 22222, 44444, '9999ba3fc81d48b5f462868ced6412a0', '999993fb5cbce12ab0c5dd80f98e2a7e', '169516'),
(11, '2020-05-23', 'makan', 'K', 22222, 22222, '999993fb5cbce12ab0c5dd80f98e2a7e', '99999db3aab21387e4fb6ff21bbd0773', '60905'),
(12, '2020-05-12', 'makan', 'K', 22222, 0, '99999db3aab21387e4fb6ff21bbd0773', '9999699bf531c0d83c6fb09f2d4a66a8', '50474'),
(13, '2019-12-24', 'makan', 'D', 20000, 20000, '9999699bf531c0d83c6fb09f2d4a66a8', '9999d2aab5376f11a507f5aa9d61795c', '26177');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blockchain`
--
ALTER TABLE `blockchain`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
