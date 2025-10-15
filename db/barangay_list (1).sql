-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 15, 2025 at 10:59 AM
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
-- Database: `osca_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `barangay_list`
--

CREATE TABLE `barangay_list` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `unit` int(11) NOT NULL,
  `barangay` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barangay_list`
--

INSERT INTO `barangay_list` (`id`, `unit`, `barangay`, `created_at`, `updated_at`) VALUES
(1, 1, 'Bagting', '2025-10-07 05:19:35', NULL),
(2, 1, 'Banonong', '2025-10-07 05:19:35', NULL),
(3, 1, 'Cawa-cawa', '2025-10-07 05:19:35', NULL),
(4, 1, 'Daro', '2025-10-07 05:19:35', NULL),
(5, 1, 'Dawo', '2025-10-07 05:19:35', NULL),
(6, 1, 'Kauswagan', '2025-10-07 05:19:35', NULL),
(7, 1, 'Linabo', '2025-10-07 05:19:35', NULL),
(8, 1, 'Ma. Cristina', '2025-10-07 05:19:35', NULL),
(9, 1, 'Potol', '2025-10-07 05:19:35', NULL),
(10, 1, 'Sinonoc', '2025-10-07 05:19:35', NULL),
(11, 1, 'Sta. Cruz', '2025-10-07 05:19:35', NULL),
(12, 2, 'Banbanan', '2025-10-07 05:19:35', NULL),
(13, 2, 'Baylimango', '2025-10-07 05:19:35', NULL),
(14, 2, 'Canlucani', '2025-10-07 05:19:35', NULL),
(15, 2, 'Carang', '2025-10-07 05:19:35', NULL),
(16, 2, 'Guimputlan', '2025-10-07 05:19:35', NULL),
(17, 2, 'Napo', '2025-10-07 05:19:35', NULL),
(18, 2, 'Oro', '2025-10-07 05:19:35', NULL),
(19, 2, 'Selinog', '2025-10-07 05:19:35', NULL),
(20, 2, 'Sto. Niño', '2025-10-07 05:19:35', NULL),
(21, 2, 'Taguilon', '2025-10-07 05:19:35', NULL),
(22, 2, 'Talisay', '2025-10-07 05:19:35', NULL),
(23, 3, 'Aliguay', '2025-10-07 05:19:35', NULL),
(24, 3, 'Antipolo', '2025-10-07 05:19:35', NULL),
(25, 3, 'Larayan', '2025-10-07 05:19:35', NULL),
(26, 3, 'Liyang', '2025-10-07 05:19:35', NULL),
(27, 3, 'Owaon', '2025-10-07 05:19:35', NULL),
(28, 3, 'Polo', '2025-10-07 05:19:35', NULL),
(29, 3, 'San Pedro', '2025-10-07 05:19:35', NULL),
(30, 3, 'San Vicente', '2025-10-07 05:19:35', NULL),
(31, 3, 'Sicayab Bucana', '2025-10-07 05:19:35', NULL),
(32, 4, 'Burgos', '2025-10-07 05:19:35', NULL),
(33, 4, 'Diwa-an', '2025-10-07 05:19:35', NULL),
(34, 4, 'Hilltop', '2025-10-07 05:19:35', NULL),
(35, 4, 'Ilaya', '2025-10-07 05:19:35', NULL),
(36, 4, 'Ma. Uray', '2025-10-07 05:19:35', NULL),
(37, 4, 'Oyan', '2025-10-07 05:19:35', NULL),
(38, 4, 'Sulangon', '2025-10-07 05:19:35', NULL),
(39, 4, 'Tamion', '2025-10-07 05:19:35', NULL),
(40, 5, 'Asaniero', '2025-10-07 05:19:35', NULL),
(41, 5, 'Ba-ao', '2025-10-07 05:19:35', NULL),
(42, 5, 'Barcelona', '2025-10-07 05:19:35', NULL),
(43, 5, 'Dampalan', '2025-10-07 05:19:35', NULL),
(44, 5, 'Masidlakon', '2025-10-07 05:19:35', NULL),
(45, 5, 'Opao', '2025-10-07 05:19:35', NULL),
(46, 5, 'Potungan', '2025-10-07 05:19:35', NULL),
(47, 5, 'San Francisco', '2025-10-07 05:19:35', NULL),
(48, 5, 'San Nicolas', '2025-10-07 05:19:35', NULL),
(49, 5, 'Sigayan', '2025-10-07 05:19:35', NULL),
(50, 2, 'Tag-ulo', '2025-10-07 05:21:51', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barangay_list`
--
ALTER TABLE `barangay_list`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barangay_list`
--
ALTER TABLE `barangay_list`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
