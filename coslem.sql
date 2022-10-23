-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 13, 2022 at 07:07 AM
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
-- Database: `comsca`
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
(1, 200, '2021-11-01', '2023-01-01', 1, 'ACTIVE', '2021-11-18 15:33:38');

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
(5, '5', 6000, 2000, 0);

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
(4, 5, 6000, 1575, 0, 4, '2022-02-01', '2022-04-30', 'TEST', 'APPROVED', 'ACTIVE', 1, 1, 6300, 6300, 300, '2022-01-13 11:35:18');

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
(12, 5, NULL, 2000, 'Member Contribution', 'APPROVED', 'Contribution', 5, 1, 0, 6, '2021-11-30 03:38:57'),
(14, 5, NULL, 2000, 'Members Monthly Saving', 'APPROVED', 'Contribution', 1, 1, 0, 4, '2022-01-12 23:20:44'),
(16, 5, NULL, 6000, 'Members Approved Loan', 'APPROVED', 'Loan', 5, 1, 0, 0, '2022-01-13 11:35:58'),
(17, 5, NULL, 2000, 'Test', 'APPROVED', 'Contribution', 1, 1, 0, 0, '2021-12-01 00:00:00'),
(18, 5, NULL, 2000, 'TEST', 'APPROVED', 'Contribution', 1, NULL, 0, 0, '2022-02-01 00:00:00'),
(19, 5, NULL, 2000, 'test', 'APPROVED', 'Contribution', 1, 1, 0, 0, '2022-03-01 00:00:00'),
(20, 5, NULL, 2000, 'TEST', 'APPROVED', 'Contribution', 1, 1, 0, 0, '2022-04-01 00:00:00'),
(21, 5, NULL, 2000, 'TEST', 'APPROVED', 'Contribution', 1, 1, 0, 0, '2022-05-01 00:00:00'),
(22, 5, NULL, 2000, 'test', 'APPROVED', 'Contribution', 1, 1, 0, 0, '2022-06-01 00:00:00'),
(23, 5, NULL, 2000, '2000', 'APPROVED', 'Contribution', 1, 1, 0, 0, '2022-07-01 00:00:00'),
(24, 5, NULL, 2000, 'TEST', 'APPROVED', 'Contribution', 1, 1, 0, 0, '2022-08-01 00:00:00'),
(25, 5, NULL, 2000, 'TEST', 'APPROVED', 'Contribution', 1, 1, 0, 0, '2022-09-01 00:00:00'),
(26, 5, NULL, 2000, 'TEST', 'APPROVED', 'Contribution', 1, 1, 0, 0, '2022-10-01 00:00:00'),
(27, 5, NULL, 1000, 'TEST', 'APPROVED', 'Contribution', 1, 1, 0, 0, '2022-11-01 00:00:00'),
(28, 5, NULL, 2000, 'TEST', 'APPROVED', 'Contribution', 1, 1, 0, 0, '2022-12-01 00:00:00'),
(29, 5, NULL, 2000, 'TEST', 'APPROVED', 'Contribution', 1, 1, 0, 0, '2023-01-01 00:00:00');

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
(6, 12, 5, '121648285_5251411688205904_378163402100567756_o.jpg', '121648285_5251411688205904_378163402100567756_o.jpg', 'image/jpeg', '2022-01-13 11:18:23');

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
(1, 'Admin Test', '0cc175b9c0f1b6a831c399e269772661', '71 Dagat-dagatan', 18, 0, 0, 'whoamikenken@gmail.com', '09157759784', 'Male', 'Active', 'admin', 'admin', NULL, '2021-11-18 03:06:41'),
(2, 'Jose Rizal', '0cc175b9c0f1b6a831c399e269772661', '62 Marulas B Caloocan City', 20, 0, 0, 'khipolito@schools.ph', '09226361316', 'Male', 'Verified', 'treasurer', 'treasurer1', NULL, '2021-11-18 03:18:12'),
(5, 'ken hipolito', '0cc175b9c0f1b6a831c399e269772661', '62 Marulas B Caloocan City', 15, 2000, 10, 'whoamikenken@gmail.com', '09157759784', 'Male', 'Verified', 'member', 'whoamiken', '117943099_1088445701557853_3091277158760663503_o2.jpg', '2021-11-18 03:48:42');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `funds`
--
ALTER TABLE `funds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `loan`
--
ALTER TABLE `loan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `transaction_files`
--
ALTER TABLE `transaction_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
