-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Июл 18 2019 г., 10:50
-- Версия сервера: 5.7.26-0ubuntu0.18.04.1
-- Версия PHP: 7.2.20-1+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `myBase`
--

-- --------------------------------------------------------

--
-- Структура таблицы `likes`
--

CREATE TABLE `likes` (
  `id` int(11) UNSIGNED NOT NULL,
  `post_id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `result` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `likes`
--

INSERT INTO `likes` (`id`, `post_id`, `user_id`, `result`) VALUES
(1, 21, 2, 1),
(2, 16, 2, 1),
(8, 4, 2, 1),
(9, 1, 2, 0),
(11, 4, 1, 1),
(19, 22, 1, 1),
(20, 16, 10, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `posts`
--

CREATE TABLE `posts` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `posts`
--

INSERT INTO `posts` (`id`, `title`, `description`, `user_id`) VALUES
(1, 'Mbappe took interview', 'Now the best players are Ronaldo and Messi but I do my best to win them.', 6),
(2, 'Zlatan said', 'I am God.', 3),
(3, 'About God\'s hand', 'I striked that gol with God\'s hand.', 5),
(4, 'Mkhitaryan get merried with Betty', 'In Italy.', 7),
(21, 'Edo', 'aaa', 2),
(22, 'Edo', 'yahoooooo', 1),
(16, 'Edo', 'du bomb es!!!', 10);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `age` tinyint(3) UNSIGNED NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `age`, `email`, `password`) VALUES
(1, 'Ronaldo', 34, 'ronaldo@gmail.com', 'c5aa3124b1adad080927ce4d144c6b33'),
(2, 'Messi', 32, 'messi@gmail.com', '1463ccd2104eeb36769180b8a0c86bb6'),
(3, 'Ibrahimovich', 37, 'zlatan@gmail.com', '85ffd536abe3bac08a92529a97dd34cb'),
(4, 'Pele', 78, 'pele@gmail.com', '476917cf3c5e4dfa272ab61ffadbab1f'),
(5, 'Maradona', 58, 'maradona@gmail.com', '8b123b7a7cf86f5aa9424d1f379384d8'),
(6, 'Mbappe', 20, 'mbappe@gmail.com', '455ad4beb47b2970cd7ae57468d3e03e'),
(7, 'Mkhitaryan', 29, 'mkhitaryan@gmail.com', 'b05f31b268bf6eef7c22d6f1e232f1ae'),
(8, 'Hazard', 28, 'hazard@gmail.com', 'afbe5099e0f5bb8cd70f7e8563759d33'),
(9, 'Iren', 49, 'mkrtchyan@gmail.com', '202cb962ac59075b964b07152d234b70'),
(10, 'edo', 18, 'edo@mail.ru', 'd2d612f72e42577991f4a5936cecbcc0'),
(11, 'edo', 18, 'edo@mail.ru', 'd2d612f72e42577991f4a5936cecbcc0');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT для таблицы `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
