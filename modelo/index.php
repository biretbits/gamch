<?php
/**
 *
 */

class Index
{
    public $con;
  function __construct()
	{
		require_once("conexion.php");

			//llamando al metodo Conectaras de la clase Conexion para realizar los metodos de insert update delete
			$co=new Conexion();
			$this->con= $co->Conectaras();
	}
  public function BuscarRespuesta(){
    $sql = "select *from consultas";
    $resul = $this->con->query($sql);
    // Retornar el resultado
    return $resul;
    mysqli_close($this->con);
  }
  public function SeleccionarNoticiasNuevas($inicioList = false, $listarDeCuanto = false) {
      if (is_numeric($inicioList) && is_numeric($listarDeCuanto)) {
          $sql = "SELECT * FROM nuevas_paginas ORDER BY id DESC LIMIT ? OFFSET ?";
          $stmt = $this->con->prepare($sql);
          $stmt->bind_param("ii", $listarDeCuanto, $inicioList);
          $stmt->execute();
          $resul = $stmt->get_result();
          return $resul;
      } else {
          // Si no hay paginación, traer todo
          $sql = "SELECT * FROM nuevas_paginas ORDER BY id DESC";
          return $this->con->query($sql);
      }
  }

}



 ?>
