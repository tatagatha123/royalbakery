-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2025 at 03:22 PM
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
-- Database: `dbproject_royalbakery`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `password`) VALUES
(1, 'admin', '123');

-- --------------------------------------------------------

--
-- Table structure for table `laporan_penjualan`
--

CREATE TABLE `laporan_penjualan` (
  `id_laporan` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `total_transaksi` int(11) NOT NULL DEFAULT 0,
  `total_penjualan` decimal(32,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `laporan_penjualan`
--

INSERT INTO `laporan_penjualan` (`id_laporan`, `tanggal`, `total_transaksi`, `total_penjualan`) VALUES
(1, '2025-11-18', 1, 24000),
(2, '2025-11-18', 1, 12000),
(3, '2025-11-18', 1, 15000),
(4, '2025-11-18', 1, 75000),
(5, '2025-11-19', 1, 48000),
(6, '2025-11-19', 1, 48000),
(7, '2025-11-19', 1, 30000),
(8, '2025-11-19', 1, 36000),
(9, '2025-11-19', 1, 24000),
(10, '2025-11-19', 1, 36000),
(11, '2025-11-19', 1, 12000);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `produk_id` int(11) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `stok` int(11) DEFAULT 0,
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`produk_id`, `nama_produk`, `harga`, `stok`, `gambar`) VALUES
(4, 'hijab cat', 12000.00, 85, '1763564105_hijab_cat.jpg'),
(6, 'sexy cat', 15000.00, 12, '1763563991_cat.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `produk_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `nama_user` varchar(100) NOT NULL,
  `nama_produk` text NOT NULL,
  `jumlah` text NOT NULL,
  `harga` text NOT NULL,
  `total` int(11) NOT NULL,
  `alamat` text NOT NULL,
  `metode_pembayaran` varchar(100) NOT NULL,
  `catatan` text DEFAULT NULL,
  `tanggal_pesan` datetime NOT NULL,
  `status` enum('Menunggu Konfirmasi','Diproses','Dikirim','Diterima') DEFAULT 'Menunggu Konfirmasi'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `produk_id`, `user_id`, `username`, `nama_user`, `nama_produk`, `jumlah`, `harga`, `total`, `alamat`, `metode_pembayaran`, `catatan`, `tanggal_pesan`, `status`) VALUES
(20, NULL, 11, 'lola', 'lola', 'Roti bakar', '2', '24000', 24000, 'yy', 'COD', 'yy', '2025-11-18 09:24:37', 'Menunggu Konfirmasi'),
(21, NULL, 11, 'lola', 'lola', 'Roti bakar', '2', '24000', 24000, 'yy', 'COD', 'yy', '2025-11-18 09:33:37', 'Diterima'),
(22, NULL, 11, 'lola', 'lola', 'Roti bakar', '2', '24000', 24000, 'jalan ahmad yani', 'E-Wallet', 'okey', '2025-11-18 09:37:10', 'Diterima'),
(23, NULL, 11, 'lola', 'lola', 'Roti bakar', '1', '12000', 12000, 'jl.ahamd yani', 'E-Wallet', 'jangan pedes yaaa', '2025-11-18 09:37:43', 'Diproses'),
(24, NULL, 11, 'lola', 'lola', 'Roti bakar', '2', '24000', 24000, 'y', 'COD', '', '2025-11-18 09:54:19', 'Menunggu Konfirmasi'),
(25, NULL, 11, 'lola', 'lola', 'kucing bakar', '1', '15000', 15000, 'yyy', 'QRIS', '', '2025-11-18 09:54:34', 'Diproses'),
(26, NULL, 11, 'lola', 'lola', 'kucing bakar', '5', '75000', 75000, 'yy', 'Transfer', 'yy', '2025-11-18 12:42:08', 'Menunggu Konfirmasi'),
(27, NULL, 11, 'lola', 'lola', 'Roti bakar', '1', '12000', 12000, '123', 'Transfer', '123', '2025-11-19 12:57:34', 'Menunggu Konfirmasi'),
(28, NULL, 11, 'lola', 'lola', 'Roti bakar,Sate kobra', '1,3', '12000,36000', 48000, '123', 'COD', 'yy', '2025-11-19 15:40:48', 'Menunggu Konfirmasi'),
(29, NULL, 11, 'lola', 'lola', 'Roti bakar,Sate kobra', '1,3', '12000,36000', 48000, '123', 'COD', 'yy', '2025-11-19 15:41:00', 'Diproses'),
(30, NULL, 12, 'sarah', 'sarah', 'kucing bakar', '2', '30000', 30000, 'bogor', 'COD', 'jangan pedes', '2025-11-19 15:56:51', 'Diterima'),
(31, NULL, 11, 'lola', 'lola', 'Sate kobra', '3', '36000', 36000, '123', 'COD', 'yyy', '2025-11-19 21:45:04', 'Diproses'),
(32, NULL, 11, 'lola', 'lola', 'hijab cat', '2', '24000', 24000, 'jalan.bogor kalimuya no.77 rt/05', 'Transfer', 'jangan manis karena kau sudah manies', '2025-11-19 21:57:25', 'Diterima'),
(33, NULL, 11, 'lola', 'lola', 'hijab cat', '3', '36000', 36000, 'jalan way kambas', 'E-Wallet', '', '2025-11-19 22:00:59', 'Diterima'),
(34, NULL, 11, 'lola', 'lola', 'hijab cat', '1', '12000', 12000, 'y', 'Transfer', 'yyy', '2025-11-19 23:33:24', 'Menunggu Konfirmasi');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(150) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `tanggal_daftar` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `nama_lengkap`, `alamat`, `email`, `no_hp`, `tanggal_daftar`) VALUES
(11, 'lola', '123', 'lola', 'y', 'a@gmai.com', '123', '2025-11-17 17:33:41'),
(12, 'sarah', '123', 'sarah', 'bogor', 's@gmail.com', '123', '2025-11-19 08:56:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `laporan_penjualan`
--
ALTER TABLE `laporan_penjualan`
  ADD PRIMARY KEY (`id_laporan`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`produk_id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `laporan_penjualan`
--
ALTER TABLE `laporan_penjualan`
  MODIFY `id_laporan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `produk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
