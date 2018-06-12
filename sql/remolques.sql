-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-06-2018 a las 01:27:38
-- Versión del servidor: 5.6.21
-- Versión de PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `remolques`
--

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

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
  `telefono` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `entidadfederativa` varchar(80) COLLATE utf8_spanish_ci DEFAULT NULL,
  `codigopostal` varchar(12) COLLATE utf8_spanish_ci DEFAULT NULL,
  `lada` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  `sexo` int(11) NOT NULL,
  `estudios` varchar(120) COLLATE utf8_spanish_ci DEFAULT NULL,
  `cedulaprofesional` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `refusuarios` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `dbdeclaracionjuradacabecera`
--

INSERT INTO `dbdeclaracionjuradacabecera` (`iddeclaracionjuradacabecera`, `fecharecepcion`, `primerapellido`, `segundoapellido`, `nombres`, `curp`, `homoclave`, `emailinstitucional`, `emailalterno`, `refestadocivil`, `refregimenmatrimonial`, `paisnacimiento`, `nacionalidad`, `entidadnacimiento`, `numerocelular`, `lugarubica`, `domicilioparticular`, `localidad`, `municipio`, `telefono`, `entidadfederativa`, `codigopostal`, `lada`, `sexo`, `estudios`, `cedulaprofesional`, `refusuarios`) VALUES
(1, '2018-06-06', 'safar', 'asdas', 'asdasd', '3423d23d', 'd23d3', 'sdasd', 'asdasd', 1, 1, 'asdasd', 'asdas', 'asdasd', 'asdasd', 1, 'asdas', 'asdasd', 'asdasd', 'asdasd', 'asdas', 'asdas', 'asdas', 2, 'asdasd', '', 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

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
  `enadeudos` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

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
(1, 10008, 'ALVAREZ GARCIA', NULL, NULL, NULL, 'AAGL690917MMSLRC09', 'AAGL6909171G7', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'CN20141', 'vanne', 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `predio_menu`
--

INSERT INTO `predio_menu` (`idmenu`, `url`, `icono`, `nombre`, `Orden`, `hover`, `permiso`) VALUES
(1, '../index.php', 'icodashboard', 'Dashboard', 1, NULL, 'Administrador, Usuario'),
(8, '../logout.php', 'icosalir', 'Salir', 30, NULL, 'Administrador, Usuario'),
(18, '../declaracionjurada/', 'icousuarios', 'Declaraciones', 2, NULL, 'Administrador, Usuario'),
(30, '../usuarios/', 'icousuarios', 'Usuarios', 14, NULL, 'Administrador'),
(31, '../estadocivil/', 'icoconfiguracion', 'Estado Civil', 15, NULL, 'Administrador'),
(32, '../regimenmatrimonial/', 'icoconfiguracion', 'Regimen Matrimonial', 16, NULL, 'Administrador'),
(33, '../poder/', 'icoconfiguracion', 'Poder', 17, NULL, 'Administrador'),
(34, '../tipoparentesco/', 'icoconfiguracion', 'Tipo Parentesco', 18, NULL, 'Administrador');

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

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `dbarchivos`
--
ALTER TABLE `dbarchivos`
 ADD PRIMARY KEY (`idarchivo`);

--
-- Indices de la tabla `dbdeclaracionanualinteres`
--
ALTER TABLE `dbdeclaracionanualinteres`
 ADD PRIMARY KEY (`iddeclaracionanualinteres`), ADD KEY `fk_di_p_idx` (`refpoder`);

--
-- Indices de la tabla `dbdeclaracionjuradacabecera`
--
ALTER TABLE `dbdeclaracionjuradacabecera`
 ADD PRIMARY KEY (`iddeclaracionjuradacabecera`), ADD KEY `fk_ddjj_estadocivil_idx` (`refestadocivil`), ADD KEY `fk_ddjj_regimen_idx` (`refregimenmatrimonial`), ADD KEY `fk_ddjj_usuarios_idx` (`refusuarios`);

--
-- Indices de la tabla `dbdependienteseconomicos`
--
ALTER TABLE `dbdependienteseconomicos`
 ADD PRIMARY KEY (`iddependienteeconomico`), ADD KEY `fk_de_tp_idx` (`reftipoparentesco`), ADD KEY `fk_de_dp_idx` (`refdeclaracionjuradacabecera`);

--
-- Indices de la tabla `dbingresosanuales`
--
ALTER TABLE `dbingresosanuales`
 ADD PRIMARY KEY (`idingresoanual`);

--
-- Indices de la tabla `dbpublicacion`
--
ALTER TABLE `dbpublicacion`
 ADD PRIMARY KEY (`idpublicacion`);

--
-- Indices de la tabla `dbusuarios`
--
ALTER TABLE `dbusuarios`
 ADD PRIMARY KEY (`idusuario`), ADD KEY `fk_dbusuarios_tbroles1_idx` (`refroles`);

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
-- Indices de la tabla `tbroles`
--
ALTER TABLE `tbroles`
 ADD PRIMARY KEY (`idrol`);

--
-- Indices de la tabla `tbtipoparentesco`
--
ALTER TABLE `tbtipoparentesco`
 ADD PRIMARY KEY (`idtipoparentesco`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `dbarchivos`
--
ALTER TABLE `dbarchivos`
MODIFY `idarchivo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `dbdeclaracionanualinteres`
--
ALTER TABLE `dbdeclaracionanualinteres`
MODIFY `iddeclaracionanualinteres` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `dbdeclaracionjuradacabecera`
--
ALTER TABLE `dbdeclaracionjuradacabecera`
MODIFY `iddeclaracionjuradacabecera` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `dbdependienteseconomicos`
--
ALTER TABLE `dbdependienteseconomicos`
MODIFY `iddependienteeconomico` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `dbingresosanuales`
--
ALTER TABLE `dbingresosanuales`
MODIFY `idingresoanual` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `dbpublicacion`
--
ALTER TABLE `dbpublicacion`
MODIFY `idpublicacion` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `dbusuarios`
--
ALTER TABLE `dbusuarios`
MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
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
MODIFY `idmenu` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT de la tabla `tbestadocivil`
--
ALTER TABLE `tbestadocivil`
MODIFY `idestadocivil` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
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
-- AUTO_INCREMENT de la tabla `tbroles`
--
ALTER TABLE `tbroles`
MODIFY `idrol` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `tbtipoparentesco`
--
ALTER TABLE `tbtipoparentesco`
MODIFY `idtipoparentesco` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- Restricciones para tablas volcadas
--

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
ADD CONSTRAINT `fk_ddjj_regimen` FOREIGN KEY (`refregimenmatrimonial`) REFERENCES `tbregimenmatrimonial` (`idregimenmatrimonial`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_ddjj_usuarios` FOREIGN KEY (`refusuarios`) REFERENCES `dbusuarios` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `dbdependienteseconomicos`
--
ALTER TABLE `dbdependienteseconomicos`
ADD CONSTRAINT `fk_de_dp` FOREIGN KEY (`refdeclaracionjuradacabecera`) REFERENCES `dbdeclaracionjuradacabecera` (`iddeclaracionjuradacabecera`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_de_tp` FOREIGN KEY (`reftipoparentesco`) REFERENCES `tbtipoparentesco` (`idtipoparentesco`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
