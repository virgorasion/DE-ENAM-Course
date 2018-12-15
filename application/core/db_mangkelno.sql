-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 15 Des 2018 pada 14.23
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
-- Struktur dari tabel `tb_detail_rekening`
--

CREATE TABLE `tb_detail_rekening` (
  `id` int(11) NOT NULL,
  `kode_detail_rekening` varchar(10) NOT NULL,
  `kode_instansi` varchar(10) NOT NULL,
  `kode_program` varchar(10) NOT NULL,
  `kode_kegiatan` varchar(10) NOT NULL,
  `kode_rekening` varchar(10) NOT NULL,
  `jenis` varchar(20) NOT NULL,
  `uraian` varchar(100) NOT NULL,
  `sub_uraian` varchar(100) NOT NULL,
  `sasaran` varchar(50) NOT NULL,
  `lokasi` varchar(100) NOT NULL,
  `dana` varchar(10) NOT NULL,
  `satuan` varchar(10) NOT NULL,
  `volume` int(3) NOT NULL,
  `harga` int(10) NOT NULL,
  `total` int(10) NOT NULL,
  `keterangan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_detail_rekening`
--

INSERT INTO `tb_detail_rekening` (`id`, `kode_detail_rekening`, `kode_instansi`, `kode_program`, `kode_kegiatan`, `kode_rekening`, `jenis`, `uraian`, `sub_uraian`, `sasaran`, `lokasi`, `dana`, `satuan`, `volume`, `harga`, `total`, `keterangan`) VALUES
(5, '5.04.01', '010.6531', '127.3321', '080.001', '5.04', 'Peralatan Kantor', 'Beli Printer', 'Printer Canon x1222', 'Dinas Pendidikan', 'Jalan Mayjend Sungkono 100', '1', 'Buah', 2, 1000000, 2000, 'Nota pembelian ada d'),
(6, '5.04.01', '010.6531', '127.3321', '080.001', '5.04', 'Peralatan Kantor', 'Beli Bolpoin', 'Bolpoin Faster A35', 'Dinas Pendidikan', 'Jalan Mayjend Sungkono 100', '1', 'Pack', 10, 500000, 5000, 'Nota pembelian ada di meja sekretaris'),
(9, '5.04.01', '010.6531', '127.3321', '080.001', '5.04', 'Peralatan Kantor', 'Beli Printer', 'Printer Nikon 23A', 'Dinas Kependudukan', 'Tunjungan', '1', 'Buah', 5, 500000, 2500000, 'Nota pembelian ada di meja sekretaris'),
(10, '5.04.01', '010.6531', '127.3321', '080.001', '5.04', 'Peralatan Kantor', 'Beli Printer', 'Printer Canon x1222', 'Dinas Pendidikan', 'Jalan Mayjend Sungkono 100', '1', 'Pack', 5, 1000000, 5000000, 'Nota pembelian ada di meja sekretaris'),
(11, '5.1.1.14.0', '010.6531', '127.3321', '080.001', '5.1.1.16', 'Peralatan Kantor', 'Beli mesin fotocopy', 'Meja Ikea 2A', 'Dinas Pendidikan', 'Jalan Mayjend Sungkono 100', '1', 'Pack', 5, 500000, 2500000, 'Nota pembelian ada di meja sekretaris'),
(12, '5.1.1.15.0', '010.6531', '127.3321', '080.001', '5.1.1.16', 'Peralatan Kantor', 'Beli mesin fotocopy', 'Printer Canon x1222', 'Dinas Pendidikan', 'Jalan Mayjend Sungkono 100', '1', 'Buah', 2, 1000000, 2000000, 'Nota pembelian ada di meja sekretaris');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_indikator`
--

CREATE TABLE `tb_indikator` (
  `id` int(3) NOT NULL,
  `kode_indikator` varchar(10) NOT NULL,
  `kode_kegiatan` varchar(10) NOT NULL,
  `jenis` varchar(15) NOT NULL,
  `uraian` varchar(50) NOT NULL,
  `satuan` varchar(10) NOT NULL,
  `target` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(3, '100.001', '010.6531', 2, 'SMKN 2 Surabaya', '', NULL, 2018, 'joo', '21232f297a57a5a743894a0e4a801fc3'),
(4, '100.001', '010.0001', 2, 'SMK Siang', '', NULL, 2017, 'siang', '21232f297a57a5a743894a0e4a801fc3');

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

--
-- Dumping data untuk tabel `tb_kegiatan`
--

INSERT INTO `tb_kegiatan` (`id`, `kode_instansi`, `kode_program`, `kode_kegiatan`, `nama_kegiatan`, `total_rekening`, `total_rinci`, `keterangan`) VALUES
(4, '010.6531', '127.3321', '080.001', 'Biaya makanan ringan', 0, 0, 'Cek Edit Kegiatan'),
(6, '010.6531', '127.3321', '080.100', 'Kegiatan Baru', 0, 0, 'Cek tambah kegiatan untuk rekening');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_patokan_rekening`
--

CREATE TABLE `tb_patokan_rekening` (
  `kode_patokan` varchar(10) NOT NULL,
  `nama` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_patokan_rekening`
--

INSERT INTO `tb_patokan_rekening` (`kode_patokan`, `nama`) VALUES
('5', 'Belanja Daerah'),
('5.1', 'Belanja Tidak Langsung'),
('5.1.1', 'Belanja Pegawai');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pembahasan`
--

CREATE TABLE `tb_pembahasan` (
  `id` int(3) NOT NULL,
  `kode_pembahasan` varchar(10) NOT NULL,
  `kode_kegiatan` varchar(10) NOT NULL,
  `uraian` varchar(100) NOT NULL
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
(8, '100.001', 2, '010.6531', '127.3321', 'Program Makan Bersama', '50.000', '', ''),
(9, '100.001', 0, '010.6531', '127. 02', 'Kerja Bakti 17 Agustus', '1.000.000', '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_rekening`
--

CREATE TABLE `tb_rekening` (
  `id` int(11) NOT NULL,
  `kode_patokan` varchar(10) NOT NULL,
  `kode_instansi` varchar(10) NOT NULL,
  `kode_program` varchar(10) NOT NULL,
  `kode_kegiatan` varchar(10) NOT NULL,
  `kode_rekening` varchar(15) NOT NULL,
  `uraian_rekening` varchar(50) NOT NULL,
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
(1, '5', '010.6531', '127.3321', '080.001', '5.04', 'Belanja Gincu', 12311, 510000, 550000, 400000, 0, 0),
(13, '5.1.1', '010.6531', '127.3321', '080.001', '5.1.1.16', 'test error kode_rekening', 500000, 500000, 2500000, 1000000, 4500000, NULL),
(14, '5.1', '010.6531', '127.3321', '080.001', '5.1.01', 'Test Session', 124120, 39423, 123923, 87341, NULL, NULL),
(17, '5.1.1', '010.6531', '127.3321', '080.001', '5.1.1.04', 'Test error tab', 0, 0, 0, 0, NULL, NULL),
(19, '5.1', '010.6531', '127.3321', '080.001', '5.1.01', 'fix error tab id ', 9127631, 81723193, 9712512, 9861231, NULL, NULL);

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
-- Dumping data untuk tabel `tb_siswa`
--

INSERT INTO `tb_siswa` (`id_siswa`, `kode_instansi`, `kode_program`, `hak_akses`, `nama`, `username`, `password`, `nis`, `nisn`) VALUES
(2, '010.6531', '127.3321', 3, 'Fauzan Widyanto', 'joo', '21232f297a57a5a743894a0e4a801fc3', '35435', '0008096617');

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
  ADD KEY `kode_rekening` (`kode_rekening`);

--
-- Indexes for table `tb_indikator`
--
ALTER TABLE `tb_indikator`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kode_indikator` (`kode_indikator`),
  ADD KEY `kode_kegiatan` (`kode_kegiatan`);

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
  ADD KEY `kode_instansi_2` (`kode_instansi`),
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
-- Indexes for table `tb_rekening`
--
ALTER TABLE `tb_rekening`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kode_kegiatan` (`kode_kegiatan`),
  ADD KEY `kode_patokan` (`kode_patokan`),
  ADD KEY `kode_rekening` (`kode_rekening`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tb_indikator`
--
ALTER TABLE `tb_indikator`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_instansi`
--
ALTER TABLE `tb_instansi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_kegiatan`
--
ALTER TABLE `tb_kegiatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_pembahasan`
--
ALTER TABLE `tb_pembahasan`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_program`
--
ALTER TABLE `tb_program`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tb_rekening`
--
ALTER TABLE `tb_rekening`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  ADD CONSTRAINT `tb_indikator_ibfk_1` FOREIGN KEY (`kode_kegiatan`) REFERENCES `tb_kegiatan` (`kode_kegiatan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_instansi`
--
ALTER TABLE `tb_instansi`
  ADD CONSTRAINT `tb_instansi_ibfk_1` FOREIGN KEY (`kode_admin`) REFERENCES `tb_admin` (`kode_admin`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_kegiatan`
--
ALTER TABLE `tb_kegiatan`
  ADD CONSTRAINT `tb_kegiatan_ibfk_1` FOREIGN KEY (`kode_program`) REFERENCES `tb_program` (`kode_program`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_pembahasan`
--
ALTER TABLE `tb_pembahasan`
  ADD CONSTRAINT `tb_pembahasan_ibfk_1` FOREIGN KEY (`kode_kegiatan`) REFERENCES `tb_kegiatan` (`kode_kegiatan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_program`
--
ALTER TABLE `tb_program`
  ADD CONSTRAINT `tb_program_ibfk_1` FOREIGN KEY (`kode_instansi`) REFERENCES `tb_instansi` (`kode_instansi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_rekening`
--
ALTER TABLE `tb_rekening`
  ADD CONSTRAINT `tb_rekening_ibfk_1` FOREIGN KEY (`kode_kegiatan`) REFERENCES `tb_kegiatan` (`kode_kegiatan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_rekening_ibfk_2` FOREIGN KEY (`kode_patokan`) REFERENCES `tb_patokan_rekening` (`kode_patokan`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD CONSTRAINT `tb_siswa_ibfk_1` FOREIGN KEY (`kode_instansi`) REFERENCES `tb_instansi` (`kode_instansi`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
