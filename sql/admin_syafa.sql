-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Des 2023 pada 07.42
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `admin_syafa`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_penjualan`
--

CREATE TABLE `data_penjualan` (
  `id_jual` int(11) NOT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `tanggal_jual` date NOT NULL,
  `nama_barang` varchar(255) DEFAULT NULL,
  `jumlah_jual` int(11) DEFAULT NULL,
  `harga_jual` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `data_penjualan`
--

INSERT INTO `data_penjualan` (`id_jual`, `id_barang`, `tanggal_jual`, `nama_barang`, `jumlah_jual`, `harga_jual`) VALUES
(35, 3, '2023-11-29', 'Botol 330 ml', 400, 6000),
(36, 4, '2023-10-19', 'Botol 600 ml', 500, 7000),
(37, 2, '2023-09-07', 'Cup', 1000, 5000),
(38, 1, '2023-08-23', 'Galon', 500, 10000),
(39, 3, '2023-07-20', 'Botol 330 ml', 200, 6000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_produksi`
--

CREATE TABLE `data_produksi` (
  `id_produksi` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `tanggal_produksi` date NOT NULL,
  `nama_barang` varchar(255) DEFAULT NULL,
  `jumlah_produksi` int(11) DEFAULT NULL,
  `harga_produksi` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `data_produksi`
--

INSERT INTO `data_produksi` (`id_produksi`, `id_barang`, `tanggal_produksi`, `nama_barang`, `jumlah_produksi`, `harga_produksi`) VALUES
(96, 3, '2023-11-29', 'Botol 330 ml', 200, 3000),
(97, 4, '2023-10-19', 'Botol 600 ml', 200, 4000),
(98, 2, '2023-09-22', 'Cup', 900, 2000),
(99, 1, '2023-07-13', 'Galon', 800, 5000),
(100, 3, '2023-08-16', 'Botol 330 ml', 500, 3000),
(101, 2, '2023-06-22', 'Cup', 1000, 2000),
(102, 4, '2023-11-29', 'Botol 600 ml', 1000, 4000),
(103, 4, '2023-11-22', 'Botol 600 ml', 700, 4000),
(104, 1, '2023-07-20', 'Galon', 2000, 5000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `stok_barang`
--

CREATE TABLE `stok_barang` (
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(255) DEFAULT NULL,
  `jumlah_stok` int(11) DEFAULT NULL,
  `harga_produksi` int(255) NOT NULL,
  `harga_jual` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `stok_barang`
--

INSERT INTO `stok_barang` (`id_barang`, `nama_barang`, `jumlah_stok`, `harga_produksi`, `harga_jual`) VALUES
(1, 'Galon', 12, 5000, 10000),
(2, 'Cup', 16, 2000, 5000),
(3, 'Botol 330 ml', 29, 3000, 6000),
(4, 'Botol 600 ml', 60, 4000, 7000);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `data_penjualan`
--
ALTER TABLE `data_penjualan`
  ADD PRIMARY KEY (`id_jual`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indeks untuk tabel `data_produksi`
--
ALTER TABLE `data_produksi`
  ADD PRIMARY KEY (`id_produksi`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indeks untuk tabel `stok_barang`
--
ALTER TABLE `stok_barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD UNIQUE KEY `harga_produksi` (`harga_produksi`,`harga_jual`),
  ADD UNIQUE KEY `nama_barang` (`nama_barang`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `data_penjualan`
--
ALTER TABLE `data_penjualan`
  MODIFY `id_jual` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT untuk tabel `data_produksi`
--
ALTER TABLE `data_produksi`
  MODIFY `id_produksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `data_penjualan`
--
ALTER TABLE `data_penjualan`
  ADD CONSTRAINT `data_penjualan_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `stok_barang` (`id_barang`);

--
-- Ketidakleluasaan untuk tabel `data_produksi`
--
ALTER TABLE `data_produksi`
  ADD CONSTRAINT `data_produksi_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `stok_barang` (`id_barang`),
  ADD CONSTRAINT `data_produksi_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `stok_barang` (`id_barang`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
