-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-05-2026 a las 18:41:08
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
-- Base de datos: `temperaturadb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fecha`
--

CREATE TABLE `fecha` (
  `idFecha` int(11) NOT NULL,
  `Fecha` date NOT NULL,
  `Hora` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `fecha`
--

INSERT INTO `fecha` (`idFecha`, `Fecha`, `Hora`) VALUES
(1, '2024-01-05', '2024-01-05 06:30:00'),
(2, '2024-01-10', '2024-01-10 08:15:00'),
(3, '2024-01-15', '2024-01-15 12:00:00'),
(4, '2024-01-20', '2024-01-20 14:45:00'),
(5, '2024-02-01', '2024-02-01 07:00:00'),
(6, '2024-02-10', '2024-02-10 09:30:00'),
(7, '2024-02-15', '2024-02-15 11:00:00'),
(8, '2024-02-20', '2024-02-20 16:00:00'),
(9, '2024-03-05', '2024-03-05 06:45:00'),
(10, '2024-03-10', '2024-03-10 10:20:00'),
(11, '2024-03-15', '2024-03-15 13:30:00'),
(12, '2024-03-20', '2024-03-20 15:10:00'),
(13, '2024-04-01', '2024-04-01 08:00:00'),
(14, '2024-04-10', '2024-04-10 11:45:00'),
(15, '2024-04-15', '2024-04-15 17:30:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lugares`
--

CREATE TABLE `lugares` (
  `idLugares` int(11) NOT NULL,
  `NomLugar` varchar(24) NOT NULL,
  `DirLugar` varchar(48) NOT NULL,
  `Fecha_idFecha` int(11) NOT NULL,
  `Temperatura_idTemperatura` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `lugares`
--

INSERT INTO `lugares` (`idLugares`, `NomLugar`, `DirLugar`, `Fecha_idFecha`, `Temperatura_idTemperatura`) VALUES
(1, 'Parque Central', 'Av. Insurgentes 101', 1, 1),
(2, 'Estadio Norte', 'Calle Deportiva 202', 2, 2),
(3, 'Plaza Mayor', 'Blvd. Reforma 303', 3, 3),
(4, 'Mercado Municipal', 'Calle Hidalgo 404', 4, 4),
(5, 'Hospital General', 'Av. Salud 505', 5, 5),
(6, 'Aeropuerto', 'Carretera Federal Km 12', 6, 6),
(7, 'Universidad', 'Calle Universitaria 707', 7, 7),
(8, 'Museo de Historia', 'Av. Cultura 808', 8, 8),
(9, 'Centro Comercial', 'Blvd. Shopping 909', 9, 9),
(10, 'Palacio Municipal', 'Plaza Cívica 010', 10, 10),
(11, 'Zoológico', 'Av. Fauna 111', 11, 11),
(12, 'Biblioteca Pública', 'Calle Libros 212', 12, 12),
(13, 'Terminal de Buses', 'Av. Transporte 313', 13, 13),
(14, 'Puerto Deportivo', 'Malecón Sur 414', 14, 14),
(15, 'Jardín Botánico', 'Paseo Verde 515', 15, 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temperatura`
--

CREATE TABLE `temperatura` (
  `idTemperatura` int(11) NOT NULL,
  `Temperatura` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `temperatura`
--

INSERT INTO `temperatura` (`idTemperatura`, `Temperatura`) VALUES
(1, 22.5),
(2, 18.3),
(3, 30.1),
(4, 25.7),
(5, 15),
(6, 28.4),
(7, 33.2),
(8, 20.6),
(9, 17.8),
(10, 26.9),
(11, 31.5),
(12, 19.2),
(13, 24),
(14, 29.8),
(15, 16.4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temperaturas`
--

CREATE TABLE `temperaturas` (
  `Lugar` varchar(48) NOT NULL,
  `Fecha` datetime NOT NULL,
  `Temp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `temperaturas`
--

INSERT INTO `temperaturas` (`Lugar`, `Fecha`, `Temp`) VALUES
('Salón', '2026-03-25 10:29:38', 30),
('LABORATORIO DE REDES', '2026-03-25 10:31:41', 28),
('LABORATORIO DE REDES', '2026-03-25 10:33:15', 28),
('Salón', '2026-03-25 10:35:51', 28),
('Redes', '2026-04-28 04:59:01', 29),
('Didáctica', '2026-04-28 04:59:01', 30),
('Laboratorio', '2026-04-28 10:40:51', 26);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `email` varchar(80) NOT NULL,
  `password` varchar(32) NOT NULL,
  `nombre` varchar(48) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `email`, `password`, `nombre`) VALUES
(1, 'correo', '6ea45db3de738238aa71a68b448cad8d', 'nombre'),
(2, 'correo@gmail.com', '4b90fb93ed63c3ed5cd23dfd5301ab9b', 'nombre'),
(3, 'correo2@gmail.com', '908c62440e88a7d4d3f99d1729d9d5f7', 'nombre2'),
(4, 'correo3@gmail.com', 'b29e985d7f122339ba4fd3f13288a90c', 'nombre3'),
(5, 'correo4@gmail.com', '962be36a079d1ccea7dbe965aeba9553', 'nombre123');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `fecha`
--
ALTER TABLE `fecha`
  ADD PRIMARY KEY (`idFecha`);

--
-- Indices de la tabla `lugares`
--
ALTER TABLE `lugares`
  ADD PRIMARY KEY (`idLugares`,`Fecha_idFecha`,`Temperatura_idTemperatura`);

--
-- Indices de la tabla `temperatura`
--
ALTER TABLE `temperatura`
  ADD PRIMARY KEY (`idTemperatura`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `fecha`
--
ALTER TABLE `fecha`
  MODIFY `idFecha` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `lugares`
--
ALTER TABLE `lugares`
  MODIFY `idLugares` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `temperatura`
--
ALTER TABLE `temperatura`
  MODIFY `idTemperatura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
