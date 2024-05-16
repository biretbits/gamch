<?php
//require_once '../model/traductor.php';
require "sesion.controlador.php";
$ins=new sesionControlador();
$ins->StarSession();
if(isset($_SESSION["usuario"])==""){
		$ins->Redireccionar_inicio();
}
class AdminControlador{

	public function visualizarPrincipalAdmin(){
			require("../vista/admin/principalAdmin.php");
  }
}

	$uc=new  AdminControlador();
	if(isset($_GET["accion"]) && $_GET["accion"]=="vpa"){
		$uc->visualizarPrincipalAdmin();
	}


?>
