-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 01. Nov 2022 um 23:35
-- Server-Version: 10.4.25-MariaDB
-- PHP-Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `parkplatzverwaltung`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `cars`
--

CREATE TABLE `cars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sign` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `manufacturer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `cars`
--

INSERT INTO `cars` (`id`, `sign`, `manufacturer`, `model`, `color`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'K GT 9401', 'Ford', 'Mustang', 'red', 'K GT 9401.jpg', '1', '2022-11-01 16:41:24', '2022-11-01 16:41:24'),
(2, 'WSF T 48', 'Trabant', 'S500', 'grey', 'WSF T 48.jpg', '1', '2022-11-01 16:44:59', '2022-11-01 16:44:59'),
(3, 'LEV M 635', 'Mazda', '6', 'red', 'LEV M 635.jpg', '1', '2022-11-01 16:46:01', '2022-11-01 16:46:01'),
(4, 'S LK 7040', 'Mercedes', 'SLK 500', 'silver', 'S LK 7040.jpg', '1', '2022-11-01 16:47:36', '2022-11-01 16:47:36'),
(5, 'K OE 3838', 'Toyota', 'Avensis T270', 'Silver', 'K OE 3838.jpg', '1', '2022-11-01 16:49:39', '2022-11-01 16:49:39'),
(6, 'M NM 750', 'BMW', 'E38', 'black', 'M NM 750.jpg', '1', '2022-11-01 16:51:15', '2022-11-01 16:51:15'),
(7, 'HN R 8333', 'Audi', 'R8', 'silver', 'HN R 8333.jpg', '1', '2022-11-01 16:52:35', '2022-11-01 16:52:35'),
(8, 'WOB GO 817', 'VW', 'Golf 8', 'green', 'WOB GO 817.jpg', '1', '2022-11-01 16:53:34', '2022-11-01 16:53:34');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `failed_jobs`
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
-- Tabellenstruktur für Tabelle `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_10_29_134059_create_car_table', 1),
(6, '2022_10_30_135423_create_parking_spots_table', 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `parking_spots`
--

CREATE TABLE `parking_spots` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `row` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `parking_spots`
--

INSERT INTO `parking_spots` (`id`, `number`, `row`, `image`, `status`, `created_at`, `updated_at`) VALUES
(14, '1', '1', 'frei.jpg', 'frei', '2022-11-01 21:07:08', '2022-11-01 21:07:08'),
(15, '2', '2', 'frei.jpg', 'frei', '2022-11-01 21:07:10', '2022-11-01 21:07:10'),
(16, '3', '2', 'frei.jpg', 'frei', '2022-11-01 21:07:11', '2022-11-01 21:07:11'),
(17, '4', '2', 'electro.jpg', 'electro', '2022-11-01 21:07:13', '2022-11-01 21:07:13'),
(18, '5', '3', 'besetzt.jpg', 'besetzt', '2022-11-01 21:07:18', '2022-11-01 21:07:18'),
(19, '6', '3', 'besetzt.jpg', 'besetzt', '2022-11-01 21:07:22', '2022-11-01 21:07:22'),
(20, '7', '3', 'gesperrt.jpg', 'gesperrt', '2022-11-01 21:07:27', '2022-11-01 21:07:27'),
(21, '8', '4', 'electro.jpg', 'electro', '2022-11-01 21:07:32', '2022-11-01 21:07:32'),
(22, '9', '4', 'frei.jpg', 'frei', '2022-11-01 21:07:37', '2022-11-01 21:07:37'),
(23, '10', '4', 'Behindertenparkplatz.jpg', 'Behindertenparkplatz', '2022-11-01 21:07:40', '2022-11-01 21:07:40'),
(24, '11', '5', 'Behindertenparkplatz.jpg', 'Behindertenparkplatz', '2022-11-01 21:07:42', '2022-11-01 21:07:42'),
(25, '12', '5', 'gesperrt.jpg', 'gesperrt', '2022-11-01 21:08:00', '2022-11-01 21:08:00');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `image`, `telefon`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Dylan Morgan', 'dylan.morgan@example.com', '2022-11-01 16:54:59', 'password', 'Dylan Morgan.jpg', '(0590) 661-5087', 'user', 'token_', '2022-11-01 16:54:59', '2022-11-01 16:54:59'),
(2, 'Levi Hawkins', 'levi.hawkins@example.com', '2022-11-01 16:55:38', 'password', 'Levi Hawkins.jpg', '(0402) 502-5438', 'user', 'token_', '2022-11-01 16:55:38', '2022-11-01 16:55:38'),
(3, 'Manuel Grant', 'manuel.grant@example.com', '2022-11-01 16:56:20', 'password', 'Manuel Grant.jpg', '(0246) 940-2723', 'user', 'token_', '2022-11-01 16:56:20', '2022-11-01 16:56:20'),
(4, 'Jerome Barrett', 'jerome.barrett@example.com', '2022-11-01 16:57:01', 'password', 'Jerome Barrett.jpg', '(0308) 383-4187', 'user', 'token_', '2022-11-01 16:57:01', '2022-11-01 16:57:01'),
(5, 'Sharlene Snyder', 'sharlene.snyder@example.com', '2022-11-01 17:03:30', 'password', 'Sharlene Snyder.jpg', '(0526) 498-5741', 'user', 'token_', '2022-11-01 17:03:30', '2022-11-01 17:03:30'),
(6, 'Marcus Walters', 'marcus.walters@example.com', '2022-11-01 17:04:09', 'password', 'Marcus Walters.jpg', 'marcus.walters@example.com', 'user', 'token_', '2022-11-01 17:04:09', '2022-11-01 17:04:09'),
(7, 'Gladys Black', 'gladys.black@example.com', '2022-11-01 17:05:26', 'password', 'Gladys Black.jpg', '(^0498) 372-1747', 'user', 'token_', '2022-11-01 17:05:26', '2022-11-01 17:05:26'),
(8, 'Mathew Myers', 'mathew.myers@example.com', '2022-11-01 17:06:31', 'password', 'Mathew Myers.jpg', '(0539) 511-8514', 'user', 'token_', '2022-11-01 17:06:31', '2022-11-01 17:06:31');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indizes für die Tabelle `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `parking_spots`
--
ALTER TABLE `parking_spots`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indizes für die Tabelle `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `cars`
--
ALTER TABLE `cars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT für Tabelle `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT für Tabelle `parking_spots`
--
ALTER TABLE `parking_spots`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT für Tabelle `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
