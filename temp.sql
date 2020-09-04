-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               5.6.41 - MySQL Community Server (GPL)
-- Операционная система:         Win32
-- HeidiSQL Версия:              10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Дамп структуры для таблица sevkanal.article
DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `short_description` text COLLATE utf8_unicode_ci,
  `description` text COLLATE utf8_unicode_ci,
  `img` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `seoTitle` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `seoDescription` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `active` int(11) DEFAULT NULL,
  `create_utime` datetime DEFAULT NULL,
  `update_utime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы sevkanal.article: ~2 rows (приблизительно)
DELETE FROM `article`;
/*!40000 ALTER TABLE `article` DISABLE KEYS */;
INSERT INTO `article` (`id`, `title`, `short_description`, `description`, `img`, `seoTitle`, `seoDescription`, `active`, `create_utime`, `update_utime`) VALUES
	(1, 'Новость 1', '<p>короткое описание этой новости будет отображено на сайте1</p>\r\n', '<p>тут жее будет и короткое описание носовсти и полный текст Вашей новости</p>\r\n\r\n<p>тут жее будет и короткое описание носовсти и полный текст Вашей новости</p>\r\n\r\n<p>тут жее будет и короткое описание носовсти и полный текст Вашей новости</p>\r\n\r\n<p>тут жее будет и короткое описание носовсти и полный текст Вашей новости</p>\r\n\r\n<p>тут жее будет и короткое описание носовсти и полный текст Вашей новоститут жее будет и короткое описание носовсти и полный текст Вашей новоститут жее будет и короткое описание носовсти и полный текст Вашей новоститут жее будет и короткое описание носовсти и полный текст Вашей новоститут жее будет и короткое описание носовсти и полный текст Вашей новоститут жее будет и короткое описание носовсти и полный текст Вашей новоститут жее будет и короткое описание носовсти и полный текст Вашей новоститут жее будет и короткое описание носовсти и полный текст Вашей новоститут жее будет и короткое описание носовсти и полный текст Вашей новоститут жее будет и короткое описание носовсти и полный текст Вашей новоститут жее будет и короткое описание носовсти и полный текст Вашей новоститут жее будет и короткое описание носовсти и полный текст Вашей новоститут жее будет и короткое описание носовсти и полный текст Вашей новоститут жее будет и короткое описание носовсти и полный текст Вашей новости</p>\r\n', '', '', '', 1, '2020-08-18 13:41:08', '2020-08-18 16:30:42'),
	(2, 'Новость 2', '<p>короткое описание этой новости будет отображено на сайте2</p>\r\n', '<p>тут жее будет и короткое описание носовсти и полный текст Вашей новости</p>\r\n\r\n<p>тут жее будет и короткое описание носовсти и полный текст Вашей новости</p>\r\n\r\n<p>тут жее будет и короткое описание носовсти и полный текст Вашей новости</p>\r\n\r\n<p>тут жее будет и короткое описание носовсти и полный текст Вашей новости</p>\r\n\r\n<p>тут жее будет и короткое описание носовсти и полный текст Вашей новоститут жее будет и короткое описание носовсти и полный текст Вашей новоститут жее будет и короткое описание носовсти и полный текст Вашей новоститут жее будет и короткое описание носовсти и полный текст Вашей новоститут жее будет и короткое описание носовсти и полный текст Вашей новоститут жее будет и короткое описание носовсти и полный текст Вашей новоститут жее будет и короткое описание носовсти и полный текст Вашей новоститут жее будет и короткое описание носовсти и полный текст Вашей новоститут жее будет и короткое описание носовсти и полный текст Вашей новоститут жее будет и короткое описание носовсти и полный текст Вашей новоститут жее будет и короткое описание носовсти и полный текст Вашей новоститут жее будет и короткое описание носовсти и полный текст Вашей новоститут жее будет и короткое описание носовсти и полный текст Вашей новоститут жее будет и короткое описание носовсти и полный текст Вашей новости</p>\r\n', '', '', '', 1, '2020-08-18 13:45:08', '2020-08-18 16:31:07');
/*!40000 ALTER TABLE `article` ENABLE KEYS */;

-- Дамп структуры для таблица sevkanal.page
DROP TABLE IF EXISTS `page`;
CREATE TABLE IF NOT EXISTS `page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `short_description` text COLLATE utf8_unicode_ci,
  `description` text COLLATE utf8_unicode_ci,
  `img` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `seoTitle` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `seoDescription` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_page` int(11) DEFAULT '0',
  `active` int(11) DEFAULT '1',
  `create_utime` datetime DEFAULT NULL,
  `update_utime` datetime DEFAULT NULL,
  `main_menu` int(11) DEFAULT '0',
  `sidebar` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы sevkanal.page: ~9 rows (приблизительно)
DELETE FROM `page`;
/*!40000 ALTER TABLE `page` DISABLE KEYS */;
INSERT INTO `page` (`id`, `title`, `short_description`, `description`, `img`, `seoTitle`, `seoDescription`, `parent_page`, `active`, `create_utime`, `update_utime`, `main_menu`, `sidebar`) VALUES
	(5, 'Повiдомити про витiк води', '<p><em>Повiдомити про витiк води</em></p>\r\n', '<pre>\r\n<em>Повiдомити про витiк води</em></pre>\r\n\r\n<pre>\r\n<em>Повiдомити про витiк води</em></pre>\r\n\r\n<pre>\r\n<em>Повiдомити про витiк води</em></pre>\r\n\r\n<pre>\r\n<em>Повiдомити про витiк води</em></pre>\r\n\r\n<pre>\r\n<em>Повiдомити про витiк води</em></pre>\r\n', '', '', '', 0, 1, '2020-08-19 12:49:09', '2020-08-19 12:49:09', 0, 1),
	(6, 'Якiсть питной води', '<p><em>Якiсть питной водиЯкiсть питной води</em></p>\r\n', '<pre>\r\n<em>Якiсть питной води</em></pre>\r\n\r\n<pre>\r\n<em>Якiсть питной води</em></pre>\r\n\r\n<pre>\r\n<em>Якiсть питной води</em></pre>\r\n\r\n<pre>\r\n<em>Якiсть питной води</em></pre>\r\n', '', '', '', 5, 1, '2020-08-19 12:49:40', '2020-08-19 12:49:40', 1, 1),
	(7, 'Допомога', '<p><em>ДопомогаДопомога</em></p>\r\n', '<pre>\r\n<em>Допомога</em></pre>\r\n\r\n<pre>\r\n<em>Допомога</em></pre>\r\n\r\n<pre>\r\n<em>Допомога</em></pre>\r\n\r\n<pre>\r\n<em>Допомога</em></pre>\r\n', '', '', '', 5, 1, '2020-08-19 12:50:07', '2020-08-19 12:50:07', 1, 1),
	(8, 'Тендери', '<p><em>ТендериТендери</em></p>\r\n', '<pre>\r\n<em>Тендери</em></pre>\r\n\r\n<pre>\r\n<em>Тендери</em></pre>\r\n\r\n<pre>\r\n<em>Тендери</em></pre>\r\n\r\n<pre>\r\n<em>Тендери</em></pre>\r\n\r\n<pre>\r\n<em>Тендери</em></pre>\r\n\r\n<pre>\r\n<em>Тендери</em></pre>\r\n', '', '', '', 5, 1, '2020-08-19 12:50:36', '2020-08-19 12:50:36', 1, 1),
	(9, 'Водовiдведення', '<p><em>ВодовiдведенняВодовiдведення</em></p>\r\n', '<pre>\r\n<em>Водовiдведення</em></pre>\r\n\r\n<pre>\r\n<em>Водовiдведення</em></pre>\r\n\r\n<pre>\r\n<em>Водовiдведення</em></pre>\r\n\r\n<pre>\r\n<em>Водовiдведення</em></pre>\r\n\r\n<pre>\r\n<em>Водовiдведення</em></pre>\r\n', '', '', '', 5, 1, '2020-08-19 12:53:51', '2020-08-19 12:53:51', 1, 1),
	(10, 'Корисна iнформацiя', '<p><em>Корисна iнформацiяКорисна iнформацiяКорисна iнформацiяКорисна iнформацiя</em></p>\r\n', '<pre>\r\n<em>Корисна iнформацiя</em></pre>\r\n\r\n<pre>\r\n<em>Корисна iнформацiя</em></pre>\r\n\r\n<pre>\r\n<em>Корисна iнформацiя</em></pre>\r\n\r\n<pre>\r\n<em>Корисна iнформацiя</em></pre>\r\n\r\n<pre>\r\n<em>Корисна iнформацiя</em></pre>\r\n\r\n<pre>\r\n<em>Корисна iнформацiя</em></pre>\r\n\r\n<pre>\r\n<em>Корисна iнформацiя</em></pre>\r\n\r\n<pre>\r\n<em>Корисна iнформацiя</em></pre>\r\n\r\n<pre>\r\n<em>Корисна iнформацiя</em></pre>\r\n\r\n<pre>\r\n<em>Корисна iнформацiя</em></pre>\r\n', '', '', '', 5, 1, '2020-08-19 12:56:01', '2020-08-19 12:56:01', 1, 1),
	(11, 'Водомiри', '<p><em>ВодомiриВодомiриВодомiриВодомiриВодомiри</em></p>\r\n', '<pre>\r\n<em>Водомiри</em></pre>\r\n\r\n<pre>\r\n<em>Водомiри</em></pre>\r\n\r\n<pre>\r\n<em>Водомiри</em></pre>\r\n\r\n<pre>\r\n<em>Водомiри</em></pre>\r\n\r\n<pre>\r\n<em>Водомiри</em></pre>\r\n\r\n<pre>\r\n<em>Водомiри</em></pre>\r\n\r\n<pre>\r\n<em>Водомiри</em></pre>\r\n', '', '', '', 5, 1, '2020-08-19 12:56:31', '2020-08-19 12:56:31', 1, 1),
	(12, 'Законодавча i нормативна база', '<p><em>Законодавча i нормативна базаЗаконодавча i нормативна базаЗаконодавча i нормативна базаЗаконодавча i нормативна база</em></p>\r\n', '<pre>\r\n<em>Законодавча i нормативна база</em></pre>\r\n\r\n<pre>\r\n<em>Законодавча i нормативна база</em></pre>\r\n\r\n<pre>\r\n<em>Законодавча i нормативна база</em></pre>\r\n\r\n<pre>\r\n<em>Законодавча i нормативна база</em></pre>\r\n\r\n<pre>\r\n<em>Законодавча i нормативна база</em></pre>\r\n\r\n<pre>\r\n<em>Законодавча i нормативна база</em></pre>\r\n\r\n<pre>\r\n<em>Законодавча i нормативна база</em></pre>\r\n', '', '', '', 5, 1, '2020-08-19 12:57:04', '2020-08-19 12:57:04', 1, 1),
	(13, 'Інвестиційна програма', '<p><em>Інвестиційна програмаІнвестиційна програма</em></p>\r\n', '<pre>\r\n<em>Інвестиційна програма</em></pre>\r\n\r\n<pre>\r\n<em>Інвестиційна програма</em></pre>\r\n\r\n<pre>\r\n<em>Інвестиційна програма</em></pre>\r\n\r\n<pre>\r\n<em>Інвестиційна програма</em></pre>\r\n\r\n<pre>\r\n<em>Інвестиційна програма</em></pre>\r\n\r\n<pre>\r\n<em>Інвестиційна програма</em></pre>\r\n\r\n<pre>\r\n<em>Інвестиційна програма</em></pre>\r\n', '', '', '', 5, 1, '2020-08-19 12:57:21', '2020-08-19 12:57:21', 1, 1);
/*!40000 ALTER TABLE `page` ENABLE KEYS */;

-- Дамп структуры для таблица sevkanal.user
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `verification_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы sevkanal.user: ~1 rows (приблизительно)
DELETE FROM `user`;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `verification_token`) VALUES
	(1, 'Administrator', '9RqgQoiRFWYOfjodaIvzbY83gZIcAeYx', '$2y$13$Bidns9BUyy6coKgT/pOO4uR/1jxTa5V/4.cIisahSKnnWPhlCdRXy', NULL, 'agronom20005@gmail.com', 10, 1596115277, 1596115277, '4Lpzgs9r8Cxb4yzB6xFwF0Yy35zy8Tpb_1596115277');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
