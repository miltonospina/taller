-- Adminer 4.6.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

CREATE DATABASE `taller` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `taller`;

DROP TABLE IF EXISTS `ci_sessions`;
CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('8513c6490074c5c0c589c448c2473ce5',	'127.0.0.1',	'Mozilla/5.0 (Windows NT 6.3; Win64; x64; rv:58.0) Gecko/20100101 Firefox/58.0',	1518824525,	'a:2:{s:9:\"user_data\";s:0:\"\";s:3:\"sal\";s:41:\"OIago6Qxyh371Cb3YWgXaALWOqCADMkZQvQKaWDWN\";}'),
('d138adbc08a964d3c171818d159d51e9',	'127.0.0.1',	'Mozilla/5.0 (Windows NT 6.3; Win64; x64; rv:58.0) Gecko/20100101 Firefox/58.0',	1518826851,	'a:3:{s:9:\"user_data\";s:0:\"\";s:7:\"usuario\";s:265:\"O:7:\"Usuario\":9:{s:6:\"codigo\";s:1:\"1\";s:6:\"nombre\";s:13:\"Administrador\";s:8:\"username\";s:5:\"admin\";s:8:\"password\";s:32:\"e10adc3949ba59abbe56e057f20f883e\";s:13:\"fecharegistro\";N;s:8:\"telefono\";N;s:14:\"identificacion\";N;s:6:\"correo\";N;s:3:\"rol\";s:13:\"Administrador\";}\";s:8:\"isLogged\";b:1;}');

DROP TABLE IF EXISTS `clases`;
CREATE TABLE `clases` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `atributos` text NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO `clases` (`codigo`, `nombre`, `atributos`) VALUES
(1,	'Pliegos',	'[]'),
(2,	'Rollos',	'[]');

DROP TABLE IF EXISTS `opciones`;
CREATE TABLE `opciones` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) NOT NULL,
  `valor` varchar(191) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `opciones` (`codigo`, `nombre`, `valor`) VALUES
(1,	'nombre_app',	'Taller');

DROP TABLE IF EXISTS `pantallas`;
CREATE TABLE `pantallas` (
  `codigo` int(11) NOT NULL,
  `titulo` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `descripcion` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `padre` int(11) DEFAULT NULL,
  `uri` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `icono` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `pantallas` (`codigo`, `titulo`, `descripcion`, `padre`, `uri`, `icono`) VALUES
(0,	'Inicio',	'Pantalla de inicio',	NULL,	'inicio',	'dashboard'),
(800,	'Configuración',	'Herramientas administrativas',	NULL,	'admin',	'wrench'),
(801,	'Usuarios',	'Gestión de usuarios y contraseñas',	800,	'admin/Gestion_usuarios',	'user'),
(802,	'Clases',	'Gestión de clases de productos',	800,	'productos/gestion_clases',	'th-large '),
(803,	'Productos',	'Gestión de referencias de productos',	800,	'productos/gestion_productos',	'tag'),
(911,	'Ayuda',	'manual de usuario',	NULL,	'ayuda',	'question-circle');

DROP TABLE IF EXISTS `productos`;
CREATE TABLE `productos` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `clase` int(11) NOT NULL,
  `atributos` text NOT NULL,
  PRIMARY KEY (`codigo`),
  KEY `clase` (`clase`),
  CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`clase`) REFERENCES `clases` (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `terceros`;
CREATE TABLE `terceros` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `identificacion` varchar(50) NOT NULL,
  `nombre` int(11) NOT NULL,
  `tipo` int(11) NOT NULL,
  `clase` int(11) NOT NULL,
  `atributos` int(11) NOT NULL,
  PRIMARY KEY (`codigo`),
  KEY `clase` (`clase`),
  CONSTRAINT `terceros_ibfk_1` FOREIGN KEY (`clase`) REFERENCES `clases` (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `rol` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `fecharegistro` date NOT NULL,
  `identificacion` varchar(30) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `telefono` varchar(30) NOT NULL,
  PRIMARY KEY (`codigo`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `usuarios` (`codigo`, `username`, `nombre`, `rol`, `password`, `fecharegistro`, `identificacion`, `correo`, `telefono`) VALUES
(1,	'admin',	'Administrador',	'Administrador',	'e10adc3949ba59abbe56e057f20f883e',	'2014-01-22',	'*123',	'admin@winpack.com.co',	'0');

-- 2018-02-17 01:36:22
