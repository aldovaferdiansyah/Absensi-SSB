-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 03, 2025 at 10:06 AM
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
(23, 19, 'Nova Arianto', 'pelatih', 'latihan', '2024-10-01 04:38:54', 'Tepat Waktu', NULL, NULL, '2024-10-01 04:38:54', '2024-10-01 04:38:54'),
(24, 15, 'Harfin Aqbil Falah', 'siswa', 'latihan', '2024-10-01 04:47:00', 'Terlambat', NULL, NULL, '2024-10-01 04:47:00', '2024-10-01 04:47:00'),
(43, 14, 'Aldova Ferdiansyah', 'pelatih', 'latihan', '2024-11-11 17:17:57', 'Tepat Waktu', '2024-11-11 18:00:09', 'Tepat Waktu', '2024-11-11 17:17:57', '2024-11-11 18:00:09'),
(44, 15, 'Harfin Aqbil Falah', 'siswa', 'latihan', '2024-11-11 17:18:41', 'Tepat Waktu', '2024-11-11 18:00:47', 'Tepat Waktu', '2024-11-11 17:18:41', '2024-11-11 18:00:47'),
(45, 18, 'Hari Sukmana', 'siswa', 'latihan', '2024-11-11 17:19:56', 'Tepat Waktu', '2024-11-11 18:01:20', 'Tepat Waktu', '2024-11-11 17:19:56', '2024-11-11 18:01:20'),
(46, 24, 'Supratman Samsudin', 'siswa', 'latihan', '2024-11-11 17:20:12', 'Tepat Waktu', '2024-11-11 18:01:40', 'Tepat Waktu', '2024-11-11 17:20:12', '2024-11-11 18:01:40'),
(47, 19, 'Nova Arianto', 'pelatih', 'latihan', '2024-11-11 17:24:33', 'Tepat Waktu', '2024-11-11 18:06:29', 'Tepat Waktu', '2024-11-11 17:24:33', '2024-11-11 18:06:29'),
(48, 26, 'Komarudin Zaelani', 'pelatih', 'latihan', '2024-11-11 17:25:26', 'Tepat Waktu', '2024-11-11 18:08:39', 'Tepat Waktu', '2024-11-11 17:25:26', '2024-11-11 18:08:39'),
(49, 28, 'Akbar Mulyana', 'siswa', 'latihan', '2024-11-11 17:32:34', 'Terlambat', '2024-11-11 18:02:11', 'Tepat Waktu', '2024-11-11 17:32:34', '2024-11-11 18:02:11'),
(50, 29, 'Insan Ramdani', 'siswa', 'latihan', '2024-11-11 17:33:42', 'Terlambat', '2024-11-11 18:03:33', 'Tepat Waktu', '2024-11-11 17:33:42', '2024-11-11 18:03:33'),
(60, 14, 'Aldova Ferdiansyah', 'pelatih', 'pertandingan', '2024-11-16 13:33:14', 'Tepat Waktu', '2024-11-16 14:13:16', 'Tepat Waktu', '2024-11-16 13:33:14', '2024-11-16 14:13:16'),
(61, 15, 'Harfin Aqbil Falah', 'siswa', 'pertandingan', '2024-11-16 13:34:00', 'Tepat Waktu', '2024-11-16 14:12:20', 'Tepat Waktu', '2024-11-16 13:34:00', '2024-11-16 14:12:20'),
(62, 18, 'Hari Sukmana', 'siswa', 'pertandingan', '2024-11-16 13:34:52', 'Tepat Waktu', '2024-11-16 14:14:12', 'Tepat Waktu', '2024-11-16 13:34:52', '2024-11-16 14:14:12'),
(63, 19, 'Nova Arianto', 'pelatih', 'pertandingan', '2024-11-16 13:35:55', 'Tepat Waktu', '2024-11-16 14:23:20', 'Tepat Waktu', '2024-11-16 13:35:55', '2024-11-16 14:23:20'),
(64, 24, 'Supratman Samsudin', 'siswa', 'pertandingan', '2024-11-16 13:37:27', 'Tepat Waktu', '2024-11-16 14:14:29', 'Tepat Waktu', '2024-11-16 13:37:27', '2024-11-16 14:14:29'),
(66, 25, 'Ahmad Mulyono', 'pelatih', 'pertandingan', '2024-11-16 13:39:33', 'Tepat Waktu', '2024-11-16 14:22:18', 'Tepat Waktu', '2024-11-16 13:39:33', '2024-11-16 14:22:18'),
(67, 29, 'Insan Ramdani', 'siswa', 'pertandingan', '2024-11-16 13:40:27', 'Tepat Waktu', '2024-11-16 14:15:02', 'Tepat Waktu', '2024-11-16 13:40:27', '2024-11-16 14:15:02'),
(68, 30, 'Rafli Mahendra', 'siswa', 'pertandingan', '2024-11-16 13:40:46', 'Tepat Waktu', '2024-11-16 14:15:15', 'Tepat Waktu', '2024-11-16 13:40:46', '2024-11-16 14:15:15'),
(69, 26, 'Komarudin Zaelani', 'pelatih', 'pertandingan', '2024-11-16 13:42:05', 'Tepat Waktu', '2024-11-16 14:21:07', 'Tepat Waktu', '2024-11-16 13:42:05', '2024-11-16 14:21:07'),
(71, 14, 'Aldova Ferdiansyah', 'pelatih', 'latihan', '2024-11-20 06:00:31', 'Tepat Waktu', NULL, NULL, '2024-11-20 06:00:31', '2024-11-20 06:00:31');

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
(43, '2024_09_28_104836_create_pengajuanizins_table', 31),
(44, '2024_11_03_231939_create_password_resets_table', 32),
(45, '2024_11_04_001852_create_password_reset_tokens_table', 33),
(46, '2024_11_07_113342_create_password_resets_table', 34),
(47, '2024_11_07_113721_create_password_resets_table', 35),
(48, '2024_11_07_155113_create_pengajuan_izins_table', 36);

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
(2, 'App\\Models\\User', 24),
(2, 'App\\Models\\User', 28),
(2, 'App\\Models\\User', 29),
(2, 'App\\Models\\User', 30),
(2, 'App\\Models\\User', 36),
(3, 'App\\Models\\User', 14),
(3, 'App\\Models\\User', 19),
(3, 'App\\Models\\User', 25),
(3, 'App\\Models\\User', 26);

-- --------------------------------------------------------

--
-- Table structure for table `pengajuanizins`
--

CREATE TABLE `pengajuanizins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
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

INSERT INTO `pengajuanizins` (`id`, `user_id`, `name`, `role`, `start_date`, `end_date`, `reason`, `type`, `proof`, `status`, `created_at`, `updated_at`) VALUES
(3, 17, 'Andri Sopian', 'siswa', '2024-11-12', '2024-11-12', 'Acara Keluarga Nikahan Kakak', 'pribadi', '1731344962_proof_file.pdf', 'Diterima', '2024-11-11 17:09:22', '2024-11-11 17:09:40'),
(4, 30, 'Rafli Mahendra', 'siswa', '2024-11-12', '2024-11-12', 'Belajar Tambahan Persiapan UAS Sekolah', 'lainnya', '1731345721_proof_image.png', 'Diterima', '2024-11-11 17:22:01', '2024-11-11 17:22:23'),
(5, 25, 'Ahmad Mulyono', 'pelatih', '2024-11-12', '2024-11-12', 'Asam Urat Kambuh', 'sakit', '1731346024_proof_image.png', 'Diterima', '2024-11-11 17:27:04', '2024-11-11 17:28:41'),
(7, 14, 'Aldova Ferdiansyah', 'pelatih', '2024-11-17', '2024-11-17', 'Sakit Asam Lambung', 'sakit', '1731845220_proof_file.pdf', 'Ditolak', '2024-11-17 12:07:00', '2024-11-20 01:55:28'),
(8, 17, 'Andri Sopian', 'siswa', '2024-11-17', '2024-11-17', 'Sakit Engkel Kaki Kanan', 'sakit', '1731845322_proof_file.pdf', 'Ditolak', '2024-11-17 12:08:42', '2024-11-20 02:17:42'),
(9, 17, 'Andri Sopian', 'siswa', '2024-11-20', '2024-11-20', 'Sakit Perut, Asam Lambung naik', 'sakit', '1732081735_proof_image.png', 'Diterima', '2024-11-20 05:48:55', '2024-11-20 05:49:48');

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
(9, 'Latihan', 'Latihan Rutinan Lapang Cihaur B2', '2024-10-01', '11:45:00', '13:45:00', '2024-10-01 04:15:01', '2024-10-01 04:15:42'),
(14, 'Latihan', 'Latihan Rutinan Lapang Siliwangi A1', '2024-11-12', '00:30:00', '01:30:00', '2024-11-11 16:04:39', '2024-11-16 09:03:04'),
(19, 'Pertandingan', 'Pertandingan VS Maung Anom', '2024-11-16', '20:45:00', '21:30:00', '2024-11-16 09:24:59', '2024-11-16 13:12:16'),
(21, 'Latihan', 'Latihan Rutinan Lapang Siliwangi A1', '2024-11-20', '13:15:00', '14:15:00', '2024-11-20 05:55:40', '2024-11-20 05:56:31');

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
(1, 'SSB Roksi FC', 'Lap Univ Nurtanio Bandung', '1732976944.png', 'History', 'Roksi Football Club adalah organisasi dalam bidang olahraga sepakbola yang dibentuk pada tahun 1992, organisasi ini telah resmi menjadi klub salah satu anggota dibawah naungan PSSI (Persatuan Sepakbola Seluruh Indonesia) pada kompetisi divisi 3, lebih tepatnya pada tahun 2011. Roksi FC ditangani oleh pelatih kepala Frans D. Hehakaya atau yang lebih dikenal dengan sebutan Om Franky, beliau merupakan seorang pelatih yang sarat akan pengalaman dalam hal melatih tim sepakbola, mulai dari kategori kelompok usia hingga senior.\r\n\r\nDikalangan para pemain atau pelatih-pelatih sepakbola di Indonesia, beliau ini dikenal sebagai sosok yang disiplin dan bertangan dingin, dikarenakan mampu meramu sebuah tim sepakbola menjadi tim yang dapat diperhitungkan oleh lawan. Om Franky ini dikenal dengan istilah “LAPECHO”, yang dimana setiap tim yang pernah ditangani olehnya pasti akan mengetahui dengan istilah tersebut. Sebagai bentuk kontribusi terhadap persepakbolaan di tanah air ini, sekolah sepak bola Roksi FC focus terhadap pembinaan usia dini untuk dapat mencetak pemain-pemain handal, yang nantinya dapat diharapkan untuk membela tim nasional Indonesia dikemudian hari.', NULL, '2024-11-30 14:29:04');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status_user` varchar(255) NOT NULL,
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

INSERT INTO `users` (`id`, `name`, `email`, `password`, `status_user`, `gender`, `date_of_birth`, `age_group_category`, `phone_number`, `parents_name`, `parents_telephone_number`, `address`, `coach_category`, `age_group_coach_category`, `photo`, `qr_code`, `created_at`, `updated_at`) VALUES
(1, 'Admin SSB Roksi FC', 'adminssbroksifc12@gmail.com', '$2y$12$aLbXgx2H/HUAHDLKMZHLmOGlSxeQUSyqiExfZ56ETc1c4dhZJ0lSO', 'Aktif', 'Laki-laki', '2000-01-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-09-03 04:25:04', '2024-11-30 14:30:56'),
(14, 'Aldova Ferdiansyah', 'aldovaferdiansyah12@gmail.com', '$2y$12$iu7k.8rhmJ.XDq8hco0/BOm5IHGNxQqlzX5z5mBRCel.qUcabmQZK', 'Aktif', 'Laki-laki', '2002-10-23', NULL, '081222818994', NULL, NULL, 'Kp. Ciburial Mekar RT 02 RW 07, Desa Margajaya Kec. Ngamprah', 'Pelatih Kepala', 'U-16', 'foto_pelatih/673221806d67d.jpg', '382147c9-8b2e-48ce-8bcb-f828a8970c8c', '2024-09-09 07:55:46', '2024-11-20 02:23:00'),
(15, 'Harfin Aqbil Falah', 'harfinaqbil@gmail.com', '$2y$12$vSde8DY/uZacn.CdlDxiDenkiY3zn/TbcIyCQUfse0oKixbND.E8W', 'Tidak Aktif', 'Laki-laki', '2024-09-08', 'U-16', '087804824803', 'dada', '0878048248908', 'Jl. Cijeungjing, Rt 02 / Rw 23', NULL, NULL, 'foto_siswa/66deaa3501b94.png', '1ec93f17-f233-4e00-8823-d7b8d142ca97', '2024-09-09 07:56:37', '2024-11-20 05:52:43'),
(17, 'Andri Sopian', 'andrisopian13@gmail.com', '$2y$12$J6DaiStH0rqE5BHeYO8POeA1R5WAWywo1H9tWxc/Z3CXzwOiOe3yK', 'Aktif', 'Laki-laki', '2024-09-09', 'U-21', '0878048248908', 'dada', '0878048248908', 'Kp. Ciburial Mekar RT 02 RW 07, Desa Margajaya Kec.Ngamprah', NULL, NULL, 'foto_siswa/66deb6b4a39c2.png', '59c21bf0-5d35-4d52-a866-083446b6adf8', '2024-09-09 08:49:56', '2024-11-20 05:48:13'),
(18, 'Hari Sukmana', 'harisukmana14@gmail.com', '$2y$12$RwQN0Hh5apKMGtWsuw9M4.2yskji5QzHBTD87fAj.UtmY.JL0cdIi', 'Aktif', 'Laki-laki', '2006-07-19', 'U-19', '087848248908', 'dada', '0878048248908', 'Jl. Cijeungjing, Rt 02 / Rw 23', NULL, NULL, 'foto_siswa/66f52a799e975.jpg', '591a479c-7ce0-4259-9156-3d6ac5e515d0', '2024-09-09 09:15:02', '2024-09-26 09:33:45'),
(19, 'Nova Arianto', 'novaarianto12@gmail.com', '$2y$12$X1.RgPYjXwWrDQEa9RsgWuW6CyVst7i2/7r4kyzzT3b87bx13FTZC', 'Aktif', 'Laki-laki', '1995-11-16', NULL, '0867127367261', NULL, NULL, 'Bandung', 'Pelatih Kepala', 'U-19', 'foto_pelatih/66e2b5c6c3aa7.jpg', '0ea90db9-689b-4dc5-8ec7-8931f0faa8f5', '2024-09-12 09:35:06', '2024-10-04 14:15:50'),
(24, 'Supratman Samsudin', 'supratman17@gmail.com', '$2y$12$kfkOh9J8c0d7DgFZB29hGOvzOMqocqbLrN5g2lWhJWwVc0r5LEgJW', 'Aktif', 'Laki-laki', '2004-07-22', 'U-21', '081273672137', 'Sulaiman Baharudin', '0813448297777', 'Kp. Ciburial Mekar RT 07 RW 16 Desa Margajaya Kec.Ngamprah', NULL, NULL, 'foto_siswa/6727c4534b1c2.jpg', '5aa270f5-5214-4b87-a735-5bcf61eee9a1', '2024-11-03 18:43:31', '2024-11-11 15:34:06'),
(25, 'Ahmad Mulyono', 'ahmadmulyono19@gmail.com', '$2y$12$QzU6H68pudJxXFQwd3RaweAVVRiKghzpOqsHq0K3alrFIjp6dFL92', 'Aktif', 'Laki-laki', '1995-07-11', NULL, '0867127363521', NULL, NULL, 'Kp. SukaKaya RT 01 RW 16 Desa Makmur Kec.Suryakencana', 'Pelatih Kepala', 'U-21', 'foto_pelatih/67321fcde2938.jpg', '86063e1b-b846-4da4-9558-ede4e5931539', '2024-11-11 15:16:33', '2024-11-16 09:38:56'),
(26, 'Komarudin Zaelani', 'komarudin90@gmail.com', '$2y$12$d22mrwX5d7cqa.hSmiPR/OKsdVXPiC6179Uwqbm3l1T/.NMnIpGBG', 'Aktif', 'Laki-laki', '1985-03-21', NULL, '082489458012', NULL, NULL, 'Kp. Kencana RT 03 RW 12, Desa Jayamaju Kec. Ketambun', 'Pelatih Kepala', 'U-23', 'foto_pelatih/6732211200c65.jpg', 'e4a7be06-7221-417d-a0ac-1e4a6a2b5f93', '2024-11-11 15:20:52', '2024-12-18 07:02:55'),
(28, 'Akbar Mulyana', 'akbarmulyana15@gmail.com', '$2y$12$MOXASCeHhTPgmRXU9CDN2eZ6EAoZHXJNttaY6.b8.4zT/hxz4mvvW', 'Aktif', 'Laki-laki', '2004-07-22', 'U-23', '0867127427779', 'Saepul Anwar Baharudin', '0812779393572', 'Kp. Cahayamakmur RT 09 RW 13, Desa Kermata Kec. Jayadiri', NULL, NULL, 'foto_siswa/673223c2804a4.jpg', 'c9ad1bfc-dbaf-4491-b511-81b411c07d10', '2024-11-11 15:33:23', '2024-12-18 07:05:50'),
(29, 'Insan Ramdani', 'insanramdani17@gmail.com', '$2y$12$SBYhTB8GKrrZwOQAHSwECuto.UDyUU/g7aonijPozb8TNXGOhwQn.', 'Aktif', 'Laki-laki', '2002-03-14', 'U-23', '081255817772', 'Asepudin Anwarudin', '0815334297853', 'Kp. Ciburial Mekar RT 01 RW 16 Desa Margajaya Kec.Ngamprah', NULL, NULL, 'foto_siswa/6732249e16c07.jpg', '682b1aad-7e87-484e-a5ca-5089b8b8f404', '2024-11-11 15:37:02', '2024-12-18 07:07:00'),
(30, 'Rafli Mahendra', 'raflimahendra20@gmail.com', '$2y$12$qUr4xaCg9YySYHhd9RrSE.erLdLYu1mH9SdAikYd.IWMdRlx5uOVK', 'Aktif', 'Laki-laki', '2006-07-30', 'U-19', '085614746826', 'Mulyadi Sulaimansyah', '081233677967', 'Kp. Ciburial Mekar RT 02 RW 07 Desa Margajaya Kec.Ngamprah', NULL, NULL, 'foto_siswa/673225fa9bba0.jpg', '4aed6ff5-3fb2-4ba7-9394-13dfb20bbeab', '2024-11-11 15:42:51', '2024-11-16 03:03:32'),
(36, 'Zaelani Munawar', 'zaelanimunawar14@gmail.com', '$2y$12$0dcHL96IBMSC0mPLD0TbKuIxW8xNpi1yKkZyEQHQKxgu.ilh8RtP6', 'Aktif', 'Laki-laki', '2007-06-13', 'U-19', '081333818774', 'Akbar Munawar', '081266699767', 'Kp. Cijeungjing RT 03 RW 16', NULL, NULL, 'foto_siswa/6772339b5c177.jpg', 'a4d857ef-cfaa-4185-8ce2-460ede1b65dc', '2024-12-30 05:46:07', '2024-12-30 05:46:07');

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengajuanizins_user_id_foreign` (`user_id`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `pengajuanizins`
--
ALTER TABLE `pengajuanizins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `settingsprofiles`
--
ALTER TABLE `settingsprofiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

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

--
-- Constraints for table `pengajuanizins`
--
ALTER TABLE `pengajuanizins`
  ADD CONSTRAINT `pengajuanizins_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
