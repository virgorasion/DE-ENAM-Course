-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2019 at 11:07 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `de_enam`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `DeleteInstansi` (IN `kodeInstansi` VARCHAR(50))  BEGIN
#Delete Instansi
DELETE FROM tb_instansi WHERE tb_instansi.kode_instansi = kodeInstansi;
#Delete Program
DELETE FROM tb_program WHERE tb_program.kode_instansi = kodeInstansi;
#Delete Kegiatan
DELETE FROM tb_kegiatan WHERE tb_kegiatan.kode_instansi = kodeInstansi;
#Delete Rekening
DELETE FROM tb_rekening WHERE tb_rekening.kode_instansi = kodeInstansi;
#Delete Detail Rekening
DELETE FROM tb_detail_rekening WHERE tb_detail_rekening.kode_instansi = kodeInstansi;
#Delete Siswa
DELETE FROM tb_siswa WHERE tb_siswa.kode_instansi = kodeInstansi;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SyncKegiatan` (IN `kodeInstansi` VARCHAR(50), IN `kodeProgram` VARCHAR(50), IN `totalRinci` INT(11), IN `totalRekening` INT(11))  BEGIN
	UPDATE tb_program SET 
    tb_program.total_rinci = tb_program.total_rinci - totalRinci,
    tb_program.total_rekening = tb_program.total_rekening - totalRekening
    WHERE tb_program.kode_instansi = kodeInstansi
    AND tb_program.kode_program = kodeProgram;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SyncTotalRekening` (IN `kodeInstansi` VARCHAR(50), IN `kodeProgram` VARCHAR(50), IN `kodeKegiatan` VARCHAR(50), IN `totalRekening` INT(11), IN `totalRinci` INT(11))  NO SQL
BEGIN
	#Update table kegiatan
    UPDATE tb_kegiatan SET tb_kegiatan.total_rekening = 				tb_kegiatan.total_rekening - totalRekening,
    tb_kegiatan.total_rinci = tb_kegiatan.total_rinci - totalRinci
    WHERE tb_kegiatan.kode_instansi = kodeInstansi
    AND tb_kegiatan.kode_program = kodeProgram
    AND tb_kegiatan.kode_kegiatan = kodeKegiatan;
    
    #update table program
    UPDATE tb_program SET tb_program.total_rekening = 
    tb_program.total_rekening - totalRekening,
    tb_program.total_rinci = tb_program.total_rinci - totalRinci
    WHERE tb_program.kode_instansi = kodeInstansi
    AND tb_program.kode_program = kodeProgram;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SyncTotalRinci` (IN `kodeInstansi` VARCHAR(50), IN `kodeProgram` VARCHAR(50), IN `kodeKegiatan` VARCHAR(50), IN `kodeRekening` VARCHAR(50), OUT `resDetailRek` VARCHAR(50), OUT `resRek` VARCHAR(50), OUT `resKegiatan` VARCHAR(50))  BEGIN
	#Select Detail Rekening
	SELECT SUM(tb_detail_rekening.total) INTO resDetailRek
    FROM tb_detail_rekening 
    WHERE tb_detail_rekening.kode_instansi = kodeInstansi
    AND tb_detail_rekening.kode_program = kodeProgram
    AND tb_detail_rekening.kode_kegiatan = kodeKegiatan
    AND tb_detail_rekening.kode_rekening = kodeRekening;
    #Update Rekening
    UPDATE tb_rekening SET tb_rekening.total_rinci = resDetailRek
    WHERE tb_rekening.kode_instansi = kodeInstansi
    AND tb_rekening.kode_program = kodeProgram
    AND tb_rekening.kode_kegiatan = kodeKegiatan
    AND tb_rekening.kode_rekening = kodeRekening;
    
    #Select Rekening
    SELECT SUM(tb_rekening.total_rinci) INTO resRek
    FROM tb_rekening
	WHERE tb_rekening.kode_instansi = kodeInstansi
	AND tb_rekening.kode_program = kodeProgram
	AND tb_rekening.kode_kegiatan = kodeKegiatan;
    #Update Kegiatan
    UPDATE tb_kegiatan SET tb_kegiatan.total_rinci = resRek
    WHERE tb_kegiatan.kode_instansi = kodeInstansi
    AND tb_kegiatan.kode_program = kodeProgram
    AND tb_kegiatan.kode_kegiatan = kodeKegiatan;
    
    #Select Kegiatan
    SELECT SUM(tb_kegiatan.total_rinci) INTO resKegiatan
    FROM tb_kegiatan 
	WHERE tb_kegiatan.kode_instansi = kodeInstansi
	AND tb_kegiatan.kode_program = kodeProgram;
    #Update Kegiatan
    UPDATE tb_program SET tb_program.total_rinci = resKegiatan
	WHERE tb_program.kode_instansi = kodeInstansi
    AND tb_program.kode_program = kodeProgram;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateProgramSiswa` (IN `idSiswa` INT(4), IN `kodeProgram` VARCHAR(50), IN `kodeInstansi` VARCHAR(50), IN `oldKodeProgram` VARCHAR(50), IN `oldKodeInstansi` VARCHAR(50))  BEGIN

#Mengganti Program Siswa yang lama manjadi 0
UPDATE tb_program SET id_siswa = 0 
WHERE kode_instansi = oldKodeInstansi
AND kode_program = oldKodeProgram;

#Mengganti Program Siswa yang baru Menjadi milik idSiswa
UPDATE tb_program SET id_siswa = idSiswa
WHERE kode_instansi = kodeInstansi
AND kode_program = kodeProgram;

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id` int(11) NOT NULL,
  `kode_admin` varchar(10) NOT NULL,
  `hak_akses` int(1) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `foto` varchar(40) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`id`, `kode_admin`, `hak_akses`, `nama`, `foto`, `username`, `password`) VALUES
(1, '100.001', 1, 'Fauzan', 'ab534d4ea43e4459140761b195bd68bb.jpeg', 'admin', 'YWRtaW4=');

-- --------------------------------------------------------

--
-- Table structure for table `tb_detail_rekening`
--

CREATE TABLE `tb_detail_rekening` (
  `id` int(11) NOT NULL,
  `kode_detail_rekening` varchar(30) NOT NULL,
  `kode_instansi` varchar(30) NOT NULL,
  `kode_program` varchar(30) NOT NULL,
  `kode_kegiatan` varchar(30) NOT NULL,
  `kode_rekening` varchar(30) NOT NULL,
  `jenis` varchar(20) NOT NULL,
  `uraian` varchar(100) NOT NULL,
  `sub_uraian` varchar(100) NOT NULL,
  `sasaran` varchar(50) NOT NULL,
  `lokasi` varchar(100) NOT NULL,
  `dana` varchar(10) NOT NULL,
  `satuan` varchar(10) NOT NULL,
  `volume` int(3) NOT NULL,
  `harga` int(7) NOT NULL,
  `total` int(9) NOT NULL,
  `keterangan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_indikator`
--

CREATE TABLE `tb_indikator` (
  `id` int(3) NOT NULL,
  `kode_indikator` varchar(30) NOT NULL,
  `kode_instansi` varchar(30) NOT NULL,
  `kode_program` varchar(30) NOT NULL,
  `jenis` varchar(15) NOT NULL COMMENT '1. Capaian Program, 2.Hasil, 3.Pengeluaran, 4.masukan',
  `uraian` varchar(50) NOT NULL,
  `satuan` varchar(10) NOT NULL,
  `target` int(3) NOT NULL,
  `nilai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_instansi`
--

CREATE TABLE `tb_instansi` (
  `id` int(11) NOT NULL,
  `kode_admin` varchar(10) NOT NULL,
  `kode_instansi` varchar(30) NOT NULL,
  `hak_akses` int(1) NOT NULL,
  `nama_instansi` varchar(50) NOT NULL,
  `versi` varchar(20) NOT NULL,
  `kota_lokasi` varchar(15) NOT NULL,
  `keterangan` varchar(50) DEFAULT '-',
  `tahun` int(4) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  `foto` varchar(50) NOT NULL DEFAULT 'user.png'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_instansi`
--

INSERT INTO `tb_instansi` (`id`, `kode_admin`, `kode_instansi`, `hak_akses`, `nama_instansi`, `versi`, `kota_lokasi`, `keterangan`, `tahun`, `username`, `password`, `foto`) VALUES
(5, '100.001', '010.12983', 2, 'SMKN 2 Surabaya', '1', 'surabaya', NULL, 2091, 'joo', 'YWRtaW4=', 'user.png');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kegiatan`
--

CREATE TABLE `tb_kegiatan` (
  `id` int(11) NOT NULL,
  `kode_instansi` varchar(30) NOT NULL,
  `kode_program` varchar(30) NOT NULL,
  `kode_kegiatan` varchar(30) NOT NULL,
  `nama_kegiatan` varchar(40) NOT NULL,
  `total_rekening` int(11) NOT NULL DEFAULT '0',
  `total_rinci` int(11) NOT NULL DEFAULT '0',
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kegiatan`
--

INSERT INTO `tb_kegiatan` (`id`, `kode_instansi`, `kode_program`, `kode_kegiatan`, `nama_kegiatan`, `total_rekening`, `total_rinci`, `keterangan`) VALUES
(5, '010.12983', '127.12973', '080.23746', 'aljdnas', 0, 0, 'jasnd');

-- --------------------------------------------------------

--
-- Table structure for table `tb_patokan_rekening`
--

CREATE TABLE `tb_patokan_rekening` (
  `kode_patokan` varchar(10) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_patokan_rekening`
--

INSERT INTO `tb_patokan_rekening` (`kode_patokan`, `nama`) VALUES
('5', 'Belanja Daerah'),
('5.1', 'Belanja Tidak Langsung'),
('5.1.1', 'Belanja Pegawai'),
('5.2', 'Honorarium Kegiatan PNS'),
('5.2.1', 'Honorarium Kegiatan Non PNS'),
('5.2.2', 'Honorarium Pengelola Keuangan, Barang Daerah, dan Sistem Informasi PNS'),
('5.2.3', 'Honorarium Pegawai Tidak Tetap Non BLUD'),
('5.3', 'Belanja Alat Tulis Kantor'),
('5.3.1', 'Belanja Bahan Bakar Minyak/Gas/Pelumas Alat Operasional'),
('5.3.2', 'Belanja Akomodasi dan Konsumsi'),
('5.3.3', 'Belanja Jasa Dokumentasi dan Publikasi'),
('5.3.4', 'Belanja Jasa Narasumber/Tenaga Ahli'),
('5.3.5', 'Belanja iuran Jaminan Kesehatan/Kecelakaan Kerja/Kematian'),
('5.3.6', 'Belanja Cetak dan/atau Penggandaan'),
('5.3.7', 'Belanja makanan dan minuman rapat/kegiatan'),
('5.3.8', 'Belanja Barang Praktek dan Percontohan'),
('5.3.9', 'Belanja Langganan Multimedia'),
('5.4', 'Belanja Jasa Paket Pengiriman'),
('5.4.1', 'Belanja Jasa Outsourcing'),
('5.4.2', 'Belanja Jasa Dokumentasi dan Publikasi'),
('5.4.3', 'Belanja Jasa Dekorasi'),
('5.4.4', 'Belanja Jasa Cleaning Service'),
('5.4.5', 'Belanja Jasa Narasumber/Tenaga Ahli'),
('5.4.6', 'Belanja Pakaian Khusus'),
('5.5', 'Belanja Perjalanan Dinas Dalam Daerah'),
('5.5.1', 'Belanja Perjalanan Dinas Luar Daerah'),
('5.5.2', 'Belanja Pemeliharaan Peralatan dan Mesin'),
('5.5.3', 'Belanja Modal Pengadaan Peralatan dan/Perlengkapan Kantor'),
('5.5.4', 'Belanja Modal Pengadaan Alat-alat Studio');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pembahasan`
--

CREATE TABLE `tb_pembahasan` (
  `id` int(3) NOT NULL,
  `kode_pembahasan` varchar(30) NOT NULL,
  `kode_instansi` varchar(30) NOT NULL,
  `kode_program` varchar(30) NOT NULL,
  `kode_kegiatan` varchar(30) NOT NULL,
  `kode_rekening` varchar(30) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `nama_siswa` varchar(50) NOT NULL,
  `plafon` varchar(15) NOT NULL,
  `triwulan1_rekening` int(11) NOT NULL,
  `triwulan2_rekening` int(11) NOT NULL,
  `triwulan3_rekening` int(11) NOT NULL,
  `triwulan4_rekening` int(11) NOT NULL,
  `total_rekening` int(11) NOT NULL,
  `triwulan1_pembahasan` varchar(15) NOT NULL,
  `triwulan2_pembahasan` varchar(15) NOT NULL,
  `triwulan3_pembahasan` varchar(15) NOT NULL,
  `triwulan4_pembahasan` varchar(15) NOT NULL,
  `nilai` int(3) NOT NULL,
  `uraian` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_program`
--

CREATE TABLE `tb_program` (
  `id` int(11) NOT NULL,
  `kode_admin` varchar(10) NOT NULL,
  `id_siswa` int(11) DEFAULT NULL,
  `kode_instansi` varchar(30) NOT NULL,
  `kode_program` varchar(30) NOT NULL,
  `jenis` varchar(20) NOT NULL,
  `uraian` varchar(50) NOT NULL,
  `sasaran` varchar(50) NOT NULL,
  `nama_program` varchar(50) NOT NULL,
  `plafon` varchar(15) NOT NULL,
  `total_rinci` varchar(15) NOT NULL,
  `total_rekening` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_program`
--

INSERT INTO `tb_program` (`id`, `kode_admin`, `id_siswa`, `kode_instansi`, `kode_program`, `jenis`, `uraian`, `sasaran`, `nama_program`, `plafon`, `total_rinci`, `total_rekening`) VALUES
(5, '100.001', NULL, '010.12983', '127.12973', 'Baru', '-', '-', 'Program Baru', '5000000', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_registrasi`
--

CREATE TABLE `tb_registrasi` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `instansi` varchar(50) NOT NULL,
  `jurusan` varchar(20) NOT NULL,
  `nis` varchar(15) NOT NULL,
  `nisn` varchar(15) NOT NULL,
  `no_telp` varchar(14) NOT NULL,
  `username` varchar(15) NOT NULL,
  `foto` varchar(50) NOT NULL,
  `waktu` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_rekening`
--

CREATE TABLE `tb_rekening` (
  `id` int(11) NOT NULL,
  `kode_patokan` varchar(10) NOT NULL,
  `kode_instansi` varchar(30) NOT NULL,
  `kode_program` varchar(30) NOT NULL,
  `kode_kegiatan` varchar(30) NOT NULL,
  `kode_rekening` varchar(30) NOT NULL,
  `uraian_rekening` varchar(100) NOT NULL,
  `triwulan_1` int(11) DEFAULT '0',
  `triwulan_2` int(11) DEFAULT '0',
  `triwulan_3` int(11) DEFAULT '0',
  `triwulan_4` int(11) DEFAULT '0',
  `total` int(11) DEFAULT '0',
  `total_rinci` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_siswa`
--

CREATE TABLE `tb_siswa` (
  `id_siswa` int(11) NOT NULL,
  `kode_instansi` varchar(30) NOT NULL,
  `kode_program` varchar(30) NOT NULL,
  `hak_akses` int(1) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(32) NOT NULL,
  `nis` varchar(15) NOT NULL,
  `nisn` varchar(15) NOT NULL,
  `jurusan` varchar(50) NOT NULL,
  `nomor_hp` varchar(14) NOT NULL,
  `foto` varchar(40) NOT NULL DEFAULT 'user.png'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kode_admin` (`kode_admin`);

--
-- Indexes for table `tb_detail_rekening`
--
ALTER TABLE `tb_detail_rekening`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kode_rekening` (`kode_rekening`),
  ADD KEY `kode_instansi` (`kode_instansi`),
  ADD KEY `kode_program` (`kode_program`),
  ADD KEY `kode_kegiatan` (`kode_kegiatan`);

--
-- Indexes for table `tb_indikator`
--
ALTER TABLE `tb_indikator`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kode_indikator` (`kode_indikator`),
  ADD KEY `kode_instansi` (`kode_instansi`),
  ADD KEY `kode_program` (`kode_program`);

--
-- Indexes for table `tb_instansi`
--
ALTER TABLE `tb_instansi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_instansi` (`kode_instansi`),
  ADD KEY `kode_admin` (`kode_admin`);

--
-- Indexes for table `tb_kegiatan`
--
ALTER TABLE `tb_kegiatan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kode_instansi` (`kode_instansi`),
  ADD KEY `kode_program` (`kode_program`),
  ADD KEY `kode_kegiatan` (`kode_kegiatan`);

--
-- Indexes for table `tb_patokan_rekening`
--
ALTER TABLE `tb_patokan_rekening`
  ADD PRIMARY KEY (`kode_patokan`);

--
-- Indexes for table `tb_pembahasan`
--
ALTER TABLE `tb_pembahasan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kode_pembahasan` (`kode_pembahasan`),
  ADD KEY `kode_instansi` (`kode_instansi`),
  ADD KEY `kode_program` (`kode_program`),
  ADD KEY `id_siswa` (`id_siswa`),
  ADD KEY `kode_rekening` (`kode_rekening`),
  ADD KEY `kode_kegiatan` (`kode_kegiatan`);

--
-- Indexes for table `tb_program`
--
ALTER TABLE `tb_program`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kode_instansi` (`kode_instansi`),
  ADD KEY `id_siswa` (`id_siswa`),
  ADD KEY `kode_admin` (`kode_admin`),
  ADD KEY `kode_program` (`kode_program`);

--
-- Indexes for table `tb_registrasi`
--
ALTER TABLE `tb_registrasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kode_instansi` (`instansi`);

--
-- Indexes for table `tb_rekening`
--
ALTER TABLE `tb_rekening`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kode_kegiatan` (`kode_kegiatan`),
  ADD KEY `kode_patokan` (`kode_patokan`),
  ADD KEY `kode_rekening` (`kode_rekening`),
  ADD KEY `kode_instansi` (`kode_instansi`),
  ADD KEY `kode_program` (`kode_program`);

--
-- Indexes for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD PRIMARY KEY (`id_siswa`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `kode_program` (`kode_program`),
  ADD KEY `kode_instansi` (`kode_instansi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_detail_rekening`
--
ALTER TABLE `tb_detail_rekening`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_indikator`
--
ALTER TABLE `tb_indikator`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_instansi`
--
ALTER TABLE `tb_instansi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_kegiatan`
--
ALTER TABLE `tb_kegiatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_pembahasan`
--
ALTER TABLE `tb_pembahasan`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_program`
--
ALTER TABLE `tb_program`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_registrasi`
--
ALTER TABLE `tb_registrasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_rekening`
--
ALTER TABLE `tb_rekening`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_detail_rekening`
--
ALTER TABLE `tb_detail_rekening`
  ADD CONSTRAINT `tb_detail_rekening_ibfk_1` FOREIGN KEY (`kode_instansi`) REFERENCES `tb_instansi` (`kode_instansi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_indikator`
--
ALTER TABLE `tb_indikator`
  ADD CONSTRAINT `tb_indikator_ibfk_1` FOREIGN KEY (`kode_instansi`) REFERENCES `tb_instansi` (`kode_instansi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_instansi`
--
ALTER TABLE `tb_instansi`
  ADD CONSTRAINT `tb_instansi_ibfk_1` FOREIGN KEY (`kode_admin`) REFERENCES `tb_admin` (`kode_admin`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_kegiatan`
--
ALTER TABLE `tb_kegiatan`
  ADD CONSTRAINT `tb_kegiatan_ibfk_1` FOREIGN KEY (`kode_instansi`) REFERENCES `tb_instansi` (`kode_instansi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_pembahasan`
--
ALTER TABLE `tb_pembahasan`
  ADD CONSTRAINT `tb_pembahasan_ibfk_1` FOREIGN KEY (`kode_instansi`) REFERENCES `tb_instansi` (`kode_instansi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_program`
--
ALTER TABLE `tb_program`
  ADD CONSTRAINT `tb_program_ibfk_1` FOREIGN KEY (`kode_admin`) REFERENCES `tb_admin` (`kode_admin`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_program_ibfk_2` FOREIGN KEY (`kode_instansi`) REFERENCES `tb_instansi` (`kode_instansi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_program_ibfk_3` FOREIGN KEY (`id_siswa`) REFERENCES `tb_siswa` (`id_siswa`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `tb_rekening`
--
ALTER TABLE `tb_rekening`
  ADD CONSTRAINT `tb_rekening_ibfk_1` FOREIGN KEY (`kode_instansi`) REFERENCES `tb_instansi` (`kode_instansi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_rekening_ibfk_2` FOREIGN KEY (`kode_patokan`) REFERENCES `tb_patokan_rekening` (`kode_patokan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_rekening_ibfk_4` FOREIGN KEY (`kode_kegiatan`) REFERENCES `tb_kegiatan` (`kode_kegiatan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD CONSTRAINT `tb_siswa_ibfk_1` FOREIGN KEY (`kode_instansi`) REFERENCES `tb_instansi` (`kode_instansi`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
