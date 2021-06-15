-- MariaDB dump 10.19  Distrib 10.4.18-MariaDB, for osx10.10 (x86_64)
--
-- Host: localhost    Database: kdmdb
-- ------------------------------------------------------
-- Server version	10.4.18-MariaDB

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
-- Table structure for table `contrats`
--

DROP TABLE IF EXISTS `contrats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contrats` (
  `contrat_id` varchar(255) NOT NULL,
  `num_ap` int(11) NOT NULL,
  `obj_contract` varchar(255) NOT NULL,
  `lieu` varchar(255) DEFAULT NULL,
  `constructeur` varchar(255) DEFAULT NULL,
  `conc` varchar(255) DEFAULT NULL,
  `date_approvation` date DEFAULT NULL,
  `date_mise_ev` date DEFAULT NULL,
  `date_drp` date DEFAULT NULL,
  `date_drd` date DEFAULT NULL,
  `delai_realisation` tinyint(4) DEFAULT NULL,
  `montant_or_tva_devise` float DEFAULT NULL,
  `montant_o_tva_da` float DEFAULT NULL,
  `montant_total` float DEFAULT NULL,
  PRIMARY KEY (`contrat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contrats`
--

LOCK TABLES `contrats` WRITE;
/*!40000 ALTER TABLE `contrats` DISABLE KEYS */;
INSERT INTO `contrats` VALUES ('AZE123',123,'test','test','test','test','2021-06-24','2021-06-25','2021-06-18','2021-06-08',5,7,7,2);
/*!40000 ALTER TABLE `contrats` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phases`
--

DROP TABLE IF EXISTS `phases`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phases` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_phase` varchar(15) DEFAULT NULL,
  `date_debut` date DEFAULT NULL,
  `duree` smallint(6) DEFAULT 0,
  `taux_av_r` float DEFAULT 0,
  `taux_p` float DEFAULT 0,
  `pr_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pr_id` (`pr_id`),
  CONSTRAINT `phases_ibfk_1` FOREIGN KEY (`pr_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phases`
--

LOCK TABLES `phases` WRITE;
/*!40000 ALTER TABLE `phases` DISABLE KEYS */;
INSERT INTO `phases` VALUES (1,'phase1','2021-07-01',5,5,5,1),(2,'phase2','2021-07-30',5,5,5,1),(3,'phase3','2021-07-02',7,5,5,1);
/*!40000 ALTER TABLE `phases` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project_intit`
--

DROP TABLE IF EXISTS `project_intit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project_intit` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `intit` varchar(7) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `intit` (`intit`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project_intit`
--

LOCK TABLES `project_intit` WRITE;
/*!40000 ALTER TABLE `project_intit` DISABLE KEYS */;
INSERT INTO `project_intit` VALUES (2,'CC'),(4,'DIESEL'),(6,'EOLIEN'),(3,'TC'),(1,'TG'),(5,'TV');
/*!40000 ALTER TABLE `project_intit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `projects` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `intit_id` tinyint(3) unsigned DEFAULT NULL,
  `contrat_id` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `intit_id` (`intit_id`),
  KEY `contrat_id` (`contrat_id`),
  CONSTRAINT `projects_ibfk_1` FOREIGN KEY (`intit_id`) REFERENCES `project_intit` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `projects_ibfk_2` FOREIGN KEY (`contrat_id`) REFERENCES `contrats` (`contrat_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects`
--

LOCK TABLES `projects` WRITE;
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;
INSERT INTO `projects` VALUES (1,2,'AZE123');
/*!40000 ALTER TABLE `projects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(55) DEFAULT NULL,
  `lname` varchar(55) DEFAULT NULL,
  `username` varchar(55) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(155) DEFAULT NULL,
  `phoneNumber` varchar(10) DEFAULT NULL,
  `prv` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (3,'yas','yasmine','admin','40bd001563085fc35165329ea1ff5c5ecbdbbeef','admin@gmail.com','0553284915',0),(9,'yasmine','yas','y333','40bd001563085fc35165329ea1ff5c5ecbdbbeef','y3@gmail.com','0783844624',1),(20,'test','test','test333','f7c3bc1d808e04732adf679965ccc34ca7ae3441','test@gmail.com','0553284910',3);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-06-15 16:26:27
