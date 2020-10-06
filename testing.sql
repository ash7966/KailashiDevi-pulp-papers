-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 18, 2020 at 11:15 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `testing`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `sn` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `ob` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`sn`, `name`, `date`, `ob`) VALUES
(790, 'Raju gupta', '2020-08-17', 214136),
(789, 'Santosh', '2020-08-17', 181238),
(658, 'DG', '2020-07-15', 85213.7),
(658, 'DG', '2020-07-15', 113543);

-- --------------------------------------------------------

--
-- Table structure for table `ex_quality`
--

CREATE TABLE `ex_quality` (
  `sn` int(11) NOT NULL,
  `acname` varchar(22) NOT NULL,
  `name` varchar(20) NOT NULL,
  `eqname` varchar(20) NOT NULL,
  `eqp` float NOT NULL,
  `eqw` float NOT NULL,
  `eqrate` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ex_quality`
--

INSERT INTO `ex_quality` (`sn`, `acname`, `name`, `eqname`, `eqp`, `eqw`, `eqrate`) VALUES
(789, 'Santosh', 'DMC', 'DMC', 75, 12945.6, 10),
(789, 'Santosh', 'DMC', 'old book', 25, 4315.2, 12),
(658, 'DG', 'PEPSI CUTTING', 'PEPSI CUTTING', 25, 1387.62, 21),
(658, 'DG', 'PEPSI CUTTING', 'shorted books', 55, 3052.76, 14),
(658, 'DG', 'PEPSI CUTTING', 'D C', 20, 1110.09, 12);

-- --------------------------------------------------------

--
-- Table structure for table `info`
--

CREATE TABLE `info` (
  `sn` int(11) NOT NULL,
  `pd` date NOT NULL,
  `acname` varchar(50) NOT NULL,
  `supplier` varchar(50) NOT NULL,
  `party` varchar(50) NOT NULL,
  `place` varchar(50) NOT NULL,
  `ld` date NOT NULL,
  `invoice` varchar(30) NOT NULL,
  `vehicle` varchar(30) NOT NULL,
  `ch_wt` float NOT NULL,
  `mi_wt` float NOT NULL,
  `shortage` float NOT NULL,
  `payment` float NOT NULL,
  `cr` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `info`
--

INSERT INTO `info` (`sn`, `pd`, `acname`, `supplier`, `party`, `place`, `ld`, `invoice`, `vehicle`, `ch_wt`, `mi_wt`, `shortage`, `payment`, `cr`) VALUES
(658, '2020-07-15', 'DG', 'cone craft', 'shivam enterprises', 'jhansi', '2020-07-13', '32', 'UP11T7366', 7990, 7945, 45, 113543, 0),
(789, '2020-08-17', 'Santosh', 'ANANDA SHAW', '-', 'west bengal', '2020-08-14', '38', 'UP21CN3045', 17980, 17980, 0, 181238, 0),
(790, '2020-08-17', 'Raju gupta', 'lalta prashad', '-', 'kolkata', '2020-08-14', '243', 'UP21BN6495', 16115, 16050, 65, 214136, 0);

-- --------------------------------------------------------

--
-- Table structure for table `quality`
--

CREATE TABLE `quality` (
  `sn` int(11) NOT NULL,
  `acname` varchar(50) NOT NULL,
  `name` varchar(20) NOT NULL,
  `moisture` float NOT NULL,
  `rejection` float NOT NULL,
  `qwt` float NOT NULL,
  `wt` float NOT NULL,
  `rate` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quality`
--

INSERT INTO `quality` (`sn`, `acname`, `name`, `moisture`, `rejection`, `qwt`, `wt`, `rate`) VALUES
(790, 'Raju gupta', 'Duplex', 0, 263.4, 13170, 12906.6, 14),
(790, 'Raju gupta', 'BC', 0, 93, 2880, 2787, 12),
(789, 'Santosh', 'DMC', 359.6, 359.6, 17980, 17260.8, 0),
(658, 'DG', 'DMC', 17.6, 0, 880, 862.4, 10),
(658, 'DG', 'SHORTED BOOK', 14.3, 7.15, 1430, 1408.55, 14),
(658, 'DG', 'PEPSI CUTTING', 56.35, 28.18, 5635, 5550.47, 0);

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `sn` int(11) NOT NULL,
  `rd` date NOT NULL,
  `name` varchar(40) NOT NULL,
  `ob` float NOT NULL,
  `rec` float NOT NULL,
  `total` float NOT NULL,
  `con` float NOT NULL,
  `bal` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`sn`, `rd`, `name`, `ob`, `rec`, `total`, `con`, `bal`) VALUES
(790, '2020-08-17', 'Duplex', 0, 13170, 0, 0, 0),
(790, '2020-08-17', 'BC', 0, 2880, 0, 0, 0),
(789, '2020-08-17', 'DMC', 0, 12945.6, 0, 0, 0),
(789, '2020-08-17', 'old book', 0, 4315.2, 0, 0, 0),
(658, '2020-07-15', 'DMC', 0, 880, 0, 0, 0),
(658, '2020-07-15', 'SHORTED BOOK', 0, 1430, 0, 0, 0),
(658, '2020-07-15', 'PEPSI CUTTING', 0, 1387.62, 0, 0, 0),
(658, '2020-07-15', 'shorted books', 0, 3052.76, 0, 0, 0),
(658, '2020-07-15', 'D C', 0, 1110.09, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `usertype` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `usertype`) VALUES
(20, 'prashant', 'prashant@123', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `info`
--
ALTER TABLE `info`
  ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
