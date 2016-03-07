-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-09-2015 a las 20:27:40
-- Versión del servidor: 5.6.25
-- Versión de PHP: 5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `alessandro`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `id` int(11) NOT NULL,
  `name` varchar(100) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `clients`
--

INSERT INTO `clients` (`id`, `name`) VALUES
(1, 'Jhon Dopler'),
(2, 'Fabio Cannavaro'),
(3, 'Paolo Maldini'),
(4, 'Andrea Pirlo'),
(5, 'Luca Toni'),
(6, 'Filippo Inzaghi'),
(7, 'Cristian Zaccardo'),
(8, 'Mauro Camoranesi'),
(9, 'Alessandro Del Piero'),
(10, 'Alessandro Nesta'),
(11, 'Christian Panucci');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientsxmachines`
--

CREATE TABLE IF NOT EXISTS `clientsxmachines` (
  `id` int(11) NOT NULL,
  `machine_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `clientsxmachines`
--

INSERT INTO `clientsxmachines` (`id`, `machine_id`, `client_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 2, 2),
(5, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `machines`
--

CREATE TABLE IF NOT EXISTS `machines` (
  `id` int(11) NOT NULL,
  `name` varchar(100) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `machines`
--

INSERT INTO `machines` (`id`, `name`) VALUES
(1, 'Machine 1'),
(2, 'Machine 2'),
(3, 'Machine 3'),
(4, 'Machine 4');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tasks`
--

CREATE TABLE IF NOT EXISTS `tasks` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `machine_id` int(11) NOT NULL,
  `start` datetime NOT NULL,
  `finish` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tasks`
--

INSERT INTO `tasks` (`id`, `client_id`, `machine_id`, `start`, `finish`) VALUES
(3, 1, 1, '2015-09-10 12:45:42', '2015-09-10 00:00:00'),
(4, 1, 1, '2015-09-10 12:59:05', '2015-09-10 13:05:43'),
(5, 1, 1, '2015-09-10 13:07:07', '2015-09-10 13:07:09'),
(6, 1, 1, '2015-09-10 13:13:48', '2015-09-10 13:13:54'),
(7, 1, 1, '2015-09-10 13:13:57', '2015-09-10 13:13:58'),
(8, 1, 1, '2015-09-10 13:19:00', '2015-09-10 13:20:00'),
(9, 1, 2, '2015-09-10 13:19:47', '2015-09-10 13:19:50'),
(10, 1, 2, '2015-09-10 13:19:51', '2015-09-10 13:19:55'),
(11, 6, 1, '2015-09-10 13:26:25', '2015-09-13 00:21:17'),
(12, 3, 1, '2015-09-10 13:26:26', '2015-09-10 13:26:31'),
(13, 1, 1, '2015-09-10 13:26:30', '2015-09-12 22:41:56'),
(14, 3, 1, '2015-09-10 13:26:52', '2015-09-10 13:26:57'),
(15, 4, 1, '2015-09-10 13:26:54', '2015-09-12 22:42:00'),
(16, 5, 1, '2015-09-10 13:26:55', '2015-09-10 13:26:59'),
(17, 4, 2, '2015-09-10 13:27:06', '2015-09-13 00:00:29'),
(18, 9, 2, '2015-09-10 13:27:07', '2015-09-10 13:27:11'),
(19, 1, 2, '2015-09-10 13:27:08', '2015-09-12 23:58:07'),
(20, 11, 2, '2015-09-10 13:27:09', '2015-09-11 23:45:17'),
(21, 4, 2, '2015-09-13 00:23:55', '2015-09-13 00:23:57'),
(22, 7, 2, '2015-09-13 00:23:59', '2015-09-13 00:24:01'),
(23, 10, 2, '2015-09-11 00:24:25', '2015-09-12 00:39:44'),
(24, 6, 2, '2015-09-11 00:24:27', '2015-09-11 00:24:33'),
(25, 2, 2, '2015-09-11 00:24:30', '2015-09-12 00:39:36'),
(26, 1, 2, '2015-09-11 00:24:30', '2015-09-12 00:25:15'),
(27, 9, 2, '2015-09-12 00:39:47', '2015-09-13 20:43:38'),
(28, 4, 2, '2015-09-12 00:39:49', '2015-09-12 00:41:12'),
(29, 10, 2, '2015-09-12 00:41:08', '2015-09-12 00:41:10'),
(30, 6, 2, '2015-09-12 00:41:15', '2015-09-13 20:43:36'),
(31, 4, 1, '2015-09-12 22:42:01', '2015-09-12 22:48:04'),
(32, 1, 1, '2015-09-12 22:42:03', '2015-09-12 22:46:32'),
(33, 9, 1, '2015-09-12 22:48:02', '2015-09-12 23:56:50'),
(34, 9, 1, '2015-09-12 23:57:42', '2015-09-13 00:13:32'),
(35, 11, 1, '2015-09-13 00:13:34', '2015-09-13 00:18:43'),
(36, 2, 1, '2015-09-13 00:13:35', '2015-09-13 00:21:15'),
(37, 1, 1, '2015-09-13 00:13:36', '2015-09-13 00:18:09'),
(38, 1, 1, '2015-09-13 00:18:45', '2015-09-13 17:21:04'),
(39, 11, 1, '2015-09-13 00:21:19', '2015-09-13 00:23:37'),
(40, 5, 1, '2015-09-13 00:21:20', '2015-09-16 19:22:37'),
(41, 2, 1, '2015-09-13 00:23:42', '2015-09-13 19:22:00'),
(42, 4, 1, '2015-09-13 00:23:44', '2015-09-13 17:20:05'),
(43, 10, 1, '2015-09-13 17:20:57', '2015-09-16 19:22:35'),
(44, 11, 1, '2015-09-13 19:21:57', '2015-09-16 19:22:32'),
(45, 2, 2, '2015-09-13 20:43:40', '2015-09-13 20:43:43'),
(46, 2, 2, '2015-09-13 20:43:48', '2015-09-13 20:43:52'),
(47, 2, 1, '2015-09-13 21:52:46', '2015-09-14 08:36:29'),
(48, 3, 1, '2015-09-13 21:52:47', '2015-09-14 08:36:14'),
(49, 2, 1, '2015-09-14 10:08:19', '2015-09-14 10:08:30'),
(50, 3, 1, '2015-09-14 10:12:31', '2015-09-14 10:13:05'),
(51, 2, 1, '2015-09-14 11:29:30', '2015-09-14 11:30:21');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clientsxmachines`
--
ALTER TABLE `clientsxmachines`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `machines`
--
ALTER TABLE `machines`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `clientsxmachines`
--
ALTER TABLE `clientsxmachines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `machines`
--
ALTER TABLE `machines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=58;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
