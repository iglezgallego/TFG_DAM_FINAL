-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-05-2024 a las 18:37:28
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `examup`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `exams`
--

CREATE TABLE `exams` (
  `id_exam` int(255) NOT NULL,
  `gid_exam` varchar(255) NOT NULL,
  `gid_user` varchar(255) NOT NULL,
  `title` text NOT NULL,
  `date_created` date NOT NULL,
  `date_updated` date NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `exams`
--

INSERT INTO `exams` (`id_exam`, `gid_exam`, `gid_user`, `title`, `date_created`, `date_updated`, `status`) VALUES
(4, '12', '69736162656c69736162656c40676d61696c2e636f6d', 'prueba3', '2024-04-01', '2024-05-10', 'bi bi-people-fill'),
(5, '13', '616c626572746f616c626572746f40676d61696c2e636f6d', 'examen de Alberto', '2024-04-03', '2024-04-04', 'bi bi-person-fill-lock'),
(31, 'a96f13190cb6a22d04cf30b035a2c417693c9ed891495133f46cea37f849925a', '69736169736140676d61696c2e636f6d', 'Examen de prueba 2', '2024-05-01', '2024-05-01', 'bi bi-people-fill'),
(34, '6fc166f112e551c10c9225abc483baaf19123ac4aefb09349c496ba4be466289', '69736169736140676d61696c2e636f6d', 'Examen isa prueba', '2024-05-05', '2024-05-05', 'bi bi-person-fill-lock'),
(35, '3b4032250860abf7e3ec2ead6068eadac53862ccf8ea6352feef3e8aeff722b3', '69736169736140676d61696c2e636f6d', 'Examen de Isabel ', '2024-05-05', '2024-05-05', 'bi bi-person-fill-lock'),
(36, '99e58e98078257c7033575e5e6f738f833cf2f656f1f3adbd703be25aaae8764', '69736162656c69736162656c40676d61696c2e636f6d', 'Examen tipo test en Economía', '2024-05-05', '0000-00-00', 'bi bi-person-fill-lock'),
(37, '7f5a6945232135c32ff73643d7c23a0fe62ee57536a200e7aa07b719d7efb7f2', '726f7361726f736140676d61696c2e636f6d', 'Examen de geografía', '2024-05-10', '2024-05-10', 'bi bi-people-fill'),
(38, 'e2043ca955ab0b56538b0ef66708a54768d11c526ae7a8960a11542c72ea2e61', '69736169736140676d61696c2e636f6d', 'Examen prueba en inglés', '2024-05-12', '0000-00-00', 'bi bi-person-fill-lock'),
(39, '5876ada07e0b10dfab549d5e9ce6f1043bced2a4929c545f913658865a199e0a', '69736169736140676d61696c2e636f6d', 'Prueba ingles 2', '2024-05-12', '0000-00-00', 'bi bi-person-fill-lock'),
(40, '7a58ec621dbcb1ff925a4b273e7232e1a9984954db994469022e0992fe624224', '69736169736140676d61696c2e636f6d', 'Examen de Biología 1 ESO', '2024-05-17', '2024-05-17', 'bi bi-people-fill'),
(41, 'ce6d564257e4bae7e28fb5dc7e77911e8f737a1ff6df60e65c88780aa6d33dbc', '69736169736140676d61696c2e636f6d', 'Prueba examen publico', '2024-05-25', '2024-05-25', 'bi bi-person-fill-lock'),
(46, '5021c7ff20afd4b30d8c50a88e794f43cec5defcc48ae413c6f0cb34cdd064c7', '69736169736140676d61696c2e636f6d', 'Prueba condiciones 2', '2024-05-26', '0000-00-00', 'bi bi-person-fill-lock'),
(51, 'd7cc95bddb9b9ab627662157f77a9410415541a801794f3ec649d47fd8c860ce', '69736169736140676d61696c2e636f6d', 'Examen de España 2', '2024-05-26', '2024-05-26', 'bi bi-person-fill-lock'),
(52, 'ac9e1da90053b0641d44e746bbceef1b31bd9d78fb7c51f20d784cbab89955b3', '69736169736140676d61696c2e636f6d', 'Prueba 4', '2024-05-26', '0000-00-00', 'bi bi-people-fill');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `favorites`
--

CREATE TABLE `favorites` (
  `id_favorite` int(11) NOT NULL,
  `gid_exam` varchar(255) NOT NULL,
  `gid_user` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `favorites`
--

INSERT INTO `favorites` (`id_favorite`, `gid_exam`, `gid_user`) VALUES
(72, '12', '726f7361726f736140676d61696c2e636f6d'),
(73, '7f5a6945232135c32ff73643d7c23a0fe62ee57536a200e7aa07b719d7efb7f2', '726f7361726f736140676d61696c2e636f6d'),
(78, '7a58ec621dbcb1ff925a4b273e7232e1a9984954db994469022e0992fe624224', '6d616e6f6c6f6d616e6f6c6f406d61696c2e636f6d'),
(79, 'a96f13190cb6a22d04cf30b035a2c417693c9ed891495133f46cea37f849925a', '6d616e6f6c6f6d616e6f6c6f406d61696c2e636f6d'),
(83, '6fc166f112e551c10c9225abc483baaf19123ac4aefb09349c496ba4be466289', '69736169736140676d61696c2e636f6d'),
(85, '7a58ec621dbcb1ff925a4b273e7232e1a9984954db994469022e0992fe624224', '69736169736140676d61696c2e636f6d'),
(91, '99e58e98078257c7033575e5e6f738f833cf2f656f1f3adbd703be25aaae8764', '69736162656c69736162656c40676d61696c2e636f6d'),
(92, '12', '69736162656c69736162656c40676d61696c2e636f6d'),
(93, 'ac9e1da90053b0641d44e746bbceef1b31bd9d78fb7c51f20d784cbab89955b3', '69736169736140676d61696c2e636f6d'),
(96, '7f5a6945232135c32ff73643d7c23a0fe62ee57536a200e7aa07b719d7efb7f2', '69736169736140676d61696c2e636f6d');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `languages`
--

CREATE TABLE `languages` (
  `id_language` int(255) NOT NULL,
  `code_name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `lang_key` int(255) NOT NULL,
  `img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `languages`
--

INSERT INTO `languages` (`id_language`, `code_name`, `description`, `lang_key`, `img`) VALUES
(1, 'es_ES', 'Español', 779442001, 'espana.png'),
(2, 'en_EN', 'English', 779442002, 'uk.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `questions`
--

CREATE TABLE `questions` (
  `id_question` int(255) NOT NULL,
  `gid_exam` varchar(255) NOT NULL,
  `type_key` int(255) NOT NULL,
  `sentence` text NOT NULL,
  `options` text NOT NULL,
  `multioption` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `questions`
--

INSERT INTO `questions` (`id_question`, `gid_exam`, `type_key`, `sentence`, `options`, `multioption`) VALUES
(57, 'a96f13190cb6a22d04cf30b035a2c417693c9ed891495133f46cea37f849925a', 779442001, '¿Cómo se llama mi madre?', '[{\"answer\":\"Clara\",\"correct\":false},{\"answer\":\"María\",\"correct\":false},{\"answer\":\"Rosa\",\"correct\":true}]', 0),
(58, 'a96f13190cb6a22d04cf30b035a2c417693c9ed891495133f46cea37f849925a', 779442001, '¿Cómo se llama mi padre?', '[{\"answer\":\"Joaquin\",\"correct\":true},{\"answer\":\"Fernando\",\"correct\":false},{\"answer\":\"Francisco\",\"correct\":false}]', 0),
(59, 'a96f13190cb6a22d04cf30b035a2c417693c9ed891495133f46cea37f849925a', 779442001, '¿Cómo se llaman mis gatos?', '[{\"answer\":\"Pepe\",\"correct\":false},{\"answer\":\"Ciri\",\"correct\":true},{\"answer\":\"Coco\",\"correct\":false},{\"answer\":\"Choli\",\"correct\":true}]', 1),
(60, 'a96f13190cb6a22d04cf30b035a2c417693c9ed891495133f46cea37f849925a', 779442001, '¿Cómo se llama mi pueblo?', '[{\"answer\":\"Aldaia\",\"correct\":false},{\"answer\":\"Daimiel\",\"correct\":true},{\"answer\":\"Almagro\",\"correct\":false}]', 0),
(61, 'a96f13190cb6a22d04cf30b035a2c417693c9ed891495133f46cea37f849925a', 779442001, '¿Cómo se llama mi hermano?', '[{\"answer\":\"Juan\",\"correct\":false},{\"answer\":\"Alberto\",\"correct\":true},{\"answer\":\"Pedro\",\"correct\":false}]', 0),
(76, '6fc166f112e551c10c9225abc483baaf19123ac4aefb09349c496ba4be466289', 779442001, '¿De que color es el cielo?', '[{\"answer\":\"Verde\",\"correct\":false},{\"answer\":\"Rojo\",\"correct\":false},{\"answer\":\"Azul\",\"correct\":true}]', 0),
(77, '6fc166f112e551c10c9225abc483baaf19123ac4aefb09349c496ba4be466289', 779442001, '¿De que color es ciri?', '[{\"answer\":\"Negro\",\"correct\":true},{\"answer\":\"Blanco\",\"correct\":true},{\"answer\":\"Ninguna de las anteriores\",\"correct\":false}]', 1),
(78, '6fc166f112e551c10c9225abc483baaf19123ac4aefb09349c496ba4be466289', 779442001, '¿Cuántos años tengo?', '[{\"answer\":\"25\",\"correct\":false},{\"answer\":\"30\",\"correct\":false},{\"answer\":\"31\",\"correct\":true},{\"answer\":\"47\",\"correct\":false}]', 0),
(83, '3b4032250860abf7e3ec2ead6068eadac53862ccf8ea6352feef3e8aeff722b3', 779442001, '¿Cuál es mi color preferido?', '[{\"answer\":\"Azul\",\"correct\":false},{\"answer\":\"Rosa\",\"correct\":false},{\"answer\":\"Morado\",\"correct\":true}]', 0),
(84, '3b4032250860abf7e3ec2ead6068eadac53862ccf8ea6352feef3e8aeff722b3', 779442001, '¿Dónde vivo?', '[{\"answer\":\"Madrid\",\"correct\":false},{\"answer\":\"Daimiel\",\"correct\":false},{\"answer\":\"Valencia\",\"correct\":true}]', 0),
(85, '3b4032250860abf7e3ec2ead6068eadac53862ccf8ea6352feef3e8aeff722b3', 779442001, '¿Cuánto es 2 + 2?', '[{\"answer\":\"7\",\"correct\":false},{\"answer\":\"4\",\"correct\":true},{\"answer\":\"9\",\"correct\":false}]', 0),
(86, '3b4032250860abf7e3ec2ead6068eadac53862ccf8ea6352feef3e8aeff722b3', 779442001, '¿Cuáles son mis comidas preferidas?', '[{\"answer\":\"Pizza\",\"correct\":true},{\"answer\":\"Ensalada\",\"correct\":true},{\"answer\":\"Potaje\",\"correct\":false},{\"answer\":\"Sopa\",\"correct\":false}]', 1),
(87, '99e58e98078257c7033575e5e6f738f833cf2f656f1f3adbd703be25aaae8764', 779442001, ' Los accionistas de una sociedad:', '[{\"answer\":\"Tienen responsabilidad limitada\",\"correct\":false},{\"answer\":\"Deben desembolsar el 100% del capital.\",\"correct\":false},{\"answer\":\"El capital mínimo es 60.000€ que deben desembolsar en su creación al menos el 25% de este.\",\"correct\":true}]', 0),
(88, '99e58e98078257c7033575e5e6f738f833cf2f656f1f3adbd703be25aaae8764', 779442001, ' La dimensión de una empresa es:', '[{\"answer\":\"El tamaño físico o espacio que ocupan las explotaciones.\",\"correct\":false},{\"answer\":\"La capacidad de producción de las explotaciones.\",\"correct\":true},{\"answer\":\"La tasa máxima de producción en condiciones extraordinariamente favorables.\",\"correct\":false}]', 0),
(89, '99e58e98078257c7033575e5e6f738f833cf2f656f1f3adbd703be25aaae8764', 779442001, 'Si se constituye una S.A. con un capital social inicial suscrito de 120.000 euros, los socios fundadores tienen la obligación de desembolsar, como mínimo, en el momento de la constitución:', '[{\"answer\":\"50.000€.\",\"correct\":false},{\"answer\":\"30.000€\",\"correct\":true},{\"answer\":\"La totalidad del capital, 120.000€\",\"correct\":false}]', 0),
(90, '99e58e98078257c7033575e5e6f738f833cf2f656f1f3adbd703be25aaae8764', 779442001, '¿Cuál de los siguientes tipos de sociedades es personalista?:', '[{\"answer\":\" Una sociedad anónima\",\"correct\":false},{\"answer\":\"Una sociedad comanditaria.\",\"correct\":true},{\"answer\":\"Una sociedad limitada\",\"correct\":false}]', 0),
(91, '99e58e98078257c7033575e5e6f738f833cf2f656f1f3adbd703be25aaae8764', 779442001, 'Teniendo en cuenta el número de trabajadores, una empresa con 450 empleados es:', '[{\"answer\":\" Pequeña.\",\"correct\":false},{\"answer\":\"Mediana.\",\"correct\":false},{\"answer\":\" Grande\",\"correct\":true}]', 0),
(95, '12', 779442001, 'prueba', '[{\"answer\":\"a\",\"correct\":true},{\"answer\":\"b\",\"correct\":false},{\"answer\":\"c\",\"correct\":false}]', 0),
(96, '12', 779442001, 'prueba 2', '[{\"answer\":\"a\",\"correct\":false},{\"answer\":\"b\",\"correct\":true},{\"answer\":\"c\",\"correct\":false}]', 0),
(104, '7f5a6945232135c32ff73643d7c23a0fe62ee57536a200e7aa07b719d7efb7f2', 779442001, '¿Cual es la capital de Argentina?', '[{\"answer\":\"Buenos Aires\",\"correct\":true},{\"answer\":\"Chipre\",\"correct\":false},{\"answer\":\"Puerto Plata\",\"correct\":false}]', 0),
(105, '7f5a6945232135c32ff73643d7c23a0fe62ee57536a200e7aa07b719d7efb7f2', 779442001, '¿Dónde están las cataratas Victoria?', '[{\"answer\":\"Asia\",\"correct\":false},{\"answer\":\"Europa\",\"correct\":false},{\"answer\":\"Africa\",\"correct\":true},{\"answer\":\"América\",\"correct\":false}]', 0),
(106, '7f5a6945232135c32ff73643d7c23a0fe62ee57536a200e7aa07b719d7efb7f2', 779442001, '¿Cuales de estas ciudades pertenecen a Castilla La Mancha?', '[{\"answer\":\"Cuenca\",\"correct\":true},{\"answer\":\"Salamanca\",\"correct\":false},{\"answer\":\"Alicante\",\"correct\":false},{\"answer\":\"Guadalajara\",\"correct\":true}]', 1),
(107, '7f5a6945232135c32ff73643d7c23a0fe62ee57536a200e7aa07b719d7efb7f2', 779442001, 'JAHSHSHS', '[{\"answer\":\"GVGRB\",\"correct\":true},{\"answer\":\"BGBGB\",\"correct\":false}]', 0),
(108, 'e2043ca955ab0b56538b0ef66708a54768d11c526ae7a8960a11542c72ea2e61', 779442001, 'What is my name?', '[{\"answer\":\"Rita\",\"correct\":false},{\"answer\":\"Anna\",\"correct\":false},{\"answer\":\"Isabel\",\"correct\":true}]', 0),
(109, 'e2043ca955ab0b56538b0ef66708a54768d11c526ae7a8960a11542c72ea2e61', 779442001, 'How old am I?', '[{\"answer\":\"13\",\"correct\":false},{\"answer\":\"32\",\"correct\":true},{\"answer\":\"26\",\"correct\":false}]', 0),
(110, '5876ada07e0b10dfab549d5e9ce6f1043bced2a4929c545f913658865a199e0a', 779442001, 'jajaja', '[{\"answer\":\"rfrf\",\"correct\":false},{\"answer\":\"rgerg\",\"correct\":true},{\"answer\":\"grege\",\"correct\":false}]', 0),
(111, '5876ada07e0b10dfab549d5e9ce6f1043bced2a4929c545f913658865a199e0a', 779442001, 'grggr', '[{\"answer\":\"rgeg\",\"correct\":true},{\"answer\":\"rgeg\",\"correct\":false}]', 0),
(122, '7a58ec621dbcb1ff925a4b273e7232e1a9984954db994469022e0992fe624224', 779442001, '¿Cuál es el primer paso del Método Científico?', '[{\"answer\":\"Planteamiento del problema\",\"correct\":true},{\"answer\":\"Elaboración de una hipótesis\",\"correct\":false},{\"answer\":\"Análisis de resultados\",\"correct\":false}]', 0),
(123, '7a58ec621dbcb1ff925a4b273e7232e1a9984954db994469022e0992fe624224', 779442001, '¿Qué es una hipótesis en el Método Científico?', '[{\"answer\":\"Una idea que explica el problema planteado\",\"correct\":true},{\"answer\":\"Un experimento para comprobar la hipótesis\",\"correct\":false},{\"answer\":\"Una ley científica\",\"correct\":false}]', 0),
(124, '7a58ec621dbcb1ff925a4b273e7232e1a9984954db994469022e0992fe624224', 779442001, '¿En  qué  paso  del  Método  Científico  se  realiza  un  experimento  para comprobar la hipótesis?', '[{\"answer\":\"Paso 1 - Planteamiento del problema\",\"correct\":true},{\"answer\":\" Paso 2 - Elaboración de una hipótesis\",\"correct\":false},{\"answer\":\"Paso 3 - Experimentación para comprobar la hipótesis\",\"correct\":true},{\"answer\":\"Paso 4 - Análisis de resultados\",\"correct\":false},{\"answer\":\"Respuesta añadida\",\"correct\":false}]', 1),
(125, '7a58ec621dbcb1ff925a4b273e7232e1a9984954db994469022e0992fe624224', 779442001, 'fhffrrhf', '[{\"answer\":\"frfrefgfgggbgfb\",\"correct\":true},{\"answer\":\"frfref\",\"correct\":false}]', 0),
(132, 'ce6d564257e4bae7e28fb5dc7e77911e8f737a1ff6df60e65c88780aa6d33dbc', 779442001, 'feref', '[{\"answer\":\"hyhyh\",\"correct\":true},{\"answer\":\"yhyh\",\"correct\":false},{\"answer\":\"yhtyhhyhy\",\"correct\":false},{\"answer\":\"rrrtttt\",\"correct\":true}]', 1),
(138, '5021c7ff20afd4b30d8c50a88e794f43cec5defcc48ae413c6f0cb34cdd064c7', 779442001, 'Como estas??', '[{\"answer\":\"Bien\",\"correct\":false},{\"answer\":\"Mal\",\"correct\":true},{\"answer\":\"Regular\",\"correct\":false}]', 0),
(139, '5021c7ff20afd4b30d8c50a88e794f43cec5defcc48ae413c6f0cb34cdd064c7', 779442001, '¿Cuál es mi color preferido?', '[{\"answer\":\"Azul\",\"correct\":true},{\"answer\":\"Verde\",\"correct\":false},{\"answer\":\"Marrón\",\"correct\":true}]', 1),
(166, 'ac9e1da90053b0641d44e746bbceef1b31bd9d78fb7c51f20d784cbab89955b3', 779442001, 'rfrfrg', '[{\"answer\":\"tgtg\",\"correct\":false},{\"answer\":\"tgrtg\",\"correct\":true}]', 0),
(167, 'ac9e1da90053b0641d44e746bbceef1b31bd9d78fb7c51f20d784cbab89955b3', 779442001, 'gtgtgt', '[{\"answer\":\"tgtgtggtrg\",\"correct\":true},{\"answer\":\"gfffff\",\"correct\":false}]', 0),
(168, 'ac9e1da90053b0641d44e746bbceef1b31bd9d78fb7c51f20d784cbab89955b3', 779442001, 'jajajajjajaja', '[{\"answer\":\"fgtgtthhyh\",\"correct\":false},{\"answer\":\"yhyhythythyhy\",\"correct\":true},{\"answer\":\"ythtythythythtyhtyhyt\",\"correct\":true}]', 1),
(169, 'd7cc95bddb9b9ab627662157f77a9410415541a801794f3ec649d47fd8c860ce', 779442001, '¿Como se llama el rey de España?', '[{\"answer\":\"Pedro\",\"correct\":true},{\"answer\":\"Felipe\",\"correct\":false},{\"answer\":\"Juan Carlos\",\"correct\":false}]', 0),
(170, 'd7cc95bddb9b9ab627662157f77a9410415541a801794f3ec649d47fd8c860ce', 779442001, '¿Cual es la capital de España?', '[{\"answer\":\"Valencia\",\"correct\":true},{\"answer\":\"Madrid\",\"correct\":false},{\"answer\":\"Toledo\",\"correct\":false}]', 0),
(171, 'd7cc95bddb9b9ab627662157f77a9410415541a801794f3ec649d47fd8c860ce', 779442001, '¿Que numero te gusta?', '[{\"answer\":\"1\",\"correct\":true},{\"answer\":\"2\",\"correct\":true},{\"answer\":\"3\",\"correct\":false}]', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `question_type`
--

CREATE TABLE `question_type` (
  `id_type` int(255) NOT NULL,
  `type_name` varchar(255) NOT NULL,
  `component_name` varchar(255) NOT NULL,
  `type_key` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `question_type`
--

INSERT INTO `question_type` (`id_type`, `type_name`, `component_name`, `type_key`) VALUES
(1, 'Test', 'option_test', 779442001),
(2, 'Order', 'option_order', 779442002),
(3, 'Fill', 'option_fill', 779442003);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `results`
--

CREATE TABLE `results` (
  `Identificador` int(255) NOT NULL,
  `gid_exam` varchar(255) NOT NULL,
  `gid_user` varchar(255) NOT NULL,
  `total_answers` int(255) NOT NULL,
  `correct_answers` int(255) NOT NULL,
  `result` float NOT NULL,
  `time` varchar(255) NOT NULL,
  `date_result` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `results`
--

INSERT INTO `results` (`Identificador`, `gid_exam`, `gid_user`, `total_answers`, `correct_answers`, `result`, `time`, `date_result`) VALUES
(6, 'a96f13190cb6a22d04cf30b035a2c417693c9ed891495133f46cea37f849925a', '69736169736140676d61696c2e636f6d', 5, 3, 60, '00:00:07', '2024-05-05 17:04:10.331958'),
(7, 'fad92181f006feafa6d34cfccc76eddb45ae1dfdd2d3033f7f0c8a932083d3ff', '69736169736140676d61696c2e636f6d', 1, 1, 100, '00:00:02', '2024-05-05 17:07:52.259349'),
(9, '6fc166f112e551c10c9225abc483baaf19123ac4aefb09349c496ba4be466289', '69736169736140676d61696c2e636f6d', 3, 1, 33.3333, '00:00:03', '2024-05-05 17:14:01.606995'),
(10, '6fc166f112e551c10c9225abc483baaf19123ac4aefb09349c496ba4be466289', '69736169736140676d61696c2e636f6d', 3, 3, 100, '00:00:33', '2024-05-05 17:18:15.913153'),
(11, 'fad92181f006feafa6d34cfccc76eddb45ae1dfdd2d3033f7f0c8a932083d3ff', '69736169736140676d61696c2e636f6d', 1, 1, 100, '00:00:23', '2024-05-05 17:23:57.600152'),
(12, '3b4032250860abf7e3ec2ead6068eadac53862ccf8ea6352feef3e8aeff722b3', '69736169736140676d61696c2e636f6d', 4, 2, 50, '00:00:28', '2024-05-05 17:30:19.464397'),
(13, '3b4032250860abf7e3ec2ead6068eadac53862ccf8ea6352feef3e8aeff722b3', '69736162656c69736162656c40676d61696c2e636f6d', 4, 0, 0, '00:00:08', '2024-05-05 18:12:23.147311'),
(14, '3b4032250860abf7e3ec2ead6068eadac53862ccf8ea6352feef3e8aeff722b3', '69736162656c69736162656c40676d61696c2e636f6d', 4, 3, 75, '00:01:12', '2024-05-05 18:13:57.426504'),
(15, '99e58e98078257c7033575e5e6f738f833cf2f656f1f3adbd703be25aaae8764', '69736162656c69736162656c40676d61696c2e636f6d', 5, 3, 60, '00:00:32', '2024-05-05 18:22:10.347317'),
(16, '99e58e98078257c7033575e5e6f738f833cf2f656f1f3adbd703be25aaae8764', '69736169736140676d61696c2e636f6d', 5, 2, 40, '00:00:10', '2024-05-05 18:23:35.208619'),
(17, '99e58e98078257c7033575e5e6f738f833cf2f656f1f3adbd703be25aaae8764', '69736169736140676d61696c2e636f6d', 5, 4, 80, '00:00:26', '2024-05-05 18:24:20.122344'),
(18, '3b4032250860abf7e3ec2ead6068eadac53862ccf8ea6352feef3e8aeff722b3', '69736169736140676d61696c2e636f6d', 4, 1, 25, '00:00:09', '2024-05-07 13:19:45.376702'),
(20, 'a96f13190cb6a22d04cf30b035a2c417693c9ed891495133f46cea37f849925a', '69736169736140676d61696c2e636f6d', 5, 3, 60, '00:00:08', '2024-05-07 15:32:33.933288'),
(32, '3b4032250860abf7e3ec2ead6068eadac53862ccf8ea6352feef3e8aeff722b3', '69736169736140676d61696c2e636f6d', 4, 2, 50, '00:00:51', '2024-05-07 19:27:00.179971'),
(33, '3b4032250860abf7e3ec2ead6068eadac53862ccf8ea6352feef3e8aeff722b3', '69736169736140676d61696c2e636f6d', 4, 2, 50, '00:00:10', '2024-05-07 19:28:07.695242'),
(37, '12', '69736162656c69736162656c40676d61696c2e636f6d', 2, 0, 0, '00:00:02', '2024-05-10 18:16:53.360298'),
(38, '12', '69736162656c69736162656c40676d61696c2e636f6d', 2, 0, 0, '00:00:02', '2024-05-10 18:17:01.534105'),
(39, '12', '69736162656c69736162656c40676d61696c2e636f6d', 2, 2, 100, '00:00:01', '2024-05-10 18:17:09.109961'),
(41, '12', '726f7361726f736140676d61696c2e636f6d', 2, 0, 0, '00:00:13', '2024-05-10 19:10:52.398036'),
(42, '7f5a6945232135c32ff73643d7c23a0fe62ee57536a200e7aa07b719d7efb7f2', '726f7361726f736140676d61696c2e636f6d', 4, 3, 75, '00:00:38', '2024-05-10 19:18:13.086290'),
(43, '7f5a6945232135c32ff73643d7c23a0fe62ee57536a200e7aa07b719d7efb7f2', '726f7361726f736140676d61696c2e636f6d', 4, 4, 100, '00:00:08', '2024-05-10 19:18:55.835503'),
(44, '7f5a6945232135c32ff73643d7c23a0fe62ee57536a200e7aa07b719d7efb7f2', '69736169736140676d61696c2e636f6d', 4, 3, 75, '00:00:06', '2024-05-10 19:20:14.760201'),
(49, '7a58ec621dbcb1ff925a4b273e7232e1a9984954db994469022e0992fe624224', '69736169736140676d61696c2e636f6d', 4, 2, 50, '00:01:10', '2024-05-17 07:28:38.322861'),
(50, '7a58ec621dbcb1ff925a4b273e7232e1a9984954db994469022e0992fe624224', '69736169736140676d61696c2e636f6d', 4, 4, 100, '00:00:18', '2024-05-17 07:31:13.687197'),
(51, '7a58ec621dbcb1ff925a4b273e7232e1a9984954db994469022e0992fe624224', '69736169736140676d61696c2e636f6d', 4, 3, 75, '00:00:08', '2024-05-17 07:31:35.322165'),
(52, '7a58ec621dbcb1ff925a4b273e7232e1a9984954db994469022e0992fe624224', '69736169736140676d61696c2e636f6d', 4, 2, 50, '00:00:20', '2024-05-17 07:32:55.914961'),
(53, '7a58ec621dbcb1ff925a4b273e7232e1a9984954db994469022e0992fe624224', '69736162656c69736162656c40676d61696c2e636f6d', 4, 4, 100, '00:00:12', '2024-05-17 07:34:36.056228'),
(54, '7a58ec621dbcb1ff925a4b273e7232e1a9984954db994469022e0992fe624224', '69736169736140676d61696c2e636f6d', 4, 3, 75, '00:03:37', '2024-05-25 19:19:57.377920'),
(55, '7f5a6945232135c32ff73643d7c23a0fe62ee57536a200e7aa07b719d7efb7f2', '69736169736140676d61696c2e636f6d', 4, 2, 50, '00:00:09', '2024-05-25 20:08:00.409961'),
(58, '5021c7ff20afd4b30d8c50a88e794f43cec5defcc48ae413c6f0cb34cdd064c7', '69736169736140676d61696c2e636f6d', 2, 2, 100, '00:00:06', '2024-05-26 12:31:19.492184'),
(61, '7a58ec621dbcb1ff925a4b273e7232e1a9984954db994469022e0992fe624224', '69736169736140676d61696c2e636f6d', 4, 4, 100, '00:00:35', '2024-05-26 13:02:16.313174'),
(62, 'd7cc95bddb9b9ab627662157f77a9410415541a801794f3ec649d47fd8c860ce', '69736169736140676d61696c2e636f6d', 3, 2, 66.67, '00:00:08', '2024-05-26 13:05:10.231383'),
(63, 'd7cc95bddb9b9ab627662157f77a9410415541a801794f3ec649d47fd8c860ce', '69736169736140676d61696c2e636f6d', 3, 2, 66.67, '00:00:05', '2024-05-26 13:05:21.799434'),
(64, 'd7cc95bddb9b9ab627662157f77a9410415541a801794f3ec649d47fd8c860ce', '69736169736140676d61696c2e636f6d', 3, 3, 100, '00:00:13', '2024-05-26 13:09:25.846777'),
(65, 'ac9e1da90053b0641d44e746bbceef1b31bd9d78fb7c51f20d784cbab89955b3', '69736169736140676d61696c2e636f6d', 3, 2, 66.67, '00:00:08', '2024-05-26 13:10:34.217894'),
(66, 'd7cc95bddb9b9ab627662157f77a9410415541a801794f3ec649d47fd8c860ce', '69736169736140676d61696c2e636f6d', 3, 3, 100, '00:00:09', '2024-05-26 13:18:33.876193'),
(67, 'd7cc95bddb9b9ab627662157f77a9410415541a801794f3ec649d47fd8c860ce', '69736169736140676d61696c2e636f6d', 3, 1, 33.33, '00:00:07', '2024-05-26 13:18:55.727526');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rols`
--

CREATE TABLE `rols` (
  `id_rol` int(255) NOT NULL,
  `rol_name` varchar(255) NOT NULL,
  `rol_key` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rols`
--

INSERT INTO `rols` (`id_rol`, `rol_name`, `rol_key`) VALUES
(1, 'user', 779442001),
(2, 'admin', 779442002);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `shared_exams`
--

CREATE TABLE `shared_exams` (
  `id_shared` int(255) NOT NULL,
  `gid_exam` varchar(255) NOT NULL,
  `gid_user` varchar(255) NOT NULL,
  `date_shared` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `shared_exams`
--

INSERT INTO `shared_exams` (`id_shared`, `gid_exam`, `gid_user`, `date_shared`) VALUES
(21, 'a96f13190cb6a22d04cf30b035a2c417693c9ed891495133f46cea37f849925a', '69736162656c69736162656c40676d61696c2e636f6d', '2024-05-01'),
(22, 'a96f13190cb6a22d04cf30b035a2c417693c9ed891495133f46cea37f849925a', '616c626572746f616c626572746f40676d61696c2e636f6d', '2024-05-01'),
(23, '6fc166f112e551c10c9225abc483baaf19123ac4aefb09349c496ba4be466289', '69736162656c69736162656c40676d61696c2e636f6d', '2024-05-05'),
(24, '3b4032250860abf7e3ec2ead6068eadac53862ccf8ea6352feef3e8aeff722b3', '69736162656c69736162656c40676d61696c2e636f6d', '2024-05-05'),
(25, '99e58e98078257c7033575e5e6f738f833cf2f656f1f3adbd703be25aaae8764', '69736169736140676d61696c2e636f6d', '2024-05-05'),
(27, '7f5a6945232135c32ff73643d7c23a0fe62ee57536a200e7aa07b719d7efb7f2', '69736169736140676d61696c2e636f6d', '2024-05-10'),
(30, '7a58ec621dbcb1ff925a4b273e7232e1a9984954db994469022e0992fe624224', '69736162656c69736162656c40676d61696c2e636f6d', '2024-05-17'),
(31, 'ce6d564257e4bae7e28fb5dc7e77911e8f737a1ff6df60e65c88780aa6d33dbc', '69736162656c69736162656c40676d61696c2e636f6d', '2024-05-25'),
(32, '5021c7ff20afd4b30d8c50a88e794f43cec5defcc48ae413c6f0cb34cdd064c7', '69736162656c69736162656c40676d61696c2e636f6d', '2024-05-26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `translations`
--

CREATE TABLE `translations` (
  `id_translation` int(255) NOT NULL,
  `component_name` varchar(255) NOT NULL,
  `es_ES` text NOT NULL,
  `en_EN` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `translations`
--

INSERT INTO `translations` (`id_translation`, `component_name`, `es_ES`, `en_EN`) VALUES
(1, 'floatingInput', 'Introduce tu nombre de usuario', 'Enter your username'),
(2, 'floatingPassword', 'Introduce tu contraseña', 'Enter your password'),
(3, 'floatingEmail', 'Introduce tu email', 'Enter your email'),
(4, 'headline', 'Registrarse', 'Sign up'),
(5, 'signupbutton', 'Registrarse', 'Sign up'),
(6, 'floatingLanguage', 'Selecciona tu idioma', 'Select your language'),
(7, 'headlineSignin', 'Iniciar sesión', 'Login'),
(8, 'floatingInputSignin', 'Usuario', 'User'),
(9, 'floatingPasswordSignin', 'Contraseña', 'Password'),
(10, 'buttonaccessSignin', 'Acceder', 'Sign in'),
(12, 'appDescription', 'Aprende, practica y triunfa desde casa', 'Learn, practice and succeed from home'),
(13, 'mainAccess', 'Acceder', 'Enter'),
(14, 'sidebarHome', 'Inicio', 'Home'),
(15, 'profileDetails', 'Detalles', 'Details'),
(16, 'menuProfile', 'Mi perfil', 'My profile'),
(17, 'menuLogout', 'Cerrar sesión', 'Log out'),
(18, 'sidebarBoard', 'Tablón', 'Board'),
(19, 'sidebarNew', 'Nuevo examen', 'New exam'),
(20, 'sidebarMyexams', 'Mis exámenes', 'My exams'),
(21, 'sidebarForme', 'Creados por mi', 'Created by me'),
(22, 'sidebarShared', 'Compartidos', 'Shared'),
(23, 'sidebarFavorites', 'Favoritos', 'Favorites'),
(24, 'sidebarMyresults', 'Mis resultados', 'My results'),
(25, 'sidebarProfile', 'Perfil', 'Profile'),
(26, 'sidebarLogout', 'Cerrar sesión', 'Log out'),
(27, 'modalTitle', 'Compartir examen', 'Share exam'),
(28, 'modalLabel', 'Introduce el email del usuario con quien quieres compartir el examen', 'Enter the email address of the user with you want to share the exam'),
(29, 'enviarBtn', 'Enviar', 'Send'),
(30, 'shareEmail', 'Email del usuario', 'User email'),
(31, 'tablePublics', 'Exámenes públicos', 'Public exams'),
(32, 'tableTitle', 'Título', 'Title'),
(33, 'tableAutor', 'Autor', 'Author'),
(34, 'tableState', 'Estado', 'State'),
(35, 'tableDateCreated', 'Creación', 'Created'),
(36, 'tableDateUpdated', 'Última modificación', 'Last update'),
(37, 'tableMyexams', 'Exámenes creados por mi', 'Exams created by me'),
(38, 'titlePagSignup', 'eXamUp - Registrarse', 'eXamUp - Sign up'),
(39, 'titlePagSignin', 'eXamUp - Iniciar sesión', 'eXamUp - Sign in'),
(40, 'tableShared', 'Exámenes compartidos', 'Shared exams'),
(41, 'tableDateShared', 'Fecha compartido', 'Shared date'),
(42, 'tableFavorites', 'Exámenes favoritos', 'Favorite exams'),
(43, 'tableResults', 'Tus resultados', 'Your results'),
(44, 'tableLastDo', 'Última vez', 'Last time'),
(45, 'buttonPublic', 'Público', 'Public'),
(46, 'buttonPrivate', 'Privado', 'Private'),
(47, 'addQuestion', 'Añadir pregunta', 'Add question'),
(48, 'guardarExamen', 'Guardar examen', 'Save exam'),
(49, 'inputTitle', 'Título del examen', 'Exam title'),
(50, 'inputQuestion', 'Enunciado de la pregunta', 'Question sentence'),
(51, 'addAnswer', 'Añadir respuesta', 'Add answer'),
(52, 'inputAnswer', 'Enunciado de la respuesta', 'Answer sentence'),
(53, 'botonContadorDetener', 'Detener', 'Stop'),
(54, 'botoncontadorReanudar', 'Reanudar', 'Restart'),
(55, 'buttonPDF', 'Descargar PDF', 'Download PDF'),
(56, 'spanMultioption', '(Multirespuesta)', '(Multioption)'),
(57, 'botonTerminar', 'Terminar examen', 'Finish exam'),
(58, 'infoTotalquestion', 'Total de preguntas:', 'Total number of questions:'),
(59, 'infoTotalcorrect', 'Respuestas correctas:', 'Correct answers:'),
(60, 'infoPercentage', 'Porcentaje de respuestas correctas:', 'Percentage of correct answers:'),
(61, 'infoTime', 'Tiempo transcurrido:', 'Time spend:'),
(62, 'tableChartDate', 'Fecha', 'Date'),
(63, 'tableChartResult', 'Resultado', 'Result'),
(64, 'tableChartTime', 'Tiempo', 'Time'),
(65, 'tableTitleResult', 'TOP por resultado', 'TOP by result'),
(66, 'tableTitleScore', 'TOP por resultado y tiempo', 'TOP by result and time'),
(67, 'titleChartScore', 'Evolutivo por resultado y tiempo', 'Evolution by result and time'),
(68, 'titleChartResult', 'Evolutivo por resultado', 'Evolution by result'),
(69, 'profileTitleDetails', 'Detalles del perfil', 'Profile details'),
(70, 'profileNameDetails', 'Nombre del usuario', 'User name'),
(71, 'profilePasswordDetails', 'Contraseña', 'Password'),
(72, 'toggle-password', 'Mostrar contraseña', 'Show password'),
(73, 'profileLanguageDetails', 'Idioma', 'Language'),
(74, 'profileEditButton', 'Guardar cambios', 'Save changes'),
(75, 'profileEdit', 'Editar perfil', 'Edit profile');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id_user` int(255) NOT NULL,
  `gid_user` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol_key` int(255) NOT NULL,
  `lang_key` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id_user`, `gid_user`, `user_name`, `email`, `password`, `rol_key`, `lang_key`) VALUES
(2, '69736162656c69736162656c40676d61696c2e636f6d', 'isabel', 'isabel@gmail.com', 'isabel', 779442001, 779442001),
(3, '616c626572746f616c626572746f40676d61696c2e636f6d', 'alberto', 'alberto@gmail.com', 'alberto', 779442001, 779442002),
(4, '6a75616e69746f6a75616e69746f406d61696c2e636f6d', 'juanito', 'juanito@mail.com', 'juanito', 779442001, 779442001),
(5, '69736169736140676d61696c2e636f6d', 'isa', 'isa@gmail.com', 'isa', 779442002, 779442001),
(6, '726f7361726f736140676d61696c2e636f6d', 'rosamaria', 'rosa@gmail.com', 'rosa', 779442001, 779442001),
(7, '7065706570657065406d61696c2e636f6d', 'pepe', 'pepe@mail.com', 'pepe', 779442001, 779442002),
(9, '7061626c6f7061626c6f40676d61696c2e636f6d', 'pablo', 'pablo@gmail.com', 'pablo', 779442001, 779442002),
(10, '6d616e6f6c6f6d616e6f6c6f406d61696c2e636f6d', 'manolo', 'manolo@mail.com', 'manolo', 779442001, 779442002);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`id_exam`);

--
-- Indices de la tabla `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id_favorite`);

--
-- Indices de la tabla `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id_language`);

--
-- Indices de la tabla `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id_question`);

--
-- Indices de la tabla `question_type`
--
ALTER TABLE `question_type`
  ADD PRIMARY KEY (`id_type`);

--
-- Indices de la tabla `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`Identificador`);

--
-- Indices de la tabla `rols`
--
ALTER TABLE `rols`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `shared_exams`
--
ALTER TABLE `shared_exams`
  ADD PRIMARY KEY (`id_shared`);

--
-- Indices de la tabla `translations`
--
ALTER TABLE `translations`
  ADD PRIMARY KEY (`id_translation`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `exams`
--
ALTER TABLE `exams`
  MODIFY `id_exam` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT de la tabla `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id_favorite` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT de la tabla `languages`
--
ALTER TABLE `languages`
  MODIFY `id_language` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `questions`
--
ALTER TABLE `questions`
  MODIFY `id_question` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=175;

--
-- AUTO_INCREMENT de la tabla `question_type`
--
ALTER TABLE `question_type`
  MODIFY `id_type` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `results`
--
ALTER TABLE `results`
  MODIFY `Identificador` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT de la tabla `rols`
--
ALTER TABLE `rols`
  MODIFY `id_rol` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `shared_exams`
--
ALTER TABLE `shared_exams`
  MODIFY `id_shared` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `translations`
--
ALTER TABLE `translations`
  MODIFY `id_translation` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
