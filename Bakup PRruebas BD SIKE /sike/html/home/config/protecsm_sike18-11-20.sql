-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 19-11-2020 a las 04:27:32
-- Versión del servidor: 10.3.25-MariaDB
-- Versión de PHP: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `protecsm_sike`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`protecsm`@`localhost` PROCEDURE `add_detallecomprarecarga_temp` (IN `idrecarga` INT, IN `cantidad` INT, IN `precio` DECIMAL(10,2), IN `token_user` INT, IN `descripcion` VARCHAR(20))  BEGIN
    Insert Into detallerecarga_temp(token_user,cantidad,precio_compra,tipo,recarga_idrecarga)
    VALUES (token_user, cantidad,precio,descripcion,idrecarga);


    SELECT tmp.iddetallerecarga_temp,empresa.nombre,tmp.tipo,
    tmp.cantidad,tmp.precio_compra
    FROM detallerecarga_temp tmp
    INNER JOIN recarga on tmp.recarga_idrecarga = recarga.idrecarga
    INNER JOIN empresa on empresa.id = recarga.empresa_id
    where tmp.token_user = token_user;
    END$$

CREATE DEFINER=`protecsm`@`localhost` PROCEDURE `add_detallecompra_temp` (IN `idprod` INT, IN `cantidad` INT, IN `precio` DECIMAL(10,2), IN `token_user` INT)  BEGIN
    Insert Into detalle_compra_temp(token_user,cantidad,precio_compra,producto_idproducto)
    VALUES (token_user, cantidad,precio,idprod);


    SELECT tmp.iddetalle_compra_temp,producto.nombre, producto.descripcion,
    producto.presentacion,producto.marca,tmp.cantidad,tmp.precio_compra
    FROM detalle_compra_temp tmp
    INNER JOIN producto on tmp.producto_idproducto = producto.id
    where tmp.token_user = token_user;
    END$$

CREATE DEFINER=`protecsm`@`localhost` PROCEDURE `add_detalleventa_temp` (`idprod` INT, `cant` INT, `token_user` INT, `sucur` INT, `precio` DECIMAL(10,2))  BEGIN
		DECLARE precio_actual decimal (10,2);

        INSERT INTO detalleventa_tmp(token_user,cantidad,precio_venta,producto_idproducto)
        VALUES (token_user,cant, precio,idprod);

        SELECT tmp.iddetalleventa_tmp, tmp.producto_idproducto,producto.sku,
        producto.nombre,producto.descripcion,producto.presentacion,
        producto.marca,tmp.cantidad,tmp.precio_venta from
        detalleventa_tmp tmp inner join producto  on tmp.producto_idproducto = producto.id
        WHERE tmp.token_user = token_user;

    END$$

CREATE DEFINER=`protecsm`@`localhost` PROCEDURE `compra_recarga` (`fact` VARCHAR(20), `token` INT, `sucursal` INT)  BEGIN
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
		
        DROP TABLE tbl_tmp_tokenuser;
        CREATE TEMPORARY TABLE tbl_tmp_tokenuser(
        id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        idrec BIGINT,
        cantprod int,
        precioahora DECIMAL(10,2));

        SET registros = (SELECT COUNT(*) FROM detallerecarga_temp WHERE token_user = token);
		IF registros > 0 THEN
			INSERT INTO tbl_tmp_tokenuser (idrec,cantprod,precioahora) SELECT recarga_idrecarga,cantidad,precio_compra FROM detallerecarga_temp WHERE token_user = token;
            INSERT INTO comprarecarga (usuarios_idusuarios,factura,sucursal_idsucursal) VALUES (token,fact,sucursal);
            SET compras = LAST_INSERT_ID();
            INSERT INTO detallecomprarecarga(comprarecarga_id,recarga_idrecarga,cantidad,precio_compra,tipo ) SELECT (compras) as idcompra,recarga_idrecarga,cantidad,precio_compra,tipo
            FROM 	detallerecarga_temp
            WHERE token_user = token;
            WHILE a <= registros DO
            SELECT idrec,cantprod,precioahora INTO tmp_id_producto,tmp_cant_producto,tmp_precio_producto FROM tbl_tmp_tokenuser WHERE id = a;
            SELECT saldo INTO existencia_actual FROM saldo WHERE saldo.recarga_id = tmp_id_producto AND sucursal_id = sucursal;

            SET nueva_existencia = existencia_actual + tmp_cant_producto;
            UPDATE saldo SET saldo = nueva_existencia WHERE saldo.recarga_id = tmp_id_producto and saldo.sucursal_id = sucursal;

            SET a=a+1;

            END WHILE;
            SET total = (SELECT SUM(cantidad * precio_compra) FROM detalle_compra_temp WHERE token_user = token);
            UPDATE encabezado_compra SET encabezado_compra.totalcompra = total WHERE encabezado_compra.id = compras;
            DELETE FROM  detallerecarga_temp WHERE token_user = token;
            TRUNCATE TABLE tbl_tmp_tokenuser;
            SELECT * FROM comprarecarga WHERE comprarecarga.id = compras;
        ELSE
			SELECT 0;
            END IF;
    END$$

CREATE DEFINER=`protecsm`@`localhost` PROCEDURE `del_detallecomprarecarga_temp` (`id_detalle` INT, `token` INT)  BEGIN
DELETE FROM detallerecarga_temp WHERE iddetallerecarga_temp = id_detalle;

  SELECT tmp.iddetallerecarga_temp,empresa.nombre,tmp.tipo,
    tmp.cantidad,tmp.precio_compra
    FROM detallerecarga_temp tmp
    INNER JOIN recarga on tmp.recarga_idrecarga = recarga.idrecarga
    INNER JOIN empresa on empresa.id = recarga.empresa_id
    where tmp.token_user = token_user;
END$$

CREATE DEFINER=`protecsm`@`localhost` PROCEDURE `del_detalleventa_temp` (`id_detalle` INT, `token` INT)  BEGIN
		DELETE FROM detalleventa_tmp WHERE iddetalleventa_tmp = id_detalle;
        SELECT tmp.iddetalleventa_tmp, tmp.producto_idproducto,producto.sku,
        producto.nombre,producto.descripcion,producto.descripcion,producto.presentacion,
        producto.marca,tmp.cantidad,tmp.precio_venta from
        detalleventa_tmp tmp inner join producto  on tmp.producto_idproducto = producto.id
        WHERE tmp.token_user = token_user;
	END$$

CREATE DEFINER=`protecsm`@`localhost` PROCEDURE `del_detalle_temp` (`id_detalle` INT, `token` INT)  BEGIN
DELETE FROM detalle_compra_temp WHERE iddetalle_compra_temp = id_detalle;

  SELECT tmp.iddetalle_compra_temp,producto.nombre, producto.descripcion,
    producto.presentacion,producto.marca,tmp.cantidad,tmp.precio_compra
    FROM detalle_compra_temp tmp
    INNER JOIN producto on tmp.producto_idproducto = producto.id
    where tmp.token_user = token_user;
END$$

CREATE DEFINER=`protecsm`@`localhost` PROCEDURE `procesar_compra` (IN `proveedor` INT, IN `fact` VARCHAR(20), IN `token` INT, IN `sucursal` INT)  BEGIN
		DECLARE compras INT;

        DECLARE registros INT;
        DECLARE total DECIMAL(10,2);
        DECLARE precio DECIMAL(10,2);

        DECLARE nueva_existencia int;
        DECLARE existencia_actual int;

        DECLARE nuevo_precio DECIMAL(10,2);
        DECLARE subtotal DECIMAL (10,2);
        DECLARE precio_actual DECIMAL(10,2);
        DECLARE detalles VARCHAR(50);

        DECLARE tmp_id_producto int;
        DECLARE tmp_cant_producto int;
        DECLARE tmp_precio_producto DECIMAL(10,2);
        DECLARE a INT;
        SET a = 1;
		

        CREATE TEMPORARY  TABLE IF NOT EXISTS tbl_tmp_tokenuser(
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
            SET subtotal = (tmp_cant_producto * tmp_precio_producto);
            UPDATE precios SET existencia = nueva_existencia, precio_costo = nuevo_precio WHERE precios.producto_idproducto = tmp_id_producto and precios.sucursal_idsucursal = sucursal;
			SELECT concat(nombre,' ',descripcion,' ',presentacion,' ',marca) as detalle FROM producto WHERE producto.id = tmp_id_producto INTO detalles;
            INSERT INTO kardex (factura,detalle,movimiento,cantcompra,preciocompra,totalcompra,existencia,sucursal_idsucursal)
            VALUES (fact,detalles,'INGRESO',tmp_cant_producto,tmp_precio_producto,subtotal,nueva_existencia,sucursal);
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

CREATE DEFINER=`protecsm`@`localhost` PROCEDURE `venta` (IN `cod_cliente` INT, IN `token` INT, IN `fact` VARCHAR(15), IN `sucurs` INT)  BEGIN
			DECLARE factura INT;

            DECLARE registros INT;
            DECLARE total decimal(10,2);
            DECLARE precio DECIMAL(10,2);

            DECLARE nueva_existencia int;
            DECLARE subtotal DECIMAL (10,2);
            DECLARE detalles VARCHAR(50);
            DECLARE existencia_actual int;

            DECLARE tmp_cod_producto int;
            DECLARE tmp_cant_producto int;
            DECLARE tmp_precio_producto DECIMAL(10,2);
            DECLARE a int;
            SET a = 1;

			CREATE TEMPORARY TABLE IF NOT EXISTS tbl_tmp_token (
            id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
            cod_prod BIGINT,
            precio_prod DECIMAL(10,2),
            cant_prod INT);

            SET registros = (SELECT COUNT(*) FROM detalleventa_tmp WHERE token_user = token );

            IF registros > 0 THEN
				INSERT INTO tbl_tmp_token (cod_prod, cant_prod,precio_prod) SELECT producto_idproducto, cantidad,precio_venta
                FROM detalleventa_tmp WHERE token_user = token;

                INSERT INTO encabezado_venta (numfactura,clientes_id,usuarios_idusuarios,sucursal_idsucursal)
                VALUES (fact,cod_cliente,token,sucurs);
                SET factura = LAST_INSERT_ID();

                INSERT INTO detalleventa (encabezado_venta_id,producto_idproducto,cantidad,precio) SELECT (factura) as encabezado_venta_idencabezado, producto_idproducto,cantidad,precio_venta
                FROM detalleventa_tmp WHERE token_user= token;

                WHILE a <= registros DO
					SELECT cod_prod, cant_prod,precio_prod INTO tmp_cod_producto,tmp_cant_producto,tmp_precio_producto
                    FROM tbl_tmp_token WHERE id = a;
                    SELECT existencia INTO existencia_actual FROM precios WHERE producto_idproducto = tmp_cod_producto AND sucursal_idsucursal = sucurs;

                    SET nueva_existencia = existencia_actual - tmp_cant_producto;
                    SET subtotal = (tmp_cant_producto * tmp_precio_producto);
                    UPDATE precios SET existencia = nueva_existencia WHERE producto_idproducto = tmp_cod_producto AND sucursal_idsucursal = sucurs ;
					SELECT concat(nombre,' ',descripcion,' ',presentacion,' ',marca) as detall FROM producto WHERE producto.id = tmp_cod_producto INTO detalles;
                    INSERT INTO kardex (factura,detalle,movimiento,cantventa,precioventa,totalventa,existencia,sucursal_idsucursal)
					VALUES (fact,detalles,'EGRESO',tmp_cant_producto,tmp_precio_producto,subtotal,nueva_existencia,sucurs);
                
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

CREATE TABLE `acciones` (
  `id` int(11) NOT NULL,
  `tipo_accion` varchar(45) NOT NULL,
  `usuarios_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asesor`
--

CREATE TABLE `asesor` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `correo` varchar(35) DEFAULT NULL,
  `estado` varchar(8) NOT NULL,
  `empresa_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `asesor`
--

INSERT INTO `asesor` (`id`, `nombre`, `telefono`, `correo`, `estado`, `empresa_id`) VALUES
(1, 'gerardo', '641654', 'ge@gmail.com', '1', 1),
(2, 'Eddy MarroquÃ­n', '45172626', 'eddye@gmail.com', '1', 4),
(3, 'Luis Fuentes Navarro', '77608585', 'luis@gmail.com', '1', 5),
(4, 'Camden Wesley Hurst Ma', '64497116', 'CHurst@gmail.com', '1', 6),
(5, 'Mohammad Cameran Watts', '97952362', 'MWatts@gmail.com', '1', 7),
(6, 'Vincent Cedric Blair A', '80759156', 'VBlair@gmail.com', '1', 8),
(7, 'Rashad Alika Sargent R', '76470034', 'RSargent@gmail.com', '1', 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `apellido` varchar(20) NOT NULL,
  `nit` varchar(15) DEFAULT NULL,
  `telefono` varchar(12) DEFAULT NULL,
  `direccion` varchar(60) DEFAULT NULL,
  `correo` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `apellido`, `nit`, `telefono`, `direccion`, `correo`) VALUES
(1, 'gerard', 'dominguez', '12459', '31232', 'asdf', '1231'),
(2, 'Pedro', 'Pedrito', '123456789', '52158645', 'San Marcos', 'pedro@gmail.com'),
(3, 'Hamilton Veda', 'Molina Solis', '9163607182049', '42076095', 'Ciudad', 'HMolina@gmail.com'),
(4, 'Oren Jasper', 'Ashley Franklin', '6161411290750', '42411825', 'San Marcos', 'OAshley@gmail.com'),
(5, 'Salome', 'Bernave', '123456785', '52158644', 'San Marcos, San Marcos', 'salome45@gmail.com'),
(6, 'g', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` double NOT NULL,
  `producto_id` int(11) NOT NULL,
  `encabezado_compra_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comprarecarga`
--

CREATE TABLE `comprarecarga` (
  `id` int(11) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `status` varchar(10) NOT NULL DEFAULT 'ACTIVO',
  `totalcompra` decimal(10,2) DEFAULT NULL,
  `factura` varchar(15) DEFAULT NULL,
  `usuarios_idusuarios` int(11) DEFAULT NULL,
  `sucursal_idsucursal` int(11) DEFAULT NULL,
  `empresa` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `comprarecarga`
--

INSERT INTO `comprarecarga` (`id`, `fecha`, `status`, `totalcompra`, `factura`, `usuarios_idusuarios`, `sucursal_idsucursal`, `empresa`) VALUES
(3, '2020-11-11 23:17:20', 'ACTIVO', NULL, '512', 1, 2, NULL),
(4, '2020-11-11 23:18:13', 'ACTIVO', NULL, '1235', 1, 2, NULL),
(5, '2020-11-11 18:47:59', 'ACTIVO', 500.00, '', 5, 2, '2'),
(6, '2020-11-11 19:35:19', 'ACTIVO', 500.00, '52', 5, 2, '2'),
(7, '2020-11-11 19:38:27', 'ACTIVO', 100.00, 'C1', 5, 2, '2'),
(8, '2020-11-11 20:34:37', 'ACTIVO', 475.00, '100', 5, 2, '2'),
(9, '2020-11-11 20:38:28', 'ACTIVO', 50.00, '522', 5, 2, '3'),
(10, '2020-11-11 20:38:30', 'ACTIVO', 50.00, '522', 5, 2, '3'),
(11, '2020-11-11 20:38:45', 'ACTIVO', 50.00, '522', 5, 2, '3'),
(12, '2020-11-11 20:40:18', 'ACTIVO', 50.00, '522', 5, 2, '2'),
(13, '2020-11-18 06:10:22', 'ACTIVO', 100.00, '00101', 4, 3, '2'),
(14, '2020-11-18 06:42:36', 'ACTIVO', 3.00, '108', 6, 2, '3'),
(15, '2020-11-18 07:00:19', 'ACTIVO', 100.00, '1531', 0, 2, '2'),
(16, '2020-11-18 07:00:45', 'ACTIVO', 1000.00, '2135', 0, 3, '2'),
(17, '2020-11-18 07:01:05', 'ACTIVO', 1000.00, '123A', 0, 2, '2'),
(18, '2020-11-18 07:01:20', 'ACTIVO', 10000.00, 'S6D5', 0, 3, '3'),
(19, '2020-11-18 07:01:48', 'ACTIVO', 1000.00, '175', 0, 2, '2'),
(20, '2020-11-18 07:02:45', 'ACTIVO', 1000.00, 'AS', 0, 2, '2'),
(21, '2020-11-18 07:03:09', 'ACTIVO', 1250.00, 'AS', 0, 2, '3'),
(22, '2020-11-18 07:03:18', 'ACTIVO', 2.00, '20', 6, 2, '2'),
(23, '2020-11-18 07:03:53', 'ACTIVO', 150.00, 'HGJ', 0, 2, '2'),
(24, '2020-11-18 07:04:15', 'ACTIVO', 115.00, '45646', 0, 2, '3'),
(25, '2020-11-18 07:04:40', 'ACTIVO', 175.25, 'ads', 4, 2, '2'),
(26, '2020-11-18 07:04:59', 'ACTIVO', 258.00, 'as', 4, 2, '3'),
(27, '2020-11-18 07:05:01', 'ACTIVO', 116.00, '55', 0, 2, '3'),
(28, '2020-11-18 07:05:39', 'ACTIVO', 7.00, '113', 6, 2, '3'),
(29, '2020-11-18 07:07:08', 'ACTIVO', 60.00, '250', 5, 2, '2'),
(30, '2020-11-18 07:11:31', 'ACTIVO', 15000.00, 'asd', 4, 2, '2'),
(31, '2020-11-18 07:12:16', 'ACTIVO', 15000.00, 'qwe', 4, 2, '2'),
(32, '2020-11-18 07:12:39', 'ACTIVO', 15000.00, 'q', 4, 2, '3'),
(33, '2020-11-19 03:45:31', 'ACTIVO', 520.00, '456888989', 5, 2, '2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_empresa`
--

CREATE TABLE `datos_empresa` (
  `id` int(11) NOT NULL,
  `nombre` varchar(65) DEFAULT NULL,
  `direccion` varchar(75) DEFAULT NULL,
  `representante` varchar(45) DEFAULT NULL,
  `telefono` int(11) DEFAULT NULL,
  `nit` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `datos_empresa`
--

INSERT INTO `datos_empresa` (`id`, `nombre`, `direccion`, `representante`, `telefono`, `nit`) VALUES
(1, 'SIKE', 'SAN MARCOS', 'Juan', 77608248, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallecompra`
--

CREATE TABLE `detallecompra` (
  `iddetallecompra` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_compra` decimal(10,2) NOT NULL,
  `encabezado_compra_id` int(11) DEFAULT NULL,
  `producto_idproducto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `detallecompra`
--

INSERT INTO `detallecompra` (`iddetallecompra`, `cantidad`, `precio_compra`, `encabezado_compra_id`, `producto_idproducto`) VALUES
(1, 55, 45.50, 3, 1),
(2, 700, 480.00, 3, 3),
(3, 500, 250.00, 3, 2),
(4, 55, 45.50, 6, 1),
(5, 700, 480.00, 6, 3),
(6, 500, 250.00, 6, 2),
(7, 1, 0.02, 7, 1),
(8, 1, 0.03, 8, 1),
(9, 1, 0.04, 9, 1),
(10, 1, 0.02, 10, 1),
(11, 1, 0.02, 11, 1),
(12, 1, 0.01, 12, 1),
(13, 1, 0.02, 13, 1),
(14, 1, 0.02, 14, 1),
(15, 1, 0.01, 15, 1),
(16, 1, 0.02, 16, 1),
(17, 1, 0.01, 17, 2),
(18, 1, 0.01, 17, 2),
(20, 1, 0.02, 18, 1),
(21, 1, 0.02, 19, 1),
(22, 1, 0.02, 20, 1),
(23, 1, 0.01, 21, 1),
(24, 1, 0.04, 22, 1),
(25, 10, 52.00, 23, 1),
(26, 1, 50.00, 24, 1),
(27, 1, 50.00, 24, 3),
(29, 12, 70.00, 25, 3),
(30, 12, 40.00, 25, 1),
(32, 8, 12.00, 26, 1),
(33, 80, 50.00, 27, 3),
(34, 52, 89.00, 28, 3),
(35, 5, 12.00, 29, 1),
(36, 10, 5.00, 30, 17),
(37, 10, 5.00, 31, 16),
(38, 10, 10.00, 32, 1),
(39, 11, 12.00, 33, 16),
(40, 10, 5.00, 34, 1),
(41, 15, 5.00, 35, 16),
(42, 1, 15.00, 36, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallerecarga_temp`
--

CREATE TABLE `detallerecarga_temp` (
  `iddetallerecarga_temp` int(11) NOT NULL,
  `token_user` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `precio_compra` decimal(10,2) DEFAULT NULL,
  `tipo` varchar(20) DEFAULT NULL,
  `recarga_idrecarga` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleventa`
--

CREATE TABLE `detalleventa` (
  `iddetalleventa` int(11) NOT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `encabezado_venta_id` int(11) DEFAULT NULL,
  `producto_idproducto` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `detalleventa`
--

INSERT INTO `detalleventa` (`iddetalleventa`, `cantidad`, `precio`, `encabezado_venta_id`, `producto_idproducto`) VALUES
(1, 75, 75.00, 1, 1),
(2, 150, 250.00, 1, 2),
(3, 150, 25.25, 1, 3),
(4, 350, 15.75, 2, 3),
(5, 150, 15.50, 2, 2),
(6, 25, 25.25, 2, 1),
(7, 2, 100.00, 3, 3),
(8, 1, 150.00, 3, 1),
(9, 2, 100.00, 4, 3),
(10, 1, 150.00, 4, 1),
(11, 1, 150.00, 5, 1),
(12, 1, 150.00, 6, 1),
(13, 50, 50.00, 7, 3),
(14, 50, 120.00, 8, 3),
(15, 1, 150.00, 9, 1),
(16, 5, 100.00, 10, 3),
(17, 4, 100.00, 11, 3),
(18, 3, 100.00, 12, 3),
(19, 2, 100.00, 13, 3),
(20, 5, 100.00, 13, 3),
(21, 3, 120.00, 14, 3),
(22, 5, 50.00, 14, 3),
(23, 5, 150.00, 15, 1),
(24, 10, 100.00, 15, 3),
(25, 8, 150.00, 16, 1),
(26, 5, 150.00, 17, 1),
(27, 100, 20.00, 18, 16),
(28, 20, 10.00, 18, 17),
(29, 9, 20.00, 19, 16),
(30, 62, 50.00, 20, 3),
(31, 11, 18.00, 20, 16),
(32, 18, 90.00, 20, 1),
(33, 5, 150.00, 21, 1),
(34, 5, 100.00, 22, 3),
(35, 5, 150.00, 22, 1),
(36, 1, 150.00, 23, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleventa_tmp`
--

CREATE TABLE `detalleventa_tmp` (
  `iddetalleventa_tmp` int(11) NOT NULL,
  `token_user` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_venta` decimal(10,2) DEFAULT NULL,
  `producto_idproducto` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_compra_temp`
--

CREATE TABLE `detalle_compra_temp` (
  `iddetalle_compra_temp` int(11) NOT NULL,
  `token_user` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `precio_compra` decimal(10,2) DEFAULT NULL,
  `producto_idproducto` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `egresos`
--

CREATE TABLE `egresos` (
  `id` int(11) NOT NULL,
  `monto` double NOT NULL,
  `fecha` date NOT NULL,
  `descripcion` text NOT NULL,
  `usuarios_id` int(11) NOT NULL,
  `compra_id` int(11) DEFAULT NULL,
  `sucursal_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `egresos`
--

INSERT INTO `egresos` (`id`, `monto`, `fecha`, `descripcion`, `usuarios_id`, `compra_id`, `sucursal_id`) VALUES
(1, 25.5, '2020-11-15', 'Productos de limpieza', 6, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `nit` varchar(15) NOT NULL,
  `direccion` varchar(150) DEFAULT NULL,
  `telefono` varchar(12) DEFAULT NULL,
  `descripcion` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`id`, `nombre`, `nit`, `direccion`, `telefono`, `descripcion`) VALUES
(1, 'sike', '56465412', '5ta calle zona 1 San Marcos', '4684568', 'Proveedor de Ãºtiles escolares'),
(2, 'Claro', '13245', 'san marcos', '55667788', 'para la compra de saldo '),
(3, 'Tigo', '54321', 'san marcos', '48494546', 'para la compra de saldo'),
(4, 'SmartSoluciones', '83558765', 'Comitancillo, San Marcos', '31784579', 'Proveedor de cable de red'),
(5, 'IMPEX guatemala', '87454545', 'Guatemala Zona 14', '77605559', 'Proveedor de Papel Bond Marcas Comex, chamex'),
(6, 'LibrerÃ­a y PapelerÃ­a Progreso, S.A.', '32165611', 'Guatemala', '24409090', 'LibrerÃ­a'),
(7, 'LibrerÃ­a e Imprenta Vivian, S.A.', '48514981', 'Guatemala', '24902425', 'LibrerÃ­a'),
(8, 'Grupo ColibrÃ­, S.A.', '83233156', 'Guatemala', '24602526', 'LibrerÃ­a'),
(9, 'LibrerÃ­a Victoria', '96365248', 'San Marcos, Guatemala', '77609532', 'LibrerÃ­a');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encabezado_compra`
--

CREATE TABLE `encabezado_compra` (
  `id` int(11) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `status` varchar(10) NOT NULL DEFAULT 'ACTIVO',
  `totalcompra` decimal(10,2) DEFAULT NULL,
  `factura` varchar(12) DEFAULT NULL,
  `proveedor_idproveedor` varchar(15) NOT NULL,
  `usuarios_idusuarios` int(11) DEFAULT NULL,
  `sucursal_idsucursal` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `encabezado_compra`
--

INSERT INTO `encabezado_compra` (`id`, `fecha`, `status`, `totalcompra`, `factura`, `proveedor_idproveedor`, `usuarios_idusuarios`, `sucursal_idsucursal`) VALUES
(7, '2020-11-03 06:10:38', '', 0.02, '0', '2', 4, 2),
(8, '2020-11-03 06:15:30', 'ACTIVO', 0.03, '0', '2', 4, 2),
(9, '2020-11-03 06:17:12', 'ACTIVO', 0.04, '0', '2', 4, 2),
(10, '2020-11-03 06:29:31', 'ACTIVO', 0.02, '2', '2', 4, 1),
(11, '2020-11-03 00:44:27', 'ACTIVO', 0.02, '0', '2', 4, 2),
(12, '2020-11-03 00:45:58', 'ACTIVO', 0.01, '0', '2', 4, 2),
(13, '2020-11-03 00:46:52', 'ACTIVO', 0.02, '0', '2', 4, 2),
(14, '2020-11-03 00:48:41', 'ACTIVO', 0.02, '0', '2', 4, 2),
(15, '2020-11-03 00:49:47', 'ACTIVO', 0.01, '0', '2', 4, 2),
(16, '2020-11-03 00:51:10', 'ACTIVO', 0.02, '5', '2', 4, 2),
(17, '2020-11-03 00:53:57', 'ACTIVO', 0.02, '0', '2', 4, 2),
(18, '2020-11-03 00:54:39', 'ACTIVO', 0.02, '0', '2', 4, 2),
(19, '2020-11-04 19:42:22', 'ACTIVO', 0.02, '0', '2', 4, 2),
(20, '2020-11-04 19:44:36', 'ACTIVO', 0.02, '0', '2', 4, 2),
(21, '2020-11-04 19:46:32', 'ACTIVO', 0.01, '0', '2', 4, 2),
(22, '2020-11-04 19:50:26', 'ACTIVO', 0.04, '0', '1', 4, 2),
(23, '2020-11-05 00:00:31', 'ACTIVO', 520.00, '52', '1', 4, 2),
(24, '2020-11-17 03:31:34', 'ACTIVO', 100.00, '489', '4', 4, 2),
(25, '2020-11-17 03:44:54', 'ACTIVO', 1320.00, '579', '4', 4, 2),
(26, '2020-11-17 03:45:49', 'ACTIVO', 96.00, '41564', '4', 4, 2),
(27, '2020-11-17 03:47:27', 'ACTIVO', 4000.00, '586', '4', 4, 2),
(28, '2020-11-17 03:48:53', 'ACTIVO', 4628.00, '58', '4', 4, 3),
(29, '2020-11-17 03:55:44', 'ACTIVO', 60.00, '4556', '4', 4, 2),
(30, '2020-11-18 05:29:46', 'ACTIVO', 50.00, '201', '6', 5, 2),
(31, '2020-11-18 05:30:25', 'ACTIVO', 50.00, '202', '6', 5, 2),
(32, '2020-11-18 05:31:04', 'ACTIVO', 100.00, '203', '4', 5, 2),
(33, '2020-11-18 05:55:36', 'ACTIVO', 132.00, '300', '6', 5, 2),
(34, '2020-11-18 06:18:20', 'ACTIVO', 50.00, '4568', '4', 5, 2),
(35, '2020-11-18 06:19:49', 'ACTIVO', 75.00, '78468', '4', 5, 2),
(36, '2020-11-18 08:48:12', 'ACTIVO', 15.00, '456889', '4', 5, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encabezado_venta`
--

CREATE TABLE `encabezado_venta` (
  `id` int(11) NOT NULL,
  `numfactura` varchar(25) DEFAULT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `totalfactura` decimal(10,2) DEFAULT NULL,
  `clientes_id` int(11) DEFAULT NULL,
  `estatus` varchar(45) NOT NULL DEFAULT 'ACTIVO',
  `sucursal_idsucursal` int(11) DEFAULT NULL,
  `usuarios_idusuarios` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `encabezado_venta`
--

INSERT INTO `encabezado_venta` (`id`, `numfactura`, `fecha`, `totalfactura`, `clientes_id`, `estatus`, `sucursal_idsucursal`, `usuarios_idusuarios`) VALUES
(1, '123', '2020-11-02 21:51:58', 46912.50, 1, 'ACTIVO', 1, 1),
(2, '154', '2020-11-02 21:57:24', 8468.75, 1, 'ACTIVO', 1, 1),
(3, '0', '2020-11-06 09:57:30', 350.00, 1, 'ACTIVO', 3, 6),
(4, '0', '2020-11-06 09:58:27', 350.00, 1, 'ACTIVO', 3, 6),
(5, '0', '2020-11-06 10:00:47', 150.00, 1, 'ACTIVO', 3, 6),
(6, '0', '2020-11-06 10:01:39', 150.00, 1, 'ACTIVO', 3, 6),
(7, '0', '2020-11-06 10:04:58', 2500.00, 1, 'ACTIVO', 3, 6),
(8, '0', '2020-11-06 10:07:33', 6000.00, 1, 'ACTIVO', 3, 6),
(9, '0', '2020-11-06 10:13:30', 150.00, 1, 'ACTIVO', 3, 6),
(10, '0', '2020-11-06 10:26:44', 500.00, 1, 'ACTIVO', 3, 6),
(11, '0', '2020-11-06 10:27:13', 400.00, 1, 'ACTIVO', 3, 6),
(12, '0', '2020-11-06 10:30:10', 300.00, 1, 'ACTIVO', 3, 6),
(13, '0', '2020-11-06 10:36:30', 700.00, 1, 'ACTIVO', 3, 6),
(14, '0', '2020-11-06 14:56:58', 610.00, 1, 'ACTIVO', 3, 6),
(15, '0', '2020-11-17 05:31:13', 1750.00, 1, 'ACTIVO', 2, 5),
(16, '0', '2020-11-17 05:41:17', 1200.00, 1, 'ACTIVO', 2, 5),
(17, '0', '2020-11-18 05:37:26', 750.00, 1, 'ACTIVO', 2, 5),
(18, '0', '2020-11-18 05:46:19', 2200.00, 1, 'ACTIVO', 2, 5),
(19, '0', '2020-11-18 05:54:11', 180.00, 1, 'ACTIVO', 2, 5),
(20, '0', '2020-11-18 05:59:59', 4918.00, 1, 'ACTIVO', 2, 5),
(21, '0', '2020-11-18 06:21:03', 750.00, 1, 'ACTIVO', 2, 5),
(22, '0', '2020-11-18 06:22:09', 1250.00, 1, 'ACTIVO', 2, 5),
(23, '0', '2020-11-18 08:51:56', 150.00, 1, 'ACTIVO', 2, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_prod`
--

CREATE TABLE `estado_prod` (
  `id` int(11) NOT NULL,
  `estado` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

CREATE TABLE `horarios` (
  `id` int(11) NOT NULL,
  `tipo` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

CREATE TABLE `ingresos` (
  `id` int(11) NOT NULL,
  `monto` double NOT NULL,
  `descripcion` text NOT NULL,
  `venta_id` int(11) DEFAULT NULL,
  `venta_recarga_id` int(11) DEFAULT NULL,
  `usuarios_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kardex`
--

CREATE TABLE `kardex` (
  `idkardex` int(11) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `factura` varchar(25) DEFAULT NULL,
  `detalle` varchar(100) DEFAULT NULL,
  `movimiento` varchar(15) DEFAULT NULL,
  `cantcompra` int(11) DEFAULT NULL,
  `preciocompra` decimal(10,2) DEFAULT NULL,
  `totalcompra` decimal(10,2) DEFAULT NULL,
  `cantventa` int(11) DEFAULT NULL,
  `precioventa` decimal(10,2) DEFAULT NULL,
  `totalventa` decimal(10,2) DEFAULT NULL,
  `existencia` int(11) DEFAULT NULL,
  `sucursal_idsucursal` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `kardex`
--

INSERT INTO `kardex` (`idkardex`, `fecha`, `factura`, `detalle`, `movimiento`, `cantcompra`, `preciocompra`, `totalcompra`, `cantventa`, `precioventa`, `totalventa`, `existencia`, `sucursal_idsucursal`) VALUES
(1, '2020-11-18 08:48:12', '456889', 'lapiz2 hb caja faber castell', 'INGRESO', 1, 15.00, 15.00, NULL, NULL, NULL, 2, 2),
(2, '2020-11-18 08:51:56', '0', 'lapiz2 hb caja faber castell', 'EGRESO', NULL, NULL, NULL, 1, 150.00, 150.00, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `log`
--

CREATE TABLE `log` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `accion` varchar(25) NOT NULL,
  `acciones_id` int(11) NOT NULL,
  `usuarios_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `precios`
--

CREATE TABLE `precios` (
  `idprecios` int(11) NOT NULL,
  `existencia` int(11) NOT NULL,
  `precio_costo` decimal(10,2) NOT NULL,
  `precio_venta` decimal(10,2) NOT NULL,
  `precio_minimo` decimal(10,2) DEFAULT NULL,
  `precio_promocion` decimal(10,2) DEFAULT NULL,
  `estado` varchar(15) NOT NULL DEFAULT 'ACTIVO',
  `producto_idproducto` int(11) NOT NULL,
  `sucursal_idsucursal` int(11) NOT NULL,
  `usuario_idusuarios` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `precios`
--

INSERT INTO `precios` (`idprecios`, `existencia`, `precio_costo`, `precio_venta`, `precio_minimo`, `precio_promocion`, `estado`, `producto_idproducto`, `sucursal_idsucursal`, `usuario_idusuarios`) VALUES
(1, 1, 15.00, 150.00, 90.00, 60.00, 'ACTIVO', 1, 2, 1),
(2, 300, 250.00, 42.00, NULL, NULL, 'ACTIVO', 2, 1, 1),
(3, 350, 480.00, 87.00, NULL, NULL, 'ACTIVO', 3, 1, 1),
(4, 395, 50.00, 100.00, 120.00, 50.00, 'ACTIVO', 3, 2, 1),
(5, 50, 4.00, 5.00, 5.25, 5.50, 'ACTIVO', 1, 3, 6),
(6, 100, 4.00, 7.00, 5.00, 6.00, 'ACTIVO', 6, 2, 5),
(7, 16, 5.00, 20.00, 15.00, 18.00, 'ACTIVO', 16, 2, 5),
(8, 0, 5.00, 10.00, 7.00, 6.00, 'ACTIVO', 17, 2, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `privilegios`
--

CREATE TABLE `privilegios` (
  `id` int(11) NOT NULL,
  `privilegios` varchar(20) NOT NULL,
  `roles_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id` int(11) NOT NULL,
  `sku` varchar(25) DEFAULT NULL,
  `imagen` blob DEFAULT NULL,
  `nombre` varchar(35) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `presentacion` varchar(50) NOT NULL,
  `marca` varchar(50) NOT NULL,
  `estado_prod_id` int(11) NOT NULL,
  `subcategoria_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `sku`, `imagen`, `nombre`, `descripcion`, `presentacion`, `marca`, `estado_prod_id`, `subcategoria_id`) VALUES
(1, '001', NULL, 'lapiz2', 'hb', 'caja', 'faber castell', 1, 1),
(2, '002', NULL, 'lapiz', 'h2', 'caja', 'faber castell', 1, 1),
(3, '003', NULL, 'lapicero', 'rojo', 'caja', 'faber castell', 2, 1),
(5, NULL, NULL, 'lapizC', 'Lapizc', 'Caja', 'Mongol', 2, 1),
(6, NULL, NULL, 'cuaderno rayado de 100 hojas cocido', 'cuaderno rayado de 100 ho', 'Caja', 'Scribe', 2, 1),
(7, NULL, NULL, 'Marcadores', 'Marcador permanente', 'Caja', 'Karic', 2, 2),
(9, NULL, NULL, 'Cuaderno cuadriculado de sticker de', 'Cuaderno cuadriculado de sticker de 50 hojas grand', 'Caja', 'Norma', 2, 3),
(10, NULL, NULL, 'Cuaderno cuadriculado de 50 hojas e', 'Cuaderno cuadriculado de 50 hojas economico ', 'Caja', 'Norma', 2, 3),
(11, NULL, NULL, 'Cuaderno rayado economico de 50 hoj', 'Cuaderno rayado economico de 50 hojas ', 'Caja', 'Jeans', 2, 3),
(12, NULL, NULL, 'Cuaderno rayado  LUKIS grande, past', 'Cuaderno rayado  LUKIS grande, pasta dura', 'Caja', 'LUKIS', 2, 3),
(13, NULL, NULL, 'Cuaderno cuadriculado LUKIS grande,', 'Cuaderno cuadriculado LUKIS grande, pasta dura', 'Caja', 'LUKIS', 2, 3),
(14, NULL, NULL, 'Cuaderno rayado argollados grande e', 'Cuaderno rayado argollados grande economico 100 h', 'Caja', 'Norma', 2, 3),
(15, 'CAP100C', NULL, 'Cuaderno argollado pequeÃ±o de 100 ', 'Cuaderno argollado pequeÃ±o de 100 hojas cuadricul', 'Caja', 'Tucan', 2, 2),
(16, 'KPMR01', NULL, 'Kilometrico paper mate rojo', 'Kilometrico paper mate rojo', 'Caja', 'Paper Mate', 2, 2),
(17, 'KPMA01', NULL, 'Kilometrico paper mate azul', 'Kilometrico paper mate azul', 'Caja', 'Paper Mate', 2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recarga`
--

CREATE TABLE `recarga` (
  `idrecarga` int(11) NOT NULL,
  `empresa_id` int(11) NOT NULL,
  `categoria_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `recarga`
--

INSERT INTO `recarga` (`idrecarga`, `empresa_id`, `categoria_id`) VALUES
(1, 2, 1),
(2, 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `nombre` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `nombre`) VALUES
(1, 'Administrador'),
(2, 'Vendedor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `saldo`
--

CREATE TABLE `saldo` (
  `id` int(11) NOT NULL,
  `saldo` decimal(10,2) DEFAULT NULL,
  `recarga_id` int(11) NOT NULL,
  `sucursal_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `saldo`
--

INSERT INTO `saldo` (`id`, `saldo`, `recarga_id`, `sucursal_id`) VALUES
(5, 30370.00, 2, 2),
(6, 98.00, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcategoria`
--

CREATE TABLE `subcategoria` (
  `id` int(11) NOT NULL,
  `nombre` varchar(35) NOT NULL,
  `categoria_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

CREATE TABLE `sucursal` (
  `id` int(11) NOT NULL,
  `numero` int(11) NOT NULL,
  `direccion` varchar(45) DEFAULT NULL,
  `datos_empresa_id1` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

CREATE TABLE `tipo_plan` (
  `id` int(11) NOT NULL,
  `nombre_plan` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
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
  `foto_perfil` blob DEFAULT NULL,
  `estado` varchar(10) NOT NULL,
  `roles_id` int(11) NOT NULL,
  `horarios_id` int(11) DEFAULT NULL,
  `sucursal_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `pnom`, `snom`, `pape`, `sape`, `nacimiento`, `nombre_usuario`, `telefono`, `direccion`, `dpi`, `password`, `correo`, `foto_perfil`, `estado`, `roles_id`, `horarios_id`, `sucursal_id`) VALUES
(4, 'Gerardo', 'Natán', 'Dominguez', 'Miranda', '1994-11-14', 'gdominguez', '47266906', '3a. calle 2-97 Zona 3', '2662354251201', '123', 'gdominguezm@miumg.edu.gt', NULL, 'ACTIVO', 1, 5, 2),
(5, 'Gerardo', 'Emanuel', 'Davila', 'Morales', '2020-10-05', 'gdavila', '42444548', 'san marcos', '2662354251205', '1234', 'gdavila@gmail.com', NULL, 'ACTIVO', 1, 5, 2),
(6, 'eddy', 'estuardo', 'AgustÃ­n', 'Marroquin', '2020-09-01', 'eagustin', '42464345', 'comitan', '2662352512045', '1234', 'eagustinm@gmail.com', NULL, 'ACTIVO', 1, 5, 2),
(7, 'Griffith', 'Bo', 'Perez', 'Tillman', '2020-04-22', 'GPerez', '59048697', 'Yellowknife', '5167610174414', 'GPerez123', 'GPerez@gmail.com', NULL, 'ACTIVO', 1, 5, 3),
(10, 'Keefe', 'Kennan', 'Patterson', 'Beach', '1970-01-01', 'KPatterson', '85229566', 'Sfruz', '165512131383', 'KPatterson', 'KPatterson@gmail.com', NULL, 'ACTIVO', 2, 5, 3),
(12, 'Sebastian', 'Eliana', 'Lester', 'Melton', '1970-01-01', 'SLester', '89139622', 'Daman', '167810259734', 'SLester', 'SLester@gmail.com', NULL, 'ACTIVO', 2, 5, 3),
(13, 'Tad', 'Nicole', 'Roberson', 'Martin', '1970-01-01', 'TRoberson', '26345750', 'Castelbaldo', '166402040890', 'TRoberson', 'TRoberson@gmail.com', NULL, 'ACTIVO', 1, 5, 3),
(14, 'Melvin', 'Aubrey', 'Briggs', 'Nash', '2011-10-10', 'MBriggs', '40580672', 'Ramsey', '169903021195', 'MBriggs', 'MBriggs@gmail.com', NULL, 'ACTIVO', 1, 5, 3),
(15, 'Kelly', 'Allistair', 'Hammond', 'Rush', '2013-05-05', 'KHammond', '80377106', 'Sanquhar', '169408098730', 'KHammond', 'KHammond@gmail.com', NULL, 'ACTIVO', 1, 5, 3),
(16, 'Nathan', 'Geraldine', 'Navarro', 'Roy', '2019-09-10', 'NNavarro', '56909672', 'Beervelde', '169507176379', 'NNavarro', 'NNavarro@gmail.com', NULL, 'ACTIVO', 1, 5, 3),
(17, 'Amal', 'Isadora', 'Cash', 'Weeks', '1970-01-01', 'ACash', '99701905', 'CuracautÃ­n', '163604078984', 'ACash', 'ACash@gmail.com', NULL, 'ACTIVO', 1, 5, 3),
(18, 'Aquila', 'Libby', 'Mcfadden', 'Sellers', '2019-06-02', 'AMcfadden', '35526400', 'Granada', '166602089945', 'AMcfadden', 'AMcfadden@gmail.com', NULL, 'ACTIVO', 1, 5, 3),
(19, 'Martin', 'Ciaran', 'Mays', 'Bridges', '2019-01-08', 'MMays', '35686855', 'Rea', '160811271857', 'MMays', 'MMays@gmail.com', NULL, 'ACTIVO', 1, 5, 3),
(20, 'Byron', 'Libby', 'Pace', 'Neal', '2007-11-05', 'BPace', '33179162', 'Montresta', '161212265126', 'BPace', 'BPace@gmail.com', NULL, 'ACTIVO', 1, 5, 3),
(21, 'Simon', 'Alea', 'Nolan', 'Newman', '2004-02-04', 'SNolan', '29433172', 'Maasmechelen', '168002277310', 'SNolan', 'SNolan@gmail.com', NULL, 'ACTIVO', 1, 5, 3),
(22, 'Aquila', 'Daniel', 'Monroe', 'Cameron', '2018-05-11', 'AMonroe', '38390835', 'Quilleco', '168702164263', 'AMonroe', 'AMonroe@gmail.com', NULL, 'ACTIVO', 1, 5, 3),
(23, 'Bernard', 'Tanya', 'Townsend', 'Buck', '1970-01-01', 'BTownsend', '09398576', 'Sneek', '168110029918', 'BTownsend', 'BTownsend@gmail.com', NULL, 'ACTIVO', 1, 5, 3),
(24, 'Caleb', 'Channing', 'Roman', 'Key', '1970-01-01', 'CRoman', '18242835', 'Banjar', '163705273708', 'CRoman', 'CRoman@gmail.com', NULL, 'ACTIVO', 1, 5, 3),
(25, 'Galvin', 'Elvis', 'Parker', 'Welch', '2012-07-01', 'GParker', '57592435', 'Dokkum', '168411096012', 'GParker', 'GParker@gmail.com', NULL, 'ACTIVO', 1, 5, 3),
(26, 'Norman', 'Arsenio', 'Obrien', 'Leach', '1970-01-01', 'NObrien', '37104126', 'Novgorod', '164807224292', 'NObrien', 'NObrien@gmail.com', NULL, 'ACTIVO', 1, 5, 3),
(27, 'Branden', 'Mohammad', 'Reese', 'Freeman', '2010-08-03', 'BReese', '45187510', 'Heule', '169609070199', 'BReese', 'BReese@gmail.com', NULL, 'ACTIVO', 1, 5, 3),
(28, 'Jordan', 'Moses', 'Willis', 'Blackburn', '1970-01-01', 'JWillis', '89338443', 'Caplan', '169012159472', 'JWillis', 'JWillis@gmail.com', NULL, 'ACTIVO', 1, 5, 3),
(29, 'Todd', 'Brianna', 'Carney', 'Herring', '2019-12-03', 'TCarney', '47096474', 'Atlanta', '162707134223', 'TCarney', 'TCarney@gmail.com', NULL, 'ACTIVO', 1, 5, 3),
(30, 'Giacomo', 'Scarlett', 'Atkinson', 'Blankenship', '2006-11-12', 'GAtkinson', '42460411', 'Sint-Stevens-Woluwe', '164306157431', 'GAtkinson', 'GAtkinson@gmail.com', NULL, 'ACTIVO', 1, 5, 3),
(31, 'Rafael', 'Raymond', 'Morrison', 'Lowery', '1970-01-01', 'RMorrison', '95629226', 'Forfar', '168702226559', 'RMorrison', 'RMorrison@gmail.com', NULL, 'ACTIVO', 1, 5, 3),
(32, 'Basil', 'Benjamin', 'Ferguson', 'Kaufman', '1970-01-01', 'BFerguson', '67591177', 'St. Catharines', '160902165513', 'BFerguson', 'BFerguson@gmail.com', NULL, 'ACTIVO', 1, 5, 3),
(33, 'Marsden', 'Virginia', 'Taylor', 'Grant', '1970-01-01', 'MTaylor', '10087666', 'Abbateggio', '167706219008', 'MTaylor', 'MTaylor@gmail.com', NULL, 'ACTIVO', 1, 5, 3),
(34, 'Donovan', 'Damon', 'Rowland', 'Todd', '1970-01-01', 'DRowland', '77613653', 'Fort Wayne', '165705066123', 'DRowland', 'DRowland@gmail.com', NULL, 'ACTIVO', 1, 5, 3),
(35, 'Nicholas', 'Lysandra', 'Ruiz', 'Henderson', '1970-01-01', 'NRuiz', '65370435', 'Gloucester', '164811126616', 'NRuiz', 'NRuiz@gmail.com', NULL, 'ACTIVO', 1, 5, 3),
(36, 'Josiah', 'Gannon', 'Simpson', 'Raymond', '1970-01-01', 'JSimpson', '81864679', 'Okotoks', '161103102974', 'JSimpson', 'JSimpson@gmail.com', NULL, 'ACTIVO', 1, 5, 3),
(37, 'Chadwick', 'Glenna', 'Jacobson', 'Wallace', '1970-01-01', 'CJacobson', '28174144', 'Sabanalarga', '160903136133', 'CJacobson', 'CJacobson@gmail.com', NULL, 'ACTIVO', 1, 5, 3),
(38, 'Ivor', 'Aubrey', 'Horton', 'Church', '1970-01-01', 'IHorton', '43035869', 'Dipignano', '163511230371', 'IHorton', 'IHorton@gmail.com', NULL, 'ACTIVO', 1, 5, 3),
(39, 'Eagan', 'Ivy', 'Holcomb', 'Cline', '1970-01-01', 'EHolcomb', '67685676', 'Pointe-au-Pic', '169508245157', 'EHolcomb', 'EHolcomb@gmail.com', NULL, 'ACTIVO', 1, 5, 3),
(40, 'Donovan', 'Jamalia', 'Buck', 'Strong', '2017-04-03', 'DBuck', '09917981', 'Harrison Hot Springs', '164110204874', 'DBuck', 'DBuck@gmail.com', NULL, 'ACTIVO', 1, 5, 3),
(41, 'Avram', 'Kyle', 'Oconnor', 'Barron', '1970-01-01', 'AOconnor', '31782577', 'Sunderland', '162707176141', 'AOconnor', 'AOconnor@gmail.com', NULL, 'ACTIVO', 1, 5, 3),
(42, 'Erich', 'Chiquita', 'Moore', 'Charles', '1970-01-01', 'EMoore', '25977710', 'South Dum Dum', '161210262349', 'EMoore', 'EMoore@gmail.com', NULL, 'ACTIVO', 1, 5, 3),
(43, 'Mohammad', 'Stone', 'Kelley', 'Landry', '1970-01-01', 'MKelley', '29750610', 'Teralfene', '166407250106', 'MKelley', 'MKelley@gmail.com', NULL, 'ACTIVO', 1, 5, 3),
(44, 'William', 'Athena', 'Bowers', 'Maldonado', '1970-01-01', 'WBowers', '42618249', 'Novosibirsk', '164104126000', 'WBowers', 'WBowers@gmail.com', NULL, 'ACTIVO', 1, 5, 3),
(45, 'Drake', 'Maryam', 'Walker', 'Duncan', '1970-01-01', 'DWalker', '48238239', 'Sciacca', '167702211686', 'DWalker', 'DWalker@gmail.com', NULL, 'ACTIVO', 1, 5, 3),
(46, 'Martin', 'Fallon', 'Burton', 'Brady', '2015-02-07', 'MBurton', '27050530', 'Ahmadpur East', '163901099683', 'MBurton', 'MBurton@gmail.com', NULL, 'ACTIVO', 1, 5, 3),
(47, 'Hyatt', 'Sharon', 'Burke', 'Coffey', '2002-01-10', 'HBurke', '54827809', 'Abaetetuba', '163208041057', 'HBurke', 'HBurke@gmail.com', NULL, 'ACTIVO', 1, 5, 3),
(48, 'Lawrence', 'Kuame', 'Frank', 'Morris', '1970-01-01', 'LFrank', '34081494', 'Maidenhead', '163912036104', 'LFrank', 'LFrank@gmail.com', NULL, 'ACTIVO', 1, 5, 3),
(49, 'Nehru', 'Keaton', 'Marks', 'Bryan', '2006-09-08', 'NMarks', '14188252', 'Villers-le-Peuplier', '164503141477', 'NMarks', 'NMarks@gmail.com', NULL, 'ACTIVO', 1, 5, 3),
(50, 'Kamal', 'Marah', 'English', 'Cote', '2002-01-06', 'KEnglish', '84461640', 'Gateshead', '168209225062', 'KEnglish', 'KEnglish@gmail.com', NULL, 'ACTIVO', 1, 5, 3),
(51, 'Ignatius', 'Colt', 'Levy', 'Parker', '1970-01-01', 'ILevy', '34221770', 'Raurkela', '163807078211', 'ILevy', 'ILevy@gmail.com', NULL, 'ACTIVO', 1, 5, 3),
(52, 'Jason', 'Bianca', 'Mcdaniel', 'Livingston', '2004-04-06', 'JMcdaniel', '96464823', 'Okotoks', '162407211271', 'JMcdaniel', 'JMcdaniel@gmail.com', NULL, 'ACTIVO', 1, 5, 3),
(53, 'Carlos', 'Akeem', 'Delacruz', 'Taylor', '1970-01-01', 'CDelacruz', '01400689', 'Villa Alemana', '161403200262', 'CDelacruz', 'CDelacruz@gmail.com', NULL, 'ACTIVO', 1, 5, 3),
(54, 'Jelani', 'Leilani', 'Kent', 'Berg', '2001-10-10', 'JKent', '08528183', 'Puerto Octay', '164606168112', 'JKent', 'JKent@gmail.com', NULL, 'ACTIVO', 1, 5, 3),
(55, 'Ronan', 'Eugenia', 'Branch', 'Maxwell', '2011-04-05', 'RBranch', '96061416', 'Bahawalpur', '169908088454', 'RBranch', 'RBranch@gmail.com', NULL, 'ACTIVO', 1, 5, 3),
(56, 'Flynn', 'Maxwell', 'Cantu', 'Peterson', '1970-01-01', 'FCantu', '26625559', 'Clearwater Municipal Dist', '166106207332', 'FCantu', 'FCantu@gmail.com', NULL, 'ACTIVO', 1, 5, 3),
(57, 'Lionel', 'Raven', 'Schneider', 'Schultz', '2000-04-11', 'LSchneider', '01166078', 'Dave', '165807029656', 'LSchneider', 'LSchneider@gmail.com', NULL, 'ACTIVO', 1, 5, 3),
(58, 'Reuben', 'Hayes', 'Mercer', 'Wooten', '2012-09-09', 'RMercer', '74885243', 'Allahabad', '160311250807', 'RMercer', 'RMercer@gmail.com', NULL, 'ACTIVO', 1, 5, 3),
(60, 'Finn', 'Indira', 'Levine', 'Robles', '1970-01-01', 'FLevine', '22690236', 'Ketchikan', '166907082520', 'FLevine', 'FLevine@gmail.com', NULL, 'ACTIVO', 1, 5, 3),
(61, 'Rigel', 'Isaiah', 'Snyder', 'Madden', '1970-01-01', 'RSnyder', '10360297', 'Herk-de-Stad', '163606251381', 'RSnyder', 'RSnyder@gmail.com', NULL, 'ACTIVO', 1, 5, 3),
(62, 'Howard', 'Chandler', 'Collier', 'Mcknight', '1970-01-01', 'HCollier', '13749782', 'Avelgem', '160904058898', 'HCollier', 'HCollier@gmail.com', NULL, 'ACTIVO', 1, 5, 3),
(63, 'Tyler', 'Gisela', 'Riddle', 'Randall', '2006-09-07', 'TRiddle', '56831255', 'Hanam', '165406230614', 'TRiddle', 'TRiddle@gmail.com', NULL, 'ACTIVO', 1, 5, 3),
(64, 'Dorian', 'Gloria', 'Camacho', 'Jarvis', '1970-01-01', 'DCamacho', '36730937', 'Vancouver', '166803271029', 'DCamacho', 'DCamacho@gmail.com', NULL, 'ACTIVO', 1, 5, 3),
(65, 'Len', 'Grady', 'Stokes', 'Bradford', '1970-01-01', 'LStokes', '03279422', 'Coinco', '166301201932', 'LStokes', 'LStokes@gmail.com', NULL, 'ACTIVO', 1, 5, 3),
(66, 'Caleb', 'Drew', 'Crawford', 'Thompson', '1970-01-01', 'CCrawford', '84170687', 'Kharmang', '168606038225', 'CCrawford', 'CCrawford@gmail.com', NULL, 'ACTIVO', 1, 5, 3),
(67, 'Sean', 'Cedric', 'James', 'Valdez', '1970-01-01', 'SJames', '87714309', 'San NicolÃ¡s', '166805273346', 'SJames', 'SJames@gmail.com', NULL, 'ACTIVO', 1, 5, 3),
(68, 'Kuame', 'Barbara', 'Page', 'Crawford', '2004-01-09', 'KPage', '34508043', 'Pica', '163605293442', 'KPage', 'KPage@gmail.com', NULL, 'ACTIVO', 1, 5, 3),
(72, 'Zeph', 'Minerva', 'Becker', 'Pacheco', '1991-07-17', 'ZBecker', '95835938', 'Ciudad', '4167506273007', '95835938', 'ZBecker@gmail.com', NULL, 'ACTIVO', 1, 5, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` double NOT NULL,
  `subtotal` double NOT NULL,
  `producto_id` int(11) NOT NULL,
  `encabezado_venta_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventarecarga`
--

CREATE TABLE `ventarecarga` (
  `idventarecarga` int(11) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `status` varchar(10) NOT NULL DEFAULT 'ACTIVO',
  `totalventa` decimal(10,2) NOT NULL,
  `descripcion` varchar(25) DEFAULT NULL,
  `factura` varchar(15) DEFAULT NULL,
  `usuarios_idusuarios` int(11) DEFAULT NULL,
  `sucursal_idsucursal` int(11) DEFAULT NULL,
  `numero` varchar(15) DEFAULT NULL,
  `empresa` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ventarecarga`
--

INSERT INTO `ventarecarga` (`idventarecarga`, `fecha`, `status`, `totalventa`, `descripcion`, `factura`, `usuarios_idusuarios`, `sucursal_idsucursal`, `numero`, `empresa`) VALUES
(1, '2020-11-11 23:17:20', 'ACTIVO', 500.00, 'recarga', 'C512', 5, 2, '46234378', '1'),
(2, '2020-11-11 22:51:08', 'ACTIVO', 15.00, 'Saldo', 'C897', 5, 2, '55336969', '2'),
(3, '2020-11-18 06:11:18', 'ACTIVO', 1000.00, 'Internet', '00101', 4, 2, '47266906', '2'),
(4, '2020-11-18 07:10:39', 'ACTIVO', 697.25, 'Saldo', '666', 5, 2, '45659662', '2'),
(5, '2020-11-18 08:38:20', 'ACTIVO', 3000.00, 'Saldo', '65665', 5, 2, '4889693', '3'),
(6, '2020-11-18 08:39:14', 'ACTIVO', 150.00, 'Internet', '0asd', 4, 2, '47266906', '3'),
(7, '2020-11-19 04:00:45', 'ACTIVO', 10.00, 'Saldo', '00101', 0, 0, '4554', '2'),
(8, '2020-11-19 04:02:15', 'ACTIVO', 5.00, 'Saldo', '100', 0, 0, '78455', '2'),
(9, '2020-11-19 04:04:32', 'ACTIVO', 5.00, 'Saldo', '99', 6, 2, '12364', '2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta_recarga`
--

CREATE TABLE `venta_recarga` (
  `id` int(11) NOT NULL,
  `numero` varchar(15) NOT NULL,
  `monto` double NOT NULL,
  `fecha` date NOT NULL,
  `saldo_id` int(11) NOT NULL,
  `tipo_plan_id` int(11) NOT NULL,
  `sucursal_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `acciones`
--
ALTER TABLE `acciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_acciones_usuarios1_idx` (`usuarios_id`);

--
-- Indices de la tabla `asesor`
--
ALTER TABLE `asesor`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `correo_UNIQUE` (`correo`),
  ADD KEY `fk_asesor_empresa1_idx` (`empresa_id`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `correo_UNIQUE` (`correo`),
  ADD UNIQUE KEY `nit_UNIQUE` (`nit`);

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_compra_producto1_idx` (`producto_id`),
  ADD KEY `fk_compra_encabezado_compra1_idx` (`encabezado_compra_id`);

--
-- Indices de la tabla `comprarecarga`
--
ALTER TABLE `comprarecarga`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `datos_empresa`
--
ALTER TABLE `datos_empresa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- Indices de la tabla `detallecompra`
--
ALTER TABLE `detallecompra`
  ADD PRIMARY KEY (`iddetallecompra`);

--
-- Indices de la tabla `detallerecarga_temp`
--
ALTER TABLE `detallerecarga_temp`
  ADD PRIMARY KEY (`iddetallerecarga_temp`);

--
-- Indices de la tabla `detalleventa`
--
ALTER TABLE `detalleventa`
  ADD PRIMARY KEY (`iddetalleventa`);

--
-- Indices de la tabla `detalleventa_tmp`
--
ALTER TABLE `detalleventa_tmp`
  ADD PRIMARY KEY (`iddetalleventa_tmp`);

--
-- Indices de la tabla `detalle_compra_temp`
--
ALTER TABLE `detalle_compra_temp`
  ADD PRIMARY KEY (`iddetalle_compra_temp`);

--
-- Indices de la tabla `egresos`
--
ALTER TABLE `egresos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_egresos_usuarios1_idx` (`usuarios_id`),
  ADD KEY `fk_egresos_compra1_idx` (`compra_id`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nit_UNIQUE` (`nit`);

--
-- Indices de la tabla `encabezado_compra`
--
ALTER TABLE `encabezado_compra`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `encabezado_venta`
--
ALTER TABLE `encabezado_venta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_encabezado_venta_clientes1_idx` (`clientes_id`);

--
-- Indices de la tabla `estado_prod`
--
ALTER TABLE `estado_prod`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `horarios`
--
ALTER TABLE `horarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ingresos`
--
ALTER TABLE `ingresos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ingresos_venta1_idx` (`venta_id`),
  ADD KEY `fk_ingresos_venta_recarga1_idx` (`venta_recarga_id`),
  ADD KEY `fk_ingresos_usuarios1_idx` (`usuarios_id`);

--
-- Indices de la tabla `kardex`
--
ALTER TABLE `kardex`
  ADD PRIMARY KEY (`idkardex`);

--
-- Indices de la tabla `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_log_usuarios1_idx` (`usuarios_id`);

--
-- Indices de la tabla `precios`
--
ALTER TABLE `precios`
  ADD PRIMARY KEY (`idprecios`);

--
-- Indices de la tabla `privilegios`
--
ALTER TABLE `privilegios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_privilegios_roles1_idx` (`roles_id`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_producto_estado_prod1_idx` (`estado_prod_id`),
  ADD KEY `fk_producto_subcategoria1_idx` (`subcategoria_id`);

--
-- Indices de la tabla `recarga`
--
ALTER TABLE `recarga`
  ADD PRIMARY KEY (`idrecarga`),
  ADD UNIQUE KEY `empresa_id_UNIQUE` (`empresa_id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `saldo`
--
ALTER TABLE `saldo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_saldo_sucursal1_idx` (`sucursal_id`);

--
-- Indices de la tabla `subcategoria`
--
ALTER TABLE `subcategoria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_subcategoria_categoria_idx` (`categoria_id`);

--
-- Indices de la tabla `sucursal`
--
ALTER TABLE `sucursal`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `numero_UNIQUE` (`numero`),
  ADD KEY `fk_sucursal_datos_empresa1_idx` (`datos_empresa_id1`);

--
-- Indices de la tabla `tipo_plan`
--
ALTER TABLE `tipo_plan`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dpi_UNIQUE` (`dpi`),
  ADD UNIQUE KEY `correo_UNIQUE` (`correo`),
  ADD KEY `fk_usuarios_roles1_idx` (`roles_id`),
  ADD KEY `fk_usuarios_horarios1_idx` (`horarios_id`),
  ADD KEY `fk_usuarios_sucursal1_idx` (`sucursal_id`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_venta_producto1_idx` (`producto_id`),
  ADD KEY `fk_venta_encabezado_venta1_idx` (`encabezado_venta_id`);

--
-- Indices de la tabla `ventarecarga`
--
ALTER TABLE `ventarecarga`
  ADD PRIMARY KEY (`idventarecarga`);

--
-- Indices de la tabla `venta_recarga`
--
ALTER TABLE `venta_recarga`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_venta_recarga_saldo1_idx` (`saldo_id`),
  ADD KEY `fk_venta_recarga_tipo_plan1_idx` (`tipo_plan_id`),
  ADD KEY `fk_venta_recarga_sucursal1_idx` (`sucursal_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `acciones`
--
ALTER TABLE `acciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `asesor`
--
ALTER TABLE `asesor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `comprarecarga`
--
ALTER TABLE `comprarecarga`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `datos_empresa`
--
ALTER TABLE `datos_empresa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `detallecompra`
--
ALTER TABLE `detallecompra`
  MODIFY `iddetallecompra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de la tabla `detallerecarga_temp`
--
ALTER TABLE `detallerecarga_temp`
  MODIFY `iddetallerecarga_temp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `detalleventa`
--
ALTER TABLE `detalleventa`
  MODIFY `iddetalleventa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `detalleventa_tmp`
--
ALTER TABLE `detalleventa_tmp`
  MODIFY `iddetalleventa_tmp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT de la tabla `detalle_compra_temp`
--
ALTER TABLE `detalle_compra_temp`
  MODIFY `iddetalle_compra_temp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de la tabla `egresos`
--
ALTER TABLE `egresos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `encabezado_compra`
--
ALTER TABLE `encabezado_compra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `encabezado_venta`
--
ALTER TABLE `encabezado_venta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `estado_prod`
--
ALTER TABLE `estado_prod`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `horarios`
--
ALTER TABLE `horarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `ingresos`
--
ALTER TABLE `ingresos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `kardex`
--
ALTER TABLE `kardex`
  MODIFY `idkardex` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `precios`
--
ALTER TABLE `precios`
  MODIFY `idprecios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `privilegios`
--
ALTER TABLE `privilegios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `recarga`
--
ALTER TABLE `recarga`
  MODIFY `idrecarga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `saldo`
--
ALTER TABLE `saldo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `subcategoria`
--
ALTER TABLE `subcategoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `sucursal`
--
ALTER TABLE `sucursal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipo_plan`
--
ALTER TABLE `tipo_plan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ventarecarga`
--
ALTER TABLE `ventarecarga`
  MODIFY `idventarecarga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `venta_recarga`
--
ALTER TABLE `venta_recarga`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
