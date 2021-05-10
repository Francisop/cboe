-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2021 at 05:07 AM
-- Server version: 10.3.15-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cboe`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`) VALUES
('igbrokerssuperuser', 'igbrokersadmin33##');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(32) NOT NULL,
  `log_id` varchar(32) NOT NULL,
  `user_id` int(32) NOT NULL,
  `action` varchar(64) NOT NULL,
  `created` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `log_id`, `user_id`, `action`, `created`) VALUES
(1, 'SWT1DIQR', 1, 'Logged In', '2021-01-14 01:28:15.000000'),
(2, '72BZPBTO', 1, 'Logged Out', '2021-01-14 01:32:29.000000'),
(3, 'ZGZR507J', 1, 'Logged In', '2021-01-14 01:33:08.000000'),
(4, 'U564N3C5', 1, 'Update account details', '2021-01-14 01:45:30.000000'),
(5, 'OMEGYEMQ', 1, 'Update account details', '2021-01-14 01:45:36.000000'),
(6, '6MWFYW91', 1, '$ 10 withdrawal request was made.', '2021-01-14 01:55:37.000000'),
(7, 'YR4GI8HE', 1, '$ 1600 was invested into the premium plan.', '2021-01-14 02:07:27.000000'),
(8, 'CLOU7DV2', 1, 'Logged Out', '2021-01-14 10:11:54.000000'),
(9, 'TASJBYUT', 1, 'Logged In', '2021-02-21 10:43:28.000000'),
(10, 'AKO2N80Q', 1, 'Logged Out', '2021-02-21 10:53:18.000000'),
(11, '1SRFR34Q', 1, 'Logged In', '2021-02-21 10:54:08.000000'),
(12, '5HPMQ333', 1, 'Logged Out', '2021-02-21 11:48:58.000000'),
(13, 'DH3IIC80', 1, 'Logged In', '2021-02-21 12:03:44.000000'),
(14, '4X6CS8V9', 1, 'Logged Out', '2021-02-21 12:07:38.000000'),
(15, 'OI9ILP8M', 1, 'Logged In', '2021-02-21 12:10:11.000000'),
(16, '6HZK0SW7', 1, '$ 500 was invested into the starter plan.', '2021-02-21 12:43:16.000000'),
(17, 'UJZZP2UK', 1, '$ 950 was invested into the starter plan.', '2021-02-21 12:53:38.000000'),
(18, '8E37YZMN', 1, 'Logged Out', '2021-02-21 13:09:04.000000'),
(19, 'P5KA9JZK', 1, 'Logged In', '2021-02-21 13:10:40.000000'),
(20, 'QDIIVCB8', 1, '$ 600 withdrawal request was made.', '2021-02-21 13:11:18.000000'),
(21, '1C7C5WHZ', 1, '$ 1000 withdrawal request was made.', '2021-02-21 13:18:22.000000'),
(22, 'UANH6GPE', 1, '$ 300000 withdrawal request was made.', '2021-02-21 13:20:51.000000'),
(23, 'MH5778D3', 1, 'Logged Out', '2021-02-21 13:24:16.000000'),
(24, 'Q2QFNWW8', 3, 'Logged Out', '2021-02-21 13:33:07.000000'),
(25, 'MV5XNTX0', 4, 'Logged In', '2021-02-21 13:35:00.000000'),
(26, 'XUNC62P3', 4, 'Logged Out', '2021-02-21 13:35:18.000000'),
(27, 'G5QFHHQQ', 5, 'You created account', '2021-02-21 13:35:45.000000'),
(28, '0XPAQP8C', 5, 'Logged Out', '2021-02-21 13:36:50.000000'),
(29, 'G67QFITH', 1, 'Logged In', '2021-02-21 13:36:59.000000'),
(30, 'BL18YJAA', 1, 'Logged Out', '2021-02-21 16:09:35.000000'),
(31, 'RZ8E8U9P', 5, 'Logged In', '2021-02-26 16:24:25.000000'),
(32, '3MAPZOYX', 5, 'Logged Out', '2021-02-26 17:07:06.000000'),
(33, '02MMN4MY', 5, 'Logged In', '2021-02-26 17:07:20.000000'),
(34, '0OHP4DBC', 5, 'Logged Out', '2021-02-26 17:09:09.000000'),
(35, 'ATNTAXP0', 5, 'Logged In', '2021-02-26 17:09:37.000000'),
(36, '4TH3SCAQ', 5, 'Logged Out', '2021-02-26 17:12:59.000000'),
(37, 'FZWJRX8D', 5, 'Logged In', '2021-02-27 01:04:46.000000'),
(38, 'ZTF9Q9ZX', 5, 'Logged Out', '2021-02-27 14:39:03.000000'),
(39, '8WR4XH2E', 5, 'Logged In', '2021-02-27 14:46:57.000000'),
(40, 'PIKFCLOR', 5, 'Logged In', '2021-02-27 17:37:11.000000'),
(41, 'TSYMXF86', 5, '$ 1 withdrawal request was made.', '2021-02-27 22:45:27.000000'),
(42, 'NLSZRGAI', 5, '$ 125 was invested into the starter plan.', '2021-02-28 00:08:00.000000'),
(43, 'DABN4S3X', 5, '$ 1500 was invested into the premium plan.', '2021-02-28 00:10:34.000000'),
(44, 'VIRLESS3', 5, 'Logged Out', '2021-02-28 00:38:35.000000'),
(45, 'QMUI9XXB', 5, 'Logged In', '2021-03-01 19:53:30.000000'),
(46, 'W2HG4WJA', 5, 'Logged In', '2021-03-02 07:14:13.000000'),
(47, 'MTG874DX', 5, 'Logged Out', '2021-03-02 10:15:02.000000'),
(48, 'ICZK1NIK', 1, 'Logged In', '2021-03-02 10:15:12.000000'),
(49, 'HU4I64HC', 1, 'Logged Out', '2021-03-02 10:22:22.000000'),
(50, 'UOOL6M3S', 5, 'Logged In', '2021-03-02 10:22:32.000000'),
(51, '9EAPSKFA', 5, 'Logged Out', '2021-03-02 11:26:37.000000'),
(52, 'D9DJI9M9', 1, 'Logged In', '2021-03-02 11:26:48.000000');

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE `plans` (
  `id` int(32) NOT NULL,
  `name` varchar(16) NOT NULL,
  `min_deposit` int(32) NOT NULL,
  `max_deposit` int(32) NOT NULL,
  `percent_profit` int(16) NOT NULL,
  `days_duration` int(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `plans`
--

INSERT INTO `plans` (`id`, `name`, `min_deposit`, `max_deposit`, `percent_profit`, `days_duration`) VALUES
(1, 'starter', 100, 1000, 400, 1),
(2, 'premium', 1500, 5000, 500, 1),
(3, 'gold', 5500, 17500, 700, 15),
(4, 'diamond', 20000, 45000, 1000, 30);

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` int(32) NOT NULL,
  `deposit` int(64) NOT NULL,
  `user_id` int(32) NOT NULL,
  `name` varchar(32) NOT NULL,
  `profit` int(32) NOT NULL,
  `status` int(1) NOT NULL,
  `created` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`id`, `deposit`, `user_id`, `name`, `profit`, `status`, `created`) VALUES
(6, 500, 1, 'starter', 2000, 1, '2021-01-13 12:49:19.000000'),
(8, 1600, 1, 'premium', 8000, 1, '2021-01-14 02:07:27.000000'),
(9, 500, 1, 'starter', 2000, 1, '2021-02-21 12:43:16.000000'),
(10, 950, 1, 'starter', 3800, 1, '2021-02-21 12:53:38.000000'),
(11, 125, 5, 'starter', 500, 1, '2021-02-28 00:08:00.000000'),
(12, 1500, 5, 'premium', 7500, 1, '2021-02-28 00:10:33.000000');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(32) NOT NULL,
  `firstname` varchar(64) NOT NULL,
  `lastname` varchar(64) NOT NULL,
  `username` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(128) NOT NULL,
  `wallet_address` varchar(128) DEFAULT NULL,
  `acct_balance` int(64) NOT NULL,
  `referral_bonus` int(64) NOT NULL,
  `isActive` int(1) NOT NULL,
  `created` datetime(6) NOT NULL,
  `modified` datetime(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `email`, `password`, `wallet_address`, `acct_balance`, `referral_bonus`, `isActive`, `created`, `modified`) VALUES
(1, 'Callister', 'Brandon', 'callister_brandon  ', 'callisterbrandon@gmail.com', '$2y$10$Vfy2RDxwoEBe27xaf0raReIT/jztq/eo82Up6i5PW/OlHY1T4FHhe', NULL, 100440, 0, 1, '2021-01-13 05:47:05.000000', '2021-03-02 08:51:03.323562'),
(2, 'carlos', 'miller', 'calolo1 ', 'calolo1@gail.com', '$2y$10$jngXC7hzHKoo8zAjW9fpLunPHWoBZQffhck.1WKuSDNJtMkIJdSXa', NULL, 2500, 0, 1, '2021-01-14 10:22:48.000000', '2021-01-14 10:44:34.368047'),
(5, 'Charles', 'Babbage', 'charlesb', 'charlesb@gmail.com', '$2y$10$oOfUuIvgcdcent/auAM6oOHVXH1zxdV.7G6b2owPUHjXc9aEX96.e', NULL, 8100, 0, 1, '2021-02-21 13:35:45.000000', '2021-03-02 13:42:19.530770');

-- --------------------------------------------------------

--
-- Table structure for table `withdrawals`
--

CREATE TABLE `withdrawals` (
  `id` int(32) NOT NULL,
  `amount` int(32) NOT NULL,
  `user_id` int(32) NOT NULL,
  `status` varchar(16) NOT NULL,
  `access_code` varchar(32) DEFAULT NULL,
  `created` datetime(6) NOT NULL,
  `updated` datetime(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `withdrawals`
--

INSERT INTO `withdrawals` (`id`, `amount`, `user_id`, `status`, `access_code`, `created`, `updated`) VALUES
(4, 300, 1, 'pending', '93313967', '2021-01-13 19:26:53.000000', '2021-01-13 20:13:30.812470'),
(5, 70, 1, 'pending', '', '2021-01-13 20:14:40.000000', '2021-01-13 20:14:40.334897'),
(6, 60, 1, 'pending', '', '2021-01-13 20:19:12.000000', '2021-01-13 20:19:12.230526'),
(7, 200, 1, 'approved', '57113853', '2021-01-13 20:34:43.000000', '2021-01-13 23:06:00.537492'),
(8, 50, 1, 'approved', '36082807', '2021-01-13 20:35:38.000000', '2021-01-13 22:51:58.567685'),
(9, 50, 1, 'pending', '', '2021-01-13 23:44:53.000000', '2021-01-13 23:44:53.757493'),
(10, 50, 1, 'pending', '', '2021-01-14 01:52:55.000000', '2021-01-14 01:52:55.167637'),
(11, 50, 1, 'pending', '', '2021-01-14 01:54:28.000000', '2021-01-14 01:54:28.425848'),
(12, 10, 1, 'approved', '46912583', '2021-01-14 01:55:37.000000', '2021-01-14 10:43:34.299193'),
(13, 600, 1, 'approved', '70551424', '2021-02-21 13:11:17.000000', '2021-02-21 13:14:51.502053'),
(14, 1000, 1, 'approved', '23928547', '2021-02-21 13:18:21.000000', '2021-02-21 13:19:01.148840'),
(15, 300000, 1, 'approved', '00164215', '2021-02-21 13:20:51.000000', '2021-02-21 13:21:37.024744'),
(16, 1, 5, 'pending', '', '2021-02-27 22:45:27.000000', '2021-02-27 22:45:27.226696');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `username_3` (`username`);

--
-- Indexes for table `withdrawals`
--
ALTER TABLE `withdrawals`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `withdrawals`
--
ALTER TABLE `withdrawals`
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
