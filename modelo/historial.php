
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

  public function SelectPorBusquedaHistorial($inicioList=false,$listarDeCuanto=false,$fecha=false,$cod_paciente,$fechai=false,$fechaf=false){
    // Verificar si $buscar tiene contenido
    $sql = " select *from historial where paciente_rd = $cod_paciente ";

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
      $sql.=" ORDER BY cod_his DESC LIMIT $listarDeCuanto OFFSET $inicioList ";
    }

    $resul = $this->con->query($sql);
    // Retornar el resultado
    return $resul;
    mysqli_close($this->con);
  }

  public function selectDatosUsuarios($id){
    $lis = "select * from usuario where cod_usuario = $id";
    $resul = $this->con->query($lis);
    $a = [];
    while ($fi = mysqli_fetch_array($resul)) {
      $datos = [
          "nombre_usuario_re" => $fi["nombre_usuario"],
          "ap_usuario_re" => $fi["ap_usuario"],
          "ci_usuario" => $fi["ci_usuario"],
          "am_usuario_re" => $fi["am_usuario"],
          "fn_usuario_re" => $fi["fecha_nac_usuario"],
          "edad_usuario" => $fi["edad_usuario"],
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
    $lis = "SELECT * FROM usuario WHERE tipo_usuario = 'paciente' or tipo_usuario = 'responsable' AND (LOWER(nombre_usuario) LIKE '%$nombre%' OR LOWER(ap_usuario) LIKE '%$nombre%' or LOWER(am_usuario) like '%$nombre%') LIMIT 5 OFFSET 0;";
    $resul = $this->con->query($lis);
    return $resul;
    mysqli_close($this->con);
  }



  public function insertarNewResponsableyPacientes($Nombre_responsable,$ap_responsable,$am_responsable,$fecha_nacimiento_responsable,$sexo_responsable,
  $ocupacion_responsable,$direccion_responsable,$telefono_resposable,$comunidad_responsable,$ci,$n_seguro,$n_carp_fam,$zona_his,$cod_usuario,$paciente_rd,
  $cod_rd,$fecha_nacimiento,$sexo,$ocupacion,$fecha_de_consulta,$estado_civil,$escolaridad){
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
      if($telefono_resposable == "" && $si == 'no'){
        $sql.= " telefono_usuario = '$telefono_resposable'";
        $si = 'si';
      }else
      if($telefono_resposable == "" && $si == 'si'){
        $sql.= " ,telefono_usuario = '$telefono_resposable'";
      }
      if($comunidad_responsable == "" && $si == 'no'){
        $sql.= " comunidad_usuario = '$comunidad_responsable'";
        $si = 'si';
      }else
      if($comunidad_responsable == "" && $si == 'si'){
        $sql.= " ,comunidad_usuario = '$comunidad_responsable'";
      }
      $sql.= "   WHERE cod_usuario = $cod_usuario";
      //echo $sql." prueba";
      $resul = $this->con->query($sql);
    }else{
      $sql = "insert into usuario(nombre_usuario,ap_usuario,am_usuario,fecha_nac_usuario,edad_usuario,sexo_usuario,ocupacion_usuario,direccion_usuario,
      telefono_usuario,comunidad_usuario,ci_usuario,nro_seguro_usuario,nro_car_form_usuario)values('$Nombre_responsable','$ap_responsable',
      '$am_responsable','$fecha_nacimiento_responsable',0,'$sexo_responsable','$ocupacion_responsable','$direccion_responsable',
      $telefono_resposable,'$comunidad_responsable',$ci,'$n_seguro','$n_carp_fam');";
      $resul = $this->con->query($sql);
      if($resul =! ""){
        $sql = 'select max(cod_usuario) as c from usuario;';
        $resul = $this->con->query($sql);
        $fi=mysqli_fetch_array($resul);
        $cod_usuario = $fi["c"];
      }
    }
    $fechaActual = date("Y-m-d");
    $horaActual = date("H:i:s");
    $sql = "insert into historial(zona_his,cod_rd,paciente_rd,cod_cds,cod_responsable_familia_his,archivo,fecha,hora,estado)values(
    '$zona_his',$cod_rd,$paciente_rd,1,$cod_usuario,'','$fechaActual','$horaActual','activo')";

    $res = $this->con->query($sql);   // Retornar el resultado

    if($res===TRUE){
      $sql_con = "update registro_diario set historial_clinico_rd = 'si' WHERE paciente_rd = $paciente_rd";
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
}



 ?>
