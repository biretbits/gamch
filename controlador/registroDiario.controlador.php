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
    require ("../vista/registroDiario/tablaRegistroDiario.php");
  }

	public function v_index(){
	    header("location: ../index.php");
	}
  public function visualizarRegistrodiario(){
    $rdi =new RegistroDiario();
    require ("../vista/registroDiario/registroDiario.php");
  }

  public function buscarPaciente($nombre){
    $rdi =new RegistroDiario();
    $res =$rdi->buscarPacientesql($nombre);
    if ($res && $res->num_rows > 0) {
      while ($fila = $res->fetch_assoc()) {
        $usu[] = $fila;
      }
      $ms = json_encode($usu);
       echo $ms;
    }else{
        echo json_encode([]);
    }
  }

}


	$rd=new  RegistroDiarioControlador();

	if(isset($_GET["accion"]) && $_GET["accion"]=="vtd"){
		$rd->visualizarTablaRegistroDiario();
	}

  if(isset($_GET["accion"]) && $_GET["accion"]=="vrd"){
		$rd->visualizarRegistrodiario();
	}
  if(isset($_GET["accion"]) && $_GET["accion"]=="bp"){
		$rd->buscarPaciente($_POST["nombre"]);
	}



?>
