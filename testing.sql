-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 04, 2021 at 06:33 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `testing`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `email_verified_at`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Sridivya', 'Majeti', 'sridivyamajeti22@gmail.com', NULL, '$2y$10$p7aRDGeqaXuk7YCxPCToi.AVORSY1VNDY8KYg2WovUzwlHu25Bg9O', NULL, '2021-03-04 02:35:03'),
(2, 'Srividya', 'Majeti', 'majetisiri@gmail.com', NULL, '$2y$10$0Wxdqgu6kyOFe3U7JMs2t.ahrDnAblqCdQtqwzZVRI/27iREISqKa', '2021-03-03 01:22:13', '2021-03-03 01:22:13'),
(3, 'Bhanuprakash', 'Boga', 'bhanuprakash.boga@gmail.com', NULL, '$2y$10$6Hq8Zx9ufxOCtg2ifQzsduOSo2ReGuec0Cy3d6kXu9KW/S5lZ0nSa', '2021-03-03 01:27:00', '2021-03-04 00:16:51'),
(4, 'Krishna', 'Ayyagari', 'aksanudeep@gmail.com', NULL, '$2y$10$gDlZx9y9xwoA5W1DJNJpA.03pzBNkNkWaqNmcB7twQWpHvyN88fry', '2021-03-03 03:06:28', '2021-03-03 06:27:15'),
(5, 'Swetha', 'Gutti', 'himaswetha234@gmail.com', NULL, '$2y$10$L0JLjtsG1A54F8EcL8EU2esbjpo.X7t6oz6tjSUSdpgb0QxHpPD5G', '2021-03-03 05:44:35', '2021-03-04 02:40:14'),
(6, 'Dinesh', 'Paladhi', 'dinesh@yahoo.com', NULL, '$2y$10$lCocCI6nQP0vmgl5VwoC0..qruuMD15V2VU1i39MQA6CLoeoywo5G', '2021-03-03 08:40:40', '2021-03-03 08:52:55'),
(7, 'Ishwarya', 'Choday', 'ish@gmail.com', NULL, '$2y$10$pNMHA78EJy1sXQ2VuN4cUeVG5IaJxgTI8gvjLaVVQ0z3hJX.oQS3G', '2021-03-03 08:54:34', '2021-03-04 08:39:01'),
(8, 'Bhanumathi', 'Majeti', 'bhanumathimajeti@gmail.com', NULL, '$2y$10$WRlTDcOL.bth6veSfmIcH..61AlKbyR01sM9gf.Rqae9dg7ns.N9S', '2021-03-03 09:00:00', '2021-03-03 09:00:00'),
(9, 'Saibabu', 'Majeti', 'saibabumajeti@gmail.com', NULL, '$2y$10$caRRvj8hHgbskKMED1nE9uTMfXVrIUn0LqvWj/6igaggCECTLvLIC', '2021-03-03 09:04:01', '2021-03-03 09:04:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
