-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Nov 2019 pada 04.53
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
('01.00001', '2019-10-28', 'Susiloningsih 1', '08123635427', 'Reykjavik, Greendland', 'info@tabungemas.com', '$2y$10$nXCTezbOMOectb0p1XnIL.m4GYZKwBHV14R8w4bED1KjSZuXvdbTS', 'super', 'noimage.jpg', 'noimage.jpg', '12312388857', 'Vereenigde Oostindische Compagnie Bank', '01_00001.jpg', 'agen', 1),
('01.00002', '2019-11-05', 'Purnomo', '0812524426', '', 'ciptoted@tabungemas.com', '$2y$10$yzo7dB0SjcbSHlEUBk7bBeRTE/KFed1q2ksW.UtQeD0X9xtO1SeVu', 'member', 'noimage.jpg', 'noimage.jpg', '', '', 'noimage.jpg', 'agen', 1),
('01.00003', '2019-11-05', 'Susiloningsih', '082136368828', 'puri asri perdana ', 'kopikukopika@gmail.com', '$2y$10$8X11LAn2LJJVQ7IIu7DBneqWWONAQEezkewujZATyzRidRAGsY91e', 'member', 'noimage.jpg', 'noimage.jpg', '303601041826532', 'BRI', '01_00003.jpg', 'agen', 1),
('01.00004', '2019-11-05', 'Cipto Purnomo', '081225230626', 'Jl truntum VI no 11 Tlogosari kulon pedurungan semarang', 'ciptopurnomo@tabungemas.com', '$2y$10$1cE9HF4MQZrdRu6hAzEs5uEcGfoFSgyMW57bURv0gIMORlYstGMpe', 'member', 'noimage.jpg', 'noimage.jpg', '0094680561', 'BCA', 'noimage.jpg', 'agen', 1),
('01.00005', '2019-11-05', 'Ariandaru Kusuma Yudha', '08112888470', '', 'kog434@gmail.com', '$2y$10$SSDq5wmc9kEdz3Jf1s7gl.VxKyYKuNa4RrOGo0xP27Y7PlU4DPk5O', 'member', 'noimage.jpg', 'noimage.jpg', '', '', 'noimage.jpg', 'agen', 1),
('01.00006', '2019-11-05', 'Muhammad Irfan Muammar', '082127055238', 'Jl pangeran panjunan rt1/rw1 desa Cisaat kecamatan Dukupuntang kabupaten Cirebon', 'irfanmuammar007@gmail.com', '$2y$10$h.mIK.JBj5B9RCyBAzN9C.XT0HMBCCrMWo4sKhe10akouejlcB9mm', 'member', 'noimage.jpg', 'noimage.jpg', '', '', '01_00006.jpg', 'agen', 1),
('01.00007', '2019-11-05', 'Dwi Sunu Raharjo', '085866139850', 'Jomblang legok rt 05 rw 02 semarang 50256', 'sunjoxang@gmail.com', '$2y$10$WNm2C8U2hwQzKySAvrSzD..cB6wwQqq8kDMk/L4422FYOVugtuqlC', 'member', 'noimage.jpg', 'noimage.jpg', '111001002375536', 'Bank Rakyat Indonesia BRI', '01_00007.jpg', 'agen', 1),
('01.00008', '2019-11-05', 'Eko Nur Prasetyo, Spt. Msi', '085727611329', '', 'ekonurprasetyo1984@gmail.com', '$2y$10$etFtym159WsVcvZ9pIAmke1.hrNpyePclR4NfzTzDDQNsLI2c4sfe', 'member', 'noimage.jpg', 'noimage.jpg', '', '', 'noimage.jpg', 'agen', 1),
('01.00009', '2019-11-05', 'Yayan Supardi', '081325123353', 'Slukatan RT 07/ RW 02', 'yayansupardi46@gmail.com', '$2y$10$C2WO.itDbDadBrTVATm5k.K1dn4DRf1deVWv3/p6sBPKnECDZiqeW', 'member', 'noimage.jpg', 'noimage.jpg', '8030322925', 'BCA', '01_00009.jpg', 'agen', 1),
('01.00010', '2019-11-05', 'Sudarto', 'sudartosw@gmail.com', 'jl kradenan lama no 7 RT 08 RW 05 Kelurahan Sukorejo Kecamatan Gunungpati Semarang', 'sudartosw@gmail.com', '$2y$10$CH2eYl2j98pxhBSCAXTff.oldpRTes0wzvJNLd9cBCSnPIzn130oC', 'member', 'noimage.jpg', 'noimage.jpg', '2465191960', 'BCA', 'noimage.jpg', 'agen', 1),
('01.00011', '2019-11-05', 'Ummy Mubarokah', 'ummyrobaei@yahoo.com', '', 'ummyrobaei@yahoo.com', '$2y$10$PjGHcAXEJ5L1XSlsDWJhH.vcR3.Gk4ILjhn5zVfcBQi0ARBnU7.9G', 'member', 'noimage.jpg', 'noimage.jpg', '', '', 'noimage.jpg', 'agen', 1),
('01.00012', '2019-11-06', 'Thoriq Diaz Pahlevi Daeng Matarane', '085799448908', '', 'thoriqdiaz07@gmail.com', '$2y$10$d0WYOlqAc07qfrj2bmzB.eJM6BDMWRsy4TUO9p.AK2270/s9jiC3q', 'member', 'noimage.jpg', 'noimage.jpg', '', '', 'noimage.jpg', 'basic', 1),
('01.00013', '2019-11-10', 'Fatmasari', '081325374500', '', 'fsari.chani@gmail.com', '$2y$10$ZID/5ylgGg4/wb9WKrzUj.Hs1/6fjeyTSorOFsDeRjL4nv4kkP.u.', 'member', 'noimage.jpg', 'noimage.jpg', '', '', 'noimage.jpg', 'agen', 1),
('01.00014', '2019-11-11', 'Arief Nurcahyo', '081355236115', '', 'riefrief1135@gmail.com', '$2y$10$X5VNFLrRaWwUea3ocjgiIuLpCLLZhhOhSG5j2HA/xtEgYEO8jrSxe', 'member', 'noimage.jpg', 'noimage.jpg', '', '', 'noimage.jpg', 'agen', 1);

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

--
-- Dumping data untuk tabel `tb_agt_tmp`
--

INSERT INTO `tb_agt_tmp` (`idtmp`, `tgl_daftar`, `nm_tmp`, `nohp_tmp`, `email_tmp`, `ktp_tmp`, `password_tmp`, `idreferal`, `nominal`, `konfirm_status`, `token`) VALUES
(16, '2019-11-06', 'Fitriana Sidikah Rachman', '085795730161', 'fisirach@yahoo.com', '', '$2y$10$AP3P78QfScZ8BIoi/erJ5Ow4vky046Ff8uuHdEThiA6RpRg3XzrGC', '01.00004', 970222, 0, '5fsNXmjJip9Bk3wR'),
(19, '2019-11-06', 'Dhevan Muhamad Anthareza', '081226292132', 'dhevanmuhamad@gmail.com', '', '$2y$10$8sNMFl/9sjhTYfNG8HWGYeFLjapWlVsCgyvK32upeMsLJTB5pyavu', '01.00005', 970311, 0, 'V6m9S7CUJfsH2ayT'),
(20, '2019-11-07', 'Galih Saputra', '085712247539', 'gatra881@gmail.com', '', '$2y$10$yRN8sWF0YMtD7b65tp7w8ej6JrxrMDkIw9JuORZkxgMTii.9kkT2O', '01.00005', 970321, 0, 'gRCyG0AcdFbSpeWU'),
(21, '2019-11-07', 'dwianto wiryawan herwindo', '085866671900', 'dwiyantowiryawan@gmail.com', '', '$2y$10$eyRCS9eAtw/.ILJ0DuMd5.mu/nskTySJYuFND.Pqdzst0o1v9D/g.', '01.00003', 970133, 0, 'onaHOq84B5SGEQfx');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_bank`
--

CREATE TABLE `tb_bank` (
  `id` int(2) NOT NULL,
  `nm_bank` varchar(150) NOT NULL,
  `norek` varchar(300) NOT NULL,
  `an` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_bank`
--

INSERT INTO `tb_bank` (`id`, `nm_bank`, `norek`, `an`) VALUES
(1, 'BCA', '009 4680 561', 'Cipto Purnomo'),
(2, 'BRI', '3036 0104 1826 532', 'Susiloningsih');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_bonus`
--

CREATE TABLE `tb_bonus` (
  `id` int(3) NOT NULL,
  `registrasi` int(9) NOT NULL,
  `referal` int(9) NOT NULL,
  `royalti` int(9) NOT NULL,
  `royalti_target` int(3) NOT NULL,
  `gram_pokok` int(2) NOT NULL,
  `selisih_hrg_emas` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_bonus`
--

INSERT INTO `tb_bonus` (`id`, `registrasi`, `referal`, `royalti`, `royalti_target`, `gram_pokok`, `selisih_hrg_emas`) VALUES
(1, 970000, 15000, 10000, 10, 1, 40000),
(2, 0, 5000, 9000, 15, 0, 0),
(3, 0, 4000, 6000, 20, 0, 0),
(4, 0, 1500, 5000, 30, 0, 0),
(5, 0, 1500, 4000, 25, 0, 0),
(6, 0, 1000, 0, 0, 0, 0);

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
-- Struktur dari tabel `tb_history`
--

CREATE TABLE `tb_history` (
  `tgl` date NOT NULL,
  `idted` varchar(8) NOT NULL,
  `ket` text NOT NULL,
  `nominal_uang` int(11) NOT NULL,
  `nominal_gram` float NOT NULL,
  `status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_history`
--

INSERT INTO `tb_history` (`tgl`, `idted`, `ket`, `nominal_uang`, `nominal_gram`, `status`) VALUES
('2019-11-10', '01.00010', 'pembelian emas ', 250000, 0.348, 0);

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
('01.00001', '0', '0', 1, '1', 1, '2019-10-28'),
('01.00002', '01.00001', '01.00001', 1, '11', 2, '0000-00-00'),
('01.00003', '01.00002', '01.00002', 7, '111', 3, '0000-00-00'),
('01.00004', '01.00003', '01.00003', 1, '1111', 4, '0000-00-00'),
('01.00005', '01.00004', '01.00004', 1, '11111', 5, '0000-00-00'),
('01.00006', '01.00005', '01.00005', 0, '111111', 6, '0000-00-00'),
('01.00007', '01.00003', '01.00003', 1, '1112', 4, '0000-00-00'),
('01.00008', '01.00007', '01.00007', 0, '11121', 5, '0000-00-00'),
('01.00009', '01.00003', '01.00003', 0, '1113', 4, '0000-00-00'),
('01.00010', '01.00003', '01.00003', 0, '1114', 4, '0000-00-00'),
('01.00011', '01.00003', '01.00003', 1, '1115', 4, '0000-00-00'),
('01.00012', '01.00011', '01.00011', 0, '11151', 5, '0000-00-00'),
('01.00013', '01.00003', '01.00003', 0, '1116', 4, '0000-00-00'),
('01.00014', '01.00003', '01.00003', 0, '1117', 4, '0000-00-00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `id` bigint(20) NOT NULL,
  `tgl` date NOT NULL,
  `idted` varchar(8) NOT NULL,
  `uraian` text NOT NULL,
  `masuk` float NOT NULL,
  `keluar` float NOT NULL,
  `saldo` float NOT NULL,
  `jenis` enum('uang','emas') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`id`, `tgl`, `idted`, `uraian`, `masuk`, `keluar`, `saldo`, `jenis`) VALUES
(1, '2019-11-05', '01.00001', 'topup deposit', 5000000, 0, 5000000, 'uang'),
(2, '2019-11-09', '01.00014', 'simp. pokok & simp. wajib', 1, 0, 1, 'emas');

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
-- Indeks untuk tabel `tb_bank`
--
ALTER TABLE `tb_bank`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `idtmp` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `tb_bank`
--
ALTER TABLE `tb_bank`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_bonus`
--
ALTER TABLE `tb_bonus`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
