-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2025 at 04:53 AM
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
-- Database: `simbs`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id` int(11) NOT NULL,
  `kode_buku` varchar(10) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `deskripsi` varchar(100) NOT NULL,
  `penulis` varchar(100) NOT NULL,
  `tahun_terbit` varchar(100) NOT NULL,
  `kategori` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id`, `kode_buku`, `judul`, `deskripsi`, `penulis`, `tahun_terbit`, `kategori`) VALUES
(1, 'BK001', 'Langkah di Atas Awan', 'Sebuah kisah petualangan remaja menemukan jati diri.', 'Rama Wijaya', '2023', 'Novel'),
(2, 'BK002', 'Jejak Sang Pahlawan', 'Mengulas perjuangan tokoh nasional dalam merebut kemerdekaan.', 'Satrio Mahendra', '2021', 'Sejarah'),
(3, 'BK003', 'Cahaya dalam Diam', 'Biografi seorang tokoh perempuan inspiratif yang menembus batas.', 'Melani Syafira', '2022', 'Biografi'),
(4, 'BK004', 'Teknologi Telekomunikasi', 'Ensiklopedia dasar sistem dan jaringan telekomunikasi modern.', 'Prof. R. Hidayat', '2020', 'Ensiklopedia'),
(5, 'BK005', 'Negeri Senja', 'Novel drama penuh konflik keluarga dan misteri masa lalu.', 'Alvaro Nusa', '2021', 'Novel'),
(6, 'BK006', 'Tumbuh & Berkembang', 'Ensiklopedia perkembangan motorik dan kognitif anak.', 'Dr. Niken Kartika', '2022', 'Ensiklopedia'),
(7, 'BK007', 'Jejak Sang Kreator', 'Biografi desainer grafis Indonesia yang mendunia.', 'Bagas Adinata', '2024', 'Biografi'),
(8, 'BK008', 'Kerajaan Nusantara', 'Sejarah kejayaan kerajaan besar di wilayah Indonesia.', 'Wirawan Perdana', '2023', 'Sejarah'),
(9, 'BK009', 'Mengenal Alam Semesta', 'Ensiklopedia ilmu dasar ruang angkasa dan astronomi.', 'Jamal Fauzi', '2023', 'Ensiklopedia'),
(10, 'BK010', 'Mimpi Sang Pengajar', 'Novel inspiratif perjalanan seorang guru desa mengejar harapan.', 'Chyntia Amelia', '2023', 'Novel');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Indexes for dumped tables
--

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL,
  `deskripsi` varchar(100) NOT NULL,
  `tanggal_input` varchar(100) NOT NULL  
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama_kategori`, `deskripsi`, `tanggal_input`) VALUES
(1, 'Novel', 'Cerita fiksi panjang dengan konflik dan tokoh', '2025-11-27'),
(2, 'Biografi', 'Kisah nyata perjalanan hidup seseorang terkenal', '2025-11-10'),
(3, 'Sejarah', 'Peristiwa penting masa lalu yang berpengaruh', '2025-11-05'),
(4, 'Ensiklopedia', 'Informasi ringkas berbagai pengetahuan yang faktual', '2025-11-01');
-- --------------------------------------------------------

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- TIMESTAMP for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `tanggal_input` TIMESTAMP DEFAULT CURRENT_TIMESTAMP;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
