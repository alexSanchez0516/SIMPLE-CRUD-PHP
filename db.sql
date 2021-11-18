CREATE DATABASE  IF NOT EXISTS `divisione_crud` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `divisione_crud`;
-- MySQL dump 10.13  Distrib 8.0.26, for macos11 (x86_64)
--
-- Host: 127.0.0.1    Database: divisione_crud
-- ------------------------------------------------------
-- Server version	5.7.36

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
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `tlf` int(11) NOT NULL,
  `email` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clients`
--

LOCK TABLES `clients` WRITE;
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service`
--

DROP TABLE IF EXISTS `service`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `service` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `serviceID` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_service` (`serviceID`),
  CONSTRAINT `fk_service` FOREIGN KEY (`serviceID`) REFERENCES `services` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service`
--

LOCK TABLES `service` WRITE;
/*!40000 ALTER TABLE `service` DISABLE KEYS */;
INSERT INTO `service` VALUES (1,11,'Posicionamiento SEO'),(2,11,'Posicionamiento SEM'),(3,11,'Analítica e informes'),(4,11,'Optimizacion web'),(5,4,'Diseño Coporativo'),(6,4,'Diseño de Banner'),(7,4,'Diseño de Sliders'),(8,6,'Desarrollo de API'),(9,6,'Consumo de API'),(10,7,'Scrapping de sitios web'),(11,7,'Automatización de tareas'),(12,7,'Beautiful Soup'),(17,10,'Resolución de errores Wordpress'),(18,10,'Optimización de aplicaciones web'),(19,10,'Compresión de Imágenes'),(20,10,'Anti Hack y Anti Spam'),(21,10,'Actualizaciones web'),(27,47,'Desarrollo Backend'),(28,47,'Desarrollo Fronted'),(29,47,'Django/React'),(30,47,'PHP Master');
/*!40000 ALTER TABLE `service` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `description` text NOT NULL,
  `price` int(5) NOT NULL,
  `imageProduct` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services`
--

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
INSERT INTO `services` VALUES (4,'Diseño de logos','Diseñamos tu identidad corporativa, la publicidad de tu negocio y el aspecto de tu web o de tus redes sociales. Tanto si acabas de comenzar con tu negocio, como si necesitas renovar y actualizar tu logotipo e identidad corporativa a los nuevos tiempos o quieres cambiar la imagen de tu página web o tienda online para adaptarla a nuevas campañas o temporadas. Imagen corporativa Logotipo y/o mascota corporativa. Tarjetas de visita. Vídeo promocional. Rediseño de marca. Packaging y papelería. Flyers y tripticos. Banners para sitios web.',122,'logos.webp'),(6,'API','Diseñamos tu identidad corporativa, la publicidad de tu negocio y el aspecto de tu web o de tus redes sociales. Tanto si acabas de comenzar con tu negocio, como si necesitas renovar y actualizar tu logotipo e identidad corporativa a los nuevos tiempos o quieres cambiar la imagen de tu página web o tienda online para adaptarla a nuevas campañas o temporadas. Imagen corporativa Logotipo y/o mascota corporativa. Tarjetas de visita. Vídeo promocional. Rediseño de marca. Packaging y papelería. Flyers y tripticos. Banners para sitios web.',50,'API.svg'),(7,'Scripting','Diseñamos tu identidad corporativa, la publicidad de tu negocio y el aspecto de tu web o de tus redes sociales. Tanto si acabas de comenzar con tu negocio, como si necesitas renovar y actualizar tu logotipo e identidad corporativa a los nuevos tiempos o quieres cambiar la imagen de tu página web o tienda online para adaptarla a nuevas campañas o temporadas. Imagen corporativa Logotipo y/o mascota corporativa. Tarjetas de visita. Vídeo promocional. Rediseño de marca. Packaging y papelería. Flyers y tripticos. Banners para sitios web.',50,'python.svg'),(10,'Soporte del sitio web','Diseñamos tu identidad corporativa, la publicidad de tu negocio y el aspecto de tu web o de tus redes sociales. Tanto si acabas de comenzar con tu negocio, como si necesitas renovar y actualizar tu logotipo e identidad corporativa a los nuevos tiempos o quieres cambiar la imagen de tu página web o tienda online para adaptarla a nuevas campañas o temporadas. Imagen corporativa Logotipo y/o mascota corporativa. Tarjetas de visita. Vídeo promocional. Rediseño de marca. Packaging y papelería. Flyers y tripticos. Banners para sitios web.',50,'Soporte.svg'),(11,'SEO','Diseñamos tu identidad corporativa, la publicidad de tu negocio y el aspecto de tu web o de tus redes sociales. Tanto si acabas de comenzar con tu negocio, como si necesitas renovar y actualizar tu logotipo e identidad corporativa a los nuevos tiempos o quieres cambiar la imagen de tu página web o tienda online para adaptarla a nuevas campañas o temporadas. Imagen corporativa Logotipo y/o mascota corporativa. Tarjetas de visita. Vídeo promocional. Rediseño de marca. Packaging y papelería. Flyers y tripticos. Banners para sitios web.',50,'seo.webp'),(47,'Desarrollo Web','Nos dedicamos a desarrollar webs',100,'wedesign.webp');
/*!40000 ALTER TABLE `services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(60) NOT NULL,
  `password` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'xymind','$2y$10$E3.nBXT5K3qdmIM9b85zmOiLRbgpTivgtl5ZbUdwS49IcR.G9Do7y','alexandervillegas0516@gmail.com'),(2,'admin','$2y$10$rvPeo8E5WcPvWIwOmOQcm.2gs1.9zzl.Ad0K.FMJtjsP7YZDpVUMC','alexandervillegas0516@gmail.com');
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

-- Dump completed on 2021-11-18 18:47:56
