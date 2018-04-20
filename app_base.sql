-- phpMyAdmin SQL Dump
-- version 4.6.3
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Апр 11 2018 г., 13:26
-- Версия сервера: 5.5.55-0+deb8u1
-- Версия PHP: 5.6.30-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `app_base`
--

-- --------------------------------------------------------

--
-- Структура таблицы `elements`
--

CREATE TABLE `elements` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `TEXT` mediumtext COLLATE utf8mb4_unicode_ci,
  `CODE` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `SORT` int(11) NOT NULL DEFAULT '100',
  `ACTIVE` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Y',
  `FILE_ID` int(11) NOT NULL DEFAULT '0',
  `CREATE_TIME` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

--
-- Дамп данных таблицы `elements`
--

INSERT INTO `elements` (`ID`, `NAME`, `TEXT`, `CODE`, `SORT`, `ACTIVE`, `FILE_ID`, `CREATE_TIME`) VALUES
(1, 'Как себя мотивировать? Набор нестандартных советов', 'Вся суть мотивации сводится к одной простой фразе: если правильно объяснить людям «зачем», то они всегда найдут способ «как». Чем яснее вы понимаете свои желания, тем быстрее вы этого достигнете. А значит, говоря о мотивации, нужно смотреть лишь на две вещи - почему мне это нужно сделать и почему этого делать не нужно. \r\n\r\nНиже я приведу ряд советов, которые помогут вам принять решение о том, как действовать и с какой скоростью. \r\n\r\n1. Разогрев. \r\nКонцентрация, в определённом смысле, такая же мышца, как и все остальные. А значит, её надо не только тренировать, но и с умом использовать. Прежде, чем взяться за любое сложное дело, вам нужно размяться. Например, прежде чем писать отчёт, можно написать пару писем. А прежде чем писать письма, можно начать с смс. Аналогично, если вам тяжело выйти в магазин, начните с того, что походите по дому. \r\n\r\n2. Моментальное действие. \r\nИли другими словами: «пусть не у меня болит голова о том, что нужно сделать». Если вам пришла в голову гениальная мысль – сделайте любое действие по её реализации. Например, если вы придумали отличный проект на работе, но не продумали его в деталях, можно позвонить начальнику и сказать, что у вас есть супер идея. Пусть теперь он вас дёргает с тем, чтобы из вас эту идею извлечь. \r\n\r\n3. Я могу. \r\nНет ничего лучше, чем делать то, что получается. И даже если это компьютерная игра – делайте это. Увы, мозг не особенно отличает достижения виртуальные и реальные. Старайтесь делать как можно чаще те вещи, где вы ощущаете себя победителем. Это даст вам ресурс на достижение целей, где подобной уверенности нет. \r\n\r\n4. Развитие навыков. \r\nСложно хотеть того, чего никогда не видел в глаза. Чем выше ваш кругозор, тем яснее вы понимаете свои желание. Особенно это связано с навыками. Ведь, на самом деле, именно навыки все используют для приобретения чего-либо, это обмен. Вы обмениваете своё время, энергию и навыки на какие-то блага. В идеале – ваша работа и хобби есть одно и то же дело. Например, не очень известная, но существующая профессия «дегустатор мороженого» невозможна без изысканной речи. А это значит, что чем большими навыками, помимо основной работы, вы владеете, тем более интересную работу в будущем способны выполнять. \r\n\r\n5. Необычные подходы.\r\nИногда мы точно знаем, чего хотим, но связываем цель со способом достижения. Например, поездку заграницу связываем с накоплением денег на отпуск. Тогда как способы достижения этой цели могут быть различны: шопинг-туры, рабочие командировки, посещение отелей за отзыв, подарок от друзей и родителей на день рождения. \r\n\r\n6. Новые дела. \r\nЧем чаще вы делаете что-то новое, тем меньше боитесь начинать в целом. Будучи тренером, я особенно настаиваю на прочтении, просмотре или физическом обучении у мастеров новым навыкам. Есть три области знания. Первая: я знаю, что я умею писать тексты. Вторая: я не знаю, как работает процессор сотового телефона, но я знаю, что он как-то работает точно. Самое же интересное кроется в области номер три: я не знаю того, чего я не знаю. Общение же с новыми людьми и выполнение новых дел позволяет нам к этому прикоснуться! \r\n\r\nИз вышесказанного можно сделать несложный вывод: если вы находитесь в контакте со своими желаниями и развиваете свои навыки, то мотивация превращается в навык. А любой навык можно тренировать и оттачивать. Вложив на начальном этапе силу воли, в дальнейшем вам уже больше не потребуется предпринимать таких колоссальных усилий, чтобы мотивировать себя на новое дело.\r\n', 'first', 100, 'Y', 7, '2017-08-14 13:38:40'),
(2, 'Просто ты всё можешь', NULL, '', 100, 'Y', 8, '2017-08-14 15:24:53'),
(3, 'Выбор за тобой', NULL, '', 100, 'Y', 9, '2017-08-14 15:24:53'),
(4, '<b>Волшебная стройность</b>\r\n<br />\r\nПсихология снижения веса', '<img src="http://82.146.36.53/upload/promo-test.png" />', '', 100, 'Y', 0, '2017-08-15 09:56:10'),
(5, 'Мотивация на каждый день ', NULL, '', 100, 'Y', 0, '2017-08-28 11:32:53'),
(6, 'Сильная Мотивация . Я буду Действовать! ', NULL, '', 100, 'Y', 0, '2017-08-28 11:32:53'),
(7, '"Завтра" мотивация к действию ', NULL, '', 100, 'Y', 0, '2017-08-28 14:59:25'),
(8, 'Самый крутой мотивационный ролик на сегодняшний день! ', NULL, '', 100, 'Y', 0, '2017-08-28 14:59:25'),
(9, 'Привычки, которые ведут к бедности ', NULL, '', 100, 'Y', 0, '2017-08-28 15:02:27'),
(10, 'Пять привычек успешных людей ', NULL, '', 100, 'Y', 0, '2017-08-28 15:02:27'),
(11, 'День подвига', NULL, '', 100, 'Y', 10, '2017-08-28 15:06:56'),
(12, 'Радуйся', NULL, '', 100, 'Y', 11, '2017-08-28 15:06:56'),
(13, 'Выйди', NULL, '', 100, 'Y', 12, '2017-08-28 15:10:52'),
(14, 'Профессия', NULL, '', 100, 'Y', 13, '2017-08-28 15:10:52'),
(15, 'Худей', NULL, '', 100, 'Y', 14, '2017-08-28 15:14:58'),
(16, 'Не сорвись!', NULL, '', 100, 'Y', 15, '2017-08-28 15:14:58'),
(17, 'Цель похудеть!', NULL, '', 100, 'Y', 0, '2017-08-28 15:18:14'),
(18, 'МОТИВАЦИЯ ПОХУДЕТЬ! КАК ВЗЯТЬ СЕБЯ В РУКИ?! ИЗИ!', NULL, '', 100, 'Y', 0, '2017-08-28 15:18:14'),
(19, 'Ты можешь', NULL, '', 100, 'Y', 16, '2017-08-28 15:22:12'),
(20, 'Зачем начинать заново?', NULL, '', 100, 'Y', 17, '2017-08-28 15:22:12'),
(21, 'Не важно что говорят', NULL, '', 100, 'Y', 18, '2017-08-28 15:26:19'),
(22, 'Не нужно быть самым умным', NULL, '', 100, 'Y', 19, '2017-08-28 15:26:19'),
(23, 'Не пей', NULL, '', 100, 'Y', 21, '2017-08-29 13:20:27'),
(24, 'Будущее?', NULL, '', 100, 'Y', 22, '2017-08-29 13:20:27');

-- --------------------------------------------------------

--
-- Структура таблицы `files`
--

CREATE TABLE `files` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `PATH` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `DIR` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `files`
--

INSERT INTO `files` (`ID`, `NAME`, `PATH`, `DIR`) VALUES
(1, '', '/public/upload/Image1.png', ''),
(2, 'Image1.png', '/public/upload/Image1.png', '/public/upload/'),
(3, 'Image2.png', '/public/upload/Image2.png', '/public/upload/'),
(4, 'Image3.png', '/public/upload/Image3.png', '/public/upload/'),
(5, 'IMG_7355.JPG', '/public/upload/IMG_7355.JPG', '/home/koeshiro/data/html/nodejs'),
(6, 'IMG_7355.JPG', '/public/upload/IMG_7355.JPG', '/home/koeshiro/data/html/nodejs'),
(7, 'article1.png', '/public/upload/article1.png', '/public/upload/'),
(8, '318363212.jpg', '/public/upload/318363212.jpg', '/public/upload/'),
(9, 'img115446.jpg', '/public/upload/img115446.jpg', '/public/upload/'),
(10, 'o1.jpg', '/public/upload/o1.jpg', '/public/upload/'),
(11, 'o2.jpg', '/public/upload/o1.jpg', '/public/upload/'),
(12, 'b1.jpg', '/public/upload/b1.jpg', '/public/upload/'),
(13, 'b2.jpg', '/public/upload/b2.jpg', '/public/upload/'),
(14, 'p1.jpg', '/public/upload/p1.jpg', '/public/upload/'),
(15, 'p2.jpg', '/public/upload/p2.jpg', '/public/upload/'),
(16, 'p3.jpg', '/public/upload/p3.jpg', '/public/upload/'),
(17, 'p4.jpg', '/public/upload/p4.jpg', '/public/upload/'),
(18, 'b3.jpg', '/public/upload/', '/public/upload/'),
(19, 'b4.jpg', '/public/upload/', '/public/upload/'),
(20, 'i3.png', '/public/upload/i3.png', '/home/koeshiro/data/html/nodejs'),
(21, 'v-p-1.jpg', '/public/upload/v-p-1.jpg', '/public/upload/'),
(22, 'v-p-2.jpg', '/public/upload/v-p-2.jpg', '/public/upload/');

-- --------------------------------------------------------

--
-- Структура таблицы `properties`
--

CREATE TABLE `properties` (
  `id` int(11) NOT NULL,
  `section_id` int(11) DEFAULT '0',
  `name` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `properties`
--

INSERT INTO `properties` (`id`, `section_id`, `name`) VALUES
(1, 5, 'stock_section_id'),
(2, 1, 'video'),
(3, 2, 'video'),
(4, 3, 'video'),
(5, 5, 'href');

-- --------------------------------------------------------

--
-- Структура таблицы `propertie_values`
--

CREATE TABLE `propertie_values` (
  `id` int(11) NOT NULL,
  `element_id` int(11) NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci,
  `propertie_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `propertie_values`
--

INSERT INTO `propertie_values` (`id`, `element_id`, `value`, `propertie_id`) VALUES
(1, 4, '3', 1),
(2, 5, '<iframe width="560" height="315" src="https://www.youtube.com/embed/0Q6e7mshqRI" frameborder="0" allowfullscreen></iframe>', 2),
(3, 6, '<iframe width="560" height="315" src="https://www.youtube.com/embed/JVFLJgt4FT0" frameborder="0" allowfullscreen></iframe>', 2),
(4, 7, '<iframe width="560" height="315" src="https://www.youtube.com/embed/D43_e0ux-2U" frameborder="0" allowfullscreen></iframe>', 2),
(5, 8, '<iframe width="560" height="315" src="https://www.youtube.com/embed/LD8yT-2y1-o" frameborder="0" allowfullscreen></iframe>', 2),
(6, 9, '<iframe width="560" height="315" src="https://www.youtube.com/embed/Jil60vlsDLs" frameborder="0" allowfullscreen></iframe>', 2),
(7, 10, '<iframe width="560" height="315" src="https://www.youtube.com/embed/RTfi-BujCXk" frameborder="0" allowfullscreen></iframe>', 2),
(8, 17, '<iframe width="560" height="315" src="https://www.youtube.com/embed/TNVJVO7z8Sk" frameborder="0" allowfullscreen></iframe>', 2),
(9, 18, '<iframe width="1920" height="974" src="https://www.youtube.com/embed/M5-cIrza0Fc" frameborder="0" allowfullscreen></iframe>', 2),
(10, 4, 'http://test.ru', 5);

-- --------------------------------------------------------

--
-- Структура таблицы `sections`
--

CREATE TABLE `sections` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CODE` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `FILE_ID` int(11) NOT NULL,
  `ACTIVE` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Y',
  `SORT` int(11) NOT NULL DEFAULT '100'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `sections`
--

INSERT INTO `sections` (`ID`, `NAME`, `CODE`, `FILE_ID`, `ACTIVE`, `SORT`) VALUES
(1, 'Общее', 'all', 2, 'Y', 1),
(2, 'Бизнес', 'business', 3, 'Y', 2),
(3, 'Похудение', 'slimming', 4, 'Y', 3),
(4, 'article', 'article', 6, 'N', 0),
(5, 'mentor', 'mentor', 0, 'N', 0),
(6, 'promos', 'promos', 0, 'N', 0),
(7, 'Вредные привычки', 'bad-habits', 20, 'Y', 4);

-- --------------------------------------------------------

--
-- Структура таблицы `sections_communication`
--

CREATE TABLE `sections_communication` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `child_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `sections_elements`
--

CREATE TABLE `sections_elements` (
  `id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `element_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `sections_elements`
--

INSERT INTO `sections_elements` (`id`, `section_id`, `element_id`) VALUES
(1, 4, 1),
(2, 1, 2),
(3, 3, 3),
(4, 1, 5),
(5, 1, 6),
(6, 1, 7),
(7, 1, 8),
(8, 2, 9),
(9, 2, 10),
(10, 1, 11),
(11, 1, 12),
(12, 2, 13),
(13, 2, 14),
(14, 3, 15),
(15, 3, 16),
(16, 3, 17),
(17, 3, 18),
(18, 3, 19),
(19, 3, 20),
(20, 2, 21),
(21, 2, 22),
(22, 7, 23),
(23, 7, 24),
(24, 6, 4);

-- --------------------------------------------------------

--
-- Структура таблицы `section_file_communication`
--

CREATE TABLE `section_file_communication` (
  `id` int(11) NOT NULL,
  `sections_id` int(11) NOT NULL,
  `file_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `session`
--

CREATE TABLE `session` (
  `id` int(11) NOT NULL,
  `hash` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Структура таблицы `session_parametrs`
--

CREATE TABLE `session_parametrs` (
  `id` int(11) NOT NULL,
  `session_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `index` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_avatar` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_rang` int(1) NOT NULL DEFAULT '1',
  `user_reg_time` timestamp NULL DEFAULT NULL,
  `user_last_enter` timestamp NULL DEFAULT NULL,
  `user_access_token` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_email` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_hash` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_login_type` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`index`, `user_id`, `user_name`, `user_avatar`, `user_rang`, `user_reg_time`, `user_last_enter`, `user_access_token`, `user_email`, `user_hash`, `user_login_type`) VALUES
(1, 142457138, 'Рустам Борханов', 'https://sun9-8.userapi.com/c639627/v639627377/433bc/RGeBHcJbNis.jpg', 0, '2017-07-21 09:15:35', '2017-10-02 13:55:58', 'e0a2191638c99373e290433ab39406a65cf4cfc7d1ae29cbc2db18648f13b58472ecd80de0d54d7391720', 'anima_99@mail.ru', '9ba860fda659e8fa444698536e13588794eace8ef77ddcad1099928d82f09f14', 'vk');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `elements`
--
ALTER TABLE `elements`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `propertie_values`
--
ALTER TABLE `propertie_values`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `sections_communication`
--
ALTER TABLE `sections_communication`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `sections_elements`
--
ALTER TABLE `sections_elements`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `section_file_communication`
--
ALTER TABLE `section_file_communication`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `session_parametrs`
--
ALTER TABLE `session_parametrs`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`index`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `elements`
--
ALTER TABLE `elements`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT для таблицы `files`
--
ALTER TABLE `files`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT для таблицы `properties`
--
ALTER TABLE `properties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `propertie_values`
--
ALTER TABLE `propertie_values`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT для таблицы `sections`
--
ALTER TABLE `sections`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT для таблицы `sections_communication`
--
ALTER TABLE `sections_communication`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `sections_elements`
--
ALTER TABLE `sections_elements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT для таблицы `section_file_communication`
--
ALTER TABLE `section_file_communication`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `session`
--
ALTER TABLE `session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `session_parametrs`
--
ALTER TABLE `session_parametrs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `index` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
