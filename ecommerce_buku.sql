-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 02, 2026 at 06:23 AM
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
-- Database: `ecommerce_buku`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `judul` varchar(200) NOT NULL,
  `penulis` varchar(100) NOT NULL,
  `penerbit` varchar(100) DEFAULT NULL,
  `tahun_terbit` year(4) DEFAULT NULL,
  `harga` decimal(12,2) NOT NULL,
  `stok` int(11) DEFAULT 0,
  `gambar` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `category_id`, `judul`, `penulis`, `penerbit`, `tahun_terbit`, `harga`, `stok`, `gambar`, `deskripsi`, `created_at`) VALUES
(1, 1, 'Parable', 'Brian Khrisna', 'Mediakita', '2022', 98000.00, 25, '1782238875_Parable.jpg', 'Novel tentang perjalanan hidup seorang pemuda yang menghadapi berbagai konflik kehidupan, persahabatan, keluarga, dan pencarian makna hidup.', '2026-06-23 18:14:22'),
(2, 1, 'Makanya, Mikir!', 'Abigail Limuria & Cania Citta', 'Simpul Publishing', '2019', 85000.00, 20, '1782238868_makanya, mikir.jpg', 'Buku pengembangan diri yang membahas cara berpikir kritis dan rasional dalam menghadapi berbagai masalah kehidupan.', '2026-06-23 18:14:22'),
(3, 1, 'Pulang-Pergi', 'Tere Liye', 'Sabak Grip', '2021', 105000.00, 30, '1782238861_pulang pergi.jpg', 'Novel aksi petualangan yang merupakan bagian dari serial Bumi karya Tere Liye.', '2026-06-23 18:14:22'),
(4, 1, 'Seporsi Mie Ayam Sebelum Mati', 'Brian Khrisna', 'Grasindo', '2023', 89000.00, 15, '1782238853_mie ayam.jpg', 'Novel yang mengangkat kisah kehidupan, kehilangan, dan harapan melalui sudut pandang yang unik.', '2026-06-23 18:14:22'),
(5, 1, 'Ayah, Ini Arahnya ke Mana, Ya?', 'Khoirul Trian', 'Gradien Mediatama', '2024', 79000.00, 50, '1782404185_ayah-ini-arahnya-kemana-ya.jpg', 'Ayah, ternyata benar ya. Setelah dewasa kita semua harus punya banyak uang. Harus bekerja lebih keras lagi, harus bertarung dengan isi kepala sendiri. Harus menyampingkan banyak keinginan untuk sekadar tetap bertahan hidup sampai bertemu pagi lagi.', '2026-06-25 16:16:25'),
(6, 1, 'Bumi Manusia', 'Pramoedya Ananta Toer', 'Hasta Mitra', '1980', 100000.00, 20, '1782833687_bumi-manusia-edit.jpg', 'Bumi Manusia', '2026-06-29 09:49:25'),
(7, 1, 'Laut Bercerita', 'Leila S Chudori', 'KPG', '2024', 130000.00, 25, 'laut.jpg', 'Novel', '2026-06-30 16:11:58');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `nama_kategori`) VALUES
(1, 'Novel'),
(2, 'Komik'),
(3, 'Pendidikan'),
(4, 'Agama'),
(5, 'Teknologi'),
(6, 'Bisnis');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nama_penerima` varchar(100) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `total` decimal(12,2) NOT NULL,
  `metode_pembayaran` enum('BCA Virtual Account','BRI Virtual Account','BNI Virtual Account','Mandiri Virtual Account','QRIS','Debit/Credit Card') DEFAULT NULL,
  `status` enum('Pending','Menunggu Verifikasi','Lunas','Diproses','Dikirim','Selesai','Ditolak') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `va_number` varchar(30) DEFAULT NULL,
  `expired_at` datetime DEFAULT NULL,
  `payment_status` enum('pending','paid','expired') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `nama_penerima`, `no_hp`, `alamat`, `total`, `metode_pembayaran`, `status`, `created_at`, `va_number`, `expired_at`, `payment_status`) VALUES
(1, 2, 'Angelina', '877', 'Jl. Imam Bonjol, Pendrikan Kidul, Semarang Tengah, Kota Semarang', 89000.00, 'QRIS', 'Lunas', '2026-06-25 16:01:40', '9522247187228172', '2026-06-26 00:01:40', 'paid'),
(2, 2, 'Daus', '08972534627', 'Jl. Merak', 79000.00, 'BCA Virtual Account', 'Pending', '2026-06-29 07:56:49', '5518799411616374', '2026-06-29 15:56:49', 'pending'),
(3, 2, 'Lia', '0826341618', 'Semarang', 89000.00, 'QRIS', 'Lunas', '2026-06-29 08:01:53', '2593029363000568', '2026-06-29 16:01:53', 'paid'),
(4, 2, 'angelina', '677', 'gdgy', 79000.00, 'QRIS', 'Pending', '2026-06-29 09:44:41', '5476421606686385', '2026-06-29 17:44:41', 'pending'),
(5, 2, 'hfhf', '6474', 'hdhd', 100.00, 'QRIS', 'Lunas', '2026-06-29 09:50:17', '5276013050084457', '2026-06-29 17:50:17', 'paid'),
(6, 2, 'Lia', '08234625733', 'Semarang', 417000.00, 'BCA Virtual Account', 'Pending', '2026-07-01 05:06:45', '4290371568688045', '2026-07-01 13:06:45', 'pending'),
(7, 2, 'Septya Angelina', '08972534627', 'semarang', 89000.00, 'BCA Virtual Account', 'Lunas', '2026-07-01 05:08:49', '1216180845548341', '2026-07-01 13:08:49', 'paid');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `harga` decimal(12,2) NOT NULL,
  `subtotal` decimal(12,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `book_id`, `qty`, `harga`, `subtotal`) VALUES
(1, 1, 4, 1, 89000.00, 89000.00),
(2, 2, 5, 1, 79000.00, 79000.00),
(3, 3, 4, 1, 89000.00, 89000.00),
(4, 4, 5, 1, 79000.00, 79000.00),
(5, 5, 6, 1, 100.00, 100.00),
(6, 6, 4, 1, 89000.00, 89000.00),
(7, 6, 6, 1, 100000.00, 100000.00),
(8, 6, 7, 1, 130000.00, 130000.00),
(9, 6, 1, 1, 98000.00, 98000.00),
(10, 7, 4, 1, 89000.00, 89000.00);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `bukti_transfer` varchar(255) DEFAULT NULL,
  `status` enum('Menunggu','Valid','Ditolak') DEFAULT 'Menunggu',
  `tanggal_upload` timestamp NOT NULL DEFAULT current_timestamp(),
  `metode` varchar(50) DEFAULT NULL,
  `verifikasi` enum('pending','paid','rejected') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `order_id`, `bukti_transfer`, `status`, `tanggal_upload`, `metode`, `verifikasi`) VALUES
(1, 1, '1782403386_WhatsApp Image 2026-06-16 at 3.45.03 PM.jpeg', 'Menunggu', '2026-06-25 16:03:06', 'QRIS', 'paid'),
(2, 2, NULL, 'Menunggu', '2026-06-29 07:56:49', 'BCA Virtual Account', 'pending'),
(3, 3, '1782720198_ayah-ini-arahnya-kemana-ya.jpg', 'Menunggu', '2026-06-29 08:03:18', 'QRIS', 'paid'),
(4, 4, NULL, 'Menunggu', '2026-06-29 09:44:41', 'QRIS', 'pending'),
(5, 5, '1782726626_bumi-manusia-edit.jpg', 'Menunggu', '2026-06-29 09:50:26', 'QRIS', 'paid'),
(6, 6, NULL, 'Menunggu', '2026-07-01 05:06:45', 'BCA Virtual Account', 'pending'),
(7, 7, '1782882537_Cantik-Itu-Luka.jpg', 'Menunggu', '2026-07-01 05:08:57', 'BCA Virtual Account', 'paid');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `remember_token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `password`, `role`, `created_at`, `remember_token`) VALUES
(1, 'admin', 'admin@bookstore.com', '$2y$10$2TefEQHnFFSPipz1yL4bzeTtc33ONmembrXAHoVZRI66XjzyqHTzK', 'admin', '2026-06-23 18:00:26', NULL),
(2, 'angel', 'zll@bookstore.com', '$2y$10$MiLE8Ub2sEWC2oVjhAS92eOxxv8cgPbCaelWOq0zJSNxPHzNYK6vq', 'user', '2026-06-23 18:01:14', NULL),
(3, 'tya', 'tya@bookstore.com', '$2y$10$L89kuOIkU0qPRrNfjrI5BOUpR6yxo9MVOi7sbSN71KcXTW8jQSkt6', 'user', '2026-06-28 16:06:40', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_books_judul` (`judul`),
  ADD KEY `idx_books_category` (`category_id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cart_book` (`book_id`),
  ADD KEY `idx_cart_user` (`user_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_order_user` (`user_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_detail_order` (`order_id`),
  ADD KEY `fk_detail_book` (`book_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_payment_order` (`order_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `fk_books_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `fk_cart_book` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_cart_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_order_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `fk_detail_book` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_detail_order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `fk_payment_order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
