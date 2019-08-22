# ************************************************************
# Sequel Pro SQL dump
# Version 5446
#
# https://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: localhost (MySQL 5.5.5-10.4.6-MariaDB)
# Database: project
# Generation Time: 2019-08-22 18:09:56 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table email
# ------------------------------------------------------------

DROP TABLE IF EXISTS `email`;

CREATE TABLE `email` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `active` tinyint(1) DEFAULT 1,
  `type` tinyint(1) DEFAULT NULL,
  `key` varchar(100) DEFAULT NULL,
  `name_fr` varchar(250) DEFAULT NULL,
  `name_en` varchar(250) DEFAULT NULL,
  `content_fr` text DEFAULT NULL,
  `content_en` text DEFAULT NULL,
  `userAdd` int(11) DEFAULT NULL,
  `dateAdd` int(11) DEFAULT NULL,
  `userModify` int(11) DEFAULT NULL,
  `dateModify` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `key` (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;



# Dump of table lang
# ------------------------------------------------------------

DROP TABLE IF EXISTS `lang`;

CREATE TABLE `lang` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `active` tinyint(1) DEFAULT 1,
  `type` text DEFAULT NULL,
  `key` varchar(100) DEFAULT NULL,
  `content_fr` text DEFAULT NULL,
  `content_en` text DEFAULT NULL,
  `userAdd` int(11) DEFAULT NULL,
  `dateAdd` int(11) DEFAULT NULL,
  `userModify` int(11) DEFAULT NULL,
  `dateModify` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `typeKey` (`type`(10),`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;



# Dump of table log
# ------------------------------------------------------------

DROP TABLE IF EXISTS `log`;

CREATE TABLE `log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `type` int(11) DEFAULT NULL,
  `context` varchar(100) DEFAULT NULL,
  `json` text DEFAULT NULL,
  `request` text DEFAULT NULL,
  `session_id` int(11) DEFAULT NULL,
  `userCommit` int(11) DEFAULT NULL,
  `userAdd` int(11) DEFAULT NULL,
  `dateAdd` int(11) DEFAULT NULL,
  `userModify` int(11) DEFAULT NULL,
  `dateModify` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;



# Dump of table logEmail
# ------------------------------------------------------------

DROP TABLE IF EXISTS `logEmail`;

CREATE TABLE `logEmail` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `status` tinyint(1) DEFAULT NULL,
  `context` varchar(100) DEFAULT NULL,
  `json` text DEFAULT NULL,
  `request` text DEFAULT NULL,
  `session_id` int(11) DEFAULT NULL,
  `userCommit` int(11) DEFAULT NULL,
  `userAdd` int(11) DEFAULT NULL,
  `dateAdd` int(11) DEFAULT NULL,
  `userModify` int(11) DEFAULT NULL,
  `dateModify` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;



# Dump of table logError
# ------------------------------------------------------------

DROP TABLE IF EXISTS `logError`;

CREATE TABLE `logError` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `type` tinyint(11) DEFAULT NULL,
  `context` varchar(100) DEFAULT NULL,
  `error` text DEFAULT NULL,
  `request` text DEFAULT NULL,
  `session_id` int(11) DEFAULT NULL,
  `userCommit` int(11) DEFAULT NULL,
  `userAdd` int(11) DEFAULT NULL,
  `dateAdd` int(11) DEFAULT NULL,
  `userModify` int(11) DEFAULT NULL,
  `dateModify` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;



# Dump of table logHttp
# ------------------------------------------------------------

DROP TABLE IF EXISTS `logHttp`;

CREATE TABLE `logHttp` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `type` int(11) DEFAULT NULL,
  `context` varchar(100) DEFAULT NULL,
  `request` text DEFAULT NULL,
  `json` text DEFAULT NULL,
  `session_id` int(11) DEFAULT NULL,
  `userCommit` int(11) DEFAULT NULL,
  `userAdd` int(11) DEFAULT NULL,
  `dateAdd` int(11) DEFAULT NULL,
  `userModify` int(11) DEFAULT NULL,
  `dateModify` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;



# Dump of table logSql
# ------------------------------------------------------------

DROP TABLE IF EXISTS `logSql`;

CREATE TABLE `logSql` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `type` int(11) DEFAULT NULL,
  `context` varchar(100) DEFAULT NULL,
  `json` text DEFAULT NULL,
  `request` text DEFAULT NULL,
  `session_id` int(11) DEFAULT NULL,
  `userCommit` int(11) DEFAULT NULL,
  `userAdd` int(11) DEFAULT NULL,
  `dateAdd` int(11) DEFAULT NULL,
  `userModify` int(11) DEFAULT NULL,
  `dateModify` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;



# Dump of table queueEmail
# ------------------------------------------------------------

DROP TABLE IF EXISTS `queueEmail`;

CREATE TABLE `queueEmail` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `status` tinyint(1) DEFAULT NULL,
  `context` varchar(100) DEFAULT NULL,
  `json` text DEFAULT NULL,
  `session_id` int(11) DEFAULT NULL,
  `userAdd` int(11) DEFAULT NULL,
  `dateAdd` int(11) DEFAULT NULL,
  `userModify` int(11) DEFAULT NULL,
  `dateModify` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;



# Dump of table redirection
# ------------------------------------------------------------

DROP TABLE IF EXISTS `redirection`;

CREATE TABLE `redirection` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `active` tinyint(1) DEFAULT 1,
  `type` text DEFAULT NULL,
  `key` varchar(100) DEFAULT NULL,
  `value` varchar(100) DEFAULT NULL,
  `userAdd` int(11) DEFAULT NULL,
  `dateAdd` int(11) DEFAULT NULL,
  `userModify` int(11) DEFAULT NULL,
  `dateModify` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `typeKey` (`type`(10),`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;



# Dump of table session
# ------------------------------------------------------------

DROP TABLE IF EXISTS `session`;

CREATE TABLE `session` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `context` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `sid` varchar(100) DEFAULT NULL,
  `data` text DEFAULT NULL,
  `count` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `userAdd` int(11) DEFAULT NULL,
  `dateAdd` int(11) DEFAULT NULL,
  `userModify` int(11) DEFAULT NULL,
  `dateModify` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sid` (`sid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;



# Dump of table user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `active` tinyint(1) DEFAULT 1,
  `role` tinyint(2) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `timezone` int(11) DEFAULT NULL,
  `dateLogin` int(11) DEFAULT NULL,
  `userAdd` int(11) DEFAULT NULL,
  `dateAdd` int(11) DEFAULT NULL,
  `userModify` int(11) DEFAULT NULL,
  `dateModify` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;

INSERT INTO `user` (`id`, `active`, `role`, `username`, `password`, `email`, `timezone`, `dateLogin`, `userAdd`, `dateAdd`, `userModify`, `dateModify`)
VALUES
	(1,1,1,'nobody','$2y$10$5uoE8nmVt/gx5kw3.Yu4d.cR4WXxWCdpJSCiAT3VSVXsxdSAEOGFS','nobody@project.com',NULL,NULL,2,1525308766,2,1526831130),
	(2,1,80,'admin','$2y$10$7Q/td6hiFTAMQ/ohDh1Wm.KJjRBPg1IV3OPHVfblqN3iVK91Zc4/2','admin@project.com',NULL,1566496837,2,1525308766,2,1566496837);

/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
