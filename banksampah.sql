-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 24 Feb 2021 pada 04.07
-- Versi server: 10.4.14-MariaDB
-- Versi PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `banksampah`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bank_sampah`
--

CREATE TABLE `bank_sampah` (
  `id` int(11) NOT NULL,
  `nama_bank` varchar(128) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `kontak_nama` varchar(128) NOT NULL,
  `telp` bigint(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `bank_sampah`
--

INSERT INTO `bank_sampah` (`id`, `nama_bank`, `alamat`, `kontak_nama`, `telp`) VALUES
(1, 'Bank Sampah Jaya Lestari', 'Jl. Pegutangan, Denpasar Utara, Bali', 'Ardita', 81738230799),
(2, 'Bank Sampah 2077', 'Jl. Cyber No.3X3', 'Siwananda', 87855131089),
(3, 'Bank Sampah Abukasa', 'Jalan Bedahulu XXI Gang Munduk', 'Ruben', 82374672836),
(4, 'KSU Koperasi Bank Sampah Sedhana Arsa', 'Jalan Tukad Balian No 133A', 'Tama', 8726374673),
(5, 'Bank Sampah TPST-3R', 'Gang Melasti, Kesiman Kertalangu, Denpasar Timur', 'Dhiwa', 87263746371);

-- --------------------------------------------------------

--
-- Struktur dari tabel `penarikan`
--

CREATE TABLE `penarikan` (
  `id` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `penarikan`
--

INSERT INTO `penarikan` (`id`, `date`, `user_id`, `total`) VALUES
(1, 1613036174, 5, 10000),
(2, 1613036398, 5, 10000),
(3, 1613037549, 17, 10000),
(4, 1613045356, 5, 50000),
(5, 1613052155, 5, 10000),
(6, 1613052200, 5, 20000),
(7, 1613216657, 5, 10000),
(8, 1613216978, 5, 10000),
(9, 1613991938, 5, 10000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `setoran`
--

CREATE TABLE `setoran` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tanggal` int(11) NOT NULL,
  `nama_sampah` varchar(255) NOT NULL,
  `kode_sampah` varchar(11) NOT NULL,
  `jumlah_satuan` bigint(20) NOT NULL,
  `satuan` varchar(10) NOT NULL,
  `setoran_jumlah` bigint(20) NOT NULL,
  `jual_jumlah` int(11) NOT NULL,
  `is_sold` int(1) NOT NULL,
  `biaya_admin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `setoran`
--

INSERT INTO `setoran` (`id`, `user_id`, `tanggal`, `nama_sampah`, `kode_sampah`, `jumlah_satuan`, `satuan`, `setoran_jumlah`, `jual_jumlah`, `is_sold`, `biaya_admin`) VALUES
(1, 5, 1613819403, 'Sampah', 'pls', 2, 'kg', 400, 1000, 0, 10),
(2, 5, 1613819448, 'Sampah', 'pls', 2, 'kg', 200, 1000, 0, 10),
(3, 5, 1613819584, 'Sampah', 'pls', 2, 'kg', 200, 1000, 0, 10),
(4, 5, 1613991311, 'Aqua', 'gab', 10, 'kg', 12500, 25000, 0, 10),
(5, 5, 1614080008, 'Minyak Jelantah', 'mjl', 3, 'liter', 3750, 7500, 0, 10),
(6, 5, 1614080305, 'Minyak Jelantah', 'mjl', 3, 'liter', 3750, 7500, 0, 10),
(7, 29, 1614080506, 'Sampah', 'pls', 1000, 'kg', 100000, 500000, 0, 10),
(8, 29, 1614085301, 'Aqua', 'gab', 1000, 'kg', 1250000, 2500000, 0, 0),
(9, 29, 1614085474, 'Aqua', 'gab', 1000, 'kg', 1250000, 2500000, 0, 0),
(10, 29, 1614085691, 'Aqua', 'gab', 1000, 'kg', 1250000, 2500000, 0, 50);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `address` varchar(255) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(255) NOT NULL,
  `telp` varchar(20) NOT NULL,
  `role_id` int(11) NOT NULL,
  `bank_id` int(11) NOT NULL,
  `saldo` bigint(20) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `address`, `image`, `password`, `telp`, `role_id`, `bank_id`, `saldo`, `is_active`, `date_created`) VALUES
(5, 'Siwananda', 'admin@admin.com', 'Jl. Kertha Dalem sari II', 'tahta.jpg', '$2y$10$Erz4hGZnCH5ErgXM2kAmXODf38OSqLoRWaMNScsg6cwsJlXUe4Tdm', '08785513333', 1, 1, 100, 1, 1611050779),
(14, 'siwananda19', 'clouza@gmail.com', 'Jl. Tabanan bagian barat', 'tahta.jpg', '$2y$10$PCOrMBQS0VZpOan/wDyu2uYU7ehIbt2T74Pp9DcV/dSK8.ahw2AJK', '', 12, 3, 0, 1, 1612425760),
(17, 'Ardita', 'ardi@ardi.com', 'Jl. Kuta', 'default.svg', '$2y$10$c2toJpM1UAntI15NaFQTj.fyeWVyNLECHMA2redZfjCKF1c1SsaRW', '', 2, 2, 190, 1, 1612754642),
(18, 'Direktur', 'direktur@direktur.com', 'Jl. Denpasar', 'default.svg', '$2y$10$V2jzIZl4u8m1gHvjT1rQceErJlfLcyQ1qUDr3JsSyuCUSviPN05d.', '08785511111', 14, 3, 99999, 1, 1612760003),
(22, 'Ruben', 'ruben@gmail.com', '', 'default.svg', '$2y$10$ZE3F/sjnyupfG5dYGpM/2OBEAwhoN9CPks1M2bVmxjWLM9z7LgrhG', '', 2, 1, 0, 1, 1613991421),
(23, 'Tama', 'tama@gmail.com', '', 'default.svg', '$2y$10$ccg7bcO/DNr8ohT9WWgDkOfxHRiWpORZD/kvIhOqCc9h.AOqZ4aWG', '', 12, 1, 0, 1, 1613991453),
(24, 'Dhiwa', 'dhiwa@gmail.com', '', 'default.svg', '$2y$10$jW6obYw8r4CwXo32kHm4Iue0LiyocuQsclVpnv8kuJk8Qtq7DWss2', '', 12, 1, 0, 1, 1613991468);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(6, 2, 2),
(7, 2, 3),
(9, 2, 5),
(15, 1, 5),
(16, 1, 4),
(21, 1, 3),
(28, 9, 2),
(29, 9, 3),
(30, 12, 2),
(31, 12, 3),
(32, 13, 1),
(33, 13, 2),
(34, 14, 1),
(35, 14, 4),
(37, 14, 2),
(40, 1, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'admin'),
(2, 'user'),
(3, 'daftar'),
(4, 'master'),
(5, 'transaksi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'admin'),
(2, 'member'),
(12, 'petugas'),
(14, 'direktur');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Dashboard', 'admin', 'fas fa-fw fa-tachometer-alt', 1),
(2, 2, 'My Profile', 'user', 'fas fa-fw fa-user', 1),
(3, 3, 'Daftar Harga', 'daftar', 'fas fa-fw fa-tags', 1),
(4, 3, 'Bank Sampah', 'daftar/bankSampah', 'fas fa-fw fa-university', 1),
(5, 4, 'Nasabah', 'master/nasabah', 'fas fa-fw fa-users', 1),
(6, 4, 'Petugas', 'master/petugas', 'fas fa-fw fa-people-carry', 1),
(7, 5, 'Setoran', 'transaksi/setoran', 'fas fa-fw fa-donate', 1),
(8, 5, 'Penjualan', 'transaksi/penjualan', 'fas fa-fw fa-dollar-sign', 1),
(9, 5, 'Tabungan', 'transaksi/tabungan', 'fas fa-fw fa-piggy-bank', 1),
(10, 5, 'Penarikan', 'transaksi/penarikan', 'fas fa-fw fa-paper-plane', 1),
(11, 1, 'Submenu Management', 'admin/submenu', 'fas fa-fw fa-folder-open', 1),
(31, 1, 'Role', 'admin/role', 'fas fa-fw fa-users-cog', 1),
(37, 2, 'Edit Profile', 'user/edit', 'fas fa-fw fa-user-edit', 1),
(39, 2, 'Change Password', 'user/cpassword', 'fas fa-fw fa-key', 1),
(40, 1, 'Users', 'admin/users', 'fas fa-fw fa-users', 1),
(46, 1, 'Penjualan Management', 'admin/penjualan', 'fas fa-fw fa-search-dollar', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_token`
--

CREATE TABLE `user_token` (
  `id` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `token` varchar(128) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_token`
--

INSERT INTO `user_token` (`id`, `email`, `token`, `date_created`) VALUES
(12, 'siwarjsa@gmail.com', 'lcEqYcdOWyT1JOX/iPAB1r+N5Qk/nERTzQ5eE70T2LQ=', 1614134962);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `bank_sampah`
--
ALTER TABLE `bank_sampah`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `penarikan`
--
ALTER TABLE `penarikan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `setoran`
--
ALTER TABLE `setoran`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `bank_sampah`
--
ALTER TABLE `bank_sampah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `penarikan`
--
ALTER TABLE `penarikan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `setoran`
--
ALTER TABLE `setoran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT untuk tabel `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
