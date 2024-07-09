-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 09, 2024 at 01:54 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `raport`
--

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `nip` varchar(18) NOT NULL,
  `kd_mp` int(11) DEFAULT NULL,
  `nama_guru` varchar(30) DEFAULT NULL,
  `alamat` varchar(30) DEFAULT NULL,
  `jenis_kelamin` enum('L','P') DEFAULT NULL,
  `agama` enum('ISLAM','PROTESTAN','KATHOLIK','HINDU','BUDHA','KONGHUCU','LAINNYA') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`nip`, `kd_mp`, `nama_guru`, `alamat`, `jenis_kelamin`, `agama`) VALUES
('101', 1, 'Ahmad Fauzi', 'Jl. Merdeka No. 1', '', 'ISLAM'),
('102', 2, 'Budi Santoso', 'Jl. Sudirman No. 2 ', '', 'BUDHA'),
('103', 3, 'Citra Dewi', 'Jl. Gatot Subroto No. 3', '', ''),
('104', 4, 'Dedi Setiawan', 'Jl. Hasanudin No. 4', '', 'ISLAM'),
('105', 5, 'Eka Putri', 'Jl. Diponegoro No. 5', '', 'HINDU'),
('106', 6, 'Faisal Rahman', 'Jl. Ahmad Yani No. 6', '', 'ISLAM'),
('107', 7, 'Gita Pertiwi', 'Jl. S Parman No. 7', '', ''),
('108', 8, 'Heri Susanto', 'Jl. Imam Bonjol No. 8', '', 'KONGHUCU'),
('109', 9, 'Indah Sari', 'Jl. HOS Cokroaminoto No. 9', '', ''),
('110', 10, 'Joko Prasetyo', 'Jl. Gajah Mada No. 10', '', 'ISLAM');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(30) NOT NULL,
  `wali_kelas` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`, `wali_kelas`) VALUES
(1, 'Kelas 7A', '101'),
(2, 'Kelas 7B', '102'),
(3, 'Kelas 7C', '103'),
(4, 'Kelas 7D', '104'),
(5, 'Kelas 8A', '105'),
(6, 'Kelas 8B', '106'),
(7, 'Kelas 8C', '107'),
(8, 'Kelas 8D', '108'),
(9, 'Kelas 9A', '109'),
(10, 'Kelas 9B', '110'),
(11, 'Kelas 9C', '101'),
(12, 'Kelas 9D', '102'),
(16, 'Kelas Iwak', '102'),
(17, 'as', '101');

-- --------------------------------------------------------

--
-- Table structure for table `kelas_guru`
--

CREATE TABLE `kelas_guru` (
  `id` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `kd_mp` int(11) NOT NULL,
  `nip` varchar(18) NOT NULL,
  `id_tahun_akademik` int(11) DEFAULT NULL,
  `tanggal` varchar(10) DEFAULT NULL,
  `waktu` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kelas_guru`
--

INSERT INTO `kelas_guru` (`id`, `id_kelas`, `kd_mp`, `nip`, `id_tahun_akademik`, `tanggal`, `waktu`) VALUES
(49, 1, 1, '101', 13, 'Monday', '07:00:00'),
(50, 1, 2, '102', 13, 'Monday', '09:00:00'),
(51, 1, 3, '103', 13, 'Monday', '11:00:00'),
(52, 1, 4, '104', 13, 'Wednesday', '07:00:00'),
(54, 1, 5, '105', 13, 'Monday', '13:00:00'),
(55, 1, 6, '106', 13, 'Monday', '15:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `mata_pelajaran`
--

CREATE TABLE `mata_pelajaran` (
  `kd_mp` int(11) NOT NULL,
  `nama_mp` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mata_pelajaran`
--

INSERT INTO `mata_pelajaran` (`kd_mp`, `nama_mp`) VALUES
(1, 'Pendidikan Agama'),
(2, 'Pendidikan Kewarganegaraan'),
(3, 'Bahasa Indonesia'),
(4, 'Bahasa Inggris'),
(5, 'Matematika'),
(6, 'IPA'),
(7, 'IPS'),
(8, 'Seni Budaya'),
(9, 'Pendidikan Jasmani, Olahraga d'),
(10, 'Keterampilan/Teknologi Informa');

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `nis` varchar(8) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `kd_mp` int(11) NOT NULL,
  `nilai_tp1` int(4) DEFAULT NULL,
  `nilai_tp2` int(4) DEFAULT NULL,
  `nilai_tp3` int(4) DEFAULT NULL,
  `nilai_tp4` int(4) DEFAULT NULL,
  `nilai_tp5` int(4) DEFAULT NULL,
  `nilai_tp6` int(4) DEFAULT NULL,
  `nilai_tp7` int(4) DEFAULT NULL,
  `rata_tp` int(4) DEFAULT NULL,
  `nilai_uh1` int(4) DEFAULT NULL,
  `nilai_uh2` int(4) DEFAULT NULL,
  `nilai_uh3` int(4) DEFAULT NULL,
  `nilai_uh4` int(4) DEFAULT NULL,
  `nilai_uh5` int(4) DEFAULT NULL,
  `nilai_uh6` int(4) DEFAULT NULL,
  `nilai_uh7` int(4) DEFAULT NULL,
  `rata_uh` int(4) DEFAULT NULL,
  `nilai_pts` int(4) DEFAULT NULL,
  `nilai_uas` int(4) DEFAULT NULL,
  `nilai_akhir` int(4) DEFAULT NULL,
  `nilai_huruf` enum('A','B','C','D','E') DEFAULT NULL,
  `deskripsi` mediumtext DEFAULT NULL,
  `id_mp` int(11) DEFAULT NULL,
  `id_tahun_akademik` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`nis`, `id_kelas`, `kd_mp`, `nilai_tp1`, `nilai_tp2`, `nilai_tp3`, `nilai_tp4`, `nilai_tp5`, `nilai_tp6`, `nilai_tp7`, `rata_tp`, `nilai_uh1`, `nilai_uh2`, `nilai_uh3`, `nilai_uh4`, `nilai_uh5`, `nilai_uh6`, `nilai_uh7`, `rata_uh`, `nilai_pts`, `nilai_uas`, `nilai_akhir`, `nilai_huruf`, `deskripsi`, `id_mp`, `id_tahun_akademik`) VALUES
('2205001', 1, 1, 100, 100, 100, 100, 100, 100, 99, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 'A', 'Sangat Baik', NULL, NULL),
('2205001', 1, 2, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 'A', 'Sangat Baik', NULL, NULL),
('2205001', 1, 3, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 'A', 'Sangat Baik', NULL, NULL),
('2205001', 1, 4, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 'A', 'Sangat Baik', NULL, NULL),
('2205001', 1, 5, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 0, 86, 100, 100, 96, 'A', 'Sangat Baik', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `profil_sekolah`
--

CREATE TABLE `profil_sekolah` (
  `idprofil_sekolah` int(4) NOT NULL,
  `nama` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `npsn` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `status` enum('Negeri','Swasta') CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `nama_kepsek` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `nip_kepsek` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `akreditasi` enum('kosong','A','B','C') CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `logo` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `provinsi` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `kabupaten` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `kecamatan` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `kelurahan` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `dusun` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `rt` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `rw` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `alamat` varchar(256) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `kodepos` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `lintang` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `bujur` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `nis` varchar(8) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `alamat` varchar(30) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jenis_kelamin` enum('L','P') DEFAULT NULL,
  `agama` enum('ISLAM','PROTESTAN','KATHOLIK','HINDU','BUDHA','KONGHUCU','LAINNYA') DEFAULT NULL,
  `orang_tua` varchar(30) DEFAULT NULL,
  `asal_sekolah` varchar(50) NOT NULL,
  `id_kelas` int(11) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `status_pembayaran` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`nis`, `nama`, `alamat`, `tanggal_lahir`, `jenis_kelamin`, `agama`, `orang_tua`, `asal_sekolah`, `id_kelas`, `foto`, `status_pembayaran`) VALUES
('2205001', 'ANDHIKA ', 'KABUPATEN MAGELAN ', '0000-00-00', 'L', 'ISLAM', 'Agung', 'Magelang', 1, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tahun_akademik`
--

CREATE TABLE `tahun_akademik` (
  `id` int(11) NOT NULL,
  `tahun_akademik` varchar(9) DEFAULT NULL,
  `semester` varchar(6) DEFAULT NULL,
  `semester_aktif` tinyint(1) DEFAULT NULL,
  `tempat` varchar(50) DEFAULT NULL,
  `tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tahun_akademik`
--

INSERT INTO `tahun_akademik` (`id`, `tahun_akademik`, `semester`, `semester_aktif`, `tempat`, `tanggal`) VALUES
(13, '2024', 'GENAP', 1, 'Kabupaten Magelang', '2024-07-31'),
(14, '2', 'genap', 0, '23', '2024-07-03');

-- --------------------------------------------------------

--
-- Table structure for table `tanggal_options`
--

CREATE TABLE `tanggal_options` (
  `id` int(11) NOT NULL,
  `hari` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tanggal_options`
--

INSERT INTO `tanggal_options` (`id`, `hari`) VALUES
(1, 'Monday'),
(2, 'Tuesday'),
(3, 'Wednesday'),
(4, 'Thursday'),
(5, 'Friday');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','guru','siswa') NOT NULL,
  `email` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `role`, `email`, `created_at`) VALUES
(7, 'admin', 'ADMIN', 'admin', '', '2024-06-18 01:18:03');

-- --------------------------------------------------------

--
-- Table structure for table `waktu_options`
--

CREATE TABLE `waktu_options` (
  `id` int(11) NOT NULL,
  `waktu` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `waktu_options`
--

INSERT INTO `waktu_options` (`id`, `waktu`) VALUES
(1, '07:00:00'),
(2, '09:00:00'),
(3, '11:00:00'),
(4, '13:00:00'),
(5, '15:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`nip`),
  ADD KEY `kd_mp` (`kd_mp`),
  ADD KEY `kd_mp_2` (`kd_mp`),
  ADD KEY `nip` (`nip`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indexes for table `kelas_guru`
--
ALTER TABLE `kelas_guru`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kelas` (`id_kelas`),
  ADD KEY `kd_mp` (`kd_mp`),
  ADD KEY `nip` (`nip`);

--
-- Indexes for table `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  ADD PRIMARY KEY (`kd_mp`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`nis`,`id_kelas`,`kd_mp`),
  ADD KEY `id_kelas` (`id_kelas`),
  ADD KEY `kd_mp` (`kd_mp`),
  ADD KEY `fk_id_mp` (`id_mp`),
  ADD KEY `id_tahun_akademik` (`id_tahun_akademik`);

--
-- Indexes for table `profil_sekolah`
--
ALTER TABLE `profil_sekolah`
  ADD PRIMARY KEY (`idprofil_sekolah`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`nis`),
  ADD KEY `siswa_ibfk_2` (`id_kelas`);

--
-- Indexes for table `tahun_akademik`
--
ALTER TABLE `tahun_akademik`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tanggal_options`
--
ALTER TABLE `tanggal_options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `waktu_options`
--
ALTER TABLE `waktu_options`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `kelas_guru`
--
ALTER TABLE `kelas_guru`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  MODIFY `kd_mp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `profil_sekolah`
--
ALTER TABLE `profil_sekolah`
  MODIFY `idprofil_sekolah` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tahun_akademik`
--
ALTER TABLE `tahun_akademik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tanggal_options`
--
ALTER TABLE `tanggal_options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `waktu_options`
--
ALTER TABLE `waktu_options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `guru`
--
ALTER TABLE `guru`
  ADD CONSTRAINT `guru_ibfk_1` FOREIGN KEY (`kd_mp`) REFERENCES `mata_pelajaran` (`kd_mp`);

--
-- Constraints for table `kelas_guru`
--
ALTER TABLE `kelas_guru`
  ADD CONSTRAINT `kelas_guru_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`),
  ADD CONSTRAINT `kelas_guru_ibfk_2` FOREIGN KEY (`kd_mp`) REFERENCES `mata_pelajaran` (`kd_mp`),
  ADD CONSTRAINT `kelas_guru_ibfk_3` FOREIGN KEY (`nip`) REFERENCES `guru` (`nip`);

--
-- Constraints for table `nilai`
--
ALTER TABLE `nilai`
  ADD CONSTRAINT `fk_id_mp` FOREIGN KEY (`id_mp`) REFERENCES `mata_pelajaran` (`kd_mp`),
  ADD CONSTRAINT `nilai_ibfk_1` FOREIGN KEY (`nis`) REFERENCES `siswa` (`nis`),
  ADD CONSTRAINT `nilai_ibfk_2` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`),
  ADD CONSTRAINT `nilai_ibfk_3` FOREIGN KEY (`kd_mp`) REFERENCES `mata_pelajaran` (`kd_mp`),
  ADD CONSTRAINT `nilai_ibfk_4` FOREIGN KEY (`id_tahun_akademik`) REFERENCES `tahun_akademik` (`id`);

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_ibfk_2` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
