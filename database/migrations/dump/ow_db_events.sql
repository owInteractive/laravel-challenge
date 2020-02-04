CREATE DATABASE  IF NOT EXISTS `ow_db` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `ow_db`;
-- MySQL dump 10.13  Distrib 8.0.18, for Win64 (x86_64)
--
-- Host: 45.79.104.70    Database: ow_db
-- ------------------------------------------------------
-- Server version	8.0.18-0ubuntu0.19.10.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(45) NOT NULL,
  `description` varchar(500) NOT NULL,
  `start` datetime DEFAULT NULL,
  `end` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
INSERT INTO `events` VALUES (3,NULL,'Novo evento','Novo evento alterado','2020-02-01 18:00:00','2020-02-01 01:00:00','2020-02-01 17:30:56','2020-02-01 18:49:18'),(4,NULL,'Aniversário do Heitor','O aniversário do Heitor vai contar com inúmeras pessoas, e essas pessoas algumas vão chegar a pé e outras de carro.\r\nPodemos ter gente até de helicóptero.','2020-02-01 01:00:00','2020-02-01 08:59:00','2020-02-01 19:00:21','2020-02-01 19:01:41'),(5,NULL,'Nova festa da Elis','wqeqwe','2020-02-02 08:00:00','2020-02-02 09:00:00','2020-02-02 21:29:20','2020-02-02 21:29:20'),(6,NULL,'Nova festa do heitor','Baita festa','2020-02-02 23:55:00','2020-02-02 23:58:00','2020-02-03 01:47:39','2020-02-03 01:47:39'),(7,1,'Novo evento CSV1','Este evento CSV1  muito legal','2001-01-20 08:00:00','2001-01-20 09:00:00',NULL,NULL),(8,1,'Novo evento CSV2','Este evento CSV1  muito legal','2002-01-20 08:00:00','2002-01-20 09:00:00',NULL,NULL),(9,1,'Novo evento CSV3','Este evento CSV1  muito legal','2003-01-20 08:00:00','2003-01-20 09:00:00',NULL,NULL),(10,1,'Novo evento CSV4','Este evento CSV1  muito legal','2004-01-20 08:00:00','2004-01-20 09:00:00',NULL,NULL),(11,1,'Novo evento CSV5','Este evento CSV1  muito legal','2005-01-20 08:00:00','2005-01-20 09:00:00',NULL,NULL),(12,1,'Novo evento CSV6','Este evento CSV1  muito legal','2006-01-20 08:00:00','2006-01-20 09:00:00',NULL,NULL),(13,1,'Novo evento CSV7','Este evento CSV1  muito legal','2007-01-20 08:00:00','2007-01-20 09:00:00',NULL,NULL),(14,1,'Novo evento CSV8','Este evento CSV1  muito legal','2008-01-20 08:00:00','2008-01-20 09:00:00',NULL,NULL),(15,1,'Novo evento CSV9','Este evento CSV1  muito legal','2009-01-20 08:00:00','2009-01-20 09:00:00',NULL,NULL),(16,1,'Novo evento CSV10','Este evento CSV1  muito legal','2010-01-20 08:00:00','2010-01-20 09:00:00',NULL,NULL),(17,1,'Novo evento CSV11','Este evento CSV1  muito legal','2011-01-20 08:00:00','2011-01-20 09:00:00',NULL,NULL),(18,1,'Novo evento CSV12','Este evento CSV1  muito legal','2012-01-20 08:00:00','2012-01-20 09:00:00',NULL,NULL),(19,1,'Novo evento CSV13','Este evento CSV1  muito legal','2013-01-20 08:00:00','2013-01-20 09:00:00',NULL,NULL),(20,1,'Novo evento CSV14','Este evento CSV1  muito legal','2014-01-20 08:00:00','2014-01-20 09:00:00',NULL,NULL),(21,1,'Novo evento CSV15','Este evento CSV1  muito legal','2015-01-20 08:00:00','2015-01-20 09:00:00',NULL,NULL),(22,1,'Novo evento CSV16','Este evento CSV1  muito legal','2016-01-20 08:00:00','2016-01-20 09:00:00',NULL,NULL),(23,1,'Novo evento CSV17','Este evento CSV1  muito legal','2017-01-20 08:00:00','2017-01-20 09:00:00',NULL,NULL),(24,1,'Novo evento CSV18','Este evento CSV1  muito legal','2018-01-20 08:00:00','2018-01-20 09:00:00',NULL,NULL),(25,1,'Novo evento CSV19','Este evento CSV1  muito legal','2019-01-20 08:00:00','2019-01-20 09:00:00',NULL,NULL),(26,1,'Novo evento CSV20','Este evento CSV1  muito legal','2020-01-20 08:00:00','2020-01-20 09:00:00',NULL,NULL),(27,1,'Novo evento CSV21','Este evento CSV1  muito legal','2021-01-20 08:00:00','2021-01-20 09:00:00',NULL,NULL),(28,1,'Novo evento CSV22','Este evento CSV1  muito legal','2022-01-20 08:00:00','2022-01-20 09:00:00',NULL,NULL),(29,1,'Novo evento CSV1','Este evento CSV1  muito legal','2001-01-20 08:00:00','2001-01-20 09:00:00','2020-02-04 01:31:53',NULL),(30,1,'Novo evento CSV2','Este evento CSV1  muito legal','2002-01-20 08:00:00','2002-01-20 09:00:00','2020-02-04 01:31:53',NULL),(31,1,'Novo evento CSV3','Este evento CSV1  muito legal','2003-01-20 08:00:00','2003-01-20 09:00:00','2020-02-04 01:31:53',NULL),(32,1,'Novo evento CSV4','Este evento CSV1  muito legal','2004-01-20 08:00:00','2004-01-20 09:00:00','2020-02-04 01:31:53',NULL),(33,1,'Novo evento CSV5','Este evento CSV1  muito legal','2005-01-20 08:00:00','2005-01-20 09:00:00','2020-02-04 01:31:53',NULL),(34,1,'Novo evento CSV6','Este evento CSV1  muito legal','2006-01-20 08:00:00','2006-01-20 09:00:00','2020-02-04 01:31:53',NULL),(35,1,'Novo evento CSV7','Este evento CSV1  muito legal','2007-01-20 08:00:00','2007-01-20 09:00:00','2020-02-04 01:31:53',NULL),(36,1,'Novo evento CSV8','Este evento CSV1  muito legal','2008-01-20 08:00:00','2008-01-20 09:00:00','2020-02-04 01:31:53',NULL),(37,1,'Novo evento CSV9','Este evento CSV1  muito legal','2009-01-20 08:00:00','2009-01-20 09:00:00','2020-02-04 01:31:53',NULL),(38,1,'Novo evento CSV10','Este evento CSV1  muito legal','2010-01-20 08:00:00','2010-01-20 09:00:00','2020-02-04 01:31:53',NULL),(39,1,'Novo evento CSV11','Este evento CSV1  muito legal','2011-01-20 08:00:00','2011-01-20 09:00:00','2020-02-04 01:31:53',NULL),(40,1,'Novo evento CSV12','Este evento CSV1  muito legal','2012-01-20 08:00:00','2012-01-20 09:00:00','2020-02-04 01:31:53',NULL),(41,1,'Novo evento CSV13','Este evento CSV1  muito legal','2013-01-20 08:00:00','2013-01-20 09:00:00','2020-02-04 01:31:53',NULL),(42,1,'Novo evento CSV14','Este evento CSV1  muito legal','2014-01-20 08:00:00','2014-01-20 09:00:00','2020-02-04 01:31:53',NULL),(43,1,'Novo evento CSV15','Este evento CSV1  muito legal','2015-01-20 08:00:00','2015-01-20 09:00:00','2020-02-04 01:31:53',NULL),(44,1,'Novo evento CSV16','Este evento CSV1  muito legal','2016-01-20 08:00:00','2016-01-20 09:00:00','2020-02-04 01:31:53',NULL),(45,1,'Novo evento CSV17','Este evento CSV1  muito legal','2017-01-20 08:00:00','2017-01-20 09:00:00','2020-02-04 01:31:53',NULL),(46,1,'Novo evento CSV18','Este evento CSV1  muito legal','2018-01-20 08:00:00','2018-01-20 09:00:00','2020-02-04 01:31:53',NULL),(47,1,'Novo evento CSV19','Este evento CSV1  muito legal','2019-01-20 08:00:00','2019-01-20 09:00:00','2020-02-04 01:31:53',NULL),(48,1,'Novo evento CSV20','Este evento CSV1  muito legal','2020-01-20 08:00:00','2020-01-20 09:00:00','2020-02-04 01:31:53',NULL),(49,1,'Novo evento CSV21','Este evento CSV1  muito legal','2021-01-20 08:00:00','2021-01-20 09:00:00','2020-02-04 01:31:53',NULL),(50,1,'Novo evento CSV22','Este evento CSV1  muito legal','2022-01-20 08:00:00','2022-01-20 09:00:00','2020-02-04 01:31:53',NULL),(51,1,'Novo evento CSV1','Este evento CSV1  muito legal','2001-01-20 08:00:00','2001-01-20 09:00:00','2020-02-04 01:32:22',NULL),(52,1,'Novo evento CSV2','Este evento CSV1  muito legal','2002-01-20 08:00:00','2002-01-20 09:00:00','2020-02-04 01:32:22',NULL),(53,1,'Novo evento CSV3','Este evento CSV1  muito legal','2003-01-20 08:00:00','2003-01-20 09:00:00','2020-02-04 01:32:22',NULL),(54,1,'Novo evento CSV4','Este evento CSV1  muito legal','2004-01-20 08:00:00','2004-01-20 09:00:00','2020-02-04 01:32:22',NULL),(55,1,'Novo evento CSV5','Este evento CSV1  muito legal','2005-01-20 08:00:00','2005-01-20 09:00:00','2020-02-04 01:32:22',NULL),(56,1,'Novo evento CSV6','Este evento CSV1  muito legal','2006-01-20 08:00:00','2006-01-20 09:00:00','2020-02-04 01:32:22',NULL),(57,1,'Novo evento CSV7','Este evento CSV1  muito legal','2007-01-20 08:00:00','2007-01-20 09:00:00','2020-02-04 01:32:22',NULL),(58,1,'Novo evento CSV8','Este evento CSV1  muito legal','2008-01-20 08:00:00','2008-01-20 09:00:00','2020-02-04 01:32:22',NULL),(59,1,'Novo evento CSV9','Este evento CSV1  muito legal','2009-01-20 08:00:00','2009-01-20 09:00:00','2020-02-04 01:32:22',NULL),(60,1,'Novo evento CSV10','Este evento CSV1  muito legal','2010-01-20 08:00:00','2010-01-20 09:00:00','2020-02-04 01:32:22',NULL),(61,1,'Novo evento CSV11','Este evento CSV1  muito legal','2011-01-20 08:00:00','2011-01-20 09:00:00','2020-02-04 01:32:22',NULL),(62,1,'Novo evento CSV12','Este evento CSV1  muito legal','2012-01-20 08:00:00','2012-01-20 09:00:00','2020-02-04 01:32:22',NULL),(63,1,'Novo evento CSV13','Este evento CSV1  muito legal','2013-01-20 08:00:00','2013-01-20 09:00:00','2020-02-04 01:32:22',NULL),(64,1,'Novo evento CSV14','Este evento CSV1  muito legal','2014-01-20 08:00:00','2014-01-20 09:00:00','2020-02-04 01:32:22',NULL),(65,1,'Novo evento CSV15','Este evento CSV1  muito legal','2015-01-20 08:00:00','2015-01-20 09:00:00','2020-02-04 01:32:22',NULL),(66,1,'Novo evento CSV16','Este evento CSV1  muito legal','2016-01-20 08:00:00','2016-01-20 09:00:00','2020-02-04 01:32:22',NULL),(67,1,'Novo evento CSV17','Este evento CSV1  muito legal','2017-01-20 08:00:00','2017-01-20 09:00:00','2020-02-04 01:32:22',NULL),(68,1,'Novo evento CSV18','Este evento CSV1  muito legal','2018-01-20 08:00:00','2018-01-20 09:00:00','2020-02-04 01:32:22',NULL),(69,1,'Novo evento CSV19','Este evento CSV1  muito legal','2019-01-20 08:00:00','2019-01-20 09:00:00','2020-02-04 01:32:22',NULL),(70,1,'Novo evento CSV20','Este evento CSV1  muito legal','2020-01-20 08:00:00','2020-01-20 09:00:00','2020-02-04 01:32:22',NULL),(71,1,'Novo evento CSV21','Este evento CSV1  muito legal','2021-01-20 08:00:00','2021-01-20 09:00:00','2020-02-04 01:32:22',NULL),(72,1,'Novo evento CSV22','Este evento CSV1  muito legal','2022-01-20 08:00:00','2022-01-20 09:00:00','2020-02-04 01:32:22',NULL),(73,1,'Event user_id','Event 3','2020-02-05 08:00:00','2020-02-06 23:00:00','2020-02-04 02:03:41','2020-02-04 04:39:32');
/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-02-04  3:34:45
