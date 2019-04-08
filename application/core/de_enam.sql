-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 08 Apr 2019 pada 13.18
-- Versi Server: 10.1.28-MariaDB
-- PHP Version: 7.1.10

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
-- Prosedur
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
-- Struktur dari tabel `tb_admin`
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
-- Dumping data untuk tabel `tb_admin`
--

INSERT INTO `tb_admin` (`id`, `kode_admin`, `hak_akses`, `nama`, `foto`, `username`, `password`) VALUES
(1, '100.001', 1, 'Fauzan', 'ab534d4ea43e4459140761b195bd68bb.jpeg', 'admin', 'YWRtaW4=');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_detail_rekening`
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

--
-- Dumping data untuk tabel `tb_detail_rekening`
--

INSERT INTO `tb_detail_rekening` (`id`, `kode_detail_rekening`, `kode_instansi`, `kode_program`, `kode_kegiatan`, `kode_rekening`, `jenis`, `uraian`, `sub_uraian`, `sasaran`, `lokasi`, `dana`, `satuan`, `volume`, `harga`, `total`, `keterangan`) VALUES
(2, '5.3.2.01.01', '001', '127.001', '080.001', '5.3.2.01', '', 'Keperluan konsumsi untuk panitia selama acara', '(100 Org x 2 Hr x 3 Kl)', '', 'SMKN 2 Surabaya', '1', 'Paket', 10, 500000, 5000000, ''),
(3, '5.3.2.01.02', '001', '127.001', '080.001', '5.3.2.01', '', 'Keperluan konsumsi untuk peserta selama acara', '(100 Org x 2 Hr x 3 Kl)', '', 'SMKN 2 Surabaya', '1', 'Paket', 10, 500000, 5000000, ''),
(4, '5.3.2.01.03', '001', '127.001', '080.001', '5.3.2.01', '', 'Keperluan konsumsi untuk sponsor selama acara', '(100 Org x 2 Hr x 3 Kl)', 'SMKN 2 Surabaya', '', '1', 'Paket', 20, 500000, 10000000, ''),
(5, '5.3.6.01.01', '001', '127.001', '080.001', '5.3.6.01', '', 'Biaya cetak brosur acara', '(100 Org x 2 Hr x 3 Kl)', 'SMKN 2 Surabaya', '', '1', 'Lusin', 10, 400000, 4000000, ''),
(6, '5.3.6.01.02', '001', '127.001', '080.001', '5.3.6.01', '', 'Biaya cetak kupon untuk peserta', '(100 Org x 2 Hr x 3 Kl)', '', 'SMKN 2 Surabaya', '1', 'Lusin', 20, 50000, 1000000, ''),
(7, '5.3.6.01.03', '001', '127.001', '080.001', '5.3.6.01', '', 'Biaya cetak banner acara', '(100 Org x 2 Hr x 3 Kl)', '', 'SMKN 2 Surabaya', '1', 'Lusin', 10, 500000, 5000000, ''),
(8, '5.1.01.01', '001', '127.001', '080.001', '5.1.01', '', 'Beli serbuk warna untuk colour run', '(100 Org x 2 Hr x 3 Kl)', '', 'SMKN 2 Surabaya', '1', 'Paket', 10, 500000, 5000000, ''),
(9, '5.1.01.02', '001', '127.001', '080.001', '5.1.01', '', 'Biaya penggunaan listrik selama acara', '(100 Org x 2 Hr x 3 Kl)', '', 'SMKN 2 Surabaya', '1', 'Paket', 10, 500000, 5000000, ''),
(10, '5.1.01.03', '001', '127.001', '080.001', '5.1.01', '', 'Biaya penggunaan air selama acara', '(100 Org x 2 Hr x 3 Kl)', '', 'SMKN 2 Surabaya', '1', 'Paket', 20, 500000, 10000000, ''),
(11, '5.1.01.01', '001', '127.002', '080.001', '5.1.01', '', 'Biaya penggunaan listrik selama acara', '(100 Org x 2 Hr x 3 Kl)', '', 'SMKN 2 Surabaya', '1', 'Paket', 10, 500000, 5000000, ''),
(12, '5.1.01.02', '001', '127.002', '080.001', '5.1.01', '', 'Biaya penggunaan air selama acara', '(100 Org x 2 Hr x 3 Kl)', '', 'SMKN 2 Surabaya', '1', 'Paket', 10, 250000, 2500000, ''),
(13, '5.1.01.03', '001', '127.002', '080.001', '5.1.01', '', 'Pajak pokok sekolah', '(100 Org x 2 Hr x 3 Kl)', '', 'SMKN 2 Surabaya', '1', 'Paket', 10, 250000, 2500000, ''),
(14, '5.1.02.01', '001', '127.002', '080.001', '5.1.02', '', 'Belanja fasilitas untuk acara', '(100 Org x 2 Hr x 3 Kl)', '', 'SMKN 2 Surabaya', '1', 'Paket', 10, 200000, 2000000, ''),
(15, '5.1.02.02', '001', '127.002', '080.001', '5.1.02', '', 'Biaya kebersihan setelah acara', '(100 Org x 2 Hr x 3 Kl)', '', 'SMKN 2 Surabaya', '1', 'Paket', 10, 200000, 2000000, ''),
(16, '5.1.02.03', '001', '127.002', '080.001', '5.1.02', '', 'Biaya sewa polisi untuk keamanan acara', '(100 Org x 2 Hr x 3 Kl)', '', 'SMKN 2 Surabaya', '1', 'Paket', 10, 200000, 2000000, ''),
(17, '5.1.03.01', '001', '127.002', '080.001', '5.1.03', '', 'Belanja kostum guru untuk hari pahlawan', '(100 Org x 2 Hr x 3 Kl)', '', 'SMKN 2 Surabaya', '1', 'Paket', 10, 200000, 2000000, ''),
(18, '5.1.03.02', '001', '127.002', '080.001', '5.1.03', '', 'Belanja hadiah bagi pemenang lomba', '(100 Org x 2 Hr x 3 Kl)', '', 'SMKN 2 Surabaya', '1', 'Paket', 10, 200000, 2000000, ''),
(19, '5.1.01.01', '001', '127.002', '080.002', '5.1.01', '', 'Biaya penggunaan listrik selama acara', '(100 Org x 2 Hr x 3 Kl)', '', 'SMKN 2 Surabaya', '1', 'Paket', 10, 500000, 5000000, ''),
(20, '5.1.01.02', '001', '127.002', '080.002', '5.1.01', '', 'Biaya penggunaan air selama acara', '(100 Org x 2 Hr x 3 Kl)', '', 'SMKN 2 Surabaya', '1', 'Paket', 10, 500000, 5000000, ''),
(21, '5.1.01.03', '001', '127.002', '080.002', '5.1.01', '', 'Pajak pokok sekolah', '(100 Org x 2 Hr x 3 Kl)', '', 'SMKN 2 Surabaya', '1', 'Paket', 20, 500000, 10000000, ''),
(22, '5.1.02.01', '001', '127.002', '080.002', '5.1.02', '', 'Biaya untuk tamu undangan', '(100 Org x 2 Hr x 3 Kl)', '', 'SMKN 2 Surabaya', '1', 'Paket', 10, 200000, 2000000, ''),
(23, '5.1.02.02', '001', '127.002', '080.002', '5.1.02', '', 'Biaya untuk mengundang sponsor', '(100 Org x 2 Hr x 3 Kl)', '', 'SMKN 2 Surabaya', '1', 'Paket', 10, 400000, 4000000, ''),
(24, '5.1.02.03', '001', '127.002', '080.002', '5.1.02', '', 'Pajak Bumi dan Bangunan', '(100 Org x 2 Hr x 3 Kl)', 'SMKN 2 Surabaya', '', '1', 'Paket', 10, 200000, 2000000, ''),
(25, '5.1.01.01', '001', '127.003', '080.001', '5.1.01', '', 'Listrik acara', '(100 Org x 2 Hr x 3 Kl)', '', 'SMKN 2 Surabaya', '1', 'Paket', 10, 500000, 5000000, ''),
(26, '5.1.01.02', '001', '127.003', '080.001', '5.1.01', '', 'Air Acarra', '(100 Org x 2 Hr x 3 Kl)', '', 'SMKN 2 Surabaya', '1', 'Paket', 10, 250000, 2500000, ''),
(27, '5.1.01.03', '001', '127.003', '080.001', '5.1.01', '', 'Biaya Belanja Acara', '(100 Org x 2 Hr x 3 Kl)', '', 'SMKN 2 Surabaya', '1', 'Paket', 10, 250000, 2500000, ''),
(28, '5.1.02.01', '001', '127.003', '080.001', '5.1.02', '', 'Konsumsi Acara', '(100 Org x 2 Hr x 3 Kl)', '', 'SMKN 2 Surabaya', '1', 'Paket', 10, 250000, 2500000, ''),
(29, '5.1.02.02', '001', '127.003', '080.001', '5.1.02', '', 'Konsumsi Panitia Acara', '(100 Org x 2 Hr x 3 Kl)', '', 'SMKN 2 Surabaya', '1', 'Paket', 10, 125000, 1250000, ''),
(30, '5.1.02.03', '001', '127.003', '080.001', '5.1.02', '', 'Konsumsi sponsor acara', '(100 Org x 2 Hr x 3 Kl)', '', 'SMKN 2 Surabaya', '1', 'Paket', 10, 125000, 1250000, ''),
(31, '5.1.03.01', '001', '127.003', '080.001', '5.1.03', '', 'Pajak Sekolah', '(100 Org x 2 Hr x 3 Kl)', '', 'SMKN 2 Surabaya', '1', 'Paket', 10, 250000, 2500000, ''),
(32, '5.1.03.02', '001', '127.003', '080.001', '5.1.03', '', 'Pajak PBB', '(100 Org x 2 Hr x 3 Kl)', '', 'SMKN 2 Surabaya', '1', 'Paket', 10, 125000, 1250000, ''),
(33, '5.1.03.03', '001', '127.003', '080.001', '5.1.03', '', 'Pajak NPWP', '(100 Org x 2 Hr x 3 Kl)', '', '', '1', 'Paket', 10, 125000, 1250000, ''),
(34, '5.1.1.01.01', '001', '127.003', '080.002', '5.1.1.01', '', 'Pegawai sekolah', '(100 Org x 2 Hr x 3 Kl)', '', 'SMKN 2 Surabaya', '1', 'Paket', 10, 500000, 5000000, ''),
(35, '5.1.1.01.02', '001', '127.003', '080.002', '5.1.1.01', '', 'Pegawai Tu', '(100 Org x 2 Hr x 3 Kl)', '', 'SMKN 2 Surabaya', '1', 'Paket', 10, 250000, 2500000, ''),
(36, '5.1.1.01.03', '001', '127.003', '080.002', '5.1.1.01', '', 'Pegawai honorer', '(100 Org x 2 Hr x 3 Kl)', '', 'SMKN 2 Surabaya', '1', 'BLN', 10, 250000, 2500000, ''),
(37, '5.1.1.02.01', '001', '127.003', '080.002', '5.1.1.02', '', 'Biaya Guest Star', '(100 Org x 2 Hr x 3 Kl)', '', 'SMKN 2 Surabaya', '1', 'OH', 10, 250000, 2500000, ''),
(38, '5.1.1.02.02', '001', '127.003', '080.002', '5.1.1.02', '', 'Biaya Sponsor', '(100 Org x 2 Hr x 3 Kl)', '', 'SMKN 2 Surabaya', '1', 'OH', 10, 125000, 1250000, ''),
(39, '5.1.1.02.03', '001', '127.003', '080.002', '5.1.1.02', '', 'Biaya Panitia', '(100 Org x 2 Hr x 3 Kl)', '', 'SMKN 2 Surabaya', '1', 'OH', 10, 125000, 1250000, ''),
(40, '5.4.3.01.01', '001', '127.003', '080.003', '5.4.3.01', '', 'Dekorasi panggung', '(100 Org x 2 Hr x 3 Kl)', '', 'SMKN 2 Surabaya', '1', 'Paket', 10, 300000, 3000000, ''),
(41, '5.4.3.01.02', '001', '127.003', '080.003', '5.4.3.01', '', 'Dekorasi Aula', '(100 Org x 2 Hr x 3 Kl)', '', 'SMKN 2 Surabaya', '1', 'Paket', 10, 100000, 1000000, ''),
(42, '5.4.3.01.03', '001', '127.003', '080.003', '5.4.3.01', '', 'Dekorasi Lapangan', '(100 Org x 2 Hr x 3 Kl)', '', 'SMKN 2 Surabaya', '1', 'Paket', 10, 100000, 1000000, ''),
(43, '5.3.6.01.01', '001', '127.003', '080.003', '5.3.6.01', '', 'Cetak Pamflet', '(100 Org x 2 Hr x 3 Kl)', '', 'SMKN 2 Surabaya', '1', 'Paket', 10, 300000, 3000000, ''),
(44, '5.3.6.01.02', '001', '127.003', '080.003', '5.3.6.01', '', 'Cetak banner', '(100 Org x 2 Hr x 3 Kl)', '', 'SMKN 2 Surabaya', '1', 'Paket', 10, 100000, 1000000, ''),
(45, '5.3.6.01.03', '001', '127.003', '080.003', '5.3.6.01', '', 'Cetak Brosur', '(100 Org x 2 Hr x 3 Kl)', '', 'SMKN 2 Surabaya', '1', 'Paket', 10, 100000, 1000000, ''),
(46, '5.4.01.01', '001', '127.003', '080.003', '5.4.01', '', 'Pengiriman JNE', '(100 Org x 2 Hr x 3 Kl)', '', 'SMKN 2 Surabaya', '1', 'Paket', 10, 300000, 3000000, ''),
(47, '5.4.01.02', '001', '127.003', '080.003', '5.4.01', '', 'Pengiriman PostIndo', '(100 Org x 2 Hr x 3 Kl)', '', 'SMKN 2 Surabaya', '1', 'Paket', 10, 100000, 1000000, ''),
(48, '5.4.01.03', '001', '127.003', '080.003', '5.4.01', '', 'Pengiriman JTE', '(100 Org x 2 Hr x 3 Kl)', '', 'SMKN 2 Surabaya', '1', 'Paket', 10, 100000, 1000000, ''),
(49, '5.1.1.01.01', '010.002', '127.001', '080.001', '5.1.1.01', '', 'Biaya Penyeleksi SNMPTN', '(100 Org x 2 Hr x 3 Kl)', '', 'SMKN 2 Surabaya', '1', 'Paket', 10, 500000, 5000000, ''),
(50, '5.1.1.01.02', '010.002', '127.001', '080.001', '5.1.1.01', '', 'Biaya Panitia SNMPTN', '(100 Org x 2 Hr x 3 Kl)', '', 'ITS', '1', 'Paket', 10, 250000, 2500000, ''),
(51, '5.1.1.01.03', '010.002', '127.001', '080.001', '5.1.1.01', '', 'Biaya fasilitas SNMPTN', '(100 Org x 2 Hr x 3 Kl)', '', 'ITS', '1', 'Paket', 10, 250000, 2500000, ''),
(52, '5.1.1.02.01', '010.002', '127.001', '080.001', '5.1.1.02', '', 'Biaya Pokok SNMPTN', '(100 Org x 2 Hr x 3 Kl)', 'ITS', '', '1', 'Paket', 10, 200000, 2000000, ''),
(53, '5.1.1.02.02', '010.002', '127.001', '080.001', '5.1.1.02', '', 'Biaya Sampingan SNMPTN', '(100 Org x 2 Hr x 3 Kl)', '', 'ITS', '1', 'Paket', 10, 200000, 2000000, ''),
(54, '5.1.1.02.03', '010.002', '127.001', '080.001', '5.1.1.02', '', 'Biaya tersier snmptn', '(100 Org x 2 Hr x 3 Kl)', '', 'ITS', '1', 'Paket', 10, 100000, 1000000, ''),
(55, '5.1.1.03.01', '010.002', '127.001', '080.001', '5.1.1.03', '', 'rata rata biaya snmptn', '(100 Org x 2 Hr x 3 Kl)', '', 'ITS', '1', 'Paket', 10, 200000, 2000000, ''),
(56, '5.1.1.03.02', '010.002', '127.001', '080.001', '5.1.1.03', '', 'max untuk snmptn', '(100 Org x 2 Hr x 3 Kl)', '', 'ITS', '1', 'Paket', 10, 200000, 2000000, ''),
(57, '5.1.1.03.03', '010.002', '127.001', '080.001', '5.1.1.03', '', 'Min biaya snmptn', '(100 Org x 2 Hr x 3 Kl)', '', 'ITS', '1', 'Paket', 10, 100000, 1000000, ''),
(58, '5.2.01.01', '010.002', '127.001', '080.002', '5.2.01', '', 'PNS SNMPTN', '(100 Org x 2 Hr x 3 Kl)', '', 'ITS', '1', 'Paket', 10, 500000, 5000000, ''),
(59, '5.2.01.02', '010.002', '127.001', '080.002', '5.2.01', '', 'PNS Lama snmptn', '(100 Org x 2 Hr x 3 Kl)', '', 'ITS', '1', 'Paket', 10, 250000, 2500000, ''),
(60, '5.2.01.03', '010.002', '127.001', '080.002', '5.2.01', '', 'PNS Baru snmptn', '(100 Org x 2 Hr x 3 Kl)', '', 'ITS', '1', 'Paket', 10, 250000, 2500000, ''),
(61, '5.2.02.01', '010.002', '127.001', '080.002', '5.2.02', '', 'Calon PNS SNMPTN', '(100 Org x 2 Hr x 3 Kl)', '', 'ITS', '1', 'Paket', 10, 300000, 3000000, ''),
(62, '5.2.02.02', '010.002', '127.001', '080.002', '5.2.02', '', 'Calon PNS SNMPTN Lama', '(100 Org x 2 Hr x 3 Kl)', '', 'ITS', '1', 'Paket', 10, 100000, 1000000, ''),
(63, '5.2.02.03', '010.002', '127.001', '080.002', '5.2.02', '', 'Calon PNS SNMPTN baru', '(100 Org x 2 Hr x 3 Kl)', '', 'ITS', '1', 'Paket', 10, 100000, 1000000, ''),
(64, '5.2.03.01', '010.002', '127.001', '080.002', '5.2.03', '', 'Dosen penyeleksi snmptn', '(100 Org x 2 Hr x 3 Kl)', '', 'ITS', '1', 'Paket', 10, 300000, 3000000, ''),
(65, '5.2.03.02', '010.002', '127.001', '080.002', '5.2.03', '', 'Dosen penyeleksi snmptn baru', '(100 Org x 2 Hr x 3 Kl)', '', 'ITS', '1', 'Paket', 10, 100000, 1000000, ''),
(66, '5.2.03.03', '010.002', '127.001', '080.002', '5.2.03', '', 'Dosen penyeleksi snmptn lama', '(100 Org x 2 Hr x 3 Kl)', '', 'ITS', '1', 'Paket', 10, 100000, 1000000, ''),
(67, '5.2.1.01.01', '010.002', '127.001', '080.003', '5.2.1.01', '', 'Dosen non PNS snmptn', '(100 Org x 2 Hr x 3 Kl)', '', 'ITS', '1', 'Paket', 10, 300000, 3000000, ''),
(68, '5.2.1.01.02', '010.002', '127.001', '080.003', '5.2.1.01', '', 'Dosen non PNS snmptn lama', '(100 Org x 2 Hr x 3 Kl)', '', 'ITS', '1', 'Paket', 10, 100000, 1000000, ''),
(69, '5.2.1.01.03', '010.002', '127.001', '080.003', '5.2.1.01', '', 'Dosen non PNS snmptn baru', '(100 Org x 2 Hr x 3 Kl)', '', 'ITS', '1', 'Paket', 10, 100000, 1000000, ''),
(70, '5.2.1.02.01', '010.002', '127.001', '080.003', '5.2.1.02', '', 'Petugas Laboratorium material', '(100 Org x 2 Hr x 3 Kl)', '', 'ITS', '1', 'Paket', 10, 100000, 1000000, ''),
(71, '5.2.1.02.02', '010.002', '127.001', '080.003', '5.2.1.02', '', 'Petugas Laboratorium kimia', '(100 Org x 2 Hr x 3 Kl)', '', 'ITS', '1', 'Paket', 10, 100000, 1000000, ''),
(72, '5.2.1.02.03', '010.002', '127.001', '080.003', '5.2.1.02', '', 'Petugas Laboratorium kimia murni', '(100 Org x 2 Hr x 3 Kl)', '', 'ITS', '1', 'Paket', 10, 100000, 1000000, ''),
(73, '5.2.1.03.01', '010.002', '127.001', '080.003', '5.2.1.03', '', 'Petugas Sidang Skirpsi', '(100 Org x 2 Hr x 3 Kl)', '', 'ITS', '1', 'Paket', 10, 100000, 1000000, ''),
(74, '5.2.1.03.02', '010.002', '127.001', '080.003', '5.2.1.03', '', 'Petugas Sidang Skirpsi statistika', '(100 Org x 2 Hr x 3 Kl)', '', 'ITS', '1', 'Paket', 10, 50000, 500000, ''),
(75, '5.2.1.03.03', '010.002', '127.001', '080.003', '5.2.1.03', '', 'Petugas Sidang Skirpsi statistika murni', '(100 Org x 2 Hr x 3 Kl)', '', 'ITS', '1', 'Paket', 10, 50000, 500000, ''),
(76, '5.2.2.01.01', '010.002', '127.002', '080.001', '5.2.2.01', '', 'Detail Rekening Penyelenggaraan UTBK', '(100 Org x 2 Hr x 3 Kl)', '', 'ITS', '1', 'Paket', 10, 500000, 5000000, ''),
(77, '5.2.2.01.02', '010.002', '127.002', '080.001', '5.2.2.01', '', 'Detail Rekening Penyelenggaraan UTBK kedua', '(100 Org x 2 Hr x 3 Kl)', '', 'ITS', '1', 'Paket', 10, 250000, 2500000, ''),
(78, '5.2.2.01.03', '010.002', '127.002', '080.001', '5.2.2.01', '', 'Detail Rekening Penyelenggaraan UTBK ketiga', '(100 Org x 2 Hr x 3 Kl)', '', 'ITS', '1', 'Paket', 10, 250000, 2500000, ''),
(79, '5.2.2.02.01', '010.002', '127.002', '080.001', '5.2.2.02', '', 'Honor Detail Rekening Penyelenggaraan UTBK', '(100 Org x 2 Hr x 3 Kl)', '', 'ITS', '1', 'Paket', 10, 300000, 3000000, ''),
(80, '5.2.2.02.02', '010.002', '127.002', '080.001', '5.2.2.02', '', 'Honor Detail Rekening Penyelenggaraan UTBK kedua', '(100 Org x 2 Hr x 3 Kl)', '', 'ITS', '1', 'Paket', 10, 100000, 1000000, ''),
(81, '5.2.2.02.03', '010.002', '127.002', '080.001', '5.2.2.02', '', 'Honor Detail Rekening Penyelenggaraan UTBK ketiga', '(100 Org x 2 Hr x 3 Kl)', '', 'ITS', '1', 'Paket', 10, 100000, 1000000, ''),
(82, '5.2.2.03.01', '010.002', '127.002', '080.001', '5.2.2.03', '', 'Pengadaan acara UTBK selama tahun 2019', '(100 Org x 2 Hr x 3 Kl)', '', 'ITS', '1', 'Paket', 10, 300000, 3000000, ''),
(83, '5.2.2.03.02', '010.002', '127.002', '080.001', '5.2.2.03', '', 'Pengadaan acara UTBK selama tahun 2019 Kedua', '(100 Org x 2 Hr x 3 Kl)', '', 'ITS', '1', 'Paket', 10, 100000, 1000000, ''),
(84, '5.2.2.03.03', '010.002', '127.002', '080.001', '5.2.2.03', '', 'Pengadaan acara UTBK selama tahun 2019 Ketiga', '(100 Org x 2 Hr x 3 Kl)', '', 'ITS', '1', 'Paket', 10, 100000, 1000000, ''),
(85, '5.3.4.01.01', '010.002', '127.002', '080.002', '5.3.4.01', '', 'Biaya Narasumber Untuk UTBK', '(100 Org x 2 Hr x 3 Kl)', '', 'ITS', '1', 'Paket', 10, 500000, 5000000, ''),
(86, '5.3.4.01.02', '010.002', '127.002', '080.002', '5.3.4.01', '', 'Biaya Narasumber Untuk UTBK kedua', '(100 Org x 2 Hr x 3 Kl)', '', 'ITS', '1', 'Paket', 10, 250000, 2500000, ''),
(87, '5.3.4.01.03', '010.002', '127.002', '080.002', '5.3.4.01', '', 'Biaya Narasumber Untuk UTBK Ketiga', '(100 Org x 2 Hr x 3 Kl)', '', 'ITS', '1', 'Paket', 10, 250000, 2500000, ''),
(88, '5.3.4.02.01', '010.002', '127.002', '080.002', '5.3.4.02', '', 'Biaya Tenaga Ahli UTBK', '(100 Org x 2 Hr x 3 Kl)', '', 'ITS', '1', 'Paket', 10, 300000, 3000000, ''),
(89, '5.3.4.02.02', '010.002', '127.002', '080.002', '5.3.4.02', '', 'Biaya Tenaga Ahli UTBK Kedua', '(100 Org x 2 Hr x 3 Kl)', '', 'ITS', '1', 'Paket', 10, 100000, 1000000, ''),
(90, '5.3.4.02.03', '010.002', '127.002', '080.002', '5.3.4.02', '', 'Biaya Tenaga Ahli UTBK Ketiga', '(100 Org x 2 Hr x 3 Kl)', '', 'ITS', '1', 'Paket', 10, 100000, 1000000, ''),
(91, '5.3.4.03.01', '010.002', '127.002', '080.002', '5.3.4.03', '', 'Biaya Proktor UTBK', '(100 Org x 2 Hr x 3 Kl)', '', 'ITS', '1', 'Paket', 10, 300000, 3000000, ''),
(92, '5.3.4.03.02', '010.002', '127.002', '080.002', '5.3.4.03', '', 'Biaya Proktor UTBK Kedua', '(100 Org x 2 Hr x 3 Kl)', '', 'ITS', '1', 'Paket', 10, 100000, 1000000, ''),
(93, '5.3.4.03.03', '010.002', '127.002', '080.002', '5.3.4.03', '', 'Biaya Proktor UTBK Ketiga', '(100 Org x 2 Hr x 3 Kl)', '', 'ITS', '1', 'Paket', 10, 100000, 1000000, ''),
(94, '5.3.9.01.01', '010.002', '127.002', '080.003', '5.3.9.01', '', 'Biaya Sewa Multimedia selama UTBK', '(100 Org x 2 Hr x 3 Kl)', '', 'ITS', '1', 'Paket', 10, 300000, 3000000, ''),
(95, '5.3.9.01.02', '010.002', '127.002', '080.003', '5.3.9.01', '', 'Biaya Sewa Multimedia selama UTBK kedua', '(100 Org x 2 Hr x 3 Kl)', '', 'ITS', '1', 'Paket', 10, 100000, 1000000, ''),
(96, '5.3.9.01.03', '010.002', '127.002', '080.003', '5.3.9.01', '', 'Biaya Sewa Multimedia selama UTBK Ketiga', '(100 Org x 2 Hr x 3 Kl)', '', 'ITS', '1', 'Paket', 10, 100000, 1000000, ''),
(97, '5.5.4.01.01', '010.002', '127.002', '080.003', '5.5.4.01', '', 'Biaya Sewa alat alat studio selama UTBK', '(100 Org x 2 Hr x 3 Kl)', '', 'ITS', '1', 'Paket', 10, 100000, 1000000, ''),
(98, '5.5.4.01.02', '010.002', '127.002', '080.003', '5.5.4.01', '', 'Biaya Sewa alat alat studio selama UTBK kedua', '(100 Org x 2 Hr x 3 Kl)', '', 'ITS', '1', 'Paket', 10, 50000, 500000, ''),
(99, '5.5.4.01.03', '010.002', '127.002', '080.003', '5.5.4.01', '', 'Biaya Sewa alat alat studio selama UTBK ketiga', '(12 Bln x 1 Org)', '', 'ITS', '1', 'Paket', 10, 50000, 500000, ''),
(100, '5.3.5.01.01', '010.002', '127.002', '080.003', '5.3.5.01', '', 'Biaya asuransi selama UTBK', '(100 Org x 2 Hr x 3 Kl)', '', 'ITS', '1', 'Paket', 10, 100000, 1000000, ''),
(101, '5.3.5.01.02', '010.002', '127.002', '080.003', '5.3.5.01', '', 'Biaya asuransi selama UTBK Kedua', '(100 Org x 2 Hr x 3 Kl)', '', 'ITS', '1', 'Paket', 10, 100000, 1000000, ''),
(102, '5.3.5.01.03', '010.002', '127.002', '080.003', '5.3.5.01', '', 'Biaya asuransi selama UTBK ketiga', '(100 Org x 2 Hr x 3 Kl)', '', 'ITS', '1', 'Paket', 10, 100000, 1000000, ''),
(103, '5.4.1.01.01', '010.002', '127.003', '080.001', '5.4.1.01', '', 'Biaya Pembukaan jalur Mandiri', '(100 Org x 2 Hr x 3 Kl)', '', 'ITS', '1', 'Paket', 10, 500000, 5000000, ''),
(104, '5.4.1.01.02', '010.002', '127.003', '080.001', '5.4.1.01', '', 'Biaya Pembukaan jalur Mandiri kedua', '(100 Org x 2 Hr x 3 Kl)', '', 'ITS', '1', 'Paket', 10, 250000, 2500000, ''),
(105, '5.4.1.01.03', '010.002', '127.003', '080.001', '5.4.1.01', '', 'Biaya Pembukaan jalur Mandiri ketiga', '(100 Org x 2 Hr x 3 Kl)', '', 'ITS', '1', 'Paket', 10, 250000, 2500000, ''),
(106, '5.4.1.02.01', '010.002', '127.003', '080.001', '5.4.1.02', '', 'Biaya penyelenggaraan jalur mandiri', '(100 Org x 2 Hr x 3 Kl)', '', 'ITS', '1', 'Paket', 10, 300000, 3000000, ''),
(107, '5.4.1.02.02', '010.002', '127.003', '080.001', '5.4.1.02', '', 'Biaya penyelenggaraan jalur mandiri kedua', '(100 Org x 2 Hr x 3 Kl)', '', 'ITS', '1', 'Paket', 10, 100000, 1000000, ''),
(108, '5.4.1.02.03', '010.002', '127.003', '080.001', '5.4.1.02', '', 'Biaya penyelenggaraan jalur mandiri ketiga', '(100 Org x 2 Hr x 3 Kl)', '', 'ITS', '1', 'Paket', 10, 100000, 1000000, ''),
(109, '5.4.1.03.01', '010.002', '127.003', '080.001', '5.4.1.03', '', 'biaya jasa outsourcing jalur mandiri', '(100 Org x 2 Hr x 3 Kl)', '', 'ITS', '1', 'Paket', 10, 300000, 3000000, ''),
(110, '5.4.1.03.02', '010.002', '127.003', '080.001', '5.4.1.03', '', 'biaya jasa outsourcing jalur mandiri kedua', '(100 Org x 2 Hr x 3 Kl)', 'ITS', '', '1', 'Paket', 10, 100000, 1000000, ''),
(111, '5.4.1.03.03', '010.002', '127.003', '080.001', '5.4.1.03', '', 'biaya jasa outsourcing jalur mandiri ketiga', '(100 Org x 2 Hr x 3 Kl)', '', 'ITS', '1', 'Paket', 10, 100000, 1000000, ''),
(112, '5.5.3.01.01', '010.002', '127.003', '080.002', '5.5.3.01', '', 'biaya tes jalur mandiri', '(100 Org x 2 Hr x 3 Kl)', '', 'ITS', '1', 'Paket', 10, 500000, 5000000, ''),
(113, '5.5.3.01.02', '010.002', '127.003', '080.002', '5.5.3.01', '', 'biaya tes jalur mandiri kedua', '(100 Org x 2 Hr x 3 Kl)', '', 'ITS', '1', 'Paket', 10, 300000, 3000000, ''),
(114, '5.5.3.01.03', '010.002', '127.003', '080.002', '5.5.3.01', '', 'biaya tes jalur mandiri ketiga', '(100 Org x 2 Hr x 3 Kl)', '', 'ITS', '1', 'Paket', 10, 200000, 2000000, ''),
(115, '5.4.6.01.01', '010.002', '127.003', '080.002', '5.4.6.01', '', 'pakaian khusus panitia jalur mandiri', '(100 Org x 2 Hr x 3 Kl)', '', 'ITS', '1', 'Paket', 10, 300000, 3000000, ''),
(116, '5.4.6.01.02', '010.002', '127.003', '080.002', '5.4.6.01', '', 'pakaian khusus panitia jalur mandiri kedua', '(100 Org x 2 Hr x 3 Kl)', '', 'ITS', '1', 'Paket', 10, 100000, 1000000, ''),
(117, '5.4.6.01.03', '010.002', '127.003', '080.002', '5.4.6.01', '', 'pakaian khusus panitia jalur mandiri ketiga', '(100 Org x 2 Hr x 3 Kl)', '', 'ITS', '1', 'Paket', 10, 100000, 1000000, ''),
(118, '5.5.3.02.01', '010.002', '127.003', '080.002', '5.5.3.02', '', 'peralatan dan perlengkapan tes jalur mandiri', '(100 Org x 2 Hr x 3 Kl)', '', 'ITS', '1', 'Paket', 10, 300000, 3000000, ''),
(119, '5.5.3.02.02', '010.002', '127.003', '080.002', '5.5.3.02', '', 'peralatan dan perlengkapan tes jalur mandiri kedua', '(100 Org x 2 Hr x 3 Kl)', '', 'ITS', '1', 'Paket', 10, 100000, 1000000, ''),
(120, '5.5.3.02.03', '010.002', '127.003', '080.002', '5.5.3.02', '', 'peralatan dan perlengkapan tes jalur mandiri ketiga', '(100 Org x 2 Hr x 3 Kl)', '', 'ITS', '1', 'Paket', 10, 100000, 1000000, ''),
(121, '5.5.2.01.01', '010.002', '127.003', '080.003', '5.5.2.01', '', 'pemeliharaan komputer untuk ujian jalur mandiri', '(100 Org x 2 Hr x 3 Kl)', '', 'ITS', '1', 'Paket', 10, 300000, 3000000, ''),
(122, '5.5.2.01.02', '010.002', '127.003', '080.003', '5.5.2.01', '', 'pemeliharaan komputer untuk ujian jalur mandiri kedua', '(100 Org x 2 Hr x 3 Kl)', '', 'ITS', '1', 'Paket', 10, 100000, 1000000, ''),
(123, '5.5.2.01.03', '010.002', '127.003', '080.003', '5.5.2.01', '', 'pemeliharaan komputer untuk ujian jalur mandiri ketiga', '(100 Org x 2 Hr x 3 Kl)', '', 'ITS', '1', 'Paket', 10, 100000, 1000000, ''),
(124, '5.5.2.02.01', '010.002', '127.003', '080.003', '5.5.2.02', '', 'Biaya perawatan CPU untuk ujian jalur mandiri', '(12 Bln x 1 Org)', '', 'ITS', '1', 'Paket', 10, 100000, 1000000, ''),
(125, '5.5.2.02.02', '010.002', '127.003', '080.003', '5.5.2.02', '', 'Biaya perawatan CPU untuk ujian jalur mandiri kedua', '(100 Org x 2 Hr x 3 Kl)', '', 'ITS', '1', 'Paket', 10, 100000, 1000000, ''),
(126, '5.5.2.02.03', '010.002', '127.003', '080.003', '5.5.2.02', '', 'Biaya perawatan CPU untuk ujian jalur mandiri ketiga', '(100 Org x 2 Hr x 3 Kl)', '', 'ITS', '1', 'Paket', 10, 100000, 1000000, ''),
(127, '5.5.2.03.01', '010.002', '127.003', '080.003', '5.5.2.03', '', 'perawatan ruang ujian jalur mandiri', '(100 Org x 2 Hr x 3 Kl)', '', 'ITS', '1', 'Paket', 10, 100000, 1000000, ''),
(128, '5.5.2.03.02', '010.002', '127.003', '080.003', '5.5.2.03', '', 'perawatan ruang ujian jalur mandiri kedua', '(100 Org x 2 Hr x 3 Kl)', '', 'ITS', '1', 'Paket', 10, 50000, 500000, ''),
(129, '5.5.2.03.03', '010.002', '127.003', '080.003', '5.5.2.03', '', 'perawatan ruang ujian jalur mandiri ketiga', '(100 Org x 2 Hr x 3 Kl)', '', 'ITS', '1', 'Paket', 10, 50000, 500000, ''),
(130, '5.01.01', '010.003', '127.001', '080.001', '5.01', '', 'Biaya uang gedung universitas waseda', '(100 Org x 2 Hr x 3 Kl)', '', 'Waseda', '1', 'Paket', 10, 10000000, 100000000, ''),
(131, '5.01.02', '010.003', '127.001', '080.001', '5.01', '', 'Biaya uang pangkal masuk universitas waseda', '(100 Org x 2 Hr x 3 Kl)', '', 'Waseda', '1', 'Paket', 10, 5000000, 50000000, ''),
(132, '5.01.03', '010.003', '127.001', '080.001', '5.01', '', 'Biaya uang per semester universitas waseda', '(100 Org x 2 Hr x 3 Kl)', '', 'Waseda', '1', 'Paket', 10, 5000000, 50000000, ''),
(133, '5.03.01', '010.003', '127.001', '080.001', '5.03', '', 'Biaya uang Dorm sekitar universitas waseda', '(100 Org x 2 Hr x 3 Kl)', '', 'Waseda', '1', 'Paket', 10, 2000000, 20000000, ''),
(134, '5.03.02', '010.003', '127.001', '080.001', '5.03', '', 'Biaya uang makan per bulan di Dorm', '(100 Org x 2 Hr x 3 Kl)', '', 'Waseda', '1', 'Paket', 10, 2000000, 20000000, ''),
(135, '5.03.03', '010.003', '127.001', '080.001', '5.03', '', 'Biaya listrik Dorm sekitar waseda', '(100 Org x 2 Hr x 3 Kl)', '', 'waseda', '1', 'Paket', 10, 1000000, 10000000, ''),
(136, '5.02.01', '010.003', '127.001', '080.001', '5.02', '', 'biaya air Dorm sekitar waseda', '(100 Org x 2 Hr x 3 Kl)', '', 'Waseda', '1', 'Paket', 10, 2000000, 20000000, ''),
(137, '5.02.02', '010.003', '127.001', '080.001', '5.02', '', 'pajak bangunan Dorm sekitar waseda', '(100 Org x 2 Hr x 3 Kl)', '', 'Waseda', '1', 'Paket', 10, 2000000, 20000000, ''),
(138, '5.02.03', '010.003', '127.001', '080.001', '5.02', '', 'biaya sewa Dorm per bulan sekitar waseda', '(100 Org x 2 Hr x 3 Kl)', '', 'Waseda', '1', 'Paket', 10, 1000000, 10000000, ''),
(139, '5.3.2.01.01', '010.003', '127.001', '080.002', '5.3.2.01', '', 'Biaya akomodasi sekitar waseda', '(100 Org x 2 Hr x 3 Kl)', '', 'Waseda', '1', 'Paket', 10, 2000000, 20000000, ''),
(140, '5.3.2.01.02', '010.003', '127.001', '080.002', '5.3.2.01', '', 'Biaya akomodasi sekitar waseda kedua', '(100 Org x 2 Hr x 3 Kl)', '', 'Waseda', '1', 'Paket', 10, 2000000, 20000000, ''),
(141, '5.3.2.01.03', '010.003', '127.001', '080.002', '5.3.2.01', '', 'Biaya akomodasi sekitar waseda ketiga', '(100 Org x 2 Hr x 3 Kl)', '', 'Waseda', '1', 'Paket', 10, 1000000, 10000000, ''),
(142, '5.3.2.02.01', '010.003', '127.001', '080.002', '5.3.2.02', '', 'Rata - rata harga bahan pokok sekitar waseda', '(100 Org x 2 Hr x 3 Kl)', '', 'Waseda', '1', 'Paket', 10, 2000000, 20000000, ''),
(143, '5.3.2.02.02', '010.003', '127.001', '080.002', '5.3.2.02', '', 'Rata - rata harga bahan pokok sekitar waseda kedua', '(100 Org x 2 Hr x 3 Kl)', '', 'Waseda', '1', 'Paket', 10, 500000, 5000000, ''),
(144, '5.3.2.02.03', '010.003', '127.001', '080.002', '5.3.2.02', '', 'Rata - rata harga bahan pokok sekitar waseda ketiga', '(100 Org x 2 Hr x 3 Kl)', '', 'Waseda', '1', 'Paket', 10, 500000, 5000000, ''),
(145, '5.3.2.03.01', '010.003', '127.001', '080.002', '5.3.2.03', '', 'Biaya sewa jasa umum sekitar waseda', '(100 Org x 2 Hr x 3 Kl)', '', 'Waseda', '1', 'Paket', 10, 1000000, 10000000, ''),
(146, '5.3.2.03.02', '010.003', '127.001', '080.002', '5.3.2.03', '', 'Biaya sewa jasa umum sekitar waseda kedua', '(100 Org x 2 Hr x 3 Kl)', '', 'Waseda', '1', 'Paket', 10, 500000, 5000000, ''),
(147, '5.3.2.03.03', '010.003', '127.001', '080.002', '5.3.2.03', '', 'Biaya sewa jasa umum sekitar waseda ketiga', '(100 Org x 2 Hr x 3 Kl)', '', 'Waseda', '1', 'Paket', 10, 500000, 5000000, ''),
(148, '5.3.3.01.01', '010.003', '127.001', '080.003', '5.3.3.01', '', 'Biaya jasa dokumentasi keberangkatan siswa', '(100 Org x 2 Hr x 3 Kl)', '', 'Waseda', '1', 'Paket', 10, 3000000, 30000000, ''),
(149, '5.3.3.01.02', '010.003', '127.001', '080.003', '5.3.3.01', '', 'Biaya jasa dokumentasi keberangkatan siswa kedua', '(100 Org x 2 Hr x 3 Kl)', '', 'Waseda', '1', 'Paket', 10, 1000000, 10000000, ''),
(150, '5.3.3.01.03', '010.003', '127.001', '080.003', '5.3.3.01', '', 'Biaya jasa dokumentasi keberangkatan siswa ketiga', '(100 Org x 2 Hr x 3 Kl)', '', 'Waseda', '1', 'Paket', 10, 1000000, 10000000, ''),
(151, '5.3.3.02.01', '010.003', '127.001', '080.003', '5.3.3.02', '', 'biaya jasa publikasi perjalanan siswa ke waseda', '(100 Org x 2 Hr x 3 Kl)', '', 'Waseda', '1', 'Paket', 10, 1000000, 10000000, ''),
(152, '5.3.3.02.02', '010.003', '127.001', '080.003', '5.3.3.02', '', 'biaya jasa publikasi perjalanan siswa ke waseda kedua', '(100 Org x 2 Hr x 3 Kl)', 'Waseda', '', '1', 'Paket', 10, 1000000, 10000000, ''),
(153, '5.3.3.02.03', '010.003', '127.001', '080.003', '5.3.3.02', '', 'biaya jasa publikasi perjalanan siswa ke waseda ketiga', '(100 Org x 2 Hr x 3 Kl)', '', 'Waseda', '1', 'Paket', 10, 1000000, 10000000, ''),
(154, '5.3.3.03.01', '010.003', '127.001', '080.003', '5.3.3.03', '', 'biaya jasa dokumentasi saat siswa sampai di Waseda', '(100 Org x 2 Hr x 3 Kl)', '', 'Waseda', '1', 'Paket', 10, 1000000, 10000000, ''),
(155, '5.3.3.03.02', '010.003', '127.001', '080.003', '5.3.3.03', '', 'biaya jasa dokumentasi saat siswa sampai di Waseda kedua', '(100 Org x 2 Hr x 3 Kl)', '', 'Waseda', '1', 'Paket', 10, 500000, 5000000, ''),
(156, '5.3.3.03.03', '010.003', '127.001', '080.003', '5.3.3.03', '', 'biaya jasa dokumentasi saat siswa sampai di Waseda ketiga', '(100 Org x 2 Hr x 3 Kl)', '', 'Waseda', '1', 'Paket', 10, 500000, 5000000, ''),
(157, '5.1.01.01', '010.003', '127.002', '080.001', '5.1.01', '', 'Biaya uang pangkal sekolah bahasa jepang selama 1 tahun', '(100 Org x 2 Hr x 3 Kl)', '', 'Waseda', '1', 'Paket', 10, 5000000, 50000000, ''),
(158, '5.1.01.02', '010.003', '127.002', '080.001', '5.1.01', '', 'Biaya uang pangkal sekolah bahasa jepang selama 1 tahun kedua', '(100 Org x 2 Hr x 3 Kl)', '', 'Waseda', '1', 'Paket', 10, 2500000, 25000000, ''),
(159, '5.1.01.03', '010.003', '127.002', '080.001', '5.1.01', '', 'Biaya uang pangkal sekolah bahasa jepang selama 1 tahun ketiga', '(100 Org x 2 Hr x 3 Kl)', '', 'Waseda', '1', 'Paket', 10, 2500000, 25000000, ''),
(160, '5.1.02.01', '010.003', '127.002', '080.001', '5.1.02', '', 'Biaya uang gedung sekolah bahasa jepang', '(100 Org x 2 Hr x 3 Kl)', '', 'Waseda', '1', 'Paket', 10, 2000000, 20000000, ''),
(161, '5.1.02.02', '010.003', '127.002', '080.001', '5.1.02', '', 'Biaya uang gedung sekolah bahasa jepang kedua', '(100 Org x 2 Hr x 3 Kl)', '', 'Waseda', '1', 'Paket', 10, 2000000, 20000000, ''),
(162, '5.1.02.03', '010.003', '127.002', '080.001', '5.1.02', '', 'Biaya uang gedung sekolah bahasa jepang ketiga', '(100 Org x 2 Hr x 3 Kl)', '', 'Waseda', '1', 'Paket', 10, 2000000, 20000000, ''),
(163, '5.1.03.01', '010.003', '127.002', '080.001', '5.1.03', '', 'Biaya uang sekolah bahasa jepang per semester', '(100 Org x 2 Hr x 3 Kl)', '', 'Waseda', '1', 'Paket', 10, 1500000, 15000000, ''),
(164, '5.1.03.02', '010.003', '127.002', '080.001', '5.1.03', '', 'Biaya uang sekolah bahasa jepang per semester kedua', '(100 Org x 2 Hr x 3 Kl)', '', 'Waseda', '1', 'Paket', 10, 1500000, 15000000, ''),
(165, '5.1.03.03', '010.003', '127.002', '080.001', '5.1.03', '', 'Biaya uang sekolah bahasa jepang per semester ketiga', '(100 Org x 2 Hr x 3 Kl)', '', 'Waseda', '1', 'Paket', 10, 1000000, 10000000, ''),
(166, '5.2.1.01.01', '010.003', '127.002', '080.002', '5.2.1.01', '', 'biaya sewa guru bahasa jepang lokal', '(100 Org x 2 Hr x 3 Kl)', '', 'Waseda', '1', 'Paket', 10, 5000000, 50000000, ''),
(167, '5.2.1.01.02', '010.003', '127.002', '080.002', '5.2.1.01', '', 'biaya sewa guru bahasa jepang lokal kedua', '(100 Org x 2 Hr x 3 Kl)', '', 'Waseda', '1', 'Paket', 10, 2500000, 25000000, ''),
(168, '5.2.1.01.03', '010.003', '127.002', '080.002', '5.2.1.01', '', 'biaya sewa guru bahasa jepang lokal ketiga', '(100 Org x 2 Hr x 3 Kl)', '', 'Waseda', '1', 'Paket', 10, 2500000, 25000000, ''),
(169, '5.2.1.02.01', '010.003', '127.002', '080.002', '5.2.1.02', '', 'biaya sewa guru bahasa inggris dan mandarin', '(100 Org x 2 Hr x 3 Kl)', '', 'Waseda', '1', 'Paket', 10, 2000000, 20000000, ''),
(170, '5.2.1.02.02', '010.003', '127.002', '080.002', '5.2.1.02', '', 'biaya sewa guru bahasa inggris dan mandarin kedua', '(100 Org x 2 Hr x 3 Kl)', '', 'Waseda', '1', 'Paket', 10, 2000000, 20000000, ''),
(171, '5.2.1.02.03', '010.003', '127.002', '080.002', '5.2.1.02', '', 'biaya sewa guru bahasa inggris dan mandarin ketiga', '(100 Org x 2 Hr x 3 Kl)', '', 'Waseda', '1', 'Paket', 10, 2000000, 20000000, ''),
(172, '5.2.1.03.01', '010.003', '127.002', '080.002', '5.2.1.03', '', 'gaji guru pengajar bahasa jepang', '(12 Bln x 1 Org)', '', 'Waseda', '1', 'Paket', 10, 2000000, 20000000, ''),
(173, '5.2.1.03.02', '010.003', '127.002', '080.002', '5.2.1.03', '', 'gaji guru pengajar bahasa jepang kedua', '(100 Org x 2 Hr x 3 Kl)', '', 'Waseda', '1', 'Paket', 10, 1000000, 10000000, ''),
(174, '5.2.1.03.03', '010.003', '127.002', '080.002', '5.2.1.03', '', 'gaji guru pengajar bahasa jepang ketiga', '(100 Org x 2 Hr x 3 Kl)', '', 'Waseda', '1', 'Paket', 10, 1000000, 10000000, ''),
(175, '5.3.01.01', '010.003', '127.002', '080.003', '5.3.01', '', 'biaya fasilitas kelas selama sekolah', '(100 Org x 2 Hr x 3 Kl)', '', 'Waseda', '1', 'Paket', 10, 4000000, 40000000, ''),
(176, '5.3.01.02', '010.003', '127.002', '080.003', '5.3.01', '', 'biaya fasilitas kelas selama sekolah kedua', '(100 Org x 2 Hr x 3 Kl)', '', 'Waseda', '1', 'Paket', 10, 1000000, 10000000, ''),
(177, '5.3.01.03', '010.003', '127.002', '080.003', '5.3.01', '', 'biaya fasilitas kelas selama sekolah ketiga', '(100 Org x 2 Hr x 3 Kl)', '', 'Waseda', '1', 'Paket', 10, 1000000, 10000000, ''),
(178, '5.3.02.01', '010.003', '127.002', '080.003', '5.3.02', '', 'biaya fasilitas elektronik kelas bahasa', '(100 Org x 2 Hr x 3 Kl)', '', 'Waseda', '1', 'Paket', 10, 1000000, 10000000, ''),
(179, '5.3.02.02', '010.003', '127.002', '080.003', '5.3.02', '', 'biaya fasilitas elektronik kelas bahasa kedua', '(100 Org x 2 Hr x 3 Kl)', '', 'Waseda', '1', 'Paket', 10, 500000, 5000000, ''),
(180, '5.3.02.03', '010.003', '127.002', '080.003', '5.3.02', '', 'biaya fasilitas elektronik kelas bahasa ketiga', '(100 Org x 2 Hr x 3 Kl)', '', 'Waseda', '1', 'Paket', 10, 500000, 5000000, ''),
(181, '5.3.03.01', '010.003', '127.002', '080.003', '5.3.03', '', 'biaya fasilitas perpustakaan kelas bahasa', '(100 Org x 2 Hr x 3 Kl)', '', 'Waseda', '1', 'Paket', 10, 1000000, 10000000, ''),
(182, '5.3.03.02', '010.003', '127.002', '080.003', '5.3.03', '', 'biaya fasilitas perpustakaan kelas bahasa kedua', '(100 Org x 2 Hr x 3 Kl)', '', 'Waseda', '1', 'Paket', 10, 500000, 5000000, ''),
(183, '5.3.03.03', '010.003', '127.002', '080.003', '5.3.03', '', 'biaya fasilitas perpustakaan kelas bahasa ketiga', '(100 Org x 2 Hr x 3 Kl)', '', 'Waseda', '1', 'Paket', 10, 500000, 5000000, ''),
(184, '5.01.01', '010.003', '127.003', '080.001', '5.01', '', 'Biaya kuliah per semester di jurusan saintek', '(100 Org x 2 Hr x 3 Kl)', '', 'Waseda', '1', 'Paket', 10, 10000000, 100000000, ''),
(185, '5.01.02', '010.003', '127.003', '080.001', '5.01', '', 'Biaya kuliah per semester di jurusan saintek kedua', '(100 Org x 2 Hr x 3 Kl)', '', 'Waseda', '1', 'Paket', 10, 5000000, 50000000, ''),
(186, '5.01.03', '010.003', '127.003', '080.001', '5.01', '', 'Biaya kuliah per semester di jurusan saintek ketiga', '(100 Org x 2 Hr x 3 Kl)', '', 'Waseda', '1', 'Paket', 10, 5000000, 50000000, ''),
(187, '5.03.01', '010.003', '127.003', '080.001', '5.03', '', 'Biaya kuliah per semester di jurusan soshum ( ekonomi )', '(100 Org x 2 Hr x 3 Kl)', '', 'Waseda', '1', 'Paket', 10, 2000000, 20000000, ''),
(188, '5.03.02', '010.003', '127.003', '080.001', '5.03', '', 'Biaya kuliah per semester di jurusan soshum ( ekonomi ) kedua', '(100 Org x 2 Hr x 3 Kl)', '', 'Waseda', '1', 'Paket', 10, 1500000, 15000000, ''),
(189, '5.03.03', '010.003', '127.003', '080.001', '5.03', '', 'Biaya kuliah per semester di jurusan soshum ( ekonomi ) ketiga', '(100 Org x 2 Hr x 3 Kl)', '', 'Waseda', '1', 'Paket', 10, 1500000, 15000000, ''),
(190, '5.02.01', '010.003', '127.003', '080.001', '5.02', '', 'Biaya kuliah per semester di jurusan bahasa inggris, dan mandarin', '(100 Org x 2 Hr x 3 Kl)', '', 'Waseda', '1', 'Paket', 10, 2000000, 20000000, ''),
(191, '5.02.02', '010.003', '127.003', '080.001', '5.02', '', 'Biaya kuliah per semester di jurusan bahasa inggris, dan mandarin kedua', '(100 Org x 2 Hr x 3 Kl)', '', 'Waseda', '1', 'Paket', 10, 1500000, 15000000, ''),
(192, '5.02.03', '010.003', '127.003', '080.001', '5.02', '', 'Biaya kuliah per semester di jurusan bahasa inggris, dan mandarin ketiga', '(100 Org x 2 Hr x 3 Kl)', '', 'Waseda', '1', 'Paket', 10, 1500000, 15000000, ''),
(193, '5.1.01.01', '010.003', '127.003', '080.002', '5.1.01', '', 'Biaya awal uang gedung waseda university jurusan saintek', '(100 Org x 2 Hr x 3 Kl)', '', 'Waseda', '1', 'Paket', 10, 10000000, 100000000, ''),
(194, '5.1.01.02', '010.003', '127.003', '080.002', '5.1.01', '', 'Biaya awal uang gedung waseda university jurusan saintek kedua', '(100 Org x 2 Hr x 3 Kl)', '', 'Waseda', '1', 'Paket', 10, 10000000, 100000000, ''),
(195, '5.1.01.03', '010.003', '127.003', '080.002', '5.1.01', '', 'Biaya awal uang gedung waseda university jurusan saintek ketiga', '(100 Org x 2 Hr x 3 Kl)', '', 'Waseda', '1', 'Paket', 10, 10000000, 100000000, ''),
(196, '5.1.02.01', '010.003', '127.003', '080.002', '5.1.02', '', 'Biaya per semester untuk uang gedung dan kuliah jurusan soshum', '(100 Org x 2 Hr x 3 Kl)', '', 'Waseda', '1', 'Paket', 10, 5000000, 50000000, ''),
(197, '5.1.02.02', '010.003', '127.003', '080.002', '5.1.02', '', 'Biaya per semester untuk uang gedung dan kuliah jurusan soshum kedua', '(100 Org x 2 Hr x 3 Kl)', '', 'Waseda', '1', 'Paket', 10, 2500000, 25000000, ''),
(198, '5.1.02.03', '010.003', '127.003', '080.002', '5.1.02', '', 'Biaya per semester untuk uang gedung dan kuliah jurusan soshum ketiga', '(100 Org x 2 Hr x 3 Kl)', 'Waseda', '', '1', 'Paket', 10, 2500000, 25000000, ''),
(199, '5.1.03.01', '010.003', '127.003', '080.002', '5.1.03', '', 'rata rata uang gedung jurusan bahasa di waseda university', '(100 Org x 2 Hr x 3 Kl)', '', 'Waseda', '1', 'Paket', 10, 5000000, 50000000, ''),
(200, '5.1.03.02', '010.003', '127.003', '080.002', '5.1.03', '', 'rata rata uang gedung jurusan bahasa di waseda university kedua', '(100 Org x 2 Hr x 3 Kl)', '', 'Waseda', '1', 'Paket', 10, 2500000, 25000000, ''),
(201, '5.1.03.03', '010.003', '127.003', '080.002', '5.1.03', '', 'rata rata uang gedung jurusan bahasa di waseda university ketiga', '(100 Org x 2 Hr x 3 Kl)', '', 'Waseda', '1', 'Paket', 10, 2500000, 25000000, ''),
(202, '5.1.01.01', '010.003', '127.003', '080.003', '5.1.01', '', 'Total biaya Dorm untuk siswa tinggal selama masa kuliah', '(100 Org x 2 Hr x 3 Kl)', '', 'Waseda', '1', 'Paket', 10, 2000000, 20000000, ''),
(203, '5.1.01.02', '010.003', '127.003', '080.003', '5.1.01', '', 'Total biaya Dorm untuk siswa tinggal selama masa kuliah kedua', '(100 Org x 2 Hr x 3 Kl)', '', 'Waseda', '1', 'Paket', 10, 2000000, 20000000, ''),
(204, '5.1.01.03', '010.003', '127.003', '080.003', '5.1.01', '', 'Total biaya Dorm untuk siswa tinggal selama masa kuliah ketiga', '(100 Org x 2 Hr x 3 Kl)', '', 'Waseda', '1', 'Paket', 30, 2000000, 60000000, ''),
(205, '5.1.02.01', '010.003', '127.003', '080.003', '5.1.02', '', 'Rata rata biaya Dorm yang digunakan oleh siswa tahun sebelumnya', '(100 Org x 2 Hr x 3 Kl)', '', 'Waseda', '1', 'Paket', 10, 2000000, 20000000, ''),
(206, '5.1.02.02', '010.003', '127.003', '080.003', '5.1.02', '', 'Rata rata biaya Dorm yang digunakan oleh siswa tahun sebelumnya kedua', '(100 Org x 2 Hr x 3 Kl)', '', 'Waseda', '1', 'Paket', 10, 2000000, 20000000, ''),
(207, '5.1.02.03', '010.003', '127.003', '080.003', '5.1.02', '', 'Rata rata biaya Dorm yang digunakan oleh siswa tahun sebelumnya ketiga', '(100 Org x 2 Hr x 3 Kl)', '', 'Waseda', '1', 'Paket', 10, 2000000, 20000000, ''),
(208, '5.1.03.01', '010.003', '127.003', '080.003', '5.1.03', '', 'Pajak Dorm yang digunakan siswa per tahun', '(100 Org x 2 Hr x 3 Kl)', '', 'Waseda', '1', 'Paket', 10, 1000000, 10000000, ''),
(209, '5.1.03.02', '010.003', '127.003', '080.003', '5.1.03', '', 'Pajak Dorm yang digunakan siswa per tahun kedua', '(100 Org x 2 Hr x 3 Kl)', '', 'Waseda', '1', 'Paket', 10, 2000000, 20000000, ''),
(210, '5.1.03.03', '010.003', '127.003', '080.003', '5.1.03', '', 'Pajak Dorm yang digunakan siswa per tahun ketiga', '(100 Org x 2 Hr x 3 Kl)', '', 'Waseda', '1', 'Paket', 10, 1000000, 10000000, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_indikator`
--

CREATE TABLE `tb_indikator` (
  `id` int(3) NOT NULL,
  `kode_indikator` varchar(30) NOT NULL,
  `kode_instansi` varchar(30) NOT NULL,
  `kode_program` varchar(30) NOT NULL,
  `jenis` varchar(15) NOT NULL COMMENT '1. Capaian Program, 2.Hasil, 3.Pengeluaran, 4.masukan',
  `uraian` varchar(70) NOT NULL,
  `satuan` varchar(10) NOT NULL,
  `target` int(3) NOT NULL,
  `nilai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_indikator`
--

INSERT INTO `tb_indikator` (`id`, `kode_indikator`, `kode_instansi`, `kode_program`, `jenis`, `uraian`, `satuan`, `target`, `nilai`) VALUES
(4, '1.001', '001', '127.001', '4', 'Jumlah dana yang masuk pada pembelian karcis kupon', 'Rupiah', 90, 90),
(5, '1.002', '001', '127.001', '3', 'Jumlah dana yang dibutuhkan saat mengundang bintang tamu', 'Rupiah', 90, 90),
(6, '1.003', '001', '127.001', '1', 'Hasil akhir acara dan tanggapan dari peserta', 'Orang', 100, 90),
(7, '1.001', '001', '127.002', '1', 'Respon Peserta setelah mengikuti acara', 'orang', 100, 100),
(8, '1.002', '001', '127.002', '1', 'Respon Panitia setelah acara selesai', 'orang', 90, 80),
(9, '1.003', '001', '127.002', '1', 'Respon pihak sponsor berdasarkan hasil acara', 'Orang', 80, 80),
(10, '1.001', '001', '127.003', '3', 'Total penggunaan biaya selama pembukaan', 'Dana', 90, 80),
(11, '1.002', '001', '127.003', '3', 'Total biaya yang digunakan selama acara berlangsung', 'Dana', 90, 80),
(12, '1.003', '001', '127.003', '3', 'Total penggunaan biaya untuk multimedia', 'Dana', 80, 100),
(13, '1.001', '010.002', '127.001', '1', 'Total siswa yang menerima SNMPTN di ITS', 'Orang', 1000, 1000),
(14, '1.002', '010.002', '127.001', '1', 'Total slip gaji orang tua siswa yang sudah diseleksi', 'Orang', 800, 800),
(15, '1.003', '010.002', '127.001', '1', 'Total siswa yang sudah mendaftar ulang di ITS', 'Orang', 1000, 800),
(16, '1.001', '010.002', '127.002', '4', 'Total dana yang masuk untuk tes UTBK', 'Dana', 1000, 1000),
(17, '1.002', '010.002', '127.002', '3', 'Biaya yang digunakan selama UTBK berlangsung', 'Dana', 800, 800),
(18, '1.003', '010.002', '127.002', '1', 'Total siswa yang diterima di ITS', 'Orang', 800, 800),
(19, '1.001', '010.002', '127.003', '4', 'Patokan Dana untuk uang gedung', 'Dana', 9000, 9000),
(20, '1.002', '010.002', '127.003', '4', 'Rata rata dana yang masuk', 'Dana', 7000, 7000),
(21, '1.003', '010.002', '127.003', '1', 'Total siswa yang diterima jalur mandiri', 'Orang', 1500, 1200),
(22, '1.001', '010.003', '127.001', '3', 'Rata biaya yang dikeluarkan untuk pengadaan tes', 'dana', 1000, 1000),
(23, '1.002', '010.003', '127.001', '1', 'Total siswa yang berpartisipasi dalam tes akademis', 'Orang', 5000, 5000),
(24, '1.003', '010.003', '127.001', '1', 'Total siswa yang lolos dan pergi ke Jepang', 'Orang', 10, 2),
(25, '1.001', '010.003', '127.002', '3', 'Rata rata biaya untuk membayar guru pengajar', 'Dana', 80, 80),
(26, '1.002', '010.003', '127.002', '3', 'Rata rata biaya untuk membayar guru pengajar', 'Dana', 80, 80),
(27, '1.003', '010.003', '127.002', '3', 'Rata rata biaya pokok selama siswa bersekolah bahasa', 'Dana', 90, 80),
(28, '1.001', '010.003', '127.003', '3', 'Rata rata biaya yang sudah digelontorkan', 'Dana', 1000, 1000),
(29, '1.002', '010.003', '127.003', '3', 'Rata rata biaya yang sudah digelontorkan', 'Dana', 1000, 1000),
(30, '1.003', '010.003', '127.003', '1', 'Kesan siswa selama berkuliah di Waseda University', 'Orang', 2, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_instansi`
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
-- Dumping data untuk tabel `tb_instansi`
--

INSERT INTO `tb_instansi` (`id`, `kode_admin`, `kode_instansi`, `hak_akses`, `nama_instansi`, `versi`, `kota_lokasi`, `keterangan`, `tahun`, `username`, `password`, `foto`) VALUES
(5, '100.001', '001', 2, 'SMKN 2 Surabaya', 'APBD', '', '', 2019, 'smk2', 'YWRtaW4=', 'user.png'),
(6, '100.001', '010.002', 2, 'Institut Teknologi Sepuluh November', 'APBD', 'Surabaya', NULL, 2019, 'its', 'YWRtaW4=', 'user.png'),
(7, '100.001', '010.003', 2, 'Waseda University', 'APBN', 'Waseda, Tokyo, ', NULL, 2019, 'waseda', 'YWRtaW4=', 'user.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kegiatan`
--

CREATE TABLE `tb_kegiatan` (
  `id` int(11) NOT NULL,
  `kode_instansi` varchar(30) NOT NULL,
  `kode_program` varchar(30) NOT NULL,
  `kode_kegiatan` varchar(30) NOT NULL,
  `nama_kegiatan` varchar(100) NOT NULL,
  `total_rekening` int(11) NOT NULL DEFAULT '0',
  `total_rinci` int(11) NOT NULL DEFAULT '0',
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_kegiatan`
--

INSERT INTO `tb_kegiatan` (`id`, `kode_instansi`, `kode_program`, `kode_kegiatan`, `nama_kegiatan`, `total_rekening`, `total_rinci`, `keterangan`) VALUES
(6, '001', '127.001', '080.001', 'Acara Pembukaan Peringatan Hari Pahlawan', 50000000, 50000000, 'Dibuat pada 7 April 2019 di SMKN 2 Surabaya'),
(7, '001', '127.001', '080.002', 'Acara Utama Peringatan Hari Pahlawan', 0, 0, 'Dibuat pada 7 April 2019 di SMKN 2 Surabaya'),
(8, '001', '127.001', '080.003', 'Acara Penutup Peringatan Hari Pahlawan', 0, 0, 'Dibuat pada 7 April 2019 di SMKN 2 Surabaya'),
(9, '001', '127.002', '080.001', 'Acara Pembukaan Peringatan Hari Kartini', 20000000, 20000000, 'Dibuat pada 7 April 2019 di SMKN 2 Surabaya'),
(10, '001', '127.002', '080.002', 'Acara Utama Peringatan Hari Kartini', 36000000, 28000000, 'Dibuat pada 7 April 2019 di SMKN 2 Surabaya'),
(11, '001', '127.002', '080.003', 'Acara Penutup Peringatan Hari Kartini', 0, 0, 'Dibuat pada 7 April 2019 di SMKN 2 Surabaya'),
(12, '001', '127.003', '080.001', 'Acara Pembukaan Peringatan Hari Pendidikan', 20000000, 20000000, 'Dibuat pada 7 April 2019 di SMKN 2 Surabaya'),
(13, '001', '127.003', '080.002', 'Acara Utama Peringatan Hari Pendidikan Nasional', 15000000, 15000000, 'Dibuat pada 7 April 2019 di SMKN 2 Surabaya'),
(14, '001', '127.003', '080.003', 'Acara Penutup Peringatan Hari Pendidikan Nasional', 15000000, 15000000, 'Dibuat pada 7 April 2019 di SMKN 2 Surabaya'),
(15, '010.002', '127.001', '080.001', 'Seleksi siswa yang mendaftar SNMPTN', 20000000, 20000000, 'Dibuat pada 7 April 2019 di ITS '),
(16, '010.002', '127.001', '080.002', 'Penilaian gaji orang tua siswa SNMPTN', 20000000, 20000000, 'Dibuat pada 7 April 2019 di ITS '),
(17, '010.002', '127.001', '080.003', 'Daftar Ulang Siswa SNMPTN', 10000000, 10000000, 'Dibuat pada 7 April 2019 di ITS '),
(18, '010.002', '127.002', '080.001', 'Penyelenggaraan tes UTBK di kampus ITS', 20000000, 20000000, 'Dibuat pada 7 April 2019 di ITS '),
(19, '010.002', '127.002', '080.002', 'Seleksi siswa yang diterima di ITS', 20000000, 20000000, 'Dibuat pada 7 April 2019 di ITS '),
(20, '010.002', '127.002', '080.003', 'Pendaftaran ulang siswa yang diterima di ITS', 10000000, 10000000, 'Dibuat pada 7 April 2019 di ITS '),
(21, '010.002', '127.003', '080.001', 'Pembukaan pendaftaran jalur mandiri', 20000000, 20000000, 'Dibuat pada 7 April 2019 di ITS '),
(22, '010.002', '127.003', '080.002', 'Penyelenggaraan tes untuk jalur mandiri', 20000000, 20000000, 'Dibuat pada 7 April 2019 di ITS '),
(23, '010.002', '127.003', '080.003', 'Penutupan Tes jalur mandiri', 10000000, 10000000, 'Dibuat pada 7 April 2019 di ITS '),
(24, '010.003', '127.001', '080.001', 'Tes Akademis untuk penerima beasiswa', 300000000, 300000000, 'Dibuat pada 7 April 2019 di Jakarta'),
(25, '010.003', '127.001', '080.002', 'Tes Wawancara untuk penerima beasiswa', 100000000, 100000000, 'Dibuat pada 7 April 2019 di Jakarta'),
(26, '010.003', '127.001', '080.003', 'Biaya keberangkatan siswa yang lolos seleksi untuk ke Jepang', 100000000, 100000000, 'Dibuat pada 7 April 2019 di Jakarta'),
(27, '010.003', '127.002', '080.001', 'Biaya Sekolah bahasa jepang selama 1 tahun', 200000000, 200000000, 'Dibuat pada 7 April 2019 di Jakarta'),
(28, '010.003', '127.002', '080.002', 'Biaya untuk guru pengajar bahasa jepang', 200000000, 200000000, 'Dibuat pada 7 April 2019 di Jakarta'),
(29, '010.003', '127.002', '080.003', 'Biaya pokok selama masa sekolah bagi siswa', 100000000, 100000000, 'Dibuat pada 7 April 2019 di Jakarta'),
(30, '010.003', '127.003', '080.001', 'Biaya Kuliah Per Semester', 300000000, 300000000, 'Dibuat pada 7 April 2019 di Jakarta'),
(31, '010.003', '127.003', '080.002', 'Biaya uang gedung Waseda University', 500000000, 500000000, 'Dibuat pada 7 April 2019 di Jakarta'),
(32, '010.003', '127.003', '080.003', 'Biaya Dorm untuk siswa', 200000000, 200000000, 'Dibuat pada 7 April 2019 di Jakarta');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_patokan_rekening`
--

CREATE TABLE `tb_patokan_rekening` (
  `kode_patokan` varchar(10) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_patokan_rekening`
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
-- Struktur dari tabel `tb_pembahasan`
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
-- Struktur dari tabel `tb_program`
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
-- Dumping data untuk tabel `tb_program`
--

INSERT INTO `tb_program` (`id`, `kode_admin`, `id_siswa`, `kode_instansi`, `kode_program`, `jenis`, `uraian`, `sasaran`, `nama_program`, `plafon`, `total_rinci`, `total_rekening`) VALUES
(7, '100.001', 8, '001', '127.001', 'APBD', 'Pengaturan Anggaran untuk Acara Hari Pahlawan di S', 'SMKN 2 Surabaya', 'Kegiatan Hari Pahlawan di SMKN 2 Surabaya', '50000000', '50000000', '50000000'),
(8, '100.001', 9, '001', '127.002', 'APBD', 'Pengaturan Anggaran untuk Acara Hari Kartini di SM', 'SMKN 2 Surabaya', 'Kegiatan Hari Kartini di SMKN 2 Surabaya', '50000000', '48000000', '56000000'),
(9, '100.001', 10, '001', '127.003', 'APBD', 'Pengaturan Anggaran untuk Acara Hari Pendidikan Na', 'SMKN 2 Surabaya', 'Kegiatan Hari Pendidikan Nasional di SMKN 2 Suraba', '50000000', '50000000', '50000000'),
(10, '100.001', 11, '010.002', '127.001', 'APBD', 'Penerimaan SNMPTN', 'Seluruh Jurusan di ITS', 'SNMPTN', '50000000', '50000000', '50000000'),
(11, '100.001', 12, '010.002', '127.002', 'APBD', 'Penerimaan SBMPTN', 'Seluruh Jurusan di ITS', 'SBMPTN', '50000000', '50000000', '50000000'),
(12, '100.001', 13, '010.002', '127.003', 'APBD', 'Penerimaan siswa jalur mandiri', 'Seluruh Jurusan di ITS', 'Jalur Mandiri', '50000000', '50000000', '50000000'),
(13, '100.001', 14, '010.003', '127.001', 'APBN', 'Penerima Beasiswa untuk Kuliah di Waseda Universit', 'Seluruh Siswa Penerima Beasiswa', 'Beasiswa penuh kuliah di Waseda', '500000000', '500000000', '500000000'),
(14, '100.001', 15, '010.003', '127.002', 'APBN', 'Pembekalan Bahasa Jepang bagi siswa yang sudah dit', 'Siswa penerima beasiswa', 'Sekolah Bahasa Jepang Sebelum Memulai Kuliah', '500000000', '500000000', '500000000'),
(15, '100.001', 16, '010.003', '127.003', 'APBN', 'Total Biaya yang diperlukan untuk siswa selama ber', 'Siswa penerima beasiswa', 'Biaya Kuliah di Waseda University', '1000000000', '1000000000', '1000000000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_registrasi`
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
-- Struktur dari tabel `tb_rekening`
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

--
-- Dumping data untuk tabel `tb_rekening`
--

INSERT INTO `tb_rekening` (`id`, `kode_patokan`, `kode_instansi`, `kode_program`, `kode_kegiatan`, `kode_rekening`, `uraian_rekening`, `triwulan_1`, `triwulan_2`, `triwulan_3`, `triwulan_4`, `total`, `total_rinci`) VALUES
(2, '5.1', '001', '127.001', '080.001', '5.1.01', 'Belanja Tidak Langsung', 5000000, 5000000, 5000000, 5000000, 20000000, 20000000),
(3, '5.3.2', '001', '127.001', '080.001', '5.3.2.01', 'Belanja Akomodasi dan Konsumsi', 5000000, 5000000, 5000000, 5000000, 20000000, 20000000),
(4, '5.3.6', '001', '127.001', '080.001', '5.3.6.01', 'Belanja Cetak dan/atau Penggandaan', 2500000, 2500000, 2500000, 2500000, 10000000, 10000000),
(5, '5.1', '001', '127.002', '080.001', '5.1.01', 'Belanja Tidak Langsung', 2500000, 2500000, 2500000, 2500000, 10000000, 10000000),
(6, '5.1', '001', '127.002', '080.001', '5.1.02', 'Belanja Tidak Langsung', 2000000, 2000000, 1000000, 1000000, 6000000, 6000000),
(7, '5.1', '001', '127.002', '080.001', '5.1.03', 'Belanja Tidak Langsung', 1000000, 1000000, 1000000, 1000000, 4000000, 4000000),
(8, '5.1', '001', '127.002', '080.002', '5.1.01', 'Belanja Tidak Langsung', 5000000, 5000000, 5000000, 5000000, 20000000, 20000000),
(11, '5.1', '001', '127.003', '080.001', '5.1.01', 'Belanja Tidak Langsung', 2500000, 2500000, 2500000, 2500000, 10000000, 10000000),
(12, '5.1', '001', '127.003', '080.001', '5.1.02', 'Belanja Tidak Langsung', 1250000, 1250000, 1250000, 1250000, 5000000, 5000000),
(13, '5.1', '001', '127.003', '080.001', '5.1.03', 'Belanja Tidak Langsung', 1250000, 1250000, 1250000, 1250000, 5000000, 5000000),
(14, '5.1.1', '001', '127.003', '080.002', '5.1.1.01', 'Belanja Pegawai', 2500000, 2500000, 2500000, 2500000, 10000000, 10000000),
(15, '5.1.1', '001', '127.003', '080.002', '5.1.1.02', 'Belanja Pegawai', 1250000, 1250000, 1250000, 1250000, 5000000, 5000000),
(16, '5.4.3', '001', '127.003', '080.003', '5.4.3.01', 'Belanja Jasa Dekorasi', 1250000, 1250000, 1250000, 1250000, 5000000, 5000000),
(17, '5.3.6', '001', '127.003', '080.003', '5.3.6.01', 'Belanja Cetak dan/atau Penggandaan', 1250000, 1250000, 1250000, 1250000, 5000000, 5000000),
(18, '5.4', '001', '127.003', '080.003', '5.4.01', 'Belanja Jasa Paket Pengiriman', 1250000, 1250000, 1250000, 1250000, 5000000, 5000000),
(19, '5.1.1', '010.002', '127.001', '080.001', '5.1.1.01', 'Belanja Pegawai', 2500000, 2500000, 2500000, 2500000, 10000000, 10000000),
(20, '5.1.1', '010.002', '127.001', '080.001', '5.1.1.02', 'Belanja Pegawai', 1250000, 1250000, 1250000, 1250000, 5000000, 5000000),
(21, '5.1.1', '010.002', '127.001', '080.001', '5.1.1.03', 'Belanja Pegawai', 1250000, 1250000, 1250000, 1250000, 5000000, 5000000),
(22, '5.2', '010.002', '127.001', '080.002', '5.2.01', 'Honorarium Kegiatan PNS', 2500000, 2500000, 2500000, 2500000, 10000000, 10000000),
(23, '5.2', '010.002', '127.001', '080.002', '5.2.02', 'Honorarium Kegiatan PNS', 1250000, 1250000, 1250000, 1250000, 5000000, 5000000),
(24, '5.2', '010.002', '127.001', '080.002', '5.2.03', 'Honorarium Kegiatan PNS', 1250000, 1250000, 1250000, 1250000, 5000000, 5000000),
(25, '5.2.1', '010.002', '127.001', '080.003', '5.2.1.01', 'Honorarium Kegiatan Non PNS', 1250000, 1250000, 1250000, 1250000, 5000000, 5000000),
(26, '5.2.1', '010.002', '127.001', '080.003', '5.2.1.02', 'Honorarium Kegiatan Non PNS', 750000, 750000, 750000, 750000, 3000000, 3000000),
(27, '5.2.1', '010.002', '127.001', '080.003', '5.2.1.03', 'Honorarium Kegiatan Non PNS', 500000, 500000, 500000, 500000, 2000000, 2000000),
(28, '5.2.2', '010.002', '127.002', '080.001', '5.2.2.01', 'Honorarium Pengelola Keuangan, Barang Daerah, dan Sistem Informasi PNS', 2500000, 2500000, 2500000, 2500000, 10000000, 10000000),
(29, '5.2.2', '010.002', '127.002', '080.001', '5.2.2.02', 'Honorarium Pengelola Keuangan, Barang Daerah, dan Sistem Informasi PNS', 1250000, 1250000, 1250000, 1250000, 5000000, 5000000),
(30, '5.2.2', '010.002', '127.002', '080.001', '5.2.2.03', 'Honorarium Pengelola Keuangan, Barang Daerah, dan Sistem Informasi PNS', 1250000, 1250000, 1250000, 1250000, 5000000, 5000000),
(31, '5.3.4', '010.002', '127.002', '080.002', '5.3.4.01', 'Belanja Jasa Narasumber/Tenaga Ahli', 2500000, 2500000, 2500000, 2500000, 10000000, 10000000),
(32, '5.3.4', '010.002', '127.002', '080.002', '5.3.4.02', 'Belanja Jasa Narasumber/Tenaga Ahli', 1250000, 1250000, 1250000, 1250000, 5000000, 5000000),
(33, '5.3.4', '010.002', '127.002', '080.002', '5.3.4.03', 'Belanja Jasa Narasumber/Tenaga Ahli', 1250000, 1250000, 1250000, 1250000, 5000000, 5000000),
(34, '5.3.9', '010.002', '127.002', '080.003', '5.3.9.01', 'Belanja Langganan Multimedia', 1250000, 1250000, 1250000, 1250000, 5000000, 5000000),
(35, '5.5.4', '010.002', '127.002', '080.003', '5.5.4.01', 'Belanja Modal Pengadaan Alat-alat Studio', 750000, 750000, 250000, 250000, 2000000, 2000000),
(36, '5.3.5', '010.002', '127.002', '080.003', '5.3.5.01', 'Belanja iuran Jaminan Kesehatan/Kecelakaan Kerja/Kematian', 750000, 750000, 1000000, 500000, 3000000, 3000000),
(37, '5.4.1', '010.002', '127.003', '080.001', '5.4.1.01', 'Belanja Jasa Outsourcing', 2500000, 2500000, 2500000, 2500000, 10000000, 10000000),
(38, '5.4.1', '010.002', '127.003', '080.001', '5.4.1.02', 'Belanja Jasa Outsourcing', 1250000, 1250000, 1250000, 1250000, 5000000, 5000000),
(39, '5.4.1', '010.002', '127.003', '080.001', '5.4.1.03', 'Belanja Jasa Outsourcing', 1250000, 1250000, 1250000, 1250000, 5000000, 5000000),
(40, '5.5.3', '010.002', '127.003', '080.002', '5.5.3.01', 'Belanja Modal Pengadaan Peralatan dan/Perlengkapan Kantor', 2500000, 2500000, 2500000, 2500000, 10000000, 10000000),
(41, '5.4.6', '010.002', '127.003', '080.002', '5.4.6.01', 'Belanja Pakaian Khusus', 1250000, 1250000, 1250000, 1250000, 5000000, 5000000),
(42, '5.5.3', '010.002', '127.003', '080.002', '5.5.3.02', 'Belanja Modal Pengadaan Peralatan dan/Perlengkapan Kantor', 1250000, 1250000, 1250000, 1250000, 5000000, 5000000),
(43, '5.5.2', '010.002', '127.003', '080.003', '5.5.2.01', 'Belanja Pemeliharaan Peralatan dan Mesin', 1250000, 1250000, 1250000, 1250000, 5000000, 5000000),
(44, '5.5.2', '010.002', '127.003', '080.003', '5.5.2.02', 'Belanja Pemeliharaan Peralatan dan Mesin', 750000, 750000, 1000000, 500000, 3000000, 3000000),
(45, '5.5.2', '010.002', '127.003', '080.003', '5.5.2.03', 'Belanja Pemeliharaan Peralatan dan Mesin', 500000, 500000, 500000, 500000, 2000000, 2000000),
(46, '5', '010.003', '127.001', '080.001', '5.01', 'Belanja Daerah', 50000000, 50000000, 50000000, 50000000, 200000000, 200000000),
(47, '5', '010.003', '127.001', '080.001', '5.02', 'Belanja Daerah', 12500000, 12500000, 12500000, 12500000, 50000000, 50000000),
(48, '5', '010.003', '127.001', '080.001', '5.03', 'Belanja Daerah', 12500000, 12500000, 12500000, 12500000, 50000000, 50000000),
(49, '5.3.2', '010.003', '127.001', '080.002', '5.3.2.01', 'Belanja Akomodasi dan Konsumsi', 12500000, 12500000, 12500000, 12500000, 50000000, 50000000),
(50, '5.3.2', '010.003', '127.001', '080.002', '5.3.2.02', 'Belanja Akomodasi dan Konsumsi', 7500000, 7500000, 7500000, 7500000, 30000000, 30000000),
(51, '5.3.2', '010.003', '127.001', '080.002', '5.3.2.03', 'Belanja Akomodasi dan Konsumsi', 5000000, 5000000, 5000000, 5000000, 20000000, 20000000),
(52, '5.3.3', '010.003', '127.001', '080.003', '5.3.3.01', 'Belanja Jasa Dokumentasi dan Publikasi', 12500000, 12500000, 12500000, 12500000, 50000000, 50000000),
(53, '5.3.3', '010.003', '127.001', '080.003', '5.3.3.02', 'Belanja Jasa Dokumentasi dan Publikasi', 7500000, 7500000, 7500000, 7500000, 30000000, 30000000),
(54, '5.3.3', '010.003', '127.001', '080.003', '5.3.3.03', 'Belanja Jasa Dokumentasi dan Publikasi', 5000000, 5000000, 5000000, 5000000, 20000000, 20000000),
(55, '5.1', '010.003', '127.002', '080.001', '5.1.01', 'Belanja Tidak Langsung', 25000000, 25000000, 25000000, 25000000, 100000000, 100000000),
(56, '5.1', '010.003', '127.002', '080.001', '5.1.02', 'Belanja Tidak Langsung', 15000000, 15000000, 15000000, 15000000, 60000000, 60000000),
(57, '5.1', '010.003', '127.002', '080.001', '5.1.03', 'Belanja Tidak Langsung', 10000000, 10000000, 10000000, 10000000, 40000000, 40000000),
(58, '5.2.1', '010.003', '127.002', '080.002', '5.2.1.01', 'Honorarium Kegiatan Non PNS', 25000000, 25000000, 25000000, 25000000, 100000000, 100000000),
(59, '5.2.1', '010.003', '127.002', '080.002', '5.2.1.02', 'Honorarium Kegiatan Non PNS', 15000000, 15000000, 15000000, 15000000, 60000000, 60000000),
(60, '5.2.1', '010.003', '127.002', '080.002', '5.2.1.03', 'Honorarium Kegiatan Non PNS', 10000000, 10000000, 10000000, 10000000, 40000000, 40000000),
(61, '5.3', '010.003', '127.002', '080.003', '5.3.01', 'Belanja Alat Tulis Kantor', 15000000, 15000000, 15000000, 15000000, 60000000, 60000000),
(62, '5.3', '010.003', '127.002', '080.003', '5.3.02', 'Belanja Alat Tulis Kantor', 5000000, 5000000, 5000000, 5000000, 20000000, 20000000),
(63, '5.3', '010.003', '127.002', '080.003', '5.3.03', 'Belanja Alat Tulis Kantor', 5000000, 5000000, 5000000, 5000000, 20000000, 20000000),
(64, '5', '010.003', '127.003', '080.001', '5.01', 'Belanja Daerah', 50000000, 50000000, 50000000, 50000000, 200000000, 200000000),
(65, '5', '010.003', '127.003', '080.001', '5.02', 'Belanja Daerah', 12500000, 12500000, 12500000, 12500000, 50000000, 50000000),
(66, '5', '010.003', '127.003', '080.001', '5.03', 'Belanja Daerah', 12500000, 12500000, 12500000, 12500000, 50000000, 50000000),
(67, '5.1', '010.003', '127.003', '080.002', '5.1.01', 'Belanja Tidak Langsung', 100000000, 100000000, 50000000, 50000000, 300000000, 300000000),
(68, '5.1', '010.003', '127.003', '080.002', '5.1.02', 'Belanja Tidak Langsung', 25000000, 25000000, 25000000, 25000000, 100000000, 100000000),
(69, '5.1', '010.003', '127.003', '080.002', '5.1.03', 'Belanja Tidak Langsung', 25000000, 25000000, 25000000, 25000000, 100000000, 100000000),
(70, '5.1', '010.003', '127.003', '080.003', '5.1.01', 'Belanja Tidak Langsung', 25000000, 25000000, 25000000, 25000000, 100000000, 100000000),
(71, '5.1', '010.003', '127.003', '080.003', '5.1.02', 'Belanja Tidak Langsung', 15000000, 15000000, 15000000, 15000000, 60000000, 60000000),
(72, '5.1', '010.003', '127.003', '080.003', '5.1.03', 'Belanja Tidak Langsung', 10000000, 10000000, 10000000, 10000000, 40000000, 40000000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_siswa`
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
-- Dumping data untuk tabel `tb_siswa`
--

INSERT INTO `tb_siswa` (`id_siswa`, `kode_instansi`, `kode_program`, `hak_akses`, `nama`, `username`, `password`, `nis`, `nisn`, `jurusan`, `nomor_hp`, `foto`) VALUES
(8, '001', '127.001', 3, 'Galang Noer Rachmad', 'galangsmk2', 'YWRtaW4=', '1111111111', '11', 'RPL', '085755006308', 'user.png'),
(9, '001', '127.002', 3, 'Rizky Dwi Ardiyanto', 'sapleksmk2', 'YWRtaW4=', '2222222222', '2222', 'RPL', '085755006308', 'user.png'),
(10, '001', '127.003', 3, 'Kasyafa Iwang Atmaja', 'ahongsmk2', 'YWRtaW4=', '3333333333', '3333', 'RPL', '085755006308', 'user.png'),
(11, '010.002', '127.001', 3, 'Sony Adi Adriko', 'sonyits', 'YWRtaW4=', '4444444444', '4444', 'Informatika', '085755006308', 'user.png'),
(12, '010.002', '127.002', 3, 'M. Ainul Yaqin', 'ainulits', 'YWRtaW4=', '5555555555', '5555', 'Informatika', '085755006308', 'user.png'),
(13, '010.002', '127.003', 3, 'Samudra Setiawan', 'samits', 'YWRtaW4=', '6666666666', '6666', 'Informatika', '085755006308', 'user.png'),
(14, '010.003', '127.001', 3, 'Nathanael Ifanda', 'nathanwaseda', 'YWRtaW4=', '7777777777', '7777', 'Statistika', '085755006308', 'user.png'),
(15, '010.003', '127.002', 3, 'M. Nur Fauzan Widyanto', 'joowaseda', 'YWRtaW4=', '8888888888', '8888', 'Informatika', '085755006308', 'user.png'),
(16, '010.003', '127.003', 3, 'M. Fahri Ilmy', 'ilmywaseda', 'YWRtaW4=', '999999999', '9999', 'Informatika', '085755006308', 'user.png');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=211;

--
-- AUTO_INCREMENT for table `tb_indikator`
--
ALTER TABLE `tb_indikator`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tb_instansi`
--
ALTER TABLE `tb_instansi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_kegiatan`
--
ALTER TABLE `tb_kegiatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `tb_pembahasan`
--
ALTER TABLE `tb_pembahasan`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_program`
--
ALTER TABLE `tb_program`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tb_registrasi`
--
ALTER TABLE `tb_registrasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_rekening`
--
ALTER TABLE `tb_rekening`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_detail_rekening`
--
ALTER TABLE `tb_detail_rekening`
  ADD CONSTRAINT `tb_detail_rekening_ibfk_1` FOREIGN KEY (`kode_instansi`) REFERENCES `tb_instansi` (`kode_instansi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_indikator`
--
ALTER TABLE `tb_indikator`
  ADD CONSTRAINT `tb_indikator_ibfk_1` FOREIGN KEY (`kode_instansi`) REFERENCES `tb_instansi` (`kode_instansi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_instansi`
--
ALTER TABLE `tb_instansi`
  ADD CONSTRAINT `tb_instansi_ibfk_1` FOREIGN KEY (`kode_admin`) REFERENCES `tb_admin` (`kode_admin`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_kegiatan`
--
ALTER TABLE `tb_kegiatan`
  ADD CONSTRAINT `tb_kegiatan_ibfk_1` FOREIGN KEY (`kode_instansi`) REFERENCES `tb_instansi` (`kode_instansi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_pembahasan`
--
ALTER TABLE `tb_pembahasan`
  ADD CONSTRAINT `tb_pembahasan_ibfk_1` FOREIGN KEY (`kode_instansi`) REFERENCES `tb_instansi` (`kode_instansi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_program`
--
ALTER TABLE `tb_program`
  ADD CONSTRAINT `tb_program_ibfk_1` FOREIGN KEY (`kode_admin`) REFERENCES `tb_admin` (`kode_admin`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_program_ibfk_2` FOREIGN KEY (`kode_instansi`) REFERENCES `tb_instansi` (`kode_instansi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_program_ibfk_3` FOREIGN KEY (`id_siswa`) REFERENCES `tb_siswa` (`id_siswa`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_rekening`
--
ALTER TABLE `tb_rekening`
  ADD CONSTRAINT `tb_rekening_ibfk_1` FOREIGN KEY (`kode_instansi`) REFERENCES `tb_instansi` (`kode_instansi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_rekening_ibfk_2` FOREIGN KEY (`kode_patokan`) REFERENCES `tb_patokan_rekening` (`kode_patokan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_rekening_ibfk_4` FOREIGN KEY (`kode_kegiatan`) REFERENCES `tb_kegiatan` (`kode_kegiatan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD CONSTRAINT `tb_siswa_ibfk_1` FOREIGN KEY (`kode_instansi`) REFERENCES `tb_instansi` (`kode_instansi`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
