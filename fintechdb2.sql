-- MySQL dump 10.13  Distrib 5.7.35, for Linux (x86_64)
--
-- Host: fintechclouddb.cnydfygbrhuz.us-east-1.rds.amazonaws.com    Database: fintechdb
-- ------------------------------------------------------
-- Server version	5.7.34-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
SET @MYSQLDUMP_TEMP_LOG_BIN = @@SESSION.SQL_LOG_BIN;
SET @@SESSION.SQL_LOG_BIN= 0;

--
-- GTID state at the beginning of the backup 
--

SET @@GLOBAL.GTID_PURGED='';

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(30) NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  `period` int(11) NOT NULL,
  `installments` decimal(10,0) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transactions`
--

LOCK TABLES `transactions` WRITE;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
INSERT INTO `transactions` VALUES (1,'emmanuel',100,5,20),(2,'emmanuel',100,1,0),(3,'emmanuel',100,0,0),(4,'emmanuel',100,4,25),(5,'emmanuel',100,6,16),(6,'emmanuel',100,1,0),(7,'emmanuel',100,1,0),(8,'emmanuel',100,1,0),(9,'emmanuel',100,4,25),(10,'emmanuel',100,4,25),(11,'emmanuel',100,0,0),(12,'emmanuel',100,1,0),(13,'emmanuel',100,0,0),(14,'emmanuel',100,1,0),(15,'emmanuel',100,900,0),(16,'emmanuel',100,100,1),(17,'emmanuel',100,4,25),(18,'emmanuel',100,0,0),(19,'emmanuel',100,4,25),(20,'emmanuel',100,4,25),(21,'emmanuel',100,4,25),(22,'emmanuel',100,4,25),(23,'emmanuel',100,0,0),(24,'emmanuel',100,4,25),(25,'emmanuel',100,4,25),(26,'emmanuel',100,0,0),(27,'emmanuel',100,4,25),(28,'emmanuel',100,4,25),(29,'fake_agomez@example.com',100,4,25),(30,'fake_agomez@example.com',100,4,25),(31,'fake_agomez@example.com',100,4,25),(32,'emmanuel',100,6,16);
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transactions_countryx`
--

DROP TABLE IF EXISTS `transactions_countryx`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transactions_countryx` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(30) NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  `period` int(11) NOT NULL,
  `installments` decimal(10,0) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transactions_countryx`
--

LOCK TABLES `transactions_countryx` WRITE;
/*!40000 ALTER TABLE `transactions_countryx` DISABLE KEYS */;
INSERT INTO `transactions_countryx` VALUES (1,'emmanuel',100,4,25),(2,'james',100,1,0),(3,'stacy',100,100,1),(4,'emmanuel',100,77,1),(5,'emmanuel',100,7,14),(6,'emmanuel',100,3,33);
/*!40000 ALTER TABLE `transactions_countryx` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'emmanuel','emmanuelpassword'),(2,'james','jamespassword'),(3,'stacy','stacypassword'),(4,'fake_agomez@example.com','password');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
SET @@SESSION.SQL_LOG_BIN = @MYSQLDUMP_TEMP_LOG_BIN;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-09-30  1:59:04
