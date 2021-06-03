-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2021 at 04:09 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `atm_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `account_id` int(10) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `account_name` varchar(50) NOT NULL,
  `account_balance` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`account_id`, `customer_id`, `account_name`, `account_balance`) VALUES
(1, 1, 'bank', '40123.00'),
(2, 2, 'debit', '7456.00');

-- --------------------------------------------------------

--
-- Table structure for table `atm_machine`
--

CREATE TABLE `atm_machine` (
  `atm_id` int(3) NOT NULL,
  `money_balance` decimal(10,2) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `atm_machine`
--

INSERT INTO `atm_machine` (`atm_id`, `money_balance`) VALUES
(1, '20000.00');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(10) NOT NULL,
  `customer_first_name` varchar(255) NOT NULL,
  `customer_last_name` varchar(255) NOT NULL,
  `customer_address` varchar(255) NOT NULL,
  `customer_phone` varchar(20) NOT NULL,
  `customer_email` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `customer_first_name`, `customer_last_name`, `customer_address`, `customer_phone`, `customer_email`) VALUES
(1, 'Michael ', 'Jackson', '--', '312321312', '-'),
(2, 'Bill', 'Gates', '-', '21312', '-');

-- --------------------------------------------------------

--
-- Table structure for table `customers_cards`
--

CREATE TABLE `customers_cards` (
  `card_number` varchar(20) NOT NULL,
  `card_password` int(8) NOT NULL,
  `account_id` int(10) NOT NULL,
  `date_valid_from` date NOT NULL,
  `date_valid_to` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers_cards`
--

INSERT INTO `customers_cards` (`card_number`, `card_password`, `account_id`, `date_valid_from`, `date_valid_to`) VALUES
('1234-1234-1234-1234', 1234, 2, '2020-12-31', '2025-12-31'),
('5211-0345-5432-7657', 4321, 1, '2021-05-31', '2024-05-31');

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

CREATE TABLE `manager` (
  `manager_full_name` varchar(50) NOT NULL,
  `manager_pw` varchar(6) NOT NULL,
  `manager_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `manager`
--

INSERT INTO `manager` (`manager_full_name`, `manager_pw`, `manager_id`) VALUES
('Ali', '8208', 2);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `transaction_id` int(10) NOT NULL,
  `transaction_amount` decimal(10,2) NOT NULL,
  `account_id_fk` int(10) DEFAULT NULL,
  `atm_id_fk` int(3) NOT NULL,
  `transaction_date` date DEFAULT current_timestamp(),
  `transaction_type` varchar(10) DEFAULT NULL,
  `manager_fullname_fk` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`account_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `atm_machine`
--
ALTER TABLE `atm_machine`
  ADD PRIMARY KEY (`atm_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `customers_cards`
--
ALTER TABLE `customers_cards`
  ADD PRIMARY KEY (`card_number`),
  ADD KEY `account_id` (`account_id`);

--
-- Indexes for table `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`manager_id`),
  ADD KEY `manager_full_name` (`manager_full_name`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `atm_id_fk` (`atm_id_fk`),
  ADD KEY `account_id_fk` (`account_id_fk`),
  ADD KEY `manager_fullname_fk` (`manager_fullname_fk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `account_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `manager`
--
ALTER TABLE `manager`
  MODIFY `manager_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transaction_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accounts`
--
ALTER TABLE `accounts`
  ADD CONSTRAINT `accounts_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`);

--
-- Constraints for table `customers_cards`
--
ALTER TABLE `customers_cards`
  ADD CONSTRAINT `customers_cards_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`account_id`);

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `manager_fullname_fk` FOREIGN KEY (`manager_fullname_fk`) REFERENCES `manager` (`manager_full_name`),
  ADD CONSTRAINT `transactions_ibfk_2` FOREIGN KEY (`atm_id_fk`) REFERENCES `atm_machine` (`atm_id`),
  ADD CONSTRAINT `transactions_ibfk_3` FOREIGN KEY (`account_id_fk`) REFERENCES `accounts` (`account_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
