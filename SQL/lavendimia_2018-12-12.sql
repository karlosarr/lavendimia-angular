# ************************************************************
# Sequel Pro SQL dump
# Versión 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.5-10.3.9-MariaDB-1:10.3.9+maria~bionic)
# Base de datos: lavendimia
# Tiempo de Generación: 2018-12-12 15:18:27 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Volcado de tabla articulos
# ------------------------------------------------------------

DROP TABLE IF EXISTS `articulos`;

CREATE TABLE `articulos` (
  `idarticulos` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) NOT NULL,
  `modelo` varchar(45) DEFAULT NULL,
  `precio` float NOT NULL,
  `existencia` int(11) NOT NULL,
  `fecha_registro` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`idarticulos`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `articulos` WRITE;
/*!40000 ALTER TABLE `articulos` DISABLE KEYS */;

INSERT INTO `articulos` (`idarticulos`, `descripcion`, `modelo`, `precio`, `existencia`, `fecha_registro`)
VALUES
	(1,'Comedor 4 Sillas','Carlos V',4250,100,'2018-12-10 00:00:00');

/*!40000 ALTER TABLE `articulos` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla clientes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `clientes`;

CREATE TABLE `clientes` (
  `idclientes` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `apellido_parterno` varchar(45) NOT NULL,
  `apellido_materno` varchar(45) NOT NULL,
  `rfc` varchar(13) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  `fecha_registro` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`idclientes`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;

INSERT INTO `clientes` (`idclientes`, `nombre`, `apellido_parterno`, `apellido_materno`, `rfc`, `activo`, `fecha_registro`)
VALUES
	(1,'Carlos Adolfo','Ruiz','Rodríguez','RURC9010230P4',1,'2018-12-09 00:00:00'),
	(2,'Juan','Pérez','Mercado','MEPJ831209RL1',1,'2018-12-09 00:00:00');

/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla configuraciones
# ------------------------------------------------------------

DROP TABLE IF EXISTS `configuraciones`;

CREATE TABLE `configuraciones` (
  `idconfiguraciones` int(11) NOT NULL AUTO_INCREMENT,
  `tasa_financiamiento` float DEFAULT NULL,
  `enganche` float DEFAULT NULL,
  `plazo_maximo` int(11) DEFAULT NULL,
  `fecha_actualizacion` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`idconfiguraciones`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `configuraciones` WRITE;
/*!40000 ALTER TABLE `configuraciones` DISABLE KEYS */;

INSERT INTO `configuraciones` (`idconfiguraciones`, `tasa_financiamiento`, `enganche`, `plazo_maximo`, `fecha_actualizacion`)
VALUES
	(1,2.8,20,12,'2018-12-10 00:00:00');

/*!40000 ALTER TABLE `configuraciones` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla detalles_venta
# ------------------------------------------------------------

DROP TABLE IF EXISTS `detalles_venta`;

CREATE TABLE `detalles_venta` (
  `venta_idventa` int(11) NOT NULL,
  `articulos_idarticulos` int(11) NOT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `importe` float DEFAULT NULL,
  PRIMARY KEY (`venta_idventa`,`articulos_idarticulos`),
  KEY `fk_venta_has_articulos_articulos1_idx` (`articulos_idarticulos`),
  KEY `fk_venta_has_articulos_venta_idx` (`venta_idventa`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Volcado de tabla venta
# ------------------------------------------------------------

DROP TABLE IF EXISTS `venta`;

CREATE TABLE `venta` (
  `idventa` int(11) NOT NULL AUTO_INCREMENT,
  `activo` tinyint(1) DEFAULT 1,
  `clientes_idclientes` int(11) NOT NULL,
  `fecha_registro` timestamp NULL DEFAULT current_timestamp(),
  `meses` int(11) DEFAULT 1,
  `abono` float DEFAULT 0,
  `total` float DEFAULT 0,
  `status` varchar(45) DEFAULT 'FINALIZADA',
  `enganche` float DEFAULT 0,
  PRIMARY KEY (`idventa`),
  KEY `fk_venta_clientes1_idx` (`clientes_idclientes`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
