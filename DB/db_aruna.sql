-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 22 Okt 2019 pada 10.53
-- Versi server: 10.1.37-MariaDB
-- Versi PHP: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_aruna`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_agt_koperasi`
--

CREATE TABLE `tb_agt_koperasi` (
  `idanggota` varchar(6) NOT NULL,
  `tglgabung` date NOT NULL,
  `noktp` varchar(20) NOT NULL,
  `nama_anggota` varchar(100) NOT NULL,
  `tempat_lahir` varchar(80) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat_ktp` text NOT NULL,
  `alamat_domisili` text NOT NULL,
  `no_tlp` varchar(20) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `scan_ktp` text NOT NULL,
  `scan_npwp` text NOT NULL,
  `ibu_kandung` varchar(100) NOT NULL,
  `saudara_tdk_serumah` varchar(100) NOT NULL,
  `alamat_saudara` text NOT NULL,
  `notlp_saudara` varchar(20) NOT NULL,
  `nohp_saudara` varchar(20) NOT NULL,
  `nm_waris` varchar(100) NOT NULL,
  `tlp_waris` varchar(20) NOT NULL,
  `alamat_waris` text NOT NULL,
  `email` varchar(200) NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_agt_ted`
--

CREATE TABLE `tb_agt_ted` (
  `idted` varchar(8) NOT NULL,
  `tgl_gabung` date NOT NULL,
  `nama_lengkap` varchar(150) NOT NULL,
  `nohp` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(256) NOT NULL,
  `level_user` enum('super','member') NOT NULL,
  `scan_ktp` text NOT NULL,
  `scan_npwp` text NOT NULL,
  `foto_profil` text NOT NULL,
  `aktif` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_agt_ted`
--

INSERT INTO `tb_agt_ted` (`idted`, `tgl_gabung`, `nama_lengkap`, `nohp`, `alamat`, `email`, `password`, `level_user`, `scan_ktp`, `scan_npwp`, `foto_profil`, `aktif`) VALUES
('01.00001', '2019-10-16', 'Juniar Arif Wicaksono', '083927', '', 'arifsavutage@gmail.com', '$2y$10$ijGtW/Eed.9uKT8j/.fNZOkzo.6VE/BLPovpa.qfMibziUYai3uyG', 'super', 'noimage.jpg', 'noimage.jpg', 'noimage.jpg', 1),
('01.00002', '2019-10-17', 'Perusahaan', '081390123456', '', 'arifokbgt@gmail.com', '$2y$10$6K4ENM.YUW7SWeY6UYU6Fem4a6syCEUFanfZ.8.o98qUFDePPGmU6', 'member', 'noimage.jpg', 'noimage.jpg', 'noimage.jpg', 1),
('01.00003', '2019-10-17', 'Yuridisat Ilham', '08576871216', '', 'yuridistailham@gmail.com', '$2y$10$S8OD07hpTgGcMtOkSZUS0eXKx0WcOHIGuR6sfL6s91FJfaIELIIq.', 'member', 'noimage.jpg', 'noimage.jpg', 'noimage.jpg', 0),
('01.00004', '2019-10-17', 'Yuridisat Ilham', '08576871216', '', 'yuridista@gmail.com', '$2y$10$89omTfD5Etayft.KdUcz2eDNSA2RJrajmhyz7mOwTIPhI5nZuzBWi', 'member', 'noimage.jpg', 'noimage.jpg', 'noimage.jpg', 0),
('01.00005', '2019-10-18', 'Subagyo Suprapto', '081342526116', 'Jl. Candi Penataran XII Rt. 006 Rw. 004, Kel. Kalipancur, Kec. Ngaliyan, Semarang', 'subagyo.studio97@gmail.com', '$2y$10$yOnqrBpMQhlAIPaE9x./muRH/OdFPfxYzBHuBP95.uWR6wxenEy2C', 'member', 'noimage.jpg', 'noimage.jpg', 'noimage.jpg', 1),
('01.00006', '2019-10-18', 'Coba', '08923637', '', 'coba@gmail.com', '$2y$10$rQb/8.zVotkpd2MaZUpVOu5tSJv9n/ZXpMRGhAgKb2Myb7ZgxBAda', 'member', 'noimage.jpg', 'noimage.jpg', 'noimage.jpg', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_cabang`
--

CREATE TABLE `tb_cabang` (
  `idcabang` varchar(2) NOT NULL,
  `nama_cabang` varchar(80) NOT NULL,
  `alamat_cabang` text NOT NULL,
  `kotakab` varchar(50) NOT NULL,
  `idpemilik` varchar(8) NOT NULL,
  `status` enum('enable','disable') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_jaringan`
--

CREATE TABLE `tb_jaringan` (
  `idagt` varchar(8) NOT NULL,
  `idreferal` varchar(8) NOT NULL,
  `idupline` varchar(8) NOT NULL,
  `jml_downline` int(9) NOT NULL,
  `pos_jar` text NOT NULL,
  `pos_level` int(9) NOT NULL,
  `tgl_proses` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_jaringan`
--

INSERT INTO `tb_jaringan` (`idagt`, `idreferal`, `idupline`, `jml_downline`, `pos_jar`, `pos_level`, `tgl_proses`) VALUES
('01.00001', '0', '0', 5, '1', 1, '0000-00-00'),
('01.00002', '01.00001', '01.00001', 0, '11', 2, '0000-00-00'),
('01.00003', '01.00001', '01.00001', 0, '12', 2, '0000-00-00'),
('01.00004', '01.00001', '01.00001', 0, '13', 2, '0000-00-00'),
('01.00005', '01.00001', '01.00001', 0, '14', 2, '0000-00-00'),
('01.00006', '01.00001', '01.00001', 0, '15', 2, '0000-00-00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_verifikasi_email`
--

CREATE TABLE `tb_verifikasi_email` (
  `idx` bigint(11) NOT NULL,
  `token` text NOT NULL,
  `idagt` varchar(8) NOT NULL,
  `status` enum('not verified','verified') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_verifikasi_email`
--

INSERT INTO `tb_verifikasi_email` (`idx`, `token`, `idagt`, `status`) VALUES
(1, 'VPtuygrBcA68I1xR01.00004', '01.00004', 'not verified'),
(2, 'sDLZTjwgN1HXWx0M0100005', '01.00005', 'verified'),
(3, '3S8cbMWusrPL42vA0100006', '01.00006', 'not verified');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_update_ubs`
--

CREATE TABLE `t_update_ubs` (
  `IDX` bigint(20) NOT NULL,
  `UPDATE_AT` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `HRG_BELI` text NOT NULL,
  `HRG_JUAL` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_update_ubs`
--

INSERT INTO `t_update_ubs` (`IDX`, `UPDATE_AT`, `HRG_BELI`, `HRG_JUAL`) VALUES
(6, '2019-07-26 00:30:02', '706,805', '630,500'),
(7, '2019-07-26 20:50:03', '707,309', '631,000'),
(8, '2019-07-28 20:50:01', '708,318', '632,000'),
(9, '2019-07-29 20:55:02', '709,327', '633,000'),
(10, '2019-07-30 21:00:03', '710,841', '634,500'),
(11, '2019-07-31 18:40:04', '710,841', '626,500'),
(12, '2019-07-31 18:45:03', '710,841', '626,000'),
(13, '2019-07-31 21:00:02', '707,814', '631,500'),
(14, '2019-08-01 20:40:01', '720,022', '643,500'),
(15, '2019-08-02 22:20:02', '721,940', '645,500'),
(16, '2019-08-04 20:40:01', '730,112', '653,600'),
(17, '2019-08-04 20:45:03', '730,112', '653,500'),
(18, '2019-08-05 20:30:02', '740,404', '663,500'),
(19, '2019-08-06 20:40:03', '747,871', '671,000'),
(20, '2019-08-06 20:45:02', '747,669', '665,000'),
(21, '2019-08-06 23:05:02', '748,174', '665,000'),
(22, '2019-08-07 20:35:03', '751,705', '665,000'),
(23, '2019-08-08 21:05:02', '753,723', '665,000'),
(24, '2019-08-09 18:25:02', '753,723', '635,000'),
(25, '2019-08-09 20:40:03', '750,192', '635,000'),
(26, '2019-08-09 22:00:03', '750,192', '660,000'),
(27, '2019-08-09 22:05:01', '750,192', '665,000'),
(28, '2019-08-11 20:40:03', '750,696', '674,000'),
(29, '2019-08-12 20:55:01', '762,300', '675,000'),
(30, '2019-08-12 21:05:05', '762,300', '680,000'),
(31, '2019-08-13 20:55:03', '757,759', '674,000'),
(32, '2019-08-14 20:40:01', '764,822', '682,000'),
(33, '2019-08-15 20:40:02', '763,309', '680,500'),
(34, '2019-08-18 20:20:02', '763,309', '675,000'),
(35, '2019-08-18 21:30:02', '759,273', '675,000'),
(36, '2019-08-19 21:50:02', '755,741', '673,000'),
(37, '2019-08-20 20:50:03', '757,255', '679,000'),
(38, '2019-08-22 01:00:06', '756,750', '678,500'),
(39, '2019-08-22 21:00:06', '754,732', '676,500'),
(40, '2019-08-23 21:00:04', '764,318', '687,500'),
(41, '2019-08-25 21:05:04', '772,490', '695,000'),
(42, '2019-08-26 21:00:07', '766,840', '690,000'),
(43, '2019-08-27 21:00:06', '770,876', '694,000'),
(44, '2019-08-28 21:00:06', '773,399', '696,000'),
(45, '2019-08-28 21:05:05', '773,499', '696,000'),
(46, '2019-08-28 21:10:05', '773,399', '696,000'),
(47, '2019-08-29 21:00:07', '767,345', '690,500'),
(48, '2019-08-30 21:00:05', '764,318', '687,500'),
(49, '2019-09-01 21:00:07', '765,831', '689,000'),
(50, '2019-09-02 21:00:07', '766,336', '689,500'),
(51, '2019-09-03 21:00:06', '773,499', '696,500'),
(52, '2019-09-04 21:10:04', '770,977', '694,000'),
(53, '2019-09-05 21:40:05', '761,291', '684,500'),
(54, '2019-09-06 21:00:06', '757,759', '681,000');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_agt_koperasi`
--
ALTER TABLE `tb_agt_koperasi`
  ADD PRIMARY KEY (`idanggota`);

--
-- Indeks untuk tabel `tb_agt_ted`
--
ALTER TABLE `tb_agt_ted`
  ADD PRIMARY KEY (`idted`);

--
-- Indeks untuk tabel `tb_cabang`
--
ALTER TABLE `tb_cabang`
  ADD PRIMARY KEY (`idcabang`);

--
-- Indeks untuk tabel `tb_verifikasi_email`
--
ALTER TABLE `tb_verifikasi_email`
  ADD PRIMARY KEY (`idx`);

--
-- Indeks untuk tabel `t_update_ubs`
--
ALTER TABLE `t_update_ubs`
  ADD PRIMARY KEY (`IDX`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_verifikasi_email`
--
ALTER TABLE `tb_verifikasi_email`
  MODIFY `idx` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `t_update_ubs`
--
ALTER TABLE `t_update_ubs`
  MODIFY `IDX` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
