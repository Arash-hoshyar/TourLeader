-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2024 at 06:36 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `electonic_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_information`
--

CREATE TABLE `tbl_user_information` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(500) NOT NULL,
  `time_added` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user_information`
--

INSERT INTO `tbl_user_information` (`id`, `email`, `password`, `time_added`) VALUES
(1, 'arashhoshyar.2022@gmail.com', 'f30523922153039731ce5666cfa6f3c95dd9ac47efe6ef1cb92bf6aec130ba38f89a42f88b4c1c1ce9139fae51083986905881070d36a675a0977dc91cdbd4c4', '2024-04-18'),
(2, 'arashhoshyar.2022@gmail.com', 'f5ffc82f909b04f410276680b55113d606a52af2ff1e510a62d838741d66491679fd1290d7c6a28ee92dfeb81e8c4725c9d4aea69f1c3963a50376b2e1a8118b', '2024-04-18'),
(3, 'arashhoshyar.2022@gmail.com', '35170dd06c19d8f18fa7fd023b66144d3023143b95c6233a7d07aa4ac3ad3aaa7b967c7cd22791ba071c696e0deae973c4e07fef2a52f46227516b1061272cc3', '2024-04-18'),
(4, 'arashhoshyar.2022@gmail.com', '35170dd06c19d8f18fa7fd023b66144d3023143b95c6233a7d07aa4ac3ad3aaa7b967c7cd22791ba071c696e0deae973c4e07fef2a52f46227516b1061272cc3', '2024-04-18'),
(5, 'arashhoshyar.2022@gmail.com', '35170dd06c19d8f18fa7fd023b66144d3023143b95c6233a7d07aa4ac3ad3aaa7b967c7cd22791ba071c696e0deae973c4e07fef2a52f46227516b1061272cc3', '2024-04-18'),
(6, 'arashhoshyar.2022@gmail.com', '35170dd06c19d8f18fa7fd023b66144d3023143b95c6233a7d07aa4ac3ad3aaa7b967c7cd22791ba071c696e0deae973c4e07fef2a52f46227516b1061272cc3', '2024-04-18'),
(7, 'arashhoshyar.2022@gmail.com', '35170dd06c19d8f18fa7fd023b66144d3023143b95c6233a7d07aa4ac3ad3aaa7b967c7cd22791ba071c696e0deae973c4e07fef2a52f46227516b1061272cc3', '2024-04-18'),
(8, 'arashhoshyar.2022@gmail.com', '35170dd06c19d8f18fa7fd023b66144d3023143b95c6233a7d07aa4ac3ad3aaa7b967c7cd22791ba071c696e0deae973c4e07fef2a52f46227516b1061272cc3', '2024-04-19'),
(9, 'arashhoshyar.2022@gmail.com', '35170dd06c19d8f18fa7fd023b66144d3023143b95c6233a7d07aa4ac3ad3aaa7b967c7cd22791ba071c696e0deae973c4e07fef2a52f46227516b1061272cc3', '2024-04-19'),
(10, 'arashhoshyar.2022@gmail.com', '35170dd06c19d8f18fa7fd023b66144d3023143b95c6233a7d07aa4ac3ad3aaa7b967c7cd22791ba071c696e0deae973c4e07fef2a52f46227516b1061272cc3', '2024-04-19'),
(11, 'arashhoshyar.2022@gmail.com', '8d13dd95ad55340b997f406033b12bd4664cb26a0e93c1c6b67256c08925f39c82c657f50fe56b1446de2b19ca5b74f748994cabdc440868437d9cce87a6032c', '2024-04-19'),
(12, 'arashhoshyar.2022@gmail.com', '35170dd06c19d8f18fa7fd023b66144d3023143b95c6233a7d07aa4ac3ad3aaa7b967c7cd22791ba071c696e0deae973c4e07fef2a52f46227516b1061272cc3', '2024-04-19'),
(13, 'arashhoshyar.2022@gmail.com', 'f5ffc82f909b04f410276680b55113d606a52af2ff1e510a62d838741d66491679fd1290d7c6a28ee92dfeb81e8c4725c9d4aea69f1c3963a50376b2e1a8118b', '2024-04-19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_user_information`
--
ALTER TABLE `tbl_user_information`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_user_information`
--
ALTER TABLE `tbl_user_information`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
