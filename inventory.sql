-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 02, 2024 at 04:05 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `acc_name` varchar(200) DEFAULT NULL,
  `acc_number` varchar(200) DEFAULT NULL,
  `balance` decimal(10,0) DEFAULT NULL,
  `last_updated` date DEFAULT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(150) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `name` varchar(150) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `contact` varchar(15) DEFAULT NULL,
  `added_date` date DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `deposit`
--

CREATE TABLE `deposit` (
  `id` int(11) NOT NULL,
  `acc_name` varchar(200) DEFAULT NULL,
  `deposit_ref` varchar(150) DEFAULT NULL,
  `date_of_payment` date DEFAULT NULL,
  `amount` decimal(10,0) DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `proof` varchar(200) DEFAULT NULL,
  `created_at` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int(11) NOT NULL,
  `acc_name` varchar(150) DEFAULT NULL,
  `exp_ref` varchar(150) DEFAULT NULL,
  `date_of_payment` date DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `proof` varchar(200) DEFAULT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_method`
--

CREATE TABLE `payment_method` (
  `id` int(11) NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `created_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(150) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `product_cost` decimal(10,0) DEFAULT NULL,
  `selling_price` decimal(10,0) DEFAULT NULL,
  `supplier_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `status` varchar(10) DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `id` int(11) NOT NULL,
  `stock_id` varchar(50) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `stock_level` int(100) NOT NULL,
  `stock_alert_level_figure` int(100) NOT NULL,
  `expiry_date` date NOT NULL,
  `created_at` date NOT NULL,
  `last_updated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `name` varchar(150) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `code` varchar(15) DEFAULT NULL,
  `contact` varchar(15) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE `unit` (
  `id` int(11) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `short_name` varchar(5) DEFAULT NULL,
  `base_unit` varchar(5) DEFAULT NULL,
  `operator_value` varchar(5) DEFAULT NULL,
  `operator` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(150) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `role` varchar(30) DEFAULT NULL,
  `contact` varchar(15) DEFAULT NULL,
  `image` varchar(200) DEFAULT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `address` varchar(200) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `code` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `contact`, `image`, `date`, `address`, `status`, `code`) VALUES
(10, 'Denzal', 'ssewankamboderick@gamil.com', NULL, 'Employee', '0754532031', NULL, '1983-03-20', 'Matugga', 'Inactive', 572611),
(11, 'Renee Barlow', 'brianbariyo9@gmail.com', '$2y$10$Lyt0vwEv3Y6ZF3SK2hqwROHuPYtl6BNo34IpEbh.V.ZbYqXdZ.EbK', 'Admin', '78995522222', NULL, '1983-04-27', 'Voluptatum adipisici', 'Inactive', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `acc_name` (`acc_name`),
  ADD KEY `acc_number` (`acc_number`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`),
  ADD KEY `description` (`description`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `status` (`status`),
  ADD KEY `name` (`name`),
  ADD KEY `email` (`email`),
  ADD KEY `contact` (`contact`);

--
-- Indexes for table `deposit`
--
ALTER TABLE `deposit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `acc_name` (`acc_name`),
  ADD KEY `deposit_ref` (`deposit_ref`),
  ADD KEY `payment_method` (`payment_method`),
  ADD KEY `description` (`description`),
  ADD KEY `proof` (`proof`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exp_ref` (`exp_ref`),
  ADD KEY `description` (`description`),
  ADD KEY `proof` (`proof`);

--
-- Indexes for table `payment_method`
--
ALTER TABLE `payment_method`
  ADD PRIMARY KEY (`id`),
  ADD KEY `title` (`title`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `date` (`date`),
  ADD KEY `status` (`status`),
  ADD KEY `unit_id` (`unit_id`),
  ADD KEY `supplier_id` (`supplier_id`),
  ADD KEY `selling_price` (`selling_price`),
  ADD KEY `product_cost` (`product_cost`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `name` (`name`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stock_id` (`stock_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `stock_level` (`stock_level`),
  ADD KEY `stock_alert_level_figure` (`stock_alert_level_figure`),
  ADD KEY `expiry_date` (`expiry_date`),
  ADD KEY `created_at` (`created_at`),
  ADD KEY `last_updated` (`last_updated`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`),
  ADD KEY `name` (`name`),
  ADD KEY `email` (`email`),
  ADD KEY `contact` (`contact`),
  ADD KEY `address` (`address`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`),
  ADD KEY `short_name` (`short_name`),
  ADD KEY `base_unit` (`base_unit`),
  ADD KEY `operator_value` (`operator_value`),
  ADD KEY `operator` (`operator`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `name` (`name`),
  ADD KEY `role` (`role`),
  ADD KEY `image` (`image`),
  ADD KEY `password` (`password`),
  ADD KEY `contact` (`contact`),
  ADD KEY `address` (`address`),
  ADD KEY `status` (`status`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deposit`
--
ALTER TABLE `deposit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_method`
--
ALTER TABLE `payment_method`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `unit`
--
ALTER TABLE `unit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
