-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Jul 2023 pada 14.26
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pemesanan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_admin`
--

INSERT INTO `tb_admin` (`id`, `username`, `password`, `email`) VALUES
(1, 'boprinting', '123456', 'boprinting@gmail.com');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pemesanan`
--

CREATE TABLE `tb_pemesanan` (
  `kd_pemesanan` char(8) NOT NULL,
  `id_user` int(11) NOT NULL,
  `Kd_Barang` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `nohp` int(15) NOT NULL,
  `qty` int(3) NOT NULL,
  `alamat` text NOT NULL,
  `total` int(11) NOT NULL,
  `status` enum('Belum Bayar','Dibayar','Selesai') NOT NULL DEFAULT 'Belum Bayar',
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_pemesanan`
--

INSERT INTO `tb_pemesanan` (`kd_pemesanan`, `id_user`, `Kd_Barang`, `nama`, `email`, `nohp`, `qty`, `alamat`, `total`, `status`, `tanggal`) VALUES
('BO-43076', 4, 10, 'Samirul Huda', 'samirulhuda@gmail.com', 2147483647, 3, 'Dk. Cokrah, Ds. Pododadi, Kec. Karanganyar, Kab. Pekalongan', 225000, 'Selesai', '2023-06-28 11:42:36'),
('BO-52186', 6, 9, 'Amar Priambodo', 'amarpriambodo@gmail.com', 2147483647, 5, 'Kec. Tirto', 50000, 'Belum Bayar', '2023-07-02 07:07:41'),
('BO-81469', 5, 8, 'M. Arif Abdillah', 'arifabdillah@gmail.com', 2147483647, 2, 'Ds. Kewayangan, Kec. Kedungwuni, Kab. Pekalongan, Jawa Tengah', 70000, 'Selesai', '2023-06-29 06:56:59');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_stock`
--

CREATE TABLE `tb_stock` (
  `Kd_Barang` int(11) NOT NULL,
  `Nama_Barang` varchar(100) NOT NULL,
  `Jenis_Barang` varchar(100) NOT NULL,
  `Stock` int(10) NOT NULL,
  `Satuan` varchar(20) NOT NULL,
  `Harga` int(11) NOT NULL,
  `Deskripsi` varchar(255) NOT NULL,
  `Foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_stock`
--

INSERT INTO `tb_stock` (`Kd_Barang`, `Nama_Barang`, `Jenis_Barang`, `Stock`, `Satuan`, `Harga`, `Deskripsi`, `Foto`) VALUES
(8, 'Spanduk 2x1', 'Spanduk', 8, 'Meter', 35000, 'Spanduk Super kualitas terbaik, Bahan Flexi Korea', '6493ee02c8f8a.jpg'),
(9, 'Stiker', 'Cetak POD A3', 15, 'Lembar', 10000, 'Stiker lucu, Bebas Request Model', '6493ef42f126e.jpg'),
(10, 'Kaos Sablon DTF', 'Cetak DTF', 7, 'Meter', 75000, 'Kaos Distro bahan cotton combed 24s, Sablon DTF', '6493f35a4554e.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `username`, `nama_lengkap`, `password`, `email`) VALUES
(4, 'samhud', 'Samirul Huda', '$2y$10$dGVMWrFSLFgOexGE/a/vqOQ73IIyGz1dxR42cBB0k5Yt0vWhqshbK', 'samirulhuda@gmail.com'),
(5, 'abdi', 'Arif Abdillah', '$2y$10$1Mvz898Y6fJ28VMaM0HhOeG2nETKf9Y241w7750JDvDFApHw9JGu2', 'arifabdillah@gmail.com'),
(6, 'amar priambodo', '', '$2y$10$/zcR4T3YEgDUQ0J3XIsOCOL/k72butmT0T63tG6lkPLnbDurDWOnO', 'amarpriambodo@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_pemesanan`
--
ALTER TABLE `tb_pemesanan`
  ADD PRIMARY KEY (`kd_pemesanan`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `kd_barang` (`Kd_Barang`);

--
-- Indeks untuk tabel `tb_stock`
--
ALTER TABLE `tb_stock`
  ADD PRIMARY KEY (`Kd_Barang`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_stock`
--
ALTER TABLE `tb_stock`
  MODIFY `Kd_Barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
