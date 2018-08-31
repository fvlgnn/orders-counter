CREATE DATABASE IF NOT EXISTS `orderscounter`
USE `orderscounter`;

CREATE TABLE IF NOT EXISTS `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `type` int(11) DEFAULT '0',
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8;
INSERT INTO `items` (`id`, `name`, `type`) VALUES
	(1, 'Wather', 4),
	(3, 'Marinara', 2),
	(4, 'Margherita', 2),
	(39, 'Suppli', 1),
	(47, 'Dessert', 4),
	(48, 'Coffee', 4),
	(49, 'Bitter', 4),
	(50, 'Beer', 3),
	(51, 'Soda', 3);

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item` int(11) NOT NULL,
  `destination` int(1) DEFAULT '0',
  `total` int(6) NOT NULL DEFAULT '1',
  `shift` int(1) DEFAULT '0',
  `date` date NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8;
INSERT INTO `orders` (`id`, `item`, `destination`, `total`, `shift`, `date`) VALUES
	(1, 1, 0, 1, 1, '2018-08-26');

CREATE TABLE IF NOT EXISTS `types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
INSERT INTO `types` (`id`, `name`) VALUES
	(1, 'Starter'),
	(2, 'Pizza'),
	(3, 'Drink'),
	(4, 'Other');

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(1) NOT NULL DEFAULT '1' COMMENT '0: disable, 1: user, 9: admin',
  `email` varchar(64) NOT NULL,
  `password` varchar(128) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `surname` varchar(50) DEFAULT NULL,
  `pass_reset` varchar(64) DEFAULT NULL,
  `pass_expiry` int(11) DEFAULT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=123 DEFAULT CHARSET=utf8;
INSERT INTO `users` (`id`, `type`, `email`, `password`, `name`, `surname`, `pass_reset`, `pass_expiry`) VALUES
	(123, 9, 'demo@server.com', '2Om0vu2YzZC2v+LyPKod/qrj9gW3NNFWr5ikOEr4RYcwX1ESFcZCAYro7xiSaQjAATm/pekKlEGyJZq31YX/gg==', 'Demo', 'User', NULL, NULL);
