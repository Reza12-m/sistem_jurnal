-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 18, 2024 at 09:18 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `judul_skripsi`
--

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `dosen_id` int(9) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `aktif` tinyint(1) NOT NULL,
  `prodi_id` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`dosen_id`, `nama_lengkap`, `email`, `aktif`, `prodi_id`) VALUES
(1, 'nindy devita sari', 'nindy2121@gmail.com', 1, 5),
(2, 'Uli Rizki,M.Kom', 'uliubuntu@gmail.com', 1, 5),
(3, 'Abul Hasan, M.Pd', 'abhoelhasa@gmail.com', 0, 5),
(4, 'Neti Kartini, M.Pd', 'netykartini05@gmail.com', 1, 5),
(5, 'Iqbal Mustofa, M.Kom', 'iqbal4566@gmail.com', 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `prodi`
--

CREATE TABLE `prodi` (
  `prodi_id` int(9) NOT NULL,
  `nama_prodi` varchar(255) NOT NULL,
  `nama_pendek` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prodi`
--

INSERT INTO `prodi` (`prodi_id`, `nama_prodi`, `nama_pendek`) VALUES
(1, 'Pendidikan Teknologi Informasi', 'PTI'),
(2, 'Pendidikan Agama Islam', 'PAI'),
(3, 'Pendidikan Fisika', 'PF'),
(4, 'Pendidikan Bahasa Inggris', 'PBI'),
(5, 'Pendidikan Ekomoni', 'PE'),
(6, 'Pendidikan Bahasa & Sastra Indonesia', 'PBSI');

-- --------------------------------------------------------

--
-- Table structure for table `skripsi`
--

CREATE TABLE `skripsi` (
  `skripsi_id` int(9) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `metode_penelitian` varchar(255) NOT NULL,
  `tahun` int(6) NOT NULL,
  `nim` char(11) NOT NULL,
  `nama_mahasiswa` varchar(255) NOT NULL,
  `prodi_id` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `skripsi`
--

INSERT INTO `skripsi` (`skripsi_id`, `judul`, `metode_penelitian`, `tahun`, `nim`, `nama_mahasiswa`, `prodi_id`) VALUES
(1, 'Efektivitas Penggunaan Media Audio Visual dalam Pembelajaran Matematika di Sekolah Menengah Atas ', 'kuantitatif', 2020, '2183207043', 'Adip Prasetyo', 1),
(2, 'Pengaruh Peran Guru dalam Meningkatkan Kemandirian Belajar Siswa Sekolah Dasar', 'kualitatif', 2021, '2183207016', 'Deni Aditiya', 2),
(3, 'Penerapan Pembelajaran Berbasis Proyek dalam Meningkatkan Kemampuan Keterampilan Berpikir Kreatif Siswa Sekolah Dasar', 'kuantitatif', 2019, '2183207077', 'Reza Febrian', 3),
(4, 'Analisis Pengaruh Lingkungan Sekolah terhadap Kepuasan Orang Tua terhadap Pendidikan di Sekolah Menengah Atas', 'kualitatif', 2019, '2183207067', 'Meli Kharisma', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`dosen_id`),
  ADD KEY `dosen_id_prodi_foreign_id` (`prodi_id`);

--
-- Indexes for table `prodi`
--
ALTER TABLE `prodi`
  ADD PRIMARY KEY (`prodi_id`);

--
-- Indexes for table `skripsi`
--
ALTER TABLE `skripsi`
  ADD PRIMARY KEY (`skripsi_id`),
  ADD KEY `prodi_id_skripsi_foreign_id` (`prodi_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dosen`
--
ALTER TABLE `dosen`
  MODIFY `dosen_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `prodi`
--
ALTER TABLE `prodi`
  MODIFY `prodi_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `skripsi`
--
ALTER TABLE `skripsi`
  MODIFY `skripsi_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dosen`
--
ALTER TABLE `dosen`
  ADD CONSTRAINT `dosen_id_prodi_foreign_id` FOREIGN KEY (`prodi_id`) REFERENCES `prodi` (`prodi_id`);

--
-- Constraints for table `skripsi`
--
ALTER TABLE `skripsi`
  ADD CONSTRAINT `prodi_id_skripsi_foreign_id` FOREIGN KEY (`prodi_id`) REFERENCES `prodi` (`prodi_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
