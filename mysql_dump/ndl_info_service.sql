-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 16, 2022 at 06:42 AM
-- Server version: 10.3.35-MariaDB-log-cll-lve
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nodeytil_info_service`
--

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_bn` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code_bn` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name_en`, `name_bn`, `code_en`, `code_bn`, `created_at`, `updated_at`) VALUES
(2, 'Bangladesh', 'বাংলাদেশ', 'bn', 'বাংলা', '2022-05-29 23:18:47', '2022-05-29 23:18:47'),
(3, 'India', 'ভারত', 'in', 'ভারত', '2022-05-29 23:23:53', '2022-05-29 23:23:53'),
(4, 'nepal', 'নেপাল', 'ne', 'নেপাল', '2022-06-07 10:36:02', '2022-06-07 10:36:02'),
(5, 'usa', 'আমেরিকা', 'us', 'আমে', '2022-06-07 10:37:24', '2022-06-07 10:37:24'),
(6, 'usas', 'আমেরিকা', 'us', 'আমে', '2022-06-07 10:37:24', '2022-06-11 08:00:21');

-- --------------------------------------------------------

--
-- Table structure for table `crops`
--

CREATE TABLE `crops` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_bn` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `crops`
--

INSERT INTO `crops` (`id`, `name_en`, `name_bn`, `image`, `image_path`, `created_at`, `updated_at`) VALUES
(3, 'mango', 'আম', '1655185715_Cauliflower.jpg', '/home/nodeytil/infoservice.nodesdigitalbd.com/public/uploads/crop_image/1655185715_Cauliflower.jpg', '2022-06-13 03:55:10', '2022-06-14 09:48:35'),
(12, 'Chili', 'মরিচ', '1655203139_chilli.jpg', '/home/nodeytil/infoservice.nodesdigitalbd.com/public/uploads/crop_image/1655203139_chilli.jpg', '2022-06-13 15:47:10', '2022-06-14 14:38:59');

-- --------------------------------------------------------

--
-- Table structure for table `crop_selections`
--

CREATE TABLE `crop_selections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `crop_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `crop_selections`
--

INSERT INTO `crop_selections` (`id`, `user_id`, `crop_id`, `created_at`, `updated_at`) VALUES
(1, 1, 12, '2022-06-04 22:43:11', '2022-06-04 22:43:11'),
(2, 1, 3, '2022-06-07 15:22:50', '2022-06-07 15:22:50'),
(3, 1, 3, '2022-06-07 19:16:00', '2022-06-07 19:16:00'),
(4, 1, 3, '2022-06-16 19:59:10', '2022-06-16 19:59:10'),
(5, 1, 3, '2022-06-17 10:17:33', '2022-06-17 10:17:33'),
(6, 1, 3, '2022-06-17 10:23:51', '2022-06-17 10:23:51'),
(7, 1, 3, '2022-06-17 10:24:09', '2022-06-17 10:24:09'),
(8, 1, 3, '2022-06-17 10:26:50', '2022-06-17 10:26:50'),
(9, 1, 3, '2022-06-17 10:30:25', '2022-06-17 10:30:25'),
(10, 1, 3, '2022-06-17 11:18:30', '2022-06-17 11:18:30'),
(11, 1, 3, '2022-06-17 11:27:26', '2022-06-17 11:27:26'),
(12, 1, 3, '2022-06-17 11:28:42', '2022-06-17 11:28:42'),
(13, 1, 3, '2022-06-17 17:43:18', '2022-06-17 17:43:18'),
(14, 1, 3, '2022-06-18 21:19:32', '2022-06-18 21:19:32'),
(15, 1, 3, '2022-06-26 00:21:15', '2022-06-26 00:21:15'),
(16, 1, 3, '2022-06-26 00:53:32', '2022-06-26 00:53:32'),
(17, 1, 3, '2022-06-26 11:40:50', '2022-06-26 11:40:50'),
(18, 1, 3, '2022-06-26 12:35:51', '2022-06-26 12:35:51'),
(19, 1, 3, '2022-06-29 08:59:26', '2022-06-29 08:59:26'),
(20, 1, 3, '2022-06-29 09:04:02', '2022-06-29 09:04:02'),
(21, 1, 3, '2022-06-29 10:30:24', '2022-06-29 10:30:24'),
(22, 1, 3, '2022-06-29 10:38:49', '2022-06-29 10:38:49'),
(23, 1, 3, '2022-07-22 14:33:47', '2022-07-22 14:33:47');

-- --------------------------------------------------------

--
-- Table structure for table `cultivation_categories`
--

CREATE TABLE `cultivation_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cultivation_categories`
--

INSERT INTO `cultivation_categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'irregation', '2022-06-12 22:57:20', '2022-06-12 23:01:26'),
(8, 'fertilization', '2022-06-14 15:47:32', '2022-06-14 15:47:32'),
(9, 'pestisides', '2022-06-14 15:47:51', '2022-06-14 15:47:51');

-- --------------------------------------------------------

--
-- Table structure for table `cultivation_season`
--

CREATE TABLE `cultivation_season` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cultivation_section_id` int(10) UNSIGNED NOT NULL,
  `seasion_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cultivation_season`
--

INSERT INTO `cultivation_season` (`id`, `cultivation_section_id`, `seasion_id`, `created_at`, `updated_at`) VALUES
(1, 1, 2, '2022-07-13 00:37:43', '2022-07-13 00:37:43'),
(2, 1, 7, '2022-07-13 00:37:43', '2022-07-13 00:37:43'),
(3, 2, 4, '2022-07-13 02:27:18', '2022-07-13 02:27:18'),
(4, 2, 6, '2022-07-13 02:27:18', '2022-07-13 02:27:18'),
(5, 3, 2, '2022-07-13 02:28:31', '2022-07-13 02:28:31'),
(6, 3, 7, '2022-07-13 02:28:31', '2022-07-13 02:28:31'),
(7, 4, 3, '2022-07-22 14:34:01', '2022-07-22 14:34:01'),
(8, 4, 4, '2022-07-22 14:34:01', '2022-07-22 14:34:01'),
(9, 5, 3, '2022-07-22 14:51:18', '2022-07-22 14:51:18'),
(10, 5, 4, '2022-07-22 14:51:18', '2022-07-22 14:51:18');

-- --------------------------------------------------------

--
-- Table structure for table `cultivation_sections`
--

CREATE TABLE `cultivation_sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `crop_id` int(11) NOT NULL,
  `land_preparation_id` int(11) DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cultivation_sections`
--

INSERT INTO `cultivation_sections` (`id`, `user_id`, `category_id`, `crop_id`, `land_preparation_id`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 3, 1, 'test1', '2022-07-06 11:58:26', '2022-07-06 11:58:26'),
(2, 1, 8, 3, 3, 'test1', '2022-07-06 11:58:32', '2022-07-06 11:58:32'),
(3, 1, 9, 3, 122, 'test1', '2022-07-06 11:58:36', '2022-07-06 11:58:36'),
(4, 1, 2, 2, NULL, 'test', '2022-07-22 14:34:01', '2022-07-22 14:34:01'),
(5, 1, 2, 2, NULL, 'test', '2022-07-22 14:51:18', '2022-07-22 14:51:18');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_bn` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name_en`, `name_bn`, `created_at`, `updated_at`) VALUES
(2, 'Software', 'সফটওয়্যার', '2022-06-01 04:47:04', '2022-06-01 04:47:04');

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `division_id` int(10) UNSIGNED NOT NULL,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_bn` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code_bn` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `division_id`, `name_en`, `name_bn`, `code_en`, `code_bn`, `created_at`, `updated_at`) VALUES
(2, 2, 'Savar', 'সাভার', 'sa', 'সাভার', '2022-05-30 01:39:07', '2022-05-30 01:39:07');

-- --------------------------------------------------------

--
-- Table structure for table `divisions`
--

CREATE TABLE `divisions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country_id` int(10) UNSIGNED NOT NULL,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_bn` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code_bn` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `divisions`
--

INSERT INTO `divisions` (`id`, `country_id`, `name_en`, `name_bn`, `code_en`, `code_bn`, `created_at`, `updated_at`) VALUES
(2, 2, 'Dhakas', 'ঢাকা', 'dh', 'ঢাকা', '2022-05-30 00:51:11', '2022-06-12 08:44:50'),
(4, 2, 'Chittagong', 'চট্টগ্রাম', 'chi', 'চট্টগ', '2022-06-12 08:48:03', '2022-06-12 08:48:03'),
(5, 2, 'Chittagong', 'চট্টগ্রাম', 'Chi', 'চট্টগ', '2022-06-24 17:55:13', '2022-06-24 17:55:13');

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
-- Table structure for table `land_preprations`
--

CREATE TABLE `land_preprations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `crop_id` int(11) NOT NULL,
  `soil_ph_level` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `land_preprations`
--

INSERT INTO `land_preprations` (`id`, `user_id`, `crop_id`, `soil_ph_level`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 10.5, '2022-06-14 15:27:11', '2022-06-14 15:27:11'),
(3, 1, 12, 4.5, '2022-06-15 08:48:44', '2022-06-15 08:48:44'),
(122, 1, 12, 4.5, '2022-06-22 17:58:06', '2022-06-22 17:58:06'),
(123, 1, 12, 4.5, '2022-06-22 21:42:15', '2022-06-22 21:42:15'),
(124, 1, 12, 4.5, '2022-06-25 23:51:56', '2022-06-25 23:51:56'),
(125, 1, 12, 4.5, '2022-06-25 23:57:31', '2022-06-25 23:57:31'),
(126, 1, 12, 4.5, '2022-06-26 00:02:15', '2022-06-26 00:02:15'),
(127, 1, 12, 4.5, '2022-06-26 00:02:39', '2022-06-26 00:02:39'),
(128, 1, 12, 4.5, '2022-06-26 00:04:57', '2022-06-26 00:04:57'),
(129, 1, 12, 4.5, '2022-06-26 00:05:12', '2022-06-26 00:05:12'),
(130, 1, 12, 4.5, '2022-06-26 00:05:14', '2022-06-26 00:05:14'),
(131, 1, 12, 4.5, '2022-06-26 00:05:15', '2022-06-26 00:05:15'),
(132, 1, 12, 1, '2022-06-26 00:07:05', '2022-06-26 00:07:05'),
(133, 1, 12, 4, '2022-06-26 00:21:27', '2022-06-26 00:21:27'),
(134, 1, 12, 3, '2022-06-26 00:30:10', '2022-06-26 00:30:10'),
(135, 1, 12, 4.5, '2022-06-26 00:52:36', '2022-06-26 00:52:36'),
(136, 1, 12, 4.5, '2022-06-26 11:41:05', '2022-06-26 11:41:05'),
(137, 1, 12, 4.5, '2022-06-26 12:36:03', '2022-06-26 12:36:03'),
(138, 1, 12, 4.8, '2022-06-26 19:22:13', '2022-06-26 19:22:13'),
(139, 1, 12, 4.5, '2022-06-29 08:55:08', '2022-06-29 08:55:08'),
(140, 1, 12, 4.5, '2022-06-29 08:59:46', '2022-06-29 08:59:46'),
(141, 1, 12, 4.5, '2022-06-29 09:04:12', '2022-06-29 09:04:12'),
(142, 1, 12, 4.5, '2022-06-29 10:02:10', '2022-06-29 10:02:10'),
(143, 1, 12, 4.5, '2022-06-29 10:02:13', '2022-06-29 10:02:13'),
(144, 1, 12, 4.5, '2022-06-29 10:02:15', '2022-06-29 10:02:15'),
(145, 1, 12, 4.5, '2022-06-29 10:02:16', '2022-06-29 10:02:16'),
(146, 1, 12, 4.5, '2022-06-29 10:02:17', '2022-06-29 10:02:17'),
(147, 1, 12, 4.5, '2022-06-29 10:02:18', '2022-06-29 10:02:18'),
(148, 1, 12, 4.5, '2022-06-29 10:02:19', '2022-06-29 10:02:19'),
(149, 1, 12, 4.5, '2022-06-29 10:02:20', '2022-06-29 10:02:20'),
(150, 1, 12, 4.5, '2022-06-29 10:02:21', '2022-06-29 10:02:21'),
(151, 1, 12, 4.5, '2022-06-29 10:02:59', '2022-06-29 10:02:59'),
(152, 1, 12, 4.5, '2022-06-29 10:03:17', '2022-06-29 10:03:17'),
(153, 1, 12, 4.5, '2022-06-29 10:07:17', '2022-06-29 10:07:17'),
(154, 1, 12, 4.5, '2022-06-29 10:07:22', '2022-06-29 10:07:22'),
(155, 1, 12, 4.5, '2022-06-29 10:09:32', '2022-06-29 10:09:32'),
(156, 1, 12, 4.5, '2022-06-29 10:09:59', '2022-06-29 10:09:59'),
(157, 1, 12, 4.5, '2022-06-29 10:23:16', '2022-06-29 10:23:16'),
(158, 1, 12, 4.5, '2022-06-29 10:23:17', '2022-06-29 10:23:17'),
(159, 1, 12, 4.5, '2022-06-29 10:23:18', '2022-06-29 10:23:18'),
(160, 1, 12, 4.5, '2022-06-29 10:23:19', '2022-06-29 10:23:19'),
(161, 1, 12, 4.5, '2022-06-29 10:23:21', '2022-06-29 10:23:21'),
(162, 1, 12, 4.5, '2022-06-29 10:24:03', '2022-06-29 10:24:03'),
(163, 1, 12, 4.5, '2022-06-29 10:24:04', '2022-06-29 10:24:04'),
(164, 1, 12, 4.5, '2022-06-29 10:24:38', '2022-06-29 10:24:38'),
(165, 1, 12, 4.5, '2022-06-29 10:24:39', '2022-06-29 10:24:39'),
(166, 1, 12, 4.5, '2022-06-29 10:24:40', '2022-06-29 10:24:40'),
(167, 1, 12, 4.5, '2022-06-29 10:30:38', '2022-06-29 10:30:38'),
(168, 1, 12, 4.5, '2022-06-29 10:39:04', '2022-06-29 10:39:04'),
(169, 1, 12, 6, '2022-07-22 14:33:55', '2022-07-22 14:33:55'),
(170, 1, 12, 2, '2022-07-22 14:51:12', '2022-07-22 14:51:12');

-- --------------------------------------------------------

--
-- Table structure for table `land_prepration_seasions`
--

CREATE TABLE `land_prepration_seasions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_bn` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cultural_operation` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `land_prepration_seasions`
--

INSERT INTO `land_prepration_seasions` (`id`, `name_en`, `name_bn`, `cultural_operation`, `start_date`, `end_date`, `created_at`, `updated_at`) VALUES
(2, 'summers', 'গ্রীষ্ম', 'plough', '2022-04-06', '2022-06-10', '2022-06-04 23:57:34', '2022-06-12 14:49:21'),
(4, 'winter', 'শীতকাল', 'plough', '2022-06-12', '2022-06-27', '2022-06-12 14:51:57', '2022-06-12 14:51:57'),
(6, 'winter', 'শীতকাল', 'Sowing', '2022-06-30', '2022-07-08', '2022-06-14 08:53:26', '2022-06-14 08:53:26'),
(7, 'summers', 'গ্রীষ্ম', 'sowing', '2022-10-05', '2022-12-10', '2022-06-14 09:07:53', '2022-06-14 09:08:19');

-- --------------------------------------------------------

--
-- Table structure for table `land_season`
--

CREATE TABLE `land_season` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `land_prepration_id` int(10) UNSIGNED NOT NULL,
  `season_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `land_season`
--

INSERT INTO `land_season` (`id`, `land_prepration_id`, `season_id`, `created_at`, `updated_at`) VALUES
(1, 1, 2, '2022-06-14 15:27:11', '2022-06-14 15:27:11'),
(2, 1, 7, '2022-06-14 15:27:11', '2022-06-14 15:27:11'),
(3, 3, 4, '2022-06-15 08:48:44', '2022-06-15 08:48:44'),
(4, 3, 6, '2022-06-15 08:48:44', '2022-06-15 08:48:44'),
(49, 122, 4, '2022-06-22 17:58:06', '2022-06-22 17:58:06'),
(50, 122, 6, '2022-06-22 17:58:06', '2022-06-22 17:58:06'),
(51, 123, 4, '2022-06-22 21:42:15', '2022-06-22 21:42:15'),
(52, 123, 6, '2022-06-22 21:42:15', '2022-06-22 21:42:15'),
(53, 124, 4, '2022-06-25 23:51:56', '2022-06-25 23:51:56'),
(54, 124, 6, '2022-06-25 23:51:56', '2022-06-25 23:51:56'),
(55, 125, 4, '2022-06-25 23:57:31', '2022-06-25 23:57:31'),
(56, 125, 6, '2022-06-25 23:57:31', '2022-06-25 23:57:31'),
(57, 126, 4, '2022-06-26 00:02:15', '2022-06-26 00:02:15'),
(58, 126, 6, '2022-06-26 00:02:15', '2022-06-26 00:02:15'),
(59, 127, 4, '2022-06-26 00:02:39', '2022-06-26 00:02:39'),
(60, 127, 6, '2022-06-26 00:02:39', '2022-06-26 00:02:39'),
(61, 128, 4, '2022-06-26 00:04:57', '2022-06-26 00:04:57'),
(62, 128, 6, '2022-06-26 00:04:57', '2022-06-26 00:04:57'),
(63, 129, 4, '2022-06-26 00:05:12', '2022-06-26 00:05:12'),
(64, 129, 6, '2022-06-26 00:05:12', '2022-06-26 00:05:12'),
(65, 130, 4, '2022-06-26 00:05:14', '2022-06-26 00:05:14'),
(66, 130, 6, '2022-06-26 00:05:14', '2022-06-26 00:05:14'),
(67, 131, 4, '2022-06-26 00:05:15', '2022-06-26 00:05:15'),
(68, 131, 6, '2022-06-26 00:05:15', '2022-06-26 00:05:15'),
(69, 132, 4, '2022-06-26 00:07:05', '2022-06-26 00:07:05'),
(70, 132, 6, '2022-06-26 00:07:05', '2022-06-26 00:07:05'),
(71, 133, 4, '2022-06-26 00:21:27', '2022-06-26 00:21:27'),
(72, 133, 6, '2022-06-26 00:21:27', '2022-06-26 00:21:27'),
(73, 134, 4, '2022-06-26 00:30:10', '2022-06-26 00:30:10'),
(74, 134, 6, '2022-06-26 00:30:10', '2022-06-26 00:30:10'),
(75, 135, 4, '2022-06-26 00:52:36', '2022-06-26 00:52:36'),
(76, 135, 6, '2022-06-26 00:52:36', '2022-06-26 00:52:36'),
(77, 136, 4, '2022-06-26 11:41:05', '2022-06-26 11:41:05'),
(78, 136, 6, '2022-06-26 11:41:05', '2022-06-26 11:41:05'),
(79, 137, 4, '2022-06-26 12:36:03', '2022-06-26 12:36:03'),
(80, 137, 6, '2022-06-26 12:36:03', '2022-06-26 12:36:03'),
(81, 138, 4, '2022-06-26 19:22:13', '2022-06-26 19:22:13'),
(82, 138, 6, '2022-06-26 19:22:13', '2022-06-26 19:22:13'),
(83, 139, 4, '2022-06-29 08:55:08', '2022-06-29 08:55:08'),
(84, 139, 6, '2022-06-29 08:55:08', '2022-06-29 08:55:08'),
(85, 140, 4, '2022-06-29 08:59:46', '2022-06-29 08:59:46'),
(86, 140, 6, '2022-06-29 08:59:46', '2022-06-29 08:59:46'),
(87, 141, 4, '2022-06-29 09:04:12', '2022-06-29 09:04:12'),
(88, 141, 6, '2022-06-29 09:04:12', '2022-06-29 09:04:12'),
(89, 142, 4, '2022-06-29 10:02:10', '2022-06-29 10:02:10'),
(90, 142, 6, '2022-06-29 10:02:10', '2022-06-29 10:02:10'),
(91, 143, 4, '2022-06-29 10:02:13', '2022-06-29 10:02:13'),
(92, 143, 6, '2022-06-29 10:02:13', '2022-06-29 10:02:13'),
(93, 144, 4, '2022-06-29 10:02:15', '2022-06-29 10:02:15'),
(94, 144, 6, '2022-06-29 10:02:15', '2022-06-29 10:02:15'),
(95, 145, 4, '2022-06-29 10:02:16', '2022-06-29 10:02:16'),
(96, 145, 6, '2022-06-29 10:02:16', '2022-06-29 10:02:16'),
(97, 146, 4, '2022-06-29 10:02:17', '2022-06-29 10:02:17'),
(98, 146, 6, '2022-06-29 10:02:17', '2022-06-29 10:02:17'),
(99, 147, 4, '2022-06-29 10:02:18', '2022-06-29 10:02:18'),
(100, 147, 6, '2022-06-29 10:02:18', '2022-06-29 10:02:18'),
(101, 148, 4, '2022-06-29 10:02:19', '2022-06-29 10:02:19'),
(102, 148, 6, '2022-06-29 10:02:19', '2022-06-29 10:02:19'),
(103, 149, 4, '2022-06-29 10:02:20', '2022-06-29 10:02:20'),
(104, 149, 6, '2022-06-29 10:02:20', '2022-06-29 10:02:20'),
(105, 150, 4, '2022-06-29 10:02:21', '2022-06-29 10:02:21'),
(106, 150, 6, '2022-06-29 10:02:21', '2022-06-29 10:02:21'),
(107, 151, 4, '2022-06-29 10:02:59', '2022-06-29 10:02:59'),
(108, 151, 6, '2022-06-29 10:02:59', '2022-06-29 10:02:59'),
(109, 152, 4, '2022-06-29 10:03:17', '2022-06-29 10:03:17'),
(110, 152, 6, '2022-06-29 10:03:17', '2022-06-29 10:03:17'),
(111, 153, 4, '2022-06-29 10:07:17', '2022-06-29 10:07:17'),
(112, 153, 6, '2022-06-29 10:07:17', '2022-06-29 10:07:17'),
(113, 154, 4, '2022-06-29 10:07:22', '2022-06-29 10:07:22'),
(114, 154, 6, '2022-06-29 10:07:22', '2022-06-29 10:07:22'),
(115, 155, 4, '2022-06-29 10:09:32', '2022-06-29 10:09:32'),
(116, 155, 6, '2022-06-29 10:09:32', '2022-06-29 10:09:32'),
(117, 156, 4, '2022-06-29 10:09:59', '2022-06-29 10:09:59'),
(118, 156, 6, '2022-06-29 10:09:59', '2022-06-29 10:09:59'),
(119, 157, 4, '2022-06-29 10:23:16', '2022-06-29 10:23:16'),
(120, 157, 6, '2022-06-29 10:23:16', '2022-06-29 10:23:16'),
(121, 158, 4, '2022-06-29 10:23:17', '2022-06-29 10:23:17'),
(122, 158, 6, '2022-06-29 10:23:17', '2022-06-29 10:23:17'),
(123, 159, 4, '2022-06-29 10:23:18', '2022-06-29 10:23:18'),
(124, 159, 6, '2022-06-29 10:23:18', '2022-06-29 10:23:18'),
(125, 160, 4, '2022-06-29 10:23:19', '2022-06-29 10:23:19'),
(126, 160, 6, '2022-06-29 10:23:19', '2022-06-29 10:23:19'),
(127, 161, 4, '2022-06-29 10:23:21', '2022-06-29 10:23:21'),
(128, 161, 6, '2022-06-29 10:23:21', '2022-06-29 10:23:21'),
(129, 162, 4, '2022-06-29 10:24:03', '2022-06-29 10:24:03'),
(130, 162, 6, '2022-06-29 10:24:03', '2022-06-29 10:24:03'),
(131, 163, 4, '2022-06-29 10:24:04', '2022-06-29 10:24:04'),
(132, 163, 6, '2022-06-29 10:24:04', '2022-06-29 10:24:04'),
(133, 164, 4, '2022-06-29 10:24:38', '2022-06-29 10:24:38'),
(134, 164, 6, '2022-06-29 10:24:38', '2022-06-29 10:24:38'),
(135, 165, 4, '2022-06-29 10:24:39', '2022-06-29 10:24:39'),
(136, 165, 6, '2022-06-29 10:24:39', '2022-06-29 10:24:39'),
(137, 166, 4, '2022-06-29 10:24:40', '2022-06-29 10:24:40'),
(138, 166, 6, '2022-06-29 10:24:40', '2022-06-29 10:24:40'),
(139, 167, 4, '2022-06-29 10:30:38', '2022-06-29 10:30:38'),
(140, 167, 6, '2022-06-29 10:30:38', '2022-06-29 10:30:38'),
(141, 168, 4, '2022-06-29 10:39:04', '2022-06-29 10:39:04'),
(142, 168, 6, '2022-06-29 10:39:04', '2022-06-29 10:39:04'),
(143, 169, 4, '2022-07-22 14:33:55', '2022-07-22 14:33:55'),
(144, 169, 6, '2022-07-22 14:33:55', '2022-07-22 14:33:55'),
(145, 170, 4, '2022-07-22 14:51:12', '2022-07-22 14:51:12'),
(146, 170, 6, '2022-07-22 14:51:12', '2022-07-22 14:51:12');

-- --------------------------------------------------------

--
-- Table structure for table `land_sizes`
--

CREATE TABLE `land_sizes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `size` double(8,2) NOT NULL,
  `land_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `land_sizes`
--

INSERT INTO `land_sizes` (`id`, `user_id`, `size`, `land_type`, `created_at`, `updated_at`) VALUES
(1, 1, 10.00, 'Hector', '2022-06-04 23:03:39', '2022-06-04 23:03:39'),
(2, 1, 10.00, 'Hector', '2022-06-05 18:13:41', '2022-06-05 18:13:41'),
(3, 1, 10.00, 'Hector', '2022-06-05 18:25:42', '2022-06-05 18:25:42'),
(4, 1, 10.00, 'Hector', '2022-06-05 19:29:30', '2022-06-05 19:29:30'),
(5, 1, 10.00, 'Hector', '2022-06-07 08:54:54', '2022-06-07 08:54:54'),
(6, 1, 10.00, 'Hector', '2022-06-07 09:06:54', '2022-06-07 09:06:54'),
(7, 1, 10.00, 'Hector', '2022-06-16 12:30:22', '2022-06-16 12:30:22'),
(8, 1, 10.00, 'Hector', '2022-06-16 12:37:47', '2022-06-16 12:37:47'),
(9, 1, 10.00, 'Hector', '2022-06-16 19:22:20', '2022-06-16 19:22:20'),
(10, 1, 2.00, 'Hector', '2022-06-16 19:54:23', '2022-06-16 19:54:23'),
(11, 1, 2.00, 'Hector', '2022-06-16 19:54:28', '2022-06-16 19:54:28'),
(12, 1, 2.00, 'Hector', '2022-06-16 19:54:29', '2022-06-16 19:54:29'),
(13, 1, 2.00, 'Hector', '2022-06-16 19:54:31', '2022-06-16 19:54:31'),
(14, 1, 2.00, 'Hector', '2022-06-16 19:54:33', '2022-06-16 19:54:33'),
(15, 1, 2.00, 'Hector', '2022-06-16 19:54:34', '2022-06-16 19:54:34'),
(16, 1, 2.00, 'Hector', '2022-06-16 19:54:37', '2022-06-16 19:54:37'),
(17, 1, 2.00, 'Hector', '2022-06-16 19:55:43', '2022-06-16 19:55:43'),
(18, 1, 2.00, 'Hector', '2022-06-16 19:58:20', '2022-06-16 19:58:20'),
(19, 1, 2.00, '0', '2022-06-17 13:37:18', '2022-06-17 13:37:18'),
(20, 1, 2.00, '0', '2022-06-17 13:46:10', '2022-06-17 13:46:10'),
(21, 1, 2.00, '0', '2022-06-17 13:46:13', '2022-06-17 13:46:13'),
(22, 1, 2.00, '0', '2022-06-17 13:46:15', '2022-06-17 13:46:15'),
(23, 1, 2.00, '0', '2022-06-17 13:46:16', '2022-06-17 13:46:16'),
(24, 1, 2.00, '0', '2022-06-17 13:46:18', '2022-06-17 13:46:18'),
(25, 1, 2.00, '0', '2022-06-17 13:48:53', '2022-06-17 13:48:53'),
(26, 1, 5.00, '0', '2022-06-17 17:43:11', '2022-06-17 17:43:11'),
(27, 1, 2.00, '1', '2022-06-17 18:57:48', '2022-06-17 18:57:48'),
(28, 1, 2.00, '1', '2022-06-18 21:19:27', '2022-06-18 21:19:27'),
(29, 1, 2.00, '3', '2022-06-26 00:20:56', '2022-06-26 00:20:56'),
(30, 1, 10.00, 'Hector', '2022-06-26 00:52:54', '2022-06-26 00:52:54'),
(31, 1, 2.00, '3', '2022-06-26 12:35:43', '2022-06-26 12:35:43'),
(32, 1, 2.00, '2', '2022-06-29 08:59:19', '2022-06-29 08:59:19'),
(33, 1, 1.00, '3', '2022-06-29 09:03:58', '2022-06-29 09:03:58'),
(34, 1, 2.00, '3', '2022-06-29 10:30:19', '2022-06-29 10:30:19'),
(35, 1, 2.00, '2', '2022-06-29 10:38:45', '2022-06-29 10:38:45'),
(36, 1, 10.00, 'Hector', '2022-06-29 13:11:29', '2022-06-29 13:11:29'),
(37, 1, 1.00, 'bigha', '2022-06-30 21:34:26', '2022-06-30 21:34:26'),
(38, 1, 1.00, 'bigha', '2022-06-30 22:37:28', '2022-06-30 22:37:28'),
(39, 1, 2.50, 'hector', '2022-06-30 22:47:57', '2022-06-30 22:47:57'),
(40, 1, 2.50, 'hector', '2022-06-30 23:10:31', '2022-06-30 23:10:31'),
(41, 1, 2.50, 'hector', '2022-06-30 23:15:30', '2022-06-30 23:15:30'),
(42, 1, 50.00, 'katha', '2022-06-30 23:38:52', '2022-06-30 23:38:52'),
(43, 1, 5.00, 'bigha', '2022-06-30 23:58:51', '2022-06-30 23:58:51'),
(44, 1, 20.00, 'katha', '2022-07-01 01:12:05', '2022-07-01 01:12:05'),
(45, 1, 20.00, 'katha', '2022-07-01 01:13:46', '2022-07-01 01:13:46'),
(46, 1, 20.00, 'katha', '2022-07-01 01:20:35', '2022-07-01 01:20:35'),
(47, 1, 25.00, 'decimal', '2022-07-01 01:41:38', '2022-07-01 01:41:38'),
(48, 1, 25.00, 'bigha', '2022-07-01 01:42:11', '2022-07-01 01:42:11'),
(49, 1, 25.00, 'bigha', '2022-07-01 02:24:19', '2022-07-01 02:24:19'),
(50, 1, 25.00, 'katha', '2022-07-01 17:12:20', '2022-07-01 17:12:20'),
(51, 1, 25.00, 'katha', '2022-07-01 17:12:21', '2022-07-01 17:12:21'),
(52, 1, 26.00, 'decimal', '2022-07-01 17:15:00', '2022-07-01 17:15:00'),
(53, 1, 2.00, '1', '2022-07-22 14:33:32', '2022-07-22 14:33:32');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `user_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 'Bangla', '2022-06-07 09:52:56', '2022-06-07 09:52:56');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `country_id` int(10) UNSIGNED NOT NULL,
  `division_id` int(10) UNSIGNED NOT NULL,
  `district_id` int(10) UNSIGNED NOT NULL,
  `thana_id` int(10) UNSIGNED NOT NULL,
  `village_id` int(10) UNSIGNED NOT NULL,
  `post_office_id` int(10) UNSIGNED NOT NULL,
  `poc_id` int(10) UNSIGNED NOT NULL,
  `union_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `user_id`, `country_id`, `division_id`, `district_id`, `thana_id`, `village_id`, `post_office_id`, `poc_id`, `union_id`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 2, 2, 2, 3, 2, 2, 2, '2022-06-05 15:09:59', '2022-06-05 15:09:59'),
(2, 1, 2, 2, 2, 2, 3, 2, 2, 2, '2022-06-05 15:12:15', '2022-06-05 15:12:15'),
(3, 1, 2, 2, 2, 2, 3, 2, 2, 2, '2022-06-05 15:12:54', '2022-06-05 15:12:54'),
(4, 1, 2, 2, 2, 2, 3, 2, 2, 2, '2022-06-05 17:49:56', '2022-06-05 17:49:56'),
(5, 1, 2, 2, 2, 2, 3, 2, 2, 2, '2022-06-05 19:13:35', '2022-06-05 19:13:35'),
(6, 1, 2, 2, 2, 2, 3, 2, 2, 2, '2022-06-05 21:46:49', '2022-06-05 21:46:49'),
(7, 1, 2, 2, 2, 2, 3, 2, 2, 2, '2022-06-06 17:55:54', '2022-06-06 17:55:54'),
(8, 1, 2, 2, 2, 2, 3, 2, 2, 2, '2022-06-06 21:38:06', '2022-06-06 21:38:06'),
(9, 1, 2, 2, 2, 2, 3, 2, 2, 2, '2022-06-06 21:40:26', '2022-06-06 21:40:26'),
(10, 1, 2, 2, 2, 2, 3, 2, 2, 2, '2022-06-07 09:13:10', '2022-06-07 09:13:10'),
(11, 1, 2, 2, 2, 2, 3, 2, 2, 2, '2022-06-17 17:24:05', '2022-06-17 17:24:05'),
(12, 1, 2, 2, 2, 2, 3, 2, 2, 2, '2022-06-17 17:42:46', '2022-06-17 17:42:46'),
(13, 1, 2, 2, 2, 2, 3, 2, 2, 2, '2022-06-17 18:43:45', '2022-06-17 18:43:45'),
(14, 1, 2, 2, 2, 2, 3, 2, 2, 2, '2022-06-17 18:57:31', '2022-06-17 18:57:31'),
(15, 1, 2, 2, 2, 2, 3, 2, 2, 2, '2022-06-18 21:19:17', '2022-06-18 21:19:17'),
(16, 1, 2, 2, 2, 2, 3, 2, 2, 2, '2022-06-24 06:12:54', '2022-06-24 06:12:54'),
(17, 1, 2, 2, 2, 2, 3, 2, 2, 2, '2022-06-26 00:20:39', '2022-06-26 00:20:39'),
(18, 1, 2, 2, 2, 2, 3, 2, 2, 2, '2022-06-26 00:52:00', '2022-06-26 00:52:00'),
(19, 1, 2, 2, 2, 2, 3, 2, 2, 2, '2022-06-26 12:35:33', '2022-06-26 12:35:33'),
(20, 1, 2, 2, 2, 2, 3, 2, 2, 2, '2022-06-29 08:59:02', '2022-06-29 08:59:02'),
(21, 1, 2, 2, 2, 2, 3, 2, 2, 2, '2022-06-29 09:03:45', '2022-06-29 09:03:45'),
(22, 1, 2, 2, 2, 2, 3, 2, 2, 2, '2022-06-29 10:30:12', '2022-06-29 10:30:12'),
(23, 1, 2, 2, 2, 2, 3, 2, 2, 2, '2022-06-29 10:38:37', '2022-06-29 10:38:37'),
(24, 1, 2, 2, 2, 2, 3, 2, 2, 2, '2022-07-22 14:33:26', '2022-07-22 14:33:26');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_05_30_033142_create_countries_table', 1),
(6, '2022_05_30_052654_create_divisions_table', 2),
(7, '2022_05_30_065253_create_districts_table', 3),
(8, '2022_05_30_074015_create_thanas_table', 4),
(9, '2022_05_30_095017_create_villages_table', 5),
(10, '2022_05_31_043049_create_unions_table', 6),
(11, '2022_05_31_062652_create_post_offices_table', 7),
(12, '2022_05_31_065752_create_pocs_table', 8),
(13, '2022_05_31_071806_create_locations_table', 9),
(14, '2022_05_31_104058_create_crops_table', 10),
(15, '2022_06_01_071029_create_departments_table', 11),
(16, '2022_06_04_035811_create_crop_selections_table', 12),
(17, '2022_06_05_044449_create_land_sizes_table', 13),
(18, '2022_06_05_052217_create_land_prepration_seasions_table', 14),
(19, '2022_06_05_060224_create_land_preprations_table', 15);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `pocs`
--

CREATE TABLE `pocs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `post_office_id` int(10) UNSIGNED NOT NULL,
  `poc_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pocs`
--

INSERT INTO `pocs` (`id`, `post_office_id`, `poc_code`, `created_at`, `updated_at`) VALUES
(2, 2, '637', '2022-05-31 01:16:47', '2022-05-31 01:16:47');

-- --------------------------------------------------------

--
-- Table structure for table `post_offices`
--

CREATE TABLE `post_offices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `village_id` int(11) NOT NULL,
  `post_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post_offices`
--

INSERT INTO `post_offices` (`id`, `village_id`, `post_code`, `created_at`, `updated_at`) VALUES
(2, 3, 'test17', '2022-05-31 00:56:43', '2022-05-31 00:56:43'),
(3, 3, 'test', '2022-06-12 14:45:01', '2022-06-12 14:45:01'),
(4, 3, 'test1', '2022-06-12 14:45:20', '2022-06-12 14:45:20'),
(5, 3, 'test3', '2022-06-12 14:46:23', '2022-06-12 14:46:23');

-- --------------------------------------------------------

--
-- Table structure for table `thanas`
--

CREATE TABLE `thanas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `district_id` int(11) DEFAULT NULL,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_bn` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code_bn` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `thanas`
--

INSERT INTO `thanas` (`id`, `district_id`, `name_en`, `name_bn`, `code_en`, `code_bn`, `created_at`, `updated_at`) VALUES
(2, 2, 'birulia', 'বিরুলিয়া', 'br', 'বিরুলিয়া', '2022-05-30 03:36:36', '2022-05-30 03:36:36');

-- --------------------------------------------------------

--
-- Table structure for table `unions`
--

CREATE TABLE `unions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `village_id` int(10) UNSIGNED NOT NULL,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_bn` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `unions`
--

INSERT INTO `unions` (`id`, `village_id`, `name_en`, `name_bn`, `created_at`, `updated_at`) VALUES
(2, 3, 'amin bazar', 'আমিন বাজার', '2022-05-31 00:25:42', '2022-05-31 00:25:42');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_of_birth` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dept_id` int(11) NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `villages`
--

CREATE TABLE `villages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `thana_id` int(10) UNSIGNED NOT NULL,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_bn` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code_bn` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `villages`
--

INSERT INTO `villages` (`id`, `thana_id`, `name_en`, `name_bn`, `code_en`, `code_bn`, `created_at`, `updated_at`) VALUES
(3, 2, 'shimulia', 'শিমুলিয়া', 'sh', 'শিমুলিয়া', '2022-05-30 22:28:27', '2022-05-30 22:28:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `crops`
--
ALTER TABLE `crops`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `crop_selections`
--
ALTER TABLE `crop_selections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cultivation_categories`
--
ALTER TABLE `cultivation_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cultivation_season`
--
ALTER TABLE `cultivation_season`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cultivation_sections`
--
ALTER TABLE `cultivation_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `divisions`
--
ALTER TABLE `divisions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `land_preprations`
--
ALTER TABLE `land_preprations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `land_prepration_seasions`
--
ALTER TABLE `land_prepration_seasions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `land_season`
--
ALTER TABLE `land_season`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `land_sizes`
--
ALTER TABLE `land_sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `pocs`
--
ALTER TABLE `pocs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_offices`
--
ALTER TABLE `post_offices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `thanas`
--
ALTER TABLE `thanas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unions`
--
ALTER TABLE `unions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `villages`
--
ALTER TABLE `villages`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `crops`
--
ALTER TABLE `crops`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `crop_selections`
--
ALTER TABLE `crop_selections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `cultivation_categories`
--
ALTER TABLE `cultivation_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `cultivation_season`
--
ALTER TABLE `cultivation_season`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `cultivation_sections`
--
ALTER TABLE `cultivation_sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `divisions`
--
ALTER TABLE `divisions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `land_preprations`
--
ALTER TABLE `land_preprations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=171;

--
-- AUTO_INCREMENT for table `land_prepration_seasions`
--
ALTER TABLE `land_prepration_seasions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `land_season`
--
ALTER TABLE `land_season`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;

--
-- AUTO_INCREMENT for table `land_sizes`
--
ALTER TABLE `land_sizes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pocs`
--
ALTER TABLE `pocs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `post_offices`
--
ALTER TABLE `post_offices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `thanas`
--
ALTER TABLE `thanas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `unions`
--
ALTER TABLE `unions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `villages`
--
ALTER TABLE `villages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
