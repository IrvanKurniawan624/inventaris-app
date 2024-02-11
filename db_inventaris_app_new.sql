-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 11, 2024 at 09:24 PM
-- Server version: 8.0.30
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_inventaris_app`
--

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
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama_kategori`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(23, 'Kursi', 1, 1, '2024-01-28 10:39:05', '2024-01-28 10:39:05'),
(24, 'Meja', 1, 1, '2024-01-28 10:39:13', '2024-01-28 10:39:13'),
(25, 'Komputer', 1, 1, '2024-01-28 10:39:20', '2024-01-28 10:39:20'),
(26, 'Mic & Speaker', 1, 1, '2024-01-28 10:39:30', '2024-01-28 10:39:30'),
(27, 'Alat Olahraga', 1, 1, '2024-01-28 10:39:51', '2024-01-28 10:39:51');

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `id` bigint NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  `desc` text,
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `master_barang`
--

CREATE TABLE `master_barang` (
  `id` bigint UNSIGNED NOT NULL,
  `kode_barang` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `spesifikasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int NOT NULL DEFAULT '0',
  `jumlah_dipinjam` int DEFAULT '0',
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ruang_id` bigint UNSIGNED NOT NULL,
  `kategori_id` bigint UNSIGNED NOT NULL,
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `master_barang`
--

INSERT INTO `master_barang` (`id`, `kode_barang`, `image`, `nama_barang`, `spesifikasi`, `jumlah`, `jumlah_dipinjam`, `keterangan`, `ruang_id`, `kategori_id`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(18, 'BRNG001', '42a03407fe913821e7c3df25c9552d46.webp', 'barang dummy 1', 'Kayu', 20, 0, 'keterangan barang dummy 1', 2, 25, 1, 1, '2024-02-02 21:41:38', '2024-02-05 13:31:12'),
(19, 'BRNG002', '5e747497c57cc659522aad7645603e5a.webp', 'Barang 02', 'Plastik', 11, 2, 'wasd12311', 4, 27, 1, 1, '2024-02-02 21:46:27', '2024-02-11 10:47:42'),
(22, 'BRNG003', '86ea2e401dd9b22f30462616f4406864.webp', 'barang dummy 3', 'Kayu', 7, 3, 'wasd', 4, 23, 1, 1, '2024-02-03 09:26:51', '2024-02-08 07:47:45');

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
(5, '2024_01_08_030221_create_stock_opname', 1),
(6, '2024_01_09_000315_create_supplier', 1),
(7, '2024_01_09_000331_create_penanggung_jawab', 1),
(8, '2024_01_09_000357_create_ruang', 1),
(9, '2024_01_09_000418_create_kategori', 1),
(10, '2024_01_09_030149_create_master_barang', 1);

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
-- Table structure for table `peminjam`
--

CREATE TABLE `peminjam` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_peminjam` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kontak_peminjam` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `peminjam`
--

INSERT INTO `peminjam` (`id`, `nama_peminjam`, `jabatan`, `kontak_peminjam`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Peminjam-Dummy-1', 'siswa', '085172201234', 1, 1, '2024-01-28 05:46:27', '2024-01-29 02:36:14'),
(3, 'Peminjam-Dummy-2', 'guru', '0851722012345', 1, 1, '2024-01-28 11:01:48', '2024-01-28 11:01:48'),
(4, 'Peminjam-Dummy-3', 'staff', '085172201234', 1, 1, '2024-01-28 11:03:34', '2024-01-28 11:03:34');

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
-- Table structure for table `pinjam`
--

CREATE TABLE `pinjam` (
  `id` bigint UNSIGNED NOT NULL,
  `kode_pinjam` varchar(25) NOT NULL,
  `id_peminjam` bigint UNSIGNED NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `status` char(2) NOT NULL DEFAULT '0' COMMENT '0 = masih dipinjam | 1 = sudah dikembalikan',
  `created_by` bigint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_by` bigint DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pinjam`
--

INSERT INTO `pinjam` (`id`, `kode_pinjam`, `id_peminjam`, `tanggal_pinjam`, `tanggal_kembali`, `status`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(13, 'PNJ-202402051', 1, '2024-02-06', '2024-02-15', '1', 1, '2024-02-05 13:29:49', 1, '2024-02-05 13:31:12'),
(14, 'PNJ-202402082', 4, '2024-02-08', '2024-02-29', '0', 1, '2024-02-08 07:47:45', 1, '2024-02-08 07:47:45');

-- --------------------------------------------------------

--
-- Table structure for table `pinjam_detail`
--

CREATE TABLE `pinjam_detail` (
  `id` bigint UNSIGNED NOT NULL,
  `id_pinjam` bigint UNSIGNED NOT NULL,
  `id_barang` bigint UNSIGNED NOT NULL,
  `jumlah` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pinjam_detail`
--

INSERT INTO `pinjam_detail` (`id`, `id_pinjam`, `id_barang`, `jumlah`) VALUES
(15, 13, 22, 5),
(16, 13, 18, 5),
(17, 14, 22, 3),
(18, 14, 19, 2);

-- --------------------------------------------------------

--
-- Table structure for table `ruang`
--

CREATE TABLE `ruang` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_ruang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ruang`
--

INSERT INTO `ruang` (`id`, `nama_ruang`, `keterangan`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(2, 'XII RPL', 'RUANGAN XII RPL', 1, 1, '2024-01-28 10:26:05', '2024-01-28 10:26:05'),
(3, 'XII TKJ 1', 'RUANGAN XII TKJ 1', 1, 1, '2024-01-28 11:04:28', '2024-01-28 11:04:28'),
(4, 'XII TBSM 1', 'RUANGAN XII TBSM 1', 1, 1, '2024-01-28 11:04:47', '2024-01-28 11:04:47');

-- --------------------------------------------------------

--
-- Table structure for table `stock_opname`
--

CREATE TABLE `stock_opname` (
  `id` bigint UNSIGNED NOT NULL,
  `id_barang` bigint UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `jumlah_awal` int NOT NULL,
  `jumlah_akhir` int NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `created_by` bigint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_by` bigint DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_supplier` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_supplier` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kontak_supplier` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `nama_supplier`, `alamat_supplier`, `kontak_supplier`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(4, 'Data Dummy Supplier 1', 'Jln. Cendrawasih No. 21, Surabaya Timur', '0812371203', 1, 1, '2024-01-10 21:01:21', '2024-01-28 10:41:16'),
(5, 'Data Dummy Supplier 2', 'Jln. H. Syukur XII, Sedati Gede, Sedati, Sidoarjo', '085172201234', 1, 1, '2024-01-28 10:40:51', '2024-01-28 10:41:06');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` bigint UNSIGNED NOT NULL,
  `id_barang` bigint UNSIGNED NOT NULL,
  `jumlah` int NOT NULL,
  `harga` int DEFAULT NULL,
  `type` char(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT '1 = barang_masuk | 2 = barang_keluar',
  `keterangan` text,
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `id_barang`, `jumlah`, `harga`, `type`, `keterangan`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(7, 18, 25, 12000, '1', 'keterangan transaksi barang masuk 1', 1, '2024-02-02 21:41:38', 1, '2024-02-02 21:41:38'),
(8, 19, 12, 12000, '1', 'wasd', 1, '2024-02-02 21:46:27', 1, '2024-02-02 21:46:27'),
(9, 19, 10, NULL, '2', 'Pengurangan Jumlah Barang', 1, '2024-02-03 04:28:59', 1, '2024-02-03 04:28:59'),
(10, 18, 10, NULL, '2', 'Pengurangan Jumlah Barang', 1, '2024-02-03 04:28:59', 1, '2024-02-03 04:28:59'),
(11, 19, 1, NULL, '2', 'wasdf', 1, '2024-02-03 05:17:08', 1, '2024-02-03 05:17:08'),
(12, 19, 1, NULL, '2', 'wwww', 1, '2024-02-03 05:18:53', 1, '2024-02-03 05:18:53'),
(13, 18, 1, NULL, '2', 'wwww', 1, '2024-02-03 05:18:53', 1, '2024-02-03 05:18:53'),
(14, 19, 15, 15000, '1', 'wasdf', 1, '2024-02-05 00:32:43', 1, '2024-02-05 00:32:43'),
(15, 19, 2, NULL, '2', 'wasdf', 1, '2024-02-05 00:33:06', 1, '2024-02-05 00:33:06'),
(16, 22, 10, 15000, '1', 'wasdf', 1, '2024-02-05 00:34:14', 1, '2024-02-05 00:34:14'),
(17, 18, 25, 25000, '1', 'wasdf', 1, '2024-02-05 00:35:14', 1, '2024-02-05 00:35:14'),
(18, 22, 10, 12000, '1', 'www', 1, '2024-02-05 00:53:01', 1, '2024-02-05 00:53:01'),
(19, 19, 2, 10000, '1', 'wasdf', 1, '2024-02-05 00:56:55', 1, '2024-02-05 00:56:55'),
(20, 18, 3, NULL, '2', 'wwww', 1, '2024-02-05 01:02:52', 1, '2024-02-05 01:02:52'),
(21, 18, 6, NULL, '2', 'qw', 1, '2024-02-05 01:03:00', 1, '2024-02-05 01:03:00'),
(22, 22, 3, NULL, '2', 'wasdf', 1, '2024-02-05 01:03:33', 1, '2024-02-05 01:03:33'),
(23, 19, 5, NULL, '2', 'aaaa', 1, '2024-02-05 01:15:29', 1, '2024-02-05 01:15:29'),
(24, 18, 5, NULL, '2', 'aaaa', 1, '2024-02-05 01:15:29', 1, '2024-02-05 01:15:29'),
(25, 22, 1, NULL, '2', 'aaaa', 1, '2024-02-05 01:15:29', 1, '2024-02-05 01:15:29'),
(26, 19, 2, NULL, '2', 'wwwww', 1, '2024-02-05 01:20:23', 1, '2024-02-05 01:20:23'),
(27, 18, 2, NULL, '2', 'wwwww', 1, '2024-02-05 01:20:23', 1, '2024-02-05 01:20:23'),
(28, 19, 12, 10000, '1', 'wwww', 1, '2024-02-05 11:28:50', 1, '2024-02-05 11:28:50'),
(29, 19, 4, 15000, '1', 'wasdf', 1, '2024-02-11 10:47:15', 1, '2024-02-11 10:47:15'),
(30, 19, 1, NULL, '2', 'wwww', 1, '2024-02-11 10:47:42', 1, '2024-02-11 10:47:42');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `email_verified_at`, `password`, `remember_token`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', '2024-01-08 18:24:41', '$2y$12$mW6q1QbtsF4Ghyo3Xc42tOjG4ibh.VprKDq/GCQiul68LlgcHBb6a', 'zPMjAHCepszYbSijsEzHtc6s5ByRSYX90Pi9HbmNXr66nq4ynzUW7OZUDXrk', NULL, NULL, '2024-01-08 18:24:41', '2024-01-08 18:24:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kategori_created_by_foreign` (`created_by`),
  ADD KEY `kategori_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `log_created_by_foreign` (`created_by`),
  ADD KEY `log_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `master_barang`
--
ALTER TABLE `master_barang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `master_barang_ruang_id_foreign` (`ruang_id`),
  ADD KEY `master_barang_kategori_id_foreign` (`kategori_id`),
  ADD KEY `master_barang_created_by_foreign` (`created_by`),
  ADD KEY `master_barang_updated_by_foreign` (`updated_by`);

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
-- Indexes for table `peminjam`
--
ALTER TABLE `peminjam`
  ADD PRIMARY KEY (`id`),
  ADD KEY `penanggung_jawab_created_by_foreign` (`created_by`),
  ADD KEY `penanggung_jawab_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `pinjam`
--
ALTER TABLE `pinjam`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pj_id_peminjam_foreign` (`id_peminjam`);

--
-- Indexes for table `pinjam_detail`
--
ALTER TABLE `pinjam_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pinjam_detail_id_pinjam_foreign` (`id_pinjam`),
  ADD KEY `pinjam_detail_id_barang_foreign` (`id_barang`);

--
-- Indexes for table `ruang`
--
ALTER TABLE `ruang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ruang_created_by_foreign` (`created_by`),
  ADD KEY `ruang_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `stock_opname`
--
ALTER TABLE `stock_opname`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_barang_foreign` (`id_barang`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supplier_created_by_foreign` (`created_by`),
  ADD KEY `supplier_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_barang_foreign` (`id_barang`),
  ADD KEY `transaksi_created_by_foreign` (`created_by`),
  ADD KEY `transaksi_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_created_by_foreign` (`created_by`),
  ADD KEY `users_updated_by_foreign` (`updated_by`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `master_barang`
--
ALTER TABLE `master_barang`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `peminjam`
--
ALTER TABLE `peminjam`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pinjam`
--
ALTER TABLE `pinjam`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `pinjam_detail`
--
ALTER TABLE `pinjam_detail`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `ruang`
--
ALTER TABLE `ruang`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `stock_opname`
--
ALTER TABLE `stock_opname`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kategori`
--
ALTER TABLE `kategori`
  ADD CONSTRAINT `kategori_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `kategori_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `log`
--
ALTER TABLE `log`
  ADD CONSTRAINT `log_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `log_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `master_barang`
--
ALTER TABLE `master_barang`
  ADD CONSTRAINT `master_barang_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `master_barang_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`),
  ADD CONSTRAINT `master_barang_ruang_id_foreign` FOREIGN KEY (`ruang_id`) REFERENCES `ruang` (`id`),
  ADD CONSTRAINT `master_barang_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `peminjam`
--
ALTER TABLE `peminjam`
  ADD CONSTRAINT `penanggung_jawab_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `penanggung_jawab_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `pinjam`
--
ALTER TABLE `pinjam`
  ADD CONSTRAINT `pj_id_peminjam_foreign` FOREIGN KEY (`id_peminjam`) REFERENCES `peminjam` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pinjam_detail`
--
ALTER TABLE `pinjam_detail`
  ADD CONSTRAINT `pinjam_detail_id_barang_foreign` FOREIGN KEY (`id_barang`) REFERENCES `master_barang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pinjam_detail_id_pinjam_foreign` FOREIGN KEY (`id_pinjam`) REFERENCES `pinjam` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ruang`
--
ALTER TABLE `ruang`
  ADD CONSTRAINT `ruang_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `ruang_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `stock_opname`
--
ALTER TABLE `stock_opname`
  ADD CONSTRAINT `id_barang_foreign` FOREIGN KEY (`id_barang`) REFERENCES `master_barang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `supplier`
--
ALTER TABLE `supplier`
  ADD CONSTRAINT `supplier_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `supplier_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_id_barang_foreign` FOREIGN KEY (`id_barang`) REFERENCES `master_barang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `users_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
