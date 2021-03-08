-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2020 at 05:28 AM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `aisle`
--

CREATE TABLE `aisle` (
  `AID` int(2) NOT NULL,
  `branch_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `aisle`
--

INSERT INTO `aisle` (`AID`, `branch_id`) VALUES
(1, 1),
(5, 1),
(3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `carries`
--

CREATE TABLE `carries` (
  `SKU` int(15) NOT NULL,
  `branch_id` int(5) NOT NULL,
  `quantity` int(5) NOT NULL,
  `on_display` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `carries`
--

INSERT INTO `carries` (`SKU`, `branch_id`, `quantity`, `on_display`) VALUES
(1000, 1, 5, 'Yes'),
(1001, 1, 5, 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `contains`
--

CREATE TABLE `contains` (
  `customer_id` int(10) NOT NULL,
  `order_id` int(10) NOT NULL,
  `SKU` int(15) NOT NULL,
  `quantity` int(5) NOT NULL,
  `cost` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contains`
--

INSERT INTO `contains` (`customer_id`, `order_id`, `SKU`, `quantity`, `cost`) VALUES
(1001, 3, 1001, 2, 100.00),
(1000, 2, 1000, 1, 10.00);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(10) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email_id` varchar(255) NOT NULL,
  `phone_no` bigint(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `first_name`, `last_name`, `username`, `password`, `email_id`, `phone_no`) VALUES
(1000, 'customer', '1', 'customer', 'customer', 'customer1@email.com', 1112223333),
(1001, 'customer', '2', 'customer2', 'c', 'customer2@email.com', 1112223333),
(1002, 'test', 't', 'test', 't', 't@email.com', 1234567890);

-- --------------------------------------------------------

--
-- Table structure for table `displayed_in`
--

CREATE TABLE `displayed_in` (
  `SKU` int(15) NOT NULL,
  `AID` int(2) NOT NULL,
  `branch_id` int(5) NOT NULL,
  `segment_of_aisle` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `displayed_in`
--

INSERT INTO `displayed_in` (`SKU`, `AID`, `branch_id`, `segment_of_aisle`) VALUES
(1000, 1, 1, 1),
(1001, 1, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `found_in`
--

CREATE TABLE `found_in` (
  `SKU` int(15) NOT NULL,
  `AID` int(2) NOT NULL,
  `branch_id` int(5) NOT NULL,
  `segment_of_aisle` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `found_in`
--

INSERT INTO `found_in` (`SKU`, `AID`, `branch_id`, `segment_of_aisle`) VALUES
(1001, 1, 1, 2),
(1000, 1, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `SKU` int(15) NOT NULL,
  `supplier_id` int(10) NOT NULL,
  `branch_id` int(5) NOT NULL,
  `quantity` int(5) NOT NULL,
  `cost` double(10,2) NOT NULL,
  `ship_date` date NOT NULL,
  `expected_receive_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`SKU`, `supplier_id`, `branch_id`, `quantity`, `cost`, `ship_date`, `expected_receive_date`) VALUES
(1001, 1001, 1, 5, 200.00, '2020-12-16', '2020-12-23'),
(1000, 1000, 1, 5, 100.00, '2020-12-26', '2020-12-29');

-- --------------------------------------------------------

--
-- Table structure for table `places_hold`
--

CREATE TABLE `places_hold` (
  `customer_id` int(10) NOT NULL,
  `SKU` int(15) NOT NULL,
  `quantity` int(5) NOT NULL,
  `date_placed` date NOT NULL,
  `date_released` date NOT NULL,
  `price` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `places_hold`
--

INSERT INTO `places_hold` (`customer_id`, `SKU`, `quantity`, `date_placed`, `date_released`, `price`) VALUES
(1000, 1000, 2, '2020-12-10', '2020-12-17', 10.00),
(1001, 1001, 2, '2020-12-07', '2020-12-14', 200.00);

-- --------------------------------------------------------

--
-- Table structure for table `product_type`
--

CREATE TABLE `product_type` (
  `SKU` int(15) NOT NULL,
  `type` text NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `additional_info` text NOT NULL,
  `UPC` bigint(20) NOT NULL,
  `regular_price` double(10,2) NOT NULL,
  `sale_price` double(10,2) NOT NULL,
  `club_price` double(10,2) NOT NULL,
  `quantity` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_type`
--

INSERT INTO `product_type` (`SKU`, `type`, `name`, `description`, `additional_info`, `UPC`, `regular_price`, `sale_price`, `club_price`, `quantity`) VALUES
(1000, 'General Tools', 'Hammer', 'Hammers objects', 'General', 1111, 10.00, 8.00, 6.00, 15),
(1001, 'General Tools', 'Drill', 'Drills holes', 'Stanley', 1112, 50.00, 45.00, 40.00, 10);

-- --------------------------------------------------------

--
-- Table structure for table `sales_associate`
--

CREATE TABLE `sales_associate` (
  `SID` int(10) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `section` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales_associate`
--

INSERT INTO `sales_associate` (`SID`, `first_name`, `last_name`, `username`, `password`, `section`) VALUES
(1000, 'Admin', 'User', 'admin', 'admin', 'Manager'),
(1001, 'Dave', 'Smith', 'dave', 'dave', 'General Tools');

-- --------------------------------------------------------

--
-- Table structure for table `ships_from`
--

CREATE TABLE `ships_from` (
  `customer_id` int(10) NOT NULL,
  `order_id` int(10) NOT NULL,
  `branch_id` int(5) NOT NULL,
  `ship_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ships_from`
--

INSERT INTO `ships_from` (`customer_id`, `order_id`, `branch_id`, `ship_date`) VALUES
(1000, 2, 1, '2020-12-11'),
(1001, 3, 2, '2020-12-13');

-- --------------------------------------------------------

--
-- Table structure for table `ship_to`
--

CREATE TABLE `ship_to` (
  `customer_id` int(10) NOT NULL,
  `order_id` int(10) NOT NULL,
  `branch_id` int(5) NOT NULL,
  `receive_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ship_to`
--

INSERT INTO `ship_to` (`customer_id`, `order_id`, `branch_id`, `receive_date`) VALUES
(1000, 2, 1, '2020-12-13'),
(1001, 3, 2, '2020-12-14');

-- --------------------------------------------------------

--
-- Table structure for table `store_branch`
--

CREATE TABLE `store_branch` (
  `branch_id` int(5) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_no` bigint(15) NOT NULL,
  `province` varchar(50) NOT NULL,
  `city` varchar(100) NOT NULL,
  `street_no` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `store_branch`
--

INSERT INTO `store_branch` (`branch_id`, `email`, `phone_no`, `province`, `city`, `street_no`) VALUES
(1, 'mainbranch@email.com', 4034573537, 'Alberta', 'Calgary', '1'),
(2, 'branch2@email.com', 4034573537, 'Alberta', 'Calgary', '2');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone_no` bigint(15) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `name`, `phone_no`, `email`) VALUES
(1000, 'Stanley', 1112223333, 'stanley@email.com'),
(1001, 'Bosch', 1112223333, 'bosch@email.com');

-- --------------------------------------------------------

--
-- Table structure for table `transfer_order`
--

CREATE TABLE `transfer_order` (
  `customer_id` int(10) NOT NULL,
  `order_id` int(10) NOT NULL,
  `date_ordered` date NOT NULL,
  `invoiced` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transfer_order`
--

INSERT INTO `transfer_order` (`customer_id`, `order_id`, `date_ordered`, `invoiced`) VALUES
(1000, 2, '2020-12-09', 'yes'),
(1000, 3, '2020-12-09', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `works_for`
--

CREATE TABLE `works_for` (
  `branch_id` int(5) NOT NULL,
  `SID` int(10) NOT NULL,
  `shift` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `works_for`
--

INSERT INTO `works_for` (`branch_id`, `SID`, `shift`) VALUES
(2, 1001, 'Mon, Wed, Fri\r\n10am to 5pm'),
(1, 1000, 'Tue, Thur\r\n12pm to 8pm');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aisle`
--
ALTER TABLE `aisle`
  ADD PRIMARY KEY (`AID`),
  ADD KEY `branch_id` (`branch_id`);

--
-- Indexes for table `carries`
--
ALTER TABLE `carries`
  ADD KEY `SKU` (`SKU`),
  ADD KEY `branch_id` (`branch_id`);

--
-- Indexes for table `contains`
--
ALTER TABLE `contains`
  ADD KEY `order_id` (`order_id`),
  ADD KEY `SKU` (`SKU`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `displayed_in`
--
ALTER TABLE `displayed_in`
  ADD KEY `SKU` (`SKU`),
  ADD KEY `AID` (`AID`),
  ADD KEY `branch_id` (`branch_id`);

--
-- Indexes for table `found_in`
--
ALTER TABLE `found_in`
  ADD KEY `SKU` (`SKU`),
  ADD KEY `AID` (`AID`),
  ADD KEY `branch_id` (`branch_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD KEY `SKU` (`SKU`),
  ADD KEY `supplier_id` (`supplier_id`),
  ADD KEY `branch_id` (`branch_id`);

--
-- Indexes for table `places_hold`
--
ALTER TABLE `places_hold`
  ADD UNIQUE KEY `customer_id_2` (`customer_id`),
  ADD KEY `SKU` (`SKU`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `product_type`
--
ALTER TABLE `product_type`
  ADD PRIMARY KEY (`SKU`);

--
-- Indexes for table `sales_associate`
--
ALTER TABLE `sales_associate`
  ADD PRIMARY KEY (`SID`);

--
-- Indexes for table `ships_from`
--
ALTER TABLE `ships_from`
  ADD KEY `order_id` (`order_id`),
  ADD KEY `branch_id` (`branch_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `ship_to`
--
ALTER TABLE `ship_to`
  ADD KEY `order_id` (`order_id`),
  ADD KEY `branch_id` (`branch_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `store_branch`
--
ALTER TABLE `store_branch`
  ADD PRIMARY KEY (`branch_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transfer_order`
--
ALTER TABLE `transfer_order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `works_for`
--
ALTER TABLE `works_for`
  ADD KEY `branch_id` (`branch_id`),
  ADD KEY `SID` (`SID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aisle`
--
ALTER TABLE `aisle`
  MODIFY `AID` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1005;

--
-- AUTO_INCREMENT for table `product_type`
--
ALTER TABLE `product_type`
  MODIFY `SKU` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1004;

--
-- AUTO_INCREMENT for table `sales_associate`
--
ALTER TABLE `sales_associate`
  MODIFY `SID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1002;

--
-- AUTO_INCREMENT for table `store_branch`
--
ALTER TABLE `store_branch`
  MODIFY `branch_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1004;

--
-- AUTO_INCREMENT for table `transfer_order`
--
ALTER TABLE `transfer_order`
  MODIFY `order_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `aisle`
--
ALTER TABLE `aisle`
  ADD CONSTRAINT `AISLE_ibfk_1` FOREIGN KEY (`branch_id`) REFERENCES `store_branch` (`branch_id`);

--
-- Constraints for table `carries`
--
ALTER TABLE `carries`
  ADD CONSTRAINT `CARRIES_ibfk_1` FOREIGN KEY (`SKU`) REFERENCES `product_type` (`SKU`),
  ADD CONSTRAINT `CARRIES_ibfk_2` FOREIGN KEY (`branch_id`) REFERENCES `store_branch` (`branch_id`);

--
-- Constraints for table `contains`
--
ALTER TABLE `contains`
  ADD CONSTRAINT `CONTAINS_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `transfer_order` (`order_id`),
  ADD CONSTRAINT `CONTAINS_ibfk_3` FOREIGN KEY (`SKU`) REFERENCES `product_type` (`SKU`),
  ADD CONSTRAINT `CONTAINS_ibfk_4` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`);

--
-- Constraints for table `displayed_in`
--
ALTER TABLE `displayed_in`
  ADD CONSTRAINT `DISPLAYED_IN_ibfk_1` FOREIGN KEY (`SKU`) REFERENCES `product_type` (`SKU`),
  ADD CONSTRAINT `DISPLAYED_IN_ibfk_2` FOREIGN KEY (`AID`) REFERENCES `aisle` (`AID`),
  ADD CONSTRAINT `DISPLAYED_IN_ibfk_3` FOREIGN KEY (`branch_id`) REFERENCES `store_branch` (`branch_id`);

--
-- Constraints for table `found_in`
--
ALTER TABLE `found_in`
  ADD CONSTRAINT `FOUND_IN_ibfk_1` FOREIGN KEY (`SKU`) REFERENCES `product_type` (`SKU`),
  ADD CONSTRAINT `FOUND_IN_ibfk_2` FOREIGN KEY (`AID`) REFERENCES `aisle` (`AID`),
  ADD CONSTRAINT `FOUND_IN_ibfk_3` FOREIGN KEY (`branch_id`) REFERENCES `store_branch` (`branch_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `ORDERS_ibfk_1` FOREIGN KEY (`SKU`) REFERENCES `product_type` (`SKU`),
  ADD CONSTRAINT `ORDERS_ibfk_2` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`),
  ADD CONSTRAINT `ORDERS_ibfk_3` FOREIGN KEY (`branch_id`) REFERENCES `store_branch` (`branch_id`);

--
-- Constraints for table `places_hold`
--
ALTER TABLE `places_hold`
  ADD CONSTRAINT `PLACES_HOLD_ibfk_2` FOREIGN KEY (`SKU`) REFERENCES `product_type` (`SKU`),
  ADD CONSTRAINT `PLACES_HOLD_ibfk_3` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`);

--
-- Constraints for table `ships_from`
--
ALTER TABLE `ships_from`
  ADD CONSTRAINT `SHIPS_FROM_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `transfer_order` (`order_id`),
  ADD CONSTRAINT `SHIPS_FROM_ibfk_3` FOREIGN KEY (`branch_id`) REFERENCES `store_branch` (`branch_id`),
  ADD CONSTRAINT `SHIPS_FROM_ibfk_4` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`);

--
-- Constraints for table `ship_to`
--
ALTER TABLE `ship_to`
  ADD CONSTRAINT `SHIP_TO_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `transfer_order` (`order_id`),
  ADD CONSTRAINT `SHIP_TO_ibfk_3` FOREIGN KEY (`branch_id`) REFERENCES `store_branch` (`branch_id`),
  ADD CONSTRAINT `SHIP_TO_ibfk_4` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`);

--
-- Constraints for table `transfer_order`
--
ALTER TABLE `transfer_order`
  ADD CONSTRAINT `TRANSFER_ORDER_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`);

--
-- Constraints for table `works_for`
--
ALTER TABLE `works_for`
  ADD CONSTRAINT `WORKS_FOR_ibfk_1` FOREIGN KEY (`branch_id`) REFERENCES `store_branch` (`branch_id`),
  ADD CONSTRAINT `WORKS_FOR_ibfk_2` FOREIGN KEY (`SID`) REFERENCES `sales_associate` (`SID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
