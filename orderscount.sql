-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versione server:              10.1.31-MariaDB - mariadb.org binary distribution
-- S.O. server:                  Win32
-- HeidiSQL Versione:            9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dump della struttura del database orderscounter
CREATE DATABASE IF NOT EXISTS `orderscounter` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `orderscounter`;

-- Dump della struttura di tabella orderscounter.items
CREATE TABLE IF NOT EXISTS `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `type` int(11) DEFAULT '0',
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8;

-- Dump dei dati della tabella orderscounter.items: ~9 rows
/*!40000 ALTER TABLE `items` DISABLE KEYS */;
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
/*!40000 ALTER TABLE `items` ENABLE KEYS */;

-- Dump della struttura di tabella orderscounter.orders
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

-- Dump dei dati della tabella orderscounter.orders: ~1 rows
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` (`id`, `item`, `destination`, `total`, `shift`, `date`) VALUES
	(1, 1, 0, 1, 1, '2018-08-26');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;

-- Dump della struttura di tabella orderscounter.types
CREATE TABLE IF NOT EXISTS `types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Dump dei dati della tabella orderscounter.types: ~4 rows
/*!40000 ALTER TABLE `types` DISABLE KEYS */;
INSERT INTO `types` (`id`, `name`) VALUES
	(1, 'Starter'),
	(2, 'Pizza'),
	(3, 'Drink'),
	(4, 'Other');
/*!40000 ALTER TABLE `types` ENABLE KEYS */;

-- Dump della struttura di tabella orderscounter.users
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

-- Dump dei dati della tabella orderscounter.users: 2 rows
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `type`, `email`, `password`, `name`, `surname`, `pass_reset`, `pass_expiry`) VALUES
	(123, 9, 'demo@server.com', '2Om0vu2YzZC2v+LyPKod/qrj9gW3NNFWr5ikOEr4RYcwX1ESFcZCAYro7xiSaQjAATm/pekKlEGyJZq31YX/gg==', 'Demo', 'User', NULL, NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
