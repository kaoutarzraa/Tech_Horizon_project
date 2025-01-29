-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.4.3 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour tech_horizon
CREATE DATABASE IF NOT EXISTS `tech_horizon` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `tech_horizon`;

-- Listage de la structure de table tech_horizon. articles
CREATE TABLE IF NOT EXISTS `articles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `theme_id` bigint unsigned DEFAULT NULL,
  `issue_id` bigint unsigned DEFAULT NULL,
  `author_id` bigint unsigned DEFAULT NULL,
  `status` enum('propose','en_cours','retenu','publie','refuse') COLLATE utf8mb4_unicode_ci NOT NULL,
  `submission_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `publication_date` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `articles_theme_id_foreign` (`theme_id`),
  KEY `articles_issue_id_foreign` (`issue_id`),
  KEY `articles_author_id_foreign` (`author_id`),
  CONSTRAINT `articles_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `articles_issue_id_foreign` FOREIGN KEY (`issue_id`) REFERENCES `issues` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `articles_theme_id_foreign` FOREIGN KEY (`theme_id`) REFERENCES `themes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table tech_horizon.articles : ~1 rows (environ)
DELETE FROM `articles`;
INSERT INTO `articles` (`id`, `title`, `content`, `image_url`, `theme_id`, `issue_id`, `author_id`, `status`, `submission_date`, `publication_date`, `is_active`, `created_at`, `updated_at`) VALUES
	(1, 'Quas repudiandae fug', 'Et et eum consequatu', 'ksahdka', 1, NULL, 1, 'en_cours', '2025-01-29 19:28:45', '2025-01-29 19:28:46', 1, NULL, '2025-01-29 20:14:07');

-- Listage de la structure de table tech_horizon. article_images
CREATE TABLE IF NOT EXISTS `article_images` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `article_id` int unsigned DEFAULT NULL,
  `image_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `caption` text COLLATE utf8mb4_unicode_ci,
  `display_order` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table tech_horizon.article_images : ~0 rows (environ)
DELETE FROM `article_images`;

-- Listage de la structure de table tech_horizon. article_ratings
CREATE TABLE IF NOT EXISTS `article_ratings` (
  `user_id` int unsigned NOT NULL,
  `article_id` int unsigned NOT NULL,
  `rating` int DEFAULT NULL,
  `rating_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table tech_horizon.article_ratings : ~0 rows (environ)
DELETE FROM `article_ratings`;

-- Listage de la structure de table tech_horizon. browsing_history
CREATE TABLE IF NOT EXISTS `browsing_history` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned DEFAULT NULL,
  `article_id` int unsigned DEFAULT NULL,
  `viewed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table tech_horizon.browsing_history : ~0 rows (environ)
DELETE FROM `browsing_history`;

-- Listage de la structure de table tech_horizon. conversations
CREATE TABLE IF NOT EXISTS `conversations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `article_id` int unsigned DEFAULT NULL,
  `status` enum('active','closed','moderated') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table tech_horizon.conversations : ~0 rows (environ)
DELETE FROM `conversations`;

-- Listage de la structure de table tech_horizon. failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table tech_horizon.failed_jobs : ~0 rows (environ)
DELETE FROM `failed_jobs`;

-- Listage de la structure de table tech_horizon. issues
CREATE TABLE IF NOT EXISTS `issues` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `publication_date` date DEFAULT NULL,
  `status` enum('en_preparation','publie','public','archive') COLLATE utf8mb4_unicode_ci NOT NULL,
  `cover_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table tech_horizon.issues : ~0 rows (environ)
DELETE FROM `issues`;

-- Listage de la structure de table tech_horizon. messages
CREATE TABLE IF NOT EXISTS `messages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `conversation_id` int unsigned DEFAULT NULL,
  `user_id` int unsigned DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `posted_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_moderated` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table tech_horizon.messages : ~0 rows (environ)
DELETE FROM `messages`;

-- Listage de la structure de table tech_horizon. migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table tech_horizon.migrations : ~14 rows (environ)
DELETE FROM `migrations`;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(5, '2025_01_29_151826_create_article_images_table', 1),
	(6, '2025_01_29_151826_create_article_ratings_table', 1),
	(7, '2025_01_29_151827_create_browsing_history_table', 1),
	(8, '2025_01_29_151828_create_conversations_table', 1),
	(9, '2025_01_29_151828_create_issues_table', 1),
	(10, '2025_01_29_151828_create_messages_table', 1),
	(11, '2025_01_29_151829_create_theme_subscriptions_table', 1),
	(12, '2025_01_29_151829_create_themes_table', 1),
	(13, '2025_01_29_151830_create_view_statistics_table', 1),
	(14, '2025_01_29_173826_create_articles_table', 1);

-- Listage de la structure de table tech_horizon. password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table tech_horizon.password_reset_tokens : ~0 rows (environ)
DELETE FROM `password_reset_tokens`;

-- Listage de la structure de table tech_horizon. personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table tech_horizon.personal_access_tokens : ~0 rows (environ)
DELETE FROM `personal_access_tokens`;

-- Listage de la structure de table tech_horizon. themes
CREATE TABLE IF NOT EXISTS `themes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `responsable_id` bigint unsigned DEFAULT NULL,
  `image_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `themes_responsable_id_foreign` (`responsable_id`),
  CONSTRAINT `themes_responsable_id_foreign` FOREIGN KEY (`responsable_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table tech_horizon.themes : ~6 rows (environ)
DELETE FROM `themes`;
INSERT INTO `themes` (`id`, `name`, `description`, `responsable_id`, `image_url`, `created_at`, `updated_at`) VALUES
	(1, 'hello', 'sankjdka', 1, 'lksdalkjkl', NULL, NULL),
	(2, 'Project Alpha', 'A project to develop a new software platform.', 1, 'http://example.com/image1.png', '2023-01-01 09:00:00', '2023-01-01 09:00:00'),
	(3, 'Project Beta', 'An initiative to improve customer service processes.', 1, 'http://example.com/image2.png', '2023-02-15 13:30:00', '2023-02-15 13:30:00'),
	(4, 'Project Gamma', 'A research project to explore new market opportunities.', 1, 'http://example.com/image3.png', '2023-03-10 09:15:00', '2023-03-10 09:15:00'),
	(5, 'Project Delta', 'A project focused on enhancing the company\'s online presence.', 1, 'http://example.com/image4.png', '2023-04-05 15:45:00', '2023-04-05 15:45:00'),
	(6, 'Project Epsilon', 'An internal project to upgrade IT infrastructure.', 1, 'http://example.com/image5.png', '2023-05-20 10:20:00', '2023-05-20 10:20:00');

-- Listage de la structure de table tech_horizon. theme_subscriptions
CREATE TABLE IF NOT EXISTS `theme_subscriptions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL,
  `theme_id` int unsigned NOT NULL,
  `subscription_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('actif','expire','en_attente') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en_attente',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table tech_horizon.theme_subscriptions : ~1 rows (environ)
DELETE FROM `theme_subscriptions`;
INSERT INTO `theme_subscriptions` (`id`, `user_id`, `theme_id`, `subscription_date`, `status`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, '2025-01-29 19:28:54', 'actif', '2025-01-29 18:28:54', '2025-01-29 20:57:02');

-- Listage de la structure de table tech_horizon. users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('invite','abonne','responsable','editeur') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('actif','bloque','en_attente') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en_attente',
  `last_login` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table tech_horizon.users : ~1 rows (environ)
DELETE FROM `users`;
INSERT INTO `users` (`id`, `username`, `password`, `email`, `full_name`, `role`, `status`, `last_login`, `created_at`, `updated_at`) VALUES
	(1, 'xodegino', '$2y$12$79..yOOCRkXjNRxaWhARI.jouOwNrtLUGL1HS7DQyENZ65aC2eAFy', 'zaka@mailinator.com', 'Phyllis Morin', 'responsable', 'en_attente', NULL, NULL, NULL);

-- Listage de la structure de table tech_horizon. view_statistics
CREATE TABLE IF NOT EXISTS `view_statistics` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `article_id` int unsigned DEFAULT NULL,
  `theme_id` int unsigned DEFAULT NULL,
  `view_count` int NOT NULL DEFAULT '0',
  `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table tech_horizon.view_statistics : ~0 rows (environ)
DELETE FROM `view_statistics`;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
