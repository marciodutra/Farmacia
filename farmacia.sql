-- MySQL dump 10.13  Distrib 8.0.38, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: farmacia
-- ------------------------------------------------------
-- Server version	8.0.39

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
-- Table structure for table `cliente`
--

DROP TABLE IF EXISTS `cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cliente` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(64) NOT NULL,
  `apellidos` varchar(64) NOT NULL,
  `dni` int DEFAULT NULL,
  `edad` date NOT NULL,
  `telefono` int DEFAULT NULL,
  `correo` varchar(64) DEFAULT NULL,
  `sexo` varchar(64) NOT NULL,
  `adicional` varchar(512) DEFAULT NULL,
  `avatar` varchar(256) DEFAULT NULL,
  `estado` varchar(16) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cliente`
--

LOCK TABLES `cliente` WRITE;
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT INTO `cliente` VALUES (1,'Márcio','de Oliveira Dutra',1,'1980-10-05',43,'marcio@gmail.com','Masculino','Nada','default_avatar.png','A'),(2,'Ivonete','Caxambu',2,'1974-01-27',50,'ivonete@gmail.com','Feminino','Nada','default_avatar.png','A'),(3,'Yasmin','de Quadros Dutra',3,'2003-12-21',20,'yasmin@gmail.com','Feminino','Nada','default_avatar.png','A');
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `compra`
--

DROP TABLE IF EXISTS `compra`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `compra` (
  `id` int NOT NULL AUTO_INCREMENT,
  `codigo` varchar(128) NOT NULL,
  `fecha_compra` date NOT NULL,
  `fecha_entrega` date NOT NULL,
  `total` float NOT NULL,
  `id_estado_pago` int NOT NULL,
  `id_proveedor` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_estado_pago` (`id_estado_pago`,`id_proveedor`),
  KEY `id_proveedor` (`id_proveedor`),
  CONSTRAINT `compra_ibfk_1` FOREIGN KEY (`id_estado_pago`) REFERENCES `estado_pago` (`id`),
  CONSTRAINT `compra_ibfk_2` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id_proveedor`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `compra`
--

LOCK TABLES `compra` WRITE;
/*!40000 ALTER TABLE `compra` DISABLE KEYS */;
INSERT INTO `compra` VALUES (5,'11','2023-01-30','2023-02-05',1,1,2),(6,'987','2023-01-29','2023-02-04',8,1,3),(7,'1','2023-01-30','2023-02-01',1,1,5);
/*!40000 ALTER TABLE `compra` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalle_venta`
--

DROP TABLE IF EXISTS `detalle_venta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detalle_venta` (
  `id_detalle` int NOT NULL AUTO_INCREMENT,
  `det_cantidad` int NOT NULL,
  `det_vencimiento` date NOT NULL,
  `id__det_lote` int NOT NULL,
  `id__det_prod` int NOT NULL,
  `lote_id_prov` int NOT NULL,
  `id_det_venta` int NOT NULL,
  PRIMARY KEY (`id_detalle`),
  KEY `id_det_venta_idx` (`id_det_venta`),
  CONSTRAINT `id_det_venta` FOREIGN KEY (`id_det_venta`) REFERENCES `venta` (`id_venta`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_venta`
--

LOCK TABLES `detalle_venta` WRITE;
/*!40000 ALTER TABLE `detalle_venta` DISABLE KEYS */;
INSERT INTO `detalle_venta` VALUES (1,23,'2022-11-06',9,10,1,16),(2,10,'2022-11-06',9,10,1,17),(3,15,'2022-12-08',12,10,3,18),(4,5,'2022-12-10',11,10,2,18),(5,1,'2022-12-10',11,10,2,19),(6,1,'2022-11-06',7,12,1,19),(7,7,'2023-05-13',8,14,2,20),(8,2,'2023-01-08',14,18,2,21),(9,4,'2023-02-04',15,15,3,21),(10,1,'2022-12-10',11,10,2,21),(11,1,'2022-11-06',7,12,1,21),(12,2,'2023-05-13',8,14,2,21),(13,1,'2023-01-08',14,18,2,22),(14,12,'2023-02-05',3,15,3,23),(15,11,'2023-01-30',6,15,5,24),(16,1,'2023-02-05',1,13,2,25),(17,5,'2023-03-12',2,10,3,26),(18,10,'2023-02-05',1,13,2,27);
/*!40000 ALTER TABLE `detalle_venta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estado_pago`
--

DROP TABLE IF EXISTS `estado_pago`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `estado_pago` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estado_pago`
--

LOCK TABLES `estado_pago` WRITE;
/*!40000 ALTER TABLE `estado_pago` DISABLE KEYS */;
INSERT INTO `estado_pago` VALUES (1,'Cancelado'),(2,'Não cancelado');
/*!40000 ALTER TABLE `estado_pago` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `laboratorio`
--

DROP TABLE IF EXISTS `laboratorio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `laboratorio` (
  `id_laboratorio` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `estado` varchar(10) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`id_laboratorio`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `laboratorio`
--

LOCK TABLES `laboratorio` WRITE;
/*!40000 ALTER TABLE `laboratorio` DISABLE KEYS */;
INSERT INTO `laboratorio` VALUES (2,'Porto Alegre','lab_default.png','A'),(3,'Cachoeirinha','lab_default.png','A'),(4,'Viamão','lab_default.png','A'),(5,'Canoas','lab_default.png','A'),(6,'Esteio','lab_default.png','A'),(10,'Novo Hamburgo','lab_default.png','A'),(11,'São Leopoldo','lab_default.png','A'),(12,'Caxias do Sul','lab_default.png','A'),(13,'Sapucaia do Sul','lab_default.png','A');
/*!40000 ALTER TABLE `laboratorio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lote`
--

DROP TABLE IF EXISTS `lote`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `lote` (
  `id` int NOT NULL AUTO_INCREMENT,
  `codigo` varchar(128) NOT NULL,
  `cantidad` int NOT NULL,
  `cantidad_lote` int NOT NULL,
  `vencimiento` date NOT NULL,
  `precio_compra` float NOT NULL,
  `id_compra` int NOT NULL,
  `id_producto` int NOT NULL,
  `estado` varchar(16) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`id`),
  KEY `id_compra` (`id_compra`,`id_producto`),
  KEY `id_producto` (`id_producto`),
  CONSTRAINT `lote_ibfk_1` FOREIGN KEY (`id_compra`) REFERENCES `compra` (`id`),
  CONSTRAINT `lote_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lote`
--

LOCK TABLES `lote` WRITE;
/*!40000 ALTER TABLE `lote` DISABLE KEYS */;
INSERT INTO `lote` VALUES (1,'123',1,0,'2023-02-05',1,5,13,'I'),(2,'12345',11,500,'2023-03-12',19,6,10,'A'),(3,'5555',13,500,'2023-02-05',14,6,15,'A'),(4,'1111',20,500,'2023-03-12',7,7,21,'A'),(5,'22',17,500,'2023-02-05',2,7,14,'A'),(6,'321',11,0,'2023-01-30',11,7,15,'I');
/*!40000 ALTER TABLE `lote` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `presentacion`
--

DROP TABLE IF EXISTS `presentacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `presentacion` (
  `id_presentacion` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `estado` varchar(10) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`id_presentacion`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `presentacion`
--

LOCK TABLES `presentacion` WRITE;
/*!40000 ALTER TABLE `presentacion` DISABLE KEYS */;
INSERT INTO `presentacion` VALUES (2,'Ampollas','A'),(5,'Comprimido','A'),(6,'Comprimido','A'),(7,'Aerosol','A'),(8,'Injeções','A'),(9,'Crema','A'),(10,'Suspensão','A'),(11,'Suspensão nasal','A'),(12,'Suspensão oftálmica','A'),(13,'Enema','A'),(14,'Emulsão','A'),(15,'Cápsula','A'),(16,'Gel','A'),(17,'Espuma','A'),(18,'Implante','A'),(19,'Loção','A'),(20,'Correção','A'),(21,'Jaleco','A'),(22,'Sabão','A'),(23,'Grânulos','A');
/*!40000 ALTER TABLE `presentacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `producto`
--

DROP TABLE IF EXISTS `producto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `producto` (
  `id_producto` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `concentracion` varchar(255) DEFAULT NULL,
  `adicional` varchar(255) DEFAULT NULL,
  `precio` float NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `estado` varchar(10) NOT NULL DEFAULT 'A',
  `prod_lab` int NOT NULL,
  `prod_tip_prod` int NOT NULL,
  `prod_present` int NOT NULL,
  PRIMARY KEY (`id_producto`),
  KEY `prod_lab_idx` (`prod_lab`),
  KEY `prod_tip_prod_idx` (`prod_tip_prod`),
  KEY `prod_present_idx` (`prod_present`),
  CONSTRAINT `prod_lab` FOREIGN KEY (`prod_lab`) REFERENCES `laboratorio` (`id_laboratorio`),
  CONSTRAINT `prod_present` FOREIGN KEY (`prod_present`) REFERENCES `presentacion` (`id_presentacion`),
  CONSTRAINT `prod_tip_prod` FOREIGN KEY (`prod_tip_prod`) REFERENCES `tipo_producto` (`id_tip_prod`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `producto`
--

LOCK TABLES `producto` WRITE;
/*!40000 ALTER TABLE `producto` DISABLE KEYS */;
INSERT INTO `producto` VALUES (10,'Paracetamol','100 mg','Caixa de embalagem bilateral',1,'66ce362a07498-Paracetamol.jpg','A',2,1,5),(11,'Alercet','10 mg/ml','Frascos a 15 ml',2,'66ce35ecc710f-Alercet.png','A',2,2,2),(12,'Alercet','1 mg/ml','Frascos a 60 ml',1,'66ce35f6cbfe4-Alercet.png','A',2,2,2),(13,'A FOLIC','6.5 mg','',1.5,'66ce26247e45d-A folic.jpg','A',5,2,6),(14,'Ramipril Normon','2.5 mg','',1,'66ce364e0ada3-Ramipril Normon.jpg','A',6,2,5),(15,'AB AMBROMOX','600 mg','caixa de estrada',1,'66ce264c25206-AB AMBROMOX.jpg','A',3,2,7),(18,'AB AMBROMOX','300 mg','caixa de estrada',2.65,'66ce266393c4f-AB AMBROMOX.jpg','A',5,1,7),(19,'ALBENDAZOL','100 mg/5ml','Frascos a 20 ml',3.3,'66ce26fbb58de-ALBENDAZOL.jpg','A',12,2,2),(20,'AMIKACINA','100 mg/2ml','Ampollas a 2ml',1.5,'66ce36121694c-AMIKACINA.jpg','A',11,1,7),(21,'ACICLOVIR','200 mg','Caixa de embalagem blister para comprimidos',1,'66ce2681af87d-ACICLOVIR.jpg','A',12,1,7);
/*!40000 ALTER TABLE `producto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proveedor`
--

DROP TABLE IF EXISTS `proveedor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `proveedor` (
  `id_proveedor` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `telefono` int NOT NULL,
  `correo` varchar(45) DEFAULT NULL,
  `direccion` varchar(45) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `estado` varchar(10) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`id_proveedor`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proveedor`
--

LOCK TABLES `proveedor` WRITE;
/*!40000 ALTER TABLE `proveedor` DISABLE KEYS */;
INSERT INTO `proveedor` VALUES (1,'Penélope',123456789,'','Desilusão','prov_default.png','A'),(2,'Aldonza',987654321,'','Desilusão','prov_default.png','A'),(3,'Distribuidora e droguaría San Carlos',222555888,'carlos@carlos.com','Avda San Carlos','prov_default.png','A'),(5,'Envíos Sánchez',4321,'aaaa@correo.es','Plaza Malmuerta','prov_default.png','A'),(6,'prueba',957437705,'prueba@correo.com','Plaza Malmuerta','prov_default.png','A');
/*!40000 ALTER TABLE `proveedor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_producto`
--

DROP TABLE IF EXISTS `tipo_producto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tipo_producto` (
  `id_tip_prod` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `estado` varchar(10) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`id_tip_prod`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_producto`
--

LOCK TABLES `tipo_producto` WRITE;
/*!40000 ALTER TABLE `tipo_producto` DISABLE KEYS */;
INSERT INTO `tipo_producto` VALUES (1,'Genérico','A'),(2,'Comercial','A'),(3,'Pandemia','A'),(7,'Presentes','A'),(8,'Joalheiros','A');
/*!40000 ALTER TABLE `tipo_producto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_us`
--

DROP TABLE IF EXISTS `tipo_us`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tipo_us` (
  `id_tipo_us` int NOT NULL AUTO_INCREMENT,
  `nombre_tipo` varchar(45) NOT NULL,
  PRIMARY KEY (`id_tipo_us`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_us`
--

LOCK TABLES `tipo_us` WRITE;
/*!40000 ALTER TABLE `tipo_us` DISABLE KEYS */;
INSERT INTO `tipo_us` VALUES (1,'Administrador'),(2,'Tecnico'),(3,'Root');
/*!40000 ALTER TABLE `tipo_us` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuario` (
  `id_usuario` int NOT NULL AUTO_INCREMENT,
  `nombre_us` varchar(45) NOT NULL,
  `apellidos_us` varchar(45) NOT NULL,
  `edad` date NOT NULL,
  `dni_us` varchar(45) NOT NULL,
  `contrasena_us` varchar(256) NOT NULL,
  `telefono_us` int NOT NULL DEFAULT '0',
  `residencia_us` varchar(45) NOT NULL,
  `correo_us` varchar(25) NOT NULL,
  `sexo_us` varchar(25) NOT NULL,
  `adicional_us` varchar(500) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `us_tipo` int NOT NULL,
  PRIMARY KEY (`id_usuario`),
  KEY `us_tipo_idx` (`us_tipo`),
  CONSTRAINT `us_tipo` FOREIGN KEY (`us_tipo`) REFERENCES `tipo_us` (`id_tipo_us`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'Alejandro','Veranez','1992-07-27','1234567','$2y$10$B3LI7o2/D54eUldEH3Gtmehb5o4QSDWq/ziu19FPLJyik2xYhhmfe',987654321,'Bastele','stc.fcojsr@gmail.com','Hombre','Supercalifragilisticoespialidoso','default.jpg',3),(7,'Aldonza','de la Mancha','1993-02-01','98765433','12345',0,'','','','','66cb8bb76be8c-eu.jpg',2),(8,'Márcio','Dutra','1980-10-05','1980','051080',987654321,'Cel Genuíno, 342','marcio@gmail.com','Masculino','Desenvolvedor Fullstack','eu.jpg',3);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `venta`
--

DROP TABLE IF EXISTS `venta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `venta` (
  `id_venta` int NOT NULL AUTO_INCREMENT,
  `fecha` datetime DEFAULT NULL,
  `cliente` varchar(45) DEFAULT NULL,
  `dni` int DEFAULT NULL,
  `total` float DEFAULT NULL,
  `vendedor` int NOT NULL,
  `id_cliente` int DEFAULT NULL,
  PRIMARY KEY (`id_venta`),
  KEY `vendedor` (`vendedor`),
  KEY `id_cliente` (`id_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `venta`
--

LOCK TABLES `venta` WRITE;
/*!40000 ALTER TABLE `venta` DISABLE KEYS */;
INSERT INTO `venta` VALUES (9,'2022-11-05 20:52:20','Claudia',15,5,1,NULL),(10,'2022-11-05 20:56:10','Estuarda',10,5,1,NULL),(11,'2022-11-05 20:57:13','m',20,7,1,NULL),(12,'2022-11-05 23:01:49','Vericueto',123,4,1,NULL),(13,'2022-11-05 23:04:48','asd',111,6,1,NULL),(14,'2022-11-05 23:08:08','Vericueto',123,6,1,NULL),(15,'2022-11-05 23:08:44','Vericueto',123,6,1,NULL),(16,'2022-11-25 17:45:34','pecosete',123,23,1,NULL),(17,'2022-11-25 17:47:52','pepeaca',123,10,1,NULL),(18,'2022-11-25 17:53:30','popo',321,20,1,NULL),(19,'2022-12-15 17:18:21','Pecosete',1228,2,1,NULL),(20,'2022-12-15 17:18:52','Pecoseta',3322,7,1,NULL),(21,'2023-01-09 23:21:03','Aldonza',222213,13.3,1,NULL),(22,'2023-01-13 20:49:52',NULL,NULL,2.65,1,3),(23,'2023-01-30 19:09:50',NULL,NULL,12,1,3),(24,'2023-01-30 19:18:03',NULL,NULL,11,1,3),(25,'2023-01-30 19:25:20',NULL,NULL,1.5,1,3),(26,'2023-01-30 19:43:16',NULL,NULL,5,1,3),(27,'2023-01-30 19:45:23',NULL,NULL,15,1,3);
/*!40000 ALTER TABLE `venta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `venta_producto`
--

DROP TABLE IF EXISTS `venta_producto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `venta_producto` (
  `id_ventaproducto` int NOT NULL AUTO_INCREMENT,
  `precio` float NOT NULL,
  `cantidad` int NOT NULL,
  `subtotal` float NOT NULL,
  `producto_id_producto` int NOT NULL,
  `venta_id_venta` int NOT NULL,
  PRIMARY KEY (`id_ventaproducto`),
  KEY `fk_venta_has_producto_producto1_idx` (`producto_id_producto`),
  KEY `fk_venta_has_producto_venta1_idx` (`venta_id_venta`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `venta_producto`
--

LOCK TABLES `venta_producto` WRITE;
/*!40000 ALTER TABLE `venta_producto` DISABLE KEYS */;
INSERT INTO `venta_producto` VALUES (1,0,5,5,12,9),(2,0,5,5,12,10),(3,0,7,7,12,11),(4,0,2,4,11,12),(5,0,3,6,11,13),(6,0,3,6,11,14),(7,0,3,6,11,15),(8,0,23,23,10,16),(9,0,10,10,10,17),(10,0,20,20,10,18),(11,0,1,1,10,19),(12,0,1,1,12,19),(13,0,7,7,14,20),(14,2.65,2,5.3,18,21),(15,1,4,4,15,21),(16,1,1,1,10,21),(17,1,1,1,12,21),(18,1,2,2,14,21),(19,2.65,1,2.65,18,22),(20,1,12,12,15,23),(21,1,11,11,15,24),(22,1.5,1,1.5,13,25),(23,1,5,5,10,26),(24,1.5,10,15,13,27);
/*!40000 ALTER TABLE `venta_producto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'farmacia'
--

--
-- Dumping routines for database 'farmacia'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-08-27 18:09:12
