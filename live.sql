-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Agu 2024 pada 07.01
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `live`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `absen`
--

CREATE TABLE `absen` (
  `id_absen` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL,
  `durasi` int(11) NOT NULL,
  `pay` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `absen`
--

INSERT INTO `absen` (`id_absen`, `nama`, `tanggal`, `status`, `durasi`, `pay`) VALUES
(1, 'farhan', '2024-08-01 11:55:16', 0, 0, 0),
(2, 'farhan', '2024-08-01 17:00:00', 1, 1, 1),
(3, 'farhan', '2024-08-02 17:00:00', 1, 1, 1),
(4, 'farhan', '2024-08-03 17:00:00', 1, 1, 1),
(5, 'farhan', '2024-08-04 17:00:00', 1, 1, 1),
(6, 'farhan', '2024-08-05 17:00:00', 1, 1, 1),
(7, 'farhan', '2024-08-06 17:00:00', 1, 1, 1),
(8, 'farhan', '2024-08-08 12:25:47', 1, 1, 0),
(9, 'farhan', '2024-08-09 12:25:47', 1, 1, 0),
(10, 'farhan', '2024-08-10 12:25:47', 1, 1, 0),
(11, 'ekal', '2024-07-31 17:00:00', 0, 0, 0),
(12, 'ekal', '2024-08-01 17:00:00', 1, 1, 1),
(13, 'ekal', '2024-08-02 17:00:00', 0, 0, 0),
(14, 'ekal', '2024-08-03 17:00:00', 1, 1, 1),
(15, 'ekal', '2024-08-04 17:00:00', 1, 1, 1),
(16, 'ekal', '2024-08-05 17:00:00', 1, 1, 1),
(17, 'ekal', '2024-08-06 17:00:00', 1, 1, 1),
(18, 'ekal', '2024-08-08 10:53:16', 1, 1, 1),
(19, 'ekal', '2024-08-09 10:53:16', 1, 1, 0),
(20, 'ekal', '2024-08-10 15:57:04', 1, 1, 0),
(21, 'komar', '2024-07-31 17:00:00', 0, 0, 0),
(22, 'komar', '2024-08-01 17:00:00', 0, 0, 0),
(23, 'komar', '2024-08-02 17:00:00', 1, 2, 2),
(24, 'komar', '2024-08-03 17:00:00', 1, 1, 1),
(25, 'komar', '2024-08-04 17:00:00', 1, 1, 1),
(26, 'komar', '2024-08-05 17:00:00', 1, 1, 1),
(27, 'komar', '2024-08-06 17:00:00', 1, 1, 1),
(28, 'komar', '2024-08-08 10:59:41', 1, 1, 0),
(29, 'komar', '2024-08-09 10:59:41', 1, 1, 0),
(30, 'komar', '2024-08-09 17:00:00', 0, 0, 0),
(31, 'upan', '2024-07-31 17:00:00', 0, 0, 0),
(32, 'upan', '2024-08-01 17:00:00', 1, 1, 1),
(33, 'upan', '2024-08-02 17:00:00', 0, 0, 0),
(34, 'upan', '2024-08-03 17:00:00', 1, 1, 1),
(35, 'upan', '2024-08-04 17:00:00', 1, 1, 1),
(36, 'upan', '2024-08-05 17:00:00', 1, 1, 1),
(37, 'upan', '2024-08-06 17:00:00', 1, 1, 1),
(38, 'upan', '2024-08-07 17:00:00', 1, 1, 1),
(39, 'upan', '2024-08-09 10:39:22', 1, 1, 0),
(40, 'upan', '2024-08-10 15:31:54', 1, 1, 0),
(41, 'ibrahim', '2024-07-31 17:00:00', 0, 0, 0),
(42, 'ibrahim', '2024-08-01 17:00:00', 1, 1, 1),
(43, 'ibrahim', '2024-08-02 17:00:00', 0, 0, 0),
(44, 'ibrahim', '2024-08-03 17:00:00', 1, 1, 1),
(45, 'ibrahim', '2024-08-04 17:00:00', 0, 0, 0),
(46, 'ibrahim', '2024-08-05 17:00:00', 1, 1, 1),
(47, 'ibrahim', '2024-08-06 17:00:00', 1, 1, 1),
(48, 'ibrahim', '2024-08-07 17:00:00', 1, 1, 1),
(49, 'ibrahim', '2024-08-08 17:00:00', 1, 1, 1),
(50, 'ibrahim', '2024-08-09 17:00:00', 1, 1, 0),
(51, 'ibrahim', '2024-08-10 17:00:00', 1, 2, 0),
(54, 'ekal', '2024-08-11 15:57:04', 1, 1, 0),
(55, 'komar', '2024-08-10 17:00:00', 0, 0, 0),
(56, 'upan', '2024-08-10 17:00:00', 0, 0, 0),
(57, 'farhan', '2024-08-11 11:55:16', 1, 1, 0),
(69, 'farhan', '2024-08-12 11:55:16', 1, 1, 0),
(70, 'ekal', '2024-08-12 13:00:04', 1, 2, 0),
(71, 'komar', '2024-08-12 14:01:36', 0, 0, 0),
(72, 'ibrahim', '2024-08-12 14:01:47', 0, 0, 0),
(73, 'upan', '2024-08-12 15:00:00', 1, 1, 0),
(75, 'upan', '2024-08-13 12:40:45', 1, 1, 0),
(76, 'komar', '2024-08-13 12:37:03', 0, 0, 0),
(77, 'ekal', '2024-08-13 13:40:36', 1, 1, 0),
(78, 'ibrahim', '2024-08-13 14:40:44', 1, 1, 0),
(79, 'farhan', '2024-08-13 15:40:57', 1, 1, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `bayaran`
--

CREATE TABLE `bayaran` (
  `id_bayaran` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `total` double NOT NULL,
  `sudah` double NOT NULL,
  `belum` double NOT NULL,
  `lebih` int(11) NOT NULL,
  `total_durasi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `host`
--

CREATE TABLE `host` (
  `id_host` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `nohp` varchar(20) NOT NULL,
  `bank` varchar(50) NOT NULL,
  `un` varchar(50) NOT NULL,
  `pw` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `host`
--

INSERT INTO `host` (`id_host`, `nama`, `nohp`, `bank`, `un`, `pw`) VALUES
(1, 'farhan', '08976580885', 'DANA', 'papargasi', '12202004'),
(2, 'ekal', '083113418188', 'DANA', 'ekal', '12345678'),
(3, 'komar', '083823235601', 'DANA', 'komar', '12345678'),
(4, 'upan', '082115770573', 'DANA', 'upan', '12345678'),
(5, 'ibrahim', '082124165438', 'DANA', 'ibrahim', '12345678');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `absen`
--
ALTER TABLE `absen`
  ADD PRIMARY KEY (`id_absen`);

--
-- Indeks untuk tabel `bayaran`
--
ALTER TABLE `bayaran`
  ADD PRIMARY KEY (`id_bayaran`);

--
-- Indeks untuk tabel `host`
--
ALTER TABLE `host`
  ADD PRIMARY KEY (`id_host`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `absen`
--
ALTER TABLE `absen`
  MODIFY `id_absen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT untuk tabel `bayaran`
--
ALTER TABLE `bayaran`
  MODIFY `id_bayaran` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `host`
--
ALTER TABLE `host`
  MODIFY `id_host` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
