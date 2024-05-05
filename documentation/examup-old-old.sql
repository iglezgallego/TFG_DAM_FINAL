-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-05-2024 a las 18:45:58
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
(4, '12', '69736162656c69736162656c40676d61696c2e636f6d', 'prueba3', '2024-04-01', '2024-04-05', 'public'),
(5, '13', '616c626572746f616c626572746f40676d61696c2e636f6d', 'examen de Alberto', '2024-04-03', '2024-04-04', 'private'),
(26, 'fad92181f006feafa6d34cfccc76eddb45ae1dfdd2d3033f7f0c8a932083d3ff', '69736169736140676d61696c2e636f6d', 'prueba 2 privado caca EDITADO', '2024-04-27', '2024-04-28', 'public'),
(27, 'c72bdecd987ffd06133c0e38cc0a06c03a9f9ef4738666c430dc509abdc91e31', '69736169736140676d61696c2e636f6d', 'Prueba multioption', '2024-04-28', '2024-04-28', 'public'),
(30, 'b7e6fea88d6aad8e5dc0beda93445d079b30c520a3551161f6374caf6f4713e1', '69736169736140676d61696c2e636f6d', 'prueba con varias opciones prueba con varias opciones prueba con varias opciones prueba con varias opciones prueba con varias opciones', '2024-04-28', '2024-05-01', 'private'),
(31, 'a96f13190cb6a22d04cf30b035a2c417693c9ed891495133f46cea37f849925a', '69736169736140676d61696c2e636f6d', 'Examen de prueba 2', '2024-05-01', '2024-05-01', 'public'),
(32, '5383bb304431a82063229de6a1a7f53e746705fc5db313d71e534ef00e388b4e', '69736169736140676d61696c2e636f6d', 'Prueba 3 MODIFICADO', '2024-05-01', '2024-05-01', 'private');

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
(10, 'c72bdecd987ffd06133c0e38cc0a06c03a9f9ef4738666c430dc509abdc91e31', '69736162656c69736162656c40676d61696c2e636f6d'),
(14, '5383bb304431a82063229de6a1a7f53e746705fc5db313d71e534ef00e388b4e', '69736169736140676d61696c2e636f6d');

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
(34, 'c72bdecd987ffd06133c0e38cc0a06c03a9f9ef4738666c430dc509abdc91e31', 779442001, 'jashdhgfdvfhv', '[{\"answer\":\"gbbg\",\"correct\":false},{\"answer\":\"gbgfbf\",\"correct\":true},{\"answer\":\"gbgf\",\"correct\":true},{\"answer\":\"bfbb\",\"correct\":false}]', 1),
(36, 'fad92181f006feafa6d34cfccc76eddb45ae1dfdd2d3033f7f0c8a932083d3ff', 779442001, 'fewfrf', '[{\"answer\":\"rgergre\",\"correct\":false},{\"answer\":\"rgreg\",\"correct\":true},{\"answer\":\"caca\",\"correct\":true}]', 1),
(49, 'b7e6fea88d6aad8e5dc0beda93445d079b30c520a3551161f6374caf6f4713e1', 779442001, '¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?', '[{\"answer\":\"azulgatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogato\",\"correct\":false},{\"answer\":\"verdegatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogato\",\"correct\":false},{\"answer\":\"moradogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogato\",\"correct\":true}]', 0),
(50, 'b7e6fea88d6aad8e5dc0beda93445d079b30c520a3551161f6374caf6f4713e1', 779442001, '¿Comidas?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?', '[{\"answer\":\"pizzagatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogato\",\"correct\":true},{\"answer\":\"coles de bruselasgatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogato\",\"correct\":false},{\"answer\":\"patatas fritasgatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogato\",\"correct\":true}]', 1),
(51, 'b7e6fea88d6aad8e5dc0beda93445d079b30c520a3551161f6374caf6f4713e1', 779442001, '¿Animal?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?¿Color?', '[{\"answer\":\"ranagatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogato\",\"correct\":false},{\"answer\":\"gatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogato\",\"correct\":true},{\"answer\":\"perrogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogatogato\",\"correct\":false}]', 0),
(57, 'a96f13190cb6a22d04cf30b035a2c417693c9ed891495133f46cea37f849925a', 779442001, '¿Cómo se llama mi madre?', '[{\"answer\":\"Clara\",\"correct\":false},{\"answer\":\"María\",\"correct\":false},{\"answer\":\"Rosa\",\"correct\":true}]', 0),
(58, 'a96f13190cb6a22d04cf30b035a2c417693c9ed891495133f46cea37f849925a', 779442001, '¿Cómo se llama mi padre?', '[{\"answer\":\"Joaquin\",\"correct\":true},{\"answer\":\"Fernando\",\"correct\":false},{\"answer\":\"Francisco\",\"correct\":false}]', 0),
(59, 'a96f13190cb6a22d04cf30b035a2c417693c9ed891495133f46cea37f849925a', 779442001, '¿Cómo se llaman mis gatos?', '[{\"answer\":\"Pepe\",\"correct\":false},{\"answer\":\"Ciri\",\"correct\":true},{\"answer\":\"Coco\",\"correct\":false},{\"answer\":\"Choli\",\"correct\":true}]', 1),
(60, 'a96f13190cb6a22d04cf30b035a2c417693c9ed891495133f46cea37f849925a', 779442001, '¿Cómo se llama mi pueblo?', '[{\"answer\":\"Aldaia\",\"correct\":false},{\"answer\":\"Daimiel\",\"correct\":true},{\"answer\":\"Almagro\",\"correct\":false}]', 0),
(61, 'a96f13190cb6a22d04cf30b035a2c417693c9ed891495133f46cea37f849925a', 779442001, '¿Cómo se llama mi hermano?', '[{\"answer\":\"Juan\",\"correct\":false},{\"answer\":\"Alberto\",\"correct\":true},{\"answer\":\"Pedro\",\"correct\":false}]', 0),
(65, '5383bb304431a82063229de6a1a7f53e746705fc5db313d71e534ef00e388b4e', 779442001, '¿Hola? MODIFICADO', '[{\"answer\":\"Si \",\"correct\":true},{\"answer\":\"No\",\"correct\":false}]', 0),
(66, '5383bb304431a82063229de6a1a7f53e746705fc5db313d71e534ef00e388b4e', 779442001, 'Dime dos cosas', '[{\"answer\":\"Una\",\"correct\":true},{\"answer\":\"Dos\",\"correct\":true},{\"answer\":\"Tres\",\"correct\":false}]', 1),
(67, '5383bb304431a82063229de6a1a7f53e746705fc5db313d71e534ef00e388b4e', 779442001, '¿Adios?', '[{\"answer\":\"Uno\",\"correct\":false},{\"answer\":\"Dos\",\"correct\":true}]', 0);

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
(1, '12', '69736169736140676d61696c2e636f6d', '2024-04-09'),
(21, 'a96f13190cb6a22d04cf30b035a2c417693c9ed891495133f46cea37f849925a', '69736162656c69736162656c40676d61696c2e636f6d', '2024-05-01'),
(22, 'a96f13190cb6a22d04cf30b035a2c417693c9ed891495133f46cea37f849925a', '616c626572746f616c626572746f40676d61696c2e636f6d', '2024-05-01');

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
(3, 'floatingEmail', 'Introduce tu email', 'Enter your email');

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
(5, '69736169736140676d61696c2e636f6d', 'isa', 'isa@gmail.com', 'isa', 779442002, 779442001);

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
  MODIFY `id_exam` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id_favorite` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `languages`
--
ALTER TABLE `languages`
  MODIFY `id_language` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `questions`
--
ALTER TABLE `questions`
  MODIFY `id_question` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT de la tabla `question_type`
--
ALTER TABLE `question_type`
  MODIFY `id_type` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `rols`
--
ALTER TABLE `rols`
  MODIFY `id_rol` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `shared_exams`
--
ALTER TABLE `shared_exams`
  MODIFY `id_shared` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `translations`
--
ALTER TABLE `translations`
  MODIFY `id_translation` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
