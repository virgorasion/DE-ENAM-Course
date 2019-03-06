-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 06 Mar 2019 pada 14.49
-- Versi server: 10.1.30-MariaDB
-- Versi PHP: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_mangkelno`
--

DELIMITER $$
--
-- Prosedur
--
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
  `username` varchar(10) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_admin`
--

INSERT INTO `tb_admin` (`id`, `kode_admin`, `hak_akses`, `nama`, `username`, `password`) VALUES
(1, '100.001', 1, 'Fauzan', 'admin', 'YWRtaW4=');

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
(8, '5.1.01.01', '010.0001', '127.3321', '080.001', '5.1.06', 'test input', 'Test Duplicate', 'test', 'database', 'localhost', '2', '1', 1, 129996, 129996, 'testing '),
(21, '5.1.02.01', '010.6531', '127.3321', '080.001', '5.1.06', 'test input', 'aaskdgaskd', 'ajshd', 'ajsdh', 'kajsdh', '1', '124', 1241, 12412, 15403292, ''),
(22, '5.1.02.01', '010.6531', '127.3321', '080.001', '5.1.06', 'tset', 'tset', 'as;kda', 'kjasbd', 'aksdn', '1', '12', 10, 2150000, 21500000, ''),
(23, '5.01', '010.6531', '127.125', '080.653', '5.1.02', 'Belanja Daerah', 'Beli Printer', 'Printer Canon x1222', 'Dinas Kependudukan', 'Surabaya', '2', 'Buah', 1, 25220990, 25220990, ''),
(24, '5.01.01', '010.03', '127.01', '080.01', '5.2.2.01', 'Belanja Daerah', 'Belanja Tahun Baru 2019', 'Tahun 2019', 'Rumah', 'Kapas Madya', '1', 'Paket', 2, 1000000, 2000000, 'Untuk Tahun 2019'),
(25, '5.1.1.01.01', '010.03', '127.01', '080.01', '5.1.1.04', 'Pembelian', 'Beli 1pcs pizza cheese bites', '', 'Perut', 'Surabaya', '1', 'pcs', 1, 140000, 140000, ''),
(26, '5.1.1.01.02', '010.03', '127.01', '080.01', '5.1.1.04', 'Pembelian', 'Beli 2pcs pizza cheese bites', 'asdas', 'Perut', 'Surabaya', '1', 'pcs', 20, 14000, 280000, ''),
(27, '5.1.1.01.03', '010.03', '127.01', '080.01', '5.1.1.04', 'Pembelian', 'Beli 3pcs pizza cheese bites', 'test', 'Perut', 'Surabaya', '1', '10', 3, 140000, 420000, ''),
(28, '5.1.1.01.04', '010.03', '127.01', '080.01', '5.1.1.04', 'Pembelian', 'Beli 1pcs pizza cheese bites', 'test', 'Perut', 'Surabaya', '1', 'pcs', 1, 140000, 140000, ''),
(29, '5.1.01.01', '010.03', '127.01', '080.01', '5.1.01', 'Test trigger', 'Test Duplicate', '', '', '', '1', '', 5, 50000, 250000, '');

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
  `uraian` varchar(50) NOT NULL,
  `satuan` varchar(10) NOT NULL,
  `target` int(3) NOT NULL,
  `nilai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_indikator`
--

INSERT INTO `tb_indikator` (`id`, `kode_indikator`, `kode_instansi`, `kode_program`, `jenis`, `uraian`, `satuan`, `target`, `nilai`) VALUES
(4, '1.001', '010.6531', '127.03', '1', 'Pencapaian Terbaru', 'Paket', 100, 0),
(6, '1.001', '010.03', '127.12', '1', 'Indikator Baru', 'OK', 100, 500),
(7, '1.001', '010.03', '127.01', '2', 'Capaian tahun 2018', 'Paket', 20, 0),
(10, '1.003', '010.03', '127.01', '3', 'jhf', '12', 2, 0),
(12, '1.002', '010.03', '127.12', '2', 'Hasil', 'pcs', 10, 100),
(13, '1.004', '010.03', '127.01', '1', 'Test', 'Paket', 20, 500);

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
(3, '100.001', '010.6531', 2, 'SMKN 2 Surabaya', '', '', NULL, 2018, 'joo', 'YWRtaW4=', 'user.png'),
(4, '100.001', '010.0001', 2, 'SMK Siang', '', '', NULL, 2017, 'siang', 'YWRtaW4=', 'user.png'),
(5, '100.001', '010.03', 2, 'SMKN 10 Surabaya', 'APBD - 1', '', NULL, 2018, 'smk10', 'YWRtaW4=', 'user.png'),
(6, '100.001', '010.1208410', 2, 'Sekolah Baru Buat', 'APBD -1', 'Surabaya', NULL, 2019, 'baru', 'YWRtaW4=', 'user.png'),
(7, '100.001', '010.81246', 2, 'SMK Biasa', 'APBD', 'surabaya', NULL, 2019, 'biasa', 'YWRtaW4=', 'user.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kegiatan`
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
-- Dumping data untuk tabel `tb_kegiatan`
--

INSERT INTO `tb_kegiatan` (`id`, `kode_instansi`, `kode_program`, `kode_kegiatan`, `nama_kegiatan`, `total_rekening`, `total_rinci`, `keterangan`) VALUES
(4, '010.6531', '127.3321', '080.001', 'Biaya makanan ringan', 59338636, 36903292, 'Cek Edit Kegiatan'),
(6, '010.6531', '127.3321', '080.100', 'Kegiatan Baru', 0, 0, 'Cek tambah kegiatan untuk rekening'),
(8, '010.0001', '127.3321', '080.001', 'Kegiatan Testing', 0, 0, 'Test diplicate data'),
(9, '010.6531', '127.03', '080.01', 'Kegiatan Test program', 25220990, 25220990, 'Rutinitas :v'),
(10, '010.03', '127.12', '080.001', 'Honor Kepsek', 1000000, 0, 'Baru'),
(12, '010.03', '127.01', '080.01', 'Kamis 27 Desember 2018', 2980000, 1230000, 'Tahun Baru'),
(13, '010.03', '127.01', '080.02', 'Jumat 28 Desember 2018', 21768216, 0, 'Tahun Baru'),
(14, '010.03', '127.01', '080.03', 'Sabtu 29 Desember 2018', 0, 0, ''),
(15, '010.81246', '127.971263', '080.7124', 'Kegiatan\'Q', 0, 0, '-');

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

--
-- Dumping data untuk tabel `tb_pembahasan`
--

INSERT INTO `tb_pembahasan` (`id`, `kode_pembahasan`, `kode_instansi`, `kode_program`, `kode_kegiatan`, `kode_rekening`, `id_siswa`, `nama_siswa`, `plafon`, `triwulan1_rekening`, `triwulan2_rekening`, `triwulan3_rekening`, `triwulan4_rekening`, `total_rekening`, `triwulan1_pembahasan`, `triwulan2_pembahasan`, `triwulan3_pembahasan`, `triwulan4_pembahasan`, `nilai`, `uraian`) VALUES
(6, '341', '010.03', '127.01', '080.01', '5.01', 7, 'Joo', '2.980.000', 500000, 500000, 500000, 500000, 2980000, '596.000', '1.043.000', '894.000', '447.000', 80, 'Beli juga makanan yang sehat');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_program`
--

CREATE TABLE `tb_program` (
  `id` int(11) NOT NULL,
  `kode_admin` varchar(10) NOT NULL,
  `id_siswa` int(11) NOT NULL,
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
(8, '100.001', 2, '010.6531', '127.3321', '', '', '', 'Program Makan Bersama', '50000', '36903292', '59338636'),
(9, '100.001', 6, '010.6531', '127.03', '', '', '', 'Kerja Bakti 17 Agustus', '25220990', '25220990', '25220990'),
(11, '100.001', 11, '010.0001', '127.3321', '', '', '', 'Program testing', '9000000', '', ''),
(12, '100.001', 6, '010.03', '127.12', '', '', '', 'Baru', '1000000', '', '1000000'),
(14, '100.001', 7, '010.6531', '127.02', '', '', '', 'lama', '2000000', '', ''),
(15, '100.001', 0, '010.03', '127.01', 'Program Baru', 'Hari ini', 'Semuanya', 'Hari Ini', '2980000', '1230000', '24748216'),
(16, '100.001', 5, '010.03', '127.02', 'PEMBANGUNAN', 'Program ini dibuat pada 11 Januari 2019', 'Dinas Pendidikan', 'Untuk siswa Nathanael Ifanda', '1000000', '', ''),
(17, '100.001', 9, '010.1208410', '127.28741', 'Program', 'Ini Program', 'Semuanya', 'Program Baru', '20000000', '', ''),
(18, '0', 12, '010.1208410', '127.9817', 'tset', 'lajsd', 'ajbf', 'poras', '2000000', '', ''),
(19, '100.001', 10, '010.81246', '127.971263', 'Program', 'Pasdaroh', 'semuanya', 'Progarm', '20000000', '', ''),
(20, '100.001', 13, '010.0001', '127.172471249', 'test', 'tses', 'tseas', 'tese', '91283124', '', '');

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

--
-- Dumping data untuk tabel `tb_registrasi`
--

INSERT INTO `tb_registrasi` (`id`, `nama`, `instansi`, `jurusan`, `nis`, `nisn`, `no_telp`, `username`, `foto`, `waktu`) VALUES
(29, 'asndb', 'kabd', 'kabsd', 'kasbd', 'kasbd', 'kasbd', '', '349f47221b34c3bfb5c22e64d7764ef8.jpg', '2019-03-05');

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
(14, '5.1', '010.6531', '127.3321', '080.001', '5.1.01', '', 124120, 39423, 123923, 87341, NULL, NULL),
(19, '5.1', '010.6531', '127.3321', '080.001', '5.1.06', '', 9127631, 7723122, 9712512, 9861231, 36424496, 36903292),
(23, '5', '010.6531', '127.3321', '080.001', '5.02', '', 0, 0, 0, 0, 0, 0),
(24, '5', '010.6531', '127.3321', '080.001', '5.03', '', 0, 0, 0, 0, 0, 0),
(26, '5.1', '010.0001', '127.3321', '080.001', '5.1.01', '', 99999, 9999, 9999, 9999, 129996, 129996),
(28, '5', '010.6531', '127.3321', '080.001', '5.04', '', 25235, 235235, 23523, 23523, 307516, 0),
(29, '5.1', '010.6531', '127.125', '080.01', '5.1.02', '', 1226295, 12048173, 9812410, 2134112, 25220990, 25220990),
(30, '5.2.2', '010.03', '127.12', '080.001', '5.2.2.01', 'Honorarium Pengelola Keuangan, Barang Daerah, dan Sistem Informasi PNS', 250000, 250000, 250000, 250000, 1000000, 0),
(32, '5.1', '010.6531', '127.125', '080.01', '5.1.01', '', 0, 0, 0, 0, 0, 0),
(34, '5.1.1', '010.03', '127.01', '080.01', '5.1.1.04', '', 280000, 280000, 140000, 280000, 980000, 980000),
(35, '5.1.1', '010.03', '127.01', '080.01', '5.1.1.05', '', 0, 0, 0, 0, 0, 0),
(36, '5.5.2', '010.03', '127.01', '080.02', '5.5.2.01', '', 9981237, 9812731, 987124, 987124, 21768216, 0),
(37, '5.5.4', '010.6531', '127.3321', '080.001', '5.5.4.02', 'Belanja Modal Pengadaan Alat-a', 600000, 1082471, 182712, 1271212, 3136395, 0),
(38, '5.2.2', '010.6531', '127.3321', '080.001', '5.2.2.01', 'Honorarium Pengelola Keuangan, Barang Daerah, dan Sistem Informasi PNS', 19249, 9849238, 872394, 8729348, 19470229, 0),
(39, '5.1', '010.03', '127.01', '080.01', '5.1.01', 'Belanja Tidak Langsung', 500000, 500000, 500000, 500000, 2000000, 250000);

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
(5, '010.6531', '127.125', 3, 'Fauzam', 'Fauzan', 'YWRtaW4=', '123123', '123123', '', '', 'user.png'),
(6, '010.03', '127.12', 3, 'Nathanael Ifanda', 'nathan', 'YWRtaW4=', '123', '123', '', '', 'user.png'),
(7, '010.6531', '127.02', 3, 'M Nur Fauzan W', 'joo123', 'S2FsYWplbmdraW5n', '1270801', '0008096617', 'Rekayasa Perangkat Lunak', '083849575737', 'user.png'),
(8, '010.03', '', 3, 'Nathanael Ifanda', 'ethan', 'YWRtaW4=', '1122334455', '123123', 'Rekayasa Perangkat Lunak', '085755006308', 'user.png'),
(9, '010.120841', '127.28741', 3, 'Siswa Baru', 'siswa', 'YWRtaW4=', '87214', '00007124861', 'RPL', '0987124712', 'user.png'),
(10, '010.81246', '127.971263', 3, 'joo-kun', 'murid', 'YWRtaW4=', '917264', '00091241', 'RPL', '009817241', 'user.png'),
(11, '010.0001', '127.3321', 3, 'test dafter', 'ahjsvd', 'YWRtaW4=', 'jahsvd', 'jasvd', 'jasvd', 'khasvd', 'user.png'),
(12, '010.120841', '127.9817', 3, 'Sony Adi Adriko', 'Tersearah', 'YWRtaW4=', '91294612', '238432', 'Treserah', '083849575737', '85ab08617470249a986ad29e4c85f1b7.jpg'),
(13, '010.0001', '127.172471249', 3, 'Joonokoto', 'jookun', 'am9v', '091924', '0008124128', 'RPL', '081273124', 'bd767167664b684461349fe28352dfae.png');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kode_admin` (`kode_admin`);

--
-- Indeks untuk tabel `tb_detail_rekening`
--
ALTER TABLE `tb_detail_rekening`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kode_rekening` (`kode_rekening`),
  ADD KEY `kode_instansi` (`kode_instansi`),
  ADD KEY `kode_program` (`kode_program`),
  ADD KEY `kode_kegiatan` (`kode_kegiatan`);

--
-- Indeks untuk tabel `tb_indikator`
--
ALTER TABLE `tb_indikator`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kode_indikator` (`kode_indikator`),
  ADD KEY `kode_instansi` (`kode_instansi`),
  ADD KEY `kode_program` (`kode_program`);

--
-- Indeks untuk tabel `tb_instansi`
--
ALTER TABLE `tb_instansi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_instansi` (`kode_instansi`),
  ADD KEY `kode_admin` (`kode_admin`);

--
-- Indeks untuk tabel `tb_kegiatan`
--
ALTER TABLE `tb_kegiatan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kode_instansi` (`kode_instansi`),
  ADD KEY `kode_program` (`kode_program`),
  ADD KEY `kode_kegiatan` (`kode_kegiatan`);

--
-- Indeks untuk tabel `tb_patokan_rekening`
--
ALTER TABLE `tb_patokan_rekening`
  ADD PRIMARY KEY (`kode_patokan`);

--
-- Indeks untuk tabel `tb_pembahasan`
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
-- Indeks untuk tabel `tb_program`
--
ALTER TABLE `tb_program`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kode_instansi` (`kode_instansi`),
  ADD KEY `id_siswa` (`id_siswa`),
  ADD KEY `kode_admin` (`kode_admin`),
  ADD KEY `kode_program` (`kode_program`);

--
-- Indeks untuk tabel `tb_registrasi`
--
ALTER TABLE `tb_registrasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kode_instansi` (`instansi`);

--
-- Indeks untuk tabel `tb_rekening`
--
ALTER TABLE `tb_rekening`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kode_kegiatan` (`kode_kegiatan`),
  ADD KEY `kode_patokan` (`kode_patokan`),
  ADD KEY `kode_rekening` (`kode_rekening`),
  ADD KEY `kode_instansi` (`kode_instansi`),
  ADD KEY `kode_program` (`kode_program`);

--
-- Indeks untuk tabel `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD PRIMARY KEY (`id_siswa`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `kode_program` (`kode_program`),
  ADD KEY `kode_instansi` (`kode_instansi`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_detail_rekening`
--
ALTER TABLE `tb_detail_rekening`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT untuk tabel `tb_indikator`
--
ALTER TABLE `tb_indikator`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `tb_instansi`
--
ALTER TABLE `tb_instansi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tb_kegiatan`
--
ALTER TABLE `tb_kegiatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `tb_pembahasan`
--
ALTER TABLE `tb_pembahasan`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tb_program`
--
ALTER TABLE `tb_program`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `tb_registrasi`
--
ALTER TABLE `tb_registrasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT untuk tabel `tb_rekening`
--
ALTER TABLE `tb_rekening`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT untuk tabel `tb_siswa`
--
ALTER TABLE `tb_siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_detail_rekening`
--
ALTER TABLE `tb_detail_rekening`
  ADD CONSTRAINT `tb_detail_rekening_ibfk_1` FOREIGN KEY (`kode_rekening`) REFERENCES `tb_rekening` (`kode_rekening`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_indikator`
--
ALTER TABLE `tb_indikator`
  ADD CONSTRAINT `tb_indikator_ibfk_2` FOREIGN KEY (`kode_instansi`) REFERENCES `tb_instansi` (`kode_instansi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_indikator_ibfk_3` FOREIGN KEY (`kode_program`) REFERENCES `tb_program` (`kode_program`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_instansi`
--
ALTER TABLE `tb_instansi`
  ADD CONSTRAINT `tb_instansi_ibfk_1` FOREIGN KEY (`kode_admin`) REFERENCES `tb_admin` (`kode_admin`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
