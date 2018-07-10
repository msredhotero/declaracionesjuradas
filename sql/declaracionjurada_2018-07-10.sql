-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 10-07-2018 a las 17:15:09
-- Versión del servidor: 5.5.24-log
-- Versión de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `declaracionjurada`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbarchivos`
--

CREATE TABLE IF NOT EXISTS `dbarchivos` (
  `idarchivo` int(11) NOT NULL AUTO_INCREMENT,
  `refclientes` int(11) NOT NULL,
  `token` varchar(36) NOT NULL,
  `type` varchar(45) DEFAULT NULL,
  `observacion` varchar(150) DEFAULT NULL,
  `imagen` varchar(149) DEFAULT NULL,
  `fechacreacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idarchivo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbbienesinmuebles`
--

CREATE TABLE IF NOT EXISTS `dbbienesinmuebles` (
  `idbieninmueble` int(11) NOT NULL AUTO_INCREMENT,
  `refdeclaracionjuradacabecera` int(11) NOT NULL,
  `reftipooperacion` int(11) NOT NULL,
  `reftipobien` int(11) NOT NULL,
  `refotrotipobien` int(11) NOT NULL,
  `mtrsterreno` int(11) DEFAULT NULL,
  `mtrsconstruccion` int(11) DEFAULT NULL,
  `refformaadquisicion` int(11) NOT NULL,
  `cesionario` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `reftitular` int(11) NOT NULL,
  `reftipocesionario` int(11) NOT NULL,
  `otrotipocesionario` varchar(80) COLLATE utf8_spanish_ci DEFAULT NULL,
  `valor` int(11) NOT NULL,
  `tipomoneda` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `fechaadquisicion` date NOT NULL,
  `registropublico` varchar(120) COLLATE utf8_spanish_ci DEFAULT NULL,
  `ubicacion` varchar(120) COLLATE utf8_spanish_ci DEFAULT NULL,
  `especificacionobra` varchar(160) COLLATE utf8_spanish_ci DEFAULT NULL,
  `especificacionventa` varchar(160) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idbieninmueble`),
  KEY `fk_bi_to_idx` (`reftipooperacion`),
  KEY `fk_bi_tb_idx` (`reftipobien`),
  KEY `fk_bi_fa_idx` (`refformaadquisicion`),
  KEY `fk_bi_otb_idx` (`refotrotipobien`),
  KEY `fk_bi_t_idx` (`reftitular`),
  KEY `fk_bi_tc_idx` (`reftipocesionario`),
  KEY `fk_bi_cab_idx` (`refdeclaracionjuradacabecera`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `dbbienesinmuebles`
--

INSERT INTO `dbbienesinmuebles` (`idbieninmueble`, `refdeclaracionjuradacabecera`, `reftipooperacion`, `reftipobien`, `refotrotipobien`, `mtrsterreno`, `mtrsconstruccion`, `refformaadquisicion`, `cesionario`, `reftitular`, `reftipocesionario`, `otrotipocesionario`, `valor`, `tipomoneda`, `fechaadquisicion`, `registropublico`, `ubicacion`, `especificacionobra`, `especificacionventa`) VALUES
(1, 1, 1, 1, 1, 620, NULL, 1, 'carfoure', 1, 1, '', 19200336, 'usd', '2018-02-14', 'asda awdawd', 'mexico', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbbienesmuebles`
--

CREATE TABLE IF NOT EXISTS `dbbienesmuebles` (
  `idbienmueble` int(11) NOT NULL AUTO_INCREMENT,
  `refdeclaracionjuradacabecera` int(11) NOT NULL,
  `reftipooperacion` int(11) NOT NULL,
  `reftipobien` int(11) NOT NULL,
  `descripcion` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `refformaadquisicion` int(11) NOT NULL,
  `cesionario` varchar(120) COLLATE utf8_spanish_ci NOT NULL,
  `reftipocesionario` int(11) NOT NULL,
  `otrotipocesionario` varchar(80) COLLATE utf8_spanish_ci DEFAULT NULL,
  `valor` int(11) NOT NULL,
  `tipomoneda` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `fechaadquisicion` date NOT NULL,
  `reftitular` int(11) NOT NULL,
  `especificacionventa` varchar(160) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idbienmueble`),
  KEY `fk_bm_to_idx` (`reftipooperacion`),
  KEY `fk_bm_tb_idx` (`reftipobien`),
  KEY `fk_bm_fa_idx` (`refformaadquisicion`),
  KEY `fk_bm_tc_idx` (`reftipocesionario`),
  KEY `fk_bm_t_idx` (`reftitular`),
  KEY `fk_bm_cab_idx` (`refdeclaracionjuradacabecera`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `dbbienesmuebles`
--

INSERT INTO `dbbienesmuebles` (`idbienmueble`, `refdeclaracionjuradacabecera`, `reftipooperacion`, `reftipobien`, `descripcion`, `refformaadquisicion`, `cesionario`, `reftipocesionario`, `otrotipocesionario`, `valor`, `tipomoneda`, `fechaadquisicion`, `reftitular`, `especificacionventa`) VALUES
(1, 1, 2, 3, 'Casa chalet', 4, 'Perez Jose', 1, '', 1500600, 'pesos mexicanos', '2010-02-13', 1, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbdeclaracionanualinteres`
--

CREATE TABLE IF NOT EXISTS `dbdeclaracionanualinteres` (
  `iddeclaracionanualinteres` int(11) NOT NULL AUTO_INCREMENT,
  `refdeclaracionjuradacabecera` int(11) NOT NULL,
  `essecretario` bit(1) DEFAULT NULL,
  `esauditor` bit(1) DEFAULT NULL,
  `ejercicio` int(11) DEFAULT NULL,
  `espublico` bit(1) DEFAULT NULL,
  `refpoder` int(11) NOT NULL,
  `registrofederalcontribuyente` varchar(120) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fechadeclaracionanterior` date DEFAULT NULL,
  `fechatomaposesion` date DEFAULT NULL,
  `cargoactual` varchar(120) COLLATE utf8_spanish_ci DEFAULT NULL,
  `cargoanterior` varchar(120) COLLATE utf8_spanish_ci DEFAULT NULL,
  `areaadquisicion` varchar(120) COLLATE utf8_spanish_ci DEFAULT NULL,
  `areaadquisicionanterior` varchar(120) COLLATE utf8_spanish_ci DEFAULT NULL,
  `dependencia` varchar(120) COLLATE utf8_spanish_ci DEFAULT NULL,
  `dependenciaanterior` varchar(120) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`iddeclaracionanualinteres`),
  KEY `fk_di_p_idx` (`refpoder`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `dbdeclaracionanualinteres`
--

INSERT INTO `dbdeclaracionanualinteres` (`iddeclaracionanualinteres`, `refdeclaracionjuradacabecera`, `essecretario`, `esauditor`, `ejercicio`, `espublico`, `refpoder`, `registrofederalcontribuyente`, `fechadeclaracionanterior`, `fechatomaposesion`, `cargoactual`, `cargoanterior`, `areaadquisicion`, `areaadquisicionanterior`, `dependencia`, `dependenciaanterior`) VALUES
(1, 1, b'0', b'0', 2018, b'0', 1, '', NULL, NULL, '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbdeclaracionjuradacabecera`
--

CREATE TABLE IF NOT EXISTS `dbdeclaracionjuradacabecera` (
  `iddeclaracionjuradacabecera` int(11) NOT NULL AUTO_INCREMENT,
  `fecharecepcion` date NOT NULL,
  `primerapellido` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `segundoapellido` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `nombres` varchar(120) COLLATE utf8_spanish_ci NOT NULL,
  `curp` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `homoclave` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `emailinstitucional` varchar(130) COLLATE utf8_spanish_ci DEFAULT NULL,
  `emailalterno` varchar(130) COLLATE utf8_spanish_ci DEFAULT NULL,
  `refestadocivil` int(11) NOT NULL,
  `refregimenmatrimonial` int(11) NOT NULL,
  `paisnacimiento` varchar(120) COLLATE utf8_spanish_ci NOT NULL,
  `nacionalidad` varchar(120) COLLATE utf8_spanish_ci NOT NULL,
  `entidadnacimiento` varchar(120) COLLATE utf8_spanish_ci NOT NULL,
  `numerocelular` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `lugarubica` int(11) NOT NULL,
  `domicilioparticular` varchar(160) COLLATE utf8_spanish_ci DEFAULT NULL,
  `localidad` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `municipio` varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL,
  `lada` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefono` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `entidadfederativa` varchar(80) COLLATE utf8_spanish_ci DEFAULT NULL,
  `codigopostal` varchar(12) COLLATE utf8_spanish_ci DEFAULT NULL,
  `sexo` int(11) NOT NULL,
  `estudios` varchar(120) COLLATE utf8_spanish_ci DEFAULT NULL,
  `cedulaprofesional` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `refusuarios` int(11) NOT NULL,
  `refestados` int(11) DEFAULT NULL,
  PRIMARY KEY (`iddeclaracionjuradacabecera`),
  KEY `fk_ddjj_estadocivil_idx` (`refestadocivil`),
  KEY `fk_ddjj_regimen_idx` (`refregimenmatrimonial`),
  KEY `fk_ddjj_usuarios_idx` (`refusuarios`),
  KEY `fk_ddjj_estados_idx` (`refestados`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `dbdeclaracionjuradacabecera`
--

INSERT INTO `dbdeclaracionjuradacabecera` (`iddeclaracionjuradacabecera`, `fecharecepcion`, `primerapellido`, `segundoapellido`, `nombres`, `curp`, `homoclave`, `emailinstitucional`, `emailalterno`, `refestadocivil`, `refregimenmatrimonial`, `paisnacimiento`, `nacionalidad`, `entidadnacimiento`, `numerocelular`, `lugarubica`, `domicilioparticular`, `localidad`, `municipio`, `lada`, `telefono`, `entidadfederativa`, `codigopostal`, `sexo`, `estudios`, `cedulaprofesional`, `refusuarios`, `refestados`) VALUES
(1, '2018-06-06', 'safar', 'asdas', 'asdasd', 'AAGL690917MMSLRC09', 'd23d3', 'sdasd', 'asdasd', 1, 1, 'asdasd', 'asdas', 'asdasd', 'asdasd', 1, 'asdas', 'asdasd', 'asdasd', 'asdas', 'asdasd', 'asdas', 'asdas', 2, 'asdasd', '', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbdependienteseconomicos`
--

CREATE TABLE IF NOT EXISTS `dbdependienteseconomicos` (
  `iddependienteeconomico` int(11) NOT NULL AUTO_INCREMENT,
  `refdeclaracionjuradacabecera` int(11) NOT NULL,
  `tiene` bit(1) NOT NULL DEFAULT b'0',
  `nombre` varchar(120) COLLATE utf8_spanish_ci NOT NULL,
  `edad` int(11) NOT NULL,
  `reftipoparentesco` int(11) NOT NULL,
  PRIMARY KEY (`iddependienteeconomico`),
  KEY `fk_de_tp_idx` (`reftipoparentesco`),
  KEY `fk_de_dp_idx` (`refdeclaracionjuradacabecera`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `dbdependienteseconomicos`
--

INSERT INTO `dbdependienteseconomicos` (`iddependienteeconomico`, `refdeclaracionjuradacabecera`, `tiene`, `nombre`, `edad`, `reftipoparentesco`) VALUES
(1, 1, b'1', 'Saupurein Safar Marcos Daniel', 33, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbingresosanuales`
--

CREATE TABLE IF NOT EXISTS `dbingresosanuales` (
  `idingresoanual` int(11) NOT NULL AUTO_INCREMENT,
  `refdeclaracionjuradacabecera` int(11) NOT NULL,
  `remuneracionanualneta` decimal(18,2) NOT NULL,
  `actividadindustrial` decimal(18,2) DEFAULT '0.00',
  `razonsocialactividadindustrial` varchar(120) COLLATE utf8_spanish_ci DEFAULT NULL,
  `actividadfinanciera` decimal(18,2) DEFAULT '0.00',
  `razonsocialactividadfinanciera` varchar(120) COLLATE utf8_spanish_ci DEFAULT NULL,
  `actividadprofesional` decimal(18,2) DEFAULT '0.00',
  `descripcionactividadprofesional` varchar(120) COLLATE utf8_spanish_ci DEFAULT NULL,
  `otros` decimal(18,2) DEFAULT '0.00',
  `especifiqueotros` varchar(120) COLLATE utf8_spanish_ci DEFAULT NULL,
  `ingresoanualconyuge` decimal(18,2) DEFAULT '0.00',
  `especifiqueingresosconyuge` varchar(120) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fueservidorpublico` bit(1) DEFAULT NULL,
  `vigenciadesde` date DEFAULT NULL,
  `vigenciahasta` date DEFAULT NULL,
  PRIMARY KEY (`idingresoanual`),
  KEY `fk_inganual_cab_idx` (`refdeclaracionjuradacabecera`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `dbingresosanuales`
--

INSERT INTO `dbingresosanuales` (`idingresoanual`, `refdeclaracionjuradacabecera`, `remuneracionanualneta`, `actividadindustrial`, `razonsocialactividadindustrial`, `actividadfinanciera`, `razonsocialactividadfinanciera`, `actividadprofesional`, `descripcionactividadprofesional`, `otros`, `especifiqueotros`, `ingresoanualconyuge`, `especifiqueingresosconyuge`, `fueservidorpublico`, `vigenciadesde`, `vigenciahasta`) VALUES
(4, 1, '2632003.00', '9800.00', 'asdasd', '0.00', '', '0.00', '', '0.00', '', '0.00', '', b'0', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbinversiones`
--

CREATE TABLE IF NOT EXISTS `dbinversiones` (
  `idinversion` int(11) NOT NULL AUTO_INCREMENT,
  `refdeclaracionjuradacabecera` int(11) NOT NULL,
  `reftipooperacion` int(11) NOT NULL,
  `reftitular` int(11) NOT NULL,
  `numerocuenta` varchar(22) COLLATE utf8_spanish_ci NOT NULL,
  `donde` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `razonsocial` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `pais` varchar(40) COLLATE utf8_spanish_ci DEFAULT NULL,
  `saldo` int(11) NOT NULL,
  `tipomoneda` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `reftipoinversion` int(11) NOT NULL,
  `especifica` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idinversion`),
  KEY `fk_inv_cab_idx` (`refdeclaracionjuradacabecera`),
  KEY `fk_inv_to_idx` (`reftipooperacion`),
  KEY `fk_inv_t_idx` (`reftitular`),
  KEY `fk_inv_ti_idx` (`reftipoinversion`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `dbinversiones`
--

INSERT INTO `dbinversiones` (`idinversion`, `refdeclaracionjuradacabecera`, `reftipooperacion`, `reftitular`, `numerocuenta`, `donde`, `razonsocial`, `pais`, `saldo`, `tipomoneda`, `reftipoinversion`, `especifica`) VALUES
(1, 1, 1, 1, '465asd', 'Extrangero', 'moorr', 'Bolivia', 1587943, 'usd', 1, 'hoteles');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbpublicacion`
--

CREATE TABLE IF NOT EXISTS `dbpublicacion` (
  `idpublicacion` int(11) NOT NULL AUTO_INCREMENT,
  `refdeclaracionjuradacabecera` int(11) NOT NULL,
  `estadeacuerdo` bit(1) NOT NULL DEFAULT b'0',
  `eningresosnetos` bit(1) NOT NULL DEFAULT b'0',
  `enbienesinmuebles` bit(1) NOT NULL DEFAULT b'0',
  `enbienesmuebles` bit(1) NOT NULL DEFAULT b'0',
  `envehiculos` bit(1) NOT NULL DEFAULT b'0',
  `eninversiones` bit(1) NOT NULL DEFAULT b'0',
  `enadeudos` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`idpublicacion`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `dbpublicacion`
--

INSERT INTO `dbpublicacion` (`idpublicacion`, `refdeclaracionjuradacabecera`, `estadeacuerdo`, `eningresosnetos`, `enbienesinmuebles`, `enbienesmuebles`, `envehiculos`, `eninversiones`, `enadeudos`) VALUES
(6, 1, b'1', b'1', b'1', b'0', b'0', b'0', b'0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbusuarios`
--

CREATE TABLE IF NOT EXISTS `dbusuarios` (
  `idusuario` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `refroles` int(11) NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `nombrecompleto` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `activo` bit(1) DEFAULT b'0',
  PRIMARY KEY (`idusuario`),
  KEY `fk_dbusuarios_tbroles1_idx` (`refroles`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `dbusuarios`
--

INSERT INTO `dbusuarios` (`idusuario`, `usuario`, `password`, `refroles`, `email`, `nombrecompleto`, `activo`) VALUES
(1, 'msredhortero', 'marcos', 1, 'msredhotero@msn.com', 'Saupurein Marcos', b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbvehiculos`
--

CREATE TABLE IF NOT EXISTS `dbvehiculos` (
  `idvehiculos` int(11) NOT NULL AUTO_INCREMENT,
  `refdeclaracionjuradacabecera` int(11) NOT NULL,
  `reftipooperacion` int(11) NOT NULL,
  `vehiculo` varchar(120) COLLATE utf8_spanish_ci NOT NULL,
  `donde` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `entidadfederativa` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `refformaadquisicion` int(11) NOT NULL,
  `cesionario` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `reftipocesionario` int(11) NOT NULL,
  `otrotipocesionario` varchar(80) COLLATE utf8_spanish_ci DEFAULT NULL,
  `valor` int(11) NOT NULL,
  `tipomoneda` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `fechaadquisicion` date NOT NULL,
  `reftitular` int(11) NOT NULL,
  `especificacionventa` varchar(160) COLLATE utf8_spanish_ci DEFAULT NULL,
  `especificacionsiniestro` varchar(160) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idvehiculos`),
  KEY `fk_v_to_idx` (`reftipooperacion`),
  KEY `fk_v_fa_idx` (`refformaadquisicion`),
  KEY `fk_v_tc_idx` (`reftipocesionario`),
  KEY `fk_v_t_idx` (`reftitular`),
  KEY `fk_v_cab_idx` (`refdeclaracionjuradacabecera`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `dbvehiculos`
--

INSERT INTO `dbvehiculos` (`idvehiculos`, `refdeclaracionjuradacabecera`, `reftipooperacion`, `vehiculo`, `donde`, `entidadfederativa`, `refformaadquisicion`, `cesionario`, `reftipocesionario`, `otrotipocesionario`, `valor`, `tipomoneda`, `fechaadquisicion`, `reftitular`, `especificacionventa`, `especificacionsiniestro`) VALUES
(1, 1, 1, 'Ford Fiesta Max asd646', 'Mexico', 'nose', 1, 'ford', 2, '', 3800100, 'pesos mexicanos', '2018-05-10', 1, '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `idfoto` int(11) NOT NULL AUTO_INCREMENT,
  `refproyecto` int(11) NOT NULL,
  `refuser` int(11) NOT NULL,
  `imagen` varchar(149) DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL,
  `principal` bit(1) DEFAULT NULL,
  PRIMARY KEY (`idfoto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `loginreal`
--

CREATE TABLE IF NOT EXISTS `loginreal` (
  `idloginreal` int(11) NOT NULL AUTO_INCREMENT,
  `empleado_id` int(11) DEFAULT NULL,
  `nombre` varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL,
  `paterno` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL,
  `materno` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL,
  `sexo` varchar(1) COLLATE utf8_spanish_ci DEFAULT NULL,
  `curp` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `rfc` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_identificacion` int(11) DEFAULT NULL,
  `expide_ident` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `no_ident` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `edad` int(11) DEFAULT NULL,
  `telefono` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `celular` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `email` varchar(90) COLLATE utf8_spanish_ci DEFAULT NULL,
  `domicilio_lab` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `domicilio_entrega` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `domicilio_particular` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `departamento_id` int(11) DEFAULT NULL,
  `puesto_id` int(11) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `fecha_entraga` date DEFAULT NULL,
  `clasificacion` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `pass_user` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_perfil` int(11) DEFAULT NULL,
  PRIMARY KEY (`idloginreal`),
  UNIQUE KEY `id_identificacion_UNIQUE` (`id_identificacion`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `loginreal`
--

INSERT INTO `loginreal` (`idloginreal`, `empleado_id`, `nombre`, `paterno`, `materno`, `sexo`, `curp`, `rfc`, `id_identificacion`, `expide_ident`, `no_ident`, `edad`, `telefono`, `celular`, `email`, `domicilio_lab`, `domicilio_entrega`, `domicilio_particular`, `departamento_id`, `puesto_id`, `fecha_inicio`, `fecha_fin`, `fecha_entraga`, `clasificacion`, `pass_user`, `id_perfil`) VALUES
(1, 10008, 'VANNESA', 'ALVAREZ', 'GARCIA', NULL, 'AAGL690917MMSLRC09', 'AAGL6909171G7', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'CN20141', 'vanne', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `predio_menu`
--

CREATE TABLE IF NOT EXISTS `predio_menu` (
  `idmenu` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `icono` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `Orden` smallint(6) DEFAULT NULL,
  `hover` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `permiso` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idmenu`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=47 ;

--
-- Volcado de datos para la tabla `predio_menu`
--

INSERT INTO `predio_menu` (`idmenu`, `url`, `icono`, `nombre`, `Orden`, `hover`, `permiso`) VALUES
(1, '../index.php', 'icodashboard', 'Dashboard', 1, NULL, 'Administrador, Usuario'),
(8, '../logout.php', 'icosalir', 'Salir', 30, NULL, 'Administrador, Usuario'),
(18, '../declaracionpatrimonial/', 'icousuarios', 'Declaraciones', 2, NULL, 'Administrador'),
(30, '../usuarios/', 'icousuarios', 'Usuarios', 14, NULL, 'Administrador'),
(31, '../estadocivil/', 'icoconfiguracion', 'Estado Civil', 15, NULL, 'Administrador'),
(32, '../regimenmatrimonial/', 'icoconfiguracion', 'Regimen Matrimonial', 16, NULL, 'Administrador'),
(33, '../poder/', 'icoconfiguracion', 'Poder', 17, NULL, 'Administrador'),
(34, '../tipoparentesco/', 'icoconfiguracion', 'Tipo Parentesco', 18, NULL, 'Administrador'),
(35, '../declaracionanual/', 'icoconfiguracion', 'Declaracion Anual', 6, NULL, 'Administrador'),
(36, '../publicacion/', 'icoconfiguracion', 'Datos Publicos', 3, NULL, 'Administrador'),
(37, '../ingresosanuales/', 'icoconfiguracion', 'Ingresos Anuales', 4, NULL, 'Administrador'),
(38, '../dependienteseconomicos/', 'icoconfiguracion', 'Dependientes Economicos', 5, NULL, 'Administrador'),
(39, '../tipooperacion/', 'icoconfiguracion', 'Tipo de Operaciones', 19, NULL, 'Administrador'),
(40, '../tipobien/', 'icoconfiguracion', 'Tipo de Bien', 20, NULL, 'Administrador'),
(41, '../otrotipobien/', 'icoconfiguracion', 'Otro Tipo de Bien', 21, NULL, 'Administrador'),
(42, '../tipoinversion/', 'icoconfiguracion', 'Tipo de Inversion', 22, NULL, 'Administrador'),
(43, '../formaadquisicion/', 'icoconfiguracion', 'Forma de Adquisicion', 23, NULL, 'Administrador'),
(44, '../titular/', 'icoconfiguracion', 'Titular', 24, NULL, 'Administrador'),
(45, '../tipocesionario/', 'icoconfiguracion', 'Tipo de Cesionario', 25, NULL, 'Administrador'),
(46, '../bienesmuebles/', 'icoconfiguracion', 'Bienes Muebles', 7, NULL, 'Administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbestadocivil`
--

CREATE TABLE IF NOT EXISTS `tbestadocivil` (
  `idestadocivil` int(11) NOT NULL AUTO_INCREMENT,
  `estadocivil` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idestadocivil`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `tbestadocivil`
--

INSERT INTO `tbestadocivil` (`idestadocivil`, `estadocivil`) VALUES
(1, 'Soltero'),
(2, 'Casado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbestados`
--

CREATE TABLE IF NOT EXISTS `tbestados` (
  `idestado` int(11) NOT NULL AUTO_INCREMENT,
  `estado` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idestado`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `tbestados`
--

INSERT INTO `tbestados` (`idestado`, `estado`) VALUES
(1, 'Iniciado'),
(2, 'Finalizado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbformaadquisicion`
--

CREATE TABLE IF NOT EXISTS `tbformaadquisicion` (
  `idformaadquisicion` int(11) NOT NULL AUTO_INCREMENT,
  `formaadquisicion` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idformaadquisicion`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `tbformaadquisicion`
--

INSERT INTO `tbformaadquisicion` (`idformaadquisicion`, `formaadquisicion`) VALUES
(1, 'Contado'),
(2, 'Credito'),
(3, 'Donacion'),
(4, 'Herencia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbotrotipobien`
--

CREATE TABLE IF NOT EXISTS `tbotrotipobien` (
  `idotrotipobien` int(11) NOT NULL AUTO_INCREMENT,
  `otrotipobien` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idotrotipobien`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `tbotrotipobien`
--

INSERT INTO `tbotrotipobien` (`idotrotipobien`, `otrotipobien`) VALUES
(1, 'Ampliacion'),
(2, 'Construccion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbpoder`
--

CREATE TABLE IF NOT EXISTS `tbpoder` (
  `idpoder` int(11) NOT NULL AUTO_INCREMENT,
  `poder` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idpoder`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `tbpoder`
--

INSERT INTO `tbpoder` (`idpoder`, `poder`) VALUES
(1, 'Ejecutivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbregimenmatrimonial`
--

CREATE TABLE IF NOT EXISTS `tbregimenmatrimonial` (
  `idregimenmatrimonial` int(11) NOT NULL AUTO_INCREMENT,
  `regimenmatrimonial` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idregimenmatrimonial`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `tbregimenmatrimonial`
--

INSERT INTO `tbregimenmatrimonial` (`idregimenmatrimonial`, `regimenmatrimonial`) VALUES
(1, 'Sociedad Conyugal');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbroles`
--

CREATE TABLE IF NOT EXISTS `tbroles` (
  `idrol` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) NOT NULL,
  `activo` bit(1) NOT NULL,
  PRIMARY KEY (`idrol`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `tbroles`
--

INSERT INTO `tbroles` (`idrol`, `descripcion`, `activo`) VALUES
(1, 'Administrador', b'1'),
(2, 'Usuario', b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbtipobien`
--

CREATE TABLE IF NOT EXISTS `tbtipobien` (
  `idtipobien` int(11) NOT NULL AUTO_INCREMENT,
  `tipobien` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idtipobien`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `tbtipobien`
--

INSERT INTO `tbtipobien` (`idtipobien`, `tipobien`) VALUES
(1, 'Edificio'),
(2, 'Palco'),
(3, 'Casa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbtipocesionario`
--

CREATE TABLE IF NOT EXISTS `tbtipocesionario` (
  `idtipocesionario` int(11) NOT NULL AUTO_INCREMENT,
  `tipocesionario` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idtipocesionario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `tbtipocesionario`
--

INSERT INTO `tbtipocesionario` (`idtipocesionario`, `tipocesionario`) VALUES
(1, 'Abuelo'),
(2, 'Primo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbtipoinversion`
--

CREATE TABLE IF NOT EXISTS `tbtipoinversion` (
  `idtipoinversion` int(11) NOT NULL AUTO_INCREMENT,
  `tipoinversion` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idtipoinversion`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `tbtipoinversion`
--

INSERT INTO `tbtipoinversion` (`idtipoinversion`, `tipoinversion`) VALUES
(1, 'Bancaria'),
(2, 'Valores Bursatiles');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbtipooperacion`
--

CREATE TABLE IF NOT EXISTS `tbtipooperacion` (
  `idtipooperacion` int(11) NOT NULL AUTO_INCREMENT,
  `tipooperacion` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idtipooperacion`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `tbtipooperacion`
--

INSERT INTO `tbtipooperacion` (`idtipooperacion`, `tipooperacion`) VALUES
(1, 'Incorporacion'),
(2, 'Obra'),
(3, 'Venta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbtipoparentesco`
--

CREATE TABLE IF NOT EXISTS `tbtipoparentesco` (
  `idtipoparentesco` int(11) NOT NULL AUTO_INCREMENT,
  `tipoparentesco` varchar(120) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idtipoparentesco`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `tbtipoparentesco`
--

INSERT INTO `tbtipoparentesco` (`idtipoparentesco`, `tipoparentesco`) VALUES
(1, 'Padre');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbtitular`
--

CREATE TABLE IF NOT EXISTS `tbtitular` (
  `idtitular` int(11) NOT NULL AUTO_INCREMENT,
  `titular` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idtitular`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `tbtitular`
--

INSERT INTO `tbtitular` (`idtitular`, `titular`) VALUES
(1, 'Declarante'),
(2, 'Conyuge');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `dbbienesinmuebles`
--
ALTER TABLE `dbbienesinmuebles`
  ADD CONSTRAINT `fk_bi_cab` FOREIGN KEY (`refdeclaracionjuradacabecera`) REFERENCES `dbdeclaracionjuradacabecera` (`iddeclaracionjuradacabecera`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_bi_fa` FOREIGN KEY (`refformaadquisicion`) REFERENCES `tbformaadquisicion` (`idformaadquisicion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_bi_otb` FOREIGN KEY (`refotrotipobien`) REFERENCES `tbotrotipobien` (`idotrotipobien`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_bi_t` FOREIGN KEY (`reftitular`) REFERENCES `tbtitular` (`idtitular`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_bi_tb` FOREIGN KEY (`reftipobien`) REFERENCES `tbtipobien` (`idtipobien`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_bi_tc` FOREIGN KEY (`reftipocesionario`) REFERENCES `tbtipocesionario` (`idtipocesionario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_bi_to` FOREIGN KEY (`reftipooperacion`) REFERENCES `tbtipooperacion` (`idtipooperacion`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `dbbienesmuebles`
--
ALTER TABLE `dbbienesmuebles`
  ADD CONSTRAINT `fk_bm_cab` FOREIGN KEY (`refdeclaracionjuradacabecera`) REFERENCES `dbdeclaracionjuradacabecera` (`iddeclaracionjuradacabecera`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_bm_fa` FOREIGN KEY (`refformaadquisicion`) REFERENCES `tbformaadquisicion` (`idformaadquisicion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_bm_t` FOREIGN KEY (`reftitular`) REFERENCES `tbtitular` (`idtitular`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_bm_tb` FOREIGN KEY (`reftipobien`) REFERENCES `tbtipobien` (`idtipobien`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_bm_tc` FOREIGN KEY (`reftipocesionario`) REFERENCES `tbtipocesionario` (`idtipocesionario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_bm_to` FOREIGN KEY (`reftipooperacion`) REFERENCES `tbtipooperacion` (`idtipooperacion`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `dbdeclaracionanualinteres`
--
ALTER TABLE `dbdeclaracionanualinteres`
  ADD CONSTRAINT `fk_di_p` FOREIGN KEY (`refpoder`) REFERENCES `tbpoder` (`idpoder`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `dbdeclaracionjuradacabecera`
--
ALTER TABLE `dbdeclaracionjuradacabecera`
  ADD CONSTRAINT `fk_ddjj_estados` FOREIGN KEY (`refestados`) REFERENCES `tbestados` (`idestado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ddjj_estadocivil` FOREIGN KEY (`refestadocivil`) REFERENCES `tbestadocivil` (`idestadocivil`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ddjj_regimen` FOREIGN KEY (`refregimenmatrimonial`) REFERENCES `tbregimenmatrimonial` (`idregimenmatrimonial`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ddjj_usuarios` FOREIGN KEY (`refusuarios`) REFERENCES `dbusuarios` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `dbdependienteseconomicos`
--
ALTER TABLE `dbdependienteseconomicos`
  ADD CONSTRAINT `fk_de_dp` FOREIGN KEY (`refdeclaracionjuradacabecera`) REFERENCES `dbdeclaracionjuradacabecera` (`iddeclaracionjuradacabecera`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_de_tp` FOREIGN KEY (`reftipoparentesco`) REFERENCES `tbtipoparentesco` (`idtipoparentesco`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `dbingresosanuales`
--
ALTER TABLE `dbingresosanuales`
  ADD CONSTRAINT `fk_inganual_cab` FOREIGN KEY (`refdeclaracionjuradacabecera`) REFERENCES `dbdeclaracionjuradacabecera` (`iddeclaracionjuradacabecera`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `dbinversiones`
--
ALTER TABLE `dbinversiones`
  ADD CONSTRAINT `fk_inv_cab` FOREIGN KEY (`refdeclaracionjuradacabecera`) REFERENCES `dbdeclaracionjuradacabecera` (`iddeclaracionjuradacabecera`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_inv_t` FOREIGN KEY (`reftitular`) REFERENCES `tbtitular` (`idtitular`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_inv_ti` FOREIGN KEY (`reftipoinversion`) REFERENCES `tbtipoinversion` (`idtipoinversion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_inv_to` FOREIGN KEY (`reftipooperacion`) REFERENCES `tbtipooperacion` (`idtipooperacion`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `dbvehiculos`
--
ALTER TABLE `dbvehiculos`
  ADD CONSTRAINT `fk_v_cab` FOREIGN KEY (`refdeclaracionjuradacabecera`) REFERENCES `dbdeclaracionjuradacabecera` (`iddeclaracionjuradacabecera`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_v_fa` FOREIGN KEY (`refformaadquisicion`) REFERENCES `tbformaadquisicion` (`idformaadquisicion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_v_t` FOREIGN KEY (`reftitular`) REFERENCES `tbtitular` (`idtitular`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_v_tc` FOREIGN KEY (`reftipocesionario`) REFERENCES `tbtipocesionario` (`idtipocesionario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_v_to` FOREIGN KEY (`reftipooperacion`) REFERENCES `tbtipooperacion` (`idtipooperacion`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
