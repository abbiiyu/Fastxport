-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 04 Jan 2025 pada 11.05
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fastxport_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `login_acc`
--

CREATE TABLE `login_acc` (
  `id_acc` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `country` varchar(100) NOT NULL,
  `phone_number` varchar(100) NOT NULL,
  `user_add` varchar(255) NOT NULL,
  `role` enum('supplier','customer') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `login_acc`
--

INSERT INTO `login_acc` (`id_acc`, `full_name`, `email`, `password`, `country`, `phone_number`, `user_add`, `role`) VALUES
(14, 'satu', 'satu@gmail.com', '$2y$10$s9Ez7bVapzKYW', 'indonesia', '11111111', 'bekasi', 'customer'),
(15, 'dua lima', 'dua@gmail.com', '22222222', 'dua', '22222222', 'dua dua lapan kali', 'supplier'),
(21, 'entis', 'entis@gmail.com', 'entis123', 'indonesia', '02128231232', 'Jatiasih, Bekasi', 'supplier'),
(22, 'dhani', 'dhani@gmail.com', 'dhani123', 'indonesia', '02188123078', 'Jl. Raya Kalisari, Depok, Jawa Barat', 'supplier'),
(23, 'rhino', 'rhino@gmail.com', 'rhino123', 'Indonesia', '021886725421', 'Kp. Makassar Halim Perdana Kusuma', 'supplier'),
(24, 'user test', 'user@gmail.com', 'entis123', 'user', '02188182838', 'Kepulauan Coding', 'supplier'),
(25, 'tiga roda', 'tiga@gmail.com', 'entis123', 'indonesia', '021988213', 'cakung', 'supplier');

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `id_order` varchar(100) NOT NULL,
  `id_supplier` varchar(100) NOT NULL,
  `id_cust` varchar(100) NOT NULL,
  `id_product` varchar(100) NOT NULL,
  `id_shipment` varchar(100) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `total` int(11) NOT NULL,
  `shipment_category` enum('Regular','Express') NOT NULL,
  `delivery_date` date DEFAULT curdate(),
  `cust_address` varchar(255) NOT NULL,
  `estimated_delivery` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `product`
--

CREATE TABLE `product` (
  `id_product` varchar(100) NOT NULL,
  `id_supplier` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `media` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `minBuy` int(11) NOT NULL,
  `category` enum('Pertanian','Perkebunan','Perhutanan','Perikanan','Perternakan') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `product`
--

INSERT INTO `product` (`id_product`, `id_supplier`, `product_name`, `description`, `media`, `price`, `stock`, `minBuy`, `category`) VALUES
('PNT-0001', 7, 'Padi Organik', '', 'media.jpg', 50000, 1000, 0, 'Pertanian'),
('PNT-0002', 8, 'Beras Kacang Merah', 'Beras ini beras imitasi', '/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAgGBgcGBQgHBwcJCQgKDBQNDAsLDBkSEw8UHRofHh0aHBwgJC4nICIsIxwcKDcpLDAx', 13000, 95, 5, 'Pertanian'),
('PRN-0001', 8, 'Ikan Tuna', '', 'box_tuna.jpg', 500000, 100, 0, 'Perikanan'),
('PRN-0002', 8, 'Ikan Kerapu Karang Ploso', 'Kerapu baru diangkat tadi pagi di pelabuhan', '????\0JFIF\0\0\0\0\0\0??\0;CREATOR: gd-jpeg v1.0 (using IJG JPEG v62), quality = 75\n??\0C\0		\n', 57000, 45, 5, 'Perikanan');

--
-- Trigger `product`
--
DELIMITER $$
CREATE TRIGGER `before_insert_product` BEFORE INSERT ON `product` FOR EACH ROW BEGIN
    DECLARE category_prefix VARCHAR(3);
    DECLARE next_id INT;

    -- Tentukan prefix berdasarkan kategori
    IF NEW.category = 'pertanian' THEN
        SET category_prefix = 'PNT';
    ELSEIF NEW.category = 'perkebunan' THEN
        SET category_prefix = 'PRK';
    ELSEIF NEW.category = 'perhutanan' THEN
        SET category_prefix = 'PHN';
    ELSEIF NEW.category = 'perikanan' THEN
        SET category_prefix = 'PRN';
    ELSEIF NEW.category = 'peternakan' THEN
        SET category_prefix = 'PTK';
    END IF;

    -- Ambil nomor urut terakhir dari kategori yang sama
    SELECT COUNT(*) + 1 INTO next_id
    FROM product
    WHERE category = NEW.category;

    -- Buat id_product baru
    SET NEW.id_product = CONCAT(category_prefix, '-', LPAD(next_id, 4, '0'));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `shipment`
--

CREATE TABLE `shipment` (
  `id_shipment` int(100) NOT NULL,
  `shipment_category` enum('Regular','Express') NOT NULL,
  `estimated_delivery` date NOT NULL,
  `delivery_date` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` int(11) NOT NULL,
  `id_acc` int(11) NOT NULL,
  `shop_name` varchar(100) NOT NULL,
  `bio` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `id_acc`, `shop_name`, `bio`) VALUES
(7, 15, 'Ternak Abadi Sejahtera', 'Ragukan kami'),
(8, 23, 'Scout Guardian', 'Menjual Perlengkapan Pramuka SD SMP SMA'),
(9, 24, 'valorant game', 'menjual berbagai jenis akun valorant'),
(10, 25, 'Monyet Liar', 'TOLONG DITANGKAP');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `login_acc`
--
ALTER TABLE `login_acc`
  ADD PRIMARY KEY (`id_acc`);

--
-- Indeks untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_order`);

--
-- Indeks untuk tabel `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id_product`),
  ADD KEY `fk_product_supplier` (`id_supplier`);

--
-- Indeks untuk tabel `shipment`
--
ALTER TABLE `shipment`
  ADD PRIMARY KEY (`id_shipment`);

--
-- Indeks untuk tabel `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`),
  ADD KEY `id_acc` (`id_acc`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `login_acc`
--
ALTER TABLE `login_acc`
  MODIFY `id_acc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `shipment`
--
ALTER TABLE `shipment`
  MODIFY `id_shipment` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_product_supplier` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_supplier`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `supplier`
--
ALTER TABLE `supplier`
  ADD CONSTRAINT `fk_supplier_login_acc` FOREIGN KEY (`id_acc`) REFERENCES `login_acc` (`id_acc`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
