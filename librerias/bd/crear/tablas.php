<?php
 // Cambia esto al nombre de tu base de datos
crearDataBase();
function crearDataBase(){
  $servername = "localhost"; // Cambia esto si tu servidor MySQL está en otro lugar
  $username = "root"; // Cambia esto a tu nombre de usuario de MySQL
  $password = ""; // Cambia esto a tu contraseña de MySQL
  $dbname = "cds";
  $con1 = mysqli_connect($servername,$username,$password);
  if($con1){
    echo"Conexion establecido con mysql \n";
    $con1->set_charset("utf8mb4");
  }else{
    echo $con1->error;
  }
  echo "<br>";
  $sql_drop = "DROP DATABASE IF EXISTS $dbname";
  if ($con1->query($sql_drop) === TRUE) {
      echo "Base de datos eliminada correctamente o no existía.<br>";
  } else {
      echo "Error al eliminar la base de datos: " . $con1->error . "<br>";
  }
  echo "<br>";

  $sql = "CREATE DATABASE IF NOT EXISTS $dbname CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci";
  if ($con1->query($sql) === TRUE) {
    echo "Base de datos creada correctamente o ya existe.<br>";
  }else{
    echo "Ocurrio un error al crear la base de datos".$con1->error."<br>";
  }
  $conn = mysqli_connect($servername,$username,$password,$dbname);
  if($conn){
    echo"Conexion correcta con la base de datos ".$dbname;
    $conn->set_charset("utf8mb4");
  }else{
    echo $conn->error;
  }
  echo "<br>Creando las tablas<br>";
      crearTablaServicio($conn);
      echo "<br>tabla1<br>";
      crearTablasCDS($conn);echo "<br>tabla2<br>";
      crearTablaConsultas($conn);echo "<br>tabla3<br>";
      crearTablaUsuario($conn);echo "<br>tabla4<br>";
      crearTablaRegistroDiario($conn);echo "<br>tabla5<br>";
      crearTablaHistorial($conn);echo "<br>tabla6<br>";
      crearTablaHistorialDatos($conn); echo  "<br>tabla 7<br>";
      crearTablaFormaPresentacion($conn);echo "<br>tabla8<br>";
      crearTablaUnidadMedidad($conn);echo "<br>tabla9<br>";
      crearTablaProducto($conn);echo "<br>tabla10<br>";
      crearTablaEntrada($conn);echo "<br>tabla11<br>";
      crearTablaSalida($conn);echo "<br>tabla12<br>";
      crearTablaProductoSolicitado($conn);echo "<br>tabla13<br>";
      crearTablaSessiones($conn);echo "<br>tabla14<br>";

echo "Se completo las acciones correctamente, se creo todo";
  // Cerrar conexión
  $conn->close();
}

function crearTablasCDS($conn){
  // SQL para crear la tabla
  $sql = "DROP TABLE IF EXISTS `centro_de_salud`;
  CREATE TABLE `centro_de_salud` (
    `cod_cds` int(11) NOT NULL AUTO_INCREMENT,
    `nombre_cds` char(200) DEFAULT NULL,
    `direccion_cds` char(200) DEFAULT NULL,
    `estado` char(15) DEFAULT NULL,
    PRIMARY KEY (`cod_cds`)
  ) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";

  // Ejecutar la consulta para crear la tabla
  if ($conn->multi_query($sql)) {
      do {
          // Se almacena el resultado de cada consulta ejecutada
          if ($result = $conn->store_result()) {
              $result->free();
          }
          // Comprobar si hay más resultados
          if ($conn->more_results()) {
              echo "Más resultados disponibles...\n";
          }
      } while ($conn->next_result());
      echo "Tabla creada correctamente.\n";
  } else {
      echo "Error al crear la tabla: " . $conn->error;
  }

  // Insertar datos en la tabla
  $sql = "INSERT INTO `centro_de_salud` (cod_cds,nombre_cds, direccion_cds, estado) VALUES
  ('1','Centro de salud Cala cala', 'Cala cala', 'activo')";

  if ($conn->query($sql) === TRUE) {
      echo "Datos insertados correctamente.\n";
  } else {
      echo "Error al insertar datos: " . $conn->error;
  }

}

function crearTablaUnidadMedidad($conn){
  $sql = "DROP TABLE IF EXISTS `conc_uni_med`;
  CREATE TABLE `conc_uni_med` (
    `cod_conc` int(11) NOT NULL AUTO_INCREMENT,
    `concentracion` char(60) DEFAULT NULL,
    `estado` char(10) DEFAULT 'activo',
    PRIMARY KEY (`cod_conc`)
  ) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";

  // Ejecutar la consulta para crear la tabla
  if ($conn->multi_query($sql)) {
      do {
          // Se almacena el resultado de cada consulta ejecutada
          if ($result = $conn->store_result()) {
              $result->free();
          }
          // Comprobar si hay más resultados
          if ($conn->more_results()) {
              echo "Más resultados disponibles...\n";
          }
      } while ($conn->next_result());
      echo "Tabla creada correctamente.\n";
  } else {
      echo "Error al crear la tabla: " . $conn->error;
  }

  // SQL para insertar datos en la tabla
  $sql = "INSERT INTO `conc_uni_med` (cod_conc, concentracion, estado) VALUES
  ('1', '800 mg + 160 mg', 'activo'),
  ('2', '200 mg + 40 mg/5 ml', 'activo'),
  ('3', '4 mg/ml', 'activo'),
  ('4', '10 mg/5 ml', 'activo'),
  ('5', '10 mg', 'activo'),
  ('6', '50 mg', 'activo'),
  ('7', '75 mg', 'activo'),
  ('8', '500 mg', 'activo'),
  ('9', '250 mg/5 ml', 'activo'),
  ('10', '1 mg/ml', 'activo'),
  ('11', '0', 'activo'),
  ('12', 'Segun disponibilidad', 'activo'),
  ('13', '10 mg/ml', 'activo'),
  ('14', '40 mg', 'activo'),
  ('15', '0', 'activo'),
  ('16', '80 mg', 'activo'),
  ('17', '1 g a 1', 'activo'),
  ('18', '1%', 'activo'),
  ('19', '100 mg', 'activo'),
  ('20', '1:1', 'activo'),
  ('21', '400 mg', 'activo'),
  ('22', '100 mg/5 ml', 'activo'),
  ('23', '25 mg', 'activo'),
  ('24', '30 mg/ml', 'activo'),
  ('25', '65% a 67%', 'activo'),
  ('26', '0', 'activo'),
  ('27', '150 mg', 'activo'),
  ('28', '0', 'activo'),
  ('29', '2%', 'activo'),
  ('30', '150 mg/ml', 'activo'),
  ('31', '1 g', 'activo'),
  ('32', '10 mg / 2 ml', 'activo'),
  ('33', 'Segun concentracion estandar', 'activo'),
  ('34', '100.000 UI/g', 'activo'),
  ('35', '500.000 UI/5 ml', 'activo'),
  ('36', '25 mg/5 ml', 'activo'),
  ('37', '20 mg', 'activo'),
  ('38', 'Segun disponibilidad', 'activo'),
  ('39', '5 UI/ml o 10 UI/ml', 'activo'),
  ('40', '100 mg/ml', 'activo'),
  ('41', '120 mg/5 ml o 125 mg/5 ml', 'activo'),
  ('42', '2% o 3%', 'activo'),
  ('43', '250 mg/5 ml', 'activo'),
  ('44', '100.000 UI', 'activo'),
  ('45', '200.000 UI', 'activo'),
  ('46', '0', 'activo'),
  ('47', '5% (1.000 ml)', 'activo'),
  ('48', '0', 'activo'),
  ('49', '1.000 ml', 'activo'),
  ('50', '10%', 'activo'),
  ('51', '200 mg + 0', 'activo'),
  ('52', '1%', 'activo'),
  ('53', '20 mg/5 ml', 'activo'),
  ('54', 'Pieza', 'activo'),
  ('55', 'Frasco', 'activo'),
  ('56', 'Paquete', 'activo'),
  ('57', 'Sobre', 'activo'),
  ('58', 'Caja', 'activo'),
  ('59', 'Rollo', 'activo'),
  ('60', 'Tubo', 'activo'),
  ('61', 'Kit', 'activo'),
  ('62', 'Determinacion', 'activo'),
  ('63', '37%', 'activo'),
  ('64', '0', 'activo'),
  ('65', 'UNIDAD', 'activo'),
  ('66', 'SOLUCION', 'activo'),
  ('67', 'DETERMINACIONES SOLUCION', 'activo');";

  if ($conn->query($sql) === TRUE) {
      echo "Datos insertados correctamente.\n";
  } else {
      echo "Error al insertar datos: " . $conn->error;
  }
}

function crearTablaConsultas($conn){
  $sql = "
  DROP TABLE IF EXISTS `consultas`;
  CREATE TABLE `consultas` (
    `cod_cons` int(11) NOT NULL AUTO_INCREMENT,
    `consulta` text DEFAULT NULL,
    `respuesta_consulta` text DEFAULT NULL,
    PRIMARY KEY (`cod_cons`)
  ) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
  ";

  // Ejecutar consulta
  if ($conn->multi_query($sql)) {
      do {
          // almacenar resultados si hay alguno
          if ($result = $conn->store_result()) {
              $result->free();
          }
          // imprimir errores
          if ($conn->error) {
              echo "Error: " . $conn->error;
          }
      } while ($conn->more_results() && $conn->next_result());
  } else {
      echo "Error al ejecutar SQL: " . $conn->error;
  }

  // SQL para insertar datos en la tabla `consultas`
  $sql_inserts = "
  LOCK TABLES `consultas` WRITE;
  /*!40000 ALTER TABLE `consultas` DISABLE KEYS */;
  INSERT INTO `consultas` VALUES(1, 'hola', 'hola, en que puedo ayudarte');
  INSERT INTO `consultas` VALUES(2, 'como estas', 'estoy bien y tu');
  INSERT INTO `consultas` VALUES(3, 'yo estoy bien', 'que bien me alegra escuchar que estes bien');
  INSERT INTO `consultas` VALUES(4, 'cual es tu nombre', 'mi nombre es chatBot cala cala');
  INSERT INTO `consultas` VALUES(5, '', 'en que mas podria ayudarte');
  INSERT INTO `consultas` VALUES(6, 'Elije una de las opciones en las que te podria ayudar', '');
  INSERT INTO `consultas` VALUES(7, 'quisiera mas informacion sobre el centro de salud', 'le pido que especifique su consulta');
  INSERT INTO `consultas` VALUES(8, 'como te llamas', 'me llamo chatbot cala cala');
  INSERT INTO `consultas` VALUES(9, 'cual es tu nombre', 'me llamo chatbot cala cala');
  INSERT INTO `consultas` VALUES(10, 'me podrias dar los horarios de atencion', 'los horarios de atencion son por la mañana desde las 8:30 a 12:00 y por la tarde de 14:00 a 18:00');
  INSERT INTO `consultas` VALUES(11, 'como te encuentras', 'yo estoy bien');
  INSERT INTO `consultas` VALUES(12, 'me podrias dar mas informacion sobre los horarios de atencion', 'los horarios de atencion son por la mañana desde las 8:30 a 12:00 y por la tarde de 14:00 a 18:00');
  INSERT INTO `consultas` VALUES(13, 'informacion sobre los horarios de atencion', 'los horarios de atencion son por la mañana desde las 8:30 a 12:00 y por la tarde de 14:00 a 18:00');
  INSERT INTO `consultas` VALUES(14, 'que es una enfermedad', 'Una enfermedad es una alteración o desviación del estado fisiológico en una o varias partes del cuerpo, que se manifiesta por un conjunto de síntomas y signos específicos. Estas alteraciones pueden ser causadas por diversos factores, como infecciones, genética, problemas ambientales, estilos de vida o condiciones degenerativas.');
  INSERT INTO `consultas` VALUES(15, 'en que lugar se encuentra en centro de salud', 'se encuentra en el pueblo de cala cala');
  INSERT INTO `consultas` VALUES(16, 'que es una vacuna o vacunas', 'Una vacuna es un producto biológico diseñado para proporcionar inmunidad contra una enfermedad específica. Funciona estimulando el sistema inmunológico del cuerpo para que produzca una respuesta protectora contra un patógeno, como una bacteria o un virus.');
  INSERT INTO `consultas` VALUES(17, 'que es la gripe', 'La gripe, también conocida como influenza, es una infección respiratoria aguda causada por los virus de la influenza. Se caracteriza por síntomas como fiebre, tos, dolor de garganta, congestión nasal, dolores musculares, dolor de cabeza y fatiga. A menudo, también puede causar escalofríos, sudores y, en algunos casos, náuseas o vómitos. La gripe se transmite principalmente a través de gotas respiratorias que se expulsan al toser, estornudar o hablar, así como al tocar superficies contaminadas y luego llevarse las manos a la boca, nariz o ojos. Existen tres tipos principales de virus de la influenza que afectan a los humanos: A, B y C. Los virus tipo A y B son los que suelen causar las epidemias estacionales, mientras que el tipo C causa infecciones más leves y menos comunes.');
  INSERT INTO `consultas` VALUES(18, 'muchas gracias', 'de nada, en que mas puedo ayudarte');
  INSERT INTO `consultas` VALUES(19, 'que es una enfluenza', 'La influenza es el nombre científico para la gripe, una enfermedad respiratoria causada por los virus de la influenza. La influenza puede provocar una amplia gama de síntomas que incluyen: Fiebre: A menudo alta, aunque no siempre está presente. Tos: Generalmente seca y persistente. Dolor de garganta: A menudo asociado con la tos y la congestión. Congestión nasal: Nariz tapada o secreción nasal. Dolores musculares y corporales: Sensación de dolor en todo el cuerpo. Dolor de cabeza: Que puede ser intenso. Fatiga: Sensación de cansancio extremo y debilidad. Escalofríos y sudores: A veces acompañan a la fiebre. Náuseas o vómitos: Más comunes en niños que en adultos.');
  INSERT INTO `consultas` VALUES(20, 'existe una farmacia en el centro de salud', 'si contamos con una farmacia en el centro de salud, que esta a disposicion de todos los pacientes que lo necesiten.');
  INSERT INTO `consultas` VALUES(21, 'que tipos de enfermedad o enfermedades existen o hay en el mundo', 'Las enfermedades se pueden clasificar de diversas maneras según sus características, causas y efectos en el cuerpo. Aquí hay una visión general de algunas de las principales categorías de enfermedades: 1. Enfermedades Infecciosas Estas son causadas por organismos patógenos como bacterias, virus, hongos o parásitos. Ejemplos incluyen: - Bacterianas: Tuberculosis, neumonía, salmonella. - Virales: Gripe, VIH/SIDA, hepatitis. - Fúngicas: Candidiasis, aspergilosis. - Parasitarias: Malaria, giardiasis. 2. Enfermedades Crónicas Son enfermedades de larga duración que suelen progresar lentamente y pueden durar toda la vida. Ejemplos incluyen: - Enfermedades Cardiovasculares: Hipertensión, enfermedad coronaria. - Diabetes: Tipo 1 y Tipo 2. - Enfermedades Respiratorias Crónicas: Asma, EPOC (Enfermedad Pulmonar Obstructiva Crónica). 3. Enfermedades Agudas Estas enfermedades tienen un inicio rápido y suelen durar poco tiempo, aunque pueden ser graves. Ejemplos incluyen: - Infartos: Infarto agudo de miocardio. - Gastroenteritis: Infección del estómago y los intestinos. - Apéndice: Apendicitis. 4. Enfermedades Genéticas Causadas por alteraciones en los genes o cromosomas. Pueden ser hereditarias o surgir de mutaciones espontáneas. Ejemplos incluyen: - Síndrome de Down: Causa retraso en el desarrollo y discapacidad intelectual. - Fibrosis Quística: Enfermedad genética que afecta los pulmones y el sistema digestivo. - Hemofilia: Trastorno de la coagulación de la sangre. 5. Enfermedades Autoinmunes En estas enfermedades, el sistema inmunológico ataca las células del propio cuerpo por error. Ejemplos incluyen: - Artritis Reumatoide: Afecta las articulaciones. - Lupus Eritematoso Sistémico: Afecta múltiples sistemas del cuerpo. - Esclerosis Múltiple: Afecta el sistema nervioso central. 6. Enfermedades Neoplásicas Incluyen cánceres y tumores, que resultan del crecimiento anormal de células. Ejemplos incluyen: - Cáncer de Pulmón: Crecimiento maligno en los pulmones. - Leucemia: Cáncer de la sangre. - Melanoma: Tipo de cáncer de piel. 7. Enfermedades Metabólicas Estas enfermedades afectan los procesos metabólicos del cuerpo. Ejemplos incluyen: - Hipotiroidismo: Disminución de la actividad de la glándula tiroides. - Enfermedad de Gaucher: Trastorno del metabolismo de lípidos. - Fenilcetonuria: Trastorno del metabolismo de aminoácidos.');
  INSERT INTO `consultas` VALUES(22, 'que es una alergia', 'Una alergia es una reacción del sistema inmunológico a sustancias que generalmente son inofensivas para la mayoría de las personas, conocidas como alérgenos. Cuando una persona con alergias entra en contacto con un alérgeno, su sistema inmunológico lo identifica erróneamente como una amenaza y responde de manera exagerada, causando una serie de síntomas que pueden variar desde leves hasta graves. Los alérgenos comunes incluyen polen, ácaros del polvo, moho, caspa de animales, ciertos alimentos, picaduras de insectos y medicamentos. Los síntomas de una alergia pueden incluir: - Estornudos: Frecuentemente acompañados de secreción nasal o congestión. - Picazón y enrojecimiento de los ojos: Conjuntivitis alérgica. - Erupciones cutáneas: Como urticaria o eczema. - Congestión nasal: Con o sin secreción. - Tos y dificultad para respirar: En el caso de alergias respiratorias, como el asma alérgico. - Hinchazón: Especialmente en la cara o en la garganta, que puede ser grave en casos de anafilaxia, una reacción alérgica severa y potencialmente mortal.');
  INSERT INTO `consultas` VALUES(23, 'hay un medidor de glucosa', 'si contamos con medidor de glucosa en el centro de salud, el cual se encuentra en el area de laboratorios');
  INSERT INTO `consultas` VALUES(24, 'me puedes indicar los horarios de atencion', 'los horarios de atencion son de lunes a viernes desde las 8:30 a 12:00 y por la tarde de 14:00 a 18:00');
  INSERT INTO `consultas` VALUES(25, 'que medicamentos tiene el centro de salud', 'el centro de salud cuenta con una variedad de medicamentos, desde analgésicos y antibióticos hasta medicamentos especializados. Si necesita información específica sobre un medicamento, por favor comuníquese con el personal de la farmacia del centro.');
  /*!40000 ALTER TABLE `consultas` ENABLE KEYS */;
  UNLOCK TABLES;
  ";

  // Ejecutar inserciones
  if ($conn->multi_query($sql_inserts)) {
      do {
          // almacenar resultados si hay alguno
          if ($result = $conn->store_result()) {
              $result->free();
          }
          // imprimir errores
          if ($conn->error) {
              echo "Error: " . $conn->error;
          }
      } while ($conn->more_results() && $conn->next_result());
  } else {
      echo "Error al ejecutar SQL: " . $conn->error;
  }

}

function crearTablaEntrada($conn){
  $sql = "
  DROP TABLE IF EXISTS `entrada`;
  CREATE TABLE `entrada` (
    `cod_entrada` int(11) NOT NULL AUTO_INCREMENT,
    `cantidad` int(11) DEFAULT NULL,
    `respaldo_cantidad` int(11) DEFAULT NULL,
    `manipulado` char(3) DEFAULT NULL,
    `nrolote` char(20),
    `costounitario` decimal(10,2),
    `costototal` decimal(10,2),
    `costototal_respaldo` decimal(10,2),
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
  ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
  ";

  // Ejecutar consulta
  if ($conn->multi_query($sql)) {
      do {
          // almacenar resultados si hay alguno
          if ($result = $conn->store_result()) {
              $result->free();
          }
          // imprimir errores
          if ($conn->error) {
              echo "Error: " . $conn->error;
          }
      } while ($conn->more_results() && $conn->next_result());
  } else {
      echo "Error al ejecutar SQL: " . $conn->error;
  }
}

function crearTablaFormaPresentacion($conn){
  $sql = "
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
  INSERT INTO `forma_presentacion` VALUES
  (1,'Comprimido','activo'),
  (2,'Inyectable','activo'),
  (3,'Suspension','activo'),
  (4,'Crema o Pomada','activo'),
  (5,'Polvo','activo'),
  (6,'Solucion oftalmica','activo'),
  (7,'Jarabe','activo'),
  (8,'Ovulo','activo'),
  (9,'Comprimido o Capsula blanda','activo'),
  (10,'Capsula','activo'),
  (11,'Comprimido ranurado','activo'),
  (12,'Capsula o Comprimido','activo'),
  (13,'Polvo o granulado','activo'),
  (14,'Supositorio','activo'),
  (15,'Solucion oral','activo'),
  (16,'Implante subdermico','activo'),
  (17,'Cartucho dental','activo'),
  (18,'Comprimido o Capsula','activo'),
  (19,'Pasta o Pomada','activo'),
  (20,'Gotas','activo'),
  (21,'Solucion','activo'),
  (22,'Capsula o Perla','activo'),
  (23,'Aerosol','activo'),
  (24,'Sobres','activo'),
  (25,'Solucion parenteral de gran volumen','activo'),
  (26,'Unguento o crema','activo'),
  (27,'Sobre esteril','activo'),
  (28,'Paquete','activo'),
  (29,'Pieza','activo'),
  (30,'Unidad','activo'),
  (31,'Sobre','activo'),
  (32,'Caja x 100','activo'),
  (33,'Rollo 100 yds.','activo'),
  (34,'Par','activo'),
  (35,'Tubo 50 g.','activo'),
  (36,'Placa','activo'),
  (37,'Carrete','activo'),
  (38,'Rollo','activo'),
  (39,'Frasco','activo'),
  (40,'Kit x 250 determinaciones','activo'),
  (41,'Kit x 3 frascos x 10 ml c/u','activo'),
  (42,'Determinacion','activo'),
  (43,'Frasco 4 x 10 ml','activo'),
  (44,'Frasco x 100 unidades','activo'),
  (45,'Kit x 100 determinaciones','activo'),
  (46,'TUBO','activo'),
  (47,'PIEZAS','activo'),
  (48,'FRASCO 50 ML','activo'),
  (49,'KIT X96','activo'),
  (50,'KIT X 96','activo'),
  (51,'KIT 50 ML','activo'),
  (52,'KIT FRASCO 3 X500 ML','activo');
  /*!40000 ALTER TABLE `forma_presentacion` ENABLE KEYS */;
  UNLOCK TABLES;
  ";

  // Ejecutar consulta
  if ($conn->multi_query($sql)) {
      do {
          // almacenar resultados si hay alguno
          if ($result = $conn->store_result()) {
              $result->free();
          }
          // imprimir errores
          if ($conn->error) {
              echo "Error: " . $conn->error;
          }
      } while ($conn->more_results() && $conn->next_result());
  } else {
      echo "Error al ejecutar SQL: " . $conn->error;
  }

}

function crearTablaHistorial($conn){
  $sql = "
  DROP TABLE IF EXISTS `historial`;
  CREATE TABLE `historial` (
    `cod_his` int(11) NOT NULL AUTO_INCREMENT,
    `cod_rd` int(11) DEFAULT NULL,
    `paciente_rd` int(11) DEFAULT NULL,
    `cod_cds` int(11) DEFAULT NULL,
    `hoja` int(11) DEFAULT NULL,
    `titulo` char(100),
    `subtitulo` char(100),
    `tipoHistorial` char(15) DEFAULT NULL,
    `fecha` date DEFAULT NULL,
    `hora` time DEFAULT NULL,
    `estado` char(20) DEFAULT NULL,
    PRIMARY KEY (`cod_his`),
    KEY `cod_rd` (`cod_rd`),
    KEY `paciente_rd` (`paciente_rd`),
    KEY `cod_cds` (`cod_cds`),
    CONSTRAINT `historialh_ibfk_1` FOREIGN KEY (`cod_rd`) REFERENCES `registro_diario` (`cod_rd`),
    CONSTRAINT `historialh_ibfk_2` FOREIGN KEY (`paciente_rd`) REFERENCES `usuario` (`cod_usuario`),
    CONSTRAINT `historialh_ibfk_3` FOREIGN KEY (`cod_cds`) REFERENCES `centro_de_salud` (`cod_cds`)
  ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
  ";
echo "llego aquie";
  // Ejecutar consulta
  if ($conn->multi_query($sql)) {
    echo "es aqui";
      do {
          // almacenar resultados si hay alguno
          if ($result = $conn->store_result()) {
              $result->free();
          }
          // imprimir errores
          if ($conn->error) {
              echo "Error: aaaaa" . $conn->error;
          }
      } while ($conn->more_results() && $conn->next_result());
  } else {
      echo "Error al ejecutar SQL: " . $conn->error;
  }
}

function crearTablaHistorialDatos($conn){
  $sql = "
  DROP TABLE IF EXISTS `historial_dato`;
  CREATE TABLE `historial_dato` (
    `cod_his_dat` int(11) NOT NULL AUTO_INCREMENT,
    `cod_rd` int(11) DEFAULT NULL,
    `paciente_rd` int(11) DEFAULT NULL,
    `cod_cds` int(11) DEFAULT NULL,
    `zona_his` char(70) DEFAULT NULL,
    `cod_responsable_familia_his` int(11) DEFAULT NULL,
    `descripcion` char(255),
    `hoja` int default 0,
    `paginas` int default 0,
    `nombre_imagen` VARCHAR(255) default null,
    `ruta_imagen` VARCHAR(255) default null,
    `imc` char(50) DEFAULT '',
    `temp` char(50) DEFAULT '',
    `fc` char(50) DEFAULT '',
    `pa` char(50) DEFAULT '',
    `fr` char(50) DEFAULT '',
    `motivo_consulta` mediumtext,
    `subjetivo` mediumtext,
    `objetivo` mediumtext,
    `analisis` mediumtext,
    `tratamiento` mediumtext,
    `evaluacion_de_seguimiento` mediumtext,
    `cod_responsable_medico` int DEFAULT NULL,
    `cod_his` int DEFAULT NULL,
    `fecha` date DEFAULT NULL,
    `hora` time DEFAULT NULL,
    `tipoDato` int DEFAULT 0,
    `estado` char(20) DEFAULT NULL,
    PRIMARY KEY (`cod_his_dat`),
    KEY `cod_rd` (`cod_rd`),
    KEY `paciente_rd` (`paciente_rd`),
    KEY `cod_cds` (`cod_cds`),
    KEY `cod_responsable_familia_his` (`cod_responsable_familia_his`),
    KEY `cod_responsable_medico` (`cod_responsable_medico`),
    KEY `cod_his` (`cod_his`),
    CONSTRAINT `historialDatos_ibfk_1` FOREIGN KEY (`cod_rd`) REFERENCES `registro_diario` (`cod_rd`),
    CONSTRAINT `historialDatos_ibfk_2` FOREIGN KEY (`paciente_rd`) REFERENCES `usuario` (`cod_usuario`),
    CONSTRAINT `historialDatos_ibfk_3` FOREIGN KEY (`cod_cds`) REFERENCES `centro_de_salud` (`cod_cds`),
    CONSTRAINT `historialDatos_ibfk_4` FOREIGN KEY (`cod_responsable_familia_his`) REFERENCES `usuario` (`cod_usuario`),
    CONSTRAINT `historialDatos_ibfk_5` FOREIGN KEY (`cod_responsable_medico`) REFERENCES `usuario` (`cod_usuario`),
    CONSTRAINT `historialDatos_ibfk_6` FOREIGN KEY (`cod_his`) REFERENCES `historial` (`cod_his`)
  ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
  ";

  // Ejecutar consulta
  if ($conn->multi_query($sql)) {
    echo "historial de documentos";
      do {
          // almacenar resultados si hay alguno
          if ($result = $conn->store_result()) {
              $result->free();
          }
          // imprimir errores
          if ($conn->error) {
              echo "Error: " . $conn->error;
          }
      } while ($conn->more_results() && $conn->next_result());
  } else {
      echo "Error al ejecutar SQL: " . $conn->error;
  }
}

function crearTablaProducto($conn){
  $sql = "DROP TABLE IF EXISTS `producto`";
  if (!$conn->query($sql)) {
      die("Error al eliminar la tablas: " . $conn->error);
  }

  // Crear la tabla
  $sql = "CREATE TABLE `producto` (
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
  ) ENGINE=InnoDB AUTO_INCREMENT=143 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci";

  if (!$conn->query($sql)) {
      die("Error al crear la tabla: " . $conn->error);
  }

  // Insertar datos
  $sql =
  "insert into `producto`(`cod_generico`,`codigo`,`nombre`,`enfermedad`,`vitrina`,`stockmin`,`stockmax`,`cod_forma`,
  `cod_conc`,
  `cod_usuario`,`stock_producto`,`cantidad_total`,`fechaHora`,`estado`)
  VALUES('1','J0504','Aciclovir','','','0','0','1','21','5','si','0',null,'activo'),
  ('2','J0105','Amoxicilina','','','0','0','1','31','5','si','0',null,'activo'),
  ('3','J0106','Amoxicilina','','','0','0','1','8','5','si','0',null,'activo'),
  ('4','R0501','Antigripal (Paracetamol + Antihistaminico + Vasoconstrictor con o sin Cafeina)','','','0','0','1','12','5','si','0',null,'activo'),
  ('5','A0701','Carbon medicinal activado','','','4','1','5','12','5','no','115',null,'activo'),
  ('6','J0126','Ceftriaxona','','','0','0','2','31','5','si','0',null,'activo'),
  ('7','J0127','Ciprofloxacina','','','0','0','1','8','5','si','0',null,'activo'),
  ('8','R0603','Clorfenamina (Clorfeniramina)','','','0','0','2','13','5','si','0',null,'activo'),
  ('9','G0102','Clotrimazol','','','0','0','8','19','5','si','0',null,'activo'),
  ('10','A1106','Complejo B (B1 + B6 + B12)','','','0','0','1','33','5','si','0',null,'activo'),
  ('11','A1107','Complejo B (B1 + B6 + B12)','','','0','0','2','33','5','si','0',null,'activo'),
  ('12','V0604','Complemento nutricional (Carmelo)','','','0','0','5','33','5','si','0',null,'desactivo'),
  ('13','V0607','Complemento nutricional (Nutri Mama con Canahua probiotico y Omega-3)','','','0','0','5','33','5','si','0',null,'activo'),
  ('14','V0603','Complemento nutricional (Nutribebe)','','','0','0','5','33','5','si','0',null,'activo'),
  ('15','J0137','Cotrimoxazol (Sulfametoxazol + Trimetoprima)','','','0','0','1','1','5','si','0',null,'activo'),
  ('16','J0138','Cotrimoxazol (Sulfametoxazol + Trimetoprima)','','','0','0','3','2','5','si','0',null,'activo'),
  ('17','H0204','Dexametasona','','','3','1','2','3','5','si','0',null,'activo'),
  ('18','R0503','Dextrometorfano bromhidrato','','','0','0','7','4','5','si','0',null,'activo'),
  ('19','N0505','Diazepam','','','0','0','2','5','5','si','0',null,'activo'),
  ('20','M0102','Diclofenaco Sodico','','','0','0','1','6','5','si','0',null,'activo'),
  ('21','M0103','Diclofenaco Sodico','','','0','0','2','7','5','si','0',null,'activo'),
  ('22','J0142','Dicloxacilina sodica','','','0','0','3','9','5','si','0',null,'activo'),
  ('23','C0901','Enalapril maleato','','','0','0','11','5','5','si','0',null,'activo'),
  ('24','C0110','Epinefrina (Adrenalina)','','','0','0','2','10','5','si','0',null,'activo'),
  ('25','J0145','Eritromicina (estearato)','','','0','0','12','8','5','si','0',null,'activo'),
  ('26','J0146','Eritromicina (etilsuccinato)','','','0','0','3','9','5','si','0',null,'activo'),
  ('27','A0604','Fibra natural','','','0','0','13','12','5','si','0',null,'activo'),
  ('28','B0202','Fitomenadiona (Vitamina K1)','','','0','0','2','13','5','si','0',null,'activo'),
  ('29','C0304','Furosemida','','','0','0','11','14','5','si','0',null,'activo'),
  ('30','J0149','Gentamicina sulfato','','','0','0','2','16','5','si','0',null,'activo'),
  ('31','C0306','Hidroclorotiazida','','','0','0','11','6','5','si','0',null,'activo'),
  ('32','D0704','Hidrocortisona acetato','','','0','0','4','18','5','si','0',null,'activo'),
  ('33','H0205','Hidrocortisona succinato sodico','','','0','0','2','19','5','si','0',null,'activo'),
  ('34','A0201','Hidroxido de aluminio y magnesio','','','0','0','3','20','5','si','0',null,'activo'),
  ('35','M0105','Ibuprofeno','','','0','0','1','21','5','si','0',null,'activo'),
  ('36','M0104','Ibuprofeno','','','0','0','3','22','5','si','0',null,'activo'),
  ('37','M0106','Indometacina','','','0','0','12','23','5','si','0',null,'activo'),
  ('38','M0107','Indometacina','','','0','0','14','19','5','si','0',null,'activo'),
  ('39','M0109','Ketorolaco','','','0','0','2','24','5','si','0',null,'activo'),
  ('40','A0607','Lactulosa','','','0','0','15','25','5','si','0',null,'activo'),
  ('41','G0319','Levonorgestrel','','','0','0','16','27','5','si','0',null,'activo'),
  ('42','N0109','Lidocaina','','','0','0','17','29','5','si','0',null,'activo'),
  ('43','N0112','Lidocaina clorhidrato sin conservante','','','0','0','2','29','5','si','0',null,'activo'),
  ('44','P0205','Mebendazol','','','0','0','1','8','5','si','0',null,'activo'),
  ('45','G0313','Medroxiprogesterona acetato','','','0','0','2','30','5','si','0',null,'activo'),
  ('46','N0205','Metamizol (Dipirona)','','','0','0','2','31','5','si','0',null,'activo'),
  ('47','C0204','Metildopa (Alfametildopa)','','','0','0','1','8','5','si','0',null,'activo'),
  ('48','A0307','Metoclopramida','','','0','0','1','5','5','si','0',null,'activo'),
  ('49','P0109','Metronidazol','','','0','0','1','8','5','si','0',null,'activo'),
  ('50','G0104','Metronidazol','','','0','0','8','8','5','si','0',null,'activo'),
  ('51','P0106','Metronidazol','','','0','0','3','9','5','si','0',null,'activo'),
  ('52','B0305','Micronutrientes (Vit.C+Vit.A+Fe+Zn+Ac.Folico) (Chispitas nutricionales)','','','0','0','5','33','5','si','0',null,'activo'),
  ('53','A1109','Multivitaminas','','','0','0','1','33','5','si','0',null,'activo'),
  ('54','C0808','Nifedipino','','','0','0','18','5','5','si','0',null,'activo'),
  ('55','D0104','Nistatina','','','0','0','4','34','5','si','0',null,'activo'),
  ('56','A0704','Nistatina','','','0','0','3','35','5','si','0',null,'activo'),
  ('57','J0152','Nitrofurantoina','','','0','0','3','36','5','si','0',null,'activo'),
  ('58','A0202','Omeprazol','','','0','0','10','37','5','si','0',null,'activo'),
  ('59','D0202','Oxido de Zinc con o sin aceite','','','0','0','19','12','5','si','0',null,'activo'),
  ('60','G0209','Oxitocina','','','0','0','2','39','5','si','0',null,'activo'),
  ('61','N0212','Paracetamol (Acetaminofeno)','','','0','0','1','19','5','si','0',null,'activo'),
  ('62','N0208','Paracetamol (Acetaminofeno)','','','0','0','1','8','5','si','0',null,'activo'),
  ('63','N0209','Paracetamol (Acetaminofeno)','','','0','0','7','41','5','si','0',null,'activo'),
  ('64','P0208','Pirantel pamoato','','','0','0','3','9','5','si','0',null,'activo'),
  ('65','A0204','Ranitidina','','','0','0','2','6','5','si','0',null,'activo'),
  ('66','A1115','Retinol (Vitamina A)','','','0','0','22','44','5','si','0',null,'activo'),
  ('67','S0120','Sulfacetamida','','','0','0','6','50','5','si','0',null,'activo'),
  ('68','P0206','Tiabendazol','','','0','0','1','6','5','si','0',null,'activo'),
  ('69','C0101','Valproato de sodio','','','0','0','1','8','5','si','0',null,'activo'),
  ('70','J0125','Vancomicina','','','0','0','2','8','5','si','0',null,'activo'),
  ('71','A0305','Vitaminas (Complejo B)','','','0','0','2','33','5','si','0',null,'desactivo'),
  ('72','J0504','Aciclovir','','','0','0','1','21','5','si','0',null,'activo'),
  ('73','J0105','Amoxicilina','','','0','0','1','31','5','si','0',null,'activo'),
  ('74','J0106','Amoxicilina','','','0','0','1','8','5','si','0',null,'activo'),
  ('75','R0501','Antigripal (Paracetamol + Antihistaminico + Vasoconstrictor con o sin Cafeina)','','','0','0','1','12','5','si','0',null,'activo'),
  ('76','A0701','Carbon medicinal activado','','','0','0','5','12','5','si','0',null,'desactivo'),
  ('77','J0126','Ceftriaxona','','','0','0','2','31','5','si','0',null,'activo'),
  ('78','J0127','Ciprofloxacina','','','0','0','1','8','5','si','0',null,'activo'),
  ('79','R0603','Clorfenamina (Clorfeniramina)','','','0','0','2','13','5','si','0',null,'activo'),
  ('80','G0102','Clotrimazol','','','0','0','8','19','5','si','0',null,'activo'),
  ('81','A1106','Complejo B (B1 + B6 + B12)','','','0','0','1','33','5','si','0',null,'activo'),
  ('82','A1107','Complejo B (B1 + B6 + B12)','','','0','0','2','33','5','si','0',null,'activo'),
  ('83','V0604','Complemento nutricional (Carmelo)','','','0','0','5','33','5','si','0',null,'activo'),
  ('84','V0607','Complemento nutricional (Nutri Mama con Canahua probiotico y Omega-3)','','','0','0','5','33','5','si','0',null,'activo'),
  ('85','V0603','Complemento nutricional (Nutribebe)','','','0','0','5','33','5','si','0',null,'activo'),
  ('86','J0137','Cotrimoxazol (Sulfametoxazol + Trimetoprima)','','','0','0','1','1','5','si','0',null,'activo'),
  ('87','H0204','Dexametasona','','','0','0','2','3','5','si','0',null,'desactivo'),
  ('88','R0503','Dextrometorfano bromhidrato','','','0','0','7','4','5','si','0',null,'activo'),
  ('89','N0505','Diazepam','','','0','0','2','5','5','si','0',null,'activo'),
  ('90','M0102','Diclofenaco Sodico','','','0','0','1','6','5','si','0',null,'activo'),
  ('91','M0103','Diclofenaco Sodico','','','0','0','2','7','5','si','0',null,'activo'),
  ('92','J0141','Dicloxacilina sodica','','','0','0','10','8','5','si','0',null,'activo'),
  ('93','J0142','Dicloxacilina sodica','','','0','0','3','9','5','si','0',null,'activo'),
  ('94','C0901','Enalapril maleato','','','0','0','11','5','5','si','0',null,'activo'),
  ('95','C0110','Epinefrina (Adrenalina)','','','0','0','2','10','5','si','0',null,'activo'),
  ('96','J0145','Eritromicina (estearato)','','','0','0','12','8','5','si','0',null,'activo'),
  ('97','J0146','Eritromicina (etilsuccinato)','','','0','0','3','9','5','si','0',null,'activo'),
  ('98','A0604','Fibra natural','','','0','0','13','12','5','si','0',null,'activo'),
  ('99','B0202','Fitomenadiona (Vitamina K1)','','','0','0','2','13','5','si','0',null,'activo'),
  ('100','C0304','Furosemida','','','0','0','11','14','5','si','0',null,'activo'),
  ('101','J0149','Gentamicina sulfato','','','0','0','2','16','5','si','0',null,'activo'),
  ('102','C0306','Hidroclorotiazida','','','0','0','11','6','5','si','0',null,'activo'),
  ('103','D0704','Hidrocortisona acetato','','','0','0','4','18','5','si','0',null,'activo'),
  ('104','H0205','Hidrocortisona succinato sodico','','','0','0','2','19','5','si','0',null,'activo'),
  ('105','A0201','Hidroxido de aluminio y magnesio','','','0','0','3','20','5','si','0',null,'activo'),
  ('106','M0105','Ibuprofeno','','','0','0','1','21','5','si','0',null,'activo'),
  ('107','M0104','Ibuprofeno','','','0','0','3','22','5','si','0',null,'activo'),
  ('108','M0106','Indometacina','','','0','0','12','23','5','si','0',null,'activo'),
  ('109','M0107','Indometacina','','','0','0','14','19','5','si','0',null,'activo'),
  ('110','M0109','Ketorolaco','','','0','0','2','24','5','si','0',null,'activo'),
  ('111','A0607','Lactulosa','','','0','0','15','25','5','si','0',null,'activo'),
  ('112','G0319','Levonorgestrel','','','0','0','16','27','5','si','0',null,'activo'),
  ('113','N0109','Lidocaina','','','0','0','17','29','5','si','0',null,'activo'),
  ('114','N0112','Lidocaina clorhidrato sin conservante','','','0','0','2','29','5','si','0',null,'activo'),
  ('115','C0902','Losartan','','','0','0','1','6','5','si','0',null,'activo'),
  ('116','P0205','Mebendazol','','','0','0','1','8','5','si','0',null,'activo'),
  ('117','G0313','Medroxiprogesterona acetato','','','0','0','2','30','5','si','0',null,'activo'),
  ('118','N0205','Metamizol (Dipirona)','','','0','0','2','31','5','si','0',null,'activo'),
  ('119','C0204','Metildopa (Alfametildopa)','','','0','0','1','8','5','si','0',null,'activo'),
  ('120','A0307','Metoclopramida','','','0','0','1','5','5','si','0',null,'activo'),
  ('121','P0109','Metronidazol','','','0','0','1','8','5','si','0',null,'activo'),
  ('122','G0104','Metronidazol','','','0','0','8','8','5','si','0',null,'activo'),
  ('123','P0106','Metronidazol','','','0','0','3','9','5','si','0',null,'activo'),
  ('124','B0305','Micronutrientes (Vit.C+Vit.A+Fe+Zn+Ac.Folico) (Chispitas nutricionales)','','','0','0','5','33','5','si','0',null,'activo'),
  ('125','A1109','Multivitaminas','','','0','0','1','33','5','si','0',null,'activo'),
  ('126','C0808','Nifedipino','','','0','0','18','5','5','si','0',null,'activo'),
  ('127','D0104','Nistatina','','','0','0','4','34','5','si','0',null,'activo'),
  ('128','A0704','Nistatina','','','0','0','3','35','5','si','0',null,'activo'),
  ('129','J0152','Nitrofurantoina','','','0','0','3','36','5','si','0',null,'activo'),
  ('130','A0202','Omeprazol','','','0','0','10','37','5','si','0',null,'activo'),
  ('131','G0209','Oxitocina','','','0','0','2','39','5','si','0',null,'activo'),
  ('132','N0212','Paracetamol (Acetaminofeno)','','','0','0','1','19','5','si','0',null,'activo'),
  ('133','N0208','Paracetamol (Acetaminofeno)','','','0','0','1','8','5','si','0',null,'activo'),
  ('134','N0209','Paracetamol (Acetaminofeno)','','','0','0','7','41','5','si','0',null,'activo'),
  ('135','P0208','Pirantel pamoato','','','0','0','3','9','5','si','0',null,'activo'),
  ('136','A0204','Ranitidina','','','0','0','2','6','5','si','0',null,'activo'),
  ('137','A1115','Retinol (Vitamina A)','','','0','0','22','44','5','si','0',null,'activo'),
  ('138','S0120','Sulfacetamida','','','0','0','6','50','5','si','0',null,'activo'),
  ('139','P0206','Tiabendazol','','','0','0','1','6','5','si','0',null,'activo'),
  ('140','C0101','Valproato de sodio','','','0','0','1','8','5','si','0',null,'activo'),
  ('141','J0125','Vancomicina','','','0','0','2','8','5','si','0',null,'activo'),
  ('142','A0305','Vitaminas (Complejo B)','','','3','4','2','33','5','si','0',null,'activo')";


  if (!$conn->query($sql)) {
      die("Error al insertar datos: " . $conn->error);
  }
}

function crearTablaProductoSolicitado($conn){
  // Eliminar la tabla si ya existe
  $sql = "DROP TABLE IF EXISTS `productosolicitado`";
  if (!$conn->query($sql)) {
      die("Error al eliminar la tabla: " . $conn->error);
  }

  // Crear la tabla
  $sql = "CREATE TABLE `productosolicitado` (
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
  ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";

  if (!$conn->query($sql)) {
      die("Error al crear la tabla: " . $conn->error);
  }

}

function crearTablaRegistroDiario($conn){
  $sql = "DROP TABLE IF EXISTS `registro_diario`";
  if (!$conn->query($sql)) {
      die("Error al eliminar la tabla: " . $conn->error);
  }

  // Crear la tabla
  $sql = "CREATE TABLE `registro_diario` (
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
  ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";

  if (!$conn->query($sql)) {
      die("Error al crear la tabla: " . $conn->error);
  }
}

function crearTablaSalida($conn){
  $sql = "DROP TABLE IF EXISTS `salida`";
  if (!$conn->query($sql)) {
      die("Error al eliminar la tabla: " . $conn->error);
  }

  // Crear la tabla
  $sql = "CREATE TABLE `salida` (
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
  ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";

  if (!$conn->query($sql)) {
      die("Error al crear la tabla: " . $conn->error);
  }

}

function crearTablaServicio($conn){
  $sql = "DROP TABLE IF EXISTS `servicio`";
  if (!$conn->query($sql)) {
      die("Error al eliminar la tabla: " . $conn->error);
  }

  // Crear la tabla
  $sql = "CREATE TABLE `servicio` (
      `cod_servicio` int(11) NOT NULL AUTO_INCREMENT,
      `nombre_servicio` varchar(100) DEFAULT NULL,
      `descripcion_servicio` varchar(100) DEFAULT NULL,
      `estado` char(10) DEFAULT NULL,
      PRIMARY KEY (`cod_servicio`)
  ) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";

  if (!$conn->query($sql)) {
      die("Error al crear la tabla: " . $conn->error);
  }

  // Insertar datos en la tabla
  $sql = "INSERT INTO `servicio` (`cod_servicio`, `nombre_servicio`, `descripcion_servicio`, `estado`) VALUES
      (1, 'Enfermería', 'encargado de vacunas y otros', 'activo'),
      (2, 'Consultorio Odontológico', 'encargado de la salud de los dientes', 'activo'),
      (3, 'Servicio del PAI', 'pai', 'activo'),
      (4, 'Crecimiento y desarrollo', '', 'activo'),
      (5, 'Consultorio Médico', '', 'activo'),
      (6, 'Farmacia', 'medicamentos y mas', 'activo'),
      (8, 'Emergencias', 'pacientes en gravedad y en peligro de muerte', 'activo')";

  if (!$conn->query($sql)) {
      die("Error al insertar datos: " . $conn->error);
  }

}

function crearTablaUsuario($conn){
  // Eliminar la tabla si ya existe
  $sql = "DROP TABLE IF EXISTS `usuario`";
  if (!$conn->query($sql)) {
      die("Error al eliminar la tabla: " . $conn->error);
  }

  // Crear la tabla
  $sql = "CREATE TABLE `usuario` (
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
      `idioma_usuario` char(45) DEFAULT NULL,
      `nro_seguro_usuario` char(150) DEFAULT NULL,
      `nro_car_form_usuario` char(200) DEFAULT NULL,
      `sexo_usuario` char(20) DEFAULT NULL,
      `peso_usuario` decimal(10,2) DEFAULT NULL,
      `talla_usuario` decimal(10,2) DEFAULT NULL,
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
  ) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";

  if (!$conn->query($sql)) {
      die("Error al crear la tabla: " . $conn->error);
  }
  // Consulta SQL
  $encoded_password1 = $conn->real_escape_string('$2y$10$UiDpH8cKEP8Fo6ogkfqnlOuk2c1tvqm8s0MKLQ1pmCCFWbdqBfn6W');
  $encoded_password2 = $conn->real_escape_string('$2y$10$wEhNpR35jTOKFqK7sLRAaOCcvXYYiqqY9znZwGqAJgdC6PZqkGwNK');
  $encoded_password3 = $conn->real_escape_string('$2y$10$Uo.szMVEPkBINp.2FrLnk.M0NjZRqCQRZw6PohOy9RRp2YvQc8rfS');
  $encoded_password4 = $conn->real_escape_string('$2y$10$HcDmz5/npUWmiwxbW0QK8.fp2fvu0xcbAU8McwvvJDRBf29TvuroS');
  $encoded_password5 = $conn->real_escape_string('$2y$10$BSVeieu4vZHHT4YMAdGCweGhCQbKuCenaFIM.xm5ZgXRRoGW0ie4S');

  $sql = "
      INSERT INTO `usuario`
        (`cod_usuario`, `ci_usuario`, `usuario`, `nombre_usuario`, `ap_usuario`, `am_usuario`, `fecha_nac_usuario`, `edad_usuario`,
         `telefono_usuario`, `direccion_usuario`, `profesion_usuario`, `especialidad_usuario`, `ocupacion_usuario`, `comunidad_usuario`,
         `estado_civil_usuario`, `escolaridad_usuario`, `autoidentificacion_usuario`, `nro_seguro_usuario`, `nro_car_form_usuario`,
         `sexo_usuario`, `tipo_usuario`, `contrasena_usuario`, `cod_cds`, `estado`)
      VALUES
        ('1', '7308752', 'encargado', 'Noelia', 'Mamani', 'Nina', null, '0', '78451256', 'calle La paz entre linares', 'Licenciada en enfermeria', 'enfermera', '', '', '', '', '', '', '', '', 'encargado', '$encoded_password1', '1', 'activo'),
        ('2', '75451256', 'admision', 'Sandra', 'Huanca', 'Nina', null, '0', '63258974', 'calle brasil', 'medico', 'Pediatra', '', '', '', '', '', '', '', '', 'admision', '$encoded_password2', '1', 'activo'),
        ('3', '75451256', 'medico', 'Salome', 'mamani', 'romina', null, '0', '63258974', 'calle brasil', 'medico', 'Pediatra', '', '', '', '', '', '', '', '', 'medico', '$encoded_password3', '1', 'activo'),
        ('4', '72354512', 'admin', 'Carlos', 'Mamani', 'Lopes', null, '0', '63247512', 'calle ecuador en tre la paz', 'Ingeniero informatico', 'computacion', '', '', '', '', '', '', '', '', 'admin', '$encoded_password4', '1', 'activo'),
        ('5', '78451245', 'mario', 'mario', 'diaz', 'mamani', null, '0', '63214578', 'calle oruro', 'farmaceutico', 'ninguna', '', '', '', '', '', '', '', '', 'farmacia', '$encoded_password5', '1', 'activo');
  ";

  // Ejecutar la consulta
  if ($conn->multi_query($sql) === TRUE) {
      echo "Datos insertados correctamente";
  } else {
      echo "Error al insertar los datos: " . $conn->error;
  }

}

function crearTablaSessiones($conn){
  // Eliminar la tabla si ya existe
  $sql = "DROP TABLE IF EXISTS `sessiones`";
  if (!$conn->query($sql)) {
      die("Error al eliminar la tabla: " . $conn->error);
  }
  $sql = "CREATE TABLE `sessiones` (
      `session_id` VARCHAR(255) PRIMARY KEY,
      `cod_usuario` INT NOT NULL,
      `usuario` VARCHAR(255) NOT NULL,
      `nombre_usuario` VARCHAR(255) NOT NULL,
      `ap_usuario` VARCHAR(255) NOT NULL,
      `am_usuario` VARCHAR(255) NOT NULL,
      `tipo_usuario` VARCHAR(255) NOT NULL,
      `session_start` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
      `session_end` char(15)
  ) ENGINE=InnoDB CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";
  if (!$conn->query($sql)) {
      die("Error al crear la tabla: " . $conn->error);
  }

}
?>
