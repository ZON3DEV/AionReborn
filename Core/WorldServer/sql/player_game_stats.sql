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
-- Table structure for table `player_game_stats`
--

DROP TABLE IF EXISTS `player_game_stats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `player_game_stats` (
  `player_id` int(11) NOT NULL,
  `defense_physic` int(11) NOT NULL DEFAULT '1',
  `block` int(11) NOT NULL DEFAULT '1',
  `parry` int(11) NOT NULL DEFAULT '1',
  `magical_critical` int(11) NOT NULL DEFAULT '1',
  `evasion` int(11) NOT NULL DEFAULT '1',
  `precision` int(11) NOT NULL DEFAULT '1',
  `attack` int(11) NOT NULL DEFAULT '1',
  `magical_precision` int(11) NOT NULL DEFAULT '1',
  `attack_speed` int(11) NOT NULL DEFAULT '1',
  `magical_resist` int(11) NOT NULL DEFAULT '1',
  `magical_attack` int(11) NOT NULL DEFAULT '1',
  `main_hand_magical_attack` int(11) NOT NULL DEFAULT '1',
  `off_hand_magical_attack` int(11) NOT NULL DEFAULT '1',
  `physical_critical` int(11) NOT NULL DEFAULT '1',
  `attack_range` int(11) NOT NULL DEFAULT '1',
  `magical_defense` int(11) NOT NULL DEFAULT '1',
  `agility` int(11) NOT NULL DEFAULT '1',
  `knowledge` int(11) NOT NULL DEFAULT '1',
  `will` int(11) NOT NULL DEFAULT '1',
  `magical_boost` int(11) NOT NULL DEFAULT '1',
  `magical_boost_resist` int(11) NOT NULL DEFAULT '1',
  `physical_critical_resist` int(11) NOT NULL DEFAULT '1',
  `magical_critical_resist` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`player_id`) USING BTREE,
  CONSTRAINT `player_game_stats` FOREIGN KEY (`player_id`) REFERENCES `players` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `player_game_stats`
--

LOCK TABLES `player_game_stats` WRITE;
/*!40000 ALTER TABLE `player_game_stats` DISABLE KEYS */;
/*!40000 ALTER TABLE `player_game_stats` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-05-06  2:41:42
