-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 22, 2024 at 08:22 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `schoolmanagement`
--

-- --------------------------------------------------------

--
-- Table structure for table `assign_class_teacher`
--

CREATE TABLE `assign_class_teacher` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `class_id` varchar(255) DEFAULT NULL,
  `teacher_id` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `is_delete` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=not, 1=yes',
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=active, 1=inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `assign_class_teacher`
--

INSERT INTO `assign_class_teacher` (`id`, `class_id`, `teacher_id`, `created_by`, `is_delete`, `status`, `created_at`, `updated_at`) VALUES
(1, '6', '17', 1, 0, 0, '2024-03-13 01:19:48', '2024-03-13 01:19:48'),
(5, '2', '2', 1, 0, 0, '2024-03-13 02:00:40', '2024-03-13 05:41:30'),
(7, '2', '19', 1, 0, 0, '2024-03-17 22:40:03', '2024-03-17 22:40:03'),
(8, '7', '19', 1, 0, 0, '2024-03-17 23:19:13', '2024-03-17 23:19:13');

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=active, 1=inactive',
  `is_delete` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=not, 1=yes',
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`id`, `name`, `status`, `is_delete`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Mathematics', 1, 0, 1, '2024-03-05 04:25:57', '2024-03-05 05:23:09'),
(2, 'Physics', 0, 0, 1, '2024-03-05 04:33:15', '2024-03-05 04:33:15'),
(3, 'English', 1, 0, 1, '2024-03-05 04:33:30', '2024-03-05 04:33:30'),
(4, 'Hindi', 0, 1, 1, '2024-03-05 04:33:35', '2024-03-05 05:19:16'),
(5, 'Biology', 1, 0, 1, '2024-03-05 04:33:44', '2024-03-05 05:15:41'),
(6, 'Oriya', 0, 0, 1, '2024-03-05 04:33:51', '2024-03-05 04:33:51'),
(7, 'Hindi', 0, 0, 1, '2024-03-17 23:18:29', '2024-03-17 23:18:29');

-- --------------------------------------------------------

--
-- Table structure for table `class_subjects`
--

CREATE TABLE `class_subjects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `class_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `is_delete` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=not, 1=yes',
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=active, 1=inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `class_subjects`
--

INSERT INTO `class_subjects` (`id`, `class_id`, `subject_id`, `created_by`, `is_delete`, `status`, `created_at`, `updated_at`) VALUES
(11, 2, 2, 1, 0, 1, '2024-03-06 01:53:00', '2024-03-06 01:53:00'),
(12, 2, 4, 1, 0, 0, '2024-03-06 01:53:00', '2024-03-06 01:53:00'),
(13, 2, 1, 1, 0, 1, '2024-03-06 01:53:00', '2024-03-06 03:41:17'),
(14, 2, 5, 1, 0, 0, '2024-03-06 01:53:00', '2024-03-06 03:39:04'),
(15, 6, 2, 1, 0, 0, '2024-03-06 01:53:12', '2024-03-06 01:53:12'),
(16, 6, 4, 1, 0, 0, '2024-03-06 01:53:12', '2024-03-06 01:53:12'),
(17, 6, 1, 1, 0, 0, '2024-03-06 01:53:12', '2024-03-06 03:41:10'),
(18, 6, 5, 1, 0, 1, '2024-03-06 01:53:12', '2024-03-06 03:41:28'),
(19, 6, 7, 1, 0, 0, '2024-03-12 23:29:45', '2024-03-12 23:29:45'),
(20, 6, 6, 1, 0, 0, '2024-03-12 23:29:45', '2024-03-12 23:29:45'),
(21, 6, 8, 1, 0, 0, '2024-03-12 23:29:45', '2024-03-12 23:29:45'),
(22, 7, 9, 1, 0, 0, '2024-03-17 23:19:02', '2024-03-17 23:19:02');

-- --------------------------------------------------------

--
-- Table structure for table `class_subject_timetable`
--

CREATE TABLE `class_subject_timetable` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `class_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `week_id` int(11) DEFAULT NULL,
  `start_time` varchar(255) DEFAULT NULL,
  `end_time` varchar(255) DEFAULT NULL,
  `room_number` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `class_subject_timetable`
--

INSERT INTO `class_subject_timetable` (`id`, `class_id`, `subject_id`, `week_id`, `start_time`, `end_time`, `room_number`, `created_at`, `updated_at`) VALUES
(1, 6, 6, 1, '08:00', '10:00', '34', '2024-03-14 05:48:45', '2024-03-14 05:48:45'),
(2, 6, 6, 2, '02:00', '04:00', '36', '2024-03-14 05:48:45', '2024-03-14 05:48:45'),
(5, 2, 4, 3, '06:30', '09:00', '12', '2024-03-14 05:53:03', '2024-03-14 05:53:03'),
(6, 2, 4, 4, '10:00', '11:30', '15', '2024-03-14 05:53:03', '2024-03-14 05:53:03'),
(7, 2, 5, 1, '09:30', '11:30', '2', '2024-03-14 22:34:03', '2024-03-14 22:34:03'),
(8, 2, 5, 2, '09:30', '11:30', '4', '2024-03-14 22:34:03', '2024-03-14 22:34:03'),
(9, 2, 5, 3, '09:30', '11:30', '6', '2024-03-14 22:34:03', '2024-03-14 22:34:03'),
(10, 2, 5, 4, '09:30', '11:30', '8', '2024-03-14 22:34:03', '2024-03-14 22:34:03'),
(11, 2, 5, 5, '11:30', '02:30', '10', '2024-03-14 22:34:03', '2024-03-14 22:34:03'),
(12, 7, 9, 1, '10:30', '12:00', '30', '2024-03-17 23:27:30', '2024-03-17 23:27:30'),
(13, 7, 9, 2, '15:30', '18:00', '31', '2024-03-17 23:27:30', '2024-03-17 23:27:30');

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `note` varchar(255) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `is_delete` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=not, 1=yes',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exams`
--

INSERT INTO `exams` (`id`, `name`, `note`, `created_by`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 'FIRST TERM 2023/2024', 'testing 1', 1, 0, '2024-03-20 22:53:32', '2024-03-20 23:18:10'),
(2, 'FIRST TERM 2024/2025', 'testing 2', 1, 0, '2024-03-20 22:53:56', '2024-03-20 23:18:27'),
(3, 'FIRST TERM 2025/2026', 'testing 3', 1, 0, '2024-03-20 23:19:06', '2024-03-20 23:19:06');

-- --------------------------------------------------------

--
-- Table structure for table `exam_schedules`
--

CREATE TABLE `exam_schedules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `exam_id` int(11) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `exam_date` date DEFAULT NULL,
  `start_time` varchar(255) DEFAULT NULL,
  `end_time` varchar(255) DEFAULT NULL,
  `room_number` varchar(255) DEFAULT NULL,
  `full_mark` varchar(255) DEFAULT NULL,
  `pass_mark` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exam_schedules`
--

INSERT INTO `exam_schedules` (`id`, `exam_id`, `class_id`, `subject_id`, `exam_date`, `start_time`, `end_time`, `room_number`, `full_mark`, `pass_mark`, `created_by`, `created_at`, `updated_at`) VALUES
(3, 1, 6, 2, '2024-03-21', '12:07', '13:07', '24', '100', '56', 1, '2024-03-21 01:08:10', '2024-03-21 01:08:10'),
(4, 1, 6, 4, '2024-03-22', '13:08', '14:08', '25', '100', '67', 1, '2024-03-21 01:08:10', '2024-03-21 01:08:10'),
(5, 1, 6, 1, '2024-03-23', '16:00', '18:00', '26', '100', '45', 1, '2024-03-21 01:08:10', '2024-03-21 01:08:10'),
(12, 1, 2, 4, '2024-03-21', '12:30', '14:30', '58', '100', '55', 1, '2024-03-21 01:15:09', '2024-03-21 01:15:09'),
(13, 1, 2, 5, '2024-03-22', '10:00', '11:00', '36', '100', '75', 1, '2024-03-21 01:15:09', '2024-03-21 01:15:09'),
(15, 1, 7, 9, '2024-03-26', '13:00', '14:30', '15', '100', '51', 1, '2024-03-21 01:16:34', '2024-03-21 01:16:34'),
(16, 2, 2, 4, '2024-03-26', '11:00', '12:00', '2', '100', '35', 1, '2024-03-21 23:46:04', '2024-03-21 23:46:04'),
(17, 2, 2, 5, '2024-03-30', '20:00', '21:00', '5', '100', '30', 1, '2024-03-21 23:46:04', '2024-03-21 23:46:04');

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
(5, '2024_03_05_085839_create_classs_table', 2),
(6, '2024_03_05_091325_drop_classs_table', 3),
(7, '2024_03_05_091442_create_class_table', 4),
(8, '2024_03_05_091947_add_created_by_to_class_table', 5),
(9, '2024_03_05_093941_add_is_delete_to_class_table', 6),
(10, '2024_03_05_110310_create_subjects_table', 7),
(11, '2024_03_06_034600_create_class_subjects_table', 8),
(12, '2024_03_13_062931_create_assign_class_teacher_table', 9),
(13, '2024_03_14_071129_create_weeks_table', 10),
(14, '2024_03_14_110259_create_class_subject_timetable_table', 11),
(15, '2024_03_21_034839_create_exams_table', 12),
(16, '2024_03_21_060233_create_exam_schedules_table', 13);

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
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=active, 1=inactive',
  `is_delete` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=not, 1=yes',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `name`, `type`, `created_by`, `status`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 'Integration', 'Practical', 1, 0, 0, '2024-03-05 05:55:30', '2024-03-05 06:07:03'),
(2, 'Diversity of Living Organisms', 'Theory', 1, 0, 0, '2024-03-05 05:58:06', '2024-03-05 06:06:30'),
(3, 'A Letter to God', 'Theory', 1, 1, 1, '2024-03-05 06:08:30', '2024-03-05 06:10:35'),
(4, 'Electric Charges and Fields', 'Theory', 1, 0, 0, '2024-03-06 00:05:07', '2024-03-06 00:05:07'),
(5, 'Magnetism And Matter', 'Practical', 1, 0, 0, '2024-03-06 00:05:17', '2024-03-06 00:05:17'),
(6, 'Introduction to grammar in Oriya', 'Theory', 1, 0, 0, '2024-03-12 23:29:01', '2024-03-12 23:29:01'),
(7, 'History of the language', 'Theory', 1, 0, 0, '2024-03-12 23:29:10', '2024-03-12 23:29:10'),
(8, 'Writing Skills 1', 'Theory', 1, 0, 0, '2024-03-12 23:29:19', '2024-03-12 23:29:19'),
(9, 'Hindi', 'Theory', 1, 0, 0, '2024-03-17 23:18:43', '2024-03-17 23:18:43');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `admission_number` varchar(255) DEFAULT NULL,
  `roll_number` varchar(50) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `gender` varchar(50) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `caste` varchar(50) DEFAULT NULL,
  `religion` varchar(50) DEFAULT NULL,
  `mobile_number` varchar(15) DEFAULT NULL,
  `admission_date` date DEFAULT NULL,
  `profile_picture` varchar(100) DEFAULT NULL,
  `blood_group` varchar(10) DEFAULT NULL,
  `height` varchar(10) DEFAULT NULL,
  `weight` varchar(10) DEFAULT NULL,
  `occupation` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `marital_status` varchar(255) DEFAULT NULL,
  `permanent_address` varchar(255) DEFAULT NULL,
  `qualification` varchar(255) DEFAULT NULL,
  `work_experience` varchar(255) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  `user_type` tinyint(4) NOT NULL DEFAULT 3 COMMENT '1:admin, 2:teacher, 3:student, 4:parent',
  `is_delete` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0:not deleted, 1:deleted',
  `status` tinyint(4) DEFAULT 0 COMMENT '0:active, 1:inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `parent_id`, `name`, `last_name`, `email`, `email_verified_at`, `password`, `remember_token`, `admission_number`, `roll_number`, `class_id`, `gender`, `date_of_birth`, `caste`, `religion`, `mobile_number`, `admission_date`, `profile_picture`, `blood_group`, `height`, `weight`, `occupation`, `address`, `marital_status`, `permanent_address`, `qualification`, `work_experience`, `note`, `user_type`, `is_delete`, `status`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Admin', NULL, 'admin@gmail.com', NULL, '$2y$10$Es7odPG7xoX73G3GBHaaUOOsG8gVWRB8VeUKevgs8oLeCgHR1MCDC', 'Ssi9RW7zUmfJlC8qKXOIXOwnYgDj5BnFWYAIiAM55AdnbZRESE8s4Bos9Dph', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, '2024-02-28 11:13:57', '2024-03-12 05:19:56'),
(2, NULL, 'Teacher', NULL, 'teacher@gmail.com', NULL, '$2y$10$pC0eMecp6P/czLiu/RZjUeMlGMQ3IhocM2qvnnyqvGkH6cttX3YfG', 'm3m2Fj9ZWERrdT6y2AtDFlwwh2fJy2GUWD11gBTsY5KgoJnG53UPcF8sE9Tl', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 0, 0, '2024-02-29 11:13:57', '2024-03-06 04:15:24'),
(3, NULL, 'Student', NULL, 'student@gmail.com', NULL, '$2y$10$XoXmGJ7YTQuGGqRaVPTHPe4tr3NTb3Nnu3i.sqCZGYzkfvdRwcf22', 'Tu7kPpbZH32vJrlYXTnh0HvVKt8LoUThyiuLK63vMQlGzfp0bStlfikW5cgU', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 0, 0, '2024-02-29 11:13:57', '2024-02-29 11:13:57'),
(4, NULL, 'Parent', NULL, 'parent@gmail.com', NULL, '$2y$10$XoXmGJ7YTQuGGqRaVPTHPe4tr3NTb3Nnu3i.sqCZGYzkfvdRwcf22', 'HonpyUPSwORP7epDyrXThFF8vutBW7XEfNLQ7qb0iIs73bl0lSt6znV8kQLi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, 0, 0, '2024-02-29 11:13:57', '2024-02-29 11:13:57'),
(5, NULL, 'Sagar Behera', NULL, 'sagarkumar@ralecon.com', NULL, '$2y$10$dMYDQcKhcLRRLpC3qVPP7OzgQ4Bqpax2cuIXaTqSuV5/rILJqcRey', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, '2024-03-01 01:01:22', '2024-03-03 23:14:12'),
(6, NULL, 'demo', NULL, 'demo@gmail.com', NULL, '$2y$10$dMYDQcKhcLRRLpC3qVPP7OzgQ4Bqpax2cuIXaTqSuV5/rILJqcRey', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, '2024-03-04 04:48:23', '2024-03-03 23:23:59'),
(7, NULL, 'kathiravan  v', NULL, 'kathir@ralecon.com', NULL, '$2y$10$NbY2EdfOddbEjMyfgATNoe42Lgj2rSOM7EUeJwEQO/K/MVJfffFpC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, '2024-03-04 00:33:12', '2024-03-04 00:37:19'),
(12, 15, 'Rutuparna', 'Panda', 'rutuparna.panda123@yahoo.com', NULL, '$2y$10$NbY2EdfOddbEjMyfgATNoe42Lgj2rSOM7EUeJwEQO/K/MVJfffFpC', NULL, '987123658', '963258916', 6, 'Female', '1999-09-24', 'General', 'Hindu', '9874563217', '2017-11-17', 'dyhogubr9bygaunuubr4.jpg', 'AB+', '5.5', '58', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 0, 1, '2024-03-06 22:29:48', '2024-03-12 06:02:18'),
(13, 16, 'Sanjeeb', 'Das', 'sanjeebdas123@yahoo.com', NULL, '$2y$10$NbY2EdfOddbEjMyfgATNoe42Lgj2rSOM7EUeJwEQO/K/MVJfffFpC', 'bPlImcoJCQHNJB4I9miCfG43VG3CUOaB7lhTmbTebHyjbaaoUx68R0sQE2GO', '987123657', '9632587', 2, 'Male', '1994-07-25', 'General', 'Hindu', '9874563210', '2019-02-04', '0fvv5ltg02qwgjr3p6iy.jpg', 'AB+', '6.3', '78', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 0, 1, '2024-03-06 22:32:15', '2024-03-12 06:04:42'),
(14, 15, 'Prabhudatta', 'Rout', 'prabhudatta.rout123@gmail.com', NULL, '$2y$10$NbY2EdfOddbEjMyfgATNoe42Lgj2rSOM7EUeJwEQO/K/MVJfffFpC', '9MXqL0MqjzIogTDWBZCD9gOAXY8DydDGF0toivarOswWZILgyK1S11noYBCa', '987123650', '9632582', 2, 'Male', '1995-03-18', 'General', 'Hindu', '9874563210', '2020-07-30', 'xp719ko4mg1gk35uncw6.jpg', 'AB-', '6.3', '75', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 0, 0, '2024-03-07 21:26:58', '2024-03-11 04:24:08'),
(15, NULL, 'Sanjay', 'Biswal', 'sanjay.biswal76@yahoo.com', NULL, '$2y$10$NbY2EdfOddbEjMyfgATNoe42Lgj2rSOM7EUeJwEQO/K/MVJfffFpC', 'bWizROZ3BXuLQPDeddQavf4ANggz7ZB5yUmztJcsNZTxLtEzgPsJSwu0AXpy', NULL, NULL, NULL, 'Male', NULL, NULL, NULL, '6340851327', NULL, 'mujvtprocypthaqxb3cw.jpg', NULL, NULL, NULL, 'Math Professor', 'Vivekanada Shiksha Kendra, cspur , Bhubaneswar, Odisha', NULL, NULL, NULL, NULL, NULL, 4, 0, 0, '2024-03-10 22:39:21', '2024-03-12 05:07:06'),
(16, NULL, 'Prative', 'Behera', 'prativa.behera98@gmail.com', NULL, '$2y$10$NbY2EdfOddbEjMyfgATNoe42Lgj2rSOM7EUeJwEQO/K/MVJfffFpC', NULL, NULL, NULL, NULL, 'Female', NULL, NULL, NULL, '9874563213', NULL, 'xg0yfi8wk01btg4cemgf.jpg', NULL, NULL, NULL, 'Professor', 'Odisha, Bhubaneswar', NULL, NULL, NULL, NULL, NULL, 4, 0, 0, '2024-03-10 22:41:27', '2024-03-22 01:27:04'),
(17, NULL, 'Prasant', 'Nayak', 'prasant.nayak123@gmail.com', NULL, '$2y$10$NbY2EdfOddbEjMyfgATNoe42Lgj2rSOM7EUeJwEQO/K/MVJfffFpC', NULL, NULL, NULL, NULL, 'Male', '1982-12-15', NULL, NULL, '9874563213', '2022-06-16', 'mupgwjevi1fxb5hmc05h.jpg', NULL, NULL, NULL, NULL, 'Bhubaneswar, Odisha', 'Married', 'odisha', 'B.com (hons.)', '10 Years+', 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before the final copy is available', 2, 0, 0, '2024-03-11 22:37:19', '2024-03-12 02:03:38'),
(18, NULL, 'Pratiskhya', 'Patel', 'pratiskhya.patel10@yahoo.com', NULL, '$2y$10$NbY2EdfOddbEjMyfgATNoe42Lgj2rSOM7EUeJwEQO/K/MVJfffFpC', 'zpHdsqUZknz1cBJQe4MkHRDj4rZx3ndREtmL7Y7IkhS6LhUeHi9jD00Ft0zo', NULL, NULL, NULL, 'Female', '1995-05-27', NULL, NULL, '9874563218', '2015-01-31', 'd6pjr9puzlvrdfxpoejr.jpg', NULL, NULL, NULL, NULL, 'Angul, Odisha', 'Married', 'Bhubaneswar, Odisha', 'B.com (Hons.)', '8 years+', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.testing', 2, 0, 1, '2024-03-11 22:43:56', '2024-03-12 01:03:04'),
(19, NULL, 'Harmanpet', 'kaur', 'harmanpet.kaur123@yahoo.com', NULL, '$2y$10$NbY2EdfOddbEjMyfgATNoe42Lgj2rSOM7EUeJwEQO/K/MVJfffFpC', 'wL9arK6sn0wpmqPk60IwazWjuAiwqGCceUKQIlPyZcZNmMzZRr7G7artPUud', NULL, NULL, NULL, 'Female', '1991-07-16', NULL, NULL, '9874563217', '2014-07-18', 'g2t89jkznu4hun5sfuha.jpg', NULL, NULL, NULL, NULL, 'Mumbai', 'single', 'Teacher', 'sports', '4yr+', 'testing', 2, 0, 0, '2024-03-12 01:08:37', '2024-03-12 01:08:48');

-- --------------------------------------------------------

--
-- Table structure for table `weeks`
--

CREATE TABLE `weeks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `weeks`
--

INSERT INTO `weeks` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Monday', '2024-03-14 07:14:41', '2024-03-14 07:14:41'),
(2, 'Tuesday', '2024-03-14 07:14:50', '2024-03-14 07:14:50'),
(3, 'Wednesday', '2024-03-14 07:15:00', '2024-03-14 07:15:00'),
(4, 'Thursday', '2024-03-14 07:15:11', '2024-03-14 07:15:11'),
(5, 'Friday', '2024-03-14 07:15:20', '2024-03-14 07:15:20'),
(6, 'Saturday', '2024-03-14 07:14:14', '2024-03-14 07:14:14'),
(7, 'Sunday', '2024-03-14 07:14:14', '2024-03-14 07:14:14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assign_class_teacher`
--
ALTER TABLE `assign_class_teacher`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class_subjects`
--
ALTER TABLE `class_subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class_subject_timetable`
--
ALTER TABLE `class_subject_timetable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam_schedules`
--
ALTER TABLE `exam_schedules`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `weeks`
--
ALTER TABLE `weeks`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assign_class_teacher`
--
ALTER TABLE `assign_class_teacher`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `class_subjects`
--
ALTER TABLE `class_subjects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `class_subject_timetable`
--
ALTER TABLE `class_subject_timetable`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `exam_schedules`
--
ALTER TABLE `exam_schedules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `weeks`
--
ALTER TABLE `weeks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
