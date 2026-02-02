-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 26, 2026 at 03:25 PM
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
-- Database: `db_zivana_rawatinap`
--

-- --------------------------------------------------------

--
-- Table structure for table `kamar_zivana`
--

CREATE TABLE `kamar_zivana` (
  `id_kamar` varchar(5) NOT NULL,
  `no_kamar` varchar(11) NOT NULL,
  `kelas` varchar(5) NOT NULL,
  `status_kamar` varchar(11) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kamar_zivana`
--

INSERT INTO `kamar_zivana` (`id_kamar`, `no_kamar`, `kelas`, `status_kamar`, `harga`) VALUES
('KM551', '1NF', 'A', 'tidak', 1000000),
('KM552', '2NF', 'C', 'tersedia', 500000),
('KM553', '3NF', 'A', 'Tersedia', 1000000),
('KM554', '4NF', 'B', 'tidak', 750000),
('KM555', '5NF', 'B', 'Tersedia', 750000);

-- --------------------------------------------------------

--
-- Table structure for table `pasien_zivana`
--

CREATE TABLE `pasien_zivana` (
  `id_pasien` varchar(5) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `kontak` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pasien_zivana`
--

INSERT INTO `pasien_zivana` (`id_pasien`, `nama`, `alamat`, `kontak`) VALUES
('P-001', 'Paul Klein', 'LA, New York 90', '093725472517'),
('P-002', 'James', 'Taiwan, 098', '025473828493'),
('P-003', 'Justin Bieber', 'London G65', '062836271632'),
('P-004', 'Ciel', 'Belanda, 098', '084627163723'),
('P-005', 'Jay Park', 'South Korean', '098372637261');

-- --------------------------------------------------------

--
-- Table structure for table `rawat_inap_zivana`
--

CREATE TABLE `rawat_inap_zivana` (
  `id_rawat` varchar(5) NOT NULL,
  `id_pasien` varchar(5) NOT NULL,
  `id_kamar` varchar(5) NOT NULL,
  `tgl_masuk` date NOT NULL,
  `tgl_keluar` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rawat_inap_zivana`
--

INSERT INTO `rawat_inap_zivana` (`id_rawat`, `id_pasien`, `id_kamar`, `tgl_masuk`, `tgl_keluar`) VALUES
('RP001', 'P-001', 'KM551', '2026-01-26', '2026-01-29');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_zivana`
--

CREATE TABLE `transaksi_zivana` (
  `id_transaksi` int(5) NOT NULL,
  `id_pasien` varchar(5) NOT NULL,
  `id_kamar` varchar(5) NOT NULL,
  `kode_tr` varchar(10) NOT NULL,
  `total_bayar` int(11) NOT NULL,
  `status_pembayaran` varchar(15) NOT NULL,
  `tgl` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi_zivana`
--

INSERT INTO `transaksi_zivana` (`id_transaksi`, `id_pasien`, `id_kamar`, `kode_tr`, `total_bayar`, `status_pembayaran`, `tgl`) VALUES
(12, 'P-001', 'KM551', 'TR0001', 3000000, 'Lunas', '2026-01-26');

-- --------------------------------------------------------

--
-- Table structure for table `user_zivana`
--

CREATE TABLE `user_zivana` (
  `id_user` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_zivana`
--

INSERT INTO `user_zivana` (`id_user`, `username`, `password`) VALUES
('USR10', 'zivana123', '123zivana'),
('USR11', 'ciel321', '321ciel'),
('USR12', 'lany890', '890lany'),
('USR13', 'james098', '098james'),
('USR14', 'justin456', '456justin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kamar_zivana`
--
ALTER TABLE `kamar_zivana`
  ADD PRIMARY KEY (`id_kamar`);

--
-- Indexes for table `pasien_zivana`
--
ALTER TABLE `pasien_zivana`
  ADD PRIMARY KEY (`id_pasien`);

--
-- Indexes for table `rawat_inap_zivana`
--
ALTER TABLE `rawat_inap_zivana`
  ADD PRIMARY KEY (`id_rawat`),
  ADD KEY `id_pasien` (`id_pasien`),
  ADD KEY `id_kamar` (`id_kamar`);

--
-- Indexes for table `transaksi_zivana`
--
ALTER TABLE `transaksi_zivana`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_pasien` (`id_pasien`),
  ADD KEY `kode_tr` (`kode_tr`),
  ADD KEY `id_kamar` (`id_kamar`);

--
-- Indexes for table `user_zivana`
--
ALTER TABLE `user_zivana`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `transaksi_zivana`
--
ALTER TABLE `transaksi_zivana`
  MODIFY `id_transaksi` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `rawat_inap_zivana`
--
ALTER TABLE `rawat_inap_zivana`
  ADD CONSTRAINT `rawat_inap_zivana_ibfk_1` FOREIGN KEY (`id_kamar`) REFERENCES `kamar_zivana` (`id_kamar`),
  ADD CONSTRAINT `rawat_inap_zivana_ibfk_2` FOREIGN KEY (`id_pasien`) REFERENCES `pasien_zivana` (`id_pasien`);

--
-- Constraints for table `transaksi_zivana`
--
ALTER TABLE `transaksi_zivana`
  ADD CONSTRAINT `transaksi_zivana_ibfk_1` FOREIGN KEY (`id_kamar`) REFERENCES `kamar_zivana` (`id_kamar`),
  ADD CONSTRAINT `transaksi_zivana_ibfk_2` FOREIGN KEY (`id_pasien`) REFERENCES `pasien_zivana` (`id_pasien`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
