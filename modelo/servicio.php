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

  public function insertarServicio($servicio,$descripcion){
    $sql = "insert into servicio(nombre_servicio,descripcion_servicio,estado)values('$servicio','$descripcion','activo')";
    $resul = $this->con->query($sql);
    // Retornar el resultado
    return $resul;
    mysqli_close($this->con);
  }

  public function Selecionar_servicios(){
    $sql = "select *from servicio";
    $resul = $this->con->query($sql);
    // Retornar el resultado
    return $resul;
    mysqli_close($this->con);
  }

}



 ?>
