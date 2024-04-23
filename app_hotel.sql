-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 23, 2024 at 06:09 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `app_hotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `hotel_id` bigint UNSIGNED NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `guests` int NOT NULL,
  `status` enum('Check-in','Check-out') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Check-in',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `hotel_id`, `check_in`, `check_out`, `guests`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 3, '2024-04-25', '2024-04-26', 2, 'Check-out', '2024-04-23 10:41:53', '2024-04-23 10:45:22'),
(2, 2, 1, '2024-04-24', '2024-04-25', 1, 'Check-out', '2024-04-23 10:47:19', '2024-04-23 10:52:08'),
(3, 2, 1, '2024-04-24', '2024-04-25', 1, 'Check-out', '2024-04-23 10:51:53', '2024-04-23 10:52:10'),
(4, 2, 1, '2024-04-24', '2024-04-25', 1, 'Check-out', '2024-04-23 11:05:06', '2024-04-23 11:05:18');

--
-- Triggers `bookings`
--
DELIMITER $$
CREATE TRIGGER `update_totalKamar_after_booking` AFTER INSERT ON `bookings` FOR EACH ROW BEGIN
    IF NEW.status = 'Check-in' THEN
        UPDATE hotels
        SET totalKamar = totalKamar - 1
        WHERE id = NEW.hotel_id;
    ELSEIF NEW.status = 'Check-out' THEN
        UPDATE hotels
        SET totalKamar = totalKamar + 1
        WHERE id = NEW.hotel_id;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hotels`
--

CREATE TABLE `hotels` (
  `id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fasilitas` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` decimal(8,2) NOT NULL,
  `totalKamar` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hotels`
--

INSERT INTO `hotels` (`id`, `category_id`, `nama`, `gambar`, `fasilitas`, `deskripsi`, `harga`, `totalKamar`, `created_at`, `updated_at`) VALUES
(1, 3, 'CitySleep Inn', '1713892471.jpg', 'Tempat tidur single double dengan linen bersih\r\nKamar mandi pribadi dengan shower\r\nWi-Fi gratis\r\nAC\r\nLayanan penyewaan handuk dan perlengkapan mandi tambahan (dengan biaya tambahan)', 'CitySleep Inn adalah pilihan ideal untuk pelancong yang mencari akomodasi terjangkau namun nyaman. Dengan lokasi strategis di pusat kota, hotel ini menawarkan kamar-kamar yang bersih dan fungsional untuk istirahat malam yang baik setelah menjelajahi kota.', '135000.00', 2, '2024-04-23 10:14:31', '2024-04-23 11:05:18'),
(2, 4, 'Artisan Oasis Hotel', '1713892741.jpg', 'Kamar-kamar berdesain unik dengan perabotan berkualitas tinggi\r\nLayanan concierge untuk membantu rencana perjalanan dan reservasi\r\nRestoran boutique dengan menu khas dan atmosfer yang intim\r\nArea lounge yang nyaman untuk bersantai dan bersosialisasi\r\nLayanan pijat dan spa (dengan biaya tambahan)', 'Artisan Oasis Hotel adalah tempat menginap yang cocok untuk pelancong yang menghargai nuansa unik dan gaya yang elegan. Dengan dekorasi yang menawan dan suasana yang tenang, hotel ini menawarkan pengalaman menginap yang berbeda dari yang lain.', '180000.00', 6, '2024-04-23 10:19:01', '2024-04-23 10:19:01'),
(3, 6, 'Executive Heights Hotel', '1713892914.jpg', '- Ruang pertemuan dan fasilitas konferensi lengkap\r\n- Pusat bisnis dengan layanan kopi dan printer\r\n- Akses internet Wi-Fi yang cepat dan stabil di seluruh area hotel\r\nLayanan kamar 24 jam\r\n- Gym dan kolam renang untuk menjaga kebugaran dan relaksasi', 'Executive Heights Hotel adalah pilihan yang sempurna bagi pelancong bisnis yang menginginkan kenyamanan dan fasilitas modern selama perjalanan mereka. Dengan lokasi strategis di pusat bisnis, hotel ini menyediakan segala yang dibutuhkan para profesional untuk mengadakan pertemuan atau bersantai setelah hari yang sibuk.', '255000.00', 2, '2024-04-23 10:21:54', '2024-04-23 10:21:54'),
(4, 3, 'Grand Luxe Palace', '1713893076.jpg', 'Suite dan villa mewah dengan pemandangan yang menakjubkan\r\n- Layanan concierge pribadi untuk memenuhi setiap kebutuhan tamu\r\n- Restoran bintang Michelin dengan menu kreatif dari koki terkenal\r\n- Spa mewah dengan berbagai perawatan dan layanan\r\n- Layanan butler pribadi untuk kenyamanan maksimal', 'Grand Luxe Palace adalah ikon kemewahan dan kemegahan dalam dunia perhotelan. Dengan arsitektur megah, layanan yang sangat personal, dan fasilitas mewah, hotel ini memanjakan setiap tamu untuk pengalaman menginap yang tak terlupakan.', '750000.00', 3, '2024-04-23 10:24:36', '2024-04-23 10:24:53');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_hotels`
--

CREATE TABLE `kategori_hotels` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kapasitas` int DEFAULT NULL,
  `bed` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategori_hotels`
--

INSERT INTO `kategori_hotels` (`id`, `name`, `gambar`, `size`, `kapasitas`, `bed`, `created_at`, `updated_at`) VALUES
(3, 'Budget Hotel', '1713891547.jpg', '9m', 2, 'Double bed', '2024-04-23 09:59:07', '2024-04-23 09:59:07'),
(4, 'Boutique Hotel', '1713891611.jpg', '16m', 3, 'Queen bed', '2024-04-23 10:00:11', '2024-04-23 10:00:11'),
(6, 'Bussines Hotel', '1713891796.jpg', '25m', 5, 'King bed', '2024-04-23 10:03:16', '2024-04-23 10:03:16'),
(7, 'Luxury Hotel', '1713891840.jpg', '36', 6, 'Super King bed', '2024-04-23 10:04:00', '2024-04-23 10:04:00');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_04_23_070629_create_kategori_hotels_table', 1),
(6, '2024_04_23_074200_create_hotels_table', 1),
(7, '2024_04_23_115154_create_bookings_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('admin','user') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `phone`, `role`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@material.com', '2024-04-23 09:50:41', NULL, 'admin', '$2y$12$IAopDRR3axuc4PWln9moOuyh3Eg6u3Mrk25cft3ocETTljPASgMy2', 'R90VyxNabPsVGq0IPZkoRLBdjkr4fFxmAOdSGILgBPWLDVU44vU0QzFrJEPU', '2024-04-23 09:50:42', '2024-04-23 09:50:42'),
(2, 'SALWA ADIA Z', 'salwaadiazahraa@gmail.com', NULL, '083803246357', 'user', '$2y$12$sESPemlT9cE4byXH6CT0z.0ERTFdtSXkB9LLaAj0ajwLuWLvybMky', NULL, '2024-04-23 10:37:21', '2024-04-23 10:37:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bookings_user_id_foreign` (`user_id`),
  ADD KEY `bookings_hotel_id_foreign` (`hotel_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `hotels`
--
ALTER TABLE `hotels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hotels_category_id_foreign` (`category_id`);

--
-- Indexes for table `kategori_hotels`
--
ALTER TABLE `kategori_hotels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

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
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hotels`
--
ALTER TABLE `hotels`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kategori_hotels`
--
ALTER TABLE `kategori_hotels`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_hotel_id_foreign` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`id`),
  ADD CONSTRAINT `bookings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `hotels`
--
ALTER TABLE `hotels`
  ADD CONSTRAINT `hotels_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `kategori_hotels` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
