-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2021 at 12:49 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wsa`
--

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `C_id` int(11) NOT NULL,
  `R_id` int(11) NOT NULL,
  `U_id` int(11) NOT NULL,
  `Relation` varchar(3) NOT NULL,
  `PhoneNo` varchar(15) NOT NULL,
  `Area` varchar(256) NOT NULL,
  `status` int(3) NOT NULL DEFAULT 0,
  `response_status` int(3) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `relative_tracker`
--

CREATE TABLE `relative_tracker` (
  `U_id` int(11) NOT NULL,
  `track_time` datetime NOT NULL DEFAULT current_timestamp(),
  `track_lng` decimal(11,7) NOT NULL,
  `track_lat` decimal(11,7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `social_police`
--

CREATE TABLE `social_police` (
  `U_id` int(11) NOT NULL,
  `track_time` datetime NOT NULL DEFAULT current_timestamp(),
  `track_lng` decimal(11,7) NOT NULL,
  `track_lat` decimal(11,7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `social_police`
--

INSERT INTO `social_police` (`U_id`, `track_time`, `track_lng`, `track_lat`) VALUES
(1, '2021-04-16 23:53:14', '73.0990996', '19.0145392'),
(2, '2021-04-16 23:34:31', '73.0990919', '19.0143010'),
(3, '2021-03-15 14:31:49', '79.0881580', '21.1458000'),
(4, '2021-03-15 14:31:49', '73.1175160', '18.9894010'),
(5, '2021-03-15 14:31:49', '77.2167210', '28.6448000'),
(6, '2021-03-15 14:31:49', '73.0989627', '19.0143879'),
(7, '2021-03-02 16:34:50', '73.0699080', '19.0473210');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `U_id` int(11) NOT NULL,
  `L_id` int(11) NOT NULL,
  `Phone` varchar(15) NOT NULL,
  `Gender` char(2) NOT NULL,
  `U_Address` varchar(256) NOT NULL,
  `U_City` varchar(256) NOT NULL,
  `U_State` varchar(256) NOT NULL,
  `U_Zip` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`U_id`, `L_id`, `Phone`, `Gender`, `U_Address`, `U_City`, `U_State`, `U_Zip`) VALUES
(1, 1, '8879561129', '', 'giewukjgetlhr', 'kamothe', 'Maharashtra', '41029'),
(2, 2, '8850058017', '', 'ygufjkrnebt', 'Nerul', 'Maharashtra', '123456'),
(3, 3, '8879561129', '', 'jkfnrgefadhkj', 'Airoli', 'Madhya Pradesh', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `usertable`
--

CREATE TABLE `usertable` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `code` int(11) NOT NULL,
  `status` varchar(20) NOT NULL,
  `RegistrationStatus` int(3) NOT NULL DEFAULT 0,
  `is_sp` int(3) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usertable`
--

INSERT INTO `usertable` (`id`, `name`, `email`, `password`, `code`, `status`, `RegistrationStatus`, `is_sp`) VALUES
(1, 'Hemant', 'hemantusingh@gmail.com', '$2y$10$zG3ZXxbRREzniSfe3a0z0engJuK0EvwsJkHCjdzvICWbCITeRmQEW', 0, 'verified', 1, 1),
(2, 'prasad', 'prasadshete2000@gmail.com', '$2y$10$OJRUPy5JSRumhAW/8HCsCeemGSpJpFQQl4OnCfJTF9Yw0gEaoweU2', 0, 'verified', 1, 1),
(3, 'Hemant', 'abc@gmail.com', '$2y$10$x9slzqBOwu841IgfMOAMZux2DkDv2BF/CJs1YJM322EBwi0I02mim', 0, 'verified', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `victim`
--

CREATE TABLE `victim` (
  `U_id` int(11) NOT NULL,
  `track_time` datetime NOT NULL DEFAULT current_timestamp(),
  `track_lng` decimal(11,7) NOT NULL,
  `track_lat` decimal(11,7) NOT NULL,
  `safety_status` int(3) NOT NULL DEFAULT 1,
  `police_help` int(3) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `victim_sp_relations`
--

CREATE TABLE `victim_sp_relations` (
  `Victim_id` int(11) NOT NULL,
  `Sp_id` int(11) NOT NULL,
  `status` int(3) NOT NULL DEFAULT 0,
  `response_status` int(3) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`C_id`);

--
-- Indexes for table `relative_tracker`
--
ALTER TABLE `relative_tracker`
  ADD PRIMARY KEY (`U_id`),
  ADD KEY `track_time` (`track_time`);

--
-- Indexes for table `social_police`
--
ALTER TABLE `social_police`
  ADD PRIMARY KEY (`U_id`),
  ADD KEY `track_time` (`track_time`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`U_id`);

--
-- Indexes for table `usertable`
--
ALTER TABLE `usertable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `victim`
--
ALTER TABLE `victim`
  ADD PRIMARY KEY (`U_id`),
  ADD KEY `track_time` (`track_time`);

--
-- Indexes for table `victim_sp_relations`
--
ALTER TABLE `victim_sp_relations`
  ADD PRIMARY KEY (`Victim_id`,`Sp_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `C_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `U_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `usertable`
--
ALTER TABLE `usertable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
