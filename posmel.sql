-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 18 Jan 2021 pada 08.45
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `nama_admin` varchar(200) NOT NULL,
  `email_admin` varchar(200) NOT NULL,
  `password_admin` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `nama_admin`, `email_admin`, `password_admin`) VALUES
(1, 'admin', 'admin@admin.com', '21232f297a57a5a743894a0e4a801fc3'),
(3, 'coba', 'coba@coba.com', 'c3ec0f7b054e729c5a716c8125839829'),
(4, 'andi', 'andi@mellydia.com', '92b26601b79e0799837c33f39c0466b2'),
(5, 'Tri', 'triard78@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b'),
(6, 'Yuki', 'yuki@yuki.com', '827ccb0eea8a706c4c34a16891f84e7b');

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin_akses`
--

CREATE TABLE `admin_akses` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `akses_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `admin_akses`
--

INSERT INTO `admin_akses` (`id`, `admin_id`, `akses_id`) VALUES
(17, 3, 7),
(18, 3, 8),
(76, 5, 7),
(77, 5, 8),
(78, 5, 9),
(79, 5, 10),
(118, 4, 3),
(119, 4, 4),
(120, 4, 6),
(121, 4, 10),
(122, 6, 1),
(123, 6, 3),
(124, 6, 4),
(125, 6, 11),
(126, 6, 6),
(161, 1, 1),
(162, 1, 3),
(163, 1, 4),
(164, 1, 11),
(165, 1, 2),
(166, 1, 5),
(167, 1, 6),
(168, 1, 7),
(169, 1, 8),
(170, 1, 13),
(171, 1, 9),
(172, 1, 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `akses`
--

CREATE TABLE `akses` (
  `id_akses` int(11) NOT NULL,
  `nama_akses` varchar(200) NOT NULL,
  `link` varchar(200) NOT NULL,
  `modul_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `akses`
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
(11, 'Minimal Stock', 'stokmin', 1),
(13, 'Edit Transaksi', '-', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(3, 'Skincare'),
(4, 'Bodycare');

-- --------------------------------------------------------

--
-- Struktur dari tabel `member`
--

CREATE TABLE `member` (
  `id_member` int(11) NOT NULL,
  `nama_member` varchar(200) NOT NULL,
  `alamat_member` text NOT NULL,
  `telp_member` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `member`
--

INSERT INTO `member` (`id_member`, `nama_member`, `alamat_member`, `telp_member`) VALUES
(1, 'Andika', 'alamat 1', '081234234324'),
(2, 'Yuki', 'jl jalan no 111', '081224325111'),
(3, 'Cici', 'di hatimu', '0823543534534'),
(4, 'yukk', 'sidoarjo', '08122636377'),
(5, 'tri', 'bojonegoro', '081234567890'),
(6, 'mas', 'sidoarjo', '081234567890');

-- --------------------------------------------------------

--
-- Struktur dari tabel `modul`
--

CREATE TABLE `modul` (
  `id_modul` int(11) NOT NULL,
  `nama_modul` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `modul`
--

INSERT INTO `modul` (`id_modul`, `nama_modul`) VALUES
(1, 'Master Data'),
(2, 'Master Barang'),
(3, 'Transaksi'),
(4, 'Laporan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `notif_limit`
--

CREATE TABLE `notif_limit` (
  `id` int(11) NOT NULL,
  `batas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `notif_limit`
--

INSERT INTO `notif_limit` (`id`, `batas`) VALUES
(1, 100);

-- --------------------------------------------------------

--
-- Struktur dari tabel `paket`
--

CREATE TABLE `paket` (
  `id_paket` int(11) NOT NULL,
  `nama_paket` varchar(200) NOT NULL,
  `total_harga_paket` int(11) NOT NULL,
  `kode_paket` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `paket`
--

INSERT INTO `paket` (`id_paket`, `nama_paket`, `total_harga_paket`, `kode_paket`) VALUES
(6, 'Mellydia Paket Lengkap A', 390000, 'm-456'),
(7, 'Mellydia Paket Ideal A', 300000, 'm-123');

-- --------------------------------------------------------

--
-- Struktur dari tabel `paket_produk`
--

CREATE TABLE `paket_produk` (
  `id` int(11) NOT NULL,
  `paket_id` int(11) NOT NULL,
  `produk_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `paket_produk`
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
-- Struktur dari tabel `pembelian`
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
-- Dumping data untuk tabel `pembelian`
--

INSERT INTO `pembelian` (`id_pembelian`, `produk_id`, `total_harga`, `harga_satuan`, `qty`, `tgl`) VALUES
(5, 3, 10000, 5000, 2, '2020-10-28'),
(6, 4, 50000, 5000, 10, '2020-10-29'),
(7, 3, 25000, 5000, 5, '2020-10-29'),
(8, 5, 200000, 10000, 20, '2020-10-29'),
(9, 8, 900000, 15000, 60, '2020-11-07'),
(11, 10, 60000, 20000, 3, '2021-01-04'),
(12, 8, 40000, 20000, 2, '2021-01-05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan`
--

CREATE TABLE `penjualan` (
  `id_penjualan` int(11) NOT NULL,
  `diskon` int(11) NOT NULL,
  `ongkir` int(11) NOT NULL,
  `kurir` varchar(100) NOT NULL,
  `resi` varchar(200) NOT NULL,
  `status` varchar(30) NOT NULL,
  `total_berat` int(11) NOT NULL,
  `biaya_admin` int(11) NOT NULL,
  `uang_masuk` int(11) NOT NULL,
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
-- Dumping data untuk tabel `penjualan`
--

INSERT INTO `penjualan` (`id_penjualan`, `diskon`, `ongkir`, `kurir`, `resi`, `status`, `total_berat`, `biaya_admin`, `uang_masuk`, `total_harga`, `admin_id`, `tgl_penjualan`, `tgl_proses`, `tgl_selesai`, `member_id`, `sumber_id`, `nama_penerima`, `alamat_penerima`, `telp_penerima`, `ket`) VALUES
(25, 0, 15000, 'JNT', 'JP09090909090', 'batal', 1000, 0, 0, 369325, 4, '2020-11-07', '2021-01-04', '2020-11-07', 1, 4, 'Andika', 'alamat 1', '081234234324', 'bayare kurang'),
(26, 10, 0, 'JNT', 'JP9898928298', 'selesai', 800, 0, 0, 277695, 1, '2020-11-07', '2020-11-07', '2020-11-07', 2, 2, 'Budi', 'jl jalan no 123', '081224325234', ''),
(27, 0, 12000, 'pos', '12345', 'selesai', 1600, 0, 0, 600000, 1, '2020-11-12', '2020-11-12', '2020-11-12', 1, 3, 'Andika', 'alamat 1', '081234234324', ''),
(29, 0, 12000, 'pos', '123456789', 'sedang dikirim', 2800, 5000, 0, 1090000, 1, '2020-11-16', '2020-11-16', '2020-11-16', 3, 3, 'Cici', 'di hatimu', '0823543534534', ''),
(31, 0, 20000, 'J&T', '111', 'selesai', 800, 5000, 0, 300000, 4, '2021-01-06', '2021-01-06', '2021-01-06', 5, 4, 'tri', 'bojonegoro', '081234567890', ''),
(32, 0, 0, '', '', 'sedang dikemas', 1000, 0, 0, 390000, 1, '2021-01-07', '0000-00-00', '0000-00-00', 6, 3, 'mas', 'sidoarjo', '081234567890', ''),
(33, 0, 0, '', '', 'sedang dikemas', 22000, 0, 0, 11000000, 1, '2021-01-14', '0000-00-00', '0000-00-00', 1, 3, 'Andika', 'alamat 1', '081234234324', ''),
(34, 0, 20000, 'JNE', 'RX161006163DE', 'selesai', 800, -5000, 0, 300000, 1, '2021-01-18', '2021-01-18', '2021-01-18', 1, 3, 'Andika', 'alamat 1', '081234234324', ''),
(35, 0, 20000, 'JNE', 'RX161006163DE', 'sedang dikirim', 200, -5000, 0, 100000, 1, '2021-01-18', '2021-01-18', '0000-00-00', 2, 3, 'Budi', 'jl jalan no 123', '081224325234', ''),
(36, 0, 0, '', '', 'batal', 1600, 0, 0, 800000, 1, '2021-01-18', '2021-01-18', '0000-00-00', 1, 3, 'Andika', 'alamat 1', '081234234324', 'x'),
(37, 0, 20000, 'JNE', 'RX161006163DE', 'selesai', 200, 10000, 0, 100000, 1, '2021-01-18', '2021-01-18', '2021-01-18', 2, 3, 'Yuki', 'jl jalan no xxx', '081224325111', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan_paket`
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
-- Dumping data untuk tabel `penjualan_paket`
--

INSERT INTO `penjualan_paket` (`id_penjualan_paket`, `paket_id`, `harga_paket`, `berat_paket`, `penjualan_id`, `qty_paket`) VALUES
(20, 6, 335750, 1000, 25, 1),
(21, 7, 280500, 800, 26, 1),
(22, 7, 600000, 1600, 27, 2),
(25, 7, 600000, 1600, 29, 2),
(26, 6, 390000, 1000, 29, 1),
(27, 0, 100000, 200, 29, 1),
(28, 7, 300000, 800, 30, 1),
(29, 7, 300000, 800, 31, 1),
(30, 6, 390000, 1000, 32, 1),
(31, 0, 11000000, 22000, 33, 150),
(32, 7, 300000, 800, 34, 1),
(33, 0, 100000, 200, 35, 1),
(34, 0, 800000, 1600, 36, 1),
(35, 0, 100000, 200, 37, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan_produk`
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
-- Dumping data untuk tabel `penjualan_produk`
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
(57, 27, 10, 1, 100000, 29),
(58, 28, 7, 1, 65000, 30),
(59, 28, 8, 1, 65000, 30),
(60, 28, 10, 1, 100000, 30),
(61, 28, 11, 1, 100000, 30),
(62, 29, 7, 1, 65000, 31),
(63, 29, 8, 1, 65000, 31),
(64, 29, 10, 1, 100000, 31),
(65, 29, 11, 1, 100000, 31),
(66, 30, 7, 1, 65000, 32),
(67, 30, 8, 1, 65000, 32),
(68, 30, 9, 1, 65000, 32),
(69, 30, 10, 1, 100000, 32),
(70, 30, 11, 1, 100000, 32),
(71, 31, 10, 110, 11000000, 33),
(72, 32, 10, 1, 100000, 34),
(73, 32, 7, 1, 65000, 34),
(74, 32, 11, 1, 100000, 34),
(75, 32, 8, 1, 65000, 34),
(76, 33, 10, 1, 100000, 35),
(77, 34, 10, 8, 800000, 36),
(78, 35, 10, 1, 100000, 37);

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
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
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `harga_beli`, `harga_jual`, `stok`, `berat`, `kode_produk`) VALUES
(7, 'Mellydia Facial Foam', 15000, 65000, 87, '200', 'M-FFOAM'),
(8, 'Mellydia Toner', 20000, 65000, 99, '200', 'M-TONER'),
(9, 'Mellydia Whitening Serum', 15000, 65000, 87, '200', 'M-WSERUM'),
(10, 'Mellydia Day Cream', 20000, 100000, 27, '200', 'M-DCREAM'),
(11, 'Mellydia Night Cream', 28000, 100000, 177, '200', 'M-NCREAM');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk_kategori`
--

CREATE TABLE `produk_kategori` (
  `id` int(11) NOT NULL,
  `produk_id` int(11) NOT NULL,
  `kategori_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `produk_kategori`
--

INSERT INTO `produk_kategori` (`id`, `produk_id`, `kategori_id`) VALUES
(20, 7, 3),
(21, 8, 3),
(23, 10, 3),
(24, 11, 3),
(25, 9, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sumber_market`
--

CREATE TABLE `sumber_market` (
  `id_sumber` int(11) NOT NULL,
  `nama_market` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `sumber_market`
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
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `admin_akses`
--
ALTER TABLE `admin_akses`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `akses`
--
ALTER TABLE `akses`
  ADD PRIMARY KEY (`id_akses`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id_member`);

--
-- Indeks untuk tabel `modul`
--
ALTER TABLE `modul`
  ADD PRIMARY KEY (`id_modul`);

--
-- Indeks untuk tabel `notif_limit`
--
ALTER TABLE `notif_limit`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `paket`
--
ALTER TABLE `paket`
  ADD PRIMARY KEY (`id_paket`);

--
-- Indeks untuk tabel `paket_produk`
--
ALTER TABLE `paket_produk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id_pembelian`);

--
-- Indeks untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id_penjualan`);

--
-- Indeks untuk tabel `penjualan_paket`
--
ALTER TABLE `penjualan_paket`
  ADD PRIMARY KEY (`id_penjualan_paket`);

--
-- Indeks untuk tabel `penjualan_produk`
--
ALTER TABLE `penjualan_produk`
  ADD PRIMARY KEY (`id_penjualan_produk`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indeks untuk tabel `produk_kategori`
--
ALTER TABLE `produk_kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sumber_market`
--
ALTER TABLE `sumber_market`
  ADD PRIMARY KEY (`id_sumber`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `admin_akses`
--
ALTER TABLE `admin_akses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=173;

--
-- AUTO_INCREMENT untuk tabel `akses`
--
ALTER TABLE `akses`
  MODIFY `id_akses` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `member`
--
ALTER TABLE `member`
  MODIFY `id_member` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `modul`
--
ALTER TABLE `modul`
  MODIFY `id_modul` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `paket`
--
ALTER TABLE `paket`
  MODIFY `id_paket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `paket_produk`
--
ALTER TABLE `paket_produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id_pembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id_penjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT untuk tabel `penjualan_paket`
--
ALTER TABLE `penjualan_paket`
  MODIFY `id_penjualan_paket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT untuk tabel `penjualan_produk`
--
ALTER TABLE `penjualan_produk`
  MODIFY `id_penjualan_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `produk_kategori`
--
ALTER TABLE `produk_kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `sumber_market`
--
ALTER TABLE `sumber_market`
  MODIFY `id_sumber` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
