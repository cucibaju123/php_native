-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 16, 2021 at 05:42 AM
-- Server version: 10.5.8-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bmt`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `agama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `nama`, `jenis_kelamin`, `agama`, `status`, `jabatan`, `tanggal_lahir`, `username`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Julianto', 'Laki-laki', 'Islam', 'Belum Menikah', 'Staff', '2016-01-23', 'admin', '1234', NULL, '2021-07-09 01:47:04', '2021-07-09 01:47:04'),
(2, 'Jumadi', 'Perempuan', 'Islam', 'Sudah Menikah', 'Head Staff', '2021-07-15', 'admin2', '', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

CREATE TABLE `manager` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `manager`
--

INSERT INTO `manager` (`id`, `nama`, `email`, `username`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Manager', 'manager@example.com', 'manager', '1234', NULL, '2021-07-10 06:04:03', '2021-07-10 06:04:03');

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
(1, '2014_10_12_000000_create_nasabah_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(7, '2021_07_09_080628_create_admin_table', 2),
(9, '2021_07_09_102739_create_rekening_table', 3),
(10, '2021_07_10_115320_create_manager_table', 4),
(12, '2021_07_10_115848_create_pembiayaan_table', 5),
(13, '2021_07_11_064402_create_transaksi_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `nasabah`
--

CREATE TABLE `nasabah` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat_lahir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `agama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `pendidikan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pekerjaan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ahli_waris` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat_ahli_waris` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nasabah`
--

INSERT INTO `nasabah` (`id`, `nama`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `agama`, `alamat`, `pendidikan`, `status`, `pekerjaan`, `no_hp`, `ahli_waris`, `alamat_ahli_waris`, `username`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
('1209239834874576', 'Rizky Fauzi', 'Laki-laki', 'Banyumas', '2021-07-06', 'Islam', 'Ciamis', 'S2', 'Belum Menikah', 'Karyawan', '087870767845', 'Raffi Ahmad', 'Tangerang', 'user002', '1234', NULL, NULL, NULL),
('1234567890654732', 'Herdy Almadiptha', 'Laki-laki', 'Depok', '2021-07-15', 'Islam', 'Sentul', 'S1', 'Belum Menikah', 'Mahasiswa', '087870767790', 'Wulan Guritno', 'Depok', 'herdy', '1234', NULL, NULL, NULL),
('23712323434545656', 'Ananta Fauzi', 'Laki-laki', 'Jakarta', '2021-07-15', 'Islam', 'Bogor', 'S1', 'Belum Menikah', 'Wirausaha', '087870767790', 'Wulan Guritno', 'Depok', 'user001', '1234', NULL, NULL, NULL);

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
-- Table structure for table `pembiayaan`
--

CREATE TABLE `pembiayaan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rekening_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nasabah_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `manager_id` bigint(20) UNSIGNED DEFAULT NULL,
  `jenis_akad` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kegunaan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jaminan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_pinjaman` bigint(20) UNSIGNED DEFAULT NULL,
  `nisbah_bmt` tinyint(3) UNSIGNED DEFAULT NULL,
  `nisbah_nasabah` tinyint(3) UNSIGNED DEFAULT NULL,
  `tanggal_pengajuan` date DEFAULT NULL,
  `angsuran_per_bulan` bigint(20) UNSIGNED DEFAULT NULL,
  `keuntungan_per_bulan` bigint(20) UNSIGNED DEFAULT NULL,
  `total_angsuran` bigint(20) UNSIGNED DEFAULT 0,
  `jangka_waktu` tinyint(3) UNSIGNED DEFAULT NULL,
  `pendapatan_bmt` bigint(20) UNSIGNED DEFAULT NULL,
  `pendapatan_nasabah` bigint(20) UNSIGNED DEFAULT NULL,
  `manager_approved` tinyint(1) NOT NULL DEFAULT 0,
  `admin_approved` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pembiayaan`
--

INSERT INTO `pembiayaan` (`id`, `rekening_id`, `nasabah_id`, `admin_id`, `manager_id`, `jenis_akad`, `kegunaan`, `jaminan`, `total_pinjaman`, `nisbah_bmt`, `nisbah_nasabah`, `tanggal_pengajuan`, `angsuran_per_bulan`, `keuntungan_per_bulan`, `total_angsuran`, `jangka_waktu`, `pendapatan_bmt`, `pendapatan_nasabah`, `manager_approved`, `admin_approved`, `created_at`, `updated_at`) VALUES
(17, '1234567891', '23712323434545656', 1, 1, 'Mudharabah', 'Usaha Kuliner', 'Mobil', 15000000, 60, 40, '2021-07-15', 7000000, 1000000, 14000000, 2, 600000, 400000, 1, 1, NULL, NULL),
(18, '1234567892', '1234567890654732', 1, 1, 'Mudharabah', 'Usaha Start Up', 'Motor', 12000000, 60, 40, '2021-07-15', 1000000, 1000000, 12000000, 12, 500000, 500000, 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rekening`
--

CREATE TABLE `rekening` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nasabah_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_id` bigint(20) UNSIGNED NOT NULL,
  `jenis_product` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `setoran_awal` bigint(20) NOT NULL,
  `tanggal_buka` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rekening`
--

INSERT INTO `rekening` (`id`, `nasabah_id`, `admin_id`, `jenis_product`, `setoran_awal`, `tanggal_buka`, `created_at`, `updated_at`) VALUES
('1234567890', '1209239834874576', 1, 'Mudharabah', 500000, '2021-07-15', NULL, NULL),
('1234567891', '23712323434545656', 1, 'Mudharabah', 600000, '2021-07-15', NULL, NULL),
('1234567892', '1234567890654732', 1, 'Mudharabah', 600000, '2021-07-15', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pembiayaan_id` bigint(20) UNSIGNED NOT NULL,
  `nasabah_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `debit` bigint(20) UNSIGNED NOT NULL,
  `kredit` bigint(20) UNSIGNED NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `pembiayaan_id`, `nasabah_id`, `tanggal_transaksi`, `debit`, `kredit`, `keterangan`, `created_at`, `updated_at`) VALUES
(54, 17, '23712323434545656', '2021-07-15', 0, 15000000, 'Pembiayaan Mudharabah', NULL, NULL),
(55, 17, '23712323434545656', '2021-07-15', 7000000, 0, 'Angsuran Mudharabah', NULL, NULL),
(56, 17, '23712323434545656', '2021-07-15', 600000, 0, 'Pendapatan BMT', NULL, NULL),
(57, 17, '23712323434545656', '2021-07-15', 0, 400000, 'Pendapatan Nasabah', NULL, NULL),
(58, 18, '1234567890654732', '2021-07-15', 0, 12000000, 'Pembiayaan Mudharabah', NULL, NULL),
(59, 18, '1234567890654732', '2021-07-15', 1000000, 0, 'Angsuran Mudharabah', NULL, NULL),
(60, 18, '1234567890654732', '2021-07-15', 600000, 0, 'Pendapatan BMT', NULL, NULL),
(61, 18, '1234567890654732', '2021-07-15', 0, 400000, 'Pendapatan Nasabah', NULL, NULL),
(62, 18, '1234567890654732', '2021-07-15', 1000000, 0, 'Angsuran Mudharabah', NULL, NULL),
(63, 18, '1234567890654732', '2021-07-15', 600000, 0, 'Pendapatan BMT', NULL, NULL),
(64, 18, '1234567890654732', '2021-07-15', 0, 400000, 'Pendapatan Nasabah', NULL, NULL),
(65, 18, '1234567890654732', '2021-07-15', 1000000, 0, 'Angsuran Mudharabah', NULL, NULL),
(66, 18, '1234567890654732', '2021-07-15', 600000, 0, 'Pendapatan BMT', NULL, NULL),
(67, 18, '1234567890654732', '2021-07-15', 0, 400000, 'Pendapatan Nasabah', NULL, NULL),
(68, 18, '1234567890654732', '2021-07-15', 1000000, 0, 'Angsuran Mudharabah', NULL, NULL),
(69, 18, '1234567890654732', '2021-07-15', 600000, 0, 'Pendapatan BMT', NULL, NULL),
(70, 18, '1234567890654732', '2021-07-15', 0, 400000, 'Pendapatan Nasabah', NULL, NULL),
(71, 18, '1234567890654732', '2021-07-15', 1000000, 0, 'Angsuran Mudharabah', NULL, NULL),
(72, 18, '1234567890654732', '2021-07-15', 600000, 0, 'Pendapatan BMT', NULL, NULL),
(73, 18, '1234567890654732', '2021-07-15', 0, 400000, 'Pendapatan Nasabah', NULL, NULL),
(74, 18, '1234567890654732', '2021-07-15', 1000000, 0, 'Angsuran Mudharabah', NULL, NULL),
(75, 18, '1234567890654732', '2021-07-15', 600000, 0, 'Pendapatan BMT', NULL, NULL),
(76, 18, '1234567890654732', '2021-07-15', 0, 400000, 'Pendapatan Nasabah', NULL, NULL),
(77, 18, '1234567890654732', '2021-07-15', 1000000, 0, 'Angsuran Mudharabah', NULL, NULL),
(78, 18, '1234567890654732', '2021-07-15', 600000, 0, 'Pendapatan BMT', NULL, NULL),
(79, 18, '1234567890654732', '2021-07-15', 0, 400000, 'Pendapatan Nasabah', NULL, NULL),
(80, 18, '1234567890654732', '2021-07-15', 1000000, 0, 'Angsuran Mudharabah', NULL, NULL),
(81, 18, '1234567890654732', '2021-07-15', 600000, 0, 'Pendapatan BMT', NULL, NULL),
(82, 18, '1234567890654732', '2021-07-15', 0, 400000, 'Pendapatan Nasabah', NULL, NULL),
(83, 18, '1234567890654732', '2021-07-15', 1000000, 0, 'Angsuran Mudharabah', NULL, NULL),
(84, 18, '1234567890654732', '2021-07-15', 600000, 0, 'Pendapatan BMT', NULL, NULL),
(85, 18, '1234567890654732', '2021-07-15', 0, 400000, 'Pendapatan Nasabah', NULL, NULL),
(86, 18, '1234567890654732', '2021-07-15', 1000000, 0, 'Angsuran Mudharabah', NULL, NULL),
(87, 18, '1234567890654732', '2021-07-15', 600000, 0, 'Pendapatan BMT', NULL, NULL),
(88, 18, '1234567890654732', '2021-07-15', 0, 400000, 'Pendapatan Nasabah', NULL, NULL),
(89, 18, '1234567890654732', '2021-07-15', 1000000, 0, 'Angsuran Mudharabah', NULL, NULL),
(90, 18, '1234567890654732', '2021-07-15', 600000, 0, 'Pendapatan BMT', NULL, NULL),
(91, 18, '1234567890654732', '2021-07-15', 0, 400000, 'Pendapatan Nasabah', NULL, NULL),
(92, 18, '1234567890654732', '2021-07-15', 1000000, 0, 'Angsuran Mudharabah', NULL, NULL),
(93, 18, '1234567890654732', '2021-07-15', 600000, 0, 'Pendapatan BMT', NULL, NULL),
(94, 18, '1234567890654732', '2021-07-15', 0, 400000, 'Pendapatan Nasabah', NULL, NULL),
(95, 18, '1234567890654732', '2021-07-15', 500000, 0, 'Pendapatan BMT', NULL, NULL),
(96, 18, '1234567890654732', '2021-07-15', 0, 500000, 'Pendapatan Nasabah', NULL, NULL),
(97, 17, '23712323434545656', '2021-07-16', 7000000, 0, 'Angsuran Mudharabah', NULL, NULL),
(98, 17, '23712323434545656', '2021-07-16', 600000, 0, 'Pendapatan BMT', NULL, NULL),
(99, 17, '23712323434545656', '2021-07-16', 0, 400000, 'Pendapatan Nasabah', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_username_unique` (`username`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `manager_email_unique` (`email`),
  ADD UNIQUE KEY `manager_username_unique` (`username`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nasabah`
--
ALTER TABLE `nasabah`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nasabah_username_unique` (`username`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pembiayaan`
--
ALTER TABLE `pembiayaan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pembiayaan_nasabah_id_foreign` (`nasabah_id`),
  ADD KEY `pembiayaan_rekening_id_foreign` (`rekening_id`),
  ADD KEY `pembiayaan_manager_id_foreign` (`manager_id`),
  ADD KEY `pembiayaan_admin_id_foreign` (`admin_id`);

--
-- Indexes for table `rekening`
--
ALTER TABLE `rekening`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `rekening_nasabah_id_foreign` (`nasabah_id`),
  ADD KEY `rekening_admin_id_foreign` (`admin_id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaksi_nasabah_id_foreign` (`nasabah_id`),
  ADD KEY `transaksi_pembiayaan_id_foreign` (`pembiayaan_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `manager`
--
ALTER TABLE `manager`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `pembiayaan`
--
ALTER TABLE `pembiayaan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pembiayaan`
--
ALTER TABLE `pembiayaan`
  ADD CONSTRAINT `pembiayaan_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pembiayaan_manager_id_foreign` FOREIGN KEY (`manager_id`) REFERENCES `manager` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pembiayaan_nasabah_id_foreign` FOREIGN KEY (`nasabah_id`) REFERENCES `nasabah` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pembiayaan_rekening_id_foreign` FOREIGN KEY (`rekening_id`) REFERENCES `rekening` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rekening`
--
ALTER TABLE `rekening`
  ADD CONSTRAINT `rekening_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `rekening_nasabah_id_foreign` FOREIGN KEY (`nasabah_id`) REFERENCES `nasabah` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_nasabah_id_foreign` FOREIGN KEY (`nasabah_id`) REFERENCES `nasabah` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaksi_pembiayaan_id_foreign` FOREIGN KEY (`pembiayaan_id`) REFERENCES `pembiayaan` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
