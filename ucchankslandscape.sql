-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 11, 2026 at 01:06 PM
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
-- Database: `ucchankslandscape`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `password_hash`, `created_at`) VALUES
(1, 'admin', '$2y$10$7/oyxAZcv/FDevapKwvWaOED7JBg7TN6aDJBU/u9sULHN9wM/9gZC', '2026-10-10 14:34:06');

-- --------------------------------------------------------

--
-- Table structure for table `jasa`
--

CREATE TABLE `jasa` (
  `id` int(11) NOT NULL,
  `nama_jasa` varchar(100) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `jenis` varchar(50) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jasa`
--

INSERT INTO `jasa` (`id`, `nama_jasa`, `kategori`, `jenis`, `deskripsi`, `gambar`) VALUES
(1, 'Pembuatan Taman', 'Taman', 'Pembuatan', 'Pembuatan taman sesuai ukuran area, konsep, dan kebutuhan yang diinginkan.', 'jasa1.jpg'),
(2, 'Renovasi Taman', 'Taman', 'Renovasi', 'Perbaikan dan penataan kembali taman agar sesuai dengan kebutuhan.', 'jasa2.jpg'),
(3, 'Pembuatan Kolam', 'Kolam', 'Pembuatan', 'Pembuatan kolam dengan ukuran dan desain yang disesuaikan dengan area.', 'jasa3.jpg'),
(4, 'Renovasi Kolam', 'Kolam', 'Renovasi', 'Perbaikan atau perubahan kolam yang sudah ada sesuai dengan kebutuhan.', 'jasa4.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `konsultasi`
--

CREATE TABLE `konsultasi` (
  `id` int(11) NOT NULL,
  `sumber` varchar(30) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `whatsapp` varchar(20) NOT NULL,
  `jasa` varchar(100) DEFAULT NULL,
  `jenis_kebutuhan` varchar(50) DEFAULT NULL,
  `produk` varchar(100) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `satuan` varchar(20) DEFAULT NULL,
  `kebutuhan_tanah` varchar(50) DEFAULT NULL,
  `panjang` decimal(10,2) DEFAULT NULL,
  `lebar` decimal(10,2) DEFAULT NULL,
  `luas` decimal(10,2) DEFAULT NULL,
  `lokasi` varchar(255) DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `status` varchar(30) DEFAULT 'Menunggu',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `konsultasi`
--

INSERT INTO `konsultasi` (`id`, `sumber`, `nama`, `whatsapp`, `jasa`, `jenis_kebutuhan`, `produk`, `jumlah`, `satuan`, `kebutuhan_tanah`, `panjang`, `lebar`, `luas`, `lokasi`, `catatan`, `status`, `created_at`) VALUES
(12, 'Jasa', 'Asyifa Nur Cahya Kamila', '083165031520', 'Pembuatan Taman', 'Terima Jadi', '', 0, '', '', 9.00, 2.00, 18.00, 'Paccinongang', 'Pembuatan Taman Hias', 'Diproses', '2026-10-10 15:17:44'),
(13, 'Produk', '', '', '', 'Pembelian', 'Palem Merah', 1, 'pohon', '', 0.00, 0.00, 0.00, '', 'Harga: Rp300.000 / pohon | Instalasi: Tidak', 'Selesai', '2026-10-10 15:18:58'),
(15, 'Produk', '', '', '', 'Pembelian', 'Bunga Jam 9', 2, 'pohon', '', 0.00, 0.00, 0.00, '', 'Harga: Rp5.000 / pohon | Instalasi: Tidak', 'Selesai', '2026-10-10 15:19:03'),
(16, 'Produk', '', '', '', 'Pembelian', 'Rumput Gajah Mini', 15, 'm²', '1 Pickup', 0.00, 0.00, 0.00, '', 'Harga: Rp25.000 / m² | Instalasi: Ya', 'Menunggu', '2026-10-10 15:19:39'),
(18, 'Kontak', 'Munzir', '08229657020', 'Renovasi Kolam', 'Konsultasi', '', 0, '', '', 0.00, 0.00, 0.00, '', 'Perbaikan Kolom Hias', 'Selesai', '2026-10-10 15:20:51'),
(19, 'Produk', '', '', '', 'Pembelian', 'Rumput Gajah Mini', 2, 'm²', '0 Karung', 0.00, 0.00, 0.00, '', 'Harga: Rp25.000 / m² | Instalasi: Tidak', 'Menunggu', '2026-10-10 16:19:24'),
(20, 'Produk', '', '', '', 'Pembelian', 'Rumput Gajah Mini', 2, 'm²', '1 Pickup', 0.00, 0.00, 0.00, '', 'Harga: Rp25.000 / m² | Instalasi: Tidak', 'Menunggu', '2026-10-10 16:23:03'),
(22, 'Jasa', 'Asyifa Nur Cahya Kamila', '089999999999', 'Renovasi Taman', 'Jasa Pengerjaan', '', 0, '', '', 2.00, 9.00, 18.00, 'Paccinongan', 'Saya Ingin mengganti Ke Tanaman Hias', 'Menunggu', '2026-10-11 04:07:18'),
(23, 'Produk', '', '', '', 'Pembelian', 'Rumput Gajah Mini', 1, 'm²', '0 Karung', 0.00, 0.00, 0.00, '', 'Harga: Rp25.000 / m² | Instalasi: Tidak', 'Menunggu', '2026-10-11 04:24:41'),
(24, 'Kontak', 'Asyifa', '08222222222222', 'Pembuatan Kolam', 'Konsultasi', '', 0, '', '', 0.00, 0.00, 0.00, '', 'saya mau membuat kolam ikan dan air mancur', 'Menunggu', '2026-10-11 04:34:03');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `harga` decimal(15,2) NOT NULL,
  `satuan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `nama_produk`, `kategori`, `deskripsi`, `gambar`, `harga`, `satuan`) VALUES
(5, 'Bonsai Beringin', 'Tanaman & Bunga', 'Tanaman bonsai dengan bentuk khas untuk memperindah area taman.', 'tanaman1.jpg', 750000.00, 'pohon'),
(6, 'Tape Buya', 'Tanaman & Bunga', 'Tanaman hias yang cocok digunakan sebagai pelengkap taman.', 'tanaman2.jpg', 75000.00, 'pohon'),
(7, 'Ekor Tupai', 'Tanaman & Bunga', 'Tanaman dengan bentuk daun yang unik untuk mempercantik taman.', 'tanaman3.jpg', 75000.00, 'pohon'),
(8, 'Palem Merah', 'Tanaman & Bunga', 'Tanaman palem dengan warna batang yang menarik untuk area taman.', 'tanaman4.jpg', 300000.00, 'pohon'),
(9, 'Kamboja', 'Tanaman & Bunga', 'Tanaman berbunga yang cocok untuk memperindah taman.', 'tanaman5.jpg', 75000.00, 'pohon'),
(10, 'Asoka Singapur', 'Tanaman & Bunga', 'Tanaman hias berbunga yang cocok sebagai penghias taman.', 'tanaman6.jpg', 10000.00, 'pohon'),
(11, 'Karambusa', 'Tanaman & Bunga', 'Tanaman hias untuk melengkapi komposisi taman.', 'tanaman7.jpg', 7500.00, 'pohon'),
(12, 'Laudia', 'Tanaman & Bunga', 'Tanaman hias yang cocok digunakan pada area taman.', 'tanaman8.jpg', 5000.00, 'pohon'),
(13, 'Sikas', 'Tanaman & Bunga', 'Tanaman dengan bentuk daun khas yang cocok sebagai tanaman taman.', 'tanaman9.jpg', 500000.00, 'pohon'),
(14, 'Pucuk Merah', 'Tanaman & Bunga', 'Tanaman dengan daun merah yang sering digunakan sebagai pembatas taman.', 'tanaman10.jpg', 25000.00, 'pohon'),
(15, 'Bunga Jam 9', 'Tanaman & Bunga', 'Tanaman berbunga yang cocok untuk mempercantik area taman.', 'tanaman11.jpg', 5000.00, 'pohon'),
(16, 'Jelita Ungu', 'Tanaman & Bunga', 'Tanaman hias dengan bunga berwarna ungu untuk memperindah taman.', 'tanaman12.jpg', 5000.00, 'pohon'),
(17, 'Bromelia', 'Tanaman & Bunga', 'Tanaman hias dengan bentuk daun yang menarik untuk taman.', 'tanaman13.jpg', 50000.00, 'pohon'),
(18, 'Pandang Mas', 'Tanaman & Bunga', 'Tanaman hias yang dapat digunakan untuk melengkapi lanskap taman.', 'tanaman14.jpg', 25000.00, 'pohon'),
(19, 'Pandang Bali', 'Tanaman & Bunga', 'Tanaman hias dengan bentuk daun yang khas untuk area taman.', 'tanaman15.jpg', 100000.00, 'pohon'),
(20, 'Sukung India', 'Tanaman & Bunga', 'Tanaman hias untuk menambah variasi vegetasi pada taman.', 'tanaman16.jpg', 7500.00, 'pohon'),
(21, 'Kacang-Kacangan', 'Tanaman & Bunga', 'Tanaman penutup yang dapat digunakan sebagai pelengkap taman.', 'tanaman17.jpg', 5000.00, 'pohon'),
(22, 'Bakung Lele', 'Tanaman & Bunga', 'Tanaman hias yang cocok untuk memperindah area taman.', 'tanaman18.jpg', 10000.00, 'pohon'),
(23, 'Bakung Air Mancur', 'Tanaman & Bunga', 'Tanaman hias yang dapat digunakan untuk memberikan variasi pada taman.', 'tanaman19.jpg', 10000.00, 'pohon'),
(24, 'Sambang Darah', 'Tanaman & Bunga', 'Tanaman hias dengan warna daun yang menarik untuk taman.', 'tanaman20.jpg', 7500.00, 'pohon'),
(25, 'Rumput Jepang', 'Rumput', 'Rumput dengan tekstur halus untuk area yang rapi.', 'rumput1.jpg', 25000.00, 'm²'),
(26, 'Rumput Gajah Mini', 'Rumput', 'Rumput pendek yang cocok untuk area hijau.', 'rumput2.jpg', 25000.00, 'm²'),
(27, 'Rumput Swiss', 'Rumput', 'Rumput untuk memberikan tampilan hijau yang rapi.', 'rumput3.jpg', 25000.00, 'm²');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `jasa`
--
ALTER TABLE `jasa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `konsultasi`
--
ALTER TABLE `konsultasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jasa`
--
ALTER TABLE `jasa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `konsultasi`
--
ALTER TABLE `konsultasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
