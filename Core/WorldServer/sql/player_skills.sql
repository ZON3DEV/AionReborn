-- MySQL dump 10.13  Distrib 5.5.37, for Win32 (x86)
--
-- Host: 192.168.178.55    Database: al_server_gs
-- ------------------------------------------------------
-- Server version	5.7.37-log

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

--
-- Table structure for table `player_skills`
--

DROP TABLE IF EXISTS `player_skills`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `player_skills` (
  `player_id` int(11) NOT NULL,
  `skill_id` int(11) NOT NULL,
  `skill_level` int(3) NOT NULL DEFAULT '1',
  PRIMARY KEY (`player_id`,`skill_id`) USING BTREE,
  CONSTRAINT `player_skills_ibfk_1` FOREIGN KEY (`player_id`) REFERENCES `players` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `player_skills`
--

LOCK TABLES `player_skills` WRITE;
/*!40000 ALTER TABLE `player_skills` DISABLE KEYS */;
INSERT INTO `player_skills` (`player_id`, `skill_id`, `skill_level`) VALUES (115953,1,1),(115953,3,1),(115953,4,1),(115953,5,1),(115953,6,1),(115953,7,1),(115953,8,1),(115953,9,1),(115953,10,1),(115953,12,1),(115953,13,1),(115953,14,1),(115953,15,1),(115953,16,1),(115953,17,1),(115953,18,1),(115953,67,1),(115953,122,1),(115953,169,9),(115953,326,1),(115953,348,9),(115953,1801,1),(115953,1803,9),(115953,3512,1),(115953,30002,109),(115953,30003,54),(115953,40001,252),(115953,40002,200),(115953,40003,227),(115953,40009,4),(117460,1,1),(117460,4,1),(117460,5,1),(117460,30,1),(117460,67,1),(117460,564,4),(117460,572,1),(117460,1801,1),(117460,1803,4),(117460,3512,1),(117460,30001,3);
/*!40000 ALTER TABLE `player_skills` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-05-06  2:41:44
