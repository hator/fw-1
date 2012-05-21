-- Adminer 3.3.4 MySQL dump

SET NAMES utf8;
SET foreign_key_checks = 0;
SET time_zone = 'SYSTEM';
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

CREATE DATABASE `fw` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `fw`;

DROP TABLE IF EXISTS `session`;
CREATE TABLE `session` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ascii` varchar(32) NOT NULL,
  `logged_in` bit(1) NOT NULL,
  `user_id` int(11) NOT NULL,
  `last_action` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `creation_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `session` (`id`, `id_ascii`, `logged_in`, `user_id`, `last_action`, `creation_time`) VALUES
(7,	'6gcdrg0k86cguvk83o7k3t6ar3',	0,	0,	'2012-05-20 22:33:34',	'2012-05-20 22:33:34'),
(8,	'olm8327r2ddco96tar5544pcf0',	0,	0,	'2012-05-20 23:33:37',	'2012-05-20 23:33:37'),
(9,	'ihnastcuv7ffoh3pfhj0u2qe96',	0,	0,	'2012-05-20 23:34:24',	'2012-05-20 23:34:24');

DROP TABLE IF EXISTS `session_variables`;
CREATE TABLE `session_variables` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `session_id` int(11) NOT NULL,
  `key` varchar(64) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `session_id` (`session_id`),
  CONSTRAINT `session_variables_ibfk_1` FOREIGN KEY (`session_id`) REFERENCES `session` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `session_variables` (`id`, `session_id`, `key`, `value`) VALUES
(810,	9,	'c',	'aTo2NDs=');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(32) NOT NULL,
  `password` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `users` (`id`, `login`, `password`) VALUES
(1,	'Kikert',	'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3');

-- 2012-05-21 15:37:49
