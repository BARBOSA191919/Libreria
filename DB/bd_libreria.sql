-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 24-01-2025 a las 20:57:44
-- Versión del servidor: 8.0.30
-- Versión de PHP: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_libreria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autor`
--

CREATE TABLE `autor` (
  `idAutor` int NOT NULL,
  `codigo` varchar(50) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `biografia` text,
  `paisorigen` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `autor`
--

INSERT INTO `autor` (`idAutor`, `codigo`, `nombre`, `biografia`, `paisorigen`) VALUES
(2, 'AUT00120', 'Gabriel García Márquez', 'Autor colombiano, premio Nobel de Literatura.', 'Colombia'),
(3, 'AUT0023', 'Jane Austen Pinto', 'Autora inglesa de novelas clásicas.', 'Inglaterra'),
(4, 'AUT0035', 'George Orwell', 'Ensayista y novelista británico.', 'Reino Unido'),
(5, '1254469', 'Katherin', 'asfdwdfasddfs', 'Colombia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int NOT NULL,
  `codigo` varchar(100) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `subcategoria` varchar(255) NOT NULL,
  `fecha_registro` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `codigo`, `nombre`, `subcategoria`, `fecha_registro`) VALUES
(7, '2344545565465', 'Electrónica', 'bimbo', '2025-01-18 10:32:14'),
(13, '1236584574', 'pan con cafe', 'afsfaf', '2025-01-20 18:48:32'),
(15, 'CAT002989', 'PANADERO1236', 'pan', '2025-01-20 19:55:59'),
(17, 'CAT002003698', 'PANADERO89', 'bimbo', '2025-01-20 20:27:28'),
(18, '12345', 'gaseosa12', 'postobon', '2025-01-20 20:30:32'),
(19, 'CAT00200598', 'Gaseosa Colombiana', '1 litro', '2025-01-20 20:35:04'),
(22, 'CAT00123658', 'POESIA', 'GABRIEL MARQUEZ', '2025-01-24 09:37:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `tipo_documento` varchar(100) NOT NULL,
  `numero_documento` varchar(20) NOT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `fecha_registro` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `nombre`, `tipo_documento`, `numero_documento`, `telefono`, `fecha_registro`) VALUES
(1, 'sasds', 'wwdads', '2321', '312312', '2025-01-17 21:42:37'),
(2, 'sdasda', 'DNI', '1232', '21312', '2025-01-17 22:40:21'),
(4, 'diego', 'DNI', '3223232', '2312312', '2025-01-17 23:37:29'),
(6, 'Oscar', 'DNI', '120569', '3215698578', '2025-01-20 23:52:54');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `editorial`
--

CREATE TABLE `editorial` (
  `idEditorial` int NOT NULL,
  `codigo` varchar(50) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `informacioncontacto` text,
  `pais` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `editorial`
--

INSERT INTO `editorial` (`idEditorial`, `codigo`, `nombre`, `informacioncontacto`, `pais`) VALUES
(1, '123456', 'Planeta', '321234451', 'Estados Unidos'),
(2, '123456251', 'Planeta', 'awresdfawfga', 'Estados Unidos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `id_inventario` int NOT NULL,
  `codigo` varchar(50) NOT NULL,
  `tituloLibro` varchar(255) NOT NULL,
  `idAutor` int NOT NULL,
  `editorial` varchar(255) DEFAULT NULL,
  `anioPublicacion` smallint DEFAULT NULL,
  `genero` varchar(100) DEFAULT NULL,
  `precioVenta` decimal(10,2) DEFAULT NULL,
  `cantidad` int DEFAULT NULL,
  `idioma` varchar(50) DEFAULT NULL,
  `noPaginas` int DEFAULT NULL,
  `formato` varchar(50) DEFAULT NULL,
  `fecha_registro` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `inventario`
--

INSERT INTO `inventario` (`id_inventario`, `codigo`, `tituloLibro`, `idAutor`, `editorial`, `anioPublicacion`, `genero`, `precioVenta`, `cantidad`, `idioma`, `noPaginas`, `formato`, `fecha_registro`) VALUES
(11, 'LIB002', 'Orgullo y prejuicio', 4, 'Penguin Books', 1813, 'Romance', 20.50, 50, 'Inglés', 352, 'Rústica', '2025-01-23 22:04:29'),
(12, 'LIB003', '1984', 3, 'Secker & Warburg', 1949, 'Distopía', 25.00, 80, 'Inglés', 328, 'Tapa dura', '2025-01-23 22:04:29'),
(13, '212564256', 'Artillerop', 2, 'bancolombiasda', 2015, 'miedo', 2500.00, 50, 'español', 1250, 'Rústica', '2025-01-24 20:03:55'),
(14, 'LIB00365', 'Orgullo y prejuicio', 2, 'bancolombia', 2015, 'Terror', 50000.00, 50, 'español', 1200, 'Libro ilustrado', '2025-01-24 20:13:51');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `id_proveedor` int NOT NULL,
  `codigo` varchar(50) NOT NULL,
  `nombreEmpresa` varchar(100) NOT NULL,
  `contacto` varchar(100) DEFAULT NULL,
  `direccion` text,
  `telefono` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`id_proveedor`, `codigo`, `nombreEmpresa`, `contacto`, `direccion`, `telefono`, `email`) VALUES
(3, '12154654', 'Microsoft', 'Juan Pérez', 'santa lucia\r\nCalle 1 no. 3 16', '3185693548', 'microsoft500@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `usuario_id` int NOT NULL,
  `usuario_nombre` varchar(70) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `usuario_apellido` varchar(70) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `usuario_email` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `usuario_usuario` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `usuario_clave` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `usuario_foto` varchar(535) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `usuario_creado` timestamp NOT NULL,
  `usuario_actualizado` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usuario_id`, `usuario_nombre`, `usuario_apellido`, `usuario_email`, `usuario_usuario`, `usuario_clave`, `usuario_foto`, `usuario_creado`, `usuario_actualizado`) VALUES
(1, 'admin', 'Principal', 'admin@admin.com', 'admin', '$2y$10$ou1w4B4VZPSyf/F7yYNRv.96Ibw0QjHDcRcLligIf2wA59nhCh/7e', 'admin_21.png', '2023-07-06 21:48:05', '2025-01-16 19:24:59');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `autor`
--
ALTER TABLE `autor`
  ADD PRIMARY KEY (`idAutor`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`),
  ADD UNIQUE KEY `numero_documento` (`numero_documento`);

--
-- Indices de la tabla `editorial`
--
ALTER TABLE `editorial`
  ADD PRIMARY KEY (`idEditorial`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`id_inventario`),
  ADD UNIQUE KEY `codigo` (`codigo`),
  ADD KEY `idAutor` (`idAutor`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`id_proveedor`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usuario_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `autor`
--
ALTER TABLE `autor`
  MODIFY `idAutor` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `editorial`
--
ALTER TABLE `editorial`
  MODIFY `idEditorial` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `id_inventario` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `id_proveedor` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usuario_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD CONSTRAINT `inventario_ibfk_1` FOREIGN KEY (`idAutor`) REFERENCES `autor` (`idAutor`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
