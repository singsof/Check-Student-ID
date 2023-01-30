-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 17, 2023 at 12:30 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `scan_stdid`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_ad` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email_ad` varchar(50) NOT NULL,
  `pass_ad` varchar(50) NOT NULL,
  `stus` varchar(3) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_ad`, `name`, `email_ad`, `pass_ad`, `stus`) VALUES
(1, 'admin', 'admin@gmail.com', 'admin', '1');

-- --------------------------------------------------------

--
-- Table structure for table `record`
--

CREATE TABLE `record` (
  `id_hi` int(11) NOT NULL,
  `id_std` int(11) NOT NULL,
  `tin_hi` datetime NOT NULL,
  `tout_hi` datetime DEFAULT NULL,
  `status_hi` int(3) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `record`
--

INSERT INTO `record` (`id_hi`, `id_std`, `tin_hi`, `tout_hi`, `status_hi`) VALUES
(1, 1, '2023-01-17 18:26:40', '2023-01-17 18:26:58', 0);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id_std` int(11) NOT NULL,
  `code_std` varchar(20) NOT NULL,
  `name_std` varchar(60) NOT NULL,
  `tel_std` varchar(10) NOT NULL,
  `classroom_std` text NOT NULL,
  `status_std` varchar(2) NOT NULL DEFAULT '1',
  `date_std` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `img_std` varchar(50) NOT NULL DEFAULT 'phoxix.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id_std`, `code_std`, `name_std`, `tel_std`, `classroom_std`, `status_std`, `date_std`, `img_std`) VALUES
(1, '62122710108', 'นายสมพล วิลา', '0961632545', '6/3', '1', '2023-01-17 11:22:51', 'xn2023_01_17_18_22_51gLbuZl.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_ad`);

--
-- Indexes for table `record`
--
ALTER TABLE `record`
  ADD PRIMARY KEY (`id_hi`),
  ADD KEY `sd` (`id_std`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id_std`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_ad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `record`
--
ALTER TABLE `record`
  MODIFY `id_hi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id_std` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `record`
--
ALTER TABLE `record`
  ADD CONSTRAINT `sd` FOREIGN KEY (`id_std`) REFERENCES `student` (`id_std`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
