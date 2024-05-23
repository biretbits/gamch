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

  public function validarBD($usuario) {
    $lis = "select *from usuario where usuario='".$usuario."' and estado='activo'";
    $resul = $this->con->query($lis);
    return $resul;
    mysqli_close($this->con);
  }


  public function SelectPorBusqueda($buscar="",$inicioList=false,$listarDeCuanto=false) {
      // Verificar si $buscar tiene contenido
      $sql = "SELECT * FROM usuario";
      if ($buscar != "" && $buscar != null) {
          // Convertir $buscar a minúsculas
          $buscar = strtolower($buscar);
          $sql.=" where LOWER(usuario) LIKE '%".$buscar."%' OR LOWER(nombre_usuario) LIKE '%".$buscar."%'
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
  public function insertarUpdateUsuarios($usuario,$nombre_usuario,$ap_usuario,$am_usuario,$telefono_usuario,$direccion_usuario,$profesion_usuario,
  $especialidad_usuario,$tipo_usuario,$contraseña_usuario,$ci,$cod_usuario,$accion){
    if($accion == 1){

      $sql = "update usuario set ci_usuario = $ci,usuario='$usuario',nombre_usuario='$nombre_usuario',ap_usuario='$ap_usuario',
      am_usuario='$am_usuario',telefono_usuario=$telefono_usuario,direccion_usuario='$direccion_usuario',profesion_usuario='$profesion_usuario',
      especialidad_usuario='$especialidad_usuario',tipo_usuario='$tipo_usuario'";
      if($contraseña_usuario != ""){
        $contraseña_usuario=password_hash($contraseña_usuario, PASSWORD_DEFAULT);
        $sql.=",contrasena_usuario='$contraseña_usuario'";
      }
      $sql.= " where cod_usuario = $cod_usuario";
    }else{
      $contraseña_usuario=password_hash($contraseña_usuario, PASSWORD_DEFAULT);
      $sql = "insert into usuario(ci_usuario,usuario,nombre_usuario,ap_usuario,am_usuario,fecha_nac_usuario,edad_usuario,telefono_usuario,direccion_usuario,profesion_usuario,
      especialidad_usuario,tipo_usuario,contrasena_usuario,cod_cds,estado)values($ci,'$usuario','$nombre_usuario','$ap_usuario'
      ,'$am_usuario','',0,$telefono_usuario,'$direccion_usuario','$profesion_usuario',
      '$especialidad_usuario','$tipo_usuario','$contraseña_usuario',1,'activo')";
    }
    $resul = $this->con->query($sql);
    // Retornar el resultado
    return $resul;
    mysqli_close($this->con);
  }

  public function desactivarUsuario($cod_usuario,$accion){
    //echo $accion."      ".$cod_usuario;
    if($accion == 'activo'){
        $sql = "update usuario set estado = 'desactivo' where cod_usuario=".$cod_usuario;
    }else{
        $sql = "update usuario set estado = 'activo' where cod_usuario=".$cod_usuario;
    }
    $resul = $this->con->query($sql);
    // Retornar el resultado
    return $resul;
    mysqli_close($this->con);
  }

  public function selectDatosUsuario($cod_usuario){
    $sql = "select *from usuario where cod_usuario=".$cod_usuario;
    $resul = $this->con->query($sql);
    // Retornar el resultado
    return $resul;
    mysqli_close($this->con);
  }

}



 ?>
