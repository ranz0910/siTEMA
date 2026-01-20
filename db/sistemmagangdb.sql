-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2026 at 04:53 AM
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
-- Database: `sistemmagangdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE `jurusan` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_jurusan` varchar(255) NOT NULL,
  `kode_jurusan` varchar(10) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`id`, `id_user`, `nama_jurusan`, `kode_jurusan`, `created_at`) VALUES
(1, 5, 'Teknologi Informasi', 'TI', '2026-01-13 09:40:25'),
(3, 7, 'English Department', 'ED', '2026-01-13 09:43:43'),
(8, 30, 'Teknik Elektro', 'TE', '2026-01-20 10:12:51');

-- --------------------------------------------------------

--
-- Table structure for table `lowongan_magang`
--

CREATE TABLE `lowongan_magang` (
  `id` int(11) NOT NULL,
  `id_perusahaan` int(11) NOT NULL,
  `id_jurusan` int(11) NOT NULL,
  `judul_lowongan` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `kuota` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lowongan_magang`
--

INSERT INTO `lowongan_magang` (`id`, `id_perusahaan`, `id_jurusan`, `judul_lowongan`, `deskripsi`, `kuota`, `created_at`) VALUES
(2, 1, 3, 'Lowongan Anak bahasa englesh', 'Syaratnya jadi anak baik aj, ama banyak duit', 3, '2026-01-19 10:44:52'),
(3, 31, 3, 'teknisi', 'abcd', 12, '2026-01-20 10:20:14');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_prodi` int(11) NOT NULL,
  `nim` varchar(20) NOT NULL,
  `nama_mahasiswa` varchar(255) NOT NULL,
  `jenis_kelamin` enum('Laki-Laki','Perempuan') NOT NULL,
  `alamat` text NOT NULL,
  `angkatan` varchar(20) NOT NULL,
  `no_hp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `id_user`, `id_prodi`, `nim`, `nama_mahasiswa`, `jenis_kelamin`, `alamat`, `angkatan`, `no_hp`) VALUES
(1, 25, 1, '2001092020', 'Rahmat reyn', 'Laki-Laki', 'Padang', '2020', '082381928001'),
(3, 27, 6, '2401092029', 'Kanjeng Utiii', 'Perempuan', 'Jln Liberalisme samping kedai pak ucok', '2020', '089281910021'),
(4, 28, 1, '985493485', 'Zahran', 'Laki-Laki', 'Kapalo Koto, Kec. Pauh, Kota Padang, Sumatera Barat', '2020', '08384575986'),
(5, 29, 7, '2093302920', 'Reza Salsabila', 'Perempuan', 'Padang', '2020', '08342938403');

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan_magang`
--

CREATE TABLE `pengajuan_magang` (
  `id` int(11) NOT NULL,
  `id_lowongan_magang` int(11) DEFAULT NULL,
  `id_mahasiswa` int(11) DEFAULT NULL,
  `id_lowongan_manual` varchar(40) DEFAULT NULL,
  `judul_lowongan` varchar(255) DEFAULT NULL,
  `nama_perusahaan` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengajuan_magang`
--

INSERT INTO `pengajuan_magang` (`id`, `id_lowongan_magang`, `id_mahasiswa`, `id_lowongan_manual`, `judul_lowongan`, `nama_perusahaan`, `status`, `created_at`) VALUES
(9, 2, 4, NULL, NULL, NULL, 1, '2026-01-20 09:18:11'),
(10, 2, 5, NULL, NULL, NULL, 1, '2026-01-20 09:53:15'),
(12, NULL, 1, 'LM-202601-B7FB', 'ngoding', 'Media Oke Banget', 1, '2026-01-20 10:23:04');

-- --------------------------------------------------------

--
-- Table structure for table `perusahaan`
--

CREATE TABLE `perusahaan` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `npwp` varchar(15) NOT NULL,
  `nama_perusahaan` varchar(255) NOT NULL,
  `alamat_perusahaan` text NOT NULL,
  `telp_perusahaan` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `perusahaan`
--

INSERT INTO `perusahaan` (`id`, `id_user`, `npwp`, `nama_perusahaan`, `alamat_perusahaan`, `telp_perusahaan`, `created_at`) VALUES
(1, 22, '11212131121', 'PT KERJA SAMA', 'Jl. Semanggi Indah', '089281921022', '2026-01-19 00:08:42'),
(3, 31, '093', 'Pertamina Persero', 'Jakarta Selatan', '0864835653', '2026-01-20 10:15:10');

-- --------------------------------------------------------

--
-- Table structure for table `prodi`
--

CREATE TABLE `prodi` (
  `id` int(11) NOT NULL,
  `id_jurusan` int(11) NOT NULL,
  `kode_prodi` varchar(10) NOT NULL,
  `nama_prodi` varchar(255) NOT NULL,
  `jenjang` enum('D3','D4') NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prodi`
--

INSERT INTO `prodi` (`id`, `id_jurusan`, `kode_prodi`, `nama_prodi`, `jenjang`, `created_at`) VALUES
(1, 3, 'EIN', 'English Internasional', 'D4', '2026-01-19 01:51:00'),
(6, 1, 'MI', 'Manajemen Informatika', 'D3', '2026-01-19 21:35:27'),
(7, 3, 'GR', 'grammar', 'D3', '2026-01-20 09:52:02'),
(8, 3, 'EN', 'english', 'D4', '2026-01-20 10:17:28');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', '2025-12-24 21:15:39', '2025-12-24 21:15:39'),
(2, 'Jurusan', '2025-12-24 21:15:39', '2025-12-24 21:15:39'),
(3, 'Perusahaan', '2025-12-24 21:15:54', '2025-12-24 21:15:54'),
(4, 'Mahasiswa', '2025-12-24 21:15:54', '2025-12-24 21:15:54');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `id_roles` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `id_roles`, `username`, `password`, `email`, `created_at`, `updated_at`) VALUES
(1, 1, 'adminUKJ', '0192023a7bbd73250516f069df18b500', 'admin@ukj.com', '2025-12-24 21:17:44', '2025-12-24 21:17:44'),
(5, 2, 'jurTi', '58a9777ae8e231d52f28f7f2cc0f5fb6', 'teknologiinformasi@pnp.ac.id', '2026-01-13 09:40:25', '2026-01-13 09:40:25'),
(7, 2, 'jurEd', '58a9777ae8e231d52f28f7f2cc0f5fb6', 'englishdepartment@pnp.ac.id', '2026-01-13 09:43:43', '2026-01-13 09:43:43'),
(10, 2, 'jurusan', '457391c9c82bfdcbb4947278c0401e41', 'sasa@gmail.com', '2026-01-18 14:15:06', '2026-01-18 14:15:06'),
(22, 3, 'ptkerjasama', '202cb962ac59075b964b07152d234b70', 'ptkerjasama@official.co.id', '2026-01-19 00:08:42', '2026-01-19 09:41:19'),
(25, 4, 'rahmat', '202cb962ac59075b964b07152d234b70', 'guest1@gmail.com', '2026-01-19 09:17:55', '2026-01-19 11:03:56'),
(27, 4, 'uti', '202cb962ac59075b964b07152d234b70', 'kanjeng@gmail.com', '2026-01-19 21:38:43', '2026-01-19 21:38:43'),
(28, 4, 'jahra', '202cb962ac59075b964b07152d234b70', 'jahra@gmail.com', '2026-01-20 09:17:55', '2026-01-20 09:17:55'),
(29, 4, 'reza', '202cb962ac59075b964b07152d234b70', 'reza@gmail.com', '2026-01-20 09:52:52', '2026-01-20 09:52:52'),
(30, 2, 'elektro', '202cb962ac59075b964b07152d234b70', 'Elektrok@pnp.ac.id', '2026-01-20 10:12:50', '2026-01-20 10:12:50'),
(31, 3, 'persero', '202cb962ac59075b964b07152d234b70', 'persero@gmail.com', '2026-01-20 10:15:10', '2026-01-20 10:15:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lowongan_magang`
--
ALTER TABLE `lowongan_magang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengajuan_magang`
--
ALTER TABLE `pengajuan_magang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `perusahaan`
--
ALTER TABLE `perusahaan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prodi`
--
ALTER TABLE `prodi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `lowongan_magang`
--
ALTER TABLE `lowongan_magang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pengajuan_magang`
--
ALTER TABLE `pengajuan_magang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `perusahaan`
--
ALTER TABLE `perusahaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `prodi`
--
ALTER TABLE `prodi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
