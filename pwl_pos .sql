-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 21, 2024 at 12:43 PM
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
-- Database: `pwl_pos`
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
(23, '2024_09_13_140100_create_m_barang_table', 3),
(26, '2024_09_13_141845_create_t_penjualan_table', 6),
(27, '2024_09_13_142128_create_t_penjualan_table', 7),
(28, '2024_09_13_143019_create_t_penjualan_detail_table', 8),
(39, '2014_10_12_000000_create_users_table', 9),
(40, '2014_10_12_100000_create_password_reset_tokens_table', 9),
(41, '2019_08_19_000000_create_failed_jobs_table', 9),
(42, '2019_12_14_000001_create_personal_access_tokens_table', 9),
(43, '2024_09_11_064710_create_m_level_table', 9),
(44, '2024_09_11_071658_create_m_user_table', 9),
(45, '2024_09_13_135034_create_m_kategori_table', 9),
(46, '2024_09_13_141426_create_m_barang_table', 9),
(47, '2024_09_13_145613_create_t_penjualan_table', 10),
(48, '2024_09_13_145647_create_t_penjualan_detail_table', 11),
(49, '2024_09_13_153909_create_m_supplier_table', 12),
(50, '2024_09_13_141617_create_t_stok_table', 13);

-- --------------------------------------------------------

--
-- Table structure for table `m_barang`
--

CREATE TABLE `m_barang` (
  `barang_id` bigint UNSIGNED NOT NULL,
  `kategori_id` bigint UNSIGNED NOT NULL,
  `barang_kode` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `barang_nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_beli` int NOT NULL,
  `harga_jual` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_barang`
--

INSERT INTO `m_barang` (`barang_id`, `kategori_id`, `barang_kode`, `barang_nama`, `harga_beli`, `harga_jual`, `created_at`, `updated_at`) VALUES
(1, 1, 'nas', 'Nasi', 10000, 12000, NULL, NULL),
(2, 1, 'aym', 'Ayam', 8000, 10000, NULL, NULL),
(3, 1, 'saw', 'Sawi', 5000, 7000, NULL, NULL),
(4, 2, 'pmg', 'Promag', 8000, 10000, NULL, NULL),
(5, 2, 'scr', 'Sunscreen', 12000, 15000, NULL, NULL),
(6, 2, 'dlx', 'Dulcolax', 8000, 10000, NULL, NULL),
(7, 3, 'myt', 'Minyak Telon', 15000, 19000, NULL, NULL),
(8, 3, 'pop', 'Popok Bayi', 8000, 20000, NULL, NULL),
(9, 3, 'bdk', 'Bedak Bayi', 8000, 10000, NULL, NULL),
(10, 4, 'krs', 'Kursi Plastik', 20000, 22000, NULL, NULL),
(11, 4, 'pel', 'Pel', 8000, 10000, NULL, NULL),
(12, 4, 'sap', 'Sapu', 8000, 10000, NULL, NULL),
(13, 5, 'lmp', 'Lampu', 8000, 10000, NULL, NULL),
(14, 5, 'stk', 'Stop Kontak', 8000, 10000, NULL, NULL),
(15, 5, 'kbl', 'Kabel', 8000, 10000, NULL, NULL),
(16, 1, '20', 'Jagung', 5000, 7000, '2024-10-01 08:12:14', '2024-10-01 08:12:14'),
(20, 9, 'SBK-003', 'Telur Omega(10 butir)', 22000, 25000, '2024-10-18 03:13:06', NULL),
(21, 10, 'SNK-003', 'Sari Roti', 11500, 12500, '2024-10-18 03:13:06', NULL),
(22, 11, 'MND-003', 'Shampo Pantene', 17500, 18500, '2024-10-18 03:13:06', NULL),
(23, 12, 'BAY-003', 'Baju Bayi 2th', 89000, 92500, '2024-10-18 03:13:06', NULL),
(24, 13, 'MNM-003', 'Cleo600ml', 3750, 4300, '2024-10-18 03:13:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_kategori`
--

CREATE TABLE `m_kategori` (
  `kategori_id` bigint UNSIGNED NOT NULL,
  `kategori_kode` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori_nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_kategori`
--

INSERT INTO `m_kategori` (`kategori_id`, `kategori_kode`, `kategori_nama`, `created_at`, `updated_at`) VALUES
(1, 'fnb', 'Food and Baverage', NULL, NULL),
(2, 'bnh', 'Beauty and Health', NULL, NULL),
(3, 'bnk', 'Baby and Kid', NULL, NULL),
(4, 'hnc', 'Home and Care', NULL, NULL),
(5, 'elk', 'Elektronik', NULL, NULL),
(9, 'SBK', 'Sembako', '2024-10-17 21:37:37', '2024-10-17 21:37:37'),
(10, 'SNK', 'Makanan Ringan', '2024-10-17 21:38:28', '2024-10-17 21:38:28'),
(11, 'MND', 'Peralatan Mandi', '2024-10-17 21:38:43', '2024-10-17 21:38:43'),
(12, 'BAY', 'Keperluan Bayi', '2024-10-17 21:39:01', '2024-10-17 21:39:01'),
(13, 'MNM', 'Minuman', '2024-10-17 21:39:12', '2024-10-17 21:39:12');

-- --------------------------------------------------------

--
-- Table structure for table `m_level`
--

CREATE TABLE `m_level` (
  `level_id` bigint UNSIGNED NOT NULL,
  `level_kode` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level_nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_level`
--

INSERT INTO `m_level` (`level_id`, `level_kode`, `level_nama`, `created_at`, `updated_at`) VALUES
(1, 'ADM', 'Administrator', NULL, NULL),
(2, 'MNG', 'Manager', NULL, NULL),
(3, 'STF', 'Staff/Kasir', NULL, NULL),
(4, 'CUS', 'Pelanggan', '2024-09-13 23:00:31', NULL),
(7, 'DRK', 'Direktur', '2024-10-03 23:24:07', '2024-10-03 23:24:07'),
(8, 'CLT', 'Client', '2024-10-20 18:37:18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_supplier`
--

CREATE TABLE `m_supplier` (
  `supplier_id` bigint UNSIGNED NOT NULL,
  `supplier_kode` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_alamat` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_supplier`
--

INSERT INTO `m_supplier` (`supplier_id`, `supplier_kode`, `supplier_nama`, `supplier_alamat`, `created_at`, `updated_at`) VALUES
(1, 'yol', 'Yolanda Supplier', 'Jln Hamidrusdi No.102', NULL, NULL),
(2, 'snd', 'Sendi Supplier', 'Jln Buring No.54', NULL, NULL),
(3, 'liy', 'Liya Supplier', 'Jln Tuban no 65', NULL, NULL),
(4, 'nels', 'Nela Supplier', 'Jln yerussalem No.4', '2024-10-01 06:36:26', '2024-10-01 06:56:36'),
(5, 'nei', 'Neisya Supplier', 'Jln Bandung No.2', '2024-10-21 00:57:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_user`
--

CREATE TABLE `m_user` (
  `user_id` bigint UNSIGNED NOT NULL,
  `level_id` bigint UNSIGNED NOT NULL,
  `username` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_user`
--

INSERT INTO `m_user` (`user_id`, `level_id`, `username`, `nama`, `password`, `created_at`, `updated_at`) VALUES
(1, 1, 'admin', 'Administrator', '$2y$12$yT2ENG8nFrlUZLMxaJ7EAe..o9/EoNppHPDZPNzLjmIKCfARBq3pq', NULL, '2024-10-12 07:46:37'),
(2, 2, 'manager', 'Manager', '$2y$12$SeFpeouVjEX4zgpawMeSteu4TNGf9VKXBseQOGkIeSUZAe33SwRxG', NULL, NULL),
(3, 3, 'staff', 'Staff/Kasir', '$2y$12$t/C5/dCoP4CYr7B/Jkmnuur.0i2C1Vwic1oUDY42yel1ygsXcaJb6', NULL, NULL),
(14, 4, 'customer-1', 'Pelanggan Pertama', '$2y$12$0a0Wup0Kxg1BTi5VrRP19en82.r5IigKl.c1fkzyfK8kW6L3KBeVa', NULL, '2024-09-14 00:22:03'),
(15, 2, 'manager_dua', 'Manager 2', '$2y$12$3MSFk4gJnho2o675OJF4we7wcaRfZnkGLLkUbuiz0weOt4I9.qjaG', '2024-09-18 02:02:37', '2024-09-18 02:02:37'),
(16, 2, 'manager33', 'Manager Tiga Tiga', '$2y$12$69Xn5NUUguNTz2aI9gJgIOvvxdYOCbujyUnmr3.7G1QuvSn25WAu6', '2024-09-19 06:44:44', '2024-09-19 06:44:44'),
(17, 2, 'manager56', 'Manager55', '$2y$12$xbNHPhrm09jdTxQE40gnyOLoziGlBOYssWqa5zi0.1YgI/FbxPjYm', '2024-09-19 07:04:12', '2024-09-19 07:04:12'),
(18, 2, 'manager12', 'Manager11', '$2y$12$1gJLzJ1ISFdimyp3OSpV4OMvazSHHSG0zK921nYK.sp/tRknsLOGe', '2024-09-19 07:16:20', '2024-09-19 07:16:20'),
(23, 4, 'Pelanggan0', 'Pelanggan', '$2y$12$DC63aoBcV.j.yrVTJ1qmBuE4OMSmjn1Il48m4iu70C1L7s1QOddpO', '2024-10-03 16:36:38', '2024-10-12 05:16:27'),
(38, 3, 'Staff2', 'Staff Ahli', '$2y$12$TA39VRvfieLKA3Q71gGvxelbvHIYaqE5f74ZEeggeC4banmhj1YXa', '2024-10-03 21:57:55', '2024-10-12 05:17:26'),
(44, 3, 'Staff3', 'Staff Utama', '$2y$12$mSe9V92UQ0YBW2jNPjIaeOxf/zkVVYFx5X3Af37kJaP3WttZK9LF2', '2024-10-13 08:52:18', '2024-10-13 08:52:18'),
(51, 3, 'Staff4', 'Staff Pembantu', '123456', '2024-10-21 00:10:35', NULL),
(52, 2, 'manager4', 'Manager Keempat', '234567', '2024-10-21 00:10:35', NULL);

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
-- Table structure for table `t_penjualan`
--

CREATE TABLE `t_penjualan` (
  `penjualan_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `pembeli` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penjualan_kode` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penjualan_tanggal` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `t_penjualan`
--

INSERT INTO `t_penjualan` (`penjualan_id`, `user_id`, `pembeli`, `penjualan_kode`, `penjualan_tanggal`, `created_at`, `updated_at`) VALUES
(1, 3, 'Nela', 'aaa', '2024-09-11 00:00:00', NULL, NULL),
(2, 3, 'Nara', 'aab', '2024-09-11 00:00:00', NULL, NULL),
(3, 3, 'Lala', 'aba', '2024-09-11 00:00:00', NULL, NULL),
(4, 3, 'Chia', 'abc', '2024-09-11 00:00:00', NULL, NULL),
(5, 3, 'Nela', 'acb', '2024-09-11 00:00:00', NULL, NULL),
(6, 3, 'Nela', 'acc', '2024-09-11 00:00:00', NULL, NULL),
(7, 3, 'Nara', 'ana', '2024-09-11 00:00:00', NULL, NULL),
(8, 3, 'Neva', 'ama', '2024-09-11 00:00:00', NULL, NULL),
(9, 3, 'Nela', 'omo', '2024-09-11 00:00:00', NULL, NULL),
(10, 3, 'Nela', 'umu', '2024-09-11 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_penjualan_detail`
--

CREATE TABLE `t_penjualan_detail` (
  `detail_id` bigint UNSIGNED NOT NULL,
  `penjualan_id` bigint UNSIGNED NOT NULL,
  `barang_id` bigint UNSIGNED NOT NULL,
  `harga` int NOT NULL,
  `jumlah` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `t_penjualan_detail`
--

INSERT INTO `t_penjualan_detail` (`detail_id`, `penjualan_id`, `barang_id`, `harga`, `jumlah`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 10588, 4, NULL, NULL),
(2, 1, 2, 8523, 3, NULL, NULL),
(3, 1, 3, 5615, 10, NULL, NULL),
(4, 2, 1, 7633, 5, NULL, NULL),
(5, 2, 2, 7789, 10, NULL, NULL),
(6, 2, 3, 9942, 7, NULL, NULL),
(7, 3, 1, 7921, 4, NULL, NULL),
(8, 3, 2, 7418, 4, NULL, NULL),
(9, 3, 3, 14221, 5, NULL, NULL),
(10, 4, 1, 12405, 4, NULL, NULL),
(11, 4, 2, 13574, 1, NULL, NULL),
(12, 4, 3, 8812, 3, NULL, NULL),
(13, 5, 1, 10465, 3, NULL, NULL),
(14, 5, 2, 13213, 2, NULL, NULL),
(15, 5, 3, 7606, 7, NULL, NULL),
(16, 6, 1, 12951, 2, NULL, NULL),
(17, 6, 2, 11677, 3, NULL, NULL),
(18, 6, 3, 7052, 6, NULL, NULL),
(19, 7, 1, 6308, 3, NULL, NULL),
(20, 7, 2, 8610, 5, NULL, NULL),
(21, 7, 3, 13260, 3, NULL, NULL),
(22, 8, 1, 9177, 2, NULL, NULL),
(23, 8, 2, 12588, 9, NULL, NULL),
(24, 8, 3, 7159, 1, NULL, NULL),
(25, 9, 1, 14770, 8, NULL, NULL),
(26, 9, 2, 9611, 6, NULL, NULL),
(27, 9, 3, 6419, 5, NULL, NULL),
(28, 10, 1, 12253, 6, NULL, NULL),
(29, 10, 2, 8083, 3, NULL, NULL),
(30, 10, 3, 5392, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_stok`
--

CREATE TABLE `t_stok` (
  `stok_id` bigint UNSIGNED NOT NULL,
  `barang_id` bigint UNSIGNED NOT NULL,
  `supplier_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `stok_tanggal` datetime NOT NULL,
  `stok_jumlah` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `t_stok`
--

INSERT INTO `t_stok` (`stok_id`, `barang_id`, `supplier_id`, `user_id`, `stok_tanggal`, `stok_jumlah`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 3, '2024-09-11 00:00:00', 4, NULL, NULL),
(2, 2, 1, 3, '2024-09-11 00:00:00', 5, NULL, NULL),
(3, 1, 1, 3, '2024-09-11 00:00:00', 4, NULL, NULL),
(4, 2, 1, 3, '2024-09-11 00:00:00', 4, NULL, NULL),
(5, 3, 1, 3, '2024-09-11 00:00:00', 4, NULL, NULL),
(6, 4, 2, 3, '2024-09-11 00:00:00', 4, NULL, NULL),
(7, 5, 2, 3, '2024-09-11 00:00:00', 4, NULL, NULL),
(8, 6, 2, 3, '2024-09-11 00:00:00', 4, NULL, NULL),
(9, 7, 2, 3, '2024-09-11 00:00:00', 4, NULL, NULL),
(10, 8, 2, 3, '2024-09-11 00:00:00', 4, NULL, NULL),
(11, 9, 3, 3, '2024-09-11 00:00:00', 4, NULL, NULL),
(12, 10, 3, 3, '2024-09-11 00:00:00', 4, NULL, NULL),
(13, 11, 3, 3, '2024-09-11 00:00:00', 4, NULL, NULL),
(14, 12, 3, 3, '2024-09-11 00:00:00', 4, NULL, NULL),
(15, 13, 3, 3, '2024-09-11 00:00:00', 4, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_barang`
--
ALTER TABLE `m_barang`
  ADD PRIMARY KEY (`barang_id`),
  ADD UNIQUE KEY `m_barang_barang_kode_unique` (`barang_kode`),
  ADD KEY `m_barang_kategori_id_index` (`kategori_id`);

--
-- Indexes for table `m_kategori`
--
ALTER TABLE `m_kategori`
  ADD PRIMARY KEY (`kategori_id`);

--
-- Indexes for table `m_level`
--
ALTER TABLE `m_level`
  ADD PRIMARY KEY (`level_id`),
  ADD UNIQUE KEY `m_level_level_kode_unique` (`level_kode`);

--
-- Indexes for table `m_supplier`
--
ALTER TABLE `m_supplier`
  ADD PRIMARY KEY (`supplier_id`),
  ADD UNIQUE KEY `m_supplier_supplier_kode_unique` (`supplier_kode`);

--
-- Indexes for table `m_user`
--
ALTER TABLE `m_user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `m_user_username_unique` (`username`),
  ADD KEY `m_user_level_id_index` (`level_id`);

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
-- Indexes for table `t_penjualan`
--
ALTER TABLE `t_penjualan`
  ADD PRIMARY KEY (`penjualan_id`),
  ADD UNIQUE KEY `t_penjualan_penjualan_kode_unique` (`penjualan_kode`),
  ADD KEY `t_penjualan_user_id_index` (`user_id`);

--
-- Indexes for table `t_penjualan_detail`
--
ALTER TABLE `t_penjualan_detail`
  ADD PRIMARY KEY (`detail_id`),
  ADD KEY `t_penjualan_detail_penjualan_id_index` (`penjualan_id`),
  ADD KEY `t_penjualan_detail_barang_id_index` (`barang_id`);

--
-- Indexes for table `t_stok`
--
ALTER TABLE `t_stok`
  ADD PRIMARY KEY (`stok_id`),
  ADD KEY `t_stok_barang_id_index` (`barang_id`),
  ADD KEY `t_stok_supplier_id_index` (`supplier_id`),
  ADD KEY `t_stok_user_id_index` (`user_id`);

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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `m_barang`
--
ALTER TABLE `m_barang`
  MODIFY `barang_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `m_kategori`
--
ALTER TABLE `m_kategori`
  MODIFY `kategori_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `m_level`
--
ALTER TABLE `m_level`
  MODIFY `level_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `m_supplier`
--
ALTER TABLE `m_supplier`
  MODIFY `supplier_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `m_user`
--
ALTER TABLE `m_user`
  MODIFY `user_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_penjualan`
--
ALTER TABLE `t_penjualan`
  MODIFY `penjualan_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `t_penjualan_detail`
--
ALTER TABLE `t_penjualan_detail`
  MODIFY `detail_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `t_stok`
--
ALTER TABLE `t_stok`
  MODIFY `stok_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `m_barang`
--
ALTER TABLE `m_barang`
  ADD CONSTRAINT `m_barang_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `m_kategori` (`kategori_id`);

--
-- Constraints for table `m_user`
--
ALTER TABLE `m_user`
  ADD CONSTRAINT `m_user_level_id_foreign` FOREIGN KEY (`level_id`) REFERENCES `m_level` (`level_id`);

--
-- Constraints for table `t_penjualan`
--
ALTER TABLE `t_penjualan`
  ADD CONSTRAINT `t_penjualan_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `m_user` (`user_id`);

--
-- Constraints for table `t_penjualan_detail`
--
ALTER TABLE `t_penjualan_detail`
  ADD CONSTRAINT `t_penjualan_detail_barang_id_foreign` FOREIGN KEY (`barang_id`) REFERENCES `m_barang` (`barang_id`),
  ADD CONSTRAINT `t_penjualan_detail_penjualan_id_foreign` FOREIGN KEY (`penjualan_id`) REFERENCES `t_penjualan` (`penjualan_id`);

--
-- Constraints for table `t_stok`
--
ALTER TABLE `t_stok`
  ADD CONSTRAINT `t_stok_barang_id_foreign` FOREIGN KEY (`barang_id`) REFERENCES `m_barang` (`barang_id`),
  ADD CONSTRAINT `t_stok_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `m_supplier` (`supplier_id`),
  ADD CONSTRAINT `t_stok_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `m_user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
