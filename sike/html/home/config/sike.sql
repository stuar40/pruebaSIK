-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 25-09-2020 a las 06:13:39
-- Versión del servidor: 5.7.26
-- Versión de PHP: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sike`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acciones`
--

DROP TABLE IF EXISTS `acciones`;
CREATE TABLE IF NOT EXISTS `acciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_accion` varchar(45) NOT NULL,
  `usuarios_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_acciones_usuarios1_idx` (`usuarios_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asesor`
--

DROP TABLE IF EXISTS `asesor`;
CREATE TABLE IF NOT EXISTS `asesor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(25) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `correo` varchar(35) DEFAULT NULL,
  `estado` varchar(8) NOT NULL,
  `empresa_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `correo_UNIQUE` (`correo`),
  KEY `fk_asesor_empresa1_idx` (`empresa_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

DROP TABLE IF EXISTS `categoria`;
CREATE TABLE IF NOT EXISTS `categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

DROP TABLE IF EXISTS `clientes`;
CREATE TABLE IF NOT EXISTS `clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) NOT NULL,
  `apellido` varchar(20) NOT NULL,
  `nit` varchar(15) DEFAULT NULL,
  `telefono` varchar(12) DEFAULT NULL,
  `direccion` varchar(60) DEFAULT NULL,
  `correo` varchar(35) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `correo_UNIQUE` (`correo`),
  UNIQUE KEY `nit_UNIQUE` (`nit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

DROP TABLE IF EXISTS `compra`;
CREATE TABLE IF NOT EXISTS `compra` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cantidad` int(11) NOT NULL,
  `precio` double NOT NULL,
  `producto_id` int(11) NOT NULL,
  `encabezado_compra_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_compra_producto1_idx` (`producto_id`),
  KEY `fk_compra_encabezado_compra1_idx` (`encabezado_compra_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra_recarga`
--

DROP TABLE IF EXISTS `compra_recarga`;
CREATE TABLE IF NOT EXISTS `compra_recarga` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `monto` double NOT NULL,
  `fecha` date NOT NULL,
  `empresa_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_compra_recarga_empresa1_idx` (`empresa_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_empresa`
--

DROP TABLE IF EXISTS `datos_empresa`;
CREATE TABLE IF NOT EXISTS `datos_empresa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(65) DEFAULT NULL,
  `direccion` varchar(75) DEFAULT NULL,
  `representante` varchar(45) DEFAULT NULL,
  `telefono` int(11) DEFAULT NULL,
  `nit` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `datos_empresa`
--

INSERT INTO `datos_empresa` (`id`, `nombre`, `direccion`, `representante`, `telefono`, `nit`) VALUES
(1, 'Kairos 1', 'San Pedro Sac.', 'Juan Fuentes', 52189086, '456789123'),
(2, 'Kairos 2', 'San Marcos', 'Pedro Martinez', 45999896, '489512345');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `egresos`
--

DROP TABLE IF EXISTS `egresos`;
CREATE TABLE IF NOT EXISTS `egresos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `monto` double NOT NULL,
  `fecha` date NOT NULL,
  `descripcion` text NOT NULL,
  `usuarios_id` int(11) NOT NULL,
  `compra_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_egresos_usuarios1_idx` (`usuarios_id`),
  KEY `fk_egresos_compra1_idx` (`compra_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

DROP TABLE IF EXISTS `empresa`;
CREATE TABLE IF NOT EXISTS `empresa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) NOT NULL,
  `nit` varchar(15) NOT NULL,
  `direccion` varchar(55) DEFAULT NULL,
  `telefono` varchar(12) DEFAULT NULL,
  `descripcion` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nit_UNIQUE` (`nit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encabezado_compra`
--

DROP TABLE IF EXISTS `encabezado_compra`;
CREATE TABLE IF NOT EXISTS `encabezado_compra` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `monto` double NOT NULL,
  `factura` int(11) DEFAULT NULL,
  `tipopago` varchar(15) NOT NULL,
  `asesor_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `factura_UNIQUE` (`factura`),
  KEY `fk_encabezado_compra_asesor1_idx` (`asesor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encabezado_venta`
--

DROP TABLE IF EXISTS `encabezado_venta`;
CREATE TABLE IF NOT EXISTS `encabezado_venta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date DEFAULT NULL,
  `total` double NOT NULL,
  `numfactura` varchar(45) DEFAULT NULL,
  `estado` varchar(45) DEFAULT 'ACTIVA',
  `clientes_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `numfactura_UNIQUE` (`numfactura`),
  KEY `fk_encabezado_venta_clientes1_idx` (`clientes_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_prod`
--

DROP TABLE IF EXISTS `estado_prod`;
CREATE TABLE IF NOT EXISTS `estado_prod` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `estado` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horarios`
--

DROP TABLE IF EXISTS `horarios`;
CREATE TABLE IF NOT EXISTS `horarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `horarios`
--

INSERT INTO `horarios` (`id`, `tipo`) VALUES
(1, 'Completo'),
(2, 'Matutino'),
(3, 'Vespertino'),
(4, 'Fin de Semana');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingresos`
--

DROP TABLE IF EXISTS `ingresos`;
CREATE TABLE IF NOT EXISTS `ingresos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `monto` double NOT NULL,
  `descripcion` text NOT NULL,
  `venta_id` int(11) DEFAULT NULL,
  `venta_recarga_id` int(11) DEFAULT NULL,
  `usuarios_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_ingresos_venta1_idx` (`venta_id`),
  KEY `fk_ingresos_venta_recarga1_idx` (`venta_recarga_id`),
  KEY `fk_ingresos_usuarios1_idx` (`usuarios_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `log`
--

DROP TABLE IF EXISTS `log`;
CREATE TABLE IF NOT EXISTS `log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `accion` varchar(25) NOT NULL,
  `acciones_id` int(11) NOT NULL,
  `usuarios_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_log_usuarios1_idx` (`usuarios_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `privilegios`
--

DROP TABLE IF EXISTS `privilegios`;
CREATE TABLE IF NOT EXISTS `privilegios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `privilegios` varchar(20) NOT NULL,
  `roles_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_privilegios_roles1_idx` (`roles_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

DROP TABLE IF EXISTS `producto`;
CREATE TABLE IF NOT EXISTS `producto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sku` varchar(25) DEFAULT NULL,
  `imagen` blob,
  `nombre` varchar(35) NOT NULL,
  `descripción` varchar(100) NOT NULL,
  `presentacion` varchar(50) NOT NULL,
  `marca` varchar(50) NOT NULL,
  `existencia` int(11) DEFAULT NULL,
  `precio_venta` double NOT NULL,
  `precio_minimo` double NOT NULL,
  `precio_promocion` double DEFAULT NULL,
  `estado_prod_id` int(11) NOT NULL,
  `sucursal_id` int(11) NOT NULL,
  `subcategoria_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_producto_estado_prod1_idx` (`estado_prod_id`),
  KEY `fk_producto_sucursal1_idx` (`sucursal_id`),
  KEY `fk_producto_subcategoria1_idx` (`subcategoria_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `nombre`) VALUES
(1, 'Administador'),
(2, 'Empleado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `saldo`
--

DROP TABLE IF EXISTS `saldo`;
CREATE TABLE IF NOT EXISTS `saldo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `saldo` double NOT NULL,
  `compra_recarga_id` int(11) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `sucursal_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_saldo_compra_recarga1_idx` (`compra_recarga_id`),
  KEY `fk_saldo_categoria1_idx` (`categoria_id`),
  KEY `fk_saldo_sucursal1_idx` (`sucursal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcategoria`
--

DROP TABLE IF EXISTS `subcategoria`;
CREATE TABLE IF NOT EXISTS `subcategoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(35) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_subcategoria_categoria_idx` (`categoria_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursal`
--

DROP TABLE IF EXISTS `sucursal`;
CREATE TABLE IF NOT EXISTS `sucursal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numero` int(11) NOT NULL,
  `direccion` varchar(45) DEFAULT NULL,
  `datos_empresa_id1` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `numero_UNIQUE` (`numero`),
  KEY `fk_sucursal_datos_empresa1_idx` (`datos_empresa_id1`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `sucursal`
--

INSERT INTO `sucursal` (`id`, `numero`, `direccion`, `datos_empresa_id1`) VALUES
(1, 1, 'San Pedro Sac.S.M', 1),
(2, 2, 'San Marcos', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_plan`
--

DROP TABLE IF EXISTS `tipo_plan`;
CREATE TABLE IF NOT EXISTS `tipo_plan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_plan` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pnom` varchar(25) NOT NULL,
  `snom` varchar(25) DEFAULT NULL,
  `pape` varchar(25) NOT NULL,
  `sape` varchar(25) DEFAULT NULL,
  `nacimiento` date DEFAULT NULL,
  `nombre_usuario` varchar(35) NOT NULL,
  `telefono` varchar(12) DEFAULT NULL,
  `direccion` varchar(75) NOT NULL,
  `dpi` varchar(15) NOT NULL,
  `password` varchar(25) NOT NULL,
  `correo` varchar(40) NOT NULL,
  `foto_perfil` blob,
  `estado` varchar(10) NOT NULL,
  `roles_id` int(11) NOT NULL,
  `horarios_id` int(11) DEFAULT NULL,
  `sucursal_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `dpi_UNIQUE` (`dpi`),
  UNIQUE KEY `correo_UNIQUE` (`correo`),
  KEY `fk_usuarios_roles1_idx` (`roles_id`),
  KEY `fk_usuarios_horarios1_idx` (`horarios_id`),
  KEY `fk_usuarios_sucursal1_idx` (`sucursal_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `pnom`, `snom`, `pape`, `sape`, `nacimiento`, `nombre_usuario`, `telefono`, `direccion`, `dpi`, `password`, `correo`, `foto_perfil`, `estado`, `roles_id`, `horarios_id`, `sucursal_id`) VALUES
(0, 'Lidvin', 'Osbeli', 'Fuentes', 'Navarro', '1993-09-16', 'Lidvin', '46234378', 'San Jose Caben, San Pedro', '2175589611202', '1234', 'lidvinf@gmail.com', NULL, 'ACTIVO', 1, 1, 1),
(1, 'Ricardo', 'Rocael', 'Mendez', 'Perez', '2002-05-15', 'Ricardo', '45896456', 'El mosquito, San Pedro Sac. S.M', '2173896951202', '123456', 'pepe@gmail.com', NULL, 'ACTIVO', 1, 1, 1),
(2, 'Matiaz', 'Algolan', 'Santizo', 'Santizo', '2000-02-15', 'Matiaz', '45897896', 'San Isidro Chamac, San Marcos', '2178963611202', '123456789', 'matiaz@gmail.com', NULL, 'ACTIVO', 1, 1, 1),
(3, 'Petronila', 'Cariola', 'Sacalepunta', 'Morales', '1999-05-15', 'Petronila', '45896456', 'San Isidro Chamac, San Marcos', '2178966921202', '12121212', 'petronila@gmail.com', NULL, 'ACTIVO', 1, 1, 1),
(4, 'Juanito', 'Juanito', 'Sopon', 'Sopon', '2000-05-15', 'sopon', '45645896', 'Zona 2, San Pedro Sac. S.M. Guatemala', '2158966931202', '123456789456', 'sopon@gmail.com', NULL, 'ACTIVO', 1, 1, 1),
(13, 'Felipe', 'Milgen', 'Macario', 'Macario', '2000-05-15', 'Felipe', '456789789', 'San Marcos', '2176696951202', '123456465456', 'pepe2@gmail.com', NULL, 'ACTIVO', 1, 1, 1),
(14, 'Uno', 'uno', 'dos', 'dos', '2000-05-15', '15', '12345678', 'San Marcos', '2158963621202', '123132123123', '15@gmail.com', NULL, 'ACTIVO', 1, 1, 1),
(15, 'tres', 'tres', 'kl', 'klk', '2000-12-15', 'Juan', '123456789', 'El mosquito, San Pedro Sac. S.M', '2115896951202', '45646546', 'juab@gmail.com', NULL, 'ACTIVO', 1, 1, 1),
(16, 'Milvia', 'Maribel', 'Navarro', 'Lopez', '2009-05-08', 'Milvia', '45333434', 'El mosquito, San Pedro Sac. S.M', '2589696921202', '4533', 'mil@gmail.com', NULL, 'ACTIVO', 1, 1, 1),
(17, 'jajaj', 'ajjaj', 'jajaj', 'ajjajaj', '2009-09-09', 'lk', '8585896', 'San Isidro Chamac, San Marcos', '2158969691202', '45646', 'ldo@gmail.com', NULL, 'ACTIVO', 1, 1, 1),
(18, '778', '78', '78', '778', '2000-08-04', '4545', '156464', '4545', '7878', '456456', '444444@gmail.com', NULL, 'ACTIVO', 1, 1, 1),
(19, 'ioi', 'ipoio', 'ppipi', 'ipoi', '2001-01-01', '4', '4894949', 'San Marcos', '1231321', '4564', '54648@gmail.com', NULL, 'INACTIVO', 1, 1, 1),
(20, 'Mau2', 'Marcos', 'Matiaz', 'Sebastian', '2000-05-01', 'Mau', '859845645', 'San Marcos, Guatemala', '2178847511202', '896543', 'mmk@gmail.com', NULL, 'ACTIVO', 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

DROP TABLE IF EXISTS `venta`;
CREATE TABLE IF NOT EXISTS `venta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cantidad` int(11) NOT NULL,
  `precio` double NOT NULL,
  `subtotal` double NOT NULL,
  `producto_id` int(11) NOT NULL,
  `encabezado_venta_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_venta_producto1_idx` (`producto_id`),
  KEY `fk_venta_encabezado_venta1_idx` (`encabezado_venta_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta_recarga`
--

DROP TABLE IF EXISTS `venta_recarga`;
CREATE TABLE IF NOT EXISTS `venta_recarga` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numero` varchar(15) NOT NULL,
  `monto` double NOT NULL,
  `fecha` date NOT NULL,
  `saldo_id` int(11) NOT NULL,
  `tipo_plan_id` int(11) NOT NULL,
  `sucursal_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_venta_recarga_saldo1_idx` (`saldo_id`),
  KEY `fk_venta_recarga_tipo_plan1_idx` (`tipo_plan_id`),
  KEY `fk_venta_recarga_sucursal1_idx` (`sucursal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `acciones`
--
ALTER TABLE `acciones`
  ADD CONSTRAINT `fk_acciones_usuarios1` FOREIGN KEY (`usuarios_id`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `asesor`
--
ALTER TABLE `asesor`
  ADD CONSTRAINT `fk_asesor_empresa1` FOREIGN KEY (`empresa_id`) REFERENCES `empresa` (`id`);

--
-- Filtros para la tabla `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `fk_compra_encabezado_compra1` FOREIGN KEY (`encabezado_compra_id`) REFERENCES `encabezado_compra` (`id`),
  ADD CONSTRAINT `fk_compra_producto1` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`);

--
-- Filtros para la tabla `compra_recarga`
--
ALTER TABLE `compra_recarga`
  ADD CONSTRAINT `fk_compra_recarga_empresa1` FOREIGN KEY (`empresa_id`) REFERENCES `empresa` (`id`);

--
-- Filtros para la tabla `egresos`
--
ALTER TABLE `egresos`
  ADD CONSTRAINT `fk_egresos_compra1` FOREIGN KEY (`compra_id`) REFERENCES `compra` (`id`),
  ADD CONSTRAINT `fk_egresos_usuarios1` FOREIGN KEY (`usuarios_id`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `encabezado_compra`
--
ALTER TABLE `encabezado_compra`
  ADD CONSTRAINT `fk_encabezado_compra_asesor1` FOREIGN KEY (`asesor_id`) REFERENCES `asesor` (`id`);

--
-- Filtros para la tabla `encabezado_venta`
--
ALTER TABLE `encabezado_venta`
  ADD CONSTRAINT `fk_encabezado_venta_clientes1` FOREIGN KEY (`clientes_id`) REFERENCES `clientes` (`id`);

--
-- Filtros para la tabla `ingresos`
--
ALTER TABLE `ingresos`
  ADD CONSTRAINT `fk_ingresos_usuarios1` FOREIGN KEY (`usuarios_id`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `fk_ingresos_venta1` FOREIGN KEY (`venta_id`) REFERENCES `venta` (`id`),
  ADD CONSTRAINT `fk_ingresos_venta_recarga1` FOREIGN KEY (`venta_recarga_id`) REFERENCES `venta_recarga` (`id`);

--
-- Filtros para la tabla `log`
--
ALTER TABLE `log`
  ADD CONSTRAINT `fk_log_usuarios1` FOREIGN KEY (`usuarios_id`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `privilegios`
--
ALTER TABLE `privilegios`
  ADD CONSTRAINT `fk_privilegios_roles1` FOREIGN KEY (`roles_id`) REFERENCES `roles` (`id`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `fk_producto_estado_prod1` FOREIGN KEY (`estado_prod_id`) REFERENCES `estado_prod` (`id`),
  ADD CONSTRAINT `fk_producto_subcategoria1` FOREIGN KEY (`subcategoria_id`) REFERENCES `subcategoria` (`id`),
  ADD CONSTRAINT `fk_producto_sucursal1` FOREIGN KEY (`sucursal_id`) REFERENCES `sucursal` (`id`);

--
-- Filtros para la tabla `saldo`
--
ALTER TABLE `saldo`
  ADD CONSTRAINT `fk_saldo_categoria1` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`id`),
  ADD CONSTRAINT `fk_saldo_compra_recarga1` FOREIGN KEY (`compra_recarga_id`) REFERENCES `compra_recarga` (`id`),
  ADD CONSTRAINT `fk_saldo_sucursal1` FOREIGN KEY (`sucursal_id`) REFERENCES `sucursal` (`id`);

--
-- Filtros para la tabla `subcategoria`
--
ALTER TABLE `subcategoria`
  ADD CONSTRAINT `fk_subcategoria_categoria` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`id`);

--
-- Filtros para la tabla `sucursal`
--
ALTER TABLE `sucursal`
  ADD CONSTRAINT `fk_sucursal_datos_empresa1` FOREIGN KEY (`datos_empresa_id1`) REFERENCES `datos_empresa` (`id`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_usuarios_horarios1` FOREIGN KEY (`horarios_id`) REFERENCES `horarios` (`id`),
  ADD CONSTRAINT `fk_usuarios_roles1` FOREIGN KEY (`roles_id`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `fk_usuarios_sucursal1` FOREIGN KEY (`sucursal_id`) REFERENCES `sucursal` (`id`);

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `fk_venta_encabezado_venta1` FOREIGN KEY (`encabezado_venta_id`) REFERENCES `encabezado_venta` (`id`),
  ADD CONSTRAINT `fk_venta_producto1` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`);

--
-- Filtros para la tabla `venta_recarga`
--
ALTER TABLE `venta_recarga`
  ADD CONSTRAINT `fk_venta_recarga_saldo1` FOREIGN KEY (`saldo_id`) REFERENCES `saldo` (`id`),
  ADD CONSTRAINT `fk_venta_recarga_sucursal1` FOREIGN KEY (`sucursal_id`) REFERENCES `sucursal` (`id`),
  ADD CONSTRAINT `fk_venta_recarga_tipo_plan1` FOREIGN KEY (`tipo_plan_id`) REFERENCES `tipo_plan` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
