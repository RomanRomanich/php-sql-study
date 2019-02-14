-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Фев 14 2019 г., 14:01
-- Версия сервера: 8.0.13
-- Версия PHP: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `db_faq`
--
CREATE DATABASE IF NOT EXISTS `db_faq` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `db_faq`;

-- --------------------------------------------------------

--
-- Структура таблицы `admins`
--

CREATE TABLE `admins` (
  `id` int(11) UNSIGNED NOT NULL,
  `login` varchar(30) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `admins`
--

INSERT INTO `admins` (`id`, `login`, `password`) VALUES
(2, 'admin', '$2y$10$v2WppaCGAXm57iD2IKbcP.7LypA6uqTtxJeHYRnnAUicO4/LdU2oC'),
(15, '111', '111'),
(19, 'roman', '$2y$10$jQ4Tn9LaGwZ3bYjBNib31u9pdT0rmotpMcaZHkz5e5g26uhuTcCQq'),
(20, '345', '$2y$10$9qjz6xxJuEKvpD9dvOfju.QSRxm1gPzDPPSpeNq8sNFs1M1AiHkZC');

-- --------------------------------------------------------

--
-- Структура таблицы `ansvers`
--

CREATE TABLE `ansvers` (
  `id` int(10) UNSIGNED NOT NULL,
  `quest_id` int(10) UNSIGNED NOT NULL,
  `ansver` text NOT NULL,
  `ansverer_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `ansvers`
--

INSERT INTO `ansvers` (`id`, `quest_id`, `ansver`, `ansverer_name`) VALUES
(1, 1, 'А вот здесь ответ1111111', 'Админ'),
(2, 2, 'А вот здесь ответ 2', 'Админ'),
(4, 21, '1234567890', 'admin'),
(5, 3, 'asdfgh', 'admin'),
(6, 8, 'asdfqwerdf', 'admin'),
(7, 4, 'dfgfghvbncv cvb c 11111111111111111', 'admin'),
(8, 5, 'sdfsdf', 'admin'),
(9, 10, '11111111111111111111', 'admin'),
(10, 19, 'Тестирование ответа с автоматическим переходом к редактируемому вопросу', 'admin');

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `cat_name` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `cat_name`) VALUES
(1, 'ЧаВО'),
(2, 'Аккаунт'),
(3, 'Оплата'),
(10, '3456'),
(13, '456'),
(17, 'tyutjghj');

-- --------------------------------------------------------

--
-- Структура таблицы `quests`
--

CREATE TABLE `quests` (
  `id` int(10) UNSIGNED NOT NULL,
  `quest` text NOT NULL,
  `category_id` int(11) UNSIGNED NOT NULL,
  `quester_name` varchar(200) NOT NULL,
  `quester_mail` varchar(60) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `published` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `quests`
--

INSERT INTO `quests` (`id`, `quest`, `category_id`, `quester_name`, `quester_mail`, `published`) VALUES
(1, 'rfrfrfrfrf1 11111', 1, 'roman1111111', 'roman@r.r', 1),
(2, 'rfrfrfrfrf2', 2, 'roman', 'roman@r.r', 0),
(3, 'rfrfrfrfrf3', 3, 'roman', 'roman@r.r', 0),
(4, 'rfrfrfrfrf4 !!!!!!!!!!!!!!!!!!!!', 1, 'roman1111', 'roman@r.r', 1),
(5, '234234 вер 1', 1, 'sdfsdf', '1@1.1', 1),
(6, '234234 вер 2', 3, 'sdfsdf', '1@1.1', 0),
(8, 'What can I do? ч2', 1, 'Smockey', 'Smockey@V.v', 1),
(10, 'sfgdfg в2', 1, 'Smockey', '1@1.1', 1),
(11, 'sfgdfg в3', 3, 'Smockey', '1@1.1', 0),
(12, 'sfgdfg в4', 2, 'Smockey', '1@1.1', 0),
(13, 'sfgdfg в5', 3, 'Smockey', '1@1.1', 0),
(14, 'ака войти ч1', 2, 'Smockey', '1@1.1', 0),
(15, 'ака войти ч2', 2, 'Smockey', '1@1.1', 0),
(16, 'ака войти ч3', 2, 'Smockey', '1@1.1', 0),
(17, 'cvb ч4', 3, 'Smockey', '1@1.1', 0),
(18, 'iopiop в1', 1, '1234234234', '1@1.1', 0),
(19, 'iopiop 2', 2, '1234234234', '1@1.1', 1),
(20, 'jfjfjfjfjfjfjffjfjfj jfjfjfjfjfjffjfj', 2, 'Smockey', '1@1.1', 0),
(21, 'Тестирование и еще раз тестирование', 2, 'роман', '1@1.1', 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `ansvers`
--
ALTER TABLE `ansvers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quest_id` (`quest_id`) USING BTREE;

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `quests`
--
ALTER TABLE `quests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT для таблицы `ansvers`
--
ALTER TABLE `ansvers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT для таблицы `quests`
--
ALTER TABLE `quests`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `ansvers`
--
ALTER TABLE `ansvers`
  ADD CONSTRAINT `ansvers_ibfk_1` FOREIGN KEY (`quest_id`) REFERENCES `quests` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `quests`
--
ALTER TABLE `quests`
  ADD CONSTRAINT `quests_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
