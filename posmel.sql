-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2020 at 03:17 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `posmel`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `nama_admin` varchar(200) NOT NULL,
  `email_admin` varchar(200) NOT NULL,
  `password_admin` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama_admin`, `email_admin`, `password_admin`) VALUES
(1, 'admin', 'admin@admin.com', '21232f297a57a5a743894a0e4a801fc3'),
(3, 'coba', 'coba@coba.com', 'c3ec0f7b054e729c5a716c8125839829'),
(4, 'andi', 'andi@mellydia.com', '92b26601b79e0799837c33f39c0466b2');

-- --------------------------------------------------------

--
-- Table structure for table `admin_akses`
--

CREATE TABLE `admin_akses` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `akses_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_akses`
--

INSERT INTO `admin_akses` (`id`, `admin_id`, `akses_id`) VALUES
(17, 3, 7),
(18, 3, 8),
(37, 1, 1),
(38, 1, 3),
(39, 1, 4),
(40, 1, 11),
(41, 1, 2),
(42, 1, 5),
(43, 1, 6),
(44, 1, 7),
(45, 1, 8),
(46, 1, 9),
(47, 1, 10),
(48, 4, 3),
(49, 4, 4),
(50, 4, 6),
(51, 4, 8),
(52, 4, 10);

-- --------------------------------------------------------

--
-- Table structure for table `akses`
--

CREATE TABLE `akses` (
  `id_akses` int(11) NOT NULL,
  `nama_akses` varchar(200) NOT NULL,
  `link` varchar(200) NOT NULL,
  `modul_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `akses`
--

INSERT INTO `akses` (`id_akses`, `nama_akses`, `link`, `modul_id`) VALUES
(1, 'User', 'user', 1),
(2, 'Kategori', 'kategori', 2),
(3, 'Customer', 'customer', 1),
(4, 'Marketplace', 'marketplace', 1),
(5, 'Produk', 'produk', 2),
(6, 'Paket', 'paket', 2),
(7, 'Pembelian', 'pembelian', 3),
(8, 'Penjualan', 'penjualan', 3),
(9, 'Pembelian', 'laporan', 4),
(10, 'Penjualan', 'laporan/penjualan', 4),
(11, 'Minimal Stock', 'stokmin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(3, 'Skincare'),
(4, 'Bodycare');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id_member` int(11) NOT NULL,
  `nama_member` varchar(200) NOT NULL,
  `alamat_member` text NOT NULL,
  `telp_member` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id_member`, `nama_member`, `alamat_member`, `telp_member`) VALUES
(1, 'Andika', 'alamat 1', '081234234324'),
(2, 'Budi', 'jl jalan no 123', '081224325234'),
(3, 'Cici', 'di hatimu', '0823543534534');

-- --------------------------------------------------------

--
-- Table structure for table `modul`
--

CREATE TABLE `modul` (
  `id_modul` int(11) NOT NULL,
  `nama_modul` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `modul`
--

INSERT INTO `modul` (`id_modul`, `nama_modul`) VALUES
(1, 'Master Data'),
(2, 'Master Barang'),
(3, 'Transaksi'),
(4, 'Laporan');

-- --------------------------------------------------------

--
-- Table structure for table `notif_limit`
--

CREATE TABLE `notif_limit` (
  `id` int(11) NOT NULL,
  `batas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notif_limit`
--

INSERT INTO `notif_limit` (`id`, `batas`) VALUES
(1, 100);

-- --------------------------------------------------------

--
-- Table structure for table `paket`
--

CREATE TABLE `paket` (
  `id_paket` int(11) NOT NULL,
  `nama_paket` varchar(200) NOT NULL,
  `total_harga_paket` int(11) NOT NULL,
  `kode_paket` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `paket`
--

INSERT INTO `paket` (`id_paket`, `nama_paket`, `total_harga_paket`, `kode_paket`) VALUES
(6, 'Mellydia Paket Lengkap A', 390000, 'm-456'),
(7, 'Mellydia Paket Ideal A', 300000, 'm-123');

-- --------------------------------------------------------

--
-- Table structure for table `paket_produk`
--

CREATE TABLE `paket_produk` (
  `id` int(11) NOT NULL,
  `paket_id` int(11) NOT NULL,
  `produk_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `paket_produk`
--

INSERT INTO `paket_produk` (`id`, `paket_id`, `produk_id`) VALUES
(39, 7, 10),
(40, 7, 7),
(41, 7, 11),
(42, 7, 8),
(43, 6, 10),
(44, 6, 7),
(45, 6, 11),
(46, 6, 8),
(47, 6, 9);

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `id_pembelian` int(11) NOT NULL,
  `produk_id` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `harga_satuan` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `tgl` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`id_pembelian`, `produk_id`, `total_harga`, `harga_satuan`, `qty`, `tgl`) VALUES
(5, 3, 10000, 5000, 2, '2020-10-28'),
(6, 4, 50000, 5000, 10, '2020-10-29'),
(7, 3, 25000, 5000, 5, '2020-10-29'),
(8, 5, 200000, 10000, 20, '2020-10-29'),
(9, 8, 900000, 15000, 60, '2020-11-07');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `id_penjualan` int(11) NOT NULL,
  `diskon` int(11) NOT NULL,
  `ongkir` int(11) NOT NULL,
  `kurir` varchar(100) NOT NULL,
  `resi` varchar(200) NOT NULL,
  `status` varchar(30) NOT NULL,
  `total_berat` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `tgl_penjualan` date NOT NULL,
  `tgl_proses` date NOT NULL,
  `tgl_selesai` date NOT NULL,
  `member_id` int(11) NOT NULL,
  `sumber_id` int(11) NOT NULL,
  `nama_penerima` varchar(100) NOT NULL,
  `alamat_penerima` text NOT NULL,
  `telp_penerima` varchar(100) NOT NULL,
  `ket` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`id_penjualan`, `diskon`, `ongkir`, `kurir`, `resi`, `status`, `total_berat`, `total_harga`, `admin_id`, `tgl_penjualan`, `tgl_proses`, `tgl_selesai`, `member_id`, `sumber_id`, `nama_penerima`, `alamat_penerima`, `telp_penerima`, `ket`) VALUES
(25, 0, 15000, 'JNT', 'JP09090909090', 'selesai', 1000, 369325, 4, '2020-11-07', '2020-11-07', '2020-11-07', 1, 4, 'Andika', 'alamat 1', '081234234324', ''),
(26, 10, 0, 'JNT', 'JP9898928298', 'selesai', 800, 277695, 1, '2020-11-07', '2020-11-07', '2020-11-07', 2, 2, 'Budi', 'jl jalan no 123', '081224325234', ''),
(27, 0, 12000, 'pos', '12345', 'selesai', 1600, 600000, 1, '2020-11-12', '2020-11-12', '2020-11-12', 1, 3, 'Andika', 'alamat 1', '081234234324', ''),
(29, 0, 12000, 'pos', '123456789', 'selesai', 2800, 1090000, 1, '2020-11-16', '2020-11-16', '2020-11-16', 3, 3, 'Cici', 'di hatimu', '0823543534534', '');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan_paket`
--

CREATE TABLE `penjualan_paket` (
  `id_penjualan_paket` int(11) NOT NULL,
  `paket_id` int(11) NOT NULL,
  `harga_paket` int(11) NOT NULL,
  `berat_paket` int(11) NOT NULL,
  `penjualan_id` int(11) NOT NULL,
  `qty_paket` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penjualan_paket`
--

INSERT INTO `penjualan_paket` (`id_penjualan_paket`, `paket_id`, `harga_paket`, `berat_paket`, `penjualan_id`, `qty_paket`) VALUES
(20, 6, 335750, 1000, 25, 1),
(21, 7, 280500, 800, 26, 1),
(22, 7, 600000, 1600, 27, 2),
(25, 7, 600000, 1600, 29, 2),
(26, 6, 390000, 1000, 29, 1),
(27, 0, 100000, 200, 29, 1);

-- --------------------------------------------------------

--
-- Table structure for table `penjualan_produk`
--

CREATE TABLE `penjualan_produk` (
  `id_penjualan_produk` int(11) NOT NULL,
  `penjualan_paket_id` int(11) NOT NULL,
  `produk_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `penjualan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penjualan_produk`
--

INSERT INTO `penjualan_produk` (`id_penjualan_produk`, `penjualan_paket_id`, `produk_id`, `qty`, `harga`, `penjualan_id`) VALUES
(26, 20, 7, 1, 65000, 25),
(27, 20, 8, 1, 65000, 25),
(28, 20, 9, 1, 65000, 25),
(29, 20, 10, 1, 100000, 25),
(30, 20, 11, 1, 100000, 25),
(31, 21, 7, 1, 65000, 26),
(32, 21, 8, 1, 65000, 26),
(33, 21, 10, 1, 100000, 26),
(34, 21, 11, 1, 100000, 26),
(35, 22, 10, 2, 200000, 27),
(36, 22, 7, 2, 130000, 27),
(37, 22, 11, 2, 200000, 27),
(38, 22, 8, 2, 130000, 27),
(48, 25, 10, 2, 200000, 29),
(49, 25, 7, 2, 130000, 29),
(50, 25, 11, 2, 200000, 29),
(51, 25, 8, 2, 130000, 29),
(52, 26, 10, 1, 100000, 29),
(53, 26, 7, 1, 65000, 29),
(54, 26, 11, 1, 100000, 29),
(55, 26, 8, 1, 65000, 29),
(56, 26, 9, 1, 65000, 29),
(57, 27, 10, 1, 100000, 29);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(200) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `berat` varchar(20) NOT NULL,
  `kode_produk` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `harga_beli`, `harga_jual`, `stok`, `berat`, `kode_produk`) VALUES
(7, 'Mellydia Facial Foam', 15000, 65000, 90, '200', 'M-FFOAM'),
(8, 'Mellydia Toner', 15000, 65000, 100, '200', 'M-TONER'),
(9, 'Mellydia Whitening Serum', 15000, 65000, 87, '200', 'M-WSERUM'),
(10, 'Mellydia Day Cream', 28000, 100000, 139, '200', 'M-DCREAM'),
(11, 'Mellydia Night Cream', 28000, 100000, 180, '200', 'M-NCREAM');

-- --------------------------------------------------------

--
-- Table structure for table `produk_kategori`
--

CREATE TABLE `produk_kategori` (
  `id` int(11) NOT NULL,
  `produk_id` int(11) NOT NULL,
  `kategori_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk_kategori`
--

INSERT INTO `produk_kategori` (`id`, `produk_id`, `kategori_id`) VALUES
(20, 7, 3),
(21, 8, 3),
(23, 10, 3),
(24, 11, 3),
(25, 9, 3);

-- --------------------------------------------------------

--
-- Table structure for table `sumber_market`
--

CREATE TABLE `sumber_market` (
  `id_sumber` int(11) NOT NULL,
  `nama_market` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sumber_market`
--

INSERT INTO `sumber_market` (`id_sumber`, `nama_market`) VALUES
(1, 'Tokopedia'),
(2, 'Shopee'),
(3, 'Lazada'),
(4, 'Non-Marketplace');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `admin_akses`
--
ALTER TABLE `admin_akses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `akses`
--
ALTER TABLE `akses`
  ADD PRIMARY KEY (`id_akses`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id_member`);

--
-- Indexes for table `modul`
--
ALTER TABLE `modul`
  ADD PRIMARY KEY (`id_modul`);

--
-- Indexes for table `notif_limit`
--
ALTER TABLE `notif_limit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paket`
--
ALTER TABLE `paket`
  ADD PRIMARY KEY (`id_paket`);

--
-- Indexes for table `paket_produk`
--
ALTER TABLE `paket_produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id_pembelian`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id_penjualan`);

--
-- Indexes for table `penjualan_paket`
--
ALTER TABLE `penjualan_paket`
  ADD PRIMARY KEY (`id_penjualan_paket`);

--
-- Indexes for table `penjualan_produk`
--
ALTER TABLE `penjualan_produk`
  ADD PRIMARY KEY (`id_penjualan_produk`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `produk_kategori`
--
ALTER TABLE `produk_kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sumber_market`
--
ALTER TABLE `sumber_market`
  ADD PRIMARY KEY (`id_sumber`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `admin_akses`
--
ALTER TABLE `admin_akses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `akses`
--
ALTER TABLE `akses`
  MODIFY `id_akses` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id_member` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `modul`
--
ALTER TABLE `modul`
  MODIFY `id_modul` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `paket`
--
ALTER TABLE `paket`
  MODIFY `id_paket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `paket_produk`
--
ALTER TABLE `paket_produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id_pembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id_penjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `penjualan_paket`
--
ALTER TABLE `penjualan_paket`
  MODIFY `id_penjualan_paket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `penjualan_produk`
--
ALTER TABLE `penjualan_produk`
  MODIFY `id_penjualan_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `produk_kategori`
--
ALTER TABLE `produk_kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `sumber_market`
--
ALTER TABLE `sumber_market`
  MODIFY `id_sumber` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
