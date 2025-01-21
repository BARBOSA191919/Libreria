-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 21-01-2025 a las 23:18:21
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
(1, '12544', 'Julian Pinto', 'Hola mundo', 'Colombia');

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
(7, '2344545565465', 'ElectrónicaUJK', 'bimbo', '2025-01-18 10:32:14'),
(12, 'CAT00297874', 'gaseosa', 'gaseosa ponyr', '2025-01-20 18:42:29'),
(13, '1236584574', 'pan con cafe', 'afsfaf', '2025-01-20 18:48:32'),
(15, 'CAT002989', 'PANADERO1236', 'pan', '2025-01-20 19:55:59'),
(17, 'CAT002003698', 'PANADERO89', 'bimbo', '2025-01-20 20:27:28'),
(18, '12345', 'gaseosa12', 'postobon', '2025-01-20 20:30:32'),
(19, 'CAT00200598', 'Gaseosa Colombiana', '1 litro', '2025-01-20 20:35:04'),
(20, 'CAT002', 'gaseosa', 'gaseosa pony', '2025-01-21 11:43:03');

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
(6, 'Oscar', 'DNI', '120569', '3215698578', '2025-01-20 23:52:54'),
(7, 'Julian Pinto', 'Pasaporte', '12056965', '3658793324', '2025-01-21 00:56:31'),
(8, 'Julian D Pinto', 'Pasaporte', '211453545644', '3215698578', '2025-01-21 00:58:56');

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
(1, '123456', 'Planeta', '321234451', 'Estados Unidos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `id_inventario` int NOT NULL,
  `codigo` varchar(100) NOT NULL,
  `tituloLibro` varchar(255) NOT NULL,
  `autor` varchar(255) NOT NULL,
  `editorial` varchar(255) DEFAULT NULL,
  `anioPublicacion` year DEFAULT NULL,
  `genero` varchar(100) DEFAULT NULL,
  `precioVenta` decimal(10,2) NOT NULL,
  `cantidad` int NOT NULL,
  `idioma` varchar(100) DEFAULT NULL,
  `noPaginas` int DEFAULT NULL,
  `formato` varchar(100) DEFAULT NULL,
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `inventario`
--

INSERT INTO `inventario` (`id_inventario`, `codigo`, `tituloLibro`, `autor`, `editorial`, `anioPublicacion`, `genero`, `precioVenta`, `cantidad`, `idioma`, `noPaginas`, `formato`, `fecha_registro`) VALUES
(2, '2125642456', 'Artilleropw', 'Julian ssa', 'bancolombiasda', '2015', 'Terror', 25000.00, 25000, 'english', 1250, 'digital', '2025-01-21 17:27:09');

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
(1, '123454', 'TODAY TINO', '3215698754', 'santa lucia\r\nCalle 1 no. 3 16', '3118041644', 'julianpinto700@gmail.com');

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
  ADD UNIQUE KEY `codigo` (`codigo`);

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
  MODIFY `idAutor` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `editorial`
--
ALTER TABLE `editorial`
  MODIFY `idEditorial` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `id_inventario` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `id_proveedor` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usuario_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
