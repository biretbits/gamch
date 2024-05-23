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


}



 ?>
