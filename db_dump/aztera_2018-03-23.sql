# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.21)
# Database: aztera
# Generation Time: 2018-03-23 15:19:16 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table batch
# ------------------------------------------------------------

DROP TABLE IF EXISTS `batch`;

CREATE TABLE `batch` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dose_duration` double DEFAULT NULL,
  `dose_amount` double DEFAULT NULL,
  `vintage` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `varietal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `wine_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tank` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NULL DEFAULT NULL,
  `archived` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=252 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `batch` WRITE;
/*!40000 ALTER TABLE `batch` DISABLE KEYS */;

INSERT INTO `batch` (`id`, `name`, `type`, `dose_duration`, `dose_amount`, `vintage`, `varietal`, `wine_id`, `tank`, `created`, `updated`, `archived`, `created_at`, `updated_at`, `deleted_at`)
VALUES
	(223,NULL,NULL,NULL,NULL,'2017','v6','TestBatchLive','8','2017-12-05 19:19:17','2017-12-12 15:39:33','2017-12-21 23:58:11',NULL,'2018-03-23 14:40:48',NULL),
	(224,NULL,NULL,NULL,NULL,'2016','6','TestBatch2','66','2017-12-05 19:19:38','2017-12-14 18:36:45','2017-12-21 23:58:05',NULL,'2018-03-23 14:29:01',NULL),
	(225,NULL,NULL,NULL,NULL,'2019','v9','testing','5','2017-12-05 19:21:21',NULL,'2017-12-05 23:08:20',NULL,NULL,NULL),
	(226,NULL,NULL,NULL,NULL,'1987','Mega','Rockman','20xx','2017-12-05 19:24:22',NULL,'2017-12-05 23:08:27',NULL,NULL,NULL),
	(227,NULL,NULL,NULL,NULL,'1985','Mega','Cutman','20xx','2017-12-05 19:24:55',NULL,'2017-12-05 23:08:31',NULL,NULL,NULL),
	(228,NULL,NULL,NULL,NULL,'2017','v6','TestBatch1','8','2017-12-05 21:21:02','2017-12-11 15:30:29',NULL,NULL,NULL,NULL),
	(229,NULL,NULL,NULL,NULL,'2017','CHARDONNAY','2017CHCHARD-MWV','243','2017-12-05 22:21:47','2017-12-08 00:20:26',NULL,NULL,NULL,NULL),
	(230,NULL,NULL,NULL,NULL,'2017','v3','TestAdd','8','2017-12-06 17:02:54',NULL,'2017-12-07 18:08:23',NULL,NULL,NULL),
	(231,NULL,NULL,NULL,NULL,'2016','CABERNET SAUVIGNON','2016CABSAUV-MWV','42','2017-12-07 18:09:12',NULL,NULL,NULL,NULL,NULL),
	(232,NULL,NULL,NULL,NULL,'2017','AZT','SW_EMED','1102','2017-12-13 23:44:06','2017-12-13 23:45:16','2017-12-21 23:55:54',NULL,NULL,NULL),
	(233,NULL,NULL,NULL,NULL,'2017','az','TestBatch3','3','2017-12-14 18:46:26','2017-12-14 21:59:40','2017-12-21 23:56:28',NULL,NULL,NULL),
	(234,NULL,NULL,NULL,NULL,'2017','az','SW_EMED2','88','2017-12-15 21:49:58',NULL,'2017-12-21 23:56:04',NULL,NULL,NULL),
	(235,NULL,NULL,NULL,NULL,'2017','v9','TestBatch4','6','2017-12-18 15:23:52',NULL,'2017-12-21 23:56:34',NULL,NULL,NULL),
	(236,NULL,NULL,NULL,NULL,'2017','az','TestTimer1','9','2017-12-19 00:34:50',NULL,'2017-12-21 23:58:19',NULL,NULL,NULL),
	(237,NULL,NULL,NULL,NULL,'2017','az','TestTimer2','6','2017-12-20 00:02:40',NULL,'2017-12-21 23:56:39',NULL,NULL,NULL),
	(238,NULL,NULL,NULL,NULL,'2017','azt','TestTimer3','7','2017-12-21 01:46:19','2017-12-28 19:40:58',NULL,NULL,NULL,NULL),
	(239,NULL,NULL,NULL,NULL,'1995','Ella','Ella','3114','2017-12-29 15:50:12','2017-12-29 16:21:02','2017-12-29 16:21:18',NULL,NULL,NULL),
	(240,NULL,NULL,NULL,NULL,'1995','Human','Ella Jameson','3114','2017-12-29 16:05:18','2017-12-29 16:26:30','2018-01-12 19:18:54',NULL,NULL,NULL),
	(241,NULL,NULL,NULL,NULL,'2017','v6','wine','86','2018-01-09 05:23:19',NULL,'2018-01-09 05:23:41',NULL,NULL,NULL),
	(242,NULL,NULL,NULL,NULL,'2018','21','Josh','21','2018-01-12 17:54:28','2018-01-29 16:57:07',NULL,NULL,NULL,NULL),
	(243,NULL,NULL,NULL,NULL,'2018','azt','TestDosing','8','2018-01-12 17:59:49',NULL,NULL,NULL,NULL,NULL),
	(244,NULL,NULL,NULL,NULL,'54685','Jalepeno','2018 Test DCM','256685','2018-01-17 20:17:05','2018-01-17 21:34:47',NULL,NULL,NULL,NULL),
	(245,NULL,NULL,NULL,NULL,'2018','azt','EditingTest','252','2018-01-18 15:59:45','2018-01-26 18:05:50','2018-02-07 16:51:16',NULL,NULL,NULL),
	(246,NULL,NULL,NULL,NULL,'2018','azt','TestDosing2','28','2018-01-18 20:01:10','2018-02-12 18:38:33',NULL,NULL,NULL,NULL),
	(247,NULL,NULL,NULL,NULL,'2016','21','FixItFriday26','21','2018-01-24 18:19:29','2018-01-26 18:10:21','2018-02-07 16:52:08',NULL,NULL,NULL),
	(248,NULL,NULL,NULL,NULL,'asd','asdsad','asdsa','asdsad','2018-03-23 22:52:25',NULL,NULL,'2018-03-23 14:52:25','2018-03-23 14:52:25',NULL),
	(249,NULL,NULL,NULL,NULL,'12313213','asdad','asda','asdasd','2018-03-23 22:55:25',NULL,NULL,'2018-03-23 14:55:25','2018-03-23 14:55:25',NULL),
	(250,NULL,NULL,NULL,NULL,'12313213','asdad','asda','asdasd','2018-03-23 22:55:51',NULL,NULL,'2018-03-23 14:55:51','2018-03-23 15:08:41','2018-03-23 15:08:41'),
	(251,NULL,NULL,NULL,NULL,'12313213','asdad','asda','asdasd','2018-03-23 22:56:12',NULL,NULL,'2018-03-23 14:56:12','2018-03-23 15:02:15','2018-03-23 15:02:15');

/*!40000 ALTER TABLE `batch` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
