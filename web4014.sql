-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 29, 2025 lúc 03:00 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `web4014`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Thể thao', '2025-03-26 18:28:33', '2025-03-26 18:28:33'),
(2, 'Âm nhạc', '2025-03-26 18:28:33', '2025-03-26 18:28:33'),
(3, 'Ẩm thực', '2025-03-26 18:28:33', '2025-03-26 18:28:33'),
(4, 'Công nghệ', '2025-03-26 18:28:33', '2025-03-26 18:28:33');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `news_id` bigint(20) UNSIGNED NOT NULL,
  `content` text NOT NULL,
  `status` enum('pending','approved','rejected') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `news_id`, `content`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Tuyệt vời! Việt Nam vô địch xứng đáng.', 'approved', '2025-03-26 18:28:33', '2025-03-28 03:59:35'),
(2, 2, 2, 'MV này hay quá, Sơn Tùng đỉnh cao!', 'pending', '2025-03-26 18:28:33', '2025-03-26 18:28:33'),
(3, 1, 3, 'Mình thử làm rồi, ngon lắm!', 'pending', '2025-03-26 18:28:33', '2025-03-26 18:28:33'),
(4, 2, 1, 'sdfsd', 'pending', '2025-03-26 19:12:30', '2025-03-26 19:12:30'),
(6, 2, 4, 'sá', 'rejected', '2025-03-27 01:37:04', '2025-03-28 03:59:25'),
(7, 2, 2, 'sơn tùng ddz', 'pending', '2025-03-27 01:42:01', '2025-03-27 01:42:01');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
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
-- Cấu trúc bảng cho bảng `jobs`
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
-- Cấu trúc bảng cho bảng `job_batches`
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
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(7, '0001_01_01_000000_create_users_table', 1),
(8, '0001_01_01_000001_create_cache_table', 1),
(9, '0001_01_01_000002_create_jobs_table', 1),
(10, '2025_03_26_111959_create_categories_table', 1),
(11, '2025_03_26_111959_create_news_table', 1),
(12, '2025_03_26_112238_create_comments_table', 1),
(13, '2025_03_27_022212_add_activation_to_users_table', 2),
(14, '2025_03_27_080755_add_active_column_to_users_table', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `news`
--

CREATE TABLE `news` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `content` text NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(55) NOT NULL,
  `slug` text NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'draft',
  `summary` varchar(255) NOT NULL,
  `views` int(11) NOT NULL DEFAULT 0,
  `hot` int(1) NOT NULL DEFAULT 0,
  `thumbnail` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `news`
--

INSERT INTO `news` (`id`, `title`, `description`, `content`, `category_id`, `user_id`, `slug`, `status`, `summary`, `views`, `hot`, `thumbnail`, `created_at`, `updated_at`) VALUES
(1, 'Việt Nam vô địch AFF Cup 2024', 'Đội tuyển Việt Nam giành chiến thắng đầy thuyết phục.', 'Trong trận chung kết AFF Cup 2024, Việt Nam đã đánh bại Thái Lan với tỷ số 2-1...', 1, '', 'viet-nam-vo-dich-aff-cup-2024', 'draft', '', 158, 0, 'thumbnails/vnvd.jpg', '2025-03-26 18:28:33', '2025-03-28 00:37:30'),
(2, 'Sơn Tùng M-TP ra mắt MV mới', 'MV mới của Sơn Tùng gây bão cộng đồng mạng.', 'MV mới mang tên \"Hãy Trao Cho Anh 2\" đã thu hút hàng triệu lượt xem chỉ sau 24 giờ...', 2, '', '', 'draft', '', 204, 0, 'thumbnails/anh-man-hinh-2024-06-09-luc-08-27-49-22146672438588568459871.webp', '2025-03-26 18:28:33', '2025-03-27 01:42:01'),
(3, 'Cách làm bánh mì pate chuẩn vị', 'Học ngay công thức làm bánh mì pate ngon tại nhà.', 'Bánh mì pate là món ăn quen thuộc của người Việt, với nguyên liệu đơn giản...', 3, '', '', 'draft', '', 82, 0, 'thumbnails/cach-lam-banh-mi-pate-truyen-thong-ngon-de-ban.webp', '2025-03-26 18:28:33', '2025-03-26 19:10:46'),
(4, 'iPhone 16 ra mắt với thiết kế đột phá', 'Apple công bố iPhone 16 với nhiều cải tiến.', 'iPhone 16 được trang bị chip A18, camera cải tiến và thiết kế không viền...', 4, '', '', 'draft', '', 320, 0, 'thumbnails/vivox200.jfif', '2025-03-26 18:28:33', '2025-03-28 06:55:41'),
(5, 'bích tuyền cute', NULL, 'bich tuyền cute báo đời số 1 việt nam&nbsp;', 1, '2', 'b', 'draft', 'nói chung là xinh vai đạn', 2, 1, 'thumbnails/EvCCntzM5ofG1uxfvFRYZdTpD7opGKMUIZrohFgR.jpg', '2025-03-28 00:56:05', '2025-03-28 07:14:43');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sessions`
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
-- Đang đổ dữ liệu cho bảng `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('p4AvfYXmW6Yp7aEc7K2yBxU5qIw1Y9bgc5E9TVyw', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiUHBIaWsyeHI0YkhFcHptRzRLMXJDNkxqb01jWkh6WjhnUVliNXo0NSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9maWxlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mjt9', 1743171362);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `role` enum('client','admin') NOT NULL,
  `activation_token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `active`, `role`, `activation_token`) VALUES
(1, 'Test User', 'test@example.com', '2025-03-26 18:28:32', '$2y$12$yLK1.9uekmtFF6CspnXGHeQ1lqILxhdRKTTz9GPNSrZl0Ewtu.xlu', 'F6XTNDGv29', '2025-03-26 18:28:33', '2025-03-26 18:28:33', 1, 'client', NULL),
(2, 'admin', 'quyenjpn@gmail.com', NULL, '$2y$12$H5FqzkmpxD0gtSVa2ytAPuwb27R6OXCRoGT7CZkZZ2SGtxCDAD1vK', NULL, '2025-03-26 18:28:33', '2025-03-27 01:40:01', 1, 'admin', NULL),
(3, 'Trần Thị B', 'user2@example.com', NULL, '$2y$12$XrWw5Hqiila4fP6kFvc2ZeglyHYSfuqFizhe3TKQ5ZPQUsmk3iUCK', NULL, '2025-03-26 18:28:33', '2025-03-26 18:28:33', 0, 'client', NULL),
(4, 'Đồ thờ cúng', 'quyenjpnd@gmail.com', NULL, '$2y$12$PsXRVPB1DRMWKT4wV6WLhO9si9174mTu.Ng2/.uPr5l9dewaA8kVK', NULL, '2025-03-27 01:14:29', '2025-03-27 01:14:29', 0, 'client', 'E2Vrpv8iKbhrCcaG594OzpRBFPp3np577IeYgq5h8BHwzB1ns6hlVcDQMn4Q'),
(5, 'Đồ thờ cúng', 'quyenjpndd@gmail.com', NULL, '$2y$12$QIk4ghqedy5DnG2QFYvov.40ugVbTYJGGK/DJtoTVhRCkupKR65RS', NULL, '2025-03-27 01:16:11', '2025-03-27 01:16:11', 1, 'client', NULL);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Chỉ mục cho bảng `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_user_id_foreign` (`user_id`),
  ADD KEY `comments_news_id_foreign` (`news_id`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Chỉ mục cho bảng `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `news_category_id_foreign` (`category_id`);

--
-- Chỉ mục cho bảng `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Chỉ mục cho bảng `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `news`
--
ALTER TABLE `news`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_news_id_foreign` FOREIGN KEY (`news_id`) REFERENCES `news` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
