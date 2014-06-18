-- MySQL dump 10.13  Distrib 5.5.31, for debian-linux-gnu (i686)
--
-- Host: localhost    Database: mbc
-- ------------------------------------------------------
-- Server version	5.5.31-0ubuntu0.12.04.1

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
-- Table structure for table `element_function_pairs`
--

DROP TABLE IF EXISTS `element_function_pairs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `element_function_pairs` (
  `element_id` mediumint(9) NOT NULL,
  `function_id` mediumint(9) DEFAULT NULL,
  PRIMARY KEY (`element_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `element_function_pairs`
--

LOCK TABLES `element_function_pairs` WRITE;
/*!40000 ALTER TABLE `element_function_pairs` DISABLE KEYS */;
INSERT INTO `element_function_pairs` VALUES (16,2),(17,2),(18,2),(19,3),(20,2),(21,2),(22,2),(23,4),(24,4),(41,6),(42,6),(44,6),(46,6);
/*!40000 ALTER TABLE `element_function_pairs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `element_functions`
--

DROP TABLE IF EXISTS `element_functions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `element_functions` (
  `function_id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `function_name` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`function_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `element_functions`
--

LOCK TABLES `element_functions` WRITE;
/*!40000 ALTER TABLE `element_functions` DISABLE KEYS */;
INSERT INTO `element_functions` VALUES (1,'get_image_name'),(2,'return_image'),(3,'sidebar_calendar'),(4,'p_print_contents'),(5,'return_fadein_image'),(6,'fadein_image'),(7,'return_image_by_src');
/*!40000 ALTER TABLE `element_functions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `element_value_pairs`
--

DROP TABLE IF EXISTS `element_value_pairs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `element_value_pairs` (
  `element_id` mediumint(9) DEFAULT NULL,
  `value_id` mediumint(9) DEFAULT NULL,
  UNIQUE KEY `element_id` (`element_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `element_value_pairs`
--

LOCK TABLES `element_value_pairs` WRITE;
/*!40000 ALTER TABLE `element_value_pairs` DISABLE KEYS */;
INSERT INTO `element_value_pairs` VALUES (1,1),(3,2),(4,3),(5,4),(6,5),(7,1),(8,2),(9,3),(10,4),(11,5),(12,6),(13,7),(14,8),(15,9),(16,10),(17,11),(18,12),(19,13),(20,14),(21,15),(22,16),(23,17),(24,18),(41,32),(42,39),(44,40),(46,25);
/*!40000 ALTER TABLE `element_value_pairs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `element_values`
--

DROP TABLE IF EXISTS `element_values`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `element_values` (
  `value_id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `value_contents` text,
  PRIMARY KEY (`value_id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `element_values`
--

LOCK TABLES `element_values` WRITE;
/*!40000 ALTER TABLE `element_values` DISABLE KEYS */;
INSERT INTO `element_values` VALUES (1,'$35/lane/hour'),(2,'$45/lane/hour'),(3,'$55/lane/hour'),(4,'$4 per person'),(5,'$4 per pair'),(6,'With six available lanes, reservations are highly recommended. With the exception of our private events, MBC with always allow advanced reservation for up to three lanes, as well as keep three lanes open for walk-in guests. Lanes can be booked 24 hours up to 7 days in advance through our online reservation system, and up to three weeks in advance through our Events & Parties submissions'),(7,'MBC welcomes guests of all ages to bowl with us on Saturday and Sundays from 11am-7pm. We are 21+ during all other times. We require children fit into a size 12 shoe or higher and have the ability to carry a 6 lb. ball to be on the lanes. Our children’s bowling shoes start at size 12/1. All children under the age of 16 need to be accompanied by a responsible adult.'),(8,'And here is the answer'),(9,'And here is the answer'),(10,'left-mini-menu'),(11,'advertisement'),(12,'right-mini-menu'),(13,''),(14,'dinner-menu'),(15,'brunch-menu'),(16,'drinks-menu'),(17,'3176 17th St (@ S. Van Ness)|San Francisco, CA 94110|415.863.BOWL (2695)'),(18,'Under 21: Weekends 11-7pm|Monday-Wednesday: 3pm-11pm|Thursday & Friday: 3pm-Midnight|Saturday: 11am-Midnight|Sunday: 11am-11pm'),(19,'dinner-image-1'),(20,'dinner-image-2'),(21,'dinner-image-3'),(22,'logo_t.png'),(23,'MBE-1.jpg'),(24,'MBE-2.jpg'),(25,'MBE-3.jpg'),(26,'MBE-4.jpg'),(27,'MBH-1.jpg'),(28,'MBH-2.jpg'),(29,'MBH-3.jpg'),(30,'MBH-6.jpg'),(31,'MBS-1.jpg'),(32,'MBS-2.jpg'),(33,'MBS-3.jpg'),(34,'MBS-4.jpg'),(35,'MBS-5.jpg'),(36,'MBS-6.jpg'),(37,'MBS-7.jpg'),(38,'MBS-8.jpg'),(39,'DBD-1.jpg'),(40,'DBD-2.jpg'),(41,'DBD-3.jpg');
/*!40000 ALTER TABLE `element_values` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `elements`
--

DROP TABLE IF EXISTS `elements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `elements` (
  `element_id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `set_element_id` mediumint(9) NOT NULL,
  PRIMARY KEY (`element_id`),
  UNIQUE KEY `set_element_id` (`set_element_id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `elements`
--

LOCK TABLES `elements` WRITE;
/*!40000 ALTER TABLE `elements` DISABLE KEYS */;
INSERT INTO `elements` VALUES (1,16),(3,17),(4,18),(5,19),(6,20),(7,21),(8,22),(9,23),(10,24),(11,25),(12,26),(13,27),(14,28),(15,39),(16,41),(17,42),(18,43),(19,44),(20,45),(21,46),(22,47),(23,48),(24,52),(41,71),(42,73),(44,75),(46,78);
/*!40000 ALTER TABLE `elements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `food_images`
--

DROP TABLE IF EXISTS `food_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `food_images` (
  `id` int(11) DEFAULT NULL,
  `class` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `food_images`
--

LOCK TABLES `food_images` WRITE;
/*!40000 ALTER TABLE `food_images` DISABLE KEYS */;
/*!40000 ALTER TABLE `food_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `globals`
--

DROP TABLE IF EXISTS `globals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `globals` (
  `variable` varchar(32) DEFAULT NULL,
  `value` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `globals`
--

LOCK TABLES `globals` WRITE;
/*!40000 ALTER TABLE `globals` DISABLE KEYS */;
INSERT INTO `globals` VALUES ('slider_background_fadein','3000'),('slider_background_delay','5000'),('street_address','3176 17th ST (@ S. Van Ness)'),('city','San Francisco'),('state','CA'),('zip_code','94110'),('phone_number','415.863.BOWL (2695)');
/*!40000 ALTER TABLE `globals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `images`
--

LOCK TABLES `images` WRITE;
/*!40000 ALTER TABLE `images` DISABLE KEYS */;
INSERT INTO `images` VALUES (47,'DBD-1.jpg'),(48,'DBD-2.jpg'),(49,'DBD-3.jpg'),(46,'logo_t.png'),(42,'MBE-1.jpg'),(43,'MBE-2.jpg'),(44,'MBE-3.jpg'),(45,'MBE-4.jpg'),(29,'MBH-1.jpg'),(30,'MBH-2.jpg'),(31,'MBH-3.jpg'),(32,'MBH-6.jpg'),(35,'MBS-1.jpg'),(36,'MBS-2.jpg'),(37,'MBS-3.jpg'),(38,'MBS-4.jpg'),(39,'MBS-5.jpg'),(33,'MBS-6.jpg'),(41,'MBS-7.jpg'),(34,'MBS-8.jpg');
/*!40000 ALTER TABLE `images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inclusions`
--

DROP TABLE IF EXISTS `inclusions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inclusions` (
  `set_id` mediumint(9) DEFAULT NULL,
  `set_element_id` mediumint(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inclusions`
--

LOCK TABLES `inclusions` WRITE;
/*!40000 ALTER TABLE `inclusions` DISABLE KEYS */;
INSERT INTO `inclusions` VALUES (1,2),(2,3),(2,4),(2,5),(2,6),(2,7),(2,8),(2,9),(3,10),(10,11),(10,12),(10,13),(12,14),(12,15),(14,16),(14,17),(14,18),(14,19),(14,20),(15,21),(15,22),(15,23),(15,24),(11,27),(13,28),(29,30),(29,31),(29,32),(29,33),(29,34),(29,35),(29,36),(37,30),(37,32),(37,33),(38,31),(38,34),(13,39),(40,41),(40,42),(40,43),(40,44),(4,45),(5,46),(7,47),(49,50),(49,51),(49,48),(49,52),(70,71),(72,73),(53,75),(53,78),(1,79),(79,49);
/*!40000 ALTER TABLE `inclusions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `links`
--

DROP TABLE IF EXISTS `links`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `links` (
  `place` int(11) NOT NULL,
  `object` int(11) DEFAULT NULL,
  PRIMARY KEY (`place`),
  UNIQUE KEY `place` (`place`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `links`
--

LOCK TABLES `links` WRITE;
/*!40000 ALTER TABLE `links` DISABLE KEYS */;
INSERT INTO `links` VALUES (2,46),(4,42),(5,29),(6,35),(7,33),(9,30),(10,42),(11,43),(12,44),(13,45),(14,43),(15,42),(18,35),(22,45),(24,36),(34,38),(37,46),(38,36),(39,47),(41,48),(43,44);
/*!40000 ALTER TABLE `links` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pairs`
--

DROP TABLE IF EXISTS `pairs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pairs` (
  `key_id` mediumint(9) NOT NULL,
  `value` mediumint(9) DEFAULT NULL,
  PRIMARY KEY (`key_id`),
  UNIQUE KEY `key_id` (`key_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pairs`
--

LOCK TABLES `pairs` WRITE;
/*!40000 ALTER TABLE `pairs` DISABLE KEYS */;
/*!40000 ALTER TABLE `pairs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `places`
--

DROP TABLE IF EXISTS `places`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `places` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `places`
--

LOCK TABLES `places` WRITE;
/*!40000 ALTER TABLE `places` DISABLE KEYS */;
INSERT INTO `places` VALUES (2,'logo'),(4,'dinner-menu'),(5,'brunch-menu'),(6,'drinks-menu'),(7,'background'),(9,'advertisement'),(10,'event-buyouts'),(11,'event-birthdays'),(12,'event-dining'),(13,'event-bowling'),(14,'left-mini-menu'),(15,'right-mini-menu'),(38,'drink-image-1'),(39,'brunch-image-1'),(41,'dinner-image-1'),(43,'dinner-image-2');
/*!40000 ALTER TABLE `places` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts` (
  `title` varchar(32) DEFAULT NULL,
  `content` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES ('reservations','With six available lanes, reservations are highly recommended. With the exception of our private events, MBC with always allow advanced reservation for up to three lanes, as well as keep three lanes open for walk-in guests. Lanes can be booked 24 hours up to 7 days in advance through our online reservation system, and up to three weeks in advance through our Events & Parties submissions'),('Family Bowl','MBC welcomes guests of all ages to bowl with us on Saturday and Sundays from 11am-7pm. We are 21+ during all other times. We require children fit into a size 12 shoe or higher and have the ability to carry a 6 lb. ball to be on the lanes. Our children’s bowling shoes start at size 12/1. All children under the age of 16 need to be accompanied by a responsible adult.');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `regions`
--

DROP TABLE IF EXISTS `regions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `regions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `regions`
--

LOCK TABLES `regions` WRITE;
/*!40000 ALTER TABLE `regions` DISABLE KEYS */;
INSERT INTO `regions` VALUES (1,'dinner-images'),(2,'drinks-images'),(3,'brunch-images');
/*!40000 ALTER TABLE `regions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `set_function_pairs`
--

DROP TABLE IF EXISTS `set_function_pairs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `set_function_pairs` (
  `set_id` mediumint(9) NOT NULL,
  `function_id` mediumint(9) NOT NULL,
  PRIMARY KEY (`set_id`),
  UNIQUE KEY `function_id` (`function_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `set_function_pairs`
--

LOCK TABLES `set_function_pairs` WRITE;
/*!40000 ALTER TABLE `set_function_pairs` DISABLE KEYS */;
INSERT INTO `set_function_pairs` VALUES (53,6);
/*!40000 ALTER TABLE `set_function_pairs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `set_titles`
--

DROP TABLE IF EXISTS `set_titles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `set_titles` (
  `set_id` mediumint(9) DEFAULT NULL,
  `set_title` varchar(64) DEFAULT NULL,
  UNIQUE KEY `set_id` (`set_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `set_titles`
--

LOCK TABLES `set_titles` WRITE;
/*!40000 ALTER TABLE `set_titles` DISABLE KEYS */;
INSERT INTO `set_titles` VALUES (16,'Before 6pm'),(17,'After 6pm'),(18,'After 8pm'),(19,'Shoe Rental'),(20,'Socks'),(21,'Before 2pm'),(22,'Between 2pm-8pm'),(23,'After 8pm'),(24,'Shoe Rental'),(25,'Socks'),(14,'Weekday Bowling Rates'),(15,'Weekend Bowling Rates'),(12,'Pricing'),(11,'Information'),(26,'Reservations'),(27,'Family Bowl'),(3,'Bowling'),(4,'Dinner'),(5,'Drinks'),(6,'Brunch'),(7,'Calendar'),(8,'Plan an Event'),(9,'About MBC'),(2,'Pages'),(10,'Bowling Details'),(1,'Mission Bowling Club'),(13,'FAQ'),(28,'This is where Question 1 goes'),(31,'Inclusions'),(30,'Sets'),(34,'Element value pairs'),(39,'This is where Question 2 goes'),(45,'The Dining Room at MBC'),(46,'Brunch'),(47,'Drinks'),(79,'Site Components'),(49,'Header'),(50,'Header Menu'),(48,'Logistical Information'),(51,'Header Logo'),(52,'Hours');
/*!40000 ALTER TABLE `set_titles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `set_types`
--

DROP TABLE IF EXISTS `set_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `set_types` (
  `set_id` mediumint(9) NOT NULL,
  `set_type` tinyint(1) DEFAULT NULL,
  UNIQUE KEY `set_id` (`set_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `set_types`
--

LOCK TABLES `set_types` WRITE;
/*!40000 ALTER TABLE `set_types` DISABLE KEYS */;
INSERT INTO `set_types` VALUES (1,0),(2,0),(3,0),(4,0),(5,0),(6,1),(7,0),(8,1),(9,1),(10,0),(11,0),(12,0),(13,0),(14,0),(15,0),(16,1),(17,1),(18,1),(19,1),(20,1),(21,1),(22,1),(23,1),(24,1),(25,1),(26,1),(27,1),(28,1),(29,0),(30,1),(31,1),(32,1),(33,1),(34,1),(35,1),(36,1),(37,0),(38,0),(39,1),(40,0),(41,1),(42,1),(43,1),(44,1),(45,1),(46,1),(47,1),(48,1),(49,0),(50,1),(51,1),(52,1),(53,0),(54,1),(55,1),(56,1),(70,0),(71,1),(72,0),(73,1),(75,1),(76,1),(78,1),(79,0),(80,0),(81,1);
/*!40000 ALTER TABLE `set_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sets`
--

DROP TABLE IF EXISTS `sets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sets` (
  `set_id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `set_name` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`set_id`)
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sets`
--

LOCK TABLES `sets` WRITE;
/*!40000 ALTER TABLE `sets` DISABLE KEYS */;
INSERT INTO `sets` VALUES (1,'site'),(2,'pages'),(3,'bowling'),(4,'dinner'),(5,'drinks'),(6,'brunch'),(7,'calendar'),(8,'event'),(9,'about'),(10,'bowling-details'),(11,'information_tab'),(12,'pricing-tab'),(13,'faq-tab'),(14,'weekday-bowling-rates'),(15,'weekend-bowling-rates'),(16,'before_6pm_weekday'),(17,'after_6pm_weekday'),(18,'after_8pm_weekday'),(19,'shoe_rental_weekday'),(20,'socks_weekday'),(21,'before_2pm_weekend'),(22,'twopm-eightpm_weekend'),(23,'after_8pm_weekend'),(24,'shoe_rental_weekend'),(25,'socks_weekend'),(26,'information-tab-reservations'),(27,'information-tab-family-bowl'),(28,'faq-question-1'),(29,'set-tables'),(30,'sets'),(31,'inclusions'),(32,'elements'),(33,'element_values'),(34,'element_value_pairs'),(35,'set_titles'),(36,'set_types'),(37,'index-tables'),(38,'pair-tables'),(39,'faq-question-2'),(40,'sidebar-block'),(41,'sidebar-left-menu-image'),(42,'sidebar-bottom-advertisement-ima'),(43,'sidebar-right-menu-image'),(44,'sidebar-calendar'),(45,'dinner-menu'),(46,'brunch-menu'),(47,'drinks-menu'),(48,'logistical-information'),(49,'header'),(50,'header-menu'),(51,'header-logo'),(52,'hours'),(53,'dinner-images'),(70,'drinks-images'),(71,'drink-image-1'),(72,'brunch-images'),(73,'brunch-image-1'),(75,'dinner-image-1'),(78,'dinner-image-2'),(79,'components');
/*!40000 ALTER TABLE `sets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `slider`
--

DROP TABLE IF EXISTS `slider`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `slider` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) DEFAULT NULL,
  `placement` int(11) DEFAULT NULL,
  `period` int(11) DEFAULT '1000',
  `fadein` int(11) DEFAULT '0',
  `fadeout` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `placement` (`placement`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `slider`
--

LOCK TABLES `slider` WRITE;
/*!40000 ALTER TABLE `slider` DISABLE KEYS */;
INSERT INTO `slider` VALUES (1,'MBS-8.jpg',2,4000,1000,1000),(2,'MBS-1.jpg',3,2500,0,0),(3,'MBS-2.jpg',5,1000,0,0),(4,'MBS-3.jpg',4,1000,0,0),(5,'MBS-5.jpg',6,1000,0,0),(6,'MBS-7.jpg',1,1000,0,0),(7,'MBS-8.jpg',7,1000,0,0);
/*!40000 ALTER TABLE `slider` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-11-10  9:35:29
