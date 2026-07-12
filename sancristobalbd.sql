-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-07-2025 a las 20:48:07
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
(1, 'Desarrollo social fortalece a familias vulnerables', 'Organizaciones sociales trabajan para mejorar las condiciones de vida de las familias más necesitadas.', 'news/BPn1EINS6NFHZ95zSoI7jOSc7P59fvn7CDxLU70b.jpg', 1, 1, 'Desarrollo Social', 'Fundación Social', '2025-07-25 18:35:05', '2025-07-25 18:39:52'),
(2, 'Nuevas inversiones impulsan la minería local', 'Importantes empresas han decidido invertir en la minería, generando nuevas oportunidades para la población.', 'news/', 1, 0, 'Equipo Minero Local', 'Agencia Minera', '2025-07-25 18:35:05', '2025-07-25 18:39:47'),
(3, 'Nuevas inversiones impulsan la minería local', 'Importantes empresas han decidido invertir en la minería, generando nuevas oportunidades para la población.', 'news/', 1, 0, 'Equipo Minero Local', 'Agencia Minera', '2025-07-25 18:35:05', '2025-07-25 18:39:42'),
(4, 'Avances tecnológicos llegan a la comunidad', 'La llegada de tecnología de punta promete modernizar distintos sectores productivos y educativos.', 'news/', 1, 0, 'Tecnología Hoy', 'Noticias Tecnológicas', '2025-07-25 18:35:05', '2025-07-25 18:35:05'),
(5, 'Desarrollo social fortalece a familias vulnerables', 'Organizaciones sociales trabajan para mejorar las condiciones de vida de las familias más necesitadas.', 'news/VaB1v447oTgSDaRroty5UQ31AePrZeTsFLc6cQ0y.jpg', 1, 1, 'Desarrollo Social', 'Fundación Social', '2025-07-25 18:35:05', '2025-07-25 18:39:36'),
(6, 'Desarrollo social fortalece a familias vulnerables', 'Organizaciones sociales trabajan para mejorar las condiciones de vida de las familias más necesitadas.', 'news/VcG1tu5BmWx7Cz7S9rkMzOzJ3ADcjj6i9bjC182J.jpg', 1, 1, 'Desarrollo Social', 'Fundación Social', '2025-07-25 18:35:05', '2025-07-25 18:39:29'),
(7, 'Nuevas inversiones impulsan la minería local', 'Importantes empresas han decidido invertir en la minería, generando nuevas oportunidades para la población.', 'news/SXIhOJoMFmJP7lvrNu8qnLyVUPxF9XWzYCOL6ZJE.jpg', 1, 1, 'Equipo Minero Local', 'Agencia Minera', '2025-07-25 18:35:05', '2025-07-25 21:57:08');

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
  `enlaces_utiles` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `profiles`
--

INSERT INTO `profiles` (`id`, `nombre_comunidad`, `descripcion`, `alcalde`, `telefono_municipal`, `direccion_municipal`, `hospital_principal`, `direccion_hospital`, `telefono_hospital`, `telefono_bomberos`, `telefono_policia`, `telefono_emergencia`, `horarios_atencion`, `enlaces_utiles`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'San Cristóbal c', 'Comunidad minera con gran riqueza cultural.', 'Juan Pérez', '591-2620000', 'Av. Principal N° 123', 'Hospital San Cristóbal', 'Calle Salud N° 456', '591-2620011', '591-2620022', '591-2620033', '911', 'Lunes a Viernes de 08:00 a 16:00', 'https://sancristobal.bo', 1, '2025-07-25 18:35:05', '2025-07-25 20:09:05');

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
('gyPvLBUFx6FvHWqjFmHWYYsaif24jCjRqhiSTdWi', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiYk8xTXRLeE9RZVRLVGVHYmp6Nk0zcXBERExRUktucG80Z2cwbGIwUCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9zdG9yaWVzIjt9czozOiJ1cmwiO2E6MDp7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1753468842);

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

--
-- Volcado de datos para la tabla `stories`
--

INSERT INTO `stories` (`id`, `titulo`, `resumen`, `imagen_destacada`, `user_id`, `publicado`, `año_ocurrido`, `personajes`, `created_at`, `updated_at`) VALUES
(1, 'La Evolución de la Cultura Regional', 'Se exploran las raíces culturales y la evolución de las tradiciones que hacen única a San Cristóbal.', 'historias/TZfpuKl3v247QJwMZQfkCDMPwXcg9Pt8kAEKOO5x.jpg', 1, 0, 1970, 'Miguel Torres, Rosa Jiménez', '2025-07-25 18:35:05', '2025-07-25 22:40:42'),
(2, 'Anécdotas de la Época Colonial', 'Anécdotas y testimonios que reflejan la vida cotidiana durante la época colonial en San Cristóbal.', 'historias/P33h8gFdKg40uFx6wlfgGoBLPVOoML4plHpPGzQQ.jpg', 1, 0, 1970, 'Alberto Navarro, Sofía Flores', '2025-07-25 18:35:05', '2025-07-25 22:40:33'),
(3, 'El Descubrimiento de San Cristóbal', 'En este relato detallamos el descubrimiento de San Cristóbal y cómo influyó en la historia local y regional.', 'historias/IfffKJbwN32cRDKDQjCyvoC4LflUYynipafZoOxY.jpg', 1, 0, 1970, 'Don José Martínez, María López', '2025-07-25 18:35:05', '2025-07-25 22:40:24'),
(4, 'Un Viaje al Pasado Minero', 'Un recorrido por los eventos más importantes que definieron la minería en la región.', 'historias/sOueuiMAq2WgA3DU3VOchEIohKqYGc869zxI8xsM.jpg', 1, 1, 1970, 'Jorge Ramírez, Elena Castro', '2025-07-25 18:35:05', '2025-07-25 18:39:01'),
(5, 'La Evolución de la Cultura Regional', 'Se exploran las raíces culturales y la evolución de las tradiciones que hacen única a San Cristóbal.', 'historias/H6V2OSJt4vGdY3mZ8OrzNgUX0Vp4KfeKKtsq0GD4.jpg', 1, 1, 1970, 'Miguel Torres, Rosa Jiménez', '2025-07-25 18:35:05', '2025-07-25 18:38:55'),
(6, 'La Fundación de Nuestra Comunidad', 'Una historia sobre los primeros habitantes y la fundación oficial de la comunidad con datos históricos relevantes.', 'historias/l5NKPMdf6IWsA1SGa9MtPEJ4aaUyLhYSeAaDHpsD.jpg', 1, 1, 1970, 'Juan Pérez, Ana Gómez', '2025-07-25 18:35:05', '2025-07-25 18:38:48'),
(7, 'El Rol de los Personajes Legendarios', 'Personajes que marcaron la historia local con su liderazgo, valentía y compromiso con el pueblo.', 'historias/dOMU53xC6T721jNBe1c8FMWyRR8Ufn2SMIcxpy53.jpg', 1, 1, 1970, 'Luis Herrera, Paula Mendoza', '2025-07-25 18:35:05', '2025-07-25 18:38:39');

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `touristsites`
--

INSERT INTO `touristsites` (`id`, `titulo`, `resumen`, `imagen_destacada`, `user_id`, `publicado`, `ubicacion`, `coordenadas`, `horario`, `created_at`, `updated_at`) VALUES
(1, 'afsdfasdf', 'sdfasdfasdfsadfsañdlkfaslkñdfljkas', 'sitios/ndrzGyWgy0JOmVFVhpBIABa32USx3rWXCDmFiRxF.jpg', 1, 1, 'asdfasdfasdf', 'afsdfasdfasdfasdfasd', 'asdfasdfasda', '2025-07-25 18:37:35', '2025-07-25 18:37:35'),
(2, 'ejmeposodfa', 'asdfasdfasdfasdafgafdlkñsjaflsjdlfkasldkfjlaksdjfñlkasd', 'sitios/rtAxiZSbrIcrmsC38NBgjKbabmbWYHUxCa4Kh97S.jpg', 1, 1, 'fasdfasdf', 'asdfasdf', 'fasdfasdfasdfa', '2025-07-25 18:38:29', '2025-07-25 18:38:29');

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
(1, 'Cristian', 'Cristianfloresmer@gmail.com', '2025-07-25 18:35:05', '$2y$12$lhAqpsRiPmv2flQHmC2Cx.DiU6zf18SqhT15RosiibmlYxhGSZ9Yi', 'rCbZQjdqFVSpRU4WjMcUvDbxps4gpqWtFzpmM0lXwBAnPUXtlrkcdvNpumVs', '2025-07-25 18:35:05', '2025-07-25 18:35:05');

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `stories`
--
ALTER TABLE `stories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `touristsites`
--
ALTER TABLE `touristsites`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
