-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-08-2022 a las 19:12:59
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `funeraria`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `INSERT_FACTURA` (IN `id_usuario` INT, IN `fac_num_factura` VARCHAR(40), IN `fac_fecha_creacion` INT, IN `fac_fecha_vencimiento` INT, IN `fac_total` INT, IN `fac_ncf` INT, IN `fac_estado` INT, IN `fac_cod_condicion` INT, IN `fac_subtotal` INT, IN `fac_tipo_ncf` INT, OUT `id_factura` INT)   BEGIN


     INSERT INTO factura(
         factura.fac_cod_usuario,
         factura.fac_num_factura,
         factura.fac_fecha_creacion,
         factura.fac_fecha_vencimiento,
         factura.fac_total,
         factura.fac_ncf,
         factura.fac_estado,
         factura.fac_cod_condicion,
     factura.fac_subtotal,
       factura.fac_tipo_ncf)
     VALUES (@p0, @p1, @p2, @p3, @p4, @p5, @p6, @p7, @p8, @p9);

 	set @p10= LAST_INSERT_ID();
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `INSERT_REGISTRO` (IN `id_persona` INT, IN `id_sexo` INT, IN `id_estadocivil` INT, IN `id_tipodocumento` INT, IN `per_documento` INT(11), IN `fecha_nacimiento` DATE, IN `id_tipotelefono` INT, IN `persona_telefono` INT, IN `sector` VARCHAR(60), IN `Municipio` INT, IN `Provincia` INT)   BEGIN
     declare GETid_telefono int;
     declare GETid_documento int;
     declare GETid_sector int;
     
	

  
	  INSERT into telefono(telefono.tel_telefono, telefono.tel_cod_tiptelefono) VALUES( @p7, @p6);
      set @GETid_telefono :=  (SELECT id_telefono from telefono WHERE telefono.id_telefono = @p7 and telefono.tel_cod_tiptelefono=@p6 LIMIT 1 );
     
      INSERT into documento(documento.doc_numero, documento.doc_cod_tipdocumento) VALUES(per_documento, @p3);
      set @GETid_documento :=  (SELECT id_documento from documento WHERE documento.doc_numero = @p4 and documento.doc_cod_tipdocumento=@p3 LIMIT 1 );
      

     INSERT INTO sector(sector.sec_cod_municipio, sector.sec_descripcion) VALUES(@p9, @p8);
     
      set @GETid_sector :=  (SELECT id_sector FROM sector ORDER BY id_sector DESC LIMIT 1);
     
     
     
 	 UPDATE persona SET per_cod_sector=@GETid_sector, per_cod_sexo=@p1,per_cod_estcivil=@p2,per_fecha_nac=@p5,per_cod_documento=@GETid_document,per_cod_tel=@GETid_telefono WHERE persona.id_persona=@p0;
     
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `INSERT_USUARIO_CLIENTE` (IN `usu_nombre` VARCHAR(60), IN `usu_password` VARCHAR(60), IN `per_nombre` VARCHAR(60), IN `per_apellido` VARCHAR(60), IN `per_email` VARCHAR(100), IN `usu_cod_tipusuario` INT, IN `usu_estado` TINYINT, IN `usu_fecha_registro` DATE, IN `per_foto` VARCHAR(100))   BEGIN
     DECLARE codigo_persona INT;

INSERT into persona (persona.per_nombre, persona.per_apellido,  persona.per_email, persona.per_foto)
VALUES(per_nombre, per_apellido, per_email, per_foto);

   set @codigo_persona :=  (SELECT id_persona COLLATE latin1_bin from persona WHERE per_email = @p4 and persona.per_nombre=@p2 and persona.per_apellido=@p3 and persona.per_foto=@p8 LIMIT 1 );

     INSERT INTO usuario(usu_nombre_user,usu_cod_persona,usu_password, usu_cod_tipusuario, usu_estado, usu_fecha_registro)
     VALUES (@p0,@codigo_persona, @p1,@p5,@p6,@p7);

 
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `pruebaC` (IN `tipo` VARCHAR(60))   INSERT INTO tipo_usuario(tipo_usuario.id_tipusuario,tipo_usuario.tip_descripcion) VALUES(null,@p0)$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `condicion_factura`
--

CREATE TABLE `condicion_factura` (
  `id_codicion_factura` int(11) NOT NULL,
  `con_descripcion` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `condicion_factura`
--

INSERT INTO `condicion_factura` (`id_codicion_factura`, `con_descripcion`) VALUES
(1, 'Virtual'),
(2, 'física');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_factura`
--

CREATE TABLE `detalle_factura` (
  `det_cod_prod` int(11) DEFAULT NULL,
  `det_cod_plan` int(11) DEFAULT NULL,
  `det_cant` int(11) NOT NULL,
  `det_subtotal` float NOT NULL,
  `det_importe` float NOT NULL,
  `det_cod_factura` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `detalle_factura`
--

INSERT INTO `detalle_factura` (`det_cod_prod`, `det_cod_plan`, `det_cant`, `det_subtotal`, `det_importe`, `det_cod_factura`) VALUES
(1, NULL, 2, 3500, 7000, 1),
(2, NULL, 1, 4550, 4550, 1),
(NULL, 1, 1, 2000, 2000, 6),
(NULL, 1, 1, 2000, 2360, 7),
(NULL, 2, 1, 4000, 4720, 8),
(NULL, 3, 1, 8000, 9440, 9),
(NULL, 2, 1, 4000, 4720, 11),
(NULL, 2, 1, 4000, 4720, 14),
(NULL, 2, 1, 4000, 4720, 15),
(NULL, 1, 1, 2000, 2360, 16),
(NULL, 2, 1, 4000, 4720, 18),
(NULL, 1, 1, 2000, 2360, 17),
(NULL, 3, 1, 8000, 9440, 18),
(NULL, 3, 1, 8000, 9440, 19),
(NULL, 2, 1, 4000, 4720, 20),
(NULL, 2, 1, 4000, 4720, 21),
(NULL, 3, 1, 8000, 9440, 22),
(NULL, 1, 1, 2000, 2360, 23),
(NULL, 2, 1, 4000, 4720, 24);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documento`
--

CREATE TABLE `documento` (
  `id_documento` int(11) NOT NULL,
  `doc_numero` int(11) NOT NULL,
  `doc_cod_tipdocumento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `documento`
--

INSERT INTO `documento` (`id_documento`, `doc_numero`, `doc_cod_tipdocumento`) VALUES
(1, 2147483647, 1),
(2, 1424, 1),
(3, 123123, 2),
(4, 2147483647, 1),
(5, 2147483647, 1),
(6, 2147483647, 1),
(7, 56262626, 1),
(8, 2147483647, 1),
(10, 2147483647, 1),
(11, 2147483647, 1),
(12, 2147483647, 1),
(13, 2147483647, 1),
(14, 2147483647, 1),
(15, 6545616, 1),
(16, 2147483647, 1),
(17, 2147483647, 1),
(18, 2147483647, 1),
(19, 2147483647, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_civil`
--

CREATE TABLE `estado_civil` (
  `id_estcivil` int(3) NOT NULL,
  `est_descripcion` varchar(60) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `estado_civil`
--

INSERT INTO `estado_civil` (`id_estcivil`, `est_descripcion`) VALUES
(1, 'Soltero'),
(2, 'Casado'),
(3, 'Union libre');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_factura`
--

CREATE TABLE `estado_factura` (
  `id_estado_factura` int(11) NOT NULL,
  `est_descripcion` char(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `estado_factura`
--

INSERT INTO `estado_factura` (`id_estado_factura`, `est_descripcion`) VALUES
(1, 'Pagada'),
(2, 'Pendiente'),
(3, 'Cancelada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `id_fact` int(11) NOT NULL,
  `fac_num_factura` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fac_cod_condicion` int(11) DEFAULT NULL,
  `fac_cod_usuario` int(11) NOT NULL,
  `fac_fecha_creacion` date NOT NULL,
  `fac_fecha_vencimiento` date NOT NULL,
  `fac_subtotal` float NOT NULL,
  `fac_total` float NOT NULL,
  `fac_balance_pendiente` float NOT NULL,
  `fac_ncf` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fac_tipo_ncf` int(11) NOT NULL,
  `fac_estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`id_fact`, `fac_num_factura`, `fac_cod_condicion`, `fac_cod_usuario`, `fac_fecha_creacion`, `fac_fecha_vencimiento`, `fac_subtotal`, `fac_total`, `fac_balance_pendiente`, `fac_ncf`, `fac_tipo_ncf`, `fac_estado`) VALUES
(1, '2022-07001', 2, 2, '2022-01-06', '2022-01-22', 11550, 13629, 3589, '00000001', 2, 2),
(2, '2022-07002', 2, 2, '2022-02-12', '2022-07-04', 0, 3500, 3500, '00000002', 2, 2),
(3, '2022-07003', 2, 1, '2022-07-12', '2022-07-30', 0, 0, 0, '00000003', 1, 3),
(6, '2022-07004', 1, 14, '2022-07-27', '2022-07-15', 2000, 2360, 1, '00000004', 2, 1),
(7, '2022-08005', 1, 16, '2022-08-02', '2022-08-02', 4720, 4720, 0, '00000005', 2, 1),
(8, '2022-08006', 1, 16, '2022-08-02', '2022-08-02', 2000, 2360, 0, '00000006', 2, 1),
(9, '2022-08007', 1, 17, '2022-08-02', '2022-08-02', 0, 0, 0, '00000007', 2, 3),
(11, '2022-08008', 1, 17, '2022-08-02', '2022-08-02', 0, 0, 0, '00000008', 2, 3),
(12, '2022-08009', 1, 17, '2022-08-02', '2022-08-02', 4000, 4720, 0, '00000009', 1, 1),
(13, '2022-08010', 2, 1, '2022-08-06', '2022-08-06', 9100, 9100, 9100, '00000010', 2, 2),
(14, '2022-08011', 2, 1, '2022-08-07', '2022-08-07', 100, 100, 0, '00000011', 2, 1),
(15, '2022-08012', 1, 18, '2022-08-09', '2022-08-09', 4000, 4720, 0, '00000012', 2, 1),
(16, '2022-08013', 1, 18, '2022-08-09', '2022-08-09', 4000, 4720, 0, '00000013', 2, 1),
(17, '2022-08014', 1, 18, '2022-08-09', '2022-08-09', 2000, 2360, 0, '00000014', 2, 1),
(18, '2022-08015', 1, 20, '2022-08-09', '2022-08-09', 4000, 4720, 0, '00000015', 2, 1),
(19, '2022-08016', 1, 23, '2022-08-09', '2022-08-09', 0, 0, 0, '00000016', 2, 3),
(20, '2022-08017', 1, 23, '2022-08-09', '2022-08-09', 8000, 9440, 0, '00000017', 2, 1),
(21, '2022-08018', 1, 24, '2022-08-17', '2022-08-17', 4000, 4720, 0, '00000018', 2, 1),
(22, '2022-08019', 1, 25, '2022-08-18', '2022-08-18', 0, 0, 0, '00000019', 2, 3),
(23, '2022-08020', 1, 17, '2022-08-18', '2022-08-18', 2000, 2360, 0, '00000020', 2, 1),
(24, '2022-08021', 1, 26, '2022-08-20', '2022-08-20', 4000, 4720, 0, '00000021', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipio`
--

CREATE TABLE `municipio` (
  `id_municipio` int(11) NOT NULL,
  `mun_cod_provincia` int(11) NOT NULL,
  `mun_descripcion` varchar(60) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `municipio`
--

INSERT INTO `municipio` (`id_municipio`, `mun_cod_provincia`, `mun_descripcion`) VALUES
(1, 1, 'Baitoa'),
(2, 1, 'Santiago'),
(3, 1, 'Janico'),
(4, 1, 'San Jose de las Matas'),
(5, 1, 'Licey al Medio');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos_factura`
--

CREATE TABLE `pagos_factura` (
  `id_pagos` int(11) NOT NULL,
  `pag_id_transaccion` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pag_descripcion` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pag_pago` float NOT NULL,
  `pag_balance_pendiente` float NOT NULL,
  `pag_fecha` date NOT NULL,
  `pag_cod_factura` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `pagos_factura`
--

INSERT INTO `pagos_factura` (`id_pagos`, `pag_id_transaccion`, `pag_descripcion`, `pag_pago`, `pag_balance_pendiente`, `pag_fecha`, `pag_cod_factura`) VALUES
(1, 'PAG1001', 'Abono de factura', 5000, 8629, '2022-08-01', 1),
(2, 'PAG1002', 'Abono de factura', 2000, 6629, '2022-08-02', 1),
(3, 'PAG0003', 'Abono de factura', 1040, 5589, '2022-08-02', 1),
(4, 'I-U8UD7YVVHVHE', 'pago de factura', 2360, 0, '2022-08-01', 6),
(10, 'PAG0005', 'abono factura', 2000, 3589, '2022-08-02', 1),
(19, 'I-TU8XD137BURH', 'Pago factura', 4720, 0, '2022-08-02', 12),
(20, 'I-1M30VR1Y9690', 'Pago factura', 4720, 0, '2022-08-09', 15),
(21, 'I-BCT3YLP8RKK8', 'Pago factura', 2360, 0, '2022-08-09', 17),
(22, 'I-716602WGGRES', 'Pago factura', 4720, 0, '2022-08-09', 18),
(24, 'I-F2CG8BJBKA1U', 'Pago factura', 9440, 0, '2022-08-09', 20),
(25, 'I-BXDJLB3HG0D8', 'Pago factura', 4720, 0, '2022-08-17', 21),
(27, 'I-7U4R3CWXM29V', 'Pago factura', 2360, 0, '2022-08-18', 23),
(28, 'I-7U4R3CWXM29V', 'Pago factura', 2360, 0, '2022-08-18', 23),
(29, 'I-7U4R3CWXM29V', 'Pago factura', 2360, 0, '2022-08-19', 23),
(30, 'I-VDJPWML6HHBS', 'Pago factura', 4720, 0, '2022-08-20', 24);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `id_persona` int(11) NOT NULL,
  `per_nombre` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `per_apellido` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `per_cod_sector` int(11) DEFAULT NULL,
  `per_cod_tel` int(11) DEFAULT NULL,
  `per_cod_sexo` int(11) DEFAULT NULL,
  `per_cod_estcivil` int(3) DEFAULT NULL,
  `per_tipo_persona` int(11) DEFAULT NULL,
  `per_email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `per_fecha_nac` date DEFAULT NULL,
  `per_cod_documento` int(11) DEFAULT NULL,
  `per_foto` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`id_persona`, `per_nombre`, `per_apellido`, `per_cod_sector`, `per_cod_tel`, `per_cod_sexo`, `per_cod_estcivil`, `per_tipo_persona`, `per_email`, `per_fecha_nac`, `per_cod_documento`, `per_foto`) VALUES
(1, 'Jose', 'Perez', 1, 1, 1, 2, 1, 'joseperez@gmail.com', '1999-01-03', 1, 'vistas/img/usuarios/avatar.png\r\n'),
(2, 'starling', 'jose', NULL, 27, 1, 1, 1, 'starling@sdma', '2022-06-12', NULL, ''),
(3, 'asd', 'asd', NULL, 29, 1, 1, 1, 'gdfg@', '2022-09-21', NULL, ''),
(4, 'Eddy', 'Reyes', 4, NULL, 2, 2, 1, 'vatuta12@gmail.com', '1999-04-28', NULL, ''),
(5, 'Eddy', 'Reyes', NULL, 2, 1, 1, 1, 'dfgdsfgdsfg@gmail.com', '2022-06-29', NULL, ''),
(6, 'Daivel', 'Canela', NULL, NULL, NULL, NULL, NULL, 'daivelcanela@gmail.com', NULL, NULL, ''),
(47, 'Eddy', 'Porfirio', NULL, NULL, NULL, NULL, NULL, 'eddy@gmail.com', NULL, NULL, 'vistas/img/usuarios/avatar.png'),
(48, 'daivel', 'canela', NULL, NULL, NULL, NULL, NULL, 'daivelcanela1234@asd', NULL, NULL, 'vistas/img/usuarios/avatar.png'),
(49, 'Victor', 'Tavarez', 6, NULL, 1, 1, NULL, 'victor@gmail.com', '2022-08-02', NULL, 'vistas/img/usuarios/avatar.png'),
(50, 'Mileysi', 'Rodriguez', 18, 19, 1, 2, NULL, 'Mileysi@gmail.com', '2022-08-18', 6, 'vistas/img/usuarios/avatar.png'),
(51, 'denicy', 'pena', 12, NULL, 2, 2, NULL, 'denicy@gmail.com', '2022-08-09', NULL, 'vistas/img/usuarios/avatar.png'),
(52, 'Bolivar', 'Vasquez', NULL, NULL, NULL, NULL, NULL, 'bolivar@gmail.com', NULL, NULL, 'vistas/img/usuarios/avatar.png'),
(53, 'Ivelisse ', 'Cruz', 13, NULL, 2, 3, NULL, 'ivellise@gmail.com', '2022-08-09', NULL, 'vistas/img/usuarios/avatar.png'),
(54, 'Ivelisse ', 'Cruz', NULL, NULL, NULL, NULL, NULL, 'ivellise@gmail.com', NULL, NULL, 'vistas/img/usuarios/avatar.png'),
(55, 'Ivelisse ', 'Cruz', NULL, NULL, NULL, NULL, NULL, 'ivellise@gmail.com', NULL, NULL, 'vistas/img/usuarios/avatar.png'),
(56, 'Cristal', 'almanzar', 15, NULL, 1, 1, NULL, 'cristal@gmail.com', '2022-08-09', NULL, 'vistas/img/usuarios/avatar.png'),
(57, 'josefina', 'mencia', 16, NULL, 2, 1, NULL, 'josefina@gmail.com', '2022-08-17', NULL, 'vistas/img/usuarios/avatar.png'),
(58, 'julio', 'perez', 17, NULL, 1, 1, NULL, 'julio@gmail.com', '2022-08-18', NULL, 'vistas/img/usuarios/avatar.png'),
(59, 'Amantina', 'Fermina', 19, NULL, 1, 1, NULL, 'amantina1@gmail.com', '2022-08-20', NULL, 'vistas/img/usuarios/avatar.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planes`
--

CREATE TABLE `planes` (
  `id_plan` int(11) NOT NULL,
  `pla_descripcion` varchar(60) CHARACTER SET utf8mb4 NOT NULL,
  `pla_detalle` varchar(60) CHARACTER SET utf8mb4 NOT NULL,
  `pla_precio` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `planes`
--

INSERT INTO `planes` (`id_plan`, `pla_descripcion`, `pla_detalle`, `pla_precio`) VALUES
(1, 'Básico', 'Un titular y una persona', 2000),
(2, 'Superior', 'Un titular y tres personas', 4000),
(3, 'Platinium', 'Un titular y cinco personas', 8000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planes_servicios`
--

CREATE TABLE `planes_servicios` (
  `pla_cod_serv` int(11) NOT NULL,
  `pla_cod_plan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `planes_servicios`
--

INSERT INTO `planes_servicios` (`pla_cod_serv`, `pla_cod_plan`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(1, 2),
(2, 2),
(3, 2),
(4, 2),
(5, 2),
(6, 2),
(7, 2),
(8, 2),
(12, 2),
(13, 2),
(1, 3),
(2, 3),
(3, 3),
(4, 3),
(5, 3),
(6, 3),
(7, 3),
(8, 3),
(9, 3),
(10, 3),
(11, 3),
(12, 3),
(13, 3),
(14, 3),
(15, 3),
(16, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` int(11) NOT NULL,
  `pro_codigo` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pro_descripcion` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pro_stock` int(11) NOT NULL,
  `pro_imagen` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pro_precio_compra` float NOT NULL,
  `pro_precio_venta` float NOT NULL,
  `pro_estado` tinyint(1) NOT NULL,
  `pro_fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `pro_codigo`, `pro_descripcion`, `pro_stock`, `pro_imagen`, `pro_precio_compra`, `pro_precio_venta`, `pro_estado`, `pro_fecha`) VALUES
(1, 'PRO0001', 'Ataud', 15, 'vistas/img/usuarios/avatar.png\r\n', 2000, 3500, 1, '2022-07-12'),
(2, 'PRO0002', 'Corona Fúnebre Rosas', 0, 'vistas/img/productos/PRO0002/368.jpg', 5000, 7500, 1, '2022-08-01'),
(3, 'PRO0003', 'Corona Fúnebre Colorida', 25, 'vistas/img/productos/PRO0003/674.jpg', 7000, 9100, 1, '2022-08-01'),
(4, 'PRO0004', 'Urna dorada', 0, 'vistas/img/productos/PRO0004/933.jpg', 3500, 4550, 1, '2022-08-01'),
(6, 'PRO0005', 'ASDASD', 1, 'vistas/img/productos/PRO0005/433.jpg', 342, 444.6, 1, '2022-08-20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincia`
--

CREATE TABLE `provincia` (
  `id_provincia` int(11) NOT NULL,
  `pro_descripcion` char(60) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `provincia`
--

INSERT INTO `provincia` (`id_provincia`, `pro_descripcion`) VALUES
(1, 'Santiago'),
(2, 'Santo Domingo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sector`
--

CREATE TABLE `sector` (
  `id_sector` int(11) NOT NULL,
  `sec_cod_municipio` int(11) NOT NULL,
  `sec_descripcion` varchar(60) CHARACTER SET utf8mb4 NOT NULL,
  `sec_calle_ref` varchar(60) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sector`
--

INSERT INTO `sector` (`id_sector`, `sec_cod_municipio`, `sec_descripcion`, `sec_calle_ref`) VALUES
(1, 2, 'Gurabo', 'Villa Verde calle 5 #16'),
(2, 1, 'villaverde', ''),
(3, 1, '14242sdas', ''),
(4, 3, 'villaverde', ''),
(5, 2, 'calle mercedes #16', ''),
(6, 2, 'calle mercedes #16', ''),
(7, 2, 'calle 5 gurabo', ''),
(8, 2, 'calle 5', ''),
(9, 5, 'calle 24 los rieles', ''),
(10, 2, 'Villa verde calle 10', ''),
(11, 2, 'Villa verde calle 10', ''),
(12, 1, 'Villa verde calle 10', ''),
(13, 3, 'Guanamu calle 20', ''),
(14, 2, 'calle 24 los rieles', ''),
(15, 3, 'calle 5', ''),
(16, 3, 'calle 10 juanico', ''),
(17, 1, 'calle 20 las palomas', ''),
(18, 1, 'fgfdgfdg', ''),
(19, 1, '516151561', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

CREATE TABLE `servicio` (
  `id_servicio` int(11) NOT NULL,
  `ser_descrip_servicio` varchar(60) CHARACTER SET utf8mb4 NOT NULL,
  `ser_estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `servicio`
--

INSERT INTO `servicio` (`id_servicio`, `ser_descrip_servicio`, `ser_estado`) VALUES
(1, 'Trámites de oficialía', 1),
(2, 'Recogida del fallecido en clínica, hospital o casa', 1),
(3, 'Cosmetización', 1),
(4, 'Velatorio en capilla o casa', 1),
(5, 'Libro de registro de firmas', 1),
(6, 'Café y agua', 1),
(7, 'Misa de cuerpo presente', 1),
(8, 'Traslado en carroza fúnebre al cementerio', 1),
(9, 'Autobús para transporte familiares (funeraria-cementerio)', 1),
(10, 'Recordatorios', 1),
(11, 'Cementerio de tu eleccion a nivel nacional', 1),
(12, 'Nicho', 1),
(13, 'Lápida con diseño, inscripción y grabado', 1),
(14, 'Servicio de inhumación', 1),
(15, 'Carpa', 1),
(16, 'Pago de Impuestos Municipales', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sexo`
--

CREATE TABLE `sexo` (
  `id_sexo` int(11) NOT NULL,
  `sex_descripcion` varchar(40) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sexo`
--

INSERT INTO `sexo` (`id_sexo`, `sex_descripcion`) VALUES
(1, 'Masculino'),
(2, 'Femenino');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `suscripcion`
--

CREATE TABLE `suscripcion` (
  `id_suscri` int(11) NOT NULL,
  `sus_tokenid` varchar(60) DEFAULT NULL,
  `sus_id_plan` int(11) DEFAULT NULL,
  `sus_estado` int(11) DEFAULT NULL,
  `sus_num_fact` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `telefono`
--

CREATE TABLE `telefono` (
  `id_telefono` int(11) NOT NULL,
  `tel_cod_tiptelefono` int(3) NOT NULL,
  `tel_telefono` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `telefono`
--

INSERT INTO `telefono` (`id_telefono`, `tel_cod_tiptelefono`, `tel_telefono`) VALUES
(1, 1, 8728425),
(2, 2, 8719254),
(3, 2, 8719254),
(4, 2, 8719254),
(5, 2, 8719254),
(6, 2, 8719254),
(7, 2, 8719254),
(8, 2, 8719254),
(9, 2, 8719254),
(10, 2, 8719254),
(11, 2, 8719254),
(12, 2, 8719254),
(13, 2, 8719254),
(14, 2, 8719254),
(15, 2, 8719254),
(16, 2, 8719254),
(17, 2, 8719254),
(18, 2, 8719254),
(19, 2, 8719254),
(20, 2, 8719254),
(21, 2, 8719254),
(22, 2, 8719254),
(23, 2, 8719254),
(24, 2, 8719254),
(25, 2, 8719254),
(26, 2, 8719254),
(27, 1, 4717008),
(28, 2, 8719254),
(29, 1, 1),
(30, 2, 8719254),
(31, 2, 8719254),
(32, 2, 8719254),
(33, 2, 8719254),
(34, 3, 1),
(35, 2, 8719254),
(36, 2, 8719254),
(37, 1, 4717008),
(38, 1, 50505),
(39, 2, 4717008),
(40, 1, 4701852),
(41, 1, 4701852),
(42, 1, 4165166),
(43, 1, 4165166),
(44, 1, 4165166),
(45, 2, 4165166),
(46, 1, 8813988),
(47, 1, 8298475),
(48, 1, 6562626),
(49, 2, 3177722),
(50, 2, 6587913),
(51, 1, 4717008),
(52, 1, 5402489),
(53, 1, 5915615),
(54, 1, 3215618),
(55, 1, 7898426);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_documento`
--

CREATE TABLE `tipo_documento` (
  `id_tipdoc` int(11) NOT NULL,
  `tip_descripcion` varchar(60) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_documento`
--

INSERT INTO `tipo_documento` (`id_tipdoc`, `tip_descripcion`) VALUES
(1, 'Cedula'),
(2, 'Pasaporte'),
(3, 'RNC');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_ncf`
--

CREATE TABLE `tipo_ncf` (
  `id_tipo_ncf` int(11) NOT NULL,
  `tip_ncf_descripcion` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tip_ncf_prefijo` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_ncf`
--

INSERT INTO `tipo_ncf` (`id_tipo_ncf`, `tip_ncf_descripcion`, `tip_ncf_prefijo`) VALUES
(1, 'Crédito fiscal (01)', 'B01'),
(2, 'Consumo (02)', 'B02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_persona`
--

CREATE TABLE `tipo_persona` (
  `id_tippersona` int(11) NOT NULL,
  `tip_descripcion` varchar(60) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_persona`
--

INSERT INTO `tipo_persona` (`id_tippersona`, `tip_descripcion`) VALUES
(1, 'Titular'),
(2, 'Dependiente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_telefono`
--

CREATE TABLE `tipo_telefono` (
  `id_tiptelefono` int(11) NOT NULL,
  `tip_indicativo_pais` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_telefono`
--

INSERT INTO `tipo_telefono` (`id_tiptelefono`, `tip_indicativo_pais`) VALUES
(1, 829),
(2, 849),
(3, 809);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuario`
--

CREATE TABLE `tipo_usuario` (
  `id_tipusuario` int(11) NOT NULL,
  `tip_descripcion` varchar(60) CHARACTER SET utf8mb4 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`id_tipusuario`, `tip_descripcion`) VALUES
(1, 'Administrador'),
(2, 'Cliente'),
(3, 'master');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `usu_cod_persona` int(11) DEFAULT NULL,
  `usu_nombre_user` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `usu_password` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `usu_cod_tipusuario` int(11) DEFAULT NULL,
  `usu_ultimoLogin` date DEFAULT NULL,
  `usu_fecha_registro` date DEFAULT NULL,
  `usu_estado` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `usu_cod_persona`, `usu_nombre_user`, `usu_password`, `usu_cod_tipusuario`, `usu_ultimoLogin`, `usu_fecha_registro`, `usu_estado`) VALUES
(1, 1, 'admin', '$2a$07$asxx54ahjppf45sd87a5auXBm1Vr2M1NV5t/zNQtGHGpS5fFirrbG', 1, '2022-08-09', NULL, 1),
(2, 6, 'daviel1234567', '$2a$07$asxx54ahjppf45sd87a5au6N2.8fE1Wfq6ch2KLBo3CbSUmisvrdi', 2, '2022-07-10', '2022-07-05', 1),
(14, 47, 'eddy', '$2a$07$asxx54ahjppf45sd87a5au6N2.8fE1Wfq6ch2KLBo3CbSUmisvrdi', 2, '2022-08-20', '2022-07-12', 1),
(15, 48, 'daivel', '$2a$07$asxx54ahjppf45sd87a5au6N2.8fE1Wfq6ch2KLBo3CbSUmisvrdi', 2, '2022-08-20', '2022-07-28', 1),
(16, 49, 'victor', '$2a$07$asxx54ahjppf45sd87a5au6N2.8fE1Wfq6ch2KLBo3CbSUmisvrdi', 2, '2022-08-02', '2022-08-02', 1),
(17, 50, 'mileysi', '$2a$07$asxx54ahjppf45sd87a5au6N2.8fE1Wfq6ch2KLBo3CbSUmisvrdi', 2, '2022-08-18', '2022-08-02', 1),
(18, 51, 'denicy', '$2a$07$asxx54ahjppf45sd87a5au6N2.8fE1Wfq6ch2KLBo3CbSUmisvrdi', 2, '2022-08-09', '2022-08-09', 1),
(19, 52, 'bolivar', '$2a$07$asxx54ahjppf45sd87a5au6N2.8fE1Wfq6ch2KLBo3CbSUmisvrdi', 2, '2022-08-09', '2022-08-09', 1),
(20, 53, 'ivellise', '$2a$07$asxx54ahjppf45sd87a5au6N2.8fE1Wfq6ch2KLBo3CbSUmisvrdi', 2, '2022-08-09', '2022-08-09', 1),
(23, 56, 'cristal', '$2a$07$asxx54ahjppf45sd87a5au6N2.8fE1Wfq6ch2KLBo3CbSUmisvrdi', 2, NULL, '2022-08-09', 1),
(24, 57, 'josefina', '$2a$07$asxx54ahjppf45sd87a5au6N2.8fE1Wfq6ch2KLBo3CbSUmisvrdi', 2, NULL, '2022-08-17', 1),
(25, 58, 'julio', '$2a$07$asxx54ahjppf45sd87a5au6N2.8fE1Wfq6ch2KLBo3CbSUmisvrdi', 2, NULL, '2022-08-17', 1),
(26, 59, 'amatina', '$2a$07$asxx54ahjppf45sd87a5au6N2.8fE1Wfq6ch2KLBo3CbSUmisvrdi', 2, NULL, '2022-08-20', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `condicion_factura`
--
ALTER TABLE `condicion_factura`
  ADD PRIMARY KEY (`id_codicion_factura`);

--
-- Indices de la tabla `detalle_factura`
--
ALTER TABLE `detalle_factura`
  ADD KEY `det_cod_factura` (`det_cod_factura`),
  ADD KEY `det_cod_prod` (`det_cod_prod`),
  ADD KEY `det_cod_plan` (`det_cod_plan`);

--
-- Indices de la tabla `documento`
--
ALTER TABLE `documento`
  ADD PRIMARY KEY (`id_documento`),
  ADD KEY `doc_cod_tipdocumento` (`doc_cod_tipdocumento`);

--
-- Indices de la tabla `estado_civil`
--
ALTER TABLE `estado_civil`
  ADD PRIMARY KEY (`id_estcivil`);

--
-- Indices de la tabla `estado_factura`
--
ALTER TABLE `estado_factura`
  ADD PRIMARY KEY (`id_estado_factura`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`id_fact`),
  ADD KEY `cod_usuario` (`fac_cod_usuario`),
  ADD KEY `fac_tipo_ncf` (`fac_tipo_ncf`),
  ADD KEY `fac_estado` (`fac_estado`),
  ADD KEY `fac_cod_condicion` (`fac_cod_condicion`);

--
-- Indices de la tabla `municipio`
--
ALTER TABLE `municipio`
  ADD PRIMARY KEY (`id_municipio`),
  ADD KEY `mun_cod_provincia` (`mun_cod_provincia`);

--
-- Indices de la tabla `pagos_factura`
--
ALTER TABLE `pagos_factura`
  ADD PRIMARY KEY (`id_pagos`),
  ADD KEY `pag_cod_factura` (`pag_cod_factura`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`id_persona`),
  ADD KEY `cod_tel` (`per_cod_tel`),
  ADD KEY `cod_sexo` (`per_cod_sexo`),
  ADD KEY `cod_estcivil` (`per_cod_estcivil`),
  ADD KEY `cod_tippersona` (`per_tipo_persona`),
  ADD KEY `per_cod_sector` (`per_cod_sector`),
  ADD KEY `documento` (`per_cod_documento`);

--
-- Indices de la tabla `planes`
--
ALTER TABLE `planes`
  ADD PRIMARY KEY (`id_plan`);

--
-- Indices de la tabla `planes_servicios`
--
ALTER TABLE `planes_servicios`
  ADD KEY `cod_plan` (`pla_cod_plan`),
  ADD KEY `cod_serv` (`pla_cod_serv`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indices de la tabla `provincia`
--
ALTER TABLE `provincia`
  ADD PRIMARY KEY (`id_provincia`);

--
-- Indices de la tabla `sector`
--
ALTER TABLE `sector`
  ADD PRIMARY KEY (`id_sector`),
  ADD KEY `sec_cod_municipio` (`sec_cod_municipio`);

--
-- Indices de la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD PRIMARY KEY (`id_servicio`);

--
-- Indices de la tabla `sexo`
--
ALTER TABLE `sexo`
  ADD PRIMARY KEY (`id_sexo`);

--
-- Indices de la tabla `suscripcion`
--
ALTER TABLE `suscripcion`
  ADD PRIMARY KEY (`id_suscri`),
  ADD KEY `sus_id_plan` (`sus_id_plan`),
  ADD KEY `sus_num_fact` (`sus_num_fact`);

--
-- Indices de la tabla `telefono`
--
ALTER TABLE `telefono`
  ADD PRIMARY KEY (`id_telefono`),
  ADD KEY `cod_tiptelefono` (`tel_cod_tiptelefono`);

--
-- Indices de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
  ADD PRIMARY KEY (`id_tipdoc`);

--
-- Indices de la tabla `tipo_ncf`
--
ALTER TABLE `tipo_ncf`
  ADD PRIMARY KEY (`id_tipo_ncf`);

--
-- Indices de la tabla `tipo_persona`
--
ALTER TABLE `tipo_persona`
  ADD PRIMARY KEY (`id_tippersona`);

--
-- Indices de la tabla `tipo_telefono`
--
ALTER TABLE `tipo_telefono`
  ADD PRIMARY KEY (`id_tiptelefono`);

--
-- Indices de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  ADD PRIMARY KEY (`id_tipusuario`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `cod_persona` (`usu_cod_persona`),
  ADD KEY `cod_tipusuario` (`usu_cod_tipusuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `condicion_factura`
--
ALTER TABLE `condicion_factura`
  MODIFY `id_codicion_factura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `documento`
--
ALTER TABLE `documento`
  MODIFY `id_documento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `estado_civil`
--
ALTER TABLE `estado_civil`
  MODIFY `id_estcivil` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `estado_factura`
--
ALTER TABLE `estado_factura`
  MODIFY `id_estado_factura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `id_fact` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `municipio`
--
ALTER TABLE `municipio`
  MODIFY `id_municipio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `pagos_factura`
--
ALTER TABLE `pagos_factura`
  MODIFY `id_pagos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `id_persona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT de la tabla `planes`
--
ALTER TABLE `planes`
  MODIFY `id_plan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `provincia`
--
ALTER TABLE `provincia`
  MODIFY `id_provincia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `sector`
--
ALTER TABLE `sector`
  MODIFY `id_sector` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `servicio`
--
ALTER TABLE `servicio`
  MODIFY `id_servicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `sexo`
--
ALTER TABLE `sexo`
  MODIFY `id_sexo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `suscripcion`
--
ALTER TABLE `suscripcion`
  MODIFY `id_suscri` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `telefono`
--
ALTER TABLE `telefono`
  MODIFY `id_telefono` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
  MODIFY `id_tipdoc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipo_ncf`
--
ALTER TABLE `tipo_ncf`
  MODIFY `id_tipo_ncf` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipo_persona`
--
ALTER TABLE `tipo_persona`
  MODIFY `id_tippersona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tipo_telefono`
--
ALTER TABLE `tipo_telefono`
  MODIFY `id_tiptelefono` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  MODIFY `id_tipusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_factura`
--
ALTER TABLE `detalle_factura`
  ADD CONSTRAINT `detalle_factura_ibfk_1` FOREIGN KEY (`det_cod_prod`) REFERENCES `producto` (`id_producto`),
  ADD CONSTRAINT `detalle_factura_ibfk_3` FOREIGN KEY (`det_cod_plan`) REFERENCES `planes` (`id_plan`),
  ADD CONSTRAINT `detalle_factura_ibfk_4` FOREIGN KEY (`det_cod_factura`) REFERENCES `factura` (`id_fact`);

--
-- Filtros para la tabla `documento`
--
ALTER TABLE `documento`
  ADD CONSTRAINT `documento_ibfk_1` FOREIGN KEY (`doc_cod_tipdocumento`) REFERENCES `tipo_documento` (`id_tipdoc`);

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `factura_ibfk_2` FOREIGN KEY (`fac_cod_usuario`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `factura_ibfk_4` FOREIGN KEY (`fac_tipo_ncf`) REFERENCES `tipo_ncf` (`id_tipo_ncf`),
  ADD CONSTRAINT `factura_ibfk_5` FOREIGN KEY (`fac_estado`) REFERENCES `estado_factura` (`id_estado_factura`),
  ADD CONSTRAINT `factura_ibfk_6` FOREIGN KEY (`fac_cod_condicion`) REFERENCES `condicion_factura` (`id_codicion_factura`);

--
-- Filtros para la tabla `municipio`
--
ALTER TABLE `municipio`
  ADD CONSTRAINT `municipio_ibfk_1` FOREIGN KEY (`mun_cod_provincia`) REFERENCES `provincia` (`id_provincia`);

--
-- Filtros para la tabla `pagos_factura`
--
ALTER TABLE `pagos_factura`
  ADD CONSTRAINT `pagos_factura_ibfk_1` FOREIGN KEY (`pag_cod_factura`) REFERENCES `factura` (`id_fact`);

--
-- Filtros para la tabla `persona`
--
ALTER TABLE `persona`
  ADD CONSTRAINT `persona_ibfk_1` FOREIGN KEY (`per_cod_tel`) REFERENCES `telefono` (`id_telefono`),
  ADD CONSTRAINT `persona_ibfk_2` FOREIGN KEY (`per_cod_sexo`) REFERENCES `sexo` (`id_sexo`),
  ADD CONSTRAINT `persona_ibfk_3` FOREIGN KEY (`per_cod_estcivil`) REFERENCES `estado_civil` (`id_estcivil`),
  ADD CONSTRAINT `persona_ibfk_4` FOREIGN KEY (`per_tipo_persona`) REFERENCES `tipo_persona` (`id_tippersona`),
  ADD CONSTRAINT `persona_ibfk_6` FOREIGN KEY (`per_cod_sector`) REFERENCES `sector` (`id_sector`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `persona_ibfk_7` FOREIGN KEY (`per_cod_documento`) REFERENCES `documento` (`id_documento`);

--
-- Filtros para la tabla `planes_servicios`
--
ALTER TABLE `planes_servicios`
  ADD CONSTRAINT `planes_servicios_ibfk_1` FOREIGN KEY (`pla_cod_plan`) REFERENCES `planes` (`id_plan`),
  ADD CONSTRAINT `planes_servicios_ibfk_2` FOREIGN KEY (`pla_cod_serv`) REFERENCES `servicio` (`id_servicio`);

--
-- Filtros para la tabla `sector`
--
ALTER TABLE `sector`
  ADD CONSTRAINT `sector_ibfk_1` FOREIGN KEY (`sec_cod_municipio`) REFERENCES `municipio` (`id_municipio`);

--
-- Filtros para la tabla `suscripcion`
--
ALTER TABLE `suscripcion`
  ADD CONSTRAINT `suscripcion_ibfk_1` FOREIGN KEY (`sus_id_plan`) REFERENCES `planes` (`id_plan`),
  ADD CONSTRAINT `suscripcion_ibfk_2` FOREIGN KEY (`sus_num_fact`) REFERENCES `factura` (`id_fact`);

--
-- Filtros para la tabla `telefono`
--
ALTER TABLE `telefono`
  ADD CONSTRAINT `telefono_ibfk_1` FOREIGN KEY (`tel_cod_tiptelefono`) REFERENCES `tipo_telefono` (`id_tiptelefono`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`usu_cod_persona`) REFERENCES `persona` (`id_persona`),
  ADD CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`usu_cod_tipusuario`) REFERENCES `tipo_usuario` (`id_tipusuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
