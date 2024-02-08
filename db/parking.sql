-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 08, 2024 at 06:27 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `parking`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_site`
--

CREATE TABLE `tbl_site` (
  `id` int(11) NOT NULL,
  `name` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_site`
--

INSERT INTO `tbl_site` (`id`, `name`) VALUES
(1, 'Parking Site 1'),
(2, 'Parking Site 2'),
(3, 'Parking Site 3'),
(4, 'Parking Site 4'),
(5, 'Parking Site 5'),
(6, 'Parking Site 6');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaction`
--

CREATE TABLE `tbl_transaction` (
  `id` int(11) NOT NULL,
  `id_site` int(11) DEFAULT NULL,
  `user_group` varchar(255) DEFAULT NULL,
  `entry_start` datetime DEFAULT NULL,
  `entry_stop` datetime DEFAULT NULL,
  `duration` varchar(255) NOT NULL,
  `gross` varchar(100) DEFAULT NULL,
  `fee` varchar(100) DEFAULT NULL,
  `net_rate` varchar(100) DEFAULT NULL,
  `default_value` varchar(255) NOT NULL DEFAULT 'Weekend: Flat rate + Weekend: Flat rate + Weekend: Flat rate',
  `number_plate` varchar(100) DEFAULT NULL,
  `receipt` varchar(100) DEFAULT NULL,
  `reference` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_transaction`
--

INSERT INTO `tbl_transaction` (`id`, `id_site`, `user_group`, `entry_start`, `entry_stop`, `duration`, `gross`, `fee`, `net_rate`, `default_value`, `number_plate`, `receipt`, `reference`) VALUES
(1, 6, 'Standard', '2023-12-30 14:20:00', '2024-01-01 10:22:00', '1.20:01', '21.60', '0.75', '20.85', 'Weekend: Flat rate + Weekend: Flat rate + Weekend: Flat rate', '', '3268527', ''),
(2, 6, 'Standard', '2023-12-30 14:49:00', '2024-01-01 09:08:00', '1.18:18', '21.60', '0.75', '20.85', 'Weekend: Flat rate + Weekend: Flat rate + Weekend: Flat rate', '', '3268496', ''),
(3, 6, 'Standard', '2023-12-30 16:00:00', '2024-01-01 10:07:00', '1.18:06', '21.60', '0.75', '20.85', 'Weekend: Flat rate + Weekend: Flat rate + Weekend: Flat rate', '', '3268518', ''),
(4, 6, 'Standard', '2023-12-30 16:22:00', '2024-01-01 09:44:00', '1.17:21', '21.60', '0.75', '20.85', 'Weekend: Flat rate + Weekend: Flat rate + Weekend: Flat rate', '', '3268506', ''),
(5, 6, 'Standard', '2023-12-31 12:07:00', '2024-01-01 11:44:00', '23:36', '14.40', '0.50', '13.90', 'Weekend: Flat rate + Weekend: Flat rate + Weekend: Flat rate', '', '3268591', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL,
  `username` varchar(55) NOT NULL,
  `password` varchar(55) NOT NULL,
  `status` enum('admin','user') NOT NULL DEFAULT 'admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `username`, `password`, `status`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_site`
--
ALTER TABLE `tbl_site`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_transaction`
--
ALTER TABLE `tbl_transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_site`
--
ALTER TABLE `tbl_site`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_transaction`
--
ALTER TABLE `tbl_transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
