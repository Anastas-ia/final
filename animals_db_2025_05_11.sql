-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 11 2025 г., 19:02
-- Версия сервера: 10.3.13-MariaDB
-- Версия PHP: 7.1.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `animals_db`
--

-- --------------------------------------------------------

--
-- Структура таблицы `animals`
--

CREATE TABLE `animals` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(255) DEFAULT NULL,
  `IMAGE` text DEFAULT NULL,
  `TYPE` varchar(50) NOT NULL,
  `DESCRIPTION` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `animals`
--

INSERT INTO `animals` (`ID`, `NAME`, `IMAGE`, `TYPE`, `DESCRIPTION`) VALUES
(2, 'Луна', '/images/111.jpg', 'Кот', ''),
(3, 'Малышка', '/images/222.jpg', 'Кот', ''),
(4, 'Балу', '/images/333.jpg', 'Кот', ''),
(5, 'Тимон', '/images/444.jpg', 'Кот', ''),
(6, 'Снежок', '/images/555.jpg', 'Кот', 'Снежок любит спать'),
(7, 'Луна', '/images/111.jpg', 'Кот', ''),
(8, 'Малышка', '/images/222.jpg', 'Кот', ''),
(9, 'Балу', '/images/333.jpg', 'Кот', ''),
(10, 'Тимон', '/images/444.jpg', 'Кот', ''),
(11, 'Луна', '/images/111.jpg', 'Кот', ''),
(12, 'Малышка', '/images/222.jpg', 'Кот', ''),
(13, 'Балу', '/images/333.jpg', 'Кот', 'Всегда голодный'),
(15, 'Снежок', '/images/555.jpg', 'Кот', 'Наглый кот');

-- --------------------------------------------------------

--
-- Структура таблицы `animal_requests`
--

CREATE TABLE `animal_requests` (
  `ID` int(11) NOT NULL,
  `ID_USER` int(11) NOT NULL,
  `ID_ANIMAL` int(11) NOT NULL,
  `ID_REQUEST_TYPE` int(11) NOT NULL,
  `REQUEST_DATE` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `animal_requests`
--

INSERT INTO `animal_requests` (`ID`, `ID_USER`, `ID_ANIMAL`, `ID_REQUEST_TYPE`, `REQUEST_DATE`) VALUES
(13, 59, 2, 1, '2025-05-10 23:54:11'),
(17, 25, 5, 1, '2025-05-11 14:48:22'),
(18, 25, 15, 1, '2025-05-11 14:48:28');

-- --------------------------------------------------------

--
-- Структура таблицы `request_type`
--

CREATE TABLE `request_type` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Дамп данных таблицы `request_type`
--

INSERT INTO `request_type` (`ID`, `NAME`) VALUES
(1, 'Забрать навсегда'),
(2, 'Взять на передержку');

-- --------------------------------------------------------

--
-- Структура таблицы `tokens`
--

CREATE TABLE `tokens` (
  `ID` int(17) UNSIGNED NOT NULL,
  `COLLECTION_ID` int(17) UNSIGNED NOT NULL,
  `TOKEN` varchar(100) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tokens`
--

INSERT INTO `tokens` (`ID`, `COLLECTION_ID`, `TOKEN`) VALUES
(5, 59, '$2y$10$p7MhwOCvXK5E8o85x27H5exwDzCKd4i5.81aH8d5/byw1BXRMvJK6'),
(6, 60, '$2y$10$J6DBKgtDsUNjnBjbZbEGkeOvNDE5ehb6UrzNL12sBbbOWETLZIYy2'),
(7, 61, '$2y$10$93ZjANIyfptjE7oeu59xAuKSsxx6BgfQex9BQJvpinG0X/ZZYLQ6q'),
(8, 62, '$2y$10$VOjJgUIs.YfszOMERIG2leyr6jfiUSzoKRpSnKrdpxpKUWicmr9VC'),
(9, 59, '$2y$10$rNGtUrr94adxyQwPStp8OeYYWksC0/j3F4/lIv10cmCjd7gliJADK'),
(10, 59, '$2y$10$FbQpFKzxe8xiTEoJeKXgK.SNe50BQohun5OwagODa.3le07OVKJBi'),
(20, 63, '$2y$10$C8DEMzd9V43JlPQKmzipOuF5er.NY/mvDTL48qQdr/WqPwMd.ll92'),
(22, 25, '$2y$10$/UebrwgD0sTqWAkbszdlD.NAj832MQHCGXvBlVtjuZ1jkEC/yCLA2'),
(24, 25, '$2y$10$iUvbhaQXYsprZYRqpKDRXOv1MEWuzJzBQMd.J5NUTtTrVp7v6t512'),
(25, 25, '$2y$10$bUTTqeWWjJyPMNhJP1ZKn.aUNr6vmf7.xOTQV4kWa5eEGjy2kvXse'),
(31, 25, '$2y$10$Vt3LgYZMLIzuyPQKqq/0bujlNoCK2Aj5mS4ILYYubS83kHDPZgWNO'),
(34, 66, '$2y$10$UdDM0BpY5YIkVqLa0qxSueezy1dZSQqNyDn1jxm6EmMJvLgqOdhJ.');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `LOGIN` varchar(100) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `ROLE` enum('admin','volunteer','guest') NOT NULL,
  `CREATED_AT` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`ID`, `LOGIN`, `PASSWORD`, `ROLE`, `CREATED_AT`) VALUES
(25, 'admin', '$2y$10$/eguLYPGy6.q48wp3eXY9u2aHirWidbpBbySEzPCffuuUO7rbA1Qe', 'admin', '2025-05-09 06:36:29'),
(59, 'test', '$2y$10$ado2CqYFxpNwHd.cf8a6A.IZwmcc.GBhUQRlIEB9HmxdydM3rjVYu', 'guest', '2025-05-09 11:49:39'),
(63, 'Волонтер 1', '$2y$10$3AQpuqONlFM6zQII0pafn.KeSiHbNTbWXuCj5NEk33CCIcBq7E6LS', 'volunteer', '2025-05-11 00:16:35');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `animals`
--
ALTER TABLE `animals`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `animal_requests`
--
ALTER TABLE `animal_requests`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_ANIMAL` (`ID_ANIMAL`);

--
-- Индексы таблицы `request_type`
--
ALTER TABLE `request_type`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `tokens`
--
ALTER TABLE `tokens`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `animals`
--
ALTER TABLE `animals`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT для таблицы `animal_requests`
--
ALTER TABLE `animal_requests`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT для таблицы `request_type`
--
ALTER TABLE `request_type`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `tokens`
--
ALTER TABLE `tokens`
  MODIFY `ID` int(17) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
