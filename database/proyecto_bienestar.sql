-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-10-2017 a las 01:29:02
-- Versión del servidor: 10.1.25-MariaDB
-- Versión de PHP: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto_bienestar`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `apprentices`
--

CREATE TABLE `apprentices` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre_completo` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo_documento` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero_documento` int(10) UNSIGNED NOT NULL,
  `direccion` varchar(91) COLLATE utf8mb4_unicode_ci NOT NULL,
  `barrio` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estrato` smallint(6) NOT NULL,
  `telefono` bigint(20) DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `programa_formacion` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero_ficha` int(11) NOT NULL,
  `jornada` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pregunta1` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `pregunta2` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `pregunta3` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `otro_apoyo` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `compromiso_informar` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT 'no',
  `compromiso_normas` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT 'no',
  `justificacion_suplemento` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `novedad_solicitud` longtext COLLATE utf8mb4_unicode_ci,
  `estado_beneficio` tinyint(1) DEFAULT NULL,
  `estado_solicitud` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `history_records`
--

CREATE TABLE `history_records` (
  `id` int(10) UNSIGNED NOT NULL,
  `apprentice_id` int(10) UNSIGNED NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_table_users', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2017_08_19_232302_create_table_apprentices', 1),
(4, '2017_08_19_235052_create_table_history_records', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrador del sistema', 'admin@bienestar.com', '$2y$10$FVeE8Cc9IcxgOVbIvy4.1OdX7/YYBTIhOhZU8gJiYCJs488sygLrG', NULL, '2017-10-08 23:28:15', '2017-10-08 23:28:15');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `apprentices`
--
ALTER TABLE `apprentices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `apprentices_numero_documento_unique` (`numero_documento`),
  ADD UNIQUE KEY `apprentices_email_unique` (`email`);

--
-- Indices de la tabla `history_records`
--
ALTER TABLE `history_records`
  ADD PRIMARY KEY (`id`),
  ADD KEY `history_records_apprentice_id_foreign` (`apprentice_id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

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
-- AUTO_INCREMENT de la tabla `apprentices`
--
ALTER TABLE `apprentices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `history_records`
--
ALTER TABLE `history_records`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `history_records`
--
ALTER TABLE `history_records`
  ADD CONSTRAINT `history_records_apprentice_id_foreign` FOREIGN KEY (`apprentice_id`) REFERENCES `apprentices` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
