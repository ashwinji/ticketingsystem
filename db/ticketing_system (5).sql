-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2018 at 01:51 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.1.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ticketing_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `name`, `email`, `phone`, `location`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Mathew Someks', 'ms@gmail.com', '9876543210', 'Xyz Place', '2018-10-26 05:40:12', '2018-10-26 05:40:59', NULL),
(2, 'Nandu Bhaiya', 'nandu@gmail.com', '6598659865', 'Bhopal', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `close_tickets`
--

CREATE TABLE `close_tickets` (
  `id` int(10) UNSIGNED NOT NULL,
  `ticket_id` int(11) DEFAULT NULL,
  `resolution_time` datetime DEFAULT NULL,
  `closing_noc_engineer` int(11) DEFAULT NULL,
  `clearence_officer_onclient_side` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cause_of_fault` int(11) DEFAULT NULL,
  `resolution_remark` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'open',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Network Operation Centre (NOC)', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', '2018-10-26 05:52:25', '2018-10-26 05:57:55'),
(2, 'Service Centre', 'when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,', '2018-10-26 05:52:41', '2018-10-26 05:52:41'),
(3, 'Field Engineer', 'Field Engineer', '2018-11-12 18:30:00', '2018-11-14 04:40:11');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(14, '2014_10_12_000000_create_users_table', 1),
(15, '2014_10_12_100000_create_password_resets_table', 1),
(16, '2018_10_23_101830_create_permission_tables', 1),
(17, '2018_10_23_105042_create_websitesettings_table', 1),
(18, '2018_10_26_052949_create_page_infos_table', 1),
(19, '2018_10_26_083453_create_services_table', 1),
(20, '2018_10_26_083750_create_clients_table', 1),
(21, '2018_10_26_084055_create_ticket_statuses_table', 1),
(22, '2018_10_26_111236_create_departments_table', 2),
(38, '2018_11_02_075229_create_ticket_generateds_table', 6),
(41, '2018_11_02_081057_create_ticket_processings_table', 7),
(42, '2018_11_02_081916_create_ticket_updates_table', 7),
(43, '2018_11_15_074016_create_regions_table', 8),
(44, '2018_11_19_094212_create_close_tickets_table', 9);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\User', 1);

-- --------------------------------------------------------

--
-- Table structure for table `page_infos`
--

CREATE TABLE `page_infos` (
  `id` int(10) UNSIGNED NOT NULL,
  `pageName` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `page_infos`
--

INSERT INTO `page_infos` (`id`, `pageName`, `description`, `created_at`, `updated_at`) VALUES
(1, 'service', 'Manage Service', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'users-list', 'web', '2018-10-26 04:12:35', '2018-10-26 04:12:35'),
(2, 'users-create', 'web', '2018-10-26 04:12:35', '2018-10-26 04:12:35'),
(3, 'users-edit', 'web', '2018-10-26 04:12:35', '2018-10-26 04:12:35'),
(4, 'users-delete', 'web', '2018-10-26 04:12:35', '2018-10-26 04:12:35'),
(6, 'role-list', 'web', '2018-10-26 04:12:35', '2018-10-26 04:12:35'),
(7, 'role-create', 'web', '2018-10-26 04:12:35', '2018-10-26 04:12:35'),
(8, 'role-edit', 'web', '2018-10-26 04:12:35', '2018-10-26 04:12:35'),
(9, 'role-delete', 'web', '2018-10-26 04:12:35', '2018-10-26 04:12:35'),
(10, 'permission-list', 'web', '2018-10-26 04:12:35', '2018-10-26 04:12:35'),
(11, 'permission-create', 'web', '2018-10-26 04:12:35', '2018-10-26 04:12:35'),
(12, 'permission-edit', 'web', '2018-10-26 04:12:35', '2018-10-26 04:12:35'),
(13, 'permission-delete', 'web', '2018-10-26 04:12:35', '2018-10-26 04:12:35'),
(14, 'app-setting', 'web', '2018-10-26 04:12:35', '2018-10-26 04:12:35'),
(15, 'service-list', 'web', '2018-10-26 04:29:17', '2018-10-26 04:29:17'),
(16, 'service-create', 'web', '2018-10-26 04:29:31', '2018-10-26 04:29:31'),
(17, 'service-edit', 'web', '2018-10-26 04:29:44', '2018-10-26 04:29:44'),
(18, 'ticket-status-list', 'web', '2018-10-26 04:29:56', '2018-10-26 04:29:56'),
(19, 'ticket-status-create', 'web', '2018-10-26 04:30:09', '2018-10-26 04:30:09'),
(20, 'ticket-status-edit', 'web', '2018-10-26 04:30:23', '2018-10-26 04:30:23'),
(21, 'client-list', 'web', '2018-10-26 05:25:14', '2018-10-26 05:25:14'),
(22, 'client-create', 'web', '2018-10-26 05:25:25', '2018-10-26 05:25:25'),
(23, 'client-edit', 'web', '2018-10-26 05:25:35', '2018-10-26 05:25:35'),
(24, 'department-list', 'web', '2018-10-26 05:48:57', '2018-10-26 05:48:57'),
(25, 'department-create', 'web', '2018-10-26 05:49:08', '2018-10-26 05:49:08'),
(26, 'department-edit', 'web', '2018-10-26 05:49:20', '2018-10-26 05:49:20'),
(27, 'ticket-generated', 'web', '2018-11-02 04:36:07', '2018-11-02 04:36:07'),
(28, 'ticket-processing', 'web', '2018-11-02 04:36:21', '2018-11-02 04:36:21'),
(29, 'ticket-updates', 'web', '2018-11-02 04:36:34', '2018-11-02 04:36:34'),
(30, 'ticket-create', 'web', '2018-11-02 05:10:11', '2018-11-02 05:10:11'),
(31, 'ticket-edit', 'web', '2018-11-05 02:56:02', '2018-11-05 02:56:02'),
(32, 'ticket-view', 'web', '2018-11-13 07:14:47', '2018-11-13 07:14:47');

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

CREATE TABLE `regions` (
  `id` int(10) UNSIGNED NOT NULL,
  `region_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `regions`
--

INSERT INTO `regions` (`id`, `region_name`, `created_at`, `updated_at`) VALUES
(1, 'South Kenya', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2018-10-26 04:12:35', '2018-10-26 04:12:35');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(30, 1),
(31, 1),
(32, 1);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Internet', '2018-10-26 04:12:36', '2018-10-26 04:12:36', NULL),
(2, 'Dark Fiber', '2018-10-26 04:12:36', '2018-10-26 04:12:36', NULL),
(3, 'Local Loop', '2018-10-26 04:12:36', '2018-10-26 04:12:36', NULL),
(4, 'Machine Servicing', '2018-10-26 04:12:36', '2018-10-26 04:12:36', NULL),
(5, 'RTU Monitoring', '2018-10-26 04:12:36', '2018-10-26 05:09:20', NULL),
(6, 'Network Planning and Design', '2018-10-26 04:12:36', '2018-10-26 04:12:36', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ticket_generateds`
--

CREATE TABLE `ticket_generateds` (
  `ticket_id` int(10) UNSIGNED NOT NULL,
  `client_id` int(11) NOT NULL,
  `region` text COLLATE utf8mb4_unicode_ci,
  `noc_engg_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `service_affected` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `status` enum('1','2','3','4') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '1=Open, 2=Closed, 3=Pending ,4=Cancelled ',
  `description` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link_affected` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reporting_time` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ticket_generateds`
--

INSERT INTO `ticket_generateds` (`ticket_id`, `client_id`, `region`, `noc_engg_id`, `employee_id`, `service_affected`, `department_id`, `status`, `description`, `link_affected`, `reporting_time`, `created_at`, `updated_at`) VALUES
(15, 1, 'South Kenya', 1, 13, 1, 1, '1', 'First Description and Gangrade is sent on the site', 'Jaiaa', '2018-11-16 12:00', '2018-11-16 01:14:20', '2018-11-20 07:06:15'),
(16, 1, 'South Kenya', 1, 9, 1, 2, '1', 'aaaa', '0aaaa', '2018-11-16 11:25', '2018-11-16 04:00:26', '2018-11-16 04:00:26'),
(17, 2, 'South Kenya', 1, 9, 5, 1, '1', 'Complaint sent by Nandu bhaiya', 'I dont know', '2018-11-20 13:45', '2018-11-20 06:06:20', '2018-11-20 06:06:20'),
(18, 2, 'South Kenya', 1, 7, 2, 2, '1', 'fdsafasfdsaf', '0fdfdasfasfasf', '2018-11-20 09:25', '2018-11-20 06:20:29', '2018-11-20 06:20:29'),
(19, 2, 'South Kenya', 1, 7, 5, 1, '1', 'fdsafsaf', 'any link', '2018-11-16 11:50', '2018-11-20 06:28:39', '2018-11-20 06:28:39'),
(20, 2, 'South Kenya', 1, 7, 5, 2, '1', 'asdfsaf', '2000000', '2018-11-21 14:30', '2018-11-20 07:01:36', '2018-11-20 07:01:36');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_processings`
--

CREATE TABLE `ticket_processings` (
  `id` int(10) UNSIGNED NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `service_affected` int(11) NOT NULL,
  `link_affected` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `region` text COLLATE utf8mb4_unicode_ci,
  `priority` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `naturOfFault` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `opening_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `closing_time` timestamp NULL DEFAULT NULL,
  `acc_request_time` timestamp NULL DEFAULT NULL,
  `acc_granted_time` timestamp NULL DEFAULT NULL,
  `escort_request_time` timestamp NULL DEFAULT NULL,
  `escort_granted_time` timestamp NULL DEFAULT NULL,
  `sla_resolution_time` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contactno` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `update_comments` text COLLATE utf8mb4_unicode_ci,
  `status` enum('1','2','3','4') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '1=Open, 2=Closed, 3=Pending ,4=Cancelled ',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ticket_statuses`
--

CREATE TABLE `ticket_statuses` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ticket_statuses`
--

INSERT INTO `ticket_statuses` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Open', '2018-10-26 04:12:36', '2018-10-26 04:12:36', NULL),
(2, 'Closed', '2018-10-26 04:12:36', '2018-10-26 04:12:36', NULL),
(3, 'Pending', '2018-10-26 04:12:36', '2018-10-26 04:12:36', NULL),
(4, 'Cancelled', '2018-10-26 04:12:36', '2018-10-26 04:12:36', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ticket_updates`
--

CREATE TABLE `ticket_updates` (
  `id` int(10) UNSIGNED NOT NULL,
  `update_id` int(11) DEFAULT NULL,
  `ticket_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `noc_operator` int(11) DEFAULT NULL,
  `opening_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `closing_time` timestamp NULL DEFAULT NULL,
  `status` enum('1','2','3','4') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '1=Open, 2=Closed, 3=Pending ,4=Cancelled ',
  `priority` varchar(110) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `new_employee_id` int(11) DEFAULT NULL,
  `new_opening_time` timestamp NULL DEFAULT NULL,
  `new_closing_time` timestamp NULL DEFAULT NULL,
  `acc_request_time` timestamp NULL DEFAULT NULL,
  `acc_granted_time` timestamp NULL DEFAULT NULL,
  `site_address` text COLLATE utf8mb4_unicode_ci,
  `escort_request_time` timestamp NULL DEFAULT NULL,
  `escort_granted_time` timestamp NULL DEFAULT NULL,
  `comments` text COLLATE utf8mb4_unicode_ci,
  `new_status` enum('1','2','3','4') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '2' COMMENT '1=Open, 2=Closed, 3=Pending ,4=Cancelled ',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ticket_updates`
--

INSERT INTO `ticket_updates` (`id`, `update_id`, `ticket_id`, `client_id`, `employee_id`, `noc_operator`, `opening_time`, `closing_time`, `status`, `priority`, `new_employee_id`, `new_opening_time`, `new_closing_time`, `acc_request_time`, `acc_granted_time`, `site_address`, `escort_request_time`, `escort_granted_time`, `comments`, `new_status`, `created_at`, `updated_at`) VALUES
(9, 2, 15, 1, 6, 1, '2018-11-20 12:36:02', NULL, '1', '1', NULL, NULL, NULL, '2018-11-13 23:51:23', '2018-11-14 13:20:00', 'NIrobi7878', '2018-11-17 05:30:00', '2018-11-17 12:30:00', 'abcde kumar', '2', '2018-11-17 00:48:31', '2018-11-20 07:06:02'),
(10, NULL, 15, 1, 7, 2, '2018-11-20 11:13:33', NULL, '1', '1', NULL, NULL, NULL, '2018-11-17 02:30:00', '2018-11-30 10:25:00', 'EADC', '2018-11-18 21:30:00', '2018-11-19 18:30:00', 'fgdfg', '2', '2018-11-17 06:28:19', '2018-11-20 05:43:33'),
(11, NULL, 15, 1, 9, 1, '2018-11-20 11:16:00', NULL, '1', '1', NULL, NULL, NULL, '2018-11-14 12:15:00', '2018-11-28 08:25:00', 'ABCD', NULL, NULL, 'Comment 4', '2', '2018-11-19 08:10:18', '2018-11-20 05:46:00'),
(12, NULL, 17, 2, 9, 1, '2018-11-20 11:41:24', NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', NULL, NULL),
(13, NULL, 17, 2, 7, 1, '2018-11-23 01:45:00', NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Now second is gangrade', '2', '2018-11-20 06:12:06', '2018-11-20 06:12:06'),
(14, 0, 18, 1, 7, 1, '2018-11-20 11:51:37', NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', NULL, NULL),
(15, NULL, 19, 2, 7, 1, '2018-11-20 11:58:39', NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', '2018-11-20 06:28:39', '2018-11-20 06:28:39'),
(16, NULL, 20, 2, 7, 1, '2018-11-20 12:31:36', NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', '2018-11-20 07:01:36', '2018-11-20 07:01:36');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `userType` int(11) NOT NULL DEFAULT '1' COMMENT '0-admin, 1-Network Operation Centre (NOC), 2-Service Centre, 3-Field Engineer',
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastName` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `access_token` text COLLATE utf8mb4_unicode_ci,
  `userRole` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'full address',
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'City',
  `zipcode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Zip code',
  `phone` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'phone number',
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '0=Active, 1=Deactive',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `userType`, `name`, `lastName`, `email`, `password`, `avatar`, `access_token`, `userRole`, `address`, `city`, `zipcode`, `phone`, `status`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 0, 'Johny', 'admin', 'admin@admin.com', '$2y$10$sbsrCQTI3Gwrseqhytu/8.ILcgUEJ5YvRn/lzTZPbIUz9M/HWReeG', 'sztvfz4lrn.jpg', NULL, NULL, 'XYZ Place', 'CityName', '123456', '9876543210', '0', '25vfBh0kKISft9pCXl452sLloR7GqSDjTrnxHxDo1o2Gkz7FvLlOhZIcZU4J', '2018-10-26 04:12:35', '2018-10-26 04:15:11', NULL),
(2, 1, 'Raj', 'baghel', 'ankit@gmail.com', '123456', NULL, NULL, NULL, 'arera colony bhopal', 'bhopal', '4152525', '74155825588', '0', NULL, '2018-11-01 07:12:37', '2018-11-01 07:45:14', NULL),
(3, 1, 'Ravi', 'dfgdg', 'dfjkgjkdfhjk@gmail.com', '123456', NULL, NULL, NULL, 'gdfgdfghdfgh', 'hjghj gh', '54564564', '5656464', '0', NULL, '2018-11-01 07:27:21', '2018-11-01 07:43:57', NULL),
(4, 1, 'Rashmi', 'eststst', 'kklj@gamil.com', '1234564', NULL, NULL, NULL, 'gvfghfhg', 'bhopal', '5646454', '46545455', '0', NULL, '2018-11-02 01:07:54', '2018-11-02 01:07:54', NULL),
(5, 2, 'Nitesh', 'hghjghjg', 'jhjkdfhj@gmail.com', '21354654', NULL, NULL, 'admin', 'fhdghg hhgj', 'bhoapl', '65465456', '54564564', '0', NULL, '2018-11-02 01:09:40', '2018-11-02 01:09:40', NULL),
(6, 3, 'Yogendra', 'dfgdfgdf', 'ankit.baghel09444@gmail.com', '123456', NULL, 'vA4qlfPTUkPghHmQ41kB2WZ6ahbJWbBp88zlLxaIfBOTLM3mTWwTTEkG7m2P', 'admin', 'bhjgjjhhjg', 'bhopal', '462016', '745757744', '0', NULL, '2018-11-03 00:52:37', '2018-11-03 00:52:37', NULL),
(7, 3, 'Gangrade', 'hjghjgjh', 'ankit.baghel0954255@gmail.com', '123456', NULL, 'ctnHL46kOd1385PYJ1XSkJg8rN1Xx8YooKhgat6WewmNbiq1RqoIitvjzued', 'admin', 'jkdfhskjh', 'bhoppla', '65465465', '7412525255', '0', NULL, '2018-11-03 00:55:14', '2018-11-03 00:55:14', NULL),
(9, 3, 'Tiwari', 'hjhhvbjh', 'ankit.baghel09@gmail.com', '1321564', NULL, 'G0s82bcCv0vXcXoEHB3iNOHSOJ4d9IaHNwo23Yg2Dz7riwJiJOzbbpoWN9Vf', 'admin', 'jhja gjhg ghhg', 'bhopal', '45454', '4654564566', '0', NULL, '2018-11-03 01:09:03', '2018-11-03 01:09:03', NULL),
(11, 2, 'Aiket', 'dssfd', 'admindfsgdsg@gmail.com', '123456', NULL, 'HSunebMT1OCmpqzTzUVVFxL4KbBBC6nLIdC1dRGAeqYHde5uaurSpxR349lB', 'admin', 'dsfsddsg', 'bopla', '56465465', '654654654', '0', NULL, '2018-11-03 01:14:26', '2018-11-03 01:14:26', NULL),
(12, 1, 'xyz', 'hfghfg', 'admin5465@gmail.com', '123456', NULL, '1f0TjsjS77TXqONNzAWMwHMIkFAQr24nYh5098IZaguk9EPcl6TG4ht3WubA', 'admin', 'fdsgfdhg', 'bhopal', '5465868', '546464', '0', NULL, '2018-11-03 01:19:17', '2018-11-03 01:19:17', NULL),
(13, 2, 'Avdhesh', 'singh', 'palak@gmail.com', '123456', NULL, 'jSBxAzbnVjFbYmISzaj5eFtp6MSZ60RsRz2HXps15GT7mIFngjBhITwUVWKy', 'admin', 'arera colony', 'bhopal', '745855', '57987878', '0', NULL, '2018-11-14 04:45:43', '2018-11-14 04:52:18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `websitesettings`
--

CREATE TABLE `websitesettings` (
  `id` int(10) UNSIGNED NOT NULL,
  `website_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website_logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `watermark` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `locktimeout` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobilenum` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `openingTime` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fb_link` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tw_link` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `li_link` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `yt_link` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `in_link` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gp_link` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ga` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `websitesettings`
--

INSERT INTO `websitesettings` (`id`, `website_name`, `website_logo`, `watermark`, `email`, `locktimeout`, `address`, `mobilenum`, `openingTime`, `fb_link`, `tw_link`, `li_link`, `yt_link`, `in_link`, `gp_link`, `ga`, `created_at`, `updated_at`) VALUES
(1, 'Ticketing System', 'ticketing-system.svg', NULL, NULL, '30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-10-26 04:13:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `close_tickets`
--
ALTER TABLE `close_tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `page_infos`
--
ALTER TABLE `page_infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticket_generateds`
--
ALTER TABLE `ticket_generateds`
  ADD PRIMARY KEY (`ticket_id`);

--
-- Indexes for table `ticket_processings`
--
ALTER TABLE `ticket_processings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ticket_processings_ticket_id_unique` (`ticket_id`);

--
-- Indexes for table `ticket_statuses`
--
ALTER TABLE `ticket_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticket_updates`
--
ALTER TABLE `ticket_updates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `websitesettings`
--
ALTER TABLE `websitesettings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `close_tickets`
--
ALTER TABLE `close_tickets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `page_infos`
--
ALTER TABLE `page_infos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ticket_generateds`
--
ALTER TABLE `ticket_generateds`
  MODIFY `ticket_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `ticket_processings`
--
ALTER TABLE `ticket_processings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ticket_statuses`
--
ALTER TABLE `ticket_statuses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ticket_updates`
--
ALTER TABLE `ticket_updates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `websitesettings`
--
ALTER TABLE `websitesettings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
