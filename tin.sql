-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 31, 2025 lúc 09:15 AM
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
-- Cơ sở dữ liệu: `php3_lab2`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tin`
--

CREATE TABLE `tin` (
  `id` int(11) NOT NULL,
  `tieuDe` varchar(255) NOT NULL,
  `tomTat` text DEFAULT NULL,
  `noiDung` text DEFAULT NULL,
  `ngayDang` date DEFAULT NULL,
  `xem` int(11) DEFAULT 0,
  `idLT` int(11) DEFAULT NULL,
  `urlHinh` text NOT NULL,
  `anHien` tinyint(1) NOT NULL DEFAULT 1,
  `tags` varchar(55) NOT NULL,
  `lang` varchar(55) NOT NULL,
  `tinNoiBat` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tin`
--

INSERT INTO `tin` (`id`, `tieuDe`, `tomTat`, `noiDung`, `ngayDang`, `xem`, `idLT`, `urlHinh`, `anHien`, `tags`, `lang`, `tinNoiBat`, `created_at`, `updated_at`) VALUES
(2, 'Poet Huu Loan dies at age 95', 'pp', 'Chi tiết về cuộc đời nhà thơ...', '2025-03-31', 1200, 1, 'images/ujTZLIKmROwK7rvXLm5ZyUFJ0COi4wtyhQ6TVelk.jpg', 1, 'sấ', 'ádasdasd', 1, NULL, '2025-03-30 20:54:41'),
(3, 'Hình vẽ tiết lộ nội tâm của bạn', 'dfdfsdfs', 'Nội dung chi tiết về hình vẽ...', '2025-03-31', 800, 1, '', 1, '', '', 0, NULL, '2025-03-30 20:36:40'),
(4, 'Bí quyết giúp người nội trợ tiết kiệm chi phí mua sắm', 'ads', 'Chi tiết cách tiết kiệm...', '2025-03-31', 600, 2, '', 1, '', '', 0, NULL, '2025-03-30 20:34:55'),
(5, 'Tận cùng nỗi đau', 'Câu chuyện về Thanh Trúc.', 'Chi tiết câu chuyện cảm động...', '2018-12-15', 2000, 1, '', 1, '', '', 0, NULL, NULL),
(14, 'dfsdf', NULL, 'sdfs', '2025-03-31', 0, 1, 'images/fbI0zjPSwxr4CKBsxRzx3s7ZnueHfHJORRAVMtWl.jpg', 1, 'sdfsdf', 'vn', 1, '2025-03-30 23:55:11', '2025-03-30 23:55:11');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `tin`
--
ALTER TABLE `tin`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `tin`
--
ALTER TABLE `tin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
