-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-06-2022 a las 19:27:55
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `incidencias`
--
CREATE DATABASE IF NOT EXISTS `incidencias` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `incidencias`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aulas`
--

DROP TABLE IF EXISTS `aulas`;
CREATE TABLE `aulas` (
  `id` bigint(20) NOT NULL,
  `aula` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `aulas`
--

INSERT INTO `aulas` (`id`, `aula`) VALUES
(1, '1º ESO'),
(2, '2º ESO'),
(3, '3º ESO'),
(4, '4º ESO'),
(5, 'CFGM - Sistemas Microinformáticos y Redes'),
(6, 'CFGM - Electromecánica de Vehículos Automóviles'),
(7, 'CFGM - Gestión Administrativa'),
(8, 'CFGM - Instalaciones Eléctricas y Automáticas'),
(9, 'CFGM - Atención a Personas en Situación de Dependencia'),
(10, 'CFGS - Administración de Sistemas Informáticos en Red'),
(11, 'CFGS - Desarrollo de Aplicaciones Web'),
(12, 'CFGS - Sistemas de Telecomunicación e Informáticos'),
(13, 'CFGS - Animación Sociocultural y Turística'),
(14, 'CFGS - Mediación Comunicativa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `id` bigint(20) NOT NULL,
  `id_incidencia` bigint(20) NOT NULL,
  `id_user` bigint(20) NOT NULL,
  `comment` text NOT NULL,
  `comment_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `comments`
--

INSERT INTO `comments` (`id`, `id_incidencia`, `id_user`, `comment`, `comment_date`) VALUES
(1, 1, 4, 'Buenos días.\r\n\r\nSe ha contactado con el alumno al que le faltaba un equipo en clase.\r\n\r\nInsiste en usar su propio portátil, por mucho que se le diga que use el ordenador de clase.\r\n\r\nHablaré con él para que deje de traer el portátil de una vez.', '2022-02-09 08:27:42'),
(2, 1, 1, 'Buenas tardes,\r\n\r\nGracias por su rápida respuesta, estaré a la espera de la resolución de la incidencia.\r\n\r\nUn saludo.', '2022-02-09 13:34:18'),
(3, 1, 4, 'Buenas tardes.\r\n\r\nDisculpe la gran demora pero el alumno finalmente ha dejado de traer su portátil para usar el equipo de clase.\r\n\r\nDejaré la incidencia abierta un par de días en caso que surgiera algún otro problema antes de cerrarla.\r\n', '2022-03-12 12:56:25'),
(8, 87, 18, 'Buenas, acabo de revisar tu incidencia. \r\n\r\nMañana mismo me pasaré yo mismo a echar un ojo, en caso que no tenga solución, traeré un equipo extra para las presentaciones.\r\n\r\nUn saludo.', '2022-06-20 01:10:46'),
(10, 87, 19, 'Está bien, me quedaré a la espera a que se solucione, pero, una vez más, pido que se solucione con la mayor brevedad posible.', '2022-06-20 01:11:23'),
(11, 2, 1, 'Buenos días, acabo de leer tu incidencia y disculpa la gran demora que ha habido.\r\n\r\nEl blog por lo visto ha estado en mantenimiento durante todo este tiempo, por lo que no podemos estimar un tiempo exacto de cuando esté solucionado.\r\n\r\nDisculpa las molestias.', '2022-06-20 09:46:59');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `incidencia`
--

DROP TABLE IF EXISTS `incidencia`;
CREATE TABLE `incidencia` (
  `id_incidencia` bigint(20) NOT NULL,
  `id_user` bigint(20) NOT NULL,
  `id_aula` bigint(20) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT current_timestamp(),
  `update_date` datetime DEFAULT NULL,
  `close_date` datetime DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `state` enum('new','open','closed') NOT NULL DEFAULT 'new'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `incidencia`
--

INSERT INTO `incidencia` (`id_incidencia`, `id_user`, `id_aula`, `create_date`, `update_date`, `close_date`, `title`, `description`, `state`) VALUES
(1, 1, 11, '2022-02-08 14:19:00', '2022-06-20 07:43:46', '2022-06-20 07:42:15', 'Ausencia de ordenadores', 'A uno de los alumnos le falta un ordenador. Aunque el alumno se trae su propio portátil, debería usar uno de los equipos del centro.', 'closed'),
(2, 2, 4, '2022-03-29 18:34:20', '2022-06-20 07:45:15', NULL, 'Imposible acceso al Blog!', 'Buenas tardes.\r\n\r\nMe he fijado que estando en la página del centro, he intentado acceder al blog que viene en la página.\r\n\r\nSe queda cargando durante mucho tiempo y al final no carga nada.', 'open'),
(87, 19, 5, '2022-06-20 01:07:35', NULL, NULL, 'Fallo en el equipo', 'Buenas tardes,\r\n\r\nHe estado revisando el equipo para la presentación que habrá en unos días  y al parecer no parece encender de ninguna manera.\r\n\r\nHe comprobado si estaba cada cable en su lugar, pero al parecer está todo en orden. Desconozco la causa y es necesario que esté en funcionamiento para este martes.', 'open');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `story_state`
--

DROP TABLE IF EXISTS `story_state`;
CREATE TABLE `story_state` (
  `id` bigint(20) NOT NULL,
  `id_incidencia` bigint(20) NOT NULL,
  `state` enum('new','open','closed','new_incidence') NOT NULL,
  `story_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `story_state`
--

INSERT INTO `story_state` (`id`, `id_incidencia`, `state`, `story_date`) VALUES
(1, 1, 'new', '2022-02-08 14:19:00'),
(2, 1, 'open', '2022-02-09 08:23:24'),
(3, 1, 'closed', '2022-03-14 13:43:50'),
(4, 2, 'new', '2022-03-29 18:34:20'),
(13, 87, 'new', '2022-06-20 01:07:35'),
(14, 87, 'open', '2022-06-20 01:09:48'),
(23, 1, 'open', '2022-06-20 09:38:56'),
(24, 1, 'closed', '2022-06-20 09:42:15'),
(25, 2, 'open', '2022-06-20 09:45:15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` varchar(255) NOT NULL DEFAULT 'user',
  `validated` enum('true','false') NOT NULL DEFAULT 'false',
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `dni` varchar(9) NOT NULL,
  `tel` int(9) DEFAULT NULL,
  `gender` enum('M','F','O') DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `last_update` datetime DEFAULT NULL,
  `create_date` datetime NOT NULL DEFAULT current_timestamp(),
  `notify_email` enum('true','false') NOT NULL DEFAULT 'true'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `rol`, `validated`, `first_name`, `last_name`, `dni`, `tel`, `gender`, `last_login`, `last_update`, `create_date`, `notify_email`) VALUES
(1, 'juan.garrido.jimenez.al@iespoligonosur.org', '$2y$10$K7uS6zUzo39U6EWeGiJVouI1V1AiLV9IjpjmStQNVC6XKRtcK.pzK', 'admin', 'true', 'Juan', 'Garrido Jiménez', '77871493W', 64064222, 'M', NULL, '2022-06-15 17:03:03', '2022-01-27 13:45:35', 'false'),
(2, 'jorge.guirao@iespoligonosur.org', '$2y$10$K7uS6zUzo39U6EWeGiJVouI1V1AiLV9IjpjmStQNVC6XKRtcK.pzK', 'user', 'true', 'Jorge', 'Guirao', '11223344A', NULL, NULL, NULL, NULL, '2022-03-14 21:28:37', 'true'),
(4, 'javier.jimenez.castillo@iespoligonosur.org', 'PendienteDeCambiar', 'admin', 'true', 'Javier', 'Jiménez Castillo', '33445566C', NULL, 'M', NULL, NULL, '2022-02-07 12:26:35', 'true'),
(7, 'juangj1b@gmail.com', '$2y$10$K7uS6zUzo39U6EWeGiJVouI1V1AiLV9IjpjmStQNVC6XKRtcK.pzK', 'user', 'true', 'Juan', 'Garrido Jiménez', '11105554G', NULL, 'M', NULL, NULL, '2022-05-23 18:34:43', 'true'),
(18, 'admin@iespoligonosur.org', '$2y$10$qTWNyQgRsOKExaERD41.FeO8RTv8hp8ysdBdtaMocb/JOZfEJutcG', 'admin', 'true', 'Admin', 'Admin', '11223344C', NULL, 'M', NULL, NULL, '2022-06-18 10:57:32', 'true'),
(19, 'usuario@iespoligonosur.org', '$2y$10$53Lp3GoMqiQW9uijjtyiHeBT3UQbXSU.dTQ1Wl.YKu59/JLEoJKpS', 'user', 'true', 'Usuario', 'Usuario', '22113344F', NULL, 'M', NULL, NULL, '2022-06-18 10:58:27', 'true');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `aulas`
--
ALTER TABLE `aulas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_incidencia` (`id_incidencia`),
  ADD KEY `id_user` (`id_user`);

--
-- Indices de la tabla `incidencia`
--
ALTER TABLE `incidencia`
  ADD PRIMARY KEY (`id_incidencia`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_aula` (`id_aula`);

--
-- Indices de la tabla `story_state`
--
ALTER TABLE `story_state`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_incidencia` (`id_incidencia`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `aulas`
--
ALTER TABLE `aulas`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT de la tabla `incidencia`
--
ALTER TABLE `incidencia`
  MODIFY `id_incidencia` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT de la tabla `story_state`
--
ALTER TABLE `story_state`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `comments_ibfk_3` FOREIGN KEY (`id_incidencia`) REFERENCES `incidencia` (`id_incidencia`);

--
-- Filtros para la tabla `incidencia`
--
ALTER TABLE `incidencia`
  ADD CONSTRAINT `incidencia_ibfk_1` FOREIGN KEY (`id_aula`) REFERENCES `aulas` (`id`),
  ADD CONSTRAINT `incidencia_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `story_state`
--
ALTER TABLE `story_state`
  ADD CONSTRAINT `story_state_ibfk_1` FOREIGN KEY (`id_incidencia`) REFERENCES `incidencia` (`id_incidencia`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
