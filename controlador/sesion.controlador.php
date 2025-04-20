<?php
class sesionControlador{

	public function StarSession(){
		session_start();
	}

	public function Redireccionar(){

	}

	public static function Destroy(){

		session_destroy();
		self::Redireccionar_inicio();
	}

	public static function Redireccionar_inicio(){
			//$llego="destruido_session";
		//$usuario=base64_encode(serialize($cod_user));
			//$usuario=$this->combinar($usuario);
			header("location: /");
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
