-- --------------------------------------------------------
-- Хост:                         192.168.10.10
-- Версия сервера:               5.7.27-0ubuntu0.18.04.1 - (Ubuntu)
-- Операционная система:         Linux
-- HeidiSQL Версия:              10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Дамп структуры базы данных wirz
CREATE DATABASE IF NOT EXISTS `wirz` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `wirz`;

-- Дамп структуры для таблица wirz.campaigns
CREATE TABLE IF NOT EXISTS `campaigns` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы wirz.campaigns: ~2 rows (приблизительно)
/*!40000 ALTER TABLE `campaigns` DISABLE KEYS */;
INSERT IGNORE INTO `campaigns` (`id`, `name`, `user_id`, `is_active`, `description`, `created_at`, `updated_at`) VALUES
	(1, 'Hamilton', 2, 1, 'Hamilton nice text', '2020-06-04 15:26:08', '2020-07-02 16:51:20'),
	(2, 'Cedes', 2, 1, 'cedes nice text', '2020-06-04 17:30:13', '2020-07-02 16:51:48');
/*!40000 ALTER TABLE `campaigns` ENABLE KEYS */;

-- Дамп структуры для таблица wirz.campaign_user
CREATE TABLE IF NOT EXISTS `campaign_user` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `campaign_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы wirz.campaign_user: ~4 rows (приблизительно)
/*!40000 ALTER TABLE `campaign_user` DISABLE KEYS */;
INSERT IGNORE INTO `campaign_user` (`id`, `user_id`, `campaign_id`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, '2020-06-14 12:03:51', '2020-06-14 12:03:51'),
	(2, 2, 1, '2020-06-14 12:03:56', '2020-06-14 12:03:56'),
	(3, 1, 2, '2020-06-14 12:04:02', '2020-06-14 12:04:02'),
	(4, 2, 2, '2020-06-14 12:04:10', '2020-06-14 12:04:10');
/*!40000 ALTER TABLE `campaign_user` ENABLE KEYS */;

-- Дамп структуры для таблица wirz.images
CREATE TABLE IF NOT EXISTS `images` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы wirz.images: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `images` DISABLE KEYS */;
/*!40000 ALTER TABLE `images` ENABLE KEYS */;

-- Дамп структуры для таблица wirz.import_data
CREATE TABLE IF NOT EXISTS `import_data` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы wirz.import_data: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `import_data` DISABLE KEYS */;
INSERT IGNORE INTO `import_data` (`id`, `name`) VALUES
	(3, 'stop');
/*!40000 ALTER TABLE `import_data` ENABLE KEYS */;

-- Дамп структуры для таблица wirz.metrics
CREATE TABLE IF NOT EXISTS `metrics` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` double NOT NULL,
  `campaign_id` int(11) NOT NULL,
  `engagement` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=164 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы wirz.metrics: ~163 rows (приблизительно)
/*!40000 ALTER TABLE `metrics` DISABLE KEYS */;
INSERT IGNORE INTO `metrics` (`id`, `name`, `value`, `campaign_id`, `engagement`, `created_at`, `updated_at`, `date`) VALUES
	(1, 'clicks', 123123, 2, NULL, '2020-06-04 17:14:18', '2020-06-04 17:14:18', '2020-06-04 09:00:00'),
	(2, 'total_reach', 123123, 2, NULL, '2020-06-04 17:14:18', '2020-06-04 17:14:18', '2020-06-04 09:00:00'),
	(3, 'ad_engagement', 123, 2, NULL, '2020-06-04 17:14:18', '2020-06-04 17:14:18', '2020-06-04 09:00:00'),
	(4, 'page_engagement', 123, 2, NULL, '2020-06-04 17:14:18', '2020-06-04 17:14:18', '2020-06-04 09:00:00'),
	(5, 'active_length', 123, 2, NULL, '2020-06-04 17:14:18', '2020-06-04 17:14:18', '2020-06-04 09:00:00'),
	(6, 'clickouts', 123, 2, NULL, '2020-06-04 17:14:18', '2020-06-04 17:14:18', '2020-06-04 09:00:00'),
	(7, 'sales', 123, 2, NULL, '2020-06-04 17:14:18', '2020-06-04 17:14:18', '2020-06-04 09:00:00'),
	(8, 'clicks', 34546, 2, NULL, '2020-06-04 18:13:52', '2020-06-04 18:13:52', '2020-06-05 09:00:00'),
	(9, 'total_reach', 23123, 2, NULL, '2020-06-04 18:13:52', '2020-06-04 18:13:52', '2020-06-05 09:00:00'),
	(10, 'ad_engagement', 64356, 2, NULL, '2020-06-04 18:13:52', '2020-06-04 18:13:52', '2020-06-05 09:00:00'),
	(11, 'page_engagement', 13, 2, NULL, '2020-06-04 18:13:52', '2020-06-04 18:13:52', '2020-06-05 09:00:00'),
	(12, 'active_length', 6456, 2, NULL, '2020-06-04 18:13:52', '2020-06-04 18:13:52', '2020-06-05 09:00:00'),
	(13, 'clickouts', 123, 2, NULL, '2020-06-04 18:13:52', '2020-06-04 18:13:52', '2020-06-05 09:00:00'),
	(14, 'clicks', 123124, 2, NULL, '2020-06-04 18:15:08', '2020-06-04 18:15:08', '2020-06-04 21:00:00'),
	(15, 'total_reach', 12312, 2, NULL, '2020-06-04 18:15:08', '2020-06-04 18:15:08', '2020-06-04 21:00:00'),
	(16, 'ad_engagement', 12123, 2, NULL, '2020-06-04 18:15:08', '2020-06-04 18:15:08', '2020-06-04 21:00:00'),
	(17, 'page_engagement', 12412412, 2, NULL, '2020-06-04 18:15:08', '2020-06-04 18:15:08', '2020-06-04 21:00:00'),
	(18, 'active_length', 124124, 2, NULL, '2020-06-04 18:15:08', '2020-06-04 18:15:08', '2020-06-04 21:00:00'),
	(19, 'clickouts', 123124, 2, NULL, '2020-06-04 18:15:08', '2020-06-04 18:15:08', '2020-06-04 21:00:00'),
	(20, 'clicks', 123124, 2, NULL, '2020-06-04 18:15:20', '2020-06-04 18:15:20', '2020-06-04 21:00:00'),
	(21, 'total_reach', 12312, 2, NULL, '2020-06-04 18:15:20', '2020-06-04 18:15:20', '2020-06-04 21:00:00'),
	(22, 'ad_engagement', 12123, 2, NULL, '2020-06-04 18:15:20', '2020-06-04 18:15:20', '2020-06-04 21:00:00'),
	(23, 'page_engagement', 12412412, 2, NULL, '2020-06-04 18:15:20', '2020-06-04 18:15:20', '2020-06-04 21:00:00'),
	(24, 'active_length', 124124, 2, NULL, '2020-06-04 18:15:20', '2020-06-04 18:15:20', '2020-06-04 21:00:00'),
	(25, 'clickouts', 123124, 2, NULL, '2020-06-04 18:15:20', '2020-06-04 18:15:20', '2020-06-04 21:00:00'),
	(26, 'sales', 1241241, 2, NULL, '2020-06-04 18:15:21', '2020-06-04 18:15:21', '2020-06-04 21:00:00'),
	(27, 'clicks', 124, 1, NULL, '2020-06-04 20:52:53', '2020-06-04 20:52:53', '2020-06-04 21:00:00'),
	(28, 'total_reach', 124, 1, NULL, '2020-06-04 20:52:53', '2020-06-04 20:52:53', '2020-06-04 21:00:00'),
	(29, 'ad_engagement', 125435, 1, NULL, '2020-06-04 20:52:53', '2020-06-04 20:52:53', '2020-06-04 21:00:00'),
	(30, 'page_engagement', 2345, 1, NULL, '2020-06-04 20:52:53', '2020-06-04 20:52:53', '2020-06-04 21:00:00'),
	(31, 'active_length', 234, 1, NULL, '2020-06-04 20:52:53', '2020-06-04 20:52:53', '2020-06-04 21:00:00'),
	(32, 'clickouts', 456, 1, NULL, '2020-06-04 20:52:53', '2020-06-04 20:52:53', '2020-06-04 21:00:00'),
	(33, 'sales', 234, 1, NULL, '2020-06-04 20:52:53', '2020-06-04 20:52:53', '2020-06-04 21:00:00'),
	(34, 'clicks', 3, 1, NULL, '2020-06-04 20:53:58', '2020-06-04 20:53:58', '2020-06-04 21:00:00'),
	(35, 'total_reach', 0, 1, NULL, '2020-06-04 20:53:58', '2020-06-04 20:53:58', '2020-06-04 21:00:00'),
	(36, 'ad_engagement', 5, 1, NULL, '2020-06-04 20:53:58', '2020-06-04 20:53:58', '2020-06-04 21:00:00'),
	(37, 'page_engagement', 24, 1, NULL, '2020-06-04 20:53:58', '2020-06-04 20:53:58', '2020-06-04 21:00:00'),
	(38, 'active_length', 123, 1, NULL, '2020-06-04 20:53:58', '2020-06-04 20:53:58', '2020-06-04 21:00:00'),
	(39, 'clickouts', 0, 1, NULL, '2020-06-04 20:53:58', '2020-06-04 20:53:58', '2020-06-04 21:00:00'),
	(40, 'sales', 0, 1, NULL, '2020-06-04 20:53:58', '2020-06-04 20:53:58', '2020-06-04 21:00:00'),
	(41, 'clicks', 0, 1, NULL, '2020-06-04 20:55:23', '2020-06-04 20:55:23', '2020-06-02 21:00:00'),
	(42, 'total_reach', 0, 1, NULL, '2020-06-04 20:55:23', '2020-06-04 20:55:23', '2020-06-02 21:00:00'),
	(43, 'ad_engagement', 0, 1, NULL, '2020-06-04 20:55:23', '2020-06-04 20:55:23', '2020-06-02 21:00:00'),
	(44, 'page_engagement', 0, 1, NULL, '2020-06-04 20:55:23', '2020-06-04 20:55:23', '2020-06-02 21:00:00'),
	(45, 'active_length', 0, 1, NULL, '2020-06-04 20:55:23', '2020-06-04 20:55:23', '2020-06-02 21:00:00'),
	(46, 'clickouts', 0, 1, NULL, '2020-06-04 20:55:23', '2020-06-04 20:55:23', '2020-06-02 21:00:00'),
	(47, 'sales', 0, 1, NULL, '2020-06-04 20:55:23', '2020-06-04 20:55:23', '2020-06-02 21:00:00'),
	(48, 'clicks', 0, 1, NULL, '2020-06-04 20:55:48', '2020-06-04 20:55:48', '2020-06-16 21:00:00'),
	(49, 'total_reach', 0, 1, NULL, '2020-06-04 20:55:48', '2020-06-04 20:55:48', '2020-06-16 21:00:00'),
	(50, 'ad_engagement', 0, 1, NULL, '2020-06-04 20:55:48', '2020-06-04 20:55:48', '2020-06-16 21:00:00'),
	(51, 'page_engagement', 0, 1, NULL, '2020-06-04 20:55:48', '2020-06-04 20:55:48', '2020-06-16 21:00:00'),
	(52, 'active_length', 0, 1, NULL, '2020-06-04 20:55:48', '2020-06-04 20:55:48', '2020-06-16 21:00:00'),
	(53, 'clickouts', 0, 1, NULL, '2020-06-04 20:55:48', '2020-06-04 20:55:48', '2020-06-16 21:00:00'),
	(54, 'sales', 0, 1, NULL, '2020-06-04 20:55:48', '2020-06-04 20:55:48', '2020-06-16 21:00:00'),
	(55, 'display', 231, 1, NULL, '2020-06-04 21:07:11', '2020-06-04 21:07:11', '2020-06-04 21:00:00'),
	(56, 'native', 443, 1, NULL, '2020-06-04 21:07:11', '2020-06-04 21:07:11', '2020-06-04 21:00:00'),
	(57, 'search', 34, 1, NULL, '2020-06-04 21:07:11', '2020-06-04 21:07:11', '2020-06-04 21:00:00'),
	(58, 'social', 34, 1, NULL, '2020-06-04 21:07:11', '2020-06-04 21:07:11', '2020-06-04 21:00:00'),
	(59, 'display', 34, 2, NULL, '2020-06-04 21:07:11', '2020-06-04 21:07:11', '2020-06-04 21:00:00'),
	(60, 'native', 123, 2, NULL, '2020-06-04 21:07:11', '2020-06-04 21:07:11', '2020-06-04 21:00:00'),
	(61, 'search', 3441, 2, NULL, '2020-06-04 21:07:11', '2020-06-04 21:07:11', '2020-06-04 21:00:00'),
	(62, 'social', 3123, 2, NULL, '2020-06-04 21:07:11', '2020-06-04 21:07:11', '2020-06-04 21:00:00'),
	(63, 'clicks', 124, 1, NULL, '2020-06-04 22:04:51', '2020-06-04 22:04:51', '2020-06-04 21:00:00'),
	(64, 'total_reach', 3434, 1, NULL, '2020-06-04 22:04:51', '2020-06-04 22:04:51', '2020-06-04 21:00:00'),
	(65, 'ad_engagement', 0, 1, NULL, '2020-06-04 22:04:51', '2020-06-04 22:04:51', '2020-06-04 21:00:00'),
	(66, 'page_engagement', 0, 1, NULL, '2020-06-04 22:04:51', '2020-06-04 22:04:51', '2020-06-04 21:00:00'),
	(67, 'active_length', 0, 1, NULL, '2020-06-04 22:04:51', '2020-06-04 22:04:51', '2020-06-04 21:00:00'),
	(68, 'clickouts', 0, 1, NULL, '2020-06-04 22:04:51', '2020-06-04 22:04:51', '2020-06-04 21:00:00'),
	(69, 'sales', 0, 1, NULL, '2020-06-04 22:04:51', '2020-06-04 22:04:51', '2020-06-04 21:00:00'),
	(70, 'display', 123, 1, NULL, '2020-06-04 22:05:00', '2020-06-04 22:05:00', '2020-06-04 21:00:00'),
	(71, 'native', 324234, 1, NULL, '2020-06-04 22:05:00', '2020-06-04 22:05:00', '2020-06-04 21:00:00'),
	(72, 'search', 34, 1, NULL, '2020-06-04 22:05:00', '2020-06-04 22:05:00', '2020-06-04 21:00:00'),
	(73, 'social', 123, 1, NULL, '2020-06-04 22:05:00', '2020-06-04 22:05:00', '2020-06-04 21:00:00'),
	(74, 'display', 0, 2, NULL, '2020-06-04 22:05:00', '2020-06-04 22:05:00', '2020-06-04 21:00:00'),
	(75, 'native', 0, 2, NULL, '2020-06-04 22:05:00', '2020-06-04 22:05:00', '2020-06-04 21:00:00'),
	(76, 'search', 0, 2, NULL, '2020-06-04 22:05:00', '2020-06-04 22:05:00', '2020-06-04 21:00:00'),
	(77, 'social', 0, 2, NULL, '2020-06-04 22:05:00', '2020-06-04 22:05:00', '2020-06-04 21:00:00'),
	(78, 'clicks', 0, 1, NULL, '2020-06-05 18:35:26', '2020-06-05 18:35:26', '2020-06-05 21:00:00'),
	(79, 'total_reach', 0, 1, NULL, '2020-06-05 18:35:26', '2020-06-05 18:35:26', '2020-06-05 21:00:00'),
	(80, 'clicks', 0, 2, NULL, '2020-06-05 18:37:49', '2020-06-05 18:37:49', '2020-06-05 21:00:00'),
	(81, 'total_reach', 0, 2, NULL, '2020-06-05 18:37:49', '2020-06-05 18:37:49', '2020-06-05 21:00:00'),
	(82, 'ad_engagement', 0, 2, NULL, '2020-06-05 18:37:49', '2020-06-05 18:37:49', '2020-06-05 21:00:00'),
	(83, 'page_engagement', 0, 2, NULL, '2020-06-05 18:37:49', '2020-06-05 18:37:49', '2020-06-05 21:00:00'),
	(84, 'active_length', 0, 2, NULL, '2020-06-05 18:37:49', '2020-06-05 18:37:49', '2020-06-05 21:00:00'),
	(85, 'clickouts', 0, 2, NULL, '2020-06-05 18:37:49', '2020-06-05 18:37:49', '2020-06-05 21:00:00'),
	(86, 'sales', 0, 2, NULL, '2020-06-05 18:37:49', '2020-06-05 18:37:49', '2020-06-05 21:00:00'),
	(87, 'clicks', 0, 1, NULL, '2020-06-05 18:38:07', '2020-06-05 18:38:07', '2020-06-05 21:00:00'),
	(88, 'total_reach', 0, 1, NULL, '2020-06-05 18:38:07', '2020-06-05 18:38:07', '2020-06-05 21:00:00'),
	(89, 'ad_engagement', 0, 1, NULL, '2020-06-05 18:38:07', '2020-06-05 18:38:07', '2020-06-05 21:00:00'),
	(90, 'page_engagement', 0, 1, NULL, '2020-06-05 18:38:07', '2020-06-05 18:38:07', '2020-06-05 21:00:00'),
	(91, 'active_length', 0, 1, NULL, '2020-06-05 18:38:07', '2020-06-05 18:38:07', '2020-06-05 21:00:00'),
	(92, 'clickouts', 0, 1, NULL, '2020-06-05 18:38:07', '2020-06-05 18:38:07', '2020-06-05 21:00:00'),
	(93, 'sales', 0, 1, NULL, '2020-06-05 18:38:07', '2020-06-05 18:38:07', '2020-06-05 21:00:00'),
	(94, 'clicks', 0, 1, NULL, '2020-06-05 18:43:17', '2020-06-05 18:43:17', '2020-06-05 21:00:00'),
	(95, 'total_reach', 0, 1, NULL, '2020-06-05 18:43:17', '2020-06-05 18:43:17', '2020-06-05 21:00:00'),
	(96, 'ad_engagement', 0, 1, NULL, '2020-06-05 18:43:17', '2020-06-05 18:43:17', '2020-06-05 21:00:00'),
	(97, 'page_engagement', 0, 1, NULL, '2020-06-05 18:43:17', '2020-06-05 18:43:17', '2020-06-05 21:00:00'),
	(98, 'active_length', 0, 1, NULL, '2020-06-05 18:43:17', '2020-06-05 18:43:17', '2020-06-05 21:00:00'),
	(99, 'clickouts', 0, 1, NULL, '2020-06-05 18:43:17', '2020-06-05 18:43:17', '2020-06-05 21:00:00'),
	(100, 'sales', 0, 1, NULL, '2020-06-05 18:43:17', '2020-06-05 18:43:17', '2020-06-05 21:00:00'),
	(101, 'clicks', 0, 1, NULL, '2020-06-05 20:08:16', '2020-06-05 20:08:16', '2020-06-05 21:00:00'),
	(102, 'total_reach', 0, 1, NULL, '2020-06-05 20:08:16', '2020-06-05 20:08:16', '2020-06-05 21:00:00'),
	(103, 'ad_engagement', 0, 1, NULL, '2020-06-05 20:08:16', '2020-06-05 20:08:16', '2020-06-05 21:00:00'),
	(104, 'page_engagement', 0, 1, NULL, '2020-06-05 20:08:16', '2020-06-05 20:08:16', '2020-06-05 21:00:00'),
	(105, 'active_length', 0, 1, NULL, '2020-06-05 20:08:16', '2020-06-05 20:08:16', '2020-06-05 21:00:00'),
	(106, 'clickouts', 0, 1, NULL, '2020-06-05 20:08:16', '2020-06-05 20:08:16', '2020-06-05 21:00:00'),
	(107, 'sales', 0, 1, NULL, '2020-06-05 20:08:16', '2020-06-05 20:08:16', '2020-06-05 21:00:00'),
	(108, 'clicks', 0, 1, NULL, '2020-06-14 08:47:39', '2020-06-14 08:47:39', '2020-06-13 21:00:00'),
	(109, 'total_reach', 10, 1, NULL, '2020-06-14 08:47:39', '2020-06-14 08:47:39', '2020-06-13 21:00:00'),
	(110, 'ad_engagement', 0, 1, NULL, '2020-06-14 08:47:39', '2020-06-14 08:47:39', '2020-06-13 21:00:00'),
	(111, 'page_engagement', 0, 1, NULL, '2020-06-14 08:47:39', '2020-06-14 08:47:39', '2020-06-13 21:00:00'),
	(112, 'active_length', 0, 1, NULL, '2020-06-14 08:47:39', '2020-06-14 08:47:39', '2020-06-13 21:00:00'),
	(113, 'clickouts', 0, 1, NULL, '2020-06-14 08:47:39', '2020-06-14 08:47:39', '2020-06-13 21:00:00'),
	(114, 'sales', 0, 1, NULL, '2020-06-14 08:47:39', '2020-06-14 08:47:39', '2020-06-13 21:00:00'),
	(115, 'clicks', 250, 1, NULL, '2020-06-14 09:26:12', '2020-06-14 09:26:12', '2020-06-13 21:00:00'),
	(116, 'total_reach', 0, 1, NULL, '2020-06-14 09:26:12', '2020-06-14 09:26:12', '2020-06-13 21:00:00'),
	(117, 'ad_engagement', 0, 1, NULL, '2020-06-14 09:26:12', '2020-06-14 09:26:12', '2020-06-13 21:00:00'),
	(118, 'page_engagement', 0, 1, NULL, '2020-06-14 09:26:12', '2020-06-14 09:26:12', '2020-06-13 21:00:00'),
	(119, 'active_length', 0, 1, NULL, '2020-06-14 09:26:12', '2020-06-14 09:26:12', '2020-06-13 21:00:00'),
	(120, 'clickouts', 0, 1, NULL, '2020-06-14 09:26:12', '2020-06-14 09:26:12', '2020-06-13 21:00:00'),
	(121, 'sales', 0, 1, NULL, '2020-06-14 09:26:12', '2020-06-14 09:26:12', '2020-06-13 21:00:00'),
	(122, 'clicks', 0, 1, NULL, '2020-06-14 09:27:03', '2020-06-14 09:27:03', '2020-06-13 21:00:00'),
	(123, 'total_reach', 0, 1, NULL, '2020-06-14 09:27:03', '2020-06-14 09:27:03', '2020-06-13 21:00:00'),
	(124, 'ad_engagement', 0, 1, NULL, '2020-06-14 09:27:03', '2020-06-14 09:27:03', '2020-06-13 21:00:00'),
	(125, 'page_engagement', 0, 1, NULL, '2020-06-14 09:27:03', '2020-06-14 09:27:03', '2020-06-13 21:00:00'),
	(126, 'active_length', 0, 1, NULL, '2020-06-14 09:27:03', '2020-06-14 09:27:03', '2020-06-13 21:00:00'),
	(127, 'clickouts', 0, 1, NULL, '2020-06-14 09:27:03', '2020-06-14 09:27:03', '2020-06-13 21:00:00'),
	(128, 'sales', 0, 1, NULL, '2020-06-14 09:27:03', '2020-06-14 09:27:03', '2020-06-13 21:00:00'),
	(129, 'clicks', 0, 1, NULL, '2020-06-22 09:42:07', '2020-06-22 09:42:07', '2020-06-21 21:00:00'),
	(130, 'total_reach', 66, 1, NULL, '2020-06-22 09:42:07', '2020-06-22 09:42:07', '2020-06-21 21:00:00'),
	(131, 'ad_engagement', 0, 1, NULL, '2020-06-22 09:42:07', '2020-06-22 09:42:07', '2020-06-21 21:00:00'),
	(132, 'page_engagement', 0, 1, NULL, '2020-06-22 09:42:07', '2020-06-22 09:42:07', '2020-06-21 21:00:00'),
	(133, 'active_length', 0, 1, NULL, '2020-06-22 09:42:07', '2020-06-22 09:42:07', '2020-06-21 21:00:00'),
	(134, 'clickouts', 0, 1, NULL, '2020-06-22 09:42:07', '2020-06-22 09:42:07', '2020-06-21 21:00:00'),
	(135, 'sales', 0, 1, NULL, '2020-06-22 09:42:07', '2020-06-22 09:42:07', '2020-06-21 21:00:00'),
	(136, 'clicks', 0, 1, NULL, '2020-06-25 04:52:30', '2020-06-25 04:52:30', '2020-06-24 21:00:00'),
	(137, 'total_reach', 13, 1, NULL, '2020-06-25 04:52:30', '2020-06-25 04:52:30', '2020-06-24 21:00:00'),
	(138, 'ad_engagement', 0, 1, NULL, '2020-06-25 04:52:30', '2020-06-25 04:52:30', '2020-06-24 21:00:00'),
	(139, 'page_engagement', 0, 1, NULL, '2020-06-25 04:52:30', '2020-06-25 04:52:30', '2020-06-24 21:00:00'),
	(140, 'active_length', 0, 1, NULL, '2020-06-25 04:52:30', '2020-06-25 04:52:30', '2020-06-24 21:00:00'),
	(141, 'clickouts', 0, 1, NULL, '2020-06-25 04:52:30', '2020-06-25 04:52:30', '2020-06-24 21:00:00'),
	(142, 'sales', 0, 1, NULL, '2020-06-25 04:52:30', '2020-06-25 04:52:30', '2020-06-24 21:00:00'),
	(143, 'clicks', 0, 1, NULL, '2020-06-25 04:54:03', '2020-06-25 04:54:03', '2020-06-24 21:00:00'),
	(144, 'total_reach', 0, 1, NULL, '2020-06-25 04:54:03', '2020-06-25 04:54:03', '2020-06-24 21:00:00'),
	(145, 'ad_engagement', 0, 1, NULL, '2020-06-25 04:54:03', '2020-06-25 04:54:03', '2020-06-24 21:00:00'),
	(146, 'page_engagement', 0, 1, NULL, '2020-06-25 04:54:03', '2020-06-25 04:54:03', '2020-06-24 21:00:00'),
	(147, 'active_length', 0, 1, NULL, '2020-06-25 04:54:03', '2020-06-25 04:54:03', '2020-06-24 21:00:00'),
	(148, 'clickouts', 0, 1, NULL, '2020-06-25 04:54:03', '2020-06-25 04:54:03', '2020-06-24 21:00:00'),
	(149, 'sales', 0, 1, NULL, '2020-06-25 04:54:03', '2020-06-25 04:54:03', '2020-06-24 21:00:00'),
	(150, 'clicks', 0, 1, NULL, '2020-06-25 04:54:08', '2020-06-25 04:54:08', '2020-06-24 21:00:00'),
	(151, 'total_reach', 0, 1, NULL, '2020-06-25 04:54:08', '2020-06-25 04:54:08', '2020-06-24 21:00:00'),
	(152, 'ad_engagement', 0, 1, NULL, '2020-06-25 04:54:08', '2020-06-25 04:54:08', '2020-06-24 21:00:00'),
	(153, 'page_engagement', 0, 1, NULL, '2020-06-25 04:54:08', '2020-06-25 04:54:08', '2020-06-24 21:00:00'),
	(154, 'active_length', 0, 1, NULL, '2020-06-25 04:54:08', '2020-06-25 04:54:08', '2020-06-24 21:00:00'),
	(155, 'clickouts', 0, 1, NULL, '2020-06-25 04:54:08', '2020-06-25 04:54:08', '2020-06-24 21:00:00'),
	(156, 'sales', 0, 1, NULL, '2020-06-25 04:54:08', '2020-06-25 04:54:08', '2020-06-24 21:00:00'),
	(157, 'clicks', 50, 1, NULL, '2020-06-26 07:07:20', '2020-06-26 07:07:20', '2020-06-25 21:00:00'),
	(158, 'total_reach', 500, 1, NULL, '2020-06-26 07:07:20', '2020-06-26 07:07:20', '2020-06-25 21:00:00'),
	(159, 'ad_engagement', 10, 1, NULL, '2020-06-26 07:07:20', '2020-06-26 07:07:20', '2020-06-25 21:00:00'),
	(160, 'page_engagement', 100, 1, NULL, '2020-06-26 07:07:20', '2020-06-26 07:07:20', '2020-06-25 21:00:00'),
	(161, 'active_length', 20, 1, NULL, '2020-06-26 07:07:20', '2020-06-26 07:07:20', '2020-06-25 21:00:00'),
	(162, 'clickouts', 200, 1, NULL, '2020-06-26 07:07:20', '2020-06-26 07:07:20', '2020-06-25 21:00:00'),
	(163, 'sales', 300, 1, NULL, '2020-06-26 07:07:20', '2020-06-26 07:07:20', '2020-06-25 21:00:00');
/*!40000 ALTER TABLE `metrics` ENABLE KEYS */;

-- Дамп структуры для таблица wirz.metric_accesses
CREATE TABLE IF NOT EXISTS `metric_accesses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `metric_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы wirz.metric_accesses: ~7 rows (приблизительно)
/*!40000 ALTER TABLE `metric_accesses` DISABLE KEYS */;
INSERT IGNORE INTO `metric_accesses` (`id`, `user_id`, `metric_name`, `is_active`, `created_at`, `updated_at`) VALUES
	(1, 2, 'clicks', 0, '2020-06-05 18:35:26', '2020-06-26 07:07:20'),
	(2, 2, 'total_reach', 1, '2020-06-05 18:35:26', '2020-06-26 07:07:20'),
	(3, 2, 'ad_engagement', 1, '2020-06-05 18:37:49', '2020-06-26 07:07:20'),
	(4, 2, 'page_engagement', 0, '2020-06-05 18:37:49', '2020-06-26 07:07:20'),
	(5, 2, 'active_length', 0, '2020-06-05 18:37:49', '2020-06-26 07:07:20'),
	(6, 2, 'clickouts', 0, '2020-06-05 18:37:49', '2020-06-26 07:07:20'),
	(7, 2, 'sales', 0, '2020-06-05 18:37:49', '2020-06-26 07:07:20');
/*!40000 ALTER TABLE `metric_accesses` ENABLE KEYS */;

-- Дамп структуры для таблица wirz.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы wirz.migrations: ~22 rows (приблизительно)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT IGNORE INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(4, '2014_10_12_100000_create_password_resets_table', 2),
	(5, '2020_06_04_151707_create_metrics_table', 2),
	(6, '2020_06_04_152159_create_campaigns_table', 2),
	(9, '2020_06_04_152905_add_token_to_user', 3),
	(10, '2020_06_04_153732_add_date_to_metric', 4),
	(11, '2020_06_04_155825_add_user_name_nullable', 5),
	(12, '2020_06_04_200931_chache_metric_value_type', 6),
	(13, '2020_06_05_212116_add_user_role', 7),
	(14, '2020_06_05_212440_create_metric_accesses_table', 8),
	(15, '2020_06_05_213201_remove_is_active_from_metric', 9),
	(16, '2020_06_14_120029_create_campaign_users_table', 10),
	(17, '2020_06_30_085347_create_images_table', 11),
	(18, '2020_06_30_113730_delete_roles_column_from_users_table', 11),
	(19, '2020_06_30_114110_create_roles_table', 11),
	(20, '2020_06_30_114337_roles_users_add_foreign_key', 11),
	(22, '2020_07_02_084845_users_table_add_logo_column', 12),
	(24, '2020_07_02_090014_users_table_delete_api_token_column', 13),
	(25, '2020_07_02_125516_users_password_make_nullable', 14),
	(26, '2020_07_02_124325_add_is_active_to__campaigns_table', 15),
	(28, '2020_07_02_162843_campaigns_add_description_column', 16),
	(29, '2020_07_03_074734_create_import_data_table', 17);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Дамп структуры для таблица wirz.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы wirz.password_resets: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Дамп структуры для таблица wirz.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы wirz.roles: ~2 rows (приблизительно)
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT IGNORE INTO `roles` (`id`, `name`) VALUES
	(1, 'Admin'),
	(2, 'Client');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

-- Дамп структуры для таблица wirz.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role_id` tinyint(3) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `user_role_foreign` (`role_id`),
  CONSTRAINT `user_role_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы wirz.users: ~3 rows (приблизительно)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT IGNORE INTO `users` (`id`, `name`, `email`, `logo`, `email_verified_at`, `password`, `created_at`, `updated_at`, `role_id`) VALUES
	(1, 'Wirz Digital', 'wirz@hiiive.io', '15937014365efdf43c35979.jpg', NULL, '$2y$10$FeG/XdOymHa/b1dQ3oMjzOBIsuCCzLouL5fHy472R1cvOtctRQl9G', '2020-06-04 13:52:57', '2020-07-02 15:41:01', 1),
	(2, 'RHB', 'rhb@hiiive.io', NULL, NULL, '$2y$10$F3AaJFCyziZJ92uXduZNDeUG2F//6vD8phoDilIhh.49RqNBbcfMy', '2020-06-05 18:18:45', '2020-06-05 18:18:45', 2);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
