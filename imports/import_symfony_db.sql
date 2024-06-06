-- MySQL dump 10.13  Distrib 8.4.0, for Linux (x86_64)
--
-- Host: localhost    Database: symfony_db
-- ------------------------------------------------------
-- Server version       8.4.0

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `bulb`
--

DROP TABLE IF EXISTS `bulb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bulb` (
  `id` int NOT NULL AUTO_INCREMENT,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `room_label` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_on` tinyint(1) DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `luminosity` double DEFAULT NULL,
  `hours` int DEFAULT NULL,
  `model_id_id` int DEFAULT NULL,
  `wifi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `place_id_id` int NOT NULL,
  `mood_id_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_88A56EF04107BEA0` (`model_id_id`),
  KEY `IDX_88A56EF076C5A04A` (`mood_id_id`),
  KEY `IDX_88A56EF0D6328574` (`place_id_id`),
  CONSTRAINT `FK_88A56EF04107BEA0` FOREIGN KEY (`model_id_id`) REFERENCES `model` (`id`),
  CONSTRAINT `FK_88A56EF076C5A04A` FOREIGN KEY (`mood_id_id`) REFERENCES `mood` (`id`),
  CONSTRAINT `FK_88A56EF0D6328574` FOREIGN KEY (`place_id_id`) REFERENCES `place` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bulb`
--

LOCK TABLES `bulb` WRITE;
/*!40000 ALTER TABLE `bulb` DISABLE KEYS */;
INSERT INTO `bulb` VALUES (5,'Plafonnier','Salon',1,'false','#F5F2C3',50,0,1,'Home_00',5,1),(6,'Lampe appoint','Sejour',0,'false','#F5F2C3',50,1540,2,'Home_00',6,2),(7,'Cellier','Cellier',0,'true','#F5F2C3 ',50,9212,3,'MaMaison',7,3),(10,'Ma 1ere ampoule de test',NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,5,1),(12,'Test 23',NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,5,1);
/*!40000 ALTER TABLE `bulb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctrine_migration_versions`
--

LOCK TABLES `doctrine_migration_versions` WRITE;
/*!40000 ALTER TABLE `doctrine_migration_versions` DISABLE KEYS */;
INSERT INTO `doctrine_migration_versions` VALUES ('DoctrineMigrations\\Version20240523102750','2024-05-28 07:03:25',85),('DoctrineMigrations\\Version20240523141255','2024-05-28 07:03:25',15),('DoctrineMigrations\\Version20240523151617','2024-05-28 07:03:26',27),('DoctrineMigrations\\Version20240531094001','2024-05-31 09:43:24',400),('DoctrineMigrations\\Version20240531104909','2024-05-31 10:49:24',54),('DoctrineMigrations\\Version20240531105719','2024-05-31 10:57:32',72),('DoctrineMigrations\\Version20240531120122','2024-05-31 12:01:34',37),('DoctrineMigrations\\Version20240531120813','2024-05-31 12:08:24',47),('DoctrineMigrations\\Version20240531121739','2024-05-31 12:17:49',67),('DoctrineMigrations\\Version20240531134135','2024-05-31 13:41:48',27),('DoctrineMigrations\\Version20240603082500','2024-06-03 08:25:25',73),('DoctrineMigrations\\Version20240603105608','2024-06-03 10:56:45',55),('DoctrineMigrations\\Version20240603105840','2024-06-03 10:58:52',42),('DoctrineMigrations\\Version20240603124309','2024-06-03 12:43:21',130),('DoctrineMigrations\\Version20240603141004','2024-06-03 14:10:18',64);
/*!40000 ALTER TABLE `doctrine_migration_versions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `messenger_messages` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messenger_messages`
--

LOCK TABLES `messenger_messages` WRITE;
/*!40000 ALTER TABLE `messenger_messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `messenger_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model`
--

DROP TABLE IF EXISTS `model`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model` (
  `id` int NOT NULL AUTO_INCREMENT,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hours_max` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `default_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `default_luminosity` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model`
--

LOCK TABLES `model` WRITE;
/*!40000 ALTER TABLE `model` DISABLE KEYS */;
INSERT INTO `model` VALUES (1,'KDF-6546654',25000,'Stella Premium DB6','#f5f5f5',100),(2,'DSF-5852231',5000,'Star Premium DB7','#f5f5f5',100),(3,'SED-5873212',10000,'Stern Standard MK2','#f5f5f5',100),(4,'DEK-5787554',20000,'Izarra Standard MK1','#f5f5f5',100),(5,'SED-8998762',5000,'Ralt Medium VS2','#f5f5f5',100),(6,'SDS-7521444',8000,'Stella Premium DB8','#f5f5f5',100),(7,'SZZ-8987985',25000,'Star Premium DB5','#f5f5f5',100),(8,'QAA-8524785',32000,'Stern Standard MK3','#f5f5f5',100),(9,'YHH-8956612',42000,'Izarra Standard MK2','#f5f5f5',100),(10,'FFF-8989765',15000,'Ralt Medium VS1','#f5f5f5',100);
/*!40000 ALTER TABLE `model` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mood`
--

DROP TABLE IF EXISTS `mood`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mood` (
  `id` int NOT NULL AUTO_INCREMENT,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `luminosity` double DEFAULT NULL,
  `user_id` int NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mood`
--

LOCK TABLES `mood` WRITE;
/*!40000 ALTER TABLE `mood` DISABLE KEYS */;
INSERT INTO `mood` VALUES (1,'#ff9f33',75,2,'rouge profond'),(2,'#a2ff33',50,3,'vert printanier'),(3,'#d2b6d2',100,4,'Disco'),(4,'#b6c0d2',100,5,'Sombre'),(5,'#f1f110',95,6,'Jaune violent'),(6,'#ff9f33',75,3,'rouge profond'),(7,'#407a60',85.52,2,'Vert canard pas content');
/*!40000 ALTER TABLE `mood` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `place`
--

DROP TABLE IF EXISTS `place`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `place` (
  `id` int NOT NULL AUTO_INCREMENT,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `place`
--

LOCK TABLES `place` WRITE;
/*!40000 ALTER TABLE `place` DISABLE KEYS */;
INSERT INTO `place` VALUES (5,'Maison 1','28 rue du pont','2me G','75009','Paris','0123455647',2),(6,'Maison vacances','35 route du bois','','95420','Vaux sur Seine','',3),(7,'Magasin 1','55 boulevard de la Paix','Au fond','54870','Charleville','',4),(8,'Ma jolie maison','28 rue de la traverse','Bâtiment B5','75004','PARIS','0102030405',2);
/*!40000 ALTER TABLE `place` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `schedule`
--

DROP TABLE IF EXISTS `schedule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `schedule` (
  `id` int NOT NULL AUTO_INCREMENT,
  `start_day` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  `end_day` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  `recurrence` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_hour` time DEFAULT NULL COMMENT '(DC2Type:time_immutable)',
  `end_hour` time DEFAULT NULL COMMENT '(DC2Type:time_immutable)',
  `user_id` int NOT NULL,
  `mood_id_id` int DEFAULT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5A3811FB76C5A04A` (`mood_id_id`),
  CONSTRAINT `FK_5A3811FB76C5A04A` FOREIGN KEY (`mood_id_id`) REFERENCES `mood` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `schedule`
--

LOCK TABLES `schedule` WRITE;
/*!40000 ALTER TABLE `schedule` DISABLE KEYS */;
INSERT INTO `schedule` VALUES (1,'2024-06-25 00:00:00','2024-06-28 00:00:00','M','08:00:00','10:00:00',1,1,'matin'),(2,'2024-06-02 00:00:00','2026-06-28 00:00:00','D','08:00:00','10:00:00',2,2,'matin'),(3,'2025-05-04 00:00:00','2026-06-28 00:00:00','D','12:00:00','14:00:00',3,3,'Apres-midi'),(4,'2025-05-04 00:00:00','2026-06-28 00:00:00','D','18:00:00','20:00:00',4,4,'Gouter'),(5,'2024-06-17 12:00:00','2025-06-16 12:00:00','Day','12:00:00','12:00:00',2,3,'Mon programme');
/*!40000 ALTER TABLE `schedule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_address_number` int DEFAULT NULL,
  `shipping_address_streetname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_address_postalcode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_address_complement` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_address_city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_address_number` int DEFAULT NULL,
  `billing_address_streetname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_address_postalcode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_address_complement` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_address_city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` int DEFAULT NULL,
  `siret` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_IDENTIFIER_EMAIL` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'Util_01@gmail.com','[]','$2y$13$wZuQ2hSrnwxvUXVQSTa6cebUlvaFt6b72lGQfGqA5gNB0pO27Eliu',NULL,NULL,NULL,NULL,NULL,'Prospect',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2,'Util_02@gmail.com','[]','$2y$13$Hgpj6aSVHvz1OEqURNcH/.qHPU0gsPJIpHi1b9i..BRsKuzrk4vEW','Jay','Uneampoule',82,'Rue de la Nation','75009','1 Ampoule','PARIS',65,'Rue de la Nation Libre','75010','Bat 24','PARIS 10',245788562,'PT254785644'),(3,'Util_03@gmail.com','[]','$2y$13$hUe9/uTz5DzulDQPD5bpQuU0bI6hIezYtMW4K9EbtMwVCRvuYIkPu','Jay','Deuxampoule',NULL,NULL,NULL,'2 Ampoules + 1 Pièce',NULL,45,'Rue de la Gare','78500',NULL,'VILLEMOCHE',245856245,'PT65454-54654'),(4,'Util_04@gmail.com','[]','$2y$13$xuKEDC34X3kb4p9APZ38UukeKYMeGtpCutB0IFTJQoqFTxwdqBIgC','Jay','Troisampoules',58,'Rue du Ruisseau','45050','3 Ampoules + 2 Pièces','VILLEBELLE',45,'Rue de la Victoire','75010',NULL,'PARIS',245877459,'RF56465-321'),(5,'Util_05@gmail.com','[]','$2y$13$VLPGlk0Yuc796N4gU0e.4eEAyoJqTIZl3sbDfJ.U5WQsvcVf4Ig3K',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(6,'Util_06@gmail.com','[]','$2y$13$56RhPkU3lgQDaiJ3nMuOWOURkLKCfV2gxyOqCfGWNzR905wOBfgUC',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(7,'Util_07@gmail.com','[]','$2y$13$igWnkJzNdZi3/6k.sZZ.IeIug6ODAU7H5.nhc0jQ.oyNmeV/oa8km',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(8,'Util_08@gmail.com','[]','$2y$13$0bai60bi4PMEJvyOKNrDt.gLUmFAUjyk.GV2l2YwsyLCp0rtXGnzm',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(9,'Util_09@gmail.com','[]','$2y$13$LF1WJdBFf0I4ithjeKHY4ez39bxxBK2g.Jb4CgJdboDR/efAJdA3S',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(10,'Util_10@gmail.com','[]','$2y$13$LrzNVfm3G.fkXXGSS80Nu.VCLWLdm3VprwAGCD20RhTBNhrrEPPJO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-06-06  8:17:29