-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 29 Okt 2019 pada 10.14
-- Versi server: 10.3.18-MariaDB
-- Versi PHP: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tabungem_aplikasi`
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
('01.00001', '2019-10-28', 'Top Perusahaan', '0', 'Semarang', 'info@tabungemas.com', '$2y$10$yOnqrBpMQhlAIPaE9x./muRH/OdFPfxYzBHuBP95.uWR6wxenEy2C', 'super', 'noimage.jpg', 'noimage.jpg', 'noimage.jpg', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_agt_tmp`
--

CREATE TABLE `tb_agt_tmp` (
  `idtmp` int(5) NOT NULL,
  `tgl_daftar` date NOT NULL,
  `nama_lengkap` varchar(150) NOT NULL,
  `nohp` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(256) NOT NULL,
  `idreferal` varchar(8) NOT NULL,
  `nominal` int(9) NOT NULL,
  `konfirm_status` int(2) NOT NULL,
  `token` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_agt_tmp`
--

INSERT INTO `tb_agt_tmp` (`idtmp`, `tgl_daftar`, `nama_lengkap`, `nohp`, `email`, `password`, `idreferal`, `nominal`, `konfirm_status`, `token`) VALUES
(2, '2019-10-28', 'Juniar Arif Wicaksono', '081390559997', 'arifokbgt@gmail.com', '$2y$10$JAFJ7LDv4aKOyWrGEFBm.uUtdVNokZHLvjW3mldBsJsX2DBcSQws.', '01.00001', 970232, 1, 'AIUfvk62nW78BxK4');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_bonus`
--

CREATE TABLE `tb_bonus` (
  `id` int(3) NOT NULL,
  `registrasi` int(9) NOT NULL,
  `referal` int(9) NOT NULL,
  `royalti` int(9) NOT NULL,
  `royalti_target` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_bonus`
--

INSERT INTO `tb_bonus` (`id`, `registrasi`, `referal`, `royalti`, `royalti_target`) VALUES
(1, 970000, 15000, 10000, 10),
(2, 0, 5000, 9000, 15),
(3, 0, 4000, 6000, 20),
(4, 0, 1500, 5000, 30),
(5, 0, 1500, 4000, 25),
(6, 0, 1000, 0, 0);

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

--
-- Dumping data untuk tabel `tb_cabang`
--

INSERT INTO `tb_cabang` (`idcabang`, `nama_cabang`, `alamat_cabang`, `kotakab`, `idpemilik`, `status`) VALUES
('01', 'PUSAT', '-', 'SEMARANG', '01.00001', 'enable');

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
('01.00001', '0', '0', 0, '1', 1, '2019-10-28');

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

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_update_ubs`
--

CREATE TABLE `t_update_ubs` (
  `IDX` bigint(20) NOT NULL,
  `UPDATE_AT` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
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
-- Indeks untuk tabel `tb_agt_tmp`
--
ALTER TABLE `tb_agt_tmp`
  ADD PRIMARY KEY (`idtmp`);

--
-- Indeks untuk tabel `tb_bonus`
--
ALTER TABLE `tb_bonus`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT untuk tabel `tb_agt_tmp`
--
ALTER TABLE `tb_agt_tmp`
  MODIFY `idtmp` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_bonus`
--
ALTER TABLE `tb_bonus`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tb_verifikasi_email`
--
ALTER TABLE `tb_verifikasi_email`
  MODIFY `idx` bigint(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `t_update_ubs`
--
ALTER TABLE `t_update_ubs`
  MODIFY `IDX` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
