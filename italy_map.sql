-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2022 at 11:30 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `italy_map`
--

-- --------------------------------------------------------

--
-- Table structure for table `all_data`
--

CREATE TABLE `all_data` (
  `id` int(11) NOT NULL,
  `location_name` varchar(255) NOT NULL,
  `lat` varchar(255) NOT NULL,
  `lng` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `all_data`
--

INSERT INTO `all_data` (`id`, `location_name`, `lat`, `lng`) VALUES
(6, 'compania', '40.94283745357943', '14.765625000000002'),
(7, 'Near Roma', '41.9218368386702', '12.370605468750002'),
(8, 'Terni', '42.68470737726681', '12.7880859375'),
(9, 'Grosseto', '42.95836131619836', '11.118164062500002'),
(10, 'Taranto', '40.70202469823277', '17.402343750000004'),
(11, 'Ancona', '43.533863144481096', '13.623046875');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `all_data`
--
ALTER TABLE `all_data`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `all_data`
--
ALTER TABLE `all_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
