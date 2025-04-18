-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Apr 2025 pada 10.16
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pakar`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `riwayat_diagnosa`
--

CREATE TABLE `riwayat_diagnosa` (
  `id` int(11) NOT NULL,
  `nama_user` varchar(100) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `gejala_terpilih` text DEFAULT NULL,
  `hasil_diagnosa` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `riwayat_diagnosa`
--

INSERT INTO `riwayat_diagnosa` (`id`, `nama_user`, `tanggal`, `gejala_terpilih`, `hasil_diagnosa`) VALUES
(1, 'Michael ', '2025-04-10 12:22:58', 'G01,G02,G03', 'P01'),
(2, 'Michael ', '2025-04-10 12:28:45', 'G01,G02,G03,G04', 'P01'),
(3, 'Tuani', '2025-04-10 13:04:17', 'G01,G02,G03,G04', 'P01'),
(4, 'kelll', '2025-04-10 16:32:05', 'G01,G02,G03', 'P01'),
(5, 'kelll', '2025-04-10 16:32:36', 'G01,G03,G06,G07', 'P01'),
(6, 'Michael ', '2025-04-11 06:20:21', 'G01,G02,G03', 'P01'),
(7, 'Michael ', '2025-04-13 08:34:22', 'G01,G02,G03', 'P01'),
(8, 'Michael ', '2025-04-13 08:34:40', 'G01,G02,G03,G04,G05,G06,G07,G08', 'P01'),
(9, 'Michael ', '2025-04-13 08:34:52', 'G01,G02,G03', 'P01'),
(10, 'Michael ', '2025-04-14 09:59:53', 'G01,G02,G03', 'P01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id_admin` int(11) NOT NULL,
  `nm_admin` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `no_telp` varchar(15) DEFAULT NULL,
  `jk` enum('L','P') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tb_admin`
--

INSERT INTO `tb_admin` (`id_admin`, `nm_admin`, `username`, `password`, `no_telp`, `jk`) VALUES
(2, 'Michael', 'admin', 'admin', '082361120104', 'L'),
(8, 'Michael', 'kell', '1234', '09240407401', 'L');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_gejala`
--

CREATE TABLE `tb_gejala` (
  `id_gejala` char(3) NOT NULL,
  `kdgejala` varchar(3) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `gejala` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tb_gejala`
--

INSERT INTO `tb_gejala` (`id_gejala`, `kdgejala`, `gejala`) VALUES
('G01', NULL, 'rusak daun'),
('G02', NULL, 'Daun bintik bintik'),
('G03', NULL, 'h'),
('G04', NULL, 'b'),
('G05', NULL, 'd'),
('G06', NULL, 'e'),
('G07', NULL, 't'),
('G08', NULL, 'w');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_penyakit`
--

CREATE TABLE `tb_penyakit` (
  `id_penyakit` char(3) NOT NULL,
  `kdpenyakit` varchar(10) DEFAULT NULL,
  `nama_penyakit` varchar(100) DEFAULT NULL,
  `definisi` text DEFAULT NULL,
  `pengobatan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tb_penyakit`
--

INSERT INTO `tb_penyakit` (`id_penyakit`, `kdpenyakit`, `nama_penyakit`, `definisi`, `pengobatan`) VALUES
('P01', NULL, 'bals', 'giyoudiyftuubviygiyigyi', 'uugutyrigdyrdguf'),
('P02', NULL, 'kie', 'llllll', 'ddddddd');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_rekap`
--

CREATE TABLE `tb_rekap` (
  `id_rekap` int(11) NOT NULL,
  `id_gejala` char(3) NOT NULL,
  `id_penyakit` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_rekap`
--

INSERT INTO `tb_rekap` (`id_rekap`, `id_gejala`, `id_penyakit`) VALUES
(1, 'G01', 'P01'),
(2, 'G02', 'P01'),
(3, 'G03', 'P01'),
(4, 'G01', 'P02'),
(5, 'G02', 'P02'),
(6, 'G03', 'P02');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `riwayat_diagnosa`
--
ALTER TABLE `riwayat_diagnosa`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id_admin`) USING BTREE,
  ADD UNIQUE KEY `id_admin_2` (`id_admin`,`nm_admin`,`username`,`password`,`no_telp`,`jk`) USING BTREE,
  ADD KEY `id_admin` (`id_admin`,`nm_admin`,`username`,`password`,`no_telp`,`jk`) USING BTREE;

--
-- Indeks untuk tabel `tb_gejala`
--
ALTER TABLE `tb_gejala`
  ADD PRIMARY KEY (`id_gejala`);

--
-- Indeks untuk tabel `tb_penyakit`
--
ALTER TABLE `tb_penyakit`
  ADD PRIMARY KEY (`id_penyakit`);

--
-- Indeks untuk tabel `tb_rekap`
--
ALTER TABLE `tb_rekap`
  ADD PRIMARY KEY (`id_rekap`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `riwayat_diagnosa`
--
ALTER TABLE `riwayat_diagnosa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tb_rekap`
--
ALTER TABLE `tb_rekap`
  MODIFY `id_rekap` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
