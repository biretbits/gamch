<?php
/**
 *
 */

class RegistroDiario
{

  function __construct()
	{
		require_once("conexion.php");

			//llamando al metodo Conectaras de la clase Conexion para realizar los metodos de insert update delete
			$co=new Conexion();
			$this->con= $co->Conectaras();
	}

  public function SelectDatosRegistroDiario() {
    $lis = "select *from registro_diario where estado='activo'";
    $resul = $this->con->query($lis);
    return $resul;
    mysqli_close($this->con);
  }
  public function SelectPorBusquedaRegistroDiario($buscar,$inicioList,$listarDeCuanto,$fecha,$fechai=false,$fechaf=false){
    // Verificar si $buscar tiene contenido
    $sql = "SELECT * FROM usuario as u inner join registro_diario as rd on u.cod_usuario = rd.paciente_rd where u.tipo_usuario = 'paciente' and rd.estado = 'activo'";
    if ($buscar != "" && $buscar != null) {
        // Convertir $buscar a minúsculas
        $buscar = strtolower($buscar);
        $sql.=" and LOWER(u.nombre_usuario) LIKE '%".$buscar."%' OR LOWER(u.ap_usuario) LIKE '%".$buscar."%' OR LOWER(u.am_usuario) LIKE '%".$buscar."%' ";
    }
    if($fecha != false){
  		//$di=strtotime($fecha);
  		//$df=strtotime($fecha) + 86399;
  	//	echo $di."       ".$df;
  		$sql.=" and (rd.fecha_rd >= '$fecha' and  rd.fecha_rd <= '$fecha')";
	 }
   //fecha solo para
   if($fechai != false && $fechaf != false){
    //$di=strtotime($fecha);
    //$df=strtotime($fecha) + 86399;
  //	echo $di."       ".$df;
    $sql.=" and (rd.fecha_rd >= '$fechai' and  rd.fecha_rd <= '$fechaf') ";
    }
    if(is_numeric($inicioList)&&is_numeric($listarDeCuanto)){
      $sql.="ORDER BY rd.cod_rd DESC LIMIT $listarDeCuanto OFFSET $inicioList ";
    }

    $resul = $this->con->query($sql);
    // Retornar el resultado
    return $resul;
    mysqli_close($this->con);
  }
  public function selectNombreUsuario($id){
    $sql = "select nombre_usuario,ap_usuario,am_usuario from usuario where cod_usuario = $id";
    $resul = $this->con->query($sql);
    // Retornar el resultado
    $fi = mysqli_fetch_array($resul);
    return $fi["nombre_usuario"]." ".$fi["ap_usuario"]." ".$fi["am_usuario"];
    mysqli_close($this->con);
  }


  public function buscarPacientesql($nombre){
    $nombre = strtolower($nombre);
    $lis = "SELECT * FROM usuario
      WHERE tipo_usuario = 'paciente'AND (LOWER(nombre_usuario) LIKE '%$nombre%' OR LOWER(ap_usuario) LIKE '%$nombre%' or LOWER(am_usuario) like '%$nombre%')
          LIMIT 5 OFFSET 0;";
    $resul = $this->con->query($lis);
    return $resul;
    mysqli_close($this->con);
  }

  public function buscarrespAdmisionsql($respadmision){
    $respadmision = strtolower($respadmision);
    $lis = "SELECT * FROM usuario
      WHERE tipo_usuario = 'admision'AND (LOWER(nombre_usuario) LIKE '%$respadmision%' OR LOWER(ap_usuario) LIKE '%$respadmision%' or LOWER(am_usuario) like '%$respadmision%')
          LIMIT 5 OFFSET 0;";
    $resul = $this->con->query($lis);
    return $resul;
    mysqli_close($this->con);
}
public function buscarpersonalAtencionsql($personalquebrindalaatencion){
   $personalquebrindalaatencion = strtolower($personalquebrindalaatencion);
   $lis = "SELECT * FROM usuario
     WHERE tipo_usuario = 'medico'AND (LOWER(nombre_usuario) LIKE '%$personalquebrindalaatencion%' OR LOWER(ap_usuario) LIKE '%$personalquebrindalaatencion%' or LOWER(am_usuario) like '%$personalquebrindalaatencion%')
         LIMIT 5 OFFSET 0;";
   $resul = $this->con->query($lis);
   return $resul;
   mysqli_close($this->con);
 }

 public function insertarNewpacientes($cod_usuario,$nombre,$ap_usuario,$am_usuario,$fecha_nacimiento,$edad,$direccion_usuario,$servicio,
 $historiaclinica,$signos_sintomas,$personalatencion,$respadmision,$fechaderetornodeHistoria){
   if($cod_usuario ==""){
     $sql = "insert into usuario(ci_usuario,usuario,nombre_usuario,ap_usuario,am_usuario,fecha_nac_usuario,edad_usuario,telefono_usuario,direccion_usuario,
     profesion_usuario,especialidad_usuario, ocupacion_usuario,comunidad_usuario,estado_civil_usuario,escolaridad_usuario,autoidentificacion_usuario,
     nro_seguro_usuario,nro_car_form_usuario,sexo_usuario,tipo_usuario,contrasena_usuario,cod_cds,estado)values(0,'','$nombre','$ap_usuario','$am_usuario','$fecha_nacimiento',$edad,0,'$direccion_usuario',
     '','','','','','','','','','','paciente','',1,'activo'
   );";
      $resul = $this->con->query($sql);

      if($resul =! ""){
       $sql = 'select max(cod_usuario) as c from usuario;';
       $resul2 = $this->con->query($sql);
       $fi=mysqli_fetch_array($resul2);
       $cod_usuario = $fi["c"];
     }
  }


   $fechaActual = date("Y-m-d");
   $horaActual = date("H:i:s");

   $sql = "insert into registro_diario(fecha_rd,hora_rd,servicio_rd,signo_sintomas_rd,historial_clinico_rd,
   fecha_retorno_historia_rd,pe_brinda_atencion_rd,resp_admision_rd,paciente_rd,cod_cds,estado)values('$fechaActual','$horaActual',
   '$servicio','$signos_sintomas','no','$fechaderetornodeHistoria',$personalatencion,$respadmision,$cod_usuario,1,'activo');";
   $resu = $this->con->query($sql);#ejecutamos y ya existe esta fila con el campo no

   $sql_consu = "select *from historial where paciente_rd = $cod_usuario";#buscamos si el usuario tiene historial registrado si o no
   $res = $this->con->query($sql_consu);
   $si = "no";#luego realizamos esta consulta
   if(mysqli_num_rows($res) > 0) {
     $sqlnew = "update registro_diario set historial_clinico_rd = 'si' where paciente_rd = $cod_usuario";
     $re78 = $this->con->query($sqlnew);
   }
  return $resu;
  mysqli_close($this->con);
}

public function seleccionarDatos($cod_rd,$paciente_rd){
  $sql = "select * from usuario as u inner join registro_diario as r on u.cod_usuario = r.paciente_rd where r.paciente_rd = $paciente_rd and cod_rd = $cod_rd";
  $resu = $this->con->query($sql);
  return $resu;
  mysqli_close($this->con);
}

public function UpdateDatosRegistroDiario($cod_rd,$cod_usuario,$nombre,$ap_usuario,$am_usuario,$fecha_nacimiento,$edad,
$direccion_usuario,$servicio,$signos_sintomas,$historiaclinica,$personalatencion,
$respadmision,$fechaderetornodeHistoria){
  $sql = "update usuario set nombre_usuario = '$nombre', ap_usuario = '$ap_usuario', am_usuario='$am_usuario',fecha_nac_usuario = '$fecha_nacimiento',
  edad_usuario = '$edad', direccion_usuario='$direccion_usuario' where cod_usuario = $cod_usuario";
  $resu = $this->con->query($sql);
  if($resu != ""){
    $sql = "update registro_diario set servicio_rd = '$servicio',signo_sintomas_rd = '$signos_sintomas',
    fecha_retorno_historia_rd='$fechaderetornodeHistoria', pe_brinda_atencion_rd = $personalatencion, resp_admision_rd = $respadmision
    where paciente_rd = $cod_usuario and cod_rd = $cod_rd";
    $resus = $this->con->query($sql);
  }
  return $resus;
}

}
 ?>
