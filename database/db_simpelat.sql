-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 20, 2022 at 08:09 AM
-- Server version: 5.7.33
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_simpelat`
--

-- --------------------------------------------------------

--
-- Table structure for table `alat_berat`
--

CREATE TABLE `alat_berat` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `merk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Tersedia','Tidak Tersedia') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Tersedia',
  `operator` enum('Tersedia','Tidak Tersedia') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Tersedia',
  `bbm` enum('Tersedia','Tidak Tersedia') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Tersedia',
  `harga` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `durasi_sewa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'thubnail.jpg',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `alat_berat`
--

INSERT INTO `alat_berat` (`id`, `type`, `merk`, `status`, `operator`, `bbm`, `harga`, `durasi_sewa`, `gambar`, `created_at`, `updated_at`) VALUES
(1, 'Bulldozer', 'Kobelco', 'Tersedia', 'Tersedia', 'Tidak Tersedia', '450000', 'per Jam', '1671104533_top_ph03.jpg', '2022-12-15 11:42:13', '2022-12-16 21:26:21'),
(2, 'Truck', 'Dump Truck', 'Tidak Tersedia', 'Tersedia', 'Tersedia', '700000', 'per Hari', '1671106230_79dumptruck.jpg', '2022-12-15 12:10:30', '2022-12-16 21:29:58'),
(3, 'Eskafator', 'Komatsu', 'Tidak Tersedia', 'Tersedia', 'Tidak Tersedia', '700000', 'per Jam', '1671270555_Excavator-20-ton-Terbaik-Komatsu-PC210-10M0-Proses-Penambangan-Nikel-yang-Efektif-dan-Efisien.jpg', '2022-12-17 09:49:15', '2022-12-19 06:02:39'),
(4, 'Eskafator', 'Komatsu Breaker', 'Tersedia', 'Tersedia', 'Tidak Tersedia', '750000', 'per Jam', '1671445965_breaker_tips_equipina_1.jpg', '2022-12-19 10:32:45', '2022-12-19 10:32:45');

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
(2, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(3, '2022_12_06_115651_settings', 1),
(4, '2014_10_12_100000_create_password_resets_table', 2),
(5, '2022_12_15_101314_alat_berat', 2),
(6, '2022_12_15_121155_rekening', 3),
(8, '2022_12_15_125542_transaksi', 4);

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
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rekening`
--

CREATE TABLE `rekening` (
  `id` int(10) UNSIGNED NOT NULL,
  `bank` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_rekening` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_rekening` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rekening`
--

INSERT INTO `rekening` (`id`, `bank`, `no_rekening`, `nama_rekening`, `created_at`, `updated_at`) VALUES
(1, 'B.P.D D.I. Yogyakarta', '01811100009', 'CV Mitra Bangun Handayani', '2022-12-15 12:35:43', '2022-12-19 03:26:33'),
(2, 'BCA', '21421217122321', 'Mitra Bangun Handayani', '2022-12-19 13:09:51', '2022-12-19 13:09:51');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama_perusahaan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tentang` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `telepon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `whatsapp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `instagram` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `facebook` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `nama_perusahaan`, `tentang`, `alamat`, `telepon`, `email`, `whatsapp`, `instagram`, `facebook`, `created_at`, `updated_at`) VALUES
(1, 'CV. Mitra Bangun Handayani', 'CV Mitra Bangun Handayani merupakan salah satu perusahaan yang bergerak di bidang konstruksi, terutama pada bidang persiapan dan pematangan lahan konstruksi, jasa sewa alat berat dan pengadaan bahan bangunan konstruksi. CV MBH menyediakan berbagai solusi kebutuhan secara cepat dan tepat serta berorientasi pada kualitas. Selain menangani pekerjaan yang berkaitan dengan lahan konstruksi, CV MBH juga memberikan solusi atas pekerjan penataan lahan masyarakat secara umum, misalnya penataan lahan pertanian, irigasi, talut, jalan dll. \r\n                Dengan umur yang masih relatif muda, CV MBH berdedikasi untuk menjadi perusahaan yang berorientasi terhadap kualitas pekerjaan serta berupaya menjadi solusi cepat dan tepat terhadap berbagai kebutuhan masyarakat.', 'Jalan Yogyakarta - Wonosari Salam Patuk, Karang Sari, Nglanggeran, Kec. Patuk, Kabupaten Gunung Kidul, Daerah Istimewa Yogyakarta 55862', '098778928897', 'mitrabangun.handayani@mail.com', '098778928897', 'http://www.instagram.com', 'http://www.facebook.com', '2022-12-12 07:01:32', '2022-12-19 03:04:05');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_alat_berat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `durasi_sewa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokasi_proyek` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_pemakaian` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bukti_pembayaran` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `id_pelanggan`, `id_alat_berat`, `durasi_sewa`, `lokasi_proyek`, `tgl_pemakaian`, `bukti_pembayaran`, `status`, `created_at`, `updated_at`) VALUES
(2, 8, '3', '2', 'Purwakarta', '2022-12-19', '1671302095_WhatsApp Image 2022-12-08 at 6.53.44 PM.jpeg', '0', '2022-12-17 17:12:30', '2022-12-19 03:44:15'),
(3, 9, '3', '4', 'Purwakarta', '2022-12-01', NULL, '0', '2022-12-19 10:27:52', '2022-12-19 10:27:52'),
(4, 10, '3', '6', 'Purwakarta', '2022-12-25', '1671454823_79dumptruck.jpg', '1', '2022-12-19 12:58:55', '2022-12-19 06:02:39');

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`id`, `type`, `created_at`, `updated_at`) VALUES
(1, 'Bulldozer', '2022-12-15 10:44:20', '2022-12-15 03:57:50'),
(2, 'Truck', '2022-12-15 10:59:27', '2022-12-15 10:59:27'),
(3, 'Eskafator', '2022-12-17 09:48:12', '2022-12-17 09:48:12');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `photo` char(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user-dummy-img.jpg',
  `role` enum('owner','admin','pelanggan') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pelanggan',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `phone`, `email`, `address`, `photo`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Ahmad', 'admin', '$2y$10$JHnmvE5gpgd98gaoFElsZe0yNdwzRpidRjnOwbx8TnDXmm3MnFAo6', '082299123456', 'naral@mailinator.com', 'Jl. Rusa 1, Jogjakarta', '1671030204_alfin.png', 'admin', '2022-12-12 07:02:01', '2022-12-17 02:52:08'),
(3, 'ini akun Owner', 'owner', '$2y$10$/E7xQ7AxAsuLGfNv5q4Nc.xev6cWQMs9yJej9brI5Je03hhPiM87.', '08229912445', 'owner@example.com', 'Jl. Rusa 1, Jogjakarta', 'user-dummy-img.jpg', 'owner', '2022-12-12 07:02:01', '2022-12-12 07:02:01'),
(8, 'Justin Livingston', 'pevewuxa', '$2y$10$iSEK7fpGiIDBlkBW/lc/UuB0VYDzQlRYeZCOH.TWF69g0T7g90gie', '+1 (356) 765-1763', 'cahowamuz@mailinator.com', 'Aut sed accusamus il', 'user-dummy-img.jpg', 'pelanggan', '2022-12-17 09:52:49', '2022-12-17 09:52:49'),
(9, 'Marah Waters', 'nazegi', '$2y$10$WbYRvtlts7DbT7y.U1a1fOTqZ71YlmJ8T./rU2g.X9nHIQSXuqMFW', '+1 (471) 396-2327', 'gaxupemo@mailinator.com', 'Ea rerum in minima c', 'user-dummy-img.jpg', 'pelanggan', '2022-12-19 10:27:21', '2022-12-19 10:27:21'),
(10, 'Kirsten Parsons', 'moguwa', '$2y$10$3.d0ioIR/WtdZReLDhOx0ONuyxzqgT/UoQKU4JfiL5u/l1fA0OE2G', '+1 (621) 214-1239', 'nezynisacy@mailinator.com', 'Amet sapiente dolor', 'user-dummy-img.jpg', 'pelanggan', '2022-12-19 12:57:46', '2022-12-19 12:57:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alat_berat`
--
ALTER TABLE `alat_berat`
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
-- Indexes for table `rekening`
--
ALTER TABLE `rekening`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alat_berat`
--
ALTER TABLE `alat_berat`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rekening`
--
ALTER TABLE `rekening`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
