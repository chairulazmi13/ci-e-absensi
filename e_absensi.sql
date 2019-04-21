-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 21 Apr 2019 pada 14.51
-- Versi Server: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e_absensi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `absensi`
--

CREATE TABLE `absensi` (
  `id_absensi` int(11) NOT NULL,
  `id_pegawai` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `mulai_masuk` time DEFAULT NULL,
  `jam_telat` time DEFAULT NULL,
  `telat` int(11) DEFAULT NULL,
  `jam_masuk` datetime DEFAULT NULL,
  `jam_pulang` datetime DEFAULT NULL,
  `masuk` int(11) DEFAULT NULL,
  `keterangan` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `absensi`
--

INSERT INTO `absensi` (`id_absensi`, `id_pegawai`, `tanggal`, `mulai_masuk`, `jam_telat`, `telat`, `jam_masuk`, `jam_pulang`, `masuk`, `keterangan`) VALUES
(29, 8, '2019-03-22', '08:00:00', '08:12:38', 1, '2019-03-22 16:12:38', '2019-03-22 16:16:43', 1, 'Masuk Telat 08:12:38'),
(31, 8, '2019-03-01', '08:00:00', '15:39:11', 1, '2019-03-01 16:20:49', '2019-03-01 16:22:27', 1, 'Masuk Telat 15:39:11'),
(32, 6, '2019-03-01', '08:00:00', '15:31:44', 1, '2019-03-01 16:28:16', '2019-03-01 16:28:27', 1, 'Masuk Telat 15:31:44'),
(33, 6, '2019-03-04', '08:00:00', '15:31:18', 1, '2019-03-04 16:28:42', '2019-03-04 16:28:47', 1, 'Masuk Telat 15:31:18'),
(34, 8, '2019-04-04', '08:00:00', '01:32:43', 1, '2019-04-04 09:32:43', NULL, 1, 'Masuk Telat 01:32:43'),
(35, 8, '2019-04-05', '08:00:00', '01:47:07', 1, '2019-04-05 09:47:07', NULL, 1, 'Masuk Telat 01:47:07'),
(36, 8, '2019-04-15', '08:00:00', '03:12:13', 1, '2019-04-15 11:12:13', NULL, 1, 'Masuk Telat 03:12:13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cuti`
--

CREATE TABLE `cuti` (
  `id_cuti` varchar(50) NOT NULL,
  `id_pegawai` int(11) DEFAULT NULL,
  `tanggal_pengajuan` date DEFAULT NULL,
  `tanggal_mulai` date DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `jumlah_hari` int(11) DEFAULT NULL,
  `jenis_cuti` varchar(50) DEFAULT NULL,
  `keterangan` text,
  `approve` int(11) DEFAULT '0',
  `approve_by` varchar(50) DEFAULT NULL,
  `file` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detailcuti`
--

CREATE TABLE `detailcuti` (
  `id_pegawai` int(11) DEFAULT NULL,
  `id_cuti` int(11) DEFAULT NULL,
  `tanggal_pengajuan` date DEFAULT NULL,
  `tanggal_cuti` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detaildinas`
--

CREATE TABLE `detaildinas` (
  `id_dinas` varchar(50) DEFAULT NULL,
  `id_pegawai` int(11) DEFAULT NULL,
  `tanggal_pengajuan` date DEFAULT NULL,
  `tanggal_dinas` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Struktur dari tabel `dinas`
--

CREATE TABLE `dinas` (
  `id_dinas` varchar(50) NOT NULL,
  `id_pegawai` int(11) DEFAULT NULL,
  `tanggal_pengajuan` date DEFAULT NULL,
  `tanggal_mulai` date DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `jumlah_hari` int(11) DEFAULT NULL,
  `keterangan` text,
  `file` text,
  `tempat` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Struktur dari tabel `divisi`
--

CREATE TABLE `divisi` (
  `id_divisi` int(11) NOT NULL,
  `nama_divisi` varchar(50) DEFAULT NULL,
  `keterangan` varchar(50) DEFAULT NULL,
  `create_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `divisi`
--

INSERT INTO `divisi` (`id_divisi`, `nama_divisi`, `keterangan`, `create_date`, `update_date`) VALUES
(1, 'Ketua', 'lantai 2', '2019-02-18 03:47:00', NULL),
(13, 'Wakil Ketua', 'lantai 2', '2019-03-25 13:47:04', NULL),
(14, 'Panitera', 'Pengadilan Agama', '2019-04-11 13:51:09', NULL),
(15, 'Sekretaris', 'Pengadilan Agama', '2019-04-11 13:51:49', NULL),
(16, 'Unsur Hakim', 'Pengadilan Agama', '2019-04-11 13:52:41', NULL),
(17, 'Bagian Kepaniteraan', 'Pengadilan Agama', '2019-04-11 13:53:16', NULL),
(18, 'Bagian Kesekretariatan', 'Pengadilan Agama', '2019-04-11 13:53:53', NULL),
(19, 'admin', 'admin', '2019-04-11 14:10:50', NULL),
(20, 'IT', 'Dewa : Semuanya Bisa', '2019-04-15 02:11:04', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `harilibur`
--

CREATE TABLE `harilibur` (
  `id` int(11) NOT NULL,
  `tanggal_libur` date DEFAULT NULL,
  `keterangan` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `harilibur`
--

INSERT INTO `harilibur` (`id`, `tanggal_libur`, `keterangan`) VALUES
(1, '2019-04-03', 'Isra Miraj'),
(2, '2019-04-19', 'Wafat isa almasih'),
(4, '2019-04-21', 'hari paskah'),
(8, '2019-05-01', 'Hari buruh'),
(9, '2019-05-19', 'Hari raya waisak'),
(10, '2019-04-17', 'Pemilu');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jabatan`
--

CREATE TABLE `jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `nama_jabatan` varchar(50) DEFAULT NULL,
  `keterangan` varchar(50) DEFAULT NULL,
  `create_date` timestamp NULL DEFAULT NULL,
  `update_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `jabatan`
--

INSERT INTO `jabatan` (`id_jabatan`, `nama_jabatan`, `keterangan`, `create_date`, `update_date`) VALUES
(1, 'Ketua', 'Pengadilan Agama', '2019-02-18 03:47:30', NULL),
(2, 'Wakil Ketua', 'Wakil Ketua Pengadilan Agama', NULL, NULL),
(3, 'Hakim', 'Hakim Pengadilan Agama', NULL, NULL),
(4, 'Panitera', 'Panitera Pengadilan Agama', NULL, NULL),
(5, 'Sekretaris', 'Sekretaris Pengadilan Agama', NULL, NULL),
(6, 'Wakil Panitera', 'Wakil Panitera Pengadila Agama', NULL, NULL),
(7, 'Panitera Muda Gugatan', 'Panitera Muda Gugatan Pengadilan Agama', NULL, NULL),
(8, 'Panitera Muda Permohonan', 'Panitera Muda Permohonan Pengadilan Agama', NULL, NULL),
(9, 'Panitera Muda Hukum', 'Panitera Muda Hukum Pengadilan Agama', NULL, NULL),
(10, 'Kepala Sub Bagian Umum dan Keuangan', 'Kepala Sub Bagian Umum dan Keuangan Pengadilan Aga', NULL, NULL),
(11, 'Kepala Sub Bagian Kepegawaian, organisasi dan Tata', 'Kasub Bag Kepegawaian, organisasi dan Tatalaksana ', NULL, NULL),
(12, 'Kepala Sub Bagian Perencanaan IT dan Pelaporan', 'Ka.Sub Bag IT dan Pelaporan PA. ', NULL, NULL),
(13, 'Panitera Pengganti', 'PP ', NULL, NULL),
(14, 'Juru sita', 'JP', NULL, NULL),
(15, 'Juru sita Pengganti', 'JSP Pengadilan Agama', NULL, NULL),
(16, 'admin', 'admin absen', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `level`
--

CREATE TABLE `level` (
  `id_level` int(11) NOT NULL,
  `nama_level` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `level`
--

INSERT INTO `level` (`id_level`, `nama_level`) VALUES
(1, 'user'),
(2, 'admin'),
(3, 'administrator');

-- --------------------------------------------------------

--
-- Struktur dari tabel `log_activity`
--

CREATE TABLE `log_activity` (
  `id_log` int(11) NOT NULL,
  `nip` varchar(29) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  `keterangan` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE `pegawai` (
  `id` int(20) NOT NULL,
  `nip` varchar(20) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `kota` varchar(50) DEFAULT NULL,
  `alamat` tinytext,
  `id_divisi` int(11) DEFAULT NULL,
  `id_jabatan` int(11) DEFAULT NULL,
  `aktif_pegawai` int(11) DEFAULT '1',
  `password_pegawai` varchar(50) DEFAULT NULL,
  `ip_address` varchar(50) DEFAULT NULL,
  `last_activity` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `qr_code` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`id`, `nip`, `nama`, `kota`, `alamat`, `id_divisi`, `id_jabatan`, `aktif_pegawai`, `password_pegawai`, `ip_address`, `last_activity`, `qr_code`) VALUES
(6, '111111111111111000', 'Likhit Ari Prabowo', 'Brebes', 'GandaSuli', 17, 11, 1, '25d55ad283aa400af464c76d713c07ad', '192.168.1.10', '2019-03-31 08:21:57', '111111111111111000.png'),
(8, '311111111111111000', 'Chairul Azmi', 'Tegal', 'Tembok Kidul RT 22, RW 02 No. 27 Kec. Adiwerna', 17, 12, 1, '25d55ad283aa400af464c76d713c07ad', '192.168.1.102', '2019-04-21 12:07:41', '311111111111111000.png'),
(10, '196301031989031007', 'Drs. H. Abdul Ghofur, SH. MH', 'Pemalang', 'Jl. Yos Sudarso', 1, 1, 1, '1dfe1a2512540f48e36cef6d005c27a9', NULL, '2019-04-18 03:08:15', '196301031989031000.png'),
(11, '195802061996031003', 'Drs.Muhammad Akyas', 'Cirebon', 'Cirebon', 16, 3, 1, '99b398ad5a773af9c5fa9132b6893cb6', '', '2019-04-21 11:59:37', '195802061996031000.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengaturan`
--

CREATE TABLE `pengaturan` (
  `id` int(11) NOT NULL,
  `nama_perusahaan` varchar(50) DEFAULT NULL,
  `alamat` varchar(50) DEFAULT NULL,
  `mulai_absensi` time DEFAULT NULL,
  `mulai_masuk` time DEFAULT NULL,
  `mulai_pulang` time DEFAULT NULL,
  `timeout_qr_code` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengaturan`
--

INSERT INTO `pengaturan` (`id`, `nama_perusahaan`, `alamat`, `mulai_absensi`, `mulai_masuk`, `mulai_pulang`, `timeout_qr_code`) VALUES
(1, 'Pengadilan Agama Kelas IA', 'Jl. Sulawesi NO. 9 A Pemalang', '06:00:00', '08:00:00', '17:00:00', '00:10:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `id_pegawai` int(11) DEFAULT NULL,
  `id_level` int(11) DEFAULT NULL,
  `aktif` int(11) DEFAULT NULL,
  `create_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date` timestamp NULL DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `id_pegawai`, `id_level`, `aktif`, `create_date`, `update_date`, `last_login`) VALUES
(6, 'azmi013', '25d55ad283aa400af464c76d713c07ad', 8, 3, 1, '2019-03-19 09:46:43', NULL, NULL),
(7, 'likhitbowo', 'e10adc3949ba59abbe56e057f20f883e', 6, 2, 2, '2019-03-24 08:14:34', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id_absensi`);

--
-- Indexes for table `cuti`
--
ALTER TABLE `cuti`
  ADD PRIMARY KEY (`id_cuti`);

--
-- Indexes for table `dinas`
--
ALTER TABLE `dinas`
  ADD PRIMARY KEY (`id_dinas`);

--
-- Indexes for table `divisi`
--
ALTER TABLE `divisi`
  ADD PRIMARY KEY (`id_divisi`);

--
-- Indexes for table `harilibur`
--
ALTER TABLE `harilibur`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id_level`);

--
-- Indexes for table `log_activity`
--
ALTER TABLE `log_activity`
  ADD PRIMARY KEY (`id_log`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengaturan`
--
ALTER TABLE `pengaturan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id_absensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `divisi`
--
ALTER TABLE `divisi`
  MODIFY `id_divisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `harilibur`
--
ALTER TABLE `harilibur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `id_level` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `log_activity`
--
ALTER TABLE `log_activity`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `pengaturan`
--
ALTER TABLE `pengaturan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
