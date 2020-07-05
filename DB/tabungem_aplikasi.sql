-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 02 Jul 2020 pada 12.30
-- Versi server: 10.3.23-MariaDB
-- Versi PHP: 7.3.6

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
  `norek` varchar(50) NOT NULL,
  `bank` varchar(50) NOT NULL,
  `an` varchar(100) NOT NULL,
  `foto_profil` text NOT NULL,
  `jenis` enum('basic','agen') NOT NULL,
  `aktif` int(1) NOT NULL,
  `nmwaris` varchar(250) NOT NULL,
  `hubwaris` varchar(100) NOT NULL,
  `hpwaris` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_agt_ted`
--

INSERT INTO `tb_agt_ted` (`idted`, `tgl_gabung`, `nama_lengkap`, `nohp`, `alamat`, `email`, `password`, `level_user`, `scan_ktp`, `scan_npwp`, `norek`, `bank`, `an`, `foto_profil`, `jenis`, `aktif`, `nmwaris`, `hubwaris`, `hpwaris`) VALUES
('01.00001', '2019-10-28', 'Susiloningsih 1', '081327479067', 'koperasi mmas', 'info@tabungemas.com', '$2y$10$gXQu/Q8jvhD6obcASleZ9.I2SuwjXdqprBTPVoau1qn34e6w/g0bW', 'super', 'noimage.jpg', 'noimage.jpg', '12312388857', 'BCA', 'koperasi mmas', '01_00001.png', 'agen', 1, '', '', ''),
('01.00002', '2019-11-05', 'Purnomo', '0812524426', '', 'ciptoted@tabungemas.com', '$2y$10$6DxFsdIch.NTEpDIeuQFMOqiV4GGqbMdYApfZlZ.0.0JCXhmN7Yfm', 'member', 'noimage.jpg', 'noimage.jpg', '', '', '', 'noimage.jpg', 'agen', 1, '', '', ''),
('01.00003', '2019-11-05', 'Susiloningsih', '082136368828', 'Kanfer raya', 'kopikukopika@gmail.com', '$2y$10$R8gD4lOjc3KSG3zUQDCpe.gQFEEyO0pB9UEmMjLTVYfpCxOF4Bosu', 'member', 'ktp_01_00003.jpg', 'npwp_01_00003.jpg', '303601041826532', 'BRI', 'susiloningsih', '01_00003.jpg', 'agen', 1, 'sumarni', 'ortu', '+62 822-4216-9246'),
('01.00004', '2019-11-05', 'Cipto Purnomo', '081225230626', 'Jl truntum VI no 11 Tlogosari kulon pedurungan semarang', 'ciptopurnomo@tabungemas.com', '$2y$10$1cE9HF4MQZrdRu6hAzEs5uEcGfoFSgyMW57bURv0gIMORlYstGMpe', 'member', 'noimage.jpg', 'noimage.jpg', '0094680561', 'BCA', '', 'noimage.jpg', 'agen', 1, '', '', ''),
('01.00005', '2019-11-05', 'Ariandaru Kusuma Yudha', '08112888470', '', 'kog434@gmail.com', '$2y$10$SSDq5wmc9kEdz3Jf1s7gl.VxKyYKuNa4RrOGo0xP27Y7PlU4DPk5O', 'member', 'noimage.jpg', 'noimage.jpg', '', '', '', 'noimage.jpg', 'agen', 1, '', '', ''),
('01.00006', '2019-11-05', 'Muhammad Irfan Muammar', '082127055238', 'Jl pangeran panjunan rt1/rw1 desa Cisaat kecamatan Dukupuntang kabupaten Cirebon', 'irfanmuammar007@gmail.com', '$2y$10$h.mIK.JBj5B9RCyBAzN9C.XT0HMBCCrMWo4sKhe10akouejlcB9mm', 'member', 'noimage.jpg', 'noimage.jpg', '', '', '', '01_00006.jpg', 'agen', 1, '', '', ''),
('01.00007', '2019-11-05', 'Dwi Sunu Raharjo', '085866139850', 'Jomblang legok rt 05 rw 02 semarang 50256', 'sunjoxang@gmail.com', '$2y$10$WNm2C8U2hwQzKySAvrSzD..cB6wwQqq8kDMk/L4422FYOVugtuqlC', 'member', 'noimage.jpg', 'noimage.jpg', '111001002375536', 'Bank Rakyat Indonesia BRI', 'Dwi sunu raharjo', '01_00007.jpg', 'agen', 1, '', '', ''),
('01.00008', '2019-11-05', 'Eko Nur Prasetyo, Spt. Msi', '085727611329', 'Tegalsari barat 3 rt 01 rw 11 no 11', 'ekonurprasetyo1984@gmail.com', '$2y$10$Z9ZGBwoCdE5vnTfgGvgRrOxDkrGPspPCJ1mv4Vez59ipFGAtOPM5u', 'member', 'noimage.jpg', 'noimage.jpg', '', '', '', 'noimage.jpg', 'agen', 1, '', '', ''),
('01.00009', '2019-11-05', 'Yayan Supardi', '081325123353', 'Slukatan RT 07/ RW 02', 'yayansupardi46@gmail.com', '$2y$10$YcHqODIqfKEPAR5ft.rjBuxhkouFu0FdJug.eTTObm/sNsm.ZarYa', 'member', 'noimage.jpg', 'noimage.jpg', '8030322925', 'BCA', '', '01_00009.jpg', 'agen', 1, '', '', ''),
('01.00010', '2019-11-05', 'Sudarto', '085747410593', 'jl kradenan lama no 7 RT 08 RW 05 Kelurahan Sukorejo Kecamatan Gunungpati Semarang', 'sudartosw@gmail.com', '$2y$10$CH2eYl2j98pxhBSCAXTff.oldpRTes0wzvJNLd9cBCSnPIzn130oC', 'member', 'noimage.jpg', 'noimage.jpg', '2465191960', 'BCA', '', 'noimage.jpg', 'agen', 1, '', '', ''),
('01.00011', '2019-11-05', 'Ummy Mubarokah', '081325469975', '', 'ummyrobaei@yahoo.com', '$2y$10$5hgNcGga7G3islwWJF5q4O0023mukbssefEwuTQjOOZBdqYbYBgEO', 'member', 'noimage.jpg', 'noimage.jpg', '', '', '', 'noimage.jpg', 'agen', 1, '', '', ''),
('01.00012', '2019-11-06', 'Thoriq Diaz Pahlevi Daeng Matarane', '085799448908', '', 'thoriqdiaz07@gmail.com', '$2y$10$d0WYOlqAc07qfrj2bmzB.eJM6BDMWRsy4TUO9p.AK2270/s9jiC3q', 'member', 'noimage.jpg', 'noimage.jpg', '', '', '', 'noimage.jpg', 'basic', 1, '', '', ''),
('01.00013', '2019-11-10', 'Fatmasari', '081325374500', '', 'fsari.chani@gmail.com', '$2y$10$ZID/5ylgGg4/wb9WKrzUj.Hs1/6fjeyTSorOFsDeRjL4nv4kkP.u.', 'member', 'noimage.jpg', 'noimage.jpg', '', '', '', 'noimage.jpg', 'agen', 1, '', '', ''),
('01.00014', '2019-11-11', 'Arief Nurcahyo', '081355236115', '', 'riefrief1135@gmail.com', '$2y$10$P2I0JSbQwVmP1LaZxWWX2u9SiG8nxWUQvhVmMIMqdHyoNrVm9BrE.', 'member', 'noimage.jpg', 'noimage.jpg', '', '', '', 'noimage.jpg', 'agen', 1, '', '', ''),
('01.00015', '2019-11-11', 'Juniar Arif Wicaksono', '081390559997', 'Dusun Gentan Lor Rt. 04 Rw. 03, Kec. Boja, Kab. Kendal', 'arifsavutage@gmail.com', '$2y$10$ca0pp55yIoQa7ktPaU20nOlApQit2dmHalQkGlaL1bX/ZYB6k/bZO', 'member', 'noimage.jpg', 'noimage.jpg', '333 222 111 22', 'Bank Toyib', 'Juniar Arif Wicaksono', '01_00015.jpg', 'agen', 1, 'dian ayu afriyanti', 'istri', '08512345678'),
('01.00016', '2019-11-13', 'Sri Rahayu Puji Astuti', '082134707576', '', 'hildasabrinadyra@gmail.com', '$2y$10$eNjAXmAAxLZJB2w1UssBVuK9nkT2KYOXaPPd1.98UBYw2poRXoVkC', 'member', 'noimage.jpg', 'noimage.jpg', '', '', '', 'noimage.jpg', 'agen', 1, '', '', ''),
('01.00017', '2019-11-14', 'Ajik Prasetyo', '0895605369334', 'Jl. Gaharu barat dalam VI / 378 RT 03 RW 09 srondol wetan banyumanik, semarang', 'ajikprasetyoo@gmail.com', '$2y$10$6D0TsoKe38PQydP05HOl6eXaS/qYgkzDET2dIHpHu2sWBULV/.XhS', 'member', 'noimage.jpg', 'noimage.jpg', '2521100861', 'BCA', '', 'noimage.jpg', 'agen', 1, '', '', ''),
('01.00018', '2019-11-16', 'Natalia Desi K', 'dshe_ajalah@yahoo.co', '', 'dshe_ajalah@yahoo.com', '$2y$10$7E4eqxQETb3INgIP4B1D/.ZjajEOTSFiqNArV3Cm7Lj1zpNFSe2Ne', 'member', 'noimage.jpg', 'noimage.jpg', '', '', '', 'noimage.jpg', 'basic', 1, '', '', ''),
('01.00019', '2019-11-19', 'Nur Shabrina', '0895393034668', '', 'azukarose21@gmail.com', '$2y$10$7xOoeN1m0PtWbWuAFBaMd.fRtxGPXfdyClbeEZHVejALRl/gDOfmW', 'member', 'noimage.jpg', 'noimage.jpg', '', '', '', 'noimage.jpg', 'basic', 1, '', '', ''),
('01.00020', '2019-11-19', 'Zhazha Zahira Ginastuti', '081806048948', '', 'zhazhazahira@gmail.com', '$2y$10$QNwO9JRpU6gLY/i1GIOpwOQ7ieh1m0ZBex9U6gKtV4DPwyqlz641q', 'member', 'noimage.jpg', 'noimage.jpg', '', '', '', 'noimage.jpg', 'basic', 1, '', '', ''),
('01.00021', '2019-11-19', 'Yusuf Muhammad', '085520757945', '', 'yeefem.25@gmail.com', '$2y$10$lmmQKppdVeV9r6WW.61Nk.bqkKBSlDzM6NWOifrwUjSzE18xGI4Wi', 'member', 'noimage.jpg', 'noimage.jpg', '', '', '', 'noimage.jpg', 'basic', 1, '', '', ''),
('01.00022', '2019-11-19', 'Andika Latif Kurniawan', '0895367355591', '', 'dika.latif.99@gmail.com', '$2y$10$LlHD8MLh6kbF2N52Y.3oluPe4qrz92/bDpYSyDbMWSvA03O//MI.6', 'member', 'noimage.jpg', 'noimage.jpg', '', '', '', 'noimage.jpg', 'basic', 1, '', '', ''),
('01.00023', '2019-12-05', 'Lia Afiani', '081327405100', '', 'bisnisjaring@gmail.com', '$2y$10$LYAFdD4fUxEBuoT4hwi4Uu56NXTrsv9BIlo1xymajKts7ySXANUja', 'member', 'noimage.jpg', 'noimage.jpg', '', '', '', 'noimage.jpg', 'basic', 1, '', '', ''),
('01.00024', '2019-12-05', 'Muhammad Arif Efendi', '081392761799', '', 'muhammadarifefendi6@gmail.com', '$2y$10$3JqS6g1B4iGrv8Z/gsyt5.R9Q0mkgVxpZ67ABX6jJDNh5danLMkIW', 'member', 'noimage.jpg', 'noimage.jpg', '', '', '', '01_00024.jpg', 'basic', 1, '', '', ''),
('01.00025', '2019-12-05', 'Amelia Nadia Rahma', '082230854065', '', 'amelianadiar@gmail.com', '$2y$10$K7iM9pRUnseeTLGOdBVXleU.j5m82ulkJhOC2r97iuGbBVlyCexJC', 'member', 'noimage.jpg', 'noimage.jpg', '', '', '', 'noimage.jpg', 'agen', 1, '', '', ''),
('01.00026', '2019-12-06', 'Hilda Sabrina Dyra Permata Hatti Mama', '0895396248408', '', 'hildasabrinadyra@gmail.com', '$2y$10$K9PXNd9Qdt5J.QrD4guKWua5v1DDwuLhmAD/5BE9iDSIBdlhiuB/u', 'member', 'noimage.jpg', 'noimage.jpg', '', '', '', 'noimage.jpg', 'basic', 1, '', '', ''),
('01.00027', '2019-12-08', 'Sri Susanti', '085101995521', 'Jl. Arumanis Barat No. 17 Semarang', 'srisusantihasta@gmail.com', '$2y$10$zebC05vZXCM2AmlvrGZGU.0Wd1Yrc7itUE.jaNCELy1kuxFOG4Yey', 'member', 'noimage.jpg', 'noimage.jpg', '304301021939534', '', '', 'noimage.jpg', 'agen', 1, '', '', ''),
('01.00028', '2019-12-08', 'Ari Wuryantini', '081326627170', '', 'kosbuwarto@gmail.com', '$2y$10$qlbp/PHg.VrHG17HKqXqAuvzyvZ.iLy0qTDdOWeK9RTyXeOfNey96', 'member', 'noimage.jpg', 'noimage.jpg', '', '', '', 'noimage.jpg', 'basic', 1, '', '', ''),
('01.00029', '2019-12-09', 'Kukuh Saryanto', '089658970103', '', 'kukuhsaryanto2105@gmail.com', '$2y$10$hfbtMoz/6Q9sbvOV8SxF9u95Q7083xnE42Jzigb8jy547uckpNpbO', 'member', 'noimage.jpg', 'noimage.jpg', '', '', '', 'noimage.jpg', 'basic', 1, '', '', ''),
('01.00030', '2019-12-16', 'Susila Widodo B.Sc', '081220007663', '', 'denbagussusilo4@gmail.com', '$2y$10$Slc.vh8k.fYb9cWlH6ctIOPriQNBXPmRd/z44KQ43.cwLZ.BHJMhK', 'member', 'noimage.jpg', 'noimage.jpg', '', '', '', 'noimage.jpg', 'basic', 1, '', '', ''),
('01.00031', '2019-12-19', 'Arwani', '082244083915', 'Jl. Mangga dalam no. 16C, RT/RW 06/02, Srondol Wetan, Banyumanik, Semarang ', 'arwani0709@gmail.com', '$2y$10$ZQvQLQ5kaCvJe1XinQoNuetEhVh83by9k0UpJxRB.eGUfw9DdnO2a', 'member', 'noimage.jpg', 'noimage.jpg', '0095345617', 'BCA', '', 'noimage.jpg', 'agen', 1, '', '', ''),
('01.00032', '2019-12-24', 'Wisnu Tri Hanggoro', '081391158191', 'Jl. Sinoman Tempel III/225b?\r\nSidorejo Lor, Salatiga', 'wisnuhanggoro@gmail.com', '$2y$10$eNIS/cwnfBvIprVTNJytrum99oIOyF1zZd/lyGqK0.RKR4Avz7Ubm', 'member', 'noimage.jpg', 'noimage.jpg', '0553033162', 'BNI 1946', '', '01_00032.png', 'agen', 1, '', '', ''),
('01.00033', '2019-12-25', 'Muhammad Ichsan Wijayanto', '089680381557', 'Jl. P. Diponegoro Gang Keling 1 no. 9 kalongan purwodadi grobogan', 'mi.wijayanto@gmail.com', '$2y$10$JbTeIVhGe0Zd.SN6Wx8/YuInYG.zRD/e8vwJrxbOQudU/tMImZuEq', 'member', 'noimage.jpg', 'noimage.jpg', '', '', '', 'noimage.jpg', 'agen', 1, '', '', ''),
('01.00034', '2020-01-06', 'Titut Purwati', '081804005003', '', 'tutwati@gmail.com', '$2y$10$hqNeY.2fIc1qQ7UOcBpknut8BBmlxRiK.qnldwllJSjiPrjIFYCJy', 'member', 'noimage.jpg', 'noimage.jpg', '', '', '', 'noimage.jpg', 'agen', 1, '', '', ''),
('01.00035', '2020-01-08', 'Gerosima Fridolin Rizky Widya Santosa', '082143115638', '', 'gerosimafrws@gmail.com', '$2y$10$r/.bGiaHCuhgcCDx5DRyq.wG.p4s74rC4k5J/Yb.XzEuyFGaVYwDW', 'member', 'noimage.jpg', 'noimage.jpg', '', '', '', 'noimage.jpg', 'basic', 1, '', '', ''),
('01.00036', '2020-01-08', 'Dewi Resiawati', '085643139444', '', 'dewiresyawati111@gmail.com', '$2y$10$lYIyNKZMsX5SUENWCFOZJ.QlL5df8EQCgKdn89pVE71w0Qxz.Zbn.', 'member', 'noimage.jpg', 'noimage.jpg', '', '', '', 'noimage.jpg', 'agen', 1, '', '', ''),
('01.00037', '2020-01-08', 'LIE TJOEN LIANG', '085865063278', '', 'tjoenliang63@gmail.com', '$2y$10$LndNeD9kkB.EvINAKN/0.ecHrm3gdAe7oUPfeIolkx.upXbLImlOO', 'member', 'noimage.jpg', 'noimage.jpg', '', '', '', 'noimage.jpg', 'agen', 1, '', '', ''),
('01.00038', '2020-01-08', 'Tuti Wisniati', '085641601190', '', 'tutiwisniati2@gmail.com', '$2y$10$pHsidjf9jORCnwUjcJKtHOmGT067rT5lrr/EfU.jOoUkCCUbawwxy', 'member', 'noimage.jpg', 'noimage.jpg', '', '', '', 'noimage.jpg', 'agen', 1, '', '', ''),
('01.00039', '2020-01-16', 'Maemonah', '085740786446', '', 'maemonah60@gmail.com', '$2y$10$kaNBxsnPmi2xfC67G.acN.KiYo5lvLaanUweXPy6uz.lDACAL08rG', 'member', 'noimage.jpg', 'noimage.jpg', '', '', '', 'noimage.jpg', 'basic', 1, '', '', ''),
('01.00040', '2020-01-27', 'I Made Danu Indrayasa', '08176944587', '', 'indrayasamade@gmail.com', '$2y$10$rXmou.5EZBOY4Y33JKJXnOFwv6zHm0jl.Y29odUngYfs2q9s.L.Lq', 'member', 'noimage.jpg', 'noimage.jpg', '', '', '', 'noimage.jpg', 'basic', 1, '', '', ''),
('01.00041', '2020-02-08', 'Titik Ikha Purbiyanti', '081229929291', '', 'bundatikarosa@gmail.com', '$2y$10$ZlGWI5dRfOQXQvSc.a2.keqHVsyW3mwIb8w7GNYr/yKA.gSQ2p0u2', 'member', 'noimage.jpg', 'noimage.jpg', '', '', '', 'noimage.jpg', 'basic', 1, '', '', ''),
('01.00042', '2020-02-09', 'MARGIYANTI', '085740601703', '', 'margi.7317ty@gmail.com', '$2y$10$P2tfM7YtXUIlARbdidxu/.MEtn8FjSD6.VpA8FqSgZz8ir/j5.ALq', 'member', 'noimage.jpg', 'noimage.jpg', '', '', '', 'noimage.jpg', 'agen', 1, '', '', ''),
('01.00043', '2020-02-20', 'Eka Nurdiana', '082345608486', '', 'ekanurdiana8096@yahoo.co.id', '$2y$10$35HXoE.nwwyFg.93xRd1e.F74mtnjNSWp6fHwYoLWRIKzM3uFPl5i', 'member', 'noimage.jpg', 'noimage.jpg', '', '', '', 'noimage.jpg', 'basic', 1, '', '', ''),
('01.00044', '2020-02-21', 'Irfan Maulana Suparjo', '085345959888', 'Jl.Simpang Bhayangkara II Gg. Manggis V, RT.024 Kel.Madurejo, Kec. Arut Selatan Kab.Kotawaringin Barat-Kalteng', 'irfanmaulana99@yahoo.co.id', '$2y$10$E6JpzSKeHtXc4NrfKhsapOWq0hmXJ.2nGrxbvlgZnE5focRRFDwdK', 'member', 'ktp_01_00044.jpg', 'noimage.jpg', '8585102390', 'BCA', 'Irfan Maulana Suparjo', 'noimage.jpg', 'basic', 1, '', '', ''),
('01.00045', '2020-02-25', 'Dwianto Wiryawan Herwindo', '085866671900', '', 'dwiyantowiryawan@gmail.com', '$2y$10$eyRCS9eAtw/.ILJ0DuMd5.mu/nskTySJYuFND.Pqdzst0o1v9D/g.', 'member', 'noimage.jpg', 'noimage.jpg', '', '', '', 'noimage.jpg', 'basic', 1, '', '', ''),
('01.00046', '2020-02-26', 'Eka S Saptini', '089601032203', '', 'ekasapini180971@gmail.com', '$2y$10$6ZfcevMg.huaWsAYISU/Puv4o4pqh6RQfs4COr6Tz1SZvhpTaT.Xq', 'member', 'noimage.jpg', 'noimage.jpg', '', '', '', 'noimage.jpg', 'basic', 1, '', '', ''),
('01.00047', '2020-02-26', 'Eka S Saptini', '089601032203', '', 'ekasaptini180971@gmail.com', '$2y$10$Gz2wpeTXB3EEhHGDBgWH9eV1TYp4vvlHgMrtokPc3hpSKMNyJTfIG', 'member', 'noimage.jpg', 'noimage.jpg', '', '', '', 'noimage.jpg', 'basic', 1, '', '', ''),
('01.00048', '2020-03-02', 'Mansyur Salim ', '082324210910', '', 'msyaifullohfatah@gmail.com', '$2y$10$5gftD2usWEOSdaTc2X.1muKwhxF6ibbcit9DKwYNCvBF4dcfRBApG', 'member', 'noimage.jpg', 'noimage.jpg', '', '', '', 'noimage.jpg', 'basic', 1, '', '', ''),
('01.00049', '2020-03-02', 'Maria Magdalena Sutari', '087734645495', '', 'cutt762@gmail.com', '$2y$10$0Cc5vwBYiBQoBCSZQPL50.4BXyqaoxmMTu1xD8HvGvAWy.zNNgZBS', 'member', 'noimage.jpg', 'noimage.jpg', '', '', '', 'noimage.jpg', 'basic', 1, '', '', ''),
('01.00050', '2020-03-21', 'Ivonne Kartika Aju', '081228156119', '', 'indigo_221@yahoo.com', '$2y$10$ss8l3pHAqz9GsvYWnqsrgO7kGXYs8c4F7.r4cDb9dIVg3DzFrB.7O', 'member', 'noimage.jpg', 'noimage.jpg', '', '', '', 'noimage.jpg', 'basic', 1, '', '', ''),
('01.00051', '2020-03-25', 'Tri Nurdyastuti/Alumni', '082299413996', '', 'nurdyastutitri@gmail.com', '$2y$10$fJWhvaMbznsuizA/L7ZV3uk300GPRprXXJdFEafD8REdgAojDt4vS', 'member', 'noimage.jpg', 'noimage.jpg', '', '', '', 'noimage.jpg', 'basic', 1, '', '', ''),
('01.00052', '2020-04-10', 'Dwi Ratnawati', '081575886727', '', 'ratnasujadi@gmail.com', '$2y$10$u4PY5mSmLXfIPYTWBJyRbeUsIEuuAyRM8OqNo19rBR1FaKyBP7jEm', 'member', 'noimage.jpg', 'noimage.jpg', '', '', '', 'noimage.jpg', 'basic', 1, '', '', ''),
('01.00053', '2020-05-01', 'Sugiharti', '0811251610', '', 'sugih_arti1@yahoo.com', '$2y$10$K9czd8brpcBt970H/79Q3u/kLakLxkOvkMEvKjkf/q7duxshM5Vq2', 'member', 'noimage.jpg', 'noimage.jpg', '', '', '', 'noimage.jpg', 'basic', 1, '', '', ''),
('01.00054', '2020-05-31', 'Muhammad Badruz Zaman', '085713893698', 'Jl.kyai Mojo gg buntu Srondol kulon Banyumanik Semarang', 'muhammadbadruz19@gmail.com', '$2y$10$A249YCZQMw4BUxOqkWa2J.PCG2TxlReym70mgcjboN7d6st7OjsYO', 'member', 'noimage.jpg', 'noimage.jpg', '7830017954', 'BCA', 'Muhammad Badruz zaman', '01_00054.jpg', 'agen', 1, '', '', ''),
('01.00055', '2020-06-02', 'Moh. Nahrudin', '085701036714', 'Jl. Kemuning Gg seruni 2 no:4 kejambon tegal', 'mohnahrudin@gmail.com', '$2y$10$0IIr8P14zNoYHIcrZdtepuqN8FlBkJRMAQYLKP0uAuj/JbOYYUKKC', 'member', 'noimage.jpg', 'noimage.jpg', '060901011057503', 'BRI', 'Mohamad Nahrudin', 'noimage.jpg', 'agen', 1, '', '', ''),
('01.00056', '2020-06-02', 'Achmad Heidar Maulana', '085647425251', '', 'achmdheidar14@gmail.com', '$2y$10$1zu7oO50R0RTUrb9g.i3U.fDl1tJFm//0bcBNTrjZPApk8X6VGzZu', 'member', 'noimage.jpg', 'noimage.jpg', '', '', '', 'noimage.jpg', 'basic', 1, '', '', ''),
('01.00057', '2020-06-02', 'Raffendra Gilang Dicahya', '082143165184', '', 'raffendragilangdicahya@gmail.com', '$2y$10$tmcB.ceT5M4Edf8YJVQYSem3FoJBzNWr3iY/ot//3EsXPf3FD18J6', 'member', 'noimage.jpg', 'noimage.jpg', '', '', '', 'noimage.jpg', 'basic', 1, '', '', ''),
('01.00058', '2020-06-08', 'Junaidi', '0895360905875', 'Jl. Menoreh Tengah X No. 6 Sampangan Gajahmungkur Kota Semarang', 'junelqudsy@gmail.com', '$2y$10$zIGFEh1iFU.kahX0zD/SKO2r9/augmxnLP3Zw1gZ..sX1gtwI9dDK', 'member', 'noimage.jpg', 'noimage.jpg', '8035099243', 'BCA', 'Junaidi', 'noimage.jpg', 'agen', 1, '', '', ''),
('01.00059', '2020-06-08', 'Saiful Rizal', '082323011056', '', 'rizalfkubsemarang@gmail.com', '$2y$10$0JCV6vtjZcGzdkcyoydGpO.iN9d5E4KkcaT/hxiLsyB33HivtZB7G', 'member', 'noimage.jpg', 'noimage.jpg', '', '', '', 'noimage.jpg', 'basic', 1, '', '', ''),
('01.00060', '2020-06-09', 'Haryono', '085876100940', 'Dsn Tumbu Purwodadi KEC Tegalrejo Kab Magelang', 'ahmadkahar.mgl@gmail.com', '$2y$10$A6r7xlRjQhvhWQyxZuV8Vuum34LTTY5Ly8q86INQZl9HnkC4sMxxS', 'member', 'noimage.jpg', 'noimage.jpg', '100601002755535', 'BRI', 'HARYONO', '01_00060.jpg', 'agen', 1, '', '', ''),
('01.00061', '2020-06-16', 'Ekosetyocahyono', '081937676933', '', 'ekosetyo244@gmail.com', '$2y$10$Q0.Y4xwLf7yaXmdmTOZbQOSbFzg808C/3wUAQYsi6KI6hwTXHVHF6', 'member', 'noimage.jpg', 'noimage.jpg', '', '', '', 'noimage.jpg', 'basic', 1, '', '', ''),
('01.00062', '2020-06-20', 'Prawira Rajendra Arva Habib Kusuma', '085101292189', '', 'arvakusumatabunganemas@gmail.com', '$2y$10$0hORzQL2gkZpk8cqidhk1eSi6rV2wjk68JXn6VlL89JYlqakxSMKa', 'member', 'noimage.jpg', 'noimage.jpg', '', '', '', 'noimage.jpg', 'basic', 1, '', '', ''),
('01.00063', '2020-06-24', 'Agus Prasetyo', '085950726801', '', 'dspsmg1@gmail.com', '$2y$10$sKqpPS0lULSe0/CvS.Ayp.PW0QTDhORPwcsU8eGd/3qZZ77Hq9/Yq', 'member', 'noimage.jpg', 'noimage.jpg', '', '', '', 'noimage.jpg', 'agen', 1, '', '', ''),
('01.00064', '2020-06-25', 'SRI WAHYUNI', '08156516580', '', 'maysafif.02@gmail.com', '$2y$10$/zi2IJQ5O9ASGLppJ0i4YOZISXAt6D31UWBMTL3ApL9T.IW80J3jK', 'member', 'noimage.jpg', 'noimage.jpg', '', '', '', 'noimage.jpg', 'basic', 1, '', '', ''),
('01.00065', '2020-06-29', 'ANDRE WIRADIKUSUMA, ST', '081325453388', '', 'andrewiradikusuma727@gmail.com', '$2y$10$3PTkOL5mQrkAxLsGv7CQp.9GpyYRQdxGNB0fDhSMNChUaxFH9n72m', 'member', 'noimage.jpg', 'noimage.jpg', '', '', '', 'noimage.jpg', 'basic', 1, '', '', '');

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
(83, '2020-06-16', 'Nur Aeni', '085713893698', 'muhammadbadruz19@gmail.com', '', '$2y$10$NOLkelOMafPSaYNe61W/5eJzlsLK.weX5uvD81TygunntXLnypB1G', '01.00054', 200111, 0, 'HQGtnPwu80UMTWmc');

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
(2, 'BRI', '3036 0104 1826 532', 'Susiloningsih'),
(3, 'BCA', '803 051 7131', 'Susiloningsih');

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
  `selisih_jual` int(9) NOT NULL,
  `selisih_beli` int(9) NOT NULL,
  `by_adm_master` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_bonus`
--

INSERT INTO `tb_bonus` (`id`, `registrasi`, `referal`, `royalti`, `royalti_target`, `gram_pokok`, `selisih_jual`, `selisih_beli`, `by_adm_master`) VALUES
(1, 200000, 15000, 10000, 10, 1, 0, 40000, 10000),
(2, 179000, 5000, 9000, 15, 0, 0, 0, 0),
(3, 21000, 4000, 6000, 20, 0, 0, 0, 0),
(4, 0, 1500, 5000, 30, 0, 0, 0, 0),
(5, 0, 1500, 4000, 25, 0, 0, 0, 0),
(6, 0, 1000, 0, 0, 0, 0, 0, 0);

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
-- Struktur dari tabel `tb_deposit`
--

CREATE TABLE `tb_deposit` (
  `idx` bigint(20) NOT NULL,
  `tgl_deposit` timestamp NOT NULL DEFAULT current_timestamp(),
  `idted` varchar(8) NOT NULL,
  `nom_deposit` int(11) NOT NULL,
  `banktrf` int(2) NOT NULL,
  `status` enum('aproved','tunggu') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_deposit`
--

INSERT INTO `tb_deposit` (`idx`, `tgl_deposit`, `idted`, `nom_deposit`, `banktrf`, `status`) VALUES
(1, '2020-01-04 01:32:43', '01.00001', 50000, 2, 'aproved'),
(6, '2020-06-12 04:41:44', '01.00053', 17977, 2, 'tunggu'),
(7, '2020-06-12 07:39:50', '01.00053', 144818, 2, 'aproved'),
(5, '2020-06-02 09:31:59', '01.00025', 88979, 2, 'aproved'),
(8, '2020-06-13 02:46:54', '01.00042', 141642, 2, 'aproved'),
(9, '2020-06-16 05:15:12', '01.00025', 177959, 2, 'aproved');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_history`
--

CREATE TABLE `tb_history` (
  `idx` bigint(20) NOT NULL,
  `tgl` timestamp NOT NULL DEFAULT current_timestamp(),
  `idted` varchar(8) NOT NULL,
  `tujuan_jual` varchar(8) NOT NULL,
  `ket` text NOT NULL,
  `nominal_uang` int(11) NOT NULL,
  `nominal_gram` float NOT NULL,
  `status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_history`
--

INSERT INTO `tb_history` (`idx`, `tgl`, `idted`, `tujuan_jual`, `ket`, `nominal_uang`, `nominal_gram`, `status`) VALUES
(1, '2019-11-10 16:00:00', '01.00015', 'TED', 'pembelian emas ', 5000000, 6.966, 1),
(3, '2019-11-11 16:00:00', '01.00015', 'TED', 'jual emas ', 1282000, 2, 1),
(4, '2019-11-11 16:00:00', '01.00001', 'TED', 'pembelian emas ', 10000, 0.014, 1),
(5, '2019-11-12 16:00:00', '01.00003', 'TED', 'pembelian emas ', 10000, 0.014, 1),
(6, '2019-11-12 16:00:00', '01.00003', 'TED', 'pembelian emas ', 10000, 0.013, 1),
(7, '2019-11-14 10:04:59', '01.00003', 'TED', 'pembelian emas ', 567890, 0.815, 1),
(8, '2019-11-14 16:07:42', '01.00003', 'TED', 'jual emas ', 330000, 0.5, 0),
(9, '2019-11-16 04:40:03', '01.00015', 'TED', 'pembelian emas ', 900000, 1.293, 0),
(10, '2019-11-16 05:21:13', '01.00003', 'TED', 'pembelian emas ', 100000, 0.144, 1),
(11, '2019-11-19 10:13:18', '01.00003', 'TED', 'pembelian emas ', 100000, 0.144, 1),
(12, '2019-11-20 04:50:51', '01.00010', 'TED', 'pembelian emas ', 791000, 1.136, 1),
(13, '2019-11-20 13:05:43', '01.00003', 'TED', 'pembelian emas ', 130000, 0.187, 1),
(14, '2019-11-20 13:08:22', '01.00003', 'TED', 'jual emas ', 329750, 0.5, 0),
(16, '2019-11-21 07:54:34', '01.00009', 'TED', 'pembelian emas ', 791000, 1.137, 1),
(17, '2019-11-22 01:33:30', '01.00003', 'TED', 'pembelian emas ', 70000000, 100.638, 1),
(18, '2019-11-27 09:05:57', '01.00011', 'TED', 'pembelian emas ', 770000, 1.112, 1),
(19, '2019-12-08 09:02:19', '01.00028', 'TED', 'pembelian emas ', 2080000, 3.01, 1),
(20, '2019-12-08 09:20:39', '01.00028', 'TED', 'jual emas ', 655, 0.001, 0),
(21, '2019-12-08 09:22:24', '01.00028', 'TED', 'pembelian emas ', 654, 0.001, 1),
(22, '2019-12-18 05:44:30', '01.00003', 'TED', 'jual emas ', 6580, 0.01, 0),
(23, '2019-12-19 08:30:32', '01.00003', 'TED', 'jual emas ', 5927, 0.009, 0),
(24, '2019-12-20 09:42:55', '01.00010', 'TED', 'pembelian emas ', 770000, 1.107, 1),
(25, '2019-12-20 09:47:32', '01.00010', 'TED', 'jual emas ', 6590, 0.01, 0),
(26, '2019-12-24 02:02:24', '01.00032', 'TED', 'pembelian emas ', 500000, 0.719, 1),
(27, '2019-12-24 04:36:08', '01.00009', 'TED', 'pembelian emas ', 770000, 1.107, 1),
(28, '2019-12-24 04:39:24', '01.00009', 'TED', 'jual emas ', 659, 0.001, 0),
(29, '2019-12-24 04:40:32', '01.00009', 'TED', 'pembelian emas ', 659, 0.001, 1),
(30, '2019-12-24 07:24:26', '01.00003', 'TED', 'pembelian emas ', 10000, 0.014, 1),
(31, '2019-12-25 14:37:46', '01.00033', 'TED', 'pembelian emas ', 10000, 0.014, 1),
(32, '2019-12-25 14:48:01', '01.00033', 'TED', 'jual emas ', 659, 0.001, 0),
(33, '2020-01-03 06:52:56', '01.00003', '', 'pembelian emas ', 10000, 0.014, 1),
(34, '2020-01-03 06:57:25', '01.00003', 'TED', 'jual emas ', 0, 0, 0),
(35, '2020-01-16 07:13:14', '01.00036', 'TED', 'jual emas ', 675, 0.001, 0),
(36, '2020-01-27 08:25:40', '01.00016', 'TED', 'jual emas ', 0, 0, 0),
(37, '2020-01-30 14:01:05', '01.00003', 'TED', 'jual emas ', 6830, 0.01, 0),
(38, '2020-02-07 15:27:39', '01.00007', '', 'pembelian emas ', 200000, 0.279, 0),
(39, '2020-02-08 15:10:21', '01.00024', '', 'pembelian emas ', 700000, 0.975, 1),
(40, '2020-02-14 15:43:37', '01.00016', 'TED', 'jual emas ', 0, 0, 0),
(41, '2020-02-20 09:07:36', '01.00043', '', 'pembelian emas ', 50000, 0.068, 1),
(42, '2020-03-28 15:12:46', '01.00003', '', 'pembelian emas ', 1000, 0.001, 1),
(43, '2020-04-07 07:49:44', '01.00033', '', 'pembelian emas ', 2000000, 2.214, 1),
(44, '2020-04-10 10:37:28', '01.00052', '', 'pembelian emas ', 1800000, 2.015, 1),
(45, '2020-04-15 10:37:51', '01.00007', 'TED', 'jual emas ', 158760, 0.189, 0),
(46, '2020-04-15 10:37:51', '01.00007', 'TED', 'jual emas ', 158760, 0.189, 0),
(47, '2020-06-01 11:24:07', '01.00003', '', 'pembelian emas ', 0, 0, 1),
(48, '2020-06-01 11:24:17', '01.00003', '', 'pembelian emas ', 10000, 0.011, 1),
(50, '2020-06-01 11:26:04', '01.00003', 'TED', 'jual emas ', 8130, 0.01, 0),
(51, '2020-06-06 05:08:32', '01.00043', '', 'pembelian emas ', 100000, 0.118, 1),
(52, '2020-06-13 02:49:35', '01.00042', '', 'pembelian emas ', 50000, 0.058, 1),
(53, '2020-06-23 16:00:57', '01.00051', '', 'pembelian emas ', 6000000, 6.948, 1),
(54, '2020-06-23 16:05:44', '01.00042', '', 'pembelian emas ', 1548000, 1.793, 1),
(55, '2020-06-23 16:08:42', '01.00042', '', 'pembelian emas ', 150000, 0.174, 1),
(56, '2020-06-23 16:15:56', '01.00011', '', 'pembelian emas ', 864000, 1.001, 1),
(57, '2020-06-23 16:17:09', '01.00011', '', 'pembelian emas ', 864000, 1.001, 1),
(58, '2020-06-23 16:19:56', '01.00053', '', 'pembelian emas ', 5200000, 6.022, 1),
(59, '2020-06-23 16:22:58', '01.00025', '', 'pembelian emas ', 8640000, 10.005, 1),
(60, '2020-06-23 16:25:03', '01.00003', '', 'pembelian emas ', 1000000, 1.158, 1),
(61, '2020-06-23 16:26:46', '01.00003', '', 'pembelian emas ', 1728000, 2.001, 1),
(62, '2020-06-23 16:31:57', '01.00009', '', 'pembelian emas ', 1000000, 1.158, 1),
(63, '2020-06-23 16:34:47', '01.00027', '', 'pembelian emas ', 10400000, 12.043, 1),
(64, '2020-06-23 16:37:10', '01.00062', '', 'pembelian emas ', 1728000, 2.001, 1),
(65, '2020-06-23 16:38:42', '01.00023', '', 'pembelian emas ', 1728000, 2.001, 1),
(66, '2020-06-23 16:40:10', '01.00011', '', 'pembelian emas ', 10400000, 12.043, 1),
(68, '2020-06-25 10:10:15', '01.00063', '', 'pembelian emas ', 2000000, 2.308, 1),
(69, '2020-06-27 00:13:23', '01.00003', '', 'pembelian emas ', 46216, 0.053, 1),
(70, '2020-06-29 09:10:48', '01.00065', '', 'pembelian emas ', 60943610, 70, 1),
(71, '2020-06-29 09:13:55', '01.00027', '', 'pembelian emas ', 60943610, 70, 1),
(72, '2020-07-02 04:04:37', '01.00028', '', 'pembelian emas ', 6300000, 7.04, 0),
(73, '2020-07-02 04:09:55', '01.00028', '', 'pembelian emas ', 8950000, 10.002, 0);

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
('01.00002', '01.00001', '01.00001', 1, '11', 2, '0000-00-00'),
('01.00003', '01.00002', '01.00002', 26, '111', 3, '0000-00-00'),
('01.00004', '01.00003', '01.00003', 5, '1111', 4, '0000-00-00'),
('01.00005', '01.00004', '01.00004', 1, '11111', 5, '0000-00-00'),
('01.00006', '01.00005', '01.00005', 4, '111111', 6, '0000-00-00'),
('01.00007', '01.00003', '01.00003', 1, '1112', 4, '0000-00-00'),
('01.00008', '01.00007', '01.00007', 0, '11121', 5, '0000-00-00'),
('01.00009', '01.00003', '01.00003', 3, '1113', 4, '0000-00-00'),
('01.00010', '01.00003', '01.00003', 5, '1114', 4, '0000-00-00'),
('01.00011', '01.00003', '01.00003', 1, '1115', 4, '0000-00-00'),
('01.00012', '01.00011', '01.00011', 0, '11151', 5, '0000-00-00'),
('01.00013', '01.00003', '01.00003', 0, '1116', 4, '0000-00-00'),
('01.00014', '01.00003', '01.00003', 0, '1117', 4, '0000-00-00'),
('01.00015', '01.00001', '01.00001', 0, '12', 2, '0000-00-00'),
('01.00016', '01.00003', '01.00003', 5, '1118', 4, '0000-00-00'),
('01.00017', '01.00004', '01.00004', 0, '11112', 5, '0000-00-00'),
('01.00018', '01.00003', '01.00003', 0, '1119', 4, '0000-00-00'),
('01.00019', '01.00006', '01.00006', 0, '1111111', 7, '0000-00-00'),
('01.00020', '01.00006', '01.00006', 0, '1111112', 7, '0000-00-00'),
('01.00021', '01.00006', '01.00006', 0, '1111113', 7, '0000-00-00'),
('01.00022', '01.00006', '01.00006', 0, '1111114', 7, '0000-00-00'),
('01.00023', '01.00001', '01.00001', 0, '13', 2, '0000-00-00'),
('01.00024', '01.00016', '01.00016', 0, '11181', 5, '0000-00-00'),
('01.00025', '01.00010', '01.00010', 0, '11141', 5, '0000-00-00'),
('01.00026', '01.00016', '01.00016', 3, '11182', 5, '0000-00-00'),
('01.00027', '01.00010', '01.00010', 2, '11142', 5, '0000-00-00'),
('01.00028', '01.00010', '01.00010', 0, '11143', 5, '0000-00-00'),
('01.00029', '01.00003', '01.00003', 0, '11110', 4, '0000-00-00'),
('01.00030', '01.00016', '01.00016', 0, '11183', 5, '0000-00-00'),
('01.00031', '01.00003', '01.00003', 0, '11111', 4, '0000-00-00'),
('01.00032', '01.00016', '01.00016', 0, '11184', 5, '0000-00-00'),
('01.00033', '01.00003', '01.00003', 0, '11112', 4, '0000-00-00'),
('01.00034', '01.00026', '01.00026', 1, '111821', 6, '0000-00-00'),
('01.00035', '01.00003', '01.00003', 0, '11113', 4, '0000-00-00'),
('01.00036', '01.00026', '01.00026', 1, '111822', 6, '0000-00-00'),
('01.00037', '01.00026', '01.00026', 0, '111823', 6, '0000-00-00'),
('01.00038', '01.00034', '01.00034', 0, '1118211', 7, '0000-00-00'),
('01.00039', '01.00036', '01.00036', 0, '1118221', 7, '0000-00-00'),
('01.00040', '01.00003', '01.00003', 0, '11114', 4, '0000-00-00'),
('01.00041', '01.00003', '01.00003', 0, '11115', 4, '0000-00-00'),
('01.00042', '01.00003', '01.00003', 0, '11116', 4, '0000-00-00'),
('01.00043', '01.00003', '01.00003', 0, '11117', 4, '0000-00-00'),
('01.00044', '01.00003', '01.00003', 0, '11118', 4, '0000-00-00'),
('01.00045', '01.00003', '01.00003', 0, '11119', 4, '0000-00-00'),
('01.00046', '01.00003', '01.00003', 0, '11120', 4, '0000-00-00'),
('01.00047', '01.00003', '01.00003', 0, '11121', 4, '0000-00-00'),
('01.00048', '01.00003', '01.00003', 0, '11122', 4, '0000-00-00'),
('01.00049', '01.00016', '01.00016', 0, '11185', 5, '0000-00-00'),
('01.00050', '01.00003', '01.00003', 0, '11123', 4, '0000-00-00'),
('01.00051', '01.00010', '01.00010', 0, '11144', 5, '0000-00-00'),
('01.00052', '01.00003', '01.00003', 0, '11124', 4, '0000-00-00'),
('01.00053', '01.00010', '01.00010', 0, '11145', 5, '0000-00-00'),
('01.00054', '01.00003', '01.00003', 1, '11125', 4, '0000-00-00'),
('01.00055', '01.00054', '01.00054', 1, '111251', 5, '0000-00-00'),
('01.00056', '01.00009', '01.00009', 0, '11131', 5, '0000-00-00'),
('01.00057', '01.00009', '01.00009', 0, '11132', 5, '0000-00-00'),
('01.00058', '01.00004', '01.00004', 0, '11113', 5, '0000-00-00'),
('01.00059', '01.00004', '01.00004', 0, '11114', 5, '0000-00-00'),
('01.00060', '01.00055', '01.00055', 0, '1112511', 6, '0000-00-00'),
('01.00061', '01.00004', '01.00004', 0, '11115', 5, '0000-00-00'),
('01.00062', '01.00027', '01.00027', 0, '111421', 6, '0000-00-00'),
('01.00063', '01.00009', '01.00009', 0, '11133', 5, '0000-00-00'),
('01.00064', '01.00003', '01.00003', 0, '11126', 4, '0000-00-00'),
('01.00065', '01.00027', '01.00027', 0, '111422', 6, '0000-00-00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_titipan_emas`
--

CREATE TABLE `tb_titipan_emas` (
  `idx` bigint(30) NOT NULL,
  `idted` varchar(8) NOT NULL,
  `tgl_ikut` date NOT NULL,
  `tgl_berakhir` date NOT NULL,
  `tenor` int(11) NOT NULL,
  `gram` float NOT NULL,
  `harga_ikut` int(11) NOT NULL,
  `jml_uang` int(11) NOT NULL,
  `status` enum('pending','aktif','berhenti') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_titipan_emas`
--

INSERT INTO `tb_titipan_emas` (`idx`, `idted`, `tgl_ikut`, `tgl_berakhir`, `tenor`, `gram`, `harga_ikut`, `jml_uang`, `status`) VALUES
(1, '01.00051', '2020-04-02', '2020-09-02', 6, 6, 878695, 5272170, 'aktif'),
(2, '01.00042', '2020-04-09', '2020-09-09', 6, 2, 893325, 1786650, 'aktif'),
(3, '01.00052', '2020-04-10', '2020-09-10', 6, 2, 893325, 1786650, 'aktif'),
(4, '01.00011', '2020-04-26', '2020-09-26', 6, 2, 913460, 1826920, 'aktif'),
(5, '01.00053', '2020-05-09', '2020-10-09', 6, 2, 898830, 1797660, 'aktif'),
(6, '01.00053', '2020-05-17', '2020-10-17', 6, 4, 877686, 3510744, 'aktif'),
(7, '01.00025', '2020-05-27', '2020-10-27', 6, 10, 889794, 8897940, 'aktif'),
(8, '01.00003', '2020-05-27', '2020-10-27', 6, 2, 889794, 1779588, 'aktif'),
(9, '01.00003', '2020-05-27', '2020-10-27', 6, 2, 889794, 1779588, 'aktif'),
(10, '01.00001', '2020-06-01', '2021-06-01', 12, 4, 889794, 3559176, 'aktif'),
(11, '01.00009', '2020-06-09', '2020-12-09', 6, 2, 829758, 1659516, 'aktif'),
(12, '01.00027', '2020-06-20', '2020-12-20', 6, 12, 850947, 10211364, 'aktif'),
(13, '01.00062', '2020-06-20', '2020-12-20', 6, 2, 850947, 1701894, 'aktif'),
(14, '01.00023', '2020-06-20', '2020-12-20', 6, 2, 850947, 1701894, 'aktif'),
(15, '01.00011', '2020-06-23', '2020-12-23', 6, 12, 850947, 10211364, 'aktif'),
(16, '01.00063', '2020-06-25', '2020-12-25', 6, 2, 866587, 1733174, 'aktif'),
(17, '01.00065', '2020-06-29', '2020-12-29', 6, 70, 870623, 60943610, 'aktif'),
(18, '01.00027', '2020-06-29', '2020-12-29', 6, 70, 870623, 60943610, 'aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_titipan_emas_detail`
--

CREATE TABLE `tb_titipan_emas_detail` (
  `idx` int(11) NOT NULL,
  `id_titipan` int(11) NOT NULL,
  `periode` date NOT NULL,
  `profit_persen` double NOT NULL,
  `profit_uang` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_titipan_emas_detail`
--

INSERT INTO `tb_titipan_emas_detail` (`idx`, `id_titipan`, `periode`, `profit_persen`, `profit_uang`) VALUES
(1, 1, '2020-06-27', 14.15, 0),
(2, 2, '2020-06-27', 12.35, 0),
(3, 3, '2020-06-27', 11.35, 0),
(4, 4, '2020-06-27', 8.85, 0),
(5, 5, '2020-06-27', 7.35, 0),
(6, 6, '2020-06-27', 5.2, 0),
(7, 7, '2020-06-27', 4.2, 0),
(8, 8, '2020-06-27', 3.2, 0),
(9, 9, '2020-06-27', 3.2, 0),
(10, 10, '2020-06-27', 3.2, 0),
(11, 11, '2020-06-27', 2.2, 0),
(12, 1, '2020-06-27', 0.75, 0),
(13, 2, '2020-06-27', 0.75, 0),
(14, 3, '2020-06-27', 0.75, 0),
(15, 4, '2020-06-27', 0.75, 0),
(16, 5, '2020-06-27', 0.75, 0),
(17, 6, '2020-06-27', 0.75, 0),
(18, 7, '2020-06-27', 0.75, 0),
(19, 8, '2020-06-27', 0.75, 0),
(20, 9, '2020-06-27', 0.75, 0),
(21, 10, '2020-06-27', 0.75, 0),
(22, 11, '2020-06-27', 0.75, 0),
(23, 12, '2020-06-27', 0.75, 0),
(24, 13, '2020-06-27', 0.75, 0),
(25, 14, '2020-06-27', 0.75, 0),
(26, 15, '2020-06-27', 0.75, 0),
(27, 16, '2020-06-27', 0.75, 0);

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
(2, '2019-11-09', '01.00014', 'simp. pokok & simp. wajib', 1, 0, 1, 'emas'),
(3, '2019-11-11', '01.00015', 'simp. pokok & simp. wajib', 1, 0, 1, 'emas'),
(4, '2019-11-11', '01.00015', 'beli emas', 6.966, 0, 7.966, 'emas'),
(5, '2019-11-12', '01.00015', 'pencairan jual emas', 1282000, 0, 1282000, 'uang'),
(6, '2019-11-12', '01.00015', 'jual emas', 0, 2, 5.966, 'emas'),
(7, '2019-11-13', '01.00003', 'beli emas', 0.014, 0, 0.014, 'emas'),
(8, '2019-11-13', '01.00016', 'simp. pokok & simp. wajib', 1.035, 0, 1.035, 'emas'),
(9, '2019-11-14', '01.00017', 'simp. pokok & simp. wajib', 1.136, 0, 1.136, 'emas'),
(10, '2019-11-14', '01.00003', 'beli emas', 0.815, 0, 0.829, 'emas'),
(11, '2019-11-13', '01.00003', 'beli emas', 0.013, 0, 0.842, 'emas'),
(12, '2019-11-12', '01.00001', 'beli emas', 0.014, 0, 0.014, 'emas'),
(13, '2019-11-14', '01.00003', 'pencairan jual emas', 330000, 0, 330000, 'uang'),
(14, '2019-11-14', '01.00003', 'jual emas', 0, 0.5, 0.342, 'emas'),
(15, '2019-11-16', '01.00003', 'bayar beli emas 0.144 gr', 0, 100000, 230000, 'uang'),
(16, '2019-11-16', '01.00003', 'beli emas', 0.144, 0, 0.486, 'emas'),
(17, '2019-11-16', '01.00018', 'simp. pokok & simp. wajib', 1.136, 0, 1.136, 'emas'),
(18, '2019-11-19', '01.00003', 'bayar beli emas 0.144 gr', 0, 100000, 130000, 'uang'),
(19, '2019-11-19', '01.00003', 'beli emas', 0.144, 0, 0.63, 'emas'),
(20, '2019-11-19', '01.00019', 'simp. pokok & simp. wajib', 1.138, 0, 1.138, 'emas'),
(21, '2019-11-19', '01.00020', 'simp. pokok & simp. wajib', 1.138, 0, 1.138, 'emas'),
(22, '2019-11-19', '01.00021', 'simp. pokok & simp. wajib', 1.138, 0, 1.138, 'emas'),
(23, '2019-11-19', '01.00022', 'simp. pokok & simp. wajib', 1.138, 0, 1.138, 'emas'),
(24, '2019-11-05', '01.00006', 'simp. pokok & simp. wajib', 1.118, 0, 1.118, 'emas'),
(25, '2019-11-05', '01.00005', 'simp. pokok & simp. wajib', 1.118, 0, 1.118, 'emas'),
(26, '2019-11-20', '01.00010', 'beli emas', 1.136, 0, 1.136, 'emas'),
(27, '2019-11-20', '01.00003', 'bayar beli emas 0.187 gr', 0, 130000, 0, 'uang'),
(28, '2019-11-20', '01.00003', 'beli emas', 0.187, 0, 0.817, 'emas'),
(29, '2019-11-20', '01.00003', 'pencairan jual emas', 329750, 0, 329750, 'uang'),
(30, '2019-11-20', '01.00003', 'jual emas', 0, 0.5, 0.317, 'emas'),
(31, '2019-11-21', '01.00009', 'beli emas', 1.137, 0, 1.137, 'emas'),
(32, '2019-11-22', '01.00003', 'beli emas', 100.638, 0, 100.955, 'emas'),
(33, '2019-11-27', '01.00011', 'beli emas', 1.112, 0, 1.112, 'emas'),
(34, '2019-12-05', '01.00023', 'simp. pokok & simp. wajib', 0.03, 0, 0.03, 'emas'),
(35, '2019-12-05', '01.00024', 'simp. pokok & simp. wajib', 0.03, 0, 0.03, 'emas'),
(36, '2019-12-05', '01.00025', 'simp. pokok & simp. wajib', 0.03, 0, 0.03, 'emas'),
(37, '2019-12-06', '01.00026', 'simp. pokok & simp. wajib', 0.03, 0, 0.03, 'emas'),
(38, '2019-12-08', '01.00027', 'simp. pokok & simp. wajib', 0.03, 0, 0.03, 'emas'),
(39, '2019-12-08', '01.00028', 'simp. pokok & simp. wajib', 0.03, 0, 0.03, 'emas'),
(40, '2019-12-08', '01.00028', 'beli emas', 3.01, 0, 3.04, 'emas'),
(41, '2019-12-08', '01.00028', 'pencairan jual emas', 654.5, 0, 654.5, 'uang'),
(42, '2019-12-08', '01.00028', 'jual emas', 0, 0.001, 3.039, 'emas'),
(43, '2019-12-08', '01.00028', 'bayar beli emas 0.001 gr', 0, 654, 0.5, 'uang'),
(44, '2019-12-08', '01.00028', 'beli emas', 0.001, 0, 3.04, 'emas'),
(45, '2019-12-09', '01.00029', 'simp. pokok & simp. wajib', 0.03, 0, 0.03, 'emas'),
(46, '2019-12-16', '01.00030', 'simp. pokok & simp. wajib', 0.03, 0, 0.03, 'emas'),
(47, '2019-12-18', '01.00003', 'pencairan jual emas', 6580, 0, 336330, 'uang'),
(48, '2019-12-18', '01.00003', 'jual emas', 0, 0.01, 100.945, 'emas'),
(49, '2019-12-19', '01.00003', 'pencairan jual emas', 5926.5, 0, 342256, 'uang'),
(50, '2019-12-19', '01.00003', 'jual emas', 0, 0.009, 100.936, 'emas'),
(51, '2019-12-19', '01.00031', 'simp. pokok & simp. wajib', 0.03, 0, 0.03, 'emas'),
(52, '2019-12-20', '01.00010', 'beli emas', 1.107, 0, 2.243, 'emas'),
(53, '2019-12-20', '01.00010', 'pencairan jual emas', 6590, 0, 6590, 'uang'),
(54, '2019-12-20', '01.00010', 'jual emas', 0, 0.01, 2.233, 'emas'),
(55, '2019-12-24', '01.00032', 'simp. pokok & simp. wajib', 0.03, 0, 0.03, 'emas'),
(56, '2019-12-24', '01.00032', 'beli emas', 0.719, 0, 0.749, 'emas'),
(57, '2019-12-24', '01.00009', 'beli emas', 1.107, 0, 2.244, 'emas'),
(58, '2019-12-24', '01.00009', 'pencairan jual emas', 659, 0, 659, 'uang'),
(59, '2019-12-24', '01.00009', 'jual emas', 0, 0.001, 2.243, 'emas'),
(60, '2019-12-24', '01.00009', 'bayar beli emas 0.001 gr', 0, 659, 0, 'uang'),
(61, '2019-12-24', '01.00009', 'beli emas', 0.001, 0, 2.244, 'emas'),
(62, '2019-12-24', '01.00003', 'bayar beli emas 0.014 gr', 0, 10000, 332256, 'uang'),
(63, '2019-12-24', '01.00003', 'beli emas', 0.014, 0, 100.95, 'emas'),
(64, '2019-12-25', '01.00033', 'simp. pokok & simp. wajib', 0.03, 0, 0.03, 'emas'),
(65, '2019-12-25', '01.00033', 'beli emas', 0.014, 0, 0.044, 'emas'),
(66, '2019-12-25', '01.00033', 'pencairan jual emas', 659, 0, 659, 'uang'),
(67, '2019-12-25', '01.00033', 'jual emas', 0, 0.001, 0.043, 'emas'),
(68, '2020-01-03', '01.00003', 'bayar beli emas 0.014 gr', 0, 10000, 322256, 'uang'),
(69, '2020-01-03', '01.00003', 'beli emas', 0.014, 0, 100.964, 'emas'),
(70, '2020-01-03', '01.00003', 'pencairan jual emas', 0, 0, 322256, 'uang'),
(71, '2020-01-03', '01.00003', 'jual emas', 0, 0, 100.964, 'emas'),
(72, '2020-01-03', '01.00016', 'trf. dari ID 01.00003 ', 0.001, 0, 1.036, 'emas'),
(73, '2020-01-03', '01.00003', 'transfer emas ke  01.00016', 0, 0.001, 100.963, 'emas'),
(74, '2020-01-03', '01.00016', 'trf. dari ID 01.00003 ', 0.001, 0, 1.037, 'emas'),
(75, '2020-01-03', '01.00003', 'transfer emas ke  01.00016', 0, 0.001, 100.962, 'emas'),
(76, '2020-01-06', '01.00034', 'simp. pokok & simp. wajib', 0.029, 0, 0.029, 'emas'),
(77, '2020-01-07', '01.00029', 'trf. dari ID 01.00003 ', 0.138, 0, 0.168, 'emas'),
(78, '2020-01-07', '01.00003', 'transfer emas ke  01.00029', 0, 0.138, 100.824, 'emas'),
(79, '2020-01-08', '01.00035', 'simp. pokok & simp. wajib', 0.028, 0, 0.028, 'emas'),
(80, '2020-01-08', '01.00036', 'simp. pokok & simp. wajib', 0.028, 0, 0.028, 'emas'),
(81, '2020-01-08', '01.00034', 'trf. dari ID 01.00003 ', 0.001, 0, 0.03, 'emas'),
(82, '2020-01-08', '01.00003', 'transfer emas ke  01.00034', 0, 0.001, 100.823, 'emas'),
(83, '2020-01-08', '01.00037', 'simp. pokok & simp. wajib', 0.028, 0, 0.028, 'emas'),
(84, '2020-01-08', '01.00038', 'simp. pokok & simp. wajib', 0.028, 0, 0.028, 'emas'),
(85, '2020-01-16', '01.00039', 'simp. pokok & simp. wajib', 0.03, 0, 0.03, 'emas'),
(86, '2020-01-16', '01.00036', 'trf. dari ID 01.00003 ', 0.002, 0, 0.03, 'emas'),
(87, '2020-01-16', '01.00003', 'transfer emas ke  01.00036', 0, 0.002, 100.821, 'emas'),
(88, '2020-01-16', '01.00036', 'pencairan jual emas', 675, 0, 675, 'uang'),
(89, '2020-01-16', '01.00036', 'jual emas', 0, 0.001, 0.029, 'emas'),
(90, '2020-01-27', '01.00016', 'pencairan jual emas', 0, 0, 0, 'uang'),
(91, '2020-01-27', '01.00016', 'jual emas', 0, 0, 1.037, 'emas'),
(92, '2020-01-27', '01.00040', 'simp. pokok & simp. wajib', 0.029, 0, 0.029, 'emas'),
(93, '2020-01-30', '01.00003', 'pencairan jual emas', 6830, 0, 329086, 'uang'),
(94, '2020-01-30', '01.00003', 'jual emas', 0, 0.01, 100.811, 'emas'),
(95, '2020-01-30', '01.00031', 'trf. dari ID 01.00003 ', 0.014, 0, 0.044, 'emas'),
(96, '2020-01-30', '01.00003', 'transfer emas ke  01.00031', 0, 0.014, 100.797, 'emas'),
(97, '2020-02-08', '01.00041', 'simp. pokok & simp. wajib', 0.029, 0, 0.029, 'emas'),
(98, '2020-02-08', '01.00007', 'trf. dari ID 01.00003 ', 0.07, 0, 0.07, 'emas'),
(99, '2020-02-08', '01.00003', 'transfer emas ke  01.00007', 0, 0.07, 100.727, 'emas'),
(100, '2020-02-08', '01.00024', 'beli emas', 0.975, 0, 1.005, 'emas'),
(101, '2020-02-09', '01.00007', 'trf. dari ID 01.00003 ', 0.139, 0, 0.209, 'emas'),
(102, '2020-02-09', '01.00003', 'transfer emas ke  01.00007', 0, 0.139, 100.588, 'emas'),
(103, '2020-02-09', '01.00042', 'simp. pokok & simp. wajib', 0.029, 0, 0.029, 'emas'),
(104, '2020-02-14', '01.00001', 'trf. dari ID 01.00003 ', 90, 0, 90.014, 'emas'),
(105, '2020-02-14', '01.00003', 'transfer emas ke  01.00001', 0, 90, 10.588, 'emas'),
(106, '2020-02-14', '01.00009', 'trf. dari ID 01.00001 ', 0.035, 0, 2.279, 'emas'),
(107, '2020-02-14', '01.00001', 'transfer emas ke  01.00009', 0, 0.035, 89.979, 'emas'),
(108, '2020-02-14', '01.00010', 'trf. dari ID 01.00001 ', 0.035, 0, 2.268, 'emas'),
(109, '2020-02-14', '01.00001', 'transfer emas ke  01.00010', 0, 0.035, 89.944, 'emas'),
(110, '2020-02-14', '01.00016', 'trf. dari ID 01.00001 ', 0.035, 0, 1.072, 'emas'),
(111, '2020-02-14', '01.00001', 'transfer emas ke  01.00016', 0, 0.035, 89.909, 'emas'),
(112, '2020-02-14', '01.00017', 'trf. dari ID 01.00001 ', 0.035, 0, 1.171, 'emas'),
(113, '2020-02-14', '01.00001', 'transfer emas ke  01.00017', 0, 0.035, 89.874, 'emas'),
(114, '2020-02-14', '01.00042', 'trf. dari ID 01.00001 ', 0.035, 0, 0.064, 'emas'),
(115, '2020-02-14', '01.00001', 'transfer emas ke  01.00042', 0, 0.035, 89.839, 'emas'),
(116, '2020-02-14', '01.00016', 'pencairan jual emas', 0, 0, 0, 'uang'),
(117, '2020-02-14', '01.00016', 'jual emas', 0, 0, 1.072, 'emas'),
(118, '2020-02-20', '01.00043', 'simp. pokok & simp. wajib', 0.028, 0, 0.028, 'emas'),
(119, '2020-02-21', '01.00044', 'simp. pokok & simp. wajib', 0.028, 0, 0.028, 'emas'),
(120, '2020-02-25', '01.00045', 'simp. pokok & simp. wajib', 0.027, 0, 0.027, 'emas'),
(121, '2020-02-26', '01.00046', 'simp. pokok & simp. wajib', 0.027, 0, 0.027, 'emas'),
(122, '2020-02-26', '01.00047', 'simp. pokok & simp. wajib', 0.027, 0, 0.027, 'emas'),
(123, '2020-02-20', '01.00043', 'beli emas', 0.068, 0, 0.096, 'emas'),
(124, '2020-03-02', '01.00048', 'simp. pokok & simp. wajib', 0.027, 0, 0.027, 'emas'),
(125, '2020-03-02', '01.00048', 'trf. dari ID 01.00003 ', 0.013, 0, 0.04, 'emas'),
(126, '2020-03-02', '01.00003', 'transfer emas ke  01.00048', 0, 0.013, 10.575, 'emas'),
(127, '2020-03-02', '01.00049', 'simp. pokok & simp. wajib', 0.027, 0, 0.027, 'emas'),
(128, '2020-03-02', '01.00032', 'trf. dari ID 01.00001 ', 0.033, 0, 0.782, 'emas'),
(129, '2020-03-02', '01.00001', 'transfer emas ke  01.00032', 0, 0.033, 89.806, 'emas'),
(130, '2020-03-02', '01.00034', 'trf. dari ID 01.00001 ', 0.033, 0, 0.063, 'emas'),
(131, '2020-03-02', '01.00001', 'transfer emas ke  01.00034', 0, 0.033, 89.773, 'emas'),
(132, '2020-03-20', '01.00007', 'trf. dari ID 01.00001 ', 0.025, 0, 0.234, 'emas'),
(133, '2020-03-20', '01.00001', 'transfer emas ke  01.00007', 0, 0.025, 89.748, 'emas'),
(134, '2020-03-20', '01.00007', 'trf. dari ID 01.00001 ', 0.025, 0, 0.259, 'emas'),
(135, '2020-03-20', '01.00001', 'transfer emas ke  01.00007', 0, 0.025, 89.723, 'emas'),
(136, '2020-03-21', '01.00050', 'simp. pokok & simp. wajib', 0.026, 0, 0.026, 'emas'),
(137, '2020-03-25', '01.00051', 'simp. pokok & simp. wajib', 0.022, 0, 0.022, 'emas'),
(138, '2020-03-28', '01.00003', 'bayar beli emas 0.001 gr', 0, 1000, 328086, 'uang'),
(139, '2020-03-28', '01.00003', 'beli emas', 0.001, 0, 10.576, 'emas'),
(140, '2020-04-07', '01.00033', 'beli emas', 2.214, 0, 2.257, 'emas'),
(141, '2020-04-10', '01.00052', 'simp. pokok & simp. wajib', 0.024, 0, 0.024, 'emas'),
(142, '2020-04-10', '01.00052', 'beli emas', 2.015, 0, 2.039, 'emas'),
(143, '2020-04-15', '01.00007', 'pencairan jual emas', 158760, 0, 158760, 'uang'),
(144, '2020-04-15', '01.00007', 'jual emas', 0, 0.189, 0.07, 'emas'),
(145, '2020-04-15', '01.00007', 'pencairan jual emas', 158760, 0, 317520, 'uang'),
(146, '2020-04-15', '01.00007', 'jual emas', 0, 0.189, 0.07, 'emas'),
(147, '2020-04-15', '01.00007', 'tarik wallet, trf. tgl 2020-04-16', 0, 290000, 27520, 'uang'),
(148, '2020-04-15', '01.00007', 'adm tarik wallet, trf. tgl 2020-04-16', 0, 10000, 27520, 'uang'),
(149, '2020-04-16', '01.00003', 'tarik wallet, trf. tgl 2020-04-16', 0, 10000, 318086, 'uang'),
(150, '2020-04-16', '01.00003', 'adm tarik wallet, trf. tgl 2020-04-16', 0, 10000, 318086, 'uang'),
(151, '2020-04-30', '01.00001', 'trf. dari ID 01.00003 ', 9.576, 0, 99.299, 'emas'),
(152, '2020-04-30', '01.00003', 'transfer emas ke  01.00001', 0, 9.576, 1, 'emas'),
(153, '2020-05-01', '01.00053', 'simp. pokok & simp. wajib', 0.023, 0, 0.023, 'emas'),
(154, '2020-05-31', '01.00054', 'simp. pokok & simp. wajib', 0.024, 0, 0.024, 'emas'),
(155, '2020-06-01', '01.00003', 'bayar beli emas 0.000 gr', 0, 0.1, 318086, 'uang'),
(156, '2020-06-01', '01.00003', 'beli emas', 0, 0, 1, 'emas'),
(157, '2020-06-01', '01.00003', 'bayar beli emas 0.011 gr', 0, 10000, 308086, 'uang'),
(158, '2020-06-01', '01.00003', 'beli emas', 0.011, 0, 1.011, 'emas'),
(159, '2020-06-01', '01.00003', 'pencairan jual emas', 8130, 0, 316216, 'uang'),
(160, '2020-06-01', '01.00003', 'jual emas', 0, 0.01, 1.001, 'emas'),
(161, '2020-06-02', '01.00025', 'deposit', 88979, 0, 88979, 'uang'),
(162, '2020-06-02', '01.00055', 'simp. pokok & simp. wajib', 0.024, 0, 0.024, 'emas'),
(163, '2020-06-02', '01.00056', 'simp. pokok & simp. wajib', 0.024, 0, 0.024, 'emas'),
(164, '2020-06-02', '01.00057', 'simp. pokok & simp. wajib', 0.024, 0, 0.024, 'emas'),
(165, '2020-06-04', '01.00003', 'koreksi, batal deposit', 0, 250000, 66216, 'uang'),
(166, '2020-06-04', '01.00003', 'koreksi, batal deposit', 0, 20000, 46216, 'uang'),
(167, '2020-06-04', '01.00053', 'koreksi, batal deposit', 0, 144818, -144818, 'uang'),
(168, '2020-06-06', '01.00043', 'beli emas', 0.118, 0, 0.214, 'emas'),
(169, '2020-06-08', '01.00058', 'simp. pokok & simp. wajib', 0.025, 0, 0.025, 'emas'),
(170, '2020-06-08', '01.00059', 'simp. pokok & simp. wajib', 0.025, 0, 0.025, 'emas'),
(171, '2020-06-09', '01.00060', 'simp. pokok & simp. wajib', 0.025, 0, 0.025, 'emas'),
(172, '2020-06-12', '01.00053', 'deposit', 144818, 0, 0, 'uang'),
(173, '2020-06-13', '01.00042', 'deposit', 141642, 0, 141642, 'uang'),
(174, '2020-06-13', '01.00042', 'bayar beli emas 0.058 gr', 0, 50000, 91642, 'uang'),
(175, '2020-06-13', '01.00042', 'beli emas', 0.058, 0, 0.122, 'emas'),
(176, '2020-06-16', '01.00061', 'simp. pokok & simp. wajib', 0.025, 0, 0.025, 'emas'),
(177, '2020-06-16', '01.00025', 'deposit', 177959, 0, 266938, 'uang'),
(178, '2020-06-20', '01.00062', 'simp. pokok & simp. wajib', 0.025, 0, 0.025, 'emas'),
(179, '2020-06-23', '01.00015', 'ikut titipan emas ', 0, 4, 1.966, 'emas'),
(180, '2020-06-24', '01.00051', 'beli emas', 6.948, 0, 6.97, 'emas'),
(181, '2020-06-23', '01.00051', 'ikut titipan emas ', 0, 6, 0.97, 'emas'),
(182, '2020-06-24', '01.00042', 'beli emas', 1.793, 0, 1.915, 'emas'),
(183, '2020-06-24', '01.00042', 'beli emas', 0.174, 0, 2.089, 'emas'),
(184, '2020-06-23', '01.00042', 'ikut titipan emas ', 0, 2, 0.089, 'emas'),
(185, '2020-06-23', '01.00052', 'ikut titipan emas ', 0, 2, 0.039, 'emas'),
(186, '2020-06-24', '01.00011', 'beli emas', 1.001, 0, 2.113, 'emas'),
(187, '2020-06-24', '01.00011', 'beli emas', 1.001, 0, 3.114, 'emas'),
(188, '2020-06-23', '01.00011', 'ikut titipan emas ', 0, 2, 1.114, 'emas'),
(189, '2020-06-24', '01.00053', 'beli emas', 6.022, 0, 6.045, 'emas'),
(190, '2020-06-23', '01.00053', 'ikut titipan emas ', 0, 6, 0.045, 'emas'),
(191, '2020-06-24', '01.00025', 'beli emas', 10.005, 0, 10.035, 'emas'),
(192, '2020-06-23', '01.00025', 'ikut titipan emas ', 0, 10, 0.035, 'emas'),
(193, '2020-06-24', '01.00003', 'beli emas', 1.158, 0, 2.159, 'emas'),
(194, '2020-06-23', '01.00003', 'ikut titipan emas ', 0, 2, 0.159, 'emas'),
(195, '2020-06-24', '01.00003', 'beli emas', 2.001, 0, 2.16, 'emas'),
(196, '2020-06-23', '01.00003', 'ikut titipan emas ', 0, 2, 0.16, 'emas'),
(197, '2020-06-23', '01.00001', 'ikut titipan emas ', 0, 4, 95.299, 'emas'),
(198, '2020-06-24', '01.00009', 'beli emas', 1.158, 0, 3.437, 'emas'),
(199, '2020-06-23', '01.00009', 'ikut titipan emas ', 0, 2, 1.437, 'emas'),
(200, '2020-06-24', '01.00027', 'beli emas', 12.043, 0, 12.073, 'emas'),
(201, '2020-06-23', '01.00027', 'ikut titipan emas ', 0, 12, 0.073, 'emas'),
(202, '2020-06-24', '01.00062', 'beli emas', 2.001, 0, 2.026, 'emas'),
(203, '2020-06-23', '01.00062', 'ikut titipan emas ', 0, 2, 0.026, 'emas'),
(204, '2020-06-24', '01.00023', 'beli emas', 2.001, 0, 2.031, 'emas'),
(205, '2020-06-23', '01.00023', 'ikut titipan emas ', 0, 2, 0.031, 'emas'),
(206, '2020-06-24', '01.00011', 'beli emas', 12.043, 0, 13.157, 'emas'),
(207, '2020-06-23', '01.00011', 'ikut titipan emas ', 0, 12, 1.157, 'emas'),
(208, '2020-06-24', '01.00063', 'simp. pokok & simp. wajib', 0.024, 0, 0.024, 'emas'),
(209, '2020-06-25', '01.00064', 'simp. pokok & simp. wajib', 0.024, 0, 0.024, 'emas'),
(210, '2020-06-25', '01.00063', 'beli emas', 2.308, 0, 2.332, 'emas'),
(211, '2020-06-25', '01.00063', 'ikut titipan emas ', 0, 2, 0.332, 'emas'),
(212, '2020-06-27', '01.00003', 'bayar beli emas 0.053 gr', 0, 46216, 0, 'uang'),
(213, '2020-06-27', '01.00003', 'beli emas', 0.053, 0, 0.213, 'emas'),
(214, '2020-06-29', '01.00065', 'simp. pokok & simp. wajib', 0.024, 0, 0.024, 'emas'),
(215, '2020-06-29', '01.00065', 'beli emas', 70, 0, 70.024, 'emas'),
(216, '2020-06-29', '01.00065', 'ikut titipan emas ', 0, 70, 0.024, 'emas'),
(217, '2020-06-29', '01.00027', 'beli emas', 70, 0, 70.073, 'emas'),
(218, '2020-06-29', '01.00027', 'ikut titipan emas ', 0, 70, 0.073, 'emas');

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
-- Struktur dari tabel `tb_widraw`
--

CREATE TABLE `tb_widraw` (
  `idx` int(9) NOT NULL,
  `tgl_pengajuan` date NOT NULL,
  `idted` varchar(8) NOT NULL,
  `nominal` int(9) NOT NULL,
  `biaya_adm` int(7) NOT NULL,
  `bankagt` varchar(50) NOT NULL,
  `rekagt` varchar(50) NOT NULL,
  `anagt` varchar(100) NOT NULL,
  `status` int(2) NOT NULL,
  `tgl_cair` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_widraw`
--

INSERT INTO `tb_widraw` (`idx`, `tgl_pengajuan`, `idted`, `nominal`, `biaya_adm`, `bankagt`, `rekagt`, `anagt`, `status`, `tgl_cair`) VALUES
(1, '2020-01-03', '01.00015', 210000, 10000, 'Bank Toyib', '333 222 111', 'Juniar Arif Wicaksono', 1, '2020-04-16'),
(2, '2020-01-30', '01.00003', 10000, 10000, 'BRI', '303601041826532', 'susiloningsih', 1, '2020-04-16'),
(3, '2020-04-15', '01.00007', 300000, 10000, 'Bank Rakyat Indonesia BRI', '111001002375536', 'Dwi sunu raharjo', 1, '2020-04-16'),
(5, '2020-04-16', '01.00003', 20000, 10000, 'BRI', '303601041826532', 'susiloningsih', 1, '2020-04-16');

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
(6, '2019-07-25 23:30:02', '706,805', '630,500'),
(7, '2019-07-26 19:50:03', '707,309', '631,000'),
(8, '2019-07-28 19:50:01', '708,318', '632,000'),
(9, '2019-07-29 19:55:02', '709,327', '633,000'),
(10, '2019-07-30 20:00:03', '710,841', '634,500'),
(11, '2019-07-31 17:40:04', '710,841', '626,500'),
(12, '2019-07-31 17:45:03', '710,841', '626,000'),
(13, '2019-07-31 20:00:02', '707,814', '631,500'),
(14, '2019-08-01 19:40:01', '720,022', '643,500'),
(15, '2019-08-02 21:20:02', '721,940', '645,500'),
(16, '2019-08-04 19:40:01', '730,112', '653,600'),
(17, '2019-08-04 19:45:03', '730,112', '653,500'),
(18, '2019-08-05 19:30:02', '740,404', '663,500'),
(19, '2019-08-06 19:40:03', '747,871', '671,000'),
(20, '2019-08-06 19:45:02', '747,669', '665,000'),
(21, '2019-08-06 22:05:02', '748,174', '665,000'),
(22, '2019-08-07 19:35:03', '751,705', '665,000'),
(23, '2019-08-08 20:05:02', '753,723', '665,000'),
(24, '2019-08-09 17:25:02', '753,723', '635,000'),
(25, '2019-08-09 19:40:03', '750,192', '635,000'),
(26, '2019-08-09 21:00:03', '750,192', '660,000'),
(27, '2019-08-09 21:05:01', '750,192', '665,000'),
(28, '2019-08-11 19:40:03', '750,696', '674,000'),
(29, '2019-08-12 19:55:01', '762,300', '675,000'),
(30, '2019-08-12 20:05:05', '762,300', '680,000'),
(31, '2019-08-13 19:55:03', '757,759', '674,000'),
(32, '2019-08-14 19:40:01', '764,822', '682,000'),
(33, '2019-08-15 19:40:02', '763,309', '680,500'),
(34, '2019-08-18 19:20:02', '763,309', '675,000'),
(35, '2019-08-18 20:30:02', '759,273', '675,000'),
(36, '2019-08-19 20:50:02', '755,741', '673,000'),
(37, '2019-08-20 19:50:03', '757,255', '679,000'),
(38, '2019-08-22 00:00:06', '756,750', '678,500'),
(39, '2019-08-22 20:00:06', '754,732', '676,500'),
(40, '2019-08-23 20:00:04', '764,318', '687,500'),
(41, '2019-08-25 20:05:04', '772,490', '695,000'),
(42, '2019-08-26 20:00:07', '766,840', '690,000'),
(43, '2019-08-27 20:00:06', '770,876', '694,000'),
(44, '2019-08-28 20:00:06', '773,399', '696,000'),
(45, '2019-08-28 20:05:05', '773,499', '696,000'),
(46, '2019-08-28 20:10:05', '773,399', '696,000'),
(47, '2019-08-29 20:00:07', '767,345', '690,500'),
(48, '2019-08-30 20:00:05', '764,318', '687,500'),
(49, '2019-09-01 20:00:07', '765,831', '689,000'),
(50, '2019-09-02 20:00:07', '766,336', '689,500'),
(51, '2019-09-03 20:00:06', '773,499', '696,500'),
(52, '2019-09-04 20:10:04', '770,977', '694,000'),
(53, '2019-09-05 20:40:05', '761,291', '684,500'),
(54, '2019-09-06 20:00:06', '757,759', '681,000'),
(55, '2019-09-08 20:05:04', '758,264', '681,500'),
(56, '2019-09-09 20:00:04', '747,165', '670,500'),
(57, '2019-09-10 08:50:02', '', ''),
(58, '2019-09-10 08:55:03', '747,165', '670,500'),
(59, '2019-09-10 20:00:06', '749,183', '672,500'),
(60, '2019-09-11 20:15:05', '748,174', '671,500'),
(61, '2019-09-12 20:00:09', '746,660', '670,000'),
(62, '2019-09-13 20:00:06', '745,147', '668,500'),
(63, '2019-09-15 20:00:07', '749,687', '673,000'),
(64, '2019-09-16 20:00:06', '748,678', '672,000'),
(65, '2019-09-17 20:00:06', '748,174', '671,500'),
(66, '2019-09-18 20:00:05', '747,669', '671,000'),
(67, '2019-09-19 20:00:05', '749,183', '672,500'),
(68, '2019-09-20 20:00:05', '753,723', '677,000'),
(69, '2019-09-22 20:00:06', '754,228', '677,500'),
(70, '2019-09-23 20:00:05', '757,759', '681,000'),
(71, '2019-09-24 20:00:05', '762,300', '685,500'),
(72, '2019-09-25 20:00:05', '756,750', '680,000'),
(73, '2019-09-26 20:00:04', '756,246', '679,500'),
(74, '2019-09-27 20:00:05', '754,228', '677,500'),
(75, '2019-09-29 20:05:03', '752,714', '676,000'),
(76, '2019-09-30 20:00:08', '744,642', '668,000'),
(77, '2019-10-01 20:00:07', '747,165', '670,500'),
(78, '2019-10-02 20:00:04', '752,210', '675,500'),
(79, '2019-10-03 20:00:04', '753,723', '677,000'),
(80, '2019-10-04 20:00:04', '752,714', '676,000'),
(81, '2019-10-06 20:00:05', '754,228', '677,500'),
(82, '2019-10-07 20:00:05', '749,183', '672,500'),
(83, '2019-10-08 20:00:05', '753,723', '677,000'),
(84, '2019-10-09 20:00:05', '754,228', '677,500'),
(85, '2019-10-10 20:00:07', '750,696', '679,000'),
(86, '2019-10-11 00:45:03', '750,696', '674,000'),
(87, '2019-10-11 20:00:09', '750,192', '673,500'),
(88, '2019-10-13 20:00:07', '748,476', '671,800'),
(89, '2019-10-14 20:00:08', '750,696', '674,000'),
(90, '2019-10-15 20:00:06', '748,174', '671,500'),
(91, '2019-10-16 20:00:06', '749,183', '672,500'),
(92, '2019-10-17 20:00:05', '748,678', '672,000'),
(93, '2019-10-18 20:00:08', '749,183', '672,500'),
(94, '2019-10-20 20:00:06', '748,174', '671,500'),
(95, '2019-10-21 20:25:03', '744,138', '667,500'),
(96, '2019-10-23 20:00:03', '744,642', '668,000'),
(97, '2019-10-24 20:00:02', '747,669', '671,000'),
(98, '2019-10-25 20:00:04', '747,165', '670,500'),
(99, '2019-10-27 20:45:01', '746,660', '670,000'),
(100, '2019-10-28 20:00:03', '744,642', '668,000'),
(101, '2019-10-29 20:00:02', '743,633', '667,000'),
(102, '2019-10-30 20:00:03', '744,642', '668,000'),
(103, '2019-10-31 20:00:03', '750,192', '673,500'),
(104, '2019-11-01 20:00:03', '750,696', '674,000'),
(105, '2019-11-03 20:00:02', '749,687', '673,000'),
(106, '2019-11-04 20:05:02', '747,669', '671,000'),
(107, '2019-11-05 20:10:03', '742,624', '666,000'),
(108, '2019-11-06 20:00:03', '744,642', '668,000'),
(109, '2019-11-07 20:00:03', '735,561', '659,000'),
(110, '2019-11-10 20:05:03', '736,570', '660,000'),
(111, '2019-11-11 20:00:02', '734,552', '658,000'),
(112, '2019-11-12 20:25:02', '735,561', '659,000'),
(113, '2019-11-14 04:00:02', '736,570', '660,000'),
(114, '2019-11-15 04:00:03', '736,066', '659,500'),
(115, '2019-11-18 04:10:02', '735,561', '659,000'),
(116, '2019-11-19 04:00:02', '735,057', '658,500'),
(117, '2019-11-20 04:00:03', '736,066', '659,500'),
(118, '2019-11-21 04:00:04', '735,561', '659,000'),
(119, '2019-11-22 04:00:01', '735,057', '658,500'),
(120, '2019-11-23 04:00:03', '734,048', '657,500'),
(121, '2019-11-26 04:00:02', '731,021', '654,500'),
(122, '2019-11-26 04:40:03', '730,516', '654,000'),
(123, '2019-11-27 04:10:02', '732,736', '656,000'),
(124, '2019-11-28 04:05:03', '731,021', '654,500'),
(125, '2019-11-30 04:10:03', '732,030', '655,500'),
(126, '2019-12-02 04:00:03', '728,498', '652,000'),
(127, '2019-12-03 04:00:03', '732,030', '655,500'),
(128, '2019-12-04 04:00:03', '739,093', '662,500'),
(129, '2019-12-05 04:35:03', '736,066', '659,500'),
(130, '2019-12-06 04:05:02', '735,057', '658,500'),
(131, '2019-12-07 04:00:03', '731,021', '654,500'),
(132, '2019-12-09 04:00:02', '730,516', '654,000'),
(133, '2019-12-10 04:25:02', '731,021', '654,500'),
(134, '2019-12-11 04:10:03', '732,030', '655,500'),
(135, '2019-12-12 04:00:02', '735,057', '658,500'),
(136, '2019-12-13 04:00:02', '733,039', '656,500'),
(137, '2019-12-14 04:00:03', '735,057', '658,500'),
(138, '2019-12-16 04:00:03', '734,552', '658,000'),
(139, '2019-12-18 08:00:02', '734,048', '657,500'),
(140, '2019-12-19 04:00:04', '735,057', '658,500'),
(141, '2019-12-20 04:00:02', '735,561', '659,000'),
(142, '2019-12-26 04:00:02', '741,615', '665,000'),
(143, '2019-12-27 04:00:02', '745,651', '669,000'),
(144, '2019-12-28 04:00:04', '745,147', '668,500'),
(145, '2020-01-03 04:00:03', '754,732', '678,000'),
(146, '2020-01-04 04:10:03', '761,795', '685,000'),
(147, '2020-01-06 04:00:04', '774,912', '698,000'),
(148, '2020-01-07 04:00:05', '764,318', '687,500'),
(149, '2020-01-08 04:00:03', '777,435', '700,500'),
(150, '2020-01-09 04:00:02', '763,813', '687,000'),
(151, '2020-01-10 04:00:03', '760,786', '684,000'),
(152, '2020-01-10 08:00:03', '759,777', '683,000'),
(153, '2020-01-11 04:00:02', '762,300', '685,500'),
(154, '2020-01-13 04:00:03', '757,255', '680,500'),
(155, '2020-01-14 04:00:02', '749,183', '672,500'),
(156, '2020-01-15 04:00:04', '753,219', '676,500'),
(157, '2020-01-15 08:00:04', '753,723', '677,000'),
(158, '2020-01-16 04:00:04', '751,705', '675,000'),
(159, '2020-01-17 04:00:04', '750,696', '674,000'),
(160, '2020-01-18 04:00:04', '751,201', '674,500'),
(161, '2020-01-20 04:25:03', '751,705', '675,000'),
(162, '2020-01-21 04:00:02', '755,237', '678,500'),
(163, '2020-01-22 04:00:03', '750,696', '674,000'),
(164, '2020-01-23 04:00:02', '749,687', '673,000'),
(165, '2020-01-24 04:10:01', '751,201', '674,500'),
(166, '2020-01-27 04:00:04', '758,264', '681,500'),
(167, '2020-01-28 04:00:03', '760,282', '683,500'),
(168, '2020-01-29 04:00:04', '753,723', '677,000'),
(169, '2020-01-30 04:10:03', '759,777', '683,000'),
(170, '2020-01-31 04:00:04', '758,264', '681,500'),
(171, '2020-02-01 04:00:03', '765,327', '688,500'),
(172, '2020-02-03 04:00:03', '765,831', '689,000'),
(173, '2020-02-04 04:00:03', '764,318', '687,500'),
(174, '2020-02-05 04:00:04', '755,741', '679,000'),
(175, '2020-02-06 04:00:03', '752,714', '676,000'),
(176, '2020-02-07 04:00:04', '755,741', '679,000'),
(177, '2020-02-08 04:00:04', '758,264', '681,500'),
(178, '2020-02-10 04:00:04', '759,273', '682,500'),
(179, '2020-02-11 04:00:03', '758,264', '681,500'),
(180, '2020-02-12 04:00:03', '757,255', '680,500'),
(181, '2020-02-13 04:00:04', '758,667', '682,000'),
(182, '2020-02-14 04:00:04', '760,282', '692,000'),
(183, '2020-02-15 04:00:04', '764,822', '697,000'),
(184, '2020-02-17 04:00:05', '763,813', '696,000'),
(185, '2020-02-18 04:00:04', '765,327', '696,000'),
(186, '2020-02-19 04:00:04', '773,399', '700,000'),
(187, '2020-02-20 04:00:05', '778,444', '708,000'),
(188, '2020-02-21 04:00:04', '786,011', '712,000'),
(189, '2020-02-22 04:00:04', '796,101', '720,000'),
(190, '2020-02-24 04:00:05', '808,209', '730,000'),
(191, '2020-02-25 04:35:03', '805,182', '730,000'),
(192, '2020-02-26 04:00:04', '804,173', '730,000'),
(193, '2020-02-27 04:00:04', '811,236', '735,000'),
(194, '2020-02-27 04:45:04', '812,245', '735,000'),
(195, '2020-02-28 04:00:04', '812,245', '738,000'),
(196, '2020-02-28 04:15:02', '823,344', '738,000'),
(197, '2020-02-28 04:55:03', '824,353', '738,000'),
(198, '2020-02-29 04:00:06', '804,173', '728,000'),
(199, '2020-03-02 04:00:03', '809,117', '732,000'),
(200, '2020-03-03 04:00:03', '800,137', '737,000'),
(201, '2020-03-04 04:00:02', '814,263', '749,000'),
(202, '2020-03-05 04:00:02', '813,759', '744,000'),
(203, '2020-03-06 04:00:02', '836,966', '760,000'),
(204, '2020-03-07 04:00:05', '836,966', '765,000'),
(205, '2020-03-07 04:55:02', '834,948', '765,000'),
(206, '2020-03-09 04:00:04', '849,074', '776,000'),
(207, '2020-03-10 04:00:03', '839,993', '767,000'),
(208, '2020-03-11 04:00:03', '833,939', '764,000'),
(209, '2020-03-11 04:55:03', '834,948', '764,000'),
(210, '2020-03-12 04:00:03', '834,948', '756,000'),
(211, '2020-03-13 04:00:04', '826,371', '734,000'),
(212, '2020-03-13 08:00:04', '824,858', '734,000'),
(213, '2020-03-14 04:00:04', '803,164', '730,000'),
(214, '2020-03-16 04:00:04', '803,164', '741,000'),
(215, '2020-03-16 04:05:03', '815,272', '741,000'),
(216, '2020-03-17 04:00:04', '815,272', '719,000'),
(217, '2020-03-17 04:10:03', '805,182', '719,000'),
(218, '2020-03-18 04:00:04', '820,822', '745,000'),
(219, '2020-03-19 04:00:04', '820,822', '732,000'),
(220, '2020-03-19 04:05:03', '819,308', '732,000'),
(221, '2020-03-20 04:00:04', '819,308', '743,000'),
(222, '2020-03-20 04:20:04', '847,560', '743,000'),
(223, '2020-03-21 04:00:03', '875,812', '791,000'),
(224, '2020-03-21 04:20:03', '849,074', '791,000'),
(225, '2020-03-23 04:00:04', '961,577', '780,000'),
(226, '2020-03-24 04:00:04', '961,577', '810,000'),
(227, '2020-03-24 04:50:03', '992,352', '810,000'),
(228, '2020-03-26 04:00:03', '961,577', '810,000'),
(229, '2020-03-27 04:30:03', '931,307', '810,000'),
(230, '2020-03-30 04:35:03', '913,650', '810,000'),
(231, '2020-03-31 04:00:04', '905,578', '810,000'),
(232, '2020-04-01 04:00:04', '905,578', '805,000'),
(233, '2020-04-02 04:00:04', '905,578', '810,000'),
(234, '2020-04-02 04:30:04', '918,695', '810,000'),
(235, '2020-04-02 04:50:03', '918,695', '822,000'),
(236, '2020-04-03 04:00:04', '918,695', '845,000'),
(237, '2020-04-03 04:20:03', '925,758', '845,000'),
(238, '2020-04-06 04:00:04', '925,758', '832,000'),
(239, '2020-04-07 04:00:03', '925,758', '862,000'),
(240, '2020-04-07 04:25:03', '943,415', '862,000'),
(241, '2020-04-08 04:00:03', '933,325', '845,000'),
(242, '2020-04-09 04:00:03', '933,325', '836,000'),
(243, '2020-04-13 04:00:02', '933,325', '848,000'),
(244, '2020-04-13 04:20:03', '929,794', '848,000'),
(245, '2020-04-14 04:00:03', '929,794', '844,000'),
(246, '2020-04-14 04:15:02', '935,848', '844,000'),
(247, '2020-04-15 04:00:04', '956,028', '840,000'),
(248, '2020-04-15 04:30:03', '945,938', '840,000'),
(249, '2020-04-16 04:00:03', '945,938', '837,000'),
(250, '2020-04-16 04:25:03', '955,019', '837,000'),
(251, '2020-04-17 04:00:03', '941,902', '840,000'),
(254, '2020-04-20 13:25:13', '927,776', '816,000'),
(256, '2020-04-28 04:10:04', '948,460', '834,000'),
(273, '2020-04-30 08:00:03', '933,830', '829,000'),
(274, '2020-05-01 00:00:04', '933,830', '829,000'),
(275, '2020-05-02 00:00:05', '933,830', '829,000'),
(276, '2020-05-03 00:00:04', '933,830', '829,000'),
(277, '2020-05-04 00:00:04', '933,830', '829,000'),
(278, '2020-05-05 00:00:04', '920,713', '813,000'),
(279, '2020-05-06 00:00:03', '925,758', '812,000'),
(280, '2020-05-07 00:00:05', '926,767', '813,000'),
(281, '2020-05-08 00:00:03', '926,767', '813,000'),
(282, '2020-05-09 00:00:04', '929,289', '819,000'),
(283, '2020-05-10 00:00:05', '929,289', '819,000'),
(284, '2020-05-11 00:00:05', '929,289', '819,000'),
(285, '2020-05-12 00:00:04', '917,686', '812,000'),
(286, '2020-05-13 00:00:04', '916,677', '806,000'),
(287, '2020-05-14 00:00:05', '917,686', '812,000'),
(288, '2020-05-15 00:00:03', '923,235', '815,000'),
(289, '2020-05-16 00:00:04', '928,785', '823,000'),
(290, '2020-05-17 00:00:05', '928,785', '823,000'),
(291, '2020-05-18 00:00:05', '928,785', '823,000'),
(292, '2020-05-19 00:00:04', '940,893', '831,000'),
(293, '2020-05-20 00:00:04', '928,785', '822,000'),
(294, '2020-05-21 00:00:05', '929,794', '824,000'),
(295, '2020-05-22 00:00:03', '929,794', '824,000'),
(296, '2020-05-23 00:00:04', '929,794', '824,000'),
(297, '2020-05-24 00:00:04', '929,794', '824,000'),
(298, '2020-05-25 00:00:03', '929,794', '824,000'),
(299, '2020-05-26 00:00:04', '929,794', '824,000'),
(300, '2020-05-27 00:00:05', '923,740', '816,000'),
(301, '2020-05-28 00:00:04', '915,668', '808,000'),
(302, '2020-05-29 00:00:05', '918,190', '808,000'),
(303, '2020-05-30 00:00:04', '920,713', '813,000'),
(304, '2020-05-31 00:00:04', '920,713', '813,000'),
(305, '2020-06-01 00:00:05', '920,713', '813,000'),
(306, '2020-06-02 00:00:04', '920,713', '813,000'),
(307, '2020-06-03 00:00:05', '915,668', '823,000'),
(308, '2020-06-04 00:00:04', '903,055', '801,000'),
(309, '2020-06-05 00:00:05', '888,929', '776,000'),
(310, '2020-06-06 00:00:04', '889,434', '778,000'),
(311, '2020-06-07 00:00:05', '889,434', '778,000'),
(312, '2020-06-08 00:00:04', '889,434', '778,000'),
(313, '2020-06-09 00:00:05', '869,758', '762,000'),
(314, '2020-06-10 00:00:04', '871,776', '761,000'),
(315, '2020-06-11 00:00:05', '882,875', '769,000'),
(316, '2020-06-12 00:00:05', '891,452', '784,000'),
(317, '2020-06-13 00:00:06', '895,488', '777,000'),
(318, '2020-06-14 00:00:05', '895,488', '777,000'),
(319, '2020-06-15 00:00:04', '895,488', '777,000'),
(320, '2020-06-16 00:00:05', '895,488', '793,000'),
(321, '2020-06-17 00:00:05', '891,956', '787,000'),
(322, '2020-06-18 00:00:04', '889,938', '784,000'),
(323, '2020-06-19 00:00:03', '890,947', '790,000'),
(324, '2020-06-20 00:00:04', '890,947', '784,000'),
(325, '2020-06-21 00:00:05', '890,947', '784,000'),
(326, '2020-06-22 00:00:04', '890,947', '784,000'),
(327, '2020-06-23 00:00:05', '903,560', '797,000'),
(328, '2020-06-24 00:00:05', '904,064', '799,000'),
(329, '2020-06-25 00:00:05', '906,587', '809,000'),
(330, '2020-06-26 00:00:04', '907,596', '800,000'),
(331, '2020-06-27 00:00:04', '910,623', '803,000'),
(332, '2020-06-28 00:00:05', '910,623', '803,000'),
(333, '2020-06-29 00:00:04', '910,623', '803,000'),
(334, '2020-06-30 00:00:05', '924,749', '806,000'),
(335, '2020-07-01 00:00:05', '923,740', '814,000'),
(336, '2020-07-02 00:00:04', '934,839', '815,000');

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
-- Indeks untuk tabel `tb_deposit`
--
ALTER TABLE `tb_deposit`
  ADD PRIMARY KEY (`idx`);

--
-- Indeks untuk tabel `tb_history`
--
ALTER TABLE `tb_history`
  ADD PRIMARY KEY (`idx`);

--
-- Indeks untuk tabel `tb_titipan_emas`
--
ALTER TABLE `tb_titipan_emas`
  ADD PRIMARY KEY (`idx`);

--
-- Indeks untuk tabel `tb_titipan_emas_detail`
--
ALTER TABLE `tb_titipan_emas_detail`
  ADD PRIMARY KEY (`idx`);

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
-- Indeks untuk tabel `tb_widraw`
--
ALTER TABLE `tb_widraw`
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
  MODIFY `idtmp` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT untuk tabel `tb_bank`
--
ALTER TABLE `tb_bank`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_bonus`
--
ALTER TABLE `tb_bonus`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tb_deposit`
--
ALTER TABLE `tb_deposit`
  MODIFY `idx` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `tb_history`
--
ALTER TABLE `tb_history`
  MODIFY `idx` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT untuk tabel `tb_titipan_emas`
--
ALTER TABLE `tb_titipan_emas`
  MODIFY `idx` bigint(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `tb_titipan_emas_detail`
--
ALTER TABLE `tb_titipan_emas_detail`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=219;

--
-- AUTO_INCREMENT untuk tabel `tb_verifikasi_email`
--
ALTER TABLE `tb_verifikasi_email`
  MODIFY `idx` bigint(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_widraw`
--
ALTER TABLE `tb_widraw`
  MODIFY `idx` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `t_update_ubs`
--
ALTER TABLE `t_update_ubs`
  MODIFY `IDX` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=337;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
