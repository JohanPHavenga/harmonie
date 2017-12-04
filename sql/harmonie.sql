-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2017 at 12:40 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `harmonie`
--

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `location_id` int(11) NOT NULL,
  `location_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`location_id`, `location_name`, `created_date`, `updated_date`) VALUES
(1, 'Eastcliff', '2017-10-01 17:27:21', NULL),
(2, 'Fernkloof', '2017-10-01 17:27:42', NULL),
(3, 'Hemel-en-Aarde', '2017-10-01 17:27:49', NULL),
(4, 'Hermanus Central', '2017-10-01 17:27:54', NULL),
(5, 'Hermanus Heights', '2017-10-01 17:28:04', NULL),
(6, 'Kwaaiwater', '2017-10-01 17:28:12', NULL),
(7, 'Northcliff', '2017-10-01 17:28:18', NULL),
(8, 'Sandbaai', '2017-10-01 17:28:23', NULL),
(9, 'Voëlklip', '2017-10-01 17:28:28', NULL),
(10, 'Westcliff', '2017-10-01 17:28:36', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE `properties` (
  `property_id` int(11) NOT NULL,
  `property_code` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `property_code_search` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `property_address` text COLLATE utf8_unicode_ci,
  `property_sleeps` tinyint(4) DEFAULT NULL,
  `property_bathrooms` tinyint(4) DEFAULT NULL,
  `property_bedrooms` tinyint(4) DEFAULT NULL,
  `property_summary` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `property_overview` text COLLATE utf8_unicode_ci,
  `property_rate_low` smallint(5) UNSIGNED DEFAULT NULL,
  `property_rate_med` smallint(5) UNSIGNED DEFAULT NULL,
  `property_rate_high` smallint(5) UNSIGNED DEFAULT NULL,
  `property_gps` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `property_ispublished` bit(1) NOT NULL DEFAULT b'0',
  `property_isfeatured` bit(1) NOT NULL DEFAULT b'0',
  `property_img` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`property_id`, `property_code`, `property_code_search`, `property_address`, `property_sleeps`, `property_bathrooms`, `property_bedrooms`, `property_summary`, `property_overview`, `property_rate_low`, `property_rate_med`, `property_rate_high`, `property_gps`, `location_id`, `type_id`, `property_ispublished`, `property_isfeatured`, `property_img`, `created_date`, `updated_date`) VALUES
(3, 'V15', '', '103 8th Street<br>Voëlklip<br>Hermanus<br>', 3, 2, 5, 'Testing 1 2 3', '<p>This is an overview section<br>Where I can add breaklines and stuff<br></p>', 2000, 3000, 4000, '-34.407355, 19.279689', 9, 1, b'1', b'1', '20170601_155849.jpg', '2017-11-22 12:16:56', '2017-11-25 21:09:08'),
(4, 'HC3', '', '<p>25 Marine Drive<br>Hermanus<br></p>', 8, 3, 3, 'This is an awesome flat', '<p>This is my longer description on an awesome flat<br></p>', 4000, 4500, 5000, '-34.421037, 19.237029', 4, 2, b'1', b'1', 'Louw Stoep.jpg', '2017-11-25 21:19:29', '2017-11-30 06:39:18'),
(5, 'f3', '', '<p>3<br></p>', 123, 3, 3, '3', '<p>3<br></p>', 12, 123, 123, '324', 7, 2, b'1', b'0', '20170601_155849.jpg', '2017-11-30 19:43:20', '2017-11-30 18:58:13');

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `type_id` int(11) NOT NULL,
  `type_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`type_id`, `type_name`) VALUES
(1, 'House'),
(2, 'Apartment');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_surname` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `user_password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_surname`, `user_email`, `user_username`, `user_password`, `created_date`, `updated_date`) VALUES
(1, 'Johan', 'Havenga', 'johan.havenga@gmail.com', 'johan.havenga', '8c9f07d8d46cbc268cc57dcbdf3612b8b32d0dec', '2017-11-19 19:33:13', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`location_id`);

--
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`property_id`),
  ADD KEY `FK_prop_location_id` (`location_id`),
  ADD KEY `FK_prop_type_id` (`type_id`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `property_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `properties`
--
ALTER TABLE `properties`
  ADD CONSTRAINT `FK_prop_location_id` FOREIGN KEY (`location_id`) REFERENCES `locations` (`location_id`),
  ADD CONSTRAINT `FK_prop_type_id` FOREIGN KEY (`type_id`) REFERENCES `types` (`type_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
