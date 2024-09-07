-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql:3306
-- Generation Time: Sep 07, 2024 at 06:41 PM
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
-- Table structure for table `tbl_add_cart`
--

CREATE TABLE `tbl_add_cart` (
  `id` int UNSIGNED NOT NULL,
  `product_id` varchar(1000) NOT NULL,
  `sessionUser` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin_information`
--

CREATE TABLE `tbl_admin_information` (
  `id` int UNSIGNED NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(255) NOT NULL,
  `time_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_admin_information`
--

INSERT INTO `tbl_admin_information` (`id`, `email`, `password`, `time_added`) VALUES
(1, 'arashhoshyar.2022@gmail.com', 'f30523922153039731ce5666cfa6f3c95dd9ac47efe6ef1cb92bf6aec130ba38f89a42f88b4c1c1ce9139fae51083986905881070d36a675a0977dc91cdbd4c4', '2024-06-25 12:35:48'),
(2, 'A@gmail.com', 'f30523922153039731ce5666cfa6f3c95dd9ac47efe6ef1cb92bf6aec130ba38f89a42f88b4c1c1ce9139fae51083986905881070d36a675a0977dc91cdbd4c4', '2024-06-27 08:48:05'),
(3, 'b@gmail.com', 'f30523922153039731ce5666cfa6f3c95dd9ac47efe6ef1cb92bf6aec130ba38f89a42f88b4c1c1ce9139fae51083986905881070d36a675a0977dc91cdbd4c4', '2024-06-27 09:22:32');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_brand`
--

CREATE TABLE `tbl_brand` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `logo` varchar(1000) NOT NULL,
  `url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_brand`
--

INSERT INTO `tbl_brand` (`id`, `name`, `logo`, `url`) VALUES
(28, 'google', '0dd89a64de64b2b97801effba47fcff1PxG_GVE_Blog_Header-bike_1.width-1300.png', 'http://www.google.com'),
(33, 'apple', 'f1a9d2f5d506c59365f067d5bca3f264Apple-Logo.png', 'http://www.apple.com'),
(34, 'samsung', '6bdfcce6840fb9d7ee840080a242ba81Samsung_wordmark.svg.png', 'http://www.samsung.com'),
(35, 'nothing', 'd3576505ad8f449bfb0faf42a7904ae8mmm.png', 'http://www.nothing.com'),
(36, 'dcww', 'aefwe', 'wefwf');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart_price`
--

CREATE TABLE `tbl_cart_price` (
  `id` int UNSIGNED NOT NULL,
  `product_id_cart` int NOT NULL,
  `price` int NOT NULL,
  `session` varchar(255) NOT NULL,
  `count` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `name`) VALUES
(4, 'ipad'),
(5, 'tablet'),
(11, 'phone');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_journey`
--

CREATE TABLE `tbl_journey` (
  `id` int UNSIGNED NOT NULL,
  `lable` varchar(1000) NOT NULL,
  `img` varchar(1000) NOT NULL,
  `about` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_journey`
--

INSERT INTO `tbl_journey` (`id`, `lable`, `img`, `about`) VALUES
(2, 'reerwgwhert', '33ae6e1d7cf341523d5a2d11cf55b0aba7fc28f6-718f-4f01-ae9e-069c5072088b.png', 'wergwegw'),
(3, 'dfvsdvdgb d', '255313850908693b7363d3552cbb3964a7fc28f6-718f-4f01-ae9e-069c5072088b.png', 'sdfbsdbsdfbdsf\r\nbsdfbsdfbdsfb\r\nsdfbdsfbsdfbsdbs');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_massage`
--

CREATE TABLE `tbl_massage` (
  `id` int UNSIGNED NOT NULL,
  `postId` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `lable` varchar(255) NOT NULL,
  `massage` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_massage`
--

INSERT INTO `tbl_massage` (`id`, `postId`, `name`, `lable`, `massage`) VALUES
(1, 1, 'dcasdva', 'sadfva', 'asdvsvad'),
(2, 1, 'fsdvbweb', 'ebewtbetbwe', 'tbetbwebetbwrtbrwb\r\nwrtbwrtbwrtb'),
(3, 1, 'db sfrgb', 'bfgbertyhb', 'etryheryhre\r\nyh\r\nerh\r\neryh');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_material`
--

CREATE TABLE `tbl_material` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_material`
--

INSERT INTO `tbl_material` (`id`, `name`) VALUES
(2, 'titenium'),
(4, 'glass'),
(5, 'metal');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_media`
--

CREATE TABLE `tbl_media` (
  `id` int UNSIGNED NOT NULL,
  `product_ id` int NOT NULL,
  `order` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_post`
--

CREATE TABLE `tbl_post` (
  `id` int UNSIGNED NOT NULL,
  `lable` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `about` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_post`
--

INSERT INTO `tbl_post` (`id`, `lable`, `img`, `about`) VALUES
(1, 'cvsdfvsdvadsvasvas', '17b2c92c87e022bffa7dcd3f677dfec84e17ed63-6fe2-4c0c-8ea0-2a33bea799e6.png', 'sdvsdvsdvds\r\ndsacvasdvav');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_presentAddress`
--

CREATE TABLE `tbl_presentAddress` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `zipCode` int NOT NULL,
  `telephone` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_presentAddress`
--

INSERT INTO `tbl_presentAddress` (`id`, `name`, `email`, `address`, `city`, `country`, `zipCode`, `telephone`) VALUES
(1, 'ijuhygt', 'b@gmail.com', 'ryrktykf', 'fgbfgbg', 'fgbfgbfgbfg', 3453455, 345345),
(2, 'ijuhygt', 'b@gmail.com', 'ryrktykf', 'fgbfgbg', 'fgbfgbfgbfg', 3453455, 345345),
(5, 'ijuhygt', 'b@gmail.com', 'ryrktykf', 'fgbfgbg', 'fgbfgbfgbfg', 3453455, 345345),
(6, 'chghkdty', 'dukdyuk', 'duycukfy', 'fgbfgbg', 'fgbfgbfgbfg', 5645747, 465674567);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `label` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `brand_id` int NOT NULL,
  `description` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `price` int NOT NULL,
  `height` int NOT NULL,
  `width` int NOT NULL,
  `category_id` int NOT NULL,
  `package` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`id`, `name`, `label`, `brand_id`, `description`, `price`, `height`, `width`, `category_id`, `package`) VALUES
(38, 'iphone', 'phone', 33, 'good phone', 678, 12, 9, 11, '33'),
(39, 'pixel 5', 'nice camera and nice pixels', 28, 'good phone', 1200, 12, 6, 11, 'box'),
(40, 'pixel 5', 'nice camera', 28, 'good phone', 1200, 12, 5, 11, 'box'),
(42, 'nothing', 'phone', 35, 'good phone', 1000, 11, 5, 11, 'box'),
(43, 'pixle tablet', 'nice camera', 28, 'nice phone', 1398, 12, 5, 5, 'box'),
(44, 'ipad pro m4', 'nice color thin posible', 33, 'good ipad and really thin', 1000, 12, 5, 4, 'box'),
(45, 'galaxy tab 5', 'nice camera and nice ', 34, 'meh tablet', 300, 11, 5, 5, 'box');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_material_category`
--

CREATE TABLE `tbl_product_material_category` (
  `id` int UNSIGNED NOT NULL,
  `product_id` int UNSIGNED NOT NULL,
  `category_id` int UNSIGNED NOT NULL,
  `material_id` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_product_material_category`
--

INSERT INTO `tbl_product_material_category` (`id`, `product_id`, `category_id`, `material_id`) VALUES
(1, 38, 11, 5),
(5, 40, 11, 2),
(15, 39, 11, 2),
(16, 39, 11, 4),
(17, 39, 11, 5),
(21, 42, 11, 2),
(22, 42, 11, 5),
(23, 43, 5, 2),
(24, 43, 5, 5),
(25, 44, 4, 4),
(26, 44, 4, 5),
(27, 45, 5, 4),
(28, 45, 5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_user_cart`
--

CREATE TABLE `tbl_product_user_cart` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `label` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `height` varchar(255) NOT NULL,
  `width` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `package` varchar(255) NOT NULL,
  `materials` varchar(255) NOT NULL,
  `whole_price` int NOT NULL,
  `session` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_product_user_cart`
--

INSERT INTO `tbl_product_user_cart` (`id`, `name`, `label`, `brand`, `description`, `price`, `height`, `width`, `category`, `package`, `materials`, `whole_price`, `session`) VALUES
(1, 'pixel 5', 'nice camera and nice pixels', 'google', 'good phone', '1200', '12', '6', 'phone', 'box', 'titenium,glass,metal', 1200, 'arashhoshyar.2022@gmail.com'),
(2, 'nothing', 'phone', 'nothing', 'good phone', '1000', '11', '5', 'phone', 'box', 'titenium,metal', 1000, 'arashhoshyar.2022@gmail.com'),
(3, 'nothing', 'phone', 'nothing', 'good phone', '1000', '11', '5', 'phone', 'box', 'titenium,metal', 1000, 'arashhoshyar.2022@gmail.com'),
(4, 'iphone', 'phone', 'apple', 'good phone', '678', '12', '9', 'phone', '33', 'metal', 678, 'arashhoshyar.2022@gmail.com'),
(5, 'iphone', 'phone', 'apple', 'good phone', '678', '12', '9', 'phone', '33', 'metal', 678, 'arashhoshyar.2022@gmail.com'),
(6, 'iphone', 'phone', 'apple', 'good phone', '678', '12', '9', 'phone', '33', 'metal', 678, 'arashhoshyar.2022@gmail.com');

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

-- --------------------------------------------------------

--
-- Table structure for table `tbl_technical_info`
--

CREATE TABLE `tbl_technical_info` (
  `id` int UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_technical_info_product`
--

CREATE TABLE `tbl_technical_info_product` (
  `id` int UNSIGNED NOT NULL,
  `technical_info_ id` int NOT NULL,
  `product_id` int NOT NULL,
  `value` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_top_selling`
--

CREATE TABLE `tbl_top_selling` (
  `id` int UNSIGNED NOT NULL,
  `product_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_top_selling`
--

INSERT INTO `tbl_top_selling` (`id`, `product_id`) VALUES
(3, '39'),
(4, '39'),
(7, '43');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tourLeader_infomation`
--

CREATE TABLE `tbl_tourLeader_infomation` (
  `id` int UNSIGNED NOT NULL,
  `Name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `realPassword` varchar(255) NOT NULL,
  `age` int DEFAULT NULL,
  `country` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `city` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `number` int DEFAULT NULL,
  `Language` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_tourLeader_infomation`
--

INSERT INTO `tbl_tourLeader_infomation` (`id`, `Name`, `email`, `password`, `realPassword`, `age`, `country`, `city`, `number`, `Language`) VALUES
(9, 'ghnfmgh', 'a@gmail.com', 'f30523922153039731ce5666cfa6f3c95dd9ac47efe6ef1cb92bf6aec130ba38f89a42f88b4c1c1ce9139fae51083986905881070d36a675a0977dc91cdbd4c4', '123456', 3546, 'rthtghb', 'hgngfn', 46764, 'fnghnfgn'),
(11, 'dghdrth', 'd@gmail.com', '6c463e9fcfbe15eb19a11434a59aec8c258d444540c895a570079aeee0ac899ce81f234064e556c76eb997f439dff6badb1fedb94431d10d08a2ecf6493c6a09', 'sfdbsfdbsd', 2345, 'gbdfgb', 'dfgbfgb', 523635, 'dfgbfgb');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tours`
--

CREATE TABLE `tbl_tours` (
  `id` int UNSIGNED NOT NULL,
  `lable` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `price` int NOT NULL,
  `days` int NOT NULL,
  `place` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `tourGuide` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_tours`
--

INSERT INTO `tbl_tours` (`id`, `lable`, `img`, `price`, `days`, `place`, `description`, `tourGuide`) VALUES
(1, 'sdfbwdfbsgnsfnf', '6758e2ada7eb2798d2cf5e8bf8184b0534671825-4577-448f-949d-293cd5d934c2.png', 4523, 443623, 'fdgsdfgdsfg', 'sdfgdfgdffg\r\nsdfgsdg', 'dghdrth');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_billing_address`
--

CREATE TABLE `tbl_user_billing_address` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `zipCode` int NOT NULL,
  `telephone` int NOT NULL,
  `product_ids` varchar(255) NOT NULL,
  `session` varchar(255) NOT NULL,
  `presentAddress_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_user_billing_address`
--

INSERT INTO `tbl_user_billing_address` (`id`, `name`, `email`, `address`, `city`, `country`, `zipCode`, `telephone`, `product_ids`, `session`, `presentAddress_id`) VALUES
(30, 'wretgwerg', 'gsdfgdsfg@gmail.com', 'qwefwdqwg', 'erfgqwergq', 'regrqegqer', 123532, 123521, '39', 'arashhoshyar.2022@gmail.com', NULL),
(31, 'dfvsdfv', 'sfvsdfv@gmail.com', 'sfvsfdv', 'sfvdfs', 'sdvdfvds', 2452435, 24354235, '42', 'arashhoshyar.2022@gmail.com', NULL),
(32, ' fsbvsfb', 'bsdbsd@gmail.com', 'arashhoshyarad', 'vasfvasv', 'sadvasvasd', 1235325, 13551253, '38', 'arashhoshyar.2022@gmail.com', NULL),
(33, ' fsbvsfb', 'bsdbsd@gmail.com', 'arashhoshyarad', 'vasfvasv', 'sadvasvasd', 1235325, 13551253, '38', 'arashhoshyar.2022@gmail.com', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_information`
--

CREATE TABLE `tbl_user_information` (
  `id` int UNSIGNED NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `time_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user_information`
--

INSERT INTO `tbl_user_information` (`id`, `email`, `password`, `time_added`) VALUES
(1, 'arashhoshyar.2022@gmail.com', 'f30523922153039731ce5666cfa6f3c95dd9ac47efe6ef1cb92bf6aec130ba38f89a42f88b4c1c1ce9139fae51083986905881070d36a675a0977dc91cdbd4c4', '2024-04-18 00:00:00'),
(2, 'arashhoshyar.2022@gmail.com', 'f5ffc82f909b04f410276680b55113d606a52af2ff1e510a62d838741d66491679fd1290d7c6a28ee92dfeb81e8c4725c9d4aea69f1c3963a50376b2e1a8118b', '2024-04-18 00:00:00'),
(3, 'arashhoshyar.2022@gmail.com', '35170dd06c19d8f18fa7fd023b66144d3023143b95c6233a7d07aa4ac3ad3aaa7b967c7cd22791ba071c696e0deae973c4e07fef2a52f46227516b1061272cc3', '2024-04-18 00:00:00'),
(4, 'arashhoshyar.2022@gmail.com', '35170dd06c19d8f18fa7fd023b66144d3023143b95c6233a7d07aa4ac3ad3aaa7b967c7cd22791ba071c696e0deae973c4e07fef2a52f46227516b1061272cc3', '2024-04-18 00:00:00'),
(5, 'arashhoshyar.2022@gmail.com', '35170dd06c19d8f18fa7fd023b66144d3023143b95c6233a7d07aa4ac3ad3aaa7b967c7cd22791ba071c696e0deae973c4e07fef2a52f46227516b1061272cc3', '2024-04-18 00:00:00'),
(6, 'arashhoshyar.2022@gmail.com', '35170dd06c19d8f18fa7fd023b66144d3023143b95c6233a7d07aa4ac3ad3aaa7b967c7cd22791ba071c696e0deae973c4e07fef2a52f46227516b1061272cc3', '2024-04-18 00:00:00'),
(7, 'arashhoshyar.2022@gmail.com', '35170dd06c19d8f18fa7fd023b66144d3023143b95c6233a7d07aa4ac3ad3aaa7b967c7cd22791ba071c696e0deae973c4e07fef2a52f46227516b1061272cc3', '2024-04-18 00:00:00'),
(8, 'arashhoshyar.2022@gmail.com', '35170dd06c19d8f18fa7fd023b66144d3023143b95c6233a7d07aa4ac3ad3aaa7b967c7cd22791ba071c696e0deae973c4e07fef2a52f46227516b1061272cc3', '2024-04-19 00:00:00'),
(9, 'arashhoshyar.2022@gmail.com', '35170dd06c19d8f18fa7fd023b66144d3023143b95c6233a7d07aa4ac3ad3aaa7b967c7cd22791ba071c696e0deae973c4e07fef2a52f46227516b1061272cc3', '2024-04-19 00:00:00'),
(10, 'arashhoshyar.2022@gmail.com', '35170dd06c19d8f18fa7fd023b66144d3023143b95c6233a7d07aa4ac3ad3aaa7b967c7cd22791ba071c696e0deae973c4e07fef2a52f46227516b1061272cc3', '2024-04-19 00:00:00'),
(11, 'arashhoshyar.2022@gmail.com', '8d13dd95ad55340b997f406033b12bd4664cb26a0e93c1c6b67256c08925f39c82c657f50fe56b1446de2b19ca5b74f748994cabdc440868437d9cce87a6032c', '2024-04-19 00:00:00'),
(12, 'arashhoshyar.2022@gmail.com', '35170dd06c19d8f18fa7fd023b66144d3023143b95c6233a7d07aa4ac3ad3aaa7b967c7cd22791ba071c696e0deae973c4e07fef2a52f46227516b1061272cc3', '2024-04-19 00:00:00'),
(13, 'arashhoshyar.2022@gmail.com', 'f5ffc82f909b04f410276680b55113d606a52af2ff1e510a62d838741d66491679fd1290d7c6a28ee92dfeb81e8c4725c9d4aea69f1c3963a50376b2e1a8118b', '2024-04-19 00:00:00'),
(14, 'A@gmail.com', 'f30523922153039731ce5666cfa6f3c95dd9ac47efe6ef1cb92bf6aec130ba38f89a42f88b4c1c1ce9139fae51083986905881070d36a675a0977dc91cdbd4c4', '2024-06-27 09:17:20'),
(15, 'A@gmail.com', 'f30523922153039731ce5666cfa6f3c95dd9ac47efe6ef1cb92bf6aec130ba38f89a42f88b4c1c1ce9139fae51083986905881070d36a675a0977dc91cdbd4c4', '2024-07-02 11:44:28'),
(16, 'A@gmail.com', 'f30523922153039731ce5666cfa6f3c95dd9ac47efe6ef1cb92bf6aec130ba38f89a42f88b4c1c1ce9139fae51083986905881070d36a675a0977dc91cdbd4c4', '2024-07-02 11:44:28'),
(17, 'A@gmail.com', 'f30523922153039731ce5666cfa6f3c95dd9ac47efe6ef1cb92bf6aec130ba38f89a42f88b4c1c1ce9139fae51083986905881070d36a675a0977dc91cdbd4c4', '2024-07-02 11:44:28'),
(18, 'a@gmail.com', 'f30523922153039731ce5666cfa6f3c95dd9ac47efe6ef1cb92bf6aec130ba38f89a42f88b4c1c1ce9139fae51083986905881070d36a675a0977dc91cdbd4c4', '2024-09-07 10:56:46'),
(19, 'a@gmail.com', 'f30523922153039731ce5666cfa6f3c95dd9ac47efe6ef1cb92bf6aec130ba38f89a42f88b4c1c1ce9139fae51083986905881070d36a675a0977dc91cdbd4c4', '2024-09-07 10:56:51'),
(20, 'a@gmail.com', 'f30523922153039731ce5666cfa6f3c95dd9ac47efe6ef1cb92bf6aec130ba38f89a42f88b4c1c1ce9139fae51083986905881070d36a675a0977dc91cdbd4c4', '2024-09-07 10:57:27'),
(21, 'a@gmail.com', 'f30523922153039731ce5666cfa6f3c95dd9ac47efe6ef1cb92bf6aec130ba38f89a42f88b4c1c1ce9139fae51083986905881070d36a675a0977dc91cdbd4c4', '2024-09-07 10:57:39'),
(22, 'a@gmail.com', 'f30523922153039731ce5666cfa6f3c95dd9ac47efe6ef1cb92bf6aec130ba38f89a42f88b4c1c1ce9139fae51083986905881070d36a675a0977dc91cdbd4c4', '2024-09-07 10:57:52'),
(23, 'a@gmail.com', 'f30523922153039731ce5666cfa6f3c95dd9ac47efe6ef1cb92bf6aec130ba38f89a42f88b4c1c1ce9139fae51083986905881070d36a675a0977dc91cdbd4c4', '2024-09-07 10:58:07'),
(24, 'a@gmail.com', 'f30523922153039731ce5666cfa6f3c95dd9ac47efe6ef1cb92bf6aec130ba38f89a42f88b4c1c1ce9139fae51083986905881070d36a675a0977dc91cdbd4c4', '2024-09-07 10:58:46'),
(25, 'a@gmail.com', 'f30523922153039731ce5666cfa6f3c95dd9ac47efe6ef1cb92bf6aec130ba38f89a42f88b4c1c1ce9139fae51083986905881070d36a675a0977dc91cdbd4c4', '2024-09-07 11:14:13'),
(26, 'a@gmail.com', 'f30523922153039731ce5666cfa6f3c95dd9ac47efe6ef1cb92bf6aec130ba38f89a42f88b4c1c1ce9139fae51083986905881070d36a675a0977dc91cdbd4c4', '2024-09-07 11:14:49'),
(27, 'a@gmail.com', 'f30523922153039731ce5666cfa6f3c95dd9ac47efe6ef1cb92bf6aec130ba38f89a42f88b4c1c1ce9139fae51083986905881070d36a675a0977dc91cdbd4c4', '2024-09-07 11:15:11');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_wishlist`
--

CREATE TABLE `tbl_wishlist` (
  `id` int UNSIGNED NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `sessionUser` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_wishlist`
--

INSERT INTO `tbl_wishlist` (`id`, `product_id`, `sessionUser`) VALUES
(10, '38', '2f8aa3a850a10f5519a3abfd93db545f'),
(16, '0', 'arashhoshyar.2022@gmail.com'),
(17, '0', 'arashhoshyar.2022@gmail.com'),
(18, '0', 'arashhoshyar.2022@gmail.com'),
(20, '40', 'arashhoshyar.2022@gmail.com'),
(22, '38', 'c66394f3291ca6d1ebdcbaf3fc6bd60c'),
(23, '38', 'cae88c037ef55e7bea14506bed9318ff'),
(24, '40', 'arashhoshyar.2022@gmail.com'),
(25, '43', 'arashhoshyar.2022@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_add_cart`
--
ALTER TABLE `tbl_add_cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_admin_information`
--
ALTER TABLE `tbl_admin_information`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_cart_price`
--
ALTER TABLE `tbl_cart_price`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_journey`
--
ALTER TABLE `tbl_journey`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_massage`
--
ALTER TABLE `tbl_massage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_material`
--
ALTER TABLE `tbl_material`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_media`
--
ALTER TABLE `tbl_media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_post`
--
ALTER TABLE `tbl_post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_presentAddress`
--
ALTER TABLE `tbl_presentAddress`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_product_material_category`
--
ALTER TABLE `tbl_product_material_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_product_user_cart`
--
ALTER TABLE `tbl_product_user_cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_purchase_infomation`
--
ALTER TABLE `tbl_purchase_infomation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_technical_info`
--
ALTER TABLE `tbl_technical_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_technical_info_product`
--
ALTER TABLE `tbl_technical_info_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_top_selling`
--
ALTER TABLE `tbl_top_selling`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_tourLeader_infomation`
--
ALTER TABLE `tbl_tourLeader_infomation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_tours`
--
ALTER TABLE `tbl_tours`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user_billing_address`
--
ALTER TABLE `tbl_user_billing_address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user_information`
--
ALTER TABLE `tbl_user_information`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_wishlist`
--
ALTER TABLE `tbl_wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_add_cart`
--
ALTER TABLE `tbl_add_cart`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=219;

--
-- AUTO_INCREMENT for table `tbl_admin_information`
--
ALTER TABLE `tbl_admin_information`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `tbl_cart_price`
--
ALTER TABLE `tbl_cart_price`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_journey`
--
ALTER TABLE `tbl_journey`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_massage`
--
ALTER TABLE `tbl_massage`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_material`
--
ALTER TABLE `tbl_material`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_media`
--
ALTER TABLE `tbl_media`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_post`
--
ALTER TABLE `tbl_post`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_presentAddress`
--
ALTER TABLE `tbl_presentAddress`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `tbl_product_material_category`
--
ALTER TABLE `tbl_product_material_category`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `tbl_product_user_cart`
--
ALTER TABLE `tbl_product_user_cart`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_purchase_infomation`
--
ALTER TABLE `tbl_purchase_infomation`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_technical_info`
--
ALTER TABLE `tbl_technical_info`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_technical_info_product`
--
ALTER TABLE `tbl_technical_info_product`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_top_selling`
--
ALTER TABLE `tbl_top_selling`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_tourLeader_infomation`
--
ALTER TABLE `tbl_tourLeader_infomation`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_tours`
--
ALTER TABLE `tbl_tours`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_user_billing_address`
--
ALTER TABLE `tbl_user_billing_address`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `tbl_user_information`
--
ALTER TABLE `tbl_user_information`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tbl_wishlist`
--
ALTER TABLE `tbl_wishlist`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
