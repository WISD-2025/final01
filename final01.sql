-- Adminer 4.8.1 MySQL 5.7.11 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `cache`;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-b0257a835d1c38797dac8888dfbed3cf',	'i:1;',	1767882035),
('laravel-cache-b0257a835d1c38797dac8888dfbed3cf:timer',	'i:1767882035;',	1767882035),
('laravel-cache-d41e6a2d36d6dd05f6c19c8e8344ca4c',	'i:1;',	1767886257),
('laravel-cache-d41e6a2d36d6dd05f6c19c8e8344ca4c:timer',	'i:1767886257;',	1767886257),
('laravel-cache-dc44958e29ffba8b810d21377ae366b5',	'i:1;',	1767715330),
('laravel-cache-dc44958e29ffba8b810d21377ae366b5:timer',	'i:1767715330;',	1767715330),
('laravel-cache-e2340e5442da5c53dc1b01962105c094',	'i:1;',	1767892565),
('laravel-cache-e2340e5442da5c53dc1b01962105c094:timer',	'i:1767892565;',	1767892565);

DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1,	'漢堡',	NULL,	NULL),
(2,	'飲料',	NULL,	NULL);

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `meals`;
CREATE TABLE `meals` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `category_id` bigint(20) unsigned NOT NULL,
  `stock` int(11) NOT NULL DEFAULT '0',
  `image1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `meals` (`id`, `name`, `price`, `category_id`, `stock`, `image1`, `image2`, `created_at`, `updated_at`) VALUES
(1,	'牛肉堡',	60,	1,	2,	'meals/1767728058_牛肉堡.jpg',	NULL,	NULL,	'2026-01-08 12:11:45'),
(2,	'卡拉雞漢堡',	80,	1,	5,	'meals/1767728073_卡拉雞漢堡.jpg',	NULL,	NULL,	'2026-01-08 12:11:14'),
(3,	'紅茶',	20,	2,	2,	'meals/1767728323_紅茶.jpg',	NULL,	NULL,	'2026-01-08 12:10:23'),
(4,	'豆漿',	30,	2,	0,	'meals/1767728335_豆漿.jpg',	NULL,	NULL,	'2026-01-08 07:39:11'),
(5,	'鮪魚堡',	70,	1,	10,	'meals/1767728224_鮪魚堡.jpg',	NULL,	'2026-01-06 00:50:22',	'2026-01-08 12:10:23'),
(6,	'奶茶',	35,	2,	1,	'meals/1767728349_奶茶.jpg',	NULL,	'2026-01-06 01:11:29',	'2026-01-08 12:11:45'),
(7,	'牛奶',	40,	2,	1,	'meals/1767698356_牛奶.jpg',	NULL,	'2026-01-06 01:12:45',	'2026-01-08 11:58:46'),
(8,	'豬排漢堡',	90,	1,	0,	'meals/1767704257_豬排漢堡.jpg',	NULL,	'2026-01-06 04:57:37',	'2026-01-08 11:17:33'),
(9,	'阿華田',	40,	2,	2,	'meals/1767704447_阿華田.jpg',	NULL,	'2026-01-06 05:00:47',	'2026-01-06 05:01:01'),
(10,	'柳橙汁',	35,	2,	2,	'meals/1767725420_柳橙汁.jpg',	NULL,	'2026-01-06 05:05:57',	'2026-01-08 12:11:45'),
(11,	'香雞堡',	65,	1,	16,	'meals/1767896129_香雞堡.jpg',	NULL,	'2026-01-08 07:37:47',	'2026-01-08 12:12:02'),
(12,	'可樂',	25,	2,	2,	'meals/1767903406_可樂.jpg',	NULL,	'2026-01-08 10:13:59',	'2026-01-08 12:16:46');

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1,	'0001_01_01_000001_create_cache_table',	1),
(2,	'0001_01_01_000002_create_jobs_table',	1),
(3,	'2025_09_02_075243_add_two_factor_columns_to_users_table',	1),
(4,	'2026_01_04_105800_create_meals_table',	2),
(5,	'2026_01_04_110835_create_orders_table',	2),
(6,	'2026_01_04_111903_create_order_items_table',	2),
(7,	'2026_01_04_162408_create_categories_table',	2),
(8,	'0001_01_01_000000_create_users_table',	3),
(9,	'2026_01_06_212939_add_total_price_to_orders_table',	4);

DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `total_price` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `orders` (`id`, `user_id`, `status`, `total_price`, `created_at`, `updated_at`) VALUES
(1,	2,	'completed',	100,	'2026-01-06 08:11:22',	'2026-01-08 12:13:43'),
(2,	1,	'completed',	90,	'2026-01-08 12:10:23',	'2026-01-08 12:13:52'),
(3,	1,	'preparing',	115,	'2026-01-08 12:11:14',	'2026-01-08 12:14:11'),
(4,	1,	'pending',	190,	'2026-01-08 12:11:45',	'2026-01-08 12:11:45'),
(5,	1,	'pending',	260,	'2026-01-08 12:12:02',	'2026-01-08 12:12:02'),
(6,	1,	'pending',	25,	'2026-01-08 12:12:26',	'2026-01-08 12:14:06');

DROP TABLE IF EXISTS `order_items`;
CREATE TABLE `order_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) unsigned NOT NULL,
  `meal_id` bigint(20) unsigned NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `order_items` (`id`, `order_id`, `meal_id`, `quantity`, `created_at`, `updated_at`) VALUES
(1,	1,	2,	1,	'2026-01-06 08:11:22',	'2026-01-06 08:11:22'),
(2,	1,	3,	1,	'2026-01-06 08:11:22',	'2026-01-06 08:11:22'),
(34,	2,	3,	1,	'2026-01-08 12:10:23',	'2026-01-08 12:10:23'),
(35,	2,	5,	1,	'2026-01-08 12:10:23',	'2026-01-08 12:10:23'),
(36,	3,	10,	1,	'2026-01-08 12:11:14',	'2026-01-08 12:11:14'),
(37,	3,	2,	1,	'2026-01-08 12:11:14',	'2026-01-08 12:11:14'),
(38,	4,	1,	2,	'2026-01-08 12:11:45',	'2026-01-08 12:11:45'),
(39,	4,	10,	1,	'2026-01-08 12:11:45',	'2026-01-08 12:11:45'),
(40,	4,	6,	1,	'2026-01-08 12:11:45',	'2026-01-08 12:11:45'),
(41,	5,	11,	4,	'2026-01-08 12:12:02',	'2026-01-08 12:12:02'),
(42,	6,	12,	1,	'2026-01-08 12:12:26',	'2026-01-08 12:12:26');

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('Qt1e8CNW8kHI5z6X65h8qySPrWuKaug3rG1S4RxG',	1,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36',	'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiejI5d2JhMnpmbFBIbUIzVnNaNlZrVk9UY2pHYnhnaGQxc1czVmFXUiI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjMzOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYWRtaW4vbWVhbHMiO3M6NToicm91dGUiO3M6MTc6ImFkbWluLm1lYWxzLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9',	1767903453);

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `name`, `email`, `role`, `password`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1,	'Yalin',	'yalin@example.com',	'admin',	'$2y$12$mar5Ts05bjdwUoSj6ouTFuJvyhSMYVvx3mhCC4AiRHnp38xYv2dHO',	NULL,	'mhuBGEvmx3s8EaJAJPyVgkJMVFlVQNa9OMwZonFH0mVzzLv3sFHI24YcZx90',	'2026-01-06 08:11:22',	'2026-01-06 08:11:22'),
(2,	'Brian',	'brian@example.com',	'user',	'$2y$12$IvxgEjrXiq/yTF6t2YqDe.OwtPACEvrMv2eOMRC/ozNKaisFPbh.2',	NULL,	NULL,	'2026-01-06 12:09:21',	'2026-01-08 07:34:35');

-- 2026-01-08 20:28:20
