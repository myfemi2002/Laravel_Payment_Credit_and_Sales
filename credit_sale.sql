-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 02, 2023 at 10:30 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `credit_sale`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `familiar_ground_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','deactive','suspended') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `customer_name`, `customer_phone`, `customer_gender`, `familiar_ground_name`, `customer_description`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Ocean Willis', '+1 (454) 176-2305', NULL, 'Rhema Chapel', 'Nemo neque dolore ut', 'active', 1, NULL, '2023-06-14 10:53:38', NULL),
(2, 'Reuben Silva', '+1 (113) 758-7932', NULL, 'Emmauel Park', 'Et adipisci esse eve', 'active', 1, NULL, '2023-06-14 10:55:04', NULL),
(3, 'Dennis Hull', '+1 (826) 327-9884', 'male', 'Moses Hall', 'Necessitatibus nobis', 'suspended', 1, NULL, '2023-06-14 13:20:48', '2023-06-14 13:20:48'),
(4, 'Ahmed Steeles', '+1 (233) 852-82144', 'female', 'Pastor Seed', 'Natus et error et nos', 'deactive', 1, NULL, '2023-06-14 13:21:01', '2023-06-14 13:21:01'),
(5, 'Cecilia Thompson', '+1 (365) 492-6879', 'other', 'Higher Ground', 'Ipsum expedita quis', 'active', 1, NULL, '2023-06-14 13:22:48', '2023-06-14 14:15:36'),
(6, 'Ila Ortega', '+1 (782) 889-4914', 'nonbinary', 'Moses Hall', 'Sapiente esse nobis', 'active', 1, NULL, '2023-06-14 13:26:31', '2023-06-14 13:59:23'),
(7, 'Kibo Bradford', '+1 (341) 353-2616', 'male', 'Moses Hall', 'Dolore nemo rerum es', 'active', 1, NULL, '2023-06-14 14:18:57', NULL),
(8, 'Brendan Weeks', '+1 (863) 489-8945', 'female', 'Rhema Chapel', 'Dolore ullamco error', 'active', 1, NULL, '2023-06-14 14:19:08', NULL),
(9, 'Illana Macias', '+1 (812) 238-9053', 'male', 'Open Door Parish', 'Ducimus pariatur V', 'active', 1, NULL, '2023-06-25 08:59:43', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `event_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `event_name`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'July Holy Ghost Night 2023', 1, 3, 3, '2023-06-30 19:56:00', '2023-06-30 20:06:38'),
(2, 'June Holy Ghost Night 2023', 1, 3, 3, '2023-06-30 19:56:17', '2023-06-30 20:06:28'),
(3, 'Light Up Mowe 2023', 1, 3, 3, '2023-06-30 19:56:29', '2023-06-30 20:06:13'),
(4, 'December Holy Night 2023', 1, 3, NULL, '2023-06-30 19:57:05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `expenditures`
--

CREATE TABLE IF NOT EXISTS `expenditures` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `expenditure_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expenditures`
--

INSERT INTO `expenditures` (`id`, `expenditure_name`, `amount`, `description`, `date`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Education', '40000.00', 'Education Payment', '2023-06-22', NULL, NULL, '2023-06-30 13:49:42', '2023-06-30 13:49:42'),
(2, 'Loan', '500000.00', 'Loan Payment', '2023-06-14', NULL, NULL, '2023-06-30 14:00:09', '2023-06-30 14:00:09'),
(3, 'Production Materialss', '1200000.00', 'Productionss Material purchased for the month of june', '2020-06-19', 3, 3, '2023-06-30 14:06:48', '2023-06-30 14:15:23');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `familiar_grounds`
--

CREATE TABLE IF NOT EXISTS `familiar_grounds` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `familiar_ground_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `familiar_grounds`
--

INSERT INTO `familiar_grounds` (`id`, `familiar_ground_name`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Rhema Chapel', 1, 1, NULL, '2023-06-13 18:51:55', NULL),
(2, 'Moses Hall', 1, 1, NULL, '2023-06-13 19:30:49', NULL),
(4, 'Peace Estate', 1, 1, 1, '2023-06-13 19:32:14', '2023-06-14 12:05:47'),
(5, 'Open Door Parish', 1, 1, NULL, '2023-06-13 19:32:43', NULL),
(6, 'Emmauel Park', 1, 1, NULL, '2023-06-13 19:39:01', NULL),
(7, 'Higher Ground', 1, 1, NULL, '2023-06-13 19:39:25', NULL),
(8, 'Pastor Seed', 1, 1, NULL, '2023-06-13 19:39:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `group_names`
--

CREATE TABLE IF NOT EXISTS `group_names` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `group_names`
--

INSERT INTO `group_names` (`id`, `name`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Familiar Ground', 1, NULL, '2023-06-22 21:49:38', NULL),
(2, 'Customers', 1, NULL, '2023-06-22 21:50:02', NULL),
(3, 'Product', 1, NULL, '2023-06-22 21:50:13', NULL),
(4, 'Payment', 1, NULL, '2023-06-22 21:50:26', NULL),
(5, 'Paid Customers', 1, NULL, '2023-06-22 21:50:35', NULL),
(6, 'Unpaid Customers', 1, NULL, '2023-06-22 21:50:47', NULL),
(7, 'Overdue Payments', 1, NULL, '2023-06-22 21:50:59', NULL),
(8, 'Partially Paid Customers', 1, NULL, '2023-06-22 21:51:08', NULL),
(9, 'Group Name', 1, NULL, '2023-06-23 22:24:28', NULL),
(10, 'Create Admin', 1, NULL, '2023-06-29 05:53:21', NULL),
(11, 'Manage Permission', 1, NULL, '2023-06-29 15:01:38', NULL),
(12, 'Manage Roles', 1, NULL, '2023-06-29 15:03:45', NULL),
(13, 'Manage Roles Permission', 3, NULL, '2023-06-29 15:05:06', NULL),
(14, 'Manage Expenditure', 3, NULL, '2023-06-30 14:24:50', NULL),
(15, 'Manage Event', 3, NULL, '2023-06-30 22:41:12', NULL),
(16, 'Total Amount Paid', 3, NULL, '2023-06-30 22:46:39', NULL),
(17, 'Amount Paid Report', 3, NULL, '2023-06-30 22:49:44', NULL),
(18, 'Edit Customer Payment', 3, NULL, '2023-07-02 18:49:47', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_05_12_041126_create_referrals_table', 1),
(6, '2023_06_13_183300_create_familiar_grounds_table', 2),
(7, '2023_06_14_091525_create_customers_table', 3),
(8, '2023_06_15_214004_create_products_table', 4),
(9, '2023_06_15_231417_create_products_table', 5),
(10, '2023_06_16_163241_create_payments_table', 6),
(11, '2023_06_16_183914_create_payments_table', 7),
(12, '2023_06_22_070412_create_group_names_table', 8),
(13, '2023_06_22_230718_create_permission_tables', 9),
(14, '2023_06_30_140129_create_expenditures_table', 10),
(15, '2023_06_30_185451_create_events_table', 11);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(2, 'App\\Models\\User', 2),
(2, 'App\\Models\\User', 5),
(4, 'App\\Models\\User', 3),
(4, 'App\\Models\\User', 6),
(5, 'App\\Models\\User', 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE IF NOT EXISTS `payments` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `purchase_date` date NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_amount` decimal(10,2) DEFAULT NULL,
  `product_quantity` int(11) DEFAULT NULL,
  `product_total_amount` decimal(10,2) NOT NULL,
  `amount_paid` decimal(10,2) NOT NULL,
  `total_amount_paid` decimal(10,2) NOT NULL,
  `payment_status` enum('paid','unpaid','partially') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unpaid',
  `event_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remark` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `customer_name`, `purchase_date`, `product_name`, `product_amount`, `product_quantity`, `product_total_amount`, `amount_paid`, `total_amount_paid`, `payment_status`, `event_name`, `remark`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Dennis Hull', '2023-05-31', 'Zobo', '1000.00', 7, '7000.00', '4000.00', '3000.00', 'partially', NULL, 'Ut doloremque dolore', 1, NULL, '2023-06-16 23:38:50', '2023-06-16 23:38:50'),
(2, 'Ila Ortega', '2023-06-07', 'Rice', '300.00', 97, '29100.00', '1300.00', '0.00', 'paid', NULL, 'Quibusdam nulla est', 1, NULL, '2023-06-16 23:39:15', '2023-06-29 04:32:51'),
(3, 'Kibo Bradford', '2023-06-14', 'KuliKuli', '650.00', 98, '63700.00', '63700.00', '0.00', 'paid', NULL, 'Iste quod ut aliquid', 1, NULL, '2023-06-16 23:40:06', '2023-06-16 23:40:06'),
(4, 'Cecilia Thompson', '2023-05-31', 'Garri', '250.00', 5, '1250.00', '1000.00', '250.00', 'partially', NULL, 'Partial Payment', 1, NULL, '2023-06-17 00:07:04', '2023-06-17 00:07:04'),
(5, 'Cecilia Thompson', '2023-06-18', 'KuliKuli', '650.00', 78, '50700.00', '50600.00', '100.00', 'partially', NULL, 'owe 100naira', 1, NULL, '2023-06-18 06:53:14', '2023-06-18 06:53:14'),
(6, 'Reuben Silva', '2023-06-20', 'Rice', '300.00', 21, '6300.00', '1300.00', '0.00', 'paid', NULL, 'yet to pay', 1, NULL, '2023-06-18 06:54:58', '2023-06-29 04:33:21'),
(7, 'Kibo Bradford', '2023-06-18', 'KuliKuli', '650.00', 2, '1300.00', '7000.00', '0.00', 'paid', NULL, 'Unpaid', 1, NULL, '2023-06-18 10:23:30', '2023-06-29 04:36:48'),
(8, 'Reuben Silva', '2023-06-06', 'Zobo', '1000.00', 5, '5000.00', '5000.00', '0.00', 'paid', NULL, NULL, 1, NULL, '2023-06-18 10:25:57', '2023-06-18 10:25:57'),
(9, 'Cecilia Thompson', '2023-06-11', 'Rice', '300.00', 4, '1200.00', '1100.00', '100.00', 'partially', NULL, NULL, 1, NULL, '2023-06-18 10:26:47', '2023-06-18 10:26:47'),
(10, 'Brendan Weeks', '2023-06-19', 'KuliKuli, Rice, Zobo', NULL, NULL, '1950.00', '50.00', '1900.00', 'partially', NULL, NULL, NULL, NULL, '2023-06-19 04:32:49', '2023-06-19 04:32:49'),
(11, 'Kibo Bradford', '2023-06-20', 'KuliKuli', NULL, NULL, '29250.00', '250.00', '29000.00', 'partially', NULL, NULL, NULL, NULL, '2023-06-19 04:33:49', '2023-06-19 04:33:49'),
(12, 'Brendan Weeks', '2023-06-21', 'Smart High, Baby Wipes, Maggi, Rice, Zobo', NULL, NULL, '5000.00', '5000.00', '0.00', 'paid', NULL, 'Paid', NULL, NULL, '2023-06-21 20:58:43', '2023-06-21 20:58:43'),
(13, 'Reuben Silva', '2023-06-07', 'Smart High, laptop, KuliKuli, Beans, Rice, Zobo', NULL, NULL, '3000.00', '3000.00', '0.00', 'paid', NULL, 'Quod fugiat placeat', NULL, NULL, '2023-06-21 21:05:09', '2023-06-21 21:05:09'),
(14, 'Ila Ortega', '2023-06-22', 'Baby Wipes, laptop, Zobo', NULL, NULL, '2500.00', '7000.00', '0.00', 'paid', NULL, 'Et omnis omnis sequi', NULL, NULL, '2023-06-22 04:42:34', '2023-06-29 04:37:30'),
(15, 'Brendan Weeks', '2023-04-07', 'laptop, KuliKuli, Beans, Rice, Garri, Zobo', NULL, NULL, '4500.00', '4500.00', '9000.00', 'partially', NULL, NULL, NULL, NULL, '2023-06-22 04:43:35', '2023-06-29 04:48:13'),
(16, 'Cecilia Thompson', '2023-05-01', 'laptop, KuliKuli, Garri', NULL, NULL, '5600.00', '4600.00', '1000.00', 'partially', NULL, 'Laborum Ut aliquam', NULL, NULL, '2023-06-22 05:10:02', '2023-06-22 05:10:02'),
(17, 'Illana Macias', '2023-06-29', 'groundnut, Smart High, laptop, KuliKuli, Beans, Rice', NULL, NULL, '5000.00', '2000.00', '3000.00', 'partially', NULL, 'Distinctio Minus vo', NULL, NULL, '2023-06-29 04:34:45', '2023-06-29 04:34:45'),
(18, 'Dennis Hull', '2023-06-29', 'groundnut, pure water, Smart High, Maggi, Zobo', NULL, NULL, '7000.00', '7000.00', '14000.00', 'paid', NULL, NULL, NULL, NULL, '2023-06-29 04:36:08', '2023-06-29 05:27:30'),
(19, 'Illana Macias', '2023-06-29', 'groundnut, Baby Wipes, KuliKuli, Beans, Zobo', NULL, NULL, '3000.00', '3000.00', '3000.00', 'paid', NULL, NULL, NULL, NULL, '2023-06-29 04:49:40', '2023-06-29 05:27:10'),
(20, 'Ahmed Steeles', '2023-06-22', 'groundnut, pure water, Baby Wipes, Maggi, laptop, KuliKuli, Beans', NULL, NULL, '5700.00', '5700.00', '5700.00', 'paid', NULL, NULL, NULL, NULL, '2023-06-29 04:51:43', '2023-06-29 05:26:56'),
(21, 'Cecilia Thompson', '2023-06-29', 'groundnut, Smart High, Baby Wipes, Maggi, laptop', NULL, NULL, '5200.00', '5200.00', '0.00', 'paid', NULL, NULL, NULL, NULL, '2023-06-29 04:54:44', '2023-06-29 05:26:36'),
(22, 'Reuben Silva', '2023-06-29', 'groundnut, Baby Wipes, Maggi, Rice, Garri, Zobo', NULL, NULL, '4300.00', '4300.00', '4300.00', 'paid', NULL, NULL, NULL, NULL, '2023-06-29 05:13:54', '2023-06-29 05:26:06'),
(23, 'Ahmed Steeles', '2023-06-29', 'groundnut, pure water, Baby Wipes, KuliKuli, Beans, Rice, Garri', NULL, NULL, '6500.00', '6500.00', '6500.00', 'paid', NULL, NULL, NULL, NULL, '2023-06-29 05:15:34', '2023-06-29 05:25:44'),
(24, 'Reuben Silva', '2023-06-29', 'pure water, Smart High, Baby Wipes, Maggi, Beans, Garri', NULL, NULL, '4400.00', '4400.00', '0.00', 'paid', NULL, NULL, NULL, NULL, '2023-06-29 05:17:44', '2023-06-29 05:18:10'),
(25, 'Illana Macias', '2023-06-29', 'pure water, Baby Wipes, laptop, KuliKuli, Beans', NULL, NULL, '1300.00', '1200.00', '100.00', 'partially', NULL, NULL, NULL, NULL, '2023-06-29 05:19:33', '2023-06-29 05:20:12'),
(26, 'Cecilia Thompson', '2023-06-29', 'groundnut, pure water, laptop, Rice, Garri, Zobo', NULL, NULL, '195000.00', '0.00', '195000.00', 'unpaid', 'Light Up Mowe 2023', NULL, NULL, NULL, '2023-06-29 05:22:23', '2023-07-02 15:37:20'),
(27, 'Ahmed Steeles', '2023-06-29', 'groundnut, Baby Wipes, Rice, Zobo', NULL, NULL, '4500.00', '4500.00', '0.00', 'paid', 'July Holy Ghost Night 2023', NULL, NULL, NULL, '2023-06-29 13:30:21', '2023-07-02 15:36:39'),
(28, 'Kibo Bradford', '2023-06-30', 'pure water, Smart High, Maggi, laptop, Beans, Rice, Zobo', NULL, NULL, '7000.00', '6500.00', '500.00', 'partially', 'Light Up Mowe 2023', NULL, NULL, NULL, '2023-06-30 20:07:54', '2023-07-02 18:44:27'),
(29, 'Cecilia Thompson', '2023-06-13', 'groundnut, Baby Wipes, KuliKuli, Rice, Zobo', NULL, NULL, '20000.00', '20000.00', '0.00', 'paid', 'December Holy Night 2023', 'Earum aut pariatur', NULL, NULL, '2023-06-30 20:08:28', '2023-06-30 20:08:28'),
(30, 'Kibo Bradford', '2023-06-12', 'groundnut, pure water, Smart High, Maggi, laptop, KuliKuli, Garri, Zobo', NULL, NULL, '2000.00', '2000.00', '0.00', 'paid', 'June Holy Ghost Night 2023', 'Animi aut sint itaq', NULL, NULL, '2023-06-30 20:08:53', '2023-06-30 20:08:53'),
(31, 'Reuben Silva', '2023-06-14', 'pure water, Baby Wipes, Beans, Rice, Zobo', NULL, NULL, '30000.00', '30000.00', '0.00', 'paid', 'July Holy Ghost Night 2023', 'Esse incidunt quis', NULL, NULL, '2023-06-30 20:09:17', '2023-06-30 20:09:17'),
(32, 'Brendan Weeks', '2023-06-13', 'groundnut, pure water, Smart High, Baby Wipes, Rice, Garri, Zobo', NULL, NULL, '5000.00', '5000.00', '0.00', 'paid', 'December Holy Night 2023', 'Quas est omnis nisi', NULL, NULL, '2023-06-30 20:09:45', '2023-06-30 20:09:45'),
(33, 'Ila Ortega', '2023-06-29', 'groundnut, pure water, Baby Wipes, Maggi, KuliKuli, Beans, Zobo', NULL, NULL, '2000.00', '120.00', '1880.00', 'partially', 'December Holy Night 2023', 'Consequatur suscipit', NULL, NULL, '2023-06-30 21:39:45', '2023-06-30 21:39:45');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `group_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `group_name`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'familiar-ground.menu', 'web', 'Familiar Ground', 1, NULL, '2023-06-23 21:15:35', '2023-06-23 21:15:35'),
(2, 'familiar-ground.view', 'web', 'Familiar Ground', 1, NULL, '2023-06-23 21:23:14', '2023-06-23 21:23:14'),
(3, 'familiar-ground.delete', 'web', 'Familiar Ground', 1, NULL, '2023-06-23 21:25:00', '2023-06-23 21:25:00'),
(4, 'product.menu', 'web', 'Product', 1, NULL, '2023-06-23 21:26:08', '2023-06-23 21:26:08'),
(5, 'product.view', 'web', 'Product', 1, NULL, '2023-06-23 21:26:24', '2023-06-23 21:26:25'),
(6, 'product.delete', 'web', 'Product', 1, NULL, '2023-06-23 21:26:53', '2023-06-23 21:26:53'),
(7, 'customer.menu', 'web', 'Customers', 1, NULL, '2023-06-23 21:59:51', '2023-06-23 21:59:51'),
(8, 'customer.view', 'web', 'Customers', 1, NULL, '2023-06-23 22:00:17', '2023-06-23 22:00:17'),
(9, 'customer.delete', 'web', 'Customers', 1, NULL, '2023-06-23 22:00:42', '2023-06-23 22:00:43'),
(10, 'payment.menu', 'web', 'Payment', 1, NULL, '2023-06-23 22:01:48', '2023-06-23 22:01:48'),
(11, 'payment.view', 'web', 'Payment', 1, NULL, '2023-06-23 22:02:38', '2023-06-23 22:02:38'),
(12, 'payment.delete', 'web', 'Payment', 1, NULL, '2023-06-23 22:03:14', '2023-06-23 22:03:15'),
(13, 'paid-payment.view', 'web', 'Paid Customers', 1, NULL, '2023-06-23 22:03:54', '2023-06-23 22:03:54'),
(14, 'unpaid-payment.view', 'web', 'Unpaid Customers', 1, NULL, '2023-06-23 22:05:02', '2023-06-23 22:05:02'),
(15, 'partially-payment.view', 'web', 'Partially Paid Customers', 1, NULL, '2023-06-23 22:07:29', '2023-06-23 22:07:29'),
(16, 'overdue-payment.view', 'web', 'Overdue Payments', 1, 1, '2023-06-23 22:08:52', '2023-06-23 23:40:19'),
(18, 'all.admin.menu', 'web', 'Create Admin', 1, NULL, '2023-06-29 05:55:07', '2023-06-29 05:55:08'),
(19, 'all.admin.view', 'web', 'Create Admin', 1, NULL, '2023-06-29 05:55:22', '2023-06-29 05:55:22'),
(20, 'all.admin.add', 'web', 'Create Admin', 1, NULL, '2023-06-29 05:55:49', '2023-06-29 05:55:49'),
(21, 'all.admin.delete', 'web', 'Create Admin', 1, NULL, '2023-06-29 05:57:16', '2023-06-29 05:57:16'),
(22, 'groupname.menu', 'web', 'Group Name', 1, NULL, '2023-06-29 14:52:32', '2023-06-29 14:52:32'),
(23, 'groupname.view', 'web', 'Group Name', 1, NULL, '2023-06-29 14:52:44', '2023-06-29 14:52:44'),
(24, 'permission.view', 'web', 'Manage Permission', 1, NULL, '2023-06-29 15:02:17', '2023-06-29 15:02:17'),
(25, 'permission.menu', 'web', 'Manage Permission', 1, NULL, '2023-06-29 15:02:46', '2023-06-29 15:02:46'),
(26, 'roles.view', 'web', 'Manage Roles', 1, NULL, '2023-06-29 15:04:25', '2023-06-29 15:04:25'),
(27, 'roles.menu', 'web', 'Manage Roles', 1, NULL, '2023-06-29 15:06:11', '2023-06-29 15:06:11'),
(28, 'roles.permission.menu', 'web', 'Manage Roles Permission', 1, NULL, '2023-06-29 15:06:49', '2023-06-29 15:06:49'),
(29, 'roles.permission.view', 'web', 'Manage Roles Permission', 1, NULL, '2023-06-29 15:07:02', '2023-06-29 15:07:02'),
(30, 'roles.permission.add', 'web', 'Manage Roles Permission', 1, NULL, '2023-06-29 15:07:33', '2023-06-29 15:07:33'),
(31, 'roles.permission.edit', 'web', 'Manage Roles Permission', 1, NULL, '2023-06-29 15:07:59', '2023-06-29 15:07:59'),
(32, 'roles.permission.delete', 'web', 'Manage Roles Permission', 1, NULL, '2023-06-29 15:08:24', '2023-06-29 15:08:24'),
(33, 'expenditure.menu', 'web', 'Manage Expenditure', 3, NULL, '2023-06-30 14:25:27', '2023-06-30 14:25:27'),
(34, 'expenditure.view', 'web', 'Manage Expenditure', 3, NULL, '2023-06-30 14:25:42', '2023-06-30 14:25:42'),
(35, 'event.menu', 'web', 'Manage Event', 3, NULL, '2023-06-30 22:41:52', '2023-06-30 22:41:52'),
(36, 'event.view', 'web', 'Manage Event', 3, NULL, '2023-06-30 22:42:05', '2023-06-30 22:42:05'),
(37, 'total-amount.menu', 'web', 'Total Amount Paid', 3, NULL, '2023-06-30 22:47:26', '2023-06-30 22:47:26'),
(38, 'total-amount.view', 'web', 'Total Amount Paid', 3, NULL, '2023-06-30 22:48:04', '2023-06-30 22:48:04'),
(39, 'total-amount-paid-report.menu', 'web', 'Amount Paid Report', 3, NULL, '2023-06-30 22:51:13', '2023-06-30 22:51:13'),
(40, 'total-amount-paid-report.view', 'web', 'Amount Paid Report', 3, NULL, '2023-06-30 22:51:24', '2023-06-30 22:51:24'),
(41, 'payment.edit', 'web', 'Edit Customer Payment', 3, NULL, '2023-07-02 18:50:20', '2023-07-02 18:50:20');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_amount` decimal(8,2) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `product_amount`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Zobo', '1000.00', 1, 1, NULL, '2023-06-15 22:24:29', NULL),
(2, 'Garri', '250.00', 1, 1, NULL, '2023-06-15 22:27:01', NULL),
(3, 'Rice', '300.00', 1, 1, NULL, '2023-06-15 22:28:09', NULL),
(4, 'Beans', '250.00', 1, 1, 1, '2023-06-15 22:37:20', '2023-06-15 22:50:13'),
(5, 'KuliKuli', '650.00', 1, 1, NULL, '2023-06-15 22:59:05', NULL),
(7, 'laptop', '50000.00', 1, 1, 1, '2023-06-19 05:11:25', '2023-06-27 22:13:07'),
(8, 'Maggi', '5000.00', 1, 1, NULL, '2023-06-19 05:11:58', NULL),
(9, 'Baby Wipes', '1200.00', 1, 1, NULL, '2023-06-19 05:12:20', NULL),
(10, 'Smart High', '60000.00', 1, 1, 1, '2023-06-19 05:19:01', '2023-06-27 22:12:07'),
(11, 'pure water', '20000.00', 1, 1, 1, '2023-06-27 22:09:05', '2023-06-27 22:11:29'),
(12, 'groundnut', '10000.00', 1, 1, 1, '2023-06-27 22:09:26', '2023-06-27 22:11:09');

-- --------------------------------------------------------

--
-- Table structure for table `referrals`
--

CREATE TABLE IF NOT EXISTS `referrals` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `referred_by` bigint(20) UNSIGNED DEFAULT NULL,
  `referral_count` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `referrals_user_id_foreign` (`user_id`),
  KEY `referrals_referred_by_foreign` (`referred_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(2, 'Admin', 'web', '0', 1, 1, '2023-06-24 00:16:53', '2023-06-24 16:11:59'),
(4, 'Super-Admin', 'web', '1', 1, NULL, '2023-06-29 11:23:15', '2023-06-29 11:23:16'),
(5, 'Sales Rep', 'web', '0', 3, NULL, '2023-07-02 18:54:22', '2023-07-02 18:54:22');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 2),
(1, 4),
(1, 5),
(2, 2),
(2, 4),
(2, 5),
(3, 2),
(3, 4),
(3, 5),
(4, 2),
(4, 4),
(4, 5),
(5, 2),
(5, 4),
(5, 5),
(6, 2),
(6, 4),
(6, 5),
(7, 2),
(7, 4),
(7, 5),
(8, 2),
(8, 4),
(8, 5),
(9, 2),
(9, 4),
(9, 5),
(10, 2),
(10, 4),
(10, 5),
(11, 2),
(11, 4),
(11, 5),
(12, 2),
(12, 4),
(12, 5),
(13, 2),
(13, 4),
(14, 2),
(14, 4),
(14, 5),
(15, 2),
(15, 4),
(15, 5),
(16, 2),
(16, 4),
(16, 5),
(18, 2),
(18, 4),
(19, 2),
(19, 4),
(20, 2),
(20, 4),
(21, 2),
(21, 4),
(22, 4),
(23, 4),
(24, 4),
(25, 4),
(26, 4),
(27, 4),
(28, 4),
(29, 4),
(30, 4),
(31, 4),
(32, 4),
(33, 2),
(33, 4),
(34, 2),
(34, 4),
(35, 2),
(35, 4),
(35, 5),
(36, 2),
(36, 4),
(36, 5),
(37, 2),
(37, 4),
(38, 2),
(38, 4),
(39, 2),
(39, 4),
(40, 2),
(40, 4),
(41, 2),
(41, 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sponsor` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referral_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_login_ip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `join_date` timestamp NULL DEFAULT NULL,
  `member_status` enum('free','vip') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'free',
  `verification_status` enum('unverified','verified') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unverified',
  `role` enum('admin','customer') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'customer',
  `role_type` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `status` enum('active','inactive','supsended') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_referral_code_unique` (`referral_code`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `photo`, `gender`, `country_code`, `phone`, `date_of_birth`, `address`, `city`, `country`, `sponsor`, `referral_code`, `last_login_ip`, `join_date`, `member_status`, `verification_status`, `role`, `role_type`, `status`, `created_by`, `updated_by`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin Femi', 'adminlord', 'sadminlord@admin.com', NULL, '$2y$10$hHXiOp6lTNtiDKxGt0IMLu0/d.HlLASc0ldrJS8KXK0Dufl/CuZAW', NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'free', 'unverified', 'admin', '1', 'active', 1, NULL, NULL, NULL, NULL),
(2, 'Howard Parsons', NULL, 'vijykyqixu@mailinator.com', NULL, '$2y$10$SpmK3EWIgf6ApBFAYSAXueihkZIRJrTmLPxT/F0.2FJsBFMQ6ikD6', NULL, 'male', NULL, '+1 (317) 678-2873', NULL, 'Ad quod et laboriosa', NULL, NULL, NULL, NULL, NULL, NULL, 'free', 'unverified', 'admin', '0', 'active', 1, NULL, NULL, '2023-06-25 01:21:39', '2023-06-25 01:21:39'),
(3, 'Admin Femi', 'adminlord', 'adminlord@admin.com', NULL, '$2y$10$hHXiOp6lTNtiDKxGt0IMLu0/d.HlLASc0ldrJS8KXK0Dufl/CuZAW', NULL, 'male', NULL, '08035543036', NULL, 'No 15 olokemeji street ,Odo Ado ,Ado Ekiti', NULL, NULL, NULL, NULL, NULL, NULL, 'free', 'unverified', 'admin', '1', 'active', 1, NULL, NULL, '2023-06-29 11:28:23', '2023-06-29 11:28:23'),
(4, 'Sonya Terrell', NULL, 'sales@admin.com', NULL, '$2y$10$fT2KXDyusg3tLOVrxLjmc.X/QVk.Y6keDLUurK/oVs5nbfvLGK/Va', NULL, 'female', NULL, '+1 (338) 652-2141', NULL, 'Dolorem aliqua Odit', NULL, NULL, NULL, NULL, NULL, NULL, 'free', 'unverified', 'admin', '0', 'active', 3, NULL, NULL, '2023-07-02 18:59:59', '2023-07-02 18:59:59'),
(5, 'Madeline Barton', NULL, 'admin@admin.com', NULL, '$2y$10$bk5LOQRX3WyXe9dEQnxFce0GxgtZDLQ4H9LvrnNGoTojKfA1KMdB.', NULL, 'male', NULL, '+1 (907) 196-2484', NULL, 'Est qui neque accusa', NULL, NULL, NULL, NULL, NULL, NULL, 'free', 'unverified', 'admin', '1', 'active', 3, NULL, NULL, '2023-07-02 19:04:01', '2023-07-02 19:04:01'),
(6, 'Neil Kirk', NULL, 'superadmin@admin.com', NULL, '$2y$10$2QbDaL8soSbFoZTvu29OnuhvedbRFpHr2TTzwK0XYZZon7Q.KsAPm', NULL, 'male', NULL, '+1 (167) 467-9893', NULL, 'Ipsa veritatis labo', NULL, NULL, NULL, NULL, NULL, NULL, 'free', 'unverified', 'admin', '1', 'active', 3, NULL, NULL, '2023-07-02 19:20:04', '2023-07-02 19:20:04');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `referrals`
--
ALTER TABLE `referrals`
  ADD CONSTRAINT `referrals_referred_by_foreign` FOREIGN KEY (`referred_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `referrals_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
