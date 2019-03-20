-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 19, 2019 at 06:24 AM
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
(1, 'Wananchi Telcom', 'wananch@telkom.com', '0732568954', 'Gateway Park', '2018-10-26 00:10:12', '2018-11-21 06:08:29', NULL),
(2, 'Safaricom SDC', 'txnoc@safaricom.co.ke', '0722002380', 'Westlands', '2018-11-21 06:02:44', '2018-11-21 06:02:44', NULL),
(3, 'Kenet', 'sysadmins@kenet.or.ke', '0732150000', 'Nairobi', '2018-12-06 04:26:59', '2018-12-06 04:26:59', NULL),
(4, 'FON', 'noc@fon.co.ke', '0709114000', 'Westlands', '2018-12-06 04:30:01', '2018-12-06 04:30:01', NULL),
(5, 'Nairobi Water', 'JThuo@nairobiwater.co.ke', '0736426199', 'Nairobi', '2018-12-06 04:36:29', '2018-12-06 04:36:29', NULL),
(6, 'Unwired Communications', 'support@unwired.co.ke', '0722408837', 'Nairobi', '2018-12-06 04:41:35', '2018-12-06 04:41:35', NULL),
(7, 'Liquid Telcom', 'mmeksmatt@gmail.com', '721489544', 'Sameer Park', '2018-12-07 05:42:28', '2018-12-07 05:42:28', NULL),
(8, 'Seacom', 'inoc@seacom.mu', '254721489544', 'Nairobi', '2018-12-13 07:04:26', '2018-12-13 07:04:26', NULL),
(9, 'Safaricom NPS', 'xxx@gmail.com', '254721489544', 'Nairobi', '2018-12-13 12:03:10', '2018-12-13 12:03:10', NULL),
(10, 'Access Kenya', 'xxx@gmail.com', '254721489544', 'Nairobi', '2018-12-13 12:05:07', '2018-12-13 12:05:07', NULL),
(11, 'EMC', 'xxx@gmail.com', '254721489544', 'Nairobi', '2018-12-13 12:06:44', '2018-12-13 12:06:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `client_contact_lists`
--

CREATE TABLE `client_contact_lists` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `employee_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `client_contact_lists`
--

INSERT INTO `client_contact_lists` (`id`, `client_id`, `employee_name`, `contact_no`, `created_at`, `updated_at`) VALUES
(1, 2, 'Benard Kotonya', '0725 555 576', '2018-12-02 21:45:08', '2018-12-02 21:45:31');

-- --------------------------------------------------------

--
-- Table structure for table `close_tickets`
--

CREATE TABLE `close_tickets` (
  `id` int(10) UNSIGNED NOT NULL,
  `ticket_id` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `resolution_time` datetime DEFAULT NULL,
  `closing_noc_engineer` int(11) DEFAULT NULL,
  `clearence_officer_onclient_side` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cause_of_fault` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resolution_remark` longtext COLLATE utf8mb4_unicode_ci,
  `status` enum('1','2','3','4') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '2' COMMENT '1=Open, 2=Closed, 3=Pending ,4=Cancelled',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `close_tickets`
--

INSERT INTO `close_tickets` (`id`, `ticket_id`, `client_id`, `resolution_time`, `closing_noc_engineer`, `clearence_officer_onclient_side`, `cause_of_fault`, `resolution_remark`, `status`, `created_at`, `updated_at`) VALUES
(16, 'SLT-6531', 2, '2018-12-07 18:35:00', 1, 'Irene Wegendi', 'Fire', 'There was another break 500m from the initial fault at Makuyu.', '2', '2018-12-07 10:01:30', '2018-12-07 10:01:30'),
(17, 'SLT-1852', 2, '2018-12-07 18:37:00', 1, 'Daniel Mosabi', 'Cable', 'There is a break at 1.4km from a manhole outside Kandiga. Exact Point of fault located at Kaaga Secondary caused H.Young Road construction company, restored after splicing was completed', '2', '2018-12-07 11:09:58', '2018-12-07 11:15:09'),
(20, 'SLT-8785', 1, '2018-12-12 14:30:00', 1, 'Mustafa', 'Construction', '24 hrs the ticket is closed', '2', '2018-12-11 09:10:34', '2018-12-11 09:10:34'),
(21, 'SLT-2898', 1, '2018-11-21 15:25:00', 1, 'Joseph Wainaina', 'Construction', 'Test done at Langata Cemetry showed a break at 2.2km towards Loman. Point of fault was located at Southern bypass caused by  Nairobi water.', '2', '2018-12-13 09:40:21', '2018-12-13 09:40:21'),
(22, 'SLT-6360', 4, '2018-12-13 14:25:00', 1, 'Abdi Jama', 'Construction', 'Point of fault was located at Mtindwa. An exposed cable had been vandalized by unknown persons.Team pilled a slag of 50m, introduced one joint closure kit.', '2', '2018-12-13 12:02:33', '2018-12-13 12:33:01'),
(23, 'SLT-7183', 2, '2018-12-13 16:48:00', 1, 'NPS NOC', 'Construction', 'There was a power issue at Likoni', '2', '2018-12-13 12:24:24', '2018-12-13 12:24:24'),
(24, 'SLT-5714', 1, '2018-12-13 16:48:00', 1, 'Mathew Somek', 'Fiber Okey', 'Fault being handled by Huawei', '3', '2018-12-13 12:26:48', '2018-12-13 12:26:48'),
(25, 'SLT-8435', 8, '2018-12-13 16:31:00', 1, 'Davis Murimi', 'Construction', 'Test done at Langata Cemetry showed a break at 2.2km towards Loman. Point of fault was located at Southern bypass caused by  Nairobi water.', '2', '2018-12-13 12:30:32', '2018-12-13 12:30:32'),
(26, 'SLT-2161', 7, '2018-12-13 18:35:00', 36, 'Edward Lunyangi', 'Exposed', 'Overhead section had been vandalized at kisukioni  by unknown person. Team introduced one joint closure kit hence uptime.', '2', '2018-12-13 13:05:10', '2018-12-13 13:05:10'),
(27, 'SLT-3145', 2, '2018-12-13 20:34:00', 37, 'Daniel Mosabi.', 'Construction', 'Fault point located at Majimbo area due to ongoing Sewerage construction. The trench was very deep, about 15m. Team re spliced the cores hence uptime.', '2', '2018-12-13 15:25:00', '2018-12-13 15:25:00'),
(28, 'SLT-593', 9, '2018-12-13 21:10:00', 31, 'Safaricom NPS', 'Others', 'There was a power issue at Camera 009', '2', '2018-12-14 08:41:13', '2018-12-14 08:41:13'),
(29, 'SLT-8474', 2, '2018-12-13 18:54:00', 31, 'SDC NOC', 'Construction', 'Fault was at Majengo mapya area caused by county gov\'t who are currently drilling drainage chanel along the route.', '2', '2018-12-14 08:43:26', '2018-12-14 08:43:26'),
(30, 'SLT-7313', 3, '2018-12-14 13:40:00', 31, 'Joy Otuya', 'Construction', 'Point of fault located at Southern bypass - Langata Junction caused by Nairobi Water.', '2', '2018-12-14 08:52:38', '2018-12-14 08:52:38'),
(31, 'SLT-7494', 1, '2018-12-18 07:30:00', 42, 'aaaaaa', 'Construction', 'aaaa', '2', '2018-12-14 09:05:44', '2018-12-14 09:05:44'),
(32, 'SLT-7940', 3, '2018-12-14 16:31:00', 36, 'Leonard Mwangi', 'Construction', 'not a fault. safaricom team inserting a new site on the link.', '4', '2018-12-14 09:46:11', '2018-12-14 09:46:11'),
(33, 'SLT-6713', 4, '2018-12-14 17:39:00', 36, 'wainaina', 'Others', 'fault point was located at kingara rd near nakumatt junction, cable had been vandalized by unknown person. Team re spliced at the closure .', '2', '2018-12-14 13:26:53', '2018-12-14 13:26:53'),
(34, 'SLT-1202', 2, '2018-12-14 07:35:00', 37, 'Daniel Mosabi.', 'Construction', 'The point of fault  located along Moi International Airport (MIA) fence. Our team delayed with restoration at the fault site due to lack of permission from the MIA authorities.', '2', '2018-12-15 06:37:45', '2018-12-15 06:37:45'),
(35, 'SLT-1187', 2, '2018-12-16 03:44:00', 36, 'James Kikolya', 'Others', 'Cable had been vandalized at 500m from kibwezi town bts near kcb by unknown. Team run a 25m cable and introduce 2 joint closure kits', '2', '2018-12-15 22:25:59', '2018-12-15 22:25:59'),
(36, 'SLT-1876', 2, '2018-12-15 21:20:00', 36, 'James Kikolya,', 'Construction', 'Team inserted an new site between Getune and Bulla and seems the loop is not working hence team has removed the loop.& spliced through. Team replaced the sfp at Bulla hence low power cleared.', '2', '2018-12-16 16:27:00', '2018-12-16 16:39:00'),
(37, 'SLT-3318', 7, '2018-12-14 23:30:00', 36, 'Nelly Mumbi', 'Others', 'Point of fault was located near Kisukioni Tala, cable is said to have been cut with a blunt object by unknown person. Team introduced one closure and re spliced the cores.', '2', '2018-12-16 16:29:42', '2018-12-16 16:29:42'),
(38, 'SLT-6807', 2, '2018-12-17 00:10:00', 36, 'Leonard Mwangi', 'Others', 'Test showed a fiber break at 2.1km from mkoyo, cable had been damaged at Diani navy camp by unknown person. Tean run a 50m cable and introduced 2 joint closure kits', '2', '2018-12-16 19:20:33', '2018-12-16 19:20:33'),
(39, 'SLT-3526', 2, '2018-12-15 03:10:00', 36, 'Catherine Thiiri.', 'Construction', 'Tests done at Portrietz BTS shows cuts on one core at 6.5km towatds Kwa jomvu and the other core at 591m towards Migadini west. The point of fault has been located along Moi International Airport (MIA) fence.', '2', '2018-12-17 01:33:43', '2018-12-17 01:33:43'),
(40, 'SLT-7429', 2, '2018-12-15 12:57:00', 36, 'Leonard Mwangi', 'Construction', 'Tests done reveal our section to be fine', '2', '2018-12-17 01:40:52', '2018-12-17 01:40:52'),
(41, 'SLT-6581', 2, '2018-12-15 07:20:00', 36, 'Catherine Thiiri.', 'Construction', 'The point of fault  located along Moi International Airport (MIA) fence. Our team delayed with restoration at the fault site due to lack of permission from the MIA authorities. A MH was destroyed due to road expansion. Team introduced one closure and re spliced the cores hence uptime.', '2', '2018-12-17 01:43:08', '2018-12-17 01:43:08'),
(42, 'SLT-7443', 3, '2018-12-14 07:31:00', 36, 'Evans Ng\'ang\'a', 'Construction', 'The point of fault was located at 500 m from Juja weigh bridge. The cable was extensively damaged by truck which was trenching sewerage line along the route. Team pulled 250 m tie cable, introduced two closures and re spliced the cores.', '2', '2018-12-17 01:48:10', '2018-12-17 01:48:10'),
(43, 'SLT-5058', 2, '2018-12-14 13:15:00', 37, 'Catherine Thiiri.', 'Construction', 'Team changed patch cords on Seacom rack at Orange_Tel_Hse Msa. Further tests reveals a point of high lose at 16km towards Icolo from telephone hse. The point of fault has been located along Moi International Airport (MIA) fence. Our team delayed with restoration at the fault site due to lack of permission from the MIA authorities. A MH was destroyed due to road expansion.', '2', '2018-12-17 02:48:15', '2018-12-17 02:48:15'),
(44, 'SLT-6658', 9, '2018-12-15 08:29:00', 37, 'Catherine Thiiri.', 'Construction', 'No power at HD9', '2', '2018-12-17 02:50:05', '2018-12-17 02:50:05'),
(45, 'SLT-8328', 4, '2018-12-14 12:14:00', 37, 'Catherine Thiiri.', 'Construction', '\"The point of fault is located at 500 m from Juja weigh bridge. The cable was extensively damaged by truck which was trenching sewerage line along the route. Team have pulled 250 m tie cable, introduced two closures and re spliced the cores.', '2', '2018-12-17 02:50:57', '2018-12-17 02:52:11'),
(46, 'SLT-8457', 4, '2018-12-13 12:20:00', 37, 'nelly', 'Construction', 'CORE replaced by Gachigi\'s team', '2', '2018-12-17 02:53:10', '2018-12-17 02:53:10'),
(47, 'SLT-2110', 6, '2018-12-13 18:54:00', 37, 'nelly', 'Construction', 'This was a test ticket', '2', '2018-12-17 07:46:30', '2018-12-17 07:46:30'),
(48, 'SLT-5386', 1, '2018-12-14 07:35:00', 37, 'Daniel Mosabi.', 'Construction', 'This was a test ticket', '2', '2018-12-17 07:53:33', '2018-12-17 07:53:33'),
(49, 'SLT-4117', 7, '2018-12-17 13:39:00', 37, 'Kennedy kamau', 'Construction', 'Point of fault is at Kisukioni.  Cable cut by a blunt object by unknown person.', '2', '2018-12-17 08:42:22', '2018-12-17 08:42:22'),
(50, 'SLT-846', 1, '2018-12-17 14:50:00', 37, 'Festus', 'Construction', 'Fault was 670m from MOI. Closure vandalized at a temporary section', '2', '2018-12-17 10:05:44', '2018-12-17 10:05:44'),
(51, 'SLT-5013', 3, '2018-12-17 18:05:00', 1, 'Brian Kenyatta', 'Exposed', 'The point of fault located at PAC University Cable vandalized by unknown person, opened closure and cut the fibers on a temporarily section. Our team did re-spliced all the affected cores hence service restored.', '2', '2018-12-17 12:54:39', '2018-12-17 12:54:39'),
(52, 'SLT-174', 3, '2018-12-17 18:05:00', 1, 'Brian Kenyatta', 'Exposed', 'The point of fault located at PAC University Cable vandalized by unknown person, opened closure and cut the fibers on a temporarily section. Our team did re-spliced all the affected cores hence service restored.', '2', '2018-12-17 12:55:26', '2018-12-17 12:55:26'),
(53, 'SLT-1039', 3, '2018-12-17 18:05:00', 1, 'Brian Kenyatta', 'Exposed', 'The point of fault located at PAC University Cable vandalized by unknown person, opened closure and cut the fibers on a temporarily section. Our team did re-spliced all the affected cores hence service restored.', '2', '2018-12-17 12:59:07', '2018-12-17 12:59:07'),
(54, 'SLT-3024', 2, '2018-12-17 17:27:00', 1, 'Leonard Mwangi', 'Patch', 'FE cleaned patch cords at Isiolo_Morire hence power levels improved.', '2', '2018-12-17 14:14:20', '2018-12-17 14:14:20'),
(55, 'SLT-579', 4, '2018-12-17 19:42:00', 1, 'Monitoring system', 'Construction', 'The point of fault located at Water Front Langata road due to road construction.  Our team did replace a 300m cable introduced two closures and re spliced the cores hence uptime.', '2', '2018-12-17 14:42:35', '2018-12-17 14:42:35'),
(56, 'SLT-937', 8, '2018-12-17 19:31:00', 1, 'Suleiman Nassor', 'Construction', 'The point of fault located at Water Front Langata road due to road construction.  Our team did replace a 300m cable introduced two closures and re spliced the cores hence uptime.', '2', '2018-12-17 14:43:59', '2018-12-17 14:43:59'),
(57, 'SLT-509', 5, '2018-12-17 19:32:00', 1, 'Sammy Wanjala', 'Construction', 'The point of fault located at Water Front Langata road due to road construction.  Our team did replace a 300m cable introduced two closures and re spliced the cores hence uptime.', '2', '2018-12-17 15:25:09', '2018-12-17 15:25:09'),
(58, 'SLT-7318', 2, '2018-12-17 21:15:00', 1, 'Kipngetich Denis', 'Others', 'Access to be granted tomorrow.', '3', '2018-12-17 15:46:48', '2018-12-17 15:46:48'),
(59, 'SLT-16975', 1, '2018-12-19 23:30:00', 1, 'aa', 'Construction', 'aa', '2', '2018-12-19 11:08:39', '2018-12-19 11:08:39'),
(60, 'SLT-60473', 1, '2018-12-22 02:00:00', 1, 'aaaaaaaaa', 'Construction', 'aaaaaaaaaaaaaaa', '2', '2018-12-21 06:45:47', '2018-12-21 06:45:47'),
(61, 'SLT-84906', 1, '2018-12-22 15:30:00', 1, 'aaa', 'Construction', 'aaa', '2', '2018-12-21 08:15:25', '2018-12-21 08:15:25'),
(62, 'SLT-11223', 5, '2019-01-18 23:00:00', 1, 'pqrs', 'Patch', 'resolution remark', '2', '2019-01-18 10:05:50', '2019-01-18 10:05:50');

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
(1, 'Network Operation Centre (NOC)', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', '2018-10-26 00:22:25', '2018-10-26 00:27:55'),
(2, 'Service Centre', 'when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,', '2018-10-26 00:22:41', '2018-10-26 00:22:41'),
(3, 'Field Engineer', 'Field Engineer', '2018-11-12 13:00:00', '2018-11-13 23:10:11');

-- --------------------------------------------------------

--
-- Table structure for table `engg_drivers`
--

CREATE TABLE `engg_drivers` (
  `id` int(10) UNSIGNED NOT NULL,
  `region_id` int(11) DEFAULT NULL,
  `designation` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desName` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desId` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desContactno_one` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desContact_two` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desContact_three` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `driverAssginName` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `driver_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `car_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `engg_drivers`
--

INSERT INTO `engg_drivers` (`id`, `region_id`, `designation`, `desName`, `desId`, `desContactno_one`, `desContact_two`, `desContact_three`, `driverAssginName`, `driver_no`, `car_no`, `created_at`, `updated_at`) VALUES
(1, 1, 'Team leader', 'ankit singh', 'H6558DEE', '745858515', NULL, NULL, 'Amit kumar', '78788585554', 'mp04sg8574', '2018-12-03 00:34:45', '2018-12-03 00:53:23'),
(2, 5, 'Team leader', 'Ahmed Abdihamid', '2563658', '254725537368', NULL, NULL, 'Risala', '254721489544', 'KBJ 253 J', '2018-12-12 03:48:20', '2018-12-12 03:48:20'),
(3, 5, 'Team leader', 'joseph Wambua', 'Field Engineer', '0780961737', NULL, NULL, 'moha DRIVER', '0720082390', NULL, '2018-12-17 07:24:32', '2018-12-17 07:24:32');

-- --------------------------------------------------------

--
-- Table structure for table `kb_site_infos`
--

CREATE TABLE `kb_site_infos` (
  `id` int(10) UNSIGNED NOT NULL,
  `old_site_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `new_site_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kb_site_infos`
--

INSERT INTO `kb_site_infos` (`id`, `old_site_id`, `new_site_id`, `site_name`, `created_at`, `updated_at`) VALUES
(1, 'EC0001', '12083_NE_EC00013', 'EC0001-Athi_River_South_Hub_MSR-0', '2018-12-02 20:27:22', '2018-12-07 12:37:03'),
(2, 'NI0001', '12001_NW_NI0001', '12001_NW_NI0001-Safaricom_House_VIP_BNK_IBS', '2018-12-02 20:32:15', '2018-12-02 20:32:15');

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
(1, 'App\\User', 1),
(1, 'App\\User', 38),
(1, 'App\\User', 39),
(1, 'App\\User', 40),
(1, 'App\\User', 41),
(1, 'App\\User', 44),
(1, 'App\\User', 46),
(1, 'App\\User', 49),
(2, 'App\\User', 31),
(2, 'App\\User', 33),
(2, 'App\\User', 34),
(2, 'App\\User', 36),
(2, 'App\\User', 37),
(2, 'App\\User', 42),
(2, 'App\\User', 43),
(2, 'App\\User', 50);

-- --------------------------------------------------------

--
-- Table structure for table `nature_of__faults`
--

CREATE TABLE `nature_of__faults` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `nature_of__faults`
--

INSERT INTO `nature_of__faults` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Construction', '2018-11-30 05:07:34', '0000-00-00 00:00:00'),
(2, 'Exposed', '2018-11-30 05:07:42', '0000-00-00 00:00:00'),
(3, 'Cable', '2018-12-14 05:32:14', '2018-12-14 08:32:14'),
(4, 'Fire', '2018-11-30 05:08:01', '0000-00-00 00:00:00'),
(5, 'Moles', '2018-11-30 05:08:07', '0000-00-00 00:00:00'),
(6, 'Patch', '2018-11-30 05:08:18', '0000-00-00 00:00:00'),
(7, 'Cords', '2018-11-30 05:08:26', '0000-00-00 00:00:00'),
(8, 'No intervention', '2018-11-30 05:08:46', '0000-00-00 00:00:00'),
(9, 'Fiber Okey', '2018-11-30 05:09:01', '0000-00-00 00:00:00'),
(10, 'Optimization', '2018-11-30 05:09:20', '0000-00-00 00:00:00'),
(11, 'Others', '2018-11-30 05:09:31', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `nofbis`
--

CREATE TABLE `nofbis` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `network` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `section` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `length` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `region_id` int(11) DEFAULT NULL,
  `sla` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duration` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nofbis`
--

INSERT INTO `nofbis` (`id`, `client_id`, `network`, `section`, `length`, `region_id`, `sla`, `duration`, `created_at`, `updated_at`) VALUES
(1, 2, 'METRO', 'MARSABIT', '5.960', 1, 'SLA-2', '36 months', '2018-12-03 02:02:28', '2018-12-03 02:02:28');

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

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('admin@admin.com', '$2y$10$sYiAnL20RzWkpuApFTh8qeonsg5oivn6CnsD3rAC7Swd.73NnAPOW', '2018-12-07 02:52:27'),
('ajjuwekar@gmail.com', '$2y$10$Qn2YrXixPES6.2yMxearju/UhBoSCBtYNn2k4YKDeAQ1penDJD52S', '2018-12-07 07:50:50');

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
(1, 'users-list', 'web', '2018-10-25 22:42:35', '2018-10-25 22:42:35'),
(2, 'users-create', 'web', '2018-10-25 22:42:35', '2018-10-25 22:42:35'),
(3, 'users-edit', 'web', '2018-10-25 22:42:35', '2018-10-25 22:42:35'),
(4, 'users-delete', 'web', '2018-10-25 22:42:35', '2018-10-25 22:42:35'),
(6, 'role-list', 'web', '2018-10-25 22:42:35', '2018-10-25 22:42:35'),
(7, 'role-create', 'web', '2018-10-25 22:42:35', '2018-10-25 22:42:35'),
(8, 'role-edit', 'web', '2018-10-25 22:42:35', '2018-10-25 22:42:35'),
(9, 'role-delete', 'web', '2018-10-25 22:42:35', '2018-10-25 22:42:35'),
(10, 'permission-list', 'web', '2018-10-25 22:42:35', '2018-10-25 22:42:35'),
(11, 'permission-create', 'web', '2018-10-25 22:42:35', '2018-10-25 22:42:35'),
(12, 'permission-edit', 'web', '2018-10-25 22:42:35', '2018-10-25 22:42:35'),
(13, 'permission-delete', 'web', '2018-10-25 22:42:35', '2018-10-25 22:42:35'),
(14, 'app-setting', 'web', '2018-10-25 22:42:35', '2018-10-25 22:42:35'),
(15, 'service-list', 'web', '2018-10-25 22:59:17', '2018-10-25 22:59:17'),
(16, 'service-create', 'web', '2018-10-25 22:59:31', '2018-10-25 22:59:31'),
(17, 'service-edit', 'web', '2018-10-25 22:59:44', '2018-10-25 22:59:44'),
(18, 'ticket-status-list', 'web', '2018-10-25 22:59:56', '2018-10-25 22:59:56'),
(19, 'ticket-status-create', 'web', '2018-10-25 23:00:09', '2018-10-25 23:00:09'),
(20, 'ticket-status-edit', 'web', '2018-10-25 23:00:23', '2018-10-25 23:00:23'),
(21, 'client-list', 'web', '2018-10-25 23:55:14', '2018-10-25 23:55:14'),
(22, 'client-create', 'web', '2018-10-25 23:55:25', '2018-10-25 23:55:25'),
(23, 'client-edit', 'web', '2018-10-25 23:55:35', '2018-10-25 23:55:35'),
(24, 'department-list', 'web', '2018-10-26 00:18:57', '2018-10-26 00:18:57'),
(25, 'department-create', 'web', '2018-10-26 00:19:08', '2018-10-26 00:19:08'),
(26, 'department-edit', 'web', '2018-10-26 00:19:20', '2018-10-26 00:19:20'),
(27, 'open-ticket-list', 'web', '2018-11-01 23:06:07', '2018-12-14 05:47:52'),
(28, 'open-ticket-create', 'web', '2018-11-01 23:06:21', '2018-12-14 05:48:13'),
(30, 'open-ticket-edit', 'web', '2018-11-01 23:40:11', '2018-12-14 05:48:27'),
(31, 'open-ticket-delete', 'web', '2018-11-04 21:26:02', '2018-12-14 05:48:45'),
(32, 'closed-ticket-list', 'web', '2018-11-13 01:44:47', '2018-12-14 05:49:00'),
(33, 'pending-ticket-list', 'web', '2018-11-22 07:08:32', '2018-12-14 05:49:14'),
(34, 'cancelled-ticket-list', 'web', '2018-11-28 23:47:30', '2018-12-14 05:49:49'),
(35, 'report-rfo', 'web', '2018-12-14 07:02:07', '2018-12-14 07:02:07'),
(36, 'report-mttr', 'web', '2018-12-14 07:02:21', '2018-12-14 07:02:21'),
(37, 'report-fault', 'web', '2018-12-14 07:02:39', '2018-12-14 07:02:39'),
(38, 'report-escort', 'web', '2018-12-14 07:02:55', '2018-12-14 07:02:55'),
(39, 'report-access', 'web', '2018-12-14 07:03:21', '2018-12-14 07:03:21'),
(40, 'report-fault-analysis', 'web', '2018-12-14 07:03:33', '2018-12-14 07:03:33'),
(41, 'kb-client-list', 'web', '2018-12-14 07:03:44', '2018-12-14 07:03:44'),
(42, 'kb-client-create', 'web', '2018-12-14 07:03:55', '2018-12-14 07:03:55'),
(43, 'kb-client-edit', 'web', '2018-12-14 07:04:10', '2018-12-14 07:04:10'),
(44, 'kb-client-delete', 'web', '2018-12-14 07:04:20', '2018-12-14 07:04:20'),
(45, 'kb-soliton-list', 'web', '2018-12-14 07:04:31', '2018-12-14 07:04:31'),
(46, 'kb-soliton-create', 'web', '2018-12-14 07:04:43', '2018-12-14 07:04:43'),
(47, 'kb-soliton-edit', 'web', '2018-12-14 07:04:55', '2018-12-14 07:04:55'),
(48, 'kb-soliton-delete', 'web', '2018-12-14 07:05:06', '2018-12-14 07:05:06'),
(49, 'kb-maintenance-list', 'web', '2018-12-14 07:05:21', '2018-12-14 07:05:21'),
(50, 'kb-maintenance-create', 'web', '2018-12-14 07:05:36', '2018-12-14 07:05:36'),
(51, 'kb-maintenance-edit', 'web', '2018-12-14 07:05:49', '2018-12-14 07:05:49'),
(52, 'kb-maintenance-delete', 'web', '2018-12-14 07:06:22', '2018-12-14 07:06:22'),
(53, 'sms-list', 'web', '2018-12-14 07:06:36', '2018-12-14 07:06:36'),
(54, 'sms-edit', 'web', '2018-12-14 07:06:46', '2018-12-14 07:06:46'),
(55, 'kb-site-list', 'web', '2018-12-14 07:06:57', '2018-12-14 07:06:57'),
(56, 'kb-site-create', 'web', '2018-12-14 07:07:07', '2018-12-14 07:07:07'),
(57, 'kb-site-edit', 'web', '2018-12-14 07:07:19', '2018-12-14 07:07:19'),
(58, 'kb-site-delete', 'web', '2018-12-14 07:07:28', '2018-12-14 07:07:28'),
(59, 'natureoffault-list', 'web', '2018-12-14 08:30:53', '2018-12-14 08:30:53'),
(60, 'natureoffault-create', 'web', '2018-12-14 08:31:10', '2018-12-14 08:31:10'),
(61, 'natureoffault-edit', 'web', '2018-12-14 08:31:20', '2018-12-14 08:31:20'),
(62, 'natureoffault-delete', 'web', '2018-12-14 08:31:30', '2018-12-14 08:31:30');

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
(1, 'Nairobi', NULL, NULL),
(2, 'Central', NULL, NULL),
(3, 'North Eastern', NULL, NULL),
(5, 'Coast', '2018-12-11 07:26:55', '2018-12-11 07:26:55');

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
(1, 'admin', 'web', '2018-10-25 22:42:35', '2018-10-25 22:42:35'),
(2, 'NOC Engineer', 'web', '2018-12-07 04:01:15', '2018-12-12 05:29:17');

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
(1, 2),
(2, 1),
(2, 2),
(3, 1),
(3, 2),
(4, 1),
(4, 2),
(6, 1),
(6, 2),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(10, 2),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(14, 2),
(15, 1),
(15, 2),
(16, 1),
(16, 2),
(17, 1),
(17, 2),
(18, 1),
(18, 2),
(19, 1),
(19, 2),
(20, 1),
(20, 2),
(21, 1),
(21, 2),
(22, 1),
(22, 2),
(23, 1),
(23, 2),
(24, 1),
(24, 2),
(25, 1),
(25, 2),
(26, 1),
(26, 2),
(27, 1),
(27, 2),
(28, 1),
(28, 2),
(30, 1),
(30, 2),
(31, 1),
(31, 2),
(32, 1),
(32, 2),
(33, 1),
(33, 2),
(34, 1),
(34, 2),
(35, 1),
(35, 2),
(36, 1),
(36, 2),
(37, 1),
(37, 2),
(38, 1),
(38, 2),
(39, 1),
(39, 2),
(40, 1),
(40, 2),
(41, 1),
(41, 2),
(42, 1),
(42, 2),
(43, 1),
(43, 2),
(44, 1),
(44, 2),
(45, 1),
(45, 2),
(46, 1),
(46, 2),
(47, 1),
(47, 2),
(48, 1),
(48, 2),
(49, 1),
(49, 2),
(50, 1),
(50, 2),
(51, 1),
(51, 2),
(52, 1),
(52, 2),
(53, 1),
(53, 2),
(54, 1),
(54, 2),
(55, 1),
(55, 2),
(56, 1),
(56, 2),
(57, 1),
(57, 2),
(58, 1),
(58, 2),
(59, 1),
(59, 2),
(60, 1),
(60, 2),
(61, 1),
(61, 2),
(62, 1),
(62, 2);

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
(1, 'Internet', '2018-10-25 22:42:36', '2018-10-25 22:42:36', NULL),
(2, 'Dark Fiber', '2018-10-25 22:42:36', '2018-10-25 22:42:36', NULL),
(3, 'Local Loop', '2018-10-25 22:42:36', '2018-10-25 22:42:36', NULL),
(4, 'Machine Servicing', '2018-10-25 22:42:36', '2018-10-25 22:42:36', NULL),
(5, 'RTU Monitoring', '2018-10-25 22:42:36', '2018-10-25 23:39:20', NULL),
(6, 'Network Planning and Design', '2018-10-25 22:42:36', '2018-10-25 22:42:36', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sms_settings`
--

CREATE TABLE `sms_settings` (
  `id` int(11) NOT NULL,
  `stage` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `decision` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sms_settings`
--

INSERT INTO `sms_settings` (`id`, `stage`, `decision`, `created_at`, `updated_at`) VALUES
(1, 'Opening Fault', 'Yes', '2018-12-12 02:31:28', '2018-12-12 05:31:28'),
(2, 'SLA Reminder', 'Yes', '2018-12-07 12:43:37', '2018-12-07 12:43:37'),
(3, 'Reassign FE', 'Yes', '2018-12-07 12:43:39', '2018-12-07 12:43:39'),
(4, 'Reopen Ticket', 'No', '2018-12-17 06:56:43', '2018-12-17 09:56:43'),
(5, 'Fault Cleared', 'Yes', '2018-12-08 02:27:32', '2018-12-08 05:27:32');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_generateds`
--

CREATE TABLE `ticket_generateds` (
  `id` int(11) NOT NULL,
  `ticket_id` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `region` text COLLATE utf8mb4_unicode_ci,
  `noc_engg_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `service_affected` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `priority` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `naturOfFault` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('1','2','3','4') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '1=Open, 2=Closed, 3=Pending ,4=Cancelled ',
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `link_affected` longtext COLLATE utf8mb4_unicode_ci,
  `reporting_time` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `clientticketno` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fault_reported_by` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ticket_generateds`
--

INSERT INTO `ticket_generateds` (`id`, `ticket_id`, `client_id`, `region`, `noc_engg_id`, `employee_id`, `service_affected`, `department_id`, `priority`, `naturOfFault`, `status`, `description`, `link_affected`, `reporting_time`, `clientticketno`, `fault_reported_by`, `created_at`, `updated_at`) VALUES
(37, 'SLT-1852', 2, 'Central', 1, 29, 2, 1, 'Critical', NULL, '2', 'This is acknowledge', 'Meru_Kandiga <> Nchiru/Kaaga/Meru_Timber_sales SDC fiber links failure', '2018-12-07 15:15', 'INC000005970949', 'Daniel Mosabi', '2018-12-07 07:03:59', '2018-12-07 11:15:09'),
(38, 'SLT-6531', 2, '0', 1, 14, 2, 1, 'Critical', NULL, '2', 'Acknowledged.', '5km', '2018-12-07 17:26', 'INC000005971135', 'Daniel Mosabi', '2018-12-07 09:43:21', '2018-12-07 10:01:30'),
(41, 'SLT-8785', 1, 'Nairobi', 1, 14, 1, 1, 'Critical', NULL, '2', 'reported at mornign 5 am and created now fine ok now watch you also note down the reported time and created time', 'firstlink', '2018-12-11 05:00', 'M1212', 'Mustafa', '2018-12-11 09:05:44', '2018-12-11 09:10:34'),
(42, 'SLT-5714', 1, 'Nairobi', 1, 14, 2, 1, 'Critical', NULL, '3', 'Noted abcd', 'Onyonka OLT 01 Port 0/5/3 fiber failure-', '2018-12-13 07:49', 'INC000005999249', 'FTTH NOC', '2018-12-13 04:29:26', '2018-12-13 12:26:48'),
(43, 'SLT-6360', 4, 'Nairobi', 1, 14, 2, 1, 'Critical', NULL, '2', 'Acknowledged', 'Soliton Park <> Royal Via Outering Road Link down', '2018-12-13 08:38', '6360', 'Mathew Somek', '2018-12-13 05:09:43', '2018-12-13 12:33:01'),
(44, 'SLT-7183', 2, '0', 1, 24, 2, 1, 'Critical', NULL, '2', 'This is acknowledged', 'HD010410010_SLINK25', '2018-12-13 10:39', 'INC000006003206', 'Elvis', '2018-12-13 05:20:26', '2018-12-13 12:24:24'),
(45, 'SLT-7313', 3, 'Nairobi', 1, 20, 2, 1, 'Critical', NULL, '2', 'Acknowledged', 'CUEA <> Strathmore Fiber is Down', '2018-12-13 10:45', 'SLT-7313', 'Evans Ng\'ang\'a', '2018-12-13 05:27:44', '2018-12-14 08:52:38'),
(46, 'SLT-2898', 1, 'Nairobi', 1, 20, 1, 1, 'Critical', NULL, '2', 'Acknowledged.', '748 <> Ali Daud Link down', '2018-12-13 10:45', 'SLT-2898', NULL, '2018-12-13 05:28:53', '2018-12-13 09:40:21'),
(47, 'SLT-8435', 8, 'Nairobi', 1, 20, 2, 1, 'Critical', NULL, '2', 'Acknowledged', 'Link Down_KAM <> Loman Productions and Consultancy', '2018-12-13 12:03', '10065044', 'Suleiman Nassor', '2018-12-13 07:06:58', '2018-12-13 12:30:32'),
(48, 'SLT-8474', 2, 'Coast', 1, 18, 2, 1, 'Critical', NULL, '2', 'noted', 'Essar_Timbwani, Likoni_East, Likoni_majengo_Mapya ATNs offline', '2018-12-13 14:19', 'INC000006003452', NULL, '2018-12-13 09:15:59', '2018-12-14 08:43:26'),
(49, 'SLT-593', 9, 'Coast', 36, 18, 2, 1, 'Critical', NULL, '2', 'SLINK26:HD010410009,HD010410008 & HD010410011', 'SLINK26:HD010410009,HD010410008 & HD010410011', '2018-12-13 15:34', 'INC000006004371', 'eongombe', '2018-12-13 12:38:50', '2018-12-14 08:41:13'),
(50, 'SLT-2161', 7, 'Central', 36, 16, 2, 1, 'Critical', NULL, '2', 'NET1125618: Tala<>Makuyu, Tala<>Thika Industrial & Tala<>Kenya Canners SDH links are down', 'NET1125618: Tala<>Makuyu, Tala<>Thika Industrial & Tala<>Kenya Canners SDH links are down', '2018-12-13 15:56', 'NET1125618', 'Nelly Mumbi', '2018-12-13 12:41:14', '2018-12-13 13:05:10'),
(51, 'SLT-6713', 4, 'Nairobi', 36, 20, 2, 1, 'Critical', NULL, '2', 'Kenya RE<> Eldama Park', 'Kenya RE<> Eldama Park', '2018-12-13 13:40', 'SLT-6713', 'Abdi jama', '2018-12-13 13:13:05', '2018-12-14 13:26:53'),
(52, 'SLT-8457', 4, 'Nairobi', 1, 41, 1, 1, 'Critical', NULL, '2', 'Noted', 'FON LINK DOWN, BUCON FURNITURES-UNIAFRIC HOUSE', '2018-12-13 18:40', 'SLT-8457', 'Ann Waweru', '2018-12-13 13:14:11', '2018-12-17 02:53:10'),
(53, 'SLT-3145', 2, 'Central', 36, 28, 2, 1, 'Critical', NULL, '2', 'Kianjiru_Hilltop<>Embu_Retail_Shop SDC link Failure', 'Kianjiru_Hilltop<>Embu_Retail_Shop SDC link Failure', '2018-12-13 18:43', 'INC000006005645', 'Catherine Thiiri', '2018-12-13 13:17:08', '2018-12-13 15:25:00'),
(54, 'SLT-7940', 3, 'Coast', 31, 18, 2, 1, 'Critical', NULL, '4', 'Noted', 'nomad<>Galu SDC link failure', '2018-12-14 12:08', 'INC000006009409', 'Leonard Mwangi', '2018-12-14 08:57:41', '2018-12-14 09:46:11'),
(55, 'SLT-8328', 4, 'Central', 31, 16, 2, 1, 'Critical', NULL, '2', 'noted', 'Thika<>QOA FON fiber failure', '2018-12-14 12:15', 'INC000006009411', 'Thika<>QOA FON fiber failure', '2018-12-14 09:01:04', '2018-12-17 02:52:11'),
(56, 'SLT-7494', 1, 'Nairobi', 43, 14, 1, 1, 'Critical', NULL, '2', 'aa', 'first link and second link', '2018-12-08 07:35', 'aa', 'aa', '2018-12-14 09:03:06', '2018-12-14 09:05:44'),
(57, 'SLT-7443', 3, 'Central', 31, 16, 2, 1, 'Critical', NULL, '2', 'Noted', 'KU<>JKUAT FIBER SEGMENT DOWNTIME', '2018-12-14 13:30', '7433', 'Joy James Oyim', '2018-12-14 09:08:57', '2018-12-17 01:48:10'),
(59, 'SLT-3318', 7, 'Central', 36, 16, 1, 1, 'Critical', NULL, '2', 'NET1129467 Thika_Industrial <> Tala & Tala <> Kenya_canners links are down', 'NET1129467 Thika_Industrial <> Tala & Tala <> Kenya_canners links are down', '2018-12-14 16:44', 'NET1129467', 'Herbert Elima', '2018-12-14 11:22:03', '2018-12-16 16:29:42'),
(63, 'SLT-5058', 2, 'Coast', 36, 44, 2, 1, 'Critical', NULL, '2', 'Seacom CLS,Mombasa<>ICOLO 40Kms) Seacom Dark Fiber Link down', 'Seacom CLS,Mombasa<>ICOLO 40Kms) Seacom Dark Fiber Link down', '2018-12-14 18:20', 'INC000006011619', 'Catherine Thiiri,', '2018-12-14 13:10:52', '2018-12-17 02:48:15'),
(64, 'SLT-3526', 2, 'Coast', 37, 24, 1, 1, 'Critical', NULL, '2', 'Kindly attend to subject fiber fault affecting 2_2G,2_3G &2_4G sites( SGR_Mombasa_Port, Portreitz).', 'Migadini_west<>Portreitz<>Kwa_Jomvu (Portreitz ATN Offline)', '2018-12-15 00:00', 'INC000006012410', 'Perpetua Gatheru', '2018-12-14 18:58:30', '2018-12-17 01:33:43'),
(65, 'SLT-1202', 2, 'Coast', 37, 24, 1, 1, 'Critical', NULL, '2', 'Kindly attend to subject link fault; use INC#6012319', 'Miritini_Shops <> Changamwe_Exchange <> Kwa_Jomvu <> Magongo SDC fibre link failure', '2018-12-15 05:31', 'INC#6012319', 'James Kikolya,', '2018-12-15 01:51:59', '2018-12-15 06:37:45'),
(66, 'SLT-6581', 2, 'Coast', 37, 24, 2, 1, 'Critical', NULL, '2', 'Assigned to soliton', 'Celtel_AVA_Mombasa <> Kenya_Refinery_Residence SDC fibre link failure', '2018-12-01 06:29', 'INC000006010777', 'James Kikolya,', '2018-12-15 01:57:37', '2018-12-17 01:43:08'),
(67, 'SLT-6658', 9, 'Coast', 37, 24, 2, 1, 'Critical', NULL, '2', 'Assigned', 'Slink26(ngombeni<>migombani south ) section between ngombeni <>hd010410009<>hd010410007 offline', '2018-12-15 06:30', 'INC000006010779', 'James Kikolya,', '2018-12-15 01:59:14', '2018-12-17 02:50:05'),
(68, 'SLT-7429', 2, 'Central', 37, 29, 2, 1, 'Critical', NULL, '2', 'no RX@ Meru Timber.', 'Meru_Timber<>Kamburu_KPLC Fiber Link Failure', '2018-12-15 11:39', 'INC000006015733', 'Leonard Mwangi', '2018-12-15 06:28:53', '2018-12-17 01:40:52'),
(69, 'SLT-1187', 2, 'Coast', 36, 44, 2, 1, 'Critical', NULL, '2', 'Kibwezi <> Kinyambu & Kibwezi <> YU_kibwezi SDC Fiber Link Failure', 'Kibwezi <> Kinyambu & Kibwezi <> YU_kibwezi SDC Fiber Link Failure', '2018-12-15 15:47', 'INC000006016158', 'Leonard Mwangi', '2018-12-15 14:46:38', '2018-12-15 22:25:59'),
(70, 'SLT-1876', 2, 'Central', 36, 46, 2, 1, 'Critical', NULL, '2', 'Garissa_Getune_School < > Garissa_Bulla_Mzuri SDC Fiber LInk Down', 'Garissa_Getune_School < > Garissa_Bulla_Mzuri SDC Fiber LInk Down', '2018-12-15 17:47', 'INC000006016372', 'Catherine Thiiri', '2018-12-15 15:04:34', '2018-12-16 16:39:00'),
(71, 'SLT-6807', 2, 'Coast', 36, 18, 2, 1, 'Critical', NULL, '2', '13135_CO_Mkoyo-ATN DOWN', '13135_CO_Mkoyo-ATN DOWN', '2018-12-16 20:10', 'INC000006021747', 'Margaret Mwangi', '2018-12-16 16:24:22', '2018-12-16 19:20:33'),
(73, 'SLT-4117', 7, 'Central', 37, 16, 2, 1, 'Critical', NULL, '2', 'links down', 'Thika<>Industrial<>Tala and Tala<>Makuyu Down.  TALA<>KENYA_CANNERS', '2018-12-17 10:39', 'NET1134931', 'Kennedy Kamau', '2018-12-17 05:17:56', '2018-12-17 08:42:22'),
(74, 'SLT-5386', 1, 'Nairobi', 1, 1, 1, 1, 'Critical', NULL, '2', 'aaa', 'aaaa', '2018-11-07 06:30', 'bbbbb', 'aaa', '2018-12-17 05:29:50', '2018-12-17 07:53:33'),
(75, 'SLT-2110', 6, 'Nairobi', 31, 1, 2, 1, 'Critical', NULL, '2', 'tttt', '2XSTM 16 SAMEER<>GIGIRI DOWN #10336', '2018-11-30 11:15', 'INC0000023546', 'yyy', '2018-12-17 05:49:46', '2018-12-17 07:46:30'),
(76, 'SLT-846', 1, 'Coast', 37, 24, 2, 1, 'Critical', NULL, '2', 'check MBS_KPS_MOI_AIRPORT_DIVISION_HQ_RADIO_ROOM_S3300. Port 25 to Changamwe ATN is down.', 'OFFLINE ARs', '2018-12-17 12:26', 'INC000006024374', 'Festus', '2018-12-17 07:36:54', '2018-12-17 10:05:44'),
(77, 'SLT-6327', 3, 'Nairobi', 37, 20, 2, 1, 'Critical', NULL, '1', 'Fiber segment down', 'CUEA <>Tangaza', '2018-12-17 12:57', 'Not shared', 'Brian', '2018-12-17 07:39:48', '2018-12-17 07:39:48'),
(78, 'SLT-3024', 2, 'Central', 37, 21, 2, 1, 'Critical', NULL, '2', 'Meru_Timber<>Isiolo_Morire Fiber Link Degraded', 'Meru_Timber<>Isiolo_Morire Fiber Link Degraded', '2018-12-17 13:43', 'INC000006024296.', 'alfred', '2018-12-17 08:53:15', '2018-12-17 14:14:20'),
(79, 'SLT-509', 5, 'Nairobi', 37, 14, 2, 1, 'Critical', NULL, '2', 'DARK FIBER LINK VIA LANGATA ROAD IS DOWN', 'DARK FIBER LINK VIA LANGATA ROAD IS DOWN', '2018-12-17 14:13', 'Not available', 'Sammy Wanjala', '2018-12-17 08:55:09', '2018-12-17 15:25:09'),
(80, 'SLT-579', 4, 'Nairobi', 37, 14, 2, 1, 'Critical', NULL, '2', 'Interface ge-0/1/1(TO-EBRU-TV): Link down', 'Alidaud<>EBRU_TV', '2018-12-17 13:49', 'Not available', 'Monitor', '2018-12-17 09:03:55', '2018-12-17 14:42:35'),
(81, 'SLT-5206', 7, 'Central', 37, 16, 2, 1, 'Critical', NULL, '1', 'Current Rx Thika_Industrial -24.6dBm Threshold -26.0dBm\r\nCurrent Rx Tala -25.8dBm Threshold -26.0dBm', 'Thika<>Industrial<>Tala and Tala<>Makuyu Degradation', '2018-12-17 13:52', 'NET1134931', 'Kennedy Kamau', '2018-12-17 09:12:16', '2018-12-17 09:12:16'),
(82, 'SLT-7962', 3, 'Nairobi', 37, 14, 2, 1, 'Critical', NULL, '1', 'CUEA <> UoN Fiber Segment is Down', 'CUEA <> UoN Fiber Segment is Down', '2018-12-17 15:01', 'Not available', 'Jezreel Nyange', '2018-12-17 09:43:57', '2018-12-17 09:43:57'),
(83, 'SLT-1039', 3, 'Nairobi', 37, 20, 2, 1, 'Critical', NULL, '2', 'UoN<>USIU Fiber Segment Down', 'UoN<>USIU Fiber Segment Down', '2018-12-17 15:08', 'Not available', 'Jezreel Nyange', '2018-12-17 09:46:44', '2018-12-17 12:59:07'),
(84, 'SLT-174', 3, 'Nairobi', 37, 20, 2, 1, 'Critical', NULL, '2', 'USIU<>QOA Fiber Leg Down', 'USIU<>QOA Fiber Leg Down', '2018-12-17 15:22', 'Not available', 'Jezreel Nyange', '2018-12-17 09:58:03', '2018-12-17 12:55:26'),
(85, 'SLT-5013', 3, 'Nairobi', 37, 20, 2, 1, 'Critical', NULL, '2', 'KU<>USIU Fiber down.', 'KU<>USIU Fiber down.', '2018-12-17 15:27', 'Not available', 'Jezreel Nyange', '2018-12-17 09:59:57', '2018-12-17 12:54:39'),
(86, 'SLT-937', 8, 'Nairobi', 1, 14, 2, 1, 'Critical', NULL, '2', 'Link Down_KAM <> Loman Productions and Consultancy (Scoop Network) - CKT# SEA18/IPAC/10065044 & SEA18/IPETH/10034012', 'Link Down_KAM <> Loman Productions and Consultancy (Scoop Network) - CKT# SEA18/IPAC/10065044 & SEA18/IPETH/10034012', '2018-12-17 16:05', 'SEA18/IPAC/10065044', 'Suleiman Nassor', '2018-12-17 10:42:50', '2018-12-17 14:43:59'),
(87, 'SLT-7318', 2, 'Coast', 1, 22, 1, 1, 'Critical', NULL, '3', 'Assist check connection from VIPINGO RIDGE ATN to below clients connecting to Gi0/2/3-5', 'VIPINGO RIDGE ATN connection', '2018-12-17 19:57', 'INC000006024889', 'Chris Ayieko', '2018-12-17 15:43:37', '2018-12-17 15:46:48'),
(88, 'SLT-2386', 7, 'Central', 1, 16, 2, 1, 'Critical', NULL, '1', 'Also affected is Equity Kenol<>Proto Energy Muranga link.', 'SDH and DWDM: Thika<>Nyeri and InterXDM Muranga<>Thika Industrial Links Down, Equity Kenol<>Proto Energy Muranga link', '2018-12-18 01:20', 'NET1136868', 'Christopher Muga', '2018-12-17 20:05:03', '2018-12-17 20:09:16'),
(89, 'SLT-15701', 1, 'Nairobi', 1, 1, 1, 1, 'Critical', NULL, '1', 'fdsafsafsa', 'asdfsafsafdsaf', '2018-12-01 07:35', 'asdfsafas', 'asdfsaf', '2018-12-18 10:50:10', '2018-12-18 10:50:10'),
(90, 'SLT-18943', 1, 'Nairobi', 1, 1, 1, 1, 'Critical', NULL, '1', 'adfasfasf', 'aadsf', '2018-12-01 03:15', 'asdfas', 'asdfas', '2018-12-18 11:03:49', '2018-12-18 11:03:49'),
(91, 'SLT-16975', 1, 'Nairobi', 1, 1, 1, 1, 'Critical', NULL, '2', 'aa', 'abcd', '2018-12-01 03:15', 'aaa', 'aa', '2018-12-19 11:03:36', '2018-12-19 11:08:39'),
(92, 'SLT-60473', 1, 'Nairobi', 1, 14, 1, 1, 'Critical', NULL, '2', 'aa', 'aaaa', '2018-12-01 02:00', 'aa', 'aa', '2018-12-21 06:42:39', '2018-12-21 06:45:47'),
(93, 'SLT-84906', 1, 'Nairobi', 1, 14, 1, 1, 'Critical', NULL, '2', 'Nandan bhaiya', 'abcd', '2018-12-01 01:00', 'aaaaaa', 'aaa', '2018-12-21 08:12:27', '2018-12-21 08:15:25'),
(94, 'SLT-11223', 5, 'Nairobi', 1, 21, 2, 1, 'Critical', NULL, '2', 'Mahesh', 'Link 1', '2019-01-01 01:05', 'SLT1234567', 'Raju', '2019-01-18 09:59:40', '2019-01-18 10:05:50');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_post_replies`
--

CREATE TABLE `ticket_post_replies` (
  `id` int(10) UNSIGNED NOT NULL,
  `ticket_id` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `noc_operator` int(11) DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci,
  `attachment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ticket_post_replies`
--

INSERT INTO `ticket_post_replies` (`id`, `ticket_id`, `client_id`, `noc_operator`, `message`, `attachment`, `created_at`, `updated_at`) VALUES
(1, 'SLT-842', 1, 1, 'testing for post reply', NULL, '2018-11-23 00:56:46', '2018-11-23 00:56:46'),
(2, 'SLT-2849', 2, 1, 'Hey', NULL, '2018-11-23 05:19:14', '2018-11-23 05:19:14'),
(3, 'SLT-2849', 2, 1, 'Our FE has testes the link and fiber is found to be ok. We have requested access at EADC and our team is en route there ETA 1hr.', NULL, '2018-11-23 05:19:43', '2018-11-23 05:19:43'),
(4, 'SLT-6370', 2, 1, 'hello', NULL, '2018-11-23 06:22:45', '2018-11-23 06:22:45'),
(5, 'SLT-6370', 2, 1, 'hhh', NULL, '2018-11-23 07:19:43', '2018-11-23 07:19:43'),
(6, 'SLT-6370', 2, 1, 'my ass', NULL, '2018-11-23 07:21:24', '2018-11-23 07:21:24'),
(7, 'SLT-6986', 1, 1, 'hhey', NULL, '2018-11-24 05:59:38', '2018-11-24 05:59:38'),
(8, 'SLT-6986', 1, 1, 'Johny bhai', NULL, '2018-11-24 06:02:05', '2018-11-24 06:02:05'),
(9, 'SLT-8031', 1, 1, 'ETA Shared is 20 mins', NULL, '2018-11-29 07:10:13', '2018-11-29 07:10:13'),
(10, 'SLT-8031', 1, 1, 'OK', NULL, '2018-12-05 08:06:58', '2018-12-05 08:06:58'),
(11, 'SLT-1852', 2, 1, 'Our team still locating the point of fault', NULL, '2018-12-07 08:06:06', '2018-12-07 08:06:06'),
(12, 'SLT-1852', 2, 1, 'There is a break at 1.4km from a manhole outside Kandiga. Exact Point of fault located at Kaaga Secondary caused H.Young Road construction company', NULL, '2018-12-07 08:46:54', '2018-12-07 08:46:54'),
(13, 'SLT-6531', 2, 1, 'FE waiting for access', NULL, '2018-12-07 09:52:12', '2018-12-07 09:52:12'),
(14, 'SLT-2121', 4, 1, 'testing image code', 'qpcuiag6xx.png', '2018-12-08 06:10:21', '2018-12-08 06:10:21'),
(15, 'SLT-2121', 4, 1, 'testing 2 image code', 'fxwyq7myry.png', '2018-12-08 06:20:40', '2018-12-08 06:20:40'),
(16, 'SLT-2121', 4, 1, 'testing 3 image', 'ticketsystem.png', '2018-12-08 06:40:33', '2018-12-08 06:40:33'),
(17, 'SLT-2121', 4, 1, 'final image testing 4', '/tmp/phpbpdiov.png', '2018-12-08 06:44:09', '2018-12-08 06:44:09'),
(18, 'SLT-2121', 4, 1, 'dfgdfgdf', '6iszcsrdrvimage.png', '2018-12-08 06:53:57', '2018-12-08 06:53:57'),
(19, 'SLT-1231', 1, 1, 'Fault located at', '8xqljorix9image.jpg', '2018-12-10 14:18:38', '2018-12-10 14:18:38'),
(20, 'SLT-5714', 1, 1, 'safd', '', '2018-12-13 05:27:26', '2018-12-13 05:27:26'),
(21, 'SLT-2898', 1, 1, 'Fe checking on the link', '', '2018-12-13 05:31:47', '2018-12-13 05:31:47'),
(22, 'SLT-2898', 1, 1, 'point of fault located 3km from Strathmore', '', '2018-12-13 05:32:19', '2018-12-13 05:32:19'),
(23, 'SLT-2898', 1, 1, 'See attached image', 'fp3romdh38image.jpeg', '2018-12-13 05:33:36', '2018-12-13 05:33:36'),
(24, 'SLT-2898', 1, 1, 'aadfsaf', '', '2018-12-13 06:40:01', '2018-12-13 06:40:01'),
(25, 'SLT-2161', 7, 36, 'Overhead section has been vandalized at kisukioni  by unknown person. Restoration is underway.', '', '2018-12-13 12:41:47', '2018-12-13 12:41:47'),
(26, 'SLT-2161', 7, 36, 'Overhead section had been vandalized at kisukioni  by unknown person. Team introduced one joint closure kit hence uptime.', '', '2018-12-13 13:04:02', '2018-12-13 13:04:02'),
(27, 'SLT-8474', 2, 36, 'Timbwani <>Essar_Timbwani\r\nclosure had been damaged at likoni east intersection due to high downpour.Team replaced the closure.', '', '2018-12-13 13:51:01', '2018-12-13 13:51:01'),
(28, 'SLT-3145', 2, 36, 'Fault point  is at Majimbo area due to ongoing  Sewarage construction. The trench is very deep, about 15m. There\'s is also soil dumpings along the cable path. Restoration will take longer', 'hw3u1il8ifimage.jpeg', '2018-12-13 14:08:07', '2018-12-13 14:08:07'),
(29, 'SLT-6713', 4, 36, 'Test done on a live fiber at Langata Cemetry shows signal is ok(12.2km towards kenyare) and no signal from eldama park on both cores(19.2km towards Eldama park)', '', '2018-12-13 14:22:59', '2018-12-13 14:22:59'),
(30, 'SLT-8328', 4, 36, 'Cable vandalised at juja near weighbridge due to sewerline construction. Damage is extensive', 'yx9vmmnyutimage.jpeg', '2018-12-14 09:14:41', '2018-12-14 09:14:41'),
(31, 'SLT-7443', 3, 36, 'Cable vandalised at juja near weighbridge due to sewerline construction. Damage is extensive', 'ew6dk9dp10image.jpeg', '2018-12-14 09:17:04', '2018-12-14 09:17:04'),
(32, 'SLT-7443', 3, 36, 'piloting still ongoing. the area is very swampy.', '', '2018-12-14 13:35:39', '2018-12-14 13:35:39'),
(33, 'SLT-8328', 4, 36, 'piloting still ongoing. the area is very swampy.', '', '2018-12-14 13:36:09', '2018-12-14 13:36:09'),
(34, 'SLT-5058', 2, 36, 'Tests done in a manhole at bomu shows a disconnection on one core 12.6km towards seacom', 'xgn9hxtwb0image.jpeg', '2018-12-14 13:49:24', '2018-12-14 13:49:24'),
(35, 'SLT-1876', 2, 36, 'Team inserted an new site between Getune and Bulla and seems the loop is not working hence team has removed the loop.\r\n\r\n Team will recheck tomorrow and optimize the link.', '', '2018-12-15 16:22:00', '2018-12-15 16:22:00'),
(36, 'SLT-1187', 2, 36, 'Cable has been vandalized at 500m from kibwezi town bts near kcb by unknown. Restoration is being hindered by heavy rains', '', '2018-12-15 20:51:33', '2018-12-15 20:51:33'),
(37, 'SLT-1876', 2, 36, 'The degradation was as aresult sfp at Bulla mzuri. team replaced the patch chord', '', '2018-12-16 16:26:08', '2018-12-16 16:26:08'),
(38, 'SLT-6807', 2, 36, 'Test showed a fiber break at 2.1km from mkoyo, cable damaged at Diani navy camp.\r\nTeam waiting for permission to work on a manhole outside the camp.', '', '2018-12-16 17:17:42', '2018-12-16 17:17:42'),
(39, 'SLT-4117', 7, 37, 'Point of fault is at Kisukioni.  Cable cut by a blunt object by unknown person.\r\nETR is 30 minutes.', 'k49igfchtnimage.jpeg', '2018-12-17 07:52:58', '2018-12-17 07:52:58'),
(40, 'SLT-6327', 3, 37, 'Awaiting access', '', '2018-12-17 10:11:29', '2018-12-17 10:11:29'),
(41, 'SLT-7962', 3, 1, 'Teste done at Southern bypass langata road shows fiber break at 6.7441km towards Karen.', '', '2018-12-17 10:40:11', '2018-12-17 10:40:11'),
(42, 'SLT-579', 4, 1, 'Teste done at Southern bypass langata road shows fiber break at 6.7441km towards Karen.', '', '2018-12-17 10:43:33', '2018-12-17 10:43:33'),
(43, 'SLT-937', 8, 1, 'Teste done at Southern bypass langata road shows fiber break at 6.7441km towards Karen.', '', '2018-12-17 10:44:23', '2018-12-17 10:44:23'),
(44, 'SLT-509', 5, 1, 'Teste done at Southern bypass langata road shows fiber break at 6.7441km towards Karen.', '', '2018-12-17 10:44:52', '2018-12-17 10:44:52'),
(45, 'SLT-937', 8, 1, 'The point of fault located at water front langata road due to road construction.', 'ga9dysjhnwimage.jpg', '2018-12-17 10:50:15', '2018-12-17 10:50:15'),
(46, 'SLT-7962', 3, 1, 'The point of fault located at water front langata road due to road construction.', 'jndd2moqzqimage.jpg', '2018-12-17 10:51:04', '2018-12-17 10:51:04'),
(47, 'SLT-579', 4, 1, 'The point of fault located at water front langata road due to road construction.', '4e16tq5skbimage.jpg', '2018-12-17 10:51:32', '2018-12-17 10:51:32'),
(48, 'SLT-509', 5, 1, 'The point of fault located at water front langata road due to road construction.', 'hrgiqdzfnuimage.jpg', '2018-12-17 10:52:20', '2018-12-17 10:52:20'),
(49, 'SLT-3024', 2, 1, 'Cable has been Partially damaged in a manhole around Kinoru stadium.', 'gkhlhi33nlimage.jpg', '2018-12-17 10:56:32', '2018-12-17 10:56:32'),
(50, 'SLT-5013', 3, 1, 'The point of fault located at PAC University Cable vandalized by unknown person, opened closure and cut the fibers on a temporarily section.', '', '2018-12-17 11:51:46', '2018-12-17 11:51:46'),
(51, 'SLT-174', 3, 1, 'The point of fault located at PAC University Cable vandalized by unknown person, opened closure and cut the fibers on a temporarily section.', '', '2018-12-17 11:52:15', '2018-12-17 11:52:15'),
(52, 'SLT-1039', 3, 1, 'The point of fault located at PAC University Cable vandalized by unknown person, opened closure and cut the fibers on a temporarily section.', '', '2018-12-17 11:52:46', '2018-12-17 11:52:46'),
(53, 'SLT-937', 8, 1, 'Due to the extentt of the damage, Our team are currently replacing a 300m cable with thwe introduction of two closures.', '', '2018-12-17 12:05:41', '2018-12-17 12:05:41'),
(54, 'SLT-7962', 3, 1, 'Due to the extentt of the damage, Our team are currently replacing a 300m cable with thwe introduction of two closures.', '', '2018-12-17 12:06:00', '2018-12-17 12:06:00'),
(55, 'SLT-579', 4, 1, 'Due to the extentt of the damage, Our team are currently replacing a 300m cable with thwe introduction of two closures.', '', '2018-12-17 12:06:19', '2018-12-17 12:06:19'),
(56, 'SLT-509', 5, 1, 'Due to the extentt of the damage, Our team are currently replacing a 300m cable with thwe introduction of two closures.', '', '2018-12-17 12:06:36', '2018-12-17 12:06:36'),
(57, 'SLT-3024', 2, 1, 'The point of fault located in a m/hole around Kinoru stadium cable has been Partially damaged by unknown person. Our team were forced to cut the entire cable becuse of the extent of the damage and re-spliced all the cores hence all the services restored.', '', '2018-12-17 12:19:45', '2018-12-17 12:19:45'),
(58, 'SLT-3024', 2, 1, 'service restored at 17:27PM but degraded.\r\nPower Levels:\r\nRx @ Isiolo -39.2 ref -27.0, degraded\r\nRx @ Meru -24.7 ref -24.7\r\nAccess at both ends requested.', '', '2018-12-17 13:01:09', '2018-12-17 13:01:09'),
(59, 'SLT-3024', 2, 1, 'FE cleaned patch cprds at Isiolo_Morire for optimization.', '', '2018-12-17 14:12:09', '2018-12-17 14:12:09'),
(60, 'SLT-7962', 3, 1, 'The point of fault located at Water Front Langata road due to road construction.  Our team did replace a 300m cable introduced two closures and re spliced the cores.\r\nWAITING FOR CLIENT TO CONFIRM THE STATUS', '', '2018-12-17 14:45:32', '2018-12-17 14:45:32'),
(61, 'SLT-5206', 7, 1, 'The team is still optimizing the link. Currently a lose of 0.5dB has been cleared at 5.1Km from Thika Industrial.', '', '2018-12-17 14:54:06', '2018-12-17 14:54:06'),
(62, 'SLT-2386', 7, 1, 'Request access at Thika industrial.', '', '2018-12-17 20:05:41', '2018-12-17 20:05:41'),
(63, 'SLT-5206', 7, 1, 'A loss of 1.1dB has been located at a closure in a MH in Engen Petrol station 3.2km from Thika Industrial.   The MH is filed up with water and one side of the cable is short thus the closure cannot be accessed. Team will empty the MH tomorrow, replace the cable and clear the loss. In addition, team will eliminate some closures in Tala.', '', '2018-12-17 20:08:03', '2018-12-17 20:08:03'),
(64, 'SLT-2386', 7, 37, 'The point of fault has been located at Kenol where the cable was vandalised on a temporary section,ETR 1hr', '', '2018-12-17 21:30:10', '2018-12-17 21:30:10'),
(65, 'SLT-2386', 7, 37, 'All links have restored except Thika<> Nyeri DWDM, Further tests from Thika shows that there is no receive from Nyeri. We shall have one team to check from Nyeri. Request  acess at Nyeri North', '', '2018-12-18 00:55:30', '2018-12-18 00:55:30'),
(66, 'SLT-15701', 1, 1, 'Hello everybody', '', '2018-12-21 08:09:28', '2018-12-21 08:09:28'),
(67, 'SLT-15701', 1, 1, 'Again Hello', '', '2018-12-21 08:09:41', '2018-12-21 08:09:41'),
(68, 'SLT-84906', 1, 1, 'Hello everybody', '', '2018-12-14 03:14:14', '2018-12-21 08:14:14'),
(69, 'SLT-84906', 1, 1, 'Hello everybody', '', '2018-12-21 08:14:14', '2018-12-21 08:14:14'),
(70, 'SLT-84906', 1, 1, 'Again hello every body', '', '2018-12-21 08:15:06', '2018-12-21 08:15:06');

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

--
-- Dumping data for table `ticket_processings`
--

INSERT INTO `ticket_processings` (`id`, `ticket_id`, `client_id`, `service_affected`, `link_affected`, `region`, `priority`, `naturOfFault`, `opening_time`, `closing_time`, `acc_request_time`, `acc_granted_time`, `escort_request_time`, `escort_granted_time`, `sla_resolution_time`, `contactno`, `update_comments`, `status`, `created_at`, `updated_at`) VALUES
(3, 15, 1, 1, '1', 'fsdaf', '1', '1', '2018-11-17 05:28:04', '2018-11-17 20:20:00', '2018-11-16 22:00:00', '2018-11-18 19:00:00', NULL, NULL, NULL, NULL, 'dfas', '1', NULL, NULL);

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
(1, 'Open', '2018-10-25 22:42:36', '2018-10-25 22:42:36', NULL),
(2, 'Closed', '2018-10-25 22:42:36', '2018-10-25 22:42:36', NULL),
(3, 'Pending', '2018-10-25 22:42:36', '2018-10-25 22:42:36', NULL),
(4, 'Cancelled', '2018-10-25 22:42:36', '2018-10-25 22:42:36', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ticket_updates`
--

CREATE TABLE `ticket_updates` (
  `id` int(10) UNSIGNED NOT NULL,
  `update_id` int(11) DEFAULT NULL,
  `ticket_id` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `employee_id` int(11) NOT NULL,
  `noc_operator` int(11) DEFAULT NULL,
  `opening_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `closing_time` timestamp NULL DEFAULT NULL,
  `status` enum('1','2','3','4') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '1=Open, 2=Closed, 3=Pending ,4=Cancelled ',
  `priority` varchar(110) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link_affected` longtext COLLATE utf8mb4_unicode_ci,
  `new_employee_id` int(11) DEFAULT NULL,
  `new_opening_time` timestamp NULL DEFAULT NULL,
  `new_closing_time` timestamp NULL DEFAULT NULL,
  `acc_request_time` timestamp NULL DEFAULT NULL,
  `acc_granted_time` timestamp NULL DEFAULT NULL,
  `site_address` text COLLATE utf8mb4_unicode_ci,
  `escort_request_time` timestamp NULL DEFAULT NULL,
  `escort_granted_time` timestamp NULL DEFAULT NULL,
  `comments` longtext COLLATE utf8mb4_unicode_ci,
  `new_status` enum('1','2','3','4') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '2' COMMENT '1=Open, 2=Closed, 3=Pending ,4=Cancelled ',
  `nonassignedengg` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT 'NO',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ticket_updates`
--

INSERT INTO `ticket_updates` (`id`, `update_id`, `ticket_id`, `client_id`, `employee_id`, `noc_operator`, `opening_time`, `closing_time`, `status`, `priority`, `link_affected`, `new_employee_id`, `new_opening_time`, `new_closing_time`, `acc_request_time`, `acc_granted_time`, `site_address`, `escort_request_time`, `escort_granted_time`, `comments`, `new_status`, `nonassignedengg`, `created_at`, `updated_at`) VALUES
(108, NULL, 'SLT-1852', 2, 29, 1, '2018-12-12 11:50:36', '2018-12-07 13:07:00', '2', NULL, 'Meru_Kandiga <> Nchiru/Kaaga/Meru_Timber_sales SDC fiber links failure', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', 'NO', '2018-12-07 07:03:59', '2018-12-07 11:15:09'),
(109, NULL, 'SLT-6531', 2, 14, 1, '2018-12-12 11:50:56', '2018-12-07 13:05:00', '2', NULL, '5km from kikambala towards vipingo', NULL, NULL, NULL, '2018-12-07 05:25:00', '2018-12-07 12:55:00', 'Eadc', '2018-12-07 12:55:00', '2018-12-07 13:00:00', 'Escort Requested', '2', 'NO', '2018-12-07 09:43:21', '2018-12-07 10:01:30'),
(112, NULL, 'SLT-8785', 1, 14, 1, '2018-12-12 12:24:30', '2018-12-12 09:00:00', '2', NULL, 'firstlink', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', 'NO', '2018-12-11 09:05:44', '2018-12-11 09:10:34'),
(113, NULL, 'SLT-5714', 1, 14, 1, '2018-12-13 14:56:48', '2018-12-13 00:26:48', '3', NULL, 'Onyonka OLT 01 Port 0/5/3 fiber failure-', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', 'NO', '2018-12-13 04:29:26', '2018-12-13 12:26:48'),
(114, NULL, 'SLT-6360', 4, 14, 1, '2018-12-13 15:03:01', '2018-12-13 08:55:00', '2', NULL, 'Soliton Park <> Royal Via Outering Road Link down', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', 'NO', '2018-12-13 05:09:43', '2018-12-13 12:33:01'),
(115, NULL, 'SLT-7183', 2, 24, 1, '2018-12-13 14:54:24', '2018-12-13 11:18:00', '2', NULL, 'HD010410010_SLINK25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', 'NO', '2018-12-13 05:20:26', '2018-12-13 12:24:24'),
(116, NULL, 'SLT-7313', 3, 20, 1, '2018-12-14 11:22:38', '2018-12-14 08:10:00', '2', NULL, 'CUEA <> Strathmore Fiber is Down', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', 'NO', '2018-12-13 05:27:44', '2018-12-14 08:52:38'),
(117, NULL, 'SLT-2898', 1, 20, 1, '2018-12-13 12:10:21', '2018-11-21 09:55:00', '2', NULL, '748 <> Ali Daud Link down', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', 'NO', '2018-12-13 05:28:53', '2018-12-13 09:40:21'),
(118, NULL, 'SLT-8435', 8, 20, 1, '2018-12-13 15:00:32', '2018-12-13 11:01:00', '2', NULL, 'Link Down_KAM <> Loman Productions and Consultancy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', 'NO', '2018-12-13 07:06:58', '2018-12-13 12:30:32'),
(119, NULL, 'SLT-8474', 2, 18, 1, '2018-12-14 11:13:26', '2018-12-13 13:24:00', '2', NULL, 'Essar_Timbwani, Likoni_East, Likoni_majengo_Mapya ATNs offline', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', 'NO', '2018-12-13 09:15:59', '2018-12-14 08:43:26'),
(120, NULL, 'SLT-593', 9, 18, 36, '2018-12-14 11:11:13', '2018-12-13 15:40:00', '2', NULL, 'SLINK26:HD010410009,HD010410008 & HD010410011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', 'NO', '2018-12-13 12:38:50', '2018-12-14 08:41:13'),
(121, NULL, 'SLT-2161', 7, 16, 36, '2018-12-13 15:35:10', '2018-12-13 13:05:00', '2', NULL, 'NET1125618: Tala<>Makuyu, Tala<>Thika Industrial & Tala<>Kenya Canners SDH links are down', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', 'NO', '2018-12-13 12:41:14', '2018-12-13 13:05:10'),
(122, NULL, 'SLT-6713', 4, 20, 36, '2018-12-14 15:56:53', '2018-12-14 12:09:00', '2', NULL, 'Kenya RE<> Eldama Park', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', 'NO', '2018-12-13 13:13:05', '2018-12-14 13:26:53'),
(123, NULL, 'SLT-8457', 4, 41, 1, '2018-12-17 05:23:10', '2018-12-13 06:50:00', '2', NULL, 'FON LINK DOWN, BUCON FURNITURES-UNIAFRIC HOUSE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', 'NO', '2018-12-13 13:14:11', '2018-12-17 02:53:10'),
(124, NULL, 'SLT-3145', 2, 28, 36, '2018-12-13 17:55:00', '2018-12-13 15:04:00', '2', NULL, 'Kianjiru_Hilltop<>Embu_Retail_Shop SDC link Failure', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', 'NO', '2018-12-13 13:17:08', '2018-12-13 15:25:00'),
(125, NULL, 'SLT-7940', 3, 18, 31, '2018-12-14 12:16:11', '2018-12-14 11:01:00', '4', NULL, 'nomad<>Galu SDC link failure', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', 'NO', '2018-12-14 08:57:41', '2018-12-14 09:46:11'),
(126, NULL, 'SLT-8328', 4, 16, 31, '2018-12-17 05:22:11', '2018-12-14 06:44:00', '2', NULL, 'Thika<>QOA FON fiber failure', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', 'NO', '2018-12-14 09:01:04', '2018-12-17 02:52:11'),
(127, NULL, 'SLT-7494', 1, 14, 43, '2018-12-14 11:35:44', '2018-12-18 02:00:00', '2', NULL, 'first link and second link', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', 'NO', '2018-12-14 09:03:06', '2018-12-14 09:05:44'),
(128, NULL, 'SLT-7443', 3, 16, 31, '2018-12-17 04:18:10', '2018-12-14 02:01:00', '2', NULL, 'KU<>JKUAT FIBER SEGMENT DOWNTIME', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', 'NO', '2018-12-14 09:08:57', '2018-12-17 01:48:10'),
(129, NULL, 'SLT-3318', 7, 16, 36, '2018-12-16 18:59:42', '2018-12-14 12:17:54', '2', NULL, 'NET1129467 Thika_Industrial <> Tala & Tala <> Kenya_canners links are down', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', 'NO', '2018-12-14 11:22:03', '2018-12-16 16:29:42'),
(132, NULL, 'SLT-3318', 7, 28, 36, '2018-12-16 18:59:42', '2018-12-14 18:00:00', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Kibet handling another fault at juja', '2', 'NO', '2018-12-14 12:17:54', '2018-12-16 16:29:42'),
(134, NULL, 'SLT-5058', 2, 44, 36, '2018-12-17 05:18:15', '2018-12-14 07:45:00', '2', NULL, 'Seacom CLS,Mombasa<>ICOLO 40Kms) Seacom Dark Fiber Link down', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', 'NO', '2018-12-14 13:10:52', '2018-12-17 02:48:15'),
(135, NULL, 'SLT-3526', 2, 24, 37, '2018-12-17 04:03:43', '2018-12-14 21:40:00', '2', NULL, 'Migadini_west<>Portreitz<>Kwa_Jomvu (Portreitz ATN Offline)', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', 'NO', '2018-12-14 18:58:30', '2018-12-17 01:33:43'),
(136, NULL, 'SLT-1202', 2, 24, 37, '2018-12-15 09:07:45', '2018-12-14 02:05:00', '2', NULL, 'Miritini_Shops <> Changamwe_Exchange <> Kwa_Jomvu <> Magongo SDC fibre link failure', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', 'NO', '2018-12-15 01:51:59', '2018-12-15 06:37:45'),
(137, NULL, 'SLT-6581', 2, 24, 37, '2018-12-17 04:13:08', '2018-12-15 01:50:00', '2', NULL, 'Celtel_AVA_Mombasa <> Kenya_Refinery_Residence SDC fibre link failure', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', 'NO', '2018-12-15 01:57:37', '2018-12-17 01:43:08'),
(138, NULL, 'SLT-6658', 9, 24, 37, '2018-12-17 05:20:05', '2018-12-15 02:59:00', '2', NULL, 'Slink26(ngombeni<>migombani south ) section between ngombeni <>hd010410009<>hd010410007 offline', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', 'NO', '2018-12-15 01:59:14', '2018-12-17 02:50:05'),
(139, NULL, 'SLT-7429', 2, 29, 37, '2018-12-17 04:10:52', '2018-12-15 07:27:00', '2', NULL, 'Meru_Timber<>Kamburu_KPLC Fiber Link Failure', NULL, NULL, NULL, '2018-12-15 06:14:00', '2018-12-15 06:23:00', 'Meru Timber', NULL, NULL, 'access at Meru timber granted', '2', 'NO', '2018-12-15 06:28:53', '2018-12-17 01:40:52'),
(140, NULL, 'SLT-1187', 2, 44, 36, '2018-12-16 00:55:59', '2018-12-15 22:14:00', '2', NULL, 'Kibwezi <> Kinyambu & Kibwezi <> YU_kibwezi SDC Fiber Link Failure', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', 'NO', '2018-12-15 14:46:38', '2018-12-15 22:25:59'),
(141, NULL, 'SLT-1876', 2, 46, 36, '2018-12-16 19:09:00', '2018-12-15 15:50:00', '2', NULL, 'Garissa_Getune_School < > Garissa_Bulla_Mzuri SDC Fiber LInk Down', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', 'NO', '2018-12-15 15:04:34', '2018-12-16 16:39:00'),
(142, NULL, 'SLT-6807', 2, 18, 36, '2018-12-16 21:50:33', '2018-12-16 18:40:00', '2', NULL, '13135_CO_Mkoyo-ATN DOWN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', 'NO', '2018-12-16 16:24:22', '2018-12-16 19:20:33'),
(144, NULL, 'SLT-4117', 7, 16, 37, '2018-12-17 11:12:23', '2018-12-17 08:09:00', '2', NULL, 'Thika<>Industrial<>Tala and Tala<>Makuyu Down.  TALA<>KENYA_CANNERS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', 'NO', '2018-12-17 05:17:56', '2018-12-17 08:42:23'),
(145, NULL, 'SLT-5386', 1, 1, 1, '2018-12-17 10:23:33', '2018-12-14 02:05:00', '2', NULL, 'aaaa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', 'NO', '2018-12-17 05:29:50', '2018-12-17 07:53:33'),
(146, NULL, 'SLT-2110', 6, 1, 31, '2018-12-17 10:16:30', '2018-12-13 13:24:00', '2', NULL, '2XSTM 16 SAMEER<>GIGIRI DOWN #10336', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', 'NO', '2018-12-17 05:49:46', '2018-12-17 07:46:30'),
(147, NULL, 'SLT-846', 1, 24, 37, '2018-12-17 12:35:44', '2018-12-17 09:20:00', '2', NULL, 'OFFLINE ARs', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', 'NO', '2018-12-17 07:36:54', '2018-12-17 10:05:44'),
(148, NULL, 'SLT-6327', 3, 20, 37, '2018-12-17 12:41:06', NULL, '1', NULL, 'CUEA <>Tangaza', NULL, NULL, NULL, '2018-12-17 07:27:00', NULL, 'CUEA', NULL, NULL, 'access at CUEA', '2', 'NO', '2018-12-17 07:39:48', '2018-12-17 10:11:06'),
(149, NULL, 'SLT-3024', 2, 21, 37, '2018-12-17 16:44:20', '2018-12-17 10:14:36', '2', NULL, 'Meru_Timber<>Isiolo_Morire Fiber Link Degraded', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', 'NO', '2018-12-17 08:53:15', '2018-12-17 14:14:20'),
(150, NULL, 'SLT-509', 5, 14, 37, '2018-12-17 17:55:09', '2018-12-17 14:02:00', '2', NULL, 'DARK FIBER LINK VIA LANGATA ROAD IS DOWN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', 'NO', '2018-12-17 08:55:09', '2018-12-17 15:25:09'),
(151, NULL, 'SLT-579', 4, 14, 37, '2018-12-17 17:12:35', '2018-12-17 14:12:00', '2', NULL, 'Alidaud<>EBRU_TV', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', 'NO', '2018-12-17 09:03:55', '2018-12-17 14:42:35'),
(152, NULL, 'SLT-5206', 7, 16, 37, '2018-12-17 11:42:16', NULL, '1', NULL, 'Thika<>Industrial<>Tala and Tala<>Makuyu Degradation', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', 'NO', '2018-12-17 09:12:16', '2018-12-17 09:12:16'),
(153, NULL, 'SLT-7962', 3, 14, 37, '2018-12-17 12:13:57', NULL, '1', NULL, 'CUEA <> UoN Fiber Segment is Down', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', 'NO', '2018-12-17 09:43:57', '2018-12-17 09:43:57'),
(154, NULL, 'SLT-1039', 3, 20, 37, '2018-12-17 15:29:07', '2018-12-17 12:35:00', '2', NULL, 'UoN<>USIU Fiber Segment Down', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', 'NO', '2018-12-17 09:46:44', '2018-12-17 12:59:07'),
(155, NULL, 'SLT-174', 3, 20, 37, '2018-12-17 15:25:26', '2018-12-17 12:35:00', '2', NULL, 'USIU<>QOA Fiber Leg Down', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', 'NO', '2018-12-17 09:58:03', '2018-12-17 12:55:26'),
(156, NULL, 'SLT-5013', 3, 20, 37, '2018-12-17 15:24:39', '2018-12-17 12:35:00', '2', NULL, 'KU<>USIU Fiber down.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', 'NO', '2018-12-17 09:59:57', '2018-12-17 12:54:39'),
(157, NULL, 'SLT-3024', 2, 29, 1, '2018-12-17 16:44:20', '2018-12-17 11:57:00', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Meru_Timber<>Isiolo_Morire Fiber Link Degraded', '2', 'NO', '2018-12-17 10:14:36', '2018-12-17 14:14:20'),
(158, NULL, 'SLT-937', 8, 14, 1, '2018-12-17 17:13:59', '2018-12-17 14:01:00', '2', NULL, 'Link Down_KAM <> Loman Productions and Consultancy (Scoop Network) - CKT# SEA18/IPAC/10065044 & SEA18/IPETH/10034012', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', 'NO', '2018-12-17 10:42:50', '2018-12-17 14:43:59'),
(159, NULL, 'SLT-7318', 2, 22, 1, '2018-12-17 18:16:48', '2018-12-17 03:46:48', '3', NULL, 'VIPINGO RIDGE ATN connection', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', 'NO', '2018-12-17 15:43:37', '2018-12-17 15:46:48'),
(160, NULL, 'SLT-2386', 7, 16, 1, '2018-12-17 22:39:16', NULL, '1', NULL, 'SDH and DWDM: Thika<>Nyeri and InterXDM Muranga<>Thika Industrial Links Down, Equity Kenol<>Proto Energy Muranga link', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', 'NO', '2018-12-17 20:05:03', '2018-12-17 20:09:16'),
(161, NULL, 'SLT-15701', 1, 1, 1, '2018-12-18 16:20:10', NULL, '1', NULL, 'asdfsafsafdsaf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', 'NO', '2018-12-18 10:50:10', '2018-12-18 10:50:10'),
(162, NULL, 'SLT-18943', 1, 1, 1, '2018-12-18 16:33:49', NULL, '1', NULL, 'aadsf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', 'NO', '2018-12-18 11:03:49', '2018-12-18 11:03:49'),
(163, NULL, 'SLT-16975', 1, 1, 1, '2018-12-19 16:33:36', NULL, '2', NULL, 'abcd', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', 'NO', '2018-12-19 11:03:37', '2018-12-19 11:08:39'),
(164, NULL, 'SLT-16975', 1, 14, 1, '2018-12-19 16:37:58', '2018-12-19 18:00:00', '2', NULL, NULL, NULL, NULL, NULL, '2018-12-19 12:00:00', '2018-12-19 12:10:00', 'aaa', NULL, NULL, 'adfasf', '2', 'YESACCESS', '2018-12-19 11:07:58', '2018-12-19 11:08:39'),
(165, NULL, 'SLT-2386', 7, 14, 1, '2018-12-21 12:03:32', NULL, '1', NULL, 'SDH and DWDM: Thika<>Nyeri and InterXDM Muranga<>Thika Industrial Links Down, Equity Kenol<>Proto Energy Muranga link', NULL, NULL, NULL, NULL, NULL, NULL, '2018-12-21 06:00:00', NULL, 'dasf', '2', 'YESSECURITY', '2018-12-21 04:03:32', '2018-12-21 04:03:32'),
(166, NULL, 'SLT-60473', 1, 14, 1, '2018-12-21 12:12:39', '2018-12-21 20:30:00', '2', NULL, 'aaaa', NULL, NULL, NULL, '2018-12-21 08:30:00', '2018-12-21 09:30:00', 'aaaaaaaaa', NULL, NULL, 'aaa', '2', 'NO', '2018-12-21 06:42:40', '2018-12-21 06:45:47'),
(167, NULL, 'SLT-84906', 1, 14, 1, '2018-12-21 13:42:27', '2018-12-22 10:00:00', '2', NULL, 'abcd', NULL, NULL, NULL, NULL, NULL, 'aaaaaaaaaaaaa', '2018-12-18 03:40:00', '2018-12-18 04:40:00', 'aaaa', '2', 'NO', '2018-12-21 08:12:27', '2018-12-21 08:15:25'),
(168, NULL, 'SLT-11223', 5, 21, 1, '2019-01-18 15:29:40', '2019-01-18 10:00:21', '2', NULL, 'Link 1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', 'NO', '2019-01-18 09:59:40', '2019-01-18 10:05:50'),
(169, NULL, 'SLT-11223', 5, 28, 1, '2019-01-18 15:30:21', NULL, '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'another field Engg', '2', 'NO', '2019-01-18 10:00:21', '2019-01-18 10:05:50'),
(170, NULL, 'SLT-11223', 5, 14, 1, '2019-01-18 18:02:27', NULL, '2', NULL, NULL, NULL, NULL, NULL, '2019-01-18 05:30:00', '2019-01-18 08:30:00', 'Kenya', NULL, NULL, 'abcdefg', '2', 'YESACCESS', '2019-01-18 10:02:27', '2019-01-18 10:05:50'),
(171, NULL, 'SLT-11223', 5, 44, 1, '2019-01-18 18:03:00', NULL, '2', NULL, NULL, NULL, NULL, NULL, '2019-01-17 12:30:00', '2019-01-18 09:30:00', 'a', NULL, NULL, 'abcd', '2', 'YESACCESS', '2019-01-18 10:03:00', '2019-01-18 10:05:50'),
(172, NULL, 'SLT-11223', 5, 50, 1, '2019-01-18 18:04:47', '2019-01-18 17:30:00', '2', NULL, 'Link 1', NULL, NULL, NULL, NULL, NULL, NULL, '2019-01-18 01:30:00', '2019-01-18 08:30:00', 'aa', '2', 'YESSECURITY', '2019-01-18 10:04:47', '2019-01-18 10:05:50');

-- --------------------------------------------------------

--
-- Table structure for table `todolists`
--

CREATE TABLE `todolists` (
  `id` int(11) NOT NULL,
  `noc_id` int(11) NOT NULL,
  `task_dtl` text COLLATE utf8_unicode_ci NOT NULL,
  `scheduled_date` datetime NOT NULL,
  `status` int(2) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
(1, 0, 'Johny', 'admin', 'admin@admin.com', '$2y$10$sbsrCQTI3Gwrseqhytu/8.ILcgUEJ5YvRn/lzTZPbIUz9M/HWReeG', 'sztvfz4lrn.jpg', NULL, NULL, 'XYZ Place', 'CityName', '123456', '9876543210', '0', 'Zj82XgM4a9t6F3zmyif01SSFoxR4cubM40f7w39in0vscEX1NPOj6pCTqu5t', '2018-10-25 22:42:35', '2018-10-25 22:45:11', NULL),
(14, 3, 'Omar', 'Mwahari', 'omari@soliton.co.ke', '$2y$10$rbNNBgzGa3zqU0CA.Arp6u8Dn6v8s96uwqjXG7APRwEbsub8YTR0e', NULL, '5cYQYC6JAX1SASimfgPG4ix4jmXC4LfEcwqV30E5qHTIeZvRUuIDASp4VPsF', 'admin', 'soliton', 'Nairobi', '00200', '254725954203', '0', 'sOyHeCz0l2AuUzZrNzux7SwHTDTSLjpPmX3hfXuFAVZ7GJCpFZp4ijL781gx', '2018-11-21 06:05:08', '2018-12-13 12:38:37', NULL),
(15, 1, 'Mathew', 'Somek', 'somek@soliton.co.ke', '$2y$10$fZ76GUXp3FKmRaCFXi6Abe5mcceTjn/Ow9l/LAwmwPyJjvPR8uZaC', NULL, '7bfxAujKPBNngNzV9VK5aiV5aNXDF62ic0vzUDrE6sFbnIjUBmwSuFoz57hv', 'admin', 'P.O Box 15913 - 00100 Nairobi, Kenya, P.O Box 15913 - 00100 Nairobi, Kenya', 'Nairobi', '00200', '0721489544', '0', NULL, '2018-11-22 07:54:34', '2018-11-22 07:54:34', NULL),
(16, 3, 'Keneth', 'Kibet', 'test2@soliton.co.ke', '$2y$10$sbsrCQTI3Gwrseqhytu/8.ILcgUEJ5YvRn/lzTZPbIUz9M/HWReeG', NULL, NULL, 'admin', '13519', 'Nairobi', '00100', '254720386738', '0', NULL, NULL, '2018-12-13 12:42:16', NULL),
(18, 3, 'Kenneth', 'Kariuki', 'a@gmail.com', '$2y$10$sbsrCQTI3Gwrseqhytu/8.ILcgUEJ5YvRn/lzTZPbIUz9M/HWReeG', NULL, NULL, 'admin', '000', '000', '0100', '254727039895', '0', NULL, NULL, '2018-12-13 12:43:31', NULL),
(19, 3, 'Omar', 'Mwahari', 'b@gmail.com', '$2y$10$sbsrCQTI3Gwrseqhytu/8.ILcgUEJ5YvRn/lzTZPbIUz9M/HWReeG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, '2018-12-06 06:17:19', '2018-12-06 06:17:19'),
(20, 3, 'Mohamed', 'Osman', 'c@gmail.com', '$2y$10$sbsrCQTI3Gwrseqhytu/8.ILcgUEJ5YvRn/lzTZPbIUz9M/HWReeG', NULL, NULL, 'admin', '13519', 'Nairobi', '00100', '254724450857', '0', NULL, NULL, '2018-12-13 12:37:39', NULL),
(21, 3, 'Abdirahman', 'Farah', 'd@gmail.com', '$2y$10$sbsrCQTI3Gwrseqhytu/8.ILcgUEJ5YvRn/lzTZPbIUz9M/HWReeG', NULL, NULL, 'admin', '15913', 'Nairobi', '00100', '254703905603', '0', NULL, NULL, '2018-12-13 12:46:11', NULL),
(22, 3, 'Arthur', 'Odhiambo', 'arthur.odhiambo@soliton.co.ke', '$2y$10$T88qjhAXsbGhRNBUl.grt.Fx8n9wZ/3KU3zUVHRusl5OvRiRYX87S', NULL, 'crIHMLMWcNJFtWTHLaQeulF3T2L1WRp6SpjzdbOPXLfoGqFlKrVrYh6upMjd', 'admin', '13915', 'Nairobi', '00100', '254722851872', '0', NULL, '2018-12-06 06:26:57', '2018-12-13 12:45:12', NULL),
(24, 3, 'Francis', 'Mwendwa', 'test@gmail.com', '$2y$10$BkCrXd/I9kQkI3sKVJBFZ.TIzrvSCWqarr2ks5.cZCW29s3PmVXBm', NULL, 'FMwCp0ZVPLZfNn2Pm3n8lPDmbbIarXBzl1LbOUAzXMXBgzAPF1yIIBxLNRlR', 'admin', '15913', 'Nairobi', '00100', '254726419285', '0', NULL, '2018-12-06 06:33:59', '2018-12-13 12:44:30', NULL),
(28, 3, 'Rocho', 'Kennedy', 'kennedy@soliton.co.ke', '$2y$10$FiaIk2lHSmm0266sR00d9O.QlEz3JF6JVIqj8LXxL6PJ2.x98LFCu', NULL, 'LS0n90FAXwRl1HGHdBYeIYS60SkLNmTd0rzpkbKU1K80yMhoFEZGsgG8JVKN', 'admin', 'P.O Box 15913 - 00100 Nairobi, Kenya, P.O Box 15913 - 00100 Nairobi, Kenya', 'Nairobi', '00100', '254711859638', '0', NULL, '2018-12-07 05:48:02', '2018-12-13 12:40:38', NULL),
(29, 3, 'Ramadhan', 'Baraza', 'baraza@soliton.co.ke', '$2y$10$bofQxIofKSU5y2JCTnJXMe4AAxBeSaNX6FKSzwPou2wDAEhiWE8WS', NULL, 'CdjsOxR2EjVpDuWdaDs18QhZS188nhWwl1ZlwV4sumULhp0UJULnVOLdPvjQ', 'admin', 'P.O Box 15913 - 00100 Nairobi, Kenya, P.O Box 15913 - 00100 Nairobi, Kenya', 'Nairobi', '0100', '254713501943', '0', NULL, '2018-12-07 06:53:49', '2018-12-07 07:02:38', NULL),
(30, 3, 'Samuel', 'Muli', 'muli@soliton.co.ke', '$2y$10$bSwuFUvQqawRevbY7ZzQuO/ZvqICau.kdsu98Dh9/Y0qkAblCOd0.', NULL, 'NYOMdqRaCfkYgVMDHVwB17HYa4yjMuGDu4WgfYWYlKhf9XgyIprcBlKQXzH8', 'admin', 'P.O Box 15913 - 00100 Nairobi, Kenya, P.O Box 15913 - 00100 Nairobi, Kenya', 'Nairobi', '0100', '254711165515', '0', NULL, '2018-12-07 11:28:18', '2018-12-07 11:28:18', NULL),
(31, 1, 'Mathew', 'Somek', 'mmeksmatt@gmail.com', '$2y$10$ifkINbGkj0.i8IfWACKgreDyvbFSUB9e3pysu0ZvQFCa4Awl9744q', NULL, 'I8D8gcRfxvrrmpAWpDw1Gq2Ttw5T0003xHhBq3MLHmWDnaLdXFcJ28cPi0M3', 'NOC Engineer', 'P.O Box 15913 - 00100 Nairobi, Kenya, P.O Box 15913 - 00100 Nairobi, Kenya', 'Nairobi', '00200', '0721489544', '0', '7FKLH3IPrXYl8i9gsoIMS5SyroHG1aTCapVdSwhVm06BsCHkF2uB6Hh8LWxS', '2018-12-12 05:41:57', '2018-12-12 05:41:57', NULL),
(32, 1, 'Joseph', 'Wainaina', 'joseph.wainaina@soliton.co.ke', '$2y$10$9dmxDpKsg.K6/.fw72TCou4aPllJVzuJeo4fLzI.IMFDJq8Ptd7L.', NULL, 'xpXMZOSed1hDA1uImlKEJ5RoNSJXphxKJ0f1QkjyTUe8qDcWwvZWLqBtHuIW', 'admin', 'P.O Box 15913 - 00100 Nairobi, Kenya, P.O Box 15913 - 00100 Nairobi, Kenya', 'Nairobi', '0100', '254704886997', '0', 'jLuquTS9o50Ppx69GqgjJF1YK2O0UDmggGBddYEwfJ7Bprtyy9NISken8fCd', '2018-12-13 08:33:13', '2018-12-13 11:41:39', '2018-12-13 11:41:39'),
(33, 1, 'pqr', 'abc', 'pqr@gmail.com', '$2y$10$mJMfOqD82L8iy4YuuGkIj.VDJ6ZZ7O9R3.LAIwfq/pPOxWS7UYD8W', NULL, 'RTHFwT6DnvwJWQaMgE7204dEMYjA195B8Ro8qwzra81ZMuZWPRdIhbFW5QkR', 'NOC Engineer', 'aa', 'aa', '122112', '9696969696', '0', '5sAwR6shaegu5zcbPLbtgW1e71kQ2l7RQZhGSbcp8ly9WphnxlaYbOBJhT0w', '2018-12-13 09:45:25', '2018-12-13 12:57:25', '2018-12-13 12:57:25'),
(34, 1, 'jjqq', 'kkkk', 'jjqq@gmail.com', '$2y$10$T/h/9PJ.sE4nK0I1K2MckOgYR/YHca5euZzyFB5XtsFF.0XSlz2Qm', NULL, 'InAPru9C5jyn6v5LP2R7kfewhKNxmqWf4w1PLo1gqND7pm3fsJr7C26cN4Wb', 'NOC Engineer', 'a', 'a', '123456', '9898989898', '0', 'UpcLPCsoj1JbxKdq62zvSDXIkcKfcw1Bt8ubH3IHmJt3USOwaNGToVNhacp6', '2018-12-13 09:58:37', '2018-12-13 12:57:47', '2018-12-13 12:57:47'),
(36, 1, 'Joseph', 'Wainaina', 'wainaina@soliton.co.ke', '$2y$10$NSoZWUv4ovBKZWT7tC1npeU9a2mdEdEPhinfxd6CMWjC8CnwXMrh.', NULL, '22IVTAr9fXoYgoIlK1K4Hzcn7WUNP8L23eid200DZ4vCtQNcM074lFiqdgIM', 'NOC Engineer', 'P.O Box 15913 - 00100 Nairobi, Kenya, P.O Box 15913 - 00100 Nairobi, Kenya', 'Nairobi', '0100', '254704886997', '0', 'usrzN4FHw3J5ZP4XQDEC9JInELFZIuab126HcX9KoJb6X2CjmRNckj0fqPGZ', '2018-12-13 11:49:16', '2018-12-13 11:49:16', NULL),
(37, 1, 'NOC', 'Soliton', 'noc@soliton.co.ke', '$2y$10$Aac5s0G/jJi4mmKsQV/KvubmAUn56A8zFmZZkuYdlrVf/zMcUMlI.', NULL, 'DFmsaKB7EapcqnBbKLdkZ98FOPpMkmgsZbS1UCYeX1FWXnExPe6J5oxtHcSl', 'NOC Engineer', 'P.O Box 15913 - 00100 Nairobi, Kenya, P.O Box 15913 - 00100 Nairobi, Kenya', 'Nairobi', '0100', '0721455', '0', 'e2SuLdLYTpmpcnJvMrbojPxcXjAepAFfRMmktDHie9xFb12GxHuqQPob65Qx', '2018-12-13 11:57:33', '2018-12-13 11:57:33', NULL),
(38, 3, 'Ibrahim', 'Sirat', 'sirat@gmail.com', '$2y$10$QsdK1sqaPyidXZ8I0SJhZe77mpxTDsgnw5bJx8xLS4CXpP2PODhgm', NULL, '86rJA4hKkqSAySb8muszw3em2CVauDuv725oXgKDFC6dN9tocxOl2TnL46Rd', 'admin', 'P.O Box 15913 - 00100 Nairobi, Kenya, P.O Box 15913 - 00100 Nairobi, Kenya', 'Nairobi', '0100', '254720733000', '0', NULL, '2018-12-13 12:48:18', '2018-12-13 12:53:30', NULL),
(39, 3, 'Evans', 'Mulemba', 'evans@soliton.co.ke', '$2y$10$B8vPJgxpXpbXYJRqy4X7YOrio3jMOgNQH5n8eDkrfQcY2efU2roiS', NULL, 'l8UauvaniMDm4z0Ggjjwi3JQvuiA3jbp55fVtlTbnhduDSI4LnaMBUIy53jD', 'admin', 'P.O Box 15913 - 00100 Nairobi, Kenya, P.O Box 15913 - 00100 Nairobi, Kenya', 'Nairobi', '0100', '254722394393', '0', NULL, '2018-12-13 12:53:13', '2018-12-13 12:53:13', NULL),
(40, 3, 'Peter', 'Muchai', 'peter@soliton.co.ke', '$2y$10$ZhS6B5ghEvYS7s3OtZJIo.OZe8uWIYFagBJB5qXXhF2nK8S4RhkOu', NULL, 'EAbVMKm3dn2XpQ8BRttJClhKDTeok9DCzPiEZC6hCWvzxxb5VRc8BZvdg9eg', 'admin', 'P.O Box 15913 - 00100 Nairobi, Kenya, P.O Box 15913 - 00100 Nairobi, Kenya', 'Nairobi', '0100', '254704571777', '0', NULL, '2018-12-13 12:55:22', '2018-12-13 12:55:46', NULL),
(41, 3, 'Charles', 'Gacigi', 'charles@gmail.com', '$2y$10$UqacHAdCjp3Xx3bJuUMw6..Qq3bSMI4NdfKBGS8r2FikIqC1SY9La', NULL, 'LHTeduw0w8oVRDfkV7f0VdGsxAuzyfL21ckPPTLtkBg8wgFAWEjbFti0NTNQ', 'admin', 'P.O Box 15913 - 00100 Nairobi, Kenya, P.O Box 15913 - 00100 Nairobi, Kenya', 'Nairobi', '0100', '254712787050', '0', NULL, '2018-12-13 13:00:05', '2018-12-13 13:00:05', NULL),
(42, 1, 'William', 'Jones', 'wj@mail.com', '$2y$10$bo0JqM5iuiBBQRpTuwjF1OiqM4XHk1FEDliX3B8oqzzCUdGP52iom', NULL, 'wZmaIK8AWTRqIm5cRcqNqysx3IrwWKmv0LE3gL2syLiW0NUEbl1YdhRxA0xj', 'NOC Engineer', 'abcd', 'abcd', '878787', '9898989898', '0', NULL, '2018-12-14 08:26:19', '2018-12-14 08:26:19', NULL),
(43, 1, 'Jullion', 'Jolly', 'jl@mail.com', '$2y$10$zWO2xyez9zmDi9gGf6dr1eCsx/FcpWIHuiL00EM16P9YcthgnIfnm', NULL, '2IiExrPPqTReNwyadJHHuiaLr9Y9D3q5t6CwaVcZf4sRddK2QsfuRVIr7UVc', 'NOC Engineer', 'aaaa', 'aaa', '989898', '9898989898', '0', 'JU2hvtHi5Fnk7RZAV8cEwrqqRJ6TV8Q3KCxIfNUHXuPbJR3O7G5BMtsk97jG', '2018-12-14 08:58:03', '2018-12-14 08:58:03', NULL),
(44, 3, 'joseph', 'wambua', 'joseph.wambua@soliton.co.ke', '$2y$10$ZCRaozZTXt7DvL2u1WeDqOPSo8eeYeXqDRgtS1T7ZtYrvKf/rcp2W', NULL, '2wW7p85Vj0aENdCXf7gjHfAMYZhwzBVweyvgkNq8XGsHitGARjc2Up7rCgWN', 'admin', '15913', 'coast', '00100', '245720961737', '0', NULL, '2018-12-14 13:08:17', '2018-12-14 13:08:17', NULL),
(46, 3, 'Ibrahim', 'Mohamed', 'ibrahim.ali@soliton.co.ke', '$2y$10$AlGyEgU3Ecx/Il9pyC5RXO8Ga/tFRg/t/kiZo0sJgI9/Bb/9x4Gm2', NULL, '3WkahaeLBpRvEeF1gDKKlWktYbGD1M6MrLtX1wF6JWsHdWthXQchTmRsTbFp', 'admin', '15913', 'central', '00100', '254717044144', '0', NULL, '2018-12-15 15:02:39', '2018-12-15 15:02:39', NULL),
(49, 3, 'joseph', 'Wambua', 'joseph@gmail.com', '$2y$10$D7TuEhOkRzEXoCIdBXaYr.S.a5As.wQZA7FQ4KxHnUH05uf3v3evq', NULL, 'kQajfQh2MnWNgGwVLte7O1dcLc7C9qbYTeEBjNi6BIBmxI3eISUDatHOLgoN', 'admin', '15913', 'NAIROBI', '00100', '254780961737', '0', NULL, '2018-12-17 10:53:10', '2018-12-17 10:53:10', NULL),
(50, 3, 'mohamed', 'Omar', 'moha@gmail.com', '$2y$10$hhMsQSdlw3Um8TXYhz7Pa.PlwHvRF7pIrlVT2Id8T6861kxxkSj3K', NULL, 'XGKUTeRIGxqIcMXSyeQlJY583Ls5vJL8GkdMULp9v31Dn0ixZWctia9oiuZL', 'NOC Engineer', '15913', 'NAIROBI', '00100', '254723348432', '0', NULL, '2018-12-17 10:54:46', '2018-12-17 10:54:46', NULL);

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
  `sms_username` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sms_senderid` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sms_passwrd` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sms_message` longtext COLLATE utf8mb4_unicode_ci,
  `sms_after_four_hr` text COLLATE utf8mb4_unicode_ci,
  `sms_after_resolution` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `websitesettings`
--

INSERT INTO `websitesettings` (`id`, `website_name`, `website_logo`, `watermark`, `email`, `locktimeout`, `address`, `mobilenum`, `openingTime`, `fb_link`, `tw_link`, `li_link`, `yt_link`, `in_link`, `gp_link`, `ga`, `sms_username`, `sms_senderid`, `sms_passwrd`, `sms_message`, `sms_after_four_hr`, `sms_after_resolution`, `created_at`, `updated_at`) VALUES
(1, 'Ticketing System', 'ticketing-system.png', NULL, NULL, '30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'jaynestylist', 'RAPUNZEL', 'G1lb3rt!@-?', 'Hi FENAMESSS, Ticket Number TICKETNO for the link LINKAFFECTED has been ASSIGNATION \r\n. Kindly attend to and update.', 'FAULT REMINDER: Ticket Number TICKETNO for the link LINKAFFECTED is now TIMEEXCEED. Kindly expedite the process', 'FAULT RESOLUTION:  Ticket Number TICKETNO \r\nLINK: LINKAFFECTED \r\nFault Reported Time: CREATETIME\r\nFault Cleared Time: RESOLVETIME\r\nAccess Request: ACCTIME\r\nSecurity Escort: ESCTIME \r\nSLA TIME: SLATIME', NULL, '2018-12-13 05:07:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client_contact_lists`
--
ALTER TABLE `client_contact_lists`
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
-- Indexes for table `engg_drivers`
--
ALTER TABLE `engg_drivers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kb_site_infos`
--
ALTER TABLE `kb_site_infos`
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
-- Indexes for table `nature_of__faults`
--
ALTER TABLE `nature_of__faults`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nofbis`
--
ALTER TABLE `nofbis`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `sms_settings`
--
ALTER TABLE `sms_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticket_generateds`
--
ALTER TABLE `ticket_generateds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticket_post_replies`
--
ALTER TABLE `ticket_post_replies`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `todolists`
--
ALTER TABLE `todolists`
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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `client_contact_lists`
--
ALTER TABLE `client_contact_lists`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `close_tickets`
--
ALTER TABLE `close_tickets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `engg_drivers`
--
ALTER TABLE `engg_drivers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kb_site_infos`
--
ALTER TABLE `kb_site_infos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `nature_of__faults`
--
ALTER TABLE `nature_of__faults`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `nofbis`
--
ALTER TABLE `nofbis`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `page_infos`
--
ALTER TABLE `page_infos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sms_settings`
--
ALTER TABLE `sms_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ticket_generateds`
--
ALTER TABLE `ticket_generateds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `ticket_post_replies`
--
ALTER TABLE `ticket_post_replies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=173;

--
-- AUTO_INCREMENT for table `todolists`
--
ALTER TABLE `todolists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

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
