-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Апр 19 2016 г., 22:29
-- Версия сервера: 10.1.10-MariaDB
-- Версия PHP: 7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `jaba`
--
CREATE DATABASE IF NOT EXISTS `jaba` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `jaba`;

-- --------------------------------------------------------

--
-- Структура таблицы `image`
--

CREATE TABLE `image` (
  `id` int(10) UNSIGNED NOT NULL,
  `path` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `image`
--

INSERT INTO `image` (`id`, `path`, `status`) VALUES
(1, 'image1', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `login` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `image_id` int(10) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `email`, `login`, `password`, `image_id`, `status`) VALUES
(1, 'fname', 'lname', 'email', 'login', 'password', 1, 1),
(2, 'fname2', 'lname2', 'email2', 'login2', 'password2', 1, 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD UNIQUE KEY `path_UNIQUE` (`path`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`,`image_id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD UNIQUE KEY `login_UNIQUE` (`login`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`),
  ADD KEY `fk_user_image_idx` (`image_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `image`
--
ALTER TABLE `image`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_image` FOREIGN KEY (`image_id`) REFERENCES `image` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
--
-- База данных: `phpmyadmin`
--
CREATE DATABASE IF NOT EXISTS `phpmyadmin` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `phpmyadmin`;

-- --------------------------------------------------------

--
-- Структура таблицы `pma__bookmark`
--

CREATE TABLE `pma__bookmark` (
  `id` int(11) NOT NULL,
  `dbase` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `label` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `query` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Bookmarks';

-- --------------------------------------------------------

--
-- Структура таблицы `pma__central_columns`
--

CREATE TABLE `pma__central_columns` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_type` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_length` text COLLATE utf8_bin,
  `col_collation` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_isNull` tinyint(1) NOT NULL,
  `col_extra` varchar(255) COLLATE utf8_bin DEFAULT '',
  `col_default` text COLLATE utf8_bin
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Central list of columns';

-- --------------------------------------------------------

--
-- Структура таблицы `pma__column_info`
--

CREATE TABLE `pma__column_info` (
  `id` int(5) UNSIGNED NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `column_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `comment` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `mimetype` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `transformation` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `transformation_options` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `input_transformation` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `input_transformation_options` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Column information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Структура таблицы `pma__designer_settings`
--

CREATE TABLE `pma__designer_settings` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `settings_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Settings related to Designer';

-- --------------------------------------------------------

--
-- Структура таблицы `pma__export_templates`
--

CREATE TABLE `pma__export_templates` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `export_type` varchar(10) COLLATE utf8_bin NOT NULL,
  `template_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `template_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved export templates';

-- --------------------------------------------------------

--
-- Структура таблицы `pma__favorite`
--

CREATE TABLE `pma__favorite` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `tables` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Favorite tables';

-- --------------------------------------------------------

--
-- Структура таблицы `pma__history`
--

CREATE TABLE `pma__history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `timevalue` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sqlquery` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='SQL history for phpMyAdmin';

-- --------------------------------------------------------

--
-- Структура таблицы `pma__navigationhiding`
--

CREATE TABLE `pma__navigationhiding` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `item_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `item_type` varchar(64) COLLATE utf8_bin NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Hidden items of navigation tree';

-- --------------------------------------------------------

--
-- Структура таблицы `pma__pdf_pages`
--

CREATE TABLE `pma__pdf_pages` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `page_nr` int(10) UNSIGNED NOT NULL,
  `page_descr` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='PDF relation pages for phpMyAdmin';

-- --------------------------------------------------------

--
-- Структура таблицы `pma__recent`
--

CREATE TABLE `pma__recent` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `tables` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Recently accessed tables';

--
-- Дамп данных таблицы `pma__recent`
--

INSERT INTO `pma__recent` (`username`, `tables`) VALUES
('root', '[{"db":"snow","table":"producer"},{"db":"snow","table":"image"},{"db":"snow","table":"user"},{"db":"snow","table":"size"},{"db":"snow","table":"product_has_image"},{"db":"snow","table":"product"},{"db":"snow","table":"color"},{"db":"snow","table":"char_value"},{"db":"snow","table":"char_name"},{"db":"snow","table":"category"}]');

-- --------------------------------------------------------

--
-- Структура таблицы `pma__relation`
--

CREATE TABLE `pma__relation` (
  `master_db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `master_table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `master_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Relation table';

-- --------------------------------------------------------

--
-- Структура таблицы `pma__savedsearches`
--

CREATE TABLE `pma__savedsearches` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `search_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `search_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved searches';

-- --------------------------------------------------------

--
-- Структура таблицы `pma__table_coords`
--

CREATE TABLE `pma__table_coords` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `pdf_page_number` int(11) NOT NULL DEFAULT '0',
  `x` float UNSIGNED NOT NULL DEFAULT '0',
  `y` float UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table coordinates for phpMyAdmin PDF output';

-- --------------------------------------------------------

--
-- Структура таблицы `pma__table_info`
--

CREATE TABLE `pma__table_info` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `display_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Структура таблицы `pma__table_uiprefs`
--

CREATE TABLE `pma__table_uiprefs` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `prefs` text COLLATE utf8_bin NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tables'' UI preferences';

--
-- Дамп данных таблицы `pma__table_uiprefs`
--

INSERT INTO `pma__table_uiprefs` (`username`, `db_name`, `table_name`, `prefs`, `last_update`) VALUES
('root', 'snow', 'category', '[]', '2016-04-10 09:41:39'),
('root', 'snow', 'color', '{"sorted_col":"`color`.`id`  ASC"}', '2016-04-10 13:14:32'),
('root', 'snow', 'image', '{"sorted_col":"`id`  ASC","CREATE_TIME":"2016-04-04 18:09:34","col_visib":["1","1","1","1","1"]}', '2016-04-19 13:51:19'),
('root', 'snow', 'product', '{"CREATE_TIME":"2016-03-12 17:51:01","col_visib":["1","1","1","1","1","1","1","1","1","1","1"]}', '2016-04-07 17:27:36'),
('root', 'snow', 'size', '{"sorted_col":"`size`.`id` ASC"}', '2016-04-10 13:16:11');

-- --------------------------------------------------------

--
-- Структура таблицы `pma__tracking`
--

CREATE TABLE `pma__tracking` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `version` int(10) UNSIGNED NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `schema_snapshot` text COLLATE utf8_bin NOT NULL,
  `schema_sql` text COLLATE utf8_bin,
  `data_sql` longtext COLLATE utf8_bin,
  `tracking` set('UPDATE','REPLACE','INSERT','DELETE','TRUNCATE','CREATE DATABASE','ALTER DATABASE','DROP DATABASE','CREATE TABLE','ALTER TABLE','RENAME TABLE','DROP TABLE','CREATE INDEX','DROP INDEX','CREATE VIEW','ALTER VIEW','DROP VIEW') COLLATE utf8_bin DEFAULT NULL,
  `tracking_active` int(1) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Database changes tracking for phpMyAdmin';

-- --------------------------------------------------------

--
-- Структура таблицы `pma__userconfig`
--

CREATE TABLE `pma__userconfig` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `timevalue` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `config_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User preferences storage for phpMyAdmin';

--
-- Дамп данных таблицы `pma__userconfig`
--

INSERT INTO `pma__userconfig` (`username`, `timevalue`, `config_data`) VALUES
('root', '2016-03-10 18:49:34', '{"lang":"ru","collation_connection":"utf8mb4_unicode_ci"}');

-- --------------------------------------------------------

--
-- Структура таблицы `pma__usergroups`
--

CREATE TABLE `pma__usergroups` (
  `usergroup` varchar(64) COLLATE utf8_bin NOT NULL,
  `tab` varchar(64) COLLATE utf8_bin NOT NULL,
  `allowed` enum('Y','N') COLLATE utf8_bin NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User groups with configured menu items';

-- --------------------------------------------------------

--
-- Структура таблицы `pma__users`
--

CREATE TABLE `pma__users` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `usergroup` varchar(64) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Users and their assignments to user groups';

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `pma__central_columns`
--
ALTER TABLE `pma__central_columns`
  ADD PRIMARY KEY (`db_name`,`col_name`);

--
-- Индексы таблицы `pma__column_info`
--
ALTER TABLE `pma__column_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `db_name` (`db_name`,`table_name`,`column_name`);

--
-- Индексы таблицы `pma__designer_settings`
--
ALTER TABLE `pma__designer_settings`
  ADD PRIMARY KEY (`username`);

--
-- Индексы таблицы `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_user_type_template` (`username`,`export_type`,`template_name`);

--
-- Индексы таблицы `pma__favorite`
--
ALTER TABLE `pma__favorite`
  ADD PRIMARY KEY (`username`);

--
-- Индексы таблицы `pma__history`
--
ALTER TABLE `pma__history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`,`db`,`table`,`timevalue`);

--
-- Индексы таблицы `pma__navigationhiding`
--
ALTER TABLE `pma__navigationhiding`
  ADD PRIMARY KEY (`username`,`item_name`,`item_type`,`db_name`,`table_name`);

--
-- Индексы таблицы `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  ADD PRIMARY KEY (`page_nr`),
  ADD KEY `db_name` (`db_name`);

--
-- Индексы таблицы `pma__recent`
--
ALTER TABLE `pma__recent`
  ADD PRIMARY KEY (`username`);

--
-- Индексы таблицы `pma__relation`
--
ALTER TABLE `pma__relation`
  ADD PRIMARY KEY (`master_db`,`master_table`,`master_field`),
  ADD KEY `foreign_field` (`foreign_db`,`foreign_table`);

--
-- Индексы таблицы `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_savedsearches_username_dbname` (`username`,`db_name`,`search_name`);

--
-- Индексы таблицы `pma__table_coords`
--
ALTER TABLE `pma__table_coords`
  ADD PRIMARY KEY (`db_name`,`table_name`,`pdf_page_number`);

--
-- Индексы таблицы `pma__table_info`
--
ALTER TABLE `pma__table_info`
  ADD PRIMARY KEY (`db_name`,`table_name`);

--
-- Индексы таблицы `pma__table_uiprefs`
--
ALTER TABLE `pma__table_uiprefs`
  ADD PRIMARY KEY (`username`,`db_name`,`table_name`);

--
-- Индексы таблицы `pma__tracking`
--
ALTER TABLE `pma__tracking`
  ADD PRIMARY KEY (`db_name`,`table_name`,`version`);

--
-- Индексы таблицы `pma__userconfig`
--
ALTER TABLE `pma__userconfig`
  ADD PRIMARY KEY (`username`);

--
-- Индексы таблицы `pma__usergroups`
--
ALTER TABLE `pma__usergroups`
  ADD PRIMARY KEY (`usergroup`,`tab`,`allowed`);

--
-- Индексы таблицы `pma__users`
--
ALTER TABLE `pma__users`
  ADD PRIMARY KEY (`username`,`usergroup`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `pma__column_info`
--
ALTER TABLE `pma__column_info`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `pma__history`
--
ALTER TABLE `pma__history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  MODIFY `page_nr` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;--
-- База данных: `snow`
--
CREATE DATABASE IF NOT EXISTS `snow` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `snow`;

-- --------------------------------------------------------

--
-- Структура таблицы `available`
--

CREATE TABLE `available` (
  `id` int(10) UNSIGNED NOT NULL,
  `count` int(11) NOT NULL,
  `size_id` int(10) UNSIGNED NOT NULL,
  `color_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `status` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `available`
--

INSERT INTO `available` (`id`, `count`, `size_id`, `color_id`, `product_id`, `status`) VALUES
(71, 11, 1, 0, 1, 1),
(72, 6, 2, 0, 1, 1),
(73, 4, 3, 0, 2, 1),
(74, 25, 4, 0, 3, 1),
(75, 5, 5, 0, 3, 1),
(76, 8, 6, 0, 3, 1),
(77, 11, 7, 0, 3, 1),
(78, 23, 8, 0, 3, 1),
(79, 13, 9, 0, 3, 1),
(80, 21, 10, 13, 4, 1),
(81, 6, 7, 2, 4, 1),
(82, 15, 8, 2, 4, 1),
(83, 3, 9, 2, 4, 1),
(84, 2, 8, 5, 4, 1),
(85, 14, 10, 5, 4, 1),
(86, 6, 4, 5, 4, 1),
(87, 3, 11, 0, 5, 1),
(88, 2, 12, 0, 5, 1),
(92, 5, 3, 0, 6, 1),
(93, 3, 11, 0, 6, 1),
(94, 7, 1, 0, 6, 1),
(95, 7, 13, 1, 7, 1),
(96, 3, 1, 16, 7, 1),
(97, 7, 15, 1, 7, 1),
(98, 4, 8, 1, 7, 1),
(99, 5, 9, 16, 7, 1),
(100, 4, 3, 0, 8, 1),
(101, 3, 11, 0, 8, 1),
(102, 5, 13, 0, 8, 1),
(103, 7, 2, 0, 9, 1),
(104, 4, 8, 0, 9, 1),
(105, 5, 9, 0, 9, 1),
(124, 4, 13, 2, 10, 1),
(125, 3, 4, 2, 10, 1),
(126, 3, 13, 5, 10, 1),
(127, 5, 14, 5, 10, 1),
(128, 4, 11, 5, 10, 1),
(129, 7, 10, 13, 10, 1),
(130, 4, 8, 13, 10, 1),
(131, 3, 4, 4, 10, 1),
(132, 2, 13, 4, 10, 1),
(138, 5, 16, 2, 11, 1),
(139, 6, 11, 2, 11, 1),
(140, 3, 13, 2, 11, 1),
(141, 6, 11, 9, 11, 1),
(142, 2, 16, 9, 11, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `short_name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `image_id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `sort_order` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `name`, `short_name`, `description`, `image_id`, `parent_id`, `sort_order`, `status`) VALUES
(0, 'null', '', 'null', 0, 0, 0, 1),
(1, 'Сноуборд', 'board', 'Зимний олимпийский вид спорта, заключающийся в спуске с заснеженных склонов и гор на специальном снаряде — сноуборде. Изначально зимний вид спорта, хотя отдельные экстрималы освоили его даже летом, катаясь на сноуборде на песчаных склонах.', 1, 0, 1, 1),
(2, 'Сноуборды', 'snowboard', 'Cпортивный снаряд, предназначенный для скоростного спуска с заснеженных склонов и гор. Сноуборд представляет собой многослойную конструкцию (в форме доски с загнутыми торцами, со среднестатистической длинной 140—165 см и шириной примерно с длину ступни райдера) с металлическим кантом по периметру нижней части и креплениями (обычно продаются отдельно) для ног.', 8, 1, 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `char_name`
--

CREATE TABLE `char_name` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `status` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `char_name`
--

INSERT INTO `char_name` (`id`, `name`, `category_id`, `status`) VALUES
(1, 'Форма', 2, 1),
(2, 'Жесткость', 2, 1),
(3, 'Тип', 2, 1),
(4, 'Уровень Катания', 2, 1),
(5, 'Стиль Катания', 2, 1),
(6, 'Пол', 2, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `char_value`
--

CREATE TABLE `char_value` (
  `id` int(10) UNSIGNED NOT NULL,
  `value` varchar(100) NOT NULL,
  `name_id` int(10) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `char_value`
--

INSERT INTO `char_value` (`id`, `value`, `name_id`, `status`) VALUES
(1, 'Camber', 1, 1),
(2, 'Camber-Rocker-Camber', 1, 1),
(3, 'Flat', 1, 1),
(4, 'Flat-Camber-Flat', 1, 1),
(5, 'Roc-Cam-Roc-Cam-Roc', 1, 1),
(6, 'Rocker', 1, 1),
(7, 'Rocker-Camber', 1, 1),
(8, 'Rocker-Camber-Rocker', 1, 1),
(9, 'Rocker-Flat', 1, 1),
(10, 'Rocker-Flat-Rocker', 1, 1),
(11, 'Мягкий', 2, 1),
(12, 'Средний', 2, 1),
(13, 'Жесткий', 2, 1),
(14, 'Очень Жесткий', 2, 1),
(15, 'Асимметричный', 3, 1),
(16, 'Направленный', 3, 1),
(17, 'Направленная Твин-Тип', 3, 1),
(18, 'Твин-Тип', 3, 1),
(19, 'Новичок-Прогресирующий', 4, 1),
(20, 'Прогресирующий-Продвинутый', 4, 1),
(21, 'Продвинутый-Эксперт', 4, 1),
(22, 'All-Mountain', 5, 1),
(23, 'Freeride', 5, 1),
(24, 'Freestyle', 5, 1),
(25, 'Мужской', 6, 1),
(26, 'Женский', 6, 1),
(27, 'Унисекс', 6, 1),
(28, 'Детский', 6, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `color`
--

CREATE TABLE `color` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `value` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `color`
--

INSERT INTO `color` (`id`, `name`, `value`, `status`) VALUES
(0, 'Default', 'Default', 1),
(1, 'Black', '#000000', 1),
(2, 'Blue', '#0000FF', 1),
(3, 'Cyan', '#00FFFF', 1),
(4, 'Gray', '#808080', 1),
(5, 'Green', '#008000', 1),
(6, 'Lime', '#00FF00', 1),
(7, 'Magenta', '#FF00FF', 1),
(8, 'Maroon', '#800000', 1),
(9, 'Navy', '#000080', 1),
(10, 'Olive', '#808000', 1),
(11, 'Orange', '#FFA500', 1),
(12, 'Purple', '#800080', 1),
(13, 'Red', '#FF0000', 1),
(14, 'Silver', '#C0C0C0', 1),
(15, 'Teal', '#008080', 1),
(16, 'White', '#FFFFFF', 1),
(17, 'Yellow', '#FFFF00', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `image`
--

CREATE TABLE `image` (
  `id` int(10) UNSIGNED NOT NULL,
  `path700` varchar(255) NOT NULL,
  `path135` varchar(255) NOT NULL,
  `path50` varchar(225) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `image`
--

INSERT INTO `image` (`id`, `path700`, `path135`, `path50`, `status`) VALUES
(0, '/no image/700.jpg', '/no image/135.jpg', '/no image/50.jpg', 1),
(1, '/9b/65/cb16a2d9355f11c6f0ef2a0853ef8dfc.jpg', '/89/e1/2c00b0d1d21a087876cad031800a4aa1.jpg', '/96/13/c40e8fbb49159530589b562a54d107ad.jpg', 1),
(2, '/34/40/99e862b89945e43cb6cd4dd20a1101c8.jpg', '/a1/16/ba2913d33286c5e853cba12d9328f3ba.jpg', '/f6/1a/842af78ce14ec4242a948fb6815cb44b.jpg', 1),
(3, '/16/82/8783a54bb8c5c4f21d176a703e6a82d1.jpg', '/f3/9c/1620340741af154dbfd71bab4d92c22f.jpg', '/02/61/6b7d3475c495a5d715c1f39dafd6e04d.jpg', 1),
(4, '/80/3a/6f0b25334d532b88795119aa1cfca070.jpg', '/3e/69/dd8c5f40b030b9ab7d059b27242b4a09.jpg', '/a5/a7/f707aeeafaebc07be5af6c73e872cdfa.jpg', 1),
(5, '/2e/af/88cd3b8059c42aa07f02654d89c2f3e3.jpg', '/47/47/0b82c0af6140624ac30d9eabd66a17cd.jpg', '/a5/03/6de354dc56608a2d63a961080ae6b606.jpg', 1),
(6, '/05/33/0d3409f294d5b65d06b68c1c4cc0e2b2.jpg', '/ad/e0/99378954f82e55dc3a5529ca5544fa99.jpg', '/66/31/9ab276db6808cbda71a6718112aaebba.jpg', 1),
(7, '/50/9d/ff150da457ca708454e5b381415c4d70.jpg', '/f7/3e/9fff83893ec28232bc240ea967598f9d.jpg', '/7e/d4/1220e422e1124aac8ddbd8410b5a35f7.jpg', 1),
(8, '/00/b6/25b9dd6f2f0bfe5512a8d90881dced1f.jpg', '/bd/e4/2516eb7ec7d634b27e582d8a253e858c.jpg', '/f8/1b/94de69cdb3393f0e783799169a63b87c.jpg', 1),
(9, '/cd/4c/9861a5a440ecc1a61caa7e947dc7a6f4.jpg', '/15/49/9175bf03847764a24dda6812b863d4f3.jpg', '/ab/02/968e05e308832700479f0222b720fb28.jpg', 1),
(10, '/34/66/71eef9a5fe85695b392cc10e7af31790.jpg', '/a1/c4/5b8c0be5d575a34a49a155aa8f1d0628.jpg', '/9d/fb/5888c6b732b0bf192a9c3a2492ac1570.jpg', 1),
(11, '/77/f7/71eef9a5fe85695b392cc10e7af31790.jpg', '/5b/9c/5b8c0be5d575a34a49a155aa8f1d0628.jpg', '/92/24/5888c6b732b0bf192a9c3a2492ac1570.jpg', 1),
(12, '/3d/61/71eef9a5fe85695b392cc10e7af31790.jpg', '/52/64/5b8c0be5d575a34a49a155aa8f1d0628.jpg', '/b1/d6/5888c6b732b0bf192a9c3a2492ac1570.jpg', 1),
(13, '/f9/e4/71eef9a5fe85695b392cc10e7af31790.jpg', '/93/9e/5b8c0be5d575a34a49a155aa8f1d0628.jpg', '/a6/34/5888c6b732b0bf192a9c3a2492ac1570.jpg', 1),
(14, '/ad/1a/71eef9a5fe85695b392cc10e7af31790.jpg', '/7e/fb/5b8c0be5d575a34a49a155aa8f1d0628.jpg', '/40/85/5888c6b732b0bf192a9c3a2492ac1570.jpg', 1),
(15, '/7f/f0/c73e41049155dbdc84a832853c1beece.jpg', '/0b/69/3ec9fedc04770a3a28bad4d928f0ac83.jpg', '/dd/5f/2e005b2bc8ac4a602a65dbeeeeee8cfd.jpg', 1),
(16, '/1d/b5/25b9dd6f2f0bfe5512a8d90881dced1f.jpg', '/57/f8/2516eb7ec7d634b27e582d8a253e858c.jpg', '/a0/c8/94de69cdb3393f0e783799169a63b87c.jpg', 1),
(17, '/27/ed/f8386e2c78e7f4caad8156da832e532d.jpg', '/7d/5c/7f50f6a4c7a54d101ae6067012b280cc.jpg', '/04/2b/06288b03dc8a3105d8f26b292038e882.jpg', 1),
(18, '/fc/76/01f5c2b1c61fcab6d03fe94156323d04.jpg', '/1b/b7/b17af997ab9658d0eb145fc4dd04127c.jpg', '/9a/55/7476afebd06e1a5f24125fa81d079e02.jpg', 1),
(19, '/ab/7a/f8386e2c78e7f4caad8156da832e532d.jpg', '/47/2d/7f50f6a4c7a54d101ae6067012b280cc.jpg', '/a0/ff/06288b03dc8a3105d8f26b292038e882.jpg', 1),
(20, '/e0/ec/01f5c2b1c61fcab6d03fe94156323d04.jpg', '/9a/9b/b17af997ab9658d0eb145fc4dd04127c.jpg', '/17/3d/7476afebd06e1a5f24125fa81d079e02.jpg', 1),
(21, '/9e/ee/b312830d79e33cdfe90cbda3022a188f.jpg', '/db/95/086253e728bc3abb21d1a83a287406ad.jpg', '/ae/11/935bd6e30c44e3275d28b826c510255f.jpg', 1),
(22, '/cd/a3/cb0a01f7f647027457ac258e9340b92c.jpg', '/2b/21/78d3fce5570ea08ed5e31b49c2b7825b.jpg', '/2d/1d/653d723ed7ad3f0f44e414636a861bbe.jpg', 1),
(23, '/0b/6a/7cdcd3e0ab2f0b377c657c787ce688ef.jpg', '/e9/52/8c96158ed7abfbd11cf35240d5255cd8.jpg', '/d9/ae/8e371b8ac6de357a202e82ea9b488c67.jpg', 1),
(24, '/0a/fa/2bb4391b03e30f95155855b95ba3260c.jpg', '/17/7a/dcaa40c20fe278cbc1e1de9c63842d58.jpg', '/e6/e5/17d58d888c27682835fc5d12cea68428.jpg', 1),
(25, '/a8/4d/0f85d5f11dd940f4b23971d546164809.jpg', '/0a/7b/ea4ba1353867b1e1145732c41c91841b.jpg', '/02/85/8a4ad829a17189786b81cc94bec23739.jpg', 1),
(26, '/66/aa/465ffd1e9c6639b1bf3a672c8b22b98d.jpg', '/a8/5e/28fa62b460c81afad0c196b3afe71219.jpg', '/cd/39/61d3a23cea95f56eb6eef84e85275c9f.jpg', 1),
(27, '/f9/93/2e706a68e11047062707a7e523af39d9.jpg', '/ad/41/0c65e35a370b976797c64f3c85b1257d.jpg', '/85/7a/c7b53675ea3d81099a44828e30671209.jpg', 1),
(28, '/96/33/8cb5c0b11e2a3b0fb68a2f4bcb0b3ed3.jpg', '/7e/5c/a299b2ee909598ac97ba6cc2164f4b68.jpg', '/be/55/1e4ac0fed4a4a01ed28a5071a6bf4d00.jpg', 1),
(29, '/ee/de/0955f4b001298fba8037ecd16479644a.jpg', '/09/81/aed3e1788afa901803c2bce7d339d40d.jpg', '/6f/02/3fff711ee12d9032e45c06f1e51b15de.jpg', 1),
(30, '/04/d7/b9269397ee7e7e1777da2bc40fe6ac9f.jpg', '/5e/0e/9152c24f180f0c238076097dc5b97106.jpg', '/d5/08/a4808b8d9f1ac83dfb27c16950747873.jpg', 1),
(31, '/f1/92/2e4a617f38e51cf3ca5f0feae883283e.jpg', '/6f/18/b41a62a9f0d33a84847fb2ea9c7a00c7.jpg', '/fe/2d/1ba3e220fed478836241090d91429d0e.jpg', 1),
(32, '/90/f3/d90a2fc547d088c91b6287aa08a12457.jpg', '/20/b7/32a5a06b47508c1785fd68f451e89328.jpg', '/5c/f8/aa637f6165837f14b71d928c85fd3b33.jpg', 1),
(33, '/ce/c0/cb16a2d9355f11c6f0ef2a0853ef8dfc.jpg', '/60/99/2c00b0d1d21a087876cad031800a4aa1.jpg', '/f7/fb/c40e8fbb49159530589b562a54d107ad.jpg', 1),
(34, '/82/9b/e9297063c45a00a15eea4e97c9586fbb.jpg', '/bf/07/2d3fb4cbc288a7b01f213eafcb8fd5fe.jpg', '/67/20/34e7e5da303689cc8c6aa771caae9275.jpg', 1),
(35, '/ca/76/3636f60344ca217c9fb26f69ff0a0bf3.jpg', '/12/fd/7a802bfc0fb174d4845ed51283ea1b42.jpg', '/f6/31/919d45ee7da3692c0e9ebddb1907c59d.jpg', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `producer`
--

CREATE TABLE `producer` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `image_id` int(10) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `producer`
--

INSERT INTO `producer` (`id`, `name`, `image_id`, `status`) VALUES
(1, 'Burton', 2, 1),
(2, 'CAPiTA', 3, 1),
(3, 'DC', 4, 1),
(4, 'Flow', 5, 1),
(5, 'Never Summer', 6, 1),
(6, 'Rome', 7, 1),
(7, 'Jones', 9, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `product`
--

CREATE TABLE `product` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `producer_id` int(10) UNSIGNED NOT NULL,
  `price` int(10) UNSIGNED NOT NULL,
  `year` int(10) UNSIGNED NOT NULL,
  `short_description` text NOT NULL,
  `description` text NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `is_new` tinyint(1) NOT NULL DEFAULT '0',
  `is_recomended` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `product`
--

INSERT INTO `product` (`id`, `name`, `producer_id`, `price`, `year`, `short_description`, `description`, `category_id`, `is_new`, `is_recomended`, `status`) VALUES
(1, 'Ripsaw', 5, 416, 2016, ' ', ' ', 2, 0, 0, 1),
(2, 'Focus', 3, 224, 2016, ' ', ' ', 2, 0, 0, 1),
(3, 'Mountain Twin', 7, 425, 2016, 'Mountain Twin игривый и отзывчивый, идеально подходит как сноуборд на все случаи жизни.', 'Mountain Twin игривый и отзывчивый, идеально подходит для тех, кто хочет один сноуборд на все случаи жизни. Создан, чтобы превратить всю гору в персональный парк, не жертвуя высокими скоростями и стабильностью хода. Рокер в носу и  хвосте не дают доске тонуть в глубоком снегу, а кембер области закладных + Magne- Traction дают мертвую хватку на жестком склоне.﻿', 2, 1, 1, 1),
(4, 'Aviator', 7, 468, 2016, 'Идеально подходящий для подготовленных склонов и технического фристайла.', 'Суперстабильный универсал, идеально подходящий для подготовленных склонов и технического фристайла. Aviator также выбирают эксперты фрирайда, приверженцы старой школы, которым нужен только классический прогиб. Прогиб 3D-Power Camber -  кембер с приподнятыми кантами на концах контактных зон канта делает доску отзывчивой и жесткой, но немного игривой, добавляет плавучести в глубоком снегу.﻿', 2, 0, 1, 1),
(5, 'Artifact Rocker', 6, 260, 2016, 'Сноуборд  Rome Artifact Rocker это лучшая доска для джиба.', 'Сноуборд  Rome Artifact Rocker это лучшая доска для джиба на которой катает вся команда джиберов Rome. Сердечник деки идеально настроен для джиба, поэтому Artifact это покоритель перил и самых стайловых прессов. С 2013 года доска имеет карбоновые стрингеры HotRods в носу и тейле, благодаря которым разработчики смогли добиться отличного олли. Усиленные пластины из стекловолокна под креплениями позволяют выдерживать жесткие дизастеры на перилки и сходы в стрите. Кроме всего прочего в доске используется технология QuickRip Sidecut, что дает дополнительные контактные точки на кантах, благодаря которым доска просто вгрызается в жесткий склон и лед, тем самым позволяя вам проезжать участки льда, даже не замечая их.', 2, 1, 0, 1),
(6, 'Venus', 4, 245, 2016, 'Сноуборд Flow Venus понравится девушкам, ориентированным на катание по всей горе.', 'Сноуборд Flow Venus с лёгким рокером между креплений и слегка направленной формой очень понравится девушкам, ориентированным на универсальное катание по всей горе и обожающим ощущение плавучести. Если ты возьмёшь этот сноуборд в бэккантри, то сразу же заметишь, насколько легче с ним стали повороты, а так же задняя нога не сгорает от напряжения, даже если катать целый день.', 2, 0, 0, 1),
(7, 'Merc', 4, 210, 2016, 'Сноуборд Flow Merc сконструирован специально для начинающих.', 'Сноуборд Flow Merc сконструирован специально для начинающих. Он позволяет легко прогрессировать в сноубординге. Гибридный рокер - это то, что нужно для отработки техники, он не подведет и в пухляке.', 2, 1, 0, 1),
(8, 'Jewel', 4, 260, 2015, 'С доской Flow Jewel 2015 Вы сможете кататься везде уверенно и стильно.', 'С доской Flow Jewel 2015 Вы сможете кататься везде уверенно и стильно - от бэккантри до парка. Этот сноуборд является выбором профессиональной сноубордистки Sarka Pankochova для пайпа и слоупстайла. Flow Jewel представляет собой отличное соотношение продольной мягкости для фана и торсионной жесткости для больших скоростей.', 2, 1, 0, 1),
(9, 'Cobra X', 5, 456, 2016, 'Широкая версия сноуборда EVO,  для и снижения веса при вращениях и максимального контроля.', '«Never Summer Cobra X» ― широкая версия сноуборда EVO, доска спроектированная для и сниженного веса при вращениях и максимального контроля. Новая форма «блант» (срезанных концов) также имеет увеличенную эффективную рабочую длину канта для ещё большей стабильности и точности вылетов и приземлений. Зональный сердечник “PressFlexCore” дает новые возможности играть и «прессить» в парке и на трассах как угодно, тогда так комбинация силовых вилок «Carbon VXR» даёт заряд «щелчка» и живость. Это уникальный, легкий и мощный сноуборд который обеспечивает своему владельцу стабильность на высоких скоростях и надежность, благодаря виброгасящей системе “EDS”, такое явление редко встречающуюся в сноубордах для фристайла. Форма Twin Tip- . Конструкция – сэндвич.  Жесткость – 4/10. Обратный прогиб.', 2, 0, 0, 1),
(10, 'Factory Rocker', 6, 210, 2016, 'Прекрасный контроль на скорости и контролируемые приземления на трамплинах.', 'Сердечник доски Pop CoreMatrix это две  зоны с низкой плотностью древесины и расширенными фрагментами тополя.\r\nMtnpop Rocker 2 — Переработан в 2016 сезоне, мы изменили радиус рокера между ногами, так что теперь он, и контактные точки на канте касаются снега на не нагруженной доске.\r\nРокер между креплениями в сочетании с классическим прогибом под креплениями, и рокером в зоне носа и хвоста, делает доску универсальным снарядом, который не подведет ни в парке, ни на кикерах, ни в глубоком снегу а также идеальный контроль доски на больших скоростях, будь то лед, вельвет, или просто укатанный до бетона снег. В сочетании с технологией QuckRip, которая добавляет доске еще несколько контактных точек на кантах, доски с Mtnpop рокером идеально подходят для катания по любым склонам.\r\nНекоторые райдеры называют его лучшим рокером объединившим катание в парках на трамплинах, и идеальным контролем скорости на жестких склонах, и вне трасс.', 2, 0, 1, 1),
(11, 'Deja Vu Flying V', 1, 336, 2016, 'Deja Vu вобрал в себя маневренность рокера и стабильность кэмбера благодаря прогибу Flying V', 'Burton Deja Vu. Этот Сноуборд вобрал в себя маневренность рокера и стабильность кэмбера благодаря прогибу Flying V, а симметричная форма позволит Вам наслаждаться катанием в свиче или, например, обучению этому полезному умению. Burton Deja Vu будет стабильно вести себя на скоростях и останется достаточно послушным даже на твердой ледяной трассе благодаря расширенным выступающим кантам в зоне креплений для лучшего сцепления. Если Вы ищете универсальный Сноуборд для динамичного катания и получения адреналина на скоростных спусках и прыжков в парке, то Deja Vu станет отличным выбором.', 2, 0, 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `product_has_image`
--

CREATE TABLE `product_has_image` (
  `product_id` int(10) UNSIGNED NOT NULL,
  `image_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `product_has_image`
--

INSERT INTO `product_has_image` (`product_id`, `image_id`) VALUES
(1, 14),
(2, 15),
(3, 18),
(3, 19),
(3, 20),
(4, 21),
(4, 22),
(4, 23),
(5, 24),
(6, 25),
(7, 26),
(7, 27),
(8, 28),
(9, 29),
(10, 30),
(10, 31),
(10, 32),
(10, 33),
(11, 34),
(11, 35);

-- --------------------------------------------------------

--
-- Структура таблицы `product_has_value`
--

CREATE TABLE `product_has_value` (
  `product_id` int(10) UNSIGNED NOT NULL,
  `value_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `product_has_value`
--

INSERT INTO `product_has_value` (`product_id`, `value_id`) VALUES
(1, 2),
(1, 13),
(1, 18),
(1, 21),
(1, 22),
(1, 27),
(2, 6),
(2, 12),
(2, 18),
(2, 19),
(2, 24),
(2, 27),
(3, 8),
(3, 13),
(3, 17),
(3, 21),
(3, 23),
(3, 27),
(4, 1),
(4, 13),
(4, 17),
(4, 21),
(4, 24),
(4, 25),
(5, 10),
(5, 12),
(5, 18),
(5, 20),
(5, 24),
(5, 25),
(6, 3),
(6, 11),
(6, 17),
(6, 19),
(6, 22),
(6, 26),
(7, 2),
(7, 12),
(7, 17),
(7, 19),
(7, 22),
(7, 25),
(8, 2),
(8, 12),
(8, 18),
(8, 20),
(8, 24),
(8, 26),
(9, 2),
(9, 13),
(9, 17),
(9, 20),
(9, 22),
(9, 27),
(10, 2),
(10, 12),
(10, 18),
(10, 20),
(10, 22),
(10, 27),
(11, 5),
(11, 12),
(11, 18),
(11, 20),
(11, 24),
(11, 26);

-- --------------------------------------------------------

--
-- Структура таблицы `size`
--

CREATE TABLE `size` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `size`
--

INSERT INTO `size` (`id`, `name`, `category_id`, `status`) VALUES
(0, 'Default', 0, 1),
(1, '153', 2, 1),
(2, '159', 2, 1),
(3, '144', 2, 1),
(4, '154', 2, 1),
(5, '155W', 2, 1),
(6, '157', 2, 1),
(7, '158W', 2, 1),
(8, '160', 2, 1),
(9, '162', 2, 1),
(10, '158', 2, 1),
(11, '147', 2, 1),
(12, '152MV', 2, 1),
(13, '150', 2, 1),
(14, '156', 2, 1),
(15, '156W', 2, 1),
(16, '138', 2, 1),
(17, '141', 2, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `login` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `hash` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `email`, `login`, `password`, `hash`, `status`) VALUES
(1, '', '', '', 'admin', '4a225ea05f3a199443848ac2f9d9e360', 'd223e950a2d1412bd0415f3a7436ec6b', 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `available`
--
ALTER TABLE `available`
  ADD PRIMARY KEY (`id`,`size_id`,`color_id`,`product_id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `fk_available_color1_idx` (`color_id`),
  ADD KEY `fk_available_size1_idx` (`size_id`),
  ADD KEY `fk_available_product1_idx` (`product_id`);

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`,`image_id`,`parent_id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `fk_category_category_idx` (`parent_id`),
  ADD KEY `fk_category_image1_idx` (`image_id`);

--
-- Индексы таблицы `char_name`
--
ALTER TABLE `char_name`
  ADD PRIMARY KEY (`id`,`category_id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `fk_char_name_category1_idx` (`category_id`);

--
-- Индексы таблицы `char_value`
--
ALTER TABLE `char_value`
  ADD PRIMARY KEY (`id`,`name_id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `fk_char_value_char_name1_idx` (`name_id`);

--
-- Индексы таблицы `color`
--
ALTER TABLE `color`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD UNIQUE KEY `value_UNIQUE` (`value`);

--
-- Индексы таблицы `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- Индексы таблицы `producer`
--
ALTER TABLE `producer`
  ADD PRIMARY KEY (`id`,`image_id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `fk_producer_image1_idx` (`image_id`);

--
-- Индексы таблицы `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`,`producer_id`,`category_id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `fk_product_category1_idx` (`category_id`),
  ADD KEY `fk_product_producer1_idx` (`producer_id`);

--
-- Индексы таблицы `product_has_image`
--
ALTER TABLE `product_has_image`
  ADD PRIMARY KEY (`product_id`,`image_id`),
  ADD KEY `fk_product_has_image_image1_idx` (`image_id`),
  ADD KEY `fk_product_has_image_product1_idx` (`product_id`);

--
-- Индексы таблицы `product_has_value`
--
ALTER TABLE `product_has_value`
  ADD PRIMARY KEY (`product_id`,`value_id`),
  ADD KEY `fk_product_has_char_value_char_value1_idx` (`value_id`),
  ADD KEY `fk_product_has_char_value_product1_idx` (`product_id`);

--
-- Индексы таблицы `size`
--
ALTER TABLE `size`
  ADD PRIMARY KEY (`id`,`category_id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `fk_size_category1_idx` (`category_id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD UNIQUE KEY `login_UNIQUE` (`login`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `available`
--
ALTER TABLE `available`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;
--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `char_name`
--
ALTER TABLE `char_name`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `char_value`
--
ALTER TABLE `char_value`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT для таблицы `color`
--
ALTER TABLE `color`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT для таблицы `image`
--
ALTER TABLE `image`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT для таблицы `producer`
--
ALTER TABLE `producer`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT для таблицы `product`
--
ALTER TABLE `product`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT для таблицы `size`
--
ALTER TABLE `size`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `available`
--
ALTER TABLE `available`
  ADD CONSTRAINT `fk_available_color1` FOREIGN KEY (`color_id`) REFERENCES `color` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_available_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_available_size1` FOREIGN KEY (`size_id`) REFERENCES `size` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `fk_category_category` FOREIGN KEY (`parent_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_category_image1` FOREIGN KEY (`image_id`) REFERENCES `image` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `char_name`
--
ALTER TABLE `char_name`
  ADD CONSTRAINT `fk_char_name_category1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `char_value`
--
ALTER TABLE `char_value`
  ADD CONSTRAINT `fk_char_value_char_name1` FOREIGN KEY (`name_id`) REFERENCES `char_name` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `producer`
--
ALTER TABLE `producer`
  ADD CONSTRAINT `fk_producer_image1` FOREIGN KEY (`image_id`) REFERENCES `image` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_product_category1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_product_producer1` FOREIGN KEY (`producer_id`) REFERENCES `producer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `product_has_image`
--
ALTER TABLE `product_has_image`
  ADD CONSTRAINT `fk_product_has_image_image1` FOREIGN KEY (`image_id`) REFERENCES `image` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_product_has_image_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `product_has_value`
--
ALTER TABLE `product_has_value`
  ADD CONSTRAINT `fk_product_has_char_value_char_value1` FOREIGN KEY (`value_id`) REFERENCES `char_value` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_product_has_char_value_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `size`
--
ALTER TABLE `size`
  ADD CONSTRAINT `fk_size_category1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
--
-- База данных: `test`
--
CREATE DATABASE IF NOT EXISTS `test` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `test`;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
