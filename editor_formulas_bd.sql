-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-04-2019 a las 12:45:01
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.1.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `editor_formulas_bd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `concepto`
--

CREATE TABLE `concepto` (
  `id_concepto` int(11) NOT NULL,
  `nombre_concepto` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `es_indicador` int(11) NOT NULL DEFAULT '0',
  `es_variable` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `concepto`
--

INSERT INTO `concepto` (`id_concepto`, `nombre_concepto`, `es_indicador`, `es_variable`) VALUES
(1, 'ROE', 1, 0),
(2, 'Utilidad', 0, 1),
(3, 'Patrimonio', 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `periodo`
--

CREATE TABLE `periodo` (
  `id_periodo` int(11) NOT NULL,
  `mes` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `periodo`
--

INSERT INTO `periodo` (`id_periodo`, `mes`) VALUES
(1, 'ENE'),
(2, 'FEB'),
(3, 'MAR'),
(4, 'ABR'),
(5, 'MAY'),
(6, 'JUN');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valores`
--

CREATE TABLE `valores` (
  `id_concepto` int(11) NOT NULL,
  `id_periodo` int(11) NOT NULL,
  `valor` double NOT NULL,
  `es_meta` int(11) NOT NULL,
  `es_calculado` int(11) NOT NULL,
  `es_interno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `valores`
--

INSERT INTO `valores` (`id_concepto`, `id_periodo`, `valor`, `es_meta`, `es_calculado`, `es_interno`) VALUES
(2, 1, 15000, 0, 0, 1),
(2, 2, 20000, 0, 0, 1),
(2, 3, 10001, 0, 0, 1),
(2, 4, 10000, 0, 0, 1),
(2, 5, 20001, 0, 0, 1),
(2, 6, 30000, 0, 0, 1),
(3, 1, 211550, 0, 0, 1),
(3, 2, 400000, 0, 0, 1),
(3, 3, 400000, 0, 0, 1),
(3, 4, 90000, 0, 0, 1),
(3, 5, 400000, 0, 0, 1),
(3, 6, 200000, 0, 0, 1),
(1, 1, 7.0905223351454, 0, 1, 0),
(1, 2, 5, 0, 1, 0),
(1, 3, 2.50025, 0, 1, 0),
(1, 4, 11.111111111111, 0, 1, 0),
(1, 5, 5.00025, 0, 1, 0),
(1, 6, 15, 0, 1, 0),
(1, 1, 6, 1, 0, 0),
(1, 2, 4, 1, 0, 0),
(1, 3, 6, 1, 0, 0),
(1, 4, 7, 1, 0, 0),
(1, 5, 8, 1, 0, 0),
(1, 6, 9, 1, 0, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `concepto`
--
ALTER TABLE `concepto`
  ADD PRIMARY KEY (`id_concepto`);

--
-- Indices de la tabla `periodo`
--
ALTER TABLE `periodo`
  ADD PRIMARY KEY (`id_periodo`);

--
-- Indices de la tabla `valores`
--
ALTER TABLE `valores`
  ADD KEY `fk_concepto` (`id_concepto`),
  ADD KEY `fk_periodo` (`id_periodo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `concepto`
--
ALTER TABLE `concepto`
  MODIFY `id_concepto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `periodo`
--
ALTER TABLE `periodo`
  MODIFY `id_periodo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `valores`
--
ALTER TABLE `valores`
  ADD CONSTRAINT `fk_concepto` FOREIGN KEY (`id_concepto`) REFERENCES `concepto` (`id_concepto`),
  ADD CONSTRAINT `fk_periodo` FOREIGN KEY (`id_periodo`) REFERENCES `periodo` (`id_periodo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
