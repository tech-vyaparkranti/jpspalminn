-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 22, 2024 at 06:38 AM
-- Server version: 10.11.8-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u379125511_jps`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `mobile` varchar(25) NOT NULL,
  `email` varchar(55) NOT NULL,
  `password` varchar(255) NOT NULL,
  `panel_name` varchar(255) NOT NULL,
  `webmail` varchar(255) NOT NULL,
  `webpass` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `mobile`, `email`, `password`, `panel_name`, `webmail`, `webpass`, `created_at`, `updated_at`) VALUES
(1, 'jps', '7836950747', 'info@jps.com', 'info@2024', 'jps', 'info@jps.com', 'info@2024', '2024-07-26 13:57:35', '2024-07-29 21:43:13');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `booking_id` varchar(25) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mobile` varchar(55) NOT NULL,
  `email` varchar(255) NOT NULL,
  `total` int(11) NOT NULL,
  `pay_mode` tinyint(1) NOT NULL COMMENT '0 counter,1 online',
  `payment_id` varchar(255) NOT NULL,
  `booked_on` datetime NOT NULL DEFAULT current_timestamp(),
  `checkin` date NOT NULL,
  `checkout` date NOT NULL,
  `nights` int(11) NOT NULL,
  `payment_status` tinyint(1) NOT NULL COMMENT '0 fail, 1 done',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `booking_id`, `name`, `mobile`, `email`, `total`, `pay_mode`, `payment_id`, `booked_on`, `checkin`, `checkout`, `nights`, `payment_status`, `created_at`, `updated_at`) VALUES
(1, 'jps145778980', 'Gagan', '7897897899', 'gagandureja675@gmail.com', 8000, 1, 'txrn764531268541efvs86542', '2024-07-30 19:39:03', '2024-08-03', '2024-08-05', 2, 1, '2024-07-30 19:39:03', '2024-08-02 11:38:49');

-- --------------------------------------------------------

--
-- Table structure for table `booking_details`
--

CREATE TABLE `booking_details` (
  `id` int(11) NOT NULL,
  `bookings_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `special_request` varchar(500) NOT NULL,
  `adults` int(11) NOT NULL,
  `childs` int(11) NOT NULL,
  `childs_details` varchar(255) NOT NULL,
  `checkin` date NOT NULL,
  `checkout` date NOT NULL,
  `room_price` int(11) NOT NULL,
  `extra_adult_price` int(11) NOT NULL,
  `extra_child_price` int(11) NOT NULL,
  `nights` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `payment_status` tinyint(1) NOT NULL COMMENT '0 fail, 1 done',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `booking_details`
--

INSERT INTO `booking_details` (`id`, `bookings_id`, `room_id`, `name`, `special_request`, `adults`, `childs`, `childs_details`, `checkin`, `checkout`, `room_price`, `extra_adult_price`, `extra_child_price`, `nights`, `total_price`, `payment_status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Gagan', '', 2, 2, '2,4', '2024-08-03', '2024-08-05', 1800, 0, 0, 2, 3600, 1, '2024-07-30 19:43:35', '2024-08-02 11:38:29'),
(2, 1, 4, 'John', '', 2, 1, '4', '2024-08-03', '2024-08-05', 2200, 0, 0, 2, 4400, 1, '2024-07-30 19:44:14', '2024-08-02 11:38:40');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `session_id` varchar(255) NOT NULL,
  `room_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `special_request` varchar(500) NOT NULL,
  `adults` int(11) NOT NULL,
  `childs` int(11) NOT NULL,
  `childs_details` varchar(255) NOT NULL,
  `checkin` date NOT NULL,
  `checkout` date NOT NULL,
  `room_price` int(11) NOT NULL,
  `extra_adult_price` int(11) NOT NULL,
  `extra_child_price` int(11) NOT NULL,
  `nights` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `session_id`, `room_id`, `name`, `special_request`, `adults`, `childs`, `childs_details`, `checkin`, `checkout`, `room_price`, `extra_adult_price`, `extra_child_price`, `nights`, `total_price`, `created_at`, `updated_at`) VALUES
(430, 'qpbjupogk3cot5q79b0vid5ibr', 4, '', '', 1, 0, '', '2024-08-08', '2024-08-09', 2200, 0, 0, 1, 2200, '2024-08-08 19:03:26', '2024-08-08 19:03:26'),
(431, '102l5eejch63ug6pjfoh2vb3qd', 1, '', '', 1, 0, '', '2024-08-12', '2024-08-13', 1800, 0, 0, 1, 1800, '2024-08-12 19:21:20', '2024-08-12 19:21:20'),
(432, '102l5eejch63ug6pjfoh2vb3qd', 2, '', '', 1, 0, '', '2024-08-12', '2024-08-13', 2000, 0, 0, 1, 2000, '2024-08-12 19:21:25', '2024-08-12 19:21:25'),
(440, '9cgdq6u4ahbsgdmq3ftgqaf776', 1, '', '', 2, 1, '3', '2024-08-16', '2024-08-18', 1800, 200, 0, 2, 4000, '2024-08-16 15:32:05', '2024-08-16 00:00:00'),
(441, '9cgdq6u4ahbsgdmq3ftgqaf776', 1, '', '', 2, 0, '', '2024-08-16', '2024-08-18', 1800, 200, 0, 2, 4000, '2024-08-16 15:32:05', '2024-08-16 00:00:00'),
(442, '9cgdq6u4ahbsgdmq3ftgqaf776', 1, '', '', 1, 2, '0', '2024-08-16', '2024-08-18', 1800, 0, 0, 2, 3600, '2024-08-16 15:32:05', '2024-08-16 00:00:00'),
(447, '80m879ogbdrve71uejd9c9n3am', 1, '', '', 1, 0, '', '2024-08-29', '2024-08-31', 1800, 0, 0, 2, 3600, '2024-08-16 20:03:59', '2024-08-16 20:03:59');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `room_category` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `base_adult` int(11) NOT NULL,
  `base_child` int(11) NOT NULL,
  `base_price` int(11) NOT NULL,
  `extra_adult_price` int(11) NOT NULL,
  `extra_child_5_9_price` int(11) NOT NULL,
  `extra_child_10_price` int(11) NOT NULL,
  `breakfast` tinyint(1) NOT NULL COMMENT '0 no, 1 yes',
  `extra_adult_breakfast_price` int(11) NOT NULL,
  `extra_child_5_9_breakfast_price` int(11) NOT NULL,
  `extra_child_10_breakfast_price` int(11) NOT NULL,
  `total_rooms` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '0 hide, 1 show',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `room_category`, `name`, `base_adult`, `base_child`, `base_price`, `extra_adult_price`, `extra_child_5_9_price`, `extra_child_10_price`, `breakfast`, `extra_adult_breakfast_price`, `extra_child_5_9_breakfast_price`, `extra_child_10_breakfast_price`, `total_rooms`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '', 1, 0, 1800, 200, 450, 900, 0, 0, 0, 0, 10, 1, '2024-07-30 01:01:07', '2024-08-02 16:58:48'),
(2, 1, 'with breakfast', 1, 0, 2000, 200, 450, 900, 1, 0, 50, 100, 10, 1, '2024-07-30 01:45:22', '2024-08-02 17:00:34'),
(3, 2, '', 1, 0, 2000, 200, 500, 1000, 0, 0, 0, 0, 10, 1, '2024-07-30 01:47:16', '2024-08-02 17:01:09'),
(4, 3, 'with Breakfast', 1, 0, 2200, 200, 500, 1000, 1, 0, 50, 100, 10, 1, '2024-07-30 01:53:29', '2024-08-02 17:03:22');

-- --------------------------------------------------------

--
-- Table structure for table `room_category`
--

CREATE TABLE `room_category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `adults` int(11) NOT NULL,
  `childrens` int(11) NOT NULL,
  `room_amenities_dryer` tinyint(1) NOT NULL,
  `room_amenities_housekeep` tinyint(1) NOT NULL,
  `room_amenities_tea` tinyint(1) NOT NULL,
  `hotel_amenities_parking` tinyint(1) NOT NULL,
  `hotel_amenities_wifi` tinyint(1) NOT NULL,
  `hotel_amenities_drink` tinyint(1) NOT NULL,
  `photos` longtext NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '0 hide, 1 show',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `room_category`
--

INSERT INTO `room_category` (`id`, `name`, `adults`, `childrens`, `room_amenities_dryer`, `room_amenities_housekeep`, `room_amenities_tea`, `hotel_amenities_parking`, `hotel_amenities_wifi`, `hotel_amenities_drink`, `photos`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Deluxe', 2, 2, 0, 1, 1, 1, 1, 0, '75005453121.png', 1, '2024-07-29 20:14:33', '2024-08-08 15:40:30'),
(2, 'Super Deluxe', 2, 2, 1, 1, 1, 1, 1, 1, '75005453121.png', 1, '2024-07-30 01:45:55', '2024-08-08 10:11:58'),
(3, 'CP plan', 2, 2, 1, 1, 1, 1, 1, 1, '75005453121.png', 1, '2024-07-30 01:46:11', '2024-08-08 10:12:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking_details`
--
ALTER TABLE `booking_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_category`
--
ALTER TABLE `room_category`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `booking_details`
--
ALTER TABLE `booking_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=449;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `room_category`
--
ALTER TABLE `room_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
