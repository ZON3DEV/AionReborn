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
-- Table structure for table `houses`
--

DROP TABLE IF EXISTS `houses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `houses` (
  `id` int(10) NOT NULL,
  `player_id` int(10) NOT NULL DEFAULT '0',
  `building_id` int(10) NOT NULL,
  `address` int(10) NOT NULL,
  `acquire_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `settings` int(11) NOT NULL DEFAULT '0',
  `status` enum('ACTIVE','SELL_WAIT','INACTIVE','NOSALE') NOT NULL DEFAULT 'ACTIVE',
  `fee_paid` tinyint(1) NOT NULL DEFAULT '1',
  `next_pay` timestamp NULL DEFAULT NULL,
  `sell_started` timestamp NULL DEFAULT NULL,
  `sign_notice` binary(130) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `address` (`address`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `houses`
--

LOCK TABLES `houses` WRITE;
/*!40000 ALTER TABLE `houses` DISABLE KEYS */;
INSERT INTO `houses` (`id`, `player_id`, `building_id`, `address`, `acquire_time`, `settings`, `status`, `fee_paid`, `next_pay`, `sell_started`, `sign_notice`) VALUES (20324,0,352000,6004,'2022-04-22 19:01:40',256,'SELL_WAIT',1,NULL,'2022-04-22 19:01:40',NULL),(57288,0,352000,7005,'2022-04-22 19:01:40',256,'SELL_WAIT',1,NULL,'2022-04-22 19:01:40',NULL),(73553,0,352000,7104,'2022-04-22 19:01:40',256,'SELL_WAIT',1,NULL,'2022-04-22 19:01:40',NULL),(73557,0,352000,7105,'2022-04-22 19:01:40',256,'SELL_WAIT',1,NULL,'2022-04-22 19:01:40',NULL),(107095,0,350000,10002,'2022-04-22 19:01:45',256,'SELL_WAIT',1,NULL,'2022-04-22 19:01:45',NULL),(107127,0,353000,10097,'2022-04-22 19:01:44',256,'SELL_WAIT',1,NULL,'2022-04-22 19:01:44',NULL),(107151,0,353000,10157,'2022-04-22 19:01:41',256,'SELL_WAIT',1,NULL,'2022-04-22 19:01:41',NULL),(107155,0,353000,10174,'2022-04-22 19:01:44',256,'SELL_WAIT',1,NULL,'2022-04-22 19:01:44',NULL),(107175,0,353000,10194,'2022-04-22 19:01:40',256,'SELL_WAIT',1,NULL,'2022-04-22 19:01:40',NULL),(107255,0,353000,10253,'2022-04-22 19:01:40',256,'SELL_WAIT',1,NULL,'2022-04-22 19:01:40',NULL),(107299,0,353000,10275,'2022-04-22 19:01:43',256,'SELL_WAIT',1,NULL,'2022-04-22 19:01:43',NULL),(107303,0,353000,10276,'2022-04-22 19:01:43',256,'SELL_WAIT',1,NULL,'2022-04-22 19:01:43',NULL),(107359,0,353000,10307,'2022-04-22 19:01:43',256,'SELL_WAIT',1,NULL,'2022-04-22 19:01:43',NULL),(107395,0,353000,10316,'2022-04-22 19:01:43',256,'SELL_WAIT',1,NULL,'2022-04-22 19:01:43',NULL),(107419,0,353000,10329,'2022-04-22 19:01:44',256,'SELL_WAIT',1,NULL,'2022-04-22 19:01:44',NULL),(107571,0,353000,10377,'2022-04-22 19:01:44',256,'SELL_WAIT',1,NULL,'2022-04-22 19:01:44',NULL),(107575,0,353000,10381,'2022-04-22 19:01:43',256,'SELL_WAIT',1,NULL,'2022-04-22 19:01:43',NULL),(107583,0,353000,10383,'2022-04-22 19:01:43',256,'SELL_WAIT',1,NULL,'2022-04-22 19:01:43',NULL),(107735,0,353000,10424,'2022-04-22 19:01:42',256,'SELL_WAIT',1,NULL,'2022-04-22 19:01:42',NULL),(107827,0,353000,10447,'2022-04-22 19:01:42',256,'SELL_WAIT',1,NULL,'2022-04-22 19:01:42',NULL),(107883,0,353000,10461,'2022-04-22 19:01:41',256,'SELL_WAIT',1,NULL,'2022-04-22 19:01:41',NULL),(107923,0,353000,10471,'2022-04-22 19:01:40',256,'SELL_WAIT',1,NULL,'2022-04-22 19:01:40',NULL),(107931,0,353000,10473,'2022-04-22 19:01:42',256,'SELL_WAIT',1,NULL,'2022-04-22 19:01:42',NULL),(107947,0,353000,10477,'2022-04-22 19:01:43',256,'SELL_WAIT',1,NULL,'2022-04-22 19:01:43',NULL),(107995,0,353000,10489,'2022-04-22 19:01:40',256,'SELL_WAIT',1,NULL,'2022-04-22 19:01:40',NULL),(108139,0,352000,10110,'2022-04-22 19:01:42',256,'SELL_WAIT',1,NULL,'2022-04-22 19:01:42',NULL),(108179,0,352000,10131,'2022-04-22 19:01:42',256,'SELL_WAIT',1,NULL,'2022-04-22 19:01:42',NULL),(108259,0,352000,10170,'2022-04-22 19:01:42',256,'SELL_WAIT',1,NULL,'2022-04-22 19:01:42',NULL),(108311,0,352000,10203,'2022-04-22 19:01:43',256,'SELL_WAIT',1,NULL,'2022-04-22 19:01:43',NULL),(108379,0,352000,10230,'2022-04-22 19:01:43',256,'SELL_WAIT',1,NULL,'2022-04-22 19:01:43',NULL),(108447,0,352000,10267,'2022-04-22 19:01:39',256,'SELL_WAIT',1,NULL,'2022-04-22 19:01:39',NULL),(108491,0,352000,10300,'2022-04-22 19:01:42',256,'SELL_WAIT',1,NULL,'2022-04-22 19:01:42',NULL),(108563,0,352000,10359,'2022-04-22 19:01:40',256,'SELL_WAIT',1,NULL,'2022-04-22 19:01:40',NULL),(108567,0,352000,10360,'2022-04-22 19:01:43',256,'SELL_WAIT',1,NULL,'2022-04-22 19:01:43',NULL),(108811,0,351000,10069,'2022-04-22 19:01:41',256,'SELL_WAIT',1,NULL,'2022-04-22 19:01:41',NULL),(108839,0,351000,10084,'2022-04-22 19:01:42',256,'SELL_WAIT',1,NULL,'2022-04-22 19:01:42',NULL),(108859,0,351000,10098,'2022-04-22 19:01:39',256,'SELL_WAIT',1,NULL,'2022-04-22 19:01:39',NULL),(108971,0,351000,10159,'2022-04-22 19:01:41',256,'SELL_WAIT',1,NULL,'2022-04-22 19:01:41',NULL),(109083,0,351000,10318,'2022-04-22 19:01:42',256,'SELL_WAIT',1,NULL,'2022-04-22 19:01:42',NULL),(110789,0,352000,20148,'2022-04-22 19:01:40',256,'SELL_WAIT',1,NULL,'2022-04-22 19:01:40',NULL),(110865,0,352000,20186,'2022-04-22 19:01:43',256,'SELL_WAIT',1,NULL,'2022-04-22 19:01:43',NULL),(110869,0,352000,20187,'2022-04-22 19:01:43',256,'SELL_WAIT',1,NULL,'2022-04-22 19:01:43',NULL),(111077,0,352000,20301,'2022-04-22 19:01:42',256,'SELL_WAIT',1,NULL,'2022-04-22 19:01:42',NULL),(111109,0,352000,20322,'2022-04-22 19:01:42',256,'SELL_WAIT',1,NULL,'2022-04-22 19:01:42',NULL),(111161,0,352000,20379,'2022-04-22 19:01:44',256,'SELL_WAIT',1,NULL,'2022-04-22 19:01:44',NULL),(111165,0,352000,20380,'2022-04-22 19:01:42',256,'SELL_WAIT',1,NULL,'2022-04-22 19:01:42',NULL),(111217,0,353000,20137,'2022-04-22 19:01:41',256,'SELL_WAIT',1,NULL,'2022-04-22 19:01:41',NULL),(111225,0,353000,20157,'2022-04-22 19:01:39',256,'SELL_WAIT',1,NULL,'2022-04-22 19:01:39',NULL),(111325,0,353000,20252,'2022-04-22 19:01:44',256,'SELL_WAIT',1,NULL,'2022-04-22 19:01:44',NULL),(111353,0,353000,20270,'2022-04-22 19:01:43',256,'SELL_WAIT',1,NULL,'2022-04-22 19:01:43',NULL),(111381,0,353000,20277,'2022-04-22 19:01:44',256,'SELL_WAIT',1,NULL,'2022-04-22 19:01:44',NULL),(111425,0,353000,20297,'2022-04-22 19:01:44',256,'SELL_WAIT',1,NULL,'2022-04-22 19:01:44',NULL),(111433,0,353000,20307,'2022-04-22 19:01:44',256,'SELL_WAIT',1,NULL,'2022-04-22 19:01:44',NULL),(111445,0,353000,20310,'2022-04-22 19:01:41',256,'SELL_WAIT',1,NULL,'2022-04-22 19:01:41',NULL),(111493,0,353000,20329,'2022-04-22 19:01:44',256,'SELL_WAIT',1,NULL,'2022-04-22 19:01:44',NULL),(111529,0,353000,20344,'2022-04-22 19:01:43',256,'SELL_WAIT',1,NULL,'2022-04-22 19:01:43',NULL),(111565,0,353000,20353,'2022-04-22 19:01:44',256,'SELL_WAIT',1,NULL,'2022-04-22 19:01:44',NULL),(111689,0,353000,20391,'2022-04-22 19:01:45',256,'SELL_WAIT',1,NULL,'2022-04-22 19:01:45',NULL),(111765,0,353000,20412,'2022-04-22 19:01:41',256,'SELL_WAIT',1,NULL,'2022-04-22 19:01:41',NULL),(111841,0,353000,20432,'2022-04-22 19:01:44',256,'SELL_WAIT',1,NULL,'2022-04-22 19:01:44',NULL),(111873,0,353000,20440,'2022-04-22 19:01:40',256,'SELL_WAIT',1,NULL,'2022-04-22 19:01:40',NULL),(111881,0,353000,20442,'2022-04-22 19:01:44',256,'SELL_WAIT',1,NULL,'2022-04-22 19:01:44',NULL),(111913,0,353000,20450,'2022-04-22 19:01:43',256,'SELL_WAIT',1,NULL,'2022-04-22 19:01:43',NULL),(112025,0,353000,20478,'2022-04-22 19:01:44',256,'SELL_WAIT',1,NULL,'2022-04-22 19:01:44',NULL),(112029,0,353000,20479,'2022-04-22 19:01:44',256,'SELL_WAIT',1,NULL,'2022-04-22 19:01:44',NULL),(112077,0,353000,20491,'2022-04-22 19:01:40',256,'SELL_WAIT',1,NULL,'2022-04-22 19:01:40',NULL),(112125,0,350000,20003,'2022-04-22 19:01:45',256,'SELL_WAIT',1,NULL,'2022-04-22 19:01:45',NULL),(112177,0,351000,20015,'2022-04-22 19:01:42',256,'SELL_WAIT',1,NULL,'2022-04-22 19:01:42',NULL),(112209,0,351000,20024,'2022-04-22 19:01:41',256,'SELL_WAIT',1,NULL,'2022-04-22 19:01:41',NULL),(112321,0,351000,20063,'2022-04-22 19:01:40',256,'SELL_WAIT',1,NULL,'2022-04-22 19:01:40',NULL),(112521,0,351000,20163,'2022-04-22 19:01:41',256,'SELL_WAIT',1,NULL,'2022-04-22 19:01:41',NULL),(112525,0,351000,20164,'2022-04-22 19:01:40',256,'SELL_WAIT',1,NULL,'2022-04-22 19:01:40',NULL);
/*!40000 ALTER TABLE `houses` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-05-06  2:41:38