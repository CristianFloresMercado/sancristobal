-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-07-2025 a las 18:28:57
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sancristobalbd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_07_12_144702_create_news_table', 1),
(5, '2025_07_12_144709_create_stories_table', 1),
(6, '2025_07_12_144734_create_touristsites_table', 1),
(7, '2025_07_12_145349_create_profiles_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `news`
--

CREATE TABLE `news` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `resumen` mediumtext DEFAULT NULL,
  `imagen_destacada` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `publicado` tinyint(1) NOT NULL DEFAULT 0,
  `autor` varchar(255) DEFAULT NULL,
  `fuente` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `news`
--

INSERT INTO `news` (`id`, `titulo`, `resumen`, `imagen_destacada`, `user_id`, `publicado`, `autor`, `fuente`, `created_at`, `updated_at`) VALUES
(1, 'asdfsadfasdfasdfas', NULL, 'news/ERXiJ7l1pb4WIrZqqxKsRz08C3MW4DbchzaoCPmq.png\r\n\r\n', 1, 0, NULL, NULL, '2025-07-15 23:55:16', '2025-07-15 23:55:16'),
(2, 'asdfsadfasdfasdfas', NULL, 'news/ERXiJ7l1pb4WIrZqqxKsRz08C3MW4DbchzaoCPmq.png\r\n', 1, 0, NULL, NULL, '2025-07-17 02:24:19', '2025-07-17 02:24:19'),
(3, 'asdfsadfasdfasdfas', NULL, 'news/ERXiJ7l1pb4WIrZqqxKsRz08C3MW4DbchzaoCPmq.png\r\n\r\n', 1, 0, NULL, NULL, '2025-07-17 02:26:24', '2025-07-17 02:26:24'),
(4, 'prueba aletr', NULL, 'news/ERXiJ7l1pb4WIrZqqxKsRz08C3MW4DbchzaoCPmq.png\r\n\r\n', 1, 0, NULL, NULL, '2025-07-18 00:51:38', '2025-07-18 00:51:38'),
(5, 'fasdfsad', NULL, 'news/ERXiJ7l1pb4WIrZqqxKsRz08C3MW4DbchzaoCPmq.png\r\n\r\n', 1, 0, NULL, NULL, '2025-07-18 00:52:01', '2025-07-18 00:52:01'),
(6, '123', '<td class=\"px-6 py-4\">\r\n                            {{$item->fuente}}\r\n                        </td><td class=\"px-6 py-4\">\r\n                            {{$item->fuente}}\r\n                        </td><td class=\"px-6 py-4\">\r\n                            {{$item->fuente}}\r\n                        </td><td class=\"px-6 py-4\">\r\n                            {{$item->fuente}}\r\n                        </td><td class=\"px-6 py-4\">\r\n                            {{$item->fuente}}\r\n                        </td>\r\nsadfsadlkflksadjf', 'news/ERXiJ7l1pb4WIrZqqxKsRz08C3MW4DbchzaoCPmq.png\r\n', 1, 1, 'asdfsad', 'asdfas', '2025-07-18 02:31:34', '2025-07-18 02:31:34'),
(7, 'asdfsadfasdfasdfas', 'La historia de San Cristóbal se remonta a tiempos precolombinos (1584, según documentos de creación), cuando la zona estaba habitada por diferentes etnias indígenas, como los Lliphi y los Quechuas. Durante la colonización hispana, la región de los Lípez fue incorporada al Virreinato del Perú y posteriormente al Virreinato del Río de la Plata. Los colonizadores españoles establecieron una serie de asentamientos en la zona, incluyendo la actual San Cristóbal , que se convirtió en un  relevante centro administrativo.', 'news/ERXiJ7l1pb4WIrZqqxKsRz08C3MW4DbchzaoCPmq.png\r\n', 1, 1, 'qwerrew', 'qwer', '2025-07-18 02:33:58', '2025-07-18 02:33:58'),
(8, 'sadf', 'asdfasdfsadfsadfasdfasdfsadfsadfsadfsad', 'news/ERXiJ7l1pb4WIrZqqxKsRz08C3MW4DbchzaoCPmq.png\r\n', 1, 0, 'asdf', 'asdf', '2025-07-18 02:39:37', '2025-07-18 02:39:37'),
(9, 'afsdf', 'asdffffffffffffffffffffffffasdffffffffffffffffffffffffasdffffffffffffffffffffffffasdffffffffffffffffffffffffasdffffffffffffffffffffffffasdffffffffffffffffffffffff', 'news/ERXiJ7l1pb4WIrZqqxKsRz08C3MW4DbchzaoCPmq.png\r\n', 1, 0, 'fdsfsdf', 'fadsfsd', '2025-07-22 05:35:10', '2025-07-22 05:35:10'),
(10, 'asdffasd', 'asdfsafsdfasdfsafasdfasdfsafsdfasdfsafasdfasdfsafsdfasdfsafasdfasdfsafsdfasdfsafasdfasdfsafsdfasdfsafasdfasdfsafsdfasdfsafasdfasdfsafsdfasdfsafasdfasdfsafsdfasdfsafasdf', 'news/ERXiJ7l1pb4WIrZqqxKsRz08C3MW4DbchzaoCPmq.png\r\n', 1, 0, 'asdfsad', 'asdfsadf', '2025-07-24 03:23:02', '2025-07-24 03:23:02'),
(11, 'fasd', 'asdfasdfsadsda fa sdfasd fasdf asda sdf asdfasdf asdf asdf asdf asd fasdf sadf saf a', 'news/ERXiJ7l1pb4WIrZqqxKsRz08C3MW4DbchzaoCPmq.png', 1, 1, 'afsdf', 'dfasdf', '2025-07-24 03:26:58', '2025-07-24 03:26:58');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profiles`
--

CREATE TABLE `profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre_comunidad` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `alcalde` varchar(255) DEFAULT NULL,
  `telefono_municipal` varchar(255) DEFAULT NULL,
  `direccion_municipal` varchar(255) DEFAULT NULL,
  `hospital_principal` varchar(255) DEFAULT NULL,
  `direccion_hospital` varchar(255) DEFAULT NULL,
  `telefono_hospital` varchar(255) DEFAULT NULL,
  `telefono_bomberos` varchar(255) DEFAULT NULL,
  `telefono_policia` varchar(255) DEFAULT NULL,
  `telefono_emergencia` varchar(255) DEFAULT NULL,
  `horarios_atencion` text DEFAULT NULL,
  `enlaces_utiles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`enlaces_utiles`)),
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
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
-- Volcado de datos para la tabla `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('jbFQBXUlNddTXw2UdzJLJFNNNB6nEgaR1KZepsGR', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiMzZJT1dMN1VabXJ4Z0t4SzdJQ2E4Y3dwNzVPOW82SlY4QVJlMmxkaCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9uZXdzLzEvZWRpdCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1753315639);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stories`
--

CREATE TABLE `stories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `resumen` mediumtext DEFAULT NULL,
  `imagen_destacada` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `publicado` tinyint(1) NOT NULL DEFAULT 0,
  `año_ocurrido` int(11) DEFAULT NULL,
  `personajes` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `touristsites`
--

CREATE TABLE `touristsites` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `resumen` mediumtext DEFAULT NULL,
  `imagen_destacada` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `publicado` tinyint(1) NOT NULL DEFAULT 0,
  `ubicacion` varchar(255) NOT NULL,
  `coordenadas` varchar(255) DEFAULT NULL,
  `horario` text DEFAULT NULL,
  `galeria_imagenes` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`galeria_imagenes`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'cristian', 'cristianfloresmer@gmail.com', NULL, '$2y$12$M6uoCLPhdou.urm1XRjAue9tqV697nBtm.WPWqpJYrkHjqvsvBj9u', NULL, '2025-07-15 23:54:45', '2025-07-15 23:54:45');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indices de la tabla `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `news_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profiles_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indices de la tabla `stories`
--
ALTER TABLE `stories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stories_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `touristsites`
--
ALTER TABLE `touristsites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `touristsites_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `news`
--
ALTER TABLE `news`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `stories`
--
ALTER TABLE `stories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `touristsites`
--
ALTER TABLE `touristsites`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `profiles`
--
ALTER TABLE `profiles`
  ADD CONSTRAINT `profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `stories`
--
ALTER TABLE `stories`
  ADD CONSTRAINT `stories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `touristsites`
--
ALTER TABLE `touristsites`
  ADD CONSTRAINT `touristsites_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
