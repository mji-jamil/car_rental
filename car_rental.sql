-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 28, 2024 at 04:07 AM
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
-- Database: `car_rental`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `year_of_manufacture` year(4) NOT NULL,
  `car_type` enum('SUV','Sedan','Hatchback','Truck','Coupe') NOT NULL,
  `daily_rent_price` decimal(8,2) NOT NULL,
  `availability_status` tinyint(1) NOT NULL DEFAULT 1,
  `car_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`id`, `name`, `brand`, `model`, `year_of_manufacture`, `car_type`, `daily_rent_price`, `availability_status`, `car_image`, `created_at`, `updated_at`) VALUES
(1, 'EcoSport', 'Ford', 'EcoSport', '2020', 'SUV', 50.00, 0, 'https://shorturl.at/rXX4p', '2024-09-27 18:34:40', '2024-09-27 19:57:19'),
(2, 'Camry', 'Toyota', 'Camry', '2021', 'Sedan', 65.00, 0, 'https://shorturl.at/rXX4p', '2024-09-27 18:34:40', '2024-09-27 15:00:55'),
(3, 'Civic', 'Honda', 'Civic', '2019', 'Sedan', 55.00, 0, 'https://shorturl.at/rXX4p', '2024-09-27 18:34:40', '2024-09-27 18:34:40'),
(4, 'Q5', 'Audi', 'Q5', '2022', 'SUV', 80.00, 0, 'https://shorturl.at/rXX4p', '2024-09-27 18:34:40', '2024-09-27 19:03:53'),
(5, 'Model 3', 'Tesla', 'Model 3', '2022', 'Sedan', 90.00, 1, 'https://shorturl.at/rXX4p', '2024-09-27 18:34:40', '2024-09-27 18:34:40'),
(6, 'Wrangler', 'Jeep', 'Wrangler', '2020', 'SUV', 70.00, 0, 'https://shorturl.at/rXX4p', '2024-09-27 18:34:40', '2024-09-27 18:34:40'),
(7, 'Fiesta', 'Ford', 'Fiesta', '2021', 'Hatchback', 45.00, 1, 'https://shorturl.at/rXX4p', '2024-09-27 18:34:40', '2024-09-27 18:34:40'),
(8, 'Altima', 'Nissan', 'Altima', '2022', 'Sedan', 60.00, 1, 'https://shorturl.at/rXX4p', '2024-09-27 18:34:40', '2024-09-27 18:34:40'),
(12, 'Honda Civic', 'Honda', 'Civic', '2021', 'Sedan', 45.00, 1, 'https://shorturl.at/rXX4p', '2024-09-27 19:32:09', '2024-09-27 19:32:09'),
(13, 'Toyota RAV4', 'Toyota', 'RAV4', '2020', 'SUV', 60.00, 1, 'https://shorturl.at/rXX4p', '2024-09-27 19:32:09', '2024-09-27 19:32:09'),
(14, 'Ford F-150', 'Ford', 'F-150', '2019', 'Truck', 75.00, 1, 'https://shorturl.at/rXX4p', '2024-09-27 19:32:09', '2024-09-27 19:32:09'),
(15, 'Chevrolet Malibu', 'Chevrolet', 'Malibu', '2022', 'Sedan', 50.00, 1, 'https://shorturl.at/rXX4p', '2024-09-27 19:32:09', '2024-09-27 19:32:09'),
(16, 'Mazda CX-5', 'Mazda', 'CX-5', '2023', 'SUV', 66.00, 1, 'https://shorturl.at/rXX4p', '2024-09-27 19:32:09', '2024-09-27 19:56:10');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000001_create_cache_table', 1),
(2, '2024_09_27_153604_create_users_table', 1),
(3, '2024_09_27_155143_create_sessions_table', 1),
(4, '2024_09_27_173718_create_cars_table', 2),
(5, '2024_09_27_173943_create_rentals_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `rentals`
--

CREATE TABLE `rentals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `car_id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `rental_start_date` date NOT NULL,
  `rental_end_date` date NOT NULL,
  `total_cost` decimal(10,2) NOT NULL,
  `status` enum('Ongoing','Completed','Canceled') NOT NULL DEFAULT 'Ongoing',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rentals`
--

INSERT INTO `rentals` (`id`, `car_id`, `customer_id`, `rental_start_date`, `rental_end_date`, `total_cost`, `status`, `created_at`, `updated_at`) VALUES
(12, 2, 11, '2024-09-10', '2024-09-15', 200.00, 'Ongoing', '2024-09-27 18:43:01', '2024-09-27 18:43:01'),
(13, 3, 12, '2024-09-12', '2024-09-20', 300.00, 'Completed', '2024-09-27 18:43:01', '2024-09-27 18:43:01'),
(14, 1, 4, '2024-09-05', '2024-09-10', 180.00, 'Canceled', '2024-09-27 18:43:01', '2024-09-27 18:43:01'),
(16, 3, 6, '2024-09-18', '2024-09-28', 600.00, 'Ongoing', '2024-09-27 18:43:01', '2024-09-27 18:43:01'),
(17, 1, 7, '2024-09-21', '2024-09-26', 150.00, 'Completed', '2024-09-27 18:43:01', '2024-09-27 18:43:01'),
(18, 2, 8, '2024-09-24', '2024-09-30', 400.00, 'Ongoing', '2024-09-27 18:43:01', '2024-09-27 18:43:01'),
(19, 3, 9, '2024-09-27', '2024-10-02', 500.00, 'Ongoing', '2024-09-27 18:43:01', '2024-09-27 18:43:01'),
(20, 1, 10, '2024-09-29', '2024-10-05', 300.00, 'Completed', '2024-09-27 18:43:01', '2024-09-27 18:43:01');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
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
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('h0eBy6Jq8ghm8yK6BGVpNbneebLdgw0BfeZnnd9Y', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidWdDMEFCRGVPM2lLNnNnb0I2M1Z0RGVoQndRellZSUhjMDU3NkVYcyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1727488655);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','customer') NOT NULL DEFAULT 'customer',
  `mobile` varchar(50) NOT NULL,
  `otp` varchar(10) NOT NULL,
  `address` varchar(500) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `mobile`, `otp`, `address`, `created_at`, `updated_at`) VALUES
(1, 'Jamil', 'jamil@email.com', '12345678', 'admin', '015454545', '0', 'Joypurhat', '2024-09-27 10:34:24', '2024-09-27 17:21:05'),
(4, 'jaghjf', 'jhajf@email.com', 'ajfw24w654', 'customer', '017772058', '0', 'dhaka', '2024-09-27 11:59:44', '2024-09-27 12:16:58'),
(5, 'John Doe', 'john.doe@example.com', 'password123', 'customer', '555-1234', '', '123 Elm St, Springfield, IL', '2024-09-27 18:37:50', '2024-09-27 18:37:50'),
(6, 'Jane Smith', 'jane.smith@example.com', 'password456', 'customer', '555-5678', '', '456 Oak St, Springfield, IL', '2024-09-27 18:37:50', '2024-09-27 18:37:50'),
(7, 'Alice Johnson', 'alice.johnson@example.com', 'password789', 'customer', '555-8765', '', '789 Maple St, Springfield, IL', '2024-09-27 18:37:50', '2024-09-27 18:37:50'),
(8, 'Bob Brown', 'bob.brown@example.com', 'password321', 'customer', '555-4321', '', '321 Pine St, Springfield, IL', '2024-09-27 18:37:50', '2024-09-27 18:37:50'),
(9, 'Charlie Black', 'charlie.black@example.com', 'password654', 'customer', '555-2468', '', '654 Cedar St, Springfield, IL', '2024-09-27 18:37:50', '2024-09-27 18:37:50'),
(10, 'Daisy White', 'daisy.white@example.com', 'password987', 'customer', '555-8642', '', '987 Birch St, Springfield, IL', '2024-09-27 18:37:50', '2024-09-27 18:37:50'),
(11, 'Edward Green', 'edward.green@example.com', 'password159', 'customer', '555-7531', '', '159 Walnut St, Springfield, IL', '2024-09-27 18:37:50', '2024-09-27 18:37:50'),
(12, 'Fiona Blue', 'fiona.blue@example.com', 'password753', 'customer', '555-1597', '', '753 Chestnut St, Springfield, IL', '2024-09-27 18:37:50', '2024-09-27 18:37:50'),
(13, 'George Gray', 'george.gray@example.com', 'password258', 'customer', '555-9513', '', '951 Willow St, Springfield, IL', '2024-09-27 18:37:50', '2024-09-27 18:37:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rentals`
--
ALTER TABLE `rentals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rentals_car_id_foreign` (`car_id`),
  ADD KEY `rentals_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

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
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `rentals`
--
ALTER TABLE `rentals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `rentals`
--
ALTER TABLE `rentals`
  ADD CONSTRAINT `rentals_car_id_foreign` FOREIGN KEY (`car_id`) REFERENCES `cars` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `rentals_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
