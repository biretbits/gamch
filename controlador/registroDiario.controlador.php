<?php
require_once '../modelo/registroDiario.php';
require "sesion.controlador.php";
$ins=new sesionControlador();
$ins->StarSession();
if(isset($_SESSION["tipo_usuario"])==""){
    $ins->Redireccionar_inicio();
}
class RegistroDiarioControlador{

	public function visualizarTablaRegistroDiario(){
		$rdi =new RegistroDiario();
    $rdi->
  }


	public function v_index(){
	    header("location: ../index.php");
	}
}

	$rd=new  RegistroDiarioControlador();

	if(isset($_GET["accion"]) && $_GET["accion"]=="vtd"){
		$rd->visualizarTablaRegistroDiario();
	}


?>
