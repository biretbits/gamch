<?php
//require_once '../model/traductor.php';
//require "SessionControler.php";
/*$ins=new StartSessionControler();
$ins->StarSession();
if(isset($_SESSION["usuario"])==""){
    $ins->Redireccionar_inicio('');
}*/
class medicoControlador{

	public function visualizarPrincipalmedico(){

      require("../vista/medico/principalmedico.php");
	}


}

	$uc=new  medicoControlador();
	if(isset($_GET["accion"]) && $_GET["accion"]=="mc"){
		$uc->visualizarPrincipalmedico();
	}
	if(isset($_GET["accion"]) && $_GET["accion"]=="vhm"){
		$uc->visualizarPrincipalmedico();
	}

?>
