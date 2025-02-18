-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 19, 2023 at 09:42 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ujianonline`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id` int NOT NULL,
  `nama_user` varchar(25) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`id`, `nama_user`, `username`, `password`) VALUES
(1, 'Firman', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `tb_guru`
--

CREATE TABLE `tb_guru` (
  `id_guru` int NOT NULL,
  `nik_guru` varchar(20) NOT NULL,
  `nama_guru` varchar(100) NOT NULL,
  `jenis_kelamin_guru` varchar(15) NOT NULL,
  `alamat_guru` varchar(250) NOT NULL,
  `tanggal_lahir_guru` date NOT NULL,
  `username_guru` varchar(100) NOT NULL,
  `password_guru` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_guru`
--

INSERT INTO `tb_guru` (`id_guru`, `nik_guru`, `nama_guru`, `jenis_kelamin_guru`, `alamat_guru`, `tanggal_lahir_guru`, `username_guru`, `password_guru`) VALUES
(3, '911601010883010012', 'bintang', 'Laki-Laki', 'Jl.fankan', '2000-01-01', 'admin', 'admins');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jawaban`
--

CREATE TABLE `tb_jawaban` (
  `id_jawaban` int NOT NULL,
  `id_peserta` int NOT NULL,
  `id_soal_ujian` int NOT NULL,
  `jawaban` varchar(15) NOT NULL,
  `skor` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_jawaban`
--

INSERT INTO `tb_jawaban` (`id_jawaban`, `id_peserta`, `id_soal_ujian`, `jawaban`, `skor`) VALUES
(1, 3, 2, 'A', '1'),
(2, 3, 3, 'A', '1'),
(3, 5, 2, 'A', '1'),
(4, 5, 3, 'B', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jenis_ujian`
--

CREATE TABLE `tb_jenis_ujian` (
  `id_jenis_ujian` int NOT NULL,
  `jenis_ujian` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_jenis_ujian`
--

INSERT INTO `tb_jenis_ujian` (`id_jenis_ujian`, `jenis_ujian`) VALUES
(1, 'UAS GANJIL');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kelas`
--

CREATE TABLE `tb_kelas` (
  `id_kelas` int NOT NULL,
  `nama_kelas` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kelas`
--

INSERT INTO `tb_kelas` (`id_kelas`, `nama_kelas`) VALUES
(1, '7A'),
(2, '7B');

-- --------------------------------------------------------

--
-- Table structure for table `tb_matapelajaran`
--

CREATE TABLE `tb_matapelajaran` (
  `id_matapelajaran` int NOT NULL,
  `kode_matapelajaran` varchar(10) NOT NULL,
  `nama_matapelajaran` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_matapelajaran`
--

INSERT INTO `tb_matapelajaran` (`id_matapelajaran`, `kode_matapelajaran`, `nama_matapelajaran`) VALUES
(1, '021', 'Bahasa Inggris'),
(3, '041', 'Kimia');

-- --------------------------------------------------------

--
-- Table structure for table `tb_peserta`
--

CREATE TABLE `tb_peserta` (
  `id_peserta` int NOT NULL,
  `id_matapelajaran` int NOT NULL,
  `id_siswa` int NOT NULL,
  `id_jenis_ujian` int NOT NULL,
  `tanggal_ujian` date NOT NULL,
  `jam_ujian` time NOT NULL,
  `durasi_ujian` int NOT NULL,
  `timer_ujian` int NOT NULL,
  `status_ujian` tinyint(1) NOT NULL,
  `benar` varchar(20) NOT NULL,
  `salah` varchar(20) NOT NULL,
  `nilai` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_peserta`
--

INSERT INTO `tb_peserta` (`id_peserta`, `id_matapelajaran`, `id_siswa`, `id_jenis_ujian`, `tanggal_ujian`, `jam_ujian`, `durasi_ujian`, `timer_ujian`, `status_ujian`, `benar`, `salah`, `nilai`) VALUES
(3, 1, 2, 1, '2023-11-18', '17:18:00', 3, 0, 2, '2', '0', '100'),
(4, 1, 1, 1, '2023-11-18', '19:25:00', 1, 60, 2, '0', '0', '0'),
(5, 3, 3, 1, '2023-11-18', '19:25:00', 1, 60, 2, '1', '1', '50');

-- --------------------------------------------------------

--
-- Table structure for table `tb_siswa`
--

CREATE TABLE `tb_siswa` (
  `id_siswa` int NOT NULL,
  `id_kelas` int NOT NULL,
  `nama_siswa` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nis` int NOT NULL,
  `tgl_lahir_siswa` date NOT NULL,
  `asal_sekolah` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `jenis_kelamin_siswa` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `alamat_siswa` text NOT NULL,
  `username_siswa` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `password_siswa` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_siswa`
--

INSERT INTO `tb_siswa` (`id_siswa`, `id_kelas`, `nama_siswa`, `nis`, `tgl_lahir_siswa`, `asal_sekolah`, `jenis_kelamin_siswa`, `alamat_siswa`, `username_siswa`, `password_siswa`) VALUES
(3, 2, 'budiman', 29090, '2023-11-13', 'eq', 'Laki-Laki', '2dada', '2dad', '2ada'),
(4, 2, 'qada', 121, '2023-11-08', 'dsfds', 'Perempuan', 'Jl.fankan', 'buds', 'buds');

-- --------------------------------------------------------

--
-- Table structure for table `tb_soal_ujian`
--

CREATE TABLE `tb_soal_ujian` (
  `id_soal_ujian` int NOT NULL,
  `id_matapelajaran` int NOT NULL,
  `pertanyaan` text NOT NULL,
  `a` text NOT NULL,
  `b` text NOT NULL,
  `c` text NOT NULL,
  `d` text NOT NULL,
  `e` text NOT NULL,
  `kunci_jawaban` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_soal_ujian`
--

INSERT INTO `tb_soal_ujian` (`id_soal_ujian`, `id_matapelajaran`, `pertanyaan`, `a`, `b`, `c`, `d`, `e`, `kunci_jawaban`) VALUES
(2, 3, 'aasas', '1', '1', '1', '1', '1', 'A'),
(3, 1, '11', '1', '1', '1', '1', '1', 'A'),
(5, 3, 'a', 'a', 'a', 'a', 'a', 'a', 'A');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_guru`
--
ALTER TABLE `tb_guru`
  ADD PRIMARY KEY (`id_guru`);

--
-- Indexes for table `tb_jawaban`
--
ALTER TABLE `tb_jawaban`
  ADD PRIMARY KEY (`id_jawaban`),
  ADD KEY `id_soal_ujian` (`id_soal_ujian`),
  ADD KEY `id_peserta` (`id_peserta`);

--
-- Indexes for table `tb_jenis_ujian`
--
ALTER TABLE `tb_jenis_ujian`
  ADD PRIMARY KEY (`id_jenis_ujian`);

--
-- Indexes for table `tb_kelas`
--
ALTER TABLE `tb_kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `tb_matapelajaran`
--
ALTER TABLE `tb_matapelajaran`
  ADD PRIMARY KEY (`id_matapelajaran`);

--
-- Indexes for table `tb_peserta`
--
ALTER TABLE `tb_peserta`
  ADD PRIMARY KEY (`id_peserta`),
  ADD KEY `id_matakuliah` (`id_matapelajaran`),
  ADD KEY `id_mahasiswa` (`id_siswa`),
  ADD KEY `id_jenis_ujian` (`id_jenis_ujian`);

--
-- Indexes for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD PRIMARY KEY (`id_siswa`),
  ADD UNIQUE KEY `nim` (`nis`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indexes for table `tb_soal_ujian`
--
ALTER TABLE `tb_soal_ujian`
  ADD PRIMARY KEY (`id_soal_ujian`),
  ADD KEY `id_matakuliah` (`id_matapelajaran`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_guru`
--
ALTER TABLE `tb_guru`
  MODIFY `id_guru` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_jawaban`
--
ALTER TABLE `tb_jawaban`
  MODIFY `id_jawaban` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_jenis_ujian`
--
ALTER TABLE `tb_jenis_ujian`
  MODIFY `id_jenis_ujian` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_kelas`
--
ALTER TABLE `tb_kelas`
  MODIFY `id_kelas` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_matapelajaran`
--
ALTER TABLE `tb_matapelajaran`
  MODIFY `id_matapelajaran` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_peserta`
--
ALTER TABLE `tb_peserta`
  MODIFY `id_peserta` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  MODIFY `id_siswa` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_soal_ujian`
--
ALTER TABLE `tb_soal_ujian`
  MODIFY `id_soal_ujian` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
