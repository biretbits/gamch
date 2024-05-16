<?php
/**
 *
 */

class Usuario
{

  function __construct()
	{
		require_once("conexion.php");

			//llamando al metodo Conectaras de la clase Conexion para realizar los metodos de insert update delete
			$co=new Conexion();
			$this->con= $co->Conectaras();
	}

  public function validarBD($usuario, $contrasena) {
    $lis = "select *from usuario where usuario='".$usuario."' and estado='activo'";
    $resul = $this->con->query($lis);
    return $resul;
    mysqli_close($this->con);
  }
  public function SelectUsuarios() {
    $lis = "select *from usuario where estado='activo'";
    $resul = $this->con->query($lis);
    return $resul;
    mysqli_close($this->con);
  }

  public function SelectPorBusqueda($buscar) {
      // Verificar si $buscar tiene contenido

      if ($buscar != "" && $buscar != null) {
          // Convertir $buscar a minúsculas
          $buscar = strtolower($buscar);
          // Consulta SQL
          $lis = "SELECT * FROM usuario WHERE LOWER(usuario) LIKE '%".$buscar."%' OR LOWER(nombre_usuario) LIKE '%".$buscar."%'
          OR LOWER(ap_usuario) LIKE '%".$buscar."%' OR LOWER(am_usuario) LIKE '%".$buscar."%'";
      }else{
          $lis = "select *from usuario";
      }
      $resul = $this->con->query($lis);
      // Retornar el resultado
      return $resul;
      mysqli_close($this->con);
  }



}



 ?>
