<?php
require 'modelo/usuario.php';

class LogeoControlador{

	public static function visualizarInicioSession(){
		if(isset($_SESSION["tipo_usuario"]) && $_SESSION["tipo_usuario"] !=""){
			//hay un usuario en session
			 self::v_index();
		}else{
			require("vista/logeo/inicioSesion.php");
		}
  }

	public static function verificarLogin($usuario,$contrasena){
		$us=new Usuario();
		$resul = $us->validarBDTodo($usuario);
	   $fila = mysqli_fetch_array($resul);
					if ($fila === null) {
	            echo "error";
	        } else {
	  					if (password_verify($contrasena, $fila['contrasena'])) {
								$id_usuario = $fila["id"];
									//obtener las credenciales de tipo de usuario y tambien de permisos
									$resu = $us->rolePermisos($id_usuario);
									$fi = mysqli_fetch_array($resu);
									$rr=$us->DatosEmpleado($id_usuario);
									$fii = mysqli_fetch_array($rr);
									$_SESSION["nivel_id_emp "]=$fii["nivel_id"];
									$_SESSION["cargo_id_emp "]=$fii["cargo_id"];
									$_SESSION["tipo_empleado_emp "]=$fii["tipo_empleado"];
									$_SESSION["nombre_emp"]=$fii["nombre"];
									$_SESSION["apellido_p_emp"]=$fii["apellido_p"];
									$_SESSION["apellido_m_emp"]=$fii["apellido_m"];
									$_SESSION["sexo_emp"]=$fii["sexo"];
									$_SESSION["direccion_emp"]=$fii["direccion"];
									$_SESSION["telefono_emp"]=$fii["telefono"];
									$_SESSION["correo_electronico_emp"]=$fii["correo_electronico"];
									$_SESSION["id"]=$fi["id"];
									$_SESSION["empleado_id"]=$fi["empleado_id"];
									$_SESSION["usuario"]=$fi["usuario"];
									$_SESSION["contrasena"]=$fi["contrasena"];
									$_SESSION["estado"]=$fi["estado"];
									$_SESSION["token_recordar"]=$fi["token_recordar"];
									$_SESSION["creado_en"]=$fi["creado_en"];
									$_SESSION["actualizado_en"]=$fi["actualizado_en"];
									$_SESSION["id"]=$fi["id"];
									$_SESSION["rol_id"]=$fi["rol_id"];
									$_SESSION["usuario_id"]=$fi["usuario_id"];
									$_SESSION["creado_en"]=$fi["creado_en"];
									$_SESSION["actualizado_en"]=$fi["actualizado_en"];
									$_SESSION["id"]=$fi["id"];
									$_SESSION["nombre_role"]=$fi["nombre"];
									$_SESSION["slug"]=$fi["slug"];
									$_SESSION["descripcion"]=$fi["descripcion"];
									$_SESSION["creado_en"]=$fi["creado_en"];
									$_SESSION["actualizado_en"]=$fi["actualizado_en"];
									$_SESSION["especial"]=$fi["especial"];
									echo "correcto";
	            } else {
	                echo 'error'.$usuario."  ".$contrasena;
	            }
						}
	}

	public function Drop_usuario(){
		$in=new sesionControlador();
		$in->Destroy();
	}

	public static function v_index(){
	    header("location: index.php");
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

?>
