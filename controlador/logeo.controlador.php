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

	public function verificarLogin($usuario,$contrasena){
		$us=new Usuario();
		$rad = $us->seleccionarAdminInicioSesion();
		$fila3 = mysqli_fetch_array($rad);
		$administrador = $fila3['usuario'];$tipoAdmin = $fila3["tipo_usuario"];
		$acceso = $fila3["control_acceso"];$configuracion = $fila3["configControlAcceso"];
		$resul1 = $us->validarBD($usuario);
			$fila1 = mysqli_fetch_array($resul1);
			if ($fila1['count(*)'] == 0) {
	        echo "error";
	    } else {
					$resul = $us->validarBDTodo($usuario);
	        $fila = mysqli_fetch_array($resul);
					if ($fila === null) {
	            echo "error";
	        } else {
	          //  echo "Contraseña de la base de datos: ".$fila["contrasena_usuario"]." usuario ".$contrasena;
						//validar el usuario
						if($configuracion=="si")
						{
							$esAdmin = 0;
							if($administrador == $fila["usuario"] and $tipoAdmin == $fila['tipo_usuario'] and $tipoAdmin=='admin'){
								$esAdmin=1;
							}
						 $ingresar = "no";
							if($esAdmin == 0){//si es cero quiere decir que es otro usuario no es admin y se tiene que validar
								if($acceso == 'activo'){
									$ingresar='si';
								}else{
									$ingresar='no';
								}
							}else{//es el admin quien quere ingresar al sistema
									$us->CambiarEstadoAdminAcceso('activo');
									$ingresar = 'si';
							}
						}else{
							//si esta en no esto quiere decir que no se necesita control de acceso
							$ingresar = 'si';
						}
						if($ingresar == 'si'){//si ingresar es igual a 1 entonces validamos la contraseña si es correcto o no
							if (password_verify($contrasena, $fila['contrasena_usuario'])) {
									$_SESSION['cod_usuario'] = $fila['cod_usuario'];
	                $_SESSION["usuario"] = $fila["usuario"];
	                $_SESSION["nombre_usuario"] = $fila["nombre_usuario"];
	                $_SESSION["ap_usuario"] = $fila["ap_usuario"];
	                $_SESSION["am_usuario"] = $fila["am_usuario"];
	                $_SESSION["tipo_usuario"] = $fila["tipo_usuario"];

									$session_id = session_id();
									$_SESSION["session_id"] = $session_id;

										$session_start = date('Y-m-d H:i:s');
										$sessionEnd = "abierto";
										$us->insertarDatosSession($session_id,$session_start,$fila['cod_usuario'],$fila["usuario"],$fila["nombre_usuario"],$fila["ap_usuario"],$fila["am_usuario"],$fila["tipo_usuario"],$sessionEnd);

									echo $fila["tipo_usuario"];

	            } else {
	                echo 'error';
	            }
						}else{
							echo "Falta_inicio_sesion_admin";
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

	public function validar_usuario_si_existe($usuario){
		$us=new Usuario();
		$resul = $us->validarBD($usuario);
		$fila = mysqli_fetch_array($resul);
		if ($fila['count(*)'] == 0) {
				echo "no_existe";
		} else {
			echo "existe";
		}
	}
}

	$lc=new  LogeoControlador();

	if(isset($_GET["accion"]) && $_GET["accion"]=="is"){
		$lc->visualizarInicioSession();
	}

	if(isset($_GET["accion"]) && $_GET["accion"]=="vcu"){
		$lc->verificarLogin($_POST["usuario"],$_POST["contrasena"]);
	}
	if(isset($_GET["accion"])&&$_GET["accion"]=="salir"){
		$lc->Drop_usuario();
	}
	if(isset($_GET["accion"])&&$_GET["accion"]=="ix")
	{
		$lc->v_index();
	}
	if(isset($_GET["accion"])&&$_GET["accion"]=="vsx")
	{
		$lc->validar_usuario_si_existe($_POST['usuario']);
	}

?>
