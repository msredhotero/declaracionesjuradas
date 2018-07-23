-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-07-2018 a las 23:48:37
-- Versión del servidor: 5.6.21
-- Versión de PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Estructura de tabla para la tabla `dbadeudos`
--

CREATE TABLE IF NOT EXISTS `dbadeudos` (
`idadeudo` int(11) NOT NULL,
  `refdeclaracionjuradacabecera` int(11) NOT NULL,
  `reftipooperacion` int(11) NOT NULL,
  `reftipoadeudo` int(11) NOT NULL,
  `numerocuenta` varchar(22) COLLATE utf8_spanish_ci NOT NULL,
  `donde` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `razonsocial` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `pais` varchar(40) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fechaotorgamiento` date NOT NULL,
  `montooritginal` decimal(18,2) NOT NULL DEFAULT '0.00',
  `tipomoneda` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `montopagos` decimal(18,2) NOT NULL DEFAULT '0.00',
  `saldo` decimal(18,2) NOT NULL DEFAULT '0.00',
  `tipomonedasaldo` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `reftitular` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `dbadeudos`
--

INSERT INTO `dbadeudos` (`idadeudo`, `refdeclaracionjuradacabecera`, `reftipooperacion`, `reftipoadeudo`, `numerocuenta`, `donde`, `razonsocial`, `pais`, `fechaotorgamiento`, `montooritginal`, `tipomoneda`, `montopagos`, `saldo`, `tipomonedasaldo`, `reftitular`) VALUES
(2, 1, 1, 1, 'asd324234asd', 'Mexico', 'asdasdqwdw', '', '2018-02-16', '850420.00', 'pesos mexicanos', '800000.00', '50420.00', 'pesos mexicanos', 1),
(3, 1, 2, 2, 'a9s8d49a', 'Mexico', 'asdasd', '', '2010-07-14', '15000.00', 'usd', '10000.00', '5000.00', 'usd', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbarchivos`
--

CREATE TABLE IF NOT EXISTS `dbarchivos` (
`idarchivo` int(11) NOT NULL,
  `refclientes` int(11) NOT NULL,
  `token` varchar(36) NOT NULL,
  `type` varchar(45) DEFAULT NULL,
  `observacion` varchar(150) DEFAULT NULL,
  `imagen` varchar(149) DEFAULT NULL,
  `fechacreacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbbienesinmuebles`
--

CREATE TABLE IF NOT EXISTS `dbbienesinmuebles` (
`idbieninmueble` int(11) NOT NULL,
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
  `especificacionventa` varchar(160) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

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
`idbienmueble` int(11) NOT NULL,
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
  `especificacionventa` varchar(160) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `dbbienesmuebles`
--

INSERT INTO `dbbienesmuebles` (`idbienmueble`, `refdeclaracionjuradacabecera`, `reftipooperacion`, `reftipobien`, `descripcion`, `refformaadquisicion`, `cesionario`, `reftipocesionario`, `otrotipocesionario`, `valor`, `tipomoneda`, `fechaadquisicion`, `reftitular`, `especificacionventa`) VALUES
(1, 1, 2, 3, 'Casa chalet', 4, 'Perez Jose', 1, '', 1500600, 'pesos mexicanos', '2010-02-13', 1, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbconflictoeconomica`
--

CREATE TABLE IF NOT EXISTS `dbconflictoeconomica` (
`idconflictoeconomica` int(11) NOT NULL,
  `refdeclaracionjuradacabecera` int(11) NOT NULL,
  `reftipooperacion` int(11) NOT NULL,
  `refresponsables` int(11) NOT NULL,
  `descripcion` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `fecha` date NOT NULL,
  `inscripcion` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `sector` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `reftiposociedad` int(11) NOT NULL,
  `refparticipacion` int(11) DEFAULT NULL,
  `especifica` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `antiguedad` varchar(5) COLLATE utf8_spanish_ci NOT NULL,
  `refinicioparticipacion` int(11) NOT NULL,
  `ubicacion` varchar(120) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbconflictopuestos`
--

CREATE TABLE IF NOT EXISTS `dbconflictopuestos` (
`idconflictopuesto` int(11) NOT NULL,
  `refdeclaracionjuradacabecera` int(11) NOT NULL,
  `reftipooperacion` int(11) NOT NULL,
  `refresponsables` int(11) NOT NULL,
  `descripcion` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `refvinculos` int(11) NOT NULL,
  `antiguedad` int(11) NOT NULL,
  `reffrecuenciaanual` int(11) NOT NULL,
  `refparticipacion` int(11) DEFAULT NULL,
  `reftipopersonajuridica` int(11) NOT NULL,
  `reftipocolaboracion` int(11) NOT NULL,
  `ubicacion` varchar(120) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbdeclaracionanualinteres`
--

CREATE TABLE IF NOT EXISTS `dbdeclaracionanualinteres` (
`iddeclaracionanualinteres` int(11) NOT NULL,
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
  `dependenciaanterior` varchar(120) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

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
`iddeclaracionjuradacabecera` int(11) NOT NULL,
  `fecharecepcion` date NOT NULL,
  `primerapellido` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `segundoapellido` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `nombres` varchar(120) COLLATE utf8_spanish_ci NOT NULL,
  `curp` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `homoclave` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `rfc` varchar(3) COLLATE utf8_spanish_ci DEFAULT NULL,
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
  `entidadfederativa` varchar(80) COLLATE utf8_spanish_ci DEFAULT NULL,
  `lada` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefono` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `codigopostal` varchar(12) COLLATE utf8_spanish_ci DEFAULT NULL,
  `sexo` int(11) NOT NULL,
  `estudios` varchar(120) COLLATE utf8_spanish_ci DEFAULT NULL,
  `cedulaprofesional` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `refusuarios` int(11) NOT NULL,
  `refestados` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `dbdeclaracionjuradacabecera`
--

INSERT INTO `dbdeclaracionjuradacabecera` (`iddeclaracionjuradacabecera`, `fecharecepcion`, `primerapellido`, `segundoapellido`, `nombres`, `curp`, `homoclave`, `rfc`, `emailinstitucional`, `emailalterno`, `refestadocivil`, `refregimenmatrimonial`, `paisnacimiento`, `nacionalidad`, `entidadnacimiento`, `numerocelular`, `lugarubica`, `domicilioparticular`, `localidad`, `municipio`, `entidadfederativa`, `lada`, `telefono`, `codigopostal`, `sexo`, `estudios`, `cedulaprofesional`, `refusuarios`, `refestados`) VALUES
(1, '2018-06-06', 'safar', 'asdas', 'asdasd', 'AAGL690917MMSLRC09', 'd23d3', NULL, 'sdasd', 'asdasd', 1, 1, 'asdasd', 'asdas', 'asdasd', 'asdasd', 1, 'asdas', 'asdasd', 'asdasd', 'asdas', 'asdas', 'asdasd', 'asdas', 2, 'asdasd', '', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbdecrementos`
--

CREATE TABLE IF NOT EXISTS `dbdecrementos` (
`iddecremento` int(11) NOT NULL,
  `refdeclaracionjuradacabecera` int(11) NOT NULL,
  `donaciones` decimal(18,2) NOT NULL DEFAULT '0.00',
  `robo` decimal(18,2) NOT NULL DEFAULT '0.00',
  `siniestros` decimal(18,2) NOT NULL DEFAULT '0.00',
  `otros` decimal(18,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `dbdecrementos`
--

INSERT INTO `dbdecrementos` (`iddecremento`, `refdeclaracionjuradacabecera`, `donaciones`, `robo`, `siniestros`, `otros`) VALUES
(1, 1, '15000.00', '1000.00', '2000.00', '3000.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbdependienteseconomicos`
--

CREATE TABLE IF NOT EXISTS `dbdependienteseconomicos` (
`iddependienteeconomico` int(11) NOT NULL,
  `refdeclaracionjuradacabecera` int(11) NOT NULL,
  `tiene` bit(1) NOT NULL DEFAULT b'0',
  `nombre` varchar(120) COLLATE utf8_spanish_ci NOT NULL,
  `edad` int(11) NOT NULL,
  `reftipoparentesco` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

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
`idingresoanual` int(11) NOT NULL,
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
  `vigenciahasta` date DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

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
`idinversion` int(11) NOT NULL,
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
  `especifica` varchar(80) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `dbinversiones`
--

INSERT INTO `dbinversiones` (`idinversion`, `refdeclaracionjuradacabecera`, `reftipooperacion`, `reftitular`, `numerocuenta`, `donde`, `razonsocial`, `pais`, `saldo`, `tipomoneda`, `reftipoinversion`, `especifica`) VALUES
(1, 1, 1, 1, '465asd', 'Extrangero', 'moorr', 'Bolivia', 1587943, 'usd', 1, 'hoteles');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbobservaciones`
--

CREATE TABLE IF NOT EXISTS `dbobservaciones` (
`idobservacion` int(11) NOT NULL,
  `refdeclaracionjuradacabecera` int(11) NOT NULL,
  `observacion` varchar(300) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `dbobservaciones`
--

INSERT INTO `dbobservaciones` (`idobservacion`, `refdeclaracionjuradacabecera`, `observacion`) VALUES
(3, 1, 'asdasd asda');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbpublicacion`
--

CREATE TABLE IF NOT EXISTS `dbpublicacion` (
`idpublicacion` int(11) NOT NULL,
  `refdeclaracionjuradacabecera` int(11) NOT NULL,
  `estadeacuerdo` bit(1) NOT NULL DEFAULT b'0',
  `eningresosnetos` bit(1) NOT NULL DEFAULT b'0',
  `enbienesinmuebles` bit(1) NOT NULL DEFAULT b'0',
  `enbienesmuebles` bit(1) NOT NULL DEFAULT b'0',
  `envehiculos` bit(1) NOT NULL DEFAULT b'0',
  `eninversiones` bit(1) NOT NULL DEFAULT b'0',
  `enadeudos` bit(1) NOT NULL DEFAULT b'0',
  `enconflictos` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `dbpublicacion`
--

INSERT INTO `dbpublicacion` (`idpublicacion`, `refdeclaracionjuradacabecera`, `estadeacuerdo`, `eningresosnetos`, `enbienesinmuebles`, `enbienesmuebles`, `envehiculos`, `eninversiones`, `enadeudos`, `enconflictos`) VALUES
(6, 1, b'1', b'1', b'1', b'0', b'0', b'0', b'0', b'0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbrecursos`
--

CREATE TABLE IF NOT EXISTS `dbrecursos` (
`idrecurso` int(11) NOT NULL,
  `refdeclaracionjuradacabecera` int(11) NOT NULL,
  `pagos` decimal(18,2) NOT NULL DEFAULT '0.00',
  `otros` decimal(18,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `dbrecursos`
--

INSERT INTO `dbrecursos` (`idrecurso`, `refdeclaracionjuradacabecera`, `pagos`, `otros`) VALUES
(2, 1, '15000.00', '5000.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbusuarios`
--

CREATE TABLE IF NOT EXISTS `dbusuarios` (
`idusuario` int(11) NOT NULL,
  `usuario` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `refroles` int(11) NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `nombrecompleto` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `activo` bit(1) DEFAULT b'0'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
`idvehiculos` int(11) NOT NULL,
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
  `especificacionsiniestro` varchar(160) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

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
`idfoto` int(11) NOT NULL,
  `refproyecto` int(11) NOT NULL,
  `refuser` int(11) NOT NULL,
  `imagen` varchar(149) DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL,
  `principal` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `loginreal`
--

CREATE TABLE IF NOT EXISTS `loginreal` (
`idloginreal` int(11) NOT NULL,
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
  `id_perfil` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `loginreal`
--

INSERT INTO `loginreal` (`idloginreal`, `empleado_id`, `nombre`, `paterno`, `materno`, `sexo`, `curp`, `rfc`, `id_identificacion`, `expide_ident`, `no_ident`, `edad`, `telefono`, `celular`, `email`, `domicilio_lab`, `domicilio_entrega`, `domicilio_particular`, `departamento_id`, `puesto_id`, `fecha_inicio`, `fecha_fin`, `fecha_entraga`, `clasificacion`, `pass_user`, `id_perfil`) VALUES
(1, 10008, 'VANNESA', 'ALVAREZ', 'GARCIA', NULL, 'AAGL690917MMSLRC09', 'AAGL6909171G7', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'CN20141', 'vanne', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `predio_menu`
--

CREATE TABLE IF NOT EXISTS `predio_menu` (
`idmenu` int(11) NOT NULL,
  `url` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `icono` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `Orden` smallint(6) DEFAULT NULL,
  `hover` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `permiso` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `predio_menu`
--

INSERT INTO `predio_menu` (`idmenu`, `url`, `icono`, `nombre`, `Orden`, `hover`, `permiso`) VALUES
(1, '../index.php', 'icodashboard', 'Dashboard', 1, NULL, 'Administrador, Usuario'),
(8, '../logout.php', 'icosalir', 'Salir', 99, NULL, 'Administrador, Usuario'),
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
(46, '../bienesmuebles/', 'icoconfiguracion', 'Bienes Muebles', 7, NULL, 'Administrador'),
(47, '../adeudos/', 'icoconfiguracion', 'Adeudos', 26, NULL, 'Administrador'),
(48, '../inversiones/', 'icoconfiguracion', 'Inversiones', 27, NULL, 'Administrador'),
(49, '../bienesinmuebles/', 'icoconfiguracion', 'Bienes Inmuebles', 28, NULL, 'Administrador'),
(50, '../vehiculos/', 'icoconfiguracion', 'Vehiculos', 29, NULL, 'Administrador'),
(51, '../tipoadeudo/', 'icoconfiguracion', 'Tipo Adeudo', 35, NULL, 'Administrador'),
(52, '../frecuenciaanual/', 'icoconfiguracion', 'Frecuencia Anual', 36, NULL, 'Administrador'),
(53, '../inicioparticipacion/', 'icoconfiguracion', 'Inicio de Participacion', 37, NULL, 'Administrador'),
(54, '../participacion/', 'icoconfiguracion', 'Participacion', 38, NULL, 'Administrador'),
(55, '../responsables/', 'icoconfiguracion', 'Responsables', 39, NULL, 'Administrador'),
(56, '../tipocolaboracion/', 'icoconfiguracion', 'Tipo Colaboracion', 40, NULL, 'Administrador'),
(57, '../tipopersonajuridica/', 'icoconfiguracion', 'Tipo Persona Juridica', 41, NULL, 'Administrador'),
(58, '../tiposociedad/', 'icoconfiguracion', 'Tipo Sociedad', 42, NULL, 'Administrador'),
(59, '../vinculos/', 'icoconfiguracion', 'Vinculos', 43, NULL, 'Administrador'),
(60, '../conflictoseconomicos/', 'icoconfiguracion', 'Conflictos Economicos', 10, NULL, 'Administrador'),
(61, '../conflictospuestos/', 'icoconfiguracion', 'Conflictos por Cargo', 11, NULL, 'Administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbestadocivil`
--

CREATE TABLE IF NOT EXISTS `tbestadocivil` (
`idestadocivil` int(11) NOT NULL,
  `estadocivil` varchar(60) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

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
`idestado` int(11) NOT NULL,
  `estado` varchar(45) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tbestados`
--

INSERT INTO `tbestados` (`idestado`, `estado`) VALUES
(1, 'Iniciado'),
(2, 'Finalizado'),
(3, 'Eliminada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbformaadquisicion`
--

CREATE TABLE IF NOT EXISTS `tbformaadquisicion` (
`idformaadquisicion` int(11) NOT NULL,
  `formaadquisicion` varchar(80) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

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
-- Estructura de tabla para la tabla `tbfrecuenciaanual`
--

CREATE TABLE IF NOT EXISTS `tbfrecuenciaanual` (
`idfrecuenciaanual` int(11) NOT NULL,
  `descripcion` varchar(80) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tbfrecuenciaanual`
--

INSERT INTO `tbfrecuenciaanual` (`idfrecuenciaanual`, `descripcion`) VALUES
(1, '5 meses');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbinicioparticipacion`
--

CREATE TABLE IF NOT EXISTS `tbinicioparticipacion` (
`idinicioparticipacion` int(11) NOT NULL,
  `descripcion` varchar(80) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tbinicioparticipacion`
--

INSERT INTO `tbinicioparticipacion` (`idinicioparticipacion`, `descripcion`) VALUES
(1, 'Principio de mes 2018');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbotrotipobien`
--

CREATE TABLE IF NOT EXISTS `tbotrotipobien` (
`idotrotipobien` int(11) NOT NULL,
  `otrotipobien` varchar(80) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tbotrotipobien`
--

INSERT INTO `tbotrotipobien` (`idotrotipobien`, `otrotipobien`) VALUES
(1, 'Ampliacion'),
(2, 'Construccion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbparticipacion`
--

CREATE TABLE IF NOT EXISTS `tbparticipacion` (
`idparticipacion` int(11) NOT NULL,
  `descripcion` varchar(80) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tbparticipacion`
--

INSERT INTO `tbparticipacion` (`idparticipacion`, `descripcion`) VALUES
(1, 'Todas-os');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbpoder`
--

CREATE TABLE IF NOT EXISTS `tbpoder` (
`idpoder` int(11) NOT NULL,
  `poder` varchar(60) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

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
`idregimenmatrimonial` int(11) NOT NULL,
  `regimenmatrimonial` varchar(60) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tbregimenmatrimonial`
--

INSERT INTO `tbregimenmatrimonial` (`idregimenmatrimonial`, `regimenmatrimonial`) VALUES
(1, 'Sociedad Conyugal');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbresponsables`
--

CREATE TABLE IF NOT EXISTS `tbresponsables` (
`idresponsable` int(11) NOT NULL,
  `descripcion` varchar(80) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tbresponsables`
--

INSERT INTO `tbresponsables` (`idresponsable`, `descripcion`) VALUES
(1, 'Padres e hijos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbroles`
--

CREATE TABLE IF NOT EXISTS `tbroles` (
`idrol` int(11) NOT NULL,
  `descripcion` varchar(45) NOT NULL,
  `activo` bit(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbroles`
--

INSERT INTO `tbroles` (`idrol`, `descripcion`, `activo`) VALUES
(1, 'Administrador', b'1'),
(2, 'Usuario', b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbtipoadeudo`
--

CREATE TABLE IF NOT EXISTS `tbtipoadeudo` (
`idtipoadeudo` int(11) NOT NULL,
  `tipoadeudo` varchar(45) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tbtipoadeudo`
--

INSERT INTO `tbtipoadeudo` (`idtipoadeudo`, `tipoadeudo`) VALUES
(1, 'Compras a credito'),
(2, 'Tarjeta de credito');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbtipobien`
--

CREATE TABLE IF NOT EXISTS `tbtipobien` (
`idtipobien` int(11) NOT NULL,
  `tipobien` varchar(80) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

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
`idtipocesionario` int(11) NOT NULL,
  `tipocesionario` varchar(80) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tbtipocesionario`
--

INSERT INTO `tbtipocesionario` (`idtipocesionario`, `tipocesionario`) VALUES
(1, 'Abuelo'),
(2, 'Primo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbtipocolaboracion`
--

CREATE TABLE IF NOT EXISTS `tbtipocolaboracion` (
`idtipocolaboracion` int(11) NOT NULL,
  `descripcion` varchar(80) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tbtipocolaboracion`
--

INSERT INTO `tbtipocolaboracion` (`idtipocolaboracion`, `descripcion`) VALUES
(1, 'Completa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbtipoinversion`
--

CREATE TABLE IF NOT EXISTS `tbtipoinversion` (
`idtipoinversion` int(11) NOT NULL,
  `tipoinversion` varchar(80) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

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
`idtipooperacion` int(11) NOT NULL,
  `tipooperacion` varchar(80) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

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
`idtipoparentesco` int(11) NOT NULL,
  `tipoparentesco` varchar(120) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tbtipoparentesco`
--

INSERT INTO `tbtipoparentesco` (`idtipoparentesco`, `tipoparentesco`) VALUES
(1, 'Padre');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbtipopersonajuridica`
--

CREATE TABLE IF NOT EXISTS `tbtipopersonajuridica` (
`idtipopersonajuridica` int(11) NOT NULL,
  `descripcion` varchar(80) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tbtipopersonajuridica`
--

INSERT INTO `tbtipopersonajuridica` (`idtipopersonajuridica`, `descripcion`) VALUES
(1, 'Sociedad anonima');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbtiposociedad`
--

CREATE TABLE IF NOT EXISTS `tbtiposociedad` (
`idtiposociedad` int(11) NOT NULL,
  `descripcion` varchar(80) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tbtiposociedad`
--

INSERT INTO `tbtiposociedad` (`idtiposociedad`, `descripcion`) VALUES
(1, 'Anonimas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbtitular`
--

CREATE TABLE IF NOT EXISTS `tbtitular` (
`idtitular` int(11) NOT NULL,
  `titular` varchar(80) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tbtitular`
--

INSERT INTO `tbtitular` (`idtitular`, `titular`) VALUES
(1, ''),
(2, 'Conyuge');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbvinculos`
--

CREATE TABLE IF NOT EXISTS `tbvinculos` (
`idvinculo` int(11) NOT NULL,
  `descripcion` varchar(80) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tbvinculos`
--

INSERT INTO `tbvinculos` (`idvinculo`, `descripcion`) VALUES
(1, 'Hija');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `dbadeudos`
--
ALTER TABLE `dbadeudos`
 ADD PRIMARY KEY (`idadeudo`), ADD KEY `fk_adeu_cab_idx` (`refdeclaracionjuradacabecera`), ADD KEY `fk_adeu_to_idx` (`reftipooperacion`), ADD KEY `fk_adeu_t_idx` (`reftitular`), ADD KEY `fk_adeu_ta_idx` (`reftipoadeudo`);

--
-- Indices de la tabla `dbarchivos`
--
ALTER TABLE `dbarchivos`
 ADD PRIMARY KEY (`idarchivo`);

--
-- Indices de la tabla `dbbienesinmuebles`
--
ALTER TABLE `dbbienesinmuebles`
 ADD PRIMARY KEY (`idbieninmueble`), ADD KEY `fk_bi_to_idx` (`reftipooperacion`), ADD KEY `fk_bi_tb_idx` (`reftipobien`), ADD KEY `fk_bi_fa_idx` (`refformaadquisicion`), ADD KEY `fk_bi_otb_idx` (`refotrotipobien`), ADD KEY `fk_bi_t_idx` (`reftitular`), ADD KEY `fk_bi_tc_idx` (`reftipocesionario`), ADD KEY `fk_bi_cab_idx` (`refdeclaracionjuradacabecera`);

--
-- Indices de la tabla `dbbienesmuebles`
--
ALTER TABLE `dbbienesmuebles`
 ADD PRIMARY KEY (`idbienmueble`), ADD KEY `fk_bm_to_idx` (`reftipooperacion`), ADD KEY `fk_bm_tb_idx` (`reftipobien`), ADD KEY `fk_bm_fa_idx` (`refformaadquisicion`), ADD KEY `fk_bm_tc_idx` (`reftipocesionario`), ADD KEY `fk_bm_t_idx` (`reftitular`), ADD KEY `fk_bm_cab_idx` (`refdeclaracionjuradacabecera`);

--
-- Indices de la tabla `dbconflictoeconomica`
--
ALTER TABLE `dbconflictoeconomica`
 ADD PRIMARY KEY (`idconflictoeconomica`), ADD KEY `fk_cie_cab_idx` (`refdeclaracionjuradacabecera`), ADD KEY `fk_cie_to_idx` (`reftipooperacion`), ADD KEY `fk_ci_res_idx` (`refresponsables`), ADD KEY `fk_ci_ts_idx` (`reftiposociedad`), ADD KEY `fk_ci_p_idx` (`refparticipacion`), ADD KEY `fk_ci_i_idx` (`refinicioparticipacion`);

--
-- Indices de la tabla `dbconflictopuestos`
--
ALTER TABLE `dbconflictopuestos`
 ADD PRIMARY KEY (`idconflictopuesto`), ADD KEY `fk_ci_cab_idx` (`refdeclaracionjuradacabecera`), ADD KEY `fk_ci_to_idx` (`reftipooperacion`), ADD KEY `fk_ci_r_idx` (`refresponsables`), ADD KEY `fk_ci_v_idx` (`refvinculos`), ADD KEY `fk_ci_fre_idx` (`reffrecuenciaanual`), ADD KEY `fk_ci_par_idx` (`refparticipacion`), ADD KEY `fk_ci_perso_idx` (`reftipopersonajuridica`), ADD KEY `fk_ci_col_idx` (`reftipocolaboracion`);

--
-- Indices de la tabla `dbdeclaracionanualinteres`
--
ALTER TABLE `dbdeclaracionanualinteres`
 ADD PRIMARY KEY (`iddeclaracionanualinteres`), ADD KEY `fk_di_p_idx` (`refpoder`);

--
-- Indices de la tabla `dbdeclaracionjuradacabecera`
--
ALTER TABLE `dbdeclaracionjuradacabecera`
 ADD PRIMARY KEY (`iddeclaracionjuradacabecera`), ADD KEY `fk_ddjj_estadocivil_idx` (`refestadocivil`), ADD KEY `fk_ddjj_regimen_idx` (`refregimenmatrimonial`), ADD KEY `fk_ddjj_usuarios_idx` (`refusuarios`), ADD KEY `fk_ddjj_estados_idx` (`refestados`);

--
-- Indices de la tabla `dbdecrementos`
--
ALTER TABLE `dbdecrementos`
 ADD PRIMARY KEY (`iddecremento`), ADD KEY `fk_decrementos_cab_idx` (`refdeclaracionjuradacabecera`);

--
-- Indices de la tabla `dbdependienteseconomicos`
--
ALTER TABLE `dbdependienteseconomicos`
 ADD PRIMARY KEY (`iddependienteeconomico`), ADD KEY `fk_de_tp_idx` (`reftipoparentesco`), ADD KEY `fk_de_dp_idx` (`refdeclaracionjuradacabecera`);

--
-- Indices de la tabla `dbingresosanuales`
--
ALTER TABLE `dbingresosanuales`
 ADD PRIMARY KEY (`idingresoanual`), ADD KEY `fk_inganual_cab_idx` (`refdeclaracionjuradacabecera`);

--
-- Indices de la tabla `dbinversiones`
--
ALTER TABLE `dbinversiones`
 ADD PRIMARY KEY (`idinversion`), ADD KEY `fk_inv_cab_idx` (`refdeclaracionjuradacabecera`), ADD KEY `fk_inv_to_idx` (`reftipooperacion`), ADD KEY `fk_inv_t_idx` (`reftitular`), ADD KEY `fk_inv_ti_idx` (`reftipoinversion`);

--
-- Indices de la tabla `dbobservaciones`
--
ALTER TABLE `dbobservaciones`
 ADD PRIMARY KEY (`idobservacion`), ADD KEY `fk_obs_cab_idx` (`refdeclaracionjuradacabecera`);

--
-- Indices de la tabla `dbpublicacion`
--
ALTER TABLE `dbpublicacion`
 ADD PRIMARY KEY (`idpublicacion`);

--
-- Indices de la tabla `dbrecursos`
--
ALTER TABLE `dbrecursos`
 ADD PRIMARY KEY (`idrecurso`), ADD KEY `fk_recursos_cab_idx` (`refdeclaracionjuradacabecera`);

--
-- Indices de la tabla `dbusuarios`
--
ALTER TABLE `dbusuarios`
 ADD PRIMARY KEY (`idusuario`), ADD KEY `fk_dbusuarios_tbroles1_idx` (`refroles`);

--
-- Indices de la tabla `dbvehiculos`
--
ALTER TABLE `dbvehiculos`
 ADD PRIMARY KEY (`idvehiculos`), ADD KEY `fk_v_to_idx` (`reftipooperacion`), ADD KEY `fk_v_fa_idx` (`refformaadquisicion`), ADD KEY `fk_v_tc_idx` (`reftipocesionario`), ADD KEY `fk_v_t_idx` (`reftitular`), ADD KEY `fk_v_cab_idx` (`refdeclaracionjuradacabecera`);

--
-- Indices de la tabla `images`
--
ALTER TABLE `images`
 ADD PRIMARY KEY (`idfoto`);

--
-- Indices de la tabla `loginreal`
--
ALTER TABLE `loginreal`
 ADD PRIMARY KEY (`idloginreal`), ADD UNIQUE KEY `id_identificacion_UNIQUE` (`id_identificacion`);

--
-- Indices de la tabla `predio_menu`
--
ALTER TABLE `predio_menu`
 ADD PRIMARY KEY (`idmenu`);

--
-- Indices de la tabla `tbestadocivil`
--
ALTER TABLE `tbestadocivil`
 ADD PRIMARY KEY (`idestadocivil`);

--
-- Indices de la tabla `tbestados`
--
ALTER TABLE `tbestados`
 ADD PRIMARY KEY (`idestado`);

--
-- Indices de la tabla `tbformaadquisicion`
--
ALTER TABLE `tbformaadquisicion`
 ADD PRIMARY KEY (`idformaadquisicion`);

--
-- Indices de la tabla `tbfrecuenciaanual`
--
ALTER TABLE `tbfrecuenciaanual`
 ADD PRIMARY KEY (`idfrecuenciaanual`);

--
-- Indices de la tabla `tbinicioparticipacion`
--
ALTER TABLE `tbinicioparticipacion`
 ADD PRIMARY KEY (`idinicioparticipacion`);

--
-- Indices de la tabla `tbotrotipobien`
--
ALTER TABLE `tbotrotipobien`
 ADD PRIMARY KEY (`idotrotipobien`);

--
-- Indices de la tabla `tbparticipacion`
--
ALTER TABLE `tbparticipacion`
 ADD PRIMARY KEY (`idparticipacion`);

--
-- Indices de la tabla `tbpoder`
--
ALTER TABLE `tbpoder`
 ADD PRIMARY KEY (`idpoder`);

--
-- Indices de la tabla `tbregimenmatrimonial`
--
ALTER TABLE `tbregimenmatrimonial`
 ADD PRIMARY KEY (`idregimenmatrimonial`);

--
-- Indices de la tabla `tbresponsables`
--
ALTER TABLE `tbresponsables`
 ADD PRIMARY KEY (`idresponsable`);

--
-- Indices de la tabla `tbroles`
--
ALTER TABLE `tbroles`
 ADD PRIMARY KEY (`idrol`);

--
-- Indices de la tabla `tbtipoadeudo`
--
ALTER TABLE `tbtipoadeudo`
 ADD PRIMARY KEY (`idtipoadeudo`);

--
-- Indices de la tabla `tbtipobien`
--
ALTER TABLE `tbtipobien`
 ADD PRIMARY KEY (`idtipobien`);

--
-- Indices de la tabla `tbtipocesionario`
--
ALTER TABLE `tbtipocesionario`
 ADD PRIMARY KEY (`idtipocesionario`);

--
-- Indices de la tabla `tbtipocolaboracion`
--
ALTER TABLE `tbtipocolaboracion`
 ADD PRIMARY KEY (`idtipocolaboracion`);

--
-- Indices de la tabla `tbtipoinversion`
--
ALTER TABLE `tbtipoinversion`
 ADD PRIMARY KEY (`idtipoinversion`);

--
-- Indices de la tabla `tbtipooperacion`
--
ALTER TABLE `tbtipooperacion`
 ADD PRIMARY KEY (`idtipooperacion`);

--
-- Indices de la tabla `tbtipoparentesco`
--
ALTER TABLE `tbtipoparentesco`
 ADD PRIMARY KEY (`idtipoparentesco`);

--
-- Indices de la tabla `tbtipopersonajuridica`
--
ALTER TABLE `tbtipopersonajuridica`
 ADD PRIMARY KEY (`idtipopersonajuridica`);

--
-- Indices de la tabla `tbtiposociedad`
--
ALTER TABLE `tbtiposociedad`
 ADD PRIMARY KEY (`idtiposociedad`);

--
-- Indices de la tabla `tbtitular`
--
ALTER TABLE `tbtitular`
 ADD PRIMARY KEY (`idtitular`);

--
-- Indices de la tabla `tbvinculos`
--
ALTER TABLE `tbvinculos`
 ADD PRIMARY KEY (`idvinculo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `dbadeudos`
--
ALTER TABLE `dbadeudos`
MODIFY `idadeudo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `dbarchivos`
--
ALTER TABLE `dbarchivos`
MODIFY `idarchivo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `dbbienesinmuebles`
--
ALTER TABLE `dbbienesinmuebles`
MODIFY `idbieninmueble` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `dbbienesmuebles`
--
ALTER TABLE `dbbienesmuebles`
MODIFY `idbienmueble` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `dbconflictoeconomica`
--
ALTER TABLE `dbconflictoeconomica`
MODIFY `idconflictoeconomica` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `dbconflictopuestos`
--
ALTER TABLE `dbconflictopuestos`
MODIFY `idconflictopuesto` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `dbdeclaracionanualinteres`
--
ALTER TABLE `dbdeclaracionanualinteres`
MODIFY `iddeclaracionanualinteres` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `dbdeclaracionjuradacabecera`
--
ALTER TABLE `dbdeclaracionjuradacabecera`
MODIFY `iddeclaracionjuradacabecera` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `dbdecrementos`
--
ALTER TABLE `dbdecrementos`
MODIFY `iddecremento` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `dbdependienteseconomicos`
--
ALTER TABLE `dbdependienteseconomicos`
MODIFY `iddependienteeconomico` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `dbingresosanuales`
--
ALTER TABLE `dbingresosanuales`
MODIFY `idingresoanual` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `dbinversiones`
--
ALTER TABLE `dbinversiones`
MODIFY `idinversion` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `dbobservaciones`
--
ALTER TABLE `dbobservaciones`
MODIFY `idobservacion` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `dbpublicacion`
--
ALTER TABLE `dbpublicacion`
MODIFY `idpublicacion` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `dbrecursos`
--
ALTER TABLE `dbrecursos`
MODIFY `idrecurso` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `dbusuarios`
--
ALTER TABLE `dbusuarios`
MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `dbvehiculos`
--
ALTER TABLE `dbvehiculos`
MODIFY `idvehiculos` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `images`
--
ALTER TABLE `images`
MODIFY `idfoto` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `loginreal`
--
ALTER TABLE `loginreal`
MODIFY `idloginreal` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `predio_menu`
--
ALTER TABLE `predio_menu`
MODIFY `idmenu` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=62;
--
-- AUTO_INCREMENT de la tabla `tbestadocivil`
--
ALTER TABLE `tbestadocivil`
MODIFY `idestadocivil` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `tbestados`
--
ALTER TABLE `tbestados`
MODIFY `idestado` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `tbformaadquisicion`
--
ALTER TABLE `tbformaadquisicion`
MODIFY `idformaadquisicion` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `tbfrecuenciaanual`
--
ALTER TABLE `tbfrecuenciaanual`
MODIFY `idfrecuenciaanual` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `tbinicioparticipacion`
--
ALTER TABLE `tbinicioparticipacion`
MODIFY `idinicioparticipacion` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `tbotrotipobien`
--
ALTER TABLE `tbotrotipobien`
MODIFY `idotrotipobien` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `tbparticipacion`
--
ALTER TABLE `tbparticipacion`
MODIFY `idparticipacion` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `tbpoder`
--
ALTER TABLE `tbpoder`
MODIFY `idpoder` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `tbregimenmatrimonial`
--
ALTER TABLE `tbregimenmatrimonial`
MODIFY `idregimenmatrimonial` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `tbresponsables`
--
ALTER TABLE `tbresponsables`
MODIFY `idresponsable` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `tbroles`
--
ALTER TABLE `tbroles`
MODIFY `idrol` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `tbtipoadeudo`
--
ALTER TABLE `tbtipoadeudo`
MODIFY `idtipoadeudo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `tbtipobien`
--
ALTER TABLE `tbtipobien`
MODIFY `idtipobien` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `tbtipocesionario`
--
ALTER TABLE `tbtipocesionario`
MODIFY `idtipocesionario` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `tbtipocolaboracion`
--
ALTER TABLE `tbtipocolaboracion`
MODIFY `idtipocolaboracion` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `tbtipoinversion`
--
ALTER TABLE `tbtipoinversion`
MODIFY `idtipoinversion` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `tbtipooperacion`
--
ALTER TABLE `tbtipooperacion`
MODIFY `idtipooperacion` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `tbtipoparentesco`
--
ALTER TABLE `tbtipoparentesco`
MODIFY `idtipoparentesco` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `tbtipopersonajuridica`
--
ALTER TABLE `tbtipopersonajuridica`
MODIFY `idtipopersonajuridica` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `tbtiposociedad`
--
ALTER TABLE `tbtiposociedad`
MODIFY `idtiposociedad` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `tbtitular`
--
ALTER TABLE `tbtitular`
MODIFY `idtitular` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `tbvinculos`
--
ALTER TABLE `tbvinculos`
MODIFY `idvinculo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `dbadeudos`
--
ALTER TABLE `dbadeudos`
ADD CONSTRAINT `fk_adeu_cab` FOREIGN KEY (`refdeclaracionjuradacabecera`) REFERENCES `dbdeclaracionjuradacabecera` (`iddeclaracionjuradacabecera`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_adeu_t` FOREIGN KEY (`reftitular`) REFERENCES `tbtitular` (`idtitular`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_adeu_ta` FOREIGN KEY (`reftipoadeudo`) REFERENCES `tbtipoadeudo` (`idtipoadeudo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_adeu_to` FOREIGN KEY (`reftipooperacion`) REFERENCES `tbtipooperacion` (`idtipooperacion`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
-- Filtros para la tabla `dbconflictoeconomica`
--
ALTER TABLE `dbconflictoeconomica`
ADD CONSTRAINT `fk_ci_i` FOREIGN KEY (`refinicioparticipacion`) REFERENCES `tbinicioparticipacion` (`idinicioparticipacion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_ci_p` FOREIGN KEY (`refparticipacion`) REFERENCES `tbparticipacion` (`idparticipacion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_ci_res` FOREIGN KEY (`refresponsables`) REFERENCES `tbresponsables` (`idresponsable`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_ci_ts` FOREIGN KEY (`reftiposociedad`) REFERENCES `tbtiposociedad` (`idtiposociedad`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_cie_cab` FOREIGN KEY (`refdeclaracionjuradacabecera`) REFERENCES `dbdeclaracionjuradacabecera` (`iddeclaracionjuradacabecera`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_cie_to` FOREIGN KEY (`reftipooperacion`) REFERENCES `tbtipooperacion` (`idtipooperacion`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `dbconflictopuestos`
--
ALTER TABLE `dbconflictopuestos`
ADD CONSTRAINT `fk_ci_cab` FOREIGN KEY (`refdeclaracionjuradacabecera`) REFERENCES `dbdeclaracionjuradacabecera` (`iddeclaracionjuradacabecera`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_ci_col` FOREIGN KEY (`reftipocolaboracion`) REFERENCES `tbtipocolaboracion` (`idtipocolaboracion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_ci_fre` FOREIGN KEY (`reffrecuenciaanual`) REFERENCES `tbfrecuenciaanual` (`idfrecuenciaanual`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_ci_par` FOREIGN KEY (`refparticipacion`) REFERENCES `tbparticipacion` (`idparticipacion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_ci_perso` FOREIGN KEY (`reftipopersonajuridica`) REFERENCES `tbtipopersonajuridica` (`idtipopersonajuridica`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_ci_r` FOREIGN KEY (`refresponsables`) REFERENCES `tbresponsables` (`idresponsable`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_ci_to` FOREIGN KEY (`reftipooperacion`) REFERENCES `tbtipooperacion` (`idtipooperacion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_ci_v` FOREIGN KEY (`refvinculos`) REFERENCES `tbvinculos` (`idvinculo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `dbdeclaracionanualinteres`
--
ALTER TABLE `dbdeclaracionanualinteres`
ADD CONSTRAINT `fk_di_p` FOREIGN KEY (`refpoder`) REFERENCES `tbpoder` (`idpoder`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `dbdeclaracionjuradacabecera`
--
ALTER TABLE `dbdeclaracionjuradacabecera`
ADD CONSTRAINT `fk_ddjj_estadocivil` FOREIGN KEY (`refestadocivil`) REFERENCES `tbestadocivil` (`idestadocivil`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_ddjj_estados` FOREIGN KEY (`refestados`) REFERENCES `tbestados` (`idestado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_ddjj_regimen` FOREIGN KEY (`refregimenmatrimonial`) REFERENCES `tbregimenmatrimonial` (`idregimenmatrimonial`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_ddjj_usuarios` FOREIGN KEY (`refusuarios`) REFERENCES `dbusuarios` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `dbdecrementos`
--
ALTER TABLE `dbdecrementos`
ADD CONSTRAINT `fk_decrementos_cab` FOREIGN KEY (`refdeclaracionjuradacabecera`) REFERENCES `dbdeclaracionjuradacabecera` (`iddeclaracionjuradacabecera`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
-- Filtros para la tabla `dbobservaciones`
--
ALTER TABLE `dbobservaciones`
ADD CONSTRAINT `fk_obs_cab` FOREIGN KEY (`refdeclaracionjuradacabecera`) REFERENCES `dbdeclaracionjuradacabecera` (`iddeclaracionjuradacabecera`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `dbrecursos`
--
ALTER TABLE `dbrecursos`
ADD CONSTRAINT `fk_recursos_cab` FOREIGN KEY (`refdeclaracionjuradacabecera`) REFERENCES `dbdeclaracionjuradacabecera` (`iddeclaracionjuradacabecera`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
