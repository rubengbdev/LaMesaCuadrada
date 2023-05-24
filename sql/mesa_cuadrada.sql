-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: db
-- Tiempo de generación: 24-05-2023 a las 19:16:35
-- Versión del servidor: 8.0.32
-- Versión de PHP: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mesa_cuadrada`
--
CREATE DATABASE IF NOT EXISTS `mesa_cuadrada` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `mesa_cuadrada`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hilo`
--

CREATE TABLE `hilo` (
  `hilo_id` int NOT NULL,
  `hilo_fecha` datetime NOT NULL,
  `hilo_contenido` text NOT NULL,
  `id_usuario` int NOT NULL,
  `hilo_tipo` varchar(255) NOT NULL,
  `hilo_titulo` varchar(300) NOT NULL
) ;

--
-- Volcado de datos para la tabla `hilo`
--

INSERT INTO `hilo` (`hilo_id`, `hilo_fecha`, `hilo_contenido`, `id_usuario`, `hilo_tipo`, `hilo_titulo`) VALUES
(1, '2023-05-24 18:38:46', 'la movida de hoy es para cagarse', 19, 'GENERAL', 'LA GRAN MOVIDA +HD'),
(2, '2023-05-24 18:47:23', 'actualizame esta', 19, 'GENERAL', 'pues eso');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensaje`
--

CREATE TABLE `mensaje` (
  `mensaje_id` int NOT NULL,
  `mensaje_fecha` date NOT NULL,
  `mensaje_contenido` text NOT NULL,
  `id_hilo` int NOT NULL
) ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticia`
--

CREATE TABLE `noticia` (
  `noticia_id` int NOT NULL,
  `noticia_fecha` datetime NOT NULL,
  `noticia_texto` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `noticia_imagen` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `noticia_titulo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `noticia`
--

INSERT INTO `noticia` (`noticia_id`, `noticia_fecha`, `noticia_texto`, `noticia_imagen`, `noticia_titulo`) VALUES
(1, '2023-05-02 00:00:00', '\nEl juego de estrategia más premiado: más de 30 premios de juego. 7 Wonders es un juego de selección de cartas que se juega usando tres mazos de cartas con representaciones de civilizaciones antiguas.\n\nComo líder de una de las 7 grandes ciudades del mundo antiguo, debes reunir recursos cuidadosamente, desarrollar rutas comerciales y afirmar tu supremacía militar.\n\nSeleccionas cartas en múltiples rondas, construyendo cuidadosamente en pos de objetivos de largo plazo.\n\n¡Construye tu ciudad y erige una maravilla arquitectónica que trascenderá los tiempos futuros!El juego de estrategia más premiado: más de 30 premios de juego. 7 Wonders es un juego de selección de cartas que se juega usando tres mazos de cartas con representaciones de civilizaciones antiguas.\nEl juego de estrategia más premiado: más de 30 premios de juego. 7 Wonders es un juego de selección de cartas que se juega usando tres mazos de cartas con representaciones de civilizaciones antiguas.\nEl juego de estrategia más premiado: más de 30 premios de juego. 7 Wonders es un juego de selección de cartas que se juega usando tres mazos de cartas con representaciones de civilizaciones antiguas.\n', 'https://cdn.svc.asmodee.net/production-rprod/storage/games/7-wonders/sev-box-3d-1592411287XEcT9.png', '7 WONDERS LA MOVIDA'),
(3, '2023-05-20 00:00:00', 'Mansions of Madness: Second Edition is a fully co-operative, app-driven board game of horror and mystery for one to five players that takes place in the same universe as Eldritch Horror and Elder Sign. Let the immersive app guide you through the veiled streets of Innsmouth and the haunted corridors of Arkham\'s cursed mansions as you search for answers and respite. Eight brave investigators stand ready to confront four scenarios of fear and mystery, collecting weapons, tools, and information, solving complex puzzles, and fighting monsters, insanity, and death. Open the door and step inside these hair-raising Mansions of Madness: Second Edition. It will take more than just survival to conquer the evils terrorizing this town.', 'https://www.ludonauta.es/files/ludico/juegos-mesas/juego-mesa-las-mansiones-de-la-locura-2a-ed-2016-1442909281.jpg', 'MANSIONES DE LA LOCURA ANALISIS'),
(4, '2023-05-20 00:00:00', 'Mansions of Madness: Second Edition is a fully co-operative, app-driven board game of horror and mystery for one to five players that takes place in the same universe as Eldritch Horror and Elder Sign. Let the immersive app guide you through the veiled streets of Innsmouth and the haunted corridors of Arkham\'s cursed mansions as you search for answers and respite. Eight brave investigators stand ready to confront four scenarios of fear and mystery, collecting weapons, tools, and information, solving complex puzzles, and fighting monsters, insanity, and death. Open the door and step inside these hair-raising Mansions of Madness: Second Edition. It will take more than just survival to conquer the evils terrorizing this town.', 'https://www.ludonauta.es/files/ludico/juegos-mesas/juego-mesa-las-mansiones-de-la-locura-2a-ed-2016-1442909281.jpg', 'Movida de prueba'),
(5, '2023-05-20 00:00:00', 'Mansions of Madness: Second Edition is a fully co-operative, app-driven board game of horror and mystery for one to five players that takes place in the same universe as Eldritch Horror and Elder Sign. Let the immersive app guide you through the veiled streets of Innsmouth and the haunted corridors of Arkham\'s cursed mansions as you search for answers and respite. Eight brave investigators stand ready to confront four scenarios of fear and mystery, collecting weapons, tools, and information, solving complex puzzles, and fighting monsters, insanity, and death. Open the door and step inside these hair-raising Mansions of Madness: Second Edition. It will take more than just survival to conquer the evils terrorizing this town.', 'https://www.ludonauta.es/files/ludico/juegos-mesas/juego-mesa-las-mansiones-de-la-locura-2a-ed-2016-1442909281.jpg', 'Movida de prueba'),
(6, '2023-05-20 00:00:00', 'Mansions of Madness: Second Edition is a fully co-operative, app-driven board game of horror and mystery for one to five players that takes place in the same universe as Eldritch Horror and Elder Sign. Let the immersive app guide you through the veiled streets of Innsmouth and the haunted corridors of Arkham\'s cursed mansions as you search for answers and respite. Eight brave investigators stand ready to confront four scenarios of fear and mystery, collecting weapons, tools, and information, solving complex puzzles, and fighting monsters, insanity, and death. Open the door and step inside these hair-raising Mansions of Madness: Second Edition. It will take more than just survival to conquer the evils terrorizing this town.', 'https://www.ludonauta.es/files/ludico/juegos-mesas/juego-mesa-las-mansiones-de-la-locura-2a-ed-2016-1442909281.jpg', 'Movida de prueba'),
(7, '2023-05-20 14:00:00', '\n¡Maldita sea! Como jugador en este juego de mesa, perder es una absoluta humillación. ¿Cómo es posible que estos insignificantes héroes se atrevan a desafiarme y derrotarme? Mi ira arde dentro de mí mientras veo cómo mis grandiosos planes se desvanecen en la nada. ¡No puedo soportar la vergüenza de ser vencido! Cada derrota alimenta mi furia y me impulsa a buscar venganza. ¡Nunca olvidaré esta afrenta y haré todo lo posible para aplastar a esos malditos héroes en la próxima partida! ¡La próxima vez seré imparable, inquebrantable y no habrá lugar para la derrota! ¡Maldita sea! Como jugador en este juego de mesa, perder es una absoluta humillación. ¿Cómo es posible que estos insignificantes héroes se atrevan a desafiarme y derrotarme? Mi ira arde dentro de mí mientras veo cómo mis grandiosos planes se desvanecen en la nada. ¡No puedo soportar la vergüenza de ser vencido! Cada derrota alimenta mi furia y me impulsa a buscar venganza. ¡Nunca olvidaré esta afrenta y haré todo lo posible para aplastar a esos malditos héroes en la próxima partida! ¡La próxima vez seré imparable, inquebrantable y no habrá lugar para la derrota! ¡Maldita sea! Como jugador en este juego de mesa, perder es una absoluta humillación. ¿Cómo es posible que estos insignificantes héroes se atrevan a desafiarme y derrotarme? Mi ira arde dentro de mí mientras veo cómo mis grandiosos planes se desvanecen en la nada. ¡No puedo soportar la vergüenza de ser vencido! Cada derrota alimenta mi furia y me impulsa a buscar venganza. ¡Nunca olvidaré esta afrenta y haré todo lo posible para aplastar a esos malditos héroes en la próxima partida! ¡La próxima vez seré imparable, inquebrantable y no habrá lugar para la derrota! ¡Maldita sea! Como jugador en este juego de mesa, perder es una absoluta humillación. ¿Cómo es posible que estos insignificantes héroes se atrevan a desafiarme y derrotarme? Mi ira arde dentro de mí mientras veo cómo mis grandiosos planes se desvanecen en la nada. ¡No puedo soportar la vergüenza de ser vencido! Cada derrota alimenta mi furia y me impulsa a buscar venganza. ¡Nunca olvidaré esta afrenta y haré todo lo posible para aplastar a esos malditos héroes en la próxima partida! ¡La próxima vez seré imparable, inquebrantable y no habrá lugar para la derrota!', 'https://boardgamehalv.com/wp-content/uploads/2020/02/BoardGameMeme_BoardGameJohnWick-1024x1024.jpg', 'Perder NO renta en los JUEGOS DE MESA'),
(8, '2023-05-20 12:22:57', 'Mansions of Madness: Second Edition is a fully co-operative, app-driven board game of horror and mystery for one to five players that takes place in the same universe as Eldritch Horror and Elder Sign. Let the immersive app guide you through the veiled streets of Innsmouth and the haunted corridors of Arkham\'s cursed mansions as you search for answers and respite. Eight brave investigators stand ready to confront four scenarios of fear and mystery, collecting weapons, tools, and information, solving complex puzzles, and fighting monsters, insanity, and death. Open the door and step inside these hair-raising Mansions of Madness: Second Edition. It will take more than just survival to conquer the evils terrorizing this town.', 'https://www.ludonauta.es/files/ludico/juegos-mesas/juego-mesa-las-mansiones-de-la-locura-2a-ed-2016-1442909281.jpg', 'Movida de prueba'),
(9, '2023-05-21 10:30:28', 'Mansions of Madness: Second Edition is a fully co-operative, app-driven board game of horror and mystery for one to five players that takes place in the same universe as Eldritch Horror and Elder Sign. Let the immersive app guide you through the veiled streets of Innsmouth and the haunted corridors of Arkham\'s cursed mansions as you search for answers and respite. Eight brave investigators stand ready to confront four scenarios of fear and mystery, collecting weapons, tools, and information, solving complex puzzles, and fighting monsters, insanity, and death. Open the door and step inside these hair-raising Mansions of Madness: Second Edition. It will take more than just survival to conquer the evils terrorizing this town.', 'https://www.ludonauta.es/files/ludico/juegos-mesas/juego-mesa-las-mansiones-de-la-locura-2a-ed-2016-1442909281.jpg', 'Movida de prueba'),
(10, '2023-05-21 10:30:30', 'Mansions of Madness: Second Edition is a fully co-operative, app-driven board game of horror and mystery for one to five players that takes place in the same universe as Eldritch Horror and Elder Sign. Let the immersive app guide you through the veiled streets of Innsmouth and the haunted corridors of Arkham\'s cursed mansions as you search for answers and respite. Eight brave investigators stand ready to confront four scenarios of fear and mystery, collecting weapons, tools, and information, solving complex puzzles, and fighting monsters, insanity, and death. Open the door and step inside these hair-raising Mansions of Madness: Second Edition. It will take more than just survival to conquer the evils terrorizing this town.', 'https://www.ludonauta.es/files/ludico/juegos-mesas/juego-mesa-las-mansiones-de-la-locura-2a-ed-2016-1442909281.jpg', 'Movida de prueba'),
(21, '2023-05-21 15:44:13', 'Playing Nemesis will take you into the heart of sci-fi survival horror in all its terror. A soldier fires blindly down a corridor, trying to stop the alien advance.\r\n\r\n A scientist races to find a solution in his makeshift lab. A traitor steals the last escape pod in the very last moment. Intruders you meet on the ship are not only reacting to the noise you make but also evolve as the time goes by. The longer the game takes, the stronger they become. During the game, you control one of the crew members with a unique set of skills, personal deck of cards, and individual starting equipment. These heroes cover all your basic SF horror needs. For example, the scientist is great with computers and research, but will have a hard time in combat. The soldier, on the other hand...  \r\n\r\nNemesis is a semi-cooperative game in which you and your crewmates must survive on a ship infested with hostile organisms. To win the game, you have to complete one of the two objectives dealt to you at the start of the game and get back to Earth in one piece. You will find many obstacles on your way: swarms of Intruders (the name given to the alien organisms by the ship AI), the poor physical condition of the ship, agendas held by your fellow players, and sometimes just cruel fate.  The gameplay of Nemesis is designed to be full of climactic moments which, hopefully, you will find rewarding even when your best plans are ruined and your character meets a terrible fate.', 'https://cf.geekdo-images.com/tAqLpWxQ0Oo3GaPP3MER1g__imagepage/img/XyHxeMepMS292xwGjwdK6SvPL4I=/fit-in/900x600/filters:no_upscale():strip_icc()/pic5073276.jpg', 'Nemesis YA A LA VENTA!!'),
(23, '2023-05-21 17:21:58', 'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas &quot;Letraset&quot;, las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.\r\n\r\nLorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas &quot;Letraset&quot;, las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.\r\n\r\n\r\nLorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas &quot;Letraset&quot;, las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.\r\n\r\nLorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas &quot;Letraset&quot;, las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.', 'https://avatars.githubusercontent.com/u/99685784?v=4', 'La prueba de creacion de noticias'),
(24, '2023-05-21 20:01:15', 'During the medieval goings-on around Orléans, you must assemble a following of farmers, merchants, knights, monks, etc. to gain supremacy through trade, construction and science in medieval France.\r\n\r\nIn Orléans, you will recruit followers and put them to work to make use of their abilities. Farmers and Boatmen supply you with money and goods; Knights expand your scope of action and secure your mercantile expeditions; Craftsmen build trading stations and tools to facilitate work; Scholars make progress in science; Traders open up new locations for you to use your followers; and last but not least, it cannot hurt to get active in monasteries since with Monks on your side you are much less likely to fall prey to fate.\r\n\r\nYou will always want to take more actions than possible, and there are many paths to victory. The challenge is to combine all elements as best as possible with regard to your strategy.\r\n\r\nAWARDS &amp; HONORS\r\n2019 Juego del Año Recommended\r\n2018 Gra Roku Advanced Game of the Year Nominee\r\n2017 Nederlandse Spellenprijs Best Expert Game Winner\r\n2017 Nederlandse Spellenprijs Best Expert Game Nominee\r\n2017 MinD-Spielepreis Complex Game Winner\r\n2017 MinD-Spielepreis Complex Game Nominee\r\n2016 Tric Trac Nominee\r\n2016 Gouden Ludo Best Expert Game Winner\r\n2016 Gouden Ludo Best Expert Game Nominee\r\n2015 Spiel der Spiele Hit für Experten Recommended\r\n2015 Kennerspiel des Jahres Nominee\r\n2015 JUG Adult Game of the Year Winner\r\n2015 JUG Adult Game of the Year Finalist\r\n2015 International Gamers Award - General Strategy: Multi-player Nominee\r\n2014 Meeples\' Choice Nominee\r\n2014 Golden Geek Most Innovative Board Game Nominee\r\n2014 Golden Geek Board Game of the Year Nominee\r\n2014 Golden Geek Best Strategy Board Game Nominee', 'https://cf.geekdo-images.com/nagl1li6kYt9elV9jbfVQw__imagepage/img/bmtHK2zXBEUD-Wme7CvkPbL0goA=/fit-in/900x600/filters:no_upscale():strip_icc()/pic6228507.jpg', 'Orleans partidaza');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partida`
--

CREATE TABLE `partida` (
  `partida_id` int NOT NULL,
  `partida_numero_jugadores` int NOT NULL,
  `partida_puntuacion` int NOT NULL,
  `partida_fecha` date DEFAULT NULL,
  `partida_nombre_juego` varchar(100) DEFAULT NULL,
  `id_usuario` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `producto_id` int NOT NULL,
  `producto_fecha` date NOT NULL,
  `producto_precio` double NOT NULL,
  `producto_descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `usuario_id` int NOT NULL,
  `usuario_email` varchar(255) NOT NULL,
  `usuario_nombre` varchar(50) NOT NULL,
  `usuario_contrasena` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `usuario_tipo` varchar(255) NOT NULL,
  `usuario_fecha_creacion` date NOT NULL,
  `usuario_ultima_conexion` datetime DEFAULT NULL,
  `usuario_salt` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usuario_id`, `usuario_email`, `usuario_nombre`, `usuario_contrasena`, `usuario_tipo`, `usuario_fecha_creacion`, `usuario_ultima_conexion`, `usuario_salt`) VALUES
(19, 'admin@email.com', 'admin', '$2y$10$Lt8qp77dH57XgBfKoAFeZe5.P5tNA7F07moXNDd9oOhXejX.VbVr6', 'a', '2023-05-20', NULL, 'c827e30034c1679146e958d8f2ac48b9'),
(20, 'pepito@email.com', 'pepito', '$2y$10$fVojW3aBUs3ih5bxxFKHf.8DS.KwSIFA1ukmhhatOp8vME.QjCHsG', 'u', '2023-05-20', NULL, '8a06bdd787199ae661fb764e2f4d4980'),
(21, 'movida@email', 'movida', '$2y$10$AJh0ELhgHVs2hgQNguXPReu0rPxtuCyeogZkQXDvjygXKzIjz84T.', 'u', '2023-05-21', NULL, '8aa3b91dc8c6ae42223a2b21d55b6368');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `hilo`
--
ALTER TABLE `hilo`
  ADD PRIMARY KEY (`hilo_id`),
  ADD KEY `hilo_usuario` (`id_usuario`);

--
-- Indices de la tabla `mensaje`
--
ALTER TABLE `mensaje`
  ADD PRIMARY KEY (`mensaje_id`),
  ADD KEY `mensaje_hilo` (`id_hilo`);

--
-- Indices de la tabla `noticia`
--
ALTER TABLE `noticia`
  ADD PRIMARY KEY (`noticia_id`);

--
-- Indices de la tabla `partida`
--
ALTER TABLE `partida`
  ADD PRIMARY KEY (`partida_id`),
  ADD KEY `partida_usuario` (`id_usuario`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`producto_id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usuario_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `hilo`
--
ALTER TABLE `hilo`
  MODIFY `hilo_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mensaje`
--
ALTER TABLE `mensaje`
  MODIFY `mensaje_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `noticia`
--
ALTER TABLE `noticia`
  MODIFY `noticia_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `producto_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usuario_id` int NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `hilo`
--
ALTER TABLE `hilo`
  ADD CONSTRAINT `hilo_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`usuario_id`);

--
-- Filtros para la tabla `mensaje`
--
ALTER TABLE `mensaje`
  ADD CONSTRAINT `mensaje_hilo` FOREIGN KEY (`id_hilo`) REFERENCES `hilo` (`hilo_id`);

--
-- Filtros para la tabla `partida`
--
ALTER TABLE `partida`
  ADD CONSTRAINT `partida_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`usuario_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
