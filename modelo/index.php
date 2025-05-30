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
  public function SeleccionarNoticiasDeDosDias($limite) {
      // Calcular la fecha de hace 5 días (el rango inferior)
      $fechaLimite5Dias = date('Y-m-d H:i:s', strtotime('-5 days'));

      // Calcular la fecha de hace 1 día (el rango superior)
      $fechaLimite1Dia = date('Y-m-d H:i:s', strtotime('-1 days'));

      // Consulta SQL para obtener noticias entre hace 5 días y hace 1 día
      $consulta = "SELECT * FROM nuevas_paginas WHERE creado_en BETWEEN '$fechaLimite5Dias' AND '$fechaLimite1Dia' ORDER BY id DESC LIMIT $limite";

      // Ejecutar la consulta y devolver el resultado
      return $this->con->query($consulta);
  }

}



 ?>
