<?php
/**
 *
 */

class Servicio
{

  function __construct()
	{
		require_once("conexion.php");

			//llamando al metodo Conectaras de la clase Conexion para realizar los metodos de insert update delete
			$co=new Conexion();
			$this->con= $co->Conectaras();
	}

  public function insertarServicio($cod_servicio,$servicio,$descripcion){
    if(is_numeric($cod_servicio) && $cod_servicio!=''){
      $sql = "update servicio set nombre_servicio='".$servicio."',descripcion_servicio='".$descripcion."' where cod_servicio=$cod_servicio";
    }else{
      $sql = "insert into servicio(nombre_servicio,descripcion_servicio,estado)values('$servicio','$descripcion','activo')";

    }
    $resul = $this->con->query($sql);
    // Retornar el resultado
    return $resul;
    mysqli_close($this->con);
  }

  public function Selecionar_servicios(){
    $sql = "select *from servicio where estado='activo'";
    $resul = $this->con->query($sql);
    // Retornar el resultado
    return $resul;
    mysqli_close($this->con);
  }

  public function Selecionar_servicios_buscar($id_servicio='',$inicioList=false,$listarDeCuanto=false){
    $sql = "select *from servicio";
    if($id_servicio!=''){
      $sql.=" where cod_servicio = ".$id_servicio;
    }
    $sql.=" ORDER BY cod_servicio  DESC ";
    if(is_numeric($inicioList) && is_numeric($listarDeCuanto)){
      $sql.=" LIMIT $listarDeCuanto OFFSET $inicioList ";
    }
    $resul = $this->con->query($sql);
    // Retornar el resultado
    return $resul;
    mysqli_close($this->con);
  }

  public function modificarServicioActivoODESACTIVO($accion,$cod_servicio){
    $sql="update servicio set estado='$accion' where cod_servicio=$cod_servicio";
    $resul = $this->con->query($sql);
  }

}



 ?>
