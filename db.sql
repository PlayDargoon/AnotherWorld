-- phpMyAdmin SQL Dump
-- version 
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Май 26 2025 г., 16:04
-- Версия сервера: 5.7.44-51-log
-- Версия PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `host1421897_game`
--

-- --------------------------------------------------------

--
-- Структура таблицы `experience_table`
--

CREATE TABLE `experience_table` (
  `id` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `required_experience` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `experience_table`
--

INSERT INTO `experience_table` (`id`, `level`, `required_experience`) VALUES
(1, 1, 1),
(2, 2, 200),
(3, 3, 600),
(4, 4, 1300),
(5, 5, 2300),
(6, 6, 3700),
(7, 7, 5500),
(8, 8, 7770),
(9, 9, 10148),
(10, 10, 12678),
(11, 11, 15420),
(12, 12, 18460),
(13, 13, 21916),
(14, 14, 25956),
(15, 15, 31288),
(16, 16, 37954),
(17, 17, 46486),
(18, 18, 57632),
(19, 19, 72438),
(20, 20, 94928),
(21, 21, 125614),
(22, 22, 167774),
(23, 23, 225998),
(24, 24, 306712),
(25, 25, 418912),
(26, 26, 575192),
(27, 27, 811184),
(28, 28, 1140000),
(29, 29, 1600000);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `character_class` enum('Warrior','Mage','Monk') NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `side` enum('Light','Dark') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `health` smallint(5) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Здоровье',
  `damage` smallint(5) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Урон',
  `defense` smallint(5) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Защита',
  `silver` int(11) DEFAULT '0' COMMENT 'Серебро',
  `gold` int(11) DEFAULT '0' COMMENT 'Золото',
  `experience` int(10) UNSIGNED DEFAULT '0' COMMENT 'Опыт',
  `level` smallint(5) UNSIGNED DEFAULT '1' COMMENT 'Уровень',
  `vitality` int(10) UNSIGNED DEFAULT '0' COMMENT 'Живучесть',
  `play_time` bigint(20) UNSIGNED DEFAULT '0' COMMENT 'Время, проведенное в игре (в секундах)',
  `last_activity` datetime DEFAULT NULL COMMENT 'Последняя активность'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password_hash`, `character_class`, `gender`, `side`, `created_at`, `health`, `damage`, `defense`, `silver`, `gold`, `experience`, `level`, `vitality`, `play_time`, `last_activity`) VALUES
(1, 'Admin', 'VongolaIvanRogue@gmail.com', '$2y$10$ynsQs4XdtRtuZcQc.yITwO6jKfCME7CND8F0wz.nXOZ1/HEam8pQO', 'Warrior', 'Male', 'Dark', '2025-05-22 07:38:46', 20, 22, 70, 0, 0, 10, 1, 200, 5420, NULL),
(2, '1234', '1234@mak.ru', '$2y$10$.pz2U8xJEn9BeYx.t9jhKu3q1BZ/6Ay.qJ/3pnN/bMklngU40/gVC', 'Warrior', 'Male', 'Light', '2025-05-22 12:37:23', 0, 0, 0, 0, 0, 10, 1, 0, 0, NULL),
(3, '123456789', '123@123.yu', '$2y$10$bIp70bU645ULsZZAXSN0S.maoDJncokS.kNZTVqWnfvENXusuhJ7i', 'Warrior', 'Male', 'Light', '2025-05-22 13:13:19', 20, 30, 50, 0, 0, 10, 1, 200, 0, NULL),
(4, 'valera', 'valera@valera.ru', '$2y$10$X0eEyFlJNJwdIQu/lH8Vz.ozQSI0laa790BgQzdVlw6E9TXQcZkB.', 'Mage', 'Female', 'Dark', '2025-05-22 13:14:19', 25, 50, 25, 0, 0, 10, 1, 250, 0, NULL),
(5, '123456', '1234562@16.ru', '$2y$10$AKAl.FJRqYf5Eg9McbTKWO70Raw6eO6XNDtBc51PbRyPC3SB4ShyW', 'Monk', 'Female', 'Dark', '2025-05-23 13:39:05', 40, 40, 20, 0, 0, 10, 1, 400, 0, NULL),
(6, 'test3', 'test3@test3.ru', '$2y$10$54xh5xvNKgyknLrDWBcj/./76MuAVBNT8MGsF43dADgsGC13x0f6W', 'Warrior', 'Female', 'Light', '2025-05-25 07:57:29', 20, 30, 50, 0, 0, 10, 1, 200, 0, NULL),
(7, 'asdf', 'asdf@asdf.ru', '$2y$10$7PJ44NqOm9r4jez5EFx69uPBx1tPJrEsIxhKM2sq1CfeWFypOJtEy', 'Warrior', 'Female', 'Light', '2025-05-25 08:58:08', 20, 30, 50, 0, 0, 10, 1, 200, 0, NULL),
(8, 'Test', 'test@test.ru', '$2y$10$slovRdAEuXL6/nEL6C01kusavfJY0E58XNxC8o05owyFQdDRsGbCC', 'Monk', 'Female', 'Light', '2025-05-25 23:20:11', 40, 40, 20, 0, 0, 10, 1, 400, 0, NULL),
(9, '12345', '123456@gmail.com', '$2y$10$qX6CGGmeTBxvkkirSTkQmuEygRSNpM9rgVTF2X3LzW/q.mveR259G', 'Monk', 'Female', 'Dark', '2025-05-26 06:04:05', 40, 40, 20, 0, 0, 10, 1, 0, 0, NULL),
(11, 'zxcvb', 'zxcvb@zxcvb.ru', '$2y$10$OEwW0qn2h9lOtUyxGuYZq.4NDMg2DCNqXOVZgW4iYeViaLX62ewu.', 'Monk', 'Female', 'Light', '2025-05-26 06:06:40', 40, 40, 20, 0, 0, 10, 1, 0, 0, NULL),
(12, 'asdfg', 'asdfg@asdfg.ru', '$2y$10$1IfTqQsi1ma3uzlq6lU0ceAxESzlEcYMxWrB.kNT7Yk1e1RhREUOi', 'Mage', 'Male', 'Dark', '2025-05-26 06:07:54', 25, 50, 25, 0, 0, 10, 1, 0, 0, NULL),
(13, 'lkjh', 'lkjh@lkjh', '$2y$10$1yAi4w9UomHzOXhfr69li.1ZS1DFK/3b/053xWopTkDm4.f0/Pb1m', 'Mage', 'Male', 'Dark', '2025-05-26 06:10:24', 25, 50, 25, 0, 0, 10, 1, 0, 0, NULL),
(14, '12369', '12369@12369', '$2y$10$knHXuQ7lUHLO8FTckxKmSOuJFPooTeCbzBpQVzDZWofVP3DSkVxXq', 'Mage', 'Male', 'Dark', '2025-05-26 06:11:08', 25, 50, 25, 0, 0, 10, 1, 0, 0, NULL),
(15, 'Net', 'net@gamil.com', '$2y$10$WznmvX2rwvJ3iJhXPJLHLOFnJag6uuo7E2.74A1dkhN427Ll9qCHa', 'Monk', 'Female', 'Light', '2025-05-26 09:48:10', 40, 40, 20, 0, 0, 10, 1, 400, 1748252959, NULL),
(16, 'sergey', 'sergey@sergey.ru', '$2y$10$drTtGN/D25IPt2zsn16dvuaeEDvkYj6pQispGPQre3fmCRsNcITau', 'Warrior', 'Male', 'Light', '2025-05-26 10:39:48', 20, 30, 50, 0, 0, 10, 1, 200, 0, NULL),
(17, 'вика', 'vika@vika.ru', '$2y$10$YOA9jkkIrR1GrcO874o/I.5bI7q8iGeQ4dEkUWSXH1/XEXnrGVYR6', 'Warrior', 'Male', 'Light', '2025-05-26 11:42:53', 20, 30, 50, 0, 0, 10, 1, 200, 10, NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `experience_table`
--
ALTER TABLE `experience_table`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `level` (`level`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `experience_table`
--
ALTER TABLE `experience_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
