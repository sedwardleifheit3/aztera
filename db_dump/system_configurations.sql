# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.21)
# Database: enartis_dev
# Generation Time: 2018-03-25 07:56:11 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table system_configuration
# ------------------------------------------------------------


LOCK TABLES `system_configuration` WRITE;
/*!40000 ALTER TABLE `system_configuration` DISABLE KEYS */;

INSERT INTO `system_configuration` (`id`, `system_id`, `group`, `name`, `value`, `unit_id`, `created`, `removed`)
VALUES
	(1,1,'System','Recording Interval','1',2,'2017-05-05 23:59:25',NULL),
	(2,1,'System','Recording Interval','2',0,'2017-05-06 00:27:56',NULL),
	(3,1,'System','Language','US English1',0,'2017-05-06 00:27:56',NULL),
	(4,1,'Dosing Point Network','Dosing Point Default Gateway','10.0.1.11',0,'2017-05-06 00:27:56',NULL),
	(5,1,'Dosing Point Network','Dosing Point Subnet Mask','255.255.255.0',0,'2017-05-06 00:27:56',NULL),
	(6,1,'System','Language','US Engrlish',0,'2017-05-06 00:45:15',NULL),
	(7,1,'Dosing Point Network','Dosing Point Default Gateway','10.0.1.0',0,'2017-05-06 00:45:15',NULL),
	(8,1,'Dosing Point Network','Dosing Point Subnet Mask','255.255.255.1',0,'2017-05-06 00:45:15',NULL),
	(9,1,'System','Language','US English2',0,'2017-05-06 00:45:23',NULL),
	(10,1,'Dosing Point Network','Dosing Point Default Gateway','10.0.1.11',0,'2017-05-06 00:45:23',NULL),
	(11,1,'Dosing Point Network','Dosing Point Subnet Mask','255.255.255.0',0,'2017-05-06 00:45:23',NULL),
	(12,1,'System','Recording Interval','3',0,'2017-05-11 22:43:50',NULL);

/*!40000 ALTER TABLE `system_configuration` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
