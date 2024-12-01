-- MySQL dump 10.13  Distrib 8.0.38, for Win64 (x86_64)
--
-- Host: localhost    Database: autotunedb
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

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
-- Table structure for table `auditlogs`
--

DROP TABLE IF EXISTS `auditlogs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `auditlogs` (
  `LogID` int(11) NOT NULL AUTO_INCREMENT,
  `UserID` int(11) DEFAULT NULL,
  `ActionTaken` varchar(255) DEFAULT NULL,
  `ActionDetails` text DEFAULT NULL,
  `IP_Address` varchar(45) DEFAULT NULL,
  `Timestamp` datetime DEFAULT current_timestamp(),
  `Status` enum('Success','Failure') DEFAULT NULL,
  PRIMARY KEY (`LogID`),
  KEY `UserID` (`UserID`),
  CONSTRAINT `auditlogs_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `userprofiles` (`UserID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auditlogs`
--

LOCK TABLES `auditlogs` WRITE;
/*!40000 ALTER TABLE `auditlogs` DISABLE KEYS */;
/*!40000 ALTER TABLE `auditlogs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `authtokens`
--

DROP TABLE IF EXISTS `authtokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `authtokens` (
  `TokenID` int(11) NOT NULL AUTO_INCREMENT,
  `UserID` int(11) DEFAULT NULL,
  `Token` varchar(255) DEFAULT NULL,
  `ExpiryDate` datetime DEFAULT NULL,
  PRIMARY KEY (`TokenID`),
  KEY `UserID` (`UserID`),
  CONSTRAINT `authtokens_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `userprofiles` (`UserID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `authtokens`
--

LOCK TABLES `authtokens` WRITE;
/*!40000 ALTER TABLE `authtokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `authtokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `diagnosticstuning`
--

DROP TABLE IF EXISTS `diagnosticstuning`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `diagnosticstuning` (
  `DiagnosticID` int(11) NOT NULL AUTO_INCREMENT,
  `VehicleID` int(11) DEFAULT NULL,
  `DiagnosticData` text DEFAULT NULL,
  `TuningParameters` text DEFAULT NULL,
  `Date` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`DiagnosticID`),
  KEY `VehicleID` (`VehicleID`),
  CONSTRAINT `diagnosticstuning_ibfk_1` FOREIGN KEY (`VehicleID`) REFERENCES `uservehicle` (`VehicleID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `diagnosticstuning`
--

LOCK TABLES `diagnosticstuning` WRITE;
/*!40000 ALTER TABLE `diagnosticstuning` DISABLE KEYS */;
/*!40000 ALTER TABLE `diagnosticstuning` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `RoleID` int(11) NOT NULL AUTO_INCREMENT,
  `RoleDescription` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`RoleID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `servicemaintenance`
--

DROP TABLE IF EXISTS `servicemaintenance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `servicemaintenance` (
  `ServiceID` int(11) NOT NULL AUTO_INCREMENT,
  `VehicleID` int(11) DEFAULT NULL,
  `ServiceType` varchar(100) DEFAULT NULL,
  `ServiceProvider` varchar(255) DEFAULT NULL,
  `ServiceDate` datetime DEFAULT NULL,
  `Cost` decimal(10,2) DEFAULT NULL,
  `NextMaintenanceDate` datetime DEFAULT NULL,
  `Comments` text DEFAULT NULL,
  PRIMARY KEY (`ServiceID`),
  KEY `idx_userid_servicemaintenance` (`VehicleID`),
  CONSTRAINT `servicemaintenance_ibfk_1` FOREIGN KEY (`VehicleID`) REFERENCES `uservehicle` (`VehicleID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servicemaintenance`
--

LOCK TABLES `servicemaintenance` WRITE;
/*!40000 ALTER TABLE `servicemaintenance` DISABLE KEYS */;
/*!40000 ALTER TABLE `servicemaintenance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userprofiles`
--

DROP TABLE IF EXISTS `userprofiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `userprofiles` (
  `UserID` int(11) NOT NULL AUTO_INCREMENT,
  `FullName` varchar(255) DEFAULT NULL,
  `Username` varchar(255) NOT NULL,
  `HashedPassword` varchar(255) NOT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `RegistrationDate` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`UserID`),
  KEY `idx_userid_userprofiles` (`UserID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userprofiles`
--

LOCK TABLES `userprofiles` WRITE;
/*!40000 ALTER TABLE `userprofiles` DISABLE KEYS */;
INSERT INTO `userprofiles` VALUES (1,'','','$2y$10$.w5cO1BDDKUGuHnznW8mvuGNrZqZ2GILHD4gZONk6lLVy0PtEVt12','tmack1@gmail.com','2024-11-08 21:40:37'),(2,'','','$2y$10$nNz3zqpJj/.xMv52U3aC1eePRXLzUGAVpnR9ma3Pw9ZXBo4ldWeQe','tmack1@gmail.com','2024-11-08 21:42:14'),(3,'','','$2y$10$j1K9hf.lkRo7tgRhXJbp.u2R6kMv0bUZDMuw14vsqmOr5z1Ex6f2G','tmack1@gmail.com','2024-11-08 21:44:10'),(4,'TiaraM','mainaccount','$2y$10$ZvsPJPP1nu9P8qB5AkdaS.5Jz/sdaFmZTa.P.odNodV.1ZWM4h0b6','tmack1@gmail.com','2024-11-08 21:47:00'),(5,'Nyia','problemchild','$2y$10$Jt/BlEhxOc.lRuUXsxS9KubXqwJFo5rP.8ps2OBxaOJVPVsHGSfAG','nyiaw101@yahoo.com','2024-11-10 17:14:01'),(6,'Blanca','blanca123','$2y$10$rm1vXGbSlhfLd2zfig.TNOUz79R8s488PsTFTvTXag.iUwEtxM7Gq','blanca123@gmail.com','2024-11-21 16:49:56'),(7,'AlexM','alexthegoat','$2y$10$j22uFTdiEPo9dquihaHzMurmtjJ1Ap0THECqqwamY2XSQFbA/Y.c.','alex123@gmail.com','2024-11-21 17:34:41'),(8,'FirstTest','justdoingatest','$2y$10$iiFKCU12.3594Q9297yvyOCpmMGgDbUlV07NOm/Kq11f3L8ZjcHQi','tester.data1@outlook.com','2024-11-21 18:43:31'),(9,'TSmack','testing1234','$2y$10$9y7yLBH3OsoZDPy6Jx/UIO1m6Avjm5fYsmT1QvQYrbWGpOwwYYWea','tmack101@gmail.com','2024-11-21 19:16:30');
/*!40000 ALTER TABLE `userprofiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userroles`
--

DROP TABLE IF EXISTS `userroles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `userroles` (
  `UserRoleID` int(11) NOT NULL AUTO_INCREMENT,
  `UserID` int(11) DEFAULT NULL,
  `RoleID` int(11) DEFAULT NULL,
  PRIMARY KEY (`UserRoleID`),
  KEY `UserID` (`UserID`),
  KEY `RoleID` (`RoleID`),
  CONSTRAINT `userroles_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `userprofiles` (`UserID`) ON DELETE CASCADE,
  CONSTRAINT `userroles_ibfk_2` FOREIGN KEY (`RoleID`) REFERENCES `roles` (`RoleID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userroles`
--

LOCK TABLES `userroles` WRITE;
/*!40000 ALTER TABLE `userroles` DISABLE KEYS */;
/*!40000 ALTER TABLE `userroles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usersettings`
--

DROP TABLE IF EXISTS `usersettings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usersettings` (
  `SettingID` int(11) NOT NULL AUTO_INCREMENT,
  `UserID` int(11) DEFAULT NULL,
  `SettingName` varchar(255) DEFAULT NULL,
  `SettingValue` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`SettingID`),
  KEY `UserID` (`UserID`),
  CONSTRAINT `usersettings_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `userprofiles` (`UserID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usersettings`
--

LOCK TABLES `usersettings` WRITE;
/*!40000 ALTER TABLE `usersettings` DISABLE KEYS */;
/*!40000 ALTER TABLE `usersettings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uservehicle`
--

DROP TABLE IF EXISTS `uservehicle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `uservehicle` (
  `VehicleID` int(11) NOT NULL AUTO_INCREMENT,
  `UserID` int(11) DEFAULT NULL,
  `Make` varchar(50) DEFAULT NULL,
  `Model` varchar(50) DEFAULT NULL,
  `Year` int(11) DEFAULT NULL,
  `VIN` varchar(50) DEFAULT NULL,
  `Mileage` int(11) DEFAULT NULL,
  `FuelConsumption` decimal(10,2) DEFAULT NULL,
  `Color` varchar(50) DEFAULT NULL,
  `LicensePlate` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`VehicleID`),
  KEY `UserID` (`UserID`),
  KEY `idx_vehicleid_vehicleinformation` (`VehicleID`),
  CONSTRAINT `uservehicle_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `userprofiles` (`UserID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uservehicle`
--

LOCK TABLES `uservehicle` WRITE;
/*!40000 ALTER TABLE `uservehicle` DISABLE KEYS */;
/*!40000 ALTER TABLE `uservehicle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicle_info`
--

DROP TABLE IF EXISTS `vehicle_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vehicle_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `make` varchar(50) NOT NULL,
  `model` varchar(50) NOT NULL,
  `year` int(11) NOT NULL,
  `trim` varchar(50) DEFAULT NULL,
  `engine_type` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicle_info`
--

LOCK TABLES `vehicle_info` WRITE;
/*!40000 ALTER TABLE `vehicle_info` DISABLE KEYS */;
/*!40000 ALTER TABLE `vehicle_info` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-11-29  0:16:40
