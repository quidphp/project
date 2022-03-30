# ************************************************************
# Sequel Pro SQL dump
# Version 5446
#
# https://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: localhost (MySQL 5.5.5-10.4.12-MariaDB)
# Database: project
# Generation Time: 2020-09-14 20:29:53 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table cacheRoute
# ------------------------------------------------------------

DROP TABLE IF EXISTS `cacheRoute`;

CREATE TABLE `cacheRoute` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `context` text DEFAULT NULL,
  `data` text DEFAULT NULL,
  `userAdd` int(11) DEFAULT NULL,
  `dateAdd` int(11) DEFAULT NULL,
  `userModify` int(11) DEFAULT NULL,
  `dateModify` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



# Dump of table contact
# ------------------------------------------------------------

DROP TABLE IF EXISTS `contact`;

CREATE TABLE `contact` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `context` varchar(100) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `session_id` int(11) DEFAULT NULL,
  `userAdd` int(11) DEFAULT NULL,
  `dateAdd` int(11) DEFAULT NULL,
  `userModify` int(11) DEFAULT NULL,
  `dateModify` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



# Dump of table email
# ------------------------------------------------------------

DROP TABLE IF EXISTS `email`;

CREATE TABLE `email` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `active` tinyint(1) DEFAULT 1,
  `type` text DEFAULT NULL,
  `contentType` tinyint(1) DEFAULT NULL,
  `key` varchar(100) DEFAULT NULL,
  `name_en` varchar(200) DEFAULT NULL,
  `content_en` text DEFAULT NULL,
  `userAdd` int(11) DEFAULT NULL,
  `dateAdd` int(11) DEFAULT NULL,
  `userModify` int(11) DEFAULT NULL,
  `dateModify` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `key` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `email` WRITE;
/*!40000 ALTER TABLE `email` DISABLE KEYS */;

INSERT INTO `email` (`id`, `active`, `type`, `contentType`, `key`, `name_en`, `content_en`, `userAdd`, `dateAdd`, `userModify`, `dateModify`)
VALUES
	(1,1,'1',1,'userWelcome','Welcome | [bootLabel]','[userName],\r\n\r\nYour account for [bootLabel] is ready to use.\r\n\r\nTo connect:\r\nURL: [schemeHostApp]\r\n\r\nUsername: [user] \r\nor email: [userEmail]\r\n\r\nPassword: [userPassword]\r\n\r\n[emailFooter]',2,1547406803,2,1588905910),
	(2,1,'0',1,'resetPassword','Password reset | [bootLabel]','[userName],\r\n\r\nA request was placed on [bootLabel] to regenerate the password of the account linked to the email [userEmail].\r\n\r\nHere is the new password: [userPassword]\r\n\r\nClick on the following link to activate your new password:\r\n[activateUri]\r\n\r\n[emailFooter]',2,1588035943,2,1588905903),
	(3,1,'0',1,'contactConfirm','Contact | [bootLabel]','[contactUserName],\r\n\r\nWe have received your email sent from [bootLabel].\r\n\r\n[emailFooter]',2,1588036958,2,1588905894),
	(4,1,'0',1,'contactAdmin','Contact | [bootLabel]','[adminName],\r\n\r\nA contact form has been submitted on: [schemeHost]\r\n\r\n[contactData]\r\n\r\nYou can acces the form at: [contactCmsLink]\r\n\r\n[emailFooter]',2,1588037050,2,1588905887);

/*!40000 ALTER TABLE `email` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table lang
# ------------------------------------------------------------

DROP TABLE IF EXISTS `lang`;

CREATE TABLE `lang` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `active` tinyint(1) DEFAULT 1,
  `type` text DEFAULT NULL,
  `key` varchar(100) DEFAULT NULL,
  `content_en` text DEFAULT NULL,
  `userAdd` int(11) DEFAULT NULL,
  `dateAdd` int(11) DEFAULT NULL,
  `userModify` int(11) DEFAULT NULL,
  `dateModify` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `typeKey` (`type`(10),`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `lang` WRITE;
/*!40000 ALTER TABLE `lang` DISABLE KEYS */;

INSERT INTO `lang` (`id`, `active`, `type`, `key`, `content_en`, `userAdd`, `dateAdd`, `userModify`, `dateModify`)
VALUES
	(1,1,'0,1','label','Project - QuidPHP',2,1585857756,2,1585858259),
	(2,1,'0,1','relation/contextType/app','Application',2,1585856931,NULL,NULL),
	(3,1,'0,1','email/footer','Please do not respond to this automated email.\r\n\r\nThank you,\r\n[bootLabel]\r\n[schemeHost]',2,1600115251,NULL,NULL);

/*!40000 ALTER TABLE `lang` ENABLE KEYS */;
UNLOCK TABLES;


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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



# Dump of table logCron
# ------------------------------------------------------------

DROP TABLE IF EXISTS `logCron`;

CREATE TABLE `logCron` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `route` varchar(100) DEFAULT NULL,
  `context` varchar(100) DEFAULT NULL,
  `json` text DEFAULT NULL,
  `session_id` int(11) DEFAULT NULL,
  `userCommit` int(11) DEFAULT NULL,
  `userAdd` int(11) DEFAULT NULL,
  `dateAdd` int(11) DEFAULT NULL,
  `userModify` int(11) DEFAULT NULL,
  `dateModify` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `logCron` WRITE;
/*!40000 ALTER TABLE `logCron` DISABLE KEYS */;

INSERT INTO `logCron` (`id`, `route`, `context`, `json`, `session_id`, `userCommit`, `userAdd`, `dateAdd`, `userModify`, `dateModify`)
VALUES
	(1,'Quid\\Lemur\\Cms\\CliClearAll','{\"env\":\"dev\",\"type\":\"cms\",\"lang\":\"en\",\"role\":\"admin\"}','[{\"pos\":\"/Server/quidphp/project/storage/log\"},{\"pos\":\"/Server/quidphp/project/storage/error\"},{\"neg\":\"/Server/quidphp/project/storage/cache\"},{\"pos\":\"/Server/quidphp/project/public/css\"},{\"pos\":\"/Server/quidphp/project/public/js\"},{\"pos\":\"/Server/quidphp/project/public/media\"},{\"pos\":\"/Server/quidphp/project/public/storage\"},{\"pos\":\"Quid\\\\Core\\\\Row\\\\Log\"},{\"pos\":\"Quid\\\\Core\\\\Row\\\\LogCron\"},{\"pos\":\"Quid\\\\Core\\\\Row\\\\LogEmail\"},{\"pos\":\"Quid\\\\Core\\\\Row\\\\LogError\"},{\"pos\":\"Quid\\\\Core\\\\Row\\\\LogHttp\"},{\"pos\":\"Quid\\\\Core\\\\Row\\\\LogSql\"},{\"pos\":\"Quid\\\\Core\\\\Row\\\\QueueEmail\"},{\"pos\":\"Quid\\\\Core\\\\Row\\\\CacheRoute\"}]',3,2,2,1600115384,NULL,NULL);

/*!40000 ALTER TABLE `logCron` ENABLE KEYS */;
UNLOCK TABLES;


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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



# Dump of table redirection
# ------------------------------------------------------------

DROP TABLE IF EXISTS `redirection`;

CREATE TABLE `redirection` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `active` tinyint(1) DEFAULT 1,
  `type` text DEFAULT NULL,
  `key` varchar(200) DEFAULT NULL,
  `value` varchar(200) DEFAULT NULL,
  `userAdd` int(11) DEFAULT NULL,
  `dateAdd` int(11) DEFAULT NULL,
  `userModify` int(11) DEFAULT NULL,
  `dateModify` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `typeKey` (`type`(10),`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



# Dump of table session
# ------------------------------------------------------------

DROP TABLE IF EXISTS `session`;

CREATE TABLE `session` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `envType` varchar(100) DEFAULT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



# Dump of table user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `active` tinyint(1) DEFAULT 1,
  `role` text DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `passwordReset` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `timezone` int(11) DEFAULT NULL,
  `dateLogin` int(11) DEFAULT NULL,
  `userAdd` int(11) DEFAULT NULL,
  `dateAdd` int(11) DEFAULT NULL,
  `userModify` int(11) DEFAULT NULL,
  `dateModify` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;

INSERT INTO `user` (`id`, `active`, `role`, `username`, `password`, `passwordReset`, `email`, `timezone`, `dateLogin`, `userAdd`, `dateAdd`, `userModify`, `dateModify`)
VALUES
	(1,1,'1','nobody','$2y$10$ywnhcNg.BKj3RpnQ4q0rxOivOO6bCPHhnS.cwwndhxcd4.NjXkyoe',NULL,'nobody@project.com',NULL,NULL,2,1525308766,2,1526831130),
	(2,1,'80','admin','$2y$10$xpSmrVhcL7cnilNkvjbkeuZPknpdKrydj0avHCLWtwH5bI.mE5Ara',NULL,'admin@project.com',NULL,1600115063,2,1525308766,2,1600115063),
	(3,1,'90','cli','$2y$10$ywnhcNg.BKj3RpnQ4q0rxOivOO6bCPHhnS.cwwndhxcd4.NjXkyoe',NULL,'cli@project.com',NULL,NULL,3,1541533337,NULL,NULL);

/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
