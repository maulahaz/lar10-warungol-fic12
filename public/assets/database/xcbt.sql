-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for xcbt
CREATE DATABASE IF NOT EXISTS `xcbt` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `xcbt`;

-- Dumping structure for table xcbt.failed_jobs
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

-- Dumping data for table xcbt.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table xcbt.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table xcbt.migrations: ~7 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
	(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
	(4, '2019_08_19_000000_create_failed_jobs_table', 1),
	(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(6, '2023_11_17_192923_soals_table', 2),
	(7, '2023_11_17_194201_create_soals_table', 3);

-- Dumping structure for table xcbt.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table xcbt.password_reset_tokens: ~0 rows (approximately)

-- Dumping structure for table xcbt.personal_access_tokens
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

-- Dumping data for table xcbt.personal_access_tokens: ~0 rows (approximately)

-- Dumping structure for table xcbt.tbl_banksoal
CREATE TABLE IF NOT EXISTS `tbl_banksoal` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `pertanyaan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `opsi_a` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `opsi_b` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `opsi_c` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `opsi_d` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jawaban` enum('a','b','c','d') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table xcbt.tbl_banksoal: ~20 rows (approximately)
INSERT INTO `tbl_banksoal` (`id`, `pertanyaan`, `kategori`, `opsi_a`, `opsi_b`, `opsi_c`, `opsi_d`, `jawaban`, `created_at`, `updated_at`) VALUES
	(1, 'Suscipit nihil aperiam nobis quaerat dolor. Voluptas ut sunt accusamus officiis sit omnis laborum. Voluptatum rerum fugiat qui ipsam.', 'Area-1', 'Expedita occaecati magnam dolor labore molestiae exercitationem officia.', 'Dolor praesentium ipsa quis praesentium exercitationem deserunt.', 'Neque velit earum atque laudantium ducimus ut.', 'Nulla placeat dolorem id omnis praesentium.', 'b', '2023-11-17 16:28:47', '2023-11-17 16:28:47'),
	(2, 'Dolorem exercitationem est cumque quo et perspiciatis. Voluptate pariatur omnis aut. Eos a aliquid incidunt quod dolorum quis sunt. Qui at quae nesciunt et dolores dicta nam. Sed quia rem vel maiores rem exercitationem.', 'Area-2', 'Quaerat fuga totam consequatur et aspernatur dolore.', 'Voluptas et dolorum ut recusandae aut.', 'In natus aliquam reiciendis quae ratione voluptas sequi consectetur.', 'Deserunt et amet et sequi.', 'b', '2023-11-17 16:28:47', '2023-11-17 16:28:47'),
	(3, 'Culpa sint aut nihil error debitis blanditiis aut. Laudantium dolores atque omnis. Laudantium tempora qui sapiente qui dignissimos.', 'Area-2', 'Mollitia eius nam nesciunt dolores ipsum.', 'Quis tenetur in ea qui vitae error enim.', 'Et et commodi ab aut.', 'Ut quia commodi praesentium.', 'd', '2023-11-17 16:28:47', '2023-11-17 16:28:47'),
	(4, 'Fugiat sed voluptatem minus ut quisquam voluptatum. Soluta unde rerum officiis. Fugiat impedit et ad. Reprehenderit pariatur et sit culpa iusto.', 'Area-9', 'Deserunt perferendis quibusdam quam nisi animi voluptas vel.', 'Sint libero exercitationem debitis.', 'Soluta consequatur voluptatibus ad quasi similique dolor incidunt.', 'Harum eos sit id soluta.', 'b', '2023-11-17 16:28:47', '2023-11-17 16:28:47'),
	(5, 'Hic et repudiandae necessitatibus facilis laborum. Quasi deleniti a saepe ut. Asperiores accusantium ut exercitationem est vel. Et qui illo minus numquam quia. Rem laudantium similique ut nisi tempora iste optio.', 'Area-1', 'Vel blanditiis ut distinctio est.', 'Dolores ratione earum sed deserunt accusantium.', 'Ab beatae aut totam accusamus corporis.', 'Et aliquid laborum illo sed ad harum odio porro.', 'd', '2023-11-17 16:28:47', '2023-11-17 16:28:47'),
	(6, 'Et illo impedit reprehenderit voluptates. Quo numquam impedit deserunt.', 'Area-9', 'Illo sit ipsam eveniet doloribus quaerat.', 'Et vero velit ea soluta velit.', 'Illo facere velit ab nostrum veritatis magnam sed.', 'Qui qui placeat temporibus et.', 'b', '2023-11-17 16:28:47', '2023-11-17 16:28:47'),
	(7, 'Non occaecati vel possimus et nulla impedit. Sequi qui sunt et aut. Vitae mollitia pariatur iste numquam optio nisi suscipit vitae. Nam reiciendis voluptatem laborum voluptatem est animi.', 'Area-1', 'Nulla veniam sit modi molestias.', 'Expedita quia eos rerum id exercitationem unde sapiente.', 'Neque rerum alias voluptates qui velit.', 'Est est cumque quasi quis.', 'd', '2023-11-17 16:28:47', '2023-11-17 16:28:47'),
	(8, 'Nihil ratione at veniam. Id ipsam et eaque est. Quia veritatis rem necessitatibus non fuga quas magnam.', 'Area-3', 'Non atque laborum incidunt doloribus vitae possimus et.', 'Maxime tempore sint et.', 'Ad impedit ut placeat.', 'Animi mollitia reprehenderit libero non.', 'd', '2023-11-17 16:28:47', '2023-11-17 16:28:47'),
	(9, 'Est vitae fugit neque ut deserunt blanditiis in temporibus. Eum fugiat quam qui et quia. Modi veritatis sunt illo numquam ut non.', 'Area-2', 'Aut voluptatum incidunt dignissimos.', 'Culpa adipisci qui sed sunt placeat eos sed.', 'Nesciunt molestias minima porro est ut.', 'Nesciunt eos totam laudantium vel quia.', 'a', '2023-11-17 16:28:47', '2023-11-17 16:28:47'),
	(10, 'Velit magnam facere voluptas nobis molestiae asperiores at. Atque et praesentium natus hic. Deleniti dolorem ullam quo ex.', 'Area-3', 'Culpa nam eum repellendus et laudantium dolorem.', 'Est facilis et cupiditate.', 'Dolor et doloremque laboriosam cum dolores placeat.', 'Sunt illum ut natus fugit alias magni.', 'c', '2023-11-17 16:28:47', '2023-11-17 16:28:47'),
	(11, 'Tempora sint et rem earum possimus eveniet provident. Non et cumque dolore quae in quia. Numquam nulla in et tempore numquam aut culpa. Et aut quia ex deserunt maiores perspiciatis.', 'Area-1', 'Repudiandae consequatur ab voluptas facilis voluptatem voluptas ut.', 'Expedita blanditiis fugit est a in culpa.', 'Ea animi quo voluptatem et facilis repellendus repudiandae.', 'Velit cum ipsa error expedita non odit voluptate.', 'b', '2023-11-17 16:28:47', '2023-11-17 16:28:47'),
	(12, 'Similique iure rerum natus velit iusto error non ducimus. Nisi blanditiis dolores molestiae quo ea. Veritatis eum temporibus dolor rerum sed doloribus voluptates eligendi. Libero voluptas sed quam sed culpa.', 'Area-9', 'Laborum voluptas sunt voluptatibus occaecati corrupti fugit.', 'Non quo itaque voluptatibus atque vitae corrupti.', 'Impedit veniam qui saepe sunt voluptatibus et.', 'Est commodi numquam ratione dignissimos ex dolor dolor.', 'b', '2023-11-17 16:28:47', '2023-11-17 16:28:47'),
	(13, 'Sequi et temporibus numquam dolores rerum non quibusdam. Ducimus voluptas id iste qui reiciendis qui quo. Dolorem vel possimus unde. Reiciendis aliquam ipsum velit ut molestias repellendus.', 'Area-2', 'Debitis et tempora fuga qui distinctio omnis.', 'Nihil qui vel ut qui.', 'Reiciendis maxime est odit maxime cupiditate sed.', 'Molestiae excepturi doloremque ipsum vitae ut dolor.', 'b', '2023-11-17 16:28:47', '2023-11-17 16:28:47'),
	(14, 'Neque a beatae tempore. Amet architecto ut in aut totam. Eius nostrum explicabo explicabo. Voluptatem similique aliquid modi soluta aliquam minima.', 'Area-1', 'Eos sint quas voluptatibus non.', 'Sit doloribus sit vitae odio atque sunt vel ea.', 'Itaque est quam rerum error.', 'Modi ut quae architecto cumque ullam.', 'a', '2023-11-17 16:28:47', '2023-11-17 16:28:47'),
	(15, 'Distinctio est nihil recusandae eius eaque laboriosam. Voluptatem sequi dolor cupiditate sunt deleniti. Autem cupiditate qui sit vel.', 'Area-3', 'Beatae qui voluptatum omnis dolores deleniti consequatur.', 'Id natus quaerat cupiditate.', 'Sit consequuntur omnis ad.', 'Molestias sapiente voluptatem ut rerum.', 'b', '2023-11-17 16:28:47', '2023-11-17 16:28:47'),
	(16, 'Sit voluptatem eligendi quisquam provident dolores. Sint aliquam rerum ut ut. Voluptatum autem eum qui asperiores. Pariatur doloribus molestiae voluptas.', 'Area-3', 'Repellat laudantium natus officia in adipisci.', 'Magni et quas voluptas ea.', 'Ea quibusdam et nobis veniam vel.', 'Dolor est magni ipsam beatae veniam.', 'b', '2023-11-17 16:28:47', '2023-11-17 16:28:47'),
	(17, 'Est delectus a saepe inventore facere assumenda nostrum. Ut voluptatem dolor at eaque molestias distinctio quam. Delectus et rerum accusamus nulla ut quam ipsum.', 'Area-2', 'Consequuntur nihil unde sint et dicta.', 'Ut enim voluptas hic porro veniam temporibus.', 'Iusto delectus recusandae et vel quasi.', 'Ut quis aut quae fuga.', 'b', '2023-11-17 16:28:47', '2023-11-17 16:28:47'),
	(18, 'Voluptatem ut ut autem aut et nemo. Molestiae est sit dolores consequuntur. Itaque quis est dicta magni.', 'Area-3', 'Reprehenderit odio quia et architecto alias dicta voluptas.', 'Cum consequatur non repellendus atque enim.', 'Tenetur et aut voluptates quae.', 'Culpa omnis rerum corrupti rerum.', 'b', '2023-11-17 16:28:47', '2023-11-17 16:28:47'),
	(19, 'Molestiae magnam animi enim reiciendis id voluptatum. Omnis quaerat accusantium nobis molestiae nostrum. Odio a soluta qui in perspiciatis dicta. Quod omnis non eaque.', 'Area-3', 'Recusandae quas laboriosam accusamus fuga voluptatem.', 'Sint voluptas et dignissimos qui delectus et.', 'Beatae cupiditate et officiis sed quia fuga consectetur.', 'Deserunt sed nihil architecto quidem sed nesciunt architecto.', 'b', '2023-11-17 16:28:47', '2023-11-17 16:28:47'),
	(20, 'Qui quam minus sed accusantium. Maiores excepturi sit vel labore et quo. Molestias quibusdam est sit animi. Voluptatibus quo minima quam.', 'Area-2', 'Delectus rerum eligendi quibusdam aut expedita cum doloribus.', 'Delectus tenetur non delectus.', 'Hic sit ipsam dolorum praesentium unde quaerat aspernatur.', 'Corrupti autem cumque nulla maiores odit quia.', 'b', '2023-11-17 16:28:47', '2023-11-17 16:28:47');

-- Dumping structure for table xcbt.tbl_soal
CREATE TABLE IF NOT EXISTS `tbl_soal` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `pertanyaan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `opsi_a` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `opsi_b` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `opsi_c` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `opsi_d` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jawaban` enum('a','b','c','d') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table xcbt.tbl_soal: ~0 rows (approximately)

-- Dumping structure for table xcbt.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table xcbt.users: ~20 rows (approximately)
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Prof. Jeremie Kuhic', 'crist.kirstin@example.org', '2023-11-17 16:22:37', '$2y$12$CCw0Mon7ZqZxEPCiDhC.Yex2xTBCEn8y8qbDTufaWZBihlRvN.aCO', NULL, NULL, NULL, 'cIMN2TkIXV', '2023-11-17 16:22:37', '2023-11-17 16:22:37'),
	(2, 'Prof. Dolly Predovic', 'macejkovic.reagan@example.net', '2023-11-17 16:22:37', '$2y$12$CCw0Mon7ZqZxEPCiDhC.Yex2xTBCEn8y8qbDTufaWZBihlRvN.aCO', NULL, NULL, NULL, 'VvJzYwcUO5', '2023-11-17 16:22:37', '2023-11-17 16:22:37'),
	(3, 'Jakayla Gerhold', 'maggio.javon@example.org', '2023-11-17 16:22:37', '$2y$12$CCw0Mon7ZqZxEPCiDhC.Yex2xTBCEn8y8qbDTufaWZBihlRvN.aCO', NULL, NULL, NULL, 'jTpNkaO7Qh', '2023-11-17 16:22:37', '2023-11-17 16:22:37'),
	(4, 'Loyce Stokes', 'felicity.hermiston@example.com', '2023-11-17 16:22:37', '$2y$12$CCw0Mon7ZqZxEPCiDhC.Yex2xTBCEn8y8qbDTufaWZBihlRvN.aCO', NULL, NULL, NULL, 'q0Qzmuy5gZ', '2023-11-17 16:22:37', '2023-11-17 16:22:37'),
	(5, 'Rhoda Gleason', 'gwatsica@example.org', '2023-11-17 16:22:37', '$2y$12$CCw0Mon7ZqZxEPCiDhC.Yex2xTBCEn8y8qbDTufaWZBihlRvN.aCO', NULL, NULL, NULL, '3vzSY9N5Qc', '2023-11-17 16:22:37', '2023-11-17 16:22:37'),
	(6, 'Andres Mohr Sr.', 'herta86@example.org', '2023-11-17 16:22:37', '$2y$12$CCw0Mon7ZqZxEPCiDhC.Yex2xTBCEn8y8qbDTufaWZBihlRvN.aCO', NULL, NULL, NULL, 'NNWdoaSuzt', '2023-11-17 16:22:37', '2023-11-17 16:22:37'),
	(7, 'Mrs. Darlene O\'Reilly IV', 'heber.fisher@example.com', '2023-11-17 16:22:37', '$2y$12$CCw0Mon7ZqZxEPCiDhC.Yex2xTBCEn8y8qbDTufaWZBihlRvN.aCO', NULL, NULL, NULL, '6LG9woQ1s2', '2023-11-17 16:22:37', '2023-11-17 16:22:37'),
	(8, 'Ole Harris', 'renner.kenny@example.org', '2023-11-17 16:22:37', '$2y$12$CCw0Mon7ZqZxEPCiDhC.Yex2xTBCEn8y8qbDTufaWZBihlRvN.aCO', NULL, NULL, NULL, 'CguHvljzwl', '2023-11-17 16:22:37', '2023-11-17 16:22:37'),
	(9, 'Mr. Charles Hintz', 'cameron.roob@example.com', '2023-11-17 16:22:37', '$2y$12$CCw0Mon7ZqZxEPCiDhC.Yex2xTBCEn8y8qbDTufaWZBihlRvN.aCO', NULL, NULL, NULL, '1OxV1bCq0y', '2023-11-17 16:22:37', '2023-11-17 16:22:37'),
	(10, 'Lurline Bogisich', 'macejkovic.kenny@example.net', '2023-11-17 16:22:37', '$2y$12$CCw0Mon7ZqZxEPCiDhC.Yex2xTBCEn8y8qbDTufaWZBihlRvN.aCO', NULL, NULL, NULL, 'h9cehEVYo6', '2023-11-17 16:22:37', '2023-11-17 16:22:37'),
	(11, 'Layla Marks', 'edgar.gorczany@example.net', '2023-11-17 16:28:47', '$2y$12$e0dYthSGWhTvpxKojnJn3.FRwAwTyAkYh6rFF//n0fuSNwuiORxK6', NULL, NULL, NULL, '9jbWg0G7S6', '2023-11-17 16:28:47', '2023-11-17 16:28:47'),
	(12, 'Rachel Brakus', 'kdavis@example.com', '2023-11-17 16:28:47', '$2y$12$e0dYthSGWhTvpxKojnJn3.FRwAwTyAkYh6rFF//n0fuSNwuiORxK6', NULL, NULL, NULL, 'RyoK8bsfKD', '2023-11-17 16:28:47', '2023-11-17 16:28:47'),
	(13, 'Colleen Thompson', 'iratke@example.org', '2023-11-17 16:28:47', '$2y$12$e0dYthSGWhTvpxKojnJn3.FRwAwTyAkYh6rFF//n0fuSNwuiORxK6', NULL, NULL, NULL, 'Cgf1NaFTsO', '2023-11-17 16:28:47', '2023-11-17 16:28:47'),
	(14, 'Jermain Brown V', 'rerdman@example.com', '2023-11-17 16:28:47', '$2y$12$e0dYthSGWhTvpxKojnJn3.FRwAwTyAkYh6rFF//n0fuSNwuiORxK6', NULL, NULL, NULL, 'rDQSfRzcbT', '2023-11-17 16:28:47', '2023-11-17 16:28:47'),
	(15, 'Tanya Schneider', 'kgorczany@example.net', '2023-11-17 16:28:47', '$2y$12$e0dYthSGWhTvpxKojnJn3.FRwAwTyAkYh6rFF//n0fuSNwuiORxK6', NULL, NULL, NULL, 'SRFYFJSXsG', '2023-11-17 16:28:47', '2023-11-17 16:28:47'),
	(16, 'Peter Harber', 'khalil48@example.org', '2023-11-17 16:28:47', '$2y$12$e0dYthSGWhTvpxKojnJn3.FRwAwTyAkYh6rFF//n0fuSNwuiORxK6', NULL, NULL, NULL, 'lRBFqDKAL5', '2023-11-17 16:28:47', '2023-11-17 16:28:47'),
	(17, 'Mrs. Gwen Ernser', 'vance.ondricka@example.org', '2023-11-17 16:28:47', '$2y$12$e0dYthSGWhTvpxKojnJn3.FRwAwTyAkYh6rFF//n0fuSNwuiORxK6', NULL, NULL, NULL, 'gGU4hb03It', '2023-11-17 16:28:47', '2023-11-17 16:28:47'),
	(18, 'Emilio Gutkowski V', 'modesto.keeling@example.com', '2023-11-17 16:28:47', '$2y$12$e0dYthSGWhTvpxKojnJn3.FRwAwTyAkYh6rFF//n0fuSNwuiORxK6', NULL, NULL, NULL, 'fVPXoJbxrz', '2023-11-17 16:28:47', '2023-11-17 16:28:47'),
	(19, 'Margaretta Franecki', 'dane49@example.net', '2023-11-17 16:28:47', '$2y$12$e0dYthSGWhTvpxKojnJn3.FRwAwTyAkYh6rFF//n0fuSNwuiORxK6', NULL, NULL, NULL, 'VIWHXDnCDl', '2023-11-17 16:28:47', '2023-11-17 16:28:47'),
	(20, 'Mrs. Magdalena Berge DDS', 'magali62@example.net', '2023-11-17 16:28:47', '$2y$12$e0dYthSGWhTvpxKojnJn3.FRwAwTyAkYh6rFF//n0fuSNwuiORxK6', NULL, NULL, NULL, 'cDURfo0QSa', '2023-11-17 16:28:47', '2023-11-17 16:28:47');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
