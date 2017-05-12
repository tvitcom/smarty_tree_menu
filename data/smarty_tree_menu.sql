-- phpMyAdmin SQL Dump
-- version 4.4.15.10
-- https://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Май 12 2017 г., 22:44
-- Версия сервера: 5.5.55-0+deb8u1
-- Версия PHP: 7.1.2RC1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `treemenu`
--

-- --------------------------------------------------------

--
-- Структура таблицы `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `item_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `items`
--

INSERT INTO `items` (`item_id`, `parent_id`) VALUES
(1, 0),
(2, 0),
(3, 0),
(4, 1),
(5, 1),
(6, 3),
(7, 3),
(8, 3),
(9, 3),
(10, 4),
(11, 4),
(12, 5),
(13, 8),
(14, 8);

-- --------------------------------------------------------

--
-- Структура таблицы `items_description`
--

CREATE TABLE IF NOT EXISTS `items_description` (
  `item_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `item_name` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `items_description`
--

INSERT INTO `items_description` (`item_id`, `language_id`, `item_name`) VALUES
(1, 1, 'First'),
(2, 1, 'Second'),
(3, 1, 'Third'),
(4, 1, 'Fourth'),
(5, 1, 'Fifth'),
(6, 1, 'Sixth'),
(7, 1, 'Seventh'),
(8, 1, 'Eighth'),
(9, 1, 'Ninth'),
(10, 1, 'Tenth'),
(11, 1, 'Eleventh'),
(12, 1, 'Twelfth'),
(13, 1, 'Thirteenth'),
(14, 1, 'Fourteenth');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
