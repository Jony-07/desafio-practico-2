-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 14-06-2023 a las 07:05:41
-- Versión del servidor: 8.0.31
-- Versión de PHP: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `textil-export`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

DROP TABLE IF EXISTS `categoria`;
CREATE TABLE IF NOT EXISTS `categoria` (
  `id_categoria` char(2) COLLATE utf16_unicode_ci NOT NULL,
  `nombre_categoria` varchar(50) COLLATE utf16_unicode_ci NOT NULL,
  `estado_categoria` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `nombre_categoria`, `estado_categoria`) VALUES
('1', 'Fibras naturales', 1),
('2', 'Fibras sintéticas', 1),
('3', 'Modernas', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

DROP TABLE IF EXISTS `cliente`;
CREATE TABLE IF NOT EXISTS `cliente` (
  `codigo_cliente` char(10) CHARACTER SET utf16 COLLATE utf16_unicode_ci NOT NULL,
  `nombre` varchar(50) COLLATE utf16_unicode_ci NOT NULL,
  `apellido` varchar(50) COLLATE utf16_unicode_ci NOT NULL,
  `correo` varchar(75) COLLATE utf16_unicode_ci NOT NULL,
  `clave` varchar(255) COLLATE utf16_unicode_ci NOT NULL,
  `telefono` varchar(9) COLLATE utf16_unicode_ci NOT NULL,
  `direccion` varchar(255) COLLATE utf16_unicode_ci NOT NULL,
  `hash_active` varchar(255) COLLATE utf16_unicode_ci NOT NULL,
  `id_tipo_usuario` int NOT NULL DEFAULT '3',
  `verificado` int NOT NULL DEFAULT '1',
  `id_estado` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`codigo_cliente`),
  KEY `clienteo_ibfk_2` (`id_estado`),
  KEY `cliente_ibfk_3` (`id_tipo_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`codigo_cliente`, `nombre`, `apellido`, `correo`, `clave`, `telefono`, `direccion`, `hash_active`, `id_tipo_usuario`, `verificado`, `id_estado`) VALUES
('06254218-3', 'Jony', ' López', 'jony25lopezml@gmail.com', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f', '7005-9988', 'Carretera Troncal Norte Km 9 Cantón Calle Real', 'bcbe3365e6ac95ea2c0343a2395834dd', 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

DROP TABLE IF EXISTS `estado`;
CREATE TABLE IF NOT EXISTS `estado` (
  `id_estado` int NOT NULL,
  `nombre_estado` varchar(25) COLLATE utf16_unicode_ci NOT NULL,
  PRIMARY KEY (`id_estado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`id_estado`, `nombre_estado`) VALUES
(0, 'Deshabilitado'),
(1, 'Habilitado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

DROP TABLE IF EXISTS `producto`;
CREATE TABLE IF NOT EXISTS `producto` (
  `codigo_producto` char(9) CHARACTER SET utf16 COLLATE utf16_unicode_ci NOT NULL,
  `nombre_producto` varchar(75) COLLATE utf16_unicode_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf16_unicode_ci NOT NULL,
  `imagen` varchar(13) COLLATE utf16_unicode_ci NOT NULL,
  `precio` float(10,2) NOT NULL,
  `existencias` int NOT NULL,
  `id_categoria` char(2) COLLATE utf16_unicode_ci NOT NULL,
  `estado` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`codigo_producto`),
  KEY `producto_ibfk_2` (`id_categoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`codigo_producto`, `nombre_producto`, `descripcion`, `imagen`, `precio`, `existencias`, `id_categoria`, `estado`) VALUES
('PROD00001', 'Tela Natural', 'Tela de fibra natural', 'PROD00001.jpg', 5.00, 5, '1', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuario`
--

DROP TABLE IF EXISTS `tipo_usuario`;
CREATE TABLE IF NOT EXISTS `tipo_usuario` (
  `id_tipo_usuario` int NOT NULL,
  `nombre_tipo_usuario` varchar(25) COLLATE utf16_unicode_ci NOT NULL,
  PRIMARY KEY (`id_tipo_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`id_tipo_usuario`, `nombre_tipo_usuario`) VALUES
(1, 'Usuario'),
(3, 'Cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `codigo_usuario` char(4) CHARACTER SET utf16 COLLATE utf16_unicode_ci NOT NULL,
  `nombre` varchar(50) COLLATE utf16_unicode_ci NOT NULL,
  `telefono` varchar(9) COLLATE utf16_unicode_ci NOT NULL,
  `correo` varchar(75) COLLATE utf16_unicode_ci NOT NULL,
  `clave` varchar(255) COLLATE utf16_unicode_ci NOT NULL,
  `id_tipo_usuario` int NOT NULL DEFAULT '1',
  `id_estado` int NOT NULL DEFAULT '1',
  `verificado` int NOT NULL DEFAULT '1',
  `hash_active` varchar(255) COLLATE utf16_unicode_ci NOT NULL,
  PRIMARY KEY (`codigo_usuario`),
  KEY `usuario_ibfk_2` (`id_estado`),
  KEY `usuario_ibfk_3` (`id_tipo_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`codigo_usuario`, `nombre`, `telefono`, `correo`, `clave`, `id_tipo_usuario`, `id_estado`, `verificado`, `hash_active`) VALUES
('U005', 'Jony Morales', '7005-9988', 'jony25@gmail.com', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f', 1, 1, 1, ''),
('U234', 'Jdev', '7005-9989', 'jdev@gmail.com', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f', 1, 1, 1, '3416a75f4cea9109507cacd8e2f2aefc'),
('U237', 'Jlopez', '7005-9988', 'jaylopez@gmail.com', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f', 1, 1, 1, 'aff1621254f7c1be92f64550478c56e6');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_3` FOREIGN KEY (`id_tipo_usuario`) REFERENCES `tipo_usuario` (`id_tipo_usuario`),
  ADD CONSTRAINT `clienteo_ibfk_2` FOREIGN KEY (`id_estado`) REFERENCES `estado` (`id_estado`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`id_estado`) REFERENCES `estado` (`id_estado`),
  ADD CONSTRAINT `usuario_ibfk_3` FOREIGN KEY (`id_tipo_usuario`) REFERENCES `tipo_usuario` (`id_tipo_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
