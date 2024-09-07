-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql:3306
-- Generation Time: Sep 02, 2024 at 05:28 PM
-- Server version: 8.4.0
-- PHP Version: 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_purchase_infomation`
--

CREATE TABLE `tbl_purchase_infomation` (
  `id` int UNSIGNED NOT NULL,
  `tbl_product_user_ids` varchar(255) NOT NULL,
  `user_billing_info_id` int NOT NULL,
  `session` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_purchase_infomation`
--

INSERT INTO `tbl_purchase_infomation` (`id`, `tbl_product_user_ids`, `user_billing_info_id`, `session`) VALUES
(1, '1', 30, 'arashhoshyar.2022@gmail.com'),
(3, '1', 33, 'arashhoshyar.2022@gmail.com'),
(4, '2', 33, 'arashhoshyar.2022@gmail.com'),
(5, '3', 33, 'arashhoshyar.2022@gmail.com'),
(6, '4', 33, 'arashhoshyar.2022@gmail.com'),
(7, '5', 33, 'arashhoshyar.2022@gmail.com'),
(8, '6', 33, 'arashhoshyar.2022@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_purchase_infomation`
--
ALTER TABLE `tbl_purchase_infomation`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_purchase_infomation`
--
ALTER TABLE `tbl_purchase_infomation`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
