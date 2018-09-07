-- MySQL dump 10.13  Distrib 5.7.23, for osx10.13 (x86_64)
--
-- Host: localhost    Database: delivery
-- ------------------------------------------------------
-- Server version	5.7.23

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
-- Table structure for table `address`
--

DROP TABLE IF EXISTS `address`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zip` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D4E6F81F92F3E70` (`country_id`),
  CONSTRAINT `FK_D4E6F81F92F3E70` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=286 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `address`
--

LOCK TABLES `address` WRITE;
/*!40000 ALTER TABLE `address` DISABLE KEYS */;
INSERT INTO `address` VALUES (282,'Sergio López Rico','Sergio','López Rico','C/ Milan 31 9ºD','','Torrejon de Ardoz','28850','Madrid',1,'sergio.lopezr@edu.uah.es','628178737'),(283,'Sergio López Rico','Sergio','Rico','C/ Milan 31 9ºD','','Torrejon de Ardoz','28850','Madrid',1,'sergio.lopezr@edu.uah.es','62817837'),(284,'Sergio López Rico','Sergio','Rico','C/ Milan 31 9ºD','','Torrejon de Ardoz','28850','Madrid',1,'sergio.lopezr@edu.uah.es','523432'),(285,'Sergio López Rico','Sergio','Rico','C/ Milan 31 9ºD','','Torrejon de Ardoz','28850','Madrid',1,'sergio.lopezr@edu.uah.es','62323');
/*!40000 ALTER TABLE `address` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `country`
--

DROP TABLE IF EXISTS `country`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `country` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `invoice` tinyint(1) NOT NULL,
  `available_shipping` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `country`
--

LOCK TABLES `country` WRITE;
/*!40000 ALTER TABLE `country` DISABLE KEYS */;
INSERT INTO `country` VALUES (1,'ES','España',0,1),(2,'UK','Reino Unido',0,1),(3,'PT','Portugal',0,1),(4,'FR','Francia',0,1),(5,'DE','Alemania',0,1),(6,'IT','Italia',0,1),(7,'DK','Dinamarca',0,1),(8,'IE','Irlanda',0,1),(9,'NL','Holanda',0,1),(10,'AT','Austria',0,1),(11,'BE','Bélgica',0,1),(12,'US','Estados Unidos',0,1),(13,'CA','Canadá',0,1),(14,'PR','Puerto Rico',1,1),(15,'AU','Australia',1,1),(16,'LU','Luxemburgo',0,1),(17,'SG','Singapur',1,1),(18,'NZ','Nueva Zelanda',1,1);
/*!40000 ALTER TABLE `country` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migration_versions`
--

DROP TABLE IF EXISTS `migration_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migration_versions` (
  `version` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migration_versions`
--

LOCK TABLES `migration_versions` WRITE;
/*!40000 ALTER TABLE `migration_versions` DISABLE KEYS */;
INSERT INTO `migration_versions` VALUES ('20180905192459'),('20180905193128'),('20180905193812'),('20180906203116'),('20180906203214'),('20180906220133'),('20180906222514'),('20180907091652');
/*!40000 ALTER TABLE `migration_versions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `qaquestion`
--

DROP TABLE IF EXISTS `qaquestion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `qaquestion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `enable_comment` tinyint(1) NOT NULL,
  `enable_rating` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `qaquestion`
--

LOCK TABLES `qaquestion` WRITE;
/*!40000 ALTER TABLE `qaquestion` DISABLE KEYS */;
INSERT INTO `qaquestion` VALUES (1,'Satisfacción con fecha de entrega',0,1),(2,'¿Hubo algún problema en la entrega?',1,0),(3,'¿Alguna sugerencia?',1,0);
/*!40000 ALTER TABLE `qaquestion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `qareview`
--

DROP TABLE IF EXISTS `qareview`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `qareview` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` datetime NOT NULL,
  `shipment_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_E09829537BE036FC` (`shipment_id`),
  CONSTRAINT `FK_E09829537BE036FC` FOREIGN KEY (`shipment_id`) REFERENCES `shipment` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `qareview`
--

LOCK TABLES `qareview` WRITE;
/*!40000 ALTER TABLE `qareview` DISABLE KEYS */;
INSERT INTO `qareview` VALUES (26,'2018-09-07 12:53:32',32);
/*!40000 ALTER TABLE `qareview` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `qareview_answer`
--

DROP TABLE IF EXISTS `qareview_answer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `qareview_answer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `review_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `rating` int(11) DEFAULT NULL,
  `comment` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `IDX_2679279B3E2E969B` (`review_id`),
  KEY `IDX_2679279B1E27F6BF` (`question_id`),
  CONSTRAINT `FK_2679279B1E27F6BF` FOREIGN KEY (`question_id`) REFERENCES `qaquestion` (`id`),
  CONSTRAINT `FK_2679279B3E2E969B` FOREIGN KEY (`review_id`) REFERENCES `qareview` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `qareview_answer`
--

LOCK TABLES `qareview_answer` WRITE;
/*!40000 ALTER TABLE `qareview_answer` DISABLE KEYS */;
INSERT INTO `qareview_answer` VALUES (7,26,1,4,NULL),(8,26,2,NULL,'Ninguno'),(9,26,3,NULL,'Todo correcto');
/*!40000 ALTER TABLE `qareview_answer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shipment`
--

DROP TABLE IF EXISTS `shipment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shipment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_ref` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tracking_num` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `label_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ship_to_addr_id` int(11) NOT NULL,
  `delivery_instructions` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `est_delivery_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_2CB20DC43427FD5` (`ship_to_addr_id`),
  CONSTRAINT `FK_F5299398EBF23851` FOREIGN KEY (`ship_to_addr_id`) REFERENCES `address` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shipment`
--

LOCK TABLES `shipment` WRITE;
/*!40000 ALTER TABLE `shipment` DISABLE KEYS */;
INSERT INTO `shipment` VALUES (30,'P0001','D4aB2Uhuvj','fake_label.jpg',283,'','2018-09-07 12:48:53','2018-09-13 12:52:47'),(31,'P002','EadLzp26Zk','fake_label.jpg',284,'','2018-09-07 12:49:54','2018-09-14 12:49:54'),(32,'P0003','njFePQgygr','fake_label.jpg',285,'','2018-09-07 12:51:24','2018-09-09 12:52:48');
/*!40000 ALTER TABLE `shipment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `status`
--

DROP TABLE IF EXISTS `status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status_group_id` int(11) DEFAULT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_7B00651C638E7E9F` (`status_group_id`),
  CONSTRAINT `FK_7B00651C638E7E9F` FOREIGN KEY (`status_group_id`) REFERENCES `status_group` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status`
--

LOCK TABLES `status` WRITE;
/*!40000 ALTER TABLE `status` DISABLE KEYS */;
INSERT INTO `status` VALUES (7,5,'000','Status Not Available'),(8,3,'003','Order Processed: Ready for UPS'),(9,2,'005','In Transit'),(10,2,'006','On Vehicle for Delivery'),(11,2,'007','Shipment Information Voided'),(12,2,'010','In Transit: On Time'),(13,7,'011','Delivered'),(14,3,'012','Clearance in Progress'),(15,5,'013','Exception'),(16,2,'014','Clearance Completed'),(17,5,'016','Held in Warehouse'),(18,5,'017','Held for Customer Pickup'),(19,5,'018','Delivery Change Requested: Hold for Pickup'),(20,5,'019','Held for Future Delivery'),(21,5,'020','Held for Future Delivery Requested'),(22,2,'021','On Vehicle for Delivery Today'),(23,5,'022','First Attempt Made'),(24,5,'023','Second Attempt Made'),(25,5,'024','Final Attempt Made'),(26,5,'025','Transferred to Local Post Office for Delivery'),(27,5,'026','Delivered by Local Post Office'),(28,5,'027','Delivery Address Change Requested'),(29,5,'028','Delivery Address Changed'),(30,5,'029','Exception: Action Required'),(31,5,'030','Local Post Office Exception'),(32,5,'032','Adverse Weather May Cause Delay'),(33,6,'033','Return to Sender Requested'),(34,6,'034','Returned to Sender'),(35,6,'035','Returning to Sender'),(36,6,'036','Returning to Sender: In Transit'),(37,6,'037','Returning to Sender: On Vehicle for Delivery'),(38,7,'038','Picked Up'),(39,2,'039','In Transit by Post Office'),(40,5,'040','Delivered to UPS Access Point Awaiting Customer Pickup'),(41,5,'041','Service Upgrade Requested'),(42,5,'042','Service Upgraded'),(43,NULL,'043','Voided Pickup'),(44,2,'044','In Transit to UPS'),(45,3,'045','Order Processed: In Transit to UPS'),(46,5,'046','Delay'),(47,5,'047','Delay'),(48,5,'048','Delay'),(49,5,'049','Delay: Action Required'),(50,5,'050','Address Information Required'),(51,5,'051','Delay: Emergency Situation or Severe Weather'),(52,5,'052','Delay: Severe Weather'),(53,5,'053','Delay: Severe Weather, Recovery in Progress'),(54,5,'054','Delivery Change Requested'),(55,5,'055','Rescheduled Delivery'),(56,5,'056','Service Upgrade Requested'),(57,2,'057','In Transit to a UPS Access Point'),(58,5,'058','Clearance Information Required'),(59,5,'059','Damage Reported'),(60,5,'060','Delivery Attempted'),(61,5,'061','Delivery Attempted: Adult Signature Required'),(62,5,'062','Delivery Attempted: Funds Required'),(63,7,'063','Delivery Change Completed'),(64,5,'064','Delivery Refused'),(65,5,'065','Pickup Attempted'),(66,5,'066','Post Office Delivery Attempted'),(67,6,'067','Returned to Sender by Post Office'),(68,6,'068','Sent to Lost and Found'),(69,5,'069','Package Not Claimed'),(70,6,'068','Sent to Lost and Found '),(71,5,'069','Package Not Claimed ');
/*!40000 ALTER TABLE `status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `status_group`
--

DROP TABLE IF EXISTS `status_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `status_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(7) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status_group`
--

LOCK TABLES `status_group` WRITE;
/*!40000 ALTER TABLE `status_group` DISABLE KEYS */;
INSERT INTO `status_group` VALUES (2,'transit','En tránsito','','fa-truck'),(3,'process','En proceso','','fa-tasks'),(5,'alert','Alerta','danger','fa-exclamation-triangle'),(6,'returned','Devuelto','','fa-undo'),(7,'delivered','Entregado','success','fa-check');
/*!40000 ALTER TABLE `status_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `status_update`
--

DROP TABLE IF EXISTS `status_update`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `status_update` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status_id` int(11) NOT NULL,
  `shipment_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `IDX_256F9D356BF700BD` (`status_id`),
  KEY `IDX_256F9D357BE036FC` (`shipment_id`),
  CONSTRAINT `FK_256F9D356BF700BD` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`),
  CONSTRAINT `FK_256F9D357BE036FC` FOREIGN KEY (`shipment_id`) REFERENCES `shipment` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=224 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status_update`
--

LOCK TABLES `status_update` WRITE;
/*!40000 ALTER TABLE `status_update` DISABLE KEYS */;
INSERT INTO `status_update` VALUES (219,21,30,'2018-09-07 12:48:53'),(220,13,31,'2018-09-07 12:49:54'),(221,14,32,'2018-09-07 12:51:24'),(222,60,30,'2018-09-07 12:52:47'),(223,64,32,'2018-09-07 12:52:48');
/*!40000 ALTER TABLE `status_update` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `vw_actual_statuses`
--

DROP TABLE IF EXISTS `vw_actual_statuses`;
/*!50001 DROP VIEW IF EXISTS `vw_actual_statuses`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `vw_actual_statuses` AS SELECT 
 1 AS `id`,
 1 AS `status_group_id`,
 1 AS `code`,
 1 AS `name`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `vw_shipment_hdr`
--

DROP TABLE IF EXISTS `vw_shipment_hdr`;
/*!50001 DROP VIEW IF EXISTS `vw_shipment_hdr`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `vw_shipment_hdr` AS SELECT 
 1 AS `id`,
 1 AS `order_ref`,
 1 AS `status_id`,
 1 AS `status_code`,
 1 AS `status_name`,
 1 AS `status_group_id`,
 1 AS `status_group_code`,
 1 AS `status_group_name`,
 1 AS `status_group_color`,
 1 AS `created_at`*/;
SET character_set_client = @saved_cs_client;

--
-- Final view structure for view `vw_actual_statuses`
--

/*!50001 DROP VIEW IF EXISTS `vw_actual_statuses`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_actual_statuses` AS select distinct `s`.`id` AS `id`,`s`.`status_group_id` AS `status_group_id`,`s`.`code` AS `code`,`s`.`name` AS `name` from ((`shipment` `sh` join `status_update` `su`) join `status` `s`) where ((`su`.`shipment_id` = `sh`.`id`) and (`su`.`status_id` = `s`.`id`) and (`su`.`created_at` = (select max(`su2`.`created_at`) from `status_update` `su2` where (`su2`.`shipment_id` = `su`.`shipment_id`)))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_shipment_hdr`
--

/*!50001 DROP VIEW IF EXISTS `vw_shipment_hdr`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_shipment_hdr` AS select `sh`.`id` AS `id`,`sh`.`order_ref` AS `order_ref`,`s`.`id` AS `status_id`,`s`.`name` AS `status_code`,`s`.`name` AS `status_name`,`s`.`status_group_id` AS `status_group_id`,`sg`.`code` AS `status_group_code`,`sg`.`name` AS `status_group_name`,`sg`.`color` AS `status_group_color`,`su`.`created_at` AS `created_at` from (((`shipment` `sh` join `status` `s`) join `status_update` `su`) join `status_group` `sg`) where ((`su`.`shipment_id` = `sh`.`id`) and (`s`.`status_group_id` = `sg`.`id`) and (`su`.`status_id` = `s`.`id`) and (`su`.`created_at` = (select max(`su2`.`created_at`) from `status_update` `su2` where (`su2`.`shipment_id` = `su`.`shipment_id`)))) union select `sh`.`id` AS `id`,`sh`.`order_ref` AS `order_ref`,NULL AS `NULL`,NULL AS `NULL`,NULL AS `NULL`,NULL AS `NULL`,NULL AS `NULL`,NULL AS `NULL`,NULL AS `NULL`,`sh`.`created_at` AS `created_at` from `shipment` `sh` where (not(exists(select `su`.`id` from `status_update` `su` where (`su`.`shipment_id` = `sh`.`id`)))) order by `created_at` desc */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-09-07 14:56:47
