-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Jun 2026 pada 04.07
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
-- Database: `wigglepop_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin_profiles`
--

CREATE TABLE `admin_profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `bio` text DEFAULT NULL,
  `social_links` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`social_links`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `admin_profiles`
--

INSERT INTO `admin_profiles` (`id`, `user_id`, `bio`, `social_links`, `created_at`, `updated_at`) VALUES
(1, 1, 'Handmade Accessory Store Manager', '{\"instagram\":\"https:\\/\\/instagram.com\\/wigglepop\",\"whatsapp\":\"https:\\/\\/wa.me\\/6281234567890\"}', '2026-06-10 05:52:46', '2026-06-10 05:52:46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Bag Charm', 'bagcharm', 'Cute & elegant charms for your bags', 'images/categories/bagcharm.jpg', '2026-06-10 05:52:46', '2026-06-10 05:52:46'),
(2, 'Bracelet', 'bracelet', 'Handmade colorful beaded bracelets', 'images/categories/bracelet.jpg', '2026-06-10 05:52:46', '2026-06-10 05:52:46'),
(3, 'Keychain', 'keychain', 'Adorable keychains to personalize your keys', 'images/categories/keychain.jpg', '2026-06-10 05:52:46', '2026-06-10 05:52:46'),
(4, 'Phone Strap', 'phonestrap', 'Cute and trendy phone straps', 'images/categories/phonestrap.jpg', '2026-06-10 05:52:46', '2026-06-10 05:52:46'),
(5, 'Custom Order', 'custom', 'Design your own custom accessories', 'images/categories/custom.jpg', '2026-06-10 05:52:46', '2026-06-10 05:52:46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `subject`, `message`, `is_read`, `created_at`, `updated_at`) VALUES
(1, 'riku', 'sean@gmail.com', 'jfanf', 'nfakfjnafjafaofnakfa', 0, '2026-06-10 10:12:42', '2026-06-10 10:12:42');

-- --------------------------------------------------------

--
-- Struktur dari tabel `custom_orders`
--

CREATE TABLE `custom_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `description` text NOT NULL,
  `reference_image` varchar(255) DEFAULT NULL,
  `budget` decimal(12,2) DEFAULT NULL,
  `final_price` decimal(12,2) DEFAULT NULL,
  `payment_proof` varchar(255) DEFAULT NULL,
  `status` enum('pending','awaiting_payment','process','done','cancelled') NOT NULL DEFAULT 'pending',
  `admin_note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `custom_orders`
--

INSERT INTO `custom_orders` (`id`, `user_id`, `description`, `reference_image`, `budget`, `final_price`, `payment_proof`, `status`, `admin_note`, `created_at`, `updated_at`) VALUES
(1, 2, 'ajdnaioefjiqafjafaiogLMGKLGNEAMKGLNMAKGLAM', 'custom-orders/ZPWYxVAFRtdV6VvzhPZCX6qSifOcMs96oSt9VyXZ.png', 50000.00, 50000.00, NULL, 'cancelled', 'capek', '2026-06-10 09:02:26', '2026-06-10 09:24:19'),
(2, 2, 'ajdnsjfsigosgskgjsfhsufhsjfsnbujfnsujkfsniogksnjgsg', NULL, 100000.00, 100000.00, 'custom-order-payments/9Vnca8FvDVvpd1ktAmbFXe1ZcPOKqTMJqxriD7CR.png', 'done', 'ini yach beb', '2026-06-10 09:23:09', '2026-06-10 09:24:58'),
(3, 2, 'jjsbfajfaiufnafnaolfjapfnajfnaijkfanjaokfnubg nbisujniaknuajn aidfanf', 'custom-orders/Oy5xy959hMMh1gcGigx2LjDL8gCEzIFHh09UVWNX.png', 80000.00, 80000.00, 'custom-order-payments/RQI8sGWvl9GuiFGyHgUolHVuXrLkXbDgY8ei43fz.png', 'done', NULL, '2026-06-10 10:11:41', '2026-06-10 10:28:08'),
(4, 2, 'jfsufhaeuf bg sfhaufhafuahef uehfaufj afa fua fa fafjanfujahfnaufan', 'custom-orders/Vuk6S0TTRl6XrcGgA5XmVbfnBlIQsQV7z0flCbIP.jpg', 90000.00, 80000.00, 'custom-order-payments/bz5JbePby8Ho0n9B1zC40NEB4MKX1kNAUc1YAvaQ.jpg', 'done', NULL, '2026-06-10 10:20:16', '2026-06-10 10:28:30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `order_code` varchar(255) NOT NULL,
  `total_price` decimal(12,2) NOT NULL,
  `status` enum('pending','paid','shipped','delivered','cancelled') NOT NULL DEFAULT 'pending',
  `shipping_address` text NOT NULL,
  `payment_proof` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `order_code`, `total_price`, `status`, `shipping_address`, `payment_proof`, `created_at`, `updated_at`) VALUES
(1, 2, 'WP-INYIOQQE', 62000.00, 'delivered', 'Jl. Lavender No. 5, Jakarta', 'payment-proofs/WAM7ltQe22dJkCgSFMk2EhVWXAPF32QAZ1ljtqfb.png', '2026-06-10 09:00:04', '2026-06-10 09:00:24'),
(2, 2, 'WP-1L1WARZX', 30000.00, 'shipped', 'Jl. Lavender No. 5, Jakarta', 'payment-proofs/51Zq6Q4HY4QBjTBOTmK0P0quo66Udc3K6s5hqmlN.png', '2026-06-10 10:10:46', '2026-06-10 10:27:45'),
(3, 2, 'WP-WKNCUOES', 95000.00, 'pending', 'Jl. Lavender No. 5, Jakarta', 'payment-proofs/hH7GUgiSg24J6gbEGI7XPtbsMvlXvLzgnvu20aZG.jpg', '2026-06-10 10:19:25', '2026-06-10 10:19:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 30000.00, '2026-06-10 09:00:04', '2026-06-10 09:00:04'),
(2, 1, 2, 1, 32000.00, '2026-06-10 09:00:04', '2026-06-10 09:00:04'),
(3, 2, 1, 1, 30000.00, '2026-06-10 10:10:46', '2026-06-10 10:10:46'),
(4, 3, 1, 1, 30000.00, '2026-06-10 10:19:25', '2026-06-10 10:19:25'),
(5, 3, 2, 1, 32000.00, '2026-06-10 10:19:25', '2026-06-10 10:19:25'),
(6, 3, 3, 1, 33000.00, '2026-06-10 10:19:25', '2026-06-10 10:19:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(12,2) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `weight` int(11) DEFAULT NULL COMMENT 'in grams',
  `images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`images`)),
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `slug`, `description`, `price`, `stock`, `weight`, `images`, `is_active`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 4, 'Daisy Chain Strap', 'daisy-chain-strap', 'Strap handphone manis dengan dekorasi manik-manik bunga daisy pastel.', 30000.00, 47, 20, '[\"images\\/phonestrap\\/daisy-chain.jpg\"]', 1, NULL, '2026-06-10 05:52:46', '2026-06-10 10:19:25'),
(2, 4, 'Stars Night Strap', 'stars-night-strap', 'Tampil bersinar dengan strap handphone bertema malam berbintang biru tua dan perak.', 32000.00, 48, 20, '[\"images\\/phonestrap\\/stars-night.jpg\"]', 1, NULL, '2026-06-10 05:52:46', '2026-06-10 10:19:25'),
(3, 4, 'Rainbow Dream Strap', 'rainbow-dream-strap', 'Strap warna-warni pelangi yang ceria dan penuh energi positif.', 33000.00, 49, 20, '[\"images\\/phonestrap\\/rainbow-dream.jpg\"]', 1, NULL, '2026-06-10 05:52:46', '2026-06-10 10:19:25'),
(4, 3, 'Flower Keychain', 'flower-keychain', 'Gantungan kunci bunga rajut buatan tangan yang imut dan bertekstur lembut.', 25000.00, 50, 15, '[\"images\\/keychain\\/flower.jpg\"]', 1, NULL, '2026-06-10 05:52:46', '2026-06-10 05:52:46'),
(5, 3, 'Rainbow Keychain', 'rainbow-keychain', 'Gantungan kunci pelangi berbahan rajut untuk mempercantik tas atau kunci Anda.', 28000.00, 50, 15, '[\"images\\/keychain\\/rainbow.jpg\"]', 1, NULL, '2026-06-10 05:52:46', '2026-06-10 05:52:46'),
(6, 2, 'Pastel Dream Bracelet', 'pastel-dream-bracelet', 'Gelang manik-manik dengan susunan warna pastel lembut yang estetik.', 35000.00, 50, 10, '[\"images\\/bracelet\\/pastel-dream.jpg\"]', 1, NULL, '2026-06-10 05:52:46', '2026-06-10 05:52:46'),
(7, 2, 'Butterfly Charm Bracelet', 'butterfly-charm-bracelet', 'Gelang manis dengan liontin kupu-kupu akrilik transparan yang elegan.', 38000.00, 50, 10, '[\"images\\/bracelet\\/butterfly-charm.jpg\"]', 1, NULL, '2026-06-10 05:52:46', '2026-06-10 05:52:46'),
(8, 1, 'Rainbow Bag Charm', 'rainbow-bag-charm', 'Gantungan tas pelangi yang berukuran lebih besar, sangat cocok untuk backpack atau totebag.', 40000.00, 50, 30, '[\"images\\/bagcharm\\/rainbow.jpg\"]', 1, NULL, '2026-06-10 05:52:46', '2026-06-10 05:52:46'),
(9, 1, 'Flower Bag Charm', 'flower-bag-charm', 'Gantungan tas bermotif bunga rajutan manis untuk mempercantik tas favorit Anda.', 38000.00, 50, 30, '[\"images\\/bagcharm\\/flower.jpg\"]', 1, NULL, '2026-06-10 05:52:46', '2026-06-10 05:52:46'),
(10, 5, 'Custom Design', 'custom-design', 'Pesan aksesori impianmu di sini! Tentukan warna, jenis manik-manik, dan detail pesanan sesuai keinginanmu.', 15000.00, 999, 10, '[\"images\\/custom\\/customdesign.jpg\"]', 1, NULL, '2026-06-10 05:52:46', '2026-06-10 10:27:08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('cBmjAS26oMVOJHOwcXjWJlQ6pBIdfQTthU5WUKHy', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiT1hsaXY2TWFPN0hWcW5najJHbmJsN2NwTlZ1aTBiY1kxQnZVeU0yVSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jaGVja291dCI7czo1OiJyb3V0ZSI7czoxNDoiY2hlY2tvdXQuaW5kZXgiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyO3M6NDoiY2FydCI7YToxOntpOjE7YToxOntzOjg6InF1YW50aXR5IjtpOjE7fX19', 1781107120),
('QK1tQLjy1WZxhYahNs58GRRrCNbV15JOG27uypmW', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiU0dJYno2RjJSaFlWamhoSWtUM3NDVGJXZWxjYThMbXB5SG8xeXhVdyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jYXRhbG9nIjtzOjU6InJvdXRlIjtzOjc6ImNhdGFsb2ciO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1781112609),
('ZIAWckehxVT6sbFe3MqiewRKfJEXFj1oOB9lna66', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiMk55c3ZPaUNDQWVUQ1lLcE5pRGdzaWl0YlVhS2RnV1RWN0NQMGdxbCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9maWxlIjtzOjU6InJvdXRlIjtzOjEzOiJwcm9maWxlLmluZGV4Ijt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mjt9', 1781112071);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `phone` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `phone`, `address`, `avatar`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin Wigglepop', 'admin@wigglepop.com', NULL, '$2y$12$qKRCjeE0N7PTovM5Gph9euXAsjdPECftyPj7aVPIxJ8UambceUp.i', 'admin', '081234567890', 'Wigglepop Studio, Jakarta', NULL, NULL, '2026-06-10 05:52:46', '2026-06-10 05:52:46'),
(2, 'sean', 'user@wigglepop.com', NULL, '$2y$12$ZY7b.mcju7Fi.58ACf7Vu.sc3bSB1r4zcSUUwN7PSLGvohULR7oIK', 'user', '089876543210', 'Jl. Lavender No. 5, Jakarta', 'avatars/2ADQk2n4y4tjFUACaZ6jpFysgDUSkP1b7p1508uO.jpg', NULL, '2026-06-10 05:52:46', '2026-06-10 10:13:23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `wishlists`
--

INSERT INTO `wishlists` (`id`, `user_id`, `product_id`, `created_at`, `updated_at`) VALUES
(2, 2, 1, '2026-06-10 10:12:15', '2026-06-10 10:12:15');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin_profiles`
--
ALTER TABLE `admin_profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_profiles_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Indeks untuk tabel `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `custom_orders`
--
ALTER TABLE `custom_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `custom_orders_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_order_code_unique` (`order_code`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indeks untuk tabel `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `wishlists_user_id_product_id_unique` (`user_id`,`product_id`),
  ADD KEY `wishlists_product_id_foreign` (`product_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin_profiles`
--
ALTER TABLE `admin_profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `custom_orders`
--
ALTER TABLE `custom_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `admin_profiles`
--
ALTER TABLE `admin_profiles`
  ADD CONSTRAINT `admin_profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `custom_orders`
--
ALTER TABLE `custom_orders`
  ADD CONSTRAINT `custom_orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `wishlists`
--
ALTER TABLE `wishlists`
  ADD CONSTRAINT `wishlists_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wishlists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
