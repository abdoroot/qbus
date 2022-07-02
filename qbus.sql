-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 02, 2022 at 09:19 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qbus`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provider_id` bigint(20) UNSIGNED NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT 0,
  `role` enum('admin','driver') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'admin',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `username`, `password`, `provider_id`, `active`, `role`, `email`, `phone`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'test-username', '$2y$10$W1kwL2K3rFeiKc1mZL6KM.ZvA.NDS/.jAsER.EIVsyV/jK6fXFL8O', 17, 1, 'admin', '', NULL, NULL, '2022-03-22 07:04:29', '2022-03-23 00:34:21'),
(3, 'test-user2', '$2y$10$3ONhMo.ZEVovSGwmA0.93e3rbTU/sQdVx9HCZNlNKgxIEn9XEqg8C', 17, 1, 'driver', NULL, '0552983776', NULL, '2022-03-23 00:36:28', '2022-03-23 19:16:11'),
(4, 'provider', '$2y$10$3ONhMo.ZEVovSGwmA0.93e3rbTU/sQdVx9HCZNlNKgxIEn9XEqg8C', 1, 1, 'admin', '', NULL, 'CTDYpJyCejyqyXH8XY1h7e9WPmu6g1G3bbe1vaJl0PKyQsjlbe5EyE81rxmS', '2022-03-23 01:08:09', '2022-03-23 01:08:09'),
(5, 'acoad-admin', '$2y$10$3ONhMo.ZEVovSGwmA0.93e3rbTU/sQdVx9HCZNlNKgxIEn9XEqg8C', 18, 1, 'admin', 'acoad@email.com', '0552639220', 'zCF0d8HmYymmw3QOEoCpUQncFb8njqS1MPMoqHDE86gDcTmlNEvANoDhSvuH', '2022-03-23 04:54:17', '2022-03-23 20:05:19'),
(6, 'acoad-driver', '$2y$10$3ONhMo.ZEVovSGwmA0.93e3rbTU/sQdVx9HCZNlNKgxIEn9XEqg8C', 18, 1, 'driver', NULL, NULL, NULL, '2022-03-23 20:43:47', '2022-03-23 20:43:47'),
(7, 'provider-driver', '$2y$10$/ubcVMzzTEcYCNIaFp1YcenfZIMtw9BJYcPQkvQnxdMLxH9itRXqm', 1, 1, 'driver', NULL, NULL, 'qHZZHR5lGXw4lq3xUWKVnXDXfQ5AGAkLPamr9sdsRHygM8wYPh4wKz4ZGkSx', '2022-04-04 07:12:24', '2022-04-04 07:12:24'),
(8, 'test-admin', '123456789', 3, 1, 'admin', NULL, NULL, NULL, '2022-04-11 00:14:19', '2022-04-11 00:14:19'),
(10, 'waleed.admin', '$2y$10$Ci6k87sbAAFFgsIm0DtxP./GXxbL/2QOibhucrdkewY3zcdgzQfIi', 20, 1, 'admin', NULL, NULL, NULL, '2022-06-29 08:48:53', '2022-06-29 08:48:53');

-- --------------------------------------------------------

--
-- Table structure for table `additionals`
--

CREATE TABLE `additionals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`name`)),
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `additionals`
--

INSERT INTO `additionals` (`id`, `name`, `icon`, `created_at`, `updated_at`) VALUES
(1, '{\"ar\": \"فندق\", \"en\": \"Hotel\"}', '<i class=\"fas fa-hotel\"></i>', '2022-04-25 19:40:42', '2022-04-25 19:41:09'),
(2, '{\"ar\": \"وجبة\", \"en\": \"Meal\"}', '<i class=\"fas fa-burger-soda\"></i>', '2022-04-25 19:42:06', '2022-04-25 19:46:58'),
(3, '{\"ar\": \"انترنت\", \"en\": \"Internet\"}', '<i class=\"fas fa-wifi\"></i>', '2022-04-25 19:47:28', '2022-04-25 19:47:28');

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `active`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@email.com', '$2y$10$eny.tlCgTXlEfjwXCoSIMuzWKdjKIq90lvHTRdmrMrAn.QSTrHL4K', 1, 'T08cSYBV5hYnz87lg9p6YJAl9XiCVUOQHk4NhrfcRtbZsRMTjEMfEaydx2R8', '2022-03-10 07:55:21', '2022-03-23 08:17:46');

-- --------------------------------------------------------

--
-- Table structure for table `buses`
--

CREATE TABLE `buses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `plate` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passengers` int(11) NOT NULL,
  `account_id` bigint(20) UNSIGNED DEFAULT NULL,
  `provider_id` bigint(20) UNSIGNED NOT NULL,
  `active` tinyint(4) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `buses`
--

INSERT INTO `buses` (`id`, `plate`, `image`, `passengers`, `account_id`, `provider_id`, `active`, `created_at`, `updated_at`) VALUES
(1, '12345 A', '1648084971_ca9ffc0170ff5ef6.png', 100, 6, 18, 1, '2022-03-23 21:19:27', '2022-03-23 21:22:51'),
(2, '12345 B', '1648625560_9700-15m-variant.jpg', 200, 6, 18, 1, '2022-03-30 03:32:40', '2022-03-30 03:32:40'),
(3, '12345 C Sharjah', '1649070758_FFG.webp', 150, 7, 1, 1, '2022-04-04 07:12:38', '2022-04-04 07:12:38'),
(4, '12345 C', '1649070783_0210126113352567.png', 100, 7, 1, 1, '2022-04-04 07:13:03', '2022-05-25 11:16:37');

-- --------------------------------------------------------

--
-- Table structure for table `bus_datetimes`
--

CREATE TABLE `bus_datetimes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bus_id` bigint(20) UNSIGNED NOT NULL,
  `bus_order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `trip_id` bigint(20) UNSIGNED DEFAULT NULL,
  `date` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_from` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_to` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bus_datetimes`
--

INSERT INTO `bus_datetimes` (`id`, `bus_id`, `bus_order_id`, `trip_id`, `date`, `time_from`, `time_to`, `created_at`, `updated_at`) VALUES
(2, 1, 16, NULL, '2022-04-04', '11:10', '17:10', '2022-04-04 03:24:23', '2022-04-04 03:24:23'),
(3, 2, 17, NULL, '2022-04-04', '11:45', '23:45', '2022-04-04 03:51:29', '2022-04-04 03:51:29'),
(4, 2, 17, NULL, '2022-04-05', '11:45', '23:45', '2022-04-04 03:51:29', '2022-04-04 03:51:29'),
(6, 4, 20, NULL, '2022-04-16', '10:00', '16:00', '2022-04-12 02:37:13', '2022-04-12 02:37:13'),
(8, 3, NULL, NULL, '2022-04-20', '10:00', '18:00', '2022-04-13 18:34:38', '2022-04-13 18:34:38'),
(9, 3, NULL, NULL, '2022-04-21', '10:00', '18:00', '2022-04-13 18:34:38', '2022-04-13 18:34:38'),
(10, 3, NULL, NULL, '2022-04-22', '10:00', '18:00', '2022-04-13 18:34:38', '2022-04-13 18:34:38'),
(11, 3, NULL, NULL, '2022-04-23', '10:00', '18:00', '2022-04-13 18:34:38', '2022-04-13 18:34:38'),
(12, 3, NULL, NULL, '2022-04-24', '10:00', '18:00', '2022-04-13 18:34:38', '2022-04-13 18:34:38'),
(13, 3, NULL, NULL, '2022-04-25', '10:00', '18:00', '2022-04-13 18:34:38', '2022-04-13 18:34:38'),
(14, 4, 20, NULL, '2022-04-16', '10:00', '16:00', '2022-04-14 02:58:21', '2022-04-14 02:58:21'),
(23, 3, NULL, NULL, '2022-05-04', '10:00', '17:00', '2022-04-27 01:14:39', '2022-04-27 01:14:39'),
(24, 3, NULL, NULL, '2022-05-05', '10:00', '17:00', '2022-04-27 01:14:39', '2022-04-27 01:14:39'),
(25, 3, NULL, NULL, '2022-05-06', '10:00', '17:00', '2022-04-27 01:14:39', '2022-04-27 01:14:39'),
(26, 3, NULL, NULL, '2022-05-07', '10:00', '17:00', '2022-04-27 01:14:39', '2022-04-27 01:14:39'),
(27, 3, NULL, NULL, '2022-05-08', '10:00', '17:00', '2022-05-09 11:02:18', '2022-05-09 11:02:18'),
(28, 3, NULL, NULL, '2022-05-09', '10:00', '17:00', '2022-05-09 11:02:18', '2022-05-09 11:02:18'),
(29, 3, NULL, NULL, '2022-05-10', '10:00', '17:00', '2022-05-09 11:02:18', '2022-05-09 11:02:18'),
(30, 3, NULL, NULL, '2022-05-11', '10:00', '17:00', '2022-05-09 11:02:18', '2022-05-09 11:02:18'),
(31, 3, NULL, NULL, '2022-05-12', '10:00', '17:00', '2022-05-09 11:02:18', '2022-05-09 11:02:18'),
(32, 3, NULL, NULL, '2022-05-13', '10:00', '17:00', '2022-05-09 11:02:18', '2022-05-09 11:02:18'),
(33, 3, NULL, NULL, '2022-05-14', '10:00', '17:00', '2022-05-09 11:02:18', '2022-05-09 11:02:18'),
(34, 3, NULL, NULL, '2022-05-15', '10:00', '17:00', '2022-05-09 11:02:18', '2022-05-09 11:02:18'),
(35, 3, NULL, NULL, '2022-05-16', '10:00', '17:00', '2022-05-09 11:02:18', '2022-05-09 11:02:18'),
(36, 3, NULL, NULL, '2022-05-17', '10:00', '17:00', '2022-05-09 11:02:18', '2022-05-09 11:02:18'),
(37, 3, NULL, NULL, '2022-05-18', '10:00', '17:00', '2022-05-09 11:02:18', '2022-05-09 11:02:18'),
(38, 3, NULL, NULL, '2022-05-19', '10:00', '17:00', '2022-05-09 11:02:18', '2022-05-09 11:02:18'),
(39, 3, NULL, NULL, '2022-05-20', '10:00', '17:00', '2022-05-09 11:02:18', '2022-05-09 11:02:18'),
(40, 3, NULL, NULL, '2022-05-21', '10:00', '17:00', '2022-05-09 11:02:18', '2022-05-09 11:02:18'),
(41, 3, NULL, NULL, '2022-05-22', '10:00', '17:00', '2022-05-09 11:02:18', '2022-05-09 11:02:18'),
(42, 3, NULL, NULL, '2022-05-23', '10:00', '17:00', '2022-05-09 11:02:18', '2022-05-09 11:02:18'),
(43, 3, NULL, NULL, '2022-05-24', '10:00', '17:00', '2022-05-09 11:02:18', '2022-05-09 11:02:18'),
(44, 3, NULL, NULL, '2022-05-25', '10:00', '17:00', '2022-05-09 11:02:18', '2022-05-09 11:02:18'),
(45, 3, NULL, NULL, '2022-05-26', '10:00', '17:00', '2022-05-09 11:02:18', '2022-05-09 11:02:18'),
(46, 3, NULL, NULL, '2022-05-27', '10:00', '17:00', '2022-05-09 11:02:18', '2022-05-09 11:02:18'),
(47, 3, NULL, NULL, '2022-05-28', '10:00', '17:00', '2022-05-09 11:02:18', '2022-05-09 11:02:18'),
(48, 3, NULL, NULL, '2022-05-29', '10:00', '17:00', '2022-05-09 11:02:18', '2022-05-09 11:02:18'),
(49, 3, NULL, NULL, '2022-05-30', '10:00', '17:00', '2022-05-09 11:02:18', '2022-05-09 11:02:18'),
(50, 3, NULL, NULL, '2022-05-31', '10:00', '17:00', '2022-05-09 11:02:18', '2022-05-09 11:02:18'),
(51, 3, NULL, NULL, '2022-06-01', '10:00', '17:00', '2022-05-09 11:02:18', '2022-05-09 11:02:18'),
(52, 3, NULL, NULL, '2022-06-02', '10:00', '17:00', '2022-05-09 11:02:18', '2022-05-09 11:02:18'),
(53, 3, NULL, NULL, '2022-06-03', '10:00', '17:00', '2022-05-09 11:02:18', '2022-05-09 11:02:18'),
(54, 3, NULL, NULL, '2022-06-04', '10:00', '17:00', '2022-05-09 11:02:18', '2022-05-09 11:02:18'),
(55, 4, 20, NULL, '2022-04-16', '10:00', '16:00', '2022-05-11 08:34:49', '2022-05-11 08:34:49'),
(57, 3, NULL, NULL, '2022-05-26', '10:00', '11:00', '2022-05-25 11:00:58', '2022-05-25 11:00:58'),
(58, 3, NULL, NULL, '2022-05-26', '10:00', '11:00', '2022-05-25 11:10:19', '2022-05-25 11:10:19'),
(61, 3, NULL, 38, '2022-05-29', '17:00', '18:00', '2022-05-29 06:42:36', '2022-05-29 06:42:36'),
(62, 3, NULL, 35, '2022-05-30', '16:00', '17:00', '2022-05-29 07:42:26', '2022-05-29 07:42:26'),
(63, 3, NULL, 35, '2022-05-31', '16:00', '17:00', '2022-05-29 07:42:26', '2022-05-29 07:42:26'),
(64, 3, NULL, NULL, '2022-06-01', '05:00', '07:00', '2022-05-29 12:45:14', '2022-05-29 12:45:14'),
(65, 3, NULL, 40, '2022-06-04', '10:00', '11:00', '2022-05-29 13:22:17', '2022-05-29 13:22:17');

-- --------------------------------------------------------

--
-- Table structure for table `bus_orders`
--

CREATE TABLE `bus_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date_from` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_to` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_from` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_to` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lng` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zoom` int(11) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `provider_id` bigint(20) UNSIGNED DEFAULT NULL,
  `bus_id` bigint(20) UNSIGNED DEFAULT NULL,
  `fees` double DEFAULT NULL,
  `tax` double DEFAULT NULL,
  `total` double DEFAULT NULL,
  `status` enum('pending','canceled','approved','rejected','paid','complete') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `user_notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider_notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin_notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_archive` tinyint(4) UNSIGNED NOT NULL DEFAULT 0,
  `provider_archive` tinyint(4) UNSIGNED NOT NULL DEFAULT 0,
  `destination` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`destination`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bus_orders`
--

INSERT INTO `bus_orders` (`id`, `date_from`, `date_to`, `time_from`, `time_to`, `lat`, `lng`, `zoom`, `user_id`, `provider_id`, `bus_id`, `fees`, `tax`, `total`, `status`, `user_notes`, `provider_notes`, `admin_notes`, `user_archive`, `provider_archive`, `destination`, `created_at`, `updated_at`) VALUES
(2, '2022-04-04', '2022-04-04', '10:00', '18:00', '25.4052', '55.5136', 12, 1, 18, 1, 700, 105, 805, 'rejected', NULL, NULL, 'test', 0, 0, NULL, '2022-04-04 03:06:47', '2022-05-11 08:20:58'),
(16, '2022-04-04', '2022-04-04', '11:10', '17:10', '25.4052', '55.5136', 12, 1, 18, 1, 700, 105, 805, 'approved', NULL, NULL, NULL, 0, 0, NULL, '2022-04-04 03:24:23', '2022-04-04 03:24:23'),
(17, '2022-04-04', '2022-04-05', '11:45', '23:45', '25.4052', '55.5136', 12, 1, 1, 3, 1000, 150, 1150, 'rejected', NULL, 'test reject from provider and return money to the user wallet.', NULL, 0, 0, NULL, '2022-04-04 03:51:29', '2022-05-11 08:32:16'),
(18, '2022-04-06', '2022-04-06', '09:35', '18:35', '25.4052', '55.5136', 12, 1, 1, 3, 700, 105, 805, 'canceled', 'The date is due and I didn\'t do the payment. I will create another order for next Sunday but please approve quickly.\r\nThank you!', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English.', NULL, 0, 0, NULL, '2022-04-04 07:35:58', '2022-04-12 04:18:05'),
(20, '2022-04-16', '2022-04-16', '10:00', '16:00', '25.4052', '55.5136', 12, 1, 1, 4, 400, 60, 460, 'approved', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.', NULL, 0, 0, '[\"1\"]', '2022-04-12 02:37:13', '2022-05-11 08:34:49');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`name`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(2, '{\"ar\": \"تصنيف 1\", \"en\": \"category 1\"}', '2022-03-28 00:28:35', '2022-03-28 00:28:35');

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `provider_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `trip_id` bigint(20) UNSIGNED DEFAULT NULL,
  `package_id` bigint(20) UNSIGNED DEFAULT NULL,
  `bus_id` bigint(20) UNSIGNED DEFAULT NULL,
  `trip_order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `package_order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `bus_order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`name`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`, `created_at`, `updated_at`) VALUES
(2, '{\"ar\":\"\\u062f\\u0628\\u064a\",\"en\":\"Dubai\",\"ur\":\"Dubai\"}', '2022-03-28 00:36:06', '2022-05-28 11:21:00'),
(3, '{\"ar\":\"\\u0627\\u0644\\u0634\\u0627\\u0631\\u0642\\u0629\",\"en\":\"Sharjah\",\"ur\":\"Sharjah\"}', '2022-03-29 10:11:34', '2022-05-28 11:21:19'),
(4, '{\"ar\":\"\\u0639\\u062c\\u0645\\u0627\\u0646\",\"en\":\"Ajman\",\"ur\":\"Ajman\"}', '2022-03-29 10:11:55', '2022-05-28 11:21:25'),
(5, '{\"ar\":\"\\u0627\\u0644\\u0639\\u064a\\u0646\",\"en\":\"Al Ain\",\"ur\":\"Al Ain\"}', '2022-03-29 10:11:55', '2022-05-28 11:21:30');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('contact','complaint','enquiry','suggestion','help','feedback') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'contact',
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `reply_message` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `account_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `type`, `subject`, `message`, `read_at`, `reply_message`, `user_id`, `account_id`, `created_at`, `updated_at`) VALUES
(1, 'test', 'anaaml761@gmail.com', 'contact', 'Test Contact us message', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2022-03-21 03:19:32', 'Dear sir,\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. \r\nLorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. https://lipsum.com/\r\nThank you.', NULL, NULL, '2022-03-21 06:27:58', '2022-03-21 03:40:35'),
(2, 'aml', 'aml@test.com', 'contact', 'test by admin', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English.', '2022-03-23 19:12:43', NULL, NULL, NULL, '2022-03-21 03:16:11', '2022-03-23 19:12:43'),
(3, 'aml', 'user@email.com', 'complaint', 'test', 'Dear USer\r\n\r\nLorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi.\r\n\r\nenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar,', '2022-03-28 02:34:50', 'Dear USer\r\n\r\nLorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi.\r\n\r\nenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar,', 1, NULL, '2022-03-28 02:27:57', '2022-03-28 02:35:15'),
(4, 'user', 'user@email.com', 'contact', 'test 2', 'Dear USer\r\n\r\nLorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi.\r\n\r\nenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar,', '2022-05-09 00:30:43', NULL, 1, NULL, '2022-03-28 02:29:39', '2022-05-09 00:30:43'),
(5, 'aml user', 'user@email.com', 'contact', 'test 3', 'Dear USer\r\n\r\nLorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi.\r\n\r\nenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar,', '2022-05-09 00:30:38', NULL, 1, NULL, '2022-03-28 02:31:22', '2022-05-09 00:30:38'),
(6, 'user', 'user@email.com', 'complaint', 'test 4', 'Dear USer\r\n\r\nLorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi.\r\n\r\nenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar,', '2022-04-14 03:10:58', NULL, 1, NULL, '2022-03-28 02:32:27', '2022-04-14 03:10:58'),
(7, 'Aml', 'anaaml761@gmail.com', 'contact', 'test contact us form', 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', '2022-05-09 00:30:00', NULL, 1, NULL, '2022-04-21 01:07:27', '2022-05-09 00:30:00'),
(8, 'aml', 'aml@email.com', 'contact', 'test 2', 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', '2022-05-09 00:30:21', NULL, 1, NULL, '2022-04-21 01:08:29', '2022-05-09 00:30:21'),
(9, 'unkown', 'anaaml761@gmail.com', 'feedback', 'Feedback', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2022-05-09 00:30:07', NULL, 1, NULL, '2022-04-21 02:52:56', '2022-05-09 00:30:07'),
(10, 'abdelhadi Mohammed', 'aa@dd.ru', 'contact', 'Test message', 'Hi there', NULL, NULL, NULL, NULL, '2022-05-31 04:53:45', '2022-05-31 04:53:45'),
(11, 'abdelhadi Mohammed', 'aa@dd.ru', 'contact', 'Test message', 'Hi there', NULL, NULL, NULL, NULL, '2022-05-31 04:54:12', '2022-05-31 04:54:12'),
(12, 'abdelhadi Mohammed', 'aa@dd.ru', 'contact', 'Test message', 'Hi there', NULL, NULL, NULL, NULL, '2022-05-31 04:54:15', '2022-05-31 04:54:15'),
(13, 'abdelhadi Mohammed', 'aa@dd.ru', 'contact', 'Test message', 'Hi there', '2022-05-31 04:55:39', NULL, NULL, NULL, '2022-05-31 04:55:03', '2022-05-31 04:55:39'),
(14, 'aml', 'test-aml@email.com', 'contact', 'testttttttttttttttttt', 'teeeeeeeeeeeeeeeeeeeeeeeee', '2022-06-01 11:46:35', NULL, 5, NULL, '2022-06-01 11:46:07', '2022-06-01 11:46:35'),
(15, 'aml', 'test-aml@email.com', 'contact', 'test', 'test2', NULL, NULL, 5, NULL, '2022-06-01 11:52:15', '2022-06-01 11:52:15'),
(16, 'aml', 'test-aml@email.com', 'contact', 'dfadf', 'sdfsdfsdfd', NULL, NULL, 5, NULL, '2022-06-01 11:52:37', '2022-06-01 11:52:37'),
(17, 'aml', 'test-aml@email.com', 'contact', 'asdasd', 'asdasdsad', NULL, NULL, 5, NULL, '2022-06-01 11:52:55', '2022-06-01 11:52:55'),
(18, 'aml', 'test-aml@email.com', 'contact', 'sdfs', 'dfsdfsdfdf', NULL, NULL, 5, NULL, '2022-06-01 11:53:13', '2022-06-01 11:53:13'),
(19, 'aml', 'test-aml@email.com', 'contact', 'sdfsdf', 'sdfsdfsdf', NULL, NULL, 5, NULL, '2022-06-01 11:53:42', '2022-06-01 11:53:42'),
(20, 'aml', 'test-aml@email.com', 'contact', 'يبليبليبل', 'يبليبليبل', NULL, NULL, 5, NULL, '2022-06-01 11:55:31', '2022-06-01 11:55:31'),
(21, 'aml', 'test-aml@email.com', 'contact', 'fgsdgsdg', 'sdgsdgsdgsdg', NULL, NULL, 5, NULL, '2022-06-01 11:56:29', '2022-06-01 11:56:29'),
(22, 'aml', 'test-aml@email.com', 'contact', 'sdfdsf', 'sdfsdfsdf', NULL, NULL, 5, NULL, '2022-06-01 11:56:53', '2022-06-01 11:56:53'),
(23, 'aml', 'test-aml@email.com', 'contact', 'asdasd', 'asdasd', NULL, NULL, 5, NULL, '2022-06-01 11:57:09', '2022-06-01 11:57:09'),
(24, 'aml', 'test-aml@email.com', 'contact', 'ghfghfg', 'hfghfghfgh', NULL, NULL, 5, NULL, '2022-06-01 12:00:20', '2022-06-01 12:00:20'),
(25, 'aml', 'test-aml@email.com', 'contact', 'dsdf', 'sdfsdf', NULL, NULL, 5, NULL, '2022-06-01 12:00:25', '2022-06-01 12:00:25'),
(26, 'aml', 'test-aml@email.com', 'contact', 'dfgdfg', 'dfgdfgdfg', NULL, NULL, 5, NULL, '2022-06-01 12:08:02', '2022-06-01 12:08:02'),
(27, 'abdelhadi Mohammed', 'aaddru@email.dd', 'contact', 'Test message', 'Hi there', NULL, NULL, NULL, NULL, '2022-06-07 16:31:14', '2022-06-07 16:31:14');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `provider_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_from` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_to` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('amount','percentage') COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` double NOT NULL,
  `code` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('pending','approved','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `admin_notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `provider_id`, `name`, `date_from`, `date_to`, `type`, `discount`, `code`, `status`, `admin_notes`, `created_at`, `updated_at`) VALUES
(1, 1, 'C1', '2022-04-29', '2022-05-26', 'percentage', 20, 'ZP52d', 'approved', NULL, '2022-04-26 18:07:20', '2022-05-09 10:58:37');

-- --------------------------------------------------------

--
-- Table structure for table `destinations`
--

CREATE TABLE `destinations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `provider_id` bigint(20) UNSIGNED NOT NULL,
  `from_city_id` bigint(20) UNSIGNED NOT NULL,
  `to_city_id` bigint(20) UNSIGNED NOT NULL,
  `starting_terminal_id` bigint(20) UNSIGNED DEFAULT NULL,
  `arrival_terminal_id` bigint(20) UNSIGNED DEFAULT NULL,
  `stops` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`stops`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `destinations`
--

INSERT INTO `destinations` (`id`, `provider_id`, `from_city_id`, `to_city_id`, `starting_terminal_id`, `arrival_terminal_id`, `stops`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 3, 1, 2, '[\"1\",\"2\"]', '2022-04-25 21:20:15', '2022-06-07 09:14:03'),
(2, 1, 3, 4, 1, 1, '[\"1\",\"2\"]', '2022-05-25 10:59:23', '2022-05-25 10:59:23');

-- --------------------------------------------------------

--
-- Table structure for table `emails`
--

CREATE TABLE `emails` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `emails`
--

INSERT INTO `emails` (`id`, `email`, `created_at`, `updated_at`) VALUES
(1, 'anaaml761@gmail.com', '2022-04-21 02:20:49', '2022-04-21 02:20:49'),
(2, 'aml2@gmail.com', '2022-04-21 02:31:23', '2022-04-21 02:31:23'),
(3, 'test@email.com', '2022-04-21 02:32:13', '2022-04-21 02:32:13'),
(4, 'test2@email.com', '2022-04-21 02:32:44', '2022-04-21 02:32:44'),
(5, 'h@a.co', '2022-04-21 02:33:11', '2022-04-21 02:33:11'),
(6, 'h@g.v', '2022-04-21 02:33:40', '2022-04-21 02:33:40'),
(7, 'test4@email.com', '2022-04-21 02:34:59', '2022-05-24 11:35:14');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`title`)),
  `text` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`text`)),
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `features`
--

INSERT INTO `features` (`id`, `title`, `text`, `icon`, `created_at`, `updated_at`) VALUES
(1, '{\"ar\": \"لوريم ايبسوم\", \"en\": \"Lorem Ipsum\"}', '{\"ar\": \"هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها.\", \"en\": \"Lorem ipsum dolor sit amet consectetur adipisicing elit. Provident ab nulla quod dignissimos vel non corrupti doloribus voluptatum eveniet.\"}', NULL, '2022-04-21 00:22:19', '2022-04-21 00:22:19');

-- --------------------------------------------------------

--
-- Table structure for table `ltm_translations`
--

CREATE TABLE `ltm_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `locale` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `group` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `key` text COLLATE utf8mb4_bin NOT NULL,
  `value` text COLLATE utf8mb4_bin DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `ltm_translations`
--

INSERT INTO `ltm_translations` (`id`, `status`, `locale`, `group`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 0, 'en', 'messages', 'saved', 'saved successfully.', '2022-03-21 00:30:26', '2022-06-01 11:54:52'),
(2, 1, 'en', 'models/admins', 'singular', 'Admin', '2022-03-21 00:30:26', '2022-03-21 01:00:35'),
(3, 0, 'en', 'messages', 'not_found', 'not found', '2022-03-21 00:30:26', '2022-06-01 11:54:52'),
(4, 0, 'en', 'messages', 'updated', 'updated successfully.', '2022-03-21 00:30:26', '2022-06-01 11:54:52'),
(5, 0, 'en', 'messages', 'deleted', 'deleted successfully.', '2022-03-21 00:30:26', '2022-06-01 11:54:52'),
(6, 0, 'en', 'auth', 'inactive', 'Inactive', '2022-03-21 00:30:26', '2022-06-29 08:25:39'),
(7, 0, 'en', 'auth', 'failed', 'These credentials do not match our records.', '2022-03-21 00:30:26', '2022-06-29 08:25:39'),
(8, 0, 'en', 'models/notifications', 'singular', 'Notification', '2022-03-21 00:30:26', '2022-05-31 14:13:51'),
(9, 0, 'en', 'msg', 'updated_successfully', ':name updated successfully', '2022-03-21 00:30:26', '2022-06-01 12:39:38'),
(10, 0, 'en', 'msg', 'profile', 'Profile', '2022-03-21 00:30:26', '2022-06-01 12:39:38'),
(11, 0, 'en', 'passwords', 'dismatch', 'Password does not match your current password.', '2022-03-21 00:30:26', '2022-05-31 13:32:28'),
(12, 0, 'en', 'msg', 'password', 'Password', '2022-03-21 00:30:26', '2022-06-01 12:39:38'),
(13, 0, 'en', 'models/providers', 'singular', 'Provider', '2022-03-21 00:30:26', '2022-05-31 13:17:53'),
(14, 0, 'en', 'models/users', 'singular', 'User', '2022-03-21 00:30:26', '2022-06-01 10:56:39'),
(15, 0, 'en', 'messages', 'retrieved', 'retrieved successfully.', '2022-03-21 00:30:26', '2022-06-01 11:54:52'),
(16, 1, 'en', 'models/admins', 'plural', 'Admins', '2022-03-21 00:30:26', '2022-03-21 01:00:31'),
(17, 0, 'en', 'models/notifications', 'plural', 'Notifications', '2022-03-21 00:30:26', '2022-05-31 14:13:51'),
(18, 0, 'en', 'models/providers', 'plural', 'Providers', '2022-03-21 00:30:26', '2022-05-31 13:17:53'),
(19, 0, 'en', 'models/users', 'plural', 'Users', '2022-03-21 00:30:26', '2022-06-01 10:56:39'),
(20, 0, 'en', 'auth', 'password', 'Password', '2022-03-21 00:30:26', '2022-06-29 08:25:39'),
(21, 0, 'en', 'auth', 'blocked', 'Your account is blocked, please contact admin for more details.', '2022-03-21 00:30:26', '2022-06-29 08:25:39'),
(22, 0, 'en', 'auth', 'unapproved', 'Your account is unapproved, please contact admin for more details', '2022-03-21 00:30:26', '2022-06-29 08:25:39'),
(23, 0, 'en', 'auth', 'verify_email.title', 'Verify Your Email Address', '2022-03-21 00:30:26', '2022-06-29 08:25:39'),
(24, 0, 'en', 'auth', 'verify_email.error_sending', 'Some error ocuured while sending verification email.', '2022-03-21 00:30:26', '2022-06-29 08:25:39'),
(25, 0, 'en', 'auth', 'verify_email.success', 'A fresh verification link has been sent to your email address', '2022-03-21 00:30:26', '2022-06-29 08:25:39'),
(26, 0, 'en', 'auth', 'verify_email.error', 'The link is not valid, please click the link below to request another.', '2022-03-21 00:30:26', '2022-06-29 08:25:39'),
(27, 0, 'en', 'auth', 'verify_email.verify_success', 'You have successfully verified your email address.', '2022-03-21 00:30:26', '2022-06-29 08:25:39'),
(28, 0, 'en', 'auth', 'throttle', 'Too many login attempts. Please try again in :seconds seconds.', '2022-03-21 00:30:26', '2022-06-29 08:25:39'),
(29, 0, 'en', 'msg', 'active', 'Active', '2022-03-21 00:30:26', '2022-06-01 12:39:38'),
(30, 0, 'en', 'msg', 'inactive', 'Inactive', '2022-03-21 00:30:26', '2022-06-01 12:39:38'),
(31, 0, 'en', 'msg', 'blocked', 'Blocked', '2022-03-21 00:30:26', '2022-06-01 12:39:38'),
(32, 0, 'en', 'models/providers', 'approved', 'Approved', '2022-03-21 00:30:26', '2022-05-31 13:17:53'),
(33, 0, 'en', 'models/providers', 'unapproved', 'Unapproved', '2022-03-21 00:30:26', '2022-05-31 13:17:53'),
(34, 0, 'en', 'crud', 'create', 'Create', '2022-03-21 00:30:26', '2022-05-31 11:41:54'),
(35, 0, 'en', 'crud', 'edit', 'Edit', '2022-03-21 00:30:26', '2022-05-31 11:41:54'),
(36, 1, 'en', 'models/admins', 'fields.name', 'Name', '2022-03-21 00:30:26', '2022-03-21 01:00:19'),
(37, 1, 'en', 'models/admins', 'fields.email', 'Email', '2022-03-21 00:30:26', '2022-03-21 01:00:12'),
(38, 1, 'en', 'models/admins', 'fields.password', 'Password', '2022-03-21 00:30:26', '2022-03-21 01:00:23'),
(39, 1, 'en', 'models/admins', 'fields.active', 'Active', '2022-03-21 00:30:26', '2022-03-21 01:00:08'),
(40, 0, 'en', 'crud', 'add_new', 'Add New', '2022-03-21 00:30:26', '2022-05-31 11:41:54'),
(41, 0, 'en', 'crud', 'show', 'Show', '2022-03-21 00:30:26', '2022-05-31 11:41:54'),
(42, 1, 'en', 'models/admins', 'fields.status', 'Status', '2022-03-21 00:30:26', '2022-03-21 01:00:27'),
(43, 0, 'en', 'auth', 'login.admin', 'Admin Login', '2022-03-21 00:30:26', '2022-06-29 08:25:39'),
(44, 0, 'en', 'auth', 'email', 'Email', '2022-03-21 00:30:26', '2022-06-29 08:25:39'),
(45, 0, 'en', 'auth', 'login.forgot_password', 'Forgot password ?', '2022-03-21 00:30:26', '2022-06-29 08:25:39'),
(46, 0, 'en', 'auth', 'confirm_passwords.title', 'Please confirm your password before continuing.', '2022-03-21 00:30:26', '2022-06-29 08:25:39'),
(47, 0, 'en', 'auth', 'forgot_password.title', 'Enter Email to reset password', '2022-03-21 00:30:26', '2022-06-29 08:25:39'),
(48, 0, 'en', 'auth', 'reset_password.title', 'Reset your password', '2022-03-21 00:30:26', '2022-06-29 08:25:39'),
(49, 0, 'en', 'auth', 'confirm_password', 'Confirm Password', '2022-03-21 00:30:26', '2022-06-29 08:25:39'),
(50, 0, 'en', 'msg', 'dashboard', 'Dashboard', '2022-03-21 00:30:27', '2022-06-01 12:39:38'),
(51, 0, 'en', 'msg', 'app_name', 'Laravel', '2022-03-21 00:30:27', '2022-06-01 12:39:38'),
(52, 0, 'en', 'msg', 'settings', 'Settings', '2022-03-21 00:30:27', '2022-06-01 12:39:38'),
(53, 0, 'en', 'auth', 'sign_out', 'Sign out', '2022-03-21 00:30:27', '2022-06-29 08:25:39'),
(54, 0, 'en', 'msg', 'app_users', 'App Users', '2022-03-21 00:30:27', '2022-06-01 12:39:38'),
(55, 0, 'en', 'msg', 'messages', 'Messages', '2022-03-21 00:30:27', '2022-06-01 12:39:38'),
(56, 0, 'en', 'msg', 'translation', 'Translation', '2022-03-21 00:30:27', '2022-06-01 12:39:38'),
(57, 0, 'en', 'models/notifications', 'fields.title', 'Title', '2022-03-21 00:30:27', '2022-05-31 14:13:51'),
(58, 0, 'en', 'models/notifications', 'fields.text', 'Text', '2022-03-21 00:30:27', '2022-05-31 14:13:51'),
(59, 0, 'en', 'models/notifications', 'fields.type', 'Type', '2022-03-21 00:30:27', '2022-05-31 14:13:51'),
(60, 0, 'en', 'models/notifications', 'types.primary', 'Primary', '2022-03-21 00:30:27', '2022-05-31 14:13:51'),
(61, 0, 'en', 'models/notifications', 'fields.to', 'To', '2022-03-21 00:30:27', '2022-05-31 14:13:51'),
(62, 0, 'en', 'models/notifications', 'fields.admin_id', 'Admin id', '2022-03-21 00:30:27', '2022-05-31 14:13:51'),
(63, 0, 'en', 'models/notifications', 'to.all_admins', 'All admins', '2022-03-21 00:30:27', '2022-05-31 14:13:51'),
(64, 0, 'en', 'models/notifications', 'fields.user_id', 'User id', '2022-03-21 00:30:27', '2022-05-31 14:13:51'),
(65, 0, 'en', 'models/notifications', 'to.all_users', 'All users', '2022-03-21 00:30:27', '2022-05-31 14:13:51'),
(66, 0, 'en', 'models/notifications', 'fields.provider_id', 'Provider id', '2022-03-21 00:30:27', '2022-05-31 14:13:51'),
(67, 0, 'en', 'models/notifications', 'to.all_providers', 'All providers', '2022-03-21 00:30:27', '2022-05-31 14:13:51'),
(68, 0, 'en', 'models/notifications', 'fields.url', 'Url', '2022-03-21 00:30:27', '2022-05-31 14:13:51'),
(69, 0, 'en', 'models/notifications', 'fields.icon', 'Icon', '2022-03-21 00:30:27', '2022-05-31 14:13:51'),
(70, 0, 'en', 'msg', 'confirm', 'discount', '2022-03-21 00:30:27', '2022-06-01 12:39:38'),
(71, 0, 'en', 'msg', 'mark_as_unread', 'Mark as unread', '2022-03-21 00:30:27', '2022-06-01 12:39:38'),
(72, 0, 'en', 'msg', 'mark_as_read', 'Mark as read', '2022-03-21 00:30:27', '2022-06-01 12:39:38'),
(73, 0, 'en', 'msg', 'email', 'Email', '2022-03-21 00:30:27', '2022-06-01 12:39:38'),
(74, 0, 'en', 'msg', 'current_password', 'Current password', '2022-03-21 00:30:27', '2022-06-01 12:39:38'),
(75, 0, 'en', 'msg', 'new_password', 'New password', '2022-03-21 00:30:27', '2022-06-01 12:39:38'),
(76, 0, 'en', 'msg', 'confirm_password', 'Confirm password', '2022-03-21 00:30:27', '2022-06-01 12:39:38'),
(77, 0, 'en', 'msg', 'submit', 'Submit', '2022-03-21 00:30:27', '2022-06-01 12:39:38'),
(78, 0, 'en', 'models/providers', 'fields.name', 'Name', '2022-03-21 00:30:27', '2022-05-31 13:17:53'),
(79, 0, 'en', 'models/providers', 'fields.email', 'Email', '2022-03-21 00:30:27', '2022-05-31 13:17:53'),
(80, 0, 'en', 'models/providers', 'fields.phone', 'Phone', '2022-03-21 00:30:27', '2022-05-31 13:17:53'),
(81, 0, 'en', 'models/providers', 'fields.password', 'Password', '2022-03-21 00:30:27', '2022-05-31 13:17:53'),
(82, 0, 'en', 'models/providers', 'fields.image', 'Image', '2022-03-21 00:30:27', '2022-05-31 13:17:53'),
(84, 0, 'en', 'msg', 'browse', 'Browse', '2022-03-21 00:30:27', '2022-06-01 12:39:38'),
(85, 0, 'en', 'models/providers', 'fields.notes', 'Notes', '2022-03-21 00:30:27', '2022-05-31 13:17:53'),
(86, 0, 'en', 'models/providers', 'fields.approve', 'Approve', '2022-03-21 00:30:27', '2022-05-31 13:17:53'),
(87, 0, 'en', 'models/providers', 'fields.block', 'Block', '2022-03-21 00:30:27', '2022-05-31 13:17:53'),
(88, 0, 'en', 'models/providers', 'fields.block_notes', 'Block notes', '2022-03-21 00:30:27', '2022-05-31 13:17:53'),
(89, 0, 'en', 'models/users', 'fields.name', 'Name', '2022-03-21 00:30:27', '2022-06-01 10:56:39'),
(90, 0, 'en', 'models/users', 'fields.email', 'Email', '2022-03-21 00:30:27', '2022-06-01 10:56:39'),
(91, 0, 'en', 'models/users', 'fields.phone', 'Phone', '2022-03-21 00:30:27', '2022-06-01 10:56:39'),
(92, 0, 'en', 'models/users', 'fields.password', 'Password', '2022-03-21 00:30:27', '2022-06-01 10:56:39'),
(93, 0, 'en', 'models/users', 'fields.image', 'Image', '2022-03-21 00:30:27', '2022-06-01 10:56:39'),
(94, 0, 'en', 'msg', 'upload_file', 'Upload file', '2022-03-21 00:30:27', '2022-06-01 12:39:38'),
(95, 0, 'en', 'models/users', 'fields.notes', 'Notes', '2022-03-21 00:30:27', '2022-06-01 10:56:39'),
(96, 0, 'en', 'models/users', 'fields.block', 'Block', '2022-03-21 00:30:27', '2022-06-01 10:56:39'),
(97, 0, 'en', 'models/users', 'fields.block_notes', 'Block notes', '2022-03-21 00:30:27', '2022-06-01 10:56:39'),
(98, 0, 'en', 'auth', 'login.title', 'Login', '2022-03-21 00:30:27', '2022-06-29 08:25:39'),
(99, 0, 'en', 'auth', 'login.register_membership', 'Don\'t have an account ?', '2022-03-21 00:30:27', '2022-06-29 08:25:39'),
(100, 0, 'en', 'auth', 'registration.title', 'Register a new membership', '2022-03-21 00:30:27', '2022-06-29 08:25:39'),
(101, 0, 'en', 'auth', 'name', 'Name', '2022-03-21 00:30:27', '2022-06-29 08:25:39'),
(102, 0, 'en', 'auth', 'phone', 'Phone', '2022-03-21 00:30:27', '2022-06-29 08:25:39'),
(103, 0, 'en', 'auth', 'registration.i_agree', 'I agree to', '2022-03-21 00:30:27', '2022-06-29 08:25:39'),
(104, 0, 'en', 'auth', 'registration.have_membership', 'Already have an account?', '2022-03-21 00:30:27', '2022-06-29 08:25:39'),
(105, 0, 'en', 'msg', 'app_name_by_developer_name', 'Qbus', '2022-03-21 00:30:27', '2022-06-01 12:39:38'),
(106, 0, 'en', 'msg', 'search_and_enter', 'Search & enter', '2022-03-21 00:30:27', '2022-06-01 12:39:38'),
(107, 0, 'en', 'auth', 'login.provider', 'Provider Login', '2022-03-21 00:30:27', '2022-06-29 08:25:39'),
(108, 0, 'en', 'auth', 'verify_email.notice', 'Before proceeding, please check your email for a verification link.If you did not receive the email,', '2022-03-21 00:30:27', '2022-06-29 08:25:39'),
(109, 0, 'en', 'auth', 'verify_email.another_req', 'click here to request another', '2022-03-21 00:30:27', '2022-06-29 08:25:39'),
(110, 0, 'en', '_json', 'you_have_n_new_messages', NULL, '2022-03-21 00:30:27', '2022-03-21 00:30:27'),
(111, 0, 'en', '_json', 'Dashboard', NULL, '2022-03-21 00:30:27', '2022-03-21 00:30:27'),
(112, 0, 'en', '_json', 'Log Out', NULL, '2022-03-21 00:30:27', '2022-03-21 00:30:27'),
(113, 0, 'en', '_json', 'This is a secure area of the application. Please confirm your password before continuing.', NULL, '2022-03-21 00:30:27', '2022-03-21 00:30:27'),
(114, 0, 'en', '_json', 'Password', NULL, '2022-03-21 00:30:27', '2022-03-21 00:30:27'),
(115, 0, 'en', '_json', 'Confirm', NULL, '2022-03-21 00:30:27', '2022-03-21 00:30:27'),
(116, 0, 'en', '_json', 'Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.', NULL, '2022-03-21 00:30:27', '2022-03-21 00:30:27'),
(117, 0, 'en', '_json', 'Email', NULL, '2022-03-21 00:30:27', '2022-03-21 00:30:27'),
(118, 0, 'en', '_json', 'Email Password Reset Link', NULL, '2022-03-21 00:30:27', '2022-03-21 00:30:27'),
(119, 0, 'en', '_json', 'Confirm Password', NULL, '2022-03-21 00:30:27', '2022-03-21 00:30:27'),
(120, 0, 'en', '_json', 'Reset Password', NULL, '2022-03-21 00:30:27', '2022-03-21 00:30:27'),
(121, 0, 'en', '_json', 'A new verification link has been sent to the email address you provided during registration.', NULL, '2022-03-21 00:30:27', '2022-03-21 00:30:27'),
(122, 0, 'en', '_json', 'Resend Verification Email', NULL, '2022-03-21 00:30:27', '2022-03-21 00:30:27'),
(123, 0, 'en', '_json', 'Whoops! Something went wrong.', NULL, '2022-03-21 00:30:27', '2022-03-21 00:30:27'),
(124, 0, 'en', 'auth', 'full_name', 'Full Name', '2022-03-21 00:32:06', '2022-06-29 08:25:39'),
(125, 0, 'en', 'auth', 'remember_me', 'Remember Me', '2022-03-21 00:32:06', '2022-06-29 08:25:39'),
(126, 0, 'en', 'auth', 'sign_in', 'Sign In', '2022-03-21 00:32:06', '2022-06-29 08:25:39'),
(127, 0, 'en', 'auth', 'sign_up', 'Sign up', '2022-03-21 00:32:06', '2022-06-29 08:25:39'),
(128, 0, 'en', 'auth', 'register', 'Register', '2022-03-21 00:32:06', '2022-06-29 08:25:39'),
(129, 0, 'en', 'auth', 'login.remember_me', 'Remember Me', '2022-03-21 00:32:06', '2022-06-29 08:25:39'),
(130, 0, 'en', 'auth', 'registration.terms', 'the terms', '2022-03-21 00:32:06', '2022-06-29 08:25:39'),
(131, 0, 'en', 'auth', 'forgot_password.send_pwd_reset', 'Send Password Reset Link', '2022-03-21 00:32:06', '2022-06-29 08:25:39'),
(132, 0, 'en', 'auth', 'reset_password.reset_pwd_btn', 'Reset Password', '2022-03-21 00:32:06', '2022-06-29 08:25:39'),
(133, 0, 'en', 'auth', 'confirm_passwords.forgot_your_password', 'Forgot Your Password?', '2022-03-21 00:32:06', '2022-06-29 08:25:39'),
(134, 0, 'en', 'auth', 'confirm_passwords.send_pwd_confirm', 'Confirm', '2022-03-21 00:32:06', '2022-06-29 08:25:39'),
(135, 0, 'en', 'auth', 'verify_phone.title', 'Verify Your Phone Number', '2022-03-21 00:32:06', '2022-06-29 08:25:39'),
(136, 0, 'en', 'auth', 'verify_phone.success', 'A fresh verification code has been sent to your phone number', '2022-03-21 00:32:06', '2022-06-29 08:25:39'),
(137, 0, 'en', 'auth', 'verify_phone.notice', 'Before proceeding, please check your phone for a verification code.If you did not receive the sms,', '2022-03-21 00:32:06', '2022-06-29 08:25:39'),
(138, 0, 'en', 'auth', 'verify_phone.another_req', 'click here to request another', '2022-03-21 00:32:06', '2022-06-29 08:25:39'),
(139, 0, 'en', 'auth', 'verify_phone.verify_success', 'You have successfully verified your phone number.', '2022-03-21 00:32:06', '2022-06-29 08:25:39'),
(140, 0, 'en', 'auth', 'verify_phone.error', 'The code is not valid, please click the link below to request another.', '2022-03-21 00:32:06', '2022-06-29 08:25:39'),
(141, 0, 'en', 'auth', 'verify_phone.error_sending', 'Some error ocuured while sending verification code.', '2022-03-21 00:32:06', '2022-06-29 08:25:39'),
(142, 0, 'en', 'auth', 'emails.password.reset_link', 'Click here to reset your password', '2022-03-21 00:32:06', '2022-06-29 08:25:39'),
(143, 0, 'en', 'auth', 'app.member_since', 'Member since', '2022-03-21 00:32:06', '2022-06-29 08:25:39'),
(144, 0, 'en', 'auth', 'app.messages', 'Messages', '2022-03-21 00:32:06', '2022-06-29 08:25:39'),
(145, 0, 'en', 'auth', 'app.settings', 'Settings', '2022-03-21 00:32:06', '2022-06-29 08:25:39'),
(146, 0, 'en', 'auth', 'app.lock_account', 'Lock Account', '2022-03-21 00:32:06', '2022-06-29 08:25:39'),
(147, 0, 'en', 'auth', 'app.profile', 'Profile', '2022-03-21 00:32:06', '2022-06-29 08:25:39'),
(148, 0, 'en', 'auth', 'app.online', 'Online', '2022-03-21 00:32:06', '2022-06-29 08:25:39'),
(149, 0, 'en', 'auth', 'app.search', 'Search', '2022-03-21 00:32:06', '2022-06-29 08:25:39'),
(150, 0, 'en', 'auth', 'app.create', 'Create', '2022-03-21 00:32:06', '2022-06-29 08:25:39'),
(151, 0, 'en', 'auth', 'app.export', 'Export', '2022-03-21 00:32:06', '2022-06-29 08:25:39'),
(152, 0, 'en', 'auth', 'app.print', 'Print', '2022-03-21 00:32:06', '2022-06-29 08:25:39'),
(153, 0, 'en', 'auth', 'app.reset', 'Reset', '2022-03-21 00:32:06', '2022-06-29 08:25:39'),
(154, 0, 'en', 'auth', 'app.reload', 'Reload', '2022-03-21 00:32:06', '2022-06-29 08:25:39'),
(155, 0, 'en', 'crud', 'cancel', 'Cancel', '2022-03-21 00:32:06', '2022-05-31 11:41:54'),
(156, 0, 'en', 'crud', 'save', 'Save', '2022-03-21 00:32:06', '2022-05-31 11:41:54'),
(157, 0, 'en', 'crud', 'detail', 'Detail', '2022-03-21 00:32:06', '2022-05-31 11:41:54'),
(158, 0, 'en', 'crud', 'back', 'Back', '2022-03-21 00:32:06', '2022-05-31 11:41:54'),
(159, 0, 'en', 'crud', 'action', 'Action', '2022-03-21 00:32:06', '2022-05-31 11:41:54'),
(160, 0, 'en', 'crud', 'id', 'Id', '2022-03-21 00:32:06', '2022-05-31 11:41:54'),
(161, 0, 'en', 'crud', 'created_at', 'Created At', '2022-03-21 00:32:06', '2022-05-31 11:41:54'),
(162, 0, 'en', 'crud', 'updated_at', 'Updated At', '2022-03-21 00:32:06', '2022-05-31 11:41:54'),
(163, 0, 'en', 'crud', 'deleted_at', 'Deleted At', '2022-03-21 00:32:06', '2022-05-31 11:41:54'),
(164, 0, 'en', 'crud', 'are_you_sure', 'Are you sure?', '2022-03-21 00:32:06', '2022-05-31 11:41:54'),
(165, 0, 'en', 'msg', 'home', 'Home', '2022-03-21 00:32:06', '2022-06-01 12:39:38'),
(166, 0, 'en', 'msg', 'notifications', 'Notifications', '2022-03-21 00:32:06', '2022-06-01 12:39:38'),
(167, 0, 'en', 'msg', 'check_all_notifications', 'Check all notifications', '2022-03-21 00:32:06', '2022-06-01 12:39:38'),
(168, 0, 'en', 'msg', 'you_have_n_new_messages', '{0} You have no new messages|{1} You have :n new message|[2,*] You have :n new messages', '2022-03-21 00:32:06', '2022-06-01 12:39:38'),
(169, 0, 'en', 'msg', 'see_all_messages', 'See all messages', '2022-03-21 00:32:06', '2022-06-01 12:39:38'),
(170, 0, 'en', 'msg', 'created_successfully', ':name created successfully', '2022-03-21 00:32:06', '2022-06-01 12:39:38'),
(171, 0, 'en', 'msg', 'name', 'Name', '2022-03-21 00:32:06', '2022-06-01 12:39:38'),
(172, 0, 'en', 'msg', 'phone', 'Phone', '2022-03-21 00:32:06', '2022-06-01 12:39:38'),
(173, 0, 'en', 'msg', 'image', 'Image', '2022-03-21 00:32:06', '2022-06-01 12:39:38'),
(174, 0, 'en', 'msg', 'close', 'Close', '2022-03-21 00:32:06', '2022-06-01 12:39:38'),
(175, 0, 'en', 'pagination', 'previous', '&laquo; Previous', '2022-03-21 00:32:06', '2022-03-21 01:30:39'),
(176, 0, 'en', 'pagination', 'next', 'Next &raquo;', '2022-03-21 00:32:06', '2022-03-21 01:30:39'),
(177, 0, 'en', 'passwords', 'reset', 'Your password has been reset!', '2022-03-21 00:32:06', '2022-05-31 13:32:28'),
(178, 0, 'en', 'passwords', 'sent', 'We have emailed your password reset link!', '2022-03-21 00:32:06', '2022-05-31 13:32:28'),
(179, 0, 'en', 'passwords', 'throttled', 'Please wait before retrying.', '2022-03-21 00:32:06', '2022-05-31 13:32:28'),
(180, 0, 'en', 'passwords', 'token', 'This password reset token is invalid.', '2022-03-21 00:32:06', '2022-05-31 13:32:28'),
(181, 0, 'en', 'passwords', 'user', 'We can\'t find a user with that email address.', '2022-03-21 00:32:06', '2022-05-31 13:32:28'),
(182, 0, 'en', 'validation', 'accepted', 'The :attribute must be accepted.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(183, 0, 'en', 'validation', 'accepted_if', 'The :attribute must be accepted when :other is :value.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(184, 0, 'en', 'validation', 'active_url', 'The :attribute is not a valid URL.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(185, 0, 'en', 'validation', 'after', 'The :attribute must be a date after :date.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(186, 0, 'en', 'validation', 'after_or_equal', 'The :attribute must be a date after or equal to :date.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(187, 0, 'en', 'validation', 'alpha', 'The :attribute must only contain letters.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(188, 0, 'en', 'validation', 'alpha_dash', 'The :attribute must only contain letters, numbers, dashes and underscores.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(189, 0, 'en', 'validation', 'alpha_num', 'The :attribute must only contain letters and numbers.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(190, 0, 'en', 'validation', 'array', 'The :attribute must be an array.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(191, 0, 'en', 'validation', 'before', 'The :attribute must be a date before :date.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(192, 0, 'en', 'validation', 'before_or_equal', 'The :attribute must be a date before or equal to :date.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(193, 0, 'en', 'validation', 'between.numeric', 'The :attribute must be between :min and :max.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(194, 0, 'en', 'validation', 'between.file', 'The :attribute must be between :min and :max kilobytes.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(195, 0, 'en', 'validation', 'between.string', 'The :attribute must be between :min and :max characters.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(196, 0, 'en', 'validation', 'between.array', 'The :attribute must have between :min and :max items.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(197, 0, 'en', 'validation', 'boolean', 'The :attribute field must be true or false.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(198, 0, 'en', 'validation', 'confirmed', 'The :attribute confirmation does not match.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(199, 0, 'en', 'validation', 'current_password', 'The password is incorrect.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(200, 0, 'en', 'validation', 'date', 'The :attribute is not a valid date.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(201, 0, 'en', 'validation', 'date_equals', 'The :attribute must be a date equal to :date.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(202, 0, 'en', 'validation', 'date_format', 'The :attribute does not match the format :format.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(203, 0, 'en', 'validation', 'declined', 'The :attribute must be declined.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(204, 0, 'en', 'validation', 'declined_if', 'The :attribute must be declined when :other is :value.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(205, 0, 'en', 'validation', 'different', 'The :attribute and :other must be different.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(206, 0, 'en', 'validation', 'digits', 'The :attribute must be :digits digits.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(207, 0, 'en', 'validation', 'digits_between', 'The :attribute must be between :min and :max digits.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(208, 0, 'en', 'validation', 'dimensions', 'The :attribute has invalid image dimensions.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(209, 0, 'en', 'validation', 'distinct', 'The :attribute field has a duplicate value.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(210, 0, 'en', 'validation', 'email', 'The :attribute must be a valid email address.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(211, 0, 'en', 'validation', 'ends_with', 'The :attribute must end with one of the following: :values.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(212, 0, 'en', 'validation', 'enum', 'The selected :attribute is invalid.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(213, 0, 'en', 'validation', 'exists', 'The selected :attribute is invalid.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(214, 0, 'en', 'validation', 'file', 'The :attribute must be a file.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(215, 0, 'en', 'validation', 'filled', 'The :attribute field must have a value.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(216, 0, 'en', 'validation', 'gt.numeric', 'The :attribute must be greater than :value.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(217, 0, 'en', 'validation', 'gt.file', 'The :attribute must be greater than :value kilobytes.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(218, 0, 'en', 'validation', 'gt.string', 'The :attribute must be greater than :value characters.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(219, 0, 'en', 'validation', 'gt.array', 'The :attribute must have more than :value items.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(220, 0, 'en', 'validation', 'gte.numeric', 'The :attribute must be greater than or equal to :value.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(221, 0, 'en', 'validation', 'gte.file', 'The :attribute must be greater than or equal to :value kilobytes.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(222, 0, 'en', 'validation', 'gte.string', 'The :attribute must be greater than or equal to :value characters.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(223, 0, 'en', 'validation', 'gte.array', 'The :attribute must have :value items or more.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(224, 0, 'en', 'validation', 'image', 'The :attribute must be an image.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(225, 0, 'en', 'validation', 'in', 'The selected :attribute is invalid.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(226, 0, 'en', 'validation', 'in_array', 'The :attribute field does not exist in :other.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(227, 0, 'en', 'validation', 'integer', 'The :attribute must be an integer.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(228, 0, 'en', 'validation', 'ip', 'The :attribute must be a valid IP address.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(229, 0, 'en', 'validation', 'ipv4', 'The :attribute must be a valid IPv4 address.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(230, 0, 'en', 'validation', 'ipv6', 'The :attribute must be a valid IPv6 address.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(231, 0, 'en', 'validation', 'json', 'The :attribute must be a valid JSON string.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(232, 0, 'en', 'validation', 'lt.numeric', 'The :attribute must be less than :value.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(233, 0, 'en', 'validation', 'lt.file', 'The :attribute must be less than :value kilobytes.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(234, 0, 'en', 'validation', 'lt.string', 'The :attribute must be less than :value characters.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(235, 0, 'en', 'validation', 'lt.array', 'The :attribute must have less than :value items.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(236, 0, 'en', 'validation', 'lte.numeric', 'The :attribute must be less than or equal to :value.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(237, 0, 'en', 'validation', 'lte.file', 'The :attribute must be less than or equal to :value kilobytes.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(238, 0, 'en', 'validation', 'lte.string', 'The :attribute must be less than or equal to :value characters.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(239, 0, 'en', 'validation', 'lte.array', 'The :attribute must not have more than :value items.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(240, 0, 'en', 'validation', 'mac_address', 'The :attribute must be a valid MAC address.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(241, 0, 'en', 'validation', 'max.numeric', 'The :attribute must not be greater than :max.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(242, 0, 'en', 'validation', 'max.file', 'The :attribute must not be greater than :max kilobytes.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(243, 0, 'en', 'validation', 'max.string', 'The :attribute must not be greater than :max characters.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(244, 0, 'en', 'validation', 'max.array', 'The :attribute must not have more than :max items.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(245, 0, 'en', 'validation', 'mimes', 'The :attribute must be a file of type: :values.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(246, 0, 'en', 'validation', 'mimetypes', 'The :attribute must be a file of type: :values.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(247, 0, 'en', 'validation', 'min.numeric', 'The :attribute must be at least :min.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(248, 0, 'en', 'validation', 'min.file', 'The :attribute must be at least :min kilobytes.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(249, 0, 'en', 'validation', 'min.string', 'The :attribute must be at least :min characters.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(250, 0, 'en', 'validation', 'min.array', 'The :attribute must have at least :min items.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(251, 0, 'en', 'validation', 'multiple_of', 'The :attribute must be a multiple of :value.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(252, 0, 'en', 'validation', 'not_in', 'The selected :attribute is invalid.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(253, 0, 'en', 'validation', 'not_regex', 'The :attribute format is invalid.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(254, 0, 'en', 'validation', 'numeric', 'The :attribute must be a number.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(255, 0, 'en', 'validation', 'password', 'The password is incorrect.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(256, 0, 'en', 'validation', 'present', 'The :attribute field must be present.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(257, 0, 'en', 'validation', 'prohibited', 'The :attribute field is prohibited.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(258, 0, 'en', 'validation', 'prohibited_if', 'The :attribute field is prohibited when :other is :value.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(259, 0, 'en', 'validation', 'prohibited_unless', 'The :attribute field is prohibited unless :other is in :values.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(260, 0, 'en', 'validation', 'prohibits', 'The :attribute field prohibits :other from being present.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(261, 0, 'en', 'validation', 'regex', 'The :attribute format is invalid.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(262, 0, 'en', 'validation', 'required', 'The :attribute field is required.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(263, 0, 'en', 'validation', 'required_array_keys', 'The :attribute field must contain entries for: :values.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(264, 0, 'en', 'validation', 'required_if', 'The :attribute field is required when :other is :value.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(265, 0, 'en', 'validation', 'required_unless', 'The :attribute field is required unless :other is in :values.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(266, 0, 'en', 'validation', 'required_with', 'The :attribute field is required when :values is present.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(267, 0, 'en', 'validation', 'required_with_all', 'The :attribute field is required when :values are present.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(268, 0, 'en', 'validation', 'required_without', 'The :attribute field is required when :values is not present.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(269, 0, 'en', 'validation', 'required_without_all', 'The :attribute field is required when none of :values are present.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(270, 0, 'en', 'validation', 'same', 'The :attribute and :other must match.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(271, 0, 'en', 'validation', 'size.numeric', 'The :attribute must be :size.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(272, 0, 'en', 'validation', 'size.file', 'The :attribute must be :size kilobytes.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(273, 0, 'en', 'validation', 'size.string', 'The :attribute must be :size characters.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(274, 0, 'en', 'validation', 'size.array', 'The :attribute must contain :size items.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(275, 0, 'en', 'validation', 'starts_with', 'The :attribute must start with one of the following: :values.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(276, 0, 'en', 'validation', 'string', 'The :attribute must be a string.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(277, 0, 'en', 'validation', 'timezone', 'The :attribute must be a valid timezone.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(278, 0, 'en', 'validation', 'unique', 'The :attribute has already been taken.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(279, 0, 'en', 'validation', 'uploaded', 'The :attribute failed to upload.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(280, 0, 'en', 'validation', 'url', 'The :attribute must be a valid URL.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(281, 0, 'en', 'validation', 'uuid', 'The :attribute must be a valid UUID.', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(282, 0, 'en', 'validation', 'custom.attribute-name.rule-name', 'custom-message', '2022-03-21 00:32:06', '2022-05-31 13:34:48'),
(283, 0, 'en', 'models/notifications', 'types.info', 'Info', '2022-03-21 01:03:21', '2022-05-31 14:13:51'),
(284, 0, 'en', 'models/notifications', 'types.success', 'Success', '2022-03-21 01:03:21', '2022-05-31 14:13:51'),
(285, 0, 'en', 'models/notifications', 'types.warning', 'Warning', '2022-03-21 01:03:21', '2022-05-31 14:13:51'),
(286, 0, 'en', 'models/notifications', 'types.danger', 'Danger', '2022-03-21 01:03:21', '2022-05-31 14:13:51'),
(287, 0, 'ar', 'msg', 'app_name', 'لارافيل', '2022-03-21 01:28:34', '2022-06-01 12:39:38'),
(288, 0, 'en', 'locales', 'en', 'English', '2022-03-21 01:29:47', '2022-03-21 01:30:39'),
(289, 0, 'en', 'locales', 'ar', 'العربية', '2022-03-21 01:29:55', '2022-03-21 01:30:39'),
(290, 0, 'ar', 'locales', 'ar', 'العربية', '2022-03-21 01:30:05', '2022-03-21 01:30:39'),
(291, 0, 'ar', 'locales', 'en', 'English', '2022-03-21 01:30:11', '2022-03-21 01:30:39'),
(292, 0, 'en', 'models/contacts', 'plural', 'Contact messages', '2022-03-21 02:31:00', '2022-06-01 12:58:44'),
(293, 0, 'en', 'models/contacts', 'singular', 'Contact message', '2022-03-21 02:31:00', '2022-06-01 12:58:44'),
(294, 0, 'en', 'models/contacts', 'fields.name', 'Name', '2022-03-21 02:31:00', '2022-06-01 12:58:44'),
(295, 0, 'en', 'models/contacts', 'fields.email', 'Email', '2022-03-21 02:31:00', '2022-06-01 12:58:44'),
(296, 0, 'en', 'models/contacts', 'fields.type', 'Type', '2022-03-21 02:31:00', '2022-06-01 12:58:44'),
(297, 0, 'en', 'models/contacts', 'types.contact', 'Contact us', '2022-03-21 02:31:00', '2022-06-01 12:58:44'),
(298, 0, 'en', 'models/contacts', 'types.complaint', 'Complaint', '2022-03-21 02:31:00', '2022-06-01 12:58:44'),
(299, 0, 'en', 'models/contacts', 'types.enquiry', 'Enquiry', '2022-03-21 02:31:00', '2022-06-01 12:58:44'),
(300, 0, 'en', 'models/contacts', 'types.suggestion', 'Suggestion', '2022-03-21 02:31:00', '2022-06-01 12:58:44'),
(301, 0, 'en', 'models/contacts', 'types.help', 'Help', '2022-03-21 02:31:00', '2022-06-01 12:58:44'),
(302, 0, 'en', 'models/contacts', 'fields.subject', 'Subject', '2022-03-21 02:31:00', '2022-06-01 12:58:44'),
(303, 0, 'en', 'models/contacts', 'fields.message', 'Message', '2022-03-21 02:31:00', '2022-06-01 12:58:44'),
(304, 0, 'en', 'models/contacts', 'fields.read_at', 'Read at', '2022-03-21 02:31:00', '2022-06-01 12:58:44'),
(305, 0, 'en', 'models/contacts', 'fields.reply_message', 'Reply message', '2022-03-21 02:31:00', '2022-06-01 12:58:44'),
(306, 0, 'en', 'crud', 'reply', 'Reply', '2022-03-21 03:19:01', '2022-05-31 11:41:54'),
(307, 1, 'ar', 'models/admins', 'fields.active', 'نشط', '2022-04-19 14:01:05', '2022-04-19 14:01:05'),
(308, 1, 'ar', 'models/admins', 'fields.email', 'البريد الالكتروني', '2022-04-19 14:01:21', '2022-04-19 14:01:21'),
(309, 1, 'ar', 'models/admins', 'fields.name', 'الاسم', '2022-04-19 14:01:27', '2022-04-19 14:01:27'),
(310, 1, 'ar', 'models/admins', 'fields.password', 'كلمة المرور', '2022-04-19 14:01:34', '2022-04-19 14:01:34'),
(311, 1, 'ar', 'models/admins', 'fields.status', 'الحالة', '2022-04-19 14:01:40', '2022-04-19 14:01:40'),
(312, 1, 'ar', 'models/admins', 'plural', 'جمع', '2022-04-19 14:01:59', '2022-04-19 14:01:59'),
(313, 1, 'ar', 'models/admins', 'singular', 'مفرد', '2022-04-19 14:02:07', '2022-04-19 14:02:07'),
(314, 0, 'ar', 'messages', 'deleted', 'حذف', '2022-04-19 14:02:39', '2022-06-01 11:54:52'),
(315, 0, 'ar', 'messages', 'not_found', 'غير موجود', '2022-04-19 14:02:49', '2022-06-01 11:54:52'),
(316, 0, 'ar', 'messages', 'retrieved', 'استرجاع', '2022-04-19 14:06:02', '2022-06-01 11:54:52'),
(317, 0, 'ar', 'messages', 'saved', 'تم الحفظ بنجاح', '2022-04-19 14:06:18', '2022-06-01 11:54:52'),
(318, 0, 'ar', 'messages', 'updated', 'محدث', '2022-04-19 14:06:33', '2022-06-01 11:54:52'),
(319, 0, 'ar', 'models/contacts', 'fields.email', 'البريد الإلكتروني', '2022-04-19 14:07:10', '2022-06-01 12:58:44'),
(320, 0, 'ar', 'models/contacts', 'fields.message', 'الرسائل', '2022-04-19 14:07:18', '2022-06-01 12:58:44'),
(321, 0, 'ar', 'models/contacts', 'fields.name', 'الاسم', '2022-04-19 14:07:24', '2022-06-01 12:58:44'),
(322, 0, 'ar', 'models/contacts', 'fields.read_at', 'قرأ في', '2022-04-19 14:07:48', '2022-06-01 12:58:44'),
(323, 0, 'ar', 'models/contacts', 'fields.reply_message', 'رسالة الرد', '2022-04-19 14:08:03', '2022-06-01 12:58:44'),
(324, 0, 'ar', 'models/contacts', 'fields.subject', 'الموضوع', '2022-04-19 14:08:11', '2022-06-01 12:58:44'),
(325, 0, 'ar', 'models/contacts', 'fields.type', 'النوع', '2022-04-19 14:08:17', '2022-06-01 12:58:44'),
(326, 0, 'ar', 'models/contacts', 'plural', 'رسائل الاتصال', '2022-04-19 14:08:22', '2022-06-01 12:58:44'),
(327, 0, 'ar', 'models/contacts', 'singular', 'رسالة الاتصال', '2022-04-19 14:08:29', '2022-06-01 12:58:44'),
(328, 0, 'ar', 'models/contacts', 'types.complaint', 'شكوى', '2022-04-19 14:09:22', '2022-06-01 12:58:44'),
(329, 0, 'ar', 'models/contacts', 'types.contact', 'اتصل بنا', '2022-04-19 14:19:50', '2022-06-01 12:58:44'),
(330, 0, 'ar', 'models/contacts', 'types.enquiry', 'تحقيق', '2022-04-19 14:20:04', '2022-06-01 12:58:44'),
(331, 0, 'ar', 'models/contacts', 'types.help', 'مساعدة', '2022-04-19 14:20:14', '2022-06-01 12:58:44'),
(332, 0, 'ar', 'models/contacts', 'types.suggestion', 'اقتراح', '2022-04-19 14:20:24', '2022-06-01 12:58:44'),
(333, 0, 'ar', 'msg', 'active', 'نشط', '2022-04-19 14:21:45', '2022-06-01 12:39:38'),
(334, 0, 'ar', 'msg', 'app_users', 'المستخدين', '2022-04-19 14:22:12', '2022-06-01 12:39:38'),
(335, 0, 'ar', 'msg', 'blocked', 'محظور', '2022-04-19 14:22:41', '2022-06-01 12:39:38'),
(336, 0, 'ar', 'msg', 'browse', 'تصفح', '2022-04-19 14:22:54', '2022-06-01 12:39:38'),
(337, 0, 'ar', 'msg', 'check_all_notifications', 'تحقق من جميع الاشعارات', '2022-04-19 14:23:14', '2022-06-01 12:39:38'),
(338, 0, 'ar', 'msg', 'close', 'اغلاق', '2022-04-19 14:26:20', '2022-06-01 12:39:38'),
(339, 0, 'ar', 'msg', 'confirm', 'تاكيد', '2022-04-19 14:26:26', '2022-06-01 12:39:38'),
(340, 0, 'ar', 'msg', 'confirm_password', 'تاكيد كلمة المرور', '2022-04-19 14:26:36', '2022-06-01 12:39:38'),
(341, 0, 'ar', 'msg', 'created_successfully', 'تم إنشاؤه بنجاح', '2022-04-19 14:26:49', '2022-06-01 12:39:38'),
(342, 0, 'ar', 'msg', 'current_password', 'كلمة المرور الحالية', '2022-04-19 14:26:57', '2022-06-01 12:39:38'),
(343, 0, 'ar', 'msg', 'dashboard', 'لوحة التحكم', '2022-04-19 14:27:32', '2022-06-01 12:39:38'),
(344, 0, 'ar', 'msg', 'email', 'البريد الإلكتروني', '2022-04-19 14:27:44', '2022-06-01 12:39:38'),
(345, 0, 'ar', 'msg', 'home', 'الرئيسية', '2022-04-19 14:27:54', '2022-06-01 12:39:38'),
(346, 0, 'ar', 'msg', 'image', 'صورة', '2022-04-19 14:28:03', '2022-06-01 12:39:38'),
(347, 0, 'ar', 'msg', 'inactive', 'غير نشط', '2022-04-19 14:28:13', '2022-06-01 12:39:38'),
(348, 0, 'ar', 'msg', 'mark_as_read', 'ضع علامة مقروء', '2022-04-19 14:28:24', '2022-06-01 12:39:38'),
(349, 0, 'ar', 'msg', 'mark_as_unread', 'وضع علامة كغير مقروءة', '2022-04-19 14:28:49', '2022-06-01 12:39:38'),
(350, 0, 'ar', 'msg', 'messages', 'رسائل', '2022-04-19 14:29:09', '2022-06-01 12:39:38'),
(351, 0, 'ar', 'msg', 'name', 'اسم', '2022-04-19 14:29:20', '2022-06-01 12:39:38'),
(352, 0, 'ar', 'msg', 'new_password', 'كلمة المرور الجديدة', '2022-04-19 14:29:29', '2022-06-01 12:39:38'),
(353, 0, 'ar', 'msg', 'notifications', 'إشعارات', '2022-04-19 14:29:44', '2022-06-01 12:39:38'),
(354, 0, 'ar', 'msg', 'password', 'كلمه السر', '2022-04-19 14:29:54', '2022-06-01 12:39:38'),
(355, 0, 'ar', 'msg', 'phone', 'هاتف', '2022-04-19 14:30:07', '2022-06-01 12:39:38'),
(356, 0, 'ar', 'msg', 'profile', 'الملف الشخصي', '2022-04-19 14:30:16', '2022-06-01 12:39:38'),
(357, 0, 'ar', 'msg', 'search_and_enter', 'البحث والادخال', '2022-04-19 14:30:29', '2022-06-01 12:39:38'),
(358, 0, 'ar', 'msg', 'see_all_messages', 'مشاهدة كل الرسائل', '2022-04-19 14:30:55', '2022-06-01 12:39:38'),
(359, 0, 'ar', 'msg', 'settings', 'إعدادات', '2022-04-19 14:31:05', '2022-06-01 12:39:38'),
(360, 0, 'ar', 'msg', 'submit', 'إرسال', '2022-04-19 14:31:15', '2022-06-01 12:39:38'),
(361, 0, 'ar', 'msg', 'translation', 'ترجمة', '2022-04-19 14:32:10', '2022-06-01 12:39:38'),
(362, 0, 'ar', 'msg', 'updated_successfully', 'تم التحديث بنجاح', '2022-04-19 14:32:27', '2022-06-01 12:39:38'),
(363, 0, 'ar', 'msg', 'upload_file', 'رفع ملف', '2022-04-19 14:32:39', '2022-06-01 12:39:38'),
(364, 0, 'ar', 'msg', 'you_have_n_new_messages', '{0} ليس لديك رسائل جديدة | {1} لديك:n رسالة جديدة | [2 ، *] لديك:n رسائل جديدة', '2022-04-19 14:33:38', '2022-06-01 12:39:38'),
(365, 0, 'ar', 'models/notifications', 'fields.admin_id', 'معرف الادمن', '2022-04-19 14:34:21', '2022-05-31 14:13:51'),
(366, 0, 'ar', 'models/notifications', 'fields.icon', 'أيقونة', '2022-04-19 14:34:41', '2022-05-31 14:13:51'),
(367, 0, 'ar', 'models/notifications', 'fields.provider_id', 'معرف المزود', '2022-04-19 14:35:00', '2022-05-31 14:13:51'),
(368, 0, 'ar', 'models/notifications', 'fields.text', 'نص', '2022-04-19 14:35:31', '2022-05-31 14:13:51'),
(369, 0, 'ar', 'models/notifications', 'fields.title', 'العنوان', '2022-04-19 14:35:41', '2022-05-31 14:13:51'),
(370, 0, 'ar', 'models/notifications', 'fields.to', 'الي', '2022-04-19 14:35:47', '2022-05-31 14:13:51'),
(371, 0, 'ar', 'models/notifications', 'fields.type', 'نوع', '2022-04-19 14:35:54', '2022-05-31 14:13:51'),
(372, 0, 'ar', 'models/notifications', 'fields.url', 'رابط', '2022-04-19 14:36:01', '2022-05-31 14:13:51'),
(373, 0, 'ar', 'models/notifications', 'fields.user_id', 'معرف المستخدم', '2022-04-19 14:36:12', '2022-05-31 14:13:51'),
(374, 0, 'ar', 'models/notifications', 'plural', 'اشعارات', '2022-04-19 14:36:30', '2022-05-31 14:13:51'),
(375, 0, 'ar', 'models/notifications', 'singular', 'اشعار', '2022-04-19 14:36:36', '2022-05-31 14:13:51'),
(376, 0, 'ar', 'models/notifications', 'to.all_admins', 'جميع الادمنز', '2022-04-19 14:37:01', '2022-05-31 14:13:51'),
(377, 0, 'ar', 'models/notifications', 'to.all_providers', 'جميع المزودين', '2022-04-19 14:37:11', '2022-05-31 14:13:51'),
(378, 0, 'ar', 'models/notifications', 'to.all_users', 'جميع المستخدمين', '2022-04-19 14:37:19', '2022-05-31 14:13:51'),
(379, 0, 'ar', 'models/notifications', 'types.danger', 'danger', '2022-04-19 14:37:27', '2022-05-31 14:13:51'),
(380, 0, 'ar', 'models/notifications', 'types.info', 'info', '2022-04-19 14:37:59', '2022-05-31 14:13:51'),
(381, 0, 'ar', 'models/notifications', 'types.primary', 'primary', '2022-04-19 14:38:09', '2022-05-31 14:13:51'),
(382, 0, 'ar', 'models/notifications', 'types.success', 'success', '2022-04-19 14:38:25', '2022-05-31 14:13:51'),
(383, 0, 'ar', 'models/notifications', 'types.warning', 'warning', '2022-04-19 14:38:30', '2022-05-31 14:13:51'),
(384, 0, 'ar', 'auth', 'app.create', 'انشاء', '2022-04-19 14:44:37', '2022-06-29 08:25:39'),
(385, 0, 'ar', 'auth', 'app.export', 'تصدير', '2022-04-19 14:44:48', '2022-06-29 08:25:39'),
(386, 0, 'ar', 'auth', 'app.lock_account', 'قفل الحساب', '2022-04-19 14:45:13', '2022-06-29 08:25:39'),
(387, 0, 'ar', 'auth', 'app.member_since', 'عضو منذ', '2022-04-19 14:45:34', '2022-06-29 08:25:39'),
(388, 0, 'ar', 'auth', 'app.messages', 'رسائل', '2022-04-19 14:45:42', '2022-06-29 08:25:39'),
(389, 0, 'ar', 'auth', 'app.online', 'متصل', '2022-04-19 14:45:54', '2022-06-29 08:25:39'),
(390, 0, 'ar', 'auth', 'app.print', 'طباعة', '2022-04-19 14:46:03', '2022-06-29 08:25:39'),
(391, 0, 'ar', 'auth', 'app.profile', 'الملف الشخصي', '2022-04-19 14:46:15', '2022-06-29 08:25:39'),
(392, 0, 'ar', 'auth', 'app.reload', 'إعادة تحميل', '2022-04-19 14:46:24', '2022-06-29 08:25:39'),
(393, 0, 'ar', 'auth', 'app.reset', 'إعادة تعيين', '2022-04-19 14:46:40', '2022-06-29 08:25:39'),
(394, 0, 'ar', 'auth', 'app.search', 'بحث', '2022-04-19 14:46:47', '2022-06-29 08:25:39'),
(395, 0, 'ar', 'auth', 'app.settings', 'إعدادات', '2022-04-19 14:46:52', '2022-06-29 08:25:39'),
(396, 0, 'ar', 'auth', 'blocked', 'تم حظر حسابك ، يرجى الاتصال بالمسؤول للحصول على مزيد من التفاصيل', '2022-04-19 14:47:53', '2022-06-29 08:25:39'),
(397, 0, 'ar', 'auth', 'confirm_password', 'تأكيد كلمة المرور', '2022-04-19 14:48:01', '2022-06-29 08:25:39'),
(398, 0, 'ar', 'auth', 'confirm_passwords.forgot_your_password', 'نسيت رقمك السري؟', '2022-04-19 14:48:12', '2022-06-29 08:25:39'),
(399, 0, 'ar', 'auth', 'confirm_passwords.send_pwd_confirm', 'تاكيد', '2022-04-19 14:48:27', '2022-06-29 08:25:39'),
(400, 0, 'ar', 'auth', 'confirm_passwords.title', 'يرجى تأكيد كلمة المرور الخاصة بك قبل المتابعة.', '2022-04-19 14:48:37', '2022-06-29 08:25:39'),
(401, 0, 'ar', 'auth', 'email', 'بريد الالكتروني', '2022-04-19 14:48:54', '2022-06-29 08:25:39'),
(402, 0, 'ar', 'auth', 'emails.password.reset_link', 'انقر هنا لإعادة تعيين كلمة المرور الخاصة بك', '2022-04-19 14:49:10', '2022-06-29 08:25:39'),
(403, 0, 'ar', 'auth', 'failed', 'البيانات التالية هذه لا تتطابق مع سجلاتنا', '2022-04-19 14:49:45', '2022-06-29 08:25:39'),
(404, 0, 'ar', 'auth', 'forgot_password.send_pwd_reset', 'إرسال رابط إعادة تعيين كلمة السر', '2022-04-19 14:49:55', '2022-06-29 08:25:39'),
(405, 0, 'ar', 'auth', 'forgot_password.title', 'أدخل البريد الإلكتروني لإعادة تعيين كلمة المرور', '2022-04-19 14:50:07', '2022-06-29 08:25:39'),
(406, 0, 'ar', 'auth', 'full_name', 'الاسم الكامل', '2022-04-19 14:50:21', '2022-06-29 08:25:39'),
(407, 0, 'ar', 'auth', 'inactive', 'غير نشط', '2022-04-19 14:50:33', '2022-06-29 08:25:39'),
(408, 0, 'ar', 'auth', 'login.admin', 'دخول الادمن', '2022-04-19 14:50:45', '2022-06-29 08:25:39'),
(409, 0, 'ar', 'auth', 'login.forgot_password', 'هل نسيت كلمة السر ؟', '2022-04-19 14:50:53', '2022-06-29 08:25:39'),
(410, 0, 'ar', 'auth', 'login.provider', 'دخول شركة النقل', '2022-04-19 14:51:25', '2022-06-29 08:25:39'),
(411, 0, 'ar', 'auth', 'login.register_membership', 'ليس لديك حساب؟', '2022-04-19 14:51:35', '2022-06-29 08:25:39'),
(412, 0, 'ar', 'auth', 'login.remember_me', 'تذكرنى', '2022-04-19 14:51:42', '2022-06-29 08:25:39'),
(413, 0, 'ar', 'auth', 'login.title', 'تسجيل الدخول', '2022-04-19 14:51:51', '2022-06-29 08:25:39'),
(414, 0, 'ar', 'auth', 'name', 'الاسم', '2022-04-19 14:52:01', '2022-06-29 08:25:39'),
(415, 0, 'ar', 'auth', 'password', 'كلمة السر', '2022-04-19 14:52:09', '2022-06-29 08:25:39'),
(416, 0, 'ar', 'auth', 'phone', 'رقم الهاتف', '2022-04-19 14:52:15', '2022-06-29 08:25:39'),
(417, 0, 'ar', 'auth', 'register', 'تسجيل', '2022-04-19 14:52:21', '2022-06-29 08:25:39'),
(418, 0, 'ar', 'auth', 'registration.have_membership', 'هل لديك حساب؟', '2022-04-19 14:52:30', '2022-06-29 08:25:39'),
(419, 0, 'ar', 'auth', 'registration.i_agree', 'أوافق على', '2022-04-19 14:52:37', '2022-06-29 08:25:39'),
(420, 0, 'ar', 'auth', 'registration.terms', 'الشروط', '2022-04-19 14:52:43', '2022-06-29 08:25:39'),
(421, 0, 'ar', 'auth', 'registration.title', 'تسجيل عضوية جديدة', '2022-04-19 14:52:51', '2022-06-29 08:25:39'),
(422, 0, 'ar', 'auth', 'remember_me', 'تذكرنى', '2022-04-19 14:52:58', '2022-06-29 08:25:39'),
(423, 0, 'ar', 'auth', 'reset_password.reset_pwd_btn', 'إعادة تعيين كلمة السر', '2022-04-19 14:53:18', '2022-06-29 08:25:39'),
(424, 0, 'ar', 'auth', 'reset_password.title', 'اعد ضبط كلمه السر', '2022-04-19 14:53:33', '2022-06-29 08:25:39'),
(425, 0, 'ar', 'auth', 'sign_in', 'تسجيل الدخول', '2022-04-19 14:53:40', '2022-06-29 08:25:39'),
(426, 0, 'ar', 'auth', 'sign_out', 'خروج', '2022-04-19 14:53:48', '2022-06-29 08:25:39'),
(427, 0, 'ar', 'auth', 'sign_up', 'اشتراك', '2022-04-19 14:53:55', '2022-06-29 08:25:39'),
(428, 0, 'ar', 'auth', 'throttle', 'محاولات تسجيل دخول كثيرة جدًا. يرجى المحاولة مرة أخرى في :seconds ثواني', '2022-04-19 14:54:51', '2022-06-29 08:25:39'),
(429, 0, 'ar', 'auth', 'unapproved', 'حسابك غير معتمد ، يرجى \n الاتصال بالمسؤول للحصول على مزيد من التفاصيل', '2022-04-19 14:55:05', '2022-06-29 08:25:39'),
(430, 0, 'ar', 'auth', 'verify_email.another_req', 'انقر هنا لطلب آخر', '2022-04-19 14:55:42', '2022-06-29 08:25:39'),
(431, 0, 'ar', 'auth', 'verify_email.error', 'الرابط غير صالح ، يرجى النقر على الرابط أدناه لطلب آخر.', '2022-04-19 14:55:52', '2022-06-29 08:25:39'),
(432, 0, 'ar', 'auth', 'verify_email.error_sending', 'حدث خطأ ما أثناء إرسال رسالة التحقق.', '2022-04-19 14:55:59', '2022-06-29 08:25:39'),
(433, 0, 'ar', 'auth', 'verify_email.notice', 'قبل المتابعة ، يرجى التحقق من بريدك الإلكتروني بحثًا عن رابط التحقق. إذا لم تستلم البريد الإلكتروني ،', '2022-04-19 14:56:12', '2022-06-29 08:25:39'),
(434, 0, 'ar', 'auth', 'verify_email.success', 'تم إرسال رابط تحقق جديد إلى عنوان بريدك الإلكتروني', '2022-04-19 14:56:37', '2022-06-29 08:25:39'),
(435, 0, 'ar', 'auth', 'verify_email.title', 'تحقق من عنوان بريدك الإلكتروني', '2022-04-19 14:56:44', '2022-06-29 08:25:39'),
(436, 0, 'ar', 'auth', 'verify_email.verify_success', 'لقد نجحت في التحقق من عنوان بريدك الإلكتروني.', '2022-04-19 14:56:50', '2022-06-29 08:25:39'),
(437, 0, 'ar', 'auth', 'verify_phone.another_req', 'انقر هنا لطلب آخر', '2022-04-19 14:57:03', '2022-06-29 08:25:39');
INSERT INTO `ltm_translations` (`id`, `status`, `locale`, `group`, `key`, `value`, `created_at`, `updated_at`) VALUES
(438, 0, 'ar', 'auth', 'verify_phone.error', 'الرمز غير صالح ، الرجاء النقر فوق الارتباط أدناه لطلب آخر.', '2022-04-19 14:57:12', '2022-06-29 08:25:39'),
(439, 0, 'ar', 'auth', 'verify_phone.error_sending', 'حدث خطأ ما أثناء إرسال رمز التحقق.', '2022-04-19 14:57:20', '2022-06-29 08:25:39'),
(440, 0, 'ar', 'auth', 'verify_phone.notice', 'قبل المتابعة ، يرجى التحقق من هاتفك بحثًا عن رمز التحقق ، إذا لم تصلك الرسائل القصيرة ،', '2022-04-19 14:57:29', '2022-06-29 08:25:39'),
(441, 0, 'ar', 'auth', 'verify_phone.success', 'تم إرسال رمز تحقق جديد إلى رقم هاتفك', '2022-04-19 14:57:37', '2022-06-29 08:25:39'),
(442, 0, 'ar', 'auth', 'verify_phone.title', 'اكد على رقم هاتفك او جوالك', '2022-04-19 14:57:44', '2022-06-29 08:25:39'),
(443, 0, 'ar', 'auth', 'verify_phone.verify_success', 'لقد نجحت في التحقق من رقم هاتفك.', '2022-04-19 14:57:54', '2022-06-29 08:25:39'),
(444, 0, 'ar', 'models/users', 'fields.block', 'محظور', '2022-04-19 14:59:22', '2022-06-01 10:56:39'),
(445, 0, 'ar', 'models/users', 'fields.block_notes', 'رسائل الحظر', '2022-04-19 14:59:35', '2022-06-01 10:56:39'),
(446, 0, 'ar', 'models/users', 'fields.email', 'بريد الالكتروني', '2022-04-19 14:59:46', '2022-06-01 10:56:39'),
(447, 0, 'ar', 'crud', 'action', 'حدث', '2022-04-19 15:00:41', '2022-05-31 11:41:54'),
(448, 0, 'ar', 'crud', 'add_new', 'اضف جديد', '2022-04-19 15:00:51', '2022-05-31 11:41:54'),
(449, 0, 'ar', 'crud', 'are_you_sure', 'هل أنت واثق؟', '2022-04-19 15:00:58', '2022-05-31 11:41:54'),
(450, 0, 'ar', 'crud', 'back', 'رجوع', '2022-04-19 15:01:05', '2022-05-31 11:41:54'),
(451, 0, 'ar', 'crud', 'cancel', 'الغاء', '2022-04-19 15:01:11', '2022-05-31 11:41:54'),
(452, 0, 'ar', 'crud', 'create', 'انشاء', '2022-04-19 15:01:18', '2022-05-31 11:41:54'),
(453, 0, 'ar', 'crud', 'created_at', 'أنشئت في', '2022-04-19 15:01:25', '2022-05-31 11:41:54'),
(454, 0, 'ar', 'crud', 'deleted_at', 'محذوف في', '2022-04-19 15:01:33', '2022-05-31 11:41:54'),
(455, 0, 'ar', 'crud', 'detail', 'التفاصيل', '2022-04-19 15:01:42', '2022-05-31 11:41:54'),
(456, 0, 'ar', 'crud', 'edit', 'تعديل', '2022-04-19 15:01:49', '2022-05-31 11:41:54'),
(457, 0, 'ar', 'crud', 'id', 'معرف', '2022-04-19 15:01:56', '2022-05-31 11:41:54'),
(458, 0, 'ar', 'crud', 'reply', 'رد', '2022-04-19 15:02:05', '2022-05-31 11:41:54'),
(459, 0, 'ar', 'crud', 'save', 'حفظ', '2022-04-19 15:02:13', '2022-05-31 11:41:54'),
(460, 0, 'ar', 'crud', 'show', 'عرض', '2022-04-19 15:02:16', '2022-05-31 11:41:54'),
(461, 0, 'ar', 'crud', 'updated_at', 'تم التحديث في', '2022-04-19 15:02:23', '2022-05-31 11:41:54'),
(462, 0, 'ar', 'models/providers', 'approved', 'موافق عليه', '2022-04-19 15:14:40', '2022-05-31 13:17:53'),
(463, 0, 'ar', 'models/providers', 'fields.approve', 'موافقة', '2022-04-19 15:14:46', '2022-05-31 13:17:53'),
(464, 0, 'ar', 'models/providers', 'fields.block', 'محظور', '2022-04-19 15:14:53', '2022-05-31 13:17:53'),
(465, 0, 'ar', 'models/providers', 'fields.block_notes', 'رسائل الحظر', '2022-04-19 15:15:13', '2022-05-31 13:17:53'),
(466, 0, 'ar', 'models/providers', 'fields.email', 'البريد الالكتروني', '2022-04-19 15:15:25', '2022-05-31 13:17:53'),
(467, 0, 'ar', 'models/providers', 'fields.image', 'صورة', '2022-04-19 15:15:30', '2022-05-31 13:17:53'),
(468, 0, 'ar', 'models/providers', 'fields.name', 'الاسم', '2022-04-19 15:15:35', '2022-05-31 13:17:53'),
(469, 0, 'ar', 'models/providers', 'fields.notes', 'ملاحظات', '2022-04-19 15:15:46', '2022-05-31 13:17:53'),
(470, 0, 'ar', 'models/providers', 'fields.password', 'كلمة السر', '2022-04-19 15:15:52', '2022-05-31 13:17:53'),
(471, 0, 'ar', 'models/providers', 'fields.phone', 'رقم الهاتف', '2022-04-19 15:16:01', '2022-05-31 13:17:53'),
(472, 0, 'ar', 'models/providers', 'plural', 'شركات النقل', '2022-04-19 15:16:13', '2022-05-31 13:17:53'),
(473, 0, 'ar', 'models/providers', 'singular', 'شركة النقل', '2022-04-19 15:16:20', '2022-05-31 13:17:53'),
(474, 0, 'ar', 'models/providers', 'unapproved', 'غير موافق عليه', '2022-04-19 15:16:31', '2022-05-31 13:17:53'),
(475, 0, 'ar', 'models/users', 'fields.image', 'صورة', '2022-04-19 15:16:45', '2022-06-01 10:56:39'),
(476, 0, 'ar', 'models/users', 'fields.name', 'اسم', '2022-04-19 15:16:50', '2022-06-01 10:56:39'),
(477, 0, 'ar', 'models/users', 'fields.notes', 'ملاحظات', '2022-04-19 15:16:58', '2022-06-01 10:56:39'),
(478, 0, 'ar', 'models/users', 'fields.password', 'كلمة السر', '2022-04-19 15:17:04', '2022-06-01 10:56:39'),
(479, 0, 'ar', 'models/users', 'fields.phone', 'رقم الهاتف', '2022-04-19 15:17:11', '2022-06-01 10:56:39'),
(480, 0, 'ar', 'models/users', 'plural', 'مستخدمين', '2022-04-19 15:17:17', '2022-06-01 10:56:39'),
(481, 0, 'ar', 'models/users', 'singular', 'مستخدم', '2022-04-19 15:17:23', '2022-06-01 10:56:39'),
(482, 1, 'ar', 'pagination', 'next', 'التالي', '2022-04-19 15:18:17', '2022-04-25 21:34:33'),
(483, 1, 'ar', 'pagination', 'previous', 'السابق', '2022-04-19 15:18:22', '2022-04-25 21:34:33'),
(484, 0, 'ar', 'passwords', 'dismatch', 'كلمة المرور لا تطابق كلمة مرورك الحالية.', '2022-04-19 15:18:40', '2022-05-31 13:32:28'),
(485, 0, 'ar', 'passwords', 'reset', 'تم إعادة تعيين كلمة المرور الخاصة بك!', '2022-04-19 15:18:47', '2022-05-31 13:32:28'),
(486, 0, 'ar', 'passwords', 'sent', 'لقد أرسلنا عبر البريد الإلكتروني رابط إعادة تعيين كلمة المرور الخاصة بك!', '2022-04-19 15:18:58', '2022-05-31 13:32:28'),
(487, 0, 'ar', 'passwords', 'throttled', 'الرجاء الانتظار قبل إعادة المحاولة.', '2022-04-19 15:19:08', '2022-05-31 13:32:28'),
(488, 0, 'ar', 'passwords', 'token', 'رمز إعادة تعيين كلمة المرور هذا غير صالح.', '2022-04-19 15:19:21', '2022-05-31 13:32:28'),
(489, 0, 'ar', 'passwords', 'user', 'لا يمكننا العثور على مستخدم بعنوان البريد الإلكتروني هذا.', '2022-04-19 15:19:30', '2022-05-31 13:32:28'),
(490, 0, 'ar', 'models/accounts', 'singular', 'الحساب', '2022-04-21 18:01:52', '2022-05-31 14:10:20'),
(491, 0, 'ar', 'passwords', 'invalid', 'لم يعد الرابط صالحًا ، يرجى طلب آخر!', '2022-04-21 18:01:52', '2022-05-31 13:32:28'),
(492, 0, 'ar', 'passwords', 'success', 'لقد قمت بإعادة تعيين كلمة المرور الخاصة بك بنجاح', '2022-04-21 18:01:52', '2022-05-31 13:32:28'),
(493, 0, 'ar', 'models/buses', 'singular', 'الباص', '2022-04-21 18:01:52', '2022-05-31 12:06:28'),
(494, 0, 'ar', 'models/busOrders', 'singular', 'طلب باص', '2022-04-21 18:01:52', '2022-05-31 13:59:13'),
(495, 0, 'ar', 'models/categories', 'singular', NULL, '2022-04-21 18:01:52', '2022-04-21 18:01:52'),
(496, 0, 'ar', 'models/cities', 'singular', 'المدينة', '2022-04-21 18:01:52', '2022-05-11 07:46:16'),
(497, 0, 'ar', 'models/contacts', 'unread', 'غير مقروء', '2022-04-21 18:01:52', '2022-06-01 12:58:44'),
(498, 0, 'ar', 'models/contacts', 'unreplied', 'لم يتم الرد عليه', '2022-04-21 18:01:52', '2022-06-01 12:58:44'),
(499, 0, 'ar', 'models/contacts', 'replied', 'أجاب', '2022-04-21 18:01:52', '2022-06-01 12:58:44'),
(500, 0, 'ar', 'crud', 'all', 'الجميع', '2022-04-21 18:01:52', '2022-05-31 11:41:54'),
(501, 0, 'ar', 'models/emails', 'singular', 'بريد الكتروني', '2022-04-21 18:01:52', '2022-05-31 12:49:23'),
(502, 0, 'ar', 'models/features', 'singular', 'ميزة', '2022-04-21 18:01:52', '2022-05-31 13:02:24'),
(503, 0, 'ar', 'models/notifications', 'unauthorized', 'غير مصرح', '2022-04-21 18:01:52', '2022-05-31 14:13:51'),
(504, 0, 'ar', 'models/packages', 'singular', 'البرنامج', '2022-04-21 18:01:52', '2022-05-31 14:09:03'),
(505, 0, 'ar', 'models/reviews', 'singular', 'التقييم', '2022-04-21 18:01:52', '2022-05-31 14:22:32'),
(506, 0, 'ar', 'models/services', 'singular', 'خدمة', '2022-04-21 18:01:52', '2022-05-31 13:20:45'),
(507, 0, 'ar', 'models/settings', 'singular', 'الاعدادات', '2022-04-21 18:01:52', '2022-05-31 13:21:32'),
(508, 0, 'ar', 'models/trips', 'singular', 'الرحلة', '2022-04-21 18:01:52', '2022-05-31 14:02:12'),
(509, 0, 'ar', 'models/tripOrders', 'singular', 'طلبات الرحلات', '2022-04-21 18:01:52', '2022-05-31 14:07:50'),
(510, 0, 'ar', 'models/accounts', 'plural', 'الحسابات', '2022-04-21 18:01:52', '2022-05-31 14:10:20'),
(511, 0, 'ar', 'models/buses', 'plural', 'الباصات', '2022-04-21 18:01:52', '2022-05-31 12:06:28'),
(512, 0, 'ar', 'models/busOrders', 'plural', 'طلبات الباصات', '2022-04-21 18:01:52', '2022-05-31 13:59:13'),
(513, 0, 'ar', 'models/categories', 'plural', NULL, '2022-04-21 18:01:52', '2022-04-21 18:01:52'),
(514, 0, 'ar', 'models/cities', 'plural', 'المدن', '2022-04-21 18:01:52', '2022-05-11 07:46:16'),
(515, 0, 'ar', 'models/destinations', 'plural', 'الوجهات', '2022-04-21 18:01:52', '2022-05-31 14:11:39'),
(516, 0, 'ar', 'models/destinations', 'singular', 'وجهة', '2022-04-21 18:01:52', '2022-05-31 14:11:39'),
(517, 0, 'ar', 'models/emails', 'plural', 'بريد الكتروني', '2022-04-21 18:01:52', '2022-05-31 12:49:23'),
(518, 0, 'ar', 'models/features', 'plural', 'ميزات', '2022-04-21 18:01:52', '2022-05-31 13:02:24'),
(519, 0, 'ar', 'models/packages', 'plural', 'البرامج', '2022-04-21 18:01:52', '2022-05-31 14:09:03'),
(520, 0, 'ar', 'models/destinations', 'fields.bus_fees', 'رسوم الحافلات', '2022-04-21 18:01:52', '2022-05-31 14:11:39'),
(521, 0, 'ar', 'models/reviews', 'plural', 'التقيمات', '2022-04-21 18:01:52', '2022-05-31 14:22:32'),
(522, 0, 'ar', 'models/services', 'plural', 'الخدمات', '2022-04-21 18:01:52', '2022-05-31 13:20:45'),
(523, 0, 'ar', 'models/tickets', 'plural', 'التذاكر', '2022-04-21 18:01:52', '2022-05-31 13:23:13'),
(524, 0, 'ar', 'msg', 'this_number_of_tickets_are_not_available', 'هذا العدد من التذاكر غير متوفر', '2022-04-21 18:01:52', '2022-06-01 12:39:38'),
(525, 0, 'ar', 'models/tickets', 'singular', 'التذكرة', '2022-04-21 18:01:52', '2022-05-31 13:23:13'),
(526, 0, 'ar', 'models/trips', 'plural', 'الرحلات', '2022-04-21 18:01:52', '2022-05-31 14:02:12'),
(527, 0, 'ar', 'models/tripOrders', 'plural', 'طلبات الرحلات', '2022-04-21 18:01:52', '2022-05-31 14:07:50'),
(528, 0, 'ar', 'msg', 'please_do_the_payment_and_complete_the_order', 'يرجى القيام بالدفع وإكمال الطلب', '2022-04-21 18:01:52', '2022-06-01 12:39:38'),
(529, 0, 'ar', 'msg', 'please_wait_for_provider_approval_to_do_the_payment_and_complete_the_order', 'يرجى انتظار موافقة المزود للقيام بالدفع وإكمال الطلب', '2022-04-21 18:01:52', '2022-06-01 12:39:38'),
(530, 0, 'ar', 'msg', 'unauthorized', 'غير مصرح', '2022-04-21 18:01:52', '2022-06-01 12:39:38'),
(531, 0, 'ar', 'validation', 'required', 'الحقل :attribute مطلوب.', '2022-04-21 18:01:52', '2022-05-31 13:34:48'),
(532, 0, 'ar', 'models/busOrders', 'fields.user_notes', 'ملاحظات المستخدم', '2022-04-21 18:01:52', '2022-05-31 13:59:13'),
(533, 0, 'ar', 'msg', 'the_payment_link_is_not_valid', 'رابط الدفع غير صالح', '2022-04-21 18:01:52', '2022-06-01 12:39:38'),
(534, 0, 'ar', 'models/accounts', 'active', 'نشط', '2022-04-21 18:01:52', '2022-05-31 14:10:20'),
(535, 0, 'ar', 'models/accounts', 'inactive', 'غير نشط', '2022-04-21 18:01:52', '2022-05-31 14:10:20'),
(536, 0, 'ar', 'msg', 'yes', 'نعم', '2022-04-21 18:01:52', '2022-06-01 12:39:38'),
(537, 0, 'ar', 'msg', 'no', 'رقم', '2022-04-21 18:01:52', '2022-06-01 12:39:38'),
(538, 0, 'ar', 'models/accounts', 'fields.provider_id', NULL, '2022-04-21 18:01:52', '2022-04-21 18:01:52'),
(539, 0, 'ar', 'models/accounts', 'fields.username', 'اسم المستخدم', '2022-04-21 18:01:52', '2022-05-31 14:10:20'),
(540, 0, 'ar', 'models/accounts', 'fields.password', 'كلمة المرور', '2022-04-21 18:01:52', '2022-05-31 14:10:20'),
(541, 0, 'ar', 'models/accounts', 'fields.active', 'نشط', '2022-04-21 18:01:52', '2022-05-31 14:10:20'),
(542, 0, 'ar', 'models/accounts', 'fields.email', 'البريد الالكتروني', '2022-04-21 18:01:52', '2022-05-31 14:10:20'),
(543, 0, 'ar', 'models/accounts', 'fields.phone', 'رقم الهاتف', '2022-04-21 18:01:52', '2022-05-31 14:10:20'),
(544, 0, 'ar', 'models/accounts', 'fields.role', 'وظيفة', '2022-04-21 18:01:52', '2022-05-31 14:10:20'),
(546, 0, 'ar', 'crud', 'print', 'طباعة', '2022-04-21 18:01:52', '2022-05-31 11:41:54'),
(547, 0, 'ar', 'models/busOrders', 'fields.provider_notes', 'ملاحظة شركة النقل', '2022-04-21 18:01:52', '2022-05-31 13:59:13'),
(548, 0, 'ar', 'models/busOrders', 'fields.created_at', 'أنشئت في', '2022-04-21 18:01:52', '2022-05-31 13:59:13'),
(549, 0, 'ar', 'models/categories', 'fields.name', 'الاسم', '2022-04-21 18:01:52', '2022-05-31 12:06:46'),
(550, 0, 'ar', 'models/cities', 'fields.name', 'الاسم', '2022-04-21 18:01:52', '2022-05-11 07:46:16'),
(552, 0, 'ar', 'models/emails', 'fields.email', 'بريد الكتروني', '2022-04-21 18:01:52', '2022-05-31 12:49:23'),
(553, 0, 'ar', 'models/features', 'fields.title', 'لقب', '2022-04-21 18:01:52', '2022-05-31 13:02:24'),
(554, 0, 'ar', 'models/features', 'fields.text', 'نص', '2022-04-21 18:01:52', '2022-05-31 13:02:24'),
(555, 0, 'ar', 'models/features', 'fields.icon', 'أيقونة', '2022-04-21 18:01:52', '2022-05-31 13:02:24'),
(556, 0, 'ar', 'msg', 'updoad_file', 'رفع ملف', '2022-04-21 18:01:52', '2022-06-01 12:39:38'),
(557, 0, 'ar', 'msg', 'app_name_by_developer_name', 'كيو بص', '2022-04-21 18:01:52', '2022-06-01 12:39:38'),
(558, 0, 'ar', 'msg', 'orders', 'أوامر', '2022-04-21 18:01:52', '2022-06-01 12:39:38'),
(560, 0, 'ar', 'models/providers', 'fields.address', 'العنوان', '2022-04-21 18:01:53', '2022-05-31 13:17:53'),
(561, 0, 'ar', 'models/providers', 'fields.comm_name', 'الاسم', '2022-04-21 18:01:53', '2022-05-31 13:17:53'),
(562, 0, 'ar', 'models/providers', 'fields.comm_reg_num', 'الرقم', '2022-04-21 18:01:53', '2022-05-31 13:17:53'),
(563, 0, 'ar', 'models/providers', 'fields.comm_reg_img', 'الصورة', '2022-04-21 18:01:53', '2022-05-31 13:17:53'),
(564, 0, 'ar', 'models/providers', 'fields.tax_cert_num', 'رقم الشهادة الضريبية', '2022-04-21 18:01:53', '2022-05-31 13:17:53'),
(565, 0, 'ar', 'models/providers', 'fields.tax', 'ضريبة', '2022-04-21 18:01:53', '2022-05-31 13:17:53'),
(566, 0, 'ar', 'msg', 'from', 'من', '2022-04-21 18:01:53', '2022-06-01 12:39:38'),
(567, 0, 'ar', 'models/reviews', 'fields.publish', 'نشر', '2022-04-21 18:01:53', '2022-05-31 14:22:32'),
(568, 0, 'ar', 'models/services', 'fields.title', 'عنوان', '2022-04-21 18:01:53', '2022-05-31 13:20:45'),
(569, 0, 'ar', 'models/services', 'fields.text', 'نص', '2022-04-21 18:01:53', '2022-05-31 13:20:45'),
(570, 0, 'ar', 'models/services', 'fields.image', 'صورة', '2022-04-21 18:01:53', '2022-05-31 13:20:45'),
(571, 0, 'ar', 'models/settings', 'plural', 'الاعدادات', '2022-04-21 18:01:53', '2022-05-31 13:21:32'),
(572, 0, 'ar', 'msg', 'taken', 'مأخوذ', '2022-04-21 18:01:53', '2022-06-01 12:39:38'),
(573, 0, 'ar', 'models/tickets', 'fields.seat_num', 'رقم المقعد', '2022-04-21 18:01:53', '2022-05-31 13:23:13'),
(574, 0, 'ar', 'models/users', 'fields.address', 'العنوان', '2022-04-21 18:01:53', '2022-06-01 10:56:39'),
(575, 0, 'ar', 'models/users', 'fields.date_of_birth', 'تاريخ الميلاد', '2022-04-21 18:01:53', '2022-06-01 10:56:39'),
(576, 0, 'ar', 'models/users', 'fields.marital_status', 'الحالة الاجتماعية', '2022-04-21 18:01:53', '2022-06-01 10:56:39'),
(578, 0, 'ar', 'auth', 'verify_phone.subtitle', 'أدخل رمز التحقق المكون من 6 أرقام المرسل إلى رقم هاتفك.', '2022-04-21 18:01:53', '2022-06-29 08:25:39'),
(579, 0, 'ar', 'auth', 'verify_phone.input', 'رمز التحقق المكون من 6 أرقام', '2022-04-21 18:01:53', '2022-06-29 08:25:39'),
(580, 0, 'ar', 'crud', 'confirm', 'تاكيد', '2022-04-21 18:01:53', '2022-05-31 11:41:54'),
(581, 0, 'ar', 'msg', 'ignore_email', 'تجاهل البريد الإلكتروني', '2022-04-21 18:01:53', '2022-06-01 12:39:38'),
(582, 0, 'ar', 'msg', 'about', 'من نحن', '2022-04-21 18:01:53', '2022-06-01 12:39:38'),
(583, 0, 'ar', 'msg', 'contact', 'اتصل بنا', '2022-04-21 18:01:53', '2022-06-01 12:39:38'),
(584, 0, 'ar', 'msg', 'send_message', 'إرسال رسالة', '2022-04-21 18:01:53', '2022-06-01 12:39:38'),
(585, 0, 'ar', 'msg', 'click_here', 'اضغط هنا', '2022-04-21 18:01:53', '2022-06-01 12:39:38'),
(586, 0, 'ar', 'msg', 'enter_your_email', 'ادخل البريد الالكتروني', '2022-04-21 18:01:53', '2022-06-01 12:39:38'),
(587, 0, 'ar', 'crud', 'subscribe', 'اشتراك', '2022-04-21 18:01:53', '2022-05-31 11:41:54'),
(588, 0, 'ar', 'msg', 'services', 'خدمات', '2022-04-21 18:01:53', '2022-06-01 12:39:38'),
(589, 0, 'ar', 'msg', 'trips', 'رحلات', '2022-04-21 18:01:53', '2022-06-01 12:39:38'),
(590, 0, 'ar', 'msg', 'type_your_search_keword', 'اكتب كلمة البحث', '2022-04-21 18:01:53', '2022-06-01 12:39:38'),
(591, 0, 'ar', 'msg', 'filter_options', 'filter', '2022-04-21 18:01:53', '2022-06-01 12:39:38'),
(592, 0, 'ar', 'msg', 'select', 'تحديد', '2022-04-21 18:01:53', '2022-06-01 12:39:38'),
(593, 0, 'ar', 'msg', 'search', 'بحث', '2022-04-21 18:01:53', '2022-06-01 12:39:38'),
(594, 0, 'ar', 'msg', 'trip_starts_on', 'تبدأ الرحلة', '2022-04-21 18:01:53', '2022-06-01 12:39:38'),
(595, 0, 'ar', 'msg', 'seats_only', 'مقاعد_ فقط', '2022-04-21 18:01:53', '2022-06-01 12:39:38'),
(596, 0, 'ar', 'msg', 'order_now', 'اطلب الان', '2022-04-21 18:01:53', '2022-06-01 12:39:38'),
(597, 0, 'ar', 'auth', 'provider.verify', 'التاكيد', '2022-04-21 18:01:53', '2022-06-29 08:25:39'),
(598, 0, 'ar', 'auth', 'provider.account', 'الحساب', '2022-04-21 18:01:53', '2022-06-29 08:25:39'),
(599, 0, 'ar', 'auth', 'account.title', 'اعتماد الحساب', '2022-04-21 18:01:53', '2022-06-29 08:25:39'),
(600, 0, 'ar', 'auth', 'account.subtitle', 'قم بإنشاء حسابك الأول لتسجيل الدخول إلى لوحة التحكم الخاصة بك', '2022-04-21 18:01:53', '2022-06-29 08:25:39'),
(601, 0, 'ar', 'auth', 'provider.title', 'العنوان', '2022-04-21 18:01:53', '2022-06-29 08:25:39'),
(602, 0, 'ar', 'auth', 'step', 'هذه الخطوة :n', '2022-04-21 18:01:53', '2022-06-29 08:25:39'),
(603, 0, 'ar', 'models/buses', 'fields.plate', 'اللوحة', '2022-04-21 18:01:53', '2022-05-31 12:06:28'),
(604, 0, 'ar', 'models/buses', 'fields.image', 'صورة', '2022-04-21 18:01:53', '2022-05-31 12:06:28'),
(605, 0, 'ar', 'models/buses', 'fields.passengers', 'الركاب', '2022-04-21 18:01:53', '2022-05-31 12:06:28'),
(606, 0, 'ar', 'models/buses', 'fields.account_id', 'معرف الحساب', '2022-04-21 18:01:53', '2022-05-31 12:06:28'),
(607, 0, 'ar', 'models/busOrders', 'fields.status', 'الحالة', '2022-04-21 18:01:53', '2022-05-31 13:59:13'),
(608, 0, 'ar', 'models/busOrders', 'status.pending', 'ريثما', '2022-04-21 18:01:53', '2022-05-31 13:59:13'),
(609, 0, 'ar', 'models/busOrders', 'status.approved', 'وافق', '2022-04-21 18:01:53', '2022-05-31 13:59:13'),
(610, 0, 'ar', 'models/busOrders', 'status.rejected', 'مرفوض', '2022-04-21 18:01:53', '2022-05-31 13:59:13'),
(611, 0, 'ar', 'models/busOrders', 'fields.fees', 'الرسوم', '2022-04-21 18:01:53', '2022-05-31 13:59:13'),
(612, 0, 'ar', 'msg', 'calender', 'تقويم', '2022-04-21 18:01:53', '2022-06-01 12:39:38'),
(613, 0, 'ar', 'models/destinations', 'fields.to_city_id', 'إلى معرف المدينة', '2022-04-21 18:01:53', '2022-05-31 14:11:39'),
(614, 0, 'ar', 'models/packages', 'fields.name', 'اسم', '2022-04-21 18:01:53', '2022-05-31 14:09:03'),
(615, 0, 'ar', 'models/packages', 'fields.bus_fees', 'رسوم الحافلات', '2022-04-21 18:01:53', '2022-05-31 14:09:03'),
(616, 0, 'ar', 'models/trips', 'fields.bus_id', 'معرف الباص', '2022-04-21 18:01:53', '2022-05-31 14:02:12'),
(617, 0, 'ar', 'models/trips', 'fields.max', NULL, '2022-04-21 18:01:53', '2022-04-21 18:01:53'),
(618, 0, 'ar', 'models/trips', 'fields.fees', 'الرسوم', '2022-04-21 18:01:53', '2022-05-31 14:02:12'),
(619, 0, 'ar', 'models/trips', 'fields.date_from', 'التاريخ من', '2022-04-21 18:01:53', '2022-05-31 14:02:12'),
(620, 0, 'ar', 'models/trips', 'fields.time_from', 'الوقت من', '2022-04-21 18:01:53', '2022-05-31 14:02:12'),
(621, 0, 'ar', 'models/trips', 'fields.date_to', 'التاريخ الي', '2022-04-21 18:01:53', '2022-05-31 14:02:12'),
(622, 0, 'ar', 'models/trips', 'fields.time_to', 'الوقت الي', '2022-04-21 18:01:53', '2022-05-31 14:02:12'),
(623, 0, 'ar', 'models/trips', 'fields.name', NULL, '2022-04-21 18:01:53', '2022-04-21 18:01:53'),
(624, 0, 'ar', 'models/trips', 'fields.description', 'الوصف', '2022-04-21 18:01:53', '2022-05-31 14:02:12'),
(625, 0, 'ar', 'models/trips', 'fields.provider_notes', 'ملاحظات شركة النقل', '2022-04-21 18:01:53', '2022-05-31 14:02:12'),
(626, 0, 'ar', 'models/trips', 'fields.meal', NULL, '2022-04-21 18:01:53', '2022-04-21 18:01:53'),
(627, 0, 'ar', 'models/trips', 'fields.hotel', NULL, '2022-04-21 18:01:53', '2022-04-21 18:01:53'),
(628, 0, 'ar', 'models/trips', 'fields.auto_approve', 'الموافقة التلقائية', '2022-04-21 18:01:53', '2022-05-31 14:02:12'),
(629, 0, 'ar', 'models/trips', 'fields.type', 'النوع', '2022-04-21 18:01:53', '2022-05-31 14:02:12'),
(631, 0, 'ar', 'crud', 'submit', 'إرسال', '2022-04-21 18:01:53', '2022-05-31 11:41:54'),
(632, 0, 'ar', 'msg', 'error', 'خطا', '2022-04-21 18:01:53', '2022-06-01 12:39:38'),
(633, 0, 'ar', 'models/tripOrders', 'fields.status', 'الحالة', '2022-04-21 18:01:53', '2022-05-31 14:07:50'),
(634, 0, 'ar', 'models/tripOrders', 'status.pending', 'ريثما', '2022-04-21 18:01:53', '2022-05-31 14:07:50'),
(635, 0, 'ar', 'models/tripOrders', 'status.approved', 'موافق', '2022-04-21 18:01:53', '2022-05-31 14:07:50'),
(636, 0, 'ar', 'models/tripOrders', 'status.rejected', 'مرفوض', '2022-04-21 18:01:53', '2022-05-31 14:07:50'),
(637, 0, 'ar', 'models/tripOrders', 'fields.provider_notes', 'ملاحظات شركة النقل', '2022-04-21 18:01:53', '2022-05-31 14:07:50'),
(638, 0, 'ar', 'models/busOrders', 'fields.date_from', 'التاريخ من', '2022-04-21 18:01:53', '2022-05-31 13:59:13'),
(639, 0, 'ar', 'models/busOrders', 'fields.time_from', 'الوقت من', '2022-04-21 18:01:53', '2022-05-31 13:59:13'),
(640, 0, 'ar', 'models/busOrders', 'fields.date_to', 'التاريخ إلى', '2022-04-21 18:01:53', '2022-05-31 13:59:13'),
(641, 0, 'ar', 'models/busOrders', 'fields.time_to', 'الوقت الي', '2022-04-21 18:01:53', '2022-05-31 13:59:13'),
(642, 0, 'ar', 'crud', 'select', 'اختار', '2022-04-21 18:01:53', '2022-05-31 11:41:54'),
(643, 0, 'ar', 'crud', 'payment', 'الدفع', '2022-04-21 18:01:53', '2022-05-31 11:41:54'),
(644, 0, 'ar', 'msg', 'my_complaints', 'شكاوي', '2022-04-21 18:01:53', '2022-06-01 12:39:38'),
(645, 0, 'ar', '_json', 'you_have_n_new_messages', NULL, '2022-04-21 18:01:53', '2022-04-21 18:01:53'),
(646, 0, 'ar', '_json', 'Upload File', NULL, '2022-04-21 18:01:53', '2022-04-21 18:01:53'),
(647, 0, 'ar', '_json', 'All settings', NULL, '2022-04-21 18:01:53', '2022-04-21 18:01:53'),
(648, 0, 'ar', '_json', 'This is a secure area of the application. Please confirm your password before continuing.', NULL, '2022-04-21 18:01:53', '2022-04-21 18:01:53'),
(649, 0, 'ar', '_json', 'Password', NULL, '2022-04-21 18:01:53', '2022-04-21 18:01:53'),
(650, 0, 'ar', '_json', 'Confirm', NULL, '2022-04-21 18:01:53', '2022-04-21 18:01:53'),
(651, 0, 'ar', '_json', 'Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.', NULL, '2022-04-21 18:01:53', '2022-04-21 18:01:53'),
(652, 0, 'ar', '_json', 'Email', NULL, '2022-04-21 18:01:53', '2022-04-21 18:01:53'),
(653, 0, 'ar', '_json', 'Email Password Reset Link', NULL, '2022-04-21 18:01:53', '2022-04-21 18:01:53'),
(654, 0, 'ar', '_json', 'Confirm Password', NULL, '2022-04-21 18:01:53', '2022-04-21 18:01:53'),
(655, 0, 'ar', '_json', 'Reset Password', NULL, '2022-04-21 18:01:53', '2022-04-21 18:01:53'),
(656, 0, 'ar', '_json', 'A new verification link has been sent to the email address you provided during registration.', NULL, '2022-04-21 18:01:53', '2022-04-21 18:01:53'),
(657, 0, 'ar', '_json', 'Resend Verification Email', NULL, '2022-04-21 18:01:53', '2022-04-21 18:01:53'),
(658, 0, 'ar', '_json', 'Log Out', NULL, '2022-04-21 18:01:53', '2022-04-21 18:01:53'),
(659, 0, 'ar', '_json', 'Whoops! Something went wrong.', NULL, '2022-04-21 18:01:53', '2022-04-21 18:01:53'),
(660, 0, 'ar', 'models/additionals', 'singular', 'الاضافة', '2022-04-25 21:34:29', '2022-05-31 12:00:31'),
(661, 0, 'ar', 'models/terminals', 'singular', 'المحطة', '2022-04-25 21:34:29', '2022-05-31 13:22:05'),
(662, 0, 'ar', 'models/additionals', 'plural', 'الاضافات', '2022-04-25 21:34:29', '2022-05-31 12:00:31'),
(663, 0, 'ar', 'models/terminals', 'plural', 'المحطات', '2022-04-25 21:34:29', '2022-05-31 13:22:05'),
(664, 0, 'ar', 'models/tripOrders', 'fields.user_notes', 'ملاحظات المستخدم', '2022-04-25 21:34:29', '2022-05-31 14:07:50'),
(665, 0, 'ar', 'models/additionals', 'fields.name', 'الاسم', '2022-04-25 21:34:29', '2022-05-31 12:00:31'),
(666, 0, 'ar', 'models/additionals', 'fields.icon', 'ايقونة', '2022-04-25 21:34:29', '2022-05-31 12:00:31'),
(667, 0, 'ar', 'models/trips', 'datetime', 'الوقت والتاريخ', '2022-04-25 21:34:29', '2022-05-31 14:02:12'),
(668, 0, 'ar', 'models/trips', 'features', 'المميزات', '2022-04-25 21:34:29', '2022-05-31 14:02:12'),
(669, 0, 'ar', 'msg', 'lowest', 'أدنى', '2022-04-25 21:34:29', '2022-06-01 12:39:38'),
(670, 0, 'ar', 'msg', 'heighest', 'أعلى', '2022-04-25 21:34:29', '2022-06-01 12:39:38'),
(671, 0, 'ar', 'models/destinations', 'fields.from_city_id', 'من معرف المدينة', '2022-04-25 21:34:29', '2022-05-31 14:11:39'),
(672, 0, 'ar', 'models/destinations', 'fields.starting_terminal_id', 'بدء معرف المحطة', '2022-04-25 21:34:29', '2022-05-31 14:11:39'),
(673, 0, 'ar', 'models/destinations', 'fields.stops', 'توقف', '2022-04-25 21:34:29', '2022-05-31 14:11:39'),
(674, 0, 'ar', 'models/destinations', 'fields.arrival_terminal_id', 'وصول معرف المحطة', '2022-04-25 21:34:29', '2022-05-31 14:11:39'),
(675, 0, 'ar', 'models/terminals', 'fields.name', 'الاسم', '2022-04-25 21:34:29', '2022-05-31 13:22:05'),
(676, 0, 'ar', 'passwords', 'password', 'يجب أن لا يقل طول كلمة المرور عن ستة أحرف، كما يجب أن تتطابق مع حقل التأكيد', '2022-04-25 21:34:33', '2022-05-31 13:32:28'),
(677, 0, 'ar', 'validation', 'accepted', 'يجب قبول الحقل :attribute', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(678, 0, 'ar', 'validation', 'active_url', 'الحقل :attribute لا يُمثّل رابطًا صحيحًا', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(679, 0, 'ar', 'validation', 'after', 'يجب على الحقل :attribute أن يكون تاريخًا لاحقًا للتاريخ :date.', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(680, 0, 'ar', 'validation', 'after_or_equal', 'الحقل :attribute يجب أن يكون تاريخاً لاحقاً أو مطابقاً للتاريخ :date.', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(681, 0, 'ar', 'validation', 'alpha', 'يجب أن لا يحتوي الحقل :attribute سوى على حروف', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(682, 0, 'ar', 'validation', 'alpha_dash', 'يجب أن لا يحتوي الحقل :attribute على حروف، أرقام ومطّات.', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(683, 0, 'ar', 'validation', 'alpha_num', 'يجب أن يحتوي :attribute على حروفٍ وأرقامٍ فقط', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(684, 0, 'ar', 'validation', 'array', 'يجب أن يكون الحقل :attribute ًمصفوفة', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(685, 0, 'ar', 'validation', 'before', 'يجب على الحقل :attribute أن يكون تاريخًا سابقًا للتاريخ :date.', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(686, 0, 'ar', 'validation', 'before_or_equal', 'الحقل :attribute يجب أن يكون تاريخا سابقا أو مطابقا للتاريخ :date', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(687, 0, 'ar', 'validation', 'between.numeric', 'يجب أن تكون قيمة :attribute بين :min و :max.', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(688, 0, 'ar', 'validation', 'between.file', 'يجب أن يكون حجم الملف :attribute بين :min و :max كيلوبايت.', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(689, 0, 'ar', 'validation', 'between.string', 'يجب أن يكون عدد حروف النّص :attribute بين :min و :max', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(690, 0, 'ar', 'validation', 'between.array', 'يجب أن يحتوي :attribute على عدد من العناصر بين :min و :max', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(691, 0, 'ar', 'validation', 'boolean', 'يجب أن تكون قيمة الحقل :attribute إما true أو false ', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(692, 0, 'ar', 'validation', 'confirmed', 'حقل التأكيد غير مُطابق للحقل :attribute', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(693, 0, 'ar', 'validation', 'date', 'الحقل :attribute ليس تاريخًا صحيحًا', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(694, 0, 'ar', 'validation', 'date_format', 'لا يتوافق الحقل :attribute مع الشكل :format.', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(695, 0, 'ar', 'validation', 'different', 'يجب أن يكون الحقلان :attribute و :other مُختلفان', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(696, 0, 'ar', 'validation', 'digits', 'يجب أن يحتوي الحقل :attribute على :digits رقمًا/أرقام', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(697, 0, 'ar', 'validation', 'digits_between', 'يجب أن يحتوي الحقل :attribute بين :min و :max رقمًا/أرقام ', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(698, 0, 'ar', 'validation', 'dimensions', 'الـ :attribute يحتوي على أبعاد صورة غير صالحة.', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(699, 0, 'ar', 'validation', 'distinct', 'للحقل :attribute قيمة مُكرّرة.', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(700, 0, 'ar', 'validation', 'email', 'يجب أن يكون :attribute عنوان بريد إلكتروني صحيح البُنية', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(701, 0, 'ar', 'validation', 'exists', 'الحقل :attribute لاغٍ', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(702, 0, 'ar', 'validation', 'file', 'الـ :attribute يجب أن يكون من ملفا.', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(703, 0, 'ar', 'validation', 'filled', 'الحقل :attribute إجباري', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(704, 0, 'ar', 'validation', 'image', 'يجب أن يكون الحقل :attribute صورةً', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(705, 0, 'ar', 'validation', 'in', 'الحقل :attribute لاغٍ', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(706, 0, 'ar', 'validation', 'in_array', 'الحقل :attribute غير موجود في :other.', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(707, 0, 'ar', 'validation', 'integer', 'يجب أن يكون الحقل :attribute عددًا صحيحًا', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(708, 0, 'ar', 'validation', 'ip', 'يجب أن يكون الحقل :attribute عنوان IP ذا بُنية صحيحة', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(709, 0, 'ar', 'validation', 'ipv4', 'يجب أن يكون الحقل :attribute عنوان IPv4 ذا بنية صحيحة.', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(710, 0, 'ar', 'validation', 'ipv6', 'يجب أن يكون الحقل :attribute عنوان IPv6 ذا بنية صحيحة.', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(711, 0, 'ar', 'validation', 'json', 'يجب أن يكون الحقل :attribute نصا من نوع JSON.', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(712, 0, 'ar', 'validation', 'max.numeric', 'يجب أن تكون قيمة الحقل :attribute مساوية أو أصغر لـ :max.', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(713, 0, 'ar', 'validation', 'max.file', 'يجب أن لا يتجاوز حجم الملف :attribute :max كيلوبايت', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(714, 0, 'ar', 'validation', 'max.string', 'يجب أن لا يتجاوز طول نص :attribute :max حروفٍ/حرفًا', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(715, 0, 'ar', 'validation', 'max.array', 'يجب أن لا يحتوي الحقل :attribute على أكثر من :max عناصر/عنصر.', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(716, 0, 'ar', 'validation', 'mimes', 'يجب أن يكون الحقل ملفًا من نوع : :values.', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(717, 0, 'ar', 'validation', 'mimetypes', 'يجب أن يكون الحقل ملفًا من نوع : :values.', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(718, 0, 'ar', 'validation', 'min.numeric', 'يجب أن تكون قيمة الحقل :attribute مساوية أو أكبر لـ :min.', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(719, 0, 'ar', 'validation', 'min.file', 'يجب أن يكون حجم الملف :attribute على الأقل :min كيلوبايت', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(720, 0, 'ar', 'validation', 'min.string', 'يجب أن يكون طول نص :attribute على الأقل :min حروفٍ/حرفًا', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(721, 0, 'ar', 'validation', 'min.array', 'يجب أن يحتوي الحقل :attribute على الأقل على :min عُنصرًا/عناصر', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(722, 0, 'ar', 'validation', 'not_in', 'الحقل :attribute لاغٍ', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(723, 0, 'ar', 'validation', 'numeric', 'يجب على الحقل :attribute أن يكون رقمًا', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(724, 0, 'ar', 'validation', 'present', 'يجب تقديم الحقل :attribute', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(725, 0, 'ar', 'validation', 'regex', 'صيغة الحقل :attribute .غير صحيحة', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(726, 0, 'ar', 'validation', 'required_if', 'الحقل :attribute مطلوب في حال ما إذا كان :other يساوي :value.', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(727, 0, 'ar', 'validation', 'required_unless', 'الحقل :attribute مطلوب في حال ما لم يكن :other يساوي :values.', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(728, 0, 'ar', 'validation', 'required_with', 'الحقل :attribute إذا توفّر :values.', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(729, 0, 'ar', 'validation', 'required_with_all', 'الحقل :attribute إذا توفّر :values.', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(730, 0, 'ar', 'validation', 'required_without', 'الحقل :attribute إذا لم يتوفّر :values.', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(731, 0, 'ar', 'validation', 'required_without_all', 'الحقل :attribute إذا لم يتوفّر :values.', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(732, 0, 'ar', 'validation', 'same', 'يجب أن يتطابق الحقل :attribute مع :other', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(733, 0, 'ar', 'validation', 'size.numeric', 'يجب أن تكون قيمة الحقل :attribute مساوية لـ :size', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(734, 0, 'ar', 'validation', 'size.file', 'يجب أن يكون حجم الملف :attribute :size كيلوبايت', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(735, 0, 'ar', 'validation', 'size.string', 'يجب أن يحتوي النص :attribute على :size حروفٍ/حرفًا بالظبط', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(736, 0, 'ar', 'validation', 'size.array', 'يجب أن يحتوي الحقل :attribute على :size عنصرٍ/عناصر بالظبط', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(737, 0, 'ar', 'validation', 'string', 'يجب أن يكون الحقل :attribute نصآ.', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(738, 0, 'ar', 'validation', 'timezone', 'يجب أن يكون :attribute نطاقًا زمنيًا صحيحًا', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(739, 0, 'ar', 'validation', 'unique', 'قيمة الحقل :attribute مُستخدمة من قبل', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(740, 0, 'ar', 'validation', 'uploaded', 'فشل في تحميل الـ :attribute', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(741, 0, 'ar', 'validation', 'url', 'صيغة الرابط :attribute غير صحيحة', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(742, 0, 'ar', 'validation', 'custom.attribute-name.rule-name', 'custom-message', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(743, 0, 'ar', 'validation', 'attributes.name', 'الاسم', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(744, 0, 'ar', 'validation', 'attributes.username', 'اسم المُستخدم', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(745, 0, 'ar', 'validation', 'attributes.email', 'البريد الالكتروني', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(746, 0, 'ar', 'validation', 'attributes.fname', 'الاسم', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(747, 0, 'ar', 'validation', 'attributes.lname', 'اسم العائلة', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(748, 0, 'ar', 'validation', 'attributes.password', 'كلمة المرور', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(749, 0, 'ar', 'validation', 'attributes.password_confirmation', 'تأكيد كلمة المرور', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(750, 0, 'ar', 'validation', 'attributes.city', 'المدينة', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(751, 0, 'ar', 'validation', 'attributes.country', 'الدولة', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(752, 0, 'ar', 'validation', 'attributes.address', 'العنوان', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(753, 0, 'ar', 'validation', 'attributes.phone', 'الهاتف', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(754, 0, 'ar', 'validation', 'attributes.mobile', 'الجوال', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(755, 0, 'ar', 'validation', 'attributes.age', 'العمر', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(756, 0, 'ar', 'validation', 'attributes.sex', 'الجنس', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(757, 0, 'ar', 'validation', 'attributes.gender', 'النوع', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(758, 0, 'ar', 'validation', 'attributes.day', 'اليوم', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(759, 0, 'ar', 'validation', 'attributes.month', 'الشهر', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(760, 0, 'ar', 'validation', 'attributes.year', 'السنة', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(761, 0, 'ar', 'validation', 'attributes.hour', 'ساعة', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(762, 0, 'ar', 'validation', 'attributes.minute', 'دقيقة', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(763, 0, 'ar', 'validation', 'attributes.second', 'ثانية', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(764, 0, 'ar', 'validation', 'attributes.content', 'المُحتوى', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(765, 0, 'ar', 'validation', 'attributes.description', 'الوصف', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(766, 0, 'ar', 'validation', 'attributes.excerpt', 'المُلخص', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(767, 0, 'ar', 'validation', 'attributes.date', 'التاريخ', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(768, 0, 'ar', 'validation', 'attributes.time', 'الوقت', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(769, 0, 'ar', 'validation', 'attributes.available', 'مُتاح', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(770, 0, 'ar', 'validation', 'attributes.size', 'الحجم', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(771, 0, 'ar', 'validation', 'attributes.price', 'السعر', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(772, 0, 'ar', 'validation', 'attributes.desc', 'نبذه', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(773, 0, 'ar', 'validation', 'attributes.title', 'العنوان', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(774, 0, 'ar', 'validation', 'attributes.q', 'البحث', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(775, 0, 'ar', 'validation', 'attributes.link', ' ', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(776, 0, 'ar', 'validation', 'attributes.slug', ' ', '2022-04-25 21:34:33', '2022-05-31 13:34:48'),
(777, 0, 'en', 'auth', 'verify_phone.subtitle', 'Enter 6-digit verification code sent to your phone number.', '2022-04-25 21:34:34', '2022-06-29 08:25:39'),
(778, 0, 'en', 'auth', 'verify_phone.input', '6-digit verification code', '2022-04-25 21:34:34', '2022-06-29 08:25:39'),
(779, 0, 'en', 'auth', 'provider.title', 'Register company details', '2022-04-25 21:34:34', '2022-06-29 08:25:39'),
(780, 0, 'en', 'auth', 'provider.account', 'Account', '2022-04-25 21:34:34', '2022-06-29 08:25:39'),
(781, 0, 'en', 'auth', 'provider.verify', 'Verification', '2022-04-25 21:34:34', '2022-06-29 08:25:39'),
(782, 0, 'en', 'auth', 'account.title', 'Account Credentials', '2022-04-25 21:34:34', '2022-06-29 08:25:39'),
(783, 0, 'en', 'auth', 'account.subtitle', 'Create your first account to login to your dashboard', '2022-04-25 21:34:34', '2022-06-29 08:25:39'),
(784, 0, 'en', 'auth', 'step', 'This is step :n', '2022-04-25 21:34:34', '2022-06-29 08:25:39'),
(785, 0, 'en', 'crud', 'all', 'All', '2022-04-25 21:34:34', '2022-05-31 11:41:54'),
(786, 0, 'en', 'crud', 'confirm', 'Confirm', '2022-04-25 21:34:34', '2022-05-31 11:41:54'),
(787, 0, 'en', 'crud', 'submit', 'Submit', '2022-04-25 21:34:34', '2022-05-31 11:41:54'),
(788, 0, 'en', 'crud', 'select', 'Select', '2022-04-25 21:34:34', '2022-05-31 11:41:54'),
(789, 0, 'en', 'crud', 'remove', 'Remove', '2022-04-25 21:34:34', '2022-05-31 11:41:54'),
(790, 0, 'en', 'crud', 'close', 'Close', '2022-04-25 21:34:34', '2022-05-31 11:41:54'),
(791, 0, 'en', 'crud', 'print', 'Print', '2022-04-25 21:34:34', '2022-05-31 11:41:54'),
(792, 0, 'en', 'crud', 'payment', 'Proceed to Payment', '2022-04-25 21:34:34', '2022-05-31 11:41:54'),
(793, 0, 'en', 'crud', 'subscribe', 'Subscribe', '2022-04-25 21:34:34', '2022-05-31 11:41:54'),
(794, 0, 'en', 'msg', 'account', 'Account', '2022-04-25 21:34:34', '2022-06-01 12:39:38'),
(795, 0, 'en', 'msg', 'ignore_email', 'Please ignore this email if you didn\'t register with us, thank you!', '2022-04-25 21:34:34', '2022-06-01 12:39:38'),
(796, 0, 'en', 'msg', 'my_complaints', 'My complaints', '2022-04-25 21:34:34', '2022-06-01 12:39:38'),
(797, 0, 'en', 'msg', 'contact', 'Contact us', '2022-04-25 21:34:34', '2022-06-01 12:39:38'),
(798, 0, 'en', 'msg', 'please_wait_for_provider_approval_to_do_the_payment_and_complete_the_order', 'Please wait for the company approval to do the payment and complete the order', '2022-04-25 21:34:34', '2022-06-01 12:39:38'),
(799, 0, 'en', 'msg', 'please_do_the_payment_and_complete_the_order', 'Please do the payment and complete the order', '2022-04-25 21:34:34', '2022-06-01 12:39:38'),
(800, 0, 'en', 'msg', 'the_payment_link_is_not_valid', 'The payment link is not valid', '2022-04-25 21:34:34', '2022-06-01 12:39:38'),
(801, 0, 'en', 'msg', 'unauthorized', 'You are not allowed to do this action', '2022-04-25 21:34:34', '2022-06-01 12:39:38'),
(802, 0, 'en', 'msg', 'orders', 'Orders', '2022-04-25 21:34:34', '2022-06-01 12:39:38'),
(803, 0, 'en', 'msg', 'from', 'From', '2022-04-25 21:34:34', '2022-06-01 12:39:38'),
(804, 0, 'en', 'msg', 'yes', 'Yes', '2022-04-25 21:34:34', '2022-06-01 12:39:38'),
(805, 0, 'en', 'msg', 'no', 'No', '2022-04-25 21:34:34', '2022-06-01 12:39:38'),
(806, 0, 'en', 'msg', 'taken', 'Taken', '2022-04-25 21:34:34', '2022-06-01 12:39:38'),
(807, 0, 'en', 'msg', 'calender', 'Calender', '2022-04-25 21:34:34', '2022-06-01 12:39:38'),
(808, 0, 'en', 'msg', 'send_message', 'Send Message', '2022-04-25 21:34:34', '2022-06-01 12:39:38'),
(809, 0, 'en', 'msg', 'about', 'About Us', '2022-04-25 21:34:34', '2022-06-01 12:39:38'),
(810, 0, 'en', 'msg', 'services', 'Our Services', '2022-04-25 21:34:34', '2022-06-01 12:39:38'),
(811, 0, 'en', 'msg', 'enter_your_email', 'Enter Your Email', '2022-04-25 21:34:34', '2022-06-01 12:39:38'),
(812, 0, 'en', 'msg', 'send_your_feedback', 'Send Your Feedback', '2022-04-25 21:34:34', '2022-06-01 12:39:38'),
(813, 0, 'en', 'msg', 'click_here', 'Click here!', '2022-04-25 21:34:34', '2022-06-01 12:39:38'),
(814, 0, 'en', 'msg', 'search', 'Search', '2022-04-25 21:34:34', '2022-06-01 12:39:38'),
(815, 0, 'en', 'msg', 'type_your_search_keword', 'Type your search keyword', '2022-04-25 21:34:34', '2022-06-01 12:39:38'),
(816, 0, 'en', 'msg', 'trip_features', 'Select Features', '2022-04-25 21:34:34', '2022-06-01 12:39:38'),
(817, 0, 'en', 'msg', 'select', 'Select', '2022-04-25 21:34:34', '2022-06-01 12:39:38'),
(818, 0, 'en', 'msg', 'trip_starts_on', 'Trip starts on', '2022-04-25 21:34:34', '2022-06-01 12:39:38'),
(819, 0, 'en', 'msg', 'seats_only', 'seats available', '2022-04-25 21:34:34', '2022-06-01 12:39:38'),
(820, 0, 'en', 'msg', 'order_now', 'Order now', '2022-04-25 21:34:34', '2022-06-01 12:39:38'),
(821, 0, 'en', 'passwords', 'invalid', 'The link is no more valid, please request another!', '2022-04-25 21:34:34', '2022-05-31 13:32:28'),
(822, 0, 'en', 'passwords', 'success', 'You have reset your password successfully', '2022-04-25 21:34:34', '2022-05-31 13:32:28'),
(823, 0, 'ar', 'models/coupons', 'singular', 'رمز التخفيض', '2022-04-27 01:18:11', '2022-05-31 14:00:20'),
(824, 0, 'ar', 'models/coupons', 'plural', 'الكوبونات', '2022-04-27 01:18:11', '2022-05-31 14:00:20'),
(825, 0, 'ar', 'models/coupons', 'fields.discount', 'تخفيض', '2022-04-27 01:18:11', '2022-05-31 14:00:20'),
(826, 0, 'ar', 'models/buses', 'active', 'نشط', '2022-04-27 01:18:11', '2022-05-31 12:06:28'),
(827, 0, 'ar', 'models/buses', 'inactive', 'غير نشط', '2022-04-27 01:18:11', '2022-05-31 12:06:28'),
(828, 0, 'ar', 'models/coupons', 'fields.status', 'الحالة', '2022-04-27 01:18:11', '2022-05-31 14:00:20'),
(829, 0, 'ar', 'models/coupons', 'status.pending', 'حتى', '2022-04-27 01:18:11', '2022-05-31 14:00:20'),
(830, 0, 'ar', 'models/coupons', 'status.approved', 'وافق', '2022-04-27 01:18:11', '2022-05-31 14:00:20'),
(831, 0, 'ar', 'models/coupons', 'status.rejected', '.مرفوض', '2022-04-27 01:18:11', '2022-05-31 14:00:20'),
(832, 0, 'ar', 'models/coupons', 'fields.admin_notes', 'ملاحظات المشرف', '2022-04-27 01:18:11', '2022-05-31 14:00:20'),
(833, 0, 'ar', 'models/users', 'fields.wallet', 'المحفظة', '2022-04-27 01:18:11', '2022-06-01 10:56:39'),
(834, 0, 'ar', 'models/buses', 'fields.active', 'نشط', '2022-04-27 01:18:11', '2022-05-31 12:06:28'),
(835, 0, 'ar', 'models/coupons', 'fields.name', 'الاسم', '2022-04-27 01:18:11', '2022-05-31 14:00:20'),
(836, 0, 'ar', 'models/coupons', 'fields.date_from', 'من تاريخ', '2022-04-27 01:18:11', '2022-05-31 14:00:20'),
(837, 0, 'ar', 'models/coupons', 'fields.date_to', 'التاريخ إلى', '2022-04-27 01:18:11', '2022-05-31 14:00:20'),
(838, 0, 'ar', 'models/coupons', 'fields.type', 'يكتب', '2022-04-27 01:18:11', '2022-05-31 14:00:20'),
(839, 0, 'ar', 'models/coupons', 'types.amount', 'مقدار', '2022-04-27 01:18:11', '2022-05-31 14:00:20'),
(840, 0, 'ar', 'models/coupons', 'types.percentage', 'النسبة المئوية', '2022-04-27 01:18:11', '2022-05-31 14:00:20'),
(841, 0, 'ar', 'models/packages', 'fields.fees', 'رسوم', '2022-04-27 01:18:11', '2022-05-31 14:09:03'),
(842, 0, 'ar', 'models/packages', 'fields.starting_city_id', 'بدء معرف المدينة', '2022-04-27 01:18:11', '2022-05-31 14:09:03'),
(843, 0, 'ar', 'models/packages', 'fields.date_from', '.التاريخ من', '2022-04-27 01:18:11', '2022-05-31 14:09:03'),
(844, 0, 'ar', 'models/packages', 'fields.time_from', 'الوقت من', '2022-04-27 01:18:11', '2022-05-31 14:09:03'),
(845, 0, 'ar', 'models/packages', 'fields.description', 'وصف', '2022-04-27 01:18:11', '2022-05-31 14:09:03'),
(846, 0, 'ar', 'models/packages', 'fields.auto_approve', 'الموافقة التلقائية', '2022-04-27 01:18:11', '2022-05-31 14:09:03'),
(847, 0, 'ar', 'models/packages', 'fields.additional', 'إضافي', '2022-04-27 01:18:11', '2022-05-31 14:09:03'),
(848, 0, 'ar', 'models/trips', 'fields.destination_id', 'الوجهة', '2022-04-27 01:18:11', '2022-05-31 14:02:12'),
(849, 0, 'ar', 'models/trips', 'fields.additional', 'الاضافات', '2022-04-27 01:18:11', '2022-05-31 14:02:12'),
(850, 0, 'en', 'models/cities', 'fields.name', 'Name', '2022-05-11 07:27:32', '2022-05-11 07:46:16'),
(851, 0, 'en', 'models/cities', 'plural', 'Cities', '2022-05-11 07:27:38', '2022-05-11 07:46:16'),
(852, 0, 'en', 'models/cities', 'singular', 'City', '2022-05-11 07:27:41', '2022-05-11 07:46:16'),
(856, 0, 'ur', 'msg', 'code', NULL, '2022-05-31 10:33:59', '2022-05-31 10:33:59'),
(857, 0, 'ar', 'msg', 'code', 'الخصومات', '2022-05-31 10:34:13', '2022-06-01 12:39:38'),
(858, 0, 'en', 'msg', 'code', 'discount', '2022-05-31 10:35:10', '2022-06-01 12:39:38'),
(859, 0, 'ur', 'msg', 'to', NULL, '2022-05-31 10:37:08', '2022-05-31 10:37:08'),
(860, 0, 'ur', 'msg', 'departure_date', NULL, '2022-05-31 10:37:08', '2022-05-31 10:37:08'),
(861, 0, 'ar', 'msg', 'to', 'الي', '2022-05-31 10:37:41', '2022-06-01 12:39:38'),
(862, 0, 'en', 'msg', 'to', 'to', '2022-05-31 10:37:47', '2022-06-01 12:39:38'),
(863, 0, 'en', 'models/coupons', 'singular', 'coupon', '2022-05-31 10:41:31', '2022-05-31 14:00:20'),
(864, 0, 'ur', 'models/coupons', 'fields.singular', NULL, '2022-05-31 10:41:48', '2022-05-31 10:41:48'),
(865, 0, 'ar', 'models/coupons', 'fields.singular', 'رمز الخصم', '2022-05-31 10:42:45', '2022-05-31 14:00:20'),
(866, 0, 'en', 'models/coupons', 'fields.singular', 'code', '2022-05-31 10:42:51', '2022-05-31 14:00:20'),
(867, 0, 'en', 'models/trips', 'fields.additional', 'additional', '2022-05-31 10:43:57', '2022-05-31 14:02:12'),
(868, 0, 'en', 'models/trips', 'plural', 'trips', '2022-05-31 10:44:45', '2022-05-31 14:02:12'),
(869, 0, 'ar', 'msg', 'account', 'حساب', '2022-05-31 10:47:08', '2022-06-01 12:39:38'),
(870, 0, 'ar', 'msg', 'departure_date', 'تاريخ المغادرة', '2022-05-31 10:50:21', '2022-06-01 12:39:38'),
(871, 0, 'ar', 'msg', 'send_your_feedback', 'أرسل ملاحظاتك', '2022-05-31 11:07:44', '2022-06-01 12:39:38'),
(872, 0, 'ar', 'msg', 'trip_features', 'ميزات الرحلة', '2022-05-31 11:10:43', '2022-06-01 12:39:38'),
(873, 0, 'en', 'msg', 'departure_date', 'departure date', '2022-05-31 11:21:12', '2022-06-01 12:39:38'),
(874, 0, 'en', 'msg', 'error', 'error', '2022-05-31 11:21:17', '2022-06-01 12:39:38'),
(875, 0, 'en', 'msg', 'filter_options', 'filter options', '2022-05-31 11:21:25', '2022-06-01 12:39:38'),
(876, 0, 'en', 'msg', 'heighest', 'home', '2022-05-31 11:21:31', '2022-06-01 12:39:38'),
(877, 0, 'en', 'msg', 'lowest', 'mark as read', '2022-05-31 11:21:50', '2022-06-01 12:39:38'),
(878, 0, 'en', 'msg', 'this_number_of_tickets_are_not_available', 'this number of tickets are not avilable', '2022-05-31 11:22:34', '2022-06-01 12:39:38'),
(879, 0, 'en', 'msg', 'trips', 'trips', '2022-05-31 11:22:48', '2022-06-01 12:39:38'),
(880, 0, 'en', 'msg', 'updoad_file', 'upload file', '2022-05-31 11:22:56', '2022-06-01 12:39:38'),
(881, 0, 'en', 'models/packages', 'singular', 'Package', '2022-05-31 11:25:55', '2022-05-31 14:09:03'),
(882, 0, 'en', 'models/packages', 'plural', 'Packages', '2022-05-31 11:26:25', '2022-05-31 14:09:03'),
(883, 0, 'ur', 'models/trips', 'types.one-way', NULL, '2022-05-31 11:28:11', '2022-05-31 11:28:11'),
(884, 0, 'ar', 'models/trips', 'types.one-way', 'اتجاه واحد', '2022-05-31 11:28:31', '2022-05-31 14:02:12'),
(885, 0, 'en', 'models/trips', 'types.one-way', 'one way', '2022-05-31 11:28:38', '2022-05-31 14:02:12'),
(886, 0, 'ur', 'models/trips', 'types.round', NULL, '2022-05-31 11:29:01', '2022-05-31 11:29:01'),
(887, 0, 'ar', 'models/trips', 'types.round', 'ذهاب وعودة', '2022-05-31 11:29:19', '2022-05-31 14:02:12'),
(888, 0, 'en', 'models/trips', 'types.round', 'Round Trip', '2022-05-31 11:29:36', '2022-05-31 14:02:12'),
(889, 0, 'ur', 'models/trips', 'types.multi', NULL, '2022-05-31 11:30:04', '2022-05-31 11:30:04'),
(890, 0, 'ar', 'models/trips', 'types.multi', 'رحلات متعددة', '2022-05-31 11:30:23', '2022-05-31 14:02:12'),
(891, 0, 'en', 'models/trips', 'types.multi', 'Multiple trips', '2022-05-31 11:30:57', '2022-05-31 14:02:12'),
(892, 0, 'ur', 'msg', 'add_another_destination', NULL, '2022-05-31 11:31:53', '2022-05-31 11:31:53'),
(893, 0, 'ar', 'msg', 'add_another_destination', 'اضافة وجهة اخري', '2022-05-31 11:32:15', '2022-06-01 12:39:38'),
(894, 0, 'en', 'msg', 'add_another_destination', 'add another destination', '2022-05-31 11:32:23', '2022-06-01 12:39:38'),
(895, 0, 'ar', 'crud', 'remove', 'حذف', '2022-05-31 11:32:57', '2022-05-31 11:41:54'),
(896, 0, 'ar', 'crud', 'close', 'اغلاق', '2022-05-31 11:33:34', '2022-05-31 11:41:54'),
(897, 0, 'ur', 'models/coupons', 'fields.code', NULL, '2022-05-31 11:37:18', '2022-05-31 11:37:18'),
(898, 0, 'ar', 'models/coupons', 'fields.code', 'رمز التخفيض', '2022-05-31 11:37:28', '2022-05-31 14:00:20');
INSERT INTO `ltm_translations` (`id`, `status`, `locale`, `group`, `key`, `value`, `created_at`, `updated_at`) VALUES
(899, 0, 'en', 'models/coupons', 'fields.code', 'code', '2022-05-31 11:37:33', '2022-05-31 14:00:20'),
(900, 0, 'ur', 'msg', 'header_form_title', NULL, '2022-05-31 11:40:22', '2022-05-31 11:40:22'),
(901, 0, 'en', 'msg', 'header_form_title', 'Bus Ticket Booking Online', '2022-05-31 11:40:33', '2022-06-01 12:39:38'),
(902, 0, 'ar', 'msg', 'header_form_title', 'حجز تذكرة الحافلة عبر الإنترنت', '2022-05-31 11:40:59', '2022-06-01 12:39:38'),
(903, 0, 'ur', 'auth', 'username', NULL, '2022-05-31 11:45:26', '2022-05-31 11:45:26'),
(904, 0, 'ar', 'auth', 'username', 'اسم المستخدم', '2022-05-31 11:45:36', '2022-06-29 08:25:39'),
(905, 0, 'en', 'auth', 'username', 'username', '2022-05-31 11:45:39', '2022-06-29 08:25:39'),
(906, 0, 'ur', 'auth', 'login.subtitle', NULL, '2022-05-31 11:45:57', '2022-05-31 11:45:57'),
(907, 0, 'en', 'auth', 'login.subtitle', 'Account Credentials', '2022-05-31 11:46:23', '2022-06-29 08:25:39'),
(908, 0, 'ar', 'auth', 'login.subtitle', 'بيانات الحساب', '2022-05-31 11:46:38', '2022-06-29 08:25:39'),
(909, 0, 'ur', 'msg', 'tax_report', NULL, '2022-05-31 11:47:54', '2022-05-31 11:47:54'),
(910, 0, 'ar', 'msg', 'tax_report', 'التقرير الضريبي', '2022-05-31 11:48:05', '2022-06-01 12:39:38'),
(911, 0, 'en', 'msg', 'tax_report', 'tax report', '2022-05-31 11:48:10', '2022-06-01 12:39:38'),
(912, 0, 'en', 'models/accounts', 'singular', 'account', '2022-05-31 11:57:36', '2022-05-31 14:10:20'),
(913, 0, 'en', 'models/accounts', 'plural', 'accounts', '2022-05-31 11:57:39', '2022-05-31 14:10:20'),
(914, 0, 'en', 'models/accounts', 'inactive', 'inactive', '2022-05-31 11:57:43', '2022-05-31 14:10:20'),
(915, 0, 'en', 'models/accounts', 'fields.username', 'username', '2022-05-31 11:57:47', '2022-05-31 14:10:20'),
(916, 0, 'en', 'models/accounts', 'fields.role', 'role', '2022-05-31 11:57:50', '2022-05-31 14:10:20'),
(917, 0, 'en', 'models/accounts', 'fields.phone', 'phone', '2022-05-31 11:57:56', '2022-05-31 14:10:20'),
(918, 0, 'en', 'models/accounts', 'fields.password', 'password', '2022-05-31 11:57:59', '2022-05-31 14:10:20'),
(919, 0, 'en', 'models/accounts', 'fields.email', 'email', '2022-05-31 11:58:05', '2022-05-31 14:10:20'),
(920, 0, 'en', 'models/accounts', 'fields.active', 'active', '2022-05-31 11:58:09', '2022-05-31 14:10:20'),
(921, 0, 'en', 'models/accounts', 'active', 'active', '2022-05-31 11:58:13', '2022-05-31 14:10:20'),
(922, 0, 'en', 'models/busOrders', 'status.rejected', 'rejected', '2022-05-31 12:03:16', '2022-05-31 13:59:13'),
(923, 0, 'en', 'models/busOrders', 'status.pending', 'pending', '2022-05-31 12:03:20', '2022-05-31 13:59:13'),
(924, 0, 'en', 'models/busOrders', 'status.approved', 'approved', '2022-05-31 12:03:23', '2022-05-31 13:59:13'),
(925, 0, 'en', 'models/busOrders', 'fields.user_notes', 'user notes', '2022-05-31 12:03:29', '2022-05-31 13:59:13'),
(926, 0, 'en', 'models/busOrders', 'fields.time_to', 'time to', '2022-05-31 12:03:36', '2022-05-31 13:59:13'),
(927, 0, 'en', 'models/busOrders', 'fields.time_from', 'time from', '2022-05-31 12:03:41', '2022-05-31 13:59:13'),
(928, 0, 'en', 'models/busOrders', 'fields.created_at', 'created at', '2022-05-31 12:03:50', '2022-05-31 13:59:13'),
(929, 0, 'en', 'models/busOrders', 'fields.date_from', 'date from', '2022-05-31 12:03:54', '2022-05-31 13:59:13'),
(930, 0, 'en', 'models/busOrders', 'fields.date_to', 'date to', '2022-05-31 12:04:00', '2022-05-31 13:59:13'),
(931, 0, 'en', 'models/busOrders', 'fields.fees', 'fees', '2022-05-31 12:04:04', '2022-05-31 13:59:13'),
(932, 0, 'en', 'models/busOrders', 'fields.provider_notes', 'provider notes', '2022-05-31 12:04:10', '2022-05-31 13:59:13'),
(933, 0, 'en', 'models/busOrders', 'fields.status', 'status', '2022-05-31 12:04:13', '2022-05-31 13:59:13'),
(934, 0, 'en', 'models/buses', 'singular', 'bus', '2022-05-31 12:05:29', '2022-05-31 12:06:28'),
(935, 0, 'en', 'models/buses', 'plural', 'buses', '2022-05-31 12:05:34', '2022-05-31 12:06:28'),
(936, 0, 'en', 'models/buses', 'fields.account_id', 'account id', '2022-05-31 12:05:57', '2022-05-31 12:06:28'),
(937, 0, 'en', 'models/buses', 'fields.active', 'active', '2022-05-31 12:06:08', '2022-05-31 12:06:28'),
(938, 0, 'en', 'models/buses', 'fields.image', 'image', '2022-05-31 12:06:12', '2022-05-31 12:06:28'),
(939, 0, 'en', 'models/buses', 'fields.passengers', 'passengers', '2022-05-31 12:06:15', '2022-05-31 12:06:28'),
(940, 0, 'en', 'models/buses', 'fields.plate', 'plate', '2022-05-31 12:06:18', '2022-05-31 12:06:28'),
(941, 0, 'en', 'models/buses', 'inactive', 'inactive', '2022-05-31 12:06:23', '2022-05-31 12:06:28'),
(942, 0, 'en', 'models/contacts', 'replied', 'replied', '2022-05-31 12:10:01', '2022-06-01 12:58:44'),
(943, 0, 'en', 'models/contacts', 'unread', 'unread', '2022-05-31 12:10:38', '2022-06-01 12:58:44'),
(944, 0, 'en', 'models/contacts', 'unreplied', 'unreplied', '2022-05-31 12:11:31', '2022-06-01 12:58:44'),
(945, 0, 'en', 'models/coupons', 'fields.admin_notes', 'fields.admin_notes', '2022-05-31 12:13:30', '2022-05-31 14:00:20'),
(946, 0, 'en', 'models/coupons', 'fields.date_from', 'fields.date_from', '2022-05-31 12:15:14', '2022-05-31 14:00:20'),
(947, 0, 'en', 'models/coupons', 'fields.date_to', 'date_to', '2022-05-31 12:17:20', '2022-05-31 14:00:20'),
(948, 0, 'en', 'models/coupons', 'fields.name', 'name', '2022-05-31 12:19:00', '2022-05-31 14:00:20'),
(949, 0, 'en', 'models/coupons', 'fields.discount', 'discount', '2022-05-31 12:19:15', '2022-05-31 14:00:20'),
(950, 0, 'en', 'models/coupons', 'fields.status', 'status', '2022-05-31 12:20:00', '2022-05-31 14:00:20'),
(951, 0, 'en', 'models/coupons', 'fields.type', 'type', '2022-05-31 12:22:48', '2022-05-31 14:00:20'),
(952, 0, 'en', 'models/coupons', 'plural', 'coupons', '2022-05-31 12:23:19', '2022-05-31 14:00:20'),
(953, 0, 'en', 'models/coupons', 'status.approved', 'approved', '2022-05-31 12:24:23', '2022-05-31 14:00:20'),
(954, 0, 'en', 'models/coupons', 'status.pending', '.pending', '2022-05-31 12:24:52', '2022-05-31 14:00:20'),
(955, 0, 'en', 'models/coupons', 'status.rejected', 'rejected', '2022-05-31 12:25:53', '2022-05-31 14:00:20'),
(956, 0, 'en', 'models/coupons', 'types.amount', 'amount', '2022-05-31 12:26:30', '2022-05-31 14:00:20'),
(957, 0, 'en', 'models/coupons', 'types.percentage', 'percentage', '2022-05-31 12:27:03', '2022-05-31 14:00:20'),
(958, 0, 'en', 'models/destinations', 'plural', 'destinations', '2022-05-31 12:38:35', '2022-05-31 14:11:39'),
(959, 0, 'en', 'models/destinations', 'singular', 'destinantion', '2022-05-31 12:38:44', '2022-05-31 14:11:39'),
(960, 0, 'en', 'models/destinations', 'fields.to_city_id', '.to_city_id', '2022-05-31 12:38:56', '2022-05-31 14:11:39'),
(961, 0, 'en', 'models/destinations', 'fields.stops', 'stops', '2022-05-31 12:39:09', '2022-05-31 14:11:39'),
(962, 0, 'en', 'models/destinations', 'fields.starting_terminal_id', 'starting_terminal_id', '2022-05-31 12:39:29', '2022-05-31 14:11:39'),
(963, 0, 'en', 'models/destinations', 'fields.from_city_id', 'from_city_id', '2022-05-31 12:39:45', '2022-05-31 14:11:39'),
(964, 0, 'en', 'models/destinations', 'fields.bus_fees', 'bus_fees', '2022-05-31 12:39:59', '2022-05-31 14:11:39'),
(965, 0, 'en', 'models/destinations', 'fields.arrival_terminal_id', 'arrival_terminal_id', '2022-05-31 12:40:14', '2022-05-31 14:11:39'),
(966, 0, 'en', 'models/emails', 'plural', 'emails', '2022-05-31 12:47:29', '2022-05-31 12:49:23'),
(967, 0, 'en', 'models/emails', 'singular', 'email', '2022-05-31 12:47:33', '2022-05-31 12:49:23'),
(968, 0, 'en', 'models/emails', 'fields.email', 'email', '2022-05-31 12:47:46', '2022-05-31 12:49:23'),
(969, 0, 'en', 'models/features', 'plural', 'features', '2022-05-31 13:00:40', '2022-05-31 13:02:24'),
(970, 0, 'en', 'models/features', 'singular', 'feature', '2022-05-31 13:00:59', '2022-05-31 13:02:24'),
(971, 0, 'en', 'models/features', 'fields.title', 'title', '2022-05-31 13:01:50', '2022-05-31 13:02:24'),
(972, 0, 'en', 'models/features', 'fields.text', 'text', '2022-05-31 13:02:05', '2022-05-31 13:02:24'),
(973, 0, 'en', 'models/features', 'fields.icon', 'icon', '2022-05-31 13:02:16', '2022-05-31 13:02:24'),
(974, 0, 'en', 'models/notifications', 'unauthorized', 'unauthorized', '2022-05-31 13:03:14', '2022-05-31 14:13:51'),
(975, 0, 'en', 'models/packages', 'fields.time_from', '.time_from', '2022-05-31 13:07:25', '2022-05-31 14:09:03'),
(976, 0, 'en', 'models/packages', 'fields.starting_city_id', 'tarting_city_id', '2022-05-31 13:07:37', '2022-05-31 14:09:03'),
(977, 0, 'en', 'models/packages', 'fields.name', 'name', '2022-05-31 13:07:55', '2022-05-31 14:09:03'),
(978, 0, 'en', 'models/packages', 'fields.fees', 'fees', '2022-05-31 13:08:14', '2022-05-31 14:09:03'),
(979, 0, 'en', 'models/packages', 'fields.description', '.description', '2022-05-31 13:08:23', '2022-05-31 14:09:03'),
(980, 0, 'en', 'models/packages', 'fields.date_from', 'date_from', '2022-05-31 13:08:38', '2022-05-31 14:09:03'),
(981, 0, 'en', 'models/packages', 'fields.bus_fees', 'bus_fees', '2022-05-31 13:08:50', '2022-05-31 14:09:03'),
(982, 0, 'en', 'models/packages', 'fields.auto_approve', 'auto_approve', '2022-05-31 13:09:04', '2022-05-31 14:09:03'),
(983, 0, 'en', 'models/packages', 'fields.additional', 'additional', '2022-05-31 13:09:13', '2022-05-31 14:09:03'),
(984, 0, 'en', 'models/providers', 'fields.address', 'address', '2022-05-31 13:12:07', '2022-05-31 13:17:53'),
(985, 0, 'en', 'models/providers', 'fields.tax_cert_num', 'tax certificate number', '2022-05-31 13:15:17', '2022-05-31 13:17:53'),
(986, 0, 'en', 'models/providers', 'fields.comm_name', 'name', '2022-05-31 13:17:11', '2022-05-31 13:17:53'),
(987, 0, 'en', 'models/providers', 'fields.comm_reg_img', 'image', '2022-05-31 13:17:24', '2022-05-31 13:17:53'),
(988, 0, 'en', 'models/providers', 'fields.comm_reg_num', 'number', '2022-05-31 13:17:36', '2022-05-31 13:17:53'),
(989, 0, 'en', 'models/providers', 'fields.tax', 'tax', '2022-05-31 13:17:47', '2022-05-31 13:17:53'),
(990, 0, 'en', 'models/reviews', 'fields.publish', 'publish', '2022-05-31 13:19:22', '2022-05-31 14:22:32'),
(991, 0, 'en', 'models/reviews', 'plural', 'review', '2022-05-31 13:19:24', '2022-05-31 14:22:32'),
(992, 0, 'en', 'models/reviews', 'singular', 'review', '2022-05-31 13:19:26', '2022-05-31 14:22:32'),
(993, 0, 'en', 'models/services', 'fields.image', 'image', '2022-05-31 13:20:14', '2022-05-31 13:20:45'),
(994, 0, 'en', 'models/services', 'fields.text', 'text', '2022-05-31 13:20:18', '2022-05-31 13:20:45'),
(995, 0, 'en', 'models/services', 'fields.title', 'title', '2022-05-31 13:20:23', '2022-05-31 13:20:45'),
(996, 0, 'en', 'models/services', 'plural', 'services', '2022-05-31 13:20:35', '2022-05-31 13:20:45'),
(997, 0, 'en', 'models/services', 'singular', 'service', '2022-05-31 13:20:40', '2022-05-31 13:20:45'),
(998, 0, 'en', 'models/settings', 'plural', 'Settings', '2022-05-31 13:21:14', '2022-05-31 13:21:32'),
(999, 0, 'en', 'models/settings', 'singular', 'Settings', '2022-05-31 13:21:21', '2022-05-31 13:21:32'),
(1000, 0, 'en', 'models/tickets', 'fields.seat_num', 'seat number', '2022-05-31 13:22:53', '2022-05-31 13:23:13'),
(1001, 0, 'en', 'models/tickets', 'plural', 'tickets', '2022-05-31 13:23:06', '2022-05-31 13:23:13'),
(1002, 0, 'en', 'models/tickets', 'singular', 'ticket', '2022-05-31 13:23:09', '2022-05-31 13:23:13'),
(1003, 0, 'en', 'models/tripOrders', 'fields.provider_notes', 'provider notes', '2022-05-31 13:24:45', '2022-05-31 14:07:50'),
(1004, 0, 'en', 'models/tripOrders', 'fields.status', 'status', '2022-05-31 13:24:48', '2022-05-31 14:07:50'),
(1005, 0, 'en', 'models/tripOrders', 'fields.user_notes', 'user notes', '2022-05-31 13:24:52', '2022-05-31 14:07:50'),
(1006, 0, 'en', 'models/tripOrders', 'status.approved', 'approved', '2022-05-31 13:24:57', '2022-05-31 14:07:50'),
(1007, 0, 'en', 'models/tripOrders', 'status.pending', 'pending', '2022-05-31 13:25:05', '2022-05-31 14:07:50'),
(1008, 0, 'en', 'models/tripOrders', 'status.rejected', 'rejected', '2022-05-31 13:25:09', '2022-05-31 14:07:50'),
(1009, 0, 'en', 'models/tripOrders', 'plural', 'trip orders', '2022-05-31 13:25:31', '2022-05-31 14:07:50'),
(1010, 0, 'en', 'models/tripOrders', 'singular', 'trip order', '2022-05-31 13:25:36', '2022-05-31 14:07:50'),
(1011, 0, 'en', 'models/trips', 'datetime', 'datetime', '2022-05-31 13:27:36', '2022-05-31 14:02:12'),
(1012, 0, 'en', 'models/trips', 'features', 'features', '2022-05-31 13:27:39', '2022-05-31 14:02:12'),
(1013, 0, 'en', 'models/trips', 'fields.auto_approve', 'auto approve', '2022-05-31 13:27:44', '2022-05-31 14:02:12'),
(1014, 0, 'en', 'models/trips', 'fields.bus_id', 'bus id', '2022-05-31 13:27:49', '2022-05-31 14:02:12'),
(1015, 0, 'en', 'models/trips', 'fields.date_from', 'date from', '2022-05-31 13:27:56', '2022-05-31 14:02:12'),
(1016, 0, 'en', 'models/trips', 'fields.date_to', 'date to', '2022-05-31 13:28:01', '2022-05-31 14:02:12'),
(1017, 0, 'en', 'models/trips', 'fields.description', 'description', '2022-05-31 13:28:05', '2022-05-31 14:02:12'),
(1018, 0, 'en', 'models/trips', 'fields.destination_id', 'destination id', '2022-05-31 13:28:10', '2022-05-31 14:02:12'),
(1019, 0, 'en', 'models/trips', 'fields.fees', 'fees', '2022-05-31 13:28:13', '2022-05-31 14:02:12'),
(1020, 0, 'en', 'models/trips', 'singular', 'trip', '2022-05-31 13:28:25', '2022-05-31 14:02:12'),
(1021, 0, 'en', 'models/users', 'fields.wallet', 'wallet', '2022-05-31 13:29:22', '2022-06-01 10:56:39'),
(1022, 0, 'en', 'models/users', 'fields.marital_status', 'marital status', '2022-05-31 13:29:28', '2022-06-01 10:56:39'),
(1023, 0, 'en', 'models/users', 'fields.date_of_birth', 'date of birth', '2022-05-31 13:29:38', '2022-06-01 10:56:39'),
(1024, 0, 'en', 'models/users', 'fields.address', 'address', '2022-05-31 13:29:43', '2022-06-01 10:56:39'),
(1025, 0, 'en', 'passwords', 'password', 'Password length must be at least six characters and must match the confirmation field', '2022-05-31 13:31:59', '2022-05-31 13:32:28'),
(1026, 0, 'ar', 'validation', 'password', 'كلمة المرور غير صحيحة.', '2022-05-31 13:32:59', '2022-05-31 13:34:48'),
(1027, 0, 'ar', 'validation', 'prohibited', 'حقل :attribute  محظور.', '2022-05-31 13:33:49', '2022-05-31 13:34:48'),
(1028, 0, 'ar', 'validation', 'required_array_keys', 'يجب أن يحتوي حقل :attribute على إدخالات لـ:values..', '2022-05-31 13:34:34', '2022-05-31 13:34:48'),
(1029, 0, 'en', 'models/busOrders', 'plural', 'Buses order', '2022-05-31 13:35:41', '2022-05-31 13:59:13'),
(1030, 0, 'en', 'models/busOrders', 'singular', 'Bus order', '2022-05-31 13:36:04', '2022-05-31 13:59:13'),
(1031, 0, 'ur', 'msg', 'terminals', NULL, '2022-05-31 13:38:44', '2022-05-31 13:38:44'),
(1032, 0, 'ur', 'msg', 'destinations', NULL, '2022-05-31 13:38:44', '2022-05-31 13:38:44'),
(1033, 0, 'ur', 'msg', 'coupons', NULL, '2022-05-31 13:38:44', '2022-05-31 13:38:44'),
(1034, 0, 'ur', 'msg', 'today_orders', NULL, '2022-05-31 13:38:44', '2022-05-31 13:38:44'),
(1035, 0, 'ar', 'msg', 'terminals', 'المحطات', '2022-05-31 13:39:02', '2022-06-01 12:39:38'),
(1036, 0, 'en', 'msg', 'terminals', 'stations', '2022-05-31 13:39:27', '2022-06-01 12:39:38'),
(1037, 0, 'ar', 'msg', 'today_orders', 'طلبات اليوم', '2022-05-31 13:39:37', '2022-06-01 12:39:38'),
(1038, 0, 'en', 'msg', 'today_orders', 'today orders', '2022-05-31 13:39:41', '2022-06-01 12:39:38'),
(1039, 0, 'en', 'msg', 'destinations', 'destinations', '2022-05-31 13:39:51', '2022-06-01 12:39:38'),
(1040, 0, 'ar', 'msg', 'destinations', 'الوجهات', '2022-05-31 13:39:57', '2022-06-01 12:39:38'),
(1041, 0, 'ar', 'msg', 'coupons', 'الكوبونات', '2022-05-31 13:40:18', '2022-06-01 12:39:38'),
(1042, 0, 'en', 'msg', 'coupons', 'coupons', '2022-05-31 13:40:22', '2022-06-01 12:39:38'),
(1043, 0, 'ur', 'msg', 'orders_income', NULL, '2022-05-31 13:41:13', '2022-05-31 13:41:13'),
(1044, 0, 'en', 'msg', 'orders_income', 'orders income', '2022-05-31 13:41:22', '2022-06-01 12:39:38'),
(1045, 0, 'ar', 'msg', 'orders_income', 'دخل الطلبات', '2022-05-31 13:41:33', '2022-06-01 12:39:38'),
(1046, 0, 'ur', 'packageOrders', 'plural', NULL, '2022-05-31 13:44:10', '2022-05-31 13:44:10'),
(1047, 0, 'ar', 'packageOrders', 'plural', 'طلبات البرامج', '2022-05-31 13:44:26', '2022-05-31 13:46:22'),
(1048, 0, 'en', 'packageOrders', 'plural', 'packages orders', '2022-05-31 13:45:59', '2022-05-31 13:46:22'),
(1049, 0, 'ur', 'models/packageOrders', 'plural', NULL, '2022-05-31 13:46:50', '2022-05-31 13:46:50'),
(1050, 0, 'ar', 'models/packageOrders', 'plural', 'طلبات البرامج', '2022-05-31 13:47:04', '2022-05-31 14:17:12'),
(1051, 0, 'en', 'models/packageOrders', 'plural', 'packages orders', '2022-05-31 13:47:12', '2022-05-31 14:17:12'),
(1052, 0, 'ur', 'msg', 'start_date', NULL, '2022-05-31 13:49:29', '2022-05-31 13:49:29'),
(1053, 0, 'ur', 'msg', 'end_date', NULL, '2022-05-31 13:49:29', '2022-05-31 13:49:29'),
(1054, 0, 'ur', 'msg', 'model', NULL, '2022-05-31 13:49:29', '2022-05-31 13:49:29'),
(1055, 0, 'ar', 'msg', 'end_date', 'تاريخ النهاية', '2022-05-31 13:49:43', '2022-06-01 12:39:38'),
(1056, 0, 'en', 'msg', 'end_date', 'end date', '2022-05-31 13:50:02', '2022-06-01 12:39:38'),
(1057, 0, 'ur', 'models/busOrders', 'fields.tax', NULL, '2022-05-31 13:51:08', '2022-05-31 13:51:08'),
(1058, 0, 'ur', 'models/busOrders', 'fields.total', NULL, '2022-05-31 13:51:08', '2022-05-31 13:51:08'),
(1059, 0, 'ar', 'models/busOrders', 'fields.tax', 'الضريبة', '2022-05-31 13:51:17', '2022-05-31 13:59:13'),
(1060, 0, 'en', 'models/busOrders', 'fields.tax', 'tax', '2022-05-31 13:51:22', '2022-05-31 13:59:13'),
(1061, 0, 'ar', 'models/busOrders', 'fields.total', 'الاجمالي', '2022-05-31 13:51:35', '2022-05-31 13:59:13'),
(1062, 0, 'en', 'models/busOrders', 'fields.total', 'total', '2022-05-31 13:51:39', '2022-05-31 13:59:13'),
(1063, 0, 'ar', 'msg', 'start_date', 'تاريخ البداية', '2022-05-31 13:52:13', '2022-06-01 12:39:38'),
(1064, 0, 'en', 'msg', 'start_date', 'start date', '2022-05-31 13:52:18', '2022-06-01 12:39:38'),
(1065, 0, 'ar', 'msg', 'model', 'النموذج', '2022-05-31 13:53:28', '2022-06-01 12:39:38'),
(1066, 0, 'en', 'msg', 'model', 'model', '2022-05-31 13:53:32', '2022-06-01 12:39:38'),
(1067, 0, 'ur', 'models/busOrders', 'fields.user_id', NULL, '2022-05-31 13:54:14', '2022-05-31 13:54:14'),
(1068, 0, 'en', 'models/busOrders', 'fields.user_id', 'user id', '2022-05-31 13:54:31', '2022-05-31 13:59:13'),
(1069, 0, 'ar', 'models/busOrders', 'fields.user_id', 'معرف المستخدم', '2022-05-31 13:54:58', '2022-05-31 13:59:13'),
(1070, 0, 'ur', 'msg', 'total_tax', NULL, '2022-05-31 13:55:46', '2022-05-31 13:55:46'),
(1071, 0, 'ar', 'msg', 'total_tax', 'اجمالي الضريبة', '2022-05-31 13:55:58', '2022-06-01 12:39:38'),
(1072, 0, 'en', 'msg', 'total_tax', 'total tax', '2022-05-31 13:56:04', '2022-06-01 12:39:38'),
(1073, 0, 'ur', 'msg', 'filter', NULL, '2022-05-31 13:56:34', '2022-05-31 13:56:34'),
(1074, 0, 'ar', 'msg', 'filter', 'تصفية', '2022-05-31 13:56:59', '2022-06-01 12:39:38'),
(1075, 0, 'ur', 'models/busOrders', 'fields.bus_id', NULL, '2022-05-31 13:57:52', '2022-05-31 13:57:52'),
(1076, 0, 'ur', 'models/busOrders', 'fields.time', NULL, '2022-05-31 13:57:52', '2022-05-31 13:57:52'),
(1077, 0, 'ar', 'models/busOrders', 'fields.time', 'الوقت', '2022-05-31 13:58:01', '2022-05-31 13:59:13'),
(1078, 0, 'en', 'models/busOrders', 'fields.time', 'time', '2022-05-31 13:58:07', '2022-05-31 13:59:13'),
(1079, 0, 'ar', 'models/busOrders', 'fields.bus_id', 'معرف الباص', '2022-05-31 13:58:16', '2022-05-31 13:59:13'),
(1080, 0, 'en', 'models/busOrders', 'fields.bus_id', 'bus id', '2022-05-31 13:58:23', '2022-05-31 13:59:13'),
(1081, 0, 'ur', 'models/busOrders', 'time', NULL, '2022-05-31 13:58:57', '2022-05-31 13:58:57'),
(1082, 0, 'ar', 'models/busOrders', 'time', 'الوقت', '2022-05-31 13:59:06', '2022-05-31 13:59:13'),
(1083, 0, 'en', 'models/busOrders', 'time', 'time', '2022-05-31 13:59:09', '2022-05-31 13:59:13'),
(1084, 0, 'ur', 'models/trips', 'fields.destination', NULL, '2022-05-31 14:01:07', '2022-05-31 14:01:07'),
(1085, 0, 'ar', 'models/trips', 'fields.destination', 'الوجهات', '2022-05-31 14:01:28', '2022-05-31 14:02:12'),
(1086, 0, 'en', 'models/trips', 'fields.destination', 'destination', '2022-05-31 14:01:39', '2022-05-31 14:02:12'),
(1087, 0, 'ur', 'models/tripOrders', 'fields.trip_id', NULL, '2022-05-31 14:03:32', '2022-05-31 14:03:32'),
(1088, 0, 'ur', 'models/tripOrders', 'fields.user_id', NULL, '2022-05-31 14:03:32', '2022-05-31 14:03:32'),
(1089, 0, 'ur', 'models/tripOrders', 'fields.count', NULL, '2022-05-31 14:03:32', '2022-05-31 14:03:32'),
(1090, 0, 'ar', 'models/tripOrders', 'fields.count', 'العدد', '2022-05-31 14:03:40', '2022-05-31 14:07:50'),
(1091, 0, 'en', 'models/tripOrders', 'fields.count', 'count', '2022-05-31 14:03:44', '2022-05-31 14:07:50'),
(1092, 0, 'ar', 'models/tripOrders', 'fields.trip_id', 'معرف الرحلة', '2022-05-31 14:03:54', '2022-05-31 14:07:50'),
(1093, 0, 'en', 'models/tripOrders', 'fields.trip_id', 'trip id', '2022-05-31 14:04:01', '2022-05-31 14:07:50'),
(1094, 0, 'ar', 'models/tripOrders', 'fields.user_id', 'معرف المستخدم', '2022-05-31 14:04:16', '2022-05-31 14:07:50'),
(1095, 0, 'en', 'models/tripOrders', 'fields.user_id', 'user id', '2022-05-31 14:04:24', '2022-05-31 14:07:50'),
(1096, 0, 'ur', 'models/tripOrders', 'fields.total', NULL, '2022-05-31 14:05:17', '2022-05-31 14:05:17'),
(1097, 0, 'ur', 'models/tripOrders', 'fields.type', NULL, '2022-05-31 14:05:17', '2022-05-31 14:05:17'),
(1098, 0, 'ar', 'models/tripOrders', 'fields.total', 'الاجمالي', '2022-05-31 14:05:27', '2022-05-31 14:07:50'),
(1099, 0, 'en', 'models/tripOrders', 'fields.total', 'total', '2022-05-31 14:05:32', '2022-05-31 14:07:50'),
(1100, 0, 'ar', 'models/tripOrders', 'fields.type', 'نوع الرحلة', '2022-05-31 14:05:41', '2022-05-31 14:07:50'),
(1101, 0, 'en', 'models/tripOrders', 'fields.type', 'type', '2022-05-31 14:05:45', '2022-05-31 14:07:50'),
(1102, 0, 'ur', 'models/tripOrders', 'types.round', NULL, '2022-05-31 14:06:31', '2022-05-31 14:06:31'),
(1103, 0, 'ur', 'models/tripOrders', 'types.multi', NULL, '2022-05-31 14:06:31', '2022-05-31 14:06:31'),
(1104, 0, 'ur', 'models/tripOrders', 'types.one_way', NULL, '2022-05-31 14:06:31', '2022-05-31 14:06:31'),
(1105, 0, 'ar', 'models/tripOrders', 'types.multi', 'رحلات متعددة', '2022-05-31 14:06:47', '2022-05-31 14:07:50'),
(1106, 0, 'en', 'models/tripOrders', 'types.multi', 'Multiple trips', '2022-05-31 14:07:18', '2022-05-31 14:07:50'),
(1107, 0, 'ar', 'models/tripOrders', 'types.one_way', 'اتجاه واحد', '2022-05-31 14:07:25', '2022-05-31 14:07:50'),
(1108, 0, 'en', 'models/tripOrders', 'types.one_way', 'one way', '2022-05-31 14:07:31', '2022-05-31 14:07:50'),
(1109, 0, 'en', 'models/tripOrders', 'types.round', 'round', '2022-05-31 14:07:35', '2022-05-31 14:07:50'),
(1110, 0, 'ar', 'models/tripOrders', 'types.round', 'ذهاب وعودة', '2022-05-31 14:07:45', '2022-05-31 14:07:50'),
(1111, 0, 'ur', 'models/packages', 'fields.image', NULL, '2022-05-31 14:08:42', '2022-05-31 14:08:42'),
(1112, 0, 'ar', 'models/packages', 'fields.image', 'الصورة', '2022-05-31 14:08:53', '2022-05-31 14:09:03'),
(1113, 0, 'en', 'models/packages', 'fields.image', 'image', '2022-05-31 14:08:59', '2022-05-31 14:09:03'),
(1114, 0, 'ur', 'models/accounts', 'roles.admin', NULL, '2022-05-31 14:09:45', '2022-05-31 14:09:45'),
(1115, 0, 'ur', 'models/accounts', 'roles.driver', NULL, '2022-05-31 14:09:45', '2022-05-31 14:09:45'),
(1116, 0, 'ar', 'models/accounts', 'roles.admin', 'ادمن', '2022-05-31 14:10:00', '2022-05-31 14:10:20'),
(1117, 0, 'ar', 'models/accounts', 'roles.driver', 'سائق', '2022-05-31 14:10:06', '2022-05-31 14:10:20'),
(1118, 0, 'en', 'models/accounts', 'roles.admin', 'admin', '2022-05-31 14:10:10', '2022-05-31 14:10:20'),
(1119, 0, 'en', 'models/accounts', 'roles.driver', 'driver', '2022-05-31 14:10:13', '2022-05-31 14:10:20'),
(1120, 0, 'ur', 'models/destinations', 'fields.name', NULL, '2022-05-31 14:11:10', '2022-05-31 14:11:10'),
(1121, 0, 'ar', 'models/destinations', 'fields.name', 'الوجهة', '2022-05-31 14:11:20', '2022-05-31 14:11:39'),
(1122, 0, 'en', 'models/destinations', 'fields.name', 'destination', '2022-05-31 14:11:34', '2022-05-31 14:11:39'),
(1123, 0, 'ur', 'models/notifications', 'fields.status', NULL, '2022-05-31 14:12:28', '2022-05-31 14:12:28'),
(1124, 0, 'ar', 'models/notifications', 'fields.status', 'الحالة', '2022-05-31 14:12:39', '2022-05-31 14:13:51'),
(1125, 0, 'en', 'models/notifications', 'fields.status', 'status', '2022-05-31 14:12:44', '2022-05-31 14:13:51'),
(1126, 0, 'ur', 'models/notifications', 'unread', NULL, '2022-05-31 14:13:08', '2022-05-31 14:13:08'),
(1127, 0, 'ur', 'models/notifications', 'read', NULL, '2022-05-31 14:13:08', '2022-05-31 14:13:08'),
(1128, 0, 'ar', 'models/notifications', 'read', 'مقروءة', '2022-05-31 14:13:26', '2022-05-31 14:13:51'),
(1129, 0, 'en', 'models/notifications', 'read', 'readed', '2022-05-31 14:13:34', '2022-05-31 14:13:51'),
(1130, 0, 'ar', 'models/notifications', 'unread', 'غير مقروءة', '2022-05-31 14:13:43', '2022-05-31 14:13:51'),
(1131, 0, 'en', 'models/notifications', 'unread', 'unread', '2022-05-31 14:13:46', '2022-05-31 14:13:51'),
(1132, 0, 'ur', 'models/packageOrders', 'fields.user_id', NULL, '2022-05-31 14:15:19', '2022-05-31 14:15:19'),
(1133, 0, 'ur', 'models/packageOrders', 'fields.count', NULL, '2022-05-31 14:15:19', '2022-05-31 14:15:19'),
(1134, 0, 'ur', 'models/packageOrders', 'fields.package_id', NULL, '2022-05-31 14:15:19', '2022-05-31 14:15:19'),
(1135, 0, 'ar', 'models/packageOrders', 'fields.count', 'العدد', '2022-05-31 14:15:27', '2022-05-31 14:17:12'),
(1136, 0, 'en', 'models/packageOrders', 'fields.count', 'count', '2022-05-31 14:15:33', '2022-05-31 14:17:12'),
(1137, 0, 'en', 'models/packageOrders', 'fields.package_id', 'package id', '2022-05-31 14:15:40', '2022-05-31 14:17:12'),
(1138, 0, 'ar', 'models/packageOrders', 'fields.package_id', 'معرف البرنامج', '2022-05-31 14:15:47', '2022-05-31 14:17:12'),
(1139, 0, 'en', 'models/packageOrders', 'fields.user_id', 'user id', '2022-05-31 14:15:53', '2022-05-31 14:17:12'),
(1140, 0, 'ar', 'models/packageOrders', 'fields.user_id', 'معرف المستخدم', '2022-05-31 14:16:00', '2022-05-31 14:17:12'),
(1141, 0, 'ur', 'models/packageOrders', 'fields.total', NULL, '2022-05-31 14:16:46', '2022-05-31 14:16:46'),
(1142, 0, 'ur', 'models/packageOrders', 'fields.status', NULL, '2022-05-31 14:16:46', '2022-05-31 14:16:46'),
(1143, 0, 'ar', 'models/packageOrders', 'fields.status', 'الحالة', '2022-05-31 14:16:56', '2022-05-31 14:17:12'),
(1144, 0, 'ar', 'models/packageOrders', 'fields.total', 'الاجمالي', '2022-05-31 14:17:00', '2022-05-31 14:17:12'),
(1145, 0, 'en', 'models/packageOrders', 'fields.status', 'status', '2022-05-31 14:17:05', '2022-05-31 14:17:12'),
(1146, 0, 'en', 'models/packageOrders', 'fields.total', 'total', '2022-05-31 14:17:09', '2022-05-31 14:17:12'),
(1147, 0, 'ur', 'models/reviews', 'fields.name', NULL, '2022-05-31 14:18:35', '2022-05-31 14:18:35'),
(1148, 0, 'ur', 'models/reviews', 'fields.trip_id', NULL, '2022-05-31 14:18:35', '2022-05-31 14:18:35'),
(1149, 0, 'ur', 'models/reviews', 'fields.package_id', NULL, '2022-05-31 14:18:35', '2022-05-31 14:18:35'),
(1150, 0, 'ar', 'models/reviews', 'fields.name', 'الاسم', '2022-05-31 14:18:51', '2022-05-31 14:22:32'),
(1151, 0, 'en', 'models/reviews', 'fields.name', 'name', '2022-05-31 14:18:57', '2022-05-31 14:22:32'),
(1152, 0, 'ar', 'models/reviews', 'fields.package_id', 'معرف البرنامج', '2022-05-31 14:19:11', '2022-05-31 14:22:32'),
(1153, 0, 'ar', 'models/reviews', 'fields.trip_id', 'معرف الوجهة', '2022-05-31 14:19:19', '2022-05-31 14:22:32'),
(1154, 0, 'en', 'models/reviews', 'fields.package_id', 'package id', '2022-05-31 14:19:39', '2022-05-31 14:22:32'),
(1155, 0, 'en', 'models/reviews', 'fields.trip_id', 'trip id', '2022-05-31 14:19:44', '2022-05-31 14:22:32'),
(1156, 0, 'ur', 'models/reviews', 'fields.rate', NULL, '2022-05-31 14:20:47', '2022-05-31 14:20:47'),
(1157, 0, 'ar', 'models/reviews', 'fields.rate', 'التقييم', '2022-05-31 14:20:51', '2022-05-31 14:22:32'),
(1158, 0, 'en', 'models/reviews', 'fields.rate', 'rate', '2022-05-31 14:20:57', '2022-05-31 14:22:32'),
(1159, 0, 'ur', 'models/reviews', 'bus_order_id', NULL, '2022-05-31 14:21:26', '2022-05-31 14:21:26'),
(1160, 0, 'ar', 'models/reviews', 'bus_order_id', 'معرف طلب الباص', '2022-05-31 14:21:41', '2022-05-31 14:22:32'),
(1161, 0, 'en', 'models/reviews', 'bus_order_id', 'bus order id', '2022-05-31 14:21:47', '2022-05-31 14:22:32'),
(1162, 0, 'ur', 'models/reviews', 'fields.bus_order_id', NULL, '2022-05-31 14:22:19', '2022-05-31 14:22:19'),
(1163, 0, 'ar', 'models/reviews', 'fields.bus_order_id', 'معرف طلب الباص', '2022-05-31 14:22:24', '2022-05-31 14:22:32'),
(1164, 0, 'en', 'models/reviews', 'fields.bus_order_id', 'bus order id', '2022-05-31 14:22:28', '2022-05-31 14:22:32'),
(1165, 0, 'ur', 'msg', 'new_users', NULL, '2022-06-01 10:42:46', '2022-06-01 10:42:46'),
(1166, 0, 'ur', 'msg', 'new_providers', NULL, '2022-06-01 10:42:46', '2022-06-01 10:42:46'),
(1167, 0, 'ur', 'msg', 'address', NULL, '2022-06-01 10:42:46', '2022-06-01 10:42:46'),
(1168, 0, 'ur', 'msg', 'age', NULL, '2022-06-01 10:42:46', '2022-06-01 10:42:46'),
(1169, 0, 'ur', 'msg', 'marital_status', NULL, '2022-06-01 10:42:46', '2022-06-01 10:42:46'),
(1170, 0, 'ur', 'msg', 'my_account', NULL, '2022-06-01 10:42:46', '2022-06-01 10:42:46'),
(1171, 0, 'ur', 'msg', 'my_orders', NULL, '2022-06-01 10:42:46', '2022-06-01 10:42:46'),
(1172, 0, 'ur', 'msg', 'change_password', NULL, '2022-06-01 10:42:46', '2022-06-01 10:42:46'),
(1173, 0, 'ar', 'msg', 'address', 'العنوان', '2022-06-01 10:42:59', '2022-06-01 12:39:38'),
(1174, 0, 'ar', 'msg', 'age', 'العمر', '2022-06-01 10:43:03', '2022-06-01 12:39:38'),
(1175, 0, 'ar', 'msg', 'change_password', 'تغيير كلمة المرور', '2022-06-01 10:43:11', '2022-06-01 12:39:38'),
(1176, 0, 'ar', 'msg', 'marital_status', 'الحالة الاجتماعية', '2022-06-01 10:43:25', '2022-06-01 12:39:38'),
(1177, 0, 'en', 'msg', 'marital_status', 'marital status', '2022-06-01 10:43:29', '2022-06-01 12:39:38'),
(1178, 0, 'en', 'msg', 'my_account', 'my account', '2022-06-01 10:43:35', '2022-06-01 12:39:38'),
(1179, 0, 'ar', 'msg', 'my_account', 'حسابي', '2022-06-01 10:43:44', '2022-06-01 12:39:38'),
(1180, 0, 'ar', 'msg', 'my_orders', 'طلباتي', '2022-06-01 10:43:51', '2022-06-01 12:39:38'),
(1181, 0, 'en', 'msg', 'my_orders', 'My orders', '2022-06-01 10:44:03', '2022-06-01 12:39:38'),
(1182, 0, 'ar', 'msg', 'new_providers', 'شركات النقل الجديدة', '2022-06-01 10:44:22', '2022-06-01 12:39:38'),
(1183, 0, 'en', 'msg', 'new_providers', 'new providers', '2022-06-01 10:44:28', '2022-06-01 12:39:38'),
(1184, 0, 'ar', 'msg', 'new_users', 'المستخدمين الجدد', '2022-06-01 10:44:39', '2022-06-01 12:39:38'),
(1185, 0, 'en', 'msg', 'new_users', 'new users', '2022-06-01 10:44:46', '2022-06-01 12:39:38'),
(1186, 0, 'en', 'msg', 'filter', 'filter', '2022-06-01 10:44:56', '2022-06-01 12:39:38'),
(1187, 0, 'en', 'msg', 'change_password', 'change password', '2022-06-01 10:45:03', '2022-06-01 12:39:38'),
(1188, 0, 'en', 'msg', 'age', 'age', '2022-06-01 10:45:09', '2022-06-01 12:39:38'),
(1189, 0, 'en', 'msg', 'address', 'address', '2022-06-01 10:45:13', '2022-06-01 12:39:38'),
(1190, 0, 'ur', 'msg', 'my_complain', NULL, '2022-06-01 10:46:15', '2022-06-01 10:46:15'),
(1191, 0, 'ur', 'msg', 'date_of_birth', NULL, '2022-06-01 10:46:15', '2022-06-01 10:46:15'),
(1192, 0, 'ur', 'msg', 'logout', NULL, '2022-06-01 10:46:16', '2022-06-01 10:46:16'),
(1193, 0, 'ar', 'msg', 'date_of_birth', 'تاريخ الميلاد', '2022-06-01 10:46:29', '2022-06-01 12:39:38'),
(1194, 0, 'en', 'msg', 'date_of_birth', 'date of birth', '2022-06-01 10:46:36', '2022-06-01 12:39:38'),
(1195, 0, 'ar', 'msg', 'logout', 'تسجيل الخروج', '2022-06-01 10:46:47', '2022-06-01 12:39:38'),
(1196, 0, 'en', 'msg', 'logout', 'logout', '2022-06-01 10:46:50', '2022-06-01 12:39:38'),
(1197, 0, 'en', 'msg', 'my_complain', 'my complain', '2022-06-01 10:46:57', '2022-06-01 12:39:38'),
(1198, 0, 'ar', 'msg', 'my_complain', 'الشكاوي', '2022-06-01 10:47:02', '2022-06-01 12:39:38'),
(1199, 0, 'ur', 'msg', 'links', NULL, '2022-06-01 10:52:59', '2022-06-01 10:52:59'),
(1200, 0, 'ur', 'msg', 'app_links', NULL, '2022-06-01 10:52:59', '2022-06-01 10:52:59'),
(1201, 0, 'ur', 'msg', 'contact_us', NULL, '2022-06-01 10:52:59', '2022-06-01 10:52:59'),
(1202, 0, 'ar', 'msg', 'app_links', 'تحميل التطبيق', '2022-06-01 10:53:12', '2022-06-01 12:39:38'),
(1203, 0, 'en', 'msg', 'app_links', 'download app', '2022-06-01 10:53:28', '2022-06-01 12:39:38'),
(1204, 0, 'ar', 'msg', 'links', 'الروابط', '2022-06-01 10:54:03', '2022-06-01 12:39:38'),
(1205, 0, 'en', 'msg', 'links', 'links', '2022-06-01 10:54:08', '2022-06-01 12:39:38'),
(1206, 0, 'ur', 'models/users', 'marital_status.single', NULL, '2022-06-01 10:56:14', '2022-06-01 10:56:14'),
(1207, 0, 'ur', 'models/users', 'marital_status.married', NULL, '2022-06-01 10:56:14', '2022-06-01 10:56:14'),
(1208, 0, 'ar', 'models/users', 'marital_status.married', 'متزوج', '2022-06-01 10:56:24', '2022-06-01 10:56:39'),
(1209, 0, 'ar', 'models/users', 'marital_status.single', 'اعزب', '2022-06-01 10:56:27', '2022-06-01 10:56:39'),
(1210, 0, 'en', 'models/users', 'marital_status.single', 'single', '2022-06-01 10:56:32', '2022-06-01 10:56:39'),
(1211, 0, 'en', 'models/users', 'marital_status.married', 'married', '2022-06-01 10:56:35', '2022-06-01 10:56:39'),
(1212, 0, 'ur', 'msg', 'status', NULL, '2022-06-01 11:18:28', '2022-06-01 11:18:28'),
(1213, 0, 'ur', 'msg', 'created_at', NULL, '2022-06-01 11:18:28', '2022-06-01 11:18:28'),
(1214, 0, 'ar', 'msg', 'created_at', 'انشأ في', '2022-06-01 11:18:46', '2022-06-01 12:39:38'),
(1215, 0, 'en', 'msg', 'created_at', 'created at', '2022-06-01 11:18:53', '2022-06-01 12:39:38'),
(1216, 0, 'en', 'msg', 'status', 'status', '2022-06-01 11:19:01', '2022-06-01 12:39:38'),
(1217, 0, 'ar', 'msg', 'status', 'الحالة', '2022-06-01 11:19:08', '2022-06-01 12:39:38'),
(1218, 0, 'ur', 'msg', 'new', NULL, '2022-06-01 11:23:25', '2022-06-01 11:23:25'),
(1219, 0, 'ar', 'msg', 'new', 'شكوي جديدة', '2022-06-01 11:23:42', '2022-06-01 12:39:38'),
(1220, 0, 'en', 'msg', 'new', 'new complaint', '2022-06-01 11:23:54', '2022-06-01 12:39:38'),
(1221, 0, 'ur', 'models/contacts', 'read', NULL, '2022-06-01 12:14:35', '2022-06-01 12:14:35'),
(1222, 0, 'ar', 'models/contacts', 'read', 'مقروء', '2022-06-01 12:14:50', '2022-06-01 12:58:44'),
(1223, 0, 'en', 'models/contacts', 'read', 'readed', '2022-06-01 12:14:59', '2022-06-01 12:58:44'),
(1224, 0, 'ar', 'msg', 'contact_us', 'اتصل بنا', '2022-06-01 12:31:52', '2022-06-01 12:39:38'),
(1225, 0, 'en', 'msg', 'contact_us', 'contact us', '2022-06-01 12:31:59', '2022-06-01 12:39:38'),
(1226, 0, 'ur', 'msg', 'open', NULL, '2022-06-01 12:39:19', '2022-06-01 12:39:19'),
(1227, 0, 'ar', 'msg', 'open', 'فتح', '2022-06-01 12:39:29', '2022-06-01 12:39:38'),
(1228, 0, 'en', 'msg', 'open', 'open', '2022-06-01 12:39:33', '2022-06-01 12:39:38'),
(1229, 0, 'ur', 'auth', 'verify_phone.please_use_this_code', 'Please use the following code to verify your account', '2022-06-29 08:23:50', '2022-06-29 08:25:39'),
(1230, 0, 'ar', 'auth', 'verify_phone.please_use_this_code', 'الرجاء استخدام الرمز التالي لتاكيد حسابك', '2022-06-29 08:24:21', '2022-06-29 08:25:39'),
(1231, 0, 'en', 'auth', 'verify_phone.please_use_this_code', 'Please use the following code to verify your account', '2022-06-29 08:25:28', '2022-06-29 08:25:39');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `chat_id` bigint(20) UNSIGNED NOT NULL,
  `sender` enum('user','provider') COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(11, '2014_10_12_000000_create_users_table', 1),
(12, '2014_10_12_100000_create_password_resets_table', 1),
(13, '2017_03_06_023521_create_admins_table', 1),
(16, '2019_08_19_000000_create_failed_jobs_table', 1),
(20, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(21, '2022_03_15_085038_create_notifications_table', 2),
(22, '2022_03_16_111927_create_providers_table', 3),
(23, '2014_04_02_193005_create_translations_table', 4),
(24, '2022_03_21_062226_create_contacts_table', 5),
(25, '2022_03_22_051102_create_settings_table', 6),
(26, '2022_03_22_080227_create_cities_table', 7),
(27, '2022_03_22_080434_create_categories_table', 8),
(28, '2022_03_22_104832_create_accounts_table', 9),
(29, '2022_03_22_112125_create_provider_cities_table', 10),
(30, '2022_03_24_005123_create_buses_table', 11),
(31, '2022_03_28_084224_create_bus_orders_table', 12),
(32, '2022_04_07_083225_create_destinations_table', 13),
(33, '2022_04_11_044730_create_packages_table', 14),
(34, '2022_04_011_044760_create_package_cities_table', 15),
(35, '2022_04_21_015957_create_features_table', 16),
(36, '2022_04_21_021224_create_services_table', 17),
(37, '2022_04_21_061908_create_emails_table', 18),
(38, '2022_04_25_231026_create_additionals_table', 19),
(39, '2022_04_25_231421_create_terminals_table', 20),
(40, '2022_04_26_214740_create_coupons_table', 21),
(41, '2016_06_01_000001_create_oauth_auth_codes_table', 22),
(42, '2016_06_01_000002_create_oauth_access_tokens_table', 22),
(43, '2016_06_01_000003_create_oauth_refresh_tokens_table', 22),
(44, '2016_06_01_000004_create_oauth_clients_table', 22),
(45, '2016_06_01_000005_create_oauth_personal_access_clients_table', 22),
(46, '2022_06_06_232417_create_chats_table', 23),
(47, '2022_06_06_232418_create_messages_table', 23),
(48, '2022_06_08_075354_user_otp', 23);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('primary','info','success','warning','danger') COLLATE utf8mb4_unicode_ci NOT NULL,
  `to` enum('admin','user','provider') COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `provider_id` bigint(20) UNSIGNED DEFAULT NULL,
  `account_id` bigint(20) UNSIGNED DEFAULT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `title`, `text`, `url`, `icon`, `type`, `to`, `admin_id`, `user_id`, `provider_id`, `account_id`, `read_at`, `created_at`, `updated_at`) VALUES
(1, 'Welcome !', 'Welcome to our laravel app.\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters', NULL, 'icon-heart', 'primary', 'admin', 1, NULL, NULL, NULL, NULL, '2022-03-15 18:05:32', '2022-03-17 01:26:07'),
(2, 'Test', 'This will specifically look for the admin guard and nothing else so guest means that the admin is not logged in and it doesn’t care if a user from web guard is logged in or not.', 'http://localhost/startup-laravel', NULL, 'info', 'user', NULL, 1, NULL, NULL, NULL, '2022-03-16 03:32:11', '2022-03-28 03:04:22'),
(3, 'Test For All User.', 'This will specifically look for the admin guard and nothing else so guest means that the admin is not logged in and it doesn’t care if a user from web guard is logged in or not. You can also use it inside a route.', NULL, 'ti-settings', 'info', 'user', NULL, NULL, NULL, NULL, NULL, '2022-03-17 00:31:04', '2022-03-28 03:04:31'),
(4, 'Test For User.', 'This will specifically look for the admin guard and nothing else so guest means that the admin is not logged in and it doesn’t care if a user from web guard is logged in or not. You can also use it inside a route.', NULL, 'ti-settings', 'info', 'user', NULL, 2, NULL, NULL, NULL, '2022-03-17 00:31:04', '2022-03-17 00:31:04'),
(5, 'test', 'Dear USer\r\n\r\nLorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus ', 'http://localhost/qbus/contacts/3', 'icon-info', 'info', 'user', NULL, 1, NULL, NULL, NULL, '2022-03-28 02:35:19', '2022-04-06 02:57:09'),
(6, 'New bus order #2', 'A new order has just been created by user <b> user </b>, \n                order is approved, please click to check more details.', 'http://localhost/qbus/provider/busOrders/2', 'ti-truck', 'primary', 'provider', NULL, NULL, 18, NULL, NULL, '2022-04-04 03:06:47', '2022-04-04 03:06:47'),
(7, 'New bus order #16', 'A new order has just been created by user <b> user </b>, \n                order is approved, please click to check more details.', 'http://localhost/qbus/provider/busOrders/16', 'ti-truck', 'primary', 'provider', NULL, NULL, 18, NULL, NULL, '2022-04-04 03:24:23', '2022-04-04 03:24:23'),
(8, 'New bus order #17', 'A new order has just been created by user <b> user </b>, \n                order is approved, please click to check more details.', 'http://localhost/qbus/provider/busOrders/17', 'ti-truck', 'primary', 'provider', NULL, NULL, 18, NULL, NULL, '2022-04-04 03:51:29', '2022-04-04 03:51:29'),
(9, 'New bus order #18', 'A new order has just been created by user <b> user </b>, \n                order is pending, please click to check more details.', 'http://localhost/qbus/provider/busOrders/18', 'ti-truck', 'primary', 'provider', NULL, NULL, 1, NULL, '2022-05-25 11:11:01', '2022-04-04 07:35:58', '2022-05-25 11:11:01'),
(10, 'Order #18', 'Your order has been created successfully, \n                order is pending, please click to check more details.', 'http://localhost/qbus/busOrders/18', 'ti-truck', 'primary', 'user', NULL, 1, NULL, NULL, NULL, '2022-04-04 07:35:58', '2022-04-04 07:36:19'),
(11, 'Order #18', 'Your order is approved, please do the payment to complete the order.', 'http://localhost/qbus/busOrders/18', 'ti-check', 'success', 'user', NULL, 1, NULL, NULL, NULL, '2022-04-06 01:59:10', '2022-04-06 01:59:34'),
(12, 'Order #18', 'Your order is canceled, please click to check more details.', 'http://localhost/qbus/provider/busOrders/18', 'ti-close', 'danger', 'provider', NULL, NULL, 1, NULL, '2022-05-25 11:16:51', '2022-04-06 02:32:38', '2022-05-25 11:16:51'),
(13, 'New bus order #20', 'A new order has just been created by user <b> user </b>, \n                order is approved, please click to check more details.', 'http://localhost/qbus/provider/busOrders/20', 'ti-truck', 'primary', 'provider', NULL, NULL, 1, NULL, NULL, '2022-04-12 02:37:13', '2022-04-12 02:41:25'),
(14, 'Order #20', 'Your order has been created successfully, \n                order is approved, please click to check more details.', 'http://localhost/qbus/busOrders/20', 'ti-truck', 'primary', 'user', NULL, 1, NULL, NULL, NULL, '2022-04-12 02:37:13', '2022-04-12 02:37:13'),
(15, 'Trip Order #1', 'Your order is models/trips.status.approved, please do the payment to complete the order.', 'http://localhost/qbus/trips/1', 'ti-check', 'success', 'user', NULL, 1, NULL, NULL, NULL, '2022-04-14 02:55:23', '2022-04-14 02:55:23'),
(16, 'Trip Order #1', 'Your order is models/trips.status.approved, please do the payment to complete the order.', 'http://localhost/qbus/trips/1', 'ti-check', 'success', 'user', NULL, 1, NULL, NULL, NULL, '2022-04-14 02:56:21', '2022-04-14 02:56:21'),
(17, 'Order #20', 'Your order is approved, please do the payment to complete the order.', 'http://localhost/qbus/busOrders/20', 'ti-check', 'success', 'user', NULL, 1, NULL, NULL, NULL, '2022-04-14 02:58:21', '2022-04-14 02:58:21'),
(22, 'Trip Order #10', 'New reservation is ordered for trip #22 : Lorem Ipsum2, please click to check more details.', 'http://localhost/qbus/provider/tripOrders/10', 'ti-shopping-cart', 'info', 'provider', NULL, NULL, 1, NULL, NULL, '2022-04-21 17:28:20', '2022-04-21 17:28:20'),
(23, 'Trip Order #10', 'Your order is created successfully for trip #22 : Lorem Ipsum2, please click to check more details.', 'http://localhost/qbus/tripOrders/10', 'ti-shopping-cart', 'info', 'user', NULL, 1, NULL, NULL, NULL, '2022-04-21 17:28:20', '2022-04-21 17:28:20'),
(24, 'Trip Order #11', 'New reservation is ordered for trip #22 : Lorem Ipsum2, please click to check more details.', 'http://localhost/qbus/provider/tripOrders/11', 'ti-shopping-cart', 'info', 'provider', NULL, NULL, 1, NULL, NULL, '2022-04-21 17:29:36', '2022-04-21 17:29:36'),
(25, 'Trip Order #11', 'Your order is created successfully for trip #22 : Lorem Ipsum2, please click to check more details.', 'http://localhost/qbus/tripOrders/11', 'ti-shopping-cart', 'info', 'user', NULL, 1, NULL, NULL, NULL, '2022-04-21 17:29:36', '2022-04-21 17:29:36'),
(26, 'Trip Order #12', 'New reservation is ordered for trip #22 : Lorem Ipsum2, please click to check more details.', 'http://localhost/qbus/provider/tripOrders/12', 'ti-shopping-cart', 'info', 'provider', NULL, NULL, 1, NULL, NULL, '2022-04-21 17:29:48', '2022-04-21 17:29:48'),
(27, 'Trip Order #12', 'Your order is created successfully for trip #22 : Lorem Ipsum2, please click to check more details.', 'http://localhost/qbus/tripOrders/12', 'ti-shopping-cart', 'info', 'user', NULL, 1, NULL, NULL, NULL, '2022-04-21 17:29:48', '2022-04-21 17:29:48'),
(28, 'Trip Order #13', 'New reservation is ordered for trip #22 : Lorem Ipsum2, please click to check more details.', 'http://localhost/qbus/provider/tripOrders/13', 'ti-shopping-cart', 'info', 'provider', NULL, NULL, 1, NULL, NULL, '2022-04-21 17:30:52', '2022-04-21 17:30:52'),
(29, 'Trip Order #13', 'Your order is created successfully for trip #22 : Lorem Ipsum2, please click to check more details.', 'http://localhost/qbus/tripOrders/13', 'ti-shopping-cart', 'info', 'user', NULL, 1, NULL, NULL, NULL, '2022-04-21 17:30:52', '2022-04-21 17:30:52'),
(30, 'Trip Order #14', 'New reservation is ordered for trip #22 : Lorem Ipsum2, please click to check more details.', 'http://localhost/qbus/provider/tripOrders/14', 'ti-shopping-cart', 'info', 'provider', NULL, NULL, 1, NULL, NULL, '2022-04-21 17:32:16', '2022-04-21 17:32:16'),
(31, 'Trip Order #14', 'Your order is created successfully for trip #22 : Lorem Ipsum2, please click to check more details.', 'http://localhost/qbus/tripOrders/14', 'ti-shopping-cart', 'info', 'user', NULL, 1, NULL, NULL, NULL, '2022-04-21 17:32:16', '2022-04-21 17:32:16'),
(32, 'Trip Order #15', 'New reservation is ordered for trip #22 : Lorem Ipsum2, please click to check more details.', 'http://localhost/qbus/provider/tripOrders/15', 'ti-shopping-cart', 'info', 'provider', NULL, NULL, 1, NULL, NULL, '2022-04-21 17:35:14', '2022-04-21 17:35:14'),
(33, 'Trip Order #15', 'Your order is created successfully for trip #22 : Lorem Ipsum2, please click to check more details.', 'http://localhost/qbus/tripOrders/15', 'ti-shopping-cart', 'info', 'user', NULL, 1, NULL, NULL, NULL, '2022-04-21 17:35:14', '2022-04-21 17:35:14'),
(34, 'Trip Order #16', 'New reservation is ordered for trip #22 : Lorem Ipsum2, please click to check more details.', 'http://localhost/qbus/provider/tripOrders/16', 'ti-shopping-cart', 'info', 'provider', NULL, NULL, 1, NULL, NULL, '2022-04-25 03:18:28', '2022-04-25 03:18:28'),
(35, 'Trip Order #16', 'Your order is created successfully for trip #22 : Lorem Ipsum2, please click to check more details.', 'http://localhost/qbus/tripOrders/16', 'ti-shopping-cart', 'info', 'user', NULL, 1, NULL, NULL, NULL, '2022-04-25 03:18:28', '2022-04-25 03:18:28'),
(36, 'Trip Order #17', 'New reservation is ordered for trip #22 : Lorem Ipsum2, please click to check more details.', 'http://localhost/qbus/provider/tripOrders/17', 'ti-shopping-cart', 'info', 'provider', NULL, NULL, 1, NULL, NULL, '2022-04-25 03:32:54', '2022-04-25 03:32:54'),
(37, 'Trip Order #17', 'Your order is created successfully for trip #22 : Lorem Ipsum2, please click to check more details.', 'http://localhost/qbus/tripOrders/17', 'ti-shopping-cart', 'info', 'user', NULL, 1, NULL, NULL, NULL, '2022-04-25 03:32:54', '2022-04-25 03:32:54'),
(38, 'Trip Order #18', 'New reservation is ordered for trip #22 : Lorem Ipsum2, please click to check more details.', 'http://localhost/qbus/provider/tripOrders/18', 'ti-shopping-cart', 'info', 'provider', NULL, NULL, 1, NULL, NULL, '2022-04-25 03:42:42', '2022-04-25 03:42:42'),
(39, 'Trip Order #18', 'Your order is created successfully for trip #22 : Lorem Ipsum2, please click to check more details.', 'http://localhost/qbus/tripOrders/18', 'ti-shopping-cart', 'info', 'user', NULL, 1, NULL, NULL, NULL, '2022-04-25 03:42:42', '2022-04-25 03:42:42'),
(40, 'Trip Order #19', 'New reservation is ordered for trip #22 : Lorem Ipsum2, please click to check more details.', 'http://localhost/qbus/provider/tripOrders/19', 'ti-shopping-cart', 'info', 'provider', NULL, NULL, 1, NULL, NULL, '2022-04-25 04:04:37', '2022-04-25 04:04:37'),
(41, 'Trip Order #19', 'Your order is created successfully for trip #22 : Lorem Ipsum2, please click to check more details.', 'http://localhost/qbus/tripOrders/19', 'ti-shopping-cart', 'info', 'user', NULL, 1, NULL, NULL, NULL, '2022-04-25 04:04:37', '2022-04-25 04:04:37'),
(42, 'Trip Order #20', 'New reservation is ordered for trip #22 : Lorem Ipsum2, please click to check more details.', 'http://localhost/qbus/provider/tripOrders/20', 'ti-shopping-cart', 'info', 'provider', NULL, NULL, 1, NULL, NULL, '2022-04-25 04:04:55', '2022-04-25 04:04:55'),
(43, 'Trip Order #20', 'Your order is created successfully for trip #22 : Lorem Ipsum2, please click to check more details.', 'http://localhost/qbus/tripOrders/20', 'ti-shopping-cart', 'info', 'user', NULL, 1, NULL, NULL, NULL, '2022-04-25 04:04:55', '2022-04-25 04:04:55'),
(44, 'TripOrder#14', 'test cancelation from the admin side.', 'http://localhost/qbus/tripOrders/14', 'icon-info', 'danger', 'user', NULL, 1, NULL, NULL, NULL, '2022-05-09 02:47:52', '2022-05-09 02:47:52'),
(45, 'Trip Order #14', 'Your order is models/trips.status.approved, please do the payment to complete the order.', 'http://localhost/qbus/trips/14', 'ti-check', 'success', 'user', NULL, 1, NULL, NULL, NULL, '2022-05-09 05:19:44', '2022-05-09 05:19:44'),
(46, 'Trip Order #14', 'Your order is models/trips.status.rejected, please click to check more details.', 'http://localhost/qbus/trips/14', 'ti-close', 'danger', 'admin', NULL, 1, NULL, NULL, NULL, '2022-05-09 05:33:46', '2022-05-09 05:33:46'),
(47, 'Trip Order #21', 'Your order is created successfully for trip #34, please click to check more details.', 'http://localhost/qbus/tripOrders/21', 'ti-shopping-cart', 'info', 'user', NULL, 5, NULL, NULL, NULL, '2022-05-09 11:08:47', '2022-05-09 11:08:47'),
(48, 'Trip Order #22', 'Your order is created successfully for trip #34, please click to check more details.', 'http://localhost/qbus/tripOrders/22', 'ti-shopping-cart', 'info', 'user', NULL, 2, NULL, NULL, NULL, '2022-05-09 11:29:08', '2022-05-09 11:29:08'),
(49, 'Trip #34', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.', 'http://localhost/qbus/tripOrders/14', 'ti-info', 'info', 'admin', NULL, 1, NULL, NULL, NULL, '2022-05-10 02:12:27', '2022-05-10 02:12:27'),
(50, 'Trip #34', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.', 'http://localhost/qbus/tripOrders/21', 'ti-info', 'info', 'user', NULL, 5, NULL, NULL, NULL, '2022-05-10 02:12:27', '2022-05-10 02:12:27'),
(51, 'Trip #34', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.', 'http://localhost/qbus/tripOrders/22', 'ti-info', 'info', 'user', NULL, 2, NULL, NULL, NULL, '2022-05-10 02:12:27', '2022-05-10 02:12:27'),
(52, 'Package Order #1', 'Your order is models/packages.status.rejected, please click to check more details.', 'http://localhost/qbus/packageOrders/1', 'ti-close', 'danger', 'user', NULL, 1, NULL, NULL, NULL, '2022-05-10 22:04:05', '2022-05-10 22:04:05'),
(53, 'Package Order #10', 'Your order is models/packages.status.approved, please do the payment to complete the order.', 'http://localhost/qbus/packageOrders/10', 'ti-check', 'success', 'admin', NULL, 1, NULL, NULL, NULL, '2022-05-10 22:05:13', '2022-05-10 22:05:13'),
(54, 'Package Order #21', 'Your order is created successfully for package #9 Package 1, please click to check more details.', 'http://localhost/qbus/packageOrders/21', 'ti-shopping-cart', 'info', 'user', NULL, 2, NULL, NULL, NULL, '2022-05-10 22:14:08', '2022-05-10 22:14:08'),
(55, 'PackageOrder#21', 'test', 'http://localhost/qbus/packageOrders/21', 'icon-info', 'danger', 'user', NULL, 2, NULL, NULL, NULL, '2022-05-11 07:25:15', '2022-05-11 07:25:15'),
(56, 'BusOrder#2', 'test', 'http://localhost/qbus/busOrders/2', 'icon-info', 'danger', 'user', NULL, 1, NULL, NULL, NULL, '2022-05-11 08:20:58', '2022-05-11 08:20:58'),
(57, 'Order #17', 'Your order is rejected, please click to check more details.', 'http://localhost/qbus/busOrders/17', 'ti-close', 'danger', 'admin', NULL, 1, NULL, NULL, NULL, '2022-05-11 08:32:16', '2022-05-11 08:32:16'),
(58, 'Order #20', 'Your order is approved, please do the payment to complete the order.', 'http://localhost/qbus/busOrders/20', 'ti-check', 'success', 'admin', NULL, 1, NULL, NULL, NULL, '2022-05-11 08:34:49', '2022-05-11 08:34:49'),
(59, 'Trip Order #23', 'New reservation for trip #35, please click to check more details.', 'http://localhost/qbus/provider/tripOrders/23', 'ti-shopping-cart', 'info', 'provider', NULL, NULL, 1, NULL, NULL, '2022-05-25 11:03:20', '2022-05-25 11:03:20'),
(60, 'Trip Order #23', 'Your order is created successfully for trip #35, please click to check more details.', 'http://localhost/qbus/tripOrders/23', 'ti-shopping-cart', 'info', 'user', NULL, 5, NULL, NULL, NULL, '2022-05-25 11:03:20', '2022-05-25 11:03:20'),
(61, 'Trip Order #24', 'New reservation for trip #35, please click to check more details.', 'http://localhost/qbus/provider/tripOrders/24', 'ti-shopping-cart', 'info', 'provider', NULL, NULL, 1, NULL, NULL, '2022-05-25 11:04:36', '2022-05-25 11:04:36'),
(62, 'Trip Order #24', 'Your order is created successfully for trip #35, please click to check more details.', 'http://localhost/qbus/tripOrders/24', 'ti-shopping-cart', 'info', 'user', NULL, 5, NULL, NULL, NULL, '2022-05-25 11:04:36', '2022-05-25 11:04:36'),
(63, 'Package Order #22', 'New reservation for package #9, please click to check more details.', 'http://localhost/qbus/provider/packageOrders/22', 'ti-shopping-cart', 'warning', 'provider', NULL, NULL, 1, NULL, '2022-05-25 11:15:01', '2022-05-25 11:05:53', '2022-05-25 11:15:01'),
(64, 'Package Order #22', 'Your order is created successfully for package #9, please click to check more details.', 'http://localhost/qbus/packageOrders/22', 'ti-shopping-cart', 'info', 'user', NULL, 5, NULL, NULL, NULL, '2022-05-25 11:05:53', '2022-05-25 11:05:53'),
(65, 'Trip Order #25', 'New reservation for trip #35, please click to check more details.', 'http://localhost/qbus/provider/tripOrders/25', 'ti-shopping-cart', 'info', 'provider', NULL, NULL, 1, NULL, '2022-05-25 11:11:10', '2022-05-25 11:06:47', '2022-05-25 11:11:10'),
(66, 'Trip Order #25', 'Your order is created successfully for trip #35, please click to check more details.', 'http://localhost/qbus/tripOrders/25', 'ti-shopping-cart', 'info', 'user', NULL, 5, NULL, NULL, NULL, '2022-05-25 11:06:47', '2022-05-25 11:06:47'),
(67, 'Trip Order #26', 'New reservation for trip #35, please click to check more details.', 'http://localhost/qbus/provider/tripOrders/26', 'ti-shopping-cart', 'info', 'provider', NULL, NULL, 1, NULL, NULL, '2022-05-26 12:59:13', '2022-05-26 12:59:13'),
(68, 'Trip Order #26', 'Your order is created successfully for trip #35, please click to check more details.', 'http://localhost/qbus/tripOrders/26', 'ti-shopping-cart', 'info', 'user', NULL, 5, NULL, NULL, NULL, '2022-05-26 12:59:13', '2022-05-26 12:59:13'),
(69, 'Trip Order #27', 'New reservation for trip #36, please click to check more details.', 'http://localhost/qbus/provider/tripOrders/27', 'ti-shopping-cart', 'warning', 'provider', NULL, NULL, 1, NULL, NULL, '2022-05-26 13:00:58', '2022-05-26 13:00:58'),
(70, 'Trip Order #27', 'Your order is created successfully for trip #36, please click to check more details.', 'http://localhost/qbus/tripOrders/27', 'ti-shopping-cart', 'info', 'user', NULL, 5, NULL, NULL, NULL, '2022-05-26 13:00:58', '2022-05-26 13:00:58'),
(71, 'Trip Order #28', 'New reservation for trip #37, please click to check more details.', 'http://localhost/qbus/provider/tripOrders/28', 'ti-shopping-cart', 'warning', 'provider', NULL, NULL, 1, NULL, NULL, '2022-05-26 13:14:20', '2022-05-26 13:14:20'),
(72, 'Trip Order #28', 'Your order is created successfully for trip #37, please click to check more details.', 'http://localhost/qbus/tripOrders/28', 'ti-shopping-cart', 'info', 'user', NULL, 5, NULL, NULL, NULL, '2022-05-26 13:14:20', '2022-05-26 13:14:20'),
(73, 'Trip Order #29', 'New reservation for trip #35, please click to check more details.', 'http://localhost/qbus/provider/tripOrders/29', 'ti-shopping-cart', 'info', 'provider', NULL, NULL, 1, NULL, NULL, '2022-05-26 13:16:08', '2022-05-26 13:16:08'),
(74, 'Trip Order #29', 'Your order is created successfully for trip #35, please click to check more details.', 'http://localhost/qbus/tripOrders/29', 'ti-shopping-cart', 'info', 'user', NULL, 5, NULL, NULL, NULL, '2022-05-26 13:16:08', '2022-05-26 13:16:08'),
(75, 'Trip Order #30', 'New reservation for trip #35, please click to check more details.', 'http://localhost/qbus/provider/tripOrders/30', 'ti-shopping-cart', 'info', 'provider', NULL, NULL, 1, NULL, NULL, '2022-06-02 05:21:49', '2022-06-02 05:21:49'),
(76, 'Trip Order #30', 'Your order is created successfully for trip #35, please click to check more details.', 'http://localhost/qbus/tripOrders/30', 'ti-shopping-cart', 'info', 'user', NULL, 5, NULL, NULL, NULL, '2022-06-02 05:21:49', '2022-06-02 05:21:49'),
(77, 'Package Order #23', 'New reservation for package #9, please click to check more details.', 'http://localhost/qbus/provider/packageOrders/23', 'ti-shopping-cart', 'warning', 'provider', NULL, NULL, 1, NULL, NULL, '2022-06-02 05:27:25', '2022-06-02 05:27:25'),
(78, 'Package Order #23', 'Your order is created successfully for package #9, please click to check more details.', 'http://localhost/qbus/packageOrders/23', 'ti-shopping-cart', 'info', 'user', NULL, 5, NULL, NULL, NULL, '2022-06-02 05:27:25', '2022-06-02 05:27:25'),
(79, 'Package Order #24', 'New reservation for package #10, please click to check more details.', 'http://localhost/qbus/provider/packageOrders/24', 'ti-shopping-cart', 'info', 'provider', NULL, NULL, 1, NULL, NULL, '2022-06-02 05:28:41', '2022-06-02 05:28:41'),
(80, 'Package Order #24', 'Your order is created successfully for package #10, please click to check more details.', 'http://localhost/qbus/packageOrders/24', 'ti-shopping-cart', 'info', 'user', NULL, 5, NULL, NULL, NULL, '2022-06-02 05:28:41', '2022-06-02 05:28:41'),
(81, 'Trip Order #31', 'New reservation for trip #35, please click to check more details.', 'http://localhost/qbus/provider/tripOrders/31', 'ti-shopping-cart', 'info', 'provider', NULL, NULL, 1, NULL, NULL, '2022-06-02 05:30:09', '2022-06-02 05:30:09'),
(82, 'Trip Order #31', 'Your order is created successfully for trip #35, please click to check more details.', 'http://localhost/qbus/tripOrders/31', 'ti-shopping-cart', 'info', 'user', NULL, 5, NULL, NULL, NULL, '2022-06-02 05:30:09', '2022-06-02 05:30:09'),
(83, 'Package Order #25', 'New reservation for package #9, please click to check more details.', 'http://localhost/qbus/provider/packageOrders/25', 'ti-shopping-cart', 'info', 'provider', NULL, NULL, 1, NULL, NULL, '2022-06-02 05:41:34', '2022-06-02 05:41:34'),
(84, 'Package Order #25', 'Your order is created successfully for package #9, please click to check more details.', 'http://localhost/qbus/packageOrders/25', 'ti-shopping-cart', 'info', 'user', NULL, 5, NULL, NULL, NULL, '2022-06-02 05:41:34', '2022-06-02 05:41:34'),
(85, 'Package Order #26', 'New reservation for package #9, please click to check more details.', 'http://localhost/qbus/provider/packageOrders/26', 'ti-shopping-cart', 'info', 'provider', NULL, NULL, 1, NULL, NULL, '2022-06-02 05:41:58', '2022-06-02 05:41:58'),
(86, 'Package Order #26', 'Your order is created successfully for package #9, please click to check more details.', 'http://localhost/qbus/packageOrders/26', 'ti-shopping-cart', 'info', 'user', NULL, 5, NULL, NULL, NULL, '2022-06-02 05:41:58', '2022-06-02 05:41:58'),
(87, 'Package Order #27', 'New reservation for package #9, please click to check more details.', 'http://localhost/qbus/provider/packageOrders/27', 'ti-shopping-cart', 'info', 'provider', NULL, NULL, 1, NULL, NULL, '2022-06-02 05:42:12', '2022-06-02 05:42:12'),
(88, 'Package Order #27', 'Your order is created successfully for package #9, please click to check more details.', 'http://localhost/qbus/packageOrders/27', 'ti-shopping-cart', 'info', 'user', NULL, 5, NULL, NULL, NULL, '2022-06-02 05:42:12', '2022-06-02 05:42:12'),
(89, 'Trip Order #32', 'New reservation for trip #35, please click to check more details.', 'http://localhost/qbus/provider/tripOrders/32', 'ti-shopping-cart', 'info', 'provider', NULL, NULL, 1, NULL, NULL, '2022-06-02 05:52:08', '2022-06-02 05:52:08'),
(90, 'Trip Order #32', 'Your order is created successfully for trip #35, please click to check more details.', 'http://localhost/qbus/tripOrders/32', 'ti-shopping-cart', 'info', 'user', NULL, 5, NULL, NULL, NULL, '2022-06-02 05:52:08', '2022-06-02 05:52:08'),
(91, 'Trip Order #33', 'New reservation for trip #40, please click to check more details.', 'http://localhost/qbus/provider/tripOrders/33', 'ti-shopping-cart', 'info', 'provider', NULL, NULL, 1, NULL, NULL, '2022-06-02 06:17:39', '2022-06-02 06:17:39'),
(92, 'Trip Order #33', 'Your order is created successfully for trip #40, please click to check more details.', 'http://localhost/qbus/tripOrders/33', 'ti-shopping-cart', 'info', 'user', NULL, 5, NULL, NULL, NULL, '2022-06-02 06:17:39', '2022-06-02 06:17:39'),
(93, 'Trip Order #34', 'New reservation for trip #40, please click to check more details.', 'http://localhost/qbus/provider/tripOrders/34', 'ti-shopping-cart', 'info', 'provider', NULL, NULL, 1, NULL, NULL, '2022-06-02 06:19:24', '2022-06-02 06:19:24'),
(94, 'Trip Order #34', 'Your order is created successfully for trip #40, please click to check more details.', 'http://localhost/qbus/tripOrders/34', 'ti-shopping-cart', 'info', 'user', NULL, 5, NULL, NULL, NULL, '2022-06-02 06:19:24', '2022-06-02 06:19:24'),
(95, 'Trip Order #35', 'New reservation for trip #35, please click to check more details.', 'http://localhost/qbus/provider/tripOrders/35', 'ti-shopping-cart', 'info', 'provider', NULL, NULL, 1, NULL, NULL, '2022-06-02 06:30:12', '2022-06-02 06:30:12'),
(96, 'Trip Order #35', 'Your order is created successfully for trip #35, please click to check more details.', 'http://localhost/qbus/tripOrders/35', 'ti-shopping-cart', 'info', 'user', NULL, 5, NULL, NULL, NULL, '2022-06-02 06:30:12', '2022-06-02 06:30:12'),
(97, 'Trip Order #36', 'New reservation for trip #40, please click to check more details.', 'http://localhost/qbus/provider/tripOrders/36', 'ti-shopping-cart', 'info', 'provider', NULL, NULL, 1, NULL, NULL, '2022-06-02 06:30:51', '2022-06-02 06:30:51'),
(98, 'Trip Order #36', 'Your order is created successfully for trip #40, please click to check more details.', 'http://localhost/qbus/tripOrders/36', 'ti-shopping-cart', 'info', 'user', NULL, 5, NULL, NULL, NULL, '2022-06-02 06:30:51', '2022-06-02 06:30:51'),
(99, 'Trip Order #37', 'New reservation for trip #35, please click to check more details.', 'http://localhost/qbus/provider/tripOrders/37', 'ti-shopping-cart', 'info', 'provider', NULL, NULL, 1, NULL, NULL, '2022-06-02 06:31:45', '2022-06-02 06:31:45'),
(100, 'Trip Order #37', 'Your order is created successfully for trip #35, please click to check more details.', 'http://localhost/qbus/tripOrders/37', 'ti-shopping-cart', 'info', 'user', NULL, 5, NULL, NULL, NULL, '2022-06-02 06:31:45', '2022-06-02 06:31:45'),
(101, 'Trip Order #38', 'New reservation for trip #35, please click to check more details.', 'http://localhost/qbus/provider/tripOrders/38', 'ti-shopping-cart', 'info', 'provider', NULL, NULL, 1, NULL, NULL, '2022-06-02 06:33:38', '2022-06-02 06:33:38'),
(102, 'Trip Order #38', 'Your order is created successfully for trip #35, please click to check more details.', 'http://localhost/qbus/tripOrders/38', 'ti-shopping-cart', 'info', 'user', NULL, 5, NULL, NULL, NULL, '2022-06-02 06:33:38', '2022-06-02 06:33:38'),
(103, 'Trip Order #39', 'New reservation for trip #35, please click to check more details.', 'http://localhost/qbus/provider/tripOrders/39', 'ti-shopping-cart', 'info', 'provider', NULL, NULL, 1, NULL, NULL, '2022-06-02 06:34:47', '2022-06-02 06:34:47'),
(104, 'Trip Order #39', 'Your order is created successfully for trip #35, please click to check more details.', 'http://localhost/qbus/tripOrders/39', 'ti-shopping-cart', 'info', 'user', NULL, 5, NULL, NULL, NULL, '2022-06-02 06:34:47', '2022-06-02 06:34:47'),
(105, 'Trip Order #40', 'New reservation for trip #35, please click to check more details.', 'http://localhost/qbus/provider/tripOrders/40', 'ti-shopping-cart', 'info', 'provider', NULL, NULL, 1, NULL, NULL, '2022-06-02 06:35:25', '2022-06-02 06:35:25'),
(106, 'Trip Order #40', 'Your order is created successfully for trip #35, please click to check more details.', 'http://localhost/qbus/tripOrders/40', 'ti-shopping-cart', 'info', 'user', NULL, 5, NULL, NULL, NULL, '2022-06-02 06:35:25', '2022-06-02 06:35:25'),
(107, 'Trip Order #41', 'New reservation for trip #35, please click to check more details.', 'http://localhost/qbus/provider/tripOrders/41', 'ti-shopping-cart', 'info', 'provider', NULL, NULL, 1, NULL, NULL, '2022-06-02 06:35:56', '2022-06-02 06:35:56'),
(108, 'Trip Order #41', 'Your order is created successfully for trip #35, please click to check more details.', 'http://localhost/qbus/tripOrders/41', 'ti-shopping-cart', 'info', 'user', NULL, 5, NULL, NULL, NULL, '2022-06-02 06:35:56', '2022-06-02 06:35:56'),
(109, 'Trip Order #42', 'New reservation for trip #35, please click to check more details.', 'http://localhost/qbus/provider/tripOrders/42', 'ti-shopping-cart', 'info', 'provider', NULL, NULL, 1, NULL, NULL, '2022-06-02 06:38:20', '2022-06-02 06:38:20'),
(110, 'Trip Order #42', 'Your order is created successfully for trip #35, please click to check more details.', 'http://localhost/qbus/tripOrders/42', 'ti-shopping-cart', 'info', 'user', NULL, 5, NULL, NULL, NULL, '2022-06-02 06:38:20', '2022-06-02 06:38:20'),
(111, 'Trip Order #43', 'New reservation for trip #35, please click to check more details.', 'http://localhost/qbus/provider/tripOrders/43', 'ti-shopping-cart', 'info', 'provider', NULL, NULL, 1, NULL, NULL, '2022-06-02 06:39:30', '2022-06-02 06:39:30'),
(112, 'Trip Order #43', 'Your order is created successfully for trip #35, please click to check more details.', 'http://localhost/qbus/tripOrders/43', 'ti-shopping-cart', 'info', 'user', NULL, 5, NULL, NULL, NULL, '2022-06-02 06:39:30', '2022-06-02 06:39:30'),
(113, 'Trip Order #44', 'New reservation for trip #35, please click to check more details.', 'http://localhost/qbus/provider/tripOrders/44', 'ti-shopping-cart', 'info', 'provider', NULL, NULL, 1, NULL, NULL, '2022-06-02 06:39:55', '2022-06-02 06:39:55'),
(114, 'Trip Order #44', 'Your order is created successfully for trip #35, please click to check more details.', 'http://localhost/qbus/tripOrders/44', 'ti-shopping-cart', 'info', 'user', NULL, 5, NULL, NULL, NULL, '2022-06-02 06:39:55', '2022-06-02 06:39:55'),
(115, 'Trip Order #45', 'New reservation for trip #35, please click to check more details.', 'http://localhost/qbus/provider/tripOrders/45', 'ti-shopping-cart', 'info', 'provider', NULL, NULL, 1, NULL, NULL, '2022-06-02 06:40:05', '2022-06-02 06:40:05'),
(116, 'Trip Order #45', 'Your order is created successfully for trip #35, please click to check more details.', 'http://localhost/qbus/tripOrders/45', 'ti-shopping-cart', 'info', 'user', NULL, 5, NULL, NULL, NULL, '2022-06-02 06:40:05', '2022-06-02 06:40:05'),
(117, 'Trip Order #46', 'New reservation for trip #35, please click to check more details.', 'http://localhost/qbus/provider/tripOrders/46', 'ti-shopping-cart', 'info', 'provider', NULL, NULL, 1, NULL, NULL, '2022-06-02 06:40:37', '2022-06-02 06:40:37'),
(118, 'Trip Order #46', 'Your order is created successfully for trip #35, please click to check more details.', 'http://localhost/qbus/tripOrders/46', 'ti-shopping-cart', 'info', 'user', NULL, 5, NULL, NULL, NULL, '2022-06-02 06:40:37', '2022-06-02 06:40:37'),
(119, 'Trip Order #47', 'New reservation for trip #35, please click to check more details.', 'http://localhost/qbus/provider/tripOrders/47', 'ti-shopping-cart', 'info', 'provider', NULL, NULL, 1, NULL, NULL, '2022-06-02 06:41:24', '2022-06-02 06:41:24'),
(120, 'Trip Order #47', 'Your order is created successfully for trip #35, please click to check more details.', 'http://localhost/qbus/tripOrders/47', 'ti-shopping-cart', 'info', 'user', NULL, 5, NULL, NULL, NULL, '2022-06-02 06:41:24', '2022-06-02 06:41:24'),
(121, 'Trip Order #48', 'New reservation for trip #35, please click to check more details.', 'http://localhost/qbus/provider/tripOrders/48', 'ti-shopping-cart', 'info', 'provider', NULL, NULL, 1, NULL, NULL, '2022-06-02 06:42:24', '2022-06-02 06:42:24'),
(122, 'Trip Order #48', 'Your order is created successfully for trip #35, please click to check more details.', 'http://localhost/qbus/tripOrders/48', 'ti-shopping-cart', 'info', 'user', NULL, 5, NULL, NULL, NULL, '2022-06-02 06:42:24', '2022-06-02 06:42:24'),
(123, 'Trip Order #49', 'New reservation for trip #35, please click to check more details.', 'http://localhost/qbus/provider/tripOrders/49', 'ti-shopping-cart', 'info', 'provider', NULL, NULL, 1, NULL, NULL, '2022-06-02 06:43:20', '2022-06-02 06:43:20'),
(124, 'Trip Order #49', 'Your order is created successfully for trip #35, please click to check more details.', 'http://localhost/qbus/tripOrders/49', 'ti-shopping-cart', 'info', 'user', NULL, 5, NULL, NULL, NULL, '2022-06-02 06:43:20', '2022-06-02 06:43:20'),
(125, 'Trip Order #50', 'New reservation for trip #35, please click to check more details.', 'http://localhost/qbus/provider/tripOrders/50', 'ti-shopping-cart', 'info', 'provider', NULL, NULL, 1, NULL, NULL, '2022-06-02 06:44:07', '2022-06-02 06:44:07'),
(126, 'Trip Order #50', 'Your order is created successfully for trip #35, please click to check more details.', 'http://localhost/qbus/tripOrders/50', 'ti-shopping-cart', 'info', 'user', NULL, 5, NULL, NULL, NULL, '2022-06-02 06:44:07', '2022-06-02 06:44:07'),
(127, 'Trip Order #51', 'New reservation for trip #35, please click to check more details.', 'http://localhost/qbus/provider/tripOrders/51', 'ti-shopping-cart', 'info', 'provider', NULL, NULL, 1, NULL, NULL, '2022-06-02 06:46:04', '2022-06-02 06:46:04'),
(128, 'Trip Order #51', 'Your order is created successfully for trip #35, please click to check more details.', 'http://localhost/qbus/tripOrders/51', 'ti-shopping-cart', 'info', 'user', NULL, 5, NULL, NULL, NULL, '2022-06-02 06:46:04', '2022-06-02 06:46:04'),
(129, 'Trip Order #52', 'New reservation for trip #35, please click to check more details.', 'http://localhost/qbus/provider/tripOrders/52', 'ti-shopping-cart', 'info', 'provider', NULL, NULL, 1, NULL, NULL, '2022-06-03 11:02:52', '2022-06-03 11:02:52'),
(130, 'Trip Order #52', 'Your order is created successfully for trip #35, please click to check more details.', 'http://localhost/qbus/tripOrders/52', 'ti-shopping-cart', 'info', 'user', NULL, 5, NULL, NULL, NULL, '2022-06-03 11:02:52', '2022-06-03 11:02:52'),
(131, 'Trip Order #53', 'New reservation for trip #35, please click to check more details.', 'http://localhost/qbus/provider/tripOrders/53', 'ti-shopping-cart', 'info', 'provider', NULL, NULL, 1, NULL, NULL, '2022-06-03 11:02:58', '2022-06-03 11:02:58'),
(132, 'Trip Order #53', 'Your order is created successfully for trip #35, please click to check more details.', 'http://localhost/qbus/tripOrders/53', 'ti-shopping-cart', 'info', 'user', NULL, 5, NULL, NULL, NULL, '2022-06-03 11:02:58', '2022-06-03 11:02:58'),
(133, 'Trip Order #54', 'New reservation for trip #35, please click to check more details.', 'http://localhost/qbus/provider/tripOrders/54', 'ti-shopping-cart', 'info', 'provider', NULL, NULL, 1, NULL, NULL, '2022-06-03 11:06:16', '2022-06-03 11:06:16'),
(134, 'Trip Order #54', 'Your order is created successfully for trip #35, please click to check more details.', 'http://localhost/qbus/tripOrders/54', 'ti-shopping-cart', 'info', 'user', NULL, 5, NULL, NULL, NULL, '2022-06-03 11:06:16', '2022-06-03 11:06:16'),
(135, 'Trip Order #55', 'New reservation for trip #35, please click to check more details.', 'http://localhost/qbus/provider/tripOrders/55', 'ti-shopping-cart', 'info', 'provider', NULL, NULL, 1, NULL, NULL, '2022-06-03 12:08:21', '2022-06-03 12:08:21'),
(136, 'Trip Order #55', 'Your order is created successfully for trip #35, please click to check more details.', 'http://localhost/qbus/tripOrders/55', 'ti-shopping-cart', 'info', 'user', NULL, 5, NULL, NULL, NULL, '2022-06-03 12:08:21', '2022-06-03 12:08:21'),
(137, 'Trip Order #56', 'New reservation for trip #35, please click to check more details.', 'http://localhost/qbus/provider/tripOrders/56', 'ti-shopping-cart', 'info', 'provider', NULL, NULL, 1, NULL, NULL, '2022-06-03 12:15:57', '2022-06-03 12:15:57'),
(138, 'Trip Order #56', 'Your order is created successfully for trip #35, please click to check more details.', 'http://localhost/qbus/tripOrders/56', 'ti-shopping-cart', 'info', 'user', NULL, 5, NULL, NULL, NULL, '2022-06-03 12:15:57', '2022-06-03 12:15:57'),
(139, 'Trip Order #57', 'New reservation for trip #35, please click to check more details.', 'http://localhost/qbus/provider/tripOrders/57', 'ti-shopping-cart', 'info', 'provider', NULL, NULL, 1, NULL, NULL, '2022-06-03 12:16:31', '2022-06-03 12:16:31'),
(140, 'Trip Order #57', 'Your order is created successfully for trip #35, please click to check more details.', 'http://localhost/qbus/tripOrders/57', 'ti-shopping-cart', 'info', 'user', NULL, 5, NULL, NULL, NULL, '2022-06-03 12:16:31', '2022-06-03 12:16:31'),
(141, 'Trip Order #58', 'New reservation for trip #35, please click to check more details.', 'http://localhost/qbus/provider/tripOrders/58', 'ti-shopping-cart', 'info', 'provider', NULL, NULL, 1, NULL, NULL, '2022-06-03 12:16:58', '2022-06-03 12:16:58'),
(142, 'Trip Order #58', 'Your order is created successfully for trip #35, please click to check more details.', 'http://localhost/qbus/tripOrders/58', 'ti-shopping-cart', 'info', 'user', NULL, 5, NULL, NULL, NULL, '2022-06-03 12:16:58', '2022-06-03 12:16:58'),
(143, 'Trip Order #59', 'New reservation for trip #35, please click to check more details.', 'http://localhost/qbus/provider/tripOrders/59', 'ti-shopping-cart', 'info', 'provider', NULL, NULL, 1, NULL, NULL, '2022-06-03 12:23:18', '2022-06-03 12:23:18'),
(144, 'Trip Order #59', 'Your order is created successfully for trip #35, please click to check more details.', 'http://localhost/qbus/tripOrders/59', 'ti-shopping-cart', 'info', 'user', NULL, 5, NULL, NULL, NULL, '2022-06-03 12:23:18', '2022-06-03 12:23:18'),
(145, 'Trip Order #60', 'New reservation for trip #35, please click to check more details.', 'http://localhost/qbus/provider/tripOrders/60', 'ti-shopping-cart', 'info', 'provider', NULL, NULL, 1, NULL, NULL, '2022-06-03 12:24:42', '2022-06-03 12:24:42'),
(146, 'Trip Order #60', 'Your order is created successfully for trip #35, please click to check more details.', 'http://localhost/qbus/tripOrders/60', 'ti-shopping-cart', 'info', 'user', NULL, 5, NULL, NULL, NULL, '2022-06-03 12:24:42', '2022-06-03 12:24:42'),
(147, 'Trip Order #61', 'New reservation for trip #35, please click to check more details.', 'http://localhost/qbus/provider/tripOrders/61', 'ti-shopping-cart', 'info', 'provider', NULL, NULL, 1, NULL, NULL, '2022-06-03 12:25:01', '2022-06-03 12:25:01'),
(148, 'Trip Order #61', 'Your order is created successfully for trip #35, please click to check more details.', 'http://localhost/qbus/tripOrders/61', 'ti-shopping-cart', 'info', 'user', NULL, 5, NULL, NULL, NULL, '2022-06-03 12:25:01', '2022-06-03 12:25:01'),
(149, 'Trip Order #62', 'New reservation for trip #35, please click to check more details.', 'http://localhost/qbus/provider/tripOrders/62', 'ti-shopping-cart', 'info', 'provider', NULL, NULL, 1, NULL, NULL, '2022-06-03 12:25:39', '2022-06-03 12:25:39'),
(150, 'Trip Order #62', 'Your order is created successfully for trip #35, please click to check more details.', 'http://localhost/qbus/tripOrders/62', 'ti-shopping-cart', 'info', 'user', NULL, 5, NULL, NULL, NULL, '2022-06-03 12:25:39', '2022-06-03 12:25:39'),
(151, 'Trip Order #63', 'New reservation for trip #35, please click to check more details.', 'http://localhost/qbus/provider/tripOrders/63', 'ti-shopping-cart', 'info', 'provider', NULL, NULL, 1, NULL, NULL, '2022-06-03 12:26:02', '2022-06-03 12:26:02'),
(152, 'Trip Order #63', 'Your order is created successfully for trip #35, please click to check more details.', 'http://localhost/qbus/tripOrders/63', 'ti-shopping-cart', 'info', 'user', NULL, 5, NULL, NULL, NULL, '2022-06-03 12:26:02', '2022-06-03 12:26:02'),
(153, 'Trip Order #64', 'New reservation for trip #35, please click to check more details.', 'http://localhost/qbus/provider/tripOrders/64', 'ti-shopping-cart', 'info', 'provider', NULL, NULL, 1, NULL, NULL, '2022-06-03 12:51:40', '2022-06-03 12:51:40'),
(154, 'Trip Order #64', 'Your order is created successfully for trip #35, please click to check more details.', 'http://localhost/qbus/tripOrders/64', 'ti-shopping-cart', 'info', 'user', NULL, 5, NULL, NULL, NULL, '2022-06-03 12:51:40', '2022-06-03 12:51:40'),
(155, 'Trip Order #65', 'New reservation for trip #35, please click to check more details.', 'http://localhost/qbus/provider/tripOrders/65', 'ti-shopping-cart', 'info', 'provider', NULL, NULL, 1, NULL, NULL, '2022-06-03 12:54:24', '2022-06-03 12:54:24'),
(156, 'Trip Order #65', 'Your order is created successfully for trip #35, please click to check more details.', 'http://localhost/qbus/tripOrders/65', 'ti-shopping-cart', 'info', 'user', NULL, 5, NULL, NULL, NULL, '2022-06-03 12:54:24', '2022-06-03 12:54:24'),
(157, 'Trip Order #66', 'New reservation for trip #35, please click to check more details.', 'http://localhost/qbus/provider/tripOrders/66', 'ti-shopping-cart', 'info', 'provider', NULL, NULL, 1, NULL, NULL, '2022-06-04 06:02:38', '2022-06-04 06:02:38'),
(158, 'Trip Order #66', 'Your order is created successfully for trip #35, please click to check more details.', 'http://localhost/qbus/tripOrders/66', 'ti-shopping-cart', 'info', 'user', NULL, 5, NULL, NULL, NULL, '2022-06-04 06:02:38', '2022-06-04 06:02:38'),
(159, 'Trip Order #67', 'New reservation for trip #35, please click to check more details.', 'http://localhost/qbus/provider/tripOrders/67', 'ti-shopping-cart', 'info', 'provider', NULL, NULL, 1, NULL, NULL, '2022-06-04 06:05:45', '2022-06-04 06:05:45'),
(160, 'Trip Order #67', 'Your order is created successfully for trip #35, please click to check more details.', 'http://localhost/qbus/tripOrders/67', 'ti-shopping-cart', 'info', 'user', NULL, 5, NULL, NULL, NULL, '2022-06-04 06:05:45', '2022-06-04 06:05:45'),
(161, 'Trip Order #68', 'New reservation for trip #35, please click to check more details.', 'http://localhost/qbus/provider/tripOrders/68', 'ti-shopping-cart', 'info', 'provider', NULL, NULL, 1, NULL, NULL, '2022-06-04 06:10:44', '2022-06-04 06:10:44'),
(162, 'Trip Order #68', 'Your order is created successfully for trip #35, please click to check more details.', 'http://localhost/qbus/tripOrders/68', 'ti-shopping-cart', 'info', 'user', NULL, 5, NULL, NULL, NULL, '2022-06-04 06:10:44', '2022-06-04 06:10:44'),
(163, 'Trip Order #69', 'New reservation for trip #35, please click to check more details.', 'http://localhost/qbus/provider/tripOrders/69', 'ti-shopping-cart', 'info', 'provider', NULL, NULL, 1, NULL, NULL, '2022-06-04 06:26:18', '2022-06-04 06:26:18'),
(164, 'Trip Order #69', 'Your order is created successfully for trip #35, please click to check more details.', 'http://localhost/qbus/tripOrders/69', 'ti-shopping-cart', 'info', 'user', NULL, 5, NULL, NULL, NULL, '2022-06-04 06:26:18', '2022-06-04 06:26:18'),
(165, 'Trip Order #70', 'New reservation for trip #35, please click to check more details.', 'http://localhost/qbus/provider/tripOrders/70', 'ti-shopping-cart', 'info', 'provider', NULL, NULL, 1, NULL, NULL, '2022-06-04 06:26:51', '2022-06-04 06:26:51'),
(166, 'Trip Order #70', 'Your order is created successfully for trip #35, please click to check more details.', 'http://localhost/qbus/tripOrders/70', 'ti-shopping-cart', 'info', 'user', NULL, 5, NULL, NULL, NULL, '2022-06-04 06:26:51', '2022-06-04 06:26:51'),
(167, 'Trip Order #71', 'New reservation for trip #35, please click to check more details.', 'http://localhost/qbus/provider/tripOrders/71', 'ti-shopping-cart', 'info', 'provider', NULL, NULL, 1, NULL, NULL, '2022-06-04 06:37:33', '2022-06-04 06:37:33'),
(168, 'Trip Order #71', 'Your order is created successfully for trip #35, please click to check more details.', 'http://localhost/qbus/tripOrders/71', 'ti-shopping-cart', 'info', 'user', NULL, 5, NULL, NULL, NULL, '2022-06-04 06:37:33', '2022-06-04 06:37:33'),
(169, 'Trip Order #72', 'New reservation for trip #35, please click to check more details.', 'http://localhost/qbus/provider/tripOrders/72', 'ti-shopping-cart', 'info', 'provider', NULL, NULL, 1, NULL, NULL, '2022-06-04 06:38:17', '2022-06-04 06:38:17'),
(170, 'Trip Order #72', 'Your order is created successfully for trip #35, please click to check more details.', 'http://localhost/qbus/tripOrders/72', 'ti-shopping-cart', 'info', 'user', NULL, 5, NULL, NULL, NULL, '2022-06-04 06:38:17', '2022-06-04 06:38:17'),
(171, 'Trip Order #73', 'New reservation for trip #35, please click to check more details.', 'http://localhost/qbus/provider/tripOrders/73', 'ti-shopping-cart', 'info', 'provider', NULL, NULL, 1, NULL, NULL, '2022-06-04 06:43:44', '2022-06-04 06:43:44'),
(172, 'Trip Order #73', 'Your order is created successfully for trip #35, please click to check more details.', 'http://localhost/qbus/tripOrders/73', 'ti-shopping-cart', 'info', 'user', NULL, 5, NULL, NULL, NULL, '2022-06-04 06:43:44', '2022-06-04 06:43:44'),
(173, 'Trip Order #74', 'New reservation for trip #35, please click to check more details.', 'http://localhost/qbus/provider/tripOrders/74', 'ti-shopping-cart', 'info', 'provider', NULL, NULL, 1, NULL, NULL, '2022-06-04 06:44:37', '2022-06-04 06:44:37'),
(174, 'Trip Order #74', 'Your order is created successfully for trip #35, please click to check more details.', 'http://localhost/qbus/tripOrders/74', 'ti-shopping-cart', 'info', 'user', NULL, 5, NULL, NULL, NULL, '2022-06-04 06:44:37', '2022-06-04 06:44:37'),
(175, 'Trip Order #75', 'New reservation for trip #35, please click to check more details.', 'http://localhost/qbus/provider/tripOrders/75', 'ti-shopping-cart', 'info', 'provider', NULL, NULL, 1, NULL, NULL, '2022-06-04 06:45:40', '2022-06-04 06:45:40'),
(176, 'Trip Order #75', 'Your order is created successfully for trip #35, please click to check more details.', 'http://localhost/qbus/tripOrders/75', 'ti-shopping-cart', 'info', 'user', NULL, 5, NULL, NULL, NULL, '2022-06-04 06:45:40', '2022-06-04 06:45:40'),
(177, 'Trip Order #76', 'New reservation for trip #35, please click to check more details.', 'http://localhost/qbus/provider/tripOrders/76', 'ti-shopping-cart', 'info', 'provider', NULL, NULL, 1, NULL, NULL, '2022-06-04 06:46:38', '2022-06-04 06:46:38'),
(178, 'Trip Order #76', 'Your order is created successfully for trip #35, please click to check more details.', 'http://localhost/qbus/tripOrders/76', 'ti-shopping-cart', 'info', 'user', NULL, 5, NULL, NULL, NULL, '2022-06-04 06:46:38', '2022-06-04 06:46:38'),
(179, 'Trip Order #77', 'New reservation for trip #35, please click to check more details.', 'http://localhost/qbus/provider/tripOrders/77', 'ti-shopping-cart', 'info', 'provider', NULL, NULL, 1, NULL, NULL, '2022-06-04 06:49:35', '2022-06-04 06:49:35'),
(180, 'Trip Order #77', 'Your order is created successfully for trip #35, please click to check more details.', 'http://localhost/qbus/tripOrders/77', 'ti-shopping-cart', 'info', 'user', NULL, 5, NULL, NULL, NULL, '2022-06-04 06:49:36', '2022-06-04 06:49:36'),
(181, 'Trip Order #78', 'New reservation for trip #35, please click to check more details.', 'http://localhost/qbus/provider/tripOrders/78', 'ti-shopping-cart', 'info', 'provider', NULL, NULL, 1, NULL, NULL, '2022-06-04 06:50:08', '2022-06-04 06:50:08'),
(182, 'Trip Order #78', 'Your order is created successfully for trip #35, please click to check more details.', 'http://localhost/qbus/tripOrders/78', 'ti-shopping-cart', 'info', 'user', NULL, 5, NULL, NULL, NULL, '2022-06-04 06:50:08', '2022-06-04 06:50:08'),
(183, 'Trip Order #79', 'New reservation for trip #35, please click to check more details.', 'http://localhost/qbus/provider/tripOrders/79', 'ti-shopping-cart', 'info', 'provider', NULL, NULL, 1, NULL, NULL, '2022-06-04 06:51:33', '2022-06-04 06:51:33'),
(184, 'Trip Order #79', 'Your order is created successfully for trip #35, please click to check more details.', 'http://localhost/qbus/tripOrders/79', 'ti-shopping-cart', 'info', 'user', NULL, 5, NULL, NULL, NULL, '2022-06-04 06:51:33', '2022-06-04 06:51:33'),
(185, 'Trip Order #80', 'New reservation for trip #35, please click to check more details.', 'http://localhost/qbus/provider/tripOrders/80', 'ti-shopping-cart', 'info', 'provider', NULL, NULL, 1, NULL, NULL, '2022-06-04 06:53:54', '2022-06-04 06:53:54'),
(186, 'Trip Order #80', 'Your order is created successfully for trip #35, please click to check more details.', 'http://localhost/qbus/tripOrders/80', 'ti-shopping-cart', 'info', 'user', NULL, 5, NULL, NULL, NULL, '2022-06-04 06:53:54', '2022-06-04 06:53:54'),
(187, 'Trip Order #81', 'New reservation for trip #35, please click to check more details.', 'http://localhost/qbus/provider/tripOrders/81', 'ti-shopping-cart', 'info', 'provider', NULL, NULL, 1, NULL, NULL, '2022-06-04 06:57:40', '2022-06-04 06:57:40'),
(188, 'Trip Order #81', 'Your order is created successfully for trip #35, please click to check more details.', 'http://localhost/qbus/tripOrders/81', 'ti-shopping-cart', 'info', 'user', NULL, 5, NULL, NULL, NULL, '2022-06-04 06:57:40', '2022-06-04 06:57:40'),
(189, 'Trip Order #82', 'New reservation for trip #35, please click to check more details.', 'http://localhost/qbus/provider/tripOrders/82', 'ti-shopping-cart', 'info', 'provider', NULL, NULL, 1, NULL, NULL, '2022-06-04 06:58:10', '2022-06-04 06:58:10'),
(190, 'Trip Order #82', 'Your order is created successfully for trip #35, please click to check more details.', 'http://localhost/qbus/tripOrders/82', 'ti-shopping-cart', 'info', 'user', NULL, 5, NULL, NULL, NULL, '2022-06-04 06:58:10', '2022-06-04 06:58:10'),
(191, 'Trip Order #83', 'New reservation for trip #38, please click to check more details.', 'http://localhost/qbus/provider/tripOrders/83', 'ti-shopping-cart', 'info', 'provider', NULL, NULL, 1, NULL, NULL, '2022-06-04 07:04:54', '2022-06-04 07:04:54'),
(192, 'Trip Order #83', 'Your order is created successfully for trip #38, please click to check more details.', 'http://localhost/qbus/tripOrders/83', 'ti-shopping-cart', 'info', 'user', NULL, 5, NULL, NULL, NULL, '2022-06-04 07:04:54', '2022-06-04 07:04:54'),
(193, 'Trip Order #84', 'New reservation for trip #35, please click to check more details.', 'http://localhost/qbus/provider/tripOrders/84', 'ti-shopping-cart', 'info', 'provider', NULL, NULL, 1, NULL, NULL, '2022-06-04 07:05:40', '2022-06-04 07:05:40'),
(194, 'Trip Order #84', 'Your order is created successfully for trip #35, please click to check more details.', 'http://localhost/qbus/tripOrders/84', 'ti-shopping-cart', 'info', 'user', NULL, 5, NULL, NULL, NULL, '2022-06-04 07:05:40', '2022-06-04 07:05:40');
INSERT INTO `notifications` (`id`, `title`, `text`, `url`, `icon`, `type`, `to`, `admin_id`, `user_id`, `provider_id`, `account_id`, `read_at`, `created_at`, `updated_at`) VALUES
(195, 'Trip Order #85', 'New reservation for trip #35, please click to check more details.', 'http://localhost/qbus/provider/tripOrders/85', 'ti-shopping-cart', 'info', 'provider', NULL, NULL, 1, NULL, NULL, '2022-06-04 07:09:30', '2022-06-04 07:09:30'),
(196, 'Trip Order #85', 'Your order is created successfully for trip #35, please click to check more details.', 'http://localhost/qbus/tripOrders/85', 'ti-shopping-cart', 'info', 'user', NULL, 5, NULL, NULL, NULL, '2022-06-04 07:09:30', '2022-06-04 07:09:30'),
(197, 'Trip Order #86', 'New reservation for trip #38, please click to check more details.', 'http://localhost/qbus/provider/tripOrders/86', 'ti-shopping-cart', 'info', 'provider', NULL, NULL, 1, NULL, NULL, '2022-06-04 07:10:26', '2022-06-04 07:10:26'),
(198, 'Trip Order #86', 'Your order is created successfully for trip #38, please click to check more details.', 'http://localhost/qbus/tripOrders/86', 'ti-shopping-cart', 'info', 'user', NULL, 5, NULL, NULL, NULL, '2022-06-04 07:10:26', '2022-06-04 07:10:26'),
(199, 'Trip Order #87', 'New reservation for trip #38, please click to check more details.', 'http://localhost/qbus/provider/tripOrders/87', 'ti-shopping-cart', 'info', 'provider', NULL, NULL, 1, NULL, NULL, '2022-06-04 07:11:07', '2022-06-04 07:11:07'),
(200, 'Trip Order #87', 'Your order is created successfully for trip #38, please click to check more details.', 'http://localhost/qbus/tripOrders/87', 'ti-shopping-cart', 'info', 'user', NULL, 5, NULL, NULL, NULL, '2022-06-04 07:11:07', '2022-06-04 07:11:07'),
(201, 'Trip Order #88', 'New reservation for trip #38, please click to check more details.', 'http://localhost/qbus/provider/tripOrders/88', 'ti-shopping-cart', 'info', 'provider', NULL, NULL, 1, NULL, NULL, '2022-06-04 07:12:37', '2022-06-04 07:12:37'),
(202, 'Trip Order #88', 'Your order is created successfully for trip #38, please click to check more details.', 'http://localhost/qbus/tripOrders/88', 'ti-shopping-cart', 'info', 'user', NULL, 5, NULL, NULL, NULL, '2022-06-04 07:12:37', '2022-06-04 07:12:37'),
(203, 'Trip Order #89', 'New reservation for trip #35, please click to check more details.', 'http://localhost/qbus/provider/tripOrders/89', 'ti-shopping-cart', 'info', 'provider', NULL, NULL, 1, NULL, NULL, '2022-06-04 07:13:09', '2022-06-04 07:13:09'),
(204, 'Trip Order #89', 'Your order is created successfully for trip #35, please click to check more details.', 'http://localhost/qbus/tripOrders/89', 'ti-shopping-cart', 'info', 'user', NULL, 5, NULL, NULL, NULL, '2022-06-04 07:13:09', '2022-06-04 07:13:09'),
(205, 'Trip Order #90', 'New reservation for trip #35, please click to check more details.', 'http://localhost/qbus/provider/tripOrders/90', 'ti-shopping-cart', 'info', 'provider', NULL, NULL, 1, NULL, NULL, '2022-06-04 07:17:40', '2022-06-04 07:17:40'),
(206, 'Trip Order #90', 'Your order is created successfully for trip #35, please click to check more details.', 'http://localhost/qbus/tripOrders/90', 'ti-shopping-cart', 'info', 'user', NULL, 5, NULL, NULL, NULL, '2022-06-04 07:17:40', '2022-06-04 07:17:40'),
(207, 'Trip Order #91', 'New reservation for trip #38, please click to check more details.', 'http://localhost/qbus/provider/tripOrders/91', 'ti-shopping-cart', 'info', 'provider', NULL, NULL, 1, NULL, NULL, '2022-06-04 07:18:23', '2022-06-04 07:18:23'),
(208, 'Trip Order #91', 'Your order is created successfully for trip #38, please click to check more details.', 'http://localhost/qbus/tripOrders/91', 'ti-shopping-cart', 'info', 'user', NULL, 5, NULL, NULL, NULL, '2022-06-04 07:18:23', '2022-06-04 07:18:23');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('001577ace96c0a4d029d359728398cc7733ffd1522b81e8d4df972a5dd03d568d2047d8cefafd3f9', 5, 1, 'Qbus', '[]', 0, '2022-05-27 11:23:50', '2022-05-27 11:23:50', '2023-05-27 13:23:50'),
('02e03aa3fb2a70705c7e4c660cf022df512ebc04387ab4fa949cd8870be76a41ac55d76c975b72a4', 5, 1, 'Qbus', '[]', 0, '2022-05-27 10:59:37', '2022-05-27 10:59:37', '2023-05-27 12:59:37'),
('0351678fd6591dfaed32a2c305241755d046b63d5358ee1c58ecff4400f46796eee9b5e4476f6a7e', 5, 1, 'Qbus', '[]', 0, '2022-05-27 12:12:28', '2022-05-27 12:12:28', '2023-05-27 14:12:28'),
('03f30474d58810caa4eafa607f4b166661f33fa453a2a52c115871584fba8489a2b5fcafa23aef55', 5, 1, 'Qbus', '[]', 0, '2022-05-27 11:32:05', '2022-05-27 11:32:05', '2023-05-27 13:32:05'),
('040d7368978dbd7ff13083537d6b04aa002b7f0e7821ae5e6567f9dc15881378f3809d1c38e4dea8', 5, 1, 'Qbus', '[]', 0, '2022-05-27 11:04:32', '2022-05-27 11:04:32', '2023-05-27 13:04:32'),
('04f2116e4b4b5fd7c4144ce1e0273b964162cb7a387c0c241168342c686d0e372695af1263d00eb9', 5, 1, 'Qbus', '[]', 0, '2022-05-27 11:34:07', '2022-05-27 11:34:07', '2023-05-27 13:34:07'),
('0591d83f39642c79ebb8b68fa6b9e462d089fa1c1e0e4bc18694a631597a9a1786d0f5d8e349bfce', 5, 1, 'Qbus', '[]', 1, '2022-06-01 08:25:39', '2022-06-01 08:25:39', '2023-06-01 10:25:39'),
('07bf435beedb2bb2e743be46e9fb460e716dc99724ae9e5874e7dd67fe8a51e96e9cbdcc6df8036d', 5, 1, 'Qbus', '[]', 0, '2022-05-28 10:39:45', '2022-05-28 10:39:45', '2023-05-28 12:39:45'),
('09249cc6470be19daacd67ae4fcb425772d0e088021f2f175c373dd35917e36c362ff46a4b681866', 5, 1, 'Qbus', '[]', 0, '2022-05-28 09:20:58', '2022-05-28 09:20:58', '2023-05-28 11:20:58'),
('0d064e4dcd74bea0d778ea22e0289bfecbf745dcc1608281f082c457cdbb1e44d7d7aee7672796eb', 5, 1, 'Qbus', '[]', 0, '2022-05-27 12:42:17', '2022-05-27 12:42:17', '2023-05-27 14:42:17'),
('0d25e56f44278f6dda86ec31f0b7452fa200e4533706d53cdb340180a34c3afc33235318f363616e', 5, 1, 'Qbus', '[]', 0, '2022-05-27 11:54:29', '2022-05-27 11:54:29', '2023-05-27 13:54:29'),
('0e7b017235e937d0bea4a73929eb69fe31f86585c4e633f9e491f2f247cf70d20c3a71719c6a597c', 5, 1, 'Qbus', '[]', 0, '2022-05-27 11:12:39', '2022-05-27 11:12:39', '2023-05-27 13:12:39'),
('10481e98ee25f19113a819d16f9d6bd13e20bb2703425972b80c8993d0a3f1540ee1ca432bd7d913', 43, 1, 'Qbus', '[]', 0, '2022-06-29 09:05:06', '2022-06-29 09:05:06', '2023-06-29 11:05:06'),
('111e28e07b852d1b410718b3683cca6b2c648c1bc38a21dbe4b14539fd8bcb2d35a685fceb92d625', 5, 1, 'Qbus', '[]', 0, '2022-05-27 10:02:38', '2022-05-27 10:02:38', '2023-05-27 12:02:38'),
('123ba2df35b24186e787edba60819483981f34d081c5350d465e295aabe4c9c4d523587cd424731d', 5, 1, 'Qbus', '[]', 0, '2022-05-27 15:16:32', '2022-05-27 15:16:32', '2023-05-27 17:16:32'),
('13a99af4c8e9958d3ac7355fefa080b550e43815c3d8da876ae2d651e5a0a0726b7cbb14c97bc227', 10, 1, 'Qbus', '[]', 0, '2022-05-24 09:23:07', '2022-05-24 09:23:07', '2023-05-24 11:23:07'),
('154926f2f68035fcefece60981b597459ed826f80de4f5716ad6bcb0d1643528b5a2e3727054ce79', 44, 1, 'Qbus', '[]', 0, '2022-06-29 09:06:23', '2022-06-29 09:06:23', '2023-06-29 11:06:23'),
('16b1e7dfe2d6d1ec1ac4dea06ca01ee6350bc3d3df723a2450f0753b9af43266b8d6cb9e0d210bf6', 45, 1, 'Qbus', '[]', 0, '2022-06-29 09:09:22', '2022-06-29 09:09:22', '2023-06-29 11:09:22'),
('185d9c41781e7d98f41b3f3bad6118bfb6439938bf833de69c08adbc421c7a11440a0da0deb5558d', 5, 1, 'Qbus', '[]', 0, '2022-06-01 07:24:30', '2022-06-01 07:24:30', '2023-06-01 09:24:30'),
('1921c6cd1a2d8f2ca02781527d6f1d6ae7696fb2a558db031b232e6542c6093357bdba15451dc5ea', 5, 1, 'Qbus', '[]', 0, '2022-05-27 15:15:44', '2022-05-27 15:15:44', '2023-05-27 17:15:44'),
('19deca9bcc48a5079fd087c9f34caba923dffe3f4ced876030dd1ed9a7ed6cc8e2c60425c9ef65ff', 5, 1, 'Qbus', '[]', 0, '2022-05-24 08:19:02', '2022-05-24 08:19:02', '2023-05-24 10:19:02'),
('1ab96b94ca19ba6f3ec499bddb12fa0ab6fbb07bcc18fdb65d3b2c776e445b84fc7b7ff6869c389d', 5, 1, 'Qbus', '[]', 0, '2022-05-27 09:53:29', '2022-05-27 09:53:29', '2023-05-27 11:53:29'),
('1bf2b7b76f1325ad2f2921b93a8a657cd4d3dabffdb500b0f2212867baa3bed3b7c4071a8d941141', 35, 1, 'Qbus', '[]', 0, '2022-05-28 11:00:17', '2022-05-28 11:00:17', '2023-05-28 13:00:17'),
('1c29200901b533f7f2885da9569243629a0e7df2e2fe5399755c214e5eafeb88172ccdcb8cbd0c6e', 32, 1, 'Qbus', '[]', 0, '2022-05-28 10:53:34', '2022-05-28 10:53:34', '2023-05-28 12:53:34'),
('1d392f1c67b799f227b92a90be12b07039f19db4e23a10a8829f5f5a319f607ea547370527c22b80', 5, 1, 'Qbus', '[]', 0, '2022-05-27 11:10:14', '2022-05-27 11:10:14', '2023-05-27 13:10:14'),
('1ff73be436a7418f6b54bfa9937c8b2d1cf07271023b65461458d74ea03ca3b7b5117c8d8c58535f', 2, 1, 'Qbus', '[]', 0, '2022-05-24 08:14:24', '2022-05-24 08:14:24', '2023-05-24 10:14:24'),
('2030575d8d79a8e04a8a3fee42481acab0729a5c50c624cf9bf8078e71e6f280dfdb465555d8212c', 5, 1, 'Qbus', '[]', 1, '2022-05-28 10:43:45', '2022-05-28 10:43:45', '2023-05-28 12:43:45'),
('228ccc291bf429e946b7b66159d4caccad602812864353053d3e20fcb0c34239d93f1f16f867223e', 5, 1, 'Qbus', '[]', 0, '2022-05-28 09:36:56', '2022-05-28 09:36:56', '2023-05-28 11:36:56'),
('232b26f2efbd97ac39d643b8ae1724c756ab7fa496bf374b4d13608f9d7516043c47bbee26d31282', 5, 1, 'Qbus', '[]', 0, '2022-05-27 10:04:20', '2022-05-27 10:04:20', '2023-05-27 12:04:20'),
('24f2a62ea4be9256abfb3cda940e1be5f007b5806d767ebb384df0703faa92834c6e654aeddc8728', 5, 1, 'Qbus', '[]', 0, '2022-05-27 11:33:57', '2022-05-27 11:33:57', '2023-05-27 13:33:57'),
('263ec3c28a76bd854ea3c10f9c7a16f307ed5fcf2f8de3b575ee011119df407f11daf73d62d19134', 20, 1, 'Qbus', '[]', 0, '2022-05-28 10:24:14', '2022-05-28 10:24:14', '2023-05-28 12:24:14'),
('2837c890a4679cf94da98d0a30077412ca2b3727f8546f02da3f628846d72e5772609c844739bee6', 5, 1, 'Qbus', '[]', 0, '2022-06-01 08:26:37', '2022-06-01 08:26:37', '2023-06-01 10:26:37'),
('2b05a730b7217be7872f7ffe15dd5ccfff2c68be2fa590a6e9d85515ddf964abad0ee6fd6d971a92', 5, 1, 'Qbus', '[]', 0, '2022-05-27 10:56:12', '2022-05-27 10:56:12', '2023-05-27 12:56:12'),
('2bc2e81b829ae14e7d8fa3fc3d32010135032119deb1c1a9f73710626713b02cf876267e1fc1981c', 5, 1, 'Qbus', '[]', 0, '2022-05-28 09:20:47', '2022-05-28 09:20:47', '2023-05-28 11:20:47'),
('2df4617f191361fed47dccc24ea18fd84647fc43145bab9ee10fed9fac850d422bf5fcf2fe4a47a6', 5, 1, 'Qbus', '[]', 0, '2022-05-27 10:47:40', '2022-05-27 10:47:40', '2023-05-27 12:47:40'),
('311ae61be5ed9ea8075201be54aef1a6b9ee9d78226eaadececa5ad722cfce86edc533bbb397a42c', 5, 1, 'Qbus', '[]', 0, '2022-05-28 09:34:21', '2022-05-28 09:34:21', '2023-05-28 11:34:21'),
('315896d3f1f677af72856f198189ed9d6aee92e32615853f0afcd4538a677e08bf67bddaf461a509', 5, 1, 'Qbus', '[]', 0, '2022-05-27 11:35:01', '2022-05-27 11:35:01', '2023-05-27 13:35:01'),
('328a699651b6a13bfe0dd9f48df7d4f45d8aa91be5492eb07d43d38de52f6eba29aa8c17f6b658fd', 5, 1, 'Qbus', '[]', 0, '2022-05-27 10:47:35', '2022-05-27 10:47:35', '2023-05-27 12:47:35'),
('329d75882c67ca1d26262458ee6d50ac958b52bb582c995937283f5c787a9f106db0cf64e1d9dddb', 5, 1, 'Qbus', '[]', 0, '2022-05-28 09:42:19', '2022-05-28 09:42:19', '2023-05-28 11:42:19'),
('3413655102e3b80c02b857eb0192175b49b25b719d12f15e06e4a48775dac49519261353a439be51', 5, 1, 'Qbus', '[]', 0, '2022-05-27 10:45:46', '2022-05-27 10:45:46', '2023-05-27 12:45:46'),
('34903da8874766427a4a6733eda52b8d6b78847f12c7a2c3f057a05bccb567781f598b5436eaa2a0', 5, 1, 'Qbus', '[]', 0, '2022-05-27 11:13:01', '2022-05-27 11:13:01', '2023-05-27 13:13:01'),
('365710f3e95292d0500aceb9b48bfc33a9237b9785024375c3dd51a3d71b746aaa842ad579451d2f', 5, 1, 'Qbus', '[]', 0, '2022-05-27 11:01:14', '2022-05-27 11:01:14', '2023-05-27 13:01:14'),
('36929f0ba2368206167b6d7067c5212861bc168808b969d96cb220c3ea77cbd2e272bbefd945f081', 6, 1, 'Qbus', '[]', 0, '2022-05-24 09:02:32', '2022-05-24 09:02:32', '2023-05-24 11:02:32'),
('37ad8e2bd4e65fa14754eba1e23eed07d3ba93c11e90d252ec8c3b8aef98ba62acf2e765925f93bb', 5, 1, 'Qbus', '[]', 0, '2022-05-28 09:37:06', '2022-05-28 09:37:06', '2023-05-28 11:37:06'),
('37b6eed7b399a2fdaeda7d484cfca61a7ceea1820f646ef154f35209edad5a17c77e9a10a341d621', 5, 1, 'Qbus', '[]', 0, '2022-05-28 09:41:21', '2022-05-28 09:41:21', '2023-05-28 11:41:21'),
('380346343700eeb268023da2c6940c770283cbae5bebf2ba199881f7bf07430e427d493c3b3cc4e8', 5, 1, 'Qbus', '[]', 0, '2022-05-27 10:54:02', '2022-05-27 10:54:02', '2023-05-27 12:54:02'),
('38c64cc143a92f606c6de9fba71855fb5b55d3de79b45190ae19460e396dee3297ad358baf9f8dda', 36, 1, 'Qbus', '[]', 0, '2022-05-28 11:03:40', '2022-05-28 11:03:40', '2023-05-28 13:03:40'),
('3a1ddd32e28ea4da8336311cdee65bf1b5880949b4d415c4c932901aaf4447354ecd886e92a26150', 9, 1, 'Qbus', '[]', 0, '2022-05-24 09:20:24', '2022-05-24 09:20:24', '2023-05-24 11:20:24'),
('3a2b9e9592186b376f7640fbd6fdce8885166f4e6804f513589339009045cfc8b8c150ce22fa6135', 5, 1, 'Qbus', '[]', 0, '2022-05-28 09:39:05', '2022-05-28 09:39:05', '2023-05-28 11:39:05'),
('3cc07281e431998db40a2d03541f31eaaf480c9e7bf5591284804e03b5a626bd675fb68c1768e5f8', 5, 1, 'Qbus', '[]', 1, '2022-05-24 09:44:31', '2022-05-24 09:44:31', '2023-05-24 11:44:31'),
('3ced8469ca5f47c62c307b84325b1dcd3373ec63fdce3f818a3d70b07c7c2b40dbea9c7bb225947d', 11, 1, 'Qbus', '[]', 0, '2022-05-24 09:31:15', '2022-05-24 09:31:15', '2023-05-24 11:31:15'),
('3d7b43549dc1160f349cf5a647cf03e1e8e08fe10addc6d07df2b4b90dc55de2ef3ed3bad80c452c', 5, 1, 'Qbus', '[]', 0, '2022-05-25 12:25:19', '2022-05-25 12:25:19', '2023-05-25 14:25:19'),
('3d8ec787e282fcb776cd063982a56ac78cd9afcfb1028eb5ffc9970f6a6f535b8da31506cdca7549', 5, 1, 'Qbus', '[]', 0, '2022-05-27 10:08:04', '2022-05-27 10:08:04', '2023-05-27 12:08:04'),
('3e29da61497275519a093fe24a8b6349e41d55ba351d4582be4a9bd0d1bb574a0d7508f516ac9333', 5, 1, 'Qbus', '[]', 0, '2022-05-27 10:52:06', '2022-05-27 10:52:06', '2023-05-27 12:52:06'),
('3f3f80940d1c0652e8f75207f66d9330767775840503ea52764f8d108b4c6dfaab76053c4bc79657', 5, 1, 'Qbus', '[]', 0, '2022-05-28 09:42:52', '2022-05-28 09:42:52', '2023-05-28 11:42:52'),
('3fa3130ef790f417f2c5969526dc0ea924d9be9a45dec0a029faf60ed08dd6e7684a387b00f45c25', 5, 1, 'Qbus', '[]', 0, '2022-05-28 09:44:49', '2022-05-28 09:44:49', '2023-05-28 11:44:49'),
('3ffa8a040e6d9384f2100fa56600fe10b80fd01a3eb87701d45a149b012d0ac32b8717d7a0c80b79', 15, 1, 'Qbus', '[]', 0, '2022-05-28 10:19:03', '2022-05-28 10:19:03', '2023-05-28 12:19:03'),
('42a6e176f850a8851b2927fe4c7e6f89cf2565a257a7420f8e4082bc331c5406b95319557e706a32', 5, 1, 'Qbus', '[]', 0, '2022-05-27 10:45:48', '2022-05-27 10:45:48', '2023-05-27 12:45:48'),
('4414336293f125004a8759477755903a938ef352fe164ce967f0085c718859397a86a1a4e7a1262a', 5, 1, 'Qbus', '[]', 0, '2022-05-28 09:53:15', '2022-05-28 09:53:15', '2023-05-28 11:53:15'),
('47fc8fef2dd65571bff136d6e3d7cbfa467c063f36846fc210e948c7589915f76fbcd792725d56e6', 5, 1, 'Qbus', '[]', 0, '2022-05-28 09:41:37', '2022-05-28 09:41:37', '2023-05-28 11:41:37'),
('481b2c240eb13f083f95e2e014907f49a0615e3eab07e8ba5539fc25573ebfccd34ef63bed7a3109', 5, 1, 'Qbus', '[]', 0, '2022-05-27 12:13:44', '2022-05-27 12:13:44', '2023-05-27 14:13:44'),
('49002989aba9c8d9ccd2c24f608c187dc1a3a16cc85e7c0ba83081950c1cf84f4c6b39c40248a8aa', 5, 1, 'Qbus', '[]', 0, '2022-05-28 10:00:06', '2022-05-28 10:00:06', '2023-05-28 12:00:06'),
('4f5623861b9a5e75881108f704b07fe8b9564f0a8c02ab0e6af2dac55b0481d2eb510de0de7580fb', 5, 1, 'Qbus', '[]', 0, '2022-05-28 09:38:22', '2022-05-28 09:38:22', '2023-05-28 11:38:22'),
('52d4a773900435f739b9fbc959e060730dfadc201bedb1648d75582a7c01cefb882644d25f861bf0', 31, 1, 'Qbus', '[]', 0, '2022-05-28 10:38:37', '2022-05-28 10:38:37', '2023-05-28 12:38:37'),
('52e0e92c6893ec4961aa19889175bcefac95c78b2a3d8336589a176faba3c11870ab54697f00a388', 5, 1, 'Qbus', '[]', 0, '2022-05-27 11:45:38', '2022-05-27 11:45:38', '2023-05-27 13:45:38'),
('52e35e629d1ccfdc007b35406804f69d41064335bd6c73eb8c6e55810cfb03b6466b81c485d29e83', 23, 1, 'Qbus', '[]', 0, '2022-05-28 10:28:29', '2022-05-28 10:28:29', '2023-05-28 12:28:29'),
('53181cc339c2372250082c223a83118625ae35bfcc0fe820325158f89239c1d1d0ebbf3a71f06364', 5, 1, 'Qbus', '[]', 0, '2022-05-27 08:19:48', '2022-05-27 08:19:48', '2023-05-27 10:19:48'),
('555154a94c93500ca37fc2be5d54dbbdb0b17d1834e15f38b27104635138d00d17362e3e5cc65bed', 18, 1, 'Qbus', '[]', 0, '2022-05-28 10:22:42', '2022-05-28 10:22:42', '2023-05-28 12:22:42'),
('56c81d9b245461537c8b0c86a9587427fedc033472391ffeb64c48647b03bb48977dc73bc5ac6c37', 5, 1, 'Qbus', '[]', 0, '2022-05-28 09:37:24', '2022-05-28 09:37:24', '2023-05-28 11:37:24'),
('5801b2619cce4c1ba8ce9c19e0d9b91f4dcf48e25ad359973c9cabbe90d74c3ef795037c7166bc2c', 5, 1, 'Qbus', '[]', 0, '2022-05-27 09:43:49', '2022-05-27 09:43:49', '2023-05-27 11:43:49'),
('5855f76be3c4d8a02f67a1049ffa56df8716e8c5850bb3210c64c348383f9c15033b892c8f16699e', 26, 1, 'Qbus', '[]', 0, '2022-05-28 10:31:24', '2022-05-28 10:31:24', '2023-05-28 12:31:24'),
('59e54a98f754bc9aa9b78a1b5583385f2dc52de8c12b308845c626fd7b52de427a8f19f2494033ca', 5, 1, 'Qbus', '[]', 0, '2022-05-28 09:35:58', '2022-05-28 09:35:58', '2023-05-28 11:35:58'),
('5a2a1f1edd350c4b602debb5809c03a4a70500b5acc88b5f3f751ffe3fe7be40d6b1f434d935ad08', 17, 1, 'Qbus', '[]', 0, '2022-05-28 10:20:57', '2022-05-28 10:20:57', '2023-05-28 12:20:57'),
('611a42945ee68a200c82ae2ae2c6b67e76804e715f8a6270ca43346d3a1fff98601927431a523cc5', 5, 1, 'Qbus', '[]', 0, '2022-05-27 15:13:13', '2022-05-27 15:13:13', '2023-05-27 17:13:13'),
('621cfc28260c94a88c515bdaa73070854ae938d536885354f0f25dea3087a92f26c881511531fc5f', 5, 1, 'Qbus', '[]', 0, '2022-05-27 10:17:40', '2022-05-27 10:17:40', '2023-05-27 12:17:40'),
('63298a183819445790672eec3cfbc4dc197ff3c07fcf2a8c2857f060fbf74cf1dc6d3984f1ee983a', 5, 1, 'Qbus', '[]', 0, '2022-05-27 09:58:49', '2022-05-27 09:58:49', '2023-05-27 11:58:49'),
('6451e9d5242b545c8e20defa64f9bda3532071ecdf0b8e320e3ca3277eef56ac773e00db4a0ec859', 5, 1, 'Qbus', '[]', 0, '2022-05-27 10:57:01', '2022-05-27 10:57:01', '2023-05-27 12:57:01'),
('64bebfe2c803801e82b9ae64b1dad9009e88462db7b37efb271187e31185e16a80454ee7aeb45d86', 5, 1, 'Qbus', '[]', 0, '2022-05-27 10:52:47', '2022-05-27 10:52:47', '2023-05-27 12:52:47'),
('6543691d614ca92637d14f280a844a52975d812bcaa71ed4c1f603bb897df59729ebee254480e71e', 2, 1, 'Qbus', '[]', 0, '2022-05-24 08:15:50', '2022-05-24 08:15:50', '2023-05-24 10:15:50'),
('65bc5a448c7dc0fe4db81fb3631d7488960dee0f779b921dd10c185596d35c182c33fc7dc9b5d282', 5, 1, 'Qbus', '[]', 0, '2022-05-28 09:47:31', '2022-05-28 09:47:31', '2023-05-28 11:47:31'),
('66c2cd34fec6a736b8a2faed289976e23fba834eebcd30601ef4cb812312c77059e0d70c185e7a7c', 5, 1, 'Qbus', '[]', 0, '2022-05-27 10:55:33', '2022-05-27 10:55:33', '2023-05-27 12:55:33'),
('6785725791db41d6cfac12d24b0e0737bffc60b516fa9bfc90bb66753ff918e18893d81762006e13', 5, 1, 'Qbus', '[]', 0, '2022-05-27 10:22:56', '2022-05-27 10:22:56', '2023-05-27 12:22:56'),
('67ff41bfe7ec5ff9ad24169883074b501dac52ff92fcec302083033f15c2d24b650866c7e40548ca', 5, 1, 'Qbus', '[]', 0, '2022-05-27 11:45:18', '2022-05-27 11:45:18', '2023-05-27 13:45:18'),
('690a71911a60b56beb86338a6e4a2ff234eb2461fb1c69f09087af365a3872c6332ab10f1dcce7f2', 14, 1, 'Qbus', '[]', 0, '2022-05-28 10:17:15', '2022-05-28 10:17:15', '2023-05-28 12:17:15'),
('6a21127e8e2ebfed50e5cb82640bbf5ec7d00080da803528bbc2b4bcd3ce5ec7fded4788e6918d8e', 5, 1, 'Qbus', '[]', 0, '2022-05-28 13:18:54', '2022-05-28 13:18:54', '2023-05-28 15:18:54'),
('6b641c893716b635ce81a31f18295a3abd010bbf74731b3ec463decd69357ce87efd179d87eafb56', 5, 1, 'Qbus', '[]', 0, '2022-05-28 10:00:11', '2022-05-28 10:00:11', '2023-05-28 12:00:11'),
('6ceacff220ab2d4f10c20134c7150b5f47ddd9ed0cbce5168a5c193edb46c169cbb152835faf27a1', 5, 1, 'Qbus', '[]', 0, '2022-05-28 10:01:10', '2022-05-28 10:01:10', '2023-05-28 12:01:10'),
('6d0824fe584ed0a0f26e9208aa410690a99162d78190ee43bdb74122afd6aba4f382a59447708004', 5, 1, 'Qbus', '[]', 0, '2022-05-27 11:08:00', '2022-05-27 11:08:00', '2023-05-27 13:08:00'),
('6dbb31dc2dc6013d0fdcd6d327c07274b051a978535d7183715297e95eeda58506149b60a1c9d63a', 5, 1, 'Qbus', '[]', 0, '2022-05-28 10:02:08', '2022-05-28 10:02:08', '2023-05-28 12:02:08'),
('6f504d6b462e2f934b2942458fbd5b8c0c8c7ccdf184e9dc3de885c85388ed63c52b4b689361b369', 5, 1, 'Qbus', '[]', 0, '2022-05-27 10:52:52', '2022-05-27 10:52:52', '2023-05-27 12:52:52'),
('70666ab781b856f79abbc771d1ee975cab322291a53b94db32c512df97c4461f6d0ca30a5f4f22e0', 30, 1, 'Qbus', '[]', 0, '2022-05-28 10:37:19', '2022-05-28 10:37:19', '2023-05-28 12:37:19'),
('71223437dcd9bcdd1690a278095b2eff7286a38f2ea1922eedee081ddbf254bdb627c4eb72e07d2a', 12, 1, 'Qbus', '[]', 0, '2022-05-25 05:35:45', '2022-05-25 05:35:45', '2023-05-25 07:35:45'),
('7186c5011606047ac8e415a2c749b4458cbe42bd69edc13a6d73700364fa6bd1b65da3cce4d3f3dc', 5, 1, 'Qbus', '[]', 0, '2022-05-27 10:56:40', '2022-05-27 10:56:40', '2023-05-27 12:56:40'),
('719c58f3ffe22597a58b15c97d2efc2f28b1d82de2b01f76a47f18e067adaa39cc0117dbc049121b', 5, 1, 'Qbus', '[]', 0, '2022-05-27 11:35:24', '2022-05-27 11:35:24', '2023-05-27 13:35:24'),
('71e7a584f7d41f5f5993c63a9b2d0d6d77918f62d854ac500ee32d710539f34a50c43be224b8bfcc', 5, 1, 'Qbus', '[]', 0, '2022-05-27 09:57:25', '2022-05-27 09:57:25', '2023-05-27 11:57:25'),
('72318228e286559c5d0c6549c7ee3bef919279c1653afced5a2514368a04a30479ed842fa3d201e7', 5, 1, 'Qbus', '[]', 0, '2022-05-27 10:06:19', '2022-05-27 10:06:19', '2023-05-27 12:06:19'),
('747a4eb0469927b205737b9fd2a3a379c504f116143aa699ffb823861e50a5b2beb3eae00e7a0fb3', 5, 1, 'Qbus', '[]', 0, '2022-05-28 05:37:51', '2022-05-28 05:37:51', '2023-05-28 07:37:51'),
('74abd7d1c96d7c9a2843410db07ae9130bfd21041b0b24d1bb88b5222a05a4ef35f1e6072b00797c', 5, 1, 'Qbus', '[]', 0, '2022-05-27 10:47:31', '2022-05-27 10:47:31', '2023-05-27 12:47:31'),
('74cf9711e5ba9a7c253b39af91a51b0af255f97f01c153f0fe16a71bc8062449a7f0ddfb3733ac7e', 5, 1, 'Qbus', '[]', 0, '2022-05-24 09:14:12', '2022-05-24 09:14:12', '2023-05-24 11:14:12'),
('771255007dd2a08a44058c7d44300a2f392e072d2a5b9e82e723e4d9d06ce52b07c35f9a6caf7b74', 5, 1, 'Qbus', '[]', 0, '2022-05-27 10:09:55', '2022-05-27 10:09:55', '2023-05-27 12:09:55'),
('77e2adec5b835193ed46c7d42617659a56538d2749ece5a98b4a40f8dc545a52058cd7cbf9f00f6c', 5, 1, 'Qbus', '[]', 0, '2022-05-27 12:15:31', '2022-05-27 12:15:31', '2023-05-27 14:15:31'),
('784a070102dace2b877e2ac0a007f0351267e8af5e973f084fe74fab7248ab4ccdb2b054d9410c68', 5, 1, 'Qbus', '[]', 0, '2022-05-27 09:57:42', '2022-05-27 09:57:42', '2023-05-27 11:57:42'),
('7959d51b46fc5a844c9722fab790b20bdd9b2ae1b5489b7e6919691422943a9d8c904a2cf32a1103', 5, 1, 'Qbus', '[]', 0, '2022-05-28 10:00:47', '2022-05-28 10:00:47', '2023-05-28 12:00:47'),
('7bcc7b41bb64fb068e2659c8b719b211a32860c7cd818ebb36a66bfef4843e6d1b74bfd6251e0b40', 5, 1, 'Qbus', '[]', 1, '2022-05-28 10:47:11', '2022-05-28 10:47:11', '2023-05-28 12:47:11'),
('7cee40d134890cc3a290bfdabb7884fcaba83f1922ca6eb54d02df228a1ab5457311c84588525c0d', 5, 1, 'Qbus', '[]', 0, '2022-05-27 11:04:46', '2022-05-27 11:04:46', '2023-05-27 13:04:46'),
('7d7e95f3a8ec98b7955d5d6d4e499b30b3d0b719286d1fd1b19d6495cf8f4a6db7cbde2c6eb769bf', 5, 1, 'Qbus', '[]', 0, '2022-05-28 10:48:00', '2022-05-28 10:48:00', '2023-05-28 12:48:00'),
('7da595647c944bae77b14c04889a2ddfc2374887f1f00d2af8c5d8f9898fdd0fcd02b8ffd194ebbb', 22, 1, 'Qbus', '[]', 0, '2022-05-28 10:28:13', '2022-05-28 10:28:13', '2023-05-28 12:28:13'),
('7ddb6f0a6504f75cbdd45087f8d745c0c35c4232320086d83c0511be245e9567d2ebb09e001f7b5b', 5, 1, 'Qbus', '[]', 0, '2022-06-01 08:26:45', '2022-06-01 08:26:45', '2023-06-01 10:26:45'),
('7e078e461930be85f3866d6f596d908e3f02a7b5eb79bcaf02ff693f6e941eb412dba8c3725aec60', 5, 1, 'Qbus', '[]', 0, '2022-05-28 10:00:29', '2022-05-28 10:00:29', '2023-05-28 12:00:29'),
('7e0a94b762f743ef322d327bf0fbe9ad58590ea657ad2be63013e43793d13a8064d2858986183f38', 16, 1, 'Qbus', '[]', 0, '2022-05-28 10:20:06', '2022-05-28 10:20:06', '2023-05-28 12:20:06'),
('7e80a410a20f8cfa0886a3b0948d9a8aef7bd9ff9de6e77429e70abbd0bb9546805c8c5930b61c2f', 5, 1, 'Qbus', '[]', 0, '2022-05-27 11:12:44', '2022-05-27 11:12:44', '2023-05-27 13:12:44'),
('7f811c79bd484fceb18588bf2b1d08fb6f43639fbacf7c0dcbf96009ff2f8554f44b72b5421c452f', 5, 1, 'Qbus', '[]', 0, '2022-05-27 10:04:07', '2022-05-27 10:04:07', '2023-05-27 12:04:07'),
('7fc6e0f7fb7ce013ddd874f90df86f7e84676e02adf0a79755ca76992cdaee42f492ecd27a5c1092', 5, 1, 'Qbus', '[]', 0, '2022-05-27 10:42:26', '2022-05-27 10:42:26', '2023-05-27 12:42:26'),
('84a945bf3a7c7d68918deda6e52a8df46c77291d8d34fa734cecfbf3fc4ad9e0443f189ea5a59f55', 5, 1, 'Qbus', '[]', 0, '2022-05-27 11:34:44', '2022-05-27 11:34:44', '2023-05-27 13:34:44'),
('852123ec2312ad2206ded89c9477ad9950e7f628e5c46b2406ad9eff7c968df9bb8fe4c379523e80', 5, 1, 'Qbus', '[]', 0, '2022-05-27 11:09:29', '2022-05-27 11:09:29', '2023-05-27 13:09:29'),
('8646160b503cf0c9a0db9fb6df5dd367063661f88fac9da424625a641f2980aeb417df9c7f47c9f7', 5, 1, 'Qbus', '[]', 0, '2022-05-24 10:22:30', '2022-05-24 10:22:30', '2023-05-24 12:22:30'),
('87d9869ab3ffac2a74dd0f3986efc77185b683dcff4fad573423c8b3b3260bd77d76566db83338d9', 42, 1, 'Qbus', '[]', 0, '2022-06-29 09:04:10', '2022-06-29 09:04:10', '2023-06-29 11:04:10'),
('8808448f43cbc0819b432938a50a2e981be57a6c8b2f2498b7e8623f7c3b70c669f5abe986364385', 5, 1, 'Qbus', '[]', 0, '2022-05-27 11:05:10', '2022-05-27 11:05:10', '2023-05-27 13:05:10'),
('8989eb002a9028c867a9b3e07c03a2df7977d6fe9b9f6303e057f53e641f31d51879bb878eca8803', 5, 1, 'Qbus', '[]', 1, '2022-06-01 07:22:39', '2022-06-01 07:22:39', '2023-06-01 09:22:39'),
('89ce88601ad36242d383b0722021290bdc03a34ef40f19e600c2c73b924e6294142542e22871b827', 5, 1, 'Qbus', '[]', 0, '2022-05-27 10:16:02', '2022-05-27 10:16:02', '2023-05-27 12:16:02'),
('8a59c82359f4784901e4de06766a8203c43ad6c898e3ddae47dd0ff0a7a70f626cf6da3085056e0d', 27, 1, 'Qbus', '[]', 0, '2022-05-28 10:35:10', '2022-05-28 10:35:10', '2023-05-28 12:35:10'),
('8b1f5868d67b147cde44b4a304fe2f19bc5045e6fe51561dc20b1194856db6e3600271520b3fbd89', 34, 1, 'Qbus', '[]', 0, '2022-05-28 10:58:22', '2022-05-28 10:58:22', '2023-05-28 12:58:22'),
('8b5fb7bfaa8b76cabc5cb08b072c63a93466eb4b06f18cd9504ba211705e3d2b6cd0ca88c345b80c', 5, 1, 'Qbus', '[]', 0, '2022-05-27 11:00:55', '2022-05-27 11:00:55', '2023-05-27 13:00:55'),
('8c859cad7fe09ecd790391d9eb30b160df8603616fe16a3c2e622d2612061c01888a0ce14fbebdec', 5, 1, 'Qbus', '[]', 0, '2022-05-27 11:14:09', '2022-05-27 11:14:09', '2023-05-27 13:14:09'),
('8c9198e87abd95fcd4ab30fff9aa3c2aeca15d2d835a3c304b3b8851b2f6dee46e96426a77d0e0ba', 13, 1, 'Qbus', '[]', 0, '2022-05-28 10:14:49', '2022-05-28 10:14:49', '2023-05-28 12:14:49'),
('8cf45c37cc850578f3266e039ad2deac5237de065e4559f9c0b6b1b1a73666f9db9b09363e10d46d', 5, 1, 'Qbus', '[]', 0, '2022-05-27 07:45:12', '2022-05-27 07:45:12', '2023-05-27 09:45:12'),
('8ee2a585e564d6e8422ff37c72dd1c74f31f8594983810dc7b4e77ca79c18535eeca916f81fb11d8', 5, 1, 'Qbus', '[]', 0, '2022-05-27 11:05:35', '2022-05-27 11:05:35', '2023-05-27 13:05:35'),
('903f8a9f6e7d9a7c290c2b6b8aa7d9350367d5c436516c63394cf60422fd264b755499ef36599424', 5, 1, 'Qbus', '[]', 0, '2022-05-27 11:42:55', '2022-05-27 11:42:55', '2023-05-27 13:42:55'),
('9137b01f56cf71f9b9f2fc2b8d2fa59d41742705328a357ca81a7bf6dacd1aeb55bafc160ef04f14', 5, 1, 'Qbus', '[]', 0, '2022-05-25 05:34:05', '2022-05-25 05:34:05', '2023-05-25 07:34:05'),
('92ebf709a4e328e98a3941279069a0d1600a22a2159dc781b3b2272bb01e01f5d0e5074c6566ce8b', 5, 1, 'Qbus', '[]', 0, '2022-05-27 12:13:22', '2022-05-27 12:13:22', '2023-05-27 14:13:22'),
('93157789299f60b28ff721fb3c6c7dc271b4a307236d38b9fdebddfe272eda1aa8d459a199f53185', 5, 1, 'Qbus', '[]', 0, '2022-05-27 09:58:12', '2022-05-27 09:58:12', '2023-05-27 11:58:12'),
('93339941f82946f16dce0667bb2c90b6bf364a960cd822ad7a9938f79fd7fb8d75397a56a98d047b', 5, 1, 'Qbus', '[]', 0, '2022-05-27 10:52:46', '2022-05-27 10:52:46', '2023-05-27 12:52:46'),
('9627c85b70764ff1ee199f2ee60e0d2e5b5cbc607da474e538f965e3abbeb1e3b0af853002afb5b9', 8, 1, 'Qbus', '[]', 0, '2022-05-24 09:03:40', '2022-05-24 09:03:40', '2023-05-24 11:03:40'),
('974458f506c6d6ce465b57c30ab4a7bd0b9f9ae56e027e89c7dc88b9f216cb5bfbb1cbbfb6de35f8', 5, 1, 'Qbus', '[]', 0, '2022-05-28 09:31:47', '2022-05-28 09:31:47', '2023-05-28 11:31:47'),
('9a1692af894fbed1c7106a7786713cf73935b9db3782801aa7ea3b76fac76f4f2b5ecd8bf06ef10a', 5, 1, 'Qbus', '[]', 0, '2022-05-27 11:20:40', '2022-05-27 11:20:40', '2023-05-27 13:20:40'),
('9c4e91487b4134059992d382e6c7c576036602edb2fc17a6373342f8bd93a1175e4c2c44f01b062d', 5, 1, 'Qbus', '[]', 0, '2022-05-27 11:10:17', '2022-05-27 11:10:17', '2023-05-27 13:10:17'),
('9eb0397347c762badc1c1c68c8fc7a1cdf4721791163bf1866700868e2609a6e1f7c07829b3d615f', 5, 1, 'Qbus', '[]', 0, '2022-05-28 09:34:51', '2022-05-28 09:34:51', '2023-05-28 11:34:51'),
('a00f414077987c87495c0a444cc193d0f1d64c5711cfebdf3d9f4569c4cf9f87501175fed3ae6f13', 7, 1, 'Qbus', '[]', 0, '2022-05-24 09:03:19', '2022-05-24 09:03:19', '2023-05-24 11:03:19'),
('a10f1704585f5b03ad948dde3627abb08b730f2c487bc7653bde04cd01b12a23ae84eca26742c630', 21, 1, 'Qbus', '[]', 0, '2022-05-28 10:25:25', '2022-05-28 10:25:25', '2023-05-28 12:25:25'),
('a443facf701eff07ed6612059c14033a547c12a8fbd2f860eeec71faf2c34bef778da05215551b5e', 5, 1, 'Qbus', '[]', 0, '2022-05-24 08:16:43', '2022-05-24 08:16:43', '2023-05-24 10:16:43'),
('a511dd1465aac8abdf95408c98ceeeb184bd0ba31a747eb46400a6d9190a8f01ef81dc5239729fc2', 19, 1, 'Qbus', '[]', 0, '2022-05-28 10:23:19', '2022-05-28 10:23:19', '2023-05-28 12:23:19'),
('a6b7965e7e95ac24adf7b8017831256ff73379731e8d2a71016562c390f7a2c1e52669484c823899', 5, 1, 'Qbus', '[]', 0, '2022-05-27 11:15:12', '2022-05-27 11:15:12', '2023-05-27 13:15:12'),
('a7a107473a568facc4b85ff07d07686ba932403fdc7509c373f89ba0d1950420ea28d5f197f16b6f', 5, 1, 'Qbus', '[]', 0, '2022-05-27 10:54:44', '2022-05-27 10:54:44', '2023-05-27 12:54:44'),
('a7eccbe0ac8c2a7b7e27fc01f704c681725955a09dbb8c7348654e2bb662f8574beff42dbc85b828', 5, 1, 'Qbus', '[]', 0, '2022-05-27 11:17:28', '2022-05-27 11:17:28', '2023-05-27 13:17:28'),
('a9af8fa8bde79d3809a287615e766edbfd2708ac87425ef42c826e2dad0d4dddd459cc21c520e608', 5, 1, 'Qbus', '[]', 0, '2022-05-27 11:11:37', '2022-05-27 11:11:37', '2023-05-27 13:11:37'),
('aa2bc167be9cd3e90271a349926a656c570fab9fd8aaa9eab7fb0e0a8ef4c146427a975b3a795dd4', 5, 1, 'Qbus', '[]', 0, '2022-05-27 11:56:05', '2022-05-27 11:56:05', '2023-05-27 13:56:05'),
('ac0ab16eaf4a050fcc8215deb08e9d541bd30471fda0ec7bef9d97f3161a301735f9db3ed4c42ef7', 5, 1, 'Qbus', '[]', 0, '2022-05-27 09:47:21', '2022-05-27 09:47:21', '2023-05-27 11:47:21'),
('ac38167d086cc4d975a402939ed6f9b2e0c5b5d3d583adb05fa98c5c74d4eb1947d01098424c9b4a', 5, 1, 'Qbus', '[]', 0, '2022-05-27 11:34:28', '2022-05-27 11:34:28', '2023-05-27 13:34:28'),
('adafc156739d5dccab30659371ca5e635ff4502a1529b23fdc9b2ce65ca39fc95e653ce227ac3515', 2, 1, 'Qbus', '[]', 0, '2022-05-24 08:14:13', '2022-05-24 08:14:13', '2023-05-24 10:14:13'),
('afb713d4a60085c3a53cbfd079422e7c8cd45df3f44ee241633361dd5d99239ddb0d12be04c27338', 5, 1, 'Qbus', '[]', 0, '2022-05-27 09:43:40', '2022-05-27 09:43:40', '2023-05-27 11:43:40'),
('b22f3180a84314c056c5a5fcf216d67700ef1d5abd5efcb53437c50074d7c696ac1c3a46e550b696', 5, 1, 'Qbus', '[]', 0, '2022-05-27 11:31:37', '2022-05-27 11:31:37', '2023-05-27 13:31:37'),
('b395faf9dce4e1ce87fc907136a9d64d3fa8481781fdcc2181215fefa1f2739b61c2de5f703af081', 5, 1, 'Qbus', '[]', 0, '2022-05-27 10:11:46', '2022-05-27 10:11:46', '2023-05-27 12:11:46'),
('b49b432165bfb7092873733afe6ed4546c0bb2533fb4d1ce9355798187dbf6a6378a168436b4da87', 5, 1, 'Qbus', '[]', 0, '2022-05-27 10:00:12', '2022-05-27 10:00:12', '2023-05-27 12:00:12'),
('b5c427b23bc7639a9e564c971ff38e682834bca3e9c707412659d258dc19bd15efb69059e9406767', 5, 1, 'Qbus', '[]', 0, '2022-06-08 10:08:12', '2022-06-08 10:08:12', '2023-06-08 12:08:12'),
('b6ae54ad5d87b80c7fd813973d81bd8600bc9d83477be5d29669a5444edf39d1f1f96af90f824a37', 5, 1, 'Qbus', '[]', 0, '2022-05-27 11:17:47', '2022-05-27 11:17:47', '2023-05-27 13:17:47'),
('b6b70aa86b9203872e906afd434b79c37b4fa39c261017e9c6611c545d618bc27bb06f33caa6d192', 5, 1, 'Qbus', '[]', 0, '2022-05-27 11:12:34', '2022-05-27 11:12:34', '2023-05-27 13:12:34'),
('b8d8adeee3383c726b5ca54c2121f41248984eef5629b0a661d116befa696e3ca6c98f25fd0ee427', 5, 1, 'Qbus', '[]', 0, '2022-05-27 10:01:46', '2022-05-27 10:01:46', '2023-05-27 12:01:46'),
('b8e3b3619bb3dad4f8c47a699a9768fc615ce40174519eb4aacc9d49a0f9b2bd0ede2ee52e0a4a91', 5, 1, 'Qbus', '[]', 0, '2022-05-28 09:43:20', '2022-05-28 09:43:20', '2023-05-28 11:43:20'),
('bbf104001ed91aa50bfcc1e6ba86d7ce7c6e4960ff02b9eaedc9cdc169f31a24a5d92660c53a2a83', 5, 1, 'Qbus', '[]', 0, '2022-05-28 09:34:34', '2022-05-28 09:34:34', '2023-05-28 11:34:34'),
('bc7410bb4c71d4ed7a84fe5bf65f4e896047535c82af46526063657824354c68559ac63111475111', 29, 1, 'Qbus', '[]', 0, '2022-05-28 10:37:02', '2022-05-28 10:37:02', '2023-05-28 12:37:02'),
('bed4b69a4edace1da661598401b3ddb9d27a20c091a5a7369c2972386bffa6d5b99fd8a564c028c3', 5, 1, 'Qbus', '[]', 0, '2022-05-27 10:04:10', '2022-05-27 10:04:10', '2023-05-27 12:04:10'),
('bf11e9bcffeca08b8cf880d176cdad5bec6a9867dbcfaa0730557db49de2f11c8aa78ba991800fa7', 5, 1, 'Qbus', '[]', 0, '2022-05-27 11:43:21', '2022-05-27 11:43:21', '2023-05-27 13:43:21'),
('c1030450f29e69a6f255e7a8fd4c1482d2518e18b901b969abd135a2131e103d8f1b54698f0fe6d2', 5, 1, 'Qbus', '[]', 0, '2022-05-27 10:00:55', '2022-05-27 10:00:55', '2023-05-27 12:00:55'),
('c21000544f0be004570108d5b75292ae21aa6d987ce9385de5ae47ec54f689fcc52518355730ba1c', 24, 1, 'Qbus', '[]', 0, '2022-05-28 10:29:01', '2022-05-28 10:29:01', '2023-05-28 12:29:01'),
('c27dc9844dd1fe43c6ff9fd09e3e6e57b04757427570f7dbdb9c72aae38add2c0de9bf31202e444a', 25, 1, 'Qbus', '[]', 0, '2022-05-28 10:29:51', '2022-05-28 10:29:51', '2023-05-28 12:29:51'),
('c3d06f6de40d98786896278d2d687bb642412411f17ec8e8fe1b7b5719d8e1917c09ac5fbf8e29ad', 5, 1, 'Qbus', '[]', 0, '2022-05-27 11:33:32', '2022-05-27 11:33:32', '2023-05-27 13:33:32'),
('c4dd7c651dc672540846f494947ed94545a8ac76b74750d5701ddb3917f4c00337eaf027aab94dc3', 46, 1, 'Qbus', '[]', 0, '2022-06-29 09:12:30', '2022-06-29 09:12:30', '2023-06-29 11:12:30'),
('c74f4b54c09f886d154e647df711c02025affee858cbf0b2cf7060e6ce0152708876a0f431fef325', 5, 1, 'Qbus', '[]', 0, '2022-05-28 09:40:29', '2022-05-28 09:40:29', '2023-05-28 11:40:29'),
('c7c2b56b9adc5c68692af9cfb8a43f4715374c6aaddda1956ae217ebb6f2ba3071eed490a308d3d8', 5, 1, 'Qbus', '[]', 0, '2022-05-27 10:59:49', '2022-05-27 10:59:49', '2023-05-27 12:59:49'),
('c8e655ad7cd7f42712c876225c38c4a2d9a580481c155e9924e297da6f8c81f7f403cc688700de5a', 5, 1, 'Qbus', '[]', 0, '2022-05-27 11:37:20', '2022-05-27 11:37:20', '2023-05-27 13:37:20'),
('c901a6abb3202ad6d5b03cd8143221b159121e478c6d58106a1049511f20528761786000d2942d56', 5, 1, 'Qbus', '[]', 0, '2022-05-27 09:57:32', '2022-05-27 09:57:32', '2023-05-27 11:57:32'),
('cac36a0c339204aa98533b869a18d87c91eace726c49ba5b3305e0d11da75c95b8bff8d5c6ce5670', 5, 1, 'Qbus', '[]', 0, '2022-05-27 10:45:25', '2022-05-27 10:45:25', '2023-05-27 12:45:25'),
('cb0606e6b5e7f764dabfad13203d8b01c279f576fb0246ccbd3dfe24830252f8985ccd07285871d0', 5, 1, 'Qbus', '[]', 0, '2022-06-01 08:26:07', '2022-06-01 08:26:07', '2023-06-01 10:26:07'),
('cfdc0ee8f9bb6a13ed32c539b97147065658a3cfb83192404540fd21bbe67942b2355cfa29e2799a', 5, 1, 'Qbus', '[]', 0, '2022-05-27 11:07:52', '2022-05-27 11:07:52', '2023-05-27 13:07:52'),
('d0eff603c746cf752b261e4383bfc44c31a4a5d27e4651b5ad4e4b1d9cb422f0947935e7470788d4', 5, 1, 'Qbus', '[]', 0, '2022-05-27 11:11:43', '2022-05-27 11:11:43', '2023-05-27 13:11:43'),
('d1305f0e2b7be76f162543f3ed740416d0ac6377cd575a54e1afca49708e601faa7b8a4412a50721', 38, 1, 'Qbus', '[]', 0, '2022-06-27 07:39:38', '2022-06-27 07:39:38', '2023-06-27 09:39:38'),
('d1a08f534184c8674d52659de205a01f4f771a4c0e9a9b1b071a24eb9ad8689136fe70aef86c08f2', 37, 1, 'Qbus', '[]', 0, '2022-06-02 12:45:19', '2022-06-02 12:45:19', '2023-06-02 14:45:19'),
('d1a51e9ecdebd65b08f948c5303f62e4f7d66a080aa70c8c6db18345170cbd24268c090823021919', 5, 1, 'Qbus', '[]', 0, '2022-05-27 11:15:34', '2022-05-27 11:15:34', '2023-05-27 13:15:34'),
('d5b4c271271148ee125ae0da5eb7bf844dcd09c52da93409b61d892e438624228e893a8377552d18', 5, 1, 'Qbus', '[]', 0, '2022-05-27 10:59:57', '2022-05-27 10:59:57', '2023-05-27 12:59:57'),
('d5ba8dfb7679cedeacc671e768f659abeaf1f3086ed9ea6e34b80678ead339420cb87ed0bace3c0b', 5, 1, 'Qbus', '[]', 0, '2022-05-27 11:14:36', '2022-05-27 11:14:36', '2023-05-27 13:14:36'),
('d83ac6f15362210dc36b034050e9515f7ec35162326b60faebebd8b6d03ceccb892e89b7db7da8b1', 5, 1, 'Qbus', '[]', 0, '2022-05-28 10:52:40', '2022-05-28 10:52:40', '2023-05-28 12:52:40'),
('d84b88c1412600d7a0e9b7ca70914e94db3009da4dcde9d82f810cdf0d642e7206db9920228ca7e9', 5, 1, 'Qbus', '[]', 0, '2022-05-27 11:46:19', '2022-05-27 11:46:19', '2023-05-27 13:46:19'),
('ddf64ee009429429df5c047aa24ec87e9555104bf5cf6a426bd31c4a9da169c57e5c6b84fa5838a3', 33, 1, 'Qbus', '[]', 0, '2022-05-28 10:54:31', '2022-05-28 10:54:31', '2023-05-28 12:54:31'),
('deb2a00093644ab833e3a82943792b4cfdace4de6c444a22547a5b733b7ebdc9db14c29fdeb3de64', 5, 1, 'Qbus', '[]', 0, '2022-05-28 09:31:54', '2022-05-28 09:31:54', '2023-05-28 11:31:54'),
('e0791016316b47ba87d1a459e98e9eae4e45c9a0dd253bbc12a0982eb0dec4e5484955449eabfee6', 5, 1, 'Qbus', '[]', 0, '2022-05-27 10:54:40', '2022-05-27 10:54:40', '2023-05-27 12:54:40'),
('e221e523d72a2f0d1d789f82b99a229dc5dfa820895a76abd6d23442b727c436f9ae5b15f25ddd8c', 5, 1, 'Qbus', '[]', 0, '2022-05-27 11:36:08', '2022-05-27 11:36:08', '2023-05-27 13:36:08'),
('e241912396339351216a7d29b1256a5a100354d45e93559813166a4cbcd25e9c875124b69ec1abcb', 5, 1, 'Qbus', '[]', 0, '2022-05-27 10:42:55', '2022-05-27 10:42:55', '2023-05-27 12:42:55'),
('e38aef90d0bcebae4378a2d11fd8e37e9a542e77472f5985569c3b9df9857e1ab5fe2dacc9fb59b0', 28, 1, 'Qbus', '[]', 0, '2022-05-28 10:36:38', '2022-05-28 10:36:38', '2023-05-28 12:36:38'),
('e3ccd09fc00ea82f93e1c44ed7ff9a683430161f4218fd7871bdca5f0b5d35bccfe4b4c01ac18a30', 5, 1, 'Qbus', '[]', 0, '2022-05-27 09:47:22', '2022-05-27 09:47:22', '2023-05-27 11:47:22'),
('e4ad58929351dafc269fd08c39e2f1799b7c0daf99b19222848f703984eb3ca85e5c8b21ffafdc39', 5, 1, 'Qbus', '[]', 0, '2022-05-27 09:47:26', '2022-05-27 09:47:26', '2023-05-27 11:47:26'),
('e8db37800b4990ba779e1f27911f19a154087e12a1f2472c3af7db3d5675179bfd278946cd9f3b73', 2, 1, 'Qbus', '[]', 0, '2022-05-24 08:13:35', '2022-05-24 08:13:35', '2023-05-24 10:13:35'),
('e8f688272930f1d9d4909dde87a5afeefd84878e67a00e6eea9788021aa35593578b598f06577775', 5, 1, 'Qbus', '[]', 0, '2022-05-27 10:45:52', '2022-05-27 10:45:52', '2023-05-27 12:45:52'),
('ec422d2244998c55a64c8f7eed32c94dfceed5b3121d62c55156c2b6f0d683d18a9dd2d3a0e12135', 5, 1, 'Qbus', '[]', 0, '2022-05-27 11:09:51', '2022-05-27 11:09:51', '2023-05-27 13:09:51'),
('ecb758a72833f99738445cd49153945107ada23468c619f6fddc449c02bb089a732196c74f98ca76', 5, 1, 'Qbus', '[]', 0, '2022-05-24 09:04:19', '2022-05-24 09:04:19', '2023-05-24 11:04:19'),
('ed041ba5bc8446ae1d2c9ada6153789ca31a9aa85ec32d383800432f3f7ed0c1bbdb2680376283b8', 5, 1, 'Qbus', '[]', 0, '2022-05-28 09:53:36', '2022-05-28 09:53:36', '2023-05-28 11:53:36'),
('f0cb2765d3965e82fa34dfd8b39377b40190ceb57d8d5b78270d477736d51a1833316ee286f48a56', 5, 1, 'Qbus', '[]', 0, '2022-05-27 10:02:10', '2022-05-27 10:02:10', '2023-05-27 12:02:10'),
('f23829ff4284094dceeade4b09af1d84c3430eb982995e06d179cd94b134fc2f6b12dce719d943c8', 5, 1, 'Qbus', '[]', 0, '2022-05-27 10:07:42', '2022-05-27 10:07:42', '2023-05-27 12:07:42'),
('f34d7f17b5b1f53a226589d12755caf032fe1a44a7f954376c075f7f1a18bc8aaa30bb1b0a80fbed', 5, 1, 'Qbus', '[]', 0, '2022-05-27 10:52:30', '2022-05-27 10:52:30', '2023-05-27 12:52:30'),
('f39c14d09b0e9c035ddac4b604776b1f52c54820408aa1ea2175646642a17c84e69da9664725524f', 5, 1, 'Qbus', '[]', 0, '2022-05-27 10:53:33', '2022-05-27 10:53:33', '2023-05-27 12:53:33'),
('f51068fe8004a87e123eadd43ff443fbf46fc9d97c6616a5806d18e36cad2bbb62bc5f0f7004dcaa', 5, 1, 'Qbus', '[]', 0, '2022-05-28 09:20:41', '2022-05-28 09:20:41', '2023-05-28 11:20:41'),
('f535d124fe8dcb16a86d3ba74ade12c4cc99c5b71aa1299fb29142e1e1e3c135a863625975831797', 5, 1, 'Qbus', '[]', 0, '2022-05-27 15:12:45', '2022-05-27 15:12:45', '2023-05-27 17:12:45'),
('f6d3f92e73a5bf9d411c3d62638ec4ebd41c4c826f4dc5c22b69c629bd5b235517c936dfd55beb87', 5, 1, 'Qbus', '[]', 0, '2022-05-27 09:46:47', '2022-05-27 09:46:47', '2023-05-27 11:46:47'),
('f86689a8c7646202cbdc28d9c5f29d5b72b4b7ee8aafde782f1bfc8e86a1a286c57db4ab28d1103e', 5, 1, 'Qbus', '[]', 0, '2022-05-27 11:45:58', '2022-05-27 11:45:58', '2023-05-27 13:45:58'),
('fc0b84589a9d911be11f7738497f4581f808a222d25b2b1413402c4049747d6bc28dd8b62a272ec3', 5, 1, 'Qbus', '[]', 0, '2022-05-27 11:09:16', '2022-05-27 11:09:16', '2023-05-27 13:09:16'),
('fc0deb1cbe4a378ae327a887ae9967b8413cd7e45ab49337b31415783b5c41211675db7e4ebbec05', 5, 1, 'Qbus', '[]', 0, '2022-05-27 10:10:31', '2022-05-27 10:10:31', '2023-05-27 12:10:31');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Laravel Personal Access Client', 'BnyryGw87ZYKhzKQfLXhBETYev0WcTXfNsFzHry0', NULL, 'http://localhost', 1, 0, 0, '2022-05-24 08:06:55', '2022-05-24 08:06:55'),
(2, NULL, 'Laravel Password Grant Client', 'ReYOwJivXlOisTrCuQUtITxvRELNiLmjuk1gM8Ai', 'users', 'http://localhost', 0, 1, 0, '2022-05-24 08:06:55', '2022-05-24 08:06:55');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2022-05-24 08:06:55', '2022-05-24 08:06:55');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `provider_id` bigint(20) UNSIGNED NOT NULL,
  `name` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`name`)),
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`description`)),
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `destinations` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`destinations`)),
  `fees` double NOT NULL,
  `starting_city_id` bigint(20) UNSIGNED DEFAULT NULL,
  `date_from` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_from` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provider_notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider_archive` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `auto_approve` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `additional` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`additional`)),
  `rate` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `provider_id`, `name`, `description`, `image`, `destinations`, `fees`, `starting_city_id`, `date_from`, `time_from`, `provider_notes`, `provider_archive`, `auto_approve`, `additional`, `rate`, `created_at`, `updated_at`) VALUES
(9, 1, '{\"ar\": \"حزمة 1\", \"en\": \"Package 1\"}', '{\"ar\": \"هنالك العديد من الأنواع المتوفرة لنصوص لوريم إيبسوم، ولكن الغالبية تم تعديلها بشكل ما عبر إدخال بعض النوادر أو الكلمات العشوائية إلى النص. إن كنت تريد أن تستخدم نص لوريم إيبسوم ما، عليك أن تتحقق أولاً أن ليس هناك أي كلمات أو عبارات محرجة أو غير لائقة مخبأة في هذا النص.\", \"en\": \"There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable\"}', '1651008957_ca9ffc0170ff5ef6.png', '[\"1\",\"2\"]', 50, 2, '2022-07-01', '10:00', NULL, 0, 1, '{\"1\": {\"id\": \"2\", \"fees\": \"20\"}, \"2\": {\"id\": \"3\", \"fees\": \"10\"}}', 0, '2022-04-26 17:26:52', '2022-04-27 01:04:50'),
(10, 1, '{\"ar\": \"حزمة 1\", \"en\": \"Package 1\"}', '{\"ar\": \"هنالك العديد من الأنواع المتوفرة لنصوص لوريم إيبسوم، ولكن الغالبية تم تعديلها بشكل ما عبر إدخال بعض النوادر أو الكلمات العشوائية إلى النص. إن كنت تريد أن تستخدم نص لوريم إيبسوم ما، عليك أن تتحقق أولاً أن ليس هناك أي كلمات أو عبارات محرجة أو غير لائقة مخبأة في هذا النص.\", \"en\": \"There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable\"}', '1651008957_ca9ffc0170ff5ef6.png', '[\"1\",\"2\"]', 50, 2, '2022-07-01', '10:00', NULL, 0, 1, '{\"1\": {\"id\": \"2\", \"fees\": \"20\"}, \"2\": {\"id\": \"3\", \"fees\": \"10\"}}', 0, '2022-04-26 17:26:52', '2022-04-27 01:04:50'),
(11, 1, '{\"ar\": \"حزمة 1\", \"en\": \"Package 1\"}', '{\"ar\": \"هنالك العديد من الأنواع المتوفرة لنصوص لوريم إيبسوم، ولكن الغالبية تم تعديلها بشكل ما عبر إدخال بعض النوادر أو الكلمات العشوائية إلى النص. إن كنت تريد أن تستخدم نص لوريم إيبسوم ما، عليك أن تتحقق أولاً أن ليس هناك أي كلمات أو عبارات محرجة أو غير لائقة مخبأة في هذا النص.\", \"en\": \"There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable\"}', '1651008957_ca9ffc0170ff5ef6.png', '[\"1\",\"2\"]', 50, 2, '2022-07-01', '10:00', NULL, 0, 1, '{\"1\": {\"id\": \"2\", \"fees\": \"20\"}, \"2\": {\"id\": \"3\", \"fees\": \"10\"}}', 0, '2022-04-26 17:26:52', '2022-04-27 01:04:50'),
(12, 1, '{\"ar\": \"حزمة 1\", \"en\": \"Package 1\"}', '{\"ar\": \"هنالك العديد من الأنواع المتوفرة لنصوص لوريم إيبسوم، ولكن الغالبية تم تعديلها بشكل ما عبر إدخال بعض النوادر أو الكلمات العشوائية إلى النص. إن كنت تريد أن تستخدم نص لوريم إيبسوم ما، عليك أن تتحقق أولاً أن ليس هناك أي كلمات أو عبارات محرجة أو غير لائقة مخبأة في هذا النص.\", \"en\": \"There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable\"}', '1651008957_ca9ffc0170ff5ef6.png', '[\"1\",\"2\"]', 50, 2, '2022-07-01', '10:00', NULL, 0, 1, '{\"1\": {\"id\": \"2\", \"fees\": \"20\"}, \"2\": {\"id\": \"3\", \"fees\": \"10\"}}', 0, '2022-04-26 17:26:52', '2022-04-27 01:04:50'),
(13, 1, '{\"ar\": \"حزمة 1\", \"en\": \"Package 1\"}', '{\"ar\": \"هنالك العديد من الأنواع المتوفرة لنصوص لوريم إيبسوم، ولكن الغالبية تم تعديلها بشكل ما عبر إدخال بعض النوادر أو الكلمات العشوائية إلى النص. إن كنت تريد أن تستخدم نص لوريم إيبسوم ما، عليك أن تتحقق أولاً أن ليس هناك أي كلمات أو عبارات محرجة أو غير لائقة مخبأة في هذا النص.\", \"en\": \"There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable\"}', '1651008957_ca9ffc0170ff5ef6.png', '[\"1\",\"2\"]', 50, 2, '2022-07-01', '10:00', NULL, 0, 1, '{\"1\": {\"id\": \"2\", \"fees\": \"20\"}, \"2\": {\"id\": \"3\", \"fees\": \"10\"}}', 0, '2022-04-26 17:26:52', '2022-04-27 01:04:50'),
(14, 1, '{\"ar\": \"حزمة 1\", \"en\": \"Package 1\"}', '{\"ar\": \"هنالك العديد من الأنواع المتوفرة لنصوص لوريم إيبسوم، ولكن الغالبية تم تعديلها بشكل ما عبر إدخال بعض النوادر أو الكلمات العشوائية إلى النص. إن كنت تريد أن تستخدم نص لوريم إيبسوم ما، عليك أن تتحقق أولاً أن ليس هناك أي كلمات أو عبارات محرجة أو غير لائقة مخبأة في هذا النص.\", \"en\": \"There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable\"}', '1651008957_ca9ffc0170ff5ef6.png', '[\"1\",\"2\"]', 50, 2, '2022-07-01', '10:00', NULL, 0, 1, '{\"1\": {\"id\": \"2\", \"fees\": \"20\"}, \"2\": {\"id\": \"3\", \"fees\": \"10\"}}', 0, '2022-04-26 17:26:52', '2022-04-27 01:04:50'),
(15, 1, '{\"ar\": \"حزمة 1\", \"en\": \"Package 1\"}', '{\"ar\": \"هنالك العديد من الأنواع المتوفرة لنصوص لوريم إيبسوم، ولكن الغالبية تم تعديلها بشكل ما عبر إدخال بعض النوادر أو الكلمات العشوائية إلى النص. إن كنت تريد أن تستخدم نص لوريم إيبسوم ما، عليك أن تتحقق أولاً أن ليس هناك أي كلمات أو عبارات محرجة أو غير لائقة مخبأة في هذا النص.\", \"en\": \"There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable\"}', '1651008957_ca9ffc0170ff5ef6.png', '[\"1\",\"2\"]', 50, 2, '2022-07-01', '10:00', NULL, 0, 1, '{\"1\": {\"id\": \"2\", \"fees\": \"20\"}, \"2\": {\"id\": \"3\", \"fees\": \"10\"}}', 0, '2022-04-26 17:26:52', '2022-04-27 01:04:50'),
(16, 1, '{\"ar\": \"حزمة 1\", \"en\": \"Package 1\"}', '{\"ar\": \"هنالك العديد من الأنواع المتوفرة لنصوص لوريم إيبسوم، ولكن الغالبية تم تعديلها بشكل ما عبر إدخال بعض النوادر أو الكلمات العشوائية إلى النص. إن كنت تريد أن تستخدم نص لوريم إيبسوم ما، عليك أن تتحقق أولاً أن ليس هناك أي كلمات أو عبارات محرجة أو غير لائقة مخبأة في هذا النص.\", \"en\": \"There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable\"}', '1651008957_ca9ffc0170ff5ef6.png', '[\"1\",\"2\"]', 50, 2, '2022-07-01', '10:00', NULL, 0, 1, '{\"1\": {\"id\": \"2\", \"fees\": \"20\"}, \"2\": {\"id\": \"3\", \"fees\": \"10\"}}', 0, '2022-04-26 17:26:52', '2022-04-27 01:04:50'),
(17, 1, '{\"ar\": \"حزمة 1\", \"en\": \"Package 1\"}', '{\"ar\": \"هنالك العديد من الأنواع المتوفرة لنصوص لوريم إيبسوم، ولكن الغالبية تم تعديلها بشكل ما عبر إدخال بعض النوادر أو الكلمات العشوائية إلى النص. إن كنت تريد أن تستخدم نص لوريم إيبسوم ما، عليك أن تتحقق أولاً أن ليس هناك أي كلمات أو عبارات محرجة أو غير لائقة مخبأة في هذا النص.\", \"en\": \"There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable\"}', '1651008957_ca9ffc0170ff5ef6.png', '[\"1\",\"2\"]', 50, 2, '2022-07-01', '10:00', NULL, 0, 1, '{\"1\": {\"id\": \"2\", \"fees\": \"20\"}, \"2\": {\"id\": \"3\", \"fees\": \"10\"}}', 0, '2022-04-26 17:26:52', '2022-04-27 01:04:50'),
(18, 1, '{\"ar\": \"حزمة 1\", \"en\": \"Package 1\"}', '{\"ar\": \"هنالك العديد من الأنواع المتوفرة لنصوص لوريم إيبسوم، ولكن الغالبية تم تعديلها بشكل ما عبر إدخال بعض النوادر أو الكلمات العشوائية إلى النص. إن كنت تريد أن تستخدم نص لوريم إيبسوم ما، عليك أن تتحقق أولاً أن ليس هناك أي كلمات أو عبارات محرجة أو غير لائقة مخبأة في هذا النص.\", \"en\": \"There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable\"}', '1651008957_ca9ffc0170ff5ef6.png', '[\"1\",\"2\"]', 50, 2, '2022-07-01', '10:00', NULL, 0, 1, '{\"1\": {\"id\": \"2\", \"fees\": \"20\"}, \"2\": {\"id\": \"3\", \"fees\": \"10\"}}', 0, '2022-04-26 17:26:52', '2022-04-27 01:04:50'),
(19, 1, '{\"ar\": \"حزمة 1\", \"en\": \"Package 1\"}', '{\"ar\": \"هنالك العديد من الأنواع المتوفرة لنصوص لوريم إيبسوم، ولكن الغالبية تم تعديلها بشكل ما عبر إدخال بعض النوادر أو الكلمات العشوائية إلى النص. إن كنت تريد أن تستخدم نص لوريم إيبسوم ما، عليك أن تتحقق أولاً أن ليس هناك أي كلمات أو عبارات محرجة أو غير لائقة مخبأة في هذا النص.\", \"en\": \"There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable\"}', '1651008957_ca9ffc0170ff5ef6.png', '[\"1\",\"2\"]', 50, 2, '2022-07-01', '10:00', NULL, 0, 1, '{\"1\": {\"id\": \"2\", \"fees\": \"20\"}, \"2\": {\"id\": \"3\", \"fees\": \"10\"}}', 0, '2022-04-26 17:26:52', '2022-04-27 01:04:50'),
(20, 1, '{\"ar\": \"حزمة 1\", \"en\": \"Package 1\"}', '{\"ar\": \"هنالك العديد من الأنواع المتوفرة لنصوص لوريم إيبسوم، ولكن الغالبية تم تعديلها بشكل ما عبر إدخال بعض النوادر أو الكلمات العشوائية إلى النص. إن كنت تريد أن تستخدم نص لوريم إيبسوم ما، عليك أن تتحقق أولاً أن ليس هناك أي كلمات أو عبارات محرجة أو غير لائقة مخبأة في هذا النص.\", \"en\": \"There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable\"}', '1651008957_ca9ffc0170ff5ef6.png', '[\"1\",\"2\"]', 50, 2, '2022-07-01', '10:00', NULL, 0, 1, '{\"1\": {\"id\": \"2\", \"fees\": \"20\"}, \"2\": {\"id\": \"3\", \"fees\": \"10\"}}', 0, '2022-04-26 17:26:52', '2022-04-27 01:04:50'),
(21, 1, '{\"ar\": \"حزمة 1\", \"en\": \"Package 1\"}', '{\"ar\": \"هنالك العديد من الأنواع المتوفرة لنصوص لوريم إيبسوم، ولكن الغالبية تم تعديلها بشكل ما عبر إدخال بعض النوادر أو الكلمات العشوائية إلى النص. إن كنت تريد أن تستخدم نص لوريم إيبسوم ما، عليك أن تتحقق أولاً أن ليس هناك أي كلمات أو عبارات محرجة أو غير لائقة مخبأة في هذا النص.\", \"en\": \"There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable\"}', '1651008957_ca9ffc0170ff5ef6.png', '[\"1\",\"2\"]', 50, 2, '2022-07-01', '10:00', NULL, 0, 1, '{\"1\": {\"id\": \"2\", \"fees\": \"20\"}, \"2\": {\"id\": \"3\", \"fees\": \"10\"}}', 0, '2022-04-26 17:26:52', '2022-04-27 01:04:50'),
(22, 1, '{\"ar\": \"حزمة 1\", \"en\": \"Package 1\"}', '{\"ar\": \"هنالك العديد من الأنواع المتوفرة لنصوص لوريم إيبسوم، ولكن الغالبية تم تعديلها بشكل ما عبر إدخال بعض النوادر أو الكلمات العشوائية إلى النص. إن كنت تريد أن تستخدم نص لوريم إيبسوم ما، عليك أن تتحقق أولاً أن ليس هناك أي كلمات أو عبارات محرجة أو غير لائقة مخبأة في هذا النص.\", \"en\": \"There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable\"}', '1651008957_ca9ffc0170ff5ef6.png', '[\"1\",\"2\"]', 50, 2, '2022-07-01', '10:00', NULL, 0, 1, '{\"1\": {\"id\": \"2\", \"fees\": \"20\"}, \"2\": {\"id\": \"3\", \"fees\": \"10\"}}', 0, '2022-04-26 17:26:52', '2022-04-27 01:04:50'),
(23, 1, '{\"ar\": \"حزمة 1\", \"en\": \"Package 1\"}', '{\"ar\": \"هنالك العديد من الأنواع المتوفرة لنصوص لوريم إيبسوم، ولكن الغالبية تم تعديلها بشكل ما عبر إدخال بعض النوادر أو الكلمات العشوائية إلى النص. إن كنت تريد أن تستخدم نص لوريم إيبسوم ما، عليك أن تتحقق أولاً أن ليس هناك أي كلمات أو عبارات محرجة أو غير لائقة مخبأة في هذا النص.\", \"en\": \"There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable\"}', '1651008957_ca9ffc0170ff5ef6.png', '[\"1\",\"2\"]', 50, 2, '2022-07-01', '10:00', NULL, 0, 1, '{\"1\": {\"id\": \"2\", \"fees\": \"20\"}, \"2\": {\"id\": \"3\", \"fees\": \"10\"}}', 0, '2022-04-26 17:26:52', '2022-04-27 01:04:50'),
(24, 1, '{\"ar\": \"حزمة 1\", \"en\": \"Package 1\"}', '{\"ar\": \"هنالك العديد من الأنواع المتوفرة لنصوص لوريم إيبسوم، ولكن الغالبية تم تعديلها بشكل ما عبر إدخال بعض النوادر أو الكلمات العشوائية إلى النص. إن كنت تريد أن تستخدم نص لوريم إيبسوم ما، عليك أن تتحقق أولاً أن ليس هناك أي كلمات أو عبارات محرجة أو غير لائقة مخبأة في هذا النص.\", \"en\": \"There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable\"}', '1651008957_ca9ffc0170ff5ef6.png', '[\"1\",\"2\"]', 50, 2, '2022-07-01', '10:00', NULL, 0, 1, '{\"1\": {\"id\": \"2\", \"fees\": \"20\"}, \"2\": {\"id\": \"3\", \"fees\": \"10\"}}', 0, '2022-04-26 17:26:52', '2022-04-27 01:04:50');

-- --------------------------------------------------------

--
-- Table structure for table `package_orders`
--

CREATE TABLE `package_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `package_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `provider_id` bigint(20) UNSIGNED DEFAULT NULL,
  `count` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `fees` double(8,2) UNSIGNED NOT NULL,
  `tax` double(8,2) UNSIGNED DEFAULT NULL,
  `coupon_id` bigint(20) UNSIGNED DEFAULT NULL,
  `total` double(8,2) UNSIGNED DEFAULT NULL,
  `status` enum('pending','approved','rejected','paid','canceled') COLLATE utf8mb4_unicode_ci NOT NULL,
  `additional` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`additional`)),
  `user_notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider_notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin_notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_archive` tinyint(4) UNSIGNED NOT NULL DEFAULT 0,
  `provider_archive` tinyint(4) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `package_orders`
--

INSERT INTO `package_orders` (`id`, `package_id`, `user_id`, `provider_id`, `count`, `fees`, `tax`, `coupon_id`, `total`, `status`, `additional`, `user_notes`, `provider_notes`, `admin_notes`, `user_archive`, `provider_archive`, `created_at`, `updated_at`) VALUES
(1, 9, 1, 1, 2, 80.00, 12.00, NULL, 92.00, 'rejected', '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'test', NULL, 0, 0, '2022-04-14 05:48:57', '2022-05-10 22:04:05'),
(10, 9, 1, 1, 1, 50.00, 7.50, NULL, 57.50, 'approved', '', NULL, NULL, NULL, 0, 0, '2022-04-21 17:28:20', '2022-05-10 22:05:13'),
(11, 9, 1, 1, 1, 50.00, 7.50, NULL, 57.50, 'approved', '', NULL, NULL, NULL, 0, 0, '2022-04-21 17:29:36', '2022-04-21 17:29:36'),
(12, 9, 1, 1, 1, 50.00, 7.50, NULL, 57.50, 'approved', '', NULL, NULL, NULL, 0, 0, '2022-04-21 17:29:48', '2022-04-21 17:29:48'),
(13, 9, 1, 1, 1, 50.00, 7.50, NULL, 57.50, 'approved', '', NULL, NULL, NULL, 0, 0, '2022-04-21 17:30:52', '2022-04-21 17:30:52'),
(14, 9, 1, 1, 2, 100.00, 15.00, 1, 92.00, 'approved', '', NULL, NULL, NULL, 0, 0, '2022-04-21 17:32:16', '2022-04-21 17:32:16'),
(15, 9, 1, 1, 1, 50.00, 7.50, NULL, 57.50, 'approved', '', NULL, NULL, NULL, 0, 0, '2022-04-21 17:35:14', '2022-04-21 17:35:14'),
(16, 9, 1, 1, 1, 50.00, 7.50, NULL, 57.50, 'approved', '', NULL, NULL, NULL, 0, 0, '2022-04-25 03:18:28', '2022-04-25 03:18:28'),
(17, 9, 1, 1, 1, 50.00, 7.50, NULL, 57.50, 'approved', '', NULL, NULL, NULL, 0, 0, '2022-04-25 03:32:54', '2022-04-25 03:32:54'),
(18, 9, 1, 1, 1, 50.00, 7.50, NULL, 57.50, 'approved', '', NULL, NULL, NULL, 0, 0, '2022-04-25 03:42:42', '2022-04-25 03:42:42'),
(19, 9, 1, 1, 1, 50.00, 7.50, NULL, 57.50, 'approved', '', NULL, NULL, NULL, 0, 0, '2022-04-25 04:04:37', '2022-04-25 04:04:37'),
(20, 9, 1, 1, 1, 50.00, 7.50, NULL, 57.50, 'approved', '', NULL, NULL, NULL, 0, 0, '2022-04-28 04:04:55', '2022-04-25 04:04:55'),
(21, 9, 2, 1, 2, 100.00, 15.00, 1, 92.00, 'rejected', '', NULL, NULL, 'test', 0, 0, '2022-05-10 22:14:08', '2022-05-11 07:25:15'),
(22, 9, 5, 1, 2, 100.00, 15.00, NULL, 135.00, 'pending', '[{\"id\":\"2\",\"fees\":20,\"count\":\"1\"}]', NULL, NULL, NULL, 0, 0, '2022-05-25 11:05:53', '2022-05-25 11:05:53'),
(23, 9, 5, 1, 2, 100.00, 15.00, NULL, 175.00, 'pending', '[{\"id\":\"2\",\"fees\":60,\"count\":\"3\"}]', NULL, NULL, NULL, 0, 0, '2022-06-02 05:27:25', '2022-06-02 05:27:25'),
(24, 10, 5, 1, 1, 50.00, 7.50, NULL, 77.50, 'approved', '[{\"id\":\"3\",\"fees\":20,\"count\":\"2\"}]', NULL, NULL, NULL, 0, 0, '2022-06-02 05:28:41', '2022-06-02 05:28:41'),
(25, 9, 5, 1, 1, 50.00, 7.50, NULL, 77.50, 'approved', '[{\"id\":\"2\",\"fees\":20,\"count\":\"1\"}]', NULL, NULL, NULL, 0, 0, '2022-06-02 05:41:34', '2022-06-02 05:41:34'),
(26, 9, 5, 1, 1, 50.00, 7.50, NULL, 77.50, 'approved', '[{\"id\":\"2\",\"fees\":20,\"count\":\"1\"}]', NULL, NULL, NULL, 0, 0, '2022-06-02 05:41:58', '2022-06-02 05:41:58'),
(27, 9, 5, 1, 1, 50.00, 7.50, NULL, 57.50, 'approved', '[]', NULL, NULL, NULL, 0, 0, '2022-06-02 05:42:12', '2022-06-02 05:42:12');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('user@email.com', '$2y$10$ol3da27Xh.y.qRfA/8Uvaudy8M8mZ9qab7MeUYjt2w3WQLEOvuI8.', '2022-03-10 04:48:11'),
('test@provider.com', '$2y$10$B7FkdJvPjrWxdi3jIjnivuGENAvrLi.IEkjhTH9ipg8AQNNwGyc.m', '2022-03-17 02:02:23'),
('anaaml761@gmail.com', '$2y$10$Lr1uFNyYRoBIWebN4fOooO8GdfaMTaBGjyrLRGf2yACF3hoYb3laq', '2022-03-18 11:22:09'),
('acoad@email.com', '$2y$10$UxhGMg6G4hFFfso0BZC2UOeZSyBq3toN6gTLeLyPFvPxRXbX.7kMe', '2022-05-11 08:59:11');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `providers`
--

CREATE TABLE `providers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comm_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comm_reg_num` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comm_reg_img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tax_cert_num` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approve` tinyint(4) NOT NULL DEFAULT 0,
  `block` tinyint(4) NOT NULL DEFAULT 0,
  `block_notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verification_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_verification_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `phone_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rate` double(8,2) UNSIGNED DEFAULT 0.00,
  `cities` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`cities`)),
  `tax` double(8,2) UNSIGNED NOT NULL DEFAULT 15.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `providers`
--

INSERT INTO `providers` (`id`, `name`, `email`, `phone`, `comm_name`, `comm_reg_num`, `comm_reg_img`, `tax_cert_num`, `address`, `image`, `notes`, `approve`, `block`, `block_notes`, `email_verification_code`, `phone_verification_code`, `email_verified_at`, `phone_verified_at`, `remember_token`, `rate`, `cities`, `tax`, `created_at`, `updated_at`) VALUES
(1, 'Provider1', 'provider@email.com', '0552872008', 'Carrier Company', '1234567788', '1649920202_2-04-14-02_37_27.png', '85857', 'test address', '1647492288_7.jpg', 'Test Provider account added by the admin.', 1, 0, NULL, NULL, NULL, NULL, NULL, 'OTgFuHEQWIKlfc2Iqv26bl2fm6hKXaqekndx6JasK8mvuiGqqhjt9So9z0Hj', 2.67, '[\"2\", \"3\", \"4\"]', 15.00, '2022-03-17 00:44:48', '2022-04-25 21:02:39'),
(3, 'test comp.', 'test@provider.com', '0552872274', 'Test Comp.', '123456789', '1647939180_2-03-22-09_51_27.png', '12345', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '1647927713_8.jpg', NULL, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL, 15.00, '2022-03-17 01:41:39', '2022-03-28 00:40:58'),
(14, 'test', 'test2@provider.com', '0552563774', '', '', '', '', '', NULL, NULL, 0, 1, 'test account', '1qQuJnZVIY', NULL, '2022-03-21 20:00:00', NULL, 'r9o7VHCTr9q4znrDksHazg6yxRJY7oAF7fzhvHFZhhaF5KGoytPYXqzPWGOm', 0.00, NULL, 15.00, '2022-03-22 02:12:53', '2022-03-22 02:52:53'),
(17, 'Test create', 'test@create.com', '0556374464', 'test comm name', '567483762', '1647947068_2-03-22-09_51_27.png', '77777', 'test address', '1647947068_ages-for-website.jpg', NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL, 15.00, '2022-03-22 07:04:28', '2022-03-22 07:04:28'),
(18, 'Acoad', 'acoad@email.com', '0552639220', 'Acoad', '777333888', '1648025094_2-03-22-09_51_27.png', '88888', 'UAE', '1648442524_nyan-cat.gif', NULL, 1, 0, NULL, NULL, '$2y$10$zh00R6AQesL..QZXuu8dounCykUL3XJUFgq5bdp.pk2c7f5/VY3LK', NULL, '2022-03-22 20:00:00', NULL, 3.00, '[\"2\", \"3\", \"4\"]', 15.00, '2022-03-23 04:44:54', '2022-03-28 00:42:04'),
(20, 'Waleed Traviling', 'adminnnnnnnf@email.com', '0580386053', '6998566', '9965555555558', '1656499638_FOrCWCHaIAM-5OS.jpg', '11111222222222', 'khartoum,bahreee', NULL, NULL, 0, 0, NULL, NULL, '$2y$10$DQ/GDqZaC1m49m7GXZu83OL/d2YcqgXKxlkNNePaoYEUWEYugYC6y', NULL, '2022-06-29 08:48:38', NULL, 0.00, '[\"2\",\"3\",\"4\",\"5\"]', 15.00, '2022-06-29 08:47:18', '2022-06-29 08:48:38');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `trip_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `bus_order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `provider_id` bigint(20) UNSIGNED NOT NULL,
  `package_id` int(255) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rate` enum('1','2','3','4','5') COLLATE utf8mb4_unicode_ci NOT NULL,
  `review` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `publish` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`title`)),
  `text` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`text`)),
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `title`, `text`, `image`, `created_at`, `updated_at`) VALUES
(1, '{\"ar\": \"ما هو \\\"لوريم إيبسوم\\\"!\", \"en\": \"What is Lorem Ipsum!\"}', '{\"ar\": \"لوريم إيبسوم هو ببساطة نص شكلي (بمعنى أن الغاية هي الشكل وليس المحتوى) ويُستخدم في صناعات المطابع ودور النشر. كان لوريم إيبسوم ولايزال المعيار للنص الشكلي منذ القرن الخامس عشر عندما قامت مطبعة مجهولة برص مجموعة من الأحرف بشكل عشوائي أخذتها من نص، لتكوّن كتيّب بمثابة دليل أو مرجع شكلي لهذه الأحرف.\", \"en\": \"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.\"}', '1650516298_53.jpg', '2022-04-21 00:44:58', '2022-04-21 00:44:58'),
(2, '{\"ar\": \"أين أجده ؟\", \"en\": \"Where can I get some?\"}', '{\"ar\": \"هنالك العديد من الأنواع المتوفرة لنصوص لوريم إيبسوم، ولكن الغالبية تم تعديلها بشكل ما عبر إدخال بعض النوادر أو الكلمات العشوائية إلى النص. إن كنت تريد أن تستخدم نص لوريم إيبسوم ما، عليك أن تتحقق أولاً أن ليس هناك أي كلمات أو عبارات محرجة أو غير لائقة مخبأة في هذا النص.\", \"en\": \"There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable.\"}', '1650516554_48.jpg', '2022-04-21 00:49:14', '2022-04-21 00:49:14');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trans` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`trans`)),
  `type` enum('text','number','email','textarea','editor','checkbox','file','url') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'text',
  `group` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rules` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `trans`, `type`, `group`, `description`, `rules`, `created_at`, `updated_at`) VALUES
(1, 'logo', '1650376957QBUSBlue.png', NULL, 'file', 'general', 'Website general settings like logo, name ..', 'nullable|image', '2021-09-28 05:38:16', '2022-03-22 01:23:01'),
(2, 'logo-light', '1650376987expense-w - Copy.png', NULL, 'file', 'general', NULL, 'nullable|image', '2021-09-28 05:38:41', '2022-03-22 01:23:01'),
(3, 'meta-description', '', NULL, 'text', 'meta', 'Meta details, medatory for SEO.', 'required|string|max:255', '2021-09-28 05:40:06', '2021-09-29 01:11:37'),
(4, 'meta-keywords', '', NULL, 'text', 'meta', NULL, 'required|string|max:255', '2021-09-28 05:40:26', '2021-09-29 01:11:37'),
(5, 'twitter', 'https://twitter.com/', NULL, 'url', 'social', 'Social links in wesite footer.', 'nullable|url', '2021-09-28 06:25:08', NULL),
(6, 'facebook', 'https://www.facebook.com/', NULL, 'url', 'social', NULL, 'nullable|url', '2021-09-28 06:25:08', NULL),
(7, 'instagram', 'https://www.instagram.com/', NULL, 'url', 'social', NULL, 'nullable|url', '2021-09-28 06:25:08', NULL),
(8, 'youtube', 'https://www.youtube.com/', NULL, 'url', 'social', NULL, 'nullable|url', '2021-09-28 06:25:08', NULL),
(9, 'qbus_percentage', '10', NULL, 'number', 'payments', 'payment settings ', 'required|numeric|min:0|max:100', '2022-04-20 04:56:31', NULL),
(10, 'about_title', NULL, '{\"ar\":\"\\u0645\\u0646 \\u0646\\u062d\\u0646\",\"en\":\"About Us\",\"ur\":\"About Us\"}', 'text', 'about', 'about page settings', 'required|string|max:100', '2022-04-20 08:32:00', '2022-05-28 11:23:54'),
(11, 'about_subtitle', NULL, '{\"ar\":\"\\u062a\\u0639\\u0631\\u0641 \\u0639\\u0644\\u064a\\u0646\\u0627\",\"en\":\"Get to know us\",\"ur\":\"Get to know us\"}', 'text', 'about', 'about page settings', 'required|string|max:255', '2022-04-20 08:32:00', '2022-05-28 11:23:54'),
(12, 'about_text', NULL, '{\"ar\":\"\\u0647\\u0646\\u0627\\u0643 \\u062d\\u0642\\u064a\\u0642\\u0629 \\u0645\\u062b\\u0628\\u062a\\u0629 \\u0645\\u0646\\u0630 \\u0632\\u0645\\u0646 \\u0637\\u0648\\u064a\\u0644 \\u0648\\u0647\\u064a \\u0623\\u0646 \\u0627\\u0644\\u0645\\u062d\\u062a\\u0648\\u0649 \\u0627\\u0644\\u0645\\u0642\\u0631\\u0648\\u0621 \\u0644\\u0635\\u0641\\u062d\\u0629 \\u0645\\u0627 \\u0633\\u064a\\u0644\\u0647\\u064a \\u0627\\u0644\\u0642\\u0627\\u0631\\u0626 \\u0639\\u0646 \\u0627\\u0644\\u062a\\u0631\\u0643\\u064a\\u0632 \\u0639\\u0644\\u0649 \\u0627\\u0644\\u0634\\u0643\\u0644 \\u0627\\u0644\\u062e\\u0627\\u0631\\u062c\\u064a \\u0644\\u0644\\u0646\\u0635 \\u0623\\u0648 \\u0634\\u0643\\u0644 \\u062a\\u0648\\u0636\\u0639 \\u0627\\u0644\\u0641\\u0642\\u0631\\u0627\\u062a \\u0641\\u064a \\u0627\\u0644\\u0635\\u0641\\u062d\\u0629 \\u0627\\u0644\\u062a\\u064a \\u064a\\u0642\\u0631\\u0623\\u0647\\u0627. \\u0648\\u0644\\u0630\\u0644\\u0643 \\u064a\\u062a\\u0645 \\u0627\\u0633\\u062a\\u062e\\u062f\\u0627\\u0645 \\u0637\\u0631\\u064a\\u0642\\u0629 \\u0644\\u0648\\u0631\\u064a\\u0645 \\u0625\\u064a\\u0628\\u0633\\u0648\\u0645 \\u0644\\u0623\\u0646\\u0647\\u0627 \\u062a\\u0639\\u0637\\u064a \\u062a\\u0648\\u0632\\u064a\\u0639\\u0627\\u064e \\u0637\\u0628\\u064a\\u0639\\u064a\\u0627\\u064e -\\u0625\\u0644\\u0649 \\u062d\\u062f \\u0645\\u0627- \\u0644\\u0644\\u0623\\u062d\\u0631\\u0641 \\u0639\\u0648\\u0636\\u0627\\u064b \\u0639\\u0646 \\u0627\\u0633\\u062a\\u062e\\u062f\\u0627\\u0645 \\\"\\u0647\\u0646\\u0627 \\u064a\\u0648\\u062c\\u062f \\u0645\\u062d\\u062a\\u0648\\u0649 \\u0646\\u0635\\u064a\\u060c \\u0647\\u0646\\u0627 \\u064a\\u0648\\u062c\\u062f \\u0645\\u062d\\u062a\\u0648\\u0649 \\u0646\\u0635\\u064a\\\" \\u0641\\u062a\\u062c\\u0639\\u0644\\u0647\\u0627 \\u062a\\u0628\\u062f\\u0648 (\\u0623\\u064a \\u0627\\u0644\\u0623\\u062d\\u0631\\u0641) \\u0648\\u0643\\u0623\\u0646\\u0647\\u0627 \\u0646\\u0635 \\u0645\\u0642\\u0631\\u0648\\u0621. \\u0627\\u0644\\u0639\\u062f\\u064a\\u062f \\u0645\\u0646 \\u0628\\u0631\\u0627\\u0645\\u062d \\u0627\\u0644\\u0646\\u0634\\u0631 \\u0627\\u0644\\u0645\\u0643\\u062a\\u0628\\u064a \\u0648\\u0628\\u0631\\u0627\\u0645\\u062d \\u062a\\u062d\\u0631\\u064a\\u0631 \\u0635\\u0641\\u062d\\u0627\\u062a \\u0627\\u0644\\u0648\\u064a\\u0628 \\u062a\\u0633\\u062a\\u062e\\u062f\\u0645 \\u0644\\u0648\\u0631\\u064a\\u0645 \\u0625\\u064a\\u0628\\u0633\\u0648\\u0645 \\u0628\\u0634\\u0643\\u0644 \\u0625\\u0641\\u062a\\u0631\\u0627\\u0636\\u064a \\u0643\\u0646\\u0645\\u0648\\u0630\\u062c \\u0639\\u0646 \\u0627\\u0644\\u0646\\u0635\\u060c \\u0648\\u0625\\u0630\\u0627 \\u0642\\u0645\\u062a \\u0628\\u0625\\u062f\\u062e\\u0627\\u0644 \\\"lorem ipsum\\\" \\u0641\\u064a \\u0623\\u064a \\u0645\\u062d\\u0631\\u0643 \\u0628\\u062d\\u062b \\u0633\\u062a\\u0638\\u0647\\u0631 \\u0627\\u0644\\u0639\\u062f\\u064a\\u062f \\u0645\\u0646 \\u0627\\u0644\\u0645\\u0648\\u0627\\u0642\\u0639 \\u0627\\u0644\\u062d\\u062f\\u064a\\u062b\\u0629 \\u0627\\u0644\\u0639\\u0647\\u062f \\u0641\\u064a \\u0646\\u062a\\u0627\\u0626\\u062c \\u0627\\u0644\\u0628\\u062d\\u062b. \\u0639\\u0644\\u0649 \\u0645\\u062f\\u0649 \\u0627\\u0644\\u0633\\u0646\\u064a\\u0646 \\u0638\\u0647\\u0631\\u062a \\u0646\\u0633\\u062e \\u062c\\u062f\\u064a\\u062f\\u0629 \\u0648\\u0645\\u062e\\u062a\\u0644\\u0641\\u0629 \\u0645\\u0646 \\u0646\\u0635 \\u0644\\u0648\\u0631\\u064a\\u0645 \\u0625\\u064a\\u0628\\u0633\\u0648\\u0645\\u060c \\u0623\\u062d\\u064a\\u0627\\u0646\\u0627\\u064b \\u0639\\u0646 \\u0637\\u0631\\u064a\\u0642 \\u0627\\u0644\\u0635\\u062f\\u0641\\u0629\\u060c \\u0648\\u0623\\u062d\\u064a\\u0627\\u0646\\u0627\\u064b \\u0639\\u0646 \\u0639\\u0645\\u062f \\u0643\\u0625\\u062f\\u062e\\u0627\\u0644 \\u0628\\u0639\\u0636 \\u0627\\u0644\\u0639\\u0628\\u0627\\u0631\\u0627\\u062a \\u0627\\u0644\\u0641\\u0643\\u0627\\u0647\\u064a\\u0629 \\u0625\\u0644\\u064a\\u0647\\u0627.\",\"en\":\"It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).<br><br>\",\"ur\":\"It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).<br><br>\"}', 'editor', 'about', NULL, 'required|string', '2022-04-21 01:45:50', '2022-05-28 11:23:54'),
(13, 'about_image', '165050955222.jpg', NULL, 'file', 'about', NULL, 'nullable|image', '2022-04-21 01:54:51', '2022-04-20 22:52:32'),
(14, 'features_title', 'explore our<br> awesome Featuers', '{\"ur\":\"ur\",\"ar\":\"ar\",\"en\":\"en\"}', 'text', 'about', NULL, 'required|string|max:255', '2022-04-21 04:08:56', '2022-05-28 11:24:14'),
(15, 'services_title', NULL, '{\"ar\": \"خدماتنا\", \"en\": \"Our services\"}', 'text', 'user interface', 'Frontend user interface settings', 'required|string|max:100', '2022-04-21 04:38:17', '2022-04-21 00:41:28'),
(16, 'services_subtitle', NULL, '{\"ar\": \"تعرف على خدماتنا الان !\", \"en\": \"Explore our services now!\"}', 'text', 'user interface', 'Frontend user interface settings', 'required|string|max:255', '2022-04-21 04:38:17', '2022-04-21 00:41:28'),
(17, 'location', 'UAE, Dubai', '{\"ar\": \"دبي ، الامارات\", \"en\": \"Dubai, UAE\"}', 'text', 'contact', NULL, 'required|string|max:255', '2022-04-21 05:23:11', '2022-04-21 01:33:39'),
(18, 'email', 'anaaml761@gmail.com', NULL, 'email', 'contact', NULL, 'required|email', '2022-04-21 05:24:57', '2022-04-21 01:28:08'),
(19, 'phone', '971552872008', NULL, 'text', 'contact', NULL, 'required', '2022-04-21 05:25:23', '2022-04-21 01:28:08'),
(20, 'copyright', NULL, '{\"ar\": \"©  جميع الحقوق محفوظة\", \"en\": \"© Copyright 2022. All Rights Reserved.\"}', 'text', 'footer', 'User interface Footer settings', 'required|string|max:255', '2022-04-21 05:31:58', '2022-04-21 01:33:39'),
(21, 'email2', NULL, NULL, 'email', 'contact', NULL, 'nullable|email', '2022-04-21 05:35:10', NULL),
(22, 'phone2', NULL, NULL, 'text', 'contact', NULL, 'nullable|string|max:255', '2022-04-21 05:35:34', NULL),
(23, 'contact_title', NULL, '{\"ar\": \"تواصل معنا\", \"en\": \"Contact us\"}', 'text', 'user interface', NULL, 'required|string|max:200', '2022-04-21 05:49:00', '2022-04-21 01:50:23'),
(24, 'contact_subtitle', NULL, '{\"ar\": \"ابق على تواصل!\", \"en\": \"Keep in touch!\"}', 'text', 'user interface', NULL, 'required|string|max:255', '2022-04-21 05:49:26', '2022-04-21 01:50:23'),
(25, 'links_title', NULL, '{\"ar\": \"روابط\", \"en\": \"Links\"}', 'text', 'footer', NULL, 'required|string|max:100', '2022-04-21 06:08:38', '2022-04-21 02:14:48'),
(26, 'download_title', NULL, '{\"ar\": \"التواصل الاجتماعي\", \"en\": \"Social Media\"}', 'text', 'footer', NULL, 'required|string|max:100', '2022-04-21 06:09:00', '2022-04-21 02:14:48'),
(27, 'contact_title', NULL, '{\"ar\": \"اتصل بنا\", \"en\": \"Contact Us\"}', 'text', 'footer', NULL, 'required|string|max:255', '2022-04-21 06:09:26', '2022-04-21 02:14:48'),
(28, 'provider_title', NULL, '{\"ar\": \"روابط شركات النقل\", \"en\": \"Carrier Links\"}', 'text', 'footer', NULL, 'required|string|max:100', '2022-04-21 06:09:48', '2022-04-21 02:14:48'),
(29, 'provider_subtitle', NULL, '{\"ar\": \"انضم الينا الان كموفر خدمات وامتلك عملاءك! الأمر سهل.\", \"en\": \"Join us now as a provider and have your own customers! it\'s easy.\"}', 'text', 'footer', NULL, 'required|string', '2022-04-21 06:10:09', '2022-04-21 02:14:48'),
(30, 'email_title', NULL, '{\"ar\": \"انصم وتابعنا\", \"en\": \"Join and follow us\"}', 'text', 'footer', NULL, 'required|string|max:255', '2022-04-21 06:21:51', '2022-04-21 02:25:58'),
(31, 'feedback_title', NULL, '{\"ar\": \"رأيك يهمنا\", \"en\": \"Feedback Note\"}', 'text', 'footer', NULL, 'required|string|max:100', '2022-04-21 06:40:33', '2022-04-21 02:46:09'),
(32, 'feedback_subtitle', NULL, '{\"ar\": \"يسعدنا استقبال ارائكم وملاحظاتكم\", \"en\": \"We are pleased to receive your opinions and comments\"}', 'text', 'footer', NULL, 'required|string|max:255', '2022-04-21 06:40:58', '2022-04-21 02:46:09'),
(33, 'feedback_footer', NULL, '{\"ar\": \"من فضلك تأكد أننا نراجع الملاحظات ونقدر مساعدتك لنا.\", \"en\": \"Please make sure we review the feedback and appreciate your help.\"}', 'text', 'footer', NULL, 'nullable|string|max:255', '2022-04-21 06:41:19', '2022-04-21 02:46:09'),
(34, 'header_image', '165052474520.jpg', NULL, 'file', 'home', 'Home page settings', 'nullable|image', '2022-04-21 06:54:54', '2022-04-21 03:05:45'),
(35, 'section_title', NULL, '{\"ar\": \"احجز <span  class=\\\"text-blue-600 dark:text-blue-400\\\">باص كامل</span>\", \"en\": \"Order <span  class=\\\"text-blue-600 dark:text-blue-400\\\">a Full Bus</span>\"}', 'text', 'home', NULL, 'required|string|max:255', '2022-04-21 06:55:45', '2022-04-21 03:05:45'),
(36, 'section_text', NULL, '{\"ar\": \"هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام \\\"هنا يوجد محتوى نصي، هنا يوجد محتوى نصي\\\" فتجعلها تبدو (أي الأحرف) وكأنها نص مقروء. العديد من برامح النشر المكتبي وبرامح تحرير صفحات الويب تستخدم لوريم إيبسوم بشكل إفتراضي كنموذج عن النص، وإذا قمت بإدخال\", \"en\": \"Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quidem 55odi reprehenderit vitae exercitationem aliquid dolores ullam temporibus enim expedita aperiam mollitia iure 55onsectetur dicta tenetur, porro consequuntur saepe accusantium consequatur.\"}', 'textarea', 'home', NULL, 'required|string', '2022-04-21 06:56:10', '2022-04-21 03:05:45'),
(37, 'section_link', 'https://demos.acoad.net/qbus/busOrders/create', NULL, 'url', 'home', NULL, 'required|url', '2022-04-21 06:56:51', '2022-04-21 03:06:36'),
(38, 'google-play', NULL, NULL, 'text', 'application', 'Mobile app links', 'required|url', '2022-04-26 17:16:25', NULL),
(39, 'app-store', NULL, NULL, 'text', 'application', NULL, 'required|url', '2022-04-26 17:16:46', NULL),
(40, 'privacy_policy', NULL, '{\"ur\":\"It is a long established fact that a reader will be distracted by the \\r\\nreadable content of a page when looking at its layout. The point of \\r\\nusing Lorem Ipsum is that it has a more-or-less normal distribution of \\r\\nletters, as opposed to using \'Content here, content here\', making it \\r\\nlook like readable English. Many desktop publishing packages and web \\r\\npage editors now use Lorem Ipsum as their default model text, and a \\r\\nsearch for \'lorem ipsum\' will uncover many web sites still in their \\r\\ninfancy. Various versions have evolved over the years, sometimes by \\r\\naccident, sometimes on purpose (injected humour and the like).<br><br><br><br>\",\"ar\":\"\\u0647\\u0646\\u0627\\u0643 \\u062d\\u0642\\u064a\\u0642\\u0629 \\u0645\\u062b\\u0628\\u062a\\u0629 \\u0645\\u0646\\u0630 \\u0632\\u0645\\u0646 \\u0637\\u0648\\u064a\\u0644 \\u0648\\u0647\\u064a \\u0623\\u0646 \\u0627\\u0644\\u0645\\u062d\\u062a\\u0648\\u0649 \\u0627\\u0644\\u0645\\u0642\\u0631\\u0648\\u0621 \\u0644\\u0635\\u0641\\u062d\\u0629 \\u0645\\u0627 \\u0633\\u064a\\u0644\\u0647\\u064a \\r\\n\\u0627\\u0644\\u0642\\u0627\\u0631\\u0626 \\u0639\\u0646 \\u0627\\u0644\\u062a\\u0631\\u0643\\u064a\\u0632 \\u0639\\u0644\\u0649 \\u0627\\u0644\\u0634\\u0643\\u0644 \\u0627\\u0644\\u062e\\u0627\\u0631\\u062c\\u064a \\u0644\\u0644\\u0646\\u0635 \\u0623\\u0648 \\u0634\\u0643\\u0644 \\u062a\\u0648\\u0636\\u0639 \\u0627\\u0644\\u0641\\u0642\\u0631\\u0627\\u062a \\u0641\\u064a \\u0627\\u0644\\u0635\\u0641\\u062d\\u0629 \\r\\n\\u0627\\u0644\\u062a\\u064a \\u064a\\u0642\\u0631\\u0623\\u0647\\u0627. \\u0648\\u0644\\u0630\\u0644\\u0643 \\u064a\\u062a\\u0645 \\u0627\\u0633\\u062a\\u062e\\u062f\\u0627\\u0645 \\u0637\\u0631\\u064a\\u0642\\u0629 \\u0644\\u0648\\u0631\\u064a\\u0645 \\u0625\\u064a\\u0628\\u0633\\u0648\\u0645 \\u0644\\u0623\\u0646\\u0647\\u0627 \\u062a\\u0639\\u0637\\u064a \\u062a\\u0648\\u0632\\u064a\\u0639\\u0627\\u064e \\r\\n\\u0637\\u0628\\u064a\\u0639\\u064a\\u0627\\u064e -\\u0625\\u0644\\u0649 \\u062d\\u062f \\u0645\\u0627- \\u0644\\u0644\\u0623\\u062d\\u0631\\u0641 \\u0639\\u0648\\u0636\\u0627\\u064b \\u0639\\u0646 \\u0627\\u0633\\u062a\\u062e\\u062f\\u0627\\u0645 \\\"\\u0647\\u0646\\u0627 \\u064a\\u0648\\u062c\\u062f \\u0645\\u062d\\u062a\\u0648\\u0649 \\u0646\\u0635\\u064a\\u060c \\u0647\\u0646\\u0627 \\r\\n\\u064a\\u0648\\u062c\\u062f \\u0645\\u062d\\u062a\\u0648\\u0649 \\u0646\\u0635\\u064a\\\" \\u0641\\u062a\\u062c\\u0639\\u0644\\u0647\\u0627 \\u062a\\u0628\\u062f\\u0648 (\\u0623\\u064a \\u0627\\u0644\\u0623\\u062d\\u0631\\u0641) \\u0648\\u0643\\u0623\\u0646\\u0647\\u0627 \\u0646\\u0635 \\u0645\\u0642\\u0631\\u0648\\u0621. \\u0627\\u0644\\u0639\\u062f\\u064a\\u062f \\u0645\\u0646 \\r\\n\\u0628\\u0631\\u0627\\u0645\\u062d \\u0627\\u0644\\u0646\\u0634\\u0631 \\u0627\\u0644\\u0645\\u0643\\u062a\\u0628\\u064a \\u0648\\u0628\\u0631\\u0627\\u0645\\u062d \\u062a\\u062d\\u0631\\u064a\\u0631 \\u0635\\u0641\\u062d\\u0627\\u062a \\u0627\\u0644\\u0648\\u064a\\u0628 \\u062a\\u0633\\u062a\\u062e\\u062f\\u0645 \\u0644\\u0648\\u0631\\u064a\\u0645 \\u0625\\u064a\\u0628\\u0633\\u0648\\u0645 \\u0628\\u0634\\u0643\\u0644 \\r\\n\\u0625\\u0641\\u062a\\u0631\\u0627\\u0636\\u064a \\u0643\\u0646\\u0645\\u0648\\u0630\\u062c \\u0639\\u0646 \\u0627\\u0644\\u0646\\u0635\\u060c \\u0648\\u0625\\u0630\\u0627 \\u0642\\u0645\\u062a \\u0628\\u0625\\u062f\\u062e\\u0627\\u0644 \\\"lorem ipsum\\\" \\u0641\\u064a \\u0623\\u064a \\u0645\\u062d\\u0631\\u0643 \\u0628\\u062d\\u062b \\r\\n\\u0633\\u062a\\u0638\\u0647\\u0631 \\u0627\\u0644\\u0639\\u062f\\u064a\\u062f \\u0645\\u0646 \\u0627\\u0644\\u0645\\u0648\\u0627\\u0642\\u0639 \\u0627\\u0644\\u062d\\u062f\\u064a\\u062b\\u0629 \\u0627\\u0644\\u0639\\u0647\\u062f \\u0641\\u064a \\u0646\\u062a\\u0627\\u0626\\u062c \\u0627\\u0644\\u0628\\u062d\\u062b. \\u0639\\u0644\\u0649 \\u0645\\u062f\\u0649 \\u0627\\u0644\\u0633\\u0646\\u064a\\u0646 \\r\\n\\u0638\\u0647\\u0631\\u062a \\u0646\\u0633\\u062e \\u062c\\u062f\\u064a\\u062f\\u0629 \\u0648\\u0645\\u062e\\u062a\\u0644\\u0641\\u0629 \\u0645\\u0646 \\u0646\\u0635 \\u0644\\u0648\\u0631\\u064a\\u0645 \\u0625\\u064a\\u0628\\u0633\\u0648\\u0645\\u060c \\u0623\\u062d\\u064a\\u0627\\u0646\\u0627\\u064b \\u0639\\u0646 \\u0637\\u0631\\u064a\\u0642 \\u0627\\u0644\\u0635\\u062f\\u0641\\u0629\\u060c \\r\\n\\u0648\\u0623\\u062d\\u064a\\u0627\\u0646\\u0627\\u064b \\u0639\\u0646 \\u0639\\u0645\\u062f \\u0643\\u0625\\u062f\\u062e\\u0627\\u0644 \\u0628\\u0639\\u0636 \\u0627\\u0644\\u0639\\u0628\\u0627\\u0631\\u0627\\u062a \\u0627\\u0644\\u0641\\u0643\\u0627\\u0647\\u064a\\u0629 \\u0625\\u0644\\u064a\\u0647\\u0627.<br>\",\"en\":\"It is a long established fact that a reader will be distracted by the \\r\\nreadable content of a page when looking at its layout. The point of \\r\\nusing Lorem Ipsum is that it has a more-or-less normal distribution of \\r\\nletters, as opposed to using \'Content here, content here\', making it \\r\\nlook like readable English. Many desktop publishing packages and web \\r\\npage editors now use Lorem Ipsum as their default model text, and a \\r\\nsearch for \'lorem ipsum\' will uncover many web sites still in their \\r\\ninfancy. Various versions have evolved over the years, sometimes by \\r\\naccident, sometimes on purpose (injected humour and the like).<br><br><br><br>\"}', 'editor', 'privacy_policy', 'Frontend user interface settings', 'required|string', '2022-04-21 01:45:50', '2022-06-09 10:41:19'),
(41, 'return_policy', NULL, '{\"ur\":\"ur\",\"ar\":\"ar\",\"en\":\"en\"}', 'editor', 'return_policy', 'Frontend user interface settings', 'required|string', '2022-04-21 01:45:50', '2022-05-28 12:15:26');

-- --------------------------------------------------------

--
-- Table structure for table `terminals`
--

CREATE TABLE `terminals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `provider_id` bigint(20) UNSIGNED NOT NULL,
  `name` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`name`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `terminals`
--

INSERT INTO `terminals` (`id`, `provider_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, '{\"ar\": \"محطة أ\", \"en\": \"Station A\"}', '2022-04-25 19:36:48', '2022-04-25 19:38:00'),
(2, 1, '{\"ar\": \"محطة ب\", \"en\": \"Station B\"}', '2022-04-25 19:37:27', '2022-04-25 19:37:51'),
(3, 1, '{\"ar\": \"محطة ج\", \"en\": \"Station C\"}', '2022-04-25 19:37:42', '2022-04-25 19:37:42');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `trip_order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `package_order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `seat_num` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `trip_order_id`, `package_order_id`, `seat_num`, `created_at`, `updated_at`) VALUES
(32, NULL, 10, 1, '2022-05-10 22:05:13', '2022-05-10 22:05:13'),
(39, 29, NULL, 1, '2022-05-26 13:16:08', '2022-05-26 13:16:08'),
(40, 29, NULL, 2, '2022-05-26 13:16:08', '2022-05-26 13:16:08'),
(41, 30, NULL, 3, '2022-06-02 05:21:49', '2022-06-02 05:21:49'),
(42, NULL, 24, 1, '2022-06-02 05:28:41', '2022-06-02 05:28:41'),
(43, 31, NULL, 4, '2022-06-02 05:30:09', '2022-06-02 05:30:09'),
(44, 31, NULL, 5, '2022-06-02 05:30:09', '2022-06-02 05:30:09'),
(45, NULL, 25, 2, '2022-06-02 05:41:34', '2022-06-02 05:41:34'),
(46, NULL, 26, 3, '2022-06-02 05:41:58', '2022-06-02 05:41:58'),
(47, NULL, 27, 4, '2022-06-02 05:42:12', '2022-06-02 05:42:12'),
(48, 32, NULL, 6, '2022-06-02 05:52:08', '2022-06-02 05:52:08'),
(49, 33, NULL, 1, '2022-06-02 06:17:39', '2022-06-02 06:17:39'),
(50, 34, NULL, 2, '2022-06-02 06:19:24', '2022-06-02 06:19:24'),
(51, 35, NULL, 7, '2022-06-02 06:30:12', '2022-06-02 06:30:12'),
(52, 36, NULL, 3, '2022-06-02 06:30:51', '2022-06-02 06:30:51'),
(53, 36, NULL, 4, '2022-06-02 06:30:51', '2022-06-02 06:30:51'),
(54, 37, NULL, 8, '2022-06-02 06:31:45', '2022-06-02 06:31:45'),
(55, 38, NULL, 9, '2022-06-02 06:33:38', '2022-06-02 06:33:38'),
(56, 39, NULL, 10, '2022-06-02 06:34:47', '2022-06-02 06:34:47'),
(57, 40, NULL, 11, '2022-06-02 06:35:25', '2022-06-02 06:35:25'),
(58, 41, NULL, 12, '2022-06-02 06:35:56', '2022-06-02 06:35:56'),
(59, 42, NULL, 13, '2022-06-02 06:38:20', '2022-06-02 06:38:20'),
(60, 43, NULL, 14, '2022-06-02 06:39:30', '2022-06-02 06:39:30'),
(61, 44, NULL, 15, '2022-06-02 06:39:55', '2022-06-02 06:39:55'),
(62, 45, NULL, 16, '2022-06-02 06:40:05', '2022-06-02 06:40:05'),
(63, 46, NULL, 17, '2022-06-02 06:40:37', '2022-06-02 06:40:37'),
(64, 47, NULL, 18, '2022-06-02 06:41:24', '2022-06-02 06:41:24'),
(65, 48, NULL, 19, '2022-06-02 06:42:24', '2022-06-02 06:42:24'),
(66, 49, NULL, 20, '2022-06-02 06:43:20', '2022-06-02 06:43:20'),
(67, 50, NULL, 21, '2022-06-02 06:44:07', '2022-06-02 06:44:07'),
(68, 51, NULL, 22, '2022-06-02 06:46:04', '2022-06-02 06:46:04'),
(69, 52, NULL, 23, '2022-06-03 11:02:52', '2022-06-03 11:02:52'),
(70, 53, NULL, 24, '2022-06-03 11:02:58', '2022-06-03 11:02:58'),
(71, 54, NULL, 25, '2022-06-03 11:06:16', '2022-06-03 11:06:16'),
(72, 55, NULL, 26, '2022-06-03 12:08:21', '2022-06-03 12:08:21'),
(73, 56, NULL, 27, '2022-06-03 12:15:57', '2022-06-03 12:15:57'),
(74, 57, NULL, 28, '2022-06-03 12:16:32', '2022-06-03 12:16:32'),
(75, 58, NULL, 29, '2022-06-03 12:16:58', '2022-06-03 12:16:58'),
(76, 59, NULL, 30, '2022-06-03 12:23:18', '2022-06-03 12:23:18'),
(77, 60, NULL, 31, '2022-06-03 12:24:42', '2022-06-03 12:24:42'),
(78, 60, NULL, 32, '2022-06-03 12:24:42', '2022-06-03 12:24:42'),
(79, 61, NULL, 33, '2022-06-03 12:25:01', '2022-06-03 12:25:01'),
(80, 61, NULL, 34, '2022-06-03 12:25:01', '2022-06-03 12:25:01'),
(81, 62, NULL, 35, '2022-06-03 12:25:40', '2022-06-03 12:25:40'),
(82, 63, NULL, 36, '2022-06-03 12:26:02', '2022-06-03 12:26:02'),
(83, 64, NULL, 37, '2022-06-03 12:51:40', '2022-06-03 12:51:40'),
(84, 65, NULL, 38, '2022-06-03 12:54:24', '2022-06-03 12:54:24'),
(85, 66, NULL, 39, '2022-06-04 06:02:38', '2022-06-04 06:02:38'),
(86, 67, NULL, 40, '2022-06-04 06:05:45', '2022-06-04 06:05:45'),
(87, 68, NULL, 41, '2022-06-04 06:10:44', '2022-06-04 06:10:44'),
(88, 69, NULL, 42, '2022-06-04 06:26:18', '2022-06-04 06:26:18'),
(89, 70, NULL, 43, '2022-06-04 06:26:51', '2022-06-04 06:26:51'),
(90, 71, NULL, 44, '2022-06-04 06:37:33', '2022-06-04 06:37:33'),
(91, 72, NULL, 45, '2022-06-04 06:38:17', '2022-06-04 06:38:17'),
(92, 73, NULL, 46, '2022-06-04 06:43:44', '2022-06-04 06:43:44'),
(93, 74, NULL, 47, '2022-06-04 06:44:37', '2022-06-04 06:44:37'),
(94, 75, NULL, 48, '2022-06-04 06:45:40', '2022-06-04 06:45:40'),
(95, 76, NULL, 49, '2022-06-04 06:46:38', '2022-06-04 06:46:38'),
(96, 77, NULL, 50, '2022-06-04 06:49:36', '2022-06-04 06:49:36'),
(97, 78, NULL, 51, '2022-06-04 06:50:08', '2022-06-04 06:50:08'),
(98, 78, NULL, 52, '2022-06-04 06:50:08', '2022-06-04 06:50:08'),
(99, 79, NULL, 53, '2022-06-04 06:51:33', '2022-06-04 06:51:33'),
(100, 79, NULL, 54, '2022-06-04 06:51:33', '2022-06-04 06:51:33'),
(101, 79, NULL, 55, '2022-06-04 06:51:33', '2022-06-04 06:51:33'),
(102, 80, NULL, 56, '2022-06-04 06:53:54', '2022-06-04 06:53:54'),
(103, 80, NULL, 57, '2022-06-04 06:53:54', '2022-06-04 06:53:54'),
(104, 80, NULL, 58, '2022-06-04 06:53:54', '2022-06-04 06:53:54'),
(105, 81, NULL, 59, '2022-06-04 06:57:40', '2022-06-04 06:57:40'),
(106, 82, NULL, 60, '2022-06-04 06:58:10', '2022-06-04 06:58:10'),
(107, 83, NULL, 1, '2022-06-04 07:04:54', '2022-06-04 07:04:54'),
(108, 83, NULL, 2, '2022-06-04 07:04:54', '2022-06-04 07:04:54'),
(109, 84, NULL, 61, '2022-06-04 07:05:40', '2022-06-04 07:05:40'),
(110, 85, NULL, 62, '2022-06-04 07:09:30', '2022-06-04 07:09:30'),
(111, 86, NULL, 3, '2022-06-04 07:10:26', '2022-06-04 07:10:26'),
(112, 86, NULL, 4, '2022-06-04 07:10:26', '2022-06-04 07:10:26'),
(113, 87, NULL, 5, '2022-06-04 07:11:07', '2022-06-04 07:11:07'),
(114, 88, NULL, 6, '2022-06-04 07:12:37', '2022-06-04 07:12:37'),
(115, 89, NULL, 63, '2022-06-04 07:13:09', '2022-06-04 07:13:09'),
(116, 90, NULL, 64, '2022-06-04 07:17:40', '2022-06-04 07:17:40'),
(117, 91, NULL, 7, '2022-06-04 07:18:23', '2022-06-04 07:18:23');

-- --------------------------------------------------------

--
-- Table structure for table `trips`
--

CREATE TABLE `trips` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`name`)),
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`description`)),
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_from` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_to` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_from` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_to` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lng` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zoom` int(11) DEFAULT NULL,
  `provider_id` bigint(20) UNSIGNED DEFAULT NULL,
  `bus_id` bigint(20) UNSIGNED DEFAULT NULL,
  `fees` double DEFAULT NULL,
  `max` int(10) UNSIGNED DEFAULT NULL,
  `provider_notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider_archive` tinyint(4) UNSIGNED NOT NULL DEFAULT 0,
  `auto_approve` tinyint(4) UNSIGNED NOT NULL DEFAULT 0,
  `rate` double(8,2) UNSIGNED DEFAULT 0.00,
  `destination_id` bigint(20) UNSIGNED DEFAULT NULL,
  `additional` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`additional`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trips`
--

INSERT INTO `trips` (`id`, `name`, `description`, `image`, `date_from`, `date_to`, `time_from`, `time_to`, `lat`, `lng`, `zoom`, `provider_id`, `bus_id`, `fees`, `max`, `provider_notes`, `provider_archive`, `auto_approve`, `rate`, `destination_id`, `additional`, `created_at`, `updated_at`) VALUES
(35, NULL, '{\"en\":null}', NULL, '2022-06-30', '2022-05-31', '16:00', '17:00', NULL, NULL, NULL, 1, 3, 19, 150, NULL, 0, 1, 0.00, 1, '{\"1\":{\"id\":\"2\",\"fees\":\"20\"},\"2\":{\"id\":\"3\",\"fees\":\"10\"}}', '2022-05-25 11:00:13', '2022-05-29 07:42:26'),
(38, NULL, '{\"en\":null}', NULL, '2022-05-29', '2022-05-29', '17:00', '18:00', NULL, NULL, NULL, 1, 3, 29, 150, NULL, 0, 1, 0.00, 1, '{\"1\":{\"id\":\"2\",\"fees\":\"20\"},\"2\":{\"id\":\"3\",\"fees\":\"10\"}}', '2022-05-28 12:45:29', '2022-05-29 13:45:04'),
(40, NULL, '{\"en\":null}', NULL, '2022-06-04', '2022-06-04', '10:00', '11:00', NULL, NULL, NULL, 1, 3, 50, 150, NULL, 0, 1, 0.00, 1, '{\"1\":{\"id\":\"2\",\"fees\":\"20\"},\"2\":{\"id\":\"3\",\"fees\":\"10\"}}', '2022-05-29 13:22:17', '2022-05-31 04:18:44'),
(41, NULL, '{\"en\":null}', NULL, '2022-06-30', '2022-05-31', '16:00', '17:00', NULL, NULL, NULL, 1, 3, 19, 150, NULL, 0, 1, 0.00, 2, '{\"1\":{\"id\":\"2\",\"fees\":\"20\"},\"2\":{\"id\":\"3\",\"fees\":\"10\"}}', '2022-05-25 11:00:13', '2022-05-29 07:42:26');

-- --------------------------------------------------------

--
-- Table structure for table `trip_orders`
--

CREATE TABLE `trip_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `trip_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `provider_id` bigint(20) UNSIGNED DEFAULT NULL,
  `count` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `fees` double(8,2) UNSIGNED NOT NULL,
  `tax` double(8,2) UNSIGNED DEFAULT NULL,
  `coupon_id` bigint(20) UNSIGNED DEFAULT NULL,
  `total` double(8,2) UNSIGNED DEFAULT NULL,
  `type` enum('one-way','round','multi') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `additional` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`additional`)),
  `status` enum('pending','approved','rejected','paid','canceled') COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider_notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prev_trip_order_id` int(255) DEFAULT NULL,
  `admin_notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_archive` tinyint(4) UNSIGNED NOT NULL DEFAULT 0,
  `provider_archive` tinyint(4) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trip_orders`
--

INSERT INTO `trip_orders` (`id`, `trip_id`, `user_id`, `provider_id`, `count`, `fees`, `tax`, `coupon_id`, `total`, `type`, `additional`, `status`, `user_notes`, `provider_notes`, `prev_trip_order_id`, `admin_notes`, `user_archive`, `provider_archive`, `created_at`, `updated_at`) VALUES
(29, 35, 5, 1, 2, 38.00, 5.70, NULL, 48.70, 'multi', '[{\"id\":\"3\",\"fees\":5,\"count\":\"1\"}]', 'approved', NULL, NULL, NULL, NULL, 0, 0, '2022-05-26 13:16:08', '2022-05-26 13:16:08'),
(30, 35, 5, 1, 1, 19.00, 2.85, NULL, 21.85, 'multi', '[]', 'approved', NULL, NULL, NULL, NULL, 0, 0, '2022-06-02 05:21:49', '2022-06-02 05:21:49'),
(31, 35, 5, 1, 2, 38.00, 5.70, NULL, 48.70, 'round', '[{\"id\":\"3\",\"fees\":5,\"count\":\"1\"}]', 'approved', NULL, NULL, NULL, NULL, 0, 0, '2022-06-02 05:30:09', '2022-06-02 05:30:09'),
(32, 35, 5, 1, 1, 19.00, 2.85, NULL, 21.85, NULL, '[]', 'approved', NULL, NULL, NULL, NULL, 0, 0, '2022-06-02 05:52:08', '2022-06-02 05:52:08'),
(33, 40, 5, 1, 1, 50.00, 7.50, NULL, 57.50, NULL, '[]', 'approved', NULL, NULL, NULL, NULL, 0, 0, '2022-06-02 06:17:39', '2022-06-02 06:17:39'),
(34, 40, 5, 1, 1, 50.00, 7.50, NULL, 177.50, NULL, '[{\"id\":\"2\",\"fees\":100,\"count\":\"1\"},{\"id\":\"3\",\"fees\":20,\"count\":\"1\"}]', 'approved', NULL, NULL, NULL, NULL, 0, 0, '2022-06-02 06:19:24', '2022-06-02 06:19:24'),
(35, 35, 5, 1, 1, 19.00, 2.85, NULL, 21.85, NULL, '[]', 'approved', NULL, NULL, NULL, NULL, 0, 0, '2022-06-02 06:30:12', '2022-06-02 06:30:12'),
(36, 40, 5, 1, 2, 100.00, 15.00, NULL, 335.00, NULL, '[{\"id\":\"2\",\"fees\":200,\"count\":\"2\"},{\"id\":\"3\",\"fees\":20,\"count\":\"1\"}]', 'approved', NULL, NULL, NULL, NULL, 0, 0, '2022-06-02 06:30:50', '2022-06-02 06:30:50'),
(37, 35, 5, 1, 1, 19.00, 2.85, NULL, 21.85, NULL, '[]', 'approved', NULL, NULL, NULL, NULL, 0, 0, '2022-06-02 06:31:45', '2022-06-02 06:31:45'),
(38, 35, 5, 1, 1, 19.00, 2.85, NULL, 31.85, 'one-way', '[{\"id\":\"3\",\"fees\":10,\"count\":\"2\"}]', 'approved', NULL, NULL, NULL, NULL, 0, 0, '2022-06-02 06:33:38', '2022-06-02 06:33:38'),
(39, 35, 5, 1, 1, 19.00, 2.85, NULL, 31.85, NULL, '[{\"id\":\"3\",\"fees\":10,\"count\":\"2\"}]', 'approved', NULL, NULL, NULL, NULL, 0, 0, '2022-06-02 06:34:47', '2022-06-02 06:34:47'),
(40, 35, 5, 1, 1, 19.00, 2.85, NULL, 31.85, NULL, '[{\"id\":\"3\",\"fees\":10,\"count\":\"2\"}]', 'approved', NULL, NULL, NULL, NULL, 0, 0, '2022-06-02 06:35:25', '2022-06-02 06:35:25'),
(41, 35, 5, 1, 1, 19.00, 2.85, NULL, 21.85, NULL, '[]', 'approved', NULL, NULL, NULL, NULL, 0, 0, '2022-06-02 06:35:56', '2022-06-02 06:35:56'),
(42, 35, 5, 1, 1, 19.00, 2.85, NULL, 21.85, NULL, '[]', 'approved', NULL, NULL, NULL, NULL, 0, 0, '2022-06-02 06:38:20', '2022-06-02 06:38:20'),
(43, 35, 5, 1, 1, 19.00, 2.85, NULL, 21.85, NULL, '[]', 'approved', NULL, NULL, NULL, NULL, 0, 0, '2022-06-02 06:39:30', '2022-06-02 06:39:30'),
(44, 35, 5, 1, 1, 19.00, 2.85, NULL, 21.85, NULL, '[]', 'approved', NULL, NULL, NULL, NULL, 0, 0, '2022-06-02 06:39:55', '2022-06-02 06:39:55'),
(45, 35, 5, 1, 1, 19.00, 2.85, NULL, 21.85, NULL, '[]', 'approved', NULL, NULL, NULL, NULL, 0, 0, '2022-06-02 06:40:05', '2022-06-02 06:40:05'),
(46, 35, 5, 1, 1, 19.00, 2.85, NULL, 21.85, NULL, '[]', 'approved', NULL, NULL, NULL, NULL, 0, 0, '2022-06-02 06:40:37', '2022-06-02 06:40:37'),
(47, 35, 5, 1, 1, 19.00, 2.85, NULL, 21.85, NULL, '[]', 'approved', NULL, NULL, NULL, NULL, 0, 0, '2022-06-02 06:41:24', '2022-06-02 06:41:24'),
(48, 35, 5, 1, 1, 19.00, 2.85, NULL, 31.85, NULL, '[{\"id\":\"3\",\"fees\":10,\"count\":\"2\"}]', 'approved', NULL, NULL, NULL, NULL, 0, 0, '2022-06-02 06:42:24', '2022-06-02 06:42:24'),
(49, 35, 5, 1, 1, 19.00, 2.85, NULL, 31.85, NULL, '[{\"id\":\"3\",\"fees\":10,\"count\":\"2\"}]', 'approved', NULL, NULL, NULL, NULL, 0, 0, '2022-06-02 06:43:20', '2022-06-02 06:43:20'),
(50, 35, 5, 1, 1, 19.00, 2.85, NULL, 21.85, NULL, '[]', 'approved', NULL, NULL, NULL, NULL, 0, 0, '2022-06-02 06:44:07', '2022-06-02 06:44:07'),
(51, 35, 5, 1, 1, 19.00, 2.85, NULL, 21.85, NULL, '[]', 'approved', NULL, NULL, NULL, NULL, 0, 0, '2022-06-02 06:46:04', '2022-06-02 06:46:04'),
(52, 35, 5, 1, 1, 19.00, 2.85, NULL, 26.85, 'one-way', '[{\"id\":\"3\",\"fees\":5,\"count\":\"1\"}]', 'approved', NULL, NULL, NULL, NULL, 0, 0, '2022-06-03 11:02:52', '2022-06-03 11:02:52'),
(53, 35, 5, 1, 1, 19.00, 2.85, NULL, 26.85, 'one-way', '[{\"id\":\"3\",\"fees\":5,\"count\":\"1\"}]', 'approved', NULL, NULL, NULL, NULL, 0, 0, '2022-06-03 11:02:58', '2022-06-03 11:02:58'),
(54, 35, 5, 1, 1, 19.00, 2.85, NULL, 21.85, NULL, '[]', 'approved', NULL, NULL, NULL, NULL, 0, 0, '2022-06-03 11:06:16', '2022-06-03 11:06:16'),
(55, 35, 5, 1, 1, 19.00, 2.85, NULL, 26.85, 'one-way', '[{\"id\":\"3\",\"fees\":5,\"count\":\"1\"}]', 'approved', NULL, NULL, NULL, NULL, 0, 0, '2022-06-03 12:08:21', '2022-06-03 12:08:21'),
(56, 35, 5, 1, 1, 19.00, 2.85, NULL, 26.85, 'one-way', '[{\"id\":\"3\",\"fees\":5,\"count\":\"1\"}]', 'approved', NULL, NULL, NULL, NULL, 0, 0, '2022-06-03 12:15:57', '2022-06-03 12:15:57'),
(57, 35, 5, 1, 1, 19.00, 2.85, NULL, 26.85, 'one-way', '[{\"id\":\"3\",\"fees\":5,\"count\":\"1\"}]', 'approved', NULL, NULL, NULL, NULL, 0, 0, '2022-06-03 12:16:31', '2022-06-03 12:16:31'),
(58, 35, 5, 1, 1, 19.00, 2.85, NULL, 26.85, 'one-way', '[{\"id\":\"3\",\"fees\":5,\"count\":\"1\"}]', 'approved', NULL, NULL, NULL, NULL, 0, 0, '2022-06-03 12:16:58', '2022-06-03 12:16:58'),
(59, 35, 5, 1, 1, 19.00, 2.85, NULL, 26.85, 'one-way', '[{\"id\":\"3\",\"fees\":5,\"count\":\"1\"}]', 'approved', NULL, NULL, NULL, NULL, 0, 0, '2022-06-03 12:23:18', '2022-06-03 12:23:18'),
(60, 35, 5, 1, 2, 38.00, 5.70, NULL, 48.70, NULL, '[{\"id\":\"3\",\"fees\":5,\"count\":\"1\"}]', 'approved', NULL, NULL, NULL, NULL, 0, 0, '2022-06-03 12:24:42', '2022-06-03 12:24:42'),
(61, 35, 5, 1, 2, 38.00, 5.70, NULL, 48.70, NULL, '[{\"id\":\"3\",\"fees\":5,\"count\":\"1\"}]', 'approved', NULL, NULL, NULL, NULL, 0, 0, '2022-06-03 12:25:01', '2022-06-03 12:25:01'),
(62, 35, 5, 1, 1, 19.00, 2.85, NULL, 26.85, NULL, '[{\"id\":\"3\",\"fees\":5,\"count\":\"1\"}]', 'approved', NULL, NULL, NULL, NULL, 0, 0, '2022-06-03 12:25:39', '2022-06-03 12:25:39'),
(63, 35, 5, 1, 1, 19.00, 2.85, NULL, 26.85, NULL, '[{\"id\":\"3\",\"fees\":5,\"count\":\"1\"}]', 'approved', NULL, NULL, NULL, NULL, 0, 0, '2022-06-03 12:26:02', '2022-06-03 12:26:02'),
(64, 35, 5, 1, 1, 19.00, 2.85, NULL, 21.85, NULL, '[]', 'approved', NULL, NULL, NULL, NULL, 0, 0, '2022-06-03 12:51:40', '2022-06-03 12:51:40'),
(65, 35, 5, 1, 1, 19.00, 2.85, NULL, 31.85, NULL, '[{\"id\":\"3\",\"fees\":10,\"count\":\"2\"}]', 'approved', NULL, NULL, NULL, NULL, 0, 0, '2022-06-03 12:54:24', '2022-06-03 12:54:24'),
(66, 35, 5, 1, 1, 19.00, 2.85, NULL, 31.85, NULL, '[{\"id\":\"3\",\"fees\":10,\"count\":\"2\"}]', 'approved', NULL, NULL, NULL, NULL, 0, 0, '2022-06-04 06:02:38', '2022-06-04 06:02:38'),
(67, 35, 5, 1, 1, 19.00, 2.85, NULL, 31.85, NULL, '[{\"id\":\"3\",\"fees\":10,\"count\":2}]', 'approved', NULL, NULL, NULL, NULL, 0, 0, '2022-06-04 06:05:45', '2022-06-04 06:05:45'),
(68, 35, 5, 1, 1, 19.00, 2.85, NULL, 31.85, NULL, '[{\"id\":3,\"fees\":10,\"count\":2}]', 'approved', NULL, NULL, NULL, NULL, 0, 0, '2022-06-04 06:10:44', '2022-06-04 06:10:44'),
(69, 35, 5, 1, 1, 19.00, 2.85, NULL, 21.85, NULL, '[]', 'approved', NULL, NULL, NULL, NULL, 0, 0, '2022-06-04 06:26:18', '2022-06-04 06:26:18'),
(70, 35, 5, 1, 1, 19.00, 2.85, NULL, 31.85, NULL, '[{\"id\":3,\"fees\":10,\"count\":2}]', 'approved', NULL, NULL, NULL, NULL, 0, 0, '2022-06-04 06:26:51', '2022-06-04 06:26:51'),
(71, 35, 5, 1, 1, 19.00, 2.85, NULL, 41.85, NULL, '[{\"id\":3,\"fees\":20,\"count\":4}]', 'approved', NULL, NULL, NULL, NULL, 0, 0, '2022-06-04 06:37:33', '2022-06-04 06:37:33'),
(72, 35, 5, 1, 1, 19.00, 2.85, NULL, 46.85, NULL, '[{\"id\":3,\"fees\":25,\"count\":5}]', 'approved', NULL, NULL, NULL, NULL, 0, 0, '2022-06-04 06:38:17', '2022-06-04 06:38:17'),
(73, 35, 5, 1, 1, 19.00, 2.85, NULL, 46.85, NULL, '[{\"id\":3,\"fees\":25,\"count\":5}]', 'approved', NULL, NULL, NULL, NULL, 0, 0, '2022-06-04 06:43:44', '2022-06-04 06:43:44'),
(74, 35, 5, 1, 1, 19.00, 2.85, NULL, 46.85, NULL, '[{\"id\":3,\"fees\":25,\"count\":5}]', 'approved', NULL, NULL, NULL, NULL, 0, 0, '2022-06-04 06:44:37', '2022-06-04 06:44:37'),
(75, 35, 5, 1, 1, 19.00, 2.85, NULL, 46.85, NULL, '[{\"id\":3,\"fees\":25,\"count\":5}]', 'approved', NULL, NULL, NULL, NULL, 0, 0, '2022-06-04 06:45:40', '2022-06-04 06:45:40'),
(76, 35, 5, 1, 1, 19.00, 2.85, NULL, 31.85, NULL, '[{\"id\":3,\"fees\":10,\"count\":2}]', 'approved', NULL, NULL, NULL, NULL, 0, 0, '2022-06-04 06:46:38', '2022-06-04 06:46:38'),
(77, 35, 5, 1, 1, 19.00, 2.85, NULL, 26.85, NULL, '[{\"id\":3,\"fees\":5,\"count\":1}]', 'approved', NULL, NULL, NULL, NULL, 0, 0, '2022-06-04 06:49:35', '2022-06-04 06:49:35'),
(78, 35, 5, 1, 2, 38.00, 5.70, NULL, 43.70, NULL, '[]', 'approved', NULL, NULL, NULL, NULL, 0, 0, '2022-06-04 06:50:08', '2022-06-04 06:50:08'),
(79, 35, 5, 1, 3, 57.00, 8.55, NULL, 75.55, NULL, '[{\"id\":3,\"fees\":10,\"count\":2}]', 'approved', NULL, NULL, NULL, NULL, 0, 0, '2022-06-04 06:51:33', '2022-06-04 06:51:33'),
(80, 35, 5, 1, 3, 57.00, 8.55, NULL, 70.55, NULL, '[{\"id\":3,\"fees\":5,\"count\":1}]', 'approved', NULL, NULL, NULL, NULL, 0, 0, '2022-06-04 06:53:54', '2022-06-04 06:53:54'),
(81, 35, 5, 1, 1, 19.00, 2.85, NULL, 21.85, NULL, '[]', 'approved', NULL, NULL, NULL, NULL, 0, 0, '2022-06-04 06:57:40', '2022-06-04 06:57:40'),
(82, 35, 5, 1, 1, 19.00, 2.85, NULL, 21.85, NULL, '[]', 'approved', NULL, NULL, NULL, NULL, 0, 0, '2022-06-04 06:58:10', '2022-06-04 06:58:10'),
(83, 38, 5, 1, 2, 58.00, 8.70, NULL, 96.70, NULL, '[{\"id\":2,\"fees\":20,\"count\":1},{\"id\":3,\"fees\":10,\"count\":1}]', 'approved', NULL, NULL, NULL, NULL, 0, 0, '2022-06-04 07:04:54', '2022-06-04 07:04:54'),
(84, 35, 5, 1, 1, 19.00, 2.85, NULL, 26.85, NULL, '[{\"id\":3,\"fees\":5,\"count\":1}]', 'approved', NULL, NULL, NULL, NULL, 0, 0, '2022-06-04 07:05:40', '2022-06-04 07:05:40'),
(85, 35, 5, 1, 1, 19.00, 2.85, NULL, 26.85, NULL, '[{\"id\":3,\"fees\":5,\"count\":1}]', 'approved', NULL, NULL, NULL, NULL, 0, 0, '2022-06-04 07:09:30', '2022-06-04 07:09:30'),
(86, 38, 5, 1, 2, 58.00, 8.70, NULL, 96.70, NULL, '[{\"id\":2,\"fees\":20,\"count\":1},{\"id\":3,\"fees\":10,\"count\":1}]', 'approved', NULL, NULL, NULL, NULL, 0, 0, '2022-06-04 07:10:26', '2022-06-04 07:10:26'),
(87, 38, 5, 1, 1, 29.00, 4.35, NULL, 33.35, NULL, '[]', 'approved', NULL, NULL, NULL, NULL, 0, 0, '2022-06-04 07:11:07', '2022-06-04 07:11:07'),
(88, 38, 5, 1, 1, 29.00, 4.35, NULL, 63.35, NULL, '[{\"id\":2,\"fees\":20,\"count\":1},{\"id\":3,\"fees\":10,\"count\":1}]', 'approved', NULL, NULL, NULL, NULL, 0, 0, '2022-06-04 07:12:37', '2022-06-04 07:12:37'),
(89, 35, 5, 1, 1, 19.00, 2.85, NULL, 31.85, NULL, '[{\"id\":3,\"fees\":10,\"count\":2}]', 'approved', NULL, NULL, NULL, NULL, 0, 0, '2022-06-04 07:13:09', '2022-06-04 07:13:09'),
(90, 35, 5, 1, 1, 19.00, 2.85, NULL, 26.85, NULL, '[{\"id\":3,\"fees\":5,\"count\":1}]', 'approved', NULL, NULL, NULL, NULL, 0, 0, '2022-06-04 07:17:40', '2022-06-04 07:17:40'),
(91, 38, 5, 1, 1, 29.00, 4.35, NULL, 63.35, NULL, '[{\"id\":2,\"fees\":20,\"count\":1},{\"id\":3,\"fees\":10,\"count\":1}]', 'approved', NULL, NULL, NULL, NULL, 0, 0, '2022-06-04 07:18:23', '2022-06-04 07:18:23');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city_id` int(255) DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_of_birth` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `marital_status` enum('single','married') COLLATE utf8mb4_unicode_ci NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `block` tinyint(4) UNSIGNED NOT NULL DEFAULT 0,
  `block_notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `phone_verification_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wallet` double(8,2) UNSIGNED DEFAULT 0.00,
  `language` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ar',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `password`, `image`, `city_id`, `address`, `date_of_birth`, `marital_status`, `notes`, `block`, `block_notes`, `email_verified_at`, `phone_verification_code`, `phone_verified_at`, `remember_token`, `wallet`, `language`, `created_at`, `updated_at`) VALUES
(1, 'user', 'user@email.com', '0552872008', '$2y$10$zv3HLm8i/71n1VzrYqYG9.TYsm2RpWFrpyjE96i/7o74UG8aIrmTC', '1647168575_1.jpg', NULL, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '1999-04-20', 'married', NULL, 0, NULL, '2022-03-10 07:55:44', NULL, NULL, '1xYj3JREyQbu49XbnU5nLW1RbckxIwx1pX6HmvcX8u8IflMGfOP4wDUf5rkR', 2281.00, '', '2022-03-10 07:55:44', '2022-05-11 08:32:16'),
(2, 'test', 'test@email.com', '0552872009', '$2y$10$KYhjOINViohQgmcH5DcyYeKfsYS1RCVzTKoP/w330s6.PdapJW3/e', '1647329719_8.jpg', NULL, '', '', 'single', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s.', 1, 'Test account added by app admin!', NULL, NULL, NULL, NULL, 0.00, '', '2022-03-15 03:30:29', '2022-03-15 03:35:19'),
(5, 'AML GINANIA', 'ss@mail.ru', '0552837665', '$2y$10$3oCj33I9vmCjrRKX6RWnZu.L8gXxL3yj1pU625LEUavih8HwUa88i', '1653922878_noureldin1.jpg', NULL, 'test address', '1995-08-17', 'single', NULL, 0, NULL, NULL, '$2y$10$jbD6GF4Ed8vdQVuf0Af8puApb4Y4F5uKDHA7ExYaDOJ2NbUtwmVnK', '2022-03-23 21:58:30', NULL, 100.00, '', '2022-03-23 21:53:03', '2022-06-08 10:27:58');

-- --------------------------------------------------------

--
-- Table structure for table `users_otp`
--

CREATE TABLE `users_otp` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users_otp`
--

INSERT INTO `users_otp` (`id`, `user_id`, `code`, `created_at`, `updated_at`) VALUES
(5, 37, '2721', '2022-06-08 06:58:47', '2022-06-08 06:58:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `provider_id` (`provider_id`);

--
-- Indexes for table `additionals`
--
ALTER TABLE `additionals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `buses`
--
ALTER TABLE `buses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `provider_id` (`provider_id`),
  ADD KEY `account_id` (`account_id`);

--
-- Indexes for table `bus_datetimes`
--
ALTER TABLE `bus_datetimes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bus_id` (`bus_id`),
  ADD KEY `trip_id` (`trip_id`),
  ADD KEY `bus_order_id` (`bus_order_id`);

--
-- Indexes for table `bus_orders`
--
ALTER TABLE `bus_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `provider_id` (`provider_id`),
  ADD KEY `bus_id` (`bus_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chats_provider_id_foreign` (`provider_id`),
  ADD KEY `chats_user_id_foreign` (`user_id`),
  ADD KEY `chats_trip_id_foreign` (`trip_id`),
  ADD KEY `chats_package_id_foreign` (`package_id`),
  ADD KEY `chats_bus_id_foreign` (`bus_id`),
  ADD KEY `chats_trip_order_id_foreign` (`trip_order_id`),
  ADD KEY `chats_package_order_id_foreign` (`package_order_id`),
  ADD KEY `chats_bus_order_id_foreign` (`bus_order_id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `account_id` (`account_id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `coupons_provider_id_foreign` (`provider_id`);

--
-- Indexes for table `destinations`
--
ALTER TABLE `destinations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `destinations_provider_id_foreign` (`provider_id`),
  ADD KEY `destinations_from_city_id_foreign` (`from_city_id`),
  ADD KEY `destinations_to_city_id_foreign` (`to_city_id`),
  ADD KEY `arrival_terminal_id` (`arrival_terminal_id`),
  ADD KEY `starting_terminal_id` (`starting_terminal_id`);

--
-- Indexes for table `emails`
--
ALTER TABLE `emails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ltm_translations`
--
ALTER TABLE `ltm_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_chat_id_foreign` (`chat_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `account_id` (`account_id`),
  ADD KEY `admin_id` (`admin_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `provider_id` (`provider_id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `packages_provider_id_foreign` (`provider_id`),
  ADD KEY `starting_city_id` (`starting_city_id`);

--
-- Indexes for table `package_orders`
--
ALTER TABLE `package_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `package_id` (`package_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `provider_id` (`provider_id`),
  ADD KEY `coupon_id` (`coupon_id`),
  ADD KEY `admin_notes` (`admin_notes`(8));

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `providers`
--
ALTER TABLE `providers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `trip_id` (`trip_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `bus_order_id` (`bus_order_id`),
  ADD KEY `provider_id` (`provider_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terminals`
--
ALTER TABLE `terminals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `terminals_provider_id_foreign` (`provider_id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `trip_order_id` (`trip_order_id`),
  ADD KEY `package_order_id` (`package_order_id`);

--
-- Indexes for table `trips`
--
ALTER TABLE `trips`
  ADD PRIMARY KEY (`id`),
  ADD KEY `provider_id` (`provider_id`),
  ADD KEY `bus_id` (`bus_id`),
  ADD KEY `destination_id` (`destination_id`);

--
-- Indexes for table `trip_orders`
--
ALTER TABLE `trip_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `trip_id` (`trip_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `provider_id` (`provider_id`),
  ADD KEY `coupon_id` (`coupon_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `users_otp`
--
ALTER TABLE `users_otp`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `additionals`
--
ALTER TABLE `additionals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `buses`
--
ALTER TABLE `buses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `bus_datetimes`
--
ALTER TABLE `bus_datetimes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `bus_orders`
--
ALTER TABLE `bus_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `destinations`
--
ALTER TABLE `destinations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `emails`
--
ALTER TABLE `emails`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ltm_translations`
--
ALTER TABLE `ltm_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1232;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=209;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `package_orders`
--
ALTER TABLE `package_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `providers`
--
ALTER TABLE `providers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `terminals`
--
ALTER TABLE `terminals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT for table `trips`
--
ALTER TABLE `trips`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `trip_orders`
--
ALTER TABLE `trip_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `users_otp`
--
ALTER TABLE `users_otp`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accounts`
--
ALTER TABLE `accounts`
  ADD CONSTRAINT `accounts_ibfk_1` FOREIGN KEY (`provider_id`) REFERENCES `providers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `buses`
--
ALTER TABLE `buses`
  ADD CONSTRAINT `buses_ibfk_2` FOREIGN KEY (`provider_id`) REFERENCES `providers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `buses_ibfk_3` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `bus_datetimes`
--
ALTER TABLE `bus_datetimes`
  ADD CONSTRAINT `bus_datetimes_ibfk_3` FOREIGN KEY (`bus_id`) REFERENCES `buses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bus_datetimes_ibfk_6` FOREIGN KEY (`trip_id`) REFERENCES `trips` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `bus_datetimes_ibfk_7` FOREIGN KEY (`bus_order_id`) REFERENCES `bus_orders` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `bus_orders`
--
ALTER TABLE `bus_orders`
  ADD CONSTRAINT `bus_orders_ibfk_2` FOREIGN KEY (`provider_id`) REFERENCES `providers` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `bus_orders_ibfk_3` FOREIGN KEY (`bus_id`) REFERENCES `buses` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `bus_orders_ibfk_4` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `chats`
--
ALTER TABLE `chats`
  ADD CONSTRAINT `chats_bus_id_foreign` FOREIGN KEY (`bus_id`) REFERENCES `buses` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `chats_bus_order_id_foreign` FOREIGN KEY (`bus_order_id`) REFERENCES `bus_orders` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `chats_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `chats_package_order_id_foreign` FOREIGN KEY (`package_order_id`) REFERENCES `package_orders` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `chats_provider_id_foreign` FOREIGN KEY (`provider_id`) REFERENCES `providers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `chats_trip_id_foreign` FOREIGN KEY (`trip_id`) REFERENCES `trips` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `chats_trip_order_id_foreign` FOREIGN KEY (`trip_order_id`) REFERENCES `trip_orders` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `chats_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `contacts_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `contacts_ibfk_5` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `coupons`
--
ALTER TABLE `coupons`
  ADD CONSTRAINT `coupons_provider_id_foreign` FOREIGN KEY (`provider_id`) REFERENCES `providers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `destinations`
--
ALTER TABLE `destinations`
  ADD CONSTRAINT `destinations_from_city_id_foreign` FOREIGN KEY (`from_city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `destinations_ibfk_3` FOREIGN KEY (`arrival_terminal_id`) REFERENCES `terminals` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `destinations_ibfk_4` FOREIGN KEY (`starting_terminal_id`) REFERENCES `terminals` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `destinations_provider_id_foreign` FOREIGN KEY (`provider_id`) REFERENCES `providers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `destinations_to_city_id_foreign` FOREIGN KEY (`to_city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_chat_id_foreign` FOREIGN KEY (`chat_id`) REFERENCES `chats` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_2` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notifications_ibfk_4` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notifications_ibfk_6` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notifications_ibfk_7` FOREIGN KEY (`provider_id`) REFERENCES `providers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `packages`
--
ALTER TABLE `packages`
  ADD CONSTRAINT `packages_ibfk_2` FOREIGN KEY (`starting_city_id`) REFERENCES `cities` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `packages_provider_id_foreign` FOREIGN KEY (`provider_id`) REFERENCES `providers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `package_orders`
--
ALTER TABLE `package_orders`
  ADD CONSTRAINT `package_orders_ibfk_5` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `package_orders_ibfk_6` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `package_orders_ibfk_7` FOREIGN KEY (`provider_id`) REFERENCES `providers` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `package_orders_ibfk_8` FOREIGN KEY (`coupon_id`) REFERENCES `coupons` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_3` FOREIGN KEY (`trip_id`) REFERENCES `trips` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_4` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_7` FOREIGN KEY (`bus_order_id`) REFERENCES `bus_orders` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_8` FOREIGN KEY (`provider_id`) REFERENCES `providers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `terminals`
--
ALTER TABLE `terminals`
  ADD CONSTRAINT `terminals_provider_id_foreign` FOREIGN KEY (`provider_id`) REFERENCES `providers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_ibfk_2` FOREIGN KEY (`trip_order_id`) REFERENCES `trip_orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tickets_ibfk_4` FOREIGN KEY (`package_order_id`) REFERENCES `package_orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `trips`
--
ALTER TABLE `trips`
  ADD CONSTRAINT `trips_ibfk_3` FOREIGN KEY (`provider_id`) REFERENCES `providers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `trips_ibfk_4` FOREIGN KEY (`bus_id`) REFERENCES `buses` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `trips_ibfk_5` FOREIGN KEY (`destination_id`) REFERENCES `destinations` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `trip_orders`
--
ALTER TABLE `trip_orders`
  ADD CONSTRAINT `trip_orders_ibfk_3` FOREIGN KEY (`trip_id`) REFERENCES `trips` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `trip_orders_ibfk_4` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `trip_orders_ibfk_6` FOREIGN KEY (`provider_id`) REFERENCES `providers` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `trip_orders_ibfk_8` FOREIGN KEY (`coupon_id`) REFERENCES `coupons` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
