-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Sep 2024 pada 01.06
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tefa-db`
--

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
  `name_categories` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`id`, `name_categories`, `created_at`, `updated_at`) VALUES
(1, 'Makanan', '2024-08-26 03:36:56', NULL),
(2, 'Minuman', '2024-08-26 03:36:56', NULL),
(3, 'Perlengkapan Sekolah', '2024-08-26 03:36:56', NULL),
(4, 'Fashion', '2024-08-26 03:36:56', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `checkouts`
--

CREATE TABLE `checkouts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `grand_total` int(11) DEFAULT NULL,
  `id_cart` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `checkout_details`
--

CREATE TABLE `checkout_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `checkout_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` decimal(12,2) NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `sub_total` decimal(12,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Struktur dari tabel `images_products`
--

CREATE TABLE `images_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `imageName` varchar(255) NOT NULL,
  `is_thumb` int(11) DEFAULT NULL,
  `id_product` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `images_products`
--

INSERT INTO `images_products` (`id`, `imageName`, `is_thumb`, `id_product`, `created_at`, `updated_at`) VALUES
(28, 'parfum1.jpeg', 1, 49, '2024-09-05 00:24:33', '2024-09-05 00:24:33'),
(29, 'chitato.jpeg', 1, 50, '2024-09-05 07:42:17', '2024-09-05 07:42:17'),
(30, 'zeky.jpeg', 1, 51, '2024-09-05 07:44:31', '2024-09-05 07:44:31'),
(31, 'kentangGoreng.jpeg', 1, 52, '2024-09-05 07:45:03', '2024-09-05 07:45:03'),
(32, 'floridina.jpg', 1, 53, '2024-09-06 07:40:24', '2024-09-06 07:40:24'),
(33, 'coca-cola.jpg', 1, 54, '2024-09-06 07:41:03', '2024-09-06 07:41:03'),
(34, 'cimoryYougurt.jpg', 1, 55, '2024-09-06 07:42:11', '2024-09-06 07:42:11'),
(35, 'milku.jpg', 1, 56, '2024-09-06 07:43:00', '2024-09-06 07:43:00'),
(36, 'tehPucuk.jpg', 1, 57, '2024-09-06 07:44:10', '2024-09-06 07:44:10'),
(37, 'tehJavana.jpg', 1, 58, '2024-09-06 07:44:51', '2024-09-06 07:44:51'),
(39, 'pulpen.jpeg', 1, 59, '2024-09-06 08:07:25', '2024-09-06 08:07:25'),
(41, 'oasis.jpeg', 1, 46, '2024-09-06 09:27:04', '2024-09-06 09:27:04'),
(42, 'momogi1.jpeg', 1, 60, '2024-09-06 09:27:58', '2024-09-06 09:27:58'),
(43, 'packmomogi.jpeg', 0, 60, '2024-09-06 09:27:58', '2024-09-06 09:27:58');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_08_24_065125_create_categories_table', 1),
(6, '2024_08_24_072657_create_roles_table', 1),
(7, '2024_08_24_072916_create_products_table', 1),
(8, '2024_08_24_074346_create_images_products_table', 1),
(9, '2024_08_24_092854_create_shopping_carts_table', 1),
(10, '2024_08_24_100241_create_orders_table', 1),
(11, '2024_08_24_100526_create_checkouts_table', 1),
(12, '2024_08_24_110704_create_cache_table', 1),
(13, '2014_10_12_100000_create_password_resets_table', 2),
(14, '2024_09_01_074724_drop_column_to_shoping_carts', 2),
(15, '2024_09_01_133244_add_column_quantity_to_shoping_carts', 3),
(16, '2024_09_02_105458_add_column_to_shopping_carts', 4),
(17, '2024_09_02_132838_modify_column_to_table_checkouts', 5),
(18, '2024_09_02_135019_add_column_to_table_checkouts', 6),
(19, '2024_09_02_135128_add_column_to_table_checkouts', 7),
(20, '2024_09_03_043157_drop_column_to_table_checkouts', 8),
(21, '2024_09_03_043421_drop_column_to_table_checkouts', 9),
(22, '2024_09_03_062710_create_checkout_details_table', 9),
(23, '2024_09_06_201518_create-field-sold-count', 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `total_price` decimal(12,2) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `order_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('admin@gmail.com', '$2y$12$ZkeKkJm3W8WBzSypouo6f..3KVez3AfF4qkmhfz37XXMmsQSuJnDe', '2024-09-01 00:33:01'),
('jovfrin@gmail.com', '$2y$12$YQG2ebEZylRIFVIOecpudeHYMcngqJWFHkahpuFAuWXRiOS4LyXoa', '2024-09-01 00:31:01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
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
  `name_product` varchar(255) NOT NULL,
  `description_product` varchar(255) NOT NULL,
  `price` int(12) NOT NULL,
  `stock` int(15) NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `sold_count` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id`, `name_product`, `description_product`, `price`, `stock`, `category_id`, `created_at`, `updated_at`, `sold_count`) VALUES
(46, 'Air Minerale Oasis', 'Air Minerale dari Gunung asli', 3000, 50, 2, '2024-08-30 06:18:22', '2024-09-06 09:27:04', NULL),
(49, 'Black Opium Parfume', 'Parfum berbau manis dan enak', 4000, 36, 4, '2024-09-05 00:24:33', '2024-09-06 15:42:08', 5),
(50, 'Chitato Potato Chips', 'Potato Chips Rasa Sapi Panggang', 3000, 100, 1, '2024-09-05 07:42:17', '2024-09-05 07:42:17', NULL),
(51, 'Zeky', 'Zeky Enak Banget cuman Gopean', 500, 20, 1, '2024-09-05 07:44:31', '2024-09-05 07:44:31', NULL),
(52, 'Frech Fries', 'Kentang Goreng Enak cuman 2000an aja', 2000, 20, 1, '2024-09-05 07:45:03', '2024-09-05 07:45:03', NULL),
(53, 'Floridina', 'Ada bulir bulir buah nya', 4000, 40, 2, '2024-09-06 07:40:24', '2024-09-06 07:40:24', NULL),
(54, 'Coca Cola', 'Minuman bersoda', 4000, 50, 2, '2024-09-06 07:41:03', '2024-09-06 07:41:03', NULL),
(55, 'Cimory Yoghurt', 'Terbuat dari susu yang difermentasi', 6000, 24, 2, '2024-09-06 07:42:11', '2024-09-06 07:42:11', NULL),
(56, 'Milku Coklat', 'Milku', 2900, 49, 2, '2024-09-06 07:43:00', '2024-09-06 15:33:28', 1),
(57, 'Teh Pucuk', 'Teh pucuk enak', 4000, 19, 2, '2024-09-06 07:44:10', '2024-09-06 15:33:28', 1),
(58, 'Teh Javana', 'Teh Enak Javana', 4000, 94, 2, '2024-09-06 07:44:51', '2024-09-06 10:03:34', NULL),
(59, 'Pulpen a5', 'Pulpen Warna Hitam', 3000, 15, 3, '2024-09-06 08:07:25', '2024-09-06 10:00:50', NULL),
(60, 'Momogi', 'Momogi Rasa Keju', 500, 50, 1, '2024-09-06 09:27:58', '2024-09-06 09:28:23', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_role` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id`, `name_role`, `created_at`, `updated_at`) VALUES
(1, 'user', NULL, NULL),
(2, 'admin', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `shopping_carts`
--

CREATE TABLE `shopping_carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `sub_total` int(11) DEFAULT NULL,
  `grand_total` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `shopping_carts`
--

INSERT INTO `shopping_carts` (`id`, `user_id`, `product_id`, `created_at`, `updated_at`, `quantity`, `sub_total`, `grand_total`) VALUES
(47, 2, 50, '2024-09-05 17:19:13', '2024-09-05 17:19:13', 1, 3000, NULL),
(48, 2, 51, '2024-09-05 20:11:41', '2024-09-05 20:39:13', 1, 500, NULL),
(53, 1, 57, '2024-09-06 09:21:37', '2024-09-06 09:21:37', 1, 4000, NULL);

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
  `id_role` bigint(20) UNSIGNED DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `id_role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', NULL, '$2y$12$fyh12H8kQHCjSsdxXBF8tu1JETKM/Dllc0rnnUmIiMbSKcTc1WvX2', 2, NULL, '2024-08-31 23:52:53', NULL),
(2, 'user', 'user@gmail.com', NULL, '$2y$12$isn1UzvOqR6ApsD1JcuZ4e7J7FAoDYj/4sLfmoylqhTgjz8lbbOZS', 1, NULL, '2024-08-31 23:52:53', NULL),
(3, 'Jovfrin', 'jovfrin@gmail.com', NULL, '$2y$12$RmRnhB.wH2BvWUbte0CiT.RYxbiors2cMW/gaWw1mi0dFbpnz0Jp6', 1, '3RcogKeNuCngz4UeGI3ttGtn87H3zRPfgakThAh6BX4mn24upAkXfdtNz1sb', '2024-09-01 00:29:04', '2024-09-01 00:29:04'),
(4, 'Testing', 'testing@gmail.com', NULL, '$2y$12$YQbA8CzX26i5UXVN4yzNjesYw6xOLdyLLTu6an3A/.zh5QQtN6NO2', 1, NULL, '2024-09-05 17:28:29', '2024-09-05 17:28:29'),
(5, 'andra', 'andra@gmail.com', NULL, '$2y$12$5/k/4H71ojsssyNCBUFyQOsRD7zyu2BoVBwDM/dyx5lqbVtxJl9x2', 1, NULL, '2024-09-06 04:33:13', '2024-09-06 04:33:13'),
(6, 'jovfrin', 'jovfrin12@gmail.com', NULL, '$2y$12$1Air8xQM1OnabYY.eEhX2e6xnXGeWoaAHJi1kLQRGYVsTeINwUzJe', 1, NULL, '2024-09-06 09:24:04', '2024-09-06 09:24:04');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `checkouts`
--
ALTER TABLE `checkouts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `checkouts_user_id_foreign` (`user_id`),
  ADD KEY `checkouts_id_cart_foreign` (`id_cart`);

--
-- Indeks untuk tabel `checkout_details`
--
ALTER TABLE `checkout_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `checkout_details_checkout_id_foreign` (`checkout_id`),
  ADD KEY `checkout_details_product_id_foreign` (`product_id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `images_products`
--
ALTER TABLE `images_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `images_products_id_product_foreign` (`id_product`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_product_id_foreign` (`product_id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

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
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `shopping_carts`
--
ALTER TABLE `shopping_carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shopping_carts_user_id_foreign` (`user_id`),
  ADD KEY `shopping_carts_product_id_foreign` (`product_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `checkouts`
--
ALTER TABLE `checkouts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT untuk tabel `checkout_details`
--
ALTER TABLE `checkout_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `images_products`
--
ALTER TABLE `images_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `shopping_carts`
--
ALTER TABLE `shopping_carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `checkouts`
--
ALTER TABLE `checkouts`
  ADD CONSTRAINT `checkouts_id_cart_foreign` FOREIGN KEY (`id_cart`) REFERENCES `shopping_carts` (`id`),
  ADD CONSTRAINT `checkouts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `checkout_details`
--
ALTER TABLE `checkout_details`
  ADD CONSTRAINT `checkout_details_checkout_id_foreign` FOREIGN KEY (`checkout_id`) REFERENCES `checkouts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `checkout_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `images_products`
--
ALTER TABLE `images_products`
  ADD CONSTRAINT `images_products_id_product_foreign` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`);

--
-- Ketidakleluasaan untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Ketidakleluasaan untuk tabel `shopping_carts`
--
ALTER TABLE `shopping_carts`
  ADD CONSTRAINT `shopping_carts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `shopping_carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
