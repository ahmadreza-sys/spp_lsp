-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:8111
-- Generation Time: Oct 01, 2026 at 08:23 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spp_lsp`
--

-- --------------------------------------------------------

--
-- Table structure for table `cek_pembayaran`
--

CREATE TABLE `cek_pembayaran` (
  `nisn` varchar(10) NOT NULL,
  `tgl_terakhir_bayar` date DEFAULT NULL,
  `tgl_sekarang` date DEFAULT NULL,
  `status_pembayaran` enum('Belum Lunas','Sudah Lunas') DEFAULT NULL,
  `jumlah_bulan` varchar(10) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `no_telp` varchar(13) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_kelas`
--

CREATE TABLE `tb_kelas` (
  `id_kelas` varchar(11) NOT NULL,
  `nama_kelas` varchar(10) NOT NULL,
  `kompetensi_keahlian` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_kelas`
--

INSERT INTO `tb_kelas` (`id_kelas`, `nama_kelas`, `kompetensi_keahlian`) VALUES
('KLS001', 'X RPL 1', 'Rekayasa Perangkat Lunak'),
('KLS002', 'X RPL 2', 'Rekayasa Perangkat Lunak'),
('KLS003', 'XI TKJ 1', 'Teknik Komputer Jaringan'),
('KLS004', 'XI TKJ 2', 'Teknik Komputer Jaringan'),
('KLS005', 'XII MM 1', 'Multimedia');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pembayaran`
--

CREATE TABLE `tb_pembayaran` (
  `id_pembayaran` varchar(11) NOT NULL,
  `status` enum('Belum Lunas','Sudah Lunas') NOT NULL,
  `nisn` varchar(10) NOT NULL,
  `tgl_bayar` date DEFAULT NULL,
  `tgl_terakhir_bayar` date DEFAULT NULL,
  `batas_pembayaran` date DEFAULT NULL,
  `jumlah_bulan` varchar(10) DEFAULT NULL,
  `id_spp` varchar(40) DEFAULT NULL,
  `nominal_bayar` varchar(100) DEFAULT NULL,
  `jumlah_bayar` varchar(40) DEFAULT NULL,
  `kembalian` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_pembayaran`
--

INSERT INTO `tb_pembayaran` (`id_pembayaran`, `status`, `nisn`, `tgl_bayar`, `tgl_terakhir_bayar`, `batas_pembayaran`, `jumlah_bulan`, `id_spp`, `nominal_bayar`, `jumlah_bayar`, `kembalian`) VALUES
('BYR0000002', 'Sudah Lunas', '0012345679', '2026-04-12', '2026-04-12', '2026-05-12', '1', 'SPP001', '150000', '150000', '0'),
('BYR000005', 'Belum Lunas', '0012345678', '2026-10-14', '2026-10-14', '2026-11-13', '12', 'SPP001', '150000', '1800000', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tb_petugas`
--

CREATE TABLE `tb_petugas` (
  `id_petugas` varchar(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(32) NOT NULL,
  `nama_petugas` varchar(35) NOT NULL,
  `level` enum('admin','petugas','siswa') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_petugas`
--

INSERT INTO `tb_petugas` (`id_petugas`, `username`, `password`, `nama_petugas`, `level`) VALUES
('PTG001', 'admin', 'admin', 'Administrator', 'admin'),
('PTG002', 'petugas', 'petugas', 'Petugas Sekolah andi', 'petugas'),
('PTG003', 'siswa', 'siswa', 'Akun Siswa', 'siswa'),
('PTG004', 'operator', 'operator', 'Operator SPP', 'petugas'),
('PTG005', 'demO', 'demo', 'User Demo', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `tb_siswa`
--

CREATE TABLE `tb_siswa` (
  `nisn` varchar(10) NOT NULL,
  `nis` varchar(8) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `id_kelas` varchar(11) NOT NULL,
  `nama_kelas` varchar(10) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `no_telp` varchar(13) NOT NULL,
  `id_spp` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_siswa`
--

INSERT INTO `tb_siswa` (`nisn`, `nis`, `nama`, `id_kelas`, `nama_kelas`, `alamat`, `no_telp`, `id_spp`) VALUES
('0012345678', '12345678', 'Andi Saputra', 'KLS001', 'X RPL 1', 'Jl. Melati No. 1', '0812345678901', 'SPP001'),
('0012345679', '12345679', 'Budi Santoso', 'KLS002', 'X RPL 2', 'Jl. Mawar No. 2', '081234567891', 'SPP001'),
('0012345680', '12345680', 'Citra Lestari', 'KLS003', 'XI TKJ 1', 'Jl. Kenanga No. 3', '081234567892', 'SPP002'),
('0012345681', '12345681', 'Deni Pratama', 'KLS004', 'XI TKJ 2', 'Jl. Anggrek No. 4', '081234567893', 'SPP002'),
('0012345682', '12345682', 'Eka Wulandari', 'KLS005', 'XII MM 1', 'Jl. Dahlia No. 5', '081234567894', 'SPP003');

-- --------------------------------------------------------

--
-- Table structure for table `tb_spp`
--

CREATE TABLE `tb_spp` (
  `id_spp` varchar(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `nominal` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_spp`
--

INSERT INTO `tb_spp` (`id_spp`, `tahun`, `nominal`) VALUES
('SPP001', 2026, '150000'),
('SPP002', 2026, '175000'),
('SPP003', 2026, '200000'),
('SPP004', 2026, '225000'),
('SPP005', 2026, '250000');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cek_pembayaran`
--
ALTER TABLE `cek_pembayaran`
  ADD PRIMARY KEY (`nisn`);

--
-- Indexes for table `tb_kelas`
--
ALTER TABLE `tb_kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indexes for table `tb_petugas`
--
ALTER TABLE `tb_petugas`
  ADD PRIMARY KEY (`id_petugas`);

--
-- Indexes for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD PRIMARY KEY (`nisn`);

--
-- Indexes for table `tb_spp`
--
ALTER TABLE `tb_spp`
  ADD PRIMARY KEY (`id_spp`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
