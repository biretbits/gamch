<?php
/**
 *
 */

class Farmacia
{

  function __construct()
	{
		require_once("conexion.php");

			//llamando al metodo Conectaras de la clase Conexion para realizar los metodos de insert update delete
			$co=new Conexion();
			$this->con= $co->Conectaras();
	}

  public function SeleccionarNombreGenerico($inicioList=false,$listarDeCuanto=false,$buscar='',$codNombreGenerico=false){
    $sql = "select *from nombre_generico";
    if($buscar != ''){
       $sql.=" where LOWER(nombre) LIKE '%".$buscar."%' ";
    }
    if(is_numeric($inicioList)&&is_numeric($listarDeCuanto)){
      $sql.=" ORDER BY cod_generico DESC LIMIT $listarDeCuanto OFFSET $inicioList ";
    }
    $resul = $this->con->query($sql);
    // Retornar el resultado
    return $resul;
    mysqli_close($this->con);
  }

  public function SeleccionarConcentracion($inicioList=false,$listarDeCuanto=false,$buscar=''){
    $sql = "select *from conc_uni_med";
    if($buscar != ''){
       $sql.=" where LOWER(concentracion) LIKE '%".$buscar."%' ";
    }
    if(is_numeric($inicioList)&&is_numeric($listarDeCuanto)){
      $sql.=" ORDER BY cod_conc DESC LIMIT $listarDeCuanto OFFSET $inicioList ";
    }
    $resul = $this->con->query($sql);
    // Retornar el resultado
    return $resul;
    mysqli_close($this->con);
  }

  public function SeleccionarPresentacion($inicioList=false,$listarDeCuanto=false,$buscar=''){
    $sql = "select *from forma_presentacion";
    if($buscar != ''){
       $sql.=" where LOWER(nombre_forma) LIKE '%".$buscar."%' ";
    }
    if(is_numeric($inicioList)&&is_numeric($listarDeCuanto)){
      $sql.=" ORDER BY cod_forma DESC LIMIT $listarDeCuanto OFFSET $inicioList ";
    }
    $resul = $this->con->query($sql);
    // Retornar el resultado
    return $resul;
    mysqli_close($this->con);
  }
  public function InsertarActualizarPresentacion($generico,$cod_generico){
    $sql = '';
    if(is_numeric($cod_generico)){//actualizar
      $sql = "update forma_presentacion set nombre_forma='".$generico."' where cod_forma = $cod_generico";
    }else{//insertar
      $sql = "insert into forma_presentacion(nombre_forma)values('".$generico."');";
    }
    $resul = $this->con->query($sql);
    // Retornar el resultado
    return $resul;
    mysqli_close($this->con);
  }

  public function InsertarActualizarNombreGenerico($generico,$cod_generico){
    $sql = '';
    if(is_numeric($cod_generico)){//actualizar
      $sql = "update nombre_generico set nombre='".$generico."' where cod_generico = $cod_generico";
    }else{//insertar
      $sql = "insert into nombre_generico(nombre)values('".$generico."');";
    }
    $resul = $this->con->query($sql);
    // Retornar el resultado
    return $resul;
    mysqli_close($this->con);
  }

  public function InsertarActualizarConcentracion($generico,$cod_generico){
    $sql = '';
    if(is_numeric($cod_generico)){//actualizar
      $sql = "update conc_uni_med set concentracion='".$generico."' where cod_conc = $cod_generico";
    }else{//insertar
      $sql = "insert into conc_uni_med(concentracion)values('".$generico."');";
    }
    $resul = $this->con->query($sql);
    // Retornar el resultado
    return $resul;
    mysqli_close($this->con);
  }
}



 ?>
