-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2015 at 12:24 PM
-- Server version: 5.6.26
-- PHP Version: 5.5.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `invent`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

CREATE TABLE IF NOT EXISTS `administrator` (
  `id` int(10) unsigned NOT NULL,
  `username` varchar(120) NOT NULL,
  `password` varchar(120) NOT NULL,
  `user_type` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `administrator`
--


-- --------------------------------------------------------

--
-- Table structure for table `billers`
--

CREATE TABLE IF NOT EXISTS `billers` (
  `id` int(11) NOT NULL,
  `name` varchar(55) NOT NULL,
  `company` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(55) NOT NULL,
  `state` varchar(55) NOT NULL,
  `postal_code` varchar(8) NOT NULL,
  `country` varchar(55) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `logo` varchar(100) NOT NULL,
  `invoice_footer` varchar(1000) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `billers`
--

INSERT INTO `billers` (`id`, `name`, `company`, `address`, `city`, `state`, `postal_code`, `country`, `phone`, `email`, `logo`, `invoice_footer`) VALUES
(1, 'Mian Saleem', 'Tecdiary IT Solutions', 'Address', 'City', 'Sate', '0000', 'Malaysia', '012345678', 'saleem@tecdairy.com', 'logo.png', '');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(55) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Supper'),
(2, 'Other');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(55) NOT NULL,
  `company` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(55) NOT NULL,
  `state` varchar(55) NOT NULL,
  `postal_code` varchar(8) NOT NULL,
  `country` varchar(55) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `company`, `address`, `city`, `state`, `postal_code`, `country`, `phone`, `email`) VALUES
(2, 'Arfan Ali', 'test', 'street 6', 'Lahore', 'Punjab', '54000', 'Pakistan', '03005095213', 'arfan67@gmail.com'),
(3, ' Ali', 'tst', 'street 6', 'Lahore', 'Punjab', '54000', 'Pakistan', '03005095213', 'arfan67@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL,
  `code` varchar(50) NOT NULL,
  `name` char(255) NOT NULL,
  `unit` varchar(50) DEFAULT NULL,
  `size` varchar(55) NOT NULL,
  `cost` decimal(25,2) DEFAULT NULL,
  `price` decimal(25,2) NOT NULL,
  `purchase_price` double(10,2) DEFAULT NULL,
  `image` varchar(255) DEFAULT 'no_image.jpg',
  `category_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `tax_rate` int(11) DEFAULT NULL,
  `track_quantity` tinyint(4) DEFAULT '1',
  `details` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `code`, `name`, `unit`, `size`, `cost`, `price`, `purchase_price`, `image`, `category_id`, `quantity`, `tax_rate`, `track_quantity`, `details`) VALUES
(1, 'P1', 'Drink', '50', '250ml', '20.00', '22.00', 20.00, 'no_image.jpg', 0, 2, 1, 1, ''),
(2, 'A11', 'Coca-Cola', '50', '250ml', '20.00', '22.00', 20.00, 'no_image.jpg', 1, 230, 3, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE IF NOT EXISTS `purchases` (
  `id` int(11) NOT NULL,
  `bill_no` varchar(55) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `create_date` date NOT NULL,
  `credit_days` int(10) NOT NULL,
  `note` varchar(1000) DEFAULT NULL,
  `inv_total` decimal(25,2) NOT NULL,
  `total_tax` decimal(25,2) DEFAULT NULL,
  `total` decimal(25,2) NOT NULL,
  `invoice_type` int(11) DEFAULT NULL,
  `inv_discount` decimal(25,2) DEFAULT NULL,
  `user` varchar(255) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `paid` decimal(25,2) DEFAULT NULL,
  `paid_by` enum('cash','cheque') NOT NULL,
  `cheque_no` varchar(20) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`id`, `bill_no`, `supplier_id`, `create_date`, `credit_days`, `note`, `inv_total`, `total_tax`, `total`, `invoice_type`, `inv_discount`, `user`, `updated_by`, `paid`, `paid_by`, `cheque_no`) VALUES
(1, 'test', 1, '2015-11-03', 0, '   ', '0.00', '0.00', '60.00', NULL, '0.00', NULL, NULL, '0.00', 'cash', '0'),
(2, 'fds', 1, '2015-11-01', 0, ' ', '0.00', '0.00', '920.00', NULL, '0.00', NULL, NULL, '0.00', 'cash', ''),
(3, 'ABCD', 1, '2015-10-08', 0, ' ', '0.00', '0.00', '2200.00', NULL, '0.00', NULL, NULL, '0.00', 'cash', '');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_items`
--

CREATE TABLE IF NOT EXISTS `purchase_items` (
  `id` int(11) NOT NULL,
  `purchase_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` decimal(25,2) NOT NULL,
  `gross_total` decimal(25,2) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `purchase_items`
--

INSERT INTO `purchase_items` (`id`, `purchase_id`, `product_id`, `quantity`, `unit_price`, `gross_total`, `create_date`) VALUES
(3, 1, 1, 1, '20.00', '20.00', '2015-11-10 03:44:48'),
(4, 1, 2, 2, '20.00', '40.00', '2015-11-10 03:44:48'),
(5, 2, 1, 45, '20.00', '900.00', '2015-11-10 07:45:26'),
(6, 2, 2, 1, '20.00', '20.00', '2015-11-10 07:45:26'),
(7, 3, 1, 100, '20.00', '2000.00', '2015-11-10 07:49:25'),
(8, 3, 2, 10, '20.00', '200.00', '2015-11-10 07:49:25');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE IF NOT EXISTS `sales` (
  `id` int(11) NOT NULL,
  `bill_no` varchar(55) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(55) NOT NULL,
  `create_date` date NOT NULL,
  `credit_days` int(10) NOT NULL,
  `note` varchar(1000) DEFAULT NULL,
  `inv_total` decimal(25,2) NOT NULL,
  `total_tax` decimal(25,2) DEFAULT NULL,
  `total` decimal(25,2) NOT NULL,
  `invoice_type` int(11) DEFAULT NULL,
  `inv_discount` decimal(25,2) DEFAULT NULL,
  `user` varchar(255) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `paid` decimal(25,2) DEFAULT NULL,
  `paid_by` enum('cash','cheque') NOT NULL,
  `cheque_no` varchar(20) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `bill_no`, `customer_id`, `customer_name`, `create_date`, `credit_days`, `note`, `inv_total`, `total_tax`, `total`, `invoice_type`, `inv_discount`, `user`, `updated_by`, `paid`, `paid_by`, `cheque_no`) VALUES
(7, 'ABC', 3, ' Ali', '2015-11-03', 10, '     this isi a test ntoe                 ', '0.00', '1000.00', '6114.00', NULL, '100.00', NULL, NULL, '6114.00', 'cheque', '4242424242'),
(8, 'ABC123', 2, 'Arfan Ali', '2015-11-03', 0, '   this is a test note   ', '0.00', '0.00', '154.00', NULL, '0.00', NULL, NULL, '154.00', 'cash', '0'),
(9, '6757656', 3, ' Ali', '0000-00-00', 0, ' fgfd', '0.00', '0.00', '264.00', NULL, '0.00', NULL, NULL, '264.00', 'cash', ''),
(10, '78687', 2, 'Arfan Ali', '0000-00-00', 0, ' ', '0.00', '0.00', '220.00', NULL, '0.00', NULL, NULL, '0.00', 'cash', ''),
(11, 'fds', 2, 'Arfan Ali', '2015-11-03', 12, '   ', '0.00', '0.00', '286.00', NULL, '0.00', NULL, NULL, '0.00', 'cash', '0');

-- --------------------------------------------------------

--
-- Table structure for table `sale_items`
--

CREATE TABLE IF NOT EXISTS `sale_items` (
  `id` int(11) NOT NULL,
  `sale_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_code` varchar(55) NOT NULL,
  `product_unit` varchar(20) NOT NULL,
  `tax` varchar(55) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` decimal(25,2) NOT NULL,
  `gross_total` decimal(25,2) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sale_items`
--

INSERT INTO `sale_items` (`id`, `sale_id`, `product_id`, `product_name`, `product_code`, `product_unit`, `tax`, `quantity`, `unit_price`, `gross_total`, `create_date`) VALUES
(31, 9, 1, '', '', '', NULL, 10, '22.00', '220.00', '2015-08-26 22:54:36'),
(32, 9, 2, '', '', '', NULL, 2, '22.00', '44.00', '2015-08-26 22:54:36'),
(33, 10, 2, '', '', '', NULL, 8, '22.00', '176.00', '2015-08-26 22:57:05'),
(34, 10, 1, '', '', '', NULL, 2, '22.00', '44.00', '2015-08-26 22:57:05'),
(41, 8, 1, 'Drink', 'P1', '50', NULL, 2, '22.00', '44.00', '2015-11-03 05:12:16'),
(42, 8, 2, 'Coca-Cola', 'A11', '50', NULL, 230, '22.00', '5060.00', '2015-11-03 05:12:16'),
(47, 7, 1, 'Drink', 'P1', '50', NULL, 2, '22.00', '44.00', '2015-11-03 05:27:24'),
(48, 7, 2, 'Coca-Cola', 'A11', '50', NULL, 230, '22.00', '5060.00', '2015-11-03 05:27:24'),
(51, 11, 1, 'Drink', 'P1', '50', NULL, 12, '22.00', '264.00', '2015-11-03 07:37:48'),
(52, 11, 2, 'Coca-Cola', 'A11', '50', NULL, 1, '22.00', '22.00', '2015-11-03 07:37:48');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE IF NOT EXISTS `suppliers` (
  `id` int(11) NOT NULL,
  `name` varchar(55) NOT NULL,
  `company` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(55) NOT NULL,
  `state` varchar(55) NOT NULL,
  `postal_code` varchar(8) NOT NULL,
  `country` varchar(55) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `company`, `address`, `city`, `state`, `postal_code`, `country`, `phone`, `email`) VALUES
(1, 'Test Supplier edit', 'test', 'Supplier Addressedit', 'Petaling Jaya edit', 'Selangor edit', '46050', 'Malaysia', '0123456789', 'supplier@tecdiary.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrator`
--
ALTER TABLE `administrator`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `billers`
--
ALTER TABLE `billers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_2` (`id`),
  ADD KEY `category_id_2` (`category_id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `purchase_items`
--
ALTER TABLE `purchase_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sale_id` (`purchase_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `sale_items`
--
ALTER TABLE `sale_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sale_id` (`sale_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrator`
--
ALTER TABLE `administrator`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `billers`
--
ALTER TABLE `billers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `purchase_items`
--
ALTER TABLE `purchase_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `sale_items`
--
ALTER TABLE `sale_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=53;
--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
