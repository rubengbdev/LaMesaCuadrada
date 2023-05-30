-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: db
-- Tiempo de generación: 29-05-2023 a las 23:14:38
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
(2, '2023-05-24 18:47:23', 'actualizame esta', 19, 'GENERAL', 'pues eso'),
(5, '2023-05-26 21:33:20', 'hubo una movida en el parque de los patos', 19, 'GENERAL', 'la movida 80'),
(6, '2023-05-28 11:51:33', 'hubo una movida en el parque de los patos', 19, 'GENERAL', 'la movida 80'),
(7, '2023-05-28 11:51:34', 'hubo una movida en el parque de los patos', 19, 'GENERAL', 'la movida 80'),
(8, '2023-05-28 11:51:35', 'hubo una movida en el parque de los patos', 19, 'GENERAL', 'la movida 80'),
(10, '2023-05-28 11:51:36', 'hubo una movida en el parque de los patos', 19, 'GENERAL', 'la movida 80'),
(11, '2023-05-28 11:51:37', 'hubo una movida en el parque de los patos', 19, 'GENERAL', 'la movida 80'),
(12, '2023-05-28 11:51:37', 'hubo una movida en el parque de los patos', 19, 'GENERAL', 'la movida 80'),
(13, '2023-05-28 11:51:38', 'hubo una movida en el parque de los patos', 19, 'GENERAL', 'la movida 80'),
(18, '2023-05-28 12:39:16', 'wdawd', 19, 'GENERAL', 'HILO CON MUCHOS MENSAJESwadwadawdwd'),
(19, '2023-05-28 13:11:12', 'hubo una movida en el parque de los patos', 19, 'GENERAL', 'EL BUEN HILO2'),
(23, '2023-05-28 18:41:01', 'LA MOVIDA', 19, 'GENERAL', 'WDADWDWADwadwad'),
(24, '2023-05-28 19:21:52', 'wadwd', 19, 'GENERAL', 'UY'),
(25, '2023-05-29 17:58:01', 'EDITADO POR wd', 20, 'GENERAL', 'HOLA AQUI QUE wdadTAL'),
(26, '2023-05-29 23:04:39', 'aqui muriendo', 20, 'GENERAL', 'ME CAGO EN TO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensaje`
--

CREATE TABLE `mensaje` (
  `mensaje_id` int NOT NULL,
  `mensaje_fecha` datetime NOT NULL,
  `mensaje_contenido` text NOT NULL,
  `id_hilo` int NOT NULL,
  `mensaje_titulo` varchar(300) DEFAULT NULL,
  `id_usuario` int DEFAULT NULL
) ;

--
-- Volcado de datos para la tabla `mensaje`
--

INSERT INTO `mensaje` (`mensaje_id`, `mensaje_fecha`, `mensaje_contenido`, `id_hilo`, `mensaje_titulo`, `id_usuario`) VALUES
(1, '2023-05-26 17:33:09', 'movidawa dwdawd awdaw\r\nd \r\nawd awd ', 2, 'cual movida', 19),
(2, '2023-05-10 19:33:33', 'dawd awdw add wad\r\n wa\r\ndd ', 2, NULL, 21),
(4, '2023-05-26 21:46:26', 'PUES ANDA QUE A MI GILIPOLLAS', 5, 'null', 20),
(5, '2023-05-26 21:48:43', 'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas \"Letraset\", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.\n\n', 5, NULL, 20),
(6, '2023-05-28 12:39:16', 'wdawd', 18, 'HILO CON MUCHOS MENSAJESwadwadawdwd', 19),
(11, '2023-05-28 12:40:07', 'EDITADO POR MODERACION', 18, NULL, 20),
(12, '2023-05-28 12:40:09', 'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas \"Letraset\", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.\n\n', 18, 'null', 20),
(13, '2023-05-28 12:40:09', 'ESTABA EL OTRO DIA', 18, 'null', 20),
(14, '2023-05-28 12:41:23', 'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas &quot;Letraset&quot;, las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.', 18, 'null', 20),
(16, '2023-05-28 12:41:24', 'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas &quot;Letraset&quot;, las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.', 18, 'null', 20),
(17, '2023-05-28 12:41:25', 'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas &quot;Letraset&quot;, las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.', 18, 'null', 20),
(18, '2023-05-28 12:41:25', 'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas &quot;Letraset&quot;, las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.', 18, 'null', 20),
(19, '2023-05-28 12:41:26', 'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas &quot;Letraset&quot;, las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.', 18, 'null', 20),
(20, '2023-05-28 13:11:12', 'hubo una movida en el parque de los patos', 19, 'EL BUEN HILO2', 19),
(24, '2023-05-28 18:41:01', 'LA MOVIDA', 23, 'WDADWDWADwadwad', 19),
(25, '2023-05-28 19:21:52', 'wadwd', 24, 'UY', 19),
(26, '2023-05-29 17:49:30', 'pole', 24, 'null', 20),
(27, '2023-05-29 17:50:46', 'wad', 23, 'null', 20),
(28, '2023-05-29 17:50:47', 'wad', 23, 'null', 20),
(29, '2023-05-29 17:50:49', '23424', 23, 'null', 20),
(30, '2023-05-29 17:54:29', 'dwa', 24, 'null', 19),
(31, '2023-05-29 17:54:35', 'wadwd', 24, 'null', 19),
(32, '2023-05-29 17:55:10', 'gilito', 24, 'null', 20),
(33, '2023-05-29 17:58:01', 'EDITADO POR wd', 25, 'HOLA AQUI QUE wdadTAL', 20),
(34, '2023-05-29 17:58:31', 'hola', 25, 'null', 19),
(36, '2023-05-29 17:58:44', 'toy bien', 25, 'null', 19),
(37, '2023-05-29 23:04:39', 'aqui muriendo', 26, 'ME CAGO EN TO', 20),
(38, '2023-05-29 23:04:48', 'POLE', 26, 'null', 19),
(39, '2023-05-29 23:04:59', 'pavo te reporto', 26, 'null', 20);

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
(1, '2023-05-02 00:00:00', '<br>El juego de estrategia más premiado: más de 30 premios de juego. 7 Wonders es un juego de selección de cartas que se juega usando tres mazos de cartas con representaciones de civilizaciones antiguas.<br><br>Como líder de una de las 7 grandes ciudades del mundo antiguo, debes reunir recursos cuidadosamente, desarrollar rutas comerciales y afirmar tu supremacía militar.<br><br>Seleccionas cartas en múltiples rondas, construyendo cuidadosamente en pos de objetivos de largo plazo.<br><br>¡Construye tu ciudad y erige una maravilla arquitectónica que trascenderá los tiempos futuros!El juego de estrategia más premiado: más de 30 premios de juego. 7 Wonders es un juego de selección de cartas que se juega usando tres mazos de cartas con representaciones de civilizaciones antiguas.<br>El juego de estrategia más premiado: más de 30 premios de juego. 7 Wonders es un juego de selección de cartas que se juega usando tres mazos de cartas con representaciones de civilizaciones antiguas.<br>El juego de estrategia más premiado: más de 30 premios de juego. 7 Wonders es un juego de selección de cartas que se juega usando tres mazos de cartas con representaciones de civilizaciones antiguas.<br>', 'https://cdn.svc.asmodee.net/production-rprod/storage/games/7-wonders/sev-box-3d-1592411287XEcT9.png', '7 WONDERS LA MOVIDA EDIT'),
(3, '2023-05-20 00:00:00', 'Mansions of Madness: Second Edition is a fully co-operative, app-driven board game of horror and mystery for one to five players that takes place in the same universe as Eldritch Horror and Elder Sign. Let the immersive app guide you through the veiled streets of Innsmouth and the haunted corridors of Arkham\'s cursed mansions as you search for answers and respite. Eight brave investigators stand ready to confront four scenarios of fear and mystery, collecting weapons, tools, and information, solving complex puzzles, and fighting monsters, insanity, and death. Open the door and step inside these hair-raising Mansions of Madness: Second Edition. It will take more than just survival to conquer the evils terrorizing this town.', 'https://www.ludonauta.es/files/ludico/juegos-mesas/juego-mesa-las-mansiones-de-la-locura-2a-ed-2016-1442909281.jpg', 'MANSIONES DE LA LOCURA ANALISIS'),
(4, '2023-05-20 00:00:00', 'Mansions of Madness: Second Edition is a fully co-operative, app-driven board game of horror and mystery for one to five players that takes place in the same universe as Eldritch Horror and Elder Sign. Let the immersive app guide you through the veiled streets of Innsmouth and the haunted corridors of Arkham\'s cursed mansions as you search for answers and respite. Eight brave investigators stand ready to confront four scenarios of fear and mystery, collecting weapons, tools, and information, solving complex puzzles, and fighting monsters, insanity, and death. Open the door and step inside these hair-raising Mansions of Madness: Second Edition. It will take more than just survival to conquer the evils terrorizing this town.', 'https://www.ludonauta.es/files/ludico/juegos-mesas/juego-mesa-las-mansiones-de-la-locura-2a-ed-2016-1442909281.jpg', 'Movida de prueba'),
(7, '2023-05-20 14:00:00', '<br>¡Maldita sea! Como jugador en este juego de mesa, perder es una absoluta humillación. ¿Cómo es posible que estos insignificantes héroes se atrevan a desafiarme y derrotarme? Mi ira arde dentro de mí mientras veo cómo mis grandiosos planes se desvanecen en la nada. ¡No puedo soportar la vergüenza de ser vencido! Cada derrota alimenta mi furia y me impulsa a buscar venganza. ¡Nunca olvidaré esta afrenta y haré todo lo posible para aplastar a esos malditos héroes en la próxima partida! ¡La próxima vez seré imparable, inquebrantable y no habrá lugar para la derrota! ¡Maldita sea! Como jugador en este juego de mesa, perder es una absoluta humillación. ¿Cómo es posible que estos insignificantes héroes se atrevan a desafiarme y derrotarme? Mi ira arde dentro de mí mientras veo cómo mis grandiosos planes se desvanecen en la nada. ¡No puedo soportar la vergüenza de ser vencido! Cada derrota alimenta mi furia y me impulsa a buscar venganza. ¡Nunca olvidaré esta afrenta y haré todo lo posible para aplastar a esos malditos héroes en la próxima partida! ¡La próxima vez seré imparable, inquebrantable y no habrá lugar para la derrota! ¡Maldita sea! Como jugador en este juego de mesa, perder es una absoluta humillación. ¿Cómo es posible que estos insignificantes héroes se atrevan a desafiarme y derrotarme? Mi ira arde dentro de mí mientras veo cómo mis grandiosos planes se desvanecen en la nada. ¡No puedo soportar la vergüenza de ser vencido! Cada derrota alimenta mi furia y me impulsa a buscar \n\n\n\nvenganza. ¡Nunca olvidaré esta afrenta y haré todo lo posible para aplastar a esos malditos héroes en la próxima partida! ¡La próxima vez seré imparable, inquebrantable y no habrá lugar para la derrota! ¡Maldita sea! Como jugador en este juego de mesa, perder es una absoluta humillación. ¿Cómo es posible que estos insignificantes héroes se atrevan a desafiarme y derrotarme? Mi ira arde dentro de mí mientras veo cómo mis grandiosos planes se desvanecen en la nada. ¡No puedo soportar la vergüenza de ser vencido! Cada derrota alimenta mi furia y me impulsa a buscar venganza. ¡Nunca olvidaré esta afrenta y haré todo lo posible para aplastar a esos malditos héroes en la próxima partida! ¡La próxima vez seré imparable, inquebrantable y no habrá lugar para la derrota!', 'https://boardgamehalv.com/wp-content/uploads/2020/02/BoardGameMeme_BoardGameJohnWick-1024x1024.jpg', 'PERDER NO RENTA TRONKO'),
(8, '2023-05-20 12:22:57', 'Mansions of Madness: Second Edition is a fully co-operative, app-driven board game of horror and mystery for one to five players that takes place in the same universe as Eldritch Horror and Elder Sign. Let the immersive app guide you through the veiled streets of Innsmouth and the haunted corridors of Arkham\'s cursed mansions as you search for answers and respite. Eight brave investigators stand ready to confront four scenarios of fear and mystery, collecting weapons, tools, and information, solving complex puzzles, and fighting monsters, insanity, and death. Open the door and step inside these hair-raising Mansions of Madness: Second Edition. It will take more than just survival to conquer the evils terrorizing this town.', 'https://www.ludonauta.es/files/ludico/juegos-mesas/juego-mesa-las-mansiones-de-la-locura-2a-ed-2016-1442909281.jpg', 'Movida de prueba'),
(21, '2023-05-21 15:44:13', 'Playing Nemesis will take you into the heart of sci-fi survival horror in all its terror. A soldier fires blindly down a corridor, trying to stop the alien advance.\n<br>\n<br> A scientist races to find a solution in his makeshift lab. A traitor steals the last escape pod in the very last moment. Intruders you meet on the ship are not only reacting to the noise you make but also evolve as the time goes by. The longer the game takes, the stronger they become. During the game, you control one of the crew members with a unique set of skills, personal deck of cards, and individual starting equipment. These heroes cover all your basic SF horror needs. For example, the scientist is great with computers and research, but will have a hard time in combat. The soldier, on the other hand...  \n<br>\n<br>Nemesis is a semi-cooperative game in which you and your crewmates must survive on a ship infested with hostile organisms. To win the game, you have to complete one of the two objectives dealt to you at the start of the game and get back to Earth in one piece. You will find many obstacles on your way: swarms of Intruders (the name given to the alien organisms by the ship AI), the poor physical condition of the ship, agendas held by your fellow players, and sometimes just cruel fate.  The gameplay of Nemesis is designed to be full of climactic moments which, hopefully, you will find rewarding even when your best plans are ruined and your character meets a terrible fate.', 'https://cf.geekdo-images.com/tAqLpWxQ0Oo3GaPP3MER1g__imagepage/img/XyHxeMepMS292xwGjwdK6SvPL4I=/fit-in/900x600/filters:no_upscale():strip_icc()/pic5073276.jpg', 'A LA VENTA NEMESIS'),
(24, '2023-05-21 20:01:15', 'During the medieval goings-on around Orléans, you must assemble a following of farmers, merchants, knights, monks, etc. to gain supremacy through trade, construction and science in medieval France.In Orléans, you will recruit followers and put them to work to make use of their abilities. Farmers and Boatmen supply you with money and goods; Knights expand your scope of action and secure your mercantile expeditions; Craftsmen build trading stations and tools to facilitate work; Scholars make progress in science; Traders open up new locations for you to use your followers; and last but not least, it cannot hurt to get active in monasteries since with Monks on your side you are much less likely to fall prey to fate.<br><br><br><br>You will always want to take more actions than possible, and there are many paths to victory. The challenge is to combine all elements as best as possible with regard to your strategy.<br><br><br><br>AWARDS &amp; HONORS<br><br>2019 Juego del Año Recommended<br><br>2018 Gra Roku Advanced Game of the Year Nominee<br><br>2017 Nederlandse Spellenprijs Best Expert Game Winner<br><br>2017 Nederlandse Spellenprijs Best Expert Game Nominee<br><br>2017 MinD-Spielepreis Complex Game Winner<br><br>2017 MinD-Spielepreis Complex Game Nominee<br><br>2016 Tric Trac Nominee<br><br>2016 Gouden Ludo Best Expert Game Winner<br><br>2016 Gouden Ludo Best Expert Game Nominee<br><br>2015 Spiel der Spiele Hit für Experten Recommended<br><br>2015 Kennerspiel des Jahres Nominee<br><br>2015 JUG Adult Game of the Year Winner<br><br>2015 JUG Adult Game of the Year Finalist<br><br>2015 International Gamers Award - General Strategy: Multi-player Nominee<br><br>2014 Meeples\' Choice Nominee<br><br>2014 Golden Geek Most Innovative Board Game Nominee<br><br>2014 Golden Geek Board Game of the Year Nominee<br><br>2014 Golden Geek Best Strategy Board Game Nominee<br><br>YUIWYAD', 'https://cf.geekdo-images.com/nagl1li6kYt9elV9jbfVQw__imagepage/img/bmtHK2zXBEUD-Wme7CvkPbL0goA=/fit-in/900x600/filters:no_upscale():strip_icc()/pic6228507.jpg', 'El buen Orleans');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partida`
--

CREATE TABLE `partida` (
  `partida_id` int NOT NULL,
  `partida_numero_jugadores` int NOT NULL,
  `partida_puntuacion_vencedor` int NOT NULL,
  `partida_fecha` date DEFAULT NULL,
  `partida_nombre_juego` varchar(100) DEFAULT NULL,
  `id_usuario` int NOT NULL,
  `partida_logo` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `partida_tiempo` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `partida_vencedor` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `partida`
--

INSERT INTO `partida` (`partida_id`, `partida_numero_jugadores`, `partida_puntuacion_vencedor`, `partida_fecha`, `partida_nombre_juego`, `id_usuario`, `partida_logo`, `partida_tiempo`, `partida_vencedor`) VALUES
(1, 5, 30, '2023-05-10', 'Mansiones', 19, 'https://www.ludonauta.es/files/ludico/juegos-mesas/juego-mesa-las-mansiones-de-la-locura-2a-ed-2016-1442909281.jpg', '340', 'Ambos'),
(2, 800000, 500, '2015-03-03', 'ACTUALIZAME ESTA', 19, 'www.movidas.com/ACTUALIZADA.jpg', '3000 HORAS', 'pepito junior NO FUE QUIEN GANO CHAVAL'),
(5, 30, 30, '2001-03-03', 'Movida', 20, 'www.movidas.com/movida.jpg', '300 min', 'pepito junior'),
(6, 2, 30, '2017-03-03', 'Paleo', 19, 'https://cf.geekdo-images.com/85t1wkwgvh3d2mmjsRcDrw__itemrep/img/5Wx2IlXzKh8HmBD-_5Rm2b1YjO4=/fit-in/246x300/filters:strip_icc()/pic6039256.jpg', '', 'Puchitos'),
(9, 30, 30, '2001-03-03', 'Movida', 19, 'www.movidas.com/movida.jpg', '300 min', 'pepito junior'),
(10, 30, 30, '2001-03-03', 'Movida', 19, 'www.movidas.com/movida.jpg', '300 min', 'pepito junior'),
(14, 30, 30, '2009-03-03', 'fes5', 19, 'https://cf.geekdo-images.com/85t1wkwgvh3d2mmjsRcDrw__itemrep/img/5Wx2IlXzKh8HmBD-_5Rm2b1YjO4=/fit-in/246x300/filters:strip_icc()/pic6039256.jpg', '', 'pepito junior'),
(15, 30, 30, '2009-03-03', 'fes5', 19, 'https://cf.geekdo-images.com/85t1wkwgvh3d2mmjsRcDrw__itemrep/img/5Wx2IlXzKh8HmBD-_5Rm2b1YjO4=/fit-in/246x300/filters:strip_icc()/pic6039256.jpg', '', 'pepito junior'),
(22, 23, 23, '2023-05-04', '23', 19, '23', '23', '23'),
(26, 2, 2, '0022-02-22', 'wd', 19, '2', '2', 'w'),
(27, 22, 2, '0022-02-22', '22', 19, '2', '2', '2'),
(28, 2, 22, '0002-02-02', '2', 19, '2', '22', '22');

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
  `usuario_salt` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usuario_id`, `usuario_email`, `usuario_nombre`, `usuario_contrasena`, `usuario_tipo`, `usuario_fecha_creacion`, `usuario_salt`) VALUES
(19, 'admin@email.com', 'admin', '$2y$10$Lt8qp77dH57XgBfKoAFeZe5.P5tNA7F07moXNDd9oOhXejX.VbVr6', 'a', '2023-05-20', 'c827e30034c1679146e958d8f2ac48b9'),
(20, 'pepito5@email.com', 'pepito', '$2y$10$OxFKT5XHdvg4MBjIgdamuueL4aJmxowhWSI4I6iogcS3Lhv9Nvftm', 'u', '2023-05-20', '42d23628df2056358e008e6214c7c094'),
(21, 'movida33@email.com', 'ElMovidas33', '$2y$10$DKxRJRLmZqfuE8jsVqpfAe2nMwP0kyMI/AW755W3OeainT9C0rq0a', 'u', '2023-05-21', 'ba7bb0fd70f6ce8819bae93879a24ae7'),
(28, 'gu19@gmail.com', 'paleoliticavr', '$2y$10$UV5Ar.1bu6u5qEllltZxXuNKuQiOBcZ9hMJMfY89LpCtw7KQJFcIW', 'u', '2023-05-27', '06dc48b2a5f6802beda72248a14a3054'),
(31, 'prueba', 'ruben', '$2y$10$sFk4U/KJjd0dm.Wqdt9uj.rYrG31HNr16OGGlrif.qfL3WP3GGLei', 'u', '2023-05-29', '8a528c013a5cdff6330e96be62cfc6b9'),
(33, 'prueba32', 'prueba2', '$2y$10$UWh67Y6qqCd6fIuQlHVenekPSlB9xPi4ljU74dhmFyBs8oE5MLCmu', 'u', '2023-05-29', '8401f35965b5b522a2a0088e58bda0ee'),
(34, 'dwad', 'prueba2', '$2y$10$lZ6Dja6J2XvZbfTCLKGhhublG5vlerZ8N9R0dYpc4EEgHTxuD2UAm', 'u', '2023-05-29', '7c2f5c3e73fa4a82a64745cc7d019bff'),
(35, 'fwaf2323', 'prueba2', '$2y$10$gxupitEvp/arO2XFEStyMepjqP.qnPyCghF6kZj6r5Bs6Lc22QJP2', 'u', '2023-05-29', 'ce1539edd7ade8e3526b5f67df4200e9'),
(36, 'djiwoaj', 'prueba2', '$2y$10$3EVHPJE5x6LLgy.7wkOiFOOGaESBey1291MQ8mzdahI2yQPkL9DMC', 'u', '2023-05-29', 'f6f8ee5d12712545788e24742ccbd660'),
(37, '32323', 'prueba2', '$2y$10$ifP1MokAaqic7KfiMr2Tk.zKTIj9dkurDJ4UO/lRwlHN5u/yvM.L.', 'u', '2023-05-29', '1210685553c4d2c711188641faade997'),
(38, '4t4tfsef', 'prueba2', '$2y$10$XNQAGsz438qPzE9OSVbJhuk.0SpsK6SEKdQrEup8YiAb.YoYz0Uti', 'u', '2023-05-29', '293819d34f34ee0dc776889a42635f33'),
(39, 'adwa3', 'prueba2', '$2y$10$NiHrZWo/Y5zRRI/PpCB3FuPhr54GB4oxLfyovH9zPja6hJeFfPBaS', 'u', '2023-05-29', 'db7464e913e94446362b35d55bd2b41f'),
(41, 'dwadawdawd', '25aw', '$2y$10$RiloLRsfiLDZtaAU4pdtKeJliz7VTASI4yam/EDKL0l2irtQVCLR.', 'u', '2023-05-29', 'ae5548f1a6d9d701bfbd18160b09fefd'),
(42, '242a424a4', '2a424a24', '$2y$10$R/BGRC7qBFZDjHgSF8zUduteOBFbuOERBmEt1ONO8.kldG3Pzpw4a', 'u', '2023-05-29', 'b7abfa9a04beddfc5b678590d64fdfb2');

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
  ADD KEY `mensaje_hilo` (`id_hilo`),
  ADD KEY `mensaje_ibfk_1` (`id_usuario`);

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
  MODIFY `noticia_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `partida`
--
ALTER TABLE `partida`
  MODIFY `partida_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

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
  ADD CONSTRAINT `mensaje_hilo` FOREIGN KEY (`id_hilo`) REFERENCES `hilo` (`hilo_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mensaje_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`usuario_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `partida`
--
ALTER TABLE `partida`
  ADD CONSTRAINT `partida_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`usuario_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
