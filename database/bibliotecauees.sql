-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 22, 2023 at 12:19 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bibliotecauees`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `img` blob DEFAULT NULL,
  `docpdf` blob DEFAULT NULL,
  `ISBN` varchar(100) DEFAULT NULL,
  `barcode_image` blob DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `name`, `description`, `img`, `docpdf`, `ISBN`, `barcode_image`, `amount`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Marvel 1', 'Libro sobre marvel', NULL, NULL, '89898989898', NULL, 10, 1, '2023-05-25 18:04:36', '2023-05-26 02:11:57'),
(2, 'Marvel 2', 'Este es el libro 2 de marvel', 0x62616467652e706e67, NULL, '909209109210', NULL, 13, 1, '2023-05-26 00:35:50', '2023-05-25 23:10:50'),
(3, 'Marvel 3', 'Este es el libro 3 de marvel', NULL, NULL, '9092091092101111', NULL, 15, 0, '2023-05-26 00:57:01', '2023-05-25 20:36:26'),
(4, 'Las aventuras de Arthur Gordon Pym', 'clasicos de siempre edad allan poe', 0x494d475f353930372e6a7067, NULL, '9788484030249', 0x646174613a696d6167652f706e673b6261736536342c6956424f5277304b47676f414141414e5355684555674141414c34414141416541514d414141436f706a597741414141426c424d5645582f2f2f38414141425677744e2b4141414141585253546c4d41514f62595a67414141416c7753466c7a4141414f78414141447351426c53734f477741414143704a524546554b4a466a4f50506e6738474277775932504d624d5a3834664e7544355933796535342b3977526d4755596c526965456d41514273476d616f6d6a4f496c6741414141424a52553545726b4a6767673d3d, 60, 1, '2023-07-09 17:26:19', '2023-07-09 19:33:56'),
(5, 'test', 'test', NULL, NULL, '1232132132314', 0x646174613a696d6167652f706e673b6261736536342c6956424f5277304b47676f414141414e5355684555674141414c34414141416541514d414141436f706a597741414141426c424d5645582f2f2f38414141425677744e2b4141414141585253546c4d41514f62595a67414141416c7753466c7a4141414f78414141447351426c53734f477741414143704a524546554b4a466a4f4750772b632f68382f77384277772b6e7a6e506238447a2b5444446558376a44326359526956474a5961624241434d53594c494a587066645141414141424a52553545726b4a6767673d3d, 1, 1, '2023-07-09 17:52:45', '2023-07-09 18:06:53'),
(10, 'Gordon pym 2', 'Las aventuras de gordon pym', NULL, 0x6c61735f6176656e74757261735f64655f6172746875725f676f72646f6e5f70796d2e706466, '760573081164', 0x646174613a696d6167652f706e673b6261736536342c6956424f5277304b47676f414141414e5355684555674141414c34414141416541514d414141436f706a597741414141426c424d5645582f2f2f38414141425677744e2b4141414141585253546c4d41514f62595a67414141416c7753466c7a4141414f78414141447351426c53734f477741414143704a524546554b4a466a4f48502b4d2f39355a6836652f3862385a383459324e68382b477a413838666777426d4755596c526965456d4151435352475179617a5a47594141414141424a52553545726b4a6767673d3d, 48, 1, '2023-07-16 18:46:48', '2023-07-21 00:11:41');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `note` varchar(100) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `comprobante` blob DEFAULT NULL,
  `return_date` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `note`, `quantity`, `comprobante`, `return_date`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Primera prueba ingresando una orden', 1, NULL, NULL, 1, '2023-06-14 23:06:53', '2023-06-14 23:06:53'),
(2, 1, 'Segunda prueba ingresando una orden', 1, NULL, NULL, 1, '2023-06-14 23:17:04', '2023-06-14 23:17:04'),
(3, 1, 'Alquiler de libro', 1, NULL, NULL, 1, '2023-07-20 16:54:04', '2023-07-20 16:54:04'),
(4, 1, 'Alquiler de libro', 1, NULL, NULL, 1, '2023-07-20 16:58:15', '2023-07-20 16:58:15'),
(5, 1, 'Alquiler de libro', 1, NULL, NULL, 1, '2023-07-20 16:59:12', '2023-07-20 16:59:12'),
(6, 1, 'Alquiler de libro', 1, NULL, NULL, 1, '2023-07-20 17:22:31', '2023-07-20 17:22:31'),
(7, 2, 'Alquiler de libro', 1, NULL, NULL, 1, '2023-07-20 17:23:07', '2023-07-20 17:23:07'),
(8, 1, 'Alquiler de libro', 1, NULL, NULL, 1, '2023-07-20 17:51:55', '2023-07-20 17:51:55'),
(9, 1, 'Alquiler de libro', 1, NULL, NULL, 1, '2023-07-20 18:10:15', '2023-07-20 18:10:15'),
(10, 1, 'Alquiler de libro', 1, NULL, NULL, 1, '2023-07-20 18:12:01', '2023-07-20 18:12:01'),
(11, 1, 'Alquiler de libro', 1, NULL, NULL, 1, '2023-07-20 18:13:43', '2023-07-20 18:13:43'),
(12, 2, 'Alquiler de libro', 1, NULL, NULL, 1, '2023-07-20 18:16:01', '2023-07-20 18:16:01'),
(13, 1, 'Alquiler de libro', 1, NULL, NULL, 1, '2023-07-20 18:20:10', '2023-07-20 18:20:10'),
(14, 1, 'Alquiler de libro', 1, NULL, NULL, 1, '2023-07-20 18:22:08', '2023-07-20 18:22:08'),
(15, 1, 'Alquiler de libro', 1, NULL, NULL, 1, '2023-07-20 18:22:17', '2023-07-20 18:22:17'),
(16, 1, 'Alquiler de libro', 1, NULL, NULL, 1, '2023-07-20 18:24:45', '2023-07-20 18:24:45'),
(17, 1, 'Alquiler de libro', 1, NULL, NULL, 1, '2023-07-20 18:25:21', '2023-07-20 18:25:21'),
(18, 1, 'Alquiler de libro', 1, NULL, NULL, 1, '2023-07-20 18:26:48', '2023-07-20 18:26:48'),
(19, 1, 'Alquiler de libro', 1, NULL, NULL, 1, '2023-07-20 18:27:48', '2023-07-20 18:27:48'),
(20, 1, 'Alquiler de libro', 1, NULL, NULL, 1, '2023-07-20 18:31:38', '2023-07-20 18:31:38'),
(21, 1, 'Alquiler de libro', 1, NULL, NULL, 1, '2023-07-20 18:33:39', '2023-07-20 18:33:39'),
(22, 1, 'Alquiler de libro', 1, NULL, NULL, 1, '2023-07-20 18:35:03', '2023-07-20 18:35:03'),
(23, 1, 'Alquiler de libro', 1, NULL, NULL, 1, '2023-07-20 18:35:21', '2023-07-20 18:35:21'),
(24, 1, 'Alquiler de libro', 1, NULL, NULL, 1, '2023-07-20 18:36:47', '2023-07-20 18:36:47'),
(25, 1, 'Alquiler de libro', 1, NULL, NULL, 1, '2023-07-20 18:37:54', '2023-07-20 18:37:54'),
(26, 1, 'Alquiler de libro', 1, NULL, NULL, 1, '2023-07-20 18:40:16', '2023-07-20 18:40:16'),
(27, 1, 'Alquiler de libro', 1, NULL, NULL, 1, '2023-07-20 18:40:34', '2023-07-20 18:40:34'),
(28, 1, 'Alquiler de libro', 1, NULL, NULL, 1, '2023-07-20 19:02:39', '2023-07-20 19:02:39'),
(29, 1, 'Alquiler de libro', 1, NULL, NULL, 1, '2023-07-20 19:13:32', '2023-07-20 19:13:32'),
(30, 1, 'Alquiler de libro', 1, NULL, NULL, 1, '2023-07-20 19:14:54', '2023-07-20 19:14:54'),
(31, 1, 'Alquiler de libro', 1, NULL, NULL, 1, '2023-07-20 19:14:58', '2023-07-20 19:14:58'),
(32, 1, 'Alquiler de libro', 1, NULL, NULL, 1, '2023-07-20 19:22:04', '2023-07-20 19:22:04'),
(33, 1, 'Alquiler de libro', 1, NULL, NULL, 1, '2023-07-20 19:25:16', '2023-07-20 19:25:16'),
(34, 1, 'Alquiler de libro', 1, NULL, NULL, 1, '2023-07-20 19:25:19', '2023-07-20 19:25:19'),
(35, 1, 'Alquiler de libro', 1, NULL, NULL, 1, '2023-07-20 19:26:45', '2023-07-20 19:26:45'),
(36, 1, 'Alquiler de libro', 1, NULL, NULL, 1, '2023-07-20 19:27:21', '2023-07-20 19:27:21'),
(37, 1, 'Alquiler de libro', 1, NULL, NULL, 1, '2023-07-20 19:29:29', '2023-07-20 19:29:29'),
(38, 1, 'Alquiler de libro', 1, NULL, NULL, 1, '2023-07-20 19:29:34', '2023-07-20 19:29:34'),
(39, 1, 'Alquiler de libro', 1, NULL, NULL, 1, '2023-07-20 19:30:54', '2023-07-20 19:30:54'),
(40, 1, 'Alquiler de libro', 1, NULL, NULL, 1, '2023-07-20 19:31:12', '2023-07-20 19:31:12'),
(41, 1, 'Alquiler de libro', 1, NULL, NULL, 1, '2023-07-20 19:32:27', '2023-07-20 19:32:27'),
(42, 1, 'Alquiler de libro', 1, NULL, NULL, 1, '2023-07-20 19:32:46', '2023-07-20 19:32:46'),
(43, 1, 'Alquiler de libro', 1, NULL, NULL, 1, '2023-07-20 19:35:06', '2023-07-20 19:35:06'),
(44, 1, 'Alquiler de libro', 1, NULL, NULL, 1, '2023-07-20 19:36:25', '2023-07-20 19:36:25'),
(45, 1, 'Alquiler de libro', 1, NULL, NULL, 1, '2023-07-20 19:51:00', '2023-07-20 19:51:00'),
(46, 1, 'Alquiler de libro', 1, NULL, NULL, 1, '2023-07-20 19:51:40', '2023-07-20 19:51:40'),
(47, 1, 'Alquiler de libro', 1, NULL, NULL, 1, '2023-07-20 19:52:40', '2023-07-20 19:52:40'),
(48, 1, 'Alquiler de libro', 1, NULL, NULL, 1, '2023-07-20 19:53:24', '2023-07-20 19:53:24'),
(49, 1, 'Alquiler de libro', 1, NULL, NULL, 1, '2023-07-20 21:19:39', '2023-07-20 21:19:39'),
(50, 1, 'Alquiler de libro', 1, NULL, NULL, 1, '2023-07-20 21:29:14', '2023-07-20 21:29:14'),
(51, 1, 'Alquiler de libro', 1, NULL, NULL, 1, '2023-07-20 21:37:41', '2023-07-20 21:37:41'),
(52, 1, 'Alquiler de libro', 1, NULL, NULL, 1, '2023-07-20 21:38:22', '2023-07-20 21:38:22'),
(53, 1, 'Alquiler de libro', 1, NULL, NULL, 1, '2023-07-20 21:38:40', '2023-07-20 21:38:40'),
(54, 1, 'Alquiler de libro', 1, NULL, NULL, 1, '2023-07-20 21:39:42', '2023-07-20 21:39:42'),
(55, 1, 'Alquiler de libro', 1, NULL, NULL, 1, '2023-07-20 21:41:52', '2023-07-20 21:41:52'),
(56, 1, 'Alquiler de libro', 1, NULL, NULL, 1, '2023-07-20 21:42:05', '2023-07-20 21:42:05'),
(57, 1, 'Alquiler de libro', 1, NULL, NULL, 1, '2023-07-20 21:42:18', '2023-07-20 21:42:18'),
(58, 1, 'Alquiler de libro', 1, NULL, NULL, 1, '2023-07-20 21:49:35', '2023-07-20 21:49:35'),
(59, 1, 'Alquiler de libro', 1, NULL, NULL, 1, '2023-07-20 21:49:48', '2023-07-20 21:49:48'),
(60, 1, 'Alquiler de libro', 1, NULL, NULL, 1, '2023-07-20 21:51:30', '2023-07-20 21:51:30'),
(61, 1, 'Alquiler de libro', 1, NULL, NULL, 1, '2023-07-20 21:53:39', '2023-07-20 21:53:39'),
(62, 1, 'Alquiler de libro', 1, NULL, NULL, 1, '2023-07-20 22:02:52', '2023-07-20 22:02:52'),
(63, 1, 'Alquiler de libro', 1, NULL, NULL, 1, '2023-07-20 22:03:47', '2023-07-20 22:03:47'),
(64, 1, 'Alquiler de libro', 1, NULL, NULL, 1, '2023-07-20 22:05:00', '2023-07-20 22:05:00'),
(65, 1, 'Alquiler de libro', 1, NULL, NULL, 1, '2023-07-20 22:05:20', '2023-07-20 22:05:20'),
(66, 1, 'Alquiler de libro', 1, NULL, NULL, 1, '2023-07-20 22:44:39', '2023-07-20 22:44:39'),
(67, 1, 'Alquiler de libro', 1, NULL, NULL, 1, '2023-07-20 22:48:05', '2023-07-20 22:48:05'),
(68, 1, 'Alquiler de libro', 1, NULL, NULL, 1, '2023-07-20 22:52:07', '2023-07-20 22:52:07'),
(69, 1, 'Alquiler de libro', 1, NULL, NULL, 1, '2023-07-20 22:55:54', '2023-07-20 22:55:54'),
(70, 1, 'Alquiler de libro', 1, 0x766f75636865722d313638393839333937392e706466, NULL, 1, '2023-07-20 22:59:39', '2023-07-20 22:59:39'),
(71, 1, 'Alquiler de libro', 1, NULL, NULL, 1, '2023-07-20 23:47:19', '2023-07-20 23:47:19'),
(72, 1, 'Alquiler de libro', 1, 0x766f75636865722d313638393839373337382e706466, NULL, 1, '2023-07-20 23:56:18', '2023-07-20 23:56:18'),
(73, 1, 'Alquiler de libro', 1, 0x766f75636865722d313638393839373731362e706466, NULL, 1, '2023-07-21 00:01:56', '2023-07-21 00:01:56'),
(74, 1, 'Alquiler de libro', 1, NULL, NULL, 1, '2023-07-21 00:03:47', '2023-07-21 00:03:47'),
(75, 1, 'Alquiler de libro', 1, NULL, NULL, 1, '2023-07-21 00:05:19', '2023-07-21 00:05:19'),
(76, 1, 'Alquiler de libro', 1, NULL, NULL, 1, '2023-07-21 00:07:05', '2023-07-21 00:07:05'),
(77, 1, 'Alquiler de libro', 1, NULL, NULL, 1, '2023-07-21 00:09:18', '2023-07-21 00:09:18'),
(78, 1, 'Alquiler de libro', 1, NULL, NULL, 1, '2023-07-21 00:10:37', '2023-07-21 00:10:37'),
(79, 1, 'Alquiler de libro', 1, 0x766f75636865722d313638393839383237362e706466, NULL, 1, '2023-07-21 00:11:16', '2023-07-21 00:11:16'),
(80, 2, 'Alquiler de libro', 1, 0x766f75636865722d313638393839383330312e706466, NULL, 1, '2023-07-21 00:11:41', '2023-07-21 00:11:41');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `amount` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `book_id`, `amount`, `created_at`, `updated_at`) VALUES
(1, 1, 2, NULL, '2023-06-14 23:06:53', '2023-06-14 23:06:53'),
(2, 2, 1, 1, '2023-06-14 23:17:04', '2023-06-14 23:17:04'),
(3, 3, 10, 1, '2023-07-20 16:54:04', '2023-07-20 16:54:04'),
(4, 4, 10, 1, '2023-07-20 16:58:15', '2023-07-20 16:58:15'),
(5, 5, 10, 1, '2023-07-20 16:59:12', '2023-07-20 16:59:12'),
(6, 6, 10, 1, '2023-07-20 17:22:31', '2023-07-20 17:22:31'),
(7, 7, 10, 1, '2023-07-20 17:23:07', '2023-07-20 17:23:07'),
(8, 8, 10, 1, '2023-07-20 17:51:55', '2023-07-20 17:51:55'),
(9, 9, 10, 1, '2023-07-20 18:10:15', '2023-07-20 18:10:15'),
(10, 10, 10, 1, '2023-07-20 18:12:01', '2023-07-20 18:12:01'),
(11, 11, 10, 1, '2023-07-20 18:13:43', '2023-07-20 18:13:43'),
(12, 12, 10, 1, '2023-07-20 18:16:01', '2023-07-20 18:16:01'),
(13, 13, 10, 1, '2023-07-20 18:20:10', '2023-07-20 18:20:10'),
(14, 14, 10, 1, '2023-07-20 18:22:08', '2023-07-20 18:22:08'),
(15, 15, 10, 1, '2023-07-20 18:22:17', '2023-07-20 18:22:17'),
(16, 16, 10, 1, '2023-07-20 18:24:45', '2023-07-20 18:24:45'),
(17, 17, 10, 1, '2023-07-20 18:25:21', '2023-07-20 18:25:21'),
(18, 18, 10, 1, '2023-07-20 18:26:48', '2023-07-20 18:26:48'),
(19, 19, 10, 1, '2023-07-20 18:27:48', '2023-07-20 18:27:48'),
(20, 20, 10, 1, '2023-07-20 18:31:38', '2023-07-20 18:31:38'),
(21, 21, 10, 1, '2023-07-20 18:33:39', '2023-07-20 18:33:39'),
(22, 22, 10, 1, '2023-07-20 18:35:03', '2023-07-20 18:35:03'),
(23, 23, 10, 1, '2023-07-20 18:35:21', '2023-07-20 18:35:21'),
(24, 24, 10, 1, '2023-07-20 18:36:47', '2023-07-20 18:36:47'),
(25, 25, 10, 1, '2023-07-20 18:37:54', '2023-07-20 18:37:54'),
(26, 26, 10, 1, '2023-07-20 18:40:16', '2023-07-20 18:40:16'),
(27, 27, 10, 1, '2023-07-20 18:40:34', '2023-07-20 18:40:34'),
(28, 28, 10, 1, '2023-07-20 19:02:39', '2023-07-20 19:02:39'),
(29, 29, 10, 1, '2023-07-20 19:13:32', '2023-07-20 19:13:32'),
(30, 30, 10, 1, '2023-07-20 19:14:54', '2023-07-20 19:14:54'),
(31, 31, 10, 1, '2023-07-20 19:14:58', '2023-07-20 19:14:58'),
(32, 32, 10, 1, '2023-07-20 19:22:04', '2023-07-20 19:22:04'),
(33, 33, 10, 1, '2023-07-20 19:25:16', '2023-07-20 19:25:16'),
(34, 34, 10, 1, '2023-07-20 19:25:19', '2023-07-20 19:25:19'),
(35, 35, 10, 1, '2023-07-20 19:26:45', '2023-07-20 19:26:45'),
(36, 36, 10, 1, '2023-07-20 19:27:21', '2023-07-20 19:27:21'),
(37, 37, 10, 1, '2023-07-20 19:29:29', '2023-07-20 19:29:29'),
(38, 38, 10, 1, '2023-07-20 19:29:34', '2023-07-20 19:29:34'),
(39, 39, 10, 1, '2023-07-20 19:30:54', '2023-07-20 19:30:54'),
(40, 40, 10, 1, '2023-07-20 19:31:12', '2023-07-20 19:31:12'),
(41, 41, 10, 1, '2023-07-20 19:32:27', '2023-07-20 19:32:27'),
(42, 42, 10, 1, '2023-07-20 19:32:46', '2023-07-20 19:32:46'),
(43, 43, 10, 1, '2023-07-20 19:35:06', '2023-07-20 19:35:06'),
(44, 44, 10, 1, '2023-07-20 19:36:25', '2023-07-20 19:36:25'),
(45, 45, 10, 1, '2023-07-20 19:51:00', '2023-07-20 19:51:00'),
(46, 46, 10, 1, '2023-07-20 19:51:40', '2023-07-20 19:51:40'),
(47, 47, 10, 1, '2023-07-20 19:52:40', '2023-07-20 19:52:40'),
(48, 48, 10, 1, '2023-07-20 19:53:24', '2023-07-20 19:53:24'),
(49, 49, 10, 1, '2023-07-20 21:19:39', '2023-07-20 21:19:39'),
(50, 50, 10, 1, '2023-07-20 21:29:14', '2023-07-20 21:29:14'),
(51, 51, 10, 1, '2023-07-20 21:37:41', '2023-07-20 21:37:41'),
(52, 52, 10, 1, '2023-07-20 21:38:22', '2023-07-20 21:38:22'),
(53, 53, 10, 1, '2023-07-20 21:38:40', '2023-07-20 21:38:40'),
(54, 54, 10, 1, '2023-07-20 21:39:42', '2023-07-20 21:39:42'),
(55, 55, 10, 1, '2023-07-20 21:41:52', '2023-07-20 21:41:52'),
(56, 56, 10, 1, '2023-07-20 21:42:05', '2023-07-20 21:42:05'),
(57, 57, 10, 1, '2023-07-20 21:42:18', '2023-07-20 21:42:18'),
(58, 58, 10, 1, '2023-07-20 21:49:35', '2023-07-20 21:49:35'),
(59, 59, 10, 1, '2023-07-20 21:49:48', '2023-07-20 21:49:48'),
(60, 60, 10, 1, '2023-07-20 21:51:30', '2023-07-20 21:51:30'),
(61, 61, 10, 1, '2023-07-20 21:53:39', '2023-07-20 21:53:39'),
(62, 62, 10, 1, '2023-07-20 22:02:52', '2023-07-20 22:02:52'),
(63, 63, 10, 1, '2023-07-20 22:03:47', '2023-07-20 22:03:47'),
(64, 64, 10, 1, '2023-07-20 22:05:00', '2023-07-20 22:05:00'),
(65, 65, 10, 1, '2023-07-20 22:05:20', '2023-07-20 22:05:20'),
(66, 66, 10, 1, '2023-07-20 22:44:39', '2023-07-20 22:44:39'),
(67, 67, 10, 1, '2023-07-20 22:48:05', '2023-07-20 22:48:05'),
(68, 68, 10, 1, '2023-07-20 22:52:07', '2023-07-20 22:52:07'),
(69, 69, 10, 1, '2023-07-20 22:55:54', '2023-07-20 22:55:54'),
(70, 70, 10, 1, '2023-07-20 22:59:39', '2023-07-20 22:59:39'),
(71, 71, 10, 1, '2023-07-20 23:47:19', '2023-07-20 23:47:19'),
(72, 72, 10, 1, '2023-07-20 23:56:18', '2023-07-20 23:56:18'),
(73, 73, 10, 1, '2023-07-21 00:01:56', '2023-07-21 00:01:56'),
(74, 74, 10, 1, '2023-07-21 00:03:47', '2023-07-21 00:03:47'),
(75, 75, 10, 1, '2023-07-21 00:05:19', '2023-07-21 00:05:19'),
(76, 76, 10, 1, '2023-07-21 00:07:05', '2023-07-21 00:07:05'),
(77, 77, 10, 1, '2023-07-21 00:09:18', '2023-07-21 00:09:18'),
(78, 78, 10, 1, '2023-07-21 00:10:37', '2023-07-21 00:10:37'),
(79, 79, 10, 1, '2023-07-21 00:11:16', '2023-07-21 00:11:16'),
(80, 80, 10, 1, '2023-07-21 00:11:41', '2023-07-21 00:11:41');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role_name` varchar(50) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Estudiante', 1, '2023-06-06 23:15:41', '2023-06-07 17:10:42'),
(2, 'Administrador', 1, '2023-06-07 17:07:06', '2023-06-07 17:11:11');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `adress` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  `remember_token` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `first_name`, `last_name`, `adress`, `phone`, `email`, `status`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 2, 'Gerson', 'Salazar', 'Urb ejemplo 1', '79394606', 'ggerson@live.com.ar', 1, NULL, '$2y$10$Yiyp3Xy.WQcpGXmDVW5z1eN4ME.EvxCCrnaZkN1YCeS3BkT.l2IDO', NULL, '2023-06-06 23:26:00', '2023-06-06 23:35:04'),
(2, 1, 'Gerson', 'Salazar', 'Direccion 1', '121232132', 'ggerson777@gmail.com', 1, NULL, '$2y$10$Yiyp3Xy.WQcpGXmDVW5z1eN4ME.EvxCCrnaZkN1YCeS3BkT.l2IDO', NULL, '2023-07-06 20:37:29', '2023-07-06 20:38:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
