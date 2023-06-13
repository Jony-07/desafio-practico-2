-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 13, 2023 at 07:28 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `textil-export`
--

-- --------------------------------------------------------

--
-- Table structure for table `categoria`
--

DROP TABLE IF EXISTS `categoria`;
CREATE TABLE IF NOT EXISTS `categoria` (
  `id_categoria` char(2) COLLATE utf16_unicode_ci NOT NULL,
  `nombre_categoria` varchar(50) COLLATE utf16_unicode_ci NOT NULL,
  `estado_categoria` int NOT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

--
-- Dumping data for table `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `nombre_categoria`, `estado_categoria`) VALUES
('1', 'Fibras naturales', 1),
('2', 'Fibras sintéticas', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cliente`
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
-- Dumping data for table `cliente`
--

INSERT INTO `cliente` (`codigo_cliente`, `nombre`, `apellido`, `correo`, `clave`, `telefono`, `direccion`, `hash_active`, `id_tipo_usuario`, `verificado`, `id_estado`) VALUES
('06254218-3', 'Jony', ' López', 'jony25lopezml@gmail.com', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f', '7005-9988', 'Carretera Troncal Norte Km 9 Cantón Calle Real', 'bcbe3365e6ac95ea2c0343a2395834dd', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `estado`
--

DROP TABLE IF EXISTS `estado`;
CREATE TABLE IF NOT EXISTS `estado` (
  `id_estado` int NOT NULL,
  `nombre_estado` varchar(25) COLLATE utf16_unicode_ci NOT NULL,
  PRIMARY KEY (`id_estado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

--
-- Dumping data for table `estado`
--

INSERT INTO `estado` (`id_estado`, `nombre_estado`) VALUES
(0, 'Deshabilitado'),
(1, 'Habilitado');

-- --------------------------------------------------------

--
-- Table structure for table `producto`
--

DROP TABLE IF EXISTS `producto`;
CREATE TABLE IF NOT EXISTS `producto` (
  `id_producto` char(8) COLLATE utf16_unicode_ci NOT NULL,
  `id_categoria` char(2) COLLATE utf16_unicode_ci NOT NULL,
  `estado` int NOT NULL,
  PRIMARY KEY (`id_producto`),
  KEY `producto_ibfk_2` (`id_categoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tipo_usuario`
--

DROP TABLE IF EXISTS `tipo_usuario`;
CREATE TABLE IF NOT EXISTS `tipo_usuario` (
  `id_tipo_usuario` int NOT NULL,
  `nombre_tipo_usuario` varchar(25) COLLATE utf16_unicode_ci NOT NULL,
  PRIMARY KEY (`id_tipo_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

--
-- Dumping data for table `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`id_tipo_usuario`, `nombre_tipo_usuario`) VALUES
(1, 'Usuario'),
(3, 'Cliente');

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
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
  PRIMARY KEY (`codigo_usuario`),
  KEY `usuario_ibfk_2` (`id_estado`),
  KEY `usuario_ibfk_3` (`id_tipo_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`codigo_usuario`, `nombre`, `telefono`, `correo`, `clave`, `id_tipo_usuario`, `id_estado`, `verificado`) VALUES
('U005', 'Jony Morales', '7005-9988', 'jony25@gmail.com', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f', 1, 1, 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_3` FOREIGN KEY (`id_tipo_usuario`) REFERENCES `tipo_usuario` (`id_tipo_usuario`),
  ADD CONSTRAINT `clienteo_ibfk_2` FOREIGN KEY (`id_estado`) REFERENCES `estado` (`id_estado`);

--
-- Constraints for table `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`id_estado`) REFERENCES `estado` (`id_estado`),
  ADD CONSTRAINT `usuario_ibfk_3` FOREIGN KEY (`id_tipo_usuario`) REFERENCES `tipo_usuario` (`id_tipo_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
