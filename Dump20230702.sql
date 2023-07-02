-- MySQL dump 10.13  Distrib 8.0.32, for Win64 (x86_64)
--
-- Host: localhost    Database: web
-- ------------------------------------------------------
-- Server version	8.0.32

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
-- Dumping data for table `cows`
--

LOCK TABLES `cows` WRITE;
/*!40000 ALTER TABLE `cows` DISABLE KEYS */;
INSERT INTO `cows` VALUES (2,'DEF','Hereford','male',10,'no',150,12,'black','millk-bottle-1687123048.svg'),(3,'qwerty','asdfg','female',12,'no',122,12,'dnkmd','asset-2-1685325821-1686985819.svg'),(4,'Bella','Holstein','Female',4,'Yes',600,150,'Black and White','bella.jpg'),(5,'Max','Jersey','Male',2,'No',500,140,'Brown','max.jpg'),(6,'Luna','Holstein','Female',3,'Yes',550,145,'Black and White','luna.jpg'),(7,'Charlie','Angus','Male',5,'No',700,160,'Black','charlie.jpg'),(8,'Daisy','Holstein','Female',4,'Yes',600,150,'Black and White','daisy.jpg'),(9,'Rocky','Hereford','Male',3,'No',600,155,'Red and White','rocky.jpg'),(10,'Molly','Holstein','Female',2,'Yes',550,145,'Black and White','molly.jpg'),(11,'Cooper','Simmental','Male',4,'No',650,158,'Red and White','cooper.jpg'),(12,'Lucy','Holstein','Female',3,'Yes',600,150,'Black and White','lucy.jpg'),(13,'Oscar','Jersey','Male',2,'No',500,140,'Brown','oscar.jpg');
/*!40000 ALTER TABLE `cows` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `milk`
--

LOCK TABLES `milk` WRITE;
/*!40000 ALTER TABLE `milk` DISABLE KEYS */;
INSERT INTO `milk` VALUES (1,2,'2023-06-14',12,6),(2,3,'2023-06-07',10,5),(3,3,'2023-06-13',13,7),(4,3,'2023-06-23',17,9),(5,2,'2023-06-23',3,9),(6,3,'2023-06-14',17,9),(7,3,'2023-06-13',17,9),(8,2,'2023-06-27',15,9),(9,2,'2023-06-03',21,9),(10,2,'2023-06-05',20,9),(11,2,'2023-06-23',4,9),(12,3,'2023-06-03',4,9),(13,3,'2023-06-29',22,9),(14,3,'2023-06-26',4,9),(15,2,'2023-06-09',3,9),(16,2,'2023-06-24',10,9),(17,2,'2023-06-12',22,9),(18,2,'2023-06-11',21,9),(19,3,'2023-06-24',13,9),(20,3,'2023-06-16',6,9),(21,3,'2023-07-01',16,9),(22,2,'2023-06-29',13,9),(23,2,'2023-06-30',9,9),(24,3,'2023-06-13',15,9),(25,2,'2023-06-17',11,9),(26,3,'2023-06-29',12,9),(27,2,'2023-07-01',24,9),(28,3,'2023-06-07',18,9),(29,3,'2023-06-20',8,9),(30,2,'2023-06-08',2,9),(31,2,'2023-06-11',13,9),(32,3,'2023-06-29',0,9),(33,3,'2023-06-21',21,9),(34,3,'2023-07-03',100,10);
/*!40000 ALTER TABLE `milk` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (4,'Asad','asad@admin.com','e10adc3949ba59abbe56e057f20f883e','no','Admin','cool_image-1688118277.jfif'),(3,'Burger','a@a.com','25d55ad283aa400af464c76d713c07ad','yes','Doctor','cool_image-1687370780.jfif'),(5,'Asad','b@b.com','e10adc3949ba59abbe56e057f20f883e','yes','Admin','cool_image-1688202081.jfif'),(6,'aadda','c@c.com','202cb962ac59075b964b07152d234b70','no','adasd','certificate2-(1)_asad-nazir-1688202339.jpg');
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

-- Dump completed on 2023-07-02 22:50:23
