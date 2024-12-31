-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 07, 2024 at 10:35 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `planner`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `App_Id` bigint(20) UNSIGNED NOT NULL,
  `App_Date` date NOT NULL,
  `App_Time` time NOT NULL,
  `App_Duration` int(11) NOT NULL,
  `App_Price` double(10,2) NOT NULL DEFAULT 0.00,
  `App_Desc` varchar(255) DEFAULT NULL,
  `App_Status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `Customer_Id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`App_Id`, `App_Date`, `App_Time`, `App_Duration`, `App_Price`, `App_Desc`, `App_Status`, `created_at`, `updated_at`, `Customer_Id`) VALUES
(2, '2024-01-10', '10:00:00', 1, 150.00, NULL, 'cancelled', '2024-01-08 07:02:15', '2024-01-08 07:02:15', 2),
(3, '2024-01-13', '13:00:00', 1, 150.00, 'call before coming', 'completed', '2024-01-08 07:33:47', '2024-01-17 23:24:41', 3),
(5, '2024-01-12', '14:00:00', 1, 100.00, NULL, 'completed', '2024-01-08 21:00:51', '2024-01-17 01:46:59', 4),
(6, '2024-01-18', '07:45:00', 3, 350.00, NULL, 'completed', '2024-01-17 01:45:52', '2024-01-17 02:04:23', 1),
(7, '2024-01-08', '07:30:00', 1, 100.00, NULL, 'cancelled', '2024-01-17 02:00:48', '2024-01-17 23:23:20', 5),
(8, '2024-03-28', '14:00:00', 2, 250.00, NULL, 'completed', '2024-01-17 02:03:45', '2024-01-17 02:03:53', 6),
(9, '2024-01-22', '08:30:00', 3, 300.00, NULL, 'upcoming', '2024-01-17 02:05:44', '2024-01-17 02:05:44', 7),
(10, '2024-01-24', '10:00:00', 2, 250.00, NULL, 'upcoming', '2024-01-17 02:06:55', '2024-01-17 02:06:55', 8),
(11, '2024-02-15', '12:00:00', 1, 150.00, NULL, 'completed', '2024-01-17 02:08:41', '2024-01-17 22:10:17', 9),
(12, '2024-01-19', '09:30:00', 2, 250.00, NULL, 'upcoming', '2024-01-17 02:09:59', '2024-01-17 02:09:59', 10),
(13, '2023-12-15', '10:15:00', 3, 350.00, NULL, 'completed', '2024-01-17 02:11:18', '2024-01-17 02:11:29', 1),
(15, '2024-04-06', '09:00:00', 5, 50.00, 'Clean banglo', 'completed', '2024-04-02 21:45:31', '2024-04-17 22:34:52', 1),
(16, '2024-04-25', '13:00:00', 4, 25.00, 'Clean small room', 'cancelled', '2024-04-02 21:49:16', '2024-05-06 23:00:48', 11),
(17, '2024-04-20', '00:00:00', 4, 150.00, 'To be review later', 'completed', '2024-04-02 21:50:49', '2024-05-06 23:00:37', 12),
(18, '2024-04-15', '16:00:00', 3, 100.00, NULL, 'completed', '2024-04-02 21:51:49', '2024-04-17 22:35:26', 13),
(19, '2024-04-06', '15:00:00', 5, 150.00, NULL, 'completed', '2024-04-02 21:54:07', '2024-04-17 22:35:15', 14),
(20, '2024-03-23', '13:00:00', 5, 75.00, NULL, 'cancelled', '2024-04-02 21:56:11', '2024-04-02 21:56:25', 14),
(21, '2024-03-20', '15:00:00', 1, 100.00, NULL, 'completed', '2024-04-02 22:05:44', '2024-04-02 22:15:03', 14),
(22, '2024-03-12', '15:00:00', 1, 100.00, NULL, 'completed', '2024-04-02 22:05:51', '2024-04-02 22:06:09', 14),
(23, '2024-03-07', '14:30:00', 6, 45.00, NULL, 'completed', '2024-04-02 22:06:56', '2024-04-02 22:07:07', 14),
(24, '2024-04-01', '07:30:00', 6, 75.00, NULL, 'completed', '2024-04-02 22:08:14', '2024-04-02 22:08:22', 14),
(25, '2024-04-01', '15:00:00', 3, 150.00, NULL, 'completed', '2024-04-02 22:09:08', '2024-04-02 22:09:16', 12),
(26, '2024-04-03', '12:00:00', 4, 100.00, NULL, 'cancelled', '2024-04-02 22:10:06', '2024-04-02 22:10:15', 15),
(27, '2024-03-01', '06:15:00', 7, 40.00, NULL, 'completed', '2024-04-02 22:13:34', '2024-04-02 22:13:44', 15),
(28, '2024-03-02', '08:20:00', 5, 65.00, NULL, 'cancelled', '2024-04-02 22:14:32', '2024-04-02 22:14:42', 6),
(29, '2024-03-04', '17:15:00', 1, 45.00, NULL, 'completed', '2024-04-02 22:15:53', '2024-04-02 22:16:05', 12),
(30, '2024-03-13', '15:00:00', 6, 150.00, NULL, 'completed', '2024-04-02 22:16:58', '2024-04-02 22:18:42', 15),
(31, '2024-03-14', '08:00:00', 9, 175.00, NULL, 'completed', '2024-04-02 22:17:43', '2024-04-02 22:19:08', 13),
(32, '2024-03-15', '16:30:00', 2, 500.00, NULL, 'completed', '2024-04-02 22:19:44', '2024-04-02 22:20:08', 11),
(33, '2024-03-09', '18:20:00', 1, 45.00, NULL, 'completed', '2024-04-02 22:21:04', '2024-04-02 22:22:33', 14),
(34, '2024-03-16', '08:00:00', 5, 35.00, NULL, 'completed', '2024-04-02 22:21:30', '2024-04-02 22:22:45', 1),
(35, '2024-03-30', '18:30:00', 2, 150.00, NULL, 'completed', '2024-04-02 22:22:06', '2024-04-02 22:22:55', 15),
(36, '2024-05-08', '16:20:00', 1, 100.00, 'DFSVDFVvdsfvfcdsf', 'upcoming', '2024-05-06 23:16:27', '2024-05-06 23:16:27', 16);

-- --------------------------------------------------------

--
-- Table structure for table `appointment_staff`
--

CREATE TABLE `appointment_staff` (
  `App_Id` bigint(20) UNSIGNED NOT NULL,
  `Staff_Id` bigint(20) UNSIGNED NOT NULL,
  `Staff_Name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `appointment_staff`
--

INSERT INTO `appointment_staff` (`App_Id`, `Staff_Id`, `Staff_Name`, `created_at`, `updated_at`) VALUES
(3, 3, 'Arsyad aaa', '2024-01-08 07:33:48', '2024-01-08 07:33:48'),
(3, 1, 'Izzatul Nurul Fathin', '2024-01-08 07:33:48', '2024-01-08 07:33:48'),
(5, 2, 'Arsyad aaa', '2024-01-08 21:00:51', '2024-01-08 21:00:51'),
(6, 2, 'Arsyad aaa', '2024-01-17 01:45:52', '2024-01-17 01:45:52'),
(7, 1, 'Izzatul Nurul Fathin', '2024-01-17 02:00:48', '2024-01-17 02:00:48'),
(8, 3, 'Aleya Iqlima', '2024-01-17 02:03:45', '2024-01-17 02:03:45'),
(9, 2, 'Arsyad Hamidi', '2024-01-17 02:05:44', '2024-01-17 02:05:44'),
(10, 1, 'Izzatul Nurul Fathin', '2024-01-17 02:06:55', '2024-01-17 02:06:55'),
(11, 3, 'Aleya Iqlima', '2024-01-17 02:08:41', '2024-01-17 02:08:41'),
(12, 1, 'Izzatul Nurul Fathin', '2024-01-17 02:09:59', '2024-01-17 02:09:59'),
(13, 1, 'Izzatul Nurul Fathin', '2024-01-17 02:11:18', '2024-01-17 02:11:18'),
(13, 3, 'Aleya Iqlima', '2024-01-17 02:11:18', '2024-01-17 02:11:18'),
(15, 1, 'Izzatul Nurul Fathin', '2024-04-02 21:45:31', '2024-04-02 21:45:31'),
(15, 2, 'Arsyad Hamidi', '2024-04-02 21:45:31', '2024-04-02 21:45:31'),
(16, 2, 'Arsyad Hamidi', '2024-04-02 21:49:16', '2024-04-02 21:49:16'),
(17, 1, 'Izzatul Nurul Fathin', '2024-04-02 21:50:49', '2024-04-02 21:50:49'),
(18, 1, 'Izzatul Nurul Fathin', '2024-04-02 21:51:49', '2024-04-02 21:51:49'),
(19, 1, 'Izzatul Nurul Fathin', '2024-04-02 21:54:07', '2024-04-02 21:54:07'),
(20, 1, 'Izzatul Nurul Fathin', '2024-04-02 21:56:11', '2024-04-02 21:56:11'),
(21, 1, 'Izzatul Nurul Fathin', '2024-04-02 22:05:44', '2024-04-02 22:05:44'),
(22, 1, 'Izzatul Nurul Fathin', '2024-04-02 22:05:51', '2024-04-02 22:05:51'),
(23, 1, 'Izzatul Nurul Fathin', '2024-04-02 22:06:56', '2024-04-02 22:06:56'),
(24, 2, 'Arsyad Hamidi', '2024-04-02 22:08:14', '2024-04-02 22:08:14'),
(25, 1, 'Izzatul Nurul Fathin', '2024-04-02 22:09:08', '2024-04-02 22:09:08'),
(26, 2, 'Arsyad Hamidi', '2024-04-02 22:10:06', '2024-04-02 22:10:06'),
(27, 2, 'Arsyad Hamidi', '2024-04-02 22:13:34', '2024-04-02 22:13:34'),
(28, 1, 'Izzatul Nurul Fathin', '2024-04-02 22:14:32', '2024-04-02 22:14:32'),
(29, 1, 'Izzatul Nurul Fathin', '2024-04-02 22:15:53', '2024-04-02 22:15:53'),
(30, 2, 'Arsyad Hamidi', '2024-04-02 22:16:58', '2024-04-02 22:16:58'),
(31, 1, 'Izzatul Nurul Fathin', '2024-04-02 22:17:43', '2024-04-02 22:17:43'),
(32, 1, 'Izzatul Nurul Fathin', '2024-04-02 22:19:44', '2024-04-02 22:19:44'),
(33, 1, 'Izzatul Nurul Fathin', '2024-04-02 22:21:04', '2024-04-02 22:21:04'),
(34, 1, 'Izzatul Nurul Fathin', '2024-04-02 22:21:30', '2024-04-02 22:21:30'),
(35, 1, 'Izzatul Nurul Fathin', '2024-04-02 22:22:06', '2024-04-02 22:22:06'),
(36, 1, 'Izzatul Nurul Fathin', '2024-05-06 23:16:27', '2024-05-06 23:16:27');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `Customer_Id` bigint(20) UNSIGNED NOT NULL,
  `Customer_Name` varchar(255) NOT NULL,
  `Customer_HP` varchar(255) NOT NULL,
  `Customer_Address` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`Customer_Id`, `Customer_Name`, `Customer_HP`, `Customer_Address`, `created_at`, `updated_at`) VALUES
(1, 'Viona Candyuyy', '01323231415', '12 Jalan Keruing, Tabuan Heights, Kuching, Sarawak, Malaysia', '2024-01-06 01:58:18', '2024-05-06 00:45:26'),
(3, 'Nurul Ain Binti Ahmad Nasri', '0196244295', '14B Jalan Sultan Tengah, Taman Sri Sarawak, Kuching, Sarawak, Malaysia', '2024-01-08 07:33:47', '2024-04-03 18:10:15'),
(5, 'Kalvin Yaw', '01110582686', 'Kolej Dahlia, UNIMAS, Kota Samarahan Sarawak', '2024-01-17 02:00:48', '2024-01-17 02:00:48'),
(6, 'Nur Farisha', '0105082620', 'AD414, Lorong Hup Kee, Batu Lintang, Kuching, Sarawak', '2024-01-17 02:03:45', '2024-01-17 02:03:45'),
(7, 'Mohd Izzat', '0162609410', '14A Jalan Sultan Tengah, Taman Sri Sarawak, Kuching, Sarawak', '2024-01-17 02:05:44', '2024-01-17 02:05:44'),
(8, 'Vyonne Phang', '0195138536', '56 Jalan Datuk Ajibah Abol, Stampin, Kuching, Sarawak', '2024-01-17 02:06:55', '2024-01-17 02:06:55'),
(9, 'Goh Zhen Tung', '01116446626', '7A Lorong Semariang, Taman Bamboo, Kuching, Sarawak', '2024-01-17 02:08:41', '2024-01-17 02:08:41'),
(10, 'Brian Lee', '0148591648', '30C Jalan Song Thian Cheok, Padungan, Kuching, Sarawak', '2024-01-17 02:09:59', '2024-01-17 02:09:59'),
(11, 'Marcella', '0123456789', 'Kinarut, Papar,  Sabah', '2024-04-02 21:49:16', '2024-04-02 21:49:16'),
(12, 'Allen Bradledddd', '0198765439', 'Syeratech Enterprise, No 23 Central Shopping Plaza, Jalan Banjaran, 84510 Kota Kinabalu, Sabah', '2024-04-02 21:50:49', '2024-04-18 21:45:37'),
(13, 'Sally Pan', '0145678765', 'Sabah', '2024-04-02 21:51:49', '2024-04-02 21:51:49'),
(14, 'John Smith', '01134569087', 'Jalan Banjaran, Kota Kinabalu, Sabah', '2024-04-02 21:54:07', '2024-04-02 21:54:07'),
(16, 'Lee Su Fah', '0143931676', 'Rumah Pee Millo', '2024-05-06 23:16:27', '2024-05-06 23:16:27');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
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
(5, '2023_12_03_132118_create_staff_table', 1),
(6, '2023_12_03_132148_create_customers_table', 1),
(7, '2023_12_03_132234_create_appointments_table', 1),
(8, '2023_12_03_132504_create_appointment__staff_table', 1),
(9, '2024_01_06_115832_add_customer_id_to_appointments_table', 2),
(10, '2024_01_17_065018_create_notifications_table', 2),
(11, '2024_05_07_083347_update_notifications_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) NOT NULL,
  `type` varchar(255) NOT NULL,
  `notifiable_type` varchar(255) NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('29f5d7a1-5d11-4cdd-a1c6-a467f6dc9b8b', 'App\\Notifications\\upcomingApp', 'App\\Models\\User', 15, '{\"appointments\":[{\"date\":\"2024-01-22\",\"time\":\"08:30:00\"},{\"date\":\"2024-01-24\",\"time\":\"10:00:00\"},{\"date\":\"2024-01-19\",\"time\":\"09:30:00\"},{\"date\":\"2024-05-08\",\"time\":\"16:20:00\"}]}', NULL, '2024-05-07 00:35:23', '2024-05-07 00:35:23'),
('5283ef0b-a386-4410-ae1f-311bc6114c0a', 'App\\Notifications\\upcomingApp', 'App\\Models\\User', 12, '{\"appointments\":[{\"date\":\"2024-01-22\",\"time\":\"08:30:00\"},{\"date\":\"2024-01-24\",\"time\":\"10:00:00\"},{\"date\":\"2024-01-19\",\"time\":\"09:30:00\"},{\"date\":\"2024-05-08\",\"time\":\"16:20:00\"}]}', NULL, '2024-05-07 00:35:18', '2024-05-07 00:35:18'),
('7abd6404-75f5-4469-af34-bd0ea3af4e55', 'App\\Notifications\\upcomingApp', 'App\\Models\\User', 5, '{\"appointments\":[{\"date\":\"2024-01-22\",\"time\":\"08:30:00\"},{\"date\":\"2024-01-24\",\"time\":\"10:00:00\"},{\"date\":\"2024-01-19\",\"time\":\"09:30:00\"},{\"date\":\"2024-05-08\",\"time\":\"16:20:00\"}]}', NULL, '2024-05-07 00:35:16', '2024-05-07 00:35:16'),
('852669a1-c975-457e-b9c3-57fef608c644', 'App\\Notifications\\upcomingApp', 'App\\Models\\User', 2, '{\"appointments\":[{\"date\":\"2024-01-22\",\"time\":\"08:30:00\"},{\"date\":\"2024-01-24\",\"time\":\"10:00:00\"},{\"date\":\"2024-01-19\",\"time\":\"09:30:00\"},{\"date\":\"2024-05-08\",\"time\":\"16:20:00\"}]}', NULL, '2024-05-07 00:35:15', '2024-05-07 00:35:15'),
('b4035a32-e314-4dec-983b-c5e233ca853c', 'App\\Notifications\\upcomingApp', 'App\\Models\\User', 13, '{\"appointments\":[{\"date\":\"2024-01-22\",\"time\":\"08:30:00\"},{\"date\":\"2024-01-24\",\"time\":\"10:00:00\"},{\"date\":\"2024-01-19\",\"time\":\"09:30:00\"},{\"date\":\"2024-05-08\",\"time\":\"16:20:00\"}]}', NULL, '2024-05-07 00:35:20', '2024-05-07 00:35:20'),
('eb5a952a-e55c-4d47-8a21-0110e5297e0e', 'App\\Notifications\\upcomingApp', 'App\\Models\\User', 14, '{\"appointments\":[{\"date\":\"2024-01-22\",\"time\":\"08:30:00\"},{\"date\":\"2024-01-24\",\"time\":\"10:00:00\"},{\"date\":\"2024-01-19\",\"time\":\"09:30:00\"},{\"date\":\"2024-05-08\",\"time\":\"16:20:00\"}]}', NULL, '2024-05-07 00:35:21', '2024-05-07 00:35:21');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `Staff_Id` bigint(20) UNSIGNED NOT NULL,
  `Staff_Name` varchar(255) NOT NULL,
  `Staff_HP` varchar(255) NOT NULL,
  `Staff_Address` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`Staff_Id`, `Staff_Name`, `Staff_HP`, `Staff_Address`, `created_at`, `updated_at`) VALUES
(1, 'Izzatul Nurul Fathin', '0162531554', '31D Jalan Song Thian Cheok, Padungan, Kuching, Sarawak, Malaysia', '2024-01-05 01:37:34', '2024-01-05 01:44:18'),
(2, 'Arsyad Hamidi', '0123456780', 'Rumah Pee MillA', '2024-01-08 04:52:27', '2024-01-17 01:57:21');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `hp` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `hp`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'Aleya Iqlima', 'aleyqlima@gmail.com', '01156563238', NULL, '$2y$10$uJKsTtEco9kgRLer31zdL.IIfz3LfjRiequCAAclhm4ujV.05XLkC', NULL, '2024-01-05 01:41:25', '2024-01-05 01:41:25'),
(5, 'Roslina Muning', 'roslinaakmuning@gmail.com', '01345678898', '2024-01-17 03:24:25', '$2y$10$y.gzzsVMbwoMtPTlivcdeurzb6sIX56yTbzF76ls7RX9e0eH3/xA6', NULL, '2024-01-17 03:23:47', '2024-04-17 00:06:58'),
(12, 'Mohd Izzat', 'l33sufah@gmail.com', '0162609410', '2024-04-02 22:02:57', '$2y$10$ba22jplg8uk0NlHKNLky5ui0TNjqi4DXQorkgu4eKuWM94ptXhNI6', NULL, '2024-04-02 21:58:57', '2024-04-03 22:48:38'),
(13, 'Marceella', 'goskydragon@gmail.com', '0137573590', '2024-04-02 22:03:18', '$2y$10$P6y7uVROqSND7EP4LP6MsO5auKK0PJ134Mwb7OSluaSL.WHPIbpLe', NULL, '2024-04-02 22:00:24', '2024-04-02 22:03:18'),
(14, 'Lee Su Fah', 'leesufah20@gmail.com', '0143931676', NULL, '$2y$10$8WUn70fzCoMwmJBLShM9ouXgQi0LtjCc2zmnbWLD.rDwuy4FC8y4y', NULL, '2024-04-02 22:12:17', '2024-04-02 22:12:17'),
(15, 'fdbdfb', 'dfbdf@gmail.com', '234567', NULL, '$2y$10$MJ4uAvgl/eTrYoWky846xOzmCF5/KiXd/BVtd/8VxF0Mcb.3955sG', NULL, '2024-05-06 22:34:24', '2024-05-06 22:34:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`App_Id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`Customer_Id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`Staff_Id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `App_Id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `Customer_Id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `Staff_Id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
