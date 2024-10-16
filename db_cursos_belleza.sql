-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-10-2024 a las 23:51:45
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_cursos_belleza`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `ID_alumno` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `dni` int(11) NOT NULL,
  `celular` bigint(20) NOT NULL,
  `domicilio` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`ID_alumno`, `nombre`, `apellido`, `dni`, `celular`, `domicilio`) VALUES
(1, 'Sofía ', 'Perez', 59123456, 2494635821, 'Las Heras 128'),
(2, 'Nancy ', 'Fernandez', 25963852, 2494785212, 'Pinto 714'),
(3, 'Stella', 'Zubiaurre', 35456985, 2494567154, 'Paz 808'),
(4, 'Pía', 'Hernandez', 40566396, 2494512087, 'Montiel 471'),
(5, 'Lucia', 'Garcia', 46444258, 2494635986, 'Av. Colon 102');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `ID_curso` int(11) NOT NULL,
  `categoria` varchar(45) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `duracion` varchar(45) NOT NULL,
  `profesor` varchar(45) NOT NULL,
  `costo` int(11) NOT NULL,
  `imagen` varchar(700) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`ID_curso`, `categoria`, `nombre`, `descripcion`, `duracion`, `profesor`, `costo`, `imagen`) VALUES
(1, 'Maquillaje', 'Maquillaje profesional', 'Curso de automaquilaje profesional', '3 meses', 'Luisa Hernandez', 90000, ''),
(2, 'Uñas', 'Esmaltado de Uñas', 'Curso de esmaltado y semipermanente de uñas', '2 meses', 'Ana Rusconi', 60000, ''),
(3, 'Peluqueria', 'Peluquería en general', 'Curso de peluquería general y peinados para eventos ', '8 meses', 'María Barbieri', 200000, ''),
(4, 'Cuidados', 'Tratamientos faciales profesionales', 'Curso de cosmetología', '3 meses', 'Analía Etcheberry', 80000, ''),
(7, 'uñas', 'curso de uñas esculpidas', 'ffffffffffffffffff', '3 meses', 'Nilda Nieves', 200000, 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.bellabellezaysalud.com.ar%2Fproducto%2Funas-esculpidas%2F&psig=AOvVaw2UIDOKTOLiWq3FjITaksIp&ust=1729197279850000&source=images&cd=vfe&opi=89978449');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscriptos`
--

CREATE TABLE `inscriptos` (
  `ID_inscripcion` int(11) NOT NULL,
  `ID_alumno` int(11) NOT NULL,
  `ID_curso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `inscriptos`
--

INSERT INTO `inscriptos` (`ID_inscripcion`, `ID_alumno`, `ID_curso`) VALUES
(1, 2, 4),
(2, 5, 2),
(3, 4, 3),
(4, 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` char(60) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `email`, `password`, `role`) VALUES
(1, 'luciaalcibar@gmail.com', '$2y$10$1/mq1.DjJh/KPVLNpyq7N.ziMx/0T.qGDVVRxfMbcUfjx04Ns9Bs2', 'user'),
(2, 'webadmin', '$2y$10$n9Nzmkn5miBKbGBpcX1hled/OMT3YRGrknde9JOzlt7tVe6KTYCNK', 'admin');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`ID_alumno`),
  ADD UNIQUE KEY `dni` (`dni`),
  ADD UNIQUE KEY `numero_de_celular` (`celular`);

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`ID_curso`);

--
-- Indices de la tabla `inscriptos`
--
ALTER TABLE `inscriptos`
  ADD PRIMARY KEY (`ID_inscripcion`),
  ADD KEY `ID_curso` (`ID_curso`),
  ADD KEY `ID_alumno` (`ID_alumno`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  MODIFY `ID_alumno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
  MODIFY `ID_curso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `inscriptos`
--
ALTER TABLE `inscriptos`
  MODIFY `ID_inscripcion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `inscriptos`
--
ALTER TABLE `inscriptos`
  ADD CONSTRAINT `inscriptos_ibfk_1` FOREIGN KEY (`ID_curso`) REFERENCES `cursos` (`ID_curso`),
  ADD CONSTRAINT `inscriptos_ibfk_2` FOREIGN KEY (`ID_alumno`) REFERENCES `alumnos` (`ID_alumno`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
