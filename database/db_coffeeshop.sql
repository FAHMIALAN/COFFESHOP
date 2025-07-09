-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 09, 2025 at 09:59 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_coffeeshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint UNSIGNED NOT NULL,
  `version` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `class` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `group` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `namespace` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `time` int NOT NULL,
  `batch` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `username`, `password`) VALUES
(1, 'alan', '$2y$10$UIGB7n9ZWa.CWv3h46t0VOrxmnFb61I2bBEm8LNpesFHXIeng5Gra'),
(2, 'admin', '$2y$10$hQjgWG5JaI7AgxhCrUAE8uyL.r8LbxAKckW..OCvVoY4WcFKfar9e');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_detail_pesanan`
--

CREATE TABLE `tbl_detail_pesanan` (
  `id` int NOT NULL,
  `id_pesanan` int NOT NULL,
  `id_produk` int NOT NULL,
  `jumlah` int NOT NULL,
  `harga_satuan` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_detail_pesanan`
--

INSERT INTO `tbl_detail_pesanan` (`id`, `id_pesanan`, `id_produk`, `jumlah`, `harga_satuan`) VALUES
(30, 30, 10, 1, 25000),
(31, 31, 9, 1, 28000),
(32, 32, 3, 1, 25000),
(33, 33, 1, 1, 18000),
(34, 34, 11, 1, 28000),
(35, 34, 5, 1, 28000),
(36, 34, 3, 1, 25000),
(37, 35, 1, 1, 18000),
(38, 35, 3, 1, 25000),
(39, 35, 7, 1, 25000),
(40, 36, 11, 1, 28000),
(41, 37, 9, 1, 28000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pesanan`
--

CREATE TABLE `tbl_pesanan` (
  `id` int NOT NULL,
  `order_id` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `nama_pembeli` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `no_hp` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_general_ci NOT NULL,
  `total_harga` int NOT NULL,
  `status_pembayaran` enum('pending','menunggu konfirmasi','diproses','dikirim','selesai','dibatalkan') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'pending',
  `tipe_pembayaran` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `bukti_pembayaran` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `waktu_pesan` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_pesanan`
--

INSERT INTO `tbl_pesanan` (`id`, `order_id`, `nama_pembeli`, `no_hp`, `alamat`, `total_harga`, `status_pembayaran`, `tipe_pembayaran`, `bukti_pembayaran`, `waktu_pesan`) VALUES
(30, 'COFFEE-1752000050', 'Arnesta Difa', '081223344556', 'Jl. Banaran Barat rt03, Nogosari, Sumberagung, Kec. Jetis, Kabupaten Bantul', 25000, 'selesai', NULL, NULL, '2025-07-08 18:40:50'),
(31, 'COFFEE-1752001125', 'Salma Putri', '081225460557', 'Jl. Banaran Barat rt03, Nogosari, Sumberagung, Kec. Jetis,', 28000, 'selesai', NULL, NULL, '2025-07-08 18:58:45'),
(32, 'COFFEE-1752001583', 'Alan Aja', '087760651757', 'Jl. Banaran Barat rt03, Nogosari, Sumberagung, Kec. Jetis,', 25000, 'dikirim', NULL, NULL, '2025-07-08 19:06:23'),
(33, 'COFFEE-1752001922', 'Fahmi Alan', '087760651757', 'Jl. Banaran Barat rt03, Nogosari, Sumberagung, Kec. Jetis,', 18000, 'selesai', NULL, 'COFFEE-1752001922.jpg', '2025-07-08 19:12:02'),
(34, 'COFFEE-1752051805', 'Ulul Azmi', '0856518716', 'Jl. Tri Dharma No.896 A, gendeng, Baciro, Kec. Gondokusuman, Kota Yogyakarta, Daerah Istimewa Yogyakarta\r\n', 81000, 'selesai', NULL, 'COFFEE-1752051805.jpg', '2025-07-09 09:03:25'),
(35, 'COFFEE-1752051971', 'Ahmad Sidiq', '08565187162541', 'Jl. Ambarkusumo No.25, Papringan, Caturtunggal, Kec. Depok, Kabupaten Sleman, Daerah Istimewa Yogyakarta', 68000, 'selesai', NULL, 'COFFEE-1752051971.jpg', '2025-07-09 09:06:11'),
(36, 'COFFEE-1752052153', 'Naifah Raihana', '087760651757', 'Maesan, Tamanan, Kec. Banguntapan, Kabupaten Bantul, Daerah Istimewa Yogyakarta', 28000, 'dibatalkan', NULL, NULL, '2025-07-09 09:09:13'),
(37, 'COFFEE-1752052460', 'Ceisa Saffa', '0813345762547', 'Baran, Srihardono, Kec. Pundong, Kabupaten Bantul, Daerah Istimewa Yogyakarta', 28000, 'selesai', NULL, 'COFFEE-1752052460.jpg', '2025-07-09 09:14:20');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_produk`
--

CREATE TABLE `tbl_produk` (
  `id` int NOT NULL,
  `nama_produk` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_general_ci,
  `harga` int NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `kategori` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `stok` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_produk`
--

INSERT INTO `tbl_produk` (`id`, `nama_produk`, `deskripsi`, `harga`, `gambar`, `kategori`, `stok`, `created_at`, `updated_at`) VALUES
(1, 'Espresso', 'Kopi hitam pekat satu shot, cocok untuk pecinta rasa kuat dan bold', 18000, '1751903176_0f4e2307c95efb0450fd.jpg', 'Espresso', 100, '2025-07-06 20:07:05', '2025-07-07 15:46:16'),
(2, 'Americano', 'Espresso dicampur air panas atau mix dengan es, rasa ringan namun tetap strong', 20000, '1751903829_25471ba8b0dae372eca7.jpg', 'Espresso', 100, '2025-07-06 20:10:22', '2025-07-07 15:57:09'),
(3, 'Cappuccino', 'Perpaduan espresso, susu, dan foam yang creamy dan lembut', 25000, '1751858357_82cf72d5f49372114d3f.jpg', 'Espresso', 100, '2025-07-06 20:19:17', '2025-07-06 20:19:17'),
(4, 'Cafe Latte', 'Espresso dengan banyak susu, lebih ringan dan manis alami', 25000, '1751858404_ec98cea0d760cf34dbf5.jpg', 'Espresso', 100, '2025-07-06 20:20:04', '2025-07-06 20:20:04'),
(5, 'Mocha', 'Espresso + coklat + susu, cocok buat kamu yang suka manis', 28000, '1751858453_74823f3d59fa787418a0.jpg', 'Espresso', 100, '2025-07-06 20:20:53', '2025-07-06 20:20:53'),
(6, 'Caramel Macchiato', 'Espresso, susu, foam, dan sirup karamel yang harum dan nikmat', 30000, '1751858491_373ab9cf190098f84cd6.jpg', 'Espresso', 100, '2025-07-06 20:21:31', '2025-07-06 20:21:31'),
(7, 'Kopi Susu Gula Aren', 'Espresso + susu + gula aren, rasa manis alami dan creamy', 25000, '1751902833_c89f4a4d9ddc5ab75838.jpg', 'Signature', 100, '2025-07-06 20:50:05', '2025-07-07 15:40:33'),
(8, 'Es Kopi Banaran', 'Signature drink khas kamu, bisa dibuat pakai bahan lokal misalnya', 25000, '1751860258_67ce44fcc6bc55418bcb.jpg', 'Signature', 100, '2025-07-06 20:50:58', '2025-07-06 20:50:58'),
(9, 'Matcha Latte', 'Teh hijau Jepang dengan susu, rasa earthy dan lembut', 28000, '1751860341_b04b1d34f99c40ae0736.jpg', 'Non-Coffee', 100, '2025-07-06 20:52:21', '2025-07-06 20:52:21'),
(10, 'Chocolate', 'Cokelat panas dingin, manis dan bikin rileks', 25000, '1751860389_626720ea7d536f227fa1.jpg', 'Non-Coffee', 100, '2025-07-06 20:53:09', '2025-07-06 20:53:09'),
(11, 'Red Velvet Latte', 'Minuman susu rasa red velvet yang lembut', 28000, '1751902617_5df6026fb28779687a05.jpg', 'Non-Coffee', 100, '2025-07-06 20:54:35', '2025-07-07 15:36:57'),
(12, 'Thai Tea', 'Teh khas Thailand dengan susu kental manis', 22000, '1751860527_89c5a3931f0e61e4fa0e.jpg', 'Non-Coffee', 100, '2025-07-06 20:55:27', '2025-07-06 20:55:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `tbl_detail_pesanan`
--
ALTER TABLE `tbl_detail_pesanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_pesanan`
--
ALTER TABLE `tbl_pesanan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `order_id` (`order_id`);

--
-- Indexes for table `tbl_produk`
--
ALTER TABLE `tbl_produk`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_detail_pesanan`
--
ALTER TABLE `tbl_detail_pesanan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `tbl_pesanan`
--
ALTER TABLE `tbl_pesanan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `tbl_produk`
--
ALTER TABLE `tbl_produk`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
