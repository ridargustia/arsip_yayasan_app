-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2022 at 04:18 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eduarsip_master`
--

-- --------------------------------------------------------

--
-- Table structure for table `arsip`
--

CREATE TABLE `arsip` (
  `id_arsip` int(11) NOT NULL,
  `arsip_name` mediumtext NOT NULL,
  `no_arsip` varchar(50) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `gdrive_last_folder_name_target` varchar(255) DEFAULT NULL,
  `instansi_id` int(11) NOT NULL,
  `cabang_id` int(11) NOT NULL,
  `divisi_id` int(11) NOT NULL,
  `rak_id` int(11) NOT NULL,
  `baris_id` int(11) NOT NULL,
  `lokasi_id` int(11) NOT NULL DEFAULT 0,
  `box_id` int(11) NOT NULL,
  `map_id` int(11) NOT NULL,
  `deskripsi_arsip` mediumtext NOT NULL,
  `keterangan` mediumtext DEFAULT NULL,
  `masa_retensi` date DEFAULT NULL,
  `status_retensi` tinyint(1) NOT NULL DEFAULT 1,
  `link_gdrive` mediumtext DEFAULT NULL,
  `status_file` tinyint(1) NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_available` int(11) NOT NULL DEFAULT 0,
  `created_by` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_by` varchar(50) NOT NULL,
  `modified_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `is_delete` tinyint(1) NOT NULL DEFAULT 0,
  `deleted_by` varchar(50) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `arsip_files`
--

CREATE TABLE `arsip_files` (
  `id` int(11) NOT NULL,
  `arsip_id` int(11) NOT NULL,
  `file_upload` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `arsip_jenis`
--

CREATE TABLE `arsip_jenis` (
  `id_arsip_jenis` int(11) NOT NULL,
  `arsip_id` int(11) NOT NULL,
  `jenis_arsip_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `baris`
--

CREATE TABLE `baris` (
  `id_baris` int(11) NOT NULL,
  `baris_name` varchar(50) NOT NULL,
  `instansi_id` int(11) NOT NULL,
  `cabang_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(50) NOT NULL,
  `modified_by` varchar(50) NOT NULL,
  `modified_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `is_delete_baris` tinyint(1) NOT NULL DEFAULT 0,
  `deleted_by` varchar(50) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `box`
--

CREATE TABLE `box` (
  `id_box` int(11) NOT NULL,
  `box_name` varchar(100) NOT NULL,
  `instansi_id` int(11) NOT NULL,
  `cabang_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(50) NOT NULL,
  `modified_by` varchar(50) NOT NULL,
  `modified_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `is_delete_box` tinyint(1) NOT NULL DEFAULT 0,
  `deleted_by` varchar(50) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `cabang`
--

CREATE TABLE `cabang` (
  `id_cabang` int(11) NOT NULL,
  `cabang_name` varchar(250) DEFAULT NULL,
  `instansi_id` int(11) DEFAULT NULL,
  `created_by` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_by` varchar(50) NOT NULL,
  `modified_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `is_delete_cabang` tinyint(1) NOT NULL DEFAULT 0,
  `deleted_by` varchar(50) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cabang`
--

INSERT INTO `cabang` (`id_cabang`, `cabang_name`, `instansi_id`, `created_by`, `created_at`, `modified_by`, `modified_at`, `is_delete_cabang`, `deleted_by`, `deleted_at`) VALUES
(49, 'YOGYAKARTA', 9, 'jondhy2021', '2021-02-23 21:02:30', '', NULL, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id_company` int(11) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `company_desc` mediumtext NOT NULL,
  `company_address` mediumtext NOT NULL,
  `company_maps` mediumtext NOT NULL,
  `company_phone` varchar(50) NOT NULL,
  `company_phone2` varchar(50) NOT NULL,
  `company_fax` varchar(50) NOT NULL,
  `company_email` varchar(100) NOT NULL,
  `company_gmail` varchar(50) NOT NULL,
  `company_photo` mediumtext NOT NULL,
  `company_photo_thumb` mediumtext NOT NULL,
  `created_by` char(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_by` char(50) NOT NULL,
  `modified_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id_company`, `company_name`, `company_desc`, `company_address`, `company_maps`, `company_phone`, `company_phone2`, `company_fax`, `company_email`, `company_gmail`, `company_photo`, `company_photo_thumb`, `created_by`, `created_at`, `modified_by`, `modified_at`) VALUES
(1, 'EduArsip', '<p>EduArsip adalah Perusahaan yang bergerak dibidang pengelolaan arsip di Indonesia</p>', 'Graha PBMT Indonesia Lantai 2, Jl. Ring Road Bar. No.66, Baturan, Trihanggo, Kec. Gamping, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55291', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63248.79889074844!2d110.31197864161997!3d-7.7845311706327145!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a58865904a943%3A0xa0c11184a57f1f85!2sGraha%20PBMT%20Perhimpunan%20BMT%20Indonesia!5e0!3m2!1sen!2sid!4v1595374788862!5m2!1sen!2sid\" width=\"600\" height=\"450\" frameborder=\"0\" style=\"border:0;\" allowfullscreen=\"\" aria-hidden=\"false\" tabindex=\"0\"></iframe>\r\n', '08976843114', '081262215939', '-', 'info@eduarsip.id', 'joneduarsip@gmail.com', 'eduarsip20210116163119.png', 'eduarsip20210116163119_thumb.png', '', '2017-11-09 06:45:34', '', '2021-03-31 14:04:49');

-- --------------------------------------------------------

--
-- Table structure for table `data_access`
--

CREATE TABLE `data_access` (
  `id_data_access` int(11) NOT NULL,
  `data_access_name` varchar(50) NOT NULL,
  `color` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_access`
--

INSERT INTO `data_access` (`id_data_access`, `data_access_name`, `color`) VALUES
(1, 'Read', 'primary'),
(2, 'Create', 'info'),
(3, 'Update', 'warning'),
(4, 'Delete', 'danger'),
(5, 'Restore', 'success');

-- --------------------------------------------------------

--
-- Table structure for table `divisi`
--

CREATE TABLE `divisi` (
  `id_divisi` int(11) NOT NULL,
  `divisi_name` varchar(100) NOT NULL,
  `divisi_slug` varchar(100) NOT NULL,
  `instansi_id` int(11) NOT NULL,
  `cabang_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(50) NOT NULL,
  `modified_by` varchar(50) NOT NULL,
  `modified_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `is_delete_divisi` tinyint(1) NOT NULL DEFAULT 0,
  `deleted_by` varchar(50) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `divisi`
--

INSERT INTO `divisi` (`id_divisi`, `divisi_name`, `divisi_slug`, `instansi_id`, `cabang_id`, `created_at`, `created_by`, `modified_by`, `modified_at`, `is_delete_divisi`, `deleted_by`, `deleted_at`) VALUES
(37, 'IT', 'it', 9, 49, '2021-02-24 06:16:07', 'masteradminnurma', '', '2021-06-11 10:46:44', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `footer`
--

CREATE TABLE `footer` (
  `id_footer` int(11) NOT NULL,
  `content` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `footer`
--

INSERT INTO `footer` (`id_footer`, `content`) VALUES
(1, 'Copyright©2022EduArsip');

-- --------------------------------------------------------

--
-- Table structure for table `instansi`
--

CREATE TABLE `instansi` (
  `id_instansi` int(11) NOT NULL,
  `instansi_name` varchar(250) NOT NULL,
  `instansi_address` mediumtext NOT NULL,
  `instansi_phone` varchar(20) NOT NULL,
  `instansi_img` mediumtext NOT NULL,
  `instansi_img_thumb` mediumtext NOT NULL,
  `is_active` int(11) DEFAULT NULL,
  `active_date` date DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(50) NOT NULL,
  `modified_by` varchar(50) NOT NULL,
  `modified_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `is_delete_instansi` tinyint(1) NOT NULL DEFAULT 0,
  `deleted_by` varchar(50) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `instansi`
--

INSERT INTO `instansi` (`id_instansi`, `instansi_name`, `instansi_address`, `instansi_phone`, `instansi_img`, `instansi_img_thumb`, `is_active`, `active_date`, `created_at`, `created_by`, `modified_by`, `modified_at`, `is_delete_instansi`, `deleted_by`, `deleted_at`) VALUES
(9, 'EduArsip', 'Jl. Ring Road Barat. No.66, Baturan, Trihanggo, Kec. Gamping, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55291', '081262215939', 'eduarsip20210223210201.jpg', 'eduarsip20210223210201_thumb.jpg', 1, '2090-02-23', '2021-02-23 21:02:01', 'jondhy2021', 'ridarmaster', '2021-07-08 10:28:41', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jenis_arsip`
--

CREATE TABLE `jenis_arsip` (
  `id_jenis` int(11) NOT NULL,
  `jenis_name` varchar(100) NOT NULL,
  `jenis_slug` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(50) NOT NULL,
  `modified_by` varchar(50) NOT NULL,
  `modified_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `is_delete_jenis` tinyint(1) NOT NULL DEFAULT 0,
  `deleted_by` varchar(50) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jenis_arsip`
--

INSERT INTO `jenis_arsip` (`id_jenis`, `jenis_name`, `jenis_slug`, `created_at`, `created_by`, `modified_by`, `modified_at`, `is_delete_jenis`, `deleted_by`, `deleted_at`) VALUES
(1, 'Audio', 'audio', '2020-01-09 06:50:15', '', '', '2020-03-08 21:11:01', 0, NULL, NULL),
(2, 'Video', 'video', '2020-01-09 06:50:15', '', '', '2020-03-08 21:11:01', 0, NULL, NULL),
(3, 'Gambar', 'gambar', '2020-01-09 06:50:15', '', '', '2020-03-08 21:11:01', 0, NULL, NULL),
(4, 'Text (file)', 'text-file', '2020-01-09 06:50:15', '', '', '2020-03-08 21:11:01', 0, NULL, NULL),
(5, 'Multy', 'multy', '2020-03-28 13:03:48', '', '', NULL, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(10) UNSIGNED NOT NULL,
  `ip_address` varchar(50) NOT NULL,
  `username` varchar(100) NOT NULL,
  `time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `log_queries`
--

CREATE TABLE `log_queries` (
  `id` int(11) NOT NULL,
  `content` mediumtext NOT NULL,
  `created_by` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `ip_address` varchar(15) NOT NULL,
  `user_agent` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `lokasi`
--

CREATE TABLE `lokasi` (
  `id_lokasi` int(11) NOT NULL,
  `lokasi_name` varchar(100) NOT NULL,
  `instansi_id` int(11) NOT NULL,
  `cabang_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(50) NOT NULL,
  `modified_by` varchar(50) NOT NULL,
  `modified_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `is_delete_lokasi` tinyint(1) NOT NULL DEFAULT 0,
  `deleted_by` varchar(50) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `map`
--

CREATE TABLE `map` (
  `id_map` int(11) NOT NULL,
  `map_name` varchar(100) NOT NULL,
  `instansi_id` int(11) NOT NULL,
  `cabang_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(50) NOT NULL,
  `modified_by` varchar(50) NOT NULL,
  `modified_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `is_delete_map` tinyint(1) NOT NULL DEFAULT 0,
  `deleted_by` varchar(50) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL,
  `menu_name` varchar(100) NOT NULL,
  `menu_controller` varchar(100) NOT NULL,
  `menu_function` varchar(100) NOT NULL,
  `menu_icon` varchar(50) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `order_no` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id_menu`, `menu_name`, `menu_controller`, `menu_function`, `menu_icon`, `is_active`, `order_no`) VALUES
(5, 'PEMINJAMAN', 'peminjaman', '#', 'fa-edit', 1, 1),
(6, 'PENGEMBALIAN', 'pengembalian', '#', 'fa-edit', 1, 2),
(7, 'ARSIP', 'arsip', '#', 'fa-archive', 1, 3),
(8, 'RAK', 'rak', '#', 'fa-building', 1, 4),
(9, 'BARIS', 'baris', '#', 'fa-bookmark', 1, 5),
(10, 'LAPORAN', 'laporan', '#', 'fa-file', 1, 8),
(11, 'BOX', 'box', '#', 'fa-inbox', 1, 6),
(12, 'MAP', 'map', '#', 'fa-book', 1, 7),
(13, 'DIVISI', 'divisi', '#', 'fa-map-signs', 1, 12),
(14, 'INSTANSI', 'instansi', '#', 'fa-arrows', 1, 10),
(15, 'LOKASI ARSIP', 'lokasi', '#', 'fa-map-pin', 1, 9),
(16, 'CABANG', 'cabang', '#', 'fa-map-signs', 1, 11);

-- --------------------------------------------------------

--
-- Table structure for table `menu_access`
--

CREATE TABLE `menu_access` (
  `id_menu_access` int(11) NOT NULL,
  `usertype_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `submenu_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu_access`
--

INSERT INTO `menu_access` (`id_menu_access`, `usertype_id`, `menu_id`, `submenu_id`) VALUES
(1, 1, 5, 7),
(2, 1, 5, 9),
(4, 1, 10, 18),
(5, 1, 10, 19),
(6, 1, 7, 13),
(7, 1, 7, 12),
(8, 1, 9, 17),
(9, 1, 9, 16),
(10, 1, 8, 15),
(11, 1, 8, 14),
(12, 1, 6, 11),
(13, 1, 6, 10),
(18, 1, 7, 20),
(19, 1, 5, 21),
(20, 1, 6, 22),
(21, 1, 9, 23),
(22, 1, 8, 24),
(26, 2, 7, 13),
(27, 2, 7, 20),
(28, 2, 7, 12),
(29, 2, 9, 17),
(30, 2, 9, 23),
(31, 2, 9, 16),
(32, 2, 8, 15),
(33, 2, 8, 14),
(34, 2, 8, 24),
(35, 2, 5, 9),
(36, 2, 5, 21),
(37, 2, 5, 7),
(38, 2, 6, 11),
(39, 2, 6, 22),
(40, 2, 6, 10),
(41, 1, 12, 28),
(42, 1, 12, 27),
(43, 1, 11, 26),
(44, 1, 11, 25),
(45, 2, 11, 26),
(46, 2, 11, 25),
(47, 2, 12, 28),
(48, 2, 12, 27),
(80, 1, 13, 30),
(81, 1, 13, 29),
(89, 3, 7, 13),
(90, 3, 7, 20),
(91, 3, 7, 12),
(92, 3, 5, 9),
(93, 3, 5, 21),
(94, 3, 5, 7),
(95, 3, 6, 11),
(96, 3, 6, 22),
(97, 3, 6, 10),
(98, 2, 13, 30),
(99, 2, 13, 29),
(100, 1, 13, 33),
(101, 2, 13, 33),
(102, 1, 11, 34),
(103, 1, 12, 35),
(105, 2, 11, 34),
(107, 2, 12, 35),
(108, 2, 10, 18),
(109, 2, 10, 19),
(110, 5, 7, 13),
(111, 5, 7, 20),
(112, 5, 7, 12),
(113, 5, 9, 17),
(114, 5, 9, 23),
(115, 5, 9, 16),
(116, 5, 11, 26),
(117, 5, 11, 34),
(118, 5, 11, 25),
(119, 5, 13, 30),
(120, 5, 13, 33),
(121, 5, 13, 29),
(122, 5, 14, 32),
(123, 5, 14, 36),
(124, 5, 14, 31),
(125, 5, 10, 18),
(126, 5, 10, 19),
(127, 5, 12, 28),
(128, 5, 12, 35),
(129, 5, 12, 27),
(130, 5, 5, 9),
(131, 5, 5, 21),
(132, 5, 5, 7),
(133, 5, 6, 11),
(134, 5, 6, 22),
(135, 5, 6, 10),
(136, 5, 8, 15),
(137, 5, 8, 24),
(138, 5, 8, 14),
(139, 5, 16, 38),
(140, 5, 16, 37),
(141, 5, 15, 40),
(142, 5, 15, 39),
(143, 5, 15, 42),
(144, 5, 16, 41),
(148, 1, 15, 40),
(149, 1, 15, 42),
(150, 1, 15, 39),
(151, 5, 7, 43),
(152, 5, 7, 44),
(153, 1, 7, 43),
(154, 1, 7, 44),
(155, 2, 7, 43),
(156, 2, 7, 44),
(157, 3, 7, 44),
(158, 3, 7, 43),
(161, 5, 10, 45),
(165, 1, 10, 45),
(169, 2, 10, 45),
(171, 2, 15, 40),
(172, 2, 15, 42),
(173, 2, 15, 39),
(174, 3, 10, 45),
(175, 3, 10, 18),
(176, 3, 10, 19);

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_peminjaman` int(11) NOT NULL,
  `tgl_peminjaman` date NOT NULL,
  `tgl_kembali` date NOT NULL,
  `arsip_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `instansi_id` int(11) NOT NULL,
  `cabang_id` int(11) NOT NULL,
  `divisi_id` int(11) NOT NULL,
  `is_kembali` tinyint(1) DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(50) NOT NULL,
  `modified_by` varchar(50) NOT NULL,
  `modified_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `is_delete_peminjaman` tinyint(1) NOT NULL DEFAULT 0,
  `deleted_by` varchar(50) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pengembalian`
--

CREATE TABLE `pengembalian` (
  `id_pengembalian` int(11) NOT NULL,
  `tgl_kembali` date NOT NULL,
  `peminjaman_id` int(11) NOT NULL,
  `arsip_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `instansi_id` int(11) NOT NULL,
  `cabang_id` int(11) NOT NULL,
  `divisi_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(50) NOT NULL,
  `modified_by` varchar(50) NOT NULL,
  `modified_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `is_delete_pengembalian` tinyint(1) NOT NULL DEFAULT 0,
  `deleted_by` varchar(50) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `rak`
--

CREATE TABLE `rak` (
  `id_rak` int(11) NOT NULL,
  `rak_name` varchar(50) NOT NULL,
  `instansi_id` int(11) NOT NULL,
  `cabang_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(50) NOT NULL,
  `modified_by` varchar(50) NOT NULL,
  `modified_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `is_delete_rak` tinyint(1) NOT NULL DEFAULT 0,
  `deleted_by` varchar(50) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `submenu`
--

CREATE TABLE `submenu` (
  `id_submenu` int(11) NOT NULL,
  `submenu_name` varchar(100) NOT NULL,
  `submenu_function` varchar(100) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `order_no` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `submenu`
--

INSERT INTO `submenu` (`id_submenu`, `submenu_name`, `submenu_function`, `menu_id`, `order_no`) VALUES
(7, 'Tambah Peminjaman', 'create', 5, 1),
(9, 'Data Peminjaman', 'index', 5, 2),
(10, 'Tambah Pengembalian', 'create', 6, 1),
(11, 'Data Pengembalian', 'index', 6, 2),
(12, 'Tambah Arsip', 'create', 7, 1),
(13, 'Data Arsip', 'index', 7, 2),
(14, 'Tambah Rak', 'create', 8, 1),
(15, 'Data Rak', 'index', 8, 2),
(16, 'Tambah Baris', 'create', 9, 1),
(17, 'Data Baris', 'index', 9, 2),
(18, 'Laporan Peminjaman', 'peminjaman', 10, 1),
(19, 'Laporan Pengembalian', 'pengembalian', 10, 2),
(20, 'Recycle Bin', 'deleted_list', 7, 5),
(21, 'Recycle Bin', 'deleted_list', 5, 3),
(22, 'Recycle Bin', 'deleted_list', 6, 3),
(23, 'Recycle Bin', 'deleted_list', 9, 3),
(24, 'Recycle Bin', 'deleted_list', 8, 3),
(25, 'Tambah Box', 'create', 11, 1),
(26, 'Data Box', 'index', 11, 2),
(27, 'Tambah Map', 'create', 12, 1),
(28, 'Data Map', 'index', 12, 2),
(29, 'Tambah Divisi', 'create', 13, 1),
(30, 'Data Divisi', 'index', 13, 2),
(31, 'Tambah Instansi', 'create', 14, 1),
(32, 'Data Instansi', 'index', 14, 2),
(33, 'Recycle Bin', 'deleted_list', 13, 3),
(34, 'Recycle Bin', 'deleted_list', 11, 3),
(35, 'Recycle Bin', 'deleted_list', 12, 3),
(36, 'Recycle Bin', 'deleted_list', 14, 3),
(37, 'Tambah Cabang', 'create', 16, 1),
(38, 'Data Cabang', 'index', 16, 2),
(39, 'Tambah Lokasi Arsip', 'create', 15, 1),
(40, 'Data Lokasi Arsip', 'index', 15, 2),
(41, 'Recycle Bin', 'deleted_list', 16, 3),
(42, 'Recycle Bin', 'deleted_list', 15, 3),
(43, 'Data Arsip Aktif', 'aktif', 7, 3),
(44, 'Data Arsip InAktif', 'inaktif', 7, 4),
(45, 'Laporan Arsip', 'arsip', 10, 3);

-- --------------------------------------------------------

--
-- Table structure for table `template`
--

CREATE TABLE `template` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `value` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `template`
--

INSERT INTO `template` (`id`, `name`, `value`) VALUES
(1, 'Layout', 'fixed'),
(2, 'Skins', 'skin-blue-light');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_users` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `instansi_id` int(11) NOT NULL,
  `cabang_id` int(11) NOT NULL,
  `divisi_id` int(11) NOT NULL,
  `birthdate` varchar(100) NOT NULL,
  `birthplace` varchar(100) NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `address` mediumtext NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(200) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `usertype_id` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `photo` mediumtext NOT NULL,
  `photo_thumb` mediumtext NOT NULL,
  `ip_add_reg` varchar(50) NOT NULL,
  `code_activation` varchar(50) DEFAULT NULL,
  `code_forgotten` varchar(50) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `created_by` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_by` varchar(50) NOT NULL,
  `modified_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `is_delete` tinyint(1) NOT NULL DEFAULT 0,
  `deleted_by` varchar(50) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_users`, `name`, `instansi_id`, `cabang_id`, `divisi_id`, `birthdate`, `birthplace`, `gender`, `address`, `phone`, `email`, `username`, `password`, `usertype_id`, `is_active`, `photo`, `photo_thumb`, `ip_add_reg`, `code_activation`, `code_forgotten`, `last_login`, `created_by`, `created_at`, `modified_by`, `modified_at`, `is_delete`, `deleted_by`, `deleted_at`) VALUES
(47, 'Ridar Gustia Priatama', 9, 49, 37, '06/05/1996', 'Kediri', 1, 'Ketandan Wetan, Imogiri, Imogiri, Bantul, Yogyakarta', '089697641301', 'ridargp@gmail.com', 'ridargustia', '$2y$10$4I3stx.RBQV3ubvKj8ihK./Tv/AD3Ov0k9uCSTQOI3/ODR0M2MVDu', 5, 1, 'ridargustia20210313121228.jpg', 'ridargustia20210313121228_thumb.jpg', '36.72.217.68', NULL, 'mpDQlCnByIWX2bXX11FJf65IskFuAoZZ4fWHzSmf1FmzcQ43Cr', '2022-06-02 22:11:56', 'jondhy', '2021-03-13 12:12:28', 'ridargustia', '2022-06-02 22:11:56', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users_data_access`
--

CREATE TABLE `users_data_access` (
  `id_users_data_access` int(11) NOT NULL,
  `data_access_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users_data_access`
--

INSERT INTO `users_data_access` (`id_users_data_access`, `data_access_id`, `user_id`) VALUES
(255, 1, 47),
(256, 2, 47),
(257, 3, 47),
(258, 4, 47),
(259, 5, 47);

-- --------------------------------------------------------

--
-- Table structure for table `usertype`
--

CREATE TABLE `usertype` (
  `id_usertype` int(11) NOT NULL,
  `usertype_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usertype`
--

INSERT INTO `usertype` (`id_usertype`, `usertype_name`) VALUES
(1, 'MasterAdmin'),
(2, 'SuperAdmin'),
(3, 'Administrator'),
(4, 'Pegawai'),
(5, 'GrandAdmin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `arsip`
--
ALTER TABLE `arsip`
  ADD PRIMARY KEY (`id_arsip`),
  ADD KEY `FK_arsip_instansi` (`instansi_id`),
  ADD KEY `FK_arsip_rak` (`rak_id`),
  ADD KEY `FK_arsip_baris` (`baris_id`),
  ADD KEY `FK_arsip_box` (`box_id`),
  ADD KEY `FK_arsip_map` (`map_id`),
  ADD KEY `FK_arsip_divisi` (`divisi_id`),
  ADD KEY `FK_arsip_users` (`user_id`),
  ADD KEY `FK_arsip_lokasi` (`lokasi_id`);

--
-- Indexes for table `arsip_files`
--
ALTER TABLE `arsip_files`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `FK_arsip_files_arsip` (`arsip_id`);

--
-- Indexes for table `arsip_jenis`
--
ALTER TABLE `arsip_jenis`
  ADD PRIMARY KEY (`id_arsip_jenis`),
  ADD KEY `FK_arsip_jenis_arsip` (`arsip_id`),
  ADD KEY `FK_arsip_jenis_jenis_arsip` (`jenis_arsip_id`);

--
-- Indexes for table `baris`
--
ALTER TABLE `baris`
  ADD PRIMARY KEY (`id_baris`),
  ADD KEY `FK_baris_instansi` (`instansi_id`),
  ADD KEY `FK_baris_cabang` (`cabang_id`);

--
-- Indexes for table `box`
--
ALTER TABLE `box`
  ADD PRIMARY KEY (`id_box`),
  ADD KEY `FK_box_instansi` (`instansi_id`),
  ADD KEY `FK_box_cabang` (`cabang_id`);

--
-- Indexes for table `cabang`
--
ALTER TABLE `cabang`
  ADD PRIMARY KEY (`id_cabang`),
  ADD KEY `cabang_FK` (`instansi_id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id_company`);

--
-- Indexes for table `data_access`
--
ALTER TABLE `data_access`
  ADD PRIMARY KEY (`id_data_access`);

--
-- Indexes for table `divisi`
--
ALTER TABLE `divisi`
  ADD PRIMARY KEY (`id_divisi`),
  ADD KEY `FK_divisi_instansi` (`instansi_id`),
  ADD KEY `FK_divisi_cabang` (`cabang_id`);

--
-- Indexes for table `footer`
--
ALTER TABLE `footer`
  ADD PRIMARY KEY (`id_footer`);

--
-- Indexes for table `instansi`
--
ALTER TABLE `instansi`
  ADD PRIMARY KEY (`id_instansi`);

--
-- Indexes for table `jenis_arsip`
--
ALTER TABLE `jenis_arsip`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_queries`
--
ALTER TABLE `log_queries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lokasi`
--
ALTER TABLE `lokasi`
  ADD PRIMARY KEY (`id_lokasi`),
  ADD KEY `FK_lokasi_instansi` (`instansi_id`),
  ADD KEY `FK_lokasi_cabang` (`cabang_id`);

--
-- Indexes for table `map`
--
ALTER TABLE `map`
  ADD PRIMARY KEY (`id_map`),
  ADD KEY `FK_map_instansi` (`instansi_id`),
  ADD KEY `FK_map_cabang` (`cabang_id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `menu_access`
--
ALTER TABLE `menu_access`
  ADD PRIMARY KEY (`id_menu_access`),
  ADD KEY `FK_menu_access_usertype` (`usertype_id`),
  ADD KEY `FK_menu_access_menu` (`menu_id`),
  ADD KEY `FK_menu_access_submenu` (`submenu_id`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`),
  ADD KEY `FK_peminjaman_arsip` (`arsip_id`),
  ADD KEY `FK_peminjaman_users` (`user_id`),
  ADD KEY `FK_peminjaman_divisi` (`divisi_id`),
  ADD KEY `FK_peminjaman_instansi` (`instansi_id`),
  ADD KEY `FK_peminjaman_cabang` (`cabang_id`);

--
-- Indexes for table `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD PRIMARY KEY (`id_pengembalian`),
  ADD KEY `FK_pengembalian_peminjaman` (`peminjaman_id`),
  ADD KEY `FK_pengembalian_arsip` (`arsip_id`),
  ADD KEY `FK_pengembalian_users` (`user_id`),
  ADD KEY `FK_pengembalian_divisi` (`divisi_id`),
  ADD KEY `FK_pengembalian_instansi` (`instansi_id`),
  ADD KEY `FK_pengembalian_cabang` (`cabang_id`);

--
-- Indexes for table `rak`
--
ALTER TABLE `rak`
  ADD PRIMARY KEY (`id_rak`),
  ADD KEY `FK_rak_instansi` (`instansi_id`),
  ADD KEY `FK_rak_cabang` (`cabang_id`);

--
-- Indexes for table `submenu`
--
ALTER TABLE `submenu`
  ADD PRIMARY KEY (`id_submenu`),
  ADD KEY `FK_submenu_menu` (`menu_id`);

--
-- Indexes for table `template`
--
ALTER TABLE `template`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`),
  ADD KEY `FK_users_usertype` (`usertype_id`) USING BTREE,
  ADD KEY `FK_users_instansi` (`instansi_id`) USING BTREE,
  ADD KEY `FK_users_divisi` (`divisi_id`) USING BTREE,
  ADD KEY `FK_users_cabang` (`cabang_id`);

--
-- Indexes for table `users_data_access`
--
ALTER TABLE `users_data_access`
  ADD PRIMARY KEY (`id_users_data_access`),
  ADD KEY `FK_users_data_access_users` (`user_id`);

--
-- Indexes for table `usertype`
--
ALTER TABLE `usertype`
  ADD PRIMARY KEY (`id_usertype`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `arsip`
--
ALTER TABLE `arsip`
  MODIFY `id_arsip` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11364;

--
-- AUTO_INCREMENT for table `arsip_files`
--
ALTER TABLE `arsip_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34708;

--
-- AUTO_INCREMENT for table `arsip_jenis`
--
ALTER TABLE `arsip_jenis`
  MODIFY `id_arsip_jenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22240;

--
-- AUTO_INCREMENT for table `baris`
--
ALTER TABLE `baris`
  MODIFY `id_baris` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=260;

--
-- AUTO_INCREMENT for table `box`
--
ALTER TABLE `box`
  MODIFY `id_box` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=808;

--
-- AUTO_INCREMENT for table `cabang`
--
ALTER TABLE `cabang`
  MODIFY `id_cabang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=160;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id_company` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `data_access`
--
ALTER TABLE `data_access`
  MODIFY `id_data_access` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `divisi`
--
ALTER TABLE `divisi`
  MODIFY `id_divisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=373;

--
-- AUTO_INCREMENT for table `footer`
--
ALTER TABLE `footer`
  MODIFY `id_footer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `instansi`
--
ALTER TABLE `instansi`
  MODIFY `id_instansi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `jenis_arsip`
--
ALTER TABLE `jenis_arsip`
  MODIFY `id_jenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=368;

--
-- AUTO_INCREMENT for table `log_queries`
--
ALTER TABLE `log_queries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52333;

--
-- AUTO_INCREMENT for table `lokasi`
--
ALTER TABLE `lokasi`
  MODIFY `id_lokasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=172;

--
-- AUTO_INCREMENT for table `map`
--
ALTER TABLE `map`
  MODIFY `id_map` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1860;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `menu_access`
--
ALTER TABLE `menu_access`
  MODIFY `id_menu_access` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=180;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_peminjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `pengembalian`
--
ALTER TABLE `pengembalian`
  MODIFY `id_pengembalian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `rak`
--
ALTER TABLE `rak`
  MODIFY `id_rak` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=291;

--
-- AUTO_INCREMENT for table `submenu`
--
ALTER TABLE `submenu`
  MODIFY `id_submenu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `template`
--
ALTER TABLE `template`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=398;

--
-- AUTO_INCREMENT for table `users_data_access`
--
ALTER TABLE `users_data_access`
  MODIFY `id_users_data_access` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2416;

--
-- AUTO_INCREMENT for table `usertype`
--
ALTER TABLE `usertype`
  MODIFY `id_usertype` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `arsip`
--
ALTER TABLE `arsip`
  ADD CONSTRAINT `FK_arsip_baris` FOREIGN KEY (`baris_id`) REFERENCES `baris` (`id_baris`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_arsip_box` FOREIGN KEY (`box_id`) REFERENCES `box` (`id_box`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_arsip_divisi` FOREIGN KEY (`divisi_id`) REFERENCES `divisi` (`id_divisi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_arsip_instansi` FOREIGN KEY (`instansi_id`) REFERENCES `instansi` (`id_instansi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_arsip_lokasi` FOREIGN KEY (`lokasi_id`) REFERENCES `lokasi` (`id_lokasi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_arsip_map` FOREIGN KEY (`map_id`) REFERENCES `map` (`id_map`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_arsip_rak` FOREIGN KEY (`rak_id`) REFERENCES `rak` (`id_rak`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_arsip_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_users`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `arsip_files`
--
ALTER TABLE `arsip_files`
  ADD CONSTRAINT `FK_arsip_files_arsip` FOREIGN KEY (`arsip_id`) REFERENCES `arsip` (`id_arsip`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `arsip_jenis`
--
ALTER TABLE `arsip_jenis`
  ADD CONSTRAINT `FK_arsip_jenis_arsip` FOREIGN KEY (`arsip_id`) REFERENCES `arsip` (`id_arsip`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_arsip_jenis_jenis_arsip` FOREIGN KEY (`jenis_arsip_id`) REFERENCES `jenis_arsip` (`id_jenis`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `baris`
--
ALTER TABLE `baris`
  ADD CONSTRAINT `FK_baris_cabang` FOREIGN KEY (`cabang_id`) REFERENCES `cabang` (`id_cabang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_baris_instansi` FOREIGN KEY (`instansi_id`) REFERENCES `instansi` (`id_instansi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `box`
--
ALTER TABLE `box`
  ADD CONSTRAINT `FK_box_cabang` FOREIGN KEY (`cabang_id`) REFERENCES `cabang` (`id_cabang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_box_instansi` FOREIGN KEY (`instansi_id`) REFERENCES `instansi` (`id_instansi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cabang`
--
ALTER TABLE `cabang`
  ADD CONSTRAINT `cabang_FK` FOREIGN KEY (`instansi_id`) REFERENCES `instansi` (`id_instansi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `divisi`
--
ALTER TABLE `divisi`
  ADD CONSTRAINT `FK_divisi_cabang` FOREIGN KEY (`cabang_id`) REFERENCES `cabang` (`id_cabang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_divisi_instansi` FOREIGN KEY (`instansi_id`) REFERENCES `instansi` (`id_instansi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lokasi`
--
ALTER TABLE `lokasi`
  ADD CONSTRAINT `FK_lokasi_cabang` FOREIGN KEY (`cabang_id`) REFERENCES `cabang` (`id_cabang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_lokasi_instansi` FOREIGN KEY (`instansi_id`) REFERENCES `instansi` (`id_instansi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `map`
--
ALTER TABLE `map`
  ADD CONSTRAINT `FK_map_cabang` FOREIGN KEY (`cabang_id`) REFERENCES `cabang` (`id_cabang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_map_instansi` FOREIGN KEY (`instansi_id`) REFERENCES `instansi` (`id_instansi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `menu_access`
--
ALTER TABLE `menu_access`
  ADD CONSTRAINT `FK_menu_access_menu` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id_menu`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_menu_access_submenu` FOREIGN KEY (`submenu_id`) REFERENCES `submenu` (`id_submenu`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_menu_access_usertype` FOREIGN KEY (`usertype_id`) REFERENCES `usertype` (`id_usertype`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `FK_peminjaman_arsip` FOREIGN KEY (`arsip_id`) REFERENCES `arsip` (`id_arsip`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_peminjaman_cabang` FOREIGN KEY (`cabang_id`) REFERENCES `cabang` (`id_cabang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_peminjaman_divisi` FOREIGN KEY (`divisi_id`) REFERENCES `divisi` (`id_divisi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_peminjaman_instansi` FOREIGN KEY (`instansi_id`) REFERENCES `instansi` (`id_instansi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_peminjaman_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_users`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD CONSTRAINT `FK_pengembalian_arsip` FOREIGN KEY (`arsip_id`) REFERENCES `arsip` (`id_arsip`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_pengembalian_cabang` FOREIGN KEY (`cabang_id`) REFERENCES `cabang` (`id_cabang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_pengembalian_divisi` FOREIGN KEY (`divisi_id`) REFERENCES `divisi` (`id_divisi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_pengembalian_instansi` FOREIGN KEY (`instansi_id`) REFERENCES `instansi` (`id_instansi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_pengembalian_peminjaman` FOREIGN KEY (`peminjaman_id`) REFERENCES `peminjaman` (`id_peminjaman`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_pengembalian_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_users`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rak`
--
ALTER TABLE `rak`
  ADD CONSTRAINT `FK_rak_cabang` FOREIGN KEY (`cabang_id`) REFERENCES `cabang` (`id_cabang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_rak_instansi` FOREIGN KEY (`instansi_id`) REFERENCES `instansi` (`id_instansi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `submenu`
--
ALTER TABLE `submenu`
  ADD CONSTRAINT `FK_submenu_menu` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id_menu`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_users_cabang` FOREIGN KEY (`cabang_id`) REFERENCES `cabang` (`id_cabang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_users_divisi` FOREIGN KEY (`divisi_id`) REFERENCES `divisi` (`id_divisi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_users_instansi` FOREIGN KEY (`instansi_id`) REFERENCES `instansi` (`id_instansi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_users_usertype` FOREIGN KEY (`usertype_id`) REFERENCES `usertype` (`id_usertype`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users_data_access`
--
ALTER TABLE `users_data_access`
  ADD CONSTRAINT `FK_users_data_access_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_users`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
