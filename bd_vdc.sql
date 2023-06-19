-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-06-2023 a las 19:20:14
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
-- Base de datos: `bd_vdc`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `CALL SP_ELIMINAR_INSCRIPCION` (IN `ID` INT)   DELETE FROM inscripcion WHERE id_inscripcion=ID$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ELIMINAR_INSCRIPCION` (IN `ID` INT)   DELETE FROM inscripcion WHERE id_inscripcion=ID$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_HISTORIAL_ALUMNO` (IN `ID` INT)   SELECT 
pagos.pago_monto,
pagos.pago_descripcion,
pagos.pago_mes,
pagos.pago_fecha
FROM pagos
where id_matricula=ID$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_INTENTO_USUARIO` (IN `USUARIO` VARCHAR(20))   BEGIN
DECLARE INTENTO INT;
SET @INTENTO:=(SELECT usuari_intento FROM usuario where usuari_usuario = USUARIO);
if @INTENTO = 2 THEN
   SELECT @INTENTO;
ELSE 
	UPDATE usuario SET
    usuari_intento=@INTENTO+1
    WHERE usuari_usuario=USUARIO;
     SELECT @INTENTO;
END IF;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_ALUMNO` ()   SELECT
	alumno.id_alumno,
    alumno.alumno_dni,
	alumno.alumno_nacionalidad,
    alumno.alumno_nombre,
	alumno.alumno_genero,
    alumno.alumno_fecha_nacimiento, 
	alumno.alumno_ciudad, 
	alumno.alumno_direccion,
	alumno.alumno_estado
FROM
	alumno$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_APODERADO` ()   SELECT
	apoderado.id_apoderado,
    apoderado.apoderado_dni,
	apoderado.apoderado_nacionalidad,
    apoderado.apoderado_nombre,
	apoderado.apoderado_genero,
    apoderado.apoderado_fecha_nacimiento, 
	apoderado.apoderado_ciudad, 
	apoderado.apoderado_direccion,
    apoderado.apoderado_correo,
    apoderado.apoderado_telcel,
	apoderado.apoderado_estado
FROM
	apoderado$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_COD` ()   SELECT
    matricula.id_matricula,
    matricula.matric_code
FROM
	matricula$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_DNI` ()   SELECT
	alumno.id_alumno,
    alumno.alumno_dni,
    alumno.alumno_nombre
FROM
	alumno$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_DNI_APODERADO` ()   SELECT
    madre.madre_dni,
    madre.madre_nombre
FROM
	madre
UNION 
SELECT
    padre.padre_dni,
    padre.padre_nombre
FROM
	padre
UNION 
SELECT
    apoderado.apoder_dni,
    apoderado.apoder_nombre
FROM
	apoderado$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_GRADO` ()   SELECT * FROM grado$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_PAGO_BOLETA` ()   SELECT * FROM pagos$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_SELECT_ROL` ()   SELECT * FROM rol_usuario$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_USUARIO` ()   SELECT
	usuario.id_usuario, 
	usuario.usuari_nombre,
    usuario.usuari_apellidos,
	usuario.usuari_usuario,
    usuario.usuari_correo, 
	usuario.usuari_clave, 
	usuario.usuari_telefono,
	usuario.usuari_fecha,
    usuario.usuari_estado,
    usuario.usuari_rol,
    rol_usuario.rol_descripcion
FROM
	usuario
	INNER JOIN
	rol_usuario
	ON 
		usuario.usuari_rol = rol_usuario.id_rol$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MODIFICAR_ALUMNO` (IN `ID` INT, IN `NOMBRE` VARCHAR(45), IN `CIUDAD` VARCHAR(20), IN `DIRECCION` VARCHAR(50))   UPDATE alumno set
alumno_nombre=NOMBRE,
alumno_ciudad=CIUDAD,
alumno_direccion=DIRECCION
where id_alumno=ID$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MODIFICAR_ALUMNO_ESTATUS` (IN `ID` INT, IN `ESTATUS` VARCHAR(8))   UPDATE alumno set
alumno_estado=ESTATUS
where id_alumno=ID$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MODIFICAR_APODERADO` (IN `IDMADRE` INT, IN `NOMBREMADRE` VARCHAR(45), IN `FECHAMADRE` DATE, IN `CIUDADMADRE` VARCHAR(20), IN `DIRECCIONMADRE` VARCHAR(50), IN `CORREOMADRE` VARCHAR(30), IN `TELEFONOMADRE` VARCHAR(9), IN `IDPADRE` INT, IN `NOMBREPADRE` VARCHAR(45), IN `FECHAPADRE` DATE, IN `CIUDADPADRE` VARCHAR(20), IN `DIRECCIONPADRE` VARCHAR(50), IN `CORREOPADRE` VARCHAR(30), IN `TELEFONOPADRE` VARCHAR(9), IN `IDAPODER` INT, IN `DNIAPODER` VARCHAR(15), IN `NOMBREAPODER` VARCHAR(45), IN `PARENTESCOAPODER` VARCHAR(10), IN `FECHAAPODER` DATE, IN `CIUDADAPODER` VARCHAR(20), IN `DIRECCIONAPODER` VARCHAR(50), IN `CORREOAPODER` VARCHAR(30), IN `TELEFONOAPODER` VARCHAR(9))   BEGIN
UPDATE madre set
madre_nombre=NOMBREMADRE,
madre_fecha=FECHAMADRE,
madre_ciudad=CIUDADMADRE,
madre_direccion=DIRECCIONMADRE,
madre_correo=CORREOMADRE,
madre_telcel=TELEFONOMADRE
where id_madre=IDMADRE;
UPDATE padre set
padre_nombre=NOMBREPADRE,
padre_fecha=FECHAPADRE,
padre_ciudad=CIUDADPADRE,
padre_direccion=DIRECCIONPADRE,
padre_correo=CORREOPADRE,
padre_telcel=TELEFONOPADRE
where id_padre=IDPADRE;
UPDATE apoderado set
apoder_dni=DNIAPODER,
apoder_nombre=NOMBREAPODER,
apoder_parentesco=PARENTESCOAPODER,
apoder_fecha=FECHAAPODER,
apoder_ciudad=CIUDADAPODER,
apoder_direccion=DIRECCIONAPODER,
apoder_correo=CORREOAPODER,
apoder_telcel=TELEFONOAPODER
where id_apoderado=IDAPODER;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MODIFICAR_APODERADO_ESTATUS` (IN `ID` INT, IN `ESTATUS` VARCHAR(8))   UPDATE apoderado set
apoder_estado=ESTATUS
where id_apoderado=ID$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MODIFICAR_MATRICULA_ESTATUS` (IN `ID` INT, IN `ESTATUS` VARCHAR(8))   UPDATE matricula set
matric_estado=ESTATUS
where id_matricula=ID$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MODIFICAR_USUARIO` (IN `ID` INT, IN `NOMBRE` VARCHAR(45), IN `APELLIDO` VARCHAR(45), IN `TELEFONO` VARCHAR(9), IN `EMAIL` VARCHAR(255), IN `ROL` INT)   UPDATE usuario set
usuari_nombre=NOMBRE,
usuari_apellidos=APELLIDO,
usuari_telefono=TELEFONO,
usuari_correo=EMAIL,
id_rol=ROL
where id_usuario=ID$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MODIFICAR_USUARIO_CONTRA` (IN `ID` INT, IN `CONTRA` VARCHAR(100))   UPDATE usuario set
usuari_clave=CONTRA
where id_usuario=ID$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MODIFICAR_USUARIO_ESTATUS` (IN `ID` INT, IN `ESTATUS` VARCHAR(8))   UPDATE usuario set
usuari_estado=ESTATUS
where id_usuario=ID$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MOSTRAR_FACTURA` (IN `ID` INT)   SELECT
	pagos.pago_monto,
    matricula.id_matricula,
	pagos.pago_descripcion,
	pagos.pago_mes,
	pagos.pago_fecha,
    pagos.pago_modalidad,
	grado.grado_nombre,
	alumno.alumno_nombre,
	alumno.alumno_dni,
	alumno.alumno_direccion
FROM
	(((pagos
    INNER JOIN matricula ON (pagos.id_matricula = matricula.id_matricula))
	INNER JOIN alumno ON (matricula.id_alumno = alumno.id_alumno))
    INNER JOIN grado ON (matricula.id_grado = grado.id_grado))
where id_pagos=ID$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REGISTRAR_ALUMNO` (IN `DNI` VARCHAR(15), IN `NACIONALIDAD` VARCHAR(20), IN `NOMBRE` VARCHAR(45), IN `GENERO` VARCHAR(1), IN `NACIMIENTO` DATE, IN `CELULAR` VARCHAR(9), IN `CIUDAD` VARCHAR(20), IN `DIRECCION` VARCHAR(50))   BEGIN
DECLARE CANTIDAD INT;
SET @CANTIDAD:=(SELECT COUNT(*) FROM alumno where alumno_dni = BINARY DNI);
if @CANTIDAD = 0 THEN
INSERT into alumno(alumno_dni,alumno_nacionalidad,alumno_nombre,alumno_genero,alumno_fecha_nacimiento,alumno_celular,alumno_ciudad,alumno_direccion,alumno_estado)
VALUES(DNI,NACIONALIDAD,NOMBRE,GENERO,NACIMIENTO,CELULAR,CIUDAD,DIRECCION,'ACTIVO');
SELECT 1;
ELSE
SELECT 2;
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REGISTRAR_APODERADO` (IN `DNIMADRE` VARCHAR(15), IN `NACIONALIDADMADRE` VARCHAR(20), IN `NOMBREMADRE` VARCHAR(45), IN `GENEROMADRE` VARCHAR(1), IN `PARENTESCOMADRE` VARCHAR(10), IN `FECHAMADRE` DATE, IN `CIUDADMADRE` VARCHAR(20), IN `DIRECCIONMADRE` VARCHAR(50), IN `CORREOMADRE` VARCHAR(30), IN `TELEFONOMADRE` VARCHAR(9), IN `DNIPADRE` VARCHAR(15), IN `NACIONALIDADPADRE` VARCHAR(20), IN `NOMBREPADRE` VARCHAR(45), IN `GENEROPADRE` VARCHAR(1), IN `PARENTESCOPADRE` VARCHAR(10), IN `FECHAPADRE` DATE, IN `CIUDADPADRE` VARCHAR(20), IN `DIRECCIONPADRE` VARCHAR(50), IN `CORREOPADRE` VARCHAR(30), IN `TELEFONOPADRE` VARCHAR(9), IN `DNIAPODERADO` VARCHAR(15), IN `NACIONALIDADAPODERADO` VARCHAR(20), IN `NOMBREAPODERADO` VARCHAR(45), IN `GENEROAPODERADO` VARCHAR(1), IN `PARENTESCOAPODERADO` VARCHAR(10), IN `FECHAAPODERADO` DATE, IN `CIUDADAPODERADO` VARCHAR(20), IN `DIRECCIONAPODERADO` VARCHAR(50), IN `CORREOAPODERADO` VARCHAR(30), IN `TELEFONOAPODERADO` VARCHAR(9))   BEGIN
DECLARE CANTIDAD INT;
SET @CANTIDAD:=(SELECT COUNT(*) FROM madre where madre_dni = BINARY DNIMADRE);
if @CANTIDAD = 0 THEN
INSERT into madre(madre_dni,madre_nacionalidad,madre_nombre,madre_genero,madre_parentesco,madre_fecha,madre_ciudad,madre_direccion,madre_correo,madre_telcel,madre_estado)
VALUES(DNIMADRE,NACIONALIDADMADRE,NOMBREMADRE,GENEROMADRE,PARENTESCOMADRE,FECHAMADRE,CIUDADMADRE,DIRECCIONMADRE,CORREOMADRE,TELEFONOMADRE,'ACTIVO');
INSERT into padre(padre_dni,padre_nacionalidad,padre_nombre,padre_genero,padre_parentesco,padre_fecha,padre_ciudad,padre_direccion,padre_correo,padre_telcel,padre_estado)
VALUES(DNIPADRE,NACIONALIDADPADRE,NOMBREPADRE,GENEROPADRE,PARENTESCOPADRE,FECHAPADRE,CIUDADPADRE,DIRECCIONPADRE,CORREOPADRE,TELEFONOPADRE,'ACTIVO');
INSERT into apoderado(apoder_dni,apoder_nacionalidad,apoder_nombre,apoder_genero,apoder_parentesco,apoder_fecha,apoder_ciudad,apoder_direccion,apoder_correo,apoder_telcel,apoder_estado)
VALUES(DNIAPODERADO,NACIONALIDADAPODERADO,NOMBREAPODERADO,GENEROAPODERADO,PARENTESCOAPODERADO,FECHAAPODERADO,CIUDADAPODERADO,DIRECCIONAPODERADO,CORREOAPODERADO,TELEFONOAPODERADO,'ACTIVO');
SELECT 1;
ELSE
SELECT 2;
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REGISTRAR_INSCRIPCION` (IN `DNI` VARCHAR(9), IN `NOMBRES` VARCHAR(35), IN `APELLIDOS` VARCHAR(35), IN `CORREO` VARCHAR(30), IN `TELEFONO` VARCHAR(9), IN `GRADO` VARCHAR(20), IN `CONSULTA` VARCHAR(100))   BEGIN
DECLARE CANTIDAD INT;
SET @CANTIDAD:=(SELECT COUNT(*) FROM inscripcion where ins_dni = BINARY DNI);
if @CANTIDAD = 0 THEN
INSERT into inscripcion(ins_dni,ins_nombres,ins_apellidos,ins_correo,ins_telcel,ins_grado_interes,ins_consulta)
VALUES(DNI,NOMBRES,APELLIDOS,CORREO,TELEFONO,GRADO,CONSULTA);
SELECT 1;
ELSE
SELECT 2;
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REGISTRAR_MATRICULA` (IN `DNI` INT, IN `MATRICAPODER` VARCHAR(45), IN `CMATRICULA` VARCHAR(15), IN `GRADO` INT, IN `SITUACION` VARCHAR(10), IN `PROCEDENCIA` VARCHAR(45), IN `OBSERVACION` VARCHAR(200), IN `MCOSTO` DECIMAL(10,2), IN `CMENSUALIDAD` DECIMAL(10,2), IN `DESCUENTO` DECIMAL(10), IN `FECHA` DATE, IN `MATRICTOTAL` DECIMAL(10,2))   BEGIN
DECLARE CANTIDAD INT;
SET @CANTIDAD:=(SELECT COUNT(*) from matricula where id_alumno = BINARY DNI);
IF @CANTIDAD = 0 THEN
	INSERT INTO matricula(id_alumno,matric_apoder,matric_code,id_grado,matric_situacion,matric_procedencia,matric_observacion,matric_costo,matric_mensualidad,matric_descuento,matric_fecha,matric_total,matric_estado)
	VALUES(DNI,MATRICAPODER,CMATRICULA,GRADO,SITUACION,PROCEDENCIA,OBSERVACION,MCOSTO,CMENSUALIDAD,DESCUENTO,FECHA,MATRICTOTAL,'ACTIVO');
	SELECT 1;
ELSE
	SELECT 2;
END IF;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REGISTRAR_PAGO` (IN `MCODE` INT, IN `MONTO` DECIMAL(10,2), IN `DESCRIPCION` VARCHAR(20), IN `MES` VARCHAR(10), IN `FECHA` DATE, IN `MODALIDAD` VARCHAR(10), IN `OPERACION` VARCHAR(8), IN `EMISION` DATE, IN `CELULAR` VARCHAR(9), IN `BOLETA` VARCHAR(12))   BEGIN
DECLARE CANTIDAD INT;
SET @CANTIDAD:=(SELECT COUNT(*) FROM pagos where pago_mes = BINARY MES AND id_matricula = MCODE);
if @CANTIDAD = 0 THEN
INSERT into pagos(id_matricula,pago_monto,pago_descripcion,pago_mes,pago_fecha,pago_modalidad,pago_operacion,pago_emision,pago_celular,pago_boleta)
VALUES(MCODE,MONTO,DESCRIPCION,MES,FECHA,MODALIDAD,OPERACION,EMISION,CELULAR,BOLETA);
SELECT 1;
ELSE
SELECT 2;
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REGISTRAR_USUARIO` (IN `NOMBRE` VARCHAR(45), IN `APELLIDO` VARCHAR(45), IN `USUARIO` VARCHAR(20), IN `EMAIL` VARCHAR(100), IN `CONTRA` VARCHAR(100), IN `TELEFONO` VARCHAR(9), IN `FECHA` DATE, IN `ROL` INT)   BEGIN
DECLARE CANTIDAD INT;
SET @CANTIDAD:=(SELECT COUNT(*) from usuario where usuari_usuario = BINARY USUARIO);
IF @CANTIDAD = 0 THEN
	INSERT INTO usuario(usuari_nombre,usuari_apellidos,usuari_usuario,usuari_correo,usuari_clave,usuari_telefono,usuari_fecha,usuari_estado,id_rol)
	VALUES(NOMBRE,APELLIDO,USUARIO,EMAIL,CONTRA,TELEFONO,FECHA,'ACTIVO',ROL);
	SELECT 1;
ELSE
	SELECT 2;
END IF;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_VERIFICAR_USUARIO` (IN `USUARIO` VARCHAR(250))   SELECT
	usuario.id_usuario, 
	usuario.usuari_nombre,
    usuario.usuari_apellidos,
	usuario.usuari_usuario,
    usuario.usuari_correo, 
	usuario.usuari_clave, 
	usuario.usuari_telefono,
	usuario.usuari_fecha,
    usuario.usuari_estado,
    usuario.id_rol,
    rol_usuario.rol_descripcion,
    usuario.usuari_intento
FROM
	usuario
	INNER JOIN
	rol_usuario
	ON 
		usuario.id_rol = rol_usuario.id_rol
where usuari_usuario = BINARY USUARIO$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno`
--

CREATE TABLE `alumno` (
  `id_alumno` int(11) NOT NULL,
  `alumno_dni` varchar(15) NOT NULL,
  `alumno_nacionalidad` varchar(20) NOT NULL,
  `alumno_nombre` varchar(45) NOT NULL,
  `alumno_genero` varchar(1) NOT NULL,
  `alumno_fecha_nacimiento` date NOT NULL,
  `alumno_celular` varchar(9) DEFAULT NULL,
  `alumno_ciudad` varchar(20) NOT NULL,
  `alumno_direccion` varchar(50) NOT NULL,
  `alumno_estado` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `alumno`
--

INSERT INTO `alumno` (`id_alumno`, `alumno_dni`, `alumno_nacionalidad`, `alumno_nombre`, `alumno_genero`, `alumno_fecha_nacimiento`, `alumno_celular`, `alumno_ciudad`, `alumno_direccion`, `alumno_estado`) VALUES
(23, '72918052', 'Peruano', 'Lenin Junior Baldera Solano', 'M', '2020-06-24', '955537473', 'Chiclayo', 'Calle el prado Mz B lote 1, Urb Las Brisas', 'ACTIVO'),
(24, '12457869', 'Peruano', 'Nayelly Delgado Loza', 'M', '2020-06-01', '758968955', 'Chiclayo', 'Calle de prueba', 'ACTIVO'),
(25, '45128796', 'Peruano', 'Dany Fabián Baldera Solano', 'M', '2020-06-02', '922452639', 'Chiclayo', 'Calle el prado 128', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `apoderado`
--

CREATE TABLE `apoderado` (
  `id_apoderado` int(11) NOT NULL,
  `apoder_dni` varchar(15) DEFAULT NULL,
  `apoder_nacionalidad` varchar(20) DEFAULT NULL,
  `apoder_nombre` varchar(45) DEFAULT NULL,
  `apoder_genero` varchar(1) DEFAULT NULL,
  `apoder_parentesco` varchar(10) DEFAULT NULL,
  `apoder_fecha` date DEFAULT NULL,
  `apoder_ciudad` varchar(20) DEFAULT NULL,
  `apoder_direccion` varchar(50) DEFAULT NULL,
  `apoder_correo` varchar(30) DEFAULT NULL,
  `apoder_telcel` varchar(9) DEFAULT NULL,
  `apoder_estado` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `apoderado`
--

INSERT INTO `apoderado` (`id_apoderado`, `apoder_dni`, `apoder_nacionalidad`, `apoder_nombre`, `apoder_genero`, `apoder_parentesco`, `apoder_fecha`, `apoder_ciudad`, `apoder_direccion`, `apoder_correo`, `apoder_telcel`, `apoder_estado`) VALUES
(1, '', 'Peruano', '', 'M', '', '0000-00-00', 'Chiclayo', '', '', '', 'ACTIVO'),
(2, '96854785', 'Peruano', 'Emilia Delgado Barreto', 'F', 'Abuelo(a)', '2005-12-22', 'Chiclayo', 'Calle el paraíso N°230', '', '986457877', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grado`
--

CREATE TABLE `grado` (
  `id_grado` int(11) NOT NULL,
  `grado_nombre` varchar(25) NOT NULL,
  `grado_seccion` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `grado`
--

INSERT INTO `grado` (`id_grado`, `grado_nombre`, `grado_seccion`) VALUES
(1, 'inicial 3 años ', 'U'),
(2, 'inicial 4 años', 'U'),
(3, 'inicial 5 años', 'U'),
(4, '1ero primaria A', 'A'),
(5, '1ero primaria B', 'B'),
(6, '2do primaria A', 'A'),
(7, '2do primaria B', 'B'),
(8, '3ero primaria A', 'A'),
(9, '3ero primaria B', 'B'),
(10, '4to primaria A', 'A'),
(11, '4to primaria B', 'B'),
(12, '5to primaria A', 'A'),
(13, '5to primaria B', 'B'),
(14, '6to primaria A', 'A'),
(15, '6to primaria B', 'B'),
(16, '1ero secundaria A', 'A'),
(17, '1ero secundaria B', 'B'),
(18, '2do secundaria A', 'A'),
(19, '2do secundaria B', 'B'),
(20, '3ero secundaria A', 'A'),
(21, '3ero secundaria B', 'B'),
(22, '4to secundaria A', 'A'),
(23, '4to secundaria B', 'B'),
(24, '5to secundaria A', 'A'),
(25, '5to secundaria B', 'B');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscripcion`
--

CREATE TABLE `inscripcion` (
  `id_inscripcion` int(11) NOT NULL,
  `ins_dni` varchar(9) NOT NULL,
  `ins_nombres` varchar(35) NOT NULL,
  `ins_apellidos` varchar(35) NOT NULL,
  `ins_correo` varchar(30) DEFAULT NULL,
  `ins_telcel` varchar(9) NOT NULL,
  `ins_grado_interes` varchar(20) NOT NULL,
  `ins_consulta` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `inscripcion`
--

INSERT INTO `inscripcion` (`id_inscripcion`, `ins_dni`, `ins_nombres`, `ins_apellidos`, `ins_correo`, `ins_telcel`, `ins_grado_interes`, `ins_consulta`) VALUES
(22, '74610557', 'Renzo estit', 'Rojas Requejo', '', '977577220', 'Secundaria', 'Quiero ver si hay vacantes para 3er grado de secundaria'),
(23, '16770628', 'Valery  Daleska ', 'Baldera Solano', '', '969280424', 'Primaria', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `madre`
--

CREATE TABLE `madre` (
  `id_madre` int(11) NOT NULL,
  `madre_dni` varchar(15) DEFAULT NULL,
  `madre_nacionalidad` varchar(20) DEFAULT NULL,
  `madre_nombre` varchar(45) DEFAULT NULL,
  `madre_genero` varchar(1) DEFAULT NULL,
  `madre_parentesco` varchar(10) DEFAULT NULL,
  `madre_fecha` date DEFAULT NULL,
  `madre_ciudad` varchar(20) DEFAULT NULL,
  `madre_direccion` varchar(50) DEFAULT NULL,
  `madre_correo` varchar(30) DEFAULT NULL,
  `madre_telcel` varchar(9) DEFAULT NULL,
  `madre_estado` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `madre`
--

INSERT INTO `madre` (`id_madre`, `madre_dni`, `madre_nacionalidad`, `madre_nombre`, `madre_genero`, `madre_parentesco`, `madre_fecha`, `madre_ciudad`, `madre_direccion`, `madre_correo`, `madre_telcel`, `madre_estado`) VALUES
(1, '75845874', 'Peruano', 'Alexandra Mendez Flores', 'F', 'Madre', '2003-02-11', 'Chiclayo', 'Calle Los patos N°120', 'Alexandra12@gmail.com', '458569', 'ACTIVO'),
(2, '', 'Peruano', '', 'F', 'Madre', '0000-00-00', 'Chiclayo', '', '', '', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `matricula`
--

CREATE TABLE `matricula` (
  `id_matricula` int(11) NOT NULL,
  `id_alumno` int(11) NOT NULL,
  `id_madre` int(11) DEFAULT NULL,
  `id_padre` int(11) DEFAULT NULL,
  `id_apoderado` int(11) DEFAULT NULL,
  `matric_apoder` varchar(45) DEFAULT NULL,
  `matric_code` varchar(15) NOT NULL,
  `id_grado` int(11) NOT NULL,
  `matric_situacion` varchar(10) NOT NULL,
  `matric_procedencia` varchar(45) DEFAULT NULL,
  `matric_observacion` varchar(200) DEFAULT NULL,
  `matric_costo` decimal(10,2) NOT NULL,
  `matric_mensualidad` decimal(10,2) NOT NULL,
  `matric_descuento` decimal(10,0) DEFAULT NULL,
  `matric_fecha` date NOT NULL,
  `matric_estado` varchar(8) NOT NULL,
  `matric_total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `matricula`
--

INSERT INTO `matricula` (`id_matricula`, `id_alumno`, `id_madre`, `id_padre`, `id_apoderado`, `matric_apoder`, `matric_code`, `id_grado`, `matric_situacion`, `matric_procedencia`, `matric_observacion`, `matric_costo`, `matric_mensualidad`, `matric_descuento`, `matric_fecha`, `matric_estado`, `matric_total`) VALUES
(1, 23, NULL, NULL, NULL, 'Alexandra Mendez Flores', '3576219804', 1, 'Ingresante', 'IEP Jorge Basadre', NULL, 180.00, 180.00, 0, '2023-06-07', 'ACTIVO', 1800.00),
(2, 24, NULL, NULL, NULL, 'Emilia Delgado Barreto', '9321785640', 22, 'Ingresante', 'IEP San Agustín', NULL, 180.00, 160.00, 5, '2023-06-12', 'ACTIVO', 1520.00),
(5, 25, NULL, NULL, NULL, 'Emilia Delgado Barreto', '3875642910', 23, 'Ingresante', 'IEP Santa FE', 'Al alumno le faltan:\n- Copia de DNI del apoderado', 180.00, 180.00, 0, '2023-06-18', 'ACTIVO', 1800.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `padre`
--

CREATE TABLE `padre` (
  `id_padre` int(11) NOT NULL,
  `padre_dni` varchar(15) DEFAULT NULL,
  `padre_nacionalidad` varchar(20) DEFAULT NULL,
  `padre_nombre` varchar(45) DEFAULT NULL,
  `padre_genero` varchar(1) DEFAULT NULL,
  `padre_parentesco` varchar(10) DEFAULT NULL,
  `padre_fecha` date DEFAULT NULL,
  `padre_ciudad` varchar(20) DEFAULT NULL,
  `padre_direccion` varchar(50) DEFAULT NULL,
  `padre_correo` varchar(30) DEFAULT NULL,
  `padre_telcel` varchar(9) DEFAULT NULL,
  `padre_estado` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `padre`
--

INSERT INTO `padre` (`id_padre`, `padre_dni`, `padre_nacionalidad`, `padre_nombre`, `padre_genero`, `padre_parentesco`, `padre_fecha`, `padre_ciudad`, `padre_direccion`, `padre_correo`, `padre_telcel`, `padre_estado`) VALUES
(1, '74859698', 'Peruano', 'Pedro Lozano Vargas', 'M', 'Papa', '1998-07-15', 'Chiclayo', 'Calle Los patos n°120', 'Pedro@gmail.com', '125698', 'ACTIVO'),
(2, '', 'Peruano', '', 'M', 'Papa', '0000-00-00', 'Chiclayo', '', '', '', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE `pagos` (
  `id_pagos` int(11) NOT NULL,
  `id_matricula` int(11) NOT NULL,
  `pago_monto` decimal(10,2) NOT NULL,
  `pago_descripcion` varchar(20) NOT NULL,
  `pago_mes` varchar(10) DEFAULT NULL,
  `pago_fecha` date NOT NULL,
  `pago_modalidad` varchar(10) NOT NULL,
  `pago_operacion` varchar(8) DEFAULT NULL,
  `pago_emision` date DEFAULT NULL,
  `pago_celular` varchar(9) DEFAULT NULL,
  `pago_boleta` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `pagos`
--

INSERT INTO `pagos` (`id_pagos`, `id_matricula`, `pago_monto`, `pago_descripcion`, `pago_mes`, `pago_fecha`, `pago_modalidad`, `pago_operacion`, `pago_emision`, `pago_celular`, `pago_boleta`) VALUES
(1, 1, 180.00, 'Matricula', '', '2023-06-07', 'Efectivo', '', '2023-06-08', NULL, ''),
(2, 1, 180.00, 'Pension', 'Marzo', '2023-06-11', 'Efectivo', '0', '2023-06-12', NULL, NULL),
(3, 2, 180.00, 'Matricula', '', '2023-06-11', 'BCP', '51654545', '2023-06-12', NULL, NULL),
(4, 2, 200.00, 'Pension', 'Marzo', '2023-06-28', 'BCP', '16464646', '2023-06-29', NULL, NULL),
(5, 1, 180.00, 'Pension', 'Abril', '2023-06-17', 'Efectivo', '', '2023-06-18', '922049876', 'B003 - 000'),
(6, 2, 180.00, 'Pension', 'Abril', '2023-06-17', 'BCP', '45896958', '2023-06-18', '955537473', 'B003 - 0003');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol_usuario`
--

CREATE TABLE `rol_usuario` (
  `id_rol` int(11) NOT NULL,
  `rol_descripcion` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `rol_usuario`
--

INSERT INTO `rol_usuario` (`id_rol`, `rol_descripcion`) VALUES
(1, 'Administrador'),
(2, 'Secretaria');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `usuari_nombre` varchar(45) NOT NULL,
  `usuari_apellidos` varchar(45) NOT NULL,
  `usuari_usuario` varchar(20) NOT NULL,
  `usuari_correo` varchar(100) NOT NULL,
  `usuari_clave` varchar(100) NOT NULL,
  `usuari_telefono` varchar(9) NOT NULL,
  `usuari_fecha` date NOT NULL,
  `usuari_estado` varchar(8) NOT NULL,
  `usuari_intento` int(11) DEFAULT NULL,
  `id_rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `usuari_nombre`, `usuari_apellidos`, `usuari_usuario`, `usuari_correo`, `usuari_clave`, `usuari_telefono`, `usuari_fecha`, `usuari_estado`, `usuari_intento`, `id_rol`) VALUES
(1, 'Lenin Junior', 'Baldera Solano', 'Lenin12', 'lenin@gmail.com', '$2y$12$GzH5faKlLK3.bporox9KZuYKs1tbpMxj/qSDiodWDFBuo/c8TbXUe', '955537473', '2023-10-10', 'ACTIVO', 0, 1),
(2, 'prueba', 'Rojas Requejo', 'Renzo12', 'renzo@gmail.com', '$2y$12$LPB0.eWIzc8uDsMdXD7.LOIxLas/fwoetdiE33B5fWaUq2nGCcAtG', '977577220', '2023-09-09', 'ACTIVO', 0, 2),
(7, 'Dany smitt', 'Baldera Solano', 'Dany12', 'dan@gmail.com', '$2y$12$S5nqtk1wz1MliBLbP1hs2OwzrEPfldVMVLS8/PSOIom86kUqfmKWG', '152451', '2023-05-09', 'ACTIVO', 2, 2),
(8, 'Carlos ', 'Perez vasquez', 'Carlos2003', 'carlitos@gmail.com', '$2y$12$PQk9tzRYRDYuN3GDT9iQuuQkfBMvgXwidoAb.kRakjpxI8JA9UQsO', '201526', '2023-05-09', 'ACTIVO', NULL, 2),
(9, 'User', 'Apellido usuario', 'weifys', '123@gmail.com', '$2y$12$zpRH1DhuXsJL0wOBh74VhOw6Wqa6S0Jmyi1AgWo0fSSyt/0aDH2Ky', '4585896', '2023-05-17', 'ACTIVO', NULL, 1);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `view_listar_alumno`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `view_listar_alumno` (
`id_alumno` int(11)
,`alumno_dni` varchar(15)
,`alumno_nacionalidad` varchar(20)
,`alumno_nombre` varchar(45)
,`alumno_genero` varchar(1)
,`alumno_fecha_nacimiento` date
,`alumno_celular` varchar(9)
,`alumno_ciudad` varchar(20)
,`alumno_direccion` varchar(50)
,`alumno_estado` varchar(8)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `view_listar_apoderado`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `view_listar_apoderado` (
`id_madre` int(11)
,`madre_dni` varchar(15)
,`madre_nacionalidad` varchar(20)
,`madre_nombre` varchar(45)
,`madre_genero` varchar(1)
,`madre_parentesco` varchar(10)
,`madre_fecha` date
,`madre_ciudad` varchar(20)
,`madre_direccion` varchar(50)
,`madre_correo` varchar(30)
,`madre_telcel` varchar(9)
,`madre_estado` varchar(8)
,`id_padre` int(11)
,`padre_dni` varchar(15)
,`padre_nacionalidad` varchar(20)
,`padre_nombre` varchar(45)
,`padre_genero` varchar(1)
,`padre_parentesco` varchar(10)
,`padre_fecha` date
,`padre_ciudad` varchar(20)
,`padre_direccion` varchar(50)
,`padre_correo` varchar(30)
,`padre_telcel` varchar(9)
,`id_apoderado` int(11)
,`apoder_dni` varchar(15)
,`apoder_nacionalidad` varchar(20)
,`apoder_nombre` varchar(45)
,`apoder_genero` varchar(1)
,`apoder_parentesco` varchar(10)
,`apoder_fecha` date
,`apoder_ciudad` varchar(20)
,`apoder_direccion` varchar(50)
,`apoder_correo` varchar(30)
,`apoder_telcel` varchar(9)
,`apoder_estado` varchar(8)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `view_listar_inscripcion`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `view_listar_inscripcion` (
`id_inscripcion` int(11)
,`ins_dni` varchar(9)
,`ins_nombres` varchar(35)
,`ins_apellidos` varchar(35)
,`ins_correo` varchar(30)
,`ins_telcel` varchar(9)
,`ins_grado_interes` varchar(20)
,`ins_consulta` varchar(100)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `view_listar_matricula`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `view_listar_matricula` (
`id_matricula` int(11)
,`id_alumno` int(11)
,`alumno_nombre` varchar(45)
,`matric_apoder` varchar(45)
,`matric_code` varchar(15)
,`id_grado` int(11)
,`grado_nombre` varchar(25)
,`grado_seccion` varchar(1)
,`matric_situacion` varchar(10)
,`matric_procedencia` varchar(45)
,`matric_observacion` varchar(200)
,`matric_costo` decimal(10,2)
,`matric_mensualidad` decimal(10,2)
,`matric_descuento` decimal(10,0)
,`matric_fecha` date
,`matric_estado` varchar(8)
,`matric_total` decimal(10,2)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `view_listar_pago`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `view_listar_pago` (
`id_pagos` int(11)
,`id_matricula` int(11)
,`matric_code` varchar(15)
,`id_alumno` int(11)
,`alumno_nombre` varchar(45)
,`pago_monto` decimal(10,2)
,`pago_descripcion` varchar(20)
,`pago_mes` varchar(10)
,`pago_fecha` date
,`pago_modalidad` varchar(10)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `view_listar_usuario`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `view_listar_usuario` (
`id_usuario` int(11)
,`usuari_nombre` varchar(45)
,`usuari_apellidos` varchar(45)
,`usuari_usuario` varchar(20)
,`usuari_clave` varchar(100)
,`id_rol` int(11)
,`rol_descripcion` varchar(45)
,`usuari_estado` varchar(8)
,`usuari_correo` varchar(100)
,`usuari_telefono` varchar(9)
);

-- --------------------------------------------------------

--
-- Estructura para la vista `view_listar_alumno`
--
DROP TABLE IF EXISTS `view_listar_alumno`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_listar_alumno`  AS SELECT `alumno`.`id_alumno` AS `id_alumno`, `alumno`.`alumno_dni` AS `alumno_dni`, `alumno`.`alumno_nacionalidad` AS `alumno_nacionalidad`, `alumno`.`alumno_nombre` AS `alumno_nombre`, `alumno`.`alumno_genero` AS `alumno_genero`, `alumno`.`alumno_fecha_nacimiento` AS `alumno_fecha_nacimiento`, `alumno`.`alumno_celular` AS `alumno_celular`, `alumno`.`alumno_ciudad` AS `alumno_ciudad`, `alumno`.`alumno_direccion` AS `alumno_direccion`, `alumno`.`alumno_estado` AS `alumno_estado` FROM `alumno` WHERE `alumno`.`alumno_estado` = 'ACTIVO' ;

-- --------------------------------------------------------

--
-- Estructura para la vista `view_listar_apoderado`
--
DROP TABLE IF EXISTS `view_listar_apoderado`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_listar_apoderado`  AS SELECT `madre`.`id_madre` AS `id_madre`, `madre`.`madre_dni` AS `madre_dni`, `madre`.`madre_nacionalidad` AS `madre_nacionalidad`, `madre`.`madre_nombre` AS `madre_nombre`, `madre`.`madre_genero` AS `madre_genero`, `madre`.`madre_parentesco` AS `madre_parentesco`, `madre`.`madre_fecha` AS `madre_fecha`, `madre`.`madre_ciudad` AS `madre_ciudad`, `madre`.`madre_direccion` AS `madre_direccion`, `madre`.`madre_correo` AS `madre_correo`, `madre`.`madre_telcel` AS `madre_telcel`, `madre`.`madre_estado` AS `madre_estado`, `padre`.`id_padre` AS `id_padre`, `padre`.`padre_dni` AS `padre_dni`, `padre`.`padre_nacionalidad` AS `padre_nacionalidad`, `padre`.`padre_nombre` AS `padre_nombre`, `padre`.`padre_genero` AS `padre_genero`, `padre`.`padre_parentesco` AS `padre_parentesco`, `padre`.`padre_fecha` AS `padre_fecha`, `padre`.`padre_ciudad` AS `padre_ciudad`, `padre`.`padre_direccion` AS `padre_direccion`, `padre`.`padre_correo` AS `padre_correo`, `padre`.`padre_telcel` AS `padre_telcel`, `apoderado`.`id_apoderado` AS `id_apoderado`, `apoderado`.`apoder_dni` AS `apoder_dni`, `apoderado`.`apoder_nacionalidad` AS `apoder_nacionalidad`, `apoderado`.`apoder_nombre` AS `apoder_nombre`, `apoderado`.`apoder_genero` AS `apoder_genero`, `apoderado`.`apoder_parentesco` AS `apoder_parentesco`, `apoderado`.`apoder_fecha` AS `apoder_fecha`, `apoderado`.`apoder_ciudad` AS `apoder_ciudad`, `apoderado`.`apoder_direccion` AS `apoder_direccion`, `apoderado`.`apoder_correo` AS `apoder_correo`, `apoderado`.`apoder_telcel` AS `apoder_telcel`, `apoderado`.`apoder_estado` AS `apoder_estado` FROM ((`madre` join `padre` on(`madre`.`id_madre` = `padre`.`id_padre`)) join `apoderado` on(`madre`.`id_madre` = `apoderado`.`id_apoderado`)) WHERE `apoderado`.`apoder_estado` = 'ACTIVO' ;

-- --------------------------------------------------------

--
-- Estructura para la vista `view_listar_inscripcion`
--
DROP TABLE IF EXISTS `view_listar_inscripcion`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_listar_inscripcion`  AS SELECT `inscripcion`.`id_inscripcion` AS `id_inscripcion`, `inscripcion`.`ins_dni` AS `ins_dni`, `inscripcion`.`ins_nombres` AS `ins_nombres`, `inscripcion`.`ins_apellidos` AS `ins_apellidos`, `inscripcion`.`ins_correo` AS `ins_correo`, `inscripcion`.`ins_telcel` AS `ins_telcel`, `inscripcion`.`ins_grado_interes` AS `ins_grado_interes`, `inscripcion`.`ins_consulta` AS `ins_consulta` FROM `inscripcion` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `view_listar_matricula`
--
DROP TABLE IF EXISTS `view_listar_matricula`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_listar_matricula`  AS SELECT `matricula`.`id_matricula` AS `id_matricula`, `alumno`.`id_alumno` AS `id_alumno`, `alumno`.`alumno_nombre` AS `alumno_nombre`, `matricula`.`matric_apoder` AS `matric_apoder`, `matricula`.`matric_code` AS `matric_code`, `grado`.`id_grado` AS `id_grado`, `grado`.`grado_nombre` AS `grado_nombre`, `grado`.`grado_seccion` AS `grado_seccion`, `matricula`.`matric_situacion` AS `matric_situacion`, `matricula`.`matric_procedencia` AS `matric_procedencia`, `matricula`.`matric_observacion` AS `matric_observacion`, `matricula`.`matric_costo` AS `matric_costo`, `matricula`.`matric_mensualidad` AS `matric_mensualidad`, `matricula`.`matric_descuento` AS `matric_descuento`, `matricula`.`matric_fecha` AS `matric_fecha`, `matricula`.`matric_estado` AS `matric_estado`, `matricula`.`matric_total` AS `matric_total` FROM ((`matricula` join `alumno` on(`matricula`.`id_alumno` = `alumno`.`id_alumno`)) join `grado` on(`matricula`.`id_grado` = `grado`.`id_grado`)) WHERE `matricula`.`matric_estado` = 'ACTIVO' ;

-- --------------------------------------------------------

--
-- Estructura para la vista `view_listar_pago`
--
DROP TABLE IF EXISTS `view_listar_pago`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_listar_pago`  AS SELECT `pagos`.`id_pagos` AS `id_pagos`, `pagos`.`id_matricula` AS `id_matricula`, `matricula`.`matric_code` AS `matric_code`, `matricula`.`id_alumno` AS `id_alumno`, `alumno`.`alumno_nombre` AS `alumno_nombre`, `pagos`.`pago_monto` AS `pago_monto`, `pagos`.`pago_descripcion` AS `pago_descripcion`, `pagos`.`pago_mes` AS `pago_mes`, `pagos`.`pago_fecha` AS `pago_fecha`, `pagos`.`pago_modalidad` AS `pago_modalidad` FROM ((`pagos` join `matricula` on(`pagos`.`id_matricula` = `matricula`.`id_matricula`)) join `alumno` on(`matricula`.`id_alumno` = `alumno`.`id_alumno`)) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `view_listar_usuario`
--
DROP TABLE IF EXISTS `view_listar_usuario`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_listar_usuario`  AS SELECT `usuario`.`id_usuario` AS `id_usuario`, `usuario`.`usuari_nombre` AS `usuari_nombre`, `usuario`.`usuari_apellidos` AS `usuari_apellidos`, `usuario`.`usuari_usuario` AS `usuari_usuario`, `usuario`.`usuari_clave` AS `usuari_clave`, `usuario`.`id_rol` AS `id_rol`, `rol_usuario`.`rol_descripcion` AS `rol_descripcion`, `usuario`.`usuari_estado` AS `usuari_estado`, `usuario`.`usuari_correo` AS `usuari_correo`, `usuario`.`usuari_telefono` AS `usuari_telefono` FROM (`usuario` join `rol_usuario` on(`usuario`.`id_rol` = `rol_usuario`.`id_rol`)) ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD PRIMARY KEY (`id_alumno`);

--
-- Indices de la tabla `apoderado`
--
ALTER TABLE `apoderado`
  ADD PRIMARY KEY (`id_apoderado`);

--
-- Indices de la tabla `grado`
--
ALTER TABLE `grado`
  ADD PRIMARY KEY (`id_grado`);

--
-- Indices de la tabla `inscripcion`
--
ALTER TABLE `inscripcion`
  ADD PRIMARY KEY (`id_inscripcion`);

--
-- Indices de la tabla `madre`
--
ALTER TABLE `madre`
  ADD PRIMARY KEY (`id_madre`);

--
-- Indices de la tabla `matricula`
--
ALTER TABLE `matricula`
  ADD PRIMARY KEY (`id_matricula`),
  ADD KEY `fk_matricula_alumno1_idx` (`id_alumno`),
  ADD KEY `fk_matricula_grado1_idx` (`id_grado`),
  ADD KEY `fk_matricula_madre1_idx` (`id_madre`),
  ADD KEY `fk_matricula_padre1_idx` (`id_padre`),
  ADD KEY `fk_matricula_apoderado1_idx` (`id_apoderado`);

--
-- Indices de la tabla `padre`
--
ALTER TABLE `padre`
  ADD PRIMARY KEY (`id_padre`);

--
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`id_pagos`),
  ADD KEY `fk_pagos_matricula1_idx` (`id_matricula`);

--
-- Indices de la tabla `rol_usuario`
--
ALTER TABLE `rol_usuario`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `fk_usuario_rol1_idx` (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumno`
--
ALTER TABLE `alumno`
  MODIFY `id_alumno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `apoderado`
--
ALTER TABLE `apoderado`
  MODIFY `id_apoderado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `grado`
--
ALTER TABLE `grado`
  MODIFY `id_grado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `inscripcion`
--
ALTER TABLE `inscripcion`
  MODIFY `id_inscripcion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `madre`
--
ALTER TABLE `madre`
  MODIFY `id_madre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `matricula`
--
ALTER TABLE `matricula`
  MODIFY `id_matricula` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `padre`
--
ALTER TABLE `padre`
  MODIFY `id_padre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `id_pagos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `rol_usuario`
--
ALTER TABLE `rol_usuario`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `matricula`
--
ALTER TABLE `matricula`
  ADD CONSTRAINT `fk_matricula_alumno1` FOREIGN KEY (`id_alumno`) REFERENCES `alumno` (`id_alumno`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_matricula_apoderado1` FOREIGN KEY (`id_apoderado`) REFERENCES `apoderado` (`id_apoderado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_matricula_grado1` FOREIGN KEY (`id_grado`) REFERENCES `grado` (`id_grado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_matricula_madre1` FOREIGN KEY (`id_madre`) REFERENCES `madre` (`id_madre`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_matricula_padre1` FOREIGN KEY (`id_padre`) REFERENCES `padre` (`id_padre`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD CONSTRAINT `fk_pagos_matricula1` FOREIGN KEY (`id_matricula`) REFERENCES `matricula` (`id_matricula`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_usuario_rol1` FOREIGN KEY (`id_rol`) REFERENCES `rol_usuario` (`id_rol`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
