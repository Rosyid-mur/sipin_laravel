-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2026 at 01:31 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.5.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sipin`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `action` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`id`, `user_id`, `action`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 'Verifikasi Peminjaman', 'Memproses pengajuan TRX-20261111-4D50 menjadi Approved', '2026-11-10 18:39:27', '2026-11-10 18:39:27'),
(2, 1, 'Tambah Inventaris', 'Menambahkan barang baru: mouse dgdg', '2026-11-10 18:43:02', '2026-11-10 18:43:02'),
(3, 1, 'Hapus Inventaris', 'Menghapus barang: mouse dgdg', '2026-11-11 06:02:22', '2026-11-11 06:02:22'),
(4, 1, 'Verifikasi Peminjaman', 'Memproses pengajuan TRX-20261111-B573 menjadi Rejected', '2026-11-11 06:34:01', '2026-11-11 06:34:01'),
(5, 4, 'Siswa/Guru Meminjam', 'Mengajukan peminjaman dengan kode TRX-20261112-199A', '2026-11-11 20:51:44', '2026-11-11 20:51:44'),
(6, 1, 'Verifikasi Peminjaman', 'Memproses pengajuan TRX-20261112-199A menjadi Approved', '2026-11-11 20:52:03', '2026-11-11 20:52:03'),
(7, 4, 'Siswa/Guru Meminjam', 'Mengajukan peminjaman dengan kode TRX-20261112-B161', '2026-11-11 21:18:35', '2026-11-11 21:18:35'),
(8, 1, 'Verifikasi Peminjaman', 'Memproses pengajuan TRX-20261112-B161 menjadi Approved', '2026-11-11 21:20:22', '2026-11-11 21:20:22'),
(9, 5, 'Siswa/Guru Meminjam', 'Mengajukan peminjaman dengan kode TRX-20261112-EF8B', '2026-11-11 21:21:11', '2026-11-11 21:21:11'),
(10, 1, 'Verifikasi Peminjaman', 'Memproses pengajuan TRX-20261112-EF8B menjadi Approved', '2026-11-11 21:21:55', '2026-11-11 21:21:55'),
(11, 4, 'Siswa/Guru Meminjam', 'Mengajukan peminjaman dengan kode TRX-20261112-7608', '2026-11-11 21:26:57', '2026-11-11 21:26:57'),
(12, 1, 'Verifikasi Peminjaman', 'Memproses pengajuan TRX-20261112-7608 menjadi Approved', '2026-11-11 21:27:13', '2026-11-11 21:27:13'),
(13, 1, 'Serah Terima Barang', 'Menyerahkan barang untuk transaksi TRX-20261112-7608', '2026-11-11 21:51:03', '2026-11-11 21:51:03'),
(14, 1, 'Pengembalian Barang', 'Menerima kembali barang dari transaksi TRX-20261112-7608', '2026-11-11 21:51:32', '2026-11-11 21:51:32'),
(15, 4, 'Siswa/Guru Meminjam', 'Mengajukan peminjaman dengan kode TRX-20261112-28EC', '2026-11-12 03:53:45', '2026-11-12 03:53:45'),
(16, 5, 'Siswa/Guru Meminjam', 'Mengajukan peminjaman dengan kode TRX-20261112-31EC', '2026-11-12 03:59:06', '2026-11-12 03:59:06'),
(17, 5, 'Update Profil', 'Memperbarui informasi kontak / password', '2026-11-12 03:59:52', '2026-11-12 03:59:52'),
(18, 5, 'Update Profil', 'Memperbarui informasi kontak / password', '2026-11-12 04:00:31', '2026-11-12 04:00:31'),
(19, 5, 'Siswa/Guru Meminjam', 'Mengajukan peminjaman dengan kode TRX-20261112-FFB7', '2026-11-12 04:15:39', '2026-11-12 04:15:39'),
(20, 5, 'Update Profil', 'Memperbarui informasi kontak / password', '2026-11-12 04:16:22', '2026-11-12 04:16:22'),
(21, 5, 'Update Profil', 'Memperbarui informasi kontak / password', '2026-11-12 04:16:55', '2026-11-12 04:16:55'),
(22, 1, 'Tambah Inventaris', 'Menambahkan barang baru: buku', '2026-11-12 04:21:12', '2026-11-12 04:21:12'),
(23, 1, 'Hapus Inventaris', 'Menghapus barang: buku', '2026-11-12 04:24:14', '2026-11-12 04:24:14'),
(24, 5, 'Siswa/Guru Meminjam', 'Mengajukan peminjaman dengan kode TRX-20261112-2A8F', '2026-11-12 04:29:04', '2026-11-12 04:29:04'),
(25, 5, 'Update Profil', 'Memperbarui informasi kontak / password', '2026-11-12 04:30:04', '2026-11-12 04:30:04'),
(26, 1, 'Tambah Inventaris', 'Menambahkan barang baru: kabel', '2026-11-12 04:33:14', '2026-11-12 04:33:14'),
(27, 1, 'Hapus Inventaris', 'Menghapus barang: kabel', '2026-11-12 04:33:52', '2026-11-12 04:33:52'),
(28, 1, 'Verifikasi Peminjaman', 'Memproses pengajuan TRX-20261112-2A8F menjadi Approved', '2026-11-12 04:37:13', '2026-11-12 04:37:13'),
(29, 1, 'Serah Terima Barang', 'Menyerahkan barang untuk transaksi TRX-20261112-2A8F', '2026-11-12 04:37:36', '2026-11-12 04:37:36'),
(30, 1, 'Pengembalian Barang', 'Menerima kembali barang dari transaksi TRX-20261112-2A8F', '2026-11-12 04:38:19', '2026-11-12 04:38:19'),
(31, 1, 'Verifikasi Peminjaman', 'Memproses pengajuan TRX-20261112-FFB7 menjadi Rejected', '2026-11-12 04:38:41', '2026-11-12 04:38:41'),
(32, 5, 'Siswa/Guru Meminjam', 'Mengajukan peminjaman dengan kode TRX-20261112-25FB', '2026-11-12 04:47:53', '2026-11-12 04:47:53'),
(33, 1, 'Tambah Inventaris', 'Menambahkan barang baru: pensil', '2026-11-12 04:50:58', '2026-11-12 04:50:58'),
(34, 1, 'Hapus Inventaris', 'Menghapus barang: pensil', '2026-11-12 04:51:28', '2026-11-12 04:51:28'),
(35, 1, 'Verifikasi Peminjaman', 'Memproses pengajuan TRX-20261112-25FB menjadi Approved', '2026-11-12 04:53:00', '2026-11-12 04:53:00'),
(36, 1, 'Serah Terima Barang', 'Menyerahkan barang untuk transaksi TRX-20261112-25FB', '2026-11-12 04:53:12', '2026-11-12 04:53:12'),
(37, 1, 'Pengembalian Barang', 'Menerima kembali barang dari transaksi TRX-20261112-25FB', '2026-11-12 04:53:42', '2026-11-12 04:53:42'),
(38, 1, 'Verifikasi Peminjaman', 'Memproses pengajuan TRX-20261112-31EC menjadi Rejected', '2026-11-12 04:54:01', '2026-11-12 04:54:01'),
(39, 1, 'Verifikasi Peminjaman', 'Memproses pengajuan TRX-20261112-28EC menjadi Approved', '2026-11-12 04:54:44', '2026-11-12 04:54:44'),
(40, 1, 'Serah Terima Barang', 'Menyerahkan barang untuk transaksi TRX-20261112-28EC', '2026-11-12 04:54:49', '2026-11-12 04:54:49'),
(41, 1, 'Pengembalian Barang', 'Menerima kembali barang dari transaksi TRX-20261112-28EC', '2026-11-12 04:55:05', '2026-11-12 04:55:05');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `inventory_id` bigint(20) UNSIGNED NOT NULL,
  `jumlah` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_kategori` varchar(255) NOT NULL,
  `nama_kategori` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `max_hari` int(11) NOT NULL DEFAULT 3,
  `max_unit` int(11) NOT NULL DEFAULT 1,
  `butuh_guru` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `kode_kategori`, `nama_kategori`, `deskripsi`, `max_hari`, `max_unit`, `butuh_guru`, `created_at`, `updated_at`) VALUES
(1, 'KAT-IOT', 'Mikrokontroler & IoT', NULL, 3, 1, 1, '2026-11-10 18:32:11', '2026-11-12 04:24:29'),
(2, 'KAT-NET', 'Alat Jaringan', NULL, 2, 2, 0, '2026-11-10 18:32:11', '2026-11-10 18:32:11'),
(3, 'KAT-LPT', 'Laptop & PC', NULL, 1, 1, 1, '2026-11-10 18:32:11', '2026-11-10 18:32:11'),
(4, 'KAT-ELK', 'Alat Elektronik', NULL, 3, 2, 0, '2026-11-10 18:32:11', '2026-11-10 18:32:11'),
(5, 'KAT-ALT', 'Alat Manual', NULL, 3, 1, 0, '2026-11-10 18:32:11', '2026-11-10 18:32:11');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` varchar(255) NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventories`
--

CREATE TABLE `inventories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `kode_inventaris` varchar(255) NOT NULL,
  `nama_alat` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `stok_total` int(11) NOT NULL DEFAULT 0,
  `stok_tersedia` int(11) NOT NULL DEFAULT 0,
  `stok_dipinjam` int(11) NOT NULL DEFAULT 0,
  `stok_rusak` int(11) NOT NULL DEFAULT 0,
  `kondisi` enum('Baik','Rusak Ringan','Rusak Berat') NOT NULL DEFAULT 'Baik',
  `lokasi` varchar(255) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inventories`
--

INSERT INTO `inventories` (`id`, `category_id`, `kode_inventaris`, `nama_alat`, `deskripsi`, `stok_total`, `stok_tersedia`, `stok_dipinjam`, `stok_rusak`, `kondisi`, `lokasi`, `gambar`, `created_at`, `updated_at`) VALUES
(1, 4, 'INV-RPL-001', 'Laptop HP', 'Inventaris Lab RPL', 3, 1, 0, 2, 'Rusak Ringan', 'Ruang Tefa', 'images/laptop.jpeg', '2026-11-10 18:32:11', '2026-11-12 04:55:05'),
(2, 4, 'INV-RPL-002', 'Flasdisk', 'Inventaris Lab RPL', 10, 10, 0, 0, 'Baik', 'Ruang Lab ASM 2', 'images/flasdisk.jpeg', '2026-11-10 18:32:11', '2026-11-11 21:51:32'),
(3, 4, 'INV-RPL-003', 'Mouse', 'Inventaris Lab RPL', 20, 20, 0, 0, 'Baik', 'Ruang Tefa', 'images/mouse.jpeg', '2026-11-10 18:32:11', '2026-11-12 04:38:19'),
(4, 4, 'INV-RPL-004', 'Keyboard', 'Inventaris Lab RPL', 10, 10, 0, 0, 'Baik', 'Ruang Lab ASM 3', 'images/key.jpeg', '2026-11-10 18:32:11', '2026-11-12 04:53:42'),
(5, 4, 'INV-RPL-005', 'Proyektor', 'Inventaris Lab RPL', 3, 3, 0, 0, 'Baik', 'Ruang Tefa', 'images/proyektor.jpeg', '2026-11-10 18:32:11', '2026-11-11 21:08:11'),
(6, 4, 'INV-RPL-006', 'Monitor', 'Inventaris Lab RPL', 3, 3, 0, 0, 'Baik', 'Ruang Lab ASM 1', 'images/monitor.jpeg', '2026-11-10 18:32:11', '2026-11-11 21:08:11'),
(7, 5, 'INV-RPL-007', 'Obeng mini', 'Inventaris Lab RPL', 1, 1, 0, 0, 'Baik', 'Ruang Lab RPL 4', 'images/obeng.jpeg', '2026-11-10 18:32:11', '2026-11-11 21:08:11'),
(8, 4, 'INV-RPL-008', 'Arduino uno', 'Inventaris Lab RPL', 30, 30, 0, 0, 'Baik', 'Ruang Lab RPL 4', 'images/arduino.jpeg', '2026-11-10 18:32:11', '2026-11-11 21:08:11'),
(9, 5, 'INV-RPL-009', 'Solder', 'Inventaris Lab RPL', 1, 1, 0, 0, 'Baik', 'Ruang Lab ASM 2', 'images/solder.jpeg', '2026-11-10 18:32:11', '2026-11-11 21:08:11'),
(10, 5, 'INV-RPL-010', 'Bor tembok', 'Inventaris Lab RPL', 1, 1, 0, 0, 'Baik', 'Ruang Lab ASM 2', 'images/bortembok.jpeg', '2026-11-10 18:32:11', '2026-11-11 21:08:11'),
(11, 4, 'INV-RPL-011', 'Bor mini listrik', 'Inventaris Lab RPL', 1, 1, 0, 0, 'Baik', 'Ruang Lab RPL 4', 'images/borlistrik.jpeg', '2026-11-10 18:32:11', '2026-11-11 21:08:11'),
(12, 4, 'INV-RPL-012', 'Spiker', 'Inventaris Lab RPL', 1, 1, 0, 0, 'Baik', 'Ruang Lab ASM 3', 'images/spiker.jpeg', '2026-11-10 18:32:11', '2026-11-11 21:08:11'),
(13, 4, 'INV-RPL-013', 'Mic + sound', 'Inventaris Lab RPL', 1, 1, 0, 0, 'Baik', 'Ruang Lab ASM 3', 'images/micsound.jpeg', '2026-11-10 18:32:11', '2026-11-11 21:08:11');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` smallint(5) UNSIGNED NOT NULL,
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
-- Table structure for table `loans`
--

CREATE TABLE `loans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_transaksi` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `guru_id` bigint(20) UNSIGNED DEFAULT NULL,
  `tgl_pinjam` date NOT NULL,
  `tgl_kembali_rencana` date NOT NULL,
  `tgl_kembali_aktual` date DEFAULT NULL,
  `keperluan` text NOT NULL,
  `status` enum('Pending','Approved','Rejected','Borrowed','Returned') NOT NULL DEFAULT 'Pending',
  `catatan_admin` text DEFAULT NULL,
  `denda` int(11) NOT NULL DEFAULT 0,
  `status_denda` enum('Belum Lunas','Lunas') NOT NULL DEFAULT 'Lunas',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `loans`
--

INSERT INTO `loans` (`id`, `kode_transaksi`, `user_id`, `guru_id`, `tgl_pinjam`, `tgl_kembali_rencana`, `tgl_kembali_aktual`, `keperluan`, `status`, `catatan_admin`, `denda`, `status_denda`, `created_at`, `updated_at`) VALUES
(1, 'TRX-20261111-4D50', 4, NULL, '2026-11-11', '2026-11-14', NULL, 'tugas', 'Approved', NULL, 0, 'Lunas', '2026-11-10 18:37:21', '2026-11-10 18:39:27'),
(2, 'TRX-20261111-B573', 5, NULL, '2026-11-11', '2026-11-13', NULL, 'adalah pokoknya', 'Rejected', 'halah', 0, 'Lunas', '2026-11-11 06:33:34', '2026-11-11 06:34:01'),
(3, 'TRX-20261112-199A', 4, NULL, '2026-11-12', '2026-11-15', NULL, 'gdgbd', 'Approved', NULL, 0, 'Lunas', '2026-11-11 20:51:44', '2026-11-11 20:52:03'),
(4, 'TRX-20261112-B161', 4, NULL, '2026-11-12', '2026-11-15', NULL, 'fvfvfdvf', 'Approved', NULL, 0, 'Lunas', '2026-11-11 21:18:35', '2026-11-11 21:20:22'),
(5, 'TRX-20261112-EF8B', 5, NULL, '2026-11-12', '2026-11-15', NULL, 'frfvf', 'Approved', NULL, 0, 'Lunas', '2026-11-11 21:21:11', '2026-11-11 21:21:55'),
(6, 'TRX-20261112-7608', 4, NULL, '2026-11-12', '2026-11-15', '2026-11-12', 'svfsv', 'Returned', NULL, 0, 'Lunas', '2026-11-11 21:26:57', '2026-11-11 21:51:32'),
(7, 'TRX-20261112-28EC', 4, NULL, '2026-11-12', '2026-11-15', '2026-11-20', 'tugas', 'Returned', NULL, 25000, 'Belum Lunas', '2026-11-12 03:53:45', '2026-11-12 04:55:05'),
(8, 'TRX-20261112-31EC', 5, NULL, '2026-11-12', '2026-11-15', NULL, 'tugas', 'Rejected', 'gpp', 0, 'Lunas', '2026-11-12 03:59:06', '2026-11-12 04:54:01'),
(9, 'TRX-20261112-FFB7', 5, NULL, '2026-11-12', '2026-11-15', NULL, 'tugas', 'Rejected', 'gpp', 0, 'Lunas', '2026-11-12 04:15:39', '2026-11-12 04:38:41'),
(10, 'TRX-20261112-2A8F', 5, NULL, '2026-11-12', '2026-11-15', '2026-11-13', 'tugas', 'Returned', NULL, 0, 'Lunas', '2026-11-12 04:29:04', '2026-11-12 04:38:19'),
(11, 'TRX-20261112-25FB', 5, NULL, '2026-11-12', '2026-11-15', '2026-11-13', 'tugas', 'Returned', NULL, 0, 'Lunas', '2026-11-12 04:47:53', '2026-11-12 04:53:42');

-- --------------------------------------------------------

--
-- Table structure for table `loan_details`
--

CREATE TABLE `loan_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `loan_id` bigint(20) UNSIGNED NOT NULL,
  `inventory_id` bigint(20) UNSIGNED NOT NULL,
  `jumlah` int(11) NOT NULL,
  `kondisi_kembali` enum('Baik','Rusak Ringan','Rusak Berat') DEFAULT NULL,
  `catatan_kondisi` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `loan_details`
--

INSERT INTO `loan_details` (`id`, `loan_id`, `inventory_id`, `jumlah`, `kondisi_kembali`, `catatan_kondisi`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, NULL, NULL, '2026-11-10 18:37:21', '2026-11-10 18:37:21'),
(2, 2, 2, 5, NULL, NULL, '2026-11-11 06:33:34', '2026-11-11 06:33:34'),
(3, 2, 3, 2, NULL, NULL, '2026-11-11 06:33:34', '2026-11-11 06:33:34'),
(4, 3, 2, 1, NULL, NULL, '2026-11-11 20:51:44', '2026-11-11 20:51:44'),
(5, 4, 1, 1, NULL, NULL, '2026-11-11 21:18:35', '2026-11-11 21:18:35'),
(6, 5, 2, 1, NULL, NULL, '2026-11-11 21:21:11', '2026-11-11 21:21:11'),
(7, 6, 2, 1, 'Baik', NULL, '2026-11-11 21:26:57', '2026-11-11 21:51:32'),
(8, 7, 1, 2, 'Rusak Ringan', 'lecet', '2026-11-12 03:53:45', '2026-11-12 04:55:05'),
(9, 8, 1, 2, NULL, NULL, '2026-11-12 03:59:06', '2026-11-12 03:59:06'),
(10, 9, 2, 5, NULL, NULL, '2026-11-12 04:15:39', '2026-11-12 04:15:39'),
(11, 10, 3, 5, 'Baik', 'baik', '2026-11-12 04:29:04', '2026-11-12 04:38:19'),
(12, 11, 4, 8, 'Baik', 'baik', '2026-11-12 04:47:53', '2026-11-12 04:53:42');

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
(4, '2026_10_18_160507_add_role_and_details_to_users_table', 1),
(5, '2026_10_18_160517_create_categories_table', 1),
(6, '2026_10_18_160527_create_inventories_table', 1),
(7, '2026_10_18_160534_create_loans_table', 1),
(8, '2026_10_18_160540_create_loan_details_table', 1),
(9, '2026_10_25_145249_update_users_table_sipin_v2', 1),
(10, '2026_11_03_030416_update_sipin_v3_database', 1),
(11, '2026_11_04_055532_create_activity_logs_table', 1),
(12, '2026_11_04_114129_add_status_denda_to_loans_table', 1),
(13, '2026_11_04_152932_add_no_hp_to_users_table', 1),
(14, '2026_11_09_221751_create_carts_table', 1);

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
('n8INIrvVPq3gAtWujm50UkV1GXkG3QPYfuUz08Ox', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/157.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJSVlYyYjBKNXAxTjJiN09NMnhmN1ZRdHR1Vk9lNWp2VW5uMU51aGhyIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDBcL2xvZ2luIn19', 1794484560);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `foto_profil` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `role` enum('admin','guru','siswa') NOT NULL DEFAULT 'siswa',
  `kelas` varchar(255) DEFAULT NULL,
  `no_absen` varchar(255) DEFAULT NULL,
  `mata_pelajaran` varchar(255) DEFAULT NULL,
  `jabatan` varchar(255) DEFAULT NULL,
  `unit_kerja` varchar(255) DEFAULT NULL,
  `status_akun` enum('Aktif','Nonaktif') NOT NULL DEFAULT 'Aktif',
  `no_hp` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `foto_profil`, `remember_token`, `created_at`, `updated_at`, `username`, `role`, `kelas`, `no_absen`, `mata_pelajaran`, `jabatan`, `unit_kerja`, `status_akun`, `no_hp`) VALUES
(1, 'Admin', NULL, NULL, '$2y$12$dK7DPPWxRjGSfUgxbTPJjuqKIZEqbw5sjh9hI7TWe7X5GrmiuQCGC', NULL, NULL, '2026-11-10 18:31:55', '2026-11-10 18:31:55', 'admin', 'admin', NULL, NULL, NULL, 'Petugas Toolman', 'Laboratorium RPL SMK Negeri 5 Surakarta', 'Aktif', NULL),
(2, 'Kurniasari, S.Pd, S.Kom', NULL, NULL, '$2y$12$uOzYCcb2ayPkgyzURdeIkuMf1hBNpWWD7o0wTyrscy8ID2L6eo5cK', NULL, NULL, '2026-11-10 18:31:56', '2026-11-10 18:31:56', '198406292010012028', 'guru', NULL, NULL, 'Pemrograman Perangkat Bergerak', NULL, NULL, 'Aktif', NULL),
(3, 'Dwi Esti Wardani, S.Pd, S.Kom', NULL, NULL, '$2y$12$r0KDuC.iYFZ9Au3lhZABs.5Wx2SgSPMDA/VAxXkZ1.rGRfR.brPs6', NULL, NULL, '2026-11-10 18:31:56', '2026-11-10 18:31:56', '197909142008012011', 'guru', NULL, NULL, 'Pemrograman Berbasis Teks, Grafis, dan Multimedia', NULL, NULL, 'Aktif', NULL),
(4, 'Abdul Aziz Nurrahman', NULL, NULL, '$2y$12$/f.6fawJ3abaPCDyAgM3IOvWQwDPWrm1DMHVg8udWsLD1darzPF4.', 'profiles/dDAXehpBkF6nSrKlRC9KfaUcavV1mi9JyeWLYp50.png', NULL, '2026-11-10 18:31:57', '2026-11-10 18:44:00', '24122', 'siswa', 'XII RPL C', '1', NULL, NULL, NULL, 'Aktif', NULL),
(5, 'Adiputra Arya Sena', NULL, NULL, '$2y$12$cr2YLQracPaTAaQtK1mRLu3DGDGDuJAJ3G6l59TamOIlZdjbmHNU6', NULL, NULL, '2026-11-10 18:31:57', '2026-11-12 04:30:04', '24123', 'siswa', 'XII RPL C', '2', NULL, NULL, NULL, 'Aktif', '082324206311'),
(6, 'Alvin Yourry Putra Mentari', NULL, NULL, '$2y$12$6KUi7UEMQlKqwHCtYzfs6erLrUtTvmfN7P7lYMNy1WdUqp7Fby0nS', NULL, NULL, '2026-11-10 18:31:58', '2026-11-10 18:31:58', '24124', 'siswa', 'XII RPL C', '3', NULL, NULL, NULL, 'Aktif', NULL),
(7, 'Amadeo Brian Ranastya Putra', NULL, NULL, '$2y$12$gPxCu.GsEFAIS7fcsk8z7.C4hS2FSgANl1Ge7Oss.XOsgQeN3.mNO', NULL, NULL, '2026-11-10 18:31:58', '2026-11-10 18:31:58', '24125', 'siswa', 'XII RPL C', '4', NULL, NULL, NULL, 'Aktif', NULL),
(8, 'Andreas Kelvin Anasta Putra', NULL, NULL, '$2y$12$vK4pP7I32CNUqhHQLT/p3.Rqvaxe6LEXcaqYQeT4uTlf7FIJ.rBUu', NULL, NULL, '2026-11-10 18:31:59', '2026-11-10 18:31:59', '24127', 'siswa', 'XII RPL C', '5', NULL, NULL, NULL, 'Aktif', NULL),
(9, 'Anjeli Afifah Darajati', NULL, NULL, '$2y$12$QRxnKC4z8pdHuePzMhpRXOCz6VLsgOesWudl1nWKsdQNybt7uZGd6', NULL, NULL, '2026-11-10 18:31:59', '2026-11-10 18:31:59', '24128', 'siswa', 'XII RPL C', '6', NULL, NULL, NULL, 'Aktif', NULL),
(10, 'Azriel Aida Nurochim', NULL, NULL, '$2y$12$ABy30xuKvY/m/7zQHJt9e.c2uf.E1IVYJSR4Zi6P4q9QJ9U3nnPLO', NULL, NULL, '2026-11-10 18:32:00', '2026-11-10 18:32:00', '24129', 'siswa', 'XII RPL C', '7', NULL, NULL, NULL, 'Aktif', NULL),
(11, 'Bintang Fahri Hascarya', NULL, NULL, '$2y$12$2S7RktseE9THjyR1PRJqU.OnOotdK.dETUe.Bc3K.FjmZmloMkXaq', NULL, NULL, '2026-11-10 18:32:00', '2026-11-10 18:32:00', '24130', 'siswa', 'XII RPL C', '8', NULL, NULL, NULL, 'Aktif', NULL),
(12, 'Carisha Amira Insani', NULL, NULL, '$2y$12$yrttIfJc2JyWD.hWPsmDC.9zwV8.KHdeC/gTrmxQe6ti2/vJtpb7q', NULL, NULL, '2026-11-10 18:32:01', '2026-11-10 18:32:01', '24131', 'siswa', 'XII RPL C', '9', NULL, NULL, NULL, 'Aktif', NULL),
(13, 'Chelsea Muhammad Adli', NULL, NULL, '$2y$12$fdy9oupWX7z3d/PNH/gWT.ySXcedAi14.OlHtnLuAyoVarxBIldA2', NULL, NULL, '2026-11-10 18:32:01', '2026-11-10 18:32:01', '24132', 'siswa', 'XII RPL C', '10', NULL, NULL, NULL, 'Aktif', NULL),
(14, 'Christian Wardana', NULL, NULL, '$2y$12$zgc0WFL8s0n1BsTaQRbK/eoZTDR4DHnMj8NaBRlRXC1JzQFxt50Ie', NULL, NULL, '2026-11-10 18:32:01', '2026-11-10 18:32:01', '24133', 'siswa', 'XII RPL C', '11', NULL, NULL, NULL, 'Aktif', NULL),
(15, 'Cleodora Bertha Fortuna', NULL, NULL, '$2y$12$53swzXuJavatlBN/Q7MOr..eCuRVX9JAIY/C7K94SpaAn.Y.wMrs6', NULL, NULL, '2026-11-10 18:32:02', '2026-11-10 18:32:02', '24134', 'siswa', 'XII RPL C', '12', NULL, NULL, NULL, 'Aktif', NULL),
(16, 'Cristiano Vieli Kaligis', NULL, NULL, '$2y$12$1wDOrpVPTQTaH9PVfL7JmO0l/DjQ1zx8iUfDGpRb0uHLOrjwj4SZW', NULL, NULL, '2026-11-10 18:32:02', '2026-11-10 18:32:02', '24135', 'siswa', 'XII RPL C', '13', NULL, NULL, NULL, 'Aktif', NULL),
(17, 'Daffa Farah Irfanudin', NULL, NULL, '$2y$12$5dGIWJgMvuQNaRjoVYPDF.m7BQkRrv62L7tjDvlk/AvOz/jqoQDAK', NULL, NULL, '2026-11-10 18:32:03', '2026-11-10 18:32:03', '24136', 'siswa', 'XII RPL C', '14', NULL, NULL, NULL, 'Aktif', NULL),
(18, 'Desta Tiar Redriana', NULL, NULL, '$2y$12$jO1Dn1DzVksJRM/kX9eVW.QehXQFv0izTb3U6lFRFGxG5PnF83svW', NULL, NULL, '2026-11-10 18:32:03', '2026-11-10 18:32:03', '24137', 'siswa', 'XII RPL C', '15', NULL, NULL, NULL, 'Aktif', NULL),
(19, 'Farrel Brilliant Nugroho', NULL, NULL, '$2y$12$tCWDzGIjlulBQrLqe82Xh.QbKMAGYpMo9cCBKrfxpQOedv9mPWSEW', NULL, NULL, '2026-11-10 18:32:04', '2026-11-10 18:32:04', '24138', 'siswa', 'XII RPL C', '16', NULL, NULL, NULL, 'Aktif', NULL),
(20, 'Fida Qurotu Aini', NULL, NULL, '$2y$12$Cyz4nOTUzxOy4AEyhzUmk.8wcdQieUXhuFpcT0PRovuoKclFRnM/S', NULL, NULL, '2026-11-10 18:32:04', '2026-11-10 18:32:04', '24139', 'siswa', 'XII RPL C', '17', NULL, NULL, NULL, 'Aktif', NULL),
(21, 'Ghozi Mumtaza Hanif', NULL, NULL, '$2y$12$n7dahfeoRJMTmXnsi0LrIO6ZcQm3cN7H8N54kJq7qUjBye/Pt96Ve', NULL, NULL, '2026-11-10 18:32:05', '2026-11-10 18:32:05', '24140', 'siswa', 'XII RPL C', '18', NULL, NULL, NULL, 'Aktif', NULL),
(22, 'Irfan Aji Wardana', NULL, NULL, '$2y$12$3VWIBsceulNEyYVXKs4RGe.x869QjFE8xN3O3MpJyx3ls52t2VH4S', NULL, NULL, '2026-11-10 18:32:05', '2026-11-10 18:32:05', '24141', 'siswa', 'XII RPL C', '19', NULL, NULL, NULL, 'Aktif', NULL),
(23, 'Manestiko Banyubiru', NULL, NULL, '$2y$12$2W8WfA9LQ2kPS6CA1UX5DOz0GzIKN0o4pYs21kTJcR617DIl84oRS', NULL, NULL, '2026-11-10 18:32:06', '2026-11-10 18:32:06', '24142', 'siswa', 'XII RPL C', '20', NULL, NULL, NULL, 'Aktif', NULL),
(24, 'Michael Aditya', NULL, NULL, '$2y$12$P3YlTQRG6rcICTmQK4.IFu3KCl4qnLDJgNKxUt7ZVq5G4Gss9CLgO', NULL, NULL, '2026-11-10 18:32:06', '2026-11-10 18:32:06', '24144', 'siswa', 'XII RPL C', '21', NULL, NULL, NULL, 'Aktif', NULL),
(25, 'Moses Adi Saputra', NULL, NULL, '$2y$12$shPGoiMW6lgWQN4xdNEozuUVq1iu.VI0U58Ooc4bd0bCa.H7GE5zu', NULL, NULL, '2026-11-10 18:32:07', '2026-11-10 18:32:07', '24145', 'siswa', 'XII RPL C', '22', NULL, NULL, NULL, 'Aktif', NULL),
(26, 'Muhammad Anshori', NULL, NULL, '$2y$12$ObfqRMeOMehq3x2N50MZJOpx3W6eln8WztW7au/gBEr4qHI1SBlWy', NULL, NULL, '2026-11-10 18:32:07', '2026-11-10 18:32:07', '24146', 'siswa', 'XII RPL C', '23', NULL, NULL, NULL, 'Aktif', NULL),
(27, 'Muhammad Fahri Rahman Arrafi', NULL, NULL, '$2y$12$W/jBVd7ZMrgO/gMKFWG0lOHHaqJXSs4EfSP/7dYlWsl46zurK7D8G', NULL, NULL, '2026-11-10 18:32:08', '2026-11-10 18:32:08', '24147', 'siswa', 'XII RPL C', '24', NULL, NULL, NULL, 'Aktif', NULL),
(28, 'Muhammad Rosyid Muryanto', NULL, NULL, '$2y$12$LB/4BgJhCno7u0agZqNGeOV2rzuIqj2sEfJqZEurRnLpMo1qIyLqK', NULL, NULL, '2026-11-10 18:32:08', '2026-11-10 18:32:08', '24148', 'siswa', 'XII RPL C', '25', NULL, NULL, NULL, 'Aktif', NULL),
(29, 'Nicholas Gusti Saputra', NULL, NULL, '$2y$12$0E9Aa/GztIzv0Q2nDxlviuP/7QOQljM4TQnRmYcKOahiR9HU5aM8q', NULL, NULL, '2026-11-10 18:32:09', '2026-11-10 18:32:09', '24149', 'siswa', 'XII RPL C', '26', NULL, NULL, NULL, 'Aktif', NULL),
(30, 'Pranaja Abi Praya Widiyatama', NULL, NULL, '$2y$12$xepmHxD2RR8ZfxY8j755s.7aMm2x9s/THKrSWLwpEW6.6ykHkNlHS', NULL, NULL, '2026-11-10 18:32:09', '2026-11-10 18:32:09', '24150', 'siswa', 'XII RPL C', '27', NULL, NULL, NULL, 'Aktif', NULL),
(31, 'Ramaditya Surya Putra', NULL, NULL, '$2y$12$tX/3.nO1RLEw6FVgv2MCMu/S54uvCD4WItMKv8FAqXBYgo6bToTmC', NULL, NULL, '2026-11-10 18:32:10', '2026-11-10 18:32:10', '24151', 'siswa', 'XII RPL C', '28', NULL, NULL, NULL, 'Aktif', NULL),
(32, 'Sabian Apta Arira', NULL, NULL, '$2y$12$gdpUk5gCVhjlY84gK2IQa.RDkUr2Sa1oOpGTy4DYyRc89IhM9YsTq', NULL, NULL, '2026-11-10 18:32:10', '2026-11-10 18:32:10', '24152', 'siswa', 'XII RPL C', '29', NULL, NULL, NULL, 'Aktif', NULL),
(33, 'Satria Rahmansyah', NULL, NULL, '$2y$12$G6mkOj9nbyULU3l.8MWsjuLge9.CMrZhfkhiF1K0p3Kf6YypjzT3i', NULL, NULL, '2026-11-10 18:32:10', '2026-11-10 18:32:10', '24153', 'siswa', 'XII RPL C', '30', NULL, NULL, NULL, 'Aktif', NULL),
(34, 'Theodoric Bakuh Panggalih', NULL, NULL, '$2y$12$aSbfkWhy./9kVk8bPx/q6uuy8ocKSTaIbmkKb09FKhP1mUr7hWOOK', NULL, NULL, '2026-11-10 18:32:11', '2026-11-10 18:32:11', '24154', 'siswa', 'XII RPL C', '31', NULL, NULL, NULL, 'Aktif', NULL),
(35, 'Xian Adi Nugroho', NULL, NULL, '$2y$12$GRU3bybeS/NRhxKYTJOtN.br4S8yqVvmZRL/GGvT5Flqx2mDXtgWC', NULL, NULL, '2026-11-10 18:32:11', '2026-11-10 18:32:11', '24155', 'siswa', 'XII RPL C', '32', NULL, NULL, NULL, 'Aktif', NULL);

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
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_user_id_foreign` (`user_id`),
  ADD KEY `carts_inventory_id_foreign` (`inventory_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_kode_kategori_unique` (`kode_kategori`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  ADD KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`);

--
-- Indexes for table `inventories`
--
ALTER TABLE `inventories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `inventories_kode_inventaris_unique` (`kode_inventaris`),
  ADD KEY `inventories_category_id_foreign` (`category_id`);

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
-- Indexes for table `loans`
--
ALTER TABLE `loans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `loans_kode_transaksi_unique` (`kode_transaksi`),
  ADD KEY `loans_user_id_foreign` (`user_id`),
  ADD KEY `loans_guru_id_foreign` (`guru_id`);

--
-- Indexes for table `loan_details`
--
ALTER TABLE `loan_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `loan_details_loan_id_foreign` (`loan_id`),
  ADD KEY `loan_details_inventory_id_foreign` (`inventory_id`);

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
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventories`
--
ALTER TABLE `inventories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `loan_details`
--
ALTER TABLE `loan_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD CONSTRAINT `activity_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_inventory_id_foreign` FOREIGN KEY (`inventory_id`) REFERENCES `inventories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `inventories`
--
ALTER TABLE `inventories`
  ADD CONSTRAINT `inventories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `loans`
--
ALTER TABLE `loans`
  ADD CONSTRAINT `loans_guru_id_foreign` FOREIGN KEY (`guru_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `loans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `loan_details`
--
ALTER TABLE `loan_details`
  ADD CONSTRAINT `loan_details_inventory_id_foreign` FOREIGN KEY (`inventory_id`) REFERENCES `inventories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `loan_details_loan_id_foreign` FOREIGN KEY (`loan_id`) REFERENCES `loans` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
