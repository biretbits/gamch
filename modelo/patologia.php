<?php
/**
 *
 */

class Patologia
{

  function __construct()
	{
		require_once("conexion.php");

			//llamando al metodo Conectaras de la clase Conexion para realizar los metodos de insert update delete
			$co=new Conexion();
			$this->con= $co->Conectaras();
	}
  public function SeleccionarPatoligias($buscar='',$inicioList=false,$listarDeCuanto=false,){
    $sql = "select *from patologias";
    if($buscar != ''){
      $sql.=" where (lower(nombre) like '%$buscar%' or lower(descripcion) like '%$buscar%')";
    }
    $sql.= " order by cod_pat desc";
    if(is_numeric($inicioList)&&is_numeric($listarDeCuanto)){
      $sql.=" LIMIT $listarDeCuanto OFFSET $inicioList ";
    }
  //  echo "<br><br><br><br>".$sql;
    $resul = $this->con->query($sql);
    // Retornar el resultado
    if($resul===false){
      return $this->con->error;
    }else{
      return $resul;
    }
    mysqli_close($this->con);
  }

  public function insertarPatologia($datos){
    $cod_pat = $datos["cod_pat"];$nombre=$datos["nombre"];$descripcion=$datos["descripcion"];
    $sintomas = $datos["sintomas"];$tratamiento=$datos["tratamiento"];
    $fecha = '';//iniciamos una variable fecha en vacio
    if(!is_numeric($datos["cod_pat"]))
    {
      $fecha = date("Y-m-d");
      $hora = date("H:i:s");
    }

    $sql = "INSERT INTO patologias(
              cod_pat,nombre,descripcion,sintomas,tratamiento,fecha_registro,estado
            ) VALUES (
              '$cod_pat','$nombre','$descripcion','$sintomas','$tratamiento','$fecha','activo'
            ) ON DUPLICATE KEY UPDATE
              nombre = VALUES(nombre),
              descripcion = VALUES(descripcion),
              sintomas = VALUES(sintomas),
              tratamiento = VALUES(tratamiento)";
    // Ejecutar la consulta
    $resul = $this->con->query($sql);
    return $resul;
  }

  public function EliminarPatologiaSql($cod_pat,$estado){
    $estado_nuevo = '';
    if($estado == 'activo'){
      $estado_nuevo = 'desactivo';
    }else{
      $estado_nuevo = 'activo';
    }
    //echo $cod_pat;
    $sql = "update patologias set estado = '$estado_nuevo' where cod_pat=$cod_pat";
    $resul = $this->con->query($sql);
    return $resul;
  }

}



 ?>
