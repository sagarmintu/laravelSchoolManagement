-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 07, 2024 at 11:06 AM
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
(6, 'Oriya', 0, 0, 1, '2024-03-05 04:33:51', '2024-03-05 04:33:51');

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
(12, 2, 4, 1, 0, 1, '2024-03-06 01:53:00', '2024-03-06 01:53:00'),
(13, 2, 1, 1, 0, 1, '2024-03-06 01:53:00', '2024-03-06 03:41:17'),
(14, 2, 5, 1, 0, 0, '2024-03-06 01:53:00', '2024-03-06 03:39:04'),
(15, 6, 2, 1, 0, 0, '2024-03-06 01:53:12', '2024-03-06 01:53:12'),
(16, 6, 4, 1, 0, 0, '2024-03-06 01:53:12', '2024-03-06 01:53:12'),
(17, 6, 1, 1, 0, 0, '2024-03-06 01:53:12', '2024-03-06 03:41:10'),
(18, 6, 5, 1, 0, 1, '2024-03-06 01:53:12', '2024-03-06 03:41:28');

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
(11, '2024_03_06_034600_create_class_subjects_table', 8);

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
(5, 'Magnetism And Matter', 'Practical', 1, 0, 0, '2024-03-06 00:05:17', '2024-03-06 00:05:17');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
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
  `user_type` tinyint(4) NOT NULL DEFAULT 3 COMMENT '1:admin, 2:teacher, 3:student, 4:parent',
  `is_delete` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0:not deleted, 1:deleted',
  `status` tinyint(4) DEFAULT 0 COMMENT '0:active, 1:inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `last_name`, `email`, `email_verified_at`, `password`, `remember_token`, `admission_number`, `roll_number`, `class_id`, `gender`, `date_of_birth`, `caste`, `religion`, `mobile_number`, `admission_date`, `profile_picture`, `blood_group`, `height`, `weight`, `user_type`, `is_delete`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Admin', NULL, 'admin@gmail.com', NULL, '$2y$10$Es7odPG7xoX73G3GBHaaUOOsG8gVWRB8VeUKevgs8oLeCgHR1MCDC', 'dmF7CU0nCzjuThGNxbD0fwYGqDIcYqZPM6rpgnjTUPQRDTpBemrDkpLIwcdA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, '2024-02-28 11:13:57', '2024-03-06 04:13:27'),
(2, 'Teacher', NULL, 'teacher@gmail.com', NULL, '$2y$10$pC0eMecp6P/czLiu/RZjUeMlGMQ3IhocM2qvnnyqvGkH6cttX3YfG', 'm3m2Fj9ZWERrdT6y2AtDFlwwh2fJy2GUWD11gBTsY5KgoJnG53UPcF8sE9Tl', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 0, 0, '2024-02-29 11:13:57', '2024-03-06 04:15:24'),
(3, 'Student', NULL, 'student@gmail.com', NULL, '$2y$10$XoXmGJ7YTQuGGqRaVPTHPe4tr3NTb3Nnu3i.sqCZGYzkfvdRwcf22', 'Tu7kPpbZH32vJrlYXTnh0HvVKt8LoUThyiuLK63vMQlGzfp0bStlfikW5cgU', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 0, 0, '2024-02-29 11:13:57', '2024-02-29 11:13:57'),
(4, 'Parent', NULL, 'parent@gmail.com', NULL, '$2y$10$XoXmGJ7YTQuGGqRaVPTHPe4tr3NTb3Nnu3i.sqCZGYzkfvdRwcf22', 'HonpyUPSwORP7epDyrXThFF8vutBW7XEfNLQ7qb0iIs73bl0lSt6znV8kQLi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, 0, 0, '2024-02-29 11:13:57', '2024-02-29 11:13:57'),
(5, 'Sagar Behera', NULL, 'sagarkumar@ralecon.com', NULL, '$2y$10$dMYDQcKhcLRRLpC3qVPP7OzgQ4Bqpax2cuIXaTqSuV5/rILJqcRey', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, '2024-03-01 01:01:22', '2024-03-03 23:14:12'),
(6, 'demo', NULL, 'demo@gmail.com', NULL, '$2y$10$dMYDQcKhcLRRLpC3qVPP7OzgQ4Bqpax2cuIXaTqSuV5/rILJqcRey', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, '2024-03-04 04:48:23', '2024-03-03 23:23:59'),
(7, 'kathiravan  v', NULL, 'kathir@ralecon.com', NULL, '$2y$10$NbY2EdfOddbEjMyfgATNoe42Lgj2rSOM7EUeJwEQO/K/MVJfffFpC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, '2024-03-04 00:33:12', '2024-03-04 00:37:19'),
(12, 'Rutuparna', 'Panda', 'rutuparna.panda123@yahoo.com', NULL, 'sagarmintu@123', NULL, '987123658', '963258916', 6, 'Female', '1999-09-24', 'General', 'Hindu', '9874563217', '2017-11-17', 'dyhogubr9bygaunuubr4.jpg', 'AB+', '5.5', '58', 3, 0, 1, '2024-03-06 22:29:48', '2024-03-07 02:03:31'),
(13, 'Sanjeeb', 'Das', 'sanjeebdas123@yahoo.com', NULL, 'sagarmintu@123', NULL, '987123657', '9632587', 2, 'Male', '1994-07-25', 'General', '', '9874563218', '2019-02-04', 's28aggazwpidzynbuwi0.jpg', 'B+', '6.0', '75', 3, 1, 1, '2024-03-06 22:32:15', '2024-03-07 02:09:45');

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `class_subjects`
--
ALTER TABLE `class_subjects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

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
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
