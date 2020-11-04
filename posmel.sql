-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 04, 2020 at 05:57 PM
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
(3, 'coba', 'coba@coba.com', 'c3ec0f7b054e729c5a716c8125839829');

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
(27, 1, 1),
(28, 1, 3),
(29, 1, 4),
(30, 1, 2),
(31, 1, 5),
(32, 1, 6),
(33, 1, 7),
(34, 1, 8),
(35, 1, 9),
(36, 1, 10);

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
(10, 'Penjualan', 'laporan/penjualan', 4);

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
(3, 'kategori 1'),
(4, 'kategori 2');

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
(1, 'member 1', 'alamat', '081'),
(2, 'member lagi', 'jl jalan no 123', '0812');

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
-- Table structure for table `paket`
--

CREATE TABLE `paket` (
  `id_paket` int(11) NOT NULL,
  `nama_paket` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `paket`
--

INSERT INTO `paket` (`id_paket`, `nama_paket`) VALUES
(4, 'Paket A'),
(5, 'Paket B');

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
(1, 4, 3),
(2, 4, 4),
(6, 5, 4),
(7, 5, 5);

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
(8, 5, 200000, 10000, 20, '2020-10-29');

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
(22, 0, 15000, 'pos', '12345', 'selesai', 1800, 5143, 1, '2020-10-28', '2020-11-03', '2020-11-03', 1, 2, 'member 1', 'alamat', '081', 'batal'),
(23, 0, 12000, 'jne', '23456', 'selesai', 900, 2750, 1, '2020-11-03', '2020-11-03', '2020-11-03', 1, 1, 'member 1', 'alamat', '081', ''),
(24, 0, 12000, 'tiki', '123456', 'selesai', 1900, 30855, 1, '2020-11-04', '2020-11-04', '2020-11-04', 2, 2, 'member lagi', 'jl jalan no 123', '0812', '');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan_paket`
--

CREATE TABLE `penjualan_paket` (
  `id_penjualan_paket` int(11) NOT NULL,
  `paket_id` int(11) NOT NULL,
  `harga_paket` int(11) NOT NULL,
  `berat_paket` int(11) NOT NULL,
  `penjualan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penjualan_paket`
--

INSERT INTO `penjualan_paket` (`id_penjualan_paket`, `paket_id`, `harga_paket`, `berat_paket`, `penjualan_id`) VALUES
(17, 4, 4675, 1800, 22),
(18, 0, 2500, 900, 23),
(19, 5, 28050, 1900, 24);

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
(21, 17, 3, 1, 2500, 22),
(22, 17, 4, 1, 3000, 22),
(23, 18, 3, 1, 2500, 23),
(24, 19, 4, 1, 3000, 24),
(25, 19, 5, 2, 30000, 24);

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
  `berat` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `harga_beli`, `harga_jual`, `stok`, `berat`) VALUES
(3, 'Produk', 5000, 2500, 7, '900'),
(4, 'Produk 1', 5000, 3000, 13, '900'),
(5, 'Produk 2', 10000, 15000, 2, '500');

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
(5, 4, 3),
(6, 4, 4),
(8, 5, 3),
(9, 5, 4),
(10, 3, 3);

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
(2, 'Shopee');

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
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `admin_akses`
--
ALTER TABLE `admin_akses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `akses`
--
ALTER TABLE `akses`
  MODIFY `id_akses` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id_member` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `modul`
--
ALTER TABLE `modul`
  MODIFY `id_modul` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `paket`
--
ALTER TABLE `paket`
  MODIFY `id_paket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `paket_produk`
--
ALTER TABLE `paket_produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id_pembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id_penjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `penjualan_paket`
--
ALTER TABLE `penjualan_paket`
  MODIFY `id_penjualan_paket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `penjualan_produk`
--
ALTER TABLE `penjualan_produk`
  MODIFY `id_penjualan_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `produk_kategori`
--
ALTER TABLE `produk_kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `sumber_market`
--
ALTER TABLE `sumber_market`
  MODIFY `id_sumber` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
