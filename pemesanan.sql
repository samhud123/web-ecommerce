-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 13 Jul 2023 pada 14.10
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
(1, 'boprinting', '123', 'boprinting@gmail.com');

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
  `nohp` varchar(15) NOT NULL,
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
('BO-03824', 5, 9, 'M. Arif Abdillah', 'arifabdillah@gmail.com', '2147483647', 3, 'Kedungwuni, Pekalongan', 30000, 'Belum Bayar', '2023-07-08 08:48:07'),
('BO-34708', 4, 8, 'Samirul Huda', 'samirulhuda@gmail.com', '2147483647', 1, 'Dk. Cokrah, Ds. Pododai, Kec. Karanganyar, Kab. Pekalongan', 35000, 'Dibayar', '2023-07-08 00:01:22'),
('BO-43076', 4, 10, 'Samirul Huda', 'samirulhuda@gmail.com', '2147483647', 3, 'Dk. Cokrah, Ds. Pododadi, Kec. Karanganyar, Kab. Pekalongan', 225000, 'Selesai', '2023-06-28 11:42:36'),
('BO-52186', 6, 9, 'Amar Priambodo', 'amarpriambodo@gmail.com', '2147483647', 5, 'Kec. Tirto', 50000, 'Belum Bayar', '2023-07-02 07:07:41'),
('BO-81469', 5, 8, 'M. Arif Abdillah', 'arifabdillah@gmail.com', '2147483647', 2, 'Ds. Kewayangan, Kec. Kedungwuni, Kab. Pekalongan, Jawa Tengah', 70000, 'Selesai', '2023-06-29 06:56:59');

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
(8, 'Spanduk 2x1', 'Spanduk', 10, 'Meter', 35000, 'Spanduk Super kualitas terbaik, Bahan Flexi Korea', '6493ee02c8f8a.jpg'),
(9, 'Stiker', 'Cetak POD A3', 12, 'Meter', 10000, 'Stiker lucu, Bebas Request Model', '6493ef42f126e.jpg'),
(10, 'Kaos Sablon DTF', 'Cetak DTF', 20, 'Meter', 75000, 'Kaos Distro bahan cotton combed 24s, Sablon DTF', '6493f35a4554e.jpg'),
(11, 'Browsur A3', 'Cetak POD A3', 15, 'Lembar', 8000, 'Cetak Browsur Kualitas terbaik', '64af2a5837c0d.jpg'),
(12, 'Kalender', 'Kalender', 9, 'Pcs', 25000, 'Cetak Kalender, Bebas Request Gambar/Foto latar belakang', '64af2b4f0a551.jpeg'),
(13, 'Papper Bag', 'Papper Bag', 20, 'Pcs', 12000, 'Papper Bag premium, Bisa cutom design sesuai keinganan', '64af2c32b391b.png'),
(14, 'Gantungan Kunci', 'Souvenir', 20, 'Pcs', 10000, 'Cetak Gantungan kunci, Bisa cutom design', '64af2cb54e24d.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `noHP` varchar(15) NOT NULL,
  `alamat` text NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `username`, `nama_lengkap`, `password`, `email`, `noHP`, `alamat`, `foto`) VALUES
(4, 'samhud', 'Samirul Huda', '$2y$10$0E0lowu5BuDr0VuGlMMrCOYi0fUga15eoXT5hikflx.XzKopy3z4O', 'samirulhuda@gmail.com', '85648597435', 'RT01/RW03, Dk. Cokrah, Ds. Pododadi, Kec. Karanganyar, Kab. Pekalongan, Jawa Tengah', '64a95d58cbc56.png'),
(5, 'abdi', 'Arif Abdillah', '$2y$10$1Mvz898Y6fJ28VMaM0HhOeG2nETKf9Y241w7750JDvDFApHw9JGu2', 'arifabdillah@gmail.com', '0', '', 'user.png'),
(6, 'amar priambodo', '', '$2y$10$/zcR4T3YEgDUQ0J3XIsOCOL/k72butmT0T63tG6lkPLnbDurDWOnO', 'amarpriambodo@gmail.com', '0', '', 'user.png'),
(7, 'ulinnuha', '', '$2y$10$ymDhbfA32MrlbmUL68A74OEV1vcVbEorWGRvNvOX63ag5mRfx4ICa', 'muhulinnuha@gmail.com', '', '', 'user.png');

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
  MODIFY `Kd_Barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
