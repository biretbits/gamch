<?php
require_once '../modelo/chat.php';
require "sesion.controlador.php";
class ChatControlador{

	public function MensajeUsuario($mensaje){
    $ch = new Chat();
    $resul = $ch->BuscarRespuesta($mensaje);
    if($resul!=''){
      if(mysqli_num_rows($resul)>0){
        $fi = mysqli_fetch_array($resul);
        echo $fi['respuesta_consulta'];
      }else{
        echo "Lo siento no tengo una respuesta para su consulta";
      }
    }else{
      echo "Lo siento no tengo una respuesta para su consulta";
    }
  }
}


	$uc=new  ChatControlador();
	if(isset($_GET["accion"]) && $_GET["accion"]=="msu"){
		$uc->MensajeUsuario($_POST["mensaje"]);
	}

?>
