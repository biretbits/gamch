<?php
require_once '../modelo/servicio.php';
require "sesion.controlador.php";
$ins=new sesionControlador();
$ins->StarSession();
/**
 *
 */
class ServicioControlador
{
  public function registroServicio($servicio,$descripcion){
    $s=new Servicio();
    $re = $s->insertarServicio($servicio,$descripcion);
    if($re != ""){
      echo "correcto";
    }else{
      echo "error";
    }
  }
}

$se =new ServicioControlador();
if(isset($_GET["accion"]) && $_GET["accion"] == "rse"){
  $se->registroServicio($_POST["servicio"],$_POST["descripcion"]);
}
