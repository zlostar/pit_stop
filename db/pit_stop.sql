-- phpMyAdmin SQL Dump
-- version 4.0.9deb1.precise~ppa.1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Време на генериране:  3 ное 2014 в 02:26
-- Версия на сървъра: 5.5.35-0ubuntu0.12.04.2
-- Версия на PHP: 5.3.10-1ubuntu3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- БД: `pit_stop`
--

-- --------------------------------------------------------

--
-- Структура на таблица `cars`
--

CREATE TABLE IF NOT EXISTS `cars` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `registration_plate` varchar(12) NOT NULL,
  `make` varchar(50) NOT NULL,
  `model` varchar(50) NOT NULL,
  `mileage` varchar(8) NOT NULL,
  `description` text NOT NULL,
  `created` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `registration_plate` (`registration_plate`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=48 ;

--
-- Схема на данните от таблица `cars`
--

INSERT INTO `cars` (`id`, `client_id`, `registration_plate`, `make`, `model`, `mileage`, `description`, `created`) VALUES
(47, 52, '4235235', 'volkswagen', 'passat', '60000', 'nomer na rama, nomer na shasi, godina', '2014-11-02');

-- --------------------------------------------------------

--
-- Структура на таблица `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `is_company` tinyint(1) NOT NULL,
  `name` varchar(100) NOT NULL,
  `country` varchar(30) NOT NULL,
  `city` varchar(40) NOT NULL,
  `street` varchar(40) NOT NULL,
  `street_number` varchar(5) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mol` varchar(30) DEFAULT NULL,
  `bulstat` varchar(30) DEFAULT NULL,
  `created` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `phone` (`phone`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=53 ;

--
-- Схема на данните от таблица `clients`
--

INSERT INTO `clients` (`id`, `user_id`, `is_company`, `name`, `country`, `city`, `street`, `street_number`, `phone`, `email`, `mol`, `bulstat`, `created`) VALUES
(52, 1, 1, 'viktor vladimirov georgive', 'bulgaria', 'gorna oriahovitsa', 'pencho slaveikov', '1', '32523523', 'zlos7ar@gmail.com', '', '', '2014-11-02');

-- --------------------------------------------------------

--
-- Структура на таблица `employees`
--

CREATE TABLE IF NOT EXISTS `employees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `middle_name` varchar(20) DEFAULT NULL,
  `last_name` varchar(20) NOT NULL,
  `address` varchar(40) DEFAULT NULL,
  `phone` varchar(12) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Схема на данните от таблица `employees`
--

INSERT INTO `employees` (`id`, `user_id`, `first_name`, `middle_name`, `last_name`, `address`, `phone`, `created`, `modified`) VALUES
(1, 1, 'sava', 'vladimirov', 'georgiev', 'bayerstrasse 24', '42134235555', '2014-10-28 22:03:01', '2014-10-28 22:03:17'),
(2, 2, 'Детелин', 'Борисов', 'Данаилов', 'Горна Оряховица - Юрий Гагарин 41 Г', '0878891331', '2014-10-29 10:31:21', '2014-11-02 17:22:41'),
(3, 2, 'Костадин', 'Йорданов', 'Атанасов', 'Горна Оряховица - Славянска 24', '0899853800', '2014-10-29 13:58:06', '2014-10-29 13:58:06'),
(4, 1, 'viktor', 'vladimirov', 'georgiev', 'bayerstrasse 24', '234234234423', '2014-11-01 13:35:35', '2014-11-01 13:35:35');

-- --------------------------------------------------------

--
-- Структура на таблица `employees_services`
--

CREATE TABLE IF NOT EXISTS `employees_services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=69 ;

--
-- Схема на данните от таблица `employees_services`
--

INSERT INTO `employees_services` (`id`, `service_id`, `employee_id`) VALUES
(10, 35, 1),
(11, 36, 1),
(12, 36, 4),
(13, 37, 1),
(14, 37, 4),
(15, 38, 1),
(16, 39, 1),
(17, 39, 4),
(18, 40, 1),
(19, 40, 4),
(20, 41, 1),
(21, 42, 1),
(22, 42, 4),
(23, 43, 1),
(24, 43, 4),
(25, 44, 1),
(26, 45, 1),
(27, 45, 4),
(28, 46, 1),
(29, 46, 4),
(30, 47, 1),
(31, 48, 1),
(32, 48, 4),
(33, 49, 1),
(34, 49, 4),
(35, 50, 1),
(36, 51, 1),
(37, 51, 4),
(38, 52, 1),
(39, 52, 4),
(40, 53, 1),
(41, 54, 1),
(42, 54, 4),
(43, 55, 1),
(44, 55, 4),
(45, 56, 1),
(46, 57, 1),
(47, 57, 4),
(48, 58, 1),
(49, 58, 4),
(50, 59, 1),
(51, 60, 1),
(52, 60, 4),
(53, 61, 1),
(54, 61, 4),
(55, 62, 1),
(56, 63, 1),
(57, 63, 4),
(58, 64, 1),
(59, 64, 4),
(60, 65, 4),
(61, 66, 4),
(62, 67, 4),
(63, 68, 4),
(64, 69, 4),
(65, 70, 4),
(66, 71, 1),
(67, 72, 1),
(68, 73, 1);

-- --------------------------------------------------------

--
-- Структура на таблица `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `car_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `created` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=71 ;

--
-- Схема на данните от таблица `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `car_id`, `description`, `created`) VALUES
(8, 0, 0, 'izkrivena predna bronq - nqma da se pravi', '0000-00-00'),
(9, 0, 0, 'izkrivena predna bronq - nqma da se pravi', '0000-00-00'),
(10, 0, 0, 'izkrivena predna bronq - nqma da se pravi', '0000-00-00'),
(11, 0, 0, 'izkrivena predna bronq - nqma da se pravi', '0000-00-00'),
(12, 0, 0, 'izkrivena predna bronq - nqma da se pravi', '0000-00-00'),
(13, 0, 0, 'izkrivena predna bronq - nqma da se pravi', '0000-00-00'),
(14, 0, 0, 'izkrivena predna bronq - nqma da se pravi', '0000-00-00'),
(15, 0, 0, 'izkrivena predna bronq - nqma da se pravi', '0000-00-00'),
(16, 0, 0, 'izkrivena predna bronq - nqma da se pravi', '0000-00-00'),
(17, 0, 0, 'izkrivena predna bronq - nqma da se pravi', '0000-00-00'),
(18, 0, 0, 'izkrivena predna bronq - nqma da se pravi', '0000-00-00'),
(19, 0, 0, 'izkrivena predna bronq - nqma da se pravi', '0000-00-00'),
(20, 0, 0, 'izkrivena predna bronq - nqma da se pravi', '0000-00-00'),
(21, 0, 0, 'izkrivena predna bronq - nqma da se pravi', '0000-00-00'),
(22, 0, 0, 'izkrivena predna bronq - nqma da se pravi', '0000-00-00'),
(23, 0, 0, 'izkrivena predna bronq - nqma da se pravi', '0000-00-00'),
(24, 0, 0, 'izkrivena predna bronq - nqma da se pravi', '0000-00-00'),
(25, 0, 0, 'izkrivena predna bronq - nqma da se pravi', '0000-00-00'),
(26, 0, 0, 'izkrivena predna bronq - nqma da se pravi', '0000-00-00'),
(27, 0, 0, 'izkrivena predna bronq - nqma da se pravi', '0000-00-00'),
(28, 0, 0, 'izkrivena predna bronq - nqma da se pravi', '0000-00-00'),
(29, 0, 0, 'izkrivena predna bronq - nqma da se pravi', '0000-00-00'),
(30, 0, 0, 'izkrivena predna bronq - nqma da se pravi', '0000-00-00'),
(31, 0, 0, 'izkrivena predna bronq - nqma da se pravi', '0000-00-00'),
(32, 0, 0, 'izkrivena predna bronq - nqma da se pravi', '0000-00-00'),
(33, 0, 0, 'izkrivena predna bronq - nqma da se pravi', '0000-00-00'),
(34, 0, 0, 'izkrivena predna bronq - nqma da se pravi', '0000-00-00'),
(35, 0, 0, 'izkrivena predna bronq - nqma da se pravi', '0000-00-00'),
(36, 0, 0, 'izkrivena predna bronq - nqma da se pravi', '0000-00-00'),
(37, 0, 0, 'izkrivena predna bronq - nqma da se pravi', '0000-00-00'),
(38, 0, 0, 'izkrivena predna bronq - nqma da se pravi', '0000-00-00'),
(39, 0, 0, 'izkrivena predna bronq - nqma da se pravi', '0000-00-00'),
(40, 0, 0, 'izkrivena predna bronq - nqma da se pravi', '0000-00-00'),
(41, 0, 0, 'izkrivena predna bronq - nqma da se pravi', '0000-00-00'),
(42, 0, 0, 'izkrivena predna bronq - nqma da se pravi', '0000-00-00'),
(43, 0, 0, 'izkrivena predna bronq - nqma da se pravi', '0000-00-00'),
(44, 0, 0, 'izkrivena predna bronq - nqma da se pravi', '0000-00-00'),
(45, 0, 0, 'izkrivena predna bronq - nqma da se pravi', '0000-00-00'),
(46, 0, 0, 'izkrivena predna bronq - nqma da se pravi', '0000-00-00'),
(47, 0, 0, 'izkrivena predna bronq - nqma da se pravi', '0000-00-00'),
(48, 0, 0, 'fsdjkfjsdkfdls dfssd fds fsd', '0000-00-00'),
(49, 0, 0, 'fsdjkfjsdkfdls dfssd fds fsd', '0000-00-00'),
(50, 0, 0, 'fsdjkfjsdkfdls dfssd fds fsd', '0000-00-00'),
(51, 0, 0, 'fsdjkfjsdkfdls dfssd fds fsd', '0000-00-00'),
(52, 0, 0, 'fsdjkfjsdkfdls dfssd fds fsd', '0000-00-00'),
(53, 0, 0, 'fsdjkfjsdkfdls dfssd fds fsd', '0000-00-00'),
(54, 0, 0, 'fsdjkfjsdkfdls dfssd fds fsd', '0000-00-00'),
(55, 0, 0, 'fsdjkfjsdkfdls dfssd fds fsd', '0000-00-00'),
(56, 0, 0, 'fsdjkfjsdkfdls dfssd fds fsd', '0000-00-00'),
(57, 0, 0, 'fsdjkfjsdkfdls dfssd fds fsd', '0000-00-00'),
(58, 0, 0, 'gdsgsdgsdgsd', '0000-00-00'),
(59, 0, 0, 'gdsgsdgsdgsd', '0000-00-00'),
(60, 0, 0, 'reterter', '0000-00-00'),
(61, 1, 47, 'reterter', '0000-00-00'),
(62, 1, 47, 'fgdfgfd', '0000-00-00'),
(63, 1, 47, 'fgdfgfd', '0000-00-00'),
(64, 1, 47, 'fgdfgfd', '0000-00-00'),
(65, 1, 47, 'fgdfgfd', '2014-02-11'),
(66, 1, 47, 'fgdfgfd', '2014-01-11'),
(67, 1, 47, 'fgdfgfd', '2014-05-11'),
(68, 1, 47, 'ytujty', '2014-11-02'),
(69, 1, 47, 'ytujty efwefwe', '2014-11-02'),
(70, 1, 47, 'aaaaa', '2014-11-02');

-- --------------------------------------------------------

--
-- Структура на таблица `parts`
--

CREATE TABLE IF NOT EXISTS `parts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `car_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `count` int(11) NOT NULL,
  `price` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=34 ;

--
-- Схема на данните от таблица `parts`
--

INSERT INTO `parts` (`id`, `order_id`, `car_id`, `description`, `count`, `price`) VALUES
(1, 51, 40, '', 0, ''),
(2, 51, 40, '', 0, ''),
(3, 51, 40, '', 0, ''),
(4, 53, 42, '', 0, ''),
(5, 53, 42, '', 0, ''),
(6, 53, 42, '', 0, ''),
(7, 54, 43, 'nakladki', 2, '50'),
(8, 54, 43, 'suedinitel', 1, '200'),
(9, 54, 43, 'maslo', 1, '60'),
(10, 56, 45, 'nakladki', 2, '50'),
(11, 56, 45, 'suedinitel', 1, '200'),
(12, 56, 45, 'maslo', 1, '60'),
(13, 57, 46, 'nakladki', 2, '50'),
(14, 57, 46, 'suedinitel', 1, '200'),
(15, 57, 46, 'maslo', 1, '60'),
(16, 59, 47, 'nakladki', 2, '50'),
(17, 59, 47, 'suedinitel', 1, '200'),
(18, 59, 47, 'maslo', 1, '60'),
(19, 60, 47, 'nakladki', 2, '50'),
(20, 60, 47, 'suedinitel', 1, '200'),
(21, 60, 47, 'maslo', 1, '60'),
(22, 61, 47, 'nakladki', 2, '50'),
(23, 61, 47, 'suedinitel', 1, '200'),
(24, 61, 47, 'maslo', 1, '60'),
(25, 62, 47, 'nakladki', 2, '50'),
(26, 63, 47, 'nakladki', 2, '50'),
(27, 64, 47, 'nakladki', 2, '50'),
(28, 65, 47, 'nakladki', 2, '50'),
(29, 66, 47, 'nakladki', 2, '50'),
(30, 67, 47, 'nakladki', 2, '50'),
(31, 68, 47, 'nakladki', 2, '50'),
(32, 69, 47, 'nakladki', 2, '50'),
(33, 70, 47, 'suedinitel', 1, '200');

-- --------------------------------------------------------

--
-- Структура на таблица `profits`
--

CREATE TABLE IF NOT EXISTS `profits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `service_type_id` int(11) NOT NULL,
  `employee_profit` varchar(3) NOT NULL DEFAULT '0',
  `valid_from` datetime DEFAULT NULL,
  `valid_to` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Схема на данните от таблица `profits`
--

INSERT INTO `profits` (`id`, `employee_id`, `service_type_id`, `employee_profit`, `valid_from`, `valid_to`, `created`, `modified`) VALUES
(1, 1, 2, '60', NULL, NULL, '2014-10-28 22:03:01', '2014-10-28 22:03:17'),
(2, 4, 2, '50', NULL, NULL, '2014-11-01 13:35:35', '2014-11-01 13:35:35'),
(3, 4, 4, '40', NULL, NULL, '2014-11-01 13:35:35', '2014-11-01 13:35:35'),
(4, 4, 5, '60', NULL, NULL, '2014-11-01 13:35:35', '2014-11-01 13:35:35');

-- --------------------------------------------------------

--
-- Структура на таблица `services`
--

CREATE TABLE IF NOT EXISTS `services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `car_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `count` int(11) NOT NULL,
  `price` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=74 ;

--
-- Схема на данните от таблица `services`
--

INSERT INTO `services` (`id`, `order_id`, `car_id`, `description`, `count`, `price`) VALUES
(23, 37, 26, 'smqna nakladki', 2, '30'),
(24, 42, 31, 'smqna na maslo', 1, '40'),
(25, 42, 31, 'smqna nakladki', 2, '30'),
(26, 42, 31, 'smqna suedinitel', 1, '100'),
(27, 44, 33, 'smqna suedinitel', 1, '100'),
(28, 45, 34, 'smqna na maslo', 1, '40'),
(29, 45, 34, 'smqna nakladki', 2, '30'),
(30, 45, 34, 'smqna suedinitel', 1, '100'),
(31, 46, 35, 'smqna na maslo', 1, '40'),
(32, 46, 35, 'smqna nakladki', 2, '30'),
(33, 46, 35, 'smqna suedinitel', 1, '100'),
(34, 49, 38, 'smqna na maslo', 1, '40'),
(35, 50, 39, 'smqna na maslo', 1, '40'),
(36, 50, 39, 'smqna nakladki', 2, '30'),
(37, 50, 39, 'smqna suedinitel', 1, '100'),
(38, 51, 40, 'smqna na maslo', 1, '40'),
(39, 51, 40, 'smqna nakladki', 2, '30'),
(40, 51, 40, 'smqna suedinitel', 1, '100'),
(41, 52, 41, 'smqna na maslo', 1, '40'),
(42, 52, 41, 'smqna nakladki', 2, '30'),
(43, 52, 41, 'smqna suedinitel', 1, '100'),
(44, 53, 42, 'smqna na maslo', 1, '40'),
(45, 53, 42, 'smqna nakladki', 2, '30'),
(46, 53, 42, 'smqna suedinitel', 1, '100'),
(47, 54, 43, 'smqna na maslo', 1, '40'),
(48, 54, 43, 'smqna nakladki', 2, '30'),
(49, 54, 43, 'smqna suedinitel', 1, '100'),
(50, 56, 45, 'smqna na maslo', 1, '40'),
(51, 56, 45, 'smqna nakladki', 2, '30'),
(52, 56, 45, 'smqna suedinitel', 1, '100'),
(53, 57, 46, 'smqna na maslo', 1, '40'),
(54, 57, 46, 'smqna nakladki', 2, '30'),
(55, 57, 46, 'smqna suedinitel', 1, '100'),
(56, 59, 47, 'smqna na maslo', 1, '40'),
(57, 59, 47, 'smqna nakladki', 2, '30'),
(58, 59, 47, 'smqna suedinitel', 1, '100'),
(59, 60, 47, 'smqna na maslo', 1, '40'),
(60, 60, 47, 'smqna nakladki', 2, '30'),
(61, 60, 47, 'smqna suedinitel', 1, '100'),
(62, 61, 47, 'smqna na maslo', 1, '40'),
(63, 61, 47, 'smqna nakladki', 2, '30'),
(64, 61, 47, 'smqna suedinitel', 1, '100'),
(65, 62, 47, 'smqna na maslo', 1, '40'),
(66, 63, 47, 'smqna na maslo', 1, '40'),
(67, 64, 47, 'smqna na maslo', 1, '40'),
(68, 65, 47, 'smqna na maslo', 1, '40'),
(69, 66, 47, 'smqna na maslo', 1, '40'),
(70, 67, 47, 'smqna na maslo', 1, '40'),
(71, 68, 47, 'smqna na maslo', 1, '40'),
(72, 69, 47, 'smqna na maslo', 1, '40'),
(73, 70, 47, 'smqna na maslo', 1, '40');

-- --------------------------------------------------------

--
-- Структура на таблица `service_types`
--

CREATE TABLE IF NOT EXISTS `service_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Схема на данните от таблица `service_types`
--

INSERT INTO `service_types` (`id`, `name`, `created`, `modified`, `user_id`) VALUES
(2, 'test 1', '2014-10-28 22:02:26', '2014-10-28 22:02:34', 1),
(4, 'Ремонтна дейност', '2014-11-01 11:38:15', '2014-11-01 11:38:15', 2),
(5, 'Регулиране преден мост', '2014-11-01 11:38:39', '2014-11-01 11:38:39', 2);

-- --------------------------------------------------------

--
-- Структура на таблица `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `name` varchar(60) NOT NULL,
  `address` varchar(120) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(60) NOT NULL,
  `role` varchar(20) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Схема на данните от таблица `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `name`, `address`, `phone`, `email`, `role`, `created`, `modified`) VALUES
(1, 'zlos7ar', '$2y$10$DfZYjBWq51JSKuYXLZkq2esh4bjbnj6JyhmKq.T2W9Eh60P9uvUG6', 'Viktor Georgiev', 'Bayerstrasse 24, Munich, Germany', '00491725721843', 'viktor.georgiev@outlook.com', 'admin', NULL, NULL),
(2, 'poksan', '$2a$10$nF/PzwGsFkA9JUTviJjS6OikxplY4xVIGHApS9m.VW.aOmKadamBe', 'Ivailo', 'Mano Todorov 9', '0887659706', '', 'admin', '2014-10-27 14:34:47', '2014-10-27 14:34:47');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
