-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-10-2023 a las 04:11:49
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `monitoreo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bateria`
--

CREATE TABLE `bateria` (
  `id` smallint(6) NOT NULL,
  `voltajeBateria` decimal(5,2) DEFAULT NULL,
  `nivel` decimal(5,2) DEFAULT NULL,
  `ciclos` smallint(6) DEFAULT NULL,
  `fechaHoraMedición` timestamp NOT NULL DEFAULT current_timestamp(),
  `dispositivoID` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dispositivo`
--

CREATE TABLE `dispositivo` (
  `id` smallint(6) NOT NULL,
  `codigo` varchar(20) DEFAULT NULL,
  `ubicacion` varchar(100) DEFAULT NULL,
  `estado` tinyint(4) DEFAULT NULL,
  `fechaInstalacion` date DEFAULT NULL,
  `usuariosID` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `dispositivo`
--

INSERT INTO `dispositivo` (`id`, `codigo`, `ubicacion`, `estado`, `fechaInstalacion`, `usuariosID`) VALUES
(1, 'D123', 'Oficina A', 0, '2023-10-26', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `potencia`
--

CREATE TABLE `potencia` (
  `id` smallint(6) NOT NULL,
  `voltaje` decimal(5,2) DEFAULT NULL,
  `corriente` decimal(5,2) DEFAULT NULL,
  `potencia` decimal(8,2) DEFAULT NULL,
  `fechaHoraMedicion` timestamp NOT NULL DEFAULT current_timestamp(),
  `dispositivoID` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `potencia`
--

INSERT INTO `potencia` (`id`, `voltaje`, `corriente`, `potencia`, `fechaHoraMedicion`, `dispositivoID`) VALUES
(1, 255.00, 107.00, 27285.00, '2023-10-26 16:59:53', 1),
(2, 255.00, 107.00, 27285.00, '2023-10-26 16:59:58', 1),
(3, 306.00, 171.00, 52326.00, '2023-10-26 17:00:03', 1),
(4, 285.00, 28.00, 7980.00, '2023-10-26 17:00:08', 1),
(5, 285.00, 3.00, 855.00, '2023-10-26 17:00:13', 1),
(6, 286.00, 0.00, 0.00, '2023-10-26 17:00:18', 1),
(7, 283.00, 35.00, 9905.00, '2023-10-26 17:00:23', 1),
(8, 285.00, 40.00, 11400.00, '2023-10-26 17:00:28', 1),
(9, 285.00, 25.00, 7125.00, '2023-10-26 17:00:33', 1),
(10, 278.00, 26.00, 7228.00, '2023-10-26 17:00:38', 1),
(11, 223.00, 0.00, 0.00, '2023-10-26 17:00:43', 1),
(12, 157.00, 0.00, 0.00, '2023-10-26 17:00:48', 1),
(13, 156.00, 22.00, 3432.00, '2023-10-26 17:00:53', 1),
(14, 158.00, 31.00, 4898.00, '2023-10-26 17:00:58', 1),
(15, 158.00, 32.00, 5056.00, '2023-10-26 17:01:03', 1),
(16, 158.00, 31.00, 4898.00, '2023-10-26 17:01:08', 1),
(17, 158.00, 31.00, 4898.00, '2023-10-26 17:01:13', 1),
(18, 158.00, 31.00, 4898.00, '2023-10-26 17:01:18', 1),
(19, 157.00, 31.00, 4867.00, '2023-10-26 17:01:23', 1),
(20, 158.00, 32.00, 5056.00, '2023-10-26 17:01:28', 1),
(21, 158.00, 31.00, 4898.00, '2023-10-26 17:01:33', 1),
(22, 158.00, 32.00, 5056.00, '2023-10-26 17:01:38', 1),
(23, 188.00, 31.00, 5828.00, '2023-10-26 17:01:43', 1),
(24, 188.00, 31.00, 5828.00, '2023-10-26 17:01:48', 1),
(25, 188.00, 32.00, 6016.00, '2023-10-26 17:01:53', 1),
(26, 187.00, 32.00, 5984.00, '2023-10-26 17:01:58', 1),
(27, 187.00, 30.00, 5610.00, '2023-10-26 17:07:40', 1),
(28, 187.00, 30.00, 5610.00, '2023-10-26 17:07:45', 1),
(29, 187.00, 30.00, 5610.00, '2023-10-26 17:07:50', 1),
(30, 187.00, 29.00, 5423.00, '2023-10-26 17:07:55', 1),
(31, 187.00, 30.00, 5610.00, '2023-10-26 17:08:00', 1),
(32, 187.00, 30.00, 5610.00, '2023-10-26 17:08:05', 1),
(33, 187.00, 31.00, 5797.00, '2023-10-26 17:08:10', 1),
(34, 187.00, 30.00, 5610.00, '2023-10-26 17:08:15', 1),
(35, 187.00, 31.00, 5797.00, '2023-10-26 17:08:20', 1),
(36, 187.00, 30.00, 5610.00, '2023-10-26 17:08:25', 1),
(37, 187.00, 30.00, 5610.00, '2023-10-26 17:08:30', 1),
(38, 187.00, 31.00, 5797.00, '2023-10-26 17:08:35', 1),
(39, 186.00, 29.00, 5394.00, '2023-10-26 17:08:40', 1),
(40, 187.00, 30.00, 5610.00, '2023-10-26 17:08:45', 1),
(41, 187.00, 30.00, 5610.00, '2023-10-26 17:08:50', 1),
(42, 187.00, 30.00, 5610.00, '2023-10-26 17:08:55', 1),
(43, 187.00, 30.00, 5610.00, '2023-10-26 17:09:00', 1),
(44, 185.00, 29.00, 5365.00, '2023-10-26 17:09:05', 1),
(45, 185.00, 30.00, 5550.00, '2023-10-26 17:09:10', 1),
(46, 187.00, 30.00, 5610.00, '2023-10-26 17:09:15', 1),
(47, 187.00, 30.00, 5610.00, '2023-10-26 17:09:20', 1),
(48, 187.00, 30.00, 5610.00, '2023-10-26 17:09:25', 1),
(49, 187.00, 30.00, 5610.00, '2023-10-26 17:09:30', 1),
(50, 187.00, 30.00, 5610.00, '2023-10-26 17:09:35', 1),
(51, 187.00, 30.00, 5610.00, '2023-10-26 17:09:40', 1),
(52, 187.00, 31.00, 5797.00, '2023-10-26 17:09:45', 1),
(53, 186.00, 30.00, 5580.00, '2023-10-26 17:09:50', 1),
(54, 187.00, 30.00, 5610.00, '2023-10-26 17:09:55', 1),
(55, 187.00, 31.00, 5797.00, '2023-10-26 17:10:00', 1),
(56, 186.00, 29.00, 5394.00, '2023-10-26 17:10:05', 1),
(57, 187.00, 30.00, 5610.00, '2023-10-26 17:10:10', 1),
(58, 187.00, 30.00, 5610.00, '2023-10-26 17:10:15', 1),
(59, 186.00, 29.00, 5394.00, '2023-10-26 17:10:20', 1),
(60, 187.00, 30.00, 5610.00, '2023-10-26 17:10:25', 1),
(61, 187.00, 31.00, 5797.00, '2023-10-26 17:10:30', 1),
(62, 187.00, 31.00, 5797.00, '2023-10-26 17:10:35', 1),
(63, 187.00, 30.00, 5610.00, '2023-10-26 17:10:40', 1),
(64, 187.00, 30.00, 5610.00, '2023-10-26 17:10:45', 1),
(65, 186.00, 29.00, 5394.00, '2023-10-26 17:10:50', 1),
(66, 187.00, 30.00, 5610.00, '2023-10-26 17:10:55', 1),
(67, 187.00, 31.00, 5797.00, '2023-10-26 17:11:00', 1),
(68, 186.00, 30.00, 5580.00, '2023-10-26 17:11:05', 1),
(69, 187.00, 30.00, 5610.00, '2023-10-26 17:11:10', 1),
(70, 187.00, 30.00, 5610.00, '2023-10-26 17:11:15', 1),
(71, 187.00, 30.00, 5610.00, '2023-10-26 17:11:20', 1),
(72, 187.00, 30.00, 5610.00, '2023-10-26 17:11:25', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sensordht11`
--

CREATE TABLE `sensordht11` (
  `id` smallint(6) NOT NULL,
  `temperatura` decimal(5,2) DEFAULT NULL,
  `humedad` decimal(5,2) DEFAULT NULL,
  `fechaHoraMedición` timestamp NOT NULL DEFAULT current_timestamp(),
  `dispositivoID` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` smallint(6) NOT NULL,
  `nombreUsuario` varchar(20) NOT NULL,
  `nombre` varchar(70) NOT NULL,
  `primerApellido` varchar(50) NOT NULL,
  `segundoApellido` varchar(50) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` varchar(10) NOT NULL,
  `fechaRegistro` timestamp NOT NULL DEFAULT current_timestamp(),
  `fechaModificacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombreUsuario`, `nombre`, `primerApellido`, `segundoApellido`, `email`, `password`, `rol`, `fechaRegistro`, `fechaModificacion`) VALUES
(1, 'MCR202329', 'Ronaldo Pablo', 'Melgarejo', 'Cardozo', 'melgarejo.ronaldo.590@gmail.com', '03f544613917945245041ea1581df0c2', 'user', '2023-10-22 21:24:29', '2023-10-22 21:24:29'),
(2, 'MCR202351', 'Ronaldo Pablo', 'Melgarejo', 'Cardozo', '201900505@est.umss.edu', '03f544613917945245041ea1581df0c2', 'user', '2023-10-22 21:25:51', '2023-10-22 21:25:51'),
(3, '202311', '', '', '', '', 'd41d8cd98f00b204e9800998ecf8427e', 'user', '2023-10-22 23:40:11', '2023-10-22 23:40:11'),
(4, 'MCR202339', 'Ronaldo', 'Melgarejo', 'Cardozo', 'ronaldo.pablo.rpmc@gmail.com', '03f544613917945245041ea1581df0c2', 'user', '2023-10-23 01:06:39', '2023-10-23 01:06:39');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bateria`
--
ALTER TABLE `bateria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_bateria_dispositivo1_idx` (`dispositivoID`);

--
-- Indices de la tabla `dispositivo`
--
ALTER TABLE `dispositivo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_dispositivos_usuarios1_idx` (`usuariosID`);

--
-- Indices de la tabla `potencia`
--
ALTER TABLE `potencia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_potencia_dispositivo1_idx` (`dispositivoID`);

--
-- Indices de la tabla `sensordht11`
--
ALTER TABLE `sensordht11`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_sensordht11_dispositivo1_idx` (`dispositivoID`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bateria`
--
ALTER TABLE `bateria`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `dispositivo`
--
ALTER TABLE `dispositivo`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `potencia`
--
ALTER TABLE `potencia`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT de la tabla `sensordht11`
--
ALTER TABLE `sensordht11`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `bateria`
--
ALTER TABLE `bateria`
  ADD CONSTRAINT `fk_bateria_dispositivo1` FOREIGN KEY (`dispositivoID`) REFERENCES `dispositivo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `dispositivo`
--
ALTER TABLE `dispositivo`
  ADD CONSTRAINT `fk_dispositivos_usuarios1` FOREIGN KEY (`usuariosID`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `potencia`
--
ALTER TABLE `potencia`
  ADD CONSTRAINT `fk_potencia_dispositivo1` FOREIGN KEY (`dispositivoID`) REFERENCES `dispositivo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `sensordht11`
--
ALTER TABLE `sensordht11`
  ADD CONSTRAINT `fk_sensordht11_dispositivo1` FOREIGN KEY (`dispositivoID`) REFERENCES `dispositivo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
