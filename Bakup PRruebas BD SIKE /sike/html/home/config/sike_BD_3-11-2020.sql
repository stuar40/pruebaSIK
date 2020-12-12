-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 03-11-2020 a las 22:18:48
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

DELIMITER $$
--
-- Procedimientos
--
DROP PROCEDURE IF EXISTS `add_detallecompra_temp`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `add_detallecompra_temp` (IN `idprod` INT, IN `cantidad` INT, IN `precio` DECIMAL(10,2), IN `token_user` INT)  BEGIN
    Insert Into detalle_compra_temp(token_user,cantidad,precio_compra,producto_idproducto)
    VALUES (token_user, cantidad,precio,idprod);
   
                          
    SELECT tmp.iddetalle_compra_temp,producto.nombre, producto.descripcion,
    producto.presentacion,producto.marca,tmp.cantidad,tmp.precio_compra 
    FROM detalle_compra_temp tmp
    INNER JOIN producto on tmp.producto_idproducto = producto.id
    where tmp.token_user = token_user;
    END$$

DROP PROCEDURE IF EXISTS `add_detalleventa_temp`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `add_detalleventa_temp` (`idprod` INT, `cant` INT, `token_user` INT, `sucur` INT, `precio` DECIMAL(10,2))  BEGIN
		DECLARE precio_actual decimal (10,2);

        INSERT INTO detalleventa_tmp(token_user,cantidad,precio_venta,producto_idproducto)
        VALUES (token_user,cant, precio,idprod);
        
        SELECT tmp.iddetalleventa_tmp, tmp.producto_idproducto,producto.sku, 
        producto.nombre,producto.descripcion,producto.descripcion,producto.presentacion,
        producto.marca,tmp.cantidad,tmp.precio_venta from 
        detalleventa_tmp tmp inner join producto  on tmp.producto_idproducto = producto.id
        WHERE tmp.token_user = token_user;
        
    END$$

DROP PROCEDURE IF EXISTS `del_detalleventa_temp`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `del_detalleventa_temp` (`id_detalle` INT, `token` INT)  BEGIN
		DELETE FROM detalleventa_tmp WHERE iddetalleventa_tmp = id_detalle;
        SELECT tmp.iddetalleventa_tmp, tmp.producto_idproducto,producto.sku, 
        producto.nombre,producto.descripcion,producto.descripcion,producto.presentacion,
        producto.marca,tmp.cantidad,tmp.precio_venta from 
        detalleventa_tmp tmp inner join producto  on tmp.producto_idproducto = producto.id
        WHERE tmp.token_user = token_user;
	END$$

DROP PROCEDURE IF EXISTS `del_detalle_temp`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `del_detalle_temp` (`id_detalle` INT, `token` INT)  BEGIN
DELETE FROM detalle_compra_temp WHERE iddetalle_compra_temp = id_detalle;

  SELECT tmp.iddetalle_compra_temp,producto.nombre, producto.descripcion,
    producto.presentacion,producto.marca,tmp.cantidad,tmp.precio_compra 
    FROM detalle_compra_temp tmp
    INNER JOIN producto on tmp.producto_idproducto = producto.id
    where tmp.token_user = token_user;
END$$

DROP PROCEDURE IF EXISTS `procesar_compra`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `procesar_compra` (`proveedor` INT, `fact` VARCHAR(20), `token` INT, `sucursal` INT)  BEGIN
		DECLARE compras INT;
        
        DECLARE registros INT;
        DECLARE total DECIMAL(10,2);
        DECLARE precio DECIMAL(10,2);
        
        DECLARE nueva_existencia int;
        DECLARE existencia_actual int;
        
        DECLARE nuevo_precio DECIMAL(10,2);
        DECLARE precio_actual DECIMAL(10,2);
        
        DECLARE tmp_id_producto int;
        DECLARE tmp_cant_producto int;
        DECLARE tmp_precio_producto DECIMAL(10,2);
        DECLARE a INT;
        SET a = 1;
	
        CREATE TEMPORARY TABLE tbl_tmp_tokenuser(
        id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        idprod BIGINT,
        cantprod int,
        precioahora DECIMAL(10,2));
        
        SET registros = (SELECT COUNT(*) FROM detalle_compra_temp WHERE token_user = token);
		IF registros > 0 THEN
			INSERT INTO tbl_tmp_tokenuser (idprod,cantprod,precioahora) SELECT producto_idproducto,cantidad,precio_compra FROM detalle_compra_temp WHERE token_user = token;
            INSERT INTO encabezado_compra (usuarios_idusuarios,factura,proveedor_idproveedor,sucursal_idsucursal) VALUES (token,fact,proveedor,sucursal);
            SET compras = LAST_INSERT_ID();
            INSERT INTO detallecompra(encabezado_compra_id,producto_idproducto, cantidad,precio_compra ) SELECT (compras) as idcompra,producto_idproducto,cantidad,precio_compra 
            FROM 	detalle_compra_temp
            WHERE token_user = token;
            WHILE a <= registros DO
            SELECT idprod,cantprod,precioahora INTO tmp_id_producto,tmp_cant_producto,tmp_precio_producto FROM tbl_tmp_tokenuser WHERE id = a;
            SELECT existencia,precio_costo INTO existencia_actual,precio_actual FROM precios WHERE precios.producto_idproducto = tmp_id_producto AND sucursal_idsucursal = sucursal;
            
            SET nueva_existencia = existencia_actual + tmp_cant_producto;
            SET nuevo_precio = tmp_precio_producto;
            UPDATE precios SET existencia = nueva_existencia, precio_costo = nuevo_precio WHERE precios.producto_idproducto = tmp_id_producto and precios.sucursal_idsucursal = sucursal;
            
            SET a=a+1;
            
            END WHILE;
            SET total = (SELECT SUM(cantidad * precio_compra) FROM detalle_compra_temp WHERE token_user = token);
            UPDATE encabezado_compra SET encabezado_compra.totalcompra = total WHERE encabezado_compra.id = compras;
            DELETE FROM  detalle_compra_temp WHERE token_user = token;
            TRUNCATE TABLE tbl_tmp_tokenuser;
            SELECT * FROM encabezado_compra WHERE encabezado_compra.id = compras;
        ELSE
			SELECT 0;
            END IF;
    END$$

DROP PROCEDURE IF EXISTS `venta`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `venta` (`cod_cliente` INT, `token` INT, `fact` VARCHAR(15), `sucurs` INT)  BEGIN 
			DECLARE factura INT;
            
            DECLARE registros INT;
            DECLARE total decimal(10,2);
            
            DECLARE nueva_existencia int;
            DECLARE existencia_actual int;
            
            DECLARE tmp_cod_producto int;
            DECLARE tmp_cant_producto int;
            DECLARE a int;
            SET a = 1;
              DROP TABLE tbl_tmp_token;
			CREATE TEMPORARY TABLE IF NOT EXISTS tbl_tmp_token (
            id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
            cod_prod BIGINT,
            cant_prod INT);
            
            SET registros = (SELECT COUNT(*) FROM detalleventa_tmp WHERE token_user = token );
            
            IF registros > 0 THEN 
				INSERT INTO tbl_tmp_token (cod_prod, cant_prod) SELECT producto_idproducto, cantidad 
                FROM detalleventa_tmp WHERE token_user = token;
                
                INSERT INTO encabezado_venta (numfactura,clientes_id,usuarios_idusuarios,sucursal_idsucursal)
                VALUES (fact,cod_cliente,token,sucurs);
                SET factura = LAST_INSERT_ID();
                
                INSERT INTO detalleventa (encabezado_venta_id,producto_idproducto,cantidad,precio) SELECT (factura) as encabezado_venta_idencabezado, producto_idproducto,cantidad,precio_venta 
                FROM detalleventa_tmp WHERE token_user= token;
                
                WHILE a <= registros DO 
					SELECT cod_prod, cant_prod INTO tmp_cod_producto,tmp_cant_producto FROM tbl_tmp_token WHERE id = a;
                    SELECT existencia INTO existencia_actual FROM precios WHERE producto_idproducto = tmp_cod_producto AND sucursal_idsucursal = sucurs;
                    
                    SET nueva_existencia = existencia_actual - tmp_cant_producto;
                    UPDATE precios SET existencia = nueva_existencia WHERE producto_idproducto = tmp_cod_producto AND sucursal_idsucursal = sucurs ;
                SET a= a+1;
                END WHILE;
                SET total = (SELECT SUM(cantidad * precio_venta) FROM detalleventa_tmp WHERE token_user = token);
                UPDATE encabezado_venta SET totalfactura = total WHERE encabezado_venta.id = factura;
                DELETE FROM detalleventa_tmp WHERE token_user = token;
                TRUNCATE TABLE tbl_tmp_token;
                SELECT * FROM encabezado_venta WHERE encabezado_venta.id = factura;
                
            ELSE
            SELECT 0;
            END IF;

END$$

DELIMITER ;

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
  `nombre` varchar(100) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `correo` varchar(35) DEFAULT NULL,
  `estado` varchar(8) NOT NULL,
  `empresa_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `correo_UNIQUE` (`correo`),
  KEY `fk_asesor_empresa1_idx` (`empresa_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `asesor`
--

INSERT INTO `asesor` (`id`, `nombre`, `telefono`, `correo`, `estado`, `empresa_id`) VALUES
(1, 'gerardo', '641654', 'ge@gmail.com', '1', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

DROP TABLE IF EXISTS `categoria`;
CREATE TABLE IF NOT EXISTS `categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id`, `nombre`) VALUES
(1, 'Telefonia'),
(2, 'Libreria'),
(3, 'Cosmeticos');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `apellido`, `nit`, `telefono`, `direccion`, `correo`) VALUES
(1, 'gerard', 'dominguez', '12459', '31232', 'asdf', '1231');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `datos_empresa`
--

INSERT INTO `datos_empresa` (`id`, `nombre`, `direccion`, `representante`, `telefono`, `nit`) VALUES
(1, 'SIKE', 'SAN MARCOS', 'Juan', 77608248, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallecompra`
--

DROP TABLE IF EXISTS `detallecompra`;
CREATE TABLE IF NOT EXISTS `detallecompra` (
  `iddetallecompra` int(11) NOT NULL AUTO_INCREMENT,
  `cantidad` int(11) NOT NULL,
  `precio_compra` decimal(10,2) NOT NULL,
  `encabezado_compra_id` int(11) DEFAULT NULL,
  `producto_idproducto` int(11) NOT NULL,
  PRIMARY KEY (`iddetallecompra`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `detallecompra`
--

INSERT INTO `detallecompra` (`iddetallecompra`, `cantidad`, `precio_compra`, `encabezado_compra_id`, `producto_idproducto`) VALUES
(1, 55, '45.50', 3, 1),
(2, 700, '480.00', 3, 3),
(3, 500, '250.00', 3, 2),
(4, 55, '45.50', 6, 1),
(5, 700, '480.00', 6, 3),
(6, 500, '250.00', 6, 2),
(7, 1, '0.02', 7, 1),
(8, 1, '0.03', 8, 1),
(9, 1, '0.04', 9, 1),
(10, 1, '0.02', 10, 1),
(11, 1, '0.02', 11, 1),
(12, 1, '0.01', 12, 1),
(13, 1, '0.02', 13, 1),
(14, 1, '0.02', 14, 1),
(15, 1, '0.01', 15, 1),
(16, 1, '0.02', 16, 1),
(17, 1, '0.01', 17, 2),
(18, 1, '0.01', 17, 2),
(20, 1, '0.02', 18, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleventa`
--

DROP TABLE IF EXISTS `detalleventa`;
CREATE TABLE IF NOT EXISTS `detalleventa` (
  `iddetalleventa` int(11) NOT NULL AUTO_INCREMENT,
  `cantidad` int(11) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `encabezado_venta_id` int(11) DEFAULT NULL,
  `producto_idproducto` int(11) DEFAULT NULL,
  PRIMARY KEY (`iddetalleventa`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `detalleventa`
--

INSERT INTO `detalleventa` (`iddetalleventa`, `cantidad`, `precio`, `encabezado_venta_id`, `producto_idproducto`) VALUES
(1, 75, '75.00', 1, 1),
(2, 150, '250.00', 1, 2),
(3, 150, '25.25', 1, 3),
(4, 350, '15.75', 2, 3),
(5, 150, '15.50', 2, 2),
(6, 25, '25.25', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleventa_tmp`
--

DROP TABLE IF EXISTS `detalleventa_tmp`;
CREATE TABLE IF NOT EXISTS `detalleventa_tmp` (
  `iddetalleventa_tmp` int(11) NOT NULL AUTO_INCREMENT,
  `token_user` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_venta` decimal(10,2) DEFAULT NULL,
  `producto_idproducto` int(11) NOT NULL,
  PRIMARY KEY (`iddetalleventa_tmp`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_compra_temp`
--

DROP TABLE IF EXISTS `detalle_compra_temp`;
CREATE TABLE IF NOT EXISTS `detalle_compra_temp` (
  `iddetalle_compra_temp` int(11) NOT NULL AUTO_INCREMENT,
  `token_user` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `precio_compra` decimal(10,2) DEFAULT NULL,
  `producto_idproducto` int(11) DEFAULT NULL,
  PRIMARY KEY (`iddetalle_compra_temp`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

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
  `nombre` varchar(100) NOT NULL,
  `nit` varchar(15) NOT NULL,
  `direccion` varchar(150) DEFAULT NULL,
  `telefono` varchar(12) DEFAULT NULL,
  `descripcion` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nit_UNIQUE` (`nit`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`id`, `nombre`, `nit`, `direccion`, `telefono`, `descripcion`) VALUES
(1, 'sike', '564654', 'sadfasdf', '4684568', 'asdf486as5d4'),
(2, 'Claro', '13245', 'san marcos', '55667788', 'para la compra de saldo '),
(3, 'Tigo', '54321', 'san marcos', '48494546', 'para la compra de saldo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encabezado_compra`
--

DROP TABLE IF EXISTS `encabezado_compra`;
CREATE TABLE IF NOT EXISTS `encabezado_compra` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(10) NOT NULL DEFAULT 'ACTIVO',
  `totalcompra` decimal(10,2) NOT NULL,
  `factura` int(11) DEFAULT NULL,
  `proveedor_idproveedor` varchar(15) NOT NULL,
  `usuarios_idusuarios` int(11) DEFAULT NULL,
  `sucursal_idsucursal` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `encabezado_compra`
--

INSERT INTO `encabezado_compra` (`id`, `fecha`, `status`, `totalcompra`, `factura`, `proveedor_idproveedor`, `usuarios_idusuarios`, `sucursal_idsucursal`) VALUES
(7, '2020-11-03 06:10:38', '', '0.02', 0, '2', 4, 2),
(8, '2020-11-03 06:15:30', 'ACTIVO', '0.03', 0, '2', 4, 2),
(9, '2020-11-03 06:17:12', 'ACTIVO', '0.04', 0, '2', 4, 2),
(10, '2020-11-03 06:29:31', 'ACTIVO', '0.02', 2, '2', 4, 1),
(11, '2020-11-03 00:44:27', 'ACTIVO', '0.02', 0, '2', 4, 2),
(12, '2020-11-03 00:45:58', 'ACTIVO', '0.01', 0, '2', 4, 2),
(13, '2020-11-03 00:46:52', 'ACTIVO', '0.02', 0, '2', 4, 2),
(14, '2020-11-03 00:48:41', 'ACTIVO', '0.02', 0, '2', 4, 2),
(15, '2020-11-03 00:49:47', 'ACTIVO', '0.01', 0, '2', 4, 2),
(16, '2020-11-03 00:51:10', 'ACTIVO', '0.02', 5, '2', 4, 2),
(17, '2020-11-03 00:53:57', 'ACTIVO', '0.02', 0, '2', 4, 2),
(18, '2020-11-03 00:54:39', 'ACTIVO', '0.02', 0, '2', 4, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encabezado_venta`
--

DROP TABLE IF EXISTS `encabezado_venta`;
CREATE TABLE IF NOT EXISTS `encabezado_venta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numfactura` varchar(25) DEFAULT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `totalfactura` decimal(10,2) DEFAULT NULL,
  `clientes_id` int(11) DEFAULT NULL,
  `estatus` varchar(45) NOT NULL DEFAULT 'ACTIVO',
  `sucursal_idsucursal` int(11) DEFAULT NULL,
  `usuarios_idusuarios` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_encabezado_venta_clientes1_idx` (`clientes_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `encabezado_venta`
--

INSERT INTO `encabezado_venta` (`id`, `numfactura`, `fecha`, `totalfactura`, `clientes_id`, `estatus`, `sucursal_idsucursal`, `usuarios_idusuarios`) VALUES
(1, '123', '2020-11-02 21:51:58', '46912.50', 1, 'ACTIVO', 1, 1),
(2, '154', '2020-11-02 21:57:24', '8468.75', 1, 'ACTIVO', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_prod`
--

DROP TABLE IF EXISTS `estado_prod`;
CREATE TABLE IF NOT EXISTS `estado_prod` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `estado` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `estado_prod`
--

INSERT INTO `estado_prod` (`id`, `estado`) VALUES
(1, 'activo'),
(2, 'inactivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horarios`
--

DROP TABLE IF EXISTS `horarios`;
CREATE TABLE IF NOT EXISTS `horarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `horarios`
--

INSERT INTO `horarios` (`id`, `tipo`) VALUES
(5, 'Completo'),
(6, 'Matutino'),
(7, 'Vespertino'),
(8, 'Fin de semana');

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
-- Estructura de tabla para la tabla `precios`
--

DROP TABLE IF EXISTS `precios`;
CREATE TABLE IF NOT EXISTS `precios` (
  `idprecios` int(11) NOT NULL AUTO_INCREMENT,
  `existencia` int(11) NOT NULL,
  `precio_costo` decimal(10,2) NOT NULL,
  `precio_venta` decimal(10,2) NOT NULL,
  `precio_minimo` decimal(10,2) DEFAULT NULL,
  `precio_promocion` decimal(10,2) DEFAULT NULL,
  `estado` varchar(15) NOT NULL DEFAULT 'ACTIVO',
  `producto_idproducto` int(11) NOT NULL,
  `sucursal_idsucursal` int(11) NOT NULL,
  `usuario_idusuarios` int(11) NOT NULL,
  PRIMARY KEY (`idprecios`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `precios`
--

INSERT INTO `precios` (`idprecios`, `existencia`, `precio_costo`, `precio_venta`, `precio_minimo`, `precio_promocion`, `estado`, `producto_idproducto`, `sucursal_idsucursal`, `usuario_idusuarios`) VALUES
(1, 6, '0.02', '150.00', '120.00', '60.00', 'ACTIVO', 1, 1, 1),
(2, 300, '250.00', '42.00', NULL, NULL, 'ACTIVO', 2, 1, 1),
(3, 350, '480.00', '87.00', NULL, NULL, 'ACTIVO', 3, 1, 1);

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
  `descripcion` varchar(100) NOT NULL,
  `presentacion` varchar(50) NOT NULL,
  `marca` varchar(50) NOT NULL,
  `estado_prod_id` int(11) NOT NULL,
  `subcategoria_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_producto_estado_prod1_idx` (`estado_prod_id`),
  KEY `fk_producto_subcategoria1_idx` (`subcategoria_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `sku`, `imagen`, `nombre`, `descripcion`, `presentacion`, `marca`, `estado_prod_id`, `subcategoria_id`) VALUES
(1, '001', NULL, 'lapiz2', 'hb', 'caja', 'faber castell', 1, 1),
(2, '002', NULL, 'lapiz', 'h2', 'caja', 'faber castell', 1, 1),
(3, '003', NULL, 'lapicero', 'rojo', 'caja', 'faber castell', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recarga`
--

DROP TABLE IF EXISTS `recarga`;
CREATE TABLE IF NOT EXISTS `recarga` (
  `idrecarga` int(11) NOT NULL AUTO_INCREMENT,
  `monto` decimal(10,2) DEFAULT NULL,
  `empresa_id` int(11) NOT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`idrecarga`),
  UNIQUE KEY `empresa_id_UNIQUE` (`empresa_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `recarga`
--

INSERT INTO `recarga` (`idrecarga`, `monto`, `empresa_id`, `categoria_id`) VALUES
(1, '3.00', 2, 1);

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
(1, 'Administrador');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `subcategoria`
--

INSERT INTO `subcategoria` (`id`, `nombre`, `categoria_id`) VALUES
(1, 'lapices', 2),
(2, 'lapicero', 2),
(3, 'cuaderno', 2);

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `sucursal`
--

INSERT INTO `sucursal` (`id`, `numero`, `direccion`, `datos_empresa_id1`) VALUES
(2, 1, 'San Pedro', 1),
(3, 2, 'San Marcos', 1);

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
  `direccion` varchar(25) NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `pnom`, `snom`, `pape`, `sape`, `nacimiento`, `nombre_usuario`, `telefono`, `direccion`, `dpi`, `password`, `correo`, `foto_perfil`, `estado`, `roles_id`, `horarios_id`, `sucursal_id`) VALUES
(4, 'Gerardo', 'Natán', 'Dominguez', 'Miranda', '1994-11-14', 'gdominguez', '47266906', '3a. calle 2-97 Zona 3', '2662354251201', '123', 'gdominguezm@miumg.edu.gt', NULL, 'ACTIVO', 1, 5, 2),
(5, 'Gerardo', 'Emanuel', 'Davila', 'Morales', '2020-10-05', 'gdavila', '42444548', 'san marcos', '2662354251205', '1234', 'gdavila@gmail.com', NULL, 'ACTIVO', 1, 5, 2);

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
  ADD CONSTRAINT `fk_producto_subcategoria1` FOREIGN KEY (`subcategoria_id`) REFERENCES `subcategoria` (`id`);

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
