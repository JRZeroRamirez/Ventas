-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-03-2021 a las 17:48:11
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ventas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `codproducto` int(11) NOT NULL,
  `producto` varchar(30) DEFAULT NULL,
  `descripcion` varchar(50) NOT NULL,
  `precio` int(20) NOT NULL,
  `cantidad` int(60) NOT NULL,
  `foto` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`codproducto`, `producto`, `descripcion`, `precio`, `cantidad`, `foto`) VALUES
(1, 'liquido1', 'aceite', 20000, 0, ''),
(2, 'mezcla1', 'cloro', 10000, 0, ''),
(3, 'materiaX', 'jabon', 5000, 0, ''),
(7, 'plato', 'mesa', 15000, 8, 'img_producto.png'),
(8, 'LAPTOP', 'EQUIPO', 20000, 20, 'img_producto.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `idrol` int(11) NOT NULL,
  `rol` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`idrol`, `rol`) VALUES
(1, 'Administrador'),
(2, 'Vendedor'),
(3, 'Cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL,
  `tipodoc` varchar(30) NOT NULL,
  `numero` int(30) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `apellido` varchar(60) NOT NULL,
  `ciudad` varchar(60) NOT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `usuario` varchar(15) DEFAULT NULL,
  `clave` varchar(100) DEFAULT NULL,
  `rol` int(11) DEFAULT NULL,
  `ubicacion` int(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `tipodoc`, `numero`, `nombre`, `apellido`, `ciudad`, `correo`, `usuario`, `clave`, `rol`, `ubicacion`) VALUES
(1, '2', 20202, 'JR Ramirez', 'Ramirez', 'Faca', 'dd@hotmail.com', 'JR1', '12345', 1, 1),
(2, '1', 101010, 'JOSE', 'martinez', 'bogota', 'jose@gmail.com', 'JOSE', '12345', 2, 2),
(3, '2', 30303, 'JEISSON', 'rodriguez', 'medellin', 'JEISSON@GMAIL.COM', 'JEISSON', '12345', 3, 3),
(12, '2', 808, 'pablo', 'pablo', 'faca', 'pablo@hotmail', 'pablo1', '12345', 3, 6),
(13, '3', 90909, 'alejandro', 'alejandro', 'armeni', 'alejandro@gmail', 'alejo', '12345', 2, 8),
(14, '2', 123455, 'AAA', 'AAAAD', 'siberia', 'aaa@hota', 'aad', '1234', 3, 8),
(15, '3', 123456789, 'MARCOS', 'MARCOS', 'BOGOTA', 'MARCOS@GMAIL.COM', 'MARCOS00', '12345', 3, 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `codventa` int(20) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `cliente` varchar(50) NOT NULL,
  `producto` varchar(60) NOT NULL,
  `cantidad` int(50) NOT NULL,
  `valor` int(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`codventa`, `fecha`, `hora`, `cliente`, `producto`, `cantidad`, `valor`) VALUES
(1, '2021-03-01', '00:39:40', 'JR', 'platos', 5, 20000),
(2, '2021-03-11', '04:52:06', 'Mario', 'Maquinas', 10, 30000);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`codproducto`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`idrol`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`),
  ADD KEY `rol` (`rol`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`codventa`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `codproducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `idrol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `codventa` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`rol`) REFERENCES `rol` (`idrol`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
