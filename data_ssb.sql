-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 01, 2024 at 06:51 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `data_ssb`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `type` enum('latihan','pertandingan') NOT NULL,
  `arrival_at` timestamp NULL DEFAULT NULL,
  `status_arrival` varchar(255) DEFAULT NULL,
  `departure_at` timestamp NULL DEFAULT NULL,
  `status_departure` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attendances`
--

INSERT INTO `attendances` (`id`, `user_id`, `name`, `role`, `type`, `arrival_at`, `status_arrival`, `departure_at`, `status_departure`, `created_at`, `updated_at`) VALUES
(10, 14, 'Aldova Ferdiansyah', 'pelatih', 'latihan', '2024-09-24 08:17:35', 'Tepat Waktu', '2024-09-24 10:14:04', 'Tepat Waktu', '2024-09-24 08:17:35', '2024-09-24 10:14:04'),
(14, 17, 'Andri Sopian', 'siswa', 'latihan', '2024-09-24 08:40:09', 'Terlambat', '2024-09-24 10:14:56', 'Tepat Waktu', '2024-09-24 08:40:09', '2024-09-24 10:14:56'),
(16, 17, 'Andri Sopian', 'siswa', 'latihan', '2024-09-25 08:37:24', 'Tepat Waktu', NULL, NULL, '2024-09-25 08:37:24', '2024-09-25 08:37:24'),
(18, 14, 'Aldova Ferdiansyah', 'pelatih', 'latihan', '2024-09-25 08:47:03', 'Tepat Waktu', NULL, NULL, '2024-09-25 08:47:03', '2024-09-25 08:47:03'),
(20, 14, 'Aldova Ferdiansyah', 'pelatih', 'latihan', '2024-10-01 04:30:11', 'Tepat Waktu', NULL, NULL, '2024-10-01 04:30:11', '2024-10-01 04:30:11'),
(21, 17, 'Andri Sopian', 'siswa', 'latihan', '2024-10-01 04:31:56', 'Tepat Waktu', NULL, NULL, '2024-10-01 04:31:56', '2024-10-01 04:31:56'),
(22, 21, 'Debrianto Firmansyah', 'pelatih', 'latihan', '2024-10-01 04:37:53', 'Tepat Waktu', NULL, NULL, '2024-10-01 04:37:53', '2024-10-01 04:37:53'),
(23, 19, 'Nova Arianto', 'pelatih', 'latihan', '2024-10-01 04:38:54', 'Tepat Waktu', NULL, NULL, '2024-10-01 04:38:54', '2024-10-01 04:38:54'),
(24, 15, 'Harfin Aqbil Falah', 'siswa', 'latihan', '2024-10-01 04:47:00', 'Terlambat', NULL, NULL, '2024-10-01 04:47:00', '2024-10-01 04:47:00');

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
(6, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(7, '2024_08_07_023923_create_qr_codes_table', 1),
(8, '2024_08_07_060604_create_students_table', 1),
(12, '2024_08_09_070235_create_attendances_table', 2),
(13, '2024_08_12_034735_create_tbl_pelatih', 2),
(14, '2024_08_13_040552_create_pertandingan_table', 2),
(15, '2024_08_15_035535_create_pengajuanizins_table', 3),
(16, '2024_08_15_070054_create_users_table', 4),
(17, '2024_08_15_070915_create_permission_tables', 5),
(18, '2024_08_16_094230_create_model_has_permissions_table', 6),
(19, '2024_08_16_094614_create_role_has_permissions_table', 7),
(20, '2024_08_19_024022_create_models_has_permission', 8),
(21, '2024_08_19_031710_create_permission_table', 9),
(22, '2024_08_19_034808_create_model_has_roles_table', 10),
(23, '2024_08_19_040428_create_model_has_permission_table', 11),
(24, '2024_08_19_042541_create_model_has_permission_table', 12),
(25, '2024_08_20_024602_create_schedules_table', 13),
(26, '2024_08_20_073811_create_scanner_schedules_table', 14),
(27, '2024_08_21_101658_create_scanner_schedules_table', 15),
(28, '2024_08_22_093731_create_tbl_pelatih', 16),
(29, '2024_08_29_103522_create_users_table', 17),
(30, '2024_09_02_090040_create_setting_profiles_table', 18),
(31, '2024_09_02_093106_create_pengajuanizins_table', 19),
(32, '2024_09_02_114900_create_pengajuanizins_table', 20),
(33, '2024_09_02_145406_create_notifications_table', 21),
(34, '2024_09_03_090443_create_information_table', 22),
(35, '2024_09_03_111126_create_users_table', 23),
(36, '2024_09_05_091712_create_attendances_table', 24),
(37, '2024_09_05_104139_create_attendances_table', 25),
(38, '2024_09_05_112242_create_attendances_table', 26),
(39, '2024_09_05_114259_create_attendances_table', 27),
(40, '2024_09_21_213303_create_schedules_table', 28),
(41, '2024_09_23_121340_create_schedules_table', 29),
(42, '2024_09_24_132959_create_attendances_table', 30),
(43, '2024_09_28_104836_create_pengajuanizins_table', 31);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 3),
(2, 'App\\Models\\User', 15),
(2, 'App\\Models\\User', 17),
(2, 'App\\Models\\User', 18),
(2, 'App\\Models\\User', 30),
(3, 'App\\Models\\User', 14),
(3, 'App\\Models\\User', 16),
(3, 'App\\Models\\User', 19),
(3, 'App\\Models\\User', 21),
(3, 'App\\Models\\User', 31);

-- --------------------------------------------------------

--
-- Table structure for table `pengajuanizins`
--

CREATE TABLE `pengajuanizins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `reason` text NOT NULL,
  `type` varchar(255) NOT NULL,
  `proof` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengajuanizins`
--

INSERT INTO `pengajuanizins` (`id`, `name`, `role`, `start_date`, `end_date`, `reason`, `type`, `proof`, `status`, `created_at`, `updated_at`) VALUES
(12, 'Hari Sukmana', 'siswa', '2024-10-01', '2024-10-01', 'Sakit Demam', 'sakit', '1727757334_proof_file.pdf', 'Diterima', '2024-10-01 04:35:34', '2024-10-01 04:36:01');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2024-08-15 00:18:17', '2024-08-15 00:18:17'),
(2, 'siswa', 'web', '2024-08-15 00:18:17', '2024-08-15 00:18:17'),
(3, 'pelatih', 'web', '2024-08-15 00:18:17', '2024-08-15 00:18:17');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `date` date NOT NULL,
  `time_start` time NOT NULL,
  `time_end` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`id`, `title`, `description`, `date`, `time_start`, `time_end`, `created_at`, `updated_at`) VALUES
(1, 'Latihan', 'Latihan Rutinan Lapang Siliwangi A3', '2024-09-24', '15:10:00', '17:14:00', '2024-09-23 05:45:32', '2024-09-24 10:12:36'),
(6, 'Pertandingan', 'VS SS Maninjau, Lapang Siliwangi A1', '2024-09-29', '15:00:00', '17:00:00', '2024-09-23 12:16:30', '2024-09-24 05:54:28'),
(8, 'Latihan', 'Latihan Rutinan Lapang Siliwangi A1', '2024-09-25', '15:30:00', '17:30:00', '2024-09-25 08:28:22', '2024-09-25 08:28:22'),
(9, 'Latihan', 'Latihan Rutinan Lapang Cihaur B2', '2024-10-01', '11:45:00', '13:45:00', '2024-10-01 04:15:01', '2024-10-01 04:15:42');

-- --------------------------------------------------------

--
-- Table structure for table `settingsprofiles`
--

CREATE TABLE `settingsprofiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_SSB` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `logo_SSB` varchar(255) DEFAULT NULL,
  `profile_title` varchar(255) DEFAULT NULL,
  `profile_content` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settingsprofiles`
--

INSERT INTO `settingsprofiles` (`id`, `nama_SSB`, `alamat`, `logo_SSB`, `profile_title`, `profile_content`, `created_at`, `updated_at`) VALUES
(1, 'SSB Persib', 'Stadion Persib, Jl. A. Yani No.262, Bandung', '1725424988.png', 'History', 'Lorem ipsum odor amet, consectetuer adipiscing elit. Ad nulla gravida dapibus sapien maecenas vel proin lectus. Sagittis justo nisi; scelerisque dignissim fames imperdiet. Rutrum litora ornare ac curabitur mollis per taciti taciti. Suspendisse vel facilisis phasellus blandit sodales vivamus. Tempor interdum pellentesque ad dui mauris.\r\n\r\nImperdiet eu at placerat eget habitant dignissim congue; feugiat quis. Amet senectus curabitur; id parturient tellus scelerisque ligula. Etiam ante at nam placerat facilisi; dui molestie. Rutrum facilisi tortor inceptos sapien faucibus luctus orci. Ac magnis neque posuere in condimentum. Porta tellus dignissim porta leo parturient. Dapibus ante magnis luctus vulputate mattis nostra turpis. Potenti augue dis arcu sociosqu habitasse lacinia adipiscing felis. Eleifend phasellus metus cursus elit pellentesque etiam mattis.', NULL, '2024-09-09 08:06:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` enum('Laki-laki','Perempuan') NOT NULL,
  `date_of_birth` date NOT NULL,
  `age_group_category` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `parents_name` varchar(255) DEFAULT NULL,
  `parents_telephone_number` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `coach_category` varchar(255) DEFAULT NULL,
  `age_group_coach_category` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `qr_code` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `gender`, `date_of_birth`, `age_group_category`, `phone_number`, `parents_name`, `parents_telephone_number`, `address`, `coach_category`, `age_group_coach_category`, `photo`, `qr_code`, `created_at`, `updated_at`) VALUES
(1, 'Admin Akademi Persib', 'adminpersib1933@gmail.com', '$2y$12$7tjfd8NH.S6g1iqPxxnww.79K4IRUGKgUcXfCxOgJuPGk5SbewuHq', 'Laki-laki', '2000-01-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-09-03 04:25:04', '2024-10-01 03:29:40'),
(14, 'Aldova Ferdiansyah', 'aldovaferdiansyah12@gmail.com', '$2y$12$l5yiIsA71RSKcKor0FdIleDsmWTgsnzaardWV1Wpbsqv7Rpi/stji', 'Laki-laki', '2002-10-23', NULL, '081222818994', NULL, NULL, 'Kp. Ciburial Mekar RT 02/ RW 07 Desa Margajaya Kec. Ngamprah', 'Pelatih Kepala', 'U-16', 'foto_pelatih/66f4c4102124c.png', '382147c9-8b2e-48ce-8bcb-f828a8970c8c', '2024-09-09 07:55:46', '2024-09-26 06:25:04'),
(15, 'Harfin Aqbil Falah', 'harfinaqbil@gmail.com', '$2y$12$vSde8DY/uZacn.CdlDxiDenkiY3zn/TbcIyCQUfse0oKixbND.E8W', 'Laki-laki', '2024-09-08', 'U-16', '087804824803', 'dada', '0878048248908', 'Jl. Cijeungjing, Rt 02 / Rw 23', NULL, NULL, 'foto_siswa/66deaa3501b94.png', '1ec93f17-f233-4e00-8823-d7b8d142ca97', '2024-09-09 07:56:37', '2024-09-09 07:56:37'),
(16, 'Tatang', 'tatang@gmail.com', '$2y$12$.WXkPnotW79Ic7RgUWS2E.GR9dlfJEiEKie43GIVKVk8SaCeUjp..', 'Laki-laki', '2024-09-09', NULL, '087804824803', NULL, NULL, 'Jl. Cijeungjing, Rt 02 / Rw 23', 'Asisten Pelatih', 'U-16', 'foto_pelatih/66deb658e6988.png', 'e7face45-451f-43e3-932c-49ac4d2f1750', '2024-09-09 08:48:25', '2024-09-09 08:48:25'),
(17, 'Andri Sopian', 'andrisopian13@gmail.com', '$2y$12$ZtqEYXXsANsJ3nuc5XjhA.Vh2GFicMjeY5ya2fG/Fkh5TauIIhKwm', 'Laki-laki', '2024-09-09', 'U-21', '0878048248908', 'dada', '0878048248908', 'Jl. Cijeungjing, Rt 02 / Rw 23', NULL, NULL, 'foto_siswa/66deb6b4a39c2.png', '59c21bf0-5d35-4d52-a866-083446b6adf8', '2024-09-09 08:49:56', '2024-09-13 01:40:22'),
(18, 'Hari Sukmana', 'harisukmana14@gmail.com', '$2y$12$RwQN0Hh5apKMGtWsuw9M4.2yskji5QzHBTD87fAj.UtmY.JL0cdIi', 'Laki-laki', '2006-07-19', 'U-19', '087848248908', 'dada', '0878048248908', 'Jl. Cijeungjing, Rt 02 / Rw 23', NULL, NULL, 'foto_siswa/66f52a799e975.jpg', '591a479c-7ce0-4259-9156-3d6ac5e515d0', '2024-09-09 09:15:02', '2024-09-26 09:33:45'),
(19, 'Nova Arianto', 'novaarianto12@gmail.com', '$2y$12$X1.RgPYjXwWrDQEa9RsgWuW6CyVst7i2/7r4kyzzT3b87bx13FTZC', 'Laki-laki', '1995-11-16', NULL, '0867127367261', NULL, NULL, 'Bandung', 'Pelatih Kepala', 'U-19', 'foto_pelatih/66e2b5c6c3aa7.jpg', '0ea90db9-689b-4dc5-8ec7-8931f0faa8f5', '2024-09-12 09:35:06', '2024-09-12 09:35:06'),
(21, 'Debrianto Firmansyah', 'debriantofirmansyah15@gmail.com', '$2y$12$/lc13D2DkDKJuL3xstHNAeUhjFiyg7XH1rm7xgg.gzrJM6tIyXb3O', 'Laki-laki', '2000-07-26', NULL, '0812736721', NULL, NULL, 'Bandung', 'Pelatih Kiper', 'U-16', 'foto_pelatih/66f52a1eee8a8.jpg', 'a2a40dac-978b-454d-888b-6cf6ceb430f0', '2024-09-26 02:16:00', '2024-09-26 09:32:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attendances_user_id_foreign` (`user_id`);

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
  ADD KEY `model_has_permissions_model_type_model_id_index` (`model_type`,`model_id`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_type_model_id_index` (`model_type`,`model_id`);

--
-- Indexes for table `pengajuanizins`
--
ALTER TABLE `pengajuanizins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settingsprofiles`
--
ALTER TABLE `settingsprofiles`
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
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `pengajuanizins`
--
ALTER TABLE `pengajuanizins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `settingsprofiles`
--
ALTER TABLE `settingsprofiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendances`
--
ALTER TABLE `attendances`
  ADD CONSTRAINT `attendances_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
