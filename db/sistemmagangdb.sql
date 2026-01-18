-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 08, 2026 at 08:53 AM
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
  `nama_jurusan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`id`, `id_user`, `nama_jurusan`) VALUES
(9, 14, 'Teknologi Informasi'),
(10, 17, 'Teknik Elektro');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_mahasiswa` varchar(100) NOT NULL,
  `nim` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `kontak` varchar(50) NOT NULL,
  `jurusan` varchar(100) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `id_user`, `nama_mahasiswa`, `nim`, `email`, `kontak`, `jurusan`, `alamat`) VALUES
(1, 19, 'c', '12', 'z@gmail.com', '12', 'c', 'c'),
(2, 20, 'czs', '123', 'xs@gmail.com', '123', 'qfere', 'vewe');

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan_magang`
--

CREATE TABLE `pengajuan_magang` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `nama_mahasiswa` varchar(100) NOT NULL,
  `tempat_lahir` varchar(150) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jekel` varchar(30) NOT NULL,
  `agama` varchar(30) NOT NULL,
  `alamat` text NOT NULL,
  `id_perusahaan` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `status` enum('Pending','Diterima','Ditolak') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengajuan_magang`
--

INSERT INTO `pengajuan_magang` (`id`, `id_user`, `nik`, `nama_mahasiswa`, `tempat_lahir`, `tanggal_lahir`, `jekel`, `agama`, `alamat`, `id_perusahaan`, `keterangan`, `status`, `created_at`) VALUES
(1, 0, '1234567891012312', 'zaza', 'padang', '2026-01-07', 'Perempuan', 'Islam', 'padang', 1, '0', 'Pending', '2026-01-07 15:17:59'),
(2, 0, '1234567891123456', 'zaza', 'padang', '2026-01-07', 'Perempuan', 'Islam', 'padang', 1, '0', 'Pending', '2026-01-07 15:18:52'),
(3, 0, '1234567891011121', 'zaza', 'padang', '2026-01-07', 'Perempuan', 'Islam', 'padang', 2, '0', 'Pending', '2026-01-07 15:29:10'),
(4, 0, '12345678', 'ccc', 'cccc', '2026-01-07', 'Laki-laki', 'Hindu', 'cccc', 3, 'sdsds', 'Pending', '2026-01-07 15:41:59');

-- --------------------------------------------------------

--
-- Table structure for table `perusahaan`
--

CREATE TABLE `perusahaan` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_perusahaan` varchar(300) NOT NULL,
  `alamat` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `kontak` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `perusahaan`
--

INSERT INTO `perusahaan` (`id`, `id_user`, `nama_perusahaan`, `alamat`, `email`, `kontak`) VALUES
(10, 15, 'PT Batu Bara Indonesia', 'Jl. Proklamasi nusantara barat jawa timur', 'ptbatuBara_@gmail.com', '123'),
(11, 16, 'Sidomuncul', 'jawa timur', 'jw@gmail.com', '1234'),
(12, 18, 'abc', 'kalteng', 'ab@gmail.com', '123'),
(13, 24, 'qwe', 'sdef', 'ws@gmail.com', '12345'),
(14, 25, 'Ajinomoto', 'Jl. Selatan Jakarta', 'aji@gmail.com', '123456');

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
(1, 'unit_kerjasama', '2025-12-24 21:15:39', '2025-12-30 17:17:25'),
(2, 'perusahaan\r\n', '2025-12-24 21:15:39', '2025-12-30 17:17:36'),
(3, 'jurusan', '2025-12-24 21:15:54', '2025-12-30 17:18:00'),
(4, 'mahasiswa', '2025-12-24 21:15:54', '2025-12-30 17:18:07');

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
(1, 1, 'adminUKJ', '0192023a7bbd73250516f069df18b500', 'admin@ukj.com', '2025-12-24 21:17:44', '2025-12-25 18:19:08'),
(14, 3, 'tijaya_1', '$2y$10$kszc7oHtFl8T2Y5/XG48VOflovoIV6FE6jehZC8dA5HZfcMtvJaZK', 'it@gmail.com', '2025-12-29 21:23:20', '2025-12-30 17:20:54'),
(16, 2, 'Sidomuncul', '$2y$10$0iwObikTGucU7c8BZQx2ZesffkZS0XJhoUcdNBn62S7ZLJkjHCELe', 'jw@gmail.com', '2025-12-29 21:30:55', '2025-12-30 17:20:54'),
(17, 3, 'admin_elektro', '$2y$10$UWDpBwkOojBtwLBYsSO6pucT6G.YPbd46SG28URwG60jlLZxqnIHG', 'elektro@gmail.com', '2025-12-29 21:31:15', '2025-12-30 17:20:54'),
(18, 2, 'abc', '$2y$10$EW2JjFSlvPOFNoFJmEh9fOZWXgomxTd0TenbV31QIv/vqvSXnXPwS', 'ab@gmail.com', '2025-12-29 21:42:35', '2025-12-30 17:20:54'),
(19, 4, '12', '$2y$10$oktWoYtcRWYIi9yv4Rr0t.SgS5iwIFIjfAdD3u8JnPHvUfK96Gm8e', 'z@gmail.com', '2025-12-30 14:08:34', '2025-12-30 14:08:34'),
(20, 4, '123', '$2y$10$jVC5YsFLa0tAUg.Mgv2WxuCCbyg9nkGBJp3q/Ar6CsctPr602vd2S', 'xs@gmail.com', '2025-12-30 14:08:57', '2025-12-30 14:08:57'),
(21, 3, 'mesinjaya', 'c8327e07d92b867ea3e2e2a217259220', 'jayamesin@gmail.com', '2025-12-30 17:32:15', '2025-12-30 17:38:57'),
(22, 2, 'PTBatuBara', '31f9b0813ef9475b581f9cc96aa3c317', 'hatikumembara@gmail.com', '2026-01-01 18:58:10', '2026-01-01 18:58:29'),
(23, 4, 'milea', '8b106ad062def09736626d7dbffaac42', 'mela123@gmail.com', '2026-01-01 19:09:01', '2026-01-01 19:09:01'),
(24, 3, 'qwe', '$2y$10$tpo0R.8cOc7kBuyO9aNU5.Ce6yzC5kA5vJvVUTiRvwFLSqt0wjqJW', 'ws@gmail.com', '2026-01-06 11:13:15', '2026-01-06 11:13:15'),
(25, 3, 'Ajinomoto', '$2y$10$pmymjAeJSwtAXb2eeXagY.dVcqTsOwq4m7gj1cDyt34uOJhE2zorm', 'aji@gmail.com', '2026-01-07 22:39:36', '2026-01-07 22:39:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pengajuan_magang`
--
ALTER TABLE `pengajuan_magang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `perusahaan`
--
ALTER TABLE `perusahaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
