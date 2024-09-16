<?php
class sesionControlador{

	public function StarSession(){
		session_start();
	}

	public function Redireccionar(){

	}

	public function Destroy(){
		//$this->eliminar();
		require_once '../modelo/usuario.php';
		$us=new Usuario();
		$resulConfig = $us->seleccionarAdminInicioSesion();
		if($resulConfig!=''){
			$fila = mysqli_fetch_array($resulConfig);
			if($fila["configControlAcceso"]=='si')
			{//si dice si entonces cerramos todas las cuentas que hay en el sistema
				if($_SESSION["tipo_usuario"]=='admin')
				{
				$us->cambiaraNoLaNotificacion("si");
				$us->CambiarEstadoAdminAcceso('desactivo');
				$seRe=$us->seleccionarSessiones();
				while($fi = mysqli_fetch_array($seRe)){
						$session_id = $fi['session_id'];
	        	// Eliminar la sesión en la base de datos
						if($fi["session_end"]=='abierto'){
							$us->eliminarSession($session_id);
							// Destruir la sesión en el servidor
							session_id($session_id);
							session_destroy();
							
						}
					}
				}
			}
		}
		$session_id=$_SESSION["session_id"];
		$us->eliminarSession($session_id);
		session_destroy();
		$this->Redireccionar_inicio();
	}

	public function Redireccionar_inicio(){
			//$llego="destruido_session";
		//$usuario=base64_encode(serialize($cod_user));
			//$usuario=$this->combinar($usuario);
			header("location: ../index.php");
	}
	public function combinar($usuario){
		$usuario="x2abs3".$usuario."xzpa*s";
		for($i=0;$i<strlen($usuario)-1;$i++){
			$aux=$usuario[$i];
			$usuario[$i]=$usuario[$i+1];
			$usuario[$i+1]=$aux;
		}
		return $usuario;
	}

	public function verificarSession(){
		require_once '../modelo/usuario.php';
		$us=new Usuario();
		$resulConfig = $us->seleccionarAdminInicioSesion();
		if($resulConfig!=''){
			$fila = mysqli_fetch_array($resulConfig);
			if($fila["configControlAcceso"]=='si')
			{//activo el control de acceso si esta en si esto quiere decir que hay control de acceso del admin
				if(isset($_SESSION["cod_usuario"])!=''&&isset($_SESSION["usuario"])!=''&&isset($_SESSION["session_id"])!='')
				{
					$resul =$us->seleccionarSessionID($_SESSION["cod_usuario"],$_SESSION["usuario"],$_SESSION["session_id"]);
					if($resul!=''){
						if(mysqli_num_rows($resul)>0){
							$fi = mysqli_fetch_array($resul);
							return $fi["session_end"];
						}else{
							return "";
						}
					}else{
						return "";
					}
				}else{
					return '';
				}
			}else{
				//si no no existe el control de acceso entonces pueden ingresar nomas
				return 'abierto';
			}
		}else{
			return '';
		}
	}



}

?>
