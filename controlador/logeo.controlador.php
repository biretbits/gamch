<?php
require_once '../modelo/usuario.php';
require "sesion.controlador.php";
$ins=new sesionControlador();
$ins->StarSession();

class LogeoControlador{

	public function visualizarInicioSession(){
		if(isset($_SESSION["tipo_usuario"]) && $_SESSION["tipo_usuario"] !=""){
			//hay un usuario en session
			$this->v_index();
		}else{
			require("../vista/logeo/inicioSesion.php");
		}
  }

	public function verificar($usuario,$contrasena){
		$us=new Usuario();
		$resul = $us->validarBD($usuario,$contrasena);
		if ($resul === false) {
        echo "error";
    } elseif ($resul->num_rows == 0) {
        echo "error";
    } else {
        $fila = mysqli_fetch_array($resul);
        if ($fila === null) {
            echo "error";
        } else {
            //echo "Contraseña de la base de datos: ".$fila["contrasena_usuario"];
            if (password_verify($contrasena, $fila['contrasena_usuario'])) {
                $_SESSION["usuario"] = $fila["usuario"];
                $_SESSION["nombre_usuario"] = $fila["nombre_usuario"];
                $_SESSION["ap_usuario"] = $fila["ap_usuario"];
                $_SESSION["am_usuario"] = $fila["am_usuario"];
                $_SESSION["tipo_usuario"] = $fila["tipo_usuario"];
                echo $fila["tipo_usuario"];
            } else {
                echo 'error';
            }
        }
    }
	}

	public function Drop_usuario(){
		$in=new sesionControlador();
		$in->Destroy();
	}

	public function v_index(){
	    header("location: ../index.php");
	}
}

	$lc=new  LogeoControlador();

	if(isset($_GET["accion"]) && $_GET["accion"]=="is"){
		$lc->visualizarInicioSession();
	}

	if(isset($_GET["accion"]) && $_GET["accion"]=="very"){
		$lc->verificar($_POST["usuario"],$_POST["contrasena"]);
	}
	if(isset($_GET["accion"])&&$_GET["accion"]=="salir"){
		$lc->Drop_usuario();
	}
	if(isset($_GET["accion"])&&$_GET["accion"]=="ix")
	{
		$lc->v_index();
	}


?>
