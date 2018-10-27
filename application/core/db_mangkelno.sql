-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 27 Okt 2018 pada 10.52
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
(1, '100.001', 1, 'Fauzan', 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_instansi`
--

CREATE TABLE `tb_instansi` (
  `id` int(11) NOT NULL,
  `kode_admin` varchar(10) NOT NULL,
  `kode_instansi` varchar(20) NOT NULL,
  `hak_akses` int(1) NOT NULL,
  `nama_instansi` varchar(50) NOT NULL,
  `versi` varchar(20) NOT NULL,
  `keterangan` varchar(50) DEFAULT '-',
  `tahun` int(4) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_instansi`
--

INSERT INTO `tb_instansi` (`id`, `kode_admin`, `kode_instansi`, `hak_akses`, `nama_instansi`, `versi`, `keterangan`, `tahun`, `username`, `password`) VALUES
(3, '100.001', '010.6531', 3, 'SMKN 2 Surabaya', '', NULL, 2018, 'joo', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kegiatan`
--

CREATE TABLE `tb_kegiatan` (
  `id` int(11) NOT NULL,
  `kode_instansi` varchar(10) NOT NULL,
  `kode_program` varchar(10) NOT NULL,
  `kode_kegiatan` varchar(10) NOT NULL,
  `nama_kegiatan` varchar(40) NOT NULL,
  `total_rekening` int(11) NOT NULL DEFAULT '0',
  `total_rinci` int(11) NOT NULL DEFAULT '0',
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_program`
--

CREATE TABLE `tb_program` (
  `id` int(11) NOT NULL,
  `kode_admin` varchar(10) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `kode_instansi` varchar(25) NOT NULL,
  `kode_program` varchar(20) NOT NULL,
  `nama_program` varchar(50) NOT NULL,
  `plafon` varchar(15) NOT NULL,
  `total_rinci` varchar(15) NOT NULL,
  `total_rekening` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_program`
--

INSERT INTO `tb_program` (`id`, `kode_admin`, `id_siswa`, `kode_instansi`, `kode_program`, `nama_program`, `plafon`, `total_rinci`, `total_rekening`) VALUES
(6, '100.001', 0, '010.6531', '127.6542', 'Program', '5.000', '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_siswa`
--

CREATE TABLE `tb_siswa` (
  `id_siswa` int(11) NOT NULL,
  `kode_instansi` varchar(10) NOT NULL,
  `kode_program` varchar(10) NOT NULL,
  `hak_akses` int(1) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(32) NOT NULL,
  `nis` varchar(15) NOT NULL,
  `nisn` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id`);

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
  ADD KEY `kode_instansi_2` (`kode_instansi`),
  ADD KEY `kode_program` (`kode_program`),
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
-- AUTO_INCREMENT untuk tabel `tb_instansi`
--
ALTER TABLE `tb_instansi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_kegiatan`
--
ALTER TABLE `tb_kegiatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_program`
--
ALTER TABLE `tb_program`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tb_siswa`
--
ALTER TABLE `tb_siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_kegiatan`
--
ALTER TABLE `tb_kegiatan`
  ADD CONSTRAINT `tb_kegiatan_ibfk_1` FOREIGN KEY (`kode_program`) REFERENCES `tb_program` (`kode_program`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_program`
--
ALTER TABLE `tb_program`
  ADD CONSTRAINT `tb_program_ibfk_1` FOREIGN KEY (`kode_instansi`) REFERENCES `tb_instansi` (`kode_instansi`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
