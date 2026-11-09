-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 07, 2026 at 08:36 PM
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
-- Database: `db_sistem_terintegrasi`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `reference_no` varchar(255) DEFAULT NULL,
  `action_type` varchar(255) NOT NULL DEFAULT 'Buat',
  `transaction_type` varchar(255) NOT NULL DEFAULT 'Lainnya',
  `action` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`id`, `user_id`, `reference_no`, `action_type`, `transaction_type`, `action`, `description`, `ip_address`, `created_at`, `updated_at`) VALUES
(1, 1, 'SYS-INIT', 'Buat', 'Kategori Barang', 'Inisialisasi Master Data', 'Membuat kategori peralatan sekolah', '127.0.0.1', '2026-11-03 13:19:29', '2026-11-03 13:19:29'),
(2, 1, 'INV-1793712204299', 'Buat', 'Faktur Penjualan', 'Buat Faktur Penjualan', 'Memproses transaksi INV-1793712204299 senilai Rp 13.500', '127.0.0.1', '2026-11-03 13:23:24', '2026-11-03 13:23:24'),
(3, 1, 'INV-1793712467421', 'Buat', 'Faktur Penjualan', 'Buat Faktur Penjualan', 'Memproses transaksi INV-1793712467421 senilai Rp 14.500', '127.0.0.1', '2026-11-03 13:27:47', '2026-11-03 13:27:47'),
(4, 1, 'INV-1793713059250', 'Buat', 'Faktur Penjualan', 'Buat Faktur Penjualan', 'Memproses transaksi INV-1793713059250 senilai Rp 26.000', '127.0.0.1', '2026-11-03 13:37:39', '2026-11-03 13:37:39'),
(5, 1, 'INV-1793714068845', 'Buat', 'Faktur Penjualan', 'Buat Faktur Penjualan', 'Memproses transaksi INV-1793714068845 senilai Rp 48.500', '127.0.0.1', '2026-11-03 13:54:28', '2026-11-03 13:54:28'),
(6, 1, 'MUT-3', 'Buat', 'Mutasi Stok', 'Buat Mutasi Stok', 'Barang Masuk: Refill stok Pensil 2B Faber-Castell sejumlah +6', '127.0.0.1', '2026-11-03 15:50:51', '2026-11-03 15:50:51'),
(7, 1, 'MUT-4', 'Buat', 'Mutasi Stok', 'Buat Mutasi Stok', 'Barang Masuk: Refill stok Penghapus Joyko Kecil sejumlah +9', '127.0.0.1', '2026-11-03 15:51:02', '2026-11-03 15:51:02'),
(8, 1, 'EXP-ITEM', 'Buat', 'Daftar Barang', 'Buat Daftar Barang', 'Mengekspor data barang ke file CSV', '127.0.0.1', '2026-11-03 15:52:41', '2026-11-03 15:52:41'),
(9, 1, 'IMP-ITEM', 'Buat', 'Daftar Barang', 'Buat Daftar Barang', 'Mengimpor 20 barang dari CSV', '127.0.0.1', '2026-11-03 15:55:52', '2026-11-03 15:55:52'),
(10, 1, 'IMP-ITEM', 'Buat', 'Daftar Barang', 'Buat Daftar Barang', 'Mengimpor 20 barang dari CSV', '127.0.0.1', '2026-11-03 16:09:36', '2026-11-03 16:09:36'),
(11, 1, 'IMP-ITEM', 'Buat', 'Daftar Barang', 'Buat Daftar Barang', 'Mengimpor 20 barang dari CSV (stok diakumulasikan)', '127.0.0.1', '2026-11-03 16:14:05', '2026-11-03 16:14:05'),
(12, 1, 'IMP-ITEM', 'Buat', 'Daftar Barang', 'Buat Daftar Barang', 'Mengimpor 7 barang dari CSV (stok diakumulasikan)', '127.0.0.1', '2026-11-03 16:20:12', '2026-11-03 16:20:12'),
(13, 1, 'IMP-ITEM', 'Buat', 'Daftar Barang', 'Buat Daftar Barang', 'Mengimpor 11 barang dari CSV (stok diakumulasikan)', '127.0.0.1', '2026-11-03 16:29:24', '2026-11-03 16:29:24'),
(14, 1, 'IMP-ITEM', 'Buat', 'Daftar Barang', 'Buat Daftar Barang', 'Mengimpor 10 barang dari CSV', '127.0.0.1', '2026-11-03 16:33:50', '2026-11-03 16:33:50'),
(15, 1, 'MUT-5', 'Hapus', 'Mutasi Stok', 'Hapus Mutasi Stok', 'Barang Keluar: Pengurangan stok Buku Tulis SiDu 38 Lembar sejumlah -8100', '127.0.0.1', '2026-11-03 16:36:59', '2026-11-03 16:36:59'),
(16, 1, 'MUT-6', 'Hapus', 'Mutasi Stok', 'Hapus Mutasi Stok', 'Barang Keluar: Pengurangan stok Buku Gambar A4 sejumlah -8060', '127.0.0.1', '2026-11-03 16:37:31', '2026-11-03 16:37:31'),
(17, 1, 'MUT-7', 'Hapus', 'Mutasi Stok', 'Hapus Mutasi Stok', 'Barang Keluar: Pengurangan stok Correction Tape (Tipe-X) sejumlah -6000', '127.0.0.1', '2026-11-03 16:38:03', '2026-11-03 16:38:03'),
(18, 1, 'MUT-8', 'Hapus', 'Mutasi Stok', 'Hapus Mutasi Stok', 'Barang Keluar: Pengurangan stok Sampul Buku Coklat sejumlah -2000', '127.0.0.1', '2026-11-03 16:39:19', '2026-11-03 16:39:19'),
(19, 1, 'MUT-9', 'Hapus', 'Mutasi Stok', 'Hapus Mutasi Stok', 'Barang Keluar: Pengurangan stok Sampul Plastik Bening sejumlah -1000', '127.0.0.1', '2026-11-03 16:39:38', '2026-11-03 16:39:38'),
(20, 1, 'MUT-10', 'Hapus', 'Mutasi Stok', 'Hapus Mutasi Stok', 'Barang Keluar: Pengurangan stok Kertas Lipat Origami sejumlah -250', '127.0.0.1', '2026-11-03 16:40:55', '2026-11-03 16:40:55'),
(21, 1, 'MUT-11', 'Hapus', 'Mutasi Stok', 'Hapus Mutasi Stok', 'Barang Keluar: Pengurangan stok Kertas Lipat Origami sejumlah -2300', '127.0.0.1', '2026-11-03 16:41:27', '2026-11-03 16:41:27'),
(22, 1, 'BACKUP-DB', 'Buat', 'Pengaturan Sistem', 'Buat Pengaturan Sistem', 'Mengunduh backup database SQL', '127.0.0.1', '2026-11-04 13:11:56', '2026-11-04 13:11:56'),
(23, 1, 'BACKUP-DB', 'Buat', 'Pengaturan Sistem', 'Buat Pengaturan Sistem', 'Mengunduh backup database SQL', '127.0.0.1', '2026-11-04 13:24:54', '2026-11-04 13:24:54'),
(24, 1, 'INV-1793800028389', 'Buat', 'Faktur Penjualan', 'Buat Faktur Penjualan', 'Memproses transaksi INV-1793800028389 senilai Rp 88.500', '127.0.0.1', '2026-11-04 13:47:08', '2026-11-04 13:47:08'),
(25, 1, 'MUT-12', 'Hapus', 'Mutasi Stok', 'Hapus Mutasi Stok', 'Barang Keluar: Pengurangan stok Pensil 2B Faber-Castell sejumlah -90', '127.0.0.1', '2026-11-04 13:55:05', '2026-11-04 13:55:05'),
(26, 1, 'MUT-13', 'Hapus', 'Mutasi Stok', 'Hapus Mutasi Stok', 'Barang Keluar: Pengurangan stok Pulpen Hitam Snowman sejumlah -85', '127.0.0.1', '2026-11-04 13:55:23', '2026-11-04 13:55:23'),
(27, 1, 'MUT-14', 'Hapus', 'Mutasi Stok', 'Hapus Mutasi Stok', 'Barang Keluar: Pengurangan stok Sampul Plastik Bening sejumlah -700', '127.0.0.1', '2026-11-04 13:56:30', '2026-11-04 13:56:30'),
(28, 1, 'MUT-15', 'Hapus', 'Mutasi Stok', 'Hapus Mutasi Stok', 'Barang Keluar: Pengurangan stok Sampul Buku Coklat sejumlah -195', '127.0.0.1', '2026-11-04 13:56:52', '2026-11-04 13:56:52'),
(29, 1, 'MUT-16', 'Hapus', 'Mutasi Stok', 'Hapus Mutasi Stok', 'Barang Keluar: Pengurangan stok Pensil Warna 12 Kayu sejumlah -45', '127.0.0.1', '2026-11-04 13:57:31', '2026-11-04 13:57:31'),
(30, 1, 'MUT-17', 'Hapus', 'Mutasi Stok', 'Hapus Mutasi Stok', 'Barang Keluar: Pengurangan stok Krayon Hexagonal 12 Warna sejumlah -42', '127.0.0.1', '2026-11-04 13:58:02', '2026-11-04 13:58:02'),
(31, 1, 'MUT-18', 'Hapus', 'Mutasi Stok', 'Hapus Mutasi Stok', 'Barang Keluar: Pengurangan stok Rautan Pensil Bulat sejumlah -65', '127.0.0.1', '2026-11-04 13:58:39', '2026-11-04 13:58:39'),
(32, 1, 'MUT-19', 'Hapus', 'Mutasi Stok', 'Hapus Mutasi Stok', 'Barang Keluar: Pengurangan stok Penghapus Joyko Kecil sejumlah -73', '127.0.0.1', '2026-11-04 13:59:10', '2026-11-04 13:59:10'),
(33, 1, 'MUT-20', 'Hapus', 'Mutasi Stok', 'Hapus Mutasi Stok', 'Barang Keluar: Pengurangan stok Penggaris Besi 15cm sejumlah -65', '127.0.0.1', '2026-11-04 13:59:42', '2026-11-04 13:59:42'),
(34, 1, 'MUT-21', 'Hapus', 'Mutasi Stok', 'Hapus Mutasi Stok', 'Barang Keluar: Pengurangan stok Jangka Matematika sejumlah -45', '127.0.0.1', '2026-11-04 14:00:09', '2026-11-04 14:00:09'),
(35, 1, 'INV-1793800982192', 'Buat', 'Faktur Penjualan', 'Buat Faktur Penjualan', 'Memproses transaksi INV-1793800982192 senilai Rp 5.000', '127.0.0.1', '2026-11-04 14:03:02', '2026-11-04 14:03:02'),
(36, 1, 'INV-1793801977324', 'Buat', 'Faktur Penjualan', 'Buat Faktur Penjualan', 'Memproses transaksi INV-1793801977324 senilai Rp 93.500', '127.0.0.1', '2026-11-04 14:19:37', '2026-11-04 14:19:37'),
(37, 1, 'INV-1793801993663', 'Buat', 'Faktur Penjualan', 'Buat Faktur Penjualan', 'Memproses transaksi INV-1793801993663 senilai Rp 29.000', '127.0.0.1', '2026-11-04 14:19:53', '2026-11-04 14:19:53'),
(38, 1, 'INV-1793802013953', 'Buat', 'Faktur Penjualan', 'Buat Faktur Penjualan', 'Memproses transaksi INV-1793802013953 senilai Rp 51.000', '127.0.0.1', '2026-11-04 14:20:13', '2026-11-04 14:20:13'),
(39, 1, 'INV-1793802046988', 'Buat', 'Faktur Penjualan', 'Buat Faktur Penjualan', 'Memproses transaksi INV-1793802046988 senilai Rp 25.000', '127.0.0.1', '2026-11-04 14:20:46', '2026-11-04 14:20:46'),
(40, 1, 'INV-1793802073388', 'Buat', 'Faktur Penjualan', 'Buat Faktur Penjualan', 'Memproses transaksi INV-1793802073388 senilai Rp 29.000', '127.0.0.1', '2026-11-04 14:21:13', '2026-11-04 14:21:13'),
(41, 1, 'INV-1793892497221', 'Buat', 'Faktur Penjualan', 'Buat Faktur Penjualan', 'Memproses transaksi INV-1793892497221 senilai Rp 35.200', '127.0.0.1', '2026-11-05 15:28:17', '2026-11-05 15:28:17'),
(42, 1, 'INV-1793892724329', 'Buat', 'Faktur Penjualan', 'Buat Faktur Penjualan', 'Memproses transaksi INV-1793892724329 senilai Rp 22.550', '127.0.0.1', '2026-11-05 15:32:04', '2026-11-05 15:32:04'),
(43, 1, 'INV-1793893835513', 'Buat', 'Faktur Penjualan', 'Buat Faktur Penjualan', 'Memproses transaksi INV-1793893835513 senilai Rp 31.050', '127.0.0.1', '2026-11-05 15:50:35', '2026-11-05 15:50:35'),
(44, 1, 'BACKUP-DB', 'Buat', 'Pengaturan Sistem', 'Buat Pengaturan Sistem', 'Mengunduh backup database SQL', '127.0.0.1', '2026-11-05 15:51:11', '2026-11-05 15:51:11'),
(45, 1, 'BACKUP-DB', 'Buat', 'Pengaturan Sistem', 'Buat Pengaturan Sistem', 'Mengunduh backup database SQL', '127.0.0.1', '2026-11-05 16:29:32', '2026-11-05 16:29:32'),
(46, 1, 'BACKUP-DB', 'Buat', 'Pengaturan Sistem', 'Buat Pengaturan Sistem', 'Mengunduh backup database SQL', '127.0.0.1', '2026-11-05 16:31:42', '2026-11-05 16:31:42'),
(47, 3, 'INV-1794038916698', 'Buat', 'Faktur Penjualan', 'Buat Faktur Penjualan', 'Memproses transaksi INV-1794038916698 senilai Rp 13.800', '127.0.0.1', '2026-11-07 08:08:36', '2026-11-07 08:08:36'),
(48, 3, 'INV-1794038937579', 'Buat', 'Faktur Penjualan', 'Buat Faktur Penjualan', 'Memproses transaksi INV-1794038937579 senilai Rp 31.050', '127.0.0.1', '2026-11-07 08:08:57', '2026-11-07 08:08:57'),
(49, 2, 'MUT-22', 'Buat', 'Mutasi Stok', 'Buat Mutasi Stok', 'Barang Masuk: Refill stok Penggaris Besi 15cm sejumlah +7', '127.0.0.1', '2026-11-07 09:23:39', '2026-11-07 09:23:39'),
(50, 2, 'MUT-23', 'Hapus', 'Mutasi Stok', 'Hapus Mutasi Stok', 'Barang Keluar: Pengurangan stok Pulpen Hitam Snowman sejumlah -2', '127.0.0.1', '2026-11-07 09:24:06', '2026-11-07 09:24:06'),
(51, 2, 'MUT-24', 'Hapus', 'Mutasi Stok', 'Hapus Mutasi Stok', 'Barang Keluar: Pengurangan stok Kertas Lipat Origami sejumlah -40', '127.0.0.1', '2026-11-07 09:24:24', '2026-11-07 09:24:24'),
(52, 2, 'MUT-25', 'Hapus', 'Mutasi Stok', 'Hapus Mutasi Stok', 'Barang Keluar: Pengurangan stok Buku Tulis SiDu 38 Lembar sejumlah -42', '127.0.0.1', '2026-11-07 09:24:41', '2026-11-07 09:24:41'),
(53, 2, 'MUT-26', 'Hapus', 'Mutasi Stok', 'Hapus Mutasi Stok', 'Barang Keluar: Pengurangan stok Correction Tape (Tipe-X) sejumlah -45', '127.0.0.1', '2026-11-07 09:24:57', '2026-11-07 09:24:57'),
(54, 2, 'MUT-27', 'Hapus', 'Mutasi Stok', 'Hapus Mutasi Stok', 'Barang Keluar: Pengurangan stok Buku Gambar A4 sejumlah -41', '127.0.0.1', '2026-11-07 09:25:09', '2026-11-07 09:25:09'),
(55, 2, 'MUT-28', 'Hapus', 'Mutasi Stok', 'Hapus Mutasi Stok', 'Barang Keluar: Pengurangan stok Spidol Hitam Boardmarker sejumlah -40', '127.0.0.1', '2026-11-07 09:25:20', '2026-11-07 09:25:20'),
(56, 2, 'MUT-29', 'Hapus', 'Mutasi Stok', 'Hapus Mutasi Stok', 'Barang Keluar: Pengurangan stok Sampul Plastik Bening sejumlah -38', '127.0.0.1', '2026-11-07 09:25:34', '2026-11-07 09:25:34'),
(57, 1, 'MUT-30', 'Buat', 'Mutasi Stok', 'Buat Mutasi Stok', 'Barang Masuk: Refill stok Pulpen Hitam Snowman sejumlah +5', '127.0.0.1', '2026-11-07 13:14:36', '2026-11-07 13:14:36'),
(58, 1, 'INV-1794058435311', 'Buat', 'Faktur Penjualan', 'Buat Faktur Penjualan', 'Memproses transaksi INV-1794058435311 senilai Rp 110.975', '127.0.0.1', '2026-11-07 13:33:55', '2026-11-07 13:33:55'),
(59, 1, 'INV-1794058800877', 'Buat', 'Faktur Penjualan', 'Buat Faktur Penjualan', 'Memproses transaksi INV-1794058800877 senilai Rp 44.850', '127.0.0.1', '2026-11-07 13:40:00', '2026-11-07 13:40:00'),
(60, 1, 'BACKUP-DB', 'Buat', 'Pengaturan Sistem', 'Buat Pengaturan Sistem', 'Mengunduh backup database SQL', '127.0.0.1', '2026-11-07 15:37:18', '2026-11-07 15:37:18'),
(61, 1, 'INV-1794069078659', 'Buat', 'Faktur Penjualan', 'Buat Faktur Penjualan', 'Memproses transaksi INV-1794069078659 senilai Rp 23.575', '127.0.0.1', '2026-11-07 16:31:18', '2026-11-07 16:31:18'),
(62, 1, 'EXP-ITEM', 'Buat', 'Daftar Barang', 'Buat Daftar Barang', 'Mengekspor data barang ke file CSV', '127.0.0.1', '2026-11-07 16:43:01', '2026-11-07 16:43:01'),
(63, 1, 'EXP-ITEM', 'Buat', 'Daftar Barang', 'Buat Daftar Barang', 'Mengekspor data barang ke file CSV', '127.0.0.1', '2026-11-07 16:46:08', '2026-11-07 16:46:08'),
(64, 1, 'IMP-ITEM', 'Buat', 'Daftar Barang', 'Buat Daftar Barang', 'Mengimpor 20 barang dari CSV', '127.0.0.1', '2026-11-07 16:46:25', '2026-11-07 16:46:25'),
(65, 1, 'IMP-ITEM', 'Buat', 'Daftar Barang', 'Buat Daftar Barang', 'Mengimpor 20 barang dari CSV', '127.0.0.1', '2026-11-07 16:46:55', '2026-11-07 16:46:55'),
(66, 1, 'IMP-ITEM', 'Buat', 'Daftar Barang', 'Buat Daftar Barang', 'Mengimpor 20 barang dari CSV', '127.0.0.1', '2026-11-07 16:47:17', '2026-11-07 16:47:17'),
(67, 1, 'IMP-ITEM', 'Buat', 'Daftar Barang', 'Buat Daftar Barang', 'Mengimpor 20 barang dari CSV', '127.0.0.1', '2026-11-07 16:48:16', '2026-11-07 16:48:16'),
(68, 1, 'IMP-ITEM', 'Buat', 'Daftar Barang', 'Buat Daftar Barang', 'Mengimpor 20 barang dari CSV', '127.0.0.1', '2026-11-07 16:49:23', '2026-11-07 16:49:23'),
(69, 1, 'IMP-ITEM', 'Buat', 'Daftar Barang', 'Buat Daftar Barang', 'Mengimpor 20 barang dari CSV', '127.0.0.1', '2026-11-07 16:50:55', '2026-11-07 16:50:55'),
(70, 3, 'INV-1794070654763', 'Buat', 'Faktur Penjualan', 'Buat Faktur Penjualan', 'Memproses transaksi INV-1794070654763 senilai Rp 21.275', '127.0.0.1', '2026-11-07 16:57:34', '2026-11-07 16:57:34'),
(71, 2, 'INV-1794070706482', 'Buat', 'Faktur Penjualan', 'Buat Faktur Penjualan', 'Memproses transaksi INV-1794070706482 senilai Rp 33.925', '127.0.0.1', '2026-11-07 16:58:26', '2026-11-07 16:58:26'),
(72, 3, 'INV-1794071321681', 'Buat', 'Faktur Penjualan', 'Buat Faktur Penjualan', 'Memproses transaksi INV-1794071321681 senilai Rp 99.475', '127.0.0.1', '2026-11-07 17:08:41', '2026-11-07 17:08:41'),
(73, 3, 'INV-1794071758155', 'Buat', 'Faktur Penjualan', 'Buat Faktur Penjualan', 'Memproses transaksi INV-1794071758155 senilai Rp 32.200', '127.0.0.1', '2026-11-07 17:15:58', '2026-11-07 17:15:58'),
(74, 3, 'INV-1794073503614', 'Buat', 'Faktur Penjualan', 'Buat Faktur Penjualan', 'Memproses transaksi INV-1794073503614 senilai Rp 32.200', '127.0.0.1', '2026-11-07 17:45:03', '2026-11-07 17:45:03'),
(75, 3, 'INV-1794073546433', 'Buat', 'Faktur Penjualan', 'Buat Faktur Penjualan', 'Memproses transaksi INV-1794073546433 senilai Rp 32.200', '127.0.0.1', '2026-11-07 17:45:46', '2026-11-07 17:45:46'),
(76, 3, 'INV-1794073835174', 'Buat', 'Faktur Penjualan', 'Buat Faktur Penjualan', 'Memproses transaksi INV-1794073835174 senilai Rp 33.350', '127.0.0.1', '2026-11-07 17:50:35', '2026-11-07 17:50:35'),
(77, 3, 'INV-1794074058533', 'Buat', 'Faktur Penjualan', 'Buat Faktur Penjualan', 'Memproses transaksi INV-1794074058533 senilai Rp 33.350', '127.0.0.1', '2026-11-07 17:54:18', '2026-11-07 17:54:18'),
(78, 3, 'INV-1794074136609', 'Buat', 'Faktur Penjualan', 'Buat Faktur Penjualan', 'Memproses transaksi INV-1794074136609 senilai Rp 43.125', '127.0.0.1', '2026-11-07 17:55:36', '2026-11-07 17:55:36'),
(79, 3, 'INV-1794074210368', 'Buat', 'Faktur Penjualan', 'Buat Faktur Penjualan', 'Memproses transaksi INV-1794074210368 senilai Rp 64.400', '127.0.0.1', '2026-11-07 17:56:50', '2026-11-07 17:56:50'),
(80, 1, 'INV-1794074410831', 'Buat', 'Faktur Penjualan', 'Buat Faktur Penjualan', 'Memproses transaksi INV-1794074410831 senilai Rp 30.475', '127.0.0.1', '2026-11-07 18:00:11', '2026-11-07 18:00:11'),
(81, 1, 'INV-1794074449264', 'Buat', 'Faktur Penjualan', 'Buat Faktur Penjualan', 'Memproses transaksi INV-1794074449264 senilai Rp 15.525', '127.0.0.1', '2026-11-07 18:00:49', '2026-11-07 18:00:49'),
(82, 1, 'INV-1794074589679', 'Buat', 'Faktur Penjualan', 'Buat Faktur Penjualan', 'Memproses transaksi INV-1794074589679 senilai Rp 55.200', '127.0.0.1', '2026-11-07 18:03:09', '2026-11-07 18:03:09'),
(83, 1, 'INV-1794074745648', 'Buat', 'Faktur Penjualan', 'Buat Faktur Penjualan', 'Memproses transaksi INV-1794074745648 senilai Rp 56.925', '127.0.0.1', '2026-11-07 18:05:45', '2026-11-07 18:05:45'),
(84, 1, 'INV-1794076643271', 'Buat', 'Faktur Penjualan', 'Buat Faktur Penjualan', 'Memproses transaksi INV-1794076643271 senilai Rp 11.500', '127.0.0.1', '2026-11-07 18:37:23', '2026-11-07 18:37:23'),
(85, 3, 'INV-1794078183329', 'Buat', 'Faktur Penjualan', 'Buat Faktur Penjualan', 'Memproses transaksi INV-1794078183329 senilai Rp 35.075', '127.0.0.1', '2026-11-07 19:03:03', '2026-11-07 19:03:03');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Alat Tulis', NULL, '2026-11-03 13:19:29', '2026-11-03 13:19:29'),
(2, 'Buku & Kertas', NULL, '2026-11-03 13:19:29', '2026-11-03 13:19:29'),
(3, 'Perlengkapan Gambar', NULL, '2026-11-03 13:19:29', '2026-11-03 13:19:29'),
(4, 'Aksesoris & Lainnya', NULL, '2026-11-03 13:19:29', '2026-11-03 13:19:29');

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
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `sku` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `price` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `category_id`, `sku`, `name`, `description`, `stock`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, 'ATK-001', 'Pensil 2B Faber-Castell', NULL, 57, 2500, '2026-11-03 13:19:29', '2026-11-07 19:03:03'),
(2, 1, 'ATK-002', 'Pulpen Hitam Snowman', NULL, 56, 3500, '2026-11-03 13:19:29', '2026-11-07 19:03:03'),
(3, 1, 'ATK-003', 'Penghapus Joyko Kecil', NULL, 57, 1000, '2026-11-03 13:19:29', '2026-11-07 19:03:03'),
(4, 1, 'ATK-004', 'Rautan Pensil Bulat', NULL, 54, 1500, '2026-11-03 13:19:29', '2026-11-07 19:03:03'),
(5, 1, 'ATK-005', 'Penggaris Besi 15cm', NULL, 63, 2000, '2026-11-03 13:19:29', '2026-11-07 18:00:11'),
(6, 2, 'ATK-006', 'Buku Tulis SiDu 38 Lembar', NULL, 58, 3500, '2026-11-03 13:19:29', '2026-11-07 18:00:11'),
(7, 2, 'ATK-007', 'Buku Gambar A4', NULL, 63, 5000, '2026-11-03 13:19:29', '2026-11-07 18:00:11'),
(8, 2, 'ATK-008', 'Sampul Buku Coklat', NULL, 58, 1000, '2026-11-03 13:19:29', '2026-11-07 18:00:49'),
(9, 2, 'ATK-009', 'Sampul Plastik Bening', NULL, 57, 1500, '2026-11-03 13:19:29', '2026-11-07 18:00:49'),
(10, 2, 'ATK-010', 'Kertas Lipat Origami', NULL, 55, 2500, '2026-11-03 13:19:29', '2026-11-07 18:00:49'),
(11, 1, 'ATK-011', 'Correction Tape (Tipe-X)', NULL, 60, 5000, '2026-11-03 13:19:29', '2026-11-07 17:55:36'),
(12, 1, 'ATK-012', 'Spidol Hitam Boardmarker', NULL, 55, 6500, '2026-11-03 13:19:29', '2026-11-07 18:03:09'),
(13, 4, 'ATK-013', 'Lem Kertas Stick', NULL, 88, 3500, '2026-11-03 13:19:29', '2026-11-07 17:55:36'),
(14, 4, 'ATK-014', 'Gunting Kertas Mini', NULL, 88, 4500, '2026-11-03 13:19:29', '2026-11-07 17:55:36'),
(15, 4, 'ATK-015', 'Map Plastik L', NULL, 89, 1500, '2026-11-03 13:19:29', '2026-11-07 17:55:36'),
(16, 3, 'ATK-016', 'Pensil Warna 12 Kayu', NULL, 61, 12500, '2026-11-03 13:19:29', '2026-11-07 18:03:09'),
(17, 3, 'ATK-017', 'Krayon Hexagonal 12 Warna', NULL, 54, 14000, '2026-11-03 13:19:29', '2026-11-07 19:03:03'),
(18, 3, 'ATK-018', 'Busur Derajat Plastik', NULL, 76, 2500, '2026-11-03 13:19:29', '2026-11-07 19:03:03'),
(19, 3, 'ATK-019', 'Jangka Matematika', NULL, 56, 8500, '2026-11-03 13:19:29', '2026-11-07 18:05:45'),
(20, 1, 'ATK-020', 'Stabilo Kuning', NULL, 70, 4000, '2026-11-03 13:19:29', '2026-11-07 19:03:03');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_10_31_093429_create_categories_table', 1),
(5, '2026_10_31_093437_create_items_table', 1),
(6, '2026_10_31_094630_create_mutations_table', 1),
(7, '2026_10_31_122633_create_transactions_table', 1),
(8, '2026_10_31_122640_create_transaction_details_table', 1),
(9, '2026_10_31_211851_create_permission_tables', 1),
(10, '2026_10_31_213527_create_activity_logs_table', 1),
(11, '2026_10_31_222932_create_settings_table', 1);

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
(2, 'App\\Models\\User', 2),
(3, 'App\\Models\\User', 3);

-- --------------------------------------------------------

--
-- Table structure for table `mutations`
--

CREATE TABLE `mutations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('in','out') NOT NULL,
  `quantity` int(11) NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mutations`
--

INSERT INTO `mutations` (`id`, `user_id`, `item_id`, `type`, `quantity`, `notes`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'in', 5, 'Stok awal Pensil', '2026-11-03 13:19:29', '2026-11-03 13:19:29'),
(2, 2, 3, 'out', 1, 'Barang hilang/rusak', '2026-11-03 13:19:29', '2026-11-03 13:19:29'),
(3, 1, 1, 'in', 6, NULL, '2026-11-03 15:50:51', '2026-11-03 15:50:51'),
(4, 1, 3, 'in', 9, NULL, '2026-11-03 15:51:02', '2026-11-03 15:51:02'),
(5, 1, 6, 'out', 8100, NULL, '2026-11-03 16:36:59', '2026-11-03 16:36:59'),
(6, 1, 7, 'out', 8060, NULL, '2026-11-03 16:37:31', '2026-11-03 16:37:31'),
(7, 1, 11, 'out', 6000, NULL, '2026-11-03 16:38:03', '2026-11-03 16:38:03'),
(8, 1, 8, 'out', 2000, NULL, '2026-11-03 16:39:19', '2026-11-03 16:39:19'),
(9, 1, 9, 'out', 1000, NULL, '2026-11-03 16:39:38', '2026-11-03 16:39:38'),
(10, 1, 10, 'out', 250, NULL, '2026-11-03 16:40:55', '2026-11-03 16:40:55'),
(11, 1, 10, 'out', 2300, NULL, '2026-11-03 16:41:27', '2026-11-03 16:41:27'),
(12, 1, 1, 'out', 90, NULL, '2026-11-04 13:55:05', '2026-11-04 13:55:05'),
(13, 1, 2, 'out', 85, NULL, '2026-11-04 13:55:23', '2026-11-04 13:55:23'),
(14, 1, 9, 'out', 700, NULL, '2026-11-04 13:56:30', '2026-11-04 13:56:30'),
(15, 1, 8, 'out', 195, NULL, '2026-11-04 13:56:52', '2026-11-04 13:56:52'),
(16, 1, 16, 'out', 45, NULL, '2026-11-04 13:57:31', '2026-11-04 13:57:31'),
(17, 1, 17, 'out', 42, NULL, '2026-11-04 13:58:02', '2026-11-04 13:58:02'),
(18, 1, 4, 'out', 65, NULL, '2026-11-04 13:58:39', '2026-11-04 13:58:39'),
(19, 1, 3, 'out', 73, NULL, '2026-11-04 13:59:10', '2026-11-04 13:59:10'),
(20, 1, 5, 'out', 65, NULL, '2026-11-04 13:59:41', '2026-11-04 13:59:41'),
(21, 1, 19, 'out', 45, NULL, '2026-11-04 14:00:09', '2026-11-04 14:00:09'),
(22, 2, 5, 'in', 7, NULL, '2026-11-07 09:23:39', '2026-11-07 09:23:39'),
(23, 2, 2, 'out', 2, NULL, '2026-11-07 09:24:06', '2026-11-07 09:24:06'),
(24, 2, 10, 'out', 40, NULL, '2026-11-07 09:24:24', '2026-11-07 09:24:24'),
(25, 2, 6, 'out', 42, NULL, '2026-11-07 09:24:41', '2026-11-07 09:24:41'),
(26, 2, 11, 'out', 45, NULL, '2026-11-07 09:24:57', '2026-11-07 09:24:57'),
(27, 2, 7, 'out', 41, NULL, '2026-11-07 09:25:09', '2026-11-07 09:25:09'),
(28, 2, 12, 'out', 40, NULL, '2026-11-07 09:25:20', '2026-11-07 09:25:20'),
(29, 2, 9, 'out', 38, NULL, '2026-11-07 09:25:34', '2026-11-07 09:25:34'),
(30, 1, 2, 'in', 5, NULL, '2026-11-07 13:14:36', '2026-11-07 13:14:36');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, 'Super Admin', 'web', '2026-11-03 13:19:28', '2026-11-03 13:19:28'),
(2, 'Admin', 'web', '2026-11-03 13:19:28', '2026-11-03 13:19:28'),
(3, 'Kasir', 'web', '2026-11-03 13:19:28', '2026-11-03 13:19:28');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('DIUmjPMjLP6d0AUU6d3p2V0C1SRxW4V4EzaiMU9F', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/156.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiVkpZSXAyTlg4NnpZSm5VU0tQY1hnN3FtUGl1TlRZN21kOUNJU3hlaCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC90cmFuc2FjdGlvbnMiO3M6NToicm91dGUiO3M6MTg6InRyYW5zYWN0aW9ucy5pbmRleCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7czoxNzoicGFzc3dvcmRfaGFzaF93ZWIiO3M6NjQ6ImE3MjJlZTMyZWYxMmMyY2FiY2M0NDIzODVhOWU3MDU2ZTc5NjY1ZDY2M2Y4YmVmODFhZGJlNzY2NzQ4NTdjOTMiO30=', 1794078246);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'app_name', 'INVENTORY SYSTEM', '2026-11-05 15:26:07', '2026-11-05 15:34:22'),
(2, 'address', 'Jl. Merdeka No. 123', '2026-11-05 15:26:07', '2026-11-05 15:26:07'),
(3, 'phone', '08123456789', '2026-11-05 15:26:07', '2026-11-05 15:26:07'),
(4, 'operating_hours', '08:00 - 22:00 WIB', '2026-11-05 15:26:07', '2026-11-05 15:26:07'),
(5, 'tax_percentage', '15', '2026-11-05 15:26:07', '2026-11-05 15:41:36'),
(6, 'receipt_footer', 'Terima kasih telah berbelanja di toko kami.', '2026-11-05 15:26:07', '2026-11-05 15:26:07'),
(7, 'currency', 'Rp', '2026-11-05 15:26:07', '2026-11-05 15:26:07');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_number` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `total_amount` int(11) NOT NULL,
  `pay_amount` int(11) NOT NULL,
  `change_amount` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `invoice_number`, `user_id`, `total_amount`, `pay_amount`, `change_amount`, `created_at`, `updated_at`) VALUES
(1, 'INV-1793712204299', 1, 13500, 15000, 1500, '2026-11-03 13:23:24', '2026-11-03 13:23:24'),
(2, 'INV-1793712467421', 1, 14500, 15000, 500, '2026-11-03 13:27:47', '2026-11-03 13:27:47'),
(3, 'INV-1793713059250', 1, 26000, 30000, 4000, '2026-11-03 13:37:39', '2026-11-03 13:37:39'),
(4, 'INV-1793714068845', 1, 48500, 50000, 1500, '2026-11-03 13:54:28', '2026-11-03 13:54:28'),
(5, 'INV-1793800028389', 1, 88500, 90000, 1500, '2026-11-04 13:47:08', '2026-11-04 13:47:08'),
(6, 'INV-1793800982192', 1, 5000, 5000, 0, '2026-11-04 14:03:02', '2026-11-04 14:03:02'),
(7, 'INV-1793801977324', 1, 93500, 95000, 1500, '2026-11-04 14:19:37', '2026-11-04 14:19:37'),
(8, 'INV-1793801993663', 1, 29000, 30000, 1000, '2026-11-04 14:19:53', '2026-11-04 14:19:53'),
(9, 'INV-1793802013953', 1, 51000, 55000, 4000, '2026-11-04 14:20:13', '2026-11-04 14:20:13'),
(10, 'INV-1793802046988', 1, 25000, 80000, 55000, '2026-11-04 14:20:46', '2026-11-04 14:20:46'),
(11, 'INV-1793802073388', 1, 29000, 30000, 1000, '2026-11-04 14:21:13', '2026-11-04 14:21:13'),
(12, 'INV-1793892497221', 1, 35200, 40000, 4800, '2026-11-05 15:28:17', '2026-11-05 15:28:17'),
(13, 'INV-1793892724329', 1, 22550, 25000, 2450, '2026-11-05 15:32:04', '2026-11-05 15:32:04'),
(14, 'INV-1793893835513', 1, 31050, 32000, 950, '2026-11-05 15:50:35', '2026-11-05 15:50:35'),
(15, 'INV-1794038916698', 3, 13800, 13800, 0, '2026-11-07 08:08:36', '2026-11-07 08:08:36'),
(16, 'INV-1794038937579', 3, 31050, 32000, 950, '2026-11-07 08:08:57', '2026-11-07 08:08:57'),
(17, 'INV-1794058435311', 1, 110975, 120000, 9025, '2026-11-07 13:33:55', '2026-11-07 13:33:55'),
(18, 'INV-1794058800877', 1, 44850, 50000, 5150, '2026-11-07 13:40:00', '2026-11-07 13:40:00'),
(19, 'INV-1794069078659', 1, 23575, 25000, 1425, '2026-11-07 16:31:18', '2026-11-07 16:31:18'),
(20, 'INV-1794070654763', 3, 21275, 25000, 3725, '2026-11-07 16:57:34', '2026-11-07 16:57:34'),
(21, 'INV-1794070706482', 2, 33925, 35000, 1075, '2026-11-07 16:58:26', '2026-11-07 16:58:26'),
(22, 'INV-1794071321681', 3, 99475, 100000, 525, '2026-11-07 17:08:41', '2026-11-07 17:08:41'),
(23, 'INV-1794071758155', 3, 32200, 40000, 7800, '2026-11-07 17:15:58', '2026-11-07 17:15:58'),
(24, 'INV-1794073503614', 3, 32200, 35000, 2800, '2026-11-07 17:45:03', '2026-11-07 17:45:03'),
(25, 'INV-1794073546433', 3, 32200, 35000, 2800, '2026-11-07 17:45:46', '2026-11-07 17:45:46'),
(26, 'INV-1794073835174', 3, 33350, 33500, 150, '2026-11-07 17:50:35', '2026-11-07 17:50:35'),
(27, 'INV-1794074058533', 3, 33350, 33500, 150, '2026-11-07 17:54:18', '2026-11-07 17:54:18'),
(28, 'INV-1794074136609', 3, 43125, 43500, 375, '2026-11-07 17:55:36', '2026-11-07 17:55:36'),
(29, 'INV-1794074210368', 3, 64400, 65000, 600, '2026-11-07 17:56:50', '2026-11-07 17:56:50'),
(30, 'INV-1794074410831', 1, 30475, 35000, 4525, '2026-11-07 18:00:10', '2026-11-07 18:00:10'),
(31, 'INV-1794074449264', 1, 15525, 20000, 4475, '2026-11-07 18:00:49', '2026-11-07 18:00:49'),
(32, 'INV-1794074589679', 1, 55200, 55500, 300, '2026-11-07 18:03:09', '2026-11-07 18:03:09'),
(33, 'INV-1794074745648', 1, 56925, 60000, 3075, '2026-11-07 18:05:45', '2026-11-07 18:05:45'),
(34, 'INV-1794076643271', 1, 11500, 12000, 500, '2026-11-07 18:37:23', '2026-11-07 18:37:23'),
(35, 'INV-1794078183329', 3, 35075, 35500, 425, '2026-11-07 19:03:03', '2026-11-07 19:03:03');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_details`
--

CREATE TABLE `transaction_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transaction_id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaction_details`
--

INSERT INTO `transaction_details` (`id`, `transaction_id`, `item_id`, `quantity`, `price`, `subtotal`, `created_at`, `updated_at`) VALUES
(1, 1, 8, 1, 1000, 1000, '2026-11-03 13:23:24', '2026-11-03 13:23:24'),
(2, 1, 16, 1, 12500, 12500, '2026-11-03 13:23:24', '2026-11-03 13:23:24'),
(3, 2, 20, 1, 4000, 4000, '2026-11-03 13:27:47', '2026-11-03 13:27:47'),
(4, 2, 18, 2, 2500, 5000, '2026-11-03 13:27:47', '2026-11-03 13:27:47'),
(5, 2, 3, 2, 1000, 2000, '2026-11-03 13:27:47', '2026-11-03 13:27:47'),
(6, 2, 4, 1, 1500, 1500, '2026-11-03 13:27:47', '2026-11-03 13:27:47'),
(7, 2, 5, 1, 2000, 2000, '2026-11-03 13:27:47', '2026-11-03 13:27:47'),
(8, 3, 7, 2, 4500, 9000, '2026-11-03 13:37:39', '2026-11-03 13:37:39'),
(9, 3, 3, 1, 1000, 1000, '2026-11-03 13:37:39', '2026-11-03 13:37:39'),
(10, 3, 2, 2, 3000, 6000, '2026-11-03 13:37:39', '2026-11-03 13:37:39'),
(11, 3, 14, 1, 4500, 4500, '2026-11-03 13:37:39', '2026-11-03 13:37:39'),
(12, 3, 4, 2, 1500, 3000, '2026-11-03 13:37:39', '2026-11-03 13:37:39'),
(13, 3, 1, 1, 2500, 2500, '2026-11-03 13:37:39', '2026-11-03 13:37:39'),
(14, 4, 20, 1, 4000, 4000, '2026-11-03 13:54:28', '2026-11-03 13:54:28'),
(15, 4, 18, 1, 2500, 2500, '2026-11-03 13:54:28', '2026-11-03 13:54:28'),
(16, 4, 17, 1, 14000, 14000, '2026-11-03 13:54:28', '2026-11-03 13:54:28'),
(17, 4, 19, 1, 8500, 8500, '2026-11-03 13:54:28', '2026-11-03 13:54:28'),
(18, 4, 15, 2, 1500, 3000, '2026-11-03 13:54:28', '2026-11-03 13:54:28'),
(19, 4, 14, 1, 4500, 4500, '2026-11-03 13:54:28', '2026-11-03 13:54:28'),
(20, 4, 13, 1, 3500, 3500, '2026-11-03 13:54:28', '2026-11-03 13:54:28'),
(21, 4, 12, 1, 6500, 6500, '2026-11-03 13:54:28', '2026-11-03 13:54:28'),
(22, 4, 9, 2, 1000, 2000, '2026-11-03 13:54:28', '2026-11-03 13:54:28'),
(23, 5, 1, 1, 2500, 2500, '2026-11-04 13:47:08', '2026-11-04 13:47:08'),
(24, 5, 3, 1, 1000, 1000, '2026-11-04 13:47:08', '2026-11-04 13:47:08'),
(25, 5, 4, 1, 1500, 1500, '2026-11-04 13:47:08', '2026-11-04 13:47:08'),
(26, 5, 2, 1, 3500, 3500, '2026-11-04 13:47:08', '2026-11-04 13:47:08'),
(27, 5, 7, 1, 5000, 5000, '2026-11-04 13:47:08', '2026-11-04 13:47:08'),
(28, 5, 8, 1, 1000, 1000, '2026-11-04 13:47:08', '2026-11-04 13:47:08'),
(29, 5, 5, 1, 2000, 2000, '2026-11-04 13:47:08', '2026-11-04 13:47:08'),
(30, 5, 12, 1, 6500, 6500, '2026-11-04 13:47:08', '2026-11-04 13:47:08'),
(31, 5, 9, 2, 1500, 3000, '2026-11-04 13:47:08', '2026-11-04 13:47:08'),
(32, 5, 15, 1, 1500, 1500, '2026-11-04 13:47:08', '2026-11-04 13:47:08'),
(33, 5, 20, 2, 4000, 8000, '2026-11-04 13:47:08', '2026-11-04 13:47:08'),
(34, 5, 19, 1, 8500, 8500, '2026-11-04 13:47:08', '2026-11-04 13:47:08'),
(35, 5, 17, 3, 14000, 42000, '2026-11-04 13:47:08', '2026-11-04 13:47:08'),
(36, 5, 18, 1, 2500, 2500, '2026-11-04 13:47:08', '2026-11-04 13:47:08'),
(37, 6, 2, 1, 3500, 3500, '2026-11-04 14:03:02', '2026-11-04 14:03:02'),
(38, 6, 4, 1, 1500, 1500, '2026-11-04 14:03:02', '2026-11-04 14:03:02'),
(39, 7, 20, 7, 4000, 28000, '2026-11-04 14:19:37', '2026-11-04 14:19:37'),
(40, 7, 18, 8, 2500, 20000, '2026-11-04 14:19:37', '2026-11-04 14:19:37'),
(41, 7, 12, 4, 6500, 26000, '2026-11-04 14:19:37', '2026-11-04 14:19:37'),
(42, 7, 9, 3, 1500, 4500, '2026-11-04 14:19:37', '2026-11-04 14:19:37'),
(43, 7, 11, 3, 5000, 15000, '2026-11-04 14:19:37', '2026-11-04 14:19:37'),
(44, 8, 10, 4, 2500, 10000, '2026-11-04 14:19:53', '2026-11-04 14:19:53'),
(45, 8, 12, 2, 6500, 13000, '2026-11-04 14:19:53', '2026-11-04 14:19:53'),
(46, 8, 9, 4, 1500, 6000, '2026-11-04 14:19:53', '2026-11-04 14:19:53'),
(47, 9, 13, 6, 3500, 21000, '2026-11-04 14:20:13', '2026-11-04 14:20:13'),
(48, 9, 14, 5, 4500, 22500, '2026-11-04 14:20:13', '2026-11-04 14:20:13'),
(49, 9, 15, 5, 1500, 7500, '2026-11-04 14:20:13', '2026-11-04 14:20:13'),
(50, 10, 20, 5, 4000, 20000, '2026-11-04 14:20:46', '2026-11-04 14:20:46'),
(51, 10, 18, 2, 2500, 5000, '2026-11-04 14:20:46', '2026-11-04 14:20:46'),
(52, 11, 13, 4, 3500, 14000, '2026-11-04 14:21:13', '2026-11-04 14:21:13'),
(53, 11, 15, 4, 1500, 6000, '2026-11-04 14:21:13', '2026-11-04 14:21:13'),
(54, 11, 14, 2, 4500, 9000, '2026-11-04 14:21:13', '2026-11-04 14:21:13'),
(55, 12, 20, 2, 4000, 8000, '2026-11-05 15:28:17', '2026-11-05 15:28:17'),
(56, 12, 18, 2, 2500, 5000, '2026-11-05 15:28:17', '2026-11-05 15:28:17'),
(57, 12, 14, 2, 4500, 9000, '2026-11-05 15:28:17', '2026-11-05 15:28:17'),
(58, 12, 13, 2, 3500, 7000, '2026-11-05 15:28:17', '2026-11-05 15:28:17'),
(59, 12, 15, 2, 1500, 3000, '2026-11-05 15:28:17', '2026-11-05 15:28:17'),
(60, 13, 6, 3, 3500, 10500, '2026-11-05 15:32:04', '2026-11-05 15:32:04'),
(61, 13, 7, 2, 5000, 10000, '2026-11-05 15:32:04', '2026-11-05 15:32:04'),
(62, 14, 2, 1, 3500, 3500, '2026-11-05 15:50:35', '2026-11-05 15:50:35'),
(63, 14, 5, 1, 2000, 2000, '2026-11-05 15:50:35', '2026-11-05 15:50:35'),
(64, 14, 7, 1, 5000, 5000, '2026-11-05 15:50:35', '2026-11-05 15:50:35'),
(65, 14, 6, 1, 3500, 3500, '2026-11-05 15:50:35', '2026-11-05 15:50:35'),
(66, 14, 12, 1, 6500, 6500, '2026-11-05 15:50:35', '2026-11-05 15:50:35'),
(67, 14, 20, 1, 4000, 4000, '2026-11-05 15:50:35', '2026-11-05 15:50:35'),
(68, 14, 18, 1, 2500, 2500, '2026-11-05 15:50:35', '2026-11-05 15:50:35'),
(69, 15, 1, 1, 2500, 2500, '2026-11-07 08:08:36', '2026-11-07 08:08:36'),
(70, 15, 4, 2, 1500, 3000, '2026-11-07 08:08:36', '2026-11-07 08:08:36'),
(71, 15, 15, 2, 1500, 3000, '2026-11-07 08:08:36', '2026-11-07 08:08:36'),
(72, 15, 13, 1, 3500, 3500, '2026-11-07 08:08:36', '2026-11-07 08:08:36'),
(73, 16, 13, 2, 3500, 7000, '2026-11-07 08:08:57', '2026-11-07 08:08:57'),
(74, 16, 15, 2, 1500, 3000, '2026-11-07 08:08:57', '2026-11-07 08:08:57'),
(75, 16, 20, 3, 4000, 12000, '2026-11-07 08:08:57', '2026-11-07 08:08:57'),
(76, 16, 18, 2, 2500, 5000, '2026-11-07 08:08:57', '2026-11-07 08:08:57'),
(77, 17, 18, 4, 2500, 10000, '2026-11-07 13:33:55', '2026-11-07 13:33:55'),
(78, 17, 20, 7, 4000, 28000, '2026-11-07 13:33:55', '2026-11-07 13:33:55'),
(79, 17, 14, 5, 4500, 22500, '2026-11-07 13:33:55', '2026-11-07 13:33:55'),
(80, 17, 13, 3, 3500, 10500, '2026-11-07 13:33:55', '2026-11-07 13:33:55'),
(81, 17, 15, 2, 1500, 3000, '2026-11-07 13:33:55', '2026-11-07 13:33:55'),
(82, 17, 17, 1, 14000, 14000, '2026-11-07 13:33:55', '2026-11-07 13:33:55'),
(83, 17, 19, 1, 8500, 8500, '2026-11-07 13:33:55', '2026-11-07 13:33:55'),
(84, 18, 20, 2, 4000, 8000, '2026-11-07 13:40:00', '2026-11-07 13:40:00'),
(85, 18, 18, 2, 2500, 5000, '2026-11-07 13:40:00', '2026-11-07 13:40:00'),
(86, 18, 17, 1, 14000, 14000, '2026-11-07 13:40:00', '2026-11-07 13:40:00'),
(87, 18, 14, 1, 4500, 4500, '2026-11-07 13:40:00', '2026-11-07 13:40:00'),
(88, 18, 13, 1, 3500, 3500, '2026-11-07 13:40:00', '2026-11-07 13:40:00'),
(89, 18, 5, 2, 2000, 4000, '2026-11-07 13:40:00', '2026-11-07 13:40:00'),
(90, 19, 20, 1, 4000, 4000, '2026-11-07 16:31:18', '2026-11-07 16:31:18'),
(91, 19, 18, 1, 2500, 2500, '2026-11-07 16:31:18', '2026-11-07 16:31:18'),
(92, 19, 13, 1, 3500, 3500, '2026-11-07 16:31:18', '2026-11-07 16:31:18'),
(93, 19, 14, 1, 4500, 4500, '2026-11-07 16:31:18', '2026-11-07 16:31:18'),
(94, 19, 15, 1, 1500, 1500, '2026-11-07 16:31:18', '2026-11-07 16:31:18'),
(95, 19, 1, 1, 2500, 2500, '2026-11-07 16:31:18', '2026-11-07 16:31:18'),
(96, 19, 5, 1, 2000, 2000, '2026-11-07 16:31:18', '2026-11-07 16:31:18'),
(97, 20, 4, 1, 1500, 1500, '2026-11-07 16:57:34', '2026-11-07 16:57:34'),
(98, 20, 2, 1, 3500, 3500, '2026-11-07 16:57:34', '2026-11-07 16:57:34'),
(99, 20, 1, 1, 2500, 2500, '2026-11-07 16:57:34', '2026-11-07 16:57:34'),
(100, 20, 3, 1, 1000, 1000, '2026-11-07 16:57:34', '2026-11-07 16:57:34'),
(101, 20, 6, 1, 3500, 3500, '2026-11-07 16:57:34', '2026-11-07 16:57:34'),
(102, 20, 5, 1, 2000, 2000, '2026-11-07 16:57:34', '2026-11-07 16:57:34'),
(103, 20, 14, 1, 4500, 4500, '2026-11-07 16:57:34', '2026-11-07 16:57:34'),
(104, 21, 1, 1, 2500, 2500, '2026-11-07 16:58:26', '2026-11-07 16:58:26'),
(105, 21, 4, 1, 1500, 1500, '2026-11-07 16:58:26', '2026-11-07 16:58:26'),
(106, 21, 16, 1, 12500, 12500, '2026-11-07 16:58:26', '2026-11-07 16:58:26'),
(107, 21, 19, 1, 8500, 8500, '2026-11-07 16:58:26', '2026-11-07 16:58:26'),
(108, 21, 18, 1, 2500, 2500, '2026-11-07 16:58:26', '2026-11-07 16:58:26'),
(109, 21, 5, 1, 2000, 2000, '2026-11-07 16:58:26', '2026-11-07 16:58:26'),
(110, 22, 4, 1, 1500, 1500, '2026-11-07 17:08:41', '2026-11-07 17:08:41'),
(111, 22, 2, 1, 3500, 3500, '2026-11-07 17:08:41', '2026-11-07 17:08:41'),
(112, 22, 1, 1, 2500, 2500, '2026-11-07 17:08:41', '2026-11-07 17:08:41'),
(113, 22, 3, 1, 1000, 1000, '2026-11-07 17:08:41', '2026-11-07 17:08:41'),
(114, 22, 8, 1, 1000, 1000, '2026-11-07 17:08:41', '2026-11-07 17:08:41'),
(115, 22, 6, 1, 3500, 3500, '2026-11-07 17:08:41', '2026-11-07 17:08:41'),
(116, 22, 5, 1, 2000, 2000, '2026-11-07 17:08:41', '2026-11-07 17:08:41'),
(117, 22, 7, 1, 5000, 5000, '2026-11-07 17:08:41', '2026-11-07 17:08:41'),
(118, 22, 12, 1, 6500, 6500, '2026-11-07 17:08:41', '2026-11-07 17:08:41'),
(119, 22, 10, 1, 2500, 2500, '2026-11-07 17:08:41', '2026-11-07 17:08:41'),
(120, 22, 9, 1, 1500, 1500, '2026-11-07 17:08:41', '2026-11-07 17:08:41'),
(121, 22, 11, 1, 5000, 5000, '2026-11-07 17:08:41', '2026-11-07 17:08:41'),
(122, 22, 16, 1, 12500, 12500, '2026-11-07 17:08:41', '2026-11-07 17:08:41'),
(123, 22, 14, 1, 4500, 4500, '2026-11-07 17:08:41', '2026-11-07 17:08:41'),
(124, 22, 13, 1, 3500, 3500, '2026-11-07 17:08:41', '2026-11-07 17:08:41'),
(125, 22, 15, 1, 1500, 1500, '2026-11-07 17:08:41', '2026-11-07 17:08:41'),
(126, 22, 20, 1, 4000, 4000, '2026-11-07 17:08:41', '2026-11-07 17:08:41'),
(127, 22, 18, 1, 2500, 2500, '2026-11-07 17:08:41', '2026-11-07 17:08:41'),
(128, 22, 17, 1, 14000, 14000, '2026-11-07 17:08:41', '2026-11-07 17:08:41'),
(129, 22, 19, 1, 8500, 8500, '2026-11-07 17:08:41', '2026-11-07 17:08:41'),
(130, 23, 1, 1, 2500, 2500, '2026-11-07 17:15:58', '2026-11-07 17:15:58'),
(131, 23, 2, 1, 3500, 3500, '2026-11-07 17:15:58', '2026-11-07 17:15:58'),
(132, 23, 4, 1, 1500, 1500, '2026-11-07 17:15:58', '2026-11-07 17:15:58'),
(133, 23, 3, 1, 1000, 1000, '2026-11-07 17:15:58', '2026-11-07 17:15:58'),
(134, 23, 8, 1, 1000, 1000, '2026-11-07 17:15:58', '2026-11-07 17:15:58'),
(135, 23, 6, 1, 3500, 3500, '2026-11-07 17:15:58', '2026-11-07 17:15:58'),
(136, 23, 12, 1, 6500, 6500, '2026-11-07 17:15:58', '2026-11-07 17:15:58'),
(137, 23, 10, 1, 2500, 2500, '2026-11-07 17:15:58', '2026-11-07 17:15:58'),
(138, 23, 9, 1, 1500, 1500, '2026-11-07 17:15:58', '2026-11-07 17:15:58'),
(139, 23, 14, 1, 4500, 4500, '2026-11-07 17:15:58', '2026-11-07 17:15:58'),
(140, 24, 1, 1, 2500, 2500, '2026-11-07 17:45:03', '2026-11-07 17:45:03'),
(141, 24, 2, 1, 3500, 3500, '2026-11-07 17:45:03', '2026-11-07 17:45:03'),
(142, 24, 4, 1, 1500, 1500, '2026-11-07 17:45:03', '2026-11-07 17:45:03'),
(143, 24, 3, 1, 1000, 1000, '2026-11-07 17:45:03', '2026-11-07 17:45:03'),
(144, 24, 8, 1, 1000, 1000, '2026-11-07 17:45:03', '2026-11-07 17:45:03'),
(145, 24, 6, 1, 3500, 3500, '2026-11-07 17:45:03', '2026-11-07 17:45:03'),
(146, 24, 12, 1, 6500, 6500, '2026-11-07 17:45:03', '2026-11-07 17:45:03'),
(147, 24, 10, 1, 2500, 2500, '2026-11-07 17:45:03', '2026-11-07 17:45:03'),
(148, 24, 9, 1, 1500, 1500, '2026-11-07 17:45:03', '2026-11-07 17:45:03'),
(149, 24, 14, 1, 4500, 4500, '2026-11-07 17:45:03', '2026-11-07 17:45:03'),
(150, 25, 1, 1, 2500, 2500, '2026-11-07 17:45:46', '2026-11-07 17:45:46'),
(151, 25, 2, 1, 3500, 3500, '2026-11-07 17:45:46', '2026-11-07 17:45:46'),
(152, 25, 4, 1, 1500, 1500, '2026-11-07 17:45:46', '2026-11-07 17:45:46'),
(153, 25, 3, 1, 1000, 1000, '2026-11-07 17:45:46', '2026-11-07 17:45:46'),
(154, 25, 8, 1, 1000, 1000, '2026-11-07 17:45:46', '2026-11-07 17:45:46'),
(155, 25, 6, 1, 3500, 3500, '2026-11-07 17:45:46', '2026-11-07 17:45:46'),
(156, 25, 12, 1, 6500, 6500, '2026-11-07 17:45:46', '2026-11-07 17:45:46'),
(157, 25, 10, 1, 2500, 2500, '2026-11-07 17:45:46', '2026-11-07 17:45:46'),
(158, 25, 9, 1, 1500, 1500, '2026-11-07 17:45:46', '2026-11-07 17:45:46'),
(159, 25, 14, 1, 4500, 4500, '2026-11-07 17:45:46', '2026-11-07 17:45:46'),
(160, 26, 20, 1, 4000, 4000, '2026-11-07 17:50:35', '2026-11-07 17:50:35'),
(161, 26, 18, 1, 2500, 2500, '2026-11-07 17:50:35', '2026-11-07 17:50:35'),
(162, 26, 17, 1, 14000, 14000, '2026-11-07 17:50:35', '2026-11-07 17:50:35'),
(163, 26, 19, 1, 8500, 8500, '2026-11-07 17:50:35', '2026-11-07 17:50:35'),
(164, 27, 20, 1, 4000, 4000, '2026-11-07 17:54:18', '2026-11-07 17:54:18'),
(165, 27, 18, 1, 2500, 2500, '2026-11-07 17:54:18', '2026-11-07 17:54:18'),
(166, 27, 17, 1, 14000, 14000, '2026-11-07 17:54:18', '2026-11-07 17:54:18'),
(167, 27, 19, 1, 8500, 8500, '2026-11-07 17:54:18', '2026-11-07 17:54:18'),
(168, 28, 12, 1, 6500, 6500, '2026-11-07 17:55:36', '2026-11-07 17:55:36'),
(169, 28, 10, 1, 2500, 2500, '2026-11-07 17:55:36', '2026-11-07 17:55:36'),
(170, 28, 9, 1, 1500, 1500, '2026-11-07 17:55:36', '2026-11-07 17:55:36'),
(171, 28, 11, 1, 5000, 5000, '2026-11-07 17:55:36', '2026-11-07 17:55:36'),
(172, 28, 16, 1, 12500, 12500, '2026-11-07 17:55:36', '2026-11-07 17:55:36'),
(173, 28, 14, 1, 4500, 4500, '2026-11-07 17:55:36', '2026-11-07 17:55:36'),
(174, 28, 13, 1, 3500, 3500, '2026-11-07 17:55:36', '2026-11-07 17:55:36'),
(175, 28, 15, 1, 1500, 1500, '2026-11-07 17:55:36', '2026-11-07 17:55:36'),
(176, 29, 20, 2, 4000, 8000, '2026-11-07 17:56:50', '2026-11-07 17:56:50'),
(177, 29, 18, 2, 2500, 5000, '2026-11-07 17:56:50', '2026-11-07 17:56:50'),
(178, 29, 17, 2, 14000, 28000, '2026-11-07 17:56:50', '2026-11-07 17:56:50'),
(179, 29, 19, 1, 8500, 8500, '2026-11-07 17:56:50', '2026-11-07 17:56:50'),
(180, 29, 12, 1, 6500, 6500, '2026-11-07 17:56:50', '2026-11-07 17:56:50'),
(181, 30, 1, 1, 2500, 2500, '2026-11-07 18:00:11', '2026-11-07 18:00:11'),
(182, 30, 4, 1, 1500, 1500, '2026-11-07 18:00:11', '2026-11-07 18:00:11'),
(183, 30, 2, 1, 3500, 3500, '2026-11-07 18:00:11', '2026-11-07 18:00:11'),
(184, 30, 3, 1, 1000, 1000, '2026-11-07 18:00:11', '2026-11-07 18:00:11'),
(185, 30, 8, 1, 1000, 1000, '2026-11-07 18:00:11', '2026-11-07 18:00:11'),
(186, 30, 6, 1, 3500, 3500, '2026-11-07 18:00:11', '2026-11-07 18:00:11'),
(187, 30, 5, 1, 2000, 2000, '2026-11-07 18:00:11', '2026-11-07 18:00:11'),
(188, 30, 7, 1, 5000, 5000, '2026-11-07 18:00:11', '2026-11-07 18:00:11'),
(189, 30, 20, 1, 4000, 4000, '2026-11-07 18:00:11', '2026-11-07 18:00:11'),
(190, 30, 18, 1, 2500, 2500, '2026-11-07 18:00:11', '2026-11-07 18:00:11'),
(191, 31, 1, 1, 2500, 2500, '2026-11-07 18:00:49', '2026-11-07 18:00:49'),
(192, 31, 2, 1, 3500, 3500, '2026-11-07 18:00:49', '2026-11-07 18:00:49'),
(193, 31, 4, 1, 1500, 1500, '2026-11-07 18:00:49', '2026-11-07 18:00:49'),
(194, 31, 3, 1, 1000, 1000, '2026-11-07 18:00:49', '2026-11-07 18:00:49'),
(195, 31, 8, 1, 1000, 1000, '2026-11-07 18:00:49', '2026-11-07 18:00:49'),
(196, 31, 10, 1, 2500, 2500, '2026-11-07 18:00:49', '2026-11-07 18:00:49'),
(197, 31, 9, 1, 1500, 1500, '2026-11-07 18:00:49', '2026-11-07 18:00:49'),
(198, 32, 12, 1, 6500, 6500, '2026-11-07 18:03:09', '2026-11-07 18:03:09'),
(199, 32, 20, 1, 4000, 4000, '2026-11-07 18:03:09', '2026-11-07 18:03:09'),
(200, 32, 18, 1, 2500, 2500, '2026-11-07 18:03:09', '2026-11-07 18:03:09'),
(201, 32, 17, 1, 14000, 14000, '2026-11-07 18:03:09', '2026-11-07 18:03:09'),
(202, 32, 19, 1, 8500, 8500, '2026-11-07 18:03:09', '2026-11-07 18:03:09'),
(203, 32, 16, 1, 12500, 12500, '2026-11-07 18:03:09', '2026-11-07 18:03:09'),
(204, 33, 20, 2, 4000, 8000, '2026-11-07 18:05:45', '2026-11-07 18:05:45'),
(205, 33, 17, 2, 14000, 28000, '2026-11-07 18:05:45', '2026-11-07 18:05:45'),
(206, 33, 19, 1, 8500, 8500, '2026-11-07 18:05:45', '2026-11-07 18:05:45'),
(207, 33, 18, 2, 2500, 5000, '2026-11-07 18:05:45', '2026-11-07 18:05:45'),
(208, 34, 4, 2, 1500, 3000, '2026-11-07 18:37:23', '2026-11-07 18:37:23'),
(209, 34, 2, 1, 3500, 3500, '2026-11-07 18:37:23', '2026-11-07 18:37:23'),
(210, 34, 1, 1, 2500, 2500, '2026-11-07 18:37:23', '2026-11-07 18:37:23'),
(211, 34, 3, 1, 1000, 1000, '2026-11-07 18:37:23', '2026-11-07 18:37:23'),
(212, 35, 2, 1, 3500, 3500, '2026-11-07 19:03:03', '2026-11-07 19:03:03'),
(213, 35, 4, 2, 1500, 3000, '2026-11-07 19:03:03', '2026-11-07 19:03:03'),
(214, 35, 3, 1, 1000, 1000, '2026-11-07 19:03:03', '2026-11-07 19:03:03'),
(215, 35, 1, 1, 2500, 2500, '2026-11-07 19:03:03', '2026-11-07 19:03:03'),
(216, 35, 20, 1, 4000, 4000, '2026-11-07 19:03:03', '2026-11-07 19:03:03'),
(217, 35, 18, 1, 2500, 2500, '2026-11-07 19:03:03', '2026-11-07 19:03:03'),
(218, 35, 17, 1, 14000, 14000, '2026-11-07 19:03:03', '2026-11-07 19:03:03');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin Tes', 'admin@tes.com', NULL, '$2y$12$0usav5pUk15K1SakNvrM1OT6lsXQujU0iQZt3zzPtkiS7c6MoYoq2', NULL, '2026-11-03 13:19:28', '2026-11-03 13:19:28'),
(2, 'Siti Admin', 'siti@tes.com', NULL, '$2y$12$L7pnxLgnyXYklwhQYAx2mOtoExnI13QJbmpoLEW/r3.INs/cKxLYS', NULL, '2026-11-03 13:19:29', '2026-11-03 13:19:29'),
(3, 'Budi Kasir', 'kasir@tes.com', NULL, '$2y$12$FcMdq87tmcXdva5CXtdRJOaa.aJuP.4bxMUbZwkAjVo/uh8Zn9pKK', NULL, '2026-11-03 13:19:29', '2026-11-03 13:19:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activity_logs_user_id_foreign` (`user_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `items_sku_unique` (`sku`),
  ADD KEY `items_category_id_foreign` (`category_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

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
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `mutations`
--
ALTER TABLE `mutations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mutations_user_id_foreign` (`user_id`),
  ADD KEY `mutations_item_id_foreign` (`item_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

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
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `transactions_invoice_number_unique` (`invoice_number`),
  ADD KEY `transactions_user_id_foreign` (`user_id`);

--
-- Indexes for table `transaction_details`
--
ALTER TABLE `transaction_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaction_details_transaction_id_foreign` (`transaction_id`),
  ADD KEY `transaction_details_item_id_foreign` (`item_id`);

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
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `mutations`
--
ALTER TABLE `mutations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

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
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `transaction_details`
--
ALTER TABLE `transaction_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=219;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD CONSTRAINT `activity_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

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
-- Constraints for table `mutations`
--
ALTER TABLE `mutations`
  ADD CONSTRAINT `mutations_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `mutations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transaction_details`
--
ALTER TABLE `transaction_details`
  ADD CONSTRAINT `transaction_details_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaction_details_transaction_id_foreign` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
