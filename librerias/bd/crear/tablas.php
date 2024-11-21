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
      crearTablaPatologias($conn);
      echo "<br>tabla primera creado correctamente<br>";
      crearTablaServicio($conn);
      echo "<br>tabla1<br>";
      crearTablasCDS($conn);echo "<br>tabla2<br>";
      crearTablaConsultas($conn);echo "<br>tabla3<br>";
      crearTablaUsuario($conn);echo "<br>tabla4<br>";
      crearTablaRegistroDiario($conn);echo "<br>tabla5<br>";
      crearTablaHistorial($conn);echo "<br>tabla6<br>";
      crearTablaHistorialDatos($conn); echo  "<br>tabla 7<br>";
      crearTablaRepresentante($conn); echo  "<br>tabla representante<br>";
      crearTablaProveedor($conn); echo  "<br>tabla proveedor<br>";

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


function crearTablaPatologias($conn){
  $sql = "
    DROP TABLE IF EXISTS `patologias`;
    CREATE TABLE `patologias` (
      `cod_pat` INT(11) NOT NULL AUTO_INCREMENT,
      `nombre` VARCHAR(100) NOT NULL,
      `descripcion` TEXT DEFAULT NULL,
      `sintomas` TEXT DEFAULT NULL,
      `tratamiento` TEXT DEFAULT NULL,
      `fecha_registro` DATE DEFAULT NULL,
      `estado` VARCHAR(10) DEFAULT 'activo',
      PRIMARY KEY (`cod_pat`)
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
              echo "Error ta: " . $conn->error;
          }
      } while ($conn->more_results() && $conn->next_result());
  } else {
      echo "Error al ejecutar SQL patologias: " . $conn->error;
  }

  // SQL para insertar datos en la tabla `consultas`
  $sql_inserts = "
  INSERT INTO `patologias` (`cod_pat`, `nombre`, `descripcion`, `sintomas`, `tratamiento`, `fecha_registro`) VALUES
    (1, 'Diabetes tipo 2', 'Trastorno crónico que afecta la forma en que el cuerpo procesa el azúcar en sangre.', 'Aumento de la sed, hambre extrema, pérdida de peso', 'Control de la dieta, medicación oral, insulina', '2024-10-29'),
    (2, 'Hipertensión', 'Elevación persistente de la presión arterial en las arterias.', 'Dolor de cabeza, visión borrosa, dificultad para respirar', 'Modificaciones en el estilo de vida, antihipertensivos', '2024-10-29'),
    (3, 'Asma', 'Enfermedad que causa inflamación y estrechamiento de las vías respiratorias.', 'Dificultad para respirar, sibilancias, opresión en el pecho', 'Inhaladores de rescate y controladores', '2024-10-29'),
    (4, 'Gastritis', 'Inflamación de la mucosa del estómago.', 'Dolor abdominal, náuseas, vómitos', 'Antiacidos, inhibidores de la bomba de protones', '2024-10-29'),
    (5, 'Artritis', 'Inflamación de una o más articulaciones que causa dolor y rigidez.', 'Dolor articular, hinchazón, disminución del rango de movimiento', 'Antiinflamatorios, fisioterapia', '2024-10-29'),
    (6, 'Anemia', 'Reducción de los glóbulos rojos o hemoglobina en la sangre.', 'Fatiga, debilidad, piel pálida', 'Suplementos de hierro, cambio de dieta', '2024-10-29'),
    (7, 'Bronquitis', 'Inflamación de los bronquios, a menudo causada por infección viral.', 'Tos, producción de moco, dificultad para respirar', 'Reposo, líquidos, medicamentos para la tos', '2024-10-29'),
    (8, 'Neumonía', 'Infección de los pulmones que causa inflamación de los alvéolos.', 'Fiebre, escalofríos, dolor en el pecho', 'Antibióticos, líquidos, descanso', '2024-10-29'),
    (9, 'Migraña', 'Cefalea recurrente que puede causar náuseas y sensibilidad a la luz.', 'Dolor de cabeza intenso, sensibilidad a la luz', 'Analgesia, triptanos, evitar desencadenantes', '2024-10-29'),
    (10, 'Amigdalitis', 'Inflamación de las amígdalas, generalmente debido a una infección.', 'Dolor de garganta, dificultad para tragar, fiebre', 'Antibióticos, analgésicos, reposo', '2024-10-29'),
    (11, 'Colitis', 'Inflamación del colon que causa dolor abdominal y diarrea.', 'Dolor abdominal, diarrea, fatiga', 'Dieta baja en residuos, antibióticos', '2024-10-29'),
    (12, 'Eczema', 'Condición que causa picazón, enrojecimiento y erupciones en la piel.', 'Picazón, erupciones, piel seca', 'Cremas hidratantes, esteroides tópicos', '2024-10-29'),
    (13, 'Psoriasis', 'Enfermedad autoinmune que causa parches escamosos en la piel.', 'Parche de piel escamosa, dolor en articulaciones', 'Cremas tópicas, fototerapia, medicamentos', '2024-10-29'),
    (14, 'Fibromialgia', 'Trastorno de dolor crónico que afecta músculos y tejidos blandos.', 'Dolor muscular, fatiga, trastornos del sueño', 'Ejercicio, terapia física, analgésicos', '2024-10-29'),
    (15, 'Celiaquía', 'Reacción inmunitaria al gluten, afecta el intestino delgado.', 'Diarrea, dolor abdominal, pérdida de peso', 'Dieta sin gluten', '2024-10-29'),
    (16, 'Hepatitis B', 'Infección viral que afecta el hígado.', 'Ictericia, fatiga, dolor abdominal', 'Antivirales, vacunación, cuidados de soporte', '2024-10-29'),
    (17, 'Epilepsia', 'Trastorno neurológico que causa convulsiones recurrentes.', 'Convulsiones, pérdida de conciencia', 'Medicamentos antiepilépticos', '2024-10-29'),
    (18, 'Tiroiditis', 'Inflamación de la glándula tiroides.', 'Fatiga, aumento de peso, dolor de cuello', 'Hormonas tiroideas, antiinflamatorios', '2024-10-29'),
    (19, 'SIDA', 'Inmunodeficiencia causada por el VIH, afecta el sistema inmune.', 'Fiebre, pérdida de peso, infecciones oportunistas', 'Antirretrovirales, cuidados de soporte', '2024-10-29'),
    (20, 'Obesidad', 'Exceso de grasa corporal que aumenta el riesgo de problemas de salud.', 'Aumento de peso, problemas respiratorios, fatiga', 'Control de dieta, ejercicio, terapia médica', '2024-10-29'),
    (21, 'Síndrome de Fatiga Crónica', 'Trastorno caracterizado por fatiga extrema sin causa clara.', 'Fatiga persistente, dolor muscular, problemas de memoria', 'Terapia cognitiva, actividad física leve', '2024-10-29'),
    (22, 'Esclerosis múltiple', 'Enfermedad autoinmune que afecta el sistema nervioso central.', 'Entumecimiento, pérdida de coordinación', 'Inmunosupresores, fisioterapia', '2024-10-29'),
    (23, 'Alzhéimer', 'Demencia progresiva que afecta memoria y otras funciones mentales.', 'Pérdida de memoria, cambios en el comportamiento', 'Medicamentos para mejorar los síntomas', '2024-10-29'),
    (24, 'Enfermedad de Parkinson', 'Trastorno neurológico que afecta el movimiento.', 'Temblor, rigidez muscular, lentitud en el movimiento', 'Medicamentos, terapia física', '2024-10-29'),
    (25, 'Depresión', 'Trastorno de ánimo caracterizado por tristeza y pérdida de interés.', 'Tristeza persistente, falta de energía', 'Terapia, antidepresivos', '2024-10-29'),
    (26, 'Gripe', 'Enfermedad viral respiratoria que causa fiebre y tos.', 'Fiebre, tos, dolores corporales', 'Descanso, líquidos, antivirales', '2024-10-29'),
    (27, 'Tendinitis', 'Inflamación de un tendón que causa dolor.', 'Dolor y rigidez en la articulación', 'Reposo, hielo, antiinflamatorios', '2024-10-29'),
    (28, 'Hernia', 'Protrusión de un órgano a través de una apertura en los músculos.', 'Dolor, bulto en la zona afectada', 'Cirugía, observación', '2024-10-29'),
    (29, 'Infección del tracto urinario', 'Infección que afecta las vías urinarias.', 'Dolor al orinar, necesidad frecuente de orinar', 'Antibióticos', '2024-10-29'),
    (30, 'Cálculos renales', 'Piedras que se forman en los riñones.', 'Dolor intenso, sangre en la orina', 'Aumento de líquidos, medicamentos', '2024-10-29'),
    (31, 'Acidez estomacal', 'Sensación de ardor en el pecho o la garganta.', 'Ardor, regurgitación', 'Antiacidos, cambios en la dieta', '2024-10-29'),
    (32, 'Conjuntivitis', 'Inflamación de la membrana que recubre el ojo.', 'Enrojecimiento, picazón, secreción', 'Compresas frías, colirios', '2024-10-29'),
    (33, 'Otitis', 'Inflamación del oído, a menudo por infección.', 'Dolor de oído, fiebre, dificultad para dormir', 'Antibióticos, analgésicos', '2024-10-29'),
    (34, 'Rinitis alérgica', 'Reacción alérgica que afecta la nariz.', 'Estornudos, picazón, congestión', 'Antihistamínicos, descongestionantes', '2024-10-29'),
    (35, 'Cáncer de mama', 'Crecimiento anormal de células en el tejido mamario.', 'Bulto en el seno, cambios en la piel', 'Cirugía, quimioterapia, radioterapia', '2024-10-29'),
    (36, 'Cáncer de pulmón', 'Crecimiento anormal de células en los pulmones.', 'Tos persistente, dolor en el pecho', 'Cirugía, quimioterapia, radioterapia', '2024-10-29'),
    (37, 'Cáncer de próstata', 'Crecimiento anormal de células en la glándula prostática.', 'Dificultad para orinar, dolor en la pelvis', 'Cirugía, radioterapia, hormonas', '2024-10-29'),
    (38, 'Cáncer de piel', 'Crecimiento anormal de células en la piel.', 'Lunares nuevos, cambios en lunares existentes', 'Cirugía, radioterapia', '2024-10-29'),
    (39, 'Cáncer de colon', 'Crecimiento anormal de células en el colon.', 'Sangre en las heces, cambio en hábitos intestinales', 'Cirugía, quimioterapia', '2024-10-29'),
    (40, 'Enfermedad de Crohn', 'Inflamación crónica del tracto digestivo.', 'Dolor abdominal, diarrea, fatiga', 'Medicamentos antiinflamatorios, cirugía', '2024-10-29'),
    (41, 'Lupus', 'Enfermedad autoinmune que afecta diversos órganos.', 'Fatiga, dolor articular, erupción en la piel', 'Medicamentos inmunosupresores', '2024-10-29'),
    (42, 'Esclerosis lateral amiotrófica', 'Enfermedad neurodegenerativa que afecta las neuronas motoras.', 'Debilidad muscular, calambres', 'Terapia ocupacional, cuidados de soporte', '2024-10-29'),
    (43, 'Trastorno de ansiedad generalizada', 'Trastorno que causa preocupación excesiva.', 'Inquietud, fatiga, dificultad para concentrarse', 'Terapia, medicamentos ansiolíticos', '2024-10-29'),
    (44, 'Crisis hipertensiva', 'Aumento súbito y grave de la presión arterial.', 'Dolor de cabeza, dificultad para respirar', 'Medicamentos para bajar la presión arterial', '2024-10-29'),
    (45, 'Intolerancia a la lactosa', 'Incapacidad para digerir el azúcar de la leche.', 'Hinchazón, diarrea, cólicos', 'Suplementos de lactasa, evitar productos lácteos', '2024-10-29'),
    (46, 'Estrés postraumático', 'Trastorno que ocurre después de experimentar un evento traumático.', 'Recuerdos intrusivos, pesadillas', 'Terapia cognitivo-conductual, medicamentos', '2024-10-29'),
    (47, 'Trastorno obsesivo-compulsivo', 'Trastorno que causa pensamientos intrusivos y rituales repetitivos.', 'Ansiedad, compulsiones', 'Terapia, medicamentos', '2024-10-29'),
    (48, 'Cálculos biliares', 'Piedras que se forman en la vesícula biliar.', 'Dolor abdominal, náuseas', 'Cirugía, cambios en la dieta', '2024-10-29'),
    (49, 'Dermatitis de contacto', 'Reacción inflamatoria en la piel debido al contacto con irritantes.', 'Erupción, picazón', 'Evitar el irritante, cremas tópicas', '2024-10-29'),
    (50, 'Varicela', 'Infección viral que causa picazón y erupción cutánea.', 'Fiebre, sarpullido, cansancio', 'Vacunación, antihistamínicos', '2024-10-29'),
    (51, 'Hiperlipidemia', 'Elevación de lípidos en sangre, incluyendo colesterol y triglicéridos.', 'Generalmente asintomático', 'Cambios en la dieta, medicamentos', '2024-10-29'),
    (52, 'Acné', 'Trastorno de la piel que causa brotes de espinillas.', 'Espinillas, granos, cicatrices', 'Tratamientos tópicos, antibióticos', '2024-10-29'),
    (53, 'Infecciones de transmisión sexual', 'Infecciones adquiridas a través de relaciones sexuales.', 'Dolor al orinar, flujo inusual', 'Antibióticos o antivirales', '2024-10-29'),
    (54, 'Deshidratación', 'Falta de suficientes líquidos en el cuerpo.', 'Sed intensa, boca seca, fatiga', 'Rehidratación, solución electrolítica', '2024-10-29'),
    (55, 'Hipotensión', 'Presión arterial anormalmente baja.', 'Mareos, desmayos, fatiga', 'Aumento de líquidos, medicamentos', '2024-10-29'),
    (56, 'Esclerosis múltiple', 'Enfermedad crónica que afecta el sistema nervioso central.', 'Fatiga, debilidad, problemas de equilibrio', 'Medicamentos inmunomoduladores', '2024-10-29'),
    (57, 'Sinusitis', 'Inflamación de los senos paranasales.', 'Congestión nasal, dolor facial, fiebre', 'Descongestionantes, antihistamínicos', '2024-10-29'),
    (58, 'Infección por COVID-19', 'Enfermedad viral que afecta el sistema respiratorio.', 'Tos, fiebre, dificultad para respirar', 'Aislamiento, atención médica', '2024-10-29'),
    (59, 'Faringitis', 'Inflamación de la faringe, comúnmente causada por virus o bacterias.', 'Dolor de garganta, dificultad para tragar', 'Antibióticos (si es bacterial), analgésicos', '2024-10-29'),
    (60, 'Parásitos intestinales', 'Organismos que viven en el intestino y pueden causar enfermedad.', 'Dolor abdominal, diarrea, fatiga', 'Medicamentos antiparasitarios', '2024-10-29'),
    (61, 'Vasculitis', 'Inflamación de los vasos sanguíneos.', 'Erupciones, fiebre, dolor articular', 'Medicamentos inmunosupresores', '2024-10-29'),
    (62, 'Trombosis venosa profunda', 'Formación de un coágulo sanguíneo en una vena profunda.', 'Hinchazón, dolor en la pierna', 'Anticoagulantes', '2024-10-29'),
    (63, 'Artritis reumatoide', 'Enfermedad autoinmune que causa inflamación en las articulaciones.', 'Dolor articular, rigidez', 'Medicamentos antiinflamatorios, terapia física', '2024-10-29'),
    (64, 'Desnutrición', 'Deficiencia de nutrientes esenciales en el cuerpo.', 'Pérdida de peso, fatiga, debilidad', 'Suplementos, cambios en la dieta', '2024-10-29'),
    (65, 'Anorexia', 'Trastorno alimentario caracterizado por la restricción de la ingesta de alimentos.', 'Pérdida de peso extrema, miedo a aumentar de peso', 'Terapia, soporte nutricional', '2024-10-29'),
    (66, 'Bulimia', 'Trastorno alimentario caracterizado por episodios de atracones seguidos de purgas.', 'Cicatrices en manos, problemas dentales', 'Terapia, asesoramiento nutricional', '2024-10-29'),
    (67, 'Enfermedad de Lyme', 'Infección bacteriana transmitida por garrapatas.', 'Erupción, fiebre, fatiga', 'Antibióticos', '2024-10-29'),
    (68, 'Leucemia', 'Cáncer de los tejidos que forman la sangre.', 'Fatiga, infecciones recurrentes, moretones', 'Quimioterapia, trasplante de médula ósea', '2024-10-29'),
    (69, 'Enfermedad renal crónica', 'Pérdida progresiva de la función renal.', 'Fatiga, hinchazón, cambios en la micción', 'Control de la presión arterial, diálisis', '2024-10-29'),
    (70, 'Osteoporosis', 'Enfermedad que debilita los huesos y los hace más propensos a fracturas.', 'Fracturas frecuentes, dolor en los huesos', 'Suplementos de calcio y vitamina D', '2024-10-29'),
    (71, 'Acidosis metabólica', 'Condición en la que el cuerpo produce demasiados ácidos.', 'Fatiga, confusión, dificultad para respirar', 'Tratamiento de la causa subyacente', '2024-10-29'),
    (72, 'Alcalosis metabólica', 'Condición en la que hay un exceso de bicarbonato en el cuerpo.', 'Confusión, espasmos musculares', 'Tratamiento de la causa subyacente', '2024-10-29'),
    (73, 'Gota', 'Artritis causada por la acumulación de ácido úrico.', 'Dolor intenso en las articulaciones, enrojecimiento', 'Medicamentos antiinflamatorios, cambios en la dieta', '2024-10-29'),
    (74, 'Cáncer de riñón', 'Crecimiento anormal de células en los riñones.', 'Sangre en la orina, dolor lumbar', 'Cirugía, quimioterapia', '2024-10-29'),
    (75, 'Síndrome de Down', 'Trastorno genético causado por la presencia de un cromosoma extra.', 'Retraso en el desarrollo, características faciales distintivas', 'Terapia de apoyo', '2024-10-29'),
    (76, 'Trastorno del espectro autista', 'Trastorno del desarrollo que afecta la comunicación y el comportamiento.', 'Dificultades en la interacción social', 'Terapia conductual', '2024-10-29'),
    (77, 'Deficiencia de vitamina D', 'Baja cantidad de vitamina D en el cuerpo.', 'Fatiga, debilidad ósea', 'Suplementos de vitamina D', '2024-10-29'),
    (78, 'Hepatitis C', 'Inflamación del hígado causada por el virus de la hepatitis C.', 'Fatiga, ictericia, dolor abdominal', 'Medicamentos antivirales', '2024-10-29'),
    (79, 'Síndrome del túnel carpiano', 'Compresión del nervio mediano en la muñeca.', 'Dolor en la muñeca, entumecimiento', 'Inmovilización, cirugía', '2024-10-29'),
    (80, 'Neumonía', 'Infección que inflama los sacos aéreos en uno o ambos pulmones.', 'Tos, fiebre, dificultad para respirar', 'Antibióticos, descanso', '2024-10-29'),
    (81, 'Hernia', 'Protrusión de un órgano a través de la pared que lo contiene.', 'Dolor, bultos visibles', 'Cirugía', '2024-10-29'),
    (82, 'Cáncer de hígado', 'Crecimiento anormal de células en el hígado.', 'Pérdida de peso, dolor abdominal', 'Cirugía, quimioterapia', '2024-10-29'),
    (83, 'Síndrome del intestino irritable', 'Trastorno intestinal que causa dolor abdominal y cambios en el patrón de las heces.', 'Dolor abdominal, distensión', 'Cambios en la dieta, medicamentos', '2024-10-29'),
    (84, 'Miastenia gravis', 'Enfermedad autoinmune que causa debilidad muscular.', 'Debilidad muscular, problemas de visión', 'Medicamentos inmunosupresores', '2024-10-29'),
    (85, 'EPOC', 'Enfermedad pulmonar obstructiva crónica.', 'Dificultad para respirar, tos crónica', 'Medicamentos broncodilatadores, oxigenoterapia', '2024-10-29'),
    (86, 'Alergias alimentarias', 'Reacción adversa del sistema inmunológico a ciertos alimentos.', 'Picazón, hinchazón, dificultad para respirar', 'Evitar alérgenos, medicamentos antihistamínicos', '2024-10-29'),
    (87, 'Hiperactividad', 'Trastorno que causa dificultades de atención y control de impulsos.', 'Inquietud, dificultad para concentrarse', 'Terapia conductual, medicamentos', '2024-10-29'),
    (88, 'Infección del tracto urinario', 'Infección que afecta cualquier parte del sistema urinario.', 'Dolor al orinar, necesidad frecuente de orinar', 'Antibióticos', '2024-10-29'),
    (89, 'Fiebre tifoidea', 'Infección bacteriana que afecta el intestino.', 'Fiebre, debilidad, diarrea', 'Antibióticos', '2024-10-29'),
    (90, 'Síndrome de fatiga crónica', 'Enfermedad caracterizada por fatiga extrema que no mejora con descanso.', 'Fatiga, dolores musculares, problemas de sueño', 'Tratamiento sintomático', '2024-10-29'),
    (91, 'Candidiasis', 'Infección por hongos que puede afectar la piel o las mucosas.', 'Picazón, enrojecimiento', 'Antifúngicos', '2024-10-29'),
    (92, 'Anemia', 'Deficiencia de glóbulos rojos o hemoglobina en la sangre.', 'Fatiga, debilidad, palidez', 'Suplementos de hierro, cambios en la dieta', '2024-10-29'),
    (93, 'Hernia discal', 'Protrusión del material del disco intervertebral.', 'Dolor de espalda, debilidad en las piernas', 'Fisioterapia, cirugía', '2024-10-29'),
    (94, 'Enfermedad de Alzheimer', 'Trastorno neurodegenerativo que causa pérdida de memoria y habilidades cognitivas.', 'Pérdida de memoria, confusión', 'Medicamentos, terapia de apoyo', '2024-10-29'),
    (95, 'Enfermedad celíaca', 'Reacción inmunitaria al gluten que afecta el intestino delgado.', 'Diarrea, dolor abdominal', 'Dieta sin gluten', '2024-10-29'),
    (96, 'Trastorno del sueño', 'Problemas relacionados con el sueño, como insomnio o apnea del sueño.', 'Dificultades para dormir, somnolencia', 'Tratamiento de la causa subyacente', '2024-10-29'),
    (97, 'Sordera', 'Pérdida parcial o total de la audición.', 'Dificultades para oír', 'Audífonos, implantes cocleares', '2024-10-29'),
    (98, 'Problemas de tiroides', 'Trastornos que afectan la tiroides, como el hipotiroidismo.', 'Fatiga, aumento de peso, depresión', 'Medicamentos hormonales', '2024-10-29'),
    (99, 'Enfermedad de Huntington', 'Trastorno genético que causa la degeneración de las neuronas.', 'Movimientos involuntarios, cambios en la personalidad', 'Tratamiento sintomático', '2024-10-29'),
    (100, 'Migraña', 'Dolor de cabeza recurrente que puede ser severo.', 'Dolor intenso, náuseas, sensibilidad a la luz', 'Medicamentos analgésicos, cambios en el estilo de vida', '2024-10-29');
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
      echo "Error al ejecutar SQL insert: " . $conn->error;
  }
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
    `nrodoc` char(30) DEFAULT NULL,
    `nro` char(30) DEFAULT NULL,
    `fuente_reposicion` char(100) DEFAULT NULL,
    `programa_salud` char(100) DEFAULT NULL,
    `cod_proveedor` int(11) DEFAULT NULL,
    `costo_valorado` double(10,2) DEFAULT NULL,
    `saldo` double(10,2) DEFAULT NULL,
    `nrolote` char(20),
    `lote_generico` char(20),
    `lote_nacional` char(20),
    `cantidad` int(11) DEFAULT NULL,
    `respaldo_cantidad` int(11) DEFAULT NULL,
    `manipulado` char(3) DEFAULT NULL,

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
    KEY `cod_proveedor` (`cod_proveedor`),
    KEY `cod_usuario` (`cod_usuario`),
    KEY `cod_generico` (`cod_generico`),
    CONSTRAINT `entrada_ibfk_13` FOREIGN KEY (`cod_proveedor`) REFERENCES `proveedor` (`cod_prov`),
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
function crearTablaProveedor($conn) {
    echo "Iniciando creación de tabla 'proveedor'...<br>";
    $sql = "
        DROP TABLE IF EXISTS `proveedor`;
        CREATE TABLE `proveedor` (
            `cod_prov` int(11) NOT NULL AUTO_INCREMENT,
            `nombre` char(150) DEFAULT NULL,
            `telefono` varchar(15) NOT NULL,
            `correo` char(150) DEFAULT NULL,
            `cod_representante` int DEFAULT NULL,
            `estado` char(10) DEFAULT 'activo',
            PRIMARY KEY (`cod_prov`),
            KEY `cod_representante` (`cod_representante`),
            CONSTRAINT `proveedorFK1` FOREIGN KEY (`cod_representante`) REFERENCES `representante` (`cod_rep`)
        ) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

        -- Dumping data for table `proveedor`
        LOCK TABLES `proveedor` WRITE;
        INSERT INTO `proveedor` (`nombre`, `telefono`, `correo`, `cod_representante`) VALUES
            ('INTI', 676545634, NULL, 1),
            ('SIGMACORP', 67345634, NULL, 2),
            ('COFARBOL LTDA', 67345634, NULL, 3),
            ('LAFAR', 60345634, NULL, 1),
            ('LABORATORIOS VITA', 78675767, NULL, 2);
        UNLOCK TABLES;
    ";


    echo "Ejecutando consultas SQL...<br>";

    // Ejecutar consulta
    if ($conn->multi_query($sql)) {
        do {
            // Verificar resultados de cada consulta
            if ($result = $conn->store_result()) {
                $result->free();
            }
            if ($conn->error) {
                echo "Error: " . $conn->error . "<br>";
            }
        } while ($conn->more_results() && $conn->next_result());
    } else {
        echo "Error al ejecutar SQL: " . $conn->error . "<br>";
    }

    echo "Finalizado.<br>";
}
function crearTablaRepresentante($conn) {
    $sql = "
    DROP TABLE IF EXISTS `representante`;
    CREATE TABLE `representante` (
        `cod_rep` int(11) NOT NULL AUTO_INCREMENT,
        `nombre_apellidos` char(150) DEFAULT NULL,
        `telefono` int NOT NULL,
        `cargo` char(150) DEFAULT NULL,
        `estado` char(10) DEFAULT 'activo',
        PRIMARY KEY (`cod_rep`)
    ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

        -- Dumping data for table `representante`
        LOCK TABLES `representante` WRITE;
        INSERT INTO `representante` (`nombre_apellidos`, `telefono`, `cargo`) VALUES
            ('Juan gusman Mamani', 676545634,'Gerente general'),
            ('Roberto lia river', 67345634,'Gerente'),
            ('Gabriela ramirez lia', 67345634, 'gerente');
        UNLOCK TABLES;
    ";

    // Ejecutar consulta
    if ($conn->multi_query($sql)) {
        do {
            // Almacenar y liberar resultados si los hay
            if ($result = $conn->store_result()) {
                $result->free();
            }
            // Imprimir errores
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
  ('12','V0604','Complemento nutricional (Carmelo)','','','0','0','5','33','5','si','0',null,'activo'),
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
  ('71','A0305','Vitaminas (Complejo B)','','','0','0','2','33','5','si','0',null,'activo'),
  ('72','J0141','Dicloxacilina sodica','','','0','0','10','8','5','si','0',null,'activo'),
  ('73','C0902','Losartan','','','0','0','1','6','5','si','0',null,'activo')";


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
      `costosUnitario` text DEFAULT NULL,
      `costos`  text DEFAULT NULL,
      `costoTotal`  double(10,2) DEFAULT NULL,
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
//  `costoTotal`  double(10,2) DEFAULT NULL,
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
