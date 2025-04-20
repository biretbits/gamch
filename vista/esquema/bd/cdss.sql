-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: cds
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `centro_de_salud`
--

DROP TABLE IF EXISTS `centro_de_salud`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `centro_de_salud` (
  `cod_cds` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_cds` char(200) DEFAULT NULL,
  `direccion_cds` char(200) DEFAULT NULL,
  `estado` char(15) DEFAULT NULL,
  PRIMARY KEY (`cod_cds`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `centro_de_salud`
--

LOCK TABLES `centro_de_salud` WRITE;
/*!40000 ALTER TABLE `centro_de_salud` DISABLE KEYS */;
INSERT INTO `centro_de_salud` VALUES (1,'Centro de salud Cala cala','Cala cala','activo');
/*!40000 ALTER TABLE `centro_de_salud` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `conc_uni_med`
--

DROP TABLE IF EXISTS `conc_uni_med`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `conc_uni_med` (
  `cod_conc` int(11) NOT NULL AUTO_INCREMENT,
  `concentracion` char(60) DEFAULT NULL,
  `estado` char(10) DEFAULT 'activo',
  PRIMARY KEY (`cod_conc`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `conc_uni_med`
--

LOCK TABLES `conc_uni_med` WRITE;
/*!40000 ALTER TABLE `conc_uni_med` DISABLE KEYS */;
INSERT INTO `conc_uni_med` VALUES (1,'800 mg + 160 mg','activo'),(2,'200 mg + 40 mg/5 ml','activo'),(3,'4 mg/ml','activo'),(4,'10 mg/5 ml','activo'),(5,'10 mg','activo'),(6,'50 mg','activo'),(7,'75 mg','activo'),(8,'500 mg','activo'),(9,'250 mg/5 ml','activo'),(10,'1 mg/ml','activo'),(11,'0','activo'),(12,'Segun disponibilidad','activo'),(13,'10 mg/ml','activo'),(14,'40 mg','activo'),(15,'0','activo'),(16,'80 mg','activo'),(17,'1 g a 1','activo'),(18,'1%','activo'),(19,'100 mg','activo'),(20,'1:1','activo'),(21,'400 mg','activo'),(22,'100 mg/5 ml','activo'),(23,'25 mg','activo'),(24,'30 mg/ml','activo'),(25,'65% a 67%','activo'),(26,'0','activo'),(27,'150 mg','activo'),(28,'0','activo'),(29,'2%','activo'),(30,'150 mg/ml','activo'),(31,'1 g','activo'),(32,'10 mg / 2 ml','activo'),(33,'Segun concentracion estandar','activo'),(34,'100.000 UI/g','activo'),(35,'500.000 UI/5 ml','activo'),(36,'25 mg/5 ml','activo'),(37,'20 mg','activo'),(38,'Segun disponibilidad','activo'),(39,'5 UI/ml o 10 UI/ml','activo'),(40,'100 mg/ml','activo'),(41,'120 mg/5 ml o 125 mg/5 ml','activo'),(42,'2% o 3%','activo'),(43,'250 mg/5 ml','activo'),(44,'100.000 UI','activo'),(45,'200.000 UI','activo'),(46,'0','activo'),(47,'5% (1.000 ml)','activo'),(48,'0','activo'),(49,'1.000 ml','activo'),(50,'10%','activo'),(51,'200 mg + 0','activo'),(52,'1%','activo'),(53,'20 mg/5 ml','activo'),(54,'Pieza','activo'),(55,'Frasco','activo'),(56,'Paquete','activo'),(57,'Sobre','activo'),(58,'Caja','activo'),(59,'Rollo','activo'),(60,'Tubo','activo'),(61,'Kit','activo'),(62,'Determinacion','activo'),(63,'37%','activo'),(64,'0','activo'),(65,'UNIDAD','activo'),(66,'SOLUCION','activo'),(67,'DETERMINACIONES SOLUCION','activo');
/*!40000 ALTER TABLE `conc_uni_med` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `entrada`
--

DROP TABLE IF EXISTS `entrada`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `entrada` (
  `cod_producto` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` char(20) DEFAULT NULL,
  `cod_generico` int(11) DEFAULT NULL,
  `cod_forma` int(11) DEFAULT NULL,
  `cod_conc` int(11) DEFAULT NULL,
  `enfermedad` varchar(100) DEFAULT '',
  `estado` char(10) DEFAULT 'activo',
  PRIMARY KEY (`cod_producto`),
  KEY `cod_forma` (`cod_forma`),
  KEY `cod_conc` (`cod_conc`),
  KEY `cod_generico` (`cod_generico`),
  CONSTRAINT `entrada_ibfk_1` FOREIGN KEY (`cod_forma`) REFERENCES `forma_presentacion` (`cod_forma`),
  CONSTRAINT `entrada_ibfk_2` FOREIGN KEY (`cod_conc`) REFERENCES `conc_uni_med` (`cod_conc`),
  CONSTRAINT `entrada_ibfk_3` FOREIGN KEY (`cod_generico`) REFERENCES `producto` (`cod_generico`)
) ENGINE=InnoDB AUTO_INCREMENT=129 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entrada`
--

LOCK TABLES `entrada` WRITE;
/*!40000 ALTER TABLE `entrada` DISABLE KEYS */;
INSERT INTO `entrada` VALUES (1,'J0504',1,1,21,'','activo'),(2,'J0105',3,1,31,'','activo'),(3,'J0106',3,1,8,'','activo'),(4,'R0501',5,1,12,'','activo'),(5,'A0701',13,5,12,'','activo'),(6,'J0126',14,2,31,'','activo'),(7,'J0127',15,1,8,'','activo'),(8,'R0603',17,2,13,'','activo'),(9,'G0102',18,8,19,'','activo'),(10,'A1106',20,1,33,'','activo'),(11,'A1107',20,2,33,'','activo'),(12,'V0604',21,5,33,'','activo'),(13,'V0603',23,5,33,'','activo'),(14,'J0137',24,1,1,'','activo'),(15,'J0138',24,3,2,'','activo'),(16,'H0204',25,2,3,'','activo'),(17,'R0503',26,7,4,'','activo'),(18,'N0505',27,2,5,'','activo'),(19,'M0102',28,1,6,'','activo'),(20,'M0103',28,2,7,'','activo'),(21,'J0141',29,10,8,'','activo'),(22,'J0142',29,3,9,'','activo'),(23,'C0901',30,11,5,'','activo'),(24,'C0110',31,2,10,'','activo'),(25,'J0145',33,12,8,'','activo'),(26,'J0146',34,3,9,'','activo'),(27,'A0604',35,13,12,'','activo'),(28,'B0202',36,2,13,'','activo'),(29,'C0304',37,11,14,'','activo'),(30,'J0149',39,2,16,'','activo'),(31,'C0306',41,11,6,'','activo'),(32,'D0704',42,4,18,'','activo'),(33,'H0205',43,2,19,'','activo'),(34,'A0201',44,3,20,'','activo'),(35,'M0105',45,1,21,'','activo'),(36,'M0104',45,3,22,'','activo'),(37,'M0106',46,12,23,'','activo'),(38,'M0107',46,14,19,'','activo'),(39,'M0109',47,2,24,'','activo'),(40,'A0607',48,15,25,'','activo'),(41,'G0319',50,16,27,'','activo'),(42,'N0109',52,17,29,'','activo'),(43,'N0112',53,2,29,'','activo'),(44,'C0902',54,1,6,'','activo'),(45,'P0205',55,1,8,'','activo'),(46,'G0313',56,2,30,'','activo'),(47,'N0205',57,2,31,'','activo'),(48,'C0204',58,1,8,'','activo'),(49,'A0307',59,1,5,'','activo'),(50,'B0305',60,5,33,'','activo'),(51,'A1109',61,1,33,'','activo'),(52,'C0808',62,18,5,'','activo'),(53,'D0104',63,4,34,'','activo'),(54,'A0704',63,3,35,'','activo'),(55,'J0152',64,3,36,'','activo'),(56,'A0202',65,10,37,'','activo'),(57,'D0202',66,19,12,'','activo'),(58,'G0209',67,2,39,'','activo'),(59,'N0212',68,1,19,'','activo'),(60,'N0208',68,1,8,'','activo'),(61,'N0209',68,7,41,'','activo'),(62,'P0208',70,3,9,'','activo'),(63,'A0204',71,2,6,'','activo'),(64,'A1115',72,22,44,'','activo'),(65,'J0504',1,1,21,'','activo'),(66,'J0105',3,1,31,'','activo'),(67,'J0106',3,1,8,'','activo'),(68,'R0501',5,1,12,'','activo'),(69,'A0701',13,5,12,'','activo'),(70,'J0126',14,2,31,'','activo'),(71,'J0127',15,1,8,'','activo'),(72,'R0603',17,2,13,'','activo'),(73,'G0102',18,8,19,'','activo'),(74,'A1106',20,1,33,'','activo'),(75,'A1107',20,2,33,'','activo'),(76,'V0604',21,5,33,'','activo'),(77,'V0603',23,5,33,'','activo'),(78,'J0137',24,1,1,'','activo'),(79,'J0138',24,3,2,'','activo'),(80,'H0204',25,2,3,'','activo'),(81,'R0503',26,7,4,'','activo'),(82,'N0505',27,2,5,'','activo'),(83,'M0102',28,1,6,'','activo'),(84,'M0103',28,2,7,'','activo'),(85,'J0141',29,10,8,'','activo'),(86,'J0142',29,3,9,'','activo'),(87,'C0901',30,11,5,'','activo'),(88,'C0110',31,2,10,'','activo'),(89,'J0145',33,12,8,'','activo'),(90,'J0146',34,3,9,'','activo'),(91,'A0604',35,13,12,'','activo'),(92,'B0202',36,2,13,'','activo'),(93,'C0304',37,11,14,'','activo'),(94,'J0149',39,2,16,'','activo'),(95,'C0306',41,11,6,'','activo'),(96,'D0704',42,4,18,'','activo'),(97,'H0205',43,2,19,'','activo'),(98,'A0201',44,3,20,'','activo'),(99,'M0105',45,1,21,'','activo'),(100,'M0104',45,3,22,'','activo'),(101,'M0106',46,12,23,'','activo'),(102,'M0107',46,14,19,'','activo'),(103,'M0109',47,2,24,'','activo'),(104,'A0607',48,15,25,'','activo'),(105,'G0319',50,16,27,'','activo'),(106,'N0109',52,17,29,'','activo'),(107,'N0112',53,2,29,'','activo'),(108,'C0902',54,1,6,'','activo'),(109,'P0205',55,1,8,'','activo'),(110,'G0313',56,2,30,'','activo'),(111,'N0205',57,2,31,'','activo'),(112,'C0204',58,1,8,'','activo'),(113,'A0307',59,1,5,'','activo'),(114,'B0305',60,5,33,'','activo'),(115,'A1109',61,1,33,'','activo'),(116,'C0808',62,18,5,'','activo'),(117,'D0104',63,4,34,'','activo'),(118,'A0704',63,3,35,'','activo'),(119,'J0152',64,3,36,'','activo'),(120,'A0202',65,10,37,'','activo'),(121,'D0202',66,19,12,'','activo'),(122,'G0209',67,2,39,'','activo'),(123,'N0212',68,1,19,'','activo'),(124,'N0208',68,1,8,'','activo'),(125,'N0209',68,7,41,'','activo'),(126,'P0208',70,3,9,'','activo'),(127,'A0204',71,2,6,'','activo'),(128,'A1115',72,22,44,'','activo');
/*!40000 ALTER TABLE `entrada` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forma_presentacion`
--

DROP TABLE IF EXISTS `forma_presentacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forma_presentacion` (
  `cod_forma` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_forma` char(150) DEFAULT NULL,
  `estado` char(10) DEFAULT 'activo',
  PRIMARY KEY (`cod_forma`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forma_presentacion`
--

LOCK TABLES `forma_presentacion` WRITE;
/*!40000 ALTER TABLE `forma_presentacion` DISABLE KEYS */;
INSERT INTO `forma_presentacion` VALUES (1,'Comprimido','activo'),(2,'Inyectable','activo'),(3,'Suspension','activo'),(4,'Crema o Pomada','activo'),(5,'Polvo','activo'),(6,'Solucion oftalmica','activo'),(7,'Jarabe','activo'),(8,'Ovulo','activo'),(9,'Comprimido o Capsula blanda','activo'),(10,'Capsula','activo'),(11,'Comprimido ranurado','activo'),(12,'Capsula o Comprimido','activo'),(13,'Polvo o granulado','activo'),(14,'Supositorio','activo'),(15,'Solucion oral','activo'),(16,'Implante subdermico','activo'),(17,'Cartucho dental','activo'),(18,'Comprimido o Capsula','activo'),(19,'Pasta o Pomada','activo'),(20,'Gotas','activo'),(21,'Solucion','activo'),(22,'Capsula o Perla','activo'),(23,'Aerosol','activo'),(24,'Sobres','activo'),(25,'Solucion parenteral de gran volumen','activo'),(26,'Unguento o crema','activo'),(27,'Sobre esteril','activo'),(28,'Paquete','activo'),(29,'Pieza','activo'),(30,'Unidad','activo'),(31,'Sobre','activo'),(32,'Caja x 100','activo'),(33,'Rollo 100 yds.','activo'),(34,'Par','activo'),(35,'Tubo 50 g.','activo'),(36,'Placa','activo'),(37,'Carrete','activo'),(38,'Rollo','activo'),(39,'Frasco','activo'),(40,'Kit x 250 determinaciones','activo'),(41,'Kit x 3 frascos x 10 ml c/u','activo'),(42,'Determinacion','activo'),(43,'Frasco 4 x 10 ml','activo'),(44,'Frasco x 100 unidades','activo'),(45,'Kit x 100 determinaciones','activo'),(46,'TUBO','activo'),(47,'PIEZAS','activo'),(48,'FRASCO 50 ML','activo'),(49,'KIT X96','activo'),(50,'KIT X 96','activo'),(51,'KIT 50 ML','activo'),(52,'KIT FRASCO 3 X500 ML','activo');
/*!40000 ALTER TABLE `forma_presentacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `historial`
--

DROP TABLE IF EXISTS `historial`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `historial` (
  `cod_his` int(11) NOT NULL AUTO_INCREMENT,
  `zona_his` char(70) DEFAULT NULL,
  `cod_rd` int(11) NOT NULL,
  `paciente_rd` int(11) NOT NULL,
  `cod_cds` int(11) NOT NULL,
  `cod_responsable_familia_his` int(11) NOT NULL,
  `archivo` char(100) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `estado` char(20) DEFAULT NULL,
  PRIMARY KEY (`cod_his`,`cod_rd`,`paciente_rd`,`cod_cds`,`cod_responsable_familia_his`),
  KEY `cod_rd` (`cod_rd`,`paciente_rd`,`cod_cds`),
  KEY `cod_responsable_familia_his` (`cod_responsable_familia_his`),
  CONSTRAINT `historial_ibfk_1` FOREIGN KEY (`cod_rd`, `paciente_rd`, `cod_cds`) REFERENCES `registro_diario` (`cod_rd`, `paciente_rd`, `cod_cds`),
  CONSTRAINT `historial_ibfk_2` FOREIGN KEY (`cod_responsable_familia_his`) REFERENCES `usuario` (`cod_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `historial`
--

LOCK TABLES `historial` WRITE;
/*!40000 ALTER TABLE `historial` DISABLE KEYS */;
INSERT INTO `historial` VALUES (1,'z5',3,7,1,8,'','2024-02-02','20:05:00','activo');
/*!40000 ALTER TABLE `historial` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `p`
--

DROP TABLE IF EXISTS `p`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `p` (
  `cod_producto` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` char(10) DEFAULT NULL,
  `cod_generico` char(200) DEFAULT NULL,
  `cod_forma` char(200) DEFAULT NULL,
  `cod_conc` char(200) DEFAULT NULL,
  PRIMARY KEY (`cod_producto`)
) ENGINE=InnoDB AUTO_INCREMENT=230 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `p`
--

LOCK TABLES `p` WRITE;
/*!40000 ALTER TABLE `p` DISABLE KEYS */;
INSERT INTO `p` VALUES (1,'J0504','Aciclovir','Comprimido','400 mg'),(2,'B0501','Agua para inyeccion','Inyectable','5 ml'),(3,'J0105','Amoxicilina','Comprimido','1 g'),(4,'J0106','Amoxicilina','Comprimido','500 mg'),(5,'J0157','Amoxicilina','Suspension','500 mg/5 ml'),(6,'J0110','Amoxicilina + inhibidor betalactamasa','Suspension','250 mg + Segun disponibilidad/5 ml'),(7,'R0501','Antigripal (Paracetamol + Antihistaminico + Vasoconstrictor con o sin Cafeina)','Comprimido','Segun disponibilidad'),(8,'D0102','Bacitracina + Neomicina sulfato','Crema o Pomada','500 UI + 5 mg/g'),(9,'J0115','Bencilpenicilina benzatinica','Inyectable','1.200.000 UI'),(10,'J0116','Bencilpenicilina benzatinica','Inyectable','2.400.000 UI'),(11,'H0201','Betametasona (fosfato)','Inyectable','4 mg'),(12,'A0101','Bicarbonato de sodio','Polvo','20 g'),(13,'A0602','Bisacodilo','Comprimido','5 mg'),(14,'A0304','Butilbromuro de Hioscina (Butilescopolamina)','Inyectable','20 mg/ml'),(15,'N0304','Carbamazepina','Comprimido','200 mg'),(16,'A0701','Carbon medicinal activado','Polvo','Segun disponibilidad'),(17,'J0126','Ceftriaxona','Inyectable','1 g'),(18,'J0127','Ciprofloxacina','Comprimido','500 mg'),(19,'S0105','Cloranfenicol','Solucion oftalmica','0.5%'),(20,'R0601','Clorfenamina (Clorfeniramina)','Comprimido','4 mg'),(21,'R0603','Clorfenamina (Clorfeniramina)','Inyectable','10 mg/ml'),(22,'R0602','Clorfenamina (Clorfeniramina)','Jarabe','2 mg/5 ml'),(23,'D0103','Clotrimazol','Crema o Pomada','1% (20 g)'),(24,'G0102','Clotrimazol','Ovulo','100 mg'),(25,'A1105','Colecalciferol (Vitamina D3)','Comprimido o Capsula blanda','0.25 mcg'),(26,'A1106','Complejo B (B1 + B6 + B12)','Comprimido','Segun concentracion estandar'),(27,'A1107','Complejo B (B1 + B6 + B12)','Inyectable','Segun concentracion estandar'),(28,'V0604','Complemento nutricional (Carmelo)','Polvo','Segun concentracion estandar'),(29,'V0607','Complemento nutricional (Nutri Mama con Canahua probiotico y Omega-3)','Polvo','Segun concentracion estandar'),(30,'V0603','Complemento nutricional (Nutribebe)','Polvo','Segun concentracion estandar'),(31,'J0140','Cotrimoxazol (Sulfametoxazol + Trimetoprima)','Comprimido','400 mg + 80 mg'),(32,'J0137','Cotrimoxazol (Sulfametoxazol + Trimetoprima)','Comprimido','800 mg + 160 mg'),(33,'J0138','Cotrimoxazol (Sulfametoxazol + Trimetoprima)','Suspension','200 mg + 40 mg/5 ml'),(34,'H0204','Dexametasona','Inyectable','4 mg/ml'),(35,'R0503','Dextrometorfano bromhidrato','Jarabe','10 mg/5 ml'),(36,'N0505','Diazepam','Inyectable','10 mg'),(37,'M0102','Diclofenaco Sodico','Comprimido','50 mg'),(38,'M0103','Diclofenaco Sodico','Inyectable','75 mg'),(39,'J0141','Dicloxacilina sodica','Capsula','500 mg'),(40,'J0142','Dicloxacilina sodica','Suspension','250 mg/5 ml'),(41,'C0901','Enalapril maleato','Comprimido ranurado','10 mg'),(42,'C0110','Epinefrina (Adrenalina)','Inyectable','1 mg/ml'),(43,'G0203','Ergometrina maleato','Comprimido','0.2 mg'),(44,'J0145','Eritromicina (estearato)','Capsula o Comprimido','500 mg'),(45,'J0146','Eritromicina (etilsuccinato)','Suspension','250 mg/5 ml'),(46,'A0604','Fibra natural','Polvo o granulado','Segun disponibilidad'),(47,'B0202','Fitomenadiona (Vitamina K1)','Inyectable','10 mg/ml'),(48,'C0304','Furosemida','Comprimido ranurado','40 mg'),(49,'S0116','Gentamicina','Solucion oftalmica','0.3%'),(50,'J0149','Gentamicina sulfato','Inyectable','80 mg'),(51,'A0606','Glicerol (Glicerina)','Supositorio','1 g a 1.80 g (infantil)'),(52,'C0306','Hidroclorotiazida','Comprimido ranurado','50 mg'),(53,'D0704','Hidrocortisona acetato','Crema o Pomada','1%'),(54,'H0205','Hidrocortisona succinato sodico','Inyectable','100 mg'),(55,'A0201','Hidroxido de aluminio y magnesio','Suspension','1:1'),(56,'M0105','Ibuprofeno','Comprimido','400 mg'),(57,'M0104','Ibuprofeno','Suspension','100 mg/5 ml'),(58,'M0106','Indometacina','Capsula o Comprimido','25 mg'),(59,'M0107','Indometacina','Supositorio','100 mg'),(60,'M0109','Ketorolaco','Inyectable','30 mg/ml'),(61,'A0607','Lactulosa','Solucion oral','65% a 67%'),(62,'S0118','Lagrimas artificiales','Solucion oftalmica','0.3% o 1%'),(63,'G0319','Levonorgestrel','Implante subdermico','150 mg'),(64,'G0312','Levonorgestrel + Etinilestradiol','Comprimido','0.150 mg + 0.03 mg'),(65,'N0109','Lidocaina','Cartucho dental','2%'),(66,'N0112','Lidocaina clorhidrato sin conservante','Inyectable','2%'),(67,'C0902','Losartan','Comprimido','50 mg'),(68,'P0205','Mebendazol','Comprimido','500 mg'),(69,'G0313','Medroxiprogesterona acetato','Inyectable','150 mg/ml'),(70,'N0205','Metamizol (Dipirona)','Inyectable','1 g'),(71,'C0204','Metildopa (Alfametildopa)','Comprimido','500 mg'),(72,'A0307','Metoclopramida','Comprimido','10 mg'),(73,'A0308','Metoclopramida','Inyectable','10mg / 2ml'),(74,'P0109','Metronidazol','Comprimido','500 mg'),(75,'G0104','Metronidazol','Ovulo','500 mg'),(76,'P0106','Metronidazol','Suspension','250 mg/5 ml'),(77,'B0305','Micronutrientes (Vit.C+Vit.A+Fe+Zn+Ac.Folico) (Chispitas nutricionales)','Polvo','Segun concentracion estandar'),(78,'A1109','Multivitaminas','Comprimido','Segun concentracion estandar'),(79,'C0808','Nifedipino','Comprimido o Capsula','10 mg'),(80,'D0104','Nistatina','Crema o Pomada','100.000 UI/g'),(81,'A0704','Nistatina','Suspension','500.000 UI/5 ml'),(82,'J0152','Nitrofurantoina','Suspension','25 mg/5 ml'),(83,'A0202','Omeprazol','Capsula','20 mg'),(84,'D0202','Oxido de Zinc con o sin aceite','Pasta o Pomada','Segun disponibilidad'),(85,'G0209','Oxitocina','Inyectable','5 UI/ml o 10 UI/ml'),(86,'N0212','Paracetamol (Acetaminofeno)','Comprimido','100 mg'),(87,'N0208','Paracetamol (Acetaminofeno)','Comprimido','500 mg'),(88,'N0210','Paracetamol (Acetaminofeno)','Gotas','100 mg/ml (15 ml)'),(89,'N0209','Paracetamol (Acetaminofeno)','Jarabe','120 mg/5 ml o 125 mg/5 ml'),(90,'D0810','Peroxido de hidrogeno (Agua oxigenada)','Solucion','2% o 3% (1 l)'),(91,'P0208','Pirantel pamoato','Suspension','250 mg/5 ml'),(92,'A0204','Ranitidina','Inyectable','50 mg'),(93,'A1115','Retinol (Vitamina A)','Capsula o Perla','100.000 UI'),(94,'A1116','Retinol (Vitamina A)','Perla','50.000 UI'),(95,'S0120','Sulfacetamida','Solucion oftalmica','10%'),(96,'N0602','Tetraciclina','Comprimido','250 mg'),(97,'P0206','Tiabendazol','Comprimido','50 mg'),(98,'C0101','Valproato de sodio','Comprimido','500 mg'),(99,'J0125','Vancomicina','Inyectable','500 mg'),(100,'D0105','Vitamina E','Comprimido o Capsula','400 UI'),(101,'S0201','Vitamina E','Solucion','50 UI/ml'),(102,'A0305','Vitaminas (Complejo B)','Inyectable','Segun concentracion estandar'),(128,'J0504','Aciclovir','Comprimido','400 mg'),(129,'B0501','Agua para inyeccion','Inyectable','5 ml'),(130,'J0105','Amoxicilina','Comprimido','1 g'),(131,'J0106','Amoxicilina','Comprimido','500 mg'),(132,'J0157','Amoxicilina','Suspension','500 mg/5 ml'),(133,'J0110','Amoxicilina + inhibidor betalactamasa','Suspension','250 mg + Segun disponibilidad/5 ml'),(134,'R0501','Antigripal (Paracetamol + Antihistaminico + Vasoconstrictor con o sin Cafeina)','Comprimido','Segun disponibilidad'),(135,'D0102','Bacitracina + Neomicina sulfato','Crema o Pomada','500 UI + 5 mg/g'),(136,'J0115','Bencilpenicilina benzatinica','Inyectable','1.200.000 UI'),(137,'J0116','Bencilpenicilina benzatinica','Inyectable','2.400.000 UI'),(138,'H0201','Betametasona (fosfato)','Inyectable','4 mg'),(139,'A0101','Bicarbonato de sodio','Polvo','20 g'),(140,'A0602','Bisacodilo','Comprimido','5 mg'),(141,'A0304','Butilbromuro de Hioscina (Butilescopolamina)','Inyectable','20 mg/ml'),(142,'N0304','Carbamazepina','Comprimido','200 mg'),(143,'A0701','Carbon medicinal activado','Polvo','Segun disponibilidad'),(144,'J0126','Ceftriaxona','Inyectable','1 g'),(145,'J0127','Ciprofloxacina','Comprimido','500 mg'),(146,'S0105','Cloranfenicol','Solucion oftalmica','0.5%'),(147,'R0601','Clorfenamina (Clorfeniramina)','Comprimido','4 mg'),(148,'R0603','Clorfenamina (Clorfeniramina)','Inyectable','10 mg/ml'),(149,'R0602','Clorfenamina (Clorfeniramina)','Jarabe','2 mg/5 ml'),(150,'D0103','Clotrimazol','Crema o Pomada','1% (20 g)'),(151,'G0102','Clotrimazol','Ovulo','100 mg'),(152,'A1105','Colecalciferol (Vitamina D3)','Comprimido o Capsula blanda','0.25 mcg'),(153,'A1106','Complejo B (B1 + B6 + B12)','Comprimido','Segun concentracion estandar'),(154,'A1107','Complejo B (B1 + B6 + B12)','Inyectable','Segun concentracion estandar'),(155,'V0604','Complemento nutricional (Carmelo)','Polvo','Segun concentracion estandar'),(156,'V0607','Complemento nutricional (Nutri Mama con Canahua probiotico y Omega-3)','Polvo','Segun concentracion estandar'),(157,'V0603','Complemento nutricional (Nutribebe)','Polvo','Segun concentracion estandar'),(158,'J0140','Cotrimoxazol (Sulfametoxazol + Trimetoprima)','Comprimido','400 mg + 80 mg'),(159,'J0137','Cotrimoxazol (Sulfametoxazol + Trimetoprima)','Comprimido','800 mg + 160 mg'),(160,'J0138','Cotrimoxazol (Sulfametoxazol + Trimetoprima)','Suspension','200 mg + 40 mg/5 ml'),(161,'H0204','Dexametasona','Inyectable','4 mg/ml'),(162,'R0503','Dextrometorfano bromhidrato','Jarabe','10 mg/5 ml'),(163,'N0505','Diazepam','Inyectable','10 mg'),(164,'M0102','Diclofenaco Sodico','Comprimido','50 mg'),(165,'M0103','Diclofenaco Sodico','Inyectable','75 mg'),(166,'J0141','Dicloxacilina sodica','Capsula','500 mg'),(167,'J0142','Dicloxacilina sodica','Suspension','250 mg/5 ml'),(168,'C0901','Enalapril maleato','Comprimido ranurado','10 mg'),(169,'C0110','Epinefrina (Adrenalina)','Inyectable','1 mg/ml'),(170,'G0203','Ergometrina maleato','Comprimido','0.2 mg'),(171,'J0145','Eritromicina (estearato)','Capsula o Comprimido','500 mg'),(172,'J0146','Eritromicina (etilsuccinato)','Suspension','250 mg/5 ml'),(173,'A0604','Fibra natural','Polvo o granulado','Segun disponibilidad'),(174,'B0202','Fitomenadiona (Vitamina K1)','Inyectable','10 mg/ml'),(175,'C0304','Furosemida','Comprimido ranurado','40 mg'),(176,'S0116','Gentamicina','Solucion oftalmica','0.3%'),(177,'J0149','Gentamicina sulfato','Inyectable','80 mg'),(178,'A0606','Glicerol (Glicerina)','Supositorio','1 g a 1.80 g (infantil)'),(179,'C0306','Hidroclorotiazida','Comprimido ranurado','50 mg'),(180,'D0704','Hidrocortisona acetato','Crema o Pomada','1%'),(181,'H0205','Hidrocortisona succinato sodico','Inyectable','100 mg'),(182,'A0201','Hidroxido de aluminio y magnesio','Suspension','1:1'),(183,'M0105','Ibuprofeno','Comprimido','400 mg'),(184,'M0104','Ibuprofeno','Suspension','100 mg/5 ml'),(185,'M0106','Indometacina','Capsula o Comprimido','25 mg'),(186,'M0107','Indometacina','Supositorio','100 mg'),(187,'M0109','Ketorolaco','Inyectable','30 mg/ml'),(188,'A0607','Lactulosa','Solucion oral','65% a 67%'),(189,'S0118','Lagrimas artificiales','Solucion oftalmica','0.3% o 1%'),(190,'G0319','Levonorgestrel','Implante subdermico','150 mg'),(191,'G0312','Levonorgestrel + Etinilestradiol','Comprimido','0.150 mg + 0.03 mg'),(192,'N0109','Lidocaina','Cartucho dental','2%'),(193,'N0112','Lidocaina clorhidrato sin conservante','Inyectable','2%'),(194,'C0902','Losartan','Comprimido','50 mg'),(195,'P0205','Mebendazol','Comprimido','500 mg'),(196,'G0313','Medroxiprogesterona acetato','Inyectable','150 mg/ml'),(197,'N0205','Metamizol (Dipirona)','Inyectable','1 g'),(198,'C0204','Metildopa (Alfametildopa)','Comprimido','500 mg'),(199,'A0307','Metoclopramida','Comprimido','10 mg'),(200,'A0308','Metoclopramida','Inyectable','10mg / 2ml'),(201,'P0109','Metronidazol','Comprimido','500 mg'),(202,'G0104','Metronidazol','Ovulo','500 mg'),(203,'P0106','Metronidazol','Suspension','250 mg/5 ml'),(204,'B0305','Micronutrientes (Vit.C+Vit.A+Fe+Zn+Ac.Folico) (Chispitas nutricionales)','Polvo','Segun concentracion estandar'),(205,'A1109','Multivitaminas','Comprimido','Segun concentracion estandar'),(206,'C0808','Nifedipino','Comprimido o Capsula','10 mg'),(207,'D0104','Nistatina','Crema o Pomada','100.000 UI/g'),(208,'A0704','Nistatina','Suspension','500.000 UI/5 ml'),(209,'J0152','Nitrofurantoina','Suspension','25 mg/5 ml'),(210,'A0202','Omeprazol','Capsula','20 mg'),(211,'D0202','Oxido de Zinc con o sin aceite','Pasta o Pomada','Segun disponibilidad'),(212,'G0209','Oxitocina','Inyectable','5 UI/ml o 10 UI/ml'),(213,'N0212','Paracetamol (Acetaminofeno)','Comprimido','100 mg'),(214,'N0208','Paracetamol (Acetaminofeno)','Comprimido','500 mg'),(215,'N0210','Paracetamol (Acetaminofeno)','Gotas','100 mg/ml (15 ml)'),(216,'N0209','Paracetamol (Acetaminofeno)','Jarabe','120 mg/5 ml o 125 mg/5 ml'),(217,'D0810','Peroxido de hidrogeno (Agua oxigenada)','Solucion','2% o 3% (1 l)'),(218,'P0208','Pirantel pamoato','Suspension','250 mg/5 ml'),(219,'A0204','Ranitidina','Inyectable','50 mg'),(220,'A1115','Retinol (Vitamina A)','Capsula o Perla','100.000 UI'),(221,'A1116','Retinol (Vitamina A)','Perla','50.000 UI'),(222,'S0120','Sulfacetamida','Solucion oftalmica','10%'),(223,'N0602','Tetraciclina','Comprimido','250 mg'),(224,'P0206','Tiabendazol','Comprimido','50 mg'),(225,'C0101','Valproato de sodio','Comprimido','500 mg'),(226,'J0125','Vancomicina','Inyectable','500 mg'),(227,'D0105','Vitamina E','Comprimido o Capsula','400 UI'),(228,'S0201','Vitamina E','Solucion','50 UI/ml'),(229,'A0305','Vitaminas (Complejo B)','Inyectable','Segun concentracion estandar');
/*!40000 ALTER TABLE `p` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `producto`
--

DROP TABLE IF EXISTS `producto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `producto` (
  `cod_generico` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` char(150) DEFAULT NULL,
  `enfermedad` char(150) DEFAULT NULL,
  `vitrina` char(50) DEFAULT NULL,
  `stockmin` int(11) DEFAULT NULL,
  `stockmax` int(11) DEFAULT NULL,
  `estado` char(10) DEFAULT 'activo',
  PRIMARY KEY (`cod_generico`)
) ENGINE=InnoDB AUTO_INCREMENT=260 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `producto`
--

LOCK TABLES `producto` WRITE;
/*!40000 ALTER TABLE `producto` DISABLE KEYS */;
INSERT INTO `producto` VALUES (1,'Aciclovir','dolor','',0,0,'activo'),(2,'Agua para inyeccion',NULL,NULL,0,0,'activo'),(3,'Amoxicilina',NULL,NULL,0,0,'activo'),(4,'Amoxicilina + inhibidor betalactamasa',NULL,NULL,0,0,'activo'),(5,'Antigripal (Paracetamol + Antihistaminico + Vasoconstrictor con o sin Cafeina)',NULL,NULL,0,0,'activo'),(6,'Bacitracina + Neomicina sulfato',NULL,NULL,0,0,'activo'),(7,'Bencilpenicilina benzatinica',NULL,NULL,0,0,'activo'),(8,'Betametasona (fosfato)',NULL,NULL,0,0,'activo'),(9,'Bicarbonato de sodio',NULL,NULL,0,0,'activo'),(10,'Bisacodilo',NULL,NULL,0,0,'activo'),(11,'Butilbromuro de Hioscina (Butilescopolamina)',NULL,NULL,0,0,'activo'),(12,'Carbamazepina',NULL,NULL,0,0,'activo'),(13,'Carbon medicinal activado',NULL,NULL,0,0,'activo'),(14,'Ceftriaxona',NULL,NULL,0,0,'activo'),(15,'Ciprofloxacina',NULL,NULL,0,0,'activo'),(16,'Cloranfenicol',NULL,NULL,0,0,'activo'),(17,'Clorfenamina (Clorfeniramina)',NULL,NULL,0,0,'activo'),(18,'Clotrimazol',NULL,NULL,0,0,'activo'),(19,'Colecalciferol (Vitamina D3)',NULL,NULL,0,0,'activo'),(20,'Complejo B (B1 + B6 + B12)',NULL,NULL,0,0,'activo'),(21,'Complemento nutricional (Carmelo)',NULL,NULL,0,0,'activo'),(22,'Complemento nutricional (Nutri Mama con Ca?ahua',NULL,NULL,0,0,'activo'),(23,'Complemento nutricional (Nutribebe)',NULL,NULL,0,0,'activo'),(24,'Cotrimoxazol (Sulfametoxazol + Trimetoprima)',NULL,NULL,0,0,'activo'),(25,'Dexametasona',NULL,NULL,0,0,'activo'),(26,'Dextrometorfano bromhidrato',NULL,NULL,0,0,'activo'),(27,'Diazepam',NULL,NULL,0,0,'activo'),(28,'Diclofenaco Sodico',NULL,NULL,0,0,'activo'),(29,'Dicloxacilina sodica',NULL,NULL,0,0,'activo'),(30,'Enalapril maleato',NULL,NULL,0,0,'activo'),(31,'Epinefrina (Adrenalina)',NULL,NULL,0,0,'activo'),(32,'Ergometrina maleato',NULL,NULL,0,0,'activo'),(33,'Eritromicina (estearato)',NULL,NULL,0,0,'activo'),(34,'Eritromicina (etilsuccinato)',NULL,NULL,0,0,'activo'),(35,'Fibra natural',NULL,NULL,0,0,'activo'),(36,'Fitomenadiona (Vitamina K1)',NULL,NULL,0,0,'activo'),(37,'Furosemida',NULL,NULL,0,0,'activo'),(38,'Gentamicina',NULL,NULL,0,0,'activo'),(39,'Gentamicina sulfato',NULL,NULL,0,0,'activo'),(40,'Glicerol (Glicerina)',NULL,NULL,0,0,'activo'),(41,'Hidroclorotiazida',NULL,NULL,0,0,'activo'),(42,'Hidrocortisona acetato',NULL,NULL,0,0,'activo'),(43,'Hidrocortisona succinato sodico',NULL,NULL,0,0,'activo'),(44,'Hidroxido de aluminio y magnesio',NULL,NULL,0,0,'activo'),(45,'Ibuprofeno',NULL,NULL,0,0,'activo'),(46,'Indometacina',NULL,NULL,0,0,'activo'),(47,'Ketorolaco',NULL,NULL,0,0,'activo'),(48,'Lactulosa',NULL,NULL,0,0,'activo'),(49,'Lagrimas artificiales',NULL,NULL,0,0,'activo'),(50,'Levonorgestrel',NULL,NULL,0,0,'activo'),(51,'Levonorgestrel + Etinilestradiol',NULL,NULL,0,0,'activo'),(52,'Lidocaina',NULL,NULL,0,0,'activo'),(53,'Lidocaina clorhidrato sin conservante',NULL,NULL,0,0,'activo'),(54,'Losartan',NULL,NULL,0,0,'activo'),(55,'Mebendazol',NULL,NULL,0,0,'activo'),(56,'Medroxiprogesterona acetato',NULL,NULL,0,0,'activo'),(57,'Metamizol (Dipirona)',NULL,NULL,0,0,'activo'),(58,'Metildopa (Alfametildopa)',NULL,NULL,0,0,'activo'),(59,'Metoclopramida',NULL,NULL,0,0,'activo'),(60,'Micronutrientes (Vit.C+Vit.A+Fe+Zn+Ac.Folico) (Chispitas nutricionales)',NULL,NULL,0,0,'activo'),(61,'Multivitaminas',NULL,NULL,0,0,'activo'),(62,'Nifedipino',NULL,NULL,0,0,'activo'),(63,'Nistatina',NULL,NULL,0,0,'activo'),(64,'Nitrofurantoina',NULL,NULL,0,0,'activo'),(65,'Omeprazol',NULL,NULL,0,0,'activo'),(66,'Oxido de Zinc con o sin aceite',NULL,NULL,0,0,'activo'),(67,'Oxitocina',NULL,NULL,0,0,'activo'),(68,'Paracetamol (Acetaminofeno)',NULL,NULL,0,0,'activo'),(69,'Peroxido de hidrogeno (Agua oxigenada)',NULL,NULL,0,0,'activo'),(70,'Pirantel pamoato',NULL,NULL,0,0,'activo'),(71,'Ranitidina',NULL,NULL,0,0,'activo'),(72,'Retinol (Vitamina A)',NULL,NULL,0,0,'activo'),(73,'Salbutamol',NULL,NULL,0,0,'activo'),(74,'Sales de rehidratacion oral (SRO) baja osmolaridad',NULL,NULL,0,0,'activo'),(75,'Solucion de glucosa',NULL,NULL,0,0,'activo'),(76,'Solucion Fisiologica',NULL,NULL,0,0,'activo'),(77,'Solucion ringer lactato',NULL,NULL,0,0,'activo'),(78,'Sulfato de Magnesio',NULL,NULL,0,0,'activo'),(79,'Sulfato ferroso + Ac. Folico + Vitamina C',NULL,NULL,0,0,'activo'),(80,'Unguento dermico eucalipto mentol',NULL,NULL,0,0,'activo'),(81,'Violeta de genciana (Cloruro de metilrosanilina)',NULL,NULL,0,0,'activo'),(82,'Zinc (como sulfato)',NULL,NULL,0,0,'activo'),(83,'Aguja corta para carpule',NULL,NULL,0,0,'activo'),(84,'Alcohol medicinal 70% 1000 ml.',NULL,NULL,0,0,'activo'),(85,'Algodon 400 g.',NULL,NULL,0,0,'activo'),(86,'Baja lengua adultos',NULL,NULL,0,0,'activo'),(87,'Barbijo descartable',NULL,NULL,0,0,'activo'),(88,'Branula N° 18',NULL,NULL,0,0,'activo'),(89,'Branula N° 20',NULL,NULL,0,0,'activo'),(90,'Branula N° 22',NULL,NULL,0,0,'activo'),(91,'Branula N° 24',NULL,NULL,0,0,'activo'),(92,'Catgut cromado N° 1 c./aguja T-8',NULL,NULL,0,0,'activo'),(93,'Cepillo dental (Adulto)',NULL,NULL,0,0,'activo'),(94,'Cepillo dental (Pediatrico)',NULL,NULL,0,0,'activo'),(95,'Cepillo endocervical (Citobrush descartable)',NULL,NULL,0,0,'activo'),(96,'Clamp umbilical',NULL,NULL,0,0,'activo'),(97,'Condon Masculino',NULL,NULL,0,0,'activo'),(98,'Cubre objetos 20 x 20 para 100',NULL,NULL,0,0,'activo'),(99,'Equipo de venoclisis c/aguja Nº 21 G 1 ½',NULL,NULL,0,0,'activo'),(100,'Espatulas de Ayre',NULL,NULL,0,0,'activo'),(101,'Especulo descartable M',NULL,NULL,0,0,'activo'),(102,'Gasa esteril 20 x 24 x 90',NULL,NULL,0,0,'activo'),(103,'Guantes descartables Nº 6 ½',NULL,NULL,0,0,'activo'),(104,'Guantes descartables N° 7',NULL,NULL,0,0,'activo'),(105,'Guantes quirurgicos descartables Nº 7 ½',NULL,NULL,0,0,'activo'),(106,'Hoja de bisturi N° 12',NULL,NULL,0,0,'activo'),(107,'Jeringa 1 ml. c./aguja Nº 26 G x 1/2 p/Vitamina K',NULL,NULL,0,0,'activo'),(108,'Jeringa descartabe 10 ml. c./aguja',NULL,NULL,0,0,'activo'),(109,'Jeringa descartable 20 ml. c./aguja',NULL,NULL,0,0,'activo'),(110,'Jeringa descartable 3 ml. c./aguja',NULL,NULL,0,0,'activo'),(111,'Jeringa descartable 5 ml. c./aguja',NULL,NULL,0,0,'activo'),(112,'Lancetas esteriles de pulpejo de dedo',NULL,NULL,0,0,'activo'),(113,'Nylon (3/0)',NULL,NULL,0,0,'activo'),(114,'Nylon (5/0)',NULL,NULL,0,0,'activo'),(115,'Pasta dental (Adulto)',NULL,NULL,0,0,'activo'),(116,'Pasta dental (Pediatrico)',NULL,NULL,0,0,'activo'),(117,'Porta objetos 25 mm. x 75 mm.',NULL,NULL,0,0,'activo'),(118,'Radiografias Periapicales (Adulto)',NULL,NULL,0,0,'activo'),(119,'Sonda foley 2 vias N° 16',NULL,NULL,0,0,'activo'),(120,'Tela adhesiva 7.5 cm. x 5 m.',NULL,NULL,0,0,'activo'),(121,'Venda de gasa 10 cm.',NULL,NULL,0,0,'activo'),(122,'Venda de gasa 5 cm.',NULL,NULL,0,0,'activo'),(123,'Venda elastica 10 cm.',NULL,NULL,0,0,'activo'),(124,'Buffer de HIV 1+2',NULL,NULL,0,0,'activo'),(125,'Creatinina',NULL,NULL,0,0,'activo'),(126,'Glicemia',NULL,NULL,0,0,'activo'),(127,'Grupo sanguineo A',NULL,NULL,0,0,'activo'),(128,'Prueba rapida VIH',NULL,NULL,0,0,'activo'),(129,'Reactivo de Vidal',NULL,NULL,0,0,'activo'),(130,'Test de embarazo en tacos',NULL,NULL,0,0,'activo'),(131,'Tiras reactivas para orina',NULL,NULL,0,0,'activo'),(132,'Uremia c/ Ureasa',NULL,NULL,0,0,'activo'),(133,'ACIDO GRAVADO',NULL,NULL,0,0,'activo'),(134,'ADESIVO',NULL,NULL,0,0,'activo'),(135,'GUANTES DE NITRILO TALLA M',NULL,NULL,0,0,'activo'),(136,'RESINA DE FOTOCURABLE',NULL,NULL,0,0,'activo'),(137,'TRAJE DE BIOSEGURIDAD',NULL,NULL,0,0,'activo'),(138,'EPTA ANTICUAGULANTE',NULL,NULL,0,0,'activo'),(139,'HAI CHAGAS',NULL,NULL,0,0,'activo'),(140,'HAI TOXOPLASMOCIS',NULL,NULL,0,0,'activo'),(141,'PROTEINA C REACTIVA',NULL,NULL,0,0,'activo'),(142,'TIEMPO DE PROTROMBINA',NULL,NULL,0,0,'activo'),(143,'TINSION PANOPTICO',NULL,NULL,0,0,'activo'),(256,'Complemento nutricional (Nutri Mama con Cañahua, probiótico y Omega-3)','dolores','v1',0,0,'activo'),(258,'nuevo','nuevo','v3',0,0,'activo'),(259,'nuevo','nuevo','v4',1,2,'activo');
/*!40000 ALTER TABLE `producto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `registro_diario`
--

DROP TABLE IF EXISTS `registro_diario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `registro_diario` (
  `cod_rd` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_rd` date DEFAULT NULL,
  `hora_rd` time DEFAULT NULL,
  `servicio_rd` int(11) DEFAULT NULL,
  `signo_sintomas_rd` char(100) DEFAULT NULL,
  `historial_clinico_rd` char(10) DEFAULT NULL,
  `fecha_retorno_historia_rd` date DEFAULT NULL,
  `pe_brinda_atencion_rd` int(11) DEFAULT NULL,
  `resp_admision_rd` int(11) DEFAULT NULL,
  `paciente_rd` int(11) NOT NULL,
  `cod_cds` int(11) NOT NULL,
  `estado` char(15) DEFAULT NULL,
  PRIMARY KEY (`cod_rd`,`paciente_rd`,`cod_cds`),
  KEY `servicio_rd` (`servicio_rd`),
  KEY `pe_brinda_atencion_rd` (`pe_brinda_atencion_rd`),
  KEY `resp_admision_rd` (`resp_admision_rd`),
  KEY `paciente_rd` (`paciente_rd`),
  KEY `cod_cds` (`cod_cds`),
  CONSTRAINT `registro_diario_ibfk_1` FOREIGN KEY (`servicio_rd`) REFERENCES `servicio` (`cod_servicio`),
  CONSTRAINT `registro_diario_ibfk_2` FOREIGN KEY (`pe_brinda_atencion_rd`) REFERENCES `usuario` (`cod_usuario`),
  CONSTRAINT `registro_diario_ibfk_3` FOREIGN KEY (`resp_admision_rd`) REFERENCES `usuario` (`cod_usuario`),
  CONSTRAINT `registro_diario_ibfk_4` FOREIGN KEY (`paciente_rd`) REFERENCES `usuario` (`cod_usuario`),
  CONSTRAINT `registro_diario_ibfk_5` FOREIGN KEY (`cod_cds`) REFERENCES `centro_de_salud` (`cod_cds`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registro_diario`
--

LOCK TABLES `registro_diario` WRITE;
/*!40000 ALTER TABLE `registro_diario` DISABLE KEYS */;
INSERT INTO `registro_diario` VALUES (1,'2024-02-05','10:08:00',1,'no','no','0000-00-00',3,2,5,1,'activo'),(2,'2024-05-24','10:08:00',1,'no','no','0000-00-00',3,2,6,1,'activo'),(3,'2024-05-24','10:08:00',1,'no','si','0000-00-00',3,2,7,1,'activo'),(6,'2024-07-30','00:45:31',3,'no','no','2024-07-27',3,2,15,1,'activo');
/*!40000 ALTER TABLE `registro_diario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `servicio`
--

DROP TABLE IF EXISTS `servicio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `servicio` (
  `cod_servicio` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_servicio` varchar(100) DEFAULT NULL,
  `descripcion_servicio` varchar(100) DEFAULT NULL,
  `estado` char(10) DEFAULT NULL,
  PRIMARY KEY (`cod_servicio`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servicio`
--

LOCK TABLES `servicio` WRITE;
/*!40000 ALTER TABLE `servicio` DISABLE KEYS */;
INSERT INTO `servicio` VALUES (1,'Enfermería','encargado de vacunas y otros','activo'),(2,'Consultorio Odontológico','encargado de la salud de los dientes','activo'),(3,'Servicio del PAI','pai','activo'),(4,'Crecimiento y desarrollo','','activo'),(5,'Consultorio Médico','','activo'),(6,'Farmacia','medicamentos y mas','activo');
/*!40000 ALTER TABLE `servicio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `cod_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `ci_usuario` int(11) DEFAULT NULL,
  `usuario` char(60) DEFAULT NULL,
  `nombre_usuario` char(60) DEFAULT NULL,
  `ap_usuario` char(60) DEFAULT NULL,
  `am_usuario` char(60) DEFAULT NULL,
  `fecha_nac_usuario` date DEFAULT NULL,
  `edad_usuario` int(11) DEFAULT NULL,
  `telefono_usuario` int(11) DEFAULT NULL,
  `direccion_usuario` char(200) DEFAULT NULL,
  `profesion_usuario` char(60) DEFAULT NULL,
  `especialidad_usuario` char(60) DEFAULT NULL,
  `ocupacion_usuario` char(60) DEFAULT NULL,
  `comunidad_usuario` char(100) DEFAULT NULL,
  `estado_civil_usuario` char(60) DEFAULT NULL,
  `escolaridad_usuario` char(100) DEFAULT NULL,
  `autoidentificacion_usuario` char(45) DEFAULT NULL,
  `nro_seguro_usuario` char(150) DEFAULT NULL,
  `nro_car_form_usuario` char(200) DEFAULT NULL,
  `sexo_usuario` char(20) DEFAULT NULL,
  `tipo_usuario` char(60) DEFAULT NULL,
  `contrasena_usuario` char(250) DEFAULT NULL,
  `cod_cds` int(11) DEFAULT NULL,
  `estado` char(15) DEFAULT NULL,
  PRIMARY KEY (`cod_usuario`),
  KEY `cod_cds` (`cod_cds`),
  CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`cod_cds`) REFERENCES `centro_de_salud` (`cod_cds`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,7308752,'encargado','Noelia','Mamani','Nina','0000-00-00',0,78451256,'calle La paz entre linares','Licenciada en enfermeria','enfermera','','','','','','','','','encargado','$2y$10$UiDpH8cKEP8Fo6ogkfqnlOuk2c1tvqm8s0MKLQ1pmCCFWbdqBfn6W',1,'activo'),(2,75451256,'admision','Sandra','Huanca','Nina','0000-00-00',0,63258974,'calle brasil','medico','Pediatra','','','','','','','','','admision','$2y$10$wEhNpR35jTOKFqK7sLRAaOCcvXYYiqqY9znZwGqAJgdC6PZqkGwNK',1,'activo'),(3,75451256,'medico','Salome','mamani','romina','0000-00-00',0,63258974,'calle brasil','medico','Pediatra','','','','','','','','','medico','$2y$10$Uo.szMVEPkBINp.2FrLnk.M0NjZRqCQRZw6PohOy9RRp2YvQc8rfS',1,'activo'),(4,72354512,'admin','Carlos','Mamani','Lopes','0000-00-00',0,63247512,'calle ecuador en tre la paz','Ingeniero informatico','computacion','','','','','','','','','admin','$2y$10$HcDmz5/npUWmiwxbW0QK8.fp2fvu0xcbAU8McwvvJDRBf29TvuroS',1,'activo'),(5,0,'','juan jose','Romay','Titi','1992-02-04',32,0,'Z1','','','','','','','','','','','paciente','',1,'activo'),(6,0,'','Gustavo','Mamani','Nina','1992-02-04',32,0,'Z2','','','','','','','','','','','paciente','',1,'activo'),(7,0,'garbriela','Gabriela','Romay','Calani','1992-02-04',32,0,'Z2','','','','','','','','','','','paciente','$2y$10$0cboj3kad4yJ6zCkUwcKyO87SU1XhwykoKc6AibZl1AeqtIHNZoim',1,'activo'),(8,0,'','Hernan','Lopes','Peres','1992-02-04',32,63260832,'Z2','','','panadero','cala cala','casado','secundaria','quechua','4545-asdf-45123','1222','Masculino','responsable','',1,'activo'),(9,0,'','ruben','mamani','nina','1999-02-22',25,0,'calle oruro','','','','','','','','','','','paciente','',1,'activo'),(10,0,'','carol','lipiri','pacheco','1999-02-22',4,0,'calle la paz','','','','','','','','','','','paciente','',1,'activo'),(11,0,'','maria','lipiri','vecerra','1999-02-22',45,0,'calle oruro','','','','','','','','','','','paciente','',1,'activo'),(12,456456,'monica','carlos','nose','romay','0000-00-00',0,65465,'z1','doctor','medico cirujano',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'medico','$2y$10$M18YziNcP1ohOCCxMl.mNuQMlJ8OCRe6cJB4bcLFA5hNeEdprN/qe',1,'activo'),(13,0,'e','caslor','mama','nina','2022-02-22',45,0,'z1','','','','','','','','','','','paciente','$2y$10$L9EePZeyyJ7lNihmWluRres84OBCZ.S9romHkmC1H1fFBNIVcm4nK',1,'activo'),(14,0,'','caslor','mama','nina','2022-02-22',45,0,'z1','','','','','','','','','','','paciente','',1,'activo'),(15,0,'','carlos','jkljl','jklj','2221-02-22',45,0,'jkl','','','','','','','','','','','paciente','',1,'activo'),(16,7845123,'Romay','romer','canaviri','lipiri','0000-00-00',0,65124512,'calle la paz','cirujano','toso',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'medico','$2y$10$tlLGT477h2Iv.j.wgW4EFue05XCNrQVnslfd9ABRSe75IT8K4JS3u',1,'activo'),(17,78451256,'farmacia','ruben','matias','ticona','0000-00-00',0,6325214,'calle la paz','farmaceutico','farmacia',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'farmacia','$2y$10$B2AvBcP3giYZWx6PbZJ1j.Fp6khQs4RPJ284a6IkyaZtD3mggQdDu',1,'activo'),(18,7896,'uno','nuo','nk','jkljl','0000-00-00',0,546546,'calle la paz','ss','ningunass',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'farmacia','$2y$10$zs.QjAKfeiC2sms.n51SV.7FV1eVaH4QGhuD8pIYvinSF0swMBe5i',1,'activo'),(19,789456,'javier','javier','nina','ticona','0000-00-00',0,45463,'calle la pas','farmacia','ninguna',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'farmacia','$2y$10$QKs.T5tfUH3Q/1nCtIQtuOllCme1m/P7BCkaVg8iPMvPQLM.OGwC6',1,'activo'),(20,78451256,'rolo','ruben','mamani','titi','0000-00-00',0,63254178,'calle la paz','farmaceutico','ninguna',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'farmacia','$2y$10$oEF7XORdaOJ7aIprfVRWuu.Ek1jdEcbZejH6GDNq4thqFXP2pdoAa',1,'activo'),(21,41546,'farmaci','hjk','hjk','hj','0000-00-00',0,1231,'d','hjk','hk',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'farmacia','$2y$10$dKOhYdPOWb3LTLQnfkxRC.MSd.aEEZbozRNfcrmKFmA78OTIUWlbW',1,'activo'),(22,546,'farmaciaa','jkl','jklj','kjl','0000-00-00',0,456,'465465','46546546','546546',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'encargado','$2y$10$6bmlmzlFCnXEjM2xs5oWbuMisiAicLOx5cnf4IQ2MzWGq7GhXGccG',1,'activo'),(23,78451521,'alicia','alicia','mamani','nina','0000-00-00',0,62451278,'calle oruro','farmaceutica','ninguna',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'farmacia','$2y$10$WXROtLhBdqTj5LDm1MFwjO7PxVZVd0an4rOFRbJh231EBEP/CxTB2',1,'activo'),(24,78451245,'mario','mario','diaz','mamani','0000-00-00',0,63214578,'calle oruro','farmaceutico','ninguna',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'farmacia','$2y$10$sYynu25z5MNu8PAjJ3CrC.6JEVS/0jW17bMJEqVCPWqr8BZhRp8la',1,'activo');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-08-13 17:13:20
