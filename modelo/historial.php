
<?php
/**
 *
 */

class Historial
{

  function __construct()
	{
		require_once("conexion.php");

			//llamando al metodo Conectaras de la clase Conexion para realizar los metodos de insert update delete
			$co=new Conexion();
			$this->con= $co->Conectaras();
	}

  public function SelectPorBusquedaHistorial($inicioList=false,$listarDeCuanto=false,$fecha=false,$cod_paciente,$fechai=false,$fechaf=false,$buscar=false){
    // Verificar si $buscar tiene contenido
    $sql = " select *from historial where paciente_rd = $cod_paciente ";
    if($buscar !=''){
      $sql.=" and (titulo like '%$buscar%' or subtitulo like '%$buscar%') ";
    }
    if($fecha != false){
      //$di=strtotime($fecha);
      //$df=strtotime($fecha) + 86399;
    //	echo $di."       ".$df;
      $sql.=" and (fecha >= '$fecha' and  fecha <= '$fecha')";
   }
   //fecha solo para
   if($fechai != false && $fechaf != false){
    $sql.=" and (fecha >= '$fechai' and  fecha <= '$fechaf') ";
  }
    if(is_numeric($inicioList)&&is_numeric($listarDeCuanto)){
      $sql.=" ORDER BY cod_his ASC LIMIT $listarDeCuanto OFFSET $inicioList ";
    }

    $resul = $this->con->query($sql);
    // Retornar el resultado
    if($resul===false){
      return $this->con->error;
    }else{
      return $resul;
    }
    mysqli_close($this->con);
  }
  public function SelectHistorialTodo($cod_paciente='',$hoja1=false,$hoja2=false,$cod_his=false){
    // Verificar si $buscar tiene contenido
    $sql = " select *from historial_dato where  ";
    if(is_numeric($cod_paciente)){
      $sql.=" paciente_rd = $cod_paciente ";
    }
    if($cod_his != false){
      $sql.=" and cod_his_dat = $cod_his ";
   }
   //fecha solo para
   if($hoja1 != false && $hoja2 != false){
    $sql.=" and (paginas >= '$hoja1' and  paginas <= '$hoja2') ";
  }
    $resul = $this->con->query($sql);
    // Retornar el resultado
    return $resul;
    mysqli_close($this->con);
  }


  public function SelectHistorialTodoOrdenar($cod_paciente='',$cod_rd=false){
    // Verificar si $buscar tiene contenido
    $sql = " select *from historial_dato where  ";
    if(is_numeric($cod_paciente)){
      $sql.=" paciente_rd = $cod_paciente ";
    }
    if($cod_rd != false){
      $sql.=" and cod_rd = $cod_rd";
   }
   $sql.=" order by cod_his asc";
   //echo "<br><br><br>".$sql;
    $resul = $this->con->query($sql);
    // Retornar el resultado
    return $resul;
    mysqli_close($this->con);
  }
  public function SelectHistorialDatoTodo($cod_paciente='',$hoja1=false,$hoja2=false,$cod_his=false,$cod_his_original){
    // Verificar si $buscar tiene contenido
    $sql = " select *from historial_dato where  ";
    if(is_numeric($cod_paciente)){
      $sql.=" paciente_rd = $cod_paciente ";
    }
    if(is_numeric($cod_his)){
      $sql.=" and cod_his_dat = $cod_his ";
   }
   if(is_numeric($cod_his_original)){
     $sql.=" and cod_his = $cod_his_original ";
   }
   //fecha solo para
   if($hoja1 != false && $hoja2 != false){
    $sql.=" and (hoja >= '$hoja1' and  hoja <= '$hoja2') ";
  }
    $resul = $this->con->query($sql);
    // Retornar el resultado
    return $resul;
    mysqli_close($this->con);
  }

  public function selectDatosUsuarios($id){
    if(is_numeric($id))
    {
      $lis = "select * from usuario where cod_usuario = $id";
      $resul = $this->con->query($lis);
      $a = [];
      while ($fi = mysqli_fetch_array($resul)) {
        $datos = [
          "cod_usuario" => $fi["cod_usuario"],
          "nombre_usuario_re" => $fi["nombre_usuario"],
          "ap_usuario_re" => $fi["ap_usuario"],
          "ci_usuario" => $fi["ci_usuario"],
          "am_usuario_re" => $fi["am_usuario"],
          "fn_usuario_re" => $fi["fecha_nac_usuario"],
          "edad_usuario" => $fi["edad_usuario"],
          "sexo_usuario" =>$fi["sexo_usuario"],
          "ocupacion_usuario" => $fi["ocupacion_usuario"],
          "comunidad_usuario" => $fi["comunidad_usuario"],
          "estado_civil_usuario" => $fi["estado_civil_usuario"],
          "escolaridad_usuario" => $fi["escolaridad_usuario"],
          "autoidentificacion_usuario" => $fi["autoidentificacion_usuario"],
          "nro_seguro_usuario" => $fi["nro_seguro_usuario"],
          "nro_car_form_usuario" => $fi["nro_car_form_usuario"],
          "sexo_usuario_re" => $fi["sexo_usuario"],
          "direccion_usuario_re" => $fi["direccion_usuario"],
          "comunidad_usuario_re" => $fi["comunidad_usuario"],
          "telefono_usuario_re" => $fi["telefono_usuario"]
        ];
        $a[] = $datos;
      }
      return $a;
    }else{
      return '';
    }
    mysqli_close($this->con);
  }

    public function selectDatosRegistro_diario($id){
      $lis = "select * from where cod_rd = $id";
      $resul = $this->con->query($lis);
      $a = [];
      while ($fi = mysqli_fetch_array($resul)) {
        $datos = [
          "cod_rd" =>$fi["cod_rd"],
          "fecha_rd" =>$fi["fecha_rd"],
          "hora_rd" =>$fi["hora_rd"],
          "servicio_rd" =>$fi["servicio_rd"],
          "signo_sintomas_rd" =>$fi["signo_sintomas_rd"],
          "historial_clinico_rd" =>$fi["historial_clinico_rd"],
          "fecha_retorno_historia_rd" =>$fi["fecha_retorno_historia_rd"],
          "pe_brinda_atencion_rd" =>$fi["pe_brinda_atencion_rd"],
          "resp_admision_rd" =>$fi["resp_admision_rd"],
          "paciente_rd" =>$fi["paciente_rd"],
          "cod_cds" =>$fi["cod_cds"],
          "estado" =>$fi["estado"],
          ];
          $a[] = $datos;
      }
      return $a;
      mysqli_close($this->con);
  }

  public function selectNombreUsuario($cod_usuario){
    $sql = "select *from usuario where cod_usuario=".$cod_usuario;
    $resul = $this->con->query($sql);
    // Retornar el resultado
    return $resul;
    mysqli_close($this->con);
  }

  public function buscarBDpacienteResponsablesql($nombre){
    $nombre = strtolower($nombre);
    $lis = "SELECT * FROM usuario WHERE tipo_usuario = 'paciente' AND (LOWER(nombre_usuario) LIKE '%$nombre%' OR LOWER(ap_usuario) LIKE '%$nombre%' or LOWER(am_usuario) like '%$nombre%') LIMIT 5 OFFSET 0;";
    $resul = $this->con->query($lis);
    return $resul;
    mysqli_close($this->con);
  }
  public function buscarBDMedicoResponsablesql($nombre){
    $nombre = strtolower($nombre);
    $lis = "SELECT * FROM usuario WHERE tipo_usuario = 'medico' AND (LOWER(nombre_usuario) LIKE '%$nombre%' OR LOWER(ap_usuario) LIKE '%$nombre%' or LOWER(am_usuario) like '%$nombre%') LIMIT 5 OFFSET 0;";
    $resul = $this->con->query($lis);
    return $resul;
    mysqli_close($this->con);
  }


  public function insertarNewResponsableyPacientes($Nombre_responsable,$ap_responsable,$am_responsable,
  $fecha_nacimiento_responsable,$sexo_responsable,
  $ocupacion_responsable,$direccion_responsable,$telefono_resposable,$comunidad_responsable,$ci,$n_seguro,$n_carp_fam,$zona_his
  ,$cod_usuario,$paciente_rd,
  $cod_rd,$fecha_nacimiento,$sexo,$ocupacion,$fecha_de_consulta,$estado_civil,$escolaridad,$cod_his,$cod_his_original){
    $sql = "";
    if($cod_usuario !=""){ //existe usuario
      $sql = "update usuario set ";
      $si = "no";
      if($si == "no" && $sexo_responsable != ""){
        $sql .= " sexo_usuario = '$sexo_responsable'";
        $si = 'si';
      }
      if($ci != "" && $si == 'no'){
        $sql.= " ci_usuario = $ci ";
        $si = 'si';
      }else if($ci != "" && $si == 'si'){
        $sql.= " ,ci_usuario = $ci ";
      }
      if($ocupacion_responsable != "" && $si == 'no'){
        $sql.= " ocupacion_usuario = '$ocupacion_responsable'"; $si = "si";
      }else if($ocupacion_responsable != "" && $si == 'si'){
        $sql.= " ,ocupacion_usuario = '$ocupacion_responsable'";
      }
      if($telefono_resposable != "" && $si == 'no'){
        $sql.= " telefono_usuario = '$telefono_resposable'";
        $si = 'si';
      }else
      if($telefono_resposable != "" && $si == 'si'){
        $sql.= " ,telefono_usuario = '$telefono_resposable'";
      }
      if($comunidad_responsable != "" && $si == 'no'){
        $sql.= " comunidad_usuario = '$comunidad_responsable'";
        $si = 'si';
      }else
      if($comunidad_responsable != "" && $si == 'si'){
        $sql.= " ,comunidad_usuario = '$comunidad_responsable'";
      }
      if($ocupacion_responsable != "" && $si == 'no'){
        $sql.= " ocupacion_usuario = '$ocupacion_responsable'";
        $si = 'si';
      }else
      if($ocupacion_responsable != "" && $si == 'si'){
        $sql.= " ,ocupacion_usuario = '$ocupacion_responsable'";
      }

      if($ci != "" && $si == 'no'){
        $sql.= " ci_usuario = '$ci'";
        $si = 'si';
      }elseif($ci != "" && $si == 'si'){
        $sql.= " ,ci_usuario = '$ci'";
      }

      if($n_seguro != "" && $si == 'no'){
        $sql.= " nro_seguro_usuario = '$n_seguro'";
        $si = 'si';
      }else if($n_seguro != "" && $si == 'si'){
        $sql.= " ,nro_seguro_usuario = '$n_seguro'";
      }

      if($n_carp_fam != "" && $si == 'no'){
        $sql.= " nro_car_form_usuario = '$n_carp_fam'";
        $si = 'si';
      }else if($n_carp_fam != "" && $si == 'si'){
        $sql.= " ,nro_car_form_usuario= '$n_carp_fam'";
      }

      if($Nombre_responsable != "" && $si == 'no'){
        $sql.= " nombre_usuario = '$Nombre_responsable'";
        $si = 'si';
      }elseif($ci != "" && $si == 'si'){
        $sql.= " ,nombre_usuario = '$Nombre_responsable'";
      }

      if($ap_responsable != "" && $si == 'no'){
        $sql.= " ap_usuario = '$ap_responsable'";
        $si = 'si';
      }elseif($ci != "" && $si == 'si'){
        $sql.= " ,ap_usuario = '$ap_responsable'";
      }

      if($am_responsable != "" && $si == 'no'){
        $sql.= " am_usuario = '$am_responsable'";
        $si = 'si';
      }elseif($ci != "" && $si == 'si'){
        $sql.= " ,am_usuario = '$am_responsable'";
      }

      if($fecha_nacimiento_responsable != "" && $si == 'no'){
        $sql.= " fecha_nac_usuario = '$fecha_nacimiento_responsable'";
        $si = 'si';
      }elseif($ci != "" && $si == 'si'){
        $sql.= " ,fecha_nac_usuario = '$fecha_nacimiento_responsable'";
      }
      if($comunidad_responsable != "" && $si == 'no'){
        $sql.= " comunidad_usuario = '$comunidad_responsable'";
        $si = 'si';
      }elseif($ci != "" && $si == 'si'){
        $sql.= " ,comunidad_usuario = '$comunidad_responsable'";
      }
      if($direccion_responsable != "" && $si == 'no'){
        $sql.= " direccion_usuario = '$direccion_responsable'";
        $si = 'si';
      }elseif($ci != "" && $si == 'si'){
        $sql.= " ,direccion_usuario = '$direccion_responsable'";
      }
      $sql.= "   WHERE cod_usuario = $cod_usuario";
      //echo "??????".$sql." prueba";
      $resul = $this->con->query($sql);
    }else{
      $sql = "insert into usuario(nombre_usuario,ap_usuario,am_usuario,fecha_nac_usuario,edad_usuario,sexo_usuario,ocupacion_usuario,direccion_usuario,
      telefono_usuario,comunidad_usuario,ci_usuario,nro_seguro_usuario,nro_car_form_usuario,tipo_usuario)values('$Nombre_responsable','$ap_responsable',
      '$am_responsable','$fecha_nacimiento_responsable',0,'$sexo_responsable','$ocupacion_responsable','$direccion_responsable',
      $telefono_resposable,'$comunidad_responsable',$ci,'$n_seguro','$n_carp_fam','paciente');";
      $resul = $this->con->query($sql);
      if($resul =! ""){
        $ultimo_id = $this->con->insert_id;
        $cod_usuario = $ultimo_id;
      }
    }
    //actualizar los datos del paciente pero solo algunos datospaciente
    //echo "e".$estado_civil." es ".$escolaridad." fn  ".$fecha_nacimiento."   ".$paciente_rd."   ".$sexo;
    $sql23 = "update usuario set fecha_nac_usuario='$fecha_nacimiento',sexo_usuario='$sexo',ocupacion_usuario='$ocupacion',
    estado_civil_usuario='$estado_civil', escolaridad_usuario='$escolaridad' where cod_usuario = $paciente_rd";
    $this->con->query($sql23);

    $fechaActual = date("Y-m-d");
    $horaActual = date("H:i:s");
    $sql = '';
    if(is_numeric($cod_his)){//actualizar historial
      $sql ="update historial_dato set zona_his='$zona_his',cod_responsable_familia_his=$cod_usuario where cod_his_dat=$cod_his";
    }else{
      $maxiHoja = $this->seleccionarMaximo($cod_rd,$paciente_rd,$cod_his);
      $max = $this->seleccionarMaximoHistorialDato($cod_rd,$paciente_rd);
      $sql = "insert into historial_dato(cod_rd,paciente_rd,cod_cds,zona_his,cod_responsable_familia_his,descripcion,hoja,paginas,cod_his,fecha,hora,tipoDato,estado)values(
      $cod_rd,$paciente_rd,1,'$zona_his',$cod_usuario,'Datos del paciente y responsable de familia',$maxiHoja,$max,$cod_his_original,'$fechaActual','$horaActual',1,'activo')";
    }
    $res = $this->con->query($sql);   // Retornar el resultado

    if($res===TRUE){
      $sql_con = "update registro_diario set historial_clinico_rd = 'si' WHERE paciente_rd = $paciente_rd and cod_rd = $cod_rd";
      $res1 = $this->con->query($sql_con);
    }
   return $res;
   mysqli_close($this->con);
   }

   function seleccionarHistorial($paciente_rd,$cod_rd,$cod_his){
     $sql = "select *from historial where paciente_rd=".$paciente_rd." and cod_rd=".$cod_rd." and cod_his=".$cod_his;
     $resul = $this->con->query($sql);
     // Retornar el resultado
     return $resul;
     mysqli_close($this->con);
   }

   public function insertandoDocumentos($uploadDir,$fileName,$nombre_imagen,$paciente_rd, $cod_rd,$cod_his,$cod_his_original) {
     // Escapar las entradas

     $select = "select *from historial_dato where cod_rd=$cod_rd and paciente_rd=$paciente_rd and cod_his = $cod_his_original and tipoDato=1";
     $res = $this->con->query($select);
     $fila = mysqli_fetch_array($res);

    $zona_his = $this->con->real_escape_string($fila["zona_his"]);
    $cod_cds = $this->con->real_escape_string($fila["cod_cds"]);
    $cod_responsable_familia_his = $this->con->real_escape_string($fila["cod_responsable_familia_his"]);

     $cod_paciente = $this->con->real_escape_string($paciente_rd);
     $cod_rd = $this->con->real_escape_string($cod_rd);
     $cod_his = $this->con->real_escape_string($cod_his);
     $uploadDir = $this->con->real_escape_string($uploadDir);
     $fileName = $this->con->real_escape_string($fileName);
     $nombre_imagen = $this->con->real_escape_string($nombre_imagen);
     $fecha = $this->con->real_escape_string(date('Y-m-d'));
     $hora = $this->con->real_escape_string(date('H:i:s')); // Cambiado 'm' por 'i' para los minutos

     // Verificación de datos (opcional: imprimir para debugging)
    // echo $cod_his." es  s  ".$cod_paciente . "  " . $cod_rd . "   " . $cod_his . "   " . $uploadDir . "   " . $fileName . "    " . $nombre_imagen . "    " . $fecha . "   " . $hora;
     // Construir la consulta de inserción con actualización en caso de duplicado
     $maxi = $this->seleccionarMaximo($cod_rd,$paciente_rd,$cod_his_original);
     $max = $this->seleccionarMaximoHistorialDato($cod_rd,$paciente_rd);
     $sql = "INSERT INTO historial_dato (
                 cod_his_dat,zona_his,cod_rd, paciente_rd,cod_cds,descripcion, nombre_imagen, ruta_imagen,hoja,paginas,cod_his,fecha, hora,tipoDato, estado
             ) VALUES (
                 '$cod_his','$zona_his', '$cod_rd', '$cod_paciente','$cod_cds','$nombre_imagen', '$fileName', '$uploadDir','$maxi','$max','$cod_his_original','$fecha', '$hora','2','activo'
             ) ON DUPLICATE KEY UPDATE
                descripcion = VALUES(descripcion),
                 nombre_imagen = VALUES(nombre_imagen),
                 ruta_imagen = VALUES(ruta_imagen)
                 ";

     // Ejecutar la consulta
     $resul = $this->con->query($sql);
     return $resul;
 }

 public function insertandoDocumentosDesdeElPrincipal($uploadDir,$fileName,$nombre_imagen,$paciente_rd, $cod_rd,$cod_his,$cod_his_original,$tipoHistorial,$titulo_historial) {
   // Escapar las entradas
   //si hay el tipo historial eso quiere decir que biene desde el historial del paciente si no de lo contrario es una herencia
   $ultimoId='';
   $fecha='';
   $hora='';
     if(($cod_his_original)=='')
     {
       $fecha = date("Y-m-d");
       $hora = date("H:i:s");
       $numero = $this->seleccionarHistorialcontar($paciente_rd,$cod_rd);
       $titulo_historial = "Historial ".$numero;

     }

      $sql = "INSERT INTO historial(
         cod_his,cod_rd,paciente_rd,cod_cds,titulo,subtitulo,tipoHistorial,fecha,hora,estado
       ) VALUES (
         '$cod_his_original','$cod_rd','$paciente_rd','1','$titulo_historial','$nombre_imagen','$tipoHistorial','$fecha','$hora','activo'
       )ON DUPLICATE KEY UPDATE
                subtitulo = VALUES(subtitulo)";

             // Ejecutar la consulta
       $resul12 = $this->con->query($sql);
     if($resul12!=''){
       $ultimoId = $this->con->insert_id;
      }
    //  echo $ultimoId;
   $cod_paciente = $this->con->real_escape_string($paciente_rd);
   $cod_rd = $this->con->real_escape_string($cod_rd);
   $cod_his = $this->con->real_escape_string($cod_his);
   $uploadDir = $this->con->real_escape_string($uploadDir);
   $fileName = $this->con->real_escape_string($fileName);
   $nombre_imagen = $this->con->real_escape_string($nombre_imagen);
   $fecha = $this->con->real_escape_string(date('Y-m-d'));
   $hora = $this->con->real_escape_string(date('H:i:s')); // Cambiado 'm' por 'i' para los minutos

   // Verificación de datos (opcional: imprimir para debugging)
  // echo $cod_his." es  s  ".$cod_paciente . "  " . $cod_rd . "   " . $cod_his . "   " . $uploadDir . "   " . $fileName . "    " . $nombre_imagen . "    " . $fecha . "   " . $hora;
   // Construir la consulta de inserción con actualización en caso de duplicado
   if($cod_his_original==''){
     $cod_his_original=$ultimoId;
   }
   //echo $cod_his_original;
   $maxi = $this->seleccionarMaximo($cod_rd,$paciente_rd,$cod_his_original);
   $max = $this->seleccionarMaximoHistorialDato($cod_rd,$paciente_rd);
   $sql = "INSERT INTO historial_dato (
               cod_his_dat,cod_rd, paciente_rd,cod_cds,descripcion, nombre_imagen, ruta_imagen,hoja,paginas,cod_his,fecha, hora,tipoDato, estado
           ) VALUES (
               '$cod_his', '$cod_rd', '$cod_paciente','1','$nombre_imagen', '$fileName', '$uploadDir','$maxi','$max','$cod_his_original','$fecha', '$hora','2','activo'
           ) ON DUPLICATE KEY UPDATE
              descripcion = VALUES(descripcion),
               nombre_imagen = VALUES(nombre_imagen),
               ruta_imagen = VALUES(ruta_imagen)
               ";

   // Ejecutar la consulta
   if($tipoHistorial != '' && $cod_his ==''){
     $sql_con = "update registro_diario set historial_clinico_rd = 'si' WHERE paciente_rd = $paciente_rd and cod_rd = $cod_rd";
     $res1 = $this->con->query($sql_con);
   }
   $resul = $this->con->query($sql);

   return $resul;
 }

function seleccionarMaximo($cod_rd,$paciente_rd,$cod_his){
  $sql = "select max(hoja) from historial_dato where cod_rd=$cod_rd and paciente_rd = $paciente_rd and cod_his=$cod_his";
  $resul = $this->con->query($sql);
  if($resul!='')
  {
    $f = mysqli_fetch_array($resul);
    if($f["max(hoja)"]==0 ||$f["max(hoja)"]==NULL || $f["max(hoja)"]==null){
      return 1;
    }else{
      return $f["max(hoja)"]+1;
    }
  }else{
    return 1;
  }
}

function seleccionarMaximoHistorialDato($cod_rd,$paciente_rd){
  $sql = "select max(paginas) from historial_dato where cod_rd=$cod_rd and paciente_rd = $paciente_rd";
  $resul = $this->con->query($sql);
  if($resul!='')
  {
    $f = mysqli_fetch_array($resul);
    if($f["max(paginas)"]==0 ||$f["max(paginas)"]==NULL || $f["max(paginas)"]==null){
      return 1;
    }else{
      return $f["max(paginas)"]+1;
    }
  }else{
    return 1;
  }
}
  function seleccionarhojaMinimo($cod_rd,$paciente_rd,$cod_his_original){
    $sql = "select min(hoja) from historial_dato where cod_rd=$cod_rd and paciente_rd = $paciente_rd ";
    if(is_numeric($cod_his_original)){
      $sql.=" and cod_his=$cod_his_original";
    }
    $resul = $this->con->query($sql);
    $f = mysqli_fetch_array($resul);
    return $f["min(hoja)"];
}

function SelectHistorialMaximo($cod_rd,$paciente_rd){
  $sql = "select max(paginas) from historial_dato where cod_rd=$cod_rd and paciente_rd = $paciente_rd ";
  $resul = $this->con->query($sql);
  $f = mysqli_fetch_array($resul);
  return $f["max(paginas)"];
}

function SelectHistorialMinimo($cod_rd,$paciente_rd){
  $sql = "select min(paginas) from historial_dato where cod_rd=$cod_rd and paciente_rd = $paciente_rd ";
  $resul = $this->con->query($sql);
  $f = mysqli_fetch_array($resul);
  return $f["min(paginas)"];
}
  function seleccionarhojaMaximo($cod_rd,$paciente_rd,$cod_his_original){
    $sql = "select max(hoja) from historial_dato where cod_rd=$cod_rd and paciente_rd = $paciente_rd ";
    if(is_numeric($cod_his_original)){
      $sql.=" and cod_his=$cod_his_original";
    }
    $resul = $this->con->query($sql);
    $f = mysqli_fetch_array($resul);
    return $f["max(hoja)"];
  }

  function insertarDatosHistorialConsulta($talla,$peso,$imc,$temperatura,$fc,$pa,$fr,$motivo_consulta,$subjetivo,$objetivo,
  $analisis,$tratamiento,$evaluacion_seguimiento,$medico_responsable,$cod_usuario_medico,$cod_historial_consulta,$paciente_rd,
  $cod_rd,$fecha_consulta,$hora_consulta,$cod_his_original){
    $cod_his_dat='';
    $select = "select *from historial_dato where cod_rd=$cod_rd and paciente_rd=$paciente_rd and cod_his=$cod_his_original and tipoDato=1";
    $res = $this->con->query($select);
    $fila = mysqli_fetch_array($res);
    //echo $cod_usuario_medico."    ".$medico_responsable;

   $zona_his = $this->con->real_escape_string($fila["zona_his"]);
   $cod_cds = $this->con->real_escape_string($fila["cod_cds"]);
   $cod_responsable_familia_his = $this->con->real_escape_string($fila["cod_responsable_familia_his"]);
   $talla = $this->con->real_escape_string($talla);
   $peso = $this->con->real_escape_string($peso);
   $this->insertarTallaPesoUsuario($talla,$peso,$paciente_rd);
   $imc = $this->con->real_escape_string($imc);
   $temperatura = $this->con->real_escape_string($temperatura);
   $fc = $this->con->real_escape_string($fc);
   $pa = $this->con->real_escape_string($pa);
   $fr = $this->con->real_escape_string($fr);
   //echo $talla."    ".$peso."    ".$imc."     ".$temperatura."    ".$fc."     ".$pa."      ".$fr."abajo";
   $motivo_consulta = $this->con->real_escape_string($motivo_consulta);
   $subjetivo = $this->con->real_escape_string($subjetivo);
   $objetivo = $this->con->real_escape_string($objetivo);
   $analisis = $this->con->real_escape_string($analisis);
   $tratamiento = $this->con->real_escape_string($tratamiento);
   $evaluacion_seguimiento = $this->con->real_escape_string($evaluacion_seguimiento);
   $medico_responsable = $this->con->real_escape_string($medico_responsable);
   //echo $motivo_consulta."    ".$subjetivo."     ".$objetivo."      ".$analisis."       ".$tratamiento."      ".$evaluacion_seguimiento."      ".$medico_responsable;
   $cod_usuario_medico = $this->con->real_escape_string($cod_usuario_medico);
   $cod_his = $this->con->real_escape_string($cod_historial_consulta);
   $paciente_rd = $this->con->real_escape_string($paciente_rd);
   $cod_rd = $this->con->real_escape_string($cod_rd);
   $fecha_consulta = $this->con->real_escape_string($fecha_consulta);
   $hora_consulta = $this->con->real_escape_string($hora_consulta);
   //echo "<br>".$cod_usuario_medico."    c".$cod_his."c     ".$paciente_rd."     ".$cod_rd."     ".$fecha_consulta."     ".$hora_consulta;
    // Verificación de datos (opcional: imprimir para debugging)
    //echo $cod_paciente . "  " . $cod_rd . "   " . $cod_his . "   " . $uploadDir . "   " . $fileName . "    " . $nombre_imagen . "    " . $fecha . "   " . $hora;
    // Construir la consulta de inserción con actualización en caso de duplicado
    $maxi = $this->seleccionarMaximo($cod_rd,$paciente_rd,$cod_his);
    $max = $this->seleccionarMaximoHistorialDato($cod_rd,$paciente_rd);
    $fecha = '';$hora='';
    if($cod_his_dat == ''){
      $fecha = $this->con->real_escape_string(date('Y-m-d'));
      $hora = $this->con->real_escape_string(date('H:i:s')); // Cambiado 'm' por 'i' para los minutos
    }
    $sql = "INSERT INTO historial_dato(
        cod_his_dat,cod_rd,paciente_rd,cod_cds,zona_his,cod_responsable_familia_his,descripcion,
        hoja,paginas,imc,temp,fc,pa,fr,motivo_consulta,
        subjetivo,objetivo,analisis,tratamiento,evaluacion_de_seguimiento,
        cod_responsable_medico,cod_his,
        fecha,hora,tipoDato,estado
      ) VALUES (
        '$cod_his_dat','$cod_rd','$paciente_rd','$cod_cds','$zona_his','$cod_responsable_familia_his','Documento de consulta',
        '$maxi','$max','$imc','$temperatura','$fc','$pa','$fr','$motivo_consulta',
        '$subjetivo','$objetivo','$analisis','$tratamiento','$evaluacion_seguimiento',
        '$cod_usuario_medico','$cod_his_original',
        '$fecha','$hora','3','activo'
            ) ON DUPLICATE KEY UPDATE
              zona_his = VALUES(zona_his),
                imc = VALUES(imc),
                temp = VALUES(temp),
                fc = VALUES(fc),
                pa = VALUES(pa),
                fr = VALUES(fr),
                motivo_consulta = VALUES(motivo_consulta),
                subjetivo = VALUES(subjetivo),
                objetivo = VALUES(objetivo),
                analisis = VALUES(analisis),
                tratamiento = VALUES(tratamiento),
                evaluacion_de_seguimiento = VALUES(evaluacion_de_seguimiento),
                cod_responsable_medico = VALUES(cod_responsable_medico)
                ";

    // Ejecutar la consulta
    //echo $sql;
    $resul = $this->con->query($sql);
    echo $this->con->error;
    return $resul;
  }

  function insertarTallaPesoUsuario($talla,$peso,$paciente_rd){

        $sql = "INSERT INTO usuario(
                peso_usuario,talla_usuario,cod_usuario
                ) VALUES (
                  '$peso','$talla','$paciente_rd'
                ) ON DUPLICATE KEY UPDATE
                  peso_usuario = VALUES(peso_usuario),
                   talla_usuario = VALUES(talla_usuario)";

        // Ejecutar la consulta
        $resul = $this->con->query($sql);
  }

  private function seleccionarHistorialcontar($paciente_rd,$cod_rd){
      $sql = "select count(cod_his) from historial where cod_rd = $cod_rd and paciente_rd = $paciente_rd";
      $resul = $this->con->query($sql);
      $fila = mysqli_fetch_array($resul);
    if($fila["count(cod_his)"] <= 0){
      return 1;
    }else{
      return $fila["count(cod_his)"]+1;
    }
  }

  public function InsertarNuevoHistorial($paciente_rd,$cod_rd,$nombre_historial,$cod_his,$subnombre,$tipoHistorial){
    $fecha = '';$hora = '';
    if(!is_numeric($cod_his))
    {
      $numero = $this->seleccionarHistorialcontar($paciente_rd,$cod_rd);
      $subnombre = "Historial ".$numero;
      $fecha = date("Y-m-d");
      $hora = date("H:i:s");
    }

    $sql = "INSERT INTO historial(
              cod_his,cod_rd,paciente_rd,cod_cds,titulo,subtitulo,tipoHistorial,fecha,hora,estado
            ) VALUES (
              '$cod_his','$cod_rd','$paciente_rd','1','$subnombre','$nombre_historial','$tipoHistorial','$fecha','$hora','activo'
            ) ON DUPLICATE KEY UPDATE
              subtitulo = VALUES(subtitulo)";
    // Ejecutar la consulta
    $resul = $this->con->query($sql);
    $sql_con = "update registro_diario set historial_clinico_rd = 'si' WHERE paciente_rd = $paciente_rd and cod_rd = $cod_rd";
    $res1 = $this->con->query($sql_con);
    return $resul;
  }

  public function SelecccionarDatosDelHistorial($inicioList=false,$listarDeCuanto=false,$fecha=false,$cod_paciente,$cod_his,$cod_rd,
  $fechai=false,$fechaf=false){
    // Verificar si $buscar tiene contenido
    $sql = "select *from historial_dato where cod_his = $cod_his and paciente_rd=$cod_paciente and cod_rd=$cod_rd ";
    if($fecha != false){;
      $sql.=" and (fecha >= '$fecha' and  fecha <= '$fecha')";
   }
   //fecha solo para
   if($fechai != false && $fechaf != false){
    $sql.=" and (fecha >= '$fechai' and  fecha <= '$fechaf') ";
  }
    if(is_numeric($inicioList)&&is_numeric($listarDeCuanto)){
      $sql.=" ORDER BY cod_his_dat ASC LIMIT $listarDeCuanto OFFSET $inicioList ";
    }

    $resul = $this->con->query($sql);
    // Retornar el resultado
    if($resul===false){
      return $this->con->error;
    }else{
      return $resul;
    }
    mysqli_close($this->con);
  }

  public function seleccioarDatoHistorial($cod_his){
    if(is_numeric($cod_his))
    {
      $sql="select *from historial where cod_his=$cod_his";
      $resul = $this->con->query($sql);
        $a = [];
      while ($fi = mysqli_fetch_array($resul)) {
        $datos = [
          "cod_his"=>$fi["cod_his"],
          "cod_rd"=>$fi["cod_rd"],
          "paciente_rd"=>$fi["paciente_rd"],
          "cod_cds"=>$fi["cod_cds"],
          "hoja"=>$fi["hoja"],
          "titulo"=>$fi["titulo"],
          "subtitulo"=>$fi["subtitulo"],
          "tipoHistorial"=>$fi["tipoHistorial"],
          "fecha"=>$fi["fecha"],
          "hora"=>$fi["hora"],
          "estado"=>$fi["estado"]
        ];
        $a[] = $datos;
      }
      return $a;
    }else{
      return '';
    }
  }

  public function seleccionarHistorialDatoImagen($cod_his,$paciente_rd,$cod_rd){
    $sql="select *from historial_dato where cod_his=$cod_his and paciente_rd = $paciente_rd and cod_rd=$cod_rd";
    $resul = $this->con->query($sql);
    $a = [];
    while ($fi = mysqli_fetch_array($resul)) {
      $datos = [
        "cod_his_dat"=>$fi["cod_his_dat"],
        "cod_rd"=>$fi["cod_rd"],
        "paciente_rd"=>$fi["paciente_rd"],
        "cod_cds"=>$fi["cod_cds"],
        "zona_his"=>$fi["zona_his"],
        "descripcion"=>$fi["descripcion"],
        "hoja"=>$fi["hoja"],
        "nombre_imagen"=>$fi["nombre_imagen"],
        "ruta_imagen"=>$fi["ruta_imagen"],
        "tipoDato"=>$fi["tipoDato"]
      ];
      $a[] = $datos;
    }
    return $a;
  }

}





 ?>
