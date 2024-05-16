<?php

class sesionControlador{

	public function StarSession(){
		session_start();
	}

	public function Redireccionar(){

	}

	public function Destroy(){
		//$this->eliminar();
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


}

?>
