-- MariaDB dump
-- Host: localhost    Database: cds
-- Server version 10.4.32-MariaDB

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

DROP TABLE IF EXISTS `centro_de_salud`;
CREATE TABLE `centro_de_salud` (
  `cod_cds` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_cds` char(200) DEFAULT NULL,
  `direccion_cds` char(200) DEFAULT NULL,
  `estado` char(15) DEFAULT NULL,
  PRIMARY KEY (`cod_cds`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `centro_de_salud`

LOCK TABLES `centro_de_salud` WRITE;
/*!40000 ALTER TABLE `centro_de_salud` DISABLE KEYS */;
INSERT INTO `centro_de_salud` VALUES("1","Centro de salud Cala cala","Cala cala","activo");
/*!40000 ALTER TABLE `centro_de_salud` ENABLE KEYS */;
UNLOCK TABLES;

DROP TABLE IF EXISTS `conc_uni_med`;
CREATE TABLE `conc_uni_med` (
  `cod_conc` int(11) NOT NULL AUTO_INCREMENT,
  `concentracion` char(60) DEFAULT NULL,
  `estado` char(10) DEFAULT 'activo',
  PRIMARY KEY (`cod_conc`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `conc_uni_med`

LOCK TABLES `conc_uni_med` WRITE;
/*!40000 ALTER TABLE `conc_uni_med` DISABLE KEYS */;
INSERT INTO `conc_uni_med` VALUES("1","800 mg + 160 mg","activo");
INSERT INTO `conc_uni_med` VALUES("2","200 mg + 40 mg/5 ml","activo");
INSERT INTO `conc_uni_med` VALUES("3","4 mg/ml","activo");
INSERT INTO `conc_uni_med` VALUES("4","10 mg/5 ml","activo");
INSERT INTO `conc_uni_med` VALUES("5","10 mg","activo");
INSERT INTO `conc_uni_med` VALUES("6","50 mg","activo");
INSERT INTO `conc_uni_med` VALUES("7","75 mg","activo");
INSERT INTO `conc_uni_med` VALUES("8","500 mg","activo");
INSERT INTO `conc_uni_med` VALUES("9","250 mg/5 ml","activo");
INSERT INTO `conc_uni_med` VALUES("10","1 mg/ml","activo");
INSERT INTO `conc_uni_med` VALUES("11","0","activo");
INSERT INTO `conc_uni_med` VALUES("12","Segun disponibilidad","activo");
INSERT INTO `conc_uni_med` VALUES("13","10 mg/ml","activo");
INSERT INTO `conc_uni_med` VALUES("14","40 mg","activo");
INSERT INTO `conc_uni_med` VALUES("15","0","activo");
INSERT INTO `conc_uni_med` VALUES("16","80 mg","activo");
INSERT INTO `conc_uni_med` VALUES("17","1 g a 1","activo");
INSERT INTO `conc_uni_med` VALUES("18","1%","activo");
INSERT INTO `conc_uni_med` VALUES("19","100 mg","activo");
INSERT INTO `conc_uni_med` VALUES("20","1:1","activo");
INSERT INTO `conc_uni_med` VALUES("21","400 mg","activo");
INSERT INTO `conc_uni_med` VALUES("22","100 mg/5 ml","activo");
INSERT INTO `conc_uni_med` VALUES("23","25 mg","activo");
INSERT INTO `conc_uni_med` VALUES("24","30 mg/ml","activo");
INSERT INTO `conc_uni_med` VALUES("25","65% a 67%","activo");
INSERT INTO `conc_uni_med` VALUES("26","0","activo");
INSERT INTO `conc_uni_med` VALUES("27","150 mg","activo");
INSERT INTO `conc_uni_med` VALUES("28","0","activo");
INSERT INTO `conc_uni_med` VALUES("29","2%","activo");
INSERT INTO `conc_uni_med` VALUES("30","150 mg/ml","activo");
INSERT INTO `conc_uni_med` VALUES("31","1 g","activo");
INSERT INTO `conc_uni_med` VALUES("32","10 mg / 2 ml","activo");
INSERT INTO `conc_uni_med` VALUES("33","Segun concentracion estandar","activo");
INSERT INTO `conc_uni_med` VALUES("34","100.000 UI/g","activo");
INSERT INTO `conc_uni_med` VALUES("35","500.000 UI/5 ml","activo");
INSERT INTO `conc_uni_med` VALUES("36","25 mg/5 ml","activo");
INSERT INTO `conc_uni_med` VALUES("37","20 mg","activo");
INSERT INTO `conc_uni_med` VALUES("38","Segun disponibilidad","activo");
INSERT INTO `conc_uni_med` VALUES("39","5 UI/ml o 10 UI/ml","activo");
INSERT INTO `conc_uni_med` VALUES("40","100 mg/ml","activo");
INSERT INTO `conc_uni_med` VALUES("41","120 mg/5 ml o 125 mg/5 ml","activo");
INSERT INTO `conc_uni_med` VALUES("42","2% o 3%","activo");
INSERT INTO `conc_uni_med` VALUES("43","250 mg/5 ml","activo");
INSERT INTO `conc_uni_med` VALUES("44","100.000 UI","activo");
INSERT INTO `conc_uni_med` VALUES("45","200.000 UI","activo");
INSERT INTO `conc_uni_med` VALUES("46","0","activo");
INSERT INTO `conc_uni_med` VALUES("47","5% (1.000 ml)","activo");
INSERT INTO `conc_uni_med` VALUES("48","0","activo");
INSERT INTO `conc_uni_med` VALUES("49","1.000 ml","activo");
INSERT INTO `conc_uni_med` VALUES("50","10%","activo");
INSERT INTO `conc_uni_med` VALUES("51","200 mg + 0","activo");
INSERT INTO `conc_uni_med` VALUES("52","1%","activo");
INSERT INTO `conc_uni_med` VALUES("53","20 mg/5 ml","activo");
INSERT INTO `conc_uni_med` VALUES("54","Pieza","activo");
INSERT INTO `conc_uni_med` VALUES("55","Frasco","activo");
INSERT INTO `conc_uni_med` VALUES("56","Paquete","activo");
INSERT INTO `conc_uni_med` VALUES("57","Sobre","activo");
INSERT INTO `conc_uni_med` VALUES("58","Caja","activo");
INSERT INTO `conc_uni_med` VALUES("59","Rollo","activo");
INSERT INTO `conc_uni_med` VALUES("60","Tubo","activo");
INSERT INTO `conc_uni_med` VALUES("61","Kit","activo");
INSERT INTO `conc_uni_med` VALUES("62","Determinacion","activo");
INSERT INTO `conc_uni_med` VALUES("63","37%","activo");
INSERT INTO `conc_uni_med` VALUES("64","0","activo");
INSERT INTO `conc_uni_med` VALUES("65","UNIDAD","activo");
INSERT INTO `conc_uni_med` VALUES("66","SOLUCION","activo");
INSERT INTO `conc_uni_med` VALUES("67","DETERMINACIONES SOLUCION","activo");
/*!40000 ALTER TABLE `conc_uni_med` ENABLE KEYS */;
UNLOCK TABLES;

DROP TABLE IF EXISTS `consultas`;
CREATE TABLE `consultas` (
  `cod_cons` int(11) NOT NULL AUTO_INCREMENT,
  `consulta` text DEFAULT NULL,
  `respuesta_consulta` text DEFAULT NULL,
  PRIMARY KEY (`cod_cons`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `consultas`

LOCK TABLES `consultas` WRITE;
/*!40000 ALTER TABLE `consultas` DISABLE KEYS */;
INSERT INTO `consultas` VALUES("1","hola","hola, en que puedo ayudarte");
INSERT INTO `consultas` VALUES("2","como estas","estoy bien y tu");
INSERT INTO `consultas` VALUES("3","yo estoy bien","que bien me alegra escuchar que estes bien");
INSERT INTO `consultas` VALUES("4","cual es tu nombre","mi nombre es chatBot cala cala");
INSERT INTO `consultas` VALUES("5","","en que mas podria ayudarte");
INSERT INTO `consultas` VALUES("6","Elije una de las opciones en las que te podria ayudar","");
INSERT INTO `consultas` VALUES("7","quisiera mas informacion sobre el centro de salud","le pido que especifique su consulta");
INSERT INTO `consultas` VALUES("8","como te llamas","me llamo chatbot cala cala");
INSERT INTO `consultas` VALUES("9","cual es tu nombre","me llamo chatbot cala cala");
INSERT INTO `consultas` VALUES("10","me podrias dar los horarios de atencion","los horarios de atencion son por la mañana desde las 8:30 a 12:00 y por la tarde de 14:00 a 18:00");
INSERT INTO `consultas` VALUES("11","como te encuentras","yo estoy bien");
INSERT INTO `consultas` VALUES("12","me podrias dar mas informacion sobre los horarios de atencion","los horarios de atencion son por la mañana desde las 8:30 a 12:00 y por la tarde de 14:00 a 18:00");
INSERT INTO `consultas` VALUES("13","informacion sobre los horarios de atencion","los horarios de atencion son por la mañana desde las 8:30 a 12:00 y por la tarde de 14:00 a 18:00");
INSERT INTO `consultas` VALUES("14","que es una enfermedad","Una enfermedad es una alteración o desviación del estado fisiológico en una o varias partes del cuerpo, que se manifiesta por un conjunto de síntomas y signos específicos. Estas alteraciones pueden ser causadas por diversos factores, como infecciones, genética, problemas ambientales, estilos de vida o condiciones degenerativas.");
INSERT INTO `consultas` VALUES("15","en que lugar se encuentra en centro de salud","se encuentra en el pueblo de cala cala");
INSERT INTO `consultas` VALUES("16","que es una vacuna o vacunas","Una vacuna es un producto biológico diseñado para proporcionar inmunidad contra una enfermedad específica. Funciona estimulando el sistema inmunológico del cuerpo para que produzca una respuesta protectora contra un patógeno, como una bacteria o un virus.");
INSERT INTO `consultas` VALUES("17","que es la gripe","La gripe, también conocida como influenza, es una infección respiratoria aguda causada por los virus de la influenza. Se caracteriza por síntomas como fiebre, tos, dolor de garganta, congestión nasal, dolores musculares, dolor de cabeza y fatiga. A menudo, también puede causar escalofríos, sudores y, en algunos casos, náuseas o vómitos. La gripe se transmite principalmente a través de gotas respiratorias que se expulsan al toser, estornudar o hablar, así como al tocar superficies contaminadas y luego llevarse las manos a la boca, nariz o ojos. Existen tres tipos principales de virus de la influenza que afectan a los humanos: A, B y C. Los virus tipo A y B son los que suelen causar las epidemias estacionales, mientras que el tipo C causa infecciones más leves y menos comunes.");
INSERT INTO `consultas` VALUES("18","muchas gracias","de nada, en que mas puedo ayudarte");
INSERT INTO `consultas` VALUES("19","que es una enfluenza","La influenza es el nombre científico para la gripe, una enfermedad respiratoria causada por los virus de la influenza. La influenza puede provocar una amplia gama de síntomas que incluyen: Fiebre: A menudo alta, aunque no siempre está presente. Tos: Generalmente seca y persistente. Dolor de garganta: A menudo asociado con la tos y la congestión. Congestión nasal: Nariz tapada o secreción nasal. Dolores musculares y corporales: Sensación de dolor en todo el cuerpo. Dolor de cabeza: Que puede ser intenso. Fatiga: Sensación de cansancio extremo y debilidad. Escalofríos y sudores: A veces acompañan a la fiebre. Náuseas o vómitos: Más comunes en niños que en adultos.");
INSERT INTO `consultas` VALUES("20","existe una farmacia en el centro de salud","si contamos con una farmacia en el centro de salud, que esta a disposicion de todos los pacientes que lo necesiten.");
INSERT INTO `consultas` VALUES("21","que tipos de enfermedad o enfermedades existen o hay en el mundo","Las enfermedades se pueden clasificar de diversas maneras según sus características, causas y efectos en el cuerpo. Aquí hay una visión general de algunas de las principales categorías de enfermedades: 1. Enfermedades Infecciosas Estas son causadas por organismos patógenos como bacterias, virus, hongos o parásitos. Ejemplos incluyen: - Bacterianas: Tuberculosis, neumonía, salmonella. - Virales: Gripe, VIH/SIDA, hepatitis. - Fúngicas: Candidiasis, aspergilosis. - Parasitarias: Malaria, giardiasis. 2. Enfermedades Crónicas Son enfermedades de larga duración que suelen progresar lentamente y pueden durar toda la vida. Ejemplos incluyen: - Enfermedades Cardiovasculares: Hipertensión, enfermedad coronaria. - Diabetes: Tipo 1 y Tipo 2. - Enfermedades Respiratorias Crónicas: Asma, EPOC (Enfermedad Pulmonar Obstructiva Crónica). 3. Enfermedades Agudas Estas enfermedades tienen un inicio rápido y suelen durar poco tiempo, aunque pueden ser graves. Ejemplos incluyen: - Infartos: Infarto agudo de miocardio. - Gastroenteritis: Infección del estómago y los intestinos. - Apéndice: Apendicitis. 4. Enfermedades Genéticas Causadas por alteraciones en los genes o cromosomas. Pueden ser hereditarias o surgir de mutaciones espontáneas. Ejemplos incluyen: - Síndrome de Down: Causa retraso en el desarrollo y discapacidad intelectual. - Fibrosis Quística: Enfermedad genética que afecta los pulmones y el sistema digestivo. - Hemofilia: Trastorno de la coagulación de la sangre. 5. Enfermedades Autoinmunes En estas enfermedades, el sistema inmunológico ataca las células del propio cuerpo por error. Ejemplos incluyen: - Artritis Reumatoide: Afecta las articulaciones. - Lupus Eritematoso Sistémico: Afecta múltiples sistemas del cuerpo. - Esclerosis Múltiple: Afecta el sistema nervioso central. 6. Enfermedades Neoplásicas Incluyen cánceres y tumores, que resultan del crecimiento anormal de células. Ejemplos incluyen: - Cáncer de Pulmón: Crecimiento maligno en los pulmones. - Leucemia: Cáncer de la sangre. - Melanoma: Tipo de cáncer de piel. 7. Enfermedades Metabólicas Estas enfermedades afectan los procesos metabólicos del cuerpo. Ejemplos incluyen: - Hipotiroidismo: Disminución de la actividad de la glándula tiroides. - Enfermedad de Gaucher: Trastorno del metabolismo de lípidos. - Fenilcetonuria: Trastorno del metabolismo de aminoácidos.");
INSERT INTO `consultas` VALUES("22","que es una alergia","Una alergia es una reacción del sistema inmunológico a sustancias que generalmente son inofensivas para la mayoría de las personas, conocidas como alérgenos. Cuando una persona con alergias entra en contacto con un alérgeno, su sistema inmunológico lo identifica erróneamente como una amenaza y responde de manera exagerada, causando una serie de síntomas que pueden variar desde leves hasta graves. Los alérgenos comunes incluyen polen, ácaros del polvo, moho, caspa de animales, ciertos alimentos, picaduras de insectos y medicamentos. Los síntomas de una alergia pueden incluir: - Estornudos: Frecuentemente acompañados de secreción nasal o congestión. - Picazón y enrojecimiento de los ojos: Conjuntivitis alérgica. - Erupciones cutáneas: Como urticaria o eczema. - Congestión nasal: Con o sin secreción. - Tos y dificultad para respirar: En el caso de alergias respiratorias, como el asma alérgico. - Hinchazón: Especialmente en la cara o en la garganta, que puede ser grave en casos de anafilaxia, una reacción alérgica severa y potencialmente mortal.");
INSERT INTO `consultas` VALUES("23","hay un medidor de glucosa","si contamos con medidor de glucosa en el centro de salud, el cual se encuentra en el area de laboratorios");
INSERT INTO `consultas` VALUES("24","me puedes indicar los horarios de atencion del centro de salud","los horarios de atencion son de lunes a viernes desde las 8:30 a 12:00 y por la tarde de 14:00 a 18:00");
INSERT INTO `consultas` VALUES("25","que medicamentos tiene el centro de salud","el centro de salud cuenta con una variedad de medicamentos, desde analgesicos y antibioticos hasta medicamentos especializados. si necesita informacion especifica sobre un medicamento, por favor comuniquese con el personal de la farmacia del centro.");
/*!40000 ALTER TABLE `consultas` ENABLE KEYS */;
UNLOCK TABLES;

DROP TABLE IF EXISTS `entrada`;
CREATE TABLE `entrada` (
  `cod_entrada` int(11) NOT NULL AUTO_INCREMENT,
  `cantidad` int(11) DEFAULT NULL,
  `respaldo_cantidad` int(11) DEFAULT NULL,
  `manipulado` char(3) DEFAULT NULL,
  `nrolote` char(20) DEFAULT NULL,
  `costounitario` decimal(10,2) DEFAULT NULL,
  `costototal` decimal(10,2) DEFAULT NULL,
  `costototal_respaldo` decimal(10,2) DEFAULT NULL,
  `vencimiento` date DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `cod_usuario` int(11) DEFAULT NULL,
  `cod_generico` int(11) DEFAULT NULL,
  `estado_producto` char(50) DEFAULT 'activo',
  `estado` char(10) DEFAULT 'activo',
  PRIMARY KEY (`cod_entrada`),
  KEY `cod_usuario` (`cod_usuario`),
  KEY `cod_generico` (`cod_generico`),
  CONSTRAINT `entrada_ibfk_1` FOREIGN KEY (`cod_usuario`) REFERENCES `usuario` (`cod_usuario`),
  CONSTRAINT `entrada_ibfk_2` FOREIGN KEY (`cod_generico`) REFERENCES `producto` (`cod_generico`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `entrada`

LOCK TABLES `entrada` WRITE;
/*!40000 ALTER TABLE `entrada` DISABLE KEYS */;
/*!40000 ALTER TABLE `entrada` ENABLE KEYS */;
UNLOCK TABLES;

DROP TABLE IF EXISTS `forma_presentacion`;
CREATE TABLE `forma_presentacion` (
  `cod_forma` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_forma` char(150) DEFAULT NULL,
  `estado` char(10) DEFAULT 'activo',
  PRIMARY KEY (`cod_forma`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `forma_presentacion`

LOCK TABLES `forma_presentacion` WRITE;
/*!40000 ALTER TABLE `forma_presentacion` DISABLE KEYS */;
INSERT INTO `forma_presentacion` VALUES("1","Comprimido","activo");
INSERT INTO `forma_presentacion` VALUES("2","Inyectable","activo");
INSERT INTO `forma_presentacion` VALUES("3","Suspension","activo");
INSERT INTO `forma_presentacion` VALUES("4","Crema o Pomada","activo");
INSERT INTO `forma_presentacion` VALUES("5","Polvo","activo");
INSERT INTO `forma_presentacion` VALUES("6","Solucion oftalmica","activo");
INSERT INTO `forma_presentacion` VALUES("7","Jarabe","activo");
INSERT INTO `forma_presentacion` VALUES("8","Ovulo","activo");
INSERT INTO `forma_presentacion` VALUES("9","Comprimido o Capsula blanda","activo");
INSERT INTO `forma_presentacion` VALUES("10","Capsula","activo");
INSERT INTO `forma_presentacion` VALUES("11","Comprimido ranurado","activo");
INSERT INTO `forma_presentacion` VALUES("12","Capsula o Comprimido","activo");
INSERT INTO `forma_presentacion` VALUES("13","Polvo o granulado","activo");
INSERT INTO `forma_presentacion` VALUES("14","Supositorio","activo");
INSERT INTO `forma_presentacion` VALUES("15","Solucion oral","activo");
INSERT INTO `forma_presentacion` VALUES("16","Implante subdermico","activo");
INSERT INTO `forma_presentacion` VALUES("17","Cartucho dental","activo");
INSERT INTO `forma_presentacion` VALUES("18","Comprimido o Capsula","activo");
INSERT INTO `forma_presentacion` VALUES("19","Pasta o Pomada","activo");
INSERT INTO `forma_presentacion` VALUES("20","Gotas","activo");
INSERT INTO `forma_presentacion` VALUES("21","Solucion","activo");
INSERT INTO `forma_presentacion` VALUES("22","Capsula o Perla","activo");
INSERT INTO `forma_presentacion` VALUES("23","Aerosol","activo");
INSERT INTO `forma_presentacion` VALUES("24","Sobres","activo");
INSERT INTO `forma_presentacion` VALUES("25","Solucion parenteral de gran volumen","activo");
INSERT INTO `forma_presentacion` VALUES("26","Unguento o crema","activo");
INSERT INTO `forma_presentacion` VALUES("27","Sobre esteril","activo");
INSERT INTO `forma_presentacion` VALUES("28","Paquete","activo");
INSERT INTO `forma_presentacion` VALUES("29","Pieza","activo");
INSERT INTO `forma_presentacion` VALUES("30","Unidad","activo");
INSERT INTO `forma_presentacion` VALUES("31","Sobre","activo");
INSERT INTO `forma_presentacion` VALUES("32","Caja x 100","activo");
INSERT INTO `forma_presentacion` VALUES("33","Rollo 100 yds.","activo");
INSERT INTO `forma_presentacion` VALUES("34","Par","activo");
INSERT INTO `forma_presentacion` VALUES("35","Tubo 50 g.","activo");
INSERT INTO `forma_presentacion` VALUES("36","Placa","activo");
INSERT INTO `forma_presentacion` VALUES("37","Carrete","activo");
INSERT INTO `forma_presentacion` VALUES("38","Rollo","activo");
INSERT INTO `forma_presentacion` VALUES("39","Frasco","activo");
INSERT INTO `forma_presentacion` VALUES("40","Kit x 250 determinaciones","activo");
INSERT INTO `forma_presentacion` VALUES("41","Kit x 3 frascos x 10 ml c/u","activo");
INSERT INTO `forma_presentacion` VALUES("42","Determinacion","activo");
INSERT INTO `forma_presentacion` VALUES("43","Frasco 4 x 10 ml","activo");
INSERT INTO `forma_presentacion` VALUES("44","Frasco x 100 unidades","activo");
INSERT INTO `forma_presentacion` VALUES("45","Kit x 100 determinaciones","activo");
INSERT INTO `forma_presentacion` VALUES("46","TUBO","activo");
INSERT INTO `forma_presentacion` VALUES("47","PIEZAS","activo");
INSERT INTO `forma_presentacion` VALUES("48","FRASCO 50 ML","activo");
INSERT INTO `forma_presentacion` VALUES("49","KIT X96","activo");
INSERT INTO `forma_presentacion` VALUES("50","KIT X 96","activo");
INSERT INTO `forma_presentacion` VALUES("51","KIT 50 ML","activo");
INSERT INTO `forma_presentacion` VALUES("52","KIT FRASCO 3 X500 ML","activo");
/*!40000 ALTER TABLE `forma_presentacion` ENABLE KEYS */;
UNLOCK TABLES;

DROP TABLE IF EXISTS `historial`;
CREATE TABLE `historial` (
  `cod_his` int(11) NOT NULL AUTO_INCREMENT,
  `zona_his` char(70) DEFAULT NULL,
  `cod_rd` int(11) DEFAULT NULL,
  `paciente_rd` int(11) DEFAULT NULL,
  `cod_cds` int(11) DEFAULT NULL,
  `cod_responsable_familia_his` int(11) DEFAULT NULL,
  `archivo` char(100) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `estado` char(20) DEFAULT NULL,
  PRIMARY KEY (`cod_his`),
  KEY `cod_rd` (`cod_rd`),
  KEY `paciente_rd` (`paciente_rd`),
  KEY `cod_cds` (`cod_cds`),
  KEY `cod_responsable_familia_his` (`cod_responsable_familia_his`),
  CONSTRAINT `historial_ibfk_1` FOREIGN KEY (`cod_rd`) REFERENCES `registro_diario` (`cod_rd`),
  CONSTRAINT `historial_ibfk_2` FOREIGN KEY (`paciente_rd`) REFERENCES `usuario` (`cod_usuario`),
  CONSTRAINT `historial_ibfk_3` FOREIGN KEY (`cod_cds`) REFERENCES `centro_de_salud` (`cod_cds`),
  CONSTRAINT `historial_ibfk_4` FOREIGN KEY (`cod_responsable_familia_his`) REFERENCES `usuario` (`cod_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `historial`

LOCK TABLES `historial` WRITE;
/*!40000 ALTER TABLE `historial` DISABLE KEYS */;
INSERT INTO `historial` VALUES("1","ZONA23","1","6","1","7","","2024-09-10","22:52:42","activo");
INSERT INTO `historial` VALUES("2","zona3","1","6","1","6","","2024-09-12","16:40:46","activo");
INSERT INTO `historial` VALUES("3","zona1","2","9","1","10","","2024-09-12","16:43:10","activo");
INSERT INTO `historial` VALUES("4","z1","3","11","1","12","","2024-09-13","15:53:58","activo");
/*!40000 ALTER TABLE `historial` ENABLE KEYS */;
UNLOCK TABLES;

DROP TABLE IF EXISTS `producto`;
CREATE TABLE `producto` (
  `cod_generico` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` char(20) DEFAULT NULL,
  `nombre` char(150) DEFAULT NULL,
  `enfermedad` char(150) DEFAULT '',
  `vitrina` char(30) DEFAULT NULL,
  `stockmin` int(11) DEFAULT NULL,
  `stockmax` int(11) DEFAULT NULL,
  `cod_forma` int(11) DEFAULT NULL,
  `cod_conc` int(11) DEFAULT NULL,
  `cod_usuario` int(11) DEFAULT NULL,
  `stock_producto` char(3) DEFAULT 'no',
  `cantidad_total` int(11) DEFAULT 0,
  `fechaHora` datetime DEFAULT NULL,
  `estado` char(10) DEFAULT 'activo',
  PRIMARY KEY (`cod_generico`),
  KEY `cod_forma` (`cod_forma`),
  KEY `cod_conc` (`cod_conc`),
  KEY `fk_pro` (`cod_usuario`),
  CONSTRAINT `fk_pro` FOREIGN KEY (`cod_usuario`) REFERENCES `usuario` (`cod_usuario`),
  CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`cod_forma`) REFERENCES `forma_presentacion` (`cod_forma`),
  CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`cod_conc`) REFERENCES `conc_uni_med` (`cod_conc`)
) ENGINE=InnoDB AUTO_INCREMENT=143 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table `producto`

LOCK TABLES `producto` WRITE;
/*!40000 ALTER TABLE `producto` DISABLE KEYS */;
INSERT INTO `producto` VALUES("1","J0504","Aciclovir","","","0","0","1","21","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("2","J0105","Amoxicilina","","","0","0","1","31","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("3","J0106","Amoxicilina","","","0","0","1","8","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("4","R0501","Antigripal (Paracetamol + Antihistaminico + Vasoconstrictor con o sin Cafeina)","","","0","0","1","12","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("5","A0701","Carbon medicinal activado","","","4","1","5","12","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("6","J0126","Ceftriaxona","","","0","0","2","31","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("7","J0127","Ciprofloxacina","","","0","0","1","8","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("8","R0603","Clorfenamina (Clorfeniramina)","","","0","0","2","13","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("9","G0102","Clotrimazol","","","0","0","8","19","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("10","A1106","Complejo B (B1 + B6 + B12)","","","0","0","1","33","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("11","A1107","Complejo B (B1 + B6 + B12)","","","0","0","2","33","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("12","V0604","Complemento nutricional (Carmelo)","","","0","0","5","33","5","si","0","0000-00-00 00:00:00","desactivo");
INSERT INTO `producto` VALUES("13","V0607","Complemento nutricional (Nutri Mama con Canahua probiotico y Omega-3)","","","0","0","5","33","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("14","V0603","Complemento nutricional (Nutribebe)","","","0","0","5","33","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("15","J0137","Cotrimoxazol (Sulfametoxazol + Trimetoprima)","","","0","0","1","1","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("16","J0138","Cotrimoxazol (Sulfametoxazol + Trimetoprima)","","","0","0","3","2","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("17","H0204","Dexametasona","","","3","1","2","3","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("18","R0503","Dextrometorfano bromhidrato","","","0","0","7","4","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("19","N0505","Diazepam","","","0","0","2","5","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("20","M0102","Diclofenaco Sodico","","","0","0","1","6","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("21","M0103","Diclofenaco Sodico","","","0","0","2","7","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("22","J0142","Dicloxacilina sodica","","","0","0","3","9","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("23","C0901","Enalapril maleato","","","0","0","11","5","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("24","C0110","Epinefrina (Adrenalina)","","","0","0","2","10","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("25","J0145","Eritromicina (estearato)","","","0","0","12","8","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("26","J0146","Eritromicina (etilsuccinato)","","","0","0","3","9","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("27","A0604","Fibra natural","","","0","0","13","12","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("28","B0202","Fitomenadiona (Vitamina K1)","","","0","0","2","13","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("29","C0304","Furosemida","","","0","0","11","14","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("30","J0149","Gentamicina sulfato","","","0","0","2","16","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("31","C0306","Hidroclorotiazida","","","0","0","11","6","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("32","D0704","Hidrocortisona acetato","","","0","0","4","18","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("33","H0205","Hidrocortisona succinato sodico","","","0","0","2","19","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("34","A0201","Hidroxido de aluminio y magnesio","","","0","0","3","20","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("35","M0105","Ibuprofeno","","","0","0","1","21","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("36","M0104","Ibuprofeno","","","0","0","3","22","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("37","M0106","Indometacina","","","0","0","12","23","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("38","M0107","Indometacina","","","0","0","14","19","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("39","M0109","Ketorolaco","","","0","0","2","24","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("40","A0607","Lactulosa","","","0","0","15","25","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("41","G0319","Levonorgestrel","","","0","0","16","27","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("42","N0109","Lidocaina","","","0","0","17","29","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("43","N0112","Lidocaina clorhidrato sin conservante","","","0","0","2","29","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("44","P0205","Mebendazol","","","0","0","1","8","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("45","G0313","Medroxiprogesterona acetato","","","0","0","2","30","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("46","N0205","Metamizol (Dipirona)","","","0","0","2","31","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("47","C0204","Metildopa (Alfametildopa)","","","0","0","1","8","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("48","A0307","Metoclopramida","","","0","0","1","5","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("49","P0109","Metronidazol","","","0","0","1","8","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("50","G0104","Metronidazol","","","0","0","8","8","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("51","P0106","Metronidazol","","","0","0","3","9","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("52","B0305","Micronutrientes (Vit.C+Vit.A+Fe+Zn+Ac.Folico) (Chispitas nutricionales)","","","0","0","5","33","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("53","A1109","Multivitaminas","","","0","0","1","33","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("54","C0808","Nifedipino","","","0","0","18","5","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("55","D0104","Nistatina","","","0","0","4","34","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("56","A0704","Nistatina","","","0","0","3","35","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("57","J0152","Nitrofurantoina","","","0","0","3","36","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("58","A0202","Omeprazol","","","0","0","10","37","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("59","D0202","Oxido de Zinc con o sin aceite","","","0","0","19","12","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("60","G0209","Oxitocina","","","0","0","2","39","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("61","N0212","Paracetamol (Acetaminofeno)","","","0","0","1","19","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("62","N0208","Paracetamol (Acetaminofeno)","","","0","0","1","8","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("63","N0209","Paracetamol (Acetaminofeno)","","","0","0","7","41","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("64","P0208","Pirantel pamoato","","","0","0","3","9","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("65","A0204","Ranitidina","","","0","0","2","6","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("66","A1115","Retinol (Vitamina A)","","","0","0","22","44","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("67","S0120","Sulfacetamida","","","0","0","6","50","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("68","P0206","Tiabendazol","","","0","0","1","6","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("69","C0101","Valproato de sodio","","","0","0","1","8","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("70","J0125","Vancomicina","","","0","0","2","8","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("71","A0305","Vitaminas (Complejo B)","","","0","0","2","33","5","si","0","0000-00-00 00:00:00","desactivo");
INSERT INTO `producto` VALUES("72","J0504","Aciclovir","","","0","0","1","21","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("73","J0105","Amoxicilina","","","0","0","1","31","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("74","J0106","Amoxicilina","","","0","0","1","8","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("75","R0501","Antigripal (Paracetamol + Antihistaminico + Vasoconstrictor con o sin Cafeina)","","","0","0","1","12","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("76","A0701","Carbon medicinal activado","","","0","0","5","12","5","si","0","0000-00-00 00:00:00","desactivo");
INSERT INTO `producto` VALUES("77","J0126","Ceftriaxona","","","0","0","2","31","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("78","J0127","Ciprofloxacina","","","0","0","1","8","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("79","R0603","Clorfenamina (Clorfeniramina)","","","0","0","2","13","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("80","G0102","Clotrimazol","","","0","0","8","19","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("81","A1106","Complejo B (B1 + B6 + B12)","","","0","0","1","33","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("82","A1107","Complejo B (B1 + B6 + B12)","","","0","0","2","33","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("83","V0604","Complemento nutricional (Carmelo)","","","0","0","5","33","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("84","V0607","Complemento nutricional (Nutri Mama con Canahua probiotico y Omega-3)","","","0","0","5","33","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("85","V0603","Complemento nutricional (Nutribebe)","","","0","0","5","33","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("86","J0137","Cotrimoxazol (Sulfametoxazol + Trimetoprima)","","","0","0","1","1","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("87","H0204","Dexametasona","","","0","0","2","3","5","si","0","0000-00-00 00:00:00","desactivo");
INSERT INTO `producto` VALUES("88","R0503","Dextrometorfano bromhidrato","","","0","0","7","4","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("89","N0505","Diazepam","","","0","0","2","5","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("90","M0102","Diclofenaco Sodico","","","0","0","1","6","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("91","M0103","Diclofenaco Sodico","","","0","0","2","7","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("92","J0141","Dicloxacilina sodica","","","0","0","10","8","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("93","J0142","Dicloxacilina sodica","","","0","0","3","9","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("94","C0901","Enalapril maleato","","","0","0","11","5","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("95","C0110","Epinefrina (Adrenalina)","","","0","0","2","10","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("96","J0145","Eritromicina (estearato)","","","0","0","12","8","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("97","J0146","Eritromicina (etilsuccinato)","","","0","0","3","9","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("98","A0604","Fibra natural","","","0","0","13","12","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("99","B0202","Fitomenadiona (Vitamina K1)","","","0","0","2","13","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("100","C0304","Furosemida","","","0","0","11","14","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("101","J0149","Gentamicina sulfato","","","0","0","2","16","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("102","C0306","Hidroclorotiazida","","","0","0","11","6","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("103","D0704","Hidrocortisona acetato","","","0","0","4","18","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("104","H0205","Hidrocortisona succinato sodico","","","0","0","2","19","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("105","A0201","Hidroxido de aluminio y magnesio","","","0","0","3","20","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("106","M0105","Ibuprofeno","","","0","0","1","21","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("107","M0104","Ibuprofeno","","","0","0","3","22","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("108","M0106","Indometacina","","","0","0","12","23","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("109","M0107","Indometacina","","","0","0","14","19","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("110","M0109","Ketorolaco","","","0","0","2","24","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("111","A0607","Lactulosa","","","0","0","15","25","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("112","G0319","Levonorgestrel","","","0","0","16","27","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("113","N0109","Lidocaina","","","0","0","17","29","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("114","N0112","Lidocaina clorhidrato sin conservante","","","0","0","2","29","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("115","C0902","Losartan","","","0","0","1","6","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("116","P0205","Mebendazol","","","0","0","1","8","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("117","G0313","Medroxiprogesterona acetato","","","0","0","2","30","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("118","N0205","Metamizol (Dipirona)","","","0","0","2","31","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("119","C0204","Metildopa (Alfametildopa)","","","0","0","1","8","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("120","A0307","Metoclopramida","","","0","0","1","5","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("121","P0109","Metronidazol","","","0","0","1","8","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("122","G0104","Metronidazol","","","0","0","8","8","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("123","P0106","Metronidazol","","","0","0","3","9","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("124","B0305","Micronutrientes (Vit.C+Vit.A+Fe+Zn+Ac.Folico) (Chispitas nutricionales)","","","0","0","5","33","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("125","A1109","Multivitaminas","","","0","0","1","33","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("126","C0808","Nifedipino","","","0","0","18","5","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("127","D0104","Nistatina","","","0","0","4","34","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("128","A0704","Nistatina","","","0","0","3","35","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("129","J0152","Nitrofurantoina","","","0","0","3","36","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("130","A0202","Omeprazol","","","0","0","10","37","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("131","G0209","Oxitocina","","","0","0","2","39","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("132","N0212","Paracetamol (Acetaminofeno)","","","0","0","1","19","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("133","N0208","Paracetamol (Acetaminofeno)","","","0","0","1","8","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("134","N0209","Paracetamol (Acetaminofeno)","","","0","0","7","41","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("135","P0208","Pirantel pamoato","","","0","0","3","9","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("136","A0204","Ranitidina","","","0","0","2","6","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("137","A1115","Retinol (Vitamina A)","","","0","0","22","44","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("138","S0120","Sulfacetamida","","","0","0","6","50","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("139","P0206","Tiabendazol","","","0","0","1","6","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("140","C0101","Valproato de sodio","","","0","0","1","8","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("141","J0125","Vancomicina","","","0","0","2","8","5","si","0","0000-00-00 00:00:00","activo");
INSERT INTO `producto` VALUES("142","A0305","Vitaminas (Complejo B)","","","3","4","2","33","5","si","0","0000-00-00 00:00:00","activo");
/*!40000 ALTER TABLE `producto` ENABLE KEYS */;
UNLOCK TABLES;

DROP TABLE IF EXISTS `productosolicitado`;
CREATE TABLE `productosolicitado` (
  `cod_solicitado` int(11) NOT NULL AUTO_INCREMENT,
  `cantidad_solicitada` int(11) DEFAULT NULL,
  `codigos_entrada` text DEFAULT NULL,
  `cantidadRestado` text DEFAULT NULL,
  `fechaHora` datetime DEFAULT NULL,
  `cod_producto` int(11) DEFAULT NULL,
  `cod_salida` int(11) DEFAULT NULL,
  PRIMARY KEY (`cod_solicitado`),
  KEY `cod_producto` (`cod_producto`),
  KEY `cod_salida` (`cod_salida`),
  CONSTRAINT `productosolicitado_ibfk_1` FOREIGN KEY (`cod_producto`) REFERENCES `producto` (`cod_generico`),
  CONSTRAINT `productosolicitado_ibfk_2` FOREIGN KEY (`cod_salida`) REFERENCES `salida` (`cod_salida`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `productosolicitado`

LOCK TABLES `productosolicitado` WRITE;
/*!40000 ALTER TABLE `productosolicitado` DISABLE KEYS */;
/*!40000 ALTER TABLE `productosolicitado` ENABLE KEYS */;
UNLOCK TABLES;

DROP TABLE IF EXISTS `registro_diario`;
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
  `paciente_rd` int(11) DEFAULT NULL,
  `cod_cds` int(11) NOT NULL,
  `estado` char(15) DEFAULT NULL,
  PRIMARY KEY (`cod_rd`),
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `registro_diario`

LOCK TABLES `registro_diario` WRITE;
/*!40000 ALTER TABLE `registro_diario` DISABLE KEYS */;
INSERT INTO `registro_diario` VALUES("1","2024-09-06","00:17:04","6","ninguna","si","0000-00-00","3","2","6","1","activo");
INSERT INTO `registro_diario` VALUES("2","2024-09-12","16:42:07","6","no","si","2024-09-12","3","2","9","1","activo");
INSERT INTO `registro_diario` VALUES("3","2024-09-13","15:52:33","3","ninguna","si","0000-00-00","3","2","11","1","activo");
/*!40000 ALTER TABLE `registro_diario` ENABLE KEYS */;
UNLOCK TABLES;

DROP TABLE IF EXISTS `salida`;
CREATE TABLE `salida` (
  `cod_salida` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_receta` char(200) DEFAULT NULL,
  `entregado` char(15) DEFAULT 'no',
  `cod_usuario` int(11) DEFAULT NULL,
  `cod_paciente` int(11) DEFAULT NULL,
  `fechaHora` datetime DEFAULT NULL,
  `estado` char(10) DEFAULT 'activo',
  PRIMARY KEY (`cod_salida`),
  KEY `cod_usuario` (`cod_usuario`),
  KEY `cod_paciente` (`cod_paciente`),
  CONSTRAINT `salida_ibfk_1` FOREIGN KEY (`cod_usuario`) REFERENCES `usuario` (`cod_usuario`),
  CONSTRAINT `salida_ibfk_2` FOREIGN KEY (`cod_paciente`) REFERENCES `usuario` (`cod_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `salida`

LOCK TABLES `salida` WRITE;
/*!40000 ALTER TABLE `salida` DISABLE KEYS */;
/*!40000 ALTER TABLE `salida` ENABLE KEYS */;
UNLOCK TABLES;

DROP TABLE IF EXISTS `servicio`;
CREATE TABLE `servicio` (
  `cod_servicio` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_servicio` varchar(100) DEFAULT NULL,
  `descripcion_servicio` varchar(100) DEFAULT NULL,
  `estado` char(10) DEFAULT NULL,
  PRIMARY KEY (`cod_servicio`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `servicio`

LOCK TABLES `servicio` WRITE;
/*!40000 ALTER TABLE `servicio` DISABLE KEYS */;
INSERT INTO `servicio` VALUES("1","Enfermería","encargado de vacunas y otros","activo");
INSERT INTO `servicio` VALUES("2","Consultorio Odontológico","encargado de la salud de los dientes","activo");
INSERT INTO `servicio` VALUES("3","Servicio del PAI","pai","activo");
INSERT INTO `servicio` VALUES("4","Crecimiento y desarrollo","","activo");
INSERT INTO `servicio` VALUES("5","Consultorio Médico","","activo");
INSERT INTO `servicio` VALUES("6","Farmacia","medicamentos y mas","activo");
INSERT INTO `servicio` VALUES("8","Emergencias","pacientes en gravedad y en peligro de muerte","activo");
/*!40000 ALTER TABLE `servicio` ENABLE KEYS */;
UNLOCK TABLES;

DROP TABLE IF EXISTS `sessiones`;
CREATE TABLE `sessiones` (
  `session_id` varchar(255) NOT NULL,
  `cod_usuario` int(11) NOT NULL,
  `usuario` varchar(255) NOT NULL,
  `nombre_usuario` varchar(255) NOT NULL,
  `ap_usuario` varchar(255) NOT NULL,
  `am_usuario` varchar(255) NOT NULL,
  `tipo_usuario` varchar(255) NOT NULL,
  `session_start` timestamp NOT NULL DEFAULT current_timestamp(),
  `session_end` char(15) DEFAULT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `sessiones`

LOCK TABLES `sessiones` WRITE;
/*!40000 ALTER TABLE `sessiones` DISABLE KEYS */;
INSERT INTO `sessiones` VALUES("05qdlqo1kve1e13a7itqvpttvi","4","admin","Carlos","Mamani","Lopes","admin","2024-09-13 16:51:48","cerrar");
INSERT INTO `sessiones` VALUES("11dblcp5stpankidkn7m7p8ujb","2","admision","Sandra","Huanca","Nina","admision","2024-09-05 19:05:30","cerrar");
INSERT INTO `sessiones` VALUES("2ito7vai6os8hb6uh9refdgttc","4","admin","Carlos","Mamani","Lopes","admin","2024-09-10 15:54:54","cerrar");
INSERT INTO `sessiones` VALUES("2t1jaog87q3f2jpcuvhbokmqsk","2","admision","Sandra","Huanca","Nina","admision","2024-09-11 08:51:47","cerrar");
INSERT INTO `sessiones` VALUES("4m8iejhbrdvu5gvcjl94ar9cp7","2","admision","Sandra","Huanca","Nina","admision","2024-09-10 15:54:59","cerrar");
INSERT INTO `sessiones` VALUES("5p82tpe5sj34sei3bdg737ad0v","4","admin","Carlos","Mamani","Lopes","admin","2024-09-05 19:04:30","cerrar");
INSERT INTO `sessiones` VALUES("7ii1jsad4ddpsukukt39fvb1ol","2","admision","Sandra","Huanca","Nina","admision","2024-09-12 09:10:53","cerrar");
INSERT INTO `sessiones` VALUES("9cg129rqbbl1tdfubblhhl09ri","5","mario","mario","diaz","mamani","farmacia","2024-09-09 10:53:58","cerrar");
INSERT INTO `sessiones` VALUES("9e8lf704mk35horjuvh2flb2sl","2","admision","Sandra","Huanca","Nina","admision","2024-09-05 19:06:17","cerrar");
INSERT INTO `sessiones` VALUES("a6e00hbl8lsdpm7de0lrjj9ssn","4","admin","Carlos","Mamani","Lopes","admin","2024-09-11 08:51:32","cerrar");
INSERT INTO `sessiones` VALUES("b8g632kmsg00i2i6k5sr8gjrs8","5","mario","mario","diaz","mamani","farmacia","2024-09-08 14:15:53","cerrar");
INSERT INTO `sessiones` VALUES("bhkcepid4nchqeacic6hj9g5ud","2","admision","Sandra","Huanca","Nina","admision","2024-09-05 18:47:08","cerrar");
INSERT INTO `sessiones` VALUES("eikam3mqcbo7gj3ac6rf6l23ip","2","admision","Sandra","Huanca","Nina","admision","2024-09-05 18:53:44","cerrar");
INSERT INTO `sessiones` VALUES("eu7kmg2e2cuhb59k2r53v357c6","2","admision","Sandra","Huanca","Nina","admision","2024-09-13 16:52:56","cerrar");
INSERT INTO `sessiones` VALUES("f1c1frj5tdjtkjrhcvjijui872","2","admision","Sandra","Huanca","Nina","admision","2024-09-13 09:31:06","cerrar");
INSERT INTO `sessiones` VALUES("gle8eofinfadhmsu9ur2tmqf52","2","admision","Sandra","Huanca","Nina","admision","2024-09-05 19:04:59","cerrar");
INSERT INTO `sessiones` VALUES("k2k8jvk4np75sktvkvi6oeblcl","4","admin","Carlos","Mamani","Lopes","admin","2024-09-12 09:10:28","cerrar");
INSERT INTO `sessiones` VALUES("m0b60j6al8i6l028noo7k2o8p8","2","admision","Sandra","Huanca","Nina","admision","2024-09-10 09:12:35","cerrar");
INSERT INTO `sessiones` VALUES("mgofiufhdlht26itbf8dsa3ep3","5","mario","mario","diaz","mamani","farmacia","2024-09-05 19:05:51","cerrar");
INSERT INTO `sessiones` VALUES("nqnab8cgekqgh4j2b4m146e9nl","4","admin","Carlos","Mamani","Lopes","admin","2024-09-09 10:53:41","cerrar");
INSERT INTO `sessiones` VALUES("oikhutek8f3o72qrr5kdd2hf2m","4","admin","Carlos","Mamani","Lopes","admin","2024-09-14 12:13:05","abierto");
INSERT INTO `sessiones` VALUES("otsga0k90ieutu5bshq2ua71rh","4","admin","Carlos","Mamani","Lopes","admin","2024-09-08 14:15:41","cerrar");
INSERT INTO `sessiones` VALUES("p36jjge07s87cmv5n7nq6l2lvu","2","admision","Sandra","Huanca","Nina","admision","2024-09-05 19:04:42","cerrar");
INSERT INTO `sessiones` VALUES("tiki7r57hvk0re78a169auu72b","2","admision","Sandra","Huanca","Nina","admision","2024-09-08 14:19:13","cerrar");
/*!40000 ALTER TABLE `sessiones` ENABLE KEYS */;
UNLOCK TABLES;

DROP TABLE IF EXISTS `usuario`;
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
  `control_acceso` char(15) DEFAULT '',
  `configControlAcceso` char(3) DEFAULT 'si',
  `notificacionEjecutar` char(3) DEFAULT 'no',
  PRIMARY KEY (`cod_usuario`),
  KEY `cod_cds` (`cod_cds`),
  CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`cod_cds`) REFERENCES `centro_de_salud` (`cod_cds`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `usuario`

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES("1","7308752","encargado","Noelia","Mamani","Nina","0000-00-00","0","78451256","calle La paz entre linares","Licenciada en enfermeria","enfermera","","","","","","","","","encargado","$2y$10$UiDpH8cKEP8Fo6ogkfqnlOuk2c1tvqm8s0MKLQ1pmCCFWbdqBfn6W","1","activo","","si","no");
INSERT INTO `usuario` VALUES("2","75451256","admision","Sandra","Huanca","Nina","0000-00-00","0","63258974","calle brasil","medico","Pediatra","","","","","","","","","admision","$2y$10$wEhNpR35jTOKFqK7sLRAaOCcvXYYiqqY9znZwGqAJgdC6PZqkGwNK","1","activo","","si","no");
INSERT INTO `usuario` VALUES("3","75451256","medico","Salome","mamani","romina","0000-00-00","0","63258974","calle brasil","medico","Pediatra","","","","","","","","","medico","$2y$10$Uo.szMVEPkBINp.2FrLnk.M0NjZRqCQRZw6PohOy9RRp2YvQc8rfS","1","activo","","si","no");
INSERT INTO `usuario` VALUES("4","72354512","admin","Carlos","Mamani","Lopes","0000-00-00","0","63247512","calle ecuador en tre la paz","Ingeniero informatico","computacion","","","","","","","","","admin","$2y$10$HcDmz5/npUWmiwxbW0QK8.fp2fvu0xcbAU8McwvvJDRBf29TvuroS","1","activo","activo","si","no");
INSERT INTO `usuario` VALUES("5","78451245","mario","mario","diaz","mamani","0000-00-00","0","63214578","calle oruro","farmaceutico","ninguna","","","","","","","","","farmacia","$2y$10$BSVeieu4vZHHT4YMAdGCweGhCQbKuCenaFIM.xm5ZgXRRoGW0ie4S","1","activo","","si","no");
INSERT INTO `usuario` VALUES("6","46374","","carlos","mamani","nina","1992-09-22","32","897877","calle la paz","","","ESTUDIANTE","cala cala","casado(a)","No Secundaria","","hjkhj","hjk","masculino","paciente","","1","activo","","si","no");
INSERT INTO `usuario` VALUES("7","3454322","","maria","lipiri","pacheco","1994-02-22","0","67564534","calle la paz","","","policia","cala cala","","","","6786","BM897","masculino","paciente","","","","","si","no");
INSERT INTO `usuario` VALUES("8","0","","ruben","lia","mamani","2024-09-21","78","0","calle la paz","","","","","","","","","","","paciente","","1","activo","","si","no");
INSERT INTO `usuario` VALUES("9","0","","ruben","lia","mamani","2024-09-21","78","0","calle la paz","","","estudiante","","soltero(a)","Primaria","","","","masculino","paciente","","1","activo","","si","no");
INSERT INTO `usuario` VALUES("10","7867564","","maria","lia","calani","2024-09-28","0","67564534","calle oriro","","","profesor","cosmine","","","","hjk67678","hjk68","masculino","paciente","","","","","si","no");
INSERT INTO `usuario` VALUES("11","0","","wilson","mamani","lipiri","2007-01-01","17","0","calle oruro","","","estudiante","","soltero(a)","No Secundaria","","","","otro","paciente","","1","activo","","si","no");
INSERT INTO `usuario` VALUES("12","7867564","","eliana","mamani","villca","1994-02-02","0","8767565","calle oruro","","","policia","call cala","","","","67hgj7","hj78","femenino","paciente","","","","","si","no");
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
