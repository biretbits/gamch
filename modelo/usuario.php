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


  public function SelectPorBusqueda($buscar="",$inicioList=false,$listarDeCuanto=false) {
      // Verificar si $buscar tiene contenido
      $sql = "SELECT * FROM usuario where estado = 'activo' ";
      if ($buscar != "" && $buscar != null) {
          // Convertir $buscar a minúsculas
          $buscar = strtolower($buscar);
          $sql.=" and LOWER(usuario) LIKE '%".$buscar."%' OR LOWER(nombre_usuario) LIKE '%".$buscar."%'
          OR LOWER(ap_usuario) LIKE '%".$buscar."%' OR LOWER(am_usuario) LIKE '%".$buscar."%' ";
      }

    	if(is_numeric($inicioList)&&is_numeric($listarDeCuanto)){
    		$sql.=" ORDER BY cod_usuario DESC LIMIT $listarDeCuanto OFFSET $inicioList ";
    	}

      $resul = $this->con->query($sql);
      // Retornar el resultado
      return $resul;
      mysqli_close($this->con);
  }



}



 ?>
