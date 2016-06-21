-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Июн 18 2016 г., 18:00
-- Версия сервера: 10.1.13-MariaDB
-- Версия PHP: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `php2_lesson1`
--

-- --------------------------------------------------------

--
-- Структура таблицы `realty`
--

CREATE TABLE `realty` (
  `realty_id` int(10) UNSIGNED NOT NULL,
  `area` float UNSIGNED NOT NULL,
  `rooms` tinyint(3) UNSIGNED NOT NULL,
  `floor` tinyint(4) NOT NULL,
  `adress` varchar(1023) COLLATE utf8_unicode_ci NOT NULL,
  `price` int(10) UNSIGNED NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `wall_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `realty`
--

INSERT INTO `realty` (`realty_id`, `area`, `rooms`, `floor`, `adress`, `price`, `description`, `wall_id`) VALUES
(15, 75, 4, 3, 'г. Красноярск, ул Объектов Недвижимости, 3', 1500000, 'Первый дом', 1),
(16, 56, 1, 19, 'г. Красноярск, проспект Лессона, 1', 3000000, 'Высокий дом', 2),
(17, 27, 6, 2, 'г. Красноярск, переулок Пхпэшный, д 5, кв 6', 7500999, 'Последний дом', 4);

-- --------------------------------------------------------

--
-- Структура таблицы `wall`
--

CREATE TABLE `wall` (
  `id` int(10) UNSIGNED NOT NULL,
  `material` varchar(63) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `wall`
--

INSERT INTO `wall` (`id`, `material`) VALUES
(1, 'Кирпич'),
(2, 'Дерево'),
(3, 'Панель'),
(4, 'Монолит'),
(5, 'Блоки');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `realty`
--
ALTER TABLE `realty`
  ADD PRIMARY KEY (`realty_id`),
  ADD KEY `index_wall_id` (`wall_id`);

--
-- Индексы таблицы `wall`
--
ALTER TABLE `wall`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `realty`
--
ALTER TABLE `realty`
  MODIFY `realty_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT для таблицы `wall`
--
ALTER TABLE `wall`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `realty`
--
ALTER TABLE `realty`
  ADD CONSTRAINT `FK_realty_wall` FOREIGN KEY (`wall_id`) REFERENCES `wall` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
