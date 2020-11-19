-- MySQL dump 10.17  Distrib 10.3.25-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: mrtgadmin
-- ------------------------------------------------------
-- Server version	10.3.25-MariaDB-0+deb10u1-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admin_accounts`
--

DROP TABLE IF EXISTS `admin_accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin_accounts` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `series_id` varchar(60) DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `expires` datetime DEFAULT NULL,
  `admin_type` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_name` (`user_name`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_accounts`
--

LOCK TABLES `admin_accounts` WRITE;
/*!40000 ALTER TABLE `admin_accounts` DISABLE KEYS */;
INSERT INTO `admin_accounts` VALUES (9,'admin','$2y$10$CXO/NzS5FtfK5VeNaXUbGeEGXqY/NxDMjQXroi2/wOxp9p6oBKqby',NULL,NULL,NULL,'super'),(10,'admin','$2y$10$vzOFXlcmjcOQMnzGivWKFe97hcRDqJzU45gkZPmjDp.Ov2JWpSCsu',NULL,NULL,NULL,'super');
/*!40000 ALTER TABLE `admin_accounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `budova`
--

DROP TABLE IF EXISTS `budova`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `budova` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nazov` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `budova`
--

LOCK TABLES `budova` WRITE;
/*!40000 ALTER TABLE `budova` DISABLE KEYS */;
INSERT INTO `budova` VALUES (6,'W4'),(7,'N3-test'),(9,'N9'),(11,'VYS4');
/*!40000 ALTER TABLE `budova` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customers` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `f_name` varchar(25) NOT NULL,
  `l_name` varchar(25) NOT NULL,
  `gender` varchar(6) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `city` varchar(15) DEFAULT NULL,
  `state` varchar(30) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` VALUES (1,'chetan','Shenai','female','waaw awf',NULL,'Maharashtra','99878','chetanshenai9@gmail.com','2019-07-23','2019-07-22 20:12:30','2019-07-22 20:12:41'),(2,'Cfree','wawfaf','male','piohh',NULL,'Madhya pradesh','09975342821','cgtarta@ll.com','2020-10-14','2020-10-24 15:46:45','2020-10-24 15:46:53');
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lokalita`
--

DROP TABLE IF EXISTS `lokalita`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lokalita` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nazov` varchar(255) NOT NULL,
  `budovaid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lokalita`
--

LOCK TABLES `lokalita` WRITE;
/*!40000 ALTER TABLE `lokalita` DISABLE KEYS */;
INSERT INTO `lokalita` VALUES (8,'W4_0p_chodba',6),(9,'W4_0p_pristavba',6),(10,'W4_1p_chodba',6),(11,'W4_3p_L_kumbal_upratovacky',6),(12,'N3_test_Kablovna',7),(13,'N3_test_A-blok_0p_BERG',7),(14,'N3_test_A-blok_0p_dispecing',7),(15,'N3_test_A-blok_0p_kaviaren',7),(16,'N3_test_A-blok_3p',7),(17,'N3_test_B-blok_0p_mc27_ucebna',7),(18,'N3_test_B-blok_0p_mc29_ucebna',7),(19,'N3_test_B-blok_0p_mc30_ucebna',7),(20,'N3_test_B-blok_Hala',7),(21,'N9_ZP_0p_chodba',9),(22,'V4_A-blok_0p_KJ2',11);
/*!40000 ALTER TABLE `lokalita` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `swzoznam`
--

DROP TABLE IF EXISTS `swzoznam`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `swzoznam` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `swname` varchar(255) NOT NULL,
  `swip` varchar(255) NOT NULL,
  `idlokalita` int(11) NOT NULL,
  `idbudova` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idlokalita` (`idlokalita`),
  KEY `idlokalita_2` (`idlokalita`),
  KEY `idlokalita_3` (`idlokalita`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `swzoznam`
--

LOCK TABLES `swzoznam` WRITE;
/*!40000 ALTER TABLE `swzoznam` DISABLE KEYS */;
INSERT INTO `swzoznam` VALUES (8,'sw-wat2.test.tuke.sk','192.168.255.26',11,6),(9,'sw-wat3.test.tuke.sk','192.168.254.102',10,6),(10,'sw-wat1.test.tuke.sk','192.168.255.55',9,6),(11,'sw-wat.test.tuke.sk','192.168.254.100',8,6),(12,'sw-kablovna.test.tuke.sk','192.168.255.51',12,7),(13,'sw-bn3-lui.test.tuke.sk','192.168.254.217',13,7),(14,'sw-local3.test.tuke.sk','192.168.254.34',13,7),(15,'sw-local6.test.tuke.sk','192.168.254.131',13,7),(16,'sw-bn3-dispecing.test.tuke.sk','192.168.255.44',14,7),(17,'sw-bn3-kaviaren.test.tuke.sk','192.168.254.138',15,7),(18,'sw-bn3-fberg.test.tuke.sk','192.168.254.114',16,7),(19,'sw-local1.test.tuke.sk','192.168.254.32',16,7),(20,'sw-local.test.tuke.sk','192.168.254.31',16,7),(21,'sw-bn3-ucebna27.test.tuke.sk','192.168.255.39',17,7),(22,'sw-ucebna29-1.test.tuke.sk','192.168.122.1',18,7),(23,'sw-ucebna29-2.test.tuke.sk','192.168.122.2',18,7),(24,'sw-test2.test.tuke.sk','192.168.255.24',19,7),(25,'TU-Kosice.sanet2.sk','194.160.8.7',20,7),(26,'TU-sw48.tuke.sk','192.168.254.3',20,7),(27,'TUNET.tuke.sk','192.168.200.10',20,7),(28,'sw-mn.test.tuke.sk','192.168.254.130',20,7),(29,'sw-servery24.test.tuke.sk','192.168.254.26',20,7),(30,'sw-blade1.test.tuke.sk','192.168.254.108',20,7),(31,'sw-servery1.test.tuke.sk','192.168.254.28',20,7),(36,'sw-zp.test.tuke.sk','192.168.254.57',21,9),(37,'sw-vys-KJ2.test.tuke.sk','192.168.254.123	',22,11);
/*!40000 ALTER TABLE `swzoznam` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-11-19 14:55:54
