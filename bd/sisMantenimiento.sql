-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 28-06-2021 a las 18:32:39
-- Versión del servidor: 5.7.34
-- Versión de PHP: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistewp7_sisMantenimiento`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividades`
--

CREATE TABLE `actividades` (
  `idmantenimiento` int(5) UNSIGNED NOT NULL,
  `actividad` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `actividades`
--

INSERT INTO `actividades` (`idmantenimiento`, `actividad`) VALUES
(2, 'prueba'),
(1, 'prueba'),
(1, 'dfgdfgdf'),
(1, 'fgdgdfg'),
(1, 'dfgdfgf'),
(3, 'Limpieza de Motor'),
(3, 'Mantenimiento al sistema eléctrico'),
(3, 'Cambio de filtros'),
(4, 'Limpieza'),
(4, 'Calibración'),
(5, 'limpieza interna'),
(6, 'Limpieza externa'),
(7, 'Limpieza interna '),
(8, 'aasa'),
(8, 'asssa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `areas`
--

CREATE TABLE `areas` (
  `id_area` int(5) UNSIGNED NOT NULL,
  `nombre_area` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `areas`
--

INSERT INTO `areas` (`id_area`, `nombre_area`) VALUES
(1, 'Informatica'),
(2, 'Ensayo de laboratorio');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargos`
--

CREATE TABLE `cargos` (
  `id_cargo` int(5) UNSIGNED NOT NULL,
  `nombre_cargo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cargos`
--

INSERT INTO `cargos` (`id_cargo`, `nombre_cargo`) VALUES
(1, 'ADMINISTRADOR'),
(2, 'EMPLEADO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

CREATE TABLE `configuracion` (
  `id_configuracion` int(5) NOT NULL,
  `ruc` varchar(15) NOT NULL,
  `razon_social` varchar(200) NOT NULL,
  `fecha_creacion` date NOT NULL,
  `fecha_inicio` date NOT NULL,
  `condicion` varchar(30) NOT NULL,
  `estado` varchar(30) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `logo` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `configuracion`
--

INSERT INTO `configuracion` (`id_configuracion`, `ruc`, `razon_social`, `fecha_creacion`, `fecha_inicio`, `condicion`, `estado`, `direccion`, `logo`) VALUES
(1, '122332323232', 'Instituto Tecnológico de la Producción', '2021-06-01', '2021-06-01', 'ACTIVO', 'ACTIVO', 'prueba', 'logo.gif');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cronograma_mantenimientos`
--

CREATE TABLE `cronograma_mantenimientos` (
  `id_cronograma` int(5) UNSIGNED NOT NULL,
  `idmantenimiento` int(5) UNSIGNED NOT NULL,
  `fecha_cronograma` datetime NOT NULL,
  `year` varchar(4) NOT NULL,
  `month` int(2) NOT NULL,
  `day` int(2) NOT NULL,
  `estadomantenimiento` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cronograma_mantenimientos`
--

INSERT INTO `cronograma_mantenimientos` (`id_cronograma`, `idmantenimiento`, `fecha_cronograma`, `year`, `month`, `day`, `estadomantenimiento`) VALUES
(1, 1, '2021-06-20 00:00:00', '2021', 6, 20, 0),
(2, 1, '2021-06-22 00:00:00', '2021', 6, 22, 2),
(3, 2, '2021-06-21 00:00:00', '2021', 6, 21, 0),
(4, 3, '2021-06-21 00:00:00', '2021', 6, 21, 0),
(5, 3, '2021-06-26 00:00:00', '2021', 6, 26, 2),
(6, 3, '2021-07-01 00:00:00', '2021', 7, 1, 1),
(7, 3, '2021-07-06 00:00:00', '2021', 7, 6, 1),
(8, 3, '2021-07-11 00:00:00', '2021', 7, 11, 1),
(9, 3, '2021-07-16 00:00:00', '2021', 7, 16, 1),
(10, 3, '2021-07-21 00:00:00', '2021', 7, 21, 1),
(11, 3, '2021-07-26 00:00:00', '2021', 7, 26, 1),
(12, 3, '2021-07-31 00:00:00', '2021', 7, 31, 1),
(13, 3, '2021-08-05 00:00:00', '2021', 8, 5, 1),
(14, 4, '2021-07-01 00:00:00', '2021', 7, 1, 0),
(15, 4, '2021-07-31 00:00:00', '2021', 7, 31, 1),
(16, 4, '2021-08-30 00:00:00', '2021', 8, 30, 1),
(17, 4, '2021-09-29 00:00:00', '2021', 9, 29, 1),
(18, 4, '2021-10-29 00:00:00', '2021', 10, 29, 1),
(19, 4, '2021-11-28 00:00:00', '2021', 11, 28, 1),
(20, 4, '2021-12-28 00:00:00', '2021', 12, 28, 1),
(21, 4, '2022-01-27 00:00:00', '2022', 1, 27, 1),
(22, 4, '2022-02-26 00:00:00', '2022', 2, 26, 1),
(23, 4, '2022-03-28 00:00:00', '2022', 3, 28, 1),
(24, 4, '2022-04-27 00:00:00', '2022', 4, 27, 1),
(25, 4, '2022-05-27 00:00:00', '2022', 5, 27, 1),
(26, 5, '2021-07-22 00:00:00', '2021', 7, 22, 0),
(27, 5, '2021-08-06 00:00:00', '2021', 8, 6, 1),
(28, 5, '2021-08-21 00:00:00', '2021', 8, 21, 1),
(29, 5, '2021-09-05 00:00:00', '2021', 9, 5, 1),
(30, 5, '2021-09-20 00:00:00', '2021', 9, 20, 1),
(31, 5, '2021-10-05 00:00:00', '2021', 10, 5, 1),
(32, 5, '2021-10-20 00:00:00', '2021', 10, 20, 1),
(33, 5, '2021-11-04 00:00:00', '2021', 11, 4, 1),
(34, 5, '2021-11-19 00:00:00', '2021', 11, 19, 1),
(35, 5, '2021-12-04 00:00:00', '2021', 12, 4, 1),
(36, 5, '2021-12-19 00:00:00', '2021', 12, 19, 1),
(37, 5, '2022-01-03 00:00:00', '2022', 1, 3, 1),
(38, 6, '2021-07-22 00:00:00', '2021', 7, 22, 1),
(39, 6, '2021-08-06 00:00:00', '2021', 8, 6, 1),
(40, 6, '2021-08-21 00:00:00', '2021', 8, 21, 1),
(41, 6, '2021-09-05 00:00:00', '2021', 9, 5, 1),
(42, 6, '2021-09-20 00:00:00', '2021', 9, 20, 1),
(43, 6, '2021-10-05 00:00:00', '2021', 10, 5, 1),
(44, 6, '2021-10-20 00:00:00', '2021', 10, 20, 1),
(45, 6, '2021-11-04 00:00:00', '2021', 11, 4, 1),
(46, 6, '2021-11-19 00:00:00', '2021', 11, 19, 1),
(47, 6, '2021-12-04 00:00:00', '2021', 12, 4, 1),
(48, 6, '2021-12-19 00:00:00', '2021', 12, 19, 1),
(49, 6, '2022-01-03 00:00:00', '2022', 1, 3, 1),
(50, 7, '2021-06-28 00:00:00', '2021', 6, 28, 2),
(51, 7, '2021-07-28 00:00:00', '2021', 7, 28, 1),
(52, 7, '2021-08-27 00:00:00', '2021', 8, 27, 1),
(53, 7, '2021-09-26 00:00:00', '2021', 9, 26, 1),
(54, 7, '2021-10-26 00:00:00', '2021', 10, 26, 1),
(55, 7, '2021-11-25 00:00:00', '2021', 11, 25, 1),
(56, 7, '2021-12-25 00:00:00', '2021', 12, 25, 1),
(57, 7, '2022-01-24 00:00:00', '2022', 1, 24, 1),
(58, 7, '2022-02-23 00:00:00', '2022', 2, 23, 1),
(59, 7, '2022-03-25 00:00:00', '2022', 3, 25, 1),
(60, 7, '2022-04-24 00:00:00', '2022', 4, 24, 1),
(61, 7, '2022-05-24 00:00:00', '2022', 5, 24, 1),
(62, 8, '2021-06-29 00:00:00', '2021', 6, 29, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos`
--

CREATE TABLE `equipos` (
  `id_equipo` int(5) UNSIGNED NOT NULL,
  `codigo` varchar(20) NOT NULL,
  `sbn` varchar(20) NOT NULL,
  `nombre_equipo` varchar(100) NOT NULL,
  `modelo` varchar(100) NOT NULL,
  `manual` varchar(100) DEFAULT NULL,
  `imagen` varchar(100) DEFAULT NULL,
  `observacion` text,
  `idmarca` int(5) UNSIGNED NOT NULL,
  `idarea` int(5) UNSIGNED NOT NULL,
  `idsede` int(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `equipos`
--

INSERT INTO `equipos` (`id_equipo`, `codigo`, `sbn`, `nombre_equipo`, `modelo`, `manual`, `imagen`, `observacion`, `idmarca`, `idarea`, `idsede`) VALUES
(1, '123456', '23232323232323', 'nevera', '32wewe', '', NULL, 'prueba', 1, 1, 2),
(2, 'dds23232323', '12313113131313', 'lavadora', 'n323232', '', NULL, 'prueba', 2, 1, 2),
(3, 'EH-001', '2510112555511', 'Escavador HY4', 'Motor 255', '', 'bus.png', 'ninguno', 1, 1, 3),
(4, 'BAD-30', '602207380053', 'Balanza digital de 30 Kg', 'ACS-6502L-B', 'http://201.203.206.33:44737/Imagenes/0000000910250a.pdf', 'ACS-6502L-CON-TORRE.jpg', 'Ninguno', 3, 2, 4),
(5, 'ULC-001', '112275080003', 'ULTRACONGELADORA', 'DW-HL528S', '', 'dw-hl528s-2.jpg', '', 2, 2, 5),
(6, 'aut-0001', '322200250029', 'Autoclave', 'SM-510', 'https://files.yamato-net.co.jp/en/support/manual/pdf_manual/sm200-510ysa_es.pdf', 'unnamed.jpg', '', 3, 2, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `herramientas`
--

CREATE TABLE `herramientas` (
  `id_herramienta` int(5) UNSIGNED NOT NULL,
  `codigo` varchar(20) NOT NULL,
  `sbn` varchar(20) NOT NULL,
  `nombre_herramienta` varchar(100) NOT NULL,
  `imagen` varchar(100) DEFAULT NULL,
  `observacion` text,
  `idmarca` int(5) UNSIGNED NOT NULL,
  `idarea` int(5) UNSIGNED NOT NULL,
  `idsede` int(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `herramientas`
--

INSERT INTO `herramientas` (`id_herramienta`, `codigo`, `sbn`, `nombre_herramienta`, `imagen`, `observacion`, `idmarca`, `idarea`, `idsede`) VALUES
(1, '123456', '1231313131313', 'dfadfafa', NULL, 'dfafafafafafafa', 1, 1, 2),
(2, 'dsds32323', '12313131313131', 'dadafadfafafa', NULL, 'prueba', 1, 1, 2),
(3, '010021', '10214555210215', 'Celular huawei j10', 'camiones.png', 'ninguna', 2, 1, 3),
(4, 'ALI001', '123456789012', 'Alicate', 'KM-283.jpg', 'Ninguno', 1, 1, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mantenimientos`
--

CREATE TABLE `mantenimientos` (
  `id_mantenimiento` int(5) UNSIGNED NOT NULL,
  `idequipo` int(5) UNSIGNED NOT NULL,
  `fecha_operacion` date NOT NULL,
  `fecha_mantenimiento` date NOT NULL,
  `frecuencia` int(9) NOT NULL,
  `cantidad_mantenimiento` int(9) NOT NULL,
  `tipo_mantenimiento` enum('PREVENTIVO','CORRECTIVO','TOTAL') NOT NULL,
  `horas_uso` float NOT NULL,
  `periodo_garantia` date NOT NULL,
  `estado_alerta` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `mantenimientos`
--

INSERT INTO `mantenimientos` (`id_mantenimiento`, `idequipo`, `fecha_operacion`, `fecha_mantenimiento`, `frecuencia`, `cantidad_mantenimiento`, `tipo_mantenimiento`, `horas_uso`, `periodo_garantia`, `estado_alerta`) VALUES
(1, 1, '2021-06-20', '2021-06-20', 2, 2, 'PREVENTIVO', 2, '2021-06-20', 1),
(2, 1, '2021-06-20', '2021-06-21', 1, 1, 'CORRECTIVO', 0, '2021-06-20', 0),
(3, 3, '2021-06-21', '2021-06-21', 5, 10, 'PREVENTIVO', 0, '2021-06-21', 1),
(4, 4, '2021-06-01', '2021-07-01', 30, 12, 'PREVENTIVO', 5, '2021-06-20', 1),
(5, 5, '2021-06-22', '2021-07-22', 15, 12, 'PREVENTIVO', 24, '0000-00-00', 1),
(6, 5, '2021-06-22', '2021-07-22', 15, 12, 'PREVENTIVO', 24, '0000-00-00', 1),
(7, 6, '2019-01-01', '2021-06-28', 30, 12, 'PREVENTIVO', 5, '2021-01-01', 1),
(8, 1, '2021-06-28', '2021-06-29', 1, 1, 'PREVENTIVO', 4, '0000-00-00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

CREATE TABLE `marcas` (
  `id_marca` int(5) UNSIGNED NOT NULL,
  `nombre_marca` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `marcas`
--

INSERT INTO `marcas` (`id_marca`, `nombre_marca`) VALUES
(1, 'Aceb'),
(2, 'Samsung'),
(3, 'NAGOTA'),
(4, 'CANON');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(27, '2021-04-29-031649', 'App\\Database\\Migrations\\Sedes', 'default', 'App', 1624132544, 1),
(28, '2021-04-29-031659', 'App\\Database\\Migrations\\Cargos', 'default', 'App', 1624132545, 1),
(29, '2021-04-29-031707', 'App\\Database\\Migrations\\Areas', 'default', 'App', 1624132545, 1),
(30, '2021-04-29-031721', 'App\\Database\\Migrations\\Usuarios', 'default', 'App', 1624132545, 1),
(31, '2021-04-29-031753', 'App\\Database\\Migrations\\Marcas', 'default', 'App', 1624132546, 1),
(32, '2021-04-29-031823', 'App\\Database\\Migrations\\Herramientas', 'default', 'App', 1624132546, 1),
(33, '2021-04-29-031841', 'App\\Database\\Migrations\\Equipos', 'default', 'App', 1624132546, 1),
(34, '2021-04-29-031852', 'App\\Database\\Migrations\\Provedores', 'default', 'App', 1624132547, 1),
(35, '2021-04-29-031909', 'App\\Database\\Migrations\\Mantenimientos', 'default', 'App', 1624132547, 1),
(36, '2021-05-11-000034', 'App\\Database\\Migrations\\CronogramaNamtenimiento', 'default', 'App', 1624132548, 1),
(37, '2021-05-11-000035', 'App\\Database\\Migrations\\Ordenes', 'default', 'App', 1624132548, 1),
(38, '2021-05-18-002132', 'App\\Database\\Migrations\\Configuracion', 'default', 'App', 1624132548, 1),
(39, '2021-05-30-012911', 'App\\Database\\Migrations\\Actividades', 'default', 'App', 1624132549, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ordenes`
--

CREATE TABLE `ordenes` (
  `id_orden` int(5) UNSIGNED NOT NULL,
  `idcronograma` int(5) UNSIGNED NOT NULL,
  `fecha_registro` date NOT NULL,
  `fecha_orden` date NOT NULL,
  `nro_orden` varchar(10) NOT NULL,
  `costo` float NOT NULL,
  `descripcion_servicio` text NOT NULL,
  `repuestos_utilizados` text NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_final` time NOT NULL,
  `horas_total` time NOT NULL,
  `estado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ordenes`
--

INSERT INTO `ordenes` (`id_orden`, `idcronograma`, `fecha_registro`, `fecha_orden`, `nro_orden`, `costo`, `descripcion_servicio`, `repuestos_utilizados`, `hora_inicio`, `hora_final`, `horas_total`, `estado`) VALUES
(1, 1, '2021-06-20', '2021-06-20', '12131313', 23, 'prueba', 'alicates', '14:42:00', '18:42:00', '04:00:00', 1),
(2, 3, '2021-06-20', '2021-06-20', '12121', 12, 'sdsdsdsd', 'sdsdsdsdsd', '16:36:00', '19:36:00', '03:00:00', 1),
(3, 4, '2021-06-21', '2021-06-21', 'OH-0001', 10, 'Se ha realizado todas tas tareas planificadas', 'alicate, tuvos, filtros, aceite, alambre 25 mts. guantes de jebe', '10:11:00', '11:30:00', '01:19:00', 1),
(4, 14, '2021-06-22', '2021-07-01', '0001', 300, 'Se realizo mantenimiento preventivo a la balanza de 30 kg.', 'desarmadores y alicate ', '09:00:00', '11:00:00', '02:00:00', 1),
(5, 26, '2021-06-22', '2021-07-22', 'OT-0001', 300, 'se realizo mantenimiento preventivo del equipo....', 'alicate y desarmadores.', '09:00:00', '11:00:00', '02:00:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provedores`
--

CREATE TABLE `provedores` (
  `id_provedor` int(5) UNSIGNED NOT NULL,
  `ruc` varchar(10) NOT NULL,
  `razon_social` varchar(100) NOT NULL,
  `rubro` varchar(100) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `telefono` varchar(10) NOT NULL,
  `contacto` varchar(100) NOT NULL,
  `celular` varchar(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `tipo` enum('PRODUCTO','SERVICIO','AMBOS') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `provedores`
--

INSERT INTO `provedores` (`id_provedor`, `ruc`, `razon_social`, `rubro`, `direccion`, `telefono`, `contacto`, `celular`, `email`, `tipo`) VALUES
(2, '2055016160', 'Tecnología para la Industria Peruana S.A.C', 'Indrustria', 'Jr. José Antonio Roca N° 150 Santa Beatriz Lima', '015189156', 'Juan Perez', '978167537', 'borysrj29@yahoo.es', 'PRODUCTO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sedes`
--

CREATE TABLE `sedes` (
  `id_sede` int(5) UNSIGNED NOT NULL,
  `nombre_sede` varchar(100) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `imagen_sede` varchar(255) NOT NULL DEFAULT 'no_image.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `sedes`
--

INSERT INTO `sedes` (`id_sede`, `nombre_sede`, `direccion`, `imagen_sede`) VALUES
(1, 'Sistema de Gestión de Mantenimiento', 'San Isidro - Lima', 'cart.png'),
(2, 'Cite Orito', 'JR. Bariio alameda', 'no_image.jpg'),
(3, 'CITE Huancavelica', 'Jr ricardo Fernández ', 'carnett.png'),
(4, 'CITE Textil Camélidos Cusco', 'Urb. Parque Industrial, Av. Las Americas J1, Wanchac, Cusco', 'CITEtextil camelidos Cusco.png'),
(5, 'CITE Acuícola Ahuashiyacu', 'Carretera a Bello Horizonte Km 2.3, La Banda de Shilcayo – Tarapoto – San Martín', 'CITEacuicola_Ahuashiyacu.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(5) UNSIGNED NOT NULL,
  `usuario` varchar(30) NOT NULL,
  `password` varchar(200) NOT NULL,
  `nombres` varchar(200) NOT NULL,
  `dni` varchar(12) NOT NULL,
  `telefono` varchar(12) NOT NULL,
  `email` varchar(50) NOT NULL,
  `estado` int(1) NOT NULL,
  `idcargo` int(5) UNSIGNED NOT NULL,
  `idarea` int(5) UNSIGNED NOT NULL,
  `idsede` int(5) UNSIGNED NOT NULL,
  `imagen` varchar(100) NOT NULL DEFAULT 'no_image.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `usuario`, `password`, `nombres`, `dni`, `telefono`, `email`, `estado`, `idcargo`, `idarea`, `idsede`, `imagen`) VALUES
(1, 'admin', '$2y$10$DvibunEws3xjxUmIGDtFIeh9x651kPSMzDDNq2x9zTmHujR9BrLtG', 'Admin prueba', '12345678', '3211232123', 'admin@mantenimiento.com', 0, 1, 1, 1, 'cart.png'),
(2, 'fredy', '$2y$10$26snC9.9RjS9MFClzQYeyuUiWfz1y9kY7LVByc.qBbr8eE/NyI.yq', 'Fredy yela', '12323332', '44343434', 'admin@mantenimiento.com', 0, 2, 1, 2, 'no_image.jpg'),
(3, 'walter', '$2y$10$2snZ6BlyP5xzBocQLdWXge8QZR1Tj44ra/xFo.JrlN85csZvP/HFm', 'Walter Perez Sedano', '72297942', '958956958', 'admin@mantenimiento.com', 0, 2, 1, 3, 'asistencia.png'),
(4, 'borysrj', '$2y$10$HVLuW93Psn1z9kZXyHX3oOzZ8wRcV2J3my4tIQuOCV.o/zORj4Fiq', 'Borys Rojas', '42666741', '955302708', 'borysrj84@gmail.com', 0, 2, 2, 4, 'Usuario-Icono.jpg'),
(5, 'jperez', '$2y$10$PUd3d6Pz.qxrqWVEJzeQuO99ofDjZHJF1rQjIBRUG9b7b2I9sLu6i', 'Juan Perez', '42666741', '955302708', 'borysrj29@yahoo.es', 0, 2, 2, 5, 'Usuario-Icono.jpg');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividades`
--
ALTER TABLE `actividades`
  ADD KEY `actividades_idmantenimiento_foreign` (`idmantenimiento`);

--
-- Indices de la tabla `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id_area`);

--
-- Indices de la tabla `cargos`
--
ALTER TABLE `cargos`
  ADD PRIMARY KEY (`id_cargo`);

--
-- Indices de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  ADD PRIMARY KEY (`id_configuracion`);

--
-- Indices de la tabla `cronograma_mantenimientos`
--
ALTER TABLE `cronograma_mantenimientos`
  ADD PRIMARY KEY (`id_cronograma`),
  ADD KEY `cronograma_mantenimientos_idmantenimiento_foreign` (`idmantenimiento`);

--
-- Indices de la tabla `equipos`
--
ALTER TABLE `equipos`
  ADD PRIMARY KEY (`id_equipo`),
  ADD KEY `equipos_idmarca_foreign` (`idmarca`),
  ADD KEY `equipos_idarea_foreign` (`idarea`),
  ADD KEY `equipos_idsede_foreign` (`idsede`);

--
-- Indices de la tabla `herramientas`
--
ALTER TABLE `herramientas`
  ADD PRIMARY KEY (`id_herramienta`),
  ADD KEY `herramientas_idmarca_foreign` (`idmarca`),
  ADD KEY `herramientas_idarea_foreign` (`idarea`),
  ADD KEY `herramientas_idsede_foreign` (`idsede`);

--
-- Indices de la tabla `mantenimientos`
--
ALTER TABLE `mantenimientos`
  ADD PRIMARY KEY (`id_mantenimiento`),
  ADD KEY `mantenimientos_idequipo_foreign` (`idequipo`);

--
-- Indices de la tabla `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`id_marca`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ordenes`
--
ALTER TABLE `ordenes`
  ADD PRIMARY KEY (`id_orden`),
  ADD KEY `ordenes_idcronograma_foreign` (`idcronograma`);

--
-- Indices de la tabla `provedores`
--
ALTER TABLE `provedores`
  ADD PRIMARY KEY (`id_provedor`);

--
-- Indices de la tabla `sedes`
--
ALTER TABLE `sedes`
  ADD PRIMARY KEY (`id_sede`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `idsede` (`idsede`),
  ADD KEY `usuarios_idcargo_foreign` (`idcargo`),
  ADD KEY `usuarios_idarea_foreign` (`idarea`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `areas`
--
ALTER TABLE `areas`
  MODIFY `id_area` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `cargos`
--
ALTER TABLE `cargos`
  MODIFY `id_cargo` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  MODIFY `id_configuracion` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `cronograma_mantenimientos`
--
ALTER TABLE `cronograma_mantenimientos`
  MODIFY `id_cronograma` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT de la tabla `equipos`
--
ALTER TABLE `equipos`
  MODIFY `id_equipo` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `herramientas`
--
ALTER TABLE `herramientas`
  MODIFY `id_herramienta` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `mantenimientos`
--
ALTER TABLE `mantenimientos`
  MODIFY `id_mantenimiento` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `marcas`
--
ALTER TABLE `marcas`
  MODIFY `id_marca` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `ordenes`
--
ALTER TABLE `ordenes`
  MODIFY `id_orden` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `provedores`
--
ALTER TABLE `provedores`
  MODIFY `id_provedor` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `sedes`
--
ALTER TABLE `sedes`
  MODIFY `id_sede` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `actividades`
--
ALTER TABLE `actividades`
  ADD CONSTRAINT `actividades_idmantenimiento_foreign` FOREIGN KEY (`idmantenimiento`) REFERENCES `mantenimientos` (`id_mantenimiento`) ON DELETE CASCADE;

--
-- Filtros para la tabla `cronograma_mantenimientos`
--
ALTER TABLE `cronograma_mantenimientos`
  ADD CONSTRAINT `cronograma_mantenimientos_idmantenimiento_foreign` FOREIGN KEY (`idmantenimiento`) REFERENCES `mantenimientos` (`id_mantenimiento`) ON DELETE CASCADE;

--
-- Filtros para la tabla `equipos`
--
ALTER TABLE `equipos`
  ADD CONSTRAINT `equipos_idarea_foreign` FOREIGN KEY (`idarea`) REFERENCES `areas` (`id_area`),
  ADD CONSTRAINT `equipos_idmarca_foreign` FOREIGN KEY (`idmarca`) REFERENCES `marcas` (`id_marca`),
  ADD CONSTRAINT `equipos_idsede_foreign` FOREIGN KEY (`idsede`) REFERENCES `sedes` (`id_sede`);

--
-- Filtros para la tabla `herramientas`
--
ALTER TABLE `herramientas`
  ADD CONSTRAINT `herramientas_idarea_foreign` FOREIGN KEY (`idarea`) REFERENCES `areas` (`id_area`),
  ADD CONSTRAINT `herramientas_idmarca_foreign` FOREIGN KEY (`idmarca`) REFERENCES `marcas` (`id_marca`),
  ADD CONSTRAINT `herramientas_idsede_foreign` FOREIGN KEY (`idsede`) REFERENCES `sedes` (`id_sede`);

--
-- Filtros para la tabla `mantenimientos`
--
ALTER TABLE `mantenimientos`
  ADD CONSTRAINT `mantenimientos_idequipo_foreign` FOREIGN KEY (`idequipo`) REFERENCES `equipos` (`id_equipo`);

--
-- Filtros para la tabla `ordenes`
--
ALTER TABLE `ordenes`
  ADD CONSTRAINT `ordenes_idcronograma_foreign` FOREIGN KEY (`idcronograma`) REFERENCES `cronograma_mantenimientos` (`id_cronograma`) ON DELETE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_idarea_foreign` FOREIGN KEY (`idarea`) REFERENCES `areas` (`id_area`),
  ADD CONSTRAINT `usuarios_idcargo_foreign` FOREIGN KEY (`idcargo`) REFERENCES `cargos` (`id_cargo`),
  ADD CONSTRAINT `usuarios_idsede_foreign` FOREIGN KEY (`idsede`) REFERENCES `sedes` (`id_sede`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
