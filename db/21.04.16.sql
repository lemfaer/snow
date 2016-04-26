-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Апр 21 2016 г., 17:21
-- Версия сервера: 10.1.10-MariaDB
-- Версия PHP: 7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `snow`
--

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
(80, 21, 10, 13, 4, 1),
(81, 6, 7, 2, 4, 1),
(82, 15, 8, 2, 4, 1),
(83, 3, 9, 2, 4, 1),
(84, 2, 8, 5, 4, 1),
(85, 14, 10, 5, 4, 1),
(86, 6, 4, 5, 4, 1),
(87, 3, 11, 0, 5, 1),
(88, 2, 12, 0, 5, 1),
(95, 7, 13, 1, 7, 1),
(96, 3, 1, 16, 7, 1),
(97, 7, 15, 1, 7, 1),
(98, 4, 8, 1, 7, 1),
(99, 5, 9, 16, 7, 1),
(100, 4, 3, 0, 8, 1),
(101, 3, 11, 0, 8, 1),
(102, 5, 13, 0, 8, 1),
(124, 4, 13, 2, 10, 1),
(125, 3, 4, 2, 10, 1),
(126, 3, 13, 5, 10, 1),
(127, 5, 14, 5, 10, 1),
(128, 4, 11, 5, 10, 1),
(129, 7, 10, 13, 10, 1),
(130, 4, 8, 13, 10, 1),
(131, 3, 4, 4, 10, 1),
(132, 2, 13, 4, 10, 1),
(143, 6, 20, 0, 12, 1),
(144, 12, 19, 0, 12, 1),
(145, 10, 21, 0, 12, 1),
(146, 3, 11, 0, 14, 1),
(147, 6, 1, 0, 14, 1),
(148, 7, 10, 0, 14, 1),
(149, 5, 16, 2, 11, 1),
(150, 6, 11, 2, 11, 1),
(151, 3, 13, 2, 11, 1),
(152, 6, 11, 9, 11, 1),
(153, 2, 16, 9, 11, 1),
(154, 7, 2, 0, 9, 1),
(155, 4, 8, 0, 9, 1),
(156, 5, 9, 0, 9, 1),
(157, 5, 3, 0, 6, 1),
(158, 3, 11, 0, 6, 1),
(159, 7, 1, 0, 6, 1),
(160, 25, 4, 0, 3, 1),
(161, 5, 5, 0, 3, 1),
(162, 8, 6, 0, 3, 1),
(163, 11, 7, 0, 3, 1),
(164, 23, 8, 0, 3, 1),
(165, 13, 9, 0, 3, 1),
(166, 22, 25, 16, 16, 1),
(167, 28, 27, 16, 16, 1),
(168, 25, 25, 1, 16, 1),
(169, 6, 27, 1, 16, 1),
(170, 7, 25, 2, 17, 1),
(171, 22, 27, 2, 17, 1),
(172, 17, 25, 16, 17, 1),
(173, 5, 29, 16, 17, 1),
(174, 6, 27, 1, 17, 1),
(175, 23, 25, 1, 17, 1),
(176, 17, 29, 1, 17, 1),
(180, 30, 25, 0, 18, 1),
(181, 28, 27, 0, 18, 1),
(182, 14, 29, 0, 18, 1),
(183, 8, 23, 1, 19, 1),
(184, 17, 25, 1, 19, 1),
(185, 18, 27, 1, 19, 1),
(186, 5, 25, 16, 19, 1),
(187, 6, 27, 16, 19, 1);

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
(1, 'Сноуборд', 'snowboard', 'Зимний олимпийский вид спорта, заключающийся в спуске с заснеженных склонов и гор на специальном снаряде — сноуборде. Изначально зимний вид спорта, хотя отдельные экстрималы освоили его даже летом, катаясь на сноуборде на песчаных склонах.', 1, 0, 1, 1),
(2, 'Сноуборды', 'boards', 'Cпортивный снаряд, предназначенный для скоростного спуска с заснеженных склонов и гор. Сноуборд представляет собой многослойную конструкцию (в форме доски с загнутыми торцами, со среднестатистической длинной 140—165 см и шириной примерно с длину ступни райдера) с металлическим кантом по периметру нижней части и креплениями (обычно продаются отдельно) для ног.', 8, 1, 1, 1),
(3, 'Крепления', 'bindings', ' ', 40, 1, 2, 1),
(4, 'Ботинки', 'boots', ' ', 54, 1, 3, 1);

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
(6, 'Пол', 2, 1),
(7, 'Жесткость', 3, 1),
(8, 'Уровень Катания', 3, 1),
(9, 'Вид Крепления', 3, 1),
(10, 'Пол', 3, 1),
(11, 'Жесткость', 4, 1),
(12, 'Уровень Катания', 4, 1),
(13, 'Система Шнуровки', 4, 1);

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
(28, 'Детский', 6, 1),
(29, 'Мягкий', 7, 1),
(30, 'Средний', 7, 1),
(31, 'Жесткий', 7, 1),
(32, 'Очень Жесткий', 7, 1),
(33, 'Новичок-Прогресирующий', 8, 1),
(34, 'Прогресирующий-Продвинутый', 8, 1),
(35, 'Продвинутый-Эксперт', 8, 1),
(36, 'Ремешок', 9, 1),
(37, 'Step-In', 9, 1),
(38, 'Мужской', 10, 1),
(39, 'Женский', 10, 1),
(40, 'Унисекс', 10, 1),
(41, 'Детский', 10, 1),
(42, 'Мягкий', 11, 1),
(43, 'Средний', 11, 1),
(44, 'Жесткий', 11, 1),
(45, 'Очень Жесткий', 11, 1),
(46, 'Новичок-Прогресирующий', 12, 1),
(47, 'Прогресирующий-Продвинутый', 12, 1),
(48, 'Продвинутый-Эксперт', 12, 1),
(49, 'Boa', 13, 1),
(50, 'Быстрая Шнуровка', 13, 1),
(51, 'Традиционная', 13, 1),
(52, 'Velcro', 13, 1);

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
(35, '/ca/76/3636f60344ca217c9fb26f69ff0a0bf3.jpg', '/12/fd/7a802bfc0fb174d4845ed51283ea1b42.jpg', '/f6/31/919d45ee7da3692c0e9ebddb1907c59d.jpg', 1),
(36, '/03/a0/3783707bff36b4e6c5c196a6002bfade.jpg', '/c1/67/4c2abf7214ab07883113d1ffa9a2447b.jpg', '/8e/03/15656d7abd6451003ed2e19599a85c2a.jpg', 1),
(37, '/16/c1/6ef468fa820d878487a27ec0c58b5d28.jpg', '/97/86/a2e3fdf3df7426e03886ade5300bfe9c.jpg', '/a1/65/62e44423c48aa194d59eec70a7cf9d0d.jpg', 1),
(38, '/ed/61/3835aaf9ead5756ee46d7b215fb51944.jpg', '/1e/a2/57a942d06f9d17ebe6423106008ffc7b.jpg', '/db/0f/8b86ab2dd2a5732d2ebfd641f23da0d8.jpg', 1),
(39, '/9c/30/3dab4e83b51fe459f7557f3322e540de.jpg', '/ab/c9/7ad3a075dfce93a157733824a4b7de02.jpg', '/73/16/02fbf48301871e4067f52ae0ba34488e.jpg', 1),
(40, '/6e/b7/ee1adae6e37effecd74650530e79839c.jpg', '/06/1f/d5b1087f1e274acb4607754f0d24b330.jpg', '/2b/2c/eea11943fd657157c14ad8efc34e4b52.jpg', 1),
(41, '/b4/12/85fa605ed51150e95d5997a8a8832c46.jpg', '/81/38/0241331b734f37338319e3b2ed10629a.jpg', '/7b/4d/019d603b3142e567c40de44935d1e7ad.jpg', 1),
(42, '/70/cc/2644dbe3d73be182657c64f9e862ba1b.jpg', '/7e/61/3b19cf0d81d66fa021d953be66b02a69.jpg', '/3c/55/fa90d37d850e8cbf24717e02f35fadc0.jpg', 1),
(43, '/58/e1/f4923fe2797098e96a129794166792d9.jpg', '/8c/12/40c9a5bf21c22de638f50fea7b2d213e.jpg', '/9e/bd/4b787b051661403fb53f9ad7a3702098.jpg', 1),
(44, '/9f/a7/a56926f1e068fd4cd3a17030c3f7bf85.jpg', '/f8/de/78cacd0c6ff0d94a170c7a7358fc26d7.jpg', '/20/4f/0d442daf657437e1aa9ad8ac78d45fea.jpg', 1),
(45, '/b2/6b/b4bf98608e90e2ef74a90835897bc3f9.jpg', '/4b/00/f3915e835934b96fb69d7cf70d4c73a7.jpg', '/0f/f1/e38558f8bc84a93404997376f8fdf13a.jpg', 1),
(46, '/4b/d5/1e4cc2f3e9df631646c5a08e3af038aa.jpg', '/9e/9f/e586ad8a3df01a3d6805a8ce96079d06.jpg', '/c1/d2/a7612f9166acc902589bf06cb9db969b.jpg', 1),
(47, '/fe/e6/2a708b272d157f79dfb57589e92fefa3.jpg', '/91/64/e6afe8289a99babf388ef5f90c30878c.jpg', '/e3/8d/7c1f032847556384d466eeb100a6e6ce.jpg', 1),
(48, '/45/40/aff914e64ef6997274a89299399c2b7a.jpg', '/33/eb/04b6cac0c90c396260694b5557b9b522.jpg', '/f7/0e/0408e85e8875c90d8afd011ddc5d5c08.jpg', 1),
(49, '/c1/8b/7e19297488e4346015c38e86fac774cf.jpg', '/29/3c/5cf82696613bc9de291c8d404ac53c31.jpg', '/5e/35/86fe0cb56ee1fa543164580e45ce9518.jpg', 1),
(50, '/da/5a/92e482d30ae5651449687e6a72d87dac.jpg', '/9c/50/7b520203aaae62baba2628e5cda259a6.jpg', '/01/8f/b42c6cdac82da758709a2b98927e5d5d.jpg', 1),
(51, '/e5/6a/65714eda37b6656785722567547e26fc.jpg', '/51/37/13d6e90f83f5c88ffbd043e855319da1.jpg', '/c7/60/a4715b9a37a1099bbcaf118f80b61946.jpg', 1),
(52, '/66/09/7e666d0809885db0bfa9a860ac63d3eb.jpg', '/38/9f/b411b1d75a2dd64e229056cb9ba3ec45.jpg', '/51/4f/f632629cc388ae7205afa3e60b35eddf.jpg', 1),
(53, '/ef/a4/ae3562e5fe41ccf3322dca7f67f19af9.jpg', '/c9/59/689e448c959517aa6aa43fbdeece5b25.jpg', '/35/2a/13d82102e8d86d8df55ecf630f353190.jpg', 1),
(54, '/05/72/25df50150763f6af362076145e6d57a2.jpg', '/c5/c0/214949f06cb06ef0eb987b44856bf979.jpg', '/12/78/6cd1c385e282bee98606652ec08c3c35.jpg', 1);

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
(1, 'Ripsaw', 5, 416, 2016, '', '', 2, 0, 0, 1),
(2, 'Focus', 3, 224, 2016, '', '', 2, 0, 0, 1),
(3, 'Mountain Twin', 7, 425, 2016, 'Mountain Twin идеально подходит как сноуборд на все случаи жизни.', 'Mountain Twin игривый и отзывчивый, идеально подходит для тех, кто хочет один сноуборд на все случаи жизни. Создан, чтобы превратить всю гору в персональный парк, не жертвуя высокими скоростями и стабильностью хода. Рокер в носу и  хвосте не дают доске тонуть в глубоком снегу, а кембер области закладных + Magne- Traction дают мертвую хватку на жестком склоне.﻿', 2, 1, 1, 1),
(4, 'Aviator', 7, 468, 2016, 'Идеально подходящий для подготовленных склонов и технического фристайла.', 'Суперстабильный универсал, идеально подходящий для подготовленных склонов и технического фристайла. Aviator также выбирают эксперты фрирайда, приверженцы старой школы, которым нужен только классический прогиб. Прогиб 3D-Power Camber -  кембер с приподнятыми кантами на концах контактных зон канта делает доску отзывчивой и жесткой, но немного игривой, добавляет плавучести в глубоком снегу.﻿', 2, 0, 1, 1),
(5, 'Artifact Rocker', 6, 260, 2016, 'Сноуборд  Rome Artifact Rocker это лучшая доска для джиба.', 'Сноуборд  Rome Artifact Rocker это лучшая доска для джиба на которой катает вся команда джиберов Rome. Сердечник деки идеально настроен для джиба, поэтому Artifact это покоритель перил и самых стайловых прессов. С 2013 года доска имеет карбоновые стрингеры HotRods в носу и тейле, благодаря которым разработчики смогли добиться отличного олли. Усиленные пластины из стекловолокна под креплениями позволяют выдерживать жесткие дизастеры на перилки и сходы в стрите. Кроме всего прочего в доске используется технология QuickRip Sidecut, что дает дополнительные контактные точки на кантах, благодаря которым доска просто вгрызается в жесткий склон и лед, тем самым позволяя вам проезжать участки льда, даже не замечая их.', 2, 1, 0, 1),
(6, 'Venus', 4, 245, 2016, 'Flow Venus понравится девушкам, для катание по всей горе.', 'Сноуборд Flow Venus с лёгким рокером между креплений и слегка направленной формой очень понравится девушкам, ориентированным на универсальное катание по всей горе и обожающим ощущение плавучести. Если ты возьмёшь этот сноуборд в бэккантри, то сразу же заметишь, насколько легче с ним стали повороты, а так же задняя нога не сгорает от напряжения, даже если катать целый день.', 2, 0, 0, 1),
(7, 'Merc', 4, 210, 2016, 'Сноуборд Flow Merc сконструирован специально для начинающих.', 'Сноуборд Flow Merc сконструирован специально для начинающих. Он позволяет легко прогрессировать в сноубординге. Гибридный рокер - это то, что нужно для отработки техники, он не подведет и в пухляке.', 2, 1, 0, 1),
(8, 'Jewel', 4, 260, 2015, 'С доской Flow Jewel 2015 Вы сможете кататься везде уверенно и стильно.', 'С доской Flow Jewel 2015 Вы сможете кататься везде уверенно и стильно - от бэккантри до парка. Этот сноуборд является выбором профессиональной сноубордистки Sarka Pankochova для пайпа и слоупстайла. Flow Jewel представляет собой отличное соотношение продольной мягкости для фана и торсионной жесткости для больших скоростей.', 2, 1, 0, 1),
(9, 'Cobra X', 5, 456, 2016, 'Широкая версия сноуборда EVO,  для и снижения веса и максимального контроля.', '«Never Summer Cobra X» ― широкая версия сноуборда EVO, доска спроектированная для и сниженного веса при вращениях и максимального контроля. Новая форма «блант» (срезанных концов) также имеет увеличенную эффективную рабочую длину канта для ещё большей стабильности и точности вылетов и приземлений. Зональный сердечник “PressFlexCore” дает новые возможности играть и «прессить» в парке и на трассах как угодно, тогда так комбинация силовых вилок «Carbon VXR» даёт заряд «щелчка» и живость. Это уникальный, легкий и мощный сноуборд который обеспечивает своему владельцу стабильность на высоких скоростях и надежность, благодаря виброгасящей системе “EDS”, такое явление редко встречающуюся в сноубордах для фристайла. Форма Twin Tip- . Конструкция – сэндвич.  Жесткость – 4/10. Обратный прогиб.', 2, 0, 0, 1),
(10, 'Factory Rocker', 6, 210, 2016, 'Прекрасный контроль на скорости и контролируемые приземления на трамплинах.', 'Сердечник доски Pop CoreMatrix это две  зоны с низкой плотностью древесины и расширенными фрагментами тополя.\r\nMtnpop Rocker 2 — Переработан в 2016 сезоне, мы изменили радиус рокера между ногами, так что теперь он, и контактные точки на канте касаются снега на не нагруженной доске.\r\nРокер между креплениями в сочетании с классическим прогибом под креплениями, и рокером в зоне носа и хвоста, делает доску универсальным снарядом, который не подведет ни в парке, ни на кикерах, ни в глубоком снегу а также идеальный контроль доски на больших скоростях, будь то лед, вельвет, или просто укатанный до бетона снег. В сочетании с технологией QuckRip, которая добавляет доске еще несколько контактных точек на кантах, доски с Mtnpop рокером идеально подходят для катания по любым склонам.\r\nНекоторые райдеры называют его лучшим рокером объединившим катание в парках на трамплинах, и идеальным контролем скорости на жестких склонах, и вне трасс.', 2, 0, 1, 1),
(11, 'Deja Vu Flying V', 1, 336, 2016, 'Deja Vu - маневренность рокера и стабильность кэмбера благодаря прогибу Flying V', 'Burton Deja Vu. Этот Сноуборд вобрал в себя маневренность рокера и стабильность кэмбера благодаря прогибу Flying V, а симметричная форма позволит Вам наслаждаться катанием в свиче или, например, обучению этому полезному умению. Burton Deja Vu будет стабильно вести себя на скоростях и останется достаточно послушным даже на твердой ледяной трассе благодаря расширенным выступающим кантам в зоне креплений для лучшего сцепления. Если Вы ищете универсальный Сноуборд для динамичного катания и получения адреналина на скоростных спусках и прыжков в парке, то Deja Vu станет отличным выбором.', 2, 0, 1, 1),
(12, 'Chopper', 1, 133, 2016, 'Сноуборд для маленьких покорителей снежных склонов.', 'Сноуборд для маленьких покорителей снежных склонов, который с самого начала поможет поставить правильную технику катания. Burton Chopper – очень мягкая доска, ее плоский скользяк обеспечивает отличный контроль и баланс, благодаря чему юные райдеры могут быстро обучиться поворотам и торможению. Подходит даже для самых маленьких. К носу или хвосту ростовок 80-120 см можно прикрепить страховочный трос Riglet.', 2, 1, 0, 1),
(13, 'Antler', 1, 430, 2016, 'Antler заслужила отличные отзывы райдеров, прочно закрепилась в линейке.', 'Carbon Highlights: 60°. Карбоновые нити пронизывают стекловолокно по всей площади и используются для уменьшения веса доски и улучшения торсионной жесткости + некоторые дополнительные характеристики, также влияющие на "ходовые" качества. Угол 60° повышает маневренность доски и её "игривость", в свою очередь угол 45° используется при более агрессивном катании. В целом, использование карбоновых нитей делает доску стабильнее, отзывчивее и легче.\r\nDirectional Shape - классическая, наиболее многообразная форма доски (большинство экспериментов с формами ведутся именно с ней). Нос всегда длиннее хвоста. Это делает доску универсальной - можно кататься в парке, по подготовленным склонам и в пухлом снегу. \r\nPro-Tip - у доски есть 2 зоны, которые реже касаются снега и используются при катании - нос и хвост за пределами контактной зоны. Для снижения веса доски и повышения маневренности толщина носа и хвоста постепенно уменьшается.\r\nSqueezebox - профиль сердечника имеет разную толщину (тоньше под креплениями и толще рядом, представьте баян). Это позволяет передавать энергию от ноги к хвосту и носу доски значительно быстрее, при этом доска ведет себя стабильнее и легче управляется.\r\nThe Channel - позволяет выбрать ширину и угол установки креплений с точностью до миллиметра и градуса. Channel совместим со всеми типами креплений - EST, Re:Flex и традиционными дисковыми.  С сезона 2013-2014 все сноуборды компании Burton будут идти этой технологией.\r\nTwin Flex - гибкость доски абсолютно симметрична от носа до хвоста. Для сбалансированного катания в любой стойке (своей или обратной).', 2, 0, 0, 1),
(14, 'Gang Plank', 6, 276, 2016, '', '', 2, 0, 0, 1),
(15, 'Process Flying V', 1, 360, 2016, 'Про-модель Марка Мак-Морриса для трюков.', 'Про-модель Марка Мак-Морриса создана для непринужденного катания в сочетании с четкими трюками. Эта доска создана для маневренной езды и мощного щелчка, вобрав в себя все лучшее от кэмбера и рокера, снабженная прогибом Flying V, Burton Process FV позволят Вам насладиться отличной отзывчивостью во время спусков по трассам или катания в парке. Супер легкий сердечник FSC™ CERTIFIED SUPER FLY II™ 700G DUALZONE™ EGD™ позволит ощутить мощный щелчок и отзывчивость доски. Burton Process рождена для максимально оптимально работы с райдером, просто дайте ей понять желаемую траекторию и любой трюк станет Вам по силам.', 2, 0, 0, 1),
(16, 'Haylo', 4, 98, 2016, 'Haylo вобрало в себя все самые лучшие черты и технологии Flow.', 'Женское крепление Haylo уникально в своём роде. Оно вобрало в себя все самые лучшие черты и технологии Flow, при этом стоимость их сохраняется на достаточно низком уровне. Передача энергии улучшена за счёт встроенного стального кабеля, комфорт на высоте благодаря мягкому и отзывчивому хайбэку. Повороты на скорости в целине для новичков или профессионалов покажутся детской игрой с этими замечательными креплениями в ногах.', 3, 0, 1, 1),
(17, 'Nx2 Hybrid', 4, 200, 2015, 'NX2 HYBRID созданы для того, чтобы доставлять на нереальных скоростях.', 'Данные крепления созданы для того, чтобы доставлять настоящий фан на нереальных скоростях. Fuse-GT становятся все больше и больше популярны среди райдеров нашей команды. Невероятно отзывчивые, слегка мягче креплений NX2-GT, за счет полностью композитной нейлон/стекло-волоконной базы. Система AST гарантирует наиболее быстрое и комфортное встегивание.', 3, 0, 1, 1),
(18, 'Nx2-Gt', 4, 247, 2016, 'Эти крепления создают максимальную связь между райдером и доской.', 'Эти крепления создают максимальную связь между райдером и доской. Flow NX2 являются топовыми креплениями в коллекции Flow, поскольку они самые легкие и отзывчивые. Неповторимая поддержка и прочность благодаря алюминиевой базе и хайбеку из алюминия, комбинированного с карбоном. Быстрое и комфортное застегивание, благодаря системе AST. Подушки BankBeds c уклоном в 2.5 градуса и амортизация OC Kush гарантируют отличную поддержку и распределение энергии.', 3, 1, 0, 1),
(19, 'Malavita', 1, 240, 2016, 'Одни из самых популярных и высокотехнологичных креплений.', 'Одни из самых популярных и высокотехнологичных креплений, нацеленных на фристайл, выбор про-райдеров Burton. Анатомичный хайбэк Living Hinge, специально формованный под левую и правую ногу, двухкомпонентная легкая база EST из композитного материала и супер легкие формованные 3D стрепы с технологией Flex Slider благодаря которой расстегнутый стреп не возвращается на место не мешая ботинку легко заходить в крепления – Burton Malavita созданы быть удобными, помогая райдеру максимально взаимодействовать с доской.', 3, 0, 0, 1),
(20, 'Targa', 6, 232, 2016, '', '', 3, 0, 0, 1);

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
(11, 35),
(12, 36),
(13, 37),
(14, 38),
(15, 39),
(16, 41),
(16, 42),
(17, 43),
(17, 44),
(17, 45),
(18, 46),
(18, 47),
(18, 48),
(18, 49),
(19, 50),
(19, 51),
(20, 52),
(20, 53);

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
(11, 26),
(12, 3),
(12, 11),
(12, 18),
(12, 20),
(12, 22),
(12, 28),
(13, 1),
(13, 12),
(13, 17),
(13, 20),
(13, 23),
(13, 25),
(14, 10),
(14, 12),
(14, 18),
(14, 20),
(14, 22),
(14, 25),
(15, 5),
(15, 11),
(15, 18),
(15, 20),
(15, 24),
(15, 25),
(16, 29),
(16, 33),
(16, 37),
(16, 39),
(17, 30),
(17, 34),
(17, 37),
(17, 38),
(18, 32),
(18, 35),
(18, 36),
(18, 38),
(19, 30),
(19, 34),
(19, 36),
(19, 40),
(20, 31),
(20, 35),
(20, 36),
(20, 38);

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
(17, '141', 2, 1),
(18, '80', 2, 1),
(19, '120', 2, 1),
(20, '115', 2, 1),
(21, '130', 2, 1),
(22, 'XS', 3, 1),
(23, 'S', 3, 1),
(24, 'S/M', 3, 1),
(25, 'M', 3, 1),
(26, 'M/L', 3, 1),
(27, 'L', 3, 1),
(28, 'L/XL', 3, 1),
(29, 'XL', 3, 1),
(30, '5.5', 4, 1),
(31, '6', 4, 1),
(32, '6.5', 4, 1),
(33, '7', 4, 1),
(34, '7.5', 4, 1),
(35, '8', 4, 1),
(36, '8.5', 4, 1),
(37, '9', 4, 1),
(38, '9.5', 4, 1);

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
(1, '', '', '', 'admin', '4a225ea05f3a199443848ac2f9d9e360', 'd5b0a38d7b3f61768cf7bfd28c9b006f', 1);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=188;
--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `char_name`
--
ALTER TABLE `char_name`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT для таблицы `char_value`
--
ALTER TABLE `char_value`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
--
-- AUTO_INCREMENT для таблицы `color`
--
ALTER TABLE `color`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT для таблицы `image`
--
ALTER TABLE `image`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT для таблицы `producer`
--
ALTER TABLE `producer`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT для таблицы `product`
--
ALTER TABLE `product`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT для таблицы `size`
--
ALTER TABLE `size`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
