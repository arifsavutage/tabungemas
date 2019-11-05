-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Nov 2019 pada 08.49
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
  `norek` varchar(50) NOT NULL,
  `bank` varchar(50) NOT NULL,
  `foto_profil` text NOT NULL,
  `jenis` enum('basic','agen') NOT NULL,
  `aktif` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_agt_ted`
--

INSERT INTO `tb_agt_ted` (`idted`, `tgl_gabung`, `nama_lengkap`, `nohp`, `alamat`, `email`, `password`, `level_user`, `scan_ktp`, `scan_npwp`, `norek`, `bank`, `foto_profil`, `jenis`, `aktif`) VALUES
('01.00001', '2019-10-28', 'Top Perusahaan', '08123635427', 'Reykjavik, Greendland', 'info@tabungemas.com', '$2y$10$yOnqrBpMQhlAIPaE9x./muRH/OdFPfxYzBHuBP95.uWR6wxenEy2C', 'super', 'noimage.jpg', 'noimage.jpg', '12312388857', 'Vereenigde Oostindische Compagnie Bank', '01_00001.jpg', 'agen', 1),
('01.00002', '2019-10-29', 'No Name', '081390559997', '', 'arifokbgt@gmail.com', '$2y$10$f0wJQw32a3p5QKjOXLdJ1Ovpu9GshSuGazVI2c2HsWXTs.1QSMhai', 'member', 'noimage.jpg', 'noimage.jpg', '', '', 'noimage.jpg', 'agen', 1),
('01.00003', '2019-10-29', 'Dian Ayu', '081325123456', '', 'dianayoe.wicaksono@gmail.com', '$2y$10$2bbrD1PMvHykvc2e14poXOn5Tterp9oCxQVS24YGAggLjNJNWjJde', 'member', 'noimage.jpg', 'noimage.jpg', '', '', 'noimage.jpg', 'agen', 1),
('01.00004', '2019-10-29', 'Rufaidah Layla Cetta', '081325123456', '', 'rufaidahbinwicaksono@gmail.com', '$2y$10$2bbrD1PMvHykvc2e14poXOn5Tterp9oCxQVS24YGAggLjNJNWjJde', 'member', 'noimage.jpg', 'noimage.jpg', '', '', 'noimage.jpg', 'agen', 1),
('01.00005', '2019-10-29', 'Yahya', '081325123456', '', 'yahya@gmail.com', '$2y$10$2bbrD1PMvHykvc2e14poXOn5Tterp9oCxQVS24YGAggLjNJNWjJde', 'member', 'noimage.jpg', 'noimage.jpg', '', '', 'noimage.jpg', 'agen', 1),
('01.00006', '2019-10-29', 'Wahyu', '081325123456', '', 'wahyu@gmail.com', '$2y$10$2bbrD1PMvHykvc2e14poXOn5Tterp9oCxQVS24YGAggLjNJNWjJde', 'member', 'noimage.jpg', 'noimage.jpg', '', '', 'noimage.jpg', 'agen', 1),
('01.00007', '2019-10-29', 'Bagus', '081325123456', '', 'bagus@gmail.com', '$2y$10$2bbrD1PMvHykvc2e14poXOn5Tterp9oCxQVS24YGAggLjNJNWjJde', 'member', 'noimage.jpg', 'noimage.jpg', '', '', 'noimage.jpg', 'agen', 1),
('01.00008', '2019-10-29', 'Kumala', '081325123456', '', 'kumala@gmail.com', '$2y$10$2bbrD1PMvHykvc2e14poXOn5Tterp9oCxQVS24YGAggLjNJNWjJde', 'member', 'noimage.jpg', 'noimage.jpg', '', '', 'noimage.jpg', 'agen', 1),
('01.00009', '2019-10-29', 'Bayu Sudarsono', '085640321654', '', 'bayoe@yahoo.com', '$2y$10$1EXgb46vH2UeGidUP/bCgOgywI5ZGYdfCQJzSZ5ilYow0NLfKfxdy', 'member', 'noimage.jpg', 'noimage.jpg', '', '', 'noimage.jpg', 'agen', 1),
('01.00010', '2019-10-29', 'Babah', '0896781234', 'Jl. Srikandi lama no.08 Semarang barat', 'babah@gmail.com', '$2y$10$HeJvQifcpMU0zAPd4l9oN.YhtcJKWXO43kUPTpJazUmPTOiW9wM5u', 'member', 'ktp_01_00010.jpg', 'npwp_01_00010.jpg', '3360 123 42126 345', 'Bank Syariah Islami', '01_00010.jpg', 'agen', 1),
('01.00011', '2019-10-31', 'Ariandaru Kusuma Yudha', '08112888470', '', 'kog434@gmail.com', '$2y$10$ehqxPp5GCLRyjs.WMDKO1Owzp.lGGeVXkv9M1yHL15m4gpnW6Ag1m', 'member', 'noimage.jpg', 'noimage.jpg', '', '', 'noimage.jpg', 'basic', 1),
('01.00012', '2019-10-31', 'Susiloningsih', '082136368828', '', 'kopikukopika@gmail.com', '$2y$10$GaW96.N4lFMbtOx0ICV.qOznk1V1p.edVURCE381JyPgcemktl1L6', 'member', 'noimage.jpg', 'noimage.jpg', '', '', 'noimage.jpg', 'basic', 1),
('01.00013', '2019-11-05', 'Sofyan Jalil', '0812524426', '', 'sofyan.jalil@gmail.com', '$2y$10$ltUfTQFdscR8NNm5AoO/Be9wsDxixYT88gGMXMG34NXwJF1rWQDxG', 'member', 'noimage.jpg', 'noimage.jpg', '', '', 'noimage.jpg', 'basic', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_agt_tmp`
--

CREATE TABLE `tb_agt_tmp` (
  `idtmp` int(5) NOT NULL,
  `tgl_daftar` date NOT NULL,
  `nm_tmp` varchar(150) NOT NULL,
  `nohp_tmp` varchar(20) NOT NULL,
  `email_tmp` varchar(100) NOT NULL,
  `ktp_tmp` text NOT NULL,
  `password_tmp` varchar(256) NOT NULL,
  `idreferal` varchar(8) NOT NULL,
  `nominal` int(9) NOT NULL,
  `konfirm_status` int(2) NOT NULL,
  `token` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
('01.00001', '0', '0', 3, '1', 1, '2019-10-28'),
('01.00002', '01.00001', '01.00001', 3, '11', 2, '0000-00-00'),
('01.00003', '01.00001', '01.00001', 1, '12', 2, '0000-00-00'),
('01.00004', '01.00003', '01.00003', 2, '121', 3, '0000-00-00'),
('01.00005', '01.00002', '01.00002', 0, '111', 3, '0000-00-00'),
('01.00006', '01.00002', '01.00002', 0, '112', 3, '0000-00-00'),
('01.00007', '01.00002', '01.00002', 0, '113', 3, '0000-00-00'),
('01.00008', '01.00004', '01.00004', 0, '1211', 4, '0000-00-00'),
('01.00009', '01.00001', '01.00001', 0, '13', 2, '0000-00-00'),
('01.00010', '01.00004', '01.00004', 3, '1212', 4, '0000-00-00'),
('01.00011', '01.00010', '01.00010', 0, '12121', 5, '0000-00-00'),
('01.00012', '01.00010', '01.00010', 0, '12122', 5, '0000-00-00'),
('01.00013', '01.00010', '01.00010', 0, '12123', 5, '0000-00-00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `id` bigint(20) NOT NULL,
  `tgl` date NOT NULL,
  `idted` varchar(8) NOT NULL,
  `uraian` text NOT NULL,
  `masuk` int(10) NOT NULL,
  `keluar` int(10) NOT NULL,
  `saldo` int(10) NOT NULL,
  `jenis` enum('uang','emas') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`id`, `tgl`, `idted`, `uraian`, `masuk`, `keluar`, `saldo`, `jenis`) VALUES
(1, '2019-11-05', '01.00001', 'topup deposit', 5000000, 0, 5000000, 'uang');

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
-- Indeks untuk tabel `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `idtmp` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_bonus`
--
ALTER TABLE `tb_bonus`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
