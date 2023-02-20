-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 20, 2023 at 03:28 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `coslem`
--

-- --------------------------------------------------------

--
-- Table structure for table `annual`
--

CREATE TABLE `annual` (
  `id` int(11) NOT NULL,
  `share` int(11) NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `created_by` int(11) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'ACTIVE',
  `timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `annual`
--

INSERT INTO `annual` (`id`, `share`, `from_date`, `to_date`, `created_by`, `status`, `timestamp`) VALUES
(1, 200, '2022-11-01', '2023-01-01', 1, 'ACTIVE', '2021-11-18 15:33:38');

-- --------------------------------------------------------

--
-- Table structure for table `funds`
--

CREATE TABLE `funds` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `balance` int(11) NOT NULL DEFAULT 0,
  `contribution` int(11) NOT NULL DEFAULT 0,
  `available` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `funds`
--

INSERT INTO `funds` (`id`, `user_id`, `balance`, `contribution`, `available`) VALUES
(5, '5', 11000, 2100, 2300),
(6, '6', 500, 2000, 5500),
(7, '7', 1800, 900, 900),
(8, '10', 0, 400, 1200);

-- --------------------------------------------------------

--
-- Table structure for table `loan`
--

CREATE TABLE `loan` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `monthly` int(11) NOT NULL,
  `months_paid` int(11) NOT NULL,
  `months_period` int(11) NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'PENDING',
  `isactive` varchar(255) NOT NULL DEFAULT 'ACTIVE',
  `requested_by` int(11) NOT NULL,
  `approve_by` int(11) DEFAULT NULL,
  `remaining_balance` int(11) NOT NULL,
  `total_loan_amount` int(11) NOT NULL,
  `interest` int(11) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `loan`
--

INSERT INTO `loan` (`id`, `user_id`, `amount`, `monthly`, `months_paid`, `months_period`, `from_date`, `to_date`, `remarks`, `status`, `isactive`, `requested_by`, `approve_by`, `remaining_balance`, `total_loan_amount`, `interest`, `timestamp`) VALUES
(4, 5, 6000, 1575, 0, 4, '2022-02-01', '2022-04-30', 'TEST', 'APPROVED', 'ACTIVE', 1, 1, 6300, 6300, 300, '2022-01-13 11:35:18'),
(5, 6, 500, 131, 0, 4, '2023-03-01', '2023-06-03', 'pautang po lods', 'APPROVED', 'ACTIVE', 6, 1, 525, 525, 25, '2023-02-08 08:55:29'),
(6, 5, 5000, 583, 0, 9, '2023-03-01', '2023-11-03', 'test', 'APPROVED', 'ACTIVE', 5, 1, 5250, 5250, 250, '2023-02-08 09:01:03'),
(7, 7, 800, 84, 0, 10, '2023-03-01', '2023-12-03', 'pautang po lods', 'APPROVED', 'ACTIVE', 7, 1, 840, 840, 40, '2023-02-12 07:11:15'),
(8, 7, 100, 15, 0, 7, '2023-03-01', '2023-09-03', 'test', 'DISAPPROVED', 'ACTIVE', 7, NULL, 105, 105, 5, '2023-02-12 23:30:23'),
(9, 7, 100, 12, 0, 9, '2023-03-01', '2023-11-03', 'pautang po lods', 'APPROVED', 'ACTIVE', 7, 1, 105, 105, 5, '2023-02-12 23:31:24'),
(10, 7, 900, 105, 0, 9, '2023-03-01', '2023-11-03', 'pautang po lods', 'APPROVED', 'ACTIVE', 7, 1, 945, 945, 45, '2023-02-12 23:58:04'),
(11, 10, 1000, 210, 0, 5, '2023-03-01', '2023-07-03', 'pautang lods', 'PENDING', 'ACTIVE', 10, NULL, 1050, 1050, 50, '2023-02-20 20:26:49');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `base_id` int(11) DEFAULT NULL,
  `amount` int(11) NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'PENDING',
  `type` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `approve_by` int(11) DEFAULT NULL,
  `delete` int(11) NOT NULL DEFAULT 0,
  `file_id` int(11) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `base_id`, `amount`, `remarks`, `status`, `type`, `created_by`, `approve_by`, `delete`, `file_id`, `timestamp`) VALUES
(35, 7, NULL, 1000, 'test', 'APPROVED', 'Loan', 1, NULL, 0, 7, '2023-02-01 00:00:00'),
(36, 7, NULL, 100, 'Members Approved Loan', 'APPROVED', 'Loan', 7, 1, 0, 10, '2023-02-12 23:31:43'),
(37, 5, NULL, 100, 'mag bayad kana', 'APPROVED', 'Contribution', 1, NULL, 0, 0, '2023-04-01 00:00:00'),
(38, 7, NULL, 100, 'mag bayad kana', 'APPROVED', 'Contribution', 1, NULL, 0, 8, '2023-03-01 00:00:00'),
(39, 7, NULL, 500, 'test', 'APPROVED', 'Contribution', 1, NULL, 0, 9, '2023-03-02 00:00:00'),
(40, 5, NULL, 500, 'mag bayad kana', 'APPROVED', 'Contribution', 1, 1, 0, 0, '2023-03-01 00:00:00'),
(41, 7, NULL, 900, 'Members Approved Loan', 'APPROVED', 'Loan', 7, 1, 0, 0, '2023-02-12 23:58:46'),
(42, 7, NULL, 1000, 'magbayad kana', 'APPROVED', 'Loan', 1, NULL, 0, 11, '2023-04-05 00:00:00'),
(43, 7, NULL, 1000, 'magbayad kana', 'APPROVED', 'Loan', 1, NULL, 0, 12, '2023-05-01 00:00:00'),
(44, 10, NULL, 400, 'Member Contribution', 'APPROVED', 'Contribution', 10, 1, 0, 0, '2023-02-20 17:27:55');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_files`
--

CREATE TABLE `transaction_files` (
  `id` int(11) NOT NULL,
  `base_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `file_link` varchar(255) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_type` varchar(255) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction_files`
--

INSERT INTO `transaction_files` (`id`, `base_id`, `user_id`, `file_link`, `file_name`, `file_type`, `timestamp`) VALUES
(4, 14, 5, '117943099_1088445701557853_3091277158760663503_o1.jpg', '117943099_1088445701557853_3091277158760663503_o.jpg', 'image/jpeg', '2022-01-13 11:10:35'),
(5, 15, 5, '121660512_5251411661539240_3748944721897136565_o.jpg', '121660512_5251411661539240_3748944721897136565_o.jpg', 'image/jpeg', '2022-01-13 11:18:19'),
(6, 12, 5, '121648285_5251411688205904_378163402100567756_o.jpg', '121648285_5251411688205904_378163402100567756_o.jpg', 'image/jpeg', '2022-01-13 11:18:23'),
(7, 35, 7, '1.jpg', '1.jpg', 'image/jpeg', '2023-02-12 23:25:56'),
(8, 38, 7, '324384169_425979999662085_5781915157834793723_n.jpg', '324384169_425979999662085_5781915157834793723_n.jpg', 'image/jpeg', '2023-02-12 23:36:26'),
(9, 39, 7, '11.jpg', '1.jpg', 'image/jpeg', '2023-02-12 23:40:39'),
(10, 36, 7, '12.jpg', '1.jpg', 'image/jpeg', '2023-02-12 23:55:36'),
(11, 42, 7, '13.jpg', '1.jpg', 'image/jpeg', '2023-02-13 00:05:08'),
(12, 43, 7, '14.jpg', '1.jpg', 'image/jpeg', '2023-02-13 00:08:26');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `contribution` int(11) NOT NULL DEFAULT 0,
  `share` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT '',
  `type` varchar(255) NOT NULL DEFAULT 'user',
  `username` varchar(255) NOT NULL,
  `image_link` varchar(255) DEFAULT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `address`, `age`, `contribution`, `share`, `email`, `mobile`, `gender`, `status`, `type`, `username`, `image_link`, `timestamp`) VALUES
(1, 'Admin ', '0cc175b9c0f1b6a831c399e269772661', '71 Dagat-dagatan', 18, 0, 0, 'raivenm280@gmail.com', '09292470145', 'Male', 'Active', 'admin', 'admin', NULL, '2021-11-18 03:06:41'),
(2, 'tresue', '0cc175b9c0f1b6a831c399e269772661', '62 Marulas B Caloocan City', 20, 0, 0, 'raivenm280@gmail.com', '09292470145', 'Male', 'Verified', 'treasurer', 'treasurer1', NULL, '2021-11-18 03:18:12'),
(5, 'raiven', '0cc175b9c0f1b6a831c399e269772661', '62 Marulas B Caloocan City', 15, 2000, 10, 'raivenm280@gmail.com', '09292470145', 'Male', 'Verified', 'member', 'raivenm', '117943099_1088445701557853_3091277158760663503_o2.jpg', '2021-11-18 03:48:42'),
(7, 'Ruben', '0cc175b9c0f1b6a831c399e269772661', 'D15 Blk48 lot12 pandacaqui', 43, 300, 0, 'raivenm280@gmail.com', '09292470145', 'Male', 'Verified', 'member', 'ruben', NULL, '2023-02-12 07:07:36'),
(10, 'mama', '0cc175b9c0f1b6a831c399e269772661', 'D15 Blk48 lot12 pandacaqui', 31, 400, 0, 'mama@gmail.com', '09292470145', 'Male', 'Verified', 'member', 'mama', NULL, '2023-02-20 17:27:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `annual`
--
ALTER TABLE `annual`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `funds`
--
ALTER TABLE `funds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan`
--
ALTER TABLE `loan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_files`
--
ALTER TABLE `transaction_files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `annual`
--
ALTER TABLE `annual`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `funds`
--
ALTER TABLE `funds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `loan`
--
ALTER TABLE `loan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `transaction_files`
--
ALTER TABLE `transaction_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
